<html lang="en">
<head>
<meta charset="utf-8" />
<title>jQuery UI Slider - Default functionality</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="amort.js"></script>
<script>
//loan amount
$(function() {
			$( "#slider_la" ).slider({
			range: "min",
			value: 100000,
			min: 100000,
			step: 50000,
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
	jQuery("#emi_monthly span").text(Math.round(emi));
	jQuery("#total_intr span").text(Math.round(emi* emiTenure-emiPrincipal));
	jQuery("#total_amt span").text(Math.round(emi*emiTenure));
	var month_emi=Math.round(emi);
	var emi_tenure=Math.round(emiTenure);
displayPieChart(month_emi,emi_tenure,emiPrincipal);
//calculateamortization(emiTenure,emiPrincipal,month_emi,emiRate,emi);

var intRate = emiRate * 12 * 100;

commitData(emiPrincipal,intRate,emiTenure);
//displayschduled(emiTenure,emiPrincipal,month_emi);

}
function displayPieChart(month_emi,emi_tenure,emiPrincipal)
	{ 
		pchart=new Highcharts.Chart({
		chart:{renderTo:"container",
	plotBackgroundColor:null,
	plotBorderWidth:null,
			plotShadow:false},
			title:{text:"Total Payment"},
			tooltip:{
			formatter:function(){return"<b>"+this.point.name+"</b>: "+this.y+" %"}},
plotOptions:{
				pie:{allowPointSelect:true,cursor:"pointer",
					dataLabels:{enabled:true,  color: '#000000'},
					showInLegend:true}},
					series:[{type:"pie",
					name:" ",
					data:[["Principal Personal Loan Amount",
					Math.round(emiPrincipal* 100/(month_emi*emi_tenure))],
					{name:"Total Interest",
					y:Math.round(100-emiPrincipal*100/(month_emi*emi_tenure)),
				sliced:true,selected:true}]}]})
		}

function tenurescheduled_calc(emiTenure,emiPrincipal,month_emi,emiRate,emi){
	//alert(emiRate);
var Year_tbl=[];
var Principal_tbl=[];
var Interest_tbl=[];
var Balance_tbl=[];
var a=[],c=[],b=[];
var i,j;
for(i=0;i<emiTenure/12;i++)Year_tbl[i]=i+1;

c[0]=emiPrincipal*emiRate;
a[0]=emi-c[0];
b[0]=emiPrincipal-a[0];

for(i=1;i<emiTenure;i++)
	{c[i]=b[i-1]*emiRate,a[i]=emi-c[i],b[i]=b[i-1]-a[i]};

for(i=b[emiTenure-1]=0;i<emiTenure/12;i++){a=emiTenure/12*12-i*12>=12?12:emiTenure/12*12-i*12;
for(j=Interest_tbl[i]=0;j<a;j++) {Interest_tbl[i]+=c[i*12+j]};
Interest_tbl[i]=Math.round(Interest_tbl[i]);
Principal_tbl[i]=Math.round(emi* a-Interest_tbl[i]);
Balance_tbl[i]=Math.round(b[(i+1)*12-(12-a)-1])
alert(Balance_tbl[i]);	
}

//alert(Year_tbl[1]);
displayschduleder(Year_tbl,Interest_tbl,Balance_tbl,Principal_tbl);

}


function displayschduleder(Year_tbl,Interest_tbl,Balance_tbl,Principal_tbl)
{
	alert(Year_tbl.length);
	var a='<table><tr><td>Year</td><td>Principal Amount</td><td>Interest Amount</td><td id="bhead">Balance Amount</td></tr>';for(i=0;i<Year_tbl.length;i++)a+="<tr><td>"+Year_tbl[i]+'</td><td>Rs. '+Principal_tbl[i]+'</td><td>Rs. '+
Interest_tbl[i]+'</td><td >Rs. '+Balance_tbl[i]+"</td></tr>";a+="</table>";
	jQuery("#amortization").html(a)

}

</script>
</head>
<body>
<table border="1">
<tr><td>Loan Amount</td><td><input type="test" value="0" name="amount_1a" id="amount_1a" size="15"/></td></tr>
<tr><td><div id="slider_la" style="width:200px;"></div></td><tr>

<tr><td>Interest Rate</td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="15"/></td></tr>
<tr><td><div id="slider_intr" style="width:200px;"></div></td><tr>

<tr><td>Loan Tenure</td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="15"/></td></tr>
<tr><td><div id="slider_lt" style="width:200px;"></div></td><tr>
</table>

<table>
<tr><td>Sample results</td></tr>
<tr><td>Monthly Instalment (EMI)</td></tr>
<tr><td><div id="emi_monthly"><span></span></div></td></tr>

<tr><td>Total Interest Amount</td></tr>
<tr><td><div id="total_intr"><span></span></div></td></tr>
<tr><td>Total Amount<br>(Principal + Interest)</td></tr>
<tr><td><div id="total_amt"><span></span></div></td></tr>
</table>

<table>
<tr><td><div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div></td></tr>
</table>
<table>
<tr><td>
<div id="tblpaymentsDetails"></div>
</td>
</tr>
</table>
</body>
</html>