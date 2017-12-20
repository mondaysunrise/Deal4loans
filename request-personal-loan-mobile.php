<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="PL LP mobile";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Personal Loan</title>
<link href="css/request-personal-loan-mobile.css" type="text/css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#373737;
}
.red {
	color:#F00;
}
.hintanchor{
	width:300px;
	border:1px solid #FF0000;
	background-color: #CCFF66;
	font-size:12px;
	font-weight:bold;
	color: #CC0000;
	padding: 5px 10px 5px 10px;
}

-->
</style>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-hhtpspllist.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<script src="//code.jquery.com/jquery-1.8.2.js"></script>
<script src="//code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

<style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:450px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	form{
		display:inline;
	}
.ui-dialog { position: absolute; padding: .2em; width: 700px; overflow: hidden; z-index:1001;}
.ui-dialog .ui-dialog-titlebar { padding: .4em 1em; position: relative;  }
.ui-dialog .ui-dialog-title { float: left; margin: .1em 16px .1em 0; font-size:11px; line-height:18px;}
.ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }
.ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }
.ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }
.ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: .5em 0 0 0; padding: .3em 1em .5em .4em; }
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { float: right; }
.ui-dialog .ui-dialog-buttonpane button { margin: .5em .4em .5em 0; cursor: pointer; }
.ui-dialog .ui-resizable-se { width: 14px; height: 14px; right: 3px; bottom: 3px; }
.ui-draggable .ui-dialog-titlebar { cursor: move; }
.lowest_form_right_text{ float:left; width:204px; margin-top:10px;}
</style>  

<script language="javascript">
$(function() {
	$("#IncomeAmount").focusout(function(){
		if($("#IncomeAmount").val()<=50000){

			var ai=$("#IncomeAmount").val();
			var mai= Math.round(ai/12);
				$( "#dialog-modal" ).dialog({
				title:"You Have Indicated Your Annual Income Is 'Rs. " + ai + "' which is 'Rs." + mai + "' per month. If correct Continue or Edit Annual Income to get Right Quote",
				height: 0,
				modal: true
			});
			//$("#IncomeAmount").val().focus();
		}
	});
});

function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}

function othercity1()
{
	if(document.loan_form.City.value=='Others')
	{
		$("#other_city_field").show( 2000, function() {
		
		});
		
		$("#personal_details_area").show( 2000, function() {
		
		});
		
		//document.getElementById("other_city_field").style.display='block';
		document.getElementById("personal_details_area").style.display='block';
		document.loan_form.City_Other.disabled=false;
	}
	else
	{
		//document.getElementById("other_city_field").style.display='none';
		$("#other_city_field").hide( 2000, function() {
		
		});
		
		$("#personal_details_area").show( 2000, function() {
		
		});
		
		//document.getElementById("personal_details_area").style.display='block';		
		document.loan_form.City_Other.disabled=true;
	}
}

function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
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

function checkLoanAmount(){
	
	//alert('Hi');
	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<div class='hintanchor'>Enter Loan Amount!</div>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0)){
		return false;
	}
	$("#occupation_area").show( 2000, function() {
		// Animation complete.
	});
	document.getElementById("button_check").style.display='none';
	document.getElementById("button_submit").style.display='block';
	return true;
}

