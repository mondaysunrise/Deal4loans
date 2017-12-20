<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();
$maxage=date('Y')-62;
$minage=date('Y')-18;
$retrivesource = "LAP SEO1";
$TagLine = "Apply Loan Against Property";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loan Against Property - Best property loans <?php echo DATE('F'); ?> 2017 India</title>
<meta name="keywords" content=" Loan Against Property, Loan Against Property India, Loan Against Property information, Loan Against Property documents, Loan Against Property rates, Loan Against Property eligibility, LAP">
<meta name="Description" content="Best Loan Against Property India. Get Instant Quotes on Interest Rates, Eligibility & EMI from SBI, ICICI, HDFC, Axis Bank, HSBC.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/loan-against-property-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="lap_inner_wrapper" style="margin:auto;">
<div style="margin-top:70px;" class="common-bread-crumb"><a href="index.php" class="text12" style="color:#0080d6; font-size:14px;">Home</a> <strong style="font-size:14px; font-weight:normal;" class="text12"> » </strong> <span style="color:#4c4c4c; font-size:14px;">Loan Against Property</span></div>
  
  
  <h1 class="lap-h1">Loan Against Property</h1>
   <div>While searching for a loan against property, the first question that comes to mind is how much I can get "<strong>Kitna Milega?</strong>" <br />
    <br />
    The answer to the question of "<strong>Kitna Milega</strong>" is calculated on the basis of a) the percentage of property value that you own and b) how much income you have left after paying other EMIs that you can use for repaying this new loan. So you can get Loan against property up to a certain percentage of the value of the property and your Net Income.<br />
    <br />
    A limiting factor for being available for loan against property is <strong>Maximum Age</strong>. For salaried employees, the maximum age to be eligible is 60 years and for self employed individuals; the maximum age is 70 years.<br />
    <br />
    Find out the amount you are eligible for and get a quote from top banks with our Eligibility calculator.<br />
  </div>
  <div style="clear:both; height:15px;"></div>
  <?php include "loan-against-property-widget.php"; ?>
  <div style="clear:both; height:15px;"></div>
  <div>
    <h3> Why compare loan against property deals with Deal4loans.com?</h3>
    Deal4loans is India’s largest loan comparison service. For trusted advice on loans and solutions on your financial needs, you can turn to us. With tie ups with leading banks and financial institutions providing loan against property deal4loans is your ultimate destination for best deals. Our user friendly website enables you to compare the best offerings in the market and make the best possible choice.
    <h3>Loan Against Property can be taken for following purposes:</h3>
    &#10004; Expanding your business<br />
    &#10004; Get your child married<br />
    &#10004; Send your child for higher studies<br />
    &#10004; Fund your dream vacation<br />
    &#10004; Fund Medical Treatments<br />
    <h3>Characteristics of a Loan against Property</h3>
    &#10004; Cheaper than Personal Loans: It works out to be much cheaper than a personal loan, which is usually issued at interest rates in the region of 16% - 21%.<br />
    &#10004; Longer Loan Tenure: The tenure for a Loan against Property is usually longer than that for a personal loan. Generally, LAP is given for a maximum tenure of 10 years.<br />
    &#10004; Lower EMI: Since the rate of interest is lower, many times, LAP Equated Monthly Installments (EMI) turn out to be cheaper than those under personal loans.<br />
    &#10004; Simple documentation and Fast Approvals: LAP being a secured Loan has comparatively faster approvals and minimal documentation </div>
  <h3> Percentage of loan that you can get on different types of property is listed below:</h3>
  <table width="100%" cellpadding="0" cellspacing="1" class="table_bgcolor_Border">
    <tr bgcolor="#FFFFFF">
      <td><strong>Residential Property:-</strong><br />
        &nbsp;Self Occupied – 65%<br />
        &nbsp;Vacant - 55%<br />
        &nbsp;Rented&nbsp;- 55%<br /></td>
      <td><strong>&nbsp;Commercial Property:-</strong><br />
        &nbsp;Self Occupied – 50%<br />
        &nbsp;Vacant - 40%<br />
        &nbsp;Rented&nbsp;- 40%<br /></td>
    </tr>
  </table>
  Note: The amount of loan available against property varies from bank to bank in the range of 5-10% <br />
  <br />
  <h3>Interest Rates and processing fees charged by Major Banks on Loan against property:</h3>
  <table  border="0" align="center" width="100%" cellpadding="0" cellspacing="1" class="table_bgcolor_Border">
    <tr class="table_bgcolor">
      <td height="35" align="center"><strong>Banks</strong></td>
      <td height="35" align="center"><strong>up to 30 lacs</strong></td>
      <td height="35" align="center"><strong>30-75 lacs</strong></td>
      <td height="35" align="center"><strong>75 lacs & above</strong></td>
      <td height="35" align="center"><strong>Processing fees</strong></td>
    </tr>
    <?php
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
$getRatesSql = "select * FROM  `lap_interest_rate` where Status =1 and B_id in (1,2,4,17,7,3) order by Sequence asc";
list($getRatesNumRows,$getRatesQuery)=MainselectfuncNew($getRatesSql,$array = array());
$BankURL = '';
$link1 = '';
$link2 = '';
for($i=0;$i<$getRatesNumRows;$i++)
{
	$BankURL = '';
	$link1 = '';
	$link2 = '';
	$BankName = $getRatesQuery[$i]['BankName'];
	$Upto30 = $getRatesQuery[$i]['Upto30'];
	$Upto75 = $getRatesQuery[$i]['Upto75'];
	$Above75 = $getRatesQuery[$i]['Above75'];
	$ProcessingFee = $getRatesQuery[$i]['ProcessingFee'];

?>
    <tr bgcolor="#FFFFFF">
      <td width="12%" height="33" align="center"><strong><?php echo $BankName; ?></strong></td>
      <td width="22%" align="center"><?php echo $Upto30; ?></td>
      <td width="22%" align="center"><?php echo $Upto75; ?></td>
      <td width="22%" align="center"><?php echo $Above75; ?></td>
      <td width="22%" align="center"><?php echo $ProcessingFee; ?></td>
    </tr>
    <?php } ?>
  </table>
  <div style="clear:both;"></div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>