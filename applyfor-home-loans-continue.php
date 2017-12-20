 <?php  
 require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_POST);
//exit();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		 $Name = FixString($_POST['Name2']);
		 $Phone= FixString($_POST['Phone2']);
		$source = FixString($_POST['source2']);
		$IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}
		
if((strlen($Name)>0) && strlen($Phone)>2)
	{
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Home Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";

	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());

	if($alreadyExist>0)
	{

		$ProductValue=$myrow['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
	/*	echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";*/
		$message = "Thanks you for sharing your mobile number with us. <br>You are already registered with us.	";
	}
	else
	{
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Employment_Status'=>'1', 'City'=>'', 'City_Other'=>'', 'Mobile_Number'=>$Phone, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Net_Salary'=>'360000');
		$ProductValue = Maininsertfunc ("Req_Loan_Home", $dataInsert);
		$message = "Thank you for applying  for Home Loan through deal4loans. Your application is under process. We will contact you shortly.";
	}
		
		}
}


?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="homeloan-landing-page.css" type="text/css" rel="stylesheet"  />
 <script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link rel="stylesheet" href="css/hl-tab-styles.css">
</head>
<body>
<div class="main_container">
<div class="logo"><img src="images/d4l-logo-new-home-loan.png" width="152" height="65" /></div>
<div class="second_container_box">
<div class="form_box" >
<? echo $message; ?>
</div>
<div class="right_box">
<div class="row_a">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="35" align="center" class="text_c">Sample Home Loan Quotes</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="12%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">Bank</td>
          <td width="19%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">Interest Rate</td>
          <td width="28%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">Eligible Loan Amt.</td>
          <td width="23%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">EMI</td>
          <td width="18%" height="28" align="center" bgcolor="#146191" class="table_text" style="border-right:thin solid #FFF;">Document</td>
        </tr>
        <tr>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF; color:#d07f18;"><strong>Bank A</strong></td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">9.95%</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 23,00,000</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 22,119</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF; font-size:10px;">Bank Stat,<br />
            Salary Slip</td>
        </tr>
        <tr>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF; color:#d07f18;"><strong>Bank B</strong></td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">10.20%</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 25,00,000</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 24,457</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text" style="border-right:thin solid #FFF;"><span class="table_text_b" style="border-right:thin solid #FFF; font-size:9px;">Bank Stat,<br />
Salary Slip</span></td>
        </tr>
        <tr class="table_text_b">
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF; color:#d07f18;"><strong>Bank C</strong></td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">10.50%</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 26,00,000</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 25,958</td>
          <td height="28" align="center" bgcolor="#e5eef3" class="table_text" style="border-right:thin solid #FFF;"><span class="table_text_b" style="border-right:thin solid #FFF; font-size:9px;">Bank Stat,<br />
Salary Slip</span></td>
        </tr>
        <tr class="table_text_b">
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text" style="border-right:thin solid #FFF; color:#d07f18;"><strong>Bank D</strong></td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">10.75%</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 27,00,000</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text_b" style="border-right:thin solid #FFF;">Rs. 27,411</td>
          <td height="28" align="center" bgcolor="#FFFFFF" class="table_text" style="border-right:thin solid #FFF;"><span class="table_text_b" style="border-right:thin solid #FFF; font-size:9px;">Bank Stat,<br />
Salary Slip</span></td>
        </tr>
      </table></td>
    </tr>
   
  </table>
  </div>
  <div class="row_a margin_top"><span class="list_text_head">List of top Home Loans Banks in India</span><br />
    <span style="font-size:15px; color:#156dd1;">SBI (State Bank of India),</span> <span style="color:#da251c;">Hdfc Ltd,</span> <span style="color:#1a5b9b;">LIC Housing,</span> <span style="color:#942b25;">ICICI Bank,</span><br />
   <span style="color:#aa2a5d;"> Axis Bank,</span> <span style="color:#1c689a;">Bajaj Finserv,</span> <span style="color:#820606;">PNB Housing Finance</span></div>
   
   <div class="row_a margin_top" style="border:none;"><div class="list_text_head" style="color:#187abe;">Why Deal4loans.com</div>
   <div class="right_box_text">
   <ul>
   <li>Instant EMI &amp; Eligibility offer from 4 nationalized and 5 Private Banks</li>
   <li>Choose best deal for lowest EMI, Best Eligibility</li>
   <li>Home Loan Quotes are free for customers.  It's a totally free service for customers</li>
   <li>Your information will not be shared with anyone without your consent.</li>
   <li>Over <strong style="color:#F60; font-size:24px;"><? echo $total_homeloan_taken; ?></span></strong> customers have taken quote at <strong style="color:#187abe; font-size:15px;">Deal4loans.com</strong></li>
   </ul>
   <span style="text-align:right;">*All loans repayment period are over 6 months. No short term loans</span>
   </div>
   </div>
   
</div>

<div style="clear:both;"></div>
 
</div>
<div class="bottom_box margin_2">
<div class="bottom_left">
  <p ><span class="list_text_head">Helpful tips to Get the Best Home Loan Deal</span> <br />
    Home loans are provided based on the market value, mainly estimation given by banks or the registration value of the property. Home loan is not a one-time decision; do review the market periodically before availing them. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Home loan are 
  </p>
  <p>» Eligibility <br />
    » Interest rates best suited.<br />
    » Fixed interest loans or Floating. <br />
    » Other costs. <br />
    » Document required. <br />
    » Penalties.</p>
</div>
<div class="bottom_right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/animated-offer-img.gif" width="295" height="124" /></td>
  </tr>
  <tr>
    <td height="0" >&nbsp;</td>
  </tr>
  <tr>
    <td height="146" ><table width="286" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="146" valign="top" background="images/testimonial-bg.gif" ><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="text_c" style="color:#FFF;">Testimonials</td>
      </tr>
      <tr>
        <td class="table_text">I was able to understand how much Home loan i can get and what are best options- 
          Thanks-
          <br />
          <br />
          Ravi Sharma<br />
            New Delhi</td>
      </tr>
    </table></td>
  </tr>
  </table>
</td>
  </tr>
<tr><td>
<?php include 'footer_landingpage.php'; ?>
</td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>

</div>

</div>
<?php include "analytics.php"; ?>
</body>
</html>
