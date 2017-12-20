<?php
  	require 'scripts/functions.php';
	//echo "hello1<br>";
	 $Mobile_No = $_REQUEST['get_Mobile'];
	//echo "hello<br>";
	
	$Reference_Code = generateNumber(4);
echo $Reference_Code;
//print_r($_REQUEST);
if((strlen(trim($Mobile_No))>9))
{

	$SMSMessage = "Dear Customer, your activation code is: ".$Reference_Code.". Help us to serve you better.";

	//if(strlen(trim($Mobile_No)) > 0)
					//SendSMS($SMSMessage, $Mobile_No);


					
	
}
	
	
?>
