<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/htmlMimeMail.php';

	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){	
		foreach($_POST as $a=>$b)
			$$a=$b;

		/* FIX STRING */
		$Email = FixString($Email);
		$EmailID = FixString($Email);
		$fname = FixString($FName);
		$FName = FixString(ucwords($FName));
		$LName = FixString(ucwords($LName));
		$PWD1 = FixString($PWD1);
		$Phone = FixString($Phone);
		if(!isset($IsPublic))
		   $IsPublic = 0;

	
		//Query to check if user exists
		$result = ExecQuery("select IsPublic from wUsers where Email='$Email' ");
		echo mysql_error();

		$num_rows = mysql_num_rows($result);

		if($num_rows > 0){
			mysql_free_result($result);
			$Msg = "** User with this email id already exists. !! ";
		}else{

			$sql = "INSERT INTO wUsers (Email,FName,LName,PWD,Phone,Join_Date,Last_Login,Count_Requests,IsPublic) VALUES ('$Email','$FName','$LName','$PWD1','$Phone',Now(),Now(),0,'$IsPublic')";
			$result = mysql_query($sql);
			if ($result == 1)
			{
				//$Message1= "<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#DEE3CE' style='border-collapse: collapse' bordercolor='#111111'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#DEE3CE'><tr><td align='center'>&nbsp;</td></tr></table><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' style='border-collapse: collapse' bordercolor='#111111' bgcolor='#F9FAF5'><tr><td bgcolor='#F9FAF5'><p align='justify'><font face='Verdana' size='2'><b>Dear $fname,</b><br><br>Thank you for Registering with deal4loans. Your one stop solution for all your loan deals. Your registration details are as follows:<p align='justify'>Your Email ID: $EmailID<br>Your Password: $PWD1<p align='justify'>You will receive various deals from banks both at your EMAIL ID and you can also SIGN IN at our site to view various offers.<br><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br></font></td></tr><tr><td bgcolor='#DEE3CE'>&nbsp;</td></tr></table></td></tr></table>";

				$SMSMessage = "Dear $fname, Thank you for Registering with deal4loans. Your registration details are as follows: EmailID: $EmailID. Password: $PWD1";
				if(strlen(trim($Phone)) > 0)
					SendSMS($SMSMessage, $Phone);

				$Message1= "<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#DEE3CE' style='border-collapse: collapse' bordercolor='#111111'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#DEE3CE'><tr><td align='center'>&nbsp;</td></tr></table><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' style='border-collapse: collapse' bordercolor='#111111' bgcolor='#F9FAF5'><tr><td bgcolor='#F9FAF5'><p><font face='Verdana' size='2'><b>Dear $fname,</b><br><br>Thank you for Registering with deal4loans. Your one stop solution for all your loan deals. Your registration details are as follows:<p>Your Email ID: $EmailID<br>Your Password: $PWD1<p>You will receive various deals from banks both at your EMAIL ID and you can also SIGN IN at our site to view various offers.<br><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br></font></td></tr><tr><td bgcolor='#DEE3CE'>&nbsp;</td></tr></table></td></tr></table>";
/*
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				//$headers .= 'To: '.$fname.' <'.$EmailID.'>' . "\r\n";
				$headers .= 'From: Deal4loans <support@deal4loans.com>' . "\r\n";
*/
				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				mail($EmailID,'Welcome to Deal4loans - '.$fname, $Message1, $headers);
			}
			if ($result == 1)
			{
				$Msg = getAlert("You have become our Registered user now. Click OK to continue !!", TRUE, "Login.php");
			}
			else
				$Msg = "** There was a problem with your Registration process. Please try again. !! ";
		}
	}
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="Description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, apply for loans">
<title>Register to apply for loans (Home + Personal + Car + Loan Against Property) and  Credit cards</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="center">
 <center>
 <?php include '~Top.php'; ?>
 <p>&nbsp;</p>
 <table width="712" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="202" align="center">&nbsp;</td>
     <td width="510" align="center" valign="top">
		 <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td align="center"><p align="center"><span class="head2">Apply for</span></p><br></td>
         </tr>
       <tr>
         <td align="center"><a href="Request_Loan_Personal_New.php"><img src="images/2.gif" width="90" height="91" border="0"></a></td>
         </tr>
       <tr>
         <td align="center"><a href="Request_Loan_Home_New.php"><img src="images/3.gif" width="90" height="91" border="0"></a><a href="Request_Loan_Car_New.php"><img src="images/4.gif" width="90" height="91" border="0"></a><a href="Request_Credit_Card_New.php"><img src="images/5.gif" width="90" height="91" border="0"></a></td>
         </tr>
       <tr>
         <td align="center"><a href="Request_Loan_Against_Property_New.php"><img src="images/6.gif" width="90" height="91" border="0"></a></td>
         </tr>
     </table></td>
   </tr>
 </table>
 <p>&nbsp;</p>
 <p>
   <?php include '~Bottom.php'; ?>
 </p>
 </center>
</div>

</body>

</html>