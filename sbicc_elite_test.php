<?php
@set_time_limit(1000);
require 'scripts/db_init.php';

$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:qde="http://qde.service.los" xmlns:xsd="http://to.service.los/xsd">
   <soapenv:Header/>
   <soapenv:Body>
      <qde:invoke>         
         <qde:losRequest>           
            <xsd:data>
<![CDATA[
<ApplicationIngestionRequest>
<LeadRefNo></LeadRefNo>
<BranchCode></BranchCode>
<SourceCode>MUMEAP</SourceCode>
<SECode>DEAl4LOANS</SECode>
<PromoCode>SCEA</PromoCode>
<CardType>MMSU</CardType>
<PromoGroup>EA</PromoGroup>
<ChannelCode>EAPL</ChannelCode>
<Salutation>1</Salutation>
<FirstName>TARSEM</FirstName>
<MiddleName></MiddleName>
<LastName>SINGH</LastName>
<DOB>01/01/1985</DOB>
<Mobile>9811215146</Mobile>
<Gender>M</Gender>
<Qualification>POST GRADUATE</Qualification>
<PAN>CDNPS9278L</PAN>
<EmailAddress>SUDHANSHU@gmail.com</EmailAddress>
<ResiAddress1>28 bandra</ResiAddress1>
<ResiAddress2>VIHAR NEAR</ResiAddress2>
<ResiAddress3>KARKARDUMA</ResiAddress3>
<ResiCity>MUMBAI</ResiCity>
<ResiState>MAH</ResiState>
<ResiPin>110509</ResiPin>
<ResiPhone></ResiPhone>
<ResiStdCode>022</ResiStdCode>
<OccupationType>S</OccupationType>
<AlternateCardNo></AlternateCardNo>
<Designation>Manager</Designation>
<CompanyName>INFOSYS LTD</CompanyName>
<NatureOfBusiness>A</NatureOfBusiness>
<OfficeAddress1>E bandra</OfficeAddress1>
<OfficeAddress2>, NEAR CHOWKI</OfficeAddress2>
<OfficeAddress3>NOIDA</OfficeAddress3>
<OfficePhone>11111</OfficePhone>
<OfficeStdCode>022</OfficeStdCode>
<OfficeState>MAH</OfficeState>
<OfficeCity>MUMBAI</OfficeCity>
<YearsOfCurrentEmployment>2</YearsOfCurrentEmployment>
<OfficePin>110509</OfficePin>
<TextSpareField1>865630</TextSpareField1>
<TextSpareField2>1</TextSpareField2>
<TextSpareField3>1</TextSpareField3>
<TextSpareField4>1</TextSpareField4>
<TextSpareField5>1</TextSpareField5>
<NumericSpareField1>1</NumericSpareField1>
<NumericSpareField2>1</NumericSpareField2>
<NumericSpareField3>1</NumericSpareField3>
<NumericSpareField4>1</NumericSpareField4>
<NumericSpareField5>1</NumericSpareField5>
<DateSpareField1>07/12/2016</DateSpareField1>
<DateSpareField2>07/12/2016</DateSpareField2>
<DateSpareField3>07/12/2016</DateSpareField3>
<DateSpareField4>07/12/2016</DateSpareField4>
<DateSpareField5>07/12/2016</DateSpareField5>
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
               <xsd:password>de@l4loan5</xsd:password>              
               <xsd:userId>79584822</xsd:userId>
            </xsd:userCtx>
         </qde:losRequest>
      </qde:invoke>
   </soapenv:Body>
</soapenv:Envelope>';
echo $xmlstr."<br><Br>";
$url = 'http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/ApplicationIngestionService?wsdl';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
echo $output = curl_exec($ch);
curl_close($ch); 
?>
