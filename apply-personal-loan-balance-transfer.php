<?php  require 'scripts/db_init.php'; 

if(strlen($_REQUEST['source'])>0 && isset($_REQUEST['source'])) {	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="Personalloan BT"; }
//for HDFC BT EML_HDFC_PLBT
?>
<!DOCTYPE html>
<html>
<head>
<title>Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="css/apply-personal-loans-lp-styles-new.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/pl_apply-tab_styles-new.css">
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style>
#ajax_listOfOptions{position:absolute;width:250px;height:160px;overflow:auto;border:1px solid #317082;background-color:#FFF;color:#000;font-family:Verdana, Arial, Helvetica, sans-serif;text-align:left;font-size:10px;z-index:100}
#ajax_listOfOptions div{cursor:pointer;font-size:10px;margin:1px;padding:1px}
#ajax_listOfOptions .optionDivSelected{background-color:#2375CB;color:#FFF}
#ajax_listOfOptions_iframe{background-color:red;position:absolute;z-index:5}

.hintanchor {color:#CC0000;}

</style>
<script Language="JavaScript" Type="text/javascript">
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
 if((Form.ExistingLoan_Amount.value=='')||(Form.ExistingLoan_Amount.value=="Loan Amount"))
{
	document.getElementById('loanVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Existing Loan Amount!</span>";
	Form.ExistingLoan_Amount.focus();
	return false;
}
 if((Form.Existing_Rate.value==''))
{
	document.getElementById('ExistingRateVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Existing Rate of Interest!</span>";
	Form.Existing_Rate.focus();
	return false;
}
if(Form.Existing_Bank.selectedIndex==0)
{
	document.getElementById('ExistingBankVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Select Name of Existing Banks!</span>";
	Form.Existing_Bank.focus();
	return false;
}
if(Form.Existing_EMI.selectedIndex==0)
{
	document.getElementById('ExistingEmiVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>No of Existing EMI!</span>";
	Form.Existing_EMI.focus();
	return false;
}
if(Form.Employment_Status.selectedIndex==0)
{
	document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Select Employment Status!</span>";
	Form.Employment_Status.focus();
	return false;
}
if(Form.Employment_Status.value==1)
{
	if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Type slowly for Autofill") || (Form.Company_Name.value=="Company Name"))
	{
		document.getElementById('companyVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Company Name!</span>";
		Form.Company_Name.focus();
		return false;
	}
	else if(Form.Company_Name.value.length < 3)
	{
		document.getElementById('companyVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Company Name!</span>";
		Form.Company_Name.focus();
		return false;
	}
}
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)"))
{
	document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Income!</span>";
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
	document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Other City!</span>";

Form.City_Other.focus();
return false;
}
if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
{
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Please Enter Your name</span>";		
	Form.Name.focus();
	return false;
}
else if(containsdigit(Form.Name.value)==true)
{
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Name Contains Numbers</span>";		
	Form.Name.focus();
	return false;
}
for (var i = 0; i < Form.Name.value.length; i++) 
{
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) 
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Name has special characters</span>";		
		Form.Name.focus();
		return false;
  	}
}
if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Date of Birth</span>";
	Form.day.select();
	return false;
}
else if(!num.test(Form.day.value))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Date of Birth</span>";
	Form.day.select();
	return false;
}
else if((Form.day.value<1) || (Form.day.value>31))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Day, Range 1-31</span>";
	Form.day.select();
	return false;
}
else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Month of Birth</span>";
	Form.month.select();
	return false;
}
else if(!num.test(Form.month.value))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Month of Birth</span>";
	Form.month.select();
	return false;
}
else if((Form.month.value<1) || (Form.month.value>12))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Month, Range 1-12</span>";
	Form.month.select();
	return false;
}
else if((Form.month.value==2) && (Form.day.value>29))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'> February, Only 29 days.</span>";
	Form.day.select();
	return false;
}
else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Year of Birth</span>";
	Form.year.select();
	return false;
}
else if(!num.test(Form.year.value))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Year of Birth</span>";
	Form.year.select();
	return false;
}
else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>February, Only 28 days.</span>";
	Form.day.select();
	return false;
}
else if(Form.year.value.length != 4)
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter 4 Digit</span>";
	Form.year.select();
	return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Age group 21 - 62</span>";
	Form.year.select();
	return false;
}
else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Cannot have 31st Day</span>";
	Form.day.select();
	return false;
}
if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
	document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#3070F1;'>Enter Mobile Number</span>";
	Form.Phone.focus();
	return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
		  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#3070F1;'>Enter Numeric Value</span>";
		  Form.Phone.focus();
		  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
		  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#3070F1;'>Enter 10 Digits</span>";
		  Form.Phone.focus();
		  return false;
        }
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#3070F1;'>Start with 9 or 8 or 7</span>";
				 Form.Phone.focus();
                return false;
        }
		if(Form.Email.value=="")
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter  Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		
		var str=Form.Email.value
		var aa=str.indexOf("@")
		var bb=str.indexOf(".")
		var cc=str.charAt(aa)
		if(aa==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Valid Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		else if(bb==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Enter Valid Email Address!</span>";	
			Form.Email.focus();
			return false;
		}

	if(!Form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor' style='color:#3070F1;'>Accept Terms & Condition!</span>";	
		Form.accept.focus();
		return false;
	}
if(Form.Email.value=="Email Id")
{
	Form.Email.value=" ";
}
}

