<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
		
	$Mobile_No = $_REQUEST['get_mobile_no'];
	$activation_code = $_REQUEST['activation_code'];
	$UID = $_REQUEST['get_Id'];
	
	
	if(strlen($UID)>0)
	{
		//update 
		$Reference_Code = $UID;
		$sendValue = $UID;
	}
	else
	{
		$Reference_Code = generateNumber(4);
		if(strlen(trim($Mobile_No)) > 0)
		{
			$Validate_RefCode = 0;
		}
		else
		{
			$Validate_RefCode = 1;
		}
		
		$SMSMessage = "Dear Customer, Thanks for applying Barclays Credit Card. Please use the Activation code $Reference_Code in the online form to validate your interest in the card.";
		
		if(strlen(trim($Mobile_No)) > 0)
		{
			SendSMS($SMSMessage, $Mobile_No);
		}	
		
		$sendValue = $Reference_Code;
	
	}
	
	
	echo $sendValue;		


?>
