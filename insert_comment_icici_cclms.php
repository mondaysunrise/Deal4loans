<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_product = $_REQUEST['get_product'];
	$get_bidderid = $_REQUEST['get_bidderid'];
	$get_FollowupDate = $_REQUEST['get_FollowupDate'];
			
	if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ("select FeedbackID from Req_Feedback_CC where AllRequestID=$get_requestid and BidderID=".$get_bidderid);		list($num_rows,$row)=Mainselectfunc($result,$array = array());	
	
		if($num_rows > 0)
		{
			$DataArray = array("comment_section"=>$get_comment_section, "Followup_Date"=>$get_FollowupDate);
			$wherecondition ="(FeedbackID = '".$row["FeedbackID"]."')";
			Mainupdatefunc ('Req_Feedback_CC', $DataArray, $wherecondition);
		}
		else
		{
			$DataArray = array("AllRequestID"=>$get_requestid, "BidderID"=>$get_bidderid, "Reply_Type"=>$get_product, "comment_section"=>$get_comment_section, "Followup_Date"=>$get_FollowupDate);
			$table = 'Req_Feedback_CC';
			$lastID = Maininsertfunc ($table, $DataArray);
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