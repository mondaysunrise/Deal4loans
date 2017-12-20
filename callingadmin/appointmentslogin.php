<?php
require_once("includes/application-topappt.php");

if($_SESSION['Email']!=""){
	$rUrl = SITE_URL."dashboard1.php";
	$objAdmin->redirectURL($rUrl);
	}
$IP_Remote = getenv("REMOTE_ADDR");
if($IP_Remote=='192.99.32.74' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}
echo $IP;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//echo $IP; die;
	$Uname = 'apptadmin@deal4loans.com';
	$Password = 'Admin#appt#2017';
		
	if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="182.71.109.218"  || $IP=="122.176.54.194"  || $IP=="223.179.7.22" || $IP=="113.193.239.185" || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="122.176.77.239" || $IP=="::1" || ($getIPNum>0)))
			{
				
	$admincallerName = fun_db_output($_POST['callerName']); 
	$adminUname = fun_db_output($_POST['Email']);
	$adminPass = fun_db_output($_POST['PWD']);
	if($adminUname!=$Uname)
		{
			redirectURL(SITE_URL."appointmentslogin.php?msg=".urlencode("Please enter correct username!"));
		}
	if($adminPass!=$Password)
		{
			redirectURL(SITE_URL."appointmentslogin.php?msg=".urlencode("Your password does not match with our record. Please enter correct password!"));
		}
		
	if($adminUname and $adminPass){
			$_SESSION['Email'] = $_POST['Email'];
			$_SESSION['PWD'] = $_POST['PWD'];
			redirectURL(SITE_URL."dashboard1.php");
		
			}
	else{
			redirectURL(SITE_URL."appointmentslogin.php?msg=".urlencode("Invalid username or password!"));
		}
	
	die;
}else{
	redirectURL(SITE_URL."appointmentslogin.php?msg=".urlencode("Not permission for you!"));
	}
}
//echo "Test";
//die();
?>
<?php include "includes/header_appt.php";?>
    <div id="payment_container">
      <div class="wel_paymentsText">Welcome to  <?php echo SITE_NAME; ?> . Please Register with your appropriate details. </div>
      <div class="paymentsText_form">
        <div class="top_part"><img src="<?php echo SITE_IMAGES;?>log_img.jpg" align="absbottom"/></div>
        <div class="mid_part">
          <div class="contentBox">
            <div class="field_text">Please fill the folllowing fields:</div>
            <?php
	if(isset($_GET['msg'])){
?>
            <div class="msg_error"><img src="./images/error.png" align="absmiddle"/> <?php echo urldecode($_GET['msg'])?> </div>
            <?php
}
?>
            <form name="adminLoginFrm" method="post" action="" onSubmit="return validateLoginFrm(event);">
              <div class="row">
                <label>Username :</label>
                <input class="tex_fm" type="text" name="Email" onfocus="if(this.value=='Username')this.value=''" onblur="if(this.value=='')this.value='Username'" value="Username"/>
              </div>
              <div class="row">
                <label>Password :</label>
                <input class="tex_fm" type="password" name="PWD" onfocus="if(this.value=='Password')this.value=''" onblur="if(this.value=='')this.value='Password'" value="Password"/>
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
        <div class="bottom_part"><img src="<?php echo SITE_IMAGES;?>payment-form-bottom-bg.jpg" /></div>
      </div>
    </div>
</body>
</html>