<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	require 'scripts/home_loan_eligibility_function.php';
	
	$homeloan = $_REQUEST['homeloan'];
	$City = $homeloan;
	if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
	{
		$pageName = "eligibility-homeloan/".$homeloan;
		//header("HTTP/1.1 301 Moved Permanently");
		//header("Location: ".$pageName);
		//exit();
	}
	session_start();
function DetermineAgeFromDOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;  if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Home Loan Eligibility Calculator | Home Loan Eligibility India – Deal4loans</title>
<meta name="keywords" content="home loan calculator, home loan eligibility calculator, Home loan calculator India, housing loan eligibility, housing loan eligibility calculator, housing loan eligibility India">
<meta name="Description" content="Home loan Eligibility calculator helps customers to find eligibility amount for Home loan from from SBI, HDFC, ICICI, LIC, DHFL, Axis, Bank of Baroda & others. ">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="/source.css" rel="stylesheet" type="text/css" />
<link href="/css/home-loan-emi-calculator.css" type="text/css" rel="stylesheet"  />
 <script type="text/javascript" src="/scripts/mainmenu.js"></script>
<script type="text/javascript" src="/js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="/scripts/common.js"></script>
<script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script src="/includes/ice/ice.js" type="text/javascript"></script>
<script language="javascript">
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{	if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))	{	return true;	}	} }
function Trim(strValue) {var j=strValue.length-1;i=0;while(strValue.charAt(i++)==' ');while(strValue.charAt(j--)==' ');return strValue.substr(--i,++j-i+1);}
function cityother(){	if(document.homeloan_calculator.City.value=="Others")	{		document.homeloan_calculator.City_Other.disabled = false;	}	else	{		document.homeloan_calculator.City_Other.disabled = true;	} } 
function validmobile(mobile) 
{		atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{		alert("Mobile number cannot start with 0.");		return false;	}
	if(!checkData(document.homeloan_calculator.Phone, 'Mobile number', 10))
		return false;
return true;
}

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined) { document.getElementById('plantype2').innerHTML = strPlan;			   document.getElementById('plantype2').style.background='Beige';         }
       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined)        {               document.getElementById('plantype2').innerHTML = strPlan;			   document.getElementById('plantype2').style.background='';  			                          }
       return true;
}

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
function validateDiv(div){	var ni1 = document.getElementById(div);	ni1.innerHTML = ''; }

