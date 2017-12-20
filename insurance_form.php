<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


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
		//$Name = FixString($Name);
		$PWD1 = FixString($PWD1);
		$FName = FixString($FName);
		$LName = FixString($LName);
		
		$Name=$FName." ".$LName;
		
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		
		$DOB=$Year."-".$Month."-".$Day;
		//$Zero = FixString($Zero);
		$Phone = FixString($Phone);
		$Phone1 = FixString($Phone1);
		$Landline_O = FixString($Landline_O);
		$Std_Code = FixString($Std_Code);
		$Std_Code_O= FixString($Std_Code_O);
		$Email = FixString($Email);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Item_ID = FixString($Item_ID);
		$no_of_dependent = FixString($no_of_dependent);
		$City = FixString($City);
				$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Company_Name = FixString($Company_Name);
    	$Annual_Income = FixString($Annual_Income);
		$Dated = ExactServerdate();
		//$Phone=$Zero."".$Phone;
		$Annual_Income_Monthly = $Annual_Income / 12;
		//if(!isset($IsPublic))
		   $IsPublic = 1;
		$source=$_REQUEST['refsite'];

		$_SESSION['Temp_Type'] = "LifeInsurance";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_PWD1'] = $PWD1;
		$_SESSION['Temp_Pincode'] = $Pincode;
		$_SESSION['Temp_FName'] = $FName;
		$_SESSION['Temp_LName'] = $LName;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_Phone1'] = $Phone1;
		$_SESSION['Temp_Std_Code_O'] = $Std_Code_O;
		$_SESSION['Temp_Std_Code'] = $Std_Code;
		$_SESSION['Temp_Landline_O'] = $Landline_O;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_Message'] = $Message;
		$_SESSION['Temp_Company_Name'] = $Company_Name;
		$_SESSION['Temp_Message1'] = $Message1;
		$_SESSION['Temp_Flag'] = "0";
		$_SESSION['Temp_Email'] = $Email;
		$_SESSION['Temp_Email_New'] = $Email_New;
		$_SESSION['Temp_Annual_Income_Monthly '] = $Annual_Income_Monthly;
		$_SESSION['Temp_Item_ID'] = $Item_ID;
		$_SESSION['Temp_Name_New'] = $Name_New;
		$_SESSION['Temp_Flag_Message'] = "0";
		$_SESSION['Temp_no_of_dependent'] = $no_of_dependent;
		$_SESSION['Temp_City'] = $City;
		$_SESSION['Temp_City_Other'] = $City_Other;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		$_SESSION['Temp_Annual_Income'] = $Annual_Income;
		$_SESSION['Temp_Plan_Interested'] = $Plan_Interested;
		$_SESSION['Temp_Marital_Status'] = $Marital_Status;
		$_SESSION['Temp_Gender'] = $Gender;
    	$_SESSION['Temp_IsPublic'] = $IsPublic;
		
		
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;

		//SQL Query
		if(isset($_SESSION['UserType'])) 
		{
				$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Std_Code"=>$Std_Code, "Landline"=>$Phone1, "Mobile_Number"=>$Phone, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_O, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Gender"=>$Gender, "Marital_Status"=>$Marital_Status, "No_of_dependents"=>$no_of_dependent, "Annual_Income"=>$Annual_Income, "Plan_Interested"=>$Plan_Interested, "Pincode"=>$Pincode, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "DOB"=>$DOB, "Contact_Time"=>$Contact_Time);
		$table = 'Req_Life_Insurance';
		$insert = Maininsertfunc ($table, $dataInsert);
		}

		else 
		{
					$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Std_Code"=>$Std_Code, "Landline"=>$Phone1, "Mobile_Number"=>$Phone, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_O, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Gender"=>$Gender, "Marital_Status"=>$Marital_Status, "No_of_dependents"=>$no_of_dependent, "Annual_Income"=>$Annual_Income, "Plan_Interested"=>$Plan_Interested, "Pincode"=>$Pincode, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "DOB"=>$DOB, "Contact_Time"=>$Contact_Time);
		$table = 'Req_Life_Insurance';
		$insert = Maininsertfunc ($table, $dataInsert);
			
		}
		
		$Email_New = $Email;
		$Name_New = $Name;
		if(isset($_SESSION['UserType'])) 
		{
			$UName = $_SESSION['UName'];
			$sqlquery = "Select *  from wUsers where UserID='".$UserID."'";
		
		 list($recordcount,$myrow)=MainselectfuncNew($sqlquery,$array = array());
		 $cntr=0;
		
			
		}

		$Email = trim($Email);
		$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
		//echo $query."kk";
		
		list($rows,$myrow)=MainselectfuncNew($query,$array = array());
		
		$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
		$msgUserDoesNotExist = "Email does not exists in the database";
	

		if(isset($_SESSION['UserType']))
		{
			
			$sqltest = ("Select RequestID from Req_Life_Insurance order by RequestID desc limit 1");
			 list($recordcount,$myrow)=MainselectfuncNew($sqltest,$array = array());
		$r=0;
			//echo mysql_error();
			if ($cntr<count($myrow)) 
			{
				$Item_ID = $myrow[$r]["RequestID"];
				$_SESSION['Temp_Item_ID'] = $Item_ID;
			}
			

			$Message = "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='450' id='AutoNumber1'><tr><td bgcolor='#EEF0E3'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#DEE3CD'><p><font face='Arial' size='2'>Dear $UName,<br>Thanks for using Deal4loans.com for your Personal Loan requirement</font></p><p><font face='Arial' size='2'><b>E-Quote</b> from Neha,<br><b>Associated Bank:</b> Citifinancial</font></p><p><b><font face='Arial' size='2'>Documents Required:</font></b></p><p><font face='Arial' size='2'><b>Other Comments:</b> As per your request for Loans, we would like to introduce ourselves. We represent Citifinancial which is a Citigroup company. Citifinancial Personal loan stands for 72 hrs dispersal time, minimum documents, no guarantors and in all the most hassle free Personal loan in the market.</font></p><p><font face='Arial' size='2'>Our product is designed to suite needs of both Salaried - Self employed .To give you the best rates we would like that you either call us or give us your contact number so that we can give you the best detail.</font></p><p><font face='Arial' size='2'>With the information provided by you we would still send you a quote with rates and the papers required in next 8 hrs.</font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Neha,<br>Citifinancial India<br>22373348 - 9899802807</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><br><b><a href='http://www.deal4loans.com/Login_Email.php?RequestID=$Item_ID&UserID=$UserID&BidderID=11&Reply_Type=1'>Reply to This Mail</a></b></font></p><p></p></td></tr></table></td></tr></table>";
	
			$Message1 = "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='450' id='AutoNumber1'><tr><td bgcolor='#EEF0E3'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#DEE3CD'><p><font face='Arial' size='2'>Dear $UName,<br>Thanks for using Deal4loans.com for your Personal Loan requirement</font></p><p><font face='Arial' size='2'><b>E-Quote</b> from Shristy,<br><b>Associated Bank:</b> Citibank</font></p><p><b><font face='Arial' size='2'>Documents Required:</font></b></p><p><font face='Arial' size='2'><b>Other Comments:</b> As per your request for Loans, we would like to introduce ourselves. We represent Citibank N.A. which is the biggest bank in the world. In India also we are the biggest MNC Bank in the retail sector. Citibank personal loan stands for 72 hrs dispersal time, minimum documents, no guarantors and in all the most hassle free Personal loan in the market.</font></p><p><font face='Arial' size='2'>Our product is designed to suite needs of both Salaried - Self employed .To give you the best rates we would like that you either call us or give us your contact number so that we can give you the best detail.</font></p><p><font face='Arial' size='2'>With the information provided by you we would still send you a quote with rates and the papers required in next 8 hrs.</font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Shristy,<br>Citibank Internet Team<br>9899405626</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team <a href='http://www.deal4loans.com'>deal4loans.com</a></b><br><br><b><a href='http://www.deal4loans.com/Login_Email.php?RequestID=$Item_ID&UserID=$UserID&BidderID=10&Reply_Type=1'>Reply to This Mail</a></b></font></p><p></p></td></tr></table></td></tr></table>";
/*
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers .= 'To: '.$UName.' <'.$Email_New.'>' . "\r\n";
			$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			$Annual_Income_Monthly = $Annual_Income / 12;
			if($Annual_Income_Monthly > 10000)
			{
//				mail($Email_New,'Bidder Reply For Your Request', $Message1, $headers);
				$Message = "As per your request for Loans, we would like to introduce ourselves. We represent Citibank N.A. which is the biggest bank in the world. In India also we are the biggest MNC Bank in the retail sector. Citibank personal loan stands for 72 hrs dispersal time, minimum documents, no guarantors and in all the most hassle free Personal loan in the market. Our product is designed to suite needs of both Salaried/ Self employed .To give you the best rates we would like that you either call us or give us your contact number so that we can give you the best detail. With the information provided by you we would still send you a quote with rates and the papers required in next 8 hrs.";
				
			}
			else
			{
				$Message = " As per your request for Loans, we would like to introduce ourselves. We represent Citifinancial which is a Citigroup company. Citifinancial Personal loan stands for 72 hrs dispersal time, minimum documents, no guarantors and in all the most hassle free Personal loan in the market. Our product is designed to suite needs of both Salaried/ Self employed .To give you the best rates we would like that you either call us or give us your contact number so that we can give you the best detail. With the information provided by you we would still send you a quote with rates and the papers required in next 8 hrs.";
			}

			echo "<script language=javascript>location.href='t_y.php?r_url=myRequests.php'"."</script>";

		}
				
	
		
		else
		{
			$_SESSION['Temp_Flag_Message'] = "1";
			$strDir = dir_name();
//			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."User_Register_New.php");
			if($Email!="")
			{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
				echo mysql_error();
			}
		}
			echo mysql_error();

		if ($result == 1 && isset($_SESSION['UserType']))
		{
			$Msg = getAlert("Your request has been added. !!", TRUE, "myRequests.php");
		}
    }
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="description" content="To get online information on life insurance (finance) provided by various life insurance provider banks in India, just fill this online form to apply for the life insurance and know more about various life insurance schemes.">
<meta name="Keywords" content="life insurance india, life insurance finance, flexible life insurance, compare life insurances, life insurance eligibility, best life insurances, life insurances online application, life insurance providers, low quotes life insurance, best quote life insurances, quick life insurances, life insurance schemes">
<title>Apply Online for Life Insurance : Compare Life Insurances</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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
		if(document.loan_form.PWD1.value=="")
		{
			alert("please fill password.");
			document.loan_form.PWD1.focus();
			return false;
		}
		if(document.loan_form.PWD2.value=="")
		{
			alert("please retype password.");
			document.loan_form.PWD2.focus();
			return false;
		}
		if(document.loan_form.PWD1.value!=document.loan_form.PWD2.value)
		{
			alert("Both password must be same.");
			document.loan_form.PWD1.focus();
			return false;
		}
	}
	
	if(document.loan_form.PWD1.value!=document.loan_form.PWD2.value)
	{
		alert("Both password must be same.");
		document.loan_form.PWD1.focus();
		return false;
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
	
		if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}
	if(document.loan_form.Phone.value!="")
	{
		if (!validmobile(document.loan_form.Phone.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Phone.focus();
			return false;
		}
	}
	if(document.loan_form.Std_Code.value=="")
	{
		alert("Please fill your Std code of Residence no .");
		document.loan_form.Std_Code.focus();
		return false;
	}
		if(document.loan_form.Phone1.value=="")
	{
		alert("Please fill your Residence Landline number.");
		document.loan_form.Phone1.focus();
		return false;
	}
		if(document.loan_form.Std_Code_O.value=="")
	{		
		alert("Please fill your Std code of Office no .");
		document.loan_form.Std_Code_O.focus();
		return false;
	}

		 if(document.loan_form.Landline_O.value=="")
	{
		alert("Please fill your Office Landline number.");
		document.loan_form.Landline_O.focus();
		return false;
	}
	if(document.loan_form.Company_Name.value=="")
	{
		alert("Please fill your Company name.");
		document.loan_form.Company_Name.focus();
		return false;
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
	/*if(!checkNum(document.loan_form.no_of_dependent, 'No Of Dependents',0))
		return false;*/
	if (document.loan_form.Annual_Income.value=="")
	{
		alert("Please enter Annual Income.");
		document.loan_form.Annual_Income.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Annual_Income, 'Annual Income',0))
		return false;
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

