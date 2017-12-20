<?php
 require 'scripts/functions.php';

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="Fullerton LP";
}
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Get Personal Loan Upto 20 lac - Fullerton</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/fullerton-landing-page-styles.css" type="text/css" rel="stylesheet" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style type="text/css">
	/* Big box with list of options */
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
	.hintanchor{
	font-family: Verdana,Geneva,sans-serif;
	color:#f32323;
	font-size:12px;
	}
</style>
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

function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
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
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
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
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
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
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('CityOtherVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('CityOtherVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }		
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
	 if (document.loan_form.Employment_Status.value==0)
	{
	if (document.loan_form.Annual_Turnover.selectedIndex==0)
	{
		document.getElementById('annualTurnoverVal').innerHTML = "<span  class='hintanchor'>Select Annual Turnover to Continue!</span>";	
		document.loan_form.Annual_Turnover.focus();
		return false;
	}
	}
 if(document.loan_form.Employment_Status.value==1)
	{
	if((document.loan_form.Company_Name.value=="") || (document.loan_form.Company_Name.value=="Type slowly to autofill")|| (Trim(document.loan_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.loan_form.Company_Name.focus();
		return false;
	}
	else if(document.loan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.loan_form.Company_Name.focus();
		return false;
	}
	}
	if (document.loan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.IncomeAmount, 'Annual Income',0))
		return false;

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;

	var myOption = -1;
		for (i=document.loan_form.CC_Holder.length-1; i > -1; i--) {
			if(document.loan_form.CC_Holder[i].checked) {
				if(i==0)
				{
					if (document.loan_form.Card_Vintage.selectedIndex==0)
					{
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
						document.loan_form.Card_Vintage.focus();
						return false;
					}
				}
					myOption = i;
				}
		}
		if (myOption == -1) 
		{
			document.getElementById('ccholderVal').innerHTML = "<span  class='hintanchor'>Credit Card holder or not!</span>";	
			return false;
		}
	var myOption1 = -1;
		for (j=document.loan_form.LoanAny.length-1; j > -1; j--) {
			if(document.loan_form.LoanAny[j].checked) {
				if(j==0)
				{
					if (document.loan_form.EMI_Paid.selectedIndex==0)
					{
						document.getElementById('emipaidVal').innerHTML = "<span  class='hintanchor'>How many EMI paid!</span>";	
						document.loan_form.EMI_Paid.focus();
						return false;
					}
				}
					myOption1 = j;
				}
		}
		if (myOption1 == -1) 
		{
			document.getElementById('loananyVal').innerHTML = "<span  class='hintanchor'>Any Loan Running or not!</span>";	
			return false;
		}
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.loan_form.accept.focus();
		return false;
	}
} 

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function change_empstst()
{
	var occpdiv = document.getElementById('chnge_empstst');
	var occupation = document.loan_form.Employment_Status.value;
	if(occupation==0)
	{
	occpdiv.innerHTML = '<table border="0" width="100%"><tr> <td height="40" class="text-fluttern-form" width="27%">Annual Turnover </td>      <td width="73%" colspan="2"><select name="Annual_Turnover" id="Annual_Turnover" class="select" tabindex="9">		<option value="">Please Select</option>	<option value="1" > 0 To 40 Lacs</option>	<option value="4" > 40 Lacs To 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select><div id="annualTurnoverVal"></div></td></tr></table>';
	}
	else
	{
	occpdiv.innerHTML = '<table border="0" width="100%"><tr> <td height="40" class="text-fluttern-form" width="27%">Company Name </td>      <td width="73%" colspan="2"><input name="Company_Name" type="text" class="input" id="Company_Name" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onfocus="onFocusBlank(this,\'Type slowly to autofill\');" onkeydown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill" tabindex="9"><div id="companyNameVal"></div></td></tr></table>';
				}		
}
function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '<table border="0" width="100%"><tr> <td height="40" class="text-fluttern-form" width="27%">Card Vintage</td>      <td width="73%" colspan="2"><select name="Card_Vintage"  onchange="validateDiv(\'vintageVal\');" class="select" tabindex="14"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select><div id="vintageVal"></div></td></tr></table>';
	return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';
	return true;
}	

