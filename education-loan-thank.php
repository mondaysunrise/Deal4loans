<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
$maxage=date('Y')-62;
$minage=date('Y')-18;

if(strlen($_REQUEST['source'])>0)
{
	$source = $_REQUEST['source'];
}
else
{
	$source="site page";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Education Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<style type="text/css">
body{
	background-color:#f5f5f5;
	font-family: Arial, Helvetica, sans-serif;
	font-size:13px;
	color:#3c3725;
	margin:0px;
	padding:0px;}
.redtxt{

	color:#b54a0b;
	font-size:20px;
	line-height:25px;
 	
}	
.blutxt{
 
	color:#137aaf;
	font-weight:bold;
	font-size:40px;
 }
 
.brdr{
	background-color:#FFFFFF;
	border-left:1px solid #e8e8e8;
	border-right:1px solid #e8e8e8;
}
.frmbrdr{
	background-color:#ebf8ff;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color:#2f586e;
	font-size:11px;
	font-weight:bold;
	border-left:1px solid #def0f9;
	border-right:1px solid #def0f9;
}
.frmhdng{
	background:url(new-images/edu/frmhdng.gif) no-repeat center top;
 	color:#616161;
	font-size:18px;
	height:36px;
	line-height:35px;
}

.txthdng{
	background:url(new-images/edu/hdngbg.gif) no-repeat left top;
	font-size:13px;
	font-weight:bold;
	text-indent:25px;
	color:#5e5957;
	height:33px;
  	line-height:32px;
}
	
</style>
</head>

<body>
<table width="835" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="161" height="155" align="left" valign="top"><img src="new-images/edu/hdr1.gif" width="161" height="155"></td>
        <td width="180" align="left"><img src="new-images/edu/hdr2.gif" width="180" height="155"></td>
        <td background="new-images/edu/hdr-bg.gif">&nbsp;</td>
        <td   align="right" background="new-images/edu/hdr-bg.gif"><img src="new-images/edu/hdr-rgtcorn.gif" width="20" height="155"></td>
      </tr>
      <tr>
        <td width="161" align="left"><img src="new-images/edu/hdr3.gif" width="161" height="208"></td>
        <td width="180" align="left" valign="top"><img src="new-images/edu/hdr4.gif" width="180" height="208"></td>
        <td valign="top" background="new-images/edu/hdr5.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="55" valign="top" class="blutxt">Education Loan </td>
          </tr>
          <tr>
            <td valign="top" class="redtxt">Finance your Higher Education
              <br>
              to unlock your Professional Success</td>
          </tr>
        </table></td>
        <td width="158"><img src="new-images/edu/hdr6.gif" width="158" height="208"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="60" align="center" valign="middle" class="brdr" style="padding-top:10px; ">&nbsp;</td>
  </tr>
  <tr>
    <td height="250" align="center" valign="top" class="brdr" style="padding-top:10px; "><b>Thank for Applying Deal4loans.com</b></td>
  </tr>
  <tr>
    <td width="835" height="12"><img src="new-images/edu/brdr-btm.gif" width="835" height="12"></td>
  </tr>
</table>
</body>
</html>
