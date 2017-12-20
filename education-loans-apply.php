<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$source = $_REQUEST['source'];
}
else
{
	$source="Education Loan LP";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Education Loan</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/education-loan-lp-styles.css" type="text/css" rel="stylesheet" />
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<Script Language="JavaScript">
function chkeducaionloan(Form)
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
if((document.eduloan_form.Name.value=="") || (Trim(document.eduloan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.eduloan_form.Name.focus();
		return false;
	}
	if(document.eduloan_form.Name.value!="")
	{
		if(containsdigit(document.eduloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.eduloan_form.Name.focus();
			return false;
		}
	}
 for (var i = 0; i <document.eduloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.eduloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.eduloan_form.Name.focus();
			return false;
		}
  }
if (document.eduloan_form.Loan_Amount.value=="")
{
	document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
	document.eduloan_form.Loan_Amount.focus();
	return false;
}
if(Form.Course.selectedIndex==0)
{
	document.getElementById('courseVal').innerHTML = "<span  class='hintanchor'>Enter Course of Study!</span>";	
	Form.Course.focus();
	return false;
}  
if (document.eduloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.eduloan_form.City.focus();
		return false;
	}
if(document.eduloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.eduloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.eduloan_form.Phone.value)|| document.eduloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.eduloan_form.Phone.focus();
		return false;  
	}
	if (document.eduloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.eduloan_form.Phone.focus();
		return false;
	}
	if ((document.eduloan_form.Phone.value.charAt(0)!="9") && (document.eduloan_form.Phone.value.charAt(0)!="8") && (document.eduloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.eduloan_form.Phone.focus();
		return false;
	}
	if(document.eduloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.eduloan_form.Email.focus();
		return false;
	}
	var str=document.eduloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.eduloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.eduloan_form.Email.focus();
		return false;
	}
if(!document.eduloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	
		document.eduloan_form.accept.focus();
		return false;
	}
}  

function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
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
</script>
<style>
.hintanchor {color:#CC0000;}
</style>
</head>
<body>
<div id="header">
<div class="logo"><img src="images/edu-d4l.png" width="160" height="75"></div>
<div class="top_text">Compare <strong style="color:#0d5bac;">Education Loan</strong> Offers from <strong style="color:#0d5bac;">4 different Banks</strong></div>
</div>
<div style="clear:both;"></div>
<div class="second-wrapper">
<form name="eduloan_form"  action="insert_education_loan_value.php" method="POST" onSubmit="return chkeducaionloan(document.eduloan_form);">
 <input type="hidden" name="source" value="<?php echo $source; ?>" />
<div class="form-wrapper">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td class="form_text">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="30%" class="form_text">Name</td>
      <td colspan="2">
        <input type="text" name="Name" id="Name" class="input" onKeyDown="validateDiv('nameVal');" tabindex=1><div id="nameVal"></div>
    </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td class="form_text">Loan Amount </td>
      <td colspan="2"><input type="text" name="Loan_Amount" id="Loan_Amount" class="input" onChange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  tabindex=2><div id="loanAmtVal"></div> <span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#000000;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#000000;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td class="form_text">Country of Study</td>
      <td colspan="2">
        <select name="Country" id="Country" class="select" onChange="validateDiv('countryVal');" tabindex=3>
		<option value="1">India</option>
		<option value="2">UK</option>
		<option value="3">USA</option>
		<option value="4">Other Country</option>
        </select>
		<div id="countryVal"></div>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td class="form_text">Course of Study</td>
      <td colspan="2"><select name="Course" id="Course" class="select" onChange="validateDiv('courseVal');" tabindex=4>
	  <option value="">Please Select</option>
						<option value="3">Graduation Courses</option>
						<option value="2">Post Graduation Courses</option>
						<option value="4">Other Courses</option>
      </select><div id="courseVal"></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td class="form_text">City</td>
      <td colspan="2"><select name="City" id="City" class="select" onChange=" validateDiv('cityVal');" tabindex=5>
	   <?=getCityList($City)?>
      </select><div id="cityVal"></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td class="form_text">Contact Number</td>
      <td width="8%" class="form_text">+91</td>
      <td width="62%"><input type="text" name="Phone" id="Phone" class="input" maxlength="10" tabindex=6 onKeyDown="validateDiv('phoneVal');"> <div id="phoneVal"></div>  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td class="form_text">Email Id</td>
      <td colspan="2"><input type="text" name="Email" id="Email" class="input" onKeyDown="validateDiv('emailVal');" tabindex=7> <div id="emailVal"></div> </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center">
	  <input name="submit" type="image"  src="images/edu-apply-btn.png" style="width:134px; height:43px; border:none;" value="submit">
	 </td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</div>
</form>
<div class="right_panel">
<div class="box1">Get Education Loan for Higher Studies <br/>within India and Overseas</div>
<div class="box2">Special Education loan offers for <br>
  selected Courses
  <div >
  <ul class="bullet-checkbox">
  <li>Engineering</li>
  <li>Medical course</li>
  <li>MBA </li>
  <li>MS & other selected courses</li>
  </ul>
  </div>
  </div>
  <div class="box2">Compare and choose education loan from Multiple Banks offering:-
    <div >
  <ul class="bullet-checkbox">
  <li>Quick loan processing </li>
  <li>Easy repayment Upto 10 yrs</li>
  <li>Loan approval before admission </li>
  <li>Loan Upto 100% Educational expenses </li>
  <li>20 lac above Loan amount also available</li>
  </ul>
  </div>
  </div>
</div>
<div style="clear:both;"></div>
</div>
</body>
</html>
