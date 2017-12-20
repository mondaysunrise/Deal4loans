<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_POST);

	$hdfc_carprice = round($_POST['hdfc_carprice']);
	$Loan_Amt = $_POST['Loan_Amt'];
	$loan_interest = $_POST['loan_interest'] / 1200;
	$max_tenure = $_POST['max_tenure'] * 12;

$pay = $Loan_Amt * $loan_interest / (1 - (pow(1/(1 + $loan_interest), $max_tenure)));
 $tot_amount = $pay * $max_tenure;
 $tot_interest = $tot_amount - $Loan_Amt;


	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$Company_Name = $_POST['Company_Name'];
	$City = $_POST['City'];
	$Annual_Salary = $_POST['Annual_Salary'];
	$dd = $_POST['dd'];
	$mm = $_POST['mm'];
	$yyyy = $_POST['yyyy'];
	$Car_Model = $_POST['Car_Model'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDFC BANK | Deal4loans</title>
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<style type="text/css"> 
<!-- 
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
	text-align: center; 
	color: #000000;
}
.twoColLiqRtHdr #container { 
	width: 90%;  
	background: #FFFFFF;
	margin: 0 auto; 
	border: 1px solid #000000;
	text-align: left; 
} 
.twoColLiqRtHdr #header { 
	background: #DDDDDD; 
	padding: 0 10px;
} 
.twoColLiqRtHdr #header h1 {
	margin: 0; 
	padding: 10px 0;
}
.twoColLiqRtHdr #sidebar1 {
	float: right; 
	width: 30%; 
	padding-top: 15px; 
	padding-left: 15px; 
}
.twoColLiqRtHdr #sidebar1 h3, .twoColLiqRtHdr #sidebar1 p {
	margin-left: 10px; 
	margin-right: 10px;
}
.twoColLiqRtHdr #mainContent { 
	margin: 0 0 0 10px;
	width:610px;
} 

.twoColLiqRtHdr #footer { 
	padding:10px; 
	background:#DDDDDD; 
} 
.twoColLiqRtHdr #footer p {
	margin: 0; 
	padding: 10px 0; 
}
.fltrt { 
	float: right;
	margin-left: 8px;
}
.fltlft {
	float: left;
	margin-right: 8px;
}
.clearfloat {
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}
.text8 {
	font-family: 'Carrois Gothic', serif;
	font-size: 13px;
	font-weight: bold;
	font-variant: normal;
	text-decoration: none;
	@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
}

.text9 {
	font-family: 'Carrois Gothic', serif;
	font-size: 20px;
	font-weight: bold;
	font-variant: normal;
	text-decoration: none;
	@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
}
.inputtext
{
	-moz-border-radius: 10px;
	border-radius: 10px;
    border:solid 1px #e6e6e6;
    padding:5px;
	background-color:#e6e6e6; 
	height:20px;
}
.design2{
background-color:#ff1552;
border:1px solid #ff1552;
padding:5px;
-webkit-border-radius:10px;
-moz-border-radius:10px;
width:150px;
text-align:left;
height:37px;
font-size:15px;
color:#FFFFFF;
font-family: 'Carrois Gothic', serif;
@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
font-weight:bolder;
}
select {
    width:250px;
	height:27px;
     border:solid 1px #e6e6e6;
	 background-color:#e6e6e6; 
    -webkit-border-top-right-left-radius: 10px;
    -webkit-border-bottom-right-left-radius: 1px;
    -moz-border-radius: 10px;
    -moz-border-radius: 10px;
    padding:2px;
}
#emi_sum { background: none repeat scroll 0pt 0pt #fcfcfc; clear: both; float: left; width: 200px; margin: 0pt 0px 0px 0pt;  height: 195px; }
#emi_sum div { margin: 0pt 0pt 0px; padding: 10px 0px 0pt; text-align: center; width: 200px; border-top: 1px dotted rgb(147, 79, 79); }
#emi_sum h4 { color: #934f4f; font-weight: bold; }
#emi_sum p { font-size: 18px; font-weight: bold; margin: 0pt auto; }
#emi_sum span { padding-left: 5px; }

