<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_comment_section = $_REQUEST['comment_section'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_product = $_REQUEST['get_product'];
	$get_bidderid = $_REQUEST['get_bidderid'];

		$strSQL="";
		$Msg="";

		$result = ("select hdfcbtid from hdfc_balance_transfer_leads where hdfcbtid=$get_requestid");		
		list($num_rows,$row)=Mainselectfunc($result,$array = array());
		if($num_rows > 0)
		{
			$DataArray = array("comment_section"=>$get_comment_section);
			$wherecondition ="(hdfcbtid = '".$row["hdfcbtid"]."')";
			Mainupdatefunc ('hdfc_balance_transfer_leads', $DataArray, $wherecondition);
		
		}

	//echo $strSQL;
		
		echo "insert";	
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}

?>