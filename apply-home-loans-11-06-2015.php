<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

//29may15
$cfcampaign=ExecQuery("Select count(leadid) AS Cfcount from commonfloor_hlcampaign group by cf_mobile_number");
$cfrow=mysql_fetch_array($cfcampaign);
$Commonfloorcount = $cfrow["Cfcount"];
if($Cfcount>0)
{
	$Cfcount=$Commonfloorcount;
}
else
{
	$Cfcount=0;
}
//end Commonfloor campaign

$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource="HL Site Page";
}
else
{
	$retrivesource="HL Site Page";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Home Loan apply : Apply for home loans Online and get quotes from all home loan provider of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad, Pune etc.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include"middle-menu.php"; ?>
<div class="hl_inner_wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Home Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="hl-form-wrapper">
<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td colspan="2">
     <div class="headtextedubox"> <h1 style="color:#000; font-size:16px">Apply Home Loan</h1></div>
   <div class="apply-edu-button">     <a href="home-loan-balance-transfer-calculator.php"><img src="images/apply_a-new.png" width="166" height="38" style="max-height:50%;" border="0" /></a></div></td>
    </tr>  
  <tr>
    <td colspan="2"><img src="images/home-loan-quotes-animated.gif" style="width:100%; max-width:574px;  margin-bottom:7px;" height="23"></td>
    </tr>
  </table>
  
<?php 
$newsource="HL Site Page";
//$subjectLine="Apply Home Loan";
//include "home-loans-widget-wp.php";?>

<link href="css/styles-home-loan.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="css-range-slider/rangeslider.css">
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
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}	
	if (document.loan_form.Net_Salary.value=="" || document.loan_form.Net_Salary.value=="Annual Income")
		{ 
		
			document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";
			document.loan_form.Net_Salary.focus();
		return false;
		}	
	if (document.loan_form.City.selectedIndex==0)
	{		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Select City to Continue!</span>";			document.loan_form.City.focus();		return false;	}
	
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	if(document.loan_form.Name.value=="" || document.loan_form.Name.value=="Full Name")
	{
		document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
   }

	if(document.loan_form.Email.value=="" || document.loan_form.Email.value=="E-mail Id")
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
	
	
	if(document.loan_form.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span class='hintanchor'>Select Age!</span>";
		document.loan_form.Age.focus();
		return false;
	}
	
	if(isNaN(document.loan_form.Phone.value) || document.loan_form.Phone.value=="Mobile No." ||  document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter Mobile No.!</span>";
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
	
	if (document.loan_form.property_value.value=="" || document.loan_form.property_value.value=="Property Value")
	{ document.getElementById('propertyValueVal').innerHTML = "<span  class='hintanchor'>Enter Property Value!</span>"; document.loan_form.property_value.focus();		return false;	}

	for(i=0; i<document.loan_form.Property_Identified.length; i++) 
	{
        if(document.loan_form.Property_Identified[i].checked)
		{
   	 		cnt= i;
		}
	}
		if(cnt == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
		if(cnt==0)
		{ 
			if(document.loan_form.Property_loc.selectedIndex==0)
			{
				document.getElementById('PropLocationVal').innerHTML = "<span class='hintanchor'>Plese select city where property is located</span>";
				document.loan_form.Property_loc.focus();
				return false;
			}
		}
	
	if(!document.getElementById("checkboxG2").checked)
	{
		document.getElementById('TermConditionVal').innerHTML = "<span class='hintanchor'>Please Check Term and condition to proceed.</span>";
		document.loan_form.accept.focus();
		return false;
	}
	
}  


function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = '<div class="form-input-wrapper form-box-left-margin"><div>Property Location</div>    <div><select name="Property_loc" id="Property_loc" class="form-select" onchange="validateDiv(\'PropLocationVal\');"><?=getCityList1($City)?></select></div><div id="PropLocationVal"></div></div>';
	  var cfdiv = document.getElementById('commonfloorlogo');
	//alert(cfdiv);
	cfdiv.innerHTML='';
		return true;		
}	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';				
		return true;
}	
function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{				eval(document.getElementById("divfaq"+j)).style.display=''			}
			else			{				eval(document.getElementById("divfaq"+j)).style.display='none'			}
		}
			
	}
}
function validateDiv(div) {	var ni1 = document.getElementById(div); 	ni1.innerHTML = ''; }


