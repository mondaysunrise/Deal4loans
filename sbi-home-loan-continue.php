<?php
	require 'scripts/functions.php';
	session_start();
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>SBI Home Loan | Interest Rates | Documents | Apply</title>
<meta name="keywords" content="SBI Bank, Documents for SBI Home Loan, EMI of SBI home Loan, SBI Loans, Home Loan SBI, SBI Home Loans, SBI Home Loan Documents">
<meta name="description" content="SBI Home Loan – Instant Apply for State bank of India Home Loan at very low interest rates & less document formality. Get home loans from SBI at low EMI options.">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/sbihl-cont.css" rel="stylesheet" type="text/css" />
<link href="source.css" rel="stylesheet" type="text/css" />
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
<style type="text/css">
<!--
.style1 {font-family: 'Droid Sans', sans-serif}
.style2 {font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);font-family: 'Droid Sans', sans-serif;}
-->
</style>
</head>
<body>
<!--top-->
<div class="hli_rates_header"><?php include "top-menu.php"; include "main-menu.php"; ?>
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); $currentdate=date('d F Y',$tomorrow); ?></div>

<div style="clear:both;"></div>
<div class="intrl_txt">	
<div class="hli_rates_logo"><img src="images/logo.gif" width="243" height="90" /></div>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loan-banks.php" style=" color:#4c4c4c;">Compare Home loan Banks</a> <a href="home-loans.php"  class="text12" style="color:#0080d6;"></a> <span class="text12" style="color:#4c4c4c;"><span class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;">&gt;</span> Home Loan</span></div>
<div style="clear:both;"></div>
<div class="second-step_box"><strong>Step 2 - To Get Online quote from All Banks-Please Input further Details</strong></div>

<div style="clear:both; height:5px;"></div>
<div id="txt" style="margin-left:2px;">

<?php

$newsource="SEO 1";
$subjectLine="For SBI Home Loan";
include "home_loan_form_continue1.php";?>
</div>


</div>
<div style="clear:both;"></div>
<div class="discription_box"><span class="tbl_txt"><strong>Disclaimer :</strong> Please note that the interest rates and eligibility criteria given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.</span>
<?php include "responsive_footer.php"; ?>
</div>


<div class="hli_rates_footer"><?php include "footer_hl.php";  ?></div>
</body>
</html>