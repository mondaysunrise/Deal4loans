<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="PL Site Page";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Apply personal loans Online at 12.00% at lowest rates</title>
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india"/>
<meta name="description" content="Apply online for personal loans in 2 minutes @ lowest interest rates from leading loan providers in India. Get fast and easy personal loans approval with deal4loans.com in India."/>

<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

<link href="personal-loan-banks-styles.css" rel="stylesheet" type="text/css">
<!--<link href="source.css" rel="stylesheet" type="text/css" />
--><link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-hhtpspllist.js"></script>
<!--
<link rel="stylesheet" href="//code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<script src="//code.jquery.com/jquery-1.8.2.js"></script>
<script src="//code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
-->
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style type="text/css">


.pl-get-quotebtn {
  background: #1a67ff;
  width: 110px;
  height: 39px;
  border-radius: 5px;
  border: 2px;
  color: #FFF;
  font-size: 16px;
  margin-right: 63px;
  margin-bottom: 5px;
}


</style>
<style type="text/css">
	/* Big box with list of options */
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
	form{
		display:inline;
	}
.ui-dialog { position: absolute; padding: .2em; width: 700px; overflow: hidden; z-index:1001;}
.ui-dialog .ui-dialog-titlebar { padding: .4em 1em; position: relative;  }
.ui-dialog .ui-dialog-title { float: left; margin: .1em 16px .1em 0; font-size:11px; line-height:18px;}
.ui-dialog .ui-dialog-titlebar-close { position: absolute; right: .3em; top: 50%; width: 19px; margin: -10px 0 0 0; padding: 1px; height: 18px; }
.ui-dialog .ui-dialog-titlebar-close span { display: block; margin: 1px; }
.ui-dialog .ui-dialog-titlebar-close:hover, .ui-dialog .ui-dialog-titlebar-close:focus { padding: 0; }
.ui-dialog .ui-dialog-buttonpane { text-align: left; border-width: 1px 0 0 0; background-image: none; margin: .5em 0 0 0; padding: .3em 1em .5em .4em; }
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset { float: right; }
.ui-dialog .ui-dialog-buttonpane button { margin: .5em .4em .5em 0; cursor: pointer; }
.ui-dialog .ui-resizable-se { width: 14px; height: 14px; right: 3px; bottom: 3px; }
.ui-draggable .ui-dialog-titlebar { cursor: move; }
.lowest_form_right_text{ float:left; width:204px; margin-top:10px;}
</style>   
<script language="javascript">
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

function othercity1()
{
	if(document.loan_form.City.value=='Others')
	{
		document.getElementById('show_area').style.display='block';
		document.getElementById("show_other_city_field").style.display='block';
		document.getElementById("show_personal_details_fields").style.display='block';
		document.loan_form.City_Other.disabled=false;
	}
	else
	{
		document.getElementById("show_other_city_field").style.display='none';
		document.getElementById("show_personal_details_fields").style.display='block';		
		document.loan_form.City_Other.disabled=true;
	}
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

function checkLoanAmount(){
	
	//alert('Hi');
	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0)){
		return false;
	}	
	return true;
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
	
	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0)){
		return false;
	}	
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}
	if (document.loan_form.Employment_Status.value==0)
	{
		if (document.loan_form.Annual_Turnover.selectedIndex==0)
		{
			document.getElementById('annualTurnoverVal').innerHTML = "<span  class='hintanchor'>Select Annual Turnover!</span>";
			document.loan_form.Annual_Turnover.focus();
			return false;
		}
	}
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
	if (document.loan_form.IncomeAmount.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.IncomeAmount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.IncomeAmount, 'Annual Income',0)){
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
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
		if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
			document.getElementById('othercityVal').innerHTML = "<span class='hintanchor'>Remove Special Characters!</span>";	
			document.loan_form.City_Other.focus();
			return false;
		}
	}	
	
	/******* Validation for Personal Details Starts here *******/
	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false || document.loan_form.Name.value=='Full Name')
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
	if(document.loan_form.Email.value=="" || document.loan_form.Email.value=='Email')
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
		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
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
		if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4)){
		return false;
	}
	
	var myOption = -1;
	for (i=document.loan_form.CC_Holder.length-1; i > -1; i--) {
		if(document.loan_form.CC_Holder[i].checked) {
			if(i==0)
			{
				if (document.loan_form.Card_Vintage.selectedIndex==0)
				{
					document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Holding Credit Card Since!</span>";	
					document.loan_form.Card_Vintage.focus();
					return false;
				}
			}
			myOption = i;
		}
	}

	if (myOption == -1) 
	{
		document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Credit Card holder or not!</span>";	
		return false;
	}
	/***********/
	
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";
		document.loan_form.accept.focus();
		return false;
	}	
}  

