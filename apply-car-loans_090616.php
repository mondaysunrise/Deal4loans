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
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <!--Remove tag when live this page-->
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<meta name="description" content="Apply Car Loan – Online Car loan apply with deal4loans, Get instant quotes on auto loans." />
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/wp_cl.css" rel="stylesheet" type="text/css" />
<link href="css/cont_calc.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="validate_cl_090616.js"></script>
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
  <?php include "car_loans_frm_090616.php"; ?>
  </div> 
  <div style="clear:both; height:15px;"></div>
   <div style="clear:both;"></div>
    <div class="overflow-width">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_bgcolor_Border">
    <tr>
      <td valign="top"  ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="table_bgcolor_Border">
          <tr class="table_bgcolor">
            <td height="53" align="center" valign="middle"><strong>Banks/Rates</strong></td>
            <td height="53" align="center" valign="middle"><strong>HDFC Bank</strong></td>
            <td height="53" align="center" valign="middle"><strong>Magma Fincorp</strong></td>
            <td height="53" align="center" valign="middle"><strong>Axis Bank</strong></td>
            <td height="53" align="center" valign="middle"><strong>State Bank of India (SBI)</strong></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td width="20%" height="57" align="center" valign="middle"><strong>New Car Loan </strong> (Reducing)<br /></td>
            <td width="20%" align="center" valign="middle"><b>10.00% - 11.50%</b></td>
            <td width="20%" align="center" valign="middle"><strong>12.00% - 16.00%</strong></td>
            <td width="20%" align="center" valign="middle"><b>11.50% - 14.50%</b></td>
            <td width="20%" align="center" valign="middle"><strong>9.80%  p.a. ( for WOMEN)<br />
9.85% p.a. ( for Others)</strong></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="48" align="center" valign="middle"><b> Used Car Loan</b> (Reducing) </td>
            <td align="center" valign="middle"><b>12.50% - 14.25%</b></td>
            <td align="center" valign="middle"><b>NA</b></td>
            <td align="center" valign="middle"><b>16.50% - 18%</b></td>
            <td align="center" valign="middle"><strong>16.90%&nbsp;</strong>(up to 3 years)<br />
              <strong>17.15%&nbsp;</strong>(above 3 years)</td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td height="51" align="center" valign="middle"><b>Processing Fee</b></td>
            <td align="center" valign="middle">Up to 2.5 Lakhs: Rs.  3220/-, (Above 2.5 Lac – Rs.4390/- to Rs.5870/-.)</td>
            <td align="center" valign="middle"> -</td>
            <td align="center" valign="middle">Rs.3500/- to Rs.5500/-</td>
            <td align="center" valign="middle">Nil or No Processing Fees till 31.12.2015</td>
          </tr>
</table></td>
</tr>
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