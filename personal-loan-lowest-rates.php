<?php  
require 'scripts/db_init.php'; 
if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="19jan16"; }

$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

if ($iphone || $android || $palmpre || $ipod || $berry == true) 
{
	$device = "Mobile Device Detected";	
}
else { 			$device = "Desktop";	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Personal Loan Lowest Rate </title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="css/apply-personal-loans-lp-styles-new2-11-2015.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/pl_apply-tab_styles-new11-2-2015.css">
<link href="css/personal-loans-new-lp-11-2-2015.css" type="text/css" rel="stylesheet" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
<script src="organictabs.jquery.js"></script>
<script>
$(function(){
// Calling the plugin
	$("#example-one").organicTabs();
	$("#example-two").organicTabs({
		"speed": 100,
		"param": "tab"
	});
});
</script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style>
#ajax_listOfOptions{position:absolute;width:250px;height:160px;overflow:auto;border:1px solid #317082;background-color:#FFF;color:#000;font-family:Verdana,'Raleway';text-align:left;font-size:10px;z-index:100}
#ajax_listOfOptions div{cursor:pointer;font-size:10px;margin:1px;padding:1px}
#ajax_listOfOptions .optionDivSelected{background-color:#2375CB;color:#FFF}
#ajax_listOfOptions_iframe{background-color:red;position:absolute;z-index:5}
</style>
<script Language="JavaScript" Type="text/javascript">
$(function() {
	$("#IncomeAmount").focusout(function(){
			if($("#IncomeAmount").val()<=50000){
		var ai=$("#IncomeAmount").val();
	var mai= Math.round(ai/12);
		    $( "#dialog-modal" ).dialog({
			title:"You Have Indicated Your Annual Income Is 'Rs. " + ai + "' which is 'Rs." + mai + "' per month. If correct Continue or Edit Annual Income to get Right Quote",
            height: 0,
            modal: true
        });
			//$("#IncomeAmount").val().focus();
		}
		});
    });
	
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{		alert("Invalid E-mail ID.");		return false;		}
	for (i=0; i<invalidChars.length; i++) 
	{	
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 		{			return false;		}
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
	if (periodPos+3 > email1.length)		{		alert("Invalid E-mail ID.");		return false;	}
	return true;
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

function addElement()
{	
	var ni = document.getElementById('myDivcc');
		var ni1 = document.getElementById('myDivcc1');
		if(ni.innerHTML=="")
		{
		if(document.personalloan_form.CC_Holder.value="on")
			{
				ni.innerHTML = 'Card held since?';
				ni1.innerHTML = '<select size="1" name="Card_Vintage" class="select" onChange="validateDiv(\'vintageVal\');"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select><div id="vintageVal" class="alert_msg"></div>';
			}
		}
		return true;
	}
function removeElement()
{		var ni = document.getElementById('myDivcc');
		var ni1 = document.getElementById('myDivcc1');
		if(ni.innerHTML!="")
		{
			if(document.personalloan_form.CC_Holder.value="on")
			{
	ni.innerHTML = '';
				ni1.innerHTML = '';
			}
		}
		return true;
	}
function chkpersonalloan(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

 if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
{
//	alert("Kindly fill in your Loan Amount (Numeric Only)!");
	document.getElementById('loanVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Loan Amount!</span>";
	Form.Loan_Amount.focus();
	return false;
}

if(Form.Employment_Status.selectedIndex==0)
{
	//alert(Form.Employment_Status.selectedIndex);
	document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Employment Status!</span>";
	Form.Employment_Status.focus();
	return false;
}
if(Form.Employment_Status.value==1)
{
	if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Type slowly for Autofill") || (Form.Company_Name.value=="Company Name"))
	{
		//alert("Kindly fill in your Company Name!");
		document.getElementById('companyVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Company Name!</span>";
		Form.Company_Name.focus();
		return false;
	}
	else if(Form.Company_Name.value.length < 3)
	{
		document.getElementById('companyVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Company Name!</span>";
		Form.Company_Name.focus();
		return false;
	}
}
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)"))
{
	//alert("Please enter Income to Continue");
	document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Income!</span>";
	Form.IncomeAmount.focus();
	return false;
}
if(Form.City.selectedIndex==0)
{
//	alert("Please enter City Name to Continue");
	document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Select City!</span>";		
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
//	alert("Kindly fill in your other City!");
	document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Other City!</span>";
Form.City_Other.focus();
return false;
}

if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
{
	//alert("Kindly fill in your Name!");
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Your name</span>";		
	Form.Name.focus();
	return false;
}
else if(containsdigit(Form.Name.value)==true)
{
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name Contains Numbers</span>";		
//	alert("Name contains numbers!");
	Form.Name.focus();
	return false;
}

for (var i = 0; i < Form.Name.value.length; i++) 
{
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) 
	{
//		alert ("Name has special characters.\n Please remove them and try again.");
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name has special characters</span>";		
		Form.Name.focus();
		return false;
  	}
}

if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
//	alert("Kindly enter your Date of Birth");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Date of Birth</span>";
	Form.day.select();
	return false;
}
else if(!num.test(Form.day.value))
{
//	alert("Kindly enter your Date of Birth(numbers Only)");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Date of Birth</span>";
	Form.day.select();
	return false;
}
else if((Form.day.value<1) || (Form.day.value>31))
{
	//alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Day, Range 1-31</span>";
	Form.day.select();
	return false;
}
else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
//	alert("Kindly enter your Month of Birth");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Month of Birth</span>";
	Form.month.select();
	return false;
}
else if(!num.test(Form.month.value))
{
//	alert("Kindly enter your Month of Birth(numbers Only)");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Month of Birth</span>";
	Form.month.select();
	return false;
}
else if((Form.month.value<1) || (Form.month.value>12))
{
//	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Month, Range 1-12</span>";
	Form.month.select();
	return false;
}
else if((Form.month.value==2) && (Form.day.value>29))
{
//	alert("Month February cannot have more than 29 days");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'> February, Only 29 days.</span>";
	Form.day.select();
	return false;
}
else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
//	alert("Kindly enter your Year of Birth");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Year of Birth</span>";
	Form.year.select();
	return false;
}
else if(!num.test(Form.year.value))
{
//	alert("Kindly enter your Year of Birth(numbers Only) !");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Year of Birth</span>";
	Form.year.select();
	return false;
}
else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
	//alert("February cannot have more than 28 days.");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>February, Only 28 days.</span>";
	Form.day.select();
	return false;
}
else if(Form.year.value.length != 4)
{
	//alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter 4 Digit</span>";
	Form.year.select();
	return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
//	alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Age group 21 - 62</span>";
	Form.year.select();
	return false;
}
else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
	//alert("Cannot have 31st Day");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Cannot have 31st Day</span>";
	Form.day.select();
	return false;
}
if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
	//alert("Kindly fill in your Mobile Number!");
	document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Mobile Number</span>";
	Form.Phone.focus();
	return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
		  //alert("Enter numeric value in ");
		  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Numeric Value</span>";
		  Form.Phone.focus();
		  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
