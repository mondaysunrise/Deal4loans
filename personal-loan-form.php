<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/pesonal-loan-styles.css" type="text/css" rel="stylesheet"  />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style>
.hintanchor{ font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0033;}
</style>
<script  type="text/javascript">
function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}


function chkformR()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.loan_form.fullname.value=="" || document.loan_form.fullname.value=="Full Name")
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Fill Your Name</span>";	
		document.loan_form.fullname.focus();
		return false;
	}
   if(document.loan_form.mobile.value=="" || document.loan_form.mobile.value=="Mobile No")
	{
		document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number</span>";
		document.loan_form.mobile.focus();
		return false;
	}
	  if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
		{
			  document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchor'>Enter numeric value</span>";
			  document.loan_form.mobile.focus();
			  return false;  
		}
        if (document.loan_form.mobile.value.length < 10 )
		{
             document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchor'>Please Enter 10 Digits</span>"; 				 document.loan_form.mobile.focus();
				return false;
        }
        if ((document.loan_form.mobile.value.charAt(0)!="9") && (document.loan_form.mobile.value.charAt(0)!="8") && (document.loan_form.mobile.value.charAt(0)!="7"))
		{
			document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchor'>The number should start only with 9 or 8 or 7</span>";
           		 document.loan_form.mobile.focus();
                return false;
		}
	
	if(document.loan_form.email_id.value=="" || document.loan_form.email_id.value=="Email Id")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	
	var str=document.loan_form.email_id.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";
		document.loan_form.email_id.focus();
		return false;
	}
	if (document.loan_form.city.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Please Select City!</span>";
		document.loan_form.city.focus();
		return false;
	}
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Please Select Occupation!</span>";
		document.loan_form.Employment_Status.focus();
		return false;
	}
	if(document.loan_form.net_salary.value=="" || document.loan_form.net_salary.value=="Annual Income")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Fill your Net salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
	if(document.loan_form.net_salary.value<=0)
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Fill Your Net Salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept the Terms and Condition!</span>";	
		document.loan_form.accept.focus();
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
</head>
<body>
<div class="header">
<div class="headerinn">
<div class="logo"><img src="images/d4l-hlbt-rediff-new.png" width="150" height="62" border="0"></div>
</div>
</div>
<div class="second-wrapper">
<div class="headtext"><span style="font-size:24px; font-weight:bold;">Personal loan Offers</span> from <strong style=" color:#ce322b;">9 Banks</strong> with <strong style=" color:#ce322b;">3 Banks</strong> with No Prepayment charges</div>
<div class="form">
<form name="loan_form" method="post" action="http://www.deal4loans.com/Right.php" onSubmit="return chkformR();">
<input type="hidden" name="Type_Loan" value="Req_Loan_Personal">
<input type="hidden" name="source" value="rediff_banner160x600"> 
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="41%" class="form-text">Full Name </td>
      <td width="59%"><input type="text" class="input" name="fullname" id="fullname" tabindex="1" onKeyDown="validateDiv('nameVal');"><div id="nameVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td class="form-text">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="form-text">Mobile No.</td>
      <td class="form-text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="11%">+91</td>
          <td width="89%"><input type="text" class="mobo" name="mobile" id="mobile"  onkeydown="validateDiv('phoneRVal'); intOnly(this);" maxlength="10" tabindex="2" onKeyPress="intOnly(this);"  onChange="intOnly(this);" ><div id="phoneRVal" class="alert_msg"></div></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="form-text">&nbsp;</td>
      <td class="form-text">&nbsp;</td>
    </tr>
    <tr>
      <td class="form-text">Email Id</td>
      <td class="form-text"><input type="text" class="input" name="email_id" id="email_id" onKeyDown="validateDiv('emailVal');" tabindex="3"><div id="emailVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td class="form-text">&nbsp;</td>
      <td class="form-text">&nbsp;</td>
    </tr>
    <tr>
      <td class="form-text">City </td>
      <td class="form-text">
        <select name="city" class="select" id="city" onKeyDown="validateDiv('cityVal');" tabindex="4">
        <option value="Select Your City">Select your City</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Others">Others</option>
        </select><div id="cityVal" class="alert_msg"></div>
      </td>
    </tr>
    <tr>
      <td class="form-text">&nbsp;</td>
      <td class="form-text">&nbsp;</td>
    </tr>
    <tr>
      <td class="form-text">Occupation </td>
      <td class="form-text"><select name="Employment_Status" class="select" id="Employment_Status" onChange="validateDiv('empStatusVal');" tabindex="5">
       <option selected="selected" value="-1">Please Select</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
      </select><div id="empStatusVal" class="alert_msg"></div></td>
    </tr>
    <tr>
      <td class="form-text">&nbsp;</td>
      <td class="form-text">&nbsp;</td>
    </tr>
    <tr>
      <td class="form-text">Annual Income</td>
      <td class="form-text"><input type="text" class="input" name="net_salary" id="net_salary" tabindex="6" onBlur="getDiToWordsIncome('net_salary', 'formatedIncome', 'wordIncome');" onChange="intOnly(this);" onKeyPress="intOnly(this); getDiToWordsIncome('net_salary','formatedIncome','wordIncome');" onKeyDown="validateDiv('netSalaryVal');"  onKeyUp="intOnly(this); getDiToWordsIncome('net_salary','formatedIncome','wordIncome');" /><div id="netSalaryVal" class="alert_msg"></div></td>
    </tr>
    <tr><td></td><td align="left"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span></td></tr>
    <tr>
      <td class="form-text">&nbsp;</td>
      <td class="form-text">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="form-text" style="font-size:11px;">
        <input type="checkbox" name="accept" id="accept">
        I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" style="color:#000;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" style="color:#000;">Terms &amp; Conditions.</a><div id="acceptVal" class="alert_msg"></div></td>
      </tr>
    <tr>
      <td class="form-text">&nbsp;</td>
      <td class="form-text">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="form-text">
       <input type="image" name="Submit" src="images/button-hlbt.png" style="width:79px; height:28px; border:none;" tabindex="16" /></td>
      </tr>
    <tr>
      <td class="form-text">&nbsp;</td>
      <td class="form-text">&nbsp;</td>
    </tr>
  </table></form>
