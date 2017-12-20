<?php

	require 'scripts/db_init.php';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<title>Deal4loans</title>
<script src="js/jquery-1.1.3.1.pack.js" type="text/javascript"></script>
<script src="js/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="js/jquery.tabs.pack.js" type="text/javascript"></script>

	<script type="text/javascript">
	$(function() {
		$('#container-1').tabs();
	});
	</script>
<link rel="stylesheet" href="style/jquery.tabs.css" type="text/css" media="print, projection, screen">
<!-- Additional IE/Win specific style sheet (Conditional Comments) -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="style/jquery.tabs-ie.css" type="text/css" media="projection, screen">
<![endif]-->
</head>
<body>
<div id="container-1">
	<ul>
		<li><a href="#fragment-1"><span>Home Loan</span></a></li>
		<li><a href="#fragment-2"><span>Personal Loan</span></a></li>
	</ul>
	
	
  <div id="fragment-1">
	  <div style="line-height:25px; background-color:#f7f7f7; text-align:center; font-family:Verdana; font-size:13px; "><b>Home Loan Interest Rates </b></div>
	  <table width="98%" border="0" cellpadding="0" cellspacing="0">
   <!--start here -->
   <tr>
    <td width="53%" height="22" class="ver11"><b>Banks</b> </td>
    <td width="47%" class="ver11"  ><b>Rates</b></td>
    </tr>
<? $gethlrates=("Select ndtv_rates,bank_name From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (2,5,7,141))");
	 list($recordcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
		$cntr=0;
	
	
	while($cntr<count($hlrow))
        {
        
	?>
  <tr>
    <td width="53%" height="22" class="ver11" style="border-bottom:1px solid #e9e9e9;"  ><? echo $hlrow[$cntr]["bank_name"]; ?> </td>
    <td width="47%" class="ver11" style="border-bottom:1px solid #e9e9e9;" ><b><? echo $hlrow[$cntr]["ndtv_rates"]; ?></b></td>
    </tr>
	 
		<?  $cntr=$cntr+1; }?>
  <!-- end here -->
</table>
  </div>
  <div id="fragment-2">
	  <div style="line-height:25px; background-color:#f7f7f7; text-align:center; font-family:Verdana; font-size:13px; "><b>Personal Loan Interest Rates </b></div>
	  <table width="98%" border="0" cellpadding="0" cellspacing="0">
	   <tr>
    <td width="53%" height="22" class="ver11" ><b>Banks</b> </td>
    <td width="47%" class="ver11" ><b>Rates</b></td>
    </tr>
<? $getplrates=("Select cat_a,bank_name,others From personal_loan_interest_rate_chart where (flag=1)");
	 list($recordcount,$plrow)=MainselectfuncNew($getplrates,$array = array());
		$cntr1=0;

	while($cntr1<count($plrow))
        {
	?>
  <tr>
    <td height="22" class="ver11"  style="border-bottom:1px solid #e9e9e9;"><? echo $plrow[$cntr1]["bank_name"]; ?></td>
    <td class="ver11"  style="border-bottom:1px solid #e9e9e9;"><b><? echo $plrow[$cntr1]["cat_a"]."-".$plrow[$cntr1]["others"]; ?></b></td>
    </tr>
	 
	<? $cntr1=$cntr1+1;}?>
</table>
  </div>
</div>
</body>
</html>