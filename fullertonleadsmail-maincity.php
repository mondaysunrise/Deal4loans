<?php
//Commented To and CC and BCC
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
session_start();

$Today = date("Y-m-d"); 
$min_date=$Today." 00:00:00";
$max_date=$Today." 23:59:59";
	
$session_id="";


$titles = array('1'=>'1360,1361,1362,1363,1372,1375,1523,1524,1359,1364,1365,1370,1519,1520,1521,1522,1366,1367,1368,1369,1515,1516,1517,1518,1371,1373,1374,1376,1525,1527', '2'=>'1470,1471,1473,1480,1025,3315,3316', '3'=>'1029,1215,1221,1222,1642,2168,2335,2336,2337,2338,2339,2340,2341,2342,2343,2344', '4'=>'1090, 1091, 1092, 1093, 1675', '5'=>'1871,1872,1873,1874,1875,1876,1877,2296,2297,2298,2299,2300,2301,2302,2303,2304,2305', '6'=>'1292,1432,1436,1439,1204,1223,1424,1425,1429,1433,1435,1293,1427,1428,1431,1437,1294,1423,1426,1430,1434,1438,3318,3319,3320,3317', '7'=>'2295,1095,1096,1097,1098,1106,1108,1102,1105,1163,1100,1103,1104,1107,2280,2281,2283,2284,2285,2286,2287,2288,2289,2290,2291,2292,2293,2294', '8'=>'1379,1381,1387,1385,1384,1380,1386,1378,1383,1377,1686', '9'=>'1284,1295,1287,1546,1547,1548,1549,1550,1551,1552,1553,1554,1555,1556,1557,1558,1559,1560,1561,1562', '10'=>'1338,1339,1340,1343,1347,1348,1350,1451,1452,1342,1344,1345,1346,1453,1454,1456,1455,1351,1353,1354,1355,1356,1357,1462,1463,1464,1465,1349,1352,1358,1457,1458,1459,1460,1461', '11'=>'1164,1165,1162,1166,1167,1168,1226,1597,1598,1599,1600,1601,1602,1603,1857,1858,1859,1860,1861,3321,3322,3323,3324,3325');

	$states = array('1'=>'Andhra Pradesh', '2'=>'East', '3'=>'Gujarat', '4'=>'Haryana', '5'=>'Karnataka', '6'=>'MPC', '7'=>'Punjab and HP', '8'=>'Rajasthan', '9'=>'ROMG', '10'=>'Tamil Nadu and Kerala', '11'=>'UP - UK');
	
	
	
	$to_emails = array('1' => 'artemis.kunapuli.kutumbarao@fullertonindia.com', '2'=>'ratul.dasgupta@fullertonindia.com,nirnimesh.maity@fullertonindia.com', '3'=>'artemis.mansi.patel@fullertonindia.com', '4'=>'balbir.singh@deal4loans.com', '5'=>'balbir.singh@deal4loans.com', '6'=>'crux.neeraj.taranekar@fullertonindia.com', '7'=>'balbir.singh@deal4loans.com', '8'=>'artemishr.sitaram.sharma@fullertonindia.com', '9'=>'artemis.rani.mardane@fullertonindia.com', '10'=>'intellect.sindhu.k@fullertonindia.com', '11'=>'mohdtariq.hasan@fullertonindia.com');
	
	$cc_emails = array('1'=>'mohammed.farooq@fullertonindia.com, balbir.singh@deal4loans.com', '2'=>'mihir.chakraborty@fullertonindia.com, balbir.singh@deal4loans.com', '3'=>'narendra.pakhawala@fullertonindia.com, balbir.singh@deal4loans.com', '4'=>'sunil.choudhary@fullertonindia.com,balbir.singh@deal4loans.com', '5'=>'balbir.singh@deal4loans.com', '6'=>'chauhan.ajay@fullertonindia.com, mahua.dutta@fullertonindia.com, thomas.varghese@fullertonindia.com, balbir.singh@deal4loans.com', '7'=>'balbir.singh@deal4loans.com', '8'=>'ashima.sharma@fullertonindialoans.com, balbir.singh@deal4loans.com', '9'=>'balbir.singh@deal4loans.com', '10'=>'shankar.p@fullertonindia.com, balbir.singh@deal4loans.com', '11'=>'balbir.singh@deal4loans.com');
	


