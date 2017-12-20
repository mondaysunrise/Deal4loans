<?php
include "scripts/db_init.php";
include "scripts/functions.php";

if(isset($_REQUEST["source"]))
{
	$src=$_REQUEST["source"];
}
else
{
	$src="CC LP Jan15";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Credit Card</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-landing-page-styles-8-1-15.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/fm.selectator.jquery.css"/>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/fm.selectator.jquery.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-cclist.js"></script>
<style>
		body {
			font-family: sans-serif;
					}
		label {
			display: block;
			margin-bottom: 5px;
		}
		#wrapper {
			padding: 15px;
		}
		#select1 {
			width: 250px;
			padding: 7px 10px;
		}
		#select2 {
			padding: 5px;
			width: 350px;
			height: 36px;
		}
		#select3 {
			width: 350px;
			height: 36px;
		}		
		#select4 {
			width: 350px;
			height: 36px;
		}		
		#select5 {
			width: 350px;
			height: 50px;
		}
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:100;
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
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
	
	<script>
		$(function () {
			var $activate_selectator1 = $('#activate_selectator1');
			$activate_selectator1.click(function () {
				var $select1 = $('#select1');
				if ($select1.data('selectator') === undefined) {
					$select1.selectator({
						labels: {
							search: 'Search here...'
						}
					});
					$activate_selectator1.val('destroy selectator');
				} else {
					$select1.selectator('destroy');
					$activate_selectator1.val('activate selectator');
				}
			});
			$activate_selectator1.trigger('click');

			var $activate_selectator2 = $('#activate_selectator2');
			$activate_selectator2.click(function () {
				var $select2 = $('#select2');
				if ($select2.data('selectator') === undefined) {
					$select2.selectator({
						useDimmer: true
					});
					$activate_selectator2.val('destroy selectator');
				} else {
					$select2.selectator('destroy');
					$activate_selectator2.val('activate selectator');
				}
			});
			$activate_selectator2.trigger('click');

			var $activate_selectator3 = $('#activate_selectator3');
			$activate_selectator3.click(function () {
				var $select3 = $('#select3');
				if ($select3.data('selectator') === undefined) {
					$select3.selectator({
						useSearch: false
					});
					$activate_selectator3.val('destroy selectator');
				} else {
					$select3.selectator('destroy');
					$activate_selectator3.val('activate selectator');
				}
			});
			$activate_selectator3.trigger('click');

			var $activate_selectator4 = $('#activate_selectator4');
			$activate_selectator4.click(function () {
				var $select4 = $('#select4');
				if ($select4.data('selectator') === undefined) {
					$select4.selectator({
						showAllOptionsOnFocus: true
					});
					$activate_selectator4.val('destroy selectator');
				} else {
					$select4.selectator('destroy');
					$activate_selectator4.val('activate selectator');
				}
			});
			$activate_selectator4.trigger('click');

			var $activate_selectator5 = $('#activate_selectator5');
			$activate_selectator5.click(function () {
				var $select5 = $('#select5');
				if ($select5.data('selectator') === undefined) {
					$select5.selectator({
						useSearch: false
					});
					$activate_selectator5.val('destroy selectator');
				} 
			});
			$activate_selectator5.trigger('click');
		});

