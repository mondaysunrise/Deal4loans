<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$CityN = $_REQUEST['loan'];
/*
if(strlen(strpos($_SERVER['REQUEST_URI'], "?")) > 0)
{
	
	$pageName = "home-loan/".$CityN;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$pageName);
	exit();
}
*/
$maxage=date('Y')-62;
$minage=date('Y')-18;

$CityN = $_REQUEST['loan'];
	 $getPageSql = "select * from city_pages where City='".$CityN."' and Product='Home Loan' ";
 list($recordcount,$getrow)=MainselectfuncNew($getPageSql,$array = array());
		$cntr=0;
	$Title = $getrow[$cntr]['Title'];
	$MetaKeyword = $getrow[$cntr]['MetaKeyword'];
	$MetaDescription = $getrow[$cntr]['MetaDescription'];
	$PageDescription = $getrow[$cntr]['PageDescription'];
	$City =  ucwords(strtolower($getrow[$cntr]['City']));
	$HeaderDEscription = $getrow[$cntr]['HeaderDEscription'];
	$retrivesource="HL_".$City;
	$newsource=$retrivesource;
	$subjectLine="Home Loan ".$City;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title><?php echo $Title; ?></title>
<meta name="keywords" content="<?php echo $MetaKeyword; ?>">
<meta name="description" content="<?php echo $MetaDescription; ?>">
<link href="http://www.deal4loans.com/source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://www.deal4loans.com/scripts/mainmenu.js"></script>

<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
<style>
.tblwt_txt {
    color: #1c50b0;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 13px;
    font-weight: bold;
    padding: 2px;
}
.tbl_txt {
    color: #373737;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 11px;
    padding: 2px;
}
#txt a {
    color: #1C50B0;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 11px;
    line-height: 15px;
    text-decoration: none;
}
#txt  a {
      text-decoration: none;
  }
#txt   a:link {
     color: #666666;
  }
#txt   a:visited {
      color: #666666;
  }
#txt   a:active {
      color: #666666;
  }
#txt   a:hover {
      color: #FF9900;
  }
</style>
<style type="text/css">
<!--
.style1 {font-family: 'Droid Sans', sans-serif}
.style2 {font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);font-family: 'Droid Sans', sans-serif;}
-->
</style>
<?php //include "hl-form-js.php"; ?>
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
	
	ni1.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top:7px;" ><tr><td align="left" valign="top" style="padding-left:55px;" colspan="4"> <table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td width="21%"  align="left" style="font-size:21px; color:#FFFFFF;"> Personal Details</td><td style="font-size:13px; font-weight:normal; color:#fff;"><img src="/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td></tr></table></td></tr><tr><td   align="left" valign="top" style="padding-left:55px;"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:183px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Name" id="Name" type="text" style="width:180px; height:18px;" onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div>   </div></div></td><td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><div class="text" style=" float:left; clear:right;"><input name="day" id="day" type="text" style="width:43px; height:18px;" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><img src="http://www.deal4loans.com/new-images/spacer.gif" width="6px;" /></div><div class="text" style=" float:left; clear:right;"><input name="month" id="month" type="text" style="width:43px; height:18px;" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><img src="http://www.deal4loans.com/new-images/spacer.gif" width="6px;" /></div>&nbsp;<div class="text" style=" float:left; clear:right;"><input name="year" id="year" type="text" style="width:60px; height:18px;" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /></div><div id="dobVal"></div>   </div></div></td><td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div><div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; "><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" style="width:153px; height:18px;" onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div>  </div></div></div></td><td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Email" id="Email" type="text" style="width:180px; height:18px;" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div> </div></div></td></tr><tr><td   align="left" valign="top" style="padding-left:55px;"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Value:</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Property_Value" id="Property_Value" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text" style="width:180px; height:18px;" onKeyDown="validateDiv(\'propertyValueVal\');" /><div id="propertyValueVal"></div></div></div></td><td   align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Total EMI of All Loans :</div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="total_obligation" id="total_obligation" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text" style="width:180px; height:18px;" onKeyDown="validateDiv(\'obligationVal\');" /><div id="obligationVal"></div></div></div></td></tr><tr><td width="11"  colspan="4" align="left" style="padding-left:55px;" valign="top" ><table cellpadding="0" width="100%"><tr><td valign="top" ><div class="text" style=" float:left; height:auto; color:#FFF; font-size:11px; text-transform:none; margin-top:5px;"><input name="accept" type="checkbox"  /> I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></div></td><td   align="left" valign="top"><div style=" float:right;  height:47px; margin-top:0px; margin-left:0px;"><input type="submit" style="border: 0px none ; background-image: url(/images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td></tr></table>';

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

