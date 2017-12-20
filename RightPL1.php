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

<div style="float:right; clear:right; background-color:#dde4e9; width:275px;  margin-top:18px; padding-bottom: 10px;">
  <div class="text3" style="width:250px; margin:auto; height:auto;margin-top:0px; padding-top: 10px;">
    <form name="loan_form" method="post" action="/Right.php" onsubmit="return chkformR();">
      <table width="250" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" class="rightpanel-background"><table border="0" cellpadding="0" cellspacing="0">
              <tr>
              
                <td  align="left" width="250"><table width="250" border="0" cellpadding="2" cellspacing="3">
                    <tr>
                      <td align="left" valign="top" colspan="2" style="text-align:center;"><h2 class="h2-right-panel"><strong>Apply Here</strong></h2></td>
                    </tr>
                    <tr>
                      <td width="87"  height="23" align="left" valign="top"> Product</td>
                      <td width="162"><select name="Type_Loan" id="Type_Loan"  onchange="validateDiv('productRVal');"  class="d4l-side-select" tabindex="1" >
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
                      <td width="87" height="23" align="left" valign="top"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>" />
                        Full Name</td>
                      <td width="162" height="23"><input name="fullname" id="fullname" type="text" class="d4l-side-input" onkeydown="validateDiv('nameRVal');" tabindex="2" />
                        <div id="nameRVal"></div></td>
                    </tr>
                    <tr>
                      <td width="87" height="23"> Mobile</td>
                      <td width="162"> +91
                        <input name="mobile" id="mobile" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-side-Mobi" onkeydown="validateDiv('phoneRVal');" tabindex="3"  />
                        <div id="phoneRVal"></div></td>
                    </tr>
                    <tr>
                      <td width="87" height="23"> Email ID </td>
                      <td width="162"><input name="email_id" id="email_id" type="text" class="d4l-side-input" onkeydown="validateDiv('emailRVal');" tabindex="4" />
                        <div id="emailRVal"></div></td>
                    </tr>
                    <tr>
                      <td width="87" height="23" align="left" valign="top"> City</td>
                      <td width="162"><select name="city" id="city" class="d4l-side-select" onchange="validateDiv('cityRVal');" tabindex="5" >
                          <?=plgetCityList($City)?>
                        </select>
                        <div id="cityRVal"></div></td>
                    </tr>
                    <tr>
                      <td width="87" height="23" align="left" valign="top"> Net Salary (Yearly)</td>
                      <td width="162"><input name="net_salary" id="net_salary" type="text" class="d4l-side-input" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv('netSalaryRVal');" tabindex="6"  />
                        <div id="netSalaryRVal"></div></td>
                    </tr>
                    <tr>
                      <td align="left" colspan="2" style="font-size:12px;"><input name="accept" type="checkbox" checked="checked"  tabindex="7"/>
                        I Agree to&nbsp;<a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">privacy policy</a> and&nbsp; <a href="/Privacy.php" style="color:#FFFFFF; text-decoration:underline;">Terms and Conditions</a>.
                        <div id="acceptRVal"></div></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center"><input class="get-quotebtn" type="submit" tabindex="8" value="Get Quote"></td>
                    </tr>
                  </table></td>
            </table></td>
        </tr>
       
      </table>
    </form>
  </div>
  <?php