//		  alert("Please Enter 10 Digits"); 
		  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter 10 Digits</span>";
		  Form.Phone.focus();
		  return false;
        }
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Start with 9 or 8 or 7</span>";
				 Form.Phone.focus();
                return false;
        }

		if(Form.Email.value=="")
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter  Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		
		var str=Form.Email.value
		var aa=str.indexOf("@")
		var bb=str.indexOf(".")
		var cc=str.charAt(aa)
	
		if(aa==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Valid Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		else if(bb==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Valid Email Address!</span>";	
			Form.Email.focus();
			return false;
		}

//onchange="validateDiv(\'vintageVal\');"
myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
				if (Form.Card_Vintage.selectedIndex==0)
				{
						//alert("Please select since how long you holding credit card");
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Holding Credit Card Since!</span>";	
						Form.Card_Vintage.focus();
						return false;
				}
				}
					myOption = i;
				//	alert(i);					
			}
		}
		if (myOption == -1) 
		{
		//	alert("Please select you are credit card holder or not");
			document.getElementById('ccholderVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Credit Card holder or not!</span>";	
			return false;
		}
		
	if(!Form.accept.checked)
	{
//		alert("Accept the Terms and Condition");
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Accept Terms & Condition!</span>";	
		Form.accept.focus();
		return false;
	}
if(Form.Email.value=="Email Id")
{
	Form.Email.value=" ";
}
}
function chkploan(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if((Form.Name2.value=="") || (Form.Name2.value=="Name")|| (Trim(Form.Name2.value))==false)
{
	//alert("Kindly fill in your Name!");
	document.getElementById('nameVal2').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Your name</span>";		
	Form.Name2.focus();
	return false;
}
else if(containsdigit(Form.Name2.value)==true)
{
	document.getElementById('nameVal2').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name Contains Numbers</span>";		
//	alert("Name contains numbers!");
	Form.Name2.focus();
	return false;
}

for (var i = 0; i < Form.Name2.value.length; i++) 
{
  	if (iChars.indexOf(Form.Name2.value.charAt(i)) != -1) 
	{
//		alert ("Name has special characters.\n Please remove them and try again.");
		document.getElementById('nameVal2').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name has special characters</span>";		
		Form.Name2.focus();
		return false;
  	}
}

if((Form.Phone2.value=='Mobile No') || (Form.Phone2.value=='') || Trim(Form.Phone2.value)==false)
{
	//alert("Kindly fill in your Mobile Number!");
	document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Mobile Number</span>";
	Form.Phone2.focus();
	return false;
}
 else if(isNaN(Form.Phone2.value)|| Form.Phone2.value.indexOf(" ")!=-1)
		{
		  //alert("Enter numeric value in ");
		  document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Numeric Value</span>";
		  Form.Phone2.focus();
		  return false;  
		}
        else if (Form.Phone2.value.length < 10 )
		{
//		  alert("Please Enter 10 Digits"); 
		  document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor'>Enter 10 Digits</span>";
		  Form.Phone2.focus();
		  return false;
        }
else if ((Form.Phone2.value.charAt(0)!="9") && (Form.Phone2.value.charAt(0)!="8") && (Form.Phone2.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Start with 9 or 8 or 7</span>";
				 Form.Phone2.focus();
                return false;
        }
	if(!Form.accept2.checked)
	{
//		alert("Accept the Terms and Condition");
		document.getElementById('acceptVal2').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Accept Terms & Condition!</span>";	
		Form.accept2.focus();
		return false;
	}
}

function addcty_oth()
{
	var ni = document.getElementById('myDiv');
		if(ni.innerHTML=="")
		{
		if(document.personalloan_form.City.value=="Others")
			{
				ni.innerHTML ='<table cellpadding="0" cellspacing="0" width="100%"><tr align="left"><td height="26" class="bldtxt" width="40%">Other City </td><td width="60%" class="alert_msg"><input name="City_Other" id="City_Other" type="text" style="width:140px; " onblur="onBlurDefault(this,\'Other City\');"  onfocus="onFocusBlank(this,\'Other City\');" onkeydown="validateDiv(\'othercityVal\');"  /><div id="othercityVal"></div</td></tr></table>';
					}
		}
		else
	{
		ni.innerHTML="";
	}
		return true;
}
			
function addcmp_nme()
{ 
	var citemps=document.personalloan_form.Employment_Status.value;
	var ni = document.getElementById('myCmpDiv');
	var ni1 = document.getElementById('myCmpDiv1');
		if(ni.innerHTML=="")
		{
		
		if(document.personalloan_form.Employment_Status.selectedIndex >0 && citemps==1)
			{
				ni.innerHTML ='Company Name';
				ni1.innerHTML ='<input name="Company_Name" id="Company_Name" type="text" class="input" onBlur="onBlurDefault(this,\'Type slowly for Autofill\');"  onFocus="onFocusBlank(this,\'Type slowly for Autofill\');"  onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" value="Type slowly for Autofill" tabindex=3 autocomplete="off" onkeydown="validateDiv(\'companyVal\');" /><div id="companyVal"></div>';
			}
		}
		else
	{
		ni.innerHTML="";
		ni1.innerHTML="";
	}
		return true;
}

function chgtxtsal(){

	var nitxt=document.getElementById('chgtxt');
	var niadtxt=document.getElementById('myanualtDiv');
	var niadtxt1=document.getElementById('myanualtDiv1');
	var citemp=document.personalloan_form.Employment_Status.value;

	if(citemp==0){
		nitxt.innerHTML="Annual ITR";
		niadtxt.innerHTML="Annual Turnover"; 
		niadtxt1.innerHTML="<select name='Annual_Turnover' id='Annual_Turnover'  class='select'>		<option value=''>Please Select</option>	<option value='1' > 0 - 40 Lacs</option>	<option value='4' > 40 Lacs - 1 Cr</option>		<option value='2' > 1Cr - 3Crs </option>	<option value='3' >3Crs & above</option>		</select>";
	}
		else{nitxt.innerHTML="Annual Income";niadtxt.innerHTML=""; niadtxt1.innerHTML=""}}
</script>
<Script Language="JavaScript">
function addtooltip()
{	var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML=="")
		{
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
		}
		return true;
	}
