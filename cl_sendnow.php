<?php
require 'scripts/db_init.php';

$CustomerID = 181400;

$arrbiddrbid = array('1825','3887');
$ExpBidderName = array('HDFC Bank','ICICI Bank');



$Message="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  full_name,</b></p> 
Thank you for choosing Deal4loans.com, we are pleased to inform you that your registration for Car Loan has been successful. By giving a consent on application form and over a tele call you have authorized below mentioned banks/agents to call you on <$mobile_no> even if your number is registered with DNC or DND. <br /><br />
In case you do not want to receive calls from any one or more of the following banks then you can cancel the request by clicking on the cancel button within a duration of 15 minutes from the time this mail has been delievered to your inbox. You can change your request only till (time/date )<br /><br />
<form name='cc_consent' action='thanks-customer-consent.php' method='POST'>
<input type='hidden' name='reply_product' id='reply_product' value='3'>
<input type='hidden' name='request_id' id='request_id' value='".$CustomerID."'>
 <table cellpadding='0' cellspacing='0' border='1'>
<tr>
<td  height='27' bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Name</td>
<td bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Contact</td>
<td bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Give ur consent</td></tr>";
for($m=0; $m <count($ExpBidderName);$m++)
			{
	$definetypwcl="select Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$m].")";
	list($defrowclcount,$defrowcl)=MainselectfuncNew($definetypwcl,$array = array());
	$defrowclcontr=count($defrowcl)-1;
	if($defrowcl[$defrowclcontr]['Define_PrePost'] == "PostPaid")
				{
					$txtvw="(Direct Bank Sales Team)";
				}
				else
				{
					$txtvw="As Agent of ".$ExpBidderName[$m];
				}
	if($ExpBidderName[$m]=="HDFC")
				{
		$Message.="<tr>
<td width='106' height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$defrowcl[$defrowclcontr]["Bidder_Name"]."<br>".$txtvw."</td>
<td width='210' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderContact[$m]."</td><td style='border-left:none;'><input type='checkbox' id='noreqd_banks' name='noreqd_banks[]' value='".$arrbiddrbid[$m]."' /></td></tr>";
			}
				else
				{
	$Message.="<tr>
<td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$defrowcl[$defrowclcontr]["Bidder_Name"]."<br>".$txtvw."</td>
<td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderContact[$m]."</td><td style='border-left:none;'><input type='checkbox' id='noreqd_banks' name='noreqd_banks[]' value='".$arrbiddrbid[$m]."' /></td></tr>";
				}
				
			}
$Message.="<tr><td align='center' colspan='3' height='40'><input type='submit' name='submit' value='submit'></td></tr></table></form><br>You will receive calls within 24 hours from the Companies executives,
you can compare the rates & choose the best deal. <br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3)	Apply to the bank which provides you the best offer.<br />
<br />
<b>Tips for Best Car loan deal</b><br />
1) Compare exact Emi|Processing fee | Tenure| Documents before choosing bank.<br />
2) Never pay any fee to any person to get loan sanctioned.Processing fee are deducted from Loan amount.<br />
3) Only give documents to one bank and check whether he is authorized Bank employee or vendor.<br /><br />
<b>Please ensure that you process your application with the concerned bank respective only. Do not entertain multiple offers from one single person, compare yourself and choose the best. <br><br>Deal4loans do not sell any loans on its own. We act as a comparison online platform to choose the best deal.
For any product, process related issue please contact your Bank where you have submitted your application</b>
<br><br>
<font style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the bank's sales representative.</b></font></p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Askamitoj.com</a> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";

echo $Message;
?>