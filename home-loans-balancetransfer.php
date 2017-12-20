<?php 
session_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
$openTabHL = ''; $openTabBalT = ''; $hideBalT = ''; $hideHL = '';
$tab=$_REQUEST["tab"];
if(strlen($_SESSION['sources'])>0)
{
	$sourceS = $_SESSION['sources'];
}
{
	$_SESSION['sources'] = $_REQUEST['source'];
	$sourceS = $_SESSION['sources'];

}
	if(strlen($sourceS)>0) 
	{
		$retrivesource = trim($sourceS); 
		if($retrivesource=="home-loan-btapply" || $tab=="applyHL")
		{
		//source=home-loan-btapply
			$openTabHL = 'class="current"';
			$openTabBalT = '';
			$hideHL = '';
			$hideBalT = 'class="hide"';
		}		
		else
		{
			//source=home-loan-bt
			$openTabBalT = 'class="current"';
			$hideBalT = '';
			$hideHL = 'class="hide"';
			$openTabHL = '';
		}	
	}
	else {	$retrivesource="hom-loans-baltrans"; $openTabBalT = 'class="current"';}

$maxage=date('Y')-62;
$minage=date('Y')-18;
//echo "openTabHL - ".$openTabHL; 
//echo "<br>";
//echo $retrivesource;
//echo "hideHL ".$hideHL;
//echo "<br>";
//echo "openTabBalT ".$openTabBalT;
//echo "<br>";
//echo "hideBalT - ".$hideBalT; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan</title>
<link href="home-loan-window-theme-lp-styles.css" rel="stylesheet" type="text/css" />
<link href="css/tabs_styles.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
	<script src="organictabs.jquery.js"></script>
    <script>
		$(function(){
		// Calling the plugin
			$("#example-one").organicTabs();
			$("#example-two").organicTabs({
				"speed": 100,
				"param": "tab"
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
	
	if(Form.loan_amount.value=="")
	{
		document.getElementById('blloanAmountVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		Form.loan_amount.focus();
		return false;
	}
	if(Form.roi.value=="")
	{
		document.getElementById('blroiVal').innerHTML = "<span  class='hintanchor'>Rate of Interest!</span>";	
		Form.roi.focus();
		return false;
	}
	if (Form.Existing_Bank.value=="")
	{
		document.getElementById('blexistBankVal').innerHTML = "<span  class='hintanchor'>Enter Existing Bank!</span>";	
		Form.Existing_Bank.focus();
		return false;
	}	
	if(Form.emi_paid.value=="")
	{
		document.getElementById('blemiPaidVal').innerHTML = "<span  class='hintanchor'>Enter Emi in Months!</span>";	
		Form.emi_paid.focus();
		return false;
	}

	if(Form.tenure.selectedIndex==0)
	{
		document.getElementById('bltenureVal').innerHTML = "<span  class='hintanchor'>Select Tenure!</span>";	
		Form.tenure.focus();
		return false;
	}
	
	if((Form.Name.value==""))
	{
		document.getElementById('blnameVal').innerHTML = "<span  class='hintanchor'>Fill Your Full Name!</span>";	
		Form.Name.focus();
		return false;
	}
	
	
	if (Form.Phone.value=="")
	{
		document.getElementById('blphoneVal').innerHTML = "<span  class='hintanchor'>Fill Your Mobile Number!</span>";	
		Form.Phone.focus();
		return false;
	}
	

	if(Form.Email.value=="")
	{
		document.getElementById('blemailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('blemailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('blemailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.Email.focus();
		return false;
	}
	if (Form.City.selectedIndex==0)
	{
		document.getElementById('blcityVal').innerHTML = "<span  class='hintanchor'>Fill Your City!</span>";	
		Form.City.focus();
		return false;
	}
	if(Form.pre_payment_charges.value=="")
	{
		document.getElementById('blprepaymentVal').innerHTML = "<span  class='hintanchor'>Enter Pre-Payment Charges!</span>";	
		Form.pre_payment_charges.focus();
		return false;
	}

	if(!Form.accept.checked)
	{
		document.getElementById('blacceptVal').innerHTML = "<span  class='hintanchor'>Accept the Terms and Condition !</span>";	
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

function chkform()
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
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	
	if(document.loan_form.Phone.value=="")
	{		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";		document.loan_form.Phone.focus();		return false;	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";		document.loan_form.Phone.focus();		return false;  	}
	if (document.loan_form.Phone.value.length < 10 )
	{	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";			document.loan_form.Phone.focus();		return false;	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";			document.loan_form.Phone.focus();		return false;	}

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
	
	for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property identified or not!</span>";	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.loan_form.Property_Loc.selectedIndex==0)
		{
			document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property Location!</span>";	
			document.loan_form.Property_Loc.focus();
			return false;
		}
	}
	if(!document.loan_form.accept.checked)
	
	{		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";				document.loan_form.accept.focus();		return false;	}	
}  
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }

function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = ' <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr><td height="35" align="left" valign="middle" class="form_body" width="40%">Property Identified</td>      <td height="35" width="60%" class="form_body"><select name="Property_loc" id="Property_loc" class="select" onchange="validateDiv(\'propEditifiedVal\')"><?=getCityList1($City)?></select><div id="propEditifiedVal"></div></td></tr></table>';								
	 return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';
				
		return true;

}	


function addPersonalDetailsBT()
{
	var ni1 = document.getElementById('personalDetailsBT');
	
		ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td colspan="2" class="text-a">Personal Details</td></tr><tr><td colspan="2"  class="form_body" style="font-size:11px; font-weight:normal;" ><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr><tr><td width="40%" height="35" align="left" valign="middle" class="form_body">Full Name</td><td width="60%" height="35"><input name="Name" id="Name" type="text" class="input" onkeydown="validateDiv(\'blnameVal\');"  tabindex="6" />   <div id="blnameVal"></div>      </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">Mobile Number</td><td height="35" class="form_body">+91 <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" type="text" class="mobile" onkeydown="validateDiv(\'blphoneVal\');" tabindex="7"   /><div id="blphoneVal"></div>  </td></tr> <tr><td height="35" align="left" valign="middle" class="form_body">Email ID</td><td height="35"><input name="Email" id="Email" type="text"  class="input" onkeydown="validateDiv(\'blemailVal\');"  tabindex="8" />          <div id="blemailVal"></div>   </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">City</td><td height="35"><select name="City" id="City" class="select" onchange="validateDiv(\'blcityVal\');" tabindex="9"><?=plgetCityList($City)?></select><div id="blcityVal"></div>     </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">Pre Payment Charges</td><td height="35"><input type="text" name="pre_payment_charges" id="pre_payment_charges" class="input"  onkeydown="validateDiv(\'blprepaymentVal\'); intOnly(this);" onkeyup="intOnly(this);" tabindex="10" /><div id="blprepaymentVal"></div></td></tr><tr><td height="35" colspan="2" valign="middle" class="form_body" style="font-size:11px;"><table width="98%" border="0" cellspacing="0" cellpadding="0"><tr><td width="4%"><span class="form_body" style="font-size:11px;"><input name="accept" type="checkbox" checked="checked" tabindex="11" onclick="validateDiv(\'blacceptVal\')" /></span><div id="blacceptVal"></div> </td><td width="96%"><span class="form_body" style="font-size:10px; font-weight:normal;">I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to <a href="http://www.deal4loans.com/Privacy.php" style="color:#FFF;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" style="color:#FFF;">Terms &amp; Conditions</a>.</span></td></tr></table></td></tr><tr><td height="55" colspan="2" align="center" class="form_body"><input type="submit" style="border: 0px none ; background-image: url(images/calulate-btn-window.jpg); width:259px; height:40px; margin-bottom: 0px;" value="" tabindex="12"/></td></tr></table>';

}


function addPersonalDetailsHL()
{
	var ni1 = document.getElementById('personalDetailsHL');
	
	
	ni1.innerHTML = '<div class="table-new"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td colspan="2" class="text-a">Personal Details</td></tr><tr><td colspan="2"  class="form_body" style="font-size:11px; font-weight:normal;" ><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr><tr><td  height="35" align="left" valign="middle" class="form_body">Full Name</td><td height="35"><input name="Name" id="Name" type="text" class="input" onkeydown="validateDiv(\'nameVal\');"  tabindex="5" />   <div id="nameVal"></div>      </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">Mobile Number</td><td height="35" class="form_body">+91 <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" type="text" class="mobile" onkeydown="validateDiv(\'phoneVal\');" tabindex="6"  /><div id="phoneVal"></div>  </td></tr> <tr><td height="35" align="left" valign="middle" class="form_body">Email ID</td><td height="35"><input name="Email" id="Email" type="text"  class="input" onkeydown="validateDiv(\'emailVal\');" tabindex="7" />          <div id="emailVal"></div>   </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">DOB</td><td height="35"><input name="day" id="day" type="text" class="dd" value="dd" tabindex="8" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" />        <input name="month" id="month" type="text" class="dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" tabindex="9" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" />  <input name="year" id="year" type="text" class="yy" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" tabindex="10" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" />        <div id="dobVal"></div>     </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">Pincode</td><td height="35"><input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv(\'pincodeVal\');" type="text" class="input" tabindex="11" />  <div id="pincodeVal"></div></td></tr><tr><td height="35" align="left" valign="middle" class="form_body">Property Value</td><td height="35"><input  name="property_value"  id="property_value" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="input" onkeydown="validateDiv(\'propertyValueVal\');"  tabindex="12" /><div id="propertyValueVal"></div></td></tr><tr><td height="35" align="left" valign="middle" class="form_body">No. of EMI Paid (in Months)</td><td height="35"><input type="text" name="emi_paid" class="input" maxlength="5" onkeydown="validateDiv(\'emiPaidVal\');" tabindex="13" /><div id="emiPaidVal"></div>        </td></tr><tr><td height="35" align="left" valign="middle" class="form_body">Property Identified</td><td height="35" class="form_body"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onClick="return addIdentified();" style="border:none;" tabindex="14" /> Yes   <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" checked="checked" tabindex="15" /> No</td></tr><tr><td colspan="2" id="myDiv1"></td></tr><tr><td height="35" colspan="2" valign="middle" class="form_body" style="font-size:11px;"><table width="98%" border="0" cellspacing="0" cellpadding="0"><tr><td width="4%"><span class="form_body" style="font-size:11px;"> <input name="accept" type="checkbox" checked="checked" tabindex="16" onclick="validateDiv(\'acceptVal\');" /></span><div id="acceptVal"></div></td><td width="96%"><span class="form_body" style="font-size:10px; font-weight:normal;">I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to <a href="http://www.deal4loans.com/Privacy.php" style="color:#FFF;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" style="color:#FFF;">Terms &amp; Conditions</a>.</span></td></tr></table></td></tr><tr><td height="55" colspan="2" align="center" class="form_body"><input type="submit" style="border: 0px none ; background-image: url(images/get-quote-btn-window-hl.jpg); width:110px; height:39px; margin-bottom: 0px;" value="" tabindex="19"/></td></tr></table></div>';

}

</script>
  <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style>
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:249px;	/* Width of box */
		height:65px;	/* Height of box */
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
border-bottom: 3px solid #7F9D27;}

</style>
</head>

<body>
<div class="header">
<div class="header_a">
<div class="logo"><img src="images/logo-deal4loans-window_a.jpg" width="157" height="63" /></div>
<div class="header_b">Instant Free Quotes from <strong>9 Govt.</strong> and Private Banks<br />
  Choose best Home Loan with <?php echo date("F"); ?> <strong><?php echo date("Y"); ?></strong> rates</div>
</div>
</div>
<div class="second_container">
<div class="second_container-inn">
<div class="left_container">
<div class="form-box">
  <div id="example-two">
		
		<ul class="nav">
			<li class="nav-one"><a href="#balanceTransfer" <?php echo $openTabBalT; ?> >Balance Transfer</a></li>
			<li class="nav2"><a href="#applyHL" <?php echo $openTabHL; ?> >Apply for Home Loan</a></li>
                
		</ul>
		
		<div class="list-wrap" style="height:auto !important;" >
		
		<div id="balanceTransfer" style="height:auto;" <?php echo $hideBalT; ?>>
<div class="tab_container-main"><form name="loancalc" id="loancalc" method="post" action="home-loan-balance-transfer-calculator-continue.php" onSubmit="return check_form(document.loancalc);" >
 <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
 

  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="45" colspan="2" class="text-a">Loan Details</td>
      </tr>
   <tr>
      <td height="35" width="40%" align="left" valign="middle" class="form_body">Loan Amount Borrowed</td>
      <td height="35" width="60%"><input name="loan_amount" id="loan_amount" type="text" class="input" onkeydown="validateDiv('blloanAmountVal');" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="intOnly(this);" maxlength="30" value="<?php echo $loan_amount; ?>" tabindex="1" />

                    <div id="blloanAmountVal"></div>   </td>
    </tr>
      <tr>
      <td height="35" align="left" valign="middle" class="form_body">ROI on Current Home Loan</td>
      <td height="35"><input type="text" name="roi" id="roi" onkeydown="validateDiv('blroiVal');" class="input" value="<?php echo $Interest_Rate; ?>" tabindex="2" />
                   <div id="blroiVal"></div></td>
    </tr>
      <tr>
      <td height="35" align="left" valign="middle" class="form_body">Name of Existing Bank</td>
      <td height="35"><input type="text" name="Existing_Bank"  id="Existing_Bank" class="input" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event);" onkeydown="validateDiv('blexistBankVal');" tabindex="3" /><div id="blexistBankVal"></div>   </td>
    </tr>
    <tr>
      <td height="35" align="left" valign="middle" class="form_body">No. of EMI Paid (in Months)</td>
      <td height="35"><input type="text" name="emi_paid" class="input" maxlength="5" value="<?php echo $emi_paid ; ?>" onkeydown="validateDiv('blemiPaidVal');" tabindex="4" /><div id="blemiPaidVal"></div></td>
    </tr>
	  <tr>
      <td height="35" align="left" valign="middle" class="form_body">Tenure (in Years)</td>
      <td height="35"><select name="tenure" id="tenure" class="select" tabindex="5" onchange="addPersonalDetailsBT(); validateDiv('bltenureVal'); ">
         <option value="">Please Select</option>
          <?php 
		   for($i=5;$i<=25;$i++)
		   {
		   		$selected = "";
				if($i==$Duration_of_Loan)
				{
					$selected = "selected";
				}	
		   		echo "<option value='".$i."' ".$selected." >".$i."</option>";
		   }
		   ?>
                       </select>
                  
                        <div id="bltenureVal"></div>   </td>
    </tr>
    <tr><td colspan="2" id="personalDetailsBT"><table width="98%" border="0" cellspacing="0" cellpadding="0"><tr><td height="55" colspan="2" align="center" class="form_body"><input type="submit" style="border: 0px none ; background-image: url(images/calulate-btn-window.jpg); width:259px; height:40px; margin-bottom: 0px;" value="" tabindex="12"/></td></tr></table></td></tr>
  </table>
  </form>
  
  <div class="form_bottom_box" style="width:99%;"><strong>Home Loan Balance transfer</strong> need not only mean saving money, you can also utilize the same for investing in different options. After all securing a home loan is not the end of journey. Balance transfer - by switching to another lender may give you a better deal. While a balance transfer will certainly reduce your EMI outgo, there is no one-size-fits-all solution for everybody. To know if it will help you, you need to decipher its workings and calculate the actual benefit before taking a call.<br />
  <br />
  <strong>Home Loan Balance Transfer Calculator</strong> involves doing a simple math which in turn would save you from coughing up your hard earned money. All you need to do is insert your existing home loan rate and prepayment charges and based on that it gives you instant quote of four other bank rates as well and tells you how much you can save.<br />
</div>
  
  </div>
  <div class="right_box">
  <div class="right_box_a">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" class="right_text_a">Top Home Loan Balance Transfer Banks</td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
      <tr>
        <td height="165" valign="top" bgcolor="#a732ee"><div class="banks_logo">
          <table width="98%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="41" align="center" class="sbi_text">SBI</td>
            </tr>
          </table>
        </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="lic_text">LIC</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="hdfc_bank">HDFC</td>
              </tr>
            </table>
          </div>
          <div style=" clear:both;"></div>
          <div class="banks_logo">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="axis_bank">AXIS Bank</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="pnb_housing">PNB Housing</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="icici_bank">ICICI Bank</td>
              </tr>
            </table>
          </div>
          <div style=" clear:both;"></div>
          <div class="banks_logo">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="federal_bank">Federal Bank</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="city_bank">Citi bank </td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="standard_ch">Standard Chartered </td>
              </tr>
            </table>
          </div></td>
      </tr>
    </table>
  </div>
  <div class="right_box_b">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" align="center" class="right_text_b">Transfer your Existing Home Loan</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FAFBFD"><table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">Bank</td>
            <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">Interest Rate</td>
            <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">New EMI</td>
            <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">Total Savings</td>
          </tr>
          <tr class="table_tp_text">
            <td height="30" align="center" bgcolor="#efefef" class="table_hil_text">Bank A</td>
            <td height="30" align="center" bgcolor="#efefef">9.95%</td>
            <td height="30" align="center" bgcolor="#efefef">28,851</td>
            <td height="30" align="center" bgcolor="#efefef">4,82,949</td>
          </tr>
          <tr>
            <td height="30" align="center"><span class="table_hil_text"><strong>Bank B</strong></span></td>
            <td height="30" align="center" class="table_tp_text">10%</td>
            <td height="30" align="center" class="table_tp_text">28,951</td>
            <td height="30" align="center" class="table_tp_text">4,59,115</td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#efefef"><span class="table_hil_text"><strong>Bank C</strong></span></td>
            <td height="30" align="center" bgcolor="#efefef" class="table_tp_text">10.15%</td>
            <td height="30" align="center" bgcolor="#efefef" class="table_tp_text">29,249</td>
            <td height="30" align="center" bgcolor="#efefef" class="table_tp_text">3,87,410</td>
          </tr>
          <tr>
            <td height="30" align="center"><span class="table_hil_text"><strong>Bank D</strong></span></td>
            <td height="30" align="center" class="table_tp_text">10.50%</td>
            <td height="30" align="center" class="table_tp_text">29,951</td>
            <td height="30" align="center" class="table_tp_text">2,18,935</td>
          </tr>
          <tr>
            <td height="30" colspan="4" align="center">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
    </table>
  </div>
  <div style="clear:both;"></div>
  <div class="right_box_c">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" align="center" valign="middle" class="right_text_c">Home Loan Fixed rate Offers</td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Fixed rate for <strong>10 y</strong>ears @<strong> 11%</strong></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Fixed rate for <strong>3</strong> years @ <strong>10.75%</strong></td>
      </tr>
    </table>
  </div>
  <div class="right_box_d">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" align="center" valign="middle" class="right_text_c" style="font-size:13px;">Home Loan Cash Back Offers</td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Get <strong>2 </strong>offers on Cash Back schemes</td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Save up to <strong>1.5 lacs</strong></td>
      </tr>
    </table>
  </div>
  <div style=" clear:both;"></div>
  <div class="right_box_e">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="0" align="center" valign="middle" class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" align="center" valign="middle" class="right_text_c"><strong>30</strong> year Home Loan offers</td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Get maximum eligibility <br />
          with such Offers<strong></strong></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Choose from <strong>3</strong> options</td>
      </tr>
    </table>
  </div>
  <div class="right_box_f">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="0" align="center" valign="middle" class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" align="center" valign="middle" class="right_text_c">Get Instant quote from <strong>9 </strong>Nationalized and Private Banks </td>
      </tr>
      <tr>
        <td height="28" align="center" valign="middle" class="form_body">Rates as low as <strong>10.25% </strong></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Special offers for Festive Seasion</td>
      </tr>
    </table>
  </div>
</div>
<div style="clear:both;"></div>

  </div>
  
		<div id="applyHL" <?php echo $hideHL; ?>><div class="tab_container-main">
 <form name="loan_form" method="post" action="apply-home-loanscontinue1.php" onSubmit="return chkform();">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#0097aa" >
    <tr>
      <td height="45" colspan="2" class="text-a">Loan Details</td>
      </tr>
   <tr>
      <td height="35"  align="left" valign="middle" class="form_body">Loan Amount</td>
      <td height="35" ><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="input" onkeydown="validateDiv('loanAmtVal');" tabindex="1" /><div id="loanAmtVal"></div><span id='formatedlA' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
      <tr>
      <td height="35" align="left" valign="middle" class="form_body">Occupation</td>
      <td height="35"><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');" class="select" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" tabindex="2" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select>
                       <div id="empStatusVal"></div></td>
    </tr>
      <tr>
      <td height="35" align="left" valign="middle" class="form_body">Annual Income</td>
      <td height="35"><input type="text" name="Net_Salary" id="Net_Salary" class="input" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome', 'wordIncome');" onkeypress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" tabindex="3" onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"  /><div id="netSalaryVal"></div>   <span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
    <tr>
      <td height="35" align="left" valign="middle" class="form_body">City</td>
      <td height="35"><select name="City" id="City" class="select" onchange=" addPersonalDetailsHL(); validateDiv('cityVal');" tabindex="4"><?=getCityList($City)?></select><div id="cityVal"></div></td>
    </tr>
	 
    <tr><td colspan="2" id="personalDetailsHL" bgcolor="#0097aa" width="100%">  <table width="98%" border="0" cellspacing="0" cellpadding="0">       <tr>      <td height="55" colspan="2" align="center" class="form_body">       <input type="submit" style="border: 0px none ; background-image: url(images/get-quote-btn-window-hl.jpg); width:110px; height:39px; margin-bottom: 0px;" value="" tabindex="19"/></td>      </tr>      </table></td></tr>
  </table>
  </form>        
        </div>
       <div class="right_box">
  <div class="right_box_a">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" class="right_text_a">Top Home Loan Banks</td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
      <tr>
        <td height="165" valign="top" bgcolor="#a732ee"><div class="banks_logo">
          <table width="98%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="41" align="center" class="sbi_text">SBI</td>
            </tr>
          </table>
        </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="lic_text">LIC</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="hdfc_bank">HDFC</td>
              </tr>
            </table>
          </div>
          <div style=" clear:both;"></div>
          <div class="banks_logo">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="axis_bank">AXIS Bank</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="pnb_housing">PNB Housing</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="icici_bank">ICICI Bank</td>
              </tr>
            </table>
          </div>
          <div style=" clear:both;"></div>
          <div class="banks_logo">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="federal_bank">Federal Bank</td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="city_bank">Citi bank </td>
              </tr>
            </table>
          </div>
          <div class="banks_logo_b">
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" align="center" class="standard_ch">Standard Chartered </td>
              </tr>
            </table>
          </div></td>
      </tr>
    </table>
  </div>
  <div class="right_box_b">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" align="center" class="right_text_b">Sample Home Loan Quotes</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FAFBFD"><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">Bank</td>
    <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">Interest Rate</td>
    <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">EMI</td>
    <td height="30" align="center" bgcolor="#7EC7E8" class="table_tp_text">Loan Amount</td>
  </tr>
  <tr class="table_tp_text">
    <td height="30" align="center" bgcolor="#efefef" class="table_hil_text">Bank A</td>
    <td height="30" align="center" bgcolor="#efefef">10.10%</td>
    <td height="30" align="center" bgcolor="#efefef">19,433</td>
    <td height="30" align="center" bgcolor="#efefef">20,00,000</td>
  </tr>
  <tr>
    <td height="30" align="center"><span class="table_hil_text"><strong>Bank B</strong></span></td>
    <td height="30" align="center" class="table_tp_text">10.25%</td>
    <td height="30" align="center" class="table_tp_text">19,633</td>
    <td height="30" align="center" class="table_tp_text">20,00,000</td>
  </tr>
  <tr>
    <td height="30" align="center" bgcolor="#efefef"><span class="table_hil_text"><strong>Bank C</strong></span></td>
    <td height="30" align="center" bgcolor="#efefef" class="table_tp_text">10.40%</td>
    <td height="30" align="center" bgcolor="#efefef" class="table_tp_text">19,833</td>
    <td height="30" align="center" bgcolor="#efefef" class="table_tp_text">20,00,000</td>
  </tr>
  <tr>
    <td height="30" align="center"><span class="table_hil_text"><strong>Bank D</strong></span></td>
    <td height="30" align="center" class="table_tp_text">11.00%</td>
    <td height="30" align="center" class="table_tp_text">20,643</td>
    <td height="30" align="center" class="table_tp_text">20,00,000</td>
  </tr>
  <tr>
    <td height="30" colspan="4" align="center">&nbsp;</td>
  </tr>
</table>
        </td>
      </tr>
    </table>
  </div>
  <div style="clear:both;"></div>
  <div class="right_box_c">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" align="center" valign="middle" class="right_text_c">Home Loan Fixed rate Offers</td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Fixed rate for <strong>10 y</strong>ears @<strong> 11%</strong></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Fixed rate for <strong>3</strong> years @ <strong>10.75%</strong></td>
      </tr>
    </table>
  </div>
  <div class="right_box_d">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" align="center" valign="middle" class="right_text_c" style="font-size:13px;">Home Loan Cash Back Offers</td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Get <strong>2 </strong>offers on Cash Back schemes</td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Save up to <strong>1.5 lacs</strong></td>
      </tr>
    </table>
  </div>
  <div style=" clear:both;"></div>
  <div class="right_box_e">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="0" align="center" valign="middle" class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" align="center" valign="middle" class="right_text_c"><strong>30</strong> year Home Loan offers</td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Get maximum eligibility <br />
          with such Offers<strong></strong></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Choose from <strong>3</strong> options</td>
      </tr>
    </table>
  </div>
  <div class="right_box_f">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="0" align="center" valign="middle" class="right_text_c">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" align="center" valign="middle" class="right_text_c">Get Instant quote from <strong>9 </strong>Nationalized and Private Banks </td>
      </tr>
      <tr>
        <td height="28" align="center" valign="middle" class="form_body">Rates as low as <strong>10.25% </strong></td>
      </tr>
      <tr>
        <td height="22" align="center" class="form_body">Special offers for Festive Seasion</td>
      </tr>
    </table>
  </div>
</div> 
      <div style="clear:both;"></div>
        </div></div>
        </div>
</div>

</div>
<div style=" clear:both;"></div>

</div>
</div>
</body>
</html>