function othercity1()
{
if(document.personalloan_form.City.value=='Others')
{
document.personalloan_form.City_Other.disabled=false;
}
else
{document.personalloan_form.City_Other.disabled=true;
}
}
function removetooltip()
{
		var ni = document.getElementById('myDiv1');
		if(ni.innerHTML!="")
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

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni7 = document.getElementById('othCitDiv');
	var ni8 = document.getElementById('othCitvalDiv');
	
	if(document.personalloan_form.City.value=='Others')
	{
		ni7.innerHTML = 'Other City';
		ni8.innerHTML = '<input value="Other City" name="City_Other" id="City_Other" class="input" onBlur="onBlurDefault(this,\'Other City\');"  onfocus="onFocusBlank(this,\'Other City\');" onKeyUp="searchSuggest();" /><div id="CityOLayer"></div><div id="othercityVal"></div>';
	}
	else { ni8.innerHTML = '';		ni7.innerHTML = '';	}
		ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td align="left" valign="middle" class="bldtxt" colspan="2" style="padding-top:3px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="48%"  align="left" class="personal_text" colspan="2"> Personal Details</td></tr><tr><td width="4%" style="font-size:10px; font-weight:normal; color:#0072bc;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="96%" align="left"class="sbi_text_a"  style="font-size:10px; font-weight:normal; color:#0072bc;">Your Information is secure with us & will not be shared without your consent</td></tr></table></td></tr>    <tr>    <td width="35%" height="45" class="form_text">Full Name</td>    <td width="65%"  class="alert_msg"><input name="Name" type="text" class="input" id="Name" tabindex=6  onFocus="onFocusBlank(this,\'Name\');"  onBlur="onBlurDefault(this,\'Name\');" onChange="insertData();" <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }else {?>value=""<? }?>  onkeydown="validateDiv(\'nameVal\');"/><div id="nameVal"></div></td>  </tr>  <tr>    <td height="45" class="form_text">DOB</td>    <td  class="alert_msg"><input name="day" type="text" class="month" id="day" tabindex=7  onFocus="onFocusBlank(this,\'dd\');" onBlur="onBlurDefault(this,\'dd\');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="dd" maxlength="2" onKeyDown="validateDiv(\'dobVal\');"/> <input name="month" type="text" class="month" id="month" tabindex=8 onFocus="onFocusBlank(this,\'mm\');" onBlur="onBlurDefault(this,\'mm\');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="mm" maxlength="2" onKeyDown="validateDiv(\'dobVal\');" /> <input name="year" type="text" class="year" id="year" tabindex=9  onFocus="onFocusBlank(this,\'yyyy\');"   onBlur="onBlurDefault(this,\'yyyy\');" onChange="intOnly(this); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="yyyy" maxlength="4" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal"></div></td>  </tr>  <tr>   <td height="45" class="form_text">Mobile No.</td>    <td  class="form_text"  >+91 <input name="Phone" type="text" class="mobile" id="Phone"  tabindex=10 onFocus="addtooltip();" onChange="intOnly(this); tosendsms(); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="10"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }else {?>value="" <? }?> onKeyDown="validateDiv(\'mobileVal\');" /><div id="mobileVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="45" class="form_text">Email Id</td>    <td class="alert_msg"><input name="Email" id="Email" type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else { ?>value=""<? } ?>   onblur="onBlurDefault(this,\'Email Id\');" onFocus="removetooltip();"  onChange="insertData();" tabindex=11 onKeyDown="validateDiv(\'emailVal\');" class="input" /><div id="emailVal"></div></td>  </tr><tr>    <td height="45" class="form_text">Are you a Credit card holder?</td>    <td  class="form_text"><input type="radio"  name="CC_Holder" id="CC_Holder" value="1" tabindex="12" style="border:none;" onClick="addElement(); validateDiv(\'ccholderVal\');" > Yes <input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="13" value="0" onClick="removeElement(); validateDiv(\'ccholderVal\'); "> No  <div id="ccholderVal" class="alert_msg" ></div> </td>  </tr>	<tr align="left"> <Td id="myDivcc"  class="form_text" ></Td><Td id="myDivcc1"  ></Td>		  </tr>  <tr>    <td height="0" colspan="2"align="center" class="form_text" style="font-size:10px; text-align:left;"><input type="checkbox"  name="accept" style="border:none;" checked tabindex="15" > I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="0" colspan="2" align="center">&nbsp;</td> </tr>  <tr>    <td height="45" colspan="2" align="center"><input type="image" name="Submit" src="images/get-quote-btn-newlp.png" width="119" height="45" border:none;" tabindex="16" /></td>    </tr>    </table>';

}
</script>
</head>
<body>
<div class="header-newpl-main">
<div class="header-newpl-main-b">
<div class="logo-new1d4l"><img src="images/deal4loans-new-lp-logo.png" width="163" height="61" alt="deal4loans"></div>
<div class="top-right-boxbank">List of top Personal Loans Banks in India<br>
<div style="font-size:14px; margin-top:10px;">ICICI Bank  |  HDFC Bank |  Kotak Bank |  Fullerton |  Bajaj Finserv |  SBI | IndusInd Bank | Tata Capital </div>
</div>
<div style="clear:both;"></div>
</div>
</div>
</div>
<div class="apl_second_container" style="padding-top:3px;">
 <div class="column_wrapper">
  <div class="column_b" >
  <div class="personal_loan" >Personal Loan Request</div>
  <div id="example-two">
		<ul class="nav">
		  	<?php 
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
		if ($iphone || $android || $palmpre || $ipod || $berry == true) 
		{
			 $shClass = 'class="hide"';
			 $shClassMobile = '';
		
		?>
       <div class="tab_hide"><li class="nav-one"><a href="#fillform" >Get Quote</a></li></div>
			<li class="nav2"><a href="#leavenumber" class="current">Leave Your Number</a></li>
        <?php
		}
		else
		{
			$shClass = '';
		   $shClassMobile = 'class="hide"';
		?>
        	<li class="nav-one"><a href="#fillform" class="current">Get Quote</a></li>
			<div class="tab_hide"><li class="nav2"><a href="#leavenumber">Leave Your Number</a></li></div>
		<?php
        }
	
		?>
		</ul>
		<div class="list-wrap">
		<div id="fillform" style="height:auto;"  <?php echo $shClass; ?>>	
