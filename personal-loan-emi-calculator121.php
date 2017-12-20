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
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<Title>Personal Loan EMI Calculator | Personal Loan Calculator India</title>
<meta name="keywords" content="calculate emi of Personal, emi Personal calculator, calculate Personal loan, Personal loan emi calculator, emi calculator for personal loan, unsecured loan calculator, personal loan calculator"/>
<meta name="description" content="Personal Loan Emi Calculator - Calculate Equated Monthly Installment (EMI) on Personal Loan with interactive charts & Get emi quotes by SBI, ICICI Bank, Axis Bank, Bajaj Finserv, Standard chartered, Kotak."/>
<?php
if(strlen($_GET['source'])>0)
{
	echo '<link rel="canonical" href="http://www.deal4loans.com/personal-loan-emi-calculator.php"/>';
}
?>
<link href="source.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script src="amort1.js"></script>
<style>
div, h4,p  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px Arial, Helvetica, sans-serif;    color: #00000;}
.emi_right_box{ float:left; width:330px; border:2px solid #547295;}
.emi_sum_amount{ float:left; padding:2px; width:228px; font-size:11px; }
.emi_sum_value{ float:right; padding:2px; font-size:11px; font-weight:bold; width:90px;}
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
	var icici1=13.49/1200;
	var icici2=17.5/1200;
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
	var ing1=13.75/1200;
	var ing2=18.25/1200;
	var getemicalcing1=emiPrincipal*ing1*(Math.pow(1+ing1,emiTenure)/(Math.pow(1+ing1,emiTenure)-1));
		var getemicalcing2=emiPrincipal*ing2*(Math.pow(1+ing2,emiTenure)/(Math.pow(1+ing2,emiTenure)-1));
	var viewemiing="Rs." + Math.round(getemicalcing1) + " - Rs." + Math.round(getemicalcing2);
	jQuery("#ing_bnk span").text(viewemiing);
	//for Kotak
	var ing1=13.50/1200;
	var ing2=17/1200;
	var getemicalcing1=emiPrincipal*ing1*(Math.pow(1+ing1,emiTenure)/(Math.pow(1+ing1,emiTenure)-1));
	var getemicalcing2=emiPrincipal*ing2*(Math.pow(1+ing2,emiTenure)/(Math.pow(1+ing2,emiTenure)-1));
	var viewemiing="Rs." + Math.round(getemicalcing1) + " - Rs." + Math.round(getemicalcing2);
	jQuery("#kotak_bnk span").text(viewemiing);

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
	if(sWidth>680) { totWidth = 550; totHeight = 300; } else { totWidth = 300; totHeight = 200; }//550
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
<?php include "pl-form-jscalc.php"; ?>
<link href="source1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="menu-style.css">
<link href="css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
</head>
<body >

<div class="hide_top_menu"><?php include "top-menu.php"; ?></div>
<?php include "main-menu2.php"; ?>
<script type="text/javascript" src="script1.js"></script>
<div style="clear:both;"></div>
<div class="hl_emi_cal_wrapper">
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal loan</u></a> <span class="text12" style="color:#4c4c4c;"> > Personal Loan EMI Calculator </span></div>
<div class="title" style="margin-top:15px;"><h1 class="text3" style=" color:#88a943; font-size:24px; text-transform:none;">Personal Loan EMI Calculator</h1></div>
<div style="clear:both; height:2px;"></div>
<div  class="process_sec">Process - 1</div>
<div class="pl_form_emi_box">
<?php 
$newsource="PL emi calc";
$subjectLine="Get Personal loan emi calculation from 10 Banks";
include "pl-formemicalc.php"; 
?></div>
  <div class="hl_emi_process_box">
  
    <div class="text" style="color:#4c4c4c; size:18px; height: auto; padding-left:10px;"><div class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:10px;">Process - 2<br />
    Just calculate Personal loan EMI Sample Calculations</div></div>
    <div style="border:#666666 1px solid; padding-left:5px; background-color:#F8F8F8;" class="margin_top">  <table border="0" cellpadding="3" cellspacing="2" width="95%" align="center">
<tr><td colspan="3" height="5"></td></tr>
<tr><td width="199" height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;"> Personal Loan Amount <span style="font-weight:normal;">&nbsp;&nbsp;&nbsp;Rs.</span></td>
<td width="72"><input type="test" value="0" name="amount_1a" id="amount_1a" size="11" onchange=" EMI_calc();" /></td><td width="266"></td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_la"></div></td><tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Interest Rate</td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="11" onchange=" EMI_calc();" /> </td><td style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">% Per Annum</td></tr>
<tr><td colspan="3" height="20"><div id="slider_intr"></div></td><tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Loan Tenure</td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="11" onchange=" EMI_calc();" /> </td><td style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Years</td></tr>
<tr><td colspan="3" height="20"><div id="slider_lt" ></div></td><tr>
</table></div>
  </div>

 <div class="hl_emi_right_box">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td valign="middle"><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=236732309688469" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe></td>
     </tr>
     <tr>
       <td valign="middle" class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:20px;" >Sample Results</td>
     </tr>
     <tr>
       <td><div class="emi_right_box">
<div style="float:left; width:100%; background-color:#F8F8F8; padding-bottom:0px;">
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Loan Amount </div>
<div class="emi_sum_value" id="loan_amt" style="background-color:#F8F8F8;"><span>Rs. 200,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Monthly Instalment (EMI)</div>
<div class="emi_sum_value" id="emi_monthly"  style="background-color:#DADADA;"><span>Rs. 5,516</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr" style="background-color:#F8F8F8;"><span>Rs. 64,748</span></div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#DADADA;" id="total_amt"><span>Rs. 264,748</span></div> 
</div>
</div></td>
     </tr>
     <tr>
       <td align="center"><div id="container"  style="height:150px;"></div></td>
     </tr>
   </table>
 </div>
<div style="clear:both;"></div>
<div class="hl_emi_chart"><div id="barChart"></div></div>
<div class="hl_emi_tbl_dis">
<div id="tblpaymentsDetails">
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
</table></div></div>

</div>
<div style="clear:both;"></div>
<div class="pl_emi_cal_table" style="margin-top:15px;"><table  style=' clear: both;    background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; ' width="100%">
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
      <td align="center"  class="default_td">13.49% - 17.5%</td>
      <td align="center"  class="default_td"><div id="icici_bnk"><span>Rs. 5,414 - Rs. 5,823</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td">Bajaj Finserv</td>
      <td align="center"  class="default_td">15.75% - 17%</td>
      <td align="center"  class="default_td"><div id="bajaj_bnk"><span>Rs. 5,642 - Rs. 5,771</span></div></td>
    </tr>
<tr height="18">
      <td height="18" align="center"   class="default_td">ING Vysya </td>
      <td align="center"  class="default_td">13.75% - 18.25%</td>
      <td align="center"  class="default_td"><div id="ing_bnk"><span>Rs. 5,440 - Rs. 5,901</span></div></td>
    </tr>
	
    <tr height="18">
      <td height="18" align="center"   class="default_td">Kotak</td>
      <td align="center"  class="default_td">13.50% - 17%</td>
      <td align="center"  class="default_td"><div id="kotak_bnk"><span>Rs. 5,415 - Rs. 5,771</span></div></td>
    </tr>
</table></div> 
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
<div class="pl_emi_cal_text">
  <p>If you are looking for how much you have to pay per month for   the Personal loan that you want to take</p>
  <p>This is the right place to be –</p>
  <p> </p>
  <p>To get the exact amount </p>
  <p>1.You need to know your Loan amount ?</p>
  <p>2.The rate of interest that bank is going to charge you   ?</p>
  <p>3.How long will you want to return the loan ?</p>
  <p> </p>
  <p>If you know the above three variables , use our calculator   and find the exact Emi, Total interest and the extra amount you will have to pay   for the loan.</p>
  <p> </p>
  <p>If the above is not known to use, inputs your professional   details, on the basis of best Bank policies we will let you know-</p>
  <p>1.How much Personal loan each Bank can give   you.</p>
  <p>2.What is the rate of interest the banks are going to charge   you.</p>
  <p>3.What is the net interest pay out at your end and what   tenure you can take the loan.</p>
  <p> </p>
  <p>Personal loan emi is calculated on the basis   of</p>
  <p>1.Loan amount</p>
  <p>2.Interest rates</p>
  <p>3.Tenure</p>
  <p>4.Other loan emis</p>
  <p>5.Your work profile-Salaried or Self-employed</p>
  <p>6.The company that work for E.g.- If you work in top 5000   companies-Banks are ready to fund more Personal loan at lower   rates.</p>
  <p>7.Your Credit History- Some Bank caps the loan amount if your   credit score is low.</p>
  <br />
  <div  style="clear:both;"></div>
  
  <div class="txt">
  <strong>Other Available Calculators & Tools to Calculate EMI & Eligibility  of Loans</strong>
                <table cellpadding="3" cellspacing="2" border="0" width="100%" style="border:#999999 1px solid;">
                <tr><td  bgcolor="#CCCCCC"><a href="http://www.deal4loans.com/Contents_Calculators.php" target="_blank">EMI Calculator</a></td><td  bgcolor="#CCCCCC"><a href="http://www.deal4loans.com/home-loan-eligibility-calculator.php" target="_blank">Home Loan Eligibility Calculator</a></td><td  bgcolor="#CCCCCC"><a href="home-loan-emi-calculator1.php" target="_blank">Home Loan EMI Calculator</a></td></tr>
                <tr><td> <a href="home-loan-balance-transfer-calculator.php" target="_blank">Home Loan Balance Transfer</a></td>
                <td><a href="http://www.deal4loans.com/car-loan-emi-calculator.php" target="_blank">Car Loan Emi Calculator</a></td>
                <td><a href="http://www.deal4loans.com/personal-loan-emi-calculator.php" target="_blank">Personal Loan Emi Calculator</a> </td>
                  </tr>
                <tr><td  bgcolor="#CCCCCC"><a href="http://www.deal4loans.com/loans/calculators/two-wheeler-loan-emi-calculator-calculate-loan-emi-online/" target="_blank">Two Wheeler Loan Emi Calculator</a></td>
                <td  bgcolor="#CCCCCC"><a href="loan-amortization-calculator.php" target="_blank">Loan Amortization Calculator</a></td><td bgcolor="#CCCCCC"><a href="http://www.deal4loans.com/balance-transfer-home-loans.php" target="_blank">Balance Transfer home loans</a></td>
                </tr>
                <tr>
                  <td><a href="pre-payment-calculator.php" target="_blank">Prepayment Calculator</a></td>
                  <td><a href="http://www.deal4loans.com/part-payment-calculator.php" target="_blank">Part Payment Calculator</a></td>
                  <td>&nbsp;</td>
                </tr>
                </table>
</div>
<div style="font-size:10px; width:100%; padding-top:10px; color:#666666;"><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.</div>

</div>

<div style="clear:both;"></div>
<?php
include "responsive_footer.php";
?>

</div>
<div class="hide_top_menu"><?php include "footer_pl.php"; ?></div>
</body>
</html>