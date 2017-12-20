<?php
	//require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$Reference_Code = 0;
	$maxage=date('Y')-62;
	$minage=date('Y')-18;

function accgetCityList($key){
	   $strCity;
       $strCity = "";
	   $strCity = $strCity.AmISelected("Please Select", $key, "SELECT CITY");
		$strCity = $strCity.AmISelected("Delhi", $key, "Delhi");
		$strCity = $strCity.AmISelected("Gurgaon", $key, "Gurgaon");
		$strCity = $strCity.AmISelected("Noida", $key, "Noida");
		$strCity = $strCity.AmISelected("Faridabad", $key, "Faridabad");
		$strCity = $strCity.AmISelected("Gaziabad", $key, "Gaziabad");
		$strCity = $strCity.AmISelected("Greater Noida", $key, "Greater Noida");
		$strCity = $strCity.AmISelected("Mumbai", $key, "Mumbai");
		$strCity = $strCity.AmISelected("Navi Mumbai", $key, "Navi Mumbai");
		$strCity = $strCity.AmISelected("Thane", $key, "Thane");
		$strCity = $strCity.AmISelected("Bangalore", $key, "Bangalore");
		$strCity = $strCity.AmISelected("Chennai", $key, "Chennai");
		$strCity = $strCity.AmISelected("Others", $key, "Others");
	   return $strCity;
	}
	$RequestID= $_REQUEST['RequestID'];
	
	//Checking DataBase for email

	$sqlPL = "select Name,Mobile_Number,Email,Employment_Status,Net_Salary,Company_Name,City from Req_Credit_Card where RequestID='".$RequestID."' order by RequestID desc limit 0,1";
	list($numPL,$MyRows)=Mainselectfunc($sqlPL,$array = array());
	if($numPL>0)
	{
		$Name = $MyRows['Name'];
		$Mobile_Number = $MyRows['Mobile_Number'];
		$Email = $MyRows['Email'];
		$Employment_Status = $MyRows['Employment_Status'];
		$Company_Name = $MyRows['Company_Name'];
		$Net_Salary= round($MyRows['Net_Salary']);
		$City = $MyRows['City'];
	
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>American Express Platinum Travel Credit Card </title>
<link href="american-express-lp-first-stage-styles.css" type="text/css" rel="stylesheet" />
 <script type="text/javascript" src="scripts/common.js"></script>

<script type="text/javascript">
var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function ajaxpage(url, containerid){

var containerid = 'contentarea';	
var carmanufacturer = document.cc_form.car_manufacturer.value;
var url;
url = "getCar4CC.php?carmanufacturer=" + carmanufacturer;
//alert(url);
	
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}


</script>
<script language="javascript">
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){ element.value=""; } }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; } }
function Trim(strValue) { var j=strValue.length-1;i=0; while(strValue.charAt(i++)==' '); while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param) {	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{ if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}
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

	if((document.cc_form.Name.value=="") || ((Trim(document.cc_form.Name.value))==false) || (document.cc_form.Name.value=="NAME"))
	{       alert("Please Enter Your name");				document.cc_form.Name.focus();		return false;	}


	if(document.cc_form.Name.value!="")
	{
		if(containsdigit(document.cc_form.Name.value)==true)
		{			alert("First Name contains numbers!");			document.cc_form.Name.focus();			return false;		}
	}
   for (var i = 0; i <document.cc_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.cc_form.Name.value.charAt(i)) != -1) 
		{			alert("Contains special characters");			document.cc_form.Name.focus();			return false;		}
  }
	if(document.cc_form.Email.value=="" || document.cc_form.Email.value=="EMAIL ID")
	{		alert("Enter  Email Address");			document.cc_form.Email.focus();		return false;	}
	var str=document.cc_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		alert("Enter Valid Email Address");			document.cc_form.Email.focus();		return false;	}
	else if(bb==-1)
	{		alert("Enter Valid Email Address");			document.cc_form.Email.focus();		return false;	}
	
	if(document.cc_form.Phone.value=="" || document.cc_form.Phone.value=="MOBILE NO.")
	{		alert("Fill Mobile Number");		document.cc_form.Phone.focus();		return false;	}
	if(isNaN(document.cc_form.Phone.value)|| document.cc_form.Phone.value.indexOf(" ")!=-1)
	{		alert("Enter numeric value");		document.cc_form.Phone.focus();		return false;  	}
	if (document.cc_form.Phone.value.length < 10 )
	{	  	alert("Enter 10 Digits");			document.cc_form.Phone.focus();		return false;	}
	if ((document.cc_form.Phone.value.charAt(0)!="9") && (document.cc_form.Phone.value.charAt(0)!="8") && (document.cc_form.Phone.value.charAt(0)!="7"))
	{	  	alert("should start with 9 or 8 or 7");			document.cc_form.Phone.focus();		return false;	}

