<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$page_Name = "LandingPage_HL";
$Msg = "";
if($_SESSION['UserType']== "bidder")
{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
}

$name = $_SESSION['Temp_Name'] ;
$mobile = $_SESSION['Temp_mobile'] ;
$Email=	$_SESSION['Temp_email'] ;
$loan_type = $_SESSION['Temp_loan_type'] ;
$last_id = $_SESSION['Temp_Last_Inserted'] ;
//echo "last in serted id".$last_id;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks">
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
body{ margin-bottom:0px; margin-left:0px; margin-right:0px;	margin-top:0px;}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	line-height:20px;
}
.style2{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #0a71d9;
	font-weight: bold;
}
.style3{
	font-family: "Univers Condensed";
	font-size: 20px;
	color: #000000;
	line-height:30px;
}
h1{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: #2e2e2e;
	padding:0px;
	margin:0px
}
h2{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: #2e2e2e;
	padding:4px;
	padding-left:0px;
	margin:0px;
}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	line-height:18px;
}
.inp {font:Arial; font-size:10px; color:#000000; border-left:1px solid #68718a; border-top:1px solid #68718a; border-right:1px solid #68718a; border-bottom:1px solid #68718a; width:110px; height:18px}
.inp1 {font:Arial; font-size:10px; color:#000000; border-left:1px solid #68718a; border-top:1px solid #68718a; border-right:1px solid #68718a; border-bottom:1px solid #68718a; width:30px; height:16px}
.inp2 {font:Arial; font-size:10px; color:#000000; border-left:1px solid #68718a; border-top:1px solid #68718a; border-right:1px solid #68718a; border-bottom:1px solid #68718a; width:34px; height:16px}
.inp3 {font:Arial; font-size:12px; color:#000000; border-left:1px solid #68718a; border-top:1px solid #68718a; border-right:1px solid #68718a; border-bottom:1px solid #68718a;}
</style>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<Script Language="JavaScript">
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
	function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			     
               
       }

       return true;
}
	function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
function Decorate1(strPlan)
{
   if (document.getElementById('plantype2') != undefined) 
   {
	   document.getElementById('plantype2').innerHTML = strPlan;
	   document.getElementById('plantype2').style.background='';  
   }
   return true;
}
function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;

	return true;
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

if(document.loan_form.Email.value!="Email Id")
{
	if (!validmail(document.loan_form.Email.value))
	{
		document.loan_form.Email.focus();
		return false;
	}
	
}
if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
{
alert("Kindly fill in your Name!");
document.loan_form.Name.focus();
return false;
}
else if(containsdigit(Form.Name.value)==true)
{
alert("Name contains numbers!");
Form.Name.focus();
return false;
}
  for (var i = 0; i < Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Name.focus();
  	return false;
  	}
  }

if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
alert("Kindly enter your Date of Birth");
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
alert("Kindly enter your Date of Birth(numbers Only)");
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
alert("Kindly Enter your valid Date of Birth(Range 1-31)");
Form.day.select();
return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
alert("Kindly enter your Month of Birth(numbers Only)");
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
alert("Kindly Enter your valid Month of Birth(Range 1-12)");
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
alert("Month February cannot have more than 29 days");
Form.day.select();
return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
alert("Kindly enter your Year of Birth");
Form.year.select();
return false;
}

else if(!num.test(Form.year.value))
{
alert("Kindly enter your Year of Birth(numbers Only) !");
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
alert("February cannot have more than 28 days.");
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
Form.year.select();
return false;
}
else if((Form.year.value < "1945") || (Form.year.value >"1989"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
Form.year.select();
return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}

if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
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
if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
{
		alert("The number should start only with 9 or 8 or 7");
		 Form.Phone.focus();
		return false;
}

if((Form.Residence_Address.value=='')  || Trim(Form.Residence_Address.value)==false)
{
alert("Kindly fill in your Residence Address!");
Form.Residence_Address.focus();
return false;
}

if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
alert("Kindly fill in your other City!");
Form.City_Other.focus();
return false;
}

  for (var i = 0; i < Form.City_Other.value.length; i++) {
  	if (iChars.indexOf(Form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other City has special characters.\n Please remove them and try again.");
	Form.City_Other.focus();
  	return false;
  	}
  }

if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
alert("Kindly fill in your Pincode!");
Form.Pincode.focus();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.focus();
return false;
}
else if(containsalph(Form.Pincode.value)==true)
{
alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.focus();
return false;
}

 if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select emplyment status ");
	Form.Employment_Status.focus();
	return false;
}
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
{
	alert("Please enter Annual income to Continue");
	Form.IncomeAmount.focus();
	return false;
}

 if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
{
alert("Kindly fill in your Loan Amount (Numeric Only)!");
Form.Loan_Amount.focus();
return false;
}
else if(containsalph(Form.Loan_Amount.value)==true)
{
alert("Loan Amount contains characters!");
Form.Loan_Amount.focus();
return false;
}


