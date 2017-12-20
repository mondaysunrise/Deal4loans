<?php
ini_set('max_execution_time', 300);
require 'scripts/db_init.php';

function sbicc5633()
{
//$currentdate=Date('Y-m-d');
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='SBI' and BidderID=5633)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["RequestID"];
$selectedalready="";
if($total_lead_count>0)
{
	//19april16
	/*$alredyqry=ExecQuery("Select cc_requestid from sbi_credit_card_5633_log_direct Where ((ProcessingStatus=1 or ProcessingStatus=7) and first_dated between '".$min_date."' and '".$max_date."') group by cc_requestid order by first_dated DESC");
	while($rowal = mysql_fetch_array($alredyqry))
	{
		$selectedalready[] =$rowal["cc_requestid"];
	}
	$selectedalreadystr = implode(",",$selectedalready);*/
	//
//	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Feedback_ID=1516114)";
	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Feedback_ID>'".$total_lead_count."' and (DATE_SUB( NOW() , INTERVAL '00:40' HOUR_MINUTE ) >= Allocation_Date))";
}
//$sbiccqry="select AllRequestID,Allocation_Date from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Allocation_Date between '2015-08-25 00:00:00' and '2015-08-26 23:59:59') ";
echo $sbiccqry."<br>";
$select4mcardsresult = ExecQuery($sbiccqry);
$recordcount1 = mysql_num_rows($select4mcardsresult);
$bidderID="";

while($row2 = mysql_fetch_array($select4mcardsresult))
{
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	$Feedback_ID = $row2["Feedback_ID"];

	 $sequenceqry=ExecQuery("Select cc_requestid from sbi_credit_card_5633_log_direct Where ((ProcessingStatus=1 or ProcessingStatus=7) and cc_requestid=".$AllRequestID.") group by cc_requestid order by first_dated DESC");
	 $seqccid = mysql_fetch_array($sequenceqry);
	//if($AllRequestID>0)
	if($seqccid["cc_requestid"]>0)
	{
	}
	else
	{	//sbi selected
		 $sequenceid=ExecQuery("Select RequestID,source from Req_Credit_Card Where (applied_card_name like '%SBI%' and RequestID=".$AllRequestID.")");
		$seqid = mysql_fetch_array($sequenceid);
		
			if($seqid["RequestID"]>0)
			{
				$bidderID="5657";
			}
			else
			{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='callerlms_cc' and BidderID=5658)");
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

				//$bidderID="5658";
				if($sequence==1){$bidderID="5658";}
				elseif($sequence==2){$bidderID="6702";}
				elseif($sequence==3){$bidderID="6703";}
				elseif($sequence==4){$bidderID="6704";}
				elseif($sequence==5){$bidderID="6705";}
				elseif($sequence==6){$bidderID="6706";}
				elseif($sequence==7){$bidderID="6707";}
				elseif($sequence==8){$bidderID="6708";}
				elseif($sequence==9){$bidderID="6709";}
				elseif($sequence==10){$bidderID="7019";}
				elseif($sequence==11){$bidderID="7020";}
				elseif($sequence==12){$bidderID="7021";}
				elseif($sequence==13){$bidderID="7134";}
				elseif($sequence==14){$bidderID="7135";}
				elseif($sequence==15){$bidderID="7136";}
				else {$bidderID = "0"; $sequence=0;}

				$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='callerlms_cc' and BidderID=5658)";
				$updateqryresult = ExecQuery($updateqry);
			}
		
			if($AllRequestID>0 && $bidderID>1)
			{
			 	$getBlockBiddersSql = "select BidderID from Bidders where leadidentifier in ('amexcallerlms_cc','diallerleadcc','CCTRANSFER2CALLER')";
				$getBlockBiddersQry = ExecQuery($getBlockBiddersSql);
				$recordCountBlockBidders = mysql_num_rows($getBlockBiddersQry);
				$BidderIDBlockArr = '';
				$counterValBlock = 1;
				for($i=0;$i<$recordCountBlockBidders;$i++)
				{
					$BidderIDBlock = mysql_result($getBlockBiddersQry,$i,'BidderID');
					$BidderIDBlockArr[$counterBlockVal] = $BidderIDBlock;
					$counterBlockVal = $counterBlockVal + 1;
				}
				//print_r($BidderIDArr);
			
				 $BidderIDBlockStr = implode(',', $BidderIDBlockArr);

				 

				$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and  BidderID in (".$BidderIDBlockStr."))";
				echo "<br>".$getCheckSQl."<br>";
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					//insert allocation
					//echo "<br><br>";
					 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '0', '".$Allocation_Date."');";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
	echo "<br><br>";
					 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='SBI' and BidderID=5633)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			}
	}
}
}

//SBI cc sms compaign
function sbicc6088()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='SBI' and BidderID=6088 and Reply_Type=4)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["RequestID"];

if($total_lead_count>0)
{
//	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Feedback_ID=1516114)";
	$sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card Where (source='SMS_Lead' and RequestID>'".$total_lead_count."')";
}
//$sbiccqry="select AllRequestID,Allocation_Date from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Allocation_Date between '2015-08-25 00:00:00' and '2015-08-26 23:59:59') ";

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
			$bidderID="6088";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				//insert allocation
				//echo "<br><br>";
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo "<br><br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='SBI' and BidderID=6088 and Reply_Type=4)";
				$updateqryresult = ExecQuery($updateqry);
				echo "<br><br>";
			}
	}
}
}
//sbi cc campaogn end

function smspl_appmodel5926()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='SMS_APP_MODEL_PL' and BidderID=5926)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
echo $total_lead_count = $row["total_lead_count"];

if($total_lead_count>0)
{
	//$smsplqry="select RequestID,Updated_Date from  Req_Loan_Personal Where (source in ('SMS_Lead_Appointment_Model', 'mywishbankPL', 'mywishbankchat', 'wishfinPL', 'wishfinchat') and RequestID>'".$total_lead_count."' and Updated_Date  between '".$min_date."' and '".$max_date."')";
	$smsplqry="select RequestID,Updated_Date from  Req_Loan_Personal Where (source in ('SMS_Lead_Appointment_Model') and RequestID>'".$total_lead_count."' and Updated_Date  between '".$min_date."' and '".$max_date."')";
}
else
{
	/*$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Allocation_Date between '".$min_date."' and '".$max_date."')";*/
}
//$sbiccqry="select AllRequestID,Allocation_Date from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Allocation_Date between '2015-08-25 00:00:00' and '2015-08-26 23:59:59') ";
echo $smsplqry."<br>";

$smsplqryresult = ExecQuery($smsplqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	echo "hello";
	$AllRequestID = $row2["RequestID"];
	$Allocation_Date = $row2["Updated_Date"];
	
	if($AllRequestID>0)
	{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='SMS_APP_MODEL_PL' and BidderID=5926)");
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
			
			$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' ";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				if($sequence==1){$bidderID="5929";}
			//	elseif($sequence==2){$bidderID="5930";}
				elseif($sequence==2){$bidderID="5931";}
				elseif($sequence==3){$bidderID="5959";}
				elseif($sequence==4){$bidderID="5960";}
				//elseif($sequence==6){$bidderID="5973";}
				else {$bidderID = "0"; $sequence=0;}
	
	
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					echo "<br><br>";
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='SMS_APP_MODEL_PL' and BidderID=5926)";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			
			}
			$getCheckNum = '';
	}
}
}

function hdfc6116()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='HDFC Bank' and BidderID=6116 and Reply_Type=1)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["RequestID"];

if($total_lead_count>0)
{
	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_PL Where (BidderID in (4931,4933,4935,4936,4939,4943,4946,4948,4951,4954,4959,4960,4962,4963,4967,4970,4971,4975,4976,4977,4980,4995,5000,5001,5012,5013,5015,5023,5028,5029,5033,5034,5036,5038,5047,5048,5049,5056,5057,5058,5061,5063,5066,5067,5963,5964,5968,5974,5975,6003,6035,6036,6037,6038,6039,6040,6057,6059,6060,6061,6062,6063,6064,6065,6066,6067,6068,6069,6070,6071,6072,6073,6074,6075,6076,6077,6087) and Feedback_ID>'".$total_lead_count."')";
}
//$sbiccqry="select AllRequestID,Allocation_Date from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Allocation_Date between '2015-08-25 00:00:00' and '2015-08-26 23:59:59') ";
echo "6116 ".$sbiccqry."<br>";
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
			$bidderID="6116";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				//insert allocation
				//echo "<br><br>";
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo "<br><br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='HDFC Bank' and BidderID=6116 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo "<br><br>";
			}
	}
}
}

function hdfc6117()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='HDFC Bank' and BidderID=6117 and Reply_Type=1)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["RequestID"];

if($total_lead_count>0)
{
	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_PL Where (BidderID in (4932,4934,4937,4940,4949,4952,4955,4957,4966,4969,4972,4990,5002,5003,5004,5006,5007,5009,5010,5016,5017,5021,5025,5026,5027,5043,5046,5051,5055,5060,5064,5745,5791,5941,5962,5967,5970,5971,5972,5977,5989,6004,6005,6006,6041,6042,6049,6050,6051,6052,6053,6054,6055,6056,6079,6080,6081,6083,6084,6085,6086) and  Feedback_ID>'".$total_lead_count."')";
}
echo "6117 ".$sbiccqry."<br>";
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
			$bidderID="6117";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				//insert allocation
				//echo "<br><br>";
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo "<br><br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='HDFC Bank' and BidderID=6117 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo "<br><br>";
			}
	}
}
}

function hdfc6120()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = date('Y-m-d H:i:s', strtotime('-2 hour'));


$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='BL Leads' and BidderID=6120 and Reply_Type=1)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["RequestID"];

