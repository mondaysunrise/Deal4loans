<?php
ob_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
$Reference_Code = $_REQUEST['Reference_Code'];
$Phone = $_REQUEST['Phone'];
$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";
if(strlen(trim($Phone)) > 0)
{
//echo $SMSMessage;
	SendSMSforLMS($SMSMessage, $Phone);
}

//header('Location: http://www.bestloansdeal.com/pl5.php');
header('Location: http://www.bestloansdeal.com/get-personal-loan5-continue.php');
exit();
?>