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
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<Title>Personal Loan EMI Calculator | Personal Loan Calculator India</title>
<meta name="keywords" content=" personal loan emi calculator, calculate emi of Personal, emi Personal calculator, calculate Personal loan, emi calculator for personal loan, personal loan calculator"/>
<meta name="description" content=" Looking for EMI calculation for personal loan, Now use this personal Loan EMI Calculator which helps you in Calculate Equated Monthly Installment (EMI) with interactive charts. Get EMI details of SBI, HDFC, ICICI Bank, Axis Bank, Bajaj Finance, Fullerton, Citibank and others."/>
<?php
if(strlen($_GET['source'])>0)
{
	echo '<link rel="canonical" href="http://www.deal4loans.com/personal-loan-emi-calculator.php"/>';
}
?>

<link rel="stylesheet" href="/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script src="amort1.js"></script>
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet" />
<style>
.emi_right_box{ float:left; width:330px; border:2px solid #547295;}
.emi_sum_amount{ float:left; padding:2px; width:228px; font-size:14px; line-height:1.5 }
.emi_sum_value{ float:right; padding:2px; font-size:14px; font-weight:bold; width:90px;}
.default_td
 {
 border: 1px solid #DBDAD7;background: #fffff; border-top: 0; font-size: 14px;}

</style>
<script>
//loan amount

/*
$(document).ready(function(){
 $('#amount_1a').click(function(){
	$('#slider_la').slider.value = 250000;
 });
 $('.amount_1a').change(function() {
    var value = $(this).attr("value"),
        selector = ("#" + $(this).attr("id").slice(0,-7));
        selector.slider("value", value);
})  
});
*/
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
			   $('#amount_1a').change(function () {
	       		 var value = this.value, selector = $( "#slider_la" );
    		    selector.slider("value", value);
    });

		
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
	
		$('#amount_intr').change(function () {
			 var value = this.value, selector = $( "#slider_intr" );
			selector.slider("value", value);
		});

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
fillrates(emiPrincipal,emiTenure);

}

function inrFormat(nStr) { // nStr is the input string
	var addCur = "Rs.";
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
        if(z > 0)
        {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        else
        {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
          rgx = /(\d+)(\d{2})/;
        }
        z++;
        num--;
        if(num == 0)
        {
          break;
        }
      }
     return addCur + x1 + x2;
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
	var ing1=11.50/1200;
	var ing2=20.00/1200;
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
<?php //include "pl-form-jscalc.php"; ?>
<link href="css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<?php //include "middle-menu.php"; ?>
<div style="height:70px;"></div>
<div class="d4l_inner_wrapper">
  <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="personal-loans.php">Personal loan</a> <span> > Personal Loan EMI Calculator </span></div>
    <h1 class="pl-h1">Personal Loan EMI Calculator</h1>
<div style="clear:both; height:2px;"></div>

<h2 class="pl-h2">Process - 1</h2>

<div> <?php
$source = "PL emi calc";
$TagLine = "Get instant quotes on Interest Rates & EMI on personal loan from top 10 banks of India";
$PostURL = "/personal-loan-emi-calculator.php";
$TypeLoan = "Req_Loan_Personal";  
 include "personal-loan-widget.php"; ?></div>
  <div class="hl_emi_process_box">
  <div style="height:15px;"></div>
    <div><h2 class="pl-h2">Process - 2</h2><br />
    Just calculate Personal loan EMI Sample Calculations</div>
    <div style="height:10px;"></div>
    <div style="border:#666666 1px solid; padding-left:5px; background-color:#F8F8F8;" class="margin_top">  <table border="0" cellpadding="3" cellspacing="2" width="95%" align="center">
<tr><td colspan="3" height="5"></td></tr>
<tr><td width="239" height="20"> <strong>Personal Loan Amount</strong> <span>&nbsp;&nbsp;&nbsp;Rs.</span></td>
<td width="67"><input type="test" value="0" name="amount_1a" id="amount_1a" size="11" onchange=" EMI_calc();" /></td><td width="253"></td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_la"></div></td><tr>
<tr><td height="20"><strong>Interest Rate</strong></td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="11" onchange=" EMI_calc();" /> </td><td><strong>% Per Annum</strong></td></tr>
<tr><td colspan="3" height="20"><div id="slider_intr"></div></td><tr>
<tr><td height="20"><strong>Loan Tenure</strong></td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="11" onchange=" EMI_calc();" /> </td><td><strong>Years</strong></td></tr>
<tr><td colspan="3" height="20"><div id="slider_lt" ></div></td><tr>
</table></div>
  </div>
 <div class="hl_emi_right_box">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td valign="middle" class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:20px;" ><strong>Sample Results</strong></td>
     </tr>
     <tr>
       <td><div class="emi_right_box">
<div style="float:left; width:100%; background-color:#F8F8F8; padding-bottom:0px;">
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Loan Amount </div>
<div class="emi_sum_value" id="loan_amt" style="background-color:#F8F8F8;"><span>Rs. 2,00,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Monthly Instalment (EMI)</div>
<div class="emi_sum_value" id="emi_monthly"  style="background-color:#DADADA;"><span>Rs. 5,516</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr" style="background-color:#F8F8F8;"><span>Rs. 64,748</span></div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#DADADA;" id="total_amt"><span>Rs. 2,64,748</span></div> 
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
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:90px; color:#FFFFFF;' id='numHead'>Year</td>
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; color:#FFFFFF;' id='oldBal'>Principal</td>

      <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; color:#FFFFFF;' id='pt'>Interest</td>
      <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; color:#FFFFFF;'id='oil' >Balance Amount</td>
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

 <table>
    <tr><td align="right" style="margin-top:3px;"> 
<div style="width:160px; float:right;">
<div align="left">
 <div align="right" style="width:77px; float:left; margin-top:7px;">
<!-- Place this tag in your head or just before your close body tag. -->
<script type="text/javascript" src="https://apis.google.com/js/platform.js"></script>
<!-- Place this tag where you want the share button to render. -->
<div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60" data-href="http://www.deal4loans.com/personal-loan-emi-calculator.php"></div>
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
<div class="fb-share-button" data-href="http://www.deal4loans.com/personal-loan-emi-calculator.php" data-width="60" data-type="box_count"></div>
</div>
  </div>
  </div>
</td></tr> </table>

</div>

<div style="clear:both;"></div>
<div class="pl_emi_cal_table" style="margin-top:15px;"><table  style=' clear: both;    background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; ' width="100%">
    <tr >
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:150px; color:#FFFFFF;'>Bank Name</td>
      <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:150px; color:#FFFFFF;'>Interest Rate</td>
      <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; color:#FFFFFF;' ><div id="intr_text" align="center"><span style="width:170px;" align="center">Estimated EMI as Per Loan Amount</span></div></td>
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
	<!--
    <tr height="18">
      <td height="18" align="center"   class="default_td">ING Vysya </td>
      <td align="center"  class="default_td">13.75% - 18.25%</td>
      <td align="center"  class="default_td"><div id="ing_bnk"><span>Rs. 5,440 - Rs. 5,901</span></div></td>
    </tr>
	-->
    <tr height="18">
      <td height="18" align="center"   class="default_td">Kotak Bank</td>
      <td align="center"  class="default_td">11.50% - 20%</td>
      <td align="center"  class="default_td"><div id="kotak_bnk"><span>Rs. 5,217 - Rs. 6,086</span></div></td>
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
<div class="d4l_inner_wrapper">
  <p>If you are looking for how much you have to pay per month for the Personal loan that you want to take</p>
  <p>This is the right place to be –</p>
  <p> </p>
  <p>To get the exact amount </p>
  <p>1.You need to know your Loan amount ?</p>
  <p>2.The rate of interest that bank is going to charge you   ?</p>
  <p>3.How long will you want to return the loan ?</p>
  <p> </p>
  <p>If you know the above three variables, use our calculator and find the exact Emi, Total interest and the extra amount you will have to pay   for the loan.</p>
  <p> </p>
  <p>If the above is not known to use, inputs your professional details, on the basis of best Bank policies we will let you know-</p>
  <p>1.How much Personal loan each Bank can give you.</p>
  <p>2.What is the rate of interest the banks are going to charge you.</p>
  <p>3.What is the net interest pay out at your end and what tenure you can take the loan.</p>
  <p> </p>
  <p><strong>Personal loan emi is calculated on the basis of</strong></p>
  <p>1.Loan amount</p>
  <p>2.Interest rates</p>
  <p>3.Tenure</p>
  <p>4.Other loan emis</p>
  <p>5.Your work profile-Salaried or Self-employed</p>
  <p>6.The company that work for E.g.- If you work in top 5000 companies-Banks are ready to fund more Personal loan at lower   rates.</p>
  <p>7.Your Credit History- Some Bank caps the loan amount if your credit score is low.</p>
 <div  style="clear:both;"></div>
  <h3>You Can Calculate Personal loan EMI for below mentioned Banks: list as follows:</h3>
  <p>SBI, HDFC, Axis Bank, Bank of Baroda, Bank of India, Union Bank, DHFL, LIC Housing, SBP, Canara Bank, Allahabad Bank, ICICI Bank, Yes Bank, Citibank, PNB, uco bank, Indiabulls & others.</p>
<br />
<div  style="clear:both;"></div>
<div style="font-size:14px; width:100%; padding-top:10px; color:#666666;"><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.</div>

</div>

<div style="clear:both;"></div>
<?php include("footer_sub_menu.php"); ?>
</div>
</body>
</html>