if($total_lead_count>0)
{
//	$sbiccqry="SELECT  RequestID,Updated_Date as Allocation_Date from Req_Loan_Personal WHERE (((Req_Loan_Personal.Updated_Date Between '".$min_date."' and '".$max_date."' )) and Req_Loan_Personal.Allocated=0  AND Req_Loan_Personal.Employment_Status =0 and (Req_Loan_Personal.City in ('Ahmedabad','Ajmer','Alwar','Aurangabad','Bangalore','Baroda','Chandigarh','Chennai','Cochin','Coimbatore','Delhi','Goa','Guntur','Hosur','Hyderabad','Jaipur','Kanpur','Kolkata','Kota','Kottayam','Ludhiana','Mumbai','Nagpur','Nasik','Pune','Rajkot','Salem','Surat','Tirupur','Trichur','Trichy','Trivandrum','Vijayawada','Vizag','Gurgaon','Faridabad','Noida','Vishakhapatnam') or Req_Loan_Personal.City_Other in ('Ahmedabad','Ajmer','Alwar','Aurangabad','Bangalore','Baroda','Chandigarh','Chennai','Cochin','Coimbatore','Delhi','Goa','Guntur','Hosur','Hyderabad','Jaipur','Kanpur','Kolkata','Kota','Kottayam','Ludhiana','Mumbai','Nagpur','Nasik','Pune','Rajkot','Salem','Surat','Tirupur','Trichur','Trichy','TrivandrumÃ‚Â Ã‚Â Ã‚Â Ã‚Â ','Vijayawada','Vizag','Gurgaon','Faridabad','Noida','Vishakhapatnam'))) and Req_Loan_Personal.RequestID>'".$total_lead_count."' ";
	
	
$sbiccqry="SELECT  RequestID,Updated_Date as Allocation_Date from Req_Loan_Personal WHERE (((Req_Loan_Personal.Updated_Date Between '".$min_date."' and '".$max_date."' )) and Req_Loan_Personal.Allocated=0  AND Req_Loan_Personal.Employment_Status =0 and (Req_Loan_Personal.City in ('Ahmedabad', 'Ajmer', 'Alwar', 'Aurangabad', 'Bangalore', 'Baroda', 'Bhopal', 'Chandigarh', 'Chennai', 'Cochin', 'Coimbatore', 'Dehradun', 'Delhi', 'Goa', 'Guntur', 'Hosur', 'Hyderabad', 'Indore', 'Jaipur', 'Jalandhar', 'Kanpur', 'Kolkata', 'Kota', 'Kottayam', 'Ludhiana', 'Mumbai', 'Nagpur', 'Nasik', 'Patiala', 'Pune', 'Rajkot', 'Salem', 'Surat', 'Tirupur', 'Trichur', 'Trichy', 'Trivandrum ', 'Udaipur', 'Vijayawada', 'Visakapatnam', 'Vizag', 'Vishakhapatnam','Gurgaon','Faridabad','Noida') or Req_Loan_Personal.City_Other in ('Ahmedabad', 'Ajmer', 'Alwar', 'Aurangabad', 'Bangalore', 'Baroda', 'Bhopal', 'Chandigarh', 'Chennai', 'Cochin', 'Coimbatore', 'Dehradun', 'Delhi', 'Goa', 'Guntur', 'Hosur', 'Hyderabad', 'Indore', 'Jaipur', 'Jalandhar', 'Kanpur', 'Kolkata', 'Kota', 'Kottayam', 'Ludhiana', 'Mumbai', 'Nagpur', 'Nasik', 'Patiala', 'Pune', 'Rajkot', 'Salem', 'Surat', 'Tirupur', 'Trichur', 'Trichy', 'Trivandrum', 'Udaipur', 'Vijayawada', 'Visakapatnam', 'Vizag', 'Vishakhapatnam','Gurgaon','Faridabad','Noida'))) and Req_Loan_Personal.RequestID>'".$total_lead_count."' ";	
}
//$sbiccqry="SELECT  RequestID,Update_Date from ".TABLE_REQ_LOAN_PERSONAL." WHERE (((".TABLE_REQ_LOAN_PERSONAL.".Updated_Date Between '".$min_date."' and '".$max_date."' )) and ".TABLE_REQ_LOAN_PERSONAL.".Allocated=0  AND ".TABLE_REQ_LOAN_PERSONAL.".Employment_Status =0)";
//$sbiccqry = "SELECT RequestID,Updated_Date as Allocation_Date  from Req_Loan_Personal WHERE (((Req_Loan_Personal.Updated_Date Between '2016-04-26 00:00:00' and '2016-04-28 23:22:40' )) and Req_Loan_Personal.Allocated=0 AND Req_Loan_Personal.Employment_Status =0)";
echo "6120 ".$sbiccqry."<br>";
//exit();
$select4mcardsresult = ExecQuery($sbiccqry);
$recordcount1 = mysql_num_rows($select4mcardsresult);
$bidderID="";

while($row2 = mysql_fetch_array($select4mcardsresult))
{
	$AllRequestID = $row2["RequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	$Feedback_ID = $row2["RequestID"];
	if($AllRequestID>0)
	{
			$bidderID="6120";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				//insert allocation
				//echo "<br><br>";
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo "<br><br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='BL Leads' and BidderID=6120 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo "<br><br>";
			}
	}
}
}

function bajaj6253()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='Bajajfinserv' and BidderID=6253 and Reply_Type=1)";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["RequestID"];
	$getBidderIDSql = "select BidderID from Bidders where Global_Access_ID like '%6253%'";
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
//	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from Req_Feedback_Bidder_PL Where (BidderID in (".$BidderIDStr.") and Allocation_Date>'2016-05-03 00:00:00' and Allocation_Date<'2016-06-03 23:59:59' )";
	echo "6253 ".$sbiccqry."<br>";
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
			$bidderID="6253";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo  $inserticiciqry."<br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='Bajajfinserv' and BidderID=6253 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo $updateqry."<br>";
			}
		}
	}
}

function bajaj6252()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='Bajajfinserv' and BidderID=6252 and Reply_Type=1)";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["RequestID"];
	$getBidderIDSql = "select BidderID from Bidders where Global_Access_ID like '%6252%'";
	echo $getBidderIDSql."<br>";
	$getBidderIDQuery = ExecQuery($getBidderIDSql);
	$numgetBidderID = mysql_num_rows($getBidderIDQuery);
	echo "numgetBidderID - ".$numgetBidderID."<br>";
	$BidderIDArr = '';
	for($i=0;$i<$numgetBidderID;$i++)
	{
		$BidderIDArr[] = mysql_result($getBidderIDQuery,$i,'BidderID');
	}
	$BidderIDStr = implode(',' , $BidderIDArr);
	echo "BidderIDStr - ".$BidderIDStr."<br>";
	if($total_lead_count>0 && $numgetBidderID>0)
	{
		$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from Req_Feedback_Bidder_PL Where (BidderID in (".$BidderIDStr.") and  Feedback_ID>'".$total_lead_count."')";
	}
	//	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from Req_Feedback_Bidder_PL Where (BidderID in (".$BidderIDStr.") and Allocation_Date>'2016-05-03 00:00:00' and Allocation_Date<'2016-06-03 23:59:59' )";
	echo "6252 ".$sbiccqry."<br>";
	//$sbiccqry="select AllRequestID,Allocation_Date from  Req_Feedback_Bidder_CC Where (BidderID=5633 and Allocation_Date between '2015-08-25 00:00:00' and '2015-08-26 23:59:59') ";
	
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
	echo "recordcount1 - ".$recordcount1."<br>";
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["AllRequestID"];
		$Allocation_Date = $row2["Allocation_Date"];
		$Feedback_ID = $row2["Feedback_ID"];
		if($AllRequestID>0)
		{
			$bidderID="6252";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				//insert allocation
				//echo "<br><br>";
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo  $inserticiciqry."<br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='Bajajfinserv' and BidderID=6252 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo $updateqry."<br>";
			}
		}
	}
}

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
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo  $inserticiciqry."<br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='Bajajfinserv' and BidderID=6290 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo $updateqry."<br>";
			}
		}
	}
}
function bajaj7230()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='Bajajfinserv' and BidderID=7230 and Reply_Type=1)";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["RequestID"];
	$getBidderIDSql = "select BidderID from Bidders where Global_Access_ID like '%7230%'";
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
//	

	echo "7230 ".$sbiccqry."<br>";
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
			$bidderID="7230";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo  $inserticiciqry."<br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='Bajajfinserv' and BidderID=7230 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo $updateqry."<br>";
			}
		}
	}
}
function bajaj7347()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='Bajajfinserv' and BidderID=7347 and Reply_Type=1)";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["RequestID"];
	$getBidderIDSql = "select BidderID from Bidders where Global_Access_ID like '%7347%'";
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
//	

	echo "7347 ".$sbiccqry."<br>";
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
			$bidderID="7347";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo  $inserticiciqry."<br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='Bajajfinserv' and BidderID=7347 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo $updateqry."<br>";
			}
		}
	}
}

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
	$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
}
else
{
	$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
}
echo $citibankplqry."<br>";
$citiplqryresult = ExecQuery($citibankplqry);
$recordcount1 = mysql_num_rows($citiplqryresult);
$bidderID="";

$counterVal = 1;
$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6357 and Status=1) order by BidderID ASC");
while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}

while($row2 = mysql_fetch_array($citiplqryresult))
{
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
				/*if($sequence==1){$callerID="6326";}
				elseif($sequence==2){$callerID="6327";}			
				else {$callerID = "0"; $sequence=0;}*/	
				$callerID = $arrCallerrID[$sequence];

				if($AllRequestID>0 && $callerID>1)
				{
					//insert allocation
					 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
					$final_allocationcitiresult = ExecQuery($final_allocationciti);
				$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='CitibankCallerPL' and BidderID=6328)";
				echo "<br><br>";
				$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			
			}
			$getCheckNum = '';
	}
}
}


// Start Coimbatore ICCS Calling Process
function citypl()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='CallerAccountCity' and lead_allocation_logic=50)";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	echo "<br>";
	$arrbidderqry=ExecQuery("Select BidderID, City from Bidders Where (Global_Access_ID=6376)");
	$rowbid=mysql_fetch_array($arrbidderqry);
	$mainBidderID = $rowbid["BidderID"];
	$mainCity = $rowbid["City"];
	$CityArr = explode(",",$mainCity);
	$CityStr = implode("','",$CityArr);
	
	$qryExcludeSourceCallingSql = "SELECT * FROM exclude_source_calling where 1=1 and reply_type=1 and status=1";
	$qryExcludeSourceCallingQuery =ExecQuery($qryExcludeSourceCallingSql);;
	$qryExcludeSourceCallingNum = mysql_num_rows($qryExcludeSourceCallingQuery);
	$excludeSourceC = '';
	$excludeSourceC .= "( Req_Loan_Personal.ex_source!='below60k' ";
	for($j=0;$j<$qryExcludeSourceCallingNum;$j++)
	{	
		$source_eSC =  mysql_result($qryExcludeSourceCallingQuery,$j,'source');
		$excludeSourceC .= " and Req_Loan_Personal.source!='".$source_eSC."' ";
	}
	$excludeSourceC .= $excludeSource."  )";
	
	if($total_lead_count>0)
	{
		$cityQry="select RequestID, Updated_Date as Allocation_Date from Req_Loan_Personal where (".$excludeSourceC."  and Req_Loan_Personal.Allocated=0 and RequestID>'".$total_lead_count."'  and Req_Loan_Personal.City in ('".$CityStr."'))  order by RequestID asc";
	}
	
