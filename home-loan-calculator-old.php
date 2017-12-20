<?php
	require 'scripts/functions.php';
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
	
//	$EMI = $Loan_Amount_Required * ($intr / (1 - (pow(1/(1+$intr), $month))));
	
	//$IntermediateValue = $Available_Income / $EMI;
		
	$EligibleAmount = $Available_Income * 45;
	$EMI = $EligibleAmount * ($intr / (1 - (pow(1/(1+$intr), $month))));
		//echo $EMI;

	

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Calculator | Home Loan Eligibility calculator | Home Loan EMI Calculator </title>
<meta name="keywords" content="home loan emi calculator, home loan calculator, home loan eligibility calculator, Home loan calculator india">
<meta name="Description" content="home loan calculator: home loan eligibility calculator calculates accurate emi and eligibility of your borrower home loan. Home loan calculator calculates your eligibility, EMI on the basis of your monthly income, duration of loan, interest rate.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">
function checkinsurance()
{
	if(document.homeloan_calculator.Monthly_Income.value=="")
	{
		alert("Please fill Monthly Income.");
		document.homeloan_calculator.Monthly_Income.focus();
		return false;
	}
	if (isNaN(document.homeloan_calculator.Monthly_Income.value))
	{
		alert("Please fill Monthly Income in numeric only.");
		document.homeloan_calculator.Monthly_Income.focus();
		return false;
	}
	if(document.homeloan_calculator.Duration_of_Loan.value=="")
	{
		alert("Please fill Duration of Loan.");
		document.homeloan_calculator.Duration_of_Loan.focus();
		return false;
	}
	if (isNaN(document.homeloan_calculator.Duration_of_Loan.value))
	{
		alert("Please fill Duration of Loan in numeric only.");
		document.homeloan_calculator.Duration_of_Loan.focus();
		return false;
	}

	if(document.homeloan_calculator.Interest_Rate.value=="")
	{
		alert("Please fill Interest Rate.");
		document.homeloan_calculator.Interest_Rate.focus();
		return false;
	}
	if (isNaN(document.homeloan_calculator.Interest_Rate.value))
	{
		alert("Please fill Interest Rate in numeric only.");
		document.homeloan_calculator.Interest_Rate.focus();
		return false;
	}
	
	/*if(document.homeloan_calculator.Loan_Amount_Required.value=="")
	{
		alert("Please fill Loan Amount Required.");
		document.homeloan_calculator.Loan_Amount_Required.focus();
		return false;
	}
	if (isNaN(document.homeloan_calculator.Loan_Amount_Required.value))
	{
		alert("Please fill Loan Amount Required in numeric only.");
		document.homeloan_calculator.Loan_Amount_Required.focus();
		return false;
	}*/
	return true;
	
}


		function calculateincome(frm, x)
		{ 
			
			 var monthlyinc = document.homeloan_calculator.Monthly_Income.value;
 			 var otherem  = document.homeloan_calculator.Other_EMI.value;
			//alert(document.getElementById(Monthly_Income).value);	
			//		document.getElementById(arr2).value
			var arr='Available_Income';
			var arr2='Monthly_Income';
			var z=(document.getElementById(arr2).value) - x;
			document.getElementById(arr).value=z;
					
	//		frm.submit();
		}


function pressKey()
{
	alert("Non-Editable Field ( For Showing ResultOnly )");
}


</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
  <span><a href="index.php">Home</a> > Home Loan Eligibility Calculator</span>
	
  <div id="txt" style="padding-top:20px;">
  <form method="post" name="homeloan_calculator" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return checkinsurance();">
 <table width="458" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="74" align="center" valign="middle" background="new-images/apl-tp.gif"><h1 >Home Loan Eligibility Calculator</h1></td>
  </tr>
  <tr>
    <td height="35" align="center" valign="top"  class="aplfrm" >Now you can Calculate your Eligibility for the Home Loan by using the Calculator. Fill in your details and Calculate the Amount you are Eligible for.</td>
  </tr>
  <tr>
    <td class="aplfrm"><table width="420" border="0" align="right" cellpadding="0" cellspacing="0">
      
      <tr>
        <td width="36%" height="35" valign="top" class="formtext" style="font-weight:bold; padding-top:8px;">Monthly Income </td>
        <td width="64%"><input type="text" name="Monthly_Income" id="Monthly_Income" tabindex="1" value="<?php if(isset($Monthly_Income)) echo $Monthly_Income ?>"  onKeyUp="intOnly(this); getDigitToWords('Monthly_Income','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('Monthly_Income','formatedIncome','wordIncome');" onBlur="getDigitToWords('Monthly_Income','formatedIncome','wordIncome');" style="width:100px; font-weight:bold; font-size:11px; color:#373737;"/></td>
      </tr>
      <tr>
        <td  colspan="2" valign="top" class="formtext" style="font-weight:bold; padding-left:153px;" > <span id='formatedIncome' style='font-size:11px; font-weight:bold;color:#373737;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:#373737;font-Family:Verdana;text-transform: capitalize;'></span>
