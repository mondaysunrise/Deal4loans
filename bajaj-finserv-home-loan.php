<?php 
ob_start( 'ob_gzhandler' );
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	if(strlen($_REQUEST["source"])>0)	{		$srce=$_REQUEST["source"];	}	else	{		$srce="bajaj-finserv-home-loan";	}
$city_List = array('Delhi', 'Noida', 'Gurgaon', 'Gaziabad', 'Faridabad', 'Greater Noida', 'Sahibabad', 'Bangalore', 'CHANDIGARH', 'JAIPUR', 'JODHPUR', 'KOLKOTA', 'JALANDHAR', 'HYDERABAD', 'COCHIN', 'VIJAYAWADA', 'SALEM', 'COIMBATORE', 'MADURAI', 'VIZAG', 'MYSORE', 'Chennai', 'PUNE', 'SURAT', 'INDORE', 'NAGPUR', 'AHMEDABAD', 'MUMBAI', 'Thane', 'Navi Mumbai', 'Ludhiana', 'BHOPAL', 'RAIPUR', 'Karnal', 'Panipat', 'Yamuna Nagar');

sort($city_List);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bajaj Finserv Home Loan </title>
<link href="bajaj-finserv-home-loan-new-lp-styles.css" type="text/css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="easy-responsive-tabs.css" />
<style>.alert_msg { color:#F00;}</style>
 <script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script src="jquery-1.6.3.min.js"></script>
<script src="easyResponsiveTabs.js" type="text/javascript"></script>
<script language="javascript">

function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
	{	//alert("Kindly fill in your Loan Amount (Numeric Only)!");	
		document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";
		Form.Loan_Amount.focus();	return false;	}
	else if(containsalph(Form.Loan_Amount.value)==true)
	{			document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";	Form.Loan_Amount.focus();	return false;	}
	
	if(Form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";	
		Form.Employment_Status.focus();
		return false;
	}
	if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";		Form.IncomeAmount.focus();		return false;	}
	
	if(Form.City.selectedIndex==0)
	{			document.getElementById('cityVal').innerHTML = "<span class='hintanchor'>Enter City to Continue!</span>";		Form.City.focus();		return false;	}
	else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
	{	document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";	Form.City_Other.focus();	return false;	}

	
	
	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
      document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		Form.Name.focus();	return false;	
	}
	else if(containsdigit(Form.Name.value)==true)
	{
	//	alert("Name contains numbers!");
        document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Name contains number</span>";		
		Form.Name.focus();
		return false;
	}
	  for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
		//alert ("Name has special characters.\n Please remove them and try again.");
		      document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Contains special characters!</span>";		
		Form.Name.focus();
		return false;
		}
	  }
	  
	if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
//	alert("Kindly fill in your Mobile Number!");
	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
	Form.Phone.focus();
	return false;
	}
	
		  if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
//				  alert("Enter numeric value");
				  document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
				  Form.Phone.focus();
				  return false;  
			}
			if (Form.Phone.value.length < 10 )
			{
//					alert("Please Enter 10 Digits"); 
					document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill 10 digits!</span>";
					 Form.Phone.focus();
					return false;
			}
			if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
			{
				//alert("The number should start only with 9 or 8 or 7");
				document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";
				Form.Phone.focus();
				return false;
			}	
		  if(Form.Email.value=="")
	  {		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	
	
	
	if(!Form.accept.checked)
	{	document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	Form.accept.focus();	return false;	}
}


