<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Credit Cards - Deal4loans</title>

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
	<script type="text/javascript" src="ajax.js"></script>
	<script type="text/javascript" src="list_hdfc.js"></script>
	<script src='scripts/digitToWordConverthdfc.js' type='text/javascript' language='javascript'></script>
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;
	background-image:url(new-images/hdfc-gold/bg.gif);

}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}
form{
margin:0px;
padding:0px;

}

.bldtxt{
font-weight:bold;
color:#4f4d4d;
 }


.txt ul{
	margin:0px;
	padding:0px;
}

.txt ul li{
	background: url(new-images/hdfc-gold/arrow.gif) no-repeat 0px 6px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}

	/* START CSS NEEDED ONLY IN DEMO */

	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;
		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:195px;	/* Width of box */
		height:100px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #666666;	/* Dark green border */
		background-color:#FFFFFF;	/* White background color */
   		color: #333333;
		text-align:left;
		font-size:9px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:11px;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#3d87d4;
		line-height:20px;
		color:#FFFFFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	
	
	#dhtmlgoodies_tooltip{
		background-color:#EEE;
		border:1px solid #000;
		position:absolute;
		display:none;
		margin-left:-13px;
		z-index:20000;
		padding:0px;
		font-size:0.9em;
		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;
		
	}
	#dhtmlgoodies_tooltipShadow{
		position:absolute;
		background-color:#555;
		display:none;
		margin-left:-13px;
		z-index:10000;
		opacity:0.7;
		filter:alpha(opacity=70);
		-khtml-opacity: 0.7;
		-moz-opacity: 0.7;
	}
	

</style>
	<SCRIPT type="text/javascript">
	var dhtmlgoodies_tooltip = false;
	var dhtmlgoodies_tooltipShadow = false;
	var dhtmlgoodies_shadowSize = 4;
	var dhtmlgoodies_tooltipMaxWidth = 200;
	var dhtmlgoodies_tooltipMinWidth = 100;
	var dhtmlgoodies_iframe = false;
	var tooltip_is_msie = (navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('opera')==-1 && document.all)?true:false;
	function showTooltip(e,tooltipTxt)
	{
		
		var bodyWidth = Math.max(document.body.clientWidth,document.documentElement.clientWidth) - 20;
	
		if(!dhtmlgoodies_tooltip){
			dhtmlgoodies_tooltip = document.createElement('DIV');
			dhtmlgoodies_tooltip.id = 'dhtmlgoodies_tooltip';
			dhtmlgoodies_tooltipShadow = document.createElement('DIV');
			dhtmlgoodies_tooltipShadow.id = 'dhtmlgoodies_tooltipShadow';
			
			document.body.appendChild(dhtmlgoodies_tooltip);
			document.body.appendChild(dhtmlgoodies_tooltipShadow);	
			
			if(tooltip_is_msie){
				dhtmlgoodies_iframe = document.createElement('IFRAME');
				dhtmlgoodies_iframe.frameborder='5';
				dhtmlgoodies_iframe.style.backgroundColor='#FFFFFF';
				dhtmlgoodies_iframe.src = '#'; 	
				dhtmlgoodies_iframe.style.zIndex = 100;
				dhtmlgoodies_iframe.style.position = 'absolute';
				document.body.appendChild(dhtmlgoodies_iframe);
			}
			
		}
		
		dhtmlgoodies_tooltip.style.display='block';
		dhtmlgoodies_tooltipShadow.style.display='block';
		if(tooltip_is_msie)dhtmlgoodies_iframe.style.display='block';
		
		var st = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
		if(navigator.userAgent.toLowerCase().indexOf('safari')>=0)st=0; 
		var leftPos = e.clientX + 10;
		
		dhtmlgoodies_tooltip.style.width = null;	// Reset style width if it's set 
		dhtmlgoodies_tooltip.innerHTML = tooltipTxt;
		dhtmlgoodies_tooltip.style.left = leftPos + 'px';
		dhtmlgoodies_tooltip.style.top = e.clientY + 10 + st + 'px';

		
		dhtmlgoodies_tooltipShadow.style.left =  leftPos + dhtmlgoodies_shadowSize + 'px';
		dhtmlgoodies_tooltipShadow.style.top = e.clientY + 10 + st + dhtmlgoodies_shadowSize + 'px';
		
		if(dhtmlgoodies_tooltip.offsetWidth>dhtmlgoodies_tooltipMaxWidth){	/* Exceeding max width of tooltip ? */
			dhtmlgoodies_tooltip.style.width = dhtmlgoodies_tooltipMaxWidth + 'px';
		}
		
		var tooltipWidth = dhtmlgoodies_tooltip.offsetWidth;		
		if(tooltipWidth<dhtmlgoodies_tooltipMinWidth)tooltipWidth = dhtmlgoodies_tooltipMinWidth;
		
		
		dhtmlgoodies_tooltip.style.width = tooltipWidth + 'px';
		dhtmlgoodies_tooltipShadow.style.width = dhtmlgoodies_tooltip.offsetWidth + 'px';
		dhtmlgoodies_tooltipShadow.style.height = dhtmlgoodies_tooltip.offsetHeight + 'px';		
		
		if((leftPos + tooltipWidth)>bodyWidth){
			dhtmlgoodies_tooltip.style.left = (dhtmlgoodies_tooltipShadow.style.left.replace('px','') - ((leftPos + tooltipWidth)-bodyWidth)) + 'px';
			dhtmlgoodies_tooltipShadow.style.left = (dhtmlgoodies_tooltipShadow.style.left.replace('px','') - ((leftPos + tooltipWidth)-bodyWidth) + dhtmlgoodies_shadowSize) + 'px';
		}
		
		if(tooltip_is_msie){
			dhtmlgoodies_iframe.style.left = dhtmlgoodies_tooltip.style.left;
			dhtmlgoodies_iframe.style.top = dhtmlgoodies_tooltip.style.top;
			dhtmlgoodies_iframe.style.width = dhtmlgoodies_tooltip.offsetWidth + 'px';
			dhtmlgoodies_iframe.style.height = dhtmlgoodies_tooltip.offsetHeight + 'px';
		
		}
				
	}
	
	function hideTooltip()
	{
		dhtmlgoodies_tooltip.style.display='none';
		dhtmlgoodies_tooltipShadow.style.display='none';		
		if(tooltip_is_msie)dhtmlgoodies_iframe.style.display='none';		
	}
	
	</SCRIPT>	

