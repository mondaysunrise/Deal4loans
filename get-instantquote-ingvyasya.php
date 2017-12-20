<?php
session_start();
	//require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
$cityList = 
'Agra,Ahmedabad,Surat,Vadodara,Gwalior,Vidisha,Hoshangabad,Itarsi,Ambala,Shimla,Chandigarh,Mandi,Patiala,Baddi,Mohali,Trivandrum,Kochi,Thrissur,Coimbatore,Erode,Ooty,Salem,Namakkal,Udumalpet,Rishikesh,Haridwar,Jamshedpur,Siliguri,Cuttack,Bhubaneshwar,Indore,Bhopal,Ujjain,Dewas,Ratlam,Mandsour,Neemuch,Jabalpur,Katni,Satna,Rewa,Singrauli,Jaipur,Ajmer,Alwar,Jodhpur,Bikaner,Pali,Ganganagar,Sonepat,Bahadhurgarh,Kurukshetra,Hisar,Kanpur,Jhansi,Lucknow,Meerut,Agra,Madurai,Tirunelveli,Nagercoil,Tuticorin,Rajapalayam,Sivakasi,Palani,Ramanathapuram,Nagpur,Nasik,Goa,Panaji,Margao,Vasco,Mapusa,Ponda,Bathinda,Ropar,Ludhiana,Jalandhar,Jammu,Pathankot,Amritsar,Hoshiarpur,Phagwara,Raipur,Rajnandgaon,Bilaspur,Durg,Raigarh,Korba,Rajkot,Ongole,Nellore,Tirupathi,Khammam,Kurnool,Ananthpur,Chittor,Kothagudem,Trichy,Thanjavur,Dindigul,Karur,Kumbakonam,Pudukottai,Tanjore,Karaikudi,Pattukottai,Mayiladuthurai,Udaipur,Bhilwara,Beawar,Banswara,Vellore,Pondicherry,Karaikkal,Kanchipuram,Krishnagiri,Vaniyambadi,Panruti,Tiruvannamalai,Guntur,Eluru,Vijayawada,Bhimavaram,Tenali,Machilipatnam,Tanuku,Palacollu,Rajahmundry,Srikakulam,Vizianagaram,Kakinada,Vizag,Anakapalli,Pitapuram,Tuni,Warangal,Nizamabad,Karimnagar,Ramagundam,Mahaboob Nagar,Armoor,Kodad,Aurangabad,Kolhapur,Ahmednagar,Solapur,Nanded,Latur,Parbhani,Satara,Chandrapur,Ratnagiri,Sangli,Jalna,Amravati,Beed,Nandurbar,Wardha,Akot,Greater Noida,Faridabad,Sahibabad,Dehradun,Rudhrapur,Saharanpur,Kishangarh,Haldwani,Firozabad,Mysore,Hubli,Hosur,Udipi,Mangalore,Belgaum,Hospet,Rishikesh';

$city_List = explode(",", $cityList);
sort($city_List);

$metrosCityList = "Bangalore,Chennai,Delhi,Gaziabad,Gurgaon,Hyderabad,Kolkata,Mumbai,Navi Mumbai,Noida,Pune,Thane";
$metrosCity_List = explode(",", $metrosCityList);
sort($metrosCity_List);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Personal Loans :: Business Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Personal Loan, Personal Loans, Personal Loan India, compare personal loans, personal loans comparision, online personal loans, Personal Loans India, Personal loans Online, Business Loan, Business Loans, Business Loan India, compare business loans, business loans comparision, online business loans, Business Loans India, Business loans Online">
<meta name="description" content="Personal Loan – Get Personal loan quotes, compare personal loans online, Best interest rates and EMI from all major personal loan banks.">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConverting.js' type='text/javascript' language='javascript'></script>
	<script type="text/javascript" src="ajax.js"></script>
	<script type="text/javascript" src="listing.js"></script>
