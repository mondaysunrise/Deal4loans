<?php
	header("Location: apply-car-loans.php");
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$retrivesource = $_SESSION['source'];
       $page_Name = "CarLoan";

	    if ($_SESSION['flag']==1)
		{
		$source="partner1";
		}

		

	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		
		//$PWD1 = FixString($PWD1);
		$FName = FixString($FName);
		$LName = FixString($LName);
		$Name=$FName." ".$LName;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Phone1 = FixString($Phone1);
		$Phone2 = FixString($Phone2);
		$Std_Code1 = FixString($Std_Code1);
		$Car_Insurance = FixString($Car_Insurance);
		$Std_Code2 = FixString($Std_Code2);
		$Employment_Status = FixString($Employment_Status);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$Activate =FixString($Activate);
		$City_Other = FixString($City_Other);
		$Net_Salary = FixString($Net_Salary);
		$Car_Make = FixString($Car_Make);
		$Pincode = FixString($Pincode);
		$Contact_Time = FixString($Contact_Time);
		$Car_Model = FixString($Car_Model);
		$Car_Type = FixString($Car_Type);
		$Loan_Tenure = FixString($Loan_Tenure);
		$Loan_Amount = FixString($Loan_Amount);
		$Descr = FixString($Descr);
	   $Dated = ExactServerdate();
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
	   $IsPublic = 1;
		
		/* FIX STRINGS */
	if($_SESSION=="")
		{
			$_SERVER['Temp_Type'] = "CarLoan";
			$_SERVER['Temp_Name'] = $Name;
			$_SERVER['Temp_FName'] = $FName;
			$_SERVER['Temp_LName'] = $LName;
			$_SERVER['Temp_Phone'] = $Phone;
			$_SERVER['Temp_Phone1'] = $Phone1;
			$_SERVER['Temp_Phone2'] = $Phone2;
			$_SERVER['Temp_Std_Code1'] = $Std_Code1;
			$_SERVER['Temp_Std_Code2'] = $Std_Code2;
			$_SERVER['Temp_DOB'] = $DOB;
			$_SERVER['Temp_Email'] = $Email;
			$_SERVER['Temp_Flag'] = "0";
			$_SERVER['Temp_Employment_Status'] = $Employment_Status;
			$_SERVER['Temp_Company_Name'] = $Company_Name;
			$_SERVER['Temp_City'] = $City;
			$_SERVER['Temp_City_Other'] = $City_Other;
			$_SERVER['Temp_Net_Salary'] = $Net_Salary;
			$_SERVER['Temp_Car_Make'] = $Car_Make;
			$_SERVER['Temp_Car_Model'] = $Car_Model;
			$_SERVER['Temp_Car_Type'] = $Car_Type;
			$_SERVER['Temp_Loan_Tenure'] = $Loan_Tenure;
			$_SERVER['Temp_Loan_Amount'] = $Loan_Amount;
			$_SERVER['Temp_Descr'] = $Descr;
			$_SERVER['Temp_IsPublic'] = $IsPublic;
		}
	
	else
		{
			$_SESSION['Temp_Type'] = "CarLoan";
			$_SESSION['Temp_Name'] = $Name;
			$_SESSION['Temp_FName'] = $FName;
			$_SESSION['Temp_LName'] = $LName;
			$_SESSION['Temp_Phone'] = $Phone;
			$_SESSION['Temp_Phone1'] = $Phone1;
			$_SESSION['Temp_Phone2'] = $Phone2;
			$_SESSION['Temp_Std_Code1'] = $Std_Code1;
			$_SESSION['Temp_Std_Code2'] = $Std_Code2;
			$_SESSION['Temp_DOB'] = $DOB;
			$_SESSION['Temp_Email'] = $Email;
			$_SESSION['Temp_Flag'] = "0";
			$_SESSION['Temp_Employment_Status'] = $Employment_Status;
			$_SESSION['Temp_Company_Name'] = $Company_Name;
			$_SESSION['Temp_City'] = $City;
			$_SESSION['Temp_City_Other'] = $City_Other;
			$_SESSION['Temp_Net_Salary'] = $Net_Salary;
			$_SESSION['Temp_Car_Make'] = $Car_Make;
			$_SESSION['Temp_Car_Model'] = $Car_Model;
			$_SESSION['Temp_Car_Type'] = $Car_Type;
			$_SESSION['Temp_Loan_Tenure'] = $Loan_Tenure;
			$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
			$_SESSION['Temp_Descr'] = $Descr;
			$_SESSION['Temp_IsPublic'] = $IsPublic;
	    }