<Script Language="JavaScript">
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
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}


function submitform(Form)
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
{
alert("Kindly fill in your Name!");
document.loan_form.Name.select();
return false;
}
else if(containsdigit(Form.Name.value)==true)
{
alert("Name contains numbers!");
Form.Name.select();
return false;
}
  for (var i = 0; i < Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Name.select();
  	return false;
  	}
  }
if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
alert("Kindly enter your Date of Birth");
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
alert("Kindly enter your Date of Birth(numbers Only)");
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
alert("Kindly Enter your valid Date of Birth(Range 1-31)");
Form.day.select();
return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
alert("Kindly enter your Month of Birth(numbers Only)");
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
alert("Kindly Enter your valid Month of Birth(Range 1-12)");
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
alert("Month February cannot have more than 29 days");
Form.day.select();
return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
alert("Kindly enter your Year of Birth");
Form.year.select();
return false;
}

else if(!num.test(Form.year.value))
{
alert("Kindly enter your Year of Birth(numbers Only) !");
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
alert("February cannot have more than 28 days.");
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
Form.year.select();
return false;
}
else if((Form.year.value < "1948") || (Form.year.value >"1992"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
Form.year.select();
return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}

	if(Form.Phone.value=="")
	{
		alert("Please Enter Mobile Number");
		Form.Phone.focus();
		return false;
	}

if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
	{
		  alert("Enter numeric value");
		  Form.Phone.focus();
		  return false;  
	}
	if (Form.Phone.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			 Form.Phone.focus();
			return false;
	}
	if (Form.Phone.value.charAt(0)!="9" && Form.Phone.value.charAt(0)!="8")
	{
			alert("The number should start only with 9 or 8");
			 Form.Phone.focus();
			return false;
	}
	
	if(Form.Email.value=="")
	{
		alert("Please enter  Email Address");
		Form.Email.focus();
		return false;
	}
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	
	
	if(aa==-1)
	{
		alert("Please enter the valid Email Address");
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Please enter the valid Email Address");
		Form.Email.focus();
		return false;
	}


if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
alert("Kindly fill in your other City!");
Form.City_Other.focus();
return false;
}

if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select Employment Status to Continue");
	Form.Employment_Status.focus();
	return false;
}

