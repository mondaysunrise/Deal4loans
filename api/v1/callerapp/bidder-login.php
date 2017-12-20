<?php
//define('AUTH_USERNAME', 'testd4luser');
//define('AUTH_PASSWORD', 'd4lapi1234');
define('AUTH_USERNAME', 'deal4loansAPP');
define('AUTH_PASSWORD', 'ZMMhbDRsb2Fuc3w3WjZPLk5mcw');

$fp = fopen('php://input', 'r');
$rawData = stream_get_contents($fp);

$authObj = json_decode($rawData, true);

if($authObj["auth_username"]==AUTH_USERNAME && $authObj["auth_password"]==AUTH_PASSWORD)
{
	$expire_tme="30";
	$Autharray=array("AuthVerified"=>"verified", "expire_tme"=>$expire_tme,"validation_message"=>"");
	$Auth_string = json_encode($Autharray);
	echo $Auth_string;
}
else
{
	$Autharray=array("validation_message"=>"Wrong Credentials");
	$Auth_string = json_encode($Autharray);
	echo $Auth_string;
	
}

//Array ( [auth_username] => testd4luser [auth_password] => d4lapi1234 [bidder_username] => bidder@d4l.com [bidder_password] => bidderpwd )
