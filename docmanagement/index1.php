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

$IP_Remote = getenv("REMOTE_ADDR");
if ($IP_Remote == '192.99.32.74' || $IP_Remote == '185.93.228.12') {
    $IP = $_SERVER['HTTP_X_REAL_IP'];
} else {
    $IP = $IP_Remote;
}

$queryIp = "SELECT * FROM " . TABLE_Z_VALIDATE_IP_ADDRESS . " WHERE ip_address='" . $IP . "'";
$result = $obj->fun_db_query($queryIp);
$rowsCon = $obj->fun_db_fetch_rs_object($result);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //echo $IP; die;
    $adminUname = fun_db_output($_POST['Email']);
    $adminPass = fun_db_output($_POST['PWD']);
    if ($rowsCon->ip_address) {



        if ($objAdmin->fun_verify_admins($adminUname, $adminPass)) {
            $adminInfo = $objAdmin->fun_getAdminUserInfo(0, $adminUname, $adminPass);
            //	print_r($adminInfo);
            //die();
            if (sizeof($adminInfo)) {
                if ($adminInfo['Status'] == "1") {

                    $_SESSION['Email'] = $_POST['Email'];
                    $_SESSION['PWD'] = $_POST['PWD'];
                    $_SESSION['UserType'] = $adminInfo['UserType'];
                    $_SESSION['UID'] = $adminInfo['id'];
                    $_SESSION['UserCity'] = $adminInfo['City'];

                    $_SESSION['Product_pl'] = $adminInfo['Product_pl'];
                    $_SESSION['Product_hl'] = $adminInfo['Product_hl'];
                    $_SESSION['Product_cl'] = $adminInfo['Product_cl'];
                    $_SESSION['Product_lap'] = $adminInfo['Product_lap'];
                    $_SESSION['Product_bl'] = $adminInfo['Product_bl'];
                    $_SESSION['Product_cc'] = $adminInfo['Product_cc'];

                    redirectURL(SITE_URL . "dashboard.php");
                }
            } else {
                redirectURL(SITE_URL . "index1.php?msg=" . urlencode("Invalid username or password!"));
            }
            die;
        } else {
            redirectURL(SITE_URL . "index1.php?msg=" . urlencode("Not permission for you!"));
        }
    } else {
        $_SESSION['Email'] = $_POST['Email'];
        $_SESSION['PWD'] = $_POST['PWD'];
        $GenRand = rand(1000, 9999);
        $UserNameEmail = $_SESSION['Email'];
        $UserPWD = $_SESSION['PWD'];
        $UserInfo = $objAdmin->fun_getAdminUserInfo(0, $UserNameEmail, $UserPWD);
        $SMSMessage = "One time Password : " . $GenRand;
        $Phone = $UserInfo['Mobile_Number'];

        if (!$objAdmin->fun_verify_admins($adminUname, $adminPass)) {
            redirectURL(SITE_URL . "index1.php?msg=" . urlencode("Invalid username or password!"));
        } else {
            SendSMSforLMS($SMSMessage, $Phone);
            redirectURL(SITE_URL . "verifyotp.php?token=" . base64_encode($GenRand));
        }
    }
}
?>
<?php include "includes/header.php"; ?>
<div id="payment_container">
    <div class="wel_paymentsText">Welcome to  <?php echo SITE_NAME; ?> . Please Register with your appropriate details. </div>
    <div class="paymentsText_form">
        <div class="top_part"><img src="<?php echo SITE_IMAGES; ?>log_img.jpg" align="absbottom"/></div>
        <div class="mid_part">
            <div class="contentBox">
                <div class="field_text">Please fill the following fields:</div>
                <?php
                if (isset($_GET['msg'])) {
                    ?>
                    <div class="msg_error"><img src="./images/error.png" align="absmiddle"/> <?php echo urldecode($_GET['msg']) ?> </div>
                    <?php
                }
                ?>
                <form name="adminLoginFrm" method="post" action="" onSubmit="return validateLoginFrm(event);">
                    <div class="row">
                        <label>Username :</label>
                        <input class="tex_fm" type="text" name="Email" onfocus="if (this.value == 'Username')
                                    this.value = ''" onblur="if (this.value == '')
                                                this.value = 'Username'" value="Username"/>
                    </div>
                    <div class="row">
                        <label>Password :</label>
                        <input class="tex_fm" type="password" name="PWD" onfocus="if (this.value == 'Password')
                                    this.value = ''" onblur="if (this.value == '')
                                                this.value = 'Password'" value="Password"/>
                    </div>
                    <div class="row">
                        <div class="forgor_text"><!--<a href="forgot_password.php">Forgot Password?</a> or <a href="registration.php">Click here to register</a>--></div>
                        <div class="submit_btn">
                            <input type="submit"  name="submit" class="button" value="SUBMIT"  align="left"  />

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="bottom_part"><img src="<?php echo SITE_IMAGES; ?>payment-form-bottom-bg.jpg" /></div>
    </div>
</div>
</body>
</html>