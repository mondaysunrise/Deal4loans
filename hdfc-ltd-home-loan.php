<?php
//ob_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'getlistofeligiblebidders.php';
require 'scripts/home_loan_eligibility_function.php';

function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
		if($pKey==$key)
		return $value;
	
	return "";
}

	
function DetermineAgeGETDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}


	
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Type_Loan=$_REQUEST['Type_Loan'];
		$ProductValue = $_REQUEST['ProductValue'];	
		$Day=$_REQUEST['day'];
		$Month=$_REQUEST['month'];
		$Year=$_REQUEST['year'];
		$DOB=$Year."-".$Month."-".$Day;
		$Pincode = $_REQUEST['Pincode'];
		$Employment_Status = $_REQUEST['Employment_Status'];
		$Company_Name = $_REQUEST['Company_Name'];
		$Property_Identified = $_REQUEST['Property_Identified'];
		$Property_Loc = $_REQUEST['Property_Loc'];
		$Loan_Time = $_REQUEST['Loan_Time'];
		$Phone = $_REQUEST['Phone'];
		$City = $_REQUEST['City'];
		$Net_Salary = $_REQUEST['Net_Salary'];
		$Net_Salary = $_POST['Net_Salary'];
		$monthly_income = ($Net_Salary /12);
		$obligations = $_POST['obligations'];
		$co_appli = $_POST['co_appli'];
		$co_name = $_POST['co_name'];
		$dob_arr_co[] = $_POST['co_year'];
		$dob_arr_co[] = $_POST['co_month'];
		$dob_arr_co[] = $_POST['co_day'];
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = $_POST['co_monthly_income'];
		$co_obligations = $_POST['co_obligations'];
		$property_value = $_POST['Property_Value'];
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$netAmount=($getnetAmount - $total_obligation);
		$currentyear=date('Y');
		$age=$currentyear-$Year;

		$getDOB = str_replace("-","", $DOB);
		$age = DetermineAgeGETDOB($getDOB);
		//echo $age."<br>";
		$agecalc="50";
		$exactage = $agecalc- $age;
		//echo $exactage."<br>";
		//get inflation amount
		$getinflation = $Net_Salary *(5/100);
		$getinflationage = $getinflation * $exactage;
		$getexactvalue = $getinflationage + $Net_Salary;
		$getexactvaluemonthly = $getexactvalue/12;

				
		$crap = " ".$Property_Identified." ".$Property_Loc." ".$company." ".$City_Other." ".$Primary_Acc." ".$Descr." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		
		//exit();
			if($crapValue=="Put")
			{
	
				
				if (($Type_Loan=="Req_Loan_Home") || ($product=="HomeLoan"))
					{
					
																
						getEligibleBidders("home","$City","$Mobile");
						
						$DataArray = array('Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$total_obligation, 'DOB'=>$DOB, 'Residence_Address'=>$Residence_Address, 'Pincode'=>$Pincode, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Loan_Time'=>$Loan_Time, 'Is_Valid'=>$Is_Valid, 'Budget'=>$budget);
						$wherecondition = "(RequestID=".$ProductValue.")";
						Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
						if($Net_Salary>=200000)
						{
							$productname = "hlsalaryclause";
						}
						else
						{
						$productname = "HomeLoan";
						}

						
				
					}
			
				
			}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
		
	}//$_POST
	$_SESSION['ProductValueHL'] = $ProductValue;	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>HDFC Ltd Home Loan | Interest Rates <?php echo DATE('F'); ?> 2017 | Documents | EMI</title>