function othercity()
{
	var niOC = document.getElementById('othercity');
	var citychk = document.loan_form.City.value;
	if(citychk=="Others")
	{
niOC.innerHTML='<table width="100%"> <tr>      <td width="28%" height="40" class="text-fluttern-form">Other City</td>      <td colspan="2">        <input name="City_Other" type="text" class="input" id="City_Other" onkeydown="validateDiv(\'CityOtherVal\');" tabindex="8"> <div id="CityOtherVal"></div> </td>    </tr>	</table>';
	}
}
function emitenure()
{
	var niET = document.getElementById('emitenure');
	niET.innerHTML='<table border="0" width="100%"><tr> <td height="40" class="text-fluttern-form" width="27%">How many EMI paid?</td>      <td width="73%" colspan="2"><select class="select" name="EMI_Paid" id="EMI_Paid" onChange="validateDiv(\'emipaidVal\');"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div id="emipaidVal"></div></td></tr></table>';
}
function removeElementLoan()
{
	var niET = document.getElementById('emitenure');
	niET.innerHTML='';
}
</script>
</head>
<body>
<div class="tplining"></div>
<div class="header-main">
<div class="header-in">
<div class="logo"><img src="images/fullertonindia-logo-mailer.jpg" width="127" height="38"></div>
</div>
</div>
<div class="second_wrapper">
<div class="left-box">
<h1>Get Personal Loan Upto 20 lac !! </h1>
<div class="form-box">
<form name="loan_form" action="apply-fullerton-india-loans-continue-test.php" method="POST" onsubmit="return chkpersonalloan(document.loan_form);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="source" value="<? echo $retrivesource; ?>"> 
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="40" colspan="3" valign="middle"><h2>Personal Details </h2></td>
      </tr>
	   <tr>
      <td width="28%" height="40" class="text-fluttern-form">Full Name</td>
      <td colspan="2">
        <input name="Name" type="text" class="input" id="Name" onkeydown="validateDiv('nameVal');" tabindex="1"> <div id="nameVal"></div> </td>
    </tr>
	<tr>    <td height="45" class="form_text">DOB</td>    
	<td colspan="2">
	<input name="day" type="text" class="dd" id="day" tabindex=2  onFocus="onFocusBlank(this,'dd');" onblur="onBlurDefault(this,'dd');" onchange="intOnly(this);" onkeypress="intOnly(this);" onkeyup="intOnly(this);" value="dd" maxlength="2" onkeydown="validateDiv('dobVal');"/> 
	<input name="month" type="text" class="dd" id="month" tabindex=3 onfocus="onFocusBlank(this,'mm');" onblur="onBlurDefault(this,'mm');" onchange="intOnly(this);" onkeypress="intOnly(this);" onkeyup="intOnly(this);" value="mm" maxlength="2" onkeydown="validateDiv('dobVal');" /> 
	<input name="year" type="text" class="yy" id="year" tabindex=4  onFocus="onFocusBlank(this,'yyyy');"   onBlur="onBlurDefault(this,'yyyy');" onchange="intOnly(this); insertData();" onkeypress="intOnly(this);" onkeyup="intOnly(this);" value="yyyy" maxlength="4" onkeydown="validateDiv('dobVal');" /><div id="dobVal"></div></td>  </tr>
    <tr>
      <td height="40" class="text-fluttern-form">Mobile No.</td>
      <td width="7%" class="text-fluttern-form">+91</td>
      <td width="65%"><input name="Phone" type="text" class="mobo" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" onkeydown="validateDiv('phoneVal');" tabindex="5"><div id="phoneVal"></div></td>
    </tr>
    <tr>
      <td height="40" class="text-fluttern-form">Email Id</td>
      <td colspan="2"><input name="Email" type="text" class="input" id="Email" onkeydown="validateDiv('emailVal');" tabindex="6"><div id="emailVal"></div> </td>
    </tr>
    <tr>
      <td height="40" class="text-fluttern-form">City</td>
      <td colspan="2">
       <select name="City" id="City" onchange="othercity(); validateDiv('cityVal');" tabindex="7" class="select">
                            <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
                        </select><div id="cityVal"></div> </td>
    </tr>
	<tr>
	<td colspan="3" id="othercity"></td>
	</tr>
    <tr>
      <td height="10" colspan="3" class="text-fluttern-form">&nbsp;</td>
    </tr>
    <tr>
      <td height="35" colspan="3" class="text-fluttern-form"><h2>Professional Details </h2></td>
      </tr>
    <tr>
      <td height="40" class="text-fluttern-form">Employment Status</td>
      <td colspan="2"><select name="Employment_Status" class="select" id="Employment_Status" onchange="validateDiv('empStatusVal'); change_empstst();" tabindex="8">
         <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employed</option>
      </select> <div id="empStatusVal"></div></td>
    </tr>
    <tr>
	<td colspan="3" width="100%"><div id="chnge_empstst"><table border="0" width="100%"><tr> <td height="40" class="text-fluttern-form" width="27%">Company Name </td>
      <td width="73%" colspan="2"><input name="Company_Name" type="text" class="input" id="Company_Name" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" onfocus="onFocusBlank(this,'Type slowly to autofill');" onkeydown="validateDiv('companyNameVal');" value="Type slowly to autofill" tabindex="9"><div id="companyNameVal"></div></td></tr></table></div></td>
    </tr>
     <tr>
      <td height="40" class="text-fluttern-form">Annual Income </td>
      <td colspan="2"><input name="IncomeAmount" type="text" class="input" id="IncomeAmount" onblur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onchange="intOnly(this);" onkeypress="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onkeydown="validateDiv('netSalaryVal');"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" tabindex="10"><div id="netSalaryVal" class="alert_msg"></div></td>
    </tr>
	<tr><td></td><td colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#202020; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#202020; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
    <tr>
      <td height="40" class="text-fluttern-form">Loan Amount</td>
      <td colspan="2"><input name="Loan_Amount" type="text" class="input" id="Loan_Amount" onblur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" onchange="intOnly(this);" onkeypress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" tabindex="11"><div id="loanAmtVal"  class="alert_msg"></div></td>
    </tr>
   <tr><td></td><td colspan="2"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#202020; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#202020; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
    <tr>
      <td height="40" class="text-fluttern-form">Credit Card Holder </td>
      <td colspan="2" class="text-fluttern-form">
        <input name="CC_Holder" type="radio" id="CC_Holder" value="1" onclick="addIdentified(); validateDiv('ccholderVal');" tabindex="12">
        Yes 
        <input type="radio" name="CC_Holder" id="CC_Holder" value="0" onclick="removeIdentified(); validateDiv('ccholderVal');">
        No<div id="ccholderVal" tabindex="13"></div> </td>
    </tr>
	 <tr>     <td id="myDiv1" colspan="3">
          </td>