<link href="/css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/js/sprinkle.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="/js/dropdowntabs.js"></script>
<script type="text/javascript" src="/js/easySlider1.5.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
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
    <script type="text/javascript" src="http://www.deal4loans.com/scripts/mootools.js"></script>
<style>h3{	font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	text-decoration:none;	color:#1c50b0;	padding:0px;	margin:0px 0px 0px 0px;	text-align:left;}.faqContainer{	padding:3px;}.faqContainer .toggler {	padding:5px 0px 0px 15px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:13px;	line-height:17px;	font-weight:bold;	text-align:justify;	background:transparent url(images/bullet12.gif) no-repeat scroll 0px 10px;	cursor:pointer;}.elementInside{	border-bottom:1px solid #CCCCCC;	margin:4px 0px 8px 0px;	padding:4px 0px 10px 0px; 	font-family: Verdana, Geneva, sans-serif;	font-size: 11px;	font-weight: normal;	font-variant: normal;	color: #4c4c4c;	text-decoration: none;}.element_atStart_dv{margin:4px 0px 8px 0px; border-bottom:1px solid #CCCCCC; height:auto; font-family: Verdana, Geneva, sans-serif;	font-size: 11px;	font-weight: normal;	font-variant: normal;	color: #4c4c4c;	text-decoration: none; }</style>
<script type="text/javascript">
window.addEvent('domready', function(){
var accordion = new Accordion('h3.atStart', 'div.atStart', {
opacity: false,
onActive: function(toggler, element){
toggler.setStyle('color', '#FF0000');
},
onBackground: function(toggler, element){
toggler.setStyle('color', '#062B5F');
}
}, $('accordion'));
var newTog = new Element('h3', {'class': 'toggler1'}).setHTML('');
var newEl = new Element('div', {'class': 'element1'}).setHTML('');
accordion.addSection(newTog, newEl, 0);
}); 
</script>
</head>
<body>
<!--top-->

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->


<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="/index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="/home-loans.php"  class="text12" style="color:#4c4c4c;">Home Loan</a></u> >  <span class="text12" style="color:#4c4c4c;"> Apply Home Loan - <?php echo $City?></span></div>
<div class="intrl_txt">
<div style="width:970px; height:23; margin-top:5px; float:left; clear:right;">
<h1 class="text3"  style="width:700px; height:23; margin-top:0px; float:left; clear:right; font-size:24px; text-transform:none; color:#88a943; margin-left:15px;">Home Loan <?php echo $City?></h1>
<div class="text3" style="width:140px; height:23; margin-top:5px; float:right; clear:right;"><a href="/home-loan-emi-calculator1.php" ><img src="/images/emihl.gif" name="Image3" width="135" height="20" border="0" id="Image3" /></a></div>
</div>
<div style=" margin-left:15px; float:left; width:940px; height:1px; margin-top:1px; "><img src="/images/point5.gif" width="940" height="1" /></div>

<div style="clear:both; height:5px;"></div>
<div id="txt" >
<?php include "hl-form1.php";?>
<br />
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0"  style="border: 1px solid #ececec; ">
  
  <tr>
    <td valign="top"  >
    <table width="132" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:14px;">Banks</strong></td></tr>
  <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Rate of Interest 
        </strong></td></tr>
  <tr>
        <td width="142" height="76" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Processing Fee
        </strong></td></tr>
        
          <tr>
        <td width="142" height="60" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong>Prepayment Charges
        </strong></td></tr>
       
              </table>
        </td>
<?php
$gethlrates=("Select ndtv_rates,bank_name,bank_url,processing_fee,prepayment_charges From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (5,8,2,203,3) and flag=1) order by  priority ASC");
 list($rowscount,$myrow)=MainselectfuncNew($gethlrates,$array = array());
		


	
	?>
                <?
		 if($rowscount>0)
		 {
		 	$i=0;
		while($i<count($myrow))
        {?>
  <td valign="top"  >
    <table width="165" border="0" align="center" cellpadding="0" cellspacing="0"  >
      <tr>
        <td height="30" align="center" valign="middle" class="font2" style="background-color:#88a943; border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;"><strong class="text3" style="color:#FFF; text-transform:none; font-size:16px;"><? echo $myrow[$i]["bank_name"];?></strong></td></tr>
  <tr>
        <td width="142" height="30" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size:12px;"><? echo $myrow[$i]["ndtv_rates"];?></td></tr>
  <tr>
        <td width="142" height="76" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px;  font-size:12px;"><? echo $myrow[$i]["prepayment_charges"];?></td></tr>
       
          <tr>
        <td width="142" height="60" align="center" valign="middle" class="font2" style="border-right:1px solid #d5cfb1; border-bottom:1px solid #d5cfb1; padding-left:2px; font-size:12px;"><? echo $myrow[$i]["processing_fee"];?></td></tr>
         
              </table>
        </td>
          <? 
			   $i=$i+1;
			   }
			   }
			   ?>
  </tr>
</table>

<div style="clear:both;"></div>
<div>
 <div class="faqContainer">
               <div id="demo">
                  <div id="accordion">
                    <div style="width:200px; float:left;"><h3 class="toggler atStart"><b>Eligibility Criteria</b></h3></div> <div style="width:250px; float:left;"><h3 class="toggler atStart"><b>List of Home Loans Banks </b></h3></div> <div style="width:300px; float:left;"><h3 class="toggler atStart"><b>Documents required for Home Loan</b></h3></div><div style="clear:both;"></div>
                    <div class="element atStart">
                      <div class="elementInside">  
                      <p> <span style="font-size:13px; font-weight:bold;">Eligibility Criteria for Home Loan in <?php echo $City?></span><br /><br /> The  borrower's eligibility of getting a housing loan depend upon his/her repayment  capacity &amp; the banks establish this repayment capacity by considering  various factors such income, spouse's income, age, number of dependants  qualifications , assets, liabilities, stability and continuity of occupation  and savings history. <a href="http://www.deal4loans.com/home-loan-calculator.php">Calculate your  Eligibility for Home loan</a><br />
                          Your <a href="http://www.deal4loans.com/home-loans.php">Home  Loan</a> eligibility is determined by your repayment capacity, taking into  consideration, factors such as: Your:<br />
                          • Income<br />
                          • Qualifications<br />
                          • Age<br />
                          • Spouse's income<br />
                          • No. of dependants<br />
                          • Stability and continuity of occupation<br />
                          • Assets/LiabilitiesM.<br />
                          • Savings history.<br />
                          The most important concern of banks in determining your loan eligibility is  that whether or not you are contentedly able to pay off the amount you borrow. </p>
                      </div> </div>
                    <div class="element atStart"><div class="elementInside"><br />
                    <span  style="font-size:13px; font-weight:bold;">List of Home Loans Banks in <?php echo $City?></span><br /><br />
                      <table border="1" cellspacing="0" cellpadding="4" width="100%">
                        <tr>
                          <td width="128" valign="top"><p align="center">State Bank of India(SBI)</p></td>
                          <td width="128" valign="top"><p align="center">HDFC Ltd</p></td>
                          <td width="128" valign="top"><p align="center">LIC Housing Finance</p></td>
                          <td width="128" valign="top"><p align="center">ICICI Bank</p></td>
                          <td width="128" valign="top"><p align="center">Axis Bank</p></td>
                        </tr>
                        <tr>
                          <td width="128" valign="top"><p align="center">Fedbank</p></td>
                          <td width="128" valign="top"><p align="center">PNB Housing</p></td>
                          <td width="128" valign="top"><p align="center">ING Vysya</p></td>
                          <td width="128" valign="top"><p align="center">Kotak Bank</p></td>
                          <td width="128" valign="top"><p align="center">DHFL</p></td>
                        </tr>
                        <tr>
                          <td width="128" valign="top"><p align="center">Bank of Baroda</p></td>
                          <td width="128" valign="top"><p align="center">Bank of India</p></td>
                          <td width="128" valign="top"><p align="center">Union Bank of India</p></td>
                          <td width="128" valign="top"><p align="center">United Bank of India</p></td>
                          <td width="128" valign="top"><p align="center">Punjab National Bank</p></td>
                        </tr>
                        <tr>
                          <td width="128" valign="top"><p align="center">Standard Chartered</p></td>
                          <td width="128" valign="top"><p align="center">IndusInd Bank</p></td>
                          <td width="128" valign="top"><p align="center">IDBI Housing Finance</p></td>
                          <td width="128" valign="top"><p align="center">Andhra Bank</p></td>
                          <td width="128" valign="top"><p align="center">Citibank</p></td>
                        </tr>
                        <tr>
                          <td width="128" valign="top"><p align="center">Canara Bank</p></td>
                          <td width="128" valign="top"><p align="center">Indian Bank</p></td>
                          <td width="128" valign="top"><p align="center">Vijaya Bank</p></td>
                          <td width="128" valign="top"><p align="center">Corporation Bank</p></td>
                          <td width="128" valign="top"><p align="center">IDBI Bank</p></td>
                        </tr>
                      </table>
                    </div> </div>
				<div class="element atStart"><div  class="element_atStart_dv">
                <p><span style="font-size:13px; font-weight:bold;">Documents required for Home Loan in <?php echo $City?></span><br /><br />
				  Generally the  documents required to processing your loan application are almost similar  across all the banks; however they may differ with various banks depending upon  specific requirement etc. Following documents are required by financial  institutions to process the loan application: <br />
				    · Age Proof <br />
				    · Address Proof <br />
				    · Income Proof of the  applicant &amp; co-applicant <br />
				    · Last 6 months bank  A/C statement <br />
				    · Passport size  photograph of the applicant &amp; co-applicant<br />
                    
                    
                    <table cellpadding="4" cellspacing="0" border="1" width="100%">
<tr><td align="center" width="42%"><strong>Salaried</strong></td>
<td width="58%" align="center"><strong>Self Employed</strong></td>
</tr>
<tr><td valign="top">· Employment  certificate from the employer, <br />
				    · Copies of pay slips  for last few months and TDS certificate <br />
				    · Latest Form 16 issued  by employer Bank statements</td><td >
 · Copy of audited  financial statements for the last 2 years <br />
				    · Copy of partnership  deed if it is a partnership firm or copy of memorandum of association and  articles of association if it is a company <br />
				    · Profit and loss  account for the last few years <br />
				    · Income tax assessment  order
</td></tr>

</table>
       </p>
				</div> </div>
          
       </div>
                 </div>
                </div>
             </div>
</div>
<p style="padding-left:15px; ">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
<tr><td width="70%" valign="top">
<table cellpadding="0" cellspacing="1" border="0">

<tr><td class="text11" style="color:#4c4c4c; padding-left:8px;">
<?php
echo $HeaderDEscription;
?>
</td></tr></table>
</td></tr></table>
<table border="0" align="center" cellpadding="2" cellspacing="1" width="950" >
<tr><td valign="top" width="780">
<table cellpadding="0" cellspacing="1" border="0" width="100%">
<tr><td class="text11" style="color:#4c4c4c; ">
<?php
echo $PageDescription;
?></td></tr></table>
   </td></tr></table>
</p>
<div>  
  <span class="tbl_txt"><b>Disclaimer:</b> Deal4loans.com doesn't provide Loans on its own but ensures your information is sent to bank which you have opted for. Deal4loans has no
sales team on its own and we just help you to compare loans .All loans are on discretion of the associated Banks.</span><br>
</div>

</div>



<div style="clear:both; height:15px;"></div>
</div>
<!--partners-->
<!--partners-->
<?php include "footer_hl.php"; ?>

</body>
</html>
