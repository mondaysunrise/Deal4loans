<?php
//print_r($_SERVER);
	require 'scripts/functions.php';
	session_start();
//echo 	$_SERVER['HTTP_USER_AGENT'];
?>
<html>
<head>
<title>Credit card offers | Credit Cards Eligibility </title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="credit card offers, credit cards eligibility, credit cards online information, credits cards schemes, credit card benefits, discounts on credits cards, compare credit cards in india, best credit card providers, apply online for credit cards, credit cards, credit card plans, online credit card, convenient credit card, Co branded credit cards, free credit cards">
<meta name="Description" content="Get Credit Cards offers from various banks. know your credit card eligibility. Get high rewards credit card.">
<script type="text/javascript" src="scripts/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/show-content.js"></script>
<?php
if((strlen(strpos($_SERVER['HTTP_USER_AGENT'], "Firefox")) > 0))
{
?>
<link href="card-eligibility-moz.css" rel="stylesheet" type="text/css">
<?php
}
else
{
?>
<link href="card-eligibility.css" rel="stylesheet" type="text/css">
<?php
}
?>
<?php include '~Top.php';?>

<div id="dvMainbanner">
<? if ((($_REQUEST['flag'])!=1))
	{ ?>
    <?php include '~Upper.php';?> <? } ?>

  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
 <table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" align="center" valign="middle"><h1 class="pg_heading">Credit Card Eligibility</h1> </td>
    </tr>
  <tr>
    <td align="center" valign="middle" class="brdrrgt"><div onClick="addBankdetails1();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >American Express</a></div></td>
	<div id="myDiv1" class="pstn1"></div>

    <td align="center" valign="middle" class="brdrrgt"><div onClick="addBankdetails2();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >Axis Bank</a></div></td>
	<div id="myDiv2" class="pstn2" ></div>
    <td align="center" valign="middle" class="brdrbtm"><div onClick="addBankdetails3();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >Barclays</a></div></td>
	<div id="myDiv3" class="pstn3"></div>
  </tr>
  <tr>
    <td align="center" valign="middle" class="brdrrgt"><div onClick="addBankdetails4();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >Citibank</a></div></td>
	   <div id="myDiv4" class="pstn4"></div>
    <td align="center" valign="middle" class="brdrrgt"><div onClick="addBankdetails5();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >HDFC Bank </a></div></td>
	    <div id="myDiv5" class="pstn5"></div>
    <td align="center" valign="middle" class="brdrbtm"><div onClick="addBankdetails6();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >HSBC</a></div></td>
	    <div id="myDiv6" class="pstn6"></div>
  </tr>
  <tr>
    <td align="center" valign="middle" class="brdrrgt"><div onClick="addBankdetails7();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >ICICI Bank</a></div></td>
	    <div id="myDiv7" class="pstn7"></div>
    <td align="center" valign="middle" class="brdrrgt"><div onClick="addBankdetails8();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >Standard Chartered</a></div></td>
	    <div id="myDiv8" class="pstn8"></div>
    <td align="center" valign="middle" class="brdrbtm"><div onClick="addBankdetails9();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >Kotak Bank</a></div></td>
    <div id="myDiv9" class="pstn9"></div>
  </tr>
  <tr>
   <td align="center" valign="top" class="brdrrgt" style="border:none;"><div onClick="addBankdetails10();" class="bgbldtxt" style="cursor:pointer;"><a href="#" >SBI</a></div></td>
     <div id="myDiv10" class="pstn10"></div>

    <td colspan="2" align="center" valign="bottom"  ><input type="image" value="" src="images/crd-eligblty.gif" style=" border:none;"></td>
    </tr>
  <tr>
    <td height="100">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>






   </div>
	
  </div>
<? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><? } ?>
  </body>
</html>