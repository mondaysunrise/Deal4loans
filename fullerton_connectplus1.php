<?php
@set_time_limit(2000);

require_once ("lib/nusoap_fullerton.php");// remove soap header
//require_once ("lib/nusoap.php");

connectplus1();
//connectplus2();

function connectplus1()
{ // response : Array ( [TicketNumber] => 120282 [DateTimeRequestReceived] => 25-11-2016 15:50:38:510 [!pending] => true ) 

//testcase 1
//response : Array ( [TicketNumber] => 121417 [DateTimeRequestReceived] => 13-02-2017 17:56:36:502 [!pending] => true ) 
$xmlstr='<env:Envelope
    xmlns:env="http://schemas.xmlsoap.org/soap/envelope/"
    xmlns:defs="http://defs.webservices.experian.com">
    <env:Header/>
    <env:Body>
        <defs:InputNewApplicationXML extended="true">
            <ControlBlock.ReferenceNumber>1062017</ControlBlock.ReferenceNumber>
            <ControlBlock.ConnectPlusUniqueID></ControlBlock.ConnectPlusUniqueID>
            <ControlBlock.CallType>01</ControlBlock.CallType>
            <ControlBlock.SearchType>2</ControlBlock.SearchType>
            <ControlBlock.StrategyCode>01</ControlBlock.StrategyCode>
            <ControlBlock.ScoreType>1</ControlBlock.ScoreType>
            <ControlBlock.IPAddress></ControlBlock.IPAddress>
            <ControlBlock.SearchPreviousApplications>1</ControlBlock.SearchPreviousApplications>
            <ApplicantBlock.ApplicantType>01</ApplicantBlock.ApplicantType>
            <ApplicantBlock.Gender>M</ApplicantBlock.Gender>
            <ApplicantBlock.Prefix></ApplicantBlock.Prefix>
            <ApplicantBlock.ConsumerName1>Rajput</ApplicantBlock.ConsumerName1>
            <ApplicantBlock.ConsumerName2>Shalini</ApplicantBlock.ConsumerName2>
            <ApplicantBlock.ConsumerName3></ApplicantBlock.ConsumerName3>
            <ApplicantBlock.ConsumerName4></ApplicantBlock.ConsumerName4>
            <ApplicantBlock.ConsumerName5></ApplicantBlock.ConsumerName5>
            <ApplicantBlock.IDNumber1></ApplicantBlock.IDNumber1>
            <ApplicantBlock.IDNumber2>AAAPA2114C</ApplicantBlock.IDNumber2>
            <ApplicantBlock.IDNumber3></ApplicantBlock.IDNumber3>
            <ApplicantBlock.IDNumber4></ApplicantBlock.IDNumber4>
            <ApplicantBlock.IDNumber5></ApplicantBlock.IDNumber5>
            <ApplicantBlock.Nationality>356</ApplicantBlock.Nationality>
            <ApplicantBlock.DateOfBirth>19830501</ApplicantBlock.DateOfBirth>
            <ApplicantBlock.PlaceOfBirth>356</ApplicantBlock.PlaceOfBirth>
            <ApplicantBlock.TownOrProvinceOfBirth></ApplicantBlock.TownOrProvinceOfBirth>
            <ApplicantBlock.ContactDetails.EmailAddress></ApplicantBlock.ContactDetails.EmailAddress>
            <ApplicantBlock.Other.MilitaryServiceStatus>N</ApplicantBlock.Other.MilitaryServiceStatus>
            <ApplicantBlock.Other.ExistingCustomer>0</ApplicantBlock.Other.ExistingCustomer>
            <ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierCurrentAddress></ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierCurrentAddress>
            <ApplicantBlock.AddressDetails.CountryCode></ApplicantBlock.AddressDetails.CountryCode>
            <ApplicantBlock.AddressDetails.AddressLine1></ApplicantBlock.AddressDetails.AddressLine1>
            <ApplicantBlock.AddressDetails.AddressLine2></ApplicantBlock.AddressDetails.AddressLine2>
            <ApplicantBlock.AddressDetails.AddressLine3></ApplicantBlock.AddressDetails.AddressLine3>
            <ApplicantBlock.AddressDetails.AddressLine5></ApplicantBlock.AddressDetails.AddressLine5>
            <ApplicantBlock.AddressDetails.AddressLine6></ApplicantBlock.AddressDetails.AddressLine6>
            <ApplicantBlock.AddressDetails.AddressLine7></ApplicantBlock.AddressDetails.AddressLine7>
            <ApplicantBlock.AddressDetails.AddressLine8></ApplicantBlock.AddressDetails.AddressLine8>
            <ApplicantBlock.AddressDetails.AddressLine9></ApplicantBlock.AddressDetails.AddressLine9>
            <ApplicantBlock.AddressDetails.AddressLine10></ApplicantBlock.AddressDetails.AddressLine10>
            <ApplicantBlock.AddressDetails.AddressLine11></ApplicantBlock.AddressDetails.AddressLine11>
            <ApplicantBlock.AddressDetails.ResidentialStatus></ApplicantBlock.AddressDetails.ResidentialStatus>
            <ApplicantBlock.ContactDetails.MobileTelephoneNumber>9599344051</ApplicantBlock.ContactDetails.MobileTelephoneNumber>
            <ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierPreviousAddress></ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierPreviousAddress>
            <ApplicantBlock.AddressDetails.PreviousAddressLine1></ApplicantBlock.AddressDetails.PreviousAddressLine1>
            <ApplicantBlock.AddressDetails.PreviousAddressLine2></ApplicantBlock.AddressDetails.PreviousAddressLine2>
            <ApplicantBlock.AddressDetails.PreviousAddressLine3></ApplicantBlock.AddressDetails.PreviousAddressLine3>
            <ApplicantBlock.AddressDetails.PreviousAddressLine5></ApplicantBlock.AddressDetails.PreviousAddressLine5>
            <ApplicantBlock.AddressDetails.PreviousAddressLine6></ApplicantBlock.AddressDetails.PreviousAddressLine6>
            <ApplicantBlock.AddressDetails.PreviousAddressLine7></ApplicantBlock.AddressDetails.PreviousAddressLine7>
            <ApplicantBlock.AddressDetails.PreviousAddressLine8></ApplicantBlock.AddressDetails.PreviousAddressLine8>
            <ApplicantBlock.AddressDetails.PreviousAddressLine9></ApplicantBlock.AddressDetails.PreviousAddressLine9>
            <ApplicantBlock.AddressDetails.PreviousAddressLine10></ApplicantBlock.AddressDetails.PreviousAddressLine10>
            <ApplicantBlock.AddressDetails.PreviousAddressLine11></ApplicantBlock.AddressDetails.PreviousAddressLine11>
            <ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierPreviousAddress2></ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierPreviousAddress2>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line1></ApplicantBlock.AddressDetails.PreviousAddress2Line1>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line2></ApplicantBlock.AddressDetails.PreviousAddress2Line2>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line3></ApplicantBlock.AddressDetails.PreviousAddress2Line3>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line5></ApplicantBlock.AddressDetails.PreviousAddress2Line5>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line6></ApplicantBlock.AddressDetails.PreviousAddress2Line6>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line7></ApplicantBlock.AddressDetails.PreviousAddress2Line7>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line8></ApplicantBlock.AddressDetails.PreviousAddress2Line8>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line9></ApplicantBlock.AddressDetails.PreviousAddress2Line9>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line10></ApplicantBlock.AddressDetails.PreviousAddress2Line10>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line11></ApplicantBlock.AddressDetails.PreviousAddress2Line11>
            <ApplicantBlock.EmploymentDetails.Occupation></ApplicantBlock.EmploymentDetails.Occupation>
            <ApplicantBlock.EmploymentDetails.GrossAnnualIncome></ApplicantBlock.EmploymentDetails.GrossAnnualIncome>
            <ApplicantBlock.EmploymentDetails.NetAnnualIncome></ApplicantBlock.EmploymentDetails.NetAnnualIncome>
            <ApplicantBlock.EmploymentDetails.SalaryFrequency></ApplicantBlock.EmploymentDetails.SalaryFrequency>
            <ApplicantBlock.EmploymentDetails.FrqRelatedSalary></ApplicantBlock.EmploymentDetails.FrqRelatedSalary>
            <ApplicantBlock.EmploymentDetails.EmployerName></ApplicantBlock.EmploymentDetails.EmployerName>
            <ApplicantBlock.EmploymentDetails.AddressLine1>10 DARYA GANJ</ApplicantBlock.EmploymentDetails.AddressLine1>
            <ApplicantBlock.EmploymentDetails.AddressLine2>NEW DELHI</ApplicantBlock.EmploymentDetails.AddressLine2>
            <ApplicantBlock.EmploymentDetails.AddressLine3>NEW DELHI</ApplicantBlock.EmploymentDetails.AddressLine3>
            <ApplicantBlock.EmploymentDetails.AddressLine5></ApplicantBlock.EmploymentDetails.AddressLine5>
            <ApplicantBlock.EmploymentDetails.AddressLine6>DELHI</ApplicantBlock.EmploymentDetails.AddressLine6>
            <ApplicantBlock.EmploymentDetails.AddressLine7>NCR RMM</ApplicantBlock.EmploymentDetails.AddressLine7>
            <ApplicantBlock.EmploymentDetails.AddressLine8></ApplicantBlock.EmploymentDetails.AddressLine8>
            <ApplicantBlock.EmploymentDetails.AddressLine9></ApplicantBlock.EmploymentDetails.AddressLine9>
            <ApplicantBlock.EmploymentDetails.AddressLine10></ApplicantBlock.EmploymentDetails.AddressLine10>
            <ApplicantBlock.EmploymentDetails.AddressLine11>110092</ApplicantBlock.EmploymentDetails.AddressLine11>
            <ApplicantBlock.BankDetails.AccountCountryCode></ApplicantBlock.BankDetails.AccountCountryCode>
            <ApplicantBlock.BankDetails.AccountDetail1></ApplicantBlock.BankDetails.AccountDetail1>
            <ApplicantBlock.BankDetails.AccountDetail2></ApplicantBlock.BankDetails.AccountDetail2>
            <ApplicantBlock.BankDetails.AccountDetail3></ApplicantBlock.BankDetails.AccountDetail3>
            <ApplicantBlock.BankDetails.AccountDetail4></ApplicantBlock.BankDetails.AccountDetail4>
            <ApplicantBlock.BankDetails.AccountDetail5></ApplicantBlock.BankDetails.AccountDetail5>
            <ApplicantBlock.BankDetails.NameOfPrimaryBank></ApplicantBlock.BankDetails.NameOfPrimaryBank>
            <ApplicantBlock.BankDetails.AddressLine1></ApplicantBlock.BankDetails.AddressLine1>
            <ApplicantBlock.BankDetails.AddressLine2></ApplicantBlock.BankDetails.AddressLine2>
            <ApplicantBlock.BankDetails.AddressLine3></ApplicantBlock.BankDetails.AddressLine3>
            <ApplicantBlock.BankDetails.AddressLine5></ApplicantBlock.BankDetails.AddressLine5>
            <ApplicantBlock.BankDetails.AddressLine6></ApplicantBlock.BankDetails.AddressLine6>
            <ApplicantBlock.BankDetails.AddressLine7></ApplicantBlock.BankDetails.AddressLine7>
            <ApplicantBlock.BankDetails.AddressLine8></ApplicantBlock.BankDetails.AddressLine8>
            <ApplicantBlock.BankDetails.AddressLine9></ApplicantBlock.BankDetails.AddressLine9>
            <ApplicantBlock.BankDetails.AddressLine10></ApplicantBlock.BankDetails.AddressLine10>
            <ApplicantBlock.BankDetails.AddressLine11></ApplicantBlock.BankDetails.AddressLine11>
            <ApplicantBlock.BankDetails.AccountName></ApplicantBlock.BankDetails.AccountName>
            <ApplicantBlock.BankDetails.TimeAtBankYY></ApplicantBlock.BankDetails.TimeAtBankYY>
            <ApplicantBlock.BankDetails.TimeAtBankMM></ApplicantBlock.BankDetails.TimeAtBankMM>
            <CreditBlock.FinanceEnquiryType>5</CreditBlock.FinanceEnquiryType>
            <CreditBlock.PurposeOfFinance>5</CreditBlock.PurposeOfFinance>
            <CreditBlock.AmountOfFinance>900000</CreditBlock.AmountOfFinance>
            <CreditBlock.RepaymentPeriod></CreditBlock.RepaymentPeriod>
            <CreditBlock.NumberOfInstalments></CreditBlock.NumberOfInstalments>
            <CreditBlock.AmountOfInstalments></CreditBlock.AmountOfInstalments>
            <CreditBlock.ExistingAccountNumber1></CreditBlock.ExistingAccountNumber1>
            <CreditBlock.ExistingAccountNumber2></CreditBlock.ExistingAccountNumber2>
            <CreditBlock.ExistingAccountNumber3></CreditBlock.ExistingAccountNumber3>
            <CreditBlock.ExistingAccountNumber4></CreditBlock.ExistingAccountNumber4>
            <ControlBlock.ApplicationDate>20170519</ControlBlock.ApplicationDate>
            <ControlBlock.CountryCode>356</ControlBlock.CountryCode>
            <ControlBlock.ServiceCode1></ControlBlock.ServiceCode1>
            <ControlBlock.ServiceCode2></ControlBlock.ServiceCode2>
            <ControlBlock.ServiceCode3></ControlBlock.ServiceCode3>
            <ControlBlock.ServiceCode4></ControlBlock.ServiceCode4>
            <ControlBlock.ServiceCode5></ControlBlock.ServiceCode5>
            <ControlBlock.BureauGroupCode></ControlBlock.BureauGroupCode>
            <ControlBlock.NumberOfApplicants>1</ControlBlock.NumberOfApplicants>
            <ApplicantBlock.LocalLanguageConsumerName1></ApplicantBlock.LocalLanguageConsumerName1>
            <ApplicantBlock.LocalLanguageConsumerName2></ApplicantBlock.LocalLanguageConsumerName2>
            <ApplicantBlock.LocalLanguageConsumerName3></ApplicantBlock.LocalLanguageConsumerName3>
            <ApplicantBlock.BureauCustomerID></ApplicantBlock.BureauCustomerID>
            <ApplicantBlock.IDDocumentType1>P</ApplicantBlock.IDDocumentType1>
            <ApplicantBlock.IDIssuingCountry1>356</ApplicantBlock.IDIssuingCountry1>
            <ApplicantBlock.IDDocumentType2>T</ApplicantBlock.IDDocumentType2>
            <ApplicantBlock.IDIssuingCountry2>356</ApplicantBlock.IDIssuingCountry2>
            <ApplicantBlock.IDDocumentType3>V</ApplicantBlock.IDDocumentType3>
            <ApplicantBlock.IDIssuingCountry3>356</ApplicantBlock.IDIssuingCountry3>
            <ApplicantBlock.IDDocumentType4>D</ApplicantBlock.IDDocumentType4>
            <ApplicantBlock.IDIssuingCountry4>356</ApplicantBlock.IDIssuingCountry4>
            <ApplicantBlock.IDDocumentType5></ApplicantBlock.IDDocumentType5>
            <ApplicantBlock.IDIssuingCountry5></ApplicantBlock.IDIssuingCountry5>
            <ApplicantBlock.OldIdentityCardNumber></ApplicantBlock.OldIdentityCardNumber>
            <ApplicantBlock.Citizenship>356</ApplicantBlock.Citizenship>
            <ApplicantBlock.EducationLevel></ApplicantBlock.EducationLevel>
            <ApplicantBlock.MaritalStatus></ApplicantBlock.MaritalStatus>
            <ApplicantBlock.NumberOfDependants></ApplicantBlock.NumberOfDependants>
            <ApplicantBlock.RelationshipWithBankEmployee></ApplicantBlock.RelationshipWithBankEmployee>
            <ApplicantBlock.EmploymentDetails.IndustryType></ApplicantBlock.EmploymentDetails.IndustryType>
            <ApplicantBlock.EmploymentDetails.AdditionalAnnualIncome></ApplicantBlock.EmploymentDetails.AdditionalAnnualIncome>
            <ApplicantBlock.EmploymentDetails.TimeInEmploymentYYMM>0200</ApplicantBlock.EmploymentDetails.TimeInEmploymentYYMM>
            <ApplicantBlock.EmploymentDetails.Position></ApplicantBlock.EmploymentDetails.Position>
            <ApplicantBlock.EmploymentDetails.AddressCountryCode>356</ApplicantBlock.EmploymentDetails.AddressCountryCode>
            <ApplicantBlock.PreviousEmploymentDetails.EmployerName></ApplicantBlock.PreviousEmploymentDetails.EmployerName>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine1></ApplicantBlock.PreviousEmploymentDetails.AddressLine1>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine2></ApplicantBlock.PreviousEmploymentDetails.AddressLine2>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine3></ApplicantBlock.PreviousEmploymentDetails.AddressLine3>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine4></ApplicantBlock.PreviousEmploymentDetails.AddressLine4>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine5></ApplicantBlock.PreviousEmploymentDetails.AddressLine5>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine6></ApplicantBlock.PreviousEmploymentDetails.AddressLine6>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine7></ApplicantBlock.PreviousEmploymentDetails.AddressLine7>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine8></ApplicantBlock.PreviousEmploymentDetails.AddressLine8>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine9></ApplicantBlock.PreviousEmploymentDetails.AddressLine9>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine10></ApplicantBlock.PreviousEmploymentDetails.AddressLine10>
            <ApplicantBlock.PreviousEmploymentDetails.AddressLine11></ApplicantBlock.PreviousEmploymentDetails.AddressLine11>
            <ApplicantBlock.PreviousEmploymentDetails.AddressCountryCode></ApplicantBlock.PreviousEmploymentDetails.AddressCountryCode>
            <CreditBlock.CustSegPortfolioID></CreditBlock.CustSegPortfolioID>
            <CreditBlock.ProductLimitMinimum></CreditBlock.ProductLimitMinimum>
            <CreditBlock.ProductLimitMaximum></CreditBlock.ProductLimitMaximum>
            <CreditBlock.PreApprovedLimit></CreditBlock.PreApprovedLimit>
            <ApplicantBlock.AddressDetails.TimeAtPreviousAddressYYMM></ApplicantBlock.AddressDetails.TimeAtPreviousAddressYYMM>
            <ApplicantBlock.AddressDetails.TimeAtPreviousAddress2YYMM></ApplicantBlock.AddressDetails.TimeAtPreviousAddress2YYMM>
            <ApplicantBlock.Other.BureauSearchConsent>1</ApplicantBlock.Other.BureauSearchConsent>
            <ApplicantBlock.SpareFlag5></ApplicantBlock.SpareFlag5>
            <ApplicantBlock.Decision.FinalDecision>ACCPT</ApplicantBlock.Decision.FinalDecision>
            <ApplicantBlock.Decision.DateOfDecision></ApplicantBlock.Decision.DateOfDecision>
            <ApplicantBlock.Decision.AmountApproved></ApplicantBlock.Decision.AmountApproved>
            <ApplicantBlock.Decision.RejectReason></ApplicantBlock.Decision.RejectReason>
            <ApplicantBlock.SpareFlag4></ApplicantBlock.SpareFlag4>
            <ApplicantBlock.SpareFlag2></ApplicantBlock.SpareFlag2>
            <ApplicantBlock.SpareFlag3></ApplicantBlock.SpareFlag3>
            <ApplicantBlock.SpareFlag1></ApplicantBlock.SpareFlag1>
            <ApplicantBlock.SuppCH.Contact.HomeTelephoneNumber></ApplicantBlock.SuppCH.Contact.HomeTelephoneNumber>
            <ApplicantBlock.SuppCH.Contact.MobileTelephoneNumber></ApplicantBlock.SuppCH.Contact.MobileTelephoneNumber>
            <ApplicantBlock.SuppCH.Contact.WorkTelephoneNumber></ApplicantBlock.SuppCH.Contact.WorkTelephoneNumber>
            <ApplicantBlock.SuppCH.EmpDet.Occupation></ApplicantBlock.SuppCH.EmpDet.Occupation>
            <ApplicantBlock.ContactDetails.HomeTelephoneNumber></ApplicantBlock.ContactDetails.HomeTelephoneNumber>
            <ApplicantBlock.ContactDetails.WorkTelephoneNumber>43744900</ApplicantBlock.ContactDetails.WorkTelephoneNumber>
            <ApplicantBlock.AddressDetails.TimeAtCurrentAddressYYMM></ApplicantBlock.AddressDetails.TimeAtCurrentAddressYYMM>
            <ApplicantBlock.AddressDetails.Residential.CountryCode>356</ApplicantBlock.AddressDetails.Residential.CountryCode>
            <ApplicantBlock.AddressDetails.Residential.AddressLine11>110014</ApplicantBlock.AddressDetails.Residential.AddressLine11>
            <ApplicantBlock.AddressDetails.Residential.AddressLine5></ApplicantBlock.AddressDetails.Residential.AddressLine5>
            <ApplicantBlock.AddressDetails.Residential.AddressLine7>NCR RMM</ApplicantBlock.AddressDetails.Residential.AddressLine7>
            <ApplicantBlock.AddressDetails.Residential.AddressLine1>A-29 FF</ApplicantBlock.AddressDetails.Residential.AddressLine1>
            <ApplicantBlock.AddressDetails.Residential.AddressLine6>DELHI</ApplicantBlock.AddressDetails.Residential.AddressLine6>
            <ApplicantBlock.AddressDetails.Residential.AddressLine2>HARI NAGAR</ApplicantBlock.AddressDetails.Residential.AddressLine2>
            <ApplicantBlock.AddressDetails.Residential.AddressLine3>ASHRAM</ApplicantBlock.AddressDetails.Residential.AddressLine3>
            <ApplicantBlock.AddressDetails.Residential.AddressLine4></ApplicantBlock.AddressDetails.Residential.AddressLine4>
            <ApplicantBlock.AddressDetails.Residential.AddressLine8></ApplicantBlock.AddressDetails.Residential.AddressLine8>
            <ApplicantBlock.AddressDetails.Residential.AddressLine9></ApplicantBlock.AddressDetails.Residential.AddressLine9>
            <ApplicantBlock.AddressDetails.Residential.AddressLine10></ApplicantBlock.AddressDetails.Residential.AddressLine10>
            <ApplicantBlock.AddressDetails.Residential.CurrentlyResides></ApplicantBlock.AddressDetails.Residential.CurrentlyResides>
            <ApplicantBlock.AddressDetails.AddressLine4></ApplicantBlock.AddressDetails.AddressLine4>
            <ApplicantBlock.AddressDetails.PreviousAddressLine4></ApplicantBlock.AddressDetails.PreviousAddressLine4>
            <ApplicantBlock.AddressDetails.PreviousAddress2Line4></ApplicantBlock.AddressDetails.PreviousAddress2Line4>
            <ApplicantBlock.BankDetails.AddressLine4></ApplicantBlock.BankDetails.AddressLine4>
            <ApplicantBlock.EmploymentDetails.AddressLine4></ApplicantBlock.EmploymentDetails.AddressLine4>
            <ControlBlock.CurrencyCode>INR</ControlBlock.CurrencyCode>
            <ControlBlock.LanguageCode>E</ControlBlock.LanguageCode>
            <ApplicantBlock.ContactDetails.HomeInternationalCode>91</ApplicantBlock.ContactDetails.HomeInternationalCode>
            <ApplicantBlock.ContactDetails.HomeExtension></ApplicantBlock.ContactDetails.HomeExtension>
            <ApplicantBlock.ContactDetails.MobileInternationalDialCode>91</ApplicantBlock.ContactDetails.MobileInternationalDialCode>
            <ApplicantBlock.ContactDetails.MobileTelephoneNoExtension></ApplicantBlock.ContactDetails.MobileTelephoneNoExtension>
            <ApplicantBlock.ContactDetails.WorkInternationalDialCode>91</ApplicantBlock.ContactDetails.WorkInternationalDialCode>
            <ApplicantBlock.ContactDetails.WorkTelephoneNoExtension></ApplicantBlock.ContactDetails.WorkTelephoneNoExtension>
            <ApplicantBlock.SuppCH.Contact.HomeInternationalCode></ApplicantBlock.SuppCH.Contact.HomeInternationalCode>
            <ApplicantBlock.SuppCH.Contact.HomeExtension></ApplicantBlock.SuppCH.Contact.HomeExtension>
            <ApplicantBlock.SuppCH.Contact.MobileInternationalDialCode></ApplicantBlock.SuppCH.Contact.MobileInternationalDialCode>
            <ApplicantBlock.SuppCH.Contact.MobileTelephoneNoExtension></ApplicantBlock.SuppCH.Contact.MobileTelephoneNoExtension>
            <ApplicantBlock.SuppCH.Contact.WorkInternationalDialCode></ApplicantBlock.SuppCH.Contact.WorkInternationalDialCode>
            <ApplicantBlock.SuppCH.Contact.WorkTelephoneNoExtension></ApplicantBlock.SuppCH.Contact.WorkTelephoneNoExtension>
            <ApplicantBlock.EmploymentDetails.EmploymentStatus>D</ApplicantBlock.EmploymentDetails.EmploymentStatus>
            <ApplicantBlock.AddressDetails.Residential.TimeAtCurrentAddressYYMM>0400</ApplicantBlock.AddressDetails.Residential.TimeAtCurrentAddressYYMM>
            <ApplicantBlock.AddressDetails.PreviousAddressCountryCode></ApplicantBlock.AddressDetails.PreviousAddressCountryCode>
            <CreditBlock.ProductCode></CreditBlock.ProductCode>
            <ControlBlock.UGTicketNumber></ControlBlock.UGTicketNumber>
        </defs:InputNewApplicationXML>
    </env:Body>
</env:Envelope>';

$url ='https://cplusesb.fullertonindia.com:9081/magicxpi4_1/MGrqispi.dll?appname=IFSConnectPlus&prgname=HTTP&arguments=-AHTTP_CP%23Service';
$soapClient = new nusoap_client("http://www.deal4loans.com/fullertonUGservice.wsdl", true);   
//print_r($soapClient);
$soapClient->setEndpoint($url);

$info = $soapClient->call("asynchronousNewApplicationXML", $xmlstr);
print_r($info);
//echo "<pre>";print_r($soapClient);
//response: Array ( [TicketNumber] => 120579 [DateTimeRequestReceived] => 28-12-2016 15:52:33:282 [!pending] => true )  28 DEC 2016
}

