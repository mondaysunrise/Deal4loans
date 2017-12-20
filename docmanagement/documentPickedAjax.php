<?php 
require_once("includes/application-top-inner.php");
if(empty($_REQUEST['DocSts']))
{$sqlUpdate = "UPDATE " . TABLE_APPT_DOCS . " SET IDProof_Status ='".$_REQUEST['IDProof_Status']."', AddressProof_Status ='".$_REQUEST['AddressProof_Status']."', PanCard_Status ='".$_REQUEST['PanCard_Status']."', SalSlip_Status ='".$_REQUEST['SalSlip_Status']."', BankStmnt_Status ='".$_REQUEST['BankStmnt_Status']."', PassSizePhoto_Status ='".$_REQUEST['PassSizePhoto_Status']."' WHERE id='".$_REQUEST['id']."'";
$Update = $result = $obj->fun_db_query($sqlUpdate);
if($Update==1)
	{
	echo $msg=DOCPICKED;	
	}
}
if($_REQUEST['DocSts'])
{
$sqlUpdate2 = "UPDATE " . TABLE_APPT_DOCS . " SET docStatus ='".$_REQUEST['DocSts']."' WHERE id='".$_REQUEST['id']."'";
$Update2 = $result = $obj->fun_db_query($sqlUpdate2);
if($Update2==1)
{
	echo $msg=DOCSTATUS;	
}
}
?>