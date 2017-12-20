<?php  require 'scripts/db_init.php'; 
if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="tatacapital mailer"; }
?>
<!DOCTYPE html>
<html>
<head>
<title>Tata Capital Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="css/apply-personal-loans-lp-styles-new2-11-2015.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/pl_apply-tab_styles-new11-2-2015.css">
<link href="css/tata-capital-main-styles.css" type="text/css" rel="stylesheet" />
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
	return strValue.substr(--i,++j-i+1);}

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

if(Form.Age.selectedIndex==0)
{
//	alert("Kindly enter your Date of Birth");
	document.getElementById('ageVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Your Age!</span>";
	Form.Age.select();
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

	if((Form.Total_Experience.value=="") || (Trim(Form.Total_Experience.value))==false)
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Total Work Experience</span>";		
		Form.Total_Experience.focus();
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
		ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td align="left" valign="middle" class="bldtxt" colspan="2" style="padding-top:3px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="48%"  align="left" class="personal_text" colspan="2"> Personal Details</td></tr><tr><td width="4%" style="font-size:10px; font-weight:normal; color:#0072bc;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="96%" align="left"class="sbi_text_a"  style="font-size:10px; font-weight:normal; color:#0072bc;">Your Information is secure with us & will not be shared without your consent</td></tr></table></td></tr>    <tr>    <td width="35%" height="45" class="form_text">Full Name</td>    <td width="65%"  class="alert_msg"><input name="Name" type="text" class="input" id="Name" tabindex=6  onFocus="onFocusBlank(this,\'Name\');"  onBlur="onBlurDefault(this,\'Name\');" onChange="insertData();" <?php if(isset($loan_type)) { ?>value="<?php echo $name; ?>" <?php }else {?>value=""<?php }?>  onkeydown="validateDiv(\'nameVal\');"/><div id="nameVal"></div></td>  </tr>  <tr>    <td height="45" class="form_text">Age</td>    <td  class="alert_msg"><select name="Age" class="select" tabindex="7"><option value="">Select Age</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option></select><div id="ageVal"></div></td>  </tr>  <tr>   <td height="45" class="form_text">Mobile No.</td>    <td  class="form_text"  >+91 <input name="Phone" type="text" class="mobile" id="Phone"  tabindex=10 onFocus="addtooltip();" onChange="intOnly(this); tosendsms(); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="10"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }else {?>value="" <? }?> onKeyDown="validateDiv(\'mobileVal\');" /><div id="mobileVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="45" class="form_text">Email Id</td>    <td class="alert_msg"><input name="Email" id="Email" type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else { ?>value=""<? } ?>   onblur="onBlurDefault(this,\'Email Id\');" onFocus="removetooltip();"  onChange="insertData();" tabindex=11 onKeyDown="validateDiv(\'emailVal\');" class="input" /><div id="emailVal"></div></td>  </tr><tr>    <td height="45" class="form_text">Total Work Experience (in Years)</td>    <td  class="form_text"><input type="text"  name="Total_Experience" id="Total_Experience"  tabindex="12" style="border:none;" onClick="validateDiv(\'TotalExperienceVal\');" class="input"> <div id="TotalExperienceVal" class="alert_msg" ></div> </td>  </tr>	<tr align="left"> <Td id="myDivcc"  class="form_text" ></Td><Td id="myDivcc1"  ></Td>		  </tr>  <tr>    <td height="0" colspan="2"align="center" class="form_text" style="font-size:10px; text-align:left;"><input type="checkbox"  name="accept" style="border:none;" checked tabindex="15" > I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="0" colspan="2" align="center">&nbsp;</td> </tr>  <tr>    <td height="45" colspan="2" align="center"><input type="image" name="Submit" src="images/tata-get-quote.png" width="119" height="45" border:none;" tabindex="16" /></td>    </tr>    </table>';

}
</script>
</head>
<body>
<div class="header-newpl-main">
<div class="header-newpl-main-b">
<div class="logo-new1d4l"><img src="images/tata-capital-logo.jpg" width="202" height="75" alt="Tata Capital Logo"></div>
<div class="top-right-boxbank"><div style="border-bottom:#67afd4 solid thin; padding-bottom:3px;">Fulfill your needs today. Pay as you grow.</div>
<div style="font-size:18px;">Tata Capital Flexi EMI Personal Loans </div>
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
<li class="nav-one"><a href="#fillform" class="current">Get Quote</a></li>
</ul>
<div class="list-wrap">
<div id="fillform" style="height:auto;">	

<form name="personalloan_form" action="tata-capital-personal-loan-lp-continue.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="source" value="<? echo $retrivesource; ?>"> 
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
<tr><td></td><td><span id='formatedIncome' style='font-family: Verdana,'Raleway';	font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana,'Raleway';	font-size:11px;	color:#FFF; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
<tr>
<td height="44" class="form_text">City</td>
<td><select name="City" class="select" id="City"  tabindex="5" onChange=" addPersonalDetails(); validateDiv('cityVal');" ><option value="Select Your City">Select your City</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Others">Others</option></select><div id="cityVal" class="alert_msg"></div> </td>
</tr>
<tr>
<td align="left" class="form_text" id="othCitDiv"></td>
<td id="othCitvalDiv"></td>
</tr>
<tr>
<td height="34" colspan="2" class="form_text"  id="personalDetails"><table align="center" width="100%"><tr><td align="center"><img src="images/tata-get-quote.png" width="119" height="45" /></td></tr></table></td>
</tr>
<tr>
<td height="20" colspan="2" align="center" class="form_text">&nbsp;</td>
</tr>
</table>
</form>
</div>
<div id="leavenumber" class="hide">
<form name="personal_form" action="applypersonal-loans-continue.php" method="POST" onSubmit="return chkploan(document.personal_form);">
<input type="hidden" name="source2" value="<? echo $retrivesource; ?>"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2" align="center" class="personal_text"> </td>
</tr>
<tr>
<td height="35" colspan="2" style="color: #0072bc;" class="form_text">Leave your Contact Number &amp; our loan experts will call back with best offers.
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
<tr><td colspan="2"align="center" class="form_text" style="font-size:10px; text-align:left;"><input type="checkbox"  name="accept2" style="border:none;" checked  > I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal2" class="alert_msg"></div></td>  </tr>
<tr>
<td height="20" colspan="2" align="center" class="form_text">&nbsp;</td>
</tr>
<tr>
<td height="35" colspan="2" align="center" class="form_text"><input type="image" name="Submit2" src="d4limages/aplp_submit_btn-new.jpg" style="width:173px; height:40px; border:none;" /></td>
</tr>
</table></form></div>
</div> <!-- END List Wrap -->
</div>
</div> 
<div style="clear:both;"></div>   
<div style="color:#151515; font-family:Arial, Helvetica, sans-serif; font-size:11px; margin-top:10px;"></div>
<div style="clear:both;"></div>
<div style="clear:both;"></div>
<div class="rewards" style="margin-top:10px;"></div>
</div>
<div class="column_a">
<div class="right-box"> 
<div class="tata_text_head">Flexi EMI Options</div>
<div class="tata_text_head2">  Step Up  ●  Step Down <br>
</div>
</div>
<div class="features_text_box">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="tata_text_head">Take an Instant Personal Loan Quote and move closer to your dreams</td>
</tr>
<tr>
<td class="text_head-bullet">
<div class="tata_text_head3"><strong>Features</strong></div>
<ul class="tata_text_head_bullet">
<li>Loan upto <strong>Rs.15 Lacs</strong></li>
<li><strong>Zero Pre Payment</strong> charges*</li>
<li><strong>Part payment</strong> facility available </li>
<li>Extended Loan <strong>Tenor up to 72 month</strong></li>
<li>Easy documentation and quick processing</li>
<li>No securities, guarantors or collaterals required</li>
</ul></td>
</tr>
</table>
</div>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<div class="tata-buttom-wrap">
<div class="tata-buttom-wrapinn">
Terms and conditions apply.<br/>
Personal loans are brought to you by Tata Capital Financial Services Limited ("TCFSL") and are at its sole discretion. TCFSL reserves the right (i) to ask for additional documents at its discretion to process the loan (ii) to withdraw or alter the offer at any time, if it so chooses.
<div style="text-align:right;"><em>Powered by:</em> Deal4loans.com</div>
</div>
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