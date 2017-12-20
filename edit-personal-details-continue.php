<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();
/*echo "<pre>";
print_r($_POST);
echo "</pre><br>";*/
$toInsert = '';
$rescheduled = '';
$viewAsAppointment = '';
//exit();
$_SESSION['reportValue'] = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
	$submit_appdt = FixString($_POST["submit_appdt"]);
	$submit = FixString($_POST["submit"]);
	
	if($submit_appdt=="Save")
	{
		$productid=FixString($_POST["Reply_Type"]);
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
		$Reply_Type = $_REQUEST['Reply_Type'];
		$reschedule = $_REQUEST['reschedule'];
		$Address = $_POST["Address"];
	//	echo $Final_Bidder." RequestID - ".$plrequestid." Remarks - ".$special_remarks." Time - ".$appointment_time." Date - ".$appointment_date;
	 $GetBank_Sql = "select leadlogid from zexternal_leadallocation_log where (BidderID = ".$Final_Bidder ." and RequestID=".$plrequestid." and ProductID=1)";
	$GetBank_Query = ExecQuery($GetBank_Sql);
	$numGetBank = mysql_num_rows($GetBank_Query);
	if($numGetBank>0)
	{
		$leadlogid = mysql_result($GetBank_Query,0,'leadlogid');
		$toInsert = 0;
		$rescheduled = 1;
		$viewAsAppointment = 1;
	}
	else
	{
		$toInsert = 1;
		$rescheduled = 0;
		$viewAsAppointment = 0;
		$sqlinstqry="INSERT INTO zexternal_leadallocation_log(BidderID , ProductID , bidder_number , Sendnow_Date , RequestID, CallerID) VALUES ('".$Final_Bidder."', '".$productid."', '".$Bidder_Number."', Now(), '".$plrequestid."','".$callerid."')";
		$sqlinstqryresult=ExecQuery($sqlinstqry);
		$leadlogid = mysql_insert_id();
	}

	//echo $reschedule."<br> - "; 
	//echo  $toInsert;	
	if(($Final_Bidder>0 && $plrequestid>0 && ((strlen($special_remarks)>1) || strlen($appointment_time)>1 || $appointment_date!='')) && ($rescheduled==1 || $toInsert == 1))	
	{
	/*	$appdetailsqry="INSERT INTO zexternal_appointment_details (`AllRequestID`, `caller_id`, `BidderID`, `appt_date`, `appt_time`, `special_remarks`,`Flag`, `stat_dated`, ProductID, Bidder_Number, IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto,  leadlogid) VALUES ('".$plrequestid."', '".$callerid."', '".$Final_Bidder."', '".$appointment_date."', '".$appointment_time."', '".$special_remarks."', '1', Now(),'1' ,'".$Bidder_Number."', '".$IDProof."', '".$AddressProof."', '".$PanCard."', '".$SalSlip."', '".$BankStmnt."', '".$PassSizePhoto."', '".$leadlogid."')";
		$appdetailsqryResultPL = ExecQuery($appdetailsqry);
		$apptdetailsid = mysql_insert_id();	*/
	$updateSql = ExecQuery("update zexternal_appointment_docs set viewstatus=0 where RequestID='".$plrequestid."'");
	
	$sql1 = "select Feedback_ID from client_lead_allocate where AllRequestID='".$plrequestid."' and BidderID='".$callerid."'";
	$query1 = ExecQuery($sql1);
	$Feedback_ID= mysql_result($query1,0,'Feedback_ID');
	$sql1 = "select BidderID from Req_Feedback_Bidder_PL where AllRequestID='".$plrequestid."' and Feedback_ID='".$Feedback_ID."'";
	$query1 = ExecQuery($sql1);
	$BidderID= mysql_result($query1,0,'BidderID');
	
	$sql1 = "select BankID from Bidders_List where BidderID='".$BidderID."'";
	$query1 = ExecQuery($sql1);
	$BankID= mysql_result($query1,0,'BankID');
        
        //Req_Loan_Personal
	$QuryReqPL = "select City, City_Other from Req_Loan_Personal where RequestID='".$plrequestid."'";
        $queryReqPL1 = ExecQuery($QuryReqPL);
	$plcity= mysql_result($queryReqPL1,0,'City');
        $plcity_other= mysql_result($queryReqPL1,0,'City_Other');
        
        
        if($plcity=='Others'){
                    $CityVal = $plcity_other;
                }else{
                    $CityVal = $plcity;
                }
              if($_SESSION['leadidentifier'] == "CallerAccountDialingBCH" || $_SESSION['leadidentifier'] =="CallerAccountDialingDMP"){
                    $BankID = $_REQUEST['BankId'];
            }else{
                    $BankID = $BankID;
                }  
        echo $appDocsqry="INSERT INTO zexternal_appointment_docs (`RequestID`, `caller_id`, `CityName`, Reply_Type,  IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto,  leadlogid, `appt_date`, `appt_time`, `special_remarks`, dated, updated_date,rescheduled, Address,viewstatus,AgentFeedback,Feedback_ID,BidderID, BankID) VALUES ('".$plrequestid."', '".$callerid."', '".$CityVal."', '".$Reply_Type."', '".$IDProof."', '".$AddressProof."', '".$PanCard."', '".$SalSlip."', '".$BankStmnt."', '".$PassSizePhoto."', '".$leadlogid."', '".$appointment_date."', '".$appointment_time."', '".$special_remarks."', Now(), Now(), '".$rescheduled."', '".$Address."', '1', '".$viewAsAppointment."', '".$Feedback_ID."', '".$BidderID."', '".$BankID."')";
		$appDocsqryResultPL = ExecQuery($appDocsqry);			
		//$productval = last_insert_id();
		
		$reportValue = "Appointment successfully Saved";
		if($reschedule==1)
		{
			$reportValue = "Appointment Re-scheduled successfully";
		}

	}
}
else
{
	$reportValue = "Sorry for Inconvenience";
}
	$_SESSION['reportValue'] = $reportValue;
	header("Location: edit-personal-details.php?postid=".$plrequestid."&biddt=".$callerid);
	exit();

}
?>