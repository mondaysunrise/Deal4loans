<?php
require 'scripts/functions.php';

$phoneNumber = $_POST['phone'];
$reference_code = $_POST['reference_code'];


if(strlen($phoneNumber)>=10 && strlen($reference_code)>=4)
{	
	$SMSMessage = "Please use this code: ".$reference_code."  to activate your loan request at deal4loans.com";
		if(strlen(trim($phoneNumber)) > 0)
			SendSMSforLMS($SMSMessage, $phoneNumber);
}

?>