<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';
header("Location: agentregistration.php");
exit();
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
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}

</style>
</head>
<body>
<div style="position:absolute; top:0px; left:0px; width:100%; height:30px; background-image:url(images/top_bg.gif); background-position:center top; z-index:1;">

<div style="width:970px; height:auto; margin:auto;">

<div class="text4" style="width:600px; height:auto; float:right; padding-left:460px;  margin-top:4px;">
&nbsp;<?php include "agent_cart_header.php"; ?></div>
</div>
</div>
<div style="margin:auto; width:970px; height:105px; padding-top:28px;">
<div style="float:left; clear:right; width:243px; height:94px;"><a href="http://www.deal4loans.com/index.php"><img src="images/logo.gif" width="243" height="90" border="0" /></a></div>
<div style="float:right; clear:right;  width:240px; height:37px; ">

</div>
</div>
</div>
<div style="margin:auto; width:970px; height:3px;  margin-top:1px;"><img src="images/point6.gif" width="970" height="3" /></div>
<div class="intrl_txt">

<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr><td width="950">
<form action="agent_purchase_package_li.php" method="post" name="payOnline">
<table cellpadding="4" cellspacing="4" border="0" >
<tr>
<td align="left" class="text3" style="height:33; width: margin-top:0px; float:left; clear:right; font-size:24px; text-transform:none; color:#88a943;" colspan="3">Life Insurance Packages</td>
</tr>
<tr>
<?php 
$sqlGetPackages = "select * from product_for_sale where Status=1 and Product_Name='Life Insurance' ORDER BY Pid ASC ";
$queryGetPackages = ExecQuery($sqlGetPackages);
//echo "<br>";
$numRows = mysql_num_rows($queryGetPackages);
for($i=0;$i<$numRows;$i++)
{
	$divedend = $i%3;
	$pack_id = mysql_result($queryGetPackages,$i,'Pid'); 
	$Product_Name = mysql_result($queryGetPackages,$i,'Product_Name');
	$Portal_Name = mysql_result($queryGetPackages,$i,'Portal_Name');
	$Package_Name  = mysql_result($queryGetPackages,$i,'Package_Name');
	$Leads_Count = mysql_result($queryGetPackages,$i,'Leads_Count');
	$Total_Cost = mysql_result($queryGetPackages,$i,'Total_Cost');
	$Package_Name_Display = mysql_result($queryGetPackages,$i,'Package_Name_Display');
	
?>
  <td>
    <table width="300" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td height="10" align="left" valign="top"><img src="images/bgtop.jpg" width="305" height="10" /></td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#21405F">
		<table cellpadding="3" cellspacing="3" border="0" width="100%">
		<tr><td colspan="2" class="text3" style=" color:#FFF; font-size:12px; font-weight:bold; text-align:center; padding-left:3px;" align="center"><?php echo $Package_Name_Display; ?> </td></tr>
        <tr><td class="text" style="  color:#FFF; font-size:13px; ">No of  Leads</td><td class="text" style="  color:#FFF; font-size:13px; "><?php echo $Leads_Count; ?> leads</td></tr>
        <tr><td class="text" style="  color:#FFF; font-size:13px; ">Total Cost</td><td class="text" style="  color:#FFF; font-size:13px; ">Rs. <?php echo $Total_Cost; ?>/-</td></tr>
        <tr><td class="text" style="  color:#FFF; font-size:13px; ">&nbsp;</td><td class="text" style="  color:#FFF; font-size:13px; "><input type="hidden" name="pack_id_<?php echo $i; ?>" id="pack_id_<?php echo $i; ?>" value="<?php echo $pack_id; ?>" /><input name="submit" type="submit" style="border: 0px none ; background-image: url(images/pay-online.jpg); background-repeat:no-repeat; width: 95px; height: 40px; margin-bottom: 2px; font-size:1px;" value="<?php echo $i; ?>"/>
        
  </td></tr>

		</table>
    </td>
    </tr>
    <tr>
    <td height="15" align="left" valign="top"><img src="images/bgbottom.jpg" width="305" height="10" /></td>
    </tr>
    </table>
    
    </td>
    <?php
if($divedend==2 && $i!=0)
{
?>
</tr><tr>
<?php
}
?>  
<?php
}
?>
</tr></table></form>
</td></tr><tr><td width="950" style="background-color:#CCCCCC;">
<form action="agent_purchase_package_hi.php" method="post" name="payOnline">
<table cellpadding="4" cellspacing="4" border="0" >
<tr>
<td align="left" class="text3" style="height:33; margin-top:0px; float:left; clear:right; font-size:24px; text-transform:none; color:#88a943;" colspan="3">Health Insurance Packages</td>
</tr>
<tr>
<?php 
$sqlGetPackages_hl = "select * from product_for_sale where Status=1 and Product_Name='Health Insurance' ORDER BY priority ASC ";
$queryGetPackages_hl = ExecQuery($sqlGetPackages_hl);
//echo "<br>";
$numRows_hl = mysql_num_rows($queryGetPackages_hl);
for($hl=0;$hl<$numRows_hl;$hl++)
{
	$divedend = $hl%3;
	$pack_id = mysql_result($queryGetPackages_hl,$hl,'Pid'); 
	$Product_Name = mysql_result($queryGetPackages_hl,$hl,'Product_Name');
	$Portal_Name = mysql_result($queryGetPackages_hl,$hl,'Portal_Name');
	$Package_Name  = mysql_result($queryGetPackages_hl,$hl,'Package_Name');
	$Leads_Count = mysql_result($queryGetPackages_hl,$hl,'Leads_Count');
	$Total_Cost = mysql_result($queryGetPackages_hl,$hl,'Total_Cost');
	$Package_Name_Display = mysql_result($queryGetPackages_hl,$hl,'Package_Name_Display');
	$Product_package_Name = $Product_Name." ".$Package_Name;
?>
  <td>
    <table width="300" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td height="10" align="left" valign="top"><img src="images/bgtop.jpg" width="305" height="10" /></td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#21405F">
		<table cellpadding="3" cellspacing="3" border="0" width="100%">
		<tr><td colspan="2" class="text3" style=" color:#FFF; font-size:12px; font-weight:bold; text-align:center; padding-left:3px;" align="center"><?php echo $Package_Name_Display; ?> </td></tr>
        <tr><td class="text" style="  color:#FFF; font-size:13px; ">No of  Leads</td><td class="text" style="  color:#FFF; font-size:13px; "><?php echo $Leads_Count; ?> leads</td></tr>
        <tr><td class="text" style="  color:#FFF; font-size:13px; ">Total Cost</td><td class="text" style="  color:#FFF; font-size:13px; ">Rs. <?php echo $Total_Cost; ?>/-</td></tr>
        <tr><td class="text" style="  color:#FFF; font-size:13px; ">&nbsp;</td><td class="text" style="  color:#FFF; font-size:13px; "><input type="hidden" name="pack_id_<?php echo $hl; ?>" id="pack_id_<?php echo $hl; ?>" value="<?php echo $pack_id; ?>" /><input name="submit" type="submit" style="border: 0px none ; background-image: url(images/pay-online.jpg); background-repeat:no-repeat; width: 95px; height: 40px; margin-bottom: 2px; font-size:1px;" value="<?php echo $hl; ?>"/>
        
  </td></tr>

		</table>
    </td>
    </tr>
    <tr>
    <td height="15" align="left" valign="top"><img src="images/bgbottom.jpg" width="305" height="10" /></td>
    </tr>
    </table>
    
    </td>
    <?php
if($divedend==2 && $hl!=0)
{
?>
</tr><tr>
<?php
}
?>  
<?php
}
?>



</table></form></td></tr>

</table>

</div>
</body>
</html>