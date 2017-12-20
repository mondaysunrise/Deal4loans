<?php
ob_start( 'ob_gzhandler' );
require 'scripts/functions.php';
require 'scripts/db_init.php';
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan referral reward program</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<meta name="keywords" content="" />
<meta name="Description" content="" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/hl-referral-reward-program-styles.css" type="text/css" rel="stylesheet"  />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="hl-ref-main-wrapper">
<p class="hl-reft-main-third-head">
<?php
//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

foreach($_POST as $a=>$b)
		$$a=$b;
	
	$referrer_name= ucfirst(strtolower(FixString($r_name)));
	$referrer_email= FixString($r_email);
	$name= ucfirst(strtolower(FixString($name)));
	$mobile = FixString($mobile);
	$email = FixString($email);
	$city = FixString($city);
	$referrer_id = FixString($referrer_id);
	$accept = FixString($accept);
	$Dated = ExactServerdate();
	$IP_Remote = $_SERVER["REMOTE_ADDR"];
	$alternate_number = FixString($alternate_number);
	
	
	if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
	else { $IP= $IP_Remote;	}

//HL<RefCustID>REF<RequestID>

	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";

	$getdetails="select referrer_id, id from hl_referral_leads where ( mobile not in (9971396361,9811215138,9999047207,9891118553,9999570210,9555060388,9311773341) and mobile='".$mobile."' and created_date between '".$days30datetime."' and '".$currentdatetime."') order by id DESC";
	//echo $getdetails."<br>";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	//print_r($myrow);
	if($alreadyExist>0)
	{
		$i=0;
		$referrer_id= $myrow['referrer_id'];
		$insertID= $myrow['id'];
		
		$reference_id = "HL".$referrer_id."REF".$insertID;
		$message = 'We are already having this reference. <br>Your Reference ID - '.$reference_id;
	//	echo "<br>IF<br>";
	}					
	else
	{
	//	echo "<br>ELSE<br>";
		if(strlen($alternate_number)>3)
		{
			ExecQuery("update Req_Loan_Home set alternate_number='".$alternate_number."' where RequestID='".$referrer_id."'");
		}

		$dataInsert = array("name"=>$name, "mobile"=>$mobile, "email"=>$email,  "city"=>$city,  "created_date"=>$Dated, "modified_date"=>$Dated, "referrer_id"=>$referrer_id);
		//print_r($dataInsert);
		$table = 'hl_referral_leads';
		$insertID = Maininsertfunc ($table, $dataInsert);	
		
		$reference_id = "HL".$referrer_id."REF".$insertID;
		$DataArray = array("reference_id"=>$reference_id);
		$wherecondition ="id='".$insertID."'";
		Mainupdatefunc ($table, $DataArray, $wherecondition);
		$Loan_AmountArr = array('Upto 25 Lakhs','25 – 50 Lakhs','50 -100 lakhs','1 – 2 Cr', 'More than 2 Cr');
		$GiftsArr = array('Watch and Sunglasses','Trolley Bag','Smart Phone','Tablet', 'Laptop');
		$mailertoreferrer = '';
		$mailertoreferrer .= '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#d5d5d5 solid thin; max-width:600px;"><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7"><table width="95%" border="0" align="center" cellpadding="00" cellspacing="0"><tr><td>&nbsp;</td></tr><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><p><strong>Dear {{REFERRER_NAME}}</strong></p><p>Thank you for being a valued customer for deal4loans.<br />We have successfully received the reference details of the Home loan customer referred by you </p></td></tr><tr><td>&nbsp;</td></tr><tr><td style="font-size:17px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Details as below: </td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellpadding="5" cellspacing="0" style="border:#d5d5d5 solid thin;"><tr><td width="35%" height="25" bgcolor="#FFFFFF" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Name</td><td width="2%" height="25" bgcolor="#FFFFFF" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">:</td><td width="63%" height="25" bgcolor="#FFFFFF" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">{{CUSTOMER_NAME}}</td></tr><tr><td height="25" bgcolor="#FFFFFF" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Mobile Number</td><td height="25" bgcolor="#FFFFFF" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">:</td><td height="25" bgcolor="#FFFFFF" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">{{CUSTOMER_MOBILE}}</td></tr></table></td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Your unique reference number under our Home loan referral program is<br /><strong>{{CUSTOMER_REF}}</strong>. This reference number will ensure smooth tracking of your <br />references in our system and timely distribution of your due rewards.<br /></td></tr><tr><td>&nbsp;</td></tr><tr><td style="font-size:17px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Referral Program Offer:<br /></td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellpadding="5" cellspacing="0" style="border:#d5d5d5 solid thin;"><tr><td width="50%" height="30" align="center" bgcolor="#ededed" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px; border-right:#d5d5d5 solid thin;"><strong>Loan Amount</strong></td><td width="50%" height="30" align="center" bgcolor="#ededed" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong>Gift</strong></td></tr>';
		
		for($ii=0;$ii<count($GiftsArr);$ii++)
		{
			$mailertoreferrer .= '	<tr><td height="25" align="center" bgcolor="#FFFFFF" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px; border-top:#d5d5d5 solid thin; border-right:#d5d5d5 solid thin;">'.$Loan_AmountArr[$ii].'</td><td height="25" align="center" bgcolor="#FFFFFF" style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px; border-top:#d5d5d5 solid thin;">'.$GiftsArr[$ii].'</td></tr>';
		}
		$mailertoreferrer .= '</table></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">As an acknowledgment shared by you, you have obtained due consent from your friends/relatives referred to share his/her contact details with Deal4Loans and that Deal4Loans may contact them to offer its Home Loan services after acknowledging the term and conditions of the referral program for home loan.	</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong>Warm Regards</strong><br />Home loan Team <br />Deal4loans <br /></td><td align="right"><img src="http://www.deal4loans.com/emailer/images/d4l-pl-logo.png" width="91" height="34" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>';
		
		$mailertoreferrer =  str_replace("{{REFERRER_NAME}}", $referrer_name, $mailertoreferrer);
		$mailertoreferrer =  str_replace("{{CUSTOMER_NAME}}", $name, $mailertoreferrer);
		$mailertoreferrer =  str_replace("{{CUSTOMER_MOBILE}}", $mobile, $mailertoreferrer);
		$mailertoreferrer =  str_replace("{{CUSTOMER_REF}}", $reference_id, $mailertoreferrer);
		$Subjectreferrer = 'welcome to deal4loans Home loan reference Reward program';
	
		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" ."Content-Type: multipart/mixed;\n" ." boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
	    $message_referrer = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" .    "Content-Transfer-Encoding: 7bit\n\n" .$mailertoreferrer . "\n\n";
	    mail($referrer_email, $Subjectreferrer , $message_referrer, $headers);
		//echo 	$mailertoreferrer."<br>";

		
		
		$mailertocustomer = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#d5d5d5 solid thin; max-width:600px;"><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7"><table width="97%" border="0" align="center" cellpadding="00" cellspacing="0"><tr><td>&nbsp;</td></tr><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><p><strong>Dear {{CUSTOMER_NAME}},</strong></p><p><strong>Greetings!!</strong></p></td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">We have received your reference from <strong>{{REFERRER_NAME}}</strong> for <strong>your Home loan requirement</strong>. <br /> <br /></td></tr><tr><td><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Let us know your requirement.</span></td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Ask for a call back by clicking on the below and our team of <strong>Home loan experts</strong> will call you to take you one step closer to your dream of owning a Home. </td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><img src="http://www.deal4loans.com/emailer/images/checkbox-mailer.jpg"  />  I authorize Deal4loans.com and its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">partnering banks</a> to contact me to explain the product and I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank"  style="color:#000; text-align:center;  font-family:Arial, Helvetica, sans-serif;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">Terms and Conditions</a>.</td></tr><tr><td>&nbsp;</td></tr><tr><td><a href="http://www.deal4loans.com/refer-for-home-loan-validate.php?id={{ID}}" target="_blank" style="color:#FFF; text-align:center; text-decoration:none; font-family:Arial, Helvetica, sans-serif;"><table width="150" border="0"><tr><td height="30" align="center" bgcolor="#1074E3" style="color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Call me</td></tr></table></a></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong>Warm Regards</strong><br />Home loan Team <br />Deal4loans <br /></td><td align="right"><img src="http://www.deal4loans.com/emailer/images/d4l-pl-logo.png" width="91" height="34" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>';
		
		$mailertocustomer =  str_replace("{{REFERRER_NAME}}", $referrer_name, $mailertocustomer);
		$mailertocustomer =  str_replace("{{CUSTOMER_NAME}}", $name, $mailertocustomer);
		$mailertocustomer =  str_replace("{{ID}}", $insertID, $mailertocustomer);
		$Subjectcustomer= 'we have got to know about your Home loan requirement ';

		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" ."Content-Type: multipart/mixed;\n" ." boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
	    $message_customer = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" .    "Content-Transfer-Encoding: 7bit\n\n" .$mailertocustomer . "\n\n";
	    mail($email, $Subjectcustomer , $message_customer , $headers);
		//echo 	$mailertocustomer ."<br>";
		
		$message = 'THanks for giving reference we will soon process the application. <br>Your Reference IS ID - '.$reference_id;
	
	}
}

?>

<?php echo $message ;


?></p>
<div style="clear:both;"></div>

<div class="hl-ref-col-50-left">
<!--<h3>Details Required</h3>-->
<p class="customer-heading">&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>
<div class="hl-ref-col-50-right"><!--<h3>Details Required</h3>-->
<p class="customer-heading">&nbsp;</p>
<p>&nbsp;<div id="nameRVal"></div></p>
<p>&nbsp;<div id="phoneRVal"></div></p>
<p>&nbsp;<div id="emailRVal"></div></p>
<p>

&nbsp;<div id="cityRVal"></div>   
</p>
</div>
<div style="clear:both; height:0px;"></div>
	<div id="acceptRVal"></div>
<p>&nbsp;</p>
</div>
<div style="clear:both;"></div>
<?php //include "responsive_footer.php"; ?>
</div>
<div class="hide_top_menu">
  <?php 
#include "footer_pl.php";
include("footer_sub_menu.php");
?>
</div>
</body>
</html>