<?php
ob_start();
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Pay Online - Packages</title>
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">
body {
	margin-left: 0px;	margin-top: 0px;	margin-right: 0px;	margin-bottom: 0px;	background-color: #203f5f;	overflow-x:hidden;	background-color:#FFF;}
.red {	color: #F00;}
</style>
</head>
<body>
<div style="position:absolute; top:0px; left:0px; width:100%; height:30px; background-image:url(images/top_bg.gif); background-position:center top; z-index:1;">
<div style="width:970px; height:auto; margin:auto;">
<div class="text4" style="width:600px; height:auto; float:right; padding-left:460px; margin-top:4px; ">
&nbsp;<?php include "agent_cart_header.php"; ?></div>
</div>
</div>
<div style="margin:auto; width:970px; height:105px; padding-top:28px;">
<div style="float:left; clear:right; width:243px; height:94px;"><a href="http://www.deal4loans.com/index.php"><img src="images/logo.gif" width="243" height="90" border="0" /></a></div>
</div>
</div>
<div style="margin:auto; width:970px; height:3px;  margin-top:1px;"><img src="images/point6.gif" width="970" height="3" /></div>
<div class="intrl_txt">
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr><td width="950">
<table width="936" border="0" cellpadding="4" cellspacing="4" >
<tr>
<td width="780" colspan="3" align="left" class="text3" style="height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;">Packages</td>
</tr>
<tr><td class="text3" style="height:33; margin-top:0px; float:left; clear:right; font-size:18px; text-transform:none; color:#88a943;" align="left">
<?php
//print_r($_REQUEST);
//echo "<br>";
$pack_id = $_REQUEST['Pid'];
$Rid = $_REQUEST['Rid'];
$Aid = $_REQUEST['Aid'];
$message = $_REQUEST['Message'];
if($pack_id=='')
{
	header("Location: agent_packages.php");
	exit();
}
$ResResult = $_REQUEST['ResResult'];
$ResTrackId= $_REQUEST['ResTrackId'];
$ResPaymentId= $_REQUEST['ResPaymentId'];
$ResRef= $_REQUEST['ResRef'];
$ResTranId= $_REQUEST['ResTranId'];
$ResError= $_REQUEST['ResError'];
$ResAmount = $_REQUEST['ResAmount'];

$sqlGetPackages = "select * from product_for_sale where Status=1  and Pid = '".$pack_id."' ";
$queryGetPackages = ExecQuery($sqlGetPackages);
$numRows = mysql_num_rows($queryGetPackages);
$i = 0;
$Product_Name = mysql_result($queryGetPackages,$i,'Product_Name');
$Portal_Name = mysql_result($queryGetPackages,$i,'Portal_Name');
$Package_Name  = mysql_result($queryGetPackages,$i,'Package_Name');
$Leads_Count = mysql_result($queryGetPackages,$i,'Leads_Count');
$Total_Cost = mysql_result($queryGetPackages,$i,'Total_Cost');
$Product_package_Name = $Product_Name." ".$Package_Name;


$prodSql = "select * from package_purchase_details where Rid='".$Rid."'";
$prodQuery = ExecQuery($prodSql);

$MTrackid = mysql_result($prodQuery,0,'MTrackid');
$ResTrackId = mysql_result($prodQuery,0,'ResTrackId');
$ResAmount = mysql_result($prodQuery,0,'ResAmount');

$ResResult = mysql_result($prodQuery,0,'ResResult'); 
$message = mysql_result($prodQuery,0,'message'); 
?>
<table cellpadding="3" cellspacing="3" border="0" width="713" align="left">
<tr><td colspan="2" class="text3" style=" color:#990000; font-size:12px; font-weight:bold; padding-left:3px;" >Your Payment is not done successfully due to <?php echo $message;?>
</td></tr>
<tr><td colspan="2" class="text3" style=" color:#21405F; font-size:12px; font-weight:bold; padding-left:3px;" >
You have selected -  <?php echo $Product_package_Name; ?></td></tr>
<tr><td width="216" class="text" style="  color:#21405F; font-size:13px; ">No of Leads</td>
<td width="476" class="text" style="  color:#21405F; font-size:13px; "><?php echo $Leads_Count; ?> leads</td>
</tr>
<tr><td class="text" style="  color:#21405F; font-size:13px; ">Total Cost</td><td class="text" style="  color:#21405F; font-size:13px; ">Rs. <?php echo $Total_Cost; ?>/-</td></tr>
<tr><td colspan="2" class="text3" style=" color:#88a943; font-size:12px; font-weight:bold; padding-left:3px;" >
</td></tr></table>
</td></tr>
</table></td></tr>
</table>
</div>
</body>
</html>