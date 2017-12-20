<div style="float:right; clear:right; background-image:url(images/gray_bg.gif); width:275px; height:auto; margin-top:18px;">
<div style="width:270px; margin:auto; height:auto; font-size:12px; color:#88a943; margin-top:3px; background-color:#f4f4f4;">
<div style="clear:both; height:5px;"></div>
<div class="text3" style="width:230px; margin:auto; height:auto; font-size:12px; color:#88a943; margin-top:2px;"><strong>Personal Loan Rate of Interest</strong></div>
<div class="text11" style="width:225px; margin:auto; height:auto;  color:#4c4c4c; margin-top:1px; text-align:left;">( Last updated on <?php echo date('d F Y'); ?> )</div>
<div style="clear:both; height:5px;"></div>
<table width="265" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e0eaf1">
    <tr bgcolor="#FFFFFF">
      <td height="22" align="center" valign="middle" class="tbl_txt" width="100"><b>Bank</b> </td>
      <td width="95" align="center" valign="middle" class="tbl_txt" style="width:95px; "><b>Interest Rates</b></td>
      <td align="center" valign="middle" class="tbl_txt" width="70"><b>Apply</b></td>
    </tr>
<?php 
$getplrates=("Select rateid,cat_a,bank_name,others,bank_url,processing_fee From personal_loan_interest_rate_chart where (flag=1) order by bankwise_priority ASC");
list($recordcount,$plrow)=MainselectfuncNew($getplrates,$array = array());

	for($i=0;$i<$recordcount;$i++)
{$maxrate="";
if(strlen($plrow[$i]["others"])>1)
{
$maxrate="-".$plrow[$i]["others"];
}
?>        
<tr bgcolor="#FFFFFF">
<?php if($plrow[$i]["rateid"]==5) 
		  {
	?>
	 <td height="35" align="center" valign="middle" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><a href="<?  echo $plrow[$i]['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><? echo $plrow[$i]["bank_name"]; ?></a></td>
	<? 	  }
		  else
	{ ?>
 <td height="35" align="center" valign="middle" style="font-size:10px;"><a href="<?  echo $plrow[$i]['bank_url'];?>" style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><? echo $plrow[$i]["bank_name"]; ?></a></td>
	<? } ?>
         
          <td align="center" valign="middle"  class="tbl_txt"><? echo $plrow[$i]["cat_a"]."".$maxrate; ?></td>
          <td align="center" valign="middle" class="tbl_txt" style="font-size:10px;">
		    <? if($plrow[$i]["rateid"]==2) 
		  {
		  ?>
		  	<a href="http://www.deal4loans.com/hdfc-personal-loan-new.php" target="_blank"><img src="images/apply1.gif" width="45" height="20" border="0" /></a>  
		  <? }
		   elseif($plrow[$i]["rateid"]==5) 
		  {
		  ?>
		  	
		  <? }
		  else if($plrow[$i]["rateid"]==9) 
		  { ?>
		  	<a href="http://www.deal4loans.com/get-quote-ingvysya.php" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> 
		  <? }
		  	  else if($plrow[$i]["rateid"]==10) 
		  { ?>
		  	<a href="http://www.deal4loans.com/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> 
		  <? }
		   	  else if($plrow[$i]["rateid"]==11) 
		  { ?>
		  	<a href="http://www.deal4loans.com/personal-loan-hdb-financial-services.php" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> 
		  <? }
		  	  
		   else
		  {?>
		  <a href="<?  echo $plrow[$i]['bank_url'];?>" target="_blank"><img src="images/apply1.gif"  width="45" height="20" border="0" /></a> 
		  <? } ?>
          </td>
          <? }?>
          </tr>
      </table>

<div style="clear:both; height:3px;"></div>
</div>
  <div class="text11" style="width:262px; ; height:220px; margin:auto; clear:both; margin-top:10px; background-image:url(images/saying_box3.gif);">
  <div class="text3" style="width:212px; margin:auto; height:auto; font-size:14px; color:#88a943; padding-top:10px; text-align:center;"><strong><u>What Others are saying</u></strong></div>
 <div class="text" style="width:212px; margin:auto; height:auto; font-size:12px; color:#666666; padding-top:8px; text-align:left; ">
  <marquee direction="up" scrollamount="3" height="145" width="235" class="text" style="width:212px; font-size:12px; color:#666666; padding-top:2px; text-align:left; "><? 
  $selecttest=("select Message,Name from Testimonial Where (Is_Verified=1) order by Dated DESC LIMIT 10");
list($recordcount,$testi)=MainselectfuncNew($selecttest,$array = array());
	for($i=0;$i<$recordcount;$i++)
{ ?>
 
<div class="text" style="width:212px; margin:auto; height:auto; font-size:16px; color:#008fc7; padding-top:8px; text-align:left;">
<? echo $testi[$i]['Name']; ?>
</div>
<div class="text" style="width:212px; margin:auto; height:auto; font-size:11px; color:#666666; padding-top:2px; text-align:left; "> 
<?php echo $testi[$i]['Message']; ?>
</div>
<? }
?>
 <a href="/Contents_Feedback.php">Read More </a> </marquee>
 </div> 
</div>

<!-- 
  <div class="text11" style="width:250px; ; height:auto; margin:auto; clear:both; margin-top:15px;" align="center">Advertisement<br />
    <script type="text/javascript">
	-->
    <!--
	google_ad_client = "pub-6880092259094596";
	/* 250x250, created 10/26/09 */
	google_ad_slot = "1962172606";
	google_ad_width = 250;
	google_ad_height = 250;
	//-->
	<!--
    </script>
  	<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
    <br /> <br />
	<? #include "bimabnr_hl250x250.html"; ?>
  -->
  <!--<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
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
<!--</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a23255f9' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=85&amp;source=intCampaign&amp;n=a23255f9' border='0' alt=''></a></noscript>-->
<!--
</div>

</div>
-->