//	$cityQry="select RequestID, Updated_Date as Allocation_Date from Req_Loan_Personal where (".$excludeSourceC."  and Req_Loan_Personal.Allocated=0 and RequestID>'".$total_lead_count."'  and Req_Loan_Personal.City in ('".$CityStr."')) order by RequestID asc";
//$cityQry="select RequestID, Updated_Date as Allocation_Date from Req_Loan_Personal where REquestID in (2243588)";
	echo $cityQry."<br>";
//	exit();
	$cityResult = ExecQuery($cityQry);
	echo $recordcount1 = mysql_num_rows($cityResult);
	$bidderID="";
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6376) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	
	while($row2 = mysql_fetch_array($cityResult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Allocation_Date"];
		$Feedback_ID = $row2["RequestID"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CallerAccountCity' and lead_allocation_logic=50)");
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
				
			$getCheckSQl = "select Feedback_ID from lead_allocate where (Feedback_ID = '".$Feedback_ID."' and BidderID=".$BidderID.")";
			
				$getCheckQuery = ExecQuery($getCheckSQl);
				$getCheckNum = mysql_num_rows($getCheckQuery);
				if($getCheckNum>0)
				{
					//Already Existing Lead
				}
				else
				{
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocation="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$callerID."', '1', '0', '".$Allocation_Date."');";;
						$final_allocationresult = ExecQuery($final_allocation);
						$updateProductSql = "update Req_Loan_Personal set Referrer='CallerAccountCity' where RequestID='".$AllRequestID."'";
						$updateProductQry = ExecQuery($updateProductSql);
					echo $final_allocation."<br><br>";
					echo $updateProductSql."<br><br>";
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='CallerAccountCity' and lead_allocation_logic=50)";
						$updateqryresult = ExecQuery($updateqry);
						echo $updateqry."<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} // End Coimbatore ICCS Calling Process


function external_leads_allocation_bl()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='blmainlms' and Status=1";
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
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='sms_bl_leads' and BidderID=6388)";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Loan_Personal Where ((source='sms_bl_leads' or source='AFL_SMS_FBSELF_PL') and RequestID>'".$total_lead_count."')";
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
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='sms_bl_leads' and BidderID=6388)");
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
			echo	$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")  ";
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
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
						$inserticiciqryresult = ExecQuery($inserticiciqry);
		echo  $inserticiciqry."<br><br>";
						$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='sms_bl_leads' and BidderID=6388)";
						$updateqryresult = ExecQuery($updateqry);
						echo $updateqry."<br><br>";
					}
				}
		}
	}
}

function citibankhl6356()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='CitibankCallerHL' and BidderID=6355)";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
echo $total_lead_count = $row["total_lead_count"];

$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6355)");
while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
echo $trbidder=implode("','",$arrBidderID);

if($total_lead_count>0)
{
	$citibankplqry="Select * From Req_Feedback_Bidder_HL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=2 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
}
else
{
	$citibankplqry="Select * From Req_Feedback_Bidder_HL Where (BidderID in ('".$trbidder."') and Reply_Type=2 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
}
echo $citibankplqry."<br>";
$citiplqryresult = ExecQuery($citibankplqry);
$recordcount1 = mysql_num_rows($citiplqryresult);
$bidderID="";

$counterVal = 1;
$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6356 and Status=1) order by BidderID ASC");
while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}

while($row2 = mysql_fetch_array($citiplqryresult))
{
	$Feedback_ID = $row2["Feedback_ID"];
	$AllRequestID = $row2["AllRequestID"];
	$BidderID = $row2["BidderID"];
	$Allocation_Date = $row2["Updated_Date"];
	
	if($AllRequestID>0)
	{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CitibankCallerHL' and BidderID=6355)");
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
				$callerID = $arrCallerrID[$sequence];

				if($AllRequestID>0 && $callerID>1)
				{
					//insert allocation
					 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','2', Now())";
					$final_allocationcitiresult = ExecQuery($final_allocationciti);
				$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='CitibankCallerHL' and BidderID=6355)";
				echo "<br><br>";
				$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			
			}
			$getCheckNum = '';
	}
}
}

//Start ICCS Business Loan Calling Process 
function external_leads_allocation_bl_OtherCities()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='agent_othermetros' and Status=1";// THis is to get Agents
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
	
	$getBiddersSql = "select BidderID,City from Bidders where leadidentifier='blmainlmsothermetros' and Status=1";// THis is to get Agents
	$getBiddersQry = ExecQuery($getBiddersSql);
	$recordCountBidders = mysql_num_rows($getBiddersQry);
	$City_List_Str = mysql_result($getBiddersQry,0,'City');
	$City_List =  str_replace(",", "', '", $City_List_Str);
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='blmainlmsothermetros' and lead_allocation_logic=57)";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$sbiccqry="select RequestID,Updated_Date,source,City,City_Other from  Req_Loan_Personal Where ((City in ('".$City_List."') or City_Other in ('".$City_List."')) and Net_Salary>=300000 and Employment_Status=0 and Allocated=0 and RequestID>'".$total_lead_count."')";
	}
//	echo $sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card_Sms Where (source='SMS_LeadNew')";
	echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	echo $recordcount1."<br>";
	$bidderID="";
//	exit();
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["City"];
		$City = $row2["City"];
		$City_Other = $row2["City_Other"];
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='blmainlmsothermetros' and lead_allocation_logic=57)");
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
//					$bidderID = 6299;
			$bidderID.", ".$AllRequestID;
				if($AllRequestID>0 && $bidderID>1)
				{
					//insert allocation
					//echo "<br><br>";
					 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					//echo  $inserticiciqry."<br><br>";
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='blmainlmsothermetros' and lead_allocation_logic=57)";
					$updateqryresult = ExecQuery($updateqry);
					//echo $updateqry."<br><br>";
				}
			}
		}
	}// whileloop
} //Start ICCS Business Loan Calling Process


//Start ICCS Business Loan Calling Process Delhi
function external_leads_allocation_bl_Delhi()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='blmainlms' and Status=1";// THis is to get Agents
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
			
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='blmainlmsmetros' and lead_allocation_logic=58)";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$City_List = "Delhi','Sahibabad','Ahmedabad','Chennai','Hyderabad','Kolkata','Pune','Surat','Mumbai','Jaipur";
		$sbiccqry="select RequestID,Updated_Date,source,City,City_Other from  Req_Loan_Personal Where ((City in ('".$City_List."') or City_Other in ('".$City_List."')) and Net_Salary>=300000 and Employment_Status=0 and source!='sms_bl_leads' and Allocated=0 and RequestID>'".$total_lead_count."')";
	}
//	echo $sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card_Sms Where (source='SMS_LeadNew')";
	echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	echo $recordcount1."<br>";
	$bidderID="";
	//exit();
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["RequestID"];
		$City = $row2["City"];
		$City_Other = $row2["City_Other"];
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='blmainlmsmetros' and lead_allocation_logic=58)");
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
		echo	$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")  ";
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
					 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
	echo  $inserticiciqry."<br><br>";
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='blmainlmsmetros' and lead_allocation_logic=58)";
					$updateqryresult = ExecQuery($updateqry);
					echo $updateqry."<br><br>";
				}
			}
		}
	}
} //Start ICCS Business Loan Calling Process Delhi



//Start ICCS Loan Against Property Calling Process Delhi
function external_leads_allocation_lap_Delhi()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='CallerLAP' and Status=1";// THis is to get Agents
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
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='LAPLeads' and lead_allocation_logic=63)";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$City_List = "Delhi', 'Noida','Gaziabad','Faridabad','Sahibabad','Gurgaon";
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Loan_Against_Property Where (City in ('".$City_List."') and RequestID>'".$total_lead_count."')";
	}

//$sbiccqry="select RequestID,Updated_Date,source from Req_Loan_Against_Property Where (City in ('Delhi', 'Noida','Gaziabad','Faridabad','Sahibabad','Gurgaon') and Updated_Date>'2016-10-07 00:00:00' ) and RequestID=138085";
	echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	echo $recordcount1."<br>";
	$bidderID="";
	//exit();
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["RequestID"];
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='LAPLeads' and lead_allocation_logic=63)");
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
		echo	$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")  ";
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
					 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '5', '0', '".$Allocation_Date."');";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
	echo  $inserticiciqry."<br><br>";
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='LAPLeads' and lead_allocation_logic=63)";
					$updateqryresult = ExecQuery($updateqry);
					echo $updateqry."<br><br>";
				}
			}
		}
	}
} //End ICCS Loan Against Property Calling Process Delhi







//Start Lead for Appointment Model from Wishfin
function pllead4Appointment()
{
	$leadidentifier= 'plalloclms';
	$lead_allocation_logic = 68;
	
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	echo "<br>";
	
	$allarrCallerrID='';
	$allcounterVal = 1;
	$allarrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."') order by BidderID ASC");
	while($allrowcal=mysql_fetch_array($allarrcallerqry))
	{
		$allarrCallerrID[$allcounterVal] = $allrowcal["BidderID"];
		$allcounterVal = $allcounterVal + 1;
	}
	echo "All Agents - ";
	echo $allarrCallerrIDStr=implode("','",$allarrCallerrID);// Get All Agents
	echo "<br>";

	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	echo "Enabled Agents - ";
	echo $arrCallerrIDStr=implode("','",$arrCallerrID);
	echo "<br>";	
	if($total_lead_count>0)
	{
		$smsplqry="select RequestID,Updated_Date from  Req_Loan_Personal Where ((source LIKE '%wf - Appointments%' AND source NOT LIKE 'wf - Appointments no match%') and RequestID>'".$total_lead_count."' and Updated_Date  between '".$min_date."' and '".$max_date."')";
	}
	echo $smsplqry."<br>";
	
