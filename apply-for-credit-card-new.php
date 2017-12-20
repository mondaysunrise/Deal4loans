<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="apply-for-cc-new"; }
	$maxage=date('Y')-62;
	$minage=date('Y')-18;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Credit Card</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="credit-card-window-theme-landing-page-styles.css" type="text/css" rel="stylesheet"  />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-cclist.js"></script>
<style type="text/css">
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:300px;	/* Width of box */
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
	</style>
<Script Language="JavaScript">
function cityother() { 	if(document. creditcard_form.City.value=="Others")	{	document.creditcard_form.City_Other.disabled = false;	}	else	{		document.creditcard_form.City_Other.disabled = true;	} } 

function ckhcreditcard(Form)
{
	var j;
	var cnt=-1;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cit=document.creditcard_form.City.value;
	var sal=document.creditcard_form.Net_Salary.value;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
 		
	if(document.creditcard_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.creditcard_form.Net_Salary.focus();
		return false;
	}
	if (document.creditcard_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Enter Employment Status!</span>";
		document.creditcard_form.Employment_Status.focus();
		return false;
	}
	
	
	if (document.creditcard_form.salary_account.selectedIndex==0)
	{		
	  	document.getElementById('salAccountVal').innerHTML = "<span  class='hintanchor'>Select Salary Account!</span>";
   		document.creditcard_form.salary_account.focus();		return false;	
	}
	if (document.creditcard_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.creditcard_form.City.focus();
		return false;
	}
   
	if((document.creditcard_form.Full_Name.value=="") || (Trim(document.creditcard_form.Full_Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.creditcard_form.Full_Name.focus();
		return false;
	}

	if(document.creditcard_form.Full_Name.value!="")
	{
		if(containsdigit(document.creditcard_form.Full_Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.creditcard_form.Full_Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.creditcard_form.Full_Name.value.length; i++) 
   {
		if (iChars.indexOf(document.creditcard_form.Full_Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.creditcard_form.Full_Name.focus();
			return false;
		}
  }
  
  	if(document.creditcard_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.creditcard_form.Phone.focus();
		return false;
	}
	if(isNaN(document.creditcard_form.Phone.value)|| document.creditcard_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.creditcard_form.Phone.focus();
		return false;  
	}
	if (document.creditcard_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.creditcard_form.Phone.focus();
		return false;
	}
	if ((document.creditcard_form.Phone.value.charAt(0)!="9") && (document.creditcard_form.Phone.value.charAt(0)!="8") && (document.creditcard_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.creditcard_form.Phone.focus();
		return false;
	}
	
	if(document.creditcard_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	
	var str=document.creditcard_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}

	if (document.creditcard_form.Age.selectedIndex==0)
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Age to Continue!</span>";	
		document.creditcard_form.City.focus();
		return false;
	}
		
	
	if((document.creditcard_form.Company_Name.value=="") || (document.creditcard_form.Company_Name.value=="Type Slowly for Autofill")|| (Trim(document.creditcard_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.creditcard_form.Company_Name.focus();
		return false;
	}
	else if(document.creditcard_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.creditcard_form.Company_Name.focus();
		return false;
	}
/*	if (document.creditcard_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.creditcard_form.Pincode.focus();
		return false;
	}
	if (document.creditcard_form.Pincode.value!="")
	{
		if(document.creditcard_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.creditcard_form.Pincode.focus();
			return false;
		}
	}*/

	for(j=0; j<document.creditcard_form.CC_Holder.length; j++) 
	{
        if(document.creditcard_form.CC_Holder[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		document.getElementById('ccholderVal').innerHTML = "<span  class='hintanchor'>Select Card holder or not!</span>";	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.creditcard_form.No_of_Banks.selectedIndex==0)
		{
			document.getElementById('ccbnknmeVal').innerHTML = "<span  class='hintanchor'>Select card from which Bank!</span>";	
			document.creditcard_form.No_of_Banks.focus();
			return false;
		}
		if(document.creditcard_form.City.selectedIndex >0)
		{
	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
			{
		if(document.creditcard_form.Card_Vintage.selectedIndex==0)
		{
			document.getElementById('ccvintageVal').innerHTML = "<span  class='hintanchor'>Please select since how long you holding credit card.</span>";	
			document.creditcard_form.Card_Vintage.focus();
			return false;
		}
		if(document.creditcard_form.Credit_Limit.selectedIndex==0)
		{
			document.getElementById('cclimitVal').innerHTML = "<span  class='hintanchor'>Please select Card Credit Limit.</span>";	
			document.creditcard_form.Credit_Limit.focus();
			return false;
		}

			}
		}
		
	}
		
	if(!document.creditcard_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.creditcard_form.accept.focus();
		return false;
	}
}   
function validateDiv(div)
{	var ni1 = document.getElementById(div);	ni1.innerHTML = ''; }
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}


function addElement()
{
	var ni = document.getElementById('myDiv');
	var niicici = document.getElementById('icici_rqdfield');
	var cit = document.creditcard_form.City.value;
	var sal = document.creditcard_form.Net_Salary.value;
		
	ni.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="42" valign="middle" class="text_b" width="30%">Bank Name :</td><td valign="middle" class="text_c"><select size="1" name="No_of_Banks" id="No_of_Banks" class="select"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="ICICI Bank">ICICI Bank</option><option value="Other">Other</option></select><div id="ccbnknmeVal"></div></td></tr></table>';

	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
	{
		niicici.innerHTML='<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td  height="42"  valign="middle" class="text_b" width="30%">Card Vintage :</td><td  height="42" valign="middle" class="text_c"><select size="1" name="Card_Vintage" class="select" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select><div id="ccvintageVal"></div></td>    </tr><tr><td  height="42" valign="middle" class="text_b">Credit Limit :</td><td  height="42" valign="middle" class="text_c">  <select size="1" name="Credit_Limit" id="Credit_Limit" class="select" onchange="validateDiv(\'cclimitVal\');" ><option value="0">Please select</option><option value="1">Upto 75,000</option><option value="2">75,000 to 1,50,000 </option><option value="3">1,50,000 & Above</option></select><div id="cclimitVal"></div></td></tr></table>';
	}
	return true;
}

function removeElement()
{
	var ni = document.getElementById('myDiv');
	var niicici = document.getElementById('icici_rqdfield');
		
	if(ni.innerHTML!="")
	{
		if(document.creditcard_form.CC_Holder.value="0")
		{
			ni.innerHTML = '';
			niicici.innerHTML = '';
		}
	}
	return true;
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.creditcard_form.City.value;
	
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
	ni1.innerHTML = '';
	
	}
	return true;
}

function addPersonalDetails()
{

	var ni1 = document.getElementById('personalDetails');
	ni1.innerHTML = '<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="30" colspan="2">Personal Details</td></tr><tr><td height="0" colspan="2" valign="top" class="text_b" style="font-size:12px;"><img src="images/secure-lock.png" width="9" height="13" /> Your Information is secure with us and will not be shared without your consent.</td></tr><tr><td width="30%" height="48" valign="middle" class="text_b">Full Name </td><td width="70%" valign="middle" class="text_c"><input name="Full_Name" type="text" class="input" id="Full_Name" onkeydown="validateDiv(\'nameVal\');" /><div id="nameVal"></div></td></tr><tr><td height="42" valign="middle" class="text_b">Mobile </td><td valign="middle" class="text_c"><table width="98%" border="0" cellspacing="0" cellpadding="0"><tr><td width="6%">+91</td><td width="94%" align="right"><input type="text" name="Phone" class="mobile" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div></td></tr></table></td></tr><tr><td height="42" valign="middle" class="text_b">Email</td><td valign="middle" class="text_c"><input name="Email" id="Email" type="text" class="input" onkeydown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr><tr><td height="42" valign="middle" class="text_b">Age</td><td valign="middle" class="text_c"><select name="Age" id="Age" class="select" onchange="validateDiv(\'dobVal\');" ><option name="">Please Select</option><option value="21">21 Years</option><option value="22">22 Years</option><option value="23">23 Years</option><option value="24">24 Years</option><option value="25">25 Years</option><option value="26">26 Years</option><option value="27">27 Years</option><option value="28">28 Years</option><option value="29">29 Years</option><option value="30">30 Years</option><option value="31">31 Years</option><option value="32">32 Years</option><option value="33">33 Years</option><option value="34">34 Years</option><option value="35">35 Years</option><option value="36">36 Years</option><option value="37">37 Years</option><option value="38">38 Years</option><option value="39">39 Years</option><option value="40">40 Years</option><option value="41">41 Years</option><option value="42">42 Years</option><option value="43">43 Years</option><option value="44">44 Years</option><option value="45">45 Years</option><option value="46">46 Years</option><option value="47">47 Years</option><option value="48">48 Years</option><option value="49">49 Years</option><option value="50">50 Years</option><option value="51">51 Years</option><option value="52">52 Years</option><option value="53">53 Years</option><option value="54">54 Years</option><option value="55">55 Years</option><option value="56">56 Years</option><option value="57">57 Years</option><option value="58">58 Years</option><option value="59">59 Years</option><option value="60">60 Years</option></select><div id="dobVal"></div></td></tr><tr><td height="42" valign="middle" class="text_b">Company Name</td><td valign="middle" class="text_c"><input name="Company_Name" id="Company_Name" type="text" autocomplete="off" class="input" onkeydown="validateDiv(\'companyNameVal\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)"  value="Type Slowly for Autofill" onblur="onBlurDefault(this,\'Type Slowly for Autofill\');" onfocus="onFocusBlank(this,\'Type Slowly for Autofill\');"/><div id="companyNameVal"></div></td></tr><tr><td height="42" valign="middle" class="text_b">Credit Card Holder? </td><td valign="middle" class="text_c"><input type="radio" value="1" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="addElement();"><em>Yes</em>   <input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="removeElement();"><em>No</em><div id="ccholderVal"></div>      </td></tr><tr><td valign="middle" class="text_b" colspan="2"  id="myDiv"></td></tr><tr><td valign="middle" class="text_b" colspan="2"  id="icici_rqdfield"></td></tr><tr><td height="42" colspan="2" valign="middle" class="text_b"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="4%" align="center" valign="top"><input name="accept" type="checkbox" checked="checked" /><div id="acceptVal"></div></td><td width="96%" style="font-size:12px;">I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to <a href="http://www.deal4loans.com/Privacy.php" style="color:#FFF; text-decoration: underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" style="color:#FFF; text-decoration: underline;">Terms and Conditions.</a></td></tr></table></td></tr><tr><td colspan="2" align="center" class="text_a"> <input type="submit" style="border: 0px none ; background-image: url(images/get-quote-btn-credit-card-new.png); width: 155px; height:44px; margin-bottom: 0px;" value=""/></td></tr></table>';
}

</script>
</head>
<body>

<div id="header">
<div class="header_inn">
<div class="logo"><img src="images/deal-loas-logo-radious-window-lp.png" width="185" height="62" /></div>
<div class="top_text_box">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="84%" align="center" valign="middle">Compare 23 Credit Cards from 7 Banks Choose best Credit Cards</td>
      <td width="16%" align="right" valign="middle"><img src="images/credit-cards-img.png" width="100%" height="77" /></td>
    </tr>
  </table>
</div>
</div>
</div>
<div class="black_strip"></div>
<div class="second_container">
<div class="colum1">
<form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="source" value="<? echo $retrivesource; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="45" colspan="2" align="center" style="border-bottom:#f5aa84 thin solid;">
      <div class="form-top-text_box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right"><h1>Get Your Best Credit Card Unbiased</h1></td>
        </tr>
        <tr>
          <td align="right"><span style="font-size:12px; color:#FFF; font-family:Arial, Helvetica, sans-serif;">*Fields are compulsory </span></td>
        </tr>
      </table>
      </div>
      </td>
      </tr>
    <tr>
      <td colspan="2" class="text_a"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" colspan="2">Professional Details</td>
          </tr>
        <tr>
          <td width="30%" height="30" valign="middle" class="text_b">Credit Cards</td>
          <td width="70%" valign="middle" class="text_c"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="20"><input type="checkbox" name="card_name[]" id="card_name" checked />Free Credit Cards
  <input type="checkbox" name="card_name[]" id="card_name" />Cash Back Credit Cards 
<input type="checkbox" name="card_name[]" id="card_name" />
Petro Credit Cards</td>
            </tr>
            <tr>
              <td height="22"><input type="checkbox" name="card_name[]" id="card_name" />
                Shopping Credit Cards
                  <input type="checkbox" name="card_name[]" id="card_name" />
                  Travel Credit Cards                  </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="48" valign="middle" class="text_b">Annual Income</td>
          <td valign="middle" class="text_c">
            <input name="Net_Salary" id="Net_Salary" type="text" class="input" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');" autocomplete="off" tabindex="1"  />              <div id="dialog-modal" > </div>
        <div id="netSalaryVal"></div>  <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>
         </td>
        </tr>
        <tr>
          <td height="42" valign="middle" class="text_b">Occupation</td>
          <td valign="middle" class="text_c">
            
            <select name="Employment_Status" id="Employment_Status" class="select" onChange="validateDiv('empStatusVal');" tabindex="2" >
              <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select><div id="empStatusVal" class="alert_msg"></div>
         </td>
        </tr>
        <tr>
          <td height="42" valign="middle" class="text_b">Salary/Current Account</td>
          <td valign="middle" class="text_c"><select name="salary_account" class="select" id="salary_account" onChange="validateDiv('salAccountVal');"   tabindex="3">
				  <option name="">Please Select</option>
				  <option value="HDFC Bank">HDFC Bank</option>
				  <option value="ICICI Bank">ICICI Bank</option>
				  <option value="Kotak Bank">Kotak Bank</option>
				  <option value="Standard Chartered">Standard Chartered</option>
				  <option value="Others">Others</option>
				  </select>
          <div id="salAccountVal"></div></td>
        </tr>
        <tr>
          <td height="42" valign="middle" class="text_b">City</td>
          <td valign="middle" class="text_c"><select name="City" id="City" class="select"  onchange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="4">
                            <?=plgetCityList($City)?>
                        </select>
                         <div id="cityVal"></div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="2" class="text_a" style="border-bottom:#f5aa84 thin solid; height:5px;"></td>
    </tr>
    <tr>
      <td colspan="2" class="text_a" id="personalDetails"><table width="95%" border="0" cellspacing="0" cellpadding="0"  style="padding-top:8px;"><tr><td colspan="2" align="center" class="text_a" ><br> <input type="submit" style="border: 0px none ; background-image: url(images/get-quote-btn-credit-card-new.png); width: 155px; height:44px; margin-bottom: 0px;" value=""/></td></tr></table></td>
    </tr>
   
    <tr>
      <td colspan="2" class="text_a">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF"><?php include 'footer_landingpage.php'; ?></td>
    </tr>
    </table>
    </form>
</div>
<div class="colum2">
<div class="row-a">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" align="center" style="border-bottom:#dddbda solid thin;"><h2>Why Deal4loans.com</h2></td>
      </tr>
    <tr>
      <td >
      <ul class="text_d">
      <li>Over <span style="color:#f88c2c; font-weight:bold; font-size:20px; ">45,</span><span style="color:#f5b262; font-weight:bold; font-size:20px; ">11,</span><span style="color:#ef8449; font-weight:bold; font-size:20px; ">302</span> customers have taken quote at Deal4loans.com</li>
      <li>Credit Card Offers are free for customers. It's a totally free service for customers</li>
      <li>Deal4loans.com has tie ups with all Credit Card Banks in India.</li>
      </ul>
      </td>
      </tr>
  </table>
</div>
<div class="row-b">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" align="center"><h2 style="font-size:16px; font-weight:bold; color:#FFF;">Best Credit Card Banks</h2></td>
    </tr>
    <tr>
      <td>
      <div class="bank_text_box" style="color:#1d2283;">HDFC Bank</div>
       <div class="bank_text_box" style="color:#013766;">ICICI Bank</div>
        <div class="bank_text_box" style="color:#0c86c7;">SBI</div>
      </td>
    </tr>
    <tr>
      <td height="7"></td>
    </tr>
    <tr>
      <td><div class="bank_text_box2" style="color:#0172aa;">Standard Chartered</div>
        <div class="bank_text_box" style="color:#0172aa;">AMEX</div></td>
    </tr>
  </table>
</div>
<div class="window-row_a">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="font-size:19px;">Free Credit Cards</td>
      </tr>
    <tr>
      <td colspan="2" align="center" class="text_e">Choose from <span style="font-weight:bold; font-size:17px;">7 </span>Credit Card with <span style="font-weight:bold; font-size:17px;">0</span> annual fee.</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div class="window-row_b">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="font-size:19px;">Cash Back Credit Cards</td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="text_e">Choose from <span style="font-weight:bold; font-size:17px;">4</span> Banks with Maximum rewards and cash back.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div style="clear:both;"></div>
<div class="window-row_b" style=" background:#0083c9;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" style="font-size:19px;">Petro Credit Cards</td>
    </tr>
    <tr>
      <td align="center" class="text_e">Get <span style="font-weight:bold; font-size:17px;">2.5%</span><br />
surcharge reversal on all petrol pumps and other Cash back offers.</td>
    </tr>
    </table>
</div>
<div class="window-row_c">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="font-size:19px;">Travel Credit Cards</td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="text_e">Get Free Air Tickets on Using your Credit Cards and other Travel Rewards.<br /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"  height="25"class="text_e">Choose from <span style="font-weight:bold; font-size:17px;">5</span> options.</td>
    </tr>
  </table>
</div>
<div style="clear:both;"></div>
<div class="window-row_d">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" height="15"></td>
    </tr>
    <tr>
      <td align="center" style="font-size:19px;">Shopping Credit Cards</td>
    </tr>
    <tr>
      <td align="center" class="text_e">Get maximum discount offers on shopping.<br /></td>
    </tr>
    <tr>
      <td align="center"  height="25"class="text_e">Check <span style="font-weight:bold; font-size:17px;">5 </span>banks Shopping Credit Cards.</td>
    </tr>
  </table>
</div>
</div>

</div>
</body>
</html>
