<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source']; }
else {	$retrivesource="Hl AxisHappayendingscheme"; }
$page_Name = "HomeLoan";
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<Title>Axis Bank Happy Ending Home Loan | Interest Rates | Eligibility| Apply Online</title>
<meta name="Description" content="Happy Ending Home Loan Scheme: Apply & Compare online axis bank housing loan and save your lakhs of rupees.">
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
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

<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{	if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))	{	return true;	}	} }
function Trim(strValue) {var j=strValue.length-1;i=0;while(strValue.charAt(i++)==' ');while(strValue.charAt(j--)==' ');return strValue.substr(--i,++j-i+1);}
function cityother(){	if(document.homeloan_calculator.City.value=="Others")	{		document.homeloan_calculator.City_Other.disabled = false;	}	else	{		document.homeloan_calculator.City_Other.disabled = true;	} } 
function validmobile(mobile) 
{		atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{		alert("Mobile number cannot start with 0.");		return false;	}
	if(!checkData(document.homeloan_calculator.Phone, 'Mobile number', 10))
		return false;
return true;
}

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined) { document.getElementById('plantype2').innerHTML = strPlan;			   document.getElementById('plantype2').style.background='Beige';         }
       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined)        {               document.getElementById('plantype2').innerHTML = strPlan;			   document.getElementById('plantype2').style.background='';  			                          }
       return true;
}

function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function validateDiv(div){	var ni1 = document.getElementById(div);	ni1.innerHTML = ''; }

