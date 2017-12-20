<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

	$get_app_address = $_REQUEST['get_app_address'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_app_time = $_REQUEST['get_app_time'];
	$get_bidderid = $_REQUEST['get_bidderid'];
	$get_FollowupDate = $_REQUEST['get_FollowupDate'];
	$Dated = ExactServerdate();
			
	if(strlen(trim($get_requestid))>0)
	{
		
		$strSQLappt="";
		$Msgapt="";
		$resultappt = ("select ApptID from ICICI_CCAppt_Details where (AllRequestID=".$get_requestid." and BidderID=".$get_bidderid." AND Reply_Type=4)");
		
list($num_rows,$rowapt)=MainselectfuncNew($resultappt,$array = array());

		if($num_rows > 0)
		{
		
			
			$DataArray = array("Appt_Address"=>$get_app_address , "Appt_Date"=>$get_FollowupDate , "Appt_Time"=>$get_app_time, "Appt_Dated"=>$Dated );
			$wherecondition ="(ApptID=".$rowapt["ApptID"].")";
			Mainupdatefunc ('ICICI_CCAppt_Details', $DataArray, $wherecondition);
		}
		else
		{
				$Dated = ExactServerdate();
		$data = array("AllRequestID"=>$get_requestid , "BidderID"=>$get_bidderid , "Reply_Type"=>"4" , "Appt_Address"=>$get_app_address , "Appt_Date"=>$get_FollowupDate , "Appt_Time"=>$get_app_time ,  "Appt_Dated"=>$Dated );
		$table = 'ICICI_CCAppt_Details';
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