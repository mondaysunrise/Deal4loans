<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	//print_r($_POST);
		$post_id = $_POST['post_id'];
		$enable = $_POST['enable'];
		if(strlen($post_id)>1)
		{
		 	$updateSql = "update wp_posts set view_form	='".$enable."' where ID in (".$post_id.")";
			ExecQuery($updateSql);
			$done = "Done";
		}
		else
		{
			$done = "notdone";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<style>
.bidderclass{Font-family:Comic Sans MS;font-size:13px;}
.style1 {	font-family: verdana;	font-size: 12px;	font-weight: bold;	color:#084459;}
.style2 {	font-family: verdana;	font-size: 11px;	font-weight: bold;	color:#084459;}
.style3 {	font-family: verdana;	font-size: 11px;	font-weight: normal;	color:#084459;	text-decoration:none;}
.bluebtn{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold;color:#084459;border:1px solid #084459;background-color:#FFFFFF;}
.buttonfordate {	font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 11px;	color: #FFFFFF;	background-color: #45B2D8;	border: 1px solid #45B2D8;	font-weight: bold;}
.input {    border: 1px solid #006;    background: #ffc;	height:20px;}
.textarea {    border: 1px solid #006;    background: #ffc;}
.button {    border: 1px solid #006;    background: #9cf;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:45px;}
label {    display: block;    float: left;    text-align: right;}
br { clear: left; }
	</style>
</head>
<body>


<?php 
	 if(isset($_SESSION['UserType']))
	{
	
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
 <?php // 9997298585
include "content_header.php";
?>
<div style="text-align:center; font-size:14px; font-weight:bold;">Articles Sidebar Enable/Disable</div>
 <form name="frmsearch" action="wp_sidebar.php" method="post">
 <table width="950" border="0" align="center" cellpadding="1" cellspacing="3" bgcolor="#FFFFFF" >
<?php if($done=="Done") { ?>
  <tr><td colspan="2"  bgcolor="#FFFFFF" class="style2" style="color:#FF0000;"><?php echo $done; ?></td></tr><?php } ?>
  <tr>
       <td width="293" align="center" bgcolor="#FFFFFF" class="style2">ID</td>     
    <td width="644" align="center" bgcolor="#FFFFFF" class="style2"><div align="left">
      <input type="text" name="post_id" id="post_id" value="<?php echo $post_id; ?>"  />
    </div></td></tr><tr>
	 <td width="293" align="center" bgcolor="#FFFFFF" class="style2">Enable/Disable</td>     
	 <td width="644" align="center" bgcolor="#FFFFFF" class="style2"><div align="left">
	   <input type="radio" name="enable" value="1" <?php if($enable==1) echo 'checked="checked"'; ?>  />
	   Enable 
	   <input type="radio" name="enable" value="0" <?php if($enable==0) echo 'checked="checked"'; ?> />
      Disable</div></td></tr><tr>
      <td width="293" align="center" bgcolor="#FFFFFF" class="style2">&nbsp;</td>     
      <td width="644" align="center" bgcolor="#FFFFFF" class="style2"><div align="left">
        <input type="submit" name="Submit" value="Submit" />
      </div></td>
    
   </tr>
 </table>
 <br>
 
</form>


</body>
</html>