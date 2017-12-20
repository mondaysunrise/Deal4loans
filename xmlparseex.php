<?php 

 $xml_string ='<?xml version="1.0" encoding="UTF-8"?><S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/"><S:Body><ns2:createShortFormResponse xmlns:ns2="http://services.lending.kastle.infotech.com/"><return><errorCode>0</errorCode><errorInfo>Success</errorInfo><id>41261</id><referenceCode>LED/LOAN/0516/41261</referenceCode></return></ns2:createShortFormResponse></S:Body></S:Envelope>';

$expires = preg_split('/errorInfo/', $xml_string);
			array_shift($expires);
			$strcheck=implode(" ",$expires);
	echo		$check=explode(" ",$strcheck);

	print_r($check);

	echo $check[0];
	echo "<br><br>";
echo $xml_string =  str_replace(">", "", str_replace("</", "", $check[0]));
//echo "errorCode - ".$xml->createShortFormResponse;
//echo $xml;
?>
