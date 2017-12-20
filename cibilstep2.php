<?php
session_start();

$clientName = $_POST['clientName'];
$allowInput = $_POST['allowInput'];
$allowEdit = $_POST['allowEdit'];
$allowCaptcha = $_POST['allowCaptcha'];
$allowConsent = $_POST['allowConsent'];
$allowConsent_additional = $_POST['allowConsent_additional'];
$allowEmailVerify = $_POST['allowEmailVerify'];
$allowVoucher = $_POST['allowVoucher'];
$voucherCode = $_POST['voucherCode'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$surName = $_POST['surName'];
$dateOfBirth = $_POST['dateOfBirth'];
$gender = $_POST['gender'];
$mobileNo = $_POST['mobileNo'];
$telephoneNo = $_POST['telephoneNo'];
$telephoneType = $_POST['telephoneType'];
$email = $_POST['email'];
$flatno = $_POST['flatno'];
$buildingName = $_POST['buildingName'];
$road = $_POST['road'];
$city = $_POST['city'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
$pan = $_POST['pan'];
$reason = $_POST['reason'];

$param["clientName"] = $clientName;
$param["allowInput"] = $allowInput;
$param["allowEdit"] = $allowEdit;
$param["allowCaptcha"] = $allowCaptcha;
$param["allowConsent"] = $allowConsent;
$param["allowConsent_additional"] = $allowConsent_additional;
$param["allowEmailVerify"] = $allowEmailVerify;
$param["allowVoucher"] = $allowVoucher;
$param["voucherCode"] = $voucherCode; //2nd Code
$param["firstName"] = $firstName;
$param["middleName"] = $middleName;
$param["surName"] = $surName;
$param["surName"] = $surName;
$param["gender"] = $gender;
$param["mobileNo"] = $mobileNo;
$param["telephoneNo"] = $telephoneNo;
$param["telephoneType"] = $telephoneType;
$param["email"] = $email;
$param["flatno"] = $flatno;
$param["buildingName"] = $buildingName;
$param["road"] = $road;
$param["city"] = $city;
$param["state"] = $state;
$param["pincode"] = $pincode;
$param["pan"] = $pan;
//$param["passport"] = $passport;
//$param["aadhaar"] = $aadhaar;
//$param["voterid"] = $voterid;
//$param["driverlicense"] = $driverlicense;
//$param["rationcard"] = $rationcard;
$param["reason"] = $reason;


$request = '';
foreach($param as $key=>$val) { $request.= $key."=".urlencode($val); $request.= "&"; }
$request = substr($request, 0, strlen($request)-1);

echo "<br>///////////////////Request Array//////////////////////////////<br>";
print("<pre>");
print_r($param);
echo "<br><br>";

$strCookie = "sessionId=".session_id()."; path=".session_save_path();
//8444,8445
//$url = 'https://cbv2cpu.uat.experian.in:8445/ECV-P2/content/landingPageSubmit.action';
//$url = 'https://cbv2cpu.uat.experian.in:8445/ECV-P2/content/singleAction.action?clientName=Upendra Kumar';
$url = 'https://cbv2cpu.uat.experian.in:16443/ECV-P2/content/singleAction.action';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_PROXY, $url); //your proxy url
//curl_setopt($ch, CURLOPT_PROXYPORT, "8445"); // your proxy port number
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded','Content-Length:'. strlen($request)));
curl_setopt($ch, CURLOPT_TIMEOUT, 180);//Time in seconds
curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
//curl_setopt($ch, CURLOPT_GETFIELDS, $request);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
$result = curl_exec($ch);
print_r($result);
echo "<br>";
echo 'curl error: ('.curl_errno($ch).')'. curl_error($ch);		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Step 1</title>
</head>
<body>

<form name="submitForm" action="cibilstep1_submit.php" method="post">
    <table>
    <tr><td>Client Name</td><td>
    	<input type="text" name="clientName" value="<?php echo $clientName; ?>" readonly="readonly"></td></tr>
   
    <tr><td>allowInput</td><td>    	<input type="text" name="allowInput" value="<?php echo $allowInput; ?>"  readonly="readonly">
</td></tr>
    <tr><td>allowEdit</td><td>    	<input type="text" name="allowEdit" value="<?php echo $allowEdit; ?>" readonly="readonly">
</td></tr>
    <tr><td>allowCaptcha </td><td>    	<input type="text" name="allowCaptcha" value="<?php echo $allowCaptcha; ?>" readonly="readonly">
</td></tr>
    <tr><td>allowConsent </td><td>    	<input type="text" name="allowConsent" value="<?php echo $allowConsent; ?>" readonly="readonly">
</td></tr>
    <tr><td>allowConsent_additional </td><td>    	<input type="text" name="allowConsent_additional" value="<?php echo $allowConsent_additional; ?>" readonly="readonly">
</td></tr>
    <tr><td>allowEmailVerify </td><td>    	<input type="text" name="allowEmailVerify" value="<?php echo $allowEmailVerify; ?>" readonly="readonly">
</td></tr>
    <tr><td>allowVoucher </td><td>    	<input type="text" name="allowVoucher" value="<?php echo $allowVoucher; ?>" readonly="readonly">
</td></tr>
    <tr><td>voucherCode </td><td>    	<input type="text" name="voucherCode" value="<?php echo $voucherCode; ?>" readonly="readonly">
</td></tr>
    <tr><td>firstName </td><td>    	<input type="text" name="firstName" value="<?php echo $firstName; ?>">
</td></tr>
    <tr><td>middleName </td><td>    	<input type="text" name="middleName" value="<?php echo $middleName; ?>">
</td></tr>
    <tr><td>surName </td><td>    	<input type="text" name="surName" value="<?php echo $surName; ?>">
</td></tr>
    <tr><td>dateOfBirth </td><td>    	<input type="text" name="dateOfBirth" value="<?php echo $dateOfBirth; ?>">
</td></tr>
    <tr><td>gender </td><td>    	<input type="text" name="gender" value="<?php echo $gender; ?>">
</td></tr>
    <tr><td>mobileNo </td><td>    	<input type="text" name="mobileNo" value="<?php echo $mobileNo; ?>">
</td></tr>
    <tr><td>telephoneNo </td><td>    	<input type="text" name="telephoneNo" value="<?php echo $telephoneNo; ?>">
</td></tr>
    <tr><td>telephoneType </td><td>    	<input type="text" name="telephoneType" value="<?php echo $telephoneType; ?>">
</td></tr>
    <tr><td>email </td><td>    	<input type="text" name="email" value="<?php echo $email; ?>">
</td></tr>
    <tr><td>flatno </td><td>    	<input type="text" name="flatno" value="<?php echo $flatno; ?>">
</td></tr>
    <tr><td>buildingName </td><td>    	<input type="text" name="buildingName" value="<?php echo $buildingName; ?>">
</td></tr>
    <tr><td>road </td><td>    	<input type="text" name="road" value="<?php echo $road; ?>">
</td></tr>
    <tr><td>city </td><td>    	<input type="text" name="city" value="<?php echo $city; ?>">
</td></tr>
    <tr><td>state </td><td>    	<input type="text" name="state" value="<?php echo $state; ?>">
</td></tr>
    <tr><td>pincode </td><td>    	<input type="text" name="pincode" value="<?php echo $pincode; ?>">
</td></tr>
    <tr><td>pancard </td><td>    	<input type="text" name="pan" value="<?php echo $pan; ?>">
</td></tr>
    <tr><td>reason </td><td>    	<input type="hidden" name="passport" value=" ">
  	<input type="hidden" name="aadhaar" value=" ">
   	<input type="hidden" name="voterid" value=" ">
  	<input type="hidden" name="driverlicense" value=" ">
	<input type="hidden" name="rationcard" value=" ">
 	<input type="text" name="reason" value="<?php echo $reason; ?>">
    </td></tr>
    <tr><td><input type="submit" name="submit" value="Submit" /></td><td></td></tr></table>
    </form>
</body>
</html>    