<?php
ini_set('max_execution_time', 1500); 

require 'scripts/db_init.php';

main();

function main()
{
	sbicc62996300();
	
}
function sbicc62996300()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='diallerleadccsmsnew' and Status=1";
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
	echo $BidderIDStr = implode(',', $BidderIDArr);
	
			echo "<br>";
	$getExcludeBiddersSql = "select BidderID from Bidders where leadidentifier in ('diallerleadccpredictive','diallerleadccsmsnew','diallercallerccpredictive')";
	$getExcludeBiddersQry = d4l_ExecQuery($getExcludeBiddersSql);
	$recordCountExcludeBidders = d4l_mysql_num_rows($getExcludeBiddersQry);
	$BidderIDExcludeArr = '';
	$counterValExclude = 1;
	for($i=0;$i<$recordCountExcludeBidders;$i++)
	{
		$BidderIDExclude = d4l_mysql_result($getExcludeBiddersQry,$i,'BidderID');
		$BidderIDExcludeArr[$counterValExclude] = $BidderIDExclude;
		$counterValExclude = $counterValExclude + 1;
	}
	echo $BidderIDExcludeStr = implode(',', $BidderIDExcludeArr);
	echo "<br>";

	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='diallerleadccsmsnew' and BidderID=6299)";
	echo $startprocess."<br>";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	$row=d4l_mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card_Sms Where (source='SMS_LeadNew' and RequestID>'".$total_lead_count."')";
	}
//	echo $sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card_Sms Where (source='SMS_LeadNew')";
		echo $sbiccqry."<br>";
	$select4mcardsresult = d4l_ExecQuery($sbiccqry);
	$recordcount1 = d4l_mysql_num_rows($select4mcardsresult);
	$bidderID="";
	
	while($row2 = d4l_mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["RequestID"];
		if($AllRequestID>0)
		{
				$sequenceid=d4l_ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='diallerleadccsmsnew' and BidderID=6299)");
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
				echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
			echo	$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDExcludeStr.")  ";
				$getCheckQuery = d4l_ExecQuery($getCheckSQl);
				$getCheckNum = d4l_mysql_num_rows($getCheckQuery);
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
						$inserticiciqryresult = d4l_ExecQuery($inserticiciqry);
		echo  $inserticiciqry."<br><br>";
						$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='diallerleadccsmsnew' and BidderID=6299)";
						$updateqryresult = d4l_ExecQuery($updateqry);
						echo $updateqry."<br><br>";
					}
				}
		}
	}
}




?>