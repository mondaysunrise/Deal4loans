<?php
require 'scripts/db_init.php';

$camp_email=$_REQUEST["email"];
$camp_uniqueid = $_REQUEST["uniqueid"];
$source = $_REQUEST["source"];

if(strlen($camp_email)>2 && $camp_uniqueid>1)
{
	$Dated = ExactServerdate();
	$dataInsert = array('camp_email'=>$camp_email, 'camp_uniqueid'=>$camp_uniqueid, 'camp_source'=>$source, 'camp_date'=>$Dated);
	$insert = Maininsertfunc ("campaign_pixel_capture", $dataInsert);
}
?>