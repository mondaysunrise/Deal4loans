<?php
require 'scripts/functions.php';

if(isset($_REQUEST["src"]))
{
	$source =$_REQUEST["src"];
}
else
{
	$source ="HDBFS Exclusive";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>HDBFS Personal Loan</title>
<link href="css/hdbfs-landing-page-styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="listhdbfs.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style>
	/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:308px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}				#dhtmlgoodies_tooltip{		background-color:#ffe688;		border:1px solid #000;		position:absolute;		color:#000000;		display:none;		margin-left:-13px;		z-index:20000;		padding:0px;		font-size:0.9em;		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;			}	#dhtmlgoodies_tooltipShadow{		position:absolute;		background-color:#555;		display:none;		margin-left:-13px;		z-index:10000;		opacity:0.7;		filter:alpha(opacity=70);		-khtml-opacity: 0.7;		-moz-opacity: 0.7;	} 
select:focus, input:focus
{
border:#ff6600 2px solid; 
} 
.bottom-text{ width:95%; margin-left:5px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color: #FFFFFF; margin-top:5px;}
</style>
<script Language="JavaScript" Type="text/javascript">
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

function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var myOption;
	var i;
	
	if(Form.Loan_Amount.value=="")
	{
		alert("Please fill Required Loan Amount.");
		Form.Loan_Amount.focus();
		return false;
	}
	
	if((Form.company_name.value=="") || (Form.company_name.value=="Type slowly for autofill")|| (Trim(Form.company_name.value))==false)
	{
		alert("Kindly fill in your Company Name!");
		Form.company_name.focus();
		return false;
	}

	else if(Form.company_name.value.length < 3)
	{
		alert("Kindly fill in your Company Name!");
		Form.company_name.focus();
		return false;
	}
	if(Form.net_salary.value=='')
	{
		alert("Please enter Income to Continue");
		Form.net_salary.focus();
		return false;
	}

	if(Form.net_salary.value.charAt(0)=="0")
	{
		alert("Please enter Monthly income to Continue");
		Form.net_salary.focus();
		return false;
	}

	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.City.focus();
		return false;
	}
	
	if((Form.full_name.value=="") || (Form.full_name.value=="Name")|| (Trim(Form.full_name.value))==false)
	{
		alert("Kindly fill in your Name!");
		Form.full_name.focus();
		return false;
	}
	else if(containsdigit(Form.full_name.value)==true)
	{
		alert("Name contains numbers!");
		Form.full_name.focus();
		return false;
	}
	for (var i = 0; i < Form.full_name.value.length; i++) {
	if (iChars.indexOf(Form.full_name.value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		Form.full_name.focus();
		return false;
	}
	}		
			
	if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
		alert("Kindly fill in your Mobile Number!");
		Form.Phone.focus();
		return false;
	}
	 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
				  alert("Enter numeric value in ");
				  Form.Phone.focus();
				  return false;  
			}
			else if (Form.Phone.value.length < 10 )
			{
					alert("Please Enter 10 Digits"); 
					 Form.Phone.focus();
					return false;
			}
	else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
			{
				alert("The number should start only with 9 or 8 or 7");
				Form.Phone.focus();
				return false;
			}
	if(Form.email_id.value!="Email Id")
		{
			if (!validmail(Form.email_id.value))
			{
				//alert("Please enter your valid email address!");
				Form.email_id.focus();
				return false;
			}
			
		}
