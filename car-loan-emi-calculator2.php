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
 <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<Title>Car Loan EMI Calculator - Calculate your eligibility with Car Loan calculator | Deal4loans</title>
<meta name="keywords" content="calculate emi of car, emi car calculator, calculate car loan, car loan loan calculator, indian car loan emi calculator, used car emi, new car emi"/>
<meta name="description" content="Car loan emi calculator?? Car loan Calculator for new and used car loans. Calculate accurate car loan eligibility with Deal4loans.com"/>
<link href="source.css" rel="stylesheet" type="text/css" />
 <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<link rel="stylesheet" href="/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<!--<link rel="stylesheet" href="/resources/demos/style.css" />-->
<script src="http://code.highcharts.com/highcharts.js"></script>
<!--<script src="http://code.highcharts.com/modules/exporting.js"></script>-->
<script src="amort1.js"></script>
<style>
div, h4,p  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px Arial, Helvetica, sans-serif;    color: #00000;}
body,input {    font: 13px Arial, Helvetica, sans-serif;    color: #00000;}
#emisum { background: none repeat scroll 0pt 0pt #fcfcfc; clear: both; float: left; width: 240px; margin: 0pt 10px 20px 0pt; border: 5px solid #547295; height: 240px; }
#emisum div { margin: 0pt 0pt 16px; padding: 10px 10px 0pt; text-align: center; width: 220px; border-top: 1px dotted rgb(147, 79, 79); }
#emisum h4 { color: #934f4f; font-weight: bold; }
#emisum p { font-size: 18px; font-weight: bold; margin: 0pt auto; }
#emisum span { padding-left: 5px; }
#emiamount { border-top: 0pt none ! important; }
#emiamount p { font-size: 24px; }

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
	jQuery("#emi_monthly span").text(Math.round(emi));
	jQuery("#total_intr span").text(Math.round(emi* emiTenure-emiPrincipal));
	jQuery("#total_amt span").text(Math.round(emi*emiTenure));
	var month_emi=Math.round(emi);
	var emi_tenure=Math.round(emiTenure);
displayPieChart(month_emi,emi_tenure,emiPrincipal);

var intRate = emiRate * 12 * 100;
commitData(emiPrincipal,intRate,emiTenure);

displayBarChart (emiPrincipal,intRate,emiTenure);

}
function displayPieChart(month_emi,emi_tenure,emiPrincipal)
{ 
	piechart=new Highcharts.Chart({
	chart:{renderTo:"container",
	plotBackgroundColor:null,
	plotBorderWidth:null,
			plotShadow:true},
			title:{text:"Total Payment"},
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
 	//alert(finalVal[0]);	
//	alert(finalVal[1]);	
	//alert(finalVal[2]);	

	
	var principalAxis = finalVal[0];
	var intrAxis = finalVal[1];
	var catxAxis = finalVal[2];
	
	alert(principalAxis.length);
	alert(intrAxis.length);
	alert(catxAxis.length);

	var catxAxis = new Array('Year 1','Year 2','Year 3','Year 4','Year 5');
	
var chart;
 chart = new Highcharts.Chart({
            chart: {
                renderTo: 'barChart',
                type: 'column'
            },
            title: {
                text: 'Bar chart'
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
                        this.series.name +': '+ this.y +'';
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
               data: [14685, 16961, 19591, 22628, 26136]
            }]
        });
}	
	
				
	$(function () {
  var pchart=new Highcharts.Chart({
		chart:{renderTo:"container",
	plotBackgroundColor:null,
	plotBorderWidth:null,
			plotShadow:true},
			title:{text:"Total Payment"},
			tooltip:{
			formatter:function(){return"<b>"+this.point.name+"</b>: "+this.y+" %"}},
plotOptions:{
				pie:{allowPointSelect:true,cursor:"pointer",
					dataLabels:{enabled:false,  color: '#000000'},
					showInLegend:true}},
					series:[{type:"pie",
					name:" ",
					data:[["Principal Personal Loan Amount",
					Math.round(300000* 100/(7058*60))],
					{name:"Total Interest",
					y:Math.round(100-300000*100/(7058*60)),
				sliced:true,selected:true}]}]})
});

/*$(function () {
var Principal="300000";
var tenure="60";
var Rate="14.5";
commitData(Principal,Rate,tenure);
}*/
</script>

</head>
<body>
<?php include "top-menu.php";  include "main-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car loan</u></a> <span class="text12" style="color:#4c4c4c;"> > Car Loan EMI Calculator </span></div>
<div class="intrl_txt" style="margin:auto;">
<div style=" float:left; width:940px; height:auto; margin-top:15px; margin-left:20px; text-align:justify;">
<h1 class="text3"  style="width:900px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943; margin-left:15px;">Car Loan EMI Calculator</h1>
<div style=" margin-left:5px; float:left; width:663px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="900" height="1" /></div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
 <div id="lftbar" style="padding-top:5px; width:100%; ">
  <table cellpadding="0" cellspacing="0" border="0" align="center" class="font2">
<tr><td width="492"  valign="top" bgcolor="#F8F8F8" style="border:#666666 1px solid; padding-left:5px;" >
<table border="0" cellpadding="3" cellspacing="2" width="95%" align="center">
<tr><td colspan="3" height="5"></td></tr>
<tr><td width="152" height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;"> Car Loan Amount <span style="font-weight:normal;">Rs.</span></td>
<td width="90"><input type="test" value="0" name="amount_1a" id="amount_1a" size="11"/></td><td width="193"></td>
</tr>
<tr><td colspan="3" height="25"><div id="slider_la"></div></td><tr>
<tr><td colspan="3" height="5"></td></tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Interest Rate</td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="15"/> </td><td style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">% Per Annum</td></tr>
<tr><td colspan="3" height="25"><div id="slider_intr"></div></td><tr>
<tr><td colspan="3" height="5"></td></tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Loan Tenure</td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="15"/> </td><td style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Years</td></tr>
<tr><td colspan="3" height="25"><div id="slider_lt" ></div></td><tr>
</table>
</td><td width="285" align="center" valign="bottom" style="padding-left:10px;">

<div id="emisum">		<div id="emiamount"><h4>&nbsp;</h4>		  <h4>Monthly Instalment (EMI)</h4>		
  <p style="font-size:12px;" id="emi_monthly">Rs. <span>7,058</span></p>		 
   <p style="font-size:12px;">&nbsp;</p>		</div> 
          <div id="emitotalinterest"><h4>Total Interest Amount</h4>
          <p style="font-size:12px;" id="total_intr">Rs. <span>1,23,509</span></p>      
              <p style="font-size:12px;">&nbsp;</p>        </div>     
                 <div id="emitotalamount" class="column-last"><h4>Total Amount<br/>(Principal + Interest)</h4>
                 <p style="font-size:12px;" id="total_amt">Rs. <span>4,23,509</span></p></div> 
            </div>
                   
</td></tr>
<tr><td><div id="barChart"></div></td><td>  <div id="container"  style="height:230px;"></div></td></tr>
<tr><td colspan="2"><div id="tblpaymentsDetails">

</div></td></tr></table>
<div class="txt">
<h3 class="text" style="color:#4c4c4c; size:18px;">Other Available Calculators are - </h3>
<a href="Contents_Calculators.php"><b>EMI Calculator</b></a> <br />
<a href="http://www.deal4loans.com/home-loan-calculator.php"><strong>Home Loan EMI Calculator</strong></a><br /> 
<a href="balance-transfer-home-loans.php"><strong>Home Loan Balance Transfer</strong></a><br />
<a href="loan-amortization-calculator.php"><strong>Loan Amortization Calculator</strong></a>
</div></div></div></div>
<?php include "car_loan_footer_form.php"; ?> 
<?php include "footer_cl.php"; ?>
</body></html>