<?php 
	ob_start( 'ob_gzhandler' );
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;


if(strlen($_REQUEST["source"])>0)
	{
		$srce=$_REQUEST["source"];
	}
	else
	{
		$srce="HL Calc LP";
	}


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Eligibility Calculator</title>
<link href="hlc-lp-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
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
	
	ni1.innerHTML = '<table width="99%" border="0" cellpadding="0" cellspacing="0"> <tr>      <td colspan="2" align="left"><h1>Personal  Details </h1></td>      </tr><tr>      <td colspan="2" align="left" class="text4" style="font-size:12px; font-weight:normal; color:#333;"><img src="images/security.png"> Your Information is secure with us and will not be shared without your consent</td>      </tr>    <tr>      <td width="27%" height="35" align="left" class="text4" >Full Name</td>      <td width="73%" align="left">       <input name="Name" id="Name" type="text" class="input" onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal" class="showTip"></div>     </td>    </tr>    <tr>      <td height="35" class="text4" align="left">DOB</td>      <td align="left">    <input name="day" id="day" type="text" class="dd" value="dd" onBlur="onBlurDefault(this,\'dd\');" onFocus="onFocusBlank(this,\'dd\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><img src="http://www.deal4loans.com/new-images/spacer.gif" width="6px;" /><input name="month" id="month" type="text" class="dd" value="mm" onBlur="onBlurDefault(this,\'mm\');" onFocus="onFocusBlank(this,\'mm\');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><img src="http://www.deal4loans.com/new-images/spacer.gif" width="6px;" />&nbsp;<input name="year" id="year" type="text"  class="yy" value="yyyy" onBlur="onBlurDefault(this,\'yyyy\');" onFocus="onFocusBlank(this,\'yyyy\');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onKeyDown="validateDiv(\'dobVal\');" /><div id="dobVal" class="showTip"></div>   </td>    </tr>    <tr>      <td height="35" align="left" class="text4">Mobile</td>      <td align="left"><div class="text9" style=" float:left; width:26px; height:auto; color: #065b8e; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> <strong>+91</strong></div><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" class="mobo" type="text"  onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal" class="showTip"></div> </td>    </tr>    <tr>      <td height="35" align="left" class="text4">Email ID</td>      <td align="left"><input name="Email" id="Email" type="text" class="input" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal" class="showTip"></div></td>    </tr>      <tr>      <td height="35" align="left" class="text4">Property Value</td>      <td align="left"><input name="Property_Value" id="Property_Value" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" type="text"  class="input" onKeyDown="validateDiv(\'propertyValueVal\');" /><div id="propertyValueVal" class="showTip"></div></td>    </tr>      <tr>      <td height="35" align="left" class="text4">Total EMI of All Loans :</td>      <td align="left"><input name="total_obligation" id="total_obligation" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text" class="input" onKeyDown="validateDiv(\'obligationVal\');" /><div id="obligationVal"></div></td>    </tr>    <tr>      <td height="35" class="text4" style="font-size:12px; font-weight:normal; color:#333;" colspan="2"><input name="accept" type="checkbox"  /> I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal" class="showTip"></div></td>    </tr>    <tr>      <td height="55" colspan="2" align="center" class="text4">      <input type="submit" style="border: 0px none ; background-image: url(images/d4l-get-quote-btn-b.jpg); width:153px; height:38px; margin-bottom: 0px;" value=""/> </td>    </tr>        </table>';

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
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px; width:100%;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#000000; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#000000; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}
</script>
<style>
.showTip { color:#FF0000; font-size:11px; font-weight:bold; font-family:Arial, Helvetica, sans-serif;}
</style>
</head>

<body>
<div class="hlc_tp_bg">
<div class="hlc_tp_box">
<div id="logo"><img src="images/d4l-hlc-logo.png" /></div>
<div class="hlc_text_box" style="text-align:right;"><span class="text1">Check Your Home Loan Eligibility</span><br />
  <span class="text2">Get Instant Quote from</span><br />
<span class="text3">Top 10 Banks </span></div>
</div>
</div>
<div style="clear:both;"></div>
<div id="second_container">
<div id="left_box">
<div id="form_box">
<form name="homeloan_calculator" method="post" action="apply-home-loans-calc-continue1.php" onSubmit="return checkhlcalc();">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $srce; ?>">
  <table width="99%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><h1>Professional Details</h1></td>
      </tr>
    <tr>
      <td width="27%" height="35" class="text4">Loan Amount</td>
      <td width="73%" >
       
       <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="input" onKeyDown="validateDiv('loanAmtVal');" /><div id="loanAmtVal" class="showTip"></div> <span id='formatedlA' style='font-size:11px; font-weight:normal; color:#000;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;'></span>
     </td>
    </tr>
    <tr>
      <td height="35" class="text4">Employment Type</td>
      <td>
        <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');" class="select" ><option value="-1">Please Select</option><option value="1">Salaried</option><option value="0">Self Employment</option></select><div id="empStatusVal" class="showTip"></div>
   </td>
    </tr>
    <tr>
      <td height="35" class="text4">Annual Income</td>
      <td><input type="text" name="Net_Salary" id="Net_Salary"  class="input" onKeyUp="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');"  /><div id="netSalaryVal" class="showTip"></div><span id='formatedIncome' style='font-size:11px;font-weight:normal; color:#000;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px; font-weight:normal; color:#000;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
    <tr>
      <td height="35" class="text4">City</td>
      <td><select name="City" id="City" class="select" onChange="addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="7"><?=getCityList($City)?></select><div id="cityVal" class="showTip"></div></td>
    </tr>
    <tr>
      <td  colspan="2" align="center" >&nbsp;</td></tr>
    <tr>
      <td  colspan="2" align="center" id="personalDetails" >
      <img src="images/d4l-get-quote-btn-b.jpg" border="0" width="153" height="38">

      </td>
    </tr>
    <tr>
      <td colspan="2" id="hdfclife" ></td></tr>
    
  </table>
  </form>
</div>
<div style="clear:both;"></div>
<div class="lh_factor"><span class="text5" style="font-size:20px;">Home Loans Eligibility Factors</span>

<div style="width:100%; margin-top:5px;"><table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="5%" height="25"><img src="images/bullet-hlc.jpg" /></td>
    <td width="39%" class="text9"> Monthly Income</td>
    <td width="5%"><img src="images/bullet-hlc.jpg" /></td>
    <td width="51%" class="text9">Property Attributes</td>
  </tr>
  <tr>
    <td height="25"><img src="images/bullet-hlc.jpg" /></td>
    <td class="text9">Other EMI</td>
    <td><img src="images/bullet-hlc.jpg" alt="" /></td>
    <td class="text9">Duration of Loan (Years)</td>
  </tr>
  <tr>
    <td height="25"><img src="images/bullet-hlc.jpg" /></td>
    <td class="text9">Available Income</td>
    <td><img src="images/bullet-hlc.jpg" alt="" /></td>
    <td class="text9">Interest Rate (in percentage)</td>
  </tr>
</table>
</div>
</div>


</div>
<div id="right_panel"><span class="text5">Top Home loan Banks-</span><br />
  <span class="sbi">Sbi</span>, <span class="hdfc">Hdfc</span>, <span class="icici">Icici</span>, <span class="lic">Lic housing Finance</span>, <br />
  <span class="pnb">Pnb Housing Finance</span>, <span class="fed">Fedbank</span>, <span class="axis">Axis</span>, <span class="hdfc">Hsbc</span></div>
<div id="right_panel">
<div class="steps"><img src="images/d4l-steps-lp.jpg" /></div>
<div style="clear:both;"></div>
<div class="steps_txt text7">1. Get to know how much Home loan you can get.
  <br />
  2. Get Instant rates from top 10 Banks.
  <br />
  3. Choose lowest emi and best offers as per your need.</div>
  <div class="steps_txt" style="margin-top:10px; text-align:center;
  font-family: Arial, Helvetica, sans-serif; font-size:13px;">Over<span class="text4" > 42 lacs</span> customers have taken quote from <span class="text4">Deal4loans.com</span> </div>
  
  <div class="steps_txt" style="margin-top:10px; text-align:center;
  font-family: Arial, Helvetica, sans-serif; font-size:13px;">
    <table width="99%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="58" align="center" bgcolor="#065b8e" style="color: #FFF;"><span style="font-size:17px;"><strong>Sample Home Loan Eligibility - </strong></span><br />
          Employment Status - <strong>Salaried</strong> | Annual Income - <strong>Rs. 12 Lacs</strong> | <br />
          Property Value -<strong> Rs. 75 Lacs</strong> | Tenure - <strong>20 Yrs</strong></td>
        </tr>
      <tr>
        <td height="25" bgcolor="#77a0d5"><table width="99%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="17" align="center" style="border-right:thin solid #5a8ec3; color:#FFF;">Bank Name</td>
            <td align="center" style="border-right:thin solid #5a8ec3; color:#FFF;">Interest Rate</td>
            <td align="center" style="border-right:thin solid #5a8ec3; color:#FFF;">Emi (per Month)</td>
            <td align="center" style="border-right:thin solid #5a8ec3; color:#FFF;">Eligible Loan Amount</td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td bgcolor="#5a8ec3"><table width="99%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="19%" height="30" align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Bank A</strong></td>
            <td width="31%" align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>10.5 %</strong></td>
            <td width="25%" align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 56658</strong></td>
            <td width="25%" align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 5675000</strong></td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Bank B</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>11 %</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 51693</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 5008114</strong></td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Bank C</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>10.75% </strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 41682</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 5010000</strong></td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Bank D</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>10.5 %</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 55020</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 5511022</strong></td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#FFFFFF" style="color:#065b8e;"> <strong>Bank E</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>10.4 %</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 49983</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 5040323</strong></td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Bank F</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>10.10 %</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs.48588</strong></td>
            <td align="center" bgcolor="#FFFFFF" style="color:#065b8e;"><strong>Rs. 5000632</strong></td>
          </tr>
        </table></td>
        </tr>
    </table>
  </div>

</div>

</div>
</body>
</html>
