<?php
ini_set('max_execution_time', 2000);

//require_once ("lib/nusoap_fullerton.php");
require_once ("lib/nusoap.php");

//connectplus1();
connectplus2();
//crmsave();

function connectplus1()
{ // response : Array ( [TicketNumber] => 120282 [DateTimeRequestReceived] => 25-11-2016 15:50:38:510 [!pending] => true ) 
$xmlstr='<env:Envelope xmlns:env="http://schemas.xmlsoap.org/soap/envelope/" xmlns:defs="http://defs.webservices.experian.com">
         <env:Header/>
         <env:Body>
            <defs:InputNewApplicationXML extended="true">
               <ControlBlock.ReferenceNumber>1616175</ControlBlock.ReferenceNumber>
               <ControlBlock.ConnectPlusUniqueID></ControlBlock.ConnectPlusUniqueID>
               <ControlBlock.CallType>01</ControlBlock.CallType>
               <ControlBlock.SearchType>2</ControlBlock.SearchType>
               <ControlBlock.StrategyCode>01</ControlBlock.StrategyCode>
               <ControlBlock.ScoreType>1</ControlBlock.ScoreType>
               <ControlBlock.IPAddress></ControlBlock.IPAddress>
               <ControlBlock.SearchPreviousApplications>1</ControlBlock.SearchPreviousApplications>
               <ApplicantBlock.ApplicantType>01</ApplicantBlock.ApplicantType>
               <ApplicantBlock.Gender>F</ApplicantBlock.Gender>
               <ApplicantBlock.Prefix>Mrs</ApplicantBlock.Prefix>
               <ApplicantBlock.ConsumerName1>CHAUHAN</ApplicantBlock.ConsumerName1>
               <ApplicantBlock.ConsumerName2>RANJANA</ApplicantBlock.ConsumerName2>
               <ApplicantBlock.ConsumerName3></ApplicantBlock.ConsumerName3>
               <ApplicantBlock.ConsumerName4></ApplicantBlock.ConsumerName4>
               <ApplicantBlock.ConsumerName5></ApplicantBlock.ConsumerName5>
               <ApplicantBlock.IDNumber1></ApplicantBlock.IDNumber1>
               <ApplicantBlock.IDNumber2>AAAPA0865A</ApplicantBlock.IDNumber2>
               <ApplicantBlock.IDNumber3></ApplicantBlock.IDNumber3>
               <ApplicantBlock.IDNumber4></ApplicantBlock.IDNumber4>
               <ApplicantBlock.IDNumber5></ApplicantBlock.IDNumber5>
               <ApplicantBlock.Nationality>356</ApplicantBlock.Nationality>
               <ApplicantBlock.DateOfBirth>19850112</ApplicantBlock.DateOfBirth>
               <ApplicantBlock.PlaceOfBirth>356</ApplicantBlock.PlaceOfBirth>
               <ApplicantBlock.TownOrProvinceOfBirth></ApplicantBlock.TownOrProvinceOfBirth>
               <ApplicantBlock.ContactDetails.EmailAddress></ApplicantBlock.ContactDetails.EmailAddress>
               <ApplicantBlock.Other.MilitaryServiceStatus>N</ApplicantBlock.Other.MilitaryServiceStatus>
               <ApplicantBlock.Other.ExistingCustomer>0</ApplicantBlock.Other.ExistingCustomer>
               <ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierCurrentAddress>
               </ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierCurrentAddress>
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
               <ApplicantBlock.ContactDetails.MobileTelephoneNumber>9873678915</ApplicantBlock.ContactDetails.MobileTelephoneNumber>
               <ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierPreviousAddress></ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierPreviousAddress>
               <ApplicantBlock.AddressDetails.PreviousAddressLine1></ApplicantBlock.AddressDetails.PreviousAddressLine1>
               <ApplicantBlock.AddressDetails.PreviousAddressLine2></ApplicantBlock.AddressDetails.PreviousAddressLine2><ApplicantBlock.AddressDetails.PreviousAddressLine3></ApplicantBlock.AddressDetails.PreviousAddressLine3><ApplicantBlock.AddressDetails.PreviousAddressLine5></ApplicantBlock.AddressDetails.PreviousAddressLine5><ApplicantBlock.AddressDetails.PreviousAddressLine6></ApplicantBlock.AddressDetails.PreviousAddressLine6><ApplicantBlock.AddressDetails.PreviousAddressLine7></ApplicantBlock.AddressDetails.PreviousAddressLine7><ApplicantBlock.AddressDetails.PreviousAddressLine8></ApplicantBlock.AddressDetails.PreviousAddressLine8><ApplicantBlock.AddressDetails.PreviousAddressLine9></ApplicantBlock.AddressDetails.PreviousAddressLine9><ApplicantBlock.AddressDetails.PreviousAddressLine10></ApplicantBlock.AddressDetails.PreviousAddressLine10><ApplicantBlock.AddressDetails.PreviousAddressLine11></ApplicantBlock.AddressDetails.PreviousAddressLine11><ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierPreviousAddress2></ApplicantBlock.AddressDetails.BureauMultiMatchIdentifierPreviousAddress2><ApplicantBlock.AddressDetails.PreviousAddress2Line1></ApplicantBlock.AddressDetails.PreviousAddress2Line1><ApplicantBlock.AddressDetails.PreviousAddress2Line2></ApplicantBlock.AddressDetails.PreviousAddress2Line2><ApplicantBlock.AddressDetails.PreviousAddress2Line3></ApplicantBlock.AddressDetails.PreviousAddress2Line3><ApplicantBlock.AddressDetails.PreviousAddress2Line5></ApplicantBlock.AddressDetails.PreviousAddress2Line5><ApplicantBlock.AddressDetails.PreviousAddress2Line6></ApplicantBlock.AddressDetails.PreviousAddress2Line6><ApplicantBlock.AddressDetails.PreviousAddress2Line7></ApplicantBlock.AddressDetails.PreviousAddress2Line7><ApplicantBlock.AddressDetails.PreviousAddress2Line8></ApplicantBlock.AddressDetails.PreviousAddress2Line8><ApplicantBlock.AddressDetails.PreviousAddress2Line9></ApplicantBlock.AddressDetails.PreviousAddress2Line9><ApplicantBlock.AddressDetails.PreviousAddress2Line10></ApplicantBlock.AddressDetails.PreviousAddress2Line10><ApplicantBlock.AddressDetails.PreviousAddress2Line11></ApplicantBlock.AddressDetails.PreviousAddress2Line11><ApplicantBlock.EmploymentDetails.Occupation></ApplicantBlock.EmploymentDetails.Occupation><ApplicantBlock.EmploymentDetails.GrossAnnualIncome></ApplicantBlock.EmploymentDetails.GrossAnnualIncome><ApplicantBlock.EmploymentDetails.NetAnnualIncome></ApplicantBlock.EmploymentDetails.NetAnnualIncome><ApplicantBlock.EmploymentDetails.SalaryFrequency></ApplicantBlock.EmploymentDetails.SalaryFrequency><ApplicantBlock.EmploymentDetails.FrqRelatedSalary></ApplicantBlock.EmploymentDetails.FrqRelatedSalary><ApplicantBlock.EmploymentDetails.EmployerName></ApplicantBlock.EmploymentDetails.EmployerName><ApplicantBlock.EmploymentDetails.AddressLine1>10 DARYA GANJ</ApplicantBlock.EmploymentDetails.AddressLine1><ApplicantBlock.EmploymentDetails.AddressLine2>NEW DELHI</ApplicantBlock.EmploymentDetails.AddressLine2><ApplicantBlock.EmploymentDetails.AddressLine3>NEW DELHI</ApplicantBlock.EmploymentDetails.AddressLine3><ApplicantBlock.EmploymentDetails.AddressLine5></ApplicantBlock.EmploymentDetails.AddressLine5><ApplicantBlock.EmploymentDetails.AddressLine6>DELHI</ApplicantBlock.EmploymentDetails.AddressLine6><ApplicantBlock.EmploymentDetails.AddressLine7>NCR RMM</ApplicantBlock.EmploymentDetails.AddressLine7><ApplicantBlock.EmploymentDetails.AddressLine8></ApplicantBlock.EmploymentDetails.AddressLine8><ApplicantBlock.EmploymentDetails.AddressLine9></ApplicantBlock.EmploymentDetails.AddressLine9><ApplicantBlock.EmploymentDetails.AddressLine10></ApplicantBlock.EmploymentDetails.AddressLine10><ApplicantBlock.EmploymentDetails.AddressLine11>110002</ApplicantBlock.EmploymentDetails.AddressLine11><ApplicantBlock.BankDetails.AccountCountryCode></ApplicantBlock.BankDetails.AccountCountryCode><ApplicantBlock.BankDetails.AccountDetail1></ApplicantBlock.BankDetails.AccountDetail1><ApplicantBlock.BankDetails.AccountDetail2></ApplicantBlock.BankDetails.AccountDetail2><ApplicantBlock.BankDetails.AccountDetail3></ApplicantBlock.BankDetails.AccountDetail3><ApplicantBlock.BankDetails.AccountDetail4></ApplicantBlock.BankDetails.AccountDetail4><ApplicantBlock.BankDetails.AccountDetail5></ApplicantBlock.BankDetails.AccountDetail5><ApplicantBlock.BankDetails.NameOfPrimaryBank></ApplicantBlock.BankDetails.NameOfPrimaryBank><ApplicantBlock.BankDetails.AddressLine1></ApplicantBlock.BankDetails.AddressLine1><ApplicantBlock.BankDetails.AddressLine2></ApplicantBlock.BankDetails.AddressLine2><ApplicantBlock.BankDetails.AddressLine3></ApplicantBlock.BankDetails.AddressLine3><ApplicantBlock.BankDetails.AddressLine5></ApplicantBlock.BankDetails.AddressLine5><ApplicantBlock.BankDetails.AddressLine6></ApplicantBlock.BankDetails.AddressLine6><ApplicantBlock.BankDetails.AddressLine7></ApplicantBlock.BankDetails.AddressLine7><ApplicantBlock.BankDetails.AddressLine8></ApplicantBlock.BankDetails.AddressLine8><ApplicantBlock.BankDetails.AddressLine9></ApplicantBlock.BankDetails.AddressLine9><ApplicantBlock.BankDetails.AddressLine10></ApplicantBlock.BankDetails.AddressLine10><ApplicantBlock.BankDetails.AddressLine11></ApplicantBlock.BankDetails.AddressLine11><ApplicantBlock.BankDetails.AccountName></ApplicantBlock.BankDetails.AccountName><ApplicantBlock.BankDetails.TimeAtBankYY></ApplicantBlock.BankDetails.TimeAtBankYY><ApplicantBlock.BankDetails.TimeAtBankMM></ApplicantBlock.BankDetails.TimeAtBankMM><CreditBlock.FinanceEnquiryType>5</CreditBlock.FinanceEnquiryType><CreditBlock.PurposeOfFinance>5</CreditBlock.PurposeOfFinance><CreditBlock.AmountOfFinance>400000</CreditBlock.AmountOfFinance><CreditBlock.RepaymentPeriod></CreditBlock.RepaymentPeriod><CreditBlock.NumberOfInstalments></CreditBlock.NumberOfInstalments><CreditBlock.AmountOfInstalments></CreditBlock.AmountOfInstalments><CreditBlock.ExistingAccountNumber1></CreditBlock.ExistingAccountNumber1><CreditBlock.ExistingAccountNumber2></CreditBlock.ExistingAccountNumber2><CreditBlock.ExistingAccountNumber3></CreditBlock.ExistingAccountNumber3><CreditBlock.ExistingAccountNumber4></CreditBlock.ExistingAccountNumber4><ControlBlock.ApplicationDate>20130516</ControlBlock.ApplicationDate><ControlBlock.CountryCode>356</ControlBlock.CountryCode><ControlBlock.ServiceCode1></ControlBlock.ServiceCode1><ControlBlock.ServiceCode2></ControlBlock.ServiceCode2><ControlBlock.ServiceCode3></ControlBlock.ServiceCode3><ControlBlock.ServiceCode4></ControlBlock.ServiceCode4><ControlBlock.ServiceCode5></ControlBlock.ServiceCode5><ControlBlock.BureauGroupCode></ControlBlock.BureauGroupCode><ControlBlock.NumberOfApplicants>1</ControlBlock.NumberOfApplicants><ApplicantBlock.LocalLanguageConsumerName1></ApplicantBlock.LocalLanguageConsumerName1><ApplicantBlock.LocalLanguageConsumerName2></ApplicantBlock.LocalLanguageConsumerName2><ApplicantBlock.LocalLanguageConsumerName3></ApplicantBlock.LocalLanguageConsumerName3><ApplicantBlock.BureauCustomerID></ApplicantBlock.BureauCustomerID><ApplicantBlock.IDDocumentType1>P</ApplicantBlock.IDDocumentType1><ApplicantBlock.IDIssuingCountry1>356</ApplicantBlock.IDIssuingCountry1><ApplicantBlock.IDDocumentType2>T</ApplicantBlock.IDDocumentType2><ApplicantBlock.IDIssuingCountry2>356</ApplicantBlock.IDIssuingCountry2><ApplicantBlock.IDDocumentType3>V</ApplicantBlock.IDDocumentType3><ApplicantBlock.IDIssuingCountry3>356</ApplicantBlock.IDIssuingCountry3><ApplicantBlock.IDDocumentType4>D</ApplicantBlock.IDDocumentType4><ApplicantBlock.IDIssuingCountry4>356</ApplicantBlock.IDIssuingCountry4><ApplicantBlock.IDDocumentType5></ApplicantBlock.IDDocumentType5><ApplicantBlock.IDIssuingCountry5></ApplicantBlock.IDIssuingCountry5><ApplicantBlock.OldIdentityCardNumber></ApplicantBlock.OldIdentityCardNumber><ApplicantBlock.Citizenship>356</ApplicantBlock.Citizenship><ApplicantBlock.EducationLevel></ApplicantBlock.EducationLevel><ApplicantBlock.MaritalStatus></ApplicantBlock.MaritalStatus><ApplicantBlock.NumberOfDependants></ApplicantBlock.NumberOfDependants><ApplicantBlock.RelationshipWithBankEmployee></ApplicantBlock.RelationshipWithBankEmployee><ApplicantBlock.EmploymentDetails.IndustryType></ApplicantBlock.EmploymentDetails.IndustryType><ApplicantBlock.EmploymentDetails.AdditionalAnnualIncome></ApplicantBlock.EmploymentDetails.AdditionalAnnualIncome><ApplicantBlock.EmploymentDetails.TimeInEmploymentYYMM>0200</ApplicantBlock.EmploymentDetails.TimeInEmploymentYYMM><ApplicantBlock.EmploymentDetails.Position></ApplicantBlock.EmploymentDetails.Position><ApplicantBlock.EmploymentDetails.AddressCountryCode>356</ApplicantBlock.EmploymentDetails.AddressCountryCode><ApplicantBlock.PreviousEmploymentDetails.EmployerName></ApplicantBlock.PreviousEmploymentDetails.EmployerName><ApplicantBlock.PreviousEmploymentDetails.AddressLine1></ApplicantBlock.PreviousEmploymentDetails.AddressLine1><ApplicantBlock.PreviousEmploymentDetails.AddressLine2></ApplicantBlock.PreviousEmploymentDetails.AddressLine2><ApplicantBlock.PreviousEmploymentDetails.AddressLine3></ApplicantBlock.PreviousEmploymentDetails.AddressLine3><ApplicantBlock.PreviousEmploymentDetails.AddressLine4></ApplicantBlock.PreviousEmploymentDetails.AddressLine4><ApplicantBlock.PreviousEmploymentDetails.AddressLine5></ApplicantBlock.PreviousEmploymentDetails.AddressLine5><ApplicantBlock.PreviousEmploymentDetails.AddressLine6></ApplicantBlock.PreviousEmploymentDetails.AddressLine6><ApplicantBlock.PreviousEmploymentDetails.AddressLine7></ApplicantBlock.PreviousEmploymentDetails.AddressLine7><ApplicantBlock.PreviousEmploymentDetails.AddressLine8></ApplicantBlock.PreviousEmploymentDetails.AddressLine8><ApplicantBlock.PreviousEmploymentDetails.AddressLine9></ApplicantBlock.PreviousEmploymentDetails.AddressLine9><ApplicantBlock.PreviousEmploymentDetails.AddressLine10></ApplicantBlock.PreviousEmploymentDetails.AddressLine10><ApplicantBlock.PreviousEmploymentDetails.AddressLine11></ApplicantBlock.PreviousEmploymentDetails.AddressLine11><ApplicantBlock.PreviousEmploymentDetails.AddressCountryCode></ApplicantBlock.PreviousEmploymentDetails.AddressCountryCode><CreditBlock.CustSegPortfolioID></CreditBlock.CustSegPortfolioID><CreditBlock.ProductLimitMinimum></CreditBlock.ProductLimitMinimum><CreditBlock.ProductLimitMaximum></CreditBlock.ProductLimitMaximum><CreditBlock.PreApprovedLimit></CreditBlock.PreApprovedLimit><ApplicantBlock.AddressDetails.TimeAtPreviousAddressYYMM></ApplicantBlock.AddressDetails.TimeAtPreviousAddressYYMM><ApplicantBlock.AddressDetails.TimeAtPreviousAddress2YYMM></ApplicantBlock.AddressDetails.TimeAtPreviousAddress2YYMM><ApplicantBlock.Other.BureauSearchConsent>1</ApplicantBlock.Other.BureauSearchConsent><ApplicantBlock.SpareFlag5></ApplicantBlock.SpareFlag5><ApplicantBlock.Decision.FinalDecision>ACCPT</ApplicantBlock.Decision.FinalDecision><ApplicantBlock.Decision.DateOfDecision></ApplicantBlock.Decision.DateOfDecision><ApplicantBlock.Decision.AmountApproved></ApplicantBlock.Decision.AmountApproved><ApplicantBlock.Decision.RejectReason></ApplicantBlock.Decision.RejectReason><ApplicantBlock.SpareFlag4></ApplicantBlock.SpareFlag4><ApplicantBlock.SpareFlag2></ApplicantBlock.SpareFlag2><ApplicantBlock.SpareFlag3></ApplicantBlock.SpareFlag3><ApplicantBlock.SpareFlag1></ApplicantBlock.SpareFlag1><ApplicantBlock.SuppCH.Contact.HomeTelephoneNumber></ApplicantBlock.SuppCH.Contact.HomeTelephoneNumber><ApplicantBlock.SuppCH.Contact.MobileTelephoneNumber></ApplicantBlock.SuppCH.Contact.MobileTelephoneNumber><ApplicantBlock.SuppCH.Contact.WorkTelephoneNumber></ApplicantBlock.SuppCH.Contact.WorkTelephoneNumber><ApplicantBlock.SuppCH.EmpDet.Occupation></ApplicantBlock.SuppCH.EmpDet.Occupation><ApplicantBlock.ContactDetails.HomeTelephoneNumber></ApplicantBlock.ContactDetails.HomeTelephoneNumber><ApplicantBlock.ContactDetails.WorkTelephoneNumber>43744900</ApplicantBlock.ContactDetails.WorkTelephoneNumber><ApplicantBlock.AddressDetails.TimeAtCurrentAddressYYMM></ApplicantBlock.AddressDetails.TimeAtCurrentAddressYYMM><ApplicantBlock.AddressDetails.Residential.CountryCode>356</ApplicantBlock.AddressDetails.Residential.CountryCode><ApplicantBlock.AddressDetails.Residential.AddressLine11>110014</ApplicantBlock.AddressDetails.Residential.AddressLine11><ApplicantBlock.AddressDetails.Residential.AddressLine5></ApplicantBlock.AddressDetails.Residential.AddressLine5><ApplicantBlock.AddressDetails.Residential.AddressLine7>NCR RMM</ApplicantBlock.AddressDetails.Residential.AddressLine7><ApplicantBlock.AddressDetails.Residential.AddressLine1>A-29 FF</ApplicantBlock.AddressDetails.Residential.AddressLine1><ApplicantBlock.AddressDetails.Residential.AddressLine6>DELHI</ApplicantBlock.AddressDetails.Residential.AddressLine6><ApplicantBlock.AddressDetails.Residential.AddressLine2>HARI NAGAR</ApplicantBlock.AddressDetails.Residential.AddressLine2><ApplicantBlock.AddressDetails.Residential.AddressLine3>ASHRAM</ApplicantBlock.AddressDetails.Residential.AddressLine3><ApplicantBlock.AddressDetails.Residential.AddressLine4></ApplicantBlock.AddressDetails.Residential.AddressLine4><ApplicantBlock.AddressDetails.Residential.AddressLine8></ApplicantBlock.AddressDetails.Residential.AddressLine8><ApplicantBlock.AddressDetails.Residential.AddressLine9></ApplicantBlock.AddressDetails.Residential.AddressLine9><ApplicantBlock.AddressDetails.Residential.AddressLine10></ApplicantBlock.AddressDetails.Residential.AddressLine10><ApplicantBlock.AddressDetails.Residential.CurrentlyResides></ApplicantBlock.AddressDetails.Residential.CurrentlyResides><ApplicantBlock.AddressDetails.AddressLine4></ApplicantBlock.AddressDetails.AddressLine4><ApplicantBlock.AddressDetails.PreviousAddressLine4></ApplicantBlock.AddressDetails.PreviousAddressLine4><ApplicantBlock.AddressDetails.PreviousAddress2Line4></ApplicantBlock.AddressDetails.PreviousAddress2Line4><ApplicantBlock.BankDetails.AddressLine4></ApplicantBlock.BankDetails.AddressLine4><ApplicantBlock.EmploymentDetails.AddressLine4></ApplicantBlock.EmploymentDetails.AddressLine4><ControlBlock.CurrencyCode>INR</ControlBlock.CurrencyCode><ControlBlock.LanguageCode>E</ControlBlock.LanguageCode><ApplicantBlock.ContactDetails.HomeInternationalCode>91</ApplicantBlock.ContactDetails.HomeInternationalCode><ApplicantBlock.ContactDetails.HomeExtension></ApplicantBlock.ContactDetails.HomeExtension><ApplicantBlock.ContactDetails.MobileInternationalDialCode>91</ApplicantBlock.ContactDetails.MobileInternationalDialCode><ApplicantBlock.ContactDetails.MobileTelephoneNoExtension></ApplicantBlock.ContactDetails.MobileTelephoneNoExtension><ApplicantBlock.ContactDetails.WorkInternationalDialCode>91</ApplicantBlock.ContactDetails.WorkInternationalDialCode><ApplicantBlock.ContactDetails.WorkTelephoneNoExtension></ApplicantBlock.ContactDetails.WorkTelephoneNoExtension><ApplicantBlock.SuppCH.Contact.HomeInternationalCode></ApplicantBlock.SuppCH.Contact.HomeInternationalCode><ApplicantBlock.SuppCH.Contact.HomeExtension></ApplicantBlock.SuppCH.Contact.HomeExtension><ApplicantBlock.SuppCH.Contact.MobileInternationalDialCode></ApplicantBlock.SuppCH.Contact.MobileInternationalDialCode><ApplicantBlock.SuppCH.Contact.MobileTelephoneNoExtension></ApplicantBlock.SuppCH.Contact.MobileTelephoneNoExtension><ApplicantBlock.SuppCH.Contact.WorkInternationalDialCode></ApplicantBlock.SuppCH.Contact.WorkInternationalDialCode><ApplicantBlock.SuppCH.Contact.WorkTelephoneNoExtension></ApplicantBlock.SuppCH.Contact.WorkTelephoneNoExtension><ApplicantBlock.EmploymentDetails.EmploymentStatus>D</ApplicantBlock.EmploymentDetails.EmploymentStatus><ApplicantBlock.AddressDetails.Residential.TimeAtCurrentAddressYYMM>0400</ApplicantBlock.AddressDetails.Residential.TimeAtCurrentAddressYYMM><ApplicantBlock.AddressDetails.PreviousAddressCountryCode></ApplicantBlock.AddressDetails.PreviousAddressCountryCode><CreditBlock.ProductCode></CreditBlock.ProductCode><ControlBlock.UGTicketNumber></ControlBlock.UGTicketNumber>
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

function connectplus2()
{// BRE
	$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:defs="http://defs.webservices.experian.com">
   <soapenv:Header/><soapenv:Body> <defs:fetchInputNewApplicationXML> <DateTimeRequestReceived>01-03-2017 19:00:29:866</DateTimeRequestReceived><TicketNumber>2802318</TicketNumber></defs:fetchInputNewApplicationXML></soapenv:Body></soapenv:Envelope>';

	$url ='https://cplusesb.fullertonindia.com:9081/magicxpi4_1/MGrqispi.dll?appname=IFSConnectPlus&prgname=HTTP&arguments=-AHTTP_CP%23Service';
	$soapClient = new nusoap_client("fullertonUGservice.wsdl", true);   

	$soapClient->setEndpoint($url);

	$info = $soapClient->call("fetchNewApplicationXML", $xmlstr);
	print_r($info);

}

function crmsave()
{
	$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:api="http://www.crmnext.com/api/">
   <soapenv:Header />
   <soapenv:Body>
      <api:Save>
         <!--Optional:-->
         <api:userContext>		
					<api:IsSuccess>true</api:IsSuccess>		
					<api:Message></api:Message>		
					<api:ClientTimeOffSet>0</api:ClientTimeOffSet>		
					<api:ExpiresOn>2027-06-23T10:14:09.950117+05:30</api:ExpiresOn>		
					<api:IsUTC>false</api:IsUTC>							
					<api:Token>qjg8clqv8mjs5njd6l2s676fkp4v9ls33x27s4zxrhgvq3t8sc6yz8nxc8zwksmb65b3f5shqaf4ttqmss22xfgnqzqu5qbtzr2t8lwvh7trg9qzj4mpdgrvar2ed74d9uybzn5fx733cd5ua469m5kcpadpscrmrh4pdxuyf7jhqqzx9cmsgdz3cmf83acsmbuqry3yfm4m9ayaubnltq6b7zgg5cdblht4rgyfekg4kbtjsq8cwyvwjrxedqzactvkfjt8ylvrux2hm5nefqljkm7fm5yt3h7fyv5qna2jutx7hq9kzcptgyh2tsessuskuyecje9lc</api:Token>
				</api:userContext>	
				<api:objects>		
					<api:CRMnextObject xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="api:Lead">
						<api:EmailOptOut>false</api:EmailOptOut>
						<api:PhoneOptOut>false</api:PhoneOptOut>
						<api:PreferredChannel>Email</api:PreferredChannel>
						<api:SmsOptOut>false</api:SmsOptOut>
						<api:TerritoryName></api:TerritoryName>						
						<api:AccountID>-1</api:AccountID>
						<api:AccountKey></api:AccountKey>
						<api:Address>HULLA GANJ 614   </api:Address>
						<api:AssignToCode></api:AssignToCode>
						<api:AssignToName></api:AssignToName>																		
						<api:AssigntoKey></api:AssigntoKey>
						<api:CampaignKey></api:CampaignKey>
						<api:CampaignName/>
						<api:ChildAccountID>-1</api:ChildAccountID>															
						<api:City>Kanpur</api:City>
						<api:Comments></api:Comments>
						<api:CompanyName>Others</api:CompanyName>
						<api:Country>India</api:Country>
						<api:CreatedBy>1</api:CreatedBy>
						<api:CreatedByCode></api:CreatedByCode>
						<api:CreatedOn>2016-03-10T11:21:30</api:CreatedOn>
						<api:CurrencyID>INR</api:CurrencyID>															
						<api:Custom>
							<api:l_Tier>Tier 2</api:l_Tier>														
							<api:l_AIP_Amount></api:l_AIP_Amount>
							<api:l_AIP_Tenure></api:l_AIP_Tenure>
							<api:l_Applicant_Type>1</api:l_Applicant_Type>
							<api:l_DOB>10/12/83</api:l_DOB>
							<api:l_PAN>ALDPA3373Q</api:l_PAN>
							<api:l_Gross_Monthly_Income>20000</api:l_Gross_Monthly_Income>
							<api:l_Gender>M</api:l_Gender>
							<api:l_MaritalStatus>2</api:l_MaritalStatus>
							<api:l_Father_First_Name></api:l_Father_First_Name>
							<api:FieldID_67>HULLA GANJ 614 </api:FieldID_67>
							<api:FieldID_68></api:FieldID_68>
							<api:FieldID_69></api:FieldID_69>
							<api:l_Current_Landmark></api:l_Current_Landmark>
							<api:l_Current_Country>India</api:l_Current_Country>
							<api:l_Current_State></api:l_Current_State>
							<api:l_Current_District></api:l_Current_District>
							<api:l_Yrs_Current_Add>5</api:l_Yrs_Current_Add>
							<api:l_Type_Current_Res>OWND</api:l_Type_Current_Res>
							<api:l_Monthly_Repayment>5000</api:l_Monthly_Repayment>
							<api:l_Office_Address1>1545B CIVIL LINES</api:l_Office_Address1>
							<api:l_Office_Address2></api:l_Office_Address2>
							<api:l_Office_Address3></api:l_Office_Address3>
							<api:l_Office_Landmark></api:l_Office_Landmark>
							<api:l_Office_Country>India</api:l_Office_Country>
							<api:l_Office_State></api:l_Office_State>
							<api:l_Office_District></api:l_Office_District>
							<api:l_Res_Mobile_No>9559928630</api:l_Res_Mobile_No>
							<api:l_CIBIL_Score>0</api:l_CIBIL_Score>																											
							<api:l_Father_Last_Name></api:l_Father_Last_Name>
							<api:l_OrganizationType>2</api:l_OrganizationType>
							<api:l_Designation></api:l_Designation>
							<api:l_Net_Monthly_Income>15000</api:l_Net_Monthly_Income>
							<api:l_Customertype>14</api:l_Customertype>
							<api:l_PreferredIRR>22.5</api:l_PreferredIRR>
							<api:l_Purpose_loan></api:l_Purpose_loan>
							<api:l_Qualification>2</api:l_Qualification>
							<api:l_RequiredLoanAmt>60000</api:l_RequiredLoanAmt>
							<api:l_Appref_No></api:l_Appref_No>
							<api:l_Father_Prefix></api:l_Father_Prefix>
							<api:l_Mnths_Current_Add></api:l_Mnths_Current_Add>
							<api:l_Branch_Disposition>Interested</api:l_Branch_Disposition>
							<api:l_DL_No></api:l_DL_No>
							<api:l_Voter_No></api:l_Voter_No>
							<api:l_Passport_No></api:l_Passport_No>
							<api:l_Emp_Type>K</api:l_Emp_Type>
							<api:l_IndustryType></api:l_IndustryType>
							<api:l_Total_Work_Exp_Yrs>5</api:l_Total_Work_Exp_Yrs>
							<api:l_Company_Type_Salaried>OTHERS</api:l_Company_Type_Salaried>
							<api:l_Company_Name_salaried>Others</api:l_Company_Name_salaried>
							<api:l_Lead_Source>Coordinator</api:l_Lead_Source>
							<api:l_Lead_Sub_source>Mass Channels</api:l_Lead_Sub_source>
							<api:l_Office_STD_Code></api:l_Office_STD_Code>
							<api:l_City_productwise>Kanpur</api:l_City_productwise>
							<api:l_CopyEmp_Type></api:l_CopyEmp_Type>
							<api:l_CopyApplicant_Type></api:l_CopyApplicant_Type>							
							<api:l_CopyProduct>PL</api:l_CopyProduct>
							<api:l_DealerUserName></api:l_DealerUserName>
							<api:l_Lead_Status_Summary>1</api:l_Lead_Status_Summary>																					
							<api:l_Type>1</api:l_Type>
							 <api:FieldID_986>0</api:FieldID_986>
							 <api:l_CurrentCity></api:l_CurrentCity>
							 <api:l_Currentpincode>208001</api:l_Currentpincode>
							 <api:l_Office_City></api:l_Office_City>
							 <api:l_OfficePincode>208001</api:l_OfficePincode>
							 <api:l_OmniUpdate></api:l_OmniUpdate>
							 <api:FieldID_1042>0</api:FieldID_1042>
							 <api:l_Report_EmpType>1</api:l_Report_EmpType>
							 <api:FieldID_1070>Tetra Media Pvt Ltd</api:FieldID_1070>
							 <api:l_DocsFlag></api:l_DocsFlag>
							 <api:I_Additional_Income></api:I_Additional_Income>
							 <api:I_Spouse_Income>0</api:I_Spouse_Income>
							 <api:FieldID_1463>0</api:FieldID_1463>
							 <api:FieldID_1464>0</api:FieldID_1464>
							 <api:l_Lead_Created_On>10/03/16 11:21 AM</api:l_Lead_Created_On>
							 <api:FieldID_1989>1</api:FieldID_1989>
							 <api:l_Doc_Chk_ApplicationForm1>55</api:l_Doc_Chk_ApplicationForm1>
							 <api:l_DocChk_ApplicationForm_Status1>2</api:l_DocChk_ApplicationForm_Status1>
							 <api:l_ApplicationForm_Doc_Upload1>195738</api:l_ApplicationForm_Doc_Upload1>
							 <api:l_Professional_Status1>1</api:l_Professional_Status1>
							 <api:l_Fin_Sub_Status_Code1></api:l_Fin_Sub_Status_Code1>
							 <api:l_Lead_Status_Summary>1</api:l_Lead_Status_Summary>
							<api:l_noOfIrdBncPayPF>0</api:l_noOfIrdBncPayPF>
							<api:l_noOfSalPenCrePF>0</api:l_noOfSalPenCrePF>
							<api:l_totlNumrOfTranPF>0</api:l_totlNumrOfTranPF>
							<api:l_bankNamePF></api:l_bankNamePF>
							<api:l_durOfDataFetchPF>0</api:l_durOfDataFetchPF>
							<api:l_lstOfAllTranPF>0</api:l_lstOfAllTranPF>
							<api:l_creditTurnoverPF>0</api:l_creditTurnoverPF>
							<api:l_highestBalancePF>0</api:l_highestBalancePF>																		
							<api:FieldID_848>0</api:FieldID_848>
							<api:FieldID_849>0</api:FieldID_849>
							<api:FieldID_850>0</api:FieldID_850>
							<api:FieldID_851>0</api:FieldID_851>
							<api:FieldID_852>0</api:FieldID_852>
							<api:FieldID_853>0</api:FieldID_853>
							<api:FieldID_854>0</api:FieldID_854>
							<api:FieldID_855>0</api:FieldID_855>
							<api:FieldID_856>0</api:FieldID_856>
							<api:FieldID_857>0</api:FieldID_857>																		
							<api:l_accountNumberPF>0</api:l_accountNumberPF>
							<api:FieldID_859>N</api:FieldID_859>
							<api:l_isResiCpvWaived></api:l_isResiCpvWaived>
							<api:l_isOffCpvWaived></api:l_isOffCpvWaived>
							<api:l_emailVerified></api:l_emailVerified>
							<api:l_avgIncomePF>0</api:l_avgIncomePF>
							<api:l_bankBalancePF></api:l_bankBalancePF>							
							<api:l_identityPrfProvided></api:l_identityPrfProvided>
							<api:l_identityProofType></api:l_identityProofType>
							<api:l_addressPrfProvided></api:l_addressPrfProvided>
							<api:l_addressProofType></api:l_addressProofType>
							<api:l_incomeProofProvided></api:l_incomeProofProvided>
							<api:l_incomeProofType></api:l_incomeProofType>																		
							<api:l_empntPrfProvided></api:l_empntPrfProvided>												
							<api:l_emplentPrfType></api:l_emplentPrfType>
							<api:l_aadharProvided></api:l_aadharProvided>
							<api:FieldID_986>0</api:FieldID_986>
							<api:FieldID_1042>0</api:FieldID_1042>
							<api:I_Additional_Income></api:I_Additional_Income>
							<api:I_Spouse_Income>0</api:I_Spouse_Income>
							<api:l_Lead_Created_On>10/03/16 11:21 AM</api:l_Lead_Created_On>
							<api:l_trade_info_1></api:l_trade_info_1>
							<api:l_trade_info_2></api:l_trade_info_2>
							<api:l_trade_info_3></api:l_trade_info_3>
							<api:l_trade_info_5></api:l_trade_info_5>
							<api:l_trade_info_6></api:l_trade_info_6>
							<api:l_trade_info_7></api:l_trade_info_7>
							<api:l_trade_info_8></api:l_trade_info_8>																	
							<api:l_enq_info_1></api:l_enq_info_1>
							<api:l_enq_info_2></api:l_enq_info_2>
							<api:l_enq_info_3></api:l_enq_info_3>
							<api:l_enq_info_4></api:l_enq_info_4>
							<api:l_enq_info_5></api:l_enq_info_5>
							<api:l_enq_info_6></api:l_enq_info_6>
							<api:l_enq_info_7></api:l_enq_info_7>
							<api:l_cust_info_1>45454</api:l_cust_info_1>
							<api:l_trade_info_10></api:l_trade_info_10>
							<api:l_trade_info_11></api:l_trade_info_11>
							<api:l_trade_info_12></api:l_trade_info_12>																		
							<api:l_pt_var_1></api:l_pt_var_1>
							<api:l_pt_var_2></api:l_pt_var_2>
							<api:l_pt_var_3></api:l_pt_var_3>
							<api:l_pt_var_4></api:l_pt_var_4>
							<api:l_pt_var_5></api:l_pt_var_5>
							<api:l_pt_var_6></api:l_pt_var_6>
							<api:l_pt_var_7></api:l_pt_var_7>
							<api:l_pt_var_8></api:l_pt_var_8>
							<api:l_pt_var_9></api:l_pt_var_9>
							<api:l_pt_var_10></api:l_pt_var_10>
							<api:l_pt_var_11></api:l_pt_var_11>
							<api:l_pt_var_12></api:l_pt_var_12>
							<api:l_pt_var_13></api:l_pt_var_13>
							<api:l_pt_var_14></api:l_pt_var_14>
							<api:l_pt_var_15></api:l_pt_var_15>
							<api:l_pt_var_16></api:l_pt_var_16>
							<api:l_pt_var_17></api:l_pt_var_17>
							<api:l_pt_var_18></api:l_pt_var_18>
							<api:l_pt_var_19></api:l_pt_var_19>
							<api:l_pt_var_20></api:l_pt_var_20>
							<api:l_pt_var_21></api:l_pt_var_21>
							<api:l_pt_var_22></api:l_pt_var_22>
							<api:l_pt_var_23></api:l_pt_var_23>							
							<api:l_cir_Gender_Match></api:l_cir_Gender_Match>
							<api:l_cir_DOB_Match></api:l_cir_DOB_Match>
							<api:l_cir_PAN_Match></api:l_cir_PAN_Match>
							<api:l_cir_Voter_Match></api:l_cir_Voter_Match>
							<api:l_cir_UID_Match></api:l_cir_UID_Match>
							<api:l_cir_DL_Match></api:l_cir_DL_Match>
							<api:l_cir_Passport_Match></api:l_cir_Passport_Match>
							<api:l_cir_Phone1_Match></api:l_cir_Phone1_Match>
							<api:l_cir_Phone2_Match></api:l_cir_Phone2_Match>
							<api:l_cir_Phone3_Match></api:l_cir_Phone3_Match>
							<api:l_cir_Phone4_Match></api:l_cir_Phone4_Match>
							<api:l_vtr_Gender_Match></api:l_vtr_Gender_Match>
							<api:l_vtr_Gender_Match_CIR></api:l_vtr_Gender_Match_CIR>
							<api:l_pan_Value></api:l_pan_Value>
							<api:l_pan_Value_CIR></api:l_pan_Value_CIR>
							<api:l_uid_Value></api:l_uid_Value>
							<api:l_uid_ID></api:l_uid_ID>
							<api:l_uid_Address></api:l_uid_Address>
							<api:l_uid_Full_Address></api:l_uid_Full_Address>
							<api:l_uid_Value_CIR></api:l_uid_Value_CIR>																		
							<api:l_uid_ID_CIR></api:l_uid_ID_CIR>
							<api:l_uid_Address_CIR></api:l_uid_Address_CIR>
							<api:l_uid_Full_Address_CIR></api:l_uid_Full_Address_CIR>
							<api:l_trade_info_4></api:l_trade_info_4>
							<api:l_trade_info_9></api:l_trade_info_9>
							<api:l_cir_Name_Match></api:l_cir_Name_Match>
							<api:l_cir_Address1_Match></api:l_cir_Address1_Match>
							<api:l_cir_Address2_Match></api:l_cir_Address2_Match>
							<api:l_vtr_Name_Match></api:l_vtr_Name_Match>
							<api:l_vtr_DOB_Match></api:l_vtr_DOB_Match>
							<api:l_vtr_Name_Match_CIR></api:l_vtr_Name_Match_CIR>
							<api:l_vtr_DOB_Match_CIR></api:l_vtr_DOB_Match_CIR>
							<api:l_pan_Name_Match></api:l_pan_Name_Match>
							<api:l_pan_Name_Match_CIR></api:l_pan_Name_Match_CIR>							
							<api:l_RiskStatus></api:l_RiskStatus>
							<api:l_RiskGrade></api:l_RiskGrade>
							<api:l_RpPowerRiskStatus></api:l_RpPowerRiskStatus>
							<api:l_RPCIBIL_Score></api:l_RPCIBIL_Score>
							<api:l_RPConnectToken>1809580</api:l_RPConnectToken>
						</api:Custom>															
						<api:District/>
						<api:Email>agarwalchandan83@yahoo.co.in</api:Email>
						<api:EmployeeCount/>
						<!--api:EmployeeCountKey>0</api:EmployeeCountKey-->
						<api:ExternalSLAOn>0001-01-01T00:00:00</api:ExternalSLAOn>
						<api:Fax/>
						<api:FirstName>CHANDAN</api:FirstName>
						<!--api:IndustryKey>0</api:IndustryKey-->
						<api:IndustryName></api:IndustryName>
						<api:InternalSLA>0</api:InternalSLA>
						<api:InternalSLAOn>0001-01-01T00:00:00</api:InternalSLAOn>
						<api:IsAssignmentRule>false</api:IsAssignmentRule>
						<api:IsAutoResponse>false</api:IsAutoResponse>																				
						<api:IsChildLead>false</api:IsChildLead>
						<api:IsDedupeSearch>false</api:IsDedupeSearch>
						<api:IsInsideBHR>false</api:IsInsideBHR>
						<api:LastModifiedBy>0</api:LastModifiedBy>
						<api:LastModifiedOn>0001-01-01T00:00:00</api:LastModifiedOn>
						<api:LastName>AGARWAL</api:LastName>
						<api:LastPrintedBy>0</api:LastPrintedBy>
						<api:LastPrintedByName/>
						<api:LastPrintedOn>0001-01-01T00:00:00</api:LastPrintedOn>
						<api:LayoutKey>2061</api:LayoutKey>
						<api:l_Professional_Status1>1</api:l_Professional_Status1>
						<api:LeadAmount>60000</api:LeadAmount>
						<api:LeadAmountDefault>0</api:LeadAmountDefault>
						<api:LeadKey></api:LeadKey>
						<api:LeadName>Chandan Agarwal</api:LeadName>
						<api:LeadOwnerKey>1</api:LeadOwnerKey>
						<api:LeadOwnerName></api:LeadOwnerName>
						<api:LeadOwnerTypeID>0</api:LeadOwnerTypeID>
						<api:LeadParentId>0</api:LeadParentId>
						<api:LeadParentName></api:LeadParentName>
						<api:LeadRating>Warm</api:LeadRating>
						<api:LeadSource></api:LeadSource>
						<api:LeadSourceKey>0</api:LeadSourceKey>
						<api:Locality></api:Locality>
						<api:MiddleName></api:MiddleName>
						<api:MobilePhone>9559928630</api:MobilePhone>
						<api:ObjectUniqueId></api:ObjectUniqueId>
						<api:OfferID>0</api:OfferID>
						<api:OfferName></api:OfferName>
						<api:OfficePhone></api:OfficePhone>
						<api:OwnerCode></api:OwnerCode>
						<api:Phone></api:Phone>
						<api:PreferredChannelKey>1</api:PreferredChannelKey>
						<api:PrevAssignTo>0</api:PrevAssignTo>
						<api:PrevOwnerId>0</api:PrevOwnerId>
						<api:PreviousStageId>0</api:PreviousStageId>
						<api:PrintStatus>false</api:PrintStatus>
						<api:ProductCategory>Unsecured</api:ProductCategory>
						<api:ProductCategoryID>0</api:ProductCategoryID>
						<api:ProductCode>DPL</api:ProductCode>
						<api:ProductKey>98</api:ProductKey>
						<api:ProductName></api:ProductName>
						<api:QualifiedByKey></api:QualifiedByKey>
						<api:QualifiedOn>0001-01-01T00:00:00</api:QualifiedOn>
						<api:RatingKey>2</api:RatingKey>
						<api:SalutationKey>1</api:SalutationKey>
						<api:SalutationName>Mr.</api:SalutationName>
						<api:SecEmail></api:SecEmail>
						<api:SecMobile></api:SecMobile>
						<api:StageID>0</api:StageID>
						<api:StageName>Active</api:StageName>
						<api:State></api:State>
						<api:StatusCode></api:StatusCode>
						<api:StatusCodeDisplayText>New Lead</api:StatusCodeDisplayText>
						<api:StatusCodeInOn>0001-01-01T00:00:00</api:StatusCodeInOn>																				
						<api:StatusCodeKey>166</api:StatusCodeKey>
						<api:StatusCodeName>Document Pending</api:StatusCodeName>
						<api:TeamID>0</api:TeamID>
						<api:TerritoryCode>537</api:TerritoryCode>
						<api:TerritoryKey>954</api:TerritoryKey>
						<api:Title></api:Title>
						<api:WebsiteUrl></api:WebsiteUrl>
						<api:ZipCode>208001</api:ZipCode>
					</api:CRMnextObject>
				</api:objects>	
				<api:returnObjectOnSave>true</api:returnObjectOnSave>
      </api:Save>
   </soapenv:Body>
</soapenv:Envelope>';


$url ='https://crmesb.fullertonindia.com:9082/magicxpi4_1/MGrqispi.dll?appname=IFSCRMNext&prgname=HTTP&arguments=-ACRM%23Service';
	$soapClient = new nusoap_client("fullerton_crmservice.wsdl", true);   

	$soapClient->setEndpoint($url);

	$info = $soapClient->call("Save", $xmlstr);
	//echo "<pre>";print_r($soapClient);
	print_r($info);

}

?>