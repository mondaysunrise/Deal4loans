<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$source = $_REQUEST['source'];
}
else
{
	$source="site page";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Education Loan online India | Deal4Loans India</title>
<meta name="keywords" content="Apply Education Loans, Compare Education Loans, education loans, online education loan form, apply online education loan" />
<meta name="description" content="Apply Education Loan online – Get Instant Quotes on Education loan Banks of India with Deal4loans.com, Student loans" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href="css/education-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="edu_inner_wrapper">

<div style="margin-top:70px;" class="common-bread-crumb"><a href="index.php" class="text12" style="color:#0080d6; font-size:14px;">Home</a> <strong style="font-size:14px; font-weight:normal;" class="text12"> » </strong> <span style="color:#4c4c4c; font-size:14px;"><?php echo GETQUOTEFOR;?> Education Loan</span></div>
 <div style="clear:both; height:10px;"></div>
 <h1 class="edu-h1"><?php echo GETQUOTEFOR;?> Education Loan</h1>
 <div style="clear:both; height:15px;"></div>
<?php include "education-loan-widget.php";?>
  <div style="clear:both; height:15px;"></div>

</div>
<!--
<div style="clear:both; height:20px; width:964px; margin:auto; margin-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>