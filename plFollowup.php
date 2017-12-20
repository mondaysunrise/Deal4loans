<?php
require 'scripts/db_init.php';
//require 'scripts/functions.php';
//error_reporting(0);

	$lead_id =$_REQUEST['lead_id'];
	$contacted =$_REQUEST['contacted'];
	$FollowupDate = $_REQUEST['FollowupDate'];
	$feedback =$_REQUEST['feedback'];
	$bidder_id = $_REQUEST['bidder_id'];
	$fbidder_id = $_REQUEST['fbidder_id'];
	$Dated = ExactServerdate();
	
	$retrieve_query="select Allocation_Date from Req_Feedback_Bidder1 where AllRequestID=".$lead_id." and Reply_Type=1";
//echo $retrieve_query."<br>";

 	list($recordcount,$getrow)=MainselectfuncNew($retrieve_query,$array = array());
	$cntr=0;
	$lead_date = $getrow[$cntr]['Allocation_Date'];
	

//	$getLeadSql = "select * from Req_Loan_Personal where RequestID = '".$lead_id."'";
	//$getLeadQuery = ExecQuery($getLeadSql);
	
	
	
	$checkSql = "select * from pl_feedback where lead_id='".$lead_id."' and bidder_id = '".$bidder_id."'";
	list($numRows,$Myrow)=MainselectfuncNew($checkSql,$array = array());
	
	if($numRows>0)
	{
	//update
		$DataArray = array("feedback"=>$feedback, "followupdate"=>$FollowupDate, "update_date"=>$Dated);
		$wherecondition ="lead_id='".$lead_id."' and bidder_id = '".$bidder_id."'";
		Mainupdatefunc ('pl_feedback', $DataArray, $wherecondition);
		
	}
	else
	{
	//insert
	
	$dataInsert = array("lead_id"=>$lead_id, "bidder_id"=>$bidder_id, "contacted"=>$contacted, "followupdate"=>$FollowupDate, "dated"=>$Dated, "lead_date"=>$lead_date, "fbidder_id"=>$fbidder_id);
	$table = 'pl_feedback';
	$insert = Maininsertfunc ($table, $dataInsert);
	
	}
	
	echo "Saved";
	
?>