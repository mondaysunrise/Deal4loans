<?php
require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		$Full_Name = FixString($Full_Name);
		//$LName = FixString($LName);
		$Name= $Full_Name;
		//$Name = FixString($Name);
		$Email = FixString($Email);
		$Phone = FixString($Phone);
		$City = FixString($City);
		$Reference_Code = generateNumber(4);
		$City_Other = FixString($City_Other);
		//echo "city::".$City_Other;
		$Pincode = FixString($Pincode);
		$Industry = FixString($Industry);
		//$Constitution = FixString($Constitution);
		$Year_Of_Establishment = FixString($Year_Of_Establishment); 
		$Net_Salary =FixString($Net_Salary);
		$Loan_Amount =FixString($Loan_Amount);
		$IsPublic =1;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Type_Loan = FixString($Type_Loan);
		$source = FixString($source);
		$Reference_Code = FixString($Reference_Code);
		$Annual_Turnover = FixString($Annual_Turnover);
		//$Company_Name = FixString($Company_Name);
		$Std_Code = FixString($Std_Code);
		$Landline = FixString($Landline);
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];
		
	if($_SESSION=="")
		{
			$_SERVER['Temp_Type'] = "BusinessLoan";
			$_SESSION['Temp_Type_Loan']="Req_Business_Loan";
			$_SERVER['Temp_Name'] = $Name;
			$_SERVER['Temp_FName'] = $Name;
			$_SERVER['Temp_Phone'] = $Phone;
			$_SERVER['Temp_Phone1'] = $Phone1;
			$_SERVER['Temp_DOB'] = $DOB;
			$_SERVER['Temp_Reference_Code'] = $Reference_Code;
			$_SERVER['Temp_Message'] = $Message;
			$_SERVER['Temp_Message1'] = $Message1;
			$_SERVER['Temp_Flag'] = "0";
			$_SERVER['Temp_Email'] = $Email;
			$_SERVER['Temp_Email_New'] = $Email_New;
			$_SERVER['Temp_Item_ID'] = $Item_ID;
			$_SERVER['Temp_Name_New'] = $Name_New;
			$_SERVER['Temp_Flag_Message'] = "0";
			$_SERVER['Temp_Company_Name'] = $Company_Name;
			$_SERVER['Temp_City'] = $City;
			$_SERVER['Temp_City_Other'] = $City_Other;
			$_SERVER['Temp_Net_Salary'] = $Net_Salary;
			$_SERVER['Temp_IsPublic'] = $IsPublic;
		}
	else
		{
			$_SESSION['Temp_Type'] = "BusinessLoan";
			$_SESSION['Temp_Type_Loan']="Req_Business_Loan";
			$_SESSION['Temp_Name'] = $Name;
			$_SESSION['Temp_FName'] = $Name;
			$_SESSION['Temp_Phone'] = $Phone;
			$_SESSION['Temp_Phone1'] = $Phone1;
			$_SESSION['Temp_Std_Code1'] = $Std_Code1;
			$_SESSION['Temp_DOB'] = $DOB;
			$_SESSION['Temp_Reference_Code'] = $Reference_Code;
			$_SESSION['Temp_Message'] = $Message;
			$_SESSION['Temp_Message1'] = $Message1;
			$_SESSION['Temp_Flag'] = "0";
			$_SESSION['Temp_Email'] = $Email;
			$_SESSION['Temp_Email_New'] = $Email_New;
			$_SESSION['Temp_Item_ID'] = $Item_ID;
			$_SESSION['Temp_Name_New'] = $Name_New;
			$_SESSION['Temp_Flag_Message'] = "0";
			$_SESSION['Temp_Company_Name'] = $Company_Name;
			$_SESSION['Temp_City'] = $City;
			$_SESSION['Temp_City_Other'] = $City_Other;
			$_SESSION['Temp_Net_Salary'] = $Net_Salary;
			$_SESSION['Temp_IsPublic'] = $IsPublic;
		}

		$crap = " ".$Name." ".$Email." ".$Company_Name;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		if($crapValue=='Put')
		{
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
			if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{		
			$sql = "INSERT INTO Req_Business_Loan (UserID, Name, Email, Mobile_Number, City, City_Other, Pincode, Industry , Year_Of_Establishment, Net_Salary, Loan_Amount, DOB, Dated, source, Reference_Code, Annual_Turnover, Std_Code, Landline,Referrer, Creative, Section)
			VALUES ( '','$Name', '$Email', '$Phone', '$City', '$City_Other', '$Pincode', '$Industry' , '$Year_Of_Establishment','$Net_Salary', '$Loan_Amount', '$DOB', Now(), '$source', '$Reference_Code', '$Annual_Turnover', '$Std_Code', '$Landline','$Referrer', '$Creative', '$Section' )";
				if($Email=="")
					{
						echo "<script language=javascript>"."location.href='thank_businessloan.php'"."</script>";
					}
						
			$Email_New = $Email;
			$Name_New = $Name;
			if(isset($_SESSION['UserType'])) 
			{
				$UName = $_SESSION['UName'];
				$sqlquery = "Select *  from wUsers where UserID='".$UserID."'";
				$result = ExecQuery($sqlquery);
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) 
				{
					do
					{
						$Email_New=$myrow["Email"];
					}while ($myrow = mysql_fetch_array($result));
				}
					mysql_free_result($result);
			}
	
			$Email = trim($Email);
			$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
			$msgUserDoesNotExist = "Email does not exists in the database";
			$result = ExecQuery($query);
			$rows = mysql_num_rows($result);		
			echo mysql_error();
	
			
			if ($myrow = mysql_fetch_array($result)) 
			{
				do
				{
					$_SESSION['Temp_Flag_Message'] = "1";
					$_SESSION['Temp_Flag'] = "1";
					$_SESSION['Temp_UserID'] = $myrow["UserID"];
				}while ($myrow = mysql_fetch_array($result));
				mysql_free_result($result);
						
				$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
				$res_user=ExecQuery($qry_user);
				$row_user=mysql_fetch_array($res_user);
				$UserID1=$row_user["UserID"];
				
				$sql = "INSERT INTO Req_Business_Loan (UserID, Name, Email, Mobile_Number, City, City_Other, Pincode, Industry , Year_Of_Establishment, Net_Salary, Loan_Amount, DOB, Dated, source, Reference_Code, Annual_Turnover, Std_Code, Landline,Referrer, Creative, Section )
				VALUES ( '$UserID1', '$Name', '$Email', '$Phone', '$City', '$City_Other', '$Pincode', '$Industry' , '$Year_Of_Establishment','$Net_Salary', '$Loan_Amount', '$DOB', Now(), '$source', '$Reference_Code', '$Annual_Turnover', '$Std_Code', '$Landline','$Referrer', '$Creative', '$Section' )";
				
				$result = ExecQuery($sql);
				$Lid = mysql_insert_id();
				$_SESSION['Temp_LID'] = $Lid;
				$SMSMessage = "Dear $Full_Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
				if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
				echo "<script language=javascript>"."location.href='thank_businessloan.php'"."</script>";
								
			}
			
			else
			{
				$_SESSION['Temp_Flag_Message'] = "1";
				
				$result = ExecQuery($sql);
				$Lid = mysql_insert_id();
				$_SESSION['Temp_LID'] = $Lid;
				$strDir = dir_name();
	
				if($Email!="")
				{
					echo "<script language=javascript>"."location.href='thank_businessloan.php"."</script>"; 
							echo mysql_error();
				}
			}
				echo mysql_error();
	
			if ($result == 1 && isset($_SESSION['UserType']))
			{
				$Msg = getAlert("Your request has been added. !!", TRUE, "thank_businessloan.php");
			}
			
			}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL = "http://businessloan.deal4loans.com/".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
		}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
    }

	///////////////////////////////////////////////////////////////////////////////////////////
	if($_SESSION=="")
		{
		$EmailID = $_SERVER['Temp_Email'];
		$Name = $_SERVER['Temp_Name'];
		$Card_Vintage = $_SERVER['Temp_Card_Vintage']; 
		$City = $_SERVER['Temp_City'];
		$Type_Loan = $_SERVER['Temp_Type'];
		$Name_New = $_SERVER['Temp_Name_New'];
		$Net_Salary_Monthly = $_SERVER['Temp_Net_Salary_Monthly'];
		$Net_Salary = $_SERVER['Temp_Net_Salary'];
		$Item_ID = $_SERVER['Temp_Item_ID'];
		$Flag_Message = $_SERVER['Temp_Flag_Message'];
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

	$Name = $Fname." ".$LName;
	$Email = $EmailID;


$result = ExecQuery("select IsPublic from wUsers where Email='$EmailID' ");
echo mysql_error();
	$num_rows = mysql_num_rows($result);

	if($num_rows > 0)
	{
		mysql_free_result($result);
		$Msg = "** User with this email id already exists. !! ";
	}
	else
	{
		$sql = "INSERT INTO wUsers (Email,FName,LName,Phone,DOB,Join_Date,Last_Login,Count_Requests,IsPublic) VALUES ('$EmailID','$Name','$LName','$Phone','$DOB',Now(),Now(),0,'$IsPublic')";
		$result = mysql_query($sql);
			
		if($Type_Loan=="Req_Business_Loan")
		{
		$SMSMessage = "Dear $Name,Thanks for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.Activation code: $Reference_Code";
		if(strlen(trim($Phone)) > 0)
		SendSMS($SMSMessage, $Phone);
		}
		
		else
			{
		$SMSMessage = "Dear $Name,Thank you for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.";
			if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
			}
	}

//Code Added to mailtocommonscript.php
			$Checktosend="getUser_Register_New";
					include "scripts/mailatcommonscript.php";

					$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if(isset($Type_Loan))
					{
						mail($EmailID,'Welcome to Deal4loans - '.$Name, $Message2, $headers);
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

							
							$sub_sql = ExecQuery("Update Req_Business_Loan SET UserID=".$UserID." Where Email='".$EmailID."'");

						mysql_free_result($sub_sql);

					}

				}

				

				/* Dump Resultset */




			}
				//mysql_free_result($result);
			/*if(($Type_Loan!="Req_Business_Loan") ){
				session_unset();
		}
				$Msg = getAlert("Congratulations!!! You have become our Registred User Now. Click OK to Continue !!", TRUE, "Login.php");

				}*/

			
	/////////////////////////////////////////////////////////////////////////////////////////
