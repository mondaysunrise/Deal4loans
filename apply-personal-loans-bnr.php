<?php
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	
	if(isset($_REQUEST["srcbnr"]))
	{
		$srcbnr = $_REQUEST["srcbnr"];
	}
	else	
	{
		$srcbnr = "BnnrCmpgn11";
	}

if($srcbnr=="ibibopl" || $srcbnr=="komlipl")
{
}
else
{
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Personal Loans | Personal Loan Rates | Personal Loan EMI</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="lp-styles-bnr.css" rel="stylesheet" type="text/css">
<link href="lp-media-queries-bnr.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
 <style type="text/css">
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

.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}


.txt ul{
	margin:0px 0px 0px 2px;
	padding:0px 0px 0px 2px;
}

.txt ul li{
	background: url(images/cl/arrow.gif) no-repeat 0px 4px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}

.alert_msg{color:#FF0000; font-weight:bold; font-size:10px;}
input,select{border:1px solid #878787;margin:0;padding:0}
select:focus, input:focus
{
border:#FF0000 1px solid; 
}
 </style>
<script Language="JavaScript" Type="text/javascript">

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

function addDiv()
{
		var ni = document.getElementById('mynewDiv');
		
		if(ni.innerHTML=="")
		{
		
//			if(document.personalloan_form.IncomeAmount.value=="on")
	//		{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div id="expanddiv" class="addexpandeddiv" ></div>';
				

		//	}
		}
		
		return true;

	}

function chgtxtsal()
{
	var nitxt = document.getElementById('chgtxt');
	var niadtxt = document.getElementById('adtxt');
	var citemp = document.personalloan_form.Employment_Status.value;
	if(citemp==0)
	{
		nitxt.innerHTML ="Annual ITR";
		niadtxt.innerHTML="Annual Turnover &nbsp;<select name='Annual_Turnover' id='Annual_Turnover'  style='width:140px;'>		<option value=''>Please Select</option>	<option value='1' > 0 - 40 Lacs</option>	<option value='4' > 40 Lacs - 1 Cr</option>		<option value='2' > 1Cr - 3Crs </option>	<option value='3' >3Crs & above</option>	</select>";	
	}
	else 
	{
		
		nitxt.innerHTML ="Annual Income";	
		niadtxt.innerHTML="";	
	}
	
}
function addcty_oth()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.City.value=="Others")
			{
				
				ni.innerHTML = '<Table cellpadding="0" cellspacing="0" width="100%"><tr align="left">				  <Td height="26" class="bldtxt" width="40%">Other City </Td>				  <Td width="60%"> <select name="City_Other" id="City_Other" onChange="validateDiv(\'othercityVal\');"  ><option value="">Please Select</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Guntur">Guntur</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option></select><div id="othercityVal" class="alert_msg"></div></Td></tr></table>';
				

			}
		}
		else
	{
		ni.innerHTML="";
	}
		
		return true;

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
//alert("Kindly fill in your Name!");
document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";
Form.Name.focus();
return false;
}
else if(containsdigit(Form.Name.value)==true)
{

//alert("Name contains numbers!");
document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Name Contains Number</span>";
Form.Name.focus();
return false;
}
  for (var i = 0; i < Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
  	//alert ("Name has special characters.\n Please remove them and try again.");
	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Name has special characters</span>";	
	Form.Name.focus();
  	return false;
  	}
  }

if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Date of Birth</span>";
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Number Only</span>";
//alert("Kindly enter your Date of Birth(numbers Only)");
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
	//alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Day, Range 1-31</span>";
Form.day.select();
return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
//alert("Kindly enter your Month of Birth");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Month of Birth</span>";
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
//alert("Kindly enter your Month of Birth(numbers Only)");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Month of Birth</span>";
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
//alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month, Range 1-12</span>";
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>February, Only 29 days.</span>";
//alert("Month February cannot have more than 29 days");
Form.day.select();
return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
//alert("Kindly enter your Year of Birth");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Year of Birth</span>";
Form.year.select();
return false;
}

else if(!num.test(Form.year.value))
{
//alert("Kindly enter your Year of Birth(numbers Only) !");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Year of Birth</span>";
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
//alert("February cannot have more than 28 days.");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>February, Only 28 days.</span>";
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
//alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter 4 Digit</span>";
Form.year.select();
return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
//alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age group 21 - 62</span>";
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
//alert("Cannot have 31st Day");
document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Cannot have 31st Day</span>";
Form.day.select();
return false;
}

	
if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
//alert("Kindly fill in your Mobile Number!");
document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter Mobile Number</span>";
Form.Phone.focus();
return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
{
//  alert("Enter numeric value in ");
  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter Numeric Value</span>";
  Form.Phone.focus();
  return false;  
}
else if (Form.Phone.value.length < 10 )
{
	//alert("Please Enter 10 Digits"); 
    document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter 10 Digits</span>";
	Form.Phone.focus();
	return false;
}
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
{
	//alert("The number should start only with 9 or 8 or 7");
 	document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Start with 9 or 8 or 7</span>";
	Form.Phone.focus();
	return false;
}
		if(Form.Email.value=="")
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		
		var str=Form.Email.value
		var aa=str.indexOf("@")
		var bb=str.indexOf(".")
		var cc=str.charAt(aa)
	
		if(aa==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
			Form.Email.focus();
			return false;
		}
		else if(bb==-1)
		{
			document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
			Form.Email.focus();
			return false;
		}

