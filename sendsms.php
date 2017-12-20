<?php 
require 'scripts/db_init.php';
require 'scripts/functions.php';
$MobileNum = $_REQUEST['MobileNum'];
$OtpVal = mt_rand(100000,999999);
SendSMSforLMS($OtpVal,$MobileNum);
echo $_SESSION['OtpVal']=$OtpVal;
?>