for($j=1;$j<=13;$j++)
{
	$session_id="";
	$session_id=session_id();
	//session_regenerate_id();
	$session_id=session_id();

	$search_qry="";

	$search_qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal LEFT OUTER JOIN Req_Feedback ON 		Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in (".$titles[$j].") WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID in (".$titles[$j].") and Req_Feedback_Bidder1.Reply_Type='1' and (Req_Feedback_Bidder1.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' ) ";	

	echo "<br>".$search_qry."<br>";

$search_result = ExecQuery($search_qry);
	$recordcount = mysql_num_rows($search_result);	
//	echo "<br>".$recordcount."<br>";
	$newfileatt = "";
	$row_result = "";
	while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["Marital_Status"]==1) { $marital_status="Single"; } else { $marital_status="Married"; }
		if($row_result["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result["Residential_Status"]==3) { $residential_status="Company Provided"; }
		if($row_result["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_result["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_result["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
		if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }

		
		if($row_result["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
		elseif($row_result["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
		elseif($row_result["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
		elseif($row_result["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
		else
		{ 
			$emi_paid="";
		}
		if($row_result["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
		elseif($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
	elseif($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
	elseif($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
	else
		{
			$card_vintage="";
		}

		//$Dateofallocation = $row_result["Allocation_Date"];
		
		if($row_result["Allocation_Date"] > "2007-10-19 00:00:00")
		{
			$Dateofallocation = $row_result["Allocation_Date"];
		}
		else 
		{
			$Dateofallocation = $row_result["Dated"];
		}
		//echo $Dateofallocation;
		//exit();

		$dob_loan=$row_result["dob"];
		if(strlen($dob_loan)>0)
		{
			$dob=$dob_loan;} else { $dob=$row_result["DOB"];}
			
			$qry1 = "";
			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents,address_apt) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$marital_status."', '".$residential_status."', '".$vehicle_owned."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$row_result["Count_Views"]."', '".$row_result["Count_Replies"]."', '".$row_result["IsModified"]."', '".$row_result["PL_EMI_Amt"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["comment_section"]."','".$row_result["identification_proof"]."','".$row_result["axis_executive_name"]."')";
			$result1=ExecQuery($qry1);
//			echo "<br>".$qry1."<br>";
	}


$qry="select name, email, mobile_number, emp_status, c_name, city, city_other, net_salary, loan_amount, add_comment,address_apt AS AgtName, doe   from temp where session_id='".$session_id."' order by doe DESC ";
	//echo "<br>".$qry."<br>";
	$newfileatt = "";		
	$header="";
	$newdata="";
	$result = ExecQuery($qry);
	$num_rows = mysql_num_rows($result);
	
//	echo "<br>".$num_rows."<br>";
	
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
		 
	}
	//$value = '"' . $header . '"' . "\t";
	while($row = mysql_fetch_row($result)){
	  $line = '';
	  foreach($row as $value){
		if(!isset($value) || $value == ""){
		  $value = '"' . $value . '"' . "\t";
		}else{
	# important to escape any quotes to preserve them in the data.
		  $value = str_replace('"', '""', $value);
	# needed to encapsulate data in quotes because some data might be multi line.
	# the good news is that numbers remain numbers in Excel even though quoted.
		  $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	  }
	  $newdata .= trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	$retnewdata = str_replace("\r", "", $header);
	$retnewdata .="\n"; 
	$retnewdata .= str_replace("\r", "", $newdata);
 

	$newToday = date('d')."".date('m')."".date('y')."".date('s');
	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/fullerton/ful".$newToday."(".$states[$j].").xls";
//	echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
//$recordcount = 1;

	if($recordcount>0)
	{
		$emailid = "";
		$emailid_cc = "";
		echo "<br>";
		echo $titles[$j];
		echo "<br>";
		//	echo "<br>jjjj ".$recordcount."  ghghg<br>";
		$emailid = $to_emails[$j];
		$emailid_cc = $cc_emails[$j];
		
		sendexcelfileattachment( $emailid,$session_id,$states[$j],$emailid_cc);
		$lastCount = $j;
	}
	$recordcount=0;
	
}

function sendexcelfileattachment($emailid,$session_id,$fullecity, $emailid_cc)
{
	$newToday = date('d')."".date('m')."".date('y')."".date('s');
//echo $emailid."<br>";
$to = $emailid; 
$cc = $emailid_cc;

	echo "City: ".$fullecity;
	echo "<br>";
	echo "To: ".$to;
	echo "<br>";
	echo "Cc: ".$cc;
	echo "<br>";
	echo "--------------------------------------------------------------------------------";
	echo "<br>";

   $from = "Deal4loans <no-reply@deal4loans.com>"; 
   $subject = "Deal4loans (MA002) Leads Allocated on ".$newToday." in ".$fullecity.""; 
//   $subject = "test ".$newToday."(".$fullecity.")"; 
   
   $fileatt = "/home/deal4loans/public_html/fullerton/ful".$newToday."(".$fullecity.").xls";
	$fileatttype = "application/xls"; 
	$fileattname = "ful".$newToday."(".$fullecity.").xls";

	
   $file = fopen( $fileatt, 'r+' ); 
	$data = fread( $file, filesize( $fileatt ) ); 
	fclose( $file );
	
	$headers = "From: $from";
	
	
	 $semi_rand = md5( time() ); 
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

	$headers .= "\nMIME-Version: 1.0\n" . 
				"Content-Type: multipart/mixed;\n" . 
				" boundary=\"{$mime_boundary}\""."\n";
if(strlen($cc)>0)
{
$headers .= "Cc:".$cc.""."\n";
}
	 $headers .= "Bcc: shalini.rajput@deal4loans.com"."\n";
	$message = "This is a multi-part message in MIME format.\n\n" . 
			"--{$mime_boundary}\n" . 
			"Content-Type: text/plain; charset=\"iso-8859-1\"\n" . 
			"Content-Transfer-Encoding: 7bit\n\n" . 
			$message . "\n\n";

	$data = chunk_split( base64_encode( $data ) );
			 
	$message .= "--{$mime_boundary}\n" . 
			 "Content-Type: {$fileatttype};\n" . 
			 " name=\"{$fileattname}\"\n" . 
			 "Content-Disposition: attachment;\n" . 
			 " filename=\"{$fileattname}\"\n" . 
			 "Content-Transfer-Encoding: base64\n\n" . 
			 $data . "\n\n" . 
			 "--{$mime_boundary}--\n"; 
			 

 if( mail( $to, $subject, $message, $headers ) ) {
		 echo "<p>The email was sent.".$fullecity."</p>";  
	}
	else { 
		  echo "<p>There was an error sending the mail.".$fullecity."</p>"; 
	 
	}

	  $qry1="delete from `temp` where session_id='".$session_id."'";
//	echo "<br>".$qry1;
	
$result1 = ExecQuery($qry1);

}
	


?>