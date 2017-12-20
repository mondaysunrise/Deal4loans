<?php
	session_start();
	require 'scripts/db_init.php';
//	require 'scripts/functions_nw.php';
if (!empty($_SERVER['REMOTE_ADDR']))
{
        exit; 
}
else
{
	main();
}
	
function retrivedatafortata()
{
	$emailid="NonCBS.Developers@bankofbaroda.com";
	$session_id=session_id();
	$Today=Date('Y-m-d');
	//$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	//$Today=date('Y-m-d',$tomorrow);
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	
		$citifinquery="SELECT HL_RequestID, Name, DOB, Email, Mobile_Number, City, City_Other, Gender, Pancard, Residence_Address, Residence_State, Pincode, Net_Salary, Loan_Amount,	last_updated FROM Req_Loan_Home_Extrafields WHERE ((Req_Loan_Home_Extrafields.Disposition='Send for CIBIL') and Req_Loan_Home_Extrafields.last_updated Between '".($min_date)."' and '".($max_date)."')";
	
		$search_result=ExecQuery($citifinquery);
		$recordcount = mysql_num_rows($search_result);
		//echo "i m in else".$citifinquery."<br><br>";
	$strCity="";
	while($row_result=mysql_fetch_array($search_result))
	{	
		//$strBidderID=$row_result["BidderID"];
	$monthly_income = round($row_result["Net_Salary"]/12);
	$refid="D4L".$row_result["HL_RequestID"]."S6492";
	list($year,$mm,$dd)=explode("-",$row_result["DOB"]);
	list($first,$last)=explode(" ",$row_result["Name"]);
	$dob =$dd."/".$mm."/".$year;
	if($row_result["Gender"]==2) { $gender="Female";} else {$gender="Male";}
	if($row_result["City"]=="Others" && strlen($row_result["City_Other"])>0) { $city=$row_result["City_Other"];} else {$city=$row_result["City"];}
	
	$qry1="insert into temp (session_id, doe, request_id, name, c_name, mobile_number, email, gender, pancard, dob, net_salary, loan_amount, residence_address, city, residential_status,  pincode, Feedback, source ) values ('".$session_id."', '".$row_result["last_updated"]."', '".$refid."', '".$first."', '".$last."','".$row_result["Mobile_Number"]."', '".$row_result["Email"]."', '".$gender."', '".$row_result["Pancard"]."', '".$dob."', '".$monthly_income."', '".$row_result["Loan_Amount"]."', '".$row_result["Residence_Address"]."', '".$city."', '".$row_result["Residence_State"]."',  '".$row_result["Pincode"]."', '".$row_result["Disposition"]."','')";
		$result1=ExecQuery($qry1);
	}
	
		
	//TranDt	Ref ID	First Name	Middle Name	Last Name	Mobile No.	Email Id	Gender	Pan Card Number	Date Of Birth as per pan card	Monthly Income	Loan Amount	Residential Address	Residential City	Residential State	Pincode	Feedback	Status

		//dd/mm/yyyy
	
	$qry="select doe AS TranDt, request_id AS 'Ref ID', name AS 'First Name', source AS 'Middle Name', c_name AS 'Last Name', mobile_number AS 'Mobile No', email AS 'Email Id', gender AS Gender, pancard AS 'Pan Card Number', dob AS 'Date Of Birth', net_salary AS 'Monthly Income', loan_amount AS 'Loan Amount', residence_address AS 'Residential Address', city AS 'Residential City', residential_status AS 'Residential State',  pincode AS 'Pincode', Feedback AS 'Feedback', source AS Status  from temp where session_id='".$session_id."' order by doe DESC ";
		
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
	$newfileatt = "/home/deal4loans/public_html/hldwnld/bob6492".$newToday.".csv";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
			if($recordcount>0)
			{
				sendexcelfileattachment( $emailid,$session_id, $emailid);
			}
	 
	}

	function sendexcelfileattachment($emailid,$session_id,$emailid)
	{
		$newToday = date('d')."".date('m')."".date('y');
		//$to="ranjana5chauhan@gmail.com,Harshita.jain@deal4loans.com, ekta.ahuja@deal4loans.com";
		$to = $emailid; 
		$from = "Deal4loans <no-reply@deal4loans.com>"; 
		$subject = "Bob Home Loan Leads @ deal4loans.com ".$newToday; 
		$fileatt = "/home/deal4loans/public_html/hldwnld/bob6492".$newToday.".csv";
		$fileatttype = "application/csv"; 
		$fileattname = "bob6492".$newToday.".csv";
           
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
$headers .= "Cc: Harshita.jain@deal4loans.com, ekta.ahuja@deal4loans.com, Bhupendra.Sablok@bankofbaroda.com"."\n";		   
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

		//$to="ranjana5chauhan@gmail.com";
	    if( mail( $to, $subject, $message, $headers ) ) {         
            echo "<p>The email was sent.</p>";          
        }
        else {
            echo "<p>There was an error sending the mail.</p>";         
        }
		$qry1="delete from `temp` where session_id='".$session_id."'";
		$result1 = ExecQuery($qry1);
    }


//main();

function main()
{
	retrivedatafortata();
}
?>