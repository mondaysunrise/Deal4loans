<?php
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
$dated = date("Y-m-d");
$nowdated = ExactServerdate();
$ip_address=ExactCustomerIP();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$source = $_POST['source'];
	$firstName = $_POST['firstName'];
	$middleName = $_POST['middleName'];
	$surName = $_POST['surName'];
	$mobileNo = $_POST['mobileNo'];
	$email = $_POST['email'];
	
	$mobile_code = generateNumber(4);
	$email_code = generateNumber(6);
	
	
	$getdetails="select id, counter From experian_initial_details Where mobileNo not in (9971396361,9811215138) AND ( mobileNo='".$mobileNo."'  AND cibil_score!=0)";
	//$getdetails="select id, counter From experian_initial_details Where ( mobileNo='".$mobileNo."'  AND cibil_score!=0)";
	//echo "<br>".$getdetails."<br>";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
		if($alreadyExist>0)
		{
			$verify=0;	
			$insertID = $myrow[$myrowcontr]["id"];
			$counter = $myrow[$myrowcontr]["counter"];
			$counter = $counter +1;
			$DataArray = array("counter"=>$counter, 'email_code'=> Fixstring($email_code), 'mobile_code'=>Fixstring($mobile_code), 'dated'=>Fixstring($nowdated), 'ip_address'=>Fixstring($ip_address),'mobile_verified'=>$verify, 'email_verified'=>$verify);
			$wherecondition =" (id=".$insertID.")";
			Mainupdatefunc ('experian_initial_details', $DataArray, $wherecondition);
			$insertSql = array('step'=> 'Duplicate', 'status'=> 'First Step', 'message'=> 'First Step', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);
			header("Location: https://www.deal4loans.com/cibil-credit-score-result.php?insertID=".$insertID);
			exit();

		}
		else
		{
			
			$counter=1;
			$dataInsert = array('firstName'=> Fixstring($firstName), 'middleName'=> Fixstring($middleName), 'surName'=>Fixstring($surName), 'mobileNo'=> Fixstring($mobileNo), 'email'=> Fixstring($email), 'email_code'=> Fixstring($email_code), 'mobile_code'=>Fixstring($mobile_code), 'counter'=>$counter, 'dated'=>Fixstring($nowdated), 'ip_address'=>Fixstring($ip_address), 'source'=>Fixstring($source));
			$insertID = Maininsertfunc ('experian_initial_details', $dataInsert);
			$insertSql = array('step'=> 'Step 1', 'status'=> 'Data Inserted', 'message'=> '1st Stage Form', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);
		}
		$SMSMessage = "The OTP for verifying your mobile number at Deal4loans.com is ".$mobile_code.". This password is valid for one transaction or 30 mins from the time it is generated, whichever is early.";
		if(strlen(trim($mobileNo)) > 0)
		{
			SendSMSforLMS($SMSMessage, $mobileNo);
			$insertSql = array('step'=> 'Step 1', 'status'=> 'Data Inserted', 'message'=> 'Message Send', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);
		}
		if(strlen(trim($source)) > 2 && strlen(trim($email)) > 2)
		{	
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
			$Message = '<table align="center" style="max-width:600px; margin:auto;" width="100%" cellpadding="0" cellspacing="0"><tr><td colspan="3" bgcolor="#0c60b6">&nbsp;</td></tr><tr><td colspan="3" align="right" bgcolor="#0c60b6"><img src="http://www.deal4loans.com/images/dea4lonasnew-logo.png" width="123" height="50" style="margin-right:25px;" /></td></tr><tr><td colspan="3" bgcolor="#0c60b6">&nbsp;</td></tr><tr><td width="5%" bgcolor="#0C60B6">&nbsp;</td><td width="90%" rowspan="7" valign="top" style="border-radius:5px 5px;"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="100%">&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#171717; font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold;">Dear '.$firstName.',</td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#4c4c4c; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:21px;">Deal4loans have facilitated you with a free of charge  Experian credit score check  to assist you  in making an informed financial decision.</td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#4c4c4c; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:21px; text-align:justify;">By Successfully veri fying your email id with the below OTP ,</td></tr><tr><td>&nbsp;</td></tr><tr><td>YOU HEREBY APPOINT DEAL4LOANS AS YOUR AUTHORISED REPRESENTATIVE TO RECEIVE YOUR CREDIT INFORMATION FROM EXPERIAN. YOU HEREBY UNCONDITIONALLY CONSENT TO SUCH CREDIT INFORMATION BEING PROVIDED BY EXPERIAN AT YOUR REGISTERED EMAIL ID AND ALSO THROUGH YOUR DEAL4LOANS ACCOUNT AS PER YOUR INDEPENDENT REGISTRATION WITH DEAL4LOANS SUBJECT TO <a href="http://www.deal4loans.com/tandc.php">TERMS AND CONDITIONS</a>.</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td height="30" align="center" style="color:#4c4c4c; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:21px; text-align: center"><strong>One Time Password (OTP)</strong></td></tr><tr><td><table width="191" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="51" align="center" bgcolor="#0C60B6" style="color:#ebf1f6; font-size:22px; font-family:Arial, Helvetica, sans-serif;">'.$email_code.'</td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td height="25" style="color:#010101; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Regards</td></tr><tr><td style="color:#010101; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Deal4loans Family</td></tr><tr><td style="color:#010101; font-size:10px; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table></td><td width="5%" bgcolor="#0C60B6">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td rowspan="2" bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td valign="top" bgcolor="#BDD8EF">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td valign="top" bgcolor="#BDD8EF">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr></table>';		
			$SubjectLine = $firstName .", Verify your Credit Score Request on Deal4loans.com";
			mail($email, $SubjectLine, $Message, $headers);
		}
		
	}