function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<div  class='hintanchor'>Enter Loan Amount!</div>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0)){
		return false;
	}	
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<div  class='hintanchor'>Select Employment Status to Continue!</div>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
	if (document.loan_form.Employment_Status.value==0)
	{
		if (document.loan_form.Annual_Turnover.selectedIndex==0)
		{
			document.getElementById('annualTurnoverVal').innerHTML = "<div  class='hintanchor'>Select Annual Turnover to Continue!</div>";
			document.loan_form.Annual_Turnover.focus();
			return false;
		}
	}
	if(document.loan_form.Employment_Status.value==1)
	{
		if((document.loan_form.Company_Name.value=="") || (document.loan_form.Company_Name.value=="Type slowly to autofill")|| (Trim(document.loan_form.Company_Name.value))==false)
		{
			document.getElementById('companyNameVal').innerHTML = "<div  class='hintanchor'>Fill Company Name!</div>";	
			document.loan_form.Company_Name.focus();
			return false;
		}
		else if(document.loan_form.Company_Name.value.length < 3)
		{
			document.getElementById('companyNameVal').innerHTML = "<div  class='hintanchor'>Fill Company Name!</div>";	
			document.loan_form.Company_Name.focus();
			return false;
		}
	}
	if (document.loan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<div  class='hintanchor'>Enter Annual Income!</div>";	
		document.loan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.IncomeAmount, 'Annual Income',0)){
		return false;
	}
		
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<div class='hintanchor'>Enter City to Continue!</div>";	
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<div class='hintanchor'>Enter Other City to Continue!</div>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
		if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
			document.getElementById('othercityVal').innerHTML = "<div class='hintanchor'>Remove Special Characters!</div>";	
			document.loan_form.City_Other.focus();
			return false;
		}
	}	
	
	/******* Validation for Personal Details Starts here *******/
	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false || document.loan_form.Name.value=='Full Name')
	{
        document.getElementById('nameVal').innerHTML = "<div class='hintanchor'>Please Enter Your name</div>";		
		document.loan_form.Name.focus();
		return false;
	}
	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<div class='hintanchor'>First Name contains numbers!</div>";
			document.loan_form.Name.focus();
			return false;
		}
	}
	for (var i = 0; i <document.loan_form.Name.value.length; i++)
	{
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<div class='hintanchor'>Contains special characters!</div>";
			document.loan_form.Name.focus();
			return false;
		}
	}
	if(document.loan_form.Email.value=="" || document.loan_form.Email.value=='Email')
	{
		document.getElementById('emailVal').innerHTML = "<div  class='hintanchor'>Enter  Email Address!</div>";	
		document.loan_form.Email.focus();
		return false;
	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<div class='hintanchor'>Enter Valid Email Address!</div>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<div class='hintanchor'>Enter Valid Email Address!</div>";	
		document.loan_form.Email.focus();
		return false;
	}
	if(document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<div  class='hintanchor'>Fill Mobile Number!</div>";
		document.loan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<div  class='hintanchor'>Enter numeric value!</div>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<div  class='hintanchor'>Enter 10 Digits!</div>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<div  class='hintanchor'>should start with 9 or 8 or 7!</div>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if(document.loan_form.day.value=="" || document.loan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<div  class='hintanchor'>Fill Day of Birth!</div>";
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
		if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<div  class='hintanchor'>Date of Birth(Range 1-31)!</div>";
			document.loan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<div  class='hintanchor'>Fill month of Birth!</div>";
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
		if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<div  class='hintanchor'>Month of Birth(Range 1-12)!</div>";
			document.loan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<div  class='hintanchor'>Fill Year of Birth!</div>";
		document.loan_form.year.focus();
		return false;
	}
	if(document.loan_form.year.value!="")
	{
		if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<div  class='hintanchor'>Age between 18 -62!</div>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4)){
		return false;
	}
	
	/*
	if (document.loan_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<div  class='hintanchor'>Enter Pincode!</div>";	
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<div  class='hintanchor'>Enter Pincode(6 Digits)!</div>";	
			document.loan_form.Pincode.focus();
			return false;
		}
	}
	*/

	var myOption = -1;
	for (i=document.loan_form.CC_Holder.length-1; i > -1; i--) {
		if(document.loan_form.CC_Holder[i].checked) {
			if(i==0)
			{
				if (document.loan_form.Card_Vintage.selectedIndex==0)
				{
					document.getElementById('vintageVal').innerHTML = "<div  class='hintanchor'>Holding Credit Card Since!</div>";	
					document.loan_form.Card_Vintage.focus();
					return false;
				}
			}
			myOption = i;
		}
	}

	if (myOption == -1) 
	{
		document.getElementById('vintageVal').innerHTML = "<div  class='hintanchor'>Credit Card holder or not!</div>";	
		return false;
	}
	/***********/
	
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<div  class='hintanchor'>Read and Accept Terms & Conditions!</div>";
		document.loan_form.accept.focus();
		return false;
	}	
}  

