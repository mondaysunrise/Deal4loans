<?php
require 'scripts/functions.php'; 
require 'scripts/db_init.php';
error_reporting(0);
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="creditcard LPjuly2016"; }
//$IP_Remote = getenv("REMOTE_ADDR");
$IP=ExactCustomerIP();

if ($iphone || $android || $palmpre || $ipod || $berry == true) 
{
	$device = "Mobile Device Detected";	
	$retrivesource =$retrivesource."Mob";
}
else { 			$device = "Desktop";	$retrivesource =$retrivesource;}


?>
<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Deal4loan.com - Apply Credit Card</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link href="css/creditcard-lp-mobile-ui-styles.css" type="text/css" rel="stylesheet">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link href="css/font-awesome.css" type="text/css" rel="stylesheet" >
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
  <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
  <script type="text/javascript" src="/ajax.js"></script>
  <script type="text/javascript" src="/ajax-dynamic-sbicclist.js"></script>
  <style>
a.tooltip {
	outline: none;
}
a.tooltip strong {
	line-height: 30px;
}
a.tooltip:hover {
	text-decoration: none;
}
a.tooltip span {
	z-index: 10;
	display: none;
	padding: 14px 20px;
	margin-top: -30px;
	margin-left: 28px;
	width: 300px;
	line-height: 16px;
}
a.tooltip:hover span {
	display: inline;
	position: absolute;
	color: #111;
	border: 1px solid #DCA;
	background: #fffAF0;
}
.callout {
	z-index: 20;
	position: absolute;
	top: 30px;
	border: 0;
	left: -12px;
}
/*CSS3 extras*/
a.tooltip span {
	border-radius: 4px;
	box-shadow: 5px 5px 8px #CCC;
}
#ajax_listOfOptions {
	position: absolute;
	width: 250px;
	height: 160px;
	overflow: auto;
	border: 1px solid #317082;
	background-color: #FFF;
	color: #000;
	font-family: Verdana, 'Raleway';
	text-align: left;
	font-size: 10px;
	z-index: 100
}
#ajax_listOfOptions div {
	cursor: pointer;
	font-size: 10px;
	margin: 1px;
	padding: 1px
}
#ajax_listOfOptions .optionDivSelected {
	background-color: #2375CB;
	color: #FFF
}
#ajax_listOfOptions_iframe {
	background-color: red;
	position: absolute;
	z-index: 5
}
.hintanchor {
	font-size: 12px;
	font-weight: bold;
	color: #F00;
}
#wordloanAmount {
	padding-bottom: 15px;
}
#wordIncome {
	padding-bottom: 15px;
}
.alert_msg {
	margin-bottom: 15px;
}
#nameVal {
	padding-bottom: 15px;
}
#mobileVal {
	padding-bottom: 15px;
}
</style>
  <style type="text/css">
