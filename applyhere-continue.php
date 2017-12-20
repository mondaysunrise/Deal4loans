<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
$R_URL=$_REQUEST['r_url'];
if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}
function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
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

//print_r($_POST);

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$last_id = FixString($last_id);
		$DOB=$Year."-".$Month."-".$Day;
		$Activate=FixString($Activate);
		$Phone = FixString($Phone);
		$Std_Code = FixString($Std_Code);
		$Std_Code_O = FixString($Std_Code_O);
		$Landline_O = FixString($Landline_O);
		$Phone1 = FixString($Phone1);
		$Email = FixString($Email);
		$Employment_Status= 1;
		$Item_ID = FixString($Item_ID);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$Reference_Code = generateNumber(4);
		$City_Other = FixString($City_Other);
		$Type_Loan = FixString($Type_Loan);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Residence_Address = FixString($Residence_Address);
		$Marital_Status = FixString($Marital_Status);
		$Net_Salary_Monthly = $Net_Salary / 12;
		//if(!isset($IsPublic))
		   $IsPublic = 1;
		$LName = "";
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		/*if($Type_Loan=="Req_Loan_Personal")
		{
		/*if($Employment_Status==1)
		{
			$Net_Salary = $_REQUEST["IncomeAmount"]*12;
		}
		else
		{
		$Net_Salary = FixString($IncomeAmount);
		}*/
		/*}
		else
		{
		$Net_Salary = FixString($IncomeAmount);
		}*/
$Net_Salary = FixString($IncomeAmount);
//print_r($_POST);

		$IP = getenv("REMOTE_ADDR");

		$Creative=$_REQUEST['creative'];
		$Section=$_REQUEST['section'];
		//$_SESSION['Temp_Type'] = "PersonalLoan";
		$_SESSION['Temp_Name'] = $Name;
		//$_SESSION['Temp_PWD1'] = $PWD1;
		$_SESSION['Temp_FName'] = $FName;
		$_SESSION['Temp_Reference_Code'] = $Reference_Code;
		$_SESSION['Temp_LName'] = $LName;
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
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		
		$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;	
		if($Activate>0)
		{
			$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
			$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
		}
		//echo "last inserted id".$last_id;
		//SQL query///
	//echo $sql ="Delete from Req_Apply_Here Where ApplyID = ".$last_id;
	 //ExecQuery($sql);

function InsertTataAig($RequestID, $ProductName)
	{
		$GetDateSql = "select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID";
		list($alreadyExist,$myrow)=MainselectfuncNew($GetDateSql,$array = array());
		$myrowcontr=count($myrow)-1;
		
		$TDated = $myrow[$myrowcontr]["Dated"];
		$TCity = $myrow[$myrowcontr]["City"];
		$Mobile = $myrow[$myrowcontr]["Mobile_Number"];
		$Dated=ExactServerdate();
		$Product_Name = getProductCode($ProductName);
		$data = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $data);
	}

		//SQL Query
		if(isset($_SESSION['UserType'])) 
		{

			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address, Updated_Date,Accidental_Insurance) VALUES ( '$UserID', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative' , '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address', Now() ,'$Accidental_Insurance')"; 
		}
		else
		{
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB,  CC_Holder,  Reference_Code, Residence_Address, Updated_Date,Accidental_Insurance) VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address', Now() ,'$Accidental_Insurance')"; 
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
				
			if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
		{
			$SMSMessage ="Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			//if(strlen(trim($Phone)) > 0)
			///SendSMS($SMSMessage, $Phone);;
		}

			//$Msg = getAlert("Thank You, Your request has been added. !!", TRUE, "myRequests.php");
			//echo $Msg;
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
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address,  Updated_Date,Accidental_Insurance)
			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address', Now(),'$Accidental_Insurance')"; 
			$result = ExecQuery($sql);
			//echo "220 hello: ".$sql;
			$Lid = mysql_insert_id();
			if($Accidental_Insurance==1)
			{
				$RequestID = $Lid;
				$ProductName = $Type_Loan;
				InsertTataAig($RequestID, $ProductName);
			}

			if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
			{
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			//if(strlen(trim($Phone)) > 0)
			//SendSMS($SMSMessage, $Phone);;
			}
			if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home"))
			{
				if($Type_Loan=="Req_Loan_Against_Property")
							$pagereference = "PropertyLoan";
						else if ($Type_Loan=="Req_Loan_Car")
							$pagereference = "CarLoan";
							//echo "line 241";
							
							echo "<script language=javascript>location.href='applyhere-continue.php?r_url=".getTransferURL($Type_Loan)."?product=".$pagereference."'"."</script>";
			
			}
			else
			{
				echo "<script language=javascript>location.href='applyhere-continue.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
			
			}
			
		}
		
		else
			{
			$result = ExecQuery($sql);
			//echo "second: ".$sql;
			$Lid = mysql_insert_id();
			if($Accidental_Insurance==1)
			{
				$RequestID = $Lid;
				$ProductName = $Type_Loan;
				InsertTataAig($RequestID, $ProductName);
			}
			$rows = mysql_num_rows($result);
			$_SESSION['Temp_Flag'] = "0";
			$strDir = dir_name();
				if($Email!="")
				{
					//header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
					if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home")){
						
						if($Type_Loan=="Req_Loan_Against_Property")
							$pagereference = "PropertyLoan";
						else if ($Type_Loan=="Req_Loan_Car")
							$pagereference = "CarLoan";
							//echo "line 273";
							echo "<script language=javascript>location.href='applyhere-continue.php?r_url=".getTransferURL($Type_Loan)."?product=".$pagereference."'"."</script>";
						
						
						
						
						}
						else
						{
							echo "<script language=javascript>location.href='applyhere-continue.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";						
						}
					/*echo "<script language=javascript>location.href='thanku.php'</script>";*/
					echo mysql_error();
				}
			}
		echo mysql_error();

		if ($result == 1 && isset($_SESSION['UserType']))
			{
			//$Msg = getAlert("Your request has been added. !!", TRUE, "myRequests.php");
			}
    }

	
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
	
	//$CC_Holder = $_SESSION['Temp_CC_Holder'] ;
		//echo $CC_Holder;

	$FName = $_SESSION['Temp_FName'];
	
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
			
		if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home") )
		{
		$SMSMessage = "Dear $Name,Thanks for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.";
		//if(strlen(trim($Phone)) > 0)
		//SendSMS($SMSMessage, $Phone);
		}
		
		else
			{
		$SMSMessage = "Dear $Name,Thank you for Registering with deal4loans.Your details are as follows: EmailID: $EmailID.";
			//if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			}
	}

