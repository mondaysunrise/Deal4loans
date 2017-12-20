 <?php
 echo "huh";
 //@set_time_limit(1000);
 /*$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:qde="http://qde.service.los" xmlns:xsd="http://to.service.los/xsd">
   <soapenv:Header/>
   <soapenv:Body>
      <qde:invoke>         
         <qde:losRequest>           
            <xsd:data>
<![CDATA[
<ApplicationIngestionRequest>
<LeadRefNo></LeadRefNo>
<BranchCode></BranchCode>
<SourceCode>AI01</SourceCode>
<SECode>DEAl4LOANS</SECode>
<PromoCode>SCEA</PromoCode>
<CardType>SSU2</CardType>
<PromoGroup>EA</PromoGroup>
<ChannelCode>EAPL</ChannelCode>
<Salutation>1</Salutation>
<FirstName>KUMAR</FirstName>
<MiddleName></MiddleName>
<LastName>LANKAPALLI</LastName>
<DOB>8/9/1960</DOB>
<Mobile>9971396360</Mobile>
<Gender>M</Gender>
<Qualification>Graduate</Qualification>
<PAN>AARPL8084G</PAN>
<EmailAddress>LANKAPALLI@gmail.com</EmailAddress>
<ResiAddress1>gandhi </ResiAddress1>
<ResiAddress2>nagar</ResiAddress2>
<ResiAddress3>Ahmedabad</ResiAddress3>
<ResiCity>Ahmedabad</ResiCity>
<ResiState>MAH</ResiState>
<ResiPin>380001</ResiPin>
<ResiPhone>2380001</ResiPhone>
<ResiStdCode></ResiStdCode>
<OccupationType>S</OccupationType>
<AlternateCardNo></AlternateCardNo>
 <Designation>ASSOCIATE DIRECTOR</Designation>
<CompanyName>LML LTD</CompanyName>
<NatureOfBusiness>A</NatureOfBusiness>
<OfficeAddress1>gandhi</OfficeAddress1>
<OfficeAddress2>nagar</OfficeAddress2>
<OfficeAddress3>Ahmedabad</OfficeAddress3>
<OfficePhone>2380001</OfficePhone>
<OfficeStdCode></OfficeStdCode>
<OfficeState>MAH</OfficeState>
<OfficeCity>Ahmedabad</OfficeCity>
<YearsOfCurrentEmployment>2</YearsOfCurrentEmployment>
<OfficePin>380001</OfficePin>
<TextSpareField1>1</TextSpareField1>
<TextSpareField2>1</TextSpareField2>
<TextSpareField3>1</TextSpareField3>
<TextSpareField4>1</TextSpareField4>
<TextSpareField5>1</TextSpareField5>
<FathersName></FathersName>
<NumericSpareField1>1</NumericSpareField1>
<NumericSpareField2>1</NumericSpareField2>
<NumericSpareField3>1</NumericSpareField3>
<NumericSpareField4>1</NumericSpareField4>
<NumericSpareField5>1</NumericSpareField5>
<DateSpareField1>12/01/2015</DateSpareField1>
<DateSpareField2>12/01/2015</DateSpareField2>
<DateSpareField3>12/01/2015</DateSpareField3>
<DateSpareField4>12/01/2015</DateSpareField4>
<DateSpareField5>12/01/2015</DateSpareField5>
<EmployeePFNumber></EmployeePFNumber>
<BranchManagerPFNumber></BranchManagerPFNumber>
<PriorityFlag>1</PriorityFlag>
<DateOfPickup></DateOfPickup>
<TimeOfPickup></TimeOfPickup>
<StatementPreference>E</StatementPreference>
<LoyaltyChannel></LoyaltyChannel>
<LoyaltyNumber></LoyaltyNumber>
<ActualFulfillmentDeviation>N</ActualFulfillmentDeviation>
<PhysicalAlreadyReceived>N</PhysicalAlreadyReceived>
<FathersName></FathersName>
<MothersMaidenName></MothersMaidenName>
<ResiLandmark></ResiLandmark>
<OfficeLandmark></OfficeLandmark>
</ApplicationIngestionRequest>
]]>
</xsd:data>
           <xsd:requestid></xsd:requestid>            
            <xsd:userCtx>               
               <xsd:password>Los@555</xsd:password>              
               <xsd:userId>555555555</xsd:userId>
            </xsd:userCtx>
         </qde:losRequest>
      </qde:invoke>
   </soapenv:Body>
</soapenv:Envelope>'; 
		//echo $xmlstr."<br>";
		//echo "<br><br>";
		$username=555555555;
		$password="Los@555";
	$url = 'http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/ApplicationIngestionService?wsdl';
		$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch); 
*/
//print_r($output);
echo $output="
<ApplicationIngestionResponse>
   <LeadRefNumber>190780000BANEAP07665</LeadRefNumber>
   <ApplicationNumber>1907801007622</ApplicationNumber>
   <StatusCode>118</StatusCode>
   <ProcessingStatus>1</ProcessingStatus>
   <CreditLimit>422000</CreditLimit>
</ApplicationIngestionResponse>
";
//$xml_string =  str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
// $xml_string =  str_replace("&lt;", "<", $output);


/*$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
$xml_string = str_ireplace('</ns1:data><ns1:errorCode xmlns:ns1="http://to.service.los/xsd">0</ns1:errorCode></qde:return></qde:invokeResponse></soapenv:Body>',"", $xml_string );
$xml_string = str_ireplace('</soapenv:Envelope>',"", $xml_string );
*/
$xml = simplexml_load_string($output);

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
echo $Message = $xml->Messages->Message;
echo "<br>";
?>