function addcty_oth()
{
	var ni = document.getElementById('myDiv');
		if(ni.innerHTML=="")
		{
		if(document.personalloan_form.City.value=="Others")
			{
				ni.innerHTML ='<table cellpadding="0" cellspacing="0" width="100%"><tr align="left"><td height="26" class="bldtxt" width="40%">Other City </td><td width="60%" class="alert_msg"><input name="City_Other" id="City_Other" type="text" style="width:140px; " onblur="onBlurDefault(this,\'Other City\');"  onfocus="onFocusBlank(this,\'Other City\');" onkeydown="validateDiv(\'othercityVal\');"  /><div id="othercityVal"></div</td></tr></table>';
					}
		}
		else
	{
		ni.innerHTML="";
	}
		return true;
}
			
function addcmp_nme()
{ var citemps=document.personalloan_form.Employment_Status.value;
	var ni = document.getElementById('myCmpDiv');
	var ni1 = document.getElementById('myCmpDiv1');
		if(ni.innerHTML=="")
		{
		
		if(document.personalloan_form.Employment_Status.selectedIndex >0 && citemps==1)
			{
				ni.innerHTML ='Company Name';
				ni1.innerHTML ='<input name="Company_Name" id="Company_Name" type="text" class="input" onBlur="onBlurDefault(this,\'Type slowly for Autofill\');"  onFocus="onFocusBlank(this,\'Type slowly for Autofill\');"  onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" value="Type slowly for Autofill" tabindex=10 autocomplete="off" onkeydown="validateDiv(\'companyVal\');" /><div id="companyVal"></div>';
			}
		}
		else
	{
		ni.innerHTML="";
		ni1.innerHTML="";
	}
		return true;
}

function chgtxtsal(){

var nitxt=document.getElementById('chgtxt');
	var niadtxt=document.getElementById('myanualtDiv');
	var niadtxt1=document.getElementById('myanualtDiv1');
	var citemp=document.personalloan_form.Employment_Status.value;

	if(citemp==0){
		nitxt.innerHTML="Annual ITR";
		niadtxt.innerHTML="Annual Turnover"; 
		niadtxt1.innerHTML="<select name='Annual_Turnover' id='Annual_Turnover'  class='select'>		<option value=''>Please Select</option>	<option value='1' > 0 - 40 Lacs</option>	<option value='4' > 40 Lacs - 1 Cr</option>		<option value='2' > 1Cr - 3Crs </option>	<option value='3' >3Crs & above</option>		</select>";
	}
		else{nitxt.innerHTML="Annual Income";niadtxt.innerHTML=""; niadtxt1.innerHTML=""}}
