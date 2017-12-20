<?php
$IP_Remote = getenv("REMOTE_ADDR");
if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
else { $IP=$IP_Remote;	}

if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68"))
{

echo "Click 2 Call";
initiateCall("Ranjana","9811215138","9873678915");

function initiateCall($Name,$Mobile_Number,$BidderNumber)
{
	$param = '';
	$param["uid"] = 3847;
	$param["pwd"] = "clk2cald4l32";
	$param["wphone"] = $Mobile_Number;
	$param["wname"] = "http://www.deal4loans.com";
	$param["dcalltime"] = 5; // call will get disconnected after 5 mnts
	$param["vphone"] = $BidderNumber;
	$param["vname"] = $Name;
	$request = '';
	foreach($param as $key=>$val) { $request.= $key."=".urlencode($val); $request.= "&"; }
	$request = substr($request, 0, strlen($request)-1); 
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
	if($output[8]>0) {  $returnValue = "Success"; }
	else { $returnValue = "Failed";}
	$Dated = ExactServerdate();
		$data = array('Name'=>$Name, 'Mobile_Number'=>$Mobile_Number, 'returnID'=>$output[8], 'Status'=>$returnValue, "Dated"=>$Dated );
		$table = 'click2call';
		$ID = Maininsertfunc ($table, $data);
	
	if($returnValue == "Success")
	{
		$returnValue .= "##".$ID;
	}
	else 
	{
		$returnValue .= "##0";
	}

 } 
}
?>