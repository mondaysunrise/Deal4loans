<?php
//Commented To and CC and BCC
//ob_start();
	/*require 'scripts/db_init.php';
	require 'scripts/functions.php';
session_start();
	//$titles = array('1'=>'1359,1360,1361,1362,1363,1364,1365,1366,1367,1368,1369,1370,1371,1372,1373,1374,1375,1376',  '2'=>'1025,1026,1027,1028', '3'=>'1029,1215,1221,1222', '4'=>'1338,1339,1340', '5'=>'1204,1223,1292,1293,1294,1439,1438,1437,1436,1435,1434,1433,1432,1431,1430,1429,1428,1427,1426,1425,1424,1423', '6'=>'1090,1092,1093,1095,1096,1097,1098,1099,1100,1102,1103,1104,1105,1106,1107,1108',  '7'=>'1125,1377,1378,1379,1380,1381,1382,1383,1384,1385,1386,1387', '8'=> '1287,1295,1284', '9'=>'1342,1343,1344,1345,1346,1347,1348,1349', '10'=>'1350,1351,1352,1353,1354,1355,1356,1357,1358', '11'=>'1162,1163,1164,1165,1166,1167,1168,1226'	);
$titles = array('1'=>'1029','2'=>'1215,1221','3'=>'1292,1432,1436,1439','4'=>'1095,1096,1097,1098,1106,1108','5'=>'1338,1339,1340,1343,1347,1348,1350,1451,1452','6'=>'1164,1165','7'=>'1025,1470,1471,1473,1480','8'=>'1204,1223,1424,1425,1429,1433,1435','9'=>'1293,1427,1428,1431,1437','10'=>'1125,1379,1381','11'=>'1378,1380,1383,1386','12'=>'1090,1091,1092,1093','13'=>'1162,1166,1167,1168,1226','14'=>'1163','15'=>'1453,1454,1456,1455','16'=>'1284','17'=>'1295','18'=>'1287','19'=>'1102,1105','20'=>'1100,1103,1104,1107','21'=>'1294,1423,1426,1430,1434,1438','22'=>'1222','23'=>'1360,1361,1362,1363,1372,1375,1523,1524','24'=>'1351,1353,1354,1355,1356,1357,1462,1463,1464,1465','25'=>'1377,1384,1385,1387','26'=>'1349,1352,1358,1457,1458,1459,1460,1461','27'=>'1359,1364,1365,1370,1519,1520,1521,1522','28'=>'1366,1367,1368,1369,1515,1516,1517,1518','29'=>'1371,1373,1374,1376,1525,1526,1527','30'=>'1871,1873','31'=>'1887','32'=>'1872, 1874,1875,1876','33'=>'1597,1598,1599,1600,1601,1602,1603');

//	$states = array('1'=>'ap','2'=>'kolkata','3'=>'gujarat','4'=>'kerla','5'=>'mp','6'=>'punjab','7'=>'rajasthan','8'=>'maharastra','9'=>'tn','10'=>'trichy','11'=>'up');
	
	$states = array('1'=>'Ahmedabad','2'=>'Baroda','3'=>'Bhopal','4'=>'Chandigarh-HP','5'=>'Coimbatore','6'=>'Dehradun','7'=>'East','8'=>'Indore','9'=>'Jabalpur','10'=>'Jaipur','11'=>'Jodhpur', '12'=>'Karnal','13'=>'Lucknow','14'=>'Ludhiana','15'=>'Madurai','16'=>'Nagpur','17'=>'Nasik','18'=>'Pune','19'=>'Punjab-1','20'=>'Punjab-2','21'=>'Raipur','22'=>'Saurashtra','23'=>'Tirupati','24'=>'Trichy','25'=>'Udaipur','26'=>'Vellore','27'=>'Vijayawada','28'=>'Vishakapatnam','29'=>'Warangal', '30'=>'Bangalore', '31'=>'Hospet', '32'=>'Hubli', '33'=>'Varanasi' );

	//$to_emails = array('1'=>'abdulnadeem.ahmed@fullertonindia.com','2'=>'artemishrservices.subhashis.de@fullertonindia.com','3'=>'rajesh.tiwari@fullertonindia.com','4'=>'paramasivam.tp@fullertonindia.com','5'=>'intellect.dinesh.kushwah@fullertonindia.com','6'=>'penta.mapreet.kaur@fullertonindia.com','7'=>'artemishr.sitaram.sharma@fullertonindia.com','8'=>'artemis.subodh.jaiswal@fullertonindia.com,artemis.rani.mardane@fullertonindia.com','9'=>'paramasivam.tp@fullertonindia.com','10'=>'paramasivam.tp@fullertonindia.com','11'=>'artemis.mohdtahseen.assad@fullertonindia.com');

	$to_emails = array('1'=>'tejal.panicker@fullertonindia.com', '2'=>'pinkesh.patel@fullertonindia.com,amitgovindsingh.chandel@fullertonindia.com', '3'=>'deepak.chanpuria@fullertonindia.com','4'=>'sudeep.gupta@fullertonindia.com','5'=>'thirugnanasambandam.m@fullertonindia.com','6'=>'rajiv.singh@fullertonindia.com','7'=>'priyabrata.samal@fullertonindia.com','8'=>'deepak.chanpuria@fullertonindia.com','9'=>'mahua.dutta@fullertonindia.com','10'=>'amit.sindwani@fullertonindia.com','11'=>'pushpendra.mehru@fullertonindia.com', '12'=>'sushil.sachdeva@fullertonindia.com','13'=>'sidhartha.tyagi@fullertonindia.com','14'=>'tarun.raina@fullertonindia.com','15'=>'thangaraju.kalidasan@fullertonindia.com','16'=>'artemis.subodh.jaiswal@fullertonindia.com,artemis.rani.mardane@fullertonindia.com','17'=>'artemis.subodh.jaiswal@fullertonindia.com,artemis.rani.mardane@fullertonindia.com','18'=>'artemis.subodh.jaiswal@fullertonindia.com,artemis.rani.mardane@fullertonindia.com','19'=>'tarun.raina@fullertonindia.com','20'=>'kabir.verma@fullertonindia.com','21'=>'thomas.varghese@fullertonindia.com','22'=>'mehul.shah@fullertonindia.com','23'=>'stalin.mandhadapu@fullertonindia.com','24'=>'magesh.s@fullertonindia.com','25'=>'ajeet.sharm@fullertonindia.com','26'=>'ebenezerdaniel.g@fullertonindia.com','27'=>'n.pardhasaradhi@fullertonindia.com','28'=>'subramanyam.kvs@fullertonindia.com','29'=>'chandrasekhar.sunnapu@fullertonindia.com','30'=>'paramasivam.tp@fullertonindia.com','31'=>'lingaraj.ls@fullertonindia.com','32'=>'Gireeshn.hullur@fullertonindia.com ','33'=>'shailendra.swaroop@fullertonindia.com');

//	$cc_emails = array('1'=>'mohammed.farooq@fullertonindia.com','2'=>'mihir.chakraborty@fullertonindia.com','3'=>'','4'=>'','5'=>'chauhan.ajay@fullertonindia.com','6'=>'nd.singh@fullertonindia.com','7'=>'ashima.sharma@fullertonindia.com','8'=>'','9'=>'','10'=>'','11'=>'mohdtariq.hasan@fullertonindia.com');

	$states = array('1'=>'Ahmedabad','2'=>'Baroda','3'=>'Bhopal','4'=>'Chandigarh-HP','5'=>'Coimbatore','6'=>'Dehradun','7'=>'East','8'=>'Indore','9'=>'Jabalpur','10'=>'Jaipur','11'=>'Jodhpur', '12'=>'Karnal','13'=>'Lucknow','14'=>'Ludhiana','15'=>'Madurai','16'=>'Nagpur','17'=>'Nasik','18'=>'Pune','19'=>'Punjab-1','20'=>'Punjab-2','21'=>'Raipur','22'=>'Saurashtra','23'=>'Tirupati','24'=>'Trichy','25'=>'Udaipur','26'=>'Vellore','27'=>'Vijayawada','28'=>'Vishakapatnam','29'=>'Warangal');

$cc_emails = array('1'=>'ruku.ghosh@fullertonindia.com,manojkumar.jha@fullertonindia.com','2'=>'','3'=>'intellect.dinesh.kushwah@fullertonindia.com, chauhan.ajay@fullertonindia.com','4'=>'rajan.gupta@fullertonindia.com,avneet.thakur@fullertonindia.com,sarvjeet.saini@fullertonindia.com,victor,sharma@fullertonindia.com,girish.chhabra@fullertonindia.com,ameen.kumar@fullertonindia.com,anuj.khurana@fullertonindia.com','5'=>'rajesh.vs@fullertonindia.com,sajeesh.kumarb@fullertonindia.com,prajith.ts@fullertonindia.com,venkatesh.jayabalan@fullertonindia.com,r.venkatesh@fullertonindia.com,amarnath.s@fullertonindia.com,manikandan.s@fullertonindia.com,venkatanarayanan.k@fullertonindia.com,intellect.sindhu.k@fullertonindia.com','6'=>'artemis.mohdtahseen.assad@fullertonindia.com,artemis.subodh.jaiswal@fullertonindia.com,mohdtariq.hasan@fullertonindia.com','7'=>'artemishrservices.subhashis.de@fullertonindia.com,mihir.chakraborty@fullertonindia.com','8'=>' intellect.dinesh.kushwah@fullertonindia.com,chauhan.ajay@fullertonindia.com','9'=>' intellect.dinesh.kushwah@fullertonindia.com,chauhan.ajay@fullertonindia.com','10'=>'ashima.sharma@fullertonindia.com,artemishr.sitaram.sharma@fullertonindia.com ','11'=>'ashima.sharma@fullertonindia.com,artemishr.sitaram.sharma@fullertonindia.com ', '12'=>'sunil.choudhry@fullertonindia.com,ashima.sharma@fullertonindia.com','13'=>'artemis.mohdtahseen.assad@fullertonindia.com,artemis.subodh.jaiswal@fullertonindia.com','14'=>'gupta.ankur@fullertonindia.com','15'=>'chellapandian.g@fullertonindia.com,jebasubash.r@fullertonindia.com,mahimairajan.m@fullertonindia.com,selvaarumugam.p@fullertonindia.com,kaliraj.j@fullertonindia.com,ranjith.m@fullertonindia.com,gopalan.s@fullertonindia.com, r.balaji@fullertonindia.com, intellect.sindhu.k@fullertonindia.com','16'=>'','17'=>'','18'=>'','19'=>'','20'=>'vineshwar.gupta@fullertonindia.com,ramesh.kajal@fullertonindia.com,kumar.s@fullertonindia.com,kailashchander.bansal@fullertonindia.com','21'=>'intellect.dinesh.kushwah@fullertonindia.com,chauhan.ajay@fullertonindia.com','22'=>'husani.vadivala@fullertonindia.com,nirav.buch@fullertonindia.com,talisman.ritesh.modi@fullertonindia.com','23'=>'artemis.venkatesh.a@fullertonindia.com,mohammed.farooq@fullertonindia.com','24'=>'senthilkumar.ss@fullertonindia.com,kumaresan.c@fullertonindia.com,vishnukarthikeyan.s@fullertonindia.com,alex.m@fullertonindia.com,bharathi.s@fullertonindia.com,anandr.v@fullertonindia.com,m.satheesh@fullertonindia.com,intellect.sindhu.k@fullertonindia.com','25'=>'artemishr.sitaram.sharma@fullertonindia.com,ashima.sharma@fullertonindia.com','26'=>'araja.zamseer@fullertonindia.com,ulaganathan.sp@fullertonindia.com,srinivasan.s@fullertonindia.com,gururaja.n@fullertonindia.com,sachidhanandam.r@fullertonindia.com,sivaramakrishnan.n@fullertonindia.com,sivaraj.t@fullertonindia.com,venkatesan.v1@fullertonindia.com,intellect.sindhu.k@fullertonindia.com','27'=>'artemis.venkatesh.a@fullertonindia.com,mohammed.farooq@fullertonindia.com','28'=>'artemis.venkatesh.a@fullertonindia.com,mohammed.farooq@fullertonindia.com','29'=>'artemis.venkatesh.a@fullertonindia.com,mohammed.farooq@fullertonindia.com','30'=>'uttamkumar.g@fullertonindia.com,p.srinivasan@fullertonindia.com,artemis.shwetha.bn@fullertonindia.com','31'=>'shashidhar.hatti@fullertonindia.com,artemis.shwetha.bn@fullertonindia.com','32'=>'ranju.madhavan@fullertonindia.com,nageshask.acharya@fullertonindia.com,ananth.baliga@fullertonindia.com,gopalkrishnag.hejib@fullertonindia.com,artemis.shwetha.bn@fullertonindia.com','33'=>'artemis.mohdtahseen.assad@fullertonindia.com,artemis.subodh.jaiswal@fullertonindia.com');

$Today = date("Y-m-d"); 
$min_date=$Today." 00:00:00";
$max_date=$Today." 23:59:59";

//$min_date="2010-05-31 00:00:00";
//$max_date="2010-05-31 23:59:59";
	
$session_id="";

for($j=1;$j<=29;$j++)
{
	$session_id="";
	$session_id=session_id();
	session_regenerate_id();
	$session_id=session_id();
	//echo "////////////////////////////////////////////////////////////<br>";
	//echo $session_id ; 
	//echo "<br>";
	$search_qry="";
	//$recordcount ="";
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
			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$marital_status."', '".$residential_status."', '".$vehicle_owned."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$row_result["Count_Views"]."', '".$row_result["Count_Replies"]."', '".$row_result["IsModified"]."', '".$row_result["PL_EMI_Amt"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["comment_section"]."','".$row_result["identification_proof"]."')";
			
			$result1=ExecQuery($qry1);
	
		//echo "<br>".$qry1."<br>";
	}
	
	//$qry="select name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments,add_comment,doe   from temp where session_id='".$session_id."' order by doe DESC ";
	
		$qry="select name as Name, email as Email, mobile_number as MobileNumber, emp_status as EmpStatus, c_name as CompanyName, city as City, city_other as Othercity, net_salary as NetSalary, loan_amount as LoanAmount, add_comment as Comment,doe as Dated   from temp where session_id='".$session_id."' order by doe DESC ";
		
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
	$newfileatt = "fullerton/f".$newToday."(".$states[$j].").xls";
//	echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
	if($recordcount>0)
	{
		$emailid = "";
		$emailid_cc = "";
		//	echo "<br>jjjj ".$recordcount."  ghghg<br>";
		$emailid = $to_emails[$j];
		$emailid_cc = $cc_emails[$j];
		

	//	$emailid_cc = "";
		sendexcelfileattachment( $emailid,$session_id,$states[$j],$emailid_cc);
		$lastCount = $j;
	}
	$recordcount=0;
	//$qry1="delete from `temp` where session_id='".$session_id."'";
	//$result1 = ExecQuery($qry1);
	
	
		
		
	
}




function sendexcelfileattachment($emailid,$session_id,$fullecity, $emailid_cc)
	{
		$newToday = date('d')."".date('m')."".date('y')."".date('s');
	//echo $emailid."<br>";
	$to = $emailid; 
	$cc = $emailid_cc.",balbir.singh@deal4loans.com";
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
       $subject = "Personal Loan Leads @ deal4loans.com".$newToday."(".$fullecity.")"; 
 //   $subject = "test ".$newToday."(".$fullecity.")"; 
       
	   $fileatt = "fullerton/f".$newToday."(".$fullecity.").xls";
        $fileatttype = "application/xls"; 
        $fileattname = "f".$newToday."(".$fullecity.").xls";
   
        
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
	*/

