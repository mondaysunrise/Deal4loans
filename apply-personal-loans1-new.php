<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/functionshttps.php';
	require 'scripts/db_init.php';

if(isset($_REQUEST["source"]))
	{
		$source = $_REQUEST["source"];
	}
	else	
	{
		$source = "personalloan https";
	}

	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loans | Personal Loan Rates | Personal Loan EMI</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<script type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script src="jscript-marquee.js" type="text/javascript" ></script>
<link href="marquee.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<link href="css/personal-loans-styles-new.css" type="text/css" rel="stylesheet" >
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-hhtpspllist.js"></script>

<style type="text/css">
.ui-dialog { position: absolute; padding: .2em; width: 700px; overflow: hidden; z-index:1001;}
.ui-dialog .ui-dialog-titlebar { padding: .4em 1em; position: relative;  }
.ui-dialog .ui-dialog-title { float: left; margin: .1em 16px .1em 0; font-size:11px; line-height:18px;}
.ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }
.ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }
.ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }
.ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: .5em 0 0 0; padding: .3em 1em .5em .4em;}
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { float: right; }
.ui-dialog .ui-dialog-buttonpane button{ margin: .5em .4em .5em 0; cursor: pointer; }
.ui-dialog .ui-resizable-se { width:14px; height: 14px; right: 3px; bottom: 3px; }
.ui-draggable .ui-dialog-titlebar { cursor: move; }
.bldtxt{font-weight:700;line-height:16px;color:#4f4d4d}
.txt ul{margin:0 0 0 2px;padding:0 0 0 2px}
.txt ul li{background:url(images/cl/sbi_bullet1.jpg) no-repeat 0 4px;list-style-type:none;color:#292323;padding:0 0 4px 15px}
#ajax_listOfOptions{position:absolute;width:250px;height:160px;overflow:auto;border:1px solid #317082;background-color:#FFF;color:#000;font-family:Verdana, Arial, Helvetica, sans-serif;text-align:left;font-size:10px;z-index:100}
#ajax_listOfOptions div{cursor:pointer;font-size:10px;margin:1px;padding:1px}
#ajax_listOfOptions .optionDivSelected{background-color:#2375CB;color:#FFF}
#ajax_listOfOptions_iframe{background-color:red;position:absolute;z-index:5}
form{display:inline}
.alert_msg{color:#FF0000; font-weight:bold; font-size:10px;}
.sagscroller {
width: 100%!important;
height: 100px;
overflow: hidden;
position: relative;

border: 2px solid black;
border-radius: 8px;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;
}


#mysagscroller2 ul li{
border-width:0;
display:block; /*this causes each image to be flush against each other*/
}

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
				ni1.innerHTML = '<select size="1" name="Card_Vintage" class="apply_pl_input"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select>';
			}
	}
	return true;
}

