<?php
	require 'scripts/session_check.php';
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$page_name = "Home Loan";
?>	
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home loan Emi Calculator | Instant Home loan Emi Calculator</title>
<meta name="keywords" content="Instant Home loan Calculator, Compare Home Loan EMI, Compare Home Loan Eligibility in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
 <script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script language="JavaScript" type="text/javascript" src="suggest.js"></script>
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true	
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
<style  >
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;
}
input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}
select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}
.orgtext{
	color:#d75b10;
	line-height:16px;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
}
.nrmltxt{
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}
.nrmltxt span{
	font-weight:bold;
	color:#a9643a;
	font-size:12px;
}
.bldtxt{
	font-weight:bold;
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}
/* START CSS NEEDED ONLY IN DEMO */
#mainContainer{
	width:660px;
	margin:0 auto;
	text-align:left;
	height:100%;		
	border-left:3px double #000;
	border-right:3px double #000;
	}
#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	/* Big box with list of options */
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
	position:absolute;
	z-index:5;
	}
form{
	display:inline;
	}
#slider{
	width:590px;
	margin:0 0 0 50px;
 }	
#slider ul, #slider li{
	margin:0;
	padding:0;
	list-style:none;
}
#slider li{ 
	/* 
	define width and height of list item (slide)
	entire slider area will adjust according to the parameters provided here
	*/ 
	width:590px;
	height:65px;
	overflow:hidden; 
}
#slider li div{
	display:block;
	float:left;
	width:143px;
 }
p#controls{
	margin:-76px 0 0 15;
	position:relative;
	width:650px;
} 
	
#prevBtn, #nextBtn{ 
	display:block;
	overflow:hidden;
	text-indent:-8000px;		
	width:36px;
	height:80px;
	position:absolute;
}	

#nextBtn{ 
	left:605px;
}														
#prevBtn a, #nextBtn a{  
	display:block;
	width:36px;
	height:84px;
	background: url(new-images/hl/slider/prv-btn.jpg) no-repeat left center;
 
}	

