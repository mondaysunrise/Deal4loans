<?php
//
//"source":"Deal4Loans",	
//"password":"Deal4Loans@123",

// NO special chacters allowed in name column

$pljsonurl='{	
"source":"deal4loans",	
"password":"deal4loans@123",
"iPAddress":"122.176.122.134",
"imeiNo":"",
"functionName":"createPLApplication",
"requestType":"P",
"creLoginId":"511498",
"webtopNo":"",
"customerType":"I",
"lname":"MB  TIWARI", 
"fname":"SARASWATI DEVI",
"mname":"",
"dob":"30/08/1957",
"idType":"07",
"idValue":"AAFPT3878B",
"applicantType":"P",
"title":"01",
"gender":"M",
"relationshipFirstName":"F",
"maritalStatus":"M",
"motherMaidenName":"geeta",
"relationship":"F",
"customerCategory":"0103",
"cifNumber":"",
"prevMonthSalary":"55000",
"currMonthIncome":"55000",
"nextMonthSalary":"55000",
"obligationMonth":"2000",
"modeOfSalary":"D",
"includeFinancial":"Y",
"includeIncomeFlag":"Y",
"resAddress1":"E 1/319 SATIRAM PARK NAJABGARH ROAD",
"resAddress2":"NANGLOI",
"resAddress3":"DELHI",
"resAddress4":"DELHI",
"resEmailId":"saraswati1@gmail.com",
"resMobNo":"9811856026",
"sageProduct":"Personal Loans",
"resCity":"DELHI",
"resPincode":"110041",
"resState":"DELHI",
"losCity":"110",
"losState":"84",
"residenceOwnedBy":"S",
"noOfYearsInCity":"3",
"yrsCurrentResidence":"11",
"permAddr1":"OFF SAKI VIHAR ROAD CHANDIVALI ",
"permAddr2":"FARM. DELHI DELHI",
"permAddr3":"DELHI",
"permPincode":"110041",
"losPermCity":"110",
"losPermState":"84",
"companyName":"Infosys SERVICES PVT LTD",
"yrsInCurrentEmp":"5",
"employmentType":"SAL",
"employerType":"MNC",
"totWorkExp":"3",
"industry":"04",
"applicantOccupation":"",
"empAddressLine1":"Seepz",
"empAddressLine2":"Andheri East",
"empAddressLine3":"DELHI",
"empCity":"110",
"empProvince":"84",
"employerCode":"0000000000000119",
"empCountry":"IN",
"empPostalCode":"110041",
"officeEmailId":"",
"companyCategory":"SUPER CAT A TOP",
"bankName":"KOTAKMAHINDRA",
"noOfChequeBounced":"0",
"mainBankingReq":"Y",
"pdcEcsReq":"Y",
"accountType":"SV",
"inwardBounce":"0",
"noOfMonths":"1",
"isCoApplicantPL":"NO",
"productCode":"7301-0406",
"loanType":"PL",
"loanTerm":"36",
"financeType":"001",
"financingCompany":"003",
"loanScheme":"SAL",
"sourceFromForLos":"PL Online",
"loanAmount":"420000",
"usage":"101",
"losBranchCode":"",
"loanSubType":"PL",
"channelPc":"1000",
"distributionChannelPc":"001",
"loanPriority":"02",
"oppId":"",
"emi":"15396.0",
"incomeCategory":"002",
"processingFee":"8000.0",
"cseCode":"",
"cseName":"",
"relationshipManager":"",
"relationshipManagerName":"",
"dsaCode":"",
"dsaName":"",
"interestRate":"19",
"subCategory":"0101",
"softApproval":"04",
"sagechannel":"deal4loans",
"leadType":"Individual",
"leadTag":"WarmLead",
"leadStage":"NewLead",
"oppStage":"New"
}';

$url ="http://convergeuat.tatacapital.com/APIFramework/APIServices/createPLApplication.htm";
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $pljsonurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
$result = curl_exec($ch);

print_R($result);

echo $result;
?>