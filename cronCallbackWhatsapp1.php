<?php
require 'scripts/db_init.php';
   function FixString($strtofix){
	/** ESCAPES SPECIAL CHARACTERS FOR INSERTING INTO SQL **/
	if (get_magic_quotes_gpc()) { $addslash="no"; } else { $addslash="yes"; }
	if ($addslash == "yes") {  $strtofix = addslashes($strtofix); }
	$strtofix = ereg_replace(  "<", "&#60;", $strtofix );
	$strtofix = ereg_replace(  "'", "&#39;", $strtofix );
	$strtofix = ereg_replace(  "(\n)", "<BR>", $strtofix );
	return $strtofix;
   }

$id = $_REQUEST['id'];
$mobile_number = $_REQUEST['mobile_number'];
$to_or_from = $_REQUEST['to_or_from'];
$message_id = $_REQUEST['message_id'];
$message_status = $_REQUEST['message_status'];
$message_text = $_REQUEST['message_text'];
$message_media_file = $_REQUEST['message_media_file'];
$message_media_mime_type = $_REQUEST['message_media_mime_type'];
$message_media_status = $_REQUEST['message_media_status'];
$message_media_url = $_REQUEST['message_media_url'];
$timestamp = $_REQUEST['timestamp'];
$request_data = $_REQUEST['request_data'];
$type = $_REQUEST['type'];
$unique_id = $_REQUEST['unique_id'];
$date_created = $_REQUEST['date_created'];
$date_modified = $_REQUEST['date_modified'];     

$id = 1;
$getdetails = "select id From xkyknzl5dwfyk4hg_whatsapp_callback Where (id='".$id."')";
list($alreadyExist, $myrow) = MainselectfuncNew($getdetails, $array = array());
$myrowcontr = count($myrow) - 1;

if ($alreadyExist > 0) 
{
    $ProductValue = $myrow[$myrowcontr]["id"];
    $InsertStatus = "2";
} else {
		$dataInsert = '';
		$dataInsert['id'] = $id;
		$dataInsert['mobile_number'] = $mobile_number;
		$dataInsert['to_or_from'] = $to_or_from;
		$dataInsert['message_id'] = FixString($message_id);
		$dataInsert['message_status'] = FixString($message_status);
		$dataInsert['message_text'] = FixString($message_text);
		$dataInsert['message_media_file'] = FixString($message_media_file);
		$dataInsert['message_media_mime_type'] = FixString($message_media_mime_type);
		$dataInsert['message_media_status'] = FixString($message_media_status);
		$dataInsert['message_media_url'] = FixString($message_media_url);
		$dataInsert['timestamp'] = FixString($timestamp);
		$dataInsert['request_data'] = FixString($request_data);
		$dataInsert['type'] = FixString($type);
		$dataInsert['unique_id'] = FixString($unique_id);
		$dataInsert['date_created'] = FixString($date_created);
		$dataInsert['date_modified'] = FixString($date_modified);
		//echo "<pre>";
		print_r($dataInsert);
		//echo "<br>";
	//	$ProductValue= Maininsertfunc ('xkyknzl5dwfyk4hg_whatsapp_callback', $dataInsert);
		$InsertStatus = "1";
}
echo $InsertStatus;
echo "," . $ProductValue;

?>