<style type="text/css">body{	margin:0px;	padding:0px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#2e2e2e;}input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}form{margin:0px;padding:0px;}.hdr{	background-image:url(images/hdr.gif);	background-repeat:no-repeat;	height:75px;}.hdng-bg{	background-image:url(images/top-bg.jpg);	background-repeat:no-repeat;	height:36px;	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#ff6d03; 	text-indent:15px;}.yelobrder{	border-left:1px solid #fde37a;	border-right:1px solid #fde37a;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;}.yelobrder ul{	margin:0px 0px 0px 10px;	padding:0px 0px 0px 10px;}.yelobrder ul li{	background-image:url(images/arow.jpg) ;	background-repeat:no-repeat;	list-style-type:none; 	padding-left:18px; 	padding-right:0; 	padding-top:0; 	padding-bottom:4px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	line-height:18px; }.imgpostn{	padding-left:31px;	padding-top:10px;	padding-bottom:4px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#ff6d03;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #ff6d03;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */		#mainContainer{		width:660px;		margin:0 auto;		text-align:left;		height:100%;				border-left:3px double #000;		border-right:3px double #000;	}	#formContent{		padding:5px;	}	/* END CSS ONLY NEEDED IN DEMO */			/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:195px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}				#dhtmlgoodies_tooltip{		background-color:#ffe688;		border:1px solid #000;		position:absolute;		color:#000000;		display:none;		margin-left:-13px;		z-index:20000;		padding:0px;		font-size:0.9em;		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;			}	#dhtmlgoodies_tooltipShadow{		position:absolute;		background-color:#555;		display:none;		margin-left:-13px;		z-index:10000;		opacity:0.7;		filter:alpha(opacity=70);		-khtml-opacity: 0.7;		-moz-opacity: 0.7;	} </style>
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
else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}
	
