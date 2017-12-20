<?php
ini_set('max_execution_time', 1000);

//$auth = array("Authentication"=>array("UserId"=>"pl_connector_6", "Password"=>"d4l@uAT1@!"));//UAT
$auth = array("Authentication"=>array("UserId"=>"pl_connector_5", "Password"=>"pd!8Gq(b49KK#@d4l"));//LIVE

$cust_details = array("PersonalLoan"=>array("Version"=>"3","ConUniqRefCode"=>"12345678","FirstName"=>"rajesh","MiddleName"=>"","LastName"=>"kumar","DOB"=>"08-03-1987","Gender"=>"1","Qualification"=>"4","PAN"=>"AAEPK4332W","ResType"=>"1","Email"=>"rajesh.b@rupeepower.com","ResAddress1"=>"baikdjd","ResAddress2"=>"fevfev","Landmark"=>"feevefv","ResPIN"=>"110022","ResCity"=>"318","ResPhone"=>"23443334","Mobile"=>"9873678920","ResAccoType"=>"0","EmpType"=>"1","Organization"=>"Google","TypeOfOrg"=>"5","Profession"=>"0","WorkExp"=>"6","Industry"=>"45","MonthsCurrentOrg"=>"20","SalaryBank"=>"170","OffAddress1"=>"hejfhne3","OffAddress2"=>"reerg","OffPIN"=>"110042","OffCity"=>"318","OffPhone"=>"22387832","OffPhoneExtn"=>"","GMI"=>"200000","CurrentEMI"=>"","TaxITRCurrYr"=>"","TaxITRPrevYr"=>"","CurrYrGrosTurnOver"=>"","CurrYrBusinessIncome"=>"","CurrYrOtherIncome"=>"","DepreciationPLAcc"=>"","LoanAmount"=>"2000000","TenureMonths"=>"36","IRR"=>"10.15","ProcFee"=>"2003","ExistingRelationship"=>"0","IncomeProof"=>"1"));
echo "<pre>";

$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));
print_r($request_arr);
$ws_ur = 'https://apply.standardchartered.co.in/connector/RPPersonalLoanConnector.wsdl?wsdl';

$client = new SoapClient($ws_ur);
$result = $client->__soapCall('personalLoan', $request_arr);
print_r($result);
//stdClass Object ( [Status] => 0 [ReferenceCode] => #CCFCWV68D [Errorcode] => 6 [Errorinfo] => Duplicate application [RequestIP] => 180.179.212.193 ) 
/*echo $data=$result->Status;
echo "<br><br>";
echo $data=$result->ReferenceCode;
echo "<br><br>";
$request_data = implode(",",$result);
echo "<br><br>";
echo $request_data;
*/
  
?>
