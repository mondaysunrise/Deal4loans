<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0){	$retrivesource="PL Site Page"; }else{	$retrivesource="PL Site Page";}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache"/>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title>Personal Loan Eligibility Calculator – check eligibility online</title>
<meta name="keywords" content="personal loan eligibility Calculator, personal loan eligibility"/>
<meta name="description" content="Use Personal Loan Eligibility Calculator to check ✓ how much loan amount you can get as personal loan from SBI, HDFC, ICICI, Bajaj Finance, Axis, PNB, Fullerton, standard chartered & other banks within seconds at deal4loans.com" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet" />
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="height:70px;"></div>
<div class="d4l_inner_wrapper" itemscope itemtype="http://schema.org/Product">
  <div class="common-bread-crumb" itemscope itemtype="http://schema.org/BreadcrumbList"><a href="http://www.deal4loans.com/" itemprop="url">Home</a> » <a href="http://www.deal4loans.com/personal-loan.php">Personal Loan</a> » <span>Personal Loan Eligibility Calculator</span></div>
  <div style="clear:both; height:5px;"></div>
  <h1 class="pl-h1" itemprop="name">Personal Loan Eligibility Calculator</h1>
  <br />
  <h2 class="pl-h2">Personal Loan Eligibility Factors :- </h2>
  <strong>The Eligibility of a Personal Loan is calculated in two ways – </strong>
  <div itemprop="description">
    <ol>
      <li>Multiplier Method </li>
      <li>FOIR (Fixed Obligation Income Ratio).</li>
    </ol>
    Under Multiplier Method the Banks provide a simple multiplier on the Monthly Net Take Home Salary to calculate the Loan Amount Eligibility of a customer. The multiplier varies from 9 to 18 depending upon your profile (Company Name, NTH etc). Under the FOIR Method the maximum EMI that most of the Bank/NBFCs offer to a customer varies from 50-75% of their NTH salary. Existing obligations & credit card outstanding, if any are also taken into consideration to calculate the Final Loan Eligibility. You can calculate your Eligibility by filling up your details in below form.</div>
  <div style="clear:both; height:10px;"></div>
  <?php
