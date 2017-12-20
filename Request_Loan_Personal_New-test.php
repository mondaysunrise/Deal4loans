<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$retrivesource = $_SESSION['source'];
    $page_Name = "PersonalLoan";
	

	  if ($_REQUEST['flag']==1 || $_SESSION['flag']==1)
		{
			$source="partner1";
		}
		
	$Msg = "";
	$Item_ID = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		$Full_Name = FixString($Full_Name);
		//$LName = FixString($LName);
		$Name=$Full_Name;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Pincode = FixString($Pincode);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Phone1 = FixString($Phone1);
		//$Phone2 = FixString($Phone2);
		$Std_Code1 = FixString($Std_Code1);
		$Card_Vintage = FixString($Card_Vintage);
		$Reference_Code = generateNumber(4);
		$Email = FixString($Email);
		$Item_ID = FixString($Item_ID);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$From_Product = $_REQUEST['From_Product'];
		$City_Other = FixString($City_Other);
		//$Years_In_Company = FixString($Years_In_Company);
		//$Total_Experience = FixString($Total_Experience);
		$Net_Salary = FixString($Net_Salary);
		//$Contact_Time = FixString($Contact_Time);
		$Net_Salary_Monthly = $Net_Salary / 12;
		$IsPublic = 1;

		$n       = count($From_Product);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
			
