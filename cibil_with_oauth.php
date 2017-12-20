<?php
define('API_URL', 'http://apibeta.wishfin.com/api/v1/');
define('OAUTH_URL', 'http://apibeta.wishfin.com/oauth');
define('OAUTH_USERNAME', 'testuser');
define('OAUTH_PASSWORD', 'qwer1234');
define('OAUTH_CLIENT_ID', 'testuser');
define('OAUTH_GRANT_TYPE', 'password');

function OauthConnection() {
    // set a session to sore Oauth variables
    session_start();
    if (isset($_SESSION["set"])) { // if session is set, fetch Oauth values from session variables
        $sessionVarArray = array(
            "access_token" => $_SESSION['access_token'],
            "expires_in" => $_SESSION['expires_in'],
            "token_type" => $_SESSION['token_type']
        );
        //$sessionVarArrayString = json_encode($sessionVarArray);

        if (time() > $_SESSION['expire']) {
            session_unset('access_token');
            session_unset('expires_in');
            session_unset('token_type');
            session_unset('set');
        } else {
            return ($sessionVarArray);
        }
    }
    // if session is not set, hit Oauth and fetch Oauth variables   
    $oauthCurl = curl_init();
    $data = array(
        "username" => OAUTH_USERNAME,
        "password" => OAUTH_PASSWORD,
        "client_id" => OAUTH_CLIENT_ID,
        "grant_type" => OAUTH_GRANT_TYPE
    );
    $data_string = json_encode($data);
    $header = array();
    $header[] = 'Content-type: application/json';

    curl_setopt($oauthCurl, CURLOPT_URL, OAUTH_URL);
    curl_setopt($oauthCurl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($oauthCurl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($oauthCurl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($oauthCurl, CURLOPT_RETURNTRANSFER, true);
    $oauthOutput = curl_exec($oauthCurl);
    curl_close($oauthCurl);
    $oauthOutputDecode = json_decode($oauthOutput, TRUE);
    $_SESSION['access_token'] = $oauthOutputDecode['access_token'];
    $_SESSION['expires_in'] = $oauthOutputDecode['expires_in'];
    $_SESSION['token_type'] = $oauthOutputDecode['token_type'];
    $_SESSION['set'] = true;
    // set expire time
    $_SESSION['expire'] = time() + $_SESSION['expires_in']; // static expire
	//log
	//apidetails("1", "Cibil-Wishfino-auth", "BETA", $data_string, $oauthOutput);
	//log end
    return ($oauthOutput);
}

error_reporting(E_ALL);
$oauthReturn = OauthConnection();
print_r($oauthReturn);
$oauthAccessToken = $oauthReturn['access_token'];
$oauthExpiresIn = $oauthReturn['expires_in'];
$oauthTokenType = $oauthReturn['token_type'];

$ch = curl_init();
echo $url = API_URL . 'cibil-fulfill-order';

$data = array(
    "first_name" => "AJAY",
    "last_name" => "JOSHI",
    "pancard" => "AEBPJ3977L",
    "date_of_birth" => "1970-04-22",
    "mobile_number" => "9952277966",
    "email_id" => "abell@transunion.com",
    "gender" => "1",
    "city_name" => "Delhi",
    "state_code" => "07",
    "residence_address" => "MINISTRY OF ENVIRONMENT A V 2 3 4 VAYU",
    "residence_pincode" => "110003",
    "legal_response" => "Accept",
	"show_report_xml" => true
);
$data_string = json_encode($data);
//$useraccess = 'dGVzdDoxMjM0';
//$apiToken = 'testtoken';
//$apiKey = 'testkey';
$header = array();
$header[] = 'Content-type: application/json';
$header[] = 'Authorization: ' . $oauthTokenType . " " . $oauthAccessToken;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
$outputJsonDecode = json_decode($output, true);
echo "<pre>";
if ($outputJsonDecode->validation_messages != "") {
    print_r($outputJsonDecode);
} else {
    curl_close($ch);
    print_r($outputJsonDecode);
}


function apidetails($productid, $api_name, $api_version, $api_request, $api_response)
{
	$incredlog = array('product'=>"PL", 'productid'=>$productid, 'api_name'=>$api_name, 'api_version'=>$api_version, 'api_request'=>$api_request, 'api_response'=>$api_response, 'api_response_status'=>$finalstatus);
	//print_R($incredlog);
	
	$insert = Maininsertfunc ('webservice_details_pl', $incredlog);

	return($insert);
}