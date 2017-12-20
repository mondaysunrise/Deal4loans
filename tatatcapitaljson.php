<?php

$jsonurl='{	
"source":"Deal4Loans",	
"password":"Deal4Loans@123",	
"fname":"test", 	
"mname":"", 	
"lname":"lead", 	
"title":"", 	
"resEmailId":"test3@test.com", 	
"gender":"", 	
"dob":"05/10/1980", 	
"resMobNo":"9873678917", 	
"resLandlineNo":"", 	
"resAddress1":"e-32", 	
"resAddress2":"Sector8", 	
"resAddress3":"n", 	
"resCity":"Navi Mumbai", 	
"resPincode":"400613",	
"resState":"", 	
"companyName":"TCS", 	
"designation":"", 	
"officeEmailId":"", 	
"officeMobNo":"", 	
"leadDetails":"", 	
"salesOrg":"NSO", 	
"sageProduct":"Personal Loans", 	
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

echo $jsonurl;
//$url ="http://convergeuat.tatacapital.com/APIFramework/APIServices/createLead.htm";
$url ="https://converge.tatacapital.com/APIFramework/APIServices/createLead.htm";
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
$result = curl_exec($ch);
//$headers= array('Accept: application/json','Content-Type: application/json'); 
//{"leadId":"1580313","LogTxnID":"6241","RetStatus":"SUCCESS","ErrorMessage":null}

echo $result."<br>";

$jsonarr= var_dump(json_decode($result, true));
//print_r($jsonarr);

echo $comment_section = str_replace('{', ' ', str_replace('"', ' ',$result));

echo  $str = implode(",",$jsonarr);

?>