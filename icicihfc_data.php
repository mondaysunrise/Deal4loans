<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$Sql1 = "select * from Req_Feedback_Bidder1 where Reply_Type=2 and ( Allocation_Date between between '2009-03-01 00:00:00' and '2009-08-25 23:59:59') ";
	
?>