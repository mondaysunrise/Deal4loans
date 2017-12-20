<?php
ob_start( 'ob_gzhandler' );
require 'scripts/functions.php';
require 'scripts/db_init.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EMI Calculator – Deal4loans.com</title>
<meta name="keywords" content=="Emi calculator, Emi calculator India, calculate monthly EMI, emi calculator online, best emi calculator, loan emi calculator, deal4loans emi calculator">
<meta name="Description" content="EMI calculator – Use deal4loans emi calculator tool to calculate your monthly emi for loans. ✍ free emi calculator for users to calculate loan emi’s online in seconds." />
<meta http-equiv="Expires" content="0"/>
<?php 
if(strlen($_GET['source'])>0)
{
	echo '<link rel="canonical" href="http://www.deal4loans.com/Contents_Calculators.php"/>';
}
?>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="sourcenew.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<!--<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>-->
<!--<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>-->
<script async src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script src="scripts/highcharts.js"></script>
<script src="amort1.js"></script>
<!--<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />-->
<style>
div, h4,p  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px Arial, Helvetica, sans-serif;    color: #00000;}
#emisum { background: none repeat scroll 0pt 0pt #fcfcfc; clear: both; float: left; width: 240px; margin: 0pt 10px 20px 0pt; border: 5px solid #547295; height: 240px; }
#emisum div { margin: 0pt 0pt 16px; padding: 10px 10px 0pt; text-align: center; width: 220px; border-top: 1px dotted rgb(147, 79, 79); }
#emisum h4 { color: #934f4f; font-weight: bold; }
#emisum p { font-size: 18px; font-weight: bold; margin: 0pt auto; }
#emisum span { padding-left: 5px; }
#emiamount { border-top: 0pt none ! important; }
#emiamount p { font-size: 24px; }
.common-comment-wrapper{ width:970px; margin:auto;}

.emi_right_box{ float:left; width:340px; border:5px solid #547295;}
.emi_sum_amount{ float:left; padding:5px; width:228px; }
.emi_sum_value{ float:right; padding:5px; font-size:13px; font-weight:bold; width:90px;}
.default_td
 {
 border: 1px solid #DBDAD7;background: #fffff; border-top: 0; font: 11px Arial, Helvetica, sans-serif;}
 
 @media screen and (max-width: 768px) {
 .common-comment-wrapper{ width:100%; margin:auto; display:none!important;}
 }
</style>
<link href="css/cont_calc.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">

function get_round(X) { return Math.round(X*100)/100 }
function showpay() {
 if ((document.calc.Loan_Amount.value == null || document.calc.Loan_Amount.value.length == 0) ||
     (document.calc.months.value == null || document.calc.months.value.length == 0)
||
     (document.calc.rate.value == null || document.calc.rate.value.length == 0))
 { document.calc.pay.value = "Incomplete data";
document.calc.tot_amount.value = "Incomplete data";
document.calc.tot_interest.value = "Incomplete data";
document.calc.yearly_interest.value = "Incomplete data";
document.calc.interest_pa.value = "Incomplete data";
document.calc.interest_pm.value = "Incomplete data";
 }
 else
 {
 var princ = document.calc.Loan_Amount.value;
 var term  = document.calc.months.value;
 var intr   = document.calc.rate.value / 1200;
 var yrs   = document.calc.months.value / 12;
 var exactintr   = document.calc.rate.value;
 document.calc.pay.value = get_round(princ * intr / (1 - (Math.pow(1/(1 + intr), term))));
 document.calc.tot_amount.value = get_round(document.calc.pay.value * term);
 document.calc.tot_interest.value = get_round(document.calc.tot_amount.value - princ);
 document.calc.yearly_interest.value = get_round(document.calc.tot_interest.value / yrs);
 document.calc.interest_pa.value = get_round(document.calc.yearly_interest.value / princ * 100);
 document.calc.interest_pm.value = get_round((document.calc.yearly_interest.value / princ * 100)/12);
 commitData(princ,exactintr,term);
 displayBarChart (princ,exactintr,term);
 var smpl_rsltdv = document.getElementById('smpl_rslt');
	smpl_rsltdv.innerHTML = 'Yearly Calculated Values';
 }
}

function displayBarChart (loanAmount,intRate,numPay)
{
	var monPmt=calcMonthly(loanAmount,numPay,intRate);
	var finalVal = amortizePmtsCharts(loanAmount,intRate,numPay,monPmt);
 	
	var principalAxis = [];
	principalAxis = finalVal[0];
	var intrAxis = finalVal[1];
	var catxAxis = finalVal[2];
		var sWidth = screen.width;
var totWidth;
var totHeight;
if(sWidth>680) { totWidth = 400; totHeight = 450; } else { totWidth = 250; totHeight = 300; }
	
 chart = new Highcharts.Chart({
            chart: {
                renderTo: 'barChart',
                type: 'bar',
				 width: totWidth,
				height:totHeight
            },
            title: {
                text: false
            },
            xAxis: {
                categories: catxAxis, labels:{rotation:-25}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Principal + Interest'
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ number_format(this.y) +'';
                }
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
                series: [{
                name: 'Principal',
                data: principalAxis
            }, {
               name: 'Interest',
               data: intrAxis
            }]
        });
}	
$(function () {
    var chart;
	var sWidth = screen.width;
	var totWidth;
	var totHeight;
	if(sWidth>680) { totWidth = 400; totHeight = 450; } else { totWidth = 250; totHeight = 300; }
    $(document).ready(function() {
	var catxAxis = new Array('Year 1','Year 2','Year 3','Year 4','Year 5','Year 6','Year 7','Year 8','Year 9','Year 10','Year 11','Year 12','Year 13','Year 14','Year 15','Year 16','Year 17','Year 18','Year 19','Year 20');
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'barChart',
                type: 'bar',
			    width: totWidth,
				height:totHeight
            },
            title: {
                text:false
            },
            xAxis: {
                categories: catxAxis, labels:{rotation:-25}
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Principal + Interest'
                }
            },
            legend: {

                backgroundColor: '#FFFFFF',
                reversed: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.series.name +': '+ number_format(this.y) +'';
                }
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
                series: [{
                name: 'Principal',
                data: [31083, 34509, 38311, 42537, 47221, 52426, 58203, 64618, 71740, 79644, 88422, 98165, 108983, 120994, 134327, 149132, 165567, 183812, 204069, 226407]
            }, {
               name: 'Interest',
                data: [208533, 205107, 201305, 197079, 192395, 187190, 181413, 174998, 167876, 159972, 151194, 141451, 130633, 118622, 105289, 90484, 74049, 55804, 35547, 13056]
            }]
        });
    });
    
});

