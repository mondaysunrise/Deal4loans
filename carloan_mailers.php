<?php
session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

//BidderID = 1825
	$session_id=session_id();
	$scbarr = array('Complete');
	print_r($scbarr);
$yesterday = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));

$start_time = date("Y-m-d",$yesterday)." 00:00:00";
$end_time = date("Y-m-d",$yesterday)." 23:59:59";

$sqlCities = "select * from carloan_mailers where (status=1)";
$queryCities = ExecQuery($sqlCities);
$num = mysql_num_rows($queryCities);
$mail_to = '';
$mail_cc = '';
for($ijk=0;$ijk<$num;$ijk++)
{
	$mail_to = '';
	$mail_cc = '';
	$City = '';
	$City = mysql_result($queryCities,$ijk,'City');
		$sql = "select CL_Bank,RequestID, Account_No,Name, DOB, Email, Employment_Status, City, City_Other, Std_Code, Landline, Mobile_Number, Net_Salary,Car_Type, Car_Make, Car_Model, Loan_Amount, Pincode, Allocation_Date,Contact_Time, Updated_Date,Car_Varient,Car_Booked,Delivery_Date from Req_Feedback_Bidder1 left outer join Req_Loan_Car on Req_Loan_Car.RequestID=Req_Feedback_Bidder1.	AllRequestID where (Req_Feedback_Bidder1.BidderID='1825' and (Allocation_Date between '".$start_time."' and '".$end_time."') and Req_Feedback_Bidder1.Reply_Type=3 and (Req_Loan_Car.City='".$City."' or Req_Loan_Car.City_Other='".$City."')) group by  Req_Loan_Car.RequestID";


	$search_result=ExecQuery($sql);
	$numRows = mysql_num_rows($search_result);
	
	if($numRows>0)
	{
	//	echo $sql."<br><br>";
		$mail_to = mysql_result($queryCities,$ijk,'mail_to');
		$mail_cc = mysql_result($queryCities,$ijk,'mail_cc');
		echo "<br>";
		$State = mysql_result($queryCities,$ijk,'State');
		echo $City."--".$State;
		echo "<br>";		
		
		$body = '';
		$body = '<table border"1">';
		while($row_result=mysql_fetch_array($search_result))
		{
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["Car_Type"]==1) { $car_type="Auto Loan - New Car"; }
			if($row_result["Car_Type"]==0) { $car_type="Auto Loan - Used Car"; } 

			if($row_result["Car_Make"]==1) { $car_make="Chevrolet"; }  
			if($row_result["Car_Make"]==2) { $car_make="Fiat"; }  
			if($row_result["Car_Make"]==3) { $car_make="Ford"; }  
			if($row_result["Car_Make"]==4) { $car_make="General Motors"; }  
			if($row_result["Car_Make"]==5) { $car_make="Hindustan Motors"; }  
			if($row_result["Car_Make"]==6) {$car_make="Honda"; }  
			if($row_result["Car_Make"]==7) {$car_make="Hyundai"; }  
			if($row_result["Car_Make"]==8) {$car_make="Lexus"; }  
			if($row_result["Car_Make"]==9) {$car_make="Mahindra & Mahindra"; }  
			if($row_result["Car_Make"]==10) {$car_make="Maruti Udyog Ltd"; }  
			if($row_result["Car_Make"]==11) {$car_make="Mercedes Benz"; }  	if($row_result["Car_Make"]==12) {$car_make="Nissan India"; }  		if($row_result["Car_Make"]==14) {$car_make="Porsche"; }  
			if($row_result["Car_Make"]==15) {$car_make="Skoda Auto"; }  
			if($row_result["Car_Make"]==16) {$car_make="Tata Motors"; }  
			if($row_result["Car_Make"]==17) {$car_make="Toyota Kirlosker"; }
			if($row_result["Car_Make"]==18) {$car_make="Others"; }  
	
	$k = 0;		

if($scbarr[$k]=="Complete")
		{
	$pincode="Deal4Loans";

	if($row_result["City"]=="Others")
			{
$std_code ="Mktg-".$row_result["City_Other"];
			}
			else
			{
	$std_code ="Mktg - ".$row_result["City"];
			}
	$std_code_o = "NR";
	$c_name = "NR";
	$property_type = "NR";
	$is_valid = "NR";
	$no_of_banks ="NR";
	$Card_Limit = "NR";
	$year_of_establishment="NR";
	$residence_address ="NR";
	$landline_o="NR";
	$landline="NR";
	$acc_no= ",AccNo- ".$row_result["Account_No"];
	if($row_result["Car_Booked"]==1)
	{
		$Car_Booked="Yes";
	}
	else if ($row_result["Car_Booked"]==2)
	{
		$Car_Booked="No";
	}
	else
			{
		$Car_Booked="";
			}
	

	$add_comment = "Date-".$row_result["Allocation_Date"].",dob- ".$row_result["DOB"].", CarModel-".$row_result["Car_Model"].", CarVar -".$row_result["Car_Varient"].", pin - ".$row_result["Pincode"].", CarBukd - ".$Car_Booked." ".$acc_no;


	$address_apt="";
	$changeapp_time="";
	$apt_dt="";
	$time="";
	$appdate="";
	$getAppointmentSql = "SELECT address_apt,changeapp_time,appdate FROM hdfc_cl_appointments where RequestID='".$row_result["RequestID"]."'";
	  $getAppointmentQuery = ExecQuery($getAppointmentSql);
	  $getAppointmentNum = mysql_num_rows($getAppointmentQuery);
      if($getAppointmentNum>0)
	  {
	   		$address_apt = mysql_result($getAppointmentQuery,0,'address_apt');	
			$changeapp_time = mysql_result($getAppointmentQuery,0,'changeapp_time');
			$time = '';
			if($changeapp_time=="08:00:00")
			{
				$time =  "8(am)-9(am)";
			}	
			else if($changeapp_time=="09:00:00")
			{
				$time =  "9(am)-10(am)";
			}
			else if($changeapp_time=="10:00:00")
			{
				$time =  "10(am)-11(am)";
			}
			else if($changeapp_time=="11:00:00")
			{
				$time =  "11(am)-12(pm)";
			}
			else if($changeapp_time=="12:00:00")
			{
				$time =  "12(pm)-1(pm)";
			}
			else if($changeapp_time=="13:00:00")
			{
				$time =  "1(pm)-2(pm)";
			}
			else if($changeapp_time=="14:00:00")
			{
				$time =  "2(pm)-3(pm)";
			}
			else if($changeapp_time=="15:00:00")
			{
				$time =  "3(pm)-4(pm)";
			}
			else if($changeapp_time=="16:00:00")
			{
				$time =  "4(pm)-5(pm)";
			}
			else if($changeapp_time=="17:00:00")
			{
				$time =  "5(pm)-6(pm)";
			}
			else if($changeapp_time=="18:00:00")
			{
				$time =  "6(pm)-7(pm)";
			}
			else if($changeapp_time=="19:00:00")
			{
				$time =  "7(pm)-8(pm)";
			}
			
			$appdate = mysql_result($getAppointmentQuery,0,'appdate');	
			$apt_dt = $appdate.", ".$time;
	  }
		
		$pieces = explode(",", $row_result["CL_Bank"]);
		$specialP="";
for($i=0;$i<count($pieces);$i++)
{
	if($pieces[$i]=="HDFC")
	{
		$specialP=$pieces[$i];
	}
	
}

		$qry1="insert into temp (session_id, pincode ,std_code ,std_code_o ,c_name ,property_type ,name ,is_valid ,no_of_banks ,Card_Limit ,is_processed ,loan_amount ,emp_status ,net_salary ,year_of_establishment ,residence_address,landline_o ,landline ,mobile_number ,email ,add_comment, Documents,referred_page, changeapp_time, apt_dt, address_apt, docs)	
		values ('".$session_id."', '".$pincode."', '".$std_code."', '".$std_code_o."', '".$c_name."', '".$property_type."', '".$row_result["Name"]."', '".$request_id."', '".$no_of_banks."', '".$Card_Limit."', '".$car_type."', '".$row_result["Loan_Amount"]."', '".$emp_status."', '".$row_result["Net_Salary"]."', '".$year_of_establishment."', '".$residence_address."', '".$landline_o."', '".$landline."', '".$row_result["Mobile_Number"]."','".$row_result["Email"]."','".$add_comment."','".$Car_Booked."','".$specialP."','".$time."','".$appdate."','".$address_apt."','".$row_result["Delivery_Date"]."')";
		}
		else
		{
		
		if($row_result["Car_Booked"]==1)
		{
			$Car_Booked="Yes";
		}
		else if ($row_result["Car_Booked"]==2)
		{
			$Car_Booked="No";
		}
		else
		{
			$Car_Booked="";
		}


		$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, std_code, landline, mobile_number, std_code_o, landline_o, net_salary, car_make, car_model, loan_amount, pincode, contact_time, doe,is_processed, Documents,referred_page, changeapp_time, apt_dt, address_apt, docs) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Std_Code"]."', '".$row_result["Landline"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."', '".$row_result["Net_Salary"]."', '".$car_make."', '".$row_result["Car_Model"]."', '".$row_result["Loan_Amount"]."', '".$row_result["Pincode"]."', '".$row_result["Contact_Time"]."','".$row_result["Allocation_Date"]."','".$car_type."','".$Car_Booked."','".$specialP."','".$time."','".$appdate."','".$address_apt."','".$row_result["Delivery_Date"]."')";
		}
echo "".$qry1."<br><br>";
				$result1=ExecQuery($qry1);
			
		 }
		 		$body .= '</table>';
				echo $body;
		
		
		if($scbarr[$k]=="Complete")
	 {
		$qry=" select pincode AS PromoCode, std_code AS BranchCode, std_code_o AS LGCode,  c_name AS NameofLG,  property_type AS CustomerType, name AS CustomerName, is_valid AS FinwareCustID, no_of_banks AS	ACCOUNTNO,	Card_Limit  AS CustomerBanding, is_processed AS ProductName, loan_amount AS EstimatedLoanAmount, emp_status AS  CustomerCategory, net_salary AS NetSalary, year_of_establishment AS NoofYearsinEmployment,	residence_address AS Residence, landline_o AS OfficeTelNo, landline AS  ResidenceTelNo, mobile_number AS MobileNo, email AS EmailID, add_comment AS	Remarks,docs AS DeliveryDate,referred_page AS SpecialPreference, apt_dt As ApptDate, changeapp_time As ApptTime,  address_apt AS ApptAddress from temp where session_id='".$session_id."' order by doe DESC";
	 }
	 else
	 {
	$qry="select  name AS Name, dob AS DOB, email AS EmailId, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, std_code AS Std, landline AS Landline, mobile_number AS MobileNo, net_salary AS AnnualIncome, car_make AS CarMake, car_model AS CarModel, is_processed AS CarType, Documents as CarBooked, loan_amount AS LoanAmount, pincode AS Pincode, contact_time AS ContactTime, doe AS DateOfEntry ,docs AS DeliveryDate, referred_page AS SpecialPreference, apt_dt As ApptDate, changeapp_time As ApptTime,  address_apt AS ApptAddress from temp where session_id='".$session_id."' order by doe DESC";
			 }
	echo "<br>".$qry;	
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
//$newToday = date('d')."".date('m')."".date('y')."".date('s');
$newToday = date('d')."".date('m')."".date('y');
//$newToday="280511";
	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/HDFC_CL/hdfc".$newToday."(".$City.").xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
	
		sendexcelfileattachment( $mail_to,$mail_cc, $session_id,$City);
	
		echo "<br>////////////////////////////<br>";
		
				
				
	}


 }
 
 
 function sendexcelfileattachment($emailid, $cc, $session_id,$citifincity)
	{

		$newToday = date('d')."".date('m')."".date('y');
	
	$to = "".$emailid.""; 
	

       $from = "Deal4loans <no-reply@deal4loans.com>"; 
     $subject = "CarLoans Leads @ deal4loans.com".$newToday."(".$citifincity.")"; 
    
       $fileatt = "/home/deal4loans/public_html/HDFC_CL/hdfc".$newToday."(".$citifincity.").xls";
        $fileatttype = "application/xls"; 
        $fileattname = "hdfc".$newToday."(".$citifincity.").xls";
           
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
	$headers .= "Bcc: balbir.singh@deal4loans.com"."\n";

    
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
	
echo	$qry1="delete from `temp` where session_id='".$session_id."'";
	echo "<br>";
	$result1 = ExecQuery($qry1);
    
    }
		
?>