<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	
	function retrivedataforhdbfsEXCLUSIVE()
	{
	$session_id=session_id();
	
	//$min_date=$Today." 00:00:00";
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$Today=date('Y-m-d',$tomorrow);
	$min_date="2014-02-20 00:00:00";
	$max_date=$Today." 23:59:59";
	$ingvquery="SELECT  hdbfs_name AS Name,hdbfs_email AS Email, hdbfs_mobileno AS MobileNO, hdbfs_dob AS DOB, IF(hdbfs_occupation=1, 'Salaried', 'Self Employed') AS Occupation,hdbfs_company_name AS CompanyName, hdbfs_net_salary AS Salary, hdbfs_loan_amount AS LoanAmt, 	hdbfs_city AS City, hdbfs_panno AS PanNo, hdbfs_dated AS DOE  FROM hdbfs_mailer_leads where (hdbfs_eligible_bidder!='' and (hdbfs_dated between '".$min_date."' and '".$max_date."'))";
	$search_result=ExecQuery($ingvquery);
	$recordcount = mysql_num_rows($search_result);
	//echo "i m in else".$ingvquery."<br><br>";
		
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
	$result = ExecQuery($ingvquery);
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
 
$ingvcity = $stringvcity."(Exclusive)";
$newToday = date('d')."".date('m')."".date('y');

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html//pldwnld/hdbfs".$newToday."_exclusive.xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id );
			 }
		
	}
	
	function sendexcelfileattachment($emailid,$session_id)
	{
		$newToday = date('d')."".date('m')."".date('y');
		$to = "hdb.cvcops@hdbfs.com"; 
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Personal Loan Leads @ deal4loans.com".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/pldwnld/hdbfs".$newToday."_exclusive.xls";
        $fileatttype = "application/xls"; 
        $fileattname = "hdbfs".$newToday."_exclusive.xls";
           
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		$headers = "From: $from";
		$semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		 
		//$headers .= "Cc: kishore.kumar@ingvysyabank.com , namrata.medhi@deal4loans.com , balbir.singh@deal4loans.com "."\n";
	// $headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
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
    	echo $to ;          
      if( mail( $to, $subject, $message, $headers ) ) {
         
            echo "<p>The email was sent.</p>"; 
          }
        else { 
        
            echo "<p>There was an error sending the mail.</p>"; 
          }

	//$qry1="delete from `temp` where session_id='".$session_id."'";
	//$result1 = ExecQuery($qry1);
    }
retrivedataforhdbfsEXCLUSIVE();
?>