//For Validation
function ckhcreditcard(Form)
{	
var cit=Form.City.value;
var sal=Form.Net_Salary.value;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Select Employment Status!");
		Form.Employment_Status.focus();
		return false;
	}
	if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="e.g. 0000000"))
	{
		alert("Enter Annual Income!");	
		Form.Net_Salary.focus();
		return false;
	}
	if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Type Slowly for Autofill")|| (Trim(Form.Company_Name.value))==false)
	{
		alert("Fill Company Name!");	
		Form.Company_Name.focus();
		return false;
	}
	else if(Form.Company_Name.value.length < 3)
	{
		alert("Fill Company Name!");	
		Form.Company_Name.focus();
		return false;
	}
	if(Form.City.selectedIndex==0)
	{
		alert("Enter City to Continue!");	
		Form.City.focus();
		return false;
	}
	else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
	{
	alert("Enter Other City to Continue!");
	Form.City_Other.focus();
	return false;
	}

	if((Form.Full_Name.value=="") || (Trim(Form.Full_Name.value))==false || Form.Full_Name.value=="e.g. Rama")
	{
	alert("Please Enter Your name");		
	Form.Full_Name.focus();
	return false;
	}
	else if(containsdigit(Form.Full_Name.value)==true)
	{
	alert("First Name contains numbers!");
	Form.Full_Name.focus();
	return false;
	}
	  for (var i = 0; i < Form.Full_Name.value.length; i++) {
		if (iChars.indexOf(Form.Full_Name.value.charAt(i)) != -1) {
		alert("Contains special characters!");
		Form.Full_Name.focus();
		return false;
		}
	  }
	if((Form.Phone.value=='0000000000') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
	alert("Kindly fill in your Mobile Number!");
	Form.Phone.focus();
	return false;
	}
	else if(Form.Phone.value.length < 10)
	{
		alert("Fill Mobile Number!");
		Form.Phone.focus();
		return false;
	}
	else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
	{
		alert("Start with 9 or 8 or 7!");
		Form.Phone.focus();
		return false;
	}
	else if(containsalph(Form.Phone.value)==true)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Numeric only!</span>";
		Form.Phone.focus();
		return false;
	}
	if(Form.Email.value=="" || Form.Email.value=="xyx@abcd.com")
	{
		alert("Enter  Email Address!");	
		Form.Email.focus();
		return false;
	}
	
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		alert("Enter Valid Email Address!");	
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Enter Valid Email Address!");	
		Form.Email.focus();
		return false;
	}

	if (Form.Age.selectedIndex==0)
	{
		alert("Please Enter Age!");		
		Form.Age.focus();
		return false;
	}
 	
	if(!Form.accept.checked)
	{
		alert("Read and Accept Terms & Conditions!");	
		Form.accept.focus();
		return false;
	}
		
	if(Form.Email.value=="Email Id")
	{
		Form.Email.value=" ";
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
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
{
return true;
}
}
return false;
}
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function addcty_oth()
{
	var ni = document.getElementById('othercty_id');
	if(document.creditcard_form.City.value=="Others")
		{
		ni.innerHTML = '<div class="fourth-row" >  <div class="fourth-row_b"><span class="row1_sub_b">    <input name="City_Other" type="text" class="input" value="Other City"  id="City_Other" onFocus="(this.value == \'Other City\') &amp;&amp; (this.value = \'\')" onBlur="(this.value == \'\') &amp;&amp; (this.value = \'Other City\')">  </span></div></div>';
		}	
			else
		{
			ni.innerHTML="";
		}
		return true;
	}


