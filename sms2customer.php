<?php
	require 'scripts/session_check_sms.php';
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
 $cutomermobile=$_REQUEST['cutomermobile'];
 $customermsg = $_REQUEST['customermsg'];

if(strlen(trim($cutomermobile)) > 0)
		SendSMSforLMS($customermsg, $cutomermobile);
$Msg = "Message Sent.";
}
?>

<html>
<head></head>
<body>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logoutsms.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?><br><br>
<form name="sendmsg" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>"> 
<table width="600" cellpadding="0" cellspacing="2" border="0" style="border:1px solid black;" align="center">
 <tr>
     <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
   </tr>
<tr><td colspan="2" align="center"><font style="font-family:verdana;size:13px;font-weight:bold;">fill details to send SMS</font></td></tr>
<tr><td><font style="font-family:verdana;size:10px;font-weight:bold">Mobile No</font></td><td><input type="text" name="cutomermobile" id="cutomermobile"></td></tr>
<tr><td><font style="font-family:verdana;size:10px;font-weight:bold;">Message</font></td><td><textarea rows="2" cols="20" name="customermsg" id="customermsg"></textarea></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Submit"></td></tr>
</table>

</form>

</body>
</html>