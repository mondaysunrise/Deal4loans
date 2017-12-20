<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
//	$retrivesource=$_REQUEST['source'];
	$retrivesource="HL Site Page";
}
else
{
	$retrivesource="HL Site Page";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Personal Loans Bank - List of Providers in India</title>
<meta name="keywords" content="personal loan banks, banks of personal loan, personal loan banks India, providers of personal loan">
<meta name="description" content="Personal Loan Banks: Here you can find which are the banks who provides personal loans in India.">
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="d4l_inner_wrapper">
<div style="margin-top:70px;"></div>
<div  class="common-bread-crumb"><a href="index.php">Home</a> > <a href="personal-loans.php">Personal Loans</a> > <span>Personal Loan Banks</span></div>
<div style="margin:auto;">
  <div class="left-wrapper">
    <div>
      <h1 class="pl-h1">Personal Loan Banks</h1>
      <div class="hdfc_la_offer">&nbsp;
        <?php include "special-offers_table.php"; ?>
      </div>
      <div style="clear:both;"></div>
      <div style="clear:both; height:15px;"></div>
      
      <!--class="lfttxtbar" -->
      <div id="txt">
        <div class="pl-bank-leftinn inner-body-plbanks">
          <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
            <tr>
              <td width="33%" valign="top" style="padding:2px;" class="inner-body-plbanks"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="personal-loan-sbi.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>State Bank of India (SBI)</b></a></legend>
                  <LABEL >
                  <b>SBI</b> Saral - Personal Loan is the answer when you need finances. Loans for salaried and self employed individuals, Repayment tenures from 12 to 60 months, Loans are available from Rs 1 lac to Rs 20 lacs. <br />
                  <div class="know_link"><a href="personal-loan-sbi.php" rel="nofollow" style="font-family:'Droid Sans', sans-serif'; font-size:14px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
              <td width="33%" valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="hdfc-personal-loan-eligibility.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>HDFC Bank</b></a></legend>
                  <LABEL>
                  Borrow up to Rs 15,00,000 for any purpose depending on your requirements. Flexible Repayment options. The procedure is simple, documentation is minimal and approval is quick. <br />
                  <div class="know_link"><a href="hdfc-personal-loan-eligibility.php" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
            </tr>
            <tr>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="personal-loan-icici-bank.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>ICICI Bank</b></a></legend>
                  <LABEL>
                  <b>ICICI Bank</b> Personal Loans are easy to get and absolutely hassle free. With minimum documentation you can now secure a loan for an amount upto Rs. 15 lakhs. <br />
                  <div class="know_link"><a href="personal-loan-icici-bank.php" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><b><a href="/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/" style="font-family:'Droid Sans', sans-serif'; font-size:14px;">Bajaj Finserv Lending</a></b></legend>
                  <label> It offers Highest loan amount upto Rs. 25 lacs, approved in just 24 hours post complete file login. These loans come with unique features like Nil Foreclosure charges, Part-Prepayment facility, Prompt Repayment benefit. The company offers personalized service with doorstep document pickup and a very fast and hassle free process. </label>
                  <br />
                  <div class="know_link"><a href="/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                </fieldset></td>
            </tr>
            <tr>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="personal-loan-stanc-bank.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>Standard Chartered</b></a></legend>
                  <LABEL>
                  Standard Chartered offers personal loan for expanding your business, designing your dream home, giving your children the best education, your daughters wedding, holidays and vacation. <br />
                  <div class="know_link"><a href="personal-loan-stanc-bank.php" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="fullerton-personal-loan-eligibility.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>Fullerton India</b></a></legend>
                  <LABEL>
                  Fullerton India is a Non Banking Finance Company. The Company started its operations in January 2006.Fullerton offers you a wide range of financial products. It has more than 800 branches across India. <br />
                  <div class="know_link"><a href="fullerton-personal-loan-eligibility.php" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
            </tr>
            <tr>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><b>Axis Bank</b></legend>
                  <LABEL>
                  <b>Axis Bank</b> Personal Loan loans will meet all  your personal requirements. Loans are available from Rs&nbsp;1 lac to  Rs&nbsp;20&nbsp;lacs, Loans can be used for any purpose with no questions asked  regarding the end use of the loan, Simple procedure, minimal documentation and  quick approval
                  <div class="know_link"></div>
                  </LABEL>
                </fieldset></td>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="http://www.deal4loans.com/loans/personal-loan/indusind-bank-personal-loan-interest-rates-eligibility-documents/" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>IndusInd Bank</b></a></legend>
                  <LABEL>
                  Presenting Indusind Bank Personal Loans. Now you don’t have to wait to fulfill your dreams. Be it renovating your home, going on your dream vacations or buying your special someone that coveted gift, count on us to make it happen. <br />
                  <div class="know_link"><a href="http://www.deal4loans.com/loans/personal-loan/indusind-bank-personal-loan-interest-rates-eligibility-documents/" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
            </tr>
            <tr>
              <td valign="top"><fieldset  style="border:1px solid #cccccc;">
                  <legend><a href="/loans/personal-loan/tata-capital-personal-loans-interest-rates-documents-apply-online/" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>TATA Capital</b></a></legend>
                  <LABEL>
                  <b>TATA Capital</b> Personal loans – TATA Capital Offers Personal loans For Renovation of Home, Marriage, Laptop Purchase, repayment of existing loans, credit card payments etc. Check Interest Rates, Eligibility, Flexi EMI options online at Deal4loans.com. <br />
                  <div class="know_link"><a href="/loans/personal-loan/tata-capital-personal-loans-interest-rates-documents-apply-online/" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="personal-loan-hsbc-bank.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>HSBC Bank</b></a></legend>
                  <LABEL>
                  Smooth personal loan repayment, low interest rates i.e. Lower EMI in the first year. Interest on utilised amount only, not on the entire loan. Last EMI waiver by paying a marginally higher interest rate. <br />
                  <div class="know_link" style="font-family:'Droid Sans', sans-serif'; font-size:12px;"><a href="personal-loan-hsbc-bank.php">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
            </tr>
            <tr>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="personal-loan-reliance.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>Reliance Consumer Finance</b></a></legend>
                  <LABEL>
                  An easy &amp; hassle free method  for your Personal loan requirement by <b>Reliance</b> Personal loans. Use the loan either for a wedding, vacation loan, or a loan to fulfill your credit needs, you can avail of them without any security. <br />
                  <div class="know_link"><a href="personal-loan-reliance.php" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="kotak-personal-loan-eligibility.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>Kotak Mahindra Bank</b></a></legend>
                  <LABEL>
                  Kotak Banks offers you an easy &amp; quick personal loan named as Jaldi Loan. They follow a simple &amp; easy documentation process. <b>Kotak</b> gives you a flexible repayment option , also don't over burden you with heavy Emi's <br />
                  <div class="know_link"><a href="kotak-personal-loan-eligibility.php" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
            </tr>
            <tr>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="personal-loan-hdb-financial-services.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>HDB Financial Services</b></a></legend>
                  <label> Now you don't have to be tight-fisted while planning a dream wedding, a dream vacation, renovating your home or funding your child's education.
                    
                    We have an ideal solution that lets you dream big. </label>
                  <br />
                  <div class="know_link"><a href="personal-loan-hdb-financial-services.php" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                </fieldset></td>
              <td valign="top"><fieldset style="border:1px solid #cccccc;">
                  <legend><a href="personal-loan-deutsche-bank.php" style="font-family:'Droid Sans', sans-serif'; font-size:14px;"><b>Deutsche Bank</b></a></legend>
                  <LABEL>
                  With <b>Deutsche Bank</b> Personal loan get special interest rates for salaried customers, easy documentation, and quick approval process. For DB Personal Loan No income papers required, Easy loan tenure, Balance transfer option, convenient top-up option <br />
                  <div class="know_link"><a href="personal-loan-deutsche-bank.php" style="font-family:'Droid Sans', sans-serif'; font-size:12px;">Know more..</a></div>
                  </LABEL>
                </fieldset></td>
            </tr>
          </table>
        </div>
      </div>
      <div style="width:100%; height:auto; margin-top:3px; text-align:right;"><span class="text11" style="color:#4c4c4c; size:18px;"><img src="images/arrow.gif"  /> <a href="#"  style="color:#0f8eda;">Back to Top</a></span> </div>
    </div>
  </div>
  <div class="right-panel">
    <?php include "right-widget.php"; ?>
  </div>
</div>
<div></div>
</div>

<?php include("footer_sub_menu.php"); ?>
</body>
</html>