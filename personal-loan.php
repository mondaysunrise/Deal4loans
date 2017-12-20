<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source']; }else{	$retrivesource="PL Site Page";}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan – Compare Rates & EMI of HDFC, ICICI, Axis, Bajaj Finserv at Deal4loans</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="description" content="Personal Loan: Compare top 20+ Banks instantly at Deal4loans on the basis of EMI, Eligibility, Disbursal time, Processing Fees, application status, procedure, documentation <?php echo DATE('F'); ?> 2017.">
<meta name="keywords" content="Personal Loan, Personal Loans, Personal Loan India, online personal loans, Personal Loans India">
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="breadcrumb-new"><div class="text12" style="margin:auto; width:100%; max-width:990px; margin-top:70px; margin-bottom:11px; color:#0a8bd9;"><strong style="font-size:12px;"></strong> <a href="/"  class="text12" style="color:#0080d6; font-size:14px;">Home</a> <strong style="font-size:12px;"> > </strong> <span  class="text12" style="color:#4c4c4c; font-size:14px;">Personal Loans</span></div></div>
<div class="d4l_inner_wrapper">
  <h1>Personal Loan</h1>
  Personal loan is the obvious choice if you need a finance for Personal finance, Medical emergency, Wedding purposes, Abroad travel, Holidays, Child education and for buying consumer durable things. Means if you have a requirement of money so personal loan is the best choice.<br />
  <h3>Personal loan Eligibility</h3>
  <p>1.Minimum per month Income of Rs.18500 in Metro cities required.<br />
2.	Minimum per Month Income of 12500 required in other cities like Tier 1, 2 & 3.<br />
3.	Age Must be above 21 Years.<br />
4.	Regular Source of Income with Valid proof of income    like – Pay Cheque, Account Transfer. Cash salary is not considered by any bank.<br />
5.	Minimum 6 Month stability in current company for Salaried, 2 Years ITR for self-employed / Professionals.<br />
6.	CIBIL Score must be above 750 points.<br />
</p>


  <div style="clear:both;"></div>
 <div class="hdfc_la_offer">&nbsp;
        <?php include "special-offers_table.php"; ?>
      </div>
  <div style="clear:both;"></div>
  
  <div style="clear:both;"><br>
  
  </div>
</div>

<div style="clear:both;"></div>
<div class="light-blue">
<div class="light-blue-inn"> <p><img src="images/new-rupee-sym.png" alt="Rupees"> <span class="highlighter-font">273,923 </span> crores worth of Personal Loan Applications received! <span class="greentext">(last updated on <?php echo date('d F Y'); ?>)</span></p>
</div></div>
<div>
<div style="clear:both;"></div>
<div class="formnewui-wrapper">
    <?php
$source = $retrivesource;
$TagLine = "Compare Personal Loan Offers from Top Banks & get e-Approved & your Free CIBIL score Instantly.";
$PostURL = "/personal-loan.php";
$TypeLoan = "Req_Loan_Personal";
 include "personal-loan-widget-cibil.php"; ?>
  </div></div>
<div class="bankslogos-wrap">
 <div class="bankslogos-wrapinn">&nbsp; <img src="images/icici-bank-logo-pl.png" width="134" height="15" alt="indusind"> &nbsp; <img src="images/kotak-logo-pl.png" width="85" height="21" alt="kotak bank"> <img src="images/bajajfinserv-logo-pl.png" width="78" height="22" alt="bajaj"> &nbsp; <img src="images/standrad-chartered-pl.png" width="70" height="26"> &nbsp; <img src="images/hdfc-logo-pl.png" width="109" height="18" alt="hdfc bank"> &nbsp; <img src="images/fullorton-pl-logo.png" width="59" height="18" alt="fullerton"> <img src="images/tata-capital-logo-pl.png" width="86" height="20"> &nbsp; <img src="images/indusind-logo-pl.png" width="134" height="15"></div>
</div> 
<div class="white-wrapper">
<div class="d4l_inner_wrapper">
 <h3>Personal loan Interest Rates</h3> 
 <p>
Interest rates on any loan plays an important part so always choose the lowest one is beneficial. Personal loan interest rates for most of the banks starts from 11.59% to 22.00%. Some banks offer special interest rates to its customer on the basis of Company, Profile, Residential status, Income per month. Banks offer lowest rates to only CAT A based company employees. So have a look at major banks personal loan interest rates below:
  </p>
 
