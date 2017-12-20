<?php
//Commented To and CC 
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	
function retrivedataforcitifin()
	{
	$session_id=session_id();
	
	$Today = date("Y-m-d"); 
//	$Today = "2012-05-11";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	$getCityDetailsSql = "select * from axis_mailers where status=1";
	$getCityDetailsQuery = ExecQuery($getCityDetailsSql);
	$numgetCityDetails = mysql_num_rows($getCityDetailsQuery);
	
	for($iii=0;$iii<$numgetCityDetails;$iii++)
	{
		$City =mysql_result($getCityDetailsQuery,$iii,'City');
		$to =mysql_result($getCityDetailsQuery,$iii,'to');
		$cc =mysql_result($getCityDetailsQuery,$iii,'cc');
		
		$citifinquery="SELECT Property_Identified,Employment_Status,Name,DOB,Email,Company_Name,City,City_Other,Pincode,Mobile_Number,Net_Salary,Add_Comment,Loan_Amount,Property_Loc,Allocation_Date FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE (Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (3613,3608,3609,3606,3610,3607,2414) and Req_Loan_Home.City='".$City."' and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Allocation_Date Between '".($min_date)."' and '".($max_date)."')  ";
			
		$search_result=ExecQuery($citifinquery);
		$recordcount = mysql_num_rows($search_result);
		echo "<br>i m in else".$citifinquery."<br>recordcount-".$recordcount."<br><br>";
	 
		while($row_result=mysql_fetch_array($search_result))
		{
				if($row_result["Property_Identified"]==0){ $property_identified="No";}
				elseif($row_result["Property_Identified"]==1) { $property_identified="Yes";}
				else { $property_identified="";}
				if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
							
				$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, pincode, mobile_number, net_salary, descr, loan_amount, property_identified, property_loc, doe ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Pincode"]."',  '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$row_result["Add_Comment"]."', '".$row_result["Loan_Amount"]."',  '".$property_identified."', '".$row_result["Property_Loc"]."', '".$row_result["Allocation_Date"]."')";
				//echo "".$qry1."<br>";
					$result1=ExecQuery($qry1);
				//echo "".$qry1."<br>";
		 
			 }
		
		//echo $qry1."<br>";
		//echo "<br>";
		$qry="select name, dob, email, std_code, landline, std_code_o, landline_o, mobile_number, emp_status, c_name, city, city_other, pincode, net_salary, descr, loan_amount, Feedback, property_identified, property_loc, budget, residence_address, loan_time, doe, add_comment from temp where session_id='".$session_id."' order by doe DESC";
			
		
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
		$newfileatt = "/home/deal4loans/public_html/AxisBank/axisbank".$City."".$newToday.".xls";
		//echo "fine".$newfileatt."<br>";
		$newfile = fopen( $newfileatt, 'w+' ); 
		$dataold=fwrite($newfile, $retnewdata);
		fclose( $newfile );
		if($recordcount>0)
		{
			sendexcelfileattachment( $session_id,$to,$cc,$City);
		}	

	}	

}
	
	function sendexcelfileattachment($session_id,$to,$cc,$City)
	{
		
		$newToday = date('d')."".date('m')."".date('y');

		echo $to ; 
		echo "<br>";
		echo $cc;

       $from = "Deal4loans <no-reply@deal4loans.com>"; 
       $subject = "HomeLoan Leads @ deal4loans.com".$newToday." for ".$City; 
    
       
	   $fileatt = "/home/deal4loans/public_html/AxisBank/axisbank".$City."".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "axisbank".$newToday.".xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		
		//$headers .= "Cc:neha.gupta@deal4loans.com"."\n";
		
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