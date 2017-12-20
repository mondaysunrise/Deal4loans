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
<title>The American Express® MakeMyTrip Credit Card Terms and Conditions</title>
<meta name="description" content="The American Express® MakeMyTrip Credit Card Terms & Conditions">
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
<li>Please <a href="https://www.americanexpress.com/in/content/pdf/mmt_tandc.pdf" target="_blank">click here</a> for detailed terms & conditions.</li>
<li>For Lounge terms and conditions, <a href="https://icm.aexp-static.com/Internet/IntlHomepage/japa/IN_en/shared/pdfs/MMT_TNC.pdf" target="_blank">click here</a></li>
<li>This offer is valid only till March 31, 2017</li>
<li>For fuel offer terms and conditions, <a href="https://www.americanexpress.com/in/content/IND_ICSS_FUELEDM_PLATRCP_02_08Sep2016.html" target="_blank">click here</a></li>
<li>For domestic flights, 5% cashback is applicable only on return flights and is capped at Rs. 500. For International flights, 5% cashback will apply only on base fare and is capped at Rs. 3,000.  For all other travel categories, 5% cashback is capped at Rs 3,000  (For Domestic and International Holiday booking, the 5% cashback will be calculated on the non-air component of the holiday package and will not be applicable on airfares and taxes). 5% cashback is restricted to 2 transactions on each travel category per month. Travel categories are flights, hotels, holidays and flight + hotels. Bus, Bus plus hotel, Rail and Car bookings are not eligible for 5% cashback.The cashback will be credited to your Card Account within 21 days of the transaction.</li>
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