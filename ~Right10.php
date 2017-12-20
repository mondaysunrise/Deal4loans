 <?php
 if(!isset($_SESSION['UserType']))
{

//ob_start();
 //session_start();
  if ((($_REQUEST['flag'])!=1))
	{


?>

<!--/////////////if clause for credit card offers//////////////////////////////////////////////////////-->
   
	<?php
		if((strlen(strpos($_SERVER['REQUEST_URI'], "credit-card-offers")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "credit-card-archives")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "credit-cards-offers")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "earn-credit-card")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Faqs")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Eligibility")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Mustread")) > 0))
		{
	?>

	<script>
		function valButton5() {
		var cnt = -1;
		var i;
		for(i=0; i<document.CC_offers_mailer.From_Product.length; i++) 
		{
			if(document.CC_offers_mailer.From_Product[i].checked)
			{
				cnt=i;
				
			}
		}
		if(cnt > -1)
		{ 
			return true;
		}
		else
		{
			return false;
		}
	}            
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
function ccofferform(Form)
{
	var btn2;
if(document.CC_offers_mailer.name.value=="") 
			{
				alert("Please fill your name.");
				document.CC_offers_mailer.name.focus();
				return false;
			}
			if(document.CC_offers_mailer.mobile.value=="") 
			{
				alert("Please fill your mobile.");
				document.CC_offers_mailer.mobile.focus();
				return false;
			}
			
	 if(isNaN(document.CC_offers_mailer.mobile.value)|| document.CC_offers_mailer.mobile.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in mobile no");
			  document.CC_offers_mailer.mobile.focus();
			  return false;  
		}
        if (document.CC_offers_mailer.mobile.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.CC_offers_mailer.mobile.focus();
				return false;
        }
        if ((document.CC_offers_mailer.mobile.value.charAt(0)!="9") && (document.CC_offers_mailer.mobile.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
				 document.CC_offers_mailer.mobile.focus();
                return false;
        }

		if(document.CC_offers_mailer.email.value=="") 
			{
				alert("Please fill your Email.");
				document.CC_offers_mailer.email.focus();
				return false;
			}
			
		if(document.CC_offers_mailer.email.value!="")
		{
			if (!validmail(document.CC_offers_mailer.email.value))
			{
				//alert("Please enter your valid email address!");
				document.CC_offers_mailer.email.focus();
				return false;
			}
		
	
		}
if (document.CC_offers_mailer.city.selectedIndex==0)
	{
		alert("Please select city to Continue");
		document.CC_offers_mailer.city.focus();
		return false;
	}

btn2=valButton5();
					if(!btn2)
					{
						alert('you holding credit card from which bank.');
						return false;
					}
}


function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.CC_offers_mailer.city.value=="Delhi" || document.CC_offers_mailer.city.value=='Delhi' || document.CC_offers_mailer.city.value=='Noida'  ||  document.CC_offers_mailer.city.value=='Gurgaon'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Gaziabad'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Greater Noida'  || document.CC_offers_mailer.city.value=='Chennai'  ||  document.CC_offers_mailer.city.value=='Mumbai'  ||  document.CC_offers_mailer.city.value=='Thane'  ||  document.CC_offers_mailer.city.value=='Navi mumbai'  ||  document.CC_offers_mailer.city.value=='Kolkata'  ||  document.CC_offers_mailer.city.value=='Kolkota'  ||  document.CC_offers_mailer.city.value=='Hyderabad'  ||  document.CC_offers_mailer.city.value=='Pune'  || document.CC_offers_mailer.city.value=='Bangalore')
			{
				//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked /> <a href="http://www.deal4loans.com/tata-aig-personal-accident-cover.php" target="_blank" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#472516; font-weight:normal; padding-left:2px;"> Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.CC_offers_mailer.city.value=="Delhi" || document.CC_offers_mailer.city.value=='Delhi' || document.CC_offers_mailer.city.value=='Noida'  ||  document.CC_offers_mailer.city.value=='Gurgaon'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Gaziabad'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Greater Noida'  || document.CC_offers_mailer.city.value=='Chennai'  ||  document.CC_offers_mailer.city.value=='Mumbai'  ||  document.CC_offers_mailer.city.value=='Thane'  ||  document.CC_offers_mailer.city.value=='Navi mumbai'  ||  document.CC_offers_mailer.city.value=='Kolkata'  ||  document.CC_offers_mailer.city.value=='Kolkota'  ||  document.CC_offers_mailer.city.value=='Hyderabad'  ||  document.CC_offers_mailer.city.value=='Pune'  || document.CC_offers_mailer.city.value=='Bangalore')
			{
				//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked /> <a href="http://www.deal4loans.com/tata-aig-personal-accident-cover.php" target="_blank" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#472516; font-weight:normal; padding-left:2px;"> Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}
</script>
 <div id="dvColumn3"> 
      <div id="dvRightBanner">
<div align="center"><form  name="CC_offers_mailer" action="http://deal4loans.com/credit-card-offers-registration.php" method="POST" ONsubmit="return ccofferform(document.CC_offers_mailer);"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "ccndcoffers";} ?>">
	<input type="hidden" name="REFERER_URL" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
<table width="235" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td bgcolor="#2a84da" align="center" width="100%" style="color:#FFFFFF; font-family:verdana; font-weight:bold; font-size:13px;" height="60">To Get Updated Rewards/Offers on your  Credit Card, <u>Register Here</u></td>
</tr>
                  <tr>
                  
<td valign="top" align="center" bgcolor="#FFFFFF" style="border:1px solid #2a84da;"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  >
                      
                      <tr>
                        <td width="66" align="left" valign="bottom" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#07468c; text-align:left; font-weight:bold; line-height:18px;">Name</td>
                        <td width="116"  align="left" valign="bottom"><input type="text" name="name" style="width:105px;" maxlength="30" /></td>
                      </tr>
                      <tr>
                        <td width="66" height="26" align="left" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#07468c; text-align:left; line-height:18px; font-weight:bold;">Mobile</td>
                        <td align="left" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#07468c; text-align:left; line-height:18px; font-weight:bold;">91 
                          <input type="text" name="mobile" style="width:85px;" maxlength="10" /></td>
                      </tr>
                      <tr>
                        <td width="66" height="26" align="left" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#07468c; text-align:left; line-height:18px; font-weight:bold;">Email Id </td>
                        <td align="left"><input type="text" name="email" style="width:105px;" maxlength="30" /></td>
                      </tr>
                      <tr>
                        <td width="66" height="26" align="left" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#07468c; text-align:left; line-height:18px; font-weight:bold;">City</td>
                        <td align="left"><select name="city" style="width:113px; font-size:11px; font-family: Verdana, Arial, Helvetica, sans-serif;">
								  <option value="-1" selected>Please Select</option><option value="Ahmedabad">Ahmedabad</option>
                                <option value="Aurangabad">Aurangabad</option>
                                <option value="Bangalore">Bangalore</option>
                                <option value="Baroda">Baroda</option>
                                <option value="Bhopal">Bhopal</option>
                                <option value="Bhubneshwar">Bhubneshwar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chennai">Chennai</option>
                                <option value="Cochin">Cochin</option>
                                <option value="Coimbatore">Coimbatore</option>
                                <option value="Cuttack">Cuttack</option>
                                <option value="Dehradun">Dehradun</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Faridabad">Faridabad</option>
                                <option value="Gaziabad">Gaziabad</option>
                                <option value="Gurgaon">Gurgaon</option>
                                <option value="Guwahati">Guwahati</option>
                                <option value="Hosur">Hosur</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Indore">Indore</option>
                                <option value="Jabalpur">Jabalpur</option>
                                <option value="Jaipur">Jaipur</option>
                                <option value="Jamshedpur">Jamshedpur</option>
                                <option value="Kanpur">Kanpur</option>
                                <option value="Kochi">Kochi</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Lucknow">Lucknow</option>
                                <option value="Ludhiana">Ludhiana</option>
                                <option value="Madurai">Madurai</option>
                                <option value="Mangalore">Mangalore</option>
                                <option value="Mysore">Mysore</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Nagpur">Nagpur</option>
                                <option value="Nasik">Nasik</option>
                                <option value="Navi Mumbai">Navi 
                                  Mumbai</option>
                                <option value="Noida">Noida</option>
                                <option value="Patna">Patna</option>
                                <option value="Pune">Pune</option>
                                <option value="Ranchi">Ranchi</option>
                                <option value="Sahibabad">Sahibabad</option>
                                <option value="Surat">Surat</option>
                                <option value="Thane">Thane</option>
                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                <option value="Trivandrum">Trivandrum</option>
                                <option value="Trichy">Trichy</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Vishakapatanam">Vishakapatanam</option>
                                <option value="Others">Others</option></select></td>
                      </tr>
					  
					  <tr>
					    <td height="30" colspan="2" align="center" valign="bottom" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#07468c; text-align:center;"><b>I want offer updates on following Cards </b></td>
			    </tr>
					  <tr>
					  <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;"><input type="checkbox" name="From_Product[]"  id="From_Product" value="Axis Bank" style="border:none;"> Axis Bank</td>
                          <td width="38%" height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;"><input type="checkbox"  id="From_Product" name="From_Product[]" value="Amex"  style="border:none;"/> Amex</td>
                        </tr>
					    <tr>
                        
						  <td width="63%" height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:normal; color:#07468c; text-align:left;" ><input type="checkbox" id="From_Product" value="AbnAmro Bank" name="From_Product[]"    style="border:none;"/> ABN AMRO</td>
					      <td height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;"><input type="checkbox" id="From_Product" name="From_Product[]"  value="SBI"  style="border:none;"/> SBI</td>
					    </tr>
                        <tr>
                          <td height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;"><input type="checkbox" name="From_Product[]" id="From_Product"  value="Citibank"  style="border:none;"/>                   Citibank</td>
                          <td height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC"   style="border:none;"/> HDFC</td>
                        </tr>
                        <tr>
                          <td height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;"><input type="checkbox" name="From_Product[]" value="Barclays" id="From_Product" style="border:none;">
                            Barclays</td>
                          <td height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;"><input type="checkbox" id="From_Product" name="From_Product[]"  value="ICICI"  style="border:none;"/> ICICI</td>
                        </tr>
                        <tr>
                          <td height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;"><input type="checkbox" name="From_Product[]"  id="From_Product" value="Deutsche bank"  style="border:none;"/>
                            Deutsche Bank</td>
                          <td height="20" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;" ><input type="checkbox"  value="HSBC" name="From_Product[]" id="From_Product"  style="border:none;"/>
                            HSBC</td>
                        </tr>
                        <tr>
                          <td height="20"  colspan="2" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:11px;  color:#07468c; text-align:left;"><input type="checkbox" name="From_Product[]" value="Kotak Bank" id="From_Product"  style="border:none;"> Kotak Bank
						  </td>
                        </tr>
                        
                      </table></td>
					  </tr>
					  
                      <tr bgcolor="#fde9cf">
                        <td colspan="2"  align="left" valign="middle" bgcolor="#FFFFFF"><table width="100%"   border="0" align="left" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="20"  align="center"><input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked  style="border:none;"/></td>
                            <td height="25" align="left"><a href="http://www.deal4loans.com/tata-aig-personal-accident-cover.php" target="_blank" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#472516; font-weight:normal; padding-left:2px;"> Get free personal accident insurance</a></td>
                          </tr>
                        </table></td>
                </tr>
                      
                      <tr>
                        <td height="35" colspan="2" align="center" valign="middle"><input name="submit" value="Subscribe" type="submit" style="font-size:12px; font-weight:bold; background-color:#2a84da; color:#FFFFFF; width:80px; height:24px; border:none;"/></td>
                      </tr>
                    </table></td>
       
                  </tr>
                  
        </table></form>
</div>
<div align="center"><span style="font-size:11px; color:#333333; width:240px; float:left;">Advertisement</span><script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
  
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=72&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a7926fba' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=72&amp;n=a7926fba' border='0' alt=''></a></noscript></div></div>
</div>
</div>
			<? }
		
		else
		{?>
		 <div id="dvColumn3"> 
      <div id="dvRightBanner">
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

  <div id="dvColumn3">  
    <!--<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">-->
	<?php 

if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0") > 0)
{
?>
<!-- IE 6.0 -->
	 <table width="237" border="0" align="center" cellpadding="0" cellspacing="0"  class="blueborder" >
<?php
}
else {
?>

	 <table width="237" border="0" align="center" cellpadding="0" cellspacing="0"  class="blueborder" >


	<?php } ?>

	 <tr bgcolor="#529BE4">
	 <td height="25" colspan="2" align="center" class="quick"  style="font-size:13px; font-family: Arial, Helvetica, sans-serif; font-weight:bold;color:#FFFFFF;"> 
	 <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-sbi")) > 0) )
	 {?>	 Apply For SBI Personal Loan
	 <? }
	 elseif((strlen(strpos($_SERVER['REQUEST_URI'], "hdfc-bank-home-loan")) > 0) )
	 {?>
	 Apply For HDFC Home Loan
	 <?
	 }
	 elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-barclays-bank")) > 0) )
	 {?>
	 Apply For Barclays Personal Loan
	 <?
	 }
	 elseif((strlen(strpos($_SERVER['REQUEST_URI'], "sbi-home-loan")) > 0) )
	 {?>
	 Apply For SBI Home Loan
	 <?
	 }
	 elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-lic-housing")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "lic-housing-home-loan")) > 0))
	 {?>
	 Apply For LIC Housing
	 <?
	 }
	 elseif((strlen(strpos($_SERVER['REQUEST_URI'], "dhfl")) > 0))
	 {?>
	 Apply For DHFL Home Loan
	 <?
	 }
	 elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-citifinancial")) > 0))
	 {?>
	 Apply For Citifinancial Home Loan
	 <?
	 }
	 else
	 {
	 ?>
	 Apply Here
	 <?
	 } ?>	 </td>
	 </tr><tr><td bgcolor="#FFFFFF">
	 	<form name="loan_form" method="post" action="/Right.php" onSubmit="return chkform();">

	 <table  border="0" height="100" width="98%" cellpadding="2" cellspacing="0" >
	 
	 
	 <td width="40%" align="left" class="quick">Product Type</td>
	 <td width="70%" align="right">
	 <select style="width:138px;" name="Type_Loan">
	  <option value="1">Please select</option>
	  <option value="Req_Loan_Personal">Personal Loan</option>
	   <option value="Req_Loan_Home">Home Loan</option>
	   <option value="Req_Loan_Car">Car loan</option>
	   <option value="Req_Loan_Against_Property">Loan against Property</option>
	   <option value="Req_Credit_Card">Credit Card</option>
<!-- 	   <option value="Req_Business_Loan">Business Loan</option>
 -->	 </select></td>
	 </tr>
  <tr align="left"><td colspan="2"  width="4"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>"></td>
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
	 <tr><td colspan="2" align="center"> <input type="submit" class="bluebutton" value="Get Quote" >&nbsp;
            </td></tr>
	 </table>
	 </form></td></tr>
	 
	 
	   
</table>
<br>
<div style="width:250px; font-weight:bold;">
Articles Tag Cloud <br><?php include "articlesTags.php"; ?>
</div>


<div align="center" style="width:250px; clear:both; padding:3px 0px;
">
<?php 
if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-lic-housing1")) > 0))
	 {
	 
	 }
	 else
	 {
	 
	 
?>

	

	 <? }?>
                

  <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="3">
			  <? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
		  <?php
		  }
		  ?>
		  
</div>
	</div>
	 
	 <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "t_y")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "t_y1")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-home-loan-thank")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-apply-thank")) > 0))
	 {
	//echo "hello qazwwxxc";
	$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if((($Type_Loan=="Req_Loan_Home") || ($product=="HomeLoan")) && ($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		
		 {
			 ?>
			  <div align="center"><span style="font-size:11px; color:#333333; width:240px; float:left;">Advertisement</span><script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>

<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
  
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=72&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a7926fba' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=72&amp;n=a7926fba' border='0' alt=''></a></noscript>
</div>
</div>
		 
	<? }
}

	?>
	 
	 <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-banks")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-banks")) > 0))
	 {?>
	 
<div align="center"><span style="font-size:11px; color:#333333; width:240px; float:left;">Advertisement</span><script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
  
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=72&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a7926fba' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=72&amp;n=a7926fba' border='0' alt=''></a></noscript></div>
</div>	  <? }?>
	 
	 
	 


		
		      	     
		
<!--	<? if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "home-loan")) > 0) )

	 { ?><div align="center"><img src="images/bank-rate-ban.gif" /></div>
	 
	   <? }?>-->
	   
	   
	   <? if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-citibank")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Interest-Rate-Personal")) > 0))

	 { ?><!--<div ><font style="Font-size:11px; font-family:Century Gothic;color:#898989;">Advertisement</font>
		 <script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=59&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!--
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a735de0c' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=59&amp;n=a735de0c' border='0' alt=''></a></noscript></div>
<!--<div align="center"><img src="images/bank-rate-ban.gif" /></div>-->
	 
	   <? }?>
	   
	   
	   
	     <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "viewnewsletter")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "newsletter-archives-main")) > 0) )
	 {	
			  $newsqry="select * from Newsletter where 1=1 order by News_Dated Desc ";
			  list($recordcount,$getrow)=MainselectfuncNew($newsqry,$array = array());
		      $cntr=0;
	
			  ?>
			  <Div align="center"><font style="Font-size:14px; font-family:Century Gothic;font-weight:bold;" >Newsletter Menu</font></div><table>
			  <?
		while($cntr<count($getrow))
        {
			$News_Content = $getrow[$cntr]['News_Content'];
			$News_Subject = $getrow[$cntr]['News_Subject'];
			$News_Date = $getrow[$cntr]['News_Month'];
			$subject = substr($News_Subject, 0, 25);
		 ?>
		 <tr>
		<td><font face="Verdana" size="1" color="0F74D4">&#8226;</font> <font style="Font-size:11px; font-family:Verdana;"> <a href="javascript:ajaxpage('<? echo "/".$News_Content;?>', 'contentarea');"><?echo  $News_Date."-".$subject."...";?></a></font><BR/></td></tr>
		 <?
		$cntr = $cntr +1; }
		 
		 ?>
		 </table>
		<div id="dvRightBanner150"><img src="/images/spacer.gif" alt="" height="288" width="150" /></div>

	 <? } ?>

	  <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "viewnewsletter")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "newsletter-archives-main")) > 0) )
	 {
			  $newsqry="select * from Newsletter where 1=1 order by News_Dated Desc ";
			 //echo "ffff".$newsqry;
			 
			  list($recordcount,$Myrow)=MainselectfuncNew($newsqry,$array = array());
		      $i=0;
			  ?>
			  <Div align="center"><font style="Font-size:14px; font-family:Century Gothic;font-weight:bold;" >Newsletter Menu</font></div><table>
			  <?
		 while($i<count($Myrow))
        	{
			$News_Content = $getrow[$i]['News_Content'];
			$News_Subject = $getrow[$i]['News_Subject'];
			$News_Date = $getrow[$i]['News_Month'];
			$subject = substr($News_Subject, 0, 25);
		 ?>
		 <tr>
		<td><font face="Verdana" size="1" color="0F74D4">&#8226;</font> <font style="Font-size:11px; font-family:Verdana;"> <a href="javascript:ajaxpage('<? echo "/".$News_Content;?>', 'contentarea');"><?echo  $News_Date."-".$subject."...";?></a></font><BR/></td></tr>
		 <?
		$i = $i +1; }
		 
		 ?>
		 </table>
		<div id="dvRightBanner150"><img src="/images/spacer.gif" alt="" height="288" width="150"></div>

	 <? } ?>


	  

