<?php
ini_set('max_execution_time', 600);
require 'scripts/db_init.php';


function creditcarddatapush($leadidentifier,$lead_allocation_logic, $ProductTable,$DefinedSource)
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='".$leadidentifier."' and Status=1";
	$getActiveBiddersQry = d4l_ExecQuery($getActiveBiddersSql);
	$recordCountActiveBidders = d4l_mysql_num_rows($getActiveBiddersQry);
	$BidderIDArr = '';
	$counterVal = 1;
	for($i=0;$i<$recordCountActiveBidders;$i++)
	{
		$BidderID = d4l_mysql_result($getActiveBiddersQry,$i,'BidderID');
		$BidderIDArr[$counterVal] = $BidderID;
		$counterVal = $counterVal + 1;
	}
	$BidderIDStr = implode(',', $BidderIDArr);
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br>";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	$row=d4l_mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$sbiccqry="select RequestID,Updated_Date,source from  ".$ProductTable." Where (source='".$DefinedSource."' and RequestID > '".$total_lead_count."' AND DATE_SUB(Dated, INTERVAL 2 DAY))";
	}
	//echo $sbiccqry."<br>";
	$select4mcardsresult = d4l_ExecQuery($sbiccqry);
	$recordcount1 = d4l_mysql_num_rows($select4mcardsresult);
	$bidderID="";

	while($row2 = d4l_mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		//$Allocation_Date = $row2["Updated_Date"];
		$Allocation_Date = ExactServerdate();
		$Feedback_ID = $row2["RequestID"];
		if($AllRequestID>0)
		{
			$sequenceid = d4l_ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')");
			$seqid = d4l_mysql_fetch_array($sequenceid);
			$last_allocated_to = $seqid["last_allocated_to"];
			$total_no_agents = $seqid["total_no_agents"];
			
			if($total_no_agents>$last_allocated_to)
			{
				$sequence=$last_allocated_to+1;
			}
			else
			{
				$sequence=1;
			}	
			//echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
			$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")";
			$getCheckQuery = d4l_ExecQuery($getCheckSQl);
			$getCheckNum = d4l_mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{			
				$bidderID = $BidderIDArr[$sequence];
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					$inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '0', '".$Allocation_Date."');";
					$inserticiciqryresult = d4l_ExecQuery($inserticiciqry);
					//echo  $inserticiciqry."<br><br>";
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
					$updateqryresult = d4l_ExecQuery($updateqry);
					//echo $updateqry."<br><br>";
				}
			}
		}
	}
}

main();

function main()
{
	echo "<br>***********************************************************************************************************<br>";
	echo "Leads Push to lead_allocate table";
	echo "<br>***********************************************************************************************************<br>";
	echo $amexDataPush = creditcarddatapush('diallerccleadstodigitechamex',144,'Req_Credit_Card','SMS_Digi_Lead_AMEX');//AMEX
	echo "<br>***********************************************************************************************************<br>";
	echo $rblDataPush = creditcarddatapush('diallerccleadstodigitechrbl',143,'Req_Credit_Card','SMS_Digi_Lead_RBL');//RBL
	echo "<br>***********************************************************************************************************<br>";
	echo $ybankDataPush = creditcarddatapush('diallerccleadstodigitechyesbank',149,'Req_Credit_Card','SMS_Digi_Lead_YesBank');//Yes Bank
	echo "<br>***********************************************************************************************************<br>";
	echo $sbiDataPush = creditcarddatapush('diallerccleadstodigitechsbi',155,'Req_Credit_Card_Sms','SMS_Digi_Lead_SBI');//SBI
	echo "<br>***********************************************************************************************************<br>";

}
?>