#emiamount { border-top: 0pt none ! important; }
#emiamount p { font-size: 24px; }
.showintr  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px Arial, Helvetica, sans-serif;    color: #00000;}
--> 
</style><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColLiqRtHdr #sidebar1 { padding-top: 30px; }
.twoColLiqRtHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>

 <style type="text/css">
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
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
	
	
	</style>
<script>
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

function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
		alert("Kindly fill in your Name!");
		Form.Name.select();
		return false;
	}
	else if(containsdigit(Form.Name.value)==true)
	{
		alert("Name contains numbers!");
		Form.Name.select();
		return false;
	}
	for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
			alert ("Name has special characters.\n Please remove them and try again.");
			Form.Name.select();
			return false;
		}
	  }
	if(document.loan_form.Phone.value=="")
	{
		alert("Please Enter Mobile Number");
		document.loan_form.Phone.focus();
		return false;
	}

	if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
	{
		  alert("Enter numeric value");
		  Form.Phone.focus();
		  return false;  
	}
	if (Form.Phone.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			 Form.Phone.focus();
			return false;
	}

	if (Form.Phone.value.charAt(0)!="9" && Form.Phone.value.charAt(0)!="8" && Form.Phone.value.charAt(0)!="7")
	{
			alert("The number should start only with 9 or 8");
			Form.Phone.focus();
			return false;
	}
	if(Form.Email.value=="")
	{
		alert("Please enter  Email Address");
		Form.Email.focus();
		return false;
	}
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		alert("Please enter the valid Email Address");
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Please enter the valid Email Address");
		Form.Email.focus();
		return false;
	}
	return true;
}

</script>
<!--<link rel="stylesheet" href="jsj/stylecal_hdfccl.css" type="text/css" media="screen" /> -->
</head>

<body class="twoColLiqRtHdr">
<!--http://www.cssportal.com/form-elements/text-box.htm -->
<div id="container">
  <div id="header" >
    <div align="left" style="height:45px; padding-top:6px;"><img src="new-images/hdfc_cl_logo.gif" width="184" height="34" border="0"/></div>
  <!-- end #header --></div>
  <div id="sidebar1" style="padding-top:30px;">
  <table cellpadding="0" cellspacing="0" border="0"   class="inputtext" style="width:230px; height:220px; ">
<tr><td class="text9" style="color:#4c4c4c; size:18px; height:37px; padding-left:70px;"  ><span >Results</span></td></tr>
  <tr><td valign="top" align="center" style="padding-left:9px;background-color:#e6e6e6;">
  <div id="emipaymentdetails" style="background-color:#e6e6e6;" class="showintr" >
	<div  id="emi_sum" style="background-color:#e6e6e6;" class="showintr">
		<div id="emiamount" style="background-color:#e6e6e6;" class="showintr">
		  <h4 class="showintr">Monthly Instalment (EMI)</h4>
		  <p style="font-size:12px;" class="showintr">Rs. <span><?php echo number_format(round($pay)); ?></span></p>
		  <p style="font-size:12px;" class="showintr">&nbsp;</p>
		</div>
        <div id="emitotalinterest" class="showintr" style="background-color:#e6e6e6;"><h4 class="showintr">Total Interest Amount</h4><p style="font-size:12px;" class="showintr">Rs. <span><?php echo number_format(round($tot_interest)); ?></span></p>
          <p style="font-size:12px;" class="showintr">&nbsp;</p>
        </div>
        <div id="emitotalamount" class="showintr" style="background-color:#e6e6e6;"><h4 class="showintr">Total Amount<br/>(Principal + Interest)</h4><p style="font-size:12px;" class="showintr">Rs. <span><?php echo number_format(round($tot_amount)); ?></span></p></div>
    </div>

