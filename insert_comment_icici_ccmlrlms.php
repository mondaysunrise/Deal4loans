<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_FollowupDate = $_REQUEST['get_FollowupDate'];
			
	if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";
if(strlen($get_comment_section)>0 || strlen($get_FollowupDate)>0)
		{
		$DataArray = array("icici_comment"=>$get_comment_section, "icici_followup_date"=>$get_FollowupDate);
		$wherecondition ="(iciciccid = '".$get_requestid."')";
		Mainupdatefunc ('Req_Loan_Against_Property', $DataArray, $wherecondition);
		}
		

	
		echo "insert";
		
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}
?>