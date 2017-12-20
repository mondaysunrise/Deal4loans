<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

echo $IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
	session_start();
	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Email = $_POST['Email'];
		$PWD = $_POST['PWD'];
		$securepwd = $_POST['securepwd'];
				
			$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
		if(strlen($Email)>2 && strlen($PWD)>2 && strlen($securepwd)>2)
		{
			$Dated = ExactServerdate();
			$dataInsert = array('secure_pwd'=>$securepwd, 'dated'=>$Dated);
			$getdataqry = Maininsertfunc ('getdata_tracking', $dataInsert);

		if(($Email=="get4data@d4l.com" && $PWD=="get4data") && ($securepwd=="balbir0102" || $securepwd=="wrs(info)2014" || $securepwd=="rc0502" || $securepwd=="neha0610" || $securepwd=="neha@d4l321" || $securepwd=="swas987" || $securepwd=="anu654" || $securepwd=="shuab$16" || $securepwd=="shwet@3011" || $securepwd=="ankit@21august2017") && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.58" || $IP=="182.73.4.59" || $IP=="182.73.4.60" || $IP=="182.73.4.61" || $IP=="182.73.4.62" || $IP=="182.71.109.218" || $IP=="1.23.114.53" || "185.93.231.12"))
		{
			$_SESSION['Email-getdata'] = "admin";
			$_SESSION['securepwd'] = $securepwd;
			header("Location:forgetdata.php");
			exit;
		}
		else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}
		
		}
		else
		{
			global $Msg;
			$Msg =  "** fill complete details **";
		}
		
	}
	if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.58" || $IP=="182.73.4.59" || $IP=="182.73.4.60" || $IP=="182.73.4.61" || $IP=="182.73.4.62" || $IP=="182.71.109.218" || $IP=="1.23.114.53" || "185.93.231.12")
{
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login(Get Data)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<div id="dvLogo"><img src="<?php echo $WebsitePath;?>images/logo.gif" alt="bimadeals"  onClick="javascript:location.href='<?php echo $WebsitePath;?>index.php'" /></div>
  <Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.Email, 'Email', 4))
	{
		return false;
	}
	var str=theFrm.Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
					return false;
					}
	if(!checkData(theFrm.PWD, 'Password', 3))
		return false;
	return true;
    }
 </Script>
 <div align="center">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">
 <td align="center" width="100%">
 <table width="100%" border="0">
 <tr><td width="140">&nbsp;</td>
  <tr><td width="140">&nbsp;</td>
 <td align="center">
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
<p>&nbsp;</p>
  <p>&nbsp;</p>
 <table width="250" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td colspan="2" class="head1">Login</td>
   </tr>
   <tr>
     <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
   </tr>
   <tr>
     <td width="50%" class="bodyarial11">Email</td>
     <td width="50%"><input type="text" name="Email" size="20" maxlength="50"></td>
   </tr>
   <tr>
     <td width="50%" class="bodyarial11">Password</td>
     <td width="50%"><input type="password" name="PWD" size="20" maxlength="50"></td>
   </tr>
   <tr>
     <td width="50%" class="bodyarial11">Secure Pwd</td>
     <td width="50%"><input type="password" name="securepwd" size="20" maxlength="50"></td>
   </tr>
   <tr>
     <td width="100%" colspan="2" align="center"><input type="submit" class="bluebutton" value="Submit"></td>
   </tr>
  </table>
 </form></td>
 </table>
 	  </td>
 <tr>
 <td align="center" width="100%">
 <table width="100%" border="0">
 <tr><td width="140">&nbsp;</td>
 </table>
 </td>
 </tr>
</table>
</div>
  </body>
</html>
<? 
	}
	else
	{
		echo "Sorry";
	} ?>