<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
if(strlen($_REQUEST['source'])>0) {	$retrivesource="HL main Page"; }
else {	$retrivesource="HL main Page";}
$updtdate= date('d F Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Home Loan – Compares Rates & EMI of SBI, HDFC, ICICI, Axis, PNB, DHFL, LIC at Deal4loans</title>
<meta name="keywords" content="Home Loan, Home Loans, Home Loan India, Home loans India, Home Loans Eligibility, home loans documents, Housing loans">
<meta itemprop="description" content="Home Loan: Get housing Loan quotes from top 20 Banks instantly at Deal4loans. Compare loan interest rates  <?php echo DATE('F'); ?>, lowest EMI, Minimum document requirement, Disbursement time, loan sanction time & processing fees.">
<span itemprop="brand" itemscope itemtype="http://schema.org/Brand">
<meta itemprop="name" content="Deal4loans"></span>
<meta itemprop="url" content="https://www.deal4loans.com/" >
<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
<meta itemprop="price" content="0"></span>
<style>
body{
	font-family: "Droid Sans",sans-serif!important;
}

/*.....................new css added on 27/1/2015 starts................*/
.hl-newform-wrapper-main-new1{ width:1000px; margin:auto;}
.form-wrapper-main{ width:950px; background:#069eca; border-radius:5px; margin:auto; padding:5px;}
.form-head-text-white{ color:#FFF !important;  font-size:20px; color:#343434;}
.input-hanger-new{float:left; width:213px; margin-left:5px;}
.input-symbol-box{float:left;}
.input-symbol-box2{float:left; width:180px; height:37px; background:#FFF; border-radius:0px 5px 5px 0px;}
.input-row-newst{ border:none; height:35px; width:98%;}
.input-row-newst2{ border:none; height:35px; width:98%; border-radius:5px;}
.select-row-newst{ border:none; height:35px; width:98%; border-radius:5px; color:#087c9e;  font-size:15px;}
.input-row-dd{width:30%; height:37px; background:#FFF; border-radius:5px 5px 5px 5px; border:none;}
.home-loan-inner_box{ width:493px; margin:45px auto; background:url(../images/home-loan-inner-page-bg-new.jpg) no-repeat top;}
.best-bank-ico-bx{ float:left; width:138px; margin-top:-20px; margin-left:25px;}
.best-bank-ico-bx2{ width:60px; height:60px; margin:auto; transition: all .2s ease-in-out;}
.best-bank-ico-bx2:hover{ width:60px; height:60px; margin:auto; transform: scale(1.15);}
.text-below-icon{  font-size:14px; color:#343434; text-align:center; margin-top:5px;}
.text-below-icon a{  font-size:14px; color:#343434; text-align:center; text-decoration:none;}
.text-below-icon a:hover{  font-size:14px; color:#f89412; text-align:center;}

.best-bank-ico-bx-right{ float:right; width:188px; margin-top:-20px; margin-left:25px;}
.best-bank-ico-bx-right2{ float:right; width:188px; margin-top:10px; margin-left:25px;}
.best-bank-ico-bx3{ float:left; width:138px; margin-top:15px; margin-left:25px;}
.best-bank-ico-bx4{ width:210px; margin-top:-10px; margin-left:150px;}
.quote-text{ font-size:19px; color: #FFF; }

/*.....................new css added on 27/1/2015 ends................*/

@media screen and (max-width:680px){
/*.....................new css added on 27/1/2015 starts................*/
.home-loan-inner_box{ width:95%; margin:45px auto; background:none;}
.best-bank-ico-bx{width:138px; margin:7px auto; float:none;}
.best-bank-ico-bx2{ width:60px; height:60px; margin:auto; transition: all .2s ease-in-out;}
.best-bank-ico-bx2:hover{ width:60px; height:60px; margin:auto; transform: scale(1.15);}
.text-below-icon{  font-size:14px; color:#343434; text-align:center; margin-top:5px;}
.text-below-icon a{  font-size:14px; color:#343434; text-align:center; text-decoration:none;}
.text-below-icon a:hover{  font-size:14px; color:#f89412; text-align:center;}

.best-bank-ico-bx-right{width:188px; margin:7px auto; float:none;}
.best-bank-ico-bx-right2{width:188px; margin:7px auto; float:none;}
.best-bank-ico-bx3{width:138px; margin:7px auto; float:none;}
.best-bank-ico-bx4{ width:210px; margin:7px auto; float:none;}
.hl-newform-wrapper-main-new1{ width:95%; margin:auto;}
.form-wrapper-main{ width:95%; background:#069eca; border-radius:5px; margin:auto; padding:5px;}
.input-hanger-new{float:left; width:213px; margin-top:10px;}
/*.....................new css added on 27/1/2015 ends................*/
}
.auto-style1 {
	font-weight: bold;
}
.auto-style2 {
	line-height: 120%;
	font-size: 12.0pt;
	font-family: "Liberation Serif", serif;
	margin-left: 0in;
	margin-right: 0in;
	margin-top: 0in;
	margin-bottom: 7.0pt;
}
.auto-style3 {
	font-size: 12.0pt;
	font-family: "Liberation Serif", serif;
	margin-left: 0in;
	margin-right: 0in;
	margin-top: 0in;
	margin-bottom: .0001pt;
}
</style>
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />

</head>
<body>
<?php include "middle-menu.php"; ?>
<script type="text/javascript">
function processtogetHl()
{
	var nitxt1 = document.getElementById('sectnwise_TXTDiv');
	nitxt1.innerHTML ='<div class="form-head-text-white">Get Eligibility Quote from 5 PSU and 7 Private Banks </div>';
	var ni1 = document.getElementById('Hl_mainDiv');
	ni1.innerHTML ='<div style="width:100%;" id="HL_processDIV">    <div class="body-text-new-h2"><a name="Process-get-Home-Loan"><strong>Home Loan –</strong> Lets us Explain how this will go about and what are the Steps</a></div>      <p><span class="body-text-new-hl" style="color:#4c4c4c; ">The first step involved in the process is to find your property which is followed by the verification of property documents, post that the documents are examined &amp; simultaneously you can start searching for the lender who can offer the BEST Home Loan Deal after checking your eligibility criteria.<br />        <br />        <strong>Know the Home Loan Eligibility:</strong> Banks offer the loan amount based on your Income and the property value .They will give you max amount  in which your emi of Home loan and others loans  is  50-60% of your income.<br />        Other factor is that value of property.<br />        <br />        <strong>Select the Best Home Loan after evaluation:</strong> Comparing home loan interest rates is the primary feature in the home loan selection, however other fees &amp; charges like Application fees, processing fees, legal charges should not be neglected when comparing various loan offers. To check the interest rates &amp; other charges incurred by various banks, Deal4Loans has brought in a Home Loan Comparison Chart across various Banks.Banks offer Fixed and Floating rates in Home loans.<br />        <br />        <strong>Most customers choose Floating rates</strong><br />      </span></p>      <p><span class="body-text-new-hl" style="color:#4c4c4c; "><strong>Applying for the Loan :</strong> After you have selected your lender, you have to fill in the application form wherein the lender requires complete information about your financial assets &amp; liabilities; other personal &amp; professional details together with the property details &amp; its costs.<br />        <strong><br />        Documentation &amp; Verification Process: </strong>You are required to submit the necessary documents to the bank which will be verified together with the details in the application.<br />        <br />        <strong>Credit &amp; default check:</strong> Bank checks out the borrower&rsquo;s loan eligibility (through repayment capacity) &amp; the amount of loan is confirmed. The borrower&rsquo;s repayment capacity is reached which is based on the income, salary, age, experience &amp; nature of business etc. Bank also checks credit history through the Cibil Score which plays a critical role in deciding &amp; approving your loan application. Low Credit Score implies that the bank upfront rejects your application on the basis of earlier credit defaults; on the other hand high credit score gives a green signal to your application.<br /> <strong><br />        Bank sanctions Loan &amp; Offer letter to the borrower:</strong> After the credit appraisal of the borrower bank decides the final amount &amp; sanctions the loan, the bank further sends an offer letter to the borrower which constitutes the details like rate of interest, loan tenure &amp; repayment options etc.<br />        <br />        <strong>Acceptance Copy to the Bank: </strong>The borrower needs to send an acceptance copy to the bank after the borrower agrees with the terms &amp; conditions in the offer letter.<br />      </span></p>      <p><span class="body-text-new-hl" style="color:#4c4c4c; "><strong>Bank checks the legal documents:</strong> The bank further asks the legal documents of property from the borrower to check its authenticity so as to keep them as a security for the loan amount given. The next step involved is the valuation of the property by the bank which determines the loan amount sanctioned by the bank. <br />        <br /><strong>Signing of agreement &amp; the loan disbursal: </strong>The borrower signs the loan agreement &amp; the bank disburses the loan amount.<br /><br />        <div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;">Documents required in Home Loan</h3></div><div class="body-text-new-hl" style="color:#4c4c4c; ">Generally the documents required to processing your loan application are almost similar across all the banks; however they may differ with various banks depending upon specific requirement etc. Following documents are required by financial institutions to process the loan application:<ul style="margin-left:35px; margin-top:10px;"><li>Income</li><li>Age Proof</li><li>Address Proof</li><li>Income Proof of the applicant & co-applicant</li><li>Last 6 months bank A/C statement</li><li>Passport size photograph of the applicant & co-applicant</li></ul><div style="clear:both;"></div><div class="hl-newform-wrapper-new" style="margin-top:15px;">  <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bfbfbf">  <tr>    <td scope="row"><table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <td width="484" height="40"  align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>In case of Salaried</strong></td>    <td width="453" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>In case of Self-employed</strong></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Employment certificate from the employer, </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of audited financial statements for the last 2 years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Copies of pay slips for last few months and TDS certificate </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of partnership deed if it is a partnership firm or copy of memorandum of association and articles of association if it is a company </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td rowspan="2" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Latest Form 16 issued by employer Bank statements</span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Profit and loss account for the last few years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" >Income tax assessment order</td>  </tr>    </table></td>  </tr></table></div></div>      </div><br>';
}

function bestIrHl()
{
	var d = new Date();
var n = d.getDate(); 
var m= d.getMonth();
var y= d.getFullYear();
var month;
if(m==0) {month="January ";} else if(m==1) {month="February";} else if(m==2) {month="March";} else if(m==3) {month="April";} else if(m==4) {month="May";} else if(m==5) {month="June";} else if(m==6) {month="July";} else if(m==7) {month="August";} else if(m==8) {month="September";} else if(m==9) {month="October";} else if(m==10) {month="November";} else if(m==11) {month="December";}
var dt= n + " " + month+ " " + y;

var nitxt2 = document.getElementById('sectnwise_TXTDiv');
nitxt2.innerHTML ='<div class="form-head-text-white">Get Interest Rates of 10 Banks - Apply Online with Lowest</div>';
var ni2 = document.getElementById('Hl_mainDiv');
ni2.innerHTML ='<div id="Hl_InterRateDIV"><div class="body-text-new-h2"><a name="Best-Bank"><strong>Interest Rates of Banks</strong></a></div>(Last updated on ' + dt + ')<div style="clear:both;"></div>   <div class="hl-newform-wrapper-new">  <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bfbfbf">  <tr>    <td scope="row"><table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <td width="166" height="40"  align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Banks</strong></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Loan    to Property Value</strong></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Interest Rates</strong></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Apply</strong></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">State Bank of India (SBI)</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -90%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
	8.30% - 8.60%</td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/sbi-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'SBI Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">HDFC Ltd</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -80%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
		8.35% - 8.55%</td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'HDFC Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">LIC Housing Finance</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -80%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
		8.35% - 8.80%</td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/lic-housing-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'LIC Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Axis Bank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% - 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
8.35% - 8.75%</td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/home-loan-axis-bank.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'Axis Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">ICICI Bank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">Upto 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
		8.35% - 8.80%</td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/icici-hfc-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'ICICI Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Fedbank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">Upto 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >9.57% - 9.82%</td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'Fedbank Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">PNB Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >8.35% - 8.45%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'PNB Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">PNB Housing Finance</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
	8.35% - 9.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'PNBHF Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">IDBI Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
		8.35% - 8.40%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'IDBI Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">DHFL Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >80% - 85%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
		8.35%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Indiabulls Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
8.35% - 8.80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Allahabad Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 
		80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
		8.30% - 8.40%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Bank of India Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 85%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >&nbsp;8.35% 
	- 8.40%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Union Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >65% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
	8.30% - 8.35%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">United Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
		8.45%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Uco Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >8.45% 
		- 8.75%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Bank of Baroda Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
	8.30% - 8.50%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Kotak Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >up to 
		90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
		8.35%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Vijaya Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >Upto 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >8.50%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Standard Chartered Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >Upto 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
	8.51%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Indian Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >80% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >
		8.35% - 9.35%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">L &amp; T Home Loan</td>    
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >80% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >9.65% - 10.25% (for Salaried/  SEP) 9.65%-10.50%(SENP)</td>    
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Shubham Housing Development  Finance Company</td>    
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >12%-14%(For Salaried) -  15%-17%(For Self-employed)</td>    
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ></td>  </tr>  </table></td>  </tr></table></div></div><br><br>';
}

function hleligibility()
{
	var nitxt3 = document.getElementById('sectnwise_TXTDiv');
	nitxt3.innerHTML ='<div class="form-head-text-white">Get Eligibility Quote from 5 PSU and 7 Private Banks and Apply Online</div>';
var ni3 = document.getElementById('Hl_mainDiv');
	    ni3.innerHTML ='<div id="Hl_eligibilityDIV"><div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;"><div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;"><a name="Hl2">How is my Home loan Eligibility Calculated</a></h3></div><div class="body-text-new-hl">  The borrower eligibility of getting a housing loan depend upon his/her repayment capacity & the banks establish this repayment capacity by considering various factors such income, spouse&rsquo;s income, age, number of dependants qualifications , assets, liabilities, stability and continuity of occupation and savings history. Eligibility Factors in Housing loan Your Home Loan eligibility is determined by your repayment capacity and the value of the Property <br /><ul style="margin-left:35px; margin-top:10px;"><li>Income</li><li>Qualifications</li><li>Age</li><li>Spouse&rsquo;s income</li><li> No. of dependants</li><li>Stability and continuity of occupation</li><li>Assets/LiabilitiesM.</li><li>Savings history.</li></ul><br /><br />The most important concern of banks in determining your loan eligibility is that whether or not you are contentedly able to pay off the amount you borrow.<br /><br />The Second factor is the value of the Property<br /><br />Banks are okay to fund 75-85% of property value but with the condition that you have income capacity that you can pay its Emi each month.                      <br /><br />   </div></div>       </div>';
}

function Hlnoworwait()
{
	var nitxt4 = document.getElementById('sectnwise_TXTDiv');
	nitxt4.innerHTML ='<div class="form-head-text-white">Quick Apply and Get Instant Quotes from 5 PSU and 7 Private Banks.</div>';
	var ni4 = document.getElementById('Hl_mainDiv');
	    ni4.innerHTML ='<div id="HlnownwaitDIV"> <div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;"><div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;"> <a name="Home-Loan-Now-n-Wait">Should I take Home loan now or wait ?</a></h3></div><div class="body-text-new-hl">Home loan is a long term loan and is taken by customers on floating rates .Rates keep changing and timing on 20 year loan is impossible.<br>The Home loan rates will change in 20 years so thinking to start a loan at a lower rate has no relevance.<br>The right time to take a Home loan is when:<ul style="margin-left:35px; margin-top:10px;"><li>The Property you intend to buy is good and cannot be missed or it is expected that the price of property will rise.</li><li>The Emi that you have to pay per month is above your monthly expense budgets etc.</li></ul><br>Reports Shows that Home Loan Market in India was Rs.9,70,000 crore in Size. Market growing at 15.6% per annum over the last 10 years. But GDP for India is only 8% whereas developed countries at 60%. But if we look at Indian Government initiative or plan of housing for all, then by 2020 India will need 11 crore homes. In last 5 years property prices have increased by more than 72% but the median income has not. It makes the houses unaffordable for several borrowers. So before more hike in property prices compare & choose the Best Home loan Deals with Deal4loans.com & get a possession of your Dream Home. Pay Less Get More.<br /><br />In Past 5 months SBI sanctions around Rs.9500 crore of home loan amount through staff referrals. This is on top of more than 50% growth in sanctions. Since April to September 6, we have more than 50,000 new home loan account customers and Rs 9,696 crore has been the amount sourced. SBI&acute;s outstanding home loan disbursals till June-end was Rs 1.64 lakh crore, a growth of 13% year-on-year. Almost 60% of the bank’s retail book is made up of home loans.<br></div> </div></div>';
}
</script>
<div style="clear:both;"></div>
<div  class="hl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="d4l_inner_wrapper">
    <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">    
      <div class="common-bread-crumb"><a href="http://www.deal4loans.com/">Home</a> > Home Loan</div>
      </div>
</div>
	 <h1 class="hl-h1">HOME LOAN</h1>
 <div class="body-text-new-hl">
      <h2 class="pl-h2">To make your home loan journey a smooth sail, in this article we will help you to know eligibility criteria, rates of interest, process, necessary documents, EMI comparison and transfer for lowest rates.</h2><br />
<p>Home loan is really critical and important financial decision in our lives. Before you finalise your bank to secure home loan, try to get more information on current interest rates from different banks. First, gather some more information about how much each bank can give you. Find out eligibility for government and private banks. Which interest rate is more flexible and affordable such as fixed rates or floating rates? What is more easy a prepay option or balance transfer? We try to give answers to all such questions, and make this home loan process simple for you. To find the lender for 20 years term go through the fine print and save for years to come. A perfect Home loan is loan which gives you lowest rates throughout the tenure, has part payment options and allows you to balance transfer if you wish to.</p>

<br />

</div>
<div style="clear:both;"></div>
<div class="home-loan-inner_box">
<div class="best-bank-ico-bx">
<div class="best-bank-ico-bx2"> <a onClick="bestIrHl(); ga('send', 'event', 'best bank', 'HL Best bank Button');"  style="cursor:pointer;" href="#Best-Bank"><img src="images/which-is-best-bank-ico.jpg" width="60" height="60" border="0" alt="Which is Best Bank with Lowest Rates ?
" /></a> </div>

<div class="text-below-icon">
  <a onClick="bestIrHl(); ga('send', 'event', 'Best bank', 'HL best bank Button');"  style="cursor:pointer;" href="#Best-Bank">Which is Best Bank <br /> with Lowest Rates ?</a> </div>
</div>
<div class="best-bank-ico-bx-right">
<div class="best-bank-ico-bx2"><a onclick="hleligibility(); ga('send', 'event', 'Hl2', 'Hl2 Button');" style="cursor:pointer;" href="#Hl2"><img src="images/need-how-much-loan.jpg" width="60" height="60" border="0" /></a></div>
<div class="text-below-icon">
  <a onclick="hleligibility(); ga('send', 'event', 'Hl2', 'Hl2 Button');" style="cursor:pointer;" href="#Hl2">I need to know How much Home loan I can get ?</a>
</div></div>
<div style="clear:both;"></div>
<div class="best-bank-ico-bx3">
  <div class="best-bank-ico-bx2"><a onclick="Hlnoworwait(); ga('send', 'event', 'Hl Now or wait', 'HL Hl Now or wait Button');" style="cursor:pointer;" href="#Home-Loan-Now-n-Wait"><img src="images/take-hl-wait.jpg" width="60" height="60" /></a></div>
    <div class="text-below-icon">
  <a onclick="Hlnoworwait(); ga('send', 'event', 'Hl Now or wait', 'HL Now or wait Button');" style="cursor:pointer;" href="#Home-Loan-Now-n-Wait">Should I take Home Loan now or wait ?</a>
</div>
</div>
<div class="best-bank-ico-bx-right2">
<div class="best-bank-ico-bx2"><a onclick="processtogetHl(); ga('send', 'event', 'Hl Process', 'Hl Process Button');" style="cursor:pointer;" href="#Process-get-Home-Loan"><img src="images/what-process.jpg" width="60" height="60" border="0" /></a></div>
<div class="text-below-icon">
  <a onclick="processtogetHl(); ga('send', 'event', 'Hl Process', 'Hl Process Button');" style="cursor:pointer;" href="#Process-get-Home-Loan">What is a process to <br />
  get Home loan ?</a>
</div></div>
<div style="clear:both;"></div>
<div class="best-bank-ico-bx4">
<div class="best-bank-ico-bx2"><a href="http://www.deal4loans.com/home-loan-balance-transfer-calculator.php" target="_blank"><img src="images/transfer-loan.jpg" width="60" height="60" border="0" /></a></div>
<div class="text-below-icon">
  <a href="http://www.deal4loans.com/home-loan-balance-transfer-calculator.php" target="_blank">I need to transfer my Existing Home loan to a Cheaper Rate ?</a>
</div>
</div>
</div> 
<div id="PutForm_Here">
<strong>Home Loan applications received for <img src="images/rupees.gif" alt="rupees" /> <? 
$result1 = "SELECT sum( `Amount` ) AS ttlcnt FROM `totalLoans` WHERE ( Name ='HL' )";
list($alreadyExist,$row1)=MainselectfuncNew($result1,$array = array());
$row1contr=count($row1)-1;

echo strlen($alreadyExist);


 $fVal = substr(trim($row1[$row1contr]['ttlcnt']), 0, strlen(trim($row1[$row1contr]['ttlcnt']))-7);

echo $plVal = number_format($fVal)." crores"; ?> till <span class="greentext"><? echo date('d F Y');?></span>
        </strong><br><br>
</div>
<div style="clear:both;"></div>
<?php
$newsource="HL main Page";
$subjectLine="Get Instant Eligibility Quotes and Offers on Home Loans from Top 10 Banks at Deal4loans";
include "home-loans-widget.php";
?>
<div id="sectnwise_TXTDiv">
  </div>
  

<div id="Hl_mainDiv">
 <div id="HlnownwaitDIV">
 <div style=" float:left; width:100%; height:auto; margin-top:5px;"><div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;"> Should I take Home loan now or wait ?</h3></div>
<div class="body-text-new-hl">
Home loan is a long term investment plan. Generally, people opt for a home loan for 20 to 30 years.Mostly customers avail loan on floating interest rates. Rates keep changing and long-term loan such as for 20 years or more than that is impossible to decide. Home loan rates will change in 20 years, so making a decision to take a home loan just base of the reason of interest rates is not a smart idea. So thinking to start a loan at a lower rate has no relevance.<br />

The right time to take a Home loan is when:
<ul style="margin-left:35px; margin-top:10px;">
<li>The Property you intend to buy is good and cannot be missed or it is expected that the price of property will rise.</li>
<li>The EMI that you have to pay per month is above your monthly expense budgets etc.</li></ul>
<br />
<p>Bonanza for home loan seekers as govt. offers interest subsidy for those earning &#8377;6 lakh - &#8377;18 lakh. The scheme has been envisaged for one year. Those who have been sanctioned housing loans and whose applications are under consideration since January 1 this year are also eligible for interest subsidy. Prime Minister Narendra Modi had earlier announced an interest subsidy of 4 per cent on housing loans of up to ₹9 lakh for those earning up to &#8377;12 lakh per year under  <a href="http://www.deal4loans.com/loans/articles/pradhan-mantri-home-loan-interest-rates-emi-calculator-eligibility-apply/">PMAY SCHEME 2017</a>. A subsidy of 3 per cent on housing loans of up to &#8377;12 lakh for those earning up to &#8377;18 lakh per year.</p>

</div>
 </div>
</div><!----section I R--->
<div id="Hl_InterRateDIV"><div style=" width:100%; height:auto; margin-top:5px; text-align:justify;"><span  style="color:#4c4c4c; size:18px;"><h3 style="font-weight:normal; color: #000; font-size:18px; padding-top:5px; padding-bottom:5px;" class="text">Major Home Loan providers in India</h3></span></div>(Last updated on <?php echo date('d F Y'); ?>)<div style="clear:both;"></div>   <table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <table border="0" width="100%" cellspacing="1" cellpadding="5">
<tbody>
<tr>
<td align="center" bgcolor="#FFFFFF" width="166" height="40"><strong>Banks</strong></td>
<td align="center" bgcolor="#FFFFFF" width="186" height="40"><strong>Loan to Property Value</strong></td>
<td align="center" bgcolor="#FFFFFF" width="70" height="40"><strong>Interest Rates</strong></td>
<td align="center" bgcolor="#FFFFFF" width="71" height="40"><strong>MCLR Rates</strong></td>
<td align="center" bgcolor="#FFFFFF" width="159" height="40"><strong>Apply</strong></td>
</tr>
<tr>
<td align="left" bgcolor="#FFFFFF" width="166" style="height: 40px"><span class="th-new2-text"><a href="http://www.deal4loans.com/sbi-home-loan.php" onClick="ga('send', 'event', 'Home Loan Main', 'SBI');">State Bank of India (SBI)</a></span></td>
<td align="center" bgcolor="#FFFFFF" width="186" style="height: 40px"><span class="th-new2-text">75% -90%</span></td>
<td width="70" align="center" bgcolor="#FFFFFF" style="height: 40px"><span class="th-new2-text">
8.30% - 8.60%<br /></span></td>
<td width="71" align="center" bgcolor="#FFFFFF" style="height: 40px">7<span class="th-new2-text">.95%</span></td>
<td align="center" bgcolor="#FFFFFF" width="159" height="40">
  <div class="applybtn"><a href="http://www.deal4loans.com/sbi-home-loan.php" onClick="ga('send', 'event', 'Home Loan Main', 'sbi');">Apply</a></div></td>
</tr>

<tr>
<td align="left" bgcolor="#FFFFFF" width="166" height="40"><span class="th-new2-text"><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php" onClick="ga('send', 'event', 'Home Loan Main', 'hdfc');">HDFC Ltd</a></span></td>
<td align="center" bgcolor="#FFFFFF" width="186" height="40"><span class="th-new2-text">75% -80%</span></td>
<td width="70" height="40" align="center" bgcolor="#FFFFFF">8.35% - 8.55%</td>
<td width="71" height="40" align="center" bgcolor="#FFFFFF">16.15%</td>
<td align="center" bgcolor="#FFFFFF" width="159" height="40">
  <div class="applybtn"><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php" onClick="ga('send', 'event', 'Home Loan Main', 'hdfc1');">Apply</a></div></td>
</tr>
<tr>
<td align="left" bgcolor="#FFFFFF" width="166" height="40"><span class="th-new2-text"><a href="http://www.deal4loans.com/lic-housing-home-loan.php" onClick="ga('send', 'event', 'Home Loan Main', 'LICHFL');">LIC Housing Finance</a></span></td>
<td align="center" bgcolor="#FFFFFF" width="186" height="40"><span class="th-new2-text">75% -80%</span></td>
<td width="70" height="40" align="center" bgcolor="#FFFFFF"><span class="th-new2-text">8.35% - 8.80%</span></td>
<td width="71" height="40" align="center" bgcolor="#FFFFFF">8.15%</td>
<td align="center" bgcolor="#FFFFFF" width="159" height="40">
  <div class="applybtn"><a href="http://www.deal4loans.com/lic-housing-home-loan.php" onClick="ga('send', 'event', 'Home Loan Main', 'LICHFL1');">Apply</a></div></td>
</tr>
<tr>
<td align="left" bgcolor="#FFFFFF" width="166" height="40"><span class="th-new2-text"><a href="http://www.deal4loans.com/home-loan-axis-bank.php" onClick="ga('send', 'event', 'Home Loan Main', 'Axis');">Axis Bank Home Loan</a></span></td>
<td align="center" bgcolor="#FFFFFF" width="186" height="40"><span class="th-new2-text">75% - 85%</span></td>
<td width="70" height="40" align="center" bgcolor="#FFFFFF"><span class="th-new2-text">8.35% - 8.75%</span></td>
<td width="71" height="40" align="center" bgcolor="#FFFFFF">8.15%</td>
<td align="center" bgcolor="#FFFFFF" width="159" height="40">
  <div class="applybtn"><a href="http://www.deal4loans.com/home-loan-axis-bank.php" onClick="ga('send', 'event', 'Home Loan Main', 'Axis1');">Apply</a></div></td>
</tr>
<tr>
<td align="left" bgcolor="#FFFFFF" width="166" style="height: 40px"><span class="th-new2-text"><a href="http://www.deal4loans.com/icici-hfc-home-loan.php" onClick="ga('send', 'event', 'Home Loan Main', 'ICICI');">ICICI Bank Home Loan</a></span></td>
<td align="center" bgcolor="#FFFFFF" width="186" style="height: 40px"><span class="th-new2-text">Upto 85%</span></td>
<td width="70" align="center" bgcolor="#FFFFFF" style="height: 40px">8.35% - 
8.80%</td>
<td width="71" align="center" bgcolor="#FFFFFF" style="height: 40px">8.20%</td>
<td align="center" bgcolor="#FFFFFF" width="159" style="height: 40px">
  <div class="applybtn"><a href="http://www.deal4loans.com/icici-hfc-home-loan.php" onClick="ga('send', 'event', 'Home Loan Main', 'ICICI1');">Apply</a></div></td>
</tr>
<tr>
<td align="left" bgcolor="#FFFFFF" width="166" height="40"><span class="th-new2-text"><a href="http://www.deal4loans.com/loans/home-loan/federal-bank-home-loan-interest-rates-documents-apply-online/" onClick="ga('send', 'event', 'Home Loan Main', 'fedbank');">Fedbank Home Loan</a></span></td>
<td align="center" bgcolor="#FFFFFF" width="186" height="40"><span class="th-new2-text">Upto 85%</span></td>
<td width="70" height="40" align="center" bgcolor="#FFFFFF">9.57<span class="th-new2-text">% 
- 9.82%</span></td>
<td width="71" height="40" align="center" bgcolor="#FFFFFF">8.95%</td>
<td align="center" bgcolor="#FFFFFF" width="159" height="40">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/federal-bank-home-loan-interest-rates-documents-apply-online/" onClick="ga('send', 'event', 'Home Loan Main', 'fedbank1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/pnb-home-loan-interest-rates-eligibility-documents-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'PNB');">PNB Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 80%</td>
<td width="70" align="center" bgcolor="#FFFFFF" style="height: 40px">8.35% - 
8.45%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.15%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text"></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/pnb-home-loan-interest-rates-eligibility-documents-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'PNB1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/pnb-housing-finance-interest-rates-documents-eligibility-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'PNBHFL');">PNB Housing Finance</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.35% - 
9.25%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">&nbsp;</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/pnb-housing-finance-interest-rates-documents-eligibility-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'PNBHFL1');">Apply</a></div></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/home-loan-idbi-homefinance.php" onClick="ga('send', 'event', 'Home Loan Main', 'IDBI');">IDBI Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 90%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.35% - 
8.40%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.80%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
 <!-- <div class="applybtn"><a href="http://www.deal4loans.com/home-loan-idbi-homefinance.php" onClick="ga('send', 'event', 'Home Loan Main', 'IDBI1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/dhfl.php" onClick="ga('send', 'event', 'Home Loan Main', 'DHFL');">DHFL Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">80% - 85%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.35%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">&nbsp;</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <div class="applybtn"><a href="http://www.deal4loans.com/dhfl.php" onClick="ga('send', 'event', 'Home Loan Main', 'DHFL1');">Apply</a></div></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/bajaj-finance-home-loan-eligibility-documents-interest-rates-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'Bajaj');">Bajaj Finserv Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.85%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">&nbsp;</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
 <!-- <div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/bajaj-finance-home-loan-eligibility-documents-interest-rates-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'Bajaj1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/indiabulls-home-loans-interest-rates-emi-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'indiabulls');">Indiabulls Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.35% - 
8.80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">&nbsp;</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/indiabulls-home-loans-interest-rates-emi-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'indiabulls1');">Apply</a></div></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/allahabad-bank-home-loans-interest-rate-processing-fee/" onClick="ga('send', 'event', 'Home Loan Main', 'Allahabad');">Allahabad Bank Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.30% - 
8.40%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.25%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/allahabad-bank-home-loans-interest-rate-processing-fee/" onClick="ga('send', 'event', 'Home Loan Main', 'allahabad1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/bank-of-india-home-loan-processing-fee-interest-rate-emi/" onClick="ga('send', 'event', 'Home Loan Main', 'BOI');">Bank of India Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 85%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.35% - 
8.40%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.30%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/bank-of-india-home-loan-processing-fee-interest-rate-emi/" onClick="ga('send', 'event', 'Home Loan Main', 'BOI1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/union-bank-home-loan-interest-rates-processing-fee-emi/" onClick="ga('send', 'event', 'Home Loan Main', 'Union');">Union Bank Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">65% - 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.30% - 
8.35%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.20%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/union-bank-home-loan-interest-rates-processing-fee-emi/" onClick="ga('send', 'event', 'Home Loan Main', 'union1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/united-bank-of-india-housing-loan-interest-rates-emi-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'united');">United Bank Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.45%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.45%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/united-bank-of-india-housing-loan-interest-rates-emi-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'united1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/home-loan-uco-bank-interest-rates-documents-eligibility/" onClick="ga('send', 'event', 'Home Loan Main', 'Uco');">Uco Bank Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.45% - 
8.75%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.45%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
 <!-- <div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/home-loan-uco-bank-interest-rates-documents-eligibility/" onClick="ga('send', 'event', 'Home Loan Main', 'Uco1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" style="height: 40px"><a href="http://www.deal4loans.com/loans/home-loan/bank-of-baroda-home-loan-interest-rates-documents/" onClick="ga('send', 'event', 'Home Loan Main', 'BOB');">Bank of Baroda Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" style="height: 40px">75% - 90%</td>
<td align="center" bgcolor="#FFFFFF" class="th-new2-text" style="height: 40px">
8.30% 
- 8.50%</td>
<td align="center" bgcolor="#FFFFFF" class="th-new2-text" style="height: 40px">
8.30%
</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" style="height: 40px">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/bank-of-baroda-home-loan-interest-rates-documents/" onClick="ga('send', 'event', 'Home Loan Main', 'BOB1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/home-loan-kotak-mahindra-bank.php" onClick="ga('send', 'event', 'Home Loan Main', 'kotak');">Kotak Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">up to 90%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.35%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.60%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/home-loan-kotak-mahindra-bank.php" onClick="ga('send', 'event', 'Home Loan Main', 'kotak1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/vijay-bank-home-loan-interest-rates-calulator-documents-emi-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'vijaya');">Vijaya Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">Upto 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.50%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.50%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/vijay-bank-home-loan-interest-rates-calulator-documents-emi-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'vijaya1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/home-loan-standard-chartered-bank.php" onClick="ga('send', 'event', 'Home Loan Main', 'stanc');">Standard Chartered Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">Upto 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.51%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.95%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <!--<div class="applybtn"><a href="http://www.deal4loans.com/home-loan-standard-chartered-bank.php" onClick="ga('send', 'event', 'Home Loan Main', 'stanc1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/indian-bank-home-loan-interest-rates-documents-eligibility-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'Indian');">Indian Bank Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">80% - 90%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.35% - 9.35%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">8.35%</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
 <!-- <div class="applybtn"><a href="http://www.deal4loans.com/loans/home-loan/indian-bank-home-loan-interest-rates-documents-eligibility-apply/" onClick="ga('send', 'event', 'Home Loan Main', 'Indian1');">Apply</a></div>--></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/bankbranch/interest-rates/l-t-home-loan/" onClick="ga('send', 'event', 'Home Loan Main', 'Indian');">L & T Home Loan</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">80% - 90%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">9.65% - 10.25% (for Salaried/ SEP) 9.65%-10.50%(SENP)</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">&nbsp;</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
  <div class="applybtn"><a href="http://www.deal4loans.com/bankbranch/interest-rates/l-t-home-loan/" onClick="ga('send', 'event', 'Home Loan Main', 'Indian1');">Apply</a></div></td>
</tr>
<tr>
<td class="th-new2-text" align="left" bgcolor="#FFFFFF" height="40"><a href="http://www.deal4loans.com/loans/home-loan/shubham-housing-finance-home-loan-interest-rate-calculator/" onClick="ga('send', 'event', 'Home Loan Main', 'Indian');">Shubham Housing Development Finance Company</a></td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">75% - 80%</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">12%-14%(For Salaried) - 15%-17%(For Self-employed)</td>
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text">&nbsp;</td>
<td class="th-new2-text" align="center" bgcolor="#FFFFFF" height="40">
</tr>
</tbody>
</table>
</tr>
</table>
<!-----Section IR--->

<!----Section Process---->
<div style="width:100%;" id="HL_processDIV">    <div class="body-text-new-h2"><strong>Home Loan –</strong> Let's simplify how this will go about and what are the steps.<br />
The first step involved in the process is to find your property, which is followed by the verification of property documents, post that the documents are examined.  Simultaneously, you can start searching for the lender who can offer the best home loan deal after checking your eligibility criteria.</div>      <p>
	</p>
	<p><span class="body-text-new-hl"><strong>Know the Home Loan Eligibility:</strong> 
	<span lang="EN-IN" style="font-size:12.0pt;font-family:
&quot;Droid Sans&quot;;mso-fareast-font-family:&quot;Droid Sans Fallback&quot;;mso-bidi-font-family:
FreeSans;color:black;mso-ansi-language:EN-IN;mso-fareast-language:ZH-CN;
mso-bidi-language:HI">Banks offer the loan amount based on your monthly income 
	and the value of the property. They will give you max amount in which your 
	EMI of home loan and others loans is 50-60% of your income. Other factor is 
	value of that property.<br style="mso-special-character:line-break"></span>        <br />        <strong>Select the Best Home Loan after evaluation:</strong> 
	<span lang="EN-IN" style="font-size:12.0pt;font-family:
&quot;Droid Sans&quot;;mso-fareast-font-family:&quot;Droid Sans Fallback&quot;;mso-bidi-font-family:
FreeSans;color:black;mso-ansi-language:EN-IN;mso-fareast-language:ZH-CN;
mso-bidi-language:HI">Comparing home loan interest rates of various banks is the 
	primary feature in the home loan selection process. However, you should not 
	also forget to compare other fees &amp; charges like application fees, 
	processing fees, legal charges of different loan offers. To check the 
	interest rates &amp; other charges incurred by various banks, Deal4Loans has 
	brought in a Home Loan Comparison Chart across various government and 
	private banks. Banks offer fixed and floating rates in home loans.<br style="mso-special-character:
line-break"></span>        <br />        <span class="auto-style1">
	<span lang="EN-IN" style="font-size:12.0pt;font-family:&quot;Droid Sans&quot;;mso-fareast-font-family:&quot;Droid Sans Fallback&quot;;
mso-bidi-font-family:FreeSans;color:black;mso-ansi-language:EN-IN;mso-fareast-language:
ZH-CN;mso-bidi-language:HI">Most customers choose Floating rates</span></span><br />      </span></p>      <p><span class="body-text-new-hl"><strong>Applying for the Loan :</strong> 
	<span lang="EN-IN" style="font-size:12.0pt;font-family:
&quot;Droid Sans&quot;;mso-fareast-font-family:&quot;Droid Sans Fallback&quot;;mso-bidi-font-family:
FreeSans;color:black;mso-ansi-language:EN-IN;mso-fareast-language:ZH-CN;
mso-bidi-language:HI">After you have selected your lender, you have to fill in 
	the application form, wherein the lender requires complete information about 
	your financial assets &amp; liabilities; other personal &amp; professional details 
	together with the property details &amp; its costs.<br style="mso-special-character:line-break">
	</span><strong><br />        Documentation &amp; Verification Process: 
	</strong> 
	<span lang="EN-IN" style="font-size:12.0pt;font-family:
&quot;Droid Sans&quot;;mso-fareast-font-family:&quot;Droid Sans Fallback&quot;;mso-bidi-font-family:
FreeSans;color:black;mso-ansi-language:EN-IN;mso-fareast-language:ZH-CN;
mso-bidi-language:HI">You are required to submit the necessary documents to the bank, which will be verified together with the details in the application</span><br />        <br />        <strong>Credit &amp; default check:</strong> 
	<span lang="EN-IN" style="font-size:12.0pt;font-family:
&quot;Droid Sans&quot;;mso-fareast-font-family:&quot;Droid Sans Fallback&quot;;mso-bidi-font-family:
FreeSans;color:black;mso-ansi-language:EN-IN;mso-fareast-language:ZH-CN;
mso-bidi-language:HI">Bank checks out the borrower’s loan eligibility (through 
	repayment capacity) &amp; the amount of loan is confirmed. The borrower’s 
	repayment capacity is reached, which is based on the income, salary, age, 
	experience &amp; nature of business etc. Bank also checks credit history through 
	the Cibil Score, which plays a critical role in deciding &amp; approving your 
	loan application. Low credit score implies that the bank upfront rejects 
	your application on the basis of earlier credit defaults; on the other hand 
	high credit score gives a green signal to your application</span><br /> <strong><br />        Bank sanctions Loan &amp; Offer letter to the borrower:</strong> 
	<span lang="EN-IN" style="font-size:12.0pt;font-family:
&quot;Droid Sans&quot;;mso-fareast-font-family:&quot;Droid Sans Fallback&quot;;mso-bidi-font-family:
FreeSans;color:black;mso-ansi-language:EN-IN;mso-fareast-language:ZH-CN;
mso-bidi-language:HI">After the credit appraisal of the borrower bank decides 
	the final amount &amp; sanctions the loan, the bank further sends an offer 
	letter to the borrower, which constitutes the details like rate of interest, 
	loan tenure &amp; repayment options etc.</span><br />        <br />        <strong>Acceptance Copy to the Bank: </strong>
	<span lang="EN-IN" style="font-size:12.0pt;font-family:
&quot;Droid Sans&quot;;mso-fareast-font-family:&quot;Droid Sans Fallback&quot;;mso-bidi-font-family:
FreeSans;color:black;mso-ansi-language:EN-IN;mso-fareast-language:ZH-CN;
mso-bidi-language:HI">The borrower needs to send an acceptance copy to the bank 
	after the borrower agrees with the terms &amp; conditions in the offer letter.</span><br />      </span></p>      <p><strong>Bank checks the legal documents:</strong> 
	<span lang="EN-IN" style="font-size:12.0pt;font-family:
&quot;Droid Sans&quot;;mso-fareast-font-family:&quot;Droid Sans Fallback&quot;;mso-bidi-font-family:
FreeSans;color:black;mso-ansi-language:EN-IN;mso-fareast-language:ZH-CN;
mso-bidi-language:HI">The bank further asks the legal documents of property from 
	the borrower to check its authenticity, so as to keep them as a security for 
	the loan amount given. The next step involved is the valuation of the 
	property by the bank which determines the loan amount sanctioned by the 
	bank.<br style="mso-special-character:line-break"></span>        <br />        <strong>Signing of agreement &amp; the loan disbursal: </strong>
	<p class="auto-style2" style="text-autospace: ideograph-other;">
	<span lang="EN-IN" style="font-family:&quot;Droid Sans&quot;;color:black">
	The borrower signs the loan agreement &amp; the bank disburses the loan amount.</span><span lang="EN-IN"><o:p></o:p></span></p>
	<p>	<div class="body-text-new-h2">
		<h3 class="body-text-new-h2">Documents required in Home Loan</h3></div><div class="body-text-new-hl">
			<p class="auto-style2" style="text-autospace: ideograph-other;">
	<span lang="EN-IN" style="font-family:&quot;Droid Sans&quot;;color:black">
	Generally, the documents required to process your loan application are 
	almost similar across all the banks; however they may differ with various 
	banks depending upon specific requirement etc. Following documents are 
	required by financial institutions to process the loan application:<o:p></o:p></span></p>
		<ul style="margin-left:35px; margin-top:10px;">
	<li>Income</li><li>Age Proof</li><li>Address Proof</li><li>Income Proof of the applicant & co-applicant</li><li>Last 6 months bank A/C statement</li><li>Passport size photograph of the applicant & co-applicant</li></ul><div style="clear:both;"></div><div class="hl-newform-wrapper-new" style="margin-top:15px;">  <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bfbfbf">  <tr>    <td scope="row"><table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <td width="484" height="40"  align="center" bgcolor="#FFFFFF"><strong>In case of Salaried</strong></td>    <td width="453" height="40" align="center" bgcolor="#FFFFFF"><strong>In case of Self-employed</strong></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Employment certificate from the employer, </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of audited financial statements for the last 2 years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Copies of pay slips for last few months and TDS certificate </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of partnership deed if it is a partnership firm or copy of memorandum of association and articles of association if it is a company </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td rowspan="2" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Latest Form 16 issued by employer Bank statements</span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Profit and loss account for the last few years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" >Income tax assessment order</td>  </tr>    </table></td>  </tr></table></div></div>      </div><br>

<!---Section Process------------->

<!-----------Section Eligibility------------------>
<div id="Hl_eligibilityDIV"><div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;"><div class="body-text-new-h2"><h3 class="body-text-new-h2">How is my Home loan Eligibility Calculated</h3></div><div class="body-text-new-hl">  The borrower's eligibility of getting a housing loan depend upon his/her repayment capacity & the banks establish this repayment capacity by considering various factors such income, spouse&rsquo;s income, age, number of dependants qualifications , assets, liabilities, stability and continuity of occupation and savings history. Eligibility Factors in Housing loan Your Home Loan eligibility is determined by your repayment capacity and the value of the Property <br /><ul style="margin-left:35px; margin-top:10px;"><li>Income</li><li>Qualifications</li><li>Age</li><li>Spouse&rsquo;s income</li><li> No. of dependants</li><li>Stability and continuity of occupation</li><li>Assets/LiabilitiesM.</li><li>Savings history.</li></ul><br />The most important concern of banks in determining your loan eligibility is that whether or not you are contentedly able to pay off the amount you borrow.<br /><br />The Second factor is the value of the Property<br /><br />Banks are okay to fund 75-85% of property value but with the condition that you have income capacity that you can pay its Emi each month.                      <br /><br />   </div></div>       </div>
<!--------------Section Eligibility-------------->


	<p class="auto-style3" style="text-autospace: ideograph-other;"><b>
	<span lang="EN-IN">Fixed and floating rate of interest<o:p></o:p></span></b></p>
<p></br>
When you avail a home loan EMI is calculated either on fixed rate of interest or according to the floating rate of interest. Before finalizing either, you must take a note of both the patterns and take a well-calculated decision. Generally, home loan is taken for a longer tenure compared to other loans such as personal loan or car loan. You borrow the loan for at least for10 years and maximum upto 30 years. In such scenario, you end up paying a huge amount as interest on your principal amount. Therefore, the difference of 0.5% can make huge impact on your overall interest amount. Let's take a close look at both the patterns of interest.</p>
<p><strong>Fixed rate of interest</strong>: Generally, in fixed rate of interest, the percentage of interest is fixed for whole tenure and same percentage of interest is charged throughout the loan. It makes the EMI payable at a constant sum throughout the tenure. Therefore, it is always recommended that you opt fixed rate of interest only when the rates are bottom down and if an upward trend is expected.</p>
<p><strong>Floating rate of interest</strong>: Floating rates of interest changed with the market lending rates. Therefore, these rates are prone to fluctuations. The interest rate on your EMI might get increased or decreased depending upon the fluctuation in the market lending rates. In this case, bank provide an alternative to increase the tenure of the loan, at a constant EMI, for the borrowers who do not desire their EMI to be increased in case of higher interest rates.</p><br/>
<p class="auto-style3" style="text-autospace: ideograph-other;"><b>
<span lang="EN-IN">How to calculate interest rate?<o:p></o:p></span></b></p><br />
<p>While applying for a home loan, the most important question is rate of interest. One more thing, which is equally important is how interest is calculated by respective bank. Banks are required to quote interest rates on a 'reducing balance' basis. Let's take a look how this whole formula works:</p>
<p>For instance: You have taken a loan of Rs. 1 lakh for a period of one year at an interest rate of 10.00% per annum, on a monthly reducing balance basis. In this situation, you will pay 12 equated monthly instalment’s (EMIs), with a part of each EMI going towards repaying the principal amount borrowed (Rs 1 lakh), and the balance towards servicing the interest on your loan. What is important to note is reducing balance calculation is the interest component of your EMI keeps changing, from a high initial amount in the early part of your loan, to a nominal figures as the loan comes to an end.</p>
<div class="overflow-width">
<table border="1" width="100%" cellspacing="0" cellpadding="4"><tbody>
<tr valign="TOP">
<td><b>Sr. No</b></td>
<td><b>EMI</b></td>
<td><b>Interest</b></td>
<td><b>Principal Amount</b></td>
<td><b>Balance Amount</b></td>
</tr>
<tr valign="TOP">
<td></td>
<td></td>
<td></td>
<td></td>
<td>100,000</td>
</tr>
<tr valign="TOP">
<td>1</td>
<td>8,792</td>
<td>833</td>
<td>7,958</td>
<td>92,042</td>
</tr>
<tr valign="TOP">
<td>2</td>
<td>8,792</td>
<td>767</td>
<td>8,025</td>
<td>84,017</td>
</tr>
<tr valign="TOP">
<td>3</td>
<td>8,792</td>
<td>700</td>
<td>8,091</td>
<td>75,926</td>
</tr>
<tr valign="TOP">
<td>4</td>
<td>8,792</td>
<td>633</td>
<td>8,159</td>
<td>67,767</td>
</tr>
<tr valign="TOP">
<td>5</td>
<td>8,792</td>
<td>565</td>
<td>8,227</td>
<td>59,540</td>
</tr>
<tr valign="TOP">
<td>6</td>
<td>8,792</td>
<td>496</td>
<td>8,295</td>
<td>51,245</td>
</tr>
<tr valign="TOP">
<td>7</td>
<td>8,792</td>
<td>427</td>
<td>8,365</td>
<td>42,880</td>
</tr>
<tr valign="TOP">
<td>8</td>
<td>8,792</td>
<td>357</td>
<td>8,434</td>
<td>34,446</td>
</tr>
<tr valign="TOP">
<td>9</td>
<td>8,792</td>
<td>287</td>
<td>8,505</td>
<td>25,941</td>
</tr>
<tr valign="TOP">
<td>10</td>
<td>8,792</td>
<td>216</td>
<td>8,575</td>
<td>17,366</td>
</tr>
<tr valign="TOP">
<td>11</td>
<td>8,792</td>
<td>145</td>
<td>8,647</td>
<td>8,719</td>
</tr>
<tr valign="TOP">
<td>12</td>
<td>8,792</td>
<td>73</td>
<td>8,719</td>
<td>0</td>
</tr>
<tr valign="TOP">
<td><b>Total</b></td>
<td><b>1,05,499</b></td>
<td><b>5,499</b></td>
<td><b>100,000</b></td>
<td></td>
</tr>
</tbody>
</table>
</div><br/>
<p>This happens because the bank charges interest rate of 10% on a lower or reducing balance loan amount each month. Therefore, in the first month 10% rate is charged on full Rs. 1 lakh. After paying your first EMI, you are left with a balance amount of Rs. 92,042 to pay.</p>
<p>In the second month, the same rate of interest is charged on a reduced/lower balance basis. The same formula continues month-after-month, till the whole amount is repaid. Therefore, in lower interest rate, the EMI stays constant, the split of interest and principal keeps changing, with the interest amount of EMI being at the highest in the first month and decreasing month-by-month to a nominal amount, in the last month of repayment.</p>
 <div style="text-align:right;"><a href="#" class="cd-top">Top</a></div>
</div>
</div>
</div>



  <?php include("footer_sub_menu.php"); ?>


</body>
</html>