.dd-select {
	border-radius: 2px;
	padding: 4px 10px 4px 10px;
	border: solid 1px #ccc;
	position: relative;
	cursor: pointer;
}
.dd-select a {
	color: #444d50 !important;
	text-decoration: none;
	font-weight: bold;
	font-size: 17px;
}
@media (max-width:768px) {
.dd-select a {
	color: #444d50 !important;
	text-decoration: none;
	font-weight: bold;
	font-size: 14px!important;
}
.dd-select {
	color: #444d50 !important;
	text-decoration: none;
	font-weight: bold;
	font-size: 14px;
}
}
.dd-desc {
	color: #aaa;
	display: block;
	overflow: hidden;
	font-weight: normal;
	line-height: 1.4em;
}
.dd-selected {
	overflow: hidden;
	display: block;
	padding: 10px;
	font-weight: bold;
}
.dd-selected a {
	overflow: hidden;
	display: block;
	padding: 14px 10px 14px 10px !important;
	font-weight: bold;
	color: #444d50 !important;
}
.dd-pointer {
	width: 0;
	height: 0;
	position: absolute;
	right: 10px;
	top: 50%;
	margin-top: -3px;
}
.dd-pointer-down {
	border: solid 5px transparent;
	border-top: solid 5px #000;
}
.dd-pointer-up {
	border: solid 5px transparent !important;
	border-bottom: solid 5px #000 !important;
	margin-top: -8px;
}
.dd-options {
	border: solid 1px #ccc;
	border-top: none;
	list-style: none;
	box-shadow: 0px 1px 5px #ddd;
	display: none;
	position: absolute;
	z-index: 2000;
	margin: 0;
	padding: 0;
	background: #fff;
	text-indent: 5px;
	overflow: auto;
}
.dd-option {
	padding: 10px;
	display: block;
	border-bottom: solid 1px #ddd;
	overflow: hidden;
	text-decoration: none;
	color: #333;
	cursor: pointer;
	-webkit-transition: all 0.25s ease-in-out;
	-moz-transition: all 0.25s ease-in-out;
	-o-transition: all 0.25s ease-in-out;
	-ms-transition: all 0.25s ease-in-out;
}
.dd-options > li:last-child > .dd-option {
	border-bottom: none;
}
.dd-option:hover {
	background: #f3f3f3;
	font-weight: bold;
	font-size: 17px;
	color: #000;
}
@media (max-width:768px) {
.dd-option:hover {
	background: #f3f3f3;
	font-weight: bold;
	font-size: 14px;
	color: #000;
}
.dd-option {
	background: #f3f3f3;
	font-weight: normal;
	font-size: 14px;
	color: #000;
}
}
.dd-selected-description-truncated {
	text-overflow: ellipsis;
	white-space: nowrap;
}
.dd-option-selected {
	background: #f6f6f6;
}
.dd-option-image, .dd-selected-image {
	vertical-align: middle;
	float: left;
	margin-right: 5px;
	max-width: 64px;
}
.dd-image-right {
	float: right;
	margin-right: 15px;
	margin-left: 5px;
}
.dd-container {
	position: relative;
	width: 400px;
}
​ .dd-selected-text {
	font-weight: bold
}
​
</style>

  <script language="javascript">
