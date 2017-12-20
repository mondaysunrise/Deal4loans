<?php
require 'scripts/db_init.php';

	$email =$_REQUEST['Email'];
	$name =$_REQUEST['Name'];
	$type =$_REQUEST['Type'];
//echo $email."<br>".$name."<br>".$type;
	
	if($type=="ccmailer")
	{
	$emailmessage="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'> <tr>    <td align='center' bgcolor='#529BE4'>&nbsp;</td>  </tr> <tr> <td align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#F9FCFF'> <tr> <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' /></td><td align='center' valign='top'><table width='98%' border='0' align='center' cellpadding='0' cellspacing='8'> <tr><td width='44%'><font face='Verdana' size='2'><b>Dear $name,</b></font></td><td width='56%'	align='right'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#0f74d4;'><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='76' /><br />   <font face='Verdana' style='font-size:12px; color:#0F74D4;'>Loans by choice not by chance!!</font></td></tr><tr><td colspan='2'><font face='Verdana' size='2'> <p><b>Thanks</b> for speaking to Customer Care team at deal4loans.com.Your request has been forwarded to Banks and now you have the power to choose the best offer for your Credit Card.</p><p> We have an exiciting offer for you to apply for  a Kotak Bank Credit Card purely online.</p> <p>All you need is to apply online and spends few minutes on filling details.</p> </font> So <a href='http://www.s2d6.com/x/?x=c&amp;z=s&amp;v=1244903&amp;r=[RANDOM]&amp;k=deal4loans' target='_blank'><font style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; '>Apply Here.</font></a></font><br /><br /></td></tr> <tr>  <td colspan='2' style='background-color:#003366;' align='center'><a href='http://www.s2d6.com/x/?x=c&amp;z=s&amp;v=1244903&amp;r=[RANDOM]&amp;k=deal4loans' target='_blank' style='color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none;'>Features of Kotak Bank Credit Cards</a></td></tr><tr ><td colspan='2' valign='top' style='border:5px solid red; padding-left:5px;'><a href='http://www.s2d6.com/x/?x=c&amp;z=s&amp;v=1244903&amp;r=[RANDOM]&amp;k=deal4loans' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none; display:block; color:#000000; font-size:12px;'><strong>Entertainment:</strong> Get a free ticket for your companion at PVR Cinemas. <br /><br />  <strong> Travel:</strong> Get upto 25% off on travelguru.com.     <br />   <br />           <strong>Dining:</strong> Get upto 40% off on Pizza Hut meals.</a> </td></tr>  <tr>  <td colspan='2'><br /><font face='Verdana' size='2'><b>Team Deal4loans.com</b></font> </td>   </tr>  </table></td>   <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1'/></td>  </tr>  <tr>    <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='1' /></td>       <td height='2' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='2' /></td>        <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='1' /></td>   </tr> </table></td>  </tr></table><table width='100%' bgcolor='#529BE4'><tr><td align='center'> <a href='http://www.deal4loans.com/Contents_Blogs.php?source=hllms' target='_blank'><font face='Verdana' size='2' color='#FFFFFF'>Blogs</font></a></td><td align='center' > | </td><td align='center'><a href='http://www.deal4loans.com/Contents_Feedback.php?source=hllms' target='_blank'><font face='Verdana' size='2' color='#FFFFFF'>Testimonials</font></a></td align='center'><td> | </td><td align='center'><a href='http://www.deal4loans.com/Loan_Query.php?source=hllms' target='_blank'><font face='Verdana' size='2'color='#FFFFFF'>LoanQueries</font></a></td><td align='center'> | </td><td align='center'><a href='http://www.deal4loans.com/Contents_chat.php?source=hllms' target='_blank'><font face='Verdana' size='2' color='#FFFFFF'>Live Chat</font></a></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
	$subject="Thanks for visiting Deal4loans.com";
	//echo "hello".$emailmessage;
	}
	/*elseif($type=="hlmailer") 
	{
		$emailmessage="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>    <td align='center' bgcolor='#529BE4'>&nbsp;</td> </tr><tr><td align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#F9FCFF'> <tr><td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' /></td><td align='center' valign='top'><table width='98%' border='0' align='center' cellpadding='0' cellspacing='8'> <tr><td><font face='Verdana' size='2'><b>Dear $name,</b></font></td>           <td	align='right'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#0f74d4;'><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='76' /><br /> <font face='Verdana' style='font-size:12px; color:#0F74D4;'>Loans by choice not by chance!!</font></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><b>Thanks</b> for talking to Customer Care team at deal4loans.com.Your request has been forwarded to Banks and now you have the power to choose the best offer for your Home loans.</p> <p> We would also like to introduce our Insurance services through our Insurance Comparison portal <a href='http://www.bimadeals.com/index.php' target='_blank'>www.bimadeals.com</a>.</p>          <p> If you are interested in getting Health Insurance for yourself and your Family members, its just a <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=hllms' target='_blank'>few clicks away</A>.</p><p> <a href='http://www.bimadeals.com/health-insurance.php?source=hllms' target='_blank'>Apply Here </a>and get best deals on low premiums /Tax Benefits etc.</p></font></td></tr><tr> <td colspan='2'><font face='Verdana' size='2'><b>Team Deal4loans.com</b></font> </td></tr></table></td> <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1'/></td> </tr><tr><td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='1' /></td>        <td height='2' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='2' /></td><td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='1' /></td></tr></table></td></tr></table><table width='100%' bgcolor='#529BE4'><tr><td align='center'> <a href='http://www.deal4loans.com/Contents_Blogs.php?source=hllms' target='_blank'><font face='Verdana' size='2' color='#FFFFFF'>Blogs</font></a></td><td align='center' > | </td><td align='center'><a href='http://www.deal4loans.com/Contents_Feedback.php?source=hllms' target='_blank'><font face='Verdana' size='2' color='#FFFFFF'>Testimonials</font></a></td align='center'><td> | </td><td align='center'><a href='http://www.deal4loans.com/Loan_Query.php?source=hllms' target='_blank'><font face='Verdana' size='2'color='#FFFFFF'>LoanQueries</font></a></td><td align='center'> | </td><td align='center'><a href='http://www.deal4loans.com/Contents_chat.php?source=hllms' target='_blank'><font face='Verdana' size='2' color='#FFFFFF'>Live Chat</font></a></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
		$subject="Health Insurance Offers from Bimadeals";

	}*/
	if($type=="ccmailer")
	{
	
	}
	$DataArray = array("CC_Mailer"=>1);
	$wherecondition ="RequestID=".$_REQUEST['Request'];
	Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	
	$headers  = 'From: Deal4loans <customercare@deal4loans.com>' . "\r\n";
	$headers .= 'Bcc: homeloanlms@gmail.com' . "\r\n";
	$headers .= "Return-Path: <customercare@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//echo $Type_Loan;

					//if(isset($email))
					//{
						mail($email,$subject, $emailmessage, $headers);
					//}


		



?>