function removeElement()
{
	var ni = document.getElementById('myDivcc');
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
		document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";
		Form.Loan_Amount.focus();
		return false;
	}
	if(Form.Employment_Status.selectedIndex==0)
	{
		//alert(Form.Employment_Status.selectedIndex);
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";
		Form.Employment_Status.focus();
		return false;
	}
	if(Form.Employment_Status.value==1)
	{
		if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Type slowly for Autofill") || (Form.Company_Name.value=="Company Name"))
		{
			//alert("Kindly fill in your Company Name!");
			document.getElementById('companyVal').innerHTML = "<span  class='hintanchor'>Enter Company Name!</span>";
			Form.Company_Name.focus();
			return false;
		}
		else if(Form.Company_Name.value.length < 3)
		{
			document.getElementById('companyVal').innerHTML = "<span  class='hintanchor'>Enter Company Name!</span>";
			Form.Company_Name.focus();
			return false;
		}
	}
	if((Form.IncomeAmount.value=='') || Form.IncomeAmount.value<=0)
	{
		alert("kee");
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Income!</span>";
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
		//	alert("Kindly fill in your other City!");
			document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City!</span>";
		
		Form.City_Other.focus();
		return false;
		}
		
		if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
		{
			//alert("Kindly fill in your Name!");
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
			Form.Name.focus();
			return false;
		}
		else if(containsdigit(Form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Name Contains Numbers</span>";		
		//	alert("Name contains numbers!");
			Form.Name.focus();
			return false;
		}
		for (var i = 0; i < Form.Name.value.length; i++) 
		{
			if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) 
			{
		//		alert ("Name has special characters.\n Please remove them and try again.");
				document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Name has special characters</span>";		
				Form.Name.focus();
				return false;
			}
		}		
		if((space.test(Form.day.value)) || (Form.day.value=="dd"))
		{
		//	alert("Kindly enter your Date of Birth");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Date of Birth</span>";
			Form.day.select();
			return false;
		}
		else if(!num.test(Form.day.value))
		{
		//	alert("Kindly enter your Date of Birth(numbers Only)");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Date of Birth</span>";
			Form.day.select();
			return false;
		}
		else if((Form.day.value<1) || (Form.day.value>31))
		{
			//alert("Kindly Enter your valid Date of Birth(Range 1-31)");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Day, Range 1-31</span>";
			Form.day.select();
			return false;
		}
		else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
		{
		//	alert("Kindly enter your Month of Birth");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Month of Birth</span>";
			Form.month.select();
			return false;
		}
		else if(!num.test(Form.month.value))
		{
		//	alert("Kindly enter your Month of Birth(numbers Only)");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Month of Birth</span>";
			Form.month.select();
			return false;
		}
		else if((Form.month.value<1) || (Form.month.value>12))
		{
		//	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month, Range 1-12</span>";
			Form.month.select();
			return false;
		}
		else if((Form.month.value==2) && (Form.day.value>29))
		{
		//	alert("Month February cannot have more than 29 days");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>February, Only 29 days.</span>";
			Form.day.select();
			return false;
		}
		else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
		{
		//	alert("Kindly enter your Year of Birth");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Year of Birth</span>";
			Form.year.select();
			return false;
		}
		else if(!num.test(Form.year.value))
		{
		//	alert("Kindly enter your Year of Birth(numbers Only) !");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Year of Birth</span>";
			Form.year.select();
			return false;
		}
		else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
		{
			//alert("February cannot have more than 28 days.");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>February, Only 28 days.</span>";
			Form.day.select();
			return false;
		}
		else if(Form.year.value.length != 4)
		{
			//alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter 4 Digit</span>";
			Form.year.select();
			return false;
		}
		else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
		{
		//	alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age group 21 - 62</span>";
			Form.year.select();
			return false;
		}
		else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
		{
			//alert("Cannot have 31st Day");
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Cannot have 31st Day</span>";
			Form.day.select();
			return false;
		}
		if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
		{
			//alert("Kindly fill in your Mobile Number!");
			document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter Mobile Number</span>";
			Form.Phone.focus();
			return false;
		}
		 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
		  //alert("Enter numeric value in ");
		  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter Numeric Value</span>";
		  Form.Phone.focus();
		  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
//		  alert("Please Enter 10 Digits"); 
		  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter 10 Digits</span>";
		  Form.Phone.focus();
		  return false;
        }
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
			alert("The number should start only with 9 or 8 or 7");
			document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Start with 9 or 8 or 7</span>";
			Form.Phone.focus();
			return false;
        }
		if(Form.Email.value=="")
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		
		var str=Form.Email.value
		var aa=str.indexOf("@")
		var bb=str.indexOf(".")
		var cc=str.charAt(aa)
		if(aa==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		else if(bb==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
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
						document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
						Form.Card_Vintage.focus();
						return false;
				}
				}
					myOption = i;
			}
		}
		if (myOption == -1) 
		{
			document.getElementById('ccholderVal').innerHTML = "<span  class='hintanchor'>Credit Card holder or not!</span>";	
			return false;
		}
		
	if(!Form.accept.checked)
	{
	document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms & Condition!</span>";	
		Form.accept.focus();
		return false;
	}
	if(Form.Email.value=="Email Id")
	{
		Form.Email.value=" ";
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
				ni1.innerHTML ='<input name="Company_Name" id="Company_Name" type="text" class="input" onBlur="onBlurDefault(this,\'Type slowly for Autofill\');"  onFocus="onFocusBlank(this,\'Type slowly for Autofill\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event, \'https://www.deal4loans.com/ajax-list-plcompanies.php\')" value="Type slowly for Autofill" tabindex=10 autocomplete="off" onkeydown="validateDiv(\'companyVal\');" /><div id="companyVal"></div>';
							}
		}
		else
	{
		ni.innerHTML="";
		ni1.innerHTML ='';
	}
		return true;
}