//	die();
	$smsplqryresult = ExecQuery($smsplqry);
	$recordcount1 = mysql_num_rows($smsplqryresult);
	$bidderID="";
	
	while($row2 = mysql_fetch_array($smsplqryresult))
	{
		echo "hello";
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$DOE = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')");
		//	 echo "<br>"; echo "Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."')"; echo "<br>";
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
			
			$getCheckSQl = "select * from plcallinglms_allocation where AllRequestID = '".$AllRequestID."' and BidderID in ('".$allarrCallerrIDStr."')";
		//	 echo "<br>"; echo $getCheckSQl;  echo "<br>";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				$callerID = $arrCallerrID[$sequence];
				if($AllRequestID>0 && $callerID>1)
				{
					//insert allocation
					echo "<br><br>";

					echo $inserticiciqry="INSERT INTO plcallinglms_allocation (AllRequestID, BidderID, Allocation_Date, DOE, status) VALUES ('".$AllRequestID."', '".$callerID."', '".$Allocation_Date."', '".$DOE."','this is it')";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			
			}
			$getCheckNum = '';
		}
	}
}
//End Lead for Appointment Model from Wishfin

//Start Lead for Appointment Model from Data Upload
function plleadUpload4Appointment()
{
	$source = 'wf_appt_leads';
	$leadidentifier = 'plalloclms';
	$lead_allocation_logic = 69;

	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	//$allarrCallerrID='';
	$allcounterVal = 1;
	$allarrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."') order by BidderID ASC");
	while($allrowcal=mysql_fetch_array($allarrcallerqry))
	{
		$allarrCallerrID[$allcounterVal] = $allrowcal["BidderID"];
		$allcounterVal = $allcounterVal + 1;
	}
	echo "All Agents - ";
	echo $allarrCallerrIDStr=implode("','",$allarrCallerrID);// Get All Agents
	echo "<br>";

	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	echo "Enabled Agents - ";
	echo $arrCallerrIDStr=implode("','",$arrCallerrID);
	echo "<br>";
		
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."'  and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Loan_Personal Where (source='".$source."' and RequestID>'".$total_lead_count."' and Updated_Date  between '".$min_date."' and '".$max_date."')";
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
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."'  and lead_allocation_logic='".$lead_allocation_logic."')");
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
			$getCheckSQl = "select * from plcallinglms_allocation where AllRequestID = '".$AllRequestID."' and BidderID in ('".$allarrCallerrIDStr."')";
		//	 echo "<br>"; echo $getCheckSQl;  echo "<br>";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				$callerID = $arrCallerrID[$sequence];
				if($AllRequestID>0 && $callerID>1)
				{
					//insert allocation
					echo "<br><br>";

					echo $inserticiciqry="INSERT INTO plcallinglms_allocation (AllRequestID, BidderID, Allocation_Date, DOE, status) VALUES ('".$AllRequestID."', '".$callerID."', '".$Allocation_Date."', '".$Allocation_Date."','this is me')";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			
			}
		}
	}
}
//End Lead for Appointment Model from Data Upload


//Start ICCS Tata Capital Calling Process Pune
function tatabankplPune()
{
	$source = 'CallerAccountPTata';
	$lead_allocation_logic = 71;
	$Global_Access_ID = 6513;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	$recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End ICCS Tata Capital Calling Process Pune


//Start ABFL Bank Calling Process
function abflbankpl()
{
	$source = 'CallerAccountABFL';
	$lead_allocation_logic = 73;
	$Global_Access_ID = 6096;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	$recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End ABFL Bank Calling Process 

//Bajaj Process Start
function bajaj6684()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select RequestID From Req_Compaign Where (Bank_Name='Bajajfinserv' and BidderID=6684 and Reply_Type=1)";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["RequestID"];
	$getBidderIDSql = "select BidderID from Bidders where Global_Access_ID like '%6684%'";
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

	echo "6684 ".$sbiccqry."<br>";
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
			$bidderID="6684";			
		
			if($AllRequestID>0 && $bidderID>1)
			{
				 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
				$inserticiciqryresult = ExecQuery($inserticiciqry);
echo  $inserticiciqry."<br>";
				 $updateqry= "Update Req_Compaign set RequestID='".$Feedback_ID."' Where (Bank_Name='Bajajfinserv' and BidderID=6684 and Reply_Type=1)";
				$updateqryresult = ExecQuery($updateqry);
				echo $updateqry."<br>";
			}
		}
	}
}
//Bajaj Process

//Bajaj Finserv SMS Leads Start
function smsBajajFinserv()
{
	$leadidentifier= 'smsplbajajfinserv';
	$lead_allocation_logic = 76;
	
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	echo "<br>";
	
	$arrCallerrID='';
	$allcounterVal = 1;
	$allarrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$leadidentifier."' and Status=1) order by BidderID ASC");
	while($allrowcal=mysql_fetch_array($allarrcallerqry))
	{
		$arrCallerrID[$allcounterVal] = $allrowcal["BidderID"];
		$allcounterVal = $allcounterVal + 1;
	}
	echo "All Agents - ";
	echo $allarrCallerrIDStr=implode("','",$arrCallerrID);// Get All Agents
	echo "<br>";

		echo "<br>";	
	if($total_lead_count>0)
	{
		$smsplqry="select RequestID,Updated_Date from  Req_Loan_Personal Where ((source ='sms_pl_bajajfinserv') and RequestID>'".$total_lead_count."' and Updated_Date  between '".$min_date."' and '".$max_date."')";
	}
	echo $smsplqry."<br>";
	
//	die();
	$smsplqryresult = ExecQuery($smsplqry);
	$recordcount1 = mysql_num_rows($smsplqryresult);
	$bidderID="";
	
	while($row2 = mysql_fetch_array($smsplqryresult))
	{
		echo "hello";
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$DOE = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')");
		//	 echo "<br>"; echo "Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$leadidentifier."')"; echo "<br>";
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
			
			$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in ('".$allarrCallerrIDStr."')";
			 echo "<br>"; echo $getCheckSQl;  echo "<br>";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
				echo "In if condition";
			}
			else
			{
				echo "else ";
				echo $callerID = $arrCallerrID[$sequence];
				if($AllRequestID>0 && $callerID>1)
				{
					//insert allocation
					echo "<br><br>";


					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$callerID."', '1', '0', '".$Allocation_Date."');";

					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo "<br><br>";
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
					$updateqryresult = ExecQuery($updateqry);
					echo "<br><br>";
				}
			
			}
			$getCheckNum = '';
		}
	}
}
//Bajaj Finserv SMS Leads End
//RBL cards

function RBLcardslms()  // Not in use
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='rblcallerlms_cc' and Status=1";
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
	//print_r($BidderIDArr);

 $BidderIDStr = implode(',', $BidderIDArr);

$startprocess="Select lead_allocation_logic,total_no_agents,last_allocated_to,total_lead_count From lead_allocation_table Where (Citywise='rblcallerlms_cc' and BidderID=4905)";
//echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];
$lead_allocation_logic = $row["lead_allocation_logic"];

if($total_lead_count>0)
{
	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=4905 and Feedback_ID>'".$total_lead_count."' and (DATE_SUB( NOW() , INTERVAL '00:40' HOUR_MINUTE ) >= Allocation_Date) and Allocation_Date Between '".$min_date."' and '".$max_date."') LIMIT 0,4";
}
else
{
	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=4905 and (DATE_SUB( NOW() , INTERVAL '00:40' HOUR_MINUTE ) >= Allocation_Date) and Allocation_Date Between '".$min_date."' and '".$max_date."')  LIMIT 0,4";
}
//echo "<br><br>q 3: ".$sbiccqry."<br>";

$smsplqryresult = ExecQuery($sbiccqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	//echo "fff";
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	$Feedback_ID = $row2["Feedback_ID"];
	
	if($AllRequestID>0)
	{
			$sequenceqry=ExecQuery("SELECT id FROM `credit_card_banks_apply` WHERE (cc_requestid='".$AllRequestID."' and `applied_bankname` like '%RBL%' and (response_data like '%Status -1%' or response_data like '%Status -3%'))");
			$seqccid = mysql_fetch_array($sequenceqry);
			if($seqccid["cc_requestid"]>0)
			{
			}
			else
			{
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and  BidderID in (".$BidderIDStr."))";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='rblcallerlms_cc' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				echo $bidderID = $BidderIDArr[$sequence];	
				if($AllRequestID>0 && $bidderID>1)
				{					echo "<br><br>";
					//insert allocation
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '0', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='rblcallerlms_cc' and BidderID=4905)";
					$updateqryresult = ExecQuery($updateqry);
					//echo "<br><br>";
				}
			
			}
		}
		$getCheckNum = '';
			
	}
}
}//RBLcardslms

// cold calling RBL
function RBLcardslmsSMS()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";
$lead_allocation_logic = 80;


	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='rblcallerlms_cc' and Status=1";
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

$startprocess="Select lead_allocation_logic,total_no_agents,last_allocated_to,total_lead_count From lead_allocation_table Where (Citywise='rblcallerlms_cc_sms'  and lead_allocation_logic='".$lead_allocation_logic."')";
echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];
$lead_allocation_logic = $row["lead_allocation_logic"];

if($total_lead_count>0)
{
	$sbiccqry="select RequestID,Updated_Date from Req_Credit_Card Where (RequestID>'".$total_lead_count."' and source='SMS_Lead_RBL' and Updated_Date Between '".$min_date."' and '".$max_date."') LIMIT 0,4";
}
else
{
	$sbiccqry="select RequestID,Updated_Date from Req_Credit_Card Where (source='SMS_Lead_RBL' and Updated_Date Between '".$min_date."' and '".$max_date."') LIMIT 0,4";
}
echo "<br><br>q 3: ".$sbiccqry."<br>";

$smsplqryresult = ExecQuery($sbiccqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	//echo "fff";
	$AllRequestID = $row2["RequestID"];
	$Allocation_Date = $row2["Updated_Date"];
	$Feedback_ID = $AllRequestID;
	
	if($AllRequestID>0)
	{
			$sequenceqry=ExecQuery("SELECT id FROM `credit_card_banks_apply` WHERE (cc_requestid='".$AllRequestID."' and `applied_bankname` like '%RBL%' and (response_data like '%Status -1%' or response_data like '%Status -3%'))");
			$seqccid = mysql_fetch_array($sequenceqry);
			if($seqccid["cc_requestid"]>0)
			{
			}
			else
			{
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and  BidderID in (".$BidderIDStr.") and `Reply_Type`=4)";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='rblcallerlms_cc_sms' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				echo $bidderID = $BidderIDArr[$sequence];	
				if($AllRequestID>0 && $bidderID>1)
				{	
					//insert allocation
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '1', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='rblcallerlms_cc_sms' and BidderID=4905)";
					$updateqryresult = ExecQuery($updateqry);
					//echo "<br><br>";
				}
			
			}
		}
		$getCheckNum = '';
			
	}
}
}// rbl cardslms Cold