/*	if(document.cc_form.activation_code.value=="" || document.cc_form.activation_code.value=="CODE")
	{
		alert("Please fill the activation code.");
		document.cc_form.activation_code.focus();
		return false;
	}

	if(document.cc_form.activation_code.value!="")
	{
		if(document.cc_form.activation_code.value!=<?php echo $Reference_Code; ?>)
		{
			alert("Please fill the correct activation code.");
			document.cc_form.activation_code.focus();
			return false;
		}
	}
*/

if (document.cc_form.City.selectedIndex==0)
	{		alert("Enter City to Continue");			document.cc_form.City.focus();		return false;	}

/*if (document.cc_form.Net_Salary.selectedIndex==0)
	{		alert("Enter Annual Income");			document.cc_form.Net_Salary.focus();		return false;	}	*/
	
if (document.cc_form.Net_Salary.value=="" || document.cc_form.Net_Salary.value==0)	{		alert("Enter Annual Income");			document.cc_form.Net_Salary.focus();		return false;	}	
	/*if (document.cc_form.Employment_Status.selectedIndex==0)
	{
		alert("Select Employment Status to Continue");	
		document.cc_form.Employment_Status.focus();
		return false;
	}	*/
	

	if(document.cc_form.Company_Name.value=="")
	{
		alert("Fill Company Name");
		document.cc_form.Company_Name.focus();
		return false;
	}

	if(document.cc_form.nature_business.value=="")
	{
		alert("Fill Nature of Business");
		document.cc_form.nature_business.focus();
		return false;
	}
	if(document.cc_form.current_experience.value=="")
	{
		alert("Fill Current Experience");
		document.cc_form.current_experience.focus();
		return false;
	}
	if(document.cc_form.office_phone_std.value=="")
	{
		alert("Fill Office Phone Std Code");
		document.cc_form.office_phone_std.focus();
		return false;
	}
	if(document.cc_form.office_phone.value=="")
	{
		alert("Fill Office Phone ");
		document.cc_form.office_phone.focus();
		return false;
	}
	if(document.cc_form.office_address.value=="")
	{
		alert("Fill Office Address");
		document.cc_form.office_address.focus();
		return false;
	}
	if(document.cc_form.address_home.value=="")
	{
		alert("Fill Home Address");
		document.cc_form.address_home.focus();
		return false;
	}
	if(document.cc_form.address_pincode.value=="")
	{
		alert("Fill Home Address Pincode");
		document.cc_form.address_pincode.focus();
		return false;
	}
	
	var a=document.cc_form.Pancard.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	  document.cc_form.Pancard.focus();
	  return false;
	}
	if (document.cc_form.Pancard.value.charAt(3)!="P" && document.cc_form.Pancard.value.charAt(3)!="p")
	{
			alert("Please enter valid pan number");
			document.cc_form.Pancard.focus();
			return false;
	}