function checkhlcalc()
{

var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if (document.homeloan_calculator.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.homeloan_calculator.Loan_Amount.focus();
		return false;
	}	
	if (document.homeloan_calculator.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.homeloan_calculator.Employment_Status.focus();
		return false;
	}
	if (document.homeloan_calculator.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.homeloan_calculator.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.homeloan_calculator.Net_Salary, 'Annual Income',0))
		return false;
	if (document.homeloan_calculator.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.homeloan_calculator.City.focus();
		return false;
	}
	if((document.homeloan_calculator.Name.value=="") || (Trim(document.homeloan_calculator.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.homeloan_calculator.Name.focus();
		return false;
	}
	if(document.homeloan_calculator.Name.value!="")
	{
		if(containsdigit(document.homeloan_calculator.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.homeloan_calculator.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.homeloan_calculator.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.homeloan_calculator.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.homeloan_calculator.Name.focus();
			return false;
		}
  }
	if(document.homeloan_calculator.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	if(isNaN(document.homeloan_calculator.Phone.value)|| document.homeloan_calculator.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.homeloan_calculator.Phone.focus();
		return false;  
	}
	if (document.homeloan_calculator.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	if ((document.homeloan_calculator.Phone.value.charAt(0)!="9") && (document.homeloan_calculator.Phone.value.charAt(0)!="8") && (document.homeloan_calculator.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	
	if(document.homeloan_calculator.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.homeloan_calculator.Email.focus();
		return false;
	}
	
	var str=document.homeloan_calculator.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.homeloan_calculator.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.homeloan_calculator.Email.focus();
		return false;
	}
	
	if(document.homeloan_calculator.day.value=="" || document.homeloan_calculator.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.homeloan_calculator.day.focus();
		return false;
	}
	if(document.homeloan_calculator.day.value!="")
	{
		if((document.homeloan_calculator.day.value<1) || (document.homeloan_calculator.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.homeloan_calculator.day.focus();
			return false;
		}
	}
	if(!checkData(document.homeloan_calculator.day, 'Day', 2))
		return false;
	
	if(document.homeloan_calculator.month.value=="" || document.homeloan_calculator.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.homeloan_calculator.month.focus();
		return false;
	}
	if(document.homeloan_calculator.month.value!="")
	{
		if((document.homeloan_calculator.month.value<1) || (document.homeloan_calculator.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.homeloan_calculator.month.focus();
			return false;
		}
	}
	if(!checkData(document.homeloan_calculator.month, 'month', 2))
		return false;

	if(document.homeloan_calculator.year.value=="" || document.homeloan_calculator.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.homeloan_calculator.year.focus();
		return false;
	}
	if(document.homeloan_calculator.year.value!="")
	{
		if((document.homeloan_calculator.year.value < "<?php echo $maxage;?>") || (document.homeloan_calculator.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.homeloan_calculator.year.focus();
			return false;
		}
	}
	if(!checkData(document.homeloan_calculator.year, 'Year', 4))
		return false;
	
		
  if(document.homeloan_calculator.Property_Value.value=="")
	{
		document.getElementById('propertyValueVal').innerHTML = "<span  class='hintanchor'>Enter Property Value!</span>";	
		document.homeloan_calculator.Property_Value.focus();
		return false;
	}
	
	if(!document.homeloan_calculator.accept.checked)
	{
	//alert("Read and Accept Terms and Condition!");
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.homeloan_calculator.accept.focus();
		return false;
	}
	return true;
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	
	ni1.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2"><div style="padding-top:5px;" ><table width="98%" border="0" cellpadding="0" cellspacing="0"><tr><td width="14%"  align="left" style="font-size:19px; color:#FFFFFF; padding-top:5px;"> Personal Details</td><td style="font-size:13px; font-weight:normal; color:#fff;"  valign="bottom"><img src="/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></div> <div style="clear:both;"></div></td></tr><tr>      <td colspan="2"> <div class="hl_emi_input_form-new" style="padding-left:5px;">        <table width="98%" border="0" cellpadding="0" cellspacing="0">      <tr>            <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name :</span></td>            </tr>   <tr>            <td height="30"><input name="Name" id="Name" maxlength="8" type="text" class="hl_emi_input" onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div> </td>   </tr>  </table></div>   <div class="hl_emi_input_form-new" style="padding-left:5px;"> <table width="98%" border="0" cellpadding="0" cellspacing="0">   <tr>  <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile :</span></td>     </tr>    <tr>   <td height="30" style="color:#FFFFFF;">+91 <input name="Phone" id="Phone" class="hl_emi_mob_input" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div></td>              </tr> </table>  </div> <div class="hl_emi_input_form-new" style="padding-left:5px;"> <table width="98%" border="0" cellpadding="0" cellspacing="0"> <tr>  <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</span></td>  </tr> <tr> <td height="30"><input name="Email" id="Email"  type="text" class="hl_emi_input" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td> </tr> </table>  </div>    <div class="hl_emi_input_form-new" style="padding-left:5px;">  <table width="98%" border="0" cellpadding="0" cellspacing="0">      <tr>       <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB :</span></td> </tr>  <tr>             <td height="30"><input name="day" id="day" type="text"  class="hl_emi_dd" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /> <input name="month" id="month" type="text" class="hl_emi_dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /> <input name="year" id="year" type="text"  class="hl_emi_yy" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal"></div>  </td>             </tr> </table>  </div></td>    </tr>    <tr><td colspan="2"> <div class="hl_emi_input_form-new" style="padding-left:5px;">          <table width="98%" border="0" cellpadding="0" cellspacing="0">            <tr>              <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Value :</span></td>              </tr>      <tr>   <td height="30"><input type="text" name="Property_Value" id="Property_Value" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); " class="hl_emi_input"  onKeyDown="validateDiv(\'propertyValueVal\');" /><div id="propertyValueVal"></div>  </td>  </tr>            </table>    </div> <div class="hl_emi_input_form-new" style="padding-left:5px;">          <table width="98%" border="0" cellpadding="0" cellspacing="0">     <tr>              <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Total EMI of All Loans :</span></td>              </tr>     <tr>  <td height="30"><input type="text" name="total_obligation" id="total_obligation" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" class="hl_emi_input"  onKeyDown="validateDiv(\'obligationVal\');" /><div id="obligationVal"></div>  </td>  </tr>   </table>    </div></td></tr>         <tr><td colspan="2">     <div class="hl_emi_term_box"  ><span style="font-size:11px;"><input name="accept" type="checkbox" checked /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.</span><div id="acceptVal"></div></div>  <div class="hl_emi_get_quote" style="margin-top:8px;"><input type="submit" style="border: 0px none ; background:url(/images/get1.gif) no-repeat; width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div>   <div style="clear:both;"></div><div id="hdfclife" class="hdfclife"></div> </td></tr>    </table>';}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.homeloan_calculator.City.value;
//	var otrcit = document.loan_form.City_Other.value;
ni1.innerHTML = '';
	if(cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td  class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}
</script>
<style type="text/css">
.heading_text{ font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold; color:#39C;}
.body_text{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #666;}
.body_text1{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #666;}
.pnb_housing{ font-family:Verdana, Geneva, sans-serif; color:#A52921; font-size:12px; font-weight:bold;}
.icici_bank{ font-family:Verdana, Geneva, sans-serif; color:#C2350D; font-size:12px; font-weight:bold;}
.fed_bank{ font-family:Verdana, Geneva, sans-serif; color:#004B93; font-size:11px; font-weight:bold;}
.axis_bank{ font-family:Verdana, Geneva, sans-serif; color:#AD285D; font-size:12px; font-weight:bold;}
.Hdfc_ltd_bank{ font-family:Verdana, Geneva, sans-serif; color:#ED1413; font-size:12px; font-weight:bold;}
.style100 {font-family: Verdana, Geneva, sans-serif; font-size: 13px; color: #666; font-weight: bold; }
.boxmagic-main-wrapper{width:830px; margin:auto;}
.boxmagic-main{ width:400px; float:left; border:#CCCCCC thin solid; margin-right:3px; margin-bottom:5px;}
.textmag-head{ font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#0066cc; text-indent:5px; font-weight:bold;} 
.price-text{ color:#c3262d; font-size:14px; font-family:Verdana, Geneva, sans-serif; font-weight:bold;}
.textmagbody{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}
.buttonmag{ font-family:Verdana, Geneva, sans-serif; text-align:center; color:#FFF; font-size:14px; background:#F60; border:none; width:137px; height:29px; border:#b04b1f solid thin;}
@media screen and (max-width: 768px) {
	.boxmagic-main-wrapper{width:600px; margin:auto;}
.boxmagic-main{ width:100%; float:none; border:#CCCCCC thin solid; margin-right:3px; margin-bottom:5px;}
.textmag-head{ font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#0066cc; text-indent:5px; font-weight:bold;} 
.price-text{ color:#c3262d; font-size:14px; font-family:Verdana, Geneva, sans-serif; font-weight:bold;}
.textmagbody{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}
.buttonmag{ font-family:Verdana, Geneva, sans-serif; text-align:center; color:#FFF; font-size:14px; background:#F60; border:none; width:137px; height:29px; border:#b04b1f solid thin;}
}
</style>

<link href="/css/cont_calc.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<link href="/source1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/menu-style.css">
</head>
<body>
<div class="main_menu_mobo"><?php include "top-menu.php"; ?></div>
<?php include "main-menu2.php"; ?>
<script type="text/javascript" src="/script1.js"></script>
<div style="clear:both;"></div>
<div class="hl_emi_cal_wrapper">
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u>  > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> > <span  class="text12" style="color:#4c4c4c;">Home Loan Eligibility Calculator </span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div  style="margin:auto; width:100%;">
<div class="hl_emi_cal_form">
<form name="homeloan_calculator" method="post" action="apply-home-loans-calc-continue1.php" onSubmit="return checkhlcalc();">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="Home Loan Calc">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2"><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" colspan="2"><h1 class="text3" style=" color:#FFF; font-size:24px; text-transform:none; ">Home Loan Eligibility Calculator <?php echo $_REQUEST['homeloan']; ?> <span style="font-size:18px;">- Get Instant Free Quote from Top 10 Banks.</span><span style="font-size:14px;"> Minimum Tenure - 6 Months </span></h1></td>
        </tr>
        <tr>
          <td colspan="2"><span style=" font-size:19px; color:#FFFFFF;">Professional Details </span></td>
        </tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2"> <div class="hl_emi_input_form-new" style="padding-left:5px;">
        <table width="98%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Required Loan Amount :</span></td>
            </tr>
          <tr>
            <td height="30"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="hl_emi_input" onKeyDown="validateDiv('loanAmtVal');" />
              <div id="loanAmtVal"></div><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform:capitalize;'></span></td>
            </tr>
          </table></div>
        <div class="hl_emi_input_form-new" style="padding-left:5px;">
          <table width="98%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation :</span></td>
              </tr>
            <tr>
              <td height="30"><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');" class="hl_emi_select"   style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" ><option value="-1">Please Select</option><option value="1">Salaried</option><option value="0">Self Employed</option></select><div id="empStatusVal"></div></td>
              </tr>
            </table>
          </div>
        <div class="hl_emi_input_form-new" style="padding-left:5px;">
          <table width="98%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income :</span></td>
              </tr>
            <tr>
              <td height="30"><input name="Net_Salary" id="Net_Salary" maxlength="8" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');" class="hl_emi_input" /><div id="netSalaryVal"></div>
              
                <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
            </table>
          </div>
        <div class="hl_emi_input_form-new" style="padding-left:5px;">
          <table width="98%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City :</span></td>
              </tr>
            <tr>
              <td height="30"><select name="City" id="City" class="hl_emi_select"  style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="addPersonalDetails(); validateDiv('cityVal');" tabindex="7"><?=getCityList($City)?></select><div id="cityVal"></div>  </td>
              </tr>
            </table>
          </div></td>
    </tr>
    <tr><td colspan="2"><!--added--> <!--added--></td></tr>
    
          <!--last-->
    <tr>
      <td align="right" id="personalDetails" colspan="2"><img src="/images/get1.gif" border="0" />
      
      </td>
      
    </tr>
   
    <tr>
      <td colspan="2" ice:editable="*">&nbsp;</td>
      </tr>
  </table>
  </form>
</div>
</div>
<div style="clear:both;"></div>
<div style="padding-top:5px; padding-bottom:2px;">
<div class="boxmagic-main-wrapper">
<?php 
$getPageSql = "select * from property_details_hl where City ='".$City."' and Status =1";
list($num,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());

for($i=0;$i<$num;$i++)
{
$State = ucwords($getPageQuery[$i]['State']);
$City = ucfirst($getPageQuery[$i]['City']);
$Price = $getPageQuery[$i]['Price'];
$Title = $getPageQuery[$i]['Title'];
$Rate = $getPageQuery[$i]['Rate'];
$CoveredArea = $getPageQuery[$i]['CoveredArea'];
$Facilities = $getPageQuery[$i]['Facilities'];
$Description = $getPageQuery[$i]['Description'];
$metadesc = $getPageQuery[$i]['metadesc'];
$keyword = $getPageQuery[$i]['keyword'];
$ApprovedBy = $getPageQuery[$i]['ApprovedBy'];
$BuilderName = $getPageQuery[$i]['BuilderName'];
$Status = $getPageQuery[$i]['Status'];
$AgentName = $getPageQuery[$i]['AgentName'];
$AgentEmail = $getPageQuery[$i]['AgentEmail'];
$AgentMobile = $getPageQuery[$i]['AgentMobile'];
$AgentPwd = $getPageQuery[$i]['AgentPwd'];

?>
<?php if(strlen($Title)>1) { ?>
<div class="boxmagic-main">
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" valign="middle" bgcolor="#f9f9f9" class="textmag-head" style="border-bottom:#CCC solid thin;"><?php echo $Title; ?></td>
    </tr>
  <tr>
    <td colspan="2" height="5"></td>
    </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" class="price-text"><?php if(strlen($Price)>1) { ?><img src="/new-images/rupees.gif" border="0" width="10" height="12" /><?php echo $Price; ?><?php } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody"><?php if(strlen($Rate)>1) { ?><strong>Price per Sq-ft.</strong>: <img src="/new-images/rupees.gif" border="0" width="8" height="10" /><?php echo $Rate; ?><?php } ?> | <?php if(strlen($CoveredArea)>1) { ?><strong>Covered Area - </strong><?php echo $CoveredArea; ?><?php } ?></td>
  </tr>
  <tr>
    <td colspan="2" height="7"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody"><?php if(strlen($BuilderName)>1) { ?><strong>Builder - </strong><?php echo $BuilderName; ?><?php } ?> | <?php if(strlen($ApprovedBy)>1) { ?><strong>Approved By - </strong><?php echo $ApprovedBy; ?><?php } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody">
      <input type="submit" name="button" id="button" value="Contact Agent" class="buttonmag"  />
   </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody">&nbsp;</td>
  </tr>
</table>
</div>
<?php } } ?>
</div>
</div>
<div style="clear:both;"></div>
<div style=" width:100%; height:auto; margin-top:5px; margin-left:10px; text-align:justify;">
          <table width="100%"  cellpadding="0" cellspacing="0">
          <tr><td>
   <p style="color:#4c4c4c; " class="body_text">   <span class="text" style="color:#4c4c4c; font-size:15px; font-weight:bold;">  Sample Home Loan Eligibility</span> - 
 Employment Status - <strong>Salaried</strong> | Annual Income - <strong>Rs. 5 Lacs</strong> | Property Value - <strong>Rs. 75 Lacs</strong> | Tenure - <strong>20 Yrs</strong></p>
          </td></tr>
          
  <tr>
    <td bgcolor="#EBEBEB">
    <table width="100%" align="center" cellpadding="2"  cellspacing="2" style="border:#CCC solid thin;"><tr><td bgcolor="#FFFFFF" class="body_text1"><table width="100%" align="center" cellpadding="2"  cellspacing="2" style="border:#CCC solid thin;">
      <tr>
        <th width="25%" align="center" bgcolor="#FFFFFF" class="heading_text">Bank Name</th>
        <th width="25%" align="center" bgcolor="#FFFFFF" class="heading_text">Interest Rate</th>
        <th width="25%" align="center" bgcolor="#FFFFFF" class="heading_text">Emi (per Month)</th>
        <th width="25%" align="center" bgcolor="#FFFFFF" class="heading_text">Eligible Loan Amount</th>
      </tr>
        <tr>
        <td height="30" align="center" valign="middle" bgcolor="#FFFFFF">
            <span class="pnb_housing">PNB Housing Finance</span></td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">10.75 %</td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.21184</td>
        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2086681</td>
      </tr>
      <tr>
        <td  height="30" align="center" bgcolor="#FFFFFF">
            <span class="icici_bank">ICICI Bank</span></td>
        <td bgcolor="#FFFFFF" class="body_text1" align="center"> 10.15 %</td>
        <td bgcolor="#FFFFFF" class="body_text1" align="center">Rs.18612</td>
        <td align="center" bgcolor="#FFFFFF" class="body_text"><strong>Rs. 1909000</strong></td>
      </tr>
      
      <tr>
        <td height="30" align="center" valign="middle" bgcolor="#FFFFFF">
            <span class="Hdfc_ltd_bank">HDFC Ltd</span></td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">10.25 %</td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.20825</td>
        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2121487</td>
      </tr>
      <tr>
        <td height="30" align="center" bgcolor="#FFFFFF" ><span class="fed_bank">SBI</span></td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">10.15 %</td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.18612</td>
        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. <strong>1909000</strong></td>
      </tr>
        <tr>
        <td height="30" align="center" bgcolor="#FFFFFF" ><span class="fed_bank">FedBank</span></td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">10.55 %</td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.29159</td>
        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2910844</td>
      </tr>
        <tr>
        <td height="30" align="center" bgcolor="#FFFFFF" ><span class="fed_bank">LIC Housing</span></td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">10.20 %</td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.24855</td>
        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2540650</td>
      </tr>
      <tr>
        <td height="30" align="center" bgcolor="#FFFFFF" ><span class="fed_bank">Bajaj Finserv</span></td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">10.40 %</td>
        <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.20826</td>
        <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 2100100</td>
      </tr>
    </table></td>
            </tr>
    </table>
   </td>
  </tr>
</table>
<div style="text-align:right;" class="font2"> <a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></div>
 <div class="responsive_ad" align="center"><br />
 <script type="text/javascript"><!--
google_ad_client = "ca-pub-6880092259094596";
/* New Mobile Ad */
google_ad_slot = "5972830045";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
 </div>
<table cellpadding="0" cellspacing="0" border="0" class="font2"><tr><td valign="top" style="padding:3px;"> Following are eligible to 
<a href="http://www.deal4loans.com/apply-home-loans.php">apply for a Home Loan</a> :<br> 
•	Salaried individuals<br> 
•	Self employed professionals/businessmen <br><br>
You can include your spouse/parents/children as co-applicant if you require higher eligibility subject to maximum of three applicants. <br />
<h3 class="text" style="color:#4c4c4c; size:18px; height:15px;">Home Loans Eligibility Factors</h3>
Home loans are an easy option for buying a house but getting the right amount depends on many factors and this may depend upon the factors listed below:
<br />
<div style=" width:100%; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Monthly Income</span><br />  <span class="text11" style="color:#4c4c4c; ">The income that he earns from which he will pay his home loan emi is one of the most important factors that affect the amount of loan. So if you are salaried your per month income and if you are self employed, your yearly profit would identify your home loan max eligibility.<br />
The loan amount basically depends upon the net income of an individual and a bank usually provides home loans up to 60 times of an individual net income. For e.g. if a person take home salary is Rs 30,000 he /she may be offered a home loan of around Rs 18 lacs. But it may not be so because a bank takes into account other factors as well while granting a loan.
</span></div>
<div style="width:100%; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Other EMI</span><br />  <span class="text11" style="color:#4c4c4c; ">Other Emi (Equally monthly installment) is the emi that we are paying to for any other <a href="http://www.deal4loans.com/">Loan</a>.</span></div>
<div style="width:100%; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Available Income</span><br />  <span class="text11" style="color:#4c4c4c; "> The income that is left in our hand after deduction of any emi amount that we are paying for any kind of loan. Your <a href="http://www.deal4loans.com/home-loan-calculator.php">Home Loan Eligibility Calculator</a>  will be calculated after deduction of the EMI’s that you are paying.</span></div>
<div style="width:100%; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Property Attributes</span><br />  <span class="text11" style="color:#4c4c4c; "> Banks give max upto 85% of loan against the value of the property. So if you want a home loan for a 50 lac property max that u can get is 85% of that ie 42.50 lacs. This too if in case you have the income to give the emi of that loan. So based on Income and property value banks decide your exact home loan eligibility.<br />
Banks also have certain specific criteria before accepting the property for granting a loan. The banks have specific norms with respect to the minimum area requirements for a flat which may be carpet area or built up area. The bank also considers the age of the property in case of an existing property, the location of the property and also the reputation of the builders constructing the property. The bank also performs a thorough analysis and inspection of the property to check whether the title is clear or not, or are there any ownership disputes, whether the bank is free from any encumbrances etc.
</span></div>

<br />
<div style=" width:100%; height:auto; margin-top:2px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:14px; font-size:15px; font-weight:bold;"><br />Duration of Loan (Years)</span><br />
  <span class="text11" style="color:#4c4c4c; ">It’s one of the most important factors that one should keep in mind while taking loan. It refers to the no. of years for which the loan has to be taken. Longer the tenure higher will be the interest paid and lower will be amount of EMI to be paid and vice-a-versa. It is one of the parameters which helps in comparing the EMIs from different banks keeping it constant for relationship and easing the judgment.</span></div>
<div style=" width:100%; height:auto; margin-top:15px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Interest Rate (in percentage)</span><br />
  <span class="text11" style="color:#4c4c4c; ">Today there are many lenders in the market. Every bank is offering loans whether it’s a nationalized bank, private bank or foreign bank each of them is there in the show. Every bank offers different rate of interest according to the profile of the customer. So, before finalizing a deal one should consider deals from various banks and than come to a conclusion. And aware of the fact that some people might mislead you by charging high rate of interest at reducing rate and might inform the same at flat rate of interest. So, its always advisable to check full detail with the banks and do better comparison in respect of EMIs , Tenure and <a href="http://www.deal4loans.com/home-loans-interest-rates.php">Interest Rates</a>  and keeping tenure as constant with all the banks will ease your comparison and will result in better analysis, finally leading to a prudent decision.</span> </div>
<div style="width:100%; height:auto; margin-top:15px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">EMI</span><br />
<span class="text11" style="color:#4c4c4c; "> EMI stands for equally monthly installment; you need to pay a particular amount for the Home loan that you have taken.</span></div>
<div style=" width:100%; height:auto; margin-top:15px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Eligible Loan Amount</span><br />
<span class="text11" style="color:#4c4c4c; "> The net loan amount for which you are eligible for your Home loan is said as Eligible Loan Amount. The loan amount that a Bank can sanction you.</span></div>

<div style="width:100%; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Credit History</span><br />  <span class="text11" style="color:#4c4c4c; ">The credit history of an individual plays an important role in deciding the amount of loan. Credit history is basically the credit information report of an individual generated by a credit information company on the basis of individual’s credit records. On the basis of the credit information report an individual is being given a credit score. Based on the credit score a bank or any other financial institution decides whether the individual is eligible for a loan or not. The credit history is generally affected by outstanding credit card payments and any unsecured loans. In India CIBIL is a reputed credit information company and it analyses the financial records of individuals and awards them a score which is known as the "CIBIL score".</span></div>

<div style="width:100%; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Age</span><br />  <span class="text11" style="color:#4c4c4c; "> Age also plays a crucial role in determining the eligibility for a home loan. One has to attain a minimum age of 21 to apply for a loan. The minimum age requirement may be different for different lending institution. The maximum age may vary from 58 to 65 years depending on the income source of the individual. The age also determines the tenure and EMI of the loan. For e.g. if an individual is 35 years of age and retires  at an age of 60 then his/her loan tenure will be 60-35=25 years and his /her EMI will be calculated accordingly. Longer the tenure lower will be the EMI’s. However the longer the tenure, the costlier the loan is as one ends up paying more interest rates.</span></div>

<div style="width:100%; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Co-applicant</span><br />  <span class="text11" style="color:#4c4c4c; "> In order to enhance the eligibility for having a loan one can have a co-applicant and in this way the total eligible income for having a home loan increases and thus as a result the loan eligibility becomes higher. However bank permits only certain relationships to become the co-applicant, friends and relatives who are not blood relatives to take a loan amount jointly.</span></div>
</td></tr></table>

<div style="width:100%; height:auto; margin-top:10px; text-align:justify;">
<span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Some of the features of home loans offered by different banks</span><br /><br />
<table border="1" cellspacing="0" cellpadding="3" class="font2" width="100%">
  <tr>
    <td width="25%" align="center" valign="top"><p><strong>Name </strong></p></td>
    <td width="25%" align="center" valign="top"><p><strong> Loan Amount</strong></p></td>
    <td width="25%" align="center" valign="top"><p><strong>Minimum Salary    Requirements</strong></p></td>
    <td width="25%" align="center" valign="top"><p><strong>Tenure</strong></p></td>
  </tr>
  <tr>
    <td width="25%" valign="top"><p><a href="http://www.deal4loans.com/sbi-home-loan.php">SBI Home loan</a></p></td>
    <td width="25%" valign="top"><p> It will be determined taking into    consideration such factors as applicant’s income and repaying capacity, age,    assets and liabilities, cost of the proposed house/flat etc.</p></td>
    <td width="25%" align="center" valign="top"><p>Not Available</p></td>
    <td width="25%" valign="top"><p>Maximum 30 years or up to the age of 70 years of    the borrower whichever is early.</p></td>
  </tr>
  <tr>
    <td width="25%" valign="top"><p><a href="http://www.deal4loans.com/icici-hfc-home-loan.php">ICICI Bank Home Loan</a></p></td>
    <td width="25%" valign="top"><p>It depends on the repayment capability and is    restricted to a maximum of 80% of the property value.</p></td>
    <td width="25%" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="25%" valign="top"><p>Maximum 20 years</p></td>
  </tr>
  <tr>
    <td width="25%" valign="top"><p><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php">HDFC Ltd Home Loan</a></p></td>
    <td width="25%" valign="top"><p>Max amount up to 80% of the value of the property    and also depend on the repayment capacity of the individual</p></td>
    <td width="25%" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="25%" valign="top"><p>20 years for loans under fixed rate and 30years    under adjustable rate home loan products</p></td>
  </tr>
  <tr>
    <td width="25%" valign="top"><p><a href="http://www.deal4loans.com/home-loan-axis-bank.php">Axis Bank Home Loan</a></p></td>
    <td width="25%" valign="top"><p>Minimum Rs 3lacs</p></td>
    <td width="25%" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="25%" valign="top"><p>Max. tenure is 25 years for salaried customers<br />
      And 20 years for self-employed customers.<strong></strong></p></td>
  </tr>
  <tr>
    <td width="25%" valign="top"><p>Axis Bank-Empower home loan scheme –a home loan    for self- employed individuals</p></td>
    <td width="25%" valign="top"><p>Minimum Rs 10 lacs<br />
      Maximum  Rs    100lacs in tier 1 &amp; tier 2 cities and Rs 50 lacs in other cities</p></td>
    <td width="25%" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="25%" valign="top"><p>15 years and age of the borrower should not    exceed 65 years of age at the time of maturity<strong>.</strong></p></td>
  </tr>
  <tr>
    <td width="25%" valign="top"><p>Bank of Baroda </p></td>
    <td width="25%" valign="top"><p>Maximum loan amount Rs 100 lacs, maximum finance    upto 75-85% of the project cost.<br />
      The loan eligibility is as follows<br />
      Gross    monthly income Rs 20,000-36 times of the gross monthly salary<br />
      More than Rs 20,000-to Rs 1 lac-48 times of   the gross monthly salary<br />
      More than Rs1lac-84% of the gross monthly income</p></td>
    <td width="25%" align="center" valign="top"><p>Not Available</p></td>
    <td width="25%" valign="top"><p>Max tenure is 25 years</p></td>
  </tr>
  <tr>
    <td width="25%" valign="top"><p>Citibank Home loan</p></td>
    <td width="25%" valign="top"><p>Min Rs 5 lacs and Max. up to Rs 10 crores</p></td>
    <td width="25%" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="25%" valign="top"><p>Max tenure up to 25    years.</p></td>
  </tr>
  <tr>
    <td width="25%" valign="top"><p>HSBC Bank</p></td>
    <td width="25%" valign="top"><p>Min. Rs 2 lacs and max Rs 10 crore</p></td>
    <td width="25%" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="25%" valign="top"><p>For salaried customers its 25 years and for    others 20 years</p></td>
  </tr>
  <tr>
    <td width="25%" valign="top"><p><a href="http://www.deal4loans.com/lic-housing-home-loan.php">LIC Housing    Finance</a></p></td>
    <td width="25%" valign="top"><p>Min. Rs 1lac and max. Rs 150 lacs. Generally the    loan is extended upto 85% of the property value.</p></td>
    <td width="25%" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="25%" valign="top"><p>Max. 25 years. The term for    the loan will under no circumstances exceed the age of retirement or    completion of&nbsp;70 yrs of age whichever is earlier</p></td>
  </tr>
</table>
</div>
  <div  style="clear:both;"></div>
 </div></div></div>
<div style="clear:both; height:15px;"></div>
<?php include "responsive_footer.php"; ?>
</div>
<div class="hide_top_menu">
<?php include "footer_pl.php"; ?>
</div>
</body>
</html>