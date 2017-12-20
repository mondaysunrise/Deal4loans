<?php
require 'scripts/session_check.php';
require 'scripts/functions.php';
require 'scripts/db_init.php';

session_start();
if(isset($_POST['submit']))
{
	$Monthly_Income = $_POST['Monthly_Income'];
	$Other_EMI = $_POST['Other_EMI'];
	$Duration_of_Loan = $_POST['Duration_of_Loan'];
	$Interest_Rate = $_POST['Interest_Rate'];
	$Loan_Amount_Required = $_POST['Loan_Amount_Required'];
	$Available_Income = $Monthly_Income - $Other_EMI;
	$intr =  $Interest_Rate / 1200;
	$month = $Duration_of_Loan * 12;
	$EMI = $Loan_Amount_Required * ($intr / (1 - (pow(1/(1+$intr), $month))));
	$IntermediateValue = $Available_Income / $EMI;
	$EligibleAmount = $IntermediateValue * $Loan_Amount_Required;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<title>Loan Amortization Calculator | Deal4loans</title>
<meta name="keywords" content="amortization schedule calculator, amortization schedule, amortization calculator, amortization calculation, loan calculator">
<meta name="Description" content="Amortization Calculator helps you know when your loan will be paid off. Use the Calculator to estimate your monthly loan repayments online." />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='http://www.deal4loans.com/newdesign/scripts/calculators.js' type='text/javascript' language='javascript'></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">

function checkinsurance()
{
	if(document.homeloan_calculator.loanAmt.value=="")
	{
		alert("Please fill loan Amount.");
		document.homeloan_calculator.loanAmt.focus();
		return false;
	}
	if (isNaN(document.homeloan_calculator.loanAmt.value))
	{
		alert("Please fill loan Amount in numeric only.");
		document.homeloan_calculator.loanAmt.focus();
		return false;
	}
	if(document.homeloan_calculator.tenure.value=="")
	{
		alert("Please fill Tenure.");
		document.homeloan_calculator.tenure.focus();
		return false;
	}
	if (isNaN(document.homeloan_calculator.tenure.value))
	{
		alert("Please fill Tenure in numeric only.");
		document.homeloan_calculator.tenure.focus();
		return false;
	}

	if(document.homeloan_calculator.interestRate.value=="")
	{
		alert("Please fill Interest Rate.");
		document.homeloan_calculator.interestRate.focus();
		return false;
	}
	if (isNaN(document.homeloan_calculator.interestRate.value))
	{
		alert("Please fill Interest Rate in numeric only.");
		document.homeloan_calculator.interestRate.focus();
		return false;
	}
	
	if (document.homeloan_calculator.installmentMonth.selectedIndex==0)
	{
		alert("Please enter Installment Month");
		document.homeloan_calculator.query_type.focus();
		return false;
	}
	
	if (document.homeloan_calculator.installmentYear.selectedIndex==0)
	{
		alert("Please enter Installment Year");
		document.homeloan_calculator.installmentYear.focus();
		return false;
	}


	return true;
	
}


function pressKey()
{
	alert("Non-Editable Field ( For Showing ResultOnly )");
}

</script>
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />

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
.btnclr {
    background-color: #88a943;
    border: medium none;
    color: #FFFFFF;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 12px;
    font-weight: bold;
    height: 30px;
    width: 90px;
}

-->
</style>
<?php //include "pl-form-js.php"; ?>
</head>

<body>
<!--top-->

<!--logo navigation-->
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<!--<div style="margin:auto; width:970px; height:5px; background-color:#88a943; margin-top:1px;"></div> -->

<div class="breadcrum-common" style="margin-top:75px;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > </a> <span  class="text12" style="color:#4c4c4c;"> Loan Amortization Calculator </span></div>
<div class="lac-main-wrapper" style="margin:auto;">

<div class="lac-left-box">
<div>

<h1 class="lac-head-text common-body-text">Loan Amortization Calculator</h1>
<div style=" margin-left:15px; float:left; width:100%; height:1px; margin-top:1px; "><img src="images/point5.gif" width="100%" height="1" /></div>

<div style="clear:both; height:15px;"></div>
<div class="lac-form">
<form name='formamortization' action='' method='post'>
<table width="98%" border="0" align="right" cellpadding="0" cellspacing="4">
      
      <tr>
        <td width="39%" height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; "  ><b>Loan Amount</b></td>
        <td width="61%"><input id='loanAmt' name='loanAmt' type='text' value='' maxlength='9'   style='width:160px; font-weight:bold; font-size:11px; color:#373737; height:20px;' onKeyUp="intOnly(this); getDigitToWords('loanAmt','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('loanAmt','formatedIncome','wordIncome');" onBlur="getDigitToWords('loanAmt','formatedIncome','wordIncome');" onchange='calculateamortization(document.formamortization);'/>
	<br> 
	<span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>
                  <span id='wordIncome' style="font-size:11px; font-weight:bold;color:ffffff;font-Family:Verdana;"></span></td>
      </tr>
      
      
      <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; "   ><b> Tenure</b> </td>
        <td class="text" style="  color:#FFF; font-size:13px; "><input name='tenure' type='text' value='' maxlength='10'  style='width:160px; font-weight:bold; font-size:11px; color:#373737; height:20px;' onkeypress = 'return isNumberKey(event);' onchange='calculateamortization(document.formamortization);'/> Months</td>
      </tr>
      
      <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " ><b>Interest Rate  </b></td>
        <td class="text" style="  color:#FFF; font-size:13px; "><input name='interestRate' type='text' value='' maxlength='5'  style='width:160px; font-weight:bold; font-size:11px; color:#373737; height:20px;' onkeypress = 'return isNumberKey(event,this,1);' onchange='calculateamortization(document.formamortization);'/>
		                      %per annum</td>
      </tr>
      <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " ><b>Installment Number</b></td>
        <td><input name='installment' type='text' value='' maxlength='10' style='width:160px; font-weight:bold; font-size:11px; color:#373737; height:20px;' onkeypress = 'return isNumberKey(event);' onchange='calculateamortization(document.formamortization);'/></td>
      </tr>
      <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " ><b>Installment Date</b></td>
        <td><!--<select id='installmentMonth' name='installmentMonth' style='width:57px;' onchange='calculateamortization(document.formamortization);'>
								<option value=''>Mon</option>
								<?php
									$MonthArray = array( Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec );
									for($i=0;$i<count($MonthArray);$i++)
									{
										$value = $i+1;
										echo "<option value='".$value."'>".$MonthArray[$i]."</option>";
									}
								?></select>&nbsp;<select id='installmentYear' name='installmentYear' style='width:57px;' onchange='calculateamortization(document.formamortization);'><option value='0'>Year</option>
								<?php
								
								for($i=2007;$i>1959;$i--)
								{
									echo "<option value='".$i."'>".$i."</option>";
								}
								?>
								</select> -->
								<select id='installmentMonth' name='installmentMonth' style=" height:25px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c; width:80px;"  ><option value=''>Month</option><option value=1 >Jan</option><option value=2 >Feb</option><option value=3 >Mar</option><option value=4 >Apr</option><option value=5 >May</option><option value=6 >Jun</option><option value=7 >Jul</option><option value=8 >Aug</option><option value=9 >Sep</option><option value=10 >Oct</option><option value=11 >Nov</option><option value=12 >Dec</option></select>&nbsp;<select id='installmentYear' name='installmentYear' style=" height:25px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c; width:80px;" >
								<option value='0'>Year</option>
								<? for ($i=1970;$i<=date('Y');$i++)
								{
									echo "<option  value=".$i.">".$i."</option>";
								}?></select>		</td>
      </tr>
      
      <tr>
        <td height="35" colspan="2" align="center" valign="middle" class="text" style="  color:#FFF; font-size:11px; font-weight:normal;" ><input name="button" type="button" class="btnclr" onclick='calculateamortization(document.formamortization);' value="Calculate" /> <input id='tmp' type='hidden' value=''></td>
        </tr>
      
      
    </table>
    
      </form>
      <div style="clear:both;"></div>
      </div>
 <div id='paymentsDetails' style='display:none;'>
				        <table width='100%'  border='0' cellpadding='0' cellspacing='1'  bgcolor="#d5cfb1" align='center' id='tblinstallmentDetails'  style="display:none;" >
	<tr>
	  <td width='14%' align="center" bgcolor="#88a943" class="tblwt_txt" height="22">Installment No.</td>
	  <td width='14%' align="center" bgcolor="#88a943" class="tblwt_txt" height="22">Installment Date</td>
	  <td width='14%' align="center" bgcolor="#88a943" class="tblwt_txt" height="22">Opening Balance</td>

	  <td width='14%' align="center" bgcolor="#88a943" class="tblwt_txt" height="22">EMI</td>
	  <td width='14%' align="center" bgcolor="#88a943" class="tblwt_txt" height="22"> <strong>Loan Outstanding</strong> </td>
	  <td width='14%' align="center" bgcolor="#88a943" class="tblwt_txt" height="22">Interest</td>
	  <td width='14%'align="center" bgcolor="#88a943" class="tblwt_txt" height="22">Principal</td>
	</tr>
	<tr>
	  <td id='installmentNumber' bgcolor="#FFFFFF" class="tbl_txt"></td>

	  <td id='installmentDate' bgcolor="#FFFFFF" class="tbl_txt"></td>
	  <td id='openingBalance' bgcolor="#FFFFFF" class="tbl_txt"></td>
	  <td id='payment' bgcolor="#FFFFFF" class="tbl_txt"></td>
	  <td id='loanOustanding' bgcolor="#FFFFFF" class="tbl_txt"></td>
	  <td id='intrestPortion' bgcolor="#FFFFFF" class="tbl_txt"></td>
	  <td id='principalPortion' bgcolor="#FFFFFF" class="tbl_txt"></td>
	</tr>
	</table>
				  		 <table width='100%' cellspacing='0' border="0" bgcolor="#d5cfb1">
		                 <tr><td id='tblpaymentsDetails' bgcolor="#FFFFFF"></td></tr>
				  		 </table>		                    
				  		 </div>
			<p class="common-body-text">Amortization Calculator, a schedule shows the prospective buyer important information about the loan and, if used properly, can save time, money. An amortization schedule is basically a table containing loan details. The beginning of the table shows the amount borrowed, as well as the period of scheduled payments, and any tax or insurance payments the lender makes. The amortization table will then show each payment to be made with the amount that that goes towards the principle being deducted from the loan each time. The amortization chart will then show the new balance after each payment.<br>
<br>
The advantage of Amortization Calculator is that you will know exactly when your loan will be paid off, because you will be able to see the amount that the principle goes down with each payment.</p>
<div  style="clear:both;"></div>
<font face="Verdana" size="1" color="#898989"><strong>Note:-</strong></font><br>
<font face="Verdana" size="1" color="#898989">This loan amortization calculator should only be used to estimate your repayments since it doesn't include taxes or insurance.</font>		
</div></div> 
<div class="lac-right-box"><?php include "RightPL1.php"; ?></div>
</div> 
<?php 
#include "footer1.php"; 
include("footer_sub_menu.php");
?>
</body>
</html>