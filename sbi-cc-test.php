<?php
require 'scripts/db_init.php';

echo "d".$sbquery="select * from sbi_credit_card_5633 Where sbiccid=66";
$qryresult = ExecQuery($sbquery);
$rowcc=mysql_fetch_array($qryresult);
$output= $rowcc["response_xml"];
//print_r($output);
$xml_string =  str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
$xml_string =  str_replace("&lt;", "<", $xml_string);
//print_r($xml_string);

$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
//$xml_string = str_ireplace('</ns1:data>',"", $xml_string );
$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );

//print_r($xml_string);
$findme   = '</Error>';
$pos = strpos($xml_string, $findme);
list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
echo "1:";
print_r($firstxml);
echo "<br><br>";
echo "<br><br>";
echo "<br><br>";
echo "2:";
print_r($secondxml);

$xml = simplexml_load_string($firstxml);

//print_r($xml);

echo "<br>";
echo $LeadRefNumber = $xml->LeadRefNumber;
echo "<br>";
echo $ApplicationNumber = $xml->ApplicationNumber;
echo "<br>";
echo $StatusCode = $xml->StatusCode;
echo "<br>";
echo $ProcessingStatus = $xml->ProcessingStatus;
echo "<br>";
echo $CreditLimit = $xml->CreditLimit;
echo "<br>";
echo $code = $xml->code;
echo "<br>";
echo $message = $xml->message;
echo "<br>";
?>
