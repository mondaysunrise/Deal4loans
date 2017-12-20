<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
$session_id=session_id();

	$Today = date("Y-m-d"); 
$min_date=$Today." 00:00:00";
$max_date=$Today." 23:59:59";
	
	$search_query = "select * from Req_Loan_Home LEFT OUTER JOIN Req_Feedback_Bidder1 on Req_Loan_Home.RequestID=Req_Feedback_Bidder1.AllRequestID  where  Req_Feedback_Bidder1.BidderID in (2249) and (Req_Feedback_Bidder1.Allocation_Date between '".$min_date."' and '".$max_date."' )";
	
	//echo "hello1".$search_query."<br>";
	$result = ExecQuery($search_query);
	$recorcount = mysql_num_rows($result);
if($recorcount>0)
{
	$ii = 1;
	while($row = mysql_fetch_array($result))
	{
		
		
		$EmpStatus =  '';
		if($row["Employment_Status"]==1)
		{
			$EmpStatus = "Salaried";
		}
		else
		{
			$EmpStatus = "Self Employed";
		}
		
		
		$qry1 = "";
$qry1="insert into temp (session_id, name, mobile_number, dob, email, city, city_other, std_code, landline, net_salary,  plan_interested , pincode, add_comment, doe) values ('".$session_id."', '".$ii."', '".$row["Name"]."', '".$row["City"]."', '".$EmpStatus."', '".$row["Loan_Amount"]."', 'HL', 'N A', '".$row["Mobile_Number"]."', '".$row["Email"]."','".$row["Property_Value"]."', '".$row["Net_Salary"]."', 'N A', 'N A' )";
		
			$result1=ExecQuery($qry1);
	 $ii = $ii + 1;
	//echo "<br>".$qry1."<br>";
	}


	$qry = '';
	$qry="select name as SNo, mobile_number as CustomerName, dob as City, email as CustomerType, city as LoanAmountRequired, city_other as Product, std_code as Landline, landline as CellNo, net_salary as EmailId,  plan_interested  as PropertyDetails, pincode as IncomeDetails, add_comment as VerificationsDetails, doe as Remarks from temp where session_id='".$session_id."' order by doe DESC ";
	
	//echo "<br><br>".$qry."<br>";
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
 //echo $retnewdata;

	$newToday = date('d')."".date('m')."".date('y')."".date('s');
	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/firstblue/firstblue".$newToday.".xls";
//	echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
	
  sendexcelfileattachment($session_id);
		
}




function sendexcelfileattachment($session_id)
	{
		$newToday = date('d')."".date('m')."".date('y')."".date('s');
	//echo $emailid."<br>";

    $from = "Deal4loans <no-reply@deal4loans.com>"; 
       $subject = "FirstBlue Leads @ Deal4loans.com"; 

  
		$to = "Poonam.tripathi@firstblue.co.in,Neha.walia@firstblue.co.in,garima.kapoor@firstblue.co.in";
		$Cc = "sales@firstblue.co.in,ruchika.chawla@firstblue.co.in,shveta.sharma77@gmail.com";

	   $fileatt = "/home/deal4loans/public_html/firstblue/firstblue".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "firstblue".$newToday.".xls";
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
			$headers .= "cc: ".$Cc.""."\n";
			//$headers .= "Bcc: ".$Bcc.""."\n";
    
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
             echo "<p>The email was sent</p>";  
        }
        else { 
              echo "<p>There was an error sending the mail.</p>"; 
         
        }
	
          $qry1="delete from `temp` where session_id='".$session_id."'";
	//	echo "<br>".$qry1;
		
	$result1 = ExecQuery($qry1);
    
    }
	
?>