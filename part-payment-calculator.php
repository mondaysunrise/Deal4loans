<?php
require 'scripts/session_check.php';
require 'scripts/functions.php';
require 'scripts/db_init.php';

$loanAmt = $_POST['loanAmt'];
$tenure = $_POST['tenure'];
$interest_Rate = $_POST['interest_Rate'];
$partPayment = $_POST['partPayment'];
$installment = $_POST['installment'];
$partPaymentTime = $_POST['partPaymentTime'];
		
		
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
<title>part payment of personal loan calculator | Save on Foreclosure</title>
<meta name="keywords" content="foreclosure calculator, par payment calculator, savings calculator, home loan part payment calculator, calculator for part payment">
<meta name="Description" content="loan partpayment calculator helps you to find savings on interest after paying Lump Sump Repayment in home loan, personal loan with deal4loans.com">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
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
  <div  class="common-bread-crumb"><a href="index.php">Home</a> > </a> <span>Loan Amortization Calculator </span></div>
  <div class="left-wrapper">
    <h1 class="pl-h1">How does Part Payment Help?</h1>
    <div style="clear:both;"></div>
    <div style="clear:both; height:15px;"></div>
    <p> Calculators are used in financial industries especially for finding  exact amount by the banks or financial institutions. The loan calculators are  uniquely designed for involving various terms like period of the loan, interest  rate, total amount and so on. It then calculates the monthly installment or the  balance payment for the sake of the customer. Almost all authorized lenders use  the repayment and part payment calculator to avail the exact details to their  borrowers. </p>
    <div style="clear:both; height:15px;"></div>
    <form name='formamortization' action='' method='post' onsubmit="return checkinsurance();">
      <div class="form_new_box">
        <table width="100%" border="0" align="right" cellpadding="0" cellspacing="4" >
          <tr>
            <td width="45%" height="35" align="left" valign="middle" class="form_new_text">Loan Amount</td>
            <td width="55%"><input name='loanAmt' type='text' class="d4l-input" id='loanAmt' onBlur="getDigitToWords('loanAmt','formatedIncome','wordIncome');" onchange='calculateamortization(document.formamortization);' onKeyPress="intOnly(this); getDigitToWords('loanAmt','formatedIncome','wordIncome');"    onKeyUp="intOnly(this); getDigitToWords('loanAmt','formatedIncome','wordIncome');" value='<?php echo $loanAmt; ?>' maxlength='9'/>
              <br>
              <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#21405f;'></span><span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#21405f; text-transform: capitalize;'></span></td>
          </tr>
          <tr>
            <td height="35" align="left" valign="middle" class="form_new_text"> Tenure (in Years)</td>
            <td class="text" style="color:#FFF; font-size:13px; "><select name="tenure" class="d4l-select" >
                <option value="">Select</option>
                <?php 
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
              </select></td>
          </tr>
          <tr>
            <td height="35" align="left" valign="middle" class="form_new_text"  >Interest Rate</td>
            <td class="form_new_text" ><input name='interest_Rate' id="interest_Rate" type='text' class="d4l-input"   onkeypress = 'intOnly(this)' value='<?php echo $interest_Rate; ?>' maxlength='5' />
              %per annum</td>
          </tr>
          <tr>
            <td height="35" align="left" valign="middle" class="form_new_text">Part Payment Amount</td>
            <td><input name='partPayment' id="partPayment" type='text' class="d4l-input" onKeyPress="intOnly(this); getDigitToWords('partPayment','formatedIncome1','wordIncome1');" onKeyUp="intOnly(this); getDigitToWords('partPayment','formatedIncome1','wordIncome1');" maxlength='10'  value='<?php echo $partPayment; ?>' />
              <br>
              <span id='formatedIncome1' style='font-size:11px; font-weight:normal; color:#21405f;'></span><span id='wordIncome1' style='font-size:11px; font-weight:normal; color:#21405f;text-transform: capitalize;'></span></td>
          </tr>
          <tr>
            <td height="35" align="left" valign="middle" class="form_new_text"  >After how many Emi you want to make part payment</td>
            <td class="form_new_text" style="font-weight:normal;"><select name="partPaymentTime" class="d4l-select" >
                <option value="">Select</option>
                <?php 
		for($k=1;$k<=60;$k++)
		{
			$selected = "";
			if($k==$partPaymentTime)
			{
				$selected = "selected";
			}
			echo "<option value='".$k."' ".$selected.">".$k."</option>";
		}
		
		?>
              </select></td>
          </tr>
          <tr>
            <td height="35" colspan="2" align="center" valign="middle"><input name="button" style="margin:0px 0px 0px 57px;" type="submit" class="pl-get-quotebtn" value="Calculate" />
          </tr>
        </table>
      </div>
    </form>
    <div style="clear:both;"></div>
    <div>
      <?php

	if(isset($_POST['button']))
	{
		$loanAmt = $_POST['loanAmt'];
		$tenure = $_POST['tenure'];
		$interest_Rate = $_POST['interest_Rate'];
//		$existingEmi = $_POST['existingEmi'];
		$partPayment = $_POST['partPayment'];		
		$partPaymentTime = $_POST['partPaymentTime'];
		$interestRate = $interest_Rate/100;
		$installment = $partPaymentTime;
		$loanAmountLeft = $loanAmt - $partPayment;
		$newTenure = ($tenure * 12) - $partPaymentTime;
				
		$Balance = $loanAmt;
		$MonthlyInterest = $interestRate/12;
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
		$PeriodicPayment = round($PeriodicPayment,0);

		$intCalc1 = 1+ $interestRate1 / $PaymentsPerYear;
		$PeriodicPayment1 = $Balance * pow($intCalc1,$TotalPayments) * ($intCalc1 - 1)/ (pow($intCalc1,$TotalPayments)-1);
		$PeriodicPayment1 = round($PeriodicPayment,0);
		$paymentNumber.", ".$PeriodicPayment.", ".$Balance.", ".$MonthlyInterest.", ".$paymentCount;
		$pendingAmount_1 = amortizationTable($paymentNumber, $PeriodicPayment, $Balance, $MonthlyInterest, $paymentCount);
	//	$pendingAmount_2 = amortizationTable($paymentNumber, $PeriodicPayment1, $Balance, $MonthlyInterest1, $paymentCount);
	
		$firstAmount = round(($pendingAmount_1 *5/100 ) + $pendingAmount_1);
		$secondAmount = round(($pendingAmount_2 *0/100) + $pendingAmount_2);
		$difference = $firstAmount - $secondAmount;
		//	echo "Difference - ".$difference;

		$loanAmountLeft = $pendingAmount_1 - $partPayment;
		
		$newPeriodicPayment = $loanAmountLeft *pow($intCalc,$TotalPayments) * ($intCalc - 1)/ (pow($intCalc,$TotalPayments)-1);
		$newPeriodicPayment = round($newPeriodicPayment,0);
		
		$totalPayments = $tenure * 12 * $PeriodicPayment;
		$afterPartPaymentPayment = ($PeriodicPayment * $installment) + $partPayment + ($newPeriodicPayment * $newTenure);
		$interestSaved = $totalPayments - $afterPartPaymentPayment;
		
  if($PeriodicPayment>1)
  {
   ?>
      <div class="form_new_calulate">
        <table width="84%"  style="margin:10px 5px 5px 24px" bgcolor="#f0cc86">
          <tr>
            <td><table width="100%" border="0" cellpadding="3" cellspacing="1">
                <tr>
                  <td bgcolor="#FFFFFF" class="form_new_text" style="font-size:15px;" colspan="2" align="center">Reduce EMI</td>
                </tr>
                <tr>
                  <td width="247" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;">Total Payment</td>
                  <td width="201" bgcolor="#FFFFFF" class="form_new_text" style="font-size:15px;">Rs. <?php echo $totalPayments ; ?></td>
                </tr>
                <tr>
                  <td width="247" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;">Payment After Part Payment</td>
                  <td width="201" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;">Rs. <?php echo $afterPartPaymentPayment ; ?></td>
                </tr>
                <tr>
                  <td width="247" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;">Interest Saved</td>
                  <td width="201" bgcolor="#FFFFFF" class="form_new_text" style="font-size:15px;">Rs. <?php echo $interestSaved ; ?></td>
                </tr>
                <tr>
                  <td width="247" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;">New Loan Amount</td>
                  <td width="201" bgcolor="#FFFFFF" class="form_new_text" style="font-size:15px;">Rs. <?php echo $loanAmountLeft ; ?></td>
                </tr>
                <tr>
                  <td width="247" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;">Current EMI</td>
                  <td width="201" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;">Rs. <?php echo $PeriodicPayment ; ?></td>
                </tr>
                <tr>
                  <td width="247" bgcolor="#FFFFFF" class="form_new_text" style="  font-size:15px;">New Reduced EMI</td>
                  <td width="201" bgcolor="#FFFFFF" class="form_new_text" style="font-size:15px;">Rs. <?php echo $newPeriodicPayment ; ?></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div>
      <div style="clear:both;"></div>
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
    </div>
    <div style="clear:both;"></div>
    <div class="tbl_txt">
      <p><strong>What is meant by Part  Payment?</strong><br />
        It has been seen that when people take loans, they accept to  pay the total payment with the rate of interest that is applicable on that  amount. However, with normal repayment policies people pay off only the  interest on mortgage, not the amount that has been taken as the loan. Thus,  there is another option to use their investments at the end to cover up  remaining balance. However, not all customers own investments or properties for  such conversion. Thus, this option serves as a working solution for only few  customers. <br />
        For all other customers of loans and mortgages, part payment  is a great option. Here, the monthly installments are divided into the interest  payment and mortgage repayment. The parts can be arranged as per your choice.  You can devote a larger part for the interest, and a smaller amount for the  payment of loan. These part payments do not assure that the whole amount of  loan will be paid at the end of tenure; however, they make at least a part of  repayment on their account. <br />
        <br />
        <strong>Part Payment  Calculator</strong><br />
        Part payment calculator carries out the measurement of the  monthly installment to be made with the bank, along with interest rate and loan  amount. It takes into account various things like the loan amount, minimum  assured period for the payment, interest rate, and future predictions and so  on.  These payments are arranged by the  banks and financial institutions. So, if you want to apply for the part payment  system, then you first have to intimate your lending bank in advance. Thereby,  the lender will consider your request and start the scheme on your account. </p>
      Part  time calculators are also available on various websites on Internet. You have  to fill up your details in the installed software under the name of part time  calculator. It will give you an exact picture of the amount you will have to  pay as monthly installment and advantage you will obtain with this scheme. </div>
    <div style="clear:both;"></div>
  </div>
  <div class="right-panel">
    <?php include "right-widget.php"; ?>
  </div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>