if(Form.Employment_Status.value=="Salaried")
{
	
	if(Form.company_name.value=="")
	{
		alert("Please Enter Company Name");
		Form.company_name.focus();
		return false;
	}
	
	if(Form.Net_Salary.value=='')
	{
		alert("Please enter Monthly income to Continue");
		Form.Net_Salary.focus();
		return false;
	}
	if(Form.Net_Salary.value.charAt(0)=="0")
	{
		alert("Please enter Monthly income to Continue");
		Form.Net_Salary.focus();
		return false;
	}
	
	if(Form.hdfc_account.selectedIndex==0)
	{
		alert("Please select Do you have HDFC Account");
		Form.hdfc_account.focus();
		return false;
	}
	
	/*if(Form.hdfc_account.value=="Salary Account" || Form.hdfc_account.value=="Non-Salary Account" )
	{
		if(Form.average_balance.value=='')
		{
			alert("Please enter Average Balance Continue");
			Form.average_balance.focus();
			return false;
		}
	}*/
	
}
else if(Form.Employment_Status.value=="Self Employed")
{
	if(Form.hdfc_account.selectedIndex==0)
	{
		alert("Please select Do you have HDFC Account");
		Form.hdfc_account.focus();
		return false;
	}
}

	if(Form.Applied_status.selectedIndex==0)
	{
		alert("Please select Applied Status");
		Form.Applied_status.focus();
		return false;
	}



if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}

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


function getEmploymentFields()
{

	var ni = document.getElementById('getEmployment');
	
	if(document.loan_form.Employment_Status.value=="Salaried")
	{
		ni.innerHTML = '<table border="0" width="100%"> <tr>    <td height="26" align="right" class="bldtxt" width="46%">Company Name :</td>    <td align="left"  width="54%"><input type="text" name="company_name" id="company_name" onkeyup="ajax_showOptions(this,\'getCollegesByLetters\',event)" style="width:140px; color:silver;" onFocus=\'if(this.value=="Type slowly for autofill") {this.value="";this.style.color="black";}\' onBlur=\'if(this.value==""){this.value="Type slowly for autofill";this.style.color="silver";}\' value=\'Type slowly for autofill\'  onmouseout=\'hideTooltip()\' onmouseover=\'showTooltip(event,"Slowly start typing your employers name and choose from recommendations provided?"); return false\' /></td></tr><tr><td height="26" align="right" class="bldtxt">Monthly Take Home :</td><td align="left"><input style="width:140px; " value="" name="Net_Salary" id="Net_Salary" onFocus="this.select();"  onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords(\'Net_Salary\',\'formatedlA\',\'wordloanAmount\');" onKeyPress="intOnly(this); getDigitToWords(\'Net_Salary\',\'formatedlA\',\'wordloanAmount\');" onKeyDown="getDigitToWords(\'Net_Salary\',\'formatedlA\',\'wordloanAmount\');" onBlur="getDigitToWords(\'Net_Salary\',\'formatedlA\',\'wordloanAmount\');" onmouseout=\'hideTooltip()\' onmouseover=\'showTooltip(event,"This is your net monthly salary as credited in your account after deductions."); return false\' ></td></tr><tr><td colspan="2" class="frmbldtxt"><span id=\'formatedlA\' style=\'font-size:11px; font-weight:normal; color:#333333;font-Family:Verdana;\'></span><span id=\'wordloanAmount\' style=\'font-size:11px; font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;\'></span></td></tr><tr>    <td height="26" align="right" class="bldtxt" >Have an HDFC  Account :</td> <td align="left"><select size="1" align="left" style="width:142px;"  name="hdfc_account" id="hdfc_account" ><option value="">Please Select</option><option value="Salary Account">Salary Account</option> <option value="Non-Salary Account">Non-Salary Account</option><option value="No">Not having Account</option> </select></td></tr><tr><td colspan="2" id="addAverageBal"></td></tr></table>';
	}
	else if(document.loan_form.Employment_Status.value=="Self Employed")
	{
		ni.innerHTML = '<table border="0" width="100%"><tr><td height="26" align="right" class="bldtxt" width="45%">Have an HDFC savings account?</td>    <td align="left"  width="55%"><select size="1" align="left" style="width:142px;"  name="hdfc_account" id="hdfc_account" onChange="addAverageBalanceNSal();" ><option value="">Please Select</option><option value="Yes">Yes</option> <option value="No">No</option> </select></td></tr><tr><td colspan="2" id="addAverageBalSal"></td></tr></table>';	
	}
	else
	{
		ni.innerHTML = '';
	}
}

