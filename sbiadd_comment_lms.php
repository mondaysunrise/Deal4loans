<?php
    require 'scripts/db_init.php';

	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_bidderid = $_REQUEST['get_bidderid'];
	$get_followup = $_REQUEST['get_followup'];
	$get_asmfollowup = $_REQUEST['get_asmfollowup'];
	//12/23/2008echo $get_fixed_deposit.": ".	$get_requestid."<br>";
if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";
		$result = "select leadid from client_lead_allocate where AllRequestID=".$get_requestid." and BidderID=".$get_bidderid;
		list($num_rows,$row)=MainselectfuncNew($result,$array = array());

		if($num_rows > 0)
		{
			$dataUpdate = array('Followup_Date'=>$get_followup,'Asm_Followup_Date'=>$get_asmfollowup , 'Comments'=>$get_comment_section);
			$wherecondition = "(leadid=".$row[0]['leadid'].")";
			Mainupdatefunc ('client_lead_allocate', $dataUpdate, $wherecondition);
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