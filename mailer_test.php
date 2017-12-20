<?php

$referrer_name = "Upendra Kumar";
$name = "Kunal";
$mobile = "9971396361";
$reference_id = "HL1520074REF5";
$insertID = 4;




$Loan_AmountArr = array('Upto 25 Lakhs','25 – 50 Lakhs','50 -100 lakhs','1 – 2 Cr', 'More than 2 Cr');
		$GiftsArr = array('Watch and Sunglasses','Trolley Bag','Smart Phone','Tablet', 'Laptop');
echo "<br>****************************************************************<br>";	
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
echo "When The customer is referred<br>";
echo "This mail will be send to Referrer - <br>";
echo 	"Subject - ".$Subjectreferrer."<br><br>".$mailertoreferrer;
		
	$mailertocustomer = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#d5d5d5 solid thin; max-width:600px;"><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7"><table width="97%" border="0" align="center" cellpadding="00" cellspacing="0"><tr><td>&nbsp;</td></tr><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><p><strong>Dear {{CUSTOMER_NAME}},</strong></p><p><strong>Greetings!!</strong></p></td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">We have received your reference from <strong>{{REFERRER_NAME}}</strong> for <strong>your Home loan requirement</strong>. <br /> <br /></td></tr><tr><td><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Let us know your requirement.</span></td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Ask for a call back by clicking on the below and our team of <strong>Home loan experts</strong> will call you to take you one step closer to your dream of owning a Home. </td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><img src="http://www.deal4loans.com/emailer/images/checkbox-mailer.jpg"  />  I authorize Deal4loans.com and its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">partnering banks</a> to contact me to explain the product and I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank"  style="color:#000; text-align:center;  font-family:Arial, Helvetica, sans-serif;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">Terms and Conditions</a>.</td></tr><tr><td>&nbsp;</td></tr><tr><td><a href="http://www.deal4loans.com/refer-for-home-loan-validate.php?id={{ID}}" target="_blank" style="color:#FFF; text-align:center; text-decoration:none; font-family:Arial, Helvetica, sans-serif;"><table width="150" border="0"><tr><td height="30" align="center" bgcolor="#1074E3" style="color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Call me</td></tr></table></a></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong>Warm Regards</strong><br />Home loan Team <br />Deal4loans <br /></td><td align="right"><img src="http://www.deal4loans.com/emailer/images/d4l-pl-logo.png" width="91" height="34" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>';
		$mailertocustomer =  str_replace("{{REFERRER_NAME}}", $referrer_name, $mailertocustomer);
		$mailertocustomer =  str_replace("{{CUSTOMER_NAME}}", $name, $mailertocustomer);
		$mailertocustomer =  str_replace("{{ID}}", $insertID, $mailertocustomer);
		$Subjectcustomer= 'we have got to know about your Home loan requirement ';

echo "<br><br>When The customer is referred<br>";
echo "This mail will be send to Customer - <br>";
echo 	"Subject - ".$Subjectcustomer."<br><br>".$mailertocustomer ;

echo "<br>****************************************************************<br>";

	$template2referrer_1 = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#d5d5d5 solid thin; max-width:600px;"><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7"><table width="95%" border="0" align="center" cellpadding="00" cellspacing="0"><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><p><strong>Dear {{REFERRER_NAME}}</strong></p></td></tr><tr><td height="5"></td></tr><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Concerning your reference no. <strong>{{CUSTOMER_REF}}</strong>, for the reference shared under our Home loan reference program.</td></tr><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><p><br />We have tried reaching <strong>{{CUSTOMER_NAME}}</strong> over email to take his consent to call. However not received any response. </p><p>Please intimate your referee to respond the email so the process can be initiated at the earliest. </p></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong>Warm Regards</strong><br />Home loan Team <br />Deal4loans <br /></td><td align="right"><img src="http://www.deal4loans.com/emailer/images/d4l-pl-logo.png" width="91" height="34" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>'; // To Referrer
	$template2referrer_1=  str_replace("{{REFERRER_NAME}}", $referrer_name, $template2referrer_1);
	$template2referrer_1=  str_replace("{{CUSTOMER_REF}}", $reference_id, $template2referrer_1);
	$template2referrer_1=  str_replace("{{CUSTOMER_NAME}}", $name, $template2referrer_1);
	$Subjecttemplate2referrer_1 = "Deal4loans Home loan reference program, your reference no. ".$reference_id;
echo "1st Day <br>";
echo "This mail will be send to Referrer - <br>";
echo 	"Subject - ".$Subjecttemplate2referrer_1."<br><br>".$template2referrer_1;
	

	$template2customer_1 = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#d5d5d5 solid thin; max-width:600px;"><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7"><table width="97%" border="0" align="center" cellpadding="00" cellspacing="0"><tr><td>&nbsp;</td></tr><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><p><strong>Dear {{CUSTOMER_NAME}}</strong></p><p><strong>Greetings!!</strong> We did not hear from you. </p></td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">We have received your reference from <strong>{{REFERRER_NAME}}</strong> for your <strong>Home loan requirement.</strong></td></tr><tr><td>&nbsp;</td></tr><tr><td><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Let us know your requirement.</span></td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Ask for a call back by clicking on the below and our team of <strong>Home loan experts</strong> will call you to take you one step closer to your dream of owning a Home.</td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><img src="http://www.deal4loans.com/emailer/images/checkbox-mailer.jpg"  />  I authorize Deal4loans.com and its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">partnering banks</a> to contact me to explain the product and I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">Terms and Conditions</a>.</td></tr><tr><td>&nbsp;</td></tr><tr><td><a href="http://www.deal4loans.com/refer-for-home-loan-validate.php?id={{ID}}" target="_blank" style="color:#FFF; text-align:center; text-decoration:none; font-family:Arial, Helvetica, sans-serif;"><table width="150" border="0"><tr><td height="30" align="center" bgcolor="#1074E3" style="color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Call me</td></tr></table></a></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong>Warm Regards</strong><br />Home loan Team <br />Deal4loans <br /></td><td align="right"><img src="http://www.deal4loans.com/emailer/images/d4l-pl-logo.png" width="91" height="34" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>';//To Customer