if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select Employment Status to Continue");
	Form.Employment_Status.focus();
	return false;
}
if(Form.Employment_Status.value==1)
{
if(Form.Net_Salary1.value=='')
{
	alert("Please enter Income to Continue");
	Form.Net_Salary1.focus();
	return false;
}
	if(Form.Net_Salary1.value.charAt(0)=="0")
	{
		alert("Please enter Monthly income to Continue");
		Form.Net_Salary1.focus();
		return false;
	}
	if(Form.company_name.value=="" || Form.company_name.value=="Type slowly for autofill")
	{
		alert("Please Enter Company Name");
		Form.company_name.focus();
		return false;
	}
}
if(Form.Employment_Status.value==0)
{
	if(Form.business_running.selectedIndex==0)
	{
		alert("Please Enter Business Running Since");
		Form.business_running.focus();
		return false;
	}
	if(Form.Net_Salary1.value=='')
	{
		alert("Please enter Income to Continue");
		Form.Net_Salary1.focus();
		return false;
	}
	if(Form.Net_Salary1.value.charAt(0)=="0")
	{
		alert("Please enter Monthly income to Continue");
		Form.Net_Salary1.focus();
		return false;
	}

}
if(Form.Loan_Amount.value=='')
{
	alert("Kindly fill in your Loan Amount (Numeric Only)!");
	Form.Loan_Amount.focus();
	return false;
}
else if(containsalph(Form.Loan_Amount.value)==true)
{
	alert("Loan Amount contains characters!");
	Form.Loan_Amount.focus();
	return false;
}
if(Form.Loan_Amount.value.charAt(0)=="0")
{
	alert("Kindly fill in your Loan Amount (Numeric Only)!");
	Form.Loan_Amount.focus();
	return false;
}
if(Form.Employment_Status.value==1)
{
		
	if(Form.Residential_Status.selectedIndex==0)
	{
		alert("Please enter Residential Status to Continue");
		Form.Residential_Status.focus();
		return false;
	}
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
function addCompany()
{
		var ni = document.getElementById('getcomp');
		if(document.loan_form.Employment_Status.value=="1")
		{
			ni.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>	<td height="27" align="left" class="frmtxt" width="148">Company Name</td>	<td align="center" class="frmtxt" width="9"></td>	<td align="left" width="185"><input type="text" name="company_name" id="company_name" onkeyup="ajax_showOptions(this,\'getCollegesByLetters\',event)" style="width:140px; height:21px; color:silver;" onFocus=\'if(this.value=="Type slowly for autofill") {this.value="";this.style.color="black";}\' onBlur=\'if(this.value==""){this.value="Type slowly for autofill";this.style.color="silver";}\' value=\'Type slowly for autofill\'  onmouseout=\'hideTooltip()\' onmouseover=\'showTooltip(event,"Slowly start typing your employers name and choose from recommendations provided?"); return false\' style="width:140px;"  /></td>  </tr> <tr><td height="26" align="left" class="frmtxt">Monthly Income</td>	<td align="center" class="frmtxt"></td><td align="left"><input type="text" name="Net_Salary1" id="Net_Salary1" style="width:140px;   height:21px;" onkeyup="intOnly(this); getDigitToWordsMonthlySal(\'Net_Salary1\',\'formatedI\',\'wordIn\');" onkeypress="intOnly(this);"  onblur="getDigitToWordsMonthlySal(\'Net_Salary1\',\'formatedIncome\',\'wordIncome\');"  onchange="ShowHide(\'incomeShow\',\'Net_Salary\');" onmouseout=\'hideTooltip()\' onmouseover=\'showTooltip(event,"This is your net monthly salary as credited in your account after deductions."); return false\' /></td></tr></table>';	
		}
		else if(document.loan_form.Employment_Status.value=="0")
		{
			ni.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>	<td height="27" align="left" class="frmtxt" width="142">Running Business Since</td><td align="center" class="frmtxt" width="21"></td>	<td align="left"><select name="business_running" style="  height:21px;"><option value="-1">Select</option><option value="2010">1 Year</option><option value="2009">2 Years</option><option value="2008">3 Years</option><option value="2007">4 Years</option><option value="2006">5 Years</option><option value="2005">6 Years</option><option value="2004">7 Years</option><option value="2003">8 Years</option><option value="2002">9 Years</option><option value="2001">10 Years</option><option value="2000">More than 10 Years</option> </select></td>  </tr><tr>	<td height="27" align="left" class="frmtxt" width="142">Any Loan Running</td><td align="center" class="frmtxt" width="21"></td>	<td align="left"><input type="radio" name="loan_running" value="1" checked > Yes <input type="radio" name="loan_running" value="0"  > No</td></tr><tr><td height="26" align="left" class="frmtxt">Annual Income</td>	<td align="center" class="frmtxt"></td><td align="left"><input type="text" name="Net_Salary1" id="Net_Salary1" style="width:140px;" onkeyup="intOnly(this); getDigitToWords(\'Net_Salary1\',\'formatedI\',\'wordIn\');" onkeypress="intOnly(this);"  onblur="getDigitToWords(\'Net_Salary1\',\'formatedIncome\',\'wordIncome\');"  onchange="ShowHide(\'incomeShow\',\'Net_Salary\');" onmouseout=\'hideTooltip()\' /></td></tr> </table>';	
		}
		else
		{
			ni.innerHTML = '';
		}
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
	window.onload = ajaxFunction;
</script>
<script language="javascript">
function addElement()
{
		var ni = document.getElementById('myDiv');
		if(ni.innerHTML=="")
		{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr ><td height="30" align="left" class="frmtxt" width="141">Card Held Since</td>	<td align="center" class="frmtxt" width="21"></td><td align="left" ><select size="1" name="Card_Vintage" style="width:140px;"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></td></tr></table>';
		}
		return true;
	}
function removeElement()
{
		var ni = document.getElementById('myDiv');
		if(ni.innerHTML!="")
		{
			ni.innerHTML = '';
		}
		return true;
	}

function addRSElement()
{
	var ni = document.getElementById('myDivRS');
//	var empStatus = document.getElementById('myDivRS');
	
	if(document.loan_form.Employment_Status.value=="0")
	{
			//alert(document.loan_form.CC_Holder.value);
			ni.innerHTML = '';
	}
	else
	{
		ni.innerHTML ='<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="141" height="40" align="left" class="frmtxt">Residential Status </td><td width="6%" align="center" class="frmtxt"></td><td  align="left" class="nrmltxt"><select name="Residential_Status" id="Residential_Status" gtbfieldid="16"  style="width:143px;" ><option value="-1">Select One</option><option value="OWNED_BY_SELF_OR_SPOUSE">Owned by self/spouse</option><option value="OWNED_BY_PARENT_OR_SIBLING">Owned by parent/sibling</option><option value="RENTED_AND_STAYING_WITH_FAMILY">Rented - With Family</option><option value="RENTED_AND_STAYING_WITH_FRIENDS">Rented - With Friends</option><option value="RENTED_AND_STAYING_ALONE">Rented - Staying alone</option><option value="PAYING_GUEST">Paying guest</option><option value="HOSTEL">Hostel</option><option value="COMPANY_PROVIDED">Company provided</option></select></td></tr></table>';
	}
	return true;
}
		
 // Type slowly for autofill
</script>
</head>
<body>
<table width="1004" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="75" ><table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="450" height="75" align="left" valign="top"><img src="images/ing-logo.jpg" width="450" height="75" border="0" /></td>
    <td width="387" >&nbsp;</td>
    <td width="167" height="95">&nbsp;</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="middle" class="hdng-bg">Ingvyasya Apply Application</td>
          </tr>
          <tr>
            <td  ><table width="590" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td height="10"></td>
			</tr>
             <tr>
                <td >&nbsp;</td>
             </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td height="10">&nbsp;</td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="302" align="center" valign="top" class="btmboxbg" style="padding-left:30px; ">&nbsp;</td>
                    <td width="288" align="center" valign="top"  style="padding-left:20px; ">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="386" align="right" valign="top"><table width="386" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" class="frmbg">
<!--<form name="loan_form" method="post" action="get-instant-call-continue.php" onSubmit="return submitform(document.loan_form);"> -->
<form name="loan_form" method="post" action="get-instantquoteing-continue.php" onSubmit="return submitform(document.loan_form);">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="source" value="<?php echo "Doc Test"; ?>">
<div align="center" style="color:#FF0000; font-weight:bold;"><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></div>
		<table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center">
    <td height="15" colspan="3"></td>
  </tr>
  <tr align="center">
    <td height="39" colspan="3"  background="images/hdnbg.gif" class="frmhdng" style="background-repeat:no-repeat; background-position:center; "  >Apply Personal Loan </td>
    </tr>
  <tr>
    <td height="10" colspan="3" > </td>
    </tr>
  <tr>
	<td height="26" align="left" class="frmtxt">City</td>
	<td align="center" class="frmtxt">&nbsp;</td>
<td align="left">
	<select size="1" align="left" style="width:143px;"  name="City" id="City" >
	<option value="">Please Select</option>
    <?php 
for($iii=0;$iii<count($metrosCity_List);$iii++)
{
	?>
	<option value="<?php echo ucfirst(strtolower(trim($metrosCity_List[$iii]))); ?>" ><?php echo ucfirst(strtolower(trim($metrosCity_List[$iii]))); ?></option>
	<?php
}
?>
<option value="" disabled="disabled">-------------------</option>
<?php 
for($ii=1;$ii<count($city_List);$ii++)
{
	?>
	<option value="<?php echo ucfirst(strtolower(trim($city_List[$ii]))); ?>" ><?php echo ucfirst(strtolower(trim($city_List[$ii]))); ?></option>
	<?php
}
?>
         </select></td>
  </tr>

  <tr>
	<td height="26" align="left" class="frmtxt">Date of Birth </td>
	<td align="center" class="frmtxt">&nbsp;</td>
	<td align="left"><input name="day" value="dd" type="text" id="day" style="width:38px;  height:21px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');">
			<input name="month" id="month" style="width:38px;  height:21px;" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"  onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');">
			<input name="year" type="text" id="year" value="yyyy" style="width:52px;  height:21px;" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";  onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');">	</td>
 </tr>

  <tr>
	<td height="26" align="left" class="frmtxt">Pincode</td>
	<td align="center" class="frmtxt">&nbsp;</td>
	<td align="left"><input  style="width:140px;  height:21px; "   name="Pincode" id="Pincode" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" maxlength="6"  /></td>
  </tr>
 <tr>
    <td height="26" align="left" class="frmtxt">Employment Status</td>
    <td align="center" class="frmtxt">&nbsp;</td>
    <td align="left"><select  style="width:143px;   height:21px;"   name="Employment_Status" onChange="addCompany(); addRSElement();">
				<option selected value="-1">Employment Status</option>
			 <option value="1">Salaried</option>
                         <option value="0">Self Employed</option>
				</select></td>
  </tr>
  <tr><td colspan="3" align="left" class="frmtxt" id="getcomp"></td>
  </tr>
  <tr><td colspan="3" align="left" class="frmtxt" id="getselfEmp"></td>
  </tr>
  <tr align="left">
                <td   colspan="3" class="frmtxt">
<span id='formatedI' style='font-size:11px; font-weight:normal; color:#333333;font-Family:Verdana;'></span>
<span id='wordIn' style='font-size:11px; font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
  <tr>
	<td height="26" align="left" class="frmtxt">Loan Amount</td>
	<td align="center" class="frmtxt">&nbsp;</td>
	<td align="left"><input name="Loan_Amount" id="Loan_Amount" type="text" style="width:140px;  height:21px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /></td>
  </tr>
 <tr align="left">
                <td colspan="3" class="frmtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
  <tr>
	<td height="26" align="left" class="frmtxt">Credit Card Holder</td>
    <td align="center" class="frmtxt">&nbsp;</td>
    <td align="left" class="blktxt"><input type="radio" name="CC_Holder" id="CC_Holder" value="1"  style="border:none; "   /> Yes &nbsp;<input type="radio" name="CC_Holder" id="CC_Holder" value="0" checked style="border:none; " /> No</td>
	</tr> 
 <tr>
                <td colspan="3" class="frmtxt"><div id="myDiv"></div> </td>
              </tr>
<tr>
                <td colspan="3" class="frmtxt"><div id="myDivRS"> <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
	<td width="43%" height="40" align="left" class="frmtxt">Residential Status </td>
	<td width="3%" align="center" class="frmtxt">&nbsp;</td>
	<td width="54%" align="left" class="nrmltxt">
<select name="Residential_Status" id="Residential_Status" gtbfieldid="16"  style="width:143px;   height:21px;" >
    <option value="-1">Select One</option>
    <option value="OWNED_BY_SELF_OR_SPOUSE">Owned by self/spouse</option>
    <option value="OWNED_BY_PARENT_OR_SIBLING">Owned by parent/sibling</option>
    <option value="RENTED_AND_STAYING_WITH_FAMILY">Rented - With Family</option>
    <option value="RENTED_AND_STAYING_WITH_FRIENDS">Rented - With Friends</option>
    <option value="RENTED_AND_STAYING_ALONE">Rented - Staying alone</option>
    <option value="PAYING_GUEST">Paying guest</option>
    <option value="HOSTEL">Hostel</option>
    <option value="COMPANY_PROVIDED">Company provided</option>
</select>
 </td>
  </tr>

 

  

  </table></div> </td>
              </tr>
 <tr>
	<td width="43%" height="40" align="left" class="frmtxt">Total EMIs <br>

	  you currently pay per month. (if any) </td>
	<td width="3%" align="center" class="frmtxt">&nbsp;</td>
	<td width="54%" align="left" class="nrmltxt"><input name="other_emi" id="other_emi" type="text" style="width:140px;  height:21px;" maxlength="11" onfocus="this.select();"   />

 </td>
  </tr>
  <tr>
	<td height="26" align="left" class="frmtxt">Account in Ing Vyasya</td>
    <td align="center" class="frmtxt">&nbsp;</td>
    <td align="left" class="blktxt"><input type="radio" name="account_holder" id="account_holder" value="1"  style="border:none; "   /> Yes &nbsp;<input type="radio" name="account_holder" id="account_holder" value="0" checked style="border:none; " /> No</td>
	</tr> 
  <tr valign="bottom">
    <td height="40" colspan="3" align="center"><input  type="image" style="border: 0px;" src="images/quote.gif" width="109" height="29"></td>
    </tr>
  <tr valign="bottom">
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
</table>
			</form>
			</td>
            <td width="6" class="frmrgtbrdr">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php include "analtyics.php"; ?>
</body>
</html>