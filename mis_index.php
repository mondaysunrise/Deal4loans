<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init_bima.php';
	require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan MIS Report</title>
<style type="text/css">
.data_text_a{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}
.data_text_b{ font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold; color:#C33;}
.data_text_c{ font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#6C6; font-weight: bold;}
table{border:1px solid #CCC; margin:0px 0px 0px 0px; padding:0px 0px 0px 0px;} 
</style>
</head>
<body>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}

include "mishead.php";
?>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td align="center">

<table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td align="center"><a href="pl_mis_report.php">Personal Loan</a> </td></tr><tr><td align="center"> <a href="hl_mis_report.php">Home Loan</a></td></tr>
    <tr><td align="center"><a href="li_mis_report.php">Life Insurance</a> </td></tr><tr><td align="center"> <a href="health_mis_report.php">Health Insurance</a></td>
    
    </tr>
</table>

</td></tr></table>
</body>
</html>
