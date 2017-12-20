<?php
include "scripts/session_ip.php"; 
require 'scripts/db_init.php';
require 'scripts/functions.php';

$msg = "";

if(isset($_POST['submit']))
{
	$ip_address = $_POST['ip_address'];
	$Dated=ExactServerdate();
	$data = array("ip"=>$ip_address, "status"=>'1', "dated"=>$Dated );
	$table = 'ip_whitelist';
	$insert = Maininsertfunc ($table, $data);
//	$mobile = 9811215138;
	$mobile = 9811555306;
	$message = $ip_address." whitelisted";
	SendSMSforLMS($message, $mobile);
	
	$msg = "Whitelisted";
}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Create Bidder</title>
<link rel="stylesheet" href="mostyle.css" type="text/css" />
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php 
	 if(isset($_SESSION['UserType']))
	{
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logouti.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
<style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
.style2 {
	font-family: verdana;
	font-size: 11px;
	font-weight: bold;
	color:#084459;
}

.style3 {
	font-family: verdana;
	font-size: 11px;
	font-weight: normal;
	color:#084459;
	text-decoration:none;
}


.bluebtn{
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:12px;
font-weight:bold;
color:#084459;
border:1px solid #084459;
background-color:#FFFFFF;
}

.buttonfordate {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;

	background-color: #45B2D8;
	border: 1px solid #45B2D8;
	font-weight: bold;
}
.regdalert{
	font-size:10px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	color:#FF0033;
	text-decoration:none;
}

</style>
<script Language="javaScript">
function check_list(Form)
{

	if(Form.ip_address.value=="")
	{
		alert('Please enter ip address');
		Form.ip_address.focus();
		return false;
	}

}
</script>


</head>
<body>
	<table width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">IP WhiteList</td>
      </tr>
				<tr>
    
	      <td  class="blktxt" style="padding-top:5px;" align="left" valign="top" >
		<form name="BidderInsert" action="create-ip.php" method="post" onsubmit="return check_list(document.BidderInsert);" >
		<table cellpadding="2" cellspacing="4" style="border:1px solid #2187c1;" width="100%" bgcolor="#FFFFFF">
		<tr>
		  <td>Whitelist IP</td><td><input type="text" name="ip_address" id="ip_address" /></td></tr>

		<tr><td>&nbsp;</td><td><input type="submit" name="submit" value="Save..." /></td></tr>
	 <tr><td colspan="2"  ><?php echo  $msg; ?> </td></tr>        
       
		</table>
	    </form>
	  </td>
	  </tr>
 </table>
</body>
</html>
