<?php
require 'scripts/db_init.php';

	$RequestID =$_REQUEST['RequestID'];
	$Name =$_REQUEST['Name'];
	$email =$_REQUEST['email'];
	
	$emailmessage="<table width='600' border='0' align='center' cellpadding='0' cellspacing='0'> <tr>    <td align='center' bgcolor='#529BE4'>&nbsp;</td>  </tr> <tr> <td align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#F9FCFF'> <tr> <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' /></td><td align='center' valign='top'><table width='98%' border='0' align='center' cellpadding='0' cellspacing='8'> <tr><td width='44%'><font face='Verdana' size='2'><b>Dear $Name,</b></font></td><td width='56%'	align='right'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#0f74d4;'><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='76' /><br />   <font face='Verdana' style='font-size:12px; color:#0F74D4;'>Loans by choice not by chance!!</font></td></tr><tr><td colspan='2'><font face='Verdana' size='2'> <p>Thanks   for applying for Hdfc Credit card through Deal4loans.com</p><p>Your application is not accepted as   your pan number mentioned by you is incorrect.</p><p>Pls quote your  pan number again so that we can get your application processed by Hdfc Bank.</p> </font><font face='Verdana' size='2'>&nbsp;</font> So <a href='http://www.deal4loans.com/validate-pancard-hdfc-card.php?id=$RequestID' target='_blank'><font style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; '>Click to Validate.</font></a></font><br /><br /></td></tr> <tr>  <td colspan='2'><font face='Verdana' size='2'><b>Customer Care<br> Deal4loans.com</b></font> </td></tr></table></td>   <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1'/></td></tr><tr><td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='1' /></td><td height='2' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='2' /></td><td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='1' /></td></tr> </table></td>  </tr></table></td></tr></table></td></tr></table>";
	$subject="Validate your Pancard";
	//echo "hello".$emailmessage;
	
	
	
	$headers  = 'From: Deal4loans <customercare@deal4loans.com>' . "\r\n";
	
	$headers .= "Return-Path: <customercare@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//echo $Type_Loan;

					//if(isset($email))
					//{
						mail($email,$subject, $emailmessage, $headers);
					//}
							$DataArray = array("send_mail"=>"1");
		$wherecondition ="(RequestID=".$RequestID.")";
		Mainupdatefunc ('req_hdfc_lead', $DataArray, $wherecondition);			

//echo $email."<br>".$Name."<br>".$RequestID;
echo "Send";

		



?>
