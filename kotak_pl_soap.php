<?php
ini_set('max_execution_time', 2000);
$auth = array("Authentication"=>array("UserId"=>"pl_connector_7", "Password"=>"d4l#prd#!Qx7(19Loo"));
$cust_details = array("PersonalLoan"=>array("Version"=>1, "IsExstCust"=>"N", "ExstCustType"=>0, "CRN"=>"", "PartyID"=>"", "FirstName"=>"ranjana", "MiddleName"=>"", "LastName"=>"Chauhan", "DOB"=>"01-11-1981", "Gender"=>1, "Qualification"=>11, "ResAddress1"=>"badli", "ResAddress2"=>"", "ResAddress3"=>"nagar", "ResCity"=>318, "ResPin"=>110092, "ResType"=>11, "CurResSince"=>"01-01-1999", "ResPhNo"=>2879012, "Mobile"=>"9873597613", "Email"=>"ranjana@gmail.com", "Aadhar"=>"","EmpType"=>1, "Organization"=>"Google", "TotWrkExp"=>5, "CurCmpnyJoinDt"=>"02-01-2015", "NMI"=>100000, "EmiCurPay"=>0, "OffAddress1"=>"badli","OffAddress2"=>"", "OffAddress3"=>"nagar","OffCity"=>318, "OffPin"=>110042, "OffPhone"=>"", "PrefMailAdd"=>1, "PerAddress1"=>"badli", "PerAddress2"=>"", "PerAddress3"=>"nagar", "PerCity"=>"318", "PerPin"=>"110042", "PerResPhNo"=>"", "PAN"=>"AAAPA1234A", "LnAmt"=>300000, "TnrMths"=>36, "IRR"=>14, "ProcFee"=>2011, "IsCoApp"=>"N", "CoAppReltn"=>"","CoAppDOB"=>"", "CoAppEmpType"=>"", "CoAppOrg"=>"", "CoAppNMI"=>"", "CoAppEmiCurPay"=>""));

//echo "<pre>";

$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));

//print_r($request_arr);
$ws_ur = 'https://rcasprod.kotak.com/connector/RPPersonalLoanConnector.wsdl?wsdl';
$client = new SoapClient($ws_ur);
$result = $client->__soapCall('personalLoan', $request_arr);


print_r($result);
echo $result->Errorinfo;
echo $result->Errorcode;

  
//*********************************************************************
// SHORT FORM
//*******************************************************************************/
/*User - deal4loans
Pwd - d4l@uat123
UniqueRefCode prefix - 240
*/



//$auth = array("Authentication"=>array("UserId"=>"deal4loans", "Password"=>"d4l@uat123"));//UAT
/*$auth = array("Authentication"=>array("UserId"=>"Deal4loAns", "Password"=>"d4l!2@4Uiq!hJ"));
$cust_details = array("CustData"=>array("Version"=>1, "UniqueRefCode"=>"230010", "IsExstCust"=>"N", "ExstCustType"=>0, "CRN"=>"", "PartyID"=>"", "FirstName"=>"test", "MiddleName"=>"", "LastName"=>"november", "DOB"=>"06-11-1980", "ResCity"=>26, "ResType"=>2, "Mobile"=>"9717594468", "Email"=>"test23nov2016@gmail.com", "Aadhar"=>"","EmpType"=>1, "Organization"=>"WRS", "NMI"=>500000, "EmiCurPay"=>0, "OtpVerified"=>"Y"));
//echo "<pre>";

$request_arr = array("InsertDOLeadRequest"=>array_merge($auth, $cust_details));

print_r($request_arr);

$ws_ur = 'https://rcasprod.kotak.com/connector/RPPersonalLoanConnector.wsdl?wsdl';// live
//$ws_ur = 'http://122.180.94.59:8135/connector/RPPersonalLoanConnector.wsdl?wsdl';//UAT
$client = new SoapClient($ws_ur);
$result = $client->__soapCall('insertDOLead', $request_arr);


print_r($result);
echo $result->Errorinfo;
echo $result->Errorcode;

*/
?>