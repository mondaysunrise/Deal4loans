<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$Mobile_No = $_REQUEST['get_Mobile'];
	$requestid=$_REQUEST['get_Id'];
	$old_mobile = $_REQUEST['old_mobile'];


if((strlen($Mobile_No)>9) && ($requestid)>0)
{
	//$UpdatePlSql=ExecQuery("Update Req_Loan_Personal set Landline='".$old_mobile."', Mobile_Number='".$Mobile_No."' Where (Req_Loan_Personal.RequestID='".$requestid."')");
	
	echo "Yes";		
}

?>
