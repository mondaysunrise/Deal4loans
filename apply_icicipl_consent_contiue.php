<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$count = $_POST["count"];
    $ApplicationId = $_POST["ApplicationId"];
    $LoanAmount = $_POST["LoanAmount_".$count];
	$Tenure = $_POST["Tenure_".$count];
	$InterestRate = $_POST["InterestRate_".$count];
	$ProcessingFee = $_POST["ProcessingFee_".$count];
	$EMI = $_POST["EMI_".$count];
	$CompanyPF = $_POST["CompanyPF_".$count];
	$SplROI = $_POST["SplROI_".$count];
	$SplPF = $_POST["SplPF_".$count];
	$SplPFPer = $_POST["SplPFPer_".$count];
	$Dated=ExactServerdate();
  
  if($ApplicationId>0 && $LoanAmount>0)
	{
	$jsonurl='{"UserID":"CzqACXzroMJsd80Coai21nEnbhIyixSHaGKP1uPCBbuFlMqoBqBpFwxuaDHGvdso5IZDwCzyvrEODKkxLq4VzrRsE5tSKoiq1gfJ8suoBqNbvPtOYbj6HfQUaO+rw5AUl2mHRuCEm4fLsAp+AUUK0r3Sxa9atI2oP7T+LIjoees=","Password":"dewOHb3MXfzdK/L8raCt7D1qJ9k2OtTsMM/uWdCmdV8M252sJb4dYOsyv2cIJX6FtyJgr8HjM4DT+3ixKf1+1wYU+/l8iip1PuzBq0uFXwcY86jzCF3c+qHH/jBaI+GD+OBmUiO+Thhm/QUDAGANY7v499NTfsVoyOOYt1kNVto=","ApplicationId": "'.$ApplicationId.'",  "LoanAmountOffered": "'.$LoanAmount.'",  "TenureRequested": "'.$Tenure.'",  "ActionMethod":"CalculateEligiblity"}';

	$url ="https://www.dc.transuniondecisioncentre.co.in/DC/TU.DC.GenericAPI/API/ICICIPLLMS/ProcessFromQueue";
	// cURL's initialization
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonurl);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
	$result = curl_exec($ch);
	$obj = json_decode($result);
	$Comments=$obj->Comments;

	$DataArray = array("request_json2" =>$jsonurl, "response_json2" =>$result, "dated2"=>$Dated, "Comments"=>$Comments);
	$wherecondition ="(ApplicationId='".$ApplicationId."')";
	Mainupdatefunc ('icicipl_webservice', $DataArray, $wherecondition);

	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
.heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:15px; }
.sbi_text_c{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
#sidebar {
	width: 340px;
	float: right;
	margin: 30px 0 30px;
}
#content {
	background: #fff;
	margin: 30px 0 30px 20px;
	padding: 10px;
	width: 570px;
	float: left;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}

.widget {
	background: #fff;
	margin: 0 0 30px;
	padding: 10px 20px;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.bajaj-fin_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.bajaj-fin_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
.sbi_text_bullet li{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
.sbi_text_bullet li a{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.heading_text1 {font: bold 20px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:20px; }
</style>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div style="width:995px;  margin:auto;">
<div id="content"><!-- put content here-->
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Personal Loan from <? echo $pl_bank_name; ?> through Deal4loans.com </h1>
   </div>    
   <div style="width: 340px;	float: right;">
    
    </div>
</div>

<div style="clear:both;"></div>
<!--partners-->
<?php 
$REMOVE_ADD=1;
include("footer_sub_menu.php"); ?>
</body>
</html>