function addIdentified()
{		
	//alert('Hi');
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '<div style="height:47px; margin-top:5px;"><div class="text margin_left_new1212" style=" float:left; height:auto;">Card held since?</div>    <div class="text margin_left_new1212" style=" height:auto; margin-top:5px;"><select size="1" name="Card_Vintage" class="secinput_apply_pl_new-two" onchange="validateDiv(\'vintageVal\');"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div id="vintageVal"></div></div>';
	return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	var ni2 = document.getElementById('myDiv2');		
	ni1.innerHTML = '';
	ni2.innerHTML = '';
	return true;
}	

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
</script>
<script type="text/javascript">
function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
	var txtview = '<table style="border:1px solid #000000; padding:2px; width:100%; margin-bottom:5px;"><tr><td colspan="2" class="frmbldtxt" style="font-size:12px; font-weight:normal; " height="20"><span style="color:#990000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-size:12px;font-weight:normal;"> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td></tr></table>';	
	hdfclifecamp(ni1,cit,txtview);
}

function change_empstst()
{	
	var occpdiv = document.getElementById('chnge_empstst');
	var occupation = document.loan_form.Employment_Status.value;
	document.getElementById('show_area').style.display='block';
	if(occupation==0)
	{
	document.getElementById('chnge_empstst').style.display='block';
	occpdiv.innerHTML = '<div><div><span class="ineed_wrapper margin_left_new1212">Annual Turnover: </span></div><div class="text margin_left_new1212"><select name="Annual_Turnover" id="Annual_Turnover" class="input_apply_pl_new-two" tabindex="3"><option value="">Please Select</option><option value="1"> 0 To 40 Lacs</option><option value="4"> 40 Lacs To 1 Cr</option><option value="2" > 1Cr - 3Crs </option><option value="3">3Crs & above</option></select><div id="annualTurnoverVal"></div></div></div>';
	
	}
	else
	{
	document.getElementById('chnge_empstst').style.display='block';	
	occpdiv.innerHTML = '<div><div><span class="ineed_wrapper margin_left_new1212">Company Name: </span></div><div class="text margin_left_new1212"><input name="Company_Name" id="Company_Name" type="text" class="input_apply_pl_new-two" onblur="onBlurDefault(this,\'Type slowly to autofill\');" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'\')" onfocus="onFocusBlank(this,\'Type slowly to autofill\');" onkeydown="validateDiv(\'companyNameVal\');" value="Type slowly to autofill"  tabindex="3" /><div id="companyNameVal"></div></div></div>';
	}				
}
</script>
<link href="applypersonal-loan-styles-main-mobile-21-08.css" type="text/css" rel="stylesheet" />
<!--[if (gt IE 5)&(lte IE 8)]>
<link href="applypersonal-loan-styles-main-ie.css" type="text/css" rel="stylesheet" />
<![endif]-->

<!-- Code to slide fields -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">

function bringForm(){
	
	//alert('Hi');
	document.getElementById("show_button_area").style.display='none';
	document.getElementById("show_amount_area").style.display='block';
	document.getElementById("other_fields").style.display='block';
	$(document).ready(function() {
	   
		//animate image position left
		$('.input_nrw_aplc-wrapper_left-second').animate({
			left: -10
		}, 5000);
	});
}

</script>
<!--//-->

