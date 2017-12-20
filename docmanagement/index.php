<?php
require_once("includes/application-top.php");
if($_SESSION['Email']!=""){
	$rUrl = SITE_URL."dashboard.php";
	$objAdmin->redirectURL($rUrl);
	}
//$IP_Remote = getenv("REMOTE_ADDR");
//$IP= $_SERVER['HTTP_X_REAL_IP']; 

function ExactCustomerIP()
{
	$IP_Remote= getenv("REMOTE_ADDR");
	if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12' || $IP_Remote=="185.93.231.12" || $IP_Remot=="192.88.134.12")
	{
		$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; 
	}
	else 
	{ 
		$IP= $IP_Remote;	
	}
	return($IP);
}


$IP = ExactCustomerIP();
	echo "<span style=\"color:#FFF\">".$IP."</span>"; //die;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){


	if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.71.109.218"  || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="122.175.43.156" ||  $IP=="185.93.231.12" || $IP=="202.83.19.9" || $IP=="183.83.255.212" || $IP=="122.167.181.176" || $IP=="223.227.56.192" || $IP=="182.68.171.30" || $IP=="1.22.220.149" || $IP=="1.23.216.189" || $IP=="182.71.116.78" || $IP=="122.165.66.245" || $IP=="171.61.245.59" || $IP=="122.176.54.194" || $IP=="113.193.239.185" || $IP=="182.237.170.146" || $IP=="103.29.210.100"  || $IP=="182.74.132.94" || $IP=="49.248.139.82" || $IP=="106.201.66.207" || $IP=="49.207.14.96" || $IP=="42.109.171.65" || $IP=="49.207.58.183" || $IP=="42.109.171.65" || $IP=="122.166.188.123" || $IP=="182.237.150.121" || $IP=="122.176.54.210" || $IP=="122.177.136.237" || $IP=="42.109.200.79" || $IP=="49.207.50.144" || $IP=="223.186.242.127" || $IP=="223.227.105.78" || $IP=="182.74.132.94" || $IP=="192.168.1.5" || $IP=="117.212.70.248" || $IP=="122.167.3.96" || $IP=="122.167.4.186" || $IP=="122.167.7.193" || $IP=="122.167.0.183" || $IP=="122.167.5.76" || $IP=="1.23.116.224" || $IP=="223.186.41.231" || $IP=="103.57.133.45" || $IP=="183.82.208.103" || $IP=="183.82.211.83"  || $IP=="49.204.229.57" || $IP=="49.204.224.79" || $IP=="103.220.208.185" || $IP=="49.204.227.76" || $IP=="103.220.208.91" || $IP=="103.220.208.85" || $IP=="182.74.63.86" || $IP=="183.87.16.197" || $IP=="1.22.91.57" || $IP=="115.187.34.149" || $IP=="122.163.115.100" || $IP=="::1" || ($getIPNum>0))
	{
	$adminUname = fun_db_output($_POST['Email']);
	$adminPass = fun_db_output($_POST['PWD']);	
	
		
	if($objAdmin->fun_verify_admins($adminUname, $adminPass)){
		$adminInfo = $objAdmin->fun_getAdminUserInfo(0, $adminUname, $adminPass);
	//	print_r($adminInfo);
		//die();
		if(sizeof($adminInfo)) {
			if($adminInfo['Status']=="1")
				{
		
		$_SESSION['Email'] = $_POST['Email'];
		$_SESSION['PWD'] = $_POST['PWD'];
		$_SESSION['UserType'] = $adminInfo['UserType'];
		$_SESSION['UID'] = $adminInfo['id'];
		$_SESSION['UserCity'] = $adminInfo['City'];
		$_SESSION['UserCityList'] = $adminInfo['City_List'];
		$_SESSION['Product_pl'] = $adminInfo['Product_pl'];
		$_SESSION['Product_hl'] = $adminInfo['Product_hl'];
		$_SESSION['Product_cl'] = $adminInfo['Product_cl'];
		$_SESSION['Product_lap'] = $adminInfo['Product_lap'];
		$_SESSION['Product_bl'] = $adminInfo['Product_bl'];
		$_SESSION['Product_cc'] = $adminInfo['Product_cc'];
		$_SESSION['agent_ids'] = $adminInfo['agent_ids'];
		$_SESSION['BankID'] = $adminInfo['BankID'];
		
		redirectURL(SITE_URL."dashboard.php");
	}
		}
	else
	{
		redirectURL(SITE_URL."index.php?msg=".urlencode("Invalid username or password!"));
	}
	die;
}else{
	redirectURL(SITE_URL."index.php?msg=".urlencode("Not permission for you!"));
	}
			}
}
?>
<?php include "includes/header.php";?>
    <div id="payment_container">
      <div class="wel_paymentsText">Welcome to  <?php echo SITE_NAME; ?> . Please Register with your appropriate details. Current IP - <?php echo $IP; ?>  </div>
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