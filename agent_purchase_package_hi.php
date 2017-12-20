<?php
	require 'scripts/functionshttps.php';
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
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
#el08 {font-size:2em} /* Bigger text */
</style>
	<!--<script type="text/javascript" src="moo1.2.js"></script> -->
	<script type="text/javascript">
/*	window.addEvent('domready',function() {
		var subber = $('submit');
		subber.addEvent('click',function() {
			subber.set('value','Submitting...').disabled = true;
			(function() { subber.disabled = false; subber.set('value','Resubmit'); }).delay(30000); // how much time?  10 seconds
		});
	});*/
	</script>
    <script type="text/javascript" src="jsj/jquery.min.js"></script>
</head>
<body>
<div style="position:absolute; top:0px; left:0px; width:100%; height:30px; background-image:url(images/top_bg.gif); background-position:center top; z-index:1;">
<div style="width:970px; height:auto; margin:auto;">
<div class="text4" style="width:600px; height:auto; float:right; padding-left:460px; margin-top:4px; text-align:right; ">
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
//	print_r($_SERVER);
	//echo "<br>";

//print_r($_POST);
	$sql = "select * from Req_Agent_Pay where A_ID = '".$_SESSION['Aid']."'";
	$query = ExecQuery($sql);
	$email = mysql_result($query,0,'A_Email');
	$mobile = mysql_result($query,0,'A_Mobile');
	$address = mysql_result($query,0,'Address');
	$address = preg_replace('/[^a-zA-Z0-9_ -]/s', ' ', $address);
	
$submit = $_POST['submit'];
$pack_id = $_POST['pack_id_'.$submit];
$sqlGetPackages = "select * from product_for_sale where Status=1  and Pid = '".$pack_id."' ";
$queryGetPackages = ExecQuery($sqlGetPackages);
$numRows = mysql_num_rows($queryGetPackages);
$i = 0;
$Product_Name = mysql_result($queryGetPackages,$i,'Product_Name');
$Portal_Name = mysql_result($queryGetPackages,$i,'Portal_Name');
$Package_Name  = mysql_result($queryGetPackages,$i,'Package_Name');
$Leads_Count = mysql_result($queryGetPackages,$i,'Leads_Count');
$Total_Cost = mysql_result($queryGetPackages,$i,'Total_Cost');
$Package_Name_Display = mysql_result($queryGetPackages,$i,'Package_Name_Display');
$Product_package_Name = $Product_Name." ".$Package_Name;
//$IP = getenv("REMOTE_ADDR");
$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];

$dt = date("Ymds");
$MTrackid = $dt.$_SESSION['Aid'];

$prodSql = "INSERT INTO package_purchase_details (Aid ,Pid ,Cost ,initiate_dt , purchase_status,MTrackid,IP) VALUES ('".$_SESSION['Aid']."', '".$pack_id."', '".$Total_Cost."', Now(), 'initiated', '".$MTrackid."','".$IP."')";

ExecQuery($prodSql);
$Rid = mysql_insert_id();
//exit();
?>
<table cellpadding="3" cellspacing="3" border="0" width="713" align="left">
<tr><td colspan="2" class="text3" style=" color:#21405F; font-size:12px; font-weight:bold; padding-left:3px;" >
You have selected -  <?php echo $Package_Name_Display; ?></td></tr>
<tr><td width="216" class="text" style="  color:#21405F; font-size:13px; ">No of  Leads</td>
<td width="476" class="text" style="  color:#21405F; font-size:13px; "><?php echo $Leads_Count; ?> leads</td>
</tr>
        <tr><td class="text" style="  color:#21405F; font-size:13px; ">Total Cost</td><td class="text" style="  color:#21405F; font-size:13px; ">Rs. <?php echo $Total_Cost; ?>/-</td></tr>
<tr><td colspan="2" class="text3" style=" color:#88a943; font-size:12px; font-weight:bold; padding-left:3px;" >
Should get re-directed to the Payment Gateway.
<br /><br />
    <form name="form" action="Send_Perform_REQuest.php" method="post">
    <input type="hidden" name="Pid" id="Pid" value="<?php echo $pack_id; ?>" />
    <input type="hidden" name="Rid" id="Rid" value="<?php echo $Rid; ?>" />
    <input name="submit" id="submit" type="submit" value="Pay Now" style="border-style:outset;border-color:#0066A2;height:50px;width:130px;font: bold 15px arial,sans-serif;"  />
    </form>
</td></tr></table>
</td></tr>
</table></td></tr>
</table>
</div>
</body>
</html>