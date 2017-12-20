<?php
require 'scripts/db_init.php';
function citibankpl6328()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='CitibankCallerPL' and BidderID=6328)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
echo $total_lead_count = $row["total_lead_count"];

$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6328)");
while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
echo $trbidder=implode("','",$arrBidderID);

if($total_lead_count>0)
{
	$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') LIMIT 0,2";
}
else
{
	$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') LIMIT 0,2";
}
echo $citibankplqry."<br>";
$citiplqryresult = ExecQuery($citibankplqry);
$recordcount1 = mysql_num_rows($citiplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($citiplqryresult))
{
	echo "i m here";
	$Feedback_ID = $row2["Feedback_ID"];
	$AllRequestID = $row2["AllRequestID"];
	$BidderID = $row2["BidderID"];
	$Allocation_Date = $row2["Updated_Date"];
	
	if($AllRequestID>0)
	{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CitibankCallerPL' and BidderID=6328)");
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
			
			$getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				if($sequence==1){$callerID="6326";}
				elseif($sequence==2){$callerID="6327";}			
				else {$callerID = "0"; $sequence=0;}	
	
				if($AllRequestID>0 && $callerID>1)
				{
					//insert allocation
					echo $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
					$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='CitibankCallerPL' and BidderID=6328)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			
			}
			$getCheckNum = '';
	}
}
}

citibankpl6328();
?>