<h3>Compare Top Personal Loan Banks on the Basis of Interest Rates, Processing Fees, Prepayment Charges & Approval Time</h3>
<table border="1" width="100%">
<tbody>
<tr>
<td style="text-align: center;"><strong>Bank</strong></td>
<td style="text-align: center;"><strong>Interest Rates</strong></td>
<td style="text-align: center;"><strong>Processing Fees</strong></td>
<td style="text-align: center;"><strong>Fore Closure Charges</strong></td>
<td style="text-align: center;"><strong>Disbursal Time</strong></td>
</tr>
<tr>
<td><a href="http://www.deal4loans.com/personal-loan-stanc-bank.php"><strong>Standard Chartered Bank</strong></a></td>
<td style="text-align: center;">10.99% - 14.49%</td>
<td style="text-align: center;">Zero - Rs.1000</td>
<td style="text-align: center;">Upto 2%</td>
<td style="text-align: center;">72 working hours</td>
</tr>
<tr>
<td><strong><a href="http://www.deal4loans.com/personal-loan-icici-bank.php">ICICI Bank</a>
</strong></td>
<td style="text-align: center;">11% - 17.50%</td>
<td style="text-align: center;">0.50% - 2.25%</td>
<td style="text-align: center;">Zero above 10 lakh &amp; 12 EMI Paid,

Otherwise 5.00%</td>
<td style="text-align: center;">48 working hours</td>
</tr>
<tr>
<td><a href="http://www.deal4loans.com/hdfc-personal-loan-eligibility.php"><strong>HDFC Bank</strong></a></td>
<td style="text-align: center;">11.49% - 19.50%</td>
<td style="text-align: center;">Now: Rs.999 for Special offers otherwise 1% - 2%)</td>
<td style="text-align: center;">Zero above 10 lakh,

Otherwise 4.00%</td>
<td style="text-align: center;">48 working hours</td>
</tr>
<tr>
<td><strong><a href="http://www.deal4loans.com/personal-loan-sbi.php">SBI Bank</a>
</strong></td>
<td style="text-align: center;">11.95% - 16.55%</td>
<td style="text-align: center;">2.00% - 3.00%</td>
<td style="text-align: center;">NIL</td>
<td style="text-align: center;">72 working hours</td>
</tr>
<tr>
<td><strong><a href="http://www.deal4loans.com/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/">Bajaj Finserv</a>
</strong></td>
<td style="text-align: center;">11.99% - 16.00%</td>
<td style="text-align: center;">Upto 2.00%</td>
<td style="text-align: center;">Upto 4% post 1st EMI clearance</td>
<td style="text-align: center;">48 working hours</td>
</tr>
<tr>
<td><strong><a href="http://www.deal4loans.com/kotak-personal-loan-eligibility.php">Kotak Bank</a>
</strong></td>
<td style="text-align: center;">11.29% - 20.15%</td>
<td style="text-align: center;">Rs.999 - 2%</td>
<td style="text-align: center;">Zero above 10 lakhs loan amount,

Else 5.00%</td>
<td style="text-align: center;">60 working hours</td>
</tr>
<tr>
<td><strong><a href="http://www.deal4loans.com/fullerton-personal-loan-eligibility.php">Fullerton India</a>
</strong></td>
<td style="text-align: center;">19.50% - 37.00%</td>
<td style="text-align: center;">2.00%</td>
<td style="text-align: center;">Upto 7.00%, 0% after 3 years</td>
<td style="text-align: center;">48 working hours</td>
</tr>

<tr>
<td><strong><a href="http://www.deal4loans.com/personal-loan-axis-bank.php">Axis Bank</a>
</strong></td>
<td style="text-align: center;">15.00% - 20.00%</td>
<td style="text-align: center;">2.00%</td>
<td style="text-align: center;">N.A</td>
<td style="text-align: center;">60 working hours</td>
</tr>
<tr>
<td><a href="http://www.deal4loans.com/loans/personal-loan/tata-capital-personal-loans-interest-rates-documents-apply-online/"><strong>TATA Capital</strong></a></td>
<td style="text-align: center;">12.50% - 19.50%</td>
<td style="text-align: center;">1.25% - 2.50%</td>
<td style="text-align: center;">NIL</td>
<td style="text-align: center;">72 working hours</td>
</tr>