if(Form.City.selectedIndex==0)
{
//	alert("Please enter City Name to Continue");
	document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Select City!</span>";		
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
//	alert("Kindly fill in your other City!");
	document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City!</span>";
	Form.City_Other.focus();
	return false;
}
if(Form.Employment_Status.selectedIndex==0)
{
	//alert(Form.Employment_Status.selectedIndex);
	document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";
	Form.Employment_Status.focus();
	return false;
}
if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)"))
{
	//alert("Please enter Income to Continue");
	document.getElementById('incomeVal').innerHTML = "<span  class='hintanchor'>Enter Income!</span>";
	Form.IncomeAmount.focus();
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
if(document.personalloan_form.City.value=='Others')
{
document.personalloan_form.City_Other.disabled=false;
}
else
{document.personalloan_form.City_Other.disabled=true;
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


</script>
<Script Language="JavaScript">

function addtooltip()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML=="")
		{
		ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
		
		}
		
		return true;

	}


function removetooltip()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML!="")
		{
		
				ni.innerHTML = '';
		
		}
		
		return true;

	}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.personalloan_form.City.value;
	
	
	if(cit =="Ahmedabad" || cit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#333333; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}	

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

</script>

</head>
<body>
<div id="pagewrap">
<div id="header">
<div id="site-logo"><img src="new-images/pl/deal4loans-logo.jpg"></div>
<div class="pl_top_text_box">Personal Loans by Choice not by Chance!</div>
  </div>
  <div style="clear:both;"></div>
  <div id="content">
		<article >
		  <div style=" float:left;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
		    <tr>
		      <td width="100%">
              <div class="image_box_b"><img src="new-images/pl/personal-loan-table.jpg"></div>
              <div class="image_box_a"><img src="new-images/pl/personal-loan.jpg" width="100%"></div><div class=""></div>              </td>
	        </tr>
	      </table>
          </div>
<div id="content_bnr"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF" class="bod_text">Why Deal4loans.com - Widest Choice of Banks</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" style="height:10px;"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><div class="why_deal">
      <table width="95%" border="0" align="center" style="padding:5px; border:2px solid #def3f8; " cellpadding="0" cellspacing="0">
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Get instant quote on Rates, Emi, Eligibility, Fees, and Documents from all Banks.</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;" ></td>
        </tr>
        <tr>
          <td width="6%" bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td width="94%" bgcolor="#FFFFFF" class="td_bg">Pick the best Bank as per your requirement.</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;"></td>
        </tr>
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Deal4loans.com has serviced 21 lac customers till now &amp; it's a totally free service for customers.</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;"></td>
        </tr>
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Your Information is secure with us and will not be shared without your consent.</td>
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
    <td bgcolor="#FFFFFF" class="form_text_pl">Loan Partners :</td>
  </tr>
  
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="23%" height="35" align="center"><img src="new-images/pl/plicici_lgo.jpg" width="100" height="50" /></td>
        <td width="27%" align="center"><img src="new-images/pl/plhdfc.jpg" width="81" height="21" /></td>
        <td width="20%" align="center"><img src="new-images/pl/pling_vlgo.jpg" width="80" height="21" /></td>
        <td width="30%" align="center"><img src="new-images/pl/plbajj_flgo.jpg" width="94" height="21" /></td>
        </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
        </tr>
      <tr>
        <td height="35" align="center"><img src="new-images/pl/plfultrn_n1.jpg" width="84" height="21" /></td>
        <td align="center"><img src="new-images/pl/plkotak_pl.jpg" alt="" width="72" height="21" /></td>
        <td align="center"><img src="new-images/pl/plstan-chatpl.jpg" width="78" height="21" /></td>
        <td align="center">&nbsp;</td>
        </tr>
      <tr>
        <td colspan="4" style="font-size:12px; color: #333; font-family:Verdana, Geneva, sans-serif; font-weight: normal;">* Refer to T &amp; C - www.deal4loans.com/personal-loan-offers.php</td>
      </tr>
    </table></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr><td><?php include 'footer_landingpage.php'; ?></td></tr>
</table>
         </div>
          
         	</article>
                  
            			</div>
                      
            <div class="shadow_box"><img src="new-images/pl/pl-form-shadow.jpg"></div>
          <div id="sidebar_bnr">
<div class="widget_b"><img src="new-images/pl/frm-hdng_a.gif"></div>  

		<div class="widget">
		  <div class="right-box-b">
          <? if($srcbnr=="tyroo") 
				{ ?>
<form name="personalloan_form"  action="#" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
<? if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	echo "<center> <b>This campaign is paused</b></center>";
} ?>
 
	 <? }
				else
				{ ?>
				<form name="personalloan_form"  action="insert_personal_loan_value_step1.php" method="POST" onSubmit="return chkpersonalloan(document.personalloan_form);">
				<? } ?>
                <input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="REFERER_URL" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