function chgtxtsal(){
	
	var nitxt1=document.getElementById('chgtxt');
	var nitxt=document.getElementById('myanualtDiv');
	
	var niadtxt=document.getElementById('myanualtDiv1');
	var citemp=document.personalloan_form.Employment_Status.value;
	if(citemp==0){
		nitxt1.innerHTML="Annual ITR";
		nitxt.innerHTML="Annual Turnover";
		niadtxt.innerHTML=" <select name='Annual_Turnover' id='Annual_Turnover' class='select'>		<option value=''>Please Select</option>	<option value='1' > 0 - 40 Lacs</option>	<option value='4' > 40 Lacs - 1 Cr</option>		<option value='2' > 1Cr - 3Crs </option>	<option value='3' >3Crs & above</option>		</select>"; }
		else{
			nitxt1.innerHTML="Annual Income";
//			niadtxt.innerHTML="";
			}}
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
	var ni9 = document.getElementById('showLogos');
	var ni10 = document.getElementById('hideLogos');
	
	if(document.personalloan_form.City.value=='Others')
	{
		ni7.innerHTML = 'Other City';
		ni8.innerHTML = '<input value="Other City" name="City_Other" id="City_Other" class="input" onBlur="onBlurDefault(this,\'Other City\');"  onfocus="onFocusBlank(this,\'Other City\');" onKeyUp="searchSuggest();" /><div id="CityOLayer"></div><div id="othercityVal"></div>';
	}
	else { ni8.innerHTML = '';		ni7.innerHTML = '';	}
		
	ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td align="left" valign="middle" class="bldtxt" colspan="3" style="padding-top:3px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td  align="left" class="pl_form_text" style="font-size:19px;" colspan="2"> Personal Details</td></tr><tr><td width="2%" style="font-size:10px; font-weight:normal; color:#7e5a09;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="98%" align="left" style="font-size:10px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;  color:#0992ba; font-weight:bold;"><strong>Your Information is secure with us & will not be shared without your consent</strong></td></tr></table></td></tr>    <tr>    <td width="42%" height="45" class="pl_form_text">Full Name</td>    <td colspan="2"  class="alert_msg"><input name="Name" type="text" class="input" id="Name" tabindex=6  onFocus="onFocusBlank(this,\'Name\');"  onBlur="onBlurDefault(this,\'Name\');" onChange="insertData();" value=""  onkeydown="validateDiv(\'nameVal\');"/><div id="nameVal"></div></td>  </tr> <tr>    <td height="7" colspan="3" class="pl_form_text"></td>  </tr>  <tr>    <td height="45" class="pl_form_text">DOB</td>    <td colspan="2"  class="alert_msg"><input name="day" type="text" class="form_dd" id="day" tabindex=7  onFocus="onFocusBlank(this,\'dd\');" onBlur="onBlurDefault(this,\'dd\');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="dd" maxlength="2" onKeyDown="validateDiv(\'dobVal\');"/> <input name="month" type="text" class="form_dd" id="month" tabindex=8 onFocus="onFocusBlank(this,\'mm\');" onBlur="onBlurDefault(this,\'mm\');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="mm" maxlength="2" onKeyDown="validateDiv(\'dobVal\');" /> <input name="year" type="text" class="form_dd" id="year" tabindex=9  onFocus="onFocusBlank(this,\'yyyy\');"   onBlur="onBlurDefault(this,\'yyyy\');" onChange="intOnly(this); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="yyyy" maxlength="4" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal"></div></td>  </tr>   <tr><td height="7" colspan="3" class="pl_form_text"></td>  </tr>  <tr>   <td height="45" class="pl_form_text">Mobile No.</td>    <td width="4%"  class="pl_form_text"  >+91 </td>  <td width="54%"  class="text_3"  ><input name="Phone" type="text" class="input" id="Phone"  tabindex="10" onfocus="addtooltip();" onchange="intOnly(this); tosendsms(); insertData();" onkeypress="intOnly(this);" onkeyup="intOnly(this);" maxlength="10"  value=""  onkeydown="validateDiv(\'mobileVal\');" />  <div id="mobileVal" class="alert_msg"></div></td></tr>    <tr>    <td height="7" colspan="3" class="pl_form_text"></td>  </tr>  <tr>    <td height="45" class="pl_form_text">Email Id</td>    <td colspan="2" class="alert_msg"><input name="Email" id="Email" type="text" value=""   onblur="onBlurDefault(this,\'Email Id\');" onFocus="removetooltip();"  onChange="insertData();" tabindex=11 onKeyDown="validateDiv(\'emailVal\');" class="input" /><div id="emailVal"></div></td>  </tr>  <tr>    <td height="7" colspan="3" class="pl_form_text"></td>  </tr>  <tr>    <td height="45" class="pl_form_text">Are you a Credit card holder?</td>    <td colspan="2"  class="pl_form_text"><input type="radio"  name="CC_Holder" id="CC_Holder" value="1" tabindex="12" style="border:none;" onClick="addElement(); validateDiv(\'ccholderVal\');" > Yes <input type="radio"  name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="13" value="0" onClick="removeElement(); validateDiv(\'ccholderVal\'); "> No  <div id="ccholderVal" class="alert_msg" ></div> </td>  </tr>	<tr align="left"> <Td id="myDivcc"  class="form_text" ></Td><Td colspan="2" id="myDivcc1"  ></Td>		  </tr> <tr>    <td height="7" colspan="3" class="pl_form_text"></td>  </tr> <tr>    <td height="0" colspan="3"align="center" class="pl_form_text" style="font-size:10px; text-align:left;"><input type="checkbox"  name="accept" style="border:none;" checked tabindex="15" > I authorize the website and its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me and this will override Dnc registration and agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="0" colspan="3" align="center">&nbsp;</td> </tr>  <tr>    <td height="45" colspan="3" align="center"><input type="image" name="Submit" src="images/pl-get-quote_btn_new_one.png" width="132" height="40" tabindex="16" /></td>    </tr>    </table>';
	
	ni9.innerHTML = '<div class="logo_second_box"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="20" class="pl_detail_text" style="font-size:15px; font-weight:bold;">Best Personal Loan Banks:</td>    </tr>    <tr>      <td align="left" valign="top" style="text-align:left;"><ul class="logo_list_b">        <li ><img src="d4limages/icici-bank-d4l.jpg" width="96" height="28"></li>        <li > <img src="d4limages/hdfc-logo-d4l.jpg" width="83" height="28"></li>        <li ><img src="d4limages/ing-logo-d4l.jpg" width="81" height="27"></li>        </ul>        <div style="clear:both;"></div>        <ul class="logo_list_b">        <li ><img src="d4limages/kotak-logo-d4l.jpg" width="66" height="25"></li>        <li ><img src="d4limages/fullerton-logo-d4l.jpg" width="90" height="27"></li>        <li ><img src="d4limages/bajaj-lending-d4l.jpg" width="104" height="30"></li>        </ul>                <div style="clear:both;"></div>        <ul class="logo_list_b">        <li ><img src="d4limages/sbi-logo-d4l.jpg" width="54" height="26"></li>        <li ><img src="d4limages/standrad-charterd-d4l.jpg" width="73" height="32"></li>      </ul></td>    </tr>  </table></div>';
	ni10.innerHTML = '';
}
</script>
<script>

