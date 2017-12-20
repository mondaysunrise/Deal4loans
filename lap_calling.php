<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

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

		/* FIX STRINGS */
		
		//$PWD1 = FixString($PWD1);
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
		$Phone2 = FixString($Phone2);
		$Std_Code1 = FixString($Std_Code1);
		$Std_Code2 = FixString($Std_Code2);
		
		$Employment_Status = FixString($Employment_Status);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Total_Experience = FixString($Total_Experience);
		$Net_Salary = FixString($Net_Salary);
		$Residential_Status = FixString($Residential_Status);
		$Residence_Address = FixString($Residence_Address);
		$Property_Type = FixString($Property_Type);
		$Property_Value = FixString($Property_Value);
		$Loan_Amount = FixString($Loan_Amount);
		$Descr = FixString($Descr);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		 $Dated = ExactServerdate();
		//$Phone=$Zero."".$Phone;
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
		$IsPublic = 1;
		$source = "calling";

		$_SESSION['Temp_Type'] = "PropertyLoan";
		$_SESSION['Temp_Name'] = $Name;
		
		//$_SESSION['Temp_PWD1'] = $PWD1;
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
		$_SESSION['Temp_Total_Experience'] = $Total_Experience;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		$_SESSION['Temp_Residential_Status'] = $Residential_Status;
		$_SESSION['Temp_Residence_Address'] = $Residence_Address;
		$_SESSION['Temp_Property_Type'] = $Property_Type;
		$_SESSION['Temp_Property_Value'] = $Property_Value;
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_Descr'] = $Descr;
		$_SESSION['Temp_IsPublic'] = $IsPublic;

		//SQL Query
		if(isset($_SESSION['UserType'])) 
		{
			$sql = "INSERT INTO Req_Loan_Against_Property (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Total_Experience, Net_Salary, Residential_Status, Property_Type,Property_Value, Loan_Amount, Descr, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Contact_Time, Pincode, Residence_Address, source)
					VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Std_Code2', '$Phone2', '$Total_Experience', '$Net_Salary', '$Residential_Status', '$Property_Type', '$Property_Value', '$Loan_Amount', '$Descr', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Contact_Time', '$Pincode', '$Residence_Address', '$source' )";
		}
		else
		{
			$sql = "INSERT INTO Req_Loan_Against_Property (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Total_Experience, Net_Salary, Residential_Status, Property_Type, Property_Value, Loan_Amount, Descr, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Contact_Time, Pincode, Residence_Address, source)
					VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Std_Code2', '$Phone2', '$Total_Experience', '$Net_Salary', '$Residential_Status', '$Property_Type', '$Property_Value', '$Loan_Amount', '$Descr', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Contact_Time', '$Pincode', '$Residence_Address', '$source' )";
