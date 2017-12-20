<?php
//ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
session_start();
	
		
$Today = date("Y-m-d"); 
$min_date=$Today." 00:00:00";
$max_date=$Today." 23:59:59";
	//$min_date = "2010-05-03 00:00:00";
//$max_date = "2010-05-06 23:59:59";
	
echo  $sql  = "select a_city from fullerton_leads where 1=1 and (dated between '".$min_date."' and '".$max_date."') group by a_city";
$query = ExecQuery($sql);
$numRows = mysql_num_rows($query);
$titles = "";
for($i=0;$i<$numRows; $i++)
{
	$a_city = mysql_result($query,$i,'a_city');
	$titles[] = $a_city;
}


	
$session_id="";

for($j=1;$j<=count($titles);$j++)
{
	$session_id="";
	$session_id=session_id();
	session_regenerate_id();
	$session_id=session_id();
	
	//echo "////////////////////////////////////////////////////////////<br>";
	//echo $session_id ; 
	//echo "<br>";
	$search_qry="";
	//$recordcount ="";
	$search_qry="SELECT * FROM fullerton_leads where a_city='".$titles[$j]."' and (dated between '".$min_date."' and '".$max_date."')";	

//	echo "<br>".$search_qry."<br>";

$search_result = ExecQuery($search_qry);
	$recordcount = mysql_num_rows($search_result);	
//	echo "<br>".$recordcount."<br>";
	$newfileatt = "";
	$row_result = "";
	while($row_result=mysql_fetch_array($search_result))
	{
		
		$a_feedback = $row_result["a_feedback"];
		$a_fullowup_date = $row_result["a_fullowup_date"];
		$a_month = $row_result["a_month"];
		$a_telecaller = $row_result["a_telecaller"];
		$a_date = $row_result["a_date"];
		$a_time = $row_result["a_time"];
		$a_city = $row_result["a_city"];
		if($a_city =="Asaf Ali" || $a_city =="Nehru P")
		{
			$City = "Delhi";
		}
		else if($a_city =="Tushal" || $a_city =="Samadan Kale")
		{
			$City = "Pune";
		}
		else
		{
			$City = $a_city;
		}
		
		$a_pincode = $row_result["a_pincode"];
		$a_loan_amt = $row_result["a_loan_amt"];
		$a_final_loan_amt = $row_result["a_final_loan_amt"];
		$a_leaddate  = $row_result["a_leaddate"];
		$a_netsalary = $row_result["a_netsalary"];
		$a_remark = $row_result["a_remark"];
		$LeadID = $row_result["LeadID"];
		$a_address = $row_result["a_address"];
		$roi = $row_result["roi"];
		
		
		$getUserSql = "select * from Req_Loan_Personal where RequestID='".$LeadID."'";
		$getUserQuery = ExecQuery($getUserSql);
		$Name = mysql_result($getUserQuery,0,'Name');
		$Employment_Status = mysql_result($getUserQuery,0,'Employment_Status');
		if($Employment_Status==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		$Company_Name = mysql_result($getUserQuery,0,'Company_Name');
		$City = mysql_result($getUserQuery,0,'City');
		$City_Other  = mysql_result($getUserQuery,0,'City_Other');
		$Mobile_Number = mysql_result($getUserQuery,0,'Mobile_Number');
		$dob = mysql_result($getUserQuery,0,'DOB');
		//Net Salary, Loan Amt, 
			
		$expDt = explode(" ",$a_date);
		$expday = explode("-", $expDt[0]);
		$expTime = explode("-", $expDt[1]);
		$mkTime = mktime($expTime[0],$expTime[1],$expTime[2],$expday[1], $expday[2],$expday[0]);
		
		$a_date_Needed = date("d-M",$mkTime);

		$expdob = explode("-", $dob);
		$mkTimedob = mktime(0,0,0,$expdob[1], $expdob[2],$expdob[0]);
		$dateDOB = date("d-M-y",$mkTimedob);

			
			
			$qry1 = "";
			$qry1="insert into temp (session_id, name, dob, emp_status, c_name, city, city_other, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, ip_address, is_processed, contact_time ) values ('".$session_id."', '".$Name."', '".$dateDOB."',  '".$emp_status."', '".$Company_Name."', '".$City."', '".$City_Other."', '".$Mobile_Number."', '".$a_final_loan_amt."', '".$a_time."', '".$a_pincode."', '".$a_feedback."', '".$a_remark."', '".$a_netsalary."', '".$a_loan_amt."', '".$a_date_Needed."', '".$a_month."', '".$a_telecaller."', '', '".$a_address."', '".$roi."')";
			
			$result1=ExecQuery($qry1);
	
	//	echo "<br>".$qry1."<br>";
	}
	$qry = '';
	//$qry="select loan_any as Month, emi_paid as Telecaller, ip_address as LeadData, vehicle_owned as ApptDate, name as Name, mobile_number as MobileNumber, dob as DOB, emp_status as EmpStatus, c_name as CompanyName, marital_status as NetSalary, residential_status as LoanAmount, std_code as FinalLoanAmount, landline as ApptTime, is_processed as Address, city as City,  std_code_o as Pincode, landline_o as Feedback, net_salary as Remark, ip_address as LoginDate   from temp where session_id='".$session_id."' order by doe DESC ";
	
	$qry="select vehicle_owned as ApptDate, name as Name, mobile_number as MobileNumber, dob as DOB, emp_status as EmpStatus, c_name as CompanyName, marital_status as NetSalary, residential_status as LoanAmount, std_code as FinalLoanAmount, contact_time as ROI, landline as ApptTime, is_processed as Address, city as City,  std_code_o as Pincode, landline_o as Feedback, net_salary as Remark, ip_address as LoginDate   from temp where session_id='".$session_id."' order by doe DESC ";
	
	//echo "<br>".$qry."<br>";
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
 

	$newToday = date('d')."".date('m')."".date('y')."".date('s');
	// Open the file and erase the contents if any
	$newfileatt = "fullertoncall/ful".$newToday."(".$titles[$j].").xls";
//	echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
	if($recordcount>0)
	{
		$emailid = "";
		$emailid_cc = "";
		$emailSql = "select * from rm_detail_fullerton where  rm_city= '".$a_city."'";
		$emailQuery = ExecQuery($emailSql);
		//echo $emailid = mysql_result($emailQuery,0,'rm_email');
		//echo "<br>";
		//echo $emailid_cc = mysql_result($emailQuery,0,'rm_email_cc');		
		 
	
		
		sendexcelfileattachment( $emailid,$session_id,$titles[$j],$emailid_cc);
		$lastCount = $j;
	}
	$recordcount=0;
	//$qry1="delete from `temp` where session_id='".$session_id."'";
	//$result1 = ExecQuery($qry1);
	
	
		
		
	
}




function sendexcelfileattachment($emailid,$session_id,$fullecity, $emailid_cc)
	{
		$newToday = date('d')."".date('m')."".date('y')."".date('s');
	//echo $emailid."<br>";
	$to = $emailid; 
	$Bcc = "shuaib@deal4loans.com";
	$cc = $emailid_cc;
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
       $subject = "Personal Loan Leads @ deal4loans.com".$newToday."(".$fullecity.")"; 
 //   $subject = "test ".$newToday."(".$fullecity.")"; 
       
	   $fileatt = "fullertoncall/ful".$newToday."(".$fullecity.").xls";
        $fileatttype = "application/xls"; 
        $fileattname = "f".$newToday."(".$fullecity.").xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
if(strlen($cc)>0)
{
	$headers .= "Cc:".$cc.""."\n";
}
		$headers .= "Bcc: ".$Bcc.""."\n";
    
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
             echo "<p>The email was sent.".$fullecity."</p>";  
        }
        else { 
              echo "<p>There was an error sending the mail.".$fullecity."</p>"; 
         
        }
	
          $qry1="delete from `temp` where session_id='".$session_id."'";
	//	echo "<br>".$qry1;
		
	$result1 = ExecQuery($qry1);
    
    }
	

?>