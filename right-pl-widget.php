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
	if(!checkData(document.loan_form.mobile, 'Mobile number', 10))
		return false;

return true;
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

 if (document.loan_form.Type_Loan.selectedIndex==0)
	{
		document.getElementById('productRVal').innerHTML = "<span  class='hintanchorqa'>Select Product</span>";	
		document.loan_form.Type_Loan.focus();
		return false;
	}
	if(document.loan_form.fullname.value=="")
	{
		document.getElementById('nameRVal').innerHTML = "<span  class='hintanchorqa'>Fill Your Name.</span>";	
		document.loan_form.fullname.focus();
		return false;
	}
 
  if(document.loan_form.mobile.value=="")
	{
		document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
		document.loan_form.mobile.focus();
		return false;
	}
	  if(isNaN(document.loan_form.mobile.value)|| document.loan_form.mobile.value.indexOf(" ")!=-1)
		{
			document.getElementById('phoneRVal').innerHTML = "<span  class='hintanchorqa'>Fill Mobile Number.</span>";	
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
	if(document.loan_form.email_id.value=="")
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter  Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	
	var str=document.loan_form.email_id.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailRVal').innerHTML = "<span  class='hintanchorqa'>Enter Valid Email Address!</span>";	
		document.loan_form.email_id.focus();
		return false;
	}
	
	if (document.loan_form.city.selectedIndex==0)
	{
		document.getElementById('cityRVal').innerHTML = "<span class='hintanchorqa'>Please Select City!</span>";
		document.loan_form.city.focus();
		return false;
	}
	if(document.loan_form.net_salary.value=="")
	{
		document.getElementById('netSalaryRVal').innerHTML = "<span class='hintanchorqa'>Fill your Net salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
	if(document.loan_form.net_salary.value<=0)
	{
		document.getElementById('netSalaryRVal').innerHTML = "<span class='hintanchorqa'>Fill Your Net Salary (Yearly)!</span>";
		document.loan_form.net_salary.focus();
		return false;
	}
if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptRVal').innerHTML = "<span class='hintanchorqa'>Accept the Terms and Condition!</span>";	
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
</script>

<div class="right-panel-wrapper">
  <div>
    <div>
      <form name="loan_form" method="post" action="Right.php" onsubmit="return chkformR();">
        <div class="right-panel-fomr-box">
          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="3">
            <tr>
              <td height="35" colspan="2" align="center" valign="middle"><h2 class="pl-h2">Apply Here</h2></td>
            </tr>
            <tr>
              <td  height="23" align="left" valign="top" class="side-form-text"> Product</td>
              <td ><select name="Type_Loan" id="Type_Loan"  onchange="validateDiv('productRVal');"  class="d4l-side-select" tabindex="1" >
                  <option value="1">Please select</option>
                  <option value="Req_Loan_Personal">Personal Loan</option>
                  <option value="Req_Loan_Home">Home Loan</option>
                  <option value="Req_Loan_Car">Car loan</option>
                  <option value="Req_Loan_Against_Property">Loan against Property</option>
                  <option value="Req_Credit_Card">Credit Card</option>
                  <option value="Req_Loan_Education">Education Loan</option>
                  <option value="Req_Loan_Gold">Gold Loan</option>
                </select>
                <div id="productRVal"></div></td>
            </tr>
            <tr>
              <td  height="23" align="left" valign="top" class="side-form-text"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>" />
                Full Name</td>
              <td   height="23"><input name="fullname" id="fullname" type="text" class="d4l-side-input" onkeydown="validateDiv('nameRVal');" tabindex="2"  autocomplete="off" />
                <div id="nameRVal"></div></td>
            </tr>
            <tr>
              <td  height="23" class="side-form-text"> Mobile</td>
              <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="5%" class="side-form-text">+91 </td>
                    <td width="95%"><input name="mobile" id="mobile" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-side-input" onkeydown="validateDiv('phoneRVal');" tabindex="3" autocomplete="off" />
                      <div id="phoneRVal"></div></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td  height="23" class="side-form-text"> Email ID </td>
              <td ><input name="email_id" id="email_id" type="text" class="d4l-side-input" onkeydown="validateDiv('emailRVal');" tabindex="4"  autocomplete="off" />
                <div id="emailRVal"></div></td>
            </tr>
            <tr>
              <td  height="23" align="left" valign="top" class="side-form-text"> City</td>
              <td ><select name="city" id="city"  class="d4l-side-select" onchange="validateDiv('cityRVal');" tabindex="5">
                  <?=plgetCityList($City)?>
                </select>
                <div id="cityRVal"></div></td>
            </tr>
            <tr>
              <td  height="23" align="left" valign="top" class="side-form-text"> Net Salary (Yearly)</td>
              <td ><input name="net_salary" id="net_salary" type="text"  class="d4l-side-input"  onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv('netSalaryRVal');" tabindex="6" autocomplete="off" />
                <div id="netSalaryRVal"></div></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="top" ><input name="accept" type="checkbox" checked="checked"  tabindex="7"/>
                <span style="font-size:12px;"> I Agree to <a href="/Privacy.php">privacy policy</a> and <a href="/Privacy.php">Terms and Conditions</a>.
                <div id="acceptRVal"></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td  align="center" valign="top"  style= "margin-left:0px;"><input type="submit" class="pl-get-quotebtn"value="Get Quote" tabindex="8"/></td>
            </tr>
          </table>
        </div>
      </form>
    </div>
    <div style="height:15px;"></div>
    
    <!--<div class="text11" style="width:262px; ; height:288px; margin:auto; clear:both; margin-top:15px; background-image:url(images/saying_box.gif);">
<div class="text3" style="width:212px; margin:auto; height:auto; font-size:14px; color:#88a943; padding-top:25px;"><strong>What Others are saying</strong></div> 
<div class="text" style="width:212px; margin:auto; height:auto; font-size:24px; color:#008fc7; padding-top:20px; text-align:left;">Lalit Seth</div>
<div class="text" style="width:212px; margin:auto; height:auto; font-size:14px; color:#666666; text-align:left; ">Warehouseoptimization Ltd</div> 
<div class="text" style="width:212px; margin:auto; height:auto; font-size:11px; color:#666666; padding-top:15px; text-align:left; ">I got to know, how much home loan i can get and what is the process, documentation in less than a minute.Thanks</div> 
 </div>-->
    
    <div>
      <? 
if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-banks.php")) > 0))
{
?>
      <div align="center"> <span>Advertisement</span>
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
        </div>
      </div>
      <br />
      <div align="center"> 
        <!--<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>--> 
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
        <!--</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a6c1d908' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=90&amp;source=intCampaign&amp;n=a6c1d908' border='0' alt=''></a></noscript>-->
        <? include "bimabnr_hl250x250.html"; ?>
      </div>
      <? 
}
else if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-banks.php")) > 0))
{
?>
      <br />
      <br />
      <script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script> 
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
</script>
      <noscript>
      <a href='http://ads.deal4loans.com/adclick.php?n=a77da726' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=87&amp;source=intCampaign&amp;n=a77da726' border='0' alt=''></a>
      </noscript>
      <br />
      <br />
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
