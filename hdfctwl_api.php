<?php

$param="";
$param["txtFullName"] = "ranjana";
$param["txtEmail"] = "ranjana@deal4loans.com";
$param["txtMobile"] = "987678915";
$param["txtDOB"] = "1988-05-05";
$param["txtOccupation"] = "Salaried";
$param["txtCity"] = "Delhi";
$param["txtIncome"] = "900000";
$param["txtAmount"] = "200000";
$param["txtLead"] = "2017-05-16 18.48.50";
$param["txtProduct"] = "TWLD4L";
		
	$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		//$request = rawurldecode(substr($request, 0, strlen($request)-1)); //remove the final ampersand sign from the request
	/*		echo $request = substr($request, 0, strlen($request)-1);
		$url = "http://182.75.121.202/Dealinfo1/DealInfo.aspx";
		echo $url;
		echo "<br>";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_TIMEOUT, 4);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: text/xml','Content-Type: text/xml'));
		$content = curl_exec ($ch);
		print_r($content); 
		curl_close ($ch);  
		echo "<br>";
		echo $outputstr=$content;
		echo "<br>";
*/


$ch = curl_init();                    // initiate curl
$url = "http://182.75.121.202/Dealinfo1/DealInfo.aspx"; // where you want to post data
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, true);  // tell curl you want to post something
curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // define what you want to post
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
$output = curl_exec ($ch); // execute

curl_close ($ch); // close curl handle

var_dump($output); // show output

?>
