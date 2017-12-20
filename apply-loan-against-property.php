<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();
$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="LAP Site Page";
}
$page_Name = "LoanAgainstProperty";

if ($_SESSION['flag']==1)
{
	$source="partner1";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply and Compare Loans Against Property India</title>
<meta name="description" content="Loan Against Property India, Apply Loan Against Property, Compare Loan Against Property in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore" />
<meta name="keywords" content="Loan Against Property India, Apply Loan Against Property, Compare Loan Against Property in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore" />

<link href="css/loan-against-property-styles.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="lap_inner_wrapper" style="margin:auto;">
  <div style="margin-top:70px;" class="common-bread-crumb"><a href="index.php" class="text12" style="color:#0080d6; font-size:14px;">Home</a> <strong style="font-size:14px; font-weight:normal;" class="text12"> » </strong> <a href="loan-against-property.php" class="text12" style="color:#0080d6; font-size:14px;">Loan Against Property</a> <strong style="font-size:14px; font-weight:normal;" class="text12"> » </strong> <span style="color:#4c4c4c; font-size:14px;"><?php echo GETQUOTEFOR;?> Loan Against Property</span></div>
  
   
  <h1 class="lap-h1"><?php echo GETQUOTEFOR;?> Loan Against Property</h1>
  
  <?php include "loan-against-property-widget.php"; ?>
  <div style="clear:both; height:15px;"></div>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="table_bgcolor_Border">
    <tr class="table_bgcolor">
      <td height="35" align="center" valign="middle"><strong>Banks</strong></td>
      <td height="35" align="center" valign="middle"><strong>up to 30 lacs</strong></td>
      <td height="35" align="center" valign="middle"><strong>30-75 lacs</strong></td>
      <td height="35" align="center" valign="middle"><strong>75 lacs & above</strong></td>
      <td height="35" align="center" valign="middle"><strong>Processing fees</strong></td>
    </tr>
    <?php
$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
$getRatesSql = "select * FROM  `lap_interest_rate` where Status =1 and B_id in (1,2,4,17,7,3,6,5,16) order by Sequence asc";
list($getRatesNumRows,$ArrRow)=MainselectfuncNew($getRatesSql,$array = array());

//$getRatesQuery = ExecQuery($getRatesSql);
//$getRatesNumRows = mysql_num_rows($getRatesQuery);
$BankURL = '';
$link1 = '';
$link2 = '';
$arrcont=count($ArrRow)-1;
$cntr=0;
if($getRatesNumRows>0)
            {
while($cntr<$arrcont)
{


	$BankURL = '';
	$link1 = '';
	$link2 = '';
	$BankName = $ArrRow[$cntr]['BankName'];
	$Upto30 = $ArrRow[$cntr]['Upto30'];
	$Upto75 = $ArrRow[$cntr]['Upto75'];
	$Above75 = $ArrRow[$cntr]['Above75'];
	$ProcessingFee = $ArrRow[$cntr]['ProcessingFee'];

?>
    <tr bgcolor="#FFFFFF">
      <td width="12%" height="33" align="center" valign="middle"><strong><?php echo $BankName; ?><br />
        </strong></td>
      <td width="22%" align="center" valign="middle"><?php echo $Upto30; ?><br /></td>
      <td width="22%" align="center" valign="middle"><?php echo $Upto75; ?></td>
      <td width="22%" align="center" valign="middle"><?php echo $Above75; ?></td>
      <td width="22%" align="center" valign="middle"><?php echo $ProcessingFee; ?></td>
    </tr>
    <?php $cntr=$cntr+1;} } ?>
  </table>
  <div style="clear:both; height:15px;"></div>
</div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>