//Code Added to mailtocommonscript.php
$FName = $Name;
$Checktosend="getthank_u";
include "scripts/mailatcommonscript.php";
				$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				if(isset($Type_Loan))
				{
					mail($EmailID,'Welcome to Deal4loans '.$FName, $Message2, $headers);
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
//echo "line 459";
				mysql_free_result($result);
			if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home")){
				
				if($Type_Loan=="Req_Loan_Against_Property")
							$pagereference = "PropertyLoan";
						else if ($Type_Loan=="Req_Loan_Car")
							$pagereference = "CarLoan";
							//echo "line 467";
							echo "<script language=javascript>location.href='applyhere-continue.php?r_url=".getTransferURL($Type_Loan)."?product=".$pagereference."'"."</script>";
							
				session_unset();
		}
		else
			{
				echo "<script language=javascript>location.href='applyhere-continue.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
			
			}
				//$Msg = getAlert("Congratulations!!! You have become our Registred User Now. Click OK to Continue !!", TRUE, "Login.php");

				}

				

?>			
<html>
<head>
<title>Apply Personal Home Loans| Deal4Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Apply Personal Loans, Apply Home Loans , Apply Loan Against Property, Compare Personal Loans, Compare Home Loans, Compare Loan Against Property">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Apply for home loans, car loans, personal loans, loans against property, loan providers and credit cards, Business loan on Deal4loans.com to get compatitive offers from major banks. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks.">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='http://www.deal4loans.com/scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "<img src='images/pl/add.gif' width='12' height='12' style='border:none;'> <b style='color:#666666;'>Know more</b>";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "<img src='images/pl/rmv.gif' width='12' height='12' style='border:none;'> <b style='color:#666666;'>Hide</b>";
	}
} 
</script>
<style>

body, form{
	margin:0px;
	padding:0px;
}

blktxt.img{
	vertical-align:middle;
}

input, select {	
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	font-weight:normal;
	padding:1px; 
	margin:0px; 
	border: 1px solid #68718A;
}

input .NoBrdr{
	border: none;
}

.whttxt{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFFFFF;
	font-weight:bold;	
}

