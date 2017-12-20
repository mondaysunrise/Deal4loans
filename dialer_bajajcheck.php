<?php
require 'scripts/db_init.php';
bajaj6290();

function bajaj6290()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='Bajajfinserv' and BidderID=6290 and Reply_Type=1)";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["RequestID"];
	$getBidderIDSql = "select BidderID from Bidders where Global_Access_ID like '%6290%'";
	$getBidderIDQuery = ExecQuery($getBidderIDSql);
	$numgetBidderID = mysql_num_rows($getBidderIDQuery);
	$BidderIDArr = '';
	
	for($i=0;$i<$numgetBidderID;$i++)
	{
		$BidderIDArr[] = mysql_result($getBidderIDQuery,$i,'BidderID');
	}
	$BidderIDStr = implode(',' , $BidderIDArr);
	
	if($total_lead_count>0 && $numgetBidderID>0)
	{
		$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_PL Where (BidderID in (".$BidderIDStr.") and  Feedback_ID>'".$total_lead_count."')";
	}
//	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from Req_Feedback_Bidder_PL Where (BidderID in (2426, 4656, 2435, 2437, 2441, 5637, 5636, 5638, 5682, 2444, 2445, 2448, 5681, 2449, 2450, 2451, 2476, 3629, 4912, 5074, 5078, 5457, 4928, 5741, 5740, 5984, 5981, 5982, 6152, 5983, 6154, 5985, 6155, 6153, 5986, 6151, 5987, 5988) and Allocation_Date>'2016-06-01 00:00:00' and Allocation_Date<'2016-06-28 23:59:59' ) order by Allocation_Date asc";
	echo "6290 ".$sbiccqry."<br>";
	//$sbiccqry="select AllRequestID,Allocation_Date from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Allocation_Date between '2015-08-25 00:00:00' and '2015-08-26 23:59:59') ";
	
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
	
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["AllRequestID"];
		$Allocation_Date = $row2["Allocation_Date"];
		$Feedback_ID = $row2["Feedback_ID"];
		if($AllRequestID>0)
		{
			$bidderID="6290";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
			//	$inserticiciqryresult = ExecQuery($inserticiciqry);
echo  $inserticiciqry."<br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='Bajajfinserv' and BidderID=6290 and Reply_Type=1)";
			//	$updateqryresult = ExecQuery($updateqry);
				echo $updateqry."<br>";
			}
		}
	}
}



?>