<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_bankAppRej = $_REQUEST['get_bankAppRej'];
	$get_requestid = $_REQUEST['get_requestid'];
	
if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";

		$row = mysql_fetch_array($result);
		$strSQL="Update Req_Partner_PL Set Bank_Approval='".$get_bankAppRej."' ";
		$strSQL=$strSQL."Where RequestID=".$get_requestid;
	//echo $strSQL;
		$result = ExecQuery($strSQL);
		echo "insert";	
	}

?>