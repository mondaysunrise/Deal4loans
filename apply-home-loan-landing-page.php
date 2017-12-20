<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
//	$retrivesource=$_REQUEST['source'];
	$retrivesource="HL Site Page";
}
else
{
	$retrivesource="HL Site Page";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Balance Transfer</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="css/apply-home-loan-landing-page-styles.css" type="text/css" rel="stylesheet" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
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

function cityother()
{
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
	}
} 
function Trim(strValue) 
{	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function containsdigit(param)
{mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}

function checkFirstForm(){

	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0)){
		return false;
	}
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i<document.loan_form.City_Other.value.length; i++) {
		if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
			document.getElementById('othercityVal').innerHTML = "<span class='hintanchor'>Remove Special Characters!</span>";	
			document.loan_form.City_Other.focus();
			return false;
		}
	}
	if (document.loan_form.Age.value=="0")
	{
		document.getElementById('ageVal').innerHTML = "<span class='hintanchor'>Select your Age!</span>";	
		document.loan_form.Age.focus();
		return false;
	}
	if((document.loan_form.obligations.value=="") || (Trim(document.loan_form.obligations.value))==false)
	{
		document.getElementById('obligationsVal').innerHTML = "<span class='hintanchor'>Please Enter emi amount</span>";		
		document.loan_form.obligations.focus();
		return false;
	}
	if((document.loan_form.property_value.value=="") || (Trim(document.loan_form.property_value.value))==false)
	{
		document.getElementById('propertyValueVal').innerHTML = "<span class='hintanchor'>Please Enter property value</span>";		
		document.loan_form.property_value.focus();
		return false;
	}
	document.getElementById('calculate_button_area').style.display='none';
	document.getElementById('personal_details_area').style.display='block';	
}

function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var j;
	var cnt=-1;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0)){
		return false;
	}
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i<document.loan_form.City_Other.value.length; i++) {
		if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
			document.getElementById('othercityVal').innerHTML = "<span class='hintanchor'>Remove Special Characters!</span>";	
			document.loan_form.City_Other.focus();
			return false;
		}
	}
	if (document.loan_form.Age.value==0)
	{
		document.getElementById('ageVal').innerHTML = "<span class='hintanchor'>Select your Age!</span>";	
		document.loan_form.Age.focus();
		return false;
	}
	if((document.loan_form.obligations.value=="") || (Trim(document.loan_form.obligations.value))==false)
	{
		document.getElementById('obligationsVal').innerHTML = "<span class='hintanchor'>Please Enter emi amount</span>";		
		document.loan_form.obligations.focus();
		return false;
	}
	if((document.loan_form.property_value.value=="") || (Trim(document.loan_form.property_value.value))==false)
	{
		document.getElementById('propertyValueVal').innerHTML = "<span class='hintanchor'>Please Enter property value</span>";		
		document.loan_form.property_value.focus();
		return false;
	}
	
	if((document.loan_form.Name.value=="") || document.loan_form.Name.value=="Full Name" || (Trim(document.loan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}
	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>First Name contains numbers!</span>";
			document.loan_form.Name.focus();
			return false;
		}
	}
    for (var i = 0; i <document.loan_form.Name.value.length; i++) 
    {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
    }
	/*
	if(document.loan_form.day.value=="" || document.loan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
		if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.loan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
		if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.loan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.loan_form.year.focus();
		return false;
	}
	if(document.loan_form.year.value!="")
	{
		if((document.loan_form.year.value <"<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4)){
		return false;
	}
	*/	
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
	/*
	if (document.loan_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.loan_form.Pincode.focus();
			return false;
		}
	}
	*/
	/*
	if(document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		alert("Select Property identified or not!");	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.loan_form.Property_Loc.selectedIndex==0)
		{
			document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property Location!</span>";	
			document.loan_form.Property_Loc.focus();
			return false;
		}
	}
	*/
	if(!document.loan_form.accept.checked)
	{
		alert("Read and Accept Terms & Conditions!");
		document.loan_form.accept.focus();
		return false;
	}
	return true;
}  

function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{
				eval(document.getElementById("divfaq"+j)).style.display=''
			}
			else
			{
				eval(document.getElementById("divfaq"+j)).style.display='none'
			}
		}	
	}
}

function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = '<div style=" float:left; width:183px; height:47px;  margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Location</div>    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="Property_loc" id="Property_loc" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><?=getCityList1($City)?></select></div><div id="vintageVal"></div></div>';
	return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';
	return true;
}	
function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function addhdfclife()
{
var ni1 = document.getElementById('hdfclife');
var cit = document.loan_form.City.value;
var txtview = '<table width="100%" style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" align="left" style="font-family:verdana; font-size:10px; color:#000000; font-weight:normal; " height="20"><span style="color:#000000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23" style="text-align:left;"><input type="checkbox" name="hdfclife" id="hdfclife" value="1" /></td> <td  class="frmbldtxt" align="left" style="font-family:verdana; font-size:10px;text-align:left; color:#000000; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td></tr></table>';
hdfclifecamp(ni1,cit,txtview);
}
</script>

