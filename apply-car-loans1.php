<?php
	require 'scripts/session_check.php';
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
 <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply Car Loans online India | Deal4loans</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Car Loan – Online Car loan apply with deal4loans, Get instant quotes on auto loans.">
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/wp_cl.css" rel="stylesheet" type="text/css" /><script type="text/javascript" src="validate_cl.js"></script>
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list-clhdfc.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
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
}
.red {
	color: #F00;
}
-->
</style>
<style type="text/css">
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	
	form{
		display:inline;
	}

.style1 {font-family: 'Droid Sans', sans-serif}

</style>  
</head>

<body>
<!--top-->
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car Loan</u></a> <span  class="text12" style="color:#4c4c4c;">> Apply for Car Loan</span></div>

<div style="clear:both; height:15px;"></div>

<div class="intrl_txt" style="margin:auto;">
<?php include "car_loans_frm.php"; ?>




<br>
<br />
<table width="964" border="0" align="center" cellpadding="0" cellspacing="0"  style="border: 1px solid #d5cfb1; ">
  
  <tr>
   <td valign="top"  >
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td height="53" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px; "><strong>Banks/Rates</strong></strong></td>
        <td height="53" align="center" valign="middle" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;" class="font2"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>HDFC Bank</strong></strong></td>
        <td height="53" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>Magma Fincorp</strong></strong></td>
        <td height="53" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>Axis Bank</strong></strong></td>
        <td height="53" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:18px;"><strong>State Bank of India (SBI)</strong></strong></td>
        </tr>
      <tr>
        <td width="146" height="57" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; "><strong>New Car Loan </strong> (Reducing)<br />
       </td>
        <td width="198" align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"><b>10.50% - 13.00%</b>         </td>
        <td width="172" align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"><p align="center"><strong>10.75% - 12.00%</strong></p></td>
        <td width="181" align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"><b>11.50% - 14.50%</b></td>
        <td width="253" align="center" valign="middle" class="style1" style="border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"><b>10.45% </b></td>
      </tr>
      <tr>
        <td height="48" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><b> Used Car Loan</b> (Reducing)</td>
        <td align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"><b>13.5% - 14.25%</b></td>
        <td align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"><b>NA</b></td>
        <td align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"><b>16.50% - 18%</b></td>
        <td align="center" valign="middle" class="style1" style="border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"><b>16.95%</b> (up to 3 years)<br />
<b> 17.20% </b>(above 3 years)</td>
      </tr>
     
      <tr>
        <td height="51" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1;"><b>Processing Fee</b></td>
        <td align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"> Rs 2625/- to Rs. 4950/-
      </td>
        <td align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);"> -</td>
        <td align="center" valign="middle" class="style1" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);">Rs.3000/- to Rs.3500/-</td>
        <td align="center" valign="middle" class="style1" style="border-bottom:1px solid #d5cfb1; padding-left:2px; font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);">0.5% of Loan Amount</td>
      </tr>
    </table>
    </td>
      </tr>

</table>
</div>
<div style="clear:both; height:15px;"></div>
<div style="clear:both; height:20px; width:964px; margin:auto; margin-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
<?php include "footer_cl_nw.php"; ?>

</body>
</html>