//Amex cards

function Amexcardslms()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='amexcallerlms_cc' and Status=1";
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
	//print_r($BidderIDArr);

 $BidderIDStr = implode(',', $BidderIDArr);
 
 
		$getBlockBiddersSql = "select BidderID from Bidders where leadidentifier in ('amexcallerlms_cc','diallerleadcc')";
		$getBlockBiddersQry = ExecQuery($getBlockBiddersSql);
		$recordCountBlockBidders = mysql_num_rows($getBlockBiddersQry);
		$BidderIDBlockArr = '';
		$counterValBlock = 1;
		for($i=0;$i<$recordCountBlockBidders;$i++)
		{
			$BidderIDBlock = mysql_result($getBlockBiddersQry,$i,'BidderID');
			$BidderIDBlockArr[$counterBlockVal] = $BidderIDBlock;
			$counterBlockVal = $counterBlockVal + 1;
		}
		//print_r($BidderIDArr);
	
		 $BidderIDBlockStr = implode(',', $BidderIDBlockArr);

$startprocess="Select lead_allocation_logic,total_no_agents,last_allocated_to,total_lead_count From lead_allocation_table Where (Citywise='amexcallerlms_cc' and BidderID=5596)";
//echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];
$lead_allocation_logic = $row["lead_allocation_logic"];

if($total_lead_count>0)
{
	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=5596 and Feedback_ID>'".$total_lead_count."' and (DATE_SUB( NOW() , INTERVAL '00:40' HOUR_MINUTE ) >= Allocation_Date) and Allocation_Date Between '".$min_date."' and '".$max_date."') LIMIT 0,4";
}
else
{
	$sbiccqry="select AllRequestID,Allocation_Date,Feedback_ID from  Req_Feedback_Bidder_CC Where (BidderID=5596 and (DATE_SUB( NOW() , INTERVAL '00:40' HOUR_MINUTE ) >= Allocation_Date) and Allocation_Date Between '".$min_date."' and '".$max_date."')  LIMIT 0,4";
}
//echo "<br><br>q 3: ".$sbiccqry."<br>";
$smsplqryresult = ExecQuery($sbiccqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	//echo "fff";
	$AllRequestID = $row2["AllRequestID"];
	$Allocation_Date = $row2["Allocation_Date"];
	$Feedback_ID = $row2["Feedback_ID"];
	
	if($AllRequestID>0)
	{
			$sequenceqry=ExecQuery("SELECT id,response_data FROM `credit_card_banks_apply` WHERE (cc_requestid='".$AllRequestID."' and `applied_bankname` like '%American%' and (response_data like '%<success>true</success>%'))");
			$seqccid = mysql_fetch_array($sequenceqry);
			$responsedata=$seqccid["response_data"];
			$xmlArray = str_ireplace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body>','',$responsedata);
			$xmlArray = str_ireplace('</soap:Body></soap:Envelope>','',$xmlArray);
		$xmlArray = simplexml_load_string($xmlArray);
		$json = json_encode($xmlArray);
		$responseArray = json_decode($json,true);
		if(isset($responseArray['submitApplicationResult'])){
			$response = $responseArray['submitApplicationResult']; 
			if(isset($response) && $response['status']['success'] == "true"){
				if($response['successResponse']['approved'] == "true"){
				$valid=1;
				}
				else
				{ $valid=0;
				}
			}
			else
			{$valid=0;
			}
		}else
		{$valid=0;
		}
			if($valid==1)
			{
			}
			else
			{
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and  BidderID in (".$BidderIDBlockStr."))";
			echo "<br>".$getCheckSQl."<br>";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='amexcallerlms_cc' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				echo $bidderID = $BidderIDArr[$sequence];	
				if($AllRequestID>0 && $bidderID>1)
				{					echo "<br><br>";
					//insert allocation
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '0', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='amexcallerlms_cc' and BidderID=5596)";
					$updateqryresult = ExecQuery($updateqry);
					//echo "<br><br>";
				}
			
			}
		}
		$getCheckNum = '';			
	}
}
}// end of Amex cards
//Cold calling AMex lms
function AmexcardslmsSMS()
{
$currentdate=Date('Y-m-d');
$min_date = $currentdate." 00:00:00";
$max_date = $currentdate." 23:59:59";

	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='rblcallerlms_cc' and Status=1";
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

 $BidderIDStr = implode(',', $BidderIDArr);

$startprocess="Select lead_allocation_logic,total_no_agents,last_allocated_to,total_lead_count From lead_allocation_table Where (Citywise='rblcallerlms_cc_sms' and BidderID=4905)";
//echo $startprocess."<br><br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
$total_lead_count = $row["total_lead_count"];
$lead_allocation_logic = $row["lead_allocation_logic"];

if($total_lead_count>0)
{
	$sbiccqry="select RequestID,Updated_Date from Req_Credit_Card Where (RequestID>'".$total_lead_count."' and source='SMS_Lead_RBL' and Updated_Date Between '".$min_date."' and '".$max_date."')";
}
else
{
	$sbiccqry="select RequestID,Updated_Date from Req_Credit_Card Where (source='SMS_Lead_RBL' and Updated_Date Between '".$min_date."' and '".$max_date."')";
}
//echo "<br><br>q 3: ".$sbiccqry."<br>";

$smsplqryresult = ExecQuery($sbiccqry);
$recordcount1 = mysql_num_rows($smsplqryresult);
$bidderID="";

while($row2 = mysql_fetch_array($smsplqryresult))
{
	//echo "fff";
	$AllRequestID = $row2["RequestID"];
	$Allocation_Date = $row2["Updated_Date"];
	$Feedback_ID = $AllRequestID;
	
	if($AllRequestID>0)
	{
			$sequenceqry=ExecQuery("SELECT id FROM `credit_card_banks_apply` WHERE (cc_requestid='".$AllRequestID."' and `applied_bankname` like '%RBL%' and (response_data like '%Status -1%' or response_data like '%Status -3%'))");
			$seqccid = mysql_fetch_array($sequenceqry);
			if($seqccid["cc_requestid"]>0)
			{
			}
			else
			{
			$getCheckSQl = "select * from lead_allocate where (AllRequestID = '".$AllRequestID."' and  BidderID in (".$BidderIDStr.") and `Reply_Type`=4)";
			$getCheckQuery = ExecQuery($getCheckSQl);
			$getCheckNum = mysql_num_rows($getCheckQuery);
			if($getCheckNum>0)
			{
				//Already Existing Lead
			}
			else
			{
				$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='rblcallerlms_cc_sms' and lead_allocation_logic='".$lead_allocation_logic."')");
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
				echo $bidderID = $BidderIDArr[$sequence];	
				if($AllRequestID>0 && $bidderID>1)
				{	
					//insert allocation
					echo $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '4', '1', Now());";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
					echo $updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='rblcallerlms_cc_sms' and BidderID=4905)";
					$updateqryresult = ExecQuery($updateqry);
					//echo "<br><br>";
				}
			
			}
		}
		$getCheckNum = '';
			
	}
}
}
// cold calling lms end

//Mutual Funds Lead Transfer Start
function mf_leads_allocation()
{
	$leadidentifier= 'mutualfundslms';
	$lead_allocation_logic = 81;

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
	
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Mutual_Fund Where ((Dated between '".$min_date."' and '".$max_date."') and  RequestID>'".$total_lead_count."')";
	}
//	$sbiccqry="select RequestID,Updated_Date,source from  Req_Mutual_Fund Where (RequestID>70 and RequestID<96)";

	//echo $sbiccqry="select RequestID,Updated_Date,source from  Req_Mutual_Fund Where (RequestID=22)";
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
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
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '11', '0', '".$Allocation_Date."');";
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
//Mutual Funds Lead Transfer End

//Home Loan BT Lead Transfer Start
function hlbt_leads_allocation()
{
	$leadidentifier= 'hlbtlms';
	$lead_allocation_logic = 84;

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
	
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Loan_Home Where ((Dated between '".$min_date."' and '".$max_date."') and source='fb_bt_leads' and RequestID>'".$total_lead_count."')";
	}
//	$sbiccqry="select RequestID,Updated_Date,source from  Req_Loan_Home Where (RequestID>70 and RequestID<96)";

//	echo $sbiccqry="SELECT RequestID, Updated_Date, source FROM Req_Loan_Home WHERE ( ( Dated BETWEEN  '2017-04-10 00:00:00' AND  '2017-04-11 23:59:59' ) AND source =  'fb_bt_leads')";
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
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
			//	echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
				$getCheckSQl = "select * from hlcallinglms_allocation where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")  ";
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
						 $inserticiciqry="INSERT INTO `hlcallinglms_allocation` (`AllRequestID`, `BidderID`, `DOE`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', Now(), '".$Allocation_Date."');";
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
//Home Loan BT Lead Transfer End


//HDFC Back Calling Process Start
function backprocess_leads_allocation()
{
	$leadidentifier= 'hdfcbackcalling';
	$lead_allocation_logic = 85;

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
		$sbiccqry="select RequestID,Updated_Date,source,callerid from  Req_PL_BackCalling Where ((Dated between '".$min_date."' and '".$max_date."') and  RequestID>'".$total_lead_count."' and source='pl_backcalling')";
	}
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
//die();
	
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["RequestID"];
		$callerid = $row2["callerid"];
		
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
					if(trim($callerid>0))
					{
						$bidderID = trim($callerid);
					}
					else
					{
					$bidderID = $BidderIDArr[$sequence];
					}
//				
					echo $bidderID.", ".$AllRequestID;
					if($AllRequestID>0 && $bidderID>1)
					{
						//insert allocation
						//echo "<br><br>";
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '12', '0', '".$Allocation_Date."');";
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
//HDFC Back Calling Process End