<!-- Show/Hide Personal Details -->
<script type="text/javascript">

function show_personal_details_area(){

	//alert('personal_details_area');
	document.getElementById('calculate_button_area').style.display='none';
	document.getElementById('personal_details_area').style.display='block';	
}

function getDobYear(){

	var d = new Date();
	var current_date = d.getFullYear();
	var dob_year = parseInt(current_date-document.getElementById("Age").value);
	document.getElementById("year").value = dob_year;
}

</script>
<!--//-->

<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style>
/* Big box with list of options */
#ajax_listOfOptions{
	position:absolute;	/* Never change this one */
	width:149px;	/* Width of box */
	height:50px;	/* Height of box */
	overflow:auto;	/* Scrolling features */
	border:1px solid #317082;	/* Dark green border */
	background-color:#FFF;	/* White background color */
	color: black;
	text-align:left;
	font-size:0.9em;
	z-index:100;
}
#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
	margin:1px;		
	padding:1px;
	cursor:pointer;
	font-size:0.9em;
}
#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
	
}
#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
	background-color:#2375CB;
	color:#FFF;
}
#ajax_listOfOptions_iframe{
	background-color:#F00;
	position:absolute;
	z-index:5;
}

.hinttooltip{
	position:absolute;
	background-color:#F5FCE1;
	width: 175px;
	padding: 2px;
	border:1px solid #7F9D27;
	font:normal 10px Verdana;
	color:#404042;
	line-height:14px;
	z-index:100;
	border-right: 3px solid #7F9D27;
	border-bottom: 3px solid #7F9D27;	
}

.hintanchor{
	border:1px solid #CC0033;
	padding:3px 5px 3px 5px;
	background-color:#CCFF99;
	color:#CC0033;
}

</style>
</head>
<body>
<div class="header_wrapper">
<div class="logo-newone">
<img src="images/logo.gif" width="243" height="90" alt="logo"></div>
<div class="text-newone"><strong style="color:#CC3300; font-size:18px;">52,</strong><strong style="color:#0066CC; font-size:18px;"> 08,</strong><strong style="color:#FF6600; font-size:18px;">614</strong> quotes taken till now
<br/>
Quote from <strong style="color:#006699;">4 PSU</strong> and <strong style="color:#006699;">5</strong> Private Banks.</div>
<div style="clear:both;"></div>
</div>
<div class="heading_text"><div class="heading_text_second">Home Loan Eligibilty Calculator</div></div>

<form name="loan_form" method="post" action="insert-home-loans.php" onSubmit="return chkform();">
<input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>">
<input type="hidden" name="Activate" id="Activate"><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<div class="wrapper">
<div class="div">
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td width="42%" align="right" valign="top"> 
    I am a 
    <select name="Employment_Status" id="Employment_Status" class="select" onChange="validateDiv('empStatusVal');" />
       <option value="-1">Please Select</option>
       <option value="1">Salaried</option>
       <option value="0">Self Employment</option>
    </select>
    <div id="empStatusVal"></div>
	</td>
    <td width="58%" align="left">
    with Annual Income of  
    <input type="text" name="Net_Salary" id="Net_Salary" onKeyUp="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);" onBlur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onChange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');" class="input" />
    <div id="netSalaryVal"></div>
    <span id='formatedIncome' style='font-size:11px; font-weight:normal; color:#333333; font-Family:Verdana;'></span> 
    <span id='wordIncome' style='font-size:11px; font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span>
	</td>
  </tr>
</table>
</div>
<div class="div"> 
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td width="47%" align="right"> Living in city 
    <select name="City" id="City" class="select" onChange="cityother(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
		<?=plgetCityList($City)?>
        <option value="Vapi">Vapi</option>
        <option value="Ankleshwar">Ankleshwar</option>
        <option value="Anand">Anand</option>
        <option value="Anand">Dahod</option>
        <option value="Anand">Navsari</option>
    </select>
    <div id="cityVal"></div>
    </td>
    <td width="53%" align="left"> Other City 
    <input name="City_Other" id="City_Other" type="text" class="input" disabled onKeyUp="searchSuggest();" onKeyDown="validateDiv('othercityVal');" />
    <div id="othercityVal"></div>
    </td>
  </tr>
</table>
</div>

