<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$RequestID = $_REQUEST['RequestID'];
		$DataArray = array("sms_not_got"=>'Not Received');
		$wherecondition ="(RequestID = '".$RequestID."')";
		Mainupdatefunc ('Req_Loan_Against_Property', $DataArray, $wherecondition);
	header("Location: apply-loan-against-property-thanks.php");	
	exit();

?>