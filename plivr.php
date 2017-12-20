<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Loan IVR</title>
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


function checkform(form)
{
	
//var browsername = BrowserDetect.browser;
var full_name = document.personal_loan_ivr.full_name.value;
//var email = document.personal_loan_ivr.email.value;
var mobile_no = document.personal_loan_ivr.mobile_no.value;
//var Net_Salary = document.personal_loan_ivr.Net_Salary.value;
var city = document.personal_loan_ivr.city.value;

var accept = document.personal_loan_ivr.accept;

var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

//alert("Hello");

	if(full_name=="")
	{
			alert("Please fill your Full name.");
			document.personal_loan_ivr.full_name.focus();
		return false;
	}
	
	if(full_name!="")
	{
		 if(containsdigit(full_name)==true)
		{
	  	
			alert("Full Name contains numbers!");
			document.personal_loan_ivr.full_name.focus();
			return false;
		}
	}
  for (var i = 0; i <full_name.length; i++) {
  	if (iChars.indexOf(full_name.charAt(i)) != -1) {

	alert ("Full Name has special characters.\n Please remove them and try again.");
	document.personal_loan_ivr.full_name.focus();

  	return false;
  	}
  }
  
/*  if(email!="")
	{
		if (!validmail(email))
		{
			document.personal_loan_ivr.email.focus();
			return false;
		}
	}
*/


	   if(mobile_no=="")
		{
			alert("Please fill your mobile number.");
			document.personal_loan_ivr.mobile_no.focus();
			return false;
		}
        if(isNaN(mobile_no)|| mobile_no.indexOf(" ")!=-1)
		{
			  alert("Enter numeric value");
			  document.personal_loan_ivr.mobile_no.focus();
			  return false;  
		}
        if (mobile_no.length < 10 )
		{
			
             alert("Please Enter 10 Digits"); 
			 document.personal_loan_ivr.mobile_no.focus();
				return false;
        }
        if (mobile_no.charAt(0)!="9")
		{
		         alert("The number should start only with 9");
				 document.personal_loan_ivr.mobile_no.focus();
                return false;
        }

if (document.personal_loan_ivr.city.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	document.personal_loan_ivr.city.focus();
	return false;
}

/*	if(document.personal_loan_ivr.accept.checked == false)
	{
		alert("Accept the Terms and Condition");
		document.personal_loan_ivr.accept.focus();
		return false;
	}
*/
}

</script>
</head>

<body>
<form id="form1" name="personal_loan_ivr" method="post" action="plivr-continue.php"  onSubmit="return checkform(this);">
  <table width="100%" border="0" cellspacing="4" cellpadding="4">
    <tr>
      <td colspan="2"><div align="center">Personal Loan IVR Form </div></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><label for="textfield"></label>
      <input type="text" name="full_name" id="full_name" /></td>
    </tr>
    <tr>
      <td>Mobile Number </td>
      <td><input type="text" name="mobile_no" id="mobile_no" maxlength="10" /></td>
    </tr>
    <tr>
      <td>City</td>
      <td>  <select size="1" align="left" style="width:251"  name="city" id="city" class="style4">
		 <?=getCityList1($City)?>
		 </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Submit" id="Submit" /></td>
    </tr>
  </table>
</form>

</body>
</html>
