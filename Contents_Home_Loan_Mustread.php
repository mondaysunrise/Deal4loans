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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Features and Eligibility | Housing loan India- Deal4loans</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="en-us">
<meta name="Keywords" content="Home Loans Articles, Home Loans Must Read, Home Loans tips, Home Loans Updates">
<meta name="description" content="Deal4Loans provides you online information on easy home loans schemes available with best home loan provider banks India. Knoe the features, eligibility, Documentation, interest ates, Insurance, Penalties, hidden costs for Home Loan provided by major banks in india.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body >
<?php include "middle-menu.php"; ?>
<div class="hl_inner_wrapper">
  <div style="margin-top:70px;">
    <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> > <span>Home Loan Mustread</span></div>
  </div>
  <div >
    <div class="left-wrapper">
      <div>
        <?php 
    if(((strlen($_SESSION['Temp_Last_Inserted'])>0) && ($_REQUEST['source']=="QuickApply") ) || ($_REQUEST['source']=="ndtv")) 
    {
    ?>
        <div>Thanks for applying Home Loan through Deal4loans.com. 
          You will soon receive a Call from us.</div>
        <br>
        <?php 
	  }
	?>
        <h1 class="hl-h1"><strong>Home Loan Mustread</strong></h1>
        <div> <span>Home loans are provided based on the market value, mainly estimation given by banks or the registration value of the property. Availing various types of house loans to suit your individual needs at the lowest rates & easy financing can now fulfill the need for a house of your own.<br>
          <br>
          Home loan is not a one-time decision; do review  the market periodically before availing them. Today there are unlimited numbers  of <a href="http://www.deal4loans.com/home-loan-banks.php" title="home loan banks">home loan banks</a> in the country wanting to give out  Home loans. Given this scenario, it may seem easy getting yourself a loan. But  is it really?? <br>
          <br>
          Buyers tend to make mistakes while entering into  deals, which may not be beneficial for them, so better compare all the  variables before signing a <a href="http://www.deal4loans.com/home-loans.php" title="housing loan">housing loan</a> agreement by different banks. However the  loan agreement should be finalized only after reading the terms and conditions  carefully.<br>
          <br>
          You can <a href="http://www.deal4loans.com/apply-home-loans.php" title="Apply Home Loan">Apply  Home Loan</a> even before you select your property. The loan amount would be  sanctioned or approved for you, based on your repayment capability. You can get  more details about home loans at <a href="http://www.deal4loans.com/loans/category/home-loan/" title="Articles about Home Loan">Articles about Home Loan</a><br>
          <br>
          <b>Unique Features of house loan:</b><br>
          &bull; 	Purpose: For purchase of house from builder / resale and construction / extension of existing house.<br>
          &bull; 	Loan amount: You can avail for Home loans ranging from Rs.2 lac to Rs.200 lac depending on your  eligibility, income and repayment capacity. <br>
          &bull; 	Security: Home loan is a secured loan wherein collateral are required. <br>
          &bull; 	Loan tenor: The maximum loan tenure is 20 years.<br>
          <br>
          <b>So if you are planning to avail a home loan, here are some tips:</b><br>
          Firstly, take your own time and evaluate your expenses and do a market survey about the property buying process.
          Buying a house, which is way beyond your range, could affect you financially; banks help in financing your dream home via home loans.<br>
          <br>
          <b>Eligibility </b><br>
          Banks determine your eligibility based on your repayment capacity and discuss about the loan amount up front. The eligibility for acquiring a <a href="http://www.deal4loans.com/home-loans.php" title="home loan">home loan</a> is augmented by clubbing income of your father/spouse/mother/son, by clearing your outstanding debts, by stretching your loan tenure, Salaried individuals can increase their eligibility by showing their performance linked income or bonus earned.<br>
          Secondly, Do your own analysis and check the impact of your repayment of home loan on your monthly expenditure, as a thumb rule, it's recommended to make sure the EMI of your home loan do not exceed more than 40% of your gross monthly income.<br>
          <br>
          <b>Interest rates best suited</b> <br>
          An important factor that goes into your EMI calculations is the interest rates, which may vary from bank to bank, so do compare them. Also do a complete and detailed analysis of the various options like the interest rates i.e. fixed and floating rate of interest. <br>
          Thirdly, if two banks give you the same amount of loan but at different interest rates do your math and work out what's best for you.<br>
          <br>
          <b>Fixed interest loans</b> charge an interest, which remains the same through out the tenure of the loan. This means that the consumer is immune to market risk or the possible upward movement in the interest rates.<br>
          Hence, fixed rate is a good option when the <a href="http://www.deal4loans.com/home-loans-interest-rates.php" title="home loan interest rates">home loan interest rates</a> are expected to move up in the future.<br>
          <br>
          As for <b>floating rate loan,</b> a consumer is exposed to market risk and his gain or loss depends on the interest rate condition prevailing in the market. Floating rate is beneficial if the interest rate falls in the future. A floating rate is considered non-transparent and is also known as 'adjustable rate'.<br>
          <br>
          Fourthly, if you decide to opt for a fixed rate loan, you can still switch to a floating rate loan in the future and vice versa as and when rates go in your favour and if you do decide to switch, you should take into account the cost of doing so and the <a href="http://www.deal4loans.com/home-loans-interest-rates.php" title="home loan rate">home loan rate</a> benefits of switching. <br>
          <br>
          For a given interest rate, loan with a daily or monthly reducing balance is better than an annual reducing balance loan. Interest rates vary depending on the tenure of the loan, the amount of the loan and your personal profile. <br>
          <br>
          <b>Insurance cover (an added cost)</b> Also, many banks may insist on getting your home insured to safeguard their interest. 
          There are various kinds of insurance covers available for you. Apart from getting the mandatory ones you should try to get insurance as per your circumstances. You also have a choice of getting insured from another company without any objection from your bank.<br>
          <br>
          <b>Other costs</b> The interest rates and EMIs are not the only cost factor. A 1% administration fee and a 1% processing fee on a Rs.10 lac loan, would amount to Rs.20,000.<br>
          <br>
          Processing fees, administration fees, valuation fee, legal fee, is to be paid when you apply for a loan and other fees paid at closing. Many of these fees are negotiable. You should ask for zero processing fees and zero-penalty for pre-payment option. If this were not available, then lowest cost would be better.<br>
          <br>
          Make sure you work out as to how much these other costs add up to. So even though the interest rate may be lower, it usually adds up to being expensive.  If the EMIs may come out a lot more than what you can afford on a monthly basis; try to redo the math with changes in the tenure and loan amount (if possible).<br>
          <br>
          <b>Document required</b> Most importantly, all deals and offers agreed upon are supported by relevant papers. Self employed and salaried require different documents to support the deal.<br>
          So make sure you always ask for a letter on the banks letterhead mentioning the likes of, exact rate of interest, processing fees, pre-payment charges along with interest-schedule. <br>
          Before signing the documents, make sure you recheck all terms and conditions.<br>
          Do make sure you understand and agree with each of the clauses in the documents. Do not sign any blank documents. Even if it takes you a few hours to fill-up the form, please do so.<br>
          Do not leave anything for the executive to fill-up. It's always better to get a legal opinion from someone on your loan papers.<br>
          Do not under any circumstance give any false information. This may amount to fraud and could land you in trouble.<br>
          <br>
          <b>Penalties</b> Once you have received the loan do your best to pay it back as quickly as possible. But this early payment might invite a pre-payment clause.<br>
          Banks make their money off the interest they charge and the sooner you pay back a loan the less money you will have to pay in interest. When it comes to Home loans, penalties are binding, like if you chose to pay up your entire money before the tenure, a Pre-payment penalty is charged. So you should know about such penalties beforehand to avoid future misunderstanding between you and the bank.<br>
          </span> </div>
       <div style="text-align:right"><img src="images/arrow.gif"  /> <a href="#"  style="color:#0f8eda;">Back to Top</a></div>
      </div>
    </div>
     <?php include "right-widget.php"; ?>
  </div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>