//Array ( [TicketNumber] => 121417 [DateTimeRequestReceived] => 13-02-2017 17:56:36:502 [!pending] => true )
//Array ( [TicketNumber] => 121422 [DateTimeRequestReceived] => 13-02-2017 19:49:12:965 [!pending] => true ) 
//Array ( [TicketNumber] => 121423 [DateTimeRequestReceived] => 13-02-2017 19:58:20:598 [!pending] => true ) 
//Array ( [TicketNumber] => 121424 [DateTimeRequestReceived] => 13-02-2017 20:03:09:673 [!pending] => true ) 
//Array ( [TicketNumber] => 121432 [DateTimeRequestReceived] => 14-02-2017 11:16:54:889 [!pending] => true ) // verified
//Array ( [TicketNumber] => 121439 [DateTimeRequestReceived] => 14-02-2017 12:25:25:978 [!pending] => true ) // test case
//Array ( [TicketNumber] => 2809106 [DateTimeRequestReceived] => 05-03-2017 12:58:51:178 [!pending] => true ) // test case
//Array ( [TicketNumber] => 3132921 [DateTimeRequestReceived] => 19-05-2017 18:14:10:827 [!pending] => true ) //test case
function connectplus2()
{// BRE
	$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:defs="http://defs.webservices.experian.com">
   <soapenv:Header/>
   <soapenv:Body>
      <defs:fetchInputNewApplicationXML>
         <!--Optional:-->
         <DateTimeRequestReceived>01-06-2017 19:07:08:894</DateTimeRequestReceived>
         <TicketNumber>3197295</TicketNumber>
      </defs:fetchInputNewApplicationXML>
   </soapenv:Body>
</soapenv:Envelope>';
	$url ='https://cplusesb.fullertonindia.com:9081/magicxpi4_1/MGrqispi.dll?appname=IFSConnectPlus&prgname=HTTP&arguments=-AHTTP_CP%23Service';
	$soapClient = new nusoap_client("http://www.deal4loans.com/fullertonUGservice.wsdl", true);   

	$soapClient->setEndpoint($url);

	$info = $soapClient->call("fetchNewApplicationXML", $xmlstr);
print_r($info);

echo "<br><br>";
	$xml = new SimpleXMLElement('<rootTag/>');
	to_xml($xml, $info);

	print $xml->asXML();

}
function to_xml(SimpleXMLElement $object, array $data)
{   
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $new_object = $object->addChild($key);
            to_xml($new_object, $value);
        } else {   
            $object->addChild($key, $value);
        }   
    }   
}   
/*
Array
(
    [TransactData] => Array
        (
            [Application.ApplicationDate] => 20170214
            [Application.ApplicationTime] => 122527
            [Application.ClientReferenceNumber] => 1616176
            [Application.UniqueCPlusApplicationNumber] => 001738613
            [Application.BureauEnquiryReferenceNumber] => 1616176
            [Application.StatusFlag] => 00
            [Application.PreviousApplicationFound] => N
            [Application.MultipleRecordsFound] => N
            [ErrorBlock.ConnectPlusErrorCode] => 
            [ErrorBlock.ConnectPlusErrorMessage] => 
            [ErrorBlock.BureauErrorCode] => 
            [ErrorBlock.BureauErrorMessage] => 
            [Application.ResponseCode] => 000
            [Application.BureauCalledCode] => 01
            [Application.MultipleMatchFlag] => N
            [ControlBlock.UGTicketNumber] => 
            [IPA.Derogs.SPD.TotalNumberOfSPDs] => 
            [IPA.Derogs.SPD.TotalValueOfSPDs] => 
            [IPA.Derogs.SPD.MonthsSinceMostRecentSPD] => 
            [IPA.Derogs.MPD.TotalNumberOfMPDs] => 
            [IPA.Derogs.MPD.TotalValueOfMPDs] => 
            [IPA.Derogs.MPD.MonthsSinceMostRecentMPD] => 
            [IPA.Derogs.Other.TotalNumberOfOtherIPA.Derogs] => 
            [IPA.Derogs.Other.TotalValueOfOtherIPA.Derogs] => 
            [IPA.Derogs.Other.MonthsSinceMostRecentOtherIPA.Derogs] => 
            [IPA.CADS.NonHousing.NumberOfIPA.CADS] => -01
            [IPA.CADS.NonHousing.ValueOfIPA.CADS] => -0000000001
            [IPA.CADS.NonHousing.MonthsSinceMostRecentCAD] => 9999
            [IPA.CADS.Housing.NumberOfIPA.CADS] => -01
            [IPA.CADS.Housing.ValueOfIPA.CADS] => -0000000001
            [IPA.CADS.Housing.MonthsSinceMostRecentCAD] => 9999
            [IPA.CADS.Microfinance.NumberOfIPA.CADS] => -01
            [IPA.CADS.Microfinance.ValueOfIPA.CADS] => -0000000001
            [IPA.CADS.Microfinance.MonthsSinceMostRecentCAD] => 9999
            [IPA.CADS.Telco.NumberOfIPA.CADS] => -01
            [IPA.CADS.Telco.ValueOfIPA.CADS] => -0000000001
            [IPA.CADS.Telco.MonthsSinceMostRecentCAD] => 9999
            [IPA.CADS.Retail.NumberOfIPA.CADS] => 
            [IPA.CADS.Retail.ValueOfIPA.CADS] => 
            [IPA.CADS.Retail.MonthsSinceMostRecentCAD] => 
            [IPA.CADS.TotalNumberOfIPA.CADS] => -01
            [IPA.CADS.TotalValueOfIPA.CADS] => -0000000001
            [IPA.CADS.TotalMonthsSinceMostRecentCAD] => 9999
            [IPA.ACAS.NonHousing.NumberOfIPA.ACAS] => -01
            [IPA.ACAS.NonHousing.BalanceOnIPA.ACAS] => -0000000001
            [IPA.ACAS.NonHousing.WorstCurrentDelinquencyStatusACA] => -01
            [IPA.ACAS.NonHousing.WorstDelinquencyStatusInThePrevious6MonthsACA] => -01
            [IPA.ACAS.NonHousing.WorstDelinquencyStatusInThePrevious7-12MonthsACA] => -01
            [IPA.ACAS.NonHousing.AgeOfOldestACA] => 9999
            [IPA.ACAS.NonHousing.HighestCurrentBalanceToLimitPercentage-RevolvingIPA.ACAS] => -001
            [IPA.ACAS.NonHousing.TotalCurrentBalanceToLimitPercentage-RevolvingIPA.ACAS] => -001
            [IPA.ACAS.Housing.NumberOfIPA.ACAS] => -01
            [IPA.ACAS.Housing.BalanceOnIPA.ACAS] => -0000000001
            [IPA.ACAS.Housing.WorstCurrentDelinquencyStatusACA] => -01
            [IPA.ACAS.Housing.WorstDelinquencyStatusInThePrevious6MonthsACA] => -01
            [IPA.ACAS.Housing.WorstDelinquencyStatusInThePrevious7-12MonthsACA] => -01
            [IPA.ACAS.Housing.AgeofoldestACA] => 9999
            [IPA.ACAS.Microfinance.NumberofIPA.ACAS] => -01
            [IPA.ACAS.Microfinance.BalanceonIPA.ACAS] => -0000000001
            [IPA.ACAS.Microfinance.WorstCurrentDelinquencyStatusACA] => -01
            [IPA.ACAS.Microfinance.WorstDelinquencyStatusInThePrevious6MonthsACA] => -01
            [IPA.ACAS.Microfinance.WorstDelinquencyStatusInThePrevious7-12MonthsACA] => -01
            [IPA.ACAS.Microfinance.AgeOfOldestACA] => 9999
            [IPA.ACAS.Retail.NumberOfIPA.ACAS] => 
            [IPA.ACAS.Retail.BalanceOnIPA.ACAS] => 
            [IPA.ACAS.Retail.WorstCurrentDelinquencyStatusACA] => 
            [IPA.ACAS.Retail.WorstDelinquencyStatusInThePrevious6MonthsACA] => 
            [IPA.ACAS.Retail.WorstDelinquencyDtatusInThePrevious7-12MonthsACA] => 
            [IPA.ACAS.Retail.AgeofoldestACA] => 
            [IPA.ACAS.Telco.NumberOfIPA.ACAS] => -01
            [IPA.ACAS.Telco.BalanceOnIPA.ACAS] => -0000000001
            [IPA.ACAS.Telco.WorstCurrentDelinquencyStatusACA] => -01
            [IPA.ACAS.Telco.WorstDelinquencyStatusInThePrevious6MonthsACA] => -01
            [IPA.ACAS.Telco.WorstDelinquencyStatusInThePrevious7-12MonthsACA] => -01
            [IPA.ACAS.Telco.AgeofoldestACA] => 9999
            [IPA.ACAS.TotalNumberOfIPA.ACAS] => -01
            [IPA.ACAS.TotalWorstCurrentDelinquencyStatusACA] => -01
            [IPA.ACAS.TotalWorstDelinquencyStatusInThePrevious6monthsACA] => -01
            [IPA.ACAS.TotalWorstDelinquencyStatusInThePrevious7-12monthsACA] => -01
            [IPA.ACAS.TotalAgeofoldestACA] => 9999
            [IPA.ICAS.NonHousing.NumberOfNon-DelinquentIPA.ICAS] => -01
            [IPA.ICAS.NonHousing.NumberOfDelinquentIPA.ICAS] => -01
            [IPA.ICAS.Housing.NumberOfNon-DelinquentIPA.ICAS] => -01
            [IPA.ICAS.Housing.NumberOfDelinquentIPA.ICAS] => -01
            [IPA.ICAS.Telco.NumberOfNon-DelinquentIPA.ICAS] => -01
            [IPA.ICAS.Telco.NumberOfDelinquentIPA.ICAS] => -01
            [IPA.ICAS.Microfinance.NumberOfNon-DelinquentIPA.ICAS] => -01
            [IPA.ICAS.Microfinance.NumberOfDelinquentIPA.ICAS] => -01
            [IPA.ICAS.Retail.NumberOfNon-DelinquentIPA.ICAS] => 
            [IPA.ICAS.Retail.NumberOfDelinquentIPA.ICAS] => 
            [IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast24hours] => 003
            [IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast7days] => 003
            [IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast30days] => 003
            [IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast90days] => 003
            [IPA.CAPS.TotalNumberofIPA.CAPSInTheLast180days] => 003
            [IPA.CAPS.TelcoIPA.CAPSinthelast90days] => 000
            [IPA.CAPS.MicrofinanceIPA.CAPSinthelast90days] => 000
            [IPA.CAPS.RetailIPA.CAPSinthelast90days] => 
            [IPA.OwnGroup.CADS.NumberofIPA.OwnGroupCADs] => -01
            [IPA.OwnGroup.CADS.ValueofIPA.OwnGroupCADs] => -0000000001
            [IPA.OwnGroup.CADS.MonthsSinceMostRecentIPA.OwnGroupCAD] => 9999
            [IPA.OwnGroup.ACAS.NumberofIPA.OwnGroupACAs] => -01
            [IPA.OwnGroup.ACAS.NonHousingBalanceonIPA.OwnGroupACAs] => -0000000001
            [IPA.OwnGroup.ACAS.HousingBalanceonIPA.OwnGroupACAs] => -0000000001
            [IPA.OwnGroup.ACAS.WorstCurrentDelinquencyStatusForIPA.OwnGroupACAs] => -01
            [IPA.OwnGroup.ICAS.NumberOfNon-DelinquentIPA.OwnGroupICAs] => -01
            [IPA.OwnGroup.ICAS.NumberOfDelinquentIPA.OwnGroupICAs] => -01
            [IPA.OwnGroup.ICAS.NumberofIPA.OwnGroupCAPsinthelast90days] => 003
            [IPA.OwnGroup.ICAS.HighestCurrentBalanceToLimitPercentage-RevolvingACAs] => -001
            [IPA.ACAS.Retail.HighestCurBaltoLimitPercentageRevACA] => 
            [IPA.ACAS.Retail.TotalCurBaltoLimitPercentageRevACA] => 
            [IPA.ACAS.TotalBalanceACASExcludingHomeLoans] => -0000000001
            [IPA.CAPS.BanksLeasingFH.CAPSinthelast90days] => 003
            [IPA.OtherCBInfo.AnyRelevantCBDataInDispute] => X
            [IPA.OtherCBInfo.OtherCBDataFoundConstitutingMatch] => 
            [Authentication.LocalAuthenicationscore1] => 
            [Authentication.LocalAuthenicationscore2] => 
            [Authentication.LocalAuthenicationscore3] => 
            [Authentication.LocalAuthenicationscore4] => 
            [Authentication.GlobalAuthenicationscore1] => 
            [Authentication.GlobalAuthenicationscore2] => 
            [Authentication.GlobalAuthenicationscore3] => 
            [Authentication.GlobalAuthenicationscore4] => 
            [Authentication.NumberPrimaryDataItemsIDCurrentAddress] => 
            [Authentication.NumberPrimaryDataSourcesIDCurrentAddress] => 
            [Authentication.OldestPrimaryDataItemIDCurrentAddress] => 
            [Authentication.NumberSecondaryDataItemsIDCurrentAddress] => 
            [Authentication.NumberSecondaryDataSourcesIDCurrentAddress] => 
            [Authentication.OldestSecondaryDataItemIDCurrentAddress] => 
            [Authentication.NumberPrimaryDataItemsAddressOnlyCurrent] => 
            [Authentication.NumberPrimaryDataSourcesAddressOnlyCurrent] => 
            [Authentication.OldestPrimaryDataItemAddressOnlyCurrent] => 
            [Authentication.NumberSecondaryDataItemsAddressOnlyCurrent] => 
            [Authentication.NumberSecondaryDataSourcesAddressOnlyCurrent] => 
            [Authentication.OldestSecondaryDataItemAddressOnlyCurrent] => 
            [Authentication.NumberPrimaryDataItemsIDAddressPrevious] => 
            [Authentication.NumberPrimaryDataSourcesIDAddressPrevious] => 
            [Authentication.OldestPrimaryDataItemIDAddressPrevious] => 
            [Authentication.NumberSecondaryDataItemsIDAddressPrevious] => 
            [Authentication.NumberSecondaryDataSourcesIDAddressPrevious] => 
            [Authentication.OldestSecondaryDataItemIDAddressPrevious] => 
            [Authentication.NumberPrimaryDataItemsAddressOnlyPrevious] => 
            [Authentication.NumberPrimaryDataSourcesAddressOnlyPrevious] => 
            [Authentication.OldestPrimaryDataItemAddressOnlyPrevious] => 
            [Authentication.NumberSecondaryDataItemsAddressOnlyPrevious] => 
            [Authentication.NumberSecondaryDataSourcesAddressOnlyPrevious] => 
            [Authentication.OldestSecondaryDataItemAddressOnlyPrevious] => 
            [Authentication.AgeMatchPrimary] => 
            [Authentication.AgeMatchSecondary] => 
            [Authentication.TimeAtCurrentMatchPrimary] => 
            [Authentication.TimeAtCurrentMatchSecondary] => 
            [Authentication.Decision] => 
            [Authentication.DecisionText] => 
            [Authentication.AuthenticationIndex] => 
            [Authentication.AuthenticationIndexText] => 
            [Authentication.IDConfirmedLevel] => 
            [Authentication.IDConfirmedLevelText] => 
            [Authentication.NumberOfHighRiskPolicyRules] => 
            [Authentication.CifasReference] => 
            [Authentication.HighRiskPolicyRuleID] => 
            [Authentication.HighRiskPolicyText] => 
            [Authentication.UIDTelephoneValid] => 
            [Authentication.UIDAddressValid] => 
            [Authentication.UIDDrivingLicenceValid] => 
            [Authentication.UIDPassportValid] => 
            [Authentication.IDConfirmationlevel] => 
            [Authentication.IDConfirmationText] => 
            [Authentication.IDDecisionLevel] => 
            [Authentication.IDDecisionText] => 
            [Sanctions.PoliticallyExposedPersons] => 
            [Sanctions.SpeciallyDesignatedNationals] => 
            [Sanctions.UNEUSanctionsList] => 
            [Sanctions.BOEPrivateList] => 
            [Sanctions.USTreasuryList] => 
            [Sanctions.ProhibitionBOEList] => 
            [Sanctions.ProhibitionSDNList] => 
            [Fraud.LocalFraudScore1] => 
            [Fraud.LocalFraudScore2] => 
            [Fraud.GlobalFraudScore1] => 
            [Fraud.GlobalFraudScore2] => 
            [Fraud.FraudIndexID] => 
            [Fraud.IndexText] => 
            [Fraud.Decisionlevel] => 
            [Fraud.DecisionText] => 
            [Fraud.BustOutScore] => 
            [Hunter.NumberRulesFired] => 
            [Hunter.VolumeRulesFired] => 
            [Hunter.RuleID] => 
            [Hunter.RuleScore] => 
            [Hunter.NumberMatchschemesFired] => 
            [Hunter.MatchschemeID] => 
            [Hunter.MatchschemeScore] => 
            [Hunter.TotalMatchScore] => 
            [Hunter.FraudRingAlert] => 
            [Hunter.FraudRingWarning] => 
            [Hunter.Message1] => 
            [Hunter.Message2] => 
            [Hunter.Message3] => 
            [Hunter.Message4] => 
            [Hunter.Message5] => 
            [OtherValueAdded.DateVar1] => 
            [OtherValueAdded.DateVar2] => 
            [OtherValueAdded.DateVar3] => 
            [OtherValueAdded.DateVar4] => 
            [OtherValueAdded.DateVar5] => 
            [OtherValueAdded.DateVar6] => 
            [OtherValueAdded.DateVar7] => 
            [OtherValueAdded.DateVar8] => 
            [OtherValueAdded.DateVar9] => 
            [OtherValueAdded.DateVar10] => 
            [OtherValueAdded.DateVar11] => 
            [OtherValueAdded.DateVar12] => 
            [OtherValueAdded.DateVar13] => 
            [OtherValueAdded.DateVar14] => 
            [OtherValueAdded.DateVar15] => 
            [OtherValueAdded.NumericVar1] => 
            [OtherValueAdded.NumericVar2] => 
            [OtherValueAdded.NumericVar3] => 
            [OtherValueAdded.NumericVar4] => 
            [OtherValueAdded.NumericVar5] => 
            [OtherValueAdded.NumericVar6] => 
            [OtherValueAdded.NumericVar7] => 
            [OtherValueAdded.NumericVar8] => 
            [OtherValueAdded.NumericVar9] => 
            [OtherValueAdded.NumericVar10] => 
            [OtherValueAdded.NumericVar11] => 
            [OtherValueAdded.NumericVar12] => 
            [OtherValueAdded.NumericVar13] => 
            [OtherValueAdded.NumericVar14] => 
            [OtherValueAdded.NumericVar15] => 
            [OtherValueAdded.NumericVar16] => 
            [OtherValueAdded.NumericVar17] => 
            [OtherValueAdded.NumericVar18] => 
            [OtherValueAdded.NumericVar19] => 
            [OtherValueAdded.NumericVar20] => 
            [OtherValueAdded.NumericVar21] => 
            [OtherValueAdded.NumericVar22] => 
            [OtherValueAdded.NumericVar23] => 
            [OtherValueAdded.NumericVar24] => 
            [OtherValueAdded.NumericVar25] => 
            [OtherValueAdded.NumericVar26] => -00000000000001
            [OtherValueAdded.NumericVar27] => -00000000000001
            [OtherValueAdded.NumericVar28] => -00000000000001
            [OtherValueAdded.NumericVar29] => -00000000000001
            [OtherValueAdded.NumericVar30] => -00000000000001
            [OtherValueAdded.NumericVar31] => -0000000000000000001
            [OtherValueAdded.NumericVar32] => -0000000000000000001
            [OtherValueAdded.NumericVar33] => -0000000000000000001
            [OtherValueAdded.NumericVar34] => -0000000000000000001
            [OtherValueAdded.NumericVar35] => -0000000000000000001
            [OtherValueAdded.StringVar1] => 
            [OtherValueAdded.StringVar2] => 
            [OtherValueAdded.StringVar3] => 
            [OtherValueAdded.StringVar4] => 
            [OtherValueAdded.StringVar5] => 
            [OtherValueAdded.StringVar6] => -1
            [OtherValueAdded.StringVar7] => 
            [OtherValueAdded.StringVar8] => 
            [OtherValueAdded.StringVar9] => 
            [OtherValueAdded.StringVar10] => 
            [OtherValueAdded.StringVar11] => 
            [OtherValueAdded.StringVar12] => 
            [OtherValueAdded.StringVar13] => 
            [OtherValueAdded.StringVar14] => 
            [OtherValueAdded.StringVar15] => 
            [OtherValueAdded.StringVar16] => 
            [OtherValueAdded.StringVar17] => 
            [OtherValueAdded.StringVar18] => 
            [OtherValueAdded.StringVar19] => 
            [OtherValueAdded.StringVar20] => 
            [OtherValueAdded.StringVar21] => 
            [OtherValueAdded.StringVar22] => 
            [OtherValueAdded.StringVar23] => 
            [OtherValueAdded.StringVar24] => 
            [OtherValueAdded.StringVar25] => 
            [OtherValueAdded.StringVar26] => 
            [OtherValueAdded.StringVar27] => 
            [OtherValueAdded.StringVar28] => 
            [OtherValueAdded.StringVar29] => 
            [OtherValueAdded.StringVar30] => 
            [OtherValueAdded.StringVar31] => 
            [OtherValueAdded.StringVar32] => 
            [OtherValueAdded.StringVar33] => 
            [OtherValueAdded.StringVar34] => 
            [OtherValueAdded.StringVar35] => 
            [ClientSpecific.NumericSL3Var1] => -09
            [ClientSpecific.NumericSL3Var2] => -09
            [ClientSpecific.NumericSL3Var3] => -09
            [ClientSpecific.NumericSL3Var4] => -09
            [ClientSpecific.NumericSL3Var5] => -09
            [ClientSpecific.NumericSL3Var6] => -09
            [ClientSpecific.NumericSL3Var7] => -09
            [ClientSpecific.NumericSL3Var8] => -09
            [ClientSpecific.NumericSL3Var9] => -09
            [ClientSpecific.NumericSL3Var10] => -09
            [ClientSpecific.NumericSL3Var11] => -09
            [ClientSpecific.NumericSL3Var12] => -09
            [ClientSpecific.NumericSL3Var13] => -09
            [ClientSpecific.NumericSL3Var14] => -09
            [ClientSpecific.NumericSL3Var15] => -09
            [ClientSpecific.NumericSL3Var16] => -09
            [ClientSpecific.NumericSL3Var17] => -09
            [ClientSpecific.NumericSL3Var18] => -09
            [ClientSpecific.NumericSL3Var19] => -09
            [ClientSpecific.NumericSL3Var20] => -09
            [ClientSpecific.NumericSL3Var21] => -09
            [ClientSpecific.NumericSL3Var22] => -09
            [ClientSpecific.NumericSL3Var23] => -09
            [ClientSpecific.NumericSL3Var24] => -09
            [ClientSpecific.NumericSL3Var25] => -09
            [ClientSpecific.NumericSL3Var26] => -09
            [ClientSpecific.NumericSL3Var27] => -09
            [ClientSpecific.NumericSL3Var28] => -09
            [ClientSpecific.NumericSL3Var29] => -09
            [ClientSpecific.NumericSL3Var30] => -09
            [ClientSpecific.NumericSL3Var31] => -09
            [ClientSpecific.NumericSL3Var32] => -09
            [ClientSpecific.NumericSL3Var33] => -09
            [ClientSpecific.NumericSL3Var34] => -09
            [ClientSpecific.NumericSL3Var35] => -09
            [ClientSpecific.NumericSL3Var36] => -09
            [ClientSpecific.NumericSL3Var37] => -09
            [ClientSpecific.NumericSL3Var38] => -09
            [ClientSpecific.NumericSL3Var39] => -09
            [ClientSpecific.NumericSL3Var40] => -09
            [ClientSpecific.NumericSL3Var41] => -09
            [ClientSpecific.NumericSL3Var42] => -09
            [ClientSpecific.NumericSL3Var43] => -09
            [ClientSpecific.NumericSL3Var44] => -09
            [ClientSpecific.NumericSL3Var45] => -09
            [ClientSpecific.NumericSL3Var46] => -09
            [ClientSpecific.NumericSL3Var47] => -09
            [ClientSpecific.NumericSL3Var48] => -09
            [ClientSpecific.NumericSL3Var49] => -09
            [ClientSpecific.NumericSL3Var50] => -09
            [ClientSpecific.NumericSL3Var51] => -09
            [ClientSpecific.NumericSL3Var52] => -09
            [ClientSpecific.NumericSL3Var53] => -09
            [ClientSpecific.NumericSL3Var54] => 003
            [ClientSpecific.NumericSL3Var55] => 003
            [ClientSpecific.NumericSL3Var56] => 005
            [ClientSpecific.NumericSL3Var57] => -09
            [ClientSpecific.NumericSL3Var58] => -09
            [ClientSpecific.NumericSL3Var59] => 003
            [ClientSpecific.NumericSL3Var60] => -09
            [ClientSpecific.NumericSL3Var61] => -09
            [ClientSpecific.NumericSL3Var62] => -09
            [ClientSpecific.NumericSL3Var63] => -09
            [ClientSpecific.NumericSL3Var64] => 
            [ClientSpecific.NumericSL3Var65] => 
            [ClientSpecific.NumericSL3Var66] => 
            [ClientSpecific.NumericSL3Var67] => 
            [ClientSpecific.NumericSL3Var68] => 
            [ClientSpecific.NumericSL3Var69] => 
            [ClientSpecific.NumericSL3Var70] => 
            [ClientSpecific.NumericSL3Var71] => 
            [ClientSpecific.NumericSL3Var72] => 
            [ClientSpecific.NumericSL3Var73] => 
            [ClientSpecific.NumericSL3Var74] => 
            [ClientSpecific.NumericSL3Var75] => 
            [ClientSpecific.NumericSL3Var76] => 
            [ClientSpecific.NumericSL3Var77] => 
            [ClientSpecific.NumericSL3Var78] => 
            [ClientSpecific.NumericSL3Var79] => 
            [ClientSpecific.NumericSL3Var80] => 
            [ClientSpecific.NumericSL3Var81] => 
            [ClientSpecific.NumericSL3Var82] => 
            [ClientSpecific.NumericSL3Var83] => 
            [ClientSpecific.NumericSL3Var84] => 
            [ClientSpecific.NumericSL3Var85] => 
            [ClientSpecific.NumericSL3Var86] => 
            [ClientSpecific.NumericSL3Var87] => 
            [ClientSpecific.NumericSL3Var88] => 
            [ClientSpecific.NumericSL3Var89] => 
            [ClientSpecific.NumericSL3Var90] => 
            [ClientSpecific.NumericSL3Var91] => 
            [ClientSpecific.NumericSL3Var92] => 
            [ClientSpecific.NumericSL3Var93] => 
            [ClientSpecific.NumericSL3Var94] => 
            [ClientSpecific.NumericSL3Var95] => 
            [ClientSpecific.NumericSL3Var96] => 
            [ClientSpecific.NumericSL3Var97] => 
            [ClientSpecific.NumericSL3Var98] => 
            [ClientSpecific.NumericSL3Var99] => 
            [ClientSpecific.NumericSL3Var100] => 
            [ClientSpecific.NumericSL3Var101] => 
            [ClientSpecific.NumericSL3Var102] => 
            [ClientSpecific.NumericSL3Var103] => 
            [ClientSpecific.NumericSL3Var104] => 
            [ClientSpecific.NumericSL3Var105] => 
            [ClientSpecific.NumericSL3Var106] => 
            [ClientSpecific.NumericSL3Var107] => 
            [ClientSpecific.NumericSL3Var108] => 
            [ClientSpecific.NumericSL3Var109] => 
            [ClientSpecific.NumericSL3Var110] => 
            [ClientSpecific.NumericSL3Var111] => 
            [ClientSpecific.NumericSL3Var112] => 
            [ClientSpecific.NumericSL3Var113] => 
            [ClientSpecific.NumericSL3Var114] => 
            [ClientSpecific.NumericSL3Var115] => 
            [ClientSpecific.NumericSL3Var116] => 
            [ClientSpecific.NumericSL3Var117] => 
            [ClientSpecific.NumericSL3Var118] => 
            [ClientSpecific.NumericSL3Var119] => 
            [ClientSpecific.NumericSL3Var120] => 
            [ClientSpecific.NumericSL3Var121] => 
            [ClientSpecific.NumericSL3Var122] => 
            [ClientSpecific.NumericSL3Var123] => 
            [ClientSpecific.NumericSL3Var124] => 
            [ClientSpecific.NumericSL3Var125] => 
            [ClientSpecific.NumericSL3Var126] => 
            [ClientSpecific.NumericSL3Var127] => 
            [ClientSpecific.NumericSL3Var128] => 
            [ClientSpecific.NumericSL3Var129] => 
            [ClientSpecific.NumericSL3Var130] => 
            [ClientSpecific.NumericSL3Var131] => 
            [ClientSpecific.NumericSL3Var132] => 
            [ClientSpecific.NumericSL3Var133] => 
            [ClientSpecific.NumericSL3Var134] => 
            [ClientSpecific.NumericSL3Var135] => 
            [ClientSpecific.NumericSL3Var136] => 
            [ClientSpecific.NumericSL3Var137] => 
            [ClientSpecific.NumericSL3Var138] => 
            [ClientSpecific.NumericSL3Var139] => 
            [ClientSpecific.NumericSL3Var140] => 
            [ClientSpecific.NumericSL3Var141] => 
            [ClientSpecific.NumericSL3Var142] => 
            [ClientSpecific.NumericSL3Var143] => 
            [ClientSpecific.NumericSL3Var144] => 
            [ClientSpecific.NumericSL3Var145] => 
            [ClientSpecific.NumericSL3Var146] => 
            [ClientSpecific.NumericSL3Var147] => 
            [ClientSpecific.NumericSL3Var148] => 
            [ClientSpecific.NumericSL3Var149] => 
            [ClientSpecific.NumericSL3Var150] => 
            [ClientSpecific.NumericSL3Var151] => 
            [ClientSpecific.NumericSL3Var152] => 
            [ClientSpecific.NumericSL3Var153] => 
            [ClientSpecific.NumericSL3Var154] => 
            [ClientSpecific.NumericSL3Var155] => 
            [ClientSpecific.NumericSL3Var156] => 
            [ClientSpecific.NumericSL3Var157] => 
            [ClientSpecific.NumericSL3Var158] => 
            [ClientSpecific.NumericSL3Var159] => 
            [ClientSpecific.NumericSL3Var160] => 
            [ClientSpecific.NumericSL3Var161] => 
            [ClientSpecific.NumericSL3Var162] => 
            [ClientSpecific.NumericSL3Var163] => 
            [ClientSpecific.NumericSL3Var164] => 
            [ClientSpecific.NumericSL3Var165] => 
            [ClientSpecific.NumericSL3Var166] => 
            [ClientSpecific.NumericSL3Var167] => 
            [ClientSpecific.NumericSL3Var168] => 
            [ClientSpecific.NumericSL3Var169] => 
            [ClientSpecific.NumericSL3Var170] => 
            [ClientSpecific.NumericSL10Var1] => 
            [ClientSpecific.NumericSL10Var2] => 
            [ClientSpecific.NumericSL10Var3] => 
            [ClientSpecific.NumericSL10Var4] => 
            [ClientSpecific.NumericSL10Var5] => 
            [ClientSpecific.NumericSL10Var6] => 
            [ClientSpecific.NumericSL10Var7] => 
            [ClientSpecific.NumericSL10Var8] => 
            [ClientSpecific.NumericSL10Var9] => 
            [ClientSpecific.NumericSL10Var10] => 
            [ClientSpecific.NumericSL15Var42] => -00000000000009
            [ClientSpecific.NumericSL15Var43] => -00000000000009
            [ClientSpecific.NumericSL15Var44] => -00000000000009
            [ClientSpecific.NumericSL15Var45] => 000001000294583
            [ClientSpecific.NumericSL15Var46] => 
            [ClientSpecific.NumericSL15Var47] => 
            [ClientSpecific.NumericSL15Var48] => 
            [ClientSpecific.NumericSL15Var49] => 
            [ClientSpecific.NumericSL15Var50] => 
            [ClientSpecific.NumericSL15Var51] => 
            [ClientSpecific.NumericSL15Var52] => 
            [ClientSpecific.NumericSL15Var53] => 
            [ClientSpecific.NumericSL15Var54] => 
            [ClientSpecific.NumericSL15Var55] => 
            [ClientSpecific.NumericSL15Var56] => 
            [ClientSpecific.NumericSL15Var57] => 
            [ClientSpecific.NumericSL15Var58] => 
            [ClientSpecific.NumericSL15Var59] => 
            [ClientSpecific.NumericSL15Var60] => 
            [ClientSpecific.NumericSL15Var61] => 
            [ClientSpecific.NumericSL15Var62] => 
            [ClientSpecific.NumericSL15Var63] => 
            [ClientSpecific.NumericSL15Var64] => 
            [ClientSpecific.NumericSL15Var65] => 
            [ClientSpecific.NumericSL15Var66] => 
            [ClientSpecific.NumericSL15Var67] => 
            [ClientSpecific.NumericSL15Var68] => 
            [ClientSpecific.NumericSL15Var69] => 
            [ClientSpecific.NumericSL15Var70] => 
            [ClientSpecific.NumericSL15Var71] => 
            [ClientSpecific.NumericSL15Var72] => 
            [ClientSpecific.NumericSL15Var73] => 
            [ClientSpecific.NumericSL15Var74] => 
            [ClientSpecific.NumericSL15Var75] => 
            [ClientSpecific.NumericSL15Var76] => 
            [ClientSpecific.NumericSL15Var77] => 
            [ClientSpecific.NumericSL15Var78] => 
            [ClientSpecific.NumericSL15Var79] => 
            [ClientSpecific.NumericSL15Var80] => 
            [ClientSpecific.NumericSL15Var81] => 
            [ClientSpecific.NumericSL15Var82] => 
            [ClientSpecific.NumericSL15Var83] => 
            [ClientSpecific.NumericSL15Var84] => 
            [ClientSpecific.NumericSL15Var85] => 
            [ClientSpecific.NumericSL15Var86] => 
            [ClientSpecific.NumericSL15Var87] => 
            [ClientSpecific.NumericSL15Var88] => 
            [ClientSpecific.NumericSL15Var89] => 
            [ClientSpecific.NumericSL15Var90] => 
            [ClientSpecific.StringL1Var1] => 
            [ClientSpecific.StringL1Var2] => 
            [ClientSpecific.StringL1Var3] => 
            [ClientSpecific.StringL1Var4] => 
            [ClientSpecific.StringL1Var5] => 
            [ClientSpecific.StringL1Var6] => 
            [ClientSpecific.StringL1Var7] => 
            [ClientSpecific.StringL1Var8] => 
            [ClientSpecific.StringL1Var9] => 
            [ClientSpecific.StringL1Var10] => 
            [ClientSpecific.StringL1Var11] => 
            [ClientSpecific.StringL1Var12] => 
            [ClientSpecific.StringL1Var13] => 
            [ClientSpecific.StringL1Var14] => 
            [ClientSpecific.StringL1Var15] => 
            [ClientSpecific.StringL1Var16] => 
            [ClientSpecific.StringL1Var17] => 
            [ClientSpecific.StringL1Var18] => 
            [ClientSpecific.StringL1Var19] => 
            [ClientSpecific.StringL1Var20] => 
            [ClientSpecific.StringL2Var1] => 
            [ClientSpecific.StringL2Var2] => 
            [ClientSpecific.StringL2Var3] => 
            [ClientSpecific.StringL2Var4] => 
            [ClientSpecific.StringL2Var5] => 
            [ClientSpecific.StringL2Var6] => 
            [ClientSpecific.StringL2Var7] => 
            [ClientSpecific.StringL2Var8] => 
            [ClientSpecific.StringL2Var9] => 
            [ClientSpecific.StringL2Var10] => 
            [ClientSpecific.StringL30Var1] => 
            [ClientSpecific.StringL30Var2] => 
            [ClientSpecific.StringL30Var3] => 
            [ClientSpecific.StringL30Var4] => 
            [ClientSpecific.StringL30Var5] => 
            [ClientSpecific.StringL30Var6] => 
            [ClientSpecific.StringL30Var7] => 
            [ClientSpecific.StringL30Var8] => 
            [ClientSpecific.StringL30Var9] => 
            [ClientSpecific.StringL30Var10] => 
            [ClientSpecific.StringL30Var11] => 
            [ClientSpecific.StringL30Var12] => 
            [ClientSpecific.StringL30Var13] => 
            [ClientSpecific.StringL30Var14] => 
            [ClientSpecific.StringL30Var15] => 
            [ClientSpecific.DateVar1] => 
            [ClientSpecific.DateVar2] => 
            [ClientSpecific.DateVar3] => 
            [ClientSpecific.DateVar4] => 
            [ClientSpecific.DateVar5] => 
            [ClientSpecific.DateVar6] => 
            [ClientSpecific.DateVar7] => 
            [ClientSpecific.DateVar8] => 
            [ClientSpecific.DateVar9] => 
            [ClientSpecific.DateVar10] => 
            [ClientSpecific.NumericSL10Var11] => 
            [ClientSpecific.NumericSL10Var12] => 
            [ClientSpecific.NumericSL10Var13] => 
            [ClientSpecific.NumericSL10Var14] => 
            [ClientSpecific.NumericSL10Var15] => 
            [ClientSpecific.NumericSL15Var1] => -00000000000009
            [ClientSpecific.NumericSL15Var2] => -00000000000009
            [ClientSpecific.NumericSL15Var3] => -00000000000009
            [ClientSpecific.NumericSL15Var4] => -00000000000009
            [ClientSpecific.NumericSL15Var5] => -00000000000009
            [ClientSpecific.NumericSL15Var6] => -00000000000009
            [ClientSpecific.NumericSL15Var7] => -00000000000009
            [ClientSpecific.NumericSL15Var8] => -00000000000009
            [ClientSpecific.NumericSL15Var9] => -00000000000009
            [ClientSpecific.NumericSL15Var10] => -00000000000009
            [ClientSpecific.NumericSL15Var11] => -00000000000009
            [ClientSpecific.NumericSL15Var12] => -00000000000001
            [ClientSpecific.NumericSL15Var13] => -00000000000009
            [ClientSpecific.NumericSL15Var14] => 000000000900000
            [ClientSpecific.NumericSL15Var15] => -00000000000009
            [ClientSpecific.NumericSL15Var16] => -00000000000009
            [ClientSpecific.NumericSL15Var17] => -00000000000009
            [ClientSpecific.NumericSL15Var18] => -00000000000009
            [ClientSpecific.NumericSL15Var19] => -00000000000009
            [ClientSpecific.NumericSL15Var20] => -00000000000009
            [ClientSpecific.NumericSL15Var21] => -00000000000009
            [ClientSpecific.NumericSL15Var22] => -00000000000009
            [ClientSpecific.NumericSL15Var23] => -00000000000009
            [ClientSpecific.NumericSL15Var24] => -00000000000009
            [ClientSpecific.NumericSL15Var25] => -00000000000009
            [ClientSpecific.NumericSL15Var26] => -00000000000009
            [ClientSpecific.NumericSL15Var27] => -00000000000009
            [ClientSpecific.NumericSL15Var28] => -00000000000009
            [ClientSpecific.NumericSL15Var29] => -00000000000009
            [ClientSpecific.NumericSL15Var30] => -00000000000009
            [ClientSpecific.NumericSL15Var31] => -00000000000009
            [ClientSpecific.NumericSL15Var32] => -00000000000009
            [ClientSpecific.NumericSL15Var33] => -00000000000009
            [ClientSpecific.NumericSL15Var34] => -00000000000009
            [ClientSpecific.NumericSL15Var35] => -00000000000009
            [ClientSpecific.NumericSL15Var36] => -00000000000009
            [ClientSpecific.NumericSL15Var37] => -00000000000009
            [ClientSpecific.NumericSL15Var38] => -00000000000009
            [ClientSpecific.NumericSL15Var39] => -00000000000009
            [ClientSpecific.NumericSL15Var40] => -00000000000009
            [ClientSpecific.NumericSL15Var41] => -00000000000009
            [BureauSpecific.DateVar1] => 14022017
            [BureauSpecific.DateVar2] => 
            [BureauSpecific.DateVar3] => 
            [BureauSpecific.DateVar4] => 
            [BureauSpecific.DateVar5] => 
            [BureauSpecific.DateVar6] => 
            [BureauSpecific.DateVar7] => 
            [BureauSpecific.DateVar8] => 
            [BureauSpecific.DateVar9] => 
            [BureauSpecific.DateVar10] => 
            [BureauSpecific.DateVar11] => 
            [BureauSpecific.DateVar12] => 
            [BureauSpecific.DateVar13] => 
            [BureauSpecific.DateVar14] => 
            [BureauSpecific.DateVar15] => 
            [BureauSpecific.DateVar16] => 
            [BureauSpecific.DateVar17] => 
            [BureauSpecific.DateVar18] => 
            [BureauSpecific.DateVar19] => 
            [BureauSpecific.DateVar20] => 
            [BureauSpecific.DateVar21] => 
            [BureauSpecific.DateVar22] => 
            [BureauSpecific.DateVar23] => 
            [BureauSpecific.DateVar24] => 
            [BureauSpecific.DateVar25] => 
            [BureauSpecific.DateVar26] => 
            [BureauSpecific.DateVar27] => 
            [BureauSpecific.DateVar28] => 
            [BureauSpecific.DateVar29] => 
            [BureauSpecific.DateVar30] => 
            [BureauSpecific.DateVar31] => 
            [BureauSpecific.DateVar32] => 
            [BureauSpecific.DateVar33] => 
            [BureauSpecific.DateVar34] => 
            [BureauSpecific.DateVar35] => 
            [BureauSpecific.DateVar36] => 
            [BureauSpecific.DateVar37] => 
            [BureauSpecific.DateVar38] => 
            [BureauSpecific.DateVar39] => 
            [BureauSpecific.DateVar40] => 
            [BureauSpecific.DateVar41] => 
            [BureauSpecific.DateVar42] => 
            [BureauSpecific.DateVar43] => 
            [BureauSpecific.DateVar44] => 
            [BureauSpecific.DateVar45] => 
            [BureauSpecific.DateVar46] => 
            [BureauSpecific.DateVar47] => 
            [BureauSpecific.DateVar48] => 
            [BureauSpecific.DateVar49] => 
            [BureauSpecific.DateVar50] => 
            [BureauSpecific.DateVar51] => 
            [BureauSpecific.DateVar52] => 
            [BureauSpecific.DateVar53] => 
            [BureauSpecific.DateVar54] => 
            [BureauSpecific.DateVar55] => 
            [BureauSpecific.DateVar56] => 
            [BureauSpecific.DateVar57] => 
            [BureauSpecific.DateVar58] => 
            [BureauSpecific.DateVar59] => 
            [BureauSpecific.DateVar60] => 
            [BureauSpecific.NumericVar1] => 
            [BureauSpecific.NumericVar2] => 
            [BureauSpecific.NumericVar3] => 
            [BureauSpecific.NumericVar4] => 
            [BureauSpecific.NumericVar5] => 
            [BureauSpecific.NumericVar6] => 
            [BureauSpecific.NumericVar7] => 
            [BureauSpecific.NumericVar8] => 
            [BureauSpecific.NumericVar9] => 
            [BureauSpecific.NumericVar10] => 
            [BureauSpecific.NumericVar11] => 01
            [BureauSpecific.NumericVar12] => 10
            [BureauSpecific.NumericVar13] => 
            [BureauSpecific.NumericVar14] => 
            [BureauSpecific.NumericVar15] => 
            [BureauSpecific.NumericVar16] => 
            [BureauSpecific.NumericVar17] => 
            [BureauSpecific.NumericVar18] => 
            [BureauSpecific.NumericVar19] => 
            [BureauSpecific.NumericVar20] => 
            [BureauSpecific.NumericVar21] => 
            [BureauSpecific.NumericVar22] => 
            [BureauSpecific.NumericVar23] => 
            [BureauSpecific.NumericVar24] => 
            [BureauSpecific.NumericVar25] => 
            [BureauSpecific.NumericVar26] => 
            [BureauSpecific.NumericVar27] => 
            [BureauSpecific.NumericVar28] => 
            [BureauSpecific.NumericVar29] => 
            [BureauSpecific.NumericVar30] => 
            [BureauSpecific.NumericVar31] => 
            [BureauSpecific.NumericVar32] => 
            [BureauSpecific.NumericVar33] => 
            [BureauSpecific.NumericVar34] => 
            [BureauSpecific.NumericVar35] => 
            [BureauSpecific.NumericVar36] => 
            [BureauSpecific.NumericVar37] => 
            [BureauSpecific.NumericVar38] => 
            [BureauSpecific.NumericVar39] => 
            [BureauSpecific.NumericVar40] => 
            [BureauSpecific.NumericVar41] => 
            [BureauSpecific.NumericVar42] => 
            [BureauSpecific.NumericVar43] => 
            [BureauSpecific.NumericVar44] => 
            [BureauSpecific.NumericVar45] => 
            [BureauSpecific.NumericVar46] => 
            [BureauSpecific.NumericVar47] => 
            [BureauSpecific.NumericVar48] => 
            [BureauSpecific.NumericVar49] => 
            [BureauSpecific.NumericVar50] => 
            [BureauSpecific.NumericVar51] => 
            [BureauSpecific.NumericVar52] => 
            [BureauSpecific.NumericVar53] => 
            [BureauSpecific.NumericVar54] => 
            [BureauSpecific.NumericVar55] => 
            [BureauSpecific.NumericVar56] => 
            [BureauSpecific.NumericVar57] => 
            [BureauSpecific.NumericVar58] => 
            [BureauSpecific.NumericVar59] => 
            [BureauSpecific.NumericVar60] => 
            [BureauSpecific.NumericVar61] => -000000001
            [BureauSpecific.NumericVar62] => 
            [BureauSpecific.NumericVar63] => -000000001
            [BureauSpecific.NumericVar64] => -000000001
            [BureauSpecific.NumericVar65] => -000000001
            [BureauSpecific.NumericVar66] => 0000009999
            [BureauSpecific.NumericVar67] => -000000001
            [BureauSpecific.NumericVar68] => -000000001
            [BureauSpecific.NumericVar69] => 
            [BureauSpecific.NumericVar70] => 
            [BureauSpecific.NumericVar71] => 
            [BureauSpecific.NumericVar72] => 
            [BureauSpecific.NumericVar73] => 
            [BureauSpecific.NumericVar74] => 
            [BureauSpecific.NumericVar75] => 
            [BureauSpecific.NumericVar76] => 
            [BureauSpecific.NumericVar77] => 
            [BureauSpecific.NumericVar78] => 
            [BureauSpecific.NumericVar79] => 
            [BureauSpecific.NumericVar80] => 
            [BureauSpecific.NumericVar81] => 
            [BureauSpecific.NumericVar82] => 
            [BureauSpecific.NumericVar83] => 
            [BureauSpecific.NumericVar84] => 
            [BureauSpecific.NumericVar85] => 
            [BureauSpecific.NumericVar86] => 
            [BureauSpecific.NumericVar87] => 
            [BureauSpecific.NumericVar88] => 
            [BureauSpecific.NumericVar89] => 
            [BureauSpecific.NumericVar90] => 
            [BureauSpecific.NumericVar91] => 
            [BureauSpecific.NumericVar92] => 
            [BureauSpecific.NumericVar93] => 
            [BureauSpecific.NumericVar94] => 
            [BureauSpecific.NumericVar95] => 
            [BureauSpecific.NumericVar96] => 
            [BureauSpecific.NumericVar97] => 
            [BureauSpecific.NumericVar98] => 
            [BureauSpecific.NumericVar99] => 
            [BureauSpecific.NumericVar100] => 
            [BureauSpecific.NumericVar101] => 
            [BureauSpecific.NumericVar102] => 
            [BureauSpecific.NumericVar103] => 
            [BureauSpecific.NumericVar104] => 
            [BureauSpecific.NumericVar105] => 
            [BureauSpecific.NumericVar106] => 
            [BureauSpecific.NumericVar107] => 
            [BureauSpecific.NumericVar108] => 
            [BureauSpecific.NumericVar109] => 
            [BureauSpecific.NumericVar110] => 
            [BureauSpecific.NumericVar111] => 
            [BureauSpecific.NumericVar112] => 
            [BureauSpecific.NumericVar113] => 
            [BureauSpecific.NumericVar114] => 
            [BureauSpecific.NumericVar115] => 
            [BureauSpecific.NumericVar116] => 
            [BureauSpecific.NumericVar117] => 
            [BureauSpecific.NumericVar118] => 
            [BureauSpecific.NumericVar119] => 
            [BureauSpecific.NumericVar120] => 
            [BureauSpecific.StringVar1] => 
            [BureauSpecific.StringVar2] => 
            [BureauSpecific.StringVar3] => 
            [BureauSpecific.StringVar4] => 
            [BureauSpecific.StringVar5] => 
            [BureauSpecific.StringVar6] => 
            [BureauSpecific.StringVar7] => 
            [BureauSpecific.StringVar8] => 
            [BureauSpecific.StringVar9] => 
            [BureauSpecific.StringVar10] => 
            [BureauSpecific.StringVar11] => 
            [BureauSpecific.StringVar12] => 
            [BureauSpecific.StringVar13] => 
            [BureauSpecific.StringVar14] => 
            [BureauSpecific.StringVar15] => 
            [BureauSpecific.StringVar16] => 
            [BureauSpecific.StringVar17] => 
            [BureauSpecific.StringVar18] => 
            [BureauSpecific.StringVar19] => 
            [BureauSpecific.StringVar20] => 
            [BureauSpecific.StringVar21] => 
            [BureauSpecific.StringVar22] => 
            [BureauSpecific.StringVar23] => 
            [BureauSpecific.StringVar24] => 
            [BureauSpecific.StringVar25] => 
            [BureauSpecific.StringVar26] => 
            [BureauSpecific.StringVar27] => 
            [BureauSpecific.StringVar28] => 
            [BureauSpecific.StringVar29] => 
            [BureauSpecific.StringVar30] => 
            [BureauSpecific.StringVar31] => 
            [BureauSpecific.StringVar32] => 
            [BureauSpecific.StringVar33] => 
            [BureauSpecific.StringVar34] => 
            [BureauSpecific.StringVar35] => 
            [BureauSpecific.StringVar36] => 
            [BureauSpecific.StringVar37] => 
            [BureauSpecific.StringVar38] => 
            [BureauSpecific.StringVar39] => 
            [BureauSpecific.StringVar40] => 
            [BureauSpecific.StringVar41] => 
            [BureauSpecific.StringVar42] => 
            [BureauSpecific.StringVar43] => 
            [BureauSpecific.StringVar44] => 
            [BureauSpecific.StringVar45] => 
            [BureauSpecific.StringVar46] => 
            [BureauSpecific.StringVar47] => 
            [BureauSpecific.StringVar48] => 
            [BureauSpecific.StringVar49] => 
            [BureauSpecific.StringVar50] => 
            [BureauSpecific.StringVar51] => 
            [BureauSpecific.StringVar52] => 
            [BureauSpecific.StringVar53] => 
            [BureauSpecific.StringVar54] => 
            [BureauSpecific.StringVar55] => 
            [BureauSpecific.StringVar56] => 
            [BureauSpecific.StringVar57] => 
            [BureauSpecific.StringVar58] => 
            [BureauSpecific.StringVar59] => 
            [BureauSpecific.StringVar60] => 
            [BureauSpecific.StringVar61] => 
            [BureauSpecific.StringVar62] => 
            [BureauSpecific.StringVar63] => 
            [BureauSpecific.StringVar64] => 
            [BureauSpecific.StringVar65] => 
            [BureauSpecific.StringVar66] => 
            [BureauSpecific.StringVar67] => 
            [BureauSpecific.StringVar68] => 
            [BureauSpecific.StringVar69] => 9999
            [BureauSpecific.StringVar70] => 9999
            [BureauSpecific.StringVar71] => 
            [BureauSpecific.StringVar72] => 
            [BureauSpecific.StringVar73] => 
            [BureauSpecific.StringVar74] => 
            [BureauSpecific.StringVar75] => 
            [BureauSpecific.StringVar76] => 
            [BureauSpecific.StringVar77] => 
            [BureauSpecific.StringVar78] => 
            [BureauSpecific.StringVar79] => 
            [BureauSpecific.StringVar80] => 
            [BureauSpecific.StringVar81] => CIBILTUSCR
            [BureauSpecific.StringVar82] => 
            [BureauSpecific.StringVar83] => 
            [BureauSpecific.StringVar84] => 
            [BureauSpecific.StringVar85] => 
            [BureauSpecific.StringVar86] => 
            [BureauSpecific.StringVar87] => 
            [BureauSpecific.StringVar88] => 
            [BureauSpecific.StringVar89] => 
            [BureauSpecific.StringVar90] => 
            [BureauSpecific.StringVar91] => 
            [BureauSpecific.StringVar92] => 
            [BureauSpecific.StringVar93] => 
            [BureauSpecific.StringVar94] => 
            [BureauSpecific.StringVar95] => 
            [BureauSpecific.StringVar96] => 
            [BureauSpecific.StringVar97] => 
            [BureauSpecific.StringVar98] => 
            [BureauSpecific.StringVar99] => 
            [BureauSpecific.StringVar100] => 
            [BureauSpecific.StringVar101] => 
            [BureauSpecific.StringVar102] => 
            [BureauSpecific.StringVar103] => 
            [BureauSpecific.StringVar104] => 
            [BureauSpecific.StringVar105] => 
            [BureauSpecific.StringVar106] => 
            [BureauSpecific.StringVar107] => 
            [BureauSpecific.StringVar108] => 
            [BureauSpecific.StringVar109] => 
            [BureauSpecific.StringVar110] => 
            [BureauSpecific.StringVar111] => 
            [BureauSpecific.StringVar112] => 
            [BureauSpecific.StringVar113] => 
            [BureauSpecific.StringVar114] => 
            [BureauSpecific.StringVar115] => 
            [BureauSpecific.StringVar116] => 
            [BureauSpecific.StringVar117] => 
            [BureauSpecific.StringVar118] => 
            [BureauSpecific.StringVar119] => 
            [BureauSpecific.StringVar120] => 
        )

    [RawData] => Array
        (
            [applicant] => Array
                (
                    [segment] => Array
                        (
                            [0] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => ProcessTime
                                                            [!] => 122544
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => ProcessDate
                                                            [!] => 14022017
                                                        )

                                                    [2] => Array
                                                        (
                                                            [!cibil_tag] => ControlNumber
                                                            [!] => 001000294583
                                                        )

                                                    [3] => Array
                                                        (
                                                            [!cibil_tag] => ReturnCode
                                                            [!] => 1
                                                        )

                                                    [4] => Array
                                                        (
                                                            [!cibil_tag] => MemberCode
                                                            [!] => NB66301001
                                                        )

                                                    [5] => Array
                                                        (
                                                            [!cibil_tag] => FutureUse2
                                                            [!] => 0000
                                                        )

                                                    [6] => Array
                                                        (
                                                            [!cibil_tag] => FutureUse1
                                                        )

                                                    [7] => Array
                                                        (
                                                            [!cibil_tag] => MemberRef
                                                            [!] => 1616176
                                                        )

                                                    [8] => Array
                                                        (
                                                            [!cibil_tag] => Version
                                                            [!] => 12
                                                        )

                                                    [9] => Array
                                                        (
                                                            [!cibil_tag] => SegmentTag
                                                            [!] => TUEF
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_FIXED_TUEF
                                )

                            [1] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => 81
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => 80
                                                        )

                                                    [2] => Array
                                                        (
                                                            [!cibil_tag] => 08
                                                            [!] => 2
                                                        )

                                                    [3] => Array
                                                        (
                                                            [!cibil_tag] => 87
                                                        )

                                                    [4] => Array
                                                        (
                                                            [!cibil_tag] => 07
                                                            [!] => 01021985
                                                        )

                                                    [5] => Array
                                                        (
                                                            [!cibil_tag] => 86
                                                        )

                                                    [6] => Array
                                                        (
                                                            [!cibil_tag] => 05
                                                        )

                                                    [7] => Array
                                                        (
                                                            [!cibil_tag] => 85
                                                        )

                                                    [8] => Array
                                                        (
                                                            [!cibil_tag] => 04
                                                        )

                                                    [9] => Array
                                                        (
                                                            [!cibil_tag] => 84
                                                        )

                                                    [10] => Array
                                                        (
                                                            [!cibil_tag] => 03
                                                        )

                                                    [11] => Array
                                                        (
                                                            [!cibil_tag] => 83
                                                        )

                                                    [12] => Array
                                                        (
                                                            [!cibil_tag] => 02
                                                            [!] => BALBIR
                                                        )

                                                    [13] => Array
                                                        (
                                                            [!cibil_tag] => 82
                                                        )

                                                    [14] => Array
                                                        (
                                                            [!cibil_tag] => 01
                                                            [!] => SINGH
                                                        )

                                                    [15] => Array
                                                        (
                                                            [!cibil_tag] => PN
                                                            [!] => N01
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_PN
                                )

                            [2] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => 90
                                                            [!] => Y
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => 04
                                                        )

                                                    [2] => Array
                                                        (
                                                            [!cibil_tag] => 03
                                                        )

                                                    [3] => Array
                                                        (
                                                            [!cibil_tag] => 02
                                                            [!] => AAAPA0111A
                                                        )

                                                    [4] => Array
                                                        (
                                                            [!cibil_tag] => 01
                                                            [!] => 01
                                                        )

                                                    [5] => Array
                                                        (
                                                            [!cibil_tag] => ID
                                                            [!] => I01
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_ID
                                )

                            [3] => Array
                                (
                                    [block] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [field] => Array
                                                        (
                                                            [0] => Array
                                                                (
                                                                    [!cibil_tag] => 90
                                                                    [!] => Y
                                                                )

                                                            [1] => Array
                                                                (
                                                                    [!cibil_tag] => 03
                                                                    [!] => 03
                                                                )

                                                            [2] => Array
                                                                (
                                                                    [!cibil_tag] => 02
                                                                )

                                                            [3] => Array
                                                                (
                                                                    [!cibil_tag] => 01
                                                                    [!] => 43744900
                                                                )

                                                            [4] => Array
                                                                (
                                                                    [!cibil_tag] => PT
                                                                    [!] => T01
                                                                )

                                                        )

                                                    [!nb] => 1
                                                )

                                            [1] => Array
                                                (
                                                    [field] => Array
                                                        (
                                                            [0] => Array
                                                                (
                                                                    [!cibil_tag] => 90
                                                                    [!] => Y
                                                                )

                                                            [1] => Array
                                                                (
                                                                    [!cibil_tag] => 03
                                                                    [!] => 01
                                                                )

                                                            [2] => Array
                                                                (
                                                                    [!cibil_tag] => 02
                                                                )

                                                            [3] => Array
                                                                (
                                                                    [!cibil_tag] => 01
                                                                    [!] => 9717594462
                                                                )

                                                            [4] => Array
                                                                (
                                                                    [!cibil_tag] => PT
                                                                    [!] => T02
                                                                )

                                                        )

                                                    [!nb] => 2
                                                )

                                        )

                                    [!name] => OUT_PT
                                )

                            [4] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => 01
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => EC
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_EC
                                )

                            [5] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => 83
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => 82
                                                        )

                                                    [2] => Array
                                                        (
                                                            [!cibil_tag] => 80
                                                        )

                                                    [3] => Array
                                                        (
                                                            [!cibil_tag] => 06
                                                        )

                                                    [4] => Array
                                                        (
                                                            [!cibil_tag] => 05
                                                        )

                                                    [5] => Array
                                                        (
                                                            [!cibil_tag] => 87
                                                        )

                                                    [6] => Array
                                                        (
                                                            [!cibil_tag] => 04
                                                        )

                                                    [7] => Array
                                                        (
                                                            [!cibil_tag] => 86
                                                        )

                                                    [8] => Array
                                                        (
                                                            [!cibil_tag] => 03
                                                        )

                                                    [9] => Array
                                                        (
                                                            [!cibil_tag] => 85
                                                        )

                                                    [10] => Array
                                                        (
                                                            [!cibil_tag] => 02
                                                        )

                                                    [11] => Array
                                                        (
                                                            [!cibil_tag] => 84
                                                        )

                                                    [12] => Array
                                                        (
                                                            [!cibil_tag] => 01
                                                        )

                                                    [13] => Array
                                                        (
                                                            [!cibil_tag] => EM
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_EM
                                )

                            [6] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => 01
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => PI
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_PI
                                )

                            [7] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => 59
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => 58
                                                        )

                                                    [2] => Array
                                                        (
                                                            [!cibil_tag] => 57
                                                        )

                                                    [3] => Array
                                                        (
                                                            [!cibil_tag] => 56
                                                        )

                                                    [4] => Array
                                                        (
                                                            [!cibil_tag] => 55
                                                        )

                                                    [5] => Array
                                                        (
                                                            [!cibil_tag] => 54
                                                        )

                                                    [6] => Array
                                                        (
                                                            [!cibil_tag] => 53
                                                        )

                                                    [7] => Array
                                                        (
                                                            [!cibil_tag] => 52
                                                        )

                                                    [8] => Array
                                                        (
                                                            [!cibil_tag] => 51
                                                        )

                                                    [9] => Array
                                                        (
                                                            [!cibil_tag] => 50
                                                        )

                                                    [10] => Array
                                                        (
                                                            [!cibil_tag] => 49
                                                        )

                                                    [11] => Array
                                                        (
                                                            [!cibil_tag] => 48
                                                        )

                                                    [12] => Array
                                                        (
                                                            [!cibil_tag] => 47
                                                        )

                                                    [13] => Array
                                                        (
                                                            [!cibil_tag] => 46
                                                        )

                                                    [14] => Array
                                                        (
                                                            [!cibil_tag] => 45
                                                        )

                                                    [15] => Array
                                                        (
                                                            [!cibil_tag] => 44
                                                        )

                                                    [16] => Array
                                                        (
                                                            [!cibil_tag] => 43
                                                        )

                                                    [17] => Array
                                                        (
                                                            [!cibil_tag] => 42
                                                        )

                                                    [18] => Array
                                                        (
                                                            [!cibil_tag] => 41
                                                        )

                                                    [19] => Array
                                                        (
                                                            [!cibil_tag] => 40
                                                        )

                                                    [20] => Array
                                                        (
                                                            [!cibil_tag] => 39
                                                        )

                                                    [21] => Array
                                                        (
                                                            [!cibil_tag] => 38
                                                        )

                                                    [22] => Array
                                                        (
                                                            [!cibil_tag] => 37
                                                        )

                                                    [23] => Array
                                                        (
                                                            [!cibil_tag] => 36
                                                        )

                                                    [24] => Array
                                                        (
                                                            [!cibil_tag] => 35
                                                        )

                                                    [25] => Array
                                                        (
                                                            [!cibil_tag] => 34
                                                        )

                                                    [26] => Array
                                                        (
                                                            [!cibil_tag] => 33
                                                        )

                                                    [27] => Array
                                                        (
                                                            [!cibil_tag] => 32
                                                        )

                                                    [28] => Array
                                                        (
                                                            [!cibil_tag] => 31
                                                        )

                                                    [29] => Array
                                                        (
                                                            [!cibil_tag] => 30
                                                        )

                                                    [30] => Array
                                                        (
                                                            [!cibil_tag] => 29
                                                        )

                                                    [31] => Array
                                                        (
                                                            [!cibil_tag] => 28
                                                        )

                                                    [32] => Array
                                                        (
                                                            [!cibil_tag] => 27
                                                        )

                                                    [33] => Array
                                                        (
                                                            [!cibil_tag] => 26
                                                        )

                                                    [34] => Array
                                                        (
                                                            [!cibil_tag] => 25
                                                        )

                                                    [35] => Array
                                                        (
                                                            [!cibil_tag] => 24
                                                        )

                                                    [36] => Array
                                                        (
                                                            [!cibil_tag] => 23
                                                        )

                                                    [37] => Array
                                                        (
                                                            [!cibil_tag] => 22
                                                        )

                                                    [38] => Array
                                                        (
                                                            [!cibil_tag] => 21
                                                        )

                                                    [39] => Array
                                                        (
                                                            [!cibil_tag] => 20
                                                        )

                                                    [40] => Array
                                                        (
                                                            [!cibil_tag] => 09
                                                        )

                                                    [41] => Array
                                                        (
                                                            [!cibil_tag] => 08
                                                        )

                                                    [42] => Array
                                                        (
                                                            [!cibil_tag] => 07
                                                        )

                                                    [43] => Array
                                                        (
                                                            [!cibil_tag] => 06
                                                        )

                                                    [44] => Array
                                                        (
                                                            [!cibil_tag] => 05
                                                        )

                                                    [45] => Array
                                                        (
                                                            [!cibil_tag] => 04
                                                            [!] => -0001
                                                        )

                                                    [46] => Array
                                                        (
                                                            [!cibil_tag] => 03
                                                            [!] => 14022017
                                                        )

                                                    [47] => Array
                                                        (
                                                            [!cibil_tag] => 02
                                                            [!] => 10
                                                        )

                                                    [48] => Array
                                                        (
                                                            [!cibil_tag] => 01
                                                            [!] => 01
                                                        )

                                                    [49] => Array
                                                        (
                                                            [!cibil_tag] => SC
                                                            [!] => CIBILTUSCR
                                                        )

                                                    [50] => Array
                                                        (
                                                            [!cibil_tag] => 19
                                                        )

                                                    [51] => Array
                                                        (
                                                            [!cibil_tag] => 18
                                                        )

                                                    [52] => Array
                                                        (
                                                            [!cibil_tag] => 17
                                                        )

                                                    [53] => Array
                                                        (
                                                            [!cibil_tag] => 16
                                                        )

                                                    [54] => Array
                                                        (
                                                            [!cibil_tag] => 15
                                                        )

                                                    [55] => Array
                                                        (
                                                            [!cibil_tag] => 14
                                                        )

                                                    [56] => Array
                                                        (
                                                            [!cibil_tag] => 13
                                                        )

                                                    [57] => Array
                                                        (
                                                            [!cibil_tag] => 12
                                                        )

                                                    [58] => Array
                                                        (
                                                            [!cibil_tag] => 11
                                                        )

                                                    [59] => Array
                                                        (
                                                            [!cibil_tag] => 75
                                                        )

                                                    [60] => Array
                                                        (
                                                            [!cibil_tag] => 10
                                                        )

                                                    [61] => Array
                                                        (
                                                            [!cibil_tag] => 74
                                                        )

                                                    [62] => Array
                                                        (
                                                            [!cibil_tag] => 73
                                                        )

                                                    [63] => Array
                                                        (
                                                            [!cibil_tag] => 72
                                                        )

                                                    [64] => Array
                                                        (
                                                            [!cibil_tag] => 71
                                                        )

                                                    [65] => Array
                                                        (
                                                            [!cibil_tag] => 70
                                                        )

                                                    [66] => Array
                                                        (
                                                            [!cibil_tag] => 69
                                                        )

                                                    [67] => Array
                                                        (
                                                            [!cibil_tag] => 68
                                                        )

                                                    [68] => Array
                                                        (
                                                            [!cibil_tag] => 67
                                                        )

                                                    [69] => Array
                                                        (
                                                            [!cibil_tag] => 66
                                                        )

                                                    [70] => Array
                                                        (
                                                            [!cibil_tag] => 65
                                                        )

                                                    [71] => Array
                                                        (
                                                            [!cibil_tag] => 64
                                                        )

                                                    [72] => Array
                                                        (
                                                            [!cibil_tag] => 63
                                                        )

                                                    [73] => Array
                                                        (
                                                            [!cibil_tag] => 62
                                                        )

                                                    [74] => Array
                                                        (
                                                            [!cibil_tag] => 61
                                                        )

                                                    [75] => Array
                                                        (
                                                            [!cibil_tag] => 60
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_SC
                                )

                            [8] => Array
                                (
                                    [block] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [field] => Array
                                                        (
                                                            [0] => Array
                                                                (
                                                                    [!cibil_tag] => 09
                                                                )

                                                            [1] => Array
                                                                (
                                                                    [!cibil_tag] => 08
                                                                    [!] => 03
                                                                )

                                                            [2] => Array
                                                                (
                                                                    [!cibil_tag] => 07
                                                                    [!] => 110002
                                                                )

                                                            [3] => Array
                                                                (
                                                                    [!cibil_tag] => 06
                                                                    [!] => 07
                                                                )

                                                            [4] => Array
                                                                (
                                                                    [!cibil_tag] => 05
                                                                    [!] => NCR RMM
                                                                )

                                                            [5] => Array
                                                                (
                                                                    [!cibil_tag] => 04
                                                                    [!] => DELHI
                                                                )

                                                            [6] => Array
                                                                (
                                                                    [!cibil_tag] => 90
                                                                    [!] => Y
                                                                )

                                                            [7] => Array
                                                                (
                                                                    [!cibil_tag] => 03
                                                                    [!] => NEW DELHI
                                                                )

                                                            [8] => Array
                                                                (
                                                                    [!cibil_tag] => 11
                                                                )

                                                            [9] => Array
                                                                (
                                                                    [!cibil_tag] => 02
                                                                    [!] => NEW DELHI
                                                                )

                                                            [10] => Array
                                                                (
                                                                    [!cibil_tag] => 10
                                                                    [!] => 13022017
                                                                )

                                                            [11] => Array
                                                                (
                                                                    [!cibil_tag] => 01
                                                                    [!] => 10 DARYA GANJ
                                                                )

                                                            [12] => Array
                                                                (
                                                                    [!cibil_tag] => PA
                                                                    [!] => A01
                                                                )

                                                        )

                                                    [!nb] => 1
                                                )

                                            [1] => Array
                                                (
                                                    [field] => Array
                                                        (
                                                            [0] => Array
                                                                (
                                                                    [!cibil_tag] => 09
                                                                )

                                                            [1] => Array
                                                                (
                                                                    [!cibil_tag] => 08
                                                                    [!] => 02
                                                                )

                                                            [2] => Array
                                                                (
                                                                    [!cibil_tag] => 07
                                                                    [!] => 110014
                                                                )

                                                            [3] => Array
                                                                (
                                                                    [!cibil_tag] => 06
                                                                    [!] => 07
                                                                )

                                                            [4] => Array
                                                                (
                                                                    [!cibil_tag] => 05
                                                                    [!] => NCR RMM
                                                                )

                                                            [5] => Array
                                                                (
                                                                    [!cibil_tag] => 04
                                                                    [!] => DELHI
                                                                )

                                                            [6] => Array
                                                                (
                                                                    [!cibil_tag] => 90
                                                                    [!] => Y
                                                                )

                                                            [7] => Array
                                                                (
                                                                    [!cibil_tag] => 03
                                                                    [!] => ASHRAM
                                                                )

                                                            [8] => Array
                                                                (
                                                                    [!cibil_tag] => 11
                                                                )

                                                            [9] => Array
                                                                (
                                                                    [!cibil_tag] => 02
                                                                    [!] => HARI NAGAR
                                                                )

                                                            [10] => Array
                                                                (
                                                                    [!cibil_tag] => 10
                                                                    [!] => 13022017
                                                                )

                                                            [11] => Array
                                                                (
                                                                    [!cibil_tag] => 01
                                                                    [!] => A-29 FF
                                                                )

                                                            [12] => Array
                                                                (
                                                                    [!cibil_tag] => PA
                                                                    [!] => A02
                                                                )

                                                        )

                                                    [!nb] => 2
                                                )

                                        )

                                    [!name] => OUT_PA
                                )

                            [9] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => 45
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => 44
                                                        )

                                                    [2] => Array
                                                        (
                                                            [!cibil_tag] => 43
                                                        )

                                                    [3] => Array
                                                        (
                                                            [!cibil_tag] => 42
                                                        )

                                                    [4] => Array
                                                        (
                                                            [!cibil_tag] => 41
                                                        )

                                                    [5] => Array
                                                        (
                                                            [!cibil_tag] => 40
                                                        )

                                                    [6] => Array
                                                        (
                                                            [!cibil_tag] => 39
                                                        )

                                                    [7] => Array
                                                        (
                                                            [!cibil_tag] => 38
                                                        )

                                                    [8] => Array
                                                        (
                                                            [!cibil_tag] => 37
                                                        )

                                                    [9] => Array
                                                        (
                                                            [!cibil_tag] => 36
                                                        )

                                                    [10] => Array
                                                        (
                                                            [!cibil_tag] => 12
                                                        )

                                                    [11] => Array
                                                        (
                                                            [!cibil_tag] => 11
                                                        )

                                                    [12] => Array
                                                        (
                                                            [!cibil_tag] => 35
                                                        )

                                                    [13] => Array
                                                        (
                                                            [!cibil_tag] => 10
                                                        )

                                                    [14] => Array
                                                        (
                                                            [!cibil_tag] => 34
                                                        )

                                                    [15] => Array
                                                        (
                                                            [!cibil_tag] => 09
                                                        )

                                                    [16] => Array
                                                        (
                                                            [!cibil_tag] => 33
                                                        )

                                                    [17] => Array
                                                        (
                                                            [!cibil_tag] => 08
                                                        )

                                                    [18] => Array
                                                        (
                                                            [!cibil_tag] => 32
                                                        )

                                                    [19] => Array
                                                        (
                                                            [!cibil_tag] => 05
                                                        )

                                                    [20] => Array
                                                        (
                                                            [!cibil_tag] => 31
                                                        )

                                                    [21] => Array
                                                        (
                                                            [!cibil_tag] => 04
                                                        )

                                                    [22] => Array
                                                        (
                                                            [!cibil_tag] => 30
                                                        )

                                                    [23] => Array
                                                        (
                                                            [!cibil_tag] => 03
                                                        )

                                                    [24] => Array
                                                        (
                                                            [!cibil_tag] => 29
                                                        )

                                                    [25] => Array
                                                        (
                                                            [!cibil_tag] => 02
                                                        )

                                                    [26] => Array
                                                        (
                                                            [!cibil_tag] => 28
                                                        )

                                                    [27] => Array
                                                        (
                                                            [!cibil_tag] => TL
                                                        )

                                                    [28] => Array
                                                        (
                                                            [!cibil_tag] => 14
                                                        )

                                                    [29] => Array
                                                        (
                                                            [!cibil_tag] => 13
                                                        )

                                                    [30] => Array
                                                        (
                                                            [!cibil_tag] => 87
                                                        )

                                                    [31] => Array
                                                        (
                                                            [!cibil_tag] => 86
                                                        )

                                                    [32] => Array
                                                        (
                                                            [!cibil_tag] => 85
                                                        )

                                                    [33] => Array
                                                        (
                                                            [!cibil_tag] => 84
                                                        )

                                                    [34] => Array
                                                        (
                                                            [!cibil_tag] => 83
                                                        )

                                                    [35] => Array
                                                        (
                                                            [!cibil_tag] => 82
                                                        )

                                                    [36] => Array
                                                        (
                                                            [!cibil_tag] => 80
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_TL
                                )

                            [10] => Array
                                (
                                    [block] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [field] => Array
                                                        (
                                                            [0] => Array
                                                                (
                                                                    [!cibil_tag] => 06
                                                                    [!] => 900000
                                                                )

                                                            [1] => Array
                                                                (
                                                                    [!cibil_tag] => 05
                                                                    [!] => 05
                                                                )

                                                            [2] => Array
                                                                (
                                                                    [!cibil_tag] => 04
                                                                    [!] => FICCL
                                                                )

                                                            [3] => Array
                                                                (
                                                                    [!cibil_tag] => 01
                                                                    [!] => 13022017
                                                                )

                                                            [4] => Array
                                                                (
                                                                    [!cibil_tag] => IQ
                                                                    [!] => I001
                                                                )

                                                        )

                                                    [!nb] => 1
                                                )

                                            [1] => Array
                                                (
                                                    [field] => Array
                                                        (
                                                            [0] => Array
                                                                (
                                                                    [!cibil_tag] => 06
                                                                    [!] => 900000
                                                                )

                                                            [1] => Array
                                                                (
                                                                    [!cibil_tag] => 05
                                                                    [!] => 05
                                                                )

                                                            [2] => Array
                                                                (
                                                                    [!cibil_tag] => 04
                                                                    [!] => FICCL
                                                                )

                                                            [3] => Array
                                                                (
                                                                    [!cibil_tag] => 01
                                                                    [!] => 13022017
                                                                )

                                                            [4] => Array
                                                                (
                                                                    [!cibil_tag] => IQ
                                                                    [!] => I002
                                                                )

                                                        )

                                                    [!nb] => 2
                                                )

                                            [2] => Array
                                                (
                                                    [field] => Array
                                                        (
                                                            [0] => Array
                                                                (
                                                                    [!cibil_tag] => 06
                                                                    [!] => 900000
                                                                )

                                                            [1] => Array
                                                                (
                                                                    [!cibil_tag] => 05
                                                                    [!] => 05
                                                                )

                                                            [2] => Array
                                                                (
                                                                    [!cibil_tag] => 04
                                                                    [!] => FICCL
                                                                )

                                                            [3] => Array
                                                                (
                                                                    [!cibil_tag] => 01
                                                                    [!] => 13022017
                                                                )

                                                            [4] => Array
                                                                (
                                                                    [!cibil_tag] => IQ
                                                                    [!] => I003
                                                                )

                                                        )

                                                    [!nb] => 3
                                                )

                                        )

                                    [!name] => OUT_IQ
                                )

                            [11] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => 06
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => 05
                                                        )

                                                    [2] => Array
                                                        (
                                                            [!cibil_tag] => 04
                                                        )

                                                    [3] => Array
                                                        (
                                                            [!cibil_tag] => 03
                                                        )

                                                    [4] => Array
                                                        (
                                                            [!cibil_tag] => 02
                                                        )

                                                    [5] => Array
                                                        (
                                                            [!cibil_tag] => 01
                                                        )

                                                    [6] => Array
                                                        (
                                                            [!cibil_tag] => DR
                                                        )

                                                    [7] => Array
                                                        (
                                                            [!cibil_tag] => 07
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_DR
                                )

                            [12] => Array
                                (
                                    [block] => Array
                                        (
                                            [field] => Array
                                                (
                                                    [0] => Array
                                                        (
                                                            [!cibil_tag] => 01
                                                            [!] => **
                                                        )

                                                    [1] => Array
                                                        (
                                                            [!cibil_tag] => ES
                                                            [!] => 0000640
                                                        )

                                                )

                                            [!nb] => 1
                                        )

                                    [!name] => OUT_ES
                                )

                        )

                    [!index] => 1
                )

        )

    [!pending] => false
)

*/

?>