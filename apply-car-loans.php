 <?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="CL Site Page";
}
	
$page_Name = "CarLoan";
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply Car Loans online India | Deal4loans</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<meta name="description" content="Apply Car Loan – Online Car loan apply with deal4loans, Get instant quotes on auto loans." />
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/wp_cl.css" rel="stylesheet" type="text/css" />
<link href="css/cont_calc.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="validate_cl.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list-clhdfc.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="css/car-loan-styles.css" type="text/css" rel="stylesheet"  />
<style type="text/css">
/* Big box with list of options */

#ajax_listOfOptions {
	position: absolute;	/* Never change this one */
	width: 250px;	/* Width of box */
	height: 160px;	/* Height of box */
	overflow: auto;	/* Scrolling features */
	border: 1px solid #317082;	/* Dark green border */
	background-color: #FFF;	/* White background color */
	color: black;
	text-align: left;
	font-size: 10px;
	z-index: 50;
}
#ajax_listOfOptions div {	/* General rule for both .optionDiv and .optionDivSelected */
	margin: 1px;
	padding: 1px;
	cursor: pointer;
	font-size: 10px;
}
#ajax_listOfOptions .optionDivSelected { /* Selected item in the list */
	background-color: #2375CB;
	color: #FFF;
}
#ajax_listOfOptions_iframe {
	background-color: #F00;
	position: relative;
	z-index: 55555;
}
form {
	display: inline;
}
</style>
<!--
<script src="//code.jquery.com/jquery-1.8.3.js"></script>
<script type="text/javascript" src="script2.js"></script>
<link href="source1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="menu-style.css" />
-->
</head>

<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both; margin-top:70px;"></div>
<div class="cl_inner_wrapper">
<div class="common-bread-crumb"><a href="index.php">Home</a> <strong style="font-size:12px;"> &gt; </strong> <a href="car-loans.php" class="text12" style="color:#0080d6; font-size:14px;">Car Loan</a>  <strong style="font-size:12px;"> &gt; </strong><span class="text12" style="color:#4c4c4c; font-size:14px;"><?php echo GETQUOTEFOR;?> Car Loan</span></div>
<div style="clear:both; height:5px;"></div>
<h1 class="cl-h1"><?php echo GETQUOTEFOR;?> Car Loans</h1>
<div style="clear:both; height:15px;"></div>
<div>
  <?php include "car_loans_frm.php"; ?>
  </div>
  <div style="clear:both; height:15px;"></div>
   <div style="clear:both;"></div>
    <div class="overflow-width">
  <table width="100%" border="1">
<tbody>
<tr>
<td style="text-align: center;"><strong>Banks/Rates</strong></td>
<td style="text-align: center;"><strong>HDFC Bank</strong></td>
<td style="text-align: center;"><strong>Magma Fincorp</strong></td>
<td style="text-align: center;"><strong>Axis Bank</strong></td>
<td style="text-align: center;"><strong>State Bank of India (SBI)</strong></td>
<td style="text-align: center;"><strong>TVS Credit Finance</strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong>New Car Loan (Reducing)</strong></td>
<td style="text-align: center;">9.25% - 11.25%</td>
<td style="text-align: center;">12.00% - 16.00%</td>
<td style="text-align: center;">9.40% - 16.50%</td>
<td style="text-align: center;">9.20% - 9.25%</td>
<td>-</td>
</tr>
<tr>
<td style="text-align: center;"><strong>Used Car Loan (Reducing)</strong></td>
<td style="text-align: center;">10.95% - 13.77%</td>
<td style="text-align: center;">NA</td>
<td style="text-align: center;">14.50% - 16.25%</td>
<td style="text-align: center;">12.65%</td>
<td style="text-align: center;">14.00% - 18.00%</td>
</tr>
<tr>
<td style="text-align: center;"><strong>Processing Fee</strong></td>
<td style="text-align: center;">Rs.2825/- to Rs.5150/-</td>
<td style="text-align: center;">Rs.3500 to Rs.4625, Zero processing fees on select schemes</td>
<td style="text-align: center;">Rs.3500/- to Rs.5500/-</td>
<td style="text-align: center;"> 0.50% of loan amount +ST</td>
<td style="text-align: center;">N.A</td>
</tr>
</tbody>
</table>
</div>
<div style="clear:both; height:15px;"></div>
<div><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
</div>
 </div>
 </body>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>