function checkhlcalc()
{

var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if((document.homeloan_calculator.Name.value=="") || (Trim(document.homeloan_calculator.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.homeloan_calculator.Name.focus();
		return false;
	}

	if(document.homeloan_calculator.Name.value!="")
	{
		if(containsdigit(document.homeloan_calculator.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.homeloan_calculator.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.homeloan_calculator.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.homeloan_calculator.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.homeloan_calculator.Name.focus();
			return false;
		}
  }
		
	if(document.homeloan_calculator.day.value=="" || document.homeloan_calculator.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.homeloan_calculator.day.focus();
		return false;
	}
	if(document.homeloan_calculator.day.value!="")
	{
		if((document.homeloan_calculator.day.value<1) || (document.homeloan_calculator.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.homeloan_calculator.day.focus();
			return false;
		}
	}
	if(!checkData(document.homeloan_calculator.day, 'Day', 2))
		return false;
	
	if(document.homeloan_calculator.month.value=="" || document.homeloan_calculator.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.homeloan_calculator.month.focus();
		return false;
	}
	if(document.homeloan_calculator.month.value!="")
	{
		if((document.homeloan_calculator.month.value<1) || (document.homeloan_calculator.month.value>12))



		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.homeloan_calculator.month.focus();
			return false;
		}
	}
	if(!checkData(document.homeloan_calculator.month, 'month', 2))
		return false;

	if(document.homeloan_calculator.year.value=="" || document.homeloan_calculator.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.homeloan_calculator.year.focus();
		return false;
	}
	if(document.homeloan_calculator.year.value!="")
	{
		if((document.homeloan_calculator.year.value < "<?php echo $maxage;?>") || (document.homeloan_calculator.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.homeloan_calculator.year.focus();
			return false;
		}
	}
	if(!checkData(document.homeloan_calculator.year, 'Year', 4))
		return false;
	if(document.homeloan_calculator.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	if(isNaN(document.homeloan_calculator.Phone.value)|| document.homeloan_calculator.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.homeloan_calculator.Phone.focus();
		return false;  
	}
	if (document.homeloan_calculator.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	if ((document.homeloan_calculator.Phone.value.charAt(0)!="9") && (document.homeloan_calculator.Phone.value.charAt(0)!="8") && (document.homeloan_calculator.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	
	if(document.homeloan_calculator.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.homeloan_calculator.Email.focus();
		return false;
	}
	
	var str=document.homeloan_calculator.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.homeloan_calculator.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.homeloan_calculator.Email.focus();
		return false;
	}
		
	if (document.homeloan_calculator.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.homeloan_calculator.City.focus();
		return false;
	}
	if((document.homeloan_calculator.City.value=="Others") && ((document.homeloan_calculator.City_Other.value=="" || document.homeloan_calculator.City_Other.value=="Other City"  ) || !isNaN(document.homeloan_calculator.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.homeloan_calculator.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.homeloan_calculator.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.homeloan_calculator.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.homeloan_calculator.City_Other.focus();
  		return false;
  	}

  }
	if (document.homeloan_calculator.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.homeloan_calculator.Employment_Status.focus();
		return false;
	}
	if (document.homeloan_calculator.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.homeloan_calculator.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.homeloan_calculator.Net_Salary, 'Annual Income',0))
		return false;
	if (document.homeloan_calculator.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.homeloan_calculator.Loan_Amount.focus();
		return false;
	}	
	if(document.homeloan_calculator.Property_Value.value=="")
	{
		document.getElementById('propertyValueVal').innerHTML = "<span  class='hintanchor'>Enter Property Value!</span>";	
		document.homeloan_calculator.Property_Value.focus();
		return false;
	}
	if(!document.homeloan_calculator.accept.checked)
	{
	//alert("Read and Accept Terms and Condition!");
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.homeloan_calculator.accept.focus();
		return false;
	}
	return true;
}
function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.homeloan_calculator.City.value;
//	var otrcit = document.loan_form.City_Other.value;
ni1.innerHTML = '';
	if(cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px; width:706px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}
</script>
<script>
//loan amount
$(function() {
			$( "#slider_la" ).slider({
			range: "min",
			value: 2500000,
			min: 1500000,
			step: 20000,
			max:  9000000,
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
			value: 10,
			min: 9.95,
			step: .05,
			max:  15,
			slide: function( event, ui ) {
				$( "#amount_intr" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_intr" ).val( "" + $( "#slider_intr" ).slider( "value" ) );
	});

//loan tenure

function EMI_calc(){
		var emiRateAxis;
		var emiRateAxisS;
		var emiPrincipal=jQuery("#amount_1a").val();
		if(emiPrincipal>2500000)
		{  emiRateAxisS = '10.50%'; emiRateAxis = 10.5/1200; } else { emiRateAxisS = '10.25%'; emiRateAxis = 10.25/1200; }
	var emiRate=jQuery("#amount_intr").val()/1200;
	var emiRateS = jQuery("#amount_intr").val() + '%';
	var emiTenure=240;

	var emi = emiPrincipal*emiRateAxis*(Math.pow(1+emiRateAxis,emiTenure)/(Math.pow(1+emiRateAxis,emiTenure)-1));
	var axisSaving = Math.round(emi * 12);
	var emiOther = emiPrincipal*emiRate*(Math.pow(1+emiRate,emiTenure)/(Math.pow(1+emiRate,emiTenure)-1));
	jQuery("#emi_monthly span").text(number_format(Math.round(emi)));
	jQuery("#total_intr span").text(number_format(Math.round(emi* emiTenure-emiPrincipal)));
	jQuery("#total_amt span").text(number_format(Math.round(emi*emiTenure)));
	jQuery("#loan_amt span").text(number_format(Math.round(emiPrincipal)));
	jQuery("#axis_intr span").text(emiRateAxisS);
	jQuery("#saving_scheme span").text(number_format(Math.round(axisSaving)));


	jQuery("#emi_monthly_B span").text(number_format(Math.round(emiOther)));
	jQuery("#total_intr_B span").text(number_format(Math.round(emiOther* emiTenure-emiPrincipal)));
	jQuery("#total_amt_B span").text(number_format(Math.round(emiOther*emiTenure)));
	jQuery("#loan_amt_B span").text(number_format(Math.round(emiPrincipal)));
	jQuery("#axis_intr_B span").text(emiRateS);
	var axisTotal = Math.round(emi* emiTenure-emiPrincipal);
	var otherTotal = Math.round(emiOther* emiTenure-emiPrincipal)
	var totSaving = axisSaving - (axisTotal-otherTotal);
	
	jQuery("#total_Save span").text(number_format(Math.round(totSaving)));	
	
	
	var month_emi=Math.round(emi);
	var emi_tenure=Math.round(emiTenure);
}

</script>
</head>
<body>
<?php include "top-menu.php";  include "main-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home loan</u></a> <span class="text12" style="color:#4c4c4c;"> > Axis Bank - Happy Ending Home Loan Scheme</span></div>
<div class="intrl_txt" style="margin:auto;"><div style=" float:left; width:940px; height:auto; margin-top:15px; margin-left:20px; text-align:justify;">
<h1 class="text3"  style="width:900px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;">Axis Bank - Happy Ending Home Loan Scheme</h1>
<div style="float:left; width:663px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="900" height="1" /></div>
</div>
<div style="clear:both; height:15px;"></div>
  <table cellpadding="0" cellspacing="0" border="0" align="center">
  <tr><td colspan="2"><form name="homeloan_calculator" method="post" action="apply-home-loans-calc-continue1.php" onSubmit="return checkhlcalc();">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
<tr><td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td></tr>
<tr><td height="35" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0"><tr><td width="24"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td><td width="735"><h1 class="text3" style=" color:#FFF; font-size:24px; text-transform:none; ">Axis Bank - Happy Ending Home Loan Scheme</h1></td><td width="196" rowspan="2" valign="top"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td></tr></table></td></tr>
<tr>
<td  align="center" valign="top" bgcolor="#21405F"><table width="943" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="11" rowspan="2" align="left" valign="top"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td>
<td width="183" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:183px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Name" id="Name" type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('nameVal');" />
<div id="nameVal"></div>   </div></div></td>
</tr>
<tr>
<td height="55" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
<div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><div class="text" style=" float:left; clear:right;"><input name="day" id="day" type="text" style="width:43px; height:18px;" value="dd" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" /><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></div><div class="text" style=" float:left; clear:right;"><input name="month" id="month" type="text" style="width:43px; height:18px;" value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" /><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></div><div class="text" style=" float:left; clear:right;"><input name="year" id="year" type="text" style="width:60px; height:18px;" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" /></div><div id="dobVal"></div>   </div></div></td></tr>
<tr><td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div><div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; "><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" style="width:153px; height:18px;" onKeyDown="validateDiv('phoneVal');"  /><div id="phoneVal"></div>  </div></div></div></td></tr>
</table></td>
<td width="58" align="left" valign="top"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td><td width="185" align="left" valign="top"><table width="192" border="0" cellspacing="0" cellpadding="0"><tr><td width="192" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                   <select name="City" id="City" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="cityother(); addhdfclife(); validateDiv('cityVal');" tabindex="7"><?=getCityList($City)?></select><div id="cityVal"></div>   </div></div></td></tr>
<tr><td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="City_Other" id="City_Other" type="text" style="width:180px; height:18px;" disabled onKeyUp="searchSuggest();" onKeyDown="validateDiv('othercityVal');"  /><div id="othercityVal"></div>   </div></div></td></tr>
<tr><td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Email" id="Email" type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('emailVal');"  /><div id="emailVal"></div> </div></div></td></tr>
</table></td>
<td width="50" align="left" valign="top"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td>
<td width="186" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
<tr><td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"  style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" ><option value="-1">Please Select</option><option value="1">Salaried</option><option value="0">Self Employment</option></select><div id="empStatusVal"></div></div></div></td></tr>
<tr><td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input type="text" name="Net_Salary" id="Net_Salary" style="width:180px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');"  /><div id="netSalaryVal"></div>   </div></div>  <span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
<tr><td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Required Loan Amount:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('loanAmtVal');" /><div id="loanAmtVal"></div></div></div><span id='formatedlA' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
</table></td>
<td width="56" align="left" valign="top"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td>
<td width="214" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
<tr><td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Value:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Property_Value" id="Property_Value" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('propertyValueVal');" /><div id="propertyValueVal"></div></div></div></td></tr>
<tr><td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Total EMI of All Loans :</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="total_obligation" id="total_obligation" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('obligationVal');" /><div id="obligationVal"></div></div></div></td></tr>
<tr><td  id="myDiv1" ></td></tr>
</table></td></tr><tr><td height="40" colspan="7" align="left" valign="top"><table width="923" border="0" cellspacing="0" cellpadding="0"><tr><td width="772" align="left" valign="top"><div class="text" style=" float:left; width:760px; height:auto; color:#FFF; font-size:11px; text-transform:none; margin-top:5px;"><input name="accept" type="checkbox"  /> I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div></td><td width="151" align="right" valign="top"><div style=" float:right; width:114px; height:47px; margin-top:0px; margin-left:0px;">  <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td></tr></table></td></tr>
 <tr>            <td colspan="7" align="left" valign="top">             <div id="hdfclife"></div>            </td></tr>
</table></td></tr>
<tr><td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td></tr>
</table></td></tr>
</table>
</form></td></tr>
<tr><td class="text" style="color:#4c4c4c; size:18px; height:37px;" colspan="2"   >
<table cellpadding="0" cellspacing="0" border="0" align="center" class="font2">
<tr><td colspan="2" height="20">&nbsp;</td></tr>
<tr>
  <td width="670" class="frmbldtxt"  style="padding-left:130px; font-weight:bold; padding-bottom:5px;" lass="text" >To check your saving with Happy Ending Scheme drag the slider for<br /> Loan amount | Rate of interest.</td><td width="300" align="right" ><table cellpadding="0" cellspacing="0" border="0" width="300" ><tr><td  align="right">
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=236732309688469" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe></td><td width="70">
<a class="addthis_button_tweet" style="width:70px;"></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e0d5fb863d78da4"></script>
</td><td align="left" width="80" ><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><g:plusone></g:plusone></td></tr></table>
</td></tr> 
<tr><td colspan="2"><table cellpadding="0" cellspacing="0" border="0" align="center" class="font2">
<tr><td width="600"  valign="top" bgcolor="#F8F8F8" style="border:#666666 1px solid; padding-left:5px;" >
<table border="0" cellpadding="3" cellspacing="2" width="95%" align="center">
<tr><td colspan="3" height="5"></td></tr>
<tr><td width="226" height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;"> Home Loan Amount </td>
<td width="220"><span style="font-weight:normal;">&nbsp;&nbsp;&nbsp;Rs.</span>
  <input type="test" value="0" name="amount_1a" id="amount_1a" size="11" onchange=" EMI_calc();" /></td><td width="214"></td>
</tr>
<tr><td colspan="3" height="25"><div id="slider_la"></div></td><tr>
<tr><td colspan="3" height="20"></td></tr>
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Other Bank Interest Rate</td><td><input type="test" value="0" name="amount_intr" id="amount_intr" size="11" onchange=" EMI_calc();" />
  <span style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">% Per Annum</span> </td><td style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td></tr>
<tr><td colspan="3" height="25"><div id="slider_intr"></div></td><tr>
<tr><td colspan="3" height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Tenure is fixed for 20 years in this scheme.</td></tr>
</table>
</td></tr>
<tr>
  <td valign="middle">
<table border="0"><tr><td valign="top">
<table border="0">
<tr>
  <td valign="top" align="center" class="text3" style="margin-top:0px; float:left; clear:right; font-size:18px; text-transform:none; color:#88a943;">Axis Bank Happy Ending Scheme</td>
</tr>
<tr><td valign="top">
<div class="emi_right_box">
<div style="float:left; width:340px; background-color:#F8F8F8; padding-bottom:0px;">
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Loan Amount </div>
<div class="emi_sum_value" id="loan_amt" style="background-color:#F8F8F8;"><span>Rs. 2,500,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Axis Bank Rate </div>
<div class="emi_sum_value" id="axis_intr" style="background-color:#DADADA;"><span>10.25%</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Axis Bank Monthly EMI</div>
<div class="emi_sum_value" id="emi_monthly"  style="background-color:#F8F8F8;"><span>Rs. 24,541</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr" style="background-color:#DADADA;"><span>Rs. 3,389,860</span></div> 
<div class="emi_sum_amount"  style="background-color:#F8F8F8;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value"  style="background-color:#F8F8F8;" id="total_amt"><span>Rs. 5,889,860</span></div> 
<div class="emi_sum_amount"  style="background-color:#DADADA;">Savings with Scheme(EMI X 12)</div>
<div class="emi_sum_value"  style="background-color:#DADADA;" id="saving_scheme"><span>Rs. 294,493</span></div> 
</div>
</div>
            
</td></tr>
</table>   
 
  
    </td>
  <td valign="top" > 
 <table border="0">
 <tr><td valign="top" align="center" class="text3" style="margin-top:0px; float:left; clear:right; font-size:18px; text-transform:none; color:#88a943;">Other Bank Scheme</td></tr>
 <tr><td valign="top">
<div class="emi_right_box">
<div style="float:left; width:340px; background-color:#F8F8F8; padding-bottom:0px;">
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Loan Amount </div>
<div class="emi_sum_value" id="loan_amt_B" style="background-color:#F8F8F8;"><span>Rs. 2,500,000</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Other Bank Rate </div>
<div class="emi_sum_value" id="axis_intr_B" style="background-color:#DADADA;"><span>10%</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Other Bank Monthly EMI</div>
<div class="emi_sum_value" id="emi_monthly_B"  style="background-color:#F8F8F8;"><span>Rs. 24,126</span></div> 
<div class="emi_sum_amount" style="background-color:#DADADA;">Total Interest Amount</div>
<div class="emi_sum_value" id="total_intr_B" style="background-color:#DADADA;"><span>Rs. 3,290,130</span></div> 
<div class="emi_sum_amount" style="background-color:#F8F8F8;">Total Amount (Principal + Interest)</div>
<div class="emi_sum_value" style="background-color:#F8F8F8;" id="total_amt_B"><span>Rs. 5,790,130</span></div> 
</div>
</div>
            
</td></tr>
</table>  </td></tr>
  <tr><td colspan="2" align="center"><table><tr><td style="border:5px solid #547295;"><div class="emi_sum_amount" style="background-color:#F8F8F8; font-size:20px;">Total Saving</div>
<div class="emi_sum_value" style="background-color:#F8F8F8; font-size:20px; width:200px;" id="total_Save"><span>Rs. 194,763</span></div></td></tr></table></td></tr>     
  </table> </td></tr>

 
</table></td></tr>

</table>
</td></tr>
<tr><td colspan="2" class="frmbldtxt"  style="font-weight:normal; line-height:18px;">Axis Bank Offers Last 12 Month Waiver option Scheme in Home Loans product-folio. The Scheme is Called Happy Ending Home Loan.<br />
Happy Ending Home Loan Scheme is being offered at the same rates as a regular loan and will be applicable to new customers under the floating rate option. The EMI waiver will be offered to all loans with an initial tenure of 20 years or more that cross their 15th year.<br />The new product, available to new customers, offers to waive 12 EMIs for those borrowers with a 15-year or more tenure and if he/she pays the EMIs on time.<br /></td>
</tr>
</table>

<br>

</div>
</div>
<?php include "footer_pl.php"; ?>
</body>
</html>