/*
			if($Email=="")
			{
				echo "<script language=javascript>alert('Thank You, Your request has been added. !!');"." location.href='Request_Loan_Against_Property_New.php'"."</script>";
			}
*/
		}

		$Email = trim($Email);
		$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
		$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
		$msgUserDoesNotExist = "Email does not exists in the database";
		$result = ExecQuery($query);
		$rows = mysql_num_rows($result);		
		echo mysql_error();

		if(isset($_SESSION['UserType']))
				{
			$result = ExecQuery($sql);
			$rows = mysql_num_rows($result);
			getEligibleBidders("property","$City","$Phone");
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
			
			list($recordcount,$row_user)=MainselectfuncNew($qry_user,$array = array());
			$k=0;
			
			//$res_user=ExecQuery($qry_user);
			//$row_user=mysql_fetch_array($res_user);
			$UserID1=$row_user[$k]["UserID"];
			
			//$sql = "INSERT INTO Req_Loan_Against_Property (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Total_Experience, Net_Salary, Residential_Status, Property_Type, Property_Value, Loan_Amount, Descr, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Contact_Time, Pincode, Residence_Address, source)
				//	VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Std_Code2', '$Phone2', '$Total_Experience', '$Net_Salary', '$Residential_Status', '$Property_Type', '$Property_Value', '$Loan_Amount', '$Descr', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Contact_Time', '$Pincode', '$Residence_Address', '$source' )";
		
			$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Total_Experience"=>$Total_Experience, "Net_Salary"=>$Net_Salary, "Residential_Status"=>$Residential_Status, "Property_Type"=>$Property_Type, "Property_Value"=>$Property_Value, "Loan_Amount"=>$Loan_Amount, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Contact_Time"=>$Contact_Time, "Pincode"=>$Pincode, "Residence_Address"=>$Residence_Address, "source"=>$source);
			$table = 'Req_Loan_Against_Property';
			$insert = Maininsertfunc ($table, $dataInsert);
			
			
			
			//$result = ExecQuery($sql);
			getEligibleBidders("property","$City","$Phone");
			echo "<script language=javascript>alert('Your Request has been added Successfully.');"."</script>";
		}
		
		else
			{
			$result = ExecQuery($sql);
			$rows = mysql_num_rows($result);
			getEligibleBidders("property","$City","$Phone");
			$strDir = dir_name();
			if($Email!="")
			{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."Request_Loan_Against_Property_New.php");
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
<title>Loan Against Property in Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad and Chennai</title>
<meta name="description" content="Get online information about loan against property schemes of all loan against property provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="Loan Against Property, apply online for loan against property, loan against property providers, loan against property schemes, Mumbai, Delhi, Bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script language="javascript">
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
	if(document.loan_form.Phone.value!="")
	{
		if (!validmobile(document.loan_form.Phone.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Phone.focus();
			return false;
		}
	}
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
	
		
	if (document.loan_form.Residence_Address.value=="")
	{
		alert("Please enter Residence Address.");
		document.loan_form.Residence_Address.focus();
		return false;
	}
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
	
	if (document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Net Salary.");
		document.loan_form.Net_Salary.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Net_Salary, 'Net Salary',0))
		return false;
		
	if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
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
</script>
<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
     <?php include '~Upper.php';?>
    <div id="dvbannerContainer"><table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><img src="images/lap1.gif" usemap="#map_name1"></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">A dream comes true! An ALL PURPOSE LOAN for anything that life throws up at you!! Do you need funds for a Marriage ceremony, want to take your family to a well-deserved holiday or for a sudden medical emergency? You have some property, but would rather not sell it? Then why not avail of this ALL PURPOSE LOAN. We now 
      make it very much possible for you to only keep your property but also have liquid funds against it.</td></tr></table>  <map name="map_name1">
  <area shape="rect" coords="17,52,120,70" hrEF="Contents_Loan_Against_Property_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="Request_Loan_Against_Property_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="Contents_Loan_Against_Property_Mustread.php">
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
<tr><td align="center" class="head2">Loan Against Property Request<td></tr>
<tr><td>&nbsp;</td></tr>
		<tr>
		 <td>

    			<center>
  <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
 <!--  <p class="head2" align="center">Loan Against Property Request</p>-->
   <table width="510" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   
   <? if(!isset($_SESSION['UserType'])) {?>
		<tr>
			<td width="30%" class="bodyarial11">Your Email Address</td>
			<td width="70%" class="bodyarial11"><input type="text" name="Email" size="30" onFocus="return Decoration('*')" onBlur="return Decoration1(' ')"></td>
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
       <td class="bodyarial11">Mobile (For SMS Alerts)<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" style="width:16px;" name="Zero" size="1" maxlength="1" value="0" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";><input type="text" name="Phone" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
	 <tr>
       <td class="bodyarial11" align="bottom">Residence Landline No</td>
	   <td class="bodyarial11"><input type="text" name="Std_Code1" size="1" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";><input type="text" name="Phone1" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
	 <tr>
       <td class="bodyarial11" align="bottom">Office Landline No</td>
	   <td class="bodyarial11"><input type="text" name="Std_Code2" size="1" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";><input type="text" name="Phone2" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
 
    <!--  <tr>
     <td>Date of Birth<font size="1" color="#FF0000">*</font></td>
	 <td><select name = 'day'>
    <?php
    for ($x = 1; $x <= 31; $x++) {
        echo "<option value = $x>$x</option>";
    }
    ?>
    </select>
    <select name = 'month'>
    <?php
    for ($x = 1; $x <= 12; $x++) {
        echo "<option value=$x>".date('F', mktime(0, 0, 0, $x, 1, 1)).'</option>';
    }
    ?>
    </select>
    <select name = 'year'>
    <?php
    for ($x = 1900; $x <= 2006; $x++) {
        echo "<option value=$x>$x</option>";
    }
    ?>
    </select>
	</td>
   </tr>-->
   <tr>
     <td class="bodyarial11">Employment Status</td>
     <td class="bodyarial11"><select size="1" name="Employment_Status">
     	<option selected value="1">Salaried</option>
     	<option value="0">Self Employed</option>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Company Name<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11"><input type="text" name="Company_Name" size="30"></td>
   </tr>
      <tr>
     <td valign="top" class="bodyarial11">Residence Address<font size="1" color="#FF0000">*</font></td>
     <td  class="bodyarial11"><textarea rows="3" name="Residence_Address" cols="40"> </textarea></td>
   </tr>
   <tr>
     <td class="bodyarial11">City Name<font size="1" color="#FF0000">*</font></td>
	 <td class="bodyarial11"><select size="1" name="City" onChange="cityother()">
     <?=getCityList($City)?>
	 </select>
	 </td>
   </tr>
   <tr>
     <td class="bodyarial11">Others</td>
     <td width="70%" class="bodyarial11"><input type="text" name="City_Other" disabled value="Other City" onFocus="this.select();" size="10"></td>
     </td>
   </tr>
  
   <tr>
     <td class="bodyarial11">Pincode<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="bodyarial11"><input type="text" name="Pincode"  onFocus="this.select();" size="10" maxlength="6"></td>
     </td>
   </tr>
   <tr>
     <td class="bodyarial11">Total Experience/<br>
     Total Years in Business<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
     <input type="text" name="Total_Experience" size="15" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Net Salary(Yearly)<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
     <input type="text" name="Net_Salary" size="15" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Residential Status</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Residential_Status" class="NoBrdr" checked>Owned
     <input type="radio" value="2" name="Residential_Status" class="NoBrdr">Rented<input type="radio" value="3" name="Residential_Status" class="NoBrdr">Company Provided</td>
   </tr>
   <tr>
     <td class="bodyarial11">Property Type</td>
     <td class="bodyarial11"><select size="1" name="Property_Type">
     <option value="0" selected>Commercial Office Space</option>
     <option value="1">Apartment</option>
     <option value="2">Industrial House</option>
     <option value="3">Showroom</option>
     <option value="4">Factory</option>
     <option value="5">Plot</option>
     <option value="6">Godown</option>
     <option value="7">Bungalow</option>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Value Of Property<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
     <input type="text" name="Property_Value" value="0" size="15"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Loan Amount Required<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
     <input type="text" name="Loan_Amount" size="15" value="0"></td>
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
   <tr>
     <td valign="top" class="bodyarial11">Special Requirements</td>
     <td class="bodyarial11"><textarea rows="5" name="Descr" cols="40"> </textarea></td>
   </tr>
  
   
   <tr>
     <td colspan="2" align="center" class="bodyarial11"><br><input type="submit" class="bluebutton" value="Submit">
       &nbsp;
       <input type="reset" class="bluebutton" value="Reset"></td>
   </tr>
    
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