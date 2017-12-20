<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$retrivesource = "LAP Interest Rate";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loan Against Property Interest Rates <?php echo DATE('F'); ?> 2017 Comparison</title>
<meta name="keywords" content="Loan Against Property Interest rate, Compare Loan Against Property Interest Rate, Loan Against Property rates, Loan Against Property interest rates India, Loan Against Property rates India, comparison Loan Against Property rates, compare Loan Against Property rates, Loan Against Property rate.">
<meta name="description" content="Loan Against Property Interest Rates: Choose Current Lowest interest rate Loan Against Property at Deal4loans.com from from Hdfc, Sbi, Icici, Kotak, PnB etc.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="/css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/loan-against-property-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<?php $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('d F Y',$tomorrow);
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
$atagleft = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0" />';
?>
<div class="lap_inner_wrapper" style="margin:auto;">
<div style="margin-top:70px;" class="common-bread-crumb"><a href="index.php" class="text12" style="color:#0080d6; font-size:14px;">Home</a> <strong style="font-size:14px; font-weight:normal;" class="text12"> » </strong> <span style="color:#4c4c4c; font-size:14px;">Loan Against Property Interest Rate</span></div>
 <h1 class="lap-h1">Loan against property Interest Rates</h1>
   <?php include "loan-against-property-widget.php"; ?>
  <div style="clear:both; height:15px;"></div>
  <table align="center" width="100%">
    <tr>
      <td><strong>Loan Against Property Interest Rates</strong><br />
          <span style="font-size:12px; font-weight:normal; ">(Last updated on<?php echo date('d F Y'); ?>)</span></td>
    </tr>
  </table>
  
   <div class="overflow-width">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1" class="table_bgcolor_Border">
      <tr height="30" class="table_bgcolor">
        <td width="12%" align="center" height="32">Banks</td>
        <td width="19%" align="center">up to 30 lacs</td>
        <td width="19%" align="center">30-75 lacs</td>
        <td width="17%" align="center">75 &amp; above</td>
        <td width="19%" align="center">Processing fees</td>
        <td width="14%" align="center">Apply</td>
      </tr>
      <?php
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0" />';	
$getRatesSql = "select * FROM  `lap_interest_rate` where Status =1 order by Sequence asc";
list($getRatesNumRows,$getRatesQuery)=MainselectfuncNew($getRatesSql,$array = array());

$BankURL = '';
$link1 = '';
$link2 = '';
for($i=0;$i<$getRatesNumRows;$i++)
{
	$BankURL = '';
	$link1 = '';
	$link2 = '';
	$BankName = $getRatesQuery[$i]['BankName'];
	$Upto30 = $getRatesQuery[$i]['Upto30'];
	$Upto75 = $getRatesQuery[$i]['Upto75'];
	$Above75 = $getRatesQuery[$i]['Above75'];
	$ProcessingFee = $getRatesQuery[$i]['ProcessingFee'];
	$BankURL = $getRatesQuery[$i]['BankURL'];
	$BankURL1 = $getRatesQuery[$i]['BankURL1'];
	$ShowButton = $getRatesQuery[$i]['ShowButton'];
if(strlen($BankURL)>0) {
		$link1 = '<a href="'.$BankURL.'" style="font-weight:bold;">'.$BankName.'</a>';
}
else
{
		$link1 = $BankName;
}
		$link2 = '<a href="'.$BankURL1.'" target="_blank">'.$atag.'</a>';

?>
      <tr height="40"  bgcolor="#FFFFFF">
        <td align="center"><strong><?php echo $link1; ?></strong></td>
        <td align="center"><?php echo $Upto30; ?></td>
        <td align="center"><?php echo $Upto75; ?></td>
        <td align="center"><?php echo $Above75; ?></td>
        <td align="center"><?php echo $ProcessingFee; ?></td>
        <td align="center"><?php if(strlen($BankURL1)>10) {  echo $link2;  } ?></td>
      </tr>
      <?php } ?>
    </table>
</div>
<br />
<div class="termtext" style="color:#000"><b>Disclaimer:</b>Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at<a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a>for inclusions or updates.</div>
<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="images/top.gif"/></a></div>
</div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>