if(Form.day.value=="" ||  Form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		Form.day.focus();
		return false;
	}
	if(Form.day.value!="")
	{
	 if((Form.day.value<1) || (Form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	Form.day.focus();
	return false;
	}
	}
	if(!checkData(Form.day, 'Day', 2))
		return false;
	
	if(Form.month.value=="" || Form.month.value=="MM")
	{
		alert("Please fill your month of birth.");
		Form.month.focus();
		return false;
	}
	if(Form.month.value!="")
	{
	if((Form.month.value<1) || (Form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	Form.month.focus();
	return false;
	}
	}
	if(!checkData(Form.month, 'month', 2))
		return false;

	if(Form.year.value=="" || Form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		Form.year.focus();
		return false;
	}
		if(Form.year.value!="")
	{
	if((Form.year.value < "1950") || (Form.year.value >"1994"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		Form.year.focus();
		return false;
		}
	}
	
	if(!checkData(Form.year, 'Year', 4))
		return false;

	if(Form.panno.value=="")
	{
		alert("Please enter pan number");
		Form.panno.focus();
		return false;
	}
	if(Form.panno.value!="")
	{
		var a=Form.panno.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	  Form.panno.focus();
	  return false;
	}
	if (Form.panno.value.charAt(3)!="P" && Form.panno.value.charAt(3)!="p")
	{
			alert("Please enter valid pan number");
			Form.panno.focus();
			return false;
	}
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
function Trim(strValue)
	{
		var j=strValue.length-1;i=0;
		while(strValue.charAt(i++)==' ');
		while(strValue.charAt(j--)==' ');
		return strValue.substr(--i,++j-i+1);
	}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addothercity');

	if(document.hdbfs_form.City.value=="Others")
			{
	ni2.innerHTML='<table width="100%"  border="0" align="center" cellpadding="1" cellspacing="3"><tr><td width="42%" height="35" class="formtext">Other City</td>	<td align="left"><input name="other_city" id="other_city" type="text" class="input" /></td></tr></table>';
			}

	ni1.innerHTML = '<table width="100%"  border="0" align="center" cellpadding="1" cellspacing="3"><tr>  <td height="30" colspan="2" class="form-heading" >Personal Details</td>   </tr>   <tr>     <td height="10" colspan="2" valign="top" class="info-text" ><img src="images/lock-hdb.png" width="12" height="12"> Your Information is secure with us &amp; will only be shared with HDB Financial Services personal loan manager.</td>    </tr>   <tr>      <td height="35" class="formtext" width="42%">Name</td>      <td><input type="text" name="full_name" id="full_name" class="input"></td>    </tr>    <tr>      <td height="35" class="formtext">Mobile</td>      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">        <tr>          <td width="8%" class="formtext">+91</td>          <td width="92%"><input type="text" name="Phone" id="Phone" class="mobo" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);" maxlength="10"></td>    </tr>  </table></td>    </tr>    <tr>      <td height="35" class="formtext">Email Id</td>      <td><input type="text" name="email_id" id="email_id" class="input"></td>   </tr>   <tr>      <td height="35" class="formtext">DOB</td>      <td><input type="text" name="day" id="day" class="dd" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);">       <input type="text" name="month" id="month" class="dd" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);">        <input type="text" name="year" id="year" class="yy" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);"></td>   </tr> <tr>      <td height="35" class="formtext">PAN no</td>      <td><input type="text" name="panno" id="panno" class="input" maxlength="10"></td>   </tr>  <tr>      <td height="30" colspan="2" class="info-text">         <input type="checkbox" name="accept" id="accept">I have read the Privacy Policy and agree to the Terms And Condition</td>      </tr>    <tr>      <td height="30" colspan="2" align="center">      <input name="image"  value="Submit" type="image" src="images/hdb-financial-submit-btn.png" width="122" height="37"  style="border:0px;" />     </td>      </tr></table>';
 }
</script>    
</head>
<body>
<div class="wrapper">
<div class="gray-box">
<div class="logo"><img src="images/hdb-financial-logo-lp.png" width="225" height="57"></div>
<div class="com"><img src="images/hdbfs-com.jpg" width="163" height="29"></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<form name="hdbfs_form" method="POST" action="apply-for-hdbfs-thank.php" onSubmit="return chkpersonalloan(document.hdbfs_form) ;">
<input type="hidden" id="source" name="source" value="<? echo $source; ?>">
<div class="form-box">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="43%" height="35" class="form-heading">Professional Details</td>
      <td width="57%">&nbsp;</td>
    </tr>
    <tr>
      <td height="35" class="formtext">Required Loan Amount</td>
      <td><input type="text" name="Loan_Amount" id="Loan_Amount" class="input" tabindex="1" onChange="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress=" getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); intOnly(this);"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');">
</td>
    </tr>
    <tr><td></td><td><span id='formatedlA' style='font-size:11px;
	font-weight:normal; color:#b04c09;font-Family:Verdana;'></span>
	  <span id='wordloanAmount' style='font-size:11px;
	font-weight:normal; color:#b04c09;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
    <tr>
      <td height="35" class="formtext">Employment Status</td>
      <td>
        <select name="Employment_Status" class="select" id="Employment_Status">
		 <option value="">Please Select</option>
         <option value="1">Salaried</option>
                        <option value="2">Self Employed</option>
        </select>
</td>
    </tr>
    <tr>
      <td height="35" class="formtext">Company Name</td>
      <td><input type="text" name="company_name" id="company_name" class="input" 
	  onkeyup="ajax_showOptions(this,'getCollegesByLetters',event)"
	  onFocus='if(this.value=="Type slowly for autofill") {this.value="";this.style.color="black";}' onBlur='if(this.value==""){this.value="Type slowly for autofill";this.style.color="silver";}' value='Type slowly for autofill'  onmouseout='hideTooltip()' onmouseover='showTooltip(event,"Slowly start typing your employers name and choose from recommendations provided?"); return false'></td>
    </tr>
    <tr>
      <td height="35" class="formtext">Net Salary (Per month)</td>
      <td><input type="text" name="net_salary" id="net_salary" class="input" onChange="intOnly(this); getDigitToWords('net_salary','formatedIncome','wordIncome');" onKeyUp="intOnly(this); getDigitToWords('net_salary','formatedIncome','wordIncome');" onKeyPress=" getDigitToWords('net_salary','formatedIncome','wordIncome'); intOnly(this);"  onblur="getDigitToWords('net_salary','formatedIncome','wordIncome');"></td>
    </tr>
    <tr><td></td><td><span id='formatedIncome' style='font-size:11px;
	font-weight:normal; color:#b04c09;font-Family:Verdana;'></span>
	<span id='wordIncome' style='font-size:11px;
	font-weight:normal; color:#b04c09;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
    <tr>
      <td height="35" class="formtext">City</td>
      <td><select name="City" class="select" id="City" onChange="addPersonalDetails();">
       <option value="">Please Select</option>
	    <option value="Ahmedabad">Ahmedabad</option>
 <option value="Ahmednagar">Ahmednagar</option>
 <option value="Aurangabad">Aurangabad</option>
 <option value="Bangalore">Bangalore</option>
 <option value="Chandigarh">Chandigarh</option>
 <option value="Chennai">Chennai</option>
  <option value="Cochin">Cochin</option>
<option value="Coimbatore">Coimbatore</option>
<option value="Dehradun">Dehradun</option>
<option value="Delhi">Delhi</option>
<option value="Hyderabad">Hyderabad</option>
<option value="Indore">Indore</option>
<option value="Jaipur">Jaipur</option>
<option value="Jalandhar">Jalandhar</option>
<option value="Jamnagar">Jamnagar</option>
<option value="Kolkata">Kolkata</option>
<option value="Lucknow">Lucknow</option>
<option value="Madurai">Madurai</option>
<option value="Mumbai">Mumbai</option>
<option value="Nagpur">Nagpur</option>
<option value="Nasik">Nasik</option>
<option value="Panipat">Panipat</option>
<option value="Pune">Pune</option>
<option value="Rajkot">Rajkot</option>
<option value="Salem">Salem</option>
<option value="Surat">Surat</option>
<option value="Trivandrum">Trivandrum</option>
<option value="Thiruvananthapuram">Thiruvananthapuram</option>
<option value="Vadodara">Vadodara</option>
<option value="Vishakapatnam">Vishakapatnam</option>
<option value="Others">Others</option>
      </select></td>
    </tr>
    <tr>
                  <td colspan="2" id="addothercity"></td>
                </tr>
    <tr><td colspan="2" id="personalDetails"><div align="center"><img src="images/hdb-financial-submit-btn.png" width="122" height="37"></div></td></tr>
    
    <tr>
      <td height="10" colspan="2">&nbsp;</td>
      </tr>
  </table>
</div>
</form>
<div class="right-box"><span class="font-right-head">Special Offer:
</span>
<div class="text-list">
<ul style="color:red; line-height:22px;">
<li>50% off on Processing fee, save upto Rs 20,000*</li>
<li>Loan up to Rs.20 Lacs</li>
<li>Zero Foreclosure charges**</li>
<li>Part prepayment facility**</li>
</ul></div>
<div class="font-right-head" style="margin-top:15px;">Features of HDBFS PL:</div>
<div class="text-list">
<ul style="line-height:22px;">
<li>Attractive interest rate and processing charges</li>
<li>Simple documentation.</li>
<li>Speedy processing.</li>
<li>Easy repayment through EMIs</li>
<li>No guarantor/security required.</li>
<li>Convenience of doorstep service.</li>
<li>Special offer for employees of select companies.</li>
</ul>
</div>
<div class="poweredby" style="margin:10px; color:#000000;">Powered by: <span style="color:#0e8cc6; ">Deal4loans.com</span></div>
</div>
<div style="clear:both;"></div>

</div>
<div class="bottom">
<div class="disc">Disclaimer<br />
*   Offer valid on Login till 31st March 2014<br />
** Conditions apply. Credit at sole discretion of HDBFS.</div>
<div style="clear:both;"></div>
<div class="bottom-text">By applying you authorize HDB Financial Services to run a Cibil check on your name</div>
</div>
</body>
</html>