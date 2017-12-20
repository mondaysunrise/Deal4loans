<?php
require 'scripts/db_init.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);


SbiHLUpdatedFeedbackCron();


function SbiHLUpdatedFeedbackCron(){
	//Get All Bidder ID's For SBI
	$bidderIdQry = "SELECT BidderID  FROM `Bidders` WHERE `Global_Access_ID` = '6319'";
	$bidderresult=ExecQuery($bidderIdQry);
	$BidderIDarr=array();
	while($bidderrow = mysql_fetch_array($bidderresult)){
		$BidderIDarr[]= $bidderrow["BidderID"];
	}
	$strbidders=implode(",",$BidderIDarr);


	//Get Last Request ID for which Feedback was updated
	$LastUpdatedFeedbackReuestIDQry = "SELECT RequestID FROM Req_Compaign WHERE Bank_Name = 'SBI Reverse Feedback' AND Reply_Type = 2 ORDER BY RequestID DESC LIMIT 0,1";
	$LastUpdatedFeedbackReuestIDResult=ExecQuery($LastUpdatedFeedbackReuestIDQry);
	$LastRequestIDResult = mysql_fetch_array($LastUpdatedFeedbackReuestIDResult);
	$LastRequestID = $LastRequestIDResult['RequestID'];
	//echo $LastRequestID;exit;
	if(!empty($LastRequestID)){
		$requestIdQry = "SELECT * FROM `Req_Feedback_Bidder_HL` WHERE `BidderID` IN (".$strbidders.") AND Feedback_ID > '".$LastRequestID."' ORDER BY Feedback_ID ASC LIMIT 0,50";
	}
	else{
		$requestIdQry = "SELECT * FROM `Req_Feedback_Bidder_HL` WHERE `BidderID` IN (".$strbidders.") ORDER BY Feedback_ID ASC LIMIT 0,50";
	}
	$queryresult=ExecQuery($requestIdQry);

	while($rowbid = mysql_fetch_array($queryresult)){

		//Check if Feedback is saved for request id
		$query1="SELECT websrvid,bidderid,cust_requestid,doe,feedback FROM webservice_bidder_details WHERE (product='2' and cust_requestid = '".$rowbid["AllRequestID"]."' and bidderid IN (".$strbidders."))";
		//echo $query1;exit;
		$result1 = ExecQuery($query1);
		$row=mysql_fetch_array($result1);
		$param = array();
		
		if($row["websrvid"]){
			$data = $row["feedback"];
			$expires = preg_split('/LeadID/', trim($data));
			$leadValue = str_replace(":","",str_replace('"}]','',$expires[1]));

			if(!empty($leadValue)){
				$param["LeadID"] = trim($leadValue);
			}
		}
		//Get details From Req_Loan_Home
		$chkquery="SELECT Mobile_Number, Pancard, City FROM Req_Loan_Home WHERE (RequestID=".$row["cust_requestid"].")";
		$chkresult = ExecQuery($chkquery);
		$chk = mysql_fetch_array($chkresult);

		$param["PanCard"] = trim($chk["Pancard"]);
		$param["ContactNo"] = trim($chk["Mobile_Number"]);
		
		$City = $chk["City"];
		
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{
			$request.= $key."=".urlencode($val); //we have to urlencode the values
			$request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		$request = substr($request, 0, strlen($request)-1);

		$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyDataShow";
		//echo $url;echo "<br>";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
		$result = curl_exec($ch);
		curl_close($ch); 	
		echo '<pre>';print_r($result); 
		$outputstr=$result;
		$outputstr = addslashes($outputstr);
		
		$CurrentStatus = '';
		if(strlen($outputstr)>0){
			$StrRepFirstBracket = str_replace("[", "", $outputstr);
			$StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
			$obj = json_decode($StrRepFinal);
			$CurrentStatus = $obj->{'CurrentStatus'};
		}

		if($row["websrvid"]>0){
			$updatefeedbackqry = "Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')";
			$update =ExecQuery($updatefeedbackqry);
		}
		else{
			$insertfeedbackqry = "INSERT INTO webservice_bidder_details (leadid, product, bidderid, cust_requestid, cust_city, final_feedback, final_feedback_date, sbi_current_status) VALUES (";
			$insertfeedbackqry .= "'".$rowbid["Feedback_ID"]."' , '2' , '".$rowbid["BidderID"]."' , '".$rowbid["AllRequestID"]."' , '".$City."' , '".$outputstr."', Now() , '".$CurrentStatus."')";
			$insert =ExecQuery($insertfeedbackqry);
		}
		
		//Insert Entry into Req_Compaign
		if(!empty($rowbid["Feedback_ID"]) && ($rowbid["Feedback_ID"] > 0)){
			$RequestID = $rowbid["AllRequestID"];
			$Feedback_ID = $rowbid["Feedback_ID"];
			$BidderID = $rowbid["BidderID"];
			$qry1 = "Update Req_Compaign SET RequestID = '".$Feedback_ID."', BidderID = '".$BidderID."', Dated = Now() WHERE Bank_Name = 'SBI Reverse Feedback' AND Reply_Type = 2";
			//echo $qry1;
			$result = ExecQuery($qry1);
		}
	}
}


?>
