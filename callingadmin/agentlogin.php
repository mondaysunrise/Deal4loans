<?php
require_once("includes/application-top.php");
//Not in use
print_r($_POST);
if($_SESSION['Email']!=""){
	$rUrl = SITE_URL."agentdashboard.php";
	$objAdmin->redirectURL($rUrl);
	}
     
$IP_Remote = getenv("REMOTE_ADDR");
if($IP_Remote=='192.99.32.74' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}
echo "ddd".$IP;
 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	echo "i m here";
	//echo $IP; die;
	$Uname = 'agent@deal4loans.com';
	$Password = 'agent@123';
	
	if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="182.71.109.218" || $IP=="122.176.54.210" || $IP=="182.71.109.218" || $IP=="122.176.77.239" || $IP=="::1" || ($getIPNum>0)))
			{
				echo "dddu";
	$admincallerName = fun_db_output($_POST['callerName']); 
	echo $adminUname = fun_db_output($_POST['Email']);
	echo $adminPass = fun_db_output($_POST['PWD']);
	if($adminUname!=$Uname)
		{
			redirectURL(SITE_URL."agentlogin.php?msg=".urlencode("Please enter correct username!"));
		}
	if($adminPass!=$Password)
		{
			redirectURL(SITE_URL."agentlogin.php?msg=".urlencode("Your password does not match with our record. Please enter correct password!"));
		}
		
	if($adminUname and $adminPass){
		$_SESSION['Email'] = $_POST['Email'];
		$_SESSION['PWD'] = $_POST['PWD'];
		$_SESSION['leadidentifier'] = 'agentdashboard';
		redirectURL(SITE_URL."agentlogin.php");
	}
	else{
			redirectURL(SITE_URL."agentlogin.php?msg=".urlencode("Invalid username or password!"));
		}
	
	die;
}else{
	redirectURL(SITE_URL."agentlogin.php?msg=".urlencode("Not permission for you!"));
	}
}
?>
<?php include "includes/header.php";?>
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
            <form name="adminLoginFrm" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateLoginFrm(event);">
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