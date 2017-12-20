<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$plrequestid= $_REQUEST["plrequestid"];
$reference_code= $_REQUEST["reference_code"];
$activation_code= $_REQUEST["activation_code"];
$Employment_Status = $_REQUEST["Employment_Status"];
$City = $_REQUEST["City"];

if($reference_code == $activation_code)
{
	$Is_Valid =1;
}
else
{
	$Is_Valid =0;
}

if($plrequestid>0)
{
	$DataArray = array("Is_Valid"=>$Is_Valid);
	$wherecondition ="(RequestID='".$plrequestid."'))";
	Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);

	$filename = "Contents_Personal_Loan_Mustread.php?id=".$last_inserted_id;
	header("Location: $filename");
	exit();
}
?>