<?php
session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

	function getReqemailValue($pKey){
    $titles = array(
		'Delhi' => 'ruchia@hdfcsupport.co.in',
		'Chennai' => 'assumpthag@hdfc.com',
		'Hyderabad' => 'jovithas@hdfc.com',
		'Lucknow' => 'arpitar@hdfc.co.in',
		'Chandigarh' => 'vania@hdfc.com'		
		 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function retrivedataforhdfc()
{
	$session_id=session_id();
	$Today=Date('Y-m-d');
	$time = date("H");
	$DateTime=date("Y-m-d H:i:s");
	if($time<=14)
	{
		$min_date=$Today." 00:00:00";
		$max_date=$DateTime;
	}
	else
	{
		$min_date=$Today." 14:00:00";
		$max_date=$Today." 23:59:59";
	}
		
	$hdfchl = array('Delhi','Chennai','Hyderabad','Lucknow','Chandigarh');

	for($k=0;$k<count($hdfchl);$k++)
	{
	 	 $citifinquery="SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment, Employment_Status FROM Req_Loan_Home,webservice_bidder_details WHERE (Req_Loan_Home.RequestID=webservice_bidder_details.leadid and webservice_bidder_details.bidderid=1329 and webservice_bidder_details.cust_city ='".$hdfchl[$k]."' and (webservice_bidder_details.doe Between '".$min_date."' and '".$max_date."'))";
		$search_result=ExecQuery($citifinquery);
		$recordcount = mysql_num_rows($search_result);
		if($recordcount>0)
		{
		$row_result=mysql_fetch_array($search_result);
		$Name= $row_result["Name"];
		$DOB= $row_result["DOB"];
		$Email= $row_result["Email"];
		$Mobile_Number= $row_result["Mobile_Number"];
		$Company_Name= $row_result["Company_Name"];
		$City= $row_result["City"];
		$Net_Salary= $row_result["Net_Salary"];
		$Loan_Amount= $row_result["Loan_Amount"];
		//customer details
		if($Mobile_Number>0 && strlen($Name)>1)
			{
		$Message2="Customer Details<br>
		Mobile contact: $Mobile_Number<br>
		City : $City<br>
		Loan Amount : $Loan_Amount<br>
		Customer Name:	$Name<br>
		customer Emailid: $Email <br>
		Customer dob : $DOB<br>
		Company Name: $company_name<br>
		Salary: $Net_Salary<br><br>
		Regards<br>
		Team Deal4loans";
		$emailid=getReqemailValue($hdfchl[$k]);
		$cityname=$hdfchl[$k];
		$newToday = date('d')."".date('m')."".date('y');
		$from = "Deal4loans <no-reply@deal4loans.com>"; 

		$subject = "Home Loan Leads @ deal4loans.com ".$cityname."".$newToday; 
		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		$semi_rand = md5( time() ); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		$headers .= "\nMIME-Version: 1.0\n" . 
		"Content-Type: multipart/mixed;\n" . 
		" boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: shweta.sharma@deal4loans.com,deeptir@hdfcsupport.co.in"."\n";		   
		
		$message = "This is a multi-part message in MIME format.\n\n" . 
		"--{$mime_boundary}\n" . 
		"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
		"Content-Transfer-Encoding: 7bit\n\n" . 
		$Message2 . "\n\n";
		$to = $emailid;
		if( mail( $to, $subject, $message, $headers ) ) {         
		echo "<p>The email was sent.</p>";  
								}
				}
			}
	
		 }		 
	}	

main();
function main()
{
	retrivedataforhdfc();
}
?>