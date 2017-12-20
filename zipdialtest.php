<?php
require 'scripts/db_init.php';
//require 'scripts/functions.php';
	$Phone = 9971396361;
//$Phone = 9711117028;
//		$Phone = 9999570210;
//		$Phone = 9811213158;
//		$Phone = 9899391056;
	//	$Phone = 9899138993;
//		$Phone = 9873678914;
//	$Phone = 9891118553;
	$client_transaction_id = 121212121;
	
	$zipdimage = mobile_verify($Phone,$client_transaction_id);
echo "<br><br>".$zipdimage."<br><br>";
function mobile_verify($Phone, $client_transaction_id)
{
	$db_user	= "mf"; 
	$db_server  = "localhost"; 
	$db_pass	= "mataji"; 
	$db_name	= "d4l"; 
	$conn = mysql_connect($db_server, $db_user, $db_pass) or die ('I cannot connect to the database because: ' . mysql_error());
	$connection = mysql_select_db($db_name);
	
//	http://www.zipdial.com/z2v/startTransaction.action?customerToken=<CUSTOMER TOKEN>&clientTransactionId=7161680&callerid=<CALLERID>&duration=180&countryCode=91&z2vToken=<Z2VTOKEN>
	//$response = file_get_contents("http://www.zipdial.com/zip2auth/v2/transactions/start_transaction?token=04f0294522530730a4671c96a8a35cac6c47714d&clientTransactionId=$client_transaction_id&callerPhone1=$Phone&duration=30&country_code=91"); 
	
	$response = file_get_contents("http://www.zipdial.com/z2v/startTransaction.action?customerToken=04f0294522530730a4671c96a8a35cac6c47714d&clientTransactionId=$client_transaction_id&callerid=$Phone&duration=360&countryCode=91&z2vToken=bc4e3f20bd8c7361c7a088b7b570e9d076516dd5"); 
	echo $response;
	echo "<br>";
	$explod = explode(",", $response);
		
	$explod2 = explode('http://www.zipdial.com', $explod[4]);
	//echo $explod2[1];
	$getImg = substr(trim($explod2[1]), 0, strlen(trim($explod2[1]))-2);
echo $getImg1 = substr(trim($explod2[1]), 0, strlen(trim($explod2[1]))-2);
echo "<br>";
	$image = "http://www.zipdial.com".$getImg;
	$img = trim(str_replace("\/", "/", $image));
	$explod31 = explode('transaction_token', $explod[2]);
	$explod3 = trim($explod31[1]);
	$transactiontoken =	explode('/', $getImg);
	$transaction_token = $transactiontoken[4];
	
	if(strlen($explod2[1])>8)
	{
		$viewable = "viewed";
	}
	else
	{
		$viewable = "not viewed";
	}
	
		//	echo "<br>";
 $insertSql = "INSERT INTO z2v_transactions ( client_transaction_id , zipdial_no , transaction_token , mobile , verified , created ,viewable ) VALUES ('".$client_transaction_id."' , '".$zipdial_no."' , '".$transaction_token."' , '".$Phone."' , '".$verified."' , Now(), '".$viewable."')";
	$insertQuery = mysql_query($insertSql);
	//$img = "<img src='$img'/>";
	echo $insertSql;
	echo "<br>";
	return $img;
}

?>

<img src="<? echo $zipdimage; ?>" />
