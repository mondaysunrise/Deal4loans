<?php 
require 'scripts/db_init.php';


/*****************************************************************/
/**************This is for Approved*******************************/
/*****************************************************************/
/*$jsonurl='{"UserID": "ehj8bmnI+ML6/loUxYHxOQy/bYqCe5depANl4020mVq03TlUM3jt+hsCiQsEF+lPz33zds1tfUXAsqcgHPHT2SAHzZDVdVu/5A9IIYyV30JwRNZRfZM/i7rver3vbMpfM30O7gc577eQZqJvYjg0AfXm959kfUii760L2LAzF6g=",   "Password": "D/3TLsXOYPQyYc6ynjW8hPYycLy/3ucicv4y55s8xRnVOvG3079trwMHKEa5CS1sb6qikGzpV/1Tj/Knr4V5cwrLMkc7iaJ7utKNKg9fgG4d8On8mtlrK34YLbncwNc3ix6AsjOB6bb5oGUn1iYGeBVWXwQd+SLLWJmL0eMz18s=",
"ChannelType":"Deal4loans", 
"ApplicantFirstName":"Karuppaiah", 
"ApplicantMiddleName":"", 
"ApplicantLastName":"Selvaraj", 
"Gender":"male", 
"DateOfBirth":"02/05/1985", 
"ResidenceAddress1":"flat no 83 12 uper gruond floor kh n", 
"ResidenceAddress2":"no 300 2 near monday market ghitorni delhi 110030", 
"ResidenceAddress3":"Filename401.xml", 
"City":"Chennai", 
"ResidencePincode":"600063", 
"ResidenceState":"Tamilnadu", 
"STDCode":"44" ,
"ResidencePhoneNumber":"917672445", 
"ResidenceMobileNo":"9176724455", 
"PanNo":"XXXXX1234A", 
"ICICIBankRelationship":"Norelationship", 
"ICICIRelationshipNumber":"", 
"CustomerProfile":"Selfemployed", 
"CompanyName":"DRAKE & SCULL WATER & ENERGY INDIA PRIVATE LIMITED(PDKRS)", 
"SalaryAccountWithOtherBank":"No", 
"Total_Exp":"10", 
"Income":"250000", 
"SalaryAccountOpened":"12/12/2015"}';*/
//response: {"$id":"1","ApplicationId":"9749023","Decision":"Approved","ErrorMessage":null,"Reason":"Congratulations! You are eligible for an ICICI Bank Credit Card. Our representative will get in touch with you shortly"}
/*****************************************************************/
/**************This is for Referred*******************************/
/*****************************************************************/
/*$jsonurl='{ "UserID": "ehj8bmnI+ML6/loUxYHxOQy/bYqCe5depANl4020mVq03TlUM3jt+hsCiQsEF+lPz33zds1tfUXAsqcgHPHT2SAHzZDVdVu/5A9IIYyV30JwRNZRfZM/i7rver3vbMpfM30O7gc577eQZqJvYjg0AfXm959kfUii760L2LAzF6g=",   "Password": "D/3TLsXOYPQyYc6ynjW8hPYycLy/3ucicv4y55s8xRnVOvG3079trwMHKEa5CS1sb6qikGzpV/1Tj/Knr4V5cwrLMkc7iaJ7utKNKg9fgG4d8On8mtlrK34YLbncwNc3ix6AsjOB6bb5oGUn1iYGeBVWXwQd+SLLWJmL0eMz18s=",
  "ChannelType":"Deal4loans", 
"ApplicantFirstName":"Karuppaiah", 
"ApplicantMiddleName":"", 
"ApplicantLastName":"Selvaraj", 
"Gender":"male", 
"DateOfBirth":"02/05/1985", 
"ResidenceAddress1":"flat no 83 12 uper gruond floor kh n", 
"ResidenceAddress2":"no 300 2 near monday market ghitorni delhi 110030", 
"ResidenceAddress3":"Filename401.xml", 
"City":"New Delhi", 
"ResidencePincode":"110030", 
"ResidenceState":"Delhi", 
"STDCode":"44" ,
"ResidencePhoneNumber":"917672445", 
"ResidenceMobileNo":"9176724455", 
"PanNo":"XXXXX1234A", 
"ICICIBankRelationship":"Salary", 
"ICICIRelationshipNumber":"", 
"CustomerProfile":"Salaried", 
"CompanyName":"DRAKE & SCULL WATER & ENERGY INDIA PRIVATE LIMITED(PDKRS)", 
"SalaryAccountWithOtherBank":"No", 
"Total_Exp":"10", 
"Income":"33190", 
"SalaryAccountOpened":"Below2Months"} ';
*/
//resposne: {"$id":"1","ApplicationId":"9749019","Decision":"Referred","ErrorMessage":null,"Reason":"Thank you for your interest in ICICI Bank Credit Cards. Our representative will get in touch with you within 3 working days subject to your application meeting the eligibility criteria"}