//ICICI Wishfin Lead Transfer Start
function icici_wf_leads_allocation()
{
	$leadidentifier= 'iciciwfcalling';
	$lead_allocation_logic = 86;

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
	
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Loan_Personal Where ((Dated between '".$min_date."' and '".$max_date."') and source='wishfin - fb_icici_lead' and   RequestID>'".$total_lead_count."')";
	}
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
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
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
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
//ICICI Wishfin Lead Transfer End

//BAJAJ TU Lead Transfer Start
function bajaj_tu_leads_allocation()
{
	$leadidentifier= 'bajajtu';
	$lead_allocation_logic = 88;

	$currentdate=Date('Y-m-d');
	//$currentdate="2017-04-19";
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
	
	//select d4l_id as RequestID, date_started as Updated_Date, id as Feedback_ID  from xkyknzl5dwfyk4hg_tms_bank_api where  id >'".$total_lead_count."' and bank_code='036' and product_type='PL' and web_services_default_values_id in (2,9) and (date_started between '".$min_date."' and '".$max_date."') 
		$sbiccqry="select d4l_id as RequestID, date_started as Updated_Date, id as Feedback_ID  from xkyknzl5dwfyk4hg_tms_bank_api where  id >'".$total_lead_count."' and bank_code='m015' and product_type='PL' and web_services_default_values_id in (2,9) and (date_started between '".$min_date."' and '".$max_date."')";
	}
	//$sbiccqry="select d4l_id as RequestID, date_started as Updated_Date, id as Feedback_ID  from xkyknzl5dwfyk4hg_tms_bank_api where  id=9292";
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
	//die();
	
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["Feedback_ID"];
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
			//	echo "<br> Seq - ".$sequence.", ".$last_allocated_to.", ".$total_no_agents."<br>";
				$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")  ";
			//	echo "<br> SQL - ".$getCheckSQl."<br>";
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
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
						$inserticiciqryresult = ExecQuery($inserticiciqry);
		echo  $inserticiciqry."<br><br>";
						$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$leadidentifier."' and lead_allocation_logic='".$lead_allocation_logic."')";
						$updateqryresult = ExecQuery($updateqry);
						echo $updateqry."<br><br>";
					}
				}
		}
	}
}
//BAJAJ TU Lead Transfer End


//business loan allocation function

function getBiddersListBL($strRequestID,$strCity)
{   
    $RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = 1;

	$qry = "SELECT * FROM Bidders_List WHERE (Reply_Type='".$mvarType."' and City LIKE '%".$mvarCity."%' and  Restrict_Bidder=1 and BankID!=66 and BankID!=80 ) order by Bidder_Name ASC";

	 list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
	$i=0;    $j=0;    $k=0;    $z=0;   $q=0;
   
	for($fc=0;$fc<$firstcount;$fc++)
    {
        $query = $row[$fc]["Query"];
		 $FBidder_Name = $row[$fc]["Bidder_Name"];
        $table = $row[$fc]["Table_Name"];
		$City = $row[$fc]["City"];
		$BankID = $row[$fc]["BankID"];
    	//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row[$fc]["Cap_MinDate"];
	
	$CapLead_Count = $row[$fc]["CapLead_Count"];
	$FBidderID = $row[$fc]["BidderID"];		
      		
	$ExplodeCapLead = explode(",", $CapLead_Count);
	$CapDay = $ExplodeCapLead[0];
	$CapWeek = $ExplodeCapLead[1];
	$CapMonth = $ExplodeCapLead[2];
	$CapLifeTime = $ExplodeCapLead[3];
	$TodayDate = date("Y-m-d");
	$CheckDateSql = "select sum(BookLeadCount) as SumDay from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookDate = ".$TodayDay." and BookProduct='".$mvarType."'  and  BookMonth = ".$TodayMonth." and  BookYear= ".$TodayYear." ";
	list($daycount,$row_result_D)=MainselectfuncNew($CheckDateSql,$array = array());
	$DayCount = $row_result_D[0]['SumDay'];
	
	$CheckWeekSql = "select sum(BookLeadCount) as SumWeek from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookWeek = ".$TodayWeek." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($weekcount,$row_result_W)=MainselectfuncNew($CheckWeekSql,$array = array());
	$Total4Week = $row_result_W[0]['SumWeek'];
	
	$CheckMonthSql = "select sum(BookLeadCount) as SumMonth from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookMonth = ".$TodayMonth." and BookProduct='".$mvarType."' and  BookYear= ".$TodayYear." ";
	list($monthcount,$row_result_M)=MainselectfuncNew($CheckMonthSql,$array = array());
	$Total4Month = $row_result_M[0]['SumMonth'];
	
	$CheckLifeTimeSql = "select sum(BookLeadCount) as SumLifeTime from Bidders_Book_Keeping where BidderID = ".$FBidderID." and BookProduct='".$mvarType."'";
	list($lifetimecount,$row_result_LT)=MainselectfuncNew($CheckLifeTimeSql,$array = array());
	$Total4LifeTime = $row_result_LT[0]['SumLifeTime'];
	
		//Start Check for Day Cap Lead
		if(($CapDay!=0 && $CapDay!='' && $DayCount<$CapDay) || $CapDay==0 || $CapDay=="NULL")
		{
			//echo "(if)DayCount : ".$DayCount." CapDay : ". $CapDay; echo "<br>";
			$ValidBidder_Day = 1;
		}
		else
		{
			$ValidBidder_Day = 0;
				//echo "(else)DayCount : ".$DayCount." CapDay : ". $CapDay;echo "<br>";
		}
		//End Check for Day Cap Lead
		//Start Check for Week Cap Lead
		if(($CapWeek!=0 && $CapWeek!='' && $Total4Week<$CapWeek) || $CapWeek==0  || $CapWeek=="NULL")
		{
			//echo "(if)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 1;
		}
		else
		{
			//echo "(else)Total4Week : ".$Total4Week." CapWeek : ". $CapWeek;echo "<br>";
			$ValidBidder_Week = 0;
		}
		//End Check for Week Cap Lead
		//Start Check for Month Cap Lead
		if(($CapMonth!=0 && $CapMonth!='' && $Total4Month<$CapMonth) || $CapMonth==0  || $CapMonth=="NULL")
		{
			//echo "(if)Total4Month : ".$Total4Month." CapMonth : ". $CapMonth;echo "<br>";
			$ValidBidder_Month = 1;
		}
		else
		{
			//echo "(else)Total4Month : ".$Total4Month." CapMonth : ". $CapMonth;echo "<br>";
			$ValidBidder_Month = 0;
		}
		//End Check for Month Cap Lead
		//Start Check for LifeTime Cap Lead
		if(($CapLifeTime!=0 && $CapLifeTime!='' && $Total4LifeTime<$CapLifeTime) || $CapLifeTime==0  || $CapLifeTime=="NULL")
		{
			//echo "(if)Total4LifeTime : ".$Total4LifeTime." CapLifeTime : ". $CapLifeTime;echo "<br>";
			$ValidBidder_LT = 1;
		}
		else
		{
			//echo "(else)Total4LifeTime : ".$Total4LifeTime." CapLifeTime : ". $CapLifeTime;echo "<br>";
			$ValidBidder_LT = 0;
		}
		//End Check for LifeTime Cap Lead
			if($ValidBidder_Day==1 && $ValidBidder_Week==1 && $ValidBidder_Month==1 && $ValidBidder_LT==1)
			{
				$Bidderid = $FBidderID;
				$Bidder_Name = $FBidder_Name;
			}
			else {
				 $Bidderid = "Not Valid"; }
		
		//End For Cap Function
	    $City = trim($row[$fc]["City"]);
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
		$propercity="('".$newcity."')";
			
		$qry2 = $query." and (City in ".$propercity." or City_Other in ".$propercity." ) and Req_Loan_Personal.RequestID ='".$RequestID."'";
         list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
       	if($recordcount>0 && $Bidderid!="Not Valid") //(result1)
		{
			$bankid[] = $BankID;
			$BidderID[] = $Bidderid;
			 $BidderName[] = $Bidder_Name;
		}
		}
		
	$bidder = $BidderID;
	return($bidder);

	}


//Start HDFC Business Loan Calling Process
function Hdfc_leads_allocation_bl()
{
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$getActiveBiddersSql = "select BidderID from Bidders where leadidentifier='hdfcbusinessloan' and Status=1";// THis is to get Agents
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
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='hdfcbusinessloan' and lead_allocation_logic=91)";
	echo $startprocess."<br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	if($total_lead_count>0)
	{
		//Mumbai, NCR and Ahmedabad 
		$City_List = "Ahmedabad', 'Noida','Gaziabad','Faridabad','Sahibabad','Gurgaon','Mumbai";
		$sbiccqry="select RequestID,Updated_Date,source from  Req_Loan_Personal Where ((City in ('".$City_List."') or City_Other in ('".$City_List."')) and Total_Experience>=5 and ((CC_Age in (2,3,4,5) and Annual_Turnover>1) or (Annual_Turnover=2 or Annual_Turnover=3 or Annual_Turnover=4)) and Employment_Status=0 and Allocated=0 and RequestID>'".$total_lead_count."' and Updated_Date between '".$min_date."' and '".$max_date."')";
	}
//	echo $sbiccqry="select RequestID,Updated_Date,source from  Req_Credit_Card_Sms Where (source='SMS_LeadNew')";
	//echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	echo $recordcount1."<br>";
	$bidderID="";
	//exit();
	while($row2 = mysql_fetch_array($select4mcardsresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["RequestID"];
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='hdfcbusinessloan' and lead_allocation_logic=91)");
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
		echo	$getCheckSQl = "select * from lead_allocate where AllRequestID = '".$AllRequestID."' and BidderID in (".$BidderIDStr.")  ";
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
					 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '1', '0', '".$Allocation_Date."');";
					$inserticiciqryresult = ExecQuery($inserticiciqry);
	echo  $inserticiciqry."<br><br>";
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='hdfcbusinessloan' and lead_allocation_logic=91)";
					$updateqryresult = ExecQuery($updateqry);
					echo $updateqry."<br><br>";
				}
			}
		}
	}
}// hdfc bl



//SBI CC Lead Transfer Start
function sbicc_leads_allocation()
{
	$leadidentifier= 'sbicallerlms_cc';
	$lead_allocation_logic = 95;

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
		$sbiccqry="select RequestID,Updated_Date from Req_Credit_Card Where (RequestID>'".$total_lead_count."' and source='SMS_Lead_SBI' and Updated_Date Between '".$min_date."' and '".$max_date."')";

	}
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
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
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '11', '0', '".$Allocation_Date."');";
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
//SBI Lead Transfer End