<meta name="Keywords" content="HDFC Home Loan, hdfc ltd home loan, Apply HDFC Home Loan, HDFC Home Loan Interest Rates, Documents for hdfc Home Loan">
<meta name="description" content="HDFC Home Loan Interest rates: Instant Apply for HDFC home loan at low EMI of Rs.779/lakh. Check Documents ✓ Eligibility quotes online ✓ E-approval ✓ HDFC home loans with deal4loans.com.">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<link rel="canonical" href="http://www.deal4loans.com/hdfc-ltd-home-loan.php"/>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div  class="hl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="d4l_inner_wrapper">
    <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">
      <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="home-loan-banks.php">Compare Home loan Banks</a> > <span> HDFC Ltd Home Loan</span></div>
      <h1 class="hl-h1"><img src="bankslogo/HDFC-Ltd-Home-Loan.jpg" alt="HDFC Ltd Home Loan" style="vertical-align:top;" /> HDFC Ltd Home Loan</h1>
    </div>
  </div>
  <div>HDFC Ltd home loans available at affordable interest rates, lowest EMI, High Eligibility & low processing charges with easy procedure of home loan. HDFC Ltd is the biggest private lender in home loan segment with over 5.1 million home loan customers. HDFC Ltd extensive distribution network of 378 interconnected offices (including 103 offices of HDFC Sales) with outreach programs to several locations, reaching out to over 2,400 towns and cities all over India. <br />
   <br />
<strong>Key Highlights of HDFC Ltd Home Loan</strong>
    <table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td bgcolor="#eaeaea"><table border="0" cellspacing="1" cellpadding="0" width="100%">
  <tr>
    <td height="22" colspan="2" bgcolor="#FFFFFF">For women* upto 75 Lakhs</td>
    <td height="22" colspan="2" bgcolor="#FFFFFF">8.35% - 8.85%</td>
  </tr>
  <tr>
    <td height="22" colspan="2" bgcolor="#FFFFFF">For Others* upto 75 Lakhs</td>
    <td height="22" colspan="2" bgcolor="#FFFFFF">8.40% - 8.90%</td>
  </tr>
   <tr>
    <td height="22" colspan="2" bgcolor="#FFFFFF">For Women* above 75 Lakhs</td>
    <td height="22" colspan="2" bgcolor="#FFFFFF">8.40% - 8.90%</td>
  </tr>
  <tr>
    <td height="22" colspan="2" bgcolor="#FFFFFF">For Others* above 75 Lakh</td>
    <td height="22" colspan="2" bgcolor="#FFFFFF">8.45% - 8.95%</td>
  </tr>

   <tr>
    <td colspan="2" bgcolor="#FFFFFF" style="height: 22px">Lowest EMI per 1 Lakh</td>
    <td colspan="2" bgcolor="#FFFFFF" style="height: 22px">Rs.758</td>
  </tr>

  <!--<tr>
    <td height="22" colspan="2" bgcolor="#FFFFFF">Min. EMI per 1 Lakh</td>
    <td height="22" colspan="2" bgcolor="#FFFFFF">Rs.812 - Rs.815</td>
  </tr>-->
  
</table></td>
  </tr>
</table>
<br />
  </div>
  <div>
    <?php 
$newsource="HD SEO 1";
$subjectLine="Apply Online for HDFC Ltd Home Loan Instantly";
//include "home_loan_form1.php";
include "home-loans-widget.php";
?>
  </div>
  <br /><br />
  <table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td bgcolor="#eaeaea"><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td height="22" bgcolor="#FFFFFF">RPLR Rate</td>
    <td height="22" bgcolor="#FFFFFF">16.15%</td>
    
  </tr>
  <tr>
    <td height="22" bgcolor="#FFFFFF">Repayment period</td>
    <td height="22" bgcolor="#FFFFFF">5 - 30 Years</td>
    
  </tr>
  <tr>
    <td height="22" bgcolor="#FFFFFF">Max Loan amount upto 30 Lakh    property value</td>
    <td height="22" bgcolor="#FFFFFF">27 Lakh</td>
    
  </tr>
  <tr>
    <td height="22" bgcolor="#FFFFFF">Min. Income for Salaried</td>
    <td height="22" bgcolor="#FFFFFF">12000 p.m</td>
    
  </tr>

  
  <tr>
