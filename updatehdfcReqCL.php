<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$last_inserted_id = $_REQUEST['last_inserted_id'];
	$reward_selected = $_REQUEST['reward_selected'];
	$DataArray = array("reward_selected"=>$reward_selected);
	$wherecondition ="(RequestID='".$last_inserted_id."')";
	Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);
	echo "Thank You for selecting a Reward.";
?>