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
	
	$GetBank_Sql = "select leadlogid from zexternal_leadallocation_log where (BidderID  = ".$Final_Bidder ." and RequestID=".$plrequestid." and ProductID=1)";
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
		$sqlinstqry="INSERT INTO zexternal_leadallocation_log(BidderID , ProductID , bidder_number , Sendnow_Date , RequestID, CallerID) VALUES ('".$Final_Bidder."', '".$productid."', '".$Bidder_Number."', Now(), '".$plrequestid."','".$callerid."')";
		$sqlinstqryresult=ExecQuery($sqlinstqry);
		$ProductValue = mysql_insert_id();
	//	echo "<br>".$sqlinstqry.'<br>';	
		//feedback table
		$InsertFeedBackSqlPL = "Insert into Req_Feedback_Bidder_PL1 (AllRequestID, BidderID, Reply_Type, Allocation_Date, Consent, final_allocate) Values ('".$plrequestid."', '".$Final_Bidder."','".$productid."', Now(),'1','1')";
	//	$InsertFeedBackResultPL = ExecQuery($InsertFeedBackSqlPL);
		//echo "<br>".$InsertFeedBackSqlPL.'<br>';	
		$allocatesource = "BL_Lead_Appointment_Model";
		//leadallocation($plrequestid, $reqcity, $allocatesource);
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
		$pl_IDProof = $_REQUEST["IDProof"];
		$pl_AddProof = $_REQUEST["AddressProof"];
		$pl_PanCard = $_REQUEST["PanCard"];
		$pl_SalSlip = $_REQUEST["SalSlip"];
		$pl_BankStmnt = $_REQUEST["BankStmnt"];
		$pl_PassSizePhoto = $_REQUEST["PassSizePhoto"];
	//	echo $Final_Bidder." RequestID - ".$plrequestid." Remarks - ".$special_remarks." Time - ".$appointment_time." Date - ".$appointment_date;
	$GetBank_Sql = "select leadlogid from zexternal_leadallocation_log where (BidderID  = ".$Final_Bidder ." and RequestID=".$plrequestid." and ProductID=1)";
	$GetBank_Query = ExecQuery($GetBank_Sql);
	$leadlogid = mysql_result($GetBank_Query,0,'leadlogid');
		if($Final_Bidder>0 && $plrequestid>0 && ((strlen($special_remarks)>1) || strlen($appointment_time)>1 || $appointment_date!=''))
		{
			
			$appdetailsqry="INSERT INTO zexternal_appointment_details (`AllRequestID`, `caller_id`, `BidderID`, `appt_date`, `appt_time`, `special_remarks`,`Flag`, `stat_dated`, ProductID, Bidder_Number, IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto,  leadlogid) VALUES ('".$plrequestid."', '".$callerid."', '".$Final_Bidder."', '".$appointment_date."', '".$appointment_time."', '".$special_remarks."', '1', Now(),'1' ,'".$Bidder_Number."', '".$IDProof."', '".$AddressProof."', '".$PanCard."', '".$SalSlip."', '".$BankStmnt."', '".$PassSizePhoto."', '".$leadlogid."')";
			$appdetailsqryResultPL = ExecQuery($appdetailsqry);
			$apptdetailsid = mysql_insert_id();
			
                        $QuryReqPL = "select City, City_Other from Req_Loan_Personal where RequestID='".$plrequestid."'";
                $queryReqPL1 = ExecQuery($QuryReqPL);
                $plcity= mysql_result($queryReqPL1,0,'City');
                $plcity_other= mysql_result($queryReqPL1,0,'City_Other');
                if($plcity=='Others'){
                            $CityVal = $plcity_other;
                        }else{
                            $CityVal = $plcity;
                        }
                        
                        $appDocsqry="INSERT INTO zexternal_appointment_docs (`RequestID`, `caller_id`, CityName, IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto,  leadlogid, apptdetailsid) VALUES ('".$plrequestid."', '".$callerid."', ".$CityVal."', '".$IDProof."', '".$AddressProof."', '".$PanCard."', '".$SalSlip."', '".$BankStmnt."', '".$PassSizePhoto."', '".$leadlogid."', '".$apptdetailsid."')";
			$appDocsqryResultPL = ExecQuery($appDocsqry);			
			//$productval = last_insert_id();
			echo "Appointment successfully Saved";
		}
	}
	else
	{
		echo "Sorry for Inconvenience";
	}
}
?>