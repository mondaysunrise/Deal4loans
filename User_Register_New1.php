<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';

	
	$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}

	if($_SESSION=="")
		{
		$EmailID = $_SERVER['Temp_Email'];
		$Pancard= $_SERVER['Temp_Pancard'];
		$Name = $_SERVER['Temp_Name'];
		$Card_Vintage = $_SERVER['Temp_Card_Vintage']; 
		$City = $_SERVER['Temp_City'];
		$Type_Loan = $_SERVER['Temp_Type'];
		$Name_New = $_SERVER['Temp_Name_New'];
		$Net_Salary_Monthly = $_SERVER['Temp_Net_Salary_Monthly'];
		$Net_Salary = $_SERVER['Temp_Net_Salary'];
		$Item_ID = $_SERVER['Temp_Item_ID'];
		$Flag_Message = $_SERVER['Temp_Flag_Message'];
		$Employment_Status= $_SERVER['Temp_Employment_Status'];
		$Msg = "";
		$UserID_Message = "";
		$Reference_Code2= $_SERVER['Temp_Reference_Code'];
		$FName = $_SERVER['Temp_FName'];
		$LName = $_SERVER['Temp_LName'];
		$DOB = $_SERVER['Temp_DOB'];
		$Phone = $_SERVER['Temp_Phone'];
		$CC_Holder = $_SERVER['Temp_CC_Holder'];
		$IsPublic = $_SERVER['Temp_IsPublic'];
	}
	else
	{
		$EmailID = $_SESSION['Temp_Email'];
		$Pancard= $_SESSION['Temp_Pancard'];
		$Card_Vintage = $_SESSION['Temp_Card_Vintage']; 
		$Name = $_SESSION['Temp_Name'];
		$City = $_SESSION['Temp_City'];
		$City_Other = $_SESSION['Temp_City_Other'];
		$Type_Loan = $_SESSION['Temp_Type'];
		$Name_New = $_SESSION['Temp_Name_New'];
		$Net_Salary_Monthly = $_SESSION['Temp_Net_Salary_Monthly'];
		$Net_Salary = $_SESSION['Temp_Net_Salary'];
		$Item_ID = $_SESSION['Temp_Item_ID'];
		$Flag_Message = $_SESSION['Temp_Flag_Message'];
		$Employment_Status= $_SESSION['Temp_Employment_Status'];
		$Msg = "";
		$UserID_Message = "";
		$Reference_Code2= $_SESSION['Temp_Reference_Code'];
		$FName = $_SESSION['Temp_FName'];
		$LName = $_SESSION['Temp_LName'];
		$DOB = $_SESSION['Temp_DOB'];
		$Phone = $_SESSION['Temp_Phone'];
		$CC_Holder = $_SESSION['Temp_CC_Holder'];
		$IsPublic = $_SESSION['Temp_IsPublic'];
	}

	if(strlen($Name)<0)
	{
	$Name = $FName." ".$LName;
	}
	else
	{
		$Name = $Name;
	}
	$Email = $EmailID;


	//Query to check if user exists

	$result = ExecQuery("select IsPublic from wUsers where Email='$EmailID' ");

	echo mysql_error();

	$num_rows = mysql_num_rows($result);