$source = "PL Eligibility Calc";
$TagLine = "Check Personal Loan Eligibility – Loan Amount from Top 10 Banks";
$PostURL = "personal-loans2.php";
$TypeLoan = "Req_Loan_Personal";
  
 include "personal-loan-widget.php"; ?>
  <div style="clear:both; height:25px;"></div>
  <strong>How To Increase Eligibility for Personal Loan </strong>
  <div> The options to increase the Eligibility are very limited. One such way is to transfer your existing Personal Loan to a lower rate which would help you in reducing your existing monthly EMI which would in turn help you in getting a higher Fresh Loan. Secondly, You can also pre-pay your loans running loans where in limited number of EMIs are left in case Balance Transfer offer is not working out for you. The impact on your Loan Eligibility will be in proportion to EMI that can be reduced at your end.</div>
  <strong>What are the ways which improves Eligibility for Personal loan?</strong>
  <div> Clean and timely re-payment on your previous Personal Loans can help you in negotiating with the Banks to borrow a higher Loan Amount. The other factors basis (mentioned in Point 1) which the Eligibility is calculated are not in one’s control to change immediately.</div>
  <h2>Required Parameters for getting Higher eligibility for personal loan from these Top Banks in India </h2>
  <div class="overflow-width">
    <div class="plec-body-text">
      <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCCCCC">
        <tr>
          <td scope="row"><table border="0" cellspacing="1" cellpadding="2" width="100%">
              <tr>
                <td width="10%" height="40"  align="center" bgcolor="#eceffa" class="th-new-text-plec" ><strong>Bank Name</strong></td>
                <td width="10%" height="40" align="center" bgcolor="#eceffa" class="th-new-text-plec" ><strong>Loan Amount</strong></td>
                <td width="20%" height="40" align="center" bgcolor="#eceffa" class="th-new-text-plec" ><strong>Minimum income <br>
                  per month</strong></td>
                <td width="20%" height="40" align="center" bgcolor="#eceffa" class="th-new-text-plec" ><strong>Repayment Period</strong></td>
                <td width="10%" align="center" bgcolor="#eceffa" class="th-new-text-plec" ><strong>Age</strong></td>
                <td width="20%" align="center" bgcolor="#eceffa" class="th-new-text-plec" ><strong>Total years in job/profession</strong></td>
                <td width="10%" align="center" bgcolor="#eceffa" class="th-new-text-plec" ><strong>Years in current residence</strong></td>
              </tr>
              <tr>
                <td width="10%" height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text"><strong><a href="http://www.deal4loans.com/hdfc-personal-loan-eligibility.php">HDFC Bank</a></strong></td>
                <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">Up to Rs .15 Lacs</td>
                <td height="40" bgcolor="#FFFFFF" class="th-new2-text">Be earning at least <br>
                  Rs. 12,000/- per month net income (Rs. 15,000/- in Mumbai, Delhi, Bangalore, Chennai, Calcutta, Ahmedabad, cochin)</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 Year- 5 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >21-60 years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >2 years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >6 months</td>
              </tr>
              <tr>
                <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text"><strong><a href="http://www.deal4loans.com/personal-loan-sbi.php">SBI</a></strong></td>
                <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">Up to Rs. 10 Lacs</td>
                <td height="40" align="left" bgcolor="#FFFFFF" >Rs.24,000/- in metro and urban centres<br>
                  Rs.10,000/- in rural/semi-urban centres<br></td>
                <td width="138" height="40" align="center" bgcolor="#FFFFFF" >1 year – 4 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >21-60 years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >2 years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 Year</td>
              </tr>
              <tr>
                <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text"><strong><a href="http://www.deal4loans.com/personal-loan-icici-bank.php">ICICI Bank</a></strong></td>
                <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">Up to Rs.40 lacs</td>
                <td height="40" align="left" bgcolor="#FFFFFF" >Salaried individuals with minimum monthly income Rs.17,500 (Rs.25,000 for applicants residing in Mumbai &amp; Delhi; Rs.20,000 for applicants residing in Chennai, Hyderabad, Bangalore, Pune &amp; Kolkata)</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 Year- 5 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >23-60 years</td>
                <td height="40" align="left" bgcolor="#FFFFFF" >2 Years (In current business for at least 5 years and minimum 3 years for doctors)</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 Year</td>
              </tr>
              <tr>
                <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text"><strong><a href="http://www.deal4loans.com/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/">Bajaj Finserv</a></strong></td>
                <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">Up to Rs. 25 lacs</td>
                <td height="40" align="left" bgcolor="#FFFFFF" >Rs. 40,000 or more for 
                  Delhi/NCR,  Mumbai,   Hyderabad, Bangalore, Chennai, Thane and <br>
                  Rs. 35,000 for other cities.<br></td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 Year- 5 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >21-60 years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >2 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 Year</td>
              </tr>
              <tr>
                <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text"><strong><a href="http://www.deal4loans.com/fullerton-personal-loan-eligibility.php">Fullerton India</a></strong></td>
                <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">Up to Rs. 30 Lakhs</td>
                <td height="40" align="left" bgcolor="#FFFFFF" >Minimum Rs.12500/- in hand, Mostly depends on City or Location of borrowers.</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 year – 4 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >21-60 years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >2 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 Year</td>
              </tr>
              <tr>
                <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text"><strong><a href="http://www.deal4loans.com/kotak-personal-loan-eligibility.php">Kotak</a></strong></td>
                <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">Up to Rs. 15 Lakhs</td>
                <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Net monthly salary of 
                  Rs. 25,000/-</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 year – 5 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >21-58 years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >2 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 Year</td>
              </tr>
              <tr>
                <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text"><strong><a href="http://www.deal4loans.com/loans/personal-loan/indusind-bank-personal-loan-interest-rates-eligibility-documents/">Indusind Bank</a></strong></td>
                <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">Up to Rs. 20 Lakhs</td>
                <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Net monthly salary of 
                  Rs. 25,000/-</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >1 year – 5 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >23 - 60 years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >2 Years</td>
                <td height="40" align="center" bgcolor="#FFFFFF" >6 Months</td>
              </tr>
          </table></td>
        </tr>
      </table>
    </div>
  </div>
<h3>Check Your Eligibility For Personal Loans with Various Banks</h3>
 <p>SBI, HDFC, Axis Bank, Bank of Baroda, Bank of India, Union Bank, DHFL, LIC Housing, SBP, Canara Bank, Allahabad Bank, ICICI Bank, Yes Bank, Citibank, PNB, uco bank, Indiabulls & others.</p>
<h3>Use this tool for calculate your personal Loan Eligibility in Various Cities of India: List Below</h3>
<p>Delhi/NCR, Mumbai, Kolkata, Chandigarh, Chennai, Bangalore, Ahemdabad, Jaipur, Aurangabad, Baroda, Bhiwadi, Bhopal, Bhubneshwar, Cochin, Coimbatore, Cuttack, Dehradun, Delhi, Faridabad, Gaziabad, Gurgaon, Guwahati, Hosur, Hyderabad, Indore, Jabalpur, Jamshedpur, Kanpur, Kochi, Lucknow, Ludhiana, Madurai, Mangalore, Mysore, Mumbai, Nagpur, Nasik, NaviMumbai, Noida, Patna, Pune, Ranchi, Raipur, Rewari, Sahibabad, Surat, Thane, Thiruvananthapuram, Trivandrum, Trichy, Vadodara, Vishakapatanam, Vizag</p>
</div>
<div style="clear:both; height:10px;"></div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>