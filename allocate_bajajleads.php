<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

$selqy="Select * from bajaj_cibildetails Where bajajcibilid in  (2175,2174,2186,2117,2115,2187,2139,2155,2144,2159)";

list($recordcount,$row)=MainselectfuncNew($selqy,$array = array());

$cntr=0;
	if($recordcount>0)
	{
	while($cntr<count($row))
	{
	$loan_amount = $row[$cntr]["bajajf_loan_amt"];
	$name = $row[$cntr]["bajajf_name"];
	$dob = $row[$cntr]["bajajf_dob"];
	$City = $row[$cntr]["bajajf_city"];
	$Mobile_Number = $row[$cntr]["bajajf_mobile"];
	$gender = $row[$cntr]["bajajf_gender"];
	$panno = $row[$cntr]["bajajf_panno"];
	$caddress = $row[$cntr]["bajajf_caddress"];
	$state = $row[$cntr]["bajajf_cstate"];
	$pincode = $row[$cntr]["bajajf_cpincode"];
	$paddress = $row[$cntr]["bajajf_paddress"];
	$pstate = $row[$cntr]["bajajf_pstate"];
	$ppincode = $row[$cntr]["bajajf_ppincode"];
	$company_name = $row[$cntr]["bajajf_company_name"];
	$net_salary = $row[$cntr]["bajajf_salary"];
	$salary = $net_salary;
	
	if($gender==2)
		{
			$gendr="Female";
		}
		else
		{
			$gendr="Male";
		}

$Message="Customer Details<br>
Mobile contact: $Mobile_Number<br>
City : $City<br>
Loan Amount red : $loan_amount<br>
Customer Name:	$name<br>
customer Emailid: $Email <br>
Customer dob : $dob<br>
Customer Gender : $gendr<br>
Customer PanNo: $panno<br>
Current Address : $caddress<br>
Current State: $state<br>
Current Pincode: $pincode<br>
Premanent Address :	$paddress<br>
Premanent Address :	$pstate<br>
Premanent Address :	$ppincode<br>
Company Name: $company_name<br>
Salary: $net_salary<br><br>

Regards<br>
Team Deal4loans";

echo $Message."<br>";
$getCityDetailsSql = "select * from bajajfinserv_bidders where (bfs_status=1 and bfs_city like '%".$City."%')";
list($recordcount,$numgetCity)=Mainselectfunc($getCityDetailsSql,$array = array());
//$getCityDetailsQuery = ExecQuery($getCityDetailsSql);
//$numgetCity = mysql_fetch_array($getCityDetailsQuery);
$bfs_emailid = $numgetCity["bfs_emailid"];
$bfs_ccemailid = $numgetCity["bfs_ccemailid"];
$bfs_mobileno = $numgetCity["bfs_mobileno"];

$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "Cc:".$bfs_ccemailid.""."\n";
$headers .= "Bcc: balbir.singh@deal4loans.com"."\n";
$plemail = $bfs_emailid;

mail($plemail,'24 Hour Gurantee Approval Customer', $Message, $headers);

$currentdate=date('d-m-Y');
$message ="Your Personal loan Leads on (".$currentdate.") : ";
$SMSMessage=$SMSMessage."".$name."-".$Mobile_Number.",cty- ".$City.",pan- ".$panno.",dob -".$dob." CA-".$caddress;
$arrbfs_mobileno = explode(",",$bfs_mobileno);

if(count($arrbfs_mobileno)>1)
		{
	for($bfs=0; $bfs<count($arrbfs_mobileno);$bfs++)
			{
		//echo "<br>";
 $strmobile_no = $arrbfs_mobileno[$bfs];
//echo "<br>";
//$strmobile_no=9811215138;
//echo $message.$SMSMessage;
//echo "<br>";
SendSMSforLMS($message.$SMSMessage, $strmobile_no);
}
		}
	$cntr=$cntr+1; }
			}

	?>