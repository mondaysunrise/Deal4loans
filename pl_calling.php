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
		//$PWD1 = FixString($PWD1);
		$FName = FixString($FName);
		$LName = FixString($LName);
		
		$Name=$FName." ".$LName;
		
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Pincode = FixString($Pincode);
		
		$DOB=$Year."-".$Month."-".$Day;
		//$Zero = FixString($Zero);
		$Phone = FixString($Phone);
		$Phone1 = FixString($Phone1);
		$Phone2 = FixString($Phone2);
		$Std_Code1 = FixString($Std_Code1);
		$Std_Code2 = FixString($Std_Code2);
		$Reference_Code = generateNumber(4);
		$Email = FixString($Email);
		$Item_ID = FixString($Item_ID);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Years_In_Company = FixString($Years_In_Company);
		$Total_Experience = FixString($Total_Experience);
		$Net_Salary = FixString($Net_Salary);
		$Contact_Time = FixString($Contact_Time);
		//$Phone=$Zero."".$Phone;
		$Net_Salary_Monthly = $Net_Salary / 12;
		  $IsPublic = 1;
		  $source = calling;
		  $Dated = ExactServerdate();

		$_SESSION['Temp_Type'] = "PersonalLoan";
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
		$_SESSION['Temp_Years_In_Company'] = $Years_In_Company;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		$_SESSION['Temp_Total_Experience'] = $Total_Experience;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		$_SESSION['Temp_Marital_Status'] = $Marital_Status;
		$_SESSION['Temp_Residential_Status'] = $Residential_Status;
		$_SESSION['Temp_Vehicles_Owned'] = $Vehicles_Owned;
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		//}
	
		$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;

		//SQL Query
		if(isset($_SESSION['UserType'])) 
		{
			

			$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Std_Code_O'=>$Std_Code2, 'Landline_O'=>$Phone2, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'Net_Salary'=>$Net_Salary, 'Marital_Status'=>$Marital_Status, 'Residential_Status'=>$Residential_Status, 'Vehicles_Owned'=>$Vehicles_Owned, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Contact_Time'=>$Contact_Time, 'Pincode'=>$Pincode, 'Reference_Code'=>$Reference_Code, 'source'=>$source);
		}

		else 
		{
		
			$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Std_Code_O'=>$Std_Code2, 'Landline_O'=>$Phone2, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'Net_Salary'=>$Net_Salary, 'Marital_Status'=>$Marital_Status, 'Residential_Status'=>$Residential_Status, 'Vehicles_Owned'=>$Vehicles_Owned, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Contact_Time'=>$Contact_Time, 'Pincode'=>$Pincode, 'Reference_Code'=>$Reference_Code, 'source'=>$source);
			if($Email=="")
			{
				echo "<script language=javascript>"." location.href='Request_Loan_Personal_Ext.php'"."</script>";
			}
			
		}
		
		$Email_New = $Email;
		$Name_New = $Name;
		
		$Email = trim($Email);

			$qry_user="SELECT UserID FROM wUsers WHERE Email='".$Email."'";
			list($recordcount,$row_user)=MainselectfuncNew($qry_user,$array = array());
			$k=0;

			if($recordcount>0)
			{
			$UserID1=$row_user[$k]["UserID"];
					
			$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status,"Company_Name"=>$Company_Name,  "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Years_In_Company"=>$Years_In_Company, "Total_Experience"=>$Total_Experience, "Net_Salary"=>$Net_Salary, "Marital_Status"=>$Marital_Status, "Residential_Status"=>$Residential_Status, "Vehicles_Owned"=>$Vehicles_Owned, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Contact_Time"=>$Contact_Time, "Pincode"=>$Pincode, "Reference_Code"=>$Reference_Code, "source"=>$source);
			$table = 'Req_Loan_Personal';
			$insert = Maininsertfunc ($table, $dataInsert);
			
			
			//getEligibleBidders("personal","$City","$Phone");
			SendPLLeadToICICI($FName, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			echo "<script language=javascript>"."location.href='Request_Loan_Personal_Ext.php'"."</script>";
			
		}
		
		else
		{
			$_SESSION['Temp_Flag_Message'] = "1";
		$table = 'Req_Loan_Personal';
			$insert = Maininsertfunc ($table, $dataInsert);
			
			//getEligibleBidders("personal","$City","$Phone");
			SendPLLeadToICICI($FName, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			$strDir = dir_name();
//			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."User_Register_New.php");
			if($Email!="")
			{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
			
			}
		}
			
		if ($result == 1 && isset($_SESSION['UserType']))
		{
			$Msg = getAlert("Your request has been added. !!", TRUE, "Request_Loan_Personal_Ext.php");
		}
    }
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title> Personal Loans in Delhi | Personal Loan in Mumbai | Personal Loans in Kolkata | Noida Personal Loans</title>
<meta name="description" content="Get online information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<meta name="keywords" content="personal loans in delhi, personal loan in Mumbai, personal loans in kolkata, noida personal loans, Mumbai, Delhi, Bangalore">
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
  	alert ("First Name has special characters.\n Please remove them and try again.");
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
</Script>
<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
   <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <table width="777" height="161" Style="border:collaspe;" bgcolor="0F74D4"><tr><td valign="top"><img src="images/personal_loan1.gif" usemap="#map_name5"></td><td valign="middle" style="padding-left:10px" ><font class="newstyle">A wedding in the family. Maybe your house needs renovation. Or your daughter has obtained admission to a medical college.. Gift your wife a beautiful gold pendant, pay for your children’s higher education, or send your parents on a much-needed holiday- we offer various kinds of personal loans to fulfill your dreams in India.</td></tr></table> <map name="map_name5">
  <area shape="rect" coords="17,52,120,70" hrEF="Contents_Personal_Loan_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="Request_Loan_Personal_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="Contents_Personal_Loan_Mustread.php">
   <area shape="rect"coords="17,140,80,100" hrEF="Contents_Personal_Loan_Faqs.php">
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
<tr><td align="center" class="head2">Personal Loan Request<td></tr>
<tr><td>&nbsp;</td></tr>
		<tr>
		 <td>
<center>
      <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">
  <!-- <p class="head2" align="center">Personal Loan Request</p><br>-->
 
   <table border="0" width="510"cellpadding="4" cellspacing="0" class="blueborder" id="frm" align="center">
  
   <? if(!isset($_SESSION['UserType'])) {?>
   <tr>
                <td class="bodyarial11">Your Email Address</td>
     <td class="bodyarial11">
     <input type="text" name="Email" size="30" onFocus="return Decoration('*')" onBlur="return Decoration1(' ')"></td>
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
       <td class="bodyarial11"><input type="text" name="Zero" size="1" maxlength="1" value="0" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";><input type="text" name="Phone" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onFocus="return Decorate('Please give correct Moblie number, to activate your loan request.')"  onBlur="return Decorate1(' ')"><div id="plantype2" style="position:absolute;font-size:10px;width:200;font-weight:none; " ></div></td>
     </tr>
	 <tr>
       <td class="bodyarial11" align="bottom">Residence Landline No</td>
	   <td class="bodyarial11"><input type="text" name="Std_Code1" size="1" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";><input type="text" name="Phone1" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
	 <tr>
       <td class="bodyarial11" align="bottom">Office Landline No</td>
	   <td class="bodyarial11"><input type="text" name="Std_Code2" size="1" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";><input type="text" name="Phone2" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>
     </tr>
     <tr>
     <td class="bodyarial11">Employment Status</td>
     <td class="bodyarial11"><select size="1" name="Employment_Status">
     	<option selected value="1">Salaried</option>
     	<option value="0">Self Employed</option>
     </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Company Name<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11"><input type="text" name="Company_Name" size="30" maxlength=""></td>
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
     <td width="70%" class="bodyarial11"><input type="text" name="Pincode" onFocus="this.select();" size="10" maxlength="6"></td>
     </td>
   </tr>
   <tr>
     <td class="bodyarial11">No. of years in this Company<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
     <input type="text" name="Years_In_Company" size="15" maxlength="15" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Total Experience(Years)/<br>
     Total Years in Business<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
     <input type="text" name="Total_Experience" size="15" maxlength="15" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Net Salary(Yearly)<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11">
     <input type="text" name="Net_Salary" size="15" maxlength="30" value="0"></td>
   </tr>
   <tr>
     <td class="bodyarial11">Marital Status</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Marital_Status" class="NoBrdr" checked>Single
     <input type="radio" value="2" name="Marital_Status" class="NoBrdr">Married</td>
   </tr>
   <tr>
     <td class="bodyarial11">Residential Status</td>
     <td class="bodyarial11"><input type="radio" value="1" name="Residential_Status" class="NoBrdr" checked>Owned
     <input type="radio" value="2" name="Residential_Status" class="NoBrdr">Rented<input type="radio" value="3" name="Residential_Status" class="NoBrdr">Company Provided</td>
   </tr>
   <tr>
     <td class="bodyarial11">Vehicles Owned</td>
     <td class="bodyarial11">
     <select size="1" name="Vehicles_Owned">
     <option selected value="0">2 Wheeler</option>
     <option value="1">4 Wheeler</option>
     <option value="2">Other</option>
     </select></td>
   </tr>
  
   <tr>
     <td class="bodyarial11">Are you a Credit Card Holder of Any Bank</td>
     <td class="bodyarial11">
     <input type="radio" value="1" checked name="CC_Holder" class="NoBrdr">Yes
     <input type="radio" value="0"  name="CC_Holder" class="NoBrdr">No</td>
   </tr>
   <tr>
     <td class="bodyarial11">Loan Amount Required<font size="1" color="#FF0000">*</font></td>
     <td class="bodyarial11"><input type="text" name="Loan_Amount" size="15" maxlength="30" value="0"></td>
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
     <td class="bodyarial11">Make Contact Public**</td>
     <td class="bodyarial11"><input class="NoBrdr" type="checkbox" name="IsPublic" value="1" checked></td>
   </tr>
    <tr>
     <td colspan="2" align="center"><br><input type="submit" class="bluebutton" value="Submit"> 
       &nbsp;
       <input type="reset" class="bluebutton" value="Reset"></td>
   </tr>
    <tr>
     <td colspan="2"><font style="font-weight:normal; font-size:9;">Clicking "Submit" means that you agree to the terms of the Deal4Loans <a href="Privacy.php" target="_blank">Terms and Condition</a> and <a href="Privacy.html" target="_blank">Privacy</a> statement.</font>	</td> 
   </tr>
   
   <tr>
     <td colspan="2"><font size="-10" style="font-size:9; font-weight:normal;">** If you do not select this option, your privacy is assured & you will receive SMS & Emails.Otherwise your contact details will be shared with the associated banks.</font>	</td> 
   </tr></table>
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