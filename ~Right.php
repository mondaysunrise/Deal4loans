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
        if ((document.loan_form.mobile.value.charAt(0)!="9") && (document.loan_form.mobile.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
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
 <div id="dvColumn3"> 
  <!--<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">--> 
 	<form name="loan_form" method="post" action="/Right.php" onSubmit="return chkform();">
	 
	 <table width="95%" border="0" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF" class="blueborder" >
	
	 <tr bgcolor="#529BE4">
	 <td colspan="2" class="quick" align="center"><font style="font-size:13px;font-weight:bold;color:white">Apply Here</font></td>
	 </tr><tr><td>
	 <table border="0" height="100" width="98%" cellpadding="2" cellspacing="0">
	 
	 
	 <td class="quick" width="40%">Product Type</td>
	 <td width="70%">
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
 <tr><td colspan="2" align="center"  width="4"><input type="hidden" name="source" value="<? if(isset($_REQUEST['source'])) { echo $_REQUEST['source'];} else { echo "QuickApply";} ?>"></td>

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
	 <td ><select name="city" style="width:138px;">
     <?=getCityList($City)?>
	 </select></td>
	 </tr>
	  <tr>
	 <td class="quick">Net Salary (Yearly)</td>
	 <td ><input type="text" name="net_salary"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
	 </tr>

	 <tr><td colspan="2"></td></tr>
	 <tr><td colspan="2" align="center"> <input type="submit" class="bluebutton" value="Get Quote" >
           </td></tr>
	 </table></td></tr></table></form>
 </div>
      
	 <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Personal_Loan_Mustread")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Home_Loan_Mustread")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Car_Loan_Mustread")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Mustread")) > 0) )
	 
	 {?>
	 
	 
<div align="center"><span style="font-size:11px; color:#333333; width:240px; float:left;">Advertisement</span>
		
		<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
  
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=80&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=aa2da033' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=80&amp;n=aa2da033' border='0' alt=''></a></noscript>
		
		</div>
</div>

	  <? }?>
	  <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Loan_Against_Property_Mustread")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Business_Loan_Mustread")) > 0))
	 
	 {?>
	 
	 <div ><img src="/images/spacer.gif" height="5"></div>
	<!--	<div >
<script language='JavaScript' type='text/javascript' src='http://ads.bimadeals.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.bimadeals.com/adjs.php?n=" + phpAds_random);


   document.write ("&amp;clientid=15&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!--
</script><noscript><a href='http://ads.bimadeals.com/adclick.php?n=ae3083dc' target='_blank'><img src='http://ads.bimadeals.com/adview.php?clientid=15&amp;n=ae3083dc' border='0' alt=''></a></noscript>

     </div>-->
	  <? }?>


	  <div>
	<p><img src="/images/spacer.gif"></p>

	<?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Credit_Card_New")) > 0))
	 {?>
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
                Post your Credit Card requirement </td>
              <td width="86" valign="top" bgcolor="#D08108" class="steps-text" style="padding-top:15px;"  ><img src="/images/stp2.gif" width="31" height="31" /><br />
                Get &amp; Compare  offers from all banks </td>
              <td width="78" valign="top" bgcolor="#BE740A" class="steps-text" style="padding-top:15px;"  ><img src="/images/stp3.gif" width="31" height="31" /><br />
                Go with the lowest bidder </td>
            </tr>
          </table>
		</div>
		<? 
	 }
else
		{?>
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
		<? }?>
		<p><img src="/images/spacer.gif"></p>
            <p>   
			<?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Articles")) > 0) )
	 {?>
	<div>
	<script type="text/javascript" src="http://cdn.widgetserver.com/syndication/subscriber/InsertWidget.js"></script><script>if (WIDGETBOX) WIDGETBOX.renderWidget('0905d6f0-82d2-4a6e-bbc3-f30ae6b08d5f');</script><noscript>Get the <a href="http://www.widgetbox.com/widget/latest-articles-deal4loans">Latest Articles| Deal4Loans</a> widget and many other <a href="http://www.widgetbox.com/">great free widgets</a> at <a href="http://www.widgetbox.com">Widgetbox</a>!</noscript>

	<!--<script type="text/javascript" src="http://cdn.widgetserver.com/syndication/subscriber/InsertWidget.js"></script><script>if (WIDGETBOX) WIDGETBOX.renderWidget('ac9f16f1-b8d0-4d44-9aab-3d81f90d38b7');</script><noscript>Get the <a href="http://www.widgetbox.com/widget/latest-articles-deal4loans">Latest Articles| Deal4Loans</a> widget and many other <a href="http://www.widgetbox.com/">great free widgets</a> at <a href="http://www.widgetbox.com">Widgetbox</a>!</noscript>-->
	</div>
	 </p>

	 <? }?>
    
	   <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Personal_Loan")) > 0) )
	 {?>
	 
	<!-- <div id="dvRighttxtImage"><img src="/images/Right_heading_txt.gif" width="219" height="31"  alt="Deal4Loans" /></div>
     <p class="graytxt">Compare and choose from a range of Personal Loan products! <br />
         
          <a href="Contents_Blogs.php">Start Blogging</a><br ><br>
		<a href="Interest-Rate-Personal-Loans.php"  style="Font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Best Interest Rates of Personal Loan</a>
        </p>
		<div align="center"><script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=71&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!--
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a8897bcd' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=71&amp;n=a8897bcd' border='0' alt=''></a></noscript>
</div>
		<div>
		



		<!--<div id="dvRightBanner150"><script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
  
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=33&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!--</script><noscript><a href="http://ads.deal4loans.com/adclick.php?n=a75d02ce" target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=33&amp;n=a75d02ce' border='0' alt=''></a></noscript>-->


		<? }?>
	 <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Home_Loan")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Loan_Home")) > 0))
	 {?>
	
	 <div id="dvRighttxtImage"></div>
     <p class="graytxt"> Compare and choose from a range of Home Loan products! <br />
         
          <a href="Contents_Blogs.php">Start Blogging</a><br />
        <br>
		<a href="Interest-Rate-Home-Loans.php"  style="Font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:left;">Best Interest Rates of Home Loan</a>
		  <br /><br />
		<a href="home-loan-calculator.php"  style="Font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; text-align:left;">Home Loan Eligibility Calculator</a> 
		  </p>
		<!--  <div align="center"><span style="font-size:11px; color:#333333; width:240px; float:left;">Advertisement</span>
		  <script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=71&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!--
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a8897bcd' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=71&amp;n=a8897bcd' border='0' alt=''></a></noscript>

</div>-->
		  <!--<div ><font style="Font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#898989;">Advertisement</font></div>
		  <script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=49&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!--</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a8976288' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=49&amp;n=a8976288' border='0' alt=''></a></noscript>-->

		  <!-- <div><font style="Font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#898989;">Advertisement</font></div> -->
		<!--  <script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'> -->
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=60&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!-- </script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=ac0deba4' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=60&amp;n=ac0deba4' border='0' alt=''></a></noscript>
 -->

		<? }?>
		 <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_home_loan")) > 0)|| (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_types")) > 0))
	 {?>
	
	 <div id="dvRighttxtImage"><img src="/images/Right_heading_txt.gif" width="219" height="31"  alt="Deal4Loans" /></div>
	  <p class="graytxt">Compare and choose from a range of Home Loan products! <br />
         
          <a href="Contents_Blogs.php">Start Blogging</a><br /></p><p>&nbsp;</p>
     <p class="graytxt"><font face="Verdana" size="1" color="0F74D4">&#8226;</font> <a href="Contents_home_loan_enhance.php"><font  style="font-size:11px;font-family:abantgarde;Text-Decoration:none;">How to enhance Your home loan eligibility</font></a><br/>
       <font face="Verdana" size="1" color="0F74D4">&#8226;</font> <a href="Contents_home_loan_journey.php"><font  style="font-family:arial;font-size:11px;Text-Decoration:none;">Journey towards home loan</font></a><br/>
     <font face="Verdana" size="1" color="0F74D4">&#8226;</font> <a href="Contents_types_of_home_loan.php"><font  style="font-family:arial;font-size:11px;Text-Decoration:none;">Types of home loan</font></a><br/>
	 
        <font face="Verdana" size="1" color="0F74D4">&#8226;</font> <a href="Contents_home_loan_fixed_floating_rate_of_interest.php" style="font-family:arial;font-size:11px;Text-Decoration:none;">Floating Vs. Fixed Rate of Interest</a>         <br ><br>
          <a href="Interest_Rate_Hl.php" style="Font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Best Interest Rates of Home Loan</a> <br /><br />
		  
		      
          
        </p>
		<div id="dvRightBanner150"><img src="/images/spacer.gif" height="288" width="150"></div>
		<? }?>
		<? if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Car_Loan")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Loan_Car")) > 0))
	 { ?>

	 <div id="dvRighttxtImage"><img src="/images/Right_heading_txt.gif" width="219" height="31"  alt="Deal4Loans" /></div>
	 <p class="graytxt">Compare and choose from a range of Car Loan products! <br />
         
          <a href="Contents_Blogs.php">Start Blogging</a><br />
        </p>
		<div ><!--<font style="Font-size:11px; font-family:Arial, Helvetica, sans-serif; color:#898989;">Advertisement</font>
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
<!--</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a735de0c' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=59&amp;n=a735de0c' border='0' alt=''></a></noscript>-->
</div>
		
		<? } ?>
		<? if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Loan_Against_Property")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Loan_Against_Property")) > 0))
	 { ?>

	 <div id="dvRighttxtImage"><img src="/images/Right_heading_txt.gif" width="219" height="31"  alt="Deal4Loans" /></div>
	 <p class="graytxt">Compare and choose from a range of Loan  Against Property products! <br />
         
          <a href="Contents_Blogs.php">Start Blogging</a><br />
        </p>
		
		<? } ?>
		
		
		
		
		<? if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Credit_Card")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "credit-card-offers")) > 0))

	 { ?>
	 <div id="dvRighttxtImage"><img src="/images/Right_heading_txt.gif" width="219" height="31"  alt="Deal4Loans" /></div>
	 
	 <p class="graytxt">Compare and choose from a range of Credit Card products! <br />
         
          <a href="Contents_Blogs.php">Start Blogging</a><br ><br>
		<font style="Font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;"><a href="credit-card-offers.php">Latest Offers on Credit Cards.</a></font>
       </p>
	  
	  
		<? } ?>

