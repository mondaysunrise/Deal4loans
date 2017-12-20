<?php
$xmstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
   <soapenv:Header>
      <tem:AuthHeader>      
         <tem:Username>dealsforloan</tem:Username>      
         <tem:Password>P@dea@!@()apm!lo#an!</tem:Password>
      </tem:AuthHeader>
   </soapenv:Header>
   <soapenv:Body>
      <tem:submitApplication>      
         <tem:chosenCard>JetAirways</tem:chosenCard>      
         <tem:FNAME>Ranjana</tem:FNAME>      
         <tem:MNAME></tem:MNAME>      
         <tem:LNAME>Chauhan</tem:LNAME>      
         <tem:EMAIL>ranjana@deal4loans.com</tem:EMAIL>      
         <tem:MOBILE>9873678915</tem:MOBILE>      
         <tem:DOB>10-06-1986</tem:DOB>      
         <tem:GENDER>Female</tem:GENDER>      
         <tem:educationalQualification>M</tem:educationalQualification>      
         <tem:aadharnumber></tem:aadharnumber>      
         <tem:PANCARD>AAAPA1112A</tem:PANCARD>      
         <tem:monthlyInCome>90000</tem:monthlyInCome>      
         <tem:address>E-32 sector 8 noida</tem:address>      
         <tem:address2></tem:address2>      
         <tem:address3>Noida</tem:address3>      
         <tem:city>Noida</tem:city>      
         <tem:state>Uttar Pradesh</tem:state>      
         <tem:pincode>201301</tem:pincode>      
         <tem:peraddresssameascurr>yes</tem:peraddresssameascurr>      
         <tem:permaddress>E-32 sector 8 noida</tem:permaddress>      
         <tem:permaddress2></tem:permaddress2>      
         <tem:permaddress3></tem:permaddress3>      
         <tem:permcity>Noida</tem:permcity>      
         <tem:permstate>Uttar Pradesh</tem:permstate>      
         <tem:permpincode>201301</tem:permpincode>      
         <tem:jetPriviligeMember>N</tem:jetPriviligeMember>      
         <tem:jetPriviligeMembershipNumber></tem:jetPriviligeMembershipNumber>      
         <tem:JetPriviligeMembershipTier></tem:JetPriviligeMembershipTier>      
         <tem:jetStatementTobeSentTO></tem:jetStatementTobeSentTO>      
         <tem:employmentType>E</tem:employmentType>      
         <tem:companyName>Mywish Marketplaces</tem:companyName>      
         <tem:O_ADDRESS>SEcto 8 noida</tem:O_ADDRESS>      
         <tem:O_ADDRESS2></tem:O_ADDRESS2>      
         <tem:O_ADDRESS3></tem:O_ADDRESS3>      
         <tem:O_City>Noida</tem:O_City>      
         <tem:O_State>Uttar Pradesh</tem:O_State>      
         <tem:O_Pincode>201301</tem:O_Pincode>      
         <tem:PHONE>2234561</tem:PHONE>      
         <tem:STD>0120</tem:STD>      
         <tem:O_STD></tem:O_STD>      
         <tem:O_PHONE></tem:O_PHONE>      
         <tem:creditCardNumber></tem:creditCardNumber>      
         <tem:creditCardType></tem:creditCardType>      
         <tem:consentForPaybackPointsEnrolment></tem:consentForPaybackPointsEnrolment>      
         <tem:consentForOnlineStatements></tem:consentForOnlineStatements>      
         <tem:consentForEmailCommunication></tem:consentForEmailCommunication>      
         <tem:consentForInsurancePlanCommunication></tem:consentForInsurancePlanCommunication>      
         <tem:consentForAdditionalPreviliges></tem:consentForAdditionalPreviliges>      
         <tem:consentForMarketingCommunicationOverPhone></tem:consentForMarketingCommunicationOverPhone>      
         <tem:disclaimer>i agree</tem:disclaimer>      
         <tem:IP>122.176.122.134</tem:IP>      
         <tem:platinumCardBillingPreference>5</tem:platinumCardBillingPreference>
      </tem:submitApplication>
   </soapenv:Body>
</soapenv:Envelope>';

$url="https://www.americanexpressindia.co.in/webservices/singleform/dealsforloan.asmx?wsdl";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmstr");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch); 
print_r($output);
?>