<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_product = $_REQUEST['get_product'];
	$get_bidderid = $_REQUEST['get_bidderid'];
	//12/23/2008echo $get_fixed_deposit.": ".	$get_requestid."<br>";

if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ("select FeedbackID from Req_Feedback_HL where AllRequestID=".$get_requestid." and BidderID=".$get_bidderid);		
		list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
		if($num_rows > 0)
		{
			
			$strSQL="Update Req_Feedback_HL Set comment_section='".$get_comment_section."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row[$cntr]["FeedbackID"];
		
		  $DataArray = array("comment_section"=>$get_comment_section);
		$wherecondition ="FeedbackID=".$row[$cntr]["FeedbackID"];
		Mainupdatefunc ('Req_Feedback_HL', $DataArray, $wherecondition);
		
		}
		else
		{
		
		$dataInsert = array("AllRequestID"=>$get_requestid, "BidderID"=>$get_bidderid, "Reply_Type"=>$get_product, "comment_section"=>$get_comment_section);
		$table = 'Req_Feedback_HL';
		$insert = Maininsertfunc ($table, $dataInsert);

		
		}

	//echo $strSQL;
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