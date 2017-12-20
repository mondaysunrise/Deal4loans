<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
if (!empty($_SERVER['REMOTE_ADDR']))
{
    exit; 
}
else
{
	main();
}
	function getReqemailValue($pKey){
    $titles = array(
		'5897' => 'kapildev@lthousingfinance.com',
		'5896' => 'MOHDMUSHAFIQKHAN@Lthousingfinance.com',
		'5900' => 'HirenGohil@Lthousingfinance.com',
		'5898' => 'priyankashetty@ltfinance.com',
		'5899' => 'Rajshekhar@lthousingfinance.com',
		'5895' => 'avinashkumar3@ltfinance.com',
		'5894' => 'anishpillai@lthousingfinance.com',
		'5893' => 'GandhamKiranKumar@Lthousingfinance.com'
		 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function getReqemailCCValue($pKey){
    $titles = array(
		'5897' => 'DilvarKumar@Lthousingfinance.com',
		'5896' => 'JatinSachdeva@Lthousingfinance.com',
		'5900' => 'AbhijeetDandekar@Lthousingfinance.com',
		'5898' => 'sanjaygavli@ltfas.com',
		'5899' => 'nitinverma@lthousingfinance.com',
		'5895' => 'NagmaniSingh@Lthousingfinance.com',
		'5894' => 'muhammadmeeran@lthousingfinance.com',
		'5893' => 'SrikanthDandamudi@Lthousingfinance.com'
	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

  function getReqcityValue($pKey){
    $titles = array(
		'5897' => 'Chandigarh',
		'5896' => 'Delhi',
		'5900' => 'Ahmedabad',
		'5898' => 'Mumbai',
		'5899' => 'Pune',
		'5895' => 'Bangalore',
		'5894' => 'Chennai',
		'5893' => 'Hyderabad'
		 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function retrivedatafortata()
{
	$session_id=session_id();
	$Today=Date('Y-m-d');
	//$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	//$Today=date('Y-m-d',$tomorrow);
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	$hdfchl = array('5897','5896','5900','5898','5899','5895','5894','5893');

	for($k=0;$k<count($hdfchl);$k++)
	{
	 	$citifinquery="SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,AllRequestID FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE (Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (".$hdfchl[$k].") and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
		$search_result=ExecQuery($citifinquery);
		$recordcount = mysql_num_rows($search_result);
		//echo "i m in else".$citifinquery."<br><br>";

	while($row_result=mysql_fetch_array($search_result))
	{	
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
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
		if($row_result["City"]=="Others" && strlen($row_result["City_Other"])>0)
		{
			$strCity=$row_result["City_Other"];
		}
		else
		{
			$strCity=$row_result["City"];
		}
		
		$comment=$row_result["Add_Comment"];
		
		$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, pincode, doe, card_vintage, card_limit,ip_address,add_comment) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$strCity."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$residential_status."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."',  '".$row_result["Pincode"]."', '".$row_result["Allocation_Date"]."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$comment."')";
		$result1=ExecQuery($qry1);
	}
	
	$emailid=getReqemailValue($hdfchl[$k]);
	$emailid=getReqemailValue($hdfchl[$k]);
	$ccemailid=getReqemailCCValue($hdfchl[$k]);
	
	$qry="select name AS Name, email AS Emailid, mobile_number AS MobileNo, dob AS DOB, emp_status AS Occupation, c_name AS Company_Name, city AS City, city_other AS OtherCity, net_salary AS AnnualIncome, residential_status AS ResiStatus, loan_amount AS LoanAmount, pincode AS Pincode, doe AS DateOfEntry, ip_address AS IPaddress from temp where session_id='".$session_id."' order by doe DESC ";
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
	$result = ExecQuery($qry);
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
	$newToday = date('d')."".date('m')."".date('y');

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/hldwnld/lntHF5901".$cityname."".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
			if($recordcount>0)
			{
				sendexcelfileattachment( $emailid,$session_id, $emailid, $ccemailid, $cityname);
			}
		 }		 
	}

	function sendexcelfileattachment($emailid,$session_id,$emailid, $ccemailid, $cityname)
	{
		$newToday = date('d')."".date('m')."".date('y');
		$to = $emailid; 
		$from = "Deal4loans <no-reply@deal4loans.com>"; 
		$subject = "Home Loan Leads @ deal4loans.com ".$cityname."".$newToday; 
		$fileatt = "/home/deal4loans/public_html/hldwnld/lntHF5901".$cityname."".$newToday.".xls";
		$fileatttype = "application/xls"; 
		$fileattname = "lntHF5901".$cityname."".$newToday.".xls";
           
		$file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";			
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: ".$ccemailid.", rajiv.prasad@deal4loans.com"."\n";		   
		//$headers .= "Bcc: testing4use@gmail.com"."\n";		   
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
            echo "<p>The email was sent.</p>";          
        }
        else {
            echo "<p>There was an error sending the mail.</p>";         
        }
		$qry1="delete from `temp` where session_id='".$session_id."'";
		$result1 = ExecQuery($qry1);
    }

function main()
{
	retrivedatafortata();
}
?>