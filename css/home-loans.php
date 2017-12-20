<?php
//ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
if(strlen($_REQUEST['source'])>0) {	$retrivesource="HL main Page"; }
else {	$retrivesource="HL main Page";}
$updtdate= date('d F Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<link href="css/home-loan-new-css.css" type="text/css" rel="stylesheet"  />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Home Loan | Housing Loans | Home Loans India 2015</title>
<meta name="keywords" content="Home Loan, Home Loans, Home Loan India, Home loans India, Home Loans Eligibility, home loans documents"/>
<meta name="Description" content="Home Loan: Find Instant Quotes on housing loans, Documents, Types of home loans, Process and various steps involved & Tax Saving Benefits through deal4loans"/>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="scripts/common.js"></script>

<style>
body{
	font-family: "Droid Sans",sans-serif;
}

/*.....................new css added on 27/1/2015 starts................*/
.hl-newform-wrapper-main-new1{ width:1000px; margin:auto;}
.form-wrapper-main{ width:950px; background:#069eca; border-radius:5px; margin:auto; padding:5px;}
.form-head-text-white{ color:#FFF !important;  font-size:20px; color:#343434;}
.input-hanger-new{float:left; width:213px; margin-left:5px;}
.input-symbol-box{float:left;}
.input-symbol-box2{float:left; width:180px; height:37px; background:#FFF; border-radius:0px 5px 5px 0px;}
.input-row-newst{ border:none; height:35px; width:98%;}
.input-row-newst2{ border:none; height:35px; width:98%; border-radius:5px;}
.select-row-newst{ border:none; height:35px; width:98%; border-radius:5px; color:#087c9e;  font-size:15px;}
.input-row-dd{width:30%; height:37px; background:#FFF; border-radius:5px 5px 5px 5px; border:none;}
.home-loan-inner_box{ width:493px; margin:45px auto; background:url(../images/home-loan-inner-page-bg-new.jpg) no-repeat top;}
.best-bank-ico-bx{ float:left; width:138px; margin-top:-20px; margin-left:25px;}
.best-bank-ico-bx2{ width:60px; height:60px; margin:auto; transition: all .2s ease-in-out;}
.best-bank-ico-bx2:hover{ width:60px; height:60px; margin:auto; transform: scale(1.15);}
.text-below-icon{  font-size:14px; color:#343434; text-align:center; margin-top:5px;}
.text-below-icon a{  font-size:14px; color:#343434; text-align:center; text-decoration:none;}
.text-below-icon a:hover{  font-size:14px; color:#f89412; text-align:center;}

.best-bank-ico-bx-right{ float:right; width:188px; margin-top:-20px; margin-left:25px;}
.best-bank-ico-bx-right2{ float:right; width:188px; margin-top:10px; margin-left:25px;}
.best-bank-ico-bx3{ float:left; width:138px; margin-top:15px; margin-left:25px;}
.best-bank-ico-bx4{ width:210px; margin-top:-10px; margin-left:150px;}
.quote-text{ font-size:19px; color: #FFF; }

/*.....................new css added on 27/1/2015 ends................*/

@media screen and (max-width:680px){
/*.....................new css added on 27/1/2015 starts................*/
.home-loan-inner_box{ width:95%; margin:45px auto; background:none;}
.best-bank-ico-bx{width:138px; margin:7px auto; float:none;}
.best-bank-ico-bx2{ width:60px; height:60px; margin:auto; transition: all .2s ease-in-out;}
.best-bank-ico-bx2:hover{ width:60px; height:60px; margin:auto; transform: scale(1.15);}
.text-below-icon{  font-size:14px; color:#343434; text-align:center; margin-top:5px;}
.text-below-icon a{  font-size:14px; color:#343434; text-align:center; text-decoration:none;}
.text-below-icon a:hover{  font-size:14px; color:#f89412; text-align:center;}

.best-bank-ico-bx-right{width:188px; margin:7px auto; float:none;}
.best-bank-ico-bx-right2{width:188px; margin:7px auto; float:none;}
.best-bank-ico-bx3{width:138px; margin:7px auto; float:none;}
.best-bank-ico-bx4{ width:210px; margin:7px auto; float:none;}
.hl-newform-wrapper-main-new1{ width:95%; margin:auto;}
.form-wrapper-main{ width:95%; background:#069eca; border-radius:5px; margin:auto; padding:5px;}
.input-hanger-new{float:left; width:213px; margin-top:10px;}
/*.....................new css added on 27/1/2015 ends................*/
}
</style>
<!-- CSS for top to jump starts -->
<link href="css/top-style.css" type="text/css" rel="stylesheet" />
<!-- CSS for top to jump ends -->
<script type="text/javascript">
jQuery.noConflict(); </script>
<script language="javascript">
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function cityother() {	if(document.loan_form.City.value=="Others")	{		document.loan_form.City_Other.disabled = false;	}	else	{		document.loan_form.City_Other.disabled = true;	}} 
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param) {	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var cnt=-1;
	var i;

	if (document.loan_form.Loan_Amount.value=="")
	{ document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>"; document.loan_form.Loan_Amount.focus();		return false;	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}	
		
	if (document.loan_form.Net_Salary.value=="")	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";			document.loan_form.Net_Salary.focus();		return false;	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.City.selectedIndex==0)
	{		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";			document.loan_form.City.focus();		return false;	}

	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";				document.loan_form.Name.focus();		return false;	}

	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";			document.loan_form.Name.focus();			return false;		}
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";			document.loan_form.Name.focus();			return false;		}
  }
	if(document.loan_form.Email.value=="")
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	
	if(document.loan_form.Phone.value=="")
	{		document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>Fill Mobile Number!</span>";		document.loan_form.Phone.focus();		return false;	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{		document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>Enter numeric value!</span>";		document.loan_form.Phone.focus();		return false;  	}
	if (document.loan_form.Phone.value.length < 10 )
	{	  	document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>Enter 10 Digits!</span>";			document.loan_form.Phone.focus();		return false;	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{	  	document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>should start with 9 or 8 or 7!</span>";			document.loan_form.Phone.focus();		return false;	}

if(document.loan_form.day.value=="" || document.loan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span class='hintanchor'>Fill Day of Birth!</span>";
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
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
		
	if (document.loan_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.loan_form.Pincode.focus();
			return false;
		}
	}
	if (document.loan_form.property_value.value=="")
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
		if(cnt ==0)
		{ 
			if(document.loan_form.Property_Loc.selectedIndex==0)
			{
				alert("Plese select city where property is located");
				Form.Property_Loc.focus();
				return false;
			}
		}

	if(!document.loan_form.accept.checked)
	
	{		alert("Read and Accept Terms & Conditions!");				document.loan_form.accept.focus();		return false;	}	
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
function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
var txtview = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style=" font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
hdfclifecamp(ni1,cit,txtview);
}
function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = '<div style=" float:left; width:183px; height:47px;  margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Location</div>    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="Property_loc" id="Property_loc" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><?=getCityList1($City)?></select></div><div id="vintageVal"></div></div>';		
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';				
		return true;
}	

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
	var ni3 = document.getElementById('addSubmit');
	var ni5 = document.getElementById('getImageScroll');
	
	ni1.innerHTML = '<div style="padding-left:20px;" ><table width="98%" border="0" cellpadding="0" cellspacing="0"><tr><td width="21%"  align="left" style="font-size:19px; color:#FFFFFF; padding-top:5px;"> Personal Details</td><td style="font-size:13px; font-weight:normal; color:#fff;"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></div> <div style="clear:both;"></div><div class="input-hanger-new"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; width:137px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</span></td>    </tr>    <tr>      <td height="25">   <input name="Name" id="Name" type="text"  class="input-row-newst2" onkeydown="validateDiv(\'nameVal\');" />   <div id="nameVal"></div>  </td>    </tr>    </table></div><div class="input-hanger-new">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25"><span class="text" style=" float:left; width:137px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</span></td>    </tr>    <tr>      <td height="25">  <input name="Email" id="Email" type="text" class="input-row-newst2" onkeydown="validateDiv(\'emailVal\');"  />          <div id="emailVal"></div>   </td>    </tr>      </table></div><div class="input-hanger-new">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25"><span class="text" style=" float:left; width:137px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></td>    </tr>        <tr>      <td height="25"><span style=" color:#FFF; font-size:12px; "><em>+91</em></span>        <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="input-row-newst2" style="width:80%;" onkeydown="validateDiv(\'phoneVal\');"  />            <div id="phoneVal"></div>   </td>    </tr>  </table></div><div class="input-hanger-new">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left;  height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</span></td></tr><tr><td height="25"><input name="day" id="day" type="text" class="input-row-dd" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" />        <input name="month" id="month" type="text" class="input-row-dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" />  <input name="year" id="year" type="text" class="input-row-dd" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" />        <div id="dobVal"></div></td>    </tr>    </table></div><div style="clear:both;"></div><div class="input-hanger-new">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left; width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</span></td>    </tr>    <tr>      <td height="25">  <input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv(\'pincodeVal\');" type="text" class="input-row-newst2" tabindex="5" />  <div id="pincodeVal"></div></td>    </tr>    </table></div><div class="input-hanger-new">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25"><span class="text" style=" float:left; width:137px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Value:</span></td>    </tr>    <tr>      <td height="25"><input  name="property_value"  id="property_value" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="input-row-newst2" onkeydown="validateDiv(\'propertyValueVal\');"  tabindex="6" /><div id="propertyValueVal"></div></td>    </tr>      </table></div><div class="input-hanger-new">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25"><span class="text" style=" float:left; width:100%; height:auto; color:#FFF; font-size:12px; text-transform:none;">Monthly EMI for all running loans :</span></td>    </tr>        <tr>      <td height="25"><input  name="obligations" id="obligations" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="input-row-newst2" tabindex="7" /></td>    </tr>  </table></div><div class="input-hanger-new">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25"><span class="text" style=" float:left;  height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Identified:</span></td></tr><tr><td height="25"  style="font-size:12px; color:#FFF;"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="return addIdentified();" style="border:none;" /> Yes   <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;"  /> No <div id="propEditifiedVal"></div></td>    </tr>    </table></div><div style="clear:both;"></div><div class="pl_input_box" id="myDiv1"></div><div style="clear:both;"></div>';

	ni3.innerHTML = '<div class="pl_terms_box"><div class="">  <input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" >      <span class="text" style=" color:#FFF; font-size:12px;">Co - applicants</span></div><span class="text" style="color:#FFF; font-size:11px; text-transform:none;">  <input name="accept" type="checkbox" id="accept" /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.                 <div id="acceptVal"></div></span></div>     <div style="clear:both;"></div><div style="padding-top:10px;"><table width="100%" cellpadding="0" cellspacing="0"><tr><td style="padding-left:25px;"><div class="quote-text"><strong style="background:#e29500; font-size:25px; font-weight:normal;">54</strong>  ,<strong style="background:#043eac; font-size:25px; font-weight:normal;">02 </strong>,  <strong style="background:#44cbbe; font-size:25px; font-weight:normal;">013</strong> Loan quotes taken till now</div><div style="clear:both; height:25px;"></div><div  style=" color:#fff; font-size:12px; text-transform:capitalize; padding-left:5px; margin-top:-8px;">  <ul>    <li>49 lakh customers serviced to get &nbsp;best  Loan deals with deal4loans. Deal4loans views  Published @ yourstory .com </li>    <li> As RBI cuts rate, should you go for fixed home loan Deal4loans views Published @ Economic Times online </li>  </ul></div></td><td width="25%" align="center" valign="top"><input type="submit" style="border: 0px none ; background-image: url(images/get-quote-greenish-btn.png); width: 102px; height: 41px; margin-bottom: 0px;" value="" onClick="ga(\'send\', \'event\', \'Get Quote\', \'Get Quote Home\');"/></td></tr></table></div>                    <div style="clear:both;"></div>                   <div id="hdfclife"></div>                    <div style="clear:both;"></div>';
	ni5.innerHTML = '<img src="images/animated_hl.gif" width="575" height="21" />';
}	
</script>
<link href="source.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size:11px;}
.style3 {font-size: 11px; font-weight: bold; }
-->
</style>
<link href="css/cont_calc.css" rel="stylesheet" type="text/css" />
</head>
<body style='font-family: "Droid Sans",sans-serif;'>
<?php include "middle-menu.php"; ?>
<script type="text/javascript">
function processtogetHl()
{
	var nitxt1 = document.getElementById('sectnwise_TXTDiv');
	nitxt1.innerHTML ='<div class="form-head-text-white">Get Eligibility Quote from 5 PSU and 7 Private Banks </div>';
	var ni1 = document.getElementById('Hl_mainDiv');
	ni1.innerHTML ='<div style="width:100%;" id="HL_processDIV">    <div class="body-text-new-h2"><a name="Process-get-Home-Loan"><strong>Home Loan –</strong> Lets us Explain how this will go about and what are the Steps</a></div>      <p><span class="body-text-new-hl" style="color:#4c4c4c; ">The first step involved in the process is to find your property which is followed by the verification of property documents, post that the documents are examined &amp; simultaneously you can start searching for the lender who can offer the BEST Home Loan Deal after checking your eligibility criteria.<br />        <br />        <strong>Know the Home Loan Eligibility:</strong> Banks offer the loan amount based on your Income and the property value .They will give you max amount  in which your emi of Home loan and others loans  is  50-60% of your income.<br />        Other factor is that value of property.<br />        <br />        <strong>Select the Best Home Loan after evaluation:</strong> Comparing home loan interest rates is the primary feature in the home loan selection, however other fees &amp; charges like Application fees, processing fees, legal charges should not be neglected when comparing various loan offers. To check the interest rates &amp; other charges incurred by various banks, Deal4Loans has brought in a Home Loan Comparison Chart across various Banks.Banks offer Fixed and Floating rates in Home loans.<br />        <br />        <strong>Most customers choose Floating rates</strong><br />      </span></p>      <p><span class="body-text-new-hl" style="color:#4c4c4c; "><strong>Applying for the Loan :</strong> After you have selected your lender, you have to fill in the application form wherein the lender requires complete information about your financial assets &amp; liabilities; other personal &amp; professional details together with the property details &amp; its costs.<br />        <strong><br />        Documentation &amp; Verification Process: </strong>You are required to submit the necessary documents to the bank which will be verified together with the details in the application.<br />        <br />        <strong>Credit &amp; default check:</strong> Bank checks out the borrower&rsquo;s loan eligibility (through repayment capacity) &amp; the amount of loan is confirmed. The borrower&rsquo;s repayment capacity is reached which is based on the income, salary, age, experience &amp; nature of business etc. Bank also checks credit history through the Cibil Score which plays a critical role in deciding &amp; approving your loan application. Low Credit Score implies that the bank upfront rejects your application on the basis of earlier credit defaults; on the other hand high credit score gives a green signal to your application.<br /> <strong><br />        Bank sanctions Loan &amp; Offer letter to the borrower:</strong> After the credit appraisal of the borrower bank decides the final amount &amp; sanctions the loan, the bank further sends an offer letter to the borrower which constitutes the details like rate of interest, loan tenure &amp; repayment options etc.<br />        <br />        <strong>Acceptance Copy to the Bank: </strong>The borrower needs to send an acceptance copy to the bank after the borrower agrees with the terms &amp; conditions in the offer letter.<br />      </span></p>      <p><span class="body-text-new-hl" style="color:#4c4c4c; "><strong>Bank checks the legal documents:</strong> The bank further asks the legal documents of property from the borrower to check its authenticity so as to keep them as a security for the loan amount given. The next step involved is the valuation of the property by the bank which determines the loan amount sanctioned by the bank. <br />        <br /><strong>Signing of agreement &amp; the loan disbursal: </strong>The borrower signs the loan agreement &amp; the bank disburses the loan amount.<br /><br />        <div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;">Documents required in Home Loan</h3></div><div class="body-text-new-hl" style="color:#4c4c4c; ">Generally the documents required to processing your loan application are almost similar across all the banks; however they may differ with various banks depending upon specific requirement etc. Following documents are required by financial institutions to process the loan application:<ul style="margin-left:35px; margin-top:10px;"><li>Income</li><li>Age Proof</li><li>Address Proof</li><li>Income Proof of the applicant & co-applicant</li><li>Last 6 months bank A/C statement</li><li>Passport size photograph of the applicant & co-applicant</li></ul><div style="clear:both;"></div><div class="hl-newform-wrapper-new" style="margin-top:15px;">  <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bfbfbf">  <tr>    <td scope="row"><table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <td width="484" height="40"  align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>In case of Salaried</strong></td>    <td width="453" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>In case of Self-employed</strong></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Employment certificate from the employer, </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of audited financial statements for the last 2 years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Copies of pay slips for last few months and TDS certificate </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of partnership deed if it is a partnership firm or copy of memorandum of association and articles of association if it is a company </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td rowspan="2" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Latest Form 16 issued by employer Bank statements</span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Profit and loss account for the last few years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" >Income tax assessment order</td>  </tr>    </table></td>  </tr></table></div></div>      </div><br>';
}

function bestIrHl()
{
	var d = new Date();
var n = d.getDate(); 
var m= d.getMonth();
var y= d.getFullYear();
var month;
if(m==0) {month="January ";} else if(m==1) {month="February";} else if(m==2) {month="March";} else if(m==3) {month="April";} else if(m==4) {month="May";} else if(m==5) {month="June";} else if(m==6) {month="July";} else if(m==7) {month="August";} else if(m==8) {month="September";} else if(m==9) {month="October";} else if(m==10) {month="November";} else if(m==11) {month="December";}
var dt= n + " " + month+ " " + y;

	var nitxt2 = document.getElementById('sectnwise_TXTDiv');
	nitxt2.innerHTML ='<div class="form-head-text-white">Get Interest Rates of 10 Banks - Apply Online with Lowest</div>';
	var ni2 = document.getElementById('Hl_mainDiv');
	    ni2.innerHTML ='<div id="Hl_InterRateDIV"><div class="body-text-new-h2"><a name="Best-Bank"><strong>Interest Rates of Banks</strong></a></div>(Last updated on ' + dt + ')<div style="clear:both;"></div>   <div class="hl-newform-wrapper-new">  <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bfbfbf">  <tr>    <td scope="row"><table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <td width="166" height="40"  align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Banks</strong></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Loan    to Property Value</strong></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Interest Rates</strong></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Apply</strong></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">State Bank of India (SBI)</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -90%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">9.95% - 10.10%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/sbi-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'SBI Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">HDFC Ltd</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -80%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">9.90%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'HDFC Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">LIC Housing Finance</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -80%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">10.15% (Fixed for 2 Years)</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/lic-housing-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'LIC Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Axis Bank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% - 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">10.15% - 11.75%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/home-loan-axis-bank.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'Axis Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">ICICI Bank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">Upto 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" >10.10% - 11.25%</td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/icici-hfc-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'ICICI Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Fedbank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">Upto 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">10.35% - 10.70%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'Fedbank Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">PNB Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 11.00%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'PNB Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">PNB Housing Finance</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15% - 11.75%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'PNBHF Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">IDBI Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 11.00%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'IDBI Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">ING Vysya Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.75% - 11.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'Misc. Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">DHFL Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >80% - 85%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Indiabulls Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15% (Upto 25Lacs), then 11%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Allahabad Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 10.50%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Bank of India Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 85%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.20% - 10.45%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Union Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >65% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">United Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 10.50%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Uco Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.20%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Bank of Baroda Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Kotak Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >up to 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Vijaya Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >Upto 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.30%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Standard Chart Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >Upto 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Indian Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >80% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 12.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>    </table></td>  </tr></table></div></div><br><br>';
}
function hleligibility()
{
	var nitxt3 = document.getElementById('sectnwise_TXTDiv');
	nitxt3.innerHTML ='<div class="form-head-text-white">Get Eligibility Quote from 5 PSU and 7 Private Banks and Apply Online</div>';
var ni3 = document.getElementById('Hl_mainDiv');
	    ni3.innerHTML ='<div id="Hl_eligibilityDIV"><div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;"><div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;"><a name="Hl2">How is my Home loan Eligibility Calculated</a></h3></div><div class="body-text-new-hl">  The borrower eligibility of getting a housing loan depend upon his/her repayment capacity & the banks establish this repayment capacity by considering various factors such income, spouse&rsquo;s income, age, number of dependants qualifications , assets, liabilities, stability and continuity of occupation and savings history. Eligibility Factors in Housing loan Your Home Loan eligibility is determined by your repayment capacity and the value of the Property <br /><ul style="margin-left:35px; margin-top:10px;"><li>Income</li><li>Qualifications</li><li>Age</li><li>Spouse&rsquo;s income</li><li> No. of dependants</li><li>Stability and continuity of occupation</li><li>Assets/LiabilitiesM.</li><li>Savings history.</li></ul><br /><br />The most important concern of banks in determining your loan eligibility is that whether or not you are contentedly able to pay off the amount you borrow.<br /><br />The Second factor is the value of the Property<br /><br />Banks are okay to fund 75-85% of property value but with the condition that you have income capacity that you can pay its Emi each month.                      <br /><br />   </div></div>       </div>';
}

function Hlnoworwait()
{
	var nitxt4 = document.getElementById('sectnwise_TXTDiv');
	nitxt4.innerHTML ='<div class="form-head-text-white">Quick Apply and Get Instant Quotes from 5 PSU and 7 Private Banks.</div>';
	var ni4 = document.getElementById('Hl_mainDiv');
	    ni4.innerHTML ='<div id="HlnownwaitDIV"> <div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;"><div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;"> <a name="Home-Loan-Now-n-Wait">Should I take Home loan now or wait ?</a></h3></div><div class="body-text-new-hl">Home loan is a long term loan and is taken by customers on floating rates .Rates keep changing and timing on 20 year loan is impossible.<br>The Home loan rates will change in 20 years so thinking to start a loan at a lower rate has no relevance.<br>The right time to take a Home loan is when:<ul style="margin-left:35px; margin-top:10px;"><li>The Property you intend to buy is good and cannot be missed or it is expected that the price of property will rise.</li><li>The Emi that you have to pay per month is above your monthly expense budgets etc.</li></ul><br><strong>Jan 2015- Home loan Trend</strong><br><br><ul style="margin-left:35px; margin-top:10px;"><li>Rbi has reduced rates and some Banks have already announced  rate cuts.</li><li>The Home loan rates will come to single digits in times to come.</li><li>Expect rates to come down further after March 2015, when the flow of funds is better in Banks.</li><li>We expect Home loans to stay under 10% for most part of 2015.</li><li>Rates can hit as low as 9% if RBI pushes for it.</li></ul><br></div> </div></div>';
}
</script>
<div style="clear:both;"></div>
<div  class="pl_sbi_wrapper">
<div style="clear:both;"></div>
<div class="row-hl-new-main-wrapper">
<div style="margin:auto; width:100%; height:11px; margin-top:70px; color:#0a8bd9;">
<u><a href="http://www.deal4loans.com/" class="text12" style="color:#0080d6;">Home</a></u> > Home Loan</div>
<div>
	<h1 class="home-loan-new-head">HOME LOAN</h1>
</div>
<div class="body-text-new-hl">
<strong style="font-size:20px;">For your  home loan journey- Helping you to know Eligibility,Rates, process, necessary documents list, EMI comparison and transfer for lowest rates.</strong><br /><br />
Home loan is one of the biggest financial decision in our lives.Before you choose your Bank get information on current interest rates from all Banks. Get to know how much each bank can give you i.e. Eligibility from Govt Banks and Private Banks.Fixed rate or Floating rate /Prepay or Balance transfer we try to make your journey simple by giving your unbiased information.To find the lender for 20 years term go through the fine print and save for years to come.A perfect Home loan is loan which gives you lowest rates throughout the tenure, has part payment options and allows you to balance transfer if you wish to <br /><br />
<i>State Bank of India cuts its base rate by 15 basis points from 10% to 9.85%. HDFC Bank lowered its base rate by 15 bps to 9.85%, while ICICI Bank cut it by 25 bps to 9.75%, the lowest in the industry now. <br />

SBI's new base rate is effective from April 10, while HDFC Bank's will come into effect from April 13. ICICI Bank said its existing floating rate customers will get the benefit of the new rate from April 10, while new borrowers will get it from July 1, 2015</i>
<br />

</div>
<div style="clear:both;"></div>
<div class="home-loan-inner_box">
<div class="best-bank-ico-bx">
<div class="best-bank-ico-bx2"> <a onClick="bestIrHl(); ga('send', 'event', 'best bank', 'HL Best bank Button');"  style="cursor:pointer;" href="#Best-Bank"><img src="images/which-is-best-bank-ico.jpg" width="60" height="60" border="0" alt="Which is Best Bank with Lowest Rates ?
" /></a> </div>

<div class="text-below-icon">
  <a onClick="bestIrHl(); ga('send', 'event', 'Best bank', 'HL best bank Button');"  style="cursor:pointer;" href="#Best-Bank">Which is Best Bank <br /> with Lowest Rates ?</a> </div>
</div>
<div class="best-bank-ico-bx-right">
<div class="best-bank-ico-bx2"><a onclick="hleligibility(); ga('send', 'event', 'Hl2', 'Hl2 Button');" style="cursor:pointer;" href="#Hl2"><img src="images/need-how-much-loan.jpg" width="60" height="60" border="0" /></a></div>
<div class="text-below-icon">
  <a onclick="hleligibility(); ga('send', 'event', 'Hl2', 'Hl2 Button');" style="cursor:pointer;" href="#Hl2">I need to know How much Home loan I can get ?</a>
</div></div>
<div style="clear:both;"></div>
<div class="best-bank-ico-bx3">
  <div class="best-bank-ico-bx2"><a onclick="Hlnoworwait(); ga('send', 'event', 'Hl Now or wait', 'HL Hl Now or wait Button');" style="cursor:pointer;" href="#Home-Loan-Now-n-Wait"><img src="images/take-hl-wait.jpg" width="60" height="60" /></a></div>
    <div class="text-below-icon">
  <a onclick="Hlnoworwait(); ga('send', 'event', 'Hl Now or wait', 'HL Now or wait Button');" style="cursor:pointer;" href="#Home-Loan-Now-n-Wait">Should I take Home Loan now or wait ?</a>
</div>
</div>
<div class="best-bank-ico-bx-right2">
<div class="best-bank-ico-bx2"><a onclick="processtogetHl(); ga('send', 'event', 'Hl Process', 'Hl Process Button');" style="cursor:pointer;" href="#Process-get-Home-Loan"><img src="images/what-process.jpg" width="60" height="60" border="0" /></a></div>
<div class="text-below-icon">
  <a onclick="processtogetHl(); ga('send', 'event', 'Hl Process', 'Hl Process Button');" style="cursor:pointer;" href="#Process-get-Home-Loan">What is a process to <br />
  get Home loan ?</a>
</div></div>
<div style="clear:both;"></div>
<div class="best-bank-ico-bx4">
<div class="best-bank-ico-bx2"><a href="http://www.deal4loans.com/home-loan-balance-transfer-calculator.php" target="_blank"><img src="images/transfer-loan.jpg" width="60" height="60" border="0" /></a></div>
<div class="text-below-icon">
  <a href="http://www.deal4loans.com/home-loan-balance-transfer-calculator.php" target="_blank">I need to transfer my Existing Home loan to a Cheaper Rate ?</a>
</div>
</div>
</div> 
<div id="PutForm_Here">
<strong>Home Loan applications received for <img src="images/rupees.gif" /><? 
$result1 = ExecQuery("SELECT sum( `Amount` ) AS ttlcnt FROM `totalLoans` WHERE ( Name ='HL' )");
$row1 = mysql_fetch_array($result1);
$fVal = substr(trim($row1['ttlcnt']), 0, strlen(trim($row1['ttlcnt']))-7);
echo $plVal = number_format($fVal)." crores"; ?> till <? echo date('d F Y');?>
        </strong><br><br>
</div>
<div style="clear:both;"></div>
<div class="form-wrapper-main">
 <form name="loan_form" method="post" action="apply-home-loanscontinue1.php" onSubmit="return chkform();">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<div id="sectnwise_TXTDiv">
  <div class="form-head-text-white">Get Instant Eligibility  Quotes on Home Loans from Top 10 Banks Online for Apply Online</div></div>
<div style="clear:both;"></div>
<div id="addPadding"><img src="http://www.deal4loans.com/images/spacer.gif" style="height:10px;" ></div>
<div style="clear:both;"></div>
<div style="padding-left:10px; padding-bottom:5px; font-size:19px; color:#FFFFFF;">
Professional Details
</div>
<div style="clear:both;"></div>
<div class="input-hanger-new">
<div class="textinput-new111">Loan Amount</div>
<div class="input-symbol-box"><img src="images/rupee-inputbg.png" width="23" height="37" border="0" /></div>
<div class="input-symbol-box2"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="input-row-newst" onkeydown="validateDiv('loanAmtVal');" /></div>
<div id="loanAmtVal"></div><span id='formatedlA' style='font-size:11px;font-weight:normal; color:#ffffff;'></span><span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#ffffff;text-transform: capitalize;'></span>
</div>
  
<div class="input-hanger-new">
<div class="textinput-new111">Occupation</div>
  <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"   class="select-row-newst" tabindex="8" >
                           <option value="-1">Select Occupation</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
          </select>
                       <div id="empStatusVal"></div>
</div>
<div class="input-hanger-new">
<div class="textinput-new111">Annual Income</div>
<div class="input-symbol-box"><img src="images/rupee-inputbg.png" width="23" height="37" border="0" /></div>
<div class="input-symbol-box2"><input type="text" name="Net_Salary" id="Net_Salary" class="input-row-newst" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome', 'wordIncome');" onkeypress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"  /></div>
<div id="netSalaryVal"></div>   <span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#ffffff;'></span> <span id='wordIncome' style='font-size:11px;font-weight:normal; color:#ffffff;text-transform: capitalize;'></span>   
</div>
<div class="input-hanger-new">
<div class="textinput-new111">City</div>
<select name="City" id="City" class="select-row-newst" onchange=" addPersonalDetails(); addhdfclife(); cityother(); validateDiv('cityVal');" tabindex="7"><?=getCityList($City)?></select><div id="cityVal"></div>

</div>
<div style="clear:both;"></div>

<div id="personalDetails">
 <table cellpadding="0" width="98%">
 <tr><td width="75%"  height="10">&nbsp;</td>
 </tr>
 <tr>
<td style="padding-left:25px;">		 
<div class="quote-text"><strong style="background:#e29500; font-size:25px; font-weight:normal;">54</strong>  ,<strong style="background:#043eac; font-size:25px; font-weight:normal;">02 </strong>,  <strong style="background:#44cbbe; font-size:25px; font-weight:normal;">013</strong> Loan quotes taken till now</div>
<div style="clear:both; height:25px;"></div>
<div  style=" color:#fff; font-size:12px; text-transform:capitalize; padding-left:5px; margin-top:-8px;">
  <ul>
    <li>54 lakh customers serviced to get &nbsp;best  Loan deals with deal4loans. Deal4loans views  Published @ yourstory .com </li>
    <li> As RBI cuts rate, should you go for fixed home loan Deal4loans views Published @ Economic Times online </li>
  </ul>
</div></td><td width="25%"   align="right" valign="top"><img src="images/get-quote-greenish-btn.png" width="102" height="41" /></td>
</tr>
 <tr><td  height="15">&nbsp;</td></tr>
</table>

     </div>
                  <div style="clear:both;"></div>
                        <div style="display:none; " id="divfaq1">
   <div class="input-hanger-new">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Co-applicant Name:</span></td>
       </tr>
       <tr>
         <td><input name="co_name" id="co_name" type="text" class="input-row-newst2" /></td>
       </tr>
     </table>
   </div>
   
   <div class="input-hanger-new">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Co-applicant DOB:</span></td>
       </tr>
       <tr>
         <td><input name="co_day" id="co_day" type="text" class="input-row-dd" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"/>
         <input name="co_month" id="co_month" type="text" class="input-row-dd" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
         <input name="co_year" id="co_year" type="text" class="input-row-dd" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />   <div id="co_dobVal"></div></td>
       </tr>
     </table>
   </div>
   
   <div class="input-hanger-new">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Gross Annual Salary:</span></td>
       </tr>
       <tr>
         <td>  <input type="text" name="co_monthly_income" id="co_monthly_income"  class="input-row-newst2"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" /></td>
       </tr>
     </table>
   </div>
   <div class="pl_input_box">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Monthly EMIs :</span></td>
       </tr>
       <tr>
         <td>  <input name="co_obligations" id="co_obligations" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this);" type="text" class="input-row-newst2" /></td>
       </tr>
     </table>
   </div></div>
     <div id="addSubmit">
     </div>
      </form>
	  <div style="clear:both;height:20px;"></div>
    </div>

<div id="Hl_mainDiv">
 <div id="HlnownwaitDIV">
 <div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;"><div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;"> Should I take Home loan now or wait ?</h3></div>
<div class="body-text-new-hl">
Home loan is a long term loan and is taken by customers on floating rates .Rates keep changing and timing on 20 year loan is impossible.<br>
The Home loan rates will change in 20 years so thinking to start a loan at a lower rate has no relevance.
<br>
The right time to take a Home loan is when:
<ul style="margin-left:35px; margin-top:10px;">
<li>The Property you intend to buy is good and cannot be missed or it is expected that the price of property will rise.</li>
<li>The Emi that you have to pay per month is above your monthly expense budgets etc.</li></ul>
<br>
<strong>Latest Updates on Home Loan:</strong><br>
<br>
<ul style="margin-left:35px; margin-top:10px;">
<li>Union Bank & United Bank Offers home loans at 10.00% rate of interest.</li>
<li>Expect other banks may cut in rates, when the flow of funds is better in Banks.</li>
<li>We expect Home loans to stay under 10% for most part of 2015.</li>
<li>Rates can hit as low as 9% if RBI pushes for it.</li>
</ul>
<br>
</div>
 </div>
</div><!----section I R--->
<div id="Hl_InterRateDIV"><div style=" width:100%; height:auto; margin-top:5px; text-align:justify;"><span  style="color:#4c4c4c; size:18px;"><h3 style="font-weight:normal; color: #000; font-size:18px; padding-top:5px; padding-bottom:5px;" class="text">Most borrowed home loans</h3></span></div>(Last updated on <?php echo date('d F Y'); ?>)<div style="clear:both;"></div>   <div class="hl-newform-wrapper-new">  <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bfbfbf">  <tr>    <td scope="row"><table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <td width="166" height="40"  align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Banks</strong></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Loan    to Property Value</strong></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Interest Rates</strong></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>Apply</strong></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">State Bank of India (SBI)</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -90%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">9.95% - 10.10%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/sbi-home-loan.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">HDFC Ltd</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -80%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">9.90%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php" target="_blank" onClick="ga('send', 'event', 'Apply Button', 'LIC Apply Button');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">LIC Housing Finance</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF"><span class="th-new2-text">75% -80%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">10.15% (Fixed for 2 Years)</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/lic-housing-home-loan.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Axis Bank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% - 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">10.15% - 11.75%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/home-loan-axis-bank.php" target="_blank" onClick="ga('send', 'event', 'Apply Button', 'Axis Apply Button');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">ICICI Bank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">Upto 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" >10.10% - 11.25%</td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/icici-hfc-home-loan.php" target="_blank" onClick="ga('send', 'event', 'Apply Button', 'ICICI Apply Button');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Fedbank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">Upto 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">10.35% - 10.70%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga('send', 'event', 'Apply Button', 'Fedbank Apply Button');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">PNB Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 11.00%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga('send', 'event', 'Apply Button', 'PNB Apply Button');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">PNB Housing Finance</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15% - 11.75%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga('send', 'event', 'Apply Button', 'PNBHF Apply Button');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">IDBI Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 11.00%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga('send', 'event', 'Apply Button', 'IDBI Apply Button');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">ING Vysya Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.75% - 11.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">DHFL Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >80% - 85%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Indiabulls Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15% (Upto 25Lacs), then 11%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Allahabad Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 10.50%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Bank of India Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 85%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.20% - 10.45%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Union Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >65% - 80%</td>    
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.00%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">United Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    
<td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.00% - 10.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Uco Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.20%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Bank of Baroda Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Kotak Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >up to 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Vijaya Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >Upto 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.30%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Standard Chart Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >Upto 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Indian Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >80% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 12.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>    </table></td>  </tr></table></div></div><br><br>
<!-----Section IR--->
<!----Section Process---->
<div style="width:100%;" id="HL_processDIV">    <div class="body-text-new-h2"><strong>Home Loan –</strong> Lets us Explain how this will go about and what are the Steps</div>      <p><span class="body-text-new-hl" style="color:#4c4c4c; ">The first step involved in the process is to find your property which is followed by the verification of property documents, post that the documents are examined &amp; simultaneously you can start searching for the lender who can offer the BEST Home Loan Deal after checking your eligibility criteria.<br />        <br />        <strong>Know the Home Loan Eligibility:</strong> Banks offer the loan amount based on your Income and the property value .They will give you max amount  in which your emi of Home loan and others loans  is  50-60% of your income.<br />        Other factor is that value of property.<br />        <br />        <strong>Select the Best Home Loan after evaluation:</strong> Comparing home loan interest rates is the primary feature in the home loan selection, however other fees &amp; charges like Application fees, processing fees, legal charges should not be neglected when comparing various loan offers. To check the interest rates &amp; other charges incurred by various banks, Deal4Loans has brought in a Home Loan Comparison Chart across various Banks.Banks offer Fixed and Floating rates in Home loans.<br />        <br />        <strong>Most customers choose Floating rates</strong><br />      </span></p>      <p><span class="body-text-new-hl" style="color:#4c4c4c; "><strong>Applying for the Loan :</strong> After you have selected your lender, you have to fill in the application form wherein the lender requires complete information about your financial assets &amp; liabilities; other personal &amp; professional details together with the property details &amp; its costs.<br />        <strong><br />        Documentation &amp; Verification Process: </strong>You are required to submit the necessary documents to the bank which will be verified together with the details in the application.<br />        <br />        <strong>Credit &amp; default check:</strong> Bank checks out the borrower’s loan eligibility (through repayment capacity) &amp; the amount of loan is confirmed. The borrower’s repayment capacity is reached which is based on the income, salary, age, experience &amp; nature of business etc. Bank also checks credit history through the Cibil Score which plays a critical role in deciding &amp; approving your loan application. Low Credit Score implies that the bank upfront rejects your application on the basis of earlier credit defaults; on the other hand high credit score gives a green signal to your application.<br /> <strong><br />        Bank sanctions Loan &amp; Offer letter to the borrower:</strong> After the credit appraisal of the borrower bank decides the final amount &amp; sanctions the loan, the bank further sends an offer letter to the borrower which constitutes the details like rate of interest, loan tenure &amp; repayment options etc.<br />        <br />        <strong>Acceptance Copy to the Bank: </strong>The borrower needs to send an acceptance copy to the bank after the borrower agrees with the terms &amp; conditions in the offer letter.<br />      </span></p>      <p><span class="body-text-new-hl" style="color:#4c4c4c; "><strong>Bank checks the legal documents:</strong> The bank further asks the legal documents of property from the borrower to check its authenticity so as to keep them as a security for the loan amount given. The next step involved is the valuation of the property by the bank which determines the loan amount sanctioned by the bank. <br />        <br />        <strong>Signing of agreement &amp; the loan disbursal: </strong>The borrower signs the loan agreement &amp; the bank disburses the loan amount.<br /><br />        <div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;">Documents required in Home Loan</h3></div><div class="body-text-new-hl" style="color:#4c4c4c; ">Generally the documents required to processing your loan application are almost similar across all the banks; however they may differ with various banks depending upon specific requirement etc. Following documents are required by financial institutions to process the loan application:<ul style="margin-left:35px; margin-top:10px;"><li>Income</li><li>Age Proof</li><li>Address Proof</li><li>Income Proof of the applicant & co-applicant</li><li>Last 6 months bank A/C statement</li><li>Passport size photograph of the applicant & co-applicant</li></ul><div style="clear:both;"></div><div class="hl-newform-wrapper-new" style="margin-top:15px;">  <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bfbfbf">  <tr>    <td scope="row"><table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <td width="484" height="40"  align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>In case of Salaried</strong></td>    <td width="453" height="40" align="center" bgcolor="#FFFFFF" class="th-new-text" ><strong>In case of Self-employed</strong></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Employment certificate from the employer, </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of audited financial statements for the last 2 years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Copies of pay slips for last few months and TDS certificate </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of partnership deed if it is a partnership firm or copy of memorandum of association and articles of association if it is a company </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td rowspan="2" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Latest Form 16 issued by employer Bank statements</span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Profit and loss account for the last few years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" >Income tax assessment order</td>  </tr>    </table></td>  </tr></table></div></div>      </div><br>

<!---Section Process------------->

<!-----------Section Eligibility------------------>
<div id="Hl_eligibilityDIV"><div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;"><div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;">How is my Home loan Eligibility Calculated</h3></div><div class="body-text-new-hl">  The borrower's eligibility of getting a housing loan depend upon his/her repayment capacity & the banks establish this repayment capacity by considering various factors such income, spouse&rsquo;s income, age, number of dependants qualifications , assets, liabilities, stability and continuity of occupation and savings history. Eligibility Factors in Housing loan Your Home Loan eligibility is determined by your repayment capacity and the value of the Property <br /><ul style="margin-left:35px; margin-top:10px;"><li>Income</li><li>Qualifications</li><li>Age</li><li>Spouse&rsquo;s income</li><li> No. of dependants</li><li>Stability and continuity of occupation</li><li>Assets/LiabilitiesM.</li><li>Savings history.</li></ul><br /><br />The most important concern of banks in determining your loan eligibility is that whether or not you are contentedly able to pay off the amount you borrow.<br /><br />The Second factor is the value of the Property<br /><br />Banks are okay to fund 75-85% of property value but with the condition that you have income capacity that you can pay its Emi each month.                      <br /><br />   </div></div>       </div>
<!--------------Section Eligibility-------------->

</div>


 </div>
</div>
</div><div style="clear:both;"> </div>
<a href="#0" class="cd-top">Top</a>
<div style="clear: both;"></div>
</div> 
<?php include("footer_sub_menu.php"); ?>
<!-- javascript for top to jump starts -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/main.js"></script>
<!-- javascript for top to jump ends -->
</body>
</html>