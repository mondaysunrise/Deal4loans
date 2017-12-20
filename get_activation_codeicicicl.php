<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$Mobile_No = $_REQUEST['get_Mobile'];
	$Reference_Code = generateNumber(4);
	$First=$_REQUEST['get_name'];


if((strlen($Mobile_No)>9) && (strlen($Reference_Code)>0))
{
	$SMSMessage = "Dear $First,your activation code is: $Reference_Code.Use it to get the quotes. And help us serve you better";

			if(strlen(trim($Mobile_No)) > 0)
				SendSMS($SMSMessage, $Mobile_No);
	
	echo $Reference_Code;		
}
?>