</script>
<Script Language="JavaScript">

	function addtooltip()
{	var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML=="")
		{
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
		}
		return true;
	}
function othercity1()
{
if(document.personalloan_form.City.value=='Others')
{
document.personalloan_form.City_Other.disabled=false;
}
else
{document.personalloan_form.City_Other.disabled=true;
}
}
function removetooltip()
{
		var ni = document.getElementById('myDiv1');
		if(ni.innerHTML!="")
		{
		ni.innerHTML = '';
		}
	return true;
	}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
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

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni7 = document.getElementById('othCitDiv');
	var ni8 = document.getElementById('othCitvalDiv');
	
	if(document.personalloan_form.City.value=='Others')
	{
		ni7.innerHTML = 'Other City';
		ni8.innerHTML = '<input value="Other City" name="City_Other" id="City_Other" class="input" onBlur="onBlurDefault(this,\'Other City\');"  onfocus="onFocusBlank(this,\'Other City\');" onKeyUp="searchSuggest();" /><div id="CityOLayer"></div><div id="othercityVal"></div>';
	}
	else { ni8.innerHTML = '';		ni7.innerHTML = '';	}
		ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td align="left" valign="middle" class="bldtxt" colspan="2" style="padding-top:3px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="48%"  align="left" class="personal_text" colspan="2"> Personal Details</td></tr><tr><td width="4%" style="font-size:10px; font-weight:normal; color:#07296D;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="96%" align="left"class="sbi_text_a"  style="font-size:10px; font-weight:normal; color:#07296D;">Your Information is secure with us & will not be shared without your consent</td></tr></table></td></tr>    <tr>    <td width="35%" height="45" class="form_text">Full Name</td>    <td width="65%"  class="alert_msg"><input name="Name" type="text" class="input" id="Name" tabindex=6  onFocus="onFocusBlank(this,\'Name\');"  onBlur="onBlurDefault(this,\'Name\');" onChange="insertData();" onkeydown="validateDiv(\'nameVal\');"/><div id="nameVal"></div></td>  </tr>  <tr>    <td height="45" class="form_text">DOB</td>    <td  class="alert_msg"><input name="day" type="text" class="month" id="day" tabindex=7  onFocus="onFocusBlank(this,\'dd\');" onBlur="onBlurDefault(this,\'dd\');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="dd" maxlength="2" onKeyDown="validateDiv(\'dobVal\');"/> <input name="month" type="text" class="month" id="month" tabindex=8 onFocus="onFocusBlank(this,\'mm\');" onBlur="onBlurDefault(this,\'mm\');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="mm" maxlength="2" onKeyDown="validateDiv(\'dobVal\');" /> <input name="year" type="text" class="year" id="year" tabindex=9  onFocus="onFocusBlank(this,\'yyyy\');"   onBlur="onBlurDefault(this,\'yyyy\');" onChange="intOnly(this); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="yyyy" maxlength="4" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal"></div></td>  </tr>  <tr>   <td height="45" class="form_text">Mobile No.</td>    <td  class="form_text"  >+91 <input name="Phone" type="text" class="mobile" id="Phone"  tabindex=10 onFocus="addtooltip();" onChange="intOnly(this); tosendsms(); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="10" onKeyDown="validateDiv(\'mobileVal\');" /><div id="mobileVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="45" class="form_text">Email Id</td>    <td class="alert_msg"><input name="Email" id="Email" type="text"  onblur="onBlurDefault(this,\'Email Id\');" onFocus="removetooltip();"  onChange="insertData();" tabindex=11 onKeyDown="validateDiv(\'emailVal\');" class="input" /><div id="emailVal"></div></td>  </tr>	<tr align="left"> <Td id="myDivcc"  class="form_text" ></Td><Td id="myDivcc1"  ></Td>		  </tr>  <tr>    <td height="0" colspan="2"align="center" class="form_text" style="font-size:10px; text-align:left;"><input type="checkbox"  name="accept" style="border:none;" checked tabindex="15" > I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="0" colspan="2" align="center">&nbsp;</td> </tr>  <tr>    <td height="45" colspan="2" align="center"><input type="image" name="Submit" src="images/calculate-now-oct16.png" style="width:123px; height:43px; border:none;" tabindex="16" /></td>    </tr>    </table>';
}
</script>
</head>
<body>
<div class="apl_top_wrapper">
<div class="apl_logo_container"><div class="logo_box_b"><img src="d4limages/aplp_d4l-logo.jpg"  height="44" /></div>
<div class="logo_text">Personal Loans by Choice not by Chance!</div>
<div class="call_us_box">&nbsp;</div>
</div>
</div>
<div class="apl_second_container" style="padding-top:3px;">
 <div class="column_wrapper">
  <div class="column_b" >
  <div class="personal_loan" style="font-size:20px;" >Personal Loan Balance Transfer Request</div>
  <div id="example-two">
		<ul class="nav">
			<li ><a href="#fillform" class="current">Get Quote</a></li>
			
		</ul>
		<div class="list-wrap">
		<div id="fillform" style="height:auto;">	
