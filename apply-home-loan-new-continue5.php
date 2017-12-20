<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/functions.php';

	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/hl-lpnew.css" rel="stylesheet" type="text/css">
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
 #slider{	width:590px;	margin:0 0 0 50px; }	
#slider ul, #slider li{	margin:0;	padding:0;	list-style:none; }
#slider li{ 
	/* 
	define width and height of list item (slide)
	entire slider area will adjust according to the parameters provided here
	*/ 
	width:590px;	height:65px;	overflow:hidden; }
#slider li div{	display:block;	float:left;	width:143px; }
p#controls{	margin:-76px 0 0 15;	position:relative;	width:650px; } 
#prevBtn, #nextBtn{ 	display:block;	overflow:hidden;	text-indent:-8000px;			width:36px;	height:80px;	position:absolute; }	
#nextBtn{ 	left:605px; }														
#prevBtn a, #nextBtn a{ 	display:block;	width:36px;	height:84px;	background: url(new-images/hl/slider/prv-btn.jpg) no-repeat left center; }	
#nextBtn a{ 	background: url(new-images/hl/slider/nxt-btn.jpg) no-repeat left center; }	
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
	
	if(Form.City.selectedIndex==0)
	{			document.getElementById('cityVal').innerHTML = "<span class='hintanchor'>Enter City to Continue!</span>";		Form.City.focus();		return false;	}
	else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
	{	document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";	Form.City_Other.focus();	return false;	}
	if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";		Form.IncomeAmount.focus();		return false;	}
	if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
	{	//alert("Kindly fill in your Loan Amount (Numeric Only)!");	
		document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";
		Form.Loan_Amount.focus();	return false;	}
	else if(containsalph(Form.Loan_Amount.value)==true)
	{			document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";	Form.Loan_Amount.focus();	return false;	}
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

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
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
	<style>
	
	</style>

</head>

<body>
<div id="pagewrap">

  <header id="header_new">
<div id="site-logo"><img src="images/logo.gif"></div>
  </header>
  <div style="clear:both;"></div>
	
  <div id="content_new_bnr">

		<article >
		  <div style=" float:left;"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
		    <tr>
		      <td width="100%">
             
              </td>
	        </tr>
	      </table>
          </div>
         <div id="content_bnr" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF" class="bod_text">Why Deal4loans.com</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="height:10px;"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><div class="why_deal">
      <blockquote>&nbsp;</blockquote>
      <table width="95%" border="0" align="center" style="padding:5px; border:2px solid #def3f8; " cellpadding="0" cellspacing="0">
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Instant EMI &amp; Eligibility offer from all Banks</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;" ></td>
        </tr>
        <tr>
          <td width="6%" bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td width="94%" bgcolor="#FFFFFF" class="td_bg">Choose best deal for lowest EMI, Best Eligibility</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;"></td>
        </tr>
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Home Loan Quotes are free for customers.</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;"></td>
        </tr>
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Your information will not be shared with anyone without your consent.</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;">&nbsp;</td>
          </tr>
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Over 26 lakh customers have taken quote at Deal4loans.com</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td bgcolor="#FFFFFF" class="form_text_pl"><table width="99%"  border="0"   cellpadding="0" cellspacing="0">
          <tr>
            <td height="115" valign="top"  background="new-images/landing-prtnr-bg.jpg" class="sample_box_hide" style="background-repeat:no-repeat; padding-top:42px; "><div id="slider">
              <ul>
                <li>
                  <div align="center" class="orgtext"><img   src="new-images/hl/slider/icici-bank-h.jpg" alt="ICICI Bank Home Loan" width="128" height="47" style="border:none;"/><br>
                    ICICI Bank Home Loan</div>
                  <div align="center" class="orgtext"><img  src="new-images/hl/slider/hdrc-ltd.jpg" alt="HDFC Ltd" width="128" height="47"  style="border:none;"/><br>
                    HDFC Ltd</div>
                  <div align="center" class="orgtext"><img  src="new-images/hl/slider/axis.jpg" alt="Axis Bank" width="128" height="47"  style="border:none;"/><br>
                    Axis Bank</div>
                  <div align="center" class="orgtext"><img  src="new-images/thumb/stanchart.jpg" alt="Standard Chartered" width="128" height="47"  style="border:none;"/><br>
                    Standard Chartered</div>
                  </li>
                </ul>
              </div></td>
            </tr>
          <tr>
            <td width="674" class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
            </tr>
          <tr>
            <td align="center" class="sample_box_hide" ><img src="new-images/sample_quote.jpg" style="border:1px solid #333333;"></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td height="25"  style=" padding-left:10px; " ><img src="new-images/hl/hlpful.gif" width="356" height="20"></td>
            </tr>
          <tr>
            <td class="nrmltxt" style=" padding-left:10px; ">Home loans are provided based on the market value, mainly estimation given by banks or the registration value of the property. Home loan is not a one-time decision; do review the market periodically before availing them. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Home loan are <br>
              <br>
              <b>&raquo; Eligibility <br>
                &raquo; Interest rates best suited.<br>
                &raquo; Fixed interest loans or Floating. <br>
                &raquo; Other costs. <br>
                &raquo; Document required. <br>
                &raquo; Penalties.</b></td>
            </tr>
          </table></td>
      </tr>
      
      </table></td>
  </tr>
  </table>
         </div>
          
   	</article>
                  
  </div>
                      

  <div id="sidebar_bnr">
<div class="widget_b"><img src="new-images/hl/frm-hdng-new.jpg"></div>  

		<section class="widget">
		  <div class="right-box-b">
		  			<form name="home_loan" action="apply-home-loan-new-continue.php" onSubmit="return submitform(document.home_loan);" method="post">                       
          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="42%" height="35" class="form_text_pl">First Name</td>
    <td width="58%"><input type="hidden" name="onCloseValue" id="onCloseValue" value="1">
								<input type="text" name="Name" id="Name" value="<? if(isset($loan_type)) {  echo $name;  }?>"  style="width:140px;" onKeyDown="validateDiv('nameVal');" tabindex="1" /><div id="nameVal" class="alert_msg" ></div></td>
  </tr>
  
  <tr>
    <td height="28" class="form_text_pl">Mobile No.</td>
    <td> <span class="form_text_pl">+91</span>
     <input type="text"  style="width:113px;" maxlength="10"  name="Phone" id="Phone"  value="<? if(isset($loan_type)) echo $mobile; ?>"  onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" onKeyDown="validateDiv('phoneVal');"  tabindex="2"/><div id="phoneVal" class="alert_msg"></div></td>
  </tr>
  
  <tr>
    <td height="28" class="form_text_pl">Email</td>
    <td><input class="style4" style="width:140px;" value="<? if(isset($loan_type)) echo $Email; else "Email Id" ?>" name="Email" id="Email" onBlur="onBlurDefault(this,'Email Id');"  onFocus="removetooltip();"  onChange="insertData();" onKeyDown="validateDiv('emailVal');" tabindex="3" /><div id="emailVal" class="alert_msg"></div></td>
  </tr>
 
  <tr>
    <td height="28" class="form_text_pl">City</td>
    <td><select tabindex="4" style="width:140px;"  name="City" id="City" onChange="othercity1(); insertData(); validateDiv('cityVal');" ><?=getCityList1($City)?></select><div id="cityVal" class="alert_msg"></div></td>
  </tr>

  <tr>
    <td class="form_text_pl" id="othCitDiv"></td>
    <td id="othCitvalDiv"></td>
  </tr>
  
  <tr>
    <td height="28" class="form_text_pl">Annual Income</td>
    <td><input   name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" style="width:140px;" onBlur="getDigitToWords('IncomeAmount', 'formatedIncome', 'wordIncome'); onBlurDefault(this,'Annual Income');" onKeyDown="validateDiv('netSalaryVal');" tabindex="6"/><div id="netSalaryVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="28" align="left" class="form_text_pl">Loan Amount</td>
    <td height="0" align="center"><input   name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" style="width:140px;" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanVal');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount'); onBlurDefault(this,'Loan Amount');" tabindex="7" /><div id="loanVal"  class="alert_msg"></div>
                                    <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
                                    <input type="hidden" name="Type_Loan" value="Req_Loan_Home">
                                    <input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
                                    <input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
                                    <input type="hidden" name="source" value="<? echo $srce; ?>">
                                    <input type="hidden" name="last_id" value="<? echo $last_id; ?>">
            <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></td>
  </tr>
  
  <tr>
    <td height="0" colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="0" colspan="2"align="center" class="form_text_pl" style="font-size:10px; text-align:left;"><input type="checkbox" tabindex="8"  name="accept" style="border:none;" checked  > I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="0" colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="image" tabindex="9" name="Submit"  src="new-images/hl/pl-quote.gif"  style="width:117px; height:29px; border:none; " /></td>
    </tr>
          </table></form>
		  </div></section>
    <div class="widget_c"><img src="http://www.deal4loans.com/new-images/hl/step-ban.gif"></div>
    
        <div id="testi"><div align="center" style="width:210px; margin-left:20px; text-align:left; line-height:15px; padding-top:45px;">I was able to understand how much Home loan i can get and what are best options- Thanks-<br><br>Ravi Sharma<br>New Delhi</div></div>
        
        <div class="image_box_new"><img src="new-images/hl/apply-home-loan-new_sample.gif"></div>

  </div>

	
  </div>
</body>
</html>