?>
<!--<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>-->
<html>
<head>
<link href="css/businessstyle.css" rel="stylesheet" type="text/css" />
<script>

function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		 var newdivCC = document.createElement('div');
		
		//if(ni.innerHTML=="")
		//{
		
			
				ni.innerHTML = '<table border="0"><tr>	 <td align="left"  class="formtxt">Cards held since?</td>		<td  align="left"  class="formtxt" colspan="3"><select size="1" name="Card_Vintage" id="Card_Vintage"><option value="0">Please select</option> <option value="1">Less than 6 months</option>	 <option value="2">6 to 9 months</option>	 <option value="3">9 to 12 months</option>	 <option value="4">more than 12 months</option>	 </select> </td></tr><tr><td align="left" class="formtxt" width="230" height="20">Credit Card Limit?</td> <td align="left" colspan="3" width="270" height="20"><input size="18" class="formtxt" name="Credit_Limit" id="Credit_Limit"  onFocus="this.select();" style="float: left"></td></tr></table>';
				

			
		//}
		ni.appendChild(newdivCC);
		//return true;

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
function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		 var newdivloan = document.createElement('div');
		//if(ni.innerHTML=="")
		//{
		
			
				ni.innerHTML = '<table border="0" width="100%"><tr> <td align="left"  class="formtxt">Any type of loan(s) running? </td> <td colspan="3"  class="formtxt"><table border="0">	 <tr><td  class="formtxt"" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td  class="formtxt" width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20"  class="formtxt"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td  class="formtxt" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="formtxt" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td  class="formtxt"width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  class="formtxt">How many EMI paid?  </td>   <td  class="formtxt"colspan="3" align="left" width="300" height="18" ><select name="EMI_Paid"  style="float: left"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option> </select>  </td>	</tr></table>';
			
		//}
		ni.appendChild(newdivloan);
		//return true;
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


