<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/functions.php';
require 'scripts/db_init.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;
$retrivesource="LAP EMI Calc";
$TagLine = "Get Quote for Loan Against Property";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loan Against Property Calculator in India | Deal4loans</title>
<meta name="keywords" content="Loan Against Property emi calculator, Loan Against Property calculator, calculate emi of lap, emi lap calculator, calculate Loan Against Property, Loan Against Property calculator "/>
<meta name="description" content="Calculate Loan Against Property EMI & Eligibility from HDFC, Ing vysya, ICICI, Axis, India Bulls, Fullerton etc only on Deal4loans.com"/>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/loan-against-property-styles.css" type="text/css" rel="stylesheet"  />

<style>
div, h4,p  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px !important;    color: #00000;}
.emi_right_box{ float:left; width:97%; border:5px solid #547295; font-size:14px !important; margin-left:0px;}
.emi_sum_value{ float:right;font-size:12px; font-weight:bold; width:100px;padding-top: 5px; padding-bottom: 5px;}

.default_td
 {
 border: 1px solid #DBDAD7;background: #fffff; border-top: 0; font: 12px;}
 
 @media screen and (max-width:680px){
	 
	 .emi_sum_value{ float:right;font-size:12px; font-weight:bold; width:74px !important;padding-top: 5px; padding-bottom: 5px;}
	 }

</style>

</head>
<body>
<?php include "middle-menu.php"; ?>
<link rel="stylesheet" href="/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<link href="css/wp_cl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="ajax-dynamic-list-clhdfc.js"></script>

<script src="amort1.js"></script>
<script>
//loan amount
$(function() {
			$( "#slider_la" ).slider({
			range: "min",
			value: 1500000,
			min: 500000,
			step: 100000,
			max:  8000000,
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

//interest rate
$(function() {
			$( "#slider_intr" ).slider({
			range: "min",
			value: 12.5,
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
			value: 15,
			min: 1,
			step: 1,
			max:  20,
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
					data:[["LAP Amount",
					Math.round(1500000* 100/(18488*180))],
					{name:"Total Interest",
					y:Math.round(100-1500000*100/(18488*180)),
				sliced:true,selected:true}]}]})
});



$(function () {
    var chart;
				var sWidth = screen.width;
var totWidth;
var totHeight;
if(sWidth>690) { totWidth = 550; totHeight = 300; } else { totWidth = 300; totHeight = 200; }//550
    $(document).ready(function() {
	var catxAxis = new Array('Year 1','Year 2','Year 3','Year 4','Year 5','Year 6','Year 7','Year 8','Year 9','Year 10','Year 11','Year 12','Year 13','Year 14','Year 15');
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
                data: [36394,41213,46671,52853,59848,67775,76750,86912,98420,111453,126211,142922,161849,183280,207639]
            }, {
               name: 'Interest',
                data: [185462,180643,175185,169003,162008,154081,145106,134944,123436,110403,95645,78934,60007,38576,14309]
            }]
        });
    });
    
});

</script>
<div class="lap_inner_wrapper" style="margin:auto;">
    <div style="margin-top:70px;" class="common-bread-crumb"><a href="index.php" class="text12" style="color:#0080d6; font-size:14px;">Home</a> <strong style="font-size:14px; font-weight:normal;" class="text12"> » </strong> <span style="color:#4c4c4c; font-size:14px;">Loan Against Property EMI Calculator</span></div>
  
  
<h1 class="lap-h1">Loan Against Property EMI Calculator</h1>
<div style="clear:both; height:10px;"></div>
 <?php include "loan-against-property-widget.php"; ?>
<div style="clear:both; height:10px;"></div>

