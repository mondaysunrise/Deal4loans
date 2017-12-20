<?php
require_once("includes/application-top.php");
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
echo $IP;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.58" || $IP=="182.73.4.59" || $IP=="182.73.4.60" || $IP=="182.73.4.61" || $IP=="182.73.4.62" || $IP=="182.71.109.218"  || $IP=="180.151.74.83" || $IP=="185.93.231.12"  || $IP=="115.249.245.30" || $IP=="122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="113.193.239.185" || $IP=="1.22.91.116" || ($getIPNum>0)))
	{
		
		$admincallerName = fun_db_output($_POST['callerName']); 
		$adminUname = fun_db_output($_POST['Email']); 
		$adminPass = fun_db_output($_POST['PWD']);
		if(!$objAdmin->fun_check_username_admin_existance($adminUname))
		{
			redirectURL(SITE_URL."leads-admin-login.php?msg=".urlencode("Please enter correct username!"));
		}
		if(!$objAdmin->fun_check_pwd_admin_existance($adminPass))
		{
			redirectURL(SITE_URL."leads-admin-login.php?msg=".urlencode("Your password does not match with our record. Please enter correct password!"));
		}
		
		if($objAdmin->fun_verify_admins($adminUname, $adminPass))
		{
			$adminInfo = $objAdmin->fun_getAdminUserInfo(0, $adminUname, $adminPass);		
			if(sizeof($adminInfo))
			{
				
                            $_SESSION['BidderID'] =  $adminInfo['BidderID'];
				$_SESSION['Email'] = $adminInfo['Email'];
				$_SESSION['PWD'] = $adminInfo['PWD'];
				$_SESSION['Bidder_Name'] = $adminInfo['Bidder_Name'];
				$_SESSION['ReplyType'] = $adminInfo['Reply_Type'];
                                $_SESSION['Process_Name'] = $adminInfo['Process_Name'];
                                $_SESSION['leadidentifier'] = $adminInfo['leadidentifier'];
	
				$sqlTrackBidder = "INSERT INTO  LMSLoginDetails (BidderID ,Bidder_Name ,Start_Time ,End_Time ,SessionID ,IP ,Product_Type) VALUES ( '".$adminInfo['BidderID']."',  '".$admincallerName."',  Now(),  '',  '',  '".$IP."',  '1')";
//				$sqlTrackreult= $obj->fun_db_query($sqlTrackBidder);
			//print_r($_SESSION); die;
                                if($_SESSION['leadidentifier']=='consol_bajajfin_pl'){
                            header("Location:leads-consol-lms-list.php");
                        }else{
				header("Location:leads-admin-lms-list.php");
                        }
                                
                        }
		}
		else {
			redirectURL(SITE_URL."leads-admin-login.php?msg=".urlencode("Incorrect User or Password!"));
			}
	}
	else{
	redirectURL(SITE_URL."leads-admin-login.php?msg=".urlencode("Not permission for you!"));
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
<link href="../includes/style1.css" rel="stylesheet" type="text/css">
<style>
.bidderclass {
	Font-family: Comic Sans MS;
	font-size: 13px;
}
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color: #084459;
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
<div style="width:100%; background:#036; padding:0px 0px 2px 0px;">
<img src="http://www.deal4loans.com/homeimages/dea4lonasnew-logo.png" width="158" height="62"  >
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse" valign="top">
  <tr bgcolor="#FFFFFF">
    <Td align="left" bgcolor="#45B2D8">&nbsp;</Td>
  </tr>
  <tr>
    <td style="padding-top:150px;"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td bgcolor="#45B2D8" ><table width="361"   border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="361" height="43" align="center" valign="middle"><img src="../images/login-form-topshine-bg.gif" width="361" height="43"></td>
        </tr>
        <tr>
          <td height="156" align="center" valign="middle" background="../images/login-form-login-bg.gif"><form method="post" action="" onSubmit="return validateMe(this);">
              <table width="250" border="0" cellpadding="4" cellspacing="0">
                <tr>
                  <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11" style="color:#F00"><?php echo $_REQUEST['msg'];?></span></td>
                </tr>
                <tr>
                  <td width="50%" class="style1">Email</td>
                  <td width="50%"><input type="text" name="Email" size="20" maxlength="50"></td>
                </tr>
                <tr>
                  <td width="100%" class="style1">Password</td>
                  <td width="100%"><input type="password" name="PWD" size="20" maxlength="50"></td>
                </tr>
                <tr>
                  <td width="100%" colspan="2" align="center"><input name="submit" type="image"  src="../images/login-form-lgn-sbtn.gif" style="width:111px; height:35px; border:none;"></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td width="361" height="70" align="center" valign="middle"><img src="../images/login-form-bot-shine-bg.jpg" width="361" height="70"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
