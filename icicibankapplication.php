<?php
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(isset($_REQUEST["source"]))
	{
		$srcbnr = $_REQUEST["source"];
	}
	else	
	{
		$srcbnr = "iciciapp";
	}

$iciciappid = $_POST['iciciappid'];
$ProductValue = $_POST['iciciappid'];
$getLeadDetailsSql = "select * from icici_exclusive_application where iciciappid='".$iciciappid."'";
list($recordcount,$getLeadDetailsQuery)=MainselectfuncNew($getLeadDetailsSql,$array = array());

$iciciapp_name = $getLeadDetailsQuery[0]['iciciapp_name'];
$iciciapp_mobile_number = $getLeadDetailsQuery[0]['iciciapp_mobile_number'];
$iciciapp_gender = $getLeadDetailsQuery[0]['iciciapp_gender'];
$iciciapp_relation = $getLeadDetailsQuery[0]['iciciapp_relation'];
$City = $getLeadDetailsQuery[0]['iciciapp_city'];
$age = $getLeadDetailsQuery[0]['age'];
$iciciapp_occupation = $getLeadDetailsQuery[0]['iciciapp_occupation'];
$iciciapp_company_name = $getLeadDetailsQuery[0]['iciciapp_company_name'];
$iciciapp_salary = ($getLeadDetailsQuery[0]['iciciapp_salary'])/12;
$iciciapp_secure_emi = $getLeadDetailsQuery[0]['iciciapp_secure_emi'];
$iciciapp_unsecure_emi = $getLeadDetailsQuery[0]['iciciapp_unsecure_emi'];
$customer_loan_amt = $getLeadDetailsQuery[0]['customer_loan_amt'];
$iciciapp_email = $getLeadDetailsQuery[0]['iciciapp_email'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="newicici-pl-styles-12.css" type="text/css" rel="stylesheet" />
 <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
        <script type="text/javascript" src="scripts/common.js"></script>

 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-icici.js"></script>
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
		});
				//]]>

