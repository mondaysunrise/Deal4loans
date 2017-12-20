<?php
//Commented To and CC and BCC
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	
function retrivedataforbajaj()
	{
	$session_id=session_id();
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$Today=date('Y-m-d',$tomorrow);
	//$Today = "2012-01-28";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	$citifinquery="SELECT RequestID,Name,DOB,Email,Mobile_Number,Std_Code,	Landline,Company_Name,City,City_Other,Pincode,Net_Salary,Loan_Any,Loan_Amount,IP_Address,Add_Comment,Allocation_Date,Employment_Status,EMI_Paid,CC_Holder,Card_Vintage,BidderID FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (2423,2424,2425,2426,2432,2434,2435,2436,2437,2441,2443,2444,2445,2446,2448,2449,2450,2451,3335,3629,3645,3842,3953,3966,3967,4631,4656,4910,4912,4928,5074,5078) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
	
	$search_result=ExecQuery($citifinquery);
	$recordcount = mysql_num_rows($search_result);
	//echo "i m in else".$citifinquery."<br><br>";

	while($row_result=mysql_fetch_array($search_result))
	{	
		 $descr="";
		$asmtype="";
			if($row_result['BidderID']=="2425")
			{
				$asmtype="Juber Chaudhary";
			}
			else if($row_result['BidderID']=="2424")
			{
				$asmtype="Narendran PD - Navitha";
			}
			else if($row_result['BidderID']=="3645")
			{
				$asmtype="Pradeep Mishra";
			}
			else if($row_result['BidderID']=="3842")
			{
				$asmtype="Sardar Badshah";
			}
			else if($row_result['BidderID']=="2429")
			{
				$asmtype="Kapil Dowlani";
			}
			else if($row_result['BidderID']=="3335")
			{
				$asmtype="Sanjeev - Ranjan";
			}
			else if($row_result['BidderID']=="3953")
			{
				$asmtype="Sanjeev - Abhinav";
			}
			else if($row_result['BidderID']=="2423")
			{
				$asmtype="Neeraj - Priya";
			}
			else if($row_result['BidderID']=="3966")
			{
				$asmtype="Neeraj - Ramesh";
			}
			else if($row_result['BidderID']=="3967")
			{
				$asmtype="Dinesh - Prem";
			}
			else if($row_result['BidderID']=="2426")
			{
				$asmtype="Kartik Dua - Surender";
			}
			else if($row_result['BidderID']=="4656")
			{
				$asmtype="Vicky - Narendra";
			}
			else if($row_result['BidderID']=="5108")
			{
				$asmtype="Priyanka S";
			}
			else if($row_result['BidderID']=="4631")
			{
				$asmtype="Tushar Bahl";
			}
			else if($row_result['BidderID']=="5300")
			{
				$asmtype="Tamil";
			}
			else if($row_result['BidderID']=="5458")
			{
				$asmtype="Raghavan";
			}
			else if($row_result['BidderID']=="5457")
			{
				$asmtype="Dharam Singh";
			}
			else if($row_result['BidderID']=="5888")
			{
				$asmtype="Gopi";
			}
			else
			{
				$asmtype="";
				$descr="";
			}

//echo $descr."<br><br>";

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
			
		

	$qry1="insert into temp (session_id, name, dob, email, mobile_number, std_code, landline, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid, loan_amount, card_vintage,  ip_address, add_comment,doe,descr) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$row_result["Mobile_Number"]."','".$row_result["Std_Code"]."', '".$row_result["Landline"]."','".$emp_status."','".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."','".$row_result["Pincode"]."','".$cc_holder."','".$row_result["Net_Salary"]."','".$row_result["Loan_Any"]."','".$emi_paid."','".$row_result["Loan_Amount"]."','".$card_vintage."','".$row_result["IP_Address"]."','".$row_result["Add_Comment"]."','".$row_result["Allocation_Date"]."','".$asmtype."')";

			$result1=ExecQuery($qry1);
			//echo "".$qry1."<br>";
		
		 }
	
	//echo $qry1."<br>";
	
	$qry="select name, dob AS DOB, email AS EmailID, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS NoOfEMIPaid, loan_amount AS LoanAmt, card_vintage AS CardVintage, ip_address AS IPAddress,add_comment AS comments,doe AS DateOfEntry, descr AS AgentName   from temp where session_id='".$session_id."' order by doe DESC ";
		
	
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
 

//echo $citifincity."hello::";
$newToday = date('d')."".date('m')."".date('y');
//$newToday ="170810";

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/bajajfinserv/bajajpl".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id);
			 }
		 
	}

	function sendexcelfileattachment($emailid,$session_id)
	{
		//$newToday ="170810";
		$newToday = date('d')."".date('m')."".date('y');
	
		$to = "Sandeep.shinde@bassindia.com,ajay.chaudhary@bajajfinserv.in"; 

       $from = "Deal4loans <no-reply@deal4loans.com>"; 
       $subject = "Personal Loan Leads @ deal4loans.com ".$newToday; 
				       
	   $fileatt = "/home/deal4loans/public_html/bajajfinserv/bajajpl".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "bajajpl".$newToday.".xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: prijith.padmanabhan@bassindia.com,sachin.whig@bajajfinserv.in,balbir.singh@deal4loans.com"."\n";
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
	retrivedataforbajaj();
}
?>