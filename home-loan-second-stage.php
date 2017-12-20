<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


	function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
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
		
		$Name = FixString($Name);
		//$LName = FixString($LName);
		
		//$Name=$FName." ".$LName;
		//$last_id = FixString($last_id);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		
		$DOB=$Year."-".$Month."-".$Day;
		$last_id = FixString($last_id);
		$Phone = FixString($Phone);
		$Std_Code = FixString($Std_Code);
		$Std_Code_O = FixString($Std_Code_O);
		$Landline_O = FixString($Landline_O);
		$Phone1 = FixString($Phone1);
		$Email = FixString($Email);
		$Item_ID = FixString($Item_ID);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$Reference_Code = generateNumber(4);
		$CC_Holder = FixString($CC_Holder);
		$City_Other = FixString($City_Other);
		$Type_Loan = FixString($Type_Loan);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Net_Salary = FixString($IncomeAmount);
		$Residence_Address = FixString($Residence_Address);
		$Marital_Status = FixString($Marital_Status);
		$Pancard = FixString($Pancard);
		$From_Product = $_REQUEST['From_Product'];
		//echo "hello".$From_Product."<br>";
		$Net_Salary_Monthly = $Net_Salary / 12;
		//if(!isset($IsPublic))
		   $IsPublic = 1;
		$LName = "";
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$n       = count($From_Product);
		$i      = 0;
		//echo $n."<br>";
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		  // echo "bye".$From_Pro."<br>";
			
		$IP = getenv("REMOTE_ADDR");

		$Creative=$_REQUEST['creative'];
		$Section=$_REQUEST['section'];
		$_SESSION['Temp_Type'] = "PersonalLoan";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_Pancard'] = $Pancard;
		//$_SESSION['Temp_PWD1'] = $PWD1;
		$_SESSION['Temp_Name'] = $FName;
		$_SESSION['Temp_Reference_Code'] = $Reference_Code;
		$_SESSION['Temp_LName'] = $LName;
		$_SESSION['Temp_From_Pro'] = $From_Pro;
		$_SESSION['Temp_Residence_Address'] = $Residence_Address;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_Phone1'] = $Phone1;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_Std_Code_O'] = $Std_Code_O;
		$_SESSION['Temp_Std_Code'] = $Std_Code;
		$_SESSION['Temp_Landline_O'] = $Landline_O;
		$_SESSION['Temp_Type_Loan'] = $Type_Loan;
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
		//$_SESSION['Temp_CC_Holder'] = $CC_Holder ;
		
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		
		$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;	
		
		
		
		$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other." ".$Descr." ".$Residence_Address;
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
		/*$Name="Full Name";
		$City = "Select your City";
		$City_Other = "Other City";
		$Company_Name ="Company Name";
		$Email = "Email Id";
		*/
	
		//Checking for leads if the user is submiting the form by any means and nothing is getting captured
			if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!="" || $Name!="Full Name") && ($City != "Select your City") && ($City_Other!= "Other City") && ($Company_Name!= "Company Name"))
{		
	
			$todayformat = date("Y-m-d H:i:s"); 
			$exptodayformat = explode(" ",$todayformat);
			
			$ExpTimeFormat = explode(":",$exptodayformat[1]);
	
			$ExpTimeFormat[0] = $ExpTimeFormat[0]-1;
			$LessTime = implode(":", $ExpTimeFormat);
			$ArrayTime[0] = $exptodayformat[0];
			$ArrayTime[1] = $LessTime;
			$LessDateFormat = implode(" ", $ArrayTime);
		//Checking for duplicate lead in 1 Hr
			$CheckSql = "select * from ".$Type_Loan." where Name='".$Name."' and DOB='".$DOB."' and Mobile_Number='".$Phone."'  and Dated between '".$LessDateFormat."' and Now()";
			//exit();
			$CheckQuery = ExecQuery($CheckSql);
			$CheckQueryRow = mysql_fetch_array($CheckQuery);
			
			$CheckNumRows = mysql_num_rows($CheckQuery);
		if($CheckNumRows<1)
		{
		//SQL Query
		if(isset($_SESSION['UserType'])) 
		{
	


		$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address) VALUES ( '$UserID', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative' , '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address' )"; 
			
		}
		
		else
			{
			
		
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB,  CC_Holder,  Reference_Code, Residence_Address)
			VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address' )"; 

		}
//echo $sql;
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
				//getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			/*if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($Name, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}*/
			if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
		{
			$SMSMessage ="Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
			SendSMS($SMSMessage, $Phone);
		}
		

			$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "myRequests.php");
			echo $Msg;
			/*echo "<script language=javascript>location.href='t_y.php?r_url=myRequests.php'"."</script>";*/
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
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address)
			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address')"; 
	
		
			$result = ExecQuery($sql);
			//getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			/*if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($Name, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}*/
			if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
			{
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
			SendSMS($SMSMessage, $Phone);
			}
			if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home"))
			echo "<script language=javascript>location.href='thank_u.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
			
			/*echo "<script language=javascript>location.href='thanku.php'</script>";*/
		}
		
		else
			{
			$result = ExecQuery($sql);
			//getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			/*if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($Name, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);

			}*/
			
			$rows = mysql_num_rows($result);
			$_SESSION['Temp_Flag'] = "0";
			$strDir = dir_name();
				if($Email!="")
				{
					//header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
					if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home")){
						echo "<script language=javascript>location.href='thank_u.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
						}
					/*echo "<script language=javascript>location.href='thanku.php'</script>";*/
					echo mysql_error();
				}
			}
		echo mysql_error();

		if ($result == 1 && isset($_SESSION['UserType']))
			{
			$Msg = getAlert("Your request has been added. !!", TRUE, "myRequests.php");
			}
			
			
		}
		else
		{
		//If the Lead is getting duplicated then second stage form 
				if($Type_Loan=="Req_Credit_Card")
				{
					$productname = "CreditCard";
					$filename = "Contents_Credit_Card_Mustread.php?product=$productname";
				}
				else if($Type_Loan="Req_Loan_Personal")
				{
					$productname = "PersonalLoan";
					$filename = "Contents_Personal_Loan_Mustread.php?product=$productname";
				}
				else if($Type_Loan=="Req_Loan_Home")
				{
					$productname = "HomeLoan";
					$filename = "Contents_Home_Loan_Mustread.php?product=$productname";
				}
				header("Location: $filename");
				exit();
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

/*	$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}
*/

	$EmailID = $_SESSION['Temp_Email'];

	//$Email_New = $_SESSION['Temp_Email_New'];

	$Name_New = $_SESSION['Temp_Name_New'];

	$Net_Salary_Monthly = $_SESSION['Temp_Net_Salary_Monthly'];

	$Item_ID = $_SESSION['Temp_Item_ID'];

	$Type_Loan1 = $_SESSION['Temp_Type_Loan'];

	//$Message1 = $_SESSION['Temp_Message1'];

	$Flag_Message = $_SESSION['Temp_Flag_Message'];

	$Msg = "";

	$UserID_Message = "";
	
	 $From_Pt = $_SESSION['Temp_From_Pro'] ;
	//$FName = $_SESSION['Temp_Name'];
	
	$LName = $_SESSION['Temp_LName'];
	
	$DOB = $_SESSION['Temp_DOB'];
	
	//$PWD1 = $_SESSION['Temp_PWD1'];
	
	$Phone = $_SESSION['Temp_Phone'];

	$IsPublic = $_SESSION['Temp_IsPublic'];

	//Query to check if user exists

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
			
		if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
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
$FName = $Name;
$Checktosend="getthank_individual";
include "scripts/mailatcommonscript.php";

/*
				$headers  = 'MIME-Version: 1.0' . "\r\n";

				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$headers .= 'To: '.$fname.' <'.$EmailID.'>' . "\r\n";

				$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
				if($FName)
					$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
				else
					$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
				//echo $Type_Loan;
				if(isset($Type_Loan))
				{
					mail($EmailID, $SubjectLine, $Message2, $headers);
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
							
							$sub_sql = ExecQuery("Update Req_Life_Insurance SET UserID=".$UserID." Where Email='".$EmailID."'");

						mysql_free_result($sub_sql);

					}

				}

				

				/* Dump Resultset */

				mysql_free_result($result);
			if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home")){
				session_unset();
		}
				$Msg = getAlert("Congratulations!!! You have become our Registred User Now. Click OK to Continue !!", TRUE, "Login.php");

				}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>

