<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-65;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource="HL Site Page";
}
else
{
	$retrivesource="HL Site Page";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Home Loan apply : Apply for home loans Online and get quotes from all home loan provider of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad, Pune etc.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/script2.js"></script>
<script language="javascript">
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

function cityother()
{
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
	}
} 
function Trim(strValue) 
{	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function containsdigit(param)
{mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}

function chkform()
{		
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var j;
	var cnt=-1;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.loan_form.Name.value=="")
	{
       	document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}
	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.loan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
   }

	if(document.loan_form.day.value=="" || document.loan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
		if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.loan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
		if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.loan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.loan_form.year.focus();
		return false;
	}
	if(document.loan_form.year.value!="")
	{
		if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -65!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	if(document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.loan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }
	if(document.loan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	if (document.loan_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.loan_form.Pincode.focus();
			return false;
		}
	}
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		alert("Select Property identified or not!");	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.loan_form.Property_Loc.selectedIndex==0)
		{
			document.getElementById('propEditifiedVal').innerHTML = "<span class='hintanchor'>Select Property Location!</span>";	
			document.loan_form.Property_Loc.focus();
			return false;
		}
	}
	if(!document.loan_form.accept.checked)
	{
		alert("Read and Accept Terms & Conditions!");
		document.loan_form.accept.focus();
		return false;
	}
}  

function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{
				eval(document.getElementById("divfaq"+j)).style.display=''
			}
			else
			{
				eval(document.getElementById("divfaq"+j)).style.display='none'
			}
		}	
	}
}

function addIdentified()
{
	//alert("Hi");
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '<div class="new-input-box" style="margin-left:0px;"><div class="formhlwpbody-text">Property Location</div>    <div class="text" style=" float:left; height:auto; margin-top:5px; width:100%;"><select name="Property_loc" id="Property_loc" class="d4l-select"><?=getCityList1($City)?></select></div><div id="vintageVal"></div></div>';
	var cfdiv = document.getElementById('commonfloorlogo');
	//alert(cfdiv);
	cfdiv.innerHTML='';
	return true;	
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';
	return true;
}	
function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
function commomfloor()
{
	var cfcount = document.getElementById('Cfcount').value;
	var cfdiv = document.getElementById('commonfloorlogo');

	if(cfcount<=500)
	{
		var cit = document.loan_form.City.value;
		var prpval = document.loan_form.property_value.value;
		
		if((cit=="Delhi" || cit=="Mumbai" || cit=="Gurgaon" || cit=="Noida" || cit=="Gaziabad" || cit=="Thane" || cit=="Navi Munmbai" || cit=="Faridabad") && prpval>=2000000)
		{
			cfdiv.innerHTML='<table width="100%">  <tr><td><label>                <input type="checkbox" name="cf_campaign" id="cf_campaign" value="1"/>                </label>              I would like to get property options from commonfloor.com </td><td><img src="images/commonfloor-logo.jpg" width="72" height="32" border="0" /></td></tr></table>';
		}
		else
			cfdiv.innerHTML='';
	}
}

</script>
</head>
<body>
<?php include"middle-menu.php"; ?>
<div class="hl_inner_wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Home Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="hl-form-wrapper">
<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2">
     <div class="headtextedubox"> <h1 style="color:#000; font-size:16px">Apply Home Loan</h1></div>
   <div class="apply-edu-button">     <a href="home-loan-balance-transfer-calculator.php"><img src="images/apply_a-new.png" width="166" height="38" style="max-height:50%;" border="0" /></a></div></td>
    </tr>  
  <tr>
    <td colspan="2"><img src="images/home-loan-quotes-animated.gif" style="width:100%; max-width:574px;  margin-bottom:7px;" height="23"></td>
    </tr>
  </table>
