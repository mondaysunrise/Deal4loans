<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan - Helpful Tips | Personal Loan India-Deal4loans</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="en-us">
<meta name="Keywords" content="Personal Loans Articles, Personal Loans Must Read, Personal Loans tips">
<meta name="description" content="With deal4loans Personal Loan you can get instant money for a wide range of your personal finance needs like renovation of your home, marriage loans, child's education, medical expenses etc. Personal loan is a flexible option to fulfill your personal needs at low interest rates on availing of personal loans. Personal loans available for both salaried & self employed individuals with easy loans repayment through flexible EMI option">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="d4l_inner_wrapper">
  <div style="margin-top:70px;"></div>
  <div class="common-bread-crumb"><a href="index.php">Home</a> &gt;<a href="personal-loans.php">Personal Loan</a> > <span  class="text12" style="color:#4c4c4c;">Personal Loan Mustread</span></div>
  <div style="margin:auto;">
    <div class="left-wrapper">
      <div >
        <?php
    if(((strlen($_SESSION['Temp_Last_Inserted'])>0) && ($_REQUEST['source']=="QuickApply")) || ($_REQUEST['source']=="ndtv")) 
    {
    ?>
        <div style="Font-size:12px; font-weight:bold; padding-bottom:10px; padding-top:10px;">Thanks for applying Personal Loan through Deal4loans.com. 
          You will soon receive a Call from us.</div>
        <br>
        <?php 
	  }
	?>
        <h1 class="pl-h1">Personal Loan Mustread</h1>
        <div>
          <p> <b>Why Personal Loan ?</b> <br />
            In this day and age of internet everything you need is just a click away. And so are loans. The loan process has also become more easier and more customer-friendly. Consumerism has increased to such extent that it makes us want things NOW rather than wait for months or even years to save enough money to buy things we want.<br />
            <br>
            Therefore, today we don't think twice before  committing ourselves to indebtedness. The <a href="http://www.deal4loans.com/personal-loans.php" title="personal loan">personal  loan</a> schemes are quite promising today, no doubt. But we need to be extra  careful.<br>
            <br />
            Unsecured loans, such as personal loans are usually very expensive.
            While availing a loan has become affordable and simple, it does have its drawback. <br>
            <br />
            The <a href="http://www.deal4loans.com/personal-loan-banks.php" title="personal loan banks">personal loan banks</a> may not always tell you the  full story. Therefore it is important for us to delve deep into any loan offer  and make the right choice. <br>
            <br>
            <b>Here are some helpful tips to look out for before you decide to avail personal loan</b><br>
            <br />
            <b>1.</b> You should do a complete and detailed market survey of the various options like the interest rates they offer, the pre-payment charges they levy, terms and conditions. <br>
            <br />
            <b>2.</b> Interest rates are the most critical of all the costs that you pay. Therefore you should go for the cheapest option. Beware of banking terms like flat <a href="http://www.deal4loans.com/personal-loan-interest-rate.php" title="personal loan interest rates">personal loan interest rates</a> that appear to be cheaper but are in fact the most expensive. For example a 7% flat rate would come out to an effective cost of around 13%. Therefore its better to choose a monthly reducing balance option than a half-yearly reducing option or flat-rate option. This means lower effective cost for the same stated interest rate. Interest-free loans are sometimes too good to be true but view them with suspicion. <br>
            <br />
            <b>3.</b> There will also be other costs such as processing charges. You should ask for zero processing fees and zero-penalty for pre-payment option. If this is not available, then lowest cost would be better. Make sure you work out as to how much these other costs add up to. So even though the interest rate may be lower, it usually adds up to being expensive. <br>
            <br />
            <b>4.</b> Usually the EMIs may come out a lot more than what you can afford on a monthly basis. But keep in mind that you should know that lower tenure will reduce the loan amount and lower loan amount will reduce the tenure. <br>
            <br />
            <b>5.</b> Make sure that all deals and offers agreed upon are supported by relevant papers. So make sureyou always ask for a letter in a banks letter-head mentioning the likes of, exact rate of interests, processing fees, pre-payment charges along with interest-schedule. Also before signing the documents, make sure you recheck all terms and conditions.<br>
            <br />
            <b>6.</b> Do not at any circumstance give any false information. This may amount to fraud and could land you in trouble.<br>
            <br />
            <b>7.</b> Do not sign any blank documents. Even if it takes you a few hours to fill-up the form, please do so. Do not leave anything for the executive to fill-up.<br>
            <br />
            <b>8.</b> Get more info about personal loan read <a href="http://www.deal4loans.com/loans/category/personal-loan/" title="Articles about personal loan">Articles about personal loan</a>.<br>
            <br />
            Finally, once you have received a loan do your best to pay it back as quickly as possible. Banks make their money off the interest they charge and the sooner you pay back a loan the less money you will have to pay in interest. 
            And again, thank you visiting our website.<br>
          </p>
        </div>
      </div>
    </div>
    <?php include "right-widget.php"; ?>
  </div>
</div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>