function submitform_bt(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if((Form.Loan_Amountbt.value=='')||(Form.Loan_Amountbt.value=="Loan Amount"))
	{	//alert("Kindly fill in your Loan Amount (Numeric Only)!");	
		document.getElementById('loanValbt').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";
		Form.Loan_Amountbt.focus();	return false;	}
	else if(containsalph(Form.Loan_Amountbt.value)==true)
	{			document.getElementById('loanValbt').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";	Form.Loan_Amountbt.focus();	return false;	}
	
	if(Form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusValbt').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";	
		Form.Employment_Status.focus();
		return false;
	}
	if((Form.IncomeAmountbt.value=='')||(Form.IncomeAmountbt.value=="Annual Income"))
	{		document.getElementById('netSalaryValbt').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";		Form.IncomeAmountbt.focus();		return false;	}
	
	if(Form.City.selectedIndex==0)
	{			document.getElementById('cityValbt').innerHTML = "<span class='hintanchor'>Enter City to Continue!</span>";		Form.City.focus();		return false;	}
	else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
	{	document.getElementById('othercityValbt').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";	Form.City_Other.focus();	return false;	}

	
	
	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
      document.getElementById('nameValbt').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		Form.Name.focus();	return false;	
	}
	else if(containsdigit(Form.Name.value)==true)
	{
	//	alert("Name contains numbers!");
        document.getElementById('nameValbt').innerHTML = "<span class='hintanchor'>Name contains number</span>";		
		Form.Name.focus();
		return false;
	}
	  for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
		//alert ("Name has special characters.\n Please remove them and try again.");
		      document.getElementById('nameValbt').innerHTML = "<span class='hintanchor'>Contains special characters!</span>";		
		Form.Name.focus();
		return false;
		}
	  }
	  
	if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
//	alert("Kindly fill in your Mobile Number!");
	document.getElementById('phoneValbt').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
	Form.Phone.focus();
	return false;
	}
	
		  if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