<form name="loan_form" method="post" action="apply-home-loanscontinue1.php" onSubmit="return chkform();">
<input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="Hl_testpage_1july">
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Full Name:</td>
        </tr>
        <tr>
          <td>
          <input name="Name" id="Name" type="text" class="d4l-input" onkeydown="validateDiv('nameVal');"  tabindex="1" autocomplete="off"/>
          <div id="nameVal"></div>
          </td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">City:</td>
        </tr>
        <tr>
          <td><select name="City" id="City" class="d4l-select"  onchange="validateDiv('cityVal'); cityother();" tabindex="2">
              <?=plgetCityList($City)?>
              <option value="Vapi">Vapi</option>
              <option value="Ankleshwar">Ankleshwar</option>
              <option value="Anand">Anand</option>
              <option value="Anand">Dahod</option>
              <option value="Anand">Navsari</option>
            </select>
            <div id="cityVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Pincode:</td>
        </tr>
        <tr>
          <td><input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" class="d4l-input" tabindex="3"  autocomplete="off" />
            <div id="pincodeVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Loan Amount:</td>
        </tr>
        <tr>
          <td>
          <input name="Loan_Amount" id="Loan_Amount"  maxlength="10" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="d4l-input" onkeydown="validateDiv('loanAmtVal');" tabindex="4"  autocomplete="off" />
          <div id="loanAmtVal"></div>
          <span id='formatedlA'></span>
		  <span id='wordloanAmount'></span>  
          </td>
        </tr>
      </table>
    </div>
    <div style="clear:both; height:15px;"></div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">DOB:</td>
        </tr>
        <tr>
          <td><input name="day" id="day" type="text" value="dd" class="emi_dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');"  tabindex="5"  autocomplete="off" />
            <input name="month" id="month" type="text" value="mm" class="emi_dd" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="6"  autocomplete="off" />
            <input name="year" id="year" type="text" class="emi_yy" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="7"  autocomplete="off" />
            <div id="dobVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Other City:</td>
        </tr>
        <tr>
          <td><input name="City_Other" id="City_Other" type="text" class="d4l-input" disabled onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');" tabindex="8"  autocomplete="off" />
            <div id="othercityVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Occupation: </td>
        </tr>
        <tr>
          <td><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');" class="d4l-select" tabindex="9">
              <option value="-1">Please Select</option>
              <option value="1">Salaried</option>
              <option value="0">Self Employment</option>
            </select>
            <div id="empStatusVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Property Value:</td>
        </tr>
        <tr>
          <td><input  name="property_value"  id="property_value" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="d4l-input" onkeydown="validateDiv('propertyValueVal');" tabindex="10"  autocomplete="off" />
            <div id="propertyValueVal"></div></td>
        </tr>
      </table>
    </div>
    <div style="clear:both; height:15px;"></div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Mobile:</td>
        </tr>
        <tr>
          <td><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-input" onkeydown="validateDiv('phoneVal');"  tabindex="11"  autocomplete="off" />
            <div id="phoneVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Email ID :</td>
        </tr>
        <tr>
          <td><input name="Email" id="Email" type="text" class="d4l-input" onkeydown="validateDiv('emailVal');"  tabindex="12"  autocomplete="off"/>
            <div id="emailVal"></div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" class="formhlwpbody-text">Gross Annual Salary:</td>
        </tr>
        <tr>
          <td>
          <input type="text" name="Net_Salary" id="Net_Salary" class="d4l-input" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"   tabindex="13"  autocomplete="off"/>
          <div id="netSalaryVal"></div>
          <span id='formatedIncome'></span>
		  <span id='wordIncome'></span>
          </td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="31%" class="formhlwpbody-text">Property Identified:</td>
          <td width="69%" class="formhlwpbody-text">
          <input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="return addIdentified();" style="border:none;" />
            Yes
		  <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();commomfloor();" value="0" style="border:none;"  />
			No
          </td>
        </tr>
        <tr>
          <td colspan="2"><div id="propEditifiedVal"></div></td>
        </tr>
        <tr>
          <td colspan="2"><div id="myDiv1"></div></td>
        </tr>
      </table>
    </div>
    <div style="clear:both; height:15px;"></div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="formhlwpbody-text">Total Monthly EMI for all running loans : </td>
        </tr>
      </table>
    </div>
    <div class="new-input-box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><input  name="obligations" id="obligations" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="d4l-input" tabindex="15"  autocomplete="off" /></td>
        </tr>
      </table>
    </div>
    <div style="clear:both; height:15px;"></div>
    <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
         <td colspan="5" align="left" valign="top">
	<div style="display:none;" id="divfaq1">
    <div>
    <div class="new-input-box" style="margin-left:5px;">
    <table width="100%" border="0" cellspacing="2">
      <tr>
        <td class="formhlwpbody-text"> Co-applicant Name:</td>
      </tr>
      <tr>
        <td><input name="co_name" id="co_name" type="text" class="d4l-input" /> </td>
      </tr>
    </table>
  </div>
  <div style="float:left; margin-left:0px; margin-top:0px;">
    <div class="new-input-box">
    <table width="100%" border="0" cellspacing="2">
  <tr>
    <td class="formhlwpbody-text">Co-applicant DOB:</td>
  </tr>
  <tr>
    <td>
    <input name="co_day" id="co_day" type="text" class="emi_dd" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"/>
    <input name="co_month" id="co_month" type="text" class="emi_dd" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
    <input name="co_year" id="co_year" type="text" class="emi_yy" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
    <div id="co_dobVal"></div>  
    </td>
  </tr>
