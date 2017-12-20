 <?php
//ob_start( 'ob_gzhandler' );
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'show_quotecount.php';
	$page_name = "Home Loan";
	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
	
	if(strlen($_REQUEST["source"])>0)	{		$srce=$_REQUEST["source"];	}	else	{		
		if(strlen($_REQUEST["srcbnr"])>0)
		{
			$srce=$_REQUEST["srcbnr"];	}
	
	else
	{
		$srce="GOOG_D4L_newhomeloan1";
	}
	}

if($srce=="inuxuhl")
{
}
else
{
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="homeloan-landing-page.css" type="text/css" rel="stylesheet"  />
 <script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style type="text/css">
.bldtxt {font-weight:bold; line-height:16px; color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }
.nrmltxt {line-height:16px;	color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }
.orgtext {color:#d75b10;	line-height:16px;	font-weight:bold;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:10px; }
#slider {width:590px;	margin:0 0 0 50px; }
body{	margin:0px;	padding:0px; font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	line-height:16px;	color:#292323; }
input{	margin:0px;	padding:0px; border:1px solid #878787; }
select{	margin:0px;	padding:0px; border:1px solid #878787; }
.orgtext{	color:#d75b10;	line-height:16px;	font-weight:bold;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:10px; }
.nrmltxt{ font-weight:normal; text-align:justify;	line-height:16px;	color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }
.nrmltxt span{font-weight:bold;	color:#a9643a;	font-size:12px; }
.bldtxt{ font-weight:bold; line-height:16px; color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }
#mainContainer{	width:660px;	margin:0 auto;	text-align:left;	height:100%;			border-left:3px double #000;	border-right:3px double #000;	}
#formContent{		padding:5px;	}
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
	z-index:100;
	}
#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
	margin:1px;			padding:1px;	cursor:pointer;	font-size:10px;	}

#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
	background-color:#2375CB;	color:#FFF;	}
#ajax_listOfOptions_iframe{	background-color:#F00;	position:absolute;	z-index:5;	}
form{	display:inline;	}
.alert_msg { color:#F00;}
</style>
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
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
	}
	return true;
}
	function Decoration(strPlan){       if (document.getElementById('plantype') != undefined)         {               document.getElementById('plantype').innerHTML = strPlan;			   document.getElementById('plantype').style.background='Beige';         }       return true; }
function Decoration1(strPlan){       if (document.getElementById('plantype') != undefined)        {               document.getElementById('plantype').innerHTML = strPlan;			   document.getElementById('plantype').style.background='';  			                           }       return true; }
function Decorate(strPlan) {       if (document.getElementById('plantype2') != undefined)         {               document.getElementById('plantype2').innerHTML = strPlan;			   document.getElementById('plantype2').style.background='Beige';         }       return true; }
function Decorate1(strPlan) {       if (document.getElementById('plantype2') != undefined) { document.getElementById('plantype2').innerHTML = strPlan;   document.getElementById('plantype2').style.background='';  }       return true;}
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

	if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
	{	//alert("Kindly fill in your Loan Amount (Numeric Only)!");	
		document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";
		Form.Loan_Amount.focus();	return false;	}
	else if(containsalph(Form.Loan_Amount.value)==true)
	{			document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";	Form.Loan_Amount.focus();	return false;	}
	
	if(Form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";	
		Form.Employment_Status.focus();
		return false;
	}
	if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";		Form.IncomeAmount.focus();		return false;	}
	
	if(Form.City.selectedIndex==0)
	{			document.getElementById('cityVal').innerHTML = "<span class='hintanchor'>Enter City to Continue!</span>";		Form.City.focus();		return false;	}
	else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
	{	document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";	Form.City_Other.focus();	return false;	}

	
	
	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
      document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		Form.Name.focus();	return false;	
	}
	else if(containsdigit(Form.Name.value)==true)
	{
	//	alert("Name contains numbers!");
        document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Name contains number</span>";		
		Form.Name.focus();
		return false;
	}
	  for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
		//alert ("Name has special characters.\n Please remove them and try again.");
		      document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Contains special characters!</span>";		
		Form.Name.focus();
		return false;
		}
	  }
	  
	if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
//	alert("Kindly fill in your Mobile Number!");
	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
	Form.Phone.focus();
	return false;
	}
	
		  if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
//				  alert("Enter numeric value");
				  document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
				  Form.Phone.focus();
				  return false;  
			}
			if (Form.Phone.value.length < 10 )
			{
//					alert("Please Enter 10 Digits"); 
					document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill 10 digits!</span>";
					 Form.Phone.focus();
					return false;
			}
			if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
			{
				//alert("The number should start only with 9 or 8 or 7");
				document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";
				Form.Phone.focus();
				return false;
			}	
		  if(Form.Email.value=="")
	  {		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	
	
	
	if(!Form.accept.checked)
	{	document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	Form.accept.focus();	return false;	}
}
function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}
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
function othercity1()
{
	var ni1 = document.getElementById('othCitDiv');
	var ni2 = document.getElementById('othCitvalDiv');
	if(document.home_loan.City.value=='Others')
	{
		ni1.innerHTML = 'Other City';
		ni2.innerHTML = '<input value="Other City" name="City_Other" id="City_Other" style="width: 140px;" onBlur="onBlurDefault(this,\'Other City\');"  onfocus="onFocusBlank(this,\'Other City\');" onKeyUp="searchSuggest();" /><div id="CityOLayer"></div><div id="othercityVal"></div>';
	}
	else	
	{
		ni1.innerHTML = '';
		ni2.innerHTML = '';
	}
}
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){		element.value="";	}
}
function onBlurDefault(element,defaultVal){
	if(element.value==""){		element.value = defaultVal;	}
}
function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
</script>
  <script>
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
function addtooltip()
{
		var ni = document.getElementById('myDiv');
		if(ni.innerHTML=="")
		{				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';		}
		return true;
	}
function removetooltip()
{
		var ni = document.getElementById('myDiv');
		if(ni.innerHTML!="")
		{				ni.innerHTML = '';		}
		return true;
}


function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
//	var ni3 = document.getElementById('addPadding1');
	//var ni4 = document.getElementById('addPadding2');
//	var ni5 = document.getElementById('addPadding3');
	//var ni6 = document.getElementById('hideHeader');
		
	ni1.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2" class="text_a"><table width="98%" border="0" cellspacing="0" cellpadding="0"><tr><td width="41%" style="color:#187abe;">Personal Details</td><td width="59%" style="font-size:11px; color:#187abe;"><img src="images/lock-image.png" width="9" height="13"> We keep this secure</td></tr></table></td></tr><tr><td class="form_body_text" width="31%">First Name</td><td width="69%"><input type="text" name="Name" id="Name" value="<? if(isset($loan_type)) {  echo $name;  }?>" class="input" onKeyDown="validateDiv(\'nameVal\');" tabindex="5" /><div id="nameVal" class="alert_msg" ></div></td></tr><tr><td class="form_body_text">Mobile No.</td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="10%" class="form_body_text">+91</td><td width="90%"><input type="text" class="mobo" maxlength="10"  name="Phone" id="Phone"  value="<? if(isset($loan_type)) echo $mobile; ?>"  onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" onKeyDown="validateDiv(\'phoneVal\');"  tabindex="6"/><div id="phoneVal" class="alert_msg"></div></td></tr></table></td></tr><tr><td class="form_body_text">Email</td><td><input class="input" value="<? if(isset($loan_type)) echo $Email; else "Email Id" ?>" name="Email" id="Email" onBlur="onBlurDefault(this,\'Email Id\');"  onFocus="removetooltip();"  onChange="insertData();" onKeyDown="validateDiv(\'emailVal\');" tabindex="7" /><div id="emailVal" class="alert_msg"></div></td></tr><tr><td class="form_body_text">&nbsp;</td><td>&nbsp;</td></tr><tr><td colspan="2" class="form_body_text" style="font-size:10px;"><input type="checkbox" tabindex="8"  name="accept" style="border:none;" checked  > I authorize Deal4loans.com &amp; its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" >Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td></tr><tr><td height="50" colspan="2" align="center" class="form_body_text"><input type="image" tabindex="9" name="Submit"  src="images/get-quote-btn-homeloan.png"  style="width:192px; height:46px; border:none; " /></td></tr></table>';
	ni2.innerHTML = '';
	
}
	