function addIdentified()
{		
	//alert('Hi');
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '<div style="height:47px; margin-top:5px; margin-bottom:5px;"><div class="bodytext">Card held since?</div> <div class="text margin_left_new1212" style=" height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select size="1" name="Card_Vintage" class="select-input" onchange="validateDiv(\'vintageVal\');"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div id="vintageVal"></div></div>';
	return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	var ni2 = document.getElementById('myDiv2');		
	ni1.innerHTML = '';
	ni2.innerHTML = '';
	return true;
}	

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
</script>
<script type="text/javascript">
function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
	var txtview = '<table style="border:1px solid #000000; padding:2px; width:100%; margin-bottom:5px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#000000; font-weight:normal; " height="20"><span style="color:#990000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal;"> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td></tr></table>';	
	hdfclifecamp(ni1,cit,txtview);
}

function change_empstst()
{	
	var occpdiv = document.getElementById('chnge_empstst');
	var occupation = document.loan_form.Employment_Status.value;
	document.getElementById('company_name_area').style.display='block';
	if(occupation==0)
	{
	document.getElementById('chnge_empstst').style.display='block';
	occpdiv.innerHTML = '<div><div><span class="bodytext">Annual Turnover: </span></div><div><select name="Annual_Turnover" id="Annual_Turnover" class="select-input" tabindex="3" onchange="setTimeout(show_annual_income_area,2000);"><option value="">Please Select</option><option value="1"> 0 To 40 Lacs</option><option value="4"> 40 Lacs To 1 Cr</option><option value="2" > 1Cr - 3Crs </option><option value="3">3Crs & above</option></select><div id="annualTurnoverVal"></div></div></div>';
	
	}
	else
	{
	document.getElementById('chnge_empstst').style.display='block';	
	occpdiv.innerHTML = '<div><div><span class="bodytext">Company Name: </span></div><div><input name="Company_Name" id="Company_Name" type="text" class="input" onblur="onBlurDefault(this,\'Type slowly to autofill\');" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'\'); setTimeout(show_annual_income_area,2000);" onfocus="onFocusBlank(this,\'Type slowly to autofill\');" onkeydown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill" tabindex="3" /><div id="companyNameVal"></div></div></div>';
	}				
}
</script>

<script type="text/javascript">

function show_annual_income_area(){

	$("#annual_income_area").show( 2000, function() {
		// Animation complete.
	});
}
function show_city_area(){

	$("#city_area").show( 2000, function() {
		// Animation complete.
	});
}
</script>