$jsonurl='{"UserID": "Iovzx7wJPArn2TtAlI2N2UAFj0E5rAIixvX3R4Fk/aIZ0XdQocnL1sBoc7eVp1SMBh2v9A1ZMd/5avrCcJsJDRazw1E98D1RNy9DGPmjB7UpwY3NiFTZug3Rs/ewxF4/JUDiZG+b2Da0KN/Pcbg0bwBBh4Q0sRYS6U5V5Sqct38=",   "Password": "YCq8uvU148DHQWaFbojkpv9SA8wBWP01FPOTLVBHCaKGp5JCoDWaEil1kyR33v3eGLQj/BnCsSqTrgjs7efqgpNHGHKrWA1HGVahFua3fVzeenZdcXCQgUqYD5YlZTwjEkr5DnmnGRvgE3e63KWQ3NSUCMskPw0HYcX9N96DyJ0=",
"ChannelType":"Deal4loans", 
"ApplicantFirstName":"CreditCard", 
"ApplicantMiddleName":"Application", 
"ApplicantLastName":"Testing", 
"Gender":"Male", 
"DateOfBirth":"26/07/1990",
"ResidenceAddress1":"No 25 A block", 
"ResidenceAddress2":"Sharang Avenue", 
"ResidenceAddress3":"Filename432.xml", 
"City":"Mumbai", 
"ResidencePincode":"400016", 
"ResidenceState":"MAHARASHTRA", 
"STDCode":"022" ,
"ResidencePhoneNumber":"9633214456", 
"ResidenceMobileNo":"9633214456", 
"PanNo":"BQDPK8549G", 
"ICICIBankRelationship":"Salary", 
"ICICIRelationshipNumber":"123456789ABCD987", 
"CustomerProfile":"Salaried", 
"CompanyName":"3M INDIA LIMITED", 
"SalaryAccountWithOtherBank":"No", 
"Total_Exp":"5", 
"Income":"40000", 
"SalaryAccountOpened":"Above2Months"}';

/*
"UserID": "ehj8bmnI+ML6/loUxYHxOQy/bYqCe5depANl4020mVq03TlUM3jt+hsCiQsEF+lPz33zds1tfUXAsqcgHPHT2SAHzZDVdVu/5A9IIYyV30JwRNZRfZM/i7rver3vbMpfM30O7gc577eQZqJvYjg0AfXm959kfUii760L2LAzF6g=",   "Password": "D/3TLsXOYPQyYc6ynjW8hPYycLy/3ucicv4y55s8xRnVOvG3079trwMHKEa5CS1sb6qikGzpV/1Tj/Knr4V5cwrLMkc7iaJ7utKNKg9fgG4d8On8mtlrK34YLbncwNc3ix6AsjOB6bb5oGUn1iYGeBVWXwQd+SLLWJmL0eMz18s=",
*/
/*****************************************************************/
/**************THIS IS FOR DECLINE*******************************/
/*****************************************************************/
/*$jsonurl='{"UserID": "R+tWwxLyFeiXfnkeu8uvZBmNx51tRpSI97VKKAKmBORBo67tDF8CBQktwkOlvfF9gzKsFyVyg7QFQ3ifz6tQcTCqdgk1jHw5VT/B2FUiOEVkqOV0KnNnAdkU8ulbeMNWRicr1Ff1TIP2JJAivI9I8aRdgtP732MyByl1QqlhK4Q=", 
  "Password": "pRVlIJ6OiEXFCAifnmyWhpFC1deSPg9NwwchvdXtgQGSsD1X5g7VgMh0vVE71HrAB+5EF4A9B+vVfSYHbKiHllZ+ao+vgMnGsbjOk2flKz0o7SJRkBj295rxHjzTBL3zlpGwAuVIx6wIwC5VMgQmvE4PRv1RSuLiyrxi2CnYplw=", 
"ChannelType":"Deal4loans", 
"ApplicantFirstName":"Karuppaiah", 
"ApplicantMiddleName":"", 
"ApplicantLastName":"Selvaraj", 
"Gender":"male", 
"DateOfBirth":"02/05/1985", 
"ResidenceAddress1":"flat no 83 12 uper gruond floor kh n", 
"ResidenceAddress2":"no 300 2 near monday market ghitorni delhi 110030", 
"ResidenceAddress3":"Filename401.xml", 
"City":"New Delhi", 
"ResidencePincode":"110030", 
"ResidenceState":"Delhi", 
"STDCode":"44" ,
"ResidencePhoneNumber":"917672445", 
"ResidenceMobileNo":"9176724455", 
"PanNo":"AAAPA1234A", 
"ICICIBankRelationship":"Salary", 
"ICICIRelationshipNumber":"", 
"CustomerProfile":"Salaried", 
"CompanyName":"DRAKE & SCULL WATER & ENERGY INDIA PRIVATE LIMITED(PDKRS)", 
"SalaryAccountWithOtherBank":"No", 
"Total_Exp":"10", 
"Income":"29999", 
"SalaryAccountOpened":"Above2Months"}';
*/
/*****************************************************************************************************************************/
//Test cases start
/****************************************************************************************************************************/

