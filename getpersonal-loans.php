<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Personal Loans | Personal Loan Rates | Personal Loan EMI</title>
<link href="stylegpl.css" rel="stylesheet" type="text/css">
<link href="media-queriesgpls.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style>

/* Big box with list of options */
#ajax_listOfOptions{
	position:absolute;	/* Never change this one */
	width:350px;	/* Width of box */
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
select:focus, input:focus
{
border:#FF9122 1px solid; 
}
</style>
<script type="text/javascript">
var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function renderpage(forValue){

var containerid = 'rateChanges';	
var for_Value;
var render_page = document.loan_form.render_page.value;
var var_Loan_Amount = document.loan_form.Loan_Amount.value;
var var_IncomeAmount = document.loan_form.IncomeAmount.value;
var var_City = document.loan_form.City.value;
if(forValue==0)
{
	for_Value = render_page;
}
else
{
	for_Value = forValue;
}
var url;
url = "personal_loan_updates.php?option=" + for_Value +"&LAmt=" + var_Loan_Amount +"&NSal=" + var_IncomeAmount +"&City=" + var_City; 
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
loadpage(page_request, containerid,for_Value)
}
if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(page_request, containerid,forValue){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
{
	//alert(forValue);
	document.loan_form.render_page.value =forValue;
	document.getElementById(containerid).innerHTML=page_request.responseText;
}
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


</script>

<script type="text/javascript">


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


function chkpersonalloan()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var i;
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;

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


	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
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
	
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	

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
		
	
	
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

		document.loan_form.accept.focus();
		return false;
	}	
	return true;

}

function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      oldonload();
      func();
    }
  }
}

function prepareInputsForHints() {
	var inputs = document.getElementsByTagName("input");
	for (var i=0; i<inputs.length; i++){
		// test to see if the hint span exists first
		if (inputs[i].parentNode.getElementsByTagName("span")[0]) {
			// the span exists!  on focus, show the hint
			inputs[i].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
			}
			// when the cursor moves away from the field, hide the hint
			inputs[i].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
			}
		}
	}
	// repeat the same tests as above for selects
	var selects = document.getElementsByTagName("select");
	for (var k=0; k<selects.length; k++){
		if (selects[k].parentNode.getElementsByTagName("span")[0]) {
			selects[k].onfocus = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "inline";
			}
			selects[k].onblur = function () {
				this.parentNode.getElementsByTagName("span")[0].style.display = "none";
			}
		}
	}
}
addLoadEvent(prepareInputsForHints);
</script>
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