</head>
<body>
<div class="header">
<div class="header-inn">
<img src="images/d4l-logo-new-home-loan.png" width="152" height="65"></div>
</div>
<div style="clear:both;"></div>
<div class="second-wrapper">
<div class="left-box-form">
<form name="loan_form" method="post" action="insert_personal_loan_value_httpsstep.php" onSubmit="return chkpersonalloan();">
<input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>" />
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td scope="row"><h1>Personal Loan Request</h1></td>
    </tr>
    <tr>
      <td scope="row"><h2>Professional Details</h2></td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
    </tr>
    <tr>
      <td height="35" class="bodytext" scope="row">Loan Amount</td>
    </tr>
    <tr>
      <td scope="row">
        <input type="text" name="Loan_Amount" id="Loan_Amount" class="input" value="Enter Loan Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="if(this.value!=''){intOnly(this);  getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); setTimeout(bringForm,2000);}" onBlur="if(this.value==''){ this.value='Enter Loan Amount'; }else{ getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); }" onKeyDown="validateDiv('loanAmtVal');" tabindex="1" onFocus="if(this.value=='Enter Loan Amount'){ this.value='';}" />
        <div id="loanAmtVal"></div>
        <div id="show_amount_area">
	        <span id='formatedlA' style='font-size:11px; font-weight:normal; color:#000000;font-Family:Verdana;'></span>
    	    <span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize;'></span>
        </div>   
      </td>
    </tr>
    <tr>
      <td scope="row" height="10"></td>
    </tr>
  </table>
  <div id="occupation_area" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" class="bodytext" scope="row">Occupation</td>
    </tr>
    <tr>
      <td scope="row">
        <select name="Employment_Status" id="Employment_Status" onChange="validateDiv('empStatusVal'); change_empstst();" class="select-input" tabindex="2">
           <option value="-1">Please Select</option>
           <option value="1">Salaried</option>
           <option value="0">Self Employed</option>
        </select> 
        <div id="empStatusVal"></div>
     </td>
    </tr>
    <tr>
      <td scope="row" height="10"></td>
    </tr>
  </table>
  </div>
  <div id="company_name_area">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td scope="row">
	   <div id="chnge_empstst" style="display:none;">    
        <input name="Company_Name" id="Company_Name" type="text" class="input" onBlur="onBlurDefault(this,'Type slowly to autofill');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event,''); setTimeout(show_city_area,2000);" onFocus="onFocusBlank(this,'Type slowly to autofill');" onKeyDown="validateDiv('companyNameVal');" value="Type slowly to autofill" tabindex="3"/>
        <div id="companyNameVal"></div>
        </div>
        </td>
    </tr>
    <tr>
      <td scope="row" height="10"></td>
    </tr>
  </table>
  </div>
  
  <div id="annual_income_area" style="display:none;">  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" class="bodytext" scope="row">Annual Income</td>
    </tr>
    <tr>
      <td scope="row">
      <input type="text" name="IncomeAmount" id="IncomeAmount" class="input" value="Annual Income" onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome'); setTimeout(show_city_area,2000);" onKeyPress="intOnly(this);" onFocus="if(this.value=='Annual Income'){ this.value='';}" onBlur="if(this.value==''){ this.value='Annual Income';} else{ getDigitToWords('IncomeAmount','formatedIncome','wordIncome');}" onChange="ShowHide('incomeShow','IncomeAmount');" onKeyDown="validateDiv('netSalaryVal');" tabindex="4"/>
      <div id="dialog-modal"></div>
      <div id="netSalaryVal"></div>  
      <div style="padding-left:3px;">
          <span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#000000;font-Family:Verdana;'></span> 
          <span id='wordIncome' style='font-size:11px;font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize;'></span>
      </div>
      </td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
    </tr>
  </table>  
  </div>
  <div id="city_area" style="display:none;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" class="bodytext" scope="row">City</td>
    </tr>
    <tr>
      <td scope="row">
        <select name="City" id="City" class="select-input" onChange="othercity1(); addhdfclife(); validateDiv('cityVal');" tabindex="5">
            <?php echo plgetCityList($City); ?>
            <option value="Vapi">Vapi</option>
            <option value="Ankleshwar">Ankleshwar</option>
            <option value="Anand">Anand</option>
            <option value="Anand">Dahod</option>
            <option value="Anand">Navsari</option>
        </select>
        <div id="cityVal"></div>
      </td>
    </tr>
    <tr>
      <td scope="row" height="10"></td>
    </tr>
   </table>
   </div>
   
   <div id="other_city_field" style="display:none;">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" class="bodytext" scope="row">Other City</td>
        </tr>
        <tr>
          <td scope="row">
            <input name="City_Other" id="City_Other" type="text" class="input" disabled  onkeydown="validateDiv('othercityVal');" tabindex="6" />
            <div id="othercityVal"></div>
          </td>
        </tr>
        <tr>
          <td scope="row" height="10"></td>
        </tr>
     </table>    
   </div>
   
   <div id="personal_details_area" style="display:none;">
   <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
    <tr>
      <td scope="row"><h2>Personal Details</h2></td>
    </tr>
    <tr>
      <td class="bodytext_b" scope="row"><img src="images/lock-image.png" width="9" height="13"> Your Information is secure with us &amp; will not be shared without your consent</td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
    </tr>
    <tr>
      <td height="35" class="bodytext" scope="row">Full Name</td>
    </tr>
    <tr>
      <td scope="row">
        <input type="hidden" name="Activate" id="Activate">
        <input type="hidden" name="source" value="<?php echo $retrivesource; ?>">
        <input type="text" name="Name" id="Name" value="" class="input" onKeyDown="validateDiv('nameVal');" tabindex="7"  />
        <div id="nameVal"></div>  
      </td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
    </tr>
    <tr>
      <td height="35" class="bodytext" scope="row">E-mail ID</td>
    </tr>
    <tr>
      <td scope="row">
      <input type="text" name="Email" id="Email" value="" class="input" onKeyDown="validateDiv('emailVal');" tabindex="8"  />
      <div id="emailVal"></div>
      </td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
    </tr>
    <tr>
      <td height="35" class="bodytext" scope="row">Mobile Number</td>
    </tr>
    <tr>
       <td scope="row">
       <table width="100%" border="0" cellpadding="0" cellspacing="0">
    	  <tr>
            <td width="10%" valign="middle" class="bodytext">+91</td>
            <td width="90%">
            <input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="" onChange="intOnly(this);" type="text" class="input" onKeyDown="validateDiv('phoneVal');" tabindex="9" />
            <div id="phoneVal"></div>    
            </td>
          </tr>
        </table>
        </td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
    </tr>
    <tr>
      <td class="bodytext" scope="row">Date Of Birth</td>
    </tr>
    <tr>
    	<td>
        <input name="day" id="day" type="text" class="dd" value="dd" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" tabindex="10" />&nbsp;
                   
        <input name="month" id="month" type="text" class="mm" value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" tabindex="11" />&nbsp;
                  
        <input name="year" id="year" type="text" class="yy" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv('dobVal');" tabindex="12" />
        <div id="dobVal"></div>        
        </td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
    </tr>    
    <tr>
      <td class="bodytext" scope="row">Are you a Credit card holder? 
        <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onClick="return addIdentified();" style="border:none;" tabindex="13" />
        Yes 
        <input type="radio" name="CC_Holder" id="CC_Holder" onClick="removeIdentified();" value="0" style="border:none;" checked="checked" tabindex="14" />
        No
        <div class="section_input_new12 margin_left_new1212_mob">
        <div id="myDiv1" class="margin_left_new1212_mob "></div>
        </div>
      </td>
    </tr>
    <tr>
      <td scope="row">&nbsp;</td>
    </tr>
    <tr>
      <td class="bodytext_c" scope="row">
      <input name="accept" type="checkbox" /> I authorize Deal4loans.com & its <a href="/pl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style="color:#0482ab; font-size:11px; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#0482ab; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#0482ab; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
      <div id="acceptVal"></div>  
      </td>
    </tr>
    <tr>
      <td class="bodytext_c" scope="row">&nbsp;</td>
    </tr>
  </table>
  </div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">  
    <tr>
      <td align="center" class="bodytext_c" scope="row">
      <div id="button_check">
      <a href="javascript: void(0)" onClick="checkLoanAmount();"><img src="images/get-quote-btn-new.png" height="61" width="201" /></a>
      </div>
      <div id="button_submit" style="display:none;">
      <input type="image" name="button" id="button" value="Submit" src="images/get-quote-btn-new.png" height="61" width="201">
      </div>      
      </td>
    </tr>
    <tr>
      <td class="bodytext_c" scope="row">&nbsp;</td>
    </tr>
    <tr>
        <td id="hdfclife"></td>
    </tr>
  </table>