if(document.cc_form.day.value=="" || document.cc_form.day.value=="DD")
	{
		alert("Fill Day of Birth");
		document.cc_form.day.focus();
		return false;
	}
	if(document.cc_form.day.value!="")
	{
		if((document.cc_form.day.value<1) || (document.cc_form.day.value>31))
		{
			alert("Date of Birth(Range 1-31)");
			document.cc_form.day.focus();
			return false;
		}
	}
		

	if(document.cc_form.month.value=="" || document.cc_form.month.value=="MM")
	{
		alert("Fill month of Birth");
		document.cc_form.month.focus();
		return false;
	}
	if(document.cc_form.month.value!="")
	{
		if((document.cc_form.month.value<1) || (document.cc_form.month.value>12))
		{
			alert("Month of Birth(Range 1-12)");
			document.cc_form.month.focus();
			return false;
		}
	}

	if(document.cc_form.year.value=="" || document.cc_form.year.value=="YYYY")
	{
		alert("Fill Year of Birth");
		document.cc_form.year.focus();
		return false;
	}
	if(document.cc_form.year.value!="")
	{
		if((document.cc_form.year.value < "<?php echo $maxage;?>") || (document.cc_form.year.value >"<?php echo $minage;?>"))
		{
			alert("Age between 18 -62");
			document.cc_form.year.focus();
			return false;
		}
	}

var i;
var myOption1 = -1;
		for (i=document.cc_form.own_car.length-1; i > -1; i--) {
			if(document.cc_form.own_car[i].checked) {
				if(i==0)
				{
					if (document.cc_form.car_manufacturer.value=="")
					{
						alert("Enter Car Manufacturer");
						document.cc_form.car_manufacturer.focus();
						return false;
					}
					if (document.cc_form.car_model.value=="")
					{
						alert("Enter Car Model");
						document.cc_form.car_model.focus();
						return false;
					}
					
				}
					myOption1 = i;
				}
		}
	
		if (myOption1 == -1) 
		{
			alert("Do you own a Car");	
			return false;
		}



var myOption = -1;
		for (i=document.cc_form.CC_Holder.length-1; i > -1; i--) {
			if(document.cc_form.CC_Holder[i].checked) {
				if(i==0)
				{
					if (document.cc_form.cc_company.value=="")
					{
						alert("Enter Credit Card Company name");
						document.cc_form.cc_company.focus();
						return false;
					}
					if (document.cc_form.loan_any.value=="")
					{
						alert("Enter Any Loan running");
						document.cc_form.loan_any.focus();
						return false;
					}
					
				}
					myOption = i;
				}
		}
	
		if (myOption == -1) 
		{
			alert("Credit Card holder or not");	
			return false;
		}


	if(!document.cc_form.accept.checked)	
	{		alert("Read and Accept Terms & Conditions"); document.cc_form.accept.focus(); return false; }
} 