<form name="personalloan_form" action="insert_personal_loanbt_value.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="source" value="<? echo $retrivesource; ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="personal_text">Professional Details</td>
  </tr>
  <tr>
    <td width="209" height="45" class="form_text">Outstanding Loan Amount</td>
    <td width="291" height="30"><input  name="ExistingLoan_Amount" class="input"  id="ExistingLoan_Amount"  tabindex="1" onFocus="this.select();" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDigitToWords('ExistingLoan_Amount', 'formatedlA','wordloanAmount');" onKeyDown="getDigitToWords('ExistingLoan_Amount','formatedlA','wordloanAmount'); validateDiv('loanVal');"  onKeyUp="intOnly(this); getDigitToWords('ExistingLoan_Amount','formatedlA','wordloanAmount');" /><div id="loanVal"  class="alert_msg"></div></td>
  </tr>
    <tr>
      <td></td><td><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#000; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#000; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
  <tr>
    <td colspan="2" ></td>
    <tr>
    <td height="45" class="form_text">Current Rate of Interest</td>
    <td>
      <input type="text" name="Existing_Rate" id="Existing_Rate" class="input" onKeyDown="validateDiv('ExistingRateVal');"><div id="ExistingRateVal"></div></td>
    <tr>
      <td colspan="2"></td>
      <tr>
      <td height="45" class="form_text">Existing Bank</td>
      <td>
	    <select name="Existing_Bank" id="Existing_Bank" class="select" onChange="validateDiv('ExistingBankVal');">
		<option value="">Please Select</option>
		 <option value="Axis Bank">Axis Bank</option>
		  <option value="Bajaj Finserv">Bajaj Finserv</option>
		  <option value="Citibank">Citibank</option>
		   <option value="Fullerton India">Fullerton India</option>
        <option value="HDFC Bank">HDFC Bank</option>
        <option value="ICICI Bank">ICICI Bank</option>
		<option value="INDUS IND bank">INDUS IND bank</option>
        <option value="Kotak Bank">Kotak Bank</option>
		<option value="Standard Chartered">Standard Chartered</option>
		<option value="Tata Capital">Tata Capital</option>       
        <option value="Other">Other</option>
       </select><div id="ExistingBankVal"></div></td>
  </tr>
   <tr>
      <td height="45" class="form_text">No of EMI's Paid ?</td>
      <td>
	    <select name="Existing_EMI" id="Existing_EMI" class="select" onChange="validateDiv('ExistingEmiVal');">
		<option value="">Please Select</option>
		<? for($i=0; $i<=12;$i++)
		{ ?>
			<option value="<? echo $i; ?>"><? echo $i; ?></option>
		<? } ?>
		<option value="13">above 12</option>
		</select><div id="ExistingEmiVal"></div></td>
  </tr>
  <tr>
    <td height="45" class="form_text">Occupation</td>
    <td height="30"><select  name="Employment_Status" class="select" id="Employment_Status" onChange="chgtxtsal(); addcmp_nme(); validateDiv('empStatusVal');" tabindex="2">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusVal" class="alert_msg"></div>
              </td>
  </tr>
    <tr align="left">
  <td id="myCmpDiv" class="form_text"></td><td id="myCmpDiv1"></td>
