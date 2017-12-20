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
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Loan: Compare New & Used Car loans in India</title>
<meta name="keywords" content="car loans, New car loan, used car loan,  compare car loans, car loans eligibility, car loans documents, compare car loan banks, Car loans, Vehicle loans, auto loans.">
<meta name="Description" content="Car loans India: Check Eligibility, Rates. Opt for the best online car loan offer from HDFC, ICICI, Axis, SBI, Kotak Prime and PNB etc. Apply Online and Get Quotes Online in Minutes.">
<link href="css/personal-loan-sbi-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/car-loan-styles.css" type="text/css" rel="stylesheet" />
 
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div  class="cl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="text12" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span class="text12" style="color:#4c4c4c;">Car Loan</span> </div>


<div class="pl_left_box">
<div>
<div class="cl_left_box"><h1 class="cl-h1">Car Loan</h1>
</div>
</div>


<div style=" float:left; width:100%; height:auto; margin-top:3px; text-align:justify;"><h3 class="text" style="color:#4c4c4c; size:18px;"><b>Car Loan Trends for  <? echo Date('F Y');?></b> -</h3>
  <span class="text11" style="color:#4c4c4c; ">To have a vehicle and that too car is necessity and also the status symbol. So once you decide to buy a car you want to know that how much you can get a car loan and what would be the interest rate and EMI that you will have to pay. The total interest will let you how much you are gonna pay for the interest part if you take a car loan.
<br />
<br />
<b>Car Loan applications received for <img src="new-images/rupees.gif" /> <? //echo number_format($row1['ttlcnt']);  <? 
$result1 = ("SELECT sum( `Amount` ) AS ttlcnt FROM `totalLoans` WHERE ( id =3 )");
list($Getnum,$row1)=Mainselectfunc($result1,$array = array());

//$row1 = mysql_fetch_array($result1);
$fVal = substr(trim($row1['ttlcnt']), 0, strlen(trim($row1['ttlcnt']))-7);
echo $plVal = number_format($fVal)." crores";
?> till <? echo Date('d F Y');?></b>
<br />
  </span>
</div>
<div style="clear:both;"></div>

<div>
<?php $retrivesource="CL Main Page";
	$subjectLine="Compare Car Loan Rates - Eligibility - Process of All Banks.";
	include "car-loans-widget.php"; ?>
</div>
<div class="cl_text_wrapper_a"><div class="text11" style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify; color:#4c4c4c;">* Quotes are totally free for customers<br />
</div>

<div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;">
 <span class="text11" style="color:#4c4c4c; ">
<b>For EG: If you take a car loan of 4 lakhs for 4 years and at rate of 10.00%.</b><br />

Your EMI will be Rs.10,145 and by paying for 4 years you will give an extra of Rs.86,961 as interest. So if you are okay to pay that extra amount, go for the car loan.<br />

To check how much you are paying extra, check <a href="http://www.deal4loans.com/car-loan-interest-rate.php">interest rates</a> and calculate EMI through Our <a href="http://www.deal4loans.com/car-loan-emi-calculator.php">calculator</a>.<br />
 <br />
The other function is that how much Bank is ready to give you- How much car loan can I get ?<br />
<br />
Banks to give car loan see your income and ability to pay and also see what is the total value of the car.

So banks give 80-85% value of the car but also check whether you have income and enough surpluses to pay the EMI every month.
<br />
To figure out your ability to pay car loan - Banks check what your income is and what the other Emi you are paying are.
<br />
They deduct the Emi and on the rest disposable income can give you 50-60% equal to you income.

 <br />
<br />
For E.g
<br />
Income – 30000 per month 
<br />
Existing  Emi  - 8000 ,  So Net income=22000 , so your emi can go upto 60% of 22000 which is then divided by emi per lac and hence your loan amount is identified.<br />
<div class="cl_pie_hide"><img src="new-images/cl_Incomegraphics.jpg"  width="640" height="181"/></div>

Now when you know how much you want to pay extra for Car loan and how much an average you can get, it is important to pick the best Bank.<br>
</span>
</div>

<div style=" float:left; width:100%; height:auto; margin-top:5px;  margin-bottom:5px;text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px;">

