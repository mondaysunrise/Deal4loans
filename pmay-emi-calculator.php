<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source']; }
else {	$retrivesource="PMAY Home Loan"; }
$page_Name = "HomeLoan";
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<title>PMAY Housing Loan EMI Calculator 2017 – Calculate EMI online</title>
<meta name="keywords" content="PMAY home loan emi calculator, PMAY housing loan emi calculator, PMAY emi calculator for home loans, PMAY emi calculator for housing loans, emi calculator for PMAY home finance, new home loan emi calculator, PMAY Home loan calculator"/>
<meta name="description" content="PMAY Home loan emi calculator – Deal4loans.com provides simple tool to calculate pmay home loan emi on the basis of Loan amount ✓ Subsidy Interest rates ✓ Repayment tenure online within seconds." />
<meta http-equiv="Expires" content="0"/>
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script src="amort1.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
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
.emi_right_box{ float:left; width:263px; border:3px solid #547295;}
.emi_sum_amount{ float:left; padding:3px; width:153px; font-size:13px; }
.emi_sum_value{ float:right; padding:3px; font-size:13px; font-weight:bold; width:95px;}
.default_td { border: 1px solid #DBDAD7;background: #fffff; border-top: 0; font: 14px;}
.head-calculation{ font-weight:bold; font-size:12.5px; padding-bottom:10px;}
</style>
<!-- For Touchable Slider Code -->
<!--
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
<script src="jquery.ui.touch-punch.min.js"></script>
-->
<!--//-->
<script  type="text/javascript">
function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function validmobile(phone) 
{
	
	atPos = phone.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.mobile, 'Mobile number', 10))
		return false;

return true;
}
function chkformR()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

 if (document.loan_form.Type_Loan.selectedIndex==0)
	{
		document.getElementById('productRVal').innerHTML = "<span  class='hintanchorqa'>Select Product</span>";	
		document.loan_form.Type_Loan.focus();
		return false;
	}
	if(document.loan_form.fullname.value=="")
	{
		document.getElementById('nameRVal').innerHTML = "<span  class='hintanchorqa'>Fill Your Name.</span>";	
		document.loan_form.fullname.focus();
		return false;
	}
 
  if(document.loan_form.mobile.value=="")
	{
		document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
		document.loan_form.mobile.focus();
		return false;
	}
	  if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
		{
			document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
            alert("Enter numeric value");
			  document.loan_form.mobile.focus();
			  return false;  
		}
        if (document.loan_form.mobile.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.mobile.focus();
				return false;
        }
        if ((document.loan_form.mobile.value.charAt(0)!="9") && (document.loan_form.mobile.value.charAt(0)!="8") && (document.loan_form.mobile.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.loan_form.mobile.focus();
                return false;
		}
	if(document.loan_form.email_id.value=="")
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter  Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	
	var str=document.loan_form.email_id.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	
	if (document.loan_form.city.selectedIndex==0)
	{
		document.getElementById('cityRVal').innerHTML = "<span class='hintanchorqa'>Please Select City!</span>";
		document.loan_form.city.focus();
		return false;
	}
	if(document.loan_form.net_salary.value=="")
	{
		document.getElementById('netSalaryRVal').innerHTML = "<span class='hintanchorqa'>Fill your Net salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
	if(document.loan_form.net_salary.value<=0)
	{
		document.getElementById('netSalaryRVal').innerHTML = "<span class='hintanchorqa'>Fill Your Net Salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptRVal').innerHTML = "<span class='hintanchorqa'>Accept the Terms and Condition!</span>";	
		document.loan_form.accept.focus();
		return false;
	}

	
}
function containsdigit(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
{
return true;
}
}
return false;
}
</script>

<script>  
function get_round(X) { return Math.round(X*100)/100 }

