<?php
require 'scripts/db_init.php';

$hdfcred_email=$_REQUEST["email"];
$hdfcred_uniqueid = $_REQUEST["uniqueid"];

if(strlen($hdfcred_email)>2 && $hdfcred_uniqueid>1)
{
	$Dated = ExactServerdate();
	$data = array("hdfcred_email"=>$address , "hdfcred_email"=>$hdfcred_uniqueid , "Dated"=>$Dated );
	$insert = Maininsertfunc ('hdfcred_pixel_capture', $data);
}
?>