$template2customer_1=  str_replace("{{REFERRER_NAME}}", $referrer_name, $template2customer_1);
	$template2customer_1=  str_replace("{{ID}}", $insertID, $template2customer_1);
	$template2customer_1=  str_replace("{{CUSTOMER_NAME}}", $name, $template2customer_1);

	$Subjecttemplate2customer_1 = "we have got to know about your Home loan requirement";
	

echo "<br><br>1st Day<br>";
echo "This mail will be send to Customer - <br>";
echo 	"Subject - ".$Subjecttemplate2customer_1."<br><br>".$template2customer_1;
	
	
	
echo "<br>****************************************************************<br>";





$template2referrer_2 = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#d5d5d5 solid thin; max-width:600px;"><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7"><table width="95%" border="0" align="center" cellpadding="00" cellspacing="0"><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><p><strong>Dear {{REFERRER_NAME}}</strong></p></td></tr><tr><td height="5"></td></tr><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Concerning your reference no. <strong>{{CUSTOMER_REF}}</strong>, for the reference shared under our Home loan reference program.</td></tr><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><p><br /><strong>{{CUSTOMER_NAME}}</strong>, your reference has still not responded over mail. As per the policy, under no response on multiple attempts, the request for reference will nullify in next 24 hours. <br /><br />If we still do not receive a response from your reference, this reward program will stand inapplicable for you. </p></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong>Warm Regards</strong><br />Home loan Team <br />Deal4loans <br /></td><td align="right"><img src="http://www.deal4loans.com/emailer/images/d4l-pl-logo.png" width="91" height="34" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>';// To Referrer

$template2referrer_2=  str_replace("{{REFERRER_NAME}}", $referrer_name, $template2referrer_2);
	$template2referrer_2=  str_replace("{{CUSTOMER_REF}}", $reference_id, $template2referrer_2);
	$template2referrer_2=  str_replace("{{CUSTOMER_NAME}}", $name, $template2referrer_2);

	$Subjecttemplate2referrer_2 = "Deal4loans Home loan reference program, you reference no. ".$reference_id;
	

echo "2nd Day <br>";
echo "This mail will be send to Referrer - <br>";
echo 	"Subject - ".$Subjecttemplate2referrer_2."<br><br>".$template2referrer_2;


$template2customer_2 = '<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#d5d5d5 solid thin; max-width:600px;"><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7">&nbsp;</td></tr><tr><td bgcolor="#f7f7f7"><table width="97%" border="0" align="center" cellpadding="00" cellspacing="0"><tr><td>&nbsp;</td></tr><tr><td style="color:#000000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><p><strong>Dear {{CUSTOMER_NAME}}</strong></p><p><strong>Greetings!!</strong></p></td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Unfortunately, we did not hear from you for your Home Loan requirement. We have received your reference from <strong>{{REFERRER_NAME}}</strong>.</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">Ask for a call back by clicking on the below and our team of Home loan experts will call you to take you one step closer to your dream of owning a Home. </td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><img src="http://www.deal4loans.com/emailer/images/checkbox-mailer.jpg"  />  I authorize Deal4loans.com and its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">partnering banks</a> to contact me to explain the product and I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank"  style="color:#000; text-align:center; font-family:Arial, Helvetica, sans-serif;">Terms and Conditions</a>.</td></tr><tr><td>&nbsp;</td></tr><tr><td align="left"><a href="http://www.deal4loans.com/refer-for-home-loan-validate.php?id={{ID}}" target="_blank" style="color:#FFF; font-family:Arial, Helvetica, sans-serif;"><table width="150" border="0"><tr><td height="30" align="center" bgcolor="#1074E3" style="color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Call me</td></tr></table></a></td></tr><tr><td>&nbsp;</td></tr><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;">For any requirement arising in Future for Home loan, you can apply with the below details and request will directly reach us. </td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:15px;"><strong>Warm Regards</strong><br />Home loan Team <br />Deal4loans <br /></td><td align="right"><img src="http://www.deal4loans.com/emailer/images/d4l-pl-logo.png" width="91" height="34" /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>';//To Customer

$template2customer_2=  str_replace("{{REFERRER_NAME}}", $referrer_name, $template2customer_2);
	$template2customer_2=  str_replace("{{ID}}", $insertID, $template2customer_2);
	$template2customer_2=  str_replace("{{CUSTOMER_NAME}}", $name, $template2customer_2);

	$Subjecttemplate2customer_2 = "we have got to know about your Home loan requirement";

echo "<br><br>2st Day<br>";
echo "This mail will be send to Customer - <br>";
echo 	"Subject - ".$Subjecttemplate2customer_2."<br><br>".$template2customer_2;


echo "<br>****************************************************************<br>";


?>