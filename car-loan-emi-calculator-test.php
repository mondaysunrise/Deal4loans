<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/functions.php';
require 'scripts/db_init.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;
$retrivesource="CL EMI Calc";
$subject = 'Get Instant Quotes on Car Loan EMI & Eligibility from Top Banks';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<title>Car Loan EMI Calculator India | Deal4loans</title>
<meta name="keywords" content="car loan emi calculator, car loan calculator,  calculate car loan emi" />
<meta name="description" content="Car Loan Emi Calculator - Calculate Equated Monthly Installment (EMI) on Car Loan with interactive charts & Get emi quotes on Deal4loans.com from SBI, HDFC, ICICI, Axis, PNB etc." />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet" />
<link href="source.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script src="amort1.js"></script>
<link href="css/wp_cl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="validate_cl.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list-clhdfc.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

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
fillrates (emiPrincipal,emiTenure);

}
function fillrates(emiPrincipal,emiTenure)
{
	var hdfc_rate1=10.25/1200;
	var hdfc_rate2=12.50/1200;
	var getemicalcHDFC1=emiPrincipal*hdfc_rate1*(Math.pow(1+hdfc_rate1,emiTenure)/(Math.pow(1+hdfc_rate1,emiTenure)-1));
	var getemicalcHDFC2=emiPrincipal*hdfc_rate2*(Math.pow(1+hdfc_rate2,emiTenure)/(Math.pow(1+hdfc_rate2,emiTenure)-1));
	var viewemi="Rs." + Math.round(getemicalcHDFC1) + " - Rs." + Math.round(getemicalcHDFC2);
	jQuery("#hdfc_bnk span").text(viewemi);
	//SBI
	var SBI1=10.75/1200;
	var getemicalcSBI1=emiPrincipal*SBI1*(Math.pow(1+SBI1,emiTenure)/(Math.pow(1+SBI1,emiTenure)-1));
	var viewemiSBI="Rs." + Math.round(getemicalcSBI1);
	jQuery("#sbi_bnk span").text(viewemiSBI);
	//For Kotak
	var kotak1=11.50/1200;
	var kotak2=13.50/1200;
	var getemicalckotak1=emiPrincipal*kotak1*(Math.pow(1+kotak1,emiTenure)/(Math.pow(1+kotak1,emiTenure)-1));
	var getemicalckotak2=emiPrincipal*kotak2*(Math.pow(1+kotak2,emiTenure)/(Math.pow(1+kotak2,emiTenure)-1));
	var viewemikotak="Rs." + Math.round(getemicalckotak1) + " - Rs." + Math.round(getemicalckotak2);
	jQuery("#kotak_bnk span").text(viewemikotak);
	//for Axis
	var axis1=14.50/1200;
	var getemicalcaxis1=emiPrincipal*axis1*(Math.pow(1+axis1,emiTenure)/(Math.pow(1+axis1,emiTenure)-1));
	var viewemiaxis="Rs." + Math.round(getemicalckotak1) + " - Rs." + Math.round(getemicalcaxis1);
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
<!--
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<link rel="stylesheet" type="text/css" href="menu-style.css">
-->
</head>
<body>

<!--<div class="hide_top_menu"><?php #include "top-menu.php";  ?></div>-->
<?php 
#include "main-menu-emi-calculator.php";
include "middle-menu.php"; 
?>
<div style="clear:both;"></div>
<div class="hl_emi_cal_wrapper" style="margin:auto;">
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car loan</u></a> <span class="text12" style="color:#4c4c4c;"> > Car Loan EMI Calculator </span></div>
<div class="title" style="margin-top:15px;"><h1 class="text3" style="height:33; margin-top:0px; float:left; clear:right; font-size:24px; text-transform:none; color:#88a943;">Car Loan EMI Calculator</h1></div>
<div style="clear:both;"></div>
<?php include "car_loans_frm_intr.php"; ?>
<div style="clear:both; height:10px;"></div>
<div class="cl_emi_process_box" style="border:#666666 1px solid; padding-left:5px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#F8F8F8"  ><table border="0" cellpadding="3" cellspacing="2" width="95%" align="center">
<tr><td width="161" height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;"> Car Loan Amount <span style="font-weight:normal;">&nbsp;&nbsp;&nbsp;Rs.</span></td>
<td width="71"><input type="test" value="0" name="amount_1a" id="amount_1a" size="11"  onchange=" EMI_calc();"/></td><td width="319"></td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_la"></div></td><tr>

<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Interest Rate</td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="11"  onchange=" EMI_calc();"/> </td><td style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">% Per Annum</td></tr>
<tr><td colspan="3" height="20"><div id="slider_intr"></div></td><tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Loan Tenure</td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="11"  onchange=" EMI_calc();"/> </td><td style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Years</td></tr>
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
<div class="emi_sum_value" id="loan_amt" style="background-color:#F8F8F8;"><span>Rs. 300,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Monthly Instalment (EMI)</div>
<div class="emi_sum_value" id="emi_monthly"  style="background-color:#DADADA;"><span>Rs. 6,448</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr" style="background-color:#F8F8F8;"><span>Rs. 86,890</span></div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#DADADA;" id="total_amt"><span>Rs. 386,890</span></div> 

        </div>
      </div></td>
    </tr>
    <tr>
      <td align="center"><div id="container"  style="height:150px;"></div></td>
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
            <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:90px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='numHead'>Year</td>
            <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='oldBal'>Principal</td>
            <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='pt'>Interest</td>
            <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;'id='oil' >Balance Amount</td>
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
      <td  style='border: 1px solid #DBDAD7;background: #88a943;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' height="30">Bank Name</td>
      <td style='border: 1px solid #DBDAD7;background: #88a943;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' align="center">Interest Rate(New Car)</td>
      <td  style='border: 1px solid #DBDAD7; background: #88a943;	border-top: 0; width:150px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;'><div id="intr_text"><span>Per Lac EMI (for 5 years)</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center"   class="default_td">HDFC Bank</td>
      <td align="center"  class="default_td">10.75% - 12.50% </td>
      <td align="center"  class="default_td"><div id="hdfc_bnk"><span>Rs. 2,137 - Rs. 2,250</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td">State Bank of India (SBI)</td>
      <td align="center"  class="default_td">10.75%</td>
      <td align="center"  class="default_td"><div id="sbi_bnk"><span>Rs. 2,162</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td">Kotak Mahindra</td>
      <td align="center"  class="default_td">11.50% - 13.50%</td>
      <td align="center"  class="default_td"><div id="kotak_bnk"><span>Rs. 2,199 - Rs. 2,301</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td">Axis Bank </td>
      <td align="center"  class="default_td">11.50% - 14.50%</td>
      <td align="center"  class="default_td"><div id="axis_bnk"><span>Rs. 2,199 - Rs. 2,353</span></div></td>
    </tr>
	
  </table></div>
  <div  style="clear:both;"></div>
<?php #include "responsive_footer.php"; ?>
</div>
<?php 
#include "car_loan_footer_form.php"; 
#include "footer_cl.php"; 
include("footer_sub_menu.php"); 
?>
</body>
</html>