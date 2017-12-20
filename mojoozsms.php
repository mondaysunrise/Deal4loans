<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
 $cutomermobile=$_REQUEST['cutomermobile'];
 $customermsg = $_REQUEST['customermsg'];

if(strlen(trim($cutomermobile)) > 0)
		SendSMS($customermsg, $cutomermobile);

}

//://luna.a2wi.co.in:7501/failsafe/HttpLink?Message Accepted for Request ID=42312469685965802147702~code=API000 & info=Air2web accepted & Time =2009/07/07/05/39

function SendSMS($SMSMessage, $PhoneNumber)
{
	//echo "hello";
	$request = ""; //initialize the request variable
	$param['aid']= "9581";
	$param['pin'] = "rsi42";
	$param["mnumber"] = "91".$PhoneNumber; //these are the recipients of the message
	$param["message"] = $SMSMessage; //this is the message that we want to send
	
	

	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	//First prepare the info that relates to the connection
	$host = "luna.a2wi.co.in:7501";
	$script = "/failsafe/HttpLink";
	$request_length = strlen($request);
	$method = "POST";  // must be POST if sending multiple messages
	if ($method == "GET") 
	{
	  $script .= "?$request";
	}
echo $method.$script."<br>";
echo $request;
	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";
echo $host."<br>";
	//Now we open up the connection
	$socket = @fsockopen($host, 7501, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  fclose($socket); 
	}

	print "<pre>";
	print_r($output);
	print "</pre>";

}
	








?>

<html>
<head></head>
<body>
<form name="sendmsg" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>"> 
<table width="600" cellpadding="0" cellspacing="2" border="0" style="border:1px solid black;" align="center">
<tr><td colspan="2" align="center"><font style="font-family:verdana;size:13px;font-weight:bold;">MOJOOZ</font></td></tr>
<tr><td colspan="2" align="center"><font style="font-family:verdana;size:13px;font-weight:bold;">fill details to send SMS</font></td></tr>
<tr><td><font style="font-family:verdana;size:10px;font-weight:bold">Mobile No</font></td><td><input type="text" name="cutomermobile" id="cutomermobile"></td></tr>
<tr><td><font style="font-family:verdana;size:10px;font-weight:bold;">Message</font></td><td><textarea rows="2" cols="20" name="customermsg" id="customermsg"></textarea></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Submit"></td></tr>
</table>

</form>

</body>
</html>
