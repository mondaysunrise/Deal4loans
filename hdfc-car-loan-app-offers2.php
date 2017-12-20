<? 
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDFC BANK | Deal4loans</title>
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<script src="ICICI_CL/jquery-1.4.4.js"></script>
<style type="text/css"> 
<!-- 
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
	text-align: center; 
	color: #000000;
}
.twoColLiqRtHdr #container { 
	width: 91%;  
	background: #FFFFFF;
	margin: 0 auto; 
	border: 1px solid #000000;
	text-align: left; 
	margin-top:15px;
} 
.twoColLiqRtHdr #header { 
	background: #FFFFFF; 
	padding: 0px;
} 
.twoColLiqRtHdr #header h1 {
	margin: 0; 
	padding: 10px 0;
}
.twoColLiqRtHdr #sidebar1 {
	float: right; 
	width: 30%; 
	padding-top: 15px; 
	padding-left: 15px; 
}
.twoColLiqRtHdr #sidebar1 h3, .twoColLiqRtHdr #sidebar1 p {
	margin-left: 10px; 
	margin-right: 10px;
}
.twoColLiqRtHdr #mainContent { 
	margin: 0 0 0 10px;
	vertical-align:top;
	width:584px;
} 
.twoColLiqRtHdr #footer { 
	padding:10px; 
	background:#DDDDDD; 
} 
.twoColLiqRtHdr #footer p {
	margin: 0; 
	padding: 10px 0; 
}
.fltrt { 
	float: right;
	margin-left: 8px;
}
.fltlft {
	float: left;
	margin-right: 8px;
}
.clearfloat {
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}
.text8 {
	font-family: 'Carrois Gothic', serif;
	font-size: 13px;
	font-weight: bold;
	font-variant: normal;
	text-decoration: none;
	@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
}

.text9 {
	font-family: 'Carrois Gothic', serif;
	font-size: 20px;
	font-weight: bold;
	font-variant: normal;
	text-decoration: none;
	@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
}
.inputtext
{
	-moz-border-radius: 10px;
	border-radius: 10px;
    border:solid 1px #e6e6e6;
    padding:5px;
	background-color:#e6e6e6; 
	height:20px;
}
.design2{
background-color:#ff1552;
border:1px solid #ff1552;
padding:5px;
-webkit-border-radius:10px;
-moz-border-radius:10px;
width:150px;
text-align:left;
height:37px;
font-size:15px;
color:#FFFFFF;
font-family: 'Carrois Gothic', serif;
@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
font-weight:bolder;
}
select {
    width:250px;
	height:27px;
     border:solid 1px #e6e6e6;
	 background-color:#e6e6e6; 
    -webkit-border-top-right-left-radius: 10px;
    -webkit-border-bottom-right-left-radius: 1px;
    -moz-border-radius: 10px;
    -moz-border-radius: 10px;
    padding:2px;
}
#emi_sum { background: none repeat scroll 0pt 0pt #fcfcfc; clear: both; float: left; width: 250px; margin: 0pt 0px 0px 0pt; }
#emi_sum div { margin: 0pt 0pt 0px; padding: 0px 0px 0pt;  border-top: 1px dotted rgb(147, 79, 79); }
#emi_sum h4 { color: #934f4f; font-weight: bold; }
--> 
</style>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
 <style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
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
<script>
/*$(function() {
$("button").click(function(){
	//alert("dd");
 $.post("get_hdfc_other_caroffers.php",
  {
    car_name: $("#car_name").val(),
    city:'Others'
  },
  function(data){
  // alert("Data: " + data);
	 $('#show_car_options').html(data);
  });
});
});
*/
$(function() {
$("#car_name").focusout(function(){
	//alert("hello");
 $.post("get-car-price.php",
  {
    car_name: $("#car_name").val(),
    city:'Others'
  },
  function(data,status){
   // alert("Data: " + data + "\nStatus: " + status);
	 $('#car_price_pop').html(data);
  });
});
});

$(function() {
$("#show_rumprice").mouseover(function(){
	//alert("hello");
 $.post("get-car-price.php",
  {
    car_name: $("#car_name").val(),
    city:'Others'
  },
  function(data,status){
   // alert("Data: " + data + "\nStatus: " + status);
	 $('#car_price_pop').html(data);
  });
});
});

