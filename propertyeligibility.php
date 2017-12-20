<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	require 'scripts/home_loan_eligibility_function.php';
	
	$homeloan = $_REQUEST['calculator'];
	$City = $homeloan;
	if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
	{
		$pageName = "propertyeligibility-calculator/".$homeloan;
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".$pageName);
		exit();
	}
	$CityN = $_REQUEST['calculator'];
$getPageSql = "select * from city_hl_pages where (City='".$CityN."' and Product='HLEligibility' and Status=1) ";
list($NumRows,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());
$Title = $getPageQuery[0]['Title'];
$MetaKeyword = $getPageQuery[0]['MetaKeyword'];
$MetaDescription = $getPageQuery[0]['MetaDescription'];
$PageDescription = $getPageQuery[0]['PageDescription'];
$City =  ucwords(strtolower($getPageQuery[0]['City']));
$HeaderDEscription = $getPageQuery[0]['HeaderDEscription'];
if(strlen($City)>3) {	$retrivesource="HLEligibility_".$City;	$Msg = "";	$newsource=$retrivesource; }
else  {	$retrivesource="HLEligibility_Home";	$Msg = "";	$newsource=$retrivesource; }	
	
	session_start();
function DetermineAgeFromDOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;  if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }
function getNumberFormat($number) {
	if($number > 10000000)	{		$num = ((float)$number) / 10000000;	$num = $num.' Crores';	}
	else if($number > 100000)	{	$num = ((float)$number) / 100000;	$num = $num.' Lacs';	}
	else if($number > 1000)	{		$num = ((float)$number) / 1000;		$num = $num.' Thousands';}
	return $num;
}   
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<?php if(strlen($City)>3) { ?>
<title><?php echo $Title; ?></title>
<meta name="keywords" content="<?php echo $MetaKeyword; ?>">
<meta name="description" content="<?php echo $MetaDescription; ?>">
<?php } else  { ?>
<title>Property Eligibility Calculator India</title>
<meta name="keywords" content="property calculator, find property, property eligibility, find your property in India, eligibility calculator for property, home loan eligibility, ">
<meta name="description" content=" Get Property as per your eligibility and Quote for Home Loan from 10 Banks. Choose as per Lowest interest rates & higher loan amount.">
<?php } ?>
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

