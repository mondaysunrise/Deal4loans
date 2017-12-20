<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
	$get_requestid = $_REQUEST['get_requestid'];
	
if(strlen(trim($get_requestid))>0)
	{
		$result = "select Mobile_number from Req_Loan_Personal where RequestID='".$get_requestid."'";
		list($num_rows,$row)=MainselectfuncNew($result,$array = array());

		if($num_rows > 0)
		{
			$Mobile_number = $row[0]['Mobile_number'];
			echo $Mobile_number;
		}
		else
		{
			$Msg = "** Not Found";
		}
	}
?>