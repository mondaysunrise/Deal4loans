<?php
define('API_URL', 'http://www.deal4loans.com/api/v1/callerapp');
require '../../../scripts/db_init.php';
 require '../../../scripts/functions.php';
  
function initiateCall($Name,$Mobile_Number,$BidderContact)
{
	$param = '';
	$param["uid"] = 3847;
	$param["pwd"] = "clk2cald4l32";
	$param["wphone"] = $Mobile_Number;
	$param["wname"] = "http://www.deal4loans.com";
	$param["dcalltime"] = 5; // call will get disconnected after 5 mnts
	$param["vphone"] = $BidderContact;
	$param["vname"] = $Name;
	$request = '';
	foreach($param as $key=>$val) { $request.= $key."=".urlencode($val); $request.= "&"; }
	$request = substr($request, 0, strlen($request)-1); 
//http://www.hostedivr.in/cc/cc2.php?uid=<userid>&pwd=<password>&wphone=<website number>&wname=<website name>&dcalltime=<value in minutes>&vphone=<visitor number>&vname=<visitor name>
	$host = "www.hostedivr.in";
	$script = "/cc/cc2.php";
	$request_length = strlen($request);
	$method = "GET"; // must be POST if sending multiple messages
	if ($method == "GET") { $script .= "?$request";	}
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

	//print_R($output);
	if($output[8]>0) {  $returnValue = "Success"; }
	else { $returnValue = "Failed";}
	//$returnValue = $param;
	//$returnValue = $Mobile_Number.", ".$Name;
	/*$insertSql = "INSERT INTO `click2call` (`Name`, `Mobile_Number`, `returnID`, `Status`, `Dated`) VALUES ( '".$Name."', '".$Mobile_Number."', '".$output[8]."', '".$returnValue."', Now())";
	$insertQuery = ExecQuery($insertSql);
	$ID = mysql_insert_id();
	
	if($returnValue == "Success")
	{
		$returnValue .= "##".$ID;
	}
	else 
	{
		$returnValue .= "##0";
	}
	*/
	 return ($returnValue); 
 } 
//ClickCall

	function authcheck($AuthUsername,$AuthPassword)
	{
		// Check Authentication 
		$authCurl = curl_init();
		$data = array(
			"auth_username" => $AuthUsername,
			"auth_password" => $AuthPassword,
		   );
		$data_string = json_encode($data);
		$AURL = API_URL."/bidder-login.php";
		curl_setopt($authCurl, CURLOPT_URL, $AURL);
		curl_setopt($authCurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($authCurl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($authCurl, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($authCurl, CURLOPT_RETURNTRANSFER, true);
		$authOutput = curl_exec($authCurl);
		$err = curl_error($authCurl);
		curl_close($authCurl);
		
		$authOutputDecode = json_decode($authOutput, TRUE);
		if($authOutputDecode["validation_message"]=='')
		{
		$_SESSION['access_token'] = $authOutputDecode['AuthVerified'];
		$_SESSION['expire_tme'] = $authOutputDecode['expire_tme'];
		$_SESSION['set'] = true;
		// set expire time
		$_SESSION['expire'] = time() + $_SESSION['expire_tme']; // static expire
		}

		return($authOutputDecode);
	}

	$fp = fopen('php://input', 'r');
	$rawData = stream_get_contents($fp);

	$BiddersObj = json_decode($rawData, true);
	$AuthUsername = $BiddersObj["auth_username"];
	$AuthPassword = $BiddersObj["auth_password"];
	$customer_Name = $BiddersObj["customer_Name"];
	$CustmerContact = $BiddersObj["custmer_contact"];
	$BidderContact = $BiddersObj["bidder_contact"];
	$authOutputDecode=authcheck($AuthUsername,$AuthPassword);

	//$Name,$Mobile_Number,$BidderContact

	$AuthVerified = $authOutputDecode['AuthVerified'];

	if($AuthVerified=="verified")
	{
	
	$returnValue= initiateCall($customer_Name,$CustmerContact,$BidderContact);
	if($returnValue=="Success"){
	//echo "1:";
		$responseArray=array("status"=>"true");
		//$responseArray=array_merge($extraarray,$row);
		echo $responsefinal = json_encode($responseArray);
	}
	else
		{
		//echo "2:";
			//	echo "<br>--------------start---------";
			$responseArray=array("status"=>"false", "validation_message"=>"Failed to Connect");

			$responsefinal = json_encode($responseArray);
			echo $responsefinal;
			//echo "<br>--------------end---------";
		}
	}
	else
	{
		//echo "3:";
		$extraarray=array("status"=>"false");
		$responseArray=array_merge($extraarray,$authOutputDecode);
		echo $responsefinal = json_encode($responseArray);
	}

// add tag
//echo $responsfinal;