function change_empstst()
{
	var occpdiv = document.getElementById('chnge_empstst');
	var occpdiv_label = document.getElementById('chnge_empstst_label');
	var occupation = document.loan_form.Employment_Status.value;
	
	if(occupation==0)
	{
		occpdiv_label.innerHTML = 'Annual Turnover';
		occpdiv.innerHTML = '  <select name="Annual_Turnover" id="Annual_Turnover" class="sbi_input" onchange="validateDiv(\'annualTurnoverVal\');"><option value="">Please Select</option>			<option value="1" > 0 - 40 Lacs</option>	<option value="4" > 40 Lacs - 1 Cr</option>		<option value="2" > 1Cr - 3Crs </option>	<option value="3" >3Crs & above</option></select><div id="annualTurnoverVal"></div>';
	}
	else
	{
		occpdiv_label.innerHTML = 'Company Name';
		occpdiv.innerHTML = ' <input type="text" name="Company_Name" id="Company_Name" class="sbi_input" onkeydown="validateDiv(\'companyNameVal\');"  onkeyup="ajax_showOptions( this, \'getCountriesByLetters\',event, \'ajax-list-plcompanies.php\')"  autocomplete="off" /> <span class="hint">Type slowly to get the Company dropdown.<span class="hint-pointer">&nbsp;</span></span>  <div id="companyNameVal"></div>';
	}
				
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="43" bgcolor="#FFFFFF" colspan="2" class="heading_text_c" >Personal Details<br><img src="images/security.png" width="14" height="16"><span class="sbi_text_a"  style="font-size:10px; font-weight:normal; color:#333333; vertical-align:bottom;"> We keep this secure</span> </td></tr><tr ><td height="35" width="27%" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c ">Name</td><td height="35" width="73%" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Name" type="text" class="sbi_input" id="Name" onKeyDown="validateDiv(\'nameVal\');" /> <div id="nameVal"></div></td></tr><tr><td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Mobile Number</td><td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Phone" type="text" class="sbi_input" id="Phone"  onchange="intOnly(this);" onKeyPress="intOnly(this)"  onKeyDown="validateDiv(\'phoneVal\');" onKeyUp="intOnly(this);" maxlength="10"; /><div id="phoneVal"></div></td></tr><tr><td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Email Id</td><td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="Email" type="text" class="sbi_input" id="Email"  onkeydown="validateDiv(\'emailVal\');" /><div id="emailVal"></div></td></tr><tr><td height="35" valign="middle" bgcolor="#FFFFFF" colspan="2" ><span style="font-size:10px; font-weight:normal;"><input type="checkbox" name="accept"  style="border:none;"/>I have read the <a href="privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="privacy.php">Terms And Condition</a>.</span></td></tr><tr><td height="0" align="center" valign="middle" bgcolor="#FFFFFF" colspan="2" >  <input type="submit" style="border: 0px none ; background-image: url(images/sbi_get_quote_btn.png); width: 148px; height: 43px; margin-bottom: 0px;" value=""/></td></tr><tr><td height="45" colspan="2" align="left"  class="sbi_home_loan_text_c" style="font-weight:normal; font-size:11px; "><strong>Disclaimer: </strong>We do not provide Personal Loans but help you to connect with banks to get best deals.<br>All loans are on sole discretion on the respective banks</td></tr></table>';

}

function addInitialDetails(val)
{
	var ni1 = document.getElementById('initialDetails');
	var ni2 = document.getElementById('divNoOne');
	var ni3 = document.getElementById('panelName');
	ni1.innerHTML = '  <div id="content"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="2"><tr><td height="35" valign="middle" bgcolor="#FFFFFF" class="heading_text_c" colspan="2"  >Professional Details</td></tr><tr><td width="27%" height="25" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Loan Amount </td><td width="73%" height="0" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input type="hidden" name="Source" id="Source" value="getpersonal-loans" /><input name="Loan_Amount" type="text" class="sbi_input" id="Loan_Amount"  onblur="getDigitToWords(\'Loan_Amount\',\'formatedlA\',\'wordloanAmount\');" onKeyPress="renderpage(0); intOnly(this);" onKeyDown="renderpage(0); validateDiv(\'loanAmtVal\');" onKeyUp="renderpage(0); intOnly(this); getDigitToWords(\'Loan_Amount\',\'formatedlA\',\'wordloanAmount\');" autocomplete="off" /><span id=\'formatedlA\' style=\'font-size:11px;font-weight:normal; color:#000;font-Family:Verdana;\'></span><span id=\'wordloanAmount\' style=\'font-size:11px;font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;\'></span>  <div id="loanAmtVal"></div></td></tr><tr><td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Employment Type</td><td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><select name="Employment_Status" class="sbi_input" id="Employment_Status" onChange="validateDiv(\'empStatusVal\'); change_empstst();" style="height:30px;" ><option value="-1">Please Select</option><option value="1">Salaried</option><option value="0">Self Employment</option></select>  <div id="empStatusVal"></div></td></tr><tr><td height="35" valign="middle" bgcolor="#FFFFFF" id="chnge_empstst_label" class="sbi_text_c">Company Name</td><td height="35" valign="middle" bgcolor="#FFFFFF" id="chnge_empstst"  class="alert_msg"><input name="Company_Name" type="text" class="sbi_input" id="Company_Name" autocomplete="off" onKeyDown="validateDiv(\'companyNameVal\');"  onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'ajax-list-plcompanies.php\')" /> <br><span class="hint" style="font-weight:normal; font-size:11px; color:#666666;" >Type slowly to get the Company dropdown.<span class="hint-pointer" >&nbsp;</span></span><div id="companyNameVal"></div></td></tr><tr><td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">City</td><td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><select name="City" class="sbi_input" id="City"  onChange="renderpage(0); validateDiv(\'cityVal\');"  style="height:30px;"><?=plgetCityList($City)?><option value="Vapi">Vapi</option><option value="Ankleshwar">Ankleshwar</option><option value="Anand">Anand</option><option value="Anand">Dahod</option><option value="Anand">Navsari</option></select><div id="cityVal"></div> </td></tr><tr><td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Net yearly Income</td><td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg"><input name="IncomeAmount" type="text" class="sbi_input" id="IncomeAmount" onFocus="addPersonalDetails();"  onblur="getDigitToWords(\'IncomeAmount\',\'formatedIncome\',\'wordIncome\');" onKeyPress="renderpage(0); addPersonalDetails(); intOnly(this);" onKeyDown="renderpage(0); validateDiv(\'netSalaryVal\');"  onkeyup="renderpage(0); intOnly(this); getDigitToWords(\'IncomeAmount\',\'formatedIncome\',\'wordIncome\');"  />    <span id=\'formatedIncome\' style=\'font-size:11px;font-weight:normal; color:#000;font-Family:Verdana;\'></span> <span id=\'wordIncome\' style=\'font-size:11px;font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;\'></span><div id="netSalaryVal"></div></td></tr><tr><td colspan="2" id="personalDetails"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2"><tr><td width="100%" height="0" align="center" valign="middle" bgcolor="#FFFFFF" ><img src="images/sbi_get_quote_btn.png" style="width: 148px; height: 43px; margin-bottom: 0px;" /></td></tr><tr><td height="45" align="left"  class="sbi_home_loan_text_c" style="font-weight:normal; font-size:11px; "><strong>Disclaimer: </strong>We do not provide Personal Loans but help you to connect with banks to get best deals.<br>All loans are on sole discretion on the respective banks</td></tr></table></td></tr></table></div>';
	ni2.innerHTML = '';

	if(val==1)	{	ni3.innerHTML = '<input type="hidden" name="panel" id="panel" value="Banks with Lowest Interest Rates" />';	}
	else if(val==2)	{	ni3.innerHTML = '<input type="hidden" name="panel" id="panel" value="No Prepayment Charges + Lowest Interest Rates" />';	}
	else if(val==3)	{	ni3.innerHTML = '<input type="hidden" name="panel" id="panel" value="No Processing Fee + Lowest Interest Rates" />';	}
	else if(val==4)	{	ni3.innerHTML = '<input type="hidden" name="panel" id="panel" value="Fastest Loan Approval" />';	}
	else if(val==5)	{	ni3.innerHTML = '<input type="hidden" name="panel" id="panel" value="All of above" />';	}			
}
</script>
</head>
<body>
<form method="post" name="loan_form" action="insertPL1.php" onSubmit="return chkpersonalloan();">
<div id="pagewrap">
<header id="header">
<div class="heading_text">Compare Personal Loan, Get your eligibility & Quotes from different Banks</div>
<div style="width:1000px; margin:auto; text-align:right; font-family:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold; color:#FFF; line-height:40px;">
Deal4loans.com </div></header>
<div class="Sbi_home-laon-top_ad_box" style="margin-top:-5px; width:1024px; text-align:right; color:#fff; font-weight:bold; font-size:18px;">&nbsp;</div>
<div class="second_wrapper">
<div style="clear:both;"></div>
	<div class="right-box-c" ><h4 class="heading_text_b">Top Personal loan Banks - Sbi </h4>
			<span class="hdfc-bank
"><span class="sbi-bank">(State Bank)</span>, Hdfc Bank</span>, <span class="axis-bank">Axis Bank</span>,<br> 
			<span class="bajaj-finserv">
			Bajaj Finserv</span>, <span class="kotak">Kotak</span>, 
<span class="ing-vysya">Ing Vsaya,</span> <span class="fullerton">Fullerton</span>, <span class="pnb-bank">PNB</span>  <strong>and </strong><span class="Standard-Chart">Standard Chartered.</span></div>
 <div  id="divNoOne">
       <div class="new_left_main_wrapper">
     <div class="new_head-text">I need a Personal Loan with</div>
     <div class="new_box_wrapper" style="margin-top:10px;">
  <a href="#" onClick="addInitialDetails('1'); renderpage('1');">
  <div class="inner_box">
 <table width="98%" border="0">
  <tr>
    <td width="16%" height="75"><span style="font-size:36px; font-weight:normal;">1.</span></td>
    <td width="84%">Banks with Lowest Interest Rates</td>
  </tr>
  </table>
       </div></a>
       <a href="#" onClick="addInitialDetails('2'); renderpage('2');">
       <div class="inner_box">
        <table width="98%" border="0">
  <tr>
    <td width="16%" height="75"><span style="font-size:36px; font-weight:normal;">2.</span></td>
    <td width="84%">No Prepayment Charges + Lowest Interest Rates</td>

  </tr>
   </table>

       </div>
</a>
     <div style="clear:both; height:10px;"></div>
     <a href="#" onClick="addInitialDetails('3'); renderpage('3');">
          <div class="inner_box">
            <table width="98%" border="0">
              <tr>
                <td width="16%" height="75"><span style="font-size:36px; font-weight:normal;">3.</span></td>
                <td width="84%">Low Processing Fee + <br>
                Lowest Interest Rates</td>
              </tr>
            </table>
          </div>
          </a>
          <a href="#" onClick="addInitialDetails('4'); renderpage('4');">
       <div class="inner_box">
         <table width="98%" border="0">
           <tr>
             <td width="16%" height="75"><span style="font-size:36px; font-weight:normal;">4.</span></td>
             <td width="84%">Fastest Loan Approval</td>
           </tr>
         </table>
       </div></a>
       <div style="clear:both; height:10px;"></div>
       <a href="#" onClick="addInitialDetails('5'); renderpage('5');">
       <div class="inner_below_box">
         <table width="98%" border="0">
           <tr>
             <td width="16%" height="75"><span style="font-size:36px; font-weight:normal;">5.</span></td>
             <td width="84%" valign="middle">All of the above </td>
           </tr>
         </table>
       </div>
       </a>
     </div>
	</div>
</div>
  <div id="initialDetails"></div>
	<div id="panelName"></div>
	<aside id="sidebar">
		<section class="widget">
		 	  <div class="right-box-d" id="rateChanges">
          <?php
   	$selectSql = "select * from personal_loan_updates where option5_priority >0 and status=1";
	$selectSql .=  " order by option5_priority asc"; 
	list($countQuery,$selectQuery)=MainselectfuncNew($selectSql,$array = array());
	?>
<h4 class="heading_text_b">Top Personal loan Banks</h4>
              <table cellpadding="0" cellspacing="2" border="0" style="width:325px; border:1px #333333 solid;" >
              <tr><td width="94" align="center" style="color:#FFFFFF; background-color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;">Bank Name</td>
              <td width="110" align="center" style="color:#FFFFFF; background-color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; border-left:1px #fff solid;">Interest Rate</td>
              <td width="111" align="center" bgcolor="#333333" style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; border-left:1px #fff solid;">Processing Fee</td>
              </tr>
              <?php
			  for($i=0;$i<$countQuery;$i++)
			  {	  
			  		$bank_name = $selectQuery[$i]['bank_name'];
					$interest_rates = $selectQuery[$i]['interest_rates'];
					$processing_fee = $selectQuery[$i]['processing_fee'];
					if($bank_name=="Axis Bank")
					{ $class = 'class="axis-bank"';	}
					else if($bank_name=="ICICI Bank")
					{ $class = 'class="icici-bank"'; }
					else if($bank_name=="Bajaj Finserv")
					{ $class = 'class="bajaj-finserv"'; }
					else if($bank_name=="Ing Vysya")
					{ $class = 'class="ing-vysya"'; }
					else if($bank_name=="Kotak")
					{ $class = 'class="kotak"'; }
					else if($bank_name=="HDFC Bank")
					{ $class = 'class="hdfc-bank"'; }
					else if($bank_name=="Standard Chartered")
					{ $class = 'class="Standard-Chart"'; }
					else if($bank_name=="HDBFS")
					{ $class = 'class="hdfc-bank"'; }
					else if($bank_name=="Fullerton")
					{ $class = 'class="fullerton"'; }
										
			  ?>
              <tr><td <?php echo $class; ?>><?php echo $bank_name; ?></td><td align="center" <?php echo $class; ?>><?php echo $interest_rates; ?></td><td  <?php echo $class; ?> align="center"><?php echo $processing_fee; ?></td></tr>
              <?php 
			  }
			  ?>
              </table>

</div>

<div class="right-box">
  <span class="heading_text_b">On next Page see Interest Rates from - Sbi (State Bank)</span>,<span class="hdfc-bank
">Hdfc Bank</span>, <span class="axis-bank">Axis Bank</span>, <span class="bajaj-finserv">
		Bajaj Finserv</span>, <span class="kotak">Kotak</span>, 
        <span class="ing-vysya">Ing Vsaya,</span> <span class="fullerton">Fullerton</span>, <span class="pnb-bank">PNB</span>  <strong>and</strong> <span class="Standard-Chart">Standard Chartered.</span>
</div>


<div class="sbi_text_bullet">
<ul>
<li>Personal loans from 50000 - 3000000.</li>
<li>Rate quote in 30 sec with best rates.</li>
<li>0% Prepayment offers.</li>
<li>Special offers On Processing Fee.</li>
</ul>
  
</div>

		</section>
	</aside>
	
	
</div>
</div>
  <input type="hidden" name="render_page" id="render_page" />
</form>
</body>
</html>