$(function() {
	//for company name
$("#Company_Name").focus(function(){
$(this).css({'color' : '#000000'});
});
$("#Company_Name").blur(function(){
if($("#Company_Name").val()=="Type slowly to autofill")
{
$(this).css({'color' : '#999999'});
}
else
{
$(this).css({'color' : '#000000'});
}
});	
//for DOB
//for day
$("#day").focus(function(){
$(this).css({'color' : '#000000'});
});
$("#day").blur(function(){
if($("#day").val()=="dd")
{
$(this).css({'color' : '#999999'});
}
else
{
$(this).css({'color' : '#000000'});
}
});
//for month
$("#month").focus(function(){
$(this).css({'color' : '#000000'});
});
$("#month").blur(function(){
if($("#month").val()=="mm")
{
$(this).css({'color' : '#999999'});
}
else
{
$(this).css({'color' : '#000000'});
}
});
//for Year
$("#year").focus(function(){
$(this).css({'color' : '#000000'});
});
$("#year").blur(function(){
if($("#year").val()=="yyyy")
{
$(this).css({'color' : '#999999'});
}
else
{
$(this).css({'color' : '#000000'});
}
});
//end for DOB

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

	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
	if (document.loan_form.age.selectedIndex==0)
	{
		document.getElementById('ageVal').innerHTML = "<span  class='hintanchor'>Enter Age to Continue!</span>";	
		document.loan_form.age.focus();
		return false;
	}
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
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
	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Monthly Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if (document.loan_form.relationship.selectedIndex==0)
	{
		document.getElementById('relVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.relationship.focus();
		return false;
	}
	if (document.loan_form.Name.value=="")
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Enter Your Name!</span>";	
		document.loan_form.Name.focus();
		return false;
	}
	if (document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter Mobile Number!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if(document.loan_form.Phone.value=="")
	{
	   	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter Mobile Number!</span>";
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

	if (document.loan_form.Phone.value.charAt(0)!="9" && document.loan_form.Phone.value.charAt(0)!="8" && document.loan_form.Phone.value.charAt(0)!="7")
	{
//			alert("The number should start only with 9 or 8 or 7");
	    	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Start with 9 or 8 or 7!</span>";
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
	var aa=str.indexOf("@");
	var bb=str.indexOf(".");
	var cc=str.charAt(aa);
	
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

	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

		document.loan_form.accept.focus();
		return false;
	}	
}  

function addLoanAmtTool()
{
	var ni1 = document.getElementById('rightAnimation');
	ni1.innerHTML = '<div class="box-right-icici"><div class="tool-tip-image" id="tooltipContent">How much Personal Loan you need?</div><div class="tool-tiparrow"><img src="images/arrow-icici-app-tool-tip.png" width="53" height="13" /></div><div class="image-wrapper-icici" ><img src="images/character-icici-app.jpg" width="261" height="192" /></div><div style="clear:both; padding-bottom:8px; padding-top:8px; "><img src="images/instant-banner.jpg" width="100%" height="278" border="2"></div></div>';
}

function addCityTool()
{
	var ni1 = document.getElementById('tooltipContent');
	ni1.innerHTML = 'Please choose which city you live?';
}
function addAgeTool()
{
	var ni1 = document.getElementById('tooltipContent');
	ni1.innerHTML = 'Please share your current age?';
}
function addEmpTool()
{
	var ni1 = document.getElementById('tooltipContent');
	ni1.innerHTML = 'Please select your employment type?';
}
function addCompanyTool()
{
	var ni1 = document.getElementById('tooltipContent');
	ni1.innerHTML = 'Type your company name slowly to match?';
}
function addIncomeTool()
{
	var ni1 = document.getElementById('tooltipContent');
//	ni1.innerHTML = 'Please input your annual income?';
	ni1.innerHTML = 'Please input your monthly income?';
}

function addTotalEMITool()
{
	var ni1 = document.getElementById('tooltipContent');
	ni1.innerHTML = 'Please input total emi that you are paying currently?';
}

function addOtherEMITool()
{
	var ni1 = document.getElementById('tooltipContent');
	ni1.innerHTML = 'Please input total emi paid only for personal loan.';
}

function addRelationshipTool()
{
	var ni1 = document.getElementById('tooltipContent');
	ni1.innerHTML = 'Select your type of relationship with ICICI Bank.';
}

function addNameTool()
{
	var ni1 = document.getElementById('tooltipContent');
	ni1.innerHTML = 'Please input Full Name as mentioned on Pancard';
}

function addMobileTool()
{
	var ni1 = document.getElementById('tooltipContent');
	ni1.innerHTML = 'Please input your correct mobile number. Your details will not be shared without your consent.';
}
	</script>
    
    <style type="text/css">
	.box-right-icici {background:#FFF;padding:5px 5px 0px 5px; width:279px;margin:auto;}
.image-wrapper-icici{ width:261px; margin:2px auto;}
.tool-tip-image{ width:250px; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#990000; padding:10px; background:#eeeeee; border-radius:5px; border:#CCC solid 2px; }
.tool-tiparrow{ width:53px; margin:-4px auto;}

	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:350px;	/* Width of box */
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
	</style>
</head>
<body>	

<hr>
<div class="header">
<div class="header-inner">
<div class="logo" style="font-family:Arial, Helvetica, sans-serif; color:#06396b; font-size:22px; font-weight:bold; width:600px !important;">Get Instant Quote on ICICI Bank Personal Loans</div><!--<div class="logo"><img src="images/icici-app-logo.jpg" width="189" height="47"></div>-->
<div class="right-box-app"><span class="text-a">Powered by</span> <br>
<span class="text-a" style="color:#0f8eda; font-size:18px;">Deal4loans.com</span></div>
<div style="clear:both;"></div>
</div>
</div>
<div class="wrapper">
<div class="left-container">
<div style="clear:both"></div>
<div id="wrapper">
   <div id="container">

<form id="myform" onSubmit="return chkpersonalloan('document.loan_form');" action="icicibank-application-secondpage.php" method="post" name="loan_form">
<input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $ProductValue; ?>">
<div class="box1">
<div class="box1-inn" style="width:270px;"><em>I need <span class="blue-color">Personal Loan of </span></em></div>
<div class="loaninput">
<div class="input-rupee"><img src="images/rupee-text.jpg" width="8" height="13"></div>
<div class="loaninput-inn">
<input name="cust_loan" id="cust_loan" onFocus="(this.value == 'Enter the amount') && (this.value = ''); addLoanAmtTool(); "  class="loaninput-inn1" onKeyUp="intOnly(this); getDiToWordsIncome('cust_loan','formatLoan','wordLoan');"  onKeyPress="intOnly(this);  getDiToWordsIncome('cust_loan','formatLoan','wordLoan');"  onblur=" (this.value == '') && (this.value = 'Enter the amount') getDiToWordsIncome('cust_loan','formatLoan','wordLoan');" style="color:#000000;" autocomplete="off" onChange="validateDiv('custLoanVal');" tabindex="1" value="<?php echo $customer_loan_amt ; ?>" /><div id="custLoanVal" class="alert_msg"></div><span id='formatLoan' style='font-size:11px;font-weight:normal; color:#0000;font-Family:Verdana;'></span> <span id='wordLoan' style='font-size:11px;font-weight:normal; color:#0000;font-Family:Verdana;text-transform: capitalize;'></span>
</div>
</div>
<div style="clear:both;"></div>
</div>
<div class="form-wrapper-app">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td colspan="2" align="left" class="formbodytext" style="font-size:18px; color:#000;">Professional Details</td>
         </tr>
         <tr>
           <td width="37%" align="left" class="formbodytext" >&nbsp;</td>
           <td width="63%" align="left" class="formbodytext">&nbsp;</td>
         </tr>
         <tr>
           <td align="left" class="formbodytext">City</td>
           <td align="left" class="formbodytext"><select name="City" id="City" class="select-bx" onChange="validateDiv('cityVal');" tabindex="2" onFocus="addCityTool();">
             <?=plgetCityList($City)?>
             <option value="Vapi">Vapi</option>
             <option value="Ankleshwar">Ankleshwar</option>
             <option value="Anand">Anand</option>
             <option value="Anand">Dahod</option>
             <option value="Anand">Navsari</option>
           </select><div id="cityVal" class="alert_msg"></div></td>
           </tr>
         <tr>
           <td colspan="2" class="formbodytext" height="3"></td>
         </tr>
         <tr>
           <td class="formbodytext">
           </td>
           <td class="formbodytext">&nbsp;</td>
           </tr>
         <tr>
           <td class="formbodytext" height="10">Age</td>
           <td class="formbodytext" height="10"><select name="age" id="age" class="select-bx" onChange="validateDiv('ageVal');" tabindex="3" onFocus="addAgeTool();">
           <option value="">Please Select</option>
           <?php 
	   		$selectedA = '';
		   for($ag=18;$ag<=60;$ag++)
		   {
		   		$selectedA = '';
				if($age == $ag)
				{
					$selectedA = 'selected';
				}
		   		echo '<option value="'.$ag.'" '.$selectedA.'>'.$ag.'</option>';
		   }
		   ?>
           
           </select><div id="ageVal" class="alert_msg"></div></td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" height="10">&nbsp;</td>
         </tr>
         <tr>
           <td align="left" class="formbodytext">Employment Status</td>
           <td class="formbodytext">
           <select name="Employment_Status"  id="Employment_Status" class="select-bx" tabindex="4"  onchange="validateDiv('empStatusVal');"  onFocus="addEmpTool();" >
                           <option value="-1">Occupation</option>
                           <option value="1" <?php if($iciciapp_occupation==1) echo "selected"; ?>>Salaried</option>
                           <option value="0" <?php if($iciciapp_occupation==0) echo "selected"; ?>>Self Employment</option>
                       </select>  <div id="empStatusVal" class="alert_msg"></div>
            </td>
         </tr>
         <tr>
           <td align="left" class="formbodytext">&nbsp;</td>
           <td class="formbodytext">&nbsp;</td>
         </tr>
         <tr>
           <td align="left" class="formbodytext">Company Name</td>
           <td class="formbodytext"><input name="Company_Name" id="Company_Name" type="text" class="input-bx" onBlur="onBlurDefault(this,'Type slowly to autofill'); " onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event, 'https://www.deal4loans.com/ajax-list-plicici.php')" onFocus="addPersonalDetails();  onFocusBlank(this,'Type slowly to autofill');  addCompanyTool();" onKeyDown="validateDiv('companyNameVal');" tabindex="5" autocomplete="off"  style="color:#999999;" value="<?php echo $iciciapp_company_name ; ?>" />
                        <div id="companyNameVal" class="alert_msg"></div></td>
         </tr>
         <tr>
           <td colspan="2" height="10"></td>
         </tr>
         <tr>
           <td class="formbodytext"></td>
           <td class="formbodytext">
       
           </td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" height="10" >
           <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr><td align="left" class="formbodytext" width="37%">Monthly Take Home Salary</td><td class="formbodytext" width="63%" valign="top"><input type="text" name="Net_Salary" id="Net_Salary" class="input-bx" onKeyUp="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);" onFocus="addIncomeTool();"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  tabindex="6" onKeyDown="validateDiv('netSalaryVal');"  autocomplete="off"  value="<?php echo $iciciapp_salary ; ?>" /><div id="netSalaryVal" class="alert_msg"></div> <span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#0000;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;font-weight:normal; color:#0000;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
           <tr><td colspan="2" height="15"></td></tr><tr>  <td width="37%" valign="top" class="formbodytext">Total EMI per Month</td>  <td width="63%" valign="top" class="formbodytext"><input type="text" name="total_emi" id="total_emi" class="input-bx" onKeyUp="intOnly(this); getDiToWordsIncome('total_emi','formatedemi','wordemi');" onKeyPress="intOnly(this);"  onFocus="addTotalEMITool();" onBlur="getDiToWordsIncome('total_emi','formatedemi','wordemi');" tabindex="7"  autocomplete="off"  value="<?php echo $iciciapp_secure_emi ; ?>" /> <span id='formatedemi' style='font-size:11px;font-weight:normal; color:#0000;font-Family:Verdana;'></span> <span id='wordemi' style='font-size:11px;font-weight:normal; color:#0000;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
           <tr>  <td colspan="2" class="formbodytext" height="15"></td></tr><tr><td width="37%" align="left" valign="top" class="formbodytext">EMIs paid only for Personal Loans</td><td width="63%" class="formbodytext"><input type="text" name="other_emi" id="other_emi" class="input-bx" onKeyUp="intOnly(this); getDiToWordsIncome('other_emi','formatedother_emi','wordother_emi');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome('other_emi','formatedother_emi','wordother_emi');" tabindex="8"  onFocus="addOtherEMITool();"  autocomplete="off"  value="<?php echo $iciciapp_unsecure_emi ; ?>" /><span id='formatedother_emi' style='font-size:11px; font-weight:normal; color:#0000;font-Family:Verdana;'></span> <span id='wordother_emi' style='font-size:11px;font-weight:normal; color:#0000;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
           <tr><td colspan="2" height="15"></td></tr><tr>    <td width="37%" valign="top" class="formbodytext">Your relation with ICICI Bank </td><td width="63%" valign="top" class="formbodytext">
           <select name="relationship" id="relationship" class="select-bx" tabindex="9" onChange="addPDetails();"   onFocus="addRelationshipTool();">
           <option value="">Select</option>
           <option value="SALARY_ACCOUNT" <?php if($iciciapp_relation=="SALARY_ACCOUNT") echo "selected"; ?>>Salaried Account</option>
           <option value="SAVINGS_ACCOUNT"  <?php if($iciciapp_relation=="SAVINGS_ACCOUNT") echo "selected"; ?>>Savings Account</option>
           <option value="CREDIT_CARD"  <?php if($iciciapp_relation=="CREDIT_CARD") echo "selected"; ?>>Credit Card</option>
           <option value="CURRENT_ACCOUNT"  <?php if($iciciapp_relation=="CURRENT_ACCOUNT") echo "selected"; ?>>Current Account</option>
           <option value="HOME_LOAN"  <?php if($iciciapp_relation=="HOME_LOAN") echo "selected"; ?>>Home Loan</option>
           <option value="PERSONAL_LOAN"  <?php if($iciciapp_relation=="PERSONAL_LOAN") echo "selected"; ?>>Personal Loan</option>
           <option value="CAR_LOAN" <?php if($iciciapp_relation=="CAR_LOAN") echo "selected"; ?>>Car Loan</option>
           <option value="TWO_WHLR_LOAN" <?php if($iciciapp_relation=="TWO_WHLR_LOAN") echo "selected"; ?>>Two Wheeler Loan</option>
           <option value="TERM_DEPOSIT" <?php if($iciciapp_relation=="TERM_DEPOSIT") echo "selected"; ?>>Term Deposit</option>
           <option value="LOAN_AGAINST_SECURITIES" <?php if($iciciapp_relation=="LOAN_AGAINST_SECURITIES") echo "selected"; ?>>Loan Against Securities</option>
           <option value="DEMAT" <?php if($iciciapp_relation=="DEMAT") echo "selected"; ?>>Demat</option>
           <option value="OTHER" <?php if($iciciapp_relation=="OTHER") echo "selected"; ?>>No Existing Relationship</option>
                  </select><div id="relVal" class="alert_msg"></div></td></tr>
<tr><td colspan="2" class="formbodytext" style="font-size:12px;">&nbsp;</td></tr><tr><td colspan="2" align="center" class="formbodytext" ><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="48%"  align="left" class="formbodytext" style="font-size:18px; color:#000;" colspan="2"> Personal Details</td></tr><tr><td width="4%" style="font-size:10px; font-weight:normal; color:#7e5a09;"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="96%" align="left" style="font-size:10px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;  color:#7e5a09; font-weight:bold;"><strong>Your Information is secure with us</strong></td></tr></table></td></tr><tr><td align="left" class="formbodytext" width="37%">Name</td>  <td class="formbodytext" width="63%" valign="top"><input type="text" name="Name" id="Name" class="input-bx"  autocomplete="off" tabindex="10" onKeyDown="validateDiv('nameVal');" onFocus="addNameTool();" value="<?php echo $iciciapp_name; ?>"/><div id="nameVal" class="alert_msg"></div></td></tr><tr><td colspan="2" height="15"></td></tr>

<tr><td width="37%" valign="top" class="formbodytext">Mobile Number</td><td width="63%" valign="top" class="formbodytext">+91 <input type="text" name="Phone" id="Phone" class="input-bx-phone"  onKeyPress="intOnly(this);" tabindex="11" maxlength="10"  onFocus="addMobileTool();" autocomplete="off" value="<?php echo $iciciapp_mobile_number ; ?>" onKeyDown="validateDiv('phoneVal');" />  <div id="phoneVal" class="alert_msg"></div> </td></tr>
<tr><td colspan="2" class="formbodytext" style="font-size:11px;">&nbsp;</td></tr>
<tr><td width="37%" valign="top" class="formbodytext">Email</td><td width="63%" valign="top" class="formbodytext"><input type="text" name="Email" id="Email" class="input-bx" tabindex="12" autocomplete="off" value="<?php echo $iciciapp_email ; ?>" onKeyDown="validateDiv('emailVal');" />  <div id="emailVal" class="alert_msg"></div> </td></tr>
<tr><td colspan="2" class="formbodytext" style="font-size:11px;">&nbsp;</td></tr>

<tr><td colspan="2" class="formbodytext" style="font-size:12px !important;"><input name="accept" type="checkbox" checked  tabindex="13" /> I authorize ICICI Bank & its representatives to call or sms me with reference to my loan application and agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="color:#000; text-decoration:underline;">Terms & Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td></tr><tr><td colspan="2" class="formbodytext" style="font-size:11px;">&nbsp;</td></tr><tr><td colspan="2" align="center" class="formbodytext"><input type="submit" style="border: 0px none ; background: url(images/submit-app.png); width: 135px; height: 40px; margin-bottom: 0px; font-size:1px;" tabindex="14"/></td></tr></table></td></tr></table>
           
           </td>
         </tr>
         
         <tr>
           <td colspan="2" >                </td></tr>
        
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:10px;">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:10px;"><strong>Disclaimer: </strong>All loans are on sole discretion on the banks</td>
         </tr>
       </table>
   </div>
     
    </form>
    </div>
  </div>

</div>
<div class="right-panel">
<div class="box-right" id="rightAnimation"><div class="box-right-icici"><div class="tool-tip-image" id="tooltipContent">Put the Loan Amount Required </div><div class="tool-tiparrow"><img src="images/arrow-icici-app-tool-tip.png" width="53" height="13" /></div><div class="image-wrapper-icici"><img src="images/character-icici-app.jpg" width="261" height="192" /></div><div style="clear:both; padding-bottom:8px; padding-top:8px;"><img src="images/instant-banner.jpg" width="100%" height="278"></div></div></div>

</div>
</div>
</body>
</html>