if($_SESSION=="")
		{
			$_SERVER['Temp_Type'] = "PersonalLoan";
			$_SERVER['Temp_Card_Vintage'] = $Card_Vintage;
			$_SERVER['Temp_Name'] = $Full_Name;
			$_SERVER['Temp_FName'] = $Full_Name;
			//$_SERVER['Temp_LName'] = $LName;
			$_SERVER['Temp_Phone'] = $Phone;
			$_SERVER['Temp_Phone1'] = $Phone1;
			//$_SERVER['Temp_Phone2'] = $Phone2;
			$_SERVER['Temp_Std_Code1'] = $Std_Code1;
			//$_SERVER['Temp_Std_Code2'] = $Std_Code2;
			$_SERVER['Temp_DOB'] = $DOB;
			$_SERVER['Temp_Reference_Code'] = $Reference_Code;
			$_SERVER['Temp_Message'] = $Message;
			$_SERVER['Temp_Message1'] = $Message1;
			$_SERVER['Temp_Flag'] = "0";
			$_SERVER['Temp_Email'] = $Email;
			$_SERVER['Temp_Email_New'] = $Email_New;
			$_SERVER['Temp_Net_Salary_Monthly'] = $Net_Salary_Monthly;
			$_SERVER['Temp_Item_ID'] = $Item_ID;
			$_SERVER['Temp_Name_New'] = $Name_New;
			$_SERVER['Temp_Flag_Message'] = "0";
			$_SERVER['Temp_Company_Name'] = $Company_Name;
			$_SERVER['Temp_City'] = $City;
			$_SERVER['Temp_City_Other'] = $City_Other;
			$_SERVER['Temp_Employment_Status'] = $Employment_Status;
			$_SERVER['Temp_Net_Salary'] = $Net_Salary;
			//$_SERVER['Temp_Marital_Status'] = $Marital_Status;
			$_SERVER['Temp_CC_Holder'] = $CC_Holder;
			//$_SERVER['Temp_Loan_Amount'] = $Loan_Amount;
			$_SERVER['Temp_IsPublic'] = $IsPublic;
		}
		else
			{
				$_SESSION['Temp_Type'] = "PersonalLoan";
				$_SESSION['Temp_Card_Vintage'] = $Card_Vintage;
				$_SESSION['Temp_Name'] = $Full_Name;
				$_SESSION['Temp_FName'] = $Full_Name;
				//$_SESSION['Temp_LName'] = $LName;
				$_SESSION['Temp_Phone'] = $Phone;
				$_SESSION['Temp_Phone1'] = $Phone1;
				//$_SESSION['Temp_Phone2'] = $Phone2;
				$_SESSION['Temp_Std_Code1'] = $Std_Code1;
				//$_SESSION['Temp_Std_Code2'] = $Std_Code2;
				$_SESSION['Temp_DOB'] = $DOB;
				$_SESSION['Temp_Reference_Code'] = $Reference_Code;
				$_SESSION['Temp_Message'] = $Message;
				$_SESSION['Temp_Message1'] = $Message1;
				$_SESSION['Temp_Flag'] = "0";
				$_SESSION['Temp_Email'] = $Email;
				$_SESSION['Temp_Email_New'] = $Email_New;
				$_SESSION['Temp_Net_Salary_Monthly'] = $Net_Salary_Monthly;
				$_SESSION['Temp_Item_ID'] = $Item_ID;
				$_SESSION['Temp_Name_New'] = $Name_New;
				$_SESSION['Temp_Flag_Message'] = "0";
				$_SESSION['Temp_Company_Name'] = $Company_Name;
				$_SESSION['Temp_City'] = $City;
				$_SESSION['Temp_City_Other'] = $City_Other;
				$_SESSION['Temp_Employment_Status'] = $Employment_Status;
				$_SESSION['Temp_Net_Salary'] = $Net_Salary;
				//$_SESSION['Temp_Marital_Status'] = $Marital_Status;
				$_SESSION['Temp_CC_Holder'] = $CC_Holder;
				//$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
				$_SESSION['Temp_IsPublic'] = $IsPublic;
			}

		//$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
		
		$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
	
			//SQL Query
			/*if(isset($_SESSION['UserType'])) 
			{
					$sql = "INSERT INTO Req_Loan_Personal (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Years_In_Company, Total_Experience, Net_Salary, Marital_Status, Residential_Status, Vehicles_Owned, CC_Holder, Loan_Amount, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Contact_Time, Pincode, Reference_Code, source)	VALUES ( '$UserID', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Std_Code2', '$Phone2', '$Years_In_Company', '$Total_Experience', '$Net_Salary', '$Marital_Status', '$Residential_Status', '$Vehicles_Owned', '$CC_Holder', '$Loan_Amount', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Contact_Time', '$Pincode', '$Reference_Code', '$source')"; 
			}
	
			else 
			{*/
					$sql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Pincode, Reference_Code, source, CC_Bank, Card_Vintage)
						VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Pincode', '$Reference_Code','$source','$From_Pro','$Card_Vintage')"; 
				//echo "QUERY!: ".$sql;
			//	exit();
				if($Email=="")
				{
					if ($_REQUEST['flag']==1)
						{ 
					echo "<script language=javascript>"." location.href='User_Register_New.php?flag=1'"."</script>";
						}
						else
					{
							echo "<script language=javascript>"." location.href='User_Register_New.php'"."</script>";
					}
				}
				
			//}
			
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
						//$Name_New=$myrow["FName"];
					}while ($myrow = mysql_fetch_array($result));
				}
					mysql_free_result($result);
			}
	
			$Email = trim($Email);
			$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			//echo $query."kk";
			$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
			$msgUserDoesNotExist = "Email does not exists in the database";
			$result = ExecQuery($query);
			$rows = mysql_num_rows($result);		
			echo mysql_error();
	
			/*if(isset($_SESSION['UserType']))
			{
				$result = ExecQuery($sql);
				$rows = mysql_num_rows($result);
				$sqltest = ExecQuery("Select RequestID from Req_Loan_Personal order by RequestID desc limit 1");
				echo mysql_error();
				if ($myrow = mysql_fetch_array($sqltest)) 
				{
					$Item_ID = $myrow["RequestID"];
					$_SESSION['Temp_Item_ID'] = $Item_ID;
				}
				mysql_free_result($sqltest);
				$SMSMessage = "Dear $FName,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
				if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
				
				//getEligibleBidders("personal","$City","$Phone");
				
				if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
						{ 
				$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "User_Register_New.php?flag=1");
						}
						else
				{
							$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "User_Register_New.php");
				}
				echo $Msg;
				echo mysql_error();
			}
					
			else*/
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
				list($recordcount,$row_user)=MainselectfuncNew($qry_user,$array = array());
				$cntr=0;

				
				//$res_user=ExecQuery($qry_user);
				//$row_user=mysql_fetch_array($res_user);
				$UserID1=$row_user[$cntr]["UserID"];
				
				//$sql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Pincode, Reference_Code, source, CC_Bank, Card_Vintage) VALUES ('$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Pincode', '$Reference_Code', '$source','$From_Pro','$Card_Vintage' )";
				
				$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Pincode"=>$Pincode, "Reference_Code"=>$Reference_Code, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage);
