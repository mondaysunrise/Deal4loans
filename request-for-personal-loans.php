<?php  require 'scripts/db_init.php'; 

$retrivesource="Pl display";
?>
<!DOCTYPE html>
<html>
<head>
<title>Personal Loan</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="css/apply-personal-loans-lp-styles-new.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/pl_apply-tab_styles-new.css">
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
#ajax_listOfOptions{position:absolute;width:250px;height:160px;overflow:auto;border:1px solid #317082;background-color:#FFF;color:#000;font-family:Verdana, Arial, Helvetica, sans-serif;text-align:left;font-size:10px;z-index:100}
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
	document.getElementById('loanVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Loan Amount!</span>";
	Form.Loan_Amount.focus();
	return false;
}

if(Form.Employment_Status.selectedIndex==0)
{
	document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Employment Status!</span>";
	Form.Employment_Status.focus();
	return false;
}
if(Form.Employment_Status.value==1)
{
	if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Type slowly for Autofill") || (Form.Company_Name.value=="Company Name"))
	{
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
	document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Income!</span>";
	Form.IncomeAmount.focus();
	return false;
}
if(Form.City.selectedIndex==0)
{
	document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Select City!</span>";		
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
	document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Other City!</span>";
Form.City_Other.focus();
return false;
}

if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
{
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Your name</span>";	
	Form.Name.focus();
	return false;
}
else if(containsdigit(Form.Name.value)==true)
{
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name Contains Numbers</span>";	
	Form.Name.focus();
	return false;
}

for (var i = 0; i < Form.Name.value.length; i++) 
{
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) 
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name has special characters</span>";		
		Form.Name.focus();
		return false;
  	}
}

if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Date of Birth</span>";
	Form.day.select();
	return false;
}
else if(!num.test(Form.day.value))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Date of Birth</span>";
	Form.day.select();
	return false;
}
else if((Form.day.value<1) || (Form.day.value>31))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Day, Range 1-31</span>";
	Form.day.select();
	return false;
}
else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Month of Birth</span>";
	Form.month.select();
	return false;
}
else if(!num.test(Form.month.value))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Month of Birth</span>";
	Form.month.select();
	return false;
}
else if((Form.month.value<1) || (Form.month.value>12))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Month, Range 1-12</span>";
	Form.month.select();
	return false;
}
else if((Form.month.value==2) && (Form.day.value>29))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'> February, Only 29 days.</span>";
	Form.day.select();
	return false;
}
else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Year of Birth</span>";
	Form.year.select();
	return false;
}
else if(!num.test(Form.year.value))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Year of Birth</span>";
	Form.year.select();
	return false;
}
else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>February, Only 28 days.</span>";
	Form.day.select();
	return false;
}
else if(Form.year.value.length != 4)
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter 4 Digit</span>";
	Form.year.select();
	return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Age group 21 - 62</span>";
	Form.year.select();
	return false;
}
else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Cannot have 31st Day</span>";
	Form.day.select();
	return false;
}
if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
	document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Mobile Number</span>";
	Form.Phone.focus();
	return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
		  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Numeric Value</span>";
		  Form.Phone.focus();
		  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
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

myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
				if (Form.Card_Vintage.selectedIndex==0)
				{
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Holding Credit Card Since!</span>";	
						Form.Card_Vintage.focus();
						return false;
				}
				}
					myOption = i;
			}
		}
		if (myOption == -1) 
		{
			document.getElementById('ccholderVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Credit Card holder or not!</span>";	
			return false;
		}
		
	if(!Form.accept.checked)
	{
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
	document.getElementById('nameVal2').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Your name</span>";		
	Form.Name2.focus();
	return false;
}
else if(containsdigit(Form.Name2.value)==true)
{
	document.getElementById('nameVal2').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name Contains Numbers</span>";		
	Form.Name2.focus();
	return false;
}

for (var i = 0; i < Form.Name2.value.length; i++) 
{
  	if (iChars.indexOf(Form.Name2.value.charAt(i)) != -1) 
	{
		document.getElementById('nameVal2').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name has special characters</span>";		
		Form.Name2.focus();
		return false;
  	}
}

if((Form.Phone2.value=='Mobile No') || (Form.Phone2.value=='') || Trim(Form.Phone2.value)==false)
{
	document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Mobile Number</span>";
	Form.Phone2.focus();
	return false;
}
 else if(isNaN(Form.Phone2.value)|| Form.Phone2.value.indexOf(" ")!=-1)
		{
		  document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Numeric Value</span>";
		  Form.Phone2.focus();
		  return false;  
		}
        else if (Form.Phone2.value.length < 10 )
		{
		  document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor'>Enter 10 Digits</span>";
		  Form.Phone2.focus();
		  return false;
        }
else if ((Form.Phone2.value.charAt(0)!="9") && (Form.Phone2.value.charAt(0)!="8") && (Form.Phone2.value.charAt(0)!="7"))
		{
            document.getElementById('mobileVal2').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Start with 9 or 8 or 7</span>";
			 Form.Phone2.focus();
               return false;
        }
	if(!Form.accept2.checked)
	{
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
{ var citemps=document.personalloan_form.Employment_Status.value;
	var ni = document.getElementById('myCmpDiv');
	var ni1 = document.getElementById('myCmpDiv1');
		if(ni.innerHTML=="")
		{
		
		if(document.personalloan_form.Employment_Status.selectedIndex >0 && citemps==1)
			{
				ni.innerHTML ='Company Name';
				ni1.innerHTML ='<input name="Company_Name" id="Company_Name" type="text" class="input" onBlur="onBlurDefault(this,\'Type slowly for Autofill\');"  onFocus="onFocusBlank(this,\'Type slowly for Autofill\');"  onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)" value="Type slowly for Autofill" tabindex=10 autocomplete="off" onkeydown="validateDiv(\'companyVal\');" /><div id="companyVal"></div>';
			}
		}
		else
	{
		ni.innerHTML="";
		ni1.innerHTML="";
	}
		return true;
}
function addhdfclife()
{
	var ni1=document.getElementById('hdfclife');var cit=document.personalloan_form.City.value;var if(cit =="Ahmedabad" || cit =="Bangalore" || cit =="Bhubneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Coimbatore" || cit =="Delhi" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Nagpur" || cit =="Pune" || cit =="Vadodara" || cit =="Baroda" || cit =="Vizag"){ni1.innerHTML='<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>'}else{ni1.innerHTML=''}return true}

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
		ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td align="left" valign="middle" class="bldtxt" colspan="2" style="padding-top:3px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="48%"  align="left" class="personal_text" colspan="2"> Personal Details</td></tr><tr><td width="4%" style="font-size:10px; font-weight:normal; color:#FFF;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="96%" align="left"class="sbi_text_a"  style="font-size:10px; font-weight:normal; color:#FFF;">Your Information is secure with us & will not be shared without your consent</td></tr></table></td></tr>    <tr>    <td width="35%" height="45" class="form_text">Full Name</td>    <td width="65%"  class="alert_msg"><input name="Name" type="text" class="input" id="Name" tabindex=6  onFocus="onFocusBlank(this,\'Name\');"  onBlur="onBlurDefault(this,\'Name\');" onChange="insertData();" <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }else {?>value=""<? }?>  onkeydown="validateDiv(\'nameVal\');"/><div id="nameVal"></div></td>  </tr>  <tr>    <td height="45" class="form_text">DOB</td>    <td  class="alert_msg"><input name="day" type="text" class="month" id="day" tabindex=7  onFocus="onFocusBlank(this,\'dd\');" onBlur="onBlurDefault(this,\'dd\');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="dd" maxlength="2" onKeyDown="validateDiv(\'dobVal\');"/> <input name="month" type="text" class="month" id="month" tabindex=8 onFocus="onFocusBlank(this,\'mm\');" onBlur="onBlurDefault(this,\'mm\');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="mm" maxlength="2" onKeyDown="validateDiv(\'dobVal\');" /> <input name="year" type="text" class="year" id="year" tabindex=9  onFocus="onFocusBlank(this,\'yyyy\');"   onBlur="onBlurDefault(this,\'yyyy\');" onChange="intOnly(this); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="yyyy" maxlength="4" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal"></div></td>  </tr>  <tr>   <td height="45" class="form_text">Mobile No.</td>    <td  class="form_text"  >+91 <input name="Phone" type="text" class="mobile" id="Phone"  tabindex=10 onFocus="addtooltip();" onChange="intOnly(this); tosendsms(); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="10"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }else {?>value="" <? }?> onKeyDown="validateDiv(\'mobileVal\');" /><div id="mobileVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="45" class="form_text">Email Id</td>    <td class="alert_msg"><input name="Email" id="Email" type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else { ?>value=""<? } ?>   onblur="onBlurDefault(this,\'Email Id\');" onFocus="removetooltip();"  onChange="insertData();" tabindex=11 onKeyDown="validateDiv(\'emailVal\');" class="input" /><div id="emailVal"></div></td>  </tr><tr>    <td height="45" class="form_text">Are you a Credit card holder?</td>    <td  class="form_text"><input type="radio"  name="CC_Holder" id="CC_Holder" value="1" tabindex="12" style="border:none;" onClick="addElement(); validateDiv(\'ccholderVal\');" > Yes <input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="13" value="0" onClick="removeElement(); validateDiv(\'ccholderVal\'); "> No  <div id="ccholderVal" class="alert_msg" ></div> </td>  </tr>	<tr align="left"> <Td id="myDivcc"  class="form_text" ></Td><td id="myDivcc1"  ></Td>		  </tr>  <tr>    <td height="0" colspan="2"align="center" class="form_text" style="font-size:10px; text-align:left;"><input type="checkbox"  name="accept" style="border:none;" checked tabindex="15" > I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="0" colspan="2" align="center">&nbsp;</td> </tr>  <tr>    <td height="45" colspan="2" align="center"><input type="image" name="Submit" src="d4limages/aplp_get-quote-btn-new.jpg" style="width:172px; height:40px; border:none;" tabindex="16" /></td>    </tr>    </table>';

}
</script>
</head>
<body>
<div class="apl_top_wrapper">
<div class="apl_logo_container"><div class="logo_box_b"><img src="d4limages/aplp_d4l-logo.jpg"  height="44" /></div>
<div class="logo_text">Personal Loans by Choice not by Chance!</div>
<div class="call_us_box">&nbsp;</div>
</div>
</div>
<div class="apl_second_container" style="padding-top:3px;">
 <div class="column_wrapper">
  <div class="column_b" >
  <div class="personal_loan" >Personal Loan Request</div>
  <div id="example-two">
		<ul class="nav">
			<li class="nav-one"><a href="#fillform" class="current">Get Quote</a></li>
			<div class="tab_hide"><li class="nav2"><a href="#leavenumber">Leave Your Number</a></li></div>
		</ul>
		<div class="list-wrap">
		<div id="fillform" style="height:auto;">
<form name="personalloan_form" action="insert_personal_loan_value_step1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="source" value="<? echo $retrivesource; ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="/request-for-personal-loans.php">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" class="personal_text">Professional Details</td>
  </tr>
  <tr>
    <td width="209" height="45" class="form_text">Loan Amount</td>
    <td width="291" height="30"><input  name="Loan_Amount" class="input"  id="Loan_Amount"  tabindex="1" onFocus="this.select();" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanVal');"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /><div id="loanVal"  class="alert_msg"></div></td>
  </tr>
  <tr><td></td><td><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;'></span></td>
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
   <tr><td></td><td><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
  <tr>
    <td height="44" class="form_text">City</td>
    <td><select  name="City" class="select" id="City"  tabindex="5" onChange=" addPersonalDetails(); validateDiv('cityVal');" ><option value="Select Your City">Select your City</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Others">Others</option></select><div id="cityVal" class="alert_msg"></div> </td>
  </tr>
  <tr>
    <td align="left" class="form_text" id="othCitDiv"></td>
    <td id="othCitvalDiv"></td>
  </tr>
   <tr>
    <td height="34" colspan="2" class="form_text"  id="personalDetails"><table align="center" width="100%"><tr><td align="center"><img src="d4limages/aplp_get-quote-btn-new.jpg" width="172" height="40" /></td></tr></table></td>
  </tr>
  <tr>
    <td height="20" colspan="2" align="center" class="form_text">&nbsp;</td>
  </tr>
</table>
		  </form>
		</div>
		<div id="leavenumber" class="hide">
		 <form name="personal_form" action="applypersonal-loans-continue.php" method="POST" onSubmit="return chkploan(document.personal_form);">
         <input type="hidden" name="source2" value="Pl display" id="source2"> 
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" class="personal_text"> </td>
  </tr>
  <tr>
    <td height="35" colspan="2" style="color: #FFF;" class="form_text">      Leave your Contact Number &amp; our loan experts will call back with best offers.
      <div id="loanVal2"  class="alert_msg"></div></td>
    </tr>
  <tr>
    <td width="209" height="35" class="form_text">Full Name</td>
    <td width="291" height="30">
      <input name="Name2" type="text" class="input" id="Name2" onKeyDown="validateDiv('nameVal2');" ><div id="nameVal2"  class="alert_msg"></div></td>
  </tr>
  <tr>
    <td width="209" height="35" class="form_text">Mobile No.</td>
    <td width="291" height="30" style="color:#FFF; font-family:Verdana, Geneva, sans-serif; font-size:12px;">+91
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
   <div style="clear:both;"></div>
   <div class="step" style="margin-top:10px;">
  <img src="d4limages/step-banner-new.gif" width="252" height="105"></div>
   <div class="rewards" style="margin-top:10px;"><img src="d4limages/welcome-rewards-new.gif" width="252" height="104"></div> 
   </div>  
  <div class="column_a">
  <div class="banks_text"> List of top Personal Loans Banks in India</div>
 <div class="apl_radius">
 <div class="menu_display"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td align="center" style="color:#083b65; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">ICICI Bank</td>
    <td align="center" style=" color:#041d6f; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">HDFC Bank</td>
  </tr>
  <tr>
    <td align="center" style=" color:#00003d; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;"> ING Vysya</td>
    <td align="center" style="color:#ed1c24; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;">Kotak</td>
  </tr>
    <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
    <td align="center" style="color:#cd5a13; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">Fullerton</td>
    <td align="center" style="color:#0076bc; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;"> Bajaj Finserv</td>
    <td align="center" style="color:#0076bc; font-family: Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;">SBI</td>
  </tr>
  </table></td></tr>
</table>
</div>
 <div class="bank_text" id="menu_display_b">
 <ul><li style="color:#083b65;">
 ICICI Bank</li>
 <li style=" color:#041d6f;">
 HDFC Bank</li>
 <li style=" color:#00003d;">
 ING Vysya</li>
 <li style="color:#ed1c24;">
 Kotak</li>
   <li style="color:#cd5a13;">
 Fullerton </li>
    <li style="color:#0076bc;">
 Bajaj Finserv </li>
   <li style="color:#0076bc; text-align:center !important; line-height:none; border:none;">
 SBI </li>
 </ul>
 </div>
 </div> 
 <div class="table_bg">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td width="93%" valign="middle" class="text_white"  style="height:28px; background:url(d4limages/aplp_arrow-new-green.png) no-repeat;">Sample Personal Loan Quotes</td>
       <td width="7%" align="left" style="height:28px;">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:thin solid #FFF;">
         <tr>
           <td width="15%" height="25" align="center" bgcolor="#719738" class="text_white_b" style="border-right: #FFF thin solid;">Bank </td>
           <td width="21%" align="center" bgcolor="#719738" class="text_white_b" style="border-right:thin solid #FFF;">Interest Rate</td>
           <td width="24%" align="center" bgcolor="#719738" class="text_white_b" style="border-right:thin solid #FFF;">Eligible Loan Amt.</td>
           <td width="19%" align="center" bgcolor="#719738" class="text_white_b" style="border-right:thin solid #FFF;">EMI</td>
           <td width="21%" align="center" bgcolor="#719738" class="text_white_b">Pre-Payment</td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="15%" align="center" bgcolor="#FFFFFF" class="text_white_c">Bank A<br>
             Bank B<br>
             Bank C<br>
             Bank D</td>
           <td width="19%" align="center" bgcolor="#FFFFFF" class="text_white_c">14%<br>
             14.25%<br>
             15%<br>
             16%</td>
           <td width="26%" align="center" bgcolor="#FFFFFF" class="text_white_c">Rs. 1,00,000<br>
             Rs. 1,25,000<br>
             Rs. 1,80,000<br>
             Rs. 1,50,000</td>
           <td width="19%" align="center" bgcolor="#FFFFFF" class="text_white_c">Rs. 2,733<br>
             Rs. 3,432<br>
             Rs. 5,010<br>
             Rs. 4,251</td>
           <td width="21%" align="center" bgcolor="#FFFFFF" class="text_white_c">4%<br>
             Nil<br>
             Nil<br>
             4%</td>
         </tr>
         </table></td>
     </tr>
   </table>
   <div style="clear:both;"></div>
   <div class="row_b"><span class="text_white_b" style="font-size:12px;"><strong>Personal Loan</strong> quotes taken this month from <strong>Deal4loans</strong></span>
     <div class="count_wrap"><table width="100" border="0" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#FFFFFF" class="text_d">5</td>
    <td bgcolor="#FFFFFF" class="text_d">9</td>
    <td bgcolor="#FFFFFF" class="text_d">9</td>
    <td bgcolor="#FFFFFF" class="text_d">0</td>
    <td bgcolor="#FFFFFF" class="text_d">5</td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>
<div class="row_b" style="margin-top:5px;"><span class="text_white_b" style="font-size:12px;">Loans quotes taken from <strong>Deal4loans </strong></span>
  <div class="count_wrap_b"><table width="130" border="0" align="right" cellpadding="0" cellspacing="2">
  <?php 

$total_amtcntr="select Amount From totalLoans Where (Name='Totalcountr' and flag=1)";
list($count1,$total_amtcntr)=MainselectfuncNew($total_amtcntr,$array = array());
$ttl_countrtaken = $total_amtcntr[0]['Amount'];
  ?>
  <tr>
<? 
$number=$ttl_countrtaken;
$revarrnumber=str_split($number);
$contstr=count($revarrnumber);
for($i=0; $i<$contstr; $i++)
{ ?>
<td bgcolor="#FFFFFF" class="text_d"><? echo $revarrnumber[$i]; ?></td>
<? } ?>
  </tr>
</table>
</div>
</div>
<div style="clear:both;"></div>
</div>      
 </div> 
 <div class="why_text_box">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td class="text_head" style="font-size:20px;">Why Deal4loans.com - Widest Choice of Banks</td>
     </tr>
     <tr>
       <td class="body_apl_text" style="color:#CC0000"><ul>
         <li><strong style="color:#454646;">Get free instant quote</strong> on Rates, Emi, Eligibility, <span style="font-size:17px; font-weight:bold;">Fees</span> &amp; Documents from all Banks.</li>
         <li>Pick best Bank as per your requirement.</li>
         <li>Rate as low as <span style="font-size:17px; font-weight:bold;">11.99%</span> on loan 20lacs  &amp; above.</li>
         <li><span style="font-size:17px; font-weight:bold;">3</span> Banks with 0 Prepayment Charges.</li>
         <li>Loan disbursal in <span style="font-size:17px; font-weight:bold;">48</span> hours from <span style="font-size:17px; font-weight:bold;">5</span> Banks.</li>
         </ul></td>
     </tr>
   </table>
 </div> 
  </div>
  <div style="clear:both;"></div>  
</div>
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
