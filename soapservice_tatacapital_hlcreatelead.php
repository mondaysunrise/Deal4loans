<?php

//URL:	http://convergeuat.tatacapital.com/APIFramework/APIServices/createLead.htm


-$hljsonurl='{
"source":"deal4loans",	
"password":"deal4loans@123",	
"fname":"Harshita", 	
"mname":"p", 	
"lname":"jain", 	
"title":"Ms.", 	
"resEmailId":"harshita@gmail.com", 	
"gender":"female", 	
"dob":"1/10/1980", 	
"resMobNo":"9899686555", 	
"resLandlineNo":"", 	
"resAddress1":"acb", 	
"resAddress2":"wsx", 	
"resAddress3":"edc", 	
"resCity":"Delhi", 	
"resPincode":"",	
"resState":"DELHI", 	
"companyName":"MMPL", 	
"designation":"RM", 	
"officeEmailId":"", 	
"officeMobNo":"", 	
"leadDetails":"", 	
"salesOrg":"NSO", 	
"sageProduct":"Home Loan", 	
"sagechannel":"deal4loans", 	
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

$url ="http://convergeuat.tatacapital.com/APIFramework/APIServices/createLead.htm";//UAT
//$url ="https://converge.tatacapital.com/APIFramework/APIServices/createLead.htm";//PROD
	// cURL's initialization
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $hljsonurl);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
	$result = curl_exec($ch);

	echo $result;
	echo "<br><br>";
print_R($result);
?>