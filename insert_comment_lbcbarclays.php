<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_product = $_REQUEST['get_product'];
	$get_bidderid = $_REQUEST['get_bidderid'];

	$eligible = $_REQUEST['get_eligible'];
	$interest_stat = $_REQUEST['get_interest'];
	$post_login = $_REQUEST['get_post_login'];
	$feedback =$_REQUEST['get_fedback'];
	$Dated = ExactServerdate();
			

if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";
//echo $SQL = "select FeedbackID from Req_Feedback where AllRequestID=".$get_requestid." and BidderID='".$get_bidderid."' and Reply_Type=100";
		$result = ("select FeedbackID from Req_Feedback where AllRequestID=".$get_requestid." and BidderID='".$get_bidderid."' and Reply_Type=100");		
		//$num_rows = mysql_num_rows($result);
		 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
		
		if($num_rows > 0)
		{
			//$row = mysql_fetch_array($result);
			//$strSQL="Update Req_Feedback Set Feedback='".$feedback."',comment_section='".$get_comment_section."',eligible =".$eligible.",interest_stat=".$interest_stat.", post_login_stat='".$post_login."' , last_update_dated =CURDATE() ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
			
			$DataArray = array("Feedback"=>$feedback, "comment_section"=>$get_comment_section, "eligible"=>$eligible, "interest_stat"=>$interest_stat, "post_login_stat"=>$post_login, "last_update_dated"=>$Dated);
			$wherecondition ="FeedbackID=".$row[$cntr]["FeedbackID"];
			Mainupdatefunc ('Req_Feedback', $DataArray, $wherecondition);
        
			
		}
		else
		{
			//$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , comment_section,eligible,interest_stat,post_login_stat, last_update_dated,Feedback) Values (";
			//$strSQL=$strSQL.$get_requestid.",".$get_bidderid.",".$get_product.",'".$get_comment_section."','".$eligible."','".$interest_stat."','".$post_login."', CURDATE(),'".$feedback."')";
		
		$dataInsert = array("AllRequestID"=>$get_requestid, "BidderID"=>$get_bidderid, "Reply_Type"=>$get_product, "comment_section"=>$get_comment_section, "eligible"=>$eligible, "interest_stat"=>$interest_stat, "post_login_stat"=>$post_login, "last_update_dated"=>$Dated, "Feedback"=>$feedback);
$table = 'Req_Feedback';
$insert = Maininsertfunc ($table, $dataInsert);
		
		}
//echo "<br>";
	//echo $strSQL;
	//	$result = ExecQuery($strSQL);
			
		if ($result == 1)
		{
			echo "insert";
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}
?>