//Amex CC Lead Transfer Start
function amexcc_leads_allocation()
{
	$leadidentifier= 'amercianexpresscallerlms_cc';
	$lead_allocation_logic = 94;

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
		$sbiccqry="select RequestID,Updated_Date from Req_Credit_Card Where (RequestID>'".$total_lead_count."' and source='SMS_Lead_AMEX' and Updated_Date Between '".$min_date."' and '".$max_date."')";

	}
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
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
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '11', '0', '".$Allocation_Date."');";
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
//Amex Lead Transfer End


//ICICI CC Lead Transfer Start
function icicibankcc_leads_allocation()
{
	$leadidentifier= 'icicibankcallerlms_cc';
	$lead_allocation_logic = 96;

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
		$sbiccqry="select RequestID,Updated_Date from Req_Credit_Card Where (RequestID>'".$total_lead_count."' and source='SMS_Lead_ICICI' and Updated_Date Between '".$min_date."' and '".$max_date."')";

	}
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
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
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '11', '0', '".$Allocation_Date."');";
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
//ICICI Lead Transfer End



//SCB CC Lead Transfer Start
function scbcc_leads_allocation()
{
	$leadidentifier= 'scbbankcallerlms_cc';
	$lead_allocation_logic = 97;

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
		$sbiccqry="select RequestID,Updated_Date from Req_Credit_Card Where (RequestID>'".$total_lead_count."' and source='SMS_Lead_SCB' and Updated_Date Between '".$min_date."' and '".$max_date."')";

	}
		echo $sbiccqry."<br>";
	$select4mcardsresult = ExecQuery($sbiccqry);
	$recordcount1 = mysql_num_rows($select4mcardsresult);
	$bidderID="";
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
						 $inserticiciqry="INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$AllRequestID."', '".$bidderID."', '11', '0', '".$Allocation_Date."');";
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
//SCB Lead Transfer End

//Qbera Calling Process bangalore chennai delhi
function qberaplBCD()
{
                $source = 'CallerAccountQBERABCD';
                $lead_allocation_logic = 109;
                $Global_Access_ID = 6929;
                $currentdate=Date('Y-m-d');
                //$currentdate="2017-04-20";
                $min_date = $currentdate." 00:00:00";
                $max_date = $currentdate." 23:59:59";
                
                $startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
                echo $startprocess."<br><br>";
                $startprocessresult = ExecQuery($startprocess);
                $recordcount = mysql_num_rows($startprocessresult);
                $row=mysql_fetch_array($startprocessresult);
                echo $total_lead_count = $row["total_lead_count"];
                
                $arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
                while($rowbid=mysql_fetch_array($arrbidderqry))
                {
                    $arrBidderID[] = $rowbid["BidderID"];
                }
                echo $trbidder=implode("','",$arrBidderID);
                
                if($total_lead_count>0)
                {
                    $citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
                }
                else
                {
                    $citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
                }
                echo $citibankplqry."<br>";
                $citiplqryresult = ExecQuery($citibankplqry);
                $recordcount1 = mysql_num_rows($citiplqryresult);
                $bidderID="";
                
                $counterVal = 1;
                $arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
                while($rowcal=mysql_fetch_array($arrcallerqry))
                {
					$arrCallerrID[$counterVal] = $rowcal["BidderID"];
					$counterVal = $counterVal + 1;
                }
		print_r($arrCallerrID);

		//die();
		while($row2 = mysql_fetch_array($citiplqryresult))
		{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];

		if($AllRequestID>0)
		{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
			$callerID = $arrCallerrID[$sequence];
			if($AllRequestID>0 && $callerID>1)
			{
							//insert allocation
			$final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
			$final_allocationcitiresult = ExecQuery($final_allocationciti);
			$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo "<br>".$final_allocationciti."<br>";
			$updateqryresult = ExecQuery($updateqry);
							echo "<br><br>";
			}
		}
		$getCheckNum = '';
		}
		}
} //End Qbera Calling Process Bangalore Chennai Delhi


//HDFC BL Process
	function HDFCBLFB()
	{
			$source = 'CallingHDFCBL';
			$lead_allocation_logic = 117;
			$Global_Access_ID = 7008;
			$currentdate=Date('Y-m-d');
			//$currentdate="2017-04-20";
			$min_date = $currentdate." 00:00:00";
			$max_date = $currentdate." 23:59:59";
			
			$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo $startprocess."<br><br>";
			$startprocessresult = ExecQuery($startprocess);
			$recordcount = mysql_num_rows($startprocessresult);
			$row=mysql_fetch_array($startprocessresult);
			echo $total_lead_count = $row["total_lead_count"];
			
			$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
			while($rowbid=mysql_fetch_array($arrbidderqry))
			{
				$arrBidderID[] = $rowbid["BidderID"];
			}
			echo $trbidder=implode("','",$arrBidderID);
			
			if($total_lead_count>0)
			{
				$citibankplqry="Select RequestID,Updated_Date From Req_Loan_Personal Where (source like '%AFL_SMS_FBSELF_PL%' and (Updated_Date between '".$min_date."' and '".$max_date."') and RequestID >".$total_lead_count." and Allocated=0 and Employment_Status=0) order by RequestID ASC";
			}
			else
			{
				$citibankplqry="Select RequestID,Updated_Date From Req_Loan_Personal Where (source like '%AFL_SMS_FBSELF_PL%' and Updated_Date between '".$min_date."' and '".$max_date."' and Allocated=0 and Employment_Status=0) order by RequestID ASC";
			}
			echo $citibankplqry."<br>";
			$citiplqryresult = ExecQuery($citibankplqry);
			$recordcount1 = mysql_num_rows($citiplqryresult);
			$bidderID="";
			
			$counterVal = 1;
			$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
			while($rowcal=mysql_fetch_array($arrcallerqry))
			{
				$arrCallerrID[$counterVal] = $rowcal["BidderID"];
				$counterVal = $counterVal + 1;
			}
		print_r($arrCallerrID);

		//die();
		while($row2 = mysql_fetch_array($citiplqryresult))
		{
		$Feedback_ID = 0;
		echo $AllRequestID = $row2["RequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];

		if($AllRequestID>0)
		{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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

		$getCheckSQl = "select AllRequestID from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID in (".$trbidder."))";

		$getCheckQuery = ExecQuery($getCheckSQl);
		$getCheckNum = mysql_num_rows($getCheckQuery);
		if($getCheckNum>0)
			{			//Already Existing Lead
		}
		else
		{
			$callerID = $arrCallerrID[$sequence];
			if($AllRequestID>0 && $callerID>1)
			{
							//insert allocation
			$final_allocationciti="INSERT lead_allocate (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$AllRequestID."','".$callerID."','1', Now())";
			$final_allocationcitiresult = ExecQuery($final_allocationciti);
			$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$AllRequestID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo "<br>".$final_allocationciti."<br>";
			$updateqryresult = ExecQuery($updateqry);
							echo "<br><br>";
			}
		}
		$getCheckNum = '';
		}
		}
	} //End HDFC BL Process

//Start HDFC Business Loan Calling Process internal
function HDFCBLBIDDER()
	{
			$source = 'CallingHDFCBL';
			$lead_allocation_logic = 118;
			$Global_Access_ID = 7008;
			$currentdate=Date('Y-m-d');
			//$currentdate="2017-04-20";
			$min_date = $currentdate." 00:00:00";
			$max_date = $currentdate." 23:59:59";
			
			$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='HDFCBLINTERNAL' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo $startprocess."<br><br>";
			$startprocessresult = d4l_ExecQuery($startprocess);
			$recordcount = d4l_mysql_num_rows($startprocessresult);
			$row=d4l_mysql_fetch_array($startprocessresult);
			$total_lead_count = $row["total_lead_count"];
			
			$arrbidderqry=d4l_ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
			while($rowbid=d4l_mysql_fetch_array($arrbidderqry))
			{
				$arrBidderID[] = $rowbid["BidderID"];
			}
			echo $trbidder=implode("','",$arrBidderID);
			
			if($total_lead_count>0)
			{
				$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
			}
			else
			{
				$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."')  and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
			}
			//echo $citibankplqry."<br>";
			$citiplqryresult = d4l_ExecQuery($citibankplqry);
			$recordcount1 = d4l_mysql_num_rows($citiplqryresult);
			$bidderID="";
			
			$counterVal = 1;
			$arrcallerqry=d4l_ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
			while($rowcal=d4l_mysql_fetch_array($arrcallerqry))
			{
				$arrCallerrID[$counterVal] = $rowcal["BidderID"];
				$counterVal = $counterVal + 1;
			}
		//print_r($arrCallerrID);

		//die();
		while($row2 = d4l_mysql_fetch_array($citiplqryresult))
		{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Allocation_Date"];

		if($AllRequestID>0)
		{
		
		$sequenceid=d4l_ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='HDFCBLINTERNAL' and lead_allocation_logic='".$lead_allocation_logic."')");
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

		$getCheckSQl = "select AllRequestID from lead_allocate where (AllRequestID = '".$AllRequestID."' and BidderID in (".$trbidder."))";

		$getCheckQuery = d4l_ExecQuery($getCheckSQl);
		$getCheckNum = d4l_mysql_num_rows($getCheckQuery);
		if($getCheckNum>0)
			{			//Already Existing Lead
		}
		else
		{
			$callerID = $arrCallerrID[$sequence];
			if($AllRequestID>0 && $callerID>1)
			{
							//insert allocation
			$final_allocationciti="INSERT lead_allocate (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$AllRequestID."','".$callerID."','1', Now())";
			$final_allocationcitiresult = d4l_ExecQuery($final_allocationciti);
			$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='HDFCBLINTERNAL' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo "<br>".$final_allocationciti."<br>";
			$updateqryresult = d4l_ExecQuery($updateqry);
							echo "<br><br>";
			}
		}
		$getCheckNum = '';
		}
		}
	} // hdfc bl INternal

