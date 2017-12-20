<script  type="text/javascript">
function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function validmobile(phone) 
{
	
	atPos = phone.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.cc_form.mobile, 'Mobile number', 10))
		return false;

return true;
}
function chkformR()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var cnt;
var myOption;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

 
	if(document.cc_form.name.value=="")
	{
		document.getElementById('nameRVal').innerHTML = "<span  class='hintanchorqa'>Fill Your Name.</span>";	
		document.cc_form.name.focus();
		return false;
	}
 
  if(document.cc_form.mobile.value=="")
	{
		document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
		document.cc_form.mobile.focus();
		return false;
	}
	  if(isNaN(document.cc_form.mobile.value)|| document.cc_form.mobile.value.indexOf(" ")!=-1)
		{
			document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
            alert("Enter numeric value");
			  document.cc_form.mobile.focus();
			  return false;  
		}
        if (document.cc_form.mobile.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.cc_form.mobile.focus();
				return false;
        }
        if ((document.cc_form.mobile.value.charAt(0)!="9") && (document.cc_form.mobile.value.charAt(0)!="8") && (document.cc_form.mobile.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.cc_form.mobile.focus();
                return false;
		}
	if(document.cc_form.email.value=="")
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter  Email Address!</span>";	
		document.cc_form.email.focus();
		return false;
	}
	
	var str=document.cc_form.email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.cc_form.email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.cc_form.email.focus();
		return false;
	}
	
	if (document.cc_form.city.selectedIndex==0)
	{
		document.getElementById('cityRVal').innerHTML = "<span class='hintanchorqa'>Please Select City!</span>";
		document.cc_form.city.focus();
		return false;
	}
	
	myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
					myOption = i;
				}
		}
	
		if (myOption == -1) 
		{
			document.getElementById('vintageVal').innerHTML = "<span  class='hintanchor'>Choose you want offers of credit card or debit card</span>";	
			return false;
		}
	
if(!document.cc_form.accept.checked)
	{
		document.getElementById('acceptRVal').innerHTML = "<span class='hintanchorqa'>Accept the Terms and Condition!</span>";	
		document.cc_form.accept.focus();
		return false;
	}

	
}
</script>
<div style="float:right; clear:right; background-image:url(images/gray_bg.gif); width:275px; height:auto; margin-top:18px;">
<div class="text3" style="width:275px; margin:auto; height:auto; font-size:11px; color:#88a943; margin-top:0px;">
<form name="cc_form" action="credit-card-archives-continue.php" method="POST" onsubmit="return chkformR();">
<input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "ccndcpage";} ?>" />
<table width="270" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="10" align="left" valign="top"><img src="images/bgtop.jpg" width="275" height="10" /></td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#21405F"><table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="28" align="left" valign="top">&nbsp;</td>
	<td  align="left" valign="top" width="275">
		<table width="268" border="0" cellpadding="0" cellspacing="3">
		<tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:14px;  text-align:center; " height="70">
				<strong>Register here for latest Discounts, Offers & Reward information on Credit Card & Debit Cards</strong>			</td>
		</tr>

<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">

Full Name</td><td width="161" class="text" style="  color:#FFF; font-size:11px;  " height="23">
<input name="name" id="name" type="text" style="width:145px; height:14px;" onkeydown="validateDiv('nameRVal');" tabindex="2" />
<div id="nameRVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Mobile</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
+91 
<input name="mobile" id="mobile" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:122px; height:14px;" onkeydown="validateDiv('phoneRVal');" tabindex="3"  />
<div id="phoneRVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Email ID </td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
<input name="email" id="email" type="text" style="width:145px; height:14px;" onkeydown="validateDiv('emailRVal');" tabindex="4" />
<div id="emailRVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
City</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
<select name="city" id="city" style=" height:18px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c; width:150px;" onchange="validateDiv('cityRVal');" tabindex="5" >
<?=plgetCityList($City)?>
</select>
<div id="cityRVal"></div>   
</td>
</tr>
<tr><td colspan="2" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;" height="40" align="center">Want Offers, Discounts & Reward information On </td></tr>
<tr>
<td  height="23" align="left" valign="top" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;" colspan="2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><input type="checkbox" value="1" name="card_type_cc" id="card_type_cc" onclick="getdivdetailsdc();" style="border:none;" /></td>
            <td class="text" style="color:#FFF; font-size:11px;  padding-right:2px;"><b>Credit Card</b></td>
            <td><input type="checkbox" value="2" name="card_type_dc" id="card_type_dc" onclick="getdivdetailsdc();"  style="border:none;"/></td>
            <td class="text" style="color:#FFF; font-size:11px;  padding-right:2px;"><b>Debit Card</b></td>
          </tr>
      </table>   
</td>
</tr>
<tr>
<td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:8px; margin-top:0px; ">
  <input name="accept" type="checkbox" checked="checked"  tabindex="7"/>  
     I Agree to&nbsp;<a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">privacy policy</a> and&nbsp; <a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">Terms and Conditions</a>.
     <div id="acceptRVal"></div>
</td>
</tr>
<tr>
<td  align="center" valign="top"  style= "margin-left:0px;" colspan="2" >
<input type="submit" style="border: 0px none ; background-image: url(images/get_quot.jpg); width: 94px; height: 27px; margin-bottom: 0px;" value="" tabindex="8"/>
</td>
</tr> 
</table>
        </td>


</table></td>
</tr>
<tr>
<td height="15" align="left" valign="top"><img src="images/bgbottom.jpg" width="275" height="10" /></td>
</tr>
</table>
</form>
<div style="text-align:center; padding-top:15px;" align="center"><span>Advertisement</span>

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
</script><br /><br />
<!--<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>-->
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=86&amp;source=intCampaign&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!--</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a1ea6152' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=86&amp;source=intCampaign&amp;n=a1ea6152' border='0' alt=''></a></noscript>-->

<div align="center">
	<? include "bimabnr_hl160x600.html"; ?>
	</div>

		 </div>
</div>
</div>