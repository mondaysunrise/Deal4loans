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

   function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
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
		
		$Phone = FixString($Phone);
		$Std_Code = FixString($Std_Code);
		$Std_Code_O = FixString($Std_Code_O);
		$Landline_O = FixString($Landline_O);
		$Phone1 = FixString($Phone1);
		$Email = FixString($Email);
		$Item_ID = FixString($Item_ID);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		//$Years_In_Company = FixString($Years_In_Company);
		//$Total_Experience = FixString($Total_Experience);
		$Type_Loan = FixString($Type_Loan);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Net_Salary = FixString($Net_Salary);
		$Net_Salary_Monthly = $Net_Salary / 12;
		//if(!isset($IsPublic))
		   $IsPublic = 1;
		$source=$_REQUEST['refsite'];
		$_SESSION['Temp_Type'] = "PersonalLoan";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_PWD1'] = $PWD1;
		$_SESSION['Temp_FName'] = $FName;
		$_SESSION['Temp_LName'] = $LName;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_Phone1'] = $Phone1;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_Std_Code_O'] = $Std_Code_O;
		$_SESSION['Temp_Std_Code'] = $Std_Code;
		$_SESSION['Temp_Landline_O'] = $Landline_O;
		
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
		$_SESSION['Temp_Pincode'] = $Pincode;
		$_SESSION['Temp_Contact_Time'] = $Contact_Time;
		//$_SESSION['Temp_Years_In_Company'] = $Years_In_Company;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		//$_SESSION['Temp_Total_Experience'] = $Total_Experience;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		//}
		//$Marital_Status = FixString($Marital_Status);
		//$Residential_Status = FixString($Residential_Status);
		//$Vehicles_Owned = FixString($Vehicles_Owned);
		//$Loan_Any = FixString($Loan_Any);
	//	$EMI_Paid = FixString($EMI_Paid);
		//$CC_Holder = FixString($CC_Holder);
		$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;	
		

		//SQL Query
		if(isset($_SESSION['UserType'])) 
		{
			

		$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time)
			VALUES ( '$UserID', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time' )"; 
			
		}
		
		else
			{
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time)
			VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time' )"; 
		}

		$Email = trim($Email);
		$query = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
		$msgUserExist = "You are Previously Registered Member of this Site, Please Login !!!";
		$msgUserDoesNotExist = "Email does not exists in the database";
		 list($rows,$getrow)=MainselectfuncNew($query,$array = array());
		$cntr=0;
	//	$result = ExecQuery($query);
		//$rows = mysql_num_rows($result);		
		//echo mysql_error();

		if(isset($_SESSION['UserType']))
				{
			$result = ExecQuery($sql);
			$rows = mysql_num_rows($result);
			getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");

			if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($FName, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}

			$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "myRequests.php");
			echo $Msg;
			//echo "<script language=javascript>location.href='t_y.php?r_url=myRequests.php'"."</script>";
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
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time)
			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time' )"; 
	
		
			$result = ExecQuery($sql);
			getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");

			if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($FName, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}

			//echo "<script language=javascript>location.href='t_y.php?r_url=loans_request.php'"."</script>";
			echo "<script language=javascript>location.href='t_y.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
		}
		
		else
			{
			$result = ExecQuery($sql);
			getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");

			if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($FName, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}

			$rows = mysql_num_rows($result);
			$_SESSION['Temp_Flag'] = "0";
			$strDir = dir_name();
				if($Email!="")
				{
					//header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
					echo "<script language=javascript>location.href='User_Register_New.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
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
<title>Apply Online for Loan : Compare Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<style>
.style1{
font-size:12px;
line-height:150%;
color:68718A;
font-weight:bold;
font-Family:Verdana;
}
.style4{
font-size:10px;
font-weight:bold;
color:666699;
font-Family:Verdana;
}
.style3{
font-size:12px;
color:68718A;
font-weight:bold;
line-height:150%;
font-Family:Verdana;
}
.style2{
font-size:12.5px;
color:white;

font-weight:bolder;
font-Family:Verdana;
}
input, select {font:12px Arial; padding:2px; margin:0px; border: 1px solid #68718A;}
input.NoBrdr	{font:12px Arial; padding:0px; margin:0px; border: 0px}
</style>
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
function cityother(select)
{
	 var index;
	 
 
	 for(index=0; index<select.options.length; index++)
     if(select.options[index].selected)
     {
        if(select.options[index].value=="Others")
			document.loan_form.City_Other.disabled = false;
		else
			document.loan_form.City_Other.disabled = true;
        
      }
	
}
function initPage(strPlan)
{
       if (document.getElementById('plantype') != undefined)
       {
               document.getElementById('plantype').innerHTML = strPlan;
       }

       return true;
}
function chkform()
{
	<?
if($_SESSION['UserType']=="") 
{
?>	
	if(document.loan_form.Email.value!="Email Id")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}
		if((document.loan_form.PWD1.value=="") ||(document.loan_form.PWD1.value=="Password"))
		{
			alert("please fill password.");
			document.loan_form.PWD1.focus();
			return false;
		}
	}
	<?

}
?>
	if((document.loan_form.FName.value=="") || (document.loan_form.FName.value=="First Name"))
	{
		alert("Please fill your first name.");
		document.loan_form.FName.focus();
		return false;
	}
	if((document.loan_form.LName.value=="") || (document.loan_form.LName.value=="Last Name"))
	{
		alert("Please fill your Last name.");
		document.loan_form.LName.focus();
		return false;
	}
	if((document.loan_form.day.value=="")||(document.loan_form.day.value=="dd"))
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	if((document.loan_form.month.value=="")||(document.loan_form.month.value=="mm"))
	{
		alert("Please fill your month of birth.");
		document.loan_form.month.focus();
		return false;
	}
	if(!checkData(document.loan_form.month, 'Month', 2))
		return false;
	if((document.loan_form.year.value=="")||(document.loan_form.year.value=="yyyy"))
	{
		alert("Please fill your year of birth.");
		document.loan_form.year.focus();
		return false;
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	
		if(document.loan_form.Phone1.value!="")
	{
		if((document.loan_form.Std_Code.value=="")||(document.loan_form.Std_Code.value=="std"))
		{
			alert("Please fill your STD Code for Residence number.");
			document.loan_form.Std_Code.focus();
			return false;
		}
	}
	
	if(document.loan_form.Landline_O.value!="")
	{
		if((document.loan_form.Std_Code_O.value=="")||(document.loan_form.Std_Code_O.value=="std"))
		{
			alert("Please fill your STD Code for Office Landline number.");
			document.loan_form.Std_Code_O.focus();
			return false;
		}
	}
	
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}	
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
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
	
	if((document.loan_form.Company_Name.value=="") || (document.loan_form.Company_Name.value=="Company Name"))
	{
		alert("Please fill your Company name.");
		document.loan_form.Company_Name.focus();
		return false;
	}
	if(!checkData(document.loan_form.Company_Name, 'Company Name', 3))
		return false;

	if ((document.loan_form.Net_Salary.value=="")|| (document.loan_form.Net_Salary.value=="Annual Income(Rs.)"))
	{
		alert("Please enter Annual Income.");
		document.loan_form.Net_Salary.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;
	if((document.loan_form.Loan_Amount.value=="") || (document.loan_form.Loan_Amount.value=="Loan Amount"))
	{
		alert("Please fill your Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	if (document.loan_form.Type_Loan.selectedIndex==0)
	{
		alert("Please choose the product that you are looking for");
		document.loan_form.Type_Loan.focus();
		return false;
	}
	if(document.loan_form.Email.value=="Email Id")
	{
	document.loan_form.Email.value=" ";
	}

	if(document.loan_form.Std_Code.value=="std")
	{
	document.loan_form.Std_Code.value=" ";
	}

	if(document.loan_form.Std_Code_O.value=="std")
	{
	document.loan_form.Std_Code_O.value=" ";
	}


}
</script>
</head>
<body>
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();">

<!--div align="center"!-->
<table width="869" style="border: 1px solid #68718A;">
<tr>

	<td colspan="5" align="center" width="847"><img src="images/logopersonal1.gif">
	</td>

</tr>
	
<tr >
	<td width="4">&nbsp;</td>
	<td width="470" valign="top" align="right" >
    <table border="0" width="469">
	
		<tr>
			<td colspan="2" valign="top" width="463" ><img src="images/3steps.gif" align="left" >
			</td>
		</tr>
		
		<tr>
			<td width="28"><table  height="55" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td height="4"></td>
			</tr>
			<tr>
				<td height="13"><img src="images/arrow2.gif"></td>
			</tr>
			<tr>
				<td height="13" ><img src="images/arrow2.gif"></td>
			</tr>

			<tr>
				<td height="13"  ><img src="images/arrow2.gif"></td>
			</tr>
		</table>
		<td align="left" height="58" width="431" ><font class="style1"> Post your loan requirement<br />
		Get &amp; compare offers from all Banks<br />
		Go with the lowest bidder</font> </td>
		</tr>
		<tr>
	
				<td colspan="2" style="padding-left:33px;" width="431"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
					</tr>
					<tr>
	
				<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">The one-stop shop for best on all loan requirements</font></td>
					</tr>
					<tr>
					<td colspan="2" width="463"></td>
					</tr>
					<tr>
					
				<!--<td colspan="2" style="padding-left:22px; " bgcolor="0A71D9"><font color="white" style="font-weight:bold;">-->
				<td colspan="2" width="463"><table width="100%" border="0" >
				<tr>
				<td width="10">&nbsp;</td>
				<td bgcolor="0A71D9"><font class="style2">
				Testimonials</font></td>
					</tr>

				<tr>
					<td width="10">&nbsp;</td>
				<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1">I was able to compare rates & terms for my home loan and got best deal because <a href="http://www.deal4loans.com/">www.deal4loans.com</a> Keep up the good work.</font><br>
		
			<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px"> - Srinath Kumar</font><font class="style1"> TCS (Bangalore)</font>
				</td>
					</tr>
					

			<tr>
					<td width="10">&nbsp;</td>
				<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1">Got a good deal on my loans with the help of <a href="http://www.deal4loans.com">www.deal4loans.com</a><br>
			<font  style="font weight:bold;color:black;font-family:Verdana; font-size:12px">	- Ankit Sharma</font><font class="style1"> (Ahmedabad)</font>
				
				</td>
					</tr>
					<tr>
<td></td></tr>
<tr>
<td></td></tr>
<tr>

				<td width="10">&nbsp;</td>
				<td bgcolor="0A71D9"><font class="style2">
				Helpful tips to look/compare/apply for loans to get the best deal.</font></td>
					</tr>
</table></td>
				
        <tr>
				<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
				<td valign="top" width="431" ><font class="style3">Interest rates are the most critical of all the costs that you pay. Therefore you should go for the cheapest option. Beware of banking terms like flat interest rates that appear to be cheaper but are in fact the most expensive. For example a 7% flat rate would come out to an effective cost of around 13%. Therefore it’s better to choose a monthly reducing balance option than a half-yearly reducing option or flat-rate option. This means lower effective cost for the same stated interest rate. Interest-free loans are sometimes too good to be true but view them with suspicion.</font></td>
			</tr>
        <tr>
				<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
				<td valign="top" width="431" ><font class="style3">There will also be other costs such as processing charges. You should ask for zero processing fees and zero-penalty for pre-payment option. If this is not available, then lowest cost would be better. Make sure you work out as to how much these other costs add up to. So even though the interest rate may be lower, it usually adds up to being expensive.</font></td>

			</tr>
      
<tr><td width="28" >&nbsp;</td>
<td valign="top" width="431" >&nbsp;</td>
<tr><td colspan="2" width="463" ><a href="loans.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a></td></tr>
	</table></td>
	
	<td bgcolor="DAEAF9" width="314" valign="top" align="center" >
    <table border="0" height="100%" cellspacing="0" cellpadding="0" width="257">
		<tr><td width="278"></td> <td width="84"></td></tr>
		<tr >

		
		<td rowspan="2" align="center" valign="bottom"colspan="2" width="362"><font style="font-family:Verdana; font-weight:bold;font-size:12px"> Please fill in your details </font></td>
		
		</tr>
		<tr>
		<td colspan="2" align="center" bgcolor="#CEE6FD" width="4">&nbsp;</td><input type="hidden" name="refsite" value="<? echo $_REQUEST['refsite'] ?>"></td>

		</tr>
<tr>
		<td width="278" >&nbsp;</td>
		<td width="84">&nbsp </td>
		</tr>
		
		<tr>
			<td width="278">
            <table border="0" width="245" align="center" cellpadding="0" cellspacing="4" >
			<tr>
	
		
			<td colspan="4" align="left" width="348" height="18">
            <input size="39" value="First Name" name="FName" onFocus="this.select();" class="style4" style="float: left"></td>

		</tr>
		
		<tr>
	
			<td colspan="4" align="left" width="348" height="18">
            <input size="39" value="Last Name" name="LName" onFocus="this.select();" class="style4" style="float: left"></td>
			
		</tr>
		
		
		<tr>
       <td align="left" width="148" height="20"><font class="style4">&nbsp;DOB</font></td>
       <td colspan="3" align="right" width="196" height="20">
		<input name="day" value="dd" type="text" id="day" size="3" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" class="style4">
		<input name="month" id="month" size="4" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" class="style4">
		<input name="year" type="text" id="year" value="yyyy" size="4" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" class="style4">
       </td>

     </tr>

		<tr>
		
			<td align="left" class="style4" width="148" height="18"><font class="style4">&nbsp;Residence No.</font></td>
            <td  align="center" width="124" height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;<input type="text"  name="Std_Code" class="style4" size="3" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="std"></td>
            <td colspan="2" align="right" width="72" height="18"  >
			<input size="10" type="text" class="style4" name="Phone1" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>

		</tr>
		<tr>
		
			<td align="left" class="style4" width="148" height="18"><font class="style4">&nbsp;Office No.</font></td>
            <td  align="center" width="124" height="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;<input type="text"  name="Std_Code_O" class="style4" size="3" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="std"></td>
            <td colspan="2" align="right" width="72" height="18"  >
			<input size="10" type="text" class="style4" name="Landline_O" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>

		</tr>
		
		<tr>
		
			<td align="left" class="style4" colspan="2" width="274" height="18"><font class="style4">&nbsp;Mobile No.</font></td>
            <td colspan="2" align="right" width="72" height="18" >
			<p align="center">
			<input size="10" type="text" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" class="style4" name="Phone"></td>

		</tr></td>
	<? if(!isset($_SESSION['UserType'])) {?>
		<tr>
			<td align="left" colspan="4" align="center" width="348" height="18" ><input class="style4" size="39" value="Email Id" name="Email" onFocus="this.select();" style="float: left"></td>

		</tr>
		<tr><td align="left" width="148" height="18"><font class="style4">&nbsp;Password</font></td>
		<td  width="348" height="18" colspan="3" align="left"><input type="Password" class="style4" name="PWD1" size="24"></td>
		</tr>
		<? }?>
		 <tr>
     <td align="left" colspan="4" align="right" width="348" height="20" >
      <select size="1" align="left" style="width:251"  name="City" onChange="cityother(this)" class="style4">
     <?=getCityList1($City)?>
	 </select>
	 </td>
   </tr>
		<tr>
			<td colspan="4" align="center" width="348" height="18" >
            <input size="39" class="style4" disabled value="Other City"  onfocus="this.select();" name="City_Other" style="float: left"></td>

		</tr>
		<tr>
			<td colspan="4" align="center" width="348" height="18" >
            <input size="39" class="style4" value="PinCode"  onfocus="this.select();" name="Pincode" style="float: left"></td>

		</tr>
		<tr>
			<td align="left" colspan="4" width="348" height="18" >
            
            <select align="left" style="width:251" class="style4"  name="Employment_Status">
			<option selected value="1">Salaried</option>
			<option value="0">Self Employed</option>
			</select></td>

		</tr>
		
		<tr>
			<td colspan="4" align="center" width="348" height="18">
            <input size="39" class="style4" name="Company_Name" onFocus="this.select();" value="Company Name" style="float: left"></td>

		</tr>
		<tr>
			<td colspan="4" align="center" width="348" height="18" >
            <input size="39" class="style4" value="Annual Income(Rs.)" onFocus="this.select();" name="Net_Salary" style="float: left"></td>

		</tr>
	<tr>
	
			<td colspan="4" align="left" width="348" height="18">
            <input size="39" value="Loan Amount" name="Loan_Amount" onFocus="this.select();" class="style4" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; style="float: left"></td>
			
		</tr>
	 <tr>
     <td align="left" colspan="4" align="right" width="348" height="20" >
      <select size="1" align="left" style="width:251"  name="Type_Loan"  class="style4">
   <option value="1">I am looking for</option>
   <option value="Req_Loan_Personal">Personal Loan</option>
   <option value="Req_Loan_Home">Home Loan</option>
   <option value="Req_Loan_Car">Car loan</option>
   <option value="Req_Loan_Against_Property">Loan against Property</option>
   <option value="Req_Credit_Card">Credit Card</option>
	 </select>
	 </td>
   </tr>

   <tr>
   <td align="left" colspan="4" width="348" height="20">
   <select size="1" align="left" style="width:251" name="Contact_Time" class="style4">
  <option value="1">Prefered Time to Contact</option> 
  <option value="10- 12 am">10- 12 am</option> 
  <option value="12- 2 pm">12- 2 pm</option> 
  <option value="2- 4 pm">2- 4 pm</option>
  <option value="4- 6 pm">4- 6 pm</option>
  <option value="After 6 pm">After 6 pm</option>
  </select>
  </td>
  </tr>
                          
		</table>
		</td>
		</tr>
		
		 <tr><td colspan="2">&nbsp;</td></tr>
	
		<tr>
			<td colspan="2" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>

		</tr>
		</table></td>
		
	</td>
	<td width="62">&nbsp;</td>
</tr>
<tr bgcolor="DAEAF9"><td bgcolor="DAEAF9" colspan="5" width="847">&nbsp;</td></tr>

</table>
<!--/div!-->
</form>
</body>
</html>