// incred PL allocation Delhi & mumbai
function incredplDM()
{
                $source = 'CallingIncredDM';
                $lead_allocation_logic = 120;
                $Global_Access_ID = 7010;
                $currentdate=Date('Y-m-d');
                //$currentdate="2017-04-20";
                $min_date = $currentdate." 00:00:00";
                $max_date = $currentdate." 23:59:59";
                
                $startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
                echo $startprocess."<br><br>";
                $startprocessresult = ExecQuery($startprocess);
                $recordcount = mysql_num_rows($startprocessresult);
                $row=mysql_fetch_array($startprocessresult);
                echo $total_lead_count = $row["total_lead_count"];
                
                $arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
                while($rowbid=mysql_fetch_array($arrbidderqry))
                {
                    $arrBidderID[] = $rowbid["BidderID"];
                }
                echo $trbidder=implode("','",$arrBidderID);
                
                if($total_lead_count>0)
                {
                    $citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
                }
                else
                {
                    $citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
                }
                echo $citibankplqry."<br>";
                $citiplqryresult = ExecQuery($citibankplqry);
                $recordcount1 = mysql_num_rows($citiplqryresult);
                $bidderID="";
                
                $counterVal = 1;
                $arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
                while($rowcal=mysql_fetch_array($arrcallerqry))
                {
					$arrCallerrID[$counterVal] = $rowcal["BidderID"];
					$counterVal = $counterVal + 1;
                }
		//print_r($arrCallerrID);

		//die();
		while($row2 = mysql_fetch_array($citiplqryresult))
		{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];

		if($AllRequestID>0)
		{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
			{//Already Existing Lead
		}
		else
		{
			$callerID = $arrCallerrID[$sequence];
			if($AllRequestID>0 && $callerID>1)
			{
							//insert allocation
			$final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
			$final_allocationcitiresult = ExecQuery($final_allocationciti);
			$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo "<br>".$final_allocationciti."<br>";
			$updateqryresult = ExecQuery($updateqry);
							echo "<br><br>";
			}
		}
		$getCheckNum = '';
		}
		}
}
//Incred pl Allocation end
//Business loan Allocation for Bidders
function BidderAllocateBL()
{
	echo $getpldata="Select RequestID,City,City_Other from Req_Loan_Personal where (Allocated =0 and Employment_Status=0 and Net_Salary>=260000 and (Dated >=DATE_SUB(CURDATE(),INTERVAL 0 DAY)))";

	$getpldataresult = ExecQuery($getpldata);
	$recordcount1 = mysql_num_rows($getpldataresult);
//	echo $recordcount1."<br>";
	$bidderID="";

	while($row2 = mysql_fetch_array($getpldataresult))
	{
		$AllRequestID = $row2["RequestID"];
		$Allocation_Date = $row2["Updated_Date"];
		$Feedback_ID = $row2["City"];
		$City = $row2["City"];
		$City_Other = $row2["City_Other"];
	// place clause for prepaid bidder here:
		if($City=="Others" || $City=="Please Select")
		{
			$City=$City_Other;
		}
		else
		{
			$City= $City;
		}
		$valuefetch=getBiddersListBL($AllRequestID,$City);
		print_r($valuefetch);
		if(count($valuefetch)>0 && $valuefetch[0]>0)
		{	echo $Final_Bid=implode(",",$valuefetch);
			$Allocated=2;
			echo "<br>2:";
			echo $updatelead="Update Req_Loan_Personal set Bidderid_Details='".$Final_Bid."',Dated=Now(), Allocated='".$Allocated."' where RequestID=".$AllRequestID;
			$updateleadresult = ExecQuery($updatelead);
		}
	}
}
//Business loan Allocation for Bidders end

//Qbera Calling Process Metro City
function qberaplMetro()
{
                $source = 'CallerAccountQBERAMETRO';
                $lead_allocation_logic = 131;
                $Global_Access_ID = 7124;
                $currentdate=Date('Y-m-d');
                //$currentdate="2017-04-20";
                $min_date = $currentdate." 00:00:00";
                $max_date = $currentdate." 23:59:59";
                
                $startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
                echo $startprocess."<br><br>";
                $startprocessresult = ExecQuery($startprocess);
                $recordcount = mysql_num_rows($startprocessresult);
                $row=mysql_fetch_array($startprocessresult);
                echo $total_lead_count = $row["total_lead_count"];
                
                $arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='".$Global_Access_ID."')");
                while($rowbid=mysql_fetch_array($arrbidderqry))
                {
                    $arrBidderID[] = $rowbid["BidderID"];
                }
                echo $trbidder=implode("','",$arrBidderID);
                
                if($total_lead_count>0)
                {
                    $citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
                }
                else
                {
                    $citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
                }
                echo $citibankplqry."<br>";
                $citiplqryresult = ExecQuery($citibankplqry);
                $recordcount1 = mysql_num_rows($citiplqryresult);
                $bidderID="";
                
                $counterVal = 1;
                $arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
                while($rowcal=mysql_fetch_array($arrcallerqry))
                {
					$arrCallerrID[$counterVal] = $rowcal["BidderID"];
					$counterVal = $counterVal + 1;
                }
		print_r($arrCallerrID);

		//die();
		while($row2 = mysql_fetch_array($citiplqryresult))
		{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];

		if($AllRequestID>0)
		{
		$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
			$callerID = $arrCallerrID[$sequence];
			if($AllRequestID>0 && $callerID>1)
			{
							//insert allocation
			$final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
			$final_allocationcitiresult = ExecQuery($final_allocationciti);
			$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
			echo "<br>".$final_allocationciti."<br>";
			$updateqryresult = ExecQuery($updateqry);
							echo "<br><br>";
			}
		}
		$getCheckNum = '';
		}
		}
} //End Qbera Calling Process Metro City

//Start Capital First for All City
function CapitalFirstAllCity()
{
	$source = 'CallerAccountCFLAllCity';
	$lead_allocation_logic = 132;
	$Global_Access_ID = 7125;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	echo $recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End Capital First for ALL City


//Start Capital First
function CapitalFirst6281()
{
	$source = 'CallerAccountCFL';
	$lead_allocation_logic = 137;
	$Global_Access_ID = 6281;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
       
       echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	echo $recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End Capital First

//Start IIFL Account
function IIFLCallerAccount()
{
	$source = 'CallerAccountIIFL';
	$lead_allocation_logic = 138;
	$Global_Access_ID = 6975;
	$currentdate=Date('Y-m-d');
	$min_date = $currentdate." 00:00:00";
	$max_date = $currentdate." 23:59:59";
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	echo $startprocess."<br><br>";
	$startprocessresult = ExecQuery($startprocess);
	$recordcount = mysql_num_rows($startprocessresult);
	$row=mysql_fetch_array($startprocessresult);
	echo $total_lead_count = $row["total_lead_count"];
	
	$arrbidderqry=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
	while($rowbid=mysql_fetch_array($arrbidderqry))
	{
		$arrBidderID[] = $rowbid["BidderID"];
	}
	echo $trbidder=implode("','",$arrBidderID);
	
	$counterVal = 1;
	$arrcallerqry=ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	print_r($arrCallerrID);
	    $min_date='2017-08-01 00:00:00';
	if($total_lead_count>0)
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Feedback_ID>'".$total_lead_count."' and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
	else
	{
		$citibankplqry="Select * From Req_Feedback_Bidder_PL Where (BidderID in ('".$trbidder."') and Reply_Type=1 and Allocation_Date between '".$min_date."' and '".$max_date."') order by Feedback_ID ASC";
	}
    
    	echo $citibankplqry."<br>";
	$citiplqryresult = ExecQuery($citibankplqry);
	echo $recordcount1 = mysql_num_rows($citiplqryresult);
	$bidderID="";
	
	//die();
	
	while($row2 = mysql_fetch_array($citiplqryresult))
	{
		$Feedback_ID = $row2["Feedback_ID"];
		echo $AllRequestID = $row2["AllRequestID"];
		$BidderID = $row2["BidderID"];
		$Allocation_Date = $row2["Updated_Date"];
		
		if($AllRequestID>0)
		{
			$sequenceid=ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
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
					$callerID = $arrCallerrID[$sequence];
					if($AllRequestID>0 && $callerID>1)
					{
						//insert allocation
						 $final_allocationciti="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$Feedback_ID."','".$AllRequestID."','".$callerID."','1', Now())";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
					$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$Feedback_ID."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
					echo "<br>".$final_allocationciti."<br>";
					$updateqryresult = ExecQuery($updateqry);
						echo "<br><br>";
					}
				}
				$getCheckNum = '';
		}
	}
} //End IIFL Account


main();

function main()
{
	sbicc5633();
	smspl_appmodel5926();
	sbicc6088();
	hdfc6117();
	hdfc6116();
	//hdfc6120(); Paused on 02/09/16 as mailed by Balbir
	bajaj6253();
	bajaj6252();
	bajaj6290();
        bajaj7230(); //Yaswant 11/09/2017
        bajaj7347(); //Yaswant 12/09/2017
	citibankpl6328();
	//citypl(); // Coimbatore Process Stopped on 6th December 2016
	citibankhl6356();
	external_leads_allocation_bl();
	
	external_leads_allocation_bl_OtherCities();
	external_leads_allocation_bl_Delhi();
	
      
	
	external_leads_allocation_lap_Delhi();
	pllead4Appointment();
	plleadUpload4Appointment();
	abflbankpl();
	bajaj6684();
	
//	tatabankplPune();merged to 6484 // 06/03/17
	smsBajajFinserv();
	Amexcardslms();
	mf_leads_allocation();
	hlbt_leads_allocation();
	backprocess_leads_allocation();// neha guta hdfc crm
	icici_wf_leads_allocation();
	bajaj_tu_leads_allocation();
	//Hdfc_leads_allocation_bl(); // ranjana 21 april 2017 HDFC BL (outside)
	qberaplBCD(); // 23 may 2017
        //HDFCBLFB();// HDFC BL FB calling internal switched off @ 6july
        HDFCBLBIDDER();// HDFC BL FB calling internal
        incredplDM();// incred PL delhi & mumbai
        BidderAllocateBL();//BL allocation
        qberaplMetro(); //Yaswant 020817 Qbera PL Metro City
        CapitalFirstAllCity();//Yaswant 020817 Capital First All City
        CapitalFirst6281();//Yaswant 140817 Capital First
        IIFLCallerAccount();//Yaswant 140817 IIFL Caller Account
 
       // RBLcardslmsSMS();//Upendra 010517
        //sbicc_leads_allocation();//Upendra 010517
        //amexcc_leads_allocation();//Upendra 010517
        //icicibankcc_leads_allocation();//Upendra 010517
        //scbcc_leads_allocation();//Upendra 010517
}
?>