$table = 'Req_Loan_Personal';
$insert = Maininsertfunc ($table, $dataInsert);
				
				//$result = ExecQuery($sql);
				$Lid = mysql_insert_id();
				$_SESSION['Temp_LID'] = $Lid;
				$SMSMessage = "Dear $FName,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
				if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
				
				if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
						{ 			
				echo "<script language=javascript>"."location.href='User_Register_New.php?flag=1'"."</script>";
						}
						else
				{
					echo "<script language=javascript>"."location.href='User_Register_New.php'"."</script>";
				}
				
			}
			
			else
			{
				$_SESSION['Temp_Flag_Message'] = "1";
				
				$result = ExecQuery($sql);
				$Lid = mysql_insert_id();
				$_SESSION['Temp_LID'] = $Lid;
			//	$rows = mysql_num_rows($result);
				
				
				
				$strDir = dir_name();
	//			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."User_Register_New.php");
				if($Email!="")
				{
					if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
						{ 
						echo "<script language=javascript>"."location.href='User_Register_New.php?flag=1"."</script>"; 
						/*	header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php?flag=1");*/
							echo mysql_error();
						}
					else
						{
						header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
							echo mysql_error();
						}
				}
			}
				echo mysql_error();
	
			if ($result == 1 && isset($_SESSION['UserType']))
			{
				$Msg = getAlert("Your request has been added. !!", TRUE, "User_Register_New.php");
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
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Personal Loans India Apply Compare | Education Holiday Marriage Loan</title>
<meta name="description" content="Get online information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="personal loans India, Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<Script Language="JavaScript">
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function cityother()
{
	if(loan_form.City.value=="Others")
	{
		loan_form.City_Other.disabled = false;
	}
	else
	{
		loan_form.City_Other.disabled = true;
	}
}   

function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;

return true;
}

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
			     
               
       }

       return true;
}

function addBankdetails()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table><tr><td class="formtext" width="50%">Card held since?</td><td  class="bodyarial11" width="50%"><select size="1" name="Card_Vintage"><option value="0">Please select</option> <option value="1">Less than 6 months</option><option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>	<option value="4">more than 12 months</option> </select></td></tr></table>';
				

			}
		}
		
		return true;

	}


function removeBankdetails()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

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

