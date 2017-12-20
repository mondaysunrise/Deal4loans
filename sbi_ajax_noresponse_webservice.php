<?php
require_once 'scripts/db_init.php';
require_once 'webservices_functions1.php';

if($_POST['method'] == 'SendSBI'){
	$log_id = $_POST['log_id'];
		
	$webserviceObj = new Webservices();
	$serviceResponse = $webserviceObj->SBIWebserviceNoResponse($log_id);
	
	echo '<pre>'; print_r($serviceResponse);
	exit;
}

?>	