//				  alert("Enter numeric value");
				  document.getElementById('phoneValbt').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
				  Form.Phone.focus();
				  return false;  
			}
			if (Form.Phone.value.length < 10 )
			{
//					alert("Please Enter 10 Digits"); 
					document.getElementById('phoneValbt').innerHTML = "<span  class='hintanchor'>Fill 10 digits!</span>";
					 Form.Phone.focus();
					return false;
			}
			if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
			{
				//alert("The number should start only with 9 or 8 or 7");
				document.getElementById('phoneValbt').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";
				Form.Phone.focus();
				return false;
			}	
		  if(Form.Email.value=="")
	  {		document.getElementById('emailValbt').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailValbt').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailValbt').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	
	
		if(Form.roi.value=="")
	{
		document.getElementById('roiValbt').innerHTML = "<span  class='hintanchor'>Rate of Interest!</span>";	
		Form.roi.focus();
		return false;
	}



	
	if(Form.Existing_Bank_d.selectedIndex==0)
	{			document.getElementById('existingBDVal').innerHTML = "<span class='hintanchor'>Enter Existing Bank!</span>";		Form.City.focus();		return false;	}
	else if((Form.Existing_Bank_d.value=='Others')  && (Form.Existing_Bank.value==''))
	{	document.getElementById('existBankValbt').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";		Form.Existing_Bank.focus();	return false;	}
/*	if (Form.Existing_Bank.value=="")
	{
		document.getElementById('existBankValbt').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}
*/	

	if(!Form.accept.checked)
	{	document.getElementById('acceptValbt').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	Form.accept.focus();	return false;	}
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
function othercity1()
{
	var ni1 = document.getElementById('othCitDiv');
	var ni2 = document.getElementById('othCitvalDiv');
	if(document.home_loan.City.value=='Others')
	{
		ni1.innerHTML = 'Other City';
		ni2.innerHTML = '<input value="Other City" name="City_Other" id="City_Other" style="width: 140px;" onBlur="onBlurDefault(this,\'Other City\');"  onfocus="onFocusBlank(this,\'Other City\');" onKeyUp="searchSuggest();" /><div id="CityOLayer"></div><div id="othercityVal"></div>';
	}
	else	
	{
		ni1.innerHTML = '';
		ni2.innerHTML = '';
	}
}
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){		element.value="";	}
}
function onBlurDefault(element,defaultVal){
	if(element.value==""){		element.value = defaultVal;	}
}
function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
</script>
  <script>
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
function addtooltip()
{
		var ni = document.getElementById('myDiv');
		if(ni.innerHTML=="")
		{				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';		}
		return true;
	}
function removetooltip()
{
		var ni = document.getElementById('myDiv');
		if(ni.innerHTML!="")
		{				ni.innerHTML = '';		}
		return true;
}

function getOtherBanks()
{
	if(document.home_loan_bl.Existing_Bank_d.value=='Others')
	{
		var ni1 = document.getElementById('oBankLabel');
		var ni2 = document.getElementById('oBankTextBox');
		ni1.innerHTML = 'Other Bank Name';
		ni2.innerHTML = '<input type="text" name="Existing_Bank"  id="Existing_Bank"  class="input"  onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event); "onkeydown="validateDiv(\'existBankValbt\');" tabindex="9" /><div id="existBankValbt" class="alert_msg"></div>';	
	}
	else
	{
		ni1.innerHTML = '';
		ni2.innerHTML = '';
	}
	
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	if(document.home_loan.City.value=='Others')
	{
		ni1.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr><td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="head-textfinn" colspan="2">Personal Details</td></tr>     <tr><td width="3%"><img src="images/bajaj-finserv-lock.jpg" width="10" height="12" /></td><td width="97%" class="privacytext">Your Information is secure with us and will not be shared without your consent</td></tr></table></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td class="form-body" width="40%">Full Name</td><td width="60%"><input type="text" name="Name" id="Name" class="input" onKeyDown="validateDiv(\'nameVal\');" tabindex="5" /><div id="nameVal" class="alert_msg" ></div></td></tr><tr><td colspan="2" class="form-body" height="7"></td></tr><tr><td class="form-body">Mobile Number</td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="10%" class="form-body">+91</td><td width="90%"><input type="text" class="mobo" maxlength="10"  name="Phone" id="Phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'phoneVal\');"  tabindex="6"/><div id="phoneVal" class="alert_msg"></div></td></tr></table></td></tr><tr><td colspan="2" height="7"></td></tr><tr><td class="form-body">Email ID</td><td><input class="input" name="Email" id="Email" onBlur="onBlurDefault(this,\'Email Id\');" onKeyDown="validateDiv(\'emailVal\');" tabindex="7" /><div id="emailVal" class="alert_msg"></div></td></tr><tr><td colspan="2" height="7"></td></tr><tr><td class="form-body">Other City</td><td><input class="input" name="City_Other" id="City_Other" onKeyDown="validateDiv(\'cityotherVal\');" tabindex="8" /><div id="cityotherVal" class="alert_msg"></div></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td colspan="2" class="privacytext"><input type="checkbox" tabindex="9"  name="accept" style="border:none;" checked  > I authorize Deal4loans.com &amp; its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >Terms & Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td></tr><tr><td align="center">&nbsp;</td><td align="left" style="padding-top:5px;"><input type="image" tabindex="10" name="Submit" src="images/bajaj-finserv-get-quotebtn.jpg" style="width:131px; height:38px; border:none;" /></td></tr></table>';
	}
	else
	{
			ni1.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr><td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="head-textfinn" colspan="2">Personal Details</td></tr>     <tr><td width="3%"><img src="images/bajaj-finserv-lock.jpg" width="10" height="12" /></td><td width="97%" class="privacytext">Your Information is secure with us and will not be shared without your consent</td></tr></table></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td class="form-body" width="40%">Full Name</td><td width="60%"><input type="text" name="Name" id="Name" class="input" onKeyDown="validateDiv(\'nameVal\');" tabindex="5" /><div id="nameVal" class="alert_msg" ></div></td></tr><tr><td colspan="2" class="form-body" height="7"></td></tr><tr><td class="form-body">Mobile Number</td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="10%" class="form-body">+91</td><td width="90%"><input type="text" class="mobo" maxlength="10"  name="Phone" id="Phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  onKeyDown="validateDiv(\'phoneVal\');"  tabindex="6"/><div id="phoneVal" class="alert_msg"></div></td></tr></table></td></tr><tr><td colspan="2" height="7"></td></tr><tr><td class="form-body">Email ID</td><td><input class="input" name="Email" id="Email" onBlur="onBlurDefault(this,\'Email Id\');"  onKeyDown="validateDiv(\'emailVal\');" tabindex="7" /><div id="emailVal" class="alert_msg"></div></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td colspan="2" class="privacytext"><input type="checkbox" tabindex="8"  name="accept" style="border:none;" checked  > I authorize Deal4loans.com &amp; its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >Terms & Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td></tr><tr><td align="center">&nbsp;</td><td align="left" style="padding-top:5px;"><input type="image" tabindex="9" name="Submit" src="images/bajaj-finserv-get-quotebtn.jpg" style="width:131px; height:38px; border:none;" /></td></tr></table>';
	}
}

function addPersonalDetails_bt()
{
	var ni3 = document.getElementById('pDetailsbt');
	if(document.home_loan_bl.City.value=='Others')
	{
		ni3.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr><td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="head-textfinn" colspan="2">Personal Details</td></tr>     <tr><td width="3%"><img src="images/bajaj-finserv-lock.jpg" width="10" height="12" /></td><td width="97%" class="privacytext">Your Information is secure with us and will not be shared without your consent</td></tr></table></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td class="form-body" width="40%">Full Name</td><td width="60%"><input type="text" name="Name" id="Name" class="input" onKeyDown="validateDiv(\'nameValbt\');" tabindex="5" /><div id="nameValbt" class="alert_msg" ></div></td></tr><tr><td colspan="2" class="form-body" height="7"></td></tr><tr><td class="form-body">Mobile Number</td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="10%" class="form-body">+91</td><td width="90%"><input type="text" class="mobo" maxlength="10"  name="Phone" id="Phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'phoneValbt\');"  tabindex="6"/><div id="phoneValbt" class="alert_msg"></div></td></tr></table></td></tr><tr><td colspan="2" height="7"></td></tr><tr><td class="form-body">Email ID</td><td><input class="input" name="Email" id="Email" onBlur="onBlurDefault(this,\'Email Id\');"  onKeyDown="validateDiv(\'emailValbt\');" tabindex="7" /><div id="emailValbt" class="alert_msg"></div></td></tr><tr><td colspan="2" height="7"></td></tr><tr><td class="form-body">Other City</td><td><input class="input" name="City_Other" id="City_Other" onKeyDown="validateDiv(\'cityotherVal\');" tabindex="8" /><div id="cityotherVal" class="alert_msg"></div></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td class="form-body">Existing ROI</td><td><input type="text" name="roi" id="roi" onkeydown="validateDiv(\'roiValbt\');"  class="input" tabindex="8" /><div id="roiValbt" class="alert_msg"></div></td></tr><tr><td colspan="2" height="10"></td></tr><tr><td class="form-body">Bank Name</td><td> <select name="Existing_Bank_d" class="select"  onChange="validateDiv(\'existingBDVal\');  getOtherBanks();"><option value="">Bank Name</option><option class="HDFC">HDFC Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="Citibank">Citibank</option><option value="Axis Bank">Axis Bank</option><option value="SBI">SBI</option><option value="LIC Housing">LIC Housing</option><option value="Standard Chartered">Standard Chartered</option><option value="Others">Others</option></select><div id="existingBDVal" class="alert_msg"></div>   </td></tr><tr><td colspan="2" height="10"></td></tr><tr><td  class="form-body" id="oBankLabel"></td><td id="oBankTextBox"></td></tr><tr><td colspan="2" class="privacytext"><input type="checkbox" tabindex="10"  name="accept" style="border:none;" checked  > I authorize Deal4loans.com &amp; its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >Terms & Conditions</a>.<div id="acceptValbt" class="alert_msg"></div></td></tr><tr><td align="center">&nbsp;</td><td align="left" style="padding-top:5px;"><input type="image" tabindex="11" name="Submit" src="images/bajaj-finserv-get-quotebtn.jpg" style="width:131px; height:38px; border:none;" /></td></tr></table>';
	}
	else
	{
		ni3.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr><td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="head-textfinn" colspan="2">Personal Details</td></tr>     <tr><td width="3%"><img src="images/bajaj-finserv-lock.jpg" width="10" height="12" /></td><td width="97%" class="privacytext">Your Information is secure with us and will not be shared without your consent</td></tr></table></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td class="form-body" width="40%">Full Name</td><td width="60%"><input type="text" name="Name" id="Name" class="input" onKeyDown="validateDiv(\'nameValbt\');" tabindex="5" /><div id="nameValbt" class="alert_msg" ></div></td></tr><tr><td colspan="2" class="form-body" height="7"></td></tr><tr><td class="form-body">Mobile Number</td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="10%" class="form-body">+91</td><td width="90%"><input type="text" class="mobo" maxlength="10"  name="Phone" id="Phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" onKeyDown="validateDiv(\'phoneValbt\');"  tabindex="6"/><div id="phoneValbt" class="alert_msg"></div></td></tr></table></td></tr><tr><td colspan="2" height="7"></td></tr><tr><td class="form-body">Email ID</td><td><input class="input" name="Email" id="Email" onBlur="onBlurDefault(this,\'Email Id\');"  onFocus="removetooltip();"  onChange="insertData();" onKeyDown="validateDiv(\'emailValbt\');" tabindex="7" /><div id="emailValbt" class="alert_msg"></div></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td class="form-body">Existing ROI</td><td><input type="text" name="roi" id="roi" onkeydown="validateDiv(\'roiValbt\');"  class="input" tabindex="8" /><div id="roiValbt" class="alert_msg"></div></td></tr><tr><td colspan="2" height="10"></td></tr><tr><td class="form-body">Bank Name</td><td> <select name="Existing_Bank_d" class="select"  onChange="validateDiv(\'existingBDVal\');  getOtherBanks();"><option value="">Bank Name</option><option class="HDFC">HDFC Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="Citibank">Citibank</option><option value="Axis Bank">Axis Bank</option><option value="SBI">SBI</option><option value="LIC Housing">LIC Housing</option><option value="Standard Chartered">Standard Chartered</option><option value="Others">Others</option></select><div id="existingBDVal" class="alert_msg"></div>   </td></tr><tr><td colspan="2" height="10"></td></tr><tr><td  class="form-body" id="oBankLabel"></td><td id="oBankTextBox"></td></tr><tr><td colspan="2" class="privacytext"><input type="checkbox" tabindex="10"  name="accept" style="border:none;" checked  > I authorize Deal4loans.com &amp; its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >Terms & Conditions</a>.<div id="acceptValbt" class="alert_msg"></div></td></tr><tr><td align="center">&nbsp;</td><td align="left" style="padding-top:5px;"><input type="image" tabindex="11" name="Submit" src="images/bajaj-finserv-get-quotebtn.jpg" style="width:131px; height:38px; border:none;" /></td></tr></table>';
	}

}
	
function validateDiv(div)
{
	//alert(div);
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

</script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style>
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:149px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
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
.demo {width: 980px;margin: 0px auto;}
.demo h1 {margin:33px 0 25px;}
.demo h3 {margin: 10px 0;}
pre{background:#fff;}
@media only screen and (max-width: 780px) {.demo{margin:5%;width: 90%;}
.how-use{float:left;width:300px;display:none;}}
#tabInfo{display:none;}
    </style>
</head>
<body>
<div class="header">
<div class="headerinn">
<div class="logo"><img src="images/bajaj-finserv-new-logo.jpg" width="162" height="43"></div>
<div style="clear:both;"></div>
</div>
</div>
<div class="secondcontainer-fins">
<div class="leftpanel">
<div class="heading-text-fins">Interest rate of 10.25%<br>
0.5% prompt repayment benefit </div>
<div class="form-box">  <div class="demo" style="width:100%;"><!--Horizontal Tab-->
        <div id="horizontalTab">
           <ul class="resp-tabs-list">
                <li>Home Loan</li>
                <li>Home Loan Balance Transfer Loan</li>
                          </ul>	
                          
            <div class="resp-tabs-container" >
                <div >
                    <p>
<form name="home_loan" action="bajaj-finserv-home-loan-continue.php" onSubmit="return submitform(document.home_loan);" method="post">        
<input type="hidden" name="source" value="<? echo $srce; ?>">
<input type="hidden" name="last_id" value="<? echo $last_id; ?>">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td  colspan="2" class="head-textfinn">Loan Details</td>
   
  </tr>
  <tr>
    <td  class="form-body" width="40%">Loan Amount</td>
    <td  width="60%">
     <input name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');"  onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanVal');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" tabindex="1" class="input" /><div id="loanVal"  class="alert_msg"></div></td>
  </tr>
  <tr>
    <td colspan="2" height="10"></td>
  </tr>
 <tr>
      <td colspan="2"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span>    </td>
</tr>

  <tr>
    <td class="form-body">Occupation</td>
    <td>
    <select name="Employment_Status" id="Employment_Status" onChange="validateDiv('empStatusVal');" class="select" tabindex="2">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td colspan="2" height="10"></td>
  </tr>
  <tr>
    <td class="form-body">Annual Income</td>
    <td><input   name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"  class="input" onBlur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onKeyDown="validateDiv('netSalaryVal');" tabindex="3"/><div id="netSalaryVal" class="alert_msg"></div></td>
  </tr>

  <tr>
    <td colspan="2" height="10"></td>
  </tr>
    <tr>
                                <td align="left" valign="middle" colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td>
                              </tr>
  <tr>
    <td class="form-body">City</td>
    <td><select tabindex="4" class="select" name="City" id="City" onChange="addPersonalDetails(); validateDiv('cityVal');" ><option value="">Please Select</option>
<?php 
for($ii=1;$ii<count($city_List);$ii++)
{
	?>
	<option value="<?php echo ucfirst(strtolower(trim($city_List[$ii]))); ?>" ><?php echo ucfirst(strtolower(trim($city_List[$ii]))); ?></option>
	<?php
}
?><option value="Others">Others</option></select><div id="cityVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
 
  <tr>
    <td colspan="2" id="personalDetails"><table width="100%" border="0" cellpadding="0" cellspacing="0">  <tr>
    <td align="center" width="40%">&nbsp;</td>
    <td align="left"><img src="images/bajaj-finserv-get-quotebtn.jpg" alt="" width="131" height="38" /></td>
  </tr></table></td></tr></table></form></p></div>
                <div>
                    <p>
<form name="home_loan_bl" action="bajaj-finserv-home-loan-continue.php" onSubmit="return submitform_bt(document.home_loan_bl);" method="post">        
<input type="hidden" name="source" value="<? echo $srce; ?>">
<input type="hidden" name="last_id" value="<? echo $last_id; ?>">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="head-textfinn">Loan Details</td>

  </tr>
  <tr>
    <td  class="form-body"  width="40%">Outstanding Loan Amount</td>
    <td  width="60%">
     <input name="Loan_Amountbt"  id="Loan_Amountbt" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amountbt','formatedlAbt','wordloanAmountbt');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amountbt', 'formatedlAbt','wordloanAmountbt');"  onKeyDown="getDigitToWords('Loan_Amountbt','formatedlAbt','wordloanAmountbt'); validateDiv('loanValbt');" onBlur="getDigitToWords('Loan_Amountbt', 'formatedlAbt', 'wordloanAmountbt');" tabindex="1" class="input" /><div id="loanValbt"  class="alert_msg"></div></td>
  </tr>
  <tr>
    <td colspan="2" height="10"></td>
  </tr>
 <tr>
      <td colspan="2"><span id='formatedlAbt' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmountbt' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span>    </td>
</tr>
  <tr>
    <td class="form-body">Occupation</td>
    <td>
    <select name="Employment_Status" id="Employment_Status" onChange="validateDiv('empStatusValbt');" class="select" tabindex="2">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusValbt" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td colspan="2" height="10"></td>
  </tr>
  <tr>
    <td class="form-body">Annual Income</td>
    <td><input   name="IncomeAmountbt" id="IncomeAmountbt" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmountbt','formatedIncomebt','wordIncomebt');" onKeyPress="intOnly(this); getDiToWordsIncome('IncomeAmountbt','formatedIncomebt','wordIncomebt');"  class="input" onBlur="getDiToWordsIncome('IncomeAmountbt', 'formatedIncomebt', 'wordIncomebt');" onKeyDown="validateDiv('netSalaryValbt');" tabindex="3"/><div id="netSalaryValbt" class="alert_msg"></div></td>
  </tr>    
<tr>                         <td align="left" valign="middle" colspan="2"><span id='formatedIncomebt' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncomebt' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td>
                              </tr>

  <tr>
    <td colspan="2" height="10"></td>
  </tr>
  <tr>
    <td class="form-body">City</td>
    <td><select tabindex="4" class="select" name="City" id="City" onChange=" addPersonalDetails_bt(); validateDiv('cityValbt');" ><option value="">Please Select</option>
<?php 
for($ii=1;$ii<count($city_List);$ii++)
{
	?>
	<option value="<?php echo ucfirst(strtolower(trim($city_List[$ii]))); ?>" ><?php echo ucfirst(strtolower(trim($city_List[$ii]))); ?></option>
	<?php
}
?><option value="Others">Others</option></select><div id="cityValbt" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
   <tr>
    <td colspan="2" id="pDetailsbt"><table width="100%" border="0" cellpadding="0" cellspacing="0">  <tr>
    <td align="center" width="40%">&nbsp;</td>
    <td align="left"><img src="images/bajaj-finserv-get-quotebtn.jpg" alt="" width="131" height="38" /></td>
  </tr></table></td></tr></table>
</form>
</p></div></div></div>
</div>
</div>  
</div>
<div class="right-panel-bajaj body_text">
<div class="features-text">Features and Benefits</div>
  <p>1)<span class="features-subtext"> Part Prepayment facility</span><br>
   <div style="margin-left:20px;">You can prepay any amount per prepay transaction being not less than 3 EMIs. There is no limit on the maximum amount. This is subject to you clearing your first EMI<br>
    <br></div>
  </p>
  <p>2) <span class="features-subtext">Nil Foreclosure charges</span><br>
   <div style="margin-left:20px;">Now you can choose to foreclose your loan anytime during your loan tenor without paying any foreclosure charges after clearance of first EMI<br></div>
    <br>
</p>
  <p>3)<span class="features-subtext"> Online Account Access</span><br>
    <div style="margin-left:20px;">Get all information about your loan like repayment track, interest certificate, payment schedule etc through our customer portal (Experia) <br></div>
  </p>
</div>
<div style="clear:both; height:5px;"></div>
<div class="discailer-text" style="width:90%; margin-left:5px;"><strong><em>Disclaimer</em></strong><br/>‘Finance at the sole discretion of Bajaj Finance Limited’  </div>
<div class="powered-by" style="margin-top:10px;">Powered by : <span style="color:#0a8bd9;">Deal4loans.com</span></div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', 
            width: 'auto',
            fit: true, 
            closed: 'accordion', 
            activate: function(event) {
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
            }
        });

        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>
</body>
</html>