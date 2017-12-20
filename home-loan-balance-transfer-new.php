<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(isset($_POST['submit']))
{
	$Loan_Amount = $_POST['Loan_Amount'];
	$Interest_Rate = $_POST['roi'];
	$Duration_of_Loan = $_POST['tenure'];
	$emi_paid = $_POST['emi_paid'];
	$pre_payment_charges = $_POST['pre_payment_charges'];		
}
if(isset($_REQUEST["source"]))
{
	$source=$_REQUEST["source"];
}
else
{
	$source="Balance Transfer";
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Balance Transfer</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href="css/home-loan-balance-transfer-new-styles.css" type="text/css" rel="stylesheet" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">
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

function checkFirstForm(){

	if(document.loancalc.Loan_Amount.value=="" || document.loancalc.Loan_Amount.value=='Loan Amount'){

		document.getElementById('loanAmountVal').innerHTML = "<span class='hintanchor'>Enter Loan Amount!</span>";
		myForm.Loan_Amount.focus();
		return false;
	}
	if(document.loancalc.tenure.value=="")
	{
		document.getElementById('tenureVal').innerHTML = "<span class='hintanchor'>Select Tenure!</span>";	
		Form.tenure.focus();
		return false;
	}
	if(document.loancalc.roi.value=="" || document.loancalc.roi.value=='Rate of Interest')
	{
		document.getElementById('roiVal').innerHTML = "<span class='hintanchor'>Rate of Interest!</span>";	
		Form.roi.focus();
		return false;
	}
	if(document.loancalc.Existing_Bank.value=="" || document.loancalc.Existing_Bank.value=='Bank Name'){

		document.getElementById('existBankVal').innerHTML = "<span class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}
	if(document.loancalc.emi_paid.value=="" || document.loancalc.emi_paid.value=='Monthly'){

		document.getElementById('emiPaidVal').innerHTML = "<span class='hintanchor'>Enter No. of EMI Paid!</span>";	
		Form.emi_paid.focus();
		return false;
	}
}

function check_form(Form)
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
	
	if(Form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmountVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		Form.Loan_Amount.focus();
		return false;
	}
	
	if(Form.tenure.selectedIndex==0)
	{
		document.getElementById('tenureVal').innerHTML = "<span  class='hintanchor'>Select Tenure!</span>";	
		Form.tenure.focus();
		return false;
	}	
	if(Form.roi.value=="")
	{
		document.getElementById('roiVal').innerHTML = "<span  class='hintanchor'>Rate of Interest!</span>";	
		Form.roi.focus();
		return false;
	}
	if(Form.emi_paid.value=="")
	{
		document.getElementById('emiPaidVal').innerHTML = "<span  class='hintanchor'>Enter No. of EMI Paid!</span>";	
		Form.emi_paid.focus();
		return false;
	}
	if (Form.Existing_Bank.value=="")
	{
		document.getElementById('existBankVal').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}
	
	if((Form.Name.value=="") || (Trim(Form.Name.value))==false || Form.Name.value=='Full Name')
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Fill Your Full Name!</span>";	
		Form.Name.focus();
		return false;
	}
	if (Form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Fill Your City!</span>";	
		Form.City.focus();
		return false;
	}	
	
	if (Form.Phone.value=="" || Form.Phone.value=='Mobile')
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Your Mobile Number!</span>";	
		//alert("Please enter mobile number.");
		Form.Phone.focus();
		return false;
	}
	if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";	
		Form.Phone.focus();
		return false;  
	}
	if (Form.Phone.value.length < 10 )
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		Form.Phone.focus();
		return false;
	}
	if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Number starts with 9 or 8 or 7!</span>";	
		 Form.Phone.focus();
		return false;
	}
	
	if(Form.Email.value=="" || Form.Email.value=='Email')
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
	
	if(!Form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span class='hintanchor'>Accept the Terms and Condition!</span>";
		//alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
	return true;
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function shw_tooltip()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "<span class='hinttooltip'>Most Banks/NBFC charge 0% prepayment offers. Please check with your lender.</span>";
}

function shw_tooltipOFF()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "";
}

</script>

<!-- Show/Hide Personal Details -->
<script type="text/javascript">

function show_personal_details_area(){

	//alert('personal_details_area');
	document.getElementById('calculate_button_area').style.display='none';
	document.getElementById('personal_details_area').style.display='block';	
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
Quote from <strong style="color:#006699;">5 PSU</strong> and <strong style="color:#006699;">4</strong> Private Banks.</div>
<div style="clear:both;"></div>
</div>
<div class="heading_text"><div class="heading_text_second">Home Loan Balance Transfer</div></div>

<form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);">
<input type="hidden" name="source" value="<? echo $source; ?>">
<div class="wrapper">
<div class="div">
I have home loan of  
<input name="Loan_Amount" id="Loan_Amount" type="text" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onFocus="if(this.value=='Loan Amount'){ this.value=''; }" onBlur="if(this.value==''){ this.value='Loan Amount'; }else{getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');}" onKeyDown="validateDiv('loanAmountVal');" onChange="intOnly(this);" maxlength="9" value="Loan Amount" tabindex="1" class="input" />
    <div id="loanAmountVal"></div>
    <span id='formatedlA' style='font-size:12px; font-weight:normal;padding-top:3px;'></span>
	<span id='wordloanAmount' style='font-size:12px; font-weight:normal; text-transform: capitalize;'></span> 