function form_business(Form)
{

var btn;
var btn2;
var myOption;
var myLoanOption;

if(Form.Reference_Code1.value=="")
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
		}
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
function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.businessloan_form.Loan_Any.length; i++) 
	{
        if(document.businessloan_form.Loan_Any[i].checked)
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
    for(i=0; i<document.businessloan_form.From_Product.length; i++) 
	{
        if(document.businessloan_form.From_Product[i].checked)
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


/*function addElement() {
  var ni = document.getElementById('myDiv');
 
  var newdiv = document.createElement('div');
 
  newdiv.innerHTML = '<input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; name="RePhone" id="RePhone">';
 // newdiv.innerHTML = 'Element Number '+num+' has been added! <a href=\'#\' onclick=\'removeElement('+divIdName+')\'>Remove the div "'+divIdName+'"</a>';
  ni.appendChild(newdiv);
}
/*function removeElement(divNum) {
  //var d = document.getElementById('myDiv');
  var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;
 // d.removeChild(olddiv);
}*/


 function addElement()
{
	
		var ni = document.getElementById('myDiv');
		 var newdiv = document.createElement('div');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0"><tr><td align="left" class="formtxt" width="200" height="20">Reconfirm Mobile No.</td>	<td colspan="3" align="left" width="300" height="20" ><input size="18" type="text"  maxlength="10"   name="RePhone" id="RePhone"></td></tr></table>';
			
			ni.appendChild(newdiv);
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
		}


</script>
</head>

<body>
 <form name="businessloan_form" method="post" action="t_y.php" onSubmit="return form_business(document.businessloan_form);">
<table width="1000" border="0" align="center" cellpadding="0"  bgcolor="#5E88AD"cellspacing="0">
  <tr>
    <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="209" height="155" align="left" valign="top"><img src="images/header-left.jpg" width="209" height="155" /></td>
            <td width="183" align="left" valign="top"><img src="images/header-middle.gif" width="183" height="155" /></td>
            <td width="208" align="left" valign="top"><img src="images/header-logo.gif" width="208" height="155" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="259" align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#5E88AD">
              <tr>
                <td width="259" align="left" valign="top"><img src="images/easy-step.gif" width="265" height="115" /></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top" bgcolor="#80A9DB"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="45" align="right" valign="bottom" style="padding-top:3px;"><img src="images/lgt-wht-arrow.gif" width="8" height="5" /></td>
                                                <td width="215" height="31" valign="top" class="heading_bl">Post your Loan requirement.</td>
                                              </tr>
											  <tr><td colspan="2" height="2">&nbsp;</td></tr>
                                              <tr>
                                                <td width="45" height="100%" align="right" valign="bottom" style="padding-bottom:2px;"><span style="padding-top:3px;"><img src="images/lgt-wht-arrow.gif" width="8" height="5" /></span></td>
                                                <td height="29" class="heading_bl">Get &amp; compare Loan offers.</td>
                                              </tr>
											  <tr><td colspan="2" height="2">&nbsp;</td></tr>
                                              <tr>
                                                <td width="45" height="100%" align="right" valign="middle"  style="padding-top:8px;"><span style="padding-top:3px;"><img src="images/lgt-wht-arrow.gif" width="8" height="5" /></span></td>
                                                <td height="44" class="heading_bl">Get the best deal for your Loan requirement.</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="26" align="left" valign="bottom"><img src="images/blue-left-bot.gif" width="8" height="8" /></td>
                      </tr>
                    </table></td>
                    <td width="5" valign="top" background="images/lgt-blu-bg.gif" bgcolor="#80A9DB">&nbsp;</td>
                  </tr>
                  
                </table></td>
              </tr>
              <tr>
                <td valign="top" bgcolor="#5E88AD"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
                        <tr>
                          <td height="97" valign="top" style="padding-top:18px;"><p style="font-family:Verdana, Arial, Helvetica, sans-serif;
						font-size:14px; font-weight:bold; color:#FFFFFF; margin-bottom:6px;">www.deal4loans.com</p><p style="font-family:Verdana, Arial, Helvetica, sans-serif;
						font-size:10px; color:#000000; margin-bottom:4px;">
                            The one-stop shop for best on all Business loan requirements Now get offers from ICICI, HDFC, Deutsche, Citibank, HSBC, Kotak, Standard Chartered and IDBI and choose the best deal!</p></td>
                          <td width="5" valign="top" background="images/drk-blu-bg.gif" >&nbsp;</td>
                        </tr>
                        
                        <tr>
                          <td height="71" align="center" valign="middle"><img src="images/advantage.gif" width="225" height="71" /></td>
                          <td width="5" align="center" valign="middle" background="images/drk-blu-bg.gif">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="4%" align="left" valign="bottom" style="padding-top:3px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                                <td width="96%" height="18" valign="top" class="heading_bl">Simplifies cash flow management</td>
                              </tr>
                              <tr>
                                <td align="left" valign="bottom" style="padding-bottom:2px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                                <td height="23" class="heading_bl">inancial Flexibility</td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="padding-top:12px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                                <td height="22" valign="bottom" class="heading_bl">Ownership retention<br /></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="padding-top:12px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                                <td height="34" class="heading_bl">Extra resource that can be used in any sector of the business where needed.</td>
                              </tr>
                              <tr>
                                <td align="left" valign="bottom" style="padding-bottom:3px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                                <td height="23" class="heading_bl">Easy access money </td>
                              </tr>
                          </table></td>
                          <td width="5" align="left" valign="top" background="images/drk-blu-bg.gif">&nbsp;</td>
                        </tr>
                    </table></td>
              </tr>
              <tr>
                <td align="center" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#5E88AD">
                      <tr>
                        <td height="52" align="center" valign="bottom" ><img src="images/type-loan.gif" width="244" height="24" /></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top"  style="padding:0px 5px;"><p style="font-family:Verdana, Arial, Helvetica, sans-serif;
						font-size:10px; color:#000000; margin-bottom:4px;">Business loan is an unsecured loan offered to self-employed individuals including proprietors, partnership, private, public ltd cos. on the basis of their turnover &amp; ITR filed for last two years. Types of Business Loan:</p></td>
                      </tr>
                    </table></td>
                    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5" height="35" background="images/drk-blu-bg.gif">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="5" height="20" align="left" valign="top"><img src="images/drk-bot-corn.gif" width="5" height="20" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              
              <tr>
<td align="left" valign="top"><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="4%" align="left" valign="top" style="padding-top:18px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                    <td width="96%" height="26" align="left" valign="top" class="heading_bl">Secured business loan<br /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="bottom" style="padding-bottom:2px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                    <td height="23" class="heading_bl">Unsecured Business Loan<br /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" style="padding-top:12px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                    <td height="24" valign="bottom" class="heading_bl">Short-term Business loans <br /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" style="padding-top:12px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                    <td height="24" class="heading_bl">Intermediate Business loans <br /></td>
                  </tr>
                  <tr>
                    <td align="left" valign="bottom" style="padding-bottom:3px;"><img src="images/whit-arrow.gif" width="8" height="5" /></td>
                    <td height="22" class="heading_bl">Long-term Business</td>
                  </tr>
                </table></td>              </tr>
              <tr>
                <td height="38" align="right" valign="top"><img src="images/know-more.gif" width="113" height="32" /></td>
              </tr>
              
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="500" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="21" height="35" align="left" valign="top"><img src="images/top-left-form.jpg" width="21" height="35" /></td>
                        <td background="images/top-form-bg.gif">&nbsp;</td>
                        <td width="19" align="right"><img src="images/form-right-top.jpg" width="19" height="35" /></td>
                      </tr>
                      <tr>
                        <td height="548" background="images/form-left-bg.gif">&nbsp;</td>
                        <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="30" align="center" valign="middle"><b style="font-size:18px; color:#333333;">Business Loan Request</b></td>
                          </tr>
                          <tr>
                            <td height="30" align="center" valign="bottom"><b>Step 2 of 2</b></td>
                          </tr>
                          <tr>
                            <td height="60" align="center" valign="middle"><b>Please tell more about yourself</b></td>
                          </tr>
                          <tr>
                            <td><table width="100%" cellpadding="0" cellspacing="5" border="0">

 <tr><td><input type="hidden" value="BusinessLoan" name="type"></td></tr>
				<tr>
				    <td width="230" height="30" align="left"  class="formtxt" >Activation Code? 	  </td>
				   <td width="124" height="18" colspan="3" align="right"><input size="10"  maxlength="4" name="Reference_Code1" id="Reference_Code1"  class="formfield" ></td>
				</tr>

				<tr>
				    <td colspan="4" align="left"  class="formtxt"  height="30" ><input   type="checkbox"  name="confirm"  value="hello" id="validate" onClick="addElement();" > if you havent received activation code sms				  </td>
				</tr>
					<tr><td colspan="4"><div id="myDiv"></div></td></tr>
			 <tr> 
                         <td  class="formtxt">Name of Co/Business<font size="1" color="#FF0000">*</font></td>
                            <td ><input type="text" id="Company_Name"  name="Company_Name" size="18" class="formfield"></td>
                </tr>
				<tr> 
						<td class="formtxt">Type of Company 
						  ?<font size="1" color="#FF0000">*</font></td>
						<td> <select size="1"  name="Constitution" >
							<option value="1">Please Select</option>
							<option value="Individual">Individual</option>
							<option value="Partnership Firm">Partnership 
							Firm</option>
							<option value="Proprietorship Firm">Proprietorship 
							Firm</option>
							<option value="Public Limited">Public 
							Limited</option>
							<option value="Private Limited">Private 
							Limited</option>
							<option value="Trust">Trust</option>
							<option value="Assosiation">Association</option>
							<option value="Society">Society</option>
							<option value="Others">Others</option>
						  </select> </td>
                        </tr>
						  <tr>
     <td class="formtxt">Office Status</td>
     <td class="formtxt"><input type="radio" value="1" name="Office_Status" class="NoBrdr" checked>Owned
     <input type="radio" value="2" name="Office_Status" class="NoBrdr">Rented</td>
   </tr>
   <tr>
     <td class="formtxt">Residential Status</td>
     <td class="formtxt"><input type="radio" value="1" name="Residential_Status" class="NoBrdr" checked>Owned
     <input type="radio" value="2" name="Residential_Status" class="NoBrdr">Rented</td>
   </tr>
				<!--<tr>
                   <td align="left" class="formtxt" height="30">Type of Company</td>
				   <td height="20" colspan="3" align="right"  ><input type="text" name="Types_Of_Company" class="formfield" size="18" maxlength="15"></td>
				   </tr>-->
				 <tr>
                   <td align="left"  class="formtxt" height="30">Are you a Credit Holder? <font size="1" color="#FF0000">*</font></td>
				   <td class="formtxt" align="left" colspan="3" height="20"><table>
				     <tr>
				       <td class="formtxt"><input type="radio" value="1" name="CCbusiness"  onclick="addElementCC();"> Yes</td>
				       <td class="formtxt"><input type="radio" value="0" name="CCbusiness" onClick="removeElementCC();">
				         No</td>
				       </tr>
				  
				     </table></td>
				   </tr> <tr><td colspan="4" id="myDivCC"></td></tr>

					<tr>
                   <td align="left"  class="formtxt" height="30">Any Loan running?<font size="1" color="#FF0000">*</font> </td>
				   <td class="formtxt" align="left" colspan="3" height="20"><table>
				     <tr>
				       <td class="formtxt"><input type="radio" value="1" name="LoanAny"   onClick="addElementLoan();"/>
				         Yes</td>
				       <td class="formtxt"><input type="radio" value="0" name="LoanAny" onClick="removeElementLoan();">
				         No</td>
				       </tr>
				     </table></td>
				   </tr>
					
				<tr><td colspan="4"><div id="myDivLoan"></div></td></tr>
				<?php 
		if($City=='Delhi' || $City=='Noida'  ||  $City=='Gurgaon'  ||  $City=='Faridabad'  ||  $City=='Gaziabad'  ||  $City_Other=='Faridabad'  ||  $City_Other=='Greater Noida'  ||  $City=='Chennai'  ||  $City=='Mumbai'  ||  $City=='Thane'  ||  $City=='Navi mumbai'  ||  $City=='Kolkata'  ||  $City=='Kolkota'  ||  $City=='Hyderabad'  ||  $City=='Pune'  || $City=='Bangalore')
{
	
	
	echo '<tr>	<td colspan="4" class="formtxt"><input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" >&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank"  class="formtxt"> Get free personal accident insurance from TATA AIG</a></td></tr>';
 
  } 
  ?>       
				     <tr>
                        <td height="50" colspan="4" align="center" valign="bottom" style="padding-right:20px;">
						<input name="submit" type="submit" value="submit" />
						<!--<input name="image" type="image" src="images/submit-bttn.gif"  img="img" /> --></td>
                      </tr></form>

			
								</table></td>
                          </tr>
                        
                          
                        </table></td>
                        <td background="images/form-right-bg.gif">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="21" height="20" align="left" valign="top"><img src="images/form-left-bot.jpg" width="21" height="20" /></td>
                        <td background="images/bot-form-bg.gif">&nbsp;</td>
                        <td width="19" height="20" valign="top"><img src="images/form-bot-right.jpg" width="19" height="20" /></td>
                      </tr>
                      
                    </table></td>
                  </tr>
                  
                </table></td>
              </tr>
              <tr>
                <td height="73" align="center" valign="middle" bgcolor="#2E5C94"><img src="images/over.gif" width="246" height="46" /></td>
              </tr>
              <tr>
                <td height="155" bgcolor="#80A9DB"  ><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" style="padding-top:57px;"><table width="86%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td bgcolor="#80A9DB" align="justify"><p style="font-family:Verdana, Arial, Helvetica, sans-serif;
						font-size:10px; color:#000000; margin-bottom:4px;">I was very confused for which bank to approach for my Business Loan requirement. But I got hassle free comparison by applying on Deal4loans.com</p><br />
            <br />
            <b style="float:right; color:#000000;">-Mr.Soham Das</b><br /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="37" align="left" valign="bottom"><img src="images/blue-left-bot.gif" width="8" height="8" /></td>
  </tr>
</table>
</td>
              </tr>
            </table></td>
          </tr>
          
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- Google Code for Lead Conversion Page -->

<script language="JavaScript" type="text/javascript">

<!--

var google_conversion_id = 1056387586;

var google_conversion_language = "en_US";

var google_conversion_format = "1";

var google_conversion_color = "ffffff";

if (1) {

  var google_conversion_value = 1;

}

var google_conversion_label = "lead";

//-->

</script>

<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">

</script>

<noscript>

<img height="1" width="1" border="0" src="http://www.googleadservices.com/pagead/conversion/1056387586/?value=1&amp;label=lead&amp;script=0">

</noscript>
<SCRIPT language="JavaScript" type="text/javascript">
<!-- Yahoo!
window.ysm_customData = new Object();
window.ysm_customData.conversion = "transId=,currency=,amount=";
var ysm_accountid  = "135AHO229GAA5G7GKVUE46C65OO";
document.write("<SCR" + "IPT language='JavaScript' type='text/javascript' " 
+ "SRC=//" + "srv1.wa.marketingsolutions.yahoo.com" + "/script/ScriptServlet" + "?aid=" + ysm_accountid 
+ "></SCR" + "IPT>");
// -->
</SCRIPT>
</body>
</html>
