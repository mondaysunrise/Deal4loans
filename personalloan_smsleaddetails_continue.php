<?php
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
include "leadallocation_pl_smsapp.php";
session_start();

//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
	$submit_appdt = FixString($_POST["submit_appdt"]);
	$submit = FixString($_POST["submit"]);
	
	if($submit=="Send Now")
	{
		
	$callerid = FixString($_POST["callerid"]);
	$reqcity = FixString($_POST["reqcity"]);
	$plrequestid = FixString($_POST["plrequestid"]);
	$Final_Bidder = FixString($_POST["Final_Bidder"]);
	$Bidder_Number = FixString($_POST["Bidder_Number"]);
	$productid=1;
	
	$GetBank_Sql = "select leadlogid from smsapp_leadallocation_log where (BidderID  = ".$Final_Bidder ." and RequestID=".$plrequestid." and ProductID=1)";
	$GetBank_Query = ExecQuery($GetBank_Sql);
	$leadlogid = mysql_result($GetBank_Query,0,'leadlogid');
	if($leadlogid>0)
	{
		echo "lead is Already sent";
	}
	else
	{
	if($plrequestid>0 && $Final_Bidder>0 && $Bidder_Number>0 && $callerid>0)
	{
		$sqlinstqry="INSERT INTO smsapp_leadallocation_log(BidderID , ProductID , bidder_number , Sendnow_Date , RequestID, CallerID) VALUES ('".$Final_Bidder."', '".$productid."', '".$Bidder_Number."', Now(), '".$plrequestid."','".$callerid."')";
		$sqlinstqryresult=ExecQuery($sqlinstqry);
		$ProductValue = mysql_insert_id();
		
		//feedback table
		$InsertFeedBackSqlPL = "Insert into Req_Feedback_Bidder_PL1 (AllRequestID, BidderID, Reply_Type, Allocation_Date, Consent, final_allocate) Values ('".$plrequestid."', '".$Final_Bidder."','".$productid."', Now(),'1','1')";
		$InsertFeedBackResultPL = ExecQuery($InsertFeedBackSqlPL);

		$GetBank_Sql = "select statid from smspl_status_details where (BidderID  = ".$Final_Bidder." and `AllRequestID`=".$plrequestid." and ProductID=1)";
		$GetBank_Query = ExecQuery($GetBank_Sql);
		$statid = mysql_result($GetBank_Query,0,'statid');
		if($statid>0)
		{	
			$appdetailsqry="update smspl_status_details set Bidder_Number='".$Bidder_Number."',leadlogid='".$ProductValue."' Where (BidderID  = ".$Final_Bidder." and `AllRequestID`=".$plrequestid." and ProductID=1)";
		}
		else
		{
			$appdetailsqry="INSERT INTO smspl_status_details (`AllRequestID`, `caller_id`, `BidderID`,`Flag`, `stat_dated`, ProductID, Bidder_Number, leadlogid) VALUES ('".$plrequestid."', '".$callerid."', '".$Final_Bidder."', '1', Now(),'1' ,'".$Bidder_Number."','".$ProductValue."')";
		}
		$appdetailsqryResultPL = ExecQuery($appdetailsqry);

		$allocatesource = "SMS_Lead_Appointment_Model";
		leadallocation($plrequestid, $reqcity, $allocatesource);
		$leadsent="Send now";
	}
	}
if($leadsent=="Send now")
	{
echo "lead is successfully sent";
	}
	}
	elseif($submit_appdt=="Save")
	{
		$callerid = FixString($_POST["callerid"]);
		$plrequestid = FixString($_POST["plrequestid"]);
		$Final_Bidder = FixString($_POST["Final_Bidder"]);
		$Bidder_Number = FixString($_POST["Bidder_Number"]);	
		$special_remarks = FixString($_POST["special_remarks"]);	
		$appointment_date = FixString($_POST["appointment_date"]);	
		$appointment_time = FixString($_POST["appointment_time"]);	
		
		if($Final_Bidder>0 && $plrequestid>0 && ((strlen($special_remarks)>1) || strlen($appointment_time)>1 || $appointment_date!=''))
		{

	$GetBank_Sql = "select statid from smspl_status_details where (BidderID  = ".$Final_Bidder." and `AllRequestID`=".$plrequestid." and ProductID=1)";
	$GetBank_Query = ExecQuery($GetBank_Sql);
	$statid = mysql_result($GetBank_Query,0,'statid');
	if($statid>0)
	{
		$appdetailsqry="update smspl_status_details set appt_date='".$appointment_date."', appt_time='".$appointment_time."', special_remarks='".$special_remarks."', Bidder_Number='".$Bidder_Number."' Where (BidderID  = ".$Final_Bidder." and `AllRequestID`=".$plrequestid." and ProductID=1)";
	}
	else
	{
		$appdetailsqry="INSERT INTO smspl_status_details (`AllRequestID`, `caller_id`, `BidderID`, `appt_date`, `appt_time`, `special_remarks`,`Flag`, `stat_dated`, ProductID, Bidder_Number) VALUES ('".$plrequestid."', '".$callerid."', '".$Final_Bidder."', '".$appointment_date."', '".$appointment_time."', '".$special_remarks."', '1', Now(),'1' ,'".$Bidder_Number."')";
		
	}
		$appdetailsqryResultPL = ExecQuery($appdetailsqry);
		$productval = last_insert_id();
		echo "Changes are successfully Saved";
		}
	}
	else
	{
		echo "Sorry for Inconvenience";
	}
}
?>