</head>
<body>
<?php include "middle-menu.php";?>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; max-width:970px; height:11px; margin-top:70px; margin-bottom:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6; font-size:14px;" >Home</a></u> <strong style="font-size:12px;"> > </strong> <a href="personal-loans.php"  class="text12" style="color:#4c4c4c; font-size:14px;">Personal Loan</a> <strong style="font-size:12px;"> > </strong> <span  class="text12" style="color:#4c4c4c; font-size:14px;">Apply Personal Loan</span></div>
<div style="clear:both;"></div>

<div class="apl_header_new_content_wrapper">
<div class="apl_header_new_content_wrapper-inn">
  <div class="apl_margin_clear-fix"></div>

<div class="wrapper_apply_pl_new">
<h1 class="pl-h1">Let us Help you to Find Best Personal Loan deal</h1>
<div class="head_text_apl_ie"></div>
<div class="apl_margin_clear-fix"></div>
<div class="head_text_apl-sub">

<div class="quotewrappernew"><h2 class="head_text_apl-sub-wrapper">Loan quotes taken at Deal4loans</h2></div>

   
    <div class="counterboxpl">
 <? include "count_quote_home.php";  ?>
    
    <!--<span id="number-counter" class="count_number" style="padding:0 3px 2px 3px;">100000</span>--></div>
    
<!-- Code for Number Animator -->
<script src="//code.jquery.com/jquery-1.7.0.min.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script>
var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
$('#number-counter')
	.prop('number', 5000000)
	.animateNumber(
	{
		number: 5432938,
		numberStep: comma_separator_number_step
	},
	5000
);
</script>
<!--//-->
   
</div>


<div class="apl_margin_clear-fix"></div>

<div class="apl_margin_clear-fix"></div>
</div>
<div class="clear_margin1111"></div>
<div class="baks_partner_logos_wrapper_new"><img src="images/deals-logo_banks_partner.png" width="224" height="107" alt="Banks logos" />
<br />
<a href="/lowestratequote.php" style="text-decoration:none;" target="_blank"><img src="new-images/apply-personal-loan-continue-final.jpg" width="219" height="69" style="margin-left:5px;" border="0" /></a>
</div>

