<?php
ini_set('max_execution_time', 1500); 

require 'scripts/db_init.php';

main();

function main()
{
	sbicc6449();
}


//Predictive Dialling for 3 Agents on SBI CC
function sbicc6449()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='diallerleadccpredictive' and Status=1";
	$getActiveBiddersQry = ExecQuery($getActiveBiddersSql);
	$recordCountActiveBidders = mysql_num_rows($getActiveBiddersQry);
	$BidderIDArr = '';
	$counterVal = 1;
	for($i=0;$i<$recordCountActiveBidders;$i++)
	{
		$BidderID = mysql_result($getActiveBiddersQry,$i,'BidderID');
		$BidderIDArr[$counterVal] = $BidderID;
		$counterVal = $counterVal + 1;
	}
	echo $BidderIDStr = implode(',', $BidderIDArr);
	
		echo "<br>";
	$getExcludeBiddersSql = "select BidderID from Bidders where leadidentifier in ('diallerleadccpredictive','diallerleadccsmsnew','diallercallerccpredictive')";
	$getExcludeBiddersQry = ExecQuery($getExcludeBiddersSql);
	$recordCountExcludeBidders = mysql_num_rows($getExcludeBiddersQry);
	$BidderIDExcludeArr = '';
	$counterValExclude = 1;
	for($i=0;$i<$recordCountExcludeBidders;$i++)
	{
		$BidderIDExclude = mysql_result($getExcludeBiddersQry,$i,'BidderID');
		$BidderIDExcludeArr[$counterValExclude] = $BidderIDExclude;
		$counterValExclude = $counterValExclude + 1;
	}
	echo $BidderIDExcludeStr = implode(',', $BidderIDExcludeArr);
	echo "<br>";

	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='diallerleadccpredictive' and BidderID=6449)";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card_Sms Where (source='SMS_Lead_ICCS' and RequestID>'".$total_lead_count."')";
	}
//	echo $sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card_Sms Where (source='SMS_LeadNew')";
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
	
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["RequestID"];
		if($AllRequestID>0)
		{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='diallerleadccpredictive' and BidderID=6449)");
				$seqid = mysql_fetch_array($sequenceid);
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
				echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
			echo	$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDExcludeStr.")  ";
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{			
					$bidderID = $BidderIDArr[$sequence];
//					$bidderID = 6299;
					echo $bidderID.", ".$AllRequestID;
					if($AllRequestID>0 && $bidderID>1)
					{
						//insert allocation
						//echo "<br><br>";
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '0', '".$Allocation_Date."');";
						$inserticiciqryresult = ExecQuery($inserticiciqry);
		echo  $inserticiciqry."<br><br>";
						$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='diallerleadccpredictive' and BidderID=6449)";
						$updateqryresult = ExecQuery($updateqry);
						echo $updateqry."<br><br>";
					}
				}
		}
	}
}
//Predictive Dialling for 3 Agents on SBI CC



?>