<td height="22" bgcolor="#FFFFFF"><strong>Base Rate</strong></td>
    <td height="22" bgcolor="#FFFFFF">9.30%</td>
    </tr>
    
    <tr>
  <td height="22" bgcolor="#FFFFFF"><p>Processing Fees</td>
    <td height="22" bgcolor="#FFFFFF"><p>1.25% or Max. Rs.3000</td>  
    </tr>
    
    <tr>
  <td height="22" bgcolor="#FFFFFF">Max. loan amount abv 30 lakh</td>
    <td height="22" bgcolor="#FFFFFF">75 - 80%</td>  
    </tr>
    <tr>
    <td height="22" bgcolor="#FFFFFF">Min. Income for Self Employed</td>
    <td height="22" bgcolor="#FFFFFF">16500 p.m</td>
    </tr>
</table></td>
  </tr>
</table>
  <div>
    <h3>Who Can Apply for HDFC Ltd Home Loans?</h3>
    You can apply individually or jointly for HDFC Ltd Home Loans. All proposed owners of the property will have to be co-applicants. However, all co-applicants need not be co-owners. Generally co-applicants are close family members.
  
  <h3>HDFC Ltd Home Loan Interest Rates 2017: (Last updated as on 09 Oct 2017)</h3>
  Flexible / Floating home loan interest rates for Salaried:
<table border="1" width="100%">
<tbody>
<tr>
<td><strong>Loan amount</strong></td>
<td><strong>Interest Rates</strong></td>
</tr>
<tr>
<td>Loan amount upto 75 Lakhs</td>
<td>8.35%(Women) - 8.40%(Others)</td>
</tr>
<tr>
<td>Loan amount above 75 Lakhs</td>
<td>8.40%(Women) - 8.45%(Others)</td>
</tr>


<!--
<tr>
<td colspan="2" width="416"><strong>TruFixed Loan – 2 &amp; 3 Year Fixed Rate option - Festive Offer</strong></td>
</tr>
<tr>
<td>For women</td>
<td>9.50% - 10.00%</td>
</tr>
<tr>
<td>For other</td>
<td>9.55% - 10.05%</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2" width="416"><strong>TruFixed Loan – 10 Year Fixed Rate option - Festive Offer</strong></td>
</tr>
<tr>
<td>For women</td>
<td>9.70% - 10.20%</td>
</tr>
<tr>
<td>For other</td>
<td>9.75% - 10.25%</td>
</tr>
-->
</tbody>
</table>
<br />
<p>This is a limited period offer and is subject to change. All loans at the sole discretion of HDFC Ltd. Special Offer for a Limited Period ending <span style="color: #008000"> on October 31, 2017 And First Disbursement On Or Before November 30, 2017.</span></p>
<br />
  
  <strong>For Self Employed Professionals</strong>
<table border="1" width="100%">
<tbody>
<tr>
<td><strong>Loan Slab</strong></td>
<td><strong>Interest Rates (% p.a.)</strong></td>
</tr>
<tr>
<td>For Women* (upto 75 Lakhs)</td>
<td>8.35 to 8.85</td>
</tr>
<tr>
<td>For Others* (upto 75 lakhs)</td>
<td>8.40 to 8.90</td>
</tr>
<tr>
<td>For Women* (Above 75 Lakhs)</td>
<td>8.40 to 8.90</td>
</tr>
<tr>
<td>For Others* (Above 75 lakhs)</td>
<td>8.45 to 8.95</td>
</tr>
</tbody>
</table>
<strong>For Self Employed Non Professionals</strong>
<table border="1" width="100%">
<tbody>
<tr>
<td><strong>Loan Slab</strong></td>
<td><strong>Interest Rates (% p.a.)</strong></td>
</tr>
<tr>
<td>For Women* (upto 75 Lakhs)</td>
<td>8.45 to 8.95</td>
</tr>
<tr>
<td>For Others* (upto 75 lakhs)</td>
<td>8.50 to 9.00</td>
</tr>
<tr>
<td>For Women* (Above 75 Lakhs)</td>
<td>8.55 to 9.05</td>
</tr>
<tr>
<td>For Others* (Above 75 lakhs)</td>
<td>8.60 to 9.10</td>
</tr>
</tbody>
</table>
<p><strong>Repayment options</strong>: You can repay the loan amount in maximum upto 30 years.
  </p>

