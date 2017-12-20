<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Loan Interest Rate - Compare Car Loan Rates <?php echo DATE('F'); ?> 2017</title>
<meta name="keywords" content="Car Loan Interest rate, Compare Car Loan Interest Rate, car loan rates, car loan interest rates India, car loan rates India, comparison car loan rates, compare car loan rates, car loan rate." />
<meta name="description" content="Find all banks latest Car Loan Interest Rates: Compare Government banks, private banks interest rates on car loans (Floating and Fixed Rates)in India at Deal4loans.com."/>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/car-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
$atagleft = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0" />';
?>
<div style="clear:both; margin-top:70px;"></div>
<div class="cl_inner_wrapper">

<div class="common-bread-crumb" style="margin:auto; width:100%; height:11px; color:#0a8bd9; font-size:14px;"><a href="index.php" style="font-size:14px;">Home</a> <strong style="font-size:12px;"> &gt; </strong> <a href="car-loans.php"><span class="text12" style="color:#0a8bd9; font-size:14px;">Car loan</span></a> <strong style="font-size:12px;"> &gt; </strong> <span style="color:#4c4c4c;"> Car Loan Interest Rates </span></div>
  <div style="clear:both; height:5px;"></div><br />

  <h1 class="cl-h1">Car Loan Interest Rates</h1>
  <span style="font-size:12px; font-weight:normal;">(Last updated on <?php echo date('d F Y'); ?>)</span>
  <div>
  <?php 
	$retrivesource="CL Interest Rate";
$subjectLine="Get Best Interest Rates on Car loans with Deal4loans.com";
	include "car-loans-widget.php"; ?><br />
    <h3>Compare interest rates of top 20 Car loan banks in India</h3>
 <table border="1" width="100%">
<tbody>
<tr>
<td><strong>Car loan company</strong></td>
<td><strong>Interest Rates</strong></td>
<td><strong>EMI per Rs 1 lakh</strong></td>
<td><strong>Processing fee</strong></td>
</tr>
<tr>
<td>Axis Bank Ltd</td>
<td>11.00% - 12.00%</td>
<td>Rs. 2174 - 2224</td>
<td>Rs. 3500 to Rs. 5500</td>
</tr>
<tr>
<td>Bank of Baroda</td>
<td>8.60% - 10.35%</td>
<td>Rs.2056 - 2142</td>
<td>0.50% of Loan amount</td>
</tr>
<tr>
<td>Bank of Maharashtra</td>
<td>8.75% - 9.25%</td>
<td>Rs.2064 - 2088</td>
<td>0.25% of the Loan Amount (Min.:Rs.500/-)</td>
</tr>
<tr>
<td>Canara Bank</td>
<td>8.70% - 8.95%</td>
<td> Rs.2061- 2073</td>
<td>0.25% on the loan amount with a minimum of Rs.1000/- and maximum of Rs.5000/-</td>
</tr>
<tr>
<td>Central Bank of India</td>
<td>8.80%</td>
<td>Rs.2066</td>
<td>0.50% of loan amount with Minimum Rs. 2000/- and Maximum upto Rs 20,000/-</td>
</tr>
<tr>
<td>Corporation Bank</td>
<td>9.40% - 9.90%</td>
<td>Rs.2095 - 2120</td>
<td width="129">1% of the loan amount subject to minimum Rs.1000/‐</td>
</tr>
<tr>
<td>HDFC Bank</td>
<td>9.25% - 11.25%</td>
<td>Rs.2088 - 2187</td>
<td>0.4% of Loan Amount or Rs.10000, whichever is lower</td>
</tr>
<tr>
<td>ICICI Bank Ltd</td>
<td>9.35% - 14.74%</td>
<td>Rs.2093 - 2365</td>
<td>Rs.2500/- to Rs.5000/-</td>
</tr>
<tr>
<td>IDBI Bank Ltd</td>
<td>9.90%</td>
<td>Rs.2120</td>
<td>N.A</td>
</tr>
<tr>
<td>Union Bank of India</td>
<td>8.90%</td>
<td>Rs.2071</td>
<td>N.A</td>
</tr>
<tr>
<td>Oriental Bank of Commerce</td>
<td>8.35% - 9.10%</td>
<td>Rs. 2044 - 2081</td>
<td>0.50%, min. Rs 500/- &amp; max. Rs 7000/- plus ST.</td>
</tr>
<tr>
<td>Punjab National Bank</td>
<td>8.65% - 9.15%</td>
<td>Rs.2059 - 2083</td>
<td>Rs 100/- + service tax</td>
</tr>
<tr>
<td>State Bank of India</td>
<td>9.20% - 9.25%</td>
<td>Rs.2086 - 2088</td>
<td>0.50% of Loan Amount +ST</td>
</tr>
<tr>
<td>Uco Bank</td>
<td>9.00%</td>
<td>Rs.2076</td>
<td>1% of the loan amount maximum Rs.1500/-</td>
</tr>
<tr>
<td>Bank of India</td>
<td>9.25%</td>
<td>Rs.2088</td>
<td>Rs. 500/- Plus S.T.</td>
</tr>
<tr>
<td>United Bank of India</td>
<td>9.00% - 9.05%</td>
<td>Rs.2076 - 2078</td>
<td>0.50% of the loan amount sanctioned subject to minimum of Rs.500/- and maximum of Rs.10,000/-</td>
</tr>
<tr>
<td>Syndicate Bank</td>
<td>9.40%</td>
<td>Rs.2096</td>
<td>Nil</td>
</tr>
<tr>
<td>Dena Bank</td>
<td>9.00% - 9.10%</td>
<td>Rs.2076 - 2018</td>
<td>Rs 500/- irrespective of loan amount.</td>
</tr>
<tr>
<td>Indian Overseas Bank</td>
<td>9.05%</td>
<td>Rs.2078</td>
<td>N.A</td>
</tr>
</tbody>
</table>

    </div>
    <br />
    <b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
    Banks/ Financial Institutions can contact us at <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.
    <div style="text-align:right"><img src="images/arrow.gif"  /> <a href="#"  style="color:#0f8eda;">Back to Top</a></div>
  </div>
  <?php #include "responsive_footer.php"; ?>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>