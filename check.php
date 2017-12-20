<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="PL emi calc";
}
$page_Name = "PersonalLoan";
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<Title>Personal Loan EMI Calculator - Calculate your eligibility with Personal Loan calculator | Deal4loans</title>
<meta name="keywords" content="calculate emi of Personal, emi Personal calculator, calculate Personal loan, Personal loan loan calculator, indian Personal loan emi calculator, used Personal emi, new Personal emi"/>
<meta name="description" content="Personal loan emi calculator?? Personal loan Calculator for new and used Personal loans. Calculate accurate Personal loan eligibility with Deal4loans.com"/>
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<link rel="stylesheet" href="/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script src="amort1.js"></script>
<style>
div, h4,p  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px Arial, Helvetica, sans-serif;    color: #00000;}
.emi_right_box{ float:left; width:340px; border:5px solid #547295;}
.emi_sum_amount{ float:left; padding:5px; width:228px; }
.emi_sum_value{ float:right; padding:5px; font-size:13px; font-weight:bold; width:90px;}
.default_td
 {
 border: 1px solid #DBDAD7;background: #fffff; border-top: 0; font: 12px Arial, Helvetica, sans-serif;}

</style>
<script>
//loan amount
$(function() {
			$( "#slider_la" ).slider({
			range: "min",
			value: 200000,
			min: 50000,
			step: 10000,
			max:  3000000,
			slide: function( event, ui ) {
				$( "#amount_1a" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_1a" ).val( "" + $( "#slider_la" ).slider( "value" ) );
	});

//interest rate
$(function() {
			$( "#slider_intr" ).slider({
			range: "min",
			value: 14.5,
			min: 10,
			step: .5,
			max:  42,
			slide: function( event, ui ) {
				$( "#amount_intr" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_intr" ).val( "" + $( "#slider_intr" ).slider( "value" ) );
	});

//loan tenure

$(function() {
			$( "#slider_lt" ).slider({
			range: "min",
			value: 4,
			min: 1,
			step: 1,
			max:  7,
			slide: function( event, ui ) {
				$( "#amount_lt" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_lt" ).val( "" + $( "#slider_lt" ).slider( "value" ) );
	});

function EMI_calc(){
		var emiPrincipal=jQuery("#amount_1a").val();
	var emiRate=jQuery("#amount_intr").val()/12/100;
	var emiTenure=jQuery("#amount_lt").val()*12;
	var emi=emiPrincipal*emiRate*(Math.pow(1+emiRate,emiTenure)/(Math.pow(1+emiRate,emiTenure)-1));
	jQuery("#emi_monthly span").text(number_format(Math.round(emi)));
	jQuery("#total_intr span").text(number_format(Math.round(emi* emiTenure-emiPrincipal)));
	jQuery("#total_amt span").text(number_format(Math.round(emi*emiTenure)));
	jQuery("#loan_amt span").text(number_format(Math.round(emiPrincipal)));
	var month_emi=Math.round(emi);
	var emi_tenure=Math.round(emiTenure);
displayPieChart(month_emi,emi_tenure,emiPrincipal);

var intRate = emiRate * 12 * 100;
commitData(emiPrincipal,intRate,emiTenure);
displayBarChart (emiPrincipal,intRate,emiTenure);
fillrates(emiPrincipal,emiTenure);

}

function fillrates(emiPrincipal,emiTenure)
{
	var hdfc_rate1=13.99/1200;
	var hdfc_rate2=22.25/1200;
	var getemicalcHDFC1=emiPrincipal*hdfc_rate1*(Math.pow(1+hdfc_rate1,emiTenure)/(Math.pow(1+hdfc_rate1,emiTenure)-1));
	var getemicalcHDFC2=emiPrincipal*hdfc_rate2*(Math.pow(1+hdfc_rate2,emiTenure)/(Math.pow(1+hdfc_rate2,emiTenure)-1));
	var viewemi="Rs." + Math.round(getemicalcHDFC1) + " - Rs." + Math.round(getemicalcHDFC2);
	jQuery("#hdfc_bnk span").text(viewemi);
	//ICICI
	var icici1=14/1200;
	var icici2=18.5/1200;
	var getemicalcicici1=emiPrincipal*icici1*(Math.pow(1+icici1,emiTenure)/(Math.pow(1+icici1,emiTenure)-1));
	var getemicalcicici2=emiPrincipal*icici2*(Math.pow(1+icici2,emiTenure)/(Math.pow(1+icici2,emiTenure)-1));
	var viewemiicici="Rs." + Math.round(getemicalcicici1) + " - Rs." + Math.round(getemicalcicici2);
	jQuery("#icici_bnk span").text(viewemiicici);
	//For Bajaj
	var bajaj1=15.75/1200;
	var bajaj2=17/1200;
	var getemicalcbajaj1=emiPrincipal*bajaj1*(Math.pow(1+bajaj1,emiTenure)/(Math.pow(1+bajaj1,emiTenure)-1));
	var getemicalcbajaj2=emiPrincipal*bajaj2*(Math.pow(1+bajaj2,emiTenure)/(Math.pow(1+bajaj2,emiTenure)-1));
	var viewemibajaj="Rs." + Math.round(getemicalcbajaj1) + " - Rs." + Math.round(getemicalcbajaj2);
	jQuery("#bajaj_bnk span").text(viewemibajaj);
	//for ING Vysya
	var ing1=14.50/1200;
	var ing2=18.25/1200;
	var getemicalcing1=emiPrincipal*ing1*(Math.pow(1+ing1,emiTenure)/(Math.pow(1+ing1,emiTenure)-1));
		var getemicalcing2=emiPrincipal*ing2*(Math.pow(1+ing2,emiTenure)/(Math.pow(1+ing2,emiTenure)-1));
	var viewemiing="Rs." + Math.round(getemicalcing1) + " - Rs." + Math.round(getemicalcing2);
	jQuery("#ing_bnk span").text(viewemiing);

}

function displayPieChart(month_emi,emi_tenure,emiPrincipal)
	{ 
		piechart=new Highcharts.Chart({
		chart:{renderTo:"container",
	plotBackgroundColor:null,
	plotBorderWidth:null,
	width: 200,
				height:200,
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
	
 chart = new Highcharts.Chart({
            chart: {
                renderTo: 'barChart',
                type: 'bar',
				height:300
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
				height:200,
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
					data:[["Personal Loan Amount",
					Math.round(200000* 100/(5516*48))],
					{name:"Total Interest",
					y:Math.round(100-200000*100/(5516*48)),
				sliced:true,selected:true}]}]})
});


$(function () {
    var chart;
    $(document).ready(function() {
	var catxAxis = new Array('Year 1','Year 2','Year 3','Year 4');
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'barChart',
                type: 'bar',
				height:300,
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
                data: [39766, 45930, 53054, 61316]
            }, {
               name: 'Interest',
                data: [26426, 20262, 13138, 4914]
            }]
        });
    });
    
});

</script>
<?php include "pl-form-js.php"; ?>
</head>
<body>
<?php include "top-menu.php";  include "main-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal loan</u></a> <span class="text12" style="color:#4c4c4c;"> > Personal Loan EMI Calculator </span></div>
<div class="intrl_txt" style="margin:auto;"><div style=" float:left; width:940px; height:auto; margin-top:15px; margin-left:20px; text-align:justify;">
<h1 class="text3"  style="width:900px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;">Personal Loan EMI Calculator</h1>
<div style="float:left; width:663px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="900" height="1" /></div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:15px;">Process - 1</div>
<table cellpadding="0" cellspacing="0" border="0" align="center" class="font2">
<tr><td colspan="2" style="padding-bottom:10px;">
<?php 
$newsource="PL emi calc";
$subjectLine="Get Personal loan emi calculation from 10 Banks";
include "pl-form.php"; 
?>

</td></tr>
<tr><td lass="text" style="color:#4c4c4c; size:18px; height:37px;"  >
<div class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:10px;">Process - 2  Personal loan EMI Calculator
<br />
Sample Calculations - </div>
</td><td align="right"  >
<table cellpadding="0" cellspacing="0" border="0" width="300" ><tr><td  align="right">
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=236732309688469" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe></td><td width="70">
<a class="addthis_button_tweet" style="width:70px;"></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e0d5fb863d78da4"></script>
</td><td align="left" width="80" ><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><g:plusone></g:plusone></td></tr></table>

</td></tr>
<tr><td width="597" class="frmbldtxt"  style="padding-left:100px; font-weight:bold; padding-bottom:5px;" >To check your Emi-Drag the slider for Loan amount|Tenure|Rate of interest.</td>
<td width="373"  class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:20px;"  ><span >Sample Results</span></td>
</tr> 
<tr><td colspan="2"><table cellpadding="0" cellspacing="0" border="0" align="center" class="font2">
<tr><td width="600"  valign="top" bgcolor="#F8F8F8" style="border:#666666 1px solid; padding-left:5px;" >
<table border="0" cellpadding="3" cellspacing="2" width="95%" align="center">
<tr><td colspan="3" height="5"></td></tr>
<tr><td width="199" height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;"> Personal Loan Amount <span style="font-weight:normal;">&nbsp;&nbsp;&nbsp;Rs.</span></td>
<td width="72"><input type="test" value="0" name="amount_1a" id="amount_1a" size="11" onchange=" EMI_calc();" /></td><td width="266"></td>
</tr>
<tr><td colspan="3" height="25"><div id="slider_la"></div></td><tr>
<tr><td colspan="3" height="20"></td></tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Interest Rate</td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="11" onchange=" EMI_calc();" /> </td><td style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">% Per Annum</td></tr>
<tr><td colspan="3" height="25"><div id="slider_intr"></div></td><tr>
<tr><td colspan="3" height="20"></td></tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Loan Tenure</td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="11" onchange=" EMI_calc();" /> </td><td style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Years</td></tr>
<tr><td colspan="3" height="25"><div id="slider_lt" ></div></td><tr>
</table>
</td><td width="339" align="center" valign="bottom" style="padding-left:10px;">
<table border="0"><tr><td>
<div class="emi_right_box">
<div style="float:left; width:340px; background-color:#F8F8F8; padding-bottom:0px;">
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Loan Amount </div>
<div class="emi_sum_value" id="loan_amt" style="background-color:#F8F8F8;"><span>Rs. 200,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Monthly Instalment (EMI)</div>
<div class="emi_sum_value" id="emi_monthly"  style="background-color:#DADADA;"><span>Rs. 5,516</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr" style="background-color:#F8F8F8;"><span>Rs. 64,748</span></div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#DADADA;" id="total_amt"><span>Rs. 264,748</span></div> 
</div>
</div>
            
</td></tr>
<tr><td align="center" height="200">  <div id="container"  style="height:200px;"></div></td></tr></table>   
</td></tr>
<tr>
  <td valign="middle">
  <div id="barChart"></div>
  
    </td>
  <td valign="top" style="padding-top:15px;">   <div id="tblpaymentsDetails">
<table align="center" cellpadding="0" cellspacing="0">
  <tr>
 <td>
 <table id='pmtTab' style=' clear: both; background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; '> 
   <tr >
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:90px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='numHead'>Year</td>
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='oldBal'>Principal</td>

      <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='pt'>Interest</td>
      <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;'id='oil' >Balance Amount</td>
    </tr>
 <tr height="18">
    <td height="18" align="center" width="64"  class="default_td">1</td>
    <td align="center" width="64"  class="default_td">Rs. 39,766</td>
    <td align="center" width="64"  class="default_td">Rs. 26,426</td>
    <td align="center" width="64"  class="default_td">Rs. 1,60,234</td>
  </tr>
 <tr height="18">
    <td height="18" align="center" width="64"  class="default_td">2</td>
    <td align="center" width="64"  class="default_td">Rs. 45,930</td>
    <td align="center" width="64"  class="default_td">Rs. 20,262</td>
    <td align="center" width="64"  class="default_td">Rs. 1,14,304</td>
  </tr>
 <tr height="18">
    <td height="18" align="center" width="64"  class="default_td">3</td>
    <td align="center" width="64"  class="default_td">Rs. 53,054</td>
    <td align="center" width="64"  class="default_td">Rs. 13,138</td>
    <td align="center" width="64"  class="default_td">Rs. 61,250</td>
  </tr>
 <tr height="18">
    <td height="18" align="center" width="64"  class="default_td">4</td>
    <td align="center" width="64"  class="default_td">Rs. 61,316</td>
    <td align="center" width="64"  class="default_td">Rs. 4,914</td>
    <td align="center" width="64"  class="default_td">Rs. 0</td>
  </tr>
</table></td></tr></table>
</div>
 </td></tr>
 <tr>
  <td valign="top" style="padding-top:15px;" colspan="2" align="center"> <table  style=' clear: both;    background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; ' width="700">
    <tr >
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;'>Bank Name</td>
      <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;'>Interest Rate</td>
      <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' ><div id="intr_text" align="center"><span style="width:170px;" align="center">Estimated EMI as Per Loan Amount</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center"   class="default_td">HDFC Bank</td>
      <td align="center"  class="default_td">13.99% - 22.25%</td>
      <td align="center"  class="default_td"><div id="hdfc_bnk"><span>Rs. 5,464 - Rs. 6,328</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td">ICICI Bank</td>
      <td align="center"  class="default_td">14% - 18.5%</td>
      <td align="center"  class="default_td"><div id="icici_bnk"><span>Rs. 5,465 - Rs. 5,927</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td">Bajaj Finserv</td>
      <td align="center"  class="default_td">15.75% - 17%</td>
      <td align="center"  class="default_td"><div id="bajaj_bnk"><span>Rs. 5,642 - Rs. 5,771</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td">ING Vysya </td>
      <td align="center"  class="default_td">14.50% - 18.25%</td>
      <td align="center"  class="default_td"><div id="ing_bnk"><span>Rs. 5,515 - Rs. 5,901</span></div></td>
    </tr>
	
  </table></td></tr>
 
</table></td></tr>
<tr><td colspan="2" class="frmbldtxt"  style="font-weight:normal;">Our Personal loan emi calculator is easy to use. Use personal loan calculator as a guide before availing for any kind of personal loan. Personal loan emi calculator let's you judge how affordable a loan can be for you. Always use the calculator to get a quick quote on your loan EMIs. If the quote satisfies you, then apply accordingly. with simple process.<br /><br />1.Enter the loan amount you wish to avail in the Persoanl Loan EMI calculator.<br />2.Select the interest rate (reducing).<br />3.Enter the loan tenure (months).<br />4.Our personal loan calculator will show you just how much your EMI amount comes to.<br /></td></tr>
</table>

<div class="txt"><h3>Other Available Calculators are - </h3><a href="Contents_Calculators.php"><b>EMI Calculator</b></a> <br /><a href="http://www.deal4loans.com/home-loan-calculator.php"><strong>Home Loan EMI Calculator</strong></a><br /> <a href="balance-transfer-home-loans.php"><strong>Home Loan Balance Transfer</strong></a><br /><a href="loan-amortization-calculator.php"><strong>Loan Amortization Calculator</strong></a></div>
<div style="font-size:10px; padding-top:10px; color:#666666;"><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.</div><br></div>
</div>
<?php include "footer_pl.php"; ?>
</body>
</html>