<?php
error_reporting(E_ALL);
define('API_URL', 'http://www.deal4loans.com/api/v1/callerapp');
define('BIDDER_LOGIN_TBL', 'Bidders');
require '../../../scripts/db_init.php';
require '../../../scripts/functions.php';

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
//print_r($BiddersObj);
$AuthUsername = $BiddersObj["auth_username"];
$AuthPassword = $BiddersObj["auth_password"];
$product = $BiddersObj["product"];
$bidderid = $BiddersObj["bidderid"];
$Contact_Num = $BiddersObj["contact_number"];
$authOutputDecode=authcheck($AuthUsername,$AuthPassword);
$AuthVerified = $authOutputDecode['AuthVerified'];

if($AuthVerified=="verified")
{
	if($bidderid>0)
	{
		if($product>0)
		{
			if($Contact_Num>0)
			{
			$otpcode=generateNumber(6);
			 $SMSMessage = "Please use this code: " .$otpcode. "  to activate you loan request at deal4loans.com";
			SendSMSforLMS($SMSMessage, $Contact_Num);
			$extraarray=array("status"=>"true");
			$secondpart = array("otpcode"=>$otpcode);
			//print_r($secondpart);
			$responseArray=array_merge($extraarray,$secondpart);
			echo $responsefinal = json_encode($responseArray);
			}
			else
			{
				$responseArray=array("status"=>"false", "validation_message"=>"Provide Correct Mobile No");
				$responsefinal = json_encode($responseArray);
				echo $responsefinal;
			}
		}
		else
		{
			$responseArray=array("status"=>"false", "validation_message"=>"Provide Product ID");
			$responsefinal = json_encode($responseArray);
			echo $responsefinal;
		}
	}	
	else
		{
			$responseArray=array("status"=>"false", "validation_message"=>"Provide BidderID");
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

