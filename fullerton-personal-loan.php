<?php
	session_start();
if(!isset($_SESSION['siten']))
{
	$_SESSION['siten'] ="ndtv";
}
	require '../scripts/functions.php';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loans - Deal4loans</title>
<link rel="stylesheet" href="/style/glowing-blue.css" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="../js/dropdowntabs.js"></script>
<link href="css/ndtvmoney.css" rel="stylesheet" type="text/css" />
<link href="css/pl.css" rel="stylesheet" type="text/css" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript">
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
		
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		document.getElementById('emailShow').innerHTML = error("Invalid E-mail ID!");
		//alert("Invalid E-mail ID.");
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
		document.getElementById('emailShow').innerHTML = error("Invalid E-mail ID!");
		//alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		document.getElementById('emailShow').innerHTML = error("Invalid E-mail ID!");
		//alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		document.getElementById('emailShow').innerHTML = error("Invalid E-mail ID!");
		//alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		document.getElementById('emailShow').innerHTML = error("Invalid E-mail ID!");
		//alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}


function error(str)
{
	return ''+str+'';
}
function chkpersonalloan(Form)
{
	var btn2;
	var btn3;
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
{
document.getElementById('nameShow').innerHTML = error("Kindly fill in your Name!");
Form.Name.focus();
//alert("Kindly fill in your Name!");
//Form.Name.focus();
return false;
}
else if(containsdigit(Form.Name.value)==true)
{
//alert("Name contains numbers!");
document.getElementById('nameShow').innerHTML = error("Name contains numbers!");
Form.Name.focus();

return false;
}
  for (var i = 0; i < Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
 	document.getElementById('nameShow').innerHTML = error("Name has special characters.");
	//alert ("Name has special characters.\n Please remove them and try again.");
	Form.Name.focus();
  	return false;
  	}
  }

if((Form.birth_date.value=='YYYY-MM-DD') || (Form.birth_date.value==''))
{
document.getElementById('showDOB').innerHTML = error("Enter your DOB!");
Form.birth_date.focus();
return false;
}
	
if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
document.getElementById('mobileShow').innerHTML = error("Enter your Mobile Number!");
//alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
		     document.getElementById('mobileShow').innerHTML = error("Enter numeric value!");
	         // alert("Enter numeric value in ");
			  Form.Phone.focus();
			  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
                document.getElementById('mobileShow').innerHTML = error("Enter 10 Digits!");
				//alert("Please Enter 10 Digits"); 
				 Form.Phone.focus();
				return false;
        }
else if (Form.Phone.value.charAt(0)!="9" && Form.Phone.value.charAt(0)!="8")
		{
                document.getElementById('mobileShow').innerHTML = error("Should start with 9 or 8!");
			 //   alert("The number should start only with 9");
				 Form.Phone.focus();
                return false;
        }

if(document.personalloan_form.Email.value!="Email Id")
{
	if (!validmail(document.personalloan_form.Email.value))
	{
		//alert("Please enter your valid email address!");
		document.personalloan_form.Email.focus();
		return false;
	}
	
}


if(Form.City.selectedIndex==0)
{
	document.getElementById('cityShow').innerHTML = error("Please enter City!");
	//alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
document.getElementById('othercityShow').innerHTML = error("Please enter Other City!");
//alert("Kindly fill in your other City!");
Form.City_Other.focus();
return false;
}
if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
document.getElementById('pincodeShow').innerHTML = error("Please enter Pincode!");
//alert("Kindly fill in your Pincode!");
Form.Pincode.focus();
return false;
}
else if(Form.Pincode.value.length < 6)
{
document.getElementById('pincodeShow').innerHTML = error("Please enter 6 Digits!");
//alert("Kindly fill in your Pincode(6 Digits)!");
Form.Pincode.focus();
return false;
}
else if(containsalph(Form.Pincode.value)==true)
{
document.getElementById('pincodeShow').innerHTML = error("Please enter Numeric Only!");
//alert("Kindly fill in your Correct Pincode (Numeric Only)!");
Form.Pincode.focus();
return false;
}

 if(Form.Employment_Status.selectedIndex==0)
{
	document.getElementById('statusShow').innerHTML = error("Please enter Employment Status!");
//	alert("Please select emplyment status ");
	Form.Employment_Status.focus();
	return false;
}
if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name")|| (Trim(Form.Company_Name.value))==false)
{
	document.getElementById('companyShow').innerHTML = error("Please enter Company Name!");
//alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}
else if(Form.Company_Name.value.length < 3)
{
document.getElementById('companyShow').innerHTML = error("Please enter Company Name!");
//alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}
for (var i = 0; i < Form.Company_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Company_Name.value.charAt(i)) != -1) {
  	document.getElementById('companyShow').innerHTML = error("Please remove special characters!");
	//alert ("Company Name has special characters.\n Please remove them and try again.");
	Form.Company_Name.focus();
  	return false;
  	}
  }
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)"))
{
  	document.getElementById('incomeShow').innerHTML = error("Please enter Income!");
	//alert("Please enter Income to Continue");
	//Form.IncomeAmount.focus();
	return false;
}
 if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
{
 	document.getElementById('loanShow').innerHTML = error("Please enter Loan Amount!");
//alert("Kindly fill in your Loan Amount (Numeric Only)!");
Form.Loan_Amount.focus();
return false;
}
else if(containsalph(Form.Loan_Amount.value)==true)
{
	document.getElementById('loanShow').innerHTML = error("Loan Amount contains characters!");
//alert("Loan Amount contains characters!");
Form.Loan_Amount.focus();
return false;
}

myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				myOption = i;
			}
		}
	
		if (myOption == -1) 
		{
				document.getElementById('ccShow').innerHTML = error("Please select for Credit Card holder!");
			//alert("Please select you are credit card holder or not");
			return false;
		}

	if(!Form.accept.checked)
	{
		document.getElementById('acceptShow').innerHTML = error("Accept the Terms and Condition!");
		//alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
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

function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}



function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
//		element.value = 'style="color:#999999"' + defaultVal + '</style>';
		element.value = defaultVal ;
	}
}

function othercity1()
{
	if(document.personalloan_form.City.value=='Others')
	{
		document.personalloan_form.City_Other.disabled=false;
	}
	else
	{
		document.personalloan_form.City_Other.disabled=true;
	}
}


function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div class="card" style="width:280px; float:left; margin-left:0px;" ><label > Card held since? </label>&nbsp; <select size="1" name="Card_Vintage" style="margin-left:10px; margin-top:2px; width:130px;"><option value="0">Please select</option> <option value="1">Less than 6 months</option><option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div>	';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.personalloan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML ='';
				
			}
		}
		
		return true;

	}


function ShowHide(id,val) {
	//alert(id);
	if(document.getElementById(val).value=="" || document.getElementById(id).innerHTML !='')
	{
		document.getElementById(id).innerHTML ='';
	}
}
function ChgText()
{
	alert("Please fill all the Details.");
}
 
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
		
		function checkDuplicateMobile()
		{
			//alert("testing");
//			var get_mobile_no = document.getElementById('Phone').value;
			var get_mobile_no = document.personalloan_form.Phone.value;
			var queryString = "?get_Mobile=" + get_mobile_no;
				//alert(queryString); 
			if(get_mobile_no!='')
			{
				//alert("hello");
				ajaxRequest.open("GET", "check-duplicate-mobile.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						var ajaxDisplay = document.getElementById('ajaxDivLife');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
						//document.write(ajaxRequest.responseText); 
					}
				}
				ajaxRequest.send(null); 
			}
		}

	window.onload = ajaxFunction;

</script>
</head>

<body>
<form action="insert-personal-loan-step1.php" method="post" name="personalloan_form" id="personalloan_form" onsubmit="return chkpersonalloan(document.personalloan_form);">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="ndtv"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="URL" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
<!-- Global Navigation start -->
<div class="global">
<div class="globalcont">
<div style="width:550px; float:left;">
<script type="text/javascript" src="http://www.ndtv.com/ndtvmoney/js/globe_nav.js"></script> 
</div>
<div style="width:410px; float:left; "><!-- <img src="images/right.jpg" width="410" height="53" /> --></div>
<!-- <img src="images/global_nav.gif" width="960" border="0" /> --> </div>

</div>
<!-- Global Navigation end -->
<!-- masthead start -->

<div class="tphead">

  <div class="moneylogo"><img src="/images/money_logo1.gif" width="324" height="146" /></div>
 <div class="mainhdng">Personal Loans</div>
</div>

<!-- masthead end -->
<!-- topnav start -->
<?php include "~toplinks.php"; ?>

<!--<div class="blubg"></div> -->
<!-- topnav end -->
<!-- content start -->
	<div class="content">
    	<div class="content_cont"><?php include '../~menu.php' ?>
    	  <div class="rightpanel">
                <!-- Articles Widget Start -->
				
			<div class="widget990_cont">
            	<div class="widget854_cont">
