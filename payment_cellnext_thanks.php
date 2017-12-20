<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';


$uid = $_REQUEST['uid'];
$Amt = $_REQUEST['Amt'];
$TranID = $_REQUEST['TranID'];
$Status = $_REQUEST['Status'];
$Msg = $_REQUEST['Msg'];
$DataArray = array("transaction_id"=>$TranID, "Status"=>$Status, "Message"=>$Msg);
$wherecondition ="id = '".$uid."'";
Mainupdatefunc ('payment_cellnext_details', $DataArray, $wherecondition);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deal4loans</title>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>

</head>

<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<?php include'../~sml-hdr.php';?>
<div class="lfttxtbar">

	
	  <div id="txt">	

<table width="458" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="110" valign="bottom" background="new-images/cell.jpg" style="background-repeat:no-repeat;"><h1 >Your Transaction Details</h1></td>
  </tr>
  <tr>
    <td class="aplfrm"><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="30%" height="35" class="frmtxt">Transaction Id</td>
        <td width="70%"><?php echo $_REQUEST["TranID"]; ?> </td>
      </tr>
      <tr>
        <td height="35" class="frmtxt">Amount</td>
        <td>    <?php echo $_REQUEST["Amt"]; ?> </td>
      </tr>
      <tr>
        <td height="35" valign="middle" class="frmtxt">Status</td>
        <td> <?php echo $_REQUEST["Status"]; ?> </td>
      </tr>
	        <tr>
        <td height="35" valign="middle" class="frmtxt">Message</td>
        <td> <?php echo $_REQUEST["Msg"]; ?> </td>
      </tr>
   
      <tr>
        <td height="25">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
          <td width="458" height="26"><img src="new-images/apl-bt.gif" width="458" height="26" /></td>
  </tr>
</table>
		
</div>
</div>
</div>
 <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right-new.php';
  }
  ?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>

