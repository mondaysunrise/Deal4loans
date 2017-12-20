<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
function retrivedataforscb()
	{
	$session_id=session_id();
	$scbarr = array('Complete');

	$Today = date("Y-m-d"); 
	//$Today ="2012-01-30";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	
	for($k=0;$k<count($scbarr);$k++)
		 {
				
				$citifinquery= '';
			 
			  if($scbarr[$k]=="Complete")
			 {
			
				 $bidder_id="3336,3337,3338,3339,3340,3341,3342,3343";
			
				$citifinquery="SELECT Company_Name,Account_No,Name, DOB, Email, Employment_Status, City, City_Other, Std_Code, Landline, Mobile_Number, Net_Salary,Car_Type, Car_Make, Car_Model, Loan_Amount, Pincode, Allocation_Date,Contact_Time, Updated_Date,Car_Varient,Car_Booked FROM Req_Feedback_Bidder1,Req_Loan_Car WHERE (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Car.RequestID and Req_Feedback_Bidder1.BidderID  in (".$bidder_id.") and Req_Feedback_Bidder1.Reply_Type=3 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."') group by Req_Loan_Car.Mobile_Number";
			}
			
	 list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());
	echo "i m here".$citifinquery."<br><br>";
 
$cntr=0;
while($cntr<count($row_result))
        {
		if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$cntr]["Car_Type"]==1) { $car_type="Auto Loan - New Car"; }
			if($row_result[$cntr]["Car_Type"]==0) { $car_type="Auto Loan - Used Car"; } 

			if($row_result[$cntr]["Car_Make"]==1) { $car_make="Chevrolet"; }  
			if($row_result[$cntr]["Car_Make"]==2) { $car_make="Fiat"; }  
			if($row_result[$cntr]["Car_Make"]==3) { $car_make="Ford"; }  
			if($row_result[$cntr]["Car_Make"]==4) { $car_make="General Motors"; }  
			if($row_result[$cntr]["Car_Make"]==5) { $car_make="Hindustan Motors"; }  
			if($row_result[$cntr]["Car_Make"]==6) {$car_make="Honda"; }  
			if($row_result[$cntr]["Car_Make"]==7) {$car_make="Hyundai"; }  
			if($row_result[$cntr]["Car_Make"]==8) {$car_make="Lexus"; }  
			if($row_result[$cntr]["Car_Make"]==9) {$car_make="Mahindra & Mahindra"; }  
			if($row_result[$cntr]["Car_Make"]==10) {$car_make="Maruti Udyog Ltd"; }  
			if($row_result[$cntr]["Car_Make"]==11) {$car_make="Mercedes Benz"; }  	if($row_result[$cntr]["Car_Make"]==12) {$car_make="Nissan India"; }  		if($row_result[$cntr]["Car_Make"]==14) {$car_make="Porsche"; }  
			if($row_result[$cntr]["Car_Make"]==15) {$car_make="Skoda Auto"; }  
			if($row_result[$cntr]["Car_Make"]==16) {$car_make="Tata Motors"; }  
			if($row_result[$cntr]["Car_Make"]==17) {$car_make="Toyota Kirlosker"; }
			if($row_result[$cntr]["Car_Make"]==18) {$car_make="Others"; }  
		
		if($row_result[$cntr]["Car_Booked"]==1)
		{
			$Car_Booked="Yes";
		}
		else if ($row_result[$cntr]["Car_Booked"]==2)
		{
			$Car_Booked="No";
		}
		else
		{
			$Car_Booked="";
		}
			
		$dataInsert = array("session_id"=>$session_id, "name"=>$row_result[$cntr]["Name"], "dob"=>$row_result[$cntr]["DOB"], "email"=>$row_result[$cntr]["Email"], "emp_status"=>$emp_status, "c_name"=>$row_result[$cntr]["Company_Name"], "city"=>$row_result[$cntr]["City"], "city_other"=>$row_result[$cntr]["City_Other"], "std_code"=>$row_result[$cntr]["Std_Code"], "landline"=>$row_result[$cntr]["Landline"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"], "std_code_o"=>$row_result[$cntr]["Std_Code_O"], "landline_o"=>$row_result[$cntr]["Landline_O"], "net_salary"=>$row_result[$cntr]["Net_Salary"], "car_make"=>$car_make, "car_model"=>$row_result[$cntr]["Car_Model"], "loan_amount"=>$row_result[$cntr]["Loan_Amount"], "pincode"=>$row_result[$cntr]["Pincode"], "contact_time"=>$row_result[$cntr]["Contact_Time"], "doe"=>$row_result[$cntr]["Allocation_Date"], "is_processed"=>$car_type, "Documents"=>$Car_Booked);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
		 $cntr=$cntr+1; 
		 
		 }
	
//if($scbarr[$k]=="Complete")
//{
	//$qry=" select pincode AS PromoCode, std_code AS BranchCode, std_code_o AS LGCode,  c_name AS NameofLG,  property_type AS CustomerType, name AS CustomerName, is_valid AS FinwareCustID, no_of_banks AS	ACCOUNTNO,	Card_Limit  AS CustomerBanding, is_processed AS ProductName, loan_amount AS EstimatedLoanAmount, emp_status AS  CustomerCategory, net_salary AS NetSalary, year_of_establishment AS NoofYearsinEmployment,	residence_address AS Residence, landline_o AS OfficeTelNo, landline AS  ResidenceTelNo, mobile_number AS MobileNo, email AS EmailID, add_comment AS	Remarks from temp where session_id='".$session_id."' order by doe DESC";
//}
//else
//{
	$qry="select  name AS Name, dob AS DOB, email AS EmailId, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, mobile_number AS MobileNo, net_salary AS AnnualIncome, car_model AS CarModel, is_processed AS CarType, Documents as CarBooked, loan_amount AS LoanAmount, contact_time AS ContactTime, doe AS DateOfEntry from temp where session_id='".$session_id."' order by doe DESC";
//}
		
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
	
	 list($count,$row)=MainselectfuncNew($qry,$array = array());
	
	//$result = ExecQuery($qry);
	//$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
		 
	}
	$cntr=0;
	//$value = '"' . $header . '"' . "\t";
	while($cntr<count($row))
        {
        
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
	$cntr=$cntr+1;}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	$retnewdata = str_replace("\r", "", $header);
	$retnewdata .="\n"; 
	  $retnewdata .= str_replace("\r", "", $newdata);
 
$newToday = date('d')."".date('m')."".date('y');
//$newToday="300112";
	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/Magma_CL/magma".$newToday."(".$scbarr[$k].").xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$scbarr[$k]);
			 }
		 }
		
	}
	function sendexcelfileattachment($emailid,$session_id,$citifincity)
	{
		//$newToday="300112";
		$newToday = date('d')."".date('m')."".date('y');
	
	
	
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "CarLoan Leads @ deal4loans.com".$newToday."(".$citifincity.")"; 
    
       $fileatt = "/home/deal4loans/public_html/Magma_CL/magma".$newToday."(".$citifincity.").xls";
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
//		$headers .= "Cc: "."\n";
	
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
	Maindeletefunc($qry1,$array = array());
    
    }
main();
function main()
{
	retrivedataforscb();
}
?>