function addPDtls()
{
	
	var ni1 = document.getElementById('personalDetails');
	
	ni1.innerHTML='<div class="fifth_wrapper"><div style="float:left; width:10px;">I</div><div class="fifth_row"><input name="Full_Name" type="text" class="input" value="e.g. Rama" onFocus="(this.value == \'e.g. Rama\') &amp;&amp; (this.value = \'\')" onBlur="(this.value == \'\') &amp;&amp; (this.value = \'e.g. Rama\')" id="Full_Name"></div><div class="fifth_row_b">want Complete details at My Contact Number +91</div><div class="fifth_row_c"><input name="Phone" type="text" class="input" value="0000000000" onFocus="(this.value == \'0000000000\') &amp;&amp; (this.value = \'\')" onBlur="(this.value == \'\') &amp;&amp; (this.value = \'0000000000\')" id="Phone" maxlength="10"> </div><div class="clearfix"></div><div class="sixth-row"><div class="sixth-row-inner"><div class="sixth-row-inner-a">and My E-mail Id </div> <div class="sixth-row-inner-b"><input name="Email" type="text" class="input" value="xyx@abcd.com" onBlur="onBlurDefault(this,\'xyx@abcd.com\');" onFocus="onFocusBlank(this,\'xyx@abcd.com\');" id="Email"> </div></div><div class="sixthe_right"><div class="sixthe_right-a">and My age</div><div class="sixthe_right-b"><select name="Age" class="age-input" id="Age"><option value="0">Please select</option>	<option value="18">18 Yrs</option>	<option value="19">19 Yrs</option>	<option value="20">20 Yrs</option>	<option value="21">21 Yrs</option>	<option value="22">22 Yrs</option>	<option value="23">23 Yrs</option>	<option value="24">24 Yrs</option>	<option value="25">25 Yrs</option>	<option value="26">26 Yrs</option>	<option value="27">27 Yrs</option>	<option value="28">28 Yrs</option>	<option value="29">29 Yrs</option>	<option value="30">30 Yrs</option>	<option value="31">31 Yrs</option>	<option value="32">32 Yrs</option>	<option value="33">33 Yrs</option>	<option value="34">34 Yrs</option>	<option value="35">35 Yrs</option>	<option value="36">36 Yrs</option>	<option value="37">37 Yrs</option>	<option value="38">38 Yrs</option>	<option value="39">39 Yrs</option>	<option value="40">40 Yrs</option>	<option value="41">41 Yrs</option>	<option value="42">42 Yrs</option>	<option value="43">43 Yrs</option>	<option value="44">44 Yrs</option>	<option value="45">45 Yrs</option>	<option value="46">46 Yrs</option>	<option value="47">47 Yrs</option>	<option value="48">48 Yrs</option>	<option value="49">49 Yrs</option>	<option value="50">50 Yrs</option>	<option value="51">51 Yrs</option>	<option value="52">52 Yrs</option>	<option value="53">53 Yrs</option>	<option value="54">54 Yrs</option>	<option value="55">55 Yrs</option>	<option value="56">56 Yrs</option>	<option value="57">57 Yrs</option>	<option value="58">58 Yrs</option>	<option value="59">59 Yrs</option>	<option value="60">60 Yrs</option></select></div></div></div><div class="clearfix"></div><div class="seventh-wrapper"><div class="seventh-row-a">I currently have Credit Card with </div><div class="seventh-row-b"><select name="No_of_Banks" class="select_input" id="No_of_Banks"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="RBL Bank">RBL Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="Other">Other</option></select></div></div></div><div class="clearfix"></div><div align="center" style="height:40px; margin-top:5px; font-size:12px;"><input type="checkbox"  name="accept" style="border:none;" checked  > I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div class="clearfix"></div><p><input type="image"  name="Submit" src="images/blue-quotebtn15.png" width="157" height="53"></p><div class="clearfix"></div>';
	}
	
function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}
</script>
</head>
<body>
<div class="header">
<div class="header_inner">
<div class="logo"><img src="images/deal-loas-logo-radious-window-lp.png" width="185" height="62" alt="logo"></div>
<div class="top-text_wrapper"><strong style="color:#fe9205; font-weight:normal;">53,</strong><strong style="color:#03b0da; font-weight:normal;">50,</strong><strong style="color:#f30606; font-weight:normal;">642</strong> quotes taken till now	</div>
</div>
<div class="clearfix"></div>
</div>
<div class="banner">
<div class="banner_a">
<div class="h1">Find the Credit Card that's right for you</div>
<div class="clearfix"></div>
<div class="form_top_wrapper">
		<div class="box1_tp_form">I  am looking for Credit Cards</div>

	  <label for="select4">
			
	  </label>
	  <select id="select4" name="select4" multiple style="width:100%;">
		<optgroup class="group_one">
<option value="1" class="option_one" data-subtitle="" data-left="<img src='images/travel-offer-icon.jpg'>" >Credit Cards</option>
<option value="2" class="option_two" data-subtitle="" data-left="<img src='images/cash-back-offer-icon.jpg'>">Cash back Offer</option>
<option value="2" class="option_two" data-subtitle="" data-left="<img src='images/petro-offer-icon.jpg'>">Petro Offer</option>
<option value="2" class="option_two" data-subtitle="" data-left="<img src='images/dining-lp--icon.jpg'>">Dining Offer</option>
<option value="2" class="option_two" data-subtitle="" data-left="<img src='images/zero-fee-offer.jpg'>">0 fee Credit Card</option>
</optgroup>
<option value="10" class="option_ten" selected>Travel Offer</option>
</select>
		<input value="activate selectator" id="activate_selectator4" type="button" style="display:none;">

			</div>
