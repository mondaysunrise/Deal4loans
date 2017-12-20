<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="PL emi calc";
}
$page_Name = "PersonalLoan";
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<Title>Personal Loan EMI Calculator - Calculate your eligibility with Personal Loan calculator | Deal4loans</title>
<meta name="keywords" content="calculate emi of Personal, emi Personal calculator, calculate Personal loan, Personal loan loan calculator, indian Personal loan emi calculator, used Personal emi, new Personal emi"/>
<meta name="description" content="Personal loan emi calculator?? Personal loan Calculator for new and used Personal loans. Calculate accurate Personal loan eligibility with Deal4loans.com"/>
<link href="/style/slider.css" rel="stylesheet" type="text/css" />
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<?php //include "pl-form-js.php"; ?>
</head>
<body>
<?php include "top-menu.php";  include "main-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal loan</u></a> <span class="text12" style="color:#4c4c4c;"> > Personal Loan EMI Calculator </span></div>
<div class="intrl_txt" style="margin:auto;"><div style=" float:left; width:940px; height:auto; margin-top:15px; margin-left:20px; text-align:justify;">
<h1 class="text3"  style="width:900px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;">Personal Loan EMI Calculator</h1>
<div style="float:left; width:663px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="900" height="1" /></div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:15px;">Process - 1</div>
<table cellpadding="0" cellspacing="0" border="0" align="center" class="font2">
<tr><td colspan="2" style="padding-bottom:10px;">
<?php 
$newsource="PL emi calc";
$subjectLine="Get Personal loan emi calculation from 10 Banks";
//include "pl-form.php"; 
?>
<script Language="JavaScript" Type="text/javascript" src="/scripts/tooltip.js"></script>
<link rel="stylesheet" href="/jsj/stylecalpl.css" type="text/css" media="screen" />
<script type='text/javascript' src='/jsj/jquery.min.js'></script>
<script type='text/javascript' src='/jsj/jquery-ui-slider.min.js'></script>
<script type='text/javascript' src='/jsj/globalize.min.js'></script>
<script type='text/javascript' src='/jsj/jquery.color.js'></script>
<script type='text/javascript' src='/jsj/superfish.js'></script>
<script type='text/javascript' src='/jsj/highcharts.js'></script>
<script type='text/javascript' src='/jsj/jquery.custom.min.pl1.js'></script>
</td></tr>
<tr><td width="604" lass="text" style="color:#4c4c4c; size:18px; height:37px;" colspan="2"  >
<div class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:10px;">Process - 2<br />Just calculate Personal loan EMI <br />Sample Calculations</div><br /><br />
</td></tr>
<tr><td  style="padding-left:100px; font-weight:bold; padding-bottom:5px;" class="frmbldtxt" >To check exact Emi-Input your loan Amount/Tenure/rate of interest below. </td>
<td  class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:30px;"  ><span >Sample Results</span></td></tr>
<tr><td width="604" style="padding-left:100px;">			
<form id="calc_Form">
<div class="lamount" >
<strong>Principal Personal Loan Amount</strong>
Rs.
<input id="L_Amt" name="L_Amt" value="1,00,000" type="text"/>
</div>
<div id="loanamountslider"></div>
<div ><strong>Interest Rate</strong><input id="loan_intr" name="loan_intr" value="14.5" type="text"/><span><strong> % Per Annum</strong></span></div>
<div id="loan_intrslider"></div>
<div ><strong>Loan Term</strong><input id="tenure" name="tenure" value="4" type="text"/><input name="loantenure" id="tenure_years" value="tenure_years" checked type="radio" style="display:none;"/><span><strong> Years</strong></span></div>
<div class="clear"></div>
<div id="tenureslider"></div>
</form>
</td><td width="456" align="center" valign="top">
<div id="emipaymentdetails">
	<div id="emisum">
		<div id="emiamount"><h4>&nbsp;</h4>
		  <h4>Monthly Instalment (EMI)</h4>
		  <p style="font-size:12px;">Rs. <span>2,758</span></p>
		  <p style="font-size:12px;">&nbsp;</p>
		</div>
        <div id="emitotalinterest"><h4>Total Interest Amount</h4><p style="font-size:12px;">Rs. <span>32,374</span></p>
          <p style="font-size:12px;">&nbsp;</p>
        </div>
        <div id="emitotalamount" class="column-last"><h4>Total Amount<br/>(Principal + Interest)</h4><p style="font-size:12px;">Rs. <span>132,374</span></p></div>
    </div>
</div>
</td></tr>
<tr><td width="604" style="padding-left:100px; font-weight:bold; padding-bottom:5px;" colspan="2">Emi charts /Illustrations are below.</td></tr>
<tr><td>
<div id="emibarchart"  class="highcharts-container"></div>
</td><td>
<div id="emipiechart" class="highcharts-container"></div> </td></tr>
<tr><td colspan="2">
<div id="emipaymenttable"></div>
</td></tr>
<tr><td colspan="2" class="frmbldtxt"  style="font-weight:normal;">Our Personal loan emi calculator is easy to use. Use personal loan calculator as a guide before availing for any kind of personal loan. Personal loan emi calculator let's you judge how affordable a loan can be for you. Always use the calculator to get a quick quote on your loan EMIs. If the quote satisfies you, then apply accordingly. with simple process.<br /><br />1.Enter the loan amount you wish to avail in the Persoanl Loan EMI calculator.<br />2.Select the interest rate (reducing).<br />3.Enter the loan tenure (months).<br />4.Our personal loan calculator will show you just how much your EMI amount comes to.<br /></td></tr>
</table>
<script type='text/javascript' src='/jsj/ui.tabs.js'></script>
<div class="txt"><h3>Other Available Calculators are - </h3><a href="Contents_Calculators.php"><b>EMI Calculator</b></a> <br /><a href="http://www.deal4loans.com/home-loan-calculator.php"><strong>Home Loan EMI Calculator</strong></a><br /> <a href="balance-transfer-home-loans.php"><strong>Home Loan Balance Transfer</strong></a><br /><a href="loan-amortization-calculator.php"><strong>Loan Amortization Calculator</strong></a></div></div>
</div>
<?php include "footer_pl.php"; ?>
</body>
</html>