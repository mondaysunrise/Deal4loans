<?php
$auth = array("Authentication"=>array("UserId"=>"cc_connector_4", "Password"=>"d4l@uat!!!")); // For UAT

//$auth = array("Authentication"=>array("UserId"=>"cc_connector_4", "Password"=>"d4l@pd!!osJ20C5*)1"));

$cust_details = array("CreditCard"=>array("Version"=>3, "ConUniqRefCode"=>"scb_cards9019", "CreditCardApplied"=>9, "HasExistingScbCC"=>"N", "IsExtngScbCust"=>"Y", "CustReltnType"=>"18", "FirstName"=>"Rajan", "MiddleName"=>"", "LastName"=>"Chauhan", "Gender"=>1, "DOB"=>"01-10-1980", "Qualification"=>10, "ResAddress1"=>"E 32 Sector 8", "ResAddress2"=>"Ambala", "ResCity"=>318, "ResPIN"=>133001, "Email"=>"ranjana@deal4loans.com", "Mobile"=>"9873678920", "EmpType"=>1, "SalaryBankAcc"=>340, "AnnIncome"=>500000, "GMI"=>"42000", "CompanyName"=>'MMPL', "Designation"=>40, "IncomeProof"=>1,"IncomeProofValue"=>1, "PAN"=>"ANPPB5281B"));

$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));

echo $ws_ur = 'http://uat-bank001.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl'; // For UAT
//$ws_ur = 'https://apply.standardchartered.co.in/connector/RPCreditCardConnector.wsdl?wsdl';

/*$soapParams = array('login' => 'scb_rp_001',
                        'password' => 'ccpl007hlsa',
                        'authentication' => SOAP_AUTHENTICATION_BASIC,'trace' => 1,'exceptions' => 0);*/

$client = new SoapClient($ws_ur);
$result = $client->__soapCall('creditCard', $request_arr);
print_r($result);


echo $data=$result->Status;
echo "<br><br>";
echo $data=$result->ReferenceCode;
echo "<br><br>";
$request_data = implode(",",$result);
echo "<br><br>";
echo $request_data;

?>