</script>
<script type="text/javascript">
function addPersonalDetails()
	{
		if(document.loan_form.City.value!="")
			{
				row = document.getElementById('PersonalDetails').style.display='block';	
			}
			
		if(document.loan_form.City.value=="")
			{
				row = document.getElementById('PersonalDetails').style.display='none';	
			}
	
	}
	
	function othercity1()
	{
		if(document.loan_form.City.value=="Others")
			{
				row = document.getElementById('otherCityDisp').style.display='block';	
			}
			
		if(document.loan_form.City.value!="Others")
			{
				row = document.getElementById('otherCityDisp').style.display='none';	
			}
	
	}
	
	
	function commomfloor()
{

	var cfcount = document.getElementById('Cfcount').value;
	var cfdiv = document.getElementById('commonfloorlogo');
	if(cfcount<=500)
	{
		var cit = document.loan_form.City.value;
		var prpval = document.loan_form.property_value.value;
		
		if((cit=="Delhi" || cit=="Mumbai" || cit=="Gurgaon" || cit=="Noida" || cit=="Gaziabad" || cit=="Thane" || cit=="Navi Munmbai" || cit=="Faridabad") && prpval>=2000000)
		{
			cfdiv.innerHTML='<table width="100%">  <tr><td class="commonfloor">			 <input type="checkbox" name="cf_campaign" id="cf_campaign" class="css-checkbox" value="1" /><label for="cf_campaign" class="css-label-check"> I would like to get property options from commonfloor.com </label></td> <td align="left"><img src="images/commonfloor-logo.jpg" width="72" height="32" border="0" /></td></tr></table><div style="clear:both;"></div>';
		}
		else
			cfdiv.innerHTML='';
	}
}
	
	
	</script>
    <?php 
if((!strlen(strpos($_SERVER['REQUEST_URI'], "/home-loan-emi-calculator1.php")) > 0))
{
?>
<script src="js-range-slider/range-slider-jquery-min.js"></script>
<?php }?>
<script src="js-range-slider/rangeslider.min.js"></script>
<script>
	
	$('input[type="range"]').rangeslider();
	
	$('input[type="range"]').rangeslider('destroy');
