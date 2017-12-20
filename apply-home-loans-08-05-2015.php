<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource="HL Site Page";
}
else
{
	$retrivesource="HL Site Page";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Home Loan apply : Apply for home loans Online and get quotes from all home loan provider of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad, Pune etc.">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"><!--Remove when you live page-->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<style type="text/css">
.apply-hl-bank-logo {
  float: left;
  margin-left: 10px;
}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div  class="hl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="d4l_inner_wrapper">
    <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">
      <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> <span> > Apply for Home Loan</span></div></div>
  <div style="clear:both; height:5px;"></div>
 <h1 class="hl-h1"></h1>
  <?php
$newsource="HL Site Page";
$subjectLine="Apply Home Loan";
include "home-loans-widget.php";
?>
  
    <br />
  <div align="center"><strong>Maximum Home loan Bank Tie ups in online space</strong></div><br />
    <div class="overflow-width">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_bgcolor_Border">
        <tr>
          <td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1"  class="table_bgcolor_Border">
              <tr class="table_bgcolor">
                <td width="82" height="43" align="center" valign="middle"><strong>Banks</strong></td>
                <td width="184" height="43" align="center" valign="middle"><strong>ICICI Bank</strong></td>
                <td width="153" height="43" align="center" valign="middle"><strong>HDFC Ltd</strong></td>
                <td width="166" height="43" align="center" valign="middle"><strong>HSBC Bank</strong></td>
                <td width="124" align="center" valign="middle"><B>PNB Housing Finance</B></td>
                <td width="133" height="43" align="center" valign="middle"><strong>Axis Bank</strong></td>
                <td width="120" height="43" align="center" valign="middle"><strong>Citibank</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="57" align="center" valign="middle"><b>Rate of Interest</b></td>
                <td height="57" align="center" valign="middle">9.85% - 9.90%</td>
                <td height="57" align="center" valign="middle">9.90% - 10.40%</td>
                <td height="57" align="center" valign="middle">
                9.95% - 10.15%(for Salaried)<br />
            	10.10% - 10.30% (for SelfEmployed)
                </td>
                <td align="center" valign="middle">9.95% - 10.50%</td>
                <td height="57" align="center" valign="middle">9.90% - 10.45% </td>
                <td height="57" align="center" valign="middle">Scheme I: 10.25%*(without Home Credit facility)<br />
                  Scheme II: 10.50%*(with Home Credit facility)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="83" align="center" valign="middle"><b>Processing Fee</b></td>
                <td height="83" align="center" valign="middle">0.50%</td>
                <td height="83" align="center" valign="middle">0.5% plus applicable service tax and cess</td>
                <td height="83" align="center" valign="middle">1% of the loan amount applied for, subject to a minimum of <img src="/new-images/rupees.gif" />10000 plus service tax. This fee is payable on application & is not refundable</td>
                <td align="center" valign="middle">0.5%</td>
                <td height="83" align="center" valign="middle">0.5% of the loan amount<br>
                  (Max. 10000/- + service tax for Salaried) </td>
                <td height="83" align="center" valign="middle">upto 1% of loan amount</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="70" align="center" valign="middle"><b>Loan Amount</b></td>
                <td height="57" align="center" valign="middle">Rs.8,00,000 - Maximum <br />
                  80% of the Cost of the Property <br />
                  (Subject to Income Eligibility)</td>
                <td height="57" align="center" valign="middle">80% of the Cost of the Property<br />
                  (Subject to Income Eligibility)</td>
                <td height="57" align="center" valign="middle">Maximum upto <img src="/new-images/rupees.gif" />10 crores <br />
                  (Subject to Income Eligibility)</td>
                <td align="center" valign="middle">Loans upto 80% of the property value.</td>
                <td height="57" align="center" valign="middle">Rs.1,00,000 - Rs.2,00,00,000</td>
                <td height="57" align="center" valign="middle">Rs.5,00,000 - Rs.10,00,00,000</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="57" align="center" valign="middle"><b>Prepayment Charges</b></td>
                <td height="57" align="center" valign="middle">No prepayment charge on floating rate home loan 
                  For one year, two year and three year fixed rate loan the prepayment charge is 2% of the outstanding loan amount plus applicable service tax and surcharge till the time loan is under fixed rate</td>
                <td height="57" align="center" valign="middle">No prepayment charges shall be payable for partial or full prepayments irrespective of the source</td>
                <td height="57" align="center" valign="middle">NIL </td>
                <td align="center" valign="middle">NIL</td>
                <td height="57" align="center" valign="middle">NIL</td>
                <td height="57" align="center" valign="middle">NIL</td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
  
  <div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
  <!--partners-->
  <div class="text" style="margin:auto; width:100%; height:auto; margin-top:25px; color:#8dae48;">Loan Partners</div>
  <div style="margin:auto; width:100%;  margin-top:20px;">
  
  
  
  <div class="apply-hl-bank-logo"><img src="/new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"><img src="/new-images/fedbank-nw.jpg" alt="Fedbank" width="130" height="38"  style="border:none;"/> </div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/pnbhfl-logo1.jpg" alt="Fedbank"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"><img src="/new-images/citibank-logo-d4l-home.jpg" alt="Citibank" width="145" height="38"  style="border:none;"/> </div>
    <div style="clear:both; height:50px;"></div>
  </div>
</div>
</div> 
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>