/*$jsonurl='{"UserID": "ehj8bmnI+ML6/loUxYHxOQy/bYqCe5depANl4020mVq03TlUM3jt+hsCiQsEF+lPz33zds1tfUXAsqcgHPHT2SAHzZDVdVu/5A9IIYyV30JwRNZRfZM/i7rver3vbMpfM30O7gc577eQZqJvYjg0AfXm959kfUii760L2LAzF6g=",   "Password": "D/3TLsXOYPQyYc6ynjW8hPYycLy/3ucicv4y55s8xRnVOvG3079trwMHKEa5CS1sb6qikGzpV/1Tj/Knr4V5cwrLMkc7iaJ7utKNKg9fgG4d8On8mtlrK34YLbncwNc3ix6AsjOB6bb5oGUn1iYGeBVWXwQd+SLLWJmL0eMz18s=",
"ChannelType":"Deal4loans", 
"ApplicantFirstName":"CreditCard", 
"ApplicantMiddleName":"Application", 
"ApplicantLastName":"Testing", 
"Gender":"Male", 
"DateOfBirth":"26/07/1990", 
"ResidenceAddress1":"No 25 A block", 
"ResidenceAddress2":"Sharang Avenue", 
"ResidenceAddress3":"Filename403.xml", 
"City":"Mumbai", 
"ResidencePincode":"400016", 
"ResidenceState":"Maharashtra", 
"STDCode":"44" ,
"ResidencePhoneNumber":"02285236974", 
"ResidenceMobileNo":"9633214456", 
"PanNo":"BQDPK8549G", 
"ICICIBankRelationship":"Saving", 
"ICICIRelationshipNumber":"12098789ABCD9878", 
"CustomerProfile":"Selfemployed", 
"CompanyName":"", 
"SalaryAccountWithOtherBank":"No", 
"Total_Exp":"0", 
"Income":"500000", 
"SalaryAccountOpened":""}';*/
//test case 1 response: {"$id":"1","ApplicationId":"9750392","Decision":"Approved","ErrorMessage":null,"Reason":"Congratulations! You are eligible for an ICICI Bank Credit Card. Our representative will get in touch with you shortly"}
//test case 2 response: {"$id":"1","ApplicationId":"9750397","Decision":"Approved","ErrorMessage":null,"Reason":"Congratulations! You are eligible for an ICICI Bank Credit Card. Our representative will get in touch with you shortly"}
/*****************************************************************************************************************************/
//Test cases End
/****************************************************************************************************************************/
echo $jsonurl;
$url ="https://www.test.transuniondecisioncentre.co.in/DC/TUDCGenericAPI/API/ICICICCEAS/NewApplication/";// UAT
//$url ="https://www.dc.transuniondecisioncentre.co.in/DC/TU.DC.GenericAPI/API/ICICICCEAS/NewApplication/";// Prod
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
$result = curl_exec($ch);

echo "<br><br>For Referred prod: ".$result."<br>";

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

echo $IP;

?>
