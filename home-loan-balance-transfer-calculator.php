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
	$source="Balance Transfer Calc";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/hlbtc-new-ui-styles.css" type="text/css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<link href="personal-loan-banks-styles.css" rel="stylesheet" type="text/css"> 
<title>Home Loan Balance Transfer Calculator India | Deal4loans</title>
<meta name="keywords" content="Home Loan Refinance Calculator, Home Loan Balance Transfer Calculator, Refinance savings calculator, calculate home loan refinance savings" />
<meta name="description" content="Transfer your home loan save interest & pay low EMI. Calculate the savings when you refinance or transfer your existing home loan from one bank to another bank." />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="source.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<link rel="stylesheet" href="css/rangeslider.css">
<script type="text/javascript">
$(document).ready(function(){	
	$("#slider").easySlider({
		controlsBefore:	'<p id="controls">',
		controlsAfter:	'</p>',
		auto: false, 
		continuous: true		
	});
	$("#slider2").easySlider({
		controlsBefore:	'<p id="controls2">',
		controlsAfter:	'</p>',		
		prevId: 'prevBtn2',
		nextId: 'nextBtn2',
		auto: true, 
		continuous: true	
	});		
});	
</script>
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

	if(document.loancalc.Loan_Amount.value==""){

		document.getElementById('loanAmountVal').innerHTML = "<span class='hintanchor'>Enter Loan Amount!</span>";
		myForm.Loan_Amount.focus();
		return false;
	}
	if(document.loancalc.emi_paid.value==""){

		document.getElementById('emiPaidVal').innerHTML = "<span class='hintanchor'>Enter No. of EMI Paid!</span>";	
		Form.emi_paid.focus();
		return false;
	}
	if(document.loancalc.Existing_Bank.value==""){

		document.getElementById('existBankVal').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}
	return true;
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
		
	if((Form.Name.value=="") || (Trim(Form.Name.value))==false)
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Fill Your Full Name!</span>";	
		Form.Name.focus();
		return false;
	}
	if (Form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Your Mobile Number!</span>";	
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
	if (Form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Fill Your City!</span>";	
		Form.City.focus();
		return false;
	}	
	if(!Form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept the Terms and Condition !</span>";	
		//alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}	
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function shw_tooltip()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "<span  class='hinttooltip'>Most Banks/NBFC charge 0% prepayment offers. Please check with your lender.</span>";
}

function shw_tooltipOFF()
{
	var nishw = document.getElementById('shw_tultip');
	nishw.innerHTML = "";
}

</script>
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

</style>

<?php include "cl-form-js.php"; ?>

<!-- Santosh :: Range Slider code starts here -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/rangeslider.min.js"></script>

<script>
$(function() {

	var $document   = $(document),
		selector    = '[data-rangeslider]',
		$element    = $(selector);

	// Example functionality to demonstrate a value feedback
	function valueOutput(element) {
		var value = element.value,
		output = element.parentNode.getElementsByTagName('output')[0];
		output.innerHTML = value;
		
		document.getElementById("tenure").value = tenureVal.value;
		document.getElementById("roi").value = interestRateVal.value;
	}
	for (var i = $element.length - 1; i >= 0; i--) {
		valueOutput($element[i]);
	};
	$document.on('change', 'input[type="range"]', function(e) {
		valueOutput(e.target);
	});

	// Example functionality to demonstrate disabled functionality
	$document .on('click', '#js-example-disabled button[data-behaviour="toggle"]', function(e) {
		var $inputRange = $('input[type="range"]', e.target.parentNode);

		if ($inputRange[0].disabled) {
			$inputRange.prop("disabled", false);
		}
		else {
			$inputRange.prop("disabled", true);
		}
		$inputRange.rangeslider('update');
	});

	// Example functionality to demonstrate programmatic value changes
	$document.on('click', '#js-example-change-value button', function(e) {
		var $inputRange = $('input[type="range"]', e.target.parentNode),
			value = $('input[type="number"]', e.target.parentNode)[0].value;

		$inputRange.val(value).change();
	});

	// Example functionality to demonstrate destroy functionality
	$document
		.on('click', '#js-example-destroy button[data-behaviour="destroy"]', function(e) {
			$('input[type="range"]', e.target.parentNode).rangeslider('destroy');
		})
		.on('click', '#js-example-destroy button[data-behaviour="initialize"]', function(e) {
			$('input[type="range"]', e.target.parentNode).rangeslider({ polyfill: false });
		});

	// Basic rangeslider initialization
	$element.rangeslider({

		// Deactivate the feature detection
		polyfill: false,

		// Callback function
		onInit: function() {},

		// Callback function
		onSlide: function(position, value) {
			console.log('onSlide');
			console.log('position: ' + position, 'value: ' + value);
		},

		// Callback function
		onSlideEnd: function(position, value) {
			console.log('onSlideEnd');
			console.log('position: ' + position, 'value: ' + value);
		}
	});
});
</script>
<!-- Santosh :: Range Slider code ends here -->

<!-- Show/Hide Personal Details -->
<script type="text/javascript">

function show_personal_details_area(){
	//alert('personal_details_area');
	document.getElementById('calculate_button_area').style.display='none';
	document.getElementById('personal_details_area').style.display='block';	
}
</script>
<!--//-->
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="text12 hlbt_wrapper_newui" style="margin:auto; margin-top:70px; text-indent:10px; color:#0a8bd9;">
    <a href="http://www.deal4loans.com/" class="text12" style="color:#0080d6;">Home</a>
	&raquo;
    <a href="home-loans.php" class="text12" style="color:#0080d6;">Home Loan</a>
    &raquo;
	<span class="text12" style="color:#4c4c4c;">Home Loan Balance Transfer Calculator</span>
</div>
<div style="clear:both;"></div>

<div class="hlbt_wrapper_newui-header">
<div class="hlbt_wrapper_newui-header_inn">Home Loan Balance Transfer Calculator</div>
</div>

<div style="clear:both;"></div>

<div class="hlbt_wrapper_newui">

<form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);">
<input type="hidden" name="source" value="<? echo $source; ?>">
<div class="hlbtc_main_new_ui_left_warp">
<div class="form-hlbtc-box1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="11%" align="left" scope="row"><img src="images/1-bullet.png" width="34" height="20" /></th>
      <td width="89%">How much Home loan you had taken</td>
      </tr>
  </table>