//$Type_Loan="CreditCard";
//$CC_Holder=1;
//$Pancard=1;


	if($num_rows > 0)
	{
		mysql_free_result($result);
		$Msg = "** User with this email id already exists. !! ";
	}
	else
	{
		$sql = "INSERT INTO wUsers (Email,FName,LName,Phone,DOB,Join_Date,Last_Login,Count_Requests,IsPublic) VALUES ('$EmailID','$FName','$LName','$Phone','$DOB',Now(),Now(),0,'$IsPublic')";
		$result = mysql_query($sql);
		$last_inserted = mysql_insert_id();
		
		
		
		/*if(($Type_Loan =="PersonalLoan") || ($Type_Loan =="HomeLoan") || ($Type_Loan =="BusinessLoan"))
		{
		$SMSMessage = "Dear $Name,Thanks for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.";
		if(strlen(trim($Phone)) > 0)
		SendSMS($SMSMessage, $Phone);
		}
		else
			{
		$SMSMessage = "Dear $Name,Thank you for Registering with deal4loans.Your registration details are as follows: EmailID: $EmailID.";
			if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
			}*/
	
	
//Code Added to mailtocommonscript.php

	/*$Checktosend="getUser_Register_New";
	include "scripts/mailatcommonscript.php";

					$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;
					if(isset($Type_Loan))
					{
						mail($EmailID,'Welcome to Deal4loans - '.$FName, $Message2, $headers);
					}*/
	}

					$Checktosend="getUser_Register_New";
					include "scripts/mailatcommonscript.php";

					$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if(isset($Type_Loan))
					{
						mail($EmailID,'Welcome to Deal4loans - '.$FName, $Message2, $headers);
					}

		if ($Flag_Message == 1)
		{
			$sqltest = ExecQuery("Select RequestID from Req_Loan_Personal order by RequestID desc limit 1");
			echo mysql_error();
			if ($myrow = mysql_fetch_array($sqltest)) 
			{
				$Item_ID = $myrow["RequestID"];
			}
			mysql_free_result($sqltest);
			$sqltest1 = ExecQuery("Select UserID from wUsers order by UserID desc limit 1");
			echo mysql_error();
			if ($myrow = mysql_fetch_array($sqltest1))
			{
				$UserID_Message=$myrow["UserID"];
			}
			mysql_free_result($sqltest1);

				

		}
			if ($Flag_Message == 2)

			{

				$sqltest = ExecQuery("Select RequestID from Req_Credit_Card order by RequestID desc limit 1");

				echo mysql_error();

				if ($myrow = mysql_fetch_array($sqltest))

				{

					$Item_ID=$myrow["RequestID"];

				}

				mysql_free_result($sqltest);

				$sqltest1 = ExecQuery("Select UserID from wUsers order by UserID desc limit 1");

				echo mysql_error();

				if ($myrow = mysql_fetch_array($sqltest1))

				{

					$UserID_Message=$myrow["UserID"];

				}

				mysql_free_result($sqltest1);

				

			}

			if ($result == 1) 

			{	

				if(strlen(trim($EmailID)) > 0 )
				{
					$sql = ExecQuery("Select *  from wUsers where Email='".$EmailID."'");

					echo mysql_error();

					if ($myrow = mysql_fetch_array($sql)) 

					{

						$UserID=$myrow["UserID"];

						

						/* Get Resultset */

						mysql_fetch_array($sql);



							$sub_sql = ExecQuery("Update Req_Loan_Personal SET UserID=".$UserID.", Count_Replies='1', IsModified='1' Where Email='".$EmailID."'");



							$sub_sql = ExecQuery("Update Req_Loan_Home SET UserID=".$UserID." Where Email='".$EmailID."'");

							$sub_sql = ExecQuery("Update Req_Loan_Against_Property SET UserID=".$UserID." Where Email='".$EmailID."'");


							$sub_sql = ExecQuery("Update Req_Credit_Card SET UserID=".$UserID." Where Email='".$EmailID."'");


							$sub_sql = ExecQuery("Update Req_Loan_Car SET UserID=".$UserID." Where Email='".$EmailID."'");
							
							$sub_sql = ExecQuery("Update Req_Business_Loan SET UserID=".$UserID." Where Email='".$EmailID."'");

						mysql_free_result($sub_sql);

					}

				}

				

				/* Dump Resultset */

				mysql_free_result($result);

				/*if(($Type_Loan!="CreditCard") && ($Type_Loan!="PersonalLoan") && ($Type_Loan!="HomeLoan") && ($Type_Loan!="BusinessLoan"))
					{

						session_unset();
					 }*/
				$Msg = getAlert("Congratulations!!! You have become our Registred User Now. Click OK to Continue !!", TRUE, "Login.php");

				}



		

			//else

			//	$Msg = "** There was a problem with your registration process. Please try again. !! ";
		
//$Type_Loan="HomeLoan";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deal4Loans - Home Loans, Personal Loans, Car Loans, Loan Against Property</title>
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.Property_Identified.value="on")
			{
				ni1.innerHTML = '';
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0" width="100%"><tr><td class="frmtxt" align="left"  width="200"  height="20">Property Location 	</td><td  class="frmtxt" width="196" align="center"  height="20"><select size="1" align="center"  name="Property_Loc" >	<?=getCityList1($Property_Loc)?></select></td></tr>	</table>';
			}
			
		}
			
		return true;
	}
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if((ni.innerHTML!="")|| (ni1.innerHTML==""))
		{
		
			if(document.loan_form.validate.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				ni1.innerHTML = '';
			}
		}
		
		return true;

	}
/*function addElement1()
{
		var ni = document.getElementById('myDiv9');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Ho1der.value);
				ni.innerHTML = '<table border="0"><tr> <td class="frmtxt" >I have an active credit card from ? </td> <td  class="frmtxt" ><table border="0"> <tr><td class="frmtxt" ><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="frmtxt"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="frmtxt"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="frmtxt"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="frmtxt"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="frmtxt"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="frmtxt"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="frmtxt"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="frmtxt" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="frmtxt"><input type="checkbox" name="From_Product[]" value="Barclays" id="From_Product" class="noBrdr" >Barclays</td><td class="frmtxt"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td></tr><tr><td colspan="2" class="frmtxt"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</td></tr></table></td></tr><tr> <td align="left" class="frmtxt">Cards held since?</td><td  align="left"  colspan="3" ><select size="1" name="Card_Vintage"><option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option><option value="3">9 to 12 months</option> <option value="4">more than 12 months</option></select> </td></tr><tr><td class="frmtxt">Credit Card Limit?</td><td  align="left"  colspan="3" width="240" height="25"><select size="1"  name="Credit_Limit"><option value="0">Please select</option><option value="1">25000 to 50000</option> <option value="2">50001 to 75000</option><option value="3">75001 to 1 lakh </option> <option value="4">1 lakh & above</option></select> </td></tr>	</table>';
			}
		}
		
		return true;
	}

function removeElement1()
{
		var ni = document.getElementById('myDiv9');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
		}
		
		return true;
	}*/
 function addElement()
{
	
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0" width="100%"><tr><td align="left" class="frmtxt" width="150" height="20">Reconfirm Mobile No.</td>	<td colspan="3" align="left" width="350" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; name="RePhone" ></td></tr></table>';
			
			
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		return true;
		}