/*$pincode = 400106;
$pan = 'BUQPT2352R';
$flatno = 'SWMARG02';
$buildingName = 'MALAD';
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/apply-personal-loans-lp-styles-new2-11-2015.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/pl_apply-tab_styles-new11-2-2015.css" />
<link href="css/personal-loans-new-lp-11-2-2015.css" type="text/css" rel="stylesheet" />
<title>Check Credit Score</title>
<meta name="keywords" content="Check Credit Score" />
<meta name="description" content="Check Credit Score" />
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

</script>
</head>
<body>
<?php include "middle-menu.php";
 ?>
<div class="d4l_inner_wrapper">
<div style="margin-top:70px;"></div>
<div  class="common-bread-crumb"><a href="index.php">Home</a> > Credit Score </div>
<div style="margin:auto;">
  <div class="left-wrapper">
    <div>
      <h1 class="pl-h1">Credit Score</h1>
      <div style="clear:both;"></div>
      <div style="clear:both; height:15px;"></div>
      <!--class="lfttxtbar" -->
      <div id="txt">
        <div class="pl-bank-leftinn inner-body-plbanks" style="padding:10px;">
<form name="creditscore_form" action="cibil-check-update.php" method="POST" onSubmit="return chkcreditscore(document.creditscore_form);">
<input name="insertID" id="insertID" type="hidden"  value="<?php echo $insertID; ?>" />
<table width="100%" border="0" cellpadding="3" cellspacing="2">
<?php if(strlen($_SESSION['msg'])>0) {?>
  <tr>
    <td colspan="2" class="personal_text" style="font-weight:bold; color:#900;"><?php echo $_SESSION['msg']; ?></td>
  </tr>
  <?php } ?>
  <?php if(strlen($_GET['msg'])>0 ) {?>
  <tr>
    <td colspan="2" class="personal_text" style="font-weight:bold; color:#900;"><?php echo $_GET['msg']; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="2" class="personal_text">Please validate your email and mobile number</td>
  </tr>
    
<tr>    <td height="45" class="form_text">Mobile Verification Code</td>    <td class="alert_msg"><input name="mobile_code" id="mobile_code" type="text"   class="input" /><!--<div id="flatnoVal">Mobile Code - <?php //echo $mobile_code; ?></div> --></td>  </tr>
<?php 
if(strlen(trim($source)) > 2 && strlen(trim($email)) > 2)
{	
?>
<tr>    <td height="45" class="form_text">Email Verification Code</td>    <td class="alert_msg"><input name="email_code" id="email_code" type="text" class="input" /></td>  </tr>
<?php } else { ?>
<tr>    <td colspan="2"><input name="email_code" id="email_code" type="hidden" class="input" value="<?php echo $email_code; ?>" /></td></tr>
<?php
}
?>

  <tr>    <td height="45" colspan="2" align="center">
 	<input type="hidden" name="reason" value="test" /> 
  <input type="image" name="Submit" src="images/login-form-lgn-sbtn.gif" width="119" height="45" tabindex="25" /></td>    </tr>   
  <tr>
    <td height="20" colspan="2" align="center" class="form_text">&nbsp;</td>
  </tr>
</table>
		  </form>
        </div>
      </div>
     
    </div>
  </div>
  <div class="right-panel">
    <?php //include "right-widget.php"; ?>
  </div>
</div>
<div></div>
</div>

<?php include("footer_sub_menu.php"); ?>
<?php print_r($_GET); ?>
</body>
</html>