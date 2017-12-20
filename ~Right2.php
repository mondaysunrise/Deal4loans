<script>
function checkbima_healthform(Form)
{
if(Form.fullname.value=="")
	{
		alert("Please fill your name.");
		Form.fullname.focus();
		return false;
	}
 if (Form.city.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		Form.city.focus();
		return false;
	}

  if(Form.mobile.value=="")
	{
		alert("Please fill your mobile no.");
		Form.mobile.focus();
		return false;
	}
	if(isNaN(Form.mobile.value)|| Form.mobile.value.indexOf(" ")!=-1)
	{
		  alert("Enter numeric value");
		  Form.mobile.focus();
		  return false;  
	}
	if (Form.mobile.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			Form.mobile.focus();
			return false;
	}
	if ((Form.mobile.value.charAt(0)!="9") && (Form.mobile.value.charAt(0)!="8"))
	{
			alert("The number should start only with 9 or 8");
			Form.mobile.focus();
			return false;
	}
}
</script>

<?

$absolutepath = "/"; 
 if ((($_REQUEST['flag'])!=1))
	{ ?>
<div id="dvColumn3">
  <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Credit_Card_New")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "apply-credit-card.php")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Loan_Personal")) > 0))
	 {?>
 <div align="center" style="width:250px; clear:both; padding:3px 0px;
"><table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="13" height="47" align="left" valign="top"><img src="/images/step-lft-corn.gif" width="13" height="47" /></td>
                    <td align="center" valign="middle"  background="/images/step-pnl-bg.gif"  style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF;"  >How Does it Work?</td>
                    <td width="13" height="47" align="right" valign="top"><img src="/images/step-rgt-corn.gif" width="13" height="47" /></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td width="76" height="105" align="center" valign="top"  bgcolor="#D98E1A" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;  color:#FFFFFF; padding-top:15px;" ><img src="/images/stp1.gif" width="32" height="31" /><br />
              Post your Credit Card requirement </td>
              <td width="86" align="center" valign="top" bgcolor="#D08108" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;  color:#FFFFFF; padding-top:15px;"  ><img src="/images/stp2.gif" width="31" height="31" /><br />
              Get &amp; Compare offers from all banks </td>
              <td width="78" align="center" valign="top" bgcolor="#BE740A" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;  color:#FFFFFF; padding-top:15px;"  ><img src="/images/stp3.gif" width="31" height="31" /><br />
              Go with the lowest bidder </td>
            </tr>
          </table></div>
		  <div><table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="300" valign="top" background="http://www.bimadeals.com/images/health-insur-ban.gif"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="130">&nbsp;</td>
      </tr>
      <tr>
        <td style="padding-left:8px;">
		<form name="bima_health_form" method="post" action="http://www.bimadeals.com/Right.php" onSubmit="return checkbima_healthform(document.bima_health_form);">
		
		<table width="140" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="71" height="22" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF;">Name</td>
            <td width="101"><input type="hidden" value="deal4loans" name="source" id="source"><input type="hidden" value="Req_Health_Insurance" name="Type_Insurance" id="Type_Insurance"><input type="text" id="fullname" name="fullname" style="width:100px; border:1px solid #CC6600; font-size:11px;" /></td>
          </tr>
          <tr>
            <td height="22" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; ">City</td>
            <td><select name="city"  style="width:100px; border:1px solid #CC6600; font-size:11px; margin:0px; padding:0px;"><?=getCityList($city)?></select>
</td>
          </tr>
          <tr>
            <td height="22" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF;">Mobile </td>
            <td><input type="text"  id="mobile" name="mobile" style="width:100px; border:1px solid #CC6600; font-size:11px;" /></td>
          </tr>
          <tr>
            <td height="40" colspan="2" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF;"><input type="image" src="http://www.bimadeals.com/images/get-btn.gif" width="95" height="32" style="border:0px;" /></td>
            </tr>
        </table>
		</form></td>
      </tr>
    </table></td>
  </tr>
</table></div>
		  <? }
		
		
else
		{?>
		 <?  if((strlen(strpos($_SERVER['REQUEST_URI'], "home-loan-apply-thank")) > 0))
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
	<? }

	 }
	 ?>

		
		  <div><table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="300" valign="top" background="http://www.bimadeals.com/images/health-insur-ban.gif"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="130">&nbsp;</td>
      </tr>
      <tr>
        <td style="padding-left:8px;">
		<form name="bima_health_form" method="post" action="http://www.bimadeals.com/Right.php" onSubmit="return checkbima_healthform(document.bima_health_form);">
		
		<table width="140" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="71" height="22" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF;">Name</td>
            <td width="101"><input type="hidden" value="Req_Health_Insurance" name="Type_Insurance" id="Type_Insurance"><input type="text" id="fullname" name="fullname" style="width:100px; border:1px solid #CC6600; font-size:11px;" /></td>
          </tr>
          <tr>
            <td height="22" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF; ">City</td>
            <td><select name="city"  style="width:100px; border:1px solid #CC6600; font-size:11px; margin:0px; padding:0px;"><?=getCityList($city)?></select>
</td>
          </tr>
          <tr>
            <td height="22" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF;">Mobile </td>
            <td><input type="text"  id="mobile" name="mobile" style="width:100px; border:1px solid #CC6600; font-size:11px;" /></td>
          </tr>
          <tr>
            <td height="40" colspan="2" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF;"><input type="image" src="http://www.bimadeals.com/images/get-btn.gif" width="95" height="32" style="border:0px;" /></td>
            </tr>
        </table>
		</form></td>
      </tr>
    </table></td>
  </tr>
</table></div>

		<? }?>

     
 <? }
 else
 {?><div id="dvColumn3">  
       <div></div>
      <div id="dvRighttxtImage"><!--<img src="/images/Right_heading_txt.gif" width="219" height="31" />--></div>
	<iframe src="http://www.sify.com/finance/loans/dealforloans/content.html" width="250" height="900" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" id='content' name='content'></iframe>
</div>
<?}?>