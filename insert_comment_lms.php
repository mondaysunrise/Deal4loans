<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$currentdate = date('Y-m-d H:i:s');
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_product = $_REQUEST['get_product'];
	$get_bidderid = $_REQUEST['get_bidderid'];
	$get_followup = $_REQUEST['get_followup'];
	//12/23/2008echo $get_fixed_deposit.": ".	$get_requestid."<br>";
if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";

		$result = "select FeedbackID from Req_Feedback where AllRequestID=$get_requestid and BidderID=".$get_bidderid;
		list($num_rows,$row)=MainselectfuncNew($result,$array = array());

		if($num_rows > 0)
		{
			$dataUpdate = array('comment_section'=>$get_comment_section, 'Followup_Date'=>$get_followup, 'last_update_dated'=>$currentdate);
			$wherecondition = "(FeedbackID=".$row[0]['FeedbackID'].")";
			Mainupdatefunc ('Req_Feedback', $dataUpdate, $wherecondition);
		}
		else
		{
			$Dated = ExactServerdate();
			$data = array("AllRequestID"=>$get_requestid , "BidderID"=>$get_bidderid , "Reply_Type"=>$get_product , "comment_section"=>$get_comment_section , "Followup_Date"=>$get_followup, "last_update_dated"=>$currentdate);
			$table = 'Req_Feedback';
			$insert = Maininsertfunc ($table, $data);
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