function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")	{	alert("Invalid E-mail ID.");	return false;		}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 	{	return false;	}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 	{	alert("Invalid E-mail ID.");	return false;	}
	if (email1.indexOf("@",atPos+1) != -1) 	{ 	alert("Invalid E-mail ID.");	return false;	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 	{ 	alert("Invalid E-mail ID.");	return false;	}
	if (periodPos+3 > email1.length)		{		alert("Invalid E-mail ID.");	return false;	}
	return true;
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
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

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
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
	
	if((Form.car_name.value=="") || Form.car_name.value=="Type slowly for autofill")
	{
		alert("Kindly enter Name of car you want!");	
		Form.car_name.focus();
		return false;
	}

if(Form.Net_Salary.value=="" || Form.Net_Salary.value=="0")
	{
		alert('Click on "Your occupational details". Please enter Annual income to Continue');
		Form.Net_Salary.focus();
		return false;
	}
	if(Form.Company_Name.value=="")
	{
		alert("Please enter Company Name to Continue");
		Form.Company_Name.focus();
		return false;
	}

	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
		alert("Kindly fill in your Name!");
		Form.Name.select();
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

	if (Form.Phone.value.charAt(0)!="9" && Form.Phone.value.charAt(0)!="8" && Form.Phone.value.charAt(0)!="7")
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
	if(Form.Email.value!="")
	{
		if (!validmail(Form.Email.value))
		{
			//alert("Please enter your valid email address!");
			Form.Email.focus();
			return false;
		}	
	}
		
	if(Form.dd.value=="" ||  Form.dd.value=="DD")
	{
		alert("Please fill your day of birth.");
		Form.dd.focus();
		return false;
	}
	if(Form.dd.value!="")
	{
		if((Form.dd.value<1) || (Form.dd.value>31))
		{
			alert("Kindly Enter your valid Date of Birth(Range 1-31)");
			Form.dd.focus();
			return false;
		}
	}
	
	if(Form.mm.value=="" || Form.mm.value=="MM")
	{
		alert("Please fill your month of birth.");
		Form.mm.focus();
		return false;
	}
	if(Form.mm.value!="")
	{
		if((Form.mm.value<1) || (Form.mm.value>12))
		{
			alert("Kindly Enter your valid Month of Birth(Range 1-12)");
			Form.mm.focus();
			return false;
		}
	}
	
	if(Form.yyyy.value=="" || Form.yyyy.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		Form.yyyy.focus();
		return false;
	}
	if(Form.yyyy.value!="")
	{
		if(Form.yyyy.value > parseInt(mdate-18) || Form.yyyy.value < parseInt(mdate-62))
		{
			alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
			Form.yyyy.focus();
			return false;
		}
	}

	return true;
}

function swtchToNextTab_dd()
{
	if(document.hdfc_calc.dd.value!="" && (document.hdfc_calc.dd.value.length==2))
	{
		document.hdfc_calc.mm.focus();
	}
}

function swtchToNextTab_mm()
{
	if(document.hdfc_calc.mm.value!="" && (document.hdfc_calc.mm.value.length==2))
	{
		document.hdfc_calc.yyyy.focus();
	}

}

function swtchToNextTab_yyyy()
{
	if(document.hdfc_calc.yyyy.value!="" && (document.hdfc_calc.yyyy.value.length==4))
	{
		document.hdfc_calc.Pancard.focus();
	}
}


function displayResult()
{
document.getElementById("show_details").style.visibility="visible";
}
</script>
<script>
var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

	function insertstat_code()
		{
			var get_phone = document.getElementById('Phone').value;
			var get_code = document.getElementById('stat_code').value;
			if(get_code=="" && get_phone.length==10){
				var queryString = "?get_Mobile=" + get_phone + "&stat_code=" + get_code;
				//alert(queryString);
				ajaxRequestMain.open("GET", "activate_hdfccl.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					if(ajaxRequestMain.readyState == 4)
					{
					document.getElementById('stat_code').value=ajaxRequestMain.responseText;
					}
				}
		}
			ajaxRequestMain.send(null); 
		}
	window.onload = ajaxFunctionMain;
</script>

<style>
h3{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	text-decoration:none;
	color:#1c50b0;
	padding:0px;
	margin:0px 0px 0px 0px;
	text-align:left;
}

.faqContainer{
	padding:10px;
}

.faqContainer .toggler {
	padding:5px 0px 0px 15px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:17px;
	font-weight:bold;
	text-align:justify;
	
	cursor:pointer;
}

.elementInside{
	margin:4px 0px 8px 0px;
	padding:4px 0px 10px 0px; 
	font-family: Verdana, Geneva, sans-serif;	font-size: 11px;	font-weight: normal;	font-variant: normal;	color: #4c4c4c;
	text-decoration: none;
}
.element_atStart_dv
{
margin:4px 0px 8px 0px; 
font-family: Verdana, Geneva, sans-serif;	font-size: 11px;	font-weight: normal;	font-variant: normal;	color: #4c4c4c;
	text-decoration: none; 
}

</style>