</form>
</div>
<div class="form_shadow"><img src="images/shadow-form-box-new.png" width="69" height="100%"></div>
<div class="right-side_box">
<div class="list-bank_box">List of top Personal Loans Banks in India</div>
<div class="banking-logo" style="color:#063861;">ICICI Bank</div>
<div class="banking-logo" style="color:#041d6f;">HDFC Bank</div>
<div class="banking-logo" style="color:#f27800;">ING Vysya</div>
<div class="banking-logo" style="color:#ed1c24;">Kotak</div>
<div style="clear:both;"></div>
<div class="banking-logo" style="color:#cd5a13;">Fullerton</div>
<div class="banking-logo" style="color:#0076bc;">Bajaj Finserv</div>
<div class="banking-logo" style="color:#3ba5c8;">SBI</div>
<div style="clear:both;"></div>
<div class="orange-box-sample">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" colspan="5" class="orange-box-sample-head-text" scope="row">Sample Personal Loan Quotes</td>
      </tr>
    <tr>
      <th width="12%" height="25" align="center" bgcolor="#3ba5c8" class="tbl-new-plhead" scope="row">Bank</th>
      <td width="22%" height="25" align="center" bgcolor="#3ba5c8" class="tbl-new-plhead">Interest Rate</td>
      <td width="26%" height="25" align="center" bgcolor="#3ba5c8" class="tbl-new-plhead">Eligible Loan Amt.</td>
      <td width="15%" height="25" align="center" bgcolor="#3ba5c8" class="tbl-new-plhead">EMI</td>
      <td width="25%" height="25" align="center" bgcolor="#3ba5c8" class="tbl-new-plhead">Pre-Payment</td>
    </tr>
    <tr>
      <th height="30" bgcolor="#FFFFFF" class="tbl-new-plhead-b" scope="row">Bank A</th>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">14%</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Rs. 1,00,000</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Rs. 2,733</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">4%</td>
    </tr>
    <tr>
      <th height="30" bgcolor="#FFFFFF" class="tbl-new-plhead-b" scope="row">Bank B</th>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">14.25%</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Rs. 1,25,000</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Rs. 3,432</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Nil</td>
    </tr>
    <tr>
      <th height="30" bgcolor="#FFFFFF" class="tbl-new-plhead-b" scope="row">Bank C</th>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">15%</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Rs. 1,80,000</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Rs. 5,010</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Nil</td>
    </tr>
    <tr>
      <th height="30" bgcolor="#FFFFFF" class="tbl-new-plhead-b" scope="row">Bank D</th>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">16%</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Rs. 1,50,000</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">Rs. 4,251</td>
      <td height="30" align="center" bgcolor="#FFFFFF" class="tbl-new-plhead-b">4%</td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" scope="row"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th width="57%" scope="row">&nbsp;</th>
          <td width="43%">&nbsp;</td>
        </tr>
        <tr>