<span style='font-size:11px; font-weight:bold;color:#373737;font-Family:Verdana;'><?php if(isset($Monthly_Income)) echo "Rs. ".convert_number($Monthly_Income)." ."; ?></span></td>
        </tr>
      <tr>
        <td height="35" valign="top" class="formtext" style="font-weight:bold; padding-top:8px;" >Other EMI </td>
        <td><input type="text" name="Other_EMI" id="Other_EMI" tabindex="2" value="<?php if(isset($Other_EMI)) echo $Other_EMI ?>"  onKeyUp="intOnly(this); getDigitToWords('Other_EMI','formatedOther_EMI','wordOther_EMI'); calculateincome(this.form,this.value);" onKeyPress="intOnly(this); getDigitToWords('Other_EMI','formatedOther_EMI','wordOther_EMI');" onBlur="getDigitToWords('Other_EMI','formatedOther_EMI','wordOther_EMI');"  style="width:100px; font-weight:bold; font-size:11px; color:#373737;"/></td>
      </tr>
      <tr>
        <td  colspan="2" valign="top" class="formtext" style="font-weight:bold; padding-left:153px;" ><span id='formatedOther_EMI' style='font-size:11px; font-weight:bold;color:#373737;font-Family:Verdana;'></span><span id='wordOther_EMI' style='font-size:11px;
font-weight:bold;color:#373737;font-Family:Verdana;text-transform: capitalize;'></span>
<span style='font-size:11px; font-weight:bold;color:#373737;font-Family:Verdana;'><?php if(isset($Other_EMI)) echo "Rs. ".convert_number($Other_EMI)." ."; ?></span></td>
        </tr>
      <tr>
        <td height="35" valign="top" class="formtext" style="font-weight:bold; padding-top:8px;" >Available Income </td>
        <td><input type="text" name="Available_Income" id="Available_Income" readonly  value="<?php if(isset($Available_Income)) echo $Available_Income ?>"  onKeyDown="pressKey()" onMouseDown="pressKey()"  style="width:100px; font-weight:bold; font-size:11px; color:#373737;"/></td>
      </tr>
      <tr>
        <td colspan="2" class="formtext"  style="font-weight:bold; padding-left:153px;"  ><span style='font-size:11px; font-weight:bold;color:#373737;font-Family:Verdana;'><?php if(isset($Available_Income)) echo "Rs. ".convert_number($Available_Income)." ."; ?></span></td>
        </tr>
      <tr>
        <td height="35" class="formtext" style="font-weight:bold;" >Duration of Loan </td>
        <td><input type="text" name="Duration_of_Loan" id="Duration_of_Loan" tabindex="3" value="<?php if(isset($Duration_of_Loan)) echo $Duration_of_Loan ?>" onKeyUp="intOnly(this);" onKeyDown="intOnly(this);" style="width:100px; font-weight:bold; font-size:11px; color:#373737;"/> <b>Years</b></td>
      </tr>
      <tr>
        <td height="35" class="formtext" style="font-weight:bold;" >Interest Rate</td>
        <td><input type="text" name="Interest_Rate" id="Interest_Rate" tabindex="4" value="<?php if(isset($Interest_Rate)) echo $Interest_Rate ?>" style="width:100px; font-weight:bold; font-size:11px; color:#373737;"/> <b>In Percentage</b></td>
      </tr>
      <tr>
        <td height="45" colspan="2" align="left" valign="middle" style="padding-left:153px;"> 
            <input name="submit" type="submit" style="width:100px;" class="btnclr" value="Calculate" /></td>
      </tr>
      <tr>
        <td height="35" class="formtext" style="font-weight:bold; ">EMI</td>
        <td align="left"><input type="text" name="EMI" id="EMI"  value="<?php if(isset($EMI)) echo round($EMI); ?>"  onKeyDown="pressKey()" onMouseDown="pressKey()" readonly style="color:#792216; font-size:12px; font-weight:bold; font-family:Verdana; width:100px;"/> </td>
      </tr>
      <tr>
        <td  colspan="2" class="formtext" style="font-weight:bold; padding-left:153px; "><span style='font-size:12px; font-weight:bold;color:#792216;font-Family:Verdana;'><?php if(isset($EMI)) echo "Rs. ".convert_number($EMI)." ."; ?></span></td>
        </tr>
      <tr>
        <td height="35" valign="top" class="formtext" style="font-weight:bold; padding-top:8px;">Eligible Loan Amount</td>
        <td align="left"><input type="text" name="Eligible_Loan_Amount" id="Eligible_Loan_Amount"  value="<?php if(isset($EligibleAmount)) echo round($EligibleAmount) ?>"  onKeyDown="pressKey()" onMouseDown="pressKey()" readonly style="color:#792216; font-size:12px; font-weight:bold; font-family:Verdana; width:100px;" /></td> 
      </tr>
      <tr>
        <td colspan="2" valign="top" class="formtext" style="font-weight:bold; padding-left:153px;"><span style='font-size:12px; font-weight:bold;color:#792216;font-Family:Verdana;'><?php if(isset($EligibleAmount)) echo "Rs. ".convert_number($EligibleAmount)." ."; ?></span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
          <td width="458" height="26"><img src="new-images/apl-bt.gif" width="458" height="26" /></td>
  </tr>