//function intOnly(e){if(e.value.length>0){e.value=e.value.replace(/[^\d]+/g,"")}}
  function charOnly(e){
	var regex = /^[a-zA-Z]*$/;
  if (regex.test(e.value)) {
	  alert("IF");
      return true;
  } else {
	  	  alert("ELSE");
	  e.value=e.value.replace(/[^\d]+/g,"");
  }
	 } 
	 
	 function isCharsetKey(evt)
{
var charCode=(evt.which)?evt.which:event.keyCode
if((charCode>33)&&(charCode<58))
return false;
return true;
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
function validateCC(Form)
{
	var i;
	var j;
	var cnt=-1;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if(Form.ccwith.selectedIndex==0)
		{
			document.getElementById('ccWithVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Credit Card with !</span>";
			Form.ccwith.focus();
			return false;
		}


if ( ( Form.ccStatus[1].checked == false ) && ( Form.ccStatus[0].checked == false ) ) 
{
alert ( "Please choose Is this your first credit card?" ); 
return false;
}
if(Form.ccStatus[0].checked==false)
{
if(Form.No_of_Banks.selectedIndex==0)
		{
			document.getElementById('BankNameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Bank Name !</span>";
			Form.No_of_Banks.focus();
			return false;
	}
}
if(Form.City.selectedIndex==0)
		{
			document.getElementById('CityVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select City !</span>";
			Form.City.focus();
			return false;
	}
	
	if(Form.City.value=='Others')
		{
			if(Form.City_Other.value=='')
			{
			
			document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Other City !</span>";
			Form.City_Other.focus();
			return false;
			}
	}
	
if((Form.Net_Salary.value==''))
{
	document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";		
	Form.Net_Salary.focus();
	return false;
}
if(Form.Full_Name.value=="")
{
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Your name</span>";		
	Form.Full_Name.focus();
	return false;
}
else if(containsdigit(Form.Full_Name.value)==true)
{
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name Contains Numbers</span>";		
	Form.Full_Name.focus();
	return false;
}

for (var i = 0; i < Form.Full_Name.value.length; i++) 
{
  	if (iChars.indexOf(Form.Full_Name.value.charAt(i)) != -1) 
	{
//		alert ("Name has special characters.\n Please remove them and try again.");
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Name has special characters</span>";		
		Form.Full_Name.focus();
		return false;
  	}
}
if((Form.Phone.value=='Mobile Number') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
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
                //alert("The number should start only with 9 or 8 or 7");
				 document.getElementById('mobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Start with 9 or 8 or 7</span>";
				 Form.Phone.focus();
                return false;
        }

	if(Form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Email Id </span>";	
		Form.Email.focus();
		return false;
	}
		
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Please enter valid E-mail Address. </span>";
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Enter valid E-mail Address.");
		document.getElementById('emailVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter valid E-mail Address.</span>";
		Form.Email.focus();
		return false;
	}
	
	if(Form.day.selectedIndex==0)
		{
			document.getElementById('DDVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Date !</span>";
			Form.day.focus();
			return false;
	}
	if(Form.month.selectedIndex==0)
		{
			document.getElementById('MMVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Month !</span>";
			Form.month.focus();
			return false;
	}
	if(Form.year.selectedIndex==0)
		{
			document.getElementById('YYYYVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Year !</span>";
			Form.year.focus();
			return false;
	}
	
	if(Form.Company_Name.value=="")
	{
		document.getElementById('CompanyVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Company Name</span>";	
		Form.Company_Name.focus();
		return false;
	}
	
	if(!Form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Accept Terms & Condition!</span>";	
		Form.accept.focus();
		return false;
	}
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function addDetailsVal(ValDet)
{
	if(ValDet==3)
	{
		document.getElementById("SelectBank").style.display="none";
	}
	else
	{	
		document.getElementById("SelectBank").style.display='block';
	}
}	

function showPersonalDetails(){
	document.getElementById("persoanlDetails").style.display="block";
	}
	
function removeIdentified()
{
	eval(document.getElementById("myDiv1")).style.display='none';
}	
  
  function addothercity(){
	
	if(document.getElementById("City").value=='Others')
	{
	document.getElementById("fillOtherCity").style.display="block";
	}else{
		document.getElementById("fillOtherCity").style.display="none";
		}
  }
  </script>
 <link rel="stylesheet" href="css/jquery.mytooltip.css">
  <link rel="stylesheet" href="css/tooltipstyle.css">
 <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/jquery.mytooltip.js"></script>
  <script src="js/script.js"></script>
  </head>
  <body>
<div class="mobile-header">
    <div class="logo"><img src="images/dea4loans-logo.png" alt="logo"></div>
  </div>
<div class="mobile-main-wrapper">
    <form name="CCfrm" method="post" action="get_cc_eligiblebank_under.php" onsubmit="return validateCC(document.CCfrm);">
	<input type="hidden" name="source" value="<? echo $retrivesource; ?>">
		<input type="hidden" name="Employment_Status" id="Employment_Status" value="1">
    <div class="mobile-form-left">
    <div class="head_2">Select a <span class="span">credit card </span>to compliment your style</div>
    <div class="product-listing-new">
<ul>
<li><img src="images/quotes-from-banks.png" width="26" height="26"> Credit Cards from 17 Banks</li>
<li><img src="images/satisfied-customer.png" width="26" height="26"> <strong>63,36,019</strong> quotes taken </li></ul></div>

          <div class="logobanks-box"><strong>Top Credit Card Banks</strong><br><p class="samlltext"><strong>SBI Credit Card, HDFC Bank, Citi Bank, Standard Chartered, RBL, AMEX Credit Card</strong></p></div>

<div class="clearfix"></div>
    
        <div class="col-sm-5 col-md-6 margin-top-cc">I would like to own a credit card with</div>
        <div class="col-sm-5 col-md-6">
        <select name="ccwith" class="mobile-ui-input" onchange="validateDiv('ccWithVal');">
            <option value="">Select Credit Card</option>
            <option value="Travel Offers">Travel Offers</option>
            <option value="Cash back Offers">Cash back Offers</option>
            <option value="Petro Offer">Petrol Offer</option>
            <option value="Dining Offer">Dining Offer</option>
            </select>
        <div id="ccWithVal"></div>
      </div>
        <div class="clearfix"></div>
        <div class="col-sm-5 col-md-6 margin-top-cc">Is this your first credit card?</div>
        <div class="col-sm-5 col-md-6">
        <label for="radio-one">
            <input type="radio" name="ccStatus" id="radio-one" value="1" onClick="addDetailsVal('3'); validateDiv('ccStatusVal');" />
            <i></i> <span>Yes</span> </label>
        <label for="radio-two">
            <input type="radio" name="ccStatus" id="radio-two" value="0"  onClick="addDetailsVal('2');"/>
            <i></i> <span>No</span> </label>
        <div id="ccStatusVal"></div>
      </div>
        <div style="display:none;" id="SelectBank">
        <div class="col-sm-5 col-md-6 margin-top-cc">Which Bank Credit Card you have</div>
        <div class="col-sm-5 col-md-6">
            <select name="No_of_Banks" class="mobile-ui-input" onchange="validateDiv('BankNameVal');">
            <option value="">Select Bank</option>
            <option value="HDFC Bank">HDFC Bank</option>
            <option value="Axis Bank">Axis Bank</option>
            <option value="SBI">SBI</option>
            <option value="Citi Bank ">Citi Bank </option>
            <option value="Bank of India">Bank of India</option>
            <option value="Union Bank of India">Union Bank of India</option>
          </select>
            <div id="BankNameVal"></div>
          </div>
      </div>
	  <div class="clearfix"></div>    
        <div class="col-sm-5 col-md-6 margin-top-cc">Select your City</div>
        <div class="col-sm-5 col-md-6">
        <select name="City" class="mobile-ui-input" onchange="validateDiv('CityVal'); addothercity();" id="City">
		<option value="">Please Select</option>
		 <?php 
		$getcitySql = "SELECT * FROM creditcard_citylist WHERE status=1 GROUP BY cityname";
		list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
		for($cN=0;$cN<$numRowscity;$cN++)
		{
		$cityname = ucwords(strtolower($getcityQuery[$cN]['cityname']));
		$cityalias =ucwords(strtolower($getcityQuery[$cN]['cityalias']));
		?>
			  <option value="<?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?>"><?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?></option>
			  <?php
		}
		?>
		<option value="Others">Others</option>
            </select>
        <div id="CityVal"></div>
      </div>
	    <div style="display:none;" id="fillOtherCity">
        <div class="col-sm-5 col-md-6 margin-top-cc">Fill Other City</div>
         <div class="col-sm-5 col-md-6">
        <input name="City_Other" id="City_Other" type="text" class="mobile-ui-input man-icon" onkeydown="validateDiv('othercityVal');">
            <div id="othercityVal"></div>
          </div>
      </div>
        <div class="clearfix"></div>
        <div class="col-sm-5 col-md-6 margin-top-cc">Annual Income?</div>
        <div class="col-sm-5 col-md-6">
        <input name="Net_Salary" id="Net_Salary" type="text" class="mobile-ui-input input-bottom-margin rupee-icon" onfocus="this.select(); addDetails(); " onblur="addDetails(); getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onchange="intOnly(this);" onkeypress="addDetails(); intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onkeydown="showPersonalDetails(); validateDiv('netSalaryVal');" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');">
        <div id="netSalaryVal"></div>
        <span id="formatedIncome" style="font-family: Verdana,'raleway'; font-size:11px; font-weight:bold; text-align:left;"></span>
        <span id="wordIncome" style="font-family: Verdana,'raleway'; font-size:11px; font-weight:bold; text-align:left;"></span>
      </div>
        <div class="clearfix"></div>
        <div style="display:none;" id="persoanlDetails">
        <hr />
        <h1>Personal Details</h1>
        <div>
            <div class="col-sm-5 col-md-6 margin-top-cc">Name <div class="js-mytooltip type-inline-block"
           data-mytooltip-custom-class="align-center"
           data-mytooltip-direction="right"
           data-mytooltip-content="As to be displayed on your Credit Card"><img src="images/toolquestion.png" width="14" height="14" onmouseover="tooltip.pop(this, '#tip2');">
            </div>
          </div>
            <div class="col-md-6">
            <input name="Full_Name" id="Full_Name" type="text" class="mobile-ui-input man-icon" onkeydown="validateDiv('nameVal');">
            <div id="nameVal"></div>
          </div>
            <div class="clearfix"></div>
            <div class="col-sm-5 col-md-6 margin-top-cc">Mobile <div class="js-mytooltip type-inline-block"
           data-mytooltip-custom-class="align-center"
           data-mytooltip-direction="right"
           data-mytooltip-content="To be used for tracking purpose"><img src="images/toolquestion.png" width="14" height="14" onmouseover="tooltip.pop(this, '#tip3');">
            </div>
          </div>
            <div class="col-md-6">
            <input name="Phone" id="Phone" type="text" class="mobile-ui-input input-bottom-margin mobile-icon" maxlength="10" onchange="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('mobileVal');">
          <div id="mobileVal"></div>
          </div>
            <div class="clearfix"></div>
            <div class="col-sm-5 col-md-6 margin-top-cc">Email ID <div class="js-mytooltip type-inline-block"
           data-mytooltip-custom-class="align-center"
           data-mytooltip-direction="right"
           data-mytooltip-content="To be used for tracking purpose"><img src="images/toolquestion.png" width="14" height="14" onmouseover="tooltip.pop(this, '#tip4');">
            </div>
          </div>
            <div class="col-md-6">
            <input name="Email" id="Email" type="text" class="mobile-ui-input input-bottom-margin mobile-icon" onkeydown="validateDiv('emailVal');">
          <div id="emailVal"></div>
          </div>
            <div class="clearfix"></div>
           <div class="col-sm-5 col-md-6 margin-top-cc">Date of Birth</div>
            <div class="col-md-6">
            <select name="day" class="dd-ui-input" onchange="validateDiv('DDVal');">
                <option value="">DD</option>
               <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
               <option value="13">13</option>
               <option value="14">14</option>
               <option value="15">15</option>
               <option value="16">16</option>
               <option value="17">17</option>
               <option value="18">18</option>
               <option value="19">19</option>
               <option value="20">20</option>
               <option value="21">21</option>
               <option value="22">22</option>
               <option value="23">23</option>
               <option value="24">24</option>
               <option value="25">25</option>
               <option value="26">26</option>
               <option value="27">27</option>
               <option value="28">28</option>
               <option value="29">29</option>
               <option value="30">30</option>
               <option value="31">31</option>
              </select>
            <select name="month" class="dd-ui-input" onchange="validateDiv('MMVal');">
            <option value="">MM</option>
                <option value="01">01</option>
               <option value="02">02</option>
               <option value="03">03</option>
               <option value="04">04</option>
               <option value="05">05</option>
               <option value="06">06</option>
               <option value="07">07</option>
               <option value="08">08</option>
               <option value="09">09</option>
               <option value="10">10</option>
               <option value="11">11</option>
               <option value="12">12</option>
              </select>
            <select name="year" class="dd-ui-input" onchange="validateDiv('YYYYVal');">
                <option value="">YYYY</option>
                <?php for($yy=1960;$yy<=2003; $yy++) {?>
                <option value="<?php echo $yy;?>"><?php echo $yy;?></option>
                <?php }?>
              </select>
          <div id="DDVal"></div><div id="MMVal"></div><div id="YYYYVal"></div>
          </div>
           <div class="col-sm-5 col-md-6 margin-top-cc">Company Name</div>
            <div class="col-md-6">
                    
            <input name="Company_Name" id="Company_Name" type="text" class="mobile-ui-input input-bottom-margin mobile-icon"  onkeydown="validateDiv('companyNameVal');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"  onblur="onBlurDefault(this,'Type Slowly for Autofill');" onfocus="onFocusBlank(this,'Type Slowly for Autofill');">
                <div id="companyNameVal"></div>
            
          </div>
          </div>
        
      </div>
        <div class="clearfix"></div>
        <span class="t-and-c-text">
      <label for="check-one">
          <input type="checkbox" name="accept" id="check-one" onClick="validateDiv('acceptVal');" checked />
          <i></i> <span>I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to Privacy policy and Terms and Conditions.</span> </label>
    <div id="acceptVal"></div>
      </span>
        <div class="clearfix"></div>
        <div style="clear:both; margin-top:15px;"></div>
        <input class="submit-btn" type="submit" value="Explore Credit Card">
      </div>
  </form>
    <div style="clear:both; margin-top:15px;"></div>
  </div>
</body>
</html>