function addProfessionalDetails()
{
	var ni1 = document.getElementById('professionalDetails');
	var ni2 = document.getElementById('professionalContent');
	
	ni1.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="4%" style="border-bottom:thin solid  #79e1f7;">&nbsp;</td><td width="96%" height="20" class="form_head_text" style="border-bottom:thin solid  #79e1f7;">Professional Details</td></tr><tr><td colspan="2"> <div class="filed-box"><table width="100%" border="0" ><tr><td width="32%" height="32" class="form_body_text">Company <span style="color:#FF0000; font-weight:bold;">*</span><br>Name </td><td width="68%"><input class="pl_input-box" type="text" name="Company_Name" id="Company_Name" value="<?php if(strlen($Company_Name)>0) echo $Company_Name; ?>"></td></tr><tr><td height="32" class="form_body_text">Industry/<span style="color:#FF0000; font-weight:bold;">*</span><br>Nature of Business</td><td height="32"><input class="pl_input-box" type="text" name="nature_business" id="nature_business"></td></tr><tr><td height="28" colspan="2" class="form_body_text">Where would you like to recieve your statement?<span style="color:#FF0000; font-weight:bold;">*</span></td></tr><tr><td colspan="2" ><span class="form_text"><input type="radio" name="stat_location" value="Home">Home<input type="radio" name="stat_location" value="Office" checked>Office</span></td></tr></table></div><div class="filed-box"><table width="100%" border="0" ><tr><td width="37%" height="32" class="form_body_text">Number of Years at current Organization<span style="color:#FF0000; font-weight:bold;">*</span><br></td><td width="63%" align="right"><input class="pl_input-box" type="text" name="current_experience" id="current_experience" maxlength="5"></td></tr><tr><td height="32" class="form_body_text">Phone No. (Office)<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32"><input class="pl_input-box_ph" type="text" name="office_phone_std" id="office_phone_std" maxlength="5" onkeypress="intOnly(this);" onkeyup="intOnly(this);"> <input class="pl_input-box_ph_b" type="text" maxlength="8" name="office_phone" id="office_phone" onkeypress="intOnly(this);" onkeyup="intOnly(this);"></td></tr><tr><td height="32" class="form_body_text">Address (Office)<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32"><input class="pl_input-box" type="text" name="office_address" id="office_address" onFocus="addPersonalDetails();"></td></tr></table></div></td></tr></table>';
	
	ni2.innerHTML ='<div class="crdit_card_box" style="margin-top:2px;"> <img src="images/american-express-platinum-travel-card.png" width="196" height="137"></div><div class="crdit_card_box"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>  <td height="25" style="border-bottom:#a41b29 solid thin;"><span class="form_head_text">American Express Platinum Travel <br/>Credit Card</span></td></tr><tr><td>&nbsp;</td></tr><tr> <td valign="top" class="bullet_text"><ul><li> Welcome Gift1 of 5000 Milestone Bonus Membership Rewards Points redeemable for IndiGo Vouchers worth Rs.4,000</li> <li>Spend Rs.1.90 lacs in a year and get IndiGo Vouchers worth more than Rs.8,000</li><li> Spend Rs.4 lacs in a year and additionally get IndiGo Vouchers worth more than Rs.125003.</li>    <li>Spend Rs.4 lacs in a year and get a voucher worth Rs.10000 from the Taj Group. This voucher will be mailed to you once you reach the spend threshold of Rs.4 lacs</li> </ul></td>  </tr></table></div>';

}
function addCarDetails()
{
	var ni1 = document.getElementById('carDetails');
		ni1.innerHTML = '<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td height="32" width="32%" class="form_body_text">Car Make<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32" width="68%"><select name="car_manufacturer" id="car_manufacturer" class="pl_input-box_select" onChange="ajaxpage();"><option value="">Select Car Brand</option><?php $getCarNameSql = "SELECT hdfc_car_manufacturer FROM hdfc_car_list_category WHERE 1 GROUP BY hdfc_car_manufacturer"; list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array()); for($cN=0;$cN<$numRowsCarName;$cN++){ $hdfc_car_manufacturer = $getCarNameQuery[$cN]["hdfc_car_manufacturer"];	?> 	<option value="<?php echo $hdfc_car_manufacturer; ?>"><?php echo $hdfc_car_manufacturer; ?></option>       <?php } ?></select></td></tr><tr><td height="32" width="32%" class="form_body_text">Car Model<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32" width="68%"><div id="contentarea"><select name="car_model" id="car_model" class="pl_input-box_select"><option> Select Car Make</option>          </select></div></td></tr></table>';
	
	
}

function addCarDetailsCancel()
{
	var ni1 = document.getElementById('carDetails');
			
		ni1.innerHTML = '';
	
}

function addCCDetails()
{
	var ni1 = document.getElementById('ccDetails');
		ni1.innerHTML = '<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td height="32" width="32%" class="form_body_text">Currently holding Credit Card from?<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32" width="68%"><input class="pl_input-box" type="text" name="cc_company" id="cc_company"></td></tr></table>';
	
	
}

function addCCDetailsCancel()
{
	var ni1 = document.getElementById('ccDetails');
			
		ni1.innerHTML = '';
	
}

function addLADetails()
{
	var ni1 = document.getElementById('laDetails');
		ni1.innerHTML = '<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><tr><td height="32" width="32%" class="form_body_text">Loan Amount Taken<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32" width="68%"><input class="pl_input-box" type="text" name="loan_any" id="loan_any"></td></tr></table>';
	
	
}