var sagscroller1=new sagscroller({
	id:'mysagscroller',
	mode: 'manual' })

var sagscroller2=new sagscroller({
	id:'mysagscroller2',
	mode: 'auto',
	pause: 2500,
	animatespeed: 400 //<--no comma following last option
})

</script>
</head>
<body>
<div class="header">
<div class="logo_dl"><img src="images/d4l-logo-pl_new1.png" width="158" height="67" alt="logo"></div>
<div class="header_text header_head-text">Personal Loan for all your Financial needs
<div class="text_rewards_head">Welcome Rewards <br></div>
<div class="sub_text_rewards_head">Get cash back gifts upto Rs. 13500 on disbursal*</div>
</div>
</div>
<div class="clear_fix"></div>
<div class="wrapper">
<div class="left-wrapper">
<div class="form_box_wrapper">
<div class="form_head_box">Personal Loan Request</div>
<div class="clear_fix"></div>
 <form name="personalloan_form" action="insert_personal_loan_value_httpsstep.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="source" value="<? echo $source; ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="/apply-personal-loans.php">
<table width="96%" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td height="32" colspan="2" class="pl_form_text" style="font-size:19px;">Professional Details</td>
  </tr>
  <tr>
    <td width="209" height="28" class="pl_form_text">Loan Amount</td>
    <td width="291" height="30"><input  name="Loan_Amount" class="input"  id="Loan_Amount"  tabindex="1" onFocus="this.select();" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanVal');"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /><div id="loanVal"  class="alert_msg"></div></td>
  </tr>
  <tr><td colspan="2"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td>
  <tr>
    <td height="30" class="pl_form_text">Occupation</td>
    <td height="30"><select  name="Employment_Status" class="select" id="Employment_Status" onChange="chgtxtsal(); addcmp_nme(); validateDiv('empStatusVal');" tabindex="2">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusVal" class="alert_msg"></div>
              </td>
  </tr>
    <tr align="left">
  <td id="myCmpDiv" class="text_3"></td><td id="myCmpDiv1"></td>