<p><strong>Processing fees</strong> – you have to pay upto 1.25% of the loan amount or Rs.3,000 whichever is higher + taxes applicable on hdfc ltd home loans.
<br />
  </p>
<h3 style="margin:2px;">Trends of  last 5 Years HDFC Home loans vs RBI Repo rate</h3>
  <div class="overflow-width">
    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="table_bgcolor_Border">
      <tr>
        <td width="10%" height="32" align="center" class="table_bgcolor"><strong>Date</strong></td>
        <td width="33%" align="center" class="table_bgcolor"><strong>Change by RBI in Rate Cut</strong></td>
        <td width="21%" align="center" class="table_bgcolor"><strong>New Repo Rate</strong></td>
        <td width="9%" align="center" class="table_bgcolor"><strong>Date</strong></td>
        <td width="27%" align="center" class="table_bgcolor"><strong>New Base Rate of HDFC  Ltd</strong></td>
      </tr>
      <tr>
        <td height="38" colspan="3" align="center"  bgcolor="#FFFFFF">&nbsp;</td>
        <td align="center"  bgcolor="#FFFFFF">30-Dec-2015</td>
        <td align="center"  bgcolor="#FFFFFF">9.30%</td>
      </tr>
      <tr>
        <td height="32" align="center"  bgcolor="#FFFFFF">29 Sep 2015&nbsp;</td>
        <td align="center"  bgcolor="#FFFFFF">(-).50% </td>
        <td align="center"  bgcolor="#FFFFFF">6.75%</td>
        <td align="center"  bgcolor="#FFFFFF">06-Oct-15</td>
        <td align="center"  bgcolor="#FFFFFF">9.60%</td>
      </tr>
      <tr>
        <td height="32" align="center"  bgcolor="#FFFFFF">4-Mar-15</td>
        <td align="center"  bgcolor="#FFFFFF">0.25%-</td>
        <td align="center"  bgcolor="#FFFFFF">7.50%</td>
        <td align="center"  bgcolor="#FFFFFF">13-Apr-15</td>
        <td align="center"  bgcolor="#FFFFFF">9.85%</td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">15-Jan-15</td>
        <td align="center"  bgcolor="#FFFFFF">0.25%-</td>
        <td align="center"  bgcolor="#FFFFFF">7.75%</td>
        <td colspan="2" align="center"  bgcolor="#FFFFFF"></td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">28-Jan-14</td>
        <td align="center"  bgcolor="#FFFFFF">0.25% +</td>
        <td align="center"  bgcolor="#FFFFFF">8.00%</td>
        <td colspan="2" align="center"  bgcolor="#FFFFFF"></td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">29-Oct-13</td>
        <td align="center"  bgcolor="#FFFFFF">0.25% +</td>
        <td align="center"  bgcolor="#FFFFFF">7.75%</td>
        <td align="center"  bgcolor="#FFFFFF">2-Nov-13</td>
        <td align="center"  bgcolor="#FFFFFF">10.00%</td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">20-Sep-13</td>
        <td align="center"  bgcolor="#FFFFFF">0.25% +</td>
        <td align="center"  bgcolor="#FFFFFF">7.50%</td>
        <td align="center"  bgcolor="#FFFFFF">3-Aug-13</td>
        <td align="center"  bgcolor="#FFFFFF">9.80%</td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">3-May-13</td>
        <td align="center"  bgcolor="#FFFFFF">0.25% -</td>
        <td align="center"  bgcolor="#FFFFFF">7.25%</td>
        <td colspan="2" align="center"  bgcolor="#FFFFFF"></td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">19-Mar-13</td>
        <td align="center"  bgcolor="#FFFFFF">0.25% -</td>
        <td align="center"  bgcolor="#FFFFFF">7.50%</td>
        <td align="center"  bgcolor="#FFFFFF">30-Mar-13</td>
        <td align="center"  bgcolor="#FFFFFF">9.60%</td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">29-Jan-13</td>
        <td align="center"  bgcolor="#FFFFFF">0.25% -</td>
        <td align="center"  bgcolor="#FFFFFF">7.75%</td>
        <td align="center"  bgcolor="#FFFFFF">31-Dec-12</td>
        <td align="center"  bgcolor="#FFFFFF">9.70%</td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">17-Apr-12</td>
        <td align="center"  bgcolor="#FFFFFF">0.50% -</td>
        <td align="center"  bgcolor="#FFFFFF">8.00%</td>
        <td align="center"  bgcolor="#FFFFFF">30-jun-12</td>
        <td align="center"  bgcolor="#FFFFFF">9.80%</td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">25-Oct-11</td>
        <td align="center"  bgcolor="#FFFFFF">0.25% +</td>
        <td align="center"  bgcolor="#FFFFFF">8.50%</td>
        <td align="center"  bgcolor="#FFFFFF">13-Aug-11</td>
        <td align="center"  bgcolor="#FFFFFF">10.00%</td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">16-Sep-11</td>
        <td align="center"  bgcolor="#FFFFFF">0.25% +</td>
        <td align="center"  bgcolor="#FFFFFF">8.25%</td>
        <td colspan="2" align="center"  bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">26-Jul-11</td>
        <td align="center"  bgcolor="#FFFFFF">1.25% +</td>
        <td align="center"  bgcolor="#FFFFFF">8.00%</td>
        <td align="center"  bgcolor="#FFFFFF">12-Jul-11</td>
        <td align="center"  bgcolor="#FFFFFF"> 9.50%</td>
      </tr>
      <tr>
        <td align="center"  bgcolor="#FFFFFF" height="32">25-Jan-11</td>
        <td align="center"  bgcolor="#FFFFFF"></td>
        <td align="center"  bgcolor="#FFFFFF">6.50%</td>
        <td align="center"  bgcolor="#FFFFFF">1-Jan-11</td>
        <td align="center"  bgcolor="#FFFFFF">7.75%</td>
      </tr>
    </table>
  </div>
  <div style="clear:both;"></div>
  <h3>Features & Benefits of HDFC Ltd Home Loan</h3>
  <p>&bull;	Attractive &amp; lowest <a href="home-loans-interest-rates.php">Home Loan Rates</a>.<br>
    &bull;	You can choose from Fixed Rate or Floating Rate according to your needs.<br>
    &bull;	Maximum loan amount you can get upto 90% of the cost of the property.<br>
    &bull;	Easy repayment options of upto 30 years.<br>
    &bull; Fastest loan  approval even before a property is selected.<br>
  </p>
  <p><strong>*Zero Processing Fees for Salaried and Self Employed Professionals when you shift your Home Loan to HDFC.</strong></p>
  <h3>Documents required for HDFC Ltd Home Loans are</h3>