</script>
<script>
$(function() {

	var $document = $(document),
		selector = '[data-rangeslider]',
		$element = $(selector);

	// Example functionality to demonstrate a value feedback
	function valueOutput(element) {
		var svalue = element.value,
		output = element.parentNode.getElementsByTagName('output')[0];
		document.getElementById('Loan_Amount').value=svalue;
	
	}
	for (var i = $element.length - 1; i >= 0; i--) {
		valueOutput($element[i]);
	};
	$document.on('change', 'input[type="range"]', function(e) {
		valueOutput(e.target);
	});

	
	$document.on('change', '#js-example-change-value input[type="number"]', function(e) {
			var $inputRange = $('input[type="range"]', e.target.parentNode),
			value = $('input[type="number"]', e.target.parentNode)[0].value;

		$inputRange.val(value).change();
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

<div class="form-ui-main-wrapper">
  <div class="form-ui-main-wrapper-inner">
    <form name="loan_form" method="post" action="insert-home-loans.php" onSubmit="return chkform();">
      <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
      <input type="hidden" name="Cfcount" id="Cfcount" value="<?php echo $Cfcount; ?>">
      <input type="hidden" name="Activate" id="Activate" >
      <input type="hidden" name="source" value="HL Site Page">
      
      <div class="form-clear"></div>
      <div >Loan Amount</div>
      <div class="form-clear" style="height:25px;"></div>
      <!--- Range Slider start--->
      
      <div id="js-example-change-value">
        <input type="range" min="800000" max="15000000" step="100000" value="2000000"  onChange="intOnly(this); getDiToWordsIncome('Loan_Amount_Range','RangeFormatedIncome', 'RangeWordIncome'); " id="Loan_Amount_Range" data-rangeslider>
        <output></output>
        <input type="number" value="2000000" step="100000" name="Loan_Amount" id="Loan_Amount" onkeyup="intOnly(this); getDiToWordsIncome('Loan_Amount','RangeFormatedIncome', 'RangeWordIncome'); " class="form-output">
      </div>
      <div id="RangeFormatedIncome" style="display: none;"></div>
      <div id="RangeWordIncome" style="display: none;"></div>
      
      <!-- Range Slider End-->
      <div class="form-clear"></div>
      <div class="nagative-margin-new">
        <div class="form-input-wrapper">
          <div class="form-icon"><img src="test-newui/images-newui/occupation-frm-icon.png" width="45" height="45" alt="Occupation" /></div>
          <div class="form-clear"></div>
          <select name="Employment_Status" onchange="validateDiv('empStatusVal');" class="form-select" >
            <option value="-1">Select Occupation</option>
            <option value="1">Salaried</option>
            <option value="0">Self Employed</option>
          </select>
          <div id="empStatusVal"></div>
        </div>
        <div class="form-input-wrapper form-box-left-margin">
          <div class="form-icon"><img src="test-newui/images-newui/rupee-symbol-form.png" width="45" height="45" alt="Annual income" /></div>
          <div class="form-clear"></div>
          <input type="text" name="Net_Salary" id="Net_Salary" value="Annual Income" class="form-input" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome', 'wordIncome'); " onkeypress="intOnly(this);" onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome'); if (this.value == '') {this.value = 'Annual Income';}"   onfocus="if (this.value == 'Annual Income') {this.value = '';}" onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');" autocomplete="off">
          <div id="netSalaryVal"></div>
          <span id="formatedIncome" style="display: none;"></span> <span id="wordIncome" style="display: none;"></span> </div>
        <div class="form-input-wrapper form-box-left-margin">
          <div class="form-icon"><img src="test-newui/images-newui/loaction-icon.png" alt="location icon" /></div>
          <div class="form-clear"></div>
          <select name="City" id="City" onchange="addPersonalDetails(); othercity1(); validateDiv('cityVal'); addhdfclife();" class="form-select">
            <option value="">Select City</option>
            <?=getCityList($City)?>
          </select>
          <div id="cityVal"></div>
          <div style="display:none;" id="otherCityDisp">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25"><span style="color:#183cb8"></span></td>
              </tr>
              <tr>
                <td height="25"><input name="City_Other" id="City_Other" type="text" class="form-input  ui-body-c ui-corner-all ui-shadow-inset" onblur="if (this.value == '') {this.value = 'Other City';}" onfocus="if (this.value == 'Other City') {this.value = '';}" onkeydown="validateDiv('othercityVal');" value="Other City" />
                  <div id="othercityVal"></div></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="form-clear"></div>
        <div style="display:none;" id="PersonalDetails">
          <div class="form-clear"></div>
          <div class="form-sub-head form-special-top-margin">Personal Details</div>
          <div class="termtext"><img src="images/security.png" width="14" height="16">Your Information is secure with us and will not be shared without your consent</div>
          <div class="form-clear margin-top-symbol"></div>
          <div class="form-input-wrapper">
            <div class="form-icon"><img src="test-newui/images-newui/name-icon.png" width="45" height="45" alt="Name" /></div>
            <div class="form-clear"></div>
            <input type="text" class="form-input" value="Full Name"  name="Name" id="Name" onblur="if (this.value == '') {this.value = 'Full Name';}" onfocus="if (this.value == 'Full Name') {this.value = '';}" onkeydown="validateDiv('nameVal');" autocomplete="off"  />
            <div id="nameVal"></div>
          </div>
          <div class="form-input-wrapper form-box-left-margin">
            <div class="form-icon"><img src="test-newui/images-newui/mail-id-icon.png" width="45" height="45" alt="Email-id" /></div>
            <div class="form-clear"></div>
            <input  type="text" class="form-input"  value="E-mail Id" name="Email" id="Email" onblur="if (this.value == '') {this.value = 'E-mail Id';}" onfocus="if (this.value == 'E-mail Id') {this.value = '';}"  onkeydown="validateDiv('emailVal');" autocomplete="off" />
            <div id="emailVal"></div>
          </div>
          <div class="form-input-wrapper form-box-left-margin">
            <div class="form-icon"><img src="test-newui/images-newui/age-icon.png" width="45" height="45" alt="Age" /></div>
            <div class="form-clear"></div>
            <select onchange="validateDiv('AgeVal');"  name="Age" id="Age" class="form-select">
              <option value="">Select Age</option>
              <?php for($a=18;$a<=65;$a++) {?>
              <option value="<?php echo $a;?>"><?php echo $a;?></option>
              <?php }?>
            </select>
            <div id="AgeVal"></div>
          </div>
          <div class="form-clear"></div>
          <div class="form-input-wrapper">
            <div class="form-icon"><img src="test-newui/images-newui/mobile-icon.png" width="45" height="45" alt="Contact Number" /></div>
            <div class="form-clear"></div>
            <input type="text" class="form-input"  value="Mobile No." name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv('phoneVal');" onblur="if (this.value == '') {this.value = 'Mobile No.';}" onfocus="if (this.value == 'Mobile No.') {this.value = '';}" />
            <div id="phoneVal"></div>
          </div>
          <div class="form-input-wrapper form-box-left-margin">
            <div class="form-icon"><img src="test-newui/images-newui/property-value.png" width="45" height="45" alt="Property Value" /></div>
            <div class="form-clear"></div>
            <input type="text" class="form-input" value="Property Value"  name="property_value"  id="property_value" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onblur="if (this.value == '') {this.value = 'Property Value';}" onfocus="if (this.value == 'Property Value') {this.value = '';}" onkeydown="validateDiv('propertyValueVal');" />
            <div id="propertyValueVal"></div>
          </div>
          <div class="form-input-wrapper form-box-left-margin">
            <div class="form-icon"><img src="test-newui/images-newui/running-emi.png" width="45" height="45" alt="Running EMI" /></div>
            <div class="form-clear"></div>
            <input type="text" class="form-input" value="Monthly EMI for all running loans" name="obligations" id="obligations" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onblur="if (this.value == '') {this.value = 'Monthly EMI for all running loans';}"
 onfocus="if (this.value == 'Monthly EMI for all running loans') {this.value = '';}" />
          </div>
          <div class="form-clear"></div>
          <div class="form-input-wrapper">
            <div class="form-sub-head form-special-top-margin">Property Identified:</div>
            <div >
              <input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="return addIdentified();" class="css-checkbox" />
              <label for="Property_Identified" class="css-label radGroup2" >yes</label>
              <input type="radio"name="Property_Identified" id="Property_Identified2" onclick="removeIdentified();  commomfloor();" value="0" class="css-checkbox" />
              <label for="Property_Identified2" class="css-label radGroup2">No</label>
             </div>
            <div class="form-clear"></div>
          </div>
           <div id="myDiv1" style="margin-top:6px;"></div>
           <div class="form-clear"></div>
          <div class="form-input-wrapper">
           <div style="height:15px;"></div>
            <div class="form-input-wrapper" style=" margin-top:-10px;">
              <input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" class="css-checkbox"  />
              <label for="co_appli" class="css-label-check">Co - applicants</label>
            </div>
            <div class="form-clear"></div>
          </div>
          <div class="form-clear"> </div>
          <div style="display:none; " id="divfaq1">
            <div class="form-input-wrapper">
              <div class="form-icon"></div>
              <div class="form-clear"></div>
              <input  type="text" class="form-input" value="Co-applicant Name" name="Co-applicant Name" id="Co-applicant Name" onblur="if (this.value == '') {this.value = 'Co-applicant Name';}" onfocus="if (this.value == 'Co-applicant Name') {this.value = '';}"/>
            </div>
            <div class="form-input-wrapper form-box-left-margin">
              <div class="form-icon"></div>
              <div class="form-clear"></div>
<select onkeydown="validateDiv('AgeVal');" class="form-select" name="CoAge" id="CoAge">
                <option value="">Select Age</option>
                <?php for($a=18;$a<=65;$a++) {?>
                <option value="<?php echo $a;?>"><?php echo $a;?></option>
                <?php }?>
              </select>                 </div>
            <div class="form-input-wrapper form-box-left-margin">
              <div class="form-icon"></div>
              <div class="form-clear"></div>
              <input type="text" class="form-input" value="Gross Annual Salary" name="Gross Annual Salary" id="Gross Annual Salary" onblur="if (this.value == '') {this.value = 'Gross Annual Salary';}" onfocus="if (this.value == 'Gross Annual Salary') {this.value = '';}"/>
            </div>
            <div class="form-input-wrapper">
              <div class="form-icon"></div>
              <div class="form-clear"></div>
              <input type="text" class="form-input" value="Monthly EMIs" name="Monthly EMIs" id="Monthly EMIs" onblur="if (this.value == '') {this.value = 'Monthly EMIs';}" onfocus="if (this.value == 'Monthly EMIs') {this.value = '';}"/>
            </div>
          </div>
          <div class="form-clear"></div>
          <div class="bottom-margin-new">
            <input type="checkbox" name="accept" id="checkboxG2" value="1" class="css-checkbox" checked="checked" onclick="validateDiv('TermConditionVal');" />
            <label for="checkboxG2" class="css-label-check">I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style=" color:#3671d5; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">Terms and Conditions</a>.</label>
           <div id="TermConditionVal"></div>
          </div>
      
        </div>
        
        <div style="clear:both !important; padding-top:5px;"></div>
        <div class="form-white-text bntnew-topmargin"><strong class="quote-form_a">54 ,</strong><strong class="quote-form_b">02 ,</strong><strong class="quote-form_c"> 013</strong> Loan quotes taken till now
          <div class="button-right-align">
            <input type="submit" value="Get Quote" class="form-ui-quote-button" />
          </div>
        </div>
        <div style="clear:both !important;"></div>
        <div id="commonfloorlogo"></div>
           <div style="clear:both !important;"></div>
        <div class="form-white-text form-special-top">&bull; 54 lakh customers serviced to get  best Loan deals with deal4loans. Deal4loans views Published @ yourstory .com<br />
          &bull; As RBI cuts rate, should you go for fixed home loan Deal4loans views Published @ Economic Times online </div>
        <div class="form-clear"></div>
        <div></div>
      </div>
    </form>
  </div>
</div>


  </div>
  
    <br />
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td valign="top"><h2 style="margin:auto; font-size:16px; font-weight:bold;">Maximum Home loan Bank Tie ups in online space</h2>
          <br /></td>
      </tr>
    </table>
    <div class="overflow-width">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_bgcolor_Border">
        <tr>
          <td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1">
              <tr class="table_bgcolor">
                <td width="82" height="43" align="center" valign="middle" ><strong>Banks</strong></td>
                <td width="184" height="43" align="center" valign="middle"><strong>ICICI Bank</strong></td>
                <td width="153" height="43" align="center" valign="middle"><strong>HDFC Ltd</strong></td>
                <td width="166" height="43" align="center" valign="middle"><strong>HSBC Bank</strong></td>
                <td width="124" align="center" valign="middle"><strong>PNB Housing Finance</strong></td>
                <td width="133" height="43" align="center" valign="middle"><strong>Axis Bank</strong></td>
                <td width="120" height="43" align="center" valign="middle"><strong>Citibank</strong></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="57" align="center" valign="middle"><b>Rate of Interest</b></td>
                <td height="57" align="center" valign="middle" >9.85% - 9.90%</td>
                <td height="57" align="center" valign="middle" >9.90% - 10.40%</td>
                <td height="57" align="center" valign="middle" >
                9.95% - 10.15%(for Salaried)<br />
            	10.10% - 10.30% (for SelfEmployed)
                </td>
                <td align="center" valign="middle">9.95% - 10.50%</td>
                <td height="57" align="center" valign="middle">9.90% - 10.45% </td>
                <td height="57" align="center" valign="middle">Scheme I: 10.25%*(without Home Credit facility)<br />
                  Scheme II: 10.50%*(with Home Credit facility)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="83" align="center" valign="middle"><b>Processing Fee</b></td>
                <td height="83" align="center" valign="middle">0.50%</td>
                <td height="83" align="center" valign="middle">0.5% plus applicable service tax and cess</td>
                <td height="83" align="center" valign="middle">1% of the loan amount applied for, subject to a minimum of <img src="/new-images/rupees.gif" />10000 plus service tax. This fee is payable on application & is not refundable</td>
                <td align="center" valign="middle">0.5%</td>
                <td height="83" align="center" valign="middle">0.5% of the loan amount<br>
                  (Max. 10000/- + service tax for Salaried) </td>
                <td height="83" align="center" valign="middle">upto 1% of loan amount</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="70" align="center" valign="middle"><b>Loan Amount</b></td>
                <td height="57" align="center" valign="middle">Rs.8,00,000 - Maximum <br />
                  80% of the Cost of the Property <br />
                  (Subject to Income Eligibility)</td>
                <td height="57" align="center" valign="middle">80% of the Cost of the Property<br />
                  (Subject to Income Eligibility)</td>
                <td height="57" align="center" valign="middle">Maximum upto <img src="/new-images/rupees.gif" />10 crores <br />
                  (Subject to Income Eligibility)</td>
                <td align="center" valign="middle">Loans upto 80% of the property value.</td>
                <td height="57" align="center" valign="middle">Rs.1,00,000 - Rs.2,00,00,000</td>
                <td height="57" align="center" valign="middle">Rs.5,00,000 - Rs.10,00,00,000</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="57" align="center" valign="middle"><b>Prepayment Charges</b></td>
                <td height="57" align="center" valign="middle">No prepayment charge on floating rate home loan 
                  For one year, two year and three year fixed rate loan the prepayment charge is 2% of the outstanding loan amount plus applicable service tax and surcharge till the time loan is under fixed rate</td>
                <td height="57" align="center" valign="middle">No prepayment charges shall be payable for partial or full prepayments irrespective of the source</td>
                <td height="57" align="center" valign="middle">NIL </td>
                <td align="center" valign="middle">NIL</td>
                <td height="57" align="center" valign="middle">NIL</td>
                <td height="57" align="center" valign="middle">NIL</td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
  
  <div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
  <!--partners-->
  <div style="margin:auto; width:100%; margin-top:25px;"><strong>Loan Partners</strong></div>
  <div style="margin:auto; width:100%;  margin-top:20px;">
  
  <table width="100%">
      <tr>
        <td><div class="apply-hl-bank-logo"> <img src="/new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"><img src="/new-images/fedbank-nw.jpg" alt="Fedbank" width="130" height="38"  style="border:none;"/> </div>
        <div class="apply-hl-bank-logo"> <img src="/new-images/pnbhfl-logo1.jpg" alt="Fedbank"  style="border:none;"/></div>
        <div class="apply-hl-bank-logo"><img src="/new-images/citibank-logo-d4l-home.jpg" alt="Citibank" width="145" height="38"  style="border:none;"/> </div>
        </td>
      </tr>
    </table>
    <div style="clear:both; height:50px;"></div>
  </div>
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>