<fieldset class="brd_8">
    <legend class="brd_2">Compare Personal Loans Quotes</legend>
	<div class="float_l">
	<div class="lft_colum_280">
	<p class="padtb0" ><label >Name : </label> <input name="Name" id="Name" tabindex="1" type="text" style="margin-left:30px;" onChange="ShowHide('nameShow','Name')"  /></p>
<div id="nameShow" class="errfnt"></div> 
	<p class="padtb0" ><label >DOB : </label><input type="text" readonly name="birth_date" tabindex="2" style="width:123px; margin-left:38px; "  onChange="ShowHide('showDOB','birth_date')"  > <img src="pl-images/calendar.jpg"  onclick="displayCalendar(document.personalloan_form.birth_date,'yyyy-mm-dd',this)" style="cursor:pointer;" />
	<!-- <input type="button" value="Cal"> --> <!-- <input name="name" id="name"  type="text" style="margin-left:37px;"/> --></p>
		<div id="showDOB"  class="errfnt"></div>
	<p class="padtb0" ><label >Mobile : </label> <input name="Phone" id="Phone" tabindex="3" type="text" style="margin-left:23px;" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onChange="ShowHide('mobileShow','Phone'); checkDuplicateMobile();" /></p>
	<div id="mobileShow"  class="errfnt"></div>
	<p class="padtb0" ><label >Email Id : </label><input name="Email" id="Email" tabindex="4" type="text" style="margin-left:12px;" onchange="ShowHide('emailShow', 'Email'); checkDuplicateMobile();" onfocus="checkDuplicateMobile();"/></p>
			<div id="emailShow"  class="errfnt"></div>		</div>
		
						<div class="sepret"><img src="pl-images/sepret_bar.gif" width="2" height="90" /></div>
			<div class="lft_colum_290">
	<p class="padtb0" >
	  <label >City : </label> <select style="margin-left:60px; width:146px;"  name="City" id="City" onchange="othercity1(this); ShowHide('cityShow','City');"  tabindex="5" ><?=getCityList($City)?></select></p>
		<div id="cityShow"  class="errfnt"></div>			
	<p class="padtb0" >
	  <label >Other City  : </label> <input name="City_Other" id="City_Other" onblur="onBlurDefault(this,'Other City');"  onfocus="onFocusBlank(this,'Other City');" value="Other City" onchange="ShowHide('othercityShow','City_Other');" disabled  tabindex="6" type="text" style="margin-left:18px;"/></p>
	<div id="othercityShow"  class="errfnt"></div>		
	<p class="padtb0" >
	  <label >Pincode : </label> <input name="Pincode" id="Pincode" tabindex="7" type="text" style="margin-left:34px;" maxlength="6"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="ShowHide('pincodeShow','Pincode');"/></p>
	<div id="pincodeShow"  class="errfnt1"></div>			
	<p class="padtb0" ><label >Occupation : </label> 
	  <select   style="width:146px; margin-left:13px; "  tabindex="8"  name="Employment_Status" id="Employment_Status" onchange="ShowHide('statusShow','Employment_Status');">
        <option selected value="-1">Employment Status</option>
        <option  value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select>
	</p>
	<div id="statusShow"  class="errfnt"></div>			
			</div>
			<div class="sepret"><img src="pl-images/sepret_bar.gif" width="2" height="90" /></div>
			<div class="lft_colum_290">
	<p class="padtb0" >
	  <label >Company Name  : </label> <input name="Company_Name" id="Company_Name" tabindex="9" type="text" style="margin-left:20px;" onchange="ShowHide('companyShow','Company_Name');"/></p>
	  <div id="companyShow"  class="errfnt"></div>			
	<p class="padtb0" >
	  <label >Annual Income  : </label> 
	  <input name="IncomeAmount" id="IncomeAmount" tabindex="10" type="text" style="margin-left:25px; text-align:left;" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="ShowHide('incomeShow','IncomeAmount');" /></p>
	<div id="incomeShow"  class="errfnt2"></div>			
	<p class="padtb0" >
	  <label >Loan Amount: </label> 
	  <input name="Loan_Amount" id="Loan_Amount" tabindex="11" type="text" style="margin-left:42px; text-align:left;" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="ShowHide('loanShow','Loan_Amount');" /></p>
		<div id="loanShow"  class="errfnt2"></div>			
		</div>
		
		<div style="clear:both;">
		<div class="card" ><label > Credit Card holder </label>&nbsp; <input name="CC_Holder" value="1" tabindex="12" id="CC_Holder" type="radio" class="noborder" onchange="ShowHide('ccShow','CC_Holder');" onClick="addElement();"/> <span>Yes</span> &nbsp;&nbsp; <input name="CC_Holder" id="CC_Holder" value="0" type="radio" tabindex="13" class="noborder" onchange="ShowHide('ccShow','CC_Holder');" onClick="removeElement();"/> <span>No</span>
		<div id="myDiv"></div>		 </div>
		
	<div  class="prvcy" ><input name="accept" id="accept" tabindex="14" type="checkbox" class="noborder" onchange="ShowHide('acceptShow','accept');" /> <span> I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.</span>
	<div id="acceptShow"  class="errfnt3"></div>		
	</div>
			<div class="sbtn"  id="ajaxDivLife"><!--<img src="pl-images/pl_submit.gif" onclick="return ChgText();" />--> <input type="image" src="pl-images/pl_submit.gif" alt="" class="noborder" /> </div>
	</div>
	
	</div>
	
  </fieldset>
