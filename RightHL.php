<div style="float:right; clear:right; background-color:#dde4e9; width:275px; margin-top:18px;">
<div style="width:270px; margin:auto; height:auto; font-size:12px; color:#88a943; margin-top:2px; background-color:#f4f4f4;">
<div style="clear:both; height:5px;"></div>
<div class="text3" style="width:230px; margin:auto; height:auto; font-size:14px; color:#88a943; margin-top:2px;"><strong>Home Loan Rate of Interest</strong></div>
<div class="text11" style="width:230px; margin:auto; height:auto;  color:#4c4c4c; margin-top:px; text-align:left;">( Last updated on <?php echo date('d F Y') ?> )</div>
<div style="clear:both; height:3px;"></div>
<table width="265" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e0eaf1">
        <tr bgcolor="#FFFFFF">
          <td height="22" align="center" valign="middle" class="tbl_txt" width="100"><b>Bank</b> </td>
          <td width="95" align="center" valign="middle" class="tbl_txt"><b>Interest
      Rates</b></td>
          <td align="center" valign="middle" class="tbl_txt" width="70"><b>Apply</b></td>
        </tr>
        <? $gethlrates=("Select ndtv_rates,bank_name,bank_url,processing_fee From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (5,2,190,11,203,115,3,8,190,180,141) and flag=1)  order by  priority ASC");
	 list($recordcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
		$cntr=0;
	
	
	while($cntr<count($hlrow))
        {
	?>
        <tr bgcolor="#FFFFFF">
          <td height="35" align="center" valign="middle" style="font-size:10px;">
          	 <?php 
//	|| (strlen(strpos($hlrow["bank_name"], "State Bank")) > 0)
	if((strlen(strpos($hlrow[$cntr]["bank_name"], "India Bulls")) > 0) || (strlen(strpos($hlrow[$cntr]["bank_name"], "Union Bank of India")) > 0) || (strlen(strpos($hlrow[$cntr]["bank_name"], "Bank of Baroda")) > 0))
	{
		?>
    <span style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt">
    <?php echo $hlrow[$cntr]["bank_name"]; ?> </span>
    
    <?php
	
}
	else
	{
	?>
          <?  #echo $hlrow[$cntr]['bank_url'];?><span style="color:#335599;line-height:13px; text-decoration:none;" class="tbl_txt"><? echo $hlrow[$cntr]["bank_name"]; ?></span>
          <?php } ?>
          </td>
          <td align="center" valign="middle"  class="tbl_txt" style="font-size:10px;"><? echo $hlrow[$cntr]["ndtv_rates"]; ?></td>
 
          <td align="center" valign="middle" class="tbl_txt" style="font-size:10px;">
          				 <?php 
	
	if((strlen(strpos($hlrow[$cntr]["bank_name"], "India Bulls")) > 0) || (strlen(strpos($hlrow[$cntr]["bank_name"], "Union Bank of India")) > 0) || (strlen(strpos($hlrow[$cntr]["bank_name"], "Bank of Baroda")) > 0))
	{
	
}
	else
	{
	?>

          <a href="<?  echo $hlrow[$cntr]['bank_url'];?>" target="_blank"><img src="images/apply1.gif" width="45" height="20" border="0" /></a> 
          <?php } ?>
          </td>
          <? $cntr = $cntr +1; }?>
          
      </table>
<div style="clear:both; height:2px;"></div>
</div>
 <div class="text11" style="width:250px; ; height:auto; margin:auto; clear:both; padding-top:10px;">
 <a href="/home-loan-balance-transfer-calculator.php" target="_blank"><img src="http://www.deal4loans.com/new-images/hl_bltrnfr.jpg"width="250" height="167" border="0" /></a></div>
 <div class="text11" style="width:262px; ; height:220px; margin:auto; clear:both; margin-top:10px; background-image:url(images/saying_box3.gif);">
 
<div class="text3" style="width:212px; margin:auto; height:auto; font-size:14px; color:#88a943; padding-top:10px;"><strong>What Others are saying</strong></div> 
<div class="text" style="width:212px; margin:auto; height:auto; font-size:12px; color:#666666; padding-top:8px; text-align:left; ">
<marquee direction="up" scrollamount="3" height="145" width="235" class="text" style="width:212px; font-size:12px; color:#666666; padding-top:2px; text-align:left; "><? $selecttest=("select Message,Name from Testimonial Where (Is_Verified=1) order by Dated DESC LIMIT 10");
  list($recordRowscount,$testi)=MainselectfuncNew($selecttest,$array = array());
		$k=0;
 
while($k<count($testi))
        { ?>
	<div class="text" style="width:212px; margin:auto; height:auto; font-size:16px; color:#008fc7; padding-top:8px; text-align:left;">
	<? echo $testi[$k]['Name']; ?>
	</div>
	<div class="text" style="width:212px; margin:auto; height:auto; font-size:11px; color:#666666; padding-top:2px; text-align:left; "><?php echo $testi[$k]['Message']; ?>
	</div>
<? $k = $k +1;} ?>
<a href="/Contents_Feedback.php">Read More </a> 
</marquee>
 </div></div>
 <div class="text11" style="width:250px; ; height:auto; margin:auto; clear:both; margin-top:10px;"><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 250x250, created 10/26/09 */
google_ad_slot = "1962172606";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
<br /> 
<div align="center">
<!--<a href="http://financial.indiabulls.com/campaign/index.php?source=deal4loans" target="_blank"><img src="images/indiabulls_hl160x600.jpg" width="160" height="600" border="0"/></a>-->
	<?php #include "bimabnr_hl160x600.html"; ?>
	</div>
</div>