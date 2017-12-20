<?php
require 'scripts/db_init.php';

$id = $_REQUEST['id'];
$template_id = $_REQUEST['template_id'];
$table_name = $_REQUEST['table_name'];
$unique_id = $_REQUEST['unique_id'];
$process_name = $_REQUEST['process_name'];
$mobile_number = $_REQUEST['mobile_number'];
$variables = $_REQUEST['variables'];
$whatsapp_status = $_REQUEST['whatsapp_status'];
$send_date = $_REQUEST['send_date'];
$attempt = $_REQUEST['attempt'];
$date_created = $_REQUEST['date_created'];
$date_modified = $_REQUEST['date_modified'];
$status = $_REQUEST['status'];

$getdetails = "select id From xkyknzl5dwfyk4hg_wishfin_whatsapp Where (id='".$id."')";
list($alreadyExist, $myrow) = MainselectfuncNew($getdetails, $array = array());
$myrowcontr = count($myrow) - 1;

if ($alreadyExist > 0) 
{
    $ProductValue = $myrow[$myrowcontr]["id"];
    $InsertStatus = "2";
} else {
		$dataInsert = '';
		$dataInsert['id'] = $id;
		$dataInsert['template_id'] = $template_id;
		$dataInsert['table_name'] = $table_name;
		$dataInsert['unique_id'] = $unique_id;
		$dataInsert['process_name'] = $process_name;
		$dataInsert['mobile_number'] = $mobile_number;
		$dataInsert['variables'] = $variables;
		$dataInsert['whatsapp_status'] = $whatsapp_status;
		$dataInsert['send_date'] = $send_date;
		$dataInsert['attempt'] = $attempt;
		$dataInsert['date_created'] = $date_created;
		$dataInsert['date_modified'] = $date_modified;
		$dataInsert['status'] = $status;

		$ProductValue= Maininsertfunc ('xkyknzl5dwfyk4hg_wishfin_whatsapp', $dataInsert);
		$InsertStatus = "1";
}
echo $InsertStatus;
echo "," . $ProductValue;
?>