<div id="dvMainbanner">
    <div id="dvNavbg">
      <?php include '~Upper.php';?>
    <div id="dvbannerContainer"><table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><img src="images/life_insurance1.gif" usemap="#map_name4"></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">Life Insurance generally provides financial coverage to specified beneficiaries upon the death of the insured individual. It involves a contract providing for payment of an assured sum of money to the person insured.</td></tr></table> <map name="map_name4">

   <area shape="rect" coords="17,75,100,95" hrEF="insurance_form.php">
         </map> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
    <?php if(isset($_SESSION['UserType']))
	{?>
   <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>
	<table width="520"  border="0" cellspacing="0" cellpadding="0">
<tr><td align="center" class="head2">Life Insurance Request<td></tr>
<tr><td>&nbsp;</td></tr>
		<tr>
		 <td>
<center>
    			
 <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
<!--   <p class="head2" align="center">Insurance Request</p>-->
   <input type="hidden" name="refsite" value="<? echo $_REQUEST['refsite'] ?>">
   <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   
    <? if(!isset($_SESSION['UserType'])) {?>
   <tr>
         <td class="bodyarial11">Your Email Address</td>
     <td class="bodyarial11">
     <input type="text" name="Email" size="30" onFocus="return Decoration('*')" onBlur="return Decoration1(' ')"></td>
   </tr>
     <tr>
       <td class="bodyarial11">Create Password to Login <div id="plantype" style="position:absolute;color:red;"></div></td>
       <td class="bodyarial11"><input type="password" name="PWD1" size="15" maxlength="15" onFocus="return retain('*');"></td>
     </tr>
     <tr>
       <td class="bodyarial11">Type Password Again<div id="plantype1" style="position:absolute;color:red;"></div></td>
       <td class="bodyarial11"><input type="password" name="PWD2" size="15" maxlength="15" onFocus="return retain('*');"></td>
     </tr>
	 <? }?>
     <tr>
       <td class="bodyarial11">First Name<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" name="FName" size="20" maxlength="30"></td>
     </tr>
     <tr>
       <td class="bodyarial11">Last Name<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" name="LName" size="20" maxlength="30"></td>
     </tr>
     <tr>
       <td class="bodyarial11">DOB<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input name="day" type="text" id="day" size="5" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         <input name="month" type="text" id="month" size="5" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         <input name="year" type="text" id="year" size="8" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         (DD-MM-YYYY)</td>
     </tr>
     <tr>
       <td class="bodyarial11" align="bottom">Mobile(For SMS </br> Alerts)<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" style="width:16px;" name="Zero" size="1" maxlength="1" value="0" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";><input type="text" name="Phone" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
	 <tr>
       <td class="bodyarial11" align="bottom">Residence Landline No<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" name="Std_Code"  size="1" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"><input type="text" name="Phone1" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
	  <tr>
       <td class="bodyarial11" align="bottom">Office Landline No<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" name="Std_Code_O" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" size="1" maxlength="5"><input type="text" name="Landline_O" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
     <tr>
     <td class="bodyarial11">Employment Status</td>
     <td class="bodyarial11"><select size="1" name="Employment_Status">
     	<option selected value="1">Salaried</option>
     	<option value="0">Self Employed</option>
     </select></td>
   </tr>
    <tr>
     <tr>
     <td class="bodyarial11">Company Name<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
     <input type="text"  name="Company_Name" size="20">
     </td>
   </tr>
    <tr>
     <td class="bodyarial11">City Name</td>
	 <td class="bodyarial11"><select size="1" name="City" onChange="cityother()">
     <?=getCityList($City)?>
	 </select> </td></tr>
	  <tr>
     <td class="bodyarial11">Others</td>
     <td class="bodyarial11"><input type="text" name="City_Other" disabled value="Other City" onFocus="this.select();" size="10"></td>
   </tr>
	<tr>
       <td class="bodyarial11" align="bottom">Pincode<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" name="Pincode" size="15" maxlength="6" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
       <tr>
     <td class="bodyarial11">Gender</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Gender" class="NoBrdr" checked>Male
     <input type="radio" value="2" name="Gender" class="NoBrdr">Female</td>
   </tr>
   <tr>
     <td class="bodyarial11">Marital Status</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Marital_Status" class="NoBrdr" checked>Single
     <input type="radio" value="2" name="Marital_Status" class="NoBrdr">Married</td>
   </tr>
   <tr>
     <tr>
     <td class="bodyarial11">No. of Dependents</td>
     <td class="bodyarial11">
     <input type="text"  name="no_of_dependent" value="0" size="15">
     </td>
   </tr>
   <tr>
     <td class="bodyarial11">Annual Income<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11"><input type="text" name="Annual_Income" size="15" maxlength="30" value="0"></td>
   </tr>
   <tr>
	 <td class="bodyarial11">Prefered Time To Contact</td>
   <td>
   <select size="1"  name="Contact_Time" class="style4">
  <option value="1">Please Select</option> 
  <option value="10- 12 am">10- 12 am</option> 
  <option value="12- 2 pm">12- 2 pm</option> 
  <option value="2- 4 pm">2- 4 pm</option>
  <option value="4- 6 pm">4- 6 pm</option>
  <option value="After 6 pm">After 6 pm</option>
  </select>
  </td>
  </tr>
   
  <!-- <tr>
     <td class="bodyarial11">Make Contact Public**</td>
     <td class="bodyarial11"><input type="checkbox" name="IsPublic" value="1" checked></td>
   </tr>-->
  
   <tr>
     <td colspan="2" align="center"><br><input type="submit" class="bluebutton" value="Submit"> 
       &nbsp;
       <input type="reset" class="bluebutton" value="Reset"></td>
   </tr>
    <tr>
     <td colspan="2"><font size="1" style="font-weight:normal;">Clicking "Submit" means that you agree to the terms of the Deal4Loans <a href="Privacy.html" target="_blank">Terms and Condition</a> and <a href="Privacy.html" target="_blank">Privacy</a> statement.</font>	</td> 
   </tr>
   <!--<tr>
     <td colspan="2"><font size="1">** If you do not select this option, your privacy is assured & you will receive SMS & Emails.Otherwise your contact details will be shared with the associated Insurance companies.</font>	</td> 
   </tr>-->
  </table>
 </form>
 </center>
 </td>
     </tr>
            </table></td></tr></table>
 </div>
     <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right.php';
  }
  ?>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>