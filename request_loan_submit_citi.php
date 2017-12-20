<?php

	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/htmlMimeMail.php';
	
	$name=$_POST['name'];
	$dob=$_POST['dob'];
	$mailid=$_POST['mailid'];
	$mobile=$_POST['mobile'];
	$comp_name=$_POST['comp_name'];
	$product=$_POST['product'];
	$city=$_POST['city'];
	$loan_amount=$_POST['loan_amount'];
	$income=$_POST['income'];
	$salaried=$_POST['salaried'];
	$detail=$_POST['detail'];
	$std=$_POST['std'];
	$landline=$_POST['landline'];
	
	if($detail<>"")
	{
		$detail=1;
	}
	else
	{
		$detail=0;
	}
	
	$doe=date("Y-m-d");

	$pwd=generatePassword(5);
	
	
	//Query to check if user exists
	$result = ("select UserID, IsPublic from wUsers where Email='$mailid' ");
	 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;
	
	
	//For already existing users
	//$row=mysql_fetch_array($result);
	$newid=$row[$cntr]["UserID"];
	///
	//echo mysql_error();
	
	//$num_rows = mysql_num_rows($result);
	
	if($num_rows > 0)
	{
		mysql_free_result($result);
		
		$Msg = "You will soon receive various offers from different banks.";
	}
	else
	{
	
		//$sql = "INSERT INTO wUsers (Email,FName,PWD,Phone,Std_Code,Landline,DOB,Join_Date,IsPublic) VALUES ('$mailid','$name','$pwd','$mobile','$std','$landline','$dob', '$doe','$detail')";
		$dataInsert = array("Email"=>$mailid, "FName"=>$name, "PWD"=>$pwd, "Phone"=>$mobile, "Std_Code"=>$std, "Landline"=>$landline, "DOB"=>$dob, "Join_Date"=>$doe, "IsPublic"=>$detail);
$table = 'wUsers';
$insert = Maininsertfunc ($table, $dataInsert);
		
		//$result = ExecQuery($sql);	
	
		////New Inserted ID
		$newid = mysql_insert_id();
		///
		
		//Mail for the user
		$Message2= "<table border='0' cellspacing='0' width='485' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center><table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr></table><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' style='border-collapse: collapse' bordercolor='#529BE4' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'><p><font face='Verdana' size='2'><b>Dear ".$name.",</b><br><br>Thank you for Registering with deal4loans. Your one stop solution for all your loan deals. Your registration details are as follows:<p>Your Email ID: ".$mailid."<br>Your Password: ".$pwd."<p>You will receive various deals from banks both at your EMAIL ID and you can also SIGN IN at our site to view various offers.<br><br>Assuring you of our best service<br>Team<b> <a href=' http://www.deal4loans.com'>deal4loans.com</a></b><br></font></td></tr><tr><td bgcolor='#529BE4'>&nbsp;</td></tr></table></td></tr></table>"; 

		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
    	$headers .= "Return-Path: < no-reply@deal4loans.com>\r\n";  // Return path for errors
   		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//    	mail($mailid,'Welcome to Deal4loans - '.$name, $Message2, $headers);

		//
	}
		$today=date("Y-m-d H:i:s");
		if($product=="personal_loan")
		{
			//$sql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, Net_Salary, Loan_Amount, Dated, Mobile_Number,Std_Code,Landline,IsPublic) VALUES ('$newid', '$name', '$mailid', '$salaried', '$comp_name', '$city', '$income', '$loan_amount', '$today', '$mobile','$std','$landline','$detail')";
			//$result = ExecQuery($sql);
		$dataInsert = array("UserID"=>$newid, "Name"=>$name, "Email"=>$mailid, "Employment_Status"=>$salaried, "Company_Name"=>$comp_name, "City"=>$city, "Net_Salary"=>$income, "Loan_Amount"=>$loan_amount, "Dated"=>$today, "Mobile_Number"=>$mobile, "Std_Code"=>$std, "Landline"=>$landline, "IsPublic"=>$detail);
$table = 'Req_Loan_Personal';
$insert = Maininsertfunc ($table, $dataInsert);
		
			//$result=mysql_query($sql) or die(mysql_error());
			
		}
		if($product=="car_loan")
		{
			//$sql = "INSERT INTO Req_Loan_Car (UserID, Name, Email, Employment_Status, Company_Name, City, Net_Salary, Loan_Amount, Dated, Mobile_Number,Std_Code,Landline,IsPublic) VALUES ('$newid', '$name', '$mailid', '$salaried', '$comp_name', '$city', '$income', '$loan_amount', '$today', '$mobile','$std','$landline','$detail')";
			//$result = ExecQuery($sql); 
			$dataInsert = array("UserID"=>$newid, "Name"=>$name, "Email"=>$mailid, "Employment_Status"=>$salaried, "Company_Name"=>$comp_name, "City"=>$city, "Net_Salary"=>$income, "Loan_Amount"=>$loan_amount, "Dated"=>$today, "Mobile_Number"=>$mobile, "Std_Code"=>$std, "Landline"=>$landline, "IsPublic"=>$detail);
$table = 'Req_Loan_Car';
$insert = Maininsertfunc ($table, $dataInsert);
			
		}
		if($product=="credit_card_loan")
		{
			//$sql = "INSERT INTO Req_Credit_Card (UserID, Name, Email, Employment_Status, Company_Name, City, Net_Salary, Loan_Amount, Dated, Mobile_Number,Std_Code,Landline,IsPublic) VALUES ('$newid', '$name', '$mailid', '$salaried', '$comp_name', '$city', '$income', '$loan_amount', '$today', '$mobile','$std','$landline','$detail')";
		///	$result = ExecQuery($sql); 
		
		$dataInsert = array("UserID"=>$newid, "Name"=>$name, "Email"=>$mailid, "Employment_Status"=>$salaried, "Company_Name"=>$comp_name, "City"=>$city, "Net_Salary"=>$income, "Loan_Amount"=>$loan_amount, "Dated"=>$today, "Mobile_Number"=>$mobile, "Std_Code"=>$std, "Landline"=>$landline, "IsPublic"=>$detail);
$table = 'Req_Credit_Card';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
		}
		if($product=="loan_against_property")
		{
			//$sql = "INSERT INTO Req_Loan_Against_Property (UserID, Name, Email, Employment_Status, Company_Name, City, Net_Salary, Loan_Amount, Dated, Mobile_Number,Std_Code,Landline,IsPublic) VALUES ('$newid', '$name', '$mailid', '$salaried', '$comp_name', '$city', '$income', '$loan_amount', '$today', '$mobile','$std','$landline','$detail')";
			//$result = ExecQuery($sql); 
			
			$dataInsert = array("UserID"=>$newid, "Name"=>$name, "Email"=>$mailid, "Employment_Status"=>$salaried, "Company_Name"=>$comp_name, "City"=>$city, "Net_Salary"=>$income, "Loan_Amount"=>$loan_amount, "Dated"=>$today, "Mobile_Number"=>$mobile, "Std_Code"=>$std, "Landline"=>$landline, "IsPublic"=>$detail);
$table = 'loan_against_property';
$insert = Maininsertfunc ($table, $dataInsert);
		}
		if($product=="home_loan")
		{
			$sql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, Employment_Status, Company_Name, City, Net_Salary, Loan_Amount, Dated, Mobile_Number,Std_Code,Landline,IsPublic) VALUES ('$newid', '$name', '$mailid', '$salaried', '$comp_name', '$city', '$income', '$loan_amount', '$today', '$mobile','$std','$landline','$detail')";
		//	$result = ExecQuery($sql); 
		$dataInsert = array("UserID"=>$newid, "Name"=>$name, "Email"=>$mailid, "Employment_Status"=>$salaried, "Company_Name"=>$comp_name, "City"=>$city, "Net_Salary"=>$income, "Loan_Amount"=>$loan_amount, "Dated"=>$today, "Mobile_Number"=>$mobile, "Std_Code"=>$std, "Landline"=>$landline, "IsPublic"=>$detail);
$table = 'Req_Loan_Home';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
		}
		
		$Msg = "You will soon receive various offers from different banks.";
	
	
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="Description" content="">
<meta name="keywords" content="Best Personal Loans in India, Best Loan Quotes in India, Compare Loans in India, Compare Home Loans in India, Compare Home in India, Compare Car loans in India, Car Loans, Compare Personal loans in India, Personal , Compare Credit Cards in India, Compare Loans Against Property in India">
<meta http-equiv="refresh" content="900">
<title>Loan Facts - Deal4loans</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
 <center>
 <table border="0" cellspacing="0" width="712" cellpadding="0">
   <tr>
     <td align="center" valign="top" bgcolor="">
     <meta http-equiv="Content-Language" content="en-us">
     <p>&nbsp;</p>
     <p><a href="index.php"><img src="images/Thank u page.jpg" width="510" border="0"></a></p>     <p>&nbsp;</p></td>
     </tr>
 </table>
 </center>
</div>
</body>
</html>