<? if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Faqs")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Eligibility")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card_Mustread")) > 0))

	 { ?>
	
	 <!--  <div align="center"><span style=" float:left; width:220px; font-size:11px; color:#333333;">Advertisement</span>
	   <script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=71&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
<!--
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a8897bcd' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=71&amp;n=a8897bcd' border='0' alt=''></a></noscript>

	   
	   </div>-->
	  
	  
		<? } ?>
		
	<? if((strlen(strpos($_SERVER['REQUEST_URI'], "rate-your-banks")) > 0))

	 { ?><div align="center"><img src="/images/bank-rate-ban.gif" /></div>
	 
	   <? }?> 
	   		 
	   
		<? if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Life_Insurance")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "insurance_form")) > 0))



	 { ?><img src="/images/banner2.gif" alt="Deal4Loans" />
	 
  	  
	 <div id="dvRighttxtImage"><img src="/images/Right_heading_txt.gif" width="219" height="31"  alt="Deal4Loans" /></div>




	 <p class="graytxt">Compare and choose from a range of Life Insurance products! <br />
          
          <a href="Contents_Blogs.php">Start Blogging</a><br />
        </p>
		<div id="dvRightBanner150"><img src="/images/spacer.gif" height="288" width="150"></div>
		<? } ?>
		
	
		
     <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "viewnewsletter")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "newsletter-archives-main")) > 0))
	 {
			  $newsqry="select * from Newsletter where 1=1 order by News_Dated Desc ";
			 //echo "ffff".$newsqry;
			 list($recordcount,$getrow)=MainselectfuncNew($newsqry,$array = array());
		     $cntr=0;
			 
			  ?>
			  <Div align="center"><font style="Font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;" >Newsletter Menu</font></div><table>
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
<!-- 		<div id="dvRightBanner150"><img src="/images/spacer.gif" height="288" width="150"></div>
 -->
	 <? } ?>
	   <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Business_Loan")) > 0) )
	 {?>

	 <div id="dvRighttxtImage"><img src="/images/Right_heading_txt.gif" width="219" height="31"  alt="Deal4Loans" /></div>
     <p class="graytxt">Compare and choose from a range of Business Loan products! <br />
         
          <a href="Contents_Blogs.php">Start Blogging</a><br ><br>
		
        </p>
		
	  <? }?>
	  
	    

	  
	  
      </div>
    
 </div>
 </div>
 <? }
 else
 {?><div id="dvColumn3">  
       <div></div>
      <div id="dvRighttxtImage"><!--<img src="/images/Right_heading_txt.gif" width="219" height="31" />--></div>
	<iframe src="http://www.sify.com/finance/loans/dealforloans/content.html" width="250" height="900" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" id='content' name='content'></iframe>
</div>
<? }?>