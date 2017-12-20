<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/functions.php';
	require 'scripts/db_init.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Your Personal Loan or Refer a Friend</title>
<link href="css/icici-pl-referral-lp-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-pllist.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

<script Language="JavaScript" Type="text/javascript">
function chkemply_pl(Form)
{
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if((Form.employ_name.value=="") || (Trim(Form.employ_name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		Form.employ_name.focus();
		return false;
	}
	if(Form.employ_name.value!="")
	{
		if(containsdigit(Form.employ_name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'> Name contains numbers!</span>";
			Form.employ_name.focus();
			return false;
		}
	}
   for (var i = 0; i <Form.employ_name.value.length; i++) 
   {
		if (iChars.indexOf(Form.employ_name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			Form.employ_name.focus();
			return false;
		}
  }
  if((Form.employ_id.value=="") || (Trim(Form.employ_id.value))==false)
	{
        document.getElementById('employidVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		Form.employ_id.focus();
		return false;
	}
	if(Form.employ_contact.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		Form.employ_contact.focus();
		return false;
	}
	if(isNaN(Form.employ_contact.value)|| Form.employ_contact.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		Form.employ_contact.focus();
		return false;  
	}
	if (Form.employ_contact.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		Form.employ_contact.focus();
		return false;
	}
	if ((Form.employ_contact.value.charAt(0)!="9") && (Form.employ_contact.value.charAt(0)!="8") && (Form.employ_contact.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		Form.employ_contact.focus();
		return false;
	}
	if(Form.employ_emailid.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		Form.employ_emailid.focus();
		return false;
	}
	
	var str=Form.employ_emailid.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.employ_emailid.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.employ_emailid.focus();
		return false;
	}
	if (Form.employ_city.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		Form.employ_city.focus();
		return false;
	}
	if (Form.employ_pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		Form.employ_pincode.focus();
		return false;
	}
	if (Form.employ_pincode.value!="")
	{
		if(Form.employ_pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			Form.employ_pincode.focus();
			return false;
		}
	}
}

function chkemplyrf_pl(Form)
{
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if((Form.referral_name.value=="") || (Trim(Form.referral_name.value))==false)
	{
        document.getElementById('rfnameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		Form.referral_name.focus();
		return false;
	}
	if(Form.referral_name.value!="")
	{
		if(containsdigit(Form.referral_name.value)==true)
		{
			document.getElementById('rfnameVal').innerHTML = "<span  class='hintanchor'> Name contains numbers!</span>";
			Form.referral_name.focus();
			return false;
		}
	}
   for (var i = 0; i <Form.referral_name.value.length; i++) 
   {
		if (iChars.indexOf(Form.referral_name.value.charAt(i)) != -1) 
		{
			document.getElementById('rfnameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			Form.referral_name.focus();
			return false;
		}
  }
  if((Form.referral_id.value=="") || (Trim(Form.referral_id.value))==false)
	{
        document.getElementById('rfemployidVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		Form.referral_id.focus();
		return false;
	}
	if(Form.referral_contact.value=="")
	{
		document.getElementById('rfphoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		Form.referral_contact.focus();
		return false;
	}
	if(isNaN(Form.referral_contact.value)|| Form.referral_contact.value.indexOf(" ")!=-1)
	{
		document.getElementById('rfphoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		Form.referral_contact.focus();
		return false;  
	}
	if (Form.referral_contact.value.length < 10 )
	{
	  	document.getElementById('rfphoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		Form.referral_contact.focus();
		return false;
	}
	if ((Form.referral_contact.value.charAt(0)!="9") && (Form.referral_contact.value.charAt(0)!="8") && (Form.referral_contact.value.charAt(0)!="7"))
	{
	  	document.getElementById('rfphoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		Form.referral_contact.focus();
		return false;
	}
	if(Form.referral_emailid.value=="")
	{
		document.getElementById('rfemailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		Form.referral_emailid.focus();
		return false;
	}
	
	var str=Form.referral_emailid.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		document.getElementById('rfemailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.referral_emailid.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('rfemailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.referral_emailid.focus();
		return false;
	}
	if (Form.referral_city.selectedIndex==0)
	{
		document.getElementById('rfcityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		Form.referral_city.focus();
		return false;
	}
	if (Form.referral_pincode.value=="")
	{
		document.getElementById('rfpincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		Form.referral_pincode.focus();
		return false;
	}
	if (Form.referral_pincode.value!="")
	{
		if(Form.referral_pincode.value.length < 6)
		{
			document.getElementById('rfpincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			Form.referral_pincode.focus();
			return false;
		}
	}
	if (Form.referral_income.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		Form.referral_income.focus();
		return false;
	}	
	if(!checkNum(Form.referral_income, 'Annual Income',0))
		return false;

if (Form.referral_occupation.selectedIndex==0)
	{
		document.getElementById('occupationVal').innerHTML = "<span  class='hintanchor'>Enter Occupation to Continue!</span>";	
		Form.referral_occupation.focus();
		return false;
	}
	if((Form.referral_company.value=="") || (Form.referral_company.value=="Type slowly to autofill")|| (Trim(Form.referral_company.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		Form.referral_company.focus();
		return false;
	}
	if (Form.referral_loanamount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		Form.referral_loanamount.focus();
		return false;
	}	
	if(!checkNum(Form.referral_loanamount, 'Loan Amount',0))
		return false;
		if(Form.day.value=="" || Form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		Form.day.focus();
		return false;
	}
	if(Form.day.value!="")
	{
		if((Form.day.value<1) || (Form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			Form.day.focus();
			return false;
		}
	}
	if(!checkData(Form.day, 'Day', 2))
		return false;
	
	if(Form.month.value=="" || Form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		Form.month.focus();
		return false;
	}
	if(Form.month.value!="")
	{
		if((Form.month.value<1) || (Form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			Form.month.focus();
			return false;
		}
	}
	if(!checkData(Form.month, 'month', 2))
		return false;

	if(Form.year.value=="" || Form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		Form.year.focus();
		return false;
	}
	if(Form.year.value!="")
	{
		if((Form.year.value < "<?php echo $maxage;?>") || (Form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			Form.year.focus();
			return false;
		}
	}
	if(!checkData(Form.year, 'Year', 4))
		return false;

var myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
								myOption = i;
				}
		}
	
		if (myOption == -1) 
		{
			document.getElementById('ccholderVal').innerHTML = "<span  class='hintanchor'>Credit Card holder or not!</span>";	
			return false;
		}
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

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	ni1.innerHTML = '<table cellpadding="0" cellspacing="0"><tr> <td height="45" colspan="2" align="left" valign="middle" class="other_head_text" style="border-bottom:thin solid #CCC;">Other referral  Details </td> </tr> <tr>     <td height="45" align="left" class="form_text_body" width="60%">Income</td>  <td height="45" class="form_text_body"><input name="referral_income" type="text" class="input_refer" id="referral_income" onKeyUp="intOnly(this); getDigitToWords(\'referral_income\',\'formatedIncome\',\'wordIncome\');" onKeyPress="intOnly(this);"  onblur="getDigitToWords(\'referral_income\',\'formatedIncome\',\'wordIncome\');"  onkeydown="validateDiv(\'netSalaryVal\');"><div id="netSalaryVal" class="alert_msg"></div><span id="formatedIncome" style="font-size:11px;font-weight:normal; font-Family:Verdana;"></span> <span id="wordIncome" style="font-size:11px;font-weight:normal; font-Family:Verdana;text-transform: capitalize;"></span></td>  </tr>  <tr>      <td height="45" align="left" class="form_text_body">Occupation </td>      <td height="45" align="center" class="form_text_body"><select name="referral_occupation" class="select_refer" id="referral_occupation"><option value="-1">Please Select</option>        <option value="1">Salaried</option>                      <option value="2">Self Employed</option></select><div id="occupationVal" class="alert_msg"></div></td>   </tr>  <tr>  <td height="45" align="left" class="form_text_body">Company Name</td>    <td height="45" align="left" class="form_text_body"><input name="referral_company" type="text" class="input_refer" id="referral_company" onBlur="onBlurDefault(this,\'Type slowly to autofill\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onFocus="onFocusBlank(this,\'Type slowly to autofill\');" value="Type slowly to autofill" onKeyDown="validateDiv(\'companyNameVal\');"><div id="companyNameVal" class="alert_msg"></div></td> </tr> <tr>  <td height="45" align="left" class="form_text_body">Loan Amount </td>  <td height="45" align="left" class="form_text_body"><input name="referral_loanamount" type="text" class="input_refer" id="referral_loanamount" onKeyDown="validateDiv(\'loanAmtVal\');"><div id="loanAmtVal" class="alert_msg"></div></td>  </tr>  <tr>  <td height="45" align="left" class="form_text_body">DOB</td>    <td height="45" align="left" class="form_text_body"><input name="day" type="text" class="dd_icici" id="day" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');">     <input name="month" type="text" class="dd_icici" id="month" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');">        <input name="year" type="text" class="dd_icici" id="year" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');"><div id="dobVal"></div></td> </tr>  <tr>      <td height="45" align="left" class="form_text_body">Credit Car Holder</td>  <td height="45" align="left" class="form_text_body">     <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onClick="validateDiv(\'ccholderVal\');">          Yes  <input type="radio" name="CC_Holder" id="CC_Holder" value="2" onClick="validateDiv(\'ccholderVal\');">   No</td> <div id="ccholderVal"></div>   </tr>   <tr>    <td height="45" colspan="2" align="center" valign="top" class="form_text_body"><span class="form_text_body" style="font-size:11px;">Proceed Further to get Refrral’s Personal loan eligiblity details.</span></td>  </tr>   <tr>      <td height="45" colspan="2" align="center" class="form_text_body"> <input type="image" name="Submit" src="images/icici-pl-referral-refer.jpg" style="width:134px; height:32px; border:none;" /></td>    </tr></table>';
}
</script>
<style>
.hintanchor {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #F5FCE1;
    border-color: #7F9D27;
    border-image: none;
    border-style: solid;
    border-width: 1px 3px 3px 1px;
    color: #FF3333;
    font: 11px/18px Verdana;
    padding: 3px;
    position: absolute;
    width: 175px;
    z-index: 100;
}
.alert_msg{color:#FF0000; font-weight:bold; font-size:10px;}
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

</style>
</head>
<body>
<div id="icici_pl-header">
<div class="icici_pl-header_inn">
<div class="logo"><img src="images/icici_logo_refer.png" width="176" height="36"></div>
<div style="clear:both;"></div>
<div class="text_head_box">Exclusive offer for ICICI Bank employees </div>

</div>
</div>
<div class="banner-icici-refer">
<div class="banner_text_bx">
<div class="text_head_banner">Apply for a Personal Loan or Refer a Friend <br>
  & </div>
  <div class="text_subhead_banner">indulge yourself with goodies designed just for you * </div>
</div>
<div class="right_img_box"><img src="images/icici-pl-referral-pig_bank.png" width="141" height="171"></div>
</div>
<div class="second_container">
<div class="left_form">
<div class="left_bg_tp">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="45" align="center" valign="middle">Apply for yourself</td>
    </tr>
  </table>
</div>
<div class="icici_input_details">
<form name="icici_employee" action="/icici-personal-loan-referral-continue.php" method="post" onSubmit="return chkemply_pl(document.icici_employee);">
<input type="hidden" name="lead_type" id="lead_type" value="employee">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" height="5" style="border-top:thin solid #CCC;"></td>
    </tr>
    <tr>
      <td width="45%" height="45" class="form_text_body">Employee Name </td>
      <td width="56%">
        <input name="employ_name" type="text" class="input_refer" id="employ_name" onKeyDown="validateDiv('nameVal');"><div id="nameVal" class="alert_msg"></div>
     </td>
    </tr>
    <tr>
      <td width="45%" height="45" class="form_text_body">Employee Id </td>
      <td><input name="employ_id" type="text" class="input_refer" id="employ_id" onKeyDown="validateDiv('employidVal');"><div id="employidVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td width="45%" height="45" class="form_text_body">Employee Contact No.</td>
      <td class="form_text_body">+91
        <input name="employ_contact" type="text" class="mobile_refer" id="employ_contact" onKeyDown="validateDiv('phoneVal');" maxlength="10"><div id="phoneVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td width="45%" height="45" class="form_text_body">Employee Email Id</td>
      <td><input name="employ_emailid" type="text" class="input_refer" id="employ_emailid" onKeyDown="validateDiv('emailVal');"><div id="emailVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td width="45%" height="45" class="form_text_body">Employee City </td>
      <td>
        <select name="employ_city" class="select_refer" id="employ_city" onChange="validateDiv('cityVal');">
        <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
        </select>
        <div id="cityVal" class="alert_msg"></div>
     </td>
    </tr>
    <tr>
      <td width="45%" height="45" class="form_text_body">Pin Code</td>
      <td><input name="employ_pincode" type="text" class="input_refer" id="employ_pincode" maxlength="6" onKeyDown="validateDiv('pincodeVal');"><div id="pincodeVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td width="45%" height="45" class="form_text_body">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td height="45" colspan="2" align="center" class="form_text_body">
      <input type="image" name="Submit" src="images/icici-pl-referral-apply_btn.jpg" style="width:134px; height:32px; border:none;" />
    </td>
      </tr>
       <tr>
      <td width="45%" height="45" class="form_text_body">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </form>
  
</div>
</div>
<div class="shadow_line"></div>
<div class="left_form">
<div class="left_bg_tp">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="45" align="center" valign="middle">Refer a friend</td>
    </tr>
  </table>
</div>
<div class="icici_input_details">
<form name="icici_referral" action="/icici-personal-loan-referral-continue.php" method="post" onSubmit="return chkemplyrf_pl(document.icici_referral);">
<input type="hidden" name="lead_type" id="lead_type" value="employee_referral">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" height="5" style="border-top:thin solid #CCC;"></td>
    </tr>
    <tr>
      <td width="45%" height="45" class="form_text_body">Employee Id</td>
      <td width="55%">
           <input name="referral_id" type="text" class="input_refer" id="referral_id" onKeyDown="validateDiv('rfemployidVal');"><div id="rfemployidVal" class="alert_msg"></div>
     </td>
    </tr>
    <tr>
      <td height="45" class="form_text_body">Referral Name </td>
      <td><input name="referral_name" type="text" class="input_refer" id="referral_name" onKeyDown="validateDiv('rfnameVal');"><div id="rfnameVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="45" class="form_text_body">Referral  Contact </td>
      <td class="form_text_body">+91
        <input name="referral_contact" type="text" class="mobile_refer" id="referral_contact" maxlength="10" onKeyDown="validateDiv('rfphoneVal');"><div id="rfphoneVal" class="alert_msg"></div></td>
    </tr>
    
    <tr>
      <td height="45" class="form_text_body">Referral Email Id</td>
      <td><input name="referral_emailid" type="text" class="input_refer" id="referral_emailid" onKeyDown="validateDiv('rfemailVal');"><div id="rfemailVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="45" class="form_text_body">Referral City </td>
      <td> <select name="referral_city" class="select_refer" id="referral_city" onChange="addPersonalDetails(); validateDiv('rfcityVal');">
        <?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>
        </select><div id="rfcityVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td height="45" class="form_text_body">Pin Code</td>
      <td><input name="referral_pincode" type="text" class="input_refer" id="referral_pincode" maxlength="6" onKeyDown="validateDiv('rfpincodeVal');"><div id="rfpincodeVal" class="alert_msg"></div></td>
    </tr>
    <tr><td colspan="2" id="personalDetails"><table align="center"><tr><td><img src="images/icici-pl-referral-refer.jpg" width="134" height="32"></td></tr></table></td></tr>
    
  </table>
  </form>
</div>
</div>
<div></div>
<div class="aplication_text">*applicable on disbursal of loan</div>
<div style="clear:both;"></div>
<div class="powered_text"><span style="font-size:14px; color:#000; font-weight:normal;  font-family:Zurich Lt BT;">Powered by :-</span> Deal4loans.com</div>
<div style="clear:both; height:10px;"></div>
<div style="font-family:zurich BT; font-size:11px;"></div>
</div>

</body>
</html>
