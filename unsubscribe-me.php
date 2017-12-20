<?php
require 'scripts/functions.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Unsubscribe - Deal4loans</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<Script Language="JavaScript">
function validmail(email1)
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;
	}
	for (i=0; i<invalidChars.length; i++)
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1)
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1)
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1)
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1)
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
	}
	return true;
}

function validateMe(theFrm){
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(!checkData(theFrm.From_Name, 'Your Name', 5))
	return false;
	if(theFrm.mobile.value=="")
	{
		alert("Please enter the Contact No");
		theFrm.mobile.focus();
		return false;
	}
	if(theFrm.mobile.value!="")
	{
		if (theFrm.mobile.value.length < 10 )
		{
				alert("Please Enter 10 Digits"); 
				 theFrm.mobile.focus();
				return false;
		}
		if (theFrm.mobile.value.charAt(0)!="9" && theFrm.mobile.value.charAt(0)!="8" && theFrm.mobile.value.charAt(0)!="7")
		{
				alert("The number should start only with 9 or 8 or 7");
				 theFrm.mobile.focus();
				return false;
		}
	}
	if(theFrm.From_Email.value=="")
	{
		alert("Please enter the Email ID");
		theFrm.From_Email.focus();
		return false;
	}
  if(theFrm.From_Email.value!="")
  {
	if (!validmail(theFrm.From_Email.value))
	{
		theFrm.From_Email.focus();
		return false;
	}
  }
	return true;
}
</Script>
<style type="text/css">

.red{color:#F00;}
.aplfrm{border-left:5px solid #a2d7f6; border-right:5px solid #a2d7f6; background:#f6fcff;}
-->
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="lac-main-wrapper">
<div style="margin-top:80px; color:#0a8bd9;"><a href="index.php" style="color:#0080d6;" >Home</a> <span>> Do not Disturb</span></div>
<div style="clear:both; height:15px;"></div>
<div>
<div id="bodyCenter" align="center">
<div id="nwcontainer" align="center" style="color:#FF0000;">
<form name="friend_frm" method="post" action="unsubscribe-thank.php" onSubmit="return validateMe(this);">
<div class="agent-form"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="55" align="center" bgcolor="#FFFFFF"><b>Do not wish to hear from us on any Offers<br />
Please Enter your Details </b></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    
<tr>
<td width="30%" height="35" class="frmtxt">Your Name</td>
<td width="70%"><input name="From_Name" type="text"  size="40" class="emi_input" /></td>
</tr>
<tr>
<td height="35" class="frmtxt">Mobile </td>
<td><input name="mobile" type="text"  size="40" maxlength="10"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" class="emi_input" /></td>
</tr>
<tr>
<td height="35" class="frmtxt">Your Email ID</td>
<td><input name="From_Email" type="text"  size="40" class="emi_input" /></td>
</tr>
<tr>
<td colspan="2" align="center"><input name="submit" type="submit" class="btnclr" value="Enter" /></td>
</tr>
</table>
</div>
</form>
</div>
</div>
</div>
</div></div>
<div style="clear:both; height:15px;"></div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>