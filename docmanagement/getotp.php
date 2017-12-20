<?php
require_once("includes/application-top.php");
function SendSMSforLMS($SMSMessage, $PhoneNumber) {
    $request = ""; //initialize the request variable
    // 6161
    $param["pcode"] = "MICROFINANCIAL";
    $param["acode"] = "MICROFINANCIAL";
    $param["message"] = $SMSMessage; //this is the message that we want to send
    $param["mnumber"] = "91" . $PhoneNumber; //these are the recipients of the message
    $param["pin"] = "mi@1";

    foreach ($param as $key => $val) { //traverse through each member of the param array
        $request.= $key . "=" . urlencode($val); //we have to urlencode the values
        $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
    }
    $request = substr($request, 0, strlen($request) - 1); //remove the final ampersand sign from the request
    //First prepare the info that relates to the connection
    $host = "luna.a2wi.co.in:7501";
    $script = "/failsafe/HttpPublishLink";
    $request_length = strlen($request);
    $method = "POST"; // must be POST if sending multiple messages
    if ($method == "GET") {
        $script .= "?$request";
    }

    //Now comes the header which we are going to post. 
    $header = "$method $script HTTP/1.1\r\n";
    $header .= "Host: $host\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: $request_length\r\n";
    $header .= "Connection: close\r\n\r\n";
    $header .= "$request\r\n";

    //Now we open up the connection
    $socket = @fsockopen($host, 80, $errno, $errstr);
    if ($socket) { //if its open, then...
        fputs($socket, $header); // send the details over
        while (!feof($socket)) {
            $output[] = fgets($socket); //get the results 
        }
        fclose($socket);
    }
    return $output;
}
$adminUname = $_REQUEST['Uname'];
$adminPass = $_REQUEST['pwd'];
$adminInfo = $objAdmin->fun_getAdminUserInfo(0, $adminUname, $adminPass);
$SMSMessage = "One time Password : ".$_REQUEST['otp'];
$Phone = $adminInfo['Mobile_Number'];

if($Phone){
SendSMSforLMS($SMSMessage, $Phone);
}
if(strlen($Phone)>0)
{
?>

<input type="password" width="30px" name="fieldOtp" value="" />
<input type="hidden" width="30px" name="OtpHide" value="<?php echo $_REQUEST['otp']; ?>" />
<div class="submit_btn">
    <input type="submit"  name="submit" class="button" value="SUBMIT"  align="left"  />
</div>
<?php } else {?>

<div>Please fill correct username and password.</div>
<?php } ?>
