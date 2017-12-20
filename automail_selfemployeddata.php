<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

Selemployed_PL();

function Selemployed_PL()
{
$session_id=session_id();
$today=Date('Y-m-d');
//$today="2016-09-07";
$mindate=$today." 00:00:00";
$maxdate=$today." 23:59:59";
$query="SELECT
Name,Email,Mobile_Number,City,City_Other,Net_Salary FROM Req_Loan_Personal WHERE (Req_Loan_Personal.Updated_Date between '".$mindate."' and '".$maxdate."' and Req_Loan_Personal.City in ('Delhi','Noida','Gurgaon','Gaziabad','Faridabad') and Req_Loan_Personal.Employment_Status=0 and Req_Loan_Personal.Net_Salary>=360000 and source not like '%sms%') order by RequestID ASC";
$resultnw=ExecQuery($query);
$recordcount = mysql_num_rows($resultnw);
while($row_result=mysql_fetch_array($resultnw))
	{
	 $qry1="insert into temp (session_id, name, email, city, city_other, mobile_number, net_salary) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["Email"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."')";
		$result1=ExecQuery($qry1);
	}
	//echo "<br><br>";
	$qry="select name AS Name, email AS Emailid, mobile_number AS MobileNo, city AS City, city_other AS OtherCity, net_salary AS AnnualIncome from temp where session_id='".$session_id."' order by doe DESC ";
	
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
	$newfileatt = "/home/deal4loans/public_html/pldwnld/Selfemp".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
			if($recordcount>0)
			{
				sendexcelfileattachment( $session_id);
			}
		 }		 
	
	function sendexcelfileattachment($session_id)
	{
		$newToday = date('d')."".date('m')."".date('y');
		
		$to = "jasbirsingh786@gmail.com, rishi@deal4loans.com,ranjana@deal4loans.com"; 
		//$to = "ranjana@deal4loans.com,ranjana5chauhan@gmail.com"; 
		$from = "Deal4loans <no-reply@deal4loans.com>"; 
		$subject = "Self empLeads @ deal4loans.com ".$newToday; 
		$fileatt = "/home/deal4loans/public_html/pldwnld/Selfemp".$newToday.".xls";
		$fileatttype = "application/xls"; 
		$fileattname = "Selfemp".$newToday.".xls";
           
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
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