?>

<?php
//ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
session_start();

$titles = array('1'=>'1029', '2'=>'1215', '3'=>'1221', '4'=>'1096', '5'=>'1339', '6'=>'1343', '7'=>'1347', '8'=>'1025', '9'=>'1167', '10'=>'1284', '11'=>'1163', '12'=>'1125', '13'=>'1675','14'=>'1295', '15'=>'1287');

	$states = array('1'=>'Ahmedabad', '2'=>'Surat', '3'=>'Baroda', '4'=>'Chandigarh', '5'=>'Kochi', '6'=>'Coimbatore', '7'=>'Erode', '8'=>'KOLKATA', '9'=>'Lucknow', '10'=>'Nagpur', '11'=>'Ludhiana', '12'=>'Jaipur', '13'=>'Karnal', '14'=>'Nasik', '15'=>'Goa');

	$to_emails = array('1'=>'artemis.subodh.jaiswal@fullertonindia.com', '2'=>'artemis.subodh.jaiswal@fullertonindia.com', '3'=>'artemis.subodh.jaiswal@fullertonindia.com', '4'=>'artemis.subodh.jaiswal@fullertonindia.com', '5'=>'artemis.subodh.jaiswal@fullertonindia.com', '6'=>'artemis.subodh.jaiswal@fullertonindia.com', '7'=>'artemis.subodh.jaiswal@fullertonindia.com', '8'=>'artemis.subodh.jaiswal@fullertonindia.com', '9'=>'artemis.subodh.jaiswal@fullertonindia.com', '10'=>'artemis.subodh.jaiswal@fullertonindia.com', '11'=>'artemis.subodh.jaiswal@fullertonindia.com', '12'=>'artemis.subodh.jaiswal@fullertonindia.com', '13'=>'artemis.subodh.jaiswal@fullertonindia.com', '14'=>'artemis.subodh.jaiswal@fullertonindia.com', '15'=>'artemis.subodh.jaiswal@fullertonindia.com');