</div>

<div class="form-hlbtc-box2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td scope="row">
    <input name="Loan_Amount" id="Loan_Amount" type="text" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeydown="validateDiv('loanAmountVal');" onchange="intOnly(this);" maxlength="30" value="<?php echo $Loan_Amount; ?>" tabindex="2" class="hlbtc-newui-input" />
    <div id="loanAmountVal"></div>
    <span id='formatedlA' style='font-size:12px; font-weight:normal;padding-top:3px;'></span>
	<span id='wordloanAmount' style='font-size:12px; font-weight:normal; text-transform: capitalize;'></span>    
    </td>
  </tr>
</table>
</div>
<div style="clear:both; height:10px;"></div>

<div class="form-hlbtc-box1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="11%" align="left" scope="row"><img src="images/2-bullet.png" width="34" height="20" /></th>
      <td width="89%">For how many years Home loan was taken</td>
      </tr>
  </table>
</div>

<div class="form-hlbtc-box2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td scope="row">
    <div id="js-example-destroy" style="float:left; width:70%;">
    	<input type="range" id="tenureVal" min="5" max="25" step="1" value="5" data-rangeslider /> 
        <div style="width:30%; float:right;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="right">
            <tr>
                <td><output></output> </td>
                <td style="font-size:12px;">&nbsp;Years <input type="hidden" id="tenure" name="tenure" value="" size="2" /> </td>
            </tr>
        </table>
        </div>        
	</div>    
    </td>
  </tr>
</table>
</div>

<div style="clear:both; height:10px;"></div>
<div class="form-hlbtc-box1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="11%" align="left" scope="row"><img src="images/3-bullet.png" width="34" height="20" /></th>
      <td width="88%">What is your current rate of Interest</td>
      </tr>
  </table>
</div>

<div class="form-hlbtc-box2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td scope="row">
    <div id="js-example-destroy" style="float:left; width:70%;">
    	<input type="range" id="interestRateVal" min="10" max="20" step="0.25" value="10" data-rangeslider> 
        <div style="width:30%; float:right; ">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><output></output></td>
                <td style="font-size:12px;">%<input type="hidden" id="roi" name="roi" value="" size="5" /> </td>
            </tr>
        </table>
        </div>      
	</div>
    </td>
  </tr>
