<?php

	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/htmlMimeMail.php';
	
	$name=$_POST['name'];
	$dob=$_POST['dob'];
	$mailid=$_POST['mailid'];
	$mobile=$_POST['mobile'];
	$comp_name=$_POST['comp_name'];
	$product=$_POST['product'];
	$city=$_POST['city'];
	$loan_amount=$_POST['loan_amount'];
	$income=$_POST['income'];
	$salaried=$_POST['salaried'];
	$detail=$_POST['detail'];
	$std=$_POST['std'];
	$landline=$_POST['landline'];


	$name=trim($name);
	$dob=trim($dob);
	$mailid=trim($mailid);
	$mobile=trim($mobile);
	$comp_name=trim($comp_name);
	$product=trim($product);
	$city=trim($city);
	$loan_amount=trim($loan_amount);
	$income=trim($income);
	$salaried=trim($salaried);
	$detail=trim($detail);
	$std=trim($std);
	$landline=trim($landline);

	$source="MT";

   function getReqValue($pKey){
	$titles = array(
		'personal_loan' => 'personal',
		'home_loan' => 'home',
		'car_loan' => 'car',
		'credit_card_loan' => 'cc',
		'loan_against_property' => 'property',
		'Req_Life_Insurance' => 'insurance',
	);

	foreach ($titles as $key=>$value)
		if($pKey==$key)
		return $value;

	return "";
   }
	
	if($detail<>"")
	{
		$detail=1;
	}
	else
	{
		$detail=0;
	}
	
	$doe=date("Y-m-d");

	if($product=="personal_loan")
	{
		list($year,$month,$day)=explode("-",$dob);
		SendPLLeadToICICI($name,"",$day,$month,$year, $mobile, $landline, $mailid, $city, "", $salaried, $income, $comp_name);
	}

	$Msg = "You will soon receive various offers from different banks.";
	
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="Description" content="">
<meta name="keywords" content="Best Personal Loans in India, Best Loan Quotes in India, Compare Loans in India, Compare Home Loans in India, Compare Home in India, Compare Car loans in India, Car Loans, Compare Personal loans in India, Personal , Compare Credit Cards in India, Compare Loans Against Property in India">
<meta http-equiv="refresh" content="900">
<title>Loan Facts - Deal4loans - To IA LMS</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
 <center>
 <table border="0" cellspacing="0" width="712" cellpadding="0">
   <tr>
     <td align="center" valign="top" bgcolor="">
     <meta http-equiv="Content-Language" content="en-us">
     <p>&nbsp;</p>
     <p><a href="index.php"><img src="images/Thank u page.jpg" width="510" border="0"></a></p>     <p>&nbsp;</p></td>
     </tr>
 </table>
 </center>
</div>
</body>
</html>