<?php
//No Query  in this
 require 'scripts/db_init.php';
 require 'scripts/functions.php';
 require_once("lib/nusoap.php"); 
 
 $ns="http://www.deal4loans.com/click2call.php"; 
 $server = new nusoap_server(); 
 $server->configureWSDL('Click2ConnectService',$ns, '', 'document'); 
 $server->wsdl->schemaTargetNamespace=$ns; 
 
myRegister ($server,'initiateCall', array( 'in' => array('Name' => 'xsd:string','Mobile_Number' => 'xsd:string'), 'out' => array('return'=>'xsd:string')));
  
function myRegister( &$server, $methodname, $params) {
	$server->register($methodname, $params["in"], $params["out"],
	'http://www.deal4loans.com/click2call.php', // namespace
	$server->wsdl->endpoint .'#'. $methodname, // soapaction
	'document', // style
	'literal', // use
	'N/A' // documentation
	);
}

function initiateCall($Name,$Mobile_Number)
{ 
$Name = 'Upendra';
$Mobile_Number = 9971396361;
 	/*$param = '';
	$param["uid"] = 3847;
	$param["pwd"] = "1cfc51sn";
	$param["wphone"] = '9971396361';
	$param["wname"] = "http://www.deal4loans.com";
	$param["dcalltime"] = 5; // call will get disconnected after 5 mnts
	$param["vphone"] = $Mobile_Number;
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
	if($output[8]>0) {  $returnValue = "Success"; }
	else { $returnValue = "Failed";}
	//$returnValue = $param;
	//$returnValue = $Mobile_Number.", ".$Name;
	$insertSql = "INSERT INTO `click2call` (`Name`, `Mobile_Number`, `returnID`, `Status`, `Dated`) VALUES ( '".$Name."', '".$Mobile_Number."', '".$output[8]."', '".$returnValue."', Now())";
	$insertQuery = ExecQuery($insertSql);
		*/
	return new soapval('return','xsd:string',$Mobile_Number); 
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = implode("\r\n", file('php://input'));
$server->service( $HTTP_RAW_POST_DATA); 
?>