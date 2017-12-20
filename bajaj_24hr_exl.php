<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	
function retrivedatafor_bajaj()
	{
	$session_id=session_id();
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$Today=date('Y-m-d',$tomorrow);
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	$qry="select bajajf_name AS Name, bajajf_mobile AS Mobile, bajajf_city AS City, bajajf_dob AS DOB, bajajf_gender AS Gender, bajajf_loan_amt AS LoanAmt, bajajf_panno AS PanNO, bajajf_caddress AS Address, bajajf_cstate AS State, bajajf_cpincode AS Pincode, bajajf_company_name AS CompanyName, bajajf_paddress AS PermanentAddress, bajajf_pstate AS PermanentState, bajajf_ppincode AS PermanentPincode, bajajf_salary AS Salary, bajajf_source AS source, bajaj_dated AS Dated from bajaj_cibildetails where (bajaj_dated between '".$min_date."' and '".$max_date."')";

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
	$newfileatt = "/home/deal4loans/public_html/pldwnld/bajaj24h".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
	sendexcelfileattachment( $session_id);
	}

	function sendexcelfileattachment($session_id)
	{
		$newToday = date('d')."".date('m')."".date('y');

		$to ="sunil.shinde@bassindia.com,ajay.chaudhary@bajajfinserv.in";

        $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Bajaj 24hr Leads @ deal4loans.com".$newToday; 
          
		$fileatt = "/home/deal4loans/public_html/pldwnld/bajaj24h".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "bajaj24h".$newToday.".xls";
        
		$file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		$semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: prijith.padmanabhan@bassindia.com, sachin.whig@bajajfinserv.in, pavans.mishra@deal4loans.com, balbir.singh@deal4loans.com"."\n";
		// $headers .= "Bcc: ranjana.chauhan@deal4loans.com"."\n";
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
    }

main();
function main()
{
	retrivedatafor_bajaj();
}
?>