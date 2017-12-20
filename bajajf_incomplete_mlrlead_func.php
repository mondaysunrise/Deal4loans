<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

$today= date('Y-m-d');
$today_date = $today." 00:00:00";

$bajajfinquery="select bajaj_finservid, bajajf_name, bajajf_email, bajajf_mobile, bajajf_city, bajajf_city_other, bajajf_net_salary, bajajf_loan_amount, bajajf_pincode, bajajf_dated, bajajf_company_name, 	bajajf_source,bajajf_employment_status from bajaj_finserv_mailer_leads where (bajajf_sent=1 and sms_flag=0 and bajajf_panno='' and (DATE_SUB( NOW() , INTERVAL '00:25' HOUR_MINUTE ) >= bajajf_dated) and (bajajf_dated>='".$today_date."'))"; 
$bajajfinqueryresult = ExecQuery($bajajfinquery);

while($bjrow=mysql_fetch_array($bajajfinqueryresult))
{
$bajaj_finservid= $bjrow["bajaj_finservid"];
$Mobile_Number = $bjrow["bajajf_mobile"];
$City = $bjrow["bajajf_city"];
$loan_amount = $bjrow["bajajf_loan_amount"];
$name = $bjrow["bajajf_name"];
$Email = $bjrow["bajajf_email"];
$company_name = $bjrow["bajajf_company_name"];
$net_salary = $bjrow["bajajf_net_salary"];

$Message="Customer Details<br>
Mobile contact: $Mobile_Number<br>
City : $City<br>
Loan Amount red : $loan_amount<br>
Customer Name:	$name<br>
customer Emailid: $Email <br>
Current Address : $residence_address<br>
office Address :	$office_address<br>
Company Name: $company_name<br>
Salary: $net_salary<br><br>
Regards<br>
Team Deal4loans";
$getCityDetailsSql = "select * from bajajfinserv_bidders where (bfs_status=1 and bfs_city like '%".$City."%')";
$getCityDetailsQuery = ExecQuery($getCityDetailsSql);
$numgetCity = mysql_fetch_array($getCityDetailsQuery);
$bfs_emailid = $numgetCity["bfs_emailid"];
$bfs_ccemailid = $numgetCity["bfs_ccemailid"];
$bfs_mobileno = $numgetCity["bfs_mobileno"];

/*if($City=="Mumbai" || $City=="Thane" || $City=="Navi Mumbai")
		{
			$bfs_emailid = "Juber.chaudhary@bajajfinserv.in,Isteyakahmad.shaikh@bassindia.com";
			$bfs_mobileno = "8422985786,9833929017,9920408059";
		}*/

if(strlen($bfs_emailid)>2)
						{
$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "Cc:".$bfs_ccemailid.""."\n";
$plemail = $bfs_emailid.",balbirsingh499@gmail.com,balbir.singh@deal4loans.com, parveen.kumar@deal4loans.com";
//mail($plemail,'Exclusive Mailer Customer', $Message, $headers);
						}
						else
						{
$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "Cc:".$bfs_ccemailid.""."\n";
$plemail = "balbirsingh499@gmail.com,balbir.singh@deal4loans.com, parveen.kumar@deal4loans.com";
//mail($plemail,'Exclusive Mailer Customer', $Message, $headers);
						}

if(strlen($bfs_mobileno)>2)
						{
$currentdate=date('d-m-Y');

 $message="Your Leads for pl on (".$currentdate.") : ".$name."-".$Mobile_Number.",cty- ".$City.",sal- ".$net_salary.",LA -".$loan_amount." CN-ExclusiveMailer";

$arrbfs_mobileno = explode(",",$bfs_mobileno);

if(count($arrbfs_mobileno)>1)
		{
	for($bfs=0; $bfs<count($arrbfs_mobileno);$bfs++)
			{
 $strmobile_no = $arrbfs_mobileno[$bfs];
//SendSMSforLMS($message.$SMSMessage, $strmobile_no);
}
		}					}

if($bajaj_finservid>0)
	{
$upqry="Update bajaj_finserv_mailer_leads set sms_flag=1 Where (bajaj_finservid='".$bajaj_finservid."')";
$upqryQuery = ExecQuery($upqry);
	}
}
//bajajf_incomplete_mlrlead_func.php
?>