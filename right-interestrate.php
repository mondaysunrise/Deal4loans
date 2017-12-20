 <?php
 ob_start();
 session_start();
 

?>

	  <style type="text/css">
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
/*	if(document.loan_form.mobile.value!="")
	{
		if (!validmobile(document.loan_form.mobile.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.mobile.focus();
			return false;
		}
	}
*/
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
	if (document.loan_form.city.selectedIndex==0)
	{
		alert("Please Select City");
		document.loan_form.city.focus();
		return false;
	}
	
	if(document.loan_form.net_salary.value=="")
	{
		alert("Please fill your Net salary (Yearly).");
		document.loan_form.net_salary.focus();
		return false;
	}
	if(document.loan_form.net_salary.value<=0)
	{
		alert("Please fill your Net salary (Yearly).");
		document.loan_form.net_salary.focus();
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
</script>

<div style="float:right; width:237px; background-color:#e9e9e9;">
	 <table width="237" border="0" align="right" cellpadding="0" cellspacing="0"  class="blueborder" >
	
	<?
	if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-interest-rate")) > 0))

	{?>
	 <tr bgcolor="#529BE4">
	 <td height="20" colspan="2" align="center" class="quick"  style="font-size:13px; font-family: Arial, Helvetica, sans-serif; font-weight:bold;color:#FFFFFF;">Apply Here </td>
	 </tr><tr><td bgcolor="#FFFFFF">
	 	<form name="loan_form" method="post" action="/Right.php" onSubmit="return chkform();">

	 <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="4" >
	 
	 
	 <td width="40%" align="left" class="quick">Product Type</td>
	 <td width="70%" align="right">
	 <select style="width:130px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
	   <option value="Req_Business_Loan">Business Loan</option>
	 </select></td>
	 </tr>
  <tr align="left"><td colspan="2"  width="4"><input type="hidden" name="source"  value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>"></td>
		  </tr>
	 <tr>
	 <td align="left" class="quick">Full Name</td>
	 <td align="right" ><input type="text" name="fullname" style="width:130px;" maxlength="30"></td>
	 </tr>
	<tr>
	 <td align="left" class="quick">Mobile</td>
	 <td align="right" class="quick">+91
	   <input type="text" style="width:100px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="mobile"></td>
	 </tr>
	 <tr>
	 <td align="left" class="quick">Email id</td>
	 <td align="right" ><input type="text" name="email_id" style="width:130px;"></td>
	 </tr>
	 <tr>
	 <td class="quick">City</td>
	 <td ><select name="city" style="width:138px;">
     <?=getCityList($City)?>
	 </select></td>
	 </tr>
	  <tr>
	 <td class="quick">Net Salary (Yearly)</td>
	 <td ><input type="text" name="net_salary"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
	 </tr>
	 <tr><td colspan="2"></td></tr>
	 <tr><td colspan="2" align="center"> <input type="submit" class="bluebutton" value="Submit" ></td></tr>
	 </table>
	 </form></td></tr>
	 </table>
	 
	 	
		<? }
		else {
		?>
		
		<tr bgcolor="#529BE4">
	 <td height="20" colspan="2" align="center" class="quick"  style="font-size:13px; font-family: Arial, Helvetica, sans-serif; font-weight:bold;color:#FFFFFF;">Apply Here </td>
	 </tr><tr><td bgcolor="#FFFFFF">
	 	<form name="loan_form" method="post" action="/Right.php" onSubmit="return chkform();">

	 <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="4" >
	 
	 
	 <td width="40%" align="left" class="quick">Product Type</td>
	 <td width="70%" align="right">
	 <select style="width:130px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
	   <option value="Req_Business_Loan">Business Loan</option>
	 </select></td>
	 </tr>
  <tr align="left"><td colspan="2"  width="4"><input type="hidden" name="source" value="QuickApply"></td>
		  </tr>
	 <tr>
	 <td align="left" class="quick">Full Name</td>
	 <td align="right" ><input type="text" name="fullname" style="width:130px;" maxlength="30"></td>
	 </tr>
	<tr>
	 <td align="left" class="quick">Mobile</td>
	 <td align="right" class="quick">+91
	   <input type="text" style="width:100px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="mobile"></td>
	 </tr>
	 <tr>
	 <td align="left" class="quick">Email id</td>
	 <td align="right" ><input type="text" name="email_id" style="width:130px;"></td>
	 </tr>
	 <tr><td colspan="2"></td></tr>
	 <tr><td colspan="2" align="center"> <input type="submit" class="bluebutton" value="Submit" ></td></tr>
	 </table>
	 </form></td></tr>
 </table>
	 
<? }?>

	
	