</div>

  </td></tr>
  
  </table>
  
  </div>
  <div id="mainContent" style="padding-top:6px; padding-bottom:60px; " >
  <form  method="POST" action="hdfc-car-loan-app-thanks.php" name="loan_form"  onSubmit="return submitform(document.loan_form);" >
  <table cellpadding="0" cellspacing="0" border="0">
  <tr><td class="text9" colspan="2" style="padding-left:5px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 2px solid;width:585px;"><span  > Your personal details</span></div> </td></tr>
   <tr>
	<td width="325"  class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Name</td>
      </tr><tr>
    <td width="375"><input type="text" name="Name" id="Name" style="width:250px;" class="inputtext" value="<?php echo $Name; ?>" /></td></tr></table>
   </td>
	<td width="325"> <table width="275" border="0" >
      <tr><td width="275" class="text8">Mobile No.</td>
      </tr><tr>
    <td width="275"><input type="text" name="Phone" id="Phone" class="inputtext" style="width:250px; height:20px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $Phone; ?>" /></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
 <tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Email</td>
      </tr><tr>
    <td width="375"><input type="text" name="Email" id="Email" class="inputtext" style="width:250px; height:20px;" value="<?php echo $Email; ?>" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">City</td>
      </tr><tr>
    <td width="275"><input type="text" name="City" id="City" class="inputtext" style="width:250px; height:20px;" value="<?php echo $City; ?>" readonly="readonly" /></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr>
        <td width="325" class="text8">DOB</td>
      </tr><tr>
    <td width="375"><input name="dd" id="dd" type="text" size="4" maxlength="2" class="inputtext" value="<?php echo $dd; ?>" onblur="onBlurDefault(this,'DD');" onfocus="onFocusBlank(this,'DD');"/ onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">	/ <input name="mm" id="mm" type="text" size="4" maxlength="2" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $mm; ?>" onblur="onBlurDefault(this,'MM');" onfocus="onFocusBlank(this,'MM');"/>  / <input name="yyyy" id="yyyy" type="text" size="7" maxlength="4" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $yyyy; ?>" onblur="onBlurDefault(this,'YYYY');" onfocus="onFocusBlank(this,'YYYY');"/></td></tr></table>
   </td>
	<td>
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Pancard No</td>
      </tr><tr>
    <td width="375"><input name="Pancard" id="Pancard" type="text" class="inputtext" style="width:250px;" maxlength="10" /></td></tr></table>
  </td>
</tr>
<tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Resi Address Line 1</td>
      </tr><tr>
    <td width="375"><input name="residence_address" id="residence_address" type="text" class="inputtext" style="width:250px;" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Resi Address Line 2</td>
      </tr><tr>
    <td width="275"><input name="office_address" id="office_address" type="text" class="inputtext" style="width:250px;" /></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Pincode</td>
      </tr><tr>
    <td width="375"><input name="pincode" id="pincode" type="text" style="width:250px;" maxlength="6" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Resi Telephone</td>
      </tr><tr>
    <td width="275"><input style="width:50px; "  name="home_phone" id="home_phone" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input style="width:180px; " class="inputtext" name="home_phone" id="home_phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr><td class="text9" colspan="2" style="padding-left:5px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 2px solid;width:585px;"><span  > Your occupational details</span></div> </td></tr>
<tr >
	<td class="text8" >
     <table width="275" border="0" >
      <tr><td width="275" class="text8">Annual Income</td>
      </tr><tr>
    <td width="275"><input name="income" id="income" type="text" style="width:250px;" class="inputtext" value="<?php echo $Annual_Salary; ?>" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Company</td>
      </tr>
      
      <tr>
    <td width="275"><input name="company_name" id="company_name" type="text"  style="width:250px;" class="inputtext"  value="<?php echo $Company_Name; ?>" readonly="readonly" ></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" ><table width="275" border="0" >
      <tr><td width="275" class="text8">Primary Account in which bank?</td>
      </tr><tr>
    <td width="275"><input type="text"  style="width:250px;" name="Primary_Acc" id="Primary_Acc" class="inputtext" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event,'http://www.deal4loans.com/ajax-list-bankname.php'); " ></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Credit Card</td>
      </tr><tr>
    <td width="275" class="text8">
     <input type="radio" name="CC_Holder" id="CC_Holder" value="1" style="border:none;" /> Yes   <input type="radio" name="CC_Holder" id="CC_Holder" value="0" style="border:none;" /> No
    </td></tr></table></td>
</tr>
<tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Office Address Line 1</td>
      </tr><tr>
    <td width="375"><input name="off_address" id="off_address" type="text" class="inputtext" style="width:250px;" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Office Address Line 2</td>
      </tr><tr>
    <td width="275"><input name="off1_address" id="off1_address" type="text" class="inputtext" style="width:250px;" /></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Pincode</td>
      </tr><tr>
    <td width="375"><input name="pincode_o" id="pincode_o" type="text" style="width:250px;" maxlength="6" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td></tr></table>
   </td>
	<td>  <table width="275" border="0" >
      <tr><td width="275" class="text8">Office Telephone</td>
      </tr><tr>
    <td width="275"><input style="width:50px; "  name="office_std" id="office_std" value="Std" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input class="inputtext" style="width:110px; "  name="office_phone" id="office_phone" value="Number" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input style="width:50px; " class="inputtext"  name="office_ext" id="office_ext" value="Ext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td></tr></table></td>