</table>
</div>
<div style="clear:both; height:10px;"></div>

<div class="form-hlbtc-box1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="11%" align="left" valign="top" scope="row"><img src="images/4-bullet.png" width="34" height="20" /></th>
      <td width="88%">How many months you have paid Home loan emi</td>
      </tr>
  </table>
</div>

<div class="form-hlbtc-box2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td scope="row">
    <input type="text" name="emi_paid" maxlength="5" value="<?php echo $emi_paid ; ?>" onkeydown="validateDiv('emiPaidVal');" tabindex="3" class="hlbtc-newui-input" />
    <div id="emiPaidVal"></div>
    </td>
  </tr>
</table>
</div>

<div style="clear:both; height:10px;"></div>
<div class="form-hlbtc-box1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="11%" align="left" valign="top" scope="row"><img src="images/5-bullet.png" width="34" height="20" /></th>
      <td width="88%">Name of the Bank Home loan taken </td>
      </tr>
  </table>
</div>

<div class="form-hlbtc-box2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td scope="row">
    <input type="text" name="Existing_Bank"  id="Existing_Bank" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="validateDiv('existBankVal');" onclick="getstatementlink();" tabindex="6" class="hlbtc-newui-input" />
    <div id="existBankVal"></div>
    </td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>

<div class="hlbtc_calculater" id="calculate_button_area">
<a href="javascript:void(0)" onclick="checkFirstForm(); show_personal_details_area();"><img src="images/calculator-btn-hlbtc.png" border="0" width="196" height="57" tabindex="10"/></a>
</div>

<!-- Santosh :: Code for Personal Details as Show hide starts here -->
<div style="clear:both; height:10px;"></div>
<div id="personal_details_area" style="display:none;">

<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="left" class="hlbtc_blue_txt">Personal Details</td>
        <td>
        <div style="padding:0px 25px 0 0; color:#c10000; font-size:15px; font-style:italic; text-align:right;">
        <img src="images/bt_locked.png" />Your details are secure and will not be shared without your consent.
        </div>            
        </td>
    </tr>
</table>
</div>

<div class="form-hlbtc-box1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="11%" align="left" valign="top" scope="row"><img src="images/6-bullet.png" width="34" height="20" /></th>
      <td width="88%">Your Full Name</td>
      </tr>
  </table>
</div>

<div class="form-hlbtc-box2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td scope="row">
    <input name="Name" id="Name" type="text" onkeydown="validateDiv('nameVal');"  value="<?php echo $Name; ?>"  class="hlbtc-newui-input" tabindex="7" />
    <div id="nameVal"></div>
    </td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>

<div class="form-hlbtc-box1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="11%" align="left" valign="top" scope="row"><img src="images/7-bullet.png" width="34" height="20" /></th>
      <td width="88%">Your Mobile Number</td>
      </tr>
  </table>
</div>

<div class="form-hlbtc-box2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="13%" scope="row">+91</td>
    <td width="87%" scope="row"><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" type="text" onkeydown="validateDiv('phoneVal');" tabindex="8" value="<?php echo $Phone; ?>" class="hlbtc-newui-input-mob"  />
    <div id="phoneVal"></div></td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>

<div class="form-hlbtc-box1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="11%" align="left" valign="top" scope="row"><img src="images/8-bullet.png" width="34" height="20" /></th>
      <td width="88%">Your Email ID</td>
      </tr>
  </table>
</div>

<div class="form-hlbtc-box2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td scope="row">
    <input name="Email" id="Email" type="text" onkeydown="validateDiv('emailVal');"  value="<?php echo $Email; ?>" class="hlbtc-newui-input" tabindex="9" />
    <div id="emailVal"></div>
    </td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>

<div class="form-hlbtc-box1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th width="11%" align="left" valign="top" scope="row"><img src="images/9-bullet.png" width="34" height="20" /></th>
      <td width="88%">City you live in </td>
      </tr>
  </table>
</div>

<div class="form-hlbtc-box2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td scope="row">
    <select name="City" id="City" onchange="validateDiv('cityVal');" class="hlbtc-newui-input" tabindex="10">
	<?=plgetCityList($City)?>
    </select>
    <div id="cityVal"></div>   
    </td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>

