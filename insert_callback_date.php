<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$Followup_Date = $_REQUEST['Followup_Date'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_product = $_REQUEST['get_product'];
	$get_bidderid = $_REQUEST['get_bidderid'];
	//12/23/2008echo $get_fixed_deposit.": ".	$get_requestid."<br>";


if(strlen(trim($get_requestid))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ("select FeedbackID from Req_Feedback where AllRequestID=$get_requestid and BidderID=".$get_bidderid);		
		 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		//$cntr=0;
		
		//$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			
			//$strSQL="Update Req_Feedback Set Followup_Date='".$Followup_Date."' ";
			//$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
			$DataArray = array("Followup_Date"=>$Followup_Date, "Loan_Disbursed"=>$loan_disbursed);
			$wherecondition ="FeedbackID=".$row['FeedbackID'];
			Mainupdatefunc ('Req_Feedback', $DataArray, $wherecondition);
		}
		else
		{
			//$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Followup_Date) Values (";
			//$strSQL=$strSQL.$get_requestid.",".$get_bidderid.",".$get_product.",'".$Followup_Date."')";
		
		$dataInsert = array("AllRequestID"=>$get_requestid , "BidderID"=>$get_bidderid , "Reply_Type"=>$get_product , "Followup_Date"=>$Followup_Date );
		$table = 'Req_Feedback';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		}

	//echo $strSQL;
		//$result = ExecQuery($strSQL);
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