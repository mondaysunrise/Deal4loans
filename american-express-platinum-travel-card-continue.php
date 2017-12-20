<?php
include "scripts/db_init.php";
include "scripts/functions.php";

//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Net_Salary = $_POST['Net_Salary'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$Employment_Status = $_POST['Employment_Status'];
	$Company_Name = $_POST['Company_Name'];
	$nature_business = $_POST['nature_business'];
	$stat_location = $_POST['stat_location'];
	$current_experience = $_POST['current_experience'];
	$office_phone_std = $_POST['office_phone_std'];
	$office_phone = $_POST['office_phone'];
	$office_address = $_POST['office_address'];
	$gender = $_POST['gender'];
	$address_home = $_POST['address_home'];
	$address_pincode = $_POST['address_pincode'];
	$own_car = $_POST['own_car'];
	$car_manufacturer = $_POST['car_manufacturer'];
	$car_model = $_POST['car_model'];
	$Pancard = $_POST['Pancard'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$DOB = $year."-".$month."-".$day;
	$CC_Holder = $_POST['CC_Holder'];
	$cc_company = $_POST['cc_company'];
	$loan_any = $_POST['loan_any'];
	$IP = getenv("REMOTE_ADDR");
	$Activate = generateNumber(4);
	$Reference_Code = generateNumber(4);
	
	$appID = date('dmy')."".$Activate;
	$encryptP = md5($Phone);
	$getsel="select Phone From cc_american_express Where Phone=".$Phone." and Phone not in ('9811555306', '9971396361', '9811215138', '9999047207', '9891601984', '9999570210')";
	list($getselrecordcount,$myrow)=MainselectfuncNew($getsel,$array = array());
	if($getselrecordcount>0)
	{
		$alreadyExists = 1;
	}
	else
	{
		$alreadyExists = 0;
		$Card_Name = 'American Express Platinum Travel card';
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Phone'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Email'=>$Email, 'City'=>$City, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'nature_business'=>$nature_business, 'stat_location'=>$stat_location, 'current_experience'=>$current_experience, 'office_phone_std'=>$office_phone_std, 'office_phone'=>$office_phone, 'office_address'=>$office_address, 'gender'=>$gender, 'address_home'=>$address_home, 'address_pincode'=>$address_pincode, 'own_car'=>$own_car, 'car_manufacturer'=>$car_manufacturer, 'car_model'=>$car_model, 'Pancard'=>$Pancard, 'DOB'=>$DOB, 'CC_Holder'=>$CC_Holder, 'cc_company'=>$cc_company, 'loan_any'=>$loan_any, 'Dated'=>$Dated, 'source'=>'aecc-mailer', 'email_verified'=>'0', 'status'=>'0', 'IP'=>$IP, 'appID'=>$appID, 'email_verification_code'=>$encryptP, 'Reference_Code'=>$Reference_Code, 'Is_Valid'=>$Is_Valid, 'Card_Name'=>$Card_Name);


		$lastInsertedvalue = Maininsertfunc ('cc_american_express', $data);
				//	echo "<br>";
		//echo $insertSQl;
//		echo "<br>";
		if(($City=="Bahadurgarh" || $City=="Bangalore" || $City=="Chennai" || $City=="Delhi" || $City=="Faridabad" || $City=="Gaziabad" || $City=="Greater Noida" || $City=="Gurgaon" || $City=="Hyderabad" || $City=="Kolkata" || $City=="Mumbai" || $City=="Navi Mumbai" || $City=="Noida" || $City=="Pune" || $City=="Thane") && $CC_Holder==1 && (($Employment_Status==1 && ($Net_Salary>=800000)) || ($Employment_Status==0 && ($Net_Salary>=650000))))
		{
			$verifiedLead = 1;
				$dataUpdate = array('status'=>'1', 'Is_Valid'=>'1');
			$wherecondition = "(RequestID=".$lastInsertedvalue.")";
			Mainupdatefunc ('cc_american_express', $dataUpdate, $wherecondition);
		//	echo $crdSql;
			//echo "<br>";
				$SMSMessage = "Please use this code: ".$Reference_Code." to activate your card request at deal4loans.com";
			if(strlen(trim($Phone)) > 0)
			{ //SendSMSforLMS($SMSMessage, $Phone); 
			}
			
			$Message2 = "<table width='660' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='660' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='660' height='101' /></td></tr><tr><td><table width='660' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td><td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Dear $Name</b>,<br />Thanks for applying for American Express Credit Card through Deal4loans.com. Kindly verify your email address by clicking the link below. This will confirm your credit card application for American Express Platinum Reserve Credit Card.<br /><br /><a href='http://www.deal4loans.com/ccev.php?id=".$lastInsertedvalue."'>http://www.deal4loans.com/ccev.php?vfy=".$Reference_Code."&id=".$lastInsertedvalue."</a></td></tr><tr><td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; width:300px;'><br /></td></tr><tr>  <td width='307' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>&nbsp;</td><td width='243' align='right' valign='top'>&nbsp;</td></tr><tr><td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Regards</b> <br />Team Deal4loans.com<br />Loans by choice not by chance!!<br /><div style='text-align:center;'></div></td><td width='1'></td></tr></table></td><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td></tr></table></td></tr><tr><td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='660' height='20' /></td></tr></table>";
			$headers = "From: deal4loans <no-reply@deal4loans.com>";
			$semi_rand = md5( time() ); 
        	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
	        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
		    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
             $Message2 . "\n\n";
		$SubjectLine = "Email Verification on Deal4loans.com";
				mail($Email, $SubjectLine, $message, $headers);
	
		}
	}
}
header("Location: american-express-platinum-travel-card-thanks.php");
exit();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>American Express Platinum Travel card </title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="american-express-lp-first-stage-styles.css" type="text/css" rel="stylesheet" />
 <script type="text/javascript" src="scripts/common.js"></script>
 <script language="javascript">
