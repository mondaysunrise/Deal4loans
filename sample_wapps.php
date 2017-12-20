<?php

require 'wishfin_whatsapp_api.php';

$mobile=9811555306;
//$mobile=9971396361;
$table_name="Table";
$requestid=1;
$whatsapp_message="Wish you a very Happy Birthday Sir.";
$whatsapp_process_name="deal4loan_sample_message";

	$returnValue = json_decode(whatsappCustomSendMessage($mobile,$table_name,$requestid,$whatsapp_message,$whatsapp_process_name));
echo "<pre>";
print_r($returnValue);


/* End Whatsapp*/

/* Start Email*/
//sendwishfinmailercron.php

	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', triggeredlogin() , $matches);
	$cookies = array();
	foreach($matches[1] as $item) {
	    parse_str($item, $cookie);
	    $cookies = array_merge($cookies, $cookie);
	}
	$sessioncookie = $cookies["PubAuth1"];

	$param = "";
	$param["aid"] = 2103064721;
	$param["email"] = "rishi.mehra@wishfin.com";
	$param["eid"] = 309356;
	$param["PROFILE_PIC"] = $relationshipManagerprofile_pic_path;
	$param["CUSTOMER_NAME"] = $CustomerName;
	$param["MANAGER_NAME"] = $relationshipManagerName;
	$param["LOAN_SERVICED"] = $relationshipManagerinitial_customers_handled;
	$param["RATING1"] = $ratingimgarr[0];
	$param["RATING2"] = $ratingimgarr[1];
	$param["RATING3"] = $ratingimgarr[2];
	$param["RATING4"] = $ratingimgarr[3];
	$param["RATING5"] = $ratingimgarr[4];
	$param["PRODUCT_TYPE"] = base64_encode($product_type);
	$param["LEAD_ID"] = base64_encode($lead_id);
	$param["BANK_CODE"] = base64_encode($bank_code);
	$param["AGENT_CODE"] = base64_encode($AgentCode);
	$requestPost = "";
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
  		$requestPost.= $key."=".urlencode($val); //we have to urlencode the values
  		$requestPost.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$requestPost= substr($requestPost, 0, strlen($requestPost)-1); //remove the final ampersand sign from the request
	echo $requestPost;

	//$url = "https://ebm.cheetahmail.com/ebm/ebmtrigger1?aid=2103064721&email=".$Toemailid."&eid=298330&PROFILE_PIC=".$relationshipManagerprofile_pic_path."&CUSTOMER_NAME=".$CustomerName."&MANAGER_NAME=".$relationshipManagerName."&LOAN_SERVICED=".$relationshipManagerinitial_customers_handled."&RATING1=".$ratingimgarr[0]."&RATING2=".$ratingimgarr[1]."&RATING3=".$ratingimgarr[2]."&RATING4=".$ratingimgarr[3]."&RATING5=".$ratingimgarr[4]."&PRODUCT_TYPE=".base64_encode($product_type)."&LEAD_ID=".base64_encode($lead_id)."&BANK_CODE=".base64_encode($bank_code)."&AGENT_CODE=".base64_encode($AgentCode);
	$url = "https://ebm.cheetahmail.com/ebm/ebmtrigger1";
	
	
echo "<br><br>".$url;
	$strCookie = "PubAuth1=".urlencode($sessioncookie)."; path=/; ";
	session_write_close();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
//	curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded','Content-Length:'. strlen($request)));
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPost);
	$content = curl_exec ($ch);
	echo "<br><br>";
print_r($content);
	curl_close ($ch);  

	



function triggeredlogin()
{
	
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


?>