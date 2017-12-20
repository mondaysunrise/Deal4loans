<?php
//Commented To and CC
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	
function retrivedataforcitifin()
	{
	$session_id=session_id();
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$Today=date('Y-m-d',$tomorrow);

	//$Today = "2012-01-28";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	$citifinquery="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Education WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Education.RequestID and Req_Feedback_Bidder1.BidderID = 2689 and Req_Feedback_Bidder1.Reply_Type=9 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
	$search_result=ExecQuery($citifinquery);
	$recordcount = mysql_num_rows($search_result);
	echo "i m in else".$citifinquery."<br><br>";
 
	while($row_result=mysql_fetch_array($search_result))
	{
		
		if($row_result["Course"]==2) { $Course="Post Graduation Courses";}
		if($row_result["Course"]==3) {$Course="Graduation Courses";}
		if($row_result["Course"]==4) {$Course="Other Courses";}
		if($row_result["Course"]=="") {$Course="";}

		if($row_result["Employment_Status"]==1) { $Employment_Status="Salaried";}
		if($row_result["Employment_Status"]==2) { $Employment_Status="Self Employed";}
		if($row_result["Employment_Status"]==3) { $Employment_Status="Not Earning";}
		if($row_result["Employment_Status"]==0) { $Employment_Status="";}

		if($row_result["Country"]==1) {$Country="India";}
		if($row_result["Country"]==2) {$Country="UK";}
		if($row_result["Country"]==3) {$Country="USA";}
		if($row_result["Country"]==4) {$Country="Other Country";}
		if($row_result["Country"]==0) {$Country="";}

		if($row_result["Residence_City"]=="Others" && strlen($row_result["Residence_City_Other"])>0)
		{
		$City=$row_result["Residence_City_Other"];
		}
		else
		{
		$City=$row_result["Residence_City"];
		}

		$qry1="insert into temp (session_id, name, email, city, city_other, mobile_number, emp_status, loan_amount, dob, doe,is_processed,net_salary) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["Email"]."', '".$City."', '".$row_result["Residence_City_Other"]."', '".$row_result["Mobile_Number"]."', '".$Employment_Status."', '".$row_result["Loan_Amount"]."', '".$Course."', '".$row_result["Allocation_Date"]."','".$Country."','".$row_result["Course_Name"]."')";
		$result1=ExecQuery($qry1);
		
		$emailid="Rohinib_credila@yahoo.com,komalk@credila.com";

		 }
	
	//echo $qry1."<br>";
	$qry="select name AS Name, email AS Email, mobile_number AS Mobile_No, city AS City, is_processed AS Country_of_Interest, dob AS Course_of_Interest,net_salary AS Course_Name,  loan_amount AS Require_Education_Loan, emp_status AS Income_Status, doe AS DateOfEntry from temp where session_id='".$session_id."' order by doe DESC";

	//echo $qry."<br>";
			
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
//$newToday ="280112";

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/hdfc/hdfcel".$newToday.".xls";
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
	
		$newToday = date('d')."".date('m')."".date('y');
	
	$to = "leads@credila.com,vickyf@credila.com"; 
	
	//$to = "ranjana5chauhan@gmail.com"; 
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Education Loan Leads @ deal4loans.com".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/hdfc/hdfcel".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "hdfcel".$newToday.".xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: shweta.sharma@deal4loans.com"."\n";
	    //$headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
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
	retrivedataforcitifin();
}
?>