<td align="left" class="quote-taken-text-head" >Personal Loan quotes taken this month from <span style="font-size:19px; font-weight:bold;">Deal4loans</span></td>
          <td><table width="120" border="0" align="right" cellpadding="0" cellspacing="2">
            <tr>
              <th height="25" align="center" bgcolor="#FFFFFF" class="count-text" scope="row">5</th>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">9</td>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">9</td>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">0</td>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">5</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <th scope="row">&nbsp;</th>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="left" class="quote-taken-text-head" scope="row">Loans quotes taken from <span style="font-size:19px; font-weight:bold;">Deal4loans</span></td>
          <td><table width="150" border="0" align="right" cellpadding="0" cellspacing="2">
            <tr>
              <th height="25" align="center" bgcolor="#FFFFFF" class="count-text" scope="row">5</th>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">1</td>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">7</td>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">7</td>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">7</td>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">6</td>
              <td height="25" align="center" bgcolor="#FFFFFF" class="count-text">5</td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div class="wy_text"><strong>Why Deal4loans.com</strong> - Widest Choice of Banks</div>
<div class="greebullet-text">
<ul>
<li>Get free instant quote on Rates, Emi, Eligibility, <strong style="font-size:17px; color:#ec7205;">Fees</strong> & Documents from all Banks.</li>
<li>Pick best Bank as per your requirement.</li>
<li>Rate as low as <strong style="font-size:17px; color:#ec7205;">11.99%</strong> on loan 20lacs & above.</li>
<li>3 Banks with 0 Prepayment Charges.</li>
<li>Loan disbursal in <strong style="font-size:17px; color:#ec7205;">48 hours</strong> from 5 Banks.</li>
</ul>
</div>
</div>
</div>
</body>
</html>