.blktxt{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	text-align:justify;
	color:#003e5f;
	line-height:17px;
}
.brdr{
	border:1px solid #1b86bf;
	border-top:none;
	background-color:#f9fdff;
}
</style>
<body >
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="255" height="197" align="left" valign="top"><img src="images/pl/hdr-lft.jpg" width="255" height="197" /></td>
        <td width="258" height="197" align="left" valign="top"><img src="images/pl/hdr-mdl.jpg" width="258" height="197" /></td>
        <td width="267" height="197" align="left" valign="top"><img src="images/pl/hdr-rgt.jpg" width="267" height="197" /></td>
      </tr>
      <tr>
        <td width="255" height="84" align="left" valign="top"><img src="images/pl/frst-stp.jpg" width="255" height="84" /></td>
        <td width="258" height="84" align="left" valign="top"><img src="images/pl/scnd-stp.jpg" width="258" height="84" /></td>
        <td width="267" height="84"><img src="images/pl/thrd-stp.jpg" width="267" height="84" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="brdr"><table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><table width="98%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" class="blktxt"><b style="font-size:12px;">Personal Loans </b></td>
          </tr>
          <tr>
            <td class="blktxt" style="color:#333333;">The one-stop shop for best on all Personal loan requirements.   <b>Now Get Offers in 2 Minutes</b> from <b style="color:#bf4e17;">SBI, Citibank, HDFC Bank, Citifinancial, Fullerton </b>and Choose the Best Deal!</td>
          </tr>
          <tr>
            <td height="25" class="blktxt" style="padding-top:8px;"><b style="font-size:12px;">Home Loans </b></td>
          </tr>
          <tr>
            <td class="blktxt" style="color:#333333;">The one-stop shop for best on all Home loan requirements.   <b>Now Get Offers in 2 Minutes</b>  from <b style="color:#bf4e17;">SBI, LIC HFL, HDFC Ltd, Axis, ICICI HFC </b>and Choose the Best Deal!</td>
          </tr>
          <tr>
            <td height="25" class="blktxt" style="padding-top:8px;"><b style="font-size:12px;">Testimonial</b></td>
          </tr>
          
          <tr>
            <td class="blktxt" style="color:#333333;">I think that the launch of a service like www.deal4loans.com will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.<div style="font-weight:bold; float:right;">Divya</div></td>
          </tr>
          <tr>
            <td height="25" align="left" class="blktxt" style="padding-top:8px; "><b style="font-size:12px;"> 	 Helpful Tips to Look/Compare/Apply for Loans to Get the Best Deal.</b></td>
          </tr>
          <tr>
            <td align="left" class="blktxt" style="color:#333333;">Interest rates are the most critical of all the costs that you pay. Therefore you should go for the cheapest option. Beware of banking terms like flat interest rates that appear to be cheaper but are in fact the most expensive. </td>
          </tr>
          <tr>
            <td align="left">
<div class="blktxt" id="toggleText" style="display: none; color:#333333;">For example a 7% flat rate would come out to an effective cost of around 13%. Therefore its better to choose a monthly reducing balance option than a half-yearly reducing option or flat-rate option. This means lower effective cost for the same stated interest rate. Interest-free loans are sometimes too good to be true but view them with suspicion.<br>
<br>
There will also be other costs such as processing charges. You should ask for zero processing fees and zero-penalty for pre-payment option. If this is not available, then lowest cost would be better. Make sure you work out as to how much these other costs add up to. So even though the interest rate may be lower, it usually adds up to being expensive.<br><br>


Usually the EMIs may come out a lot more than what you can afford on a monthly basis. But keep in mind that you should know that lower tenure will reduce the loan amount and lower loan amount will reduce the tenure.<br>
<br>


Make sure that all deals and offers agreed upon are supported by relevant papers. So make sure you always ask for a letter in a banks letter-head mentioning the likes of, exact rate of interests, processing fees, pre-payment charges along with interest-schedule. Also before signing the documents, make sure you recheck all terms and conditions.<br>
<br>


 Do not at any circumstance give any false information. This may amount to fraud and could land you in trouble.<br>
<br>


 Do not sign any blank documents. Even if it takes you a few hours to fill-up the form, please do so. Do not leave anything for the executive to fill-up.<br>
<br>


 Finally, once you have received a loan do your best to pay it back as quickly as possible. Banks make their money off the interest they charge and the sooner you pay back a loan the less money you will have to pay in interest.</div>
<div style="float:right;"><a id="displayText" href="javascript:toggle();" class="blktxt" style="text-decoration:none;"><img src="images/pl/add.gif" width="12" height="12" style="border:none;"> <b style=" color:#333333;">Know more</b></a></div></td>
          </tr>
          
        </table></td>
        <td width="290" valign="top"><table width="290" border="0" align="right" cellpadding="0" cellspacing="0">
         
          <tr>
            <td width="290" height="15" valign="middle"><img src="images/pl/frm-tp.gif" width="290" height="15"></td>
          </tr>
          <tr>
            <td height="250" align="center" valign="middle" bgcolor="#2494d0" class="whttxt" style="font-size:13px;"> Thank You for Applying</td>
          </tr>
          <tr>
            <td width="290" height="15" align="left" valign="top"><img src="images/pl/frm-bt.gif" width="290" height="15" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<!-- Google Code for Loans-Only Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "raymCOnKkwEQh8-3_AM";
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=raymCOnKkwEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>