<div class="tcc_apply_box">
<div style="padding:5px; font-size:15px; color:#333333;">
<strong>Get Balance Transfer Quote from <span style="font-size:16px; color:#c10000;">9 Banks</span>.</strong>
</div>

<input name="accept" type="checkbox" tabindex="11" /> I Read and Agree to&nbsp;<a href="/Privacy.php" style="text-decoration:underline; color:#0066CC;">Privacy Policy</a> and&nbsp; <a href="/Privacy.php" style="text-decoration:underline; color:#0066CC;">Terms and Conditions</a>.
<div id="acceptVal"></div>
</div>


<div class="hlbtc_calculater" style="margin-top:25px;">
<input type="image" name="submit" src="images/submit-btn-hlbtc.png" width="196" height="57" />
</div>

</div>
<div style="clear:both; height:10px;"></div>
<!-- Santosh :: Code for Personal Details as Show hide ends here -->

</div>

</form>

<div class="wrapper_one_new1">
<div class="whyd4l_hlbtc">Why Deal4loans.com - <br />

<div class="hlbtc_blue_txt">Loan quotes taken at</div>
<div class="hlbtc_blue_txt"><table width="100%" border="0">
  <tr>
    <td width="48%"> Deal4loans </td>
    <td width="52%"><table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellpadding="0" cellspacing="2">
      <tr>
        <td bgcolor="#FFFFFF" align="center">5</td>
        <td bgcolor="#FFFFFF" align="center">1</td>
        <td bgcolor="#FFFFFF" align="center">4</td>
        <td bgcolor="#FFFFFF" align="center">6</td>
        <td bgcolor="#FFFFFF" align="center">7</td>
        <td bgcolor="#FFFFFF" align="center">4</td>
        <td bgcolor="#FFFFFF" align="center">6</td>
      </tr>
    </table></td>
    </tr>
</table>
</td>
  </tr>
</table>
</div>
<div class="hlbtc_why_bullet">
    <ul>
        <li>Get <strong style="color:#c10000; font-size:14px;">free instant quote</strong> on Balance transfer from <strong style="color:#c10000; font-size:14px;">4 Psu</strong> and 5 Private Banks.</li>
        <li>Pick best Bank as per your requirement.</li>
        <li>Rate as <strong style="color:#c10000; font-size:14px;">low as 8.30%</strong>.</li>
        <li>The quote is totally free.</li>
        <li>Save <strong style="color:#c10000; font-size:14px;">2-7 lakhs</strong> by switching Home loan.</li>
    </ul>
</div>
</div>
<div style="clear:both; text-align:right; float: right; ">
<table cellpadding="0">
   <tr><td align="right" style="margin-top:3px;"> 
<div style="width:160px; float:right;">
<div align="left">
 <div align="right" style="width:77px; float:left; margin-top:7px;">
<!-- Place this tag in your head or just before your close body tag. -->
<script type="text/javascript" src="https://apis.google.com/js/platform.js"></script>
<!-- Place this tag where you want the share button to render. -->
<div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60" data-href="http://www.deal4loans.com/home-loan-balance-transfer-calculator.php"></div>
</div> 
<div style="width:75px; float:right; margin-top:7px;">
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=535011929958266&version=v2.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-share-button" data-href="http://www.deal4loans.com/home-loan-balance-transfer-calculator.php" data-width="60" data-type="box_count"></div>
</div>
  </div>
  </div>
</td></tr> </table>
</div>
</div>
<div style="clear:both; height:5px;"></div>
<div class="text11" style="color:#4c4c4c; width:950px; text-align:center;"></div>
<div style="clear:both; height:5px;"></div>
<div style="clear:both;"></div>
<div style="width:95%; height:auto;  margin-top:15px; margin-left:2px; text-align:justify;">
  <span class="text11" style="color:#4c4c4c; "><strong> Home Loan Balance transfer </strong> need not only mean saving money, you can   also utilize the same for investing in different options. After all securing a home loan is not the end of journey.  Balance transfer - by switching to another lender may   give you a better deal. While a balance   transfer will certainly reduce your EMI outgo, there is no one-size-fits-all   solution for everybody. To know if it will help you, you need to decipher its   workings and calculate the actual benefit before taking a   call.</span></div>
  <div style="width:90%; height:auto; margin-top:15px; margin-left:10px; text-align:justify;">
  <span class="text11" style="color:#4c4c4c; "><strong> Home Loan Balance Transfer Calculator </strong>involves doing a simple math  which in turn would save you from coughing up your hard earned money. All you  need to do is mention your existing home loan rate and prepayment charges.  Based on these informations, it gives you instant quote of four other bank  rates as well and tells you how much you can save.<br /><br />
