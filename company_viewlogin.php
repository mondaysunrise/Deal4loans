<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
print_r($_POST);
	session_start();
	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	$Email = trim($_POST["Email"]);
	$PWD =  trim($_POST["PWD"]);
	$code = trim($_POST["code"]);

	$IP_Remote = getenv("REMOTE_ADDR");

	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}

	if(isset($PWD) && isset($Email))
	{ $cmpemail = $Email;
		$cmpPWD = $PWD;
			//if($Email=="admincomp@d4l.com" && $PWD=="compadmin" && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134"))
			if($Email==$cmpemail && $PWD==$cmpPWD) 
			{ 
				$_SESSION["Email"] = "Administrator";
				$_SESSION["UserType"] = "bidder";
				$_SESSION['UName'] = "Administrator";
				$_SESSION['Code'] = "Admin";

			 $strDir = dir_name();
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."company_listview.php");
			exit;
			}
		/*elseif($Email=="comppanel@d4l.com" && $PWD=="comppanel" && ($code=="neha0610" || $code=="neha4321" || $code=="swas987" || $code=="anu654" || $code=="shuab$16") && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68"))
		{			
			$_SESSION["Email"] = "Others";
			$_SESSION["UserType"] = "bidder";
			$_SESSION['UName'] = "Others";
			$_SESSION['Code'] = $code;
			$strDir = dir_name();
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."company_listview.php");
			exit;
		}		*/
		else 
		{
			global $Msg;
			$Msg =  "** You are not Authorized. Please try again **";
		}			
	   				
	}
	else 
		{
			global $Msg;
			$Msg =  "** You are not Authorized. Please try again **";
		}
	}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login(Bidder)</title>
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
</style>
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
 <body style="margin:0px; padding:0px; background-color:#45B2D8;">
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse" valign="top">
	 <tr bgcolor="#FFFFFF">
	 <Td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="323" height="93" align="left" valign="top"><img src="images/logo.gif"  /></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="67" align="right" bgcolor="#C6E3F2">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
    </table></Td>
   </tr>
	 <tr>
		<td style="padding-top:15px;">
			<table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >
		
		  </table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td align="center">
		 
	 </td>
   </tr>
	 <tr>
    <td bgcolor="#45B2D8" ><table width="361"   border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="361" height="43" align="center" valign="middle"><img src="images/login-form-topshine-bg.gif" width="361" height="43"></td>
        </tr>
        <tr>
          <td height="156" align="center" valign="middle" background="images/login-form-login-bg.gif"><form method="POST" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
			<table width="250" border="0" cellpadding="4" cellspacing="0">
			   
			   <tr>
				 <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
			   </tr>
               <!--<tr>
				 <td width="100%" class="style1">Securecode</td>
				 <td width="100%"><input type="text" name="code" size="20" maxlength="50" id="code"></td>
			   </tr>-->
			   <tr>
				 <td width="100%" class="style1">Email</td>
				 <td width="100%"><input type="text" name="Email" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="100%" class="style1">Password</td>
				 <td width="100%"><input type="password" name="PWD" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="100%" colspan="2" align="center"><input name="submit" type="image"  src="images/login-form-lgn-sbtn.gif" style="width:111px; height:35px; border:none;"></td>
			   </tr>
		  </table>
		 </form>
          </td>
        </tr>
        <tr>
          <td width="361" height="70" align="center" valign="middle"><img src="images/login-form-bot-shine-bg.jpg" width="361" height="70"></td>
    </tr>
  </table></td>
  </tr>
</table> 
</body>
</html>

