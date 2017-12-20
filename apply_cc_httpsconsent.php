<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';

	$cc_bankid = $_REQUEST["cc_bankid"];
	$RequestID = $_REQUEST["RequestID"];
	$cc_name = $_REQUEST["cc_name"];

$strcrd_nme="";
if((strlen(trim($crd_nme))>0) && $cc_bankid >1)
{
	$slct="select applied_card_name from Req_Credit_Card Where (RequestID='".$RequestID."')";
	//$row=mysql_fetch_array($slct);
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());

	if(strlen($row['applied_card_name'])>0)
	{
	$strcrd_nme=$row['applied_card_name'].",".$cc_name;
	}
	else
	{
		$strcrd_nme=$cc_name;
	}

//$getcc_option=ExecQuery("Update Req_Credit_Card applied_card_name ='".$strcrd_nme."' Where (RequestID='".$RequestID."')");

$DataArray = array("applied_card_name" =>$strcrd_nme);
$wherecondition ="(RequestID='".$RequestID."')";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);

	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<title>Apply for Credit Card  | Credit Card Application | Credit Cards Comparison Chart</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/mainmenu.js"></script>
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
-->
</style>

 <link href="source.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/dropdowntabs.js"></script>
<style type="text/css">
 .btnclr1 {
    background-color: #1273AB;
    border: medium none;
    color: #FFFFFF;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 14px;
    font-weight: bold;
    height: 40px;
    width: 180px;
}
</style>


</head>
<body>
<?php 
include "middle-menu.php";
?>
<div style="clear:both;"></div>
<div class="secondwrapper-pl">
  <div class="text12" style="margin:auto; width:74%; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span class="text12" style="color:#4c4c4c;">> Apply Credit Card</span></div>
<div class="intrl_txt">
<div style="clear:both; height:15px;"></div>
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying <? echo $cc_name; ?> through Deal4loans.com </h1>
	  
<div style="clear:both; height:85px;"></div></div>
<?php include "footer_sub_menu.php"; ?>

</body>
</html>
