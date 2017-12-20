<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';

$Dated = ExactServerdate();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$requestid = FixString($_POST["requestid"]);
	$loan_amount = FixString($_POST["loan_amount"]);
	$name = FixString($_POST["name"]);
	$source = FixString($_POST["source"]);
	$dob = FixString($_POST["dob"]);
	$City = FixString($_POST["City"]);
	$Email = FixString($_POST["Email"]);
	$Mobile_Number = FixString($_POST["Mobile_Number"]);
	$gender = FixString($_POST["gender"]);
	$panno = FixString($_POST["panno"]);
	$caddress = FixString($_POST["caddress"]);
	$pincode = FixString($_POST["pincode"]);
	$paddress = FixString($_POST["paddress"]);
	$ppincode = FixString($_POST["ppincode"]);
	$company_name = FixString($_POST["company_name"]);
	$salary = FixString($_POST["salary"]);
	$pl_bank_name = FixString($_POST["pl_bank_name"]);
	$net_salary = $salary*12;
	$salary = $net_salary;
	$city = $City;
	$Net_Salary = $net_salary;
}

if (strlen($pl_bank_name)>1 && $requestid>1)
{
	$dataInsert = array('RequestID'=>$requestid,'Name'=>$name,'City'=>$City,'Mobile_Number'=>$Mobile_Number,'DOB'=>$dob,'Gender'=>$gender,'Pancard'=>$panno,'Loan_Amount'=>$loan_amount,'Company_Name'=>$company_name,'Residence_Address'=>$caddress,'Office_Address'=>$paddress,'Gross_Monthly_Salary'=>$net_salary,'Net_Monthly_Salary'=>$salary,'Bank_Name'=>$pl_bank_name,'dated'=>$Dated);
	$ProductValue = Maininsertfunc('Req_Loan_Personal_Bankwise', $dataInsert);
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Personal Loan  | Personal Loan Application | Personal Loans Comparison Chart</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
 <script type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; width:height:11px; margin-top:70px; color:#0a8bd9;"></div>
<div style="clear:both; height:1px;"></div>
<div style="clear:both; width:margin:auto;  margin-top:25px;">
<div id="container">
  <div id="txt"  style="padding-top:15px; height:60px;">
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Personal Loan from <? echo $pl_bank_name; ?> through Deal4loans.com </h1>
 </div>
</div>
<div style="clear:both; height:80px; width:964px; margin:auto; margin-top:10px;"></div>
</div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>