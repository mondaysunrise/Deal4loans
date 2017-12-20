<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
$subjectLine = "Compare Car Loan Rates - Eligibility - Process of All Banks.";
$retrivesource = "CL Main Page";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Loan - New & Used Car loans in India <?php echo DATE('F'); ?> 2017</title>
<meta name="keywords" content="car loans, New car loan, used car loan,  compare car loans, car loans eligibility, car loans documents, compare car loan banks, Car loans, Vehicle loans, auto loans.">
<meta name="Description" content="Best Car loans in India: Check Quotes on &#10004;  Eligibility &#10004; Low Interest Rates &#10004;  Instant e-Approval &#10004; Quick Apply. Compare Online car loan offer from HDFC, ICICI, Axis, SBI, Kotak Prime and PNB etc.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/car-loan-styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div  class="cl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="text12" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span class="text12" style="color:#4c4c4c;">Car Loan</span> </div>
  <div class="cl_left_box">
    <h1 class="cl-h1">Car Loan</h1>
    <div> <span>Want to bring home your dream car, but don't have enough funds? Now, you don't need to wait for some more months or years to buy your dream car as you can take a car loan to meet your fund requirement. We can make this drive easy for you, apply for a car loan with deal4loans.com and become pride owner of your dream car.</span> <br />
      <br />
      <span><h3>Benefits of comparing car loan with Deal4loans.com</h3>
      Deal4loans is India’s largest loan comparison service offering company. For trusted advice on various loan products and solutions on your financial needs, you can rely on us. We have tie-ups with leading banks and financial institutions providing car loans. We can assure you that you will get the best deals and offers at Deal4loans, which you can find nowhere else. Our user-friendly website enables you to compare all offerings in the market and make a well calculated choice.<br />
      <br />
      <b>Car Loan applications received for <img src="new-images/rupees.gif" alt="rupees" width="8" />
      <? //echo number_format($row1['ttlcnt']);  <? 
$result1 = ("SELECT sum( `Amount` ) AS ttlcnt FROM `totalLoans` WHERE ( id =3 )");
list($Getnum,$row1)=Mainselectfunc($result1,$array = array());

//$row1 = mysql_fetch_array($result1);
$fVal = substr(trim($row1['ttlcnt']), 0, strlen(trim($row1['ttlcnt']))-7);
echo $plVal = number_format($fVal)." crores";
?>
      till <span class="greentext"> <? echo Date('d F Y');?></span></b> <br />
      </span> </div>
    <div style="clear:both;"></div>
    <div>
      <?php 
	$retrivesource="CL Main Page";
	$subjectLine="Compare, Calculate & Save more on Interest Rates & EMIs";
	include "car-loans-widget.php";
 ?>
    </div>
    <div>
      <div>* Quotes are totally free for customers<br />
      </div>
      <br />
      <div> <span> <h3>Features of Car loans:</h3>
       A Car loan is a great way to drive your dream car without making the complete payment upfront. Some other traits which make a car loan more feasible are:<br />
        <br />
        &#10004; Flexible contract terms and comfortable tenure of loan i.e. upto 7 years<br />
        &#10004; Competitive and attractive rates of interests<br />
        &#10004; A tax deduction may be applicable if the vehicle is to be used for business purposes<br />
        &#10004; Almost everyone with a Permanent Income can apply for a car loan<br />
        &#10004; Some banks offer up to 100% of car finance on ex-showroom price and generally upto 85% of car finance on ex-showroom price is available.<br />
        &#10004; Very low processing fees and prepayment charges.<br />
        </span> </div>
      <div>
      <h3>Check your Eligibility for a Car loan:</h3>