<form name="personalloan_form" action="insert_personal_loan_value_step1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="source" value="<? echo $retrivesource; ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="personal_text">Professional Details</td>
  </tr>
  <tr>
    <td width="209" height="45" class="form_text">Loan Amount</td>
    <td width="291" height="30"><input  name="Loan_Amount" class="input"  id="Loan_Amount"  tabindex="1" onFocus="this.select();" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanVal');"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /><div id="loanVal"  class="alert_msg"></div></td>
  </tr>
  <tr><td></td><td><span id='formatedlA' style='font-family: Verdana,'Raleway';	font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana,'Raleway';	font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;'></span></td>
  <tr>
    <td height="45" class="form_text">Occupation</td>
    <td height="30"><select  name="Employment_Status" class="select" id="Employment_Status" onChange="chgtxtsal(); addcmp_nme(); validateDiv('empStatusVal');" tabindex="2">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusVal" class="alert_msg"></div>
              </td>
  </tr>
    <tr align="left">
  <td id="myCmpDiv" class="form_text"></td><td id="myCmpDiv1"></td>
</tr>	
<tr align="left">
  <td id="myanualtDiv" class="form_text" ></td><td id="myanualtDiv1"></td>
</tr>
  <tr>
    <td height="45" class="form_text"><div id="chgtxt">Annual Income</div></td>
    <td><input name="IncomeAmount" class="input" id="IncomeAmount"  tabindex="4" onFocus="this.select();" onBlur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyDown="validateDiv('netSalaryVal');"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"/><div id="netSalaryVal" class="alert_msg"></div> </td>
  </tr>
   <tr><td></td><td><span id='formatedIncome' style="font-family: Verdana,'Raleway';font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;"></span><span id='wordIncome' style="font-family: Verdana,'Raleway';	font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;"></span></td></tr>
  <tr>
    <td height="44" class="form_text">City</td>
    <td><select  name="City" class="select" id="City"  tabindex="5" onChange=" addPersonalDetails(); validateDiv('cityVal');" ><option value="Select Your City">Select your City</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Others">Others</option></select><div id="cityVal" class="alert_msg"></div> </td>
  </tr>
  <tr>
    <td align="left" class="form_text" id="othCitDiv"></td>
    <td id="othCitvalDiv"></td>
  </tr>
   <tr>
    <td height="34" colspan="2" class="form_text"  id="personalDetails"><table align="center" width="100%"><tr><td align="center"><img src="images/get-quote-btn-newlp.png" width="119" height="45" /></td></tr></table></td>
  </tr>
  <tr>
    <td height="20" colspan="2" align="center" class="form_text">&nbsp;</td>
  </tr>
