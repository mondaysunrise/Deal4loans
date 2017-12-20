<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require 'scripts/db_init.php';
require 'scripts/functions.php';

$query = "SELECT sbiccid, RequestID FROM `sbi_credit_card_5633_290717` WHERE productflag = 0 ANd DATE(date_modified) >= '2017-01-01' AND request_xml != '' ORDER BY date_modified DESC LIMIT 0,500";
$result = d4l_ExecQuery($query);
$idArray= array();
while($row=d4l_mysql_fetch_assoc($result)){
	//echo '<pre>';print_r($row);
	$sbiccid = $row["sbiccid"];
	$RequestID = $row["RequestID"];
	
	$checkIDInSMSQry = "SELECT UserID FROM Req_Credit_Card_Sms WHERE UserID = '".$RequestID."'";
	$checkIDInSMSResult = d4l_ExecQuery($checkIDInSMSQry);
	$SMSRows = d4l_mysql_num_rows($checkIDInSMSResult);
	//echo $RequestID.'--'.$SMSRows.'<br>';
	if($SMSRows){
		$idArray[] = $sbiccid;
	}
}
$sbiccString = explode(',',$idArray);
if(!empty($sbiccString)){
echo $updatequery="Update sbi_credit_card_5633_290717 set productflag='44' Where sbiccid IN (".$sbiccString.")";
echo ';<br>';
//$FinalResult = d4l_ExecQuery($updatequery);
}
?>
