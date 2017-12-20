<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

ini_set('max_execution_time', 600);

require 'scripts/db_init.php';

//Check if Punched 6 months before
$checkPunchSql = "SELECT first_dated FROM sbi_credit_card_5633 as scc JOIN Req_Credit_Card_Sms as rccs ON (rccs.UserID = scc.RequestID  AND rccs.UserID != 0) WHERE rccs.RequestID = '1072387' AND scc.first_dated != '0000-00-00 00:00:00' AND first_dated < DATE_SUB(NOW(),INTERVAL 6 Month)";
$checkPunchResult = d4l_ExecQuery($checkPunchSql);
$checkPunchNumRows = d4l_mysql_num_rows($checkPunchResult);
$checkPunchResponse = d4l_mysql_fetch_assoc($checkPunchResult);
if($checkPunchNumRows>0){
	echo "Lead is already punched at ".$checkPunchResponse['first_dated']; die();
}
?>