</head>
<body class="twoColLiqRtHdr">
<div id="container">
  <div id="header" >
    <div style="background-color:#EAF3FC; padding:10px; color:#434242; font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:22px;" align="center"><b>HDFC Bank offers fastest loan processing for wide range of Car Models.</b> </div></div>
  <div id="sidebar1" >
 <table cellpadding="0" cellspacing="0" border="0"   class="inputtext" style="width:230px;  ">
<tr><td class="text9" style="color:#4c4c4c; size:18px;  padding-left:50px;"  ><span > Features & Benefits</span></td></tr>
  <tr><td valign="top" align="center" style="padding-left:0px; background-color:#e6e6e6;">
  <div id="emipaymentdetails" style="background-color:#e6e6e6;" class="showintr" >
	<div  id="emi_sum" style="background-color:#e6e6e6;" class="showintr">
	 <p style="font-size:11px; font-weight:normal; text-align:left; line-height:15px; !important">Covers the widest range of cars in India.<br />
Upto 100% finance on ur favourite car.<br />
	Repay with easy EMIs. <br />
	Attractive Interest rates.<br />
	Hassle-free documentation.</p>
   </div>
</div>
  </td></tr>
  </table>
  <div style="height:5px; background-color:#FFFFFF;"></div>
  <table cellpadding="0" cellspacing="0" border="0"   class="inputtext" style="width:260px;">
  <tr><td class="text9" style="color:#4c4c4c; size:18px;  padding-left:40px;"  ><span>What People say</span></td></tr>
  <tr><td valign="top" align="center" style="padding-left:0px; background-color:#e6e6e6;"><div class="text" style="width:212px; margin:auto; height:auto; font-size:12px; color:#666666; text-align:left; ">
  <marquee direction="up" scrollamount="2" height="125" width="235"  style="width:200px; font-size:12px; color:#666666; padding-top:2px; text-align:left; "> 
<div class="text" style="width:200x; margin:auto; height:auto; font-size:11px; color:#666666; padding-top:2px; text-align:left; padding-bottom:20px; "> 
The online application forms are very simple and user-friendly; don't require too much information and one can get a decision almost instantly within the budget ! Good experience, worth giving a try.
Mrs Afsana<br />
IT Consultant
</div>
<div class="text" style="width:200x; margin:auto; height:auto; font-size:11px; color:#666666; padding-top:2px; text-align:left; ">
Online application procedure helped me choose the right car & made the entire loan procedure as fast & simple.From start to finish the online procedure & approval process was completely satisfying. Highly recommended for those who are looking for the best deal in no time...
Mr Balbir<br />
Sr. Relationship Manager </div>
</marquee>
 </div></td></tr>
 </table>
 <div style="height:5px; background-color:#FFFFFF;"></div>
  <table cellpadding="0" cellspacing="0" border="0"   class="inputtext" style="width:260px;" >
  <tr><td class="text9" style="size:18px;  padding-left:60px;"  ><span>Welcome Rewards</span></td></tr>
  <tr><td valign="top" align="center" style="padding-left:0px; background-color:#FFFFFF;"><img src="new-images/hdfccl_giftss.gif" width="" /></td></tr></table>
  <div style="height:5px; background-color:#FFFFFF;"></div>
  </div>
  <div id="mainContent" style="padding-top:6px; padding-bottom:60px; " >
<form  method="POST" action="hdfc-car-loan-app-offers2-continue.php" name="hdfc_calc"  onSubmit="return submitform(document.hdfc_calc);" >
<input type="hidden" name="stat_code" id="stat_code" tabindex=15>
  <table cellpadding="0" cellspacing="0" border="0" >
 <tr><td valign="top">
  <h3 class="toggler atStart" style="padding-left:5px; padding-top:4px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 2px solid;width:585px;"><table width="585" border="0"><tr><td width="522" ><span class="text9" >Choose your car</span></td>
 <td width="47" style="cursor:pointer;" >&nbsp;</td>
 </tr></table>
 
 </div></h3>
 <div class="element atStart">
<div class="elementInside">  <table cellpadding="0" cellspacing="0" border="0">
<tr >
	<td class="text8" >
     <table width="400" border="0" >
      <tr><td width="400" class="text8">Make & Model of car (ex. Nissan Micra)</td>
      </tr><tr>
    <td width="400">	
	<input name="car_name" id="car_name" type="text" style="width:300px;" class="inputtext" onkeyup="ajax_showOptions(this,'getCarNameByLetters',event, 'http://www.deal4loans.com/hdfcajax-carnlist-cl.php')" value="Type slowly for autofill" onblur="onBlurDefault(this,'Type slowly for autofill'); " onfocus="onFocusBlank(this,'Type slowly for autofill');" onChange="displayResult();" tabindex="1"/></td></tr></table>
   </td>
