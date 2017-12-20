
<html>
<head>
<script src="http://www.deal4loans.com/js/jquery-1.1.3.1.pack.js" type="text/javascript"></script>
<script src="http://www.deal4loans.com/js/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="http://www.deal4loans.com/js/jquery.tabs.pack.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://www.deal4loans.com/style/jquery.tabs.css" type="text/css" media="print, projection, screen">

<script type="text/javascript">
	$(function() {
		$('#container-1').tabs();
	});
</script>

<script type="text/javascript">
window.resizeTo(260,250);
function popup(id){
newwin = window.open(id,'');}
</script>
</head>
<body >
	<div id="container-1">
	<ul>
	<li><a href="#fragment-1"><span>Home Loan</span></a></li>
	<li><a href="#fragment-2"><span>Personal Loan</span></a></li>
	</ul>
	<div id="fragment-1">
	<div style="text-align:center; line-height:35px;  font-family:Verdana; font-size:13px; "><b>Home Loan Interest Rates </b></div>
	<table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
	<!--start here -->
	<tr>
	<td width="53%" height="22" style="font-size:12px; font-family:Verdana; padding-left:5px;"><b>Banks</b> </td>
	<td width="47%" style="font-size:12px; font-family:Verdana; padding-left:5px;"><b>Rates</b></td>
	</tr>
	<? $gethlrates=("Select ndtv_rates,bank_name From home_loan_interest_rate_chart where (tenure=1 and hlrateid in (2,5,7,141))");
	 list($recordcount,$hlrow)=MainselectfuncNew($gethlrates,$array = array());
		$cntr=0;
	while($cntr<count($hlrow))
        {
	?>
	<tr>
	<td width="53%" height="22" style="font-size:12px; font-family:Verdana; padding-left:5px;"><? echo $hlrow["bank_name"]; ?> </td>
	<td width="47%" style="font-size:12px; font-family:Verdana; padding-left:5px;"><b><? echo $hlrow["ndtv_rates"]; ?></b></td>
	</tr>
	<tr>
	<td height="2" colspan="2" align="center"><img src="/new-images/bt-line.gif" width="209" height="2" alt="" /></td>
	</tr>
	<? $cntr = $cntr+1; }?>
	
	
	<!-- end here -->
	
	<tr>
	<td valign="bottom" align="left"><a href="Contents_Disclaimer.php" style="font-size:10px; color:#666666; padding-left:5px; font-family:Verdana;">T and C APPLY*</a></td>
	<td height="25" align="right" valign="bottom" style="font-family:Verdana; font-size:11px; "><a onClick="popup('http://ndtvmoney.deal4loans.com/home-loan-interest-rates.php')" style="cursor:pointer;" >Know more...</a></td>
	</tr>
	</table>
	
	</div><!--/recent-->
	
	<div id="fragment-1">
	<div style="text-align:center; line-height:35px; font-family:Verdana; font-size:13px;"><b>Personal Loan Interest Rates </b></div>
	<table width="250" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
	<td width="53%" height="22" style="font-size:12px; font-family:Verdana; padding-left:5px;"><b>Banks</b> </td>
	<td width="47%" style="font-size:12px; font-family:Verdana; padding-left:5px;"><b>Rates</b></td>
	</tr>
	<!--  start here -->
	<? $getplrates=("Select cat_a,bank_name,others From personal_loan_interest_rate_chart where (flag=1)");
	
	 list($recordcount,$plrow)=MainselectfuncNew($getplrates,$array = array());
		$i=0;
	while($cntr<count($plrow))
        {
	
	?>
	<tr>
	<td height="22" style="font-size:12px; font-family:Verdana; padding-left:5px;"><? echo $plrow["bank_name"]; ?></td>
	<td style="font-size:12px; font-family:Verdana; padding-left:5px;"><b><? echo $plrow["cat_a"]."-".$plrow["others"]; ?></b></td>
	</tr>
	<tr>
	<td height="2" colspan="2" align="center"><img src="/new-images/bt-line.gif" width="209" height="2" alt="" /></td>
	</tr>
	<? $i = $i+1; }?>
	<tr>
	<td valign="bottom" align="left"><a href="Contents_Disclaimer.php" style="font-size:10px; color:#666666; padding-left:5px; font-family:Verdana;">T and C APPLY*</a></td>
	<td height="25"  align="right" valign="bottom" style="font-family:Verdana; font-size:11px; "><a onClick="popup('http://ndtvmoney.deal4loans.com/personal-loan-interest-rates.php')" target="_blank" style="cursor:pointer;">Know more...</a></td>
	</tr>
	</table>
	
	</div><!--/popular-->
	
	</div>
		 </body>
		 </html>