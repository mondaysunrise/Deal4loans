<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($_POST['method'] == 'OtpValidate'){
		//echo '<pre>';print_r($_POST);exit;
		$otp = $_POST["otp"];
		$bidderid = $_POST["bidderid"];
		
		$validateOtpSql = "Select * FROM Bidders WHERE BidderID='".$bidderid."' AND Email_old = '".$otp."'";
		$validateOtpResult = d4l_ExecQuery($validateOtpSql);
		$validateOtpRows = d4l_mysql_num_rows($validateOtpResult);

		if($validateOtpRows > 0)
		{
			$message = "Verified Successfully";
		}
		else{
			$message = "Incorrect OTP";
		}
		
		echo $message;
		exit;
	}
}

/* Create and Send OTP*/
$OtpCode = generatePassword(5);
//Send Mail
$detailsArr = array();
$detailsArr['email'] = $_SESSION['Email'];
$detailsArr['name'] = $_SESSION['UName'];
$detailsArr['code'] = $OtpCode;
//echo '<pre>';print_r($detailsArr);exit;
$mailResponse = SendNormalMailToCustomers($detailsArr);

//Update Reference Code in DB
$OtpDataArray = array("Email_old"=>$OtpCode);
$WhereOtpArray ="(BidderID='".$_SESSION['BidderID']."')";
Mainupdatefunc("Bidders", $OtpDataArray, $WhereOtpArray);
/* Create and Send OTP*/

?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
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

.button
{
   background: url(http://www.deal4loans.com/images/login-form-lgn-sbtn.gif) no-repeat;
   cursor:pointer;
   border: none;
}
</style>
<body style="margin:0px; padding:0px; background-color:#45B2D8;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse" valign="top">
	<tr bgcolor="#FFFFFF">
		<td align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="323" height="93" align="left" valign="top"><img src="images/login-logo.gif" width="323" height="93" /></td>
					<td valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="67" align="right" bgcolor="#C6E3F2">&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
	<tr>
		<td bgcolor="#45B2D8" align="center">
			<table width="361"   border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td width="361" height="43" align="center" valign="middle"><img src="new-images/login-form-topshine-bg-otp.jpg" width="361" height="43"></td>
				</tr>
				<tr>
					<td height="156" align="center" valign="middle" background="images/login-form-login-bg.gif">
						<form method="post" action="">
						<table width="250" border="0" cellpadding="4" cellspacing="0">
							<tr>
								<td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11" id><? echo $Msg ?></span></td>
							</tr>
							<tr>
								<td width="100%" class="style1">Type OTP</td>
								<td width="100%"><input type="password" name="otp" id="otp" size="20" maxlength="6"></td>
							</tr>
							<tr>
								<td width="100%" colspan="2" align="center"><input type="button" name="validate" id="validate" style="width:111px; height:35px; border:none;" class="button"></td>
						   </tr>
						</table>
						</form>
					</td>
				</tr>
				<tr>
					<td width="361" height="70" align="center" valign="middle">
						<img src="images/login-form-bot-shine-bg.jpg" width="361" height="70">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-1312775-1', 'deal4loans.com');
ga('require', 'displayfeatures');
ga('send', 'pageview');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$("#validate").click(function(){
		var otp = $('#otp').val();
		var bidderid = '<?php echo $_SESSION['BidderID']; ?>';
		if(otp == ""){
			alert("Please enter Otp");
			return false;
		}
		else{
			//Validate OTP
			$.ajax({
				url: 'sbidocumentotpvalidate.php',
				type: 'POST',
				data: {
					otp: otp,
					bidderid: bidderid,
					method: 'OtpValidate',
				},
				success: function (res) {
					console.log(res);
					var base_url = window.location.origin;
					if(res == "Verified Successfully")
					{
						window.location.href = base_url+'/sbi_docs_index.php';
					}
					else{
						alert(res);
						return false;
					}
				}
			});
		}
	});
});
</script>
</body>
</html>

<?php

function SendNormalMailToCustomers($detailsArr){
	
	$message = '<table cellpadding="0" cellspacing="0" border="0" width="600" align="center">
				<tr><td bgcolor="#0c60b6">&nbsp;</td></tr>
				<tr>
					<td bgcolor="#0c60b6" align="right">
						<img src="http://www.deal4loans.com/images/deal4loans_logo.png" style="margin-right:25px;" />
					</td>
				</tr>
				<tr><td bgcolor="#0c60b6">&nbsp;</td></tr>
				<tr><td bgcolor="#bdd8ef">&nbsp;</td></tr>
				<tr><td bgcolor="#bdd8ef">&nbsp;</td></tr>
				<tr>
					<td bgcolor="#bdd8ef">
						<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
							<tr>
								<td height="35" bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#171717; padding-left:15px;">Dear '.$detailsArr['name'].',</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Please use this code <b>'.$detailsArr['code'].'</b> to validate your email.</td>
							</tr>
							<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Regards</td></tr>
							<tr>
								<td bgcolor="#FFFFFF" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#4c4c4c; line-height:21px; padding-left:15px;">Deal4loans Family</td>
							</tr>
							<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
							<tr><td bgcolor="#FFFFFF">&nbsp;</td></tr>
						</table>
					</td>
				</tr>
				<tr><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#676767;">Disclaimer: Deal4loans does not provide Loans on its own but ensures your information is sent to bank/agent which you have opted for. We do not do short term loans. Deal4loans has no sales team on its own and we just help you to compare loans. All loans are on discretion of the associated</td></tr></table></td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td></tr></table>';

	//print_r($message);exit;

	////////////////--------------Send Mail via PHP---------------///////////////

	$to = $detailsArr['email'];
	//$to = 'rachit2264@gmail.com';
	$subject = "Deal4loans-Email Validation";

	// Set content-type header for sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// Additional headers
	$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	//$headers .= 'Cc: upendra.kumar@wishfin.com' . "\r\n";
	$headers .= 'Bcc: rachit.jain@wishfin.com, upendra.kumar@wishfin.com' . "\r\n";

	// Send email
	if(mail($to,$subject,$message,$headers)){
		$Msg = 'Mail Sent';
	}
	else{
		$Msg = 'Mail Failed';
	}
	
	////////////////--------------Send Mail via PHP---------------///////////////

	return $Msg;
}
?>

