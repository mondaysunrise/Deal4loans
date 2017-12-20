<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';
$rqid = $_REQUEST["rqid"];

$getccdtls="Select City,City_Other From Req_Credit_Card Where Req_Credit_Card.RequestID=".$rqid;
list($recordcounthdfccc,$ccrow)=MainselectfuncNew($getccdtls,$array = array());
$City = $ccrow[0]["City"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Fill Application form for credit cards. Instant Apply & get Approval for Credit cards such as HDFC, ICICI, Citibank, Standard Chartered, SBI and American express Online in India." />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="ccmobile/css/creditcard-lp-mobile-ui.css" type="text/css" rel="stylesheet">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" >
<link rel="stylesheet" href="ccmobile/css/cc-bootstrap.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="application/javascript" src="ccmobile/js/validate.js"></script>

<style type="text/css">
.hintanchor {
	color: #CC0000;
}

</style>

<script type="text/javascript">
function ShowCityField(evt)
{
document.getElementById("ShowCityAddr").style.display="block";
}
function showProfDetails(evt)
{
document.getElementById("ShowProfDetails").style.display="block";
}


</script>

</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:90px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> Apply Credit Card</span></div>
<div style="clear:both; height:10px;"></div>
<?php
$retrivesource = "CC Site Page";
$subjectLine="";
include "credit-card-apply-widget-step060416.php";?>
 <div style="clear:both;"></div>

</div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="hide-top"><?php include "footer_sub_menu.php"; ?></div></body>
</html>