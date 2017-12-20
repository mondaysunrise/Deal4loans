<?php
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name=$_REQUEST['name'];
	$email=$_REQUEST['email'];
	$mobile=$_REQUEST['mobile'];


$emailmessage="<table width='485' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='center' valign='top'><table width='485' border='0' align='center' cellpadding='0' cellspacing='0'>
<tr><td align='left' valign='top' ><font color='#333333' size='1' face='Arial, Helvetica, sans-serif'>You have received this mailer from deal4loans.com because you indicated that you would like to receive special offers. In case you do not wish to receive such communication in future, Please Use this link to <a href='http://pub.deal4loans.com/box.php?funcml=unsub2&amp;nl=currentnl&amp;mi=currentmesg&amp;email=subscriberemail' style='text-decoration:none; '>Unsubscribe</a> from this service.</font></td>
</tr>
<tr><td align='left' valign='top' bgcolor='#9A9A9A'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='1'></td></tr>
<tr><td align='left' valign='top'><table width='485' border='0' cellspacing='0' cellpadding='0'>
<tr align='left' valign='top'><td width='1' bgcolor='#9A9A9A'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='1'></td><td align='center'><table width='483' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='top'><table width='483' border='0' align='center' cellpadding='0' cellspacing='0'>

<tr><td align='left' valign='top'><table width='483' border='0' align='center' cellpadding='0' cellspacing='0'><tr align='left' valign='top'><td width='86'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='50'></td><td width='2'><img src='http://www.deal4loans.com/emailer/ioc-titanium/gray-bit.gif' width='2' height='181'></td><td><table width='228' border='0' align='center' cellpadding='0' cellspacing='0'>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='30'></td></tr><tr><td align='left' valign='top'><font color='#003C7E' size='5' face='Arial, Helvetica, sans-serif'><strong>Save over 5% every <br>time you fill fuel!</strong></font></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='15'></td></tr><tr><td align='left' valign='top'><font color='#0B91DA' size='2' face='Arial, Helvetica, sans-serif'><strong><a href='https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=fuel&site=DEAL4LOANS&creative=BANNER&section=D4LBFBIO&agencyCode=IAPL&campaignCode=CARDSO&productCode=CARDS&eOfferCode=D4LBFBIO' target='_blank'  style='text-decoration:none;'><font color='#FF0000'>Apply now</font></a> for the IndianOil Citibank Titanium Credit Card - <br>The Fastest Way to FREE FUEL!</strong></font></td></tr></table></td>

<td width='137' align='right'><img src='http://www.deal4loans.com/emailer/ioc-titanium/pipe.gif' width='137' height='181'></td></tr></table></td></tr><tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/header.jpg' title='Save over 5% every time you fill fuel!' width='483' height='298'></td></tr></table></td></tr>

<tr><td align='left' valign='top' bgcolor='#F99510'><table width='450' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='top'><strong><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Deal4loans Customer,</font></strong></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='15'></td></tr><tr><td align='left' valign='top'><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>We are pleased to offer you an IndianOil Citibank Titanium Credit Card. Earn Turbo Points every time you spend on the Card and redeem them for free fuel.</font></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='18'></td></tr><tr>

  <td align='left' valign='top'><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'><b><font color='#FF0000'>As a special limited period offer, this card comes to you at no annual card fee!</font></b></font></td>

</tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='18'></td></tr><tr><td align='left' valign='top'><table width='450' border='0' align='center' cellpadding='0' cellspacing='0'><tr align='left' valign='top'><td width='12' align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9'></td><td><strong><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Save 5% everytime you fill fuel at IndianOil Outlets*</font></strong></td></tr>

<tr align='left' valign='top'><td colspan='2'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='3'></td></tr><tr align='left' valign='top'><td><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='18'></td><td><table width='430' border='0' cellspacing='0' cellpadding='0'><tr align='left' valign='top'><td align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9'></td>

<td><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Full waiver of the fuel surcharge (2.5%)</font></td></tr><tr align='left' valign='top'><td colspan='2'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='3'></td></tr><tr align='left' valign='top'><td align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9'></td>

<td><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Earn 4 Turbo Points for every Rs.150 spent</font></td></tr><tr align='left' valign='top'><td colspan='2'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='3'></td></tr></table></td></tr>

<tr align='left' valign='top'><td align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9'></td><td><strong><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Earn 1 Turbo Point for every Rs.150 spent on all other purchases</font></strong></td></tr>

<tr align='left' valign='top'><td colspan='2'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='3'></td></tr><tr align='left' valign='top'><td align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9'></td>