The certain factors that determine your eligibility for a car loan are:<br />
&#10004; Age<br />
&#10004; Kind of employment<br />
&#10004; Income<br />
&#10004; Period of employment<br />
&#10004; Previous running EMI's and CIBIL score<br /><br />
You can check your eligibility and get quotes by updating all information in our eligibility calculator.<br />
<h3>Car loan interest rates can be vary from user-to-user based on different parameters. Some of these factors are:</h3>
<ol>
<li>Banks give lower interest rates to the employees who have salary accounts with the same bank.</li>
<li>It gives lower interest rates to employees of top 5000 companies of India.</li>
<li>Based on your income per month you might get some waivers or on the total loan amount you may get cheaper rates.</li>
</ol>

      
      </div>
      <div><span>
        <h3>Banks giving Car loans in India:</h3>
        </span>
        <table width="100%" border="1" cellpadding="4" cellspacing="0">
          <tr>
            <td width="0" height="60" align="center"><b>HDFC Bank Car Loan</b><br />
              HDFC Provides a Quick and Easy car loan with Easy Documents, EMI Options and Low Interest Rates… <a href="http://www.deal4loans.com/loans/car-loan/hdfc-car-loan-eligibility-interest-rates-and-documents-requirement-for-apply-hdfc-bank-car-loans/">Read More</a></td>
            <td width="0" height="60" align="center"><b>SBI Car Loan</b><br />
              Lowest interest rate, Low processing fee, processed through speedy delivery channels with total  transparency….<a href="http://www.deal4loans.com/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/">Read More</a></td>
          </tr>
          <tr>
            <td width="0" height="60" align="center"><b>ICICI Bank Car Loan</b><br />
              Compare Interest Rates,    EMI, Documents and Eligibility for ICICI Car loan. Apply online for car    loan…..<a href="http://www.deal4loans.com/loans/car-loan/icici-bank-car-loans/">Read More</a></td>
            <td width="0" valign="top" align="center"><b>Axis Bank Car Loan</b><br />
              Compare and Choose Interest Rates,    Documents, EMI, and Features of Axis Bank Car Loan…<a href="http://www.deal4loans.com/loans/car-loan/axis-bank-car-loan-interest-rates-eligibility-apply-online-axis-car-loan/">Read    More</a></td>
          </tr>
          <tr>
            <td width="0" height="60" align="center"><b>Kotak Mahindra Car Loan</b><br />
              flexible schemes to suit    your needs, hassle-free documentation and quick processing….<a href="http://www.deal4loans.com/loans/car-loan/kotak-car-loans-eligibility-documents-interest-rates-apply/">Read More</a>
              </p></td>
            <td width="0" valign="top" align="center"><b>Bank of India Car Loan</b><br />
              Get Details on Eligibility, EMI,    Interest Rates, Documents, Eligibility of BOI Car Loans…<a href="http://www.deal4loans.com/loans/car-loan/bank-of-india-car-loan-eligibility-interest-rates-documents-apply/">Read    More</a>
              </p></td>
          </tr>
        </table>
        <br />
        <div> In India, we have 35 corporations for financing Car/Auto loans. <strong>Let us take a look which banks are the favorites of Indian borrowers when it comes to Car Loans:</strong><br />
          <span><h3>Market share of major banks in Car/Auto Loan category:</h3>
          
          
          
          
          <table width="100%" border="0" cellspacing="1" cellpadding="0" class="table_bgcolor_Border">
  <tr class="table_bgcolor">
    <td height="30"><strong>Bank</strong></td>
    <td><strong>Market Share in Car loans</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25">HDFC Bank</td>
    <td>26%</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25">SBI</td>
    <td>22%</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25">Kotak Mahindra Bank</td>
    <td>16%</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25">ICICI Bank</td>
    <td>14%</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25">Axis Bank</td>
    <td>10%</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25">Others</td>
    <td>12%</td>
  </tr>
  
</table>

       <br />   
     
          <img src="new-images/market-share-in-car-loan.jpg"  width="493" height="306" alt="market share in Car loan"/>        
          
          
          
          
          
       </span> </div>
        
      </div>
    </div>
    <div style="clear:both;"></div>
  </div>
  <?php include "RightCL.php"; ?>
  <div style="clear:both;"></div>
  <?php #include "responsive_footer.php"; ?>
  <div style="clear:both;"></div>
</div>
<div class="hide_top_menu">
  <?php 
#include "footer_cl.php";
include("footer_sub_menu.php");
?>
</div>
</body>
</html>