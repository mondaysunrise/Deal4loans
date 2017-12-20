<?php
header("Location: loan-calculators-india.php");
exit();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<title>Loan Calculator India | Deal4loans</title>
<meta name="keywords" content="emi calculator, home loan emi calculator, car loan emi calculator, personal loan emi calculator, Loan amortization calculator">
<meta name="Description" content="Loan calculators for Home Loan, Car Loan & Personal Loan, Balance transfer calculations Download, excel type calculation only at deal4loans.com.">
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
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#373737;
}
.red {
	color: #F00;
}
 
-->
</style>  
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
 
</head>
<body >
<?php include "top-menu.php"; ?>
<?php include "main-menu.php"; ?>

<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span class="text12" style="color:#4c4c4c;">Calculators</span></div>
<div style="margin:auto; width:970px;  margin-top:1px;">
<div style="width:663px; height:33; margin-top:0px; float:left; clear:right;">
<div style="width:663px; height:33; margin-top:20px; float:left; clear:right;">
<h1 class="text3" style="width:500px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;"><strong>Calculators</strong></h1>
<div style=" float:left; width:663px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="663" height="1" /></div>
<div style="clear:both; height:15px;"></div>
<!--class="lfttxtbar" -->
<div id="txt">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:4px;">
      <tr>
        <td valign="top">
         <table class="tbl_txt"><tr>
  <td colspan="2">
     <p> <a href="Contents_Calculators.php" title="EMI Calculator"><b>EMI Calculator</b></a><br>
        The EMI (Equated Monthly Installment) calculator helps you calculate how much you need to pay every month towards your loan repayment, based on the Loan Amount, Interest rate and Tenure. </p><p>
              <a href="loan-amortization-calculator.php" title="Loan Amortization Calculator"><b>Loan Amortization Calculator</b></a><br>
        This loan amortization calculator shows you the breakdown between principal and interest in your mortgage payments. Each calculation shows you amortization tables with complete mortgage amortization schedules for the loan. Simply input your loan amount, interest rate, loan term and repayment start date then click "Calculate". </p>
       <p>
         <a href="home-loan-eligibility-calculator.php" title="Home Loan Eligibility Calculator"><b>Home Loan Eligibility Calculator</b></a><br>The Home Loan eligibility calculator calculates the loan amount that you can take from a Bank, depending upon the tenure that you have chosen & the rate of interest that the Bank is charging.
The net loan amount comes after deduction of any other emi of your loan that you are paying. </p>
<p>
         <a href="personal-loan-emi-calculator.php" title="Personal Loan EMI Calculator"><b>Personal Loan EMI Calculator</b></a><br>Calculate your personal loan emi, eligibility with our deal4loans Personal loan calculator. </p>
<p>
         <a href="home-loan-emi-calculator1.php" title="Home Loan EMI Calculator"><b>Home Loan EMI Calculator</b></a><br>Calculate your home loan emi, eligibility with our deal4loans Home loan calculator. </p>
<p>
         <a href="car-loan-emi-calculator.php" title="Car Loan EMI Calculator"><b>Car Loan EMI Calculator</b></a><br>Calculate your car loan emi, eligibility with our deal4loans Car loan calculator. </p>

<p>
         <a href="home-loan-balance-transfer-calculator.php" title="Home Loan Balance Transfer Calculator"><b>Home Loan Balance Transfer Calculator</b></a><br>The Home Loan eligibility calculator calculates the loan amount that you can take from a Bank, depending upon the tenure that you have chosen & the rate of interest that the Bank is charging.
The net loan amount comes after deduction of any other emi of your loan that you are paying.  </p>
</td></tr>
</table>
        </td>
      </tr>
    </table>
    </div>
<div style=" float:left; width:663px; height:auto; margin-top:3px; text-align:right;"><span class="text11" style="color:#4c4c4c; size:18px;"><img src="images/arrow.gif"  /> <a href="#"  style="color:#0f8eda;">Back to Top</a></span>
</div>
</div></div> 
<table cellpadding="0" cellspacing="0" border="0" width="300" ><tr><td  align="right">
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=236732309688469" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe></td><td width="70">
<a class="addthis_button_tweet" style="width:70px;"></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e0d5fb863d78da4"></script>
</td><td align="left" width="80" ><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><g:plusone></g:plusone></td></tr></table>

<?php include "RightPL1.php"; ?>
</div> 
<?php include "footer_pl.php"; ?>
</body>
</html>