function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.Loan_Any.length; i++) 
	{
        if(document.loan_form.Loan_Any[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}

function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			
				ni.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr> <td align="left" class="frmtxt" width="227" ><b>Any type of loan(s) running?</b> </td> <td colspan="3" class="frmtxt" width="400" ><table width="100%" border="0" cellpadding="0" cellspacing="0"> <tr><td class="frmtxt" height="25" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td width="559" height="20" class="frmtxt"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td width="84" height="25" class="frmtxt"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr"value="cl" >Car</td><td class="frmtxt" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td height="25" class="frmtxt" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr> <tr> <td align="left" width="227" height="35" class="frmtxt"><b>How many EMI paid?</b> </td><td colspan="3" align="left" width="400" height="18" ><select name="EMI_Paid" style="float: left"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select> </td></tr></table>';
			
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}
function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML=="")
		{
		
			
				ni.innerHTML = '<table border="0"><tr>	 <td align="left"  class="frmtxt" width="200" height="20">Cards held since?</td>		<td  align="left"  colspan="3" width="300" height="20"><select size="1"  name="Card_Vintage"><option value="0">Please select</option> <option value="1">Less than 6 months</option>	 <option value="2">6 to 9 months</option>	 <option value="3">9 to 12 months</option>	 <option value="4">more than 12 months</option>	 </select> </td></tr>	<tr> <td align="left"  valign="top" class="frmtxt" width="200" height="20" >I have an active credit card from ? </td> <td colspan="3" class="frmtxt" width="300"><table border="0"> <tr><td class="frmtxt" width="60%"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="frmtxt" width="60%"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="frmtxt"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="frmtxt"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="frmtxt"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="frmtxt"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="frmtxt"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="frmtxt"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="frmtxt" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="frmtxt"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="frmtxt"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</table></table>';
				

			
		}
		
		return true;

	}


function removeElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}

function form_business(Form)
{

var btn;
var btn2;
var myOption;
var myLoanOption;

/*if(Form.Reference_Code1.value=="")
		{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				Form.confirm.focus();
				return false;
		}
		else if(Form.confirm.checked)
			{
				if(Form.RePhone.value=="")
			{
				alert("Please Re confirm your mobile number again");
				Form.RePhone.focus();
				return false;
			}
			
		}
		}*/
if (Form.Company_Name.value=="")
	{
		alert("Please enter Company Name.");
		Form.Company_Name.focus();
		return false;
	}
	
	if (Form.Constitution.selectedIndex==0)
	{
		alert("Please select Type of company");
		Form.Constitution.focus();
		return false;
	}
		myOption = -1;
		for (i=Form.CCbusiness.length-1; i > -1; i--) {
			if(Form.CCbusiness[i].checked) {
				if(i==0)
				{
					if(Form.Card_Vintage.selectedIndex==0)
					{
						alert('Card Held since.');
						Form.Card_Vintage.focus();
						return false;
					}

					btn2=valButton2();
					if(!btn2)
					{
						alert('From which bank.');
						return false;
					}

				}
					myOption = i;

				
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select you are credit card holder or not");
			return false;
		}
myLoanOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if(Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}

				}
					myLoanOption = i;

				
			}
		}
	
		if (myLoanOption == -1) 
		{
			alert("Please select Any loan running or not");
			return false;
		}
		
}


