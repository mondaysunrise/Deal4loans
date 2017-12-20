<?php
//Commented To and CC
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';


	function getReqemailValue($pKey){
    $titles = array(
		'4620' => 'Neha.Sharma@sc.com,Rabindar.Prasad@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'4621' => 'Neha.Sharma@sc.com,Rabindar.Prasad@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'4573' => 'Neha.Sharma@sc.com,Rabindar.Prasad@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'4622' => 'MansiBipin.Shah@sc.com,sujeet.tiwari@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'4562' => 'MansiBipin.Shah@sc.com,Pratiksha.Mane@sc.com,sujeet.tiwari@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'4625' => 'MansiBipin.Shah@sc.com,Pratiksha.Mane@sc.com,sujeet.tiwari@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'3302' => 'MansiBipin.Shah@sc.com,sujeet.tiwari@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'3303' => 'moushumi.sheikh@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'2764' => 'Rupen.Chowdhury@sc.com,Indrani.Dey@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'2780' => 'Dhanya.Rai@sc.com,Selva.Kumar@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'3136' => 'Moushumi.Sheikh@sc.com,Jacqualine.David@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'2680' => 'Bharti.Naik@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com',
		'2781' => 'Prasanna.Kumar2@sc.com,Sudhakar.Ganapathy@sc.com,sagar.lodhi@deal4loans.com,balbir.singh@gmail.com'
		 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

  function getReqcityValue($pKey){
    $titles = array(
		'4620' => 'Chandigharh',
		'4621' => 'jaipur',
		'4573' => 'Delhi',
		'4622' => 'Baroda',
		'4562' => 'Ahemadabad',
		'4625' => 'Rajkot',
		'3302' => 'Mumbai',
		'3303' => 'Pune',
		'2764' => 'Kolkata',
		'2780' => 'Bangalore',
		'3136' => 'Hyderabad',
		'2680' => 'Complete'
		 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

	
function retrivedataforstanc()
	{
	$session_id=session_id();
	//$Today = "2015-07-06"; 
	$Today = date("Y-m-d"); 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	$stancpl = array('4620','4621','4573','4622','4562','4625','3302','3303','2764','2780','3136','2680');
	
	for($k=0;$k<count($stancpl);$k++)
		 {
		if($stancpl[$k]==2680)
			 {
			$stancquery="SELECT * FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (4620,4621,4573,4622,4562,4625,3302,3303,2764,2780,3136) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
			 }
			 else
			 {
	$stancquery="SELECT * FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (".$stancpl[$k].") and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
			 }
	$search_result=ExecQuery($stancquery);
	$recordcount = mysql_num_rows($search_result);
	//echo "i m in else".$stancquery."<br><br>";
 
	while($row_result=mysql_fetch_array($search_result))
	{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
			
			if($row_result["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($row_result["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($row_result["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($row_result["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($row_result["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}
			
	 $qry1="insert into temp (session_id, name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed, loan_amount, Feedback, card_vintage, card_limit, ip_address,Documents ,add_comment,doe) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$row_result["Mobile_Number"]."','".$row_result["Std_Code"]."', '".$row_result["Landline"]."','".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."','".$emp_status."','".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."','".$row_result["Pincode"]."','".$cc_holder."','".$row_result["Net_Salary"]."','".$row_result["Loan_Any"]."','".$emi_paid."','".$row_result["PL_EMI_Amt"]."','".$row_result["Loan_Amount"]."','".$row_result["Feedback"]."','".$card_vintage."','".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["identification_proof"]."','".$row_result["comment_section"]."','".$row_result["Allocation_Date"]."')";
	$result1=ExecQuery($qry1);
	//echo"<br><br>";
		 }

	$emailid=getReqemailValue($stancpl[$k]);
	$cityname=getReqcityValue($stancpl[$k]);

	 $qry="select name, dob AS DOB, email AS EmailID, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS NoOfEMIPaid, loan_amount AS LoanAmt, card_vintage AS CardVintage, ip_address AS IPAddress,add_comment AS comments,doe AS DateOfEntry  from temp where session_id='".$session_id."' order by doe DESC ";
				
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
	$newfileatt = "/home/deal4loans/public_html/pldwnld/stanc2680".$cityname."".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id, $emailid,$cityname);
			 }	
		 }
	}

	function sendexcelfileattachment($emailid,$session_id, $emailid,$cityname)
	{
		$newToday = date('d')."".date('m')."".date('y');
		//$to = "ranjana5chauhan@gmail.com"; 
		$to = $emailid; 
	
        $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Personal Loan Leads @ deal4loans.com".$cityname."".$newToday;     
       
	    $fileatt = "/home/deal4loans/public_html/pldwnld/stanc2680".$cityname."".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "stanc2680".$cityname."".$newToday.".xls";
        
        $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";			
		$semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		//$headers .= "Cc: sagar.lodhi@deal4loans.com,balbir.singh@deal4loans.com"."\n";	
		$headers .= "Bcc: other4domain@gmail.com"."\n";	
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
main();
function main()
{
	retrivedataforstanc();
}
?>