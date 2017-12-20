<?php
//phpinfo();

echo "<br><br><br>";
function SendSMSforLMS($SMSMessage, $PhoneNumber)
{
	echo "hello";
	// 6161
	$param["pcode"] = "MICROFINANCIAL"; 
	$param["acode"] = "MICROFINANCIAL"; 
	$param["message"] = $SMSMessage; //this is the message that we want to send
	$param["mnumber"] = "91".$PhoneNumber; //these are the recipients of the message
	$param["pin"] = "mi@1";
	
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
 $script .= "?$request";
	
	//Now we open up the connection
	/*$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
		echo "hh";
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  print_r($output);
	  fclose($socket); */
	  
	  echo $url = 'http://luna.a2wi.co.in:7501/failsafe/HttpPublishLink'. $script;
		$ch = curl_init();  
		 
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		//  curl_setopt($ch,CURLOPT_HEADER, false); 
		 
			$output=curl_exec($ch);
		 
			curl_close($ch);
			echo "<br><br>///////////// <br>";
			
			echo $output;
						echo "<br>///////////////////<br><br>";
			print_r($output);
	  	
	//} 
}

$Phone="9811215138";
$SMScampMessage="i m here";
SendSMSforLMS($SMScampMessage, $Phone);
?>
