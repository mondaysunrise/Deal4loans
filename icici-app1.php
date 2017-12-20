<?php
//header("Location: icici_app_new.php");
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICICI Personal Loan</title>
<link href="icici-app-styles1.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="tool-styles1.css" type="text/css" rel="stylesheet" />
<link href='progression.min.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="tip-yellow.css" type="text/css" />
	   <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
        <script type="text/javascript" src="scripts/common.js"></script>
 <script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
 <script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-icici.js"></script>
	<!-- jQuery and the Poshy Tip plugin files -->
	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="jquery.poshytip.js"></script>
<script src="javascript-browser.js" type="text/javascript"></script>
<script type="text/javascript">

		//<![CDATA[
		$(function(){
			$('#comp-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#sal-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#rela-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#obli-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#emi-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#occupa-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#te-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#dob-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#city-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$( "#target" ).focus(function() {
alert( "Handler for .focus() called." );
});
		});
		
		 
		//]]>
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


function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if (document.loan_form.cust_loan.value=="" || document.loan_form.cust_loan.value=="Enter the amount")
	{
		document.getElementById('custLoanVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.cust_loan.focus();
		return false;
	}	
	
	if (document.loan_form.relationship.selectedIndex==0)
	{
		document.getElementById('relVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.relationship.focus();
		return false;
	}
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	/*
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }		
  */
	if(document.loan_form.day.value=="" || document.loan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
		if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.loan_form.day.focus();
			return false;
		}
	}

	
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
	
	if(document.loan_form.year.value=="" || document.loan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.loan_form.year.focus();
		return false;
	}
	if(document.loan_form.year.value!="")
	{
		if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}

	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
/*	 if (document.loan_form.Employment_Status.value==0)
	{
		if (document.loan_form.Annual_Turnover.selectedIndex==0)
		{
			document.getElementById('annualTurnoverVal').innerHTML = "<span  class='hintanchor'>Select Annual Turnover to Continue!</span>";	
			document.loan_form.Annual_Turnover.focus();
			return false;
		}
	}
*/

	if(document.loan_form.Employment_Status.value==1)
	{
		if((document.loan_form.Company_Name.value=="") || (document.loan_form.Company_Name.value=="Type slowly to autofill")|| (Trim(document.loan_form.Company_Name.value))==false)
		{
			document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
			document.loan_form.Company_Name.focus();
			return false;
		}
		else if(document.loan_form.Company_Name.value.length < 3)
		{
			document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
			document.loan_form.Company_Name.focus();
			return false;
		}
	}

	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	
	/*if (document.loan_form.total_experience.value=="")
	{
		document.getElementById('expVal').innerHTML = "<span  class='hintanchor'>Enter Total Experience!</span>";	
		document.loan_form.total_experience.focus();
		return false;
	}	*/

	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

		document.loan_form.accept.focus();
		return false;
	}	
}  
function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
		
	ni1.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0">  <tr><td align="right" width="259" height="10" class="text-b" valign="top">Company Name</td><td align="right" width="12" height="10" class="text-b"></td><td align="left" width="263" height="10" class="text-b"> <input name="Company_Name" id="Company_Name" type="text" class="input" onBlur="onBlurDefault(this,\'Type slowly to autofill\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plicici.php\')" onFocus="onFocusBlank(this,\'Type slowly to autofill\');" onKeyDown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill" tabindex="7" autocomplete="off" /><span class="form_hint">Fill Company Name you currently working with</span><div id="companyNameVal" class="alert_msg"></div></td><td width="19" height="10" align="right" class="text-b"></td><td width="47" align="right" class="text-b"></td></tr><tr><td colspan="5" align="right" height="10" class="text-b"></td></tr><tr><td align="right" height="10" class="text-b" valign="top">Net Monthly Income</td><td align="right" height="10" class="text-b"></td><td align="left" height="10" class="text-b"> <input type="text" name="Net_Salary" id="Net_Salary" class="input" onKeyUp="intOnly(this); getDiToWordsIncome(\'Net_Salary\',\'formatedIncome\',\'wordIncome\');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome(\'Net_Salary\',\'formatedIncome\',\'wordIncome\');"  tabindex="8" onKeyDown="validateDiv(\'netSalaryVal\');" /><span class="form_hint">This is your net monthly salary as credited to your bank account after all deductions</span><div id="netSalaryVal" class="alert_msg"></div> <span id=\'formatedIncome\' style=\'font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana; margin-top:7px;\'></span> <span id=\'wordIncome\' style=\'font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;\'></span></td><td width="19" height="10" align="right" class="text-b"></td><td width="47" align="right" class="text-b"></td></tr><tr><td colspan="5" align="right" height="10" class="text-b"></td></tr><tr><td colspan="5" align="right" height="10" class="text-b"></td></tr><tr><td align="right" height="10" class="text-b" valign="top">Total EMI per Month</td><td align="right" height="10" class="text-b"></td><td align="left" height="10" class="text-b"> <input type="text" name="total_emi" id="total_emi" class="input" onKeyUp="intOnly(this); getDiToWordsIncome(\'total_emi\',\'formatedemi\',\'wordemi\');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome(\'total_emi\',\'formatedemi\',\'wordemi\');" tabindex="9" />   <span class="form_hint">This is the sum of all monthly payments that you are making on all your currently open loans.</span><span id=\'formatedemi\' style=\'font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana; margin-top:7px;\'></span> <span id=\'wordemi\' style=\'font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;\'></span></td><td width="19" height="10" align="right" class="text-b"></td><td width="47" align="right" class="text-b"></td></tr><tr><td colspan="5" align="right" height="10" class="text-b"></td></tr><tr><td align="right" height="10" class="text-b" valign="top">Total EMI for Personal Loan</td><td align="right" height="10" class="text-b"></td><td align="left" height="10" class="text-b"> <input type="text" name="other_emi" id="other_emi" class="input" onKeyUp="intOnly(this); getDiToWordsIncome(\'other_emi\',\'formatedother_emi\',\'wordother_emi\');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome(\'other_emi\',\'formatedother_emi\',\'wordother_emi\');" tabindex="10" />    <span class="form_hint">This is the sum of all monthly payments that you are making on all your currently open Personal loans.</span><span id=\'formatedother_emi\' style=\'font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;\'></span> <span id=\'wordother_emi\' style=\'font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;\'></span></td><td width="19" height="10" align="right" class="text-b"></td><td width="47" align="right" class="text-b"></td></tr><tr><td colspan="5" align="right" height="10" class="text-b"></td></tr><tr><td colspan="5" align="left" height="10" class="text-b" style="font-size:12px;">    <input name="accept" type="checkbox" /> I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to privacy policy and Terms & Conditions.<div id="acceptVal" class="alert_msg"></div></td></tr><tr><td colspan="5" align="right" height="10" class="text-b"></td></tr><tr><td align="center" class="text-b">&nbsp;</td><td align="center" class="text-b">&nbsp;</td><td colspan="3" align="left" class="text-b">&nbsp;</td></tr><tr><td align="center" class="text-b">&nbsp;</td><td align="center" class="text-b">&nbsp;</td><td colspan="3" align="left" class="text-b"><input type="submit" style="border: 0px none ; background: #fe9515 url(images/submit-app.png); width: 135px; height: 40px; margin-bottom: 0px;" value=""/></td></tr></table>';
	
}
	</script>
    <style type="text/css">
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
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
		.flickr-thumbs {
			overflow:hidden;
		}
		.flickr-thumbs a {
			float:left;
			display:block;
			margin:0 3px;
			border:1px solid #333;
		}
		.flickr-thumbs a:hover {
			border-color:#eee;
		}
		.flickr-thumbs img {
			display:block;
			width:60px;
			height:60px;
		}
		.alert_msg{color:#FF0000; font-weight:bold; font-size:12px; font-family: Verdana, Geneva, sans-serif;}
		.tooltipbox{ width:250px; background:#0F0; padding:10px;}
	</style>
    
    <style type="text/css">
        .target
        {
            display: inline;
            position: relative;
            text-decoration: none;
            top: 0px;
            left: 4px;
        }
        .target:onfocus:after
        {
            background: #fef9d9;
			font-family:Arial, Helvetica, sans-serif; 
			font-size:11px;
            border-radius: 5px;
            top: -5px;
            color: #000;
            content: attr(alt);
            padding: 5px 15px;
			position:absolute; margin-left:7px; text-align:left;
            z-index:98;
            width: 150px;
        }
        .tooltip:hover:before
        {border-width: 6px 6px 6px 0;
            bottom: 20px;
            content: "";
            left:200 !important; 
            position: absolute;
            z-index: 99;
            top: 3px;
        }
    </style>
</head>
<body>
<header>
<div class="top-bx">
<div class="logo"><img src="images/icici-app-logo.jpg" width="189" height="47"></div>
<div class="right-box"><span class="text-a">Powered by</span> <br>
<span class="text-a" style="color:#0f8eda; font-size:18px;">Deal4loans.com</span></div>
<div style="clear:both;"></div>
</div>
</header>
<div class="banner"><img src="images/banner-app.png" class="img"></div>
<div class="form-main-wrapper">
<form id="myform" onSubmit="return chkpersonalloan();" action="icici-app-second-page_2.php" method="post" name="loan_form" class="contact_form">
<div class="form-box">
<div class="boxtpnew"><div class="textboxleftnew">I need Personal Loan of</div><div class="textboxrightnew"><div class="inputwrappernew">
  <div class="symbol-r"><img src="images/rupees-sym.jpg" width="8" height="13"></div>
  <div class="inner-inputbx">
    <input name="cust_loan" type="text" class="input-new1" id="cust_loan"  onBlur="getDiToWordsIncome('cust_loan','formatLoan','wordLoan');"  onKeyUp="intOnly(this); getDiToWordsIncome('cust_loan','formatLoan','wordLoan');"  onKeyPress="intOnly(this);  getDiToWordsIncome('cust_loan','formatLoan','wordLoan');" autocomplete="off" maxlength="10" onChange="validateDiv('custLoanVal');" tabindex="1" > <!-- <span class="form_hint">Required Loan Amount</span>-->
<div id="custLoanVal" class="alert_msg"></div>
<span id='formatLoan' style='font-size:11px;font-weight:normal; color:#0000;font-Family:Verdana;'></span> <span id='wordLoan' style='font-size:11px;font-weight:normal; color:#0000;font-Family:Verdana;text-transform: capitalize;'></span>
  </div>
  </div></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:10px;"></div>
  <div class="boxform-ext">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="5" align="right" class="text-b">&nbsp;
</td>
        </tr>
     <tr>
        <td width="259" align="right" class="text-b">I currently live in </td>
        <td width="12">&nbsp;</td>
        <td width="263" align="left"><select name="City" id="City" class="select" onChange="validateDiv('cityVal');" tabindex="2">
<option value="Please Select">Select City</option><option value="BANGALORE"
>Bangalore
</option>
<option value="CHENNAI"
>Chennai
</option>
<option value="FARIDABAD"
>Faridabad
</option>
<option value="GHAZIABAD"
>Ghaziabad
</option>
<option value="GURGAON"
>Gurgaon
</option>
<option value="HYDERABAD"
>Hyderabad
</option>
<option value="KOLKATA"
>Kolkata
</option>
<option value="MUMBAI"
>Mumbai
</option>
<option value="NAVI MUMBAI"
>Navi Mumbai
</option>
<option value="DELHI"
>New Delhi
</option>
<option value="NOIDA"
>Noida
</option>
<option value="PUNE"
>Pune
</option>
<option value="THANE"
>Thane
</option>
<option>------------</option>

<option value="AHMEDABAD"
>Ahmedabad
</option>
<option value="BHOPAL"
>Bhopal
</option>
<option value="BHUBANESHWAR"
>Bhubaneshwar
</option>
<option value="CHANDIGARH"
>Chandigarh
</option>
<option value="COIMBATORE"
>Coimbatore
</option>
<option value="INDORE"
>Indore
</option>
<option value="JAIPUR"
>Jaipur
</option>
<option value="JALANDHAR"
>Jalandhar
</option>
<option value="JAMNAGAR"
>Jamnagar
</option>
<option value="JODHPUR"
>Jodhpur
</option>
<option value="KOCHI"
>Kochi
</option>
<option value="LUDHIANA"
>Ludhiana
</option>
<option value="MADURAI"
>Madurai
</option>
<option value="MOHALI"
>Mohali
</option>
<option value="NAGPUR"
>Nagpur
</option>
<option value="PANCHKULA"
>Panchkula
</option>
<option value="RAIPUR"
>Raipur
</option>
<option value="RAJKOT"
>Rajkot
</option>
<option value="SURAT"
>Surat
</option>
<option value="THIRUVANANTHAPURAM"
>Thiruvananthapuram
</option>
<option value="TIRUCHIRAPALLI"
>Tiruchirapalli
</option>
<option value="UDAIPUR"
>Udaipur
</option>
<option value="VADODARA"
>Vadodara
</option>
<option value="VISAKHAPATNAM"
>Visakhapatnam
</option>
<option value="ZIRAKPUR"
>Zirakpur
</option>
<option>------------</option>
<option value="OTHER"
>Other
</option></select>
                         <div id="cityVal" class="alert_msg"></div> </td>
        <td colspan="2" align="left"><a id="rela-basic" title="I currently live in" href="#"><img src="images/question.png" width="14" height="15" border="0"><span>
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
       <tr>
        <td colspan="5" align="right" height="10" class="text-b"></td>
      </tr>
         <tr>
        <td align="right" class="text-b">My age is </td>
        <td>&nbsp;</td>
        <td align="left">
          <select   name="age"  id="age" class="select" tabindex="6"  onchange="validateDiv('dobVal');" >
            <option value="-1">Select Age</option>
			<?php for($ag=18;$ag<60;$ag++)
			{ ?>
            <option value="<?php echo $ag; ?>"><?php echo $ag; ?> Years</option>
			<?php } ?>
          </select>
			<div id="dobVal" class="alert_msg"></div>
          </td>
        <td colspan="2" align="left"><a id="dob-basic" title="Provide Date of Birth" href="#"><img src="images/question.png" width="14" height="15" border="0">
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
       <tr>
        <td colspan="5" align="right" height="10" class="text-b"></td>
      </tr>
         <tr>
        <td align="right" class="text-b">Type of employment</td>
        <td>&nbsp;</td>
        <td align="left">
      
        <select   name="Employment_Status"  id="Employment_Status" class="select" tabindex="6"  onChange="addPersonalDetails(); validateDiv('empStatusVal');" >
                           <option value="-1">Occupation</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                       </select>  <div id="empStatusVal" class="alert_msg"></div></td>
        <td colspan="2" align="left"><a id="occupa-basic" title="What is your Occupation" href="#"><img src="images/question.png" width="14" height="15" border="0">
        <img class="callout" src="images/callout.gif" border="0" /></a></td>
      </tr>
      
      <tr>
        <td colspan="5" align="right" height="10" class="text-b"></td>
      </tr>
     <tr>
           <td colspan="5" id="personalDetails"><table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr>
        <td colspan="5" align="right" height="10" class="text-b"></td>
      </tr><tr><td align="center" class="text-b" width="259">&nbsp;</td><td align="center" class="text-b" width="12">&nbsp;</td><td colspan="3" align="left" class="text-b"><img src="images/submit-app.png" width="135" height="40" border="0" >    </td></tr></table>              </td></tr>
   
          <tr>
            <td align="center" class="text-b">&nbsp;</td>
            <td align="center" class="text-b">&nbsp;</td>
            <td colspan="3" align="left" class="text-b">&nbsp;</td>
          </tr>
    </table>
  
  </div>
</div></form>
<div style="clear:both;"></div></div>
</div>
</body>
</html>