function validateFrm ()
{
	if(document.validate.activation_code.value=="")
	{
		alert("Please fill the activation code.");
		document.validate.activation_code.focus();
		return false;
	}

	if(document.validate.activation_code.value!="")
	{
		if(document.validate.activation_code.value!=<?php echo $Reference_Code; ?>)
		{
			alert("Please fill the correct activation code.");
			document.validate.activation_code.focus();
			return false;
		}
	}

}

</script>
</head>
<body>
<form action="american-express-platinum-travel-card-thanks.php" method="post" name="validate" onSubmit="return validateFrm();">
<div class="amx-second" style="height:560px;">
<div class="logo_d4l"><img src="images/d4l_amx_logo.jpg" width="164" height="63"></div>
<div class="logo_amx"><img src="images/amx_d4l_logo.jpg" width="276" height="52"></div>
<div style="clear:both; height:15px;"></div>
<div class="left_panel"><div class="left_inner_text_bx" style="margin-top:10px; vertical-align:top; height:300px; text-align:left;">Thank You for applying for Credit Card.
<br><br>
<?php if($verifiedLead==1)
{
?>
Please verify your mobile number  <br />We have sent an activation code on <? echo $Phone; ?><br>
<br>
 <input type="hidden" name="RequestID" id="RequestID" value="<?php echo $lastInsertedvalue; ?>">
		   <input type="hidden" name="Reference_Code" id="Reference_Code" value="<?php echo $Reference_Code; ?>">
        <input type="text" name="activation_code" id="activation_code" onChange="intOnly(this);" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);"  maxlength="4"  /><input type="submit" name="val" value="Activate Mobile" style="width:134px; background-color: #D02037; color:#FFFFFF; font-weight:700; height:25px;" />
<br><br>
Confirm your email address<br>
<span style="font-weight:normal; font-size:13px;">A confirmation email has been sent to <strong><?php echo $Email; ?></strong>. <br>Click on the confirmation link in the email to complete your application</span>
<?php } ?>
 



</div>
<div style="clear:both;"></div>
<div style="clear:both;"></div>
</div>
<div class="rightbox form_text" id="professionalContent">The Annual Membership Fee for the American Express Platinum Travel Credit Card is Rs 5000* plus service tax.
<div class="bullet_text">
<ul>
<li>Welcome Gift1 of 5,000 Milestone Bonus Membership Rewards Points redeemable for IndiGo Vouchers worth Rs. 4000</li>
<li>
  Spend Rs.1.90 lacs in a year and get IndiGo Vouchers worth more than Rs.8000</li>
</ul>
</div>
<div class="crdit_card_box" style="margin-top:2px;"> <img src="images/american-express-platinum-travel-card.png" width="156" height="109"></div>
<div class="form_text" style="font-size:10px;">Please refer to the Most Important <a href="https://americanexpressindia.co.in/terms/platinumR.pdf">Terms & Conditions</a> along with this application for details on the fee and other charges on the Card.</div>
</div>
<div style="clear:both;"></div>
</div>
</form>
</body>
</html>