function valButton(btn) {
    var cnt = -1;
	var i;
    for(i=0; i<btn.length; i++) 
	{
        if(btn[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}

function valButton2() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.From_Product.length; i++) 
	{
        if(document.loan_form.From_Product[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}

function submitform3(Form)
	{
		var btnvalidate;
		var cnt=-1;
		var i;
		var btn;
	//	btn=valButton(Form.Property_Identified);
	//	btnvalidate=valvalidate();
	
		/*if(Form.Reference_Code1.value=="")
		{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				document.loan_form.confirm.focus();
				return false;
		}
		else if(Form.confirm.checked)
			{
				if(Form.RePhone.value=="")
			{
				alert("Please Re confirm your mobile number again");
				Form.RePhone.focus();
				return false;
			}
			
		}
	}*/
		
		if(Form.Company_Name.value=="")
		{
			alert("Please fill your Company Name.");
			Form.Company_Name.focus();
			return false;
		}
		
	for(i=0; i<Form.Property_Identified.length; i++) 
	{
        if(Form.Property_Identified[i].checked)
		{
    cnt= i;
			}
		}
		if(cnt == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
		 if(cnt ==0)
	{ 
		if(document.loan_form.Property_Loc.selectedIndex==0)
		{
			alert("Plese select city where property is located");
			document.loan_form.Property_Loc.focus();
			return false;}
	}
	

		if (Form.Budget.selectedIndex==0)
			{
				alert("Please estimated market value of the property");
				Form.Budget.focus();
				return false;
			}
		if (Form.Loan_Time.selectedIndex==0)
			{
				alert("Please enter when you are planning to take loan");
				Form.Loan_Time.focus();
				return false;
			}
		return true;
	}	
function valButton5() {
		var cnt = -1;
		var i;
		for(i=0; i<document.loan_form.From_Product1.length; i++) 
		{
			if(document.loan_form.From_Product1[i].checked)
			{
				cnt=i;
				
			}
		}
		if(cnt > -1)
		{ 
			return true;
		}
		else
		{
			return false;
		}
	}            
function submitform(Form)
	{
		var btn2;
		var btn3;
		var myOption;
		var i;
		var btn;
		var btn5;
		if(Form.Reference_Code1.value=="")
			{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				document.loan_form.confirm.focus();
				return false;
		}
		else if(Form.confirm.checked)
			{
				if(Form.RePhone.value=="")
			{
				alert("Please Re confirm your mobile number again");
				Form.RePhone.focus();
				return false;
			}
			
		}
	}
	
	<?if($CC_Holder==1) {?>
		btn2=valButton2();
					if(!btn2)
					{
						alert('you holding credit card from which bank.');
						return false;
					}
				
		
		if (Form.Credit_Limit.selectedIndex==0)
		{
			alert("Please Select Credit Limit");
			Form.Credit_Limit.focus();
			return false;
		}
		<?}
		if($Pancard=="Yes")
		{
			?>
if (Form.Pancard_no.value=='')
		{
			alert("Please enter Pan no.");
			Form.Pancard_no.focus();
			return false;
		}
				<? } ?>
		/*		btn5=valButton5();
	if(!btn5)
		{
			alert('Please select have you applied with any of these banks in last 6 months or not');
				return false;
		}*/
		

		return true;
	}

function submitform2(Form)
	{

var btn2;
	var btn3;
	var myOption;
	var i;
	/*if(Form.Reference_Code1.value=="")
		{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				document.loan_form.confirm.focus();
				return false;
		}
		else if(Form.confirm.checked)
			{
				if(Form.RePhone.value=="")
			{
				alert("Please Re confirm your mobile number again");
				Form.RePhone.focus();
				return false;
			}
			
		}
	}*/
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
	
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;

	}	
	if(!checkNum(Form.Years_In_Company, 'No of years in current company',0))
		return false;

	if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(Form.Total_Experience, 'Total Experience',0))
		return false;

	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}

				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
			return false;
		}
		
return true;
}
function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			     
               
       }

       return true;
}
</script>



