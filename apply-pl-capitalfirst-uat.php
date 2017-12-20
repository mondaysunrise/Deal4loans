<?php
	require 'scripts/session_check.php';

$urltype=$_REQUEST["urltype"];
if($urltype=="httpsurl")
{	require 'scripts/functionshttps.php'; }
else
{	require 'scripts/functions.php'; }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$pl_requestid = FixString($pl_requestid);
		$name = FixString($name);
		$fullename = explode(" ",$name);
		echo $firstname = $fullename[0];
		$lastname = $fullename[1];
		$company_name = FixString($company_name);
		$salary = FixString($salary);
	}		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<style type="text/css">
.heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#AE1518; margin-left:15px; }
.capital-first{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
#sidebar {
	width: 340px;
	float: right;
	margin: 30px 0 30px;
}
#content {
	background: #fff;
	margin: 30px 0 30px 20px;
	padding: 10px;
	width: 570px;
	float: left;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.widget {
	background: #fff;
	margin: 0 0 30px;
	padding: 10px 20px;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.capital-first_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border: 1px solid #AE1518;}
.capital-first_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.capital-first_input{width:100%;  border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}

.sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
.sbi_text_bullet li{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
.sbi_text_bullet li a{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}

.capital-first {
    color: #333;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    font-weight: bold;
}
.capital-first_input {
    width: 100%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input-one {
    width:31%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	.capital-first_select-one {
    width:31.5%;
    height: 27px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input{
    width: 100%;
    border-radius: 5px 5px 5px 5px;
    border:solid 1px #AE1518;}
	
	@media screen and (max-width: 800px){
.heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#AE1518; margin-left:15px; }
.capital-first{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
#sidebar {
	width:90%;
	float:none;
	margin: 30px 0 30px;
}
#content {
	background: #fff;
	margin: 30px 0 30px 20px;
	padding: 10px;
	width:90%;
	float:none;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}

.widget {
	background: #fff;
	margin: 0 0 30px;
	padding: 10px 20px;
	/* rounded corner */
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	/* box shadow */
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
	box-shadow: 0 1px 3px rgba(0,0,0,.4);
}
.capital-first_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
.capital-first_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border:1px solid #AE1518;}

.sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
.sbi_text_bullet li{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
.sbi_text_bullet li a{color:#AE1518; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}

.capital-first {
    color: #333;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    font-weight: bold;
}
.capital-first_input {
    width: 100%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input-one {
    width:98%;
    height: 25px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	.capital-first_select-one {
    width:98%;
    height: 27px;
    border-radius: 5px 5px 5px 5px;
    border: solid 1px #AE1518;}
	
	.capital-first_input{
    width: 100%;
    border-radius: 5px 5px 5px 5px;
    border:solid 1px #AE1518;}
	
	}
</style>
<style type="text/css">
.heading_text1 {font: bold 20px/100% Arial, Helvetica, sans-serif; color:#AE1518; margin-left:20px; }
</style>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript">
function sameasabove_adress()
{
	var ni1 = document.cibil_form.caddress.value;
	document.getElementById('paddress').value= ni1;	
	var ni2 = document.cibil_form.state.value;
	document.getElementById('pstate').value= ni2;	
	var ni3 = document.cibil_form.pincode.value;
	document.getElementById('ppincode').value= ni3;
}

$(function() {
	//for first name
$("#first_name").focus(function(){
	$(this).css({'color' : '#000000'});
});
$("#first_name").blur(function(){
if($("#first_name").val()=="First Name")
{
$(this).css({'color' : '#999999'});
}
else
{
$(this).css({'color' : '#000000'});
}
});
//middle name
$("#middle_name").focus(function(){
	$(this).css({'color' : '#000000'});
});
$("#middle_name").blur(function(){
if($("#middle_name").val()=="Middle Name")
{
$(this).css({'color' : '#999999'});
}
else
{
$(this).css({'color' : '#000000'});
}
});
//last name
$("#last_name").focus(function(){
	$(this).css({'color' : '#000000'});
});
$("#last_name").blur(function(){
if($("#last_name").val()=="Last Name")
{
$(this).css({'color' : '#999999'});
}
else
{
$(this).css({'color' : '#000000'});
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
function ckhcreditcard(Form)
{
	if(Form.first_name.value=="" || Form.first_name.value=="First Name")
	{
		alert("Please enter First Name");
		Form.first_name.focus();
		return false;
	}
	if(Form.last_name.value=="" || Form.last_name.value=="Last Name")
	{
		alert("Please enter Last Name");
		Form.last_name.focus();
		return false;
	}
	if(Form.day.selectedIndex==0)
	{
		alert("Please enter Day");
		Form.day.focus();
		return false;
	}
	if(Form.month.selectedIndex==0)
	{
		alert("Please enter Month");
		Form.month.focus();
		return false;
	}
	if(Form.year.selectedIndex==0)
	{
		alert("Please enter Year");
		Form.year.focus();
		return false;
	}
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
	if(Form.purpose_of_loan.selectedIndex==0)
	{
		alert("Please enter Purpose of Loan");
		Form.purpose_of_loan.focus();
		return false;
	}
	if(Form.current_address.value=="")
	{
		alert("Please enter Current Address");
		Form.current_address.focus();
	}
	if(Form.current_address_pincode.value=="")
	{
		alert("Please enter Current Address Pincode");
		Form.current_address_pincode.focus();
	}
	if(Form.property_status.selectedIndex==0)
	{
		alert("Please enter Property Status");
		Form.property_status.focus();
		return false;
	}
}
</script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div style="max-width:995px;  margin:auto;">
<div id="content"><form name="cibil_form" method="post" action="/apply-pl-capitalfirst-continue_uat.php"  onSubmit="return ckhcreditcard(document.cibil_form); ">
<input type="hidden" name="requestid" id="requestid" value="<? echo $pl_requestid; ?>"/> 
<table align="center"  cellpadding="5" cellspacing="0"  width="100%">
<tr><td colspan="2"   bgcolor="#FFFFFF" class="heading_text" align="left">Fill in the below details to start your loan application process</td></tr>
<tr>
<td colspan="2" valign="middle" bgcolor="#FFFFFF" class="heading_text" height="40"> &nbsp;Enquiry Details</td></tr>
<tr>
  <td class="capital-first">Name As Per PAN Card</td>
  <td><label for="textfield"></label>
    <input name="first_name" type="text" class="capital-first_input-one" id="first_name"  value="<? echo $firstname; ?>" />
    <input name="middle_name" type="text" class="capital-first_input-one" id="middle_name" value="Middle Name" onFocus="onFocusBlank(this,'Middle Name');" onBlur="onBlurDefault(this,'Middle Name'); " style="color:#999999;"/>
    <input name="last_name" type="text" class="capital-first_input-one" id="last_name" onFocus="onFocusBlank(this,'Last Name');" onBlur="onBlurDefault(this,'Last Name'); " style="color:#999999;" value="<? echo $lastname; ?>"/></td></tr>
  <tr> 
    <td class="capital-first" height="25">Date Of Birth As Per PAN Card</td>
    <td><label for="select4"></label>
      <select name="day" class="capital-first_select-one" id="day">
	  <option value="">DD</option>
	  <? for($d=1;$d<=31;$d++) 
	  { echo $d; ?> <option value="<? echo $d; ?>"><? echo $d; ?></option>
	  <? } ?>
      </select>
      <select name="month" class="capital-first_select-one" id="month">
        <option value="">MM</option>
		<option value="01">Jan</option>
		<option value="02">Feb</option>
		<option value="03">Mar</option>
		<option value="04">Apr</option>
		<option value="05">May</option>
		<option value="06">Jun</option>
		<option value="07">Jul</option>
		<option value="08">Aug</option>
		<option value="09">Sep</option>
		<option value="10">Oct</option>
		<option value="11">Nov</option>
		<option value="12">Dec</option>		
		</select>
      <select name="year" class="capital-first_select-one" id="year">
        <option value="">YYYY</option>
		 <? $minage =date('Y')-18;  $maxage =date('Y')-62;
		 for($y=$maxage;$y<=$minage;$y++) 
	  { echo $y; ?> <option value="<? echo $y; ?>"><? echo $y; ?></option>
	  <? } ?>
      </select></td></tr>
	  <tr><td class="capital-first" height="25">PAN No:</td><td><input type="text" name="panno" id="panno" maxlength="10" class="capital-first_input"/></td></tr>
	   <tr>
    <td class="capital-first">Gender</td>
    <td class="capital-first"><label for="select"></label>
      <select name="gender" class="capital-first_input" id="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        </select></td>
  </tr>
  <tr>
    <td class="capital-first">Marital Status</td>
    <td class="capital-first"><label for="select"></label>
      <select name="marital_status" class="capital-first_input" id="marital_status">
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        </select></td>
  </tr>
  <tr>
    <td class="capital-first">Purpose of Loan</td>
    <td class="capital-first"><select name="purpose_of_loan" class="capital-first_input" id="purpose_of_loan">
	<option value="">Please Select</option>
      <option value="Car Repair or Purchase">Car Repair/Purchase</option>
      <option value="Education">Education</option>
      <option value="Holidays">Holidays</option>
       <option value="Home Improvement or Lot Downpayment">Home Improvement/Lot Downpayment</option>
       <option value="Investments">Investments</option>
       <option value="Medical Expense">Medical Expense</option>
       <option value="Others">Others</option>
         <option value="Wedding">Wedding</option>    
    </select></td>
  </tr>
  <tr>
    <td class="capital-first">Current Address (With Landmark)</td>
    <td class="capital-first"><textarea rows="3" cols="21" name="current_address" id="current_address" class="capital-first_txtinput"></textarea></td>
  </tr>
  <tr>
    <td class="capital-first">Current Address Pincode</td>
    <td class="capital-first"><input type="text" name="current_address_pincode" id="current_address_pincode" class="capital-first_txtinput"></td>
  </tr>
  <tr>
    <td class="capital-first">Property Status</td>
    <td class="capital-first"><select name="property_status" class="capital-first_input" id="property_status">
		<option value="">Please Select</option>
      <option value="Company Provided">Company Provided</option>
      <option value="Mortgaged">Mortgaged</option>
      <option value="Owned">Owned</option>
      <option value="Relatives House">Relatives House</option>
      <option value="Rented">Rented</option>
        </select></td>
    </tr>
  <tr>
    <td class="capital-first">Annual Gross Income</td>
    <td class="capital-first"><label for="textfield4"></label>
      <input name="annual_income" type="text" class="capital-first_input" id="annual_income" value="<? echo $salary; ?>"/></td>
  </tr>
  <tr>
    <td class="capital-first">Company Name</td>
    <td class="capital-first"><input name="company_name" type="text" class="capital-first_input" id="company_name" value="<? echo $company_name; ?>"/></td>
  </tr>
  <tr>
    <td class="capital-first">Office Address (With Landmark &amp; PIN Code)</td>
    <td class="capital-first"><textarea rows="3" cols="21" name="office_address" id="office_address" class="capital-first_txtinput"></textarea></td>
  </tr>
  <tr><td width="205" class="capital-first">&nbsp;</td>
<td width="273" class="capital-first">&nbsp;</td></tr>
    <td colspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(images/capital-first-btn.jpg); width:129px; height:41px; margin-bottom: 0px;" value=""/></td></tr>
    <tr><td colspan="2" class="capital-first" style="color:#333333; font-weight:normal;"><b>Disclaimer</b> : By submitting the above details you are authorizing Capital First to run a CIBIL check on your profile
</td></tr>
    </table></form></div>    
    <div id="sidebar">
    <div class="widget">
      <table width="100%" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="58%" height="40" class="heading_text1" style="font-size:18px;"><span class="heading_text_b">Why Capital First?</span></td>
          <td width="42%" align="right" class="heading_text1" style="font-size:18px;"><img src="http://www.deal4loans.com/homeimages/capital-first-logo-index.png" /></td>
        </tr>
        <tr>
          <td colspan="2" style="color:#999; font-family:Verdana, Geneva, sans-serif; font-size:12px;">&nbsp;</td>
        </tr>
      </table>
      <div class="sbi_text_bullet">
  <ul>
  <li>Only KYC Documents required <br> <div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Get loan basis your KYC documents only, no need to submit any financial documents like salary slip, ITR, form 16 etc.</div></li>
<li>Get online in-principle approval <br><div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;"> Just provide your basic Personal/Professional details to get instant approval on your Personal Loan</div></li>
<li>Loans up to Rs.4 lacs<br/></li>
<li>Disbursal in 3 working days</li>
</ul>  
</div>
    </div>
    </div>
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>