<?php
//openCustomerDetailsFormAction
session_start();
//$sessionid = session_id();
echo $sessionid."<br>";
$param["clientName"] = "DEAL_4_LOANS";
$param["allowInput"] = "1";
$param["allowEdit"] = "1";
$param["allowCaptcha"] = "1";
$param["allowConsent"] = "1";
$param["allowConsent_additional"] = "1";
$param["allowEmailVerify"] = "1";
$param["allowVoucher"] = "0";
$param["voucherCode"] = "D4LNZMGJH"; //2nd Code
$param["firstName"] = "Upendra";
$param["middleName"] = "";
$param["surName"] = "Kumar";
$param["dateOfBirth"] = "09-JUN-1978";
$param["gender"] = "1";
$param["mobileNo"] = "9971396361";
$param["telephoneNo"] = "1202657896";
$param["telephoneType"] = "02";
$param["email"] = "askupendra@gmail.com";
$param["flatno"] = "C 36 First Floor";
$param["buildingName"] = "Parshavnath Paradise Mohan Nagar";
$param["road"] = "Ghaziabad";
$param["city"] = "Ghaziabad";
$param["state"] = "09";
$param["pincode"] = "201007";
$param["pan"] = "ATDPK2777Q";
$param["passport"] = "";
$param["aadhaar"] = "";
$param["voterid"] = "";
$param["driverlicense"] = "";
$param["rationcard"] = "";
$param["reason"] = "Find out my credit score";
//$param["hitId"] = 2751;
//$param["reasonreason"] = "Find out my credit score";
//$param["hitId"] = "2751"; UPEN09JUN1108
print("<pre>");
//print_r($param);
//echo "<br><br>";

$request = '';
foreach($param as $key=>$val) //traverse through each member of the param array
{ 
  $request.= $key."=".urlencode($val); //we have to urlencode the values
  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
}
//$request = rawurldecode(substr($request, 0, strlen($request)-1)); //remove the final ampersand sign from the request

$request = substr($request, 0, strlen($request)-1);

//8444,8445
$url = 'https://cbv2cpu.uat.experian.in:16443/ECV/content/landingPageSubmit.action';

// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
//curl_setopt($ch, CURLOPT_GETFIELDS, $request);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
$result = curl_exec($ch);
$info = curl_getinfo($ch);

echo "<br><br>Curl Request<br><br>";
print_r($info);
echo "<br><br>/////////////////<br>Response<br>";
print_r($result);
curl_close($ch);

echo "<br>///////////////////Request Array//////////////////////////////<br>";
print("<pre>");
print_r($param);
echo "<br><br>";
?>