</tbody>
</table>
<h3>Personal Loan Calculator</h3>
Personal loan emi calculator is the essential tool which helps borrowers to check how much per month emi have to pay for the borrow amount from the bank. Borrowers calculate the per month emi on the basis or in just three simple steps<br /><br />
1.	Go to Calculator Page ( <a href="http://www.deal4loans.com/personal-loan-emi-calculator.php"> http://www.deal4loans.com/personal-loan-emi-calculator.php</a>)<br />
2.	Enter required loan amount<br />
3.	Enter Interest rates on which bank offer the loan<br />
4.	Enter the tenure or repayment period<br />
5.	Then Calculate<br />
<p>Results shown to you by calculator on the basis of your entered details in the calculator. For example if you applied for 2 lakh of loan amount @ 15.50% rate of interest for 4 years repayment period than you have to pay Rs. 5616.97 per month for 4 years.</p><br />
  <h3>Personal loan Eligibility</h3>
<p>If you want to check for how much loan amount you are eligible, so go through this link which let you know the exact amount on the basis of your Net monthly Income, Liabilities, No. of dependents etc etc.
<a href=http://www.deal4loans.com/personal-loan-eligibility-calculator.php>Click Here for calculate eligibility on personal loan</a></p>
<h3>List of Personal Loan Documents for Salaried, Self employed / Professionals</h3> – <a href="http://www.deal4loans.com/loans/personal-loan/personal-loan-documents-requirement-deal4loans/">Check Here</a>

<h3>Personal Loan for Self Employed</h3>
Almost all banks offers personal loan to self-employed persons on the basis of business stability & last 2 or 3 years Income tax returns. Interest rates are also on the higher side for the comparison to salaried people. <br />
•	Maximum loan amount avail upto 15 lakhs. <br />
•	Maximum tenure period is 5 Years.<br />
•	Mandatory bank account, Part payment option is not available for self employed borrowers.<br />
<h3>Top Banks for Personal Loans in India</h3>
<h4>HDFC Bank Personal Loan</h4>
HDFC bank offers personal loans to salaried, self employed, professionals, doctors, CA’s for upto 25 lakh.<br /><br />
 Why to choose HDFC Bank?<br />
•	No Hidden Charges, Reasonable processing fees<br />
•	Special Offers for women borrowers<br />
•	Be earning at least Rs. 12,000/- per month net income (Rs. 15,000/- in Mumbai, Delhi, Bangalore, Chennai, Hyderabad, Pune, Calcutta, Ahmedabad, Cochin)<br />
•	Interest Rates starts from 11.99% p.a*
<h4>ICICI Bank Personal loan</h4>
<p>ICICI Bank offers personal loans up to Rs. 20 lakh for salaried, up to Rs.30 lakh for self employed and up to Rs.40 lakh for doctors.ICICI Bank offer flexible repayment option of 12-60* months.</p>
•	Interest Rates starts from 11.49% p.a*<br />
•	Disbursement within 72 working hours<br />
•	No Security / No Collateral<br />
•	Flexible tenures upto 60 months.<br />
<h4>Axis Bank Personal loan</h4>
<p>Axis bank’s personal loans will give you a helping hand meet all your personal requirements.</p>
•	Loan amount from 50000 to 15 Lakh<br />
•	Loan available to salaried individuals only<br />
•	Simple procedure, minimal documentation and quick approval<br />
•	Rate of Interest starts from 15.00% p.a*<br />
•	Available in 65 Locations throughout the India<br />
<h4>SBI Personal Loan</h4>
State Bank of India personal loan is the most searched term in government banks list. State bank of India offers personal loan to Salaried individual of good quality corporate, self employed, engineer, doctor, architect, chartered accountant, MBA with minimum 2 years standing.<br />
•	Minimum Income required Rs.24,000/- in metro and urban centres<br />
•	Minimum Income required Rs.10,000/- in rural/semi-urban centres<br />
•	Interest Rates starts from as low as 12.60% p.a*<br />
•	Zero pre payment charges<br />
<h4>Bajaj Personal Loan</h4>
Bajaj Finserv is the one of the fastedt growing company in terms of personal loans as per current market scenarios. Borrowers looking for bajaj because of its best repayment plans, lowest rates & transparent policy.<br />
•	Instant Online Approval<br />
•	Funds transfer to your account within 72 hours<br />
•	Maximum loan amount of Upto 25 Lakh<br />
•	Minimum Income required are Rs.25000<br />
•	Processing Fees of 2.25% to 3.00% of the loan amount<br />
</div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>