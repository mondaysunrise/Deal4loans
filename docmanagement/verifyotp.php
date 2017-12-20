<?php
require_once("includes/application-top.php");
$TOken = base64_decode($_REQUEST['token']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($TOken == $_REQUEST['verifyotp']) {
        redirectURL(SITE_URL . "dashboard.php");
    } else {

        session_destroy();
        redirectURL(SITE_URL . "index1.php?msg=OTP is not match with our Record");
    }
}
?>
<?php include "includes/header.php"; ?>
<div id="payment_container">

    <div class="paymentsText_form">
        <div class="top_part" style="border: 1px solid #CCC;"></div>
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
                        <label>Verify OTP :</label>
                        <input class="tex_fm" type="password" name="verifyotp" />
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