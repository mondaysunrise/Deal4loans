<?php
require 'scripts/session_check.php';
require 'scripts/functions.php';
require 'scripts/db_init.php';

$loanAmt = $_POST['loanAmt'];
$tenure = $_POST['tenure'];
$interestRate = $_POST['interestRate'];
$interestRate1 = $_POST['interestRate1'];
$installment = $_POST['installment'];
		
		
function amortizationTable($pNum,$periodicPayment,$balance, $monthlyInterest,$paymentCount) {
	$paymentInterest = round($balance*$monthlyInterest,2);
	$paymentPrincipal = round($periodicPayment-$paymentInterest,2);
	$newBalance = round($balance-$paymentPrincipal,2);
	if($newBalance<$paymentPrincipal)
	{
		$newBalance = 0;
	}
	
	if($pNum==$paymentCount)
	{
		 $returnBalance = round($newBalance);
	}
	
	if($newBalance > 0)
	{
		if($pNum==$paymentCount)
		{
			return $returnBalance;	
			exit();
		}
		$pNum++;
		return amortizationTable($pNum,$periodicPayment,$newBalance, $monthlyInterest, $paymentCount);
	}
	else
	{
		return $returnBalance;	
		exit();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prepayment Calculator for Personal, Home, Car Loan India</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="keywords" content="prepayment of personal loan, prepayment calculator, prepayment calculator home loan, loan prepayment calculator, prepayment penalty calculator, loan prepayment calculator">
<meta name="Description" content="Loan Prepayment Calculator Helps you to find How much you can save with NIL foreclosure between two banks online with deal4loans.com">
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
<script language="javascript">
function checkinsurance()
{
	if(document.formamortization.loanAmt.value=="")
	{
		alert("Please fill loan Amount.");
		document.formamortization.loanAmt.focus();
		return false;
	}
	if (isNaN(document.formamortization.loanAmt.value))
	{
		alert("Please fill loan Amount in numeric only.");
		document.formamortization.loanAmt.focus();
		return false;
	}
	if(document.formamortization.tenure.value=="")
	{
		alert("Please fill Tenure.");
		document.formamortization.tenure.focus();
		return false;
	}
	if (isNaN(document.formamortization.tenure.value))
	{
		alert("Please fill Tenure in numeric only.");
		document.formamortization.tenure.focus();
		return false;
	}

	if(document.formamortization.interestRate.value=="")
	{
		alert("Please fill Interest Rate.");
		document.formamortization.interestRate.focus();
		return false;
	}
	if (isNaN(document.formamortization.interestRate.value))
	{
		alert("Please fill Interest Rate in numeric only.");
		document.formamortization.interestRate.focus();
		return false;
	}
	
	if (document.formamortization.installmentMonth.selectedIndex==0)
	{
		alert("Please enter Installment Month");
		document.formamortization.query_type.focus();
		return false;
	}
	
	if (document.formamortization.installmentYear.selectedIndex==0)
	{
		alert("Please enter Installment Year");
		document.formamortization.installmentYear.focus();
		return false;
	}


	return true;
	
}
</script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="d4l_inner_wrapper">
<div style="margin-top:70px;"></div>
<div  class="common-bread-crumb"><a href="index.php">Home</a> > </a> <span> Pre Payment Benefit </span></div>
<div class="left-wrapper">
<h1 class="pl-h1">Pre Payment Calculator</h1>
 <div style="clear:both;"></div>
  <p>Many borrowers tend to take the loans to buy a home or to purchase a car. Some even avail loans for fulfilling personal needs or to meet the medical emergency requirements. Some avail a loan to support their higher/technical education in India or abroad. All of these loans have a perfect and well-planned schedule for repayment along with the interest rates and even penalties. If the customer has applied for the amortization of the loan, then the lender also allows converting a part of repayment instalment to cover up the principal amount. However, some borrowers opt directly for the prepayment that is, paying off the full amount of loan in a lump sum amount at one time. Reasons for such prepayment could be:</p>
 
  <ul type="disc" style="margin-left:40px;">
    <li>Some borrowers wish to       take advantage of the lower interest rates that are available with other       lenders. So, it is observed that they arrange for refinancing loans. They       borrow with the lower interest rates to pay off the previous debts that       would require them to pay more. </li>
    <li>Other payers prefer to buy       out their properties in order to pay off the current debts and start a       fresh. This type of repayment is a rare phenomenon, where the borrower       needs to own a property which shall be of equal value as the loan amount. </li>
  </ul>

<div style="clear:both; height:15px;"></div>


<form name='formamortization' action='pre-payment-calculator.php' method='post' onsubmit="return checkinsurance();">
  <div class="form_new_box"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="4" >
      
      <tr>
        <td width="42%" height="37" align="left" valign="middle" class="form_new_text"  >Loan Amount</td>
        <td width="58%"><input name='loanAmt' type='text' class="d4l-input" id='loanAmt' onBlur="getDigitToWords('loanAmt','formatedIncome','wordIncome');" onchange='calculateamortization(document.formamortization);' onKeyPress="intOnly(this); getDigitToWords('loanAmt','formatedIncome','wordIncome');" onKeyUp="intOnly(this); getDigitToWords('loanAmt','formatedIncome','wordIncome');" value='<?php echo $loanAmt ; ?>' maxlength='9' />
	<br> 
	<span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#21405f;'></span><span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#21405f;text-transform: capitalize;'></span>
              </td>
      </tr>
      
      
      <tr>
        <td height="37" align="left" valign="middle" class="form_new_text"> Tenure </td>
        <td class="form_new_text">
                <select name="tenure" class="d4l-select" >
        <option value="">Select</option>
        <?php 
		$selected = "";
		for($k=1;$k<=5;$k++)
		{
			$selected = "";
			if($k==$tenure)
			{
				$selected = "selected";
			}
			echo "<option value='".$k."' ".$selected.">".$k."</option>";
		}
		
		?>
        </select> (in Years) </td>
      </tr>
      
      <tr>
        <td height="37" align="left" valign="middle" class="form_new_text"  >Interest Rate  - Bank A<br /><span style="font-size:10px; font-weight:normal;">(Without Zero Pre Payment)</span></td>
        <td class="form_new_text" ><input name='interestRate' type='text' class="d4l-input"   onkeypress = 'return isNumberKey(event,this,1);' value='<?php echo $interestRate ; ?>' maxlength='5' />
              %per annum</td>
      </tr>  <tr>
        <td height="23"  align="left" valign="middle" class="form_new_text"  >Pre-payment Charge - Bank A</td>
        <td class="form_new_text">5%</td>
      </tr>
       <tr>
        <td height="37" align="left" valign="middle" class="form_new_text" >Interest Rate -  Bank  B<br /><span style="font-size:10px; font-weight:normal;">(With Zero Pre Payment)</span></td>
        <td class="form_new_text" ><input name='interestRate1' type='text' class="d4l-input" onkeypress = 'return isNumberKey(event,this,1);' value='<?php echo $interestRate1 ; ?>' maxlength='5' />
              %per annum</td>
      </tr>
            <tr>
        <td height="23" align="left" valign="middle" class="form_new_text" >Pre-payment Charge - Bank B</td> 
        <td class="form_new_text">NIL</td>
      </tr>
      <tr>
        <td height="37" align="left" valign="middle" class="form_new_text">After how many EMIs you want to pre pay</td>
        <td>
        <select name="installment" class="d4l-select" >
        <option value="">Select</option>
        <?php
		$selected = ""; 
		for($k=1;$k<=59;$k++)
		{
					$selected = "";
			if($k==$tenure)
			{
				$selected = "selected";
			}
			echo "<option value='".$k."' ".$selected.">".$k."</option>";
		}
		
		?>
        </select>
        <span class="form_new_text">(in Months)</span>        </td>
      </tr>
           
      <tr><td>&nbsp;</td>
        <td height="37" valign="middle">
        <input name="button" type="submit" class="pl-get-quotebtn" value="Calculate" /> 
        <!--<input name="button" type="image"  value="Calculate"  src="d4limages/calculate-btn.jpg"/> --> <input id='tmp' type='hidden' value=''></td>
        </tr>
      
      
    </table>
</div>
      </form>
      <div style="clear:both;"></div>
<div>
<?php
//print_r($_POST);
//Array ( [loanAmt] => 10000 [tenure] => 12 [interestRate] => 14 [interestRate1] => 15 [installment] => 10 [button] => Calculate )
	if(isset($_POST['button']))
	{
		$loanAmt = $_POST['loanAmt'];
		$tenure = $_POST['tenure'];
		$interestRate = $_POST['interestRate']/100;
		$interestRate1 = $_POST['interestRate1']/100;
		$installment = $_POST['installment'];
		
		$Balance = $loanAmt;
		$MonthlyInterest = $interestRate/12;
		$MonthlyInterest1 = $interestRate1/12;
		$TermLength = $tenure;
		$PaymentsPerYear = 12;
		$paymentNumber = 1;
		$paymentCount = $installment - 1;
		//	echo "<br>";
		//	echo "<br> TotalPayments - ";
		 $TotalPayments = $TermLength * $PaymentsPerYear;
		//	echo "<br>";
		$intCalc = 1+ $interestRate / $PaymentsPerYear;
		$PeriodicPayment = $Balance *pow($intCalc,$TotalPayments) * ($intCalc - 1)/ (pow($intCalc,$TotalPayments)-1);
		$PeriodicPayment = round($PeriodicPayment,2);

		$intCalc1 = 1+ $interestRate1 / $PaymentsPerYear;
		$PeriodicPayment1 = $Balance * pow($intCalc1,$TotalPayments) * ($intCalc1 - 1)/ (pow($intCalc1,$TotalPayments)-1);
		$PeriodicPayment1 = round($PeriodicPayment,2);
	//	echo "<br>";		echo "<br>";
	//	echo "paymentNumber - ".$paymentNumber."- PeriodicPayment - ".$PeriodicPayment."- Balance-".$Balance."-MonthlyInterest-".$MonthlyInterest."-paymentCount-".$paymentCount;
//	echo amortizationTable($paymentNumber, $PeriodicPayment, $Balance, $MonthlyInterest, $paymentCount);
		$pendingAmount_1 = amortizationTable($paymentNumber, $PeriodicPayment, $Balance, $MonthlyInterest, $paymentCount);
		$pendingAmount_2 = amortizationTable($paymentNumber, $PeriodicPayment1, $Balance, $MonthlyInterest1, $paymentCount);
		
	//	
	//	echo "pendingAmount_1 - ". $pendingAmount_1;
	//	echo "<br>";
	//	echo "pendingAmount_2 - ". $pendingAmount_2;
	///	echo "<br>";

		$firstAmount = round(($pendingAmount_1 *5/100 ) + $pendingAmount_1);
		$secondAmount = round(($pendingAmount_2 *0/100) + $pendingAmount_2);
		$difference = $firstAmount - $secondAmount;
	//	echo "Difference - ".$difference;
  if($difference>0)
  {
   ?>

  <div class="form_new_calulate">
    <table width="600px"  bgcolor="#CCCCCC">
  <tr>
    <td><table width="100%" border="0" align="right" cellpadding="3" cellspacing="1" style="width:600px; padding:0px;  border-radius:7px 7px 7px 7px;
 ">
   <tr><td width="234" bgcolor="#FFFFFF"></td><td width="208" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;">BANK A</td><td width="118" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;"> BANK B</td></tr>
   <tr><td bgcolor="#FFFFFF" class="form_new_text" >Principal Outstanding<br />(as on Foreclosure Date)</td><td bgcolor="#FFFFFF" class="form_new_text" >Rs. <?php echo $pendingAmount_1; ?></td><td bgcolor="#FFFFFF" class="form_new_text" >Rs. <?php echo $pendingAmount_2; ?></td></tr>
   <tr>
     <td bgcolor="#FFFFFF" class="form_new_text">Foreclosure Charges</td>
     <td bgcolor="#FFFFFF" class="form_new_text" >5%</td>
     <td bgcolor="#FFFFFF" class="form_new_text" >NIL</td>
   </tr>
   <tr><td bgcolor="#FFFFFF" class="form_new_text">Total Amount to be Paid</td><td bgcolor="#FFFFFF" class="form_new_text" >Rs. <?php echo $firstAmount; ?></td><td bgcolor="#FFFFFF" class="form_new_text" >Rs. <?php echo $secondAmount; ?><br /></td></tr>
   
   </table></td>
  </tr>
</table>
 </div>

   <div style="clear:both;"></div>
   <div class="form_new_save">You<span style="font-size:21px; font-weight:bold;"> Save</span> Rs. <?php echo $difference?> with NIL foreclosure with Bank B.</div>
 <?php
}
else
{
?>
<div style="clear:both;"></div>
<div class="form_new_save">Foreclosure is not beneficial for you at this stage.</div>
<div style="clear:both;"></div>
<?php
}  
?>    
   <?php
    }
?>
</div>  <div style="clear:both;"></div>
   <div class="tbl_txt" >
     <p style="text-align:justify">Prepayment has its advantages and disadvantages too. There are several advantages of making prepayment as freedom from market risks, benefit from lower interest rates and most importantly completion and payment of loan obtained. However, the prepayment is also a subject to risks, especially where mortgage investments are involved to make payments. Also, some banks and financial institutions levy prepayment charges to the borrowers to compensate for finishing the deal early. There are some other costs also involved, which may prove harmful for the finances of the prepaying borrowers.</p>

     <p style="text-align:justify; margin-top:15px;">Prepayment calculators are based on the basic model of  calculating the installments for the customers. However, the prepayment  calculator would generate full amount of the loan balanced and to be repaid at  a given date, with interest payments. This type of calculator would take into  consideration the following things such as:</p>
     <ul type="disc" style="margin-left:40px;">
       <li>Balanced Loan: the amount to be repaid at the date of closing the deal</li>
       <li>Interest rate at which the loan was obtained</li>
       <li>The maximum year of tenure for which the deal was made</li>
       <li>Any costs or prepayment charges involved in this process</li>
       <li>Amortization schedule or part paid amount (if considerable)</li>
     </ul>
     <p>The calculator would measure all these factors and inform  the total amount that the borrower has to pay in the process of prepayment to  the lender. </p>
   </div>
   <div style="clear:both;"></div>
</div> 

<div class="right-panel">
    <?php include "right-widget.php"; ?>
  </div>

</div>
<?php 
#include "footer1.php"; 
include("footer_sub_menu.php");
?>
</body>
</html>