function addLADetailsCancel()
{
	var ni1 = document.getElementById('laDetails');
			
		ni1.innerHTML = '';
	
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	
	ni1.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="4%" style="border-bottom:thin solid  #79e1f7;">&nbsp;</td><td width="96%" height="20" class="form_head_text" style="border-bottom:thin solid  #79e1f7;">Personal Details</td></tr><tr><td colspan="2"><div class="filed-box"><table width="100%" border="0" ><tr><td width="32%" height="32" class="form_body_text">Gender<span style="color:#FF0000; font-weight:bold;">*</span></td><td width="68%"><span class="form_text"><input type="radio" name="gender" value="male" checked>Male<input type="radio" name="gender"  value="female"> Female</span></td></tr><tr><td height="32" class="form_body_text">Address Home<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32"><input class="pl_input-box" type="text" name="address_home" id="address_home"></td></tr><tr><td height="32" class="form_body_text">PIN<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32"><input class="pl_input-box" type="text" name="address_pincode" id="address_pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"></td></tr>  <tr><td height="32" class="form_body_text">DO you <br>Own a Car?<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32" class="form_text"><span class="form_text"><input type="radio" name="own_car" id="own_car" value="1" onClick="addCarDetails();">Yes<input type="radio" name="own_car" id="own_car" value="0" onClick="addCarDetailsCancel();"> No</span></td></tr><tr><td colspan="2" id="carDetails"></td></tr>  </table></div><div class="filed-box"><table width="100%" border="0" ><tr><td width="37%" height="32" class="form_body_text">Pancard<span style="color:#FF0000; font-weight:bold;">*</span><br></td><td width="63%" align="right"><input class="pl_input-box" type="text" name="Pancard" id="Pancard" maxlength="10"></td></tr><tr><td height="32" class="form_body_text">DOB<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32"><input class="pl_input-box_ph" type="text" value="DD" name="day" id="day" maxlength="2" onkeypress="intOnly(this);" onkeyup="intOnly(this);">  <input class="pl_input-box_ph" type="text" name="month" value="MM" id="month" maxlength="2" onkeypress="intOnly(this);" onkeyup="intOnly(this);">  <input class="pl_input-box_ph" type="text" name="year" value="YYYY" id="year" maxlength="4" onkeypress="intOnly(this);" onkeyup="intOnly(this);"></td></tr><tr><td height="32" class="form_body_text">Do You own CreditCard?<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32"><span class="form_text"><input type="radio" name="CC_Holder" id="CC_Holder" value="1" onClick="addCCDetails();">Yes<input type="radio" name="CC_Holder" id="CC_Holder" value="0" onClick="addCCDetailsCancel();">No </span></td></tr><tr><td colspan="2" id="ccDetails"></td></tr><tr><td height="32" class="form_body_text">Any Loan Taken in Past?<span style="color:#FF0000; font-weight:bold;">*</span></td><td height="32"><span class="form_text"><input type="radio" name="loanany" id="loanany" value="1" onClick="addLADetails();">Yes<input type="radio" name="loanany" id="loanany" value="0" checked onClick="addLADetailsCancel();">No </span></td></tr><tr><td colspan="2" id="laDetails"></td></tr></table></div><div style="clear:both;"></div><div class="text_below_form" style="margin-top:5px;"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="73%" class="form_body_text"><input type="checkbox" name="accept" id="accept">I Agree to <a href="http://www.deal4loans.com/Privacy.php">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php">Terms & Conditions</a>. </td><td width="27%" align="center"><input type="submit" style="border: 0px none ; background:#10cbf3; background-image: url(images/amx-submit-btn.png); width: 114px; height: 29px; margin-bottom: 0px;" value=""/></td></tr></table></div></td></tr></table>';

}
	
</script>