</div></div>				
				
				
				
				
			
          </div>
		  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="1" bgcolor="#bdc5cf" style="float:left;">
  
  <tr>
    <td width="20%" height="22" align="center" bgcolor="#3d60a4" class="wttext">Banks</td>
   
    <td width="22%" align="center" bgcolor="#3d60a4" class="wttext">Fullerton</td>
  </tr>

  <tr>
    <td height="22" align="center" bgcolor="#FFFFFF" class="text"><b>Rate of Interest</b></td>
  
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text">23% - 28%</td>
  </tr>
  <tr>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF" class="text" ><b>Processing Fee</b></td>
   
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text">2%</td>
  </tr>
  <tr>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF" class="text" ><b>Loan Amount</b></td>
    
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text">Rs.40,000 - Rs.5,00,000</td>
  </tr>

  <tr>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF" class="text" ><b>Prepayment Charges</b></td>
   
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text">4% </td>
  </tr>
  <tr>
    <td height="22" align="center" valign="middle" bgcolor="#FFFFFF" class="text" ><b>Disbursal Time</b></td>
    
    <td align="center" valign="middle" bgcolor="#FFFFFF" class="text">4 working days</td>
  </tr>
</table>
    	  <!-- Partner Widget Start-->
        	<div class="partners">
            	<div class="partners_cont">
<div class="sldrpnl" >
	<div id="slider">
		<ul>				
			<li>
<div><img src="pl-images/thumb/partner_citifinancial.gif" width="134" height="37" style="border:none;" alt="Citifinancial"/></div>
<div><img src="pl-images/thumb/partner_fullerton.gif" alt="Fullerton India" width="134" height="47" style="border:none;"/></div>
<div><img src="pl-images/thumb/hdfc.jpg" alt="HDFC Bank" width="138" height="39"  style="border:none;"/></div>
<div><img src="pl-images/thumb/barclays.jpg" alt="Barclays Finance" width="138" height="37"  style="border:none;"/></div>
			</li>
			<li>
<div><img src="pl-images/thumb/partner_citibank.gif" alt="Citibank" width="138" height="41"  style="border:none;"/></div>
<div><img src="pl-images/thumb/partner_fullerton.gif" alt="Fullerton India" width="134" height="47" style="border:none;"/></div>
<div><img src="pl-images/thumb/partner_citifinancial.gif" width="134" height="37" style="border:none;" alt="Citifinancial"/></div>
<div><img src="pl-images/thumb/hdfc.jpg" alt="HDFC Bank" width="138" height="39"  style="border:none;"/></div>
			</li>
		</ul>
	</div>
</div>

</div>
            </div>
        <!-- Partner Widget End-->
        </div>
    </div>
<!-- content end -->
<!-- Footer Start -->
<div align="center" style=" float:left; width:100%; background-color:#f5f5f5; height: auto; margin-top:10px; ">
	<div class="global">
  <!-- <div class="globalcont"><img src="/images/global_nav.gif" width="960" /></div> -->
  <div class="globalcont" style="background-image:url(/images/global_bg.gif) top; background-repeat:repeat-x; height:60px;">
<div style="width:550px; float:left;">
<script type="text/javascript" src="http://www.ndtv.com/ndtvmoney/js/globe_navF.js"></script> 
</div>
<div style="width:410px; float:left; "><!-- <img src="images/right.jpg" width="410" height="53" /> --></div>
 </div>
</div>
</div>
<!-- Footer End -->
</form>
</body>
</html>
