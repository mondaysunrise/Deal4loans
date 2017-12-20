<?php
require_once ("lib/nusoap.php");
$xmlstr="<CLRequest>            
	<Authentication>               
	   <UserId>Deal4Loans</UserId>
	   <Password>4prdwQ!xM</Password>
	</Authentication>
	<CreateLead>               
	   <Version>1</Version>
	   <PartnerUnqId>12340</PartnerUnqId>
	   <ProductType>9</ProductType>
	   <FirstName>Balbir</FirstName>
	   <MiddleName></MiddleName>
	   <LastName>Singh</LastName>
	    <ResCity>318</ResCity>
	   <Email>rajesh.b@rupeepower.com</Email>
	   <Mobile>9717594462</Mobile>
	   <GMI>100000</GMI>
	   <LoanAmt>2000000</LoanAmt>
	</CreateLead>
 </CLRequest>"; 

echo $xmlstr."<br>";
echo "<br><br>";

$url ='http://instantloan.pnbhousing.com/connector/RPHomeLoanConnector.wsdl?wsdl';
  $soapClient = new nusoap_client("http://instantloan.pnbhousing.com/connector/RPHomeLoanConnector.wsdl?wsdl", true);

  $info = $soapClient->call("createLead", $xmlstr, "http://instantloan.pnbhousing.com/connector/RPHomeLoanConnector.wsdl?wsdl" );

  print_r($info);
  echo "<br><br>";
  print_R($info["Status"]);
//Swastika Biswas bswastika006@gmail.com Female 9873678914
?>


