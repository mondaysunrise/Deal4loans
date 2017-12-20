<?php
require_once("includes/application-top-inner.php");
//print_r($_POST);

$toActivate = $_POST['toActivate'];
$leadidentifier=$_POST['leadidentifier'];//'plmainlms';
print_r($toActivate);
$toActivateStr = implode(',', $toActivate);
if($leadidentifier=="plmainlms")
{
	$updateSql = "update Bidders set CallStatus=0 where leadidentifier='".$leadidentifier."' and BidderID !=2748";
}
else 
{
	$updateSql = "update Bidders set CallStatus=0 where leadidentifier='".$leadidentifier."'";
}
$resultUpdate = $obj->fun_db_query($updateSql);

 $updateSqlCallStatus = "update Bidders set CallStatus=1 where leadidentifier='".$leadidentifier."' and BidderID in (".$toActivateStr.")";
$resultCallStatus = $obj->fun_db_query($updateSqlCallStatus);

//die();
if($leadidentifier=="plmainlms")
{
	header("Location:edit_main_lms_number.php?msg=done");
}
else if($leadidentifier=="plmainlms79")
{
	header("Location:edit_evening_lms_number.php?msg=done");
}
else if($leadidentifier=="plmainlmsS")
{
	header("Location:edit_sunday_lms_number.php?msg=done");
}


exit;
?>