<?php
include 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
  <style>
  select {font:11px verdana; padding:2px; margin:0px; border: 1px solid #68718A;}
  input {font:11px verdana; padding:2px; margin:0px; border: 1px solid #68718A;}
 .quick {font: 11px verdana;}
 .bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	background-color: #529BE4;
	border: 1px solid #529BE4;
	font-weight: bold;
}
.blueborder {
	border: 1px solid #529BE4;
}
 </style>
 <script>
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
function validmobile(phone) 
{
	
	atPos = phone.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.mobile, 'Mobile number', 10))
		return false;

return true;
}
function chkform()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

 if (document.loan_form.Type_Loan.selectedIndex==0)
	{
		alert("Please enter the type of loan you are looking for");
		document.loan_form.Type_Loan.focus();
		return false;
	}
	if(document.loan_form.fullname.value=="")
	{
		alert("Please fill your name.");
		document.loan_form.fullname.focus();
		return false;
	}
 
  if(document.loan_form.mobile.value=="")
	{
		alert("Please fill your mobile no.");
		document.loan_form.mobile.focus();
		return false;
	}

	  if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  document.loan_form.mobile.focus();
			  return false;  
		}
        if (document.loan_form.mobile.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.mobile.focus();
				return false;
        }
        if (document.loan_form.mobile.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 document.loan_form.mobile.focus();
                return false;
		}

	/*if(document.loan_form.mobile.value!="")
	{
		if (!validmobile(document.loan_form.mobile.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.mobile.focus();
			return false;
		}
	}*/
	if(document.loan_form.email_id.value=="")
	{
		alert("Please fill your email id.");
		document.loan_form.email_id.focus();
		return false;
	}
	 if(document.loan_form.email_id.value!="")
	{
		if (!validmail(document.loan_form.email_id.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.email_id.focus();
			return false;
		}
		
	
	}
	return true;
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
</script>
</head>

<body>
<form name="loan_form" method="post" action="Rightcc.php" onSubmit="return chkform();">
	 
	 <table width="95%" border="0" cellpadding="4" cellspacing="0" class="blueborder" bgcolor="#FFFFFF" >
	
	 <tr bgcolor="#529BE4">
	 <td colspan="2" class="quick" align="center"><font style="font-size:13px;font-weight:bold;color:white">Apply Here</font></td>
	 </tr>
	 <tr><td colspan="2">
	 <table border="0" height="100" width="95%" >
	<tr> <td class="quick" width="40%">Product Type</td>
	 <td width="70%">
	 <select style="width:138px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
	   <option value="Req_Business_Loan">Business Loan</option>
	 </select></td>
	 </tr>
 <tr><td colspan="2" align="center"  width="4"></td>

			</tr>
	 <tr>
	 <td class="quick">Full Name</td>
	 <td ><input type="text" name="fullname" maxlength="30"></td>
	 </tr>
	<tr>
	 <td class="quick">Mobile</td>
	 <td >+91<input type="text" size="16" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="mobile"></td>
	 </tr>
	 <tr>
	 <td class="quick">Email id</td>
	 <td ><input type="text" name="email_id"></td>
	 </tr>
	 	 <tr>
	 <td class="quick">City</td>
	 <td >
	 <select name="city" id="city"  style="width:140px;" tabindex="5" >
		<option value="Select City">Please Select</option>
		<option value="Ahmedabad">Ahmedabad</option>
		<option value="Bangalore">Bangalore</option>
		<option value="Chennai">Chennai</option>
		<option value="Delhi">Delhi</option>
		<option value="Faridabad">Faridabad</option>
		<option value="Ghaziabad">Ghaziabad</option>
		<option value="Gurgaon">Gurgaon</option>
		<option value="Hyderabad">Hyderabad</option>
		<option value="Mumbai">Mumbai</option>
		<option value="Navi Mumbai">Navi Mumbai</option>
		<option value="Pune">Pune</option>
		<option value="Thane">Thane</option>
	  </select>
		</td>
	 </tr>
	 	  
								  
	 <tr><td colspan="2"></td></tr>
	 <tr><td colspan="2" align="center"> <input type="submit" class="bluebutton" value="Submit" ></td>
	 </tr>
	 </table></td></tr></table></form>
</body>
</html>
