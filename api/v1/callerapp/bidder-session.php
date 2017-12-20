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
$BidderUsername = $BiddersObj["bidder_username"];
$BidderPassword = $BiddersObj["bidder_password"];
$authOutputDecode=authcheck($AuthUsername,$AuthPassword);

$AuthVerified = $authOutputDecode['AuthVerified'];

if($AuthVerified=="verified")
{
//Array ( [auth_username] => testd4luser [auth_password] => d4lapi1234 [bidder_username] => bidder@d4l.com [bidder_password] => bidderpwd )

$BiddersLoginQry="Select Reply_Type , Contact_Num , Address , City , Bidder_Name , Email , BidderID,Count_Replies From ".BIDDER_LOGIN_TBL." Where (Email = '".$BidderUsername."' and  PWD = '".$BidderPassword."' and Is_Verified>1 and app_active=1 )";
list($alreadyExist,$row)=MainselectfuncNew($BiddersLoginQry,$array = array());
if($alreadyExist>0){
$checkFiltersQry = "Select * From lms_attributes where (BidderID='".$row[0]["BidderID"]."' and app_active=1)";
list($alreadyExistfilter,$filterrow)=MainselectfuncNew($checkFiltersQry,$array = array());
if($alreadyExistfilter>0){
	$date_filter = $filterrow[0]["date_filter"];
	$datefilter="date,";
	$feedback_filter = $filterrow[0]["feedback_filter"];
	$feedbackfilter="feedback,";
	$referenceid_filter = $filterrow[0]["referenceid_filter"];
	$referenceidfilter="referenceid,";
	$feedback_list = $filterrow[0]["feedback_list"];

	 $typeof_filters=$datefilter."".$feedbackfilter."".$referenceidfilter;
	 $typeof_filters = substr(trim($typeof_filters), 0, strlen(trim($typeof_filters))-1);
	
	$Contact_Num = $row[0]["Contact_Num"];
	$numverified = $row[0]["Count_Replies"];
	if(isset($Contact_Num) && $numverified==1)
		{
			$ContacVerified=1;
		}
	else
		{
			$ContacVerified=0;
		}
		if($ContacVerified==1)
		{
			$extraarray=array("status"=>"true", "app_version"=>"V3", "number_verified"=>$ContacVerified, "typeof_filters"=>$typeof_filters,"bidders_feedback_list"=>$feedback_list);
			$responseArray=array_merge($extraarray,$row);
			echo $responsefinal = json_encode($responseArray);
		}
		else
		{	if(isset($strmobile_no))
			{
			SendSMSforLMS($message, $strmobile_no);
			}
			$extraarray=array("status"=>"true", "app_version"=>"V2", "number_verified"=>$ContacVerified, "typeof_filters"=>$typeof_filters,"bidders_feedback_list"=>$feedback_list);
			$responseArray=array_merge($extraarray,$row);
			echo $responsefinal = json_encode($responseArray);
		}
}
else
	{
		$responseArray=array("status"=>"false", "validation_message"=>"unable to fetch Attributes");
		$responsefinal = json_encode($responseArray);
		echo $responsefinal;
	}

}
else
	{
		//	echo "<br>--------------start---------";
		$responseArray=array("status"=>"false", "validation_message"=>"Bidders Wrong Credentials");
		$responsefinal = json_encode($responseArray);
		echo $responsefinal;
		//echo "<br>--------------end---------";
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