</tr>	
<tr align="left">
  <td id="myanualtDiv" class="text_3" ></td><td id="myanualtDiv1"></td>
</tr>
  <tr>
    <td height="30" class="form_text"><div class="pl_form_text" id="chgtxt">Annual Income</div></td>
    <td><input   name="IncomeAmount" class="input" id="IncomeAmount"  tabindex="4" onFocus="this.select();" onBlur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyDown="validateDiv('netSalaryVal');"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"/> <div id="dialog-modal" > </div><div id="netSalaryVal" class="alert_msg"></div> </td>
  </tr>
   <tr><td colspan="2" align="left"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
  <tr>
    <td height="28" class="pl_form_text">City</td>
    <td><select  name="City" class="select" id="City"  tabindex="5" onChange="addPersonalDetails(); validateDiv('cityVal');" ><option value="Select Your City">Select your City</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Others">Others</option></select><div id="cityVal" class="alert_msg"></div> </td>
</tr>
<tr>
<td align="left" class="form_text" id="othCitDiv"></td>
<td id="othCitvalDiv"></td>
</tr>
<tr>
  <td height="34" colspan="2" align="center" class="form_text"  id="personalDetails"><img src="images/pl-get-quote_btn_new_one.png" alt="" width="132" height="40" border="0"></td>
</tr>
</table>
	  </form>
</div>
<div class="clear_fix"></div>
<div class="steps_box"><img src="images/steps-img.gif" width="100%" height="78" alt="steps"></div>
<div class="logos-box"><img src="images/icici-pl-new.png" width="111" height="36" alt="icici bank"></div>
<div class="logos-box"><img src="images/hdfc-pl-new.png" width="111" height="36" alt="icici bank"></div>
<div class="logos-box"><img src="images/ing-pl-new.png" width="111" height="36" alt="icici bank"></div>
<div class="logos-box"><img src="images/kotak-pl-new.png" width="111" height="36" alt="icici bank"></div>
<div class="clear_fix"></div>
<div class="logos-box"><img src="images/fullorton-pl-new.png" width="111" height="36" alt="icici bank"></div>
<div class="logos-box"><img src="images/bajaj-finserv-pl-new.png" width="111" height="36" alt="icici bank"></div>
<div class="logos-box"><img src="images/sbi-pl-new.png" width="111" height="36" alt="icici bank"></div>
<div class="logos-box"><img src="images/standard-charterd-pl-new.png" width="111" height="36" alt="icici bank"></div>
</div>
<div class="right_box">
<div class="right_inn">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" align="left" class="why_text_head" scope="row">Why Deal4loans.com - <span style="font-size:16px;">Widest Choice of Banks</span></td>
      </tr>
    <tr>
      <td align="left" class="bullet_pl_new_right" scope="row">	
      <ul>
      <li>Get instant quote on Rates, Emi, Eligibility, <strong style="color:#096fb7; font-size:16px;"> Fees</strong> & Documents from all Banks.</li>
      <li>Top <strong style="color:#096fb7; font-size:16px;">9 Banks</strong> with <strong style="color:#096fb7; font-size:16px;">3 Banks</strong> having NIL Prepayment Charges</li>
      <li>It's a totally free service for customers.</li>
      <li>Your Information is secure with us and will not be shared without your consent.</li>
      <li>Loans quotes taken from Deal4loans <strong style="color:#148fd5; font-size:20px; font-weight:normal;">50,</strong> <strong style="color:#feab0d; font-size:20px; font-weight:normal;">87,</strong><strong style="color:#b91010; font-size:20px; font-weight:normal;">736</strong></li>
      </ul>
      </td>
      </tr>
  </table>