<? if(($Type_Loan!="PersonalLoan") && ($Type_Loan!="CreditCard") && ($Type_Loan!="HomeLoan") && $Type_Loan!="BusinessLoan")
{
	if($Type_Loan=="PropertyLoan") 
	{
		$file_name = "Contents_Loan_Against_Property_Mustread.php?product=$Type_Loan";
		header("Location: $file_name");
		exit();
	}
		
	elseif($Type_Loan=="CarLoan") 
	{
		$file_name = "Contents_Car_Loan_Mustread.php?product=$Type_Loan";
		header("Location: $file_name");
		exit();
	}


?>



	<? }
	else{
		?>
<script type="text/javascript" src="scripts/mootools.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style type="text/css">
		/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:175px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #666666;	/* Dark green border */
		background-color:#FFFFFF;	/* White background color */
   		color: #333333;
		text-align:left;
		font-size:11px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:11px;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#3d87d4;
		line-height:20px;
		color:#FFFFFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > Personal Loan</span>


  <div id="txt">	
    <? if($Type_Loan=="PersonalLoan")
		{?>
           
    <? if(($_SESSION['flag']==1) || ($_REQUEST['flag']==1)) {?>
    <form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return submitform2(document.loan_form);">
    <? }
  else {?><form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform2(document.loan_form);">
      <? }?>
      <table width="458" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="middle" style="background-repeat:no-repeat;">&nbsp;</td>
        </tr>
        <tr>
          <td height="74" valign="middle" background="new-images/apl-tp.gif" style="background-repeat:no-repeat;"><h1 >Please Tell more about yourself</h1></td>
      </tr>
        <tr>
          <td class="aplfrm"><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="2">&nbsp;</td>
          </tr>
              <input type="hidden" value="<? echo $Type_Loan; ?>" name="type2">
              <!--  <tr>
       <td class="frmtxt">Activation Code</td>
       <td class="frmtxt"><input type="text" name="Reference_Code1" size="10" maxlength="4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:250;font-weight:none; " ></div></td>
     </tr>
	  <tr>
	 <td colspan="2" class="frmtxt" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
		   if you havent received activation code sms.
  </td>
</tr>
	<tr><td colspan="2" class="frmtxt" id="myDiv" ></td></tr>-->
              <tr>
                <td width="57%" height="35" class="frmtxt"><b>Primary Account in which bank?</b></td>
          <td class="frmtxt" width="43%"><input type="text" name="Primary_Acc"  size="25" maxlength="30" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event);"></td>
        </tr>
              <tr>
                <td height="35" class="frmtxt"><b>Residential Status</b></td>
          <td class="frmtxt"><input type="radio" value="1" name="Residential_Status" style="border:none;" checked>
            Owned
            <input type="radio" value="2" name="Residential_Status" style="border:none;">
            Rented<br />
            <input type="radio" value="3" name="Residential_Status" style="border:none;">
            Company Provided</td>
        </tr>
              <tr>
                <td height="35" class="frmtxt"><b>No. of years in this Company</b></td>
          <td class="frmtxt"><input type="text" name="Years_In_Company" size="25" maxlength="15" value="0"></td>
        </tr>
              <tr>
                <td height="35" class="frmtxt"><b>Total Experience(Years)/<br>
                Total Years in Business</b></td>
          <td class="frmtxt"><input type="text" name="Total_Experience" size="25" maxlength="15" value="0"></td>
        </tr>
              <?if (isset($Card_Vintage)>0)
			{?>
              <tr>
                <td height="35" class="frmtxt"><b><font >Credit Card Limit?</font></b></td>
          <td class="frmtxt"><input size="25"  name="Credit_Limit2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="this.select();" >          </td>
        </tr>
              <? }
						 ?>
              <tr>
                <td class="frmtxt"><b>Any Loan running?</b></td>
          <td class="frmtxt"><input type="radio" value="1"  name="LoanAny" style="border:none;" onClick="addElementLoan();">
            <font >Yes</font>
            <input type="radio" style="border:none;"  name="LoanAny" onClick="removeElementLoan();" value="0" >
            No</td>
        </tr>
              <tr>
                <td colspan="2" id="myDivLoan"></td>
        </tr>
              <tr>
                <td height="35" colspan="2" align="left" ><div style="padding-top:10px;" ><b>Documentation Wizard-</b></div>
        Please share which of the following documents that you have or can arrange , so that we can let you know what more documents are required by each bank.This will help you to choose your Personal Loan Provider better.    </td>
        </tr>
              <tr>
                <td height="25"  align="left" colspan="2" class="frmtxt">Which of the following Documents you Have?</td>
        <tr>
          <tr>
            <td colspan="2" class="frmtxt"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="6%" height="20" align="center" valign="middle"><input type="checkbox" value="Appointment Letter" name="Document_proof[]" id="Document_proof" style="border:none;"/></td>
                <td width="47%" align="left">Appointment Letter </td>
                <td width="6%" align="center" valign="middle"><input type="checkbox" value="Form16" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                <td width="41%" align="left">Form -16</td>
              </tr>
              <tr>
                <td height="20" align="center" valign="middle"><input type="checkbox" value="Latest 3 months salary slip" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                <td align="left">Latest 3 months Salary Slip</td>
                <td width="6%" align="center" valign="middle"><input type="checkbox" value="6 months bank statement" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                <td align="left">6 months Bank Statement</td>
              </tr>
              <!--<tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="6 months Bank Statement" name="income_proof[]" id="income_proof" style="border:none;" /></td>
                            <td colspan="3" align="left">6 months Bank Statement </td>
                          </tr>-->
              <tr>
                <td width="6%" height="20" align="center" valign="middle"><input type="checkbox" value="Pancard" name="Document_proof[]" id="Document_proof"  style="border:none;" /></td>
                <td width="47%" align="left">Pan Card </td>
                <td width="6%" align="center" valign="middle"><input type="checkbox" value="Voterid" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                <td width="41%" align="left">Voter Id </td>
              </tr>
              <tr>
                <td height="20" align="center" valign="middle"><input type="checkbox" value="Passport" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                <td align="left">Passport</td>
                <td align="center" valign="middle"><input type="checkbox" value="Driving License" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                <td align="left">Driving License </td>
              </tr>
              <tr>
                <td height="20" align="center" valign="middle"><input type="checkbox" value="photo" name="identification_proof[]" id="identification_proof"  style="border:none;"/></td>
                <td align="left">Passport size photo </td>
                <td height="20" align="center" valign="middle"><input type="checkbox" value="LIC Policy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                <td align="left">LIC Policy 
                  <tr>
                    <td height="20" align="center" valign="middle"><input type="checkbox" value="Telephone Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                  <td align="left">Telphone Bill </td>
                  <td align="center" valign="middle"><input type="checkbox" value="Electricity Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                  <td align="left">Electricity Bill </td>
                </tr>
              <tr>
                <td height="20" align="center" valign="middle"><input type="checkbox" value="Loan Track" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                      <td align="left">Loan Track </td>
                      <td align="center" valign="middle"><input type="checkbox" value="Credit Card photocopy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                      <td align="left">Credit Card photocopy</td>
                              </tr>
              </table></td>
        </tr>
              <tr>
                <td colspan="2" align="center" valign="middle" ><br />
                <input name="submit" type="submit" class="btnclr" value="Submit" ></td>
       <tr>
         <td height="25">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          </table></td>
      </tr>
        <tr>
          <td width="458" height="26"><img src="new-images/apl-bt.gif" width="458" height="26" /></td>
      </tr>
      </table>
    
 </form>
               
    </td>
    </tr>
        </table>
    <? }
