<?php
    require 'scripts/db_init.php';
 	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['requestid'];
	$get_bidderid = $_REQUEST['bidderid'];
	$get_followup = $_REQUEST['FollowupDate'];
	$get_asmfollowup = $_REQUEST['get_asmfollowup'];
	//12/23/2008echo $get_fixed_deposit.": ".	$get_requestid."<br>";
if(strlen(trim($get_requestid))>0)
	{
		$Dated = ExactServerdate();
		$dataInsert = array('RequestID'=>$get_requestid, 'Comments'=>$get_comment_section, 'Dated'=>$Dated, 'Reply_Type'=>'11', 'BidderID'=>$get_bidderid);
		$table = 'client_lead_allocated_comment';
		$insert = Maininsertfunc ($table, $dataInsert);
		
			
		if ($insert)
		{
                   $Msg = "Comment Added";
		}
		else
		{
			$Msg = "** There was a problem in adding your Comment. Please try again.";
		}
                echo $Msg;
	}
?>