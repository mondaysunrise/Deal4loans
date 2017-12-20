<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

$currentdate=Date('Y-m-d H');
$min_date = $currentdate.":00:00";
//$min_date = "2016-10-08 10:00:22";
$max_date = $currentdate.":59:59";

echo $getSMS_Sql = "select * from zexternal_send_appointment_sms where send_status=0 and dated between '".$min_date."' and '".$max_date."'";
$getSMS_Query = ExecQuery($getSMS_Sql);
$getSMS_NumRows = mysql_num_rows($getSMS_Query);
for($i=0;$i<$getSMS_NumRows;$i++)
{
	echo "<br>";
	$id = mysql_result($getSMS_Query,$i,'id');
	$send_mobile = mysql_result($getSMS_Query,$i,'send_mobile');
//	$send_mobile = 9953696361;
	$message = mysql_result($getSMS_Query,$i,'message');
	SendSMSforLMS($message, $send_mobile);
	echo $updateSql = "update zexternal_send_appointment_sms set send_status=1 where id = '".$id."'";
 	$update_Query = ExecQuery($updateSql);
	echo "<br>";
}
?>