</div>

<div class="right">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" class="right-deadtext">Sample <strong style="color:#ce322b;">Personal Loan</strong> Quotes</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="15%" height="40" align="center" bgcolor="#ffc117" class="right-subtext" style="border-right:thin solid #FFF;">Bank</td>
          <td width="26%" align="center" bgcolor="#ffc117" class="right-subtext" style="border-right:thin solid #FFF;">Interest Rate </td>
          <td width="39%" align="center" bgcolor="#ffc117" class="right-subtext" style="border-right:thin solid #FFF;">Eligible Loan Amt. in Rs.</td>
          <td width="20%" align="center" bgcolor="#ffc117" class="right-subtext">EMI in Rs.</td>
        </tr>
        <tr>
          <td height="40" bgcolor="#ffe6a2" class="right-subtext" style="border-right:thin solid #FFF;">Bank A</td>
          <td bgcolor="#ffe6a2" class="right-subtext" style="border-right:thin solid #FFF;">13.50%</td>
          <td bgcolor="#ffe6a2" class="right-subtext" style="border-right:thin solid #FFF;">1,00,000</td>
          <td bgcolor="#ffe6a2" class="right-subtext">2,783</td>
        </tr>
        <tr>
          <td height="40" bgcolor="#f5f5f5" class="right-subtext" style="border-right:thin solid #FFF;">Bank B</td>
          <td bgcolor="#f5f5f5" class="right-subtext" style="border-right:thin solid #FFF;">14%</td>
          <td bgcolor="#f5f5f5" class="right-subtext" style="border-right:thin solid #FFF;">1,25,000</td>
          <td bgcolor="#f5f5f5" class="right-subtext">3,542</td>
        </tr>
        <tr>
          <td height="40" bgcolor="#FFE6A2" class="right-subtext" style="border-right:thin solid #FFF;">Bank C</td>
          <td bgcolor="#FFE6A2" class="right-subtext" style="border-right:thin solid #FFF;">14.5%</td>
          <td bgcolor="#FFE6A2" class="right-subtext" style="border-right:thin solid #FFF;">1,80,000</td>
          <td bgcolor="#FFE6A2" class="right-subtext">5,101</td>
        </tr>
        <tr>
          <td height="40" bgcolor="#F5F5F5" class="right-subtext" style="border-right:thin solid #FFF;">Bank D</td>
          <td bgcolor="#F5F5F5" class="right-subtext" style="border-right:thin solid #FFF;">17%</td>
          <td bgcolor="#F5F5F5" class="right-subtext" style="border-right:thin solid #FFF;">1,50,000</td>
          <td bgcolor="#F5F5F5" class="right-subtext">4,251</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
<div style="clear:both;"></div>

</div>
</body>
</html>
