<?php
require 'scripts/db_init.php';

RBLcardslms();


function RBLcardslms()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	echo "q 1: ".$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='rblcallerlms_cc' and Status=1";
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
	print_r($BidderIDArr);

	echo $BidderIDStr = implode(',', $BidderIDArr);

echo "<br><br>q 2: ".$startprocess="Select total_no_agents,last_allocated_to,total_lead_count From lead_allocation_table Where (Citywise='rblcallerlms_cc' and BidderID=4905)";
//echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$last_allocated_to = $row["last_allocated_to"];
$total_lead_count = $row["total_lead_count"];
$total_no_agents = $row["total_no_agents"];

if($total_lead_count>0)
{
	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=4905 and Feedback_ID>'".$total_lead_count."' and (DATE_SUB( NOW() , INTERVAL '00:40' HOUR_MINUTE ) >= Allocation_Date)) LIMIT 0,3";
}
else
{
	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=4905 and (DATE_SUB( NOW() , INTERVAL '00:40' HOUR_MINUTE ) >= Allocation_Date)) LIMIT 0,3";
}
echo "<br><br>q 3: ".$sbiccqry."<br>";

$smsplqryresult = ExecQuery($sbiccqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	$Feedback_ID = $row2["Feedback_ID"];
	
	if($AllRequestID>0)
	{
			if($total_no_agents>$last_allocated_to)
			{
				$sequence=$last_allocated_to+1;
			}
			else
			{
				$sequence=1;
			}
			$sequenceqry=ExecQuery("SELECT * FROM `credit_card_banks_apply` WHERE (cc_requestid='".$AllRequestID."' and `applied_bankname` like '%RBL%' and (response_data like '%Status -1%' or response_data like '%Status -3%'))");
			$seqccid = mysql_fetch_array($sequenceqry);
			if($seqccid["cc_requestid"]>0)
			{
			}
			else
			{
			echo "<br><br>q 5:".$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and  BidderID in (".$BidderIDStr."))";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				echo $bidderID = $BidderIDArr[$sequence];	
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					echo "<br><br>";
					echo "<br><br>q 6:".$inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '0', Now());";
					//$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo "<br><br>q 7:".$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='rblcallerlms_cc' and BidderID=4905)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			
			}
		}
			$getCheckNum = '';
	}
}
}


?>