<div class="cl_emi_process_box" style="border:#666666 1px solid; padding-left:5px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#F8F8F8"  ><table border="0" cellpadding="3" cellspacing="2" width="95%" align="center">
<tr><td width="161" height="20" style="color:#333333; font-weight:bold;"> Loan Amount <span>&nbsp;&nbsp;&nbsp;Rs.</span></td>
<td width="71"><input type="test" value="0" name="amount_1a" id="amount_1a" size="11"  onchange=" EMI_calc();"/></td><td width="319"></td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_la"></div></td><tr>

<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px;">Interest Rate</td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="11"  onchange=" EMI_calc();"/> </td><td style="color:#333333; font-weight:bold; font-size:13px;">% Per Annum</td></tr>
<tr><td colspan="3" height="20"><div id="slider_intr"></div></td><tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px;">Loan Tenure</td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="11"  onchange=" EMI_calc();"/> </td><td style="color:#333333; font-weight:bold; font-size:13px;">Years</td></tr>
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
<div class="emi_sum_value" id="loan_amt" style="background-color:#F8F8F8;"><span>Rs. 15,00,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Monthly Instalment (EMI)</div>
<div class="emi_sum_value" id="emi_monthly"  style="background-color:#DADADA;"><span>Rs. 18,488</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr" style="background-color:#F8F8F8;"><span>Rs. 18,27,810</div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#DADADA;" id="total_amt"><span>Rs. 33,27,810</span></div> 

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
         <div id="tblpaymentsDetails"> <table id='pmtTab' style=' clear: both;    background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; '>
          <tr >
            <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:90px; color:#FFFFFF;' id='numHead'>Year</td>
            <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; color:#FFFFFF;' id='oldBal'>Principal</td>
            <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; color:#FFFFFF;' id='pt'>Interest</td>
            <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; color:#FFFFFF;'id='oil' >Balance Amount</td>
          </tr> <tr>
    <td height="18" align="center" width="64"  class="default_td" >1</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 36,394</td>
    <td height="18" align="center" width="64"  class="default_td" >Rs. 185,462</td>
    <td height="18" align="center" width="64"  class="default_td" >Rs. 1,463,606</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td" >2</td>
    <td height="18" align="center" width="64"  class="default_td" >Rs. 41,213</td>
    <td height="18" align="center" width="64"  class="default_td" >Rs. 180,643</td>
    <td height="18" align="center" width="64"  class="default_td" >Rs. 1,422,393</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">3</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 46,671</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 175,185</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,375,722</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">4</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 52,853</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 169,003</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,322,869</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">5</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 59,848</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 162,008</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,263,021</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">6</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 67,775</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 154,081</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,195,246</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">7</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 76,750</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 145,106</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,118,496</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">8</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 86,912</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 134,944</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 1,031,584</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">9</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 98,420</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 123,436</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 933,164</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">10</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 111,453</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 110,403</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 821,711</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">11</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 126,211</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 95,645</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 695,500</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">12</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 142,922</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 78,934</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 552,578</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">13</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 161,849</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 60,007</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 390,729</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">14</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 183,280</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 38,576</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 207,449</td>
  </tr>
  <tr>
    <td height="18" align="center" width="64"  class="default_td">15</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 207,639</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 14,309</td>
    <td height="18" align="center" width="64"  class="default_td">Rs. 0</td>
  </tr></table></div>
        </td>
      </tr>
      <tr>
        <td><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=236732309688469" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe></td>
      </tr>
    </table>
  </div>
   <div  style="clear:both;"></div>
  <h3>You Can Calculate Loan Against Property EMI for below mentioned Banks: list as follows:</h3>
  <p>SBI, HDFC, Axis Bank, Bank of Baroda, Bank of India, Union Bank, DHFL, LIC Housing, SBP, Canara Bank, Allahabad Bank, ICICI Bank, Yes Bank, Citibank, PNB, uco bank, Indiabulls & others.</p>
<br />
  
  <div style="clear:both;"></div>
  <div class="cl_emi_table_b"></div>
  <div  style="clear:both;"></div>
</div>
<?php 
#include "footer_cl.php";
include("footer_sub_menu.php"); 
?>
</body>
</html>