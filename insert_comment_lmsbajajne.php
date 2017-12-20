<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_feedbackid'];
	
	if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ("select FeedbackID from Req_Feedback_HL where (FeedbackID =".$get_requestid." and BidderID in (732,812,460,207))");	
		list($num_rows,$row)=Mainselectfunc($result,$array = array());

		
		if($num_rows > 0)
		{
			$DataArray = array("comment_section"=>$get_comment_section);
			$wherecondition ="(FeedbackID = '".$row["FeedbackID"]."')";
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