<?php
require 'scripts/db_init.php';
?>
<script src="http://www.deal4loans.com/js/jquery-1-1-3-1-pack.js" type="text/javascript"></script>
<script src="http://www.deal4loans.com/js/jquery-history-remote-pack.js" type="text/javascript"></script>
<script src="http://www.deal4loans.com/js/jquery-tabs-pack.js" type="text/javascript"></script>

	<script type="text/javascript">

	//window.resizeTo(260,250);

	$(function() {
		$('#rates-rates').tabs();
	});
	</script>
<link rel="stylesheet" href="http://www.deal4loans.com/style/jquery.tabs.css" type="text/css" media="print, projection, screen">
<!-- Additional IE/Win specific style sheet (Conditional Comments) -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="style/jquery.tabs-ie.css" type="text/css" media="projection, screen">
<![endif]-->

<div id="rates-rates">
	<ul>
		<li><a href="#home"><span>Home Loan</span></a></li>
		<li><a href="#personal"><span>Personal Loan</span></a></li>
	</ul>
	
	
  <div id="home">
	  <div style="line-height:25px; background-color:#f7f7f7; text-align:center; font-family:Verdana; font-size:13px; "><b>Home Loan Interest Rates </b></div>
	  <table width="98%" border="0" cellpadding="0" cellspacing="0">
   <!--start here -->
   <tr>
    <td width="53%" height="22" class="ver11"><b>Banks</b> </td>
    <td width="47%" class="ver11"  ><b>Rates</b></td>
    </tr>
<? $gethlrates="Select ndtv_rates,bank_name From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (2,5,8,141) and flag=1)";
	
	list($recordcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
for($i=0;$i<$recordcount;$i++)
	{
	?>
  <tr>
    <td width="53%" height="22" class="ver11" style="border-bottom:1px solid #e9e9e9;"  ><? echo $hlrow[$i]["bank_name"]; ?> </td>
    <td width="47%" class="ver11" style="border-bottom:1px solid #e9e9e9;" ><b><? echo $hlrow[$i]["ndtv_rates"]; ?></b></td>
    </tr>
	 
		<? }?>
  <!-- end here -->
  <tr><td colspan="2" align="right"><a href="http://ndtvmoney.deal4loans.com/home-loan-interest-rate.php" target="_parent" style="text-decoration:none; color:#0033CC; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;" >More &raquo;</a>&nbsp;&nbsp;&nbsp; </td></tr> 
</table>
  </div>
  <div id="personal">
	  <div style="line-height:25px; background-color:#f7f7f7; text-align:center; font-family:Verdana; font-size:13px; "><b>Personal Loan Interest Rates </b></div>
	  <table width="98%" border="0" cellpadding="0" cellspacing="0">
	   <tr>
    <td width="53%" height="22" class="ver11" ><b>Banks</b> </td>
    <td width="47%" class="ver11" ><b>Rates</b></td>
    </tr>
<? $getplrates=("Select cat_a,bank_name,others From personal_loan_interest_rate_chart where (flag=1 and rateid in (1,2,3,4))");
	
		list($recordcount,$plrow)=MainselectfuncNew($getplrates,$array = array());
for($i=0;$i<$recordcount;$i++)
	{
	?>
  <tr>
    <td height="22" class="ver11"  style="border-bottom:1px solid #e9e9e9;"><? echo $plrow[$i]["bank_name"]; ?></td>
    <td class="ver11"  style="border-bottom:1px solid #e9e9e9;"><b><? echo $plrow[$i]["cat_a"]."-".$plrow[$i]["others"]; ?></b></td>
    </tr>
	 
	<? }?>
	 <tr><td colspan="2" align="right"><a href="http://ndtvmoney.deal4loans.com/personal-loan-interest-rate.php" target="_parent" style="text-decoration:none; color:#0033CC; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">More &raquo;</a>&nbsp;&nbsp;&nbsp; </td></tr> 
</table>
  </div>
</div>