</tr>	
<tr align="left">
  <td id="myanualtDiv" class="form_text" ></td><td id="myanualtDiv1"></td>
</tr>
  <tr>
    <td height="45" class="form_text"><div id="chgtxt">Annual Income</div></td>
    <td><input name="IncomeAmount" class="input" id="IncomeAmount"  tabindex="4" onFocus="this.select();" onBlur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyDown="validateDiv('netSalaryVal');"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"/><div id="netSalaryVal" class="alert_msg"></div> </td>
  </tr>
   <tr><td></td><td><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#000; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#000; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
  <tr>
    <td height="44" class="form_text">City</td>
	<td><select  name="City" class="select" id="City"  tabindex="5" onChange=" addPersonalDetails(); validateDiv('cityVal');" ><option value="Select Your City">Select your City</option><option value="Ahmedabad">Ahmedabad</option><option value="Alwar">Alwar</option><option value="Asansol">Asansol</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Bankura">Bankura</option><option value="Baroda">Baroda</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Patiala">Patiala</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Others">Others</option></select><div id="cityVal" class="alert_msg"></div> </td>
  </tr>
  <tr>
    <td align="left" class="form_text" id="othCitDiv"></td>
    <td id="othCitvalDiv"></td>
  </tr>
   <tr>
    <td height="34" colspan="2" class="form_text"  id="personalDetails"><table align="center" width="100%"><tr><td align="center"><img src="images/calculate-now-oct16.png"  width="123" height="43"/></td></tr></table></td>
  </tr>
  <tr>
    <td height="20" colspan="2" align="center" class="form_text">&nbsp;</td>
  </tr>
</table>
		  </form>
		</div>
		
	  </div> <!-- END List Wrap -->
	</div>
   </div> 
 <div style="clear:both;"></div>
   <div style="clear:both;"></div>
   <div class="step" style="margin-top:10px;"></div>
   <div class="rewards" style="margin-top:10px;"></div>
    </div>
   <div class="column_a">
  <div class="banks_text"> List of top Personal Loans Banks in India</div>
 <div class="apl_radius">
 <div class="menu_display"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td align="center" style="color:#083b65; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">ICICI Bank</td>
    <td align="center" style=" color:#041d6f; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">HDFC Bank</td>
  </tr>
  <tr>
    <td align="center" style=" color:#00003d; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;"> ING Vysya</td>
    <td align="center" style="color:#ed1c24; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;">Kotak</td>
  </tr>
    <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
    <td align="center" style="color:#cd5a13; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Fullerton</td>
    <td align="center" style="color:#0076bc; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;"> Bajaj Finserv</td>
    <td align="center" style="color:#0076bc; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">SBI</td>
  </tr>
  </table></td></tr>
