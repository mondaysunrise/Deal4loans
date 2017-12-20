<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];

if(strlen(trim($get_requestid))>0)
	{
		$$strSQL="";
		$Msg="";

		$result = "select hdfcplid from hdfc_pl_calc_leads where (hdfcplid=".$get_requestid.")";
		list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		if($num_rows > 0)
		{
			$DataArray = array("hdfc_add_comment"=>$get_comment_section);
			$wherecondition ="(hdfcplid='".$row[0]["hdfcplid"]."')";
			Mainupdatefunc ('hdfc_pl_calc_leads', $DataArray, $wherecondition);
		}
		
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