</tr>
    <tr>
      <td height="40" class="text-fluttern-form">Existing Loan</td>
      <td colspan="2" class="text-fluttern-form">
        <input name="LoanAny" type="radio" id="LoanAny" onclick="emitenure(); validateDiv('loananyVal');" tabindex="15">
Yes
<input type="radio" name="LoanAny" id="LoanAny" value="0" tabindex="16" onclick="removeElementLoan(); validateDiv('loananyVal');">
No<div id="loananyVal"></div></td>
    </tr>
	<tr><td colspan="3" id="emitenure"></td></tr>	 
<tr><td colspan="3" class="text-fluttern-form" style="font-size:11px;"><input type="checkbox"  name="accept" style="border:none;" checked>I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td></tr>
    <tr>
      <td height="50" colspan="3" align="center" valign="bottom" class="text-fluttern-form">
      <input type="image" name="Submit" src="images/fullerton-get-quote.jpg" style="width:170px; height:39px; border:none;" />
      </td>
      </tr>
  </table>
  </form>
</div>
</div>
<div class="left_panel"><div class="body_headtext">Speak directly with a <br>
    <strong>Priority Relationship Manager</strong><br>
from Fullerton India</div>
<div class="features"><div style="font-size:20px;">Personal Loan Benefits:
</div>
<div class="features-list"> 
<ul>
<li>Borrow upto 20 Lakhs Loan Amount </li>
<li>No Collateral Required</li>
<li> Competitive Interest Rates</li>
<li>Loans available from 12 to 48 months</li>
</ul>
</div>
</div>
</div>
<div style="clear:both;"></div>
<div class="powered-text">Powered by: <span style="color:#0772b2;">Deal4loans.com</span></div>
</div>
<div style="clear:both;"></div>
<div class="bottom"></div>
</body>
</html>