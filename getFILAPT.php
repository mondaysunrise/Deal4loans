<?php
	require 'scripts/db_init.php';
	//require 'scripts/functions.php';
	$address = '';
	$residence_address = $_REQUEST['residence_address'];
	$address .= $residence_address;
	$office_address = $_REQUEST['office_address'];
	if(strlen($office_address)>0)
	{
		$address .= ", ".$office_address;
	}
	$pincode = $_REQUEST['pincode'];
	if(strlen($pincode)>0)
	{
		$address .= ", ".$pincode;
	}
	
	$RequestIDVal= $_REQUEST['RequestIDVal'];
	$appdate= $_REQUEST['appdate'];
	$changeapp_time=$_REQUEST['changeapp_time'];
	$product = 1;
	

	$checkSql = "select * from fil_appointments where RequestID='".$RequestIDVal."' and Reply_Type=1";
	list($alreadyExist,$myrow)=MainselectfuncNew($checkSql,$array = array());
	$checkNum = $alreadyExist;
	
	if($checkNum>0)
	{
		$Dated = ExactServerdate();
		$DataArray = array("address_apt"=>$address , "appdate"=>$appdate , "changeapp_time"=>$changeapp_time, "Dated"=>$Dated );
		$wherecondition ="(fil_appointments.RequestID=".$RequestIDVal." and  fil_appointments.Reply_Type='1')";
		Mainupdatefunc ('fil_appointments', $DataArray, $wherecondition);
	}
	else
	{
		$Dated = ExactServerdate();
		$data = array("address_apt"=>$address , "RequestID"=>$RequestIDVal , "appdate"=>$appdate , "changeapp_time"=>$changeapp_time , "Reply_Type"=>$product ,  "Dated"=>$Dated );
		$table = 'fil_appointments';
		$insert = Maininsertfunc ($table, $data);
	}

	echo "Our Representative will call and come to you to collect the documents.";
?>