</div>
<div class="div"> 
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td width="42%" align="right">for 
    <select name="tenure" id="tenure" class="select" style="width:80px;" onChange="validateDiv('tenureVal');" tabindex="2">
		<option value="">Tenure</option>
        <?php for($i=5;$i<=25;$i++){ ?>
		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php } ?>
    </select> years 
    <div id="tenureVal"></div> </td>
    <td width="58%" align="left"> and my current rate is 
    <input type="text" name="roi" id="roi"onkeydown="validateDiv('roiVal');" tabindex="3" class="input" onFocus="if(this.value=='Rate of Interest'){ this.value=''; }" onBlur="if(this.value==''){ this.value='Rate of Interest'; }" value="Rate of Interest" autocomplete="off" />    
    <div id="roiVal"></div></td>
  </tr>
</table>
</div>
<div class="div">

<table width="100%" border="0" cellspacing="2">
  <tr>
    <td width="44%" align="right"> with <input type="text" name="Existing_Bank" id="Existing_Bank" value="Bank Name" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onChange="getstatementlink();" onKeyDown="validateDiv('existBankVal');" onClick="getstatementlink();" tabindex="4" class="input" onFocus="if(this.value=='Bank Name'){ this.value=''; }" onBlur="if(this.value==''){this.value='Bank Name';}" />
    <div id="existBankVal"></div>
    </td>
    <td width="28%" align="left"> and paid <input type="text" name="emi_paid" value="Monthly" maxlength="5" onKeyDown="validateDiv('emiPaidVal');" tabindex="5" class="input" onFocus="if(this.value=='Monthly'){ this.value=''; }" onBlur="if(this.value==''){this.value='Monthly';}" />
    <div id="emiPaidVal"></div>
    </td>
    <td width="28%" align="left"> emi.</td>
  </tr>
</table>
</div>

<div style="clear:both;"></div>
<div class="div"> 

<div id="calculate_button_area">
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td width="45%" align="right"><a href="javascript:void(0)" onClick="checkFirstForm(); show_personal_details_area();"><img src="images/child-orng-calculate-btn-new.png" height="36" width="185" border="0" /></a></td>
    <td width="55%" align="left" class="left_terms-new"> quote from 5 PSU and 4 Private Banks. </td>
  </tr>
</table>
</div> 

</div>
<div style="clear:both;"></div>

<div id="personal_details_area" style="display:none;">
<div class="wekeep-text"><img src="images/lock-image.png" width="9" height="13"> We keep your personal information secure</div>
<div style="clear:both;"></div>

<div class="div"> 
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td align="right"> I <input name="Name" id="Name" type="text" onKeyDown="validateDiv('nameVal');" value="Full Name" class="input" tabindex="7" onFocus="if(this.value=='Full Name'){ this.value='';}" onBlur="if(this.value==''){ this.value='Full Name'; }" />
    <div id="nameVal"></div> </td>
    <td align="left">and I live in <select name="City" id="City" onChange="validateDiv('cityVal');" class="input" tabindex="10">
	<?=plgetCityList($City)?>
    </select>
    <div id="cityVal"></div></td>
  </tr>
</table>
</div>

<div class="div"> 
<table width="100%" border="0" cellspacing="2">
  <tr>
    <td align="right"> and give me details on +91 <input type="text" name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="intOnly(this);" onKeyDown="validateDiv('phoneVal');" tabindex="8" value="Mobile" class="input" onFocus="if(this.value=='Mobile'){ this.value=''; }" onBlur="if(this.value==''){ this.value='Mobile'; }" />
    <div id="phoneVal"></div></td>
    <td align="left"> and <input name="Email" id="Email" type="text" onKeyDown="validateDiv('emailVal');" value="Email" class="input" tabindex="9" onFocus="if(this.value=='Email'){ this.value=''; }" onBlur="if(this.value==''){ this.value='Email'; }" />
<div id="emailVal"></div></td>
   </tr>
</table>   	
</div>

<div class="left_terms"><input name="accept" type="checkbox" tabindex="11" /> I Read and Agree to&nbsp;<a href="/Privacy.php" style="text-decoration:underline; color:#0066CC;">Privacy Policy</a> and&nbsp; <a href="/Privacy.php" style="text-decoration:underline; color:#0066CC;">Terms and Conditions</a>.
<div id="acceptVal"></div></div>
<div class="left_btn"><input type="image" name="submit" src="images/child-orng-calculate-btn-new.png" width="185" height="36" /></div>
</div>
</div>
<div style="clear:both;"></div>
</form>
<div class="disc_bottom">
<div class="discbottom_second">Disclaimer: <span><a href="http://www.deal4loans.com/Contents_Disclaimer.php" target="_blank" style="color:#88a943; text-decoration:none;">Read More</a></span></div>
</div>
</body>
</html>