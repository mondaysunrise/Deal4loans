<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_product = $_REQUEST['get_product'];
	$get_bidderid = $_REQUEST['get_bidderid'];
	$get_exec_name = $_REQUEST['get_exec_name'];
	$get_followup = $_REQUEST['get_followup'];
	
if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ("select FeedbackID from Req_Feedback where AllRequestID=$get_requestid and BidderID=".$get_bidderid);		
		//$num_rows = mysql_num_rows($result);
	 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;	
		
		if($num_rows > 0)
		{
			//$row = mysql_fetch_array($result);
			//$strSQL="Update Req_Feedback Set comment_section='".$get_comment_section."', axis_executive_name='".$get_exec_name."'";
			//$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		
		$DataArray = array("comment_section"=>$get_comment_section, "axis_executive_name"=>$get_exec_name, "Followup_Date"=>$get_followup);
		$wherecondition ="FeedbackID=".$row[$cntr]["FeedbackID"];
		Mainupdatefunc ('Req_Feedback', $DataArray, $wherecondition);
        
		
		}
		else
		{
			//$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , comment_section, axis_executive_name) Values (";
			//$strSQL=$strSQL.$get_requestid.",".$get_bidderid.",".$get_product.",'".$get_comment_section."','".$get_exec_name."')";
			$dataInsert = array("AllRequestID"=>$get_requestid, "BidderID"=>$get_bidderid, "Reply_Type"=>$get_product, "comment_section"=>$get_comment_section, "axis_executive_name"=>$get_exec_name, "Followup_Date"=>$get_followup);
$table = 'Req_Feedback';
$insert = Maininsertfunc ($table, $dataInsert);
  
			
		}

	//echo $strSQL;
	//	$result = ExecQuery($strSQL);
		echo "insert";	
		if ($insert == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}
?>