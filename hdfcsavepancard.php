<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$RequestID = $_REQUEST['RequestID'];
$validate_pan = $_REQUEST['validate_pan'];

if($RequestID>0)
{
	$updateSql = "update req_hdfc_lead set valid_pan='".$validate_pan."' where RequestID='".$RequestID."'";
	$updateQuery = mysql_query($updateSql);
	if($validate_pan==1)
	{
		$update_Sql = "update req_hdfc_lead set send_mail ='1' where RequestID='".$RequestID."'";
		$update_Query = mysql_query($update_Sql);
		
		echo "Validated";
		
	}
	else if($validate_pan==0)
	{
		echo "Not Validated";
	}
	
}
?>