</head>
<body>
<form action="american-express-platinum-travel-card-continue.php" method="post" name="cc_form" onSubmit="return chkform();">
<input type="hidden" name="Reference_Code" id="Reference_Code" value="<?php echo $Reference_Code; ?>">
<div class="amx-second">
<div class="logo_d4l"><img src="images/d4l_amx_logo.jpg" width="145" height="49"></div>
<div class="logo_amx"><img src="images/amx_d4l_logo.jpg" width="263" height="41"></div>
<div style="clear:both;"></div>
<div class="left_panel">
<div class="left_inner_text_bx" style="margin-top:6px;">American Express Platinum Travel card </div>
<div class="filed-box">
  <table width="100%" border="0" >
   <tr><td width="32%" height="32" class="form_body_text">Name <span style="color:#FF0000; font-weight:bold;">*</span></td><td width="68%"><input class="pl_input-box" type="text" name="Name" id="Name" value="<?php if(strlen($Name)>0) echo $Name; else echo 'NAME'; ?>"></td></tr>
    <tr><td width="32%" height="32" class="form_body_text">MOBILE NO<span style="color:#FF0000; font-weight:bold;">*</span></td><td width="68%"><input class="pl_input-box" type="text" name="Phone" id="Phone" value="<?php if(strlen($Mobile_Number)>0) echo $Mobile_Number; else echo 'MOBILE NO.'; ?>" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="10"></td></tr>
     <tr><td width="32%" height="32" class="form_body_text">ANNUAL DECLARED INCOME <span style="color:#FF0000; font-weight:bold;">*</span></td><td width="68%"><input class="pl_input-box" type="text" name="Net_Salary" id="Net_Salary" value="<?php if(strlen($Net_Salary)>0) echo $Net_Salary; else echo 'ANNUAL INCOME'; ?>" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="10"> </td></tr>
   
   
    </table>
</div>

<div class="filed-box">
  <table width="100%" border="0" >
     <tr><td width="32%" height="32" class="form_body_text">EMAIL ID<span style="color:#FF0000; font-weight:bold;">*</span></td><td width="68%"> <input class="pl_input-box" type="text" name="Email" id="Email" value="<?php if(strlen($Email)>0) echo $Email; else echo 'EMAIL ID'; ?>"></td></tr>
     <tr><td width="32%" height="32" class="form_body_text">City<span style="color:#FF0000; font-weight:bold;">*</span></td><td width="68%"><select name="City" id="City" class="pl-select-box">
   <?=accgetCityList($City)?>
      </select></td></tr>
  
    <tr>
      <td height="32" valign="middle" class="form_text" colspan="2">
        <input type="radio" name="Employment_Status" id="Employment_Status" value="1" <?php if($Employment_Status==1) echo "checked"; ?>>        
        SALARIED              
        <input type="radio" name="Employment_Status" id="Employment_Status" value="0" <?php if($Employment_Status==0) echo "checked"; ?>>        
        SELF EMPLOYED </td>
    </tr>
    </table>
</div>
<div style="clear:both;"></div>
<div class="text_below_form" style="margin-top:1px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="79%" class="form_text">You can update your above details for any change and proceed <img src="images/amr-indicating-arrow.png" width="13" height="13"></td>
      <td width="21%" align="right"><img src="images/amx-apply-btn.png" width="103" height="31" onClick="addProfessionalDetails();"></td>
    </tr>
    </table>
</div>
<div style="clear:both;"></div>
<div class="onclick_below_form" id="professionalDetails"></div>

<div class="onclick_below_form" style="margin-top:5px;" id="personalDetails"></div>
</div>
<div class="rightbox form_text" id="professionalContent">The Annual Membership Fee for the American Express Platinum Travel Credit Card is Rs 5000* plus service tax.
<div class="bullet_text">
<ul>
<li>Welcome Gift of 5,000 Milestone Bonus Membership Rewards Points redeemable for IndiGo Vouchers worth Rs. 4000</li>
<li>
  Spend Rs.1.90 lacs in a year and get IndiGo Vouchers worth more than Rs.8000</li>
</ul>
</div>
<div class="crdit_card_box" style="margin-top:2px;"> <img src="images/american-express-platinum-travel-card.png" width="156" height="109"></div>
<div class="form_text" style="font-size:10px;">Please refer to the Most Important <a href="https://americanexpressindia.co.in/terms/platinumR.pdf">Terms & Conditions</a> along with this application for details on the fee and other charges on the Card.</div>
</div>
<div style="clear:both;"></div>
</div>
</form>
</body>
</html>