<div class="apl_margin_clear-fix"></div>
<form name="loan_form" method="post" action="insert_personal_loan_value_httpsstep.php" onSubmit="return chkpersonalloan();">
<input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>" />
<div class="section_form_wrapper_new">
	<div class="ineed_wrapper">I want a Personal loan of amount</div>
	<div class="ineed_wrapper-ie"></div>
    <div class="ineed_wrapper_input1211">
        <div class="section_input_new12">
        <input type="text" name="Loan_Amount" id="Loan_Amount" class="input_apply_pl_new-one_ex" value="Enter Loan Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="if(this.value!=''){intOnly(this); setTimeout(bringForm,2000); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');}" onblur="if(this.value==''){ this.value='Enter Loan Amount'; }else{ getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); }" onkeydown="validateDiv('loanAmtVal');" tabindex="1" onfocus="if(this.value=='Enter Loan Amount'){ this.value='';}" />
        <div id="loanAmtVal"></div>
        </div>
        <div class="section-box_get_quote" id="show_button_area"><a href="javascript:void(0);" onclick="checkLoanAmount();" style="text-decoration:none;"> <input type="submit" class="pl-get-quotebtn" value="Get Quote" /></a></div>
        <div class="section-box_get_quote" id="show_amount_area" style="display:none; width:160px;">
	        <span id='formatedlA'></span>
    	    <span id='wordloanAmount'></span>
        </div>
    </div>
	<div class="apl_margin_clear-fix" style="height:5px;"></div>
    
    <div class="input_nrw_aplc-wrapper_right">
    	<!--<div class="input_nrw_aplc-wrapper_left-second" id="other_fields">-->
        <div class="input_nrw_aplc-wrapper_left-second" id="other_fields" style="display:none;">
            <div class="input_nrw_aplc-wrapper_right-new input_wrapper_mrgin-new">
            <div class="ineed_wrapper">I am a </div>
            <select name="Employment_Status" id="Employment_Status" onchange="validateDiv('empStatusVal'); change_empstst();" class="input_apply_pl_new-two" tabindex="2">
               <option value="-1">Please Select</option>
               <option value="1">Salaried</option>
               <option value="0">Self Employed</option>
            </select> 
            <div id="empStatusVal"></div>
            </div>
            <div class="input_nrw_aplc-wrapper_right-new"> 
            <div class="ineed_wrapper">My annual Income is</div>
            <input type="text" name="IncomeAmount" id="IncomeAmount" class="input_apply_pl_new-two" value="Annual Income" onkeyup="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onkeypress="intOnly(this);" onfocus="if(this.value=='Annual Income'){ this.value='';}" onblur="if(this.value==''){ this.value='Annual Income';} else{ getDigitToWords('IncomeAmount','formatedIncome','wordIncome');}" onchange="ShowHide('incomeShow','IncomeAmount');" onkeydown="validateDiv('netSalaryVal');"  tabindex="4"/>
             
             <div class="section_input_new12 margin_left_new1212">
            <div style="padding-left:3px;">
                <span id='formatedIncome'></span> 
                <span id='wordIncome'></span>
            </div>
        </div>
              <div id="dialog-modal"></div>
              <div id="netSalaryVal"></div>
            </div>
            <div class="input_nrw_aplc-wrapper_right-new"> 
            <div class="ineed_wrapper">I am residing in </div>
            <select name="City" id="City" class="input_apply_pl_new-two" onChange="othercity1(); addhdfclife(); validateDiv('cityVal');" tabindex="5">
                <?php echo plgetCityList($City); ?>
                <option value="Vapi">Vapi</option>
                <option value="Ankleshwar">Ankleshwar</option>
                <option value="Anand">Anand</option>
                <option value="Anand">Dahod</option>
                <option value="Anand">Navsari</option>
            </select>
            <div id="cityVal"></div>
            </div> 
        </div>            
    </div>    
	<div class="apl_margin_clear-fix"></div>
	<div id="show_area" style="height:80px; display:none;">
        <div class="section_input_new12" id="chnge_empstst" style="display:none;">    
            <div class="input_nrw_aplc-wrapper_right-new">
            <div class="ineed_wrapper">I work in </div>
            <input name="Company_Name" id="Company_Name" type="text" class="input_apply_pl_new-two" onblur="onBlurDefault(this,'Type slowly to autofill');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, " onfocus="onFocusBlank(this,'Type slowly to autofill');" onkeydown="validateDiv('companyNameVal');" value="Type slowly to autofill" tabindex="3"/>
            <div id="companyNameVal"></div>
            </div>
            <div class="apl_margin_clear-fix"></div>
        </div>
        
        
        
        <div class="section_input_new12 margin_left_new1212" id="show_other_city_field" style="display:none;">
            <div class="section_input_new12 margin_left_new1212">
            <div class="ineed_wrapper"> and residing in </div>
            <input name="City_Other" id="City_Other" type="text" class="input_apply_pl_new-two" disabled  onkeydown="validateDiv('othercityVal');" tabindex="6" />
            <div id="othercityVal"></div>
            </div>	
            <div class="apl_margin_clear-fix"></div>
        </div>
	</div>
    <div class="apl_margin_clear-fix"></div>
<!--<div id="show_personal_details_fields">-->
	<div id="show_personal_details_fields" style="display:none;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<td>
            <table width="100%" cellpadding="0" cellspacing="0">
            	<tr>
                	
                    <td colspan="2" width="100%"><br />
                   <strong>My Personal Details: </strong> <br /><div class="termtext" style="margin-top:7px;">
                    <img src="images/bt_locked.png" alt="pl" /> Your details are secure and will not be shared without your consent.
                    </div> 
                    </td>
                </tr>
            </table>    
        </tr>
        <tr>
        	<td style="height:10px;"></td>
        </tr>
        <tr>
        	<td>
            <div style="clear:both;"></div>
            <div class="input_nrw_aplc-wrapper_right-new input_wrapper_mrgin-new">
                <input type="hidden" name="Activate" id="Activate">
                <input type="hidden" name="source" value="<?php echo $retrivesource; ?>">
                <input type="text" name="Name" id="Name" value="Full Name" class="input_apply_pl_new-one"  onkeydown="validateDiv('nameVal');" tabindex="7"  onfocus="if(this.value=='Full Name'){ this.value='';}" onblur="if(this.value==''){ this.value='Full Name';}" />
                <div id="nameVal"></div>   
            </div>
            
            <div class="input_nrw_aplc-wrapper_right-new">
            
                <input type="text" name="Email" id="Email" value="Email" class="input_apply_pl_new-one" onfocus="if(this.value=='Email'){ this.value=''; }" onblur="if(this.value==''){ this.value='Email'; }" onkeydown="validateDiv('emailVal');" tabindex="8"  />
               
            <div id="emailVal"></div>
            </div>
            
            <div class="input_nrw_aplc-wrapper_right-new">  
            <div class="mobile-text-wraper">+91 &nbsp;</div>
               
               <div class="mobile-wraper"> <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="Mobile" onchange="intOnly(this);" type="text" class="mobile-input_apply_new_ul" onkeydown="validateDiv('phoneVal');" onfocus="if(this.value=='Mobile'){ this.value='';}" onblur="if(this.value==''){ this.value='Mobile';}" tabindex="9" />
                <div id="phoneVal"></div>
               </div>
            </div>
        
        	<div class="input_nrw_aplc-wrapper_right-new">  
                <div class="text dob-main-wrapper">
                  <div class="text dobwrapper" style="margin-top:10px;"> DOB:</div>
                  <div class="text dob-wraper1">
                  <input name="day" id="day" type="text" class="dd-input_apply_new_ul" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="10" />&nbsp;
                                       
                  <input name="month" id="month" type="text" class="dd-input_apply_new_ul" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="11" />&nbsp;
                                      
                  <input name="year" id="year" type="text" class="dd-input_apply_new_ul" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="12" />
                  <div id="dobVal"></div>
                  </div>
                </div>
            </div>
            </td>
        </tr>
        <tr>
        	<td>
            <div class="section_input_new12 input_wrapper_mrgin-new">    
                <div class="text" style=" float:left; width:180px; height:auto; margin-top:10px">
                	<div style="float:left; width:100%; height:auto; margin-top:5px;">Credit Card:</div>
                                <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onclick="return addIdentified();" tabindex="13" class="css-checkbox" />
<label for="CC_Holder" class="css-label radGroup2">Yes</label>
                     <input type="radio" name="CC_Holder" id="CC_Holder1" onclick="removeIdentified(); " value="0" class="css-checkbox" checked="checked">
                     <label for="CC_Holder1" class="css-label radGroup2">No</label>
                   
                     <div id="ccholderVal"></div>
              	</div>            
			</div>
            <div class="section_input_new12 margin_left_new1212_mob">
            	<div id="myDiv1" class="margin_left_new1212_mob "></div>
            </div>
            <div class="apl_margin_clear-fix"></div>       
            <div class="apl_margin_clear-fix"></div>    
			</td>
		</tr>
        <tr>
        	<td style="height:10px;"></td>
        </tr>
        <tr>
        	<td>
            <div class="new_terms_and_c_wrapper">
            	<div class="tt_cc_left_bx">
                    <input type="checkbox" name="accept" id="checkboxG2" value="1" class="css-checkbox" />
                    <label for="checkboxG2" class="css-label-check" style="font-size:12px;"/>
                    I authorize Deal4loans.com & its <a href="/pl-partnering-banks.php" target="_blank" rel="nofollow"  class="text">partnering banks</a> to contact me to explain the product & I Agree to <a href="/Privacy.php" target="_blank" rel="nofollow"  class="text">Privacy policy</a> and <a href="Privacy.php" target="_blank" rel="nofollow"  class="text">Terms and Conditions</a>.
                    <div id="acceptVal"></div>
            	</div>
            </div>
            <div class="tt_cc_left_get_quote_bx">
            <input type="submit" class="pl-get-quotebtn" value="Get Quote" />
            
          <!--  <input type="image" name="get_quote" src="images/get-quote-btn-new-design.png" width="113" height="39" />--></div>
            <div class="apl_margin_clear-fix"></div>      
            </td>
        </tr>        
        <tr>
        	<td id="hdfclife"></td>
        </tr>
    </table>
     <div class="apl_margin_clear-fix"></div>
</div>          
</div>
</form>
</div>

</div>
<!--<div class="arrow_below_indicator"></div>-->
<div class="apply_pl_table_wrapper_new">
<?php
/* Getting Bank's total information regarding loan */
$showBankInfoSql = "select * from personal_loan_banks_eligibility where (pl_bank_flag=1) order by pl_bank_roi ASC";
	  list($totalBankRecords,$showBankInfoResult)=MainselectfuncNew($showBankInfoSql,$array = array());
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center" class="table_bgcolor_Border">
    <tr>
        <td height="47" width="10%" align="center" bgcolor="#f0cc86" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;"><strong>Banks</strong></td>
        <td height="47" width="17%" align="center" bgcolor="#f0cc86" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Rate of Interest</strong></td>
        <td height="47" width="13%" align="center" bgcolor="#f0cc86" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Processing Fee</strong></td>
        <td height="47" width="13%" align="center" bgcolor="#f0cc86" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Loan Amount</strong></td>
        <td height="47" width="16%" align="center" bgcolor="#f0cc86" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Prepayment Charges</strong></td>
        <td height="47" width="13%" align="center" bgcolor="#f0cc86" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Disbursal Time</strong></td>
        <td height="47" width="18%" align="center" bgcolor="#f0cc86" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;"><strong>Part Payment Option</strong></td>
    </tr>
	<?php
	if($totalBankRecords > 0){
		
		$cntr = 1;
		for($ii=0;$ii<$totalBankRecords;$ii++){
		
		if($cntr%2==0){
			$addBgcolor = 'bgcolor="#FDE7B8"';
		}else{
			$addBgcolor = 'bgcolor="#fafdff"';
		}
		$cntr++;
	?>    
    <tr>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style=" border-left:1px solid #F0AA41; border-right:#fbf9f6 solid thin; font-size:14px;"><strong><?php echo $showBankInfoResult[$ii]['pl_bank_name']; ?></strong></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult[$ii]['pl_bank_roi']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo nl2br($showBankInfoResult[$ii]['pl_bank_processing_fee']); ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult[$ii]['pl_bank_loan_amt']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo nl2br($showBankInfoResult[$ii]['pl_bank_prepayment']); ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult[$ii]['pl_bank_disbursal_time']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style=" border-right:1px solid #F0AA41;"><?php echo $showBankInfoResult[$ii]['part_payment_option']; ?></td>
    </tr>
    <?php 
		}
	}else{ 
	?>
    <tr>
    	<td colspan="100%" height="64" align="center" bgcolor="#e0f0fb" class="apply_pl_table_text_new-c" style="color:#AE0000; font-size:16px;"> Records not found !</td>
    </tr>
    <?php } ?>
</table>
<div style="clear:both; height:15px;"></div>

<div class="terms_c_wrapper_new"><span style="font-size:11px;">*Terms & conditions apply</span><br />
<strong><br />
Tips for Best Personal loan deal</strong><br />
<ul style="margin-left:25px; line-height:20px;">
<li>Compare exact EMI|Processing fee |Tenure|Documents before choosing bank|</li>
<li>Never pay any fee to any person to get loan sanctioned.Processing fee are deducted from loan amount.</li>
<li>Only give documents to one bank and check whether he is authorized bank employee or vendor.</li> 
</ul></div>
</div>
</div> 
<div class="apl_margin_clear-fix"></div>
<div style="clear:both; height:15px;"></div>
<div class="hide-top"><?php include "footer_sub_menu.php"; ?></div>
</body>
</html>