<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks">
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<style type="text/css">
body{ margin-bottom:0px; margin-left:0px; margin-right:0px;	margin-top:0px;}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	line-height:20px;
}
.style2{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #0a71d9;
	font-weight: bold;
}
.style3{
	font-family: "Univers Condensed";
	font-size: 20px;
	color: #000000;
	line-height:30px;
}
h1{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: #2e2e2e;
	padding:0px;
	margin:0px
}
h2{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: #2e2e2e;
	padding:4px;
	padding-left:0px;
	margin:0px
}
.style4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	line-height:18px;
}
.inp {font:Arial; font-size:10px; color:#000000; border-left:1px solid #68718a; border-top:1px solid #68718a; border-right:1px solid #68718a; border-bottom:1px solid #68718a; width:110px; height:16px}
.inp1 {font:Arial; font-size:10px; color:#000000; border-left:1px solid #68718a; border-top:1px solid #68718a; border-right:1px solid #68718a; border-bottom:1px solid #68718a; width:30px; height:16px}
.inp2 {font:Arial; font-size:10px; color:#000000; border-left:1px solid #68718a; border-top:1px solid #68718a; border-right:1px solid #68718a; border-bottom:1px solid #68718a; width:34px; height:16px}
.inp3 {font:Arial; font-size:10px; color:#000000; border-left:1px solid #68718a; border-top:1px solid #68718a; border-right:1px solid #68718a; border-bottom:1px solid #68718a;}


</style>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<Script Language="JavaScript">
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


function submitform3(Form)
	{
		var btnvalidate;
		var cnt=-1;
		var i;
		var btn;
	//	btn=valButton(Form.Property_Identified);
	//	btnvalidate=valvalidate();
	
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
		
	if(!checkData(Form.Company_Name, 'Company Name', 3))
		return false;
		
		
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
			return false;
		}
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
	


















function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.validate.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr><td align="left" class="style4" width="210" height="20"><font class="style4">Reconfirm Mobile No.</font></td>	<td colspan="3" align="left" width="196" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" name="RePhone" ></td></tr></table>';
			}
			
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		return true;
		}

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
				ni.innerHTML = '<table border="0" width="100%"><tr><td align="left"  width="200" class="style4"  height="20"><font class="style4">Property Location 	</td><td  width="196" align="center"  height="20"><select size="1" align="center"   name="Property_Loc" class="style4">	  <?=getCityList1($Property_Loc)?>	 </select>			</td>			</tr>	</table>';
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
				ni1.innerHTML = '<table border="0"><tr><td align="left"  class="style4"  height="20">&nbsp;<input type="checkbox" name="update" class="noBrdr" ></td><td  align="left"  height="20"><font class="style4">Can we tell you about some properties	</td></tr>	</table>';
			}
		}
		
		return true;

	}
	
	
	
