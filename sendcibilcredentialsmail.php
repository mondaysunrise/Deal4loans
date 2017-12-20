<?php
require_once 'scripts/db_init.php';

function getCibilReportEmailer($detailsArr){
	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', triggeredlogin() , $matches);
	$cookies = array();
	foreach($matches[1] as $item) {
		parse_str($item, $cookie);
		$cookies = array_merge($cookies, $cookie);
	}
	$sessioncookie = $cookies["PubAuth1"];

	$sentmailres = sendCheetahMail($sessioncookie, $detailsArr);

	////////////////--------------Send Mail via CheetahMail---------------///////////////

	if($sentmailres == 'Mail Sent'){
		//Update mail_sent status into api_log_cibil table
		$updateMailLogQry="UPDATE api_log_cibil set mail_sent=1 WHERE (cibil_email ='".$detailsArr['CUST_EMAIL']."' and cibil_password='".$detailsArr['CUST_PASSWORD']."')";
		$updatemailLogRes = d4l_ExecQuery($updateMailLogQry);
	}
}

function triggeredlogin(){
	$strCookie1 = "sessionId=".session_id()."; path=".session_save_path();
	session_write_close();
	
	$url = "https://ebm.cheetahmail.com/api/login1?name=deal4loans_API&cleartext=login@135";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	//	curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded','Content-Length:'. strlen($request)));
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIE, $strCookie1);
	$returnvalue= curl_exec ($ch);
	return($returnvalue);
}

function sendCheetahMail($sessioncookie, $detailsArr){
	$param = array();
	$param["aid"] = 2104808845;
	$eventID = 305555;
	$cibil_url = "http://www.deal4loans.com/cibil/login.php";
	$param["eid"] = $eventID;
	$param["email"] = $detailsArr['email'];
	$param["FULL_NAME"] = $detailsArr['FULL_NAME'];
	$param["CUST_CIBIL_SCORE"] = $detailsArr['CUST_CIBIL_SCORE'];
	$param["CUST_EMAIL"] = $detailsArr['CUST_EMAIL'];
	$param["CUST_PASSWORD"] = $detailsArr['CUST_PASSWORD'];
	$param["D4L_CIBIL_URL"] = $cibil_url;

	$requestPost = "";
	//traverse through each member of the param array
	foreach($param as $key=>$val){ 
		//we have to urlencode the values
  		$requestPost.= $key."=".urlencode($val); 
  		//append the ampersand (&) sign after each paramter/value pair
  		$requestPost.= "&"; 
	}
	//remove the final ampersand sign from the request
	$requestPost= substr($requestPost, 0, strlen($requestPost)-1); 
	//echo $requestPost;
	//maintain log
	$updateMailLogQry="UPDATE api_log_cibil set mail_json='".$requestPost."' WHERE (cibil_email ='".$detailsArr['CUST_EMAIL']."' and cibil_password='".$detailsArr['CUST_PASSWORD']."')";
	$updatemailLogRes = d4l_ExecQuery($updateMailLogQry);

	$url = "https://ebm.cheetahmail.com/ebm/ebmtrigger1";

	$strCookie = "PubAuth1=".urlencode($sessioncookie)."; path=/; ";
	session_write_close();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPost);
	$content = curl_exec ($ch);
	//print_r($content);
	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header = substr($content, 0, $header_size);
	$body = substr($content, $header_size);
	//echo "<pre>";print_r($header_size);print_r($header);print_r($body);
	curl_close ($ch);
	if($body == 'OK'){
		return 'Mail Sent';
	}
	else{
		return $body;
	}
}

?>
