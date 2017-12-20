<?php
	require 'scripts/db_init.php';
	
	//$SMSMessage = "Test Msg"; 
	$PhoneNumber = 9971396361;

$SMSMessage = "Use this activation code $Reference_Code to get quotes from all Banks on Deal4loans.com. By this you authorize us and our partners to contact you for your loan application";
echo $msgLength = strlen($SMSMessage);
echo "<br>";
 echo	$countSms = ceil($msgLength/160);

$a = SendSMSBySnowWeb($SMSMessage, $PhoneNumber,3,111);
echo $a;

function SendSMSBySnowWeb($SMSMessage, $PhoneNumber,$Reply_Type,$RequestID)
{
	$request = ""; 
	$param["user"] = "deal"; 
	$param["password"] = "deal123"; 
	$param["text"] = $SMSMessage;
	$param["phonenumber"] = $PhoneNumber;
	foreach($param as $key=>$val)
	{ 
	  $request.= $key."=".urlencode($val);
	  $request.= "&"; 
	}
	$request = substr($request, 0, strlen($request)-1);

//http://snowebs.co.in/pushsms/sendsms.php?user=deal&password=deal123&text=ThruAPI&phonenumber=9810318906
//http://122.160.50.151:8800/?user=deal&password=deal123&text=Hello+its+cool+now%21%21%21&phonenumber=9971396361
//http://122.160.50.151:8800/?user=deal&password=deal123&text=TestSMS&phonenumber=Mobile

	$host = "snowebs.co.in";
	$script = "/pushsms/sendsms.php";
	//$host = "122.160.50.151";
	//$script = "/";
	$request_length = strlen($request);
	$method = "GET"; // must be POST if sending multiple messages
	if ($method == "GET") 
	{
	  $script .= "?$request";
	}
//echo $request;
	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";

	//Now we open up the connection
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  fclose($socket); 
	}  
	print_r($output);
	
	$array14 = $output[16];

	$explodeArray14 = explode(",", $array14);
	$explodeArray14_1 = explode("=", trim($explodeArray14[1]));
	$getMob = trim($explodeArray14_1[1]);
	$msgLength = strlen($SMSMessage);
 	$countSms = ceil($msgLength/160);
	//if(strlen($getMob)>0)
	//{
		
		echo "<br>".$insSql;
	//}
	return $output;
}

?>