function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.home_loan.City.value;
//	var otrcit = document.loan_form.City_Other.value;
	
	if(cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" || cit =="Chennai")
	{
		//alert("ranjana");
	ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#000000; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#00000; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}

		function insertData()
		{
			var get_full_name = document.getElementById('Name').value;
			var get_email = document.getElementById('Email').value;
			var get_mobile_no = document.getElementById('Phone').value;
			var get_city = document.getElementById('City').value;
			var get_id = document.getElementById('Activate').value;
			var get_product ="2";
			var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				ajaxRequest.open("GET", "insert-incomplete-data.php" + queryString, true);
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{						document.getElementById('Activate').value=ajaxRequest.responseText;				}
				}
				ajaxRequest.send(null); 
		}
	window.onload = ajaxFunction;
    </script>

</head>

<body>
<div class="main_container">
<div class="logo"><img src="images/d4l-logo-new-home-loan.png" width="152" height="65" /></div>
<div class="second_container_box">
<div class="form_box">
<? if($srce=="netcorehl" || $srce=="inuxuhl" || $_REQUEST["srcbnr"]=="inuxuhl" || $srce=="timesjobhl" || $srce=="shopatbesthl" || $srce=="AFL_MLR_SHOPATBEST_HL" || $srce=="proformicshl")
{ ?>
<form name="home_loan" action="applyfor-home-loan-validate.php" onSubmit="return submitform(document.home_loan);" method="post">     <? }
else
{ ?>
<form name="home_loan" action="apply-home-loan-continue.php" onSubmit="return submitform(document.home_loan);" method="post">       
<? } ?>      <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
			<input type="hidden" name="Type_Loan" value="Req_Loan_Home">
			<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
			<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
			<input type="hidden" name="source" value="<? echo $srce; ?>">
			<input type="hidden" name="last_id" value="<? echo $last_id; ?>">
            <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="text_a" style="color:#187abe;">Get Eligibility &amp; EMI Quote from 5 Nationalized  &amp; 7 Private Banks</td>
    </tr>
    <tr>
      <td class="form_body_text">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="31%" class="form_body_text">Loan Amount</td>
      <td width="69%"><input name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');"  onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanVal');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" tabindex="1" class="input" /><div id="loanVal"  class="alert_msg"></div></td>
    </tr>
    <tr>
      <td colspan="2"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span>    </td>
