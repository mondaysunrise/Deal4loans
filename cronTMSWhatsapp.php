<?php
require 'scripts/db_init.php';

$id = $_REQUEST['id'];
$master_user_id = $_REQUEST['master_user_id'];
$whatsapp_id = $_REQUEST['whatsapp_id'];
$mobile = $_REQUEST['mobile'];
$message = $_REQUEST['message'];
$date_requested = $_REQUEST['date_requested'];
$requester = $_REQUEST['requester'];
$whatsapp_request_data = $_REQUEST['whatsapp_request_data'];
$whatsapp_response_data = $_REQUEST['whatsapp_response_data'];
$whatsapp_response_id = $_REQUEST['whatsapp_response_id'];
$whatsapp_response_info = $_REQUEST['whatsapp_response_info'];
$whatsapp_status = $_REQUEST['whatsapp_status'];
$date_created = $_REQUEST['date_created'];
$date_modified = $_REQUEST['date_modified'];

$getdetails = "select id From xkyknzl5dwfyk4hg_tms_whatsapp Where (id='".$id."')";
list($alreadyExist, $myrow) = MainselectfuncNew($getdetails, $array = array());
$myrowcontr = count($myrow) - 1;

if ($alreadyExist > 0) 
{
    $ProductValue = $myrow[$myrowcontr]["id"];
    $InsertStatus = "2";
} else {
		$dataInsert = '';
		$dataInsert['id'] = $id;
		$dataInsert['master_user_id'] = $master_user_id;
		$dataInsert['whatsapp_id'] = $whatsapp_id;
		$dataInsert['mobile'] = $mobile;
		$dataInsert['message'] = $message;
		$dataInsert['date_requested'] = $date_requested;
		$dataInsert['requester'] = $requester;
		$dataInsert['whatsapp_request_data'] = $whatsapp_request_data;
		$dataInsert['whatsapp_response_data'] = $whatsapp_response_data;
		$dataInsert['whatsapp_response_id'] = $whatsapp_response_id;
		$dataInsert['whatsapp_response_info'] = $whatsapp_response_info;
		$dataInsert['whatsapp_status'] = $whatsapp_status;
		$dataInsert['date_created'] = $date_created;
		$dataInsert['date_modified'] = $date_modified;

		$ProductValue= Maininsertfunc ('xkyknzl5dwfyk4hg_tms_whatsapp', $dataInsert);
		$InsertStatus = "1";
}
echo $InsertStatus;
echo "," . $ProductValue;
?>