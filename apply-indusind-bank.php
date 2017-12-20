<?php  require 'scripts/db_init.php'; 
require 'scripts/functions.php'; 

if(strlen($_REQUEST['source'])>0 && isset($_REQUEST['source'])) {	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="INdus Bank"; }

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IndusInd Bank Personal Loan</title>
<link href="indusind-pl-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="listingindus.js"></script>
<style>
	/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:308px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}				#dhtmlgoodies_tooltip{		background-color:#ffe688;		border:1px solid #000;		position:absolute;		color:#000000;		display:none;		margin-left:-13px;		z-index:20000;		padding:0px;		font-size:0.9em;		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;			}	#dhtmlgoodies_tooltipShadow{		position:absolute;		background-color:#555;		display:none;		margin-left:-13px;		z-index:10000;		opacity:0.7;		filter:alpha(opacity=70);		-khtml-opacity: 0.7;		-moz-opacity: 0.7;	} 
select:focus, input:focus
{
border:#ff6600 2px solid; 
} </style>
<script type="text/javascript" language="javascript">
function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
		
ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"> <tr><td width="40%"  align="left" style="font-size:18px !important; color:#FFFFFF;"> Personal Details</td><td><table><tr><td width="1%" style="font-size:10px; font-weight:normal; color:#FFFFFF;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="53%" align="left" class="body_text"  style="font-size:10px; font-weight:normal; color:#FFFFFF;">We keep this secure</td></tr> </table></td></tr>    <tr>      <td width="44%" align="left" style="font-family:Arial, Helvetica, sans-serif; color:#FFF !important; font-size:12px;" >Full Name</td>      <td width="56%" align="left" >        <input name="Name" type="text" class="input" id="Name" onKeyDown="validateDiv(\'nameVal\');" tabindex=7>    <div id="nameVal" class="alert_msg"></div></td>    </tr>     <tr>      <td colspan="2" align="left" scope="row" height="10"></td>      </tr>    <tr>      <td width="44%" align="left" class="body_text" scope="row">Mobile Number</td>      <td width="56%" align="left" scope="row" class="body_text">    +91    <input name="Phone" type="text" class="input" id="Phone" onKeyDown="validateDiv(\'mobileVal\');" maxlength="10" style="width:86%" tabindex=8>    <div id="mobileVal" class="alert_msg"></div></td>    </tr>     <tr>      <td colspan="2" align="left" scope="row" height="10"></td>      </tr>     <tr>      <td width="44%" align="left" class="body_text" scope="row">Email</td>      <td width="56%" align="left" scope="row">        <input name="Email" type="text" class="input" id="Email" onKeyDown="validateDiv(\'emailVal\');" tabindex=9>   <div id="emailVal" class="alert_msg"></div> </td>    </tr><tr>      <td colspan="2" align="left" scope="row" height="10"></td>      </tr>     <tr>      <td width="44%" align="left" class="body_text" scope="row">Age</td>      <td width="56%" align="left" scope="row">        <input name="age" type="text" class="input" id="age" onKeyDown="validateDiv(\'ageVal\');" tabindex=10>   <div id="ageVal" class="alert_msg"></div> </td>    </tr><tr>      <td colspan="2" align="left" scope="row" height="10"></td>      </tr><tr><td colspan="2" align="center"  scope="row"><input name="image"  value="Submit" type="image" src="images/indusind-get-quotebtn.png" width="97" height="32"></td>      </tr></table>';
}

function othercity1()
{
	var ni1 = document.getElementById('othCitDiv');
	var ni2 = document.getElementById('othCitvalDiv');
	if(document.indusind_plform.City.value=='Others')
	{
		ni1.innerHTML = 'Other City';
		ni2.innerHTML = '<input name="City_Other" id="City_Other" class="input" validateDiv(\'othercityVal\'); /><div id="CityOLayer"></div><div id="othercityVal"></div>';
	}
	else	
	{
		ni1.innerHTML = '';
		ni2.innerHTML = '';
	}
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
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
	}
	return true;
}
	