if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where  IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}

		$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
			if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{		
		if(isset($_SESSION['UserType'])) 
		{
			//$sql = "INSERT INTO Req_Loan_Car (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Pincode, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Car_Make, Car_Model, Car_Type, Loan_Tenure, Loan_Amount, Contact_Time, Descr, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic,Dated, source,Car_Insurance)
			//VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Pincode', '$Phone', '$Std_Code1', '$Phone1', '$Std_Code2', '$Phone2', '$Net_Salary', '$Car_Make', '$Car_Model', '$Car_Type', '$Loan_Tenure', '$Loan_Amount', '$Contact_Time', '$Descr', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$source','$Car_Insurance' )";
		$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Net_Salary"=>$Net_Salary, "Car_Make"=>$Car_Make, "Car_Model"=>$Car_Model, "Car_Type"=>$Car_Type, "Loan_Tenure"=>$Loan_Tenure, "Loan_Amount"=>$Loan_Amount, "Contact_Time"=>$Contact_Time, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Car_Insurance"=>$Car_Insurance);
$table = 'Req_Loan_Car';
$insert = Maininsertfunc ($table, $dataInsert);
		
		}

		else
		{
			//$sql = "INSERT INTO Req_Loan_Car (UserID, Name, Email, Employment_Status,Company_Name,City,City_Other, Pincode, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary,Car_Make, Car_Model, Car_Type, Loan_Tenure, Loan_Amount, Contact_Time, Descr, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source,Car_Insurance)
			//VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Pincode', '$Phone', '$Std_Code1', '$Phone1', '$Std_Code2', '$Phone2', '$Net_Salary', '$Car_Make', '$Car_Model', '$Car_Type', '$Loan_Tenure', '$Loan_Amount', '$Contact_Time', '$Descr', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$source','$Car_Insurance' )";
		
			$dataInsert = array("UserID"=>'', "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Net_Salary"=>$Net_Salary, "Car_Make"=>$Car_Make, "Car_Model"=>$Car_Model, "Car_Type"=>$Car_Type, "Loan_Tenure"=>$Loan_Tenure, "Loan_Amount"=>$Loan_Amount, "Contact_Time"=>$Contact_Time, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Car_Insurance"=>$Car_Insurance);
$table = 'Req_Loan_Car';
$insert = Maininsertfunc ($table, $dataInsert);
			

			if($Email=="")
			{
				if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
					{ 
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php?flag=1");
				echo mysql_error();
				//echo "<script language=javascript>"." location.href='Contents_Car_Loan_Mustread.php?flag=1'"."</script>";
					}
					else
				{
						header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
				echo mysql_error();
						//echo "<script language=javascript>"." location.href='Contents_Car_Loan_Mustread.php'"."</script>";
				}

			}		

		}


		$Email = trim($Email);
		$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
		//echo $query."kk";
		$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
		$msgUserDoesNotExist = "Email does not exists in the database";
		$result = ExecQuery($query);
		$rows = mysql_num_rows($result);		
		echo mysql_error();

		if(isset($_SESSION['UserType']))
		{
			$result = ExecQuery($sql);
			$rows = mysql_num_rows($result);
			getEligibleBidders("car","$City","$Phone");
			$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "myRequests.php");
			echo $Msg;
			echo mysql_error();
		}
		
		else if ($myrow = mysql_fetch_array($result)) 
		{
			do
			{
				$_SESSION['Temp_UserID'] = $myrow["UserID"];
			}while ($myrow = mysql_fetch_array($result));
			mysql_free_result($result);
			$_SESSION['Temp_Flag'] = "1";
			
			$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			$res_user=ExecQuery($qry_user);
			$row_user=mysql_fetch_array($res_user);
			$UserID1=$row_user["UserID"];
			
			$sql = "INSERT INTO Req_Loan_Car (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Pincode, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary,Car_Make, Car_Model,Car_Type, Loan_Tenure,Loan_Amount, Contact_Time, Descr, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source,Car_Insurance)
			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Pincode', '$Phone', '$Std_Code1', '$Phone1', '$Std_Code2', '$Phone2', '$Net_Salary', '$Car_Make', '$Car_Model', '$Car_Type', '$Loan_Tenure', '$Loan_Amount', '$Contact_Time', '$Descr', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$source','$Car_Insurance' )";
			$result = ExecQuery($sql);
			//getEligibleBidders("car","$City","$Phone");
			if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
					{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php?flag=1");
				echo mysql_error();
			//echo "<script language=javascript>"." location.href='User_Register_New.php?flag=1'"."</script>";
					}
					else
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
				echo mysql_error();
					//echo "<script language=javascript>"." location.href='User_Register_New.php'"."</script>";
					}
		
		}
		
		else
			{
			$result = ExecQuery($sql);
			$rows = mysql_num_rows($result);
			getEligibleBidders("car","$City","$Phone");
			$strDir = dir_name();
			if($Email!="")
			{
				if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
			{ 
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php?flag=1");
				echo mysql_error();
			}
			else
			{ 
				
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/User_Register_New.php");
				echo mysql_error();
			}
			}
			}
		//echo $result;
		echo mysql_error();

		if ($result == 1 && isset($_SESSION['UserType']))
			{
			$Msg = getAlert("Your request has been added. !!", TRUE, "myRequests.php");
			}
			}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL = $_POST["PostURL"]."?msg=".$msg;
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
	//echo $sql;
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Motor Car Loans India Apply Compare | Deal4loans</title>
<meta name="description" content="Get online information on car loan schemes from all car loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
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
function retain(strPlan)
{
	if(document.loan_form.Email.value!="")
	{
	   if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }
	}
       return true;
	}
