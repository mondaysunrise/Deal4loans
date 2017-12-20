<?php
error_reporting(E_ALL);
define('API_URL', 'http://www.deal4loans.com/api/v1/callerapp');
define('BIDDER_LOGIN_TBL', 'Bidders');
require '../../../scripts/db_init.php';

function authcheck($AuthUsername,$AuthPassword)
{
// Check Authentication 
	$authCurl = curl_init();
    $data = array(
        "auth_username" => $AuthUsername,
        "auth_password" => $AuthPassword,
       );
    $data_string = json_encode($data);
	$AURL = API_URL."/bidder-login.php";
    curl_setopt($authCurl, CURLOPT_URL, $AURL);
    curl_setopt($authCurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($authCurl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($authCurl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($authCurl, CURLOPT_RETURNTRANSFER, true);
    $authOutput = curl_exec($authCurl);
    $err = curl_error($authCurl);
	curl_close($authCurl);
	
	$authOutputDecode = json_decode($authOutput, TRUE);
	if($authOutputDecode["validation_message"]=='')
	{
    $_SESSION['access_token'] = $authOutputDecode['AuthVerified'];
    $_SESSION['expire_tme'] = $authOutputDecode['expire_tme'];
    $_SESSION['set'] = true;
    // set expire time
    $_SESSION['expire'] = time() + $_SESSION['expire_tme']; // static expire
    }

	return($authOutputDecode);
}

$fp = fopen('php://input', 'r');
$rawData = stream_get_contents($fp);

$BiddersObj = json_decode($rawData, true);
$AuthUsername = $BiddersObj["auth_username"];
$AuthPassword = $BiddersObj["auth_password"];
$CustomerID = $BiddersObj["customerid"];
$BidderID = $BiddersObj["bidderid"];
$BidderProduct = $BiddersObj["product"];
$customer_city = $BiddersObj["customer_city"];
$special_remarks = $BiddersObj["special_remarks"];
$appointment_date = $BiddersObj["appointment_date"];
$appointment_time = $BiddersObj["appointment_time"];
$appointment_address = $BiddersObj["appointment_address"];
$id_proof = $BiddersObj["id_proof"];
$address_proof = $BiddersObj["address_proof"];
$pancard_exist = $BiddersObj["pancard_exist"];
$reqd_salaryslip = $BiddersObj["reqd_salaryslip"];
$reqd_bankstat = $BiddersObj["reqd_bankstat"];
$passport_sizepic = $BiddersObj["passport_sizepic"];

$authOutputDecode=authcheck($AuthUsername,$AuthPassword);

$AuthVerified = $authOutputDecode['AuthVerified'];

if($AuthVerified=="verified")
{
if(strlen(trim($BidderID))>0)
	{
	if($CustomerID>0)
		{//add log entry
		
			// finish log entry
			    $getApptDetailsSql = "select id from zexternal_appointment_docs where RequestID='".$CustomerID."' and caller_id='".$BidderID."' order by id asc";
				$getApptDetailsQry = d4l_ExecQuery($getApptDetailsSql);
				$rowApptDetails = d4l_mysql_fetch_array($getApptDetailsQry);			
				if($rowApptDetails["id"]>0)
				{
					$id=$rowApptDetails["id"];
					$AgentFeedback = 1; 
					$updateSql = "update zexternal_appointment_docs set special_remarks='".$special_remarks."', appt_date='".$appointment_date."', Address='".$appointment_address."', IDProof='".$id_proof."', AddressProof='".$address_proof."', PanCard='".$pancard_exist."', SalSlip='".$reqd_salaryslip."', BankStmnt='".$reqd_bankstat."', PassSizePhoto='".$passport_sizepic."', appt_time='".$appointment_time."',  AgentFeedback='".$AgentFeedback."'  where id='".$id."' ";
					$result=d4l_ExecQuery($updateSql);
				}
				else
				{
					$sql1 = "select Feedback_ID from client_lead_allocate where AllRequestID='".$CustomerID."' and BidderID='".$BidderID."'";
					$query1 = d4l_ExecQuery($sql1);
					$Feedback_ID= d4l_mysql_result($query1,0,'Feedback_ID');
					$sql1 = "select BidderID from Req_Feedback_Bidder_PL where AllRequestID='".$CustomerID."' and Feedback_ID='".$Feedback_ID."'";
					$query1 = d4l_ExecQuery($sql1);
					$finalBidderID= d4l_mysql_result($query1,0,'BidderID');
					
					$sql1 = "select BankID from Bidders_List where BidderID='".$BidderID."'";
					$query1 = d4l_ExecQuery($sql1);
					$BankID= d4l_mysql_result($query1,0,'BankID');

					$appDocsqry="INSERT INTO zexternal_appointment_docs (`RequestID`, `caller_id`, Reply_Type,  IDProof, AddressProof, PanCard, SalSlip, BankStmnt, PassSizePhoto,  leadlogid, `appt_date`, `appt_time`, `special_remarks`, dated, updated_date,rescheduled, Address,viewstatus,AgentFeedback,Feedback_ID,BidderID, BankID, CityName) VALUES ('".$CustomerID."', '".$BidderID."', '".$BidderProduct."', '".$id_proof."', '".$address_proof."', '".$pancard_exist."', '".$reqd_salaryslip."', '".$reqd_bankstat."', '".$passport_sizepic."', '".$leadlogid."', '".$appointment_date."', '".$appointment_time."', '".$special_remarks."', Now(), Now(), '".$rescheduled."', '".$appointment_address."', '1', '".$viewAsAppointment."', '".$Feedback_ID."', '".$finalBidderID."', '".$BankID."', '".$customer_city."')";
					$result = d4l_ExecQuery($appDocsqry);			
					//$productval = last_insert_id();
				//log entry
				$GetBank_Sql = "select leadlogid from zexternal_leadallocation_log where (BidderID = ".$finalBidderID ." and RequestID=".$CustomerID." and ProductID=1)";
				$GetBank_Query = d4l_ExecQuery($GetBank_Sql);
				$numGetBank = d4l_mysql_num_rows($GetBank_Query);
				if($numGetBank>0)
				{
					$leadlogid = d4l_mysql_result($GetBank_Query,0,'leadlogid');
					$toInsert = 0;
					$rescheduled = 1;
					$viewAsAppointment = 1;
				}
				else
				{	
					$getsmspl="select Mobile_no,Bank_Name from zexternal_campaign_smscontact Where (Sms_Flag=1 and Reply_Type=1 and BidderID='".$finalBidderID."'and City_Wise like '%".$customer_city."%') order by Compaign_ID ASC LIMIT 0,1";   
					$getsmsplresult = d4l_ExecQuery($getsmspl);
					$plsmsld= d4l_mysql_fetch_array($getsmsplresult);
					$Bidder_Number=$plsmsld["Mobile_no"];
					$toInsert = 1;
					$rescheduled = 0;
					$viewAsAppointment = 0;
					$sqlinstqry="INSERT INTO zexternal_leadallocation_log(BidderID , ProductID , bidder_number , Sendnow_Date , RequestID, CallerID) VALUES ('".$finalBidderID."', '".$BidderProduct."', '".$Bidder_Number."', Now(), '".$CustomerID."','".$BidderID."')";
					$sqlinstqryresult=d4l_ExecQuery($sqlinstqry);
					$leadlogid = d4l_mysql_insert_id();
				}
				}
				
			if ($result >0)
			{
				$extraarray=array("status"=>"true");
			//	$responseArray=array_merge($extraarray,$row);
				echo $responsefinal = json_encode($extraarray);
			}
			else
			{
				$responseArray=array("status"=>"false", "validation_message"=>"There was a problem in adding your changes. Please try again");
				$responsefinal = json_encode($responseArray);
				echo $responsefinal;
			}
		}
		else
		{
			$responseArray=array("status"=>"false", "validation_message"=>"CustomerID Missing");
			$responsefinal = json_encode($responseArray);
			echo $responsefinal;
		}
	}
	else
	{
		$responseArray=array("status"=>"false", "validation_message"=>"BidderID Missing");
		$responsefinal = json_encode($responseArray);
		echo $responsefinal;
	}

}
else
{
	//echo "3:";
	$extraarray=array("status"=>"false");
	$responseArray=array_merge($extraarray,$authOutputDecode);
	echo $responsefinal = json_encode($responseArray);
}

// add tag
//echo $responsfinal;

