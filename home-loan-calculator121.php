<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	require 'scripts/home_loan_eligibility_function.php';
	session_start();
function DetermineAgeFromDOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;  if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }
$maxage=date('Y')-62;
$minage=date('Y')-18;
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Net_Salary = $_POST['Net_Salary'];
	$getnetAmount = ($Net_Salary /12);
	$loan_amount = $_POST['Loan_Amount'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dateofbirth = $year."-".$month."-".$day;
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	$total_obligation = $_POST['total_obligation'];
	$netAmount=($getnetAmount - $total_obligation);
	$strCity = "Delhi";
	$property_value = $_POST['Property_Value'];
	$_SESSION['property_value'] = $property_value;
	$_SESSION['loan_amount'] = $loan_amount;
	$_SESSION['Net_Salary'] = $Net_Salary;
	$_SESSION['day'] = $day;
	$_SESSION['month'] = $month;
	$_SESSION['year'] = $year;
	$_SESSION['total_obligation'] = $total_obligation;
}
function money_F($number)
{
	setlocale(LC_ALL, 'en_IN');
 	$strnumber=money_format('%i', $number);
	list($First_num,$Last_num) = split('[ ]', $strnumber);
	$money_strnum = substr(trim($Last_num), 0, strlen(trim($Last_num))-3);
	$getmoney_term[]= $money_strnum;
	return($getmoney_term);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Home Loan Eligibility Calculator | Calculate Home Loan Eligibility</title>
<meta name="keywords" content="home loan calculator, home loan eligibility calculator, Home loan calculator India, housing loan eligibility, housing loan eligibility calculator, housing loan eligibility India"> 
<meta name="Description" content="Home Loan Eligibility Calculator: Calculate loan eligibility for housing loan. Get instant quotes by HDFC ltd, Axis Bank, ICICI, DHFl, LIC Housing & SBI Bank of India.">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
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
		
	/*if((document.homeloan_calculator.City.value=="Others") && ((document.homeloan_calculator.City_Other.value=="" || document.homeloan_calculator.City_Other.value=="Other City"  ) || !isNaN(document.homeloan_calculator.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.homeloan_calculator.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.homeloan_calculator.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.homeloan_calculator.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.homeloan_calculator.City_Other.focus();
  		return false;
  	}

  }
  */
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
	
	ni1.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top:7px;" > <tr><td   align="left" valign="top" style="padding-left:55px;" colspan="4"> <table width="100%" border="0" cellpadding="0" cellspacing="0">                                        <tr>                        <td width="21%"  align="left" style="font-size:21px; color:#FFFFFF;"> Personal Details</td>                        <td style="font-size:13px; font-weight:normal; color:#fff;"><img src="images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td>                             </tr>                                  </table></td></tr><tr><td   align="left" valign="top" style="padding-left:55px;"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:183px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Name" id="Name" type="text" style="width:180px; height:18px;" onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div>   </div></div></td><td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><div class="text" style=" float:left; clear:right;"><input name="day" id="day" type="text" style="width:43px; height:18px;" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><img src="http://www.deal4loans.com/new-images/spacer.gif" width="6px;" /></div><div class="text" style=" float:left; clear:right;"><input name="month" id="month" type="text" style="width:43px; height:18px;" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><img src="http://www.deal4loans.com/new-images/spacer.gif" width="6px;" /></div>&nbsp;<div class="text" style=" float:left; clear:right;"><input name="year" id="year" type="text" style="width:60px; height:18px;" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /></div><div id="dobVal"></div>   </div></div></td><td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div><div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; "><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" style="width:153px; height:18px;" onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div>  </div></div></div></td><td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Email" id="Email" type="text" style="width:180px; height:18px;" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div> </div></div></td></tr><tr><td   align="left" valign="top" style="padding-left:55px;"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Value:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Property_Value" id="Property_Value" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text" style="width:180px; height:18px;" onKeyDown="validateDiv(\'propertyValueVal\');" /><div id="propertyValueVal"></div></div></div></td><td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Total EMI of All Loans :</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="total_obligation" id="total_obligation" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text" style="width:180px; height:18px;" onKeyDown="validateDiv(\'obligationVal\');" /><div id="obligationVal"></div></div></div></td></tr><tr><td width="11"  colspan="4" align="left" style="padding-left:55px;" valign="top" ><table cellpadding="0" width="100%"><tr><td valign="top" ><div class="text" style=" float:left; height:auto; color:#FFF; font-size:11px; text-transform:none; margin-top:5px;"><input name="accept" type="checkbox"  /> I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div></td><td   align="left" valign="top"><div style=" float:right;  height:47px; margin-top:0px; margin-left:0px;"><input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td></tr></table>';

}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.homeloan_calculator.City.value;
//	var otrcit = document.loan_form.City_Other.value;
ni1.innerHTML = '';
	if(cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px; width:706px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
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
</style>
</head>
<body>
<?php include "top-menu.php";  include "main-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span  class="text12" style="color:#4c4c4c;">Home Loan Eligibility Calculator </span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
<form name="homeloan_calculator" method="post" action="apply-home-loans-calc-continue1.php" onSubmit="return checkhlcalc();">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="Home Loan Calc">
<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
<tr><td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td></tr>
<tr><td height="35" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0"><tr><td width="24"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="2px;" /></td><td><h1 class="text3" style=" color:#FFF; font-size:24px; text-transform:none; ">Home Loan Eligibility Calculator <span style="font-size:18px;">- Get Instant Quote from Top 10 Banks</span></h1> </td></tr></table></td></tr>
<tr>
<td  align="center" valign="top" bgcolor="#21405F"><table width="943" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="11"  align="left" valign="top" style="padding-left:55px; font-size:19px; color:#FFFFFF;" colspan="4">
Professional Details
</td>
</tr>
<tr>

<td   align="left" valign="top" style="padding-left:55px;"><div style=" float:left; width:183px;  margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Required Loan Amount:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:180px; height:18px;" onKeyDown="validateDiv('loanAmtVal');" /><div id="loanAmtVal"></div></div><span id='formatedlA' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></div></td>

<td  align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal'); addPersonalDetails();"  style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" ><option value="-1">Please Select</option><option value="1">Salaried</option><option value="0">Self Employment</option></select><div id="empStatusVal"></div></div></div></td>
<td   align="left" valign="top" ><div style=" float:left; width:183px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input type="text" name="Net_Salary" id="Net_Salary" style="width:180px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');"  /><div id="netSalaryVal"></div>   </div>  <span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></div></td>
<td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                   <select name="City" id="City" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="7"><?=getCityList($City)?></select><div id="cityVal"></div>   </div></div></td>
</tr>
<tr>
<td  colspan="4" align="left" valign="top" id="personalDetails" >

<table cellpadding="0" width="100%"><tr>
<td   align="right" valign="top"><img src="images/get1.gif" border="0" /></td>
</tr>

</table></td></tr>
<tr>
<td colspan="4" align="left" style="padding-left:55px;" valign="top" >
 <div id="hdfclife"></div>  
</td></tr>
</table></td></tr>
<tr><td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td></tr>
</table></td></tr>
</table>
</form>
</div>
<div style=" float:left; width:940px; height:auto; margin-top:5px; margin-left:10px; text-align:justify;">
          <table width="940"  cellpadding="0" cellspacing="0">
          <tr><td>
   <p style="color:#4c4c4c; " class="body_text">   <span class="text" style="color:#4c4c4c; font-size:15px; font-weight:bold;">  Sample Home Loan Eligibility</span> - 
 Employment Status - <strong>Salaried</strong> | Annual Income - <strong>Rs. 12 Lacs</strong> | Property Value - <strong>Rs. 75 Lacs</strong> | Tenure - <strong>20 Yrs</strong></p>
          </td></tr>
          
  <tr>
    <td bgcolor="#EBEBEB"><table style="border:#CCC solid thin;" cellpadding="2"  cellspacing="2" align="center">
          <tr>
                <th width="148" align="center" bgcolor="#FFFFFF" class="heading_text">Bank Name</th>
               <th width="238" align="center" bgcolor="#FFFFFF" class="heading_text">Interest Rate</th>
               <th width="266" align="center" bgcolor="#FFFFFF" class="heading_text">Emi (per Month)</th>
              <th width="186" align="center" bgcolor="#FFFFFF" class="heading_text">Eligible Loan Amount</th>
            </tr>
               <tr>
                <td align="center" bgcolor="#FFFFFF"  height="45"><img src="http://www.deal4loans.com/new-images/federal_bnksmll.jpg" ><br>
                  <span class="fed_bank">A FEDERAL BANK  SUBSIDIARY</span></td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">10.5 %</td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.56658</td>
                <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 5675000</td>
            </tr>
               <tr>
                <td height="45" align="center" valign="middle" bgcolor="#FFFFFF"><img src="http://www.deal4loans.com/new-images/pnbhfl-logo.jpg" width="105" height="20"><br>
                 <span class="pnb_housing">PNB Housing Finance</span></td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">11 %</td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.51693</td>
                <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 5008114</td>
            </tr>
              <tr>
                <td align="center" bgcolor="#FFFFFF"><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" ><br>
                  <span class="icici_bank">ICICI Bank</span></td>
                <td bgcolor="#FFFFFF" class="body_text1"><strong>Scheme I:</strong> 10.5% (Fixed for 1yr),<br>
                      <strong>Scheme II:</strong>10.5% (Fixed for 2yrs)<br>
                  <strong>Scheme III:</strong>10.75% (Fixed for 3yrs),<br>
                  Then 10.5 %</td>
                <td bgcolor="#FFFFFF" class="body_text1"><strong>Scheme I:</strong> 41682.36 (Fixed for 1yr),<br>
                      <strong>Scheme II:</strong> 41682.36 (Fixed for 2yrs)<br>
                  <strong>Scheme III:</strong> 42385.81 (Fixed for 3yrs), Then 41682.36</td>
                <td align="center" bgcolor="#FFFFFF" class="body_text"><strong>Rs. 5010000</strong></td>
            </tr>
            
              <tr>
                <td height="45" align="center" bgcolor="#FFFFFF"><img src="http://www.deal4loans.com/new-images/thnk-axis.gif" width="86" height="20"><br>
                  <span class="axis_bank">Axis Bank</span></td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">10.5 %</td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">Rs. 55020</td>
                <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 5511022</td>
            </tr>
             
              <tr>
                <td height="45" align="center" valign="middle" bgcolor="#FFFFFF"><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20"><br>
                  <span class="Hdfc_ltd_bank">HDFC Ltd</span></td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">10.4 %</td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.49983</td>
                <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 5040323</td>
            </tr>
               <tr>
                <td align="center" bgcolor="#FFFFFF"  height="45">
                  <span class="fed_bank">SBI</span></td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">10.10 %</td>
                <td align="center" bgcolor="#FFFFFF" class="body_text">Rs.48588</td>
                <td align="center" bgcolor="#FFFFFF" class="style100">Rs. 5000632</td>
            </tr>              
           </table>
   </td>
  </tr>
</table>
<div style="text-align:right;" class="font2"> <a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></div>
<table cellpadding="0" cellspacing="0" border="0" class="font2"><tr><td valign="top" style="padding:3px;"> Following are eligible to 
<a href="http://www.deal4loans.com/apply-home-loans.php">apply for a Home Loan</a> :<br> 
•	Salaried individuals<br> 
•	Self employed professionals/businessmen <br><br>
You can include your spouse/parents/children as co-applicant if you require higher eligibility subject to maximum of three applicants. <br />
<h3 class="text" style="color:#4c4c4c; size:18px; height:15px;">Home Loans Eligibility Factors</h3>
Home loans are an easy option for buying a house but getting the right amount depends on many factors and this may depend upon the factors listed below:
<br />
<div style=" float:left; width:930px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Monthly Income</span><br />  <span class="text11" style="color:#4c4c4c; ">The income that he earns from which he will pay his home loan emi is one of the most important factors that affect the amount of loan. So if you are salaried your per month income and if you are self employed, your yearly profit would identify your home loan max eligibility.<br />
The loan amount basically depends upon the net income of an individual and a bank usually provides home loans up to 60 times of an individual net income. For e.g. if a person take home salary is Rs 30,000 he /she may be offered a home loan of around Rs 18 lacs. But it may not be so because a bank takes into account other factors as well while granting a loan.
</span></div>
<div style=" float:left; width:930px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Other EMI</span><br />  <span class="text11" style="color:#4c4c4c; ">Other Emi (Equally monthly installment) is the emi that we are paying to for any other <a href="http://www.deal4loans.com/">Loan</a>.</span></div>
<div style=" float:left; width:930px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Available Income</span><br />  <span class="text11" style="color:#4c4c4c; "> The income that is left in our hand after deduction of any emi amount that we are paying for any kind of loan. Your <a href="http://www.deal4loans.com/home-loan-calculator.php">Home Loan Eligibility Calculator</a>  will be calculated after deduction of the EMI’s that you are paying.</span></div>
<div style=" float:left; width:930px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Property Attributes</span><br />  <span class="text11" style="color:#4c4c4c; "> Banks give max upto 85% of loan against the value of the property. So if you want a home loan for a 50 lac property max that u can get is 85% of that ie 42.50 lacs. This too if in case you have the income to give the emi of that loan. So based on Income and property value banks decide your exact home loan eligibility.<br />
Banks also have certain specific criteria before accepting the property for granting a loan. The banks have specific norms with respect to the minimum area requirements for a flat which may be carpet area or built up area. The bank also considers the age of the property in case of an existing property, the location of the property and also the reputation of the builders constructing the property. The bank also performs a thorough analysis and inspection of the property to check whether the title is clear or not, or are there any ownership disputes, whether the bank is free from any encumbrances etc.
</span></div>

<br />
<div style=" float:left; width:940px; height:auto; margin-top:2px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:14px; font-size:15px; font-weight:bold;"><br />Duration of Loan (Years)</span><br />
  <span class="text11" style="color:#4c4c4c; ">It’s one of the most important factors that one should keep in mind while taking loan. It refers to the no. of years for which the loan has to be taken. Longer the tenure higher will be the interest paid and lower will be amount of EMI to be paid and vice-a-versa. It is one of the parameters which helps in comparing the EMIs from different banks keeping it constant for relationship and easing the judgment.</span></div>
<div style=" float:left; width:940px; height:auto; margin-top:15px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Interest Rate (in percentage)</span><br />
  <span class="text11" style="color:#4c4c4c; ">Today there are many lenders in the market. Every bank is offering loans whether it’s a nationalized bank, private bank or foreign bank each of them is there in the show. Every bank offers different rate of interest according to the profile of the customer. So, before finalizing a deal one should consider deals from various banks and than come to a conclusion. And aware of the fact that some people might mislead you by charging high rate of interest at reducing rate and might inform the same at flat rate of interest. So, its always advisable to check full detail with the banks and do better comparison in respect of EMIs , Tenure and <a href="http://www.deal4loans.com/home-loans-interest-rates.php">Interest Rates</a>  and keeping tenure as constant with all the banks will ease your comparison and will result in better analysis, finally leading to a prudent decision.</span> </div>
<div style=" float:left; width:940px; height:auto; margin-top:15px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">EMI</span><br />
<span class="text11" style="color:#4c4c4c; "> EMI stands for equally monthly installment; you need to pay a particular amount for the Home loan that you have taken.</span></div>
<div style=" float:left; width:940px; height:auto; margin-top:15px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Eligible Loan Amount</span><br />
<span class="text11" style="color:#4c4c4c; "> The net loan amount for which you are eligible for your Home loan is said as Eligible Loan Amount. The loan amount that a Bank can sanction you.</span></div>

<div style=" float:left; width:930px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Credit History</span><br />  <span class="text11" style="color:#4c4c4c; ">The credit history of an individual plays an important role in deciding the amount of loan. Credit history is basically the credit information report of an individual generated by a credit information company on the basis of individual’s credit records. On the basis of the credit information report an individual is being given a credit score. Based on the credit score a bank or any other financial institution decides whether the individual is eligible for a loan or not. The credit history is generally affected by outstanding credit card payments and any unsecured loans. In India CIBIL is a reputed credit information company and it analyses the financial records of individuals and awards them a score which is known as the "CIBIL score".</span></div>

<div style=" float:left; width:930px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Age</span><br />  <span class="text11" style="color:#4c4c4c; "> Age also plays a crucial role in determining the eligibility for a home loan. One has to attain a minimum age of 21 to apply for a loan. The minimum age requirement may be different for different lending institution. The maximum age may vary from 58 to 65 years depending on the income source of the individual. The age also determines the tenure and EMI of the loan. For e.g. if an individual is 35 years of age and retires  at an age of 60 then his/her loan tenure will be 60-35=25 years and his /her EMI will be calculated accordingly. Longer the tenure lower will be the EMI’s. However the longer the tenure, the costlier the loan is as one ends up paying more interest rates.</span></div>

<div style=" float:left; width:930px; height:auto; margin-top:10px; text-align:justify;"><span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Co-applicant</span><br />  <span class="text11" style="color:#4c4c4c; "> In order to enhance the eligibility for having a loan one can have a co-applicant and in this way the total eligible income for having a home loan increases and thus as a result the loan eligibility becomes higher. However bank permits only certain relationships to become the co-applicant, friends and relatives who are not blood relatives to take a loan amount jointly.</span></div>
</td></tr></table>

<div style=" float:left; width:930px; height:auto; margin-top:10px; text-align:justify;">
<span class="text" style="color:#4c4c4c; size:18px; font-size:15px; font-weight:bold;">Some of the features of home loans offered by different banks</span><br /><br />
<table border="1" cellspacing="0" cellpadding="3" class="font2" width="100%">
  <tr>
    <td width="182" align="center" valign="top"><p><strong>Name </strong></p></td>
    <td width="287" align="center" valign="top"><p><strong> Loan Amount</strong></p></td>
    <td width="213" align="center" valign="top"><p><strong>Minimum Salary    Requirements</strong></p></td>
    <td width="238" align="center" valign="top"><p><strong>Tenure</strong></p></td>
  </tr>
  <tr>
    <td width="182" valign="top"><p><a href="http://www.deal4loans.com/sbi-home-loan.php">SBI Home loan</a></p></td>
    <td width="287" valign="top"><p> It will be determined taking into    consideration such factors as applicant’s income and repaying capacity, age,    assets and liabilities, cost of the proposed house/flat etc.</p></td>
    <td width="213" align="center" valign="top"><p>Not Available</p></td>
    <td width="238" valign="top"><p>Maximum 30 years or up to the age of 70 years of    the borrower whichever is early.</p></td>
  </tr>
  <tr>
    <td width="182" valign="top"><p><a href="http://www.deal4loans.com/icici-hfc-home-loan.php">ICICI Bank Home Loan</a></p></td>
    <td width="287" valign="top"><p>It depends on the repayment capability and is    restricted to a maximum of 80% of the property value.</p></td>
    <td width="213" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="238" valign="top"><p>Maximum 20 years</p></td>
  </tr>
  <tr>
    <td width="182" valign="top"><p><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php">HDFC Ltd Home Loan</a></p></td>
    <td width="287" valign="top"><p>Max amount up to 80% of the value of the property    and also depend on the repayment capacity of the individual</p></td>
    <td width="213" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="238" valign="top"><p>20 years for loans under fixed rate and 30years    under adjustable rate home loan products</p></td>
  </tr>
  <tr>
    <td width="182" valign="top"><p><a href="http://www.deal4loans.com/home-loan-axis-bank.php">Axis Bank Home Loan</a></p></td>
    <td width="287" valign="top"><p>Minimum Rs 3lacs</p></td>
    <td width="213" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="238" valign="top"><p>Max. tenure is 25 years for salaried customers<br />
      And 20 years for self-employed customers.<strong></strong></p></td>
  </tr>
  <tr>
    <td width="182" valign="top"><p>Axis Bank-Empower home loan scheme –a home loan    for self- employed individuals</p></td>
    <td width="287" valign="top"><p>Minimum Rs 10 lacs<br />
      Maximum  Rs    100lacs in tier 1 &amp; tier 2 cities and Rs 50 lacs in other cities</p></td>
    <td width="213" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="238" valign="top"><p>15 years and age of the borrower should not    exceed 65 years of age at the time of maturity<strong>.</strong></p></td>
  </tr>
  <tr>
    <td width="182" valign="top"><p>Bank of Baroda </p></td>
    <td width="287" valign="top"><p>Maximum loan amount Rs 100 lacs, maximum finance    upto 75-85% of the project cost.<br />
      The loan eligibility is as follows<br />
      Gross    monthly income Rs 20,000-36 times of the gross monthly salary<br />
      More than Rs 20,000-to Rs 1 lac-48 times of   the gross monthly salary<br />
      More than Rs1lac-84% of the gross monthly income</p></td>
    <td width="213" align="center" valign="top"><p>Not Available</p></td>
    <td width="238" valign="top"><p>Max tenure is 25 years</p></td>
  </tr>
  <tr>
    <td width="182" valign="top"><p>Citibank Home loan</p></td>
    <td width="287" valign="top"><p>Min Rs 5 lacs and Max. up to Rs 10 crores</p></td>
    <td width="213" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="238" valign="top"><p>Max tenure up to 25    years.</p></td>
  </tr>
  <tr>
    <td width="182" valign="top"><p>HSBC Bank</p></td>
    <td width="287" valign="top"><p>Min. Rs 2 lacs and max Rs 10 crore</p></td>
    <td width="213" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="238" valign="top"><p>For salaried customers its 25 years and for    others 20 years</p></td>
  </tr>
  <tr>
    <td width="182" valign="top"><p><a href="http://www.deal4loans.com/lic-housing-home-loan.php">LIC Housing    Finance</a></p></td>
    <td width="287" valign="top"><p>Min. Rs 1lac and max. Rs 150 lacs. Generally the    loan is extended upto 85% of the property value.</p></td>
    <td width="213" align="center" valign="top"><p>Not Available<strong></strong></p></td>
    <td width="238" valign="top"><p>Max. 25 years. The term for    the loan will under no circumstances exceed the age of retirement or    completion of&nbsp;70 yrs of age whichever is earlier</p></td>
  </tr>
</table>
</div>

<div class="tbl_txt">
<h3>Other Available Calculators are - </h3>
<a href="Contents_Calculators.php"><b>EMI Calculator</b></a> | 
<a href="http://deal4loans.com/car-loan-emi-calculator.php" ><b>Car Loan EMI Calculator</b></a> | 
<a href="balance-transfer-home-loans.php"><strong>Home Loan Balance Transfer</strong></a> | 
<a href="loan-amortization-calculator.php"><strong>Loan Amortization Calculator</strong></a>
</div></div></div></div>
<div style="clear:both; height:15px;"></div>
<?php include "footer_calc.php"; ?>
</body>
</html>