#nextBtn a{ 
	background: url(new-images/hl/slider/nxt-btn.jpg) no-repeat left center;
}	
.alert_msg{color:#FF0000; font-weight:bold; font-size:10px;}
.bldtxt {font-weight:bold; line-height:16px; color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }
.nrmltxt {line-height:16px;	color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }											
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



function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
	var ni3 = document.getElementById('addPadding1');
	var ni4 = document.getElementById('addPadding2');
	var ni5 = document.getElementById('addPadding3');
	var ni6 = document.getElementById('hideHeader');
		
	ni1.innerHTML = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td align="left" valign="middle" class="bldtxt" colspan="2" style="padding-top:3px;" ><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td align="left" style="font-size:13px; color:#156dd1; font-weight:bold; " colspan="2"> Personal Details</td></tr><tr><td width="7%" style="font-size:10px; font-weight:normal; color:#999999;" valign="top"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"></td><td width="93%" align="left"class="sbi_text_a"  style="font-size:10px; font-weight:normal; color:#156dd1;">Your Information is secure with us & will not be shared without your consent</td></tr></table></td></tr>   <tr>    <td width="42%" height="35" class="bldtxt">First Name</td>    <td width="58%"><input type="hidden" name="onCloseValue" id="onCloseValue" value="1">								<input type="text" name="Name" id="Name" value="<? if(isset($loan_type)) {  echo $name;  }?>"  style="width:140px;" onKeyDown="validateDiv(\'nameVal\');" tabindex="1" /><div id="nameVal" class="alert_msg" ></div></td>  </tr>  <tr>    <td height="28" class="bldtxt">Mobile No.</td>    <td> <span class="bldtxt">+91</span>     <input type="text"  style="width:113px;" maxlength="10"  name="Phone" id="Phone"  value="<? if(isset($loan_type)) echo $mobile; ?>"  onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" onKeyDown="validateDiv(\'phoneVal\');"  tabindex="2"/><div id="phoneVal" class="alert_msg"></div></td>  </tr>    <tr>    <td height="28" class="bldtxt">Email</td>    <td><input class="style4" style="width:140px;" value="<? if(isset($loan_type)) echo $Email; else "Email Id" ?>" name="Email" id="Email" onBlur="onBlurDefault(this,\'Email Id\');"  onFocus="removetooltip();"  onChange="insertData();" onKeyDown="validateDiv(\'emailVal\');" tabindex="3" /><div id="emailVal" class="alert_msg"></div></td>  </tr>       <tr><td id="hdfclife" colspan="2"></td></tr> <tr><td colspan="2">&nbsp;</td></tr>  <tr>    <td height="0" colspan="2"align="center" class="bldtxt" style="font-size:10px; text-align:left;"><input type="checkbox" tabindex="8"  name="accept" style="border:none;" checked  > I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td>  </tr>  <tr>    <td height="0" colspan="2" align="center">&nbsp;</td>  </tr>  <tr>    <td colspan="2" align="center"><input type="image" tabindex="9" name="Submit"  src="new-images/hl/pl-quote.gif"  style="width:117px; height:29px; border:none; " /></td>    </tr>    </table>';
	ni2.innerHTML = '';
	ni3.innerHTML = '';
	ni4.innerHTML = '';
	ni5.innerHTML = '';
	ni6.innerHTML = '';	
	
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

function othercity1()
{
	if(document.home_loan.City.value=='Others')
	{
		document.home_loan.City_Other.disabled=false;
		document.home_loan.City_Other.focus();
	}
	else
	{
		document.home_loan.City_Other.disabled=true;
		document.home_loan.City_Other.focus();
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
		{
		
			//if(document.loan_form.Phone.value!="")
			//{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
			//}
		}
		
		return true;

	}


function removetooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
//			if(document.loan_form.Phone.value!="")
	//		{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
		//	}
		}
		
		return true;

	}
		function insertData()
		{
			var get_full_name = document.getElementById('Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="2";

				var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
				//alert(queryString); 
				ajaxRequest.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
			 
		}

	window.onload = ajaxFunction;


</script>

</head>

<body onbeforeunload="HandleOnClose('closedby_hl.php')">
<table width="1004" border="0" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<tr>
            <td colspan="4"><img src="new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/></td></tr>
         
          <tr>
            <td colspan="4"><table width="99%"  border="0"   cellpadding="0" cellspacing="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
			   <tr>
                <td height="25" style="padding-left:10px;" ><div style="color:#5e5e5e; font-size:13px; font-weight:bold;line-height:24px;  ">Home loan Emi Calculator | Instant Home loan Emi Calculator</div></td>
              </tr>
              <tr>
                <td height="25" style="padding-left:10px; padding-bottom:10px;" ><img src="new-images/sample_quote.jpg" style="border:1px solid #333333;"><!--<img src="new-images/sampleHLrates.gif" style="border:1px solid #333333;"> --></td>
              </tr>
              <tr>
                <td height="25"  style=" padding-left:10px; " ><img src="new-images/hl/why-d4l.gif" width="173" height="21"></td>
              </tr>
              <tr>
                <td height="25"  style="padding-left:15px; " ><table width="650" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #def3f8; ">
                  <tr>
                    <td ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td width="623"><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Instant quote on how much Home loan you can get based on your profile.</div></td>
                      </tr>

                     <tr>
                        <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Get quote from major banks on Emi.</div></td>
                      </tr>
					   <tr>
                        <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Compare Emi of all Banks.
</div></td>
                      </tr>
                      <tr>
                        <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Choose lowest Emi and processing fee.</div></td>
                      </tr>
                      <tr>
                        <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Home Loan Quotes are free for customers. It's a totally free service for customers.</div></td>
                      </tr>
                       <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Over 26 lakh customers have taken quote at Deal4loans.com.</div></td>
                      </tr>
                       <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Your information will not be shared with anyone without your consent.</div></td>
                      </tr> 
                       <tr>
                        <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">	Largest network of private Banks and agent network of PSU Banks.</div></td>
                      </tr> 
                    </table></td>
                  </tr>
                </table></td>
              </tr>
			  <tr><td>&nbsp;</td></tr>
             
              <tr>
                <td width="674" class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
              </tr>
         
      
             
            </table></td>
            </tr>
        </table></td>
        <td width="322" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="289" height="88" align="left" valign="top"><img src="images/hl/hemifrm-hdng1.jpg" width="289" height="88" /></td>
              </tr>
             
              <tr>
                <td valign="top" style="border-left:2px solid #454545; border-right:2px solid #454545; padding-top:15px;">
				<form name="home_loan" action="home-loan-apply-continue.php" onSubmit="return submitform(document.home_loan);" method="post">
                 <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
                                    <input type="hidden" name="Type_Loan" value="Req_Loan_Home">
                                    <input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
                                    <input type="hidden" name="section" value="self">
                                    <input type="hidden" name="source" value="GHL_EMI">
                                    <input type="hidden" name="last_id" value="<? echo $last_id; ?>">
                                    <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                          
                           <tr><td  colspan="2">  <div id="hideHeader"  style=" color:#0c6ad4; font-size:11px; text-transform:capitalize; padding-left:5px; margin-top:-8px;">
  <strong style="color:#c99926;">Bank A</strong> - Rates as low as 9.95%<span style="color:#FF0000; font-weight:bold;">*</span> <br> <strong style="color:#c99926;">Bank B</strong>- Fixed rate for 10 years.<span style="color:#FF0000; font-weight:bold;">*</span><br> <strong style="color:#c99926;">Bank C</strong>- Last 12 month Emi waived off<span style="color:#FF0000; font-weight:bold;">*</span><br />Check Your Free Customized Offers From 10 Other Banks.</div></td></tr>
  
  <tr><td colspan="2" class="bldtxt"  style="font-size:13px; color:#156dd1; padding-top:6px; padding-bottom:6px; ">
  Professional Details
  </td></tr>
  
  
  <tr>
    <td height="28" align="left" class="bldtxt" valign="top" >Loan Amount</td>
    <td valign="top"><input  name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" style="width:140px;" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanVal');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount');" tabindex="7" /><div id="loanVal"  class="alert_msg"></div>
   
                                  </td>
  </tr>
     <tr>
		<td colspan="2" align="left" valign="middle" class="bldtxt"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span>    <div id="addPadding"><img src="http://www.deal4loans.com/images/spacer.gif" style="height:30px;" ></div></td>
     </tr>
   <tr>
            <td height="28" class="bldtxt"  valign="top"><span class="nrmltxt1" style="color:#4b4b4b;">Occupation</span></td>
            <td><select style="width:140px;" name="Employment_Status" id="Employment_Status" onChange="validateDiv('empStatusVal');">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusVal" class="alert_msg"></div>
                <div id="addPadding1"><img src="http://www.deal4loans.com/images/spacer.gif" style="height:30px;" ></div>
            </td>
          </tr>
           <tr>
    <td height="28" class="bldtxt"  valign="top">Annual Income</td>
    <td valign="top"><input   name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDiToWordsIncome('IncomeAmount','formatedIncome','wordIncome');" style="width:140px;" onBlur="getDiToWordsIncome('IncomeAmount', 'formatedIncome', 'wordIncome');" onKeyDown="validateDiv('netSalaryVal');" tabindex="6"/><div id="netSalaryVal" class="alert_msg"></div>    </td>
  </tr>
              <tr>
                                <td width="166" align="left" valign="middle" class="bldtxt" colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> <div id="addPadding2"><img src="http://www.deal4loans.com/images/spacer.gif" style="height:30px;" ></div></td>
                              </tr>
                               <tr>
    <td height="28" class="bldtxt" valign="top" >City</td>
    <td><select tabindex="4" style="width:140px;"  name="City" id="City" onChange=" addPersonalDetails(); othercity1(); validateDiv('cityVal');" ><?=getCityList1($City)?></select><div id="cityVal" class="alert_msg"></div>    <div id="addPadding3"><img src="http://www.deal4loans.com/images/spacer.gif" style="height:30px;" ></div></td>
  </tr>

  <tr>
    <td class="bldtxt" id="othCitDiv"></td>
    <td id="othCitvalDiv"></td>
  </tr>
     <tr>
    <td colspan="2" align="center" id="personalDetails" style="padding-top:4px;">
    <img src="new-images/hl/pl-quote.gif" width="117" height="29" />
</td></tr>
          </table>
</form></td>
              </tr>
              <tr>
                <td valign="top"><img src="images/hl/frm-btm1.gif" width="289"   height="21"></td>
              </tr>
              <tr>
                <td height="10" ></td>
              </tr>
              <tr>
                           <td valign="middle" height="120"><img src="new-images/hl/step-ban.gif" width="289" height="108" /></td>

              </tr>
            </table></td>
            <td width="33" height="336" align="right" valign="top"><!--<img src="new-images/hl/frm-rgt.gif" width="33" height="336" />--></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<tr><td>
<?php include 'footer_landingpage.php'; ?>
</td></tr>
  <Tr>
  <td>&nbsp;</td>
  </Tr>
</table>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
