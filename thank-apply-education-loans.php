<?php
ob_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$RequestID = $_REQUEST['RequestID'];
$Reference_Code1 = $_REQUEST['Reference_Code1'];
$RePhone = $_REQUEST['RePhone'];
$getuserDetailsSql = "select * from Req_Loan_Education where RequestID='".$RequestID."'";
list($alreadyExist,$getuserDetailsQuery)=MainselectfuncNew($getuserDetailsSql,$array = array());
$getuserDetailsQuerycontr=count($getuserDetailsQuery)-1;

$Mobile = $getuserDetailsQuery[$getuserDetailsQuery]['Mobile_Number'];
$Reference_Code0 = $getuserDetailsQuery[$getuserDetailsQuery]['Reference_Code'];
if(($Reference_Code0 == $Reference_Code1) || ($Mobile == $RePhone ))
{
	$Is_Valid=1;
}
else
{
	$Is_Valid=0;
}
//9871267932 subradeep
$dataUpdate = array('Is_Valid'=>$Is_Valid);
$wherecondition = "(RequestID='".$RequestID."')";
Mainupdatefunc ('Req_Loan_Education', $dataUpdate, $wherecondition);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply for Education Loan online India | Deal4Loans India</title>
<meta name="keywords" content="Apply Education Loans, Compare Education Loans, education loans, online education loan form, apply online education loan">
<meta name="description" content="Apply Education Loan online – Get Instant Quotes on Education loan Banks of India with Deal4loans.com, Student loans">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="source.css" rel="stylesheet" type="text/css" />
<!--<script type="text/javascript" src="scripts/mainmenu.js"></script>-->
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;">Home</a></u> ><span class="text12" style="color:#0080d6;"> <a href="http://www.deal4loans.com/apply-education-loans.php" style="color:#0080d6;">Apply Education Loan</a></span>  <span style="color:#4c4c4c;">&gt; Thank You</span></div>
<div class="intrl_txt">
<div style="clear:both; height:15px;"></div>
<div id="txt" style="padding-top:15px;height:250px;">
<div align="center"><b><font color="#3366CC">Thanks for applying Education Loan through Deal4loans.com. You will get a call from us, for information and rates. </font></b><br><br></div>
</div> </div><?php include "footer_sub_menu.php"; ?>
</body>
</html>