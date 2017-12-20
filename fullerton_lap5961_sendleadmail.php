<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

if (!empty($_SERVER['REMOTE_ADDR']))
{
	exit; 
}
else
{
	retrivedataforfullerton();
}

function retrivedataforfullerton()
	{
	$session_id=session_id();
	//$Today = "2015-07-06"; 
	$Today = date("Y-m-d"); 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	
	$stancquery="SELECT * FROM Req_Feedback_Bidder_LAP,Req_Loan_Against_Property WHERE Req_Feedback_Bidder_LAP.AllRequestID=Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder_LAP.BidderID=5961 and Req_Feedback_Bidder_LAP.Reply_Type=5 and Req_Feedback_Bidder_LAP.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
				
	$search_result=ExecQuery($stancquery);
	$recordcount = mysql_num_rows($search_result);
	echo "i m in else".$stancquery."<br><br>";
 
	while($row_result=mysql_fetch_array($search_result))
	{
		$exclusiveLead = '';
				if($row_result["Bidder_Count"]==1)
				{				
					$exclusiveLead = "Exclusive Lead";
				}
			if($row_result["Property_Type"]==1) { $property_type="Residential"; } elseif($row_result["Property_Type"]==2) { $property_type="Commercial"; }
			if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
	
			$Dateofallocation = $row_result["Allocation_Date"];
					
			$dob=$row_result["DOB"];

			$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, mobile_number, net_salary, pincode, property_value, loan_amount, Feedback, doe,add_comment, request_id, property_type, current_age) values ('".$session_id."', '".$row_result["Name"]."', '".$dob."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$row_result["Pincode"]."', '".$row_result["Property_Value"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Feedback"]."', '".$Dateofallocation."','".$row_result["comment_section"]."','".$row_result["Feedback_ID"]."','".$property_type."','".$exclusiveLead."')";
			$result1=ExecQuery($qry1);		
		 }

	 $qry="select name AS Name, dob AS DOB, email AS Email, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, net_salary AS AnnualIncome, pincode AS Pincode, descr, property_type AS PropertyType, property_value AS PropertyValue, loan_amount AS LoanAmount, Feedback, doe AS DOE,current_age AS LeadType from temp where session_id='".$session_id."' order by doe DESC";
				
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
	$newfileatt = "/home/deal4loans/public_html/lapdwnld/fullerton5961".$newToday.".xls";
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
		
		$to = "amrita.soni@fullertonindia.com"; 	
        $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "LAP Leads @ deal4loans.com".$newToday;        
	    $fileatt = "/home/deal4loans/public_html/lapdwnld/fullerton5961".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "fullerton5961".$cityname."".$newToday.".xls";
        
        $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";			
		$semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: sumiti.aggarwal@deal4loans.com"."\n";	
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

?>