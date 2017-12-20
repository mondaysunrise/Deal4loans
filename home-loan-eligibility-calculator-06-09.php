<?php
ob_start( 'ob_gzhandler' );
require 'scripts/functions.php';
require 'scripts/db_init.php';
require 'scripts/home_loan_eligibility_function.php';
session_start();

function DetermineAgeFromDOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;  if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }
$maxage=date('Y')-62;
$minage=date('Y')-18;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Net_Salary = $_POST['Net_Salary'];
	$getnetAmount = ($Net_Salary /12);
	$loan_amount = $_POST['Loan_Amount'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dateofbirth = $year."-".$month."-".$day;
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	$total_obligation = $_POST['total_obligation'];
	$netAmount=($getnetAmount - $total_obligation);
	$strCity = "Delhi";
	$property_value = $_POST['Property_Value'];
	$_SESSION['property_value'] = $property_value;
	$_SESSION['loan_amount'] = $loan_amount;
	$_SESSION['Net_Salary'] = $Net_Salary;
	$_SESSION['day'] = $day;
	$_SESSION['month'] = $month;
	$_SESSION['year'] = $year;
	$_SESSION['total_obligation'] = $total_obligation;
}
function money_F($number)
{
	setlocale(LC_ALL, 'en_IN');
 	$strnumber=money_format('%i', $number);
	list($First_num,$Last_num) = split('[ ]', $strnumber);
	$money_strnum = substr(trim($Last_num), 0, strlen(trim($Last_num))-3);
	$getmoney_term[]= $money_strnum;
	return($getmoney_term);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Eligibility Calculator for SBI, HDFC, Axis, ICICI, LIC, PNB, Union Bank</title>
<meta name="keywords" content="home loan eligibility calculator, housing loan eligibility calculator, home loan eligibility" />
<meta name="Description" content="Home Loan Eligibility calculator. Calculate your home loan eligibility using deal4loans Online Tool Its Works on the basis of income, age, Occupation, City." />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>
<?php include "middle-menu.php"; ?>
<div  class="hl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="d4l_inner_wrapper">
    <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">
      <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> > <span>Home Loan Eligibility Calculator </span></div>
      <h1 class="hl-h1">Home Loan Eligibility Calculator</h1>
    </div>
    <div style="clear:both; height:15px;"></div>
    <?php $newsource="Home Loan Calc";
$subjectLine="Home Loan Eligibility Calculator";
$subjectLine2=" - Get Instant Free Quote from Top 10 Banks. ";
$subjectLine3=" Minimum Tenure - 6 Months ";
//include "home-loans-widget.php";
include "widget-home-loans-06-09.php";
 ?>
    <div style="clear:both;"></div>
    <div style=" width:98%; height:auto; margin-top:5px; margin-left:10px; text-align:justify;">
      <div class="overflow-width">
        <table width="100%"  cellpadding="0" cellspacing="0">
          <tr>
            <td align="right" style="margin-top:3px;"><div style="width:160px; float:right;">
                <div align="left">
                  <div align="right" style="width:77px; float:left; margin-top:7px;"> 
                    <!-- Place this tag in your head or just before your close body tag. --> 
                    <script type="text/javascript" src="https://apis.google.com/js/platform.js"></script> 
                    <!-- Place this tag where you want the share button to render. -->
                    <div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60" data-href="http://www.deal4loans.com/home-loan-eligibility-calculator.php"></div>
                  </div>
                  <div style="width:75px; float:right; margin-top:7px;">
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=535011929958266&version=v2.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-share-button" data-href="http://www.deal4loans.com/home-loan-eligibility-calculator.php" data-width="60" data-type="box_count"></div>
                  </div>
                </div>
              </div></td>
          </tr>
          <tr>
            <td><p> <span><strong>Sample Home Loan Eligibility</strong></span> - 
                Employment Status - <strong>Salaried</strong> | Annual Income - <strong>Rs. 5 Lacs</strong> | Property Value - <strong>Rs. 75 Lacs</strong> | Tenure - <strong>20 Yrs</strong></p></td>
          </tr>
          <tr>
            <td bgcolor="#EBEBEB"><table width="100%" align="center" cellpadding="1"  cellspacing="0">
                <tr>
                  <td bgcolor="#FFFFFF"><table width="100%" align="center" cellpadding="0" cellspacing="1" class="table_bgcolor_Border">
                      <tr>
                        <th width="25%" height="35" align="center" class="table_bgcolor">Bank Name</th>
                        <th width="25%" align="center" class="table_bgcolor">Interest Rate</th>
                        <th width="25%" align="center" class="table_bgcolor">Emi (per Month)</th>
                        <th width="25%" align="center" class="table_bgcolor">Eligible Loan Amount</th>
                      </tr>
                      <tr>
                        <td  height="30" align="center" bgcolor="#FFFFFF"><span class="icici_bank">ICICI Bank</span></td>
                        <td bgcolor="#FFFFFF" class="body_text1" align="center"> 9.85% (For Women)<br />
                          9.90% (For Others)</td>
                        <td bgcolor="#FFFFFF" class="body_text1" align="center">Rs.18232 (For Women)<br />
                          Rs.18295 (For Others)</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text"><strong>Rs. 1909000</strong></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" valign="middle" bgcolor="#FFFFFF"><span class="Hdfc_ltd_bank">HDFC Ltd</span></td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">9.85% - 10.35%</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.20,262 - Rs.20,967</td>
                        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2121487</td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="#FFFFFF" ><span class="fed_bank">SBI</span></td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">9.70% (For Women)<br />
                          9.75% (For Others)</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.18044 (For Women)<br />
                          Rs.18107 (For Others)</td>
                        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. <strong>1909000</strong></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="#FFFFFF" ><span class="fed_bank">FedBank</span></td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">9.95% - 10.10%</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.19234 - Rs.19433</td>
                        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2910844</td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="#FFFFFF" ><span class="fed_bank">DHFL</span></td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">9.90 %</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.20006</td>
                        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2087470</td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="#FFFFFF"  ><span class="fed_bank">LIC Housing</span></td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">10.10 %</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.24686</td>
                        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2540650</td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="#FFFFFF"  ><span class="fed_bank">Bajaj Finserv</span></td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">10.40 %</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.20826</td>
                        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2100100</td>
                      </tr>
                      <tr>
                        <td height="30" align="center" valign="middle" bgcolor="#FFFFFF"><span class="pnb_housing">PNB Housing Finance</span></td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">9.95% - 10.50%</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.19234 - Rs.19967</td>
                        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2086681</td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="#FFFFFF" ><strong>Axis Bank</strong></td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">9.85%</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.18232</td>
                        <td align="center" bgcolor="#FFFFFF" class="style100">Rs.1909000</td>
                      </tr>
                      <tr>
                        <td height="30" align="center" bgcolor="#FFFFFF"  ><strong>Allahabad Bank</strong></td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">9.95%</td>
                        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.19234</td>
                        <td align="center" bgcolor="#FFFFFF" class="style100">Rs.2000000</td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div>
      <div style="text-align:right;" class="font2"> <a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></div>
      <div class="responsive_ad" align="center"><br />
        <script type="text/javascript"><!--
google_ad_client = "ca-pub-6880092259094596";
/* New Mobile Ad */
google_ad_slot = "5972830045";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script> 
        <script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script> 
      </div>
      Following are eligible to 
      apply for a Home Loan:<br>
      •	Salaried individuals<br>
      •	Self employed professionals/businessmen <br>
      <br>
      You can include your spouse/parents/children as co-applicant if you require higher eligibility subject to maximum of three applicants. <br />
      <h3>Home Loans Eligibility Factors</h3>
      Home loans are an easy option for buying a house but getting the right amount depends on many factors and this may depend upon the factors listed below: <br />
      <br />
      <div><strong>Monthly Income</strong><br />
        The income that he earns from which he will pay his home loan emi is one of the most important factors that affect the amount of loan. So if you are salaried your per month income and if you are self employed, your yearly profit would identify your home loan max eligibility.<br />
        The loan amount basically depends upon the net income of an individual and a bank usually provides home loans up to 60 times of an individual net income. For e.g. if a person take home salary is Rs 30,000 he /she may be offered a home loan of around Rs 18 lacs. But it may not be so because a bank takes into account other factors as well while granting a loan. </div>
      <br />
      <div><strong>Other EMI</strong><br />
        Other Emi (Equally monthly installment) is the emi that we are paying to for any other Loan.</div>
      <br />
      <div><strong>Available Income</strong><br />
        The income that is left in our hand after deduction of any emi amount that we are paying for any kind of loan. Your Home Loan Eligibility Calculator will be calculated after deduction of the EMI’s that you are paying.</div>
      <br />
      <div><strong>Property Attributes</strong><br />
        Banks give max upto 85% of loan against the value of the property. So if you want a home loan for a 50 lac property max that u can get is 85% of that ie 42.50 lacs. This too if in case you have the income to give the emi of that loan. So based on Income and property value banks decide your exact home loan eligibility.<br />
        Banks also have certain specific criteria before accepting the property for granting a loan. The banks have specific norms with respect to the minimum area requirements for a flat which may be carpet area or built up area. The bank also considers the age of the property in case of an existing property, the location of the property and also the reputation of the builders constructing the property. The bank also performs a thorough analysis and inspection of the property to check whether the title is clear or not, or are there any ownership disputes, whether the bank is free from any encumbrances etc. </div>
      <br />
      <div><strong>Duration of Loan (Years)</strong><br />
        It’s one of the most important factors that one should keep in mind while taking loan. It refers to the no. of years for which the loan has to be taken. Longer the tenure higher will be the interest paid and lower will be amount of EMI to be paid and vice-a-versa. It is one of the parameters which helps in comparing the EMIs from different banks keeping it constant for relationship and easing the judgment.</div>
      <br />
      <div><strong>Interest Rate (in percentage)</strong><br />
        Today there are many lenders in the market. Every bank is offering loans whether it’s a nationalized bank, private bank or foreign bank each of them is there in the show. Every bank offers different rate of interest according to the profile of the customer. So, before finalizing a deal one should consider deals from various banks and than come to a conclusion. And aware of the fact that some people might mislead you by charging high rate of interest at reducing rate and might inform the same at flat rate of interest. So, its always advisable to check full detail with the banks and do better comparison in respect of EMIs , Tenure and Interest Rates and keeping tenure as constant with all the banks will ease your comparison and will result in better analysis, finally leading to a prudent decision.</div>
      <br />
      <div><strong>EMI</strong><br />
        EMI stands for equally monthly installment; you need to pay a particular amount for the Home loan that you have taken.</div>
      <br />
      <div><strong>Eligible Loan Amount</strong><br />
        The net loan amount for which you are eligible for your Home loan is said as Eligible Loan Amount. The loan amount that a Bank can sanction you.</div>
      <br />
      <div><strong>Credit History</strong><br />
        The credit history of an individual plays an important role in deciding the amount of loan. Credit history is basically the credit information report of an individual generated by a credit information company on the basis of individual’s credit records. On the basis of the credit information report an individual is being given a credit score. Based on the credit score a bank or any other financial institution decides whether the individual is eligible for a loan or not. The credit history is generally affected by outstanding credit card payments and any unsecured loans. In India CIBIL is a reputed credit information company and it analyses the financial records of individuals and awards them a score which is known as the "CIBIL score".</div>
      <br />
      <div><strong>Age</strong><br />
        Age also plays a crucial role in determining the eligibility for a home loan. One has to attain a minimum age of 21 to apply for a loan. The minimum age requirement may be different for different lending institution. The maximum age may vary from 58 to 65 years depending on the income source of the individual. The age also determines the tenure and EMI of the loan. For e.g. if an individual is 35 years of age and retires  at an age of 60 then his/her loan tenure will be 60-35=25 years and his /her EMI will be calculated accordingly. Longer the tenure lower will be the EMI’s. However the longer the tenure, the costlier the loan is as one ends up paying more interest rates.</div>
      <br />
      <div><strong>Co-applicant</strong><br />
        In order to enhance the eligibility for having a loan one can have a co-applicant and in this way the total eligible income for having a home loan increases and thus as a result the loan eligibility becomes higher. However bank permits only certain relationships to become the co-applicant, friends and relatives who are not blood relatives to take a loan amount jointly.</div>
      <br />
      <div> <strong>Some of the features of home loans offered by different banks</strong><br />
        <br />
        <div class="overflow-width">
          <table border="0" cellspacing="1" cellpadding="3" width="100%">
            <tr>
              <td width="25%" align="center" valign="top"  class="table_bgcolor"><p><strong>Name </strong></p></td>
              <td width="25%" align="center" valign="top" class="table_bgcolor"><p><strong> Loan Amount</strong></p></td>
              <td width="25%" align="center" valign="top" class="table_bgcolor"><p><strong>Minimum Salary    Requirements</strong></p></td>
              <td width="25%" align="center" valign="top" class="table_bgcolor"><p><strong>Tenure</strong></p></td>
            </tr>
            <tr>
              <td width="25%" valign="top" class="td_border_lrb"><p><a href="http://www.deal4loans.com/sbi-home-loan.php" target="_blank" title="Apply for SBI Home loan">SBI Home loan</a></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p> It will be determined taking into    consideration such factors as applicant’s income and repaying capacity, age,    assets and liabilities, cost of the proposed house/flat etc.</p></td>
              <td width="25%" align="center" valign="top" class="td_border_rb"><p>Not Available</p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Maximum 30 years or up to the age of 70 years of    the borrower whichever is early.</p></td>
            </tr>
            <tr>
              <td width="25%" valign="top" class="td_border_lrb"><p><a href="http://www.deal4loans.com/icici-hfc-home-loan.php" target="_blank" title="Apply for ICICI Bank Home Loan">ICICI Bank Home Loan</a></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>It depends on the repayment capability and is    restricted to a maximum of 80% of the property value.</p></td>
              <td width="25%" align="center" valign="top" class="td_border_rb"><p>Not Available<strong></strong></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Maximum 20 years</p></td>
            </tr>
            <tr>
              <td width="25%" valign="top" class="td_border_lrb"><p><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php" target="_blank" title="Apply for HDFC Ltd Home Loan">HDFC Ltd Home Loan</a></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Max amount up to 80% of the value of the property    and also depend on the repayment capacity of the individual</p></td>
              <td width="25%" align="center" valign="top" class="td_border_rb"><p>Not Available<strong></strong></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>20 years for loans under fixed rate and 30years    under adjustable rate home loan products</p></td>
            </tr>
            <tr>
              <td width="25%" valign="top" class="td_border_lrb"><p><a href="http://www.deal4loans.com/home-loan-axis-bank.php" target="_blank" title="Apply for Axis Bank Home Loan">Axis Bank Home Loan</a></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Minimum Rs 3lacs</p></td>
              <td width="25%" align="center" valign="top" class="td_border_rb"><p>Not Available<strong></strong></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Max. tenure is 25 years for salaried customers<br />
                  And 20 years for self-employed customers.<strong></strong></p></td>
            </tr>
            <tr>
              <td width="25%" valign="top" class="td_border_lrb"><p>Axis Bank-Empower home loan scheme –a home loan    for self- employed individuals</p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Minimum Rs 10 lacs<br />
                  Maximum  Rs    100lacs in tier 1 &amp; tier 2 cities and Rs 50 lacs in other cities</p></td>
              <td width="25%" align="center" valign="top" class="td_border_rb"><p>Not Available<strong></strong></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>15 years and age of the borrower should not    exceed 65 years of age at the time of maturity<strong>.</strong></p></td>
            </tr>
            <tr>
              <td width="25%" valign="top" class="td_border_lrb"><p>Bank of Baroda </p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Maximum loan amount Rs 100 lacs, maximum finance    upto 75-85% of the project cost.<br />
                  The loan eligibility is as follows<br />
                  Gross    monthly income Rs 20,000-36 times of the gross monthly salary<br />
                  More than Rs 20,000-to Rs 1 lac-48 times of   the gross monthly salary<br />
                  More than Rs1lac-84% of the gross monthly income</p></td>
              <td width="25%" align="center" valign="top" class="td_border_rb"><p>Not Available</p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Max tenure is 25 years</p></td>
            </tr>
            <tr>
              <td width="25%" valign="top" class="td_border_lrb"><p>Citibank Home loan</p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Min Rs 5 lacs and Max. up to Rs 10 crores</p></td>
              <td width="25%" align="center" valign="top" class="td_border_rb"><p>Not Available<strong></strong></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Max tenure up to 25 years.</p></td>
            </tr>
            <tr>
              <td width="25%" valign="top" class="td_border_lrb"><p>HSBC Bank</p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Min. Rs 2 lacs and max Rs 10 crore</p></td>
              <td width="25%" align="center" valign="top" class="td_border_rb"><p>Not Available<strong></strong></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>For salaried customers its 25 years and for    others 20 years</p></td>
            </tr>
            <tr>
              <td width="25%" valign="top" class="td_border_lrb"><p><a href="http://www.deal4loans.com/home-loan-lic-housing.php" target="_blank" title="Apply for LIC Housing Finance">LIC Housing Finance</a></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Min. Rs 1 lac and max. Rs 150 lacs. Generally the    loan is extended upto 85% of the property value.</p></td>
              <td width="25%" align="center" valign="top" class="td_border_rb"><p>Not Available<strong></strong></p></td>
              <td width="25%" valign="top" class="td_border_rb"><p>Max. 25 years. The term for    the loan will under no circumstances exceed the age of retirement or    completion of&nbsp;70 yrs of age whichever is earlier</p></td>
            </tr>
          </table>
        </div>
      </div>
      <h3>Check Your Eligibility For Home Loans with Various Banks</h3>
      <p>SBI, HDFC, Axis Bank, Bank of Baroda, Bank of India, Union Bank, DHFL, LIC Housing, SBP, Canara Bank, Allahabad Bank, ICICI Bank, Yes Bank, Citibank, PNB, uco bank, Indiabulls & others.</p>
      <h3>Use this tool for calculate your Home Loan Eligibility in Various Cities of India: List Below</h3>
      <p>Delhi/NCR, Mumbai, Kolkata, Chandigarh, Chennai, Bangalore, Ahemdabad, Jaipur, Aurangabad, Baroda, Bhiwadi, Bhopal, Bhubneshwar, Cochin, Coimbatore, Cuttack, Dehradun, Delhi, Faridabad, Gaziabad, Gurgaon, Guwahati, Hosur, Hyderabad, Indore, Jabalpur, Jamshedpur, Kanpur, Kochi, Lucknow, Ludhiana, Madurai, Mangalore, Mysore, Mumbai, Nagpur, Nasik, NaviMumbai, Noida, Patna, Pune, Ranchi, Raipur, Rewari, Sahibabad, Surat, Thane, Thiruvananthapuram, Trivandrum, Trichy, Vadodara, Vishakapatanam, Vizag</p>
      <div  style="clear:both;"></div>
    </div>
  </div>
</div>
<div style="clear:both; height:15px;"></div>
<?php //include "responsive_footer.php"; ?>
</div>
<div class="hide_top_menu">
  <?php 
#include "footer_pl.php";
include("footer_sub_menu.php");
?>
</div>
</body>
</html>