<input type="hidden" name="source" value="<? echo $srcbnr; ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div>
		  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="42%" height="35" class="form_text_pl">Full Name</td>
    <td width="58%">
    <input name="Name" type="text" class="input_box" id="Name" tabindex=1  onFocus="onFocusBlank(this,'Name');"  onBlur="onBlurDefault(this,'Name');" onChange="insertData();" <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }else {?>value=""<? }?>  onkeydown="validateDiv('nameVal');"/>
<div id="nameVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="28" class="form_text_pl">DOB</td>
    <td class="form_text_pl"><input name="day" type="text" class="dd_input" id="day" tabindex=2  onFocus="onFocusBlank(this,'dd');" onBlur="onBlurDefault(this,'dd');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="dd" maxlength="2" onKeyDown="validateDiv('dobVal');"/> <input name="month" type="text" class="dd_input" id="month" tabindex=3 onFocus="onFocusBlank(this,'mm');" onBlur="onBlurDefault(this,'mm');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="mm" maxlength="2" onKeyDown="validateDiv('dobVal');" /> <input name="year" type="text" class="dd_input" id="year" tabindex=4  onFocus="onFocusBlank(this,'yyyy');"   onBlur="onBlurDefault(this,'yyyy');" onChange="intOnly(this); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="yyyy" maxlength="4" onKeyDown="validateDiv('dobVal');" /><div id="dobVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="28" class="form_text_pl">Mobile No.</td>
    <td> +91 
      <input name="Phone" type="text" class="mobo_input" id="Phone"  tabindex=5 onFocus="addtooltip();" onChange="intOnly(this); tosendsms(); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="10"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }else {?>value="" <? }?> onKeyDown="validateDiv('mobileVal');" /><div id="mobileVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="28" class="form_text_pl">Email Id</td>
    <td><input name="Email" id="Email" type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else { ?>value=""<? } ?>   onblur="onBlurDefault(this,'Email Id');" onFocus="removetooltip();" class="input_box" onChange="insertData();" tabindex=6 onKeyDown="validateDiv('emailVal');" /><div id="emailVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="28" class="form_text_pl">City</td>
    <td><select  name="City" class="select_input_bnr" id="City"  onchange="validateDiv('cityVal'); addcty_oth(); addhdfclife();" tabindex="7"  >
        <option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Delhi">Delhi</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Noida">Noida</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Others">Others</option></select><div id="cityVal" class="alert_msg"></div></td>
  </tr>
  <tr align="left">
				  <Td colspan="2" width="100%" id="myDiv"></Td>
		  </tr>
  <tr>
    <td height="28" class="form_text_pl">Occupation</td>
    <td><select name="Employment_Status" class="select_input_bnr" id="Employment_Status" tabindex=9 onChange="chgtxtsal(); addcmp_nme(); validateDiv('empStatusVal');" >        <option selected value="-1">Employment Status</option><option value="1">Salaried</option><option value="0">Self Employed</option></select><div id="empStatusVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="28" class="form_text_pl"><div id="chgtxt">Annual Income</div></td>
    <td><input name="IncomeAmount" type="text" class="input_box" id="IncomeAmount" tabindex=11  onFocus="this.select();" onBlur="PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); "  onChange="intOnly(this);" onKeyPress="intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');"  onKeyUp="intOnly(this);PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyDown="validateDiv('incomeVal');" /><div id="incomeVal" class="alert_msg"></div></td>
  </tr>
  <tr>
	  <td colspan="2" align="left">	<span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span>
	<span id='wordIncome' style='font-size:11px;font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize; margin-left:10px; margin-bottom:5px;'></span></td>
				  </tr>
				<tr>
				  <td colspan="2" align="left" class="bldtxt"><div id="adtxt"></div></td></tr>	
                 
                  <tr>
				  <td colspan="2" align="left" class="bldtxt"> <div id="hdfclife"></div></td></tr>			
  <tr>
    <td height="0" colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
  <td height="0" colspan="2"align="center" class="form_text_pl" style="font-size:10px; text-align:left;"><input type="checkbox"  name="accept" style="border:none;"  tabindex="12" checked  > I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="0" colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><? if($srcbnr=="clawdigital_pb1" || $srcbnr=="clawdigital_pb2" || $srcbnr=="clawdigital_pb3" || $srcbnr=="clawdigital_pb4" || $srcbnr=="clawdigital_pb5" || $srcbnr=="clawdigital") {} else {?><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " tabindex="13" /><? } ?></td>
    </tr>
          </table>
          </form>
		  </div>
		</div>
    <div class="widget_c"><img src="new-images/pl/step-ban.gif"></div>
       <div class="widget_c"><img src="new-images/pl/diwali-welcome-rewards.jpg"></div>
  </div>
  </div>
  
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
<?php } ?>