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
//print_r($BiddersObj);
$AuthUsername = $BiddersObj["auth_username"];
$AuthPassword = $BiddersObj["auth_password"];
$product = $BiddersObj["product"];
$bidderid = $BiddersObj["bidderid"];
$bidderid = $BiddersObj["contactnumber"];
$bidderid = $BiddersObj["inserted_otp"];

$authOutputDecode=authcheck($AuthUsername,$AuthPassword);
$AuthVerified = $authOutputDecode['AuthVerified'];

if($AuthVerified=="verified")
{
	if($product>0)
	{
		$producttext=getTableName($product);
		$extraarray=array("status"=>"true");
		$secondpart = array("producttext"=>$producttext);
		//print_r($secondpart);
		$responseArray=array_merge($extraarray,$secondpart);
		echo $responsefinal = json_encode($responseArray);
	}
	elseif($feedbacklist==1)
	{	
		// add clause here as per bidderID
		$BiddersLoginQry="Select bidders_feedback_list From ".BIDDER_LOGIN_TBL." Where BidderID = '".$bidderid."' and app_active=1";
		list($alreadyExist,$row)=MainselectfuncNew($BiddersLoginQry,$array = array());
		if($alreadyExist>0){
		//echo "1:";
			$extraarray=array("status"=>"true");
			$bidders_feedback_list=$row[0]["bidders_feedback_list"];
			$secondpart = array("feedback"=>$bidders_feedback_list);
			//print_r($secondpart);
			$responseArray=array_merge($extraarray,$secondpart);
			echo $responsefinal = json_encode($responseArray);
			}
		}
	else
		{
		//echo "2:";
			//	echo "<br>--------------start---------";
			$responseArray=array("status"=>"false", "validation_message"=>"no data found");
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


function getTableName($pKey)
{
    $titles = array(
        1=> 'Personal Loan',
        2=> 'Home Loan',
        3=> 'Car Loan',
        4=> 'Credit Card',
        5=> 'Loan Against Property',
        6=> 'Business Loan',
		7=> 'Gold Loan',
		9=> 'Education Loan',
		10=> 'Two Wheeler Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}
// add tag
//echo $responsfinal;

