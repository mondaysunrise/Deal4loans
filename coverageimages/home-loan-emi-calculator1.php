<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source']; }
else {	$retrivesource="Hl EMI Calc"; }
$page_Name = "HomeLoan";
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Home Loan EMI Calculator Nov 2015 - Deal4loans.com</title>
<meta name="keywords" content="home loan emi calculator, housing loan emi calculator, emi calculator for home loans, emi calculator for housing loans, emi calculator for home finance, new home loan emi calculator, Home loan calculator"/>
<meta name="description" content="Calculate Home Loan EMI online from SBI, HDFC, ICICI Bank, Axis Bank, LIC, PNB housing, Bank of Baroda all banks on Deal4loans.com" />
<meta http-equiv="Expires" content="0"/>
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script src="amort1.js"></script>
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<style>
div, h4,p  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px;    color: #00000;}
body,input {    font: 13px;    color: #00000;}
#emisum { background: none repeat scroll 0pt 0pt #fcfcfc; clear: both; float: left; width: 240px; margin: 0pt 10px 20px 0pt; border: 5px solid #547295; height: 240px; }
#emisum div { margin: 0pt 0pt 16px; padding: 10px 10px 0pt; text-align: center; width: 220px; border-top: 1px dotted rgb(147, 79, 79); }
#emisum h4 { color: #934f4f; font-weight: bold; }
#emisum p { font-size: 18px; font-weight: bold; margin: 0pt auto; }
#emisum span { padding-left: 5px; }
#emiamount { border-top: 0pt none ! important; }
#emiamount p { font-size: 24px; }

.emi_right_box{ float:left; width:340px; border:3px solid #547295;}
.emi_sum_amount{ float:left; padding:3px; width:230px; font-size:13px; }
.emi_sum_value{ float:right; padding:3px; font-size:13px; font-weight:bold; width:95px;}
.default_td { border: 1px solid #DBDAD7;background: #fffff; border-top: 0; font: 14px;}
</style>
<!-- For Touchable Slider Code -->
<!--
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
<script src="jquery.ui.touch-punch.min.js"></script>
-->
<!--//-->
<script>
//loan amount
$(function() {
			$( "#slider_la" ).slider({
			range: "min",
			value: 2000000,
			min: 100000,
			step: 100000,
			max:  20000000,
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
			value: 10.5,
			min: 8.5,
			step: .25,
			max:  15,
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
			value: 20,
			min: 3,
			step: 1,
			max:  30,
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
	var hdfc_rate1=9.55/1200;
	//var hdfc_rate2=9.75/1200;
	var getemicalcHDFC1=emiPrincipal*hdfc_rate1*(Math.pow(1+hdfc_rate1,emiTenure)/(Math.pow(1+hdfc_rate1,emiTenure)-1));
	//var getemicalcHDFC2=emiPrincipal*hdfc_rate2*(Math.pow(1+hdfc_rate2,emiTenure)/(Math.pow(1+hdfc_rate2,emiTenure)-1));
	var viewemi="Rs." + Math.round(getemicalcHDFC1) + " - Rs." + Math.round(getemicalcHDFC2);
	jQuery("#hdfc_bnk span").text(viewemi);
	//ICICI
	var icici1=9.60/1200;
	var icici2=9.65/1200;
	var getemicalcicici1=emiPrincipal*icici1*(Math.pow(1+icici1,emiTenure)/(Math.pow(1+icici1,emiTenure)-1));
	var getemicalcicici2=emiPrincipal*icici2*(Math.pow(1+icici2,emiTenure)/(Math.pow(1+icici2,emiTenure)-1));
	var viewemiicici="Rs." + Math.round(getemicalcicici1) + " - Rs." + Math.round(getemicalcicici2);
	jQuery("#icici_bnk span").text(viewemiicici);
	//For SBI
	var sbi1=9.50/1200;
	var sbi2=9.55/1200;
	var getemicalcsbi1=emiPrincipal*sbi1*(Math.pow(1+sbi1,emiTenure)/(Math.pow(1+sbi1,emiTenure)-1));
	var getemicalcsbi2=emiPrincipal*sbi2*(Math.pow(1+sbi2,emiTenure)/(Math.pow(1+sbi2,emiTenure)-1));
	var viewemisbi="Rs." + Math.round(getemicalcsbi1) + " - Rs." + Math.round(getemicalcsbi2);
	jQuery("#sbi_bnk span").text(viewemisbi);
	//for PNB
	var pnb1=9.75/1200;
	var pnb2=9.95/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#pnb_bnk span").text(viewemipnb);
	//for axis
	var pnb1=9.85/1200;
	var pnb2=10.35/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#axis_bnk span").text(viewemipnb);
	//for LIC Housing
	var pnb1=9.90/1200;
	//var pnb2=10.40/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	//var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	//var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	var viewemipnb="Rs." + Math.round(getemicalcpnb1);
	jQuery("#lic_bnk span").text(viewemipnb);
	//for Fed Bank
	var pnb1=10.35/1200;
	var pnb2=10.70/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#fed_bnk span").text(viewemipnb);
	//for PNB Home Loan
	var pnb1=9.60/1200;
	//var pnb2=10.25/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
//	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	//var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	var viewemipnb="Rs." + Math.round(getemicalcpnb1);
	jQuery("#pnb_home_bnk span").text(viewemipnb);
	//for IDBI Home Loan
	var pnb1=10.00/1200;
	var pnb2=10.15/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#idbi_home_bnk span").text(viewemipnb);
	//for DHFL Home Loan
	var pnb1=9.55/1200;
	var pnb2=9.65/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#dhfl_home_bnk span").text(viewemipnb);
	//for Indiabulls Home Loan
	var pnb1=9.60/1200;
	var pnb2=11.75/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#indiabulls_home_bnk span").text(viewemipnb);
	//for Union Bank
	var pnb1=9.65/1200;
	var pnb2=10.40/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#union_bnk span").text(viewemipnb);
	//for Vijaya Bank
	var pnb1=10.30/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1);
	jQuery("#vijaya_bnk span").text(viewemipnb);
	//for Standard chartered Bank
	var pnb1=9.75/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1);
	jQuery("#scb_bnk span").text(viewemipnb);
	//for Indian Bank
	var pnb1=9.95/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1);
	jQuery("#indian_bnk span").text(viewemipnb);
}

function displayPieChart(month_emi,emi_tenure,emiPrincipal)
	{ 
		piechart=new Highcharts.Chart({
		chart:{renderTo:"container",
		width: 200,
				height:110,
	plotBackgroundColor:null,
	plotBorderWidth:null,
			plotShadow:true},
			//title:{text:"Total Payment"},
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
				 width: 550,
				height:650
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
  var pchart=new Highcharts.Chart({
		chart:{renderTo:"container",
		width: 200,
				height:110,
	plotBackgroundColor:null,
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
					data:[["Home Loan Amount",
					Math.round(500000* 100/(4992*240))],
					{name:"Total Interest",
					y:Math.round(100-500000*100/(4992*240)),
				sliced:true,selected:true}]}]})
});


$(function () {
    var chart;
    $(document).ready(function() {
	var catxAxis = new Array('Year 1','Year 2','Year 3','Year 4','Year 5','Year 6','Year 7','Year 8','Year 9','Year 10','Year 11','Year 12','Year 13','Year 14','Year 15','Year 16','Year 17','Year 18','Year 19','Year 20');
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'barChart',
                type: 'bar',
			    width: 550,
				height:650
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
<link href="css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php include "middle-menu.php"; ?>
<?php $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); $currentdate=date('d F Y',$tomorrow); ?>
<div  class="hl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="d4l_inner_wrapper">
    <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">
      <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> <span> > Home Loan Interest Rates </span></div>
      </div>
 <div id="lftbar">
<?php
if(strlen(strpos($_SERVER['HTTP_REFERER'], "/home-loan/")) > 0)
{
	$url_referer = $_SERVER['HTTP_REFERER'];
	$exp = explode("/home-loan/", $url_referer);
	?>
	<div style="text-align:right;" align="right"><a href="<?php echo $url_referer; ?>">Apply for Home Loan in <?php echo ucfirst($exp[1]); ?></a></div>
<?php
}
?>
  <div id="txt"><h1 class="hl-h1">Home Loan EMI Calculator</h1></div>
  <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
<tr>
  <td>			

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="font2">
<tr>
  <td colspan="2"  valign="top" bgcolor="#FFFFFF" style=" padding-left:5px;" ><div class="hlc_left_cal-box"><table width="100%" height="168" border="0" align="center" cellpadding="3" cellspacing="2">
<!--<tr><td colspan="3" height="5"></td></tr> -->
<tr><td width="194" height="20" class="common-sub-body-text"> <strong>Home Loan Amount</strong> <span style="font-weight:normal;">&nbsp;&nbsp;&nbsp;Rs.</span></td>
<td width="66"><input type="test" value="0" name="amount_1a" id="amount_1a" size="11" onchange=" EMI_calc();"/></td><td width="127"></td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_la"></div></td><tr>
<tr><td height="20" class="common-sub-body-text"><strong>Interest Rate</strong></td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="11" onchange=" EMI_calc();"/> </td><td class="common-sub-body-text"><strong>% Per Annum</strong></td></tr>
<tr><td colspan="3" height="20"><div id="slider_intr"></div></td><tr>
<tr><td height="20" class="common-body-text"><strong>Loan Tenure</strong></td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="11" onchange=" EMI_calc();"/> </td><td class="common-body-text"><strong>Years</strong></td></tr>
<tr><td colspan="3" height="20"><div id="slider_lt" ></div></td><tr>

</table></div>
<div class="hlc_left_cal-box2"><table border="0" width="100%">
<tr><td valign="top">
<div class="emi_right_box" style="padding-top:-10px;">
<div style="float:left; width:100%; background-color:#F8F8F8; padding-bottom:0px;">
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Loan Amount </div>
<div class="emi_sum_value" id="loan_amt" style="background-color:#F8F8F8;"><span>Rs. 2,000,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Monthly Instalment (EMI)</div>
<div class="emi_sum_value" id="emi_monthly"  style="background-color:#DADADA;"><span>Rs. 19,968</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr" style="background-color:#F8F8F8;"><span>Rs. 2,792,223</span></div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#DADADA;" id="total_amt"><span>Rs. 4,792,223</span></div> 
</div>
</div>
            
</td></tr>
<tr><td align="center" height="102">  <div id="container"  style="height:100px;"></div></td></tr></table></div>
</td></tr>
<tr><td colspan="2" style="padding-top:20px;">

<?php $newsource="IH SEO 1";
$subjectLine="Get Customized Free Home Loan Emi Quote from 10 Banks";
$subjectLine2="Home Loan Emi Quotes as low as 9.50%, Lowest EMI, Last year EMI waive off Offers | Minimum Tenure 6 Months";
//include 'RightHLS1short.php';
include "home-loans-widget.php";
 ?>
</td></tr>
<tr><td colspan="2" align="right" style="margin-top:3px;"> 
<div style="width:160px; float:right;">
<div align="left">
 <div align="right" style="width:77px; float:left; margin-top:7px;">
<!-- Place this tag in your head or just before your close body tag. -->
<script type="text/javascript" src="https://apis.google.com/js/platform.js"></script>
<!-- Place this tag where you want the share button to render. -->
<div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60" data-href="http://www.deal4loans.com/home-loan-emi-calculator1.php"></div>
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
<div class="fb-share-button" data-href="http://www.deal4loans.com/home-loan-emi-calculator1.php" data-type="box_count"></div>
</div>
  </div>
  </div>
</td></tr> 
<tr>
  <td width="474" align="center" valign="top">
      </td>
  
  <td width="613" valign="top" style="padding-top:15px;">  
  

</td></tr>
</table>
</td></tr></table>
  <div style="clear:both;"></div>
  <div  style="clear:both;"></div>
  <div class="hlc_left_cal-box3"><div id="barChart"></div> </div>
  <div class="hlc_left_cal-box4"><div id="tblpaymentsDetails">
<table id='pmtTab' style=' clear: both;background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; '>  <tr >
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:90px; font: 12px; color:#FFFFFF;' id='numHead'>Year</td>
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px; color:#FFFFFF;' id='oldBal'>Principal</td>
      <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px; color:#FFFFFF;' id='pt'>Interest</td>
      <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; font: 12px; color:#FFFFFF;'id='oil' >Balance Amount</td>
    </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">1</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 31,083</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 208,533</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 1,968,917</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">2</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 34,509</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 205,107</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 1,934,408</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">3</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 38,311</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 201,305</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 1,896,097</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">4</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 42,537</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 197,079</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,853,560</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">5</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 47,221</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 192,395</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,806,339</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">6</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 52,426</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 187,190</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,753,913</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">7</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 58,203</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 181,413</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,695,710</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">8</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 64,618</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 174,998</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,631,092</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">9</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 71,740</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 167,876</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,559,352</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">10</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 79,644</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 159,972</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,479,708</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">11</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 88,422</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 151,194</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,391,286</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">12</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 98,165</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 141,451</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,293,121</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">13</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 108,983</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 130,633</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,184,138</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">14</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 120,994</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 118,622</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 1,063,144</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">15</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 134,327</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 105,289</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 928,817</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">16</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 149,132</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 90,484</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 779,685</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">17</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 165,567</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 74,049</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 614,118</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">18</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 183,812</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 55,804</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 430,306</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">19</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 204,069</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 35,547</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 226,237</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64" class="default_td">20</td>
    <td height="18" align="center" width="64" class="default_td">Rs. 226,407</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 13,056</td>
   <td height="18" align="center" width="64" class="default_td">Rs. 0</td>
  </tr>
</table>
</div></div>
<div style="clear:both;"></div>
<div class="hlc_left_cal-below-box"><table  style=' clear: both; background:none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0; text-align: center;' width="100%">
    <tr >
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:150px; font: 12px; color:#FFFFFF;'>Bank Name</td>
      <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:150px; font: 12px; color:#FFFFFF;'>Interest Rate</td>
      <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; font: 12px; color:#FFFFFF;'><div id="intr_text" align="center"><span style="width:170px;" align="center">Estimated EMI as Per Loan Amount</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center" class="default_td">HDFC LTD</td>
      <td align="center"class="default_td">9.55%</td>
      <td align="center"class="default_td"><div id="hdfc_bnk"><span>Rs. 18,708</span></div></td>
    </tr>
	<tr height="18">
      <td height="18" align="center" class="default_td" >ICICI Bank</td>
      <td align="center" class="default_td">9.60% - 9.65%</td>
      <td align="center" class="default_td"><div id="icici_bnk"><span>Rs. 18,773 - Rs. 18,839</span></div></td>
    </tr>
	<tr height="18">
      <td height="18" align="center" class="default_td">SBI</td>
      <td align="center" class="default_td">9.50% - 9.55%</td>
      <td align="center" class="default_td"><div id="sbi_bnk"><span>Rs. 18,643 - Rs. 18,708</span></div></td>
    </tr>
	<tr height="18">
      <td height="18" align="center" class="default_td">PNB Housing</td>
      <td align="center" class="default_td">9.75% - 9.95%</td>
      <td align="center" class="default_td"><div id="pnb_bnk"><span>Rs. 18,970 - Rs. 19,234</span></div></td>
    </tr>
	<tr height="18">
      <td height="18" align="center" class="default_td">Axis Bank</td>
      <td align="center" class="default_td">9.60% - 9.65%</td>
      <td align="center" class="default_td"><div id="axis_bnk"><span>Rs. 18,773 - Rs. 18,839</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center" class="default_td">LIC Housing</td>
      <td align="center" class="default_td">9.60%</td>
      <td align="center" class="default_td"><div id="lic_bnk"><span>Rs. 18,773</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center" class="default_td">Fed Bank</td>
      <td align="center" class="default_td">10.35% - 10.70%</td>
      <td align="center" class="default_td"><div id="fed_bnk"><span>Rs. 19,766 - Rs. 20,237</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td">PNB Home Loan</td>
      <td align="center" class="default_td">9.60%</td>
      <td align="center" class="default_td"><div id="pnb_home_bnk"><span>Rs. 18,773</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td">IDBI Home Loan</td>
      <td align="center" class="default_td">10.00% - 10.15%</td>
      <td align="center" class="default_td"><div id="idbi_home_bnk"><span>Rs. 19,300 - Rs. 19,500</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td">DHFL Home Loan</td>
      <td align="center" class="default_td">9.55% - 9.65%</td>
      <td align="center" class="default_td"><div id="dhfl_home_bnk"><span>Rs. Rs. 18,708 - Rs. 18,839</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td">Indiabulls Home Loan</td>
      <td align="center" class="default_td">9.60% - 11.75%</td>
      <td align="center" class="default_td"><div id="indiabulls_home_bnk"><span>Rs. 18,773 - Rs. 21,674</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center" class="default_td">Union Bank</td>
      <td align="center" class="default_td">9.65% - 10.40%</td>
      <td align="center" class="default_td"><div id="union_bnk"><span>Rs. 18,839 - Rs. 19,833</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td">Vijaya Bank</td>
      <td align="center" class="default_td">10.30%</td>
      <td align="center" class="default_td"><div id="vijaya_bnk"><span>Rs. 19,700</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td">Standard Chartered Bank</td>
      <td align="center" class="default_td">9.75%</td>
      <td align="center" class="default_td"><div id="scb_bnk"><span>Rs. 18,970</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td">Indian Bank</td>
      <td align="center" class="default_td">9.95%</td>
      <td align="center" class="default_td"><div id="indian_bnk"><span>Rs. 19,234</span></div></td>
    </tr>	
</table>
</div>

<div style="clear:both;"></div>

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
 <div class="common-body-text" style="color:#4c4c4c; padding-left:5px; width:99%;">A customer needs to know how much he has to pay per month for the home loan he  has taken is called Home loan emi.<br /><br />
   <strong> How is Home loan emi calculated?</strong><br /><br />
    To calculate exact per month emi, it is based on the loan you have taken and the interest on is calculated and the amount is paid within the decided period ie tenure.<br />
    So if you take a 3000000 home loan and the interest is 9.80% for 20 years, your emi will be Rs. 28,554. So Home loan emi depends upon.<br />
    <ul>
        <li>1. Loan amount</li>
        <li>2. Tenure</li>
        <li>3. Interest rate-Floating or Fixed</li>
    </ul>
    <div class="common-body-text" style="width:100%;"><strong>How to get my Home loan Emi across Major Banks?</strong></div>
    <ul>
        <li>1. Put the rate of interest for all banks in the calculator above</li>
        <li>2. Apply and get detailed information.</li>
    </ul>
  </div>
  <div  style="clear:both;"></div>
  <h3>You Can Calculate Home loan EMI for below mentioned Banks: list as follows:</h3>
  <p>SBI, HDFC, Axis Bank, Bank of Baroda, Bank of India, Union Bank, DHFL, LIC Housing, SBP, Canara Bank, Allahabad Bank, ICICI Bank, Yes Bank, Citibank, PNB, uco bank, Indiabulls & others.</p>
  <p>&nbsp;</p>
  
  <div  style="clear:both;"></div>
</div>
</div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>