if(!Form.accept.checked)
{
alert("Accept the Terms and Condition");
Form.accept.focus();
return false;
}
if(Form.Email.value=="Email Id")
{
	Form.Email.value=" ";
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
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
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
function validateemailv2(email)
{
// a very simple email validation checking.
// you can add more complex email checking if it helps
var splitted = email.match("^(.+)@(.+)$");
if(splitted == null) return false;
if(splitted[1] != null )
{
var regexp_user=/^\"?[\w-_\.]*\"?$/;
if(splitted[1].match(regexp_user) == null) return false;
}
if(splitted[2] != null)
{
var regexp_domain=/^[\w-\.]*\.[a-za-z]{2,4}$/;
if(splitted[2].match(regexp_domain) == null)
{
var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
if(splitted[2].match(regexp_ip) == null) return false;
}// if
return true;
}
return false;
}
function othercity1()
{
if(document.loan_form.City.value=='Others')
{
document.loan_form.City_Other.disabled=false;
}
else
{document.loan_form.City_Other.disabled=true;
}
}


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

function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
</script>
</head>

<body onbeforeunload="HandleOnClose('closedby_hl.php')">
<form name="loan_form" method="post" action="home-loan-second-stage.php?closeref=HL" onSubmit="return submitform(document.loan_form);">

<table width="750" style="border:solid 1px #000000;" align="center" cellspacing="0" cellpadding="0">
  	<tr>
		<td>
			<table width="750" border=0 cellspacing="0" cellpadding="0">	
				<tr>
				<td><img src="images/im1.jpg" alt="Deal4Loans" width="750" height="215" /></td>
			  </tr>
			 <tr>
				<td height="24" style="background-image:url(images/bg2.jpg); background-repeat:no-repeat; background-position:right; padding-left:25px"><h1>Now watch all Banks compete to give you their Best Rates</h1></td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="59%" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td><img src="images/im2.jpg" width="445" height="52" /></td>
							  </tr>
							  <tr>
								<td style="padding-left:24px; padding-top:22px;"><p><img src="images/bullet.jpg" width="8" height="11" /> <span class="style1">Post your Personal loan requirement</span><br />
							      <img src="images/bullet.jpg" width="8" height="11" /> <span class="style1">Get &amp; compare offers from all Banks.</span><br />
							    <img src="images/bullet.jpg" width="8" height="11" /> <span class="style1">Go with the lowest bank.</span></p>
							    <span class="style2">www.deal4loans.com</span><br />
							    <span class="style1">The one-stop shop for best on all Personal loan requirements<br />
Now get offers from <strong>ICICI, HDFC, Deutsche, Citibank, HSBC,  Kotak,</strong><br />
<strong>Standard Chartered,</strong> and<strong> IDBI</strong> and choose the best deal! </span><br /><br />
									<table width="390" height="150" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td valign="top" style="background-image:url(images/bg.jpg); padding-top:28px;;"><span class="style3">Testimonials</span><br />
										   <span class="style1">I think that the launch of a service like www.deal4loans.com will ease<br />
										    the loan seeking and deal hunting process for the likes of me.<br />
									    I wish u guys all the success.<br /> - Divya</span></td>
									  </tr>
								  </table>

								</td>
							  </tr>
						  </table>

						</td>
						<td width="41%" valign="top"><table style="background-color:#c0d8ef;" width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td style="padding-left:12px; padding-right:12px; padding-bottom:12px; padding-top:12px">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td colspan="2" class="style2">Personal Loan Request - Step 1 of 2</td>
									  </tr>
									  <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
									  <input type="hidden" name="Type_Loan" value="Req_Loan_Home">
									  <input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>" />
									  <input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
									  <input type="hidden" name="source" value="<? echo $_REQUEST['source'] ?>">
									  <input type="hidden" name="last_id" value="<? echo $last_id; ?>">
			 						  <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
									  <?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Full Name :</td>
										<td width="40%"><input class="inp" size="39" value="Full Name" name="Name"  style="float: left" onBlur="onBlurDefault(this,'Full Name');"  onFocus="onFocusBlank(this,'Full Name');"></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">DOB : dd/mm/yyyy </td>
										<td width="40%"><input name="day" class="inp1" value="dd" type="text" id="day" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');">
			<input name="month" id="month" class="inp1"  maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');">
			<input name="year" class="inp2" type="text" id="year" value="yyyy" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');"></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Mobile No.: </td>
										<td width="40%"><input type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="inp" name="Phone"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }?> onFocus="return Decorate('Please give correct Mobile number,to activate your loan request.')"  onBlur="return Decorate1(' ')"></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Email ID : </td>
										<td width="40%"><input class="inp" size="39" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? } else {?>value="Email Id"<? }?> name="Email"  style="float: left" onBlur="onBlurDefault(this,'Email Id');"  onFocus="onFocusBlank(this,'Email Id');"></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" valign="top" class="style4">Residence Address : </td>
										<td width="40%"><textarea rows="2" name="Residence_Address" cols="13" class="inp3"> </textarea></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Cities : </td>
										<td width="40%"><select size="1" align="left"  name="City" onChange="othercity1(this)" class="inp">
										 <?=getCityList1($City)?>
										 </select></td>
									  </tr><tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Other Cities : </td>
										<td width="40%"><input size="39" class="inp" disabled value="Other City"  onfocus="this.select();" name="City_Other" style="float: left" onBlur="onBlurDefault(this,'Other City');"></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Pin Code : </td>
										<td width="40%"><input class="inp" id="PinCode"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="this.select();" name="Pincode" style="float: left" maxlength="6"></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Employment Status : </td>
										<td width="40%"><select align="left" class="inp"  name="Employment_Status">
											<option selected value="-1">Employment Status</option>
											<option  value="1">Salaried</option>
											<option value="0">Self Employed</option>
											</select></td>
									  </tr>
									  
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Annual Income  :</td>
										<td width="40%"><input class="inp" value="Annual Income" name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('IncomeAmount','formatedIncome','wordIncome'); onBlurDefault(this,'Annual Income');"><br> <span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Loan Amount  :</td>
										<td width="40%"><input class="inp" value="Loan Amount" name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" style="float: left" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onBlur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); onBlurDefault(this,'Loan Amount');"><br> <span id='formatedlA' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
									  		<td colspan="2">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													  <tr>
														<td width="1%" valign="top"><input type="checkbox" class="style4" name="accept" checked></td>
														<td width="99%" class="style4"> I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</td>
													  </tr>
											  </table>											</td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:10px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">&nbsp;</td>
										<td width="40%"><input  type="image" src="images/submit.jpg" style="border: 0px;"></td>
									  </tr>
								  </table>

								</td>
							  </tr>
							</table>
						</td>
					  </tr>
				  </table>
					
				</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td class="style4" style="padding-left:24px; padding-top:22px;"><h2>Helpful tips to look/compare/apply for loans to get the best deal.
						</h2>
						  <span class="style4"><strong>Personal loans</strong> are provided on the basis of your income, mainly estimation given by banks is on the basis of your income &<br>
most of loans are happening on the basis of the track record of the customer with any bank. <strong>Credit card usage/payments</strong><br /> also impact your<strong> personal loan eligibility</strong> & rates as it is an unsecured loan so banks try gauging your intention to pay loan.<br /> Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the<br /> variables before signing a loan agreement by different banks. The various parameters that you need to compare on Personal<br /> loan are :</span><br />
<br />
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="79%"><img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Eligibility.</span><br />
<img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Interest rates best suited.</span><br />
<img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Processing Fees.</span><br />
<img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Pre-payment/Foreclosure charges.</span><br />
<img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Document required.</span> <br />
<img src="images/bullet1.jpg" width="8" height="11" /><span class="style4"> Turn Around Time.</span></td><td width="21%" valign="bottom" style="padding-right:35px;"><div align="right"><img src="images/im3.jpg" width="94" height="30" /></div></td>
</tr>
</table>
						</td>
					 </tr>
				</table></td>
			  </tr>
			  <tr><td style="height:30px">&nbsp;</td></tr>
			</table>

		</td>
	</tr>
</table>
  </form>
  <script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>

</body>
</html>
