<?php
require_once ("lib/nusoap.php");
$xmlstr="<CLRequest>            
	<Authentication>               
	   <UserId>Deal4loans</UserId>
	   <Password>pl@123UAT</Password>
	</Authentication>
	<CreateLead>               
	   <Version>1</Version>
	   <PartnerUnqId>12340</PartnerUnqId>
	   <FirstName>Ranjana</FirstName>
	   <MiddleName></MiddleName>
	   <LastName>Chauhan</LastName>
	   <DOB>08-10-1984</DOB>
	   <Mobile>9873678915</Mobile>
	   <Email>testlead@deal4loans.com</Email>
	   <EmpType>1</EmpType>
	   <GMI>200000</GMI>
	   <CurResCity>25</CurResCity>
	   <LnAmt>500000</LnAmt>
	</CreateLead>
 </CLRequest>"; 

echo $xmlstr."<br>";
echo "<br><br>";

$url ='http://uat-icicibank.rupeepower.com/connector/RPPersonalLoanConnector.wsdl?wsdl';
  $soapClient = new nusoap_client("http://uat-icicibank.rupeepower.com/connector/RPPersonalLoanConnector.wsdl?wsdl", true);

  $info = $soapClient->call("createLead", $xmlstr, "http://uat-icicibank.rupeepower.com/connector/RPPersonalLoanConnector.wsdl?wsdl" );

  print_r($info);
//Swastika Biswas bswastika006@gmail.com Female 9873678914
?>


