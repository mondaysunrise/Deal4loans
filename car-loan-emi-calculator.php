<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/functions.php';
require 'scripts/db_init.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Loan EMI Calculator <?php echo DATE('F'); ?> 2017 – Calculate EMI Online</title>
<meta name="keywords" content="car loan emi calculator, car loan calculator, calculate car loan emi, used car loan emi calculator">
<meta name="description" content="Car Loan EMI Calculator: Deal4loans.com provides simple tool to calculate EMI for New & Used Cars on the basis of Interest rate, Repayment tenure, loan amount from SBI, HDFC, Axis, PNB, ICICI, Union Bank, PNB, Bank of Baroda and all other banks instantly.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/car-loan-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="/style/jquery_ui_css.css" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script src="amort1.js"></script>
<link href="css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet" />
<style>
div, h4,p  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px;    color: #00000;}
.emi_right_box{ float:left; width:340px; border:5px solid #547295;}
.emi_sum_amount{ float:left; padding:4px; width:235px;   font-size: 14px; }
.emi_sum_value{ float:right; padding:4px; font-size:14px; font-weight:bold; width:84px !important;}

.default_td
 {
 border: 1px solid #DBDAD7;background: #fffff; border-top: 0; font: 13px;}
@media screen and (max-width:680px){

.emi_sum_value {
  float: right;
  padding: 4px;
  font-size: 14px;
  font-weight: bold;
  width: 66px !important;
}
}

</style>
<script>
//loan amount
$(function() {
		$( "#slider_la" ).slider({
		range: "min",
		value: 300000,
		min: 100000,
		step: 50000,
		max:  2000000,
		slide: function( event, ui ) {
			$( "#amount_1a" ).val( "" + ui.value );
		}
		,change:function(){EMI_calc()}
	});
	$( "#amount_1a" ).val( "" + $( "#slider_la" ).slider( "value" ) );
	$('#amount_1a').change(function () {
		 var value = this.value, selector = $( "#slider_la" );
		selector.slider("value", value);
	});
});

/*$(function() {
			$( "#amount_1a" ).onchange({
			range: "min",
			value: 300000,
			min: 100000,
			step: 50000,
			max:  2000000,
			/*slide: function( event, ui ) {
				$( "#amount_1a" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_1a" ).val( "" + $( "#slider_la" ).slider( "value" ) );
	});*/

//interest rate
$(function() {
			$( "#slider_intr" ).slider({
			range: "min",
			value: 10.5,
			min: 9,
			step: .5,
			max:  40,
			slide: function( event, ui ) {
				$( "#amount_intr" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_intr" ).val( "" + $( "#slider_intr" ).slider( "value" ) );
		$('#amount_intr').change(function () {
			 var value = this.value, selector = $( "#slider_intr" );
			selector.slider("value", value);
		});
	});

//loan tenure

$(function() {
			$( "#slider_lt" ).slider({
			range: "min",
			value: 5,
			min: 1,
			step: 1,
			max:  7,
			slide: function( event, ui ) {
				$( "#amount_lt" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_lt" ).val( "" + $( "#slider_lt" ).slider( "value" ) );
		$('#amount_lt').change(function () {
			 var value = this.value, selector = $( "#slider_lt" );
			selector.slider("value", value);
		});
	});

function EMI_calc(){
		var emiPrincipal=jQuery("#amount_1a").val();
	var emiRate=jQuery("#amount_intr").val()/12/100;
	var emiTenure=jQuery("#amount_lt").val()*12;
	var emi=emiPrincipal*emiRate*(Math.pow(1+emiRate,emiTenure)/(Math.pow(1+emiRate,emiTenure)-1));
	jQuery("#emi_monthly span").text(inrFormat(Math.round(emi)));
	jQuery("#total_intr span").text(inrFormat(Math.round(emi* emiTenure-emiPrincipal)));
	jQuery("#total_amt span").text(inrFormat(Math.round(emi*emiTenure)));
	jQuery("#loan_amt span").text(inrFormat(Math.round(emiPrincipal)));
	var month_emi=Math.round(emi);
	var emi_tenure=Math.round(emiTenure);
displayPieChart(month_emi,emi_tenure,emiPrincipal);
var intRate = emiRate * 12 * 100;
commitData(emiPrincipal,intRate,emiTenure);
displayBarChart (emiPrincipal,intRate,emiTenure);
fillrates (emiPrincipal,emiTenure);

}

function inrFormat(nStr) { 
	var addCur = "Rs. ";
	 nStr += '';
     x = nStr.split('.');
     x1 = x[0];
     x2 = x.length > 1 ? '.' + x[1] : '';
     var rgx = /(\d+)(\d{3})/;
     var z = 0;
     var len = String(x1).length;
     var num = parseInt((len/2)-1);
      while (rgx.test(x1))
      {
        if(z > 0) {  x1 = x1.replace(rgx, '$1' + ',' + '$2');  }
        else   {   x1 = x1.replace(rgx, '$1' + ',' + '$2');
          rgx = /(\d+)(\d{2})/;  }
        z++;  num--;
        if(num == 0)   {   break;   }
      }
     return addCur + x1 + x2;
 }
function fillrates(emiPrincipal,emiTenure)
{
	var hdfc_rate1=10.00/1200;
	var hdfc_rate2=12.50/1200;
	var getemicalcHDFC1=emiPrincipal*hdfc_rate1*(Math.pow(1+hdfc_rate1,emiTenure)/(Math.pow(1+hdfc_rate1,emiTenure)-1));
	var getemicalcHDFC2=emiPrincipal*hdfc_rate2*(Math.pow(1+hdfc_rate2,emiTenure)/(Math.pow(1+hdfc_rate2,emiTenure)-1));
	var viewemi="Rs." + Math.round(getemicalcHDFC1) + " - Rs." + Math.round(getemicalcHDFC2);
	jQuery("#hdfc_bnk span").text(viewemi);
	//SBI
	var SBI1=9.80/1200;
	var SBI2=9.85/1200;
	var getemicalcSBI1=emiPrincipal*SBI1*(Math.pow(1+SBI1,emiTenure)/(Math.pow(1+SBI1,emiTenure)-1));
	var getemicalcSBI2=emiPrincipal*SBI2*(Math.pow(1+SBI2,emiTenure)/(Math.pow(1+SBI2,emiTenure)-1));
	var viewemiSBI="Rs." + Math.round(getemicalcSBI1) + " - Rs." + Math.round(getemicalcSBI2);
	jQuery("#sbi_bnk span").text(viewemiSBI);
	//For Icici
	var Icici1=10.75/1200;
	var Icici2=12.75/1200;
	var getemicalcIcici1=emiPrincipal*Icici1*(Math.pow(1+Icici1,emiTenure)/(Math.pow(1+Icici1,emiTenure)-1));
	var getemicalcIcici2=emiPrincipal*Icici2*(Math.pow(1+Icici2,emiTenure)/(Math.pow(1+Icici2,emiTenure)-1));
	var viewemiIcici="Rs." + Math.round(getemicalcIcici1) + " - Rs." + Math.round(getemicalcIcici2);
	jQuery("#Icici_bnk span").text(viewemiIcici);
	//for Axis
	var axis1=11.00/1200;
	var axis2=12.00/1200;
	var getemicalcaxis1=emiPrincipal*axis1*(Math.pow(1+axis1,emiTenure)/(Math.pow(1+axis1,emiTenure)-1));
	var getemicalcaxis2=emiPrincipal*axis2*(Math.pow(1+axis2,emiTenure)/(Math.pow(1+axis2,emiTenure)-1));
	var viewemiaxis="Rs." + Math.round(getemicalcaxis1) + " - Rs." + Math.round(getemicalcaxis2);
	jQuery("#axis_bnk span").text(viewemiaxis);

	jQuery("#intr_text span").text("Estimated EMI as Per Loan Amount");


}
function displayPieChart(month_emi,emi_tenure,emiPrincipal)
	{ 
		piechart=new Highcharts.Chart({
		chart:{renderTo:"container",
	plotBackgroundColor:null,
	plotBorderWidth:null,
	width: 200,
				height:150,
			plotShadow:true},
			title:false,
			tooltip:{
			formatter:function(){return"<b>"+this.point.name+"</b>: "+this.y+" %"}},
plotOptions:{
				pie:{allowPointSelect:true,cursor:"pointer",
					dataLabels:{enabled:false,  color: '#000000'},
					showInLegend:true}},
					series:[{type:"pie",
					name:" ",
					data:[["Loan Amount",
					Math.round(emiPrincipal* 100/(month_emi*emi_tenure))],
					{name:"Total Interest",
					y:Math.round(100-emiPrincipal*100/(month_emi*emi_tenure)),
				sliced:true,selected:true}]}]})
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
if(sWidth>690) { totWidth = 550; totHeight = 300; } else { totWidth = 300; totHeight = 200; }//550
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
                data: principalAxis
            }, {
               name: 'Interest',
               data: intrAxis
            }]
        });
}	

		
	$(function () {
  var pchart=new Highcharts.Chart({
		chart:{renderTo:"container",
	plotBackgroundColor:null,
	width: 200,
				height:150,
	plotBorderWidth:null,
			plotShadow:true},
			title:false,
			tooltip:{
			formatter:function(){return"<b>"+this.point.name+"</b>: "+this.y+" %"}},
plotOptions:{
				pie:{allowPointSelect:true,cursor:"pointer",
					dataLabels:{enabled:false,  color: '#000000'},
					showInLegend:true}},
					series:[{type:"pie",
					name:" ",
					data:[["Car Loan Amount",
					Math.round(300000* 100/(6448*60))],
					{name:"Total Interest",
					y:Math.round(100-300000*100/(6448*60)),
				sliced:true,selected:true}]}]})
});


$(function () {
    var chart;
				var sWidth = screen.width;
var totWidth;
var totHeight;
if(sWidth>690) { totWidth = 550; totHeight = 300; } else { totWidth = 300; totHeight = 200; }//550
    $(document).ready(function() {
	var catxAxis = new Array('Year 1','Year 2','Year 3','Year 4','Year 5');
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
                data: [48148, 53455, 59346, 65885, 73222]
            }, {
               name: 'Interest',
                data: [29228, 23921, 18030, 11491, 4228]
            }]
        });
    });
    
});

</script>
</head>
<body>
<?php  include "middle-menu.php"; ?>
<div style="clear:both; margin-top:70px;"></div>
<div class="cl_inner_wrapper">

<div class="common-bread-crumb" style="margin:auto; width:100%; height:11px; color:#0a8bd9; font-size:14px;"><a href="index.php" style="font-size:14px;">Home</a> <strong style="font-size:12px;"> &gt; </strong> <a href="car-loans.php"><span class="text12" style="color:#0a8bd9; font-size:14px;">Car loan</span></a> <strong style="font-size:12px;"> &gt; </strong> <span style="color:#4c4c4c;"> Car Loan EMI Calculator </span></div>

<div style="clear:both; height:5px;"></div><br />

  <h1 class="cl-h1">Car Loan EMI Calculator</h1>
<div style="clear:both;">
  <p>Are you looking for car loan calculator? Use this tool to  calculate how much per month emi you have to pay for buy your dream car. This  calculator use for the calculation of SUV, MUV, Used Car, New Car etc. This  calculator works for SBI, PNB, HDFC, ICICI, Axis Bank, Uco Bank, Union Bank,  United Bank, Dena Bank, Magma Fincorp etc.</p><br />
  <p>How this Car loan emi calculator works?</p>
  Simply insert your required car loan amount, Interest Rate & loan tenure period > It shows you the specific result related to your query instantly. Calculator shows you<br />
Monthly Instalment (EMI)<br />
Total Interest Amount <br />
Total Amount (Principal + Interest) in results.<br /><br />

<p>A user-friendly interface will let you modify the loan amount, tenure & interest rate to suit your preferences. Use this calculator to arrive at the EMI you are comfortable with. Also apply online through deal4loans for getting best offers!!!</p>
</div>
 <div>
    <?php 
	$retrivesource="CL EMI Calc";
	$subjectLine="Get Instant Quotes on Car Loan EMI & Eligibility from Top Banks";
	include "car-loans-widget.php";
 ?>
  </div>
  <div>
  <br />
  <strong>What is an EMI?</strong>
<p>EMI or Equated Monthly Installment is the fixed amount that a borrower has to pay every month before a specified due date towards the loan amount which he/she borrow from the bank. Basically EMI’s are a combined part of Principal amount + Interest paid on loan amount. At the starting of loan you have to pay more interest. As the loan tenure progresses, the contribution towards interest repayment will reduce and the principal repayment portion will increase with the time.</p>
<h3>Formula of Calculating monthly car loan emi</h3>
<p>Mathematically, EMIs are computed using the following formula</p><br />
<p>Monthly Instalment Amount = [ P x R X (1 + R) ^ N] / [ (1 + R) ^N - 1]</p><br />
<h3>Related Calculator Tools</h3>
<p><a href="http://www.deal4loans.com/Contents_Calculators.php">EMI Calculator</a>    |  <a href="http://www.deal4loans.com/home-loan-emi-calculator1.php">Home Loan EMI Calculator</a> |   <a href="http://www.deal4loans.com/personal-loan-emi-calculator.php">Personal Loan EMI Calculator</a> </p><br />
</div>
<div style="clear:both; height:10px;"></div>
<div class="cl_emi_process_box" style="border:#666666 1px solid; padding-left:5px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#F8F8F8"  ><table border="0" cellpadding="3" cellspacing="2" width="95%" align="center">
<tr><td width="161" height="20" style="color:#333333; font-weight:bold; font-size:13px;"> Car Loan Amount <span style="font-weight:normal;">&nbsp;&nbsp;&nbsp;Rs.</span></td>
<td width="71"><input type="test" value="0" name="amount_1a" id="amount_1a" size="11"  onchange=" EMI_calc();"/></td><td width="319"></td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_la"></div></td><tr>

<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px;">Interest Rate</td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="11"  onchange=" EMI_calc();"/> </td><td style="color:#333333; font-weight:bold; font-size:13px;">% Per Annum</td></tr>
<tr><td colspan="3" height="20"><div id="slider_intr"></div></td><tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; ">Loan Tenure</td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="11"  onchange=" EMI_calc();"/> </td><td style="color:#333333; font-weight:bold; font-size:13px;">Years</td></tr>
<tr><td colspan="3" height="20"><div id="slider_lt" ></div></td><tr>
</table></td>
    </tr>
  </table>
</div>
<div class="hl_emi_right_box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><div class="emi_right_box">
        <div style="float:left; width:100%; background-color:#F8F8F8; padding-bottom:0px;">
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Loan Amount </div>
<div class="emi_sum_value" id="loan_amt" style="background-color:#F8F8F8;"><span>Rs. 3,00,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Monthly Instalment (EMI)</div>
<div class="emi_sum_value" id="emi_monthly"  style="background-color:#DADADA;"><span>Rs. 6,448</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr" style="background-color:#F8F8F8;"><span>Rs. 86,890</span></div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#DADADA;" id="total_amt"><span>Rs. 3,86,890</span></div> 

        </div>
      </div></td>
    </tr>
    <tr>
      <td align="center"><div id="container"  style="height:150px;"></td>
    </tr>
    </table>
</div>


<div class="cl_emi_chart"> <div id="barChart"></div></div>

  <div class="cl_emi_table">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>
          <div id="tblpaymentsDetails">
        <table id='pmtTab' style=' clear: both;    background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; '>
          <tr >
            <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:90px; font: 12px; color:#FFFFFF;' id='numHead'>Year</td>
            <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px; color:#FFFFFF;' id='oldBal'>Principal</td>
            <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px; color:#FFFFFF;' id='pt'>Interest</td>
            <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; font: 12px; color:#FFFFFF;'id='oil' >Balance Amount</td>
          </tr>
          <tr height="18">
            <td height="18" align="center" width="64"  class="default_td">1</td>
            <td align="center" width="64"  class="default_td">Rs. 48,148</td>
            <td align="center" width="64"  class="default_td">Rs. 29,228</td>
            <td align="center" width="64"  class="default_td">Rs. 2,51,852</td>
          </tr>
          <tr height="18">
            <td height="18" align="center" width="64"  class="default_td">2</td>
            <td align="center" width="64"  class="default_td">Rs. 53,455</td>
            <td align="center" width="64"  class="default_td">Rs. 23,921</td>
            <td align="center" width="64"  class="default_td">Rs. 1,98,397</td>
          </tr>
          <tr height="18">
            <td height="18" align="center" width="64"  class="default_td">3</td>
            <td align="center" width="64"  class="default_td">Rs. 59,346</td>
            <td align="center" width="64"  class="default_td">Rs. 18,030</td>
            <td align="center" width="64"  class="default_td">Rs. 1,39,051</td>
          </tr>
          <tr height="18">
            <td height="18" align="center" width="64"  class="default_td">4</td>
            <td align="center" width="64"  class="default_td">Rs. 65,885</td>
            <td align="center" width="64"  class="default_td">Rs. 11,491</td>
            <td align="center" width="64"  class="default_td">Rs. 73,166</td>
          </tr>
          <tr height="18">
            <td height="18" align="center" width="64"  class="default_td">5</td>
            <td align="center" width="64"  class="default_td">Rs. 73,222</td>
            <td align="center" width="64"  class="default_td">Rs. 4,228</td>
            <td align="center" width="64"  class="default_td">Rs. 0</td>
          </tr>
        </table>
        </div>
        </td>
      </tr>
      <tr>
        <td><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=236732309688469" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe></td>
      </tr>
    </table>
  </div>
  <div style="clear:both;"></div>
  <div class="cl_emi_table_b"><table  style=' clear: both; background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0; text-align: center; ' width="100%">
    <tr >
      <td  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:150px; font: 12px; color:#FFFFFF;' height="30">Bank Name</td>
      <td style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:150px; font: 12px; color:#FFFFFF;' align="center">Interest Rate(New Car)</td>
      <td  style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:150px; font: 12px; color:#FFFFFF;'><div id="intr_text"><span>Per Lac EMI (for 5 years)</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center"   class="default_td"><a href="http://www.deal4loans.com/loans/car-loan/hdfc-car-loan-eligibility-interest-rates-and-documents-requirement-for-apply-hdfc-bank-car-loans/">HDFC Bank</a></td>
      <td align="center"  class="default_td">9.40% - 16.50% </td>
      <td align="center"  class="default_td"><div id="hdfc_bnk"><span>Rs. 2,125 - Rs. 2,250</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td"><a href="http://www.deal4loans.com/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/">State Bank of India (SBI)</a></td>
      <td align="center"  class="default_td">9.45% - 9.50%</td>
      <td align="center"  class="default_td"><div id="sbi_bnk"><span>Rs. 2,115 - Rs. 2,117</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td"><a href="http://www.deal4loans.com/loans/car-loan/icici-bank-car-loans/">ICICI Bank</a></td>
      <td align="center"  class="default_td">9.35% - 14.74%</td>
      <td align="center"  class="default_td"><div id="Icici_bnk"><span>Rs. 2,162 - Rs. 2,263</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td"><a href="http://www.deal4loans.com/loans/car-loan/axis-bank-car-loan-interest-rates-eligibility-apply-online-axis-car-loan/">Axis Bank</a></td>
      <td align="center"  class="default_td">9.40% - 16.50%</td>
      <td align="center"  class="default_td"><div id="axis_bnk"><span>Rs. 2,174 - Rs. 2,224</span></div></td>
    </tr>
	
  </table></div>
  <div  style="clear:both;">
  <h3>List of Major Banks in Car Loan</h3>
<table border="1" width="100%">
<tbody>
<tr>
<td><a href="http://www.deal4loans.com/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/">SBI</a></td>
<td><a href="http://www.deal4loans.com/loans/car-loan/hdfc-car-loan-eligibility-interest-rates-and-documents-requirement-for-apply-hdfc-bank-car-loans/">HDFC Bank</a></td>
<td><a href="http://www.deal4loans.com/loans/car-loan/icici-bank-car-loans/">ICICI Bank</a></td>
</tr>
<tr>
<td><a href="http://www.deal4loans.com/loans/car-loan/union-bank-of-india-car-loan-eligibility-interest-rates-apply/">Union Bank</a></td>
<td><a href="http://www.deal4loans.com/loans/car-loan/bank-of-baroda-car-loan/">Bank of Baroda</a></td>
<td><a href="http://www.deal4loans.com/loans/car-loan/pnb-car-loan-interest-rates-eligibility-documents/">PNB</a></td>
</tr>
<tr>
<td><a href="http://www.deal4loans.com/loans/car-loan/axis-bank-car-loan-interest-rates-eligibility-apply-online-axis-car-loan/">Axis Bank</a></td>
<td><a href="http://www.deal4loans.com/loans/car-loan/magma-fincorp-car-loan-interest-rates-documents-eligibility/">Magma Fincorp</a></td>
<td><a href="http://www.deal4loans.com/loans/car-loan/tvs-credit-services-car-loans-eligibility-documents/">TVS Credit</a></td>
</tr>
</tbody>
</table>
&nbsp;

   </div>

   <div  style="clear:both;">
  <h3>Most selling Cars for the month of December’2016</h3>
<table border="1" width="100%">
<tbody>
<tr>
<td>Maruti Alto</td>
<td>Maruti Swift Dzire</td>
<td>Maruti Swift</td>
</tr>
<tr>
<td>Maruti Baleno</td>
<td>Hyundai Grand I10</td>
<td>Hyundai Elite I20</td>
</tr>
<tr>
<td>Hyundai Creta</td>
<td>Hyundai Eon</td>
<td>Mahindra Scorpio</td>
</tr>
<tr>
<td>Toyota Innova Crysta</td>
<td>Renault Kwid</td>
<td>Maruti Vitara Brezza</td>
</tr>
<tr>
<td>TATA Tiago</td>
<td>TATA Zest</td>
<td>Honda City</td>
</tr>
<tr>
<td>Maruti Ciaz</td>
<td>Maruti Omni</td>
<td>Maruti Eeco</td>
</tr>
<tr>
<td>Toyota Fortuner</td>
<td>Mahindra Xuv500</td>
<td>Maruti Celerio</td>
</tr>
</tbody>
</table>
&nbsp;

   </div>
  
  <div style="clear:both;"></div>


</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>