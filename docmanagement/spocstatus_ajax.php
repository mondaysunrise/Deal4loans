<?php
require_once("includes/application-top-inner.php");
	$sqlUpdate = "UPDATE " . TABLE_APPT_DOCS . " SET spoc_status ='".$_REQUEST['ppval']."', updated_date=Now()  WHERE id='".$_REQUEST['id']."'";
	$Update = $result = $obj->fun_db_query($sqlUpdate);
	if($Update==1)
	{
	echo "Done";	
	}
?>