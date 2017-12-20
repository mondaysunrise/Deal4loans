<?php
require 'scripts/db_init.php';

function bajajfinallocate()
{
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='calllmsbajajfinservpl' and BidderID=2454)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	//2422,5888,5976,2423,3966,3967,5458,2424,6001,2425,3645,3842,5656,2426,4656,2427,2428,2429,3335,3953,2430,2431,2432,2433,4631,2434,2435,2436,2437,2438,2439,2440,2441,5637,5636,5638,5682,2442,2443,2444,2445,2446,2447,2448,5681,2449,2450,2451,2476,3629,4912,5736,4911,4910,5074,5078,5457,4928,5419,5741,5740

	$smsplqry="SELECT Feedback_ID, Allocation_Date, AllRequestID FROM Req_Feedback_Bidder_PL WHERE (Req_Feedback_Bidder_PL.BidderID in (2422,5888,5976,2423,3966,5458,2424,6001,2426,4656,2427,2428,2429,335,2430,2431,2442,2444,2447,5074,5741,5740,2438,2439,2447) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Feedback_ID >'".$total_lead_count."' and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."') order by Feedback_ID ASC";
}
$smsplqryresult = ExecQuery($smsplqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	$FeedbackID = $row2["Feedback_ID"];
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	
	if($AllRequestID>0)
	{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='calllmsbajajfinservpl' and BidderID=2454)");
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
			
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID =6029)";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				if($sequence==1){$bidderID="6029";}
				else {$bidderID = "0"; $sequence=0;}
		
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					echo "<br><br>";
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$FeedbackID."' Where  (Citywise='calllmsbajajfinservpl' and BidderID=2454)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}			
			}
			$getCheckNum = '';
	}
}
} // BAJaj Finserv

function kotakbankplallocate()
{
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='calllmskotakbankpl' and BidderID=2997)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	$smsplqry="SELECT Feedback_ID, Allocation_Date, AllRequestID FROM Req_Feedback_Bidder_PL WHERE (Req_Feedback_Bidder_PL.BidderID in (2998,2999,3000,3004,3008,3009,5386,5566,5889,5916,5920,5353) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Feedback_ID >'".$total_lead_count."' and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."') order by Feedback_ID ASC";
}
$smsplqryresult = ExecQuery($smsplqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	$FeedbackID = $row2["Feedback_ID"];
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	
	if($AllRequestID>0)
	{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='calllmskotakbankpl' and BidderID=2997)");
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
			
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID =6031)";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				if($sequence==1){$bidderID="6031";}
				else {$bidderID = "0"; $sequence=0;}
		
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					echo "<br><br>";
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$FeedbackID."' Where  (Citywise='calllmskotakbankpl' and BidderID=2997)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}			
			}
			$getCheckNum = '';	}
}
}//Kotak Bank


function indusindplallocate()
{
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='calllmsindusindbankpl' and BidderID=4093)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	$smsplqry="SELECT Feedback_ID, Allocation_Date, AllRequestID FROM Req_Feedback_Bidder_PL WHERE (Req_Feedback_Bidder_PL.BidderID in (4083,4084,5815,4085,5884,4086,5409,5410,4087,4088,4089,5413,5414,5415,4090,4091,4092,4092,4092,4092,5168,5937) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Feedback_ID >'".$total_lead_count."' and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."') order by Feedback_ID ASC";
}
$smsplqryresult = ExecQuery($smsplqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	$FeedbackID = $row2["Feedback_ID"];
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	
	if($AllRequestID>0)
	{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='calllmsindusindbankpl' and BidderID=4093)");
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
			
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID = 6030)";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				if($sequence==1){$bidderID="6030";}
				else {$bidderID = "0"; $sequence=0;}
		
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					echo "<br><br>";
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$FeedbackID."' Where  (Citywise='calllmsindusindbankpl' and BidderID=4093)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}			
			}
			$getCheckNum = '';	}
}
}//Indus Ind

