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
$CustomerFeedback = $BiddersObj["customer_feedback"];
$CustomerFollowupDate = $BiddersObj["customer_followupdate"];
$CustomerComment = $BiddersObj["customer_comment"];
$authOutputDecode=authcheck($AuthUsername,$AuthPassword);

$AuthVerified = $authOutputDecode['AuthVerified'];

if($AuthVerified=="verified")
{
if(strlen(trim($BidderID))>0)
	{
	if($CustomerID>0)
		{
		$checkFiltersQry = "Select lead_edit_page From lms_attributes where (BidderID='".$BidderID."' and app_active=1)";
		list($alreadyExistfilter,$filterrow)=MainselectfuncNew($checkFiltersQry,$array = array());
		$lead_edit_page = $filterrow[0]["lead_edit_page"];
		if($lead_edit_page=="edit-personal-details")
			{
			if(strlen($CustomerFeedback)>0)
			{
			$strSQL="";
			$Msg="";
			$result = d4l_ExecQuery("select leadid from client_lead_allocate where AllRequestID=$CustomerID and BidderID=".$BidderID);		
			$num_rows = d4l_mysql_num_rows($result);
			if($num_rows > 0)
			{
				$row = d4l_mysql_fetch_assoc($result);
				$strSQL="Update client_lead_allocate Set Feedback='".$CustomerFeedback."' ";
				$strSQL=$strSQL." Where leadid=".$row["leadid"];
				//echo $strSQL;
				$feedbackresult = d4l_ExecQuery($strSQL);
				$checkDocsSql = "select RequestID from zexternal_appointment_docs where RequestID='".$CustomerID."' and Reply_Type=1 and viewstatus=1 and caller_id='".$BidderID."'";
				$checkDocsQuery = d4l_ExecQuery($checkDocsSql);
				$checkDocsNumRows = d4l_mysql_num_rows($checkDocsQuery);
				$tomorrowDate = date('Y-m-d',strtotime("+1 days"))." ".date('H:i:s');
				$AgentFeedback ='';
				if($Feedback=="Appointment")
				{
					$AgentFeedback =1;
				}
				else
				{
					$AgentFeedback =2;
				}
				if($checkDocsNumRows>0)
				{
					$updateSql = "update zexternal_appointment_docs set AgentFeedback='".$AgentFeedback."', appt_date='".$tomorrowDate."' where RequestID='".$CustomerID."' and Reply_Type=1 and viewstatus=1 ";
					d4l_ExecQuery($updateSql);
					//echo $updateSql ." - in updateSql";
				}
				else
				{
					$sql1 = "select Feedback_ID from client_lead_allocate where AllRequestID='".$CustomerID."' and BidderID='".$BidderID."'";
					$query1 = d4l_ExecQuery($sql1);
					$Feedback_ID_Agent = d4l_mysql_result($query1,0,'Feedback_ID');
					$sql1 = "select BidderID from Req_Feedback_Bidder_PL where AllRequestID='".$CustomerID."' and Feedback_ID='".$Feedback_ID_Agent."'";
					$query1 = d4l_ExecQuery($sql1);
					$BidderID_Agent = d4l_mysql_result($query1,0,'BidderID');
					
					$sql1 = "select BankID from Bidders_List where BidderID='".$BidderID_Agent."'";
					$query1 = d4l_ExecQuery($sql1);
					$BankID_Agent= d4l_mysql_result($query1,0,'BankID');

					$QuryReqPL = "select City, City_Other from Req_Loan_Personal where RequestID='".$CustomerID."'";
					$queryReqPL1 = d4l_ExecQuery($QuryReqPL);
					$plcity= d4l_mysql_result($queryReqPL1,0,'City');
					$plcity_other= mysql_result($queryReqPL1,0,'City_Other');
					if($plcity=='Others'){
						$CityVal = $plcity_other;
					}else{
						$CityVal = $plcity;
					}
		
					if($CustomerFeedback=="Appointment")
					{
						$insertSql = "INSERT INTO zexternal_appointment_docs (caller_id, RequestID,CityName, Reply_Type, appt_date, dated, updated_date, viewstatus, AgentFeedback,Feedback_ID,BidderID,BankID) VALUES ('".$BidderID."', '".$CustomerID."', '".$CityVal."', '1', '".$tomorrowDate."', Now(),Now(), '1', '1', '".$Feedback_ID_Agent."', '".$BidderID_Agent."', '".$BankID_Agent."')";
						d4l_ExecQuery($insertSql);
						//echo $insertSql." - in If Condition";
					}
				}
			}
			}
				if(strlen($CustomerComment)>0)
				{
					//echo "comments";
						$Dated = ExactServerdate();
						$dataInsert = array('RequestID'=>$CustomerID, 'Comments'=>$CustomerComment, 'Dated'=>$Dated, 'Reply_Type'=>'1', 'BidderID'=>$BidderID);
						$table = 'client_lead_allocated_comment';
						//print_r($dataInsert);
						$insert = Maininsertfunc ($table, $dataInsert);
						
						$strSQL="";
						$Msg="";
						$result = "select leadid from client_lead_allocate where AllRequestID=".$CustomerID." and BidderID=".$BidderID;
						list($num_rows,$row)=MainselectfuncNew($result,$array = array());

						if($num_rows > 0)
						{
							$dataUpdate = array('Followup_Date'=>$CustomerFollowupDate , 'Comments'=>$CustomerComment);
							$wherecondition = "(leadid=".$row[0]['leadid'].")";
							Mainupdatefunc ('client_lead_allocate', $dataUpdate, $wherecondition);
						}
					}

			if ($insert >0 || $feedbackresult>0)
					{ 
						$responseArray=array("status"=>"true");
						//$responseArray=array_merge($extraarray,$row["leadid"]);
						echo $responsefinal = json_encode($responseArray);
					}
					else
					{
						$responseArray=array("status"=>"false", "validation_message"=>"There was a problem in adding your feedback. Please try again");
						$responsefinal = json_encode($responseArray);
						echo $responsefinal;
					}
			} // if ends here
			else
			{
			$strSQL="";
			$Msg="";
			$result = "select FeedbackID from Req_Feedback where AllRequestID='".$CustomerID."' and BidderID=".$BidderID;
			list($num_rows,$row)=MainselectfuncNew($result,$array = array());
			if($num_rows > 0)
			{
				$dataUpdate = array('comment_section'=>$CustomerComment, 'Followup_Date'=>$CustomerFollowupDate, 'Feedback'=>$CustomerFeedback);
				$wherecondition = "(FeedbackID=".$row[0]['FeedbackID'].")";
				$result=Mainupdatefunc ('Req_Feedback', $dataUpdate, $wherecondition);
			}
			else
			{
				$data = array("AllRequestID"=>$CustomerID , "BidderID"=>$BidderID , "Reply_Type"=>$BidderProduct , "comment_section"=>$CustomerComment , "Followup_Date"=>$CustomerFollowupDate, 'Feedback'=>$CustomerFeedback);
				$table = 'Req_Feedback';
				//print_r($data);
				$result= Maininsertfunc ($table, $data);
			}
				if ($result >0)
				{
					$extraarray=array("status"=>"true");
					$responseArray=array_merge($extraarray,$row);
					echo $responsefinal = json_encode($responseArray);
				}
				else
				{
					$responseArray=array("status"=>"false", "validation_message"=>"There was a problem in adding your feedback. Please try again");
					$responsefinal = json_encode($responseArray);
					echo $responsefinal;
				}
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

