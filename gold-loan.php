<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
if(isset($_REQUEST['source']))
{
	$src=$_REQUEST['source'];
}
else
{
	$src="gold-loanPG";
}

$TagLine = "Apply Gold Loan";

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Gold Loan | Deal4Loans India</title>
<meta name="keywords" content="Apply Gold Loans, Compare Gold Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Online Gold Loans through Deal4loans.com Get instant information on gold loans from all gold loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<link href="css/gold-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>

<body>
<?php include "middle-menu.php"; ?>
<div class="gold_inner_wrapper">
  <div style="margin-top:70px; color:#0a8bd9;" class="common-bread-crumb"><a href="index.php" class="text12" style="color:#0080d6; font-size:14px;">Home</a> <strong style="font-size:14px; font-weight:normal;" class="text12"> » </strong> <span style="color:#4c4c4c; font-size:14px;"> Apply Gold Loan</span></div>
  <div style="clear:both; height:10px;"></div>
  
    <h1 class="gold-h1">Gold Loan</h1>
  <div style="clear:both; height:10px;"></div>
  <div style="float:right;"><a href="Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" name="Image3" width="95" height="20" border="0" id="Image3" /></a>
</div>
<div> <span> <b>What is Gold Loan?</b><br />
  As the name suggest its <a href="http://www.deal4loans.com/loans/loan/gold-loan-loan/gold-loan-loan-against-gold-very-promising-for-banks/">loan against Gold</a>. It's the most convenient way to receive cash in no time from any NBFC/Bank by pledging your Gold ornaments/Coins/bars/Exchange traded funds ETFs/ SBI gold certificates etc., this is one loan product which comes with minimal documentation &amp; no processing time in short its over the counter product. <br />
  <br />
  Product is designed in a way it ensures hassle free process for the customer &amp; loan availed can be put to any use. <br />
  <br />
  Loan amount eligibility is evaluated basis on the Gold value banks usually fund 70-80% of the gold market value &amp; on repayment of the loan gold deposits are returned back to the customer. <br />
  <br />
  This loan comes much cheaper than <a href="http://www.deal4loans.com/personal-loans.php">personal loan</a> as it’s a secured product &amp; rate of interest ranges between 11.5-24% per annum. <br />
  <br />
  Rate of interest is decided on two factors risk criteria ( What % of market value of Gold you are availing loan if its 90% of the Gold market value then interest charged will be higher &amp; vice a versa for lower loan amount as compared to gold value) &amp; customer relationship with the bank. </span></div>
<div style="clear:both; height:15px;"></div>

<?php include "gold-loan-widget.php";?>

</div>
<div style="clear:both; height:15px;"></div>

<?php include "footer_sub_menu.php"; ?>
</body>
</html>