</table>
</div>
 <div class="bank_text" id="menu_display_b">
 <ul><li style="color:#083b65;">
 ICICI Bank</li>
 <li style=" color:#041d6f;">
 HDFC Bank</li>
 <li style=" color:#00003d;">
 ING Vysya</li>
 <li style="color:#ed1c24;">
 Kotak</li>
   <li style="color:#cd5a13;">
 Fullerton </li>
    <li style="color:#0076bc;">
 Bajaj Finserv </li>
   <li style="color:#0076bc; text-align:center !important; line-height:none; border:none;">
 SBI </li>
 </ul>
 </div>
 </div>
  <div class="table_bg">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td width="93%" valign="middle" class="text_white"  style="height:28px; background:url(d4limages/aplp_arrow-new-green.png) no-repeat;">Sample Personal Loan Quotes</td>
       <td width="7%" align="left" style="height:28px;">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:thin solid #FFF;">
         <tr>
           <td width="15%" height="25" align="center" bgcolor="#1055e1" class="text_white_b" style="border-right: #FFF thin solid;">Bank </td>
           <td width="21%" align="center" bgcolor="#1055e1" class="text_white_b" style="border-right:thin solid #FFF;">Loan Amount</td>
           <td width="24%" align="center" bgcolor="#1055e1" class="text_white_b" style="border-right:thin solid #FFF;">Existing Interest Rate</td>
           <td width="19%" align="center" bgcolor="#1055e1" class="text_white_b" style="border-right:thin solid #FFF;">New Rate</td>
           <td width="21%" align="center" bgcolor="#1055e1" class="text_white_b">Saving</td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="15%" align="center" bgcolor="#FFFFFF" class="text_white_c">Bank A<br>
             Bank B<br>
             Bank C<br>
             Bank D</td>
           <td width="19%" align="center" bgcolor="#FFFFFF" class="text_white_c">2,00000<br>
             4,00000<br>
             8,00000<br>
             20,00000</td>
           <td width="26%" align="center" bgcolor="#FFFFFF" class="text_white_c">20%<br>
             18%<br>
             16%<br>
             14%</td>
           <td width="19%" align="center" bgcolor="#FFFFFF" class="text_white_c">13.75%<br>
             13.49%<br>
             13.25%<br>
             11.49</td>
           <td width="21%" align="center" bgcolor="#FFFFFF" class="text_white_c">22372<br>
             31996
             <br>
             38665<br>
             86859</td>
         </tr>
         </table></td>
     </tr>
   </table>
   <div style="clear:both;"></div>
   <div class="row_b"><span class="text_white_b" style="font-size:12px;"><strong>Personal Loan</strong> quotes taken this month from <strong>Deal4loans</strong></span>
     <div class="count_wrap"><table width="100" border="0" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#FFFFFF" class="text_d">5</td>
    <td bgcolor="#FFFFFF" class="text_d">9</td>
    <td bgcolor="#FFFFFF" class="text_d">9</td>
    <td bgcolor="#FFFFFF" class="text_d">0</td>
    <td bgcolor="#FFFFFF" class="text_d">5</td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>
<div class="row_b" style="margin-top:5px;"><span class="text_white_b" style="font-size:12px;">Loans quotes taken from <strong>Deal4loans </strong></span>
  <div class="count_wrap_b"><table width="130" border="0" align="right" cellpadding="0" cellspacing="2">
  <?php 
$total_amtcntr="select Amount From totalLoans Where (Name='Totalcountr' and flag=1)";
list($getRatesNumRows,$ArrRow)=Mainselectfunc($total_amtcntr,$array = array());

$ttl_countrtaken = $ArrRow['Amount'];
 ?>
  <tr>
<? 
$number=$ttl_countrtaken;
$revarrnumber=str_split($number);
$contstr=count($revarrnumber);
for($i=0; $i<$contstr; $i++)
{ ?>
<td bgcolor="#FFFFFF" class="text_d"><? echo $revarrnumber[$i]; ?></td>
<? } ?>
  </tr>
</table>
</div>

</div>
<div style="clear:both;"></div>
</div>
      
 </div>
 
 <div class="why_text_box">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td class="text_head" style="font-size:20px;">Why Deal4loans.com - Widest Choice of Banks</td>
     </tr>
     <tr>
       <td class="body_apl_text" style="color:#454646;"><ul>
         <li><strong style="color:#454646;">Get free instant quote</strong> on Rates, Emi, Eligibility, <span style="font-size:17px; font-weight:bold;">Fees</span> &amp; Documents from all Banks.</li>
         <li>Pick best Bank as per your requirement.</li>
         <li><span style="font-size:17px; font-weight:bold;">3 </span>Banks Personal loan balance Rate as low as <span style="font-size:17px; font-weight:bold;">11.49%</span>.</li>
         </ul></td>
     </tr>
   </table>
 </div>
 
 
  </div>
  <div style="clear:both;"></div>
  
  
</div>


 <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
 <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script></body>
</html>