</div>
</div>
<div class="clearfix"></div>
<form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
<input type="hidden" name="source" value="<? echo $src; ?>"> 
<div class="second-wrapper">
<p>Please show me credit cards as per my interest and eligibility </p>
<div class="clearfix"></div>
<div class="row1">
<div class="row1_sub">
<div class="row1_sub_a">I am working as a</div>
<div class="row1_sub_b">
<select name="Employment_Status" id="Employment_Status" class="select_input" onChange="addPersonalDetails(); validateDiv('empStatusVal');" tabindex="2">
  <option value="-1">Please Select</option>
               <option value="1">Salaried</option>
               <option value="0">Self Employment</option>
         </select>
</div>
</div>
<div class="row1_sub_2"><div class="row1_sub_c">with annual income of</div>
<div class="row1_sub_b"><input name="Net_Salary" type="text" class="input" value="e.g. 0000000" onKeyUp="intOnly(this);getDigitToWords('ccNet_Salary','formatedIncome','wordIncome');" onKeyDown="intOnly(this);getDigitToWords('ccNet_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('ccNet_Salary','formatedIncome','wordIncome'); " onFocus="onFocusBlank(this,'e.g. 0000000');" onBlur="getDigitToWords('ccNet_Salary','formatedIncome','wordIncome'); " id="ccNet_Salary"></div>
<div class="clearfix"></div>
<div class="extra-box"><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></div>
</div>
</div>
<div class="clearfix"></div>
<div class="third-row">
<div class="third-row-inn-a">and working in</div>
<div class="third-row-inn-b"><input name="Company_Name" type="text" style="font-size:13px;" class="input"  value="Type Slowly for Autofill"onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)"  onBlur="onBlurDefault(this,'Type Slowly for Autofill');" onFocus="onFocusBlank(this,'Type Slowly for Autofill');" autocomplete="off" id="Company_Name"></div>
</div>
<div class="fourth-row">
<div class="fourth-row_a"> and live in</div>
<div class="fourth-row_b"> <select  class="select_input"  name="City" id="City" onChange="addPDtls(); addcty_oth();" >         <?=CCgetCityList($City)?>      </select></div>
</div>
<div id="othercty_id">
</div>
<div class="clearfix"></div>
<div id="personalDetails">
<div class="clearfix"></div>
<div align="center" style="height:40px; margin-top:5px; font-size:12px;"><input type="checkbox"  name="accept" style="border:none;" checked  > I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div>
<div class="clearfix"></div>
</div>
<p><img  src="images/blue-quotebtn15.png" width="157" height="53"></p><div class="clearfix"></div>
</div>
</form>
<div class="clearfix" style="height:55px;"></div>
<div class="creditcard_wrapper">
<div class="second_wrapper">
<div>List of top Credit Cards Banks in India</div>
<div class="sbi_text">Sbi Credit Cards</div>
<div class="sbi_text" style="color:#08569f; border-bottom:#08569f thick solid;">Hdfc Credit Cards</div>
<div class="sbi_text" style="color:#1a5b9b; border-bottom:#1a5b9b thick solid;">ICICI Credit Cards</div>
<div class="sbi_text" style="color:#1a5b9b; border-bottom:#0b2e6f thick solid;">Amex Cards</div>
<div class="sbi_text" style="color:#aa2a5d; border-bottom:#aa2a5d thick solid;">Citibank Credit Cards</div>
<div class="sbi_text" style="color:#1c689a; border-bottom:#1c689a thick solid;">Ratnakar Bank Credit Cards</div>
<div class="sbi_text" style="color:#045ca6; border-bottom:#045ca6 thick solid;">Indus Ind Credit Cards</div>
<div class="clearfix_div" style="height:15px;"></div>
</div>
</div>
</body>
</html>