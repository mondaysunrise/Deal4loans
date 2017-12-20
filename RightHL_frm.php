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
<style type="text/css"></style>
<div style="float:right; clear:right; background-image:url(images/gray_bg.gif); width:275px; height:auto; margin-top:18px;">
  <div class="text3" style="width:275px; margin:auto; height:auto;margin-top:0px;">
    <form name="loan_form" method="post" action="Right.php" onsubmit="return chkformR();">
      <table width="270" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top" class="rightpanel-background"><table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="28" align="left" valign="top">&nbsp;</td>
                <td  align="left" valign="top" width="275"><table width="268" border="0" cellpadding="2" cellspacing="3">
                    <tr>
                      <td align="left" valign="top" colspan="2" style="text-align:center;"><h2 class="h2-right-panel"><strong>Apply Here</strong></h2></td>
                    </tr>
                    <tr>
                      <td width="99"  height="23" align="left" valign="top">Product</td>
                      <td width="161"><select name="Type_Loan" id="Type_Loan"  onchange="validateDiv('productRVal');"  class="d4l-side-select" tabindex="1" >
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
                      <td width="99" height="23" align="left" valign="top"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>" />
                        Full Name</td>
                      <td width="161" height="23"><input name="fullname" id="fullname" type="text" class="d4l-side-input" onkeydown="validateDiv('nameRVal');" tabindex="2" />
                        <div id="nameRVal"></div></td>
                    </tr>
                    <tr>
                      <td width="99" height="23"> Mobile</td>
                      <td width="161"> +91
                        <input name="mobile" id="mobile" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text"  class="d4l-side-Mobi" onkeydown="validateDiv('phoneRVal');" tabindex="3"  />
                        <div id="phoneRVal"></div></td>
                    </tr>
                    <tr>
                      <td width="99" height="23"> Email ID </td>
                      <td width="161"><input name="email_id" id="email_id" type="text" class="d4l-side-input" onkeydown="validateDiv('emailRVal');" tabindex="4" />
                        <div id="emailRVal"></div></td>
                    </tr>
                    <tr>
                      <td width="99" height="23" align="left" valign="top"> City</td>
                      <td width="161"><select name="city" id="city" class="d4l-side-select" onchange="validateDiv('cityRVal');" tabindex="5" >
                          <?=plgetCityList($City)?>
                        </select>
                        <div id="cityRVal"></div></td>
                    </tr>
                    <tr>
                      <td width="99" height="23" align="left" valign="top"> Net Salary (Yearly)</td>
                      <td width="161"><input name="net_salary" id="net_salary" type="text"  class="d4l-side-input" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv('netSalaryRVal');" tabindex="6"  />
                        <div id="netSalaryRVal"></div></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" colspan="2" class="right-panel-termtext"><input name="accept" type="checkbox" checked="checked"  tabindex="7"/>
                        I Agree to&nbsp;<a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">privacy policy</a> and&nbsp; <a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">Terms and Conditions</a>.
                        <div id="acceptRVal"></div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td  align="center" valign="top"  style= "margin-left:0px;"><input class="get-quotebtn" type="submit" tabindex="8" value="Get Quote"></td>
                    </tr>
                  </table></td>
            </table></td>
        </tr>
      </table>
    </form>
  </div>
  
  <!--<div class="text11" style="width:262px; ; height:288px; margin:auto; clear:both; margin-top:15px; background-image:url(images/saying_box.gif);">
<div class="text3" style="width:212px; margin:auto; height:auto; font-size:14px; color:#88a943; padding-top:25px;"><strong>What Others are saying</strong></div> 
<div class="text" style="width:212px; margin:auto; height:auto; font-size:24px; color:#008fc7; padding-top:20px; text-align:left;">Lalit Seth</div>
<div class="text" style="width:212px; margin:auto; height:auto; font-size:14px; color:#666666; text-align:left; ">Warehouseoptimization Ltd</div> 
<div class="text" style="width:212px; margin:auto; height:auto; font-size:11px; color:#666666; padding-top:15px; text-align:left; ">I got to know, how much home loan i can get and what is the process, documentation in less than a minute.Thanks</div> 
 </div>-->
  
  <div class="text11" style="width:250px; ; height:400; margin:auto; clear:both; margin-top:10px; vertical-align:top;" >
    <?
if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-banks.php")) > 0))
{
?>
    <div align="center"> <span style="font-size:11px; color:#333333; width:240px; float:left;">Advertisement</span>
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
    <? include "bimabnr_hl160x600.html"; ?>
    
    <!--<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
--> 
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

--> 
    
    <!--</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a77da726' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=87&amp;source=intCampaign&amp;n=a77da726' border='0' alt=''></a></noscript>-->
    
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