</table>
		  </form>
		</div>
		<div id="leavenumber" <?php echo $shClassMobile; ?>>
		 <form name="personal_form" action="applypersonal-loans-continue.php" method="POST" onSubmit="return chkploan(document.personal_form);">
         <input type="hidden" name="source2" value="<? echo $retrivesource; ?>"> 
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" class="personal_text"> </td>
  </tr>
  <tr>
    <td height="35" colspan="2" style="color: #0072bc;" class="form_text">      Leave your Contact Number &amp; our loan experts will call back with best offers.
      <div id="loanVal2"  class="alert_msg"></div></td>
    </tr>
  <tr>
    <td width="209" height="35" class="form_text">Full Name</td>
    <td width="291" height="30">
      <input name="Name2" type="text" class="input" id="Name2" onKeyDown="validateDiv('nameVal2');" ><div id="nameVal2"  class="alert_msg"></div></td>
  </tr>
  <tr>
    <td width="209" height="35" class="form_text">Mobile No.</td>
    <td width="291" height="30" style="color:#0072bc; font-family:Verdana, Geneva, sans-serif; font-size:12px;">+91
         <input name="Phone2" type="text" class="mobile" id="Phone2" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="10" onKeyDown="validateDiv('mobileVal2');" ><div id="mobileVal2"  class="alert_msg"></div></td>
  </tr>
  <tr>    <td colspan="2"align="center" class="form_text" style="font-size:10px; text-align:left;"><input type="checkbox"  name="accept2" style="border:none;" checked  > I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal2" class="alert_msg"></div></td>  </tr>
  <tr>
    <td height="20" colspan="2" align="center" class="form_text">&nbsp;</td>
  </tr>
  <tr>
    <td height="35" colspan="2" align="center" class="form_text"><input type="image" name="Submit2" src="d4limages/aplp_submit_btn-new.jpg" style="width:173px; height:40px; border:none;" /></td>
  </tr>