function addAverageBalance()
{
	var ni = document.getElementById('addAverageBal');

	if(document.loan_form.hdfc_account.value=="Salary Account" || document.loan_form.hdfc_account.value=="Non-Salary Account")
	{
		ni.innerHTML = '<table border="0" width="100%"><tr><td height="26" align="left" class="bldtxt" width="45%">Average balance of HDFC Account</td><td align="left"  width="55%"><input style="width:140px;" name="average_balance" id="average_balance" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onmouseout=\'hideTooltip()\' onmouseover=\'showTooltip(event,"This is your average balance of HDFC account in past 6 months."); return false\' ></td></tr></table>';
	}
	else
	{
		ni.innerHTML = '';
	}
}

function addAverageBalanceNSal()
{
	var ni = document.getElementById('addAverageBalSal');

	if(document.loan_form.hdfc_account.value=="Yes")
	{
		ni.innerHTML = '<table border="0" width="100%"><tr><td height="26" align="right" class="bldtxt" width="45%">Average balance of HDFC Account</td><td align="left"  width="55%"><input style="width:140px;" name="average_balance" id="average_balance" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onmouseout=\'hideTooltip()\' onmouseover=\'showTooltip(event,"This is your average balance of HDFC account in past 6 months."); return false\' ></td></tr></table>';
	}
	else
	{
		ni.innerHTML = '';
	}
}


function addOtherCity()
{
		var ni = document.getElementById('getothercity');
		if(document.loan_form.City.value=="Others")
		{
			ni.innerHTML = '<table border="0" width="100%"><tr><td height="26" width="46%" align="right" class="bldtxt">Other City : </td>	<td align="left" width="54%"><input style="width:140px;" name="City_Other"></td></tr></table>';	
		}
		else
		{
			ni.innerHTML = '';
		}
		return true;
	}


function addToolTips()
{

	var ni = document.getElementById('getTool_Tip');
		ni.innerHTML = '<div style="width:240px; background-color:#ffffd9; border:2px solid #fdf279; font-family: Arial, Helvetica, sans-serif; font-size:10px; color:#999999; font-weight:normal; padding-left:2px; text-align:left; "><b>Tip:</b> Having an existing credit card from another bank may help you qualify for an HDFC credit card. If you have more than one card from another bank, please mention all cards.</div>';	
	return true;
}

