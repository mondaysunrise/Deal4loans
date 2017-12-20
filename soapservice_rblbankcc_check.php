<?php 
@set_time_limit(2000);
require_once ("lib/nusoap.php");


/*UAT url: http://uat-r2.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl 
On clicking above link, the following Server Credentials need to be entered:
User Name: rupeepower_rblbank
Password: sdfk7823rbl
Below are the User Credentials to be passed in the API Request:
User ID: cc_connector_2
Pwd: dfl@uat!


Production URL: https://rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl
Username: cc_connector_2
Password: dfl6prd$42*ats5

*/
//$auth = array("Authentication"=>array("UserId"=>"cc_connector_2", "Password"=>"dfl@uat!"));// for UAT
$auth = array("Authentication"=>array("UserId"=>"cc_connector_2", "Password"=>"pd9DFL2ua23X"));// for production
$cust_details = array("CreditCard"=>array("Version"=>6, "ConUniqRefCode"=>"rbl122345", "CreditCardApplied"=>"16", "HadLoanOrCreditCardFromAnyBank"=>"N", "Title"=>"1","FirstName"=>"Shweta", "MiddleName"=>"","LastName"=>"sharma","FatherName"=>"","Gender"=>2,"DOB"=>"30-11-1984","ResAddress1"=>"Koramangala, HSR Layout, NGV", "ResAddress2"=>"", "Landmark"=>"","ResCity"=>"318", "ResPIN"=>"110001", "Email"=>"shweta@d4l.com", "Mobile"=>"9971396361", "EmpType"=>"1", "NMI"=>"90000", "PAN"=>"AAAPA1112A"));
$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));               				
           
//$info = $soapClient->call("creditCard", array($request_arr), "http://uat-r2.rupeepower.com/connector/RPCreditCardConnector.wsdl");

//$ws_ur = 'http://uat-r2.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl'; // For UAT
$ws_ur = 'https://rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl'; // For Production

//$soapParams = array('UserId' => 'rupeepower_rblbank','Password' => 'sdfk7823rbl');
/*
$UserId="rupeepower_rblbank";
$Password="sdfk7823rbl";
$soapClient = new nusoap_client("http://uat-r2.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl",true);   
$soapClient->setCredentials($UserId, $Password, "basic");  
$info = $soapClient->call("creditCard", $request_arr);// For UAT
*/
$UserId="cc_connector_2";
$Password="pd9DFL2ua23X";
//$auth = array("Authentication"=>array("UserId"=>"cc_connector_2", "Password"=>"pd9DFL2ua23X"));
$soapClient = new nusoap_client("https://rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl",true);   
$soapClient->setCredentials($UserId, $Password, "basic");  
$info = $soapClient->call("creditCard", $request_arr);// For UAT


print_r($info);
//echo "<pre>";print_r($soapClient);

//for production
/*$client = new SoapClient($ws_ur);
$info = $client->__soapCall('creditCard', $request_arr);
print_r($info);
//echo "<pre>";print_r($soapClient);
*/
//testcases
//stdClass Object ( [Status] => 3 [ReferenceCode] => #CCWV415DG [EligibleCard] => 0 [Errorcode] => 0 [Errorinfo] => [RequestIP] => 180.179.212.193 ) 
//stdClass Object ( [Status] => 3 [ReferenceCode] => #CCLZSVYBF [EligibleCard] => 0 [Errorcode] => 0 [Errorinfo] => [RequestIP] => 180.179.212.193 ) 
/*********************************************************************************/
//CURL with WSDL authetication
/*********************************************************************************/
/*$xmlstr='<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:creditCard">
   <soapenv:Header/>
   <soapenv:Body>
      <urn:creditCard soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
         <RPRequest xsi:type="urn:RPRequest">
            <!--You may enter the following 2 items in any order-->
            <Authentication xsi:type="urn:Authentication">
               <!--You may enter the following 2 items in any order-->
               <UserId xsi:type="xsd:string">cc_connector_2</UserId>
               <Password xsi:type="xsd:string">dfl@uat!</Password>
            </Authentication>
            <CreditCard xsi:type="urn:CreditCard">
               <!--You may enter the following 28 items in any order-->
               <Version xsi:type="xsd:int">6</Version>
               <ConUniqRefCode xsi:type="xsd:string">123456</ConUniqRefCode>
               <CreditCardApplied xsi:type="xsd:int">13</CreditCardApplied>
               <HadLoanOrCreditCardFromAnyBank xsi:type="xsd:string">N</HadLoanOrCreditCardFromAnyBank>
               <Title xsi:type="xsd:int">1</Title>
               <FirstName xsi:type="xsd:string">MyName</FirstName>
               <MiddleName xsi:type="xsd:string">HisName</MiddleName>
               <LastName xsi:type="xsd:string">HerName</LastName>
               <FatherName xsi:type="xsd:string">ThatName</FatherName>
               <Gender xsi:type="xsd:int">1</Gender>
               <DOB xsi:type="xsd:string">25.12.1960</DOB>
               <ResAddress1 xsi:type="xsd:string">Koramangala, HSR Layout, NGV</ResAddress1>
               <ResAddress2 xsi:type="xsd:string">MG ROad, Brigade Road</ResAddress2>
               <Landmark xsi:type="xsd:string">No Landmark</Landmark>
               <ResCity xsi:type="xsd:int">7</ResCity>
               <ResPIN xsi:type="xsd:unsignedLong">600000</ResPIN>
               <Email xsi:type="xsd:string">noname@rbl.com</Email>
               <Mobile xsi:type="xsd:unsignedLong">9845012345</Mobile>
               <EmpType xsi:type="xsd:int">1</EmpType>
               <NMI xsi:type="xsd:unsignedLong">212343454</NMI>
               <PAN xsi:type="xsd:string">AOPPS0838H</PAN>
               <OTP xsi:type="xsd:int"></OTP>
               <Token xsi:type="xsd:string"></Token>
               <Param1 xsi:type="xsd:string"></Param1>
               <Param2 xsi:type="xsd:string"></Param2>
               <Param3 xsi:type="xsd:string"></Param3>
               <Param4 xsi:type="xsd:string"></Param4>
               <Param5 xsi:type="xsd:string"></Param5>
            </CreditCard>
         </RPRequest>
      </urn:creditCard>
   </soapenv:Body>
</soapenv:Envelope>';
$username= "rupeepower_rblbank";
$password="sdfk7823rbl";
$url = 'http://uat-r2.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_TIMEOUT, 4); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlstr); 
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: close'));
$output = curl_exec($ch);
$info=curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
print_r($output);
print_r($info);

*/
?>