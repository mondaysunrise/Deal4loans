<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';
if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="CC Site Page"; }
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>American Express® Platinum Travel Credit Card Terms and Conditions</title>
<meta name="description" content="American Express® Platinum Travel Credit Card Terms and Conditions">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/credit-card-new-styles.css" type="text/css" rel="stylesheet"  />
<?php include "credit-card-ec-widget-accjs.php";?>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper padding-top-75">
<div style="clear:both;"></div>
<h1 class="cc-h1">Terms & Conditions</h1>
<div id="example-two">
<ol style="line-height:20px;">
<li>Welcome Gift is available only in the 1st year of Cardmembership on payment of the Annual Fee and after taking the first charge on the Card.</li>
<li>For IndiGo Voucher Terms & Conditions, <a href="https://icm.aexp-static.com/Internet/IntlHomepage/japa/IN_en/shared/pdfs/How_to_earn_and_claim_your_IndiGo_Vouchers.pdf" target="_blank">click here</a></li>
<li>These benefits are over and above the benefits you get on spending Rs.1.9 lacs in a year</li>
<li>For Taj Voucher Terms & Conditions, <a href="https://www.americanexpress.com/india/pdfs/How_to_claim_your_Taj_Vouchers.pdf" target="_blank">click here</a></li>
<li>For fuel offer terms and conditions, <a href="https://www.americanexpress.com/in/content/IND_ICSS_FUELEDM_PLATRCP_02_08Sep2016.html" target="_blank">click here </a></li>
	</ol>
  </div>
<div class="ac_table_box" style="margin-top:10px;">
  </div>

</div>
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
</body>
</html>