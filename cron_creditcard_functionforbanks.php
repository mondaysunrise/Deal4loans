<?php

//Common Function Lead Transfer Start Main Table
function insertLeadtoAllocation($leadidentifier,$lead_allocation_logic,$source)
{
//	$leadidentifier= 'sbicallerlms_cc';
//	$lead_allocation_logic = 95;

	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."' and Status=1) order by BidderID ASC";
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
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$sbiccqry="select RequestID,Updated_Date from Req_Credit_Card Where (RequestID>'".$total_lead_count."' and source='".$source."' and Updated_Date Between '".$min_date."' and '".$max_date."')";

	}
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
	echo $recordcount1."<br>";
//die();
	
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["RequestID"];
		if($AllRequestID>0)
		{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")  ";
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{			
					$bidderID = $BidderIDArr[$sequence];
//				
					echo $bidderID.", ".$AllRequestID;
					if($AllRequestID>0 && $bidderID>1)
					{
						//insert allocation
						//echo "<br><br>";
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '0', '".$Allocation_Date."');";
						$inserticiciqryresult = ExecQuery($inserticiciqry);
		echo  $inserticiciqry."<br><br>";
						$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
						$updateqryresult = ExecQuery($updateqry);
						echo $updateqry."<br><br>";
					}
				}
		}
	}
}
//Common Function Lead Transfer End


?>