function validmobile(mobile) 
{
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;
return true;
}
function chkpersonalloan(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
 if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
{
	document.getElementById('loanVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Enter Existing Loan Amount!</span>";
	Form.Loan_Amount.focus();
	return false;
}
if(Form.Employment_Status.selectedIndex==0)
{
	document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Select Employment Status!</span>";
	Form.Employment_Status.focus();
	return false;
}
if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Type slowly for Autofill") || (Form.Company_Name.value=="Company Name"))
	{
		document.getElementById('companyVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Enter Company Name!</span>";
		Form.Company_Name.focus();
		return false;
	}
	else if(Form.Company_Name.value.length < 3)
	{
		document.getElementById('companyVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Enter Company Name!</span>";
		Form.Company_Name.focus();
		return false;
	}

 if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)"))
{
	document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Enter Income!</span>";
	Form.IncomeAmount.focus();
	return false;
}
if(Form.City.selectedIndex==0)
{
	document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Select City!</span>";		
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
	document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Enter Other City!</span>";

Form.City_Other.focus();
return false;
}
if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
{
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Please Enter Your name</span>";		
	Form.Name.focus();
	return false;
}
else if(containsdigit(Form.Name.value)==true)
{
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Name Contains Numbers</span>";		
	Form.Name.focus();
	return false;
}
for (var i = 0; i < Form.Name.value.length; i++) 
{
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) 
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Name has special characters</span>";		
		Form.Name.focus();
		return false;
  	}
}
if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
	document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#db1917;'>Enter Mobile Number</span>";
	Form.Phone.focus();
	return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
		  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#db1917;'>Enter Numeric Value</span>";
		  Form.Phone.focus();
		  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
		  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#db1917;'>Enter 10 Digits</span>";
		  Form.Phone.focus();
		  return false;
        }
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#db1917;'>Start with 9 or 8 or 7</span>";
				 Form.Phone.focus();
                return false;
        }
		if(Form.Email.value=="")
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Enter  Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		
		var str=Form.Email.value
		var aa=str.indexOf("@")
		var bb=str.indexOf(".")
		var cc=str.charAt(aa)
		if(aa==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Enter Valid Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		else if(bb==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Enter Valid Email Address!</span>";	
			Form.Email.focus();
			return false;
		}

	if((Form.age.value=="") || (Form.age.value=="Name")|| (Trim(Form.age.value))==false)
	{
		document.getElementById('ageVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Please Enter Your age</span>";		
		Form.age.focus();
		return false;
	}

	if(!Form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor' style='color:#db1917;'>Accept Terms & Condition!</span>";	
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
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}
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

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

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
</script>
</head>
<body>
<div class="header">
<div class="header_inn">
<div class="logo"><img src="images/indusind-logo.jpg" width="215" height="40"></div>
<div class="right_top_text">Powered by: <span style="color:#0e8cc6;">Deal4loans.com</span></div>
</div>
</div>
<div class="form_main-wrapper">
<div class="form_main_wrapper-inn">
<div class="left-wrapper">
<h1>Professional Details</h1>
<div class="left-form-wrapper">
<form name="indusind_plform"  method="POST" action="apply-indusind-bank-continue.php" onSubmit="return chkpersonalloan(document.indusind_plform);">
<input type="hidden" name="source" id="source" value="<? echo $retrivesource; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="44%" align="left" class="body_text" scope="row">Required Loan Amount</td>
      <td width="56%" align="left" scope="row">
        <input name="Loan_Amount" type="text" class="input" id="Loan_Amount" onKeyDown="validateDiv('loanVal');" onChange="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress=" getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); intOnly(this);"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" tabindex=1><div id="loanVal"></div>
    </td>
    </tr>
		<td align="left"></td><td><span id='formatedlA' style='font-size:11px;
	font-weight:normal; color:#FFFFFF;font-Family:Verdana;'></span>
	  <span id='wordloanAmount' style='font-size:11px;
	font-weight:normal; color:#FFFFFF;font-Family:Verdana;text-transform: capitalize;'></span>
</td></tr>
    <tr>
      <td colspan="2" align="left" scope="row" height="10"></td>
      </tr>
    <tr>
      <td align="left" class="body_text" scope="row">Employment Status</td>
      <td align="left" scope="row"><select  name="Employment_Status" class="select" id="Employment_Status" onChange="validateDiv('empStatusVal');" tabindex="2">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td colspan="2" align="left" scope="row" height="10"></td>
      </tr>
    <tr>
      <td align="left" class="body_text" scope="row">Company Name</td>
      <td align="left" scope="row"><input name="Company_Name" type="text" class="input" id="Company_Name" onKeyDown="validateDiv('companyVal');" onblur="onBlurDefault(this,'Type slowly to autofill');" onkeyup="ajax_showOptions(this,'getCollegesByLetters',event)" onfocus="onFocusBlank(this,'Type slowly to autofill');" onkeydown="validateDiv('companyNameVal');" value="Type slowly to autofill" tabindex=3 Autocomplete="OFF"><div id="companyVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td colspan="2" align="left" scope="row" height="10"></td>
      </tr>
    <tr>
      <td align="left" class="body_text" scope="row">Net Salary (Per Month)</td>
      <td align="left" scope="row">
        <input name="IncomeAmount" type="text" class="input" id="IncomeAmount_indus" onKeyDown="validateDiv('netSalaryVal');"  onChange="intOnly(this); getDigitToWords('IncomeAmount_indus','formatedIncome','wordIncome');" onkeyup="intOnly(this); getDigitToWords('IncomeAmount_indus','formatedIncome','wordIncome');" onkeypress=" getDigitToWords('IncomeAmount_indus','formatedIncome','wordIncome'); intOnly(this);"  onblur="getDigitToWords('IncomeAmount_indus','formatedIncome','wordIncome');" tabindex=4><div id="netSalaryVal" class="alert_msg"></div>
      </tr>
	  <tr>
	<td align="left"></td><td><span id='formatedIncome' style='font-size:11px;
	font-weight:normal; color:#FFFFFF;font-Family:Verdana;'></span>
	<span id='wordIncome' style='font-size:11px;
	font-weight:normal; color:#FFFFFF;font-Family:Verdana;text-transform: capitalize;'></span></td>
	
</tr>
    <tr>
      <td colspan="2" align="left" scope="row" height="10"></td>
      </tr>
    <tr>
      <td align="left" class="body_text" scope="row">Total Monthly / EMI Obligation</td>
      <td align="left" scope="row"><input name="Total_Obligation" type="text" class="input" id="Total_Obligation" tabindex=5></td>
    </tr>
    <tr>
      <td colspan="2" align="left" scope="row" height="10"></td>
      </tr>
    <tr>
      <td align="left" class="body_text" scope="row">City</td>
      <td align="left" scope="row"><select name="City" class="select" id="City" onChange="addPersonalDetails(); othercity1(); validateDiv('cityVal');" tabindex=6>
       		<option value="">Please Select</option>
              <option value="Ahmedabad">Ahmedabad</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Chandigarh">Chandigarh</option>
            <option value="Chennai">Chennai</option>
            <option value="Delhi">Delhi</option>
            <option value="Faridabad">Faridabad</option>
            <option value="Gaziabad">Gaziabad</option>
            <option value="Gurgaon">Gurgaon</option>
            <option value="Hyderabad">Hyderabad</option>
            <option value="Jaipur">Jaipur</option>
            <option value="Kolkata">Kolkata</option>
            <option value="Mohali">Mohali</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Navi Mumbai">Navi Mumbai</option>
            <option value="Noida">Noida</option>
            <option value="Panchkula">Panchkula</option>
            <option value="Pune">Pune</option>
            <option value="Sahibabad">Sahibabad</option>
            <option value="Thane">Thane</option>
            <option value="Others">Others</option>
      </select><div id="cityVal" class="alert_msg"></div></td>
    </tr>
	<tr>
      <td colspan="2" align="left" scope="row" height="10"></td>
      </tr>
   <tr>
    <td align="left" class="body_text" scope="row" id="othCitDiv"></td>
    <td id="othCitvalDiv"></td>
  </tr>
      <tr>
      <td colspan="2" align="left" scope="row" height="10"></td>
      </tr>
    <tr>
    <td height="34" colspan="2"  id="personalDetails"><table align="center" width="100%" cellpadding="0" cellspacing="0">
   <tr><td align="center"><img src="images/indusind-get-quotebtn.png" width="97" height="32" /></td></tr></table></td>
  </tr>
     <tr>
      <td align="left"  scope="row"></td>
      <td scope="row">&nbsp;</td>
    </tr>
    <tr>
      <td align="left"  scope="row">&nbsp;</td>
      <td scope="row">&nbsp;</td>
    </tr>
	 
  </table>
  </form>
</div>
</div>
<div class="right_box">
<h2>Features of <span style="font-style:italic; font-size:24px;">IndusInd Bank</span> Personal Loan</h2>
<div class="bullet_text">
<ul>
<li>Loan up to 15 Lac*
</li>
<li>Attractive Interest Rate &amp; Processing charges</li>
<li>Hassle free loans - No security/collateral required.<br>
</li>
<li>Choose a loan tenure as per your convenience ranging from 1 to 5 years<br>
</li>
</ul>
</div>
</div>
<div style="clear:both;"></div>
</div>
</div>
<div class="bottom"></div>
</body>
</html>