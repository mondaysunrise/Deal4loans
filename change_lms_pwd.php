<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';


$bidderid= $_SESSION['BidderID'];		
$username= $_SESSION['Email'];
		
		
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$old_password = FixString($old_password);
		$new_password = FixString($new_password);
		$bidderid= $_POST['bidderid'];		
		$username= $_POST['username'];
		
		//get old register
		$qry="select * from Bidders Where (Email ='".$username."' and PWD ='".$new_password."')";
		$result=d4l_ExecQuery($qry);
		$recordcount = d4l_mysql_num_rows($result);

	if ($recordcount>0)
	{
	  $msg = "This password already exist";
	  echo "<script language=javascript>alert('".$msg."');</script>";
	}
	else
	{	
	$sql1 = "Update Bidders Set PWD='".$new_password."',Last_Login=Now() Where (BidderID=".$bidderid.")";
	$result1 = d4l_ExecQuery($sql1);
	echo $sql1."<br>";

	echo "<script>window.close()"."</script>";
	}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<Script Language="JavaScript" type="text/javascript">
function chkform()
{  
	if(document.pwd_form.old_password.value=="")
		{
				alert("please enter your Current Password!");
				document.pwd_form.old_password.focus();
					return false;
		}
	if(document.pwd_form.new_password.value=="")
		{
				alert("please enter New Password!");
				document.pwd_form.new_password.focus();
				return false;
		}
	if(document.pwd_form.retype_password.value=="")
		{
				alert("Please Retype Your password again!");
				document.pwd_form.retype_password.focus();
				return false;
		}
		if(document.pwd_form.new_password.value!=document.pwd_form.retype_password.value)
		{
				alert("Both the passwords should match!");
				document.pwd_form.retype_password.focus();
				return false;
		}
	
	
}
</Script>
</head>

<body>
<table  width="500" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
<tr>
<td width="500" height="150" align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid #9C9A9C;">
<tr>
<td height="40" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Change Your Password</h1></td>
</tr>
<tr>
<td  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#052733; line-height:17px;"><!--PERSONAL LOAN is a need based product. Your end-sales will depend upon how quickly you contact the customer (after he registers for Loan).<br/><b>Tips: <br>1.</b> Login as many times a day as possible and contact the customer early .<br/>
<b>2.</b> Ensure that your contact numbers go to the customer in the auto-acknowledgement SMS that Deal4Loans sends. <br>
<b>2.</b> Tell the loan seeker how much tax savings will this home loan get him/her.-->
<form name="pwd_form" method="POST" action="<? echo $_SERVER['PHP_SELF']; ?>" onSubmit="return chkform();">
<input type="hidden" name="bidderid" value="<? echo $bidderid; ?>" />
<input type="hidden" name="username"  value="<? echo $username; ?>"/>
<table cellpadding="0" cellspacing="4"  width="100%">
	<tr>
		<td><b>Old Password</b></td><td><input type="password" name="old_password" id="old_password" /></td>
		</tr>
		<tr>
		<td><b>New Password</b></td><td><input type="password" name="new_password" id="new_password" maxlength="15"/></td></tr>
		<tr>
		<td><b>Retype New Password</b></td><td><input type="password" name="retype_password" id="retype_password"/></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" class="btnclr" value="Submit"></td>
	</tr>
</table>
</form>

</td>
</tr>
</table>
</td>
</tr>
</table
</body>
</html>
