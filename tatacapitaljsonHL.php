<?php

$jsonurl='{	
"source":"deal4loans",	
"password":"deal4loans@123",	
"fname":"Harshita", 	
"mname":"", 	
"lname":"Jain", 	
"title":"Ms.", 	
"resEmailId":"harshita@deal4loans.com", 	
"gender":"female", 	
"dob":"1/10/1980", 	
"resMobNo":"9899868555", 	
"resLandlineNo":"", 	
"resAddress1":"zxc", 	
"resAddress2":"asd", 	
"resAddress3":"qwe", 	
"resCity":"Delhi", 	
"resPincode":"",	
"resState":"Delhi", 	
"companyName":"MMPL", 	
"designation":"Relationship Manager", 	
"officeEmailId":"", 	
"officeMobNo":"", 	
"leadDetails":"", 	
"salesOrg":"NSO", 	
"sageProduct":"Home Loan", 	
"sagechannel":"Deal4Loans", 	
"leadType":"Individual", 	
"leadTag":"WarmLead", 	
"sageBranch":"", 	
"loanAmount":"0", 	
"campaignId":"", 	
"tenure":"", 	
"motherMaidenName":"", 	
"maritalStatus":"", 	
"semCampaignName":"", 	
"semSource":"", 	
"semSiteId":"", 	
"semHeadLine":"", 	
"semCreativeId":"", 	
"semKeyword":"", 	
"pan":"", 	
"gclId":"", 	
"referralName":"", 	
"referralDob":"", 	
"referralMob":"", 	
"referralContractNo":"", 	
"referralEmpId":"", 	
"leadStage":"NewLead", 	
"companyCategory":"", 	
"monthlySalary":"", 	
"rejectionReason":"", 	
"sanctionedAmount":" "	
}';

$url ="http://convergeuat.tatacapital.com/APIFramework/APIServices/createLead.htm";
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
$result = curl_exec($ch);
//$headers= array('Accept: application/json','Content-Type: application/json'); 

echo $result."<br>";

?>