function Decoration(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function Decoration1(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
<?	if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
	{?>
	if(document.loan_form.Email.value=="")
	{
		alert("Please fill your Email.");
		document.loan_form.Email.focus();
		return false;
	}
	<? } ?>
<?
if($_SESSION['UserType']=="") 
{
?>	
	
	 if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}
		
	
	}
	
	
<?
}
?>
	if(document.loan_form.FName.value=="")
	{
		alert("Please fill your first name.");
		document.loan_form.FName.focus();
		return false;
	}
	if(document.loan_form.FName.value!="")
	{
	 if(containsdigit(document.loan_form.FName.value)==true)
	{
	alert("First Name contains numbers!");
	document.loan_form.FName.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.FName.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.FName.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	document.loan_form.FName.focus();

  	return false;
  	}
  }
	if(document.loan_form.LName.value=="")
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
  	alert ("Last Name has special characters.\n Please remove them and try again.");
	document.loan_form.LName.focus();

  	return false;
  	}
  }
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
/*	if(document.loan_form.Phone.value!="")
	{
		if (!validmobile(document.loan_form.Phone.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Phone.focus();
			return false;
		}
	}
	*/
	if(document.loan_form.Phone1.value!="")
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
	}
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
	if (document.loan_form.Car_Model.value=="")
	{
		alert("Please enter Car Model.");
		document.loan_form.Car_Model.focus();
		return false;
	}
	if(!checkData(document.loan_form.Car_Model, 'Car Model',0))
		return false;
		
	if (document.loan_form.Loan_Tenure.value=="")
	{
		alert("Please enter Loan Tenure.");
		document.loan_form.Loan_Tenure.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Tenure, 'Loan Tenure',0))
		return false;
		
	if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if (document.loan_form.Contact_Time.selectedIndex==0)
	{
		alert("Please enter Prefered time of contact");
		document.loan_form.Contact_Time.focus();
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
</script>
<Script Language="JavaScript">
var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function insertData()
		{
			var get_full_name = document.getElementById('FName').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="3";

				var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
				//alert(queryString); 
				ajaxRequestMain.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					if(ajaxRequestMain.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequestMain.responseText;
					}
				}

				ajaxRequestMain.send(null); 
			 
		}

	window.onload = ajaxFunctionMain;


</script>
<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
<?php if ((($_REQUEST['flag'])!=1))
	{ ?>
    <?php include '~Upper.php';?><?php } ?>
                        <div id="dvbannerContainer"><?php include 'header_cl.php';?></div>

  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
   
	<table width="380"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center">
<table width="300" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
<td width="10" height="26" align="left" valign="top"><img src="images/frm-lft-bg.gif" width="10" height="26"></td>
    <td align="center" bgcolor="#3178BB"><H1 class="head2" style="color:#FFFFFF;">Apply Car Loan</H1></td>
<td width="10" height="26" align="right" valign="top"><img src="images/frm-rgt-bg.gif" width="10" height="26"></td>
  </tr>
</table>