<td><strong><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Redeem each Turbo point for Re.1 of Fuel at IndianOil outlets*</font></strong></td></tr></table></td></tr><tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='15'></td></tr><tr><td align='left' valign='top'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>Other Features</font></strong></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='16'></td></tr><tr><td align='left' valign='top'><table width='450' border='0' align='center' cellpadding='0' cellspacing='0'><tr align='left' valign='top'><td width='12' align='center' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9' vspace='3'></td>

<td><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Enjoy exclusive offers round the year across dining, travel, shopping <br>and entertainment</font></td></tr><tr align='left' valign='top'><td colspan='2'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='3'></td></tr><tr align='left' valign='top'><td align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9'></td>

<td><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Get instant alerts for all card purchases greater than Rs.5000 </font></td></tr><tr align='left' valign='top'><td colspan='2'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='3'></td></tr><tr align='left' valign='top'><td align='center' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9' vspace='3'></td>

<td><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Internet Banking - Access your account from anywhere, get free online 'Bill Payment' facility and much more</font></td></tr></table></td></tr><tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='18'></td></tr><tr><td align='left' valign='top'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>Know Your Savings</font></strong></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='16'></td></tr><tr><td align='left' valign='top'><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>The powerful Turbo Points Program can get you over Rs.1500 of free fuel every year. See the Example:</font></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='8'></td></tr><tr><td align='left' valign='top'><table width='380' border='0' align='left' cellpadding='0' cellspacing='0'><tr><td align='left' valign='top' bgcolor='#858585'><table width='380' border='0' align='center' cellpadding='5' cellspacing='1'><tr align='center' valign='middle' bgcolor='#FBB603'><td><strong><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Value Chart</font></strong></td>

<td width='75'><strong><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Monthly Spends</font></strong></td><td width='71'><strong><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Turbo Points <br>per Rs.150</font></strong></td>

<td width='75'><strong><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Turbo Points Earned</font></strong></td></tr><tr align='left' valign='top' bgcolor='#F99510'><td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>Fuel purchase at IndianOil* outlets</font></strong></td>

<td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>3,000</font></strong></td><td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>4</font></strong></td>

<td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>80</font></strong></td></tr><tr align='left' valign='top' bgcolor='#F99510'><td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>All other purchases</font></strong></td>

<td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>7,000</font></strong></td><td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>1</font></strong></td>

<td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>46</font></strong></td></tr><tr align='left' valign='top' bgcolor='#F99510'><td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>Total monthly purchases</font></strong></td>

<td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>10,000</font></strong></td><td align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='8'></td>

<td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>126</font></strong></td></tr><tr align='left' valign='top' bgcolor='#F99510'><td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>Total annual purchases</font></strong></td>

<td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>1,20,000</font></strong></td><td align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='8'></td>

<td align='center' valign='middle'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>1,520</font></strong></td></tr><tr align='center' valign='top' bgcolor='#F99510'><td colspan='4'><strong><font color='#FF0000' size='2' face='Arial, Helvetica, sans-serif'>Rs.1520 worth of FREE FUEL !!</font></strong></td></tr></table></td></tr></table></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='8'></td></tr><tr><td align='left' valign='top'><font color='#333333' size='1' face='Arial, Helvetica, sans-serif'>Chart used for illustrative purposes only.</font></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='15'></td></tr><tr><td align='left' valign='top'><table width='450' border='0' align='center' cellpadding='0' cellspacing='0'><tr align='center' valign='middle'><td width='89' height='23' align='left'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>So hurry and </font></strong></td>

<td width='78' bgcolor='#FF0000'><a href='https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=fuel&site=DEAL4LOANS&creative=BANNER&section=D4LBFBIO&agencyCode=IAPL&campaignCode=CARDSO&productCode=CARDS&eOfferCode=D4LBFBIO' target='_blank' style='text-decoration:none;'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>Apply now </font></strong></a></td><td width='8' align='left'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='8' height='10'></td>

<td align='left'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>to get the IndianOil Citibank Credit Card</font></strong></td></tr></table></td></tr><tr><td align='left' valign='top'><strong><font color='#FFFFFF' size='2' face='Arial, Helvetica, sans-serif'>and enjoy its many benefits.</font></strong></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='16'></td></tr><tr><td align='left' valign='top'><table width='450' border='0' align='center' cellpadding='0' cellspacing='0'><tr align='left' valign='top'><td width='12' align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9'></td><td><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Complete online application process</font></td></tr>

<tr align='left' valign='top'><td colspan='2' align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='3'></td></tr><tr align='left' valign='top'><td align='center' valign='middle'><img src='http://www.deal4loans.com/emailer/ioc-titanium/dot.gif' width='6' height='9'></td><td><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>No documents required</font></td></tr></table></td></tr><tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='26'></td></tr><tr><td align='left' valign='top'><font color='#333333' size='2' face='Arial, Helvetica, sans-serif'>Warm regards,<br>Citibank, N.A., India</font></td></tr><tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='22'></td></tr></table></td></tr>