</tr>
    <tr>
      <td class="form_body_text">Occupation</td>
      <td><select name="Employment_Status" id="Employment_Status" onChange="validateDiv('empStatusVal');" class="select" tabindex="2">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusVal" class="alert_msg"></div>
        
      </td>
    </tr>
    <tr>
      <td class="form_body_text">Annual Income</td>
    <td><input   name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');"  class="input" onBlur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onKeyDown="validateDiv('netSalaryVal');" tabindex="3"/><div id="netSalaryVal" class="alert_msg"></div>    </td>
  </tr>
              <tr>
                                <td align="left" valign="middle" colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td>
                              </tr>
    <tr>
      <td class="form_body_text">City</td>
      <td><select tabindex="4" class="select" name="City" id="City" onChange=" addPersonalDetails(); othercity1(); validateDiv('cityVal');" ><?=getCityList1($City)?></select><div id="cityVal" class="alert_msg"></div>
          </td>
    </tr>
    <tr>
      <td class="form_body_text">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="form_body_text">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" id="personalDetails" style="padding-top:4px;">
    <img src="images/get-quote-btn-homeloan.png" width="192" height="46" />
  </td></tr>
    <tr>
      <td colspan="2" align="center" style="padding-top:4px;">&nbsp;</td>
    </tr>
    
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" id="personalDetails4" style="padding-top:4px;">&nbsp;</td>
    </tr>
  </table>
 </form>
