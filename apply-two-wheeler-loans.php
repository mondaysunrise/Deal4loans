<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="two-wheeler-loan";
}
$page_Name = "CarLoan";
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply Two Wheeler loans online India | Deal4loans</title>
<link rel="canonical" href="http://www.deal4loans.com/apply-two-wheeler-loans.php"/>
<meta name="keywords" content="apply two wheeler loan, Two Wheeler online, apply online Two  Wheeler, two wheeler loans India, Apply two wheeler Loans, Compare Two Wheeler in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply for Best two wheeler loans – Instant Online two wheeler loans with deal4loans, Get Instant Quotes on Loans for Motorcycles, Scooters, Scooty in India.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<!--<link href="source.css" rel="stylesheet" type="text/css" />-->
<link href="css/common-d4l-styles.css" rel="stylesheet" type="text/css" />
<link href="css/wp_cl.css" rel="stylesheet" type="text/css" />
<link href="personal-loan-banks-styles.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list-clhdfc.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="css/car-loan-styles.css" type="text/css" rel="stylesheet"  />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x: hidden;
	background-color: #FFF;
}
.red {
	color: #F00;
}
-->
</style>
<style type="text/css">
/* Big box with list of options */

#ajax_listOfOptions {
	position: absolute;	/* Never change this one */
	width: 250px;	/* Width of box */
	height: 160px;	/* Height of box */
	overflow: auto;	/* Scrolling features */
	border: 1px solid #317082;	/* Dark green border */
	background-color: #FFF;	/* White background color */
	color: black;
	text-align: left;
	font-size: 10px;
	z-index: 50;
}
#ajax_listOfOptions div {	/* General rule for both .optionDiv and .optionDivSelected */
	margin: 1px;
	padding: 1px;
	cursor: pointer;
	font-size: 10px;
}
#ajax_listOfOptions .optionDivSelected { /* Selected item in the list */
	background-color: #2375CB;
	color: #FFF;
}
#ajax_listOfOptions_iframe {
	background-color: #F00;
	position: relative;
	z-index: 5;
}
form {
	display: inline;
}
</style>
<script type="text/javascript">
var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function ajaxpage(){
var containerid = 'contentarea';	
var bikemanufacturer = document.bikeloan_form.bike_manufacturer.value;
var url;
url = "getBikeValue.php?bikemanufacturer=" + bikemanufacturer;
//alert(url);
	
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}

function chkcarloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var j;
	var cnt=-1;
	var curr_dt = '';
	curr_dt = new Date().getFullYear();
 	var maxage = curr_dt - 62;
	var minage = curr_dt - 18;
	
 	if (document.bikeloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.bikeloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.bikeloan_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if (document.bikeloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span class='hintanchor'>Please enter Employment Status to Continue!</span>";	
		document.bikeloan_form.Employment_Status.focus();
		return false;
	}
 		
	if(document.bikeloan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.bikeloan_form.Net_Salary.focus();
		return false;
	}
if (document.bikeloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.bikeloan_form.City.focus();
		return false;
	}
 
if((document.bikeloan_form.Name.value=="") || (Trim(document.bikeloan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.bikeloan_form.Name.focus();
		return false;
	}

	if(document.bikeloan_form.Name.value!="")
	{
		if(containsdigit(document.bikeloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.bikeloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.bikeloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.bikeloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.bikeloan_form.Name.focus();
			return false;
		}
  }
		if(document.bikeloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.bikeloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.bikeloan_form.Phone.value)|| document.bikeloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.bikeloan_form.Phone.focus();
		return false;  
	}
	if (document.bikeloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.bikeloan_form.Phone.focus();
		return false;
	}
	if ((document.bikeloan_form.Phone.value.charAt(0)!="9") && (document.bikeloan_form.Phone.value.charAt(0)!="8") && (document.bikeloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.bikeloan_form.Phone.focus();
		return false;
	}
	
	if(document.bikeloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.bikeloan_form.Email.focus();
		return false;
	}
	
	var str=document.bikeloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.bikeloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.bikeloan_form.Email.focus();
		return false;
	}
	
	if(document.bikeloan_form.day.value=="" || document.bikeloan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.bikeloan_form.day.focus();
		return false;
	}
	if(document.bikeloan_form.day.value!="")
	{
		if((document.bikeloan_form.day.value<1) || (document.bikeloan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.bikeloan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.bikeloan_form.day, 'Day', 2))
		return false;
	
	if(document.bikeloan_form.month.value=="" || document.bikeloan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.bikeloan_form.month.focus();
		return false;
	}
	if(document.bikeloan_form.month.value!="")
	{
		if((document.bikeloan_form.month.value<1) || (document.bikeloan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.bikeloan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.bikeloan_form.month, 'month', 2))
		return false;

	if(document.bikeloan_form.year.value=="" || document.bikeloan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.bikeloan_form.year.focus();
		return false;
	}
	if(document.bikeloan_form.year.value!="")
	{
		if((document.bikeloan_form.year.value < maxage) || (document.bikeloan_form.year.value >minage))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.bikeloan_form.year.focus();
			return false;
		}
	}

	if(!checkData(document.bikeloan_form.year, 'Year', 4))
		return false;
		
	
	if((document.bikeloan_form.City.value=="Others") && ((document.bikeloan_form.City_Other.value=="" || document.bikeloan_form.City_Other.value=="Other City"  ) || !isNaN(document.bikeloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.bikeloan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.bikeloan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.bikeloan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.bikeloan_form.City_Other.focus();
  		return false;
  	}
  }
  
  
 

if((document.bikeloan_form.Company_Name.value=="") || (document.bikeloan_form.Company_Name.value=="Company Name")|| (Trim(document.bikeloan_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.bikeloan_form.Company_Name.focus();
		return false;
	}
	else if(document.bikeloan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.bikeloan_form.Company_Name.focus();
		return false;
	}

if (document.bikeloan_form.bike_manufacturer.selectedIndex==0)
{
	document.getElementById('bikeMVal').innerHTML = "<span  class='hintanchor'>Enter Bike Manufacturer!</span>";	
	document.bikeloan_form.bike_manufacturer.focus();
	return false;
}	
if (document.bikeloan_form.bike_model.selectedIndex==0)
{
	document.getElementById('bikeModelVal').innerHTML = "<span  class='hintanchor'>Enter Bike Model!</span>";	
	document.bikeloan_form.bike_model.focus();
	return false;
}


		
	if(!document.bikeloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.bikeloan_form.accept.focus();
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
function HandleOnClose(filename) {
if ((event.clientY < 0)) {

myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
myWindow.document.bgColor=""
myWindow.document.close() 
}
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni3 = document.getElementById('other_Details');
	ni1.innerHTML = '<div class="p-details"><div><strong>Personal Details</strong></div><div class="termtext"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</div></div><div style="clear:both;"></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td  height="25" class="cl-form-text">Full Name:</td>  </tr><tr>    <td  height="25"><input name="Name" id="Name"  class="d4l-input" type="text" onkeydown="validateDiv(\'nameVal\');" tabindex="5"  /><div id="nameVal"></div></td>    </tr>    </table>    </div><div  class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">Mobile:</td>  </tr><tr>       <td height="25" class="cl-form-text">+91<input type="text" class="pl_mobo" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onblur="return Decorate1(\' \')" onfocus="addtooltip();" tabindex="6" onkeydown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table></div><div class="new-input-box"> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">  <tr>      <td height="25" class="cl-form-text">Email ID :</td>   </tr><tr>    <td height="25"><input type="text" name="Email" id="Email"   class="d4l-input"  tabindex="7" onkeydown="validateDiv(\'emailVal\');" /> <div id="emailVal"></div> </td>    </tr>  </table></div>   <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">DOB:</td>   </tr><tr>    <td height="25"><input name="day" type="text" id="day"  value="DD" class="pl_dd" onblur="onBlurDefault(this,\'dd\');" onkeydown="validateDiv(\'dobVal\');" onfocus="onFocusBlank(this,\'dd\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="8"/> <input  name="month" type="text" onkeydown="validateDiv(\'dobVal\');" id="month" class="pl_dd" value="MM" onblur="onBlurDefault(this,\'mm\');" onfocus="onFocusBlank(this,\'mm\');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="9"/> <input name="year" type="text" id="year" class="pl_yy_b" value="YYYY" onblur="onBlurDefault(this,\'yyyy\');" onfocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="10"/><div id="dobVal"></div> </td>    </tr>        </table>    </div>';

	var ni20 = document.getElementById('City').value;
	if(ni20=='Others')
	{
		ni3.innerHTML ='<div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">Other City:</td>    </tr><tr>    <td height="25"><input type="text" name="City_Other"  value="Other City" onfocus="this.select();" class="d4l-input" tabindex="8" onkeydown="validateDiv(\'othercityVal\');"  />                        <div id="othercityVal"></div>   </td>    </tr>        </table>    </div> <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">Company Name:</td> </tr><tr>      <td height="25"> <input type="text" name="Company_Name" class="d4l-input" onfocus="addrest();" onkeydown="validateDiv(\'companyNameVal\');" tabindex="11" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" autocomplete="off"/> <div id="companyNameVal"></div>    </td>    </tr>  </table></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">Bike Make:</td>   </tr><tr>     <td height="25" >  <select name="bike_manufacturer" id="bike_manufacturer"  onChange="ajaxpage(); addSBIOFR();" class="d4l-select"><option value="">Select Brand</option><?php $getCarNameSql = "SELECT bike_manufacturer FROM bike_list WHERE 1 GROUP BY bike_manufacturer"; list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array()); for($cN=0;$cN<$numRowsCarName;$cN++) { 	$bike_manufacturer = $getCarNameQuery[$cN]["bike_manufacturer"]; 	?>  	<option value="<?php echo $bike_manufacturer; ?>"><?php echo $bike_manufacturer; ?></option>        <?php } ?> </select>        <div id="bikeMVal"></div>                </td>    </tr>        </table>    </div>   <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td  height="25" class="cl-form-text">Bike Model:</td>  </tr><tr>    <td>      <div id="contentarea"><select name="bike_model" id="bike_model" class="d4l-select"><option value="">Select Model</option></select></div> <div  id="bikeModelVal"></div>    </td>    </tr>   </table></div><div style="clear:both;"></div><div class="cl_terms_box cl-form-text"><input type="checkbox"  name="accept" style="border:none;" tabindex="15"  checked="checked" > I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#FFF; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#FFF; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div>                  <div class="pl_bnt_b"><input type="submit" class="cl-get-quotebtn" value="Get Quote" tabindex="16" /></div>   <div style="clear:both;"></div>';
	}
	else
	{
		ni3.innerHTML ='<div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" class="cl-form-text">Company Name:</td> </tr><tr><td height="25"><input type="text" name="Company_Name" class="pl_input_b" onfocus="addrest();" onkeydown="validateDiv(\'companyNameVal\');" tabindex="11" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" autocomplete="off"/> <div id="companyNameVal"></div>    </td>    </tr>  </table></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" class="cl-form-text">Bike Make:</td>   </tr><tr>     <td height="25" >  <select name="bike_manufacturer" id="bike_manufacturer"  onChange="ajaxpage(); addSBIOFR();" class="d4l-select"><option value="">Select Brand</option><?php $getCarNameSql = "SELECT bike_manufacturer FROM bike_list WHERE 1 GROUP BY bike_manufacturer"; list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());  for($cN=0;$cN<$numRowsCarName;$cN++) { 	$bike_manufacturer = $getCarNameQuery[$cN]["bike_manufacturer"]; ?><option value="<?php echo $bike_manufacturer; ?>"><?php echo $bike_manufacturer; ?></option>        <?php } ?> </select><div id="bikeMVal"></div> </td></tr></table></div>   <div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td  height="25" class="cl-form-text">Bike Model:</td>  </tr><tr>    <td><div id="contentarea"><select name="bike_model" id="bike_model" class="d4l-select"><option value="">Select Model</option></select></div> <div  id="bikeModelVal"></div></td></tr></table></div><div style="clear:both;"></div><div class="cl_terms_box cl-form-text"><input type="checkbox"  name="accept" style="border:none;" tabindex="15" checked="checked"> I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style=" color:#FFF; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="color:#FFF; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div> <div class="pl_bnt_b"><input type="submit" class="cl-get-quotebtn" value="Get Quote" tabindex="16" /></div>   <div style="clear:both;"></div>';
	}	
	
}
function addSBIOFR()
{
	var niSBIOFR = document.getElementById('sbiCardOffer');
	var cit = document.getElementById('City').value;
	var salry = document.getElementById('Net_Salary').value;

	if(niSBIOFR.innerHTML=='')
	{
		if((cit=="Ahmedabad" || cit=="Bangalore" || cit=="Baroda" || cit=="Bhopal" || cit=="Bhubaneshwar" || cit=="Calcutta" || cit=="Chennai" || cit=="Coimbatore" || cit=="Faridabad" || cit=="Gaziabad" || cit=="Gurgaon" || cit=="Hyderabad" || cit=="Indore" || cit=="Indore" || cit=="Jaipur" || cit=="Lucknow" || cit=="Mumbai" || cit=="Nagpur" || cit=="Delhi" || cit=="Noida" || cit=="Chandigarh" || cit=="Ludhiana" || cit=="Jalandhar" || cit=="Aurangabad" || cit=="Tirupur" || cit=="Nasik" || cit=="Rajkot" || cit=="Jamnagar") && salry>=210000)
		{
			niSBIOFR.innerHTML = '<table width="90%" border="0" cellpadding="0" cellspacing="0" style="border:thin #FFF solid;padding-left:10px;">  <tr>   <td colspan="3" class="termtext"><input  name="sbiCCOffer"" type="checkbox" value="1" />Enjoy great Rewards/Discount./Cashback offers on Shopping | Dinning | Travel & Zero fee Credit Cards, Choose from SBI, ICICI Bank, American Express & Other Bank credit cards. Apply Now.</td>  </tr></table><br>';	
		}
		else
		{
			niSBIOFR.innerHTML = '';
		}
	}
	else
	{
		if((cit=="Ahmedabad" || cit=="Bangalore" || cit=="Baroda" || cit=="Bhopal" || cit=="Bhubaneshwar" || cit=="Calcutta" || cit=="Chennai" || cit=="Coimbatore" || cit=="Faridabad" || cit=="Gaziabad" || cit=="Gurgaon" || cit=="Hyderabad" || cit=="Indore" || cit=="Indore" || cit=="Jaipur" || cit=="Lucknow" || cit=="Mumbai" || cit=="Nagpur" || cit=="Delhi" || cit=="Noida" || cit=="Chandigarh" || cit=="Ludhiana" || cit=="Jalandhar" || cit=="Aurangabad" || cit=="Tirupur" || cit=="Nasik" || cit=="Rajkot" || cit=="Jamnagar") && salry>=210000)
		{
			niSBIOFR.innerHTML = '<table width="90%" border="0" cellpadding="0" cellspacing="0" style="border:thin #FFF solid; padding-left:10px;">  <tr>   <td colspan="3" class="termtext"><input name="sbiCCOffer" type="checkbox" value="1" />Apply for SBI Credit Card with Zero Fee, choose from a wide range with great deals on Shopping, Dinning &Travel credit cards .</td>  </tr></table><br>';	
		}
		else
		{
			niSBIOFR.innerHTML = '';
		}

	}
	return true;
}
</script>
<script type="text/javascript">
function fornValidate()
{
	if (document.bikeloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.bikeloan_form.Loan_Amount.focus();
		return false;
	}	
	
		
	if (document.bikeloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span class='hintanchor'>Please enter Employment Status to Continue!</span>";	
		document.bikeloan_form.Employment_Status.focus();
		return false;
	}
 		
	if(document.bikeloan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.bikeloan_form.Net_Salary.focus();
		return false;
	}
if (document.bikeloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.bikeloan_form.City.focus();
		return false;
	}
}
</script>
<style>
.hdfc-bank {
	font-size: 16px;
	color: #001f79;
	font-weight: bold;
}
.axis-bank {
	font-size: 16px;
	color: #a50032;
	font-weight: bold;
}
.bajaj-finserv {
	font-size: 16px;
	color: #0177be;
	font-weight: bold;
}
.sbi-bank {
	font-size: 16px;
	color: #0199cd;
	font-weight: bold;
}
.kotak {
	font-size: 16px;
	color: #08315f;
	font-weight: bold;
}
.ing-vysya {
	font-size: 16px;
	color: #ff6600;
	font-weight: bold;
}
.fullerton {
	font-size: 16px;
	color: #de6020;
	font-weight: bold;
}
.pnb-bank {
	font-size: 16px;
	color: #f7b801;
	font-weight: bold;
}
.heading_text {
	font-size: 22px;
	font-weight: bold;
	float: left;
	margin-top: 50px;
	margin-left: 85px;
}
.heading_text_b {
	font: bold 19px/100%;
	color: #000;
	margin: 0 0 5px;
	padding: 0;
}
.heading_text_c {
 font: bold 30px/100% color:#f69800;
	margin: 0 0 5px;
	padding: 0;
}
</style>
<!--
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script type="text/javascript" src="script1.js"></script>
<link href="source1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="menu-style.css">
-->
</head>
<body>
<!--
<div class="hide_top_menu"><?php #include "top-menu.php"; ?></div>
-->
<?php 
include "middle-menu.php";
?>
<div style="clear:both;"></div>
<div class="secondwrapper-pl">
  <div class="common-bread-crumb" style="margin:auto; width:100%; height:11px; margin-top:70px; color:#0a8bd9; font-size:14px;"><a href="index.php">Home</a> <strong style="font-size:12px;"> &gt; </strong> <span class="text12" style="color:#4c4c4c; font-size:14px;">Two Wheeler Loan</span></div>
<div style="clear:both; height:18px;"></div>
<h1 class="cl-h1">Two Wheeler Loan</h1>
<div style="clear:both; height:15px;"></div>
  <div class="intrl_txt" style="margin:auto;">
    <div class="pl_form_box">
      <form name="bikeloan_form" method="post" action="insert-bike-loan-values.php" onSubmit="return chkcarloan(document.bikeloan_form);">
        <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <input type="hidden" name="Activate" id="Activate" >
        <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
        <div style="clear:both;"></div>
        <div class="p-details">
          <h2 class="cl-h2"><?php echo GETQUOTEFOR;?> Best Two Wheeler Loan</h2>
        </div>
        <div style="clear:both;"></div>
        <div class="p-details"><strong>Professional Details</strong></div>
        <div style="clear:both;"></div>
        <div class="new-input-box">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25" class="cl-form-text">Loan Amount:</td>
            </tr>
            <tr>
              <td height="25"><input name="Loan_Amount" id="Loan_Amount" tabindex="1" type="text" class="pl_input_b" maxlength="10" onFocus="this.select();" onChange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />
                <div id="loanAmtVal"></div></td>
            </tr>
            <tr>
              <td><span id='formatedlA'></span><span id='wordloanAmount'></span></td>
            </tr>
          </table>
        </div>
        <div class="new-input-box">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25" class="cl-form-text">Occupation:</td>
            </tr>
            <tr>
              <td height="25"><select   name="Employment_Status"  id="Employment_Status" class="pl_select_b" tabindex="2"  onchange="validateDiv('empStatusVal');" >
                  <option value="-1">Employment Status</option>
                  <option value="1">Salaried</option>
                  <option value="0">Self Employment</option>
                </select>
                <div id="empStatusVal"></div></td>
            </tr>
          </table>
        </div>
        <div class="new-input-box">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25" class="cl-form-text">Annual Income:</td>
            </tr>
            <tr>
              <td height="25"><input type="text" name="Net_Salary" id="Net_Salary" class="d4l-input" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="3" onkeydown="validateDiv('netSalaryVal');" />
                <div id="netSalaryVal"></div></td>
            </tr>
            <tr>
              <td><span id='formatedIncome'></span> <span id='wordIncome'></span></td>
            </tr>
          </table>
        </div>
        <div class="new-input-box">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25" class="cl-form-text">City:</td>
            </tr>
            <tr>
              <td height="25" ><select name="City" id="City" class="d4l-select" onChange="addPersonalDetails(); addSBIOFR(); validateDiv('cityVal'); " tabindex="4">
                  <option value="">Please Select</option>
                  <?php
$citySql = "select city from hdfc_bike_city where status=1";
 list($cityNum,$ArrRow)=MainselectfuncNew($citySql,$array = array());
$i=0;
		 while($i<count($ArrRow))
		 {
	$city = $ArrRow[$i]['city'];
	?>
                  <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
                  <?php
$i = $i+1;}
?>
                  <option value="Others">Others</option>
                </select>
                <div id="cityVal"></div></td>
            </tr>
          </table>
        </div>
        <div style="clear:both;"></div>
        <div id="personalDetails">
          <div class="cl_terms_box cl-form-text">
            <input type="checkbox"  name="accept" style="border:none;" checked="checked">
            I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style="color:#FFF; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="color:#FFF; text-decoration:underline;">Terms and Conditions</a>.</div>
          <div class="cl_new_bnt_b">
            <input type="button" class="cl-get-quotebtn" value="Get Quote" onclick="return fornValidate(); ">
          </div>
        </div>
        <div style="clear:both;"></div>
        <div id="other_Details"></div>
 <div style="clear:both;"></div>
  <div id="sbiCardOffer" style="padding-left:5px;"></div>

      </form>
    </div>
    <br>
    <br />
    <div style="clear:both; height:15px;"></div>
    <div class="right-box-d">
      <h4 class="heading_text_b">Best Banks for Two Wheeler Loans - </h4>
      <span class="hdfc-bank">HDFC Bank</span>, <span class="axis-bank">ICICI Bank</span>, <span class="sbi-bank">SBI</span>, <span class="fullerton">Fullerton</span>, <span class="pnb-bank">Bajaj Finance</span></div>
    <div style="clear:both; height:10px;"></div><br />

    <div><strong>Why Deal4loans.com?</strong>
      <div style="clear:both; height:10px;"></div>
      <ul style="margin-left:20px;">
        <li>Get Instant offers on Rates from top 7 Banks</li>
        <li>Choose lowest Emi + Processing Fee Bank</li>
        <li>Get best deal</li>
      </ul>
    </div>
  </div>
  <div style="clear:both;"></div>
  <div class="overflow-width">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="top"><h3>INTEREST RATES ON TWO WHEELER LOANS IN INDIA</h3></td>
    </tr>
    <tr>
      <td valign="top"><table width="100%" align="center" cellpadding="0" cellspacing="1" class="table_bgcolor_Border">
<tbody>
<tr class="table_bgcolor">
<td height="35" align="center" valign="middle"><strong>Bank Name</strong></td>
<td align="center" valign="middle"><strong>Interest Rates</strong></td>
<td align="center" valign="middle"><strong>Processing Fees</strong></td>
<td align="center" valign="middle"><strong>Maximum Repayment Period</strong></td>
</tr>
<tr>
<td valign="top" height="30" bgcolor="#FFFFFF"><strong><a href="http://www.deal4loans.com/loans/two-wheeler-loans-2/sbi-two-wheeler-loan-interest-rates-documents-emi">State Bank of India</a></strong></td>
<td bgcolor="#FFFFFF" align="center">18.10%</td>
<td bgcolor="#FFFFFF" align="center">2% of loan amount</td>
<td bgcolor="#FFFFFF" align="center">3 Years</td>
</tr>
<tr>
<td height="52" bgcolor="#FFFFFF">
<a href="http://www.deal4loans.com/loans/two-wheeler-loans-2/hdfc-two-wheeler-loan-interest-rates-documents-eligibility/"><strong>HDFC Bank</strong></a></td>
<td bgcolor="#FFFFFF" align="center">Two Wheeler: 20.90% - 24%<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 25px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(244, 244, 244);"></span><br />
For Existing Customers of HDFC: 20.90% - 22.90%</td>
<td bgcolor="#FFFFFF" align="center">2% of the loan amount, 1% for HDFC Account Holders<span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 25px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none; background-color: rgb(244, 244, 244);"></span></td>
<td bgcolor="#FFFFFF" align="center">4 years</td>
</tr>
<tr>
<td bgcolor="#FFFFFF" style="height: 30px"><a href="http://www.deal4loans.com/loans/two-wheeler-loans-2/icici-bank-two-wheeler-loans-documents-details/"><strong>ICICI Bank</strong></a></td>
<td bgcolor="#FFFFFF" align="center" style="height: 30px">12.5% &#8211; 16.5%</td>
<td bgcolor="#FFFFFF" align="center" style="height: 30px">N.A</td>
<td bgcolor="#FFFFFF" align="center" style="height: 30px">3 Years</td>
</tr>
<tr>
<td height="30" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans/two-wheeler-loans-2/pnb-two-wheeler-loan-schemes-interest-rates-information/"><strong>PNB Bank</strong></a></td>
<td bgcolor="#FFFFFF" align="center">13.25% &#8211; 14.75%</td>
<td bgcolor="#FFFFFF" align="center">N.A</td>
<td bgcolor="#FFFFFF" align="center">5 years</td>
</tr>
<tr>
<td height="30" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans/two-wheeler-loans-2/bank-of-baroda-two-wheeler-loan-interest-rates-information/"><strong>Bank of Baroda</strong></a></td>
<td bgcolor="#FFFFFF" align="center">14.25%</td>
<td bgcolor="#FFFFFF" align="center">2% of loan amount</td>
<td bgcolor="#FFFFFF" align="center">5 Years</td>
</tr>
<tr>
<td height="30" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans/two-wheeler-loans-2/bank-of-india-two-wheeler-loan-interest-rates-information/"><strong>Bank of India</strong></a></td>
<td bgcolor="#FFFFFF" align="center">14.25%</td>
<td bgcolor="#FFFFFF" align="center">N.A</td>
<td bgcolor="#FFFFFF" align="center">5 years</td>
</tr>
<tr>
<td height="30"  bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/loans/two-wheeler-loans-2/bajaj-finserv-two-wheeler-finance/"><strong>Bajaj Finserv</strong></a></td>
<td bgcolor="#FFFFFF" align="center">27% &#8211; 30%</td>
<td bgcolor="#FFFFFF" align="center">4%</td>
<td bgcolor="#FFFFFF" align="center">2 Years</td>
</tr>
<tr>
<td height="30" bgcolor="#FFFFFF">Bank of Maharashtra</td>
<td bgcolor="#FFFFFF" align="center">N.A</td>
<td bgcolor="#FFFFFF" align="center">Rs.500/-</td>
<td bgcolor="#FFFFFF" align="center">5 Years</td>
</tr>
</tbody>
</table></td>
    </tr>
  </table>
  </div>
</div>
<div style="clear:both; height:15px;"></div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>