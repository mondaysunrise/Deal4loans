<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

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
</style>
</head><body><?php 

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/images/logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";

?>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td style="padding-top:15px;" align="center"><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4loans MIS</h1></td>
	</tr>
	<tr><td align="right" style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:10px;'>
    <?php include "referal_head.php"; ?>    
     </td></tr>
 <tr><td align="center">&nbsp;</td></tr>     
  <tr><td align="center">&nbsp;</td></tr>     
 <tr><td align="center">
<table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
<tr>
  <td align="right" colspan="5" class="style2"><a href="add_agent_referal.php"  class="style2">Add Agent</a></td>
</tr>   
<tr>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2" height="29">Agent's Name </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Location</td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Email ID </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Pwd </td>
<td width="141" align="center" bgcolor="#FFFFFF" class="style2">Edit </td>    
   </tr>
   <?
 //  echo "Select * From Req_Partner Where 1=1 and Partner_Manager_ID='".$_SESSION['BidderID']."' order by Partner_Name asc ";
$result=ExecQuery("Select * From Req_Partner Where 1=1 and Partner_Manager_ID='".$_SESSION['BidderID']."' and Status=1 order by Partner_Name asc ");
$recordcount = mysql_num_rows($result);
		while($row=mysql_fetch_array($result))
		{
?>
<tr>
       <td align="center" bgcolor="#DFF6FF" class="style3" height="23"><? echo $row["Partner_Name"]; ?></td>
<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Partner_City"]; ?></td>
<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Partner_Mobile"]; ?></td>
<td align="center" bgcolor="#DFF6FF" class="style3"><?  echo $row["Partner_Username"]; ?></td>
<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Partner_Password"]; ?></td>
<td align="center" bgcolor="#DFF6FF" class="style3"><a href="edit_agent_referal.php?AgentID=<? echo $row["Partner_ID"]; ?>">Edit</a></td>    
   </tr>
<?				$i=$i+1;
		}
 ?>
 </table>
 <br>
 </td></tr></table>
</td></tr></table>
</body>
</html>