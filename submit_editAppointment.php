<?php

	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	//print_r($_POST);
	
	//Array ( [RequestID] => 551523 [BidID] => 1029 [BidderName] => Fullerton [Name] => Mahesh [City] => Ahmedabad [address_apt] => 404/ Shails Mall near Giris Cold Drink Cross Road , Navrangpura Ahmedabad, 380009 [appdate] => 2011-10-22 [time] => [docs] => Pay slip - last 3 months, Bank statement (last 3 months), PAN Card, Salary account bank statement - last 6 months [b_mobile] => sdfds [send_email] => email [send_sms] => sms [submit] => Submit ) 
	
	$RequestID = $_POST['RequestID'];
	$BidID = $_POST['BidID'];
	$BidderName = $_POST['BidderName'];
	$Name = $_POST['Name'];
	$Mobile_Number = $_POST['Mobile_Number'];
	$City = $_POST['City'];
	$address_apt = $_POST['address_apt'];
	$appdate = $_POST['appdate'];
	$time = $_POST['time'];
	if($time=="")
	{
		$time = "Any Time";
	}
	$docs = $_POST['docs'];
	$b_mobile = $_POST['b_mobile'];
	$b_email = $_POST['b_email'];
	$send_email = $_POST['send_email'];
	$send_sms = $_POST['send_sms'];	
	
	if($send_email=="email")
	{
		//Send Mail
		$message = '';
		$message .= "<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
	  <tr>
		<td height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
	  </tr>
	  <tr>
		<td width='560'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
		  <tr>
			<td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
			<td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
			  <tr><td align='left'>
	<table width='88%' border='0' align='center' cellpadding='3' cellspacing='2'>
	<tr><td width='100%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><strong>Sir,</strong></td>
	<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>&nbsp;</td></tr>
	<tr>
	  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'>Please follow the Appointment for ".$Name.", ".$Mobile_Number.", ".$City." and get the document collected to process the case fast.</td>
	</tr>";
$message .= "<tr>
	  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'>Appointment Details:</td>
	</tr>";
	$message .= "<tr>
	  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'>Time :  ".$appdate." - ".$time."</td>
	</tr>";
		$message .= "<tr>
	  <td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#061c33; line-height:18px; font-weight:bold;' colspan='2'>Address :  ".$address_apt."</td>
	</tr>";
	$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr>
	</table> 
	</td>
	</tr>
	<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
	<b>Regards</b> <br />
	Team Deal4loans.com<br />
	Loans by choice not by chance!!<br />
	</td>
			  </tr>
			  </table></td>
			<td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
		  </tr>
		</table></td>
	  </tr>
	  <tr>    <td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>
	
	  </tr>
	</table>";
	//echo $message;
	
		
		
		if(strlen(trim($b_email)) > 0)
		{
			$Email=$b_email;
		//	 echo $b_email;	
		
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc:h.shuaib@gmail.com,balbirsingh499@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			mail($Email,'Appointments Lead - Deal4loans', $message, $headers);
		}
	
	
	}	
	if($send_sms=="sms")
	{
		//Send SMS
		$Msg = "Appointment Fixed from Deal4loans.com: ".$Name.", ".$Mobile_Number.", ".$City.", ".$address_apt.", ".$appdate." ".$time; 
			if(strlen(trim($b_mobile)) > 0)
			{
				SendSMSforLMS($Msg, $b_mobile);
			//	echo "<br>".$b_mobile."--".$BidID ;
			
			}
		
			
	}
			
?>
<html>
<head>
   <title>Appointments</title>
</head>
<script type="text/javascript">
   function closepopup()
   {
      if(false == my_window.closed)
      {
         my_window.close ();
      }
      else
      {
         alert('Window already closed!');
      }
   }
</script>
<body>
      
   </p>
<table width="560" border="0" align="center" cellpadding="3" cellspacing="4" bgcolor="#FFFFFF" >
<!--   <tr>
     <td style="border-bottom:1px solid #45B2D8;" colspan="2" align="right"><strong>
<a href="javascript: closepopup()">Close</a>
</strong></td>
  </tr> -->
   <tr>
     <td style="border-bottom:1px solid #45B2D8;" colspan="2" align="center"><strong>
The Leads <?php echo $send_email; ?> <?php echo $send_sms; ?> has been send to  <?php echo $BidderName; ?> 
</strong></td>
  </tr>
 
  </table>
</body>
</html>