elseif($Type_Loan=="CreditCard")
	{
?>
           
    <tr>
      <td><? if(($_SESSION['flag']==1) || ($_REQUEST['flag']==1)) {?>
        <form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return submitform(document.loan_form);">
        <?  }
else {
	?>
        <form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform(document.loan_form);">
          <? }?>
          <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
            <tr><td><input type="hidden" value="<? echo $Type_Loan; ?>" name="type"></td></tr>
            <tr>
              <td class="frmtxt">Activation Code</td>
           <td class="frmtxt"><input type="text" name="Reference_Code1" size="10" maxlength="4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your card request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute; font-size:10px;width:250px; font-weight:none; left:39%; " ></div></td>
         </tr>
            <tr>
              <td colspan="2" class="frmtxt" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
                if you havent received activation code sms.                </td>
		    </tr>
            <tr><td colspan="2" class="frmtxt" id="myDiv" ></td></tr>
            <?if($CC_Holder==1) { ?>
            <tr>
              <td class="frmtxt" >I have an active credit card from ? </td>
		      <td  class="frmtxt" >
		        <table border="0">
		          <tr>
		            <td class="frmtxt" ><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
				    <td class="frmtxt"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td>
			    <tr>
			      <td class="frmtxt"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="frmtxt"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td>
			    </tr>
		          <tr>
		            <td class="frmtxt"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="frmtxt"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td>
			    </tr>
		          <tr>
		            <td class="frmtxt"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td>
				    <td class="frmtxt"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td>
			    </tr>
		          <tr>
		            <td class="frmtxt" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td>
			    </tr>
		          <tr>
	              <td class="frmtxt"><input type="checkbox" name="From_Product[]" value="Barclays" id="From_Product" class="noBrdr" >Barclays</td><td class="frmtxt"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td></tr>
		          <tr><td colspan="2" class="frmtxt"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</td>
			    </tr>
            </table></td></tr>
            <tr>
              <td class="frmtxt">Credit Card Limit?</td>
		      <td  align="left"  colspan="3" width="240" height="25"><select size="1"  name="Credit_Limit">
		          <option value="0">Please select</option>
		          <option value="1">25000 to 50000</option>
		          <option value="2">50001 to 75000</option>
		          <option value="3">75001 to 1 lakh </option>
		          <option value="4">1 lakh & above</option>
	          </select> </td>
		    </tr>
                   
                   
            <? } ?>
            <!--<tr>
     <td class="frmtxt">Are you a Credit Card Holder of Any Bank?<font size="1" color="#FF0000">*</font></td>
     <td class="frmtxt">
     <input type="radio" value="1"  name="CC_Holder" style="border:none;" onClick="addElement1();">Yes
     <input type="radio" value="0"  name="CC_Holder" style="border:none;" onClick="removeElement1();">No</td>
   </tr>
   <tr><td colspan="4" id="myDiv9"></td></tr>-->
                   
            <!-- <tr>
     <td class="frmtxt">Have you applied with these Banks in last six months?<font size="1" color="#FF0000">*</font> </td>
     <td  class="frmtxt"><table border="0">
	 <tr>
	 <td class="frmtxt"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
	 <td class="frmtxt"><input type="checkbox" class="noBrdr" id="From_Product1" name="From_Product1[]" value="Amex">Amex</td>
	 <td class="frmtxt"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Canara Bank" >Canara Bank</td>
	 </tr>
	 <tr>
	 <td class="frmtxt"><input type="checkbox" name="From_Product1[]" id="From_Product1" class="noBrdr" value="Citi Bank" >Citi Bank</td>
	 <td class="frmtxt"><input type="checkbox" name="From_Product1[]" class="noBrdr" id="From_Product1" value="Deutsche bank">Deutsche Bank</td>
	 <td class="frmtxt"><input type="checkbox"  id="From_Product1" name="From_Product1[]" value="HDFC" class="noBrdr">HDFC</td>
	 </tr>
	 <tr>
	 <td class="frmtxt"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product1[]" id="From_Product1" >HSBC</td>
	 <td class="frmtxt"> <input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="ICICI">ICICI</td>
	 <td class="frmtxt"><input type="checkbox" name="From_Product1[]" value="Standard Chartered"  id="From_Product1" class="noBrdr" >Standard Chartered</td>
	 </tr>
	 <tr>
	 <td class="frmtxt"><input type="checkbox" id="From_Product1" name="From_Product[]" class="noBrdr" value="SBi">SBI</td>
	 <td class="frmtxt"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Others">Others</td>
	<td class="frmtxt"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Barclays">Barclays</td></tr>
		 <tr>
		<td class="frmtxt" colspan="3"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="0">No</td></tr></table></td>
	 </tr>-->
                   
            <tr>
              <td class="frmtxt">Residence No.</td>
		      <td class="frmtxt" align="left"><input type="text"  name="Std_Code" id="Std_Code" size="3" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="std" onBlur="onBlurDefault(this,'std');">
	          <input size="11" type="text"  name="Landline" id="Landline" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
		    </tr>
            <tr>
              <td class="frmtxt">Residence Address</td>
          <td width="70%" class="frmtxt"><textarea name="Residence_Address" id="Residence_Address" cols="20" rows="2"></textarea></td></tr>
            <tr>
              <td class="frmtxt">Pincode</td>
          <td width="70%" class="frmtxt"><input type="text" name="Pincode" id="Pincode" maxlength="6"></td>
	      </tr>
                   
            <tr>
              <td class="frmtxt">Office No.</td>
		      <td  class="frmtxt" align="left"><input type="text"  name="Std_Code_O" id="Std_Code_O" size="3" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="std" onBlur="onBlurDefault(this,'std');">
			        
	          <input size="11" type="text" name="Landline_O" id="Landline_O" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
		    </tr>
            <tr>
              <td class="frmtxt">Office Address</td>
          <td width="70%" class="frmtxt"><textarea name="Office_Address" id="Office_Address" cols="20" rows="2"></textarea></td>
        </tr>
            <?if($Pancard=="Yes")
	{?>
            <tr>
              <td class="frmtxt">Pancard No.</td>
          <td width="70%" class="frmtxt"><input type="text" name="Pancard_no" id="Pancard_no" maxlength="10"></td>
	      </tr>
            <? }?>
                   
                   
            <tr>
              <td colspan="2" align="center" class="frmtxt"><br>
                <input type="submit" class="bluebutton" value="Submit" >
                &nbsp;
              <input type="reset" class="bluebutton" value="Reset" ></td>
       </tr>
          </table>
     </form>        </td>
    </tr>
        </table>
        <? //}
 }

	elseif($Type_Loan=="HomeLoan")
	{?>
    <tr>
      <td>
        <? if(($_SESSION['flag']==1) || ($_REQUEST['flag']==1)) {?>
        <form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return submitform3(document.loan_form);">
        <? } else { ?>
        <form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform3(document.loan_form);">
          <? }?>
          <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
            <tr><td><input type="hidden" value="<? echo $Type_Loan; ?>" name="type"></td></tr>
            <!--<tr>
       <td class="frmtxt">Activation Code</td>
       <td class="frmtxt"><input type="text" name="Reference_Code1" size="10" maxlength="4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:250;font-weight:none; " ></div></td>
     </tr>
	  <tr>
	 <td colspan="2" class="frmtxt" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
		   if you havent received activation code sms.
  </td>
</tr>
<tr><td colspan="2" class="frmtxt" id="myDiv" ></td></tr>-->
            <tr>
              <td class="frmtxt">Company Name</td>
		    <td class="frmtxt"><input size="20" name="Company_Name"></td>
		    </tr>
            <tr>
              <td class="frmtxt">Property Identified</font></td>
		    <td class="frmtxt"><input type="radio"  name="Property_Identified"  style="border:none;"  value="1" onClick="addIdentified();">Yes
		      <input size="10" type="radio" style="border:none;" name="Property_Identified" onClick="removeIdentified();" value="0" >No</td>
		    </tr>
            <tr><td colspan="2" id="myDiv1"></td></tr>
            <tr><td colspan="2" id="myDiv2"></td></tr>
                   
            <tr>
              <td class="frmtxt">Estimated market value of the property?<font size="1" color="#FF0000">*</font></td>
		    <td class="frmtxt"><select name="Budget" >
		      <option value="-1" selected>Please Select</option>
		      <option value="Upto 7 Lakhs">Upto 7 Lakhs </option>
		      <option value="7-15 Lakhs">7-15 Lakhs </option>
		      <option value="15-20 Lakhs">15-20 Lakhs </option>
		      <option value="20-25 Lakhs">20-25 Lakhs </option>
		      <option value="Above 25 Lakhs">Above 25 Lakhs</option></select>		    </td>
	    </tr>
            <tr>
              <td class="frmtxt">When you are planning to take loan?</td>
           <td class="frmtxt"><select name="Loan_Time"  >
             <OPTION value="-1" selected>Please select</OPTION>
             <OPTION value="15 days">15 days</OPTION>
             <OPTION value="1 month">1 months</OPTION>
             <OPTION value="2 month">2 months</OPTION>
             <OPTION value="3 month">3 months</OPTION>
             <OPTION value="3 months above">more than 3 months</OPTION></SELECT>           </td>
         </tr>
            <!--<tr>	
			<td colspan="2" class="frmtxt"><input type="checkbox"  style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank">Get free personal accident insurance from TATA AIG</a></td></tr>-->
                   
                   
                   
            <tr>
              <td colspan="2" align="center" class="frmtxt"><br>
                <input type="submit" class="bluebutton" value="Submit">
                &nbsp;
              <input type="reset" class="bluebutton" value="Reset" ></td>
       </tr>
          </table>
     </form>        </td>
    </tr>
        </table>
           
    <? }
	
		elseif($Type_Loan=="BusinessLoan")
		{?>
           
           
    <tr>
      <td>
        <? if(($_SESSION['flag']==1) || ($_REQUEST['flag']==1)) {?><form name="loan_form" method="post" action="t_y.php?flag=1" onSubmit="return form_business(document.loan_form);">
        <? } 
		 else{ ?>
        <form name="loan_form" method="post" action="t_y.php" onSubmit="return form_business(document.loan_form);">
          <? } ?>
          <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
            <tr><td><input type="hidden" value="BusinessLoan" name="type"></td></tr>
                <tr>
                  <td class="frmtxt" width="40%">Activation Code?                    </td>
		          <td class="frmtxt" width="60%">
		            <input size="10"  maxlength="10" name="Reference_Code1" class="frmtxt" style="float: left" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>			        </td>
		    </tr>
            <tr>
                <td colspan="2" align="left"  class="frmtxt"  ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
                    if you havent received activation code sms                </td>
		    </tr>
            <tr><td colspan="2" id="myDiv" ></td></tr>
             <tr>
               <td class="frmtxt">Name of Co/Business<font size="1" color="#FF0000">*</font></td>
         <td width="70%" class="frmtxt"><input type="text" id="Company_Name"  name="Company_Name" onFocus="this.select();" size="20"  ></td>
     </tr>
            <tr>
              <td class="frmtxt">Type of Company ?</td>
       <td>
         <select size="1"  name="Constitution" >
           <option value="1">Please Select</option> 
           <option value="Individual">Individual</option> 
           <option value="Partnership Firm">Partnership Firm</option>
           <option value="Proprietorship Firm">Proprietorship Firm</option>
           <option value="Public Limited">Public Limited</option>
           <option value="Private Limited">Private Limited</option>
           <option value="Trust">Trust</option>
           <option value="Assosiation">Association</option>
           <option value="Society">Society</option>
           <option value="Others">Others</option>
           </select>       </td>
      </tr>
            <tr>
              <td class="frmtxt">Office Status</td>
         <td class="frmtxt"><input type="radio" value="1" name="Office_Status" style="border:none;" checked>Owned
           <input type="radio" value="2" name="Office_Status" style="border:none;">Rented</td>
       </tr>
            <tr>
              <td class="frmtxt">Residential Status</td>
         <td class="frmtxt"><input type="radio" value="1" name="Residential_Status" style="border:none;" checked>Owned
           <input type="radio" value="2" name="Residential_Status" style="border:none;">Rented</td>
       </tr>
                   
             <tr>
               <td class="frmtxt" >Are you a Credit card holder?</td> <td  class="frmtxt" ><input type="radio"  name="CCbusiness"  style="border:none;"  value="1"  onclick="addElementCC();" >Yes
                       
            <input type="radio" style="border:none;" name="CCbusiness" value="0" onClick="removeElementCC();">No</td></tr>
            <tr><td colspan="2" id="myDivCC"></td></tr>
                   
                   
                   
                <tr>
                  <td  class="frmtxt">Any Loan running?</td>
	            <td  class="frmtxt"  ><input type="radio"  style="border:none;"  value="1"  name="LoanAny" onClick="addElementLoan();">Yes<input size="10" type="radio" style="border:none;"  name="LoanAny" onClick="removeElementLoan();" value="0" >No</td><tr>
            <tr><td colspan="4" id="myDivLoan"></td></tr>
            <tr>
              <td colspan="2" align="center"><input type="submit" class="bluebutton" value="Submit"> 
                &nbsp;
               <input type="reset" class="bluebutton" value="Reset"></td>
	        </tr>
                   <?php 
		if($City=='Delhi' || $City=='Noida'  ||  $City=='Gurgaon'  ||  $City=='Faridabad'  ||  $City=='Gaziabad'  ||  $City_Other=='Faridabad'  ||  $City_Other=='Greater Noida'  ||  $City=='Chennai'  ||  $City=='Mumbai'  ||  $City=='Thane'  ||  $City=='Navi mumbai'  ||  $City=='Kolkata'  ||  $City=='Kolkota'  ||  $City=='Hyderabad'  ||  $City=='Pune'  || $City=='Bangalore')
{
	echo '<tr>	<td colspan="2" class="frmtxt"><input type="checkbox"  style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked >&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank"> Get free personal accident insurance from TATA AIG</a></td></tr>';
} 
  ?>	
                </table>
					    
					<tr><td width="400" colspan="3" height="2">&nbsp;</td></tr>		
					  <tr><td>&nbsp;</td></tr>
					    
					    
					    
					    </table>
    </form>        </td></tr></table>
           
    <? }?>
           
           
           
           
           
    <?}?>
     </div>
  <? //include '~Right2.php';
	//}
 
  ?>
  
         <?php if ($_SESSION['flag']!=1)
	{ 
 include '~Bottom-new.php';?>
         <? }


