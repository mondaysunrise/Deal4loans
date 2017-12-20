<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name=$_REQUEST['name'];
	$email=$_REQUEST['email'];

$emailmessage="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'> <tr>    <td align='center' bgcolor='#529BE4'>&nbsp;</td>  </tr> <tr> <td align='left'><table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#F9FCFF'> <tr> <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' /></td><td align='center' valign='top'><table width='98%' border='0' align='center' cellpadding='0' cellspacing='8'> <tr><td width='44%'><font face='Verdana' size='2'><b>Dear $name,</b></font></td><td width='56%'	align='right'  style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#0f74d4;'><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='76' /><br />   <font face='Verdana' style='font-size:12px; color:#0F74D4;'>Loans by choice not by chance!!</font></td></tr><tr><td colspan='2'><font face='Verdana' size='2'> <p> We have an exiciting offer for you to apply for  a Kotak Bank Credit Card purely online.<br><br>All you need is to apply online and spends few minutes on filling details.</p> </font> So <a href='http://www.deal4loans.com/sendtokotaklocation.php' target='_blank'><font style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; '>Apply Here.</font></a></font><br /><br /></td></tr> <tr>  <td colspan='2' style='background-color:#003366;' align='center'><a href='http://www.deal4loans.com/sendtokotaklocation.php' target='_blank' style='color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none;'>Features of Kotak Bank Credit Cards</a></td></tr><tr ><td colspan='2'valign='top' style='border:5px solid red; padding-left:5px;'><a href='http://www.deal4loans.com/sendtokotaklocation.php' target='_blank' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; text-decoration:none; display:block; color:#000000; font-size:12px;'><strong>Entertainment:</strong> Get a free ticket for your companion at PVR Cinemas. <br /><br />  <strong>Travel:</strong> Get upto 25% off on travelguru.com.     <br />   <br />           <strong>Dining:</strong> Get upto 40% off on Pizza Hut meals.</a> </td></tr>  <tr>  <td colspan='2'><br /><font face='Verdana' size='2'><b>Team Deal4loans.com</b></font> </td>   </tr>  </table></td>   <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1'/></td>  </tr>  <tr>    <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='1' /></td>       <td height='2' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='2' /></td>        <td width='1' bgcolor='#529BE4'><img src='http://www.deal4loans/images/spacer.gif' width='1' height='1' /></td>   </tr> </table></td>  </tr></table><table width='100%' bgcolor='#529BE4'><tr><td align='center'> <a href='http://www.deal4loans.com/Contents_Blogs.php?source=kotak-mailer' target='_blank'><font face='Verdana' size='2' color='#FFFFFF'>Blogs</font></a></td><td align='center' > | </td><td align='center'><a href='http://www.deal4loans.com/Contents_Feedback.php?source=kotak-mailer' target='_blank'><font face='Verdana' size='2' color='#FFFFFF'>Testimonials</font></a></td align='center'><td> | </td><td align='center'><a href='http://www.deal4loans.com/Loan_Query.php?source=kotak-mailer' target='_blank'><font face='Verdana' size='2'color='#FFFFFF'>LoanQueries</font></a></td><td align='center'> | </td><td align='center'><a href='http://www.deal4loans.com/Contents_chat.php?source=kotak-mailer' target='_blank'><font face='Verdana' size='2' color='#FFFFFF'>Live Chat</font></a></td></tr></table></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>";
	$subject="Your Kotak Credit Card Offer";

//<kotakmahindracards@gmail.com>

	$headers  = 'From: <kotakmahindracards@d4l.com>' . "\r\n";
	$headers .= "Return-Path: <kotakmahindracards@d4l.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	if(strlen($email)>0 && strlen($name)>0)
	mail($email,$subject, $emailmessage, $headers);
}
	?>

	<html>
<head></head>
<body><div align="center">
<form name="getmailer" method="post" action="">
<div align="center" style="font-family:verdana; font-size:11px; "><b>fill details</b></div>
<font style="font-family:verdana; font-size:11px; ">Name <input type="text" name="name" id="name"></font><br>
<font style="font-family:verdana; font-size:11px; ">Email <input type="text" name="email" id="email"></font><br>
<input type="submit" name="submit" id="submit" value="submit">
</form>
</div>
</body>
	</html>