•	Application form with 2 photographs<br />
•	Identity Proof & Residence Proof<br />
•	Latest Salary Slip (Salaried Individuals)<br />
•	Form 16 / ITR (Salaried Individuals)<br />
•	Processing Fee cheque<br />
•	Last 6 Months bank statement (Salaried Individuals)<br />
•	Last 3 Year profit/loss & balance sheet (Self Employed – Professionals/Businessmen)<br />
•	Last 3 years income tax returns (Self Employed – Professionals/Businessmen
  <br />
  <div>
    <p>
    <h3> Maximam Loan Amount you can get for buy a home    </h3>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" >
      <tr>
        <td height="32" class="td_border4">Loan Amount</td>
        <td class="td_border4">Maximum Funding* or avail loan amount</td>
      </tr>
      <tr>
        <td height="32" class="td_border_lrb">Up to INR 75 Lacs</td>
        <td class="td_border_rb">90% of the property value</td>
      </tr>
      <tr>
        <td height="32" class="td_border_lrb">Above INR 75 Lacs</td>
        <td class="td_border_rb">80% of the property value</td>
      </tr>
    </table>
    </p>
    <p><strong>*Subject to Market value of the porperty and replacement capacity of the customer, as assessed by HDFC.</strong><br />
    </p>
    <h3>FAQS about HDFC Ltd Home Loans:</h3>
    <strong>How will HDFC Ltd decide the loan amount I am eligible for?</strong><br />
    <br />
    HDFC ltd will determine your loan eligibility mostly by your income and repayment capacity. Other important factors include your age, qualification, number of dependants, your spouse's income (if any), assets & liabilities, savings history and the stability & continuity of occupation.<br />
    <br />
    <strong>Do I get tax benefits on the home loan?</strong><br />
    <br />
    Yes. You are eligible for tax benefits on the principal and interest components of your Home Loan under the Income Tax Act, 1961. As the benefits could vary each year, please do check with our Loan Counselor about the tax benefits which you could avail on your loan.<br />
    <br />
    <strong>Can I get a higher loan through my existing loan account to buy a new property?</strong><br />
    <br />
    Yes, you could go in for a ‘Home Conversion Loan’ whereby your existing loan (which you took to buy your current home) could be transferred to the new house with additional funds for the incremental cost of the new house, subject to your loan eligibility. This means you can move into your new home without having to go through the hassle of pre-paying your existing loan.<br />
    <br />
    <strong>What is an under construction property?</strong><br />
    <br />
    An under construction property refers to a home which is in the process of being constructed and where possession would be handed over to the buyer at a subsequent date.<br />
    <br />
    <strong>Can I repay my loan ahead of schedule?</strong><br />
    <br />
    Yes, you can repay the loan ahead of schedule by making lump sum payments towards part or full prepayment, subject to the applicable prepayment charges.
    </p>
  </div>
  <span><br />
  <h3>List of HDFC Ltd. Bank Branches for Home Loans in India</h3>
  <table border="1" width="100%" cellspacing="1" cellpadding="1"><tbody><tr><td><strong>Branch</strong></td><td><strong>Location / Address</strong></td><td><strong>State</strong></td></tr><tr><td>Vijayawada</td><td>M L TOWERS, D NO. 40-1-182 BUNDAR ROAD, LABBIPET, VIJAYAWADA - 520010</td><td>Andhra Pradesh</td></tr><tr><td>Tirupati</td><td>1ST FLOOR, CHINNAMAGARI'S PLAZA, D.NO: 10-14-582, V V MAHAL ROAD, TIRUPATI - 517501</td><td>Andhra Pradesh</td></tr><tr><td>Visakhapatnam</td><td>DOOR NO.26-42-4, S NO.103/2, NH-5, BESIDES EXHIBITION GROUND, CHINNAGANTYADA, GAJUWAKA, VISAKHAPATNAM - 530026.</td><td>Andhra Pradesh</td></tr><tr><td>Chandigarh</td><td>SCO 153-155, SECTOR 8-C, MADHYA MARG, CHANDIGARH - 160018</td><td>Chandigarh</td></tr><tr><td>New Delhi</td><td>2ND FLOOR, 44 REGAL BUILDING, CONNAUGHT PLACE, NEW DELHI - 110001</td><td>Delhi</td></tr><tr><td>Dwarka</td><td>HL WINGS, 1ST FLOOR, SECTOR-11, PLOT-2, POCKET 4, DWARKA, NEW DELHI - 110075</td><td>Delhi</td></tr><tr><td>Delhi</td><td>23-28, MAJESTIC TOWER, UPPER GROUND FLOOR, COMMUNITY CENTRE, VIKAS PURI, NEW DELHI - 110018</td><td>Delhi</td></tr><tr><td>South Delhi</td><td>THE CAPITAL COURT, MUNIRKA, OUTER RING ROAD, OLOF PALME MARG, NEW DELHI - 110067</td><td>Delhi</td></tr><tr><td>Ahmedabad</td><td>201, 2ND FLOOR, AMRUTA ARCADE, STATION ROAD, MANINAGAR, AHMEDABAD - 380008</td><td>Gujarat</td></tr><tr><td>Vadodara</td><td>HDFC HOUSE, TRIDENT RACE COURSE, VADODARA - 390 007</td><td>Gujarat</td></tr><tr><td>Surat</td><td>1ST FLOOR, KASHI PLAZA MAJURA GATE, SURAT - 395002</td><td>Gujarat</td></tr><tr><td>Gurgaon</td><td>FIRST INDIA PLACE, MEHRAULI-GURGAON ROAD, GURGAON - 122001</td><td>Haryana</td></tr><tr><td>Bengaluru</td><td>1ST FLOOR, 896/4, 1ST A MAIN, SECTOR A, YELAHANKA NEW TOWN, BANGALORE - 560064</td><td>Karnataka</td>
</tr><tr><td>Bangalore</td><td>GROUND FLOOR, GOLDEN HEIGHTS MALL, 1/2, 59TH C CROSS, 4TH M BLOCK, DR. RAJKUMAR ROAD, BENGALURU - 560010</td><td>Karnataka</td></tr><tr><td>Mysore</td><td># 2904, CH-67, 1ST FLOOR, FIRST MAIN, NEW KANTHARAJ URS ROAD, SARASWATHI PURAM, MYSORE - 570009</td><td>Karnataka</td></tr><tr><td>Kochi</td><td>1ST FLOOR, KOOLIYATTU BUILDING, COCHIN PALACE P O, KARINGACHIRA, TRIPUNITHURA, ERNAKULAM - 682301</td><td>Kerala</td></tr><tr><td>Indore</td><td>HDFC HOUSE, 10-A/1, MG ROAD, INDORE - 452001</td><td>Madhya Pradesh</td></tr>
<tr><td>Mumbai</td><td>OFFICE NO 1001, B WING, WESTERN EDGE II, WESTERN EXPRESS HIGHWAY, BORIVALI (E), MUMBAI 400066</td><td>Maharashtra</td></tr><tr><td>Thane</td><td>VISHNU PRASAD COMPLEX, UNIT NO.1, ÔHÕ WING, 3, PADMA COLONY, P P MARG, VIRAR (W), DISTRICT THANE, MUMBAI - 401303</td><td>Maharashtra</td></tr><tr><td>Navi mumbai</td><td>UNIT NO. 1, 1ST FLOOR, WHITE HOUSE, ABOVE ATHITHI HOTEL, BOISAR-TARAPUR ROAD, BOISAR(W) - 401501</td><td>Maharashtra</td></tr>
<tr><td>Mumbai</td><td>B2 - 201, MARATHON INNOVA NEXT GEN OPP. PENINSULA CORPORATE PARK, OFF GANPATRAO KADAM MARG, LOWER PAREL MUMBAI - 400013</td><td>Maharashtra</td></tr><tr><td>Mumbai</td><td>104, KEMP PLAZA, 1ST FLOOR, NEAR EVERSHINE MALL, CHINCHOLI BUNDER ROAD, OFF MALAD LINK ROAD, MALAD WEST, MUMBAI - 400064</td><td>Maharashtra</td></tr><tr><td>Nagpur</td><td>GROUND FLOOR, RAWEL PLAZA, KADBI CHOWK, KAMPTEE ROAD, NAGPUR - 440004</td><td>Maharashtra</td></tr><tr><td>Pune</td><td>2ND FLOOR, GOPAL HOUSE, OPP. KASAT CHEMICALS, KOTHRUD, PUNE - 411029</td><td>Maharashtra</td></tr><tr><td>Chinchwad</td><td>HDFC COMPLEX, PLOT NO. RC-1, SURVEY NO. 100, MIDC G BLOCK , TELCO RD., CHINCHWAD, PUNE - 411019</td><td>Maharashtra</td></tr><tr><td>Jaipur</td><td>10-B, TARANG APARTMENT, OPP. VAIBHAV MULTIPLEX, GAUTAM MARG, VAISHALI NAGAR, JAIPUR - 302021</td><td>Rajasthan</td></tr><tr><td>Coimbatore</td><td>HDFC HOUSE, 29, KAMARAJ ROAD, RACE COURSE, COIMBATORE- 641018</td><td>Tamilnadu</td></tr><tr><td>Chennai</td><td>AMENITIES FLOOR, NEVILLE TOWER, RAMANUJAN IT CITY, RAJIV GANDHI ROAD, TARAMANI, CHENNAI - 600113</td><td>Tamilnadu</td></tr><tr><td>Chennai</td><td>SHOP NO. A, GROUND FLOOR, KALYANI BLOCK, DOSHI SYMPHONY, VELACHERRY-TAMBARAM MAIN ROAD, PALLIKARANAI, CHENNAI - 600100</td><td>Tamilnadu</td></tr><tr><td>Chennai</td><td>WEST WOODS, Y-205, NEW NO. 32, FIFTH AVENUE, BEHIND HOTEL SARAVANA BHAVAN, ANNA NAGAR, CHENNAI - 600040</td><td>Tamilnadu</td></tr><tr><td>Chennai</td><td>SECOND FLOOR, ITC CENTRE,760, ANNA SALAI, CHENNAI - 600002</td><td>Tamilnadu</td></tr><tr><td>Madurai</td><td>7A, WEST VELI STREET, MADURAI - 625001</td><td>Tamilnadu</td></tr><tr><td>Hyderabad</td><td>1ST FLOOR, R.C REDDY COMPLEX, PLOT NO 39 &amp; 40, SRI VENKATESHWARA COLONY, NEAR UPPAL METRO STATION, NAGOLE ROAD,UPPAL, TELANGANA, HYDERABAD - 500039</td><td>Telangana</td></tr><tr><td>Hyderabad</td><td>1ST FLOOR, D NO.22-86, KANUKUNTA, BHEL X ROADS, R.C.PURAM, ABOVE SONY ELECTRONICS, OPP. BHEL MAIN GATE, HYDERABAD - 502 032</td><td>Telangana</td></tr><tr><td>Hyderabad</td><td>2nd Floor, TRENDZ DWARAKA PLOT NO.21 &amp; 22 TELECOM NAGAR GACHIBOWLI HYDERABAD - 500 032</td><td>Telangana</td></tr><tr><td>Hyderabad</td><td>I FLOOR, VIJAY SAI TOWERS, ABOVE SONY &amp; RELIANCE DIGITAL, OPP METRO PILLAR NO.14 KUKATPALLY, HYDERABAD</td>
<td>Telangana</td></tr><tr><td>Lucknow</td><td>HINDUSTAN TIMES HOUSE SECOND FLOOR, 25 ASHOK MARG, LUCKNOW - 226001</td><td>Uttar Pradesh</td></tr><tr><td>Kolkata</td><td>COOKE AND KELVEY BLDG., 1ST FLOOR, 20, OLD COURT HOUSE STREET., KOLKATA - 700001</td><td>West Bengal</td></tr>
<tr><td>Kolkata</td><td>MERLIN ESTATES, 25/8, DIAMOND HARBOUR ROAD, NEAR JANAKALYAN SCHOOL, KOLKATA - 700008</td><td>West Bengal</td></tr></tbody></table>
</p>
  </span></div>
</div>
<div style="clear:both; height:15px;"></div>
<!--partners--> 
<!--partners-->
<?php require 'useragentlog.php'; ?>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>