</script>
<style type="text/css"> .btnclr {  background-color: #88a943;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 90px; } </style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="intrl_txt" style="margin-top:70px; ">
<div class="text12" style="margin:auto; width:100%; height:21px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> </a> <span  class="text12" style="color:#4c4c4c;"> >EMI Calculator</span></div>
<div class="left_wrap-mob" ><div class="emi_head_text_box_a" style="width:100%;">
    <h1 class="text3"  style=" height:33; margin-top:0px; float:left; clear:right; font-size:28px; text-transform:none; color:#000;">EMI Calculator</h1><div style="clear:both;"></div><span style="font-size:12px; margin-bottom:0px; font-weight:bold;">Change Loan Amount, Interest Rate &amp; Tenure for your calculation </span></div><div style="clear:both;"></div>
    
   
<div class="emi_left_box_mobo">
  
<div class="emi_form_box_mobo">
 <form method="post" name="calc" id="calc"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="4">
      
      <tr>
        <td width="41%" height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; "  ><b>Loan Amount</b></td>
        <td width="59%"><input name='Loan_Amount' type='text' class="input_box_cal" id='Loan_Amount' onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"     onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" value='2000000' maxlength='9' />	<br> 	<span id='formatedlA' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'> 	
Rs. 20,00,000 <br /></span><span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'>Rs. twenty lakh(s).</span></td>
      </tr>
     
           <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " ><b>Interest Rate (Reducing) </b></td>
        <td class="text" style="  color:#FFF; font-size:13px; "><input name='rate' type='text' class="input_box_cal" value='10.5' maxlength='5' />
        % Per Annum </td>
      </tr>
	   <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; "   ><b> Loan Tenure</b> </td>
        <td class="text" style="  color:#FFF; font-size:13px; "><input name='months' type='text' class="input_box_cal" value='240' maxlength='10'  /> (in Months)</td>
      </tr>
            <tr>
        <td height="35" colspan="2" align="center" valign="middle" class="text" style="  color:#FFF; font-size:11px; font-weight:normal;" >
        <input name="button" type="button" class="btnclr" onclick='showpay()' value="Calculate" />
      &nbsp;&nbsp;<input name="reset" type="reset" class="btnclr" value="Reset" /></td>
        </tr>
         <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " >Calculated Monthly EMI</td>
        <td>
        <input name="pay" type="text" class="input_box_cal"  value="19967.6" readonly/>
           </td>
      </tr>
         <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " ><b>Total Amount with Interest</b></td>
        <td> <input name="tot_amount" type="text" class="input_box_cal"  value="4792224" readonly/></td>
      </tr>
         <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " ><b>Flat Interest Rate PA</b></td>
        <td> <input name="interest_pa" type="text" class="input_box_cal"  value="6.98" readonly/></td>
      </tr>
         <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " ><b>Flat Interest Rate PM</b></td>
        <td> <input name="interest_pm" type="text" class="input_box_cal"  value="0.58" readonly/></td>
      </tr>
         <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " ><b>Total Interest Amount</b></td>
        <td> <input name="tot_interest" type="text" class="input_box_cal"  value="2792224" readonly/></td>
      </tr>
         <tr>
        <td height="35" align="left" valign="middle" class="text" style="  color:#FFF; font-size:13px; " ><b>Yearly Interest Amount</b></td>
        <td><input name='yearly_interest' type='text' class="input_box_cal" style=' font-weight:bold; font-size:11px; color:#373737; ' value="139611.2" readonly /></td>
      </tr>
  </table>
 </form>
 
 </div>
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
 <div align="left">

 <div align="right" style="width:200px; float:right; margin-top:7px;">
<!-- Place this tag in your head or just before your close body tag. -->
<div style="width:70px; float:left;"><script type="text/javascript" src="https://apis.google.com/js/platform.js"></script>

<!-- Place this tag where you want the share button to render. -->
<div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60" data-href="http://www.deal4loans.com/Contents_Calculators.php"></div>
</div>
<div style="width:70px; float:left;">
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=535011929958266&version=v2.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-share-button" data-href="http://www.deal4loans.com/Contents_Calculators.php" data-width="60" data-type="box_count"></div>
</div>
  
  </div>
  <div style="clear:both;"></div>
<table align="center" width="100%">
<tr>
<td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#4572A7; font-weight:bold;">Principal + Interest<br /><img src="new-images/princnintr.gif" width="169" height="29"></td>
</tr>
<tr><td align="center"><div id="barChart"></div></td></tr>
</table></div><div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<div  class="emi_mobo_content_txt_c">
<div style="width:100%;text-align:justify;"><h2 class="text" style="color:#4c4c4c; size:18px; margin-bottom:2px;">How EMI Calculator works or Calculate EMI</h2></div>
Our <b>EMI calculator</b> is easy to use and quick to perform. Use our EMI calculator as a guide before applying for any kind of loan.<br /><br />
<b>What is an EMI Calculator?</b><br />
<p>EMI calculator let's you judge how affordable a loan can be for you. Always use the calculator to get a quick quote on your EMIs. You can calculate Home Loan EMI, Personal Loan EMI, Car Loan EMI, Education Loan EMI, Loan Against Property EMI with the EMI calculator. If the quote is satisfactory, you can apply accordingly. Follow the below given steps:</p>
<br />
•  Enter the loan amount you wish to avail in the EMI calculator.<br />
•  Then enter the loan tenure (months).<br />
•  And the rate of interest (reducing).<br />
•  Press &quot;calculate&quot;.<br />
•  Our EMI calculator will tell you just how much your EMI amount comes to. <br />
<br />
<b>Along with your EMI you also get</b>:<br/>
• total amount with interest.<br />
•  flat interest rate PA / PM.<br />
•  total interest amount.<br />
•  yearly interest amount. <br />
<br />
If you think the EMI is a bit more than you can afford, you can always re-calculate. This time enter either less loan amount or longer loan tenure in the calculator. You can also continue to re-calculate until our calculator gives you an EMI that you are satisfied with. <br />
<br />
Also, remember to compare quotes from different banks. You can do this by entering the loan amount and the rate of interest with the loan tenure of, say bank "A". See how much it amounts to. Then do the same again of bank "B". Whichever suits your needs and fits your wants, apply. <br />
<br />
In today’s scenario, banks are coming your way with bouquet of offer for your loan requirements. To have the finest deal from these banks, one should ponder to following points before cracking a deal.<br />
Don&rsquo;t be corrupted by paying high EMIs at low rate of interest<br />
<h3>Other Online Calculator &amp; Tools</h3><table width="100%" border="1"><tbody><tr><td><p><a href="http://www.deal4loans.com/home-loan-emi-calculator1.php" target="_blank"><strong>Home Loan EMI Calculator<strong></a></p></td><td><p><a href="http://www.deal4loans.com/home-loan-eligibility-calculator.php" target="_blank"><strong>Home Loan Eligibility Calculator</strong></a></p></td></tr><tr><td><p><a href="http://www.deal4loans.com/personal-loan-emi-calculator.php" target="_blank"><strong>Personal loan EMI calculator<strong></a></p></td><td><p><a href="http://www.deal4loans.com/personal-loan-eligibility-calculator.php" target="_blank"><strong>Personal loan eligibility Calculator</strong></a></p></td></tr><tr><td><p><a href="http://www.deal4loans.com/pre-payment-calculator.php" target="_blank"><strong><strong>Prepayment Calculator</strong></a></p></td><td><p><a href="http://www.deal4loans.com/part-payment-calculator.php" target="_blank"><strong>Part Payment Calculator</strong></a></p></td></tr><tr><td><p><a href="http://www.deal4loans.com/car-loan-emi-calculator.php" target="_blank"><strong>Car loan EMI Calculator</strong></a></p></td><td><p><a href="http://www.deal4loans.com/home-loan-balance-transfer-calculator.php" target="_blank"><strong>Home Loan Balance Transfer Calculator</strong></a></p></td></tr></tbody></table>
<br />
<b>Better compare EMIs with same tenure
                And then with rate of interest</b><br />
                <br />
                <b  >(1) Check your reimbursement power (EMI) :</b> You repay the loan in Equated Monthly Installments (EMI) that consists of principal as well as interest. Since you pay an equal amount every month, these payments are called equal monthly installments. The EMI depends on the amount of the loan, the interest rate and the term of the loan. It is an unequal combination of principal repayment and interest cost every month. In the beginning, bank recovers their interest payments and gradually more of the principal repayment by the end of the loan tenure. EMI amount should range maximum to the 40% of your monthly income. One should consider offers from various banks as it may differ from bank to bank. Your involvement in the process might end up in a win-win situation for you.<br />
                <br />
                <b >(2) Market around (Rate of interest):</b>Today, there are many lenders in the market and every bank is offering loans be it a nationalized bank, private bank or foreign bank. Every bank offers different personal loan rates and home loan rates according to the profile of the customer. So, before finalizing a deal one should consider deals from various banks and then come to a conclusion. Be aware of the fact that some people might mislead you by charging high rate of interest at reducing rate and might inform the same at flat rate of interest. So, its always advisable to check full detail of the banks and do better comparison in respect of EMIs , Tenure and rate of interest and keeping tenure as constant with all the banks will ease your comparison and will result in better analysis, finally leading to a prudent decision.<br />
                <br />
                <b >(3) Tenure:</b>It&rsquo;s one of the most important  factors that one should keep in mind while taking loan. It refers to the no. of  years for which the loan has been taken. Longer the tenure, higher will be the  interest paid and lower will be amount of EMI to be paid and vice-a-versa. It  is one of the parameters which helps in comparing the EMIs from different banks  keeping it constant for relationship and easing the judgement.<br />
                <br />
                <b >(4) Loan Disbursal Time:</b> Loan disbursal time is the period in which loan is processed and the customer receives the demand draft from the bank. Disbursal time differs from bank to bank. It is an important factor because there is always a reason behind taking a loan if the opportunity of that objective is lost then it is of no use. So, better ask your bank the Turn Around Time and take the loan considering your urgency or better plan it in advance.<br />
                <br />
                <b >(5) Processing Fee, Administrative Charges &amp; Pre-Payment Charges:</b> When you borrow, your loan carries other charges as well apart from interest that may include Processing Fee which bank charges to process your file and pays to the processing hubs, charges may vary from 1-2% of the loan amount sanctioned by bank. Besides this, there are Pre-Payment Charges also which the loan carries for the Pre-Closure of the Loan. So, it is always advisable to take loan which has no penalty for the pre-closure of loan because it might happen in the long-run you might have enough money to pay your debt and thereby save interest on the same or you can have the opportunity to get your loan tranferred at low rate of interest. <br />
				
                <br />
                <b >(6) Insurance Facility:</b> Some bank offers insurance facility by charging small amount of premium which is added to the EMI paid for the loan amount and the person is insured for the amount he has taken loan. Just in case something  unexpected happens, the assured amount will be given to  the bank without burdening the members of the family.<br />
                <br />           
    </div>
</div>
<div class="rihgt_wrap-mob"  ><?php include "RightEmiCalcdemo.php"; ?></div>
</div>

</div>
<div style="clear:both;"></div>
<?php 
#include "footer1.php";
include("footer_sub_menu.php"); 
?>
</body>
</html>