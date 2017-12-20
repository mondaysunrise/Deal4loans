<?php
//require 'scripts/db_init.php';
?>
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

</script>

<div style=" width:250px; float:right;">
<table width="250" border="0" cellpadding="0" cellspacing="0" id="bgclr">
    <tr>
      <td align="center" valign="middle" id="frmtp">
	  <? if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-standard-chartered-bank")) > 0)) 
	
		 {?>	 
	Apply for Standard Chartered 
	 <? 
	 }
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "sbi-home-loan")) > 0))
	 {?>
	Apply for SBI
	 <? 
	 }
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "lic-housing-home-loan")) > 0))
	{
	?>
	Apply for LIC Housing
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-ingvysya-bank")) > 0))
	{
	?>
	Apply for ING VYSYA Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "icici-hfc-home-loan")) > 0))
	{
	?>
	Apply for ICICI Bank Home Loan
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-idbi-homefinance")) > 0))
	{
	?>
	Apply for IDBI Home Finance
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "hdfc-bank-home-loan")) > 0))
	{
	?>
	Apply for HDFC Ltd
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "dhfl")) > 0))
	{
	?>
	Apply for DHFL
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "deutsche-bank-home-loan")) > 0))
	{
	?>
	Apply for Deutsche Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-axis-bank")) > 0))
	{
	?>
	Apply for Axis Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-citibank")) > 0))
	{
	?>
	Apply for Citibank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-idbi-bank")) > 0))
	{
	?>
	Apply for IDBI Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-reliance")) > 0))
	{
	?>
	Apply for Reliance
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-kotak-mahindra-bank")) > 0))
	{
	?>
	Apply for Kotak Mahindra Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-citifinancial")) > 0))
	{
	?>
	Apply for Citifinancial
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-icici-bank")) > 0))
	{
	?>
	Apply for ICICI Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-axis-bank")) > 0))
	{
	?>
	Apply for Axis Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-deutsche-bank")) > 0))
	{
	?>
	Apply for Deutsche Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-hsbc-bank")) > 0))
	{
	?>
	Apply for HSBC Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-ingvysya-bank")) > 0))
	{
	?>
	Apply for ING VYSYA Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-reliance")) > 0))
	{
	?>
	Apply for Reliance
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-abn-bank")) > 0))
	{
	?>
	Apply for ABN AMRO Bank
	<?
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-stanc-bank")) > 0))
	{
	?>
	Apply for Standard Chartered 
	<?
	}				
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-sbi")) > 0))
	{
	?>
	Apply for SBI Personal Loan
	<? 
	}
	elseif((strlen(strpos($_SERVER['REQUEST_URI'], "loan-against-property")) > 0))
	{
	?>
	Apply for Loan Against Property
	<? 
	}
	  else 
	{?>
	  <div id="frmtpbg"></div>
	  <? 
	}
	?>	</td>
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
	 </select></td>
	 </tr>
  <tr align="left"><td colspan="2"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} elseif(isset($srchme)) { echo $srchme;} else { echo "QuickApply";} ?>" /></td>
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
	 </tr>	 <tr><td colspan="2" style="color:#000000; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:9px; font-weight:normal; text-align:left;" ><br /><input type="checkbox"  name="accept" style="border:none;" checked > I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<br /></td></tr>
	 <tr><td colspan="2" align="center"> <input type="submit" value="" class="qucksbtn" /> </td></tr>
	 </table>
	 </form></td></tr>
	  <tr>
          <td height="13" ><div id="frmbt"></div></td>
      </tr>
  </table>

	</div>
<div style="float:right; text-align:center; width:250px; margin-top:10px; ">

<?php
if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Calculators.php")) > 0))
	{   $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
?>
	
		<div style="clear:both; padding-right:5px;" > 
		<table cellspacing="0" cellpadding="0" border="0">
		<tr>
              <td height="40" colspan="3" align="center" valign="middle"  bgcolor="#FFFFFF" class="steps-text" style="color:#333333;" ><b>Personal Loan Rate of Interest</b><br />
<div align="center">( Last edited on : <? echo $currentdate; ?> )</div></td>
          </tr>
            <tr>
              <td colspan="3" valign="top"  bgcolor="#FFFFFF" class="steps-text" ><table border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
                <tr>
                  <td width="56" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Bank<br>
                      <img src="images/spacer.gif" width="48" height="8" border="0"></td>
                  <td width="64" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Rate <br />
                  of Interest</td>
                  <td width="48" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Processing<br />
                    Fee</td>
                  <td width="50" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
                </tr>
				<? $getplrates="Select cat_a,bank_name,others,bank_url,processing_fee From personal_loan_interest_rate_chart where (flag=1)";
 	list($plrowcount,$plrow)=MainselectfuncNew($getplrates,$array = array());
for($j=0;$j<$plrowcount;$j++)
{
?>
  <tr>
                  <td height="25" align="left" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><a href="<? echo $plrow["bank_url"]; ?>" style="color:#335599;"><? echo $plrow[$j]["bank_name"]; ?></a></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $plrow[$j]["cat_a"]."-".$plrow[$j]["others"]; ?><br /></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $plrow[$j]["processing_fee"]; ?></td>
                  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">
				 
			 <a href="http://www.deal4loans.com/apply-personal-loans.php" target="_blank" style="color:#335599;">APPLY</a>
						 </td>
                </tr>


<? }?>				 </table></td>
            </tr>
            <tr>
              <td height="40" colspan="3" align="center" valign="middle"  bgcolor="#FFFFFF" class="steps-text" style="color: #333333;" ><b>Home Loan Rate of Interest</b><br />
              <div align="center">( Last edited on : <? echo $currentdate; ?> )</div></td>
            </tr>
            <tr>
              <td colspan="3" valign="top"  bgcolor="#FFFFFF" class="steps-text" ><table border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
                <tr>
                  <td width="56" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Bank<br>
<img src="images/spacer.gif" width="48" height="1" border="0"></td>
                  <td width="70" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Rate <br />
                    of Interest</td>
                  <td width="47" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Prepayment<br>
                    charges</td>
                  <td width="56" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:10px;">Apply Here </td>
                </tr>
				<? $gethlrates="Select ndtv_rates,bank_name,bank_url,processing_fee From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (203,3,8,5) and flag=1)";
list($hlrowcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
for($j=0;$j<$hlrowcount;$j++)
	{
	?>
	 <tr>
			  <td height="25" align="center" valign="middle" bgcolor="#FFFFFF" style="font-size:10px;"><a href="<?  echo $hlrow['bank_url'];?>" style="color:#335599;"><? echo $hlrow[$j]["bank_name"]; ?></a></td>
			  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;"><? echo $hlrow[$j]["ndtv_rates"]; ?></td>
			  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">2%</td>
			  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt" style="font-size:10px;">
			
		<a href="http://www.deal4loans.com/home-loan-apply.php" target="_blank" style="color:#335599;">APPLY</a>
						 </td>
                
	<? }?>
              </table></td>
            </tr></table>
          
 
</div>
<?	}
else if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan-deutsche-bank")) > 0))
	{
	?>
    <br />
	<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=85&amp;source=intCampaign&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a23255f9' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=85&amp;source=intCampaign&amp;n=a23255f9' border='0' alt=''></a></noscript>
	<?
	}
	else if((strlen(strpos($_SERVER['REQUEST_URI'], "deutsche-bank-home-loan.php")) > 0))
	{
	?>
    <br />
<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=88&amp;source=intCampaign&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a3fa85b1' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=88&amp;source=intCampaign&amp;n=a3fa85b1' border='0' alt=''></a></noscript>
	<?
	}
	
	
	else
	{
	?>
    
    
<?php 
} 
?>

<div id="tabvanilla" class="widget">

           <ul class="tabnav" style="padding-bottom:5px;">
           <li><a href="#recent">Home Loan</a></li>
           <li><a href="#popular">Personal Loan</a></li>
           </ul>

            <div id="recent" class="tabdiv" >
	<div style="background:url(new-images/rgt-tpimg.jpg); background-repeat:no-repeat; width:250px; height:41px; text-align:center; line-height:35px;"><b>Home Loan Interest Rates </b></div>
			<div style=" background:url(new-images/rgt-bg.gif); background-repeat:repeat-y; width:250px;">

			      <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <? $gethlrates="Select ndtv_rates,bank_name From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (203,5,8,3) and flag=1)";
	list($hlrowcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
for($j=0;$j<$hlrowcount;$j++)
	{
	?>
  <tr>
    <td width="47%" height="22"><? echo $hlrow[$j]["bank_name"]; ?> </td>
     <td width="53%" style="font-size:11px;"><b><? echo $hlrow[$j]["ndtv_rates"]; ?></b></td>
    </tr>
	   <tr>
		  <td height="2" colspan="2" align="center"><img src="/new-images/bt-line.gif" width="209" height="2" alt="" /></td>
		</tr>
	<? }?>
                    <tr>
                      <td valign="bottom" align="left"><a href="Contents_Disclaimer.php" style="font-size:10px; color:#666666;">T and C APPLY*</a></td>
                      <td height="25" align="right" valign="bottom"><a href="home-loans-interest-rates.php">Know more...</a></td>
                    </tr>
                  </table>
			</div>
<div style="background:url(new-images/bg-bt.jpg); background-repeat:no-repeat; width:250px; height:19px;"></div>
            </div><!--/recent-->
			
			<div id="popular" class="tabdiv">
			<div style="background:url(new-images/rgt-tpimg.jpg); background-repeat:no-repeat; width:250px; height:41px; text-align:center; line-height:35px;"><b>Personal Loan Interest Rates </b></div>
			<div style=" background:url(new-images/rgt-bg.gif); background-repeat:repeat-y; width:250px;">
              <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
<? $getplrates="Select cat_a,bank_name,others From personal_loan_interest_rate_chart where (flag=1 and rateid in (2,3,7,12))";
list($plrowcount,$plrow)=MainselectfuncNew($getplrates,$array = array());
for($j=0;$j<$plrowcount;$j++)
{
?>
<tr>
 <td width="56%" height="22"><? echo $plrow[$j]["bank_name"]; ?></td>
<td width="44%"  style="font-size:11px;"><b><? echo $plrow[$j]["cat_a"]."-".$plrow[$j]["others"]; ?></b></td>
</tr>

<? }?>
            
                <tr>
                  <td valign="bottom" align="left"><a href="Contents_Disclaimer.php" style="font-size:10px; color:#666666;">T and C APPLY*</a></td>
                  <td height="25"  align="right" valign="bottom"><a href="personal-loan-interest-rate.php">Know more...</a></td>
                </tr>
              </table>
			</div>
<div style="background:url(new-images/bg-bt.jpg); background-repeat:no-repeat; width:250px; height:19px;"></div>

            </div><!--/popular-->

         </div>
<!--<div align="center">
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=236732309688469&amp;xfbml=1"></script><fb:like href="http://www.facebook.com/deal4loans" send="false" width="100" show_faces="false" font=""></fb:like>
</div> -->
		
		 
</div>