</table>

      </form>
 <b>Note:-</b><br>
Following are eligible to 


<a href="http://www.deal4loans.com/apply-home-loans.php">apply for a Home Loan</a> :<br> 
•	Salaried individuals<br> 
•	Self employed professionals/businessmen <br>
<br>
You can include your spouse/parents/children as co-applicant if you require higher eligibility subject to maximum of three applicants. <br />
<br />
<b>Monthly Income</b> <br />
The income that we get in hand on month to month bases is said as Monthly Income. While taking a 


<a href="http://www.deal4loans.com/home-loans.php">Home Loan</a>  the Bank initially calculate on the bases of net income that is left in our hand after deduction of all other emi’s.<br />
<br />
<b> Other EMI<br />
</b> Other Emi (Equally monthly installment) is the emi that we are paying to for any other 


<a href="http://www.deal4loans.com/">Loan</a> .<br />
<br />
<b> Available Income<br />
</b> The income that is left in our hand after deduction of any emi amount that we are paying for any kind of loan. Your 


<a href="http://www.deal4loans.com/home-loan-calculator.php">Home Loan Eligibility Calculator</a>  will be calculated after deduction of the EMI’s that you are paying.<br />
<br />
<b> Duration of Loan (Years)<br />
</b> It’s one of the most important factors that one should keep in mind while taking loan. It refers to the no. of years for which the loan has to be taken. Longer the tenure higher will be the interest paid and lower will be amount of EMI to be paid and vice-a-versa. It is one of the parameters which helps in comparing the EMIs from different banks keeping it constant for relationship and easing the judgment.<br />
<br />
<b> Interest Rate</b> (in percentage)<br /> 
Today there are many lenders in the market. Every bank is offering loans whether it’s a nationalized bank, private bank or foreign bank each of them is there in the show. Every bank offers different rate of interest according to the profile of the customer. So, before finalizing a deal one should consider deals from various banks and than come to a conclusion. And aware of the fact that some people might mislead you by charging high rate of interest at reducing rate and might inform the same at flat rate of interest. So, its always advisable to check full detail with the banks and do better comparison in respect of EMIs , Tenure and 


<a href="http://www.deal4loans.com/home-loans-interest-rates.php">Interest Rates</a>  and keeping tenure as constant with all the banks will ease your comparison and will result in better analysis, finally leading to a prudent decision.

<br />
<br />
<b> EMI</b><br />
 EMI stands for equally monthly installment; you need to pay a particular amount for the Home loan that you have taken.<br />
 <br />
 <b> Eligible Loan Amount</b><br />
  The net loan amount for which you are eligible for your Home loan is said as Eligible Loan Amount. The loan amount that a Bank can sanction you.
  	<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="new-images/top.gif"/></a></div>
	  </div> 
</div>
</div>
<? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right-new1.php';
  }
  ?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>

