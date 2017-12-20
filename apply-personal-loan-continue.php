<?php
//header("Location: http://www.deal4loans.com/personal-loan.php");
//exit;
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
<title>Quick apply for personal loan at 11.49% Online</title>
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india"/>
<meta name="description" content="Quick & Easy online personal loan apply in 2 minutes @ lowest interest rates from leading loan providers in India. Get fast and easy personal loans approval with deal4loans.com in India."/>
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
  background: #06b2a0;
  width: 110px;
  border: #FFF 2px solid !important;
  height: 39px;
  border-radius: 5px;
  border: 2px;
  color: #FFF;
  font-size: 16px;
  margin-right: 63px;
  margin-bottom: 5px;
}

@media screen and (max-width: 768px) {

.pl-get-quotebtn {
background: #06b2a0;
  width: 110px;
  border: #FFF 2px solid !important;
height: 39px;
float: none;
border-radius: 5px;
border: 2px;
color: #FFF;
font-size: 16px;
margin-bottom: 5px;
margin-top: 40px;
}
	
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
	if (document.loan_form.Age.value=="")
			{
				document.getElementById('AgeVal').innerHTML = "<span  class='hintanchor'>Please select Age!</span>";
				document.loan_form.Age.focus();
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
	ni1.innerHTML = '<div style="height:47px; margin-top:5px;"><div class="text margin_left_new1212" style=" float:left; height:auto; color:#FFF;">Card held since?</div>    <div class="text margin_left_new1212" style=" height:auto; margin-top:5px;"><select size="1" name="Card_Vintage" class="secinput_apply_pl_new-two" onchange="validateDiv(\'vintageVal\');"><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div id="vintageVal"></div></div>';
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
	var txtview = '<table style="border:1px solid #FFF; padding:2px; width:100%; margin-bottom:5px;"><tr><td colspan="2" class="frmbldtxt" style="font-size:12px; font-weight:normal; " height="20"><span style="color:#990000;">(Optional) </span><span style="color:#FFF;">Special service only for Deal4loans customers:</div></td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-size:12px;font-weight:normal; color:#FFF;"> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td></tr></table>';	
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
<link href="applypersonal-loan-styles-main-mobile.css" type="text/css" rel="stylesheet" />
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
<div class="text12" style="margin:auto; width:100%; max-width:970px; height:11px; margin-top:70px; margin-bottom:11px; color:#0a8bd9;"><strong style="font-size:12px;"> </strong> <a href="personal-loans.php"  class="text12" style="color:#0080d6; font-size:14px;">Personal Loan</a> <strong style="font-size:12px;"> > </strong> <span  class="text12" style="color:#4c4c4c; font-size:14px;"><?php echo GETQUOTEFOR;?> Personal Loan</span></div>
<div style="clear:both;"></div>

<div class="apl_header_new_content_wrapper">
<div class="apl_header_new_content_wrapper-inn">
  <div class="apl_margin_clear-fix"></div>

<div class="wrapper_apply_pl_new">
<h1 class="pl-h1-new">Let us help you find the Best Personal Loan</h1>
<div class="head_text_apl_ie"></div>
<div class="apl_margin_clear-fix"></div>
<div class="head_text_apl-sub">



   
    <div class="counterboxpl">
 <? include "count_quote_home.php";  ?>
    
    <!--<span id="number-counter" class="count_number" style="padding:0 3px 2px 3px;">100000</span>--></div>
    <div class="quotewrappernew"><h2 class="head_text_apl-sub-wrapper">Loan Quotes generated at D4L so far! </h2>
    </div>
    
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
<div class="baks_partner_logos_wrapper_new"><img src="new-images/deals-logo_banks_partner.png" width="224" height="107" alt="Banks logos" />
<br /><br />
<a href="/lowestratequote.php" style="text-decoration:none;" target="_blank"><img src="new-images/apply-personal-loan-continue-final.jpg" width="219" height="69" style="margin-left:5px;" border="0" /></a>
</div>

<div class="apl_margin_clear-fix"></div>
<form name="loan_form" method="post" action="insert_personal_loan_value_httpsstep.php" onSubmit="return chkpersonalloan();">
<input type="hidden" name="creative" value="<? echo $_SERVER["HTTP_USER_AGENT"]; ?>" />
<div class="section_form_wrapper_new">
	<div class="ineed_wrapper">I want a personal loan of </div>
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
            <div class="ineed_wrapper">My Annual Income is</div>
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
                	
                    <td colspan="2" width="100%" style="color:#FFF;"><br />
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
                <input type="text" name="Name" id="Name" value="Full Name" class="input_apply_pl_new-one" onkeyup="validateDiv('nameVal');" onkeydown="validateDiv('nameVal');" tabindex="7"  onfocus="if(this.value=='Full Name'){ this.value='';}" onblur="if(this.value==''){ this.value='Full Name';}" />
                <div id="nameVal"></div>   
            </div>
            
            <div class="input_nrw_aplc-wrapper_right-new">
            
                <input type="text" name="Email" id="Email" value="Email" class="input_apply_pl_new-one" onfocus="if(this.value=='Email'){ this.value=''; }" onblur="if(this.value==''){ this.value='Email'; }" onkeyup="validateDiv('emailVal');" onkeydown="validateDiv('emailVal');" tabindex="8"  />
               
            <div id="emailVal"></div>
            </div>
            
            <div class="input_nrw_aplc-wrapper_right-new">  
            <div class="mobile-text-wraper" style="color:#FFF;">+91 &nbsp;</div>
               
               <div class="mobile-wraper"> <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="Mobile" onchange="intOnly(this);" type="text" class="mobile-input_apply_new_ul" onkeydown="validateDiv('phoneVal');" onfocus="if(this.value=='Mobile'){ this.value='';}" onblur="if(this.value==''){ this.value='Mobile';}" tabindex="9" />
                <div id="phoneVal"></div>
               </div>
            </div>
        
        	<div class="input_nrw_aplc-wrapper_right-new">  
                <div class="text dob-main-wrapper">
                  <div class="text dobwrapper" style="margin-top:10px; color:#FFF;"> Age:</div>
                  <div class="text dob-wraper1">
                  <select onchange="validateDiv('AgeVal');" class="input_apply_pl_new-two" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div>
                  </div>
                </div>
            </div>
            </td>
        </tr>
        <tr>
        	<td>
            <div class="section_input_new12 input_wrapper_mrgin-new">    
                <div class="text" style=" float:left; width:180px; height:auto; margin-top:10px">
                	<div style="float:left; width:100%; height:auto; margin-top:5px;  color:#FFF;">Credit Card:</div>
                                <input type="radio" name="CC_Holder" id="CC_Holder" value="1" onclick="return addIdentified();" tabindex="13" class="css-checkbox" />
<label for="CC_Holder" class="css-label radGroup2" style="color:#FFF;">Yes</label>
                     <input type="radio" name="CC_Holder" id="CC_Holder1" onclick="removeIdentified(); " value="0" class="css-checkbox" checked="checked">
                     <label for="CC_Holder1" class="css-label radGroup2" style="color:#FFF;">No</label>
                   
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
            	<div class="tt_cc_left_bx" style=" color:#FFF;">
                    <input type="checkbox" name="accept" id="checkboxG2" value="1" class="css-checkbox" onchange="validateDiv('acceptVal');" />
                    <label for="checkboxG2" class="css-label-check" style="font-size:12px; color:#FFF;"/>
                    I authorize Deal4loans.com & its <a href="/pl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style="font-size:12px; color:#FFF;">partnering banks</a> to contact me to explain the product & I Agree to <a href="/Privacy.php" target="_blank" rel="nofollow"  class="text" style="font-size:12px; color:#FFF;">Privacy policy</a> and <a href="Privacy.php" target="_blank" rel="nofollow"  class="text" style="font-size:12px; color:#FFF;">Terms and Conditions</a>.
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
<div><?php include "special-offers_table.php"; ?></div>
</div>
<!--<div class="arrow_below_indicator"></div>-->
<div class="apply_pl_table_wrapper_new">
<?php
/* Getting Bank's total information regarding loan */
$showBankInfoSql = "select * from personal_loan_banks_eligibility where (pl_bank_flag=1) order by pl_bank_roi ASC";
  list($totalBankRecords,$showBankInfoResult)=MainselectfuncNew($showBankInfoSql,$array = array());

//$showBankInfoQry =  ExecQuery($showBankInfoSql);
//$totalBankRecords = mysql_num_rows($showBankInfoQry);
?>
<table width="100%" border="0">
  <tr>
    <td bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td height="47" width="10%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;"><strong>Banks</strong></td>
        <td height="47" width="17%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Rate of Interest</strong></td>
        <td height="47" width="13%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Processing Fee</strong></td>
        <td height="47" width="13%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Loan Amount</strong></td>
        <td height="47" width="16%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Prepayment Charges</strong></td>
        <td height="47" width="13%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;" nowrap="nowrap"><strong>Disbursal Time</strong></td>
        <td height="47" width="18%" align="center" bgcolor="#eceffa" class="apply_pl_table_text_new" style="border-right:#fbf9f6 solid thin; padding-left:5px; padding-right:5px;"><strong>Part Payment Option</strong></td>
    </tr>
	<?php
	$CountVal = 0;
	if($totalBankRecords > 0){
		
		$cntr = 1;
		while($CountVal<count($showBankInfoResult))
		{
		if($cntr%2==0){
			$addBgcolor = 'bgcolor="#eaeaea"';
		}else{
			$addBgcolor = 'bgcolor="#fafdff"';
		}
		$cntr++;
	?>    
    <tr>
        <td height="64" align="left" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style=" border-right:#fbf9f6 solid thin; font-size:14px;"><strong><?php echo $showBankInfoResult[$CountVal]['pl_bank_name']; ?></strong></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c"><?php echo $showBankInfoResult[$CountVal]['pl_bank_roi']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo nl2br($showBankInfoResult[$CountVal]['pl_bank_processing_fee']); ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult[$CountVal]['pl_bank_loan_amt']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo nl2br($showBankInfoResult[$CountVal]['pl_bank_prepayment']); ?></td>
        <td height="64" align="left" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c" style="border-right:#fbf9f6 solid thin;"><?php echo $showBankInfoResult[$CountVal]['pl_bank_disbursal_time']; ?></td>
        <td height="64" align="center" <?php echo $addBgcolor; ?> class="apply_pl_table_text_new-c"><?php echo $showBankInfoResult[$CountVal]['part_payment_option']; ?></td>
    </tr>
    <?php 
		 $CountVal=$CountVal+1;}
		 
	}else{ 
	?>
    <tr>
    	<td colspan="100%" height="64" align="center" bgcolor="#e0f0fb" class="apply_pl_table_text_new-c" style="color:#AE0000; font-size:16px;"> Records not found !</td>
    </tr>
    <?php } ?>
</table></td>
  </tr>
</table>
</div>
<div style="clear:both; height:15px;"></div>

<div class="d4l_inner_wrapper" style="max-width:990px; margin:auto;"><span style="font-size:11px;">*Terms & conditions apply</span><br />
<strong><br />
Tips to get the Best Personal Loan Deal </strong><br />
<br />
<ul style="margin-left:25px; line-height:20px;">
<li>ALWAYS compare the <strong>exact EMI|Processing fee|Tenure|Documents | Terms &amp; Conditions</strong> before choosing a bank.</li>
<li>NEVER pay any fee to any person to get a loan sanctioned. Processing fees should ALWAYS be deducted from the loan amount.</li>
<li>Only give documents to one bank and check whether he is an <strong>authorized bank employee</strong> or <strong>vendor</strong>.</li> 
</ul></div>
</div>
</div> 
<div class="apl_margin_clear-fix"></div>
<div style="clear:both; height:15px;"></div>
<div><?php include "footer_sub_menu.php"; ?></div>
</body>
</html>