function deleteToolTips()
{
	var ni = document.getElementById('getTool_Tip');
		ni.innerHTML = '';	
	return true;
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

		function insertData()
		{}


	window.onload = ajaxFunction;


</script>
<script language="javascript">
function insRows()
{
	 var ni = document.getElementById('addTableC');
	 if(ni.innerHTML=="")
	 {
		 ni.innerHTML="<img src='images/add.gif' alt='Add' onclick='insRow(this);'><br /><table width='100%'  border='0' cellpadding='0' cellspacing='0'><tr><td width='5' class='bldtxt'>&nbsp;</td><td width='401' align='left' class='bldtxt'>Credit Card </td><td width='325' align='left' class='bldtxt'>Member since </td><td width='208' align='left'  class='bldtxt'>Card Limit</td><td width='50'>&nbsp;</td></tr></table>";
	 }
}
function insRow()
{
	 var i=document.getElementById('myTable').rows.length;
	 var ni = document.getElementById('countoftable');
	 ni.innerHTML ="<input type='hidden' name='CountOfTable' value='"+ i +"'>";
	 var x=document.getElementById('myTable').insertRow(document.getElementById('myTable').rows.length)
	 var y=x.insertCell(0)
//alert(i);
	if(i==0)
	{
	 	 y.innerHTML="<table  border='0' width='98%' cellpadding='0' cellspacing='0' bgcolor='#f4f4f4'> <tr><td width='39%' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: normal; color:#FFFFFF; '><select name='cc_bank_name_"+ i +"' style=' width:135px;' align='left' ><option value=''>Select Bank</option><option value='ABN AMRO'>ABN AMRO</option><option value='AMERICAN EXPRESS BANK LTD'>AMERICAN EXPRESS</option><option value='ANDHRA BANK'>ANDHRA BANK	</option><option value='AXIS BANK'>AXIS BANK</option><option selected='selected' value='CITIBANK'>CITIBANK	</option><option value='DEUTSCHE BANK'>DEUTSCHE BANK</option><option value='HDFC BANK'>HDFC BANK	</option>	<option value='HSBC BANK'>HSBC BANK	</option>	<option value='ICICI BANK'>ICICI BANK</option><option value='KOTAK MAHINDRA'>KOTAK MAHINDRA	</option>	<option value='STANDARD CHARTERED BANK'>STANDARD CHARTERED</option><option value='STATE BANK OF INDIA (SBI)'>STATE BANK OF INDIA (SBI)	</option>	<option value='OTHER BANK'>OTHER</option></select></td><td width='39%' style='font-size:11px;'  align='left'>   <select name='cc_bank_year_"+ i +"' style='width:60px;' >    <option value=''  selected='selected'>Year</option>    <option value='2010'>2010</option><option value='2009'>2009</option><option  value='2008'>2008</option>    <option value='2007'>2007</option><option value='2006'>2006</option>    <option value='2005'>Before 2006</option></select>  <select  name='cc_bank_month_"+ i +"' style='width:55px;' >    <option selected='selected' value=''>MMM</option><option value='1'>Jan</option><option value='2'>Feb</option>    <option value='3'>Mar</option><option value='4'>Apr</option><option value='5'>May</option><option value='6'>Jun</option>    <option value='7'>Jul</option><option value='8'>Aug</option><option value='9'>Sep</option><option value='10'>Oct</option>    <option value='11'>Nov</option>    <option value='12'>Dec</option></select></td><td width='20%' style='font-size:11px;'  align='left'>       <input type='text' title='Rs.' name='cc_bank_limit_"+ i +"' style='width:55px;' onChange='intOnly(this);'  onKeyUp='intOnly(this);' onKeyPress='intOnly(this);' /></td><td width='2%' align='left'>&nbsp;</td>  </tr></table>";
	 }
	 else
	 {
	 	 y.innerHTML="<table  border='0' width='98%' cellpadding='0' cellspacing='0' bgcolor='#f4f4f4'> <tr><td width='39%' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 12px; font-weight: normal; color:#FFFFFF; '><select name='cc_bank_name_"+ i +"' style=' width:135px;' align='left' ><option value=''>Select Bank</option><option value='ABN AMRO'>ABN AMRO</option><option value='AMERICAN EXPRESS BANK LTD'>AMERICAN EXPRESS</option><option value='ANDHRA BANK'>ANDHRA BANK	</option><option value='AXIS BANK'>AXIS BANK</option><option selected='selected' value='CITIBANK'>CITIBANK	</option><option value='DEUTSCHE BANK'>DEUTSCHE BANK</option><option value='HDFC BANK'>HDFC BANK	</option>	<option value='HSBC BANK'>HSBC BANK	</option>	<option value='ICICI BANK'>ICICI BANK</option><option value='KOTAK MAHINDRA'>KOTAK MAHINDRA	</option>	<option value='STANDARD CHARTERED BANK'>STANDARD CHARTERED</option><option value='STATE BANK OF INDIA (SBI)'>STATE BANK OF INDIA (SBI)	</option>	<option value='OTHER BANK'>OTHER</option></select></td><td width='39%' style='font-size:11px;'  align='left'>   <select name='cc_bank_year_"+ i +"' style='width:60px;' >    <option value=''  selected='selected'>Year</option>    <option value='2010'>2010</option><option value='2009'>2009</option><option  value='2008'>2008</option>    <option value='2007'>2007</option><option value='2006'>2006</option>    <option value='2005'>Before 2006</option></select>  <select  name='cc_bank_month_"+ i +"' style='width:55px;' >    <option selected='selected' value=''>MMM</option><option value='1'>Jan</option><option value='2'>Feb</option>    <option value='3'>Mar</option><option value='4'>Apr</option><option value='5'>May</option><option value='6'>Jun</option>    <option value='7'>Jul</option><option value='8'>Aug</option><option value='9'>Sep</option><option value='10'>Oct</option>    <option value='11'>Nov</option>    <option value='12'>Dec</option></select></td><td width='20%' style='font-size:11px;'  align='left'>       <input type='text' title='Rs.' name='cc_bank_limit_"+ i +"' style='width:55px;' onChange='intOnly(this);'  onKeyUp='intOnly(this);' onKeyPress='intOnly(this);' /></td><td width='2%' align='left'> <img src='images/crossarrow.gif' width='10' alt='Remove' onclick='deleteRow(this);'></td>  </tr></table>";
	 }
 }
 
 function deleteRow(r)
 {
	 var i=r.parentNode.parentNode.rowIndex
	 i=i+1;
	 document.getElementById('myTable').deleteRow(i)
	 var j=document.getElementById('myTable').rows.length;
     j=j-1;
    var ni = document.getElementById('countoftable');
	ni.innerHTML ="<input type='hidden' name='CountOfTable' value='"+ j +"'>";
 }
 
 function deleteRow1(r)
 {
	var ni = document.getElementById('myTable');
	 var ni1 = document.getElementById('addTableC');
	ni.innerHTML ="";
	ni1.innerHTML ="";
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

 
 // Type slowly for autofill
</script>

</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:1px solid #eadbc8; ">
  <tr>
    <td height="200" valign="top"><table width="946" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="237" height="185"><img src="new-images/hdfc-gold/hdr1.gif" width="237" height="185" /></td>
        <td width="227"><img src="new-images/hdfc-gold/hdr2.gif" width="227" height="185" /></td>
        <td width="242"><img src="new-images/hdfc-gold/hdr3.gif" width="242" height="185" /></td>
        <td width="240"><img src="new-images/hdfc-gold/hdr4.gif" width="240" height="185" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="8" cellpadding="0">
      <tr valign="top">
        <td width="484"><table cellspacing="0" cellpadding="4" width="100%" border="0">
      
        
        <tr> 
          <td width="100%" align="left" valign="top" class="txt">
		  <ul>
		  <li><b>Attractive Reward Points</b>*<br />
             Earn 1 reward point per Rs 150 spent on the Gold Credit Card.</li>
		   <li><b>Rewards points redemption</b><br />
After earning all those reward points on your HDFC Bank Gold Credit Card, redeem them for exciting gifts and services! You could even convert them to airline miles with India's leading airlines through the MyRewards programme.</li>
		   <li><b>Worldwide acceptance</b><br />
Accepted at over 23 million Merchant Establishments around the world, including 110,000 Merchant Establishments in India.</li>
		   <li><b>Revolving credit facility </b><br />
Pay a minimum amount, which is 5% (subject to a minimum amount of Rs.200) of your total bill amount or any higher amount whichever is convenient and carry forward the balance to a better financial month. For this facility you pay a nominal charge of just 3.25% per month (39.0% annually).</li>
		   <li><b>Free Add-on card</b><br />
You can share these wonderful features with your loved ones too - we offer the facility of an add-on card for your spouse, children or parents. Allow us to offer add-on cards to you FREE OF COST with our compliments.</li>
		   <li><b>Interest free credit facility </b><br />
Avail of up to 50 days of interest free period from the date of purchase (subject to the submission of the charge by the Merchant).</li>
		   <li><b>Zero liability on lost card</b><br />
If you happen to lose your Card, report it immediately to our 24-hour call centre. After reporting the loss, you carry zero liability on any fraudulent transactions on your card.</li>
		   </ul>
 
          </td>
        </tr>

    </table></td>
        <td width="450" valign="top">
		<form name="loan_form" method="post" action="hdfc-credit-cards-continue.php" onSubmit="return submitform(document.loan_form);">

<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center" style="color:#FF0000; font-weight:bold;"><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></div>
		<table width="450"  border="0" align="right" cellpadding="0" cellspacing="0" background="new-images/hdfc-gold/frm-bg.gif"  >
			  <tr>
                <td width="450" height="42"    align="center" valign="bottom"><img src="new-images/hdfc-gold/frm-hdng.gif" width="450" height="42" /></td>
			 </tr>
			  <tr>
                <td  align="center" valign="top" > <table width="98%"  border="0" align="right" cellpadding="0" cellspacing="0">
  <tr>
    <td height="15" colspan="3" align="right" ></td>
    </tr>
  <tr>
	<td width="192" height="30" align="right" class="bldtxt">Full Name</td>
	<td width="12" align="center" class="bldtxt">:</td>
	<td width="235" align="left"><input style="width:140px;"  name="Name" id="Name" >	</td>
  </tr>
  <tr>
	<td height="30" align="right" class="bldtxt">Date of Birth </td>
	<td align="center" class="bldtxt">:</td>
	<td align="left"><input name="day" value="dd" type="text" id="day" style="width:38px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');">
			<input name="month" id="month" style="width:38px;" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"  onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');">
			<input name="year" type="text" id="year" value="yyyy" style="width:52px;" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');">	</td>
  </tr>
  <tr>
	<td height="30" align="right" class="bldtxt">Mobile No. </td>
	<td align="center" class="bldtxt">:</td>
	<td align="left">+91 
	  <input  style="width:112px; " type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  name="Phone" id="Phone" ></td>
  </tr>
  <tr>
	<td height="30" align="right" class="bldtxt">Email Id </td>
	<td align="center" class="bldtxt">:</td>
	<td align="left"><input  style="width:140px; "   name="Email" id="Email"  /></td>
  </tr>
    <tr>
	<td height="30" align="right" class="bldtxt">Gender</td>
	<td align="center" class="bldtxt">:</td>
	<td align="left">
	<input name="Gender" type="radio" value="male" checked="checked"  style="border:none; " /> Male <input name="Gender" type="radio" value="female"   style="border:none; " /> Female
	</td>
  </tr>
  <tr>
	<td height="30" align="right" class="bldtxt">City</td>
	<td align="center" class="bldtxt">:</td>
	<td align="left"><select size="1" align="left" style="width:142px;"  name="City" id="City" onChange="addOtherCity();" >
           <?=getCityList1($City)?>
         </select></td>
  </tr>
  <tr><td  colspan="3" id="getothercity"></td>
  </tr>
  
 <tr>
    <td height="30" align="right" class="bldtxt">Employment Status</td>
    <td align="center" class="bldtxt">:</td>
    <td align="left"><select  style="width:142px;"   name="Employment_Status" onChange="getEmploymentFields();">
				<option selected value="-1">Employment Status</option>
				<option  value="Salaried">Salaried</option>
				<option value="Self Employed">Self Employed</option>
				</select></td>
  </tr>
 
 <tr ><td colspan="3" id="getEmployment"></td>
 </tr>
<tr>
	<td height="30" align="right" class="bldtxt">Applied in last 6 months</td>
    <td align="center" class="bldtxt">:</td>
    <td align="left"><select  style="width:142px;" name="Applied_status">
				<option selected value="">Please Select</option>
				<option  value="Yes">Yes</option>
				<option value="No">No</option>
				</select></td>
  </tr>
  <tr>
	<td height="30" align="right" class="bldtxt">Credit Card Holder</td>
    <td align="center" class="bldtxt">:</td>
    <td align="left"><input type="radio" name="cc_status" id="cc_status" value="Yes" onClick="insRows(); insRow(); deleteToolTips();"   style="border:none; "/> Yes <input type="radio" name="cc_status" id="cc_status" value="No" checked onClick="addToolTips(); deleteRow1(this); "   style="border:none; "/> No</td>
	</tr>
 
   <tr><td colspan="3" align="left" id="addTableC"></td></tr>
   <tr>
		<td align="right" class="bldtxt" colspan="3"><table id="myTable" width='100%'></table></td>
  </tr>
 
   <tr><td colspan="3" align="left" id="countoftable"></td></tr>
   <tr><td colspan="3" align="right"  id="getTool_Tip"><div style="width:240px; background-color:#ffffd9; border:2px solid #fdf279; font-family: Arial, Helvetica, sans-serif; font-size:10px; color:#999999; font-weight:normal; padding:2px; text-align:left; ">
<b>Tip:</b> Having an existing credit card from another bank may help you qualify for an HDFC credit card. If you have more than one card from another bank, please mention all cards.</div></td></tr>
  <tr>
    <td colspan="3" align="left" style="padding-top:10px; " >
	<input type="hidden" name="Activate" id="Activate" ><input type="checkbox"  name="accept" style="border:none; " checked> 
	I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree 
      to the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms And Condition</a>.</td>
    </tr>
  <tr valign="bottom">
    <td height="40" colspan="3" align="center"><input  type="image" src="new-images/hdfc-gold/sbtn.gif" style="border: 0px;"></td>
    </tr>
</table>
 </td>
              </tr>
			  <tr>
			    <td height="15"  align="center" valign="top" bgcolor="#FFFFFF"><img src="new-images/hdfc-gold/frm-btm.gif" width="450" height="15" /></td>
		      </tr>
</table>
</form>
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>