</tr>

 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr><td class="text9" colspan="2" style="padding-left:5px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 2px solid;width:585px;"><span  > Additional details</span></div> </td></tr>

<tr >
	<td class="text8" >
   
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Make & model of car</td>
      </tr><tr>
    <td width="375"><input name="car_name" id="car_name" type="text"  style="width:250px;" class="inputtext" value="<?php echo $Car_Model; ?>" readonly="readonly" /></td></tr></table>
   </td>
	<td>&nbsp; </td>
</tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
Select one document in each section below that you will provide as proof</td></tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
	<table width="553" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="143" align="left" valign="top" class="text8">Proof of Income</td>
	<td width="410" ><select name="Income_Proof" id="Income_Proof" style="width:210px;" >
    <option value="">Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>
    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option>
</select>
</td>
</tr>

</table>
	</td>
</tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
	<table width="553" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="143" align="left" valign="top" class="text8">Proof of Address</td>
	<td width="410" >
    <select name="Address_Proof" id="Address_Proof" style="width:210px;">
    <option value="">Select</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)">Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)</option>
    <option value="Latest Life Insurance policy premium receipts (paid)">Latest Life Insurance policy premium receipts (paid)</option>
    <option value="Post-paid mobile phone bill in your name">Post-paid mobile phone bill in your name</option>
    <option value="Letter from Employer certifying current mailing address">Letter from Employer certifying current mailing address</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Registered Rental / Lease Agreement">Registered Rental / Lease Agreement</option>
    <option value="Property Registration documents/Ownership proof copy">Property Registration documents/Ownership proof copy</option>
    <option value="Passbook">Passbook</option>
    <option value="Bank statement (last 3 months)">Bank statement (last 3 months)</option>
    <option value="Driving License">Driving License</option>
    <option value="Loan repayment track record">Loan repayment track record</option>
    <option value=" Registration certificate (RC) of 4-wheeler in applicant's name"> Registration certificate (RC) of 4-wheeler in applicant's name</option>
	</select>
</td>
</tr>

</table>
	</td>
</tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
	<table width="553" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="143" align="left" valign="top" class="text8">Proof of Identity</td>
	<td width="410" ><select name="Identity_Proof" id="Identity_Proof"  style="width:210px;">
        <option value="">Select</option>
        <option value="Passport">Passport</option>
        <option value="Election ID card">Election ID card</option>
        <option value="Driving License">Driving License</option>
        <option value="Photo Credit/Debit/ATM Card">Photo Credit/Debit/ATM Card</option>
        <option value="Government organisation ID card with signature and photo">Government organisation ID card with signature and photo</option>
        <option value="PAN Card">PAN Card</option>
        <option value="Company ID card">Company ID card</option>
        <option value="Insurance / Mediclaim Photo Card">Insurance / Mediclaim Photo Card</option>
        <option value="Ration Card">Ration Card</option>
        <option value="Home property papers (registered deed">Home property papers (registered deed</option>
        <option value="Registration certificate (RC) of vehicle in applicant's name">Registration certificate (RC) of vehicle in applicant's name</option>
	</select>
	</td>
	</tr>
	</table>
</td>
</tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
	<table width="553" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="143" align="left" valign="top" class="text8">Bank Statement</td>
	<td width="410">
    <select name="Bank_Statement" id="Bank_Statement"  style="width:210px;" >
    <option value="">Select</option>
    <option value="Salary account bank statement - last 6 months">Salary account bank statement - last 6 months</option>
	</select>
    </td>
    </tr>
    </table>
	</td>
</tr>


<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:45px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" align="left" style="padding-left:6px;" >
<input class="design2" type="submit" name="Submit" value=">> SUBMIT "   />    
   </td>
	<td>&nbsp; </td>
</tr>
</table>
</form>
</div>
<br class="clearfloat" />
<div id="footer">
</div>
</div>
</body>
</html>