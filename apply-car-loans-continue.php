<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$requestid= $_REQUEST["requestid"];
	$salary_acc = $_REQUEST["salary_acc"];

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$requestid =  $_POST["requestid"];
		$salary_acc = $_POST["salary_acc"];
		$Account_No = $_POST["Account_No"];

if(strlen($Account_No)>0)
		{
		//$cc_details="update Req_Loan_Car set Primary_Acc='".$salary_acc."', Account_No='".$Account_No."' Where RequestID=".$requestid;
		$DataArray = array("Primary_Acc"=>$salary_acc, "Account_No"=>$Account_No);
		$wherecondition ="RequestID=".$requestid;
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);	
		//$ccresult=ExecQuery($cc_details);
		}

		//echo $cc_details."<br>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Car Loans | Apply Car Loans online | Compare Car Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="car-loans.php">Car Loan</a> > Apply Car Loan</span>
 
  <div id="lftbar" style="padding-top:10px; width:100%; ">

 <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><center><strong><?php if($Account_No=="" && ($_SERVER['REQUEST_METHOD'] == 'POST')) echo "Kindly give Valid Details"; ?></strong></center></font>
 <? if(strlen($Account_No)>0)
 { ?>
	 <div align="center" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:22px;"><b> Thanks for Providing your details.</b></div>
 <? }
 else
 { ?>
 <div align="center" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:22px;"><b> Thanks for Providing your details.</b></div>
<? } ?>
 </div>
 <?php include '~Bottom-new.php';?>
</div>
</body>
</html>