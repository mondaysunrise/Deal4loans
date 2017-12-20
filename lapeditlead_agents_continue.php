<?php
//require 'scripts/session_check_onlinelms.php';
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
	
	if($submit_appdt=="Save")
	{
		$callerid = FixString($_POST["callerid"]);
		$plrequestid = FixString($_POST["plrequestid"]);
		//$Final_Bidder = FixString($_POST["Final_Bidder"]);
		$Final_Bidder = $callerid;
		$Bidder_Number = FixString($_POST["Bidder_Number"]);	
		$special_remarks = FixString($_POST["special_remarks"]);	
		$appointment_date = FixString($_POST["appointment_date"]);	
		$appointment_time = FixString($_POST["appointment_time"]);	
		$pl_IDProof = $_REQUEST["IDProof"];
		$pl_AddProof = $_REQUEST["AddressProof"];
		$pl_PanCard = $_REQUEST["PanCard"];
		$pl_SalSlip = implode(',',$_REQUEST["SalSlip"]);//
		$pl_BankStmnt = implode(',',$_REQUEST["BankStmnt"]);//
		$pl_PassSizePhoto = $_REQUEST["PassSizePhoto"];
		$reschedule = $_REQUEST['reschedule'];
		$Address = $_POST["Address"];
		$productid = 5;
	//	echo $Final_Bidder." RequestID - ".$plrequestid." Remarks - ".$special_remarks." Time - ".$appointment_time." Date - ".$appointment_date;
		 $GetBank_Sql = "select leadlogid from zexternal_leadallocation_log where (BidderID = ".$Final_Bidder ." and RequestID=".$plrequestid." and ProductID=5)";
		$GetBank_Query = ExecQuery($GetBank_Sql);
		$numGetBank = mysql_num_rows($GetBank_Query);
		if($numGetBank>0)
		{
			$leadlogid = mysql_result($GetBank_Query,0,'leadlogid');
			$toInsert = 0;
			$rescheduled = 1;
		}
		else
		{
			$toInsert = 1;
			$rescheduled = 0;
			$sqlinstqry="INSERT INTO zexternal_leadallocation_log(BidderID , ProductID , bidder_number , Sendnow_Date , RequestID, CallerID) VALUES ('".$Final_Bidder."', '".$productid."', '".$Bidder_Number."', Now(), '".$plrequestid."','".$callerid."')";
			$sqlinstqryresult=ExecQuery($sqlinstqry);
			$leadlogid = mysql_insert_id();
			
		}	
		if($Final_Bidder>0 && $plrequestid>0 && ((strlen($special_remarks)>1) || strlen($appointment_time)>1 || $appointment_date!=''))
		{
			$updateSql = ExecQuery("update zexternal_appointment_docs set viewstatus=0 where RequestID='".$plrequestid."'");
			$appdetailsqry="INSERT INTO zexternal_appointment_details (`AllRequestID`, `caller_id`, `BidderID`, `appt_date`, `appt_time`, `special_remarks`,`Flag`, `stat_dated`, ProductID, Bidder_Number, IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto,  leadlogid) VALUES ('".$plrequestid."', '".$callerid."', '".$Final_Bidder."', '".$appointment_date."', '".$appointment_time."', '".$special_remarks."', '1', Now(),'5' ,'".$Bidder_Number."', '".$pl_IDProof."', '".$pl_AddressProof."', '".$pl_PanCard."', '".$pl_SalSlip."', '".$pl_BankStmnt."', '".$pl_PassSizePhoto."', '".$leadlogid."')";
			$appdetailsqryResultPL = ExecQuery($appdetailsqry);
			$apptdetailsid = mysql_insert_id();

//Get City	
$QuryReqPL = "select City, City_Other from Req_Loan_Personal where RequestID='".$plrequestid."'";
$queryReqPL1 = ExecQuery($QuryReqPL);
$plcity= mysql_result($queryReqPL1,0,'City');
$plcity_other= mysql_result($queryReqPL1,0,'City_Other');
if($plcity=='Others'){
            $CityVal = $plcity_other;
        }else{
            $CityVal = $plcity;
        }		
			$appDocsqry="INSERT INTO zexternal_appointment_docs (`RequestID`, `caller_id`, CityName, Reply_Type,  IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto,  leadlogid, `appt_date`, `appt_time`, `special_remarks`, dated, updated_date,rescheduled, Address,viewstatus) VALUES ('".$plrequestid."', '".$callerid."', ".$CityVal."', '5', '".$pl_IDProof."', '".$pl_AddressProof."', '".$pl_PanCard."', '".$pl_SalSlip."', '".$pl_BankStmnt."', '".$pl_PassSizePhoto."', '".$leadlogid."', '".$appointment_date."', '".$appointment_time."', '".$special_remarks."', Now(), Now(), '".$rescheduled."', '".$Address."', '1')";
			
			$appDocsqryResultPL = ExecQuery($appDocsqry);			
			//$productval = last_insert_id();
			echo "Appointment successfully Saved";
			
		}
	}
	else
	{
		echo "Sorry for Inconvenience";
	}
	header("Location: lapeditlead_agents.php?id=".$plrequestid."&Bid=".$callerid);
	exit();
}
?>