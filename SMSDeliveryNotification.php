<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
	
	$awackid = $_REQUEST['a2wackid'];
	$custref = $_REQUEST['custref'];
	$submitdt = $_REQUEST['submitdt'];
	$lastutime = $_REQUEST['lastutime'];
	$a2wstatus = $_REQUEST['a2wstatus'];
	$carrierstatus = $_REQUEST['carrierstatus'];
	$mnumber = $_REQUEST['mnumber'];
    $Dated = ExactServerdate();	

	// $SMSMessage = "test..".$mnumber;
	//$mobile_no = "9971396361";
	//	SendSMS($SMSMessage, $mobile_no);
		
		
	$sqlSelect = "select * from sws_acknowledgement where a2wackid = '".$awackid."'";
	list($NumRows,$getrow)=MainselectfuncNew($sqlSelect,$array = array());
	//$cntr=0;
	//$querySelect = ExecQuery($sqlSelect);
	//$NumRows = mysql_num_rows($querySelect);
	if($NumRows>0)
	{
		///$sql = "update sws_acknowledgement set custref = '".$custref."', submitdt = '".$submitdt."', lastutime = '".$lastutime."', a2wstatus = '".$a2wstatus."', carrierstatus = '".$carrierstatus."', mnumber = '".$mnumber."', dated = Now() where (a2wackid = '".$awackid."')";
		$DataArray = array("custref"=>$custref, "submitdt"=>$submitdt, "lastutime"=>$lastutime, "a2wstatus"=>$a2wstatus, "carrierstatus"=>$carrierstatus, "mnumber"=>$mnumber, "dated"=>$Dated);
		$wherecondition ="(a2wackid = '".$awackid."')";
		Mainupdatefunc ('sws_acknowledgement', $DataArray, $wherecondition);
	
	}
	else
	{
		//$sql = "INSERT INTO `sws_acknowledgement` ( `a2wackid` , `custref` , `submitdt` , `lastutime` , `a2wstatus` , `carrierstatus` , `mnumber` , `status` , `dated` ) VALUES ('".$awackid."', '".$custref."', '".$submitdt."', '".$lastutime."', '".$a2wstatus."', '".$carrierstatus."', '".$mnumber."', '1', Now())";
	
	$dataInsert = array("a2wackid"=>$awackid , "custref"=>$custref , "submitdt"=>$submitdt , "lastutime"=>$lastutime , "a2wstatus"=>$a2wstatus, "carrierstatus"=>$carrierstatus , "mnumber"=>$mnumber , "status"=>1 , "dated"=>$Dated);
		$table = 'sws_acknowledgement';
		$insert = Maininsertfunc ($table, $dataInsert);
	
	}
	//echo $sql;
	//ExecQuery($sql);
	
?>