</table>
    </div>
    <div class="new-input-box">
        <table width="100%" border="0" cellspacing="2">
  <tr>
    <td class="formhlwpbody-text">Net Monthly Income:</td>
  </tr>
  <tr>
    <td> <input type="text" name="co_monthly_income" id="co_monthly_income" class="d4l-input" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" />
    <div id="co_incomeVal"></div>   </td>
  </tr>
</table>
     </div>
  </div>
  <div class="new-input-box">
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td class="formhlwpbody-text">  Monthly EMIs :</td>
  </tr>
  <tr>
    <td><input name="co_obligations" id="co_obligations" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this);" type="text" class="d4l-input" /></td>
  </tr>
</table>
    </div>
    <div style="clear:both; height:15px;"></div>
</div>
</div>  	

<!-- End-->       </td>
       </tr>
      <tr>
        <td class="formhlwpbody-text"><div class="coapplicant-bx"> <input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" >
         Co - applicant</div>
            <div class="coapplicant-bx"> <input name="accept" type="checkbox" id="accept" checked="checked" />
            I authorize Deal4loans.com &amp; its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow" style="color:#06C; text-decoration:underline;">partnering banks</a> to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#06C; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#06C; text-decoration:underline;"> Terms and Conditions</a>.
          <div id="acceptVal"></div>
                  </div>          
            <div class="commonfloorlogo" id="commonfloorlogo">
            
            </div>
          <div class="Hl-Quote-Btn">  <input type="submit" class="hl-get-quotebtn" value="Get Quote" /></div></td>
        </tr>
      <tr>
        <td><div id="hdfclife"></div></td>
      </tr>
    </table>
    <div style="clear:both; height:15px;"></div></form>
  </div>
  
    <br />
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td valign="top"><h2 style="margin:auto; font-size:16px; font-weight:bold;">Maximum Home loan Bank Tie ups in online space</h2>
          <br /></td>
      </tr>
    </table>
    <div class="overflow-width">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_bgcolor_Border">
        <tr>
          <td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
              <tr class="table_bgcolor">
                <td width="82" height="43" align="center" valign="middle" ><strong>Banks</strong></td>
                <td width="184" height="43" align="center" valign="middle"><strong>ICICI Bank</strong></td>
                <td width="153" height="43" align="center" valign="middle"><strong>HDFC Ltd</strong></td>
                <td width="166" height="43" align="center" valign="middle"><strong>HSBC Bank</strong></td>
                <td width="124" align="center" valign="middle"><strong>PNB Housing Finance</strong></td>
                <td width="133" height="43" align="center" valign="middle"><strong>Axis Bank</strong></td>
                <td width="120" height="43" align="center" valign="middle"><strong>Citibank</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="57" align="center" valign="middle"><b>Rate of Interest</b></td>
                <td height="57" align="center" valign="middle" >9.85% - 9.90%</td>
                <td height="57" align="center" valign="middle" >9.90% - 10.40%</td>
                <td height="57" align="center" valign="middle" >
                9.95% - 10.15%(for Salaried)<br />
            	10.10% - 10.30% (for SelfEmployed)
                </td>
                <td align="center" valign="middle">9.95% - 10.50%</td>
                <td height="57" align="center" valign="middle">9.85% - 10.35% </td>
                <td height="57" align="center" valign="middle">Scheme I: 10.25%*(without Home Credit facility)<br />
                  Scheme II: 10.50%*(with Home Credit facility)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="83" align="center" valign="middle"><b>Processing Fee</b></td>
                <td height="83" align="center" valign="middle">0.50%</td>
                <td height="83" align="center" valign="middle">0.5% plus applicable service tax and cess</td>
                <td height="83" align="center" valign="middle">1% of the loan amount applied for, subject to a minimum of <img src="/new-images/rupees.gif" />10000 plus service tax. This fee is payable on application & is not refundable</td>
                <td align="center" valign="middle">0.5%</td>
                <td height="83" align="center" valign="middle">0.5% of the loan amount<br>
                  (Max. 10000/- + service tax for Salaried) </td>
                <td height="83" align="center" valign="middle">upto 1% of loan amount</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="70" align="center" valign="middle"><b>Loan Amount</b></td>
                <td height="57" align="center" valign="middle">Rs.8,00,000 - Maximum <br />
                  80% of the Cost of the Property <br />
                  (Subject to Income Eligibility)</td>
                <td height="57" align="center" valign="middle">80% of the Cost of the Property<br />
                  (Subject to Income Eligibility)</td>
                <td height="57" align="center" valign="middle">Maximum upto <img src="/new-images/rupees.gif" />10 crores <br />
                  (Subject to Income Eligibility)</td>
                <td align="center" valign="middle">Loans upto 80% of the property value.</td>
                <td height="57" align="center" valign="middle">Rs.1,00,000 - Rs.2,00,00,000</td>
                <td height="57" align="center" valign="middle">Rs.5,00,000 - Rs.10,00,00,000</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="57" align="center" valign="middle"><b>Prepayment Charges</b></td>
                <td height="57" align="center" valign="middle">No prepayment charge on floating rate home loan 
                  For one year, two year and three year fixed rate loan the prepayment charge is 2% of the outstanding loan amount plus applicable service tax and surcharge till the time loan is under fixed rate</td>
                <td height="57" align="center" valign="middle">No prepayment charges shall be payable for partial or full prepayments irrespective of the source</td>
                <td height="57" align="center" valign="middle">NIL </td>
                <td align="center" valign="middle">NIL</td>
                <td height="57" align="center" valign="middle">NIL</td>
                <td height="57" align="center" valign="middle">NIL</td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
  
  <div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
  <!--partners-->
  <div style="margin:auto; width:100%; margin-top:25px;"><strong>Loan Partners</strong></div>
  <div style="margin:auto; width:100%;  margin-top:20px;">
  
  <table width="100%">
      <tr>
        <td><div class="apply-hl-bank-logo"> <img src="/new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"><img src="/new-images/fedbank-nw.jpg" alt="Fedbank" width="130" height="38"  style="border:none;"/> </div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/pnbhfl-logo1.jpg" alt="Fedbank"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"><img src="/new-images/citibank-logo-d4l-home.jpg" alt="Citibank" width="145" height="38"  style="border:none;"/> </div>
        </td>
      </tr>
    </table>
    <div style="clear:both; height:50px;"></div>
  </div>
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>