</div>


<div class="customer_feedback"><em>Latest Customer Quotes</em></div>
<div class="scrolling_box">
<?
$sql = "SELECT Company_Name, Net_Salary, City,City_Other FROM Req_Loan_Personal WHERE (Net_Salary >400000 AND Employment_Status =1 AND Allocated =1 and LENGTH(Company_Name)>10) ORDER BY RequestID DESC  LIMIT 0 , 6";
	
	list($count,$ArrRow)=Mainselectfunc($sql,$array = array());
	
	//$query = ExecQuery($sql);
	//$count = mysql_num_rows($query);
	$final = '';
	for($i=0;$i<$count;$i++)
	{
		$Company_Name = $ArrRow['Company_Name'];
		$Net_Salary =$ArrRow['Net_Salary'];
		$City = $ArrRow['City'];
		if($City=="Others")
		{
			$City = $ArrRow['City_Other'];
		}
		
		$final[] = $Company_Name.",".$Net_Salary.",".$City;
	}
	$returnValue = implode("***", $final);
?>
<div id="mysagscroller2" class="sagscroller">
<ul>
<?php
$customerData1 = explode("***",$returnValue);
//print_r($customerData1);
$offers =array ("2 Offers", "3 Offers", "4 Offers", "2 Offers", "3 Offers", "4 Offers");
for($i=0;$i<count($customerData1);$i++)
{
	$customerData2 = explode(",",$customerData1[$i]);
	$company = $customerData2[0];
	$salary = $customerData2[1];
	$city = $customerData2[2];
	//echo $company;
//	echo "<br>";
	?>
    	<li style="padding:2px; font-size:14px !important; line-height:22px;"><? $r=$i+1; echo "<b>".$r.". </b>";?> An Employee of<strong><span style="color:#0f8eda;">  <?php echo $company; ?></span></strong> with Income <strong  style="color:#0f8eda;">Rs. <?php echo round($salary); ?></strong> of City <strong  style="color:#0f8eda;"><?php echo $city; ?> </strong>got <strong  style="color:#0f8eda;"><?php echo $offers[$i];?></strong><br /></li>

    <?php
}
?>
</ul>
</div>
</div>



<div class="compare_and_choose"><img src="images/compare-and-choose_table.png" width="100%" height="187" alt="compare and choose"></div>

<div class="disclaimer_bx">Disclaimer: All loans repayment period are over 6 months. No shorts term loans</div>
<div class="disclaimer_bottom_bx"><a href="http://www.deal4loans.com/" target="_blank" class="disclaimer_bottom_bx">Home</a> | <a href="http://www.deal4loans.com/About_Us.php" target="_blank" class="disclaimer_bottom_bx">About Us</a> | <a href="http://www.deal4loans.com/mediarelease.php" target="_blank" class="disclaimer_bottom_bx">Media Coverage</a> | <a href="http://www.deal4loans.com/Contact_Us.php" target="_blank" class="disclaimer_bottom_bx">Contact us</a> | <a href="http://www.deal4loans.com/Contents_Feedback.php" target="_blank" class="disclaimer_bottom_bx">Testimonials</a></div>

</div>
</div>
</body>
</html>