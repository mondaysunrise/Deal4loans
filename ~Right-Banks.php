<?php
session_start();
//require '/scripts/session_check.php';

//echo "Testing";
$absolutepath = ""; 
 if (($_REQUEST['flag'])!=1)
	{ 


?>
<div id="dvColumn3"> 
      <div id="dvRightBanner">
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
	invalidChars = " :,;/";
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
        if ((document.loan_form.mobile.value.charAt(0)!="9") && (document.loan_form.mobile.value.charAt(0)!="8") && (document.loan_form.mobile.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
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
 	<form name="loan_form" method="post" action="/Right.php" onSubmit="return chkform();">
	 
	 <table width="95%" border="0" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF" class="blueborder" >
	
	 <tr bgcolor="#529BE4">
	 <td colspan="2" class="quick" align="center">
	 <font style="font-size:13px;font-weight:bold;color:#FFFFFF;">
<? if((strlen(strpos($_SERVER['REQUEST_URI'], "citibank-personal-loan-eligibility")) > 0)) 
	
		 {?>	 
	Apply for CitiBank 
	 <? 
	 }
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "barclays-finance-personal-loan-eligibility")) > 0))
	 {?>
	Apply for Baclays Finance
	 <? 
	 }
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "fullerton-personal-loan-eligibility")) > 0))
	{
	?>
	Apply for Fullerton
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "hdfc-personal-loan-eligibility")) > 0))
	{
	?>
	Apply for HDFC Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "kotak-personal-loan-eligibility")) > 0))
	{
	?>
	Apply for Kotak Bank
	<? 
	}  else 
	{?>
	Apply Here
	<? 
	}
	?>	 
	 
   </font></td>
	 </tr><tr><td>
	 <table border="0" height="100" width="95%" >
	 
	 
	 <td class="quick" width="40%">Product Type</td>
	 <td width="70%">
	 <select style="width:138px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal" selected="selected">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
<!-- 	   <option value="Req_Business_Loan">Business Loan</option>
 -->	 </select></td>
	 </tr>
 <tr><td colspan="2" align="center"  width="4"><input type="hidden" name="source"  value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>"></td>

		  </tr>
	 <tr>
	 <td class="quick">Full Name</td>
	 <td ><input type="text" name="fullname" maxlength="30"></td>
	 </tr>
	<tr>
	 <td class="quick">Mobile</td>
	 <td class="quick" >+91<input type="text" size="16" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="mobile"></td>
	 </tr>
	 <tr>
	 <td class="quick">Email id</td>
	 <td ><input type="text" name="email_id"></td>
	 </tr>
	  <tr>
	 <td class="quick">City</td>
	 <td ><select name="city">
     <?=getCityList($City)?>
	 </select></td>
	 </tr>
	   <tr>
	 <td class="quick">Net Salary (Yearly)</td>
	 <td ><input type="text" name="net_salary"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
	 </tr>
	 <tr><td colspan="2"></td></tr>
	 <tr><td colspan="2" align="center"> <input type="submit" class="bluebutton" value="Submit" ></td></tr>
	 </table></td></tr></table></form>

		<div align="center" style="width:250px; clear:both; padding:3px 0px;
">
		  <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="13" height="47" align="left" valign="top"><img src="/images/step-lft-corn.gif" width="13" height="47" /></td>
                    <td align="center" valign="middle"  background="/images/step-pnl-bg.gif" class="step-hd-text"   >How Does it Work?</td>
                    <td width="13" height="47" align="right" valign="top"><img src="/images/step-rgt-corn.gif" width="13" height="47" /></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td width="76" height="105" valign="top"  bgcolor="#D98E1A" class="steps-text" style="padding-top:15px;" ><img src="/images/stp1.gif" width="32" height="31" /><br />
                Post your loan requirement </td>
              <td width="86" valign="top" bgcolor="#D08108" class="steps-text" style="padding-top:15px;"  ><img src="/images/stp2.gif" width="31" height="31" /><br />
                Get &amp; Compare  offers from all banks </td>
              <td width="78" valign="top" bgcolor="#BE740A" class="steps-text" style="padding-top:15px;"  ><img src="/images/stp3.gif" width="31" height="31" /><br />
                Go with the lowest bidder </td>
            </tr>
          </table>
		</div>
    
 <? }
