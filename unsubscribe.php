<?php
	require 'scripts/functions.php';
	$msg = "Now You have been unsubscribed from our Mailing List";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$From_Name = $_REQUEST['From_Name'];
		$From_Email = $_REQUEST['From_Email'];
		
		$From_Name = FixString($From_Name);
		$From_Email = FixString($From_Email);
/*	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$From_Name.' <'.$From_Email.'>' . "\r\n";
*/
	$headers = 'From: '.$From_Name.' <'.$From_Email.'>' . "\r\n";
	$headers .= "Return-Path: <".$From_Email.">\r\n";  // Return path for errors
/*
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
*/
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	mail('disclaimer@deal4loans.com', "Unsubscribe me...", "Unsubscribe Me", $headers);
	echo "<script language=javascript>alert('".$msg."');"." location.href='unsubscribe_post.php'"."</script>";
	}
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Unsubscription</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div align="center">
 <center>
 <table border="0" cellspacing="1" width="100%" cellpadding="0"  bgcolor="#F9FAF5">
   <tr>
     <td width="" valign="top" align=center>
	<p>&nbsp;</p>
<Script Language="JavaScript">
function validateMe(theFrm){
				if(!checkData(theFrm.From_Name, 'Your Name', 5))
				return false;
				if(!checkData(theFrm.From_Email, 'Your Email ID', 6))
					{
					return false;
					}
				var str=theFrm.From_Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.From_Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.From_Email.focus();
					return false;
					}
		return true;
    }
    </Script>
 <form name="friend_frm" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
 <table border="0" cellspacing="0" width="450" cellpadding="4" id="frm">
   <tr>
     <td colspan="2">Fill this to Unsubscribe......</td>
   </tr>
      <tr>
                <td colspan="2">&nbsp;</td>
     </tr>
      <tr>
                <td>Your Name</td>
     <td><input type="text" name="From_Name" size="30"></td>
   </tr>
   <tr>
                <td>Your Email ID</td>
     <td>
     <input type="text" name="From_Email" size="30"></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><br>
     <input type="submit" value="Unsubscribe"></td>
   </tr>
  </table>
 </form>
	<p>&nbsp;</p>
     </td>
   </tr>
 </table>
</center>
</div>
</body>
</html>