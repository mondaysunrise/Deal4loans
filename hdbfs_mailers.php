<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
session_start();

$Today = date("Y-m-d"); 
$min_date=$Today." 00:00:00";
$max_date=$Today." 23:59:59";
	
$session_id="";

$titles = array('1'=>'2400', '2'=>'2401', '3'=>'2402', '4'=>'2403', '5'=>'2404', '6'=>'2405', '7'=>'2406', '8'=>'2407', '9' =>'2457', '10' =>'2458', '11' =>'2459', '12' =>'2460', '13' =>'2461', '14' =>'2462', '15' =>'2463', '16' =>'2464', '17' =>'2465', '18' =>'2466', '19' =>'2467', '20' =>'2468', '21' =>'2469', '22' =>'2470', '23' =>'2471', '24' =>'2472', '25' =>'2473', '26' =>'2474', '27' =>'2475', '28' =>'2691' , '29' =>'3096');

$states = array('1'=>'Ahmedabad', '2'=>'Kolkata', '3'=>'Jaipur', '4'=>'Chandigarh', '5'=>'Lucknow', '6'=>'Jalandhar', '7'=>'Cochin','8'=>'Nagpur', '9' =>'Salem', '10' =>'Dehradun', '11' =>'Madurai', '12' =>'Nasik', '13' =>'Vadodara', '14' =>'Jamnagar', '15' =>'Rajkot', '16' =>'Surat', '17' =>'Aurangabad', '18' =>'Ahmednagar', '19' =>'Indore', '20' =>'Panipat', '21' =>'Vishakapatnam', '22' =>'Coimbatore', '23' =>'Hyderabad', '24' =>'Bangalore', '25' =>'Chennai', '26' =>'Pune', '27' =>'Mumbai', '28' =>'Delhi', '29' =>'Trivandrum');

$to_emails = array('1' => 'vasim.samadji@hdbfs.com', '2'=>'hdb.kolkatacbd@hdbfs.com', '3'=>'hdb.salariedjaipur@hdbfs.com', '4'=>'anuj.khurana@hdbfs.com', '5'=>'hdb.hazratganj@hdbfs.com,kirti.shukla@hdbfs.com', '6'=>'sawindar.singh@hdbfs.com', '7'=>'prajith.s@hdbfs.com', '8'=>'rishiraj.naidu@hdbfs.com', '9' =>'Raja.Zamseer@hdbfs.com,Hdbsalem@hdbfs.com', '10' =>'tarun.aggarwal@hdbfs.com', '11' =>'srinivasan.r@hdbfs.com,hdb.madurai@hdbfs.com', '12' =>'Deepak.dhone@hdbfs.com', '13' =>'amish.dhruv@hdbfs.com', '14' =>'hdb.jamnagar@hdbfs.com', '15' =>'jignesh.kothari@hdbfs.com', '16' =>'hitesh.parmar@hdbfs.com', '17' =>'jitesh.bilwanikar@hdbfs.com', '18' =>'sameer.pathan@hdbfs.com', '19' =>'hitesh.jain@hdbfs.com', '20' =>'hdb.panipat@hdbfs.com', '21' =>'Swetha.d@hdbfs.com', '22' =>'Prakash.S@hdbfs.com', '23' =>'vijay.podipireddy@hdbfs.com', '24' =>'manoj.singh@hdbfs.com; shajeev.rajasekharan@hdbfs.com', '25' =>'mohanasundaram.s@hdbfs.com', '26' =>'vishwavijaykumar.singh@hdbfs.com', '27' =>'manish.pandey@hdbfs.com', '28' =>'hdb.rajendraplace@hdbfs.com', '29' =>'Rajasekharan.r@hdbfs.com');

$cc_emails = array('1'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '2'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '3'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '4'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '5'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '6'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '7'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '8'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '9'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '10'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '11'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '12'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '13'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '14'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '15'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '16'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '17'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '18'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '19'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '20'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '21'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '22'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '23'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com, manoj.singh@hdbfs.com', '24'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '25'=>'reman.menon@hdbfs.com,manoj.singh@hdbfs.com,namrata.medhi@deal4loans.com,balbir.singh@deal4loans.com', '26'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '27'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '28'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com', '29'=>'namrata.medhi@deal4loans.com, balbir.singh@deal4loans.com, venkata.swamy@hdbfs.com');	

for($j=1;$j<=29;$j++)
{
	$session_id="";
	$session_id=session_id();
	//session_regenerate_id();
	$session_id=session_id();

	$search_qry="";

	$search_qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID in (".$titles[$j].") and Req_Feedback_Bidder1.Reply_Type='1' and (Req_Feedback_Bidder1.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' ) ";	

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
//			echo "<br>".$qry1."<br>";
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
	$newfileatt = "/home/deal4loans/public_html/hdbfs/hdbfs".$newToday."(".$states[$j].").xls";
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
   $subject = "Deal4loans Fresh Lead Allocated on ".$newToday." in ".$fullecity.""; 
   //$subject = "test ".$newToday."(".$fullecity.")"; 

   $fileatt = "/home/deal4loans/public_html/hdbfs/hdbfs".$newToday."(".$fullecity.").xls";
   $fileatttype = "application/xls"; 
   $fileattname = "hdbfs".$newToday."(".$fullecity.").xls";

	
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
	


?>