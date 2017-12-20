<script  type="text/javascript">
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
	
	if(!document.loan_form.accept.checked)
	{
		alert("Accept the Terms and Condition");
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


/*function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.loan_form.city.value=="Delhi" || document.loan_form.city.value=='Delhi' || document.loan_form.city.value=='Noida'  ||  document.loan_form.city.value=='Gurgaon'  ||  document.loan_form.city.value=='Faridabad'  ||  document.loan_form.city.value=='Gaziabad'  ||  document.loan_form.city.value=='Faridabad'  ||  document.loan_form.city.value=='Greater Noida'  || document.loan_form.city.value=='Chennai'  ||  document.loan_form.city.value=='Mumbai'  ||  document.loan_form.city.value=='Thane'  ||  document.loan_form.city.value=='Navi mumbai'  ||  document.loan_form.city.value=='Kolkata'  ||  document.loan_form.city.value=='Kolkota'  ||  document.loan_form.city.value=='Hyderabad'  ||  document.loan_form.city.value=='Pune'  || document.loan_form.city.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal; color: #1C50B0;">Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.loan_form.city.value=="Delhi" || document.loan_form.city.value=='Delhi' || document.loan_form.city.value=='Noida'  ||  document.loan_form.city.value=='Gurgaon'  ||  document.loan_form.city.value=='Faridabad'  ||  document.loan_form.city.value=='Gaziabad'  ||  document.loan_form.city.value=='Faridabad'  ||  document.loan_form.city.value=='Greater Noida'  || document.loan_form.city.value=='Chennai'  ||  document.loan_form.city.value=='Mumbai'  ||  document.loan_form.city.value=='Thane'  ||  document.loan_form.city.value=='Navi mumbai'  ||  document.loan_form.city.value=='Kolkata'  ||  document.loan_form.city.value=='Kolkota'  ||  document.loan_form.city.value=='Hyderabad'  ||  document.loan_form.city.value=='Pune'  || document.loan_form.city.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal; color: #1C50B0;" >Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}*/
</script>
<div style="float:right;">
<? //if(strlen(strpos($_SERVER['REQUEST_URI'], "car-loans")) > 0))
if((strlen(strpos($_SERVER['REQUEST_URI'], "car-loans")) > 0))
{
?>
<table width="250" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="44" align="center" valign="middle" background="new-images/rgt-int-tpbg.gif"  style=" color:#333333; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; text-align:center; line-height:15px;" ><b style="font-size:12px; ">Car Loan Rate of Interest</b><br />

( Last edited on : <? echo $currentdate; ?> )</td>
    </tr>
    <tr>
      <td style="border-left:3px solid #f5e77d; border-right:3px solid #f5e77d; "><table width="235" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#f4f3eb">
        <tr bgcolor="#FFFFFF">
          <td width="82" height="22" align="center" valign="middle" class="tbl_txt"><b>Bank</b>
          </td>
          <td width="103" align="center" valign="middle" class="tbl_txt" style="width:95px; "> <b>Interest<br />
      Rates</b></td>
 
          <td width="46" align="center" valign="middle" class="tbl_txt"><b>Apply</b></td>
        </tr>
 
        <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle"  class="tbl_txt"><a href="http://www.deal4loans.com/loans/banks/icici-bank-icici/" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><b>ICICI Bank</b></a></td>
          <td align="center" valign="middle"  class="tbl_txt"><b>11%-15.25%</b></td>
 
          <td align="center" valign="middle" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/car_loans.php" target="_blank"><img src="new-images/apl-sml.gif" width="46" height="16" border="0" /></a> </td>
         
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;"><b><a href="http://www.deal4loans.com/loans/banks/hdfc-bank-hdfc-ltd/" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt">HDFC Bank</a></b></td>
          <td align="center" valign="middle"  class="tbl_txt"><b>11.50% -15.50%</b></td>
          <td align="center" valign="middle" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/car_loans.php" target="_blank" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><img src="new-images/apl-sml.gif" width="46" height="16" border="0" /></a> </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" ><b><a href="http://www.deal4loans.com/loans/banks/kotak-mahindra-bank/" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt">Kotak Mahindra</a> </b></td>
          <td align="center" valign="middle"  class="tbl_txt"><b>11.50% - 13.50%</b></td>
          <td align="center" valign="middle" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/car_loans.php" target="_blank"><img src="new-images/apl-sml.gif" width="46" height="16" border="0" /></a> </td>
        </tr>
		  <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" ><b><a href="http://www.deal4loans.com/loans/car-loan/sbi-advantage-car-loans-car-loan-scheme-sbi/" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt">SBI</a> </b></td>
          <td align="center" valign="middle"  class="tbl_txt"><b>9.25% - 11.25%</b></td>
          <td align="center" valign="middle" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/car_loans.php" target="_blank"><img src="new-images/apl-sml.gif" width="46" height="16" border="0" /></a> </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="16" valign="top"><img src="new-images/rgt-int-btbg.gif" width="250" height="16" /></td>
    </tr>
	 <tr>
      <td height="10" bgcolor="#FFFFFF"></td>
    </tr>
  </table>
  
  <table width="250" border="0" cellpadding="0" cellspacing="0" bgcolor="#f4e46c">
    <tr>
      <td height="50" align="center" valign="middle"  class="frmtp"  style=" background-image:url(/new-images/frm-tp.gif); background-repeat:no-repeat;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px; text-align:center;	font-weight:bold;	color:#063149;"><div id="frmtpbg" style="padding-top:9px; "><img src="new-images/frm-hdng.gif" alt="Apply Here" /></div>
	 </td>
    </tr>
	 
	 <tr>
	 
	 <td valign="top" style="padding-top:10px;">
	 	<form name="loan_form" method="post" action="/Right.php" onsubmit="return chkform();">

		<table width="95%" border="0" align="right" cellpadding="0" cellspacing="0" bgcolor="#f4e46c">
	 
	 
	   <td width="87" align="left" class="frmtxt">Product</td>
	     <td width="151" height="25" align="left">
	 <select style="width:138px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
 <option value="Req_Loan_Education">Education Loan</option>
<option value="Req_Loan_Gold">Gold Loan</option></select></td>
	 </tr>
  <tr align="left"><td colspan="2"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>" /></td>
		  </tr>
	 <tr>
	 <td align="left" class="frmtxt"> Name</td>
	 <td height="25" align="left" ><input type="text" name="fullname" style="width:133px;" maxlength="30" /></td>
	 </tr>
	<tr>
	 <td align="left" class="frmtxt">Mobile</td>
	 <td height="25" align="left" class="frmtxt">+91
	   <input type="text" style="width:103px;" maxlength="10" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" name="mobile" /></td>
	 </tr>
	 <tr>
	 <td align="left" class="frmtxt">Email id</td>
	 <td height="25" align="left" ><input type="text" name="email_id" style="width:131px;" /></td>
	 </tr>
	 <tr>
	 <td class="frmtxt">City</td>
	 <td height="25" align="left" ><select name="city" style="width:137px;" onchange="tataaig_comp();">
     <?=getCityList($City)?>
	 </select></td>
	 </tr>
	  <tr>
	 <td class="frmtxt"  >Net Salary (Yearly)</td>
	 <td height="25" align="left" ><input type="text" name="net_salary"  onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" style="width:131px;" /></td>
	 </tr>
	   <tr>
	   <td height="45" colspan="2" style="font-size:11px;"><br /> <input type="checkbox" name="accept" style="border:none;" checked>
I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" rel="nofollow" target="_blank">Terms and Conditions</a></td>	
	    </tr>

	 <tr><td colspan="2" align="center"> <input type="image" src="<?php echo $WebsitePath;?>new-images/sbtn.gif" style="width:101px; height:33px; border:none;" /> </td></tr>
	 </table>
	 </form></td></tr>
	  <tr>
          <td height="13" ><div id="frmbt"></div></td>
      </tr>
    </table>
  
<? } else
	{?>
	


<table width="250" border="0" cellpadding="0" cellspacing="0" bgcolor="#f4e46c">
    <tr>
      <td height="50" align="center" valign="middle"  class="frmtp"  style=" background-image:url(/new-images/frm-tp.gif); background-repeat:no-repeat;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px; text-align:center;	font-weight:bold;	color:#063149;"><div id="frmtpbg" style="padding-top:9px; "><img src="new-images/frm-hdng.gif" alt="Apply Here" /></div>
	 </td>
    </tr>
	 
	 <tr>
	 
	 <td valign="top" style="padding-top:10px;">
	 	<form name="loan_form" method="post" action="/Right.php" onsubmit="return chkform();">

		<table width="95%" border="0" align="right" cellpadding="0" cellspacing="0" bgcolor="#f4e46c">
	 
	 
	   <td width="87" align="left" class="frmtxt">Product</td>
	     <td width="151" height="25" align="left">
	 <select style="width:138px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
	    <option value="Req_Loan_Education">Education Loan</option>
<option value="Req_Loan_Gold">Gold Loan</option>
<!-- 	   <option value="Req_Business_Loan">Business Loan</option>
 -->	 </select></td>
	 </tr>
  <tr align="left"><td colspan="2"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>" /></td>
		  </tr>
	 <tr>
	 <td align="left" class="frmtxt"> Name</td>
	 <td height="25" align="left" ><input type="text" name="fullname" style="width:133px;" maxlength="30" /></td>
	 </tr>
	<tr>
	 <td align="left" class="frmtxt">Mobile</td>
	 <td height="25" align="left" class="frmtxt">+91
	   <input type="text" style="width:103px;" maxlength="10" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" name="mobile" /></td>
	 </tr>
	 <tr>
	 <td align="left" class="frmtxt">Email id</td>
	 <td height="25" align="left" ><input type="text" name="email_id" style="width:131px;" /></td>
	 </tr>
	 <tr>
	 <td class="frmtxt">City</td>
	 <td height="25" align="left" ><select name="city" style="width:137px;" onchange="tataaig_comp();">
     <?=getCityList($City)?>
	 </select></td>
	 </tr>
	  <tr>
	 <td class="frmtxt"  >Net Salary (Yearly)</td>
	 <td height="25" align="left" ><input type="text" name="net_salary"  onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" style="width:131px;" /></td>
	 </tr>
	 <tr><td colspan="2"><div id="tataaig_compaign" name="tataaig_compaign"></div></td></tr>
	  <tr>
	   <td height="45" colspan="2" style="font-size:9px;"> <input type="checkbox" name="accept" style="border:none;" checked>
I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a></td>	
	    </tr>

	 <tr><td colspan="2" align="center"> <input type="image" src="<?php echo $WebsitePath;?>new-images/sbtn.gif" style="width:101px; height:33px; border:none;" /> </td></tr>
	 </table>
	 </form></td></tr>
	  <tr>
          <td height="13" ><div id="frmbt"></div></td>
      </tr>
    </table>
	<? }?>
	</div>
