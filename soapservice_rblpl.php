<?php
@set_time_limit(2000);
require_once 'lib/nusoap.php';
$auth = array("Authentication"=>array("UserId"=>"pl_connector_28", "Password"=>"d4l@uat"));
$cust_details = array("PersonalLoan"=>array("Version"=>4, "ConUniqRefCode"=>"6512323","FirstName"=>"Yaswant", "MiddleName"=>"", "LastName"=>"Chauhan", "Gender"=>1, "DOB"=>"05-03-1986", "Qualification"=>2, "ResAddress1"=>"Noida", "ResAddress2"=>"", "ResLand"=>"", "ResCity"=>78, "ResPIN"=>201301, "ResType"=>4, "CurResSince"=>"01-01-2010", "Email"=>"yaswant.chauhan@deal4loans.com", "Mobile"=>"9555060321", "EmpType"=>1, "CompanyName"=>"Mywish Market Place", "OrgCategory"=>2, "TotWrkExp"=>5, "CurCmpnyJoinDt"=>"02-03-2015", "NMI"=>50000, "EmiCurPay"=>0, "OffAddress1"=>"Noida", "OffAddress2"=>"", "OffCity"=>318, "OffPIN"=>201301, "OffPhone"=>"", "PAN"=>"AUFPC4323A", "LnAmt"=>300000, "TnrMths"=>36, "IRR"=>14, "ProcFee"=>2011));
//echo "<pre>";

$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));

$UserId="rupeepower_rblbank";
$Password="sdfk7823rbl";
$soapClient = new nusoap_client("http://uat-r2.rupeepower.com/connector/RPPersonalLoanConnector.wsdl?wsdl",true);   
$soapClient->setCredentials($UserId, $Password, "basic");  
$result = $soapClient->call("personalLoan", $request_arr);// For UAT

//$ws_ur = 'http://uat-r2.rupeepower.com/connector/RPPersonalLoanConnector.wsdl?wsdl';
//$client = new SoapClient($ws_ur);
//$result = $client->__soapCall('personalLoan', $request_arr);

print_r($result);
echo $result->Errorinfo;
echo $result->Errorcode;

?>