</table></form>
		</div>
	  </div> <!-- END List Wrap -->
	</div>
   </div> 
 <div style="clear:both;"></div>   
   <div style="color:#151515; font-family:Arial, Helvetica, sans-serif; font-size:11px; margin-top:10px;"></div>
 <div style="clear:both;"></div>
   <div style="clear:both;"></div>
   <div class="step" style="margin-top:10px;">
   <img src="d4limages/step-banner-new.gif" width="252" height="105"></div>
   <div class="rewards2" style="margin-top:10px;"><img src="d4limages/welcome-rewards-new.gif" width="252" height="104"></div>
 
   </div>
 
  
  <div class="column_a">
  <div class="why_text_box-right-new"> 
    <p>We will ensure you get </p>
    <p><strong style="font-size:33px;">Personal Loan</strong> at <strong style="font-size:33px;">Lowest Rate</strong><br>
    </p>
  </div>
  <div class="why_text_box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td class="text_head-h" >Make huge savings from offers as:</td>
     </tr>
     <tr>
       <td class="text_head-bullet" style="color:#CC0000;"><ul>
         <li>Instant quotes on Eligibility from 12 Banks.</li>
         <li>Rates from <strong>11.50% to 19%.</strong></li>
         <li>Processing Fee offers starts 500.</li>
         <li>Tenure minimum 1 year to maximum 7 Years.</li>
         <li>First time ever <strong>Flexi Loan</strong> from 1 Bank, pay <br>