Below is the table which shows you how much you can save if you transfer your loan amount to the lowest offered bank. EMI calculated for 20 years repayment period.
<table border="1" width="100%">
<tbody>
<tr>
<td style="text-align: center;"><strong>Loan amount</strong></td>
<td style="text-align: center;"><strong>Old rates</strong></td>
<td style="text-align: center;"><strong>New Rates</strong></td>
<td style="text-align: center;"><strong>Old EMI</strong></td>
<td style="text-align: center;"><strong>New EMI</strong></td>
<td style="text-align: center;"><strong>You Save / Month</strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong>5 Lakh</strong></td>
<td>9.10%</td>
<td>8.35%</td>
<td>4530</td>
<td>4292</td>
<td>Rs. 238</td>
</tr>
<tr>
<td style="text-align: center;"><strong>9 Lakh</strong></td>
<td>9.10%</td>
<td>8.35%</td>
<td>8155</td>
<td>7725</td>
<td>Rs. 430</td>
</tr>
<tr>
<td style="text-align: center;"><strong>12 Lakh</strong></td>
<td>9.10%</td>
<td>8.35%</td>
<td>10874</td>
<td>10300</td>
<td>Rs. 574</td>
</tr>
<tr>
<td style="text-align: center;"><strong>15 Lakh</strong></td>
<td>9.10%</td>
<td>8.35%</td>
<td>13593</td>
<td>12875</td>
<td>Rs. 718</td>
</tr>
<tr>
<td style="text-align: center;"><strong>20 Lakh</strong></td>
<td>9.10%</td>
<td>8.35%</td>
<td>18123</td>
<td>17167</td>
<td>Rs. 956</td>
</tr>
<tr>
<td style="text-align: center;"><strong>25 Lakh</strong></td>
<td>9.10%</td>
<td>8.35%</td>
<td>22654</td>
<td>21459</td>
<td>Rs. 1195</td>
</tr>
</tbody>
</table>

    <br /> <br />             
</div>  
<!--partners-->
<div class="partner_logo_hlbtc">
<div class="text hlbt_wrapper_newui" style="margin:auto; height:auto; margin-top:25px; color:#8dae48;">Loan Partners</div>
<div style="margin:auto; height:85px; margin-top:20px;" class="hlbt_wrapper_newui">
<table width="100%">
    <tr>
        <td width="6%" align="left">
        <div><img src="new-images/sbi-home-loan-new.jpg" alt="SBI Home Loan" style="border:none;"/></div></td>
        <td width="16%" align="center">
        <div><img src="/new-images/hdfc-h.jpg" alt="HDFC" style="border:none;"/></div></td>
        <td width="15%" align="left"><div><img src="/new-images/pnbhfl-logo1.jpg" alt="PNB Housing" style="border:none;"/></div></td>
        <td width="14%" align="left"><img src="/new-images/icici-home-loan.jpg" alt="ICICI Home Loans" style="border:none;"/></td>
        <td width="14%" align="left"><img src="/new-images/bank-of-baroda-inner.jpg" alt="Bank of Baroda"  style="border:none;"/></td>
        <td width="17%" align="left"><div><span class="apply-hl-bank-logo" style="margin-left:8px;"><img src="/new-images/axis.jpg" alt="Axis Bank" style="border:none;"/></span></div></td>
		<td width="18%" align="left"><div><span class="apply-hl-bank-logo" style="margin-left:8px;"><img src="/new-images/lic-hfl-logo-inner.jpg" alt="LIC HFL" style="border:none;"/></span></div></td>
    </tr>
</table>
</div>
</div>
<div class="partner_logo_hlbtc_mobo">
  <img src="images/bank-partner_hlbtc-new.png" width="300" height="104" alt="logos" /> </div>
</div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</div>
</body>
</html>