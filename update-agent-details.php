<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	//require 'scripts/functions.php';
	
	$agentid= $_REQUEST["request"];
	$followdate = $_REQUEST["followupdate"];
	$addcomment =$_REQUEST["comment"];

	//if(isset($followdate) || isset($addcomment))
	//{
		$query="update Req_Agent set A_FollowupDate='$followdate',A_Comment='$addcomment' where A_ID=$agentid";
		//echo $query;
		ExecQuery($query);
	//}
	

?>