<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
function retrivedataforscb()
	{
	$session_id=session_id();
	$scbarr = array('Mumbai','Ahmedabad','Bangalore','Baroda','Chennai','Chandigarh','Hyderabad','Jaipur','Kolkata','Pune','Surat','Amritsar','Aurangabad','Cochin','Jalandhar','Kanpur','Kolhapur','Kottayam','Lucknow','Ludhiana','Nagpur','Nasik','Rajkot','Trivandrum','Delhi');

	$Today = date("Y-m-d"); 
	//$Today ="2011-05-28";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	//$min_date="2010-12-29 00:00:00";
	//$max_date="2011-01-03 23:59:59";
	for($k=0;$k<count($scbarr);$k++)
		 {

			 if($scbarr[$k]=="Ahmedabad")
			 {
				 $city="'Ahmedabad'";
				 $emailid="vishal.bhatt@hdfcbank.com,trushant.joshipura@hdfcbank.com"; 
			}
			 if($scbarr[$k]=="Bangalore")
			 {
				 $city="'Bangalore'";
				$emailid="anand.vincent@hdfcbank.com,chethan.dasappa@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Baroda")
			 {
				 $city="'Baroda'";
				$emailid="trushant.joshipura@hdfcbank.com,viralj.sheth@hdfcbank.com"; 
			}
			 if($scbarr[$k]=="Chennai")
			 {
				 $city="'Chennai'";
				$emailid="arun.mathew@hdfcbank.com,udaykiran.kola@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Chandigarh")
			 {
				 $city="'Chandigarh'";
				$emailid="puneet.bhalla@hdfcbank.com,anil.chaudhary@hdfcbank.com"; 
			}
			 if($scbarr[$k]=="Delhi")
			 {
				 $city="'Delhi','Gurgaon','Noida','Gaziabad','Faridabad'";
				$emailid="ashish.Sehgal@hdfcbank.com,rohan.jain@hdfcbank.com"; 
			}
			 if($scbarr[$k]=="Hyderabad")
			 {
				 $city="'Hyderabad'";
				$emailid="venkat.reddy@hdfcbank.com,vijaya.sarathi@hdfcbank.com"; 
			}
			 if($scbarr[$k]=="Jaipur")
			 {
				 $city="'Jaipur'";
				$emailid="subhrendu.medda@hdfcbank.com,astha.sharma@hdfcbank.com"; 
			}
			 if($scbarr[$k]=="Kolkata")
			 {	
				$city="'Kolkata'";
				$emailid="Amit.Misra1@hdfcbank.com";
			}
			 if($scbarr[$k]=="Mumbai")
			 {	
				 $city="'Mumbai','Thane','Navi Mumbai'";
				$emailid="Rajiv.Upadhyay@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Pune")
			 {	
				 $city="'Pune'";
				$emailid="grenville.rodricks@hdfcbank.com,sachin.gaikwad@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Surat")
			 {	
				 $city="'Surat'";
				$emailid="trushant.joshipura@hdfcbank.com,prakash.patel@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Amritsar")
			 {	
				 $city="'Amritsar'";
				$emailid="nischal.puri@hdfcbank.com,mohita.arora@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Aurangabad")
			 {	
				 $city="'Aurangabad'";
				$emailid="grenville.rodricks@hdfcbank.com,nishant.gaikwad@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Cochin")
			 {	
				 $city="'Cochin'";
				$emailid="jose.varghese@hdfcbank.com,nishanth.nair@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Jalandhar")
			 {	
				 $city="'Jalandhar'";
				$emailid="puneet.bhalla@hdfcbank.com,atin.kumaria@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Kanpur")
			 {	
				 $city="'Kanpur'";
				$emailid="ragvendra.pratapsingh@hdfcbank.com,indraneel.mukherjee@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Kolhapur")
			 {	
				 $city="'Kolhapur'";
				$emailid="grenville.rodricks@hdfcbank.com,yogeshashokrao.jadhav@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Kottayam")
			 {	
				 $city="'Kottayam'";
				$emailid="jose.varghese@hdfcbank.com,rajeshp.pillai@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Lucknow")
			 {	
				 $city="'Lucknow'";
				$emailid="ragvendra.pratapsingh@hdfcbank.com,sameer.kapoor@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Ludhiana")
			 {	
				 $city="'Ludhiana'";
				$emailid="nischal.puri@hdfcbank.com,Gurpreet.Bedi@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Nagpur")
			 {	
				 $city="'Nagpur'";
				$emailid="grenville.rodricks@hdfcbank.com,mubin.shaikh@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Nasik")
			 {	
				 $city="'Nasik'";
				$emailid="grenville.rodricks@hdfcbank.com,Vikram.Satalkar@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Rajkot")
			 {	
				 $city="'Rajkot'";
				$emailid="trushant.joshipura@hdfcbank.com,bhavik.nanavaty@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Trivandrum")
			 {	
				 $city="'Trivandrum'";
				$emailid="jose.varghese@hdfcbank.com,shankar.prabhakaran@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Dhanbad")
			 {	
				 $city="'Dhanbad'";
				$emailid="AyanA.Ghosh@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Gandhidham")
			 {	
				 $city="'Gandhidham'";
				$emailid="Ketan.Thacker@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Guwahati")
			 {	
				 $city="'Guwahati'";
				$emailid="Kalpajit.Nath@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Hissar")
			 {	
				 $city="'Hissar'";
				$emailid="Vijay.Arora@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Jamshedpur")
			 {	
				 $city="'Jamshedpur'";
				$emailid="Avishek.Sinha@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Chattisgarh")
			 {	
				 $city="'Chattisgarh'";
				$emailid="satrajit.basak@hdfcbank.com"; 
			}
			if($scbarr[$k]=="Rohtak")
			 {	
				 $city="'Rohtak'";
				$emailid="Vijay.Arora@hdfcbank.com"; 
			}

	$citifinquery="SELECT Name, DOB, Email, Employment_Status, City, City_Other, Std_Code, Landline, Mobile_Number, Net_Salary,Car_Type, Car_Make, Car_Model, Loan_Amount, Pincode, Allocation_Date,Contact_Time, Updated_Date,Car_Booked
FROM Req_Feedback_Bidder1,Req_Loan_Car WHERE (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Car.RequestID and Req_Feedback_Bidder1.BidderID in (1825,1880,1881,2095,2106) and  Req_Loan_Car.City in (".$city.") and Req_Feedback_Bidder1.Reply_Type=3 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
  list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());


	for($i=0;$i<$recordcount;$i++)
	{
		if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$i]["Car_Type"]==1) { $car_type="New"; }
			if($row_result[$i]["Car_Type"]==0) { $car_type="Old"; } 

			if($row_result[$i]["Car_Make"]==1) { $car_make="Chevrolet"; }  
			if($row_result[$i]["Car_Make"]==2) { $car_make="Fiat"; }  
			if($row_result[$i]["Car_Make"]==3) { $car_make="Ford"; }  
			if($row_result[$i]["Car_Make"]==4) { $car_make="General Motors"; }  
			if($row_result[$i]["Car_Make"]==5) { $car_make="Hindustan Motors"; }  
			if($row_result[$i]["Car_Make"]==6) {$car_make="Honda"; }  
			if($row_result[$i]["Car_Make"]==7) {$car_make="Hyundai"; }  
			if($row_result[$i]["Car_Make"]==8) {$car_make="Lexus"; }  
			if($row_result[$i]["Car_Make"]==9) {$car_make="Mahindra & Mahindra"; }  
			if($row_result[$i]["Car_Make"]==10) {$car_make="Maruti Udyog Ltd"; }  
			if($row_result[$i]["Car_Make"]==11) {$car_make="Mercedes Benz"; }  	if($row_result[$i]["Car_Make"]==12) {$car_make="Nissan India"; }  		if($row_result[$i]["Car_Make"]==14) {$car_make="Porsche"; }  
			if($row_result[$i]["Car_Make"]==15) {$car_make="Skoda Auto"; }  
			if($row_result[$i]["Car_Make"]==16) {$car_make="Tata Motors"; }  
			if($row_result[$i]["Car_Make"]==17) {$car_make="Toyota Kirlosker"; }
			if($row_result[$i]["Car_Make"]==18) {$car_make="Others"; }  
			if($row_result[$i]["Car_Booked"]==1)
			{
				$Car_Booked="Yes";
			}
			else if ($row_result[$i]["Car_Booked"]==2)
			{
				$Car_Booked="No";
			}
			else
			{
				$Car_Booked="";
			}
	

		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'std_code'=>$row_result[$i]['Std_Code'], 'landline'=>$row_result[$i]['Landline'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'std_code_o'=>$row_result[$i]['Std_Code_O'], 'landline_o'=>$row_result[$i]['Landline_O'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'car_make'=>$car_make, 'car_model'=>$row_result[$i]['Car_Model'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'pincode'=>$row_result[$i]['Pincode'], 'contact_time'=>$row_result[$i]['Contact_Time'], 'doe'=>$row_result[$i]['Allocation_Date'], 'is_processed'=>$car_type, 'Documents'=>$Car_Booked);
			$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
		 }
	
	//echo $qry1."<br>";
	
	$qry="select  name, dob, email, emp_status, c_name, city, city_other, std_code, landline, mobile_number, net_salary, car_make, car_model, is_processed AS CarType , Documents as CarBooked, loan_amount, pincode, contact_time, doe from temp where session_id='".$session_id."' order by doe DESC";
		
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());

	 $field_names = getFieldNames($qry);
	
	
	for ($i = 0; $i <count($field_names); $i++){
		$header .= $field_names[$i]."\t";
	}
	
	for($dnld=0;$dnld<count($myrow);$dnld++)
	{
		$myrowarr=$myrow[$dnld];
		
		  $line = '';
		  foreach($myrowarr as $value){
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
$newToday = date('d')."".date('m')."".date('y');
//$newToday="280511";
	// Open the file and erase the contents if any
	$newfileatt = "HDFC_CL/hdfc".$newToday."(".$scbarr[$k].").xls";
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
		//$newToday="280511";
		$newToday = date('d')."".date('m')."".date('y');
	//echo "mailsent".$emailid."<br>";
	$to = "".$emailid.""; 
	
	   $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "CarLoan Leads @ deal4loans.com".$newToday."(".$citifincity.")"; 
    
       $fileatt = "HDFC_CL/hdfc".$newToday."(".$citifincity.").xls";
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