<?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Calculators")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "loan-amortization")) > 0))
	 {?>
	 
		<div style="clear:both;" > 
		<table cellspacing="0" cellpadding="0" border="0">
		<tr>
              <td height="40" colspan="3" valign="middle"  bgcolor="#FFFFFF" class="steps-text" style="color:#333333;" ><b>Personal Loan Rate of Interest</b><br />
<div align="center">( Last edited on : <? echo $currentdate; ?> )</div></td>
          </tr>
            <tr>
              <td colspan="3" valign="top"  bgcolor="#FFFFFF" class="steps-text" ><table border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
                <tr>
                  <td width="83" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Bank</td>
                  <td width="66" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Rate <br />
                  of Interest</td>
                  <td width="48" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Processing<br />
                    Fee</td>
                  <td width="50" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
                </tr>
			
				<tr>
                  <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">Citibank</td>
				  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"> 16.5%-<br>
				    18.5%<br /></td>
				  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
				  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="citibank-personal-loan-eligibility.php" style="color:#335599;"  rel="nofollow">APPLY</a></td>
			    </tr>
				<tr>
				  <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">Fullerton </td>
				  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">23%-28%</td>
				  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
				  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/fullerton-personal-loan-eligibility.php" style="color:#335599;" rel="nofollow">APPLY</a></td>
				</tr>
				<tr>
                  <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">HDFC</td>
				  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"> 14.5%<br />
			      -24%</td>
				  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
				  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="hdfc-personal-loan-eligibility.php" style="color:#335599;" rel="nofollow">APPLY</a></td>
			    </tr>
			
              </table></td>
            </tr>
            <tr>
              <td height="40" colspan="3" valign="middle"  bgcolor="#FFFFFF" class="steps-text" style="color: #333333;" ><b>Home Loan Rate of Interest</b><br />
                  <div align="center">( Last edited on : <? echo $currentdate; ?> )</div></td>
            </tr>
            <tr>
              <td colspan="3" valign="top"  bgcolor="#FFFFFF" class="steps-text" ><table border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
                <tr>
                  <td width="62" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Bank</td>
                  <td width="64" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Rate <br />
                    of Interest</td>
                  <td width="51" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Prepayment<br />
                    charges</td>
                  <td width="52" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
                </tr>
			
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;">AXIS Bank</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">8.75%-<br />
                    9.25%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">Nil</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/home-loan-axis-bank.php" style="color:#335599;" rel="nofollow">APPLY</a></td>
                </tr>
			
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;">Citi Bank</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">9.75%(For 20 years)</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">N.A.</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/apply-home-loans.php"   style="color:#335599;" rel="nofollow">APPLY</a></td>
                </tr>
			
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;">HDFC</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"> 8.75%-<br />
                    9.50%<br /></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="hdfc-bank-home-loan.php" style="color:#335599;" rel="nofollow">APPLY</a></td>
                </tr>
				
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;">ICICI HFC</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">8.75%-<br />
                    9.75%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="icici-hfc-home-loan.php" style="color:#335599;" rel="nofollow">APPLY</a></td>
                </tr>
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;">IDBI</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">8.75%<br />
                    -9.25%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:9px; line-height:12px;">If Balance<br />
                    Transfer then<br />
                    2.5% Otherwise Nil</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="http://www.deal4loans.com/home-loan-idbi-homefinance.php" style="color:#335599;" rel="nofollow">APPLY</a></td>
                </tr>
			
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;">LIC</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"> 8.75%-<br />
                    9.25% </td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="lic-housing-home-loan.php" target="_blank" style="color:#335599;" rel="nofollow">APPLY</a></td>
            
                <tr>
                  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;">SBI</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">8%-11%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="sbi-home-loan.php" style="color:#335599;" rel="nofollow">APPLY</a></td>
                </tr>
			
              </table></td>
            </tr></table>
          
<div align="center"><span style="font-size:11px; color:#333333; width:240px; float:left;">Advertisement</span><script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
  
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=72&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a7926fba' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=72&amp;n=a7926fba' border='0' alt=''></a></noscript></div>
</div>
      
     </div>
	  <? }?>
	
	  


		
      </div>
	  </div>
	  
	  
	   <? //} 
	   }
 else
 { ?><div id="dvColumn3">  
        <div id="dvRighttxtImage"><!--<img src="/images/Right_heading_txt.gif" width="219" height="31" />--></div>
	<iframe src="http://www.sify.com/finance/loans/dealforloans/content.html" width="250" height="900" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" id='content' name='content'></iframe>
</div>
<?}?>
<?
}?>