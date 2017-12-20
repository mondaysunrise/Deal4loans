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

				$Message1= "<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#DEE3CE' style='border-collapse: collapse' bordercolor='#111111'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#DEE3CE'><tr><td align='center'>&nbsp;</td></tr></table><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' style='border-collapse: collapse' bordercolor='#111111' bgcolor='#F9FAF5'><tr><td bgcolor='#FFFFFF'><table><tr><td><font face='Verdana' size='2'><b>Dear $fname,</b></font></td><td align='right'><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>Thank you for Registering with deal4loans. Your one stop solution for all your loan deals. Your registration details are as follows:<p>Your Email ID: $EmailID<br>Your Password: $PWD1<p>You will receive various deals from banks both at your EMAIL ID and you can also SIGN IN at our site to view various offers.<br><br>Assuring you of our best service<br>Team<b> <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><b>'Loans by choice not by chance'</b></font></td></tr></table></td></tr><tr><td bgcolor='#DEE3CE'>&nbsp;</td></tr></table></td></tr></table>";
/*
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				//$headers .= 'To: '.$fname.' <'.$EmailID.'>' . "\r\n";
				$headers .= 'From: Loanqotes <loan@loanqotes.com>' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
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
<title>Registration</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div align="center">
 <center>
 <?php include '~Top.php'; ?>
 <p>&nbsp;</p>
<Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.Email, 'Email', 6))
	{
		return false;
	}
	var str=theFrm.Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
	
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
					return false;
					}
	if(!checkData(theFrm.PWD1, 'Password', 5))
		return false;
	if(!checkData(theFrm.PWD2, 'Password', 5))
		return false;
	if(theFrm.PWD1.value != theFrm.PWD2.value){
		alert('Please enter similar passwords.');
		theFrm.PWD1.value = "";
		theFrm.PWD2.value = "";
		theFrm.PWD1.focus();
		return false;
	}
	if(!checkData(theFrm.FName, 'First Name', 3))
		return false;
	if(!checkData(theFrm.LName, 'Last Name', 3))
		return false;
		return true
    }
 </Script>
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
 <table border="0" cellspacing="0" width="400" cellpadding="4" id="frm">
   <tr>
     <td colspan="2">New User Registration</td>
   </tr>
   <tr><td colspan="2" ID="Alert">&nbsp;<?=$Msg?></td></tr>
   <tr>
     <td width="35%">Email<font size="1" color="#FF0000">*</font></td>
     <td width="50%"><input type="text" name="Email" size="30" maxlength="50"></td>
   </tr>
   <tr>
     <td>Password<font size="1" color="#FF0000">*</font></td>
     <td><input type="password" name="PWD1" size="15" maxlength="15"></td>
   </tr>
   <tr>
     <td>Password Again<font size="1" color="#FF0000">*</font></td>
     <td><input type="password" name="PWD2" size="15" maxlength="15"></td>
   </tr>
   <tr>
     <td colspan="2">&nbsp;</td>
   </tr>
   <tr>
     <td>First Name<font size="1" color="#FF0000">*</font></td>
     <td><input type="text" name="FName" size="20" maxlength="30"></td>
   </tr>
   <tr>
     <td>Last Name<font size="1" color="#FF0000">*</font></td>
     <td><input type="text" name="LName" size="20" maxlength="30"></td>
   </tr>
   <tr>
     <td>Contact No./Mobile<font size="1" color="#FF0000"></font></td>
     <td><input type="text" name="Phone" size="30" maxlength="30"></td>
   </tr>
   <tr>
     <td>Make Contact Public</td>
     <td><input type="checkbox" name="IsPublic" value="1" checked></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><br><input type="submit" value="Submit"><input type="reset" value="Reset"></td>
   </tr>
  </table>
 </form>
 <?php include '~Bottom.php'; ?>
 </center>
</div>
</body>

</html>