function chkform()
{
	
	var btn3;
	var myOption;
	var i;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

<?
	if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
	{?>
	if(document.loan_form.Email.value=="")
	{
		alert("Please fill your Email.");
		document.loan_form.Email.focus();
		return false;
	}
	<? } ?>

	
	 if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}
		
	
	}
	
	

	if(document.loan_form.Full_Name.value=="")
	{
		alert("Please fill your first name.");
		document.loan_form.Full_Name.focus();
		return false;
	}
	if(document.loan_form.Full_Name.value!="")
	{
	 if(containsdigit(document.loan_form.Full_Name.value)==true)
	{
	alert("First Name contains numbers!");
	document.loan_form.Full_Name.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.Full_Name.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.Full_Name.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	document.loan_form.Full_Name.focus();

  	return false;
  	}
  }
	/*if(document.loan_form.LName.value=="")
	{
		alert("Please fill your Last name.");
		document.loan_form.LName.focus();
		return false;
	}
	if(document.loan_form.LName.value!="")
	{
	 if(containsdigit(document.loan_form.LName.value)==true)
	{
	alert("last Name contains numbers!");
	document.loan_form.LName.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.LName.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.LName.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	document.loan_form.LName.focus();

  	return false;
  	}
  }*/
	if(document.loan_form.day.value=="")
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
	 if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.loan_form.day.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="")
	{
		alert("Please fill your month of birth.");
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
	if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.loan_form.month.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;
	if(document.loan_form.year.value=="")
	{
		alert("Please fill your year of birth.");
		document.loan_form.year.focus();
		return false;
	}
		if(document.loan_form.year.value!="")
	{
	  if((document.loan_form.year.value < "1945") || (document.loan_form.year.value >"1989"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		document.loan_form.year.focus();
		return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}
	  if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  document.loan_form.Phone.focus();
			  return false;  
		}
        if (document.loan_form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.Phone.focus();
				return false;
        }
        if (document.loan_form.Phone.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 document.loan_form.Phone.focus();
                return false;
        }
		/*
	if(document.loan_form.Phone.value!="")
	{
		if (!validmobile(document.loan_form.Phone.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Phone.focus();
			return false;
		}
	}
	*/
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		alert("Please select Employment Status to Continue");
		document.loan_form.Employment_Status.focus();
		return false;
	}
	/*if(document.loan_form.Phone1.value!="")
	{
		if(document.loan_form.Std_Code1.value=="")
		{
			alert("Please fill your STD Code for Residence Landline number.");
			document.loan_form.Std_Code1.focus();
			return false;
		}
	}
	if(document.loan_form.Phone2.value!="")
	{
		if(document.loan_form.Std_Code2.value=="")
		{
			alert("Please fill your STD Code for Office Landline number.");
			document.loan_form.Std_Code2.focus();
			return false;
		}
	}*/
	if(!checkData(document.loan_form.Company_Name, 'Company Name', 3))
		return false;
		
	if (document.loan_form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && (document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other city has special characters.\n Please remove them and try again.");
	document.loan_form.City_Other.focus();
  	return false;
  	}
  }
		if (document.loan_form.Pincode.value=="")
	{
		alert("Please enter Pincode.");
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
	{
		alert("Kindly fill in your Pincode(6 Digits)!");
		document.loan_form.Pincode.focus();
		return false;
	}
	}
	
	if(document.loan_form.Net_Salary.value=="")
{
	alert("Please enter Annual income to Continue");
	document.loan_form.Net_Salary.focus();
	return false;
}
if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;

myOption = -1;
		for (i=loan_form.CC_Holder.length-1; i > -1; i--) {
			if(loan_form.CC_Holder[i].checked) {
				if(i==0)
				{
					if (document.loan_form.Card_Vintage.selectedIndex==0)
					{
						alert("Please select since how long you holding credit card");
						document.loan_form.Card_Vintage.focus();
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

	
	
}
function containsdigit(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
{
return true;
}
}
return false;
}
</Script>
<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div id="dvMainbanner">
<?php if ((($_REQUEST['flag'])!=1))
	{ ?>
   <?php include '~Upper.php';?><?php } ?>
    <div id="dvbannerContainer"><?php include 'header_pl.php';?></div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
    <?php if(isset($_SESSION['UserType']))
	{?>
   <table width="380" border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>
		<table width="380"  border="0" cellspacing="0" cellpadding="0">

<tr><td><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="26" align="left" valign="top"><img src="images/frm-lft-bg.gif" width="10" height="26"></td>
    <td align="center" bgcolor="#3178BB"><h1 class="head2" style="color:#FFFFFF;">Apply Personal Loan</h1></td>
    <td width="10" height="26" align="right" valign="top"><img src="images/frm-rgt-bg.gif" width="10" height="26"></td>
  </tr>
</table></td></tr>
		<tr>
		 <td>
<center>
<?php
if($_SESSION['flag']==1)
{
 
?>
      <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?flag=1" onSubmit="return chkform();">
<?php
}
else {
?>	  
	  <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
  <?php } ?>
  <!-- <p class="head2" align="center">Personal Loan Request</p><br>-->
 
   <table width="380" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F2F6FA"   style="border:1px solid #6B9ECE;">
  <tr>
    <td><table width="95%" border="0" align="center" cellpadding="4" cellspacing="0" id="frm">
   <tr>
	<td colspan="2" align="center"><input type="hidden" name="source" value="<? echo $retrivesource; ?>"></td>
	</tr>
  
   <tr>
      <td width="46%" class="formtext">Your Email Address</td>
     <td class="formtext"><input type="text" name="Email"  style="width:150px;" ></td>
   </tr>
    
	
     <tr>
       <td class="formtext">Full Name<font size="1" color="#FF0000">*</font></td>
       <td class="formtext"><input type="text" name="Full_Name"   style="width:150px;"  maxlength="30"></td>
     </tr>
     
     <tr>
       <td class="formtext">DOB<font size="1" color="#FF0000">*</font></td>
       <td class="formtext"><input name="day" type="text" id="day"  style="width:40px;"  value="DD" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
       <input name="month" type="text" id="month" style="width:40px;"  maxlength="2" value="MM" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         <input name="year" type="text" id="year" style="width:55px;"  maxlength="4" value="YYYY" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
      <tr>
       <td class="formtext">Mobile (For SMS Alerts)<font size="1" color="#FF0000">*</font></td>
       <td class="formtext">+91<input type="text" name="Phone"  style="width:128px;"  maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onFocus="return Decorate('Please give correct Mobile number, to activate your loan request.')"  onBlur="return Decorate1(' ')"><div id="plantype2" style="position:absolute;font-size:10px;width:200;font-weight:none; " ></div></td>
      </tr>
	
     <tr>
     <td class="formtext">Employment Status</td>
     <td class="formtext"><select size="1" name="Employment_Status" style="width:150px;">
	 <option value="-1">Please Select</option>
     	<option value="1">Salaried</option>
     	<option value="0">Self Employed</option>
     </select></td>
   </tr>
   <tr>
     <td class="formtext">Company Name<font size="1" color="#FF0000">*</font></td>
     <td class="formtext"><input type="text" name="Company_Name"  style="width:150px;"  maxlength=""></td>
   </tr>
   <tr>
     <td class="formtext">City Name<font size="1" color="#FF0000">*</font></td>
	 <td class="formtext"><select size="1" name="City" onChange="cityother()" style="width:150px;">
<?=getCityList($City)?>
	 </select>	 </td>
   </tr>
   <tr>
     <td class="formtext">Others</td>
     <td width="54%" class="formtext"><input type="text" name="City_Other" disabled value="Other City" onFocus="this.select();"   style="width:150px;" ></td>
   </tr>
    <tr>
     <td class="formtext">Pincode<font size="1" color="#FF0000">*</font></td>
     <td width="54%" class="formtext"><input type="text" name="Pincode" onFocus="this.select();"  style="width:150px;" maxlength="6"></td>
   </tr>

			 <tr>
     <td class="formtext">Net Salary(Yearly)<font size="1" color="#FF0000">*</font></td>
     <td width="54%" class="formtext">
      <input type="text" name="Net_Salary" id="Net_Salary"  style="width:150px;"  onChange="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Net_Salary','formatedSalary','wordSalary');" onKeyPress="intOnly(this);" onBlur="getDigitToWords('Net_Salary','formatedSalary','wordSalary');" onKeyDown="getDigitToWords('Net_Salary','formatedSalary','wordSalary');"></td>
   </tr>
  	 <tr>

     <td colspan="2" class="formtext">
      <span id='formatedSalary' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordSalary' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
   </tr>
    <tr>
     <td class="formtext">Loan Amount Required<font size="1" color="#FF0000">*</font></td>
     <td class="formtext">
	       <input type="text" name="Loan_Amount" id="Loan_Amount"  style="width:150px;" onChange="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedLoan_Amount','wordLoan_Amount');" onKeyPress="intOnly(this);" onBlur="getDigitToWords('Loan_Amount','formatedLoan_Amount','wordLoan_Amount');" onKeyDown="getDigitToWords('Loan_Amount','formatedLoan_Amount','wordLoan_Amount');"></td>
   </tr>
  <tr>
     <td colspan="2" class="formtext">
	      <span id='formatedLoan_Amount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordLoan_Amount' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span>
	 
	<!--  <input type="text" name="Loan_Amount" size="15" maxlength="30" value="0"> --></td>
   </tr>
  
  
   <tr>
     <td class="formtext">Are you a Credit Card Holder of Any Bank</td>
     <td class="formtext" style="padding-left:40px;" >
	 <table width="60%" border="0" cellspacing="0" cellpadding="0" align="left">
  <tr>
    <td><input type="radio" value="1"  name="CC_Holder" class="NoBrdr" onClick="addBankdetails();"> Yes</td>
    <td align="right"><input type="radio" value="0"  name="CC_Holder" class="NoBrdr" onClick="removeBankdetails();"> 
      No</td>
  </tr>
</table>     </td>
   </tr>
   <tr><td colspan="2" id="myDiv"></td></tr>
 
  
    <tr>
     <td colspan="2" align="center" valign="top"><input name="image"  value="Submit" type="image" src="images/sbmt-btn.gif" width="64" height="30" style="border:0px;" /> 
       &nbsp;
	   <input name="image"   value="Reset" type="image" src="images/rst-bttn.gif" width="64" height="30"  border="0" style="border:0px;"/>       </td>
   </tr>
    <tr>
     <td colspan="2" align="center"><font style="font-weight:normal; font-size:9;">Clicking "Submit" means that you agree to the terms of the Deal4Loans <a href="Privacy.php" target="_blank">Terms and Condition</a> and <a href="Privacy.html" target="_blank">Privacy</a> statement.</font>	</td> 
   </tr>
  </table></td>
  </tr>
</table>

   <br>
	  </form>
 </center> </td>
     </tr>
     </table></td></tr></table>
	 </div>
<?
  include '~Right2.php';

  ?>

  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><?php } ?>

  </body>
</html>