<tr><td align="center"><font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>

     <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
 <table width="380" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F2F6FA"   style="border:1px solid #6B9ECE;">
  <tr>
    <td><table width="95%" border="0" align="center" cellpadding="4" cellspacing="0" id="frm">
    <tr>
	<td colspan="2" align="center"><input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>"></td>
	</tr>
	 <tr>
       <td class="formtext">First Name<font size="1" color="#FF0000">*</font></td>
       <td class="formtext"><input type="text" name="FName" id="FName" style="width:150px;" maxlength="30" onChange="insertData();"></td>
     </tr>
	 <tr>
       <td class="formtext">Last Name<font size="1" color="#FF0000">*</font></td>
       <td class="formtext"><input type="text" name="LName" style="width:150px;" maxlength="30" onChange="insertData();"></td>
     </tr>
   <? if(!isset($_SESSION['UserType'])) {?>
   <tr>
                <td width="158" class="formtext">Your Email Address</td>
     <td>
     <input type="text" name="Email" id="Email" style="width:150px;" onChange="insertData();"></td>
   </tr>
  
   <? }?>
  
     
     <tr>
       <td class="formtext">DOB<font size="1" color="#FF0000">*</font></td>
       <td class="formtext"><input name="day" type="text" id="day" onChange="intOnly(this);insertData();" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);" style="width:40px;" maxlength="2"; value="DD">
         <input name="month" type="text" id="month" onChange="intOnly(this);" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);" style="width:40px;" maxlength="2" value="MM">
         <input name="year" type="text" id="year" style="width:55px;" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="YYYY">
         </td>
     </tr>
     <tr>
       <td class="formtext">Mobile (For SMS Alerts)<font size="1" color="#FF0000">*</font></td>
       <td class="formtext">+91<!--<input type="text"  name="Zero" size="1" maxlength="1" value="+91" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; readonly>--><input type="text" name="Phone" id="Phone" style="width:126px;" maxlength="10" onChange="intOnly(this);insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"><div id="plantype2" style="position:absolute;font-size:10px;width:200;font-weight:none; " ></div></td>
     </tr>
	 <tr>
       <td class="formtext" align="bottom">Residence Landline No</td>
	   <td class="formtext"><input onFocus="insertData();" type="text" name="Std_Code1" style="width:25px;" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"><input type="text" name="Phone1" style="width:120px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
	 <tr>
       <td class="formtext" align="bottom">Office Landline No</td>
	   <td class="formtext"><input type="text" name="Std_Code2" style="width:25px;" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"><input type="text" name="Phone2" style="width:120px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
   <tr>
     <td class="formtext">Employment Status</td>
     <td width="185"><select style="width:150px;" name="Employment_Status" onChange="insertData();">
     	<option selected value="1">Salaried</option>
     	<option value="0">Self Employed</option>
     </select></td>
   </tr>
   <tr>
     <td class="formtext">Company Name<font size="1" color="#FF0000">*</font></td>
     <td><input type="text" name="Company_Name" style="width:150px;"></td>
   </tr>
   <tr>
     <td class="formtext">City Name<font size="1" color="#FF0000">*</font></td>
	 <td><select style="width:150px;" name="City" id="City" onChange="cityother();insertData();">
     <?=getCityList($City)?>
	 </select>
	 </td>
     <tr>
     <td class="formtext">Others</td>
     <td width="185" class="formtext"><input type="text" name="City_Other" disabled value="Other City" onFocus="this.select();" style="width:150px;"></td>
    </tr>
    <tr>
     <td class="formtext">Pincode<font size="1" color="#FF0000">*</font></td>
	 <td><input type="text" name="Pincode" onChange="intOnly(this);" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);" style="width:150px;" maxlength="6">
	 </td>
   </tr>
  <!-- 	<tr>
		 <td class="formtext">Annual Income Range (Rs)</td>
		 <td width="70%" class="formtext"><select name="Annual_Income">
		 <OPTION value="-1" selected>Please select</OPTION>
		<OPTION value="50000">50,000-1,00,000</OPTION>
		<OPTION value="100000">1,00,000-2,00,000</OPTION>
		<OPTION value="200000">2,00,000-3,00,000</OPTION>
		<OPTION value="300000">3,00,000-4,00,000</OPTION>
		<OPTION value="400000">Above4,00,000</OPTION></SELECT></td>
				</tr>
			 <tr> -->
     <td class="formtext">Net Salary(Yearly)<font size="1" color="#FF0000">*</font></td>
     <td width="185" class="formtext">
    <input type="text" name="Net_Salary" id="Net_Salary" style="width:150px;" onBlur="getDigitToWords('Net_Salary','formatedSalary','wordSalary');" onKeyUp="getDigitToWords('Net_Salary','formatedSalary','wordSalary'); intOnly(this);" onKeyPress="intOnly(this);"></td>
   </tr>
   <tr>
     <td class="formtext" colspan="2" align="left"><span id='formatedSalary' style='font-size:11px; font-weight:bold;color:#333333;font-Family: Verdana, Arial, Helvetica, sans-serif;'></span><span id='wordSalary' style='font-size:11px; font-weight:bold;color:#333333;font-Family: Verdana, Arial, Helvetica, sans-serif;text-transform: capitalize;'></span></td>
	</tr>
   
   <tr>
     <td class="formtext">Car Make</td>
     <td>
     <select style="width:150px;" name="Car_Make">
	 <option selected value="1">Chevrolet</option>
	 <option value="2">Fiat</option>
     <option value="3">Ford</option>
     <option Value="4">General Motors</option>
     <option value="5">Hindustan Motors</option>
     <option value="6">Honda</option>
     <option value="7">Hyundai</option>
     <option value="8">Lexus</option>
     <option value="9">Mahindra & Mahindra</option>
     <option value="10">Maruti Udyog Ltd</option>
     <option value="11">Mercedes Benz</option>
     <option value="12">Nissan India</option>
     <option value="13">Porsche</option>
     <option value="14">Skoda Auto</option>
     <option value="15">Tata Motors</option>
     <option value="16">Toyota Kirlosker</option>
	 <option value="17">Others</option>
	 </select></td>
   </tr>
   <tr>
     <td class="formtext">Car Model<font size="1" color="#FF0000">*</font></td>
     <td>
     <input type="text" name="Car_Model" style="width:150px;" maxlength="30" value="0"></td>
   </tr>
   <tr>
     <td class="formtext">Car Type</td>
     <td>
     <select style="width:150px;" name="Car_Type">
	<?=AmISelected("New", $Car_Type, "1")?>
	<?=AmISelected("Used", $Car_Type, "0")?>
     </select></td>
   </tr>
   <tr>
     <td class="formtext">Loan Tenure (in Years)<font size="1" color="#FF0000">*</font></td>
     <td>
     <input type="text" name="Loan_Tenure" style="width:150px;" value="0"></td>
   </tr>
   <tr>
     <td class="formtext">Loan Amount Required<font size="1" color="#FF0000">*</font></td>
     <td>
     <input type="text"  id="Loan_Amount" name="Loan_Amount" style="width:150px;" maxlength="30" onBlur="getDigitToWords('Loan_Amount','formatedIncome','wordIncome');" onKeyUp="getDigitToWords('Loan_Amount','formatedIncome','wordIncome'); intOnly(this);" onKeyPress="intOnly(this);"></td>
   </tr>
     <tr>
	 <td class="formtext" colspan="2" align="left"><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:#333333;font-Family: Verdana, Arial, Helvetica, sans-serif;'></span><span id='wordIncome' style='font-size:11px; font-weight:bold;color:#333333;font-Family: Verdana, Arial, Helvetica, sans-serif;text-transform: capitalize;'></span></td>
   </tr>
   
     <tr>
	 <td class="formtext">Prefered Time To Contact</td>
   <td>
   <select style="width:150px;"  name="Contact_Time" class="style4">
  <option value="1">Please Select</option> 
  <option value="10- 12 am">10- 12 am</option> 
  <option value="12- 2 pm">12- 2 pm</option> 
  <option value="2- 4 pm">2- 4 pm</option>
  <option value="4- 6 pm">4- 6 pm</option>
  <option value="After 6 pm">After 6 pm</option>
  </select>
  </td>
  </tr>
  
   <tr>
     <td valign="top" class="formtext">Special Requirements</td>
     <td><textarea rows="5" name="Descr" style="width:150px;" cols="40"> </textarea></td>
   </tr>
  <tr>
			<td colspan="2" class="formtext"><input type="checkbox"  name="Car_Insurance" style="border:none;"> Get quotes for car Insurance</td></tr>
		<tr>
      <tr>
     <td colspan="2" align="center" valign="top">
	<!--	 <input name="image"  value="Submit" type="image" src="images/sbmt-btn.gif" width="64" height="30" style="border:0px;" /> -->

	 <input value="" type="submit" style=" background-image:url(images/sbmt-btn.gif); border:0px; width:64px; height:30px; margin-bottom:0px;"  /> 
       &nbsp;
	   
	   <!--<input name="image"   value="Reset" type="image" src="images/rst-bttn.gif" width="64" height="30"  border="0" style="border:0px;"/> -->
	   <input  value="" type="reset"    border="0"  style=" background-image:url(images/rst-bttn.gif); border:0px; width:64px; height:30px; margin-bottom:0px;"/>

 
	   </td>
   </tr>
    <tr>
     <td colspan="2"><font style="font-weight:normal; font-size:9;">Clicking "Submit" means that you agree to the terms of the Deal4Loans <a href="Privacy.php" target="_blank">Terms and Condition</a> and <a href="Privacy.php" target="_blank">Privacy</a> statement.</font>	</td> 
   </tr>
  
  </table></td>
  </tr>
</table>
<br>

 </form>
 </td>
     </tr>
            </table>
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