//Net Income
$(function() {
			$( "#slider_sal" ).slider({
			range: "min",
			value: 600000,
			min: 200000,
			step: 100000,
			max:  1800000,
			slide: function( event, ui ) {
				$( "#amount_sal" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_sal" ).val( "" + $( "#slider_sal" ).slider( "value" ) );
		$('#amount_sal').change(function () {
	    	 var value = this.value, selector = $( "#slider_sal" );
    	    selector.slider("value", value);
    	});
		
	});

//loan amount
$(function() {
			$( "#slider_la" ).slider({
			range: "min",
			value: 2900000,
			min: 100000,
			step: 100000,
			max:  20000000,
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
			value: 8.6,
			min: 8.4,
			step: .2,
			max:  15,
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
		$('#amount_lt').change(function () {
			 var value = this.value, selector = $( "#slider_lt" );
			selector.slider("value", value);
		});
	});

function EMI_calc(){
	var eligibilitySalaryCreteria = get_round((jQuery("#amount_sal").val())/12);

	var emiPrincipal=jQuery("#amount_1a").val();
	var emiRate=jQuery("#amount_intr").val()/12/100;
	var emiTenure=jQuery("#amount_lt").val()*12;
	if(eligibilitySalaryCreteria<=50000)
	{
		$("#enable86").show();
		var emiPrincipal_for9lacs, emiPrincipal_for3lacs, emiPrincipal_forRest, emi_for9lacs, emi_for3lacs, emi_forRest;	
		var emiRate_Initial=(jQuery("#amount_intr").val())/12/100;
		var netAmount = eligibilitySalaryCreteria;
		var princ = 100000;
		var term = 240;
		var applicableAmount = Math.round(netAmount * 50 / 100)	;
		//alert(applicableAmount);

		var interest=(jQuery("#amount_intr").val())/12/100;
		//alert(interest);
		var emicalc = Math.round(princ * interest/ (1 - (Math.pow(1/(1 + interest), term))));
		//alert(emicalc);
		//var loanPossible = (Math.round(applicableAmount/emicalc)) * 100000;
		var loanPossible = emiPrincipal;
		//alert(loanPossible);
		if(loanPossible>1200000)
		{
			emiPrincipal_for9lacs = 900000;
			emiPrincipal_for3lacs = 300000;
			emiPrincipal_forRest  = loanPossible - (emiPrincipal_for9lacs + emiPrincipal_for3lacs);
		}
		else if(loanPossible<=1200000 && loanPossible>900000)
		{
			emiPrincipal_for9lacs = 900000;
			emiPrincipal_for3lacs = 0;
			emiPrincipal_forRest  = emiPrincipal_forRest  = loanPossible - (emiPrincipal_for9lacs + emiPrincipal_for3lacs);
		}
		else
		{
			emiPrincipal_for9lacs = 900000;
			emiPrincipal_for3lacs = 0;
			emiPrincipal_forRest  = 0;
		}
		var emiRate_for9lacs=(jQuery("#amount_intr").val()-4)/12/100;
		var emiRate_for3lacs=(jQuery("#amount_intr").val()-3)/12/100;
		var emiRate_forRest=(jQuery("#amount_intr").val())/12/100;		
		var emi_for9lacs = emiPrincipal_for9lacs*emiRate_for9lacs*(Math.pow(1+emiRate_for9lacs,emiTenure)/(Math.pow(1+emiRate_for9lacs,emiTenure)-1));
		var emi_for3lacs = emiPrincipal_for3lacs*emiRate_for3lacs*(Math.pow(1+emiRate_for3lacs,emiTenure)/(Math.pow(1+emiRate_for3lacs,emiTenure)-1));
		var emi_forRest  = emiPrincipal_forRest*emiRate_forRest*(Math.pow(1+emiRate_forRest,emiTenure)/(Math.pow(1+emiRate_forRest,emiTenure)-1));
		var totalEmi = emi_for9lacs+emi_for3lacs+emi_forRest;
		
		jQuery("#emi_monthly1 span").text(inrFormat(Math.round(totalEmi)));
		jQuery("#total_intr1 span").text(inrFormat(Math.round(totalEmi* emiTenure-loanPossible)));
		jQuery("#total_amt1 span").text(inrFormat(Math.round(totalEmi*emiTenure)));
		jQuery("#loan_amt1 span").text(inrFormat(Math.round(loanPossible)));
	//	emiPrincipal=loanPossible;
	//	$( "#amount_1a" ).val( "" + loanPossible );
	}
	else
	{
	//	emiPrincipal=jQuery("#amount_1a").val();
	//	$( "#amount_1a" ).val( "" + emiPrincipal);
		$("#enable86").hide();
		
	}	
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
	var hdfc_rate1=9.30/1200;
	var hdfc_rate2=9.35/1200;
	var getemicalcHDFC1=emiPrincipal*hdfc_rate1*(Math.pow(1+hdfc_rate1,emiTenure)/(Math.pow(1+hdfc_rate1,emiTenure)-1));
	var getemicalcHDFC2=emiPrincipal*hdfc_rate2*(Math.pow(1+hdfc_rate2,emiTenure)/(Math.pow(1+hdfc_rate2,emiTenure)-1));
	var viewemi="Rs." + Math.round(getemicalcHDFC1) + " - Rs." + Math.round(getemicalcHDFC2);
	jQuery("#hdfc_bnk span").text(viewemi);
	//ICICI
	var icici1=9.30/1200;
	var icici2=9.35/1200;
	var getemicalcicici1=emiPrincipal*icici1*(Math.pow(1+icici1,emiTenure)/(Math.pow(1+icici1,emiTenure)-1));
	var getemicalcicici2=emiPrincipal*icici2*(Math.pow(1+icici2,emiTenure)/(Math.pow(1+icici2,emiTenure)-1));
	var viewemiicici="Rs." + Math.round(getemicalcicici1) + " - Rs." + Math.round(getemicalcicici2);
	jQuery("#icici_bnk span").text(viewemiicici);
	//For SBI
	var sbi1=9.25/1200;
	var sbi2=9.30/1200;
	var getemicalcsbi1=emiPrincipal*sbi1*(Math.pow(1+sbi1,emiTenure)/(Math.pow(1+sbi1,emiTenure)-1));
	var getemicalcsbi2=emiPrincipal*sbi2*(Math.pow(1+sbi2,emiTenure)/(Math.pow(1+sbi2,emiTenure)-1));
	var viewemisbi="Rs." + Math.round(getemicalcsbi1) + " - Rs." + Math.round(getemicalcsbi2);
	jQuery("#sbi_bnk span").text(viewemisbi);
	//for PNB
	var pnb1=9.40/1200;
	//var pnb2=9.95/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	//var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#pnb_bnk span").text(viewemipnb);
	//for axis
	var pnb1=9.45/1200;
	var pnb2=10.60/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#axis_bnk span").text(viewemipnb);
	//for LIC Housing
	var pnb1=9.30/1200;
	var pnb2=10.50/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	//var viewemipnb="Rs." + Math.round(getemicalcpnb1);
	jQuery("#lic_bnk span").text(viewemipnb);
	//for Fed Bank
	var pnb1=10.57/1200;
	var pnb2=9.82/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#fed_bnk span").text(viewemipnb);
	//for PNB Home Loan
	var pnb1=9.35/1200;
	//var pnb2=10.25/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
//	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	//var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	var viewemipnb="Rs." + Math.round(getemicalcpnb1);
	jQuery("#pnb_home_bnk span").text(viewemipnb);
	//for IDBI Home Loan
	var pnb1=9.45/1200;
	//var pnb2=10.15/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	//var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#idbi_home_bnk span").text(viewemipnb);
	//for DHFL Home Loan
	var pnb1=9.35/1200;
	//var pnb2=9.65/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	//var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#dhfl_home_bnk span").text(viewemipnb);
	//for Indiabulls Home Loan
	var pnb1=9.40/1200;
	var pnb2=10.25/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#indiabulls_home_bnk span").text(viewemipnb);
	//for Union Bank
	var pnb1=9.50/1200;
	var pnb2=9.55/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1) + " - Rs." + Math.round(getemicalcpnb2);
	jQuery("#union_bnk span").text(viewemipnb);
	//for Vijaya Bank
	var pnb1=9.65/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1);
	jQuery("#vijaya_bnk span").text(viewemipnb);
	//for Standard chartered Bank
	var pnb1=9.35/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var viewemipnb="Rs." + Math.round(getemicalcpnb1);
	jQuery("#scb_bnk span").text(viewemipnb);
	//for Indian Bank
	var pnb1=9.55/1200;
	var pnb2=9.75/1200;
	var getemicalcpnb1=emiPrincipal*pnb1*(Math.pow(1+pnb1,emiTenure)/(Math.pow(1+pnb1,emiTenure)-1));
	var getemicalcpnb2=emiPrincipal*pnb2*(Math.pow(1+pnb2,emiTenure)/(Math.pow(1+pnb2,emiTenure)-1));
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
<style type="text/css">
/*..........styles added on 3/1/2016 starts.............**/
.right-form-emi-cal{ float: right; width:349px;}
.column-chart-4{ width:48%; float:left; padding-left:5px; padding-right:5px; padding-top:50px;}
.column-chart-3{ width:275px; margin:auto; padding-left:5px; padding-right:5px; padding-top:50px;}
.cal-slider-left{ width:550px; float:left}
.nofloat{ float:none !important;}
.fullwidth-form{ width:100% !important;}
.input-form{ width:100%;}

@media only screen and (max-width:768px)  {.right-form-emi-cal{width:98%; margin:10px auto 0px;}
.column-chart-4{ width:95%; float:none; padding-left:5px; padding-right:5px; padding-top:0px; margin-top:5px;}
.column-chart-3{ width:50%; float:none; padding-left:5px; padding-right:5px; padding-top:0px; margin:auto;}
.emi_right_box{ width:300px !important; margin:auto !important; float:none!important; min-height:100px;}
.emi_sum_amount{ width:179px !important; font-size:12px !important;}
.cal-slider-left{ width:100%; float:none;}
.emi_sum_value{font-size:12px !important; width:113px !important;}
.hlc_left_cal-box{ width:98%; margin:auto;}
.head-calculation{ font-weight:bold; font-size:13px; padding-bottom:10px; text-align:center; padding-top:25px;}
}

/*..........styles added on 3/1/2016 ends.............**/
</style>

</head>
<body>
<?php include "middle-menu.php"; ?>
<?php $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); $currentdate=date('d F Y',$tomorrow); ?>
<div  class="hl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="d4l_inner_wrapper">
    <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">
      <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> <span> > 
		  PMAY Home Loan </span></div>
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
<div id="txt"><h1 class="hl-h1">PMAY Home Loan EMI Calculator</h1></div>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
<tr>
<td>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="font2">
<tr>
  <td colspan="2" valign="top" bgcolor="#FFFFFF" style=" padding-left:5px;" >
  <div class="cal-slider-left">
 <div class="hlc_left_cal-box nofloat"><table width="100%" height="200" border="0" align="center" cellpadding="3" cellspacing="2">
<!--<tr><td colspan="3" height="5"></td></tr> -->
<tr>
  <td height="20" class="common-sub-body-text">&nbsp;</td>
  <td>&nbsp;</td>
  <td></td>
</tr>
<tr><td width="194" height="20" class="common-sub-body-text"> <strong>Family Income (Yearly)</strong> <span style="font-weight:normal;">&nbsp;&nbsp;&nbsp;Rs.</span></td>
<td width="66"><input type="test" value="0" name="amount_sal" id="amount_sal" size="11" onchange=" EMI_calc();"/></td><td width="127"></td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_sal"></div></td></tr>


<tr><td width="194" height="20" class="common-sub-body-text"> <strong>Home Loan Amount</strong> <span style="font-weight:normal;">&nbsp;&nbsp;&nbsp;Rs.</span></td>
<td width="66"><input type="test" value="0" name="amount_1a" id="amount_1a" size="11" onchange=" EMI_calc();"/></td><td width="127"></td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_la"></div></td></tr>
<tr><td height="20" class="common-sub-body-text"><strong>Interest Rate</strong></td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="11" onchange=" EMI_calc();"/> </td><td class="common-sub-body-text"><strong>% Per Annum</strong></td></tr>
<tr><td colspan="3" height="20"><div id="slider_intr"></div></td></tr>
<tr><td height="20" class="common-body-text"><strong>Loan Tenure</strong></td><td><input type="test" value="0" name="amount_lt" id="amount_lt" size="11" onchange=" EMI_calc();"/> </td><td class="common-body-text"><strong>Years</strong></td></tr>
<tr><td colspan="3" height="20"><div id="slider_lt" ></div></td></tr>

</table>
</div>

<div class="column-chart-4"  id="enable86">
<p class="head-calculation">Calculations per PMAY Subsidy Scheme</p>
<div class="emi_right_box" style="padding-top:-10px;">
<div style="float:left; width:100%; background-color:#F8F8F8; padding-bottom:0px;">
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Loan Amount </div>
<div class="emi_sum_value" id="loan_amt1" style="background-color:#F8F8F8;"><span>Rs. 29,00,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Monthly Instalment (EMI)</div>
<div class="emi_sum_value" id="emi_monthly1"  style="background-color:#DADADA;"><span>Rs. 22,684</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr1" style="background-color:#F8F8F8;"><span>Rs. 
	25,44,148</span></div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#DADADA; line-height: 30px;" id="total_amt1"><span>Rs. 55,44,148</span></div> 
</div>
</div></div>

<div class="column-chart-4">
<p class="head-calculation">Calculations per Current Home Loan Rates</p>
<div class="emi_right_box" style="padding-top:-10px;">
<div style="float:left; width:100%; background-color:#F8F8F8; padding-bottom:0px;">
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Loan Amount </div>
<div class="emi_sum_value" id="loan_amt" style="background-color:#F8F8F8;"><span>Rs. 29,00,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Monthly Instalment (EMI)</div>
<div class="emi_sum_value" id="emi_monthly"  style="background-color:#DADADA;"><span>Rs. 25,351</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr" style="background-color:#F8F8F8;"><span>Rs. 31,84,173</span></div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#DADADA; line-height: 30px;" id="total_amt"><span>Rs. 60,84,173</span></div> 
</div>
</div></div>
  <div style="clear:both;"></div>
  
  </div>
<div class="right-form-emi-cal">
<form name="loan_form" method="post" action="Right.php" onsubmit="return chkformR();">
        <div class="right-panel-fomr-box fullwidth-form">
          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="3">
            <tr>
              <td height="35" colspan="2" align="center" valign="middle"><h2 class="pl-h2" style="color:#FFF !important;">Apply for PMAY Subsidy Scheme</h2></td>
            </tr>
            <tr>
              <td  height="23" align="left" valign="top" class="side-form-text"><input type="hidden" name="source" value="PMAY Home Loan" />
                Full Name</td>
              <td   height="23" style="width: 147px">
              <input type="hidden" name="Type_Loan" id="Type_Loan" value="Req_Loan_Home" />
              <input name="fullname" id="fullname" type="text" class="d4l-side-input" onkeydown="validateDiv('nameRVal');" tabindex="2"  autocomplete="off" />
                <div id="nameRVal"></div></td>
            </tr>
            <tr>
              <td  height="23" class="side-form-text"> Mobile</td>
              <td style="width: 147px" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%" class="side-form-text">+91 </td>
                    <td width="95%"><input name="mobile" id="mobile" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-side-input" onkeydown="validateDiv('phoneRVal');" tabindex="3" autocomplete="off" />
                      <div id="phoneRVal"></div></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td  height="23" class="side-form-text"> Email ID </td>
              <td style="width: 147px" ><input name="email_id" id="email_id" type="text" class="d4l-side-input" onkeydown="validateDiv('emailRVal');" tabindex="4"  autocomplete="off" />
                <div id="emailRVal"></div></td>
            </tr>
            <tr>
              <td  height="23" align="left" valign="top" class="side-form-text"> City</td>
              <td style="width: 147px" ><select name="city" id="city"  class="d4l-side-select" onchange="validateDiv('cityRVal');" tabindex="5">
                  <?=plgetCityList($City)?>
                </select>
                <div id="cityRVal"></div></td>
            </tr>
            <tr>
              <td  height="23" align="left" valign="top" class="side-form-text"> Net Salary (Yearly)</td>
              <td style="width: 147px" ><input name="net_salary" id="net_salary" type="text"  class="d4l-side-input"  onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv('netSalaryRVal');" tabindex="6" autocomplete="off" />
                <div id="netSalaryRVal"></div></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top" ><input name="accept" type="checkbox" checked="checked"  tabindex="7"/>
                <span style="font-size:12px; color:#FFF;"> I Agree to <a href="/Privacy.php" style="color:#FFF;">privacy policy</a> and <a href="/Privacy.php" style="color:#FFF;">Terms and Conditions</a>.</span>
                <div id="acceptRVal"></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td  align="center" valign="top"  style= "margin-left:0px; width: 147px;"><input type="submit" class="pl-get-quotebtn"value="Get Quote" tabindex="8" style="background: #06b2a0 none repeat scroll 0 0;    border: 2px solid #fff;"/></td>
            </tr>
          </table>
        </div>
      </form>
<div class="column-chart-3"><div id="container"  style="height:100px;"></div></div>
</div>
</td></tr>
<tr>
  <td colspan="2">
 
  <div style="clear:both; height:10px;"></div>
  <div class="common-body-text" style="color:#4c4c4c; padding-left:5px; width:99%;">Having a house is a very basic need of every human being. With the vision of providing urban and rural poor a home of their dreams, Our Prime Minister Mr. Narendra Modi launched two housing schemes under Pradhan Mantri Awas Yojna. He announced the same on December 31, 2016 when he addressed the entire nation. People who take loans of Rs. 9 Lakhs and 12 Lakhs in 2017 will now get a subsidy in their interest rates. The scheme designed for the people belonging to LIG and EWS category will allow them to get a home loan up to Rs. 9 Lakhs at an interest subsidy rate of four percent. The urban poor will receive a rebate of three percent for a home loan up to Rs. 12 Lakhs. Rural poor who want to build or renovate their house will now get a home loan of Rs 2 Lakhs at three percent lower interest rate. The scheme aims to construct 33 percent more homes in the rural areas.

    </div>
  <div  style="clear:both; height:5px;"></div>
  <p class="common-body-text" style="color:#4c4c4c; padding-left:5px; width:99%;">Through this calculator you can find how much EMI you will have to pay and how much savings you will now make if you take a loan of a particular amount. </p>
 
  <div  style="clear:both; height:5px;"></div>
</td>
</tr>
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




  <div  style="clear:both;"></div>
  <div class="hlc_left_cal-box3"><div id="barChart"></div> </div>
  <div class="hlc_left_cal-box4"><div id="tblpaymentsDetails">
<table id='pmtTab' style=' clear: both;background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; '>  <tr >
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:90px; font: 12px; color:#FFFFFF;' id='numHead'>Year</td>
      <td  height="20"  style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px; color:#FFFFFF;' id='oldBal'>Principal</td>
      <td  align="center" style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px; color:#FFFFFF;' id='pt'>Interest</td>
      <td   style='border: 1px solid #DBDAD7; background: #4572A7;	border-top: 0; width:210px; font: 12px; color:#FFFFFF;'id='oil' >Balance Amount</td>
    </tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		1</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 57,026</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 247,186</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,842,974</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		2</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 62,127</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 242,085</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,780,847</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		3</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 67,687</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 236,525</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,713,160</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		4</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 73,742</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 230,470</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,639,418</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		5</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 80,341</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 223,871</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,559,077</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		6</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 87,528</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 216,684</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,471,549</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		7</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 95,360</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 208,852</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,376,189</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		8</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 103,892</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 200,320</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,272,297</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		9</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 113,187</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 191,025</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,159,110</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		10</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 123,314</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 180,898</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 2,035,796</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		11</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 134,347</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 169,865</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 1,901,449</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		12</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 146,368</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 157,844</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 1,755,081</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		13</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 159,464</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 144,748</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 1,595,617</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		14</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 173,731</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 130,481</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 1,421,886</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		15</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 189,275</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 114,937</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 1,232,611</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		16</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 206,210</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 98,002</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 1,026,401</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		17</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 224,661</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 79,551</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 801,740</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		18</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 244,760</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 59,452</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 556,980</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		19</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 266,659</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 37,553</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 290,321</td>
	</tr>
	<tr >
		<td height="18" align="center" width="64" class="default_td">		20</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 290,500</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 13,695</td>
		<td height="18" align="center" width="64" class="default_td">		Rs. 0</td>
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
      <td height="18" align="center" class="default_td">
<a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php">HDFC LTD</a></td>
      <td align="center"class="default_td">8.35% - 8.55%</td>
      <td align="center"class="default_td"><div id="hdfc_bnk"><span>Rs. 17,167 - Rs. 17,420</span></div></td>
    </tr>
	<tr height="18">
      <td height="18" align="center" class="default_td" ><a href="http://www.deal4loans.com/icici-hfc-home-loan.php"> ICICI Bank</a></td>
      <td align="center" class="default_td">8.35% - 8.80%</td>
      <td align="center" class="default_td"><div id="icici_bnk"><span>
		  Rs.17,167 - Rs.17,738</span></div></td>
    </tr>
	<tr height="18">
      <td height="18" align="center" class="default_td">
<a href="http://www.deal4loans.com/sbi-home-loan.php">SBI</a></td>
      <td align="center" class="default_td">8.30% - 8.60%</td>
      <td align="center" class="default_td"><div id="sbi_bnk"><span>Rs.17,547 - Rs. 17,738</span></div></td>
    </tr>
	<tr height="18">
      <td height="18" align="center" class="default_td">
<a href="http://www.deal4loans.com/loans/home-loan/pnb-housing-finance-interest-rates-documents-eligibility-apply/">PNB Housing</a></td>
      <td align="center" class="default_td">8.35% - 9.25%</td>
      <td align="center" class="default_td"><div id="pnb_bnk"><span>Rs. 20,833 - Rs. 21,294</span></div></td>
    </tr>
	<tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/home-loan-axis-bank.php">Axis Bank</a></td>
      <td align="center" class="default_td">8.35% - Rs.8.75%<br /></td>
      <td align="center" class="default_td"><div id="axis_bnk"><span>Rs.17,167 - Rs.17,674</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/home-loan-lic-housing.php">LIC Housing</a></td>
      <td align="center" class="default_td">8.35% - 8.80%</td>
      <td align="center" class="default_td"><div id="lic_bnk"><span>Rs. 17,167 - Rs. 17,738</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/loans/home-loan/federal-bank-home-loan-interest-rates-documents-apply-online/">Fed Bank</a></td>
      <td align="center" class="default_td">9.57% - 9.82%</td>
      <td align="center" class="default_td"><div id="fed_bnk"><span>Rs. 18,734 - Rs. 19,063</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/loans/home-loan/pnb-home-loan-interest-rates-eligibility-documents-apply/">PNB Home Loan</a></td>
      <td align="center" class="default_td">8.65% - 8.75%</td>
      <td align="center" class="default_td"><div id="pnb_home_bnk"><span>Rs. 
		  17,547 - Rs.17,674</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/home-loan-idbi-bank.php">IDBI Home Loan</a></td>
      <td align="center" class="default_td">
	  <p class="MsoNormal">8.35% - 8.40%<o:p></o:p></p>
		</td>
      <td align="center" class="default_td"><div id="idbi_home_bnk"><span>Rs. 17,</span>167 
		  - Rs. 17,230</div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/dhfl.php">DHFL Home Loan</a></td>
      <td align="center" class="default_td">8.35%</td>
      <td align="center" class="default_td"><div id="dhfl_home_bnk"><span>Rs. Rs. 17,167</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/dhfl.php">Indiabulls Home Loan</a></td>
      <td align="center" class="default_td">8.35% - 8.80%</td>
      <td align="center" class="default_td"><div id="indiabulls_home_bnk"><span>
		  Rs.17,167 - Rs.17,738</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center" class="default_td">
<a href="http://www.deal4loans.com/loans/home-loan/union-bank-home-loan-interest-rates-processing-fee-emi/">Union Bank</a></td>
      <td align="center" class="default_td">8.75% - 8.80%</td>
      <td align="center" class="default_td"><div id="union_bnk"><span>Rs. 17,674 
		  - Rs.17,</span>738</div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href=" http://www.deal4loans.com/loans/home-loan/vijay-bank-home-loan-interest-rates-calulator-documents-emi-apply/">Vijaya Bank</a></td>
      <td align="center" class="default_td">8.90%</td>
      <td align="center" class="default_td"><div id="vijaya_bnk"><span>Rs. 17,866</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/home-loan-standard-chartered-bank.php">Standard Chartered Bank</a></td>
      <td align="center" class="default_td">8.51%</td>
      <td align="center" class="default_td"><div id="scb_bnk"><span>Rs. 17,369</span></div></td>
    </tr>	
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/loans/home-loan/indian-bank-home-loan-interest-rates-documents-eligibility-apply/">Indian Bank</a></td>
      <td align="center" class="default_td">8.60%</td>
      <td align="center" class="default_td"><div id="indian_bnk"><span>Rs. 17,483</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center" class="default_td"><a href="http://www.deal4loans.com/loans/home-loan/shubham-housing-finance-home-loan-interest-rate-calculator/">Shubham Housing Development Finance Company</a></td>
      <td align="center" class="default_td">12%-14%(For Salaried) - 15%-17%(For Self-employed)</td>
      <td align="center" class="default_td"><div id="shubham_housing_bnk"><span>Rs. 22,022-Rs.24,870(For Salaried) - Rs.26,336-Rs.29,336(For Self-employed)</span></div></td>
    </tr>
    <tr height="18">
      <td height="18" align="center" class="default_td">Allahabad Bank</td>
      <td align="center" class="default_td">8.55% - 8.65%</td>
      <td align="center" class="default_td"><div id="Allahabad Bank"><span>Rs. 17,420 
		  - Rs.17,547</span></div></td>
    </tr>	
    
    <tr height="18">
      <td height="18" align="center" class="default_td">Bank of India</td>
      <td align="center" class="default_td">8.55% - 8.60%</td>
      <td align="center" class="default_td"><div id="Bank of India"><span>Rs. 
		  17,420 - Rs. 17,483</span></div></td>
    </tr>
     <tr height="18">
      <td height="18" align="center" class="default_td">Corporation Bank</td>
      <td align="center" class="default_td">9.60%</td>
      <td align="center" class="default_td"><div id="Corporation Bank"><span>Rs. 18,773</span></div></td>
    </tr>
     <tr height="18">
      <td height="18" align="center" class="default_td">L & T Housing Finance </td>
      <td align="center" class="default_td">9.90%</td>
      <td align="center" class="default_td"><div id="L & T Housing Finance "><span>Rs. 19,168</span></div></td>
    </tr>
     <tr height="18">
      <td height="18" align="center" class="default_td">Citibank </td>
      <td align="center" class="default_td">
	  <span style="font-size:11.0pt;font-family:&quot;Calibri&quot;,sans-serif;
mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:AR-SA">8.60% - 8.85%</span></td>
      <td align="center" class="default_td"><div id="Citibank "><span>Rs. 17,483 - Rs. 17,802</span></div></td>
    </tr>
</table>
</div>

<div style="clear:both;"></div>

<div class="responsive_ad" align="center"><br />
 
 </div>
</div>
</div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>