<h3 style="font-weight:normal;">
The Banks who are Giving Car loans in India are as follows</h3></span>
  <table width="100%" border="1" cellpadding="4" cellspacing="0">
    <tr>
      <td width="0" height="60" class="text11" style="color:#4c4c4c; " align="center"> <b>HDFC Bank Car Loan</b><br />
        HDFC Provides a Quick and Easy car loan with Easy    Documents, EMI Options and Low Interest Rates… <a href="http://www.deal4loans.com/loans/car-loan/hdfc-car-loan-eligibility-interest-rates-and-documents-requirement-for-apply-hdfc-bank-car-loans/">Read More</a></td>
      <td width="0" height="60" class="text11" style="color:#4c4c4c; " align="center"><b>SBI Car Loan</b><br />
        Lowest interest rate, Low    processing fee, processed through speedy delivery channels with total    transparency….<a href="http://www.deal4loans.com/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/">Read More</a></td>
    </tr>
    <tr>
      <td width="0" height="60" class="text11" style="color:#4c4c4c; " align="center"><b>ICICI Bank Car Loan</b><br />
        Compare Interest Rates,    EMI, Documents and Eligibility for ICICI Car loan. Apply online for car    loan…..<a href="http://www.deal4loans.com/loans/car-loan/icici-bank-car-loans/">Read More</a></td>
      <td width="0" valign="top" class="text11" style="color:#4c4c4c; " align="center"><b>Axis Bank Car Loan</b><br />
        Compare and Choose Interest Rates,    Documents, EMI, and Features of Axis Bank Car Loan…<a href="http://www.deal4loans.com/loans/car-loan/axis-bank-car-loan-interest-rates-eligibility-apply-online-axis-car-loan/">Read    More</a></td>
    </tr>
    <tr>
      <td width="0" height="60" class="text11" style="color:#4c4c4c; " align="center"><b>Kotak Mahindra Car Loan</b><br />
        flexible schemes to suit    your needs, hassle-free documentation and quick processing….<a href="http://www.deal4loans.com/loans/car-loan/kotak-car-loans-eligibility-documents-interest-rates-apply/">Read More</a></p></td>
      <td width="0" valign="top" class="text11" style="color:#4c4c4c; " align="center"><b>Bank of India Car Loan</b><br />
        Get Details on Eligibility, EMI,    Interest Rates, Documents, Eligibility of BOI Car Loans…<a href="http://www.deal4loans.com/loans/car-loan/bank-of-india-car-loan-eligibility-interest-rates-documents-apply/">Read    More</a></p></td>
    </tr>
   
  </table>
<div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;">
<span class="text11" style="color:#4c4c4c;"><b>How to choose which is the best Bank in above to get Car loan</b><br />

These are the points of comparision<br />

<b>1.</b> Interest rate charged by Banks<br />

<b>2.</b> Processing fee charged by Banks.<br />

<b>3. </b>Prepayment Charges in case you can afford to pay earlier.<br />
<bR />

 

So if you multiply  the emi per month that you get from Bank and add the processing fee and deduct the loan amount , you will get to know how much extra you are paying for the loan and which is the cheapest for you.<br />
<img src="new-images/cl_Pie-image.jpg"  width="267" height="163" align=""/>
</span>
</div>
<div style="width:100%;"><span class="text11" style="color:#4c4c4c; size:18px;">
<b>Are the Car loan rates different for different people?</b><br />
Yes Banks do give preferences to certain set of customers for lower rates and fees.<br /><br />
<b>The factors are :</b><br />
<b>1.</b> Its gives lower rates who have the salary accounts with the same Bank.<br />

<b>2.</b> It gives lower rates to employees of top 5000 companies in India.<br />

<b>3.</b> Based on your income per month you might get some waivers or on the total loan amount you may get cheaper rates.<br />
 <br />

<b>How does Cibil and Credit Bureau effect my application?</b><br />

Yes, your car loan application can be rejected if your credit score is not good. Here are few things that you should know.
A cibil or credit score of above 750 will get you approval from all Banks. From 650 -750 there will be certain Nbfc who may be able to give you loan.<br />

If you haven't taken any credit card or loan your cibil score is 0 and there will be less Banks to give you loan at that time and best is to approach the bank where you have account.<br />
If you have applied and have got rejected your cibil score and it’s your first loan then your score is -1 and most Banks will not give you loan.
<br />
<br />
<b>Special offers on Cars</b><br />
On time to time basis Banks have tie ups with car manufactures and they give discounts via lower rates.<br /><br />
The recent such offers are<br />
<b>1.</b>	0 % Foreclosure charges on new car loans post completion of 24 months on Maruti Hyundai Toyota and Honda Cars.<br />
<b>2.</b>	Special Schemes on Renault Duster, Mahindra XUV 500.<br />
<b>3.</b>	Discount Schemes on Hyundai Cars up to Rs.150000 (*<a href="http://www.deal4loans.com/loans/cars-india/hyundai-car-loan-interest-rates-apply-online/">View More</a>)
</span></div></div>
</div>
<div style="clear:both;"></div>

</div> 
<?php include "RightCL.php"; ?>
<div style="clear:both;"></div>
<?php include "responsive_footer.php"; ?>
<div style="clear:both;"></div>
</div>
<div class="hide_top_menu"><?php include("footer_sub_menu.php"); ?></div>
</body>
</html>
