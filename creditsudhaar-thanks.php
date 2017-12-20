<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$Name = $_REQUEST['Name'];
$Mobile = $_REQUEST['Mobile'];
$Email = $_REQUEST['Email'];
$City = $_REQUEST['City'];
$Message = $_REQUEST['Message'];
$IP = getenv("REMOTE_ADDR");

$sql = "INSERT INTO Req_Credit_Sudhaar (Name ,Mobile ,Email ,City ,Message ,Source ,IP ,Dated) VALUES ('".$Name."', '".$Mobile."', '".$Email."', '".$City."',  '".$Message."',  '".$Source."',  '".$IP."',  Now())";
ExecQuery($sql);
?>
<html>
<head>
<title>Landing Page</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<div align="center" style="padding:20px;">
<table id="Table_01" width="738" border="0" cellpadding="0" cellspacing="0" style="border: solid 1px #CCC">
	<tr>
		<td width="738" ><table cellpadding="0" cellspacing="0" border="0" width="100%"> 
        <tr>
        <td valign="top" width="336" align="center"><img src="http://www.deal4loans.com/emailer/creditsudhaar/credit_health_ppt.jpg" width="285" height="374" border="0"></td>
        
        <td width="404" valign="top">

        <table cellpadding="3" cellspacing="0" border="0" width="100%">
        <tr><td colspan="2" align="center"  height="269" style=" color:#FF3300; font-family:Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold;"> Thank You. We will get back to you shortly.</td></tr>
                             <tr><td colspan="2" align="center" style="border-top:#333333 1px solid;"><img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_14.jpg" width="337" height="105" alt="CreditSudhaar's 4 Step Plan to Credit Health Improvement"></td></tr>
        </table>
     
        </td>
        
        </tr>
</table>
        </td>
	</tr>
	
	<tr>
		<td>
        	<table cellpadding="0" cellspacing="0" width="100%">
            	<tr>
                	<td>
			<img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_05.jpg" width="185" height="139" alt="STEP I - Accurate Interpretation of Credit Reports"></td>
		<td colspan="2">
			<img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_06.jpg" width="184" height="139" alt="STEP II - Identifying issues with the report"></td>
		<td colspan="2">
			<img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_07.jpg" width="185" height="139" alt="STEP III - Comprehensive Analysis"></td>
		<td colspan="2">
			<img style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; display: block;" src="http://www.deal4loans.com/emailer/creditsudhaar/emailer_08.jpg" width="184" height="139" alt="STEP IV - Detailed plan for Credit Health improvement"></td>
                </tr>
            </table>
        </td>
	</tr>
	<tr>
		<td style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; padding:4px; ">
<strong style="font-size:12px;">Disclaimer:</strong> This is an advertisement on behalf of credit Sudhaar. <strong style="font-size:11px;">Deal4loans.com</strong> is not responsible for any service related issue. 
</td>
	</tr>
</table>
</div>
</center>
</body>
</html>