<div class="div">
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td width="39%" align="right"> And am age 
    <select name="Age" id="Age" class="select" onChange="getDobYear();">
    	<option value="0">Age</option>
        <?php for($i=20;$i<=60;$i++){ ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
    </select>
    <input type="hidden" name="day" id="day" value="<?php echo date('d'); ?>" />
    <input type="hidden" name="month" id="month" value="<?php echo date('m'); ?>" />
    <input type="hidden" name="year" id="year" value="" />
    <div id="ageVal"></div>
    </td>
    <td width="61%" align="left"> With other loan monthly emis of amount 
    <input type="text" name="obligations" id="obligations" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" class="input" />
    <div id="obligationsVal"></div>
    </td>
  </tr>
</table>
</div>

<div class="div">
<table width="100%" border="0" cellspacing="2">
	<tr>
    	<td width="46%" align="right">
        Property Value:
        <input  name="property_value" id="property_value" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" type="text" class="input" onKeyDown="validateDiv('propertyValueVal');" />
        <div id="propertyValueVal"></div>
        </td>
    	<td width="54%" align="left">
        Loan Amount:
        <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" type="text" class="input" onKeyDown="validateDiv('loanAmtVal');" />
        </td>
	</tr>
</table>
</div>

<div style="clear:both;"></div>
<div class="div"> 

<div id="calculate_button_area">
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td width="45%" align="right"><a href="javascript:void(0)" onClick="checkFirstForm();"><img src="images/child-orng-calculate-btn-new.png" height="36" width="185" border="0" /></a></td>
    <td width="55%" align="left" class="left_terms-new"> my Home Loan eligibility from Top 4 Psu and 5 Private Banks. </td>
  </tr>
</table>
</div> 

</div>
<div style="clear:both;"></div>
<!--
<div id="personal_details_area">
-->
<div id="personal_details_area" style="display:none;">

<div class="wekeep-text"><img src="images/lock-image.png" width="9" height="13"> We keep your personal information secure</div>
<div style="clear:both;"></div>

<div class="div"> 
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td align="center"> and My Name is <input name="Name" id="Name" type="text" onKeyDown="validateDiv('nameVal');" value="Full Name" class="input" tabindex="7" onFocus="if(this.value=='Full Name'){ this.value='';}" onBlur="if(this.value==''){ this.value='Full Name'; }" />
    <div id="nameVal"></div> </td>
    <td align="left">
    
    </td>
  </tr>
</table>
</div>

<div class="div"> 
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td align="right"> Share the details on my +91 <input type="text" name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);" onKeyDown="validateDiv('phoneVal');" tabindex="8" value="Mobile" class="input" onFocus="if(this.value=='Mobile'){ this.value=''; }" onBlur="if(this.value==''){ this.value='Mobile'; }" />
    <div id="phoneVal"></div></td>
    <td align="left"> and <input name="Email" id="Email" type="text" onKeyDown="validateDiv('emailVal');" value="Email" class="input" tabindex="9" onFocus="if(this.value=='Email'){ this.value=''; }" onBlur="if(this.value==''){ this.value='Email'; }" />
<div id="emailVal"></div></td>
   </tr>
</table>   	
</div>

<div style="border:1px solid #666666; display:none;" id="divfaq1">
	<div class="div">
    <table width="100%" border="0" cellspacing="2">
    	<tr>
        	<td align="right">Co-applicant Name:<input name="co_name" id="co_name" type="text" class="input" /></td>
            <td align="left">Co-applicant DOB:
            <input name="co_day" id="co_day" type="text" class="input" style="width:100px;" value="dd" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>
            <input name="co_month" id="co_month" type="text" class="input" style="width:100px;" value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" />
             <input name="co_year" id="co_year" type="text" class="input" style="width:200px;" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" />
             <div id="co_dobVal"></div>
            </td>
        </tr>
    </table>
    </div>
    <div class="div">
    <table width="100%" border="0" cellspacing="2">
    	<tr>
        	<td align="right">Gross Annual Salary:
            <input type="text" name="co_monthly_income" id="co_monthly_income" class="input" onKeyUp="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" />
            <div id="co_incomeVal"></div>
            </td>
            <td align="left">Monthly EMIs: 
            <input name="co_obligations" id="co_obligations" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" type="text" class="input" />
            </td>
        </tr>
    </table>        
    </div>
</div>

<div class="left_terms"><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" /> Co - applicant
<br />
<input name="accept" type="checkbox" tabindex="11" /> 
I Read and Agree to&nbsp;<a href="/Privacy.php" style="text-decoration:underline; color:#0066CC;">Privacy Policy</a> and&nbsp; <a href="/Privacy.php" style="text-decoration:underline; color:#0066CC;">Terms and Conditions</a>.
<div id="acceptVal"></div></div>
<div class="left_btn"><input type="image" name="submit" src="images/child-orng-calculate-btn-new.png" width="185" height="36" /></div>
</div>
<!--
<div class="div">
	<div id="hdfclife"></div>
</div>
-->
</div>
<div style="clear:both;"></div>
</form>
<div class="disc_bottom">
<div class="discbottom_second">Disclaimer: <span><a href="http://www.deal4loans.com/Contents_Disclaimer.php" target="_blank" style="color:#88a943; text-decoration:none;">Read More</a></span></div>
</div>
</body>
</html>