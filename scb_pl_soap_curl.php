<?php

$xmlstr='<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:personalLoan">
   <soapenv:Header/>
   <soapenv:Body>
      <urn:personalLoan soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
         <RPRequest xsi:type="urn:RPRequest">
            <!--You may enter the following 2 items in any order-->
            <Authentication xsi:type="urn:Authentication">
               <!--You may enter the following 2 items in any order-->
               <UserId xsi:type="xsd:string">pl_connector_5</UserId>
               <Password xsi:type="xsd:string">pd!8Gq(b49KK#@d4l</Password>
            </Authentication>
            <PersonalLoan xsi:type="urn:PersonalLoan">
               <!--You may enter the following 47 items in any order-->
               <Version xsi:type="xsd:int">3</Version>
               <ConUniqRefCode xsi:type="xsd:string">12345678</ConUniqRefCode>
               <FirstName xsi:type="xsd:string">rajesh</FirstName>
               <MiddleName xsi:type="xsd:string"></MiddleName>
               <LastName xsi:type="xsd:string">kumar</LastName>
               <DOB xsi:type="xsd:string">08-03-1987</DOB>
               <Gender xsi:type="xsd:int">1</Gender>
               <Qualification xsi:type="xsd:int">4</Qualification>
               <PAN xsi:type="xsd:string">BBEPK4332W</PAN>
               <ResType xsi:type="xsd:int">1</ResType>
               <Email xsi:type="xsd:string">rajesh.b@rupeepower.com</Email>
               <ResAddress1 xsi:type="xsd:string">baikdjd</ResAddress1>
               <ResAddress2 xsi:type="xsd:string">fevfev</ResAddress2>
               <Landmark xsi:type="xsd:string">feevefv</Landmark>
               <ResPIN xsi:type="xsd:int">110022</ResPIN>
               <ResCity xsi:type="xsd:int">318</ResCity>
               <ResPhone xsi:type="xsd:int">23443334</ResPhone>
               <Mobile xsi:type="xsd:unsignedLong">9871484846</Mobile>
               <ResAccoType xsi:type="xsd:int">0</ResAccoType>
               <EmpType xsi:type="xsd:int">1</EmpType>
               <Organization xsi:type="xsd:string">Google</Organization>
               <TypeOfOrg xsi:type="xsd:int">5</TypeOfOrg>
               <Profession xsi:type="xsd:int">0</Profession>
               <WorkExp xsi:type="xsd:int">6</WorkExp>
               <Industry xsi:type="xsd:int">45</Industry>
               <MonthsCurrentOrg xsi:type="xsd:int">20</MonthsCurrentOrg>
               <SalaryBank xsi:type="xsd:int">170</SalaryBank>
               <OffAddress1 xsi:type="xsd:string">hejfhne3</OffAddress1>
               <OffAddress2 xsi:type="xsd:string">reerg</OffAddress2>
               <OffPIN xsi:type="xsd:int">110042</OffPIN>
               <OffCity xsi:type="xsd:int">318</OffCity>
               <OffPhone xsi:type="xsd:int">22387832</OffPhone>
               <OffPhoneExtn xsi:type="xsd:int"></OffPhoneExtn>
               <GMI xsi:type="xsd:unsignedLong">200000</GMI>
               <CurrentEMI xsi:type="xsd:unsignedLong"></CurrentEMI>
               <TaxITRCurrYr xsi:type="xsd:unsignedLong"></TaxITRCurrYr>
               <TaxITRPrevYr xsi:type="xsd:unsignedLong"></TaxITRPrevYr>
               <CurrYrGrosTurnOver xsi:type="xsd:unsignedLong"></CurrYrGrosTurnOver>
               <CurrYrBusinessIncome xsi:type="xsd:unsignedLong"></CurrYrBusinessIncome>
               <CurrYrOtherIncome xsi:type="xsd:unsignedLong"></CurrYrOtherIncome>
               <DepreciationPLAcc xsi:type="xsd:unsignedLong"></DepreciationPLAcc>
               <LoanAmount xsi:type="xsd:unsignedLong">2000000</LoanAmount>
               <TenureMonths xsi:type="xsd:int">36</TenureMonths>
               <IRR xsi:type="xsd:decimal">10.15</IRR>
               <ProcFee xsi:type="xsd:int">2003</ProcFee>
               <ExistingRelationship xsi:type="xsd:int">0</ExistingRelationship>
               <IncomeProof xsi:type="xsd:int">1</IncomeProof>
            </PersonalLoan>
         </RPRequest>
      </urn:personalLoan>
   </soapenv:Body>
</soapenv:Envelope>';

$url ='https://apply.standardchartered.co.in/connector/RPPersonalLoanConnector.wsdl?wsdl';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 

print_r($output);
?>