interest only on used amount.</li>
         
         </ul></td>
     </tr>
   </table>
 </div>
 
 <div class="table_bg" style="background:none; ">
   <table width="98%" border="0" cellpadding="5" cellspacing="1">
    <tr>
      <td height="25" colspan="3" align="center" valign="middle" bgcolor="#FFFFFF" style="font-family:'Raleway'; font-size:16px; color:#057bb6;"><em>Flexi Loan at your Convenience</em></td>
      </tr>
    <tr>
      <td width="328" height="30" valign="middle" bgcolor="#4ADBFF"></td>
<td width="365" height="30" align="center" valign="middle" bgcolor="#4ADBFF" style="font-family:'Raleway'; font-size:14px; color:#FFF;">Flexi Loan Account Repayment</td>
<td width="232" height="30" align="center" valign="middle" bgcolor="#4ADBFF" style="font-family:'Raleway'; font-size:14px; color:#FFF;">Normal Term loan Repayment</td>
</tr>
<tr>
<td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Loan Amount </td>
<td width="365" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family: 'Raleway'; font-size:12px;">500000</td>
<td width="232" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">500000</td>
</tr>
<tr>
<td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">ROI </td>
<td width="365" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">15.25%</td>
<td width="232" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">14.00%</td>
</tr>
<tr>
<td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Tenor </td>
<td width="365" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">48</td>
<td width="232" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">48</td>
</tr>
<tr>
<td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Part Prepayment <strong style="font-weight:normal; font-size:10px;">(13th&nbsp;Month)</strong></td>
<td width="365" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">300000</td>
<td width="232" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Nil</td>
</tr>
<tr>
<td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Withdrawal <strong style="font-weight:normal; font-size:10px;">(14th&nbsp;month)</strong></td>
<td width="365" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">100000</td>
<td width="232" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Nil</td>
</tr>
<tr>
<td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Part Pre Payment <strong style="font-weight:normal; font-size:10px;">(15th&nbsp;month)</strong></td>
<td width="365" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">300000</td>
<td width="232" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Nil</td>
</tr>
<tr>
<td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Withdrawal <strong style="font-weight:normal; font-size:10px;">(20th&nbsp;Month)</strong></td>
<td width="365" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">150000</td>
<td width="232" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Nil</td>
</tr>
<tr>
<td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">Total Interest Paid </td>
<td width="365" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">113661</td>
<td width="232" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:12px;">155835</td>
</tr>
<tr>
<td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:14px; color:#000;"><strong>Savings</strong></td>
<td colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:14px; color:#390;"><strong>42,174</strong></td>
</tr><tr>
  <td width="328" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:14px;"><strong>Interest Saved</strong></td>
  <td colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" style="color:#333; font-family:'Raleway'; font-size:14px; color:#390;"><strong>27%</strong></td>
</tr>
<tr>
  <td height="35" colspan="3" valign="middle" bgcolor="#F1EEEE" class="text_head-h" style=" font-family:'Raleway'; font-size:19px;"><strong style="color:#ca4d02; font-size:19px;">54,</strong> <strong style="color:#08809e;">22,</strong> <strong style="color:#0277c3;">845</strong> quotes taken</td>
</tr>
   </table>
   <div style="clear:both;"></div>
 </div>
  <div style="clear:both;"></div>
 <div class="bannerhide" style="background:none; ">
   <div style="clear:both; height:5px;"><span style="font-size:12px;"><div style="color:#333; font-family:'Raleway'; font-size:12px;">All Loans above one year tenure. No short term Loans.</div> <div style="color:#333; font-family:'Raleway'; font-size:12px;">We do not do Pay Day Loans. </div><div style="color:#333; font-family:'Raleway'; font-size:12px;">All loans provided by Banks and N.B.F.C.</div> </span></div><div style="clear:both;"></div>
 </div>
  </div>
  <div style="clear:both;"></div>

  </div>
<br>
<br>
 <div style="clear:both;"></div>
  <?php include 'footer_landingpage.php'; ?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
 
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script></body>
</html>