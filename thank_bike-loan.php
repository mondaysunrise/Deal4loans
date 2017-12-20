<?php
ob_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_REQUEST);

$RequestID = $_REQUEST['RequestID'];
$Reference_Code = $_REQUEST["Reference_Code"];
$activation_code = $_REQUEST["activation_code"];

if($Reference_Code == $activation_code)
{
	$Is_Valid=1;
}
else
{
	$Is_Valid=0;
}

$Dated = ExactServerdate();
$dataUpdate = array('Is_Valid'=>$Is_Valid);
$wherecondition = "(RequestID='".$RequestID."')";
Mainupdatefunc ('Req_Loan_Bike', $dataUpdate, $wherecondition);

/****** Code for Client Test :: to show Quote *******/
$shwQuoteSql = "select * from Req_Loan_Bike where RequestID=".$RequestID;
list($shwQuoteRescount,$shwQuoteRes)=MainselectfuncNew($shwQuoteSql,$array = array());
/***********/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta name="viewport" content="width=device-width, initial-scale=1" />  
<title>Thank you Two Wheeler Loan</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="source.css" rel="stylesheet" type="text/css" />
<!--<script type="text/javascript" src="scripts/mootools.js"></script>-->
<style type="text/css">
.red {
	color: #F00;
}

.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
color:#000000;
}
</style>
</head>
<body><?php include "middle-menu.php"; ?>
<div class="text12" style="width:height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;">Home</a></u> > <u>Two Wheeler Loan</u></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto;">
<div align="center" style="font-size:22px; color:#000; padding-top:25px;">Thanks for applying for Two Wheeler Loan through Deal4loans.com</div>
<p>&nbsp;</p>
<div align="center">
<p style="width:100%; text-align:center; height:100px;" align="center">&nbsp;
</p>
<?php //echo $upclSql; ?>
<?php
if(($shwQuoteRes[0]['source']=='two-wheeler-loan-client-test') && (($shwQuoteRes[0]['Loan_Amount']>=10000) and ($shwQuoteRes[0]['Loan_Amount']<=150000)) && (($shwQuoteRes[0]['Net_Salary']>=54000 and $shwQuoteRes[0]['Employment_Status']==1 and $shwQuoteRes[0]['Total_Experience']<=1) or ($shwQuoteRes[0]['Employment_Status']==0 and $shwQuoteRes[0]['Total_Experience']<=2))){
?>
<table width="100%" border="1" cellpadding="0" cellspacing="10">
	<tr>
    	<td>Bank Name</td>
        <td>Interest Rate</td>
        <td>Tenure</td>
        <td>Processing Fee</td>
    </tr>
	<tr>
    	<td>Tata Capital</td>
        <td>Flat rate 10.25% - 12%</td>
        <td>1-5 years</td>
        <td>upto 4%</td>
    </tr>
</table>
<?php } ?>
</div>
<p>&nbsp;</p>
</div>
<div style="clear:both; height:15px;"></div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>