</Script>
</head>

<body onbeforeunload="HandleOnClose('closedby_hl.php')">
<form name="loan_form" method="post" action="t_y1.php" onSubmit="return submitform3(document.loan_form);">

<table width="750" style="border:solid 1px #000000;" align="center" cellspacing="0" cellpadding="0">
  	<tr>
		<td>
			<table width="750" border=0 cellspacing="0" cellpadding="0">	
				<tr>
				<td><img src="images/im1.jpg" alt="Deal4Loans" width="750" height="215" /></td>
			  </tr>
			 <tr>
				<td height="24" style="background-image:url(images/bg2.jpg); background-repeat:no-repeat; background-position:right; padding-left:25px"><h1>Now watch all Banks compete to give you their Best Rates</h1></td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="59%" valign="top">
							<table width="61%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td><img src="images/im2.jpg" width="445" height="52" /></td>
							  </tr>
							  <tr>
								<td style="padding-left:24px; padding-top:22px;"><p><img src="images/bullet.jpg" width="8" height="11" /> <span class="style1">Post your Personal loan requirement</span><br />
							      <img src="images/bullet.jpg" width="8" height="11" /> <span class="style1">Get &amp; compare offers from all Banks.</span><br />
							    <img src="images/bullet.jpg" width="8" height="11" /> <span class="style1">Go with the lowest bank.</span></p>
							    <span class="style2">www.deal4loans.com</span><br />
							    <span class="style1">The one-stop shop for best on all Personal loan requirements<br />
