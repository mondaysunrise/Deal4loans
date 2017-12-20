<?php
include("payments/citi.php");
$order = 10004;
 //citibankCC($order);
//function citibankCC($orderNumber)
//{	
//https://www.test.citibank.co.in/servlets/TransReq?MalltoCiti=0100|http%3A%2F%2Fwww.deal4loans.com%2Fthanks-for-payment.php|1|1234567890abcdef|20012009145322|22261169|10001|005810|100.00

echo "********************************************************************************<br>";
	$request = ""; //initialize the request variable
	
	$pushCode = "0100";
	$replyUrl = "http://www.deal4loans.com/thanks-for-payment.php";
	$totalRecords = "1";
	$checkSum = "1234567890abcdef";
	$dateFormat = date("dmYGis");
	$merchantCode = "22261169";	
	$orderNumber = "10004";
	$traceNumber = "005810";
	$Amount = "100.00";
	$testmecode = "22261169";
	$matchValue	= $testmecode;
	$finalCheckSum = $finalString;
	
	 $param["pushCode"] = $pushCode;
	 $param["replyUrl"] = $replyUrl; 
	 $param["totalRecords"] = $totalRecords;
	 $param["checkSum"] = $finalCheckSum;
 	 $param["dateFormat"] = $dateFormat;
	 $param["merchantCode"] = $merchantCode;
	 $param["orderNumber"] = $orderNumber;
	 $param["traceNumber"] = $traceNumber; 
	 $param["Amount"] = $Amount;
	  
	//  print_r($param);
	
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= urlencode($val); //we have to urlencode the values
		  $request.= "|"; //append the ampersand (&) sign after each paramter/value pair
		}
		$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
	//echo $request;
//$request = "0100|http://www.deal4loans.com/thanks-for-payment.php|1|1234567890abcdef|20012009160732|22261169|10004|005810|100.00|";
echo $request;
//		$request .= "DEALtoCITI="$request; 

	//First prepare the info that relates to the connection
//	https://www.citibank.co.in/servlets/TransReq?

//MalltoCiti=0100|https://mallsite.com|1|10671|14121999113919|44108020|1001|005810|120.00|
///servlets/TransReq?0100|http%3A%2F%2Fwww.deal4loans.com%2Fthanks-for-payment.php|1|1234567890abcdef|19012009152112|10001|005810|100.00

//	https://www.test.citibank.co.in/servlets/TransReq?DEALtoCITI=0100|http%3A%2F%2Fwww.deal4loans.com%2Fthanks-for-payment.php|1|1234567890abcdef|19012009152434|10001|005810|100.00
/*
	$host = "test.citibank.co.in";
	$script = "/servlets/TransReq";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages

	if ($method == "POST") 
	{
	  $script .= "?$request";
	}
echo "<br>";
	echo $script;
echo "<br>";
	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";
//	echo "<br>";
	//echo $host;
	//echo "<br>";
	
	$socket = @fsockopen($host, 80, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
	  echo "<br>";
		echo $socket;
		echo "<br>";
			$output[] = fgets($socket); //get the results
	  }
print_r($output);
	  fclose($socket); 
	} 
*/
//}

?>

<form name="citi" method="post" action="https://test.citibank.co.in/servlets/TransReq">
<input type="hidden" name="MalltoCiti" value="<?php echo $request."|"; ?>" />
<input type="submit" name="submit" value="submit" />
</form>