if($Type_Loan=="CarLoan")
{
$urldetails="http://www.deal4loans.com/Request_Loan_Car_New.php?flag=1";
}
elseif($Type_Loan=="PropertyLoan")
{
$urldetails="http://www.deal4loans.com/Request_Loan_Against_Property_New.php?flag=1";
}
elseif($Type_Loan=="PersonalLoan")
{
$urldetails="http://www.deal4loans.com/Request_Loan_Personal_New.php?flag=1";
}
elseif($Type_Loan=="HomeLoan")
{
$urldetails="http://www.deal4loans.com/Request_Loan_Home_New.php?flag=1";
}
elseif($Type_Loan=="CreditCard")
{
$urldetails="http://www.deal4loans.com/Request_Credit_Card_New.php?flag=1";
}
elseif($Type_Loan=="BusinessLoan")
{
$urldetails="http://www.deal4loans.com/Req_Business_Loan_New.php?flag=1";
}
?>
         <?php if((($_SESSION['flag']==1) || ($_REQUEST['flag']==1)) && (($Type_Loan=="CarLoan")||($Type_Loan=="PropertyLoan")))
	{ ?>
         <img src="http://sify.com/finance/loans/dealforloans/fwrite.php?form=<?php echo $Type_Loan; ?>&userid=<?php echo $EmailID;?>&url=<?php echo $urldetails;?>" width="0" height="0" />
         <? }?>
         <!-- Google Code for lead Conversion Page -->
  <script language="JavaScript" type="text/javascript">
<!--var google_conversion_id = 1063319470;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (1)
{  
	var google_conversion_value = 1;
	}
	var google_conversion_label = "LEAD";
	//-->
	       </script>
  <script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
  <noscript>
    <img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1063319470/?value=1&label=LEAD&script=0">
         </noscript>
</div>
</div>
<? if(!isset($_SESSION['UserType'])) 
  {
 // include '~Right-new1.php';
  }
  ?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>