//$cc_emails = array('1'=>'tejal.panicker@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '2'=>'mayank.gandhi@fullertonindia.com, vivek.vishwakarma@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '3'=>'artemis.subodh.jaiswal@fullertonindia.com', '4'=>'sudeep.gupta@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '5'=>'thirugnanasambandam.m@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '6'=>'thirugnanasambandam.m@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '7'=>'thirugnanasambandam.m@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '8'=>'vikrant.kumar@fullertonindia.com, mihir.chakraborty@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '9'=>'sidhartha.tyagi@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '10'=>'deepak.dhone@fullertonindia.com, pankaj.jawanjal@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '11'=>'tarun.raina@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '12'=>'artemis.subodh.jaiswal@fullertonindia.com', '13'=>'artemis.subodh.jaiswal@fullertonindia.com');

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

//$Today = date("Y-m-d"); 
//$min_date=$Today." 00:00:00";
//$max_date=$Today." 23:59:59";
	
$session_id="";

for($j=1;$j<=13;$j++)
{
	$session_id="";
	$session_id=session_id();
	//session_regenerate_id();
	$session_id=session_id();

	$search_qry="";

	$search_qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal LEFT OUTER JOIN Req_Feedback ON 		Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in (".$titles[$j].") WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID in (".$titles[$j].") and Req_Feedback_Bidder1.Reply_Type='1' and (Req_Feedback_Bidder1.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' ) ";	

	//echo "<br>".$search_qry."<br>";

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
			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, Feedback, count_views, count_replies, is_modified, is_processed, pincode, doe, card_vintage, card_limit,ip_address,add_comment,Documents) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$marital_status."', '".$residential_status."', '".$vehicle_owned."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$row_result["Count_Views"]."', '".$row_result["Count_Replies"]."', '".$row_result["IsModified"]."', '".$row_result["PL_EMI_Amt"]."', '".$row_result["Pincode"]."', '".$Dateofallocation."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["comment_section"]."','".$row_result["identification_proof"]."')";
			$result1=ExecQuery($qry1);
			//echo "<br>".$qry1."<br>";
	}
	
	$qry="select name, email, mobile_number, emp_status, c_name, city, city_other, net_salary, loan_amount, add_comment, doe   from temp where session_id='".$session_id."' order by doe DESC ";
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
		
	    //$emailid_cc = "";
		sendexcelfileattachment( $emailid,$session_id,$states[$j],$emailid_cc);
		$lastCount = $j;
	}
	$recordcount=0;
	//$qry1="delete from `temp` where session_id='".$session_id."'";
	//$result1 = ExecQuery($qry1);
	
}

function sendexcelfileattachment($emailid,$session_id,$fullecity, $emailid_cc)
	{
		$newToday = date('d')."".date('m')."".date('y')."".date('s');
	//echo $emailid."<br>";
	$to = $emailid; 
	$cc = $emailid_cc.",balbir.singh@deal4loans.com";


		
		//$to = "balbirsingh499@gmail.com";
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
		$headers .= "Bcc: balbirsingh499@gmail.com"."\n";
    
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