<tr><td height='90' align='right' valign='bottom'><table width='483' border='0' align='center' cellpadding='0' cellspacing='0'><tr align='left' valign='bottom'><td><img src='http://www.deal4loans.com/emailer/ioc-titanium/indianoil-logo.gif' title='IndianOil' width='123' height='44'></td><td align='right'><img src='http://www.deal4loans.com/emailer/ioc-titanium/citi-logo.gif' title='Citi never sleeps' width='126' height='72'></td></tr></table></td></tr></table></td><td width='1' bgcolor='#9A9A9A'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='1'></td></tr></table></td></tr>

<tr><td align='left' valign='top' bgcolor='#9A9A9A'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='1'></td></tr></table></td></tr><tr><td align='center' valign='top'><table width='483' border='0' align='center' cellpadding='0' cellspacing='0'>

<tr><td align='left' valign='middle'><div align='justify'><font color='B3B3B3' size='1' face='Arial, Helvetica, sans-serif'>CITIBANK is a registered service mark of Citibank, N.A. CITI NEVER SLEEPS is a service mark of Citigroup Inc. </font></div></td></tr><tr><td align='left' valign='middle'><font color='B3B3B3' size='1' face='Arial, Helvetica, sans-serif'>*Terms & Conditions:</font></td></tr><tr><td align='left' valign='top'><font color='B3B3B3' size='1' face='Arial, Helvetica, sans-serif'>1.Offer valid till 15th March 2010.</font></td></tr><tr><td align='left' valign='top'><font color='B3B3B3' size='1' face='Arial, Helvetica, sans-serif'>2.The Cash Back will be credited to your card account within 90 days of card booking</font></td></tr><tr><td align='left' valign='top'><font color='B3B3B3' size='1' face='Arial, Helvetica, sans-serif'>3.The card member needs to spend at least Rs 1000 cumulatively (i.e. customer can combine more than one transaction) in the first 30 days of card issuance to be eligible for the Cash Back.</font></td></tr><tr><td align='left' valign='top'><font color='B3B3B3' size='1' face='Arial, Helvetica, sans-serif'>4.The Terms and Conditions shall be governed by the Laws of India.</font></td></tr>

<tr><td align='left' valign='top'><a href='http://www.online.citibank.co.in/portal/newgen/cards/nw_BC.pdf' target='_blank'  style='text-decoration:none;'><font color='#FF0000' size='1' face='Arial, Helvetica, sans-serif'>Click here</font></a><font color='#B3B3B3' size='1' face='Arial, Helvetica, sans-serif'> to view the Most Important Terms and Conditions of this card.</font></td></tr>

<tr><td align='left' valign='top'> <div align='justify'><font color='#B3B3B3' size='1' face='Arial, Helvetica, sans-serif'>*On a Citibank EDC only</font></div></td></tr><tr><td align='left' valign='top'> <div align='justify'><font color='B3B3B3' size='1' face='Arial, Helvetica, sans-serif'>Issuance of the Credit Card is at the sole discretion of the bank and is subject to the bank's approval criteria. </font></div></td></tr>

<tr><td align='left' valign='top'> <div align='justify'><font color='B3B3B3' size='1' face='Arial, Helvetica, sans-serif'>Please do not reply to this mail as it is a computer generated mail. For further information, please follow the instructions mentioned above.</font></div></td></tr>

<tr><td align='left' valign='top'><img src='http://www.deal4loans.com/emailer/ioc-titanium/spacer.gif' width='1' height='12'></td></tr></table></td></tr></table>";
	$subject="Compare - Apply Credit Cards in 2 Minutes";

//<kotakmahindracards@gmail.com>
$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'Bcc: extra4testing@gmail.com' . "\r\n";
	
	if(strlen($email)>0 && strlen($name)>0)
	mail($email,$subject, $emailmessage, $headers);

//echo  $emailmessage;
	$mobmessage="To apply for a Credit Card, Please visit our site : www.deal4loans.com";

if(strlen(trim($mobile)) > 0)
	{
SendSMS($mobmessage, $mobile);
}

}


	?>

	<html>
<head></head>
<body><div align="center">
<form name="getmailer" method="post" action="">
<div align="center" style="font-family:verdana; font-size:11px; "><b>fill details</b></div>
<font style="font-family:verdana; font-size:11px; ">Name <input type="text" name="name" id="name"></font><br><br>
<font style="font-family:verdana; font-size:11px; ">Email <input type="text" name="email" id="email"></font><br><br>
<font style="font-family:verdana; font-size:11px; ">mobile <input type="text" name="mobile" id="mobile"></font><br><br>
<input type="submit" name="submit" id="submit" value="submit">
</form>
</div>
</body>
	</html>