function hdfcbankplallocate()
{
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-2, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='calllmshdfcbanksmlctypl' and BidderID=5373)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	$smsplqry="SELECT Feedback_ID, Allocation_Date, AllRequestID FROM Req_Feedback_Bidder_PL WHERE (Req_Feedback_Bidder_PL.BidderID in (4931,4933,4935,4939,5066,5508,4943,4946,5649,4950,5374,4951,4954,4936,4959,4960,4963,4964,4970,4971,4975,4976,4977,4980,5067) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Feedback_ID >'".$total_lead_count."' and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."') order by Feedback_ID ASC";
}
$smsplqryresult = ExecQuery($smsplqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	$FeedbackID = $row2["Feedback_ID"];
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	
	if($AllRequestID>0)
	{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='calllmshdfcbanksmlctypl' and BidderID=5373)");
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
			
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID =6032)";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				if($sequence==1){$bidderID="6032";}
				//elseif($sequence==2){$bidderID="6033";}
				else {$bidderID = "0"; $sequence=0;}
		
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					echo "<br><br>";
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$FeedbackID."' Where  (Citywise='calllmshdfcbanksmlctypl' and BidderID=5373)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}			
			}
			$getCheckNum = '';	}
}
}//hdfc small city one

function hdfcbankplallocate2()
{
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-2, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='calllmshdfcbanksmlctypl2' and BidderID=5373)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	$smsplqry="SELECT Feedback_ID, Allocation_Date, AllRequestID FROM Req_Feedback_Bidder_PL WHERE (Req_Feedback_Bidder_PL.BidderID in (4932,4934,6000,5975,4940,5941,4952,4955,5942,4957,5962,4966,5978,5971,5979) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Feedback_ID >'".$total_lead_count."' and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."') order by Feedback_ID ASC";
}
$smsplqryresult = ExecQuery($smsplqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	$FeedbackID = $row2["Feedback_ID"];
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	
	if($AllRequestID>0)
	{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='calllmshdfcbanksmlctypl2' and BidderID=5373)");
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
			
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID =6033)";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				if($sequence==1){$bidderID="6033";}
				else {$bidderID = "0"; $sequence=0;}
		
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					echo "<br><br>";
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$FeedbackID."' Where  (Citywise='calllmshdfcbanksmlctypl2' and BidderID=5373)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}			
			}
			$getCheckNum = '';	}
}
}// hdfc small city 2

function fullertonplallocate()
{
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='calllmsfullertonsmlctypl' and BidderID=2679)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	$smsplqry="SELECT Feedback_ID, Allocation_Date, AllRequestID FROM Req_Feedback_Bidder_PL WHERE (Req_Feedback_Bidder_PL.BidderID in (1029,4667,4641,4641,1546,1221,4658,5966,4642,5915,1223,1480,1096,1343,1857,1204,5917,4643,1125,5690,1162,1339,4666,5106,5429,1025,4665,1167,4644,1163,1342,1871,4645,1284,1295,5938,1294,5379,1215,5992,5661,1351,1338,4770,1365,1515,5918) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Feedback_ID >'".$total_lead_count."' and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."') order by Feedback_ID ASC";
}
$smsplqryresult = ExecQuery($smsplqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	$FeedbackID = $row2["Feedback_ID"];
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	
	if($AllRequestID>0)
	{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='calllmsfullertonsmlctypl' and BidderID=2679)");
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
			
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID =6043)";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				if($sequence==1){$bidderID="6043";}
				else {$bidderID = "0"; $sequence=0;}
		
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					echo "<br><br>";
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$FeedbackID."' Where  (Citywise='calllmsfullertonsmlctypl' and BidderID=2679)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}			
			}
			$getCheckNum = '';	}
}
}

main();

function main()
{
	bajajfinallocate();
	kotakbankplallocate();
	indusindplallocate();
	hdfcbankplallocate();
	hdfcbankplallocate2();
	fullertonplallocate();
}


?>