.boxmagic-main-wrapper{width:930px; margin:auto;}
.boxmagic-main{ width:450px; float:left; border:#CCCCCC thin solid; margin-right:3px; margin-bottom:5px;}
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
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="http://www.deal4loans.com" class="text12" style="color:#0080d6;" >Home</a></u>  > <a href="/home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> > <span  class="text12" style="color:#4c4c4c;">
 <?php if(strlen($City)>3) { ?> <a href="http://www.deal4loans.com/propertyeligibility-calculator/"  class="text12" style="color:#0080d6;"><u>Property eligibility calculator</u></a>  > <?php echo $City; ?>   <?php } else { echo "Property eligibility calculator"; }?>


</span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<h1 class="h1_text"><?php echo $Title?></h1>
<div style="clear:both; height:5px;"></div>
<div  style="margin:auto; width:100%;">
<div class="hl_emi_cal_form">
<form name="homeloan_calculator" method="post" action="/propertyeligibility-continue1.php" onSubmit="return checkhlcalc();">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2"><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%" colspan="2"><span class="text3" style=" color:#FFF; font-size:24px; text-transform:none; ">
          <?php if(strlen($City)>3) {
			  echo 'Get Property as per your eligibility in '.$City.' <span style="font-size:18px;">- Get Quote for Home Loan from 10 Banks</span>';
		  }
          else {
			  echo 'Get Property as per your eligibility <span style="font-size:18px;">- Get Quote for Home Loan from 10 Banks</span>';		  
		  }
		  
		  ?>
         
          </span></td>
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
              <td height="30"><input name="Net_Salary" id="Net_Salary" maxlength="8" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this); addPersonalDetails();"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');" class="hl_emi_input" /><div id="netSalaryVal"></div>
              
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
$getPageSql = "select * from property_details_hl where City ='".$City."' and Status =1 order by Dated desc";
list($num,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());
for($i=0;$i<$num;$i++)
{
$State = ucwords($getPageQuery[$i]['State']);
$City = ucfirst($getPageQuery[$i]['City']);
$Price = $getPageQuery[$i]['Price'];
$TitleContent = $getPageQuery[$i]['Title'];
$Rate = $getPageQuery[$i]['Rate'];
$CoveredArea = $getPageQuery[$i]['CoveredArea'];
$Facilities = $getPageQuery[$i]['Facilities'];
$Description = $getPageQuery[$i]['Description'];
$ApprovedBy = $getPageQuery[$i]['ApprovedBy'];
$BuilderName = $getPageQuery[$i]['BuilderName'];
$Status = $getPageQuery[$i]['Status'];
$AgentName = $getPageQuery[$i]['AgentName'];
$AgentEmail = $getPageQuery[$i]['AgentEmail'];
$AgentMobile = $getPageQuery[$i]['AgentMobile'];
$AgentPwd = $getPageQuery[$i]['AgentPwd'];

?>
<?php if(strlen($TitleContent)>1) { ?>
<div class="boxmagic-main">
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" valign="middle" bgcolor="#f9f9f9" class="textmag-head" style="border-bottom:#CCC solid thin;"><?php echo $TitleContent; ?></td>
    </tr>
  <tr>
    <td colspan="2" height="5"></td>
    </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" class="price-text"><?php if(strlen($Price)>1) { ?><img src="/new-images/rupees.gif" border="0" width="10" height="12" /><?php echo getNumberFormat($Price); ?><?php } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody"><?php if(strlen($Rate)>1) { ?><strong>Price per Sq-ft.</strong>: <img src="/new-images/rupees.gif" border="0" width="8" height="10" /><?php echo $Rate; ?><?php } ?><?php if(strlen($CoveredArea)>1) { ?> | <strong>Covered Area - </strong><?php echo $CoveredArea; ?> Sq-ft.<?php } ?></td>
  </tr>
  <tr>
    <td colspan="2" height="7"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody"><?php if(strlen($BuilderName)>1) { ?><strong>Builder - </strong><?php echo $BuilderName; ?><?php } ?><?php if(strlen($ApprovedBy)>1) { ?> | <strong>Approved By - </strong><?php echo $ApprovedBy; ?><?php } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody">
      <input type="submit" name="button" id="button" value="Contact Agent" class="buttonmag"  onClick="alert( 'Please Fill the Form to get Agents Details!' )" />
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
<div ><?php echo $HeaderDEscription; ?></div>
<div style="clear:both;"></div>
<div ><?php echo $PageDescription; ?></div>
<div style="clear:both;"></div>

<div style=" width:100%; height:auto; margin-top:5px; margin-left:10px; text-align:justify;">
 <?php if(strlen($City)>3) { ?>
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
 <?php } else { ?>
 <div style="padding-top:5px; padding-bottom:2px;">
<div class="boxmagic-main-wrapper">
<?php 
$getPageSql = "select * from property_details_hl where Status =1 order by RAND() LIMIT 0,10";
//$getPageSql = "select * from property_details_hl where 1=1";
list($num,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());
for($i=0;$i<$num;$i++)
{
$State = ucwords($getPageQuery[$i]['State']);
$City = ucfirst($getPageQuery[$i]['City']);
$Price = $getPageQuery[$i]['Price'];
$TitleContent = $getPageQuery[$i]['Title'];
$Rate = $getPageQuery[$i]['Rate'];
$CoveredArea = $getPageQuery[$i]['CoveredArea'];
$Facilities = $getPageQuery[$i]['Facilities'];
$Description = $getPageQuery[$i]['Description'];
$ApprovedBy = $getPageQuery[$i]['ApprovedBy'];
$BuilderName = $getPageQuery[$i]['BuilderName'];
$Status = $getPageQuery[$i]['Status'];
$AgentName = $getPageQuery[$i]['AgentName'];
$AgentEmail = $getPageQuery[$i]['AgentEmail'];
$AgentMobile = $getPageQuery[$i]['AgentMobile'];
$AgentPwd = $getPageQuery[$i]['AgentPwd'];

?>
<?php if(strlen($TitleContent)>1) { ?>
<div class="boxmagic-main">
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" colspan="2" valign="middle" bgcolor="#f9f9f9" class="textmag-head" style="border-bottom:#CCC solid thin; font-size: 14px;"><?php echo $TitleContent; ?></td>
    </tr>
  <tr>
    <td colspan="2" height="5"></td>
    </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" class="price-text"><?php if(strlen($Price)>1) { ?><img src="/new-images/rupees.gif" border="0" width="10" height="12" /><?php echo getNumberFormat($Price); ?><?php } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody"><?php if(strlen($Rate)>1) { ?><strong>Price per Sq-ft.</strong>: <img src="/new-images/rupees.gif" border="0" width="8" height="10" /><?php echo $Rate; ?><?php } ?><?php if(strlen($CoveredArea)>1) { ?> | <strong>Covered Area - </strong><?php echo $CoveredArea; ?> Sq-ft.<?php } ?></td>
  </tr>
  <tr>
    <td colspan="2" height="7"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody"><?php if(strlen($BuilderName)>1) { ?><strong>Builder - </strong><?php echo $BuilderName; ?><?php } ?><?php if(strlen($ApprovedBy)>1) { ?> | <strong>Approved By - </strong><?php echo $ApprovedBy; ?><?php } ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="textmagbody">
      <input type="submit" name="button" id="button" value="Contact Agent" class="buttonmag"  onClick="alert( 'Please Fill the Form to get Agents Details!' )"  />
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
 <?php } ?>
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
<div style=" width:100%; height:auto; margin-top:10px; text-align:justify;"></div>
<br /></td>
</tr></table>

<div  style="clear:both;"></div>
 </div></div></div>
<div style="clear:both; height:15px;"></div>
<?php include "responsive_footer.php"; ?>
</div>
<div class="hide_top_menu">
<?php include "footer_property.php"; ?>
</div>
</body>
</html>