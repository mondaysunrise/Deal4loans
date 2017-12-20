<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	//print_r($_REQUEST);
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_followup = $_REQUEST['get_followup'];
	//12/23/2008echo $get_fixed_deposit.": ".	$get_requestid."<br>";


	if(strlen(trim($get_requestid))>0)
		{
			$strSQL="";
			$Msg="";

			echo $result = "select RequestID from Req_Loan_Home_Extrafields where RequestID=$get_requestid";
			list($num_rows,$row)=MainselectfuncNew($result,$array = array());

			if($num_rows > 0)
			{
				$dataUpdate = array('Add_Comment'=>$get_comment_section, 'Followup_Date'=>$get_followup);
				$wherecondition = "(RequestID=".$row[0]['RequestID'].")";
				Mainupdatefunc ('Req_Loan_Home_Extrafields', $dataUpdate, $wherecondition);
			}
			else
			{
				$dataUpdate = array('Add_Comment'=>$get_comment_section, 'Followup_Date'=>$get_followup);
				$wherecondition = "(RequestID=".$row[0]['RequestID'].")";
				Mainupdatefunc ('Req_Loan_Home_Extrafields', $dataUpdate, $wherecondition);
			}
			//print_r($dataUpdate);

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