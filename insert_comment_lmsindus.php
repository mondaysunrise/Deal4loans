<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_product = $_REQUEST['get_product'];
	$get_bidderid = $_REQUEST['get_bidderid'];

		$strSQL="";
		$Msg="";

		$result = "select indusbnkid from indusbank_exclusive_leads where indusbnkid=$get_requestid";
		list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		if($num_rows > 0)
		{
			$DataArray = array("comment_section"=>$get_comment_section);
			$wherecondition ="(indusbnkid='".$row[0]["indusbnkid"]."')";
		}

	//echo $strSQL;

	Mainupdatefunc ('indusbank_exclusive_leads', $DataArray, $wherecondition);

		echo "insert";	
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}

?>