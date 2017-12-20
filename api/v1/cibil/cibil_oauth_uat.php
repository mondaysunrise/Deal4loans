<?php
define('API_URL', 'https://apistage.wishfin.com/api/v1/');
define('OAUTH_URL', 'https://apistage.wishfin.com/oauth');
define('OAUTH_USERNAME', 'wishfin');
define('OAUTH_PASSWORD', 'qwer1234');
define('OAUTH_CLIENT_ID', 'wishfin');
/*define('OAUTH_USERNAME', 'deal4loans');
define('OAUTH_PASSWORD', 'ZGVhbDRsb2Fuc3w3WjZYYk5mcw');
define('OAUTH_CLIENT_ID', 'deal4loans');*/
define('OAUTH_GRANT_TYPE', 'password');
require '../../../scripts/db_init.php';

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



function apidetails($product, $productid, $api_from, $cibilid, $api_url, $api_version, $api_request, $api_response, $cibilstatus, $cibilscore)
{
	$cibillog = array('product'=>$product, 'productid'=>$productid,  'api_from'=>$api_from, 'cibil_id'=>$cibilid, 'url_end_point'=>$api_url, 'api_version'=>$api_version, 'api_request_data'=>$api_request, 'api_response_data'=>$api_response, 'cibil_status'=>$cibilstatus, 'cibil_score'=>$cibilscore);
	//print_R($cibillog);
	
	$insert = Maininsertfunc ('api_log_cibil', $cibillog);

	
	//return($insert);
}

?>
