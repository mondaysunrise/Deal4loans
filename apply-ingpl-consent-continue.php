<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$panno = $_POST["panno"];
	$full_name = $_POST["full_name"];
	$year = $_POST['year'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	$DOB=$year."-".$month."-".$day;
	$residence_address = $_POST["residence_address"];
	$office_address = $_POST["office_address"];
	$Mobile_Number = $_POST["Mobile_Number"];
	$Company_Name = $_POST["Company_Name"];
	$Net_Salary = $_POST["Net_Salary"];
	$Email = $_POST["Email"];
	$Loan_Amount = $_POST["Loan_Amount"];
	$RequestID = $_POST["RequestID"];
	$City = $_POST["City"];
	
	$ingupqry="Update Req_Loan_Personal set Name='".$full_name."',DOB='".$DOB."' ,income_proof='".$panno."',Residence_Address='".$residence_address."',residence_proof='".$office_address."' 			Where RequestID=".$RequestID;
	$ingupqryresult=ExecQuery($ingupqry);
	
	
	$Message="Customer Details<br>
	Mobile contact: $Mobile_Number<br>
	Email : $Email<br>
	City : $City<br>
	Loan Amount red : $Loan_Amount<br>
	Customer Name:	$full_name<br>
	Customer dob : $DOB<br>
	Customer PanNo: $panno<br>
	Current Address : $residence_address<br>
	Office Address: $office_address<br>
	Company Name: $Company_Name<br>
	Salary: $Net_Salary<br><br>
	Regards<br>
	Team Deal4loans";
	
	if(strlen($panno)>0 && $RequestID>0)
	{
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$plemail = "balbirsingh499@gmail.com,balbir.singh@deal4loans.com";
		//$plemail = "ranjana5chauhan@gmail.com";
		mail($plemail,'ING Vysya Customer', $Message, $headers);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Personal Loan  | Personal Loan Application | Personal Loans Comparison Chart</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">
<!-- 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
.apply_pl_input{
  border: 2px solid #999999;
    height: 26px;
    width: 298px;
	}
.dd_pl
{
	border: 2px solid #999999;
    height: 26px;
    width: 58px;
	}
.yy_pl
{
	border: 2px solid #999999;
    height: 26px;
    width: 58px;
	}
.boldtxt
{
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    font-weight: bold;
    padding-left: 5px;
}
-->
</style>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.html" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:1px;"></div>
<div style="clear:both; width:960px; margin:auto;  margin-top:2px;">
<div id="container">
  <div id="txt"  style="padding-top:15px; height:60px;">
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Personal Loan from ING Vysya Bank through Deal4loans.com </h1>  
</div>
</div>
<div style="clear:both; height:80px; width:964px; margin:auto; margin-top:10px;"></div>
</div>
<?php include "footer1.php"; ?>
</body>
</html>