if((strlen(strpos($_SERVER['SCRIPT_NAME'], "/Contents_Calculators.php")) > 0) || (strlen(strpos($_SERVER['SCRIPT_NAME'], "/newdesign/Contents_Calculators.php")) > 0) || (strlen(strpos($_SERVER['SCRIPT_NAME'], "/Contents_Calculators2.php")) > 0))
{
?>
  <div  align="center"><a href="https://play.google.com/store/apps/details?id=d4l.emicalc.com" target="_blank" rel="nofollow" style="text-decoration:none;"><img src="images/andro36x36.gif" name="Image3" width="33" height="33" border="0" />&nbsp;<img src="images/emi1.gif" name="Image3" width="95" height="20" border="0" /></a></div>
  <div style="width:270px; margin:auto; height:auto; font-size:12px; color:#88a943; margin-top:3px; background-color:#f4f4f4;">
    <div style="clear:both; height:5px;"></div>
    <div class="text3" style="width:230px; margin:auto; height:auto; font-size:12px; color:#88a943; margin-top:2px;"><strong>Personal Loan Rate of Interest</strong></div>
    <div class="text11" style="width:210px; margin:auto; height:auto;  color:#4c4c4c; margin-top:1px; text-align:left;">( Last edited on :
      <? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
echo $currentdate=date('d F Y',$tomorrow);
?>
      )</div>
    <div style="clear:both; height:5px;"></div>
    <table border="0" cellpadding="0" cellspacing="1" bgcolor="#e0eaf1">
      <tr>
        <td width="56" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Bank<br>
          <img src="images/spacer.gif" width="48" height="8" border="0"></td>
        <td width="64" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Rate <br />
          of Interest</td>
        <td width="48" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Processing<br />
          Fee</td>
        <td width="50" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
      </tr>
      <? $getplrates="Select cat_a,bank_name,others,bank_url,processing_fee From personal_loan_interest_rate_chart where (flag=1)";
list($recordcount,$plrow)=MainselectfuncNew($getplrates,$array = array());
for($ca=0;$ca<$recordcount;$ca++)
{
?>
      <tr>
        <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="<? echo $plrow["bank_url"]; ?>" style="color:#335599;"><? echo $plrow[$ca]["bank_name"]; ?></a></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $plrow[$ca]["cat_a"]."-".$plrow[$ca]["others"]; ?><br /></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $plrow[$ca]["processing_fee"]; ?></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="<? echo $plrow[$ca]["bank_url"]; ?>" target="_blank" style="color:#335599;">APPLY</a></td>
      </tr>
      <? }?>
    </table>
    <div style="clear:both; height:3px;"></div>
  </div>
  <div style="clear:both; height:5px;"></div>
  <div style="width:270px; margin:auto; height:auto; font-size:12px; color:#88a943; margin-top:2px; background-color:#f4f4f4;">
    <div style="clear:both; height:5px;"></div>
    <div class="text3" style="width:230px; margin:auto; height:auto; font-size:14px; color:#88a943; margin-top:2px;"><strong>Home Loan Rate of Interest</strong></div>
    <div class="text11" style="width:210px; margin:auto; height:auto;  color:#4c4c4c; margin-top:px; text-align:left;">( Last edited on :
      <? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
echo $currentdate=date('d F Y',$tomorrow); ?>
      )</div>
    <div style="clear:both; height:3px;"></div>
    <table border="0" cellpadding="0" cellspacing="1" bgcolor="#e0eaf1">
      <tr>
        <td width="56" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Bank<br>
          <img src="images/spacer.gif" width="48" height="1" border="0"></td>
        <td width="70" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Rate <br />
          of Interest</td>
        <td width="47" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Prepayment<br>
          charges</td>
        <td width="56" align="center" valign="middle" bgcolor="#88a943" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
      </tr>
      <? $gethlrates=("Select ndtv_rates,bank_name,bank_url,processing_fee From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (203,3,8,5) and flag=1)");
	list($recordcount1,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
for($ca=0;$ca<$recordcount1;$ca++){

	?>
      <tr>
        <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="<?  echo $hlrow['bank_url'];?>" style="color:#335599;"><? echo $hlrow[$ca]["bank_name"]; ?></a></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $hlrow[$ca]["ndtv_rates"]; ?></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="<?  echo $hlrow[$ca]['bank_url'];?>" target="_blank" style="color:#335599;">APPLY</a></td>
        <? }?>
    </table>
    <div style="clear:both; height:2px;"></div>
  </div>
  <?php
}
else
{
?>
 
  <?php
}
?>
  <div class="text11" style="width:250px; ; height:auto; margin:auto; clear:both; margin-top:15px;">
    <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-banks")) > 0))
 {?>
    <div align="center"> </div>
    <? }
if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-banks.php")) > 0))
{
?>
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