</div>
<div class="right_box">
<div class="row_a">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" align="center" class="text_c">Sample Home Loan Quotes</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="12%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">Bank</td>
          <td width="19%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">Interest Rate</td>
          <td width="28%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">Eligible Loan Amt.</td>
          <td width="23%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">EMI</td>
          <td width="18%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">Document</td>
        </tr>
        <tr>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF; color:#d07f18;"><strong>Bank A</strong></td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">9.95%</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 23,00,000</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 22,119</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF; font-size:10px;">Bank Stat,<br />
            Salary Slip</td>
        </tr>
        <tr>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF; color:#d07f18;"><strong>Bank B</strong></td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">10.20%</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 25,00,000</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 24,457</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text" style="border-right:thin solid #FFF;"><span class="table_text_b" style="border-right:thin solid #FFF; font-size:9px;">Bank Stat,<br />
Salary Slip</span></td>
        </tr>
        <tr class="table_text_b">
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF; color:#d07f18;"><strong>Bank C</strong></td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">10.50%</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 26,00,000</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 25,958</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text" style="border-right:thin solid #FFF;"><span class="table_text_b" style="border-right:thin solid #FFF; font-size:9px;">Bank Stat,<br />
Salary Slip</span></td>
        </tr>
        <tr class="table_text_b">
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text" style="border-right:thin solid #FFF; color:#d07f18;"><strong>Bank D</strong></td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">10.75%</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 27,00,000</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 27,411</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text" style="border-right:thin solid #FFF;"><span class="table_text_b" style="border-right:thin solid #FFF; font-size:9px;">Bank Stat,<br />
Salary Slip</span></td>
        </tr>
      </table></td>
    </tr>
   
  </table>
  </div>
  <div class="row_a margin_top"><span class="list_text_head">List of top Home Loans Banks in India</span><br />
    <span style="font-size:15px; color:#156dd1;">SBI (State Bank of India),</span> <span style="color:#da251c;">Hdfc Ltd,</span> <span style="color:#1a5b9b;">LIC Housing,</span> <span style="color:#942b25;">ICICI Bank,</span><br />
   <span style="color:#aa2a5d;"> Axis Bank,</span> <span style="color:#1c689a;">Bajaj Finserv,</span> <span style="color:#820606;">PNB Housing Finance</span></div>
   
   <div class="row_a margin_top" style="border:none;"><div class="list_text_head" style="color:#187abe;">Why Deal4loans.com</div>
   <div class="right_box_text">
   <ul>
   <li>Instant EMI &amp; Eligibility offer from 4 nationalized and 5 Private Banks</li>
   <li>Choose best deal for lowest EMI, Best Eligibility</li>
   <li>Home Loan Quotes are free for customers.  It's a totally free service for customers</li>
   <li>Your information will not be shared with anyone without your consent.</li>
   <li>Over <strong style="color:#F60; font-size:24px;"><? echo $total_homeloan_taken; ?></span></strong> customers have taken quote at <strong style="color:#187abe; font-size:15px;">Deal4loans.com</strong></li>
   </ul>
   <span style="text-align:right;">*All loans repayment period are over 6 months. No short term loans</span>
   </div>
   </div>
   
</div>

<div style="clear:both;"></div>
 
</div>
<div class="bottom_box margin_2">
<div class="bottom_left">
  <p ><span class="list_text_head">Helpful tips to Get the Best Home Loan Deal</span> <br />
    Home loans are provided based on the market value, mainly estimation given by banks or the registration value of the property. Home loan is not a one-time decision; do review the market periodically before availing them. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Home loan are 
  </p>
  <p>» Eligibility <br />
    » Interest rates best suited.<br />
    » Fixed interest loans or Floating. <br />
    » Other costs. <br />
    » Document required. <br />
    » Penalties.</p>
</div>
<div class="bottom_right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/animated-offer-img.gif" width="295" height="124" /></td>
  </tr>
  <tr>
    <td height="0" >&nbsp;</td>
  </tr>
  <tr>
    <td height="146" ><table width="286" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="146" valign="top" background="images/testimonial-bg.gif" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="text_c" style="color:#FFF;">Testimonials</td>
      </tr>
      <tr>
        <td class="table_text">I was able to understand how much Home loan i can get and what are best options- 
          Thanks-
          <br />
          <br />
          Ravi Sharma<br />
            New Delhi</td>
      </tr>
    </table></td>
  </tr>
  </table>
</td>
  </tr>
<tr><td>
<?php include 'footer_landingpage.php'; ?>
</td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>

</div>

</div>
<?php include "analytics.php"; ?>
</body>
</html>
<? 
} 
?>