Now get offers from <strong>ICICI, HDFC, Deutsche, Citibank, HSBC,  Kotak,</strong><br />
<strong>Standard Chartered,</strong> and<strong> IDBI</strong> and choose the best deal! </span><br /><br />
									<table width="390" height="150" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td valign="top" style="background-image:url(images/bg.jpg); padding-top:28px;;"><span class="style3">Testimonials</span><br />
										   <span class="style1">I think that the launch of a service like www.deal4loans.com will ease<br />
										    the loan seeking and deal hunting process for the likes of me.<br />
									    I wish u guys all the success.<br /> - Divya</span></td>
									  </tr>
								  </table>

								</td>
							  </tr>
						  </table>

						</td>
						<td width="41%" valign="top"><table style="background-color:#c0d8ef;" width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td style="padding-left:12px; padding-right:12px; padding-bottom:12px; padding-top:12px">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <tr>
										<td colspan="2" class="style2">Personal Loan Request - Step 2 of 2</td>
									  </tr>
									  <input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
									  <input type="hidden" name="Type_Loan" value="Req_Loan_Home">
									  <input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>" />
									  <input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
									  <input type="hidden" name="source" value="<? echo $_REQUEST['source'] ?>">
									  <input type="hidden" name="last_id" value="<? echo $last_id; ?>">
			 						  <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
									  <?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Activation Code?</td>
										<td width="40%"><input size="20"  maxlength="10" name="Reference_Code1" class="style4" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana; " ></div></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
																	  <tr>
										<td class="style4" colspan="2">
									  <input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
				   <font class="style4">if you havent received activation code sms</font>
				   </td></tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>

									  <tr><td colspan="2" id="myDiv" ></td></tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Company Name </td>
										<td width="40%"><input size="20" class="style4" name="Company_Name"  onfocus="this.select();" style="float: left"></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Property Identified </td>
										<td width="40%"><input type="radio"  name="Property_Identified"  class="NoBrdr"  value="1" onClick="addIdentified();"><font class="style4">Yes</font>&nbsp;<input size="10" type="radio" class="NoBrdr" name="Property_Identified" onClick="removeIdentified();" value="0" ><font class="style4">No</font></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr><td colspan="2" id="myDiv1"></td></tr>
									  <tr><td colspan="2" id="myDiv2"></td></tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">Estimated market value of the property? </td>
										<td width="40%"><select name="Budget" style="width:150"  class="style4" >
					<option value="-1" selected>Please Select</option>
					<option value="Upto 7 Lakhs">Upto 7 Lakhs </option>
					<option value="7-15 Lakhs">7-15 Lakhs </option>
					<option value="15-20 Lakhs">15-20 Lakhs </option>
					<option value="20-25 Lakhs">20-25 Lakhs </option>
					<option value="Above 25 Lakhs">Above 25 Lakhs</option></select></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" valign="top" class="style4">When you are planning to take loan? </td>
										<td width="40%"><select name="Loan_Time" style="width:150" class="style4" >
            <OPTION value="-1" selected>Please select</OPTION>
			<OPTION value="15 days">15 days</OPTION>
			<OPTION value="1 month">1 months</OPTION>
			<OPTION value="2 months">2 months</OPTION>
			<OPTION value="3 months">3 months</OPTION>
			<OPTION value="3 months above">more than 3 months</OPTION></SELECT></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td colspan="2" style="height:5px;"></td>
									  </tr>
									  <tr>
										<td width="60%" class="style4">&nbsp;</td>
										<td width="40%"><input  type="image" src="images/submit.jpg" style="border: 0px;"></td>
									  </tr>
								  </table>

								</td>
							  </tr>
							</table>
						</td>
					  </tr>
				  </table>
					
				</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td class="style4" style="padding-left:24px; padding-top:22px;"><h2>Helpful tips to look/compare/apply for loans to get the best deal.
						</h2>
						  <span class="style4"><strong>Personal loans</strong> are provided on the basis of your income, mainly estimation given by banks is on the basis of your income &<br>
most of loans are happening on the basis of the track record of the customer with any bank. <strong>Credit card usage/payments</strong><br /> also impact your<strong> personal loan eligibility</strong> & rates as it is an unsecured loan so banks try gauging your intention to pay loan.<br /> Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the<br /> variables before signing a loan agreement by different banks. The various parameters that you need to compare on Personal<br /> loan are :</span><br />
<br />
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="79%"><img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Eligibility.</span><br />
<img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Interest rates best suited.</span><br />
<img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Processing Fees.</span><br />
<img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Pre-payment/Foreclosure charges.</span><br />
<img src="images/bullet1.jpg" width="8" height="11" /> <span class="style4">Document required.</span> <br />
<img src="images/bullet1.jpg" width="8" height="11" /><span class="style4"> Turn Around Time.</span></td><td width="21%" valign="bottom" style="padding-right:35px;"><div align="right"><a href="/Contents_Home_Loan_Mustread.php"><img src="images/im3.jpg" width="94" height="30" border="0" /></a></div></td>
</tr>
</table>
						</td>
					 </tr>
				</table></td>
			  </tr>
			  <tr><td style="height:30px">&nbsp;</td></tr>
			</table>

		</td>
	</tr>
</table>
  </form>
  <script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>

</body>
</html>
