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
}
*/
</script>
<div style="width:250px; float:right;">
<table width="250" border="0" cellpadding="0" cellspacing="0" id="bgclr">
    <tr>
      <td align="center" valign="middle" id="frmtp"><div id="frmtpbg"></div></td>
    </tr>
	  <tr>
	 <td valign="top" style="padding-top:10px;">
	 	<form name="loan_form" method="post" action="/Right.php" onsubmit="return chkform();">

		<table width="95%" border="0" align="right" cellpadding="0" cellspacing="0">
	 <tr>
	 
	   <td width="87" align="left" class="frmtxt">Product</td>
	     <td width="151" height="25" align="left">
	 <select style="width:137px;" name="Type_Loan">
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
	   <input type="text" style="width:105px;" maxlength="10" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" name="mobile" /></td>
	 </tr>
	 <tr>
	 <td align="left" class="frmtxt">Email id</td>
	 <td height="25" align="left" ><input type="text" name="email_id" style="width:131px;" /></td>
	 </tr>
	 <tr>
	 <td class="frmtxt">City</td>
	 <td height="25" align="left" ><select name="city" style="width:136px;" >
     <?=getCityList($City)?>
	 </select></td>
	 </tr>
	  <tr>
	 <td class="frmtxt"  >Net Salary (Yearly)</td>
	 <td height="25" align="left" ><input type="text" name="net_salary"  onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" style="width:133px;" /></td>
	 </tr>	 <tr><td colspan="2"><div id="tataaig_compaign" name="tataaig_compaign"></div></td></tr>
	 <tr>
	 	<td height="45" colspan="2" style="font-size:9px;"> <input type="checkbox" name="accept" style="border:none;" checked> I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a></td>		   </tr>
	 <tr><td colspan="2" align="center"> <input type="submit" value="" class="qucksbtn" /> </td></tr>
	 </table>
	 </form></td></tr>
	  <tr>
          <td height="13" ><div id="frmbt"></div></td>
      </tr>
  </table>
<div align="center">
	<span style="font-size:11px; color:#333333; width:240px; float:left;">Advertisement</span>
 <div style="padding-top:15px;" align="center">
<script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 250x250, created 10/26/09 */
google_ad_slot = "1962172606";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>


<?  if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-banks")) > 0))
 {?>
<div align="center">


</div>
							
<? }
if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-banks.php")) > 0))
 {?>
 <br />
<br />
<div align="center">
<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=90&amp;source=intCampaign&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a6c1d908' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=90&amp;source=intCampaign&amp;n=a6c1d908' border='0' alt=''></a></noscript>

</div>
							
<? }
else if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-banks.php")) > 0))
{
?>
<br /><br />
<? include "bimabnr_hl160x600.html"; ?>
<!--<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=87&amp;source=intCampaign&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!--</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a77da726' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=87&amp;source=intCampaign&amp;n=a77da726' border='0' alt=''></a></noscript>-->

<br /><br />

<?php
}
 else 
				
{	 ?>
<script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 250x250, created 10/26/09 */
google_ad_slot = "1962172606";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
 <?php
		 }
		 ?>
</div>

 
</div>
</div>