</tr>
 <tr>	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
     <table width="400" border="0" >
      <tr><td width="400" class="text8" id="show_rumprice">Ex-showroom price of car (indicative prices) </td>
      </tr><tr>
    <td width="400">	
	<div id="car_price_pop" class="inputtext" style="width:300px;">Based on selected car</div></td></tr></table>
   </td>
</tr>
</table>
</div></div>
</td></tr>
 <tr><td valign="top" style="visibility:hidden;" id="show_details">
<h3 class="toggler atStart" style="padding-left:5px; padding-top:4px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 2px solid;width:585px;"><table width="585" border="0"><tr><td width="522" ><span class="text9" >Share your employment details to get quote</span></td>

 </tr></table>
 
 </div></h3>
  <div class="element atStart">
 <div class="elementInside">  <table cellpadding="0" cellspacing="0" border="0">
<tr >
	<td class="text8" >
     <table width="320" border="0" >
      <tr><td width="320" class="text8">Annual Income</td>
      </tr><tr>
    <td width="300"><input name="Net_Salary" id="Net_Salary" type="text" style="width:250px;" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="2"/></td></tr></table>   </td>
	<td> <table width="325" border="0" >
      <tr><td width="325" class="text8">Company Name</td>
      </tr>
      <tr>
    <td width="275"><input name="Company_Name" id="Company_Name" type="text"  style="width:260px;" class="inputtext" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/hdfcajax-cmplist-cl.php')" value="Type slowly for autofill" onblur="onBlurDefault(this,'Type slowly for autofill');" onfocus="onFocusBlank(this,'Type slowly for autofill');" tabindex="3"></td></tr></table></td>
</tr>
</table>
</div></div>
   <h3 class="toggler atStart" style="padding-left:5px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 2px solid;width:585px;"><table width="585" border="0"><tr><td width="522" ><span class="text9" >Personal Information</span></td><td width="250"><img src="new-images/locked-privacy.jpg" width="12" height="14"/> We keep this secure</td>
  </tr></table></div></h3>
   <div class="element atStart"><div  class="element_atStart_dv">
  <table cellpadding="0" cellspacing="0" border="0">
    <tr>
	<td width="325"  class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Name</td>
      </tr><tr>
    <td width="375"><input type="text" name="Name" id="Name" style="width:250px;" class="inputtext" tabindex="4"/></td></tr></table>   </td>
	<td width="325"> <table width="275" border="0" >
      <tr><td width="275" class="text8">Mobile No.</td>
      </tr><tr>
    <td width="275"><input type="text" name="Phone" id="Phone" class="inputtext" style="width:250px; height:20px;" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="5" onchange="intOnly(this); insertstat_code();"/></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
 <tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Email</td>
      </tr><tr>
    <td width="375"><input type="text" name="Email" id="Email" class="inputtext" style="width:250px; height:20px;" tabindex="6"/></td></tr></table>   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">City</td>
      </tr><tr>
    <td width="275"><select name="City" id="City" style="width:260px; height:30px;" class="inputtext" tabindex="7">
            <?=plgetCityList($City)?>
          </select></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr>
        <td width="325" class="text8">DOB</td>
      </tr><tr>
    <td width="375"><input name="dd" id="dd" type="text" size="4" maxlength="2" class="inputtext" onblur="onBlurDefault(this,'DD');" onfocus="onFocusBlank(this,'DD');"/ onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_dd();" onKeyPress="intOnly(this);" tabindex="8">	/ <input name="mm" id="mm" type="text" size="4" maxlength="2" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_mm();" onKeyPress="intOnly(this);" onblur="onBlurDefault(this,'MM');" onfocus="onFocusBlank(this,'MM');" tabindex="9"/>  / <input name="yyyy" id="yyyy" type="text" size="7" maxlength="4" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_yyyy();" onKeyPress="intOnly(this);" onblur="onBlurDefault(this,'YYYY');" onfocus="onFocusBlank(this,'YYYY');" tabindex="10"/></td></tr></table>   </td>
	<td>
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Enter Validation Code sent on ur Mobile No.</td>
      </tr><tr>
    <td width="375"><input name="otp_code" id="otp_code" type="text" class="inputtext" style="width:50px;" maxlength="5" tabindex="11"/>&nbsp;(Verify your Mobile Number)</td></tr></table>  </td>
</tr>
<tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:35px;" ><input type="checkbox" name="accept" id="accept"> I agree to <a href="#">terms and conditions</a>.</td></tr>
<tr >
	<td class="text8" align="right" style="padding-left:6px;" colspan="2">
<input class="design2" type="submit" name="Submit" value=">> Get Quote "   />   </td>
	<td>&nbsp; </td>
</tr>
</table>
</div></div>
</td></tr>

</table>

</form>
</div>

<br class="clearfloat" />
<div id="footer">
</div>
</div>

</body>
</html>