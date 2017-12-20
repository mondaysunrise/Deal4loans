<?php

	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//echo "hello".$Type_Loan."<br>";
$R_URL=$_REQUEST['r_url'];

if(strlen($R_URL)>0)
	{
		Header("Refresh: 7 URL=".$R_URL);
	}



	/*function getReqValue($pKey){
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
   }*/
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



	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		$Name = FixString($Name);
		//$PWD1 = FixString($PWD1);
		//$FName = FixString($FName);
		//$LName = FixString($LName);
		
		//$Name=$FName." ".$LName;
		
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
		if($Type_Loan=="Req_Loan_Personal")
		{
		if($Employment_Status==1)
		{
			$Net_Salary = $_REQUEST["IncomeAmount"]*12;
		}
		else
		{
		$Net_Salary = FixString($IncomeAmount);
		}
		}
		else
		{
		$Net_Salary = FixString($IncomeAmount);
		}


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
		//$_SESSION['Temp_Years_In_Company'] = $Years_In_Company;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		//$_SESSION['Temp_Total_Experience'] = $Total_Experience;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		//$_SESSION['Temp_CC_Holder'] = $CC_Holder ;
		//echo $CC_Holder;
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
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
		//echo "last inserted id".$last_id;
		//SQL query///
	$sql ="Delete from Req_Apply_Here Where ApplyID = ".$last_id;
	 ExecQuery($sql);

function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;
		
		//$RowGetDate = mysql_fetch_array($GetDateSql);
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = getProductCode($ProductName);
		
		//$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		//$query = mysql_query($Sql);
		//echo $Sql;
		//exit();
		
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);

	}

		//SQL Query
		if(isset($_SESSION['UserType'])) 
		{
			

		$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address, Updated_Date,Accidental_Insurance)
			VALUES ( '$UserID', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative' , '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address', Now() ,'$Accidental_Insurance')"; 
			
		}
		
		else
			{
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB,  CC_Holder,  Reference_Code, Residence_Address, Updated_Date,Accidental_Insurance)
			VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address', Now() ,'$Accidental_Insurance')"; 
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
				
			if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Credit_Card") || ($Type_Loan=="Req_Loan_Home"))
		{
			$SMSMessage ="Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			//if(strlen(trim($Phone)) > 0)
			///SendSMS($SMSMessage, $Phone);;
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
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address,  Updated_Date,Accidental_Insurance)
			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address', Now(),'$Accidental_Insurance')"; 
			
			$result = ExecQuery($sql);
			//echo "hello: ".$sql;
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
							echo "<script language=javascript>location.href='thank_u.php?r_url=".getTransferURL($Type_Loan)."?product=".$pagereference."'"."</script>";
			
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
						
						{
						if($Type_Loan=="Req_Loan_Against_Property")
							$pagereference = "PropertyLoan";
						else if ($Type_Loan=="Req_Loan_Car")
							$pagereference = "CarLoan";
							echo "<script language=javascript>location.href='thank_u.php?r_url=".getTransferURL($Type_Loan)."?product=".$pagereference."'"."</script>";
						}
						
						
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

	

	$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
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
$Checktosend="getthank_u";
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

				mysql_free_result($result);
			if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home")){
				
				if($Type_Loan=="Req_Loan_Against_Property")
							$pagereference = "PropertyLoan";
						else if ($Type_Loan=="Req_Loan_Car")
							$pagereference = "CarLoan";
							
							echo "<script language=javascript>location.href='thank_u.php?r_url=".getTransferURL($Type_Loan)."?product=".$pagereference."'"."</script>";
							
				session_unset();
		}
				$Msg = getAlert("Congratulations!!! You have become our Registred User Now. Click OK to Continue !!", TRUE, "Login.php");

				}

				

			//else

			//	$Msg = "** There was a problem with your registration process. Please try again. !! ";

		

	

?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Deal4Loans - Home Loans, Personal Loans, Car Loans, Loan Against Property</title>
<meta name="keywords" content="home loans, car loans, personal loans, loans against property, credit cards, loan information, loan portal, loans india, online loan application, loan calculator, loan eligibility, banks india, easy loans, quick loans, EMI calculator, loan providers india, home loans banks, instant personal loan, quick car loans, compare loans">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<?//$Type_Loan="Req_Credit_Card"; $City="Delhi";
if(($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Credit_Card")&& ($Type_Loan!="Req_Loan_Home")) {?>

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
<?php if((($_REQUEST['flag'])!=1)) { ?>

   <?php include '~Upper.php';?><?php } ?>

    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
</div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
<html>
<head>

<table width="500"  border="0" cellspacing="0" cellpadding="0">
		<tr><td width="30">&nbsp;</td><td>&nbsp;</td></tr>
		<tr>
		<td width="30">&nbsp;</td>
            <td>
 
 <p><b><font color="#3366CC">Thank you!! Your Request has been added Successfully.........</font></b></p>

     &nbsp;</td>
     </tr>
	
	 <? if(isset($R_URL)) {?>
	 <tr><td colspan="2" align="center"><embed src="hdfc_lp/hdfc_cc_468x60.swf" width="468" height="60" type="application/x-shockwave-flash" ></embed></td></tr>
	 <? } ?>
	 
     </table>
	</div>
			<?php if((($_REQUEST['flag'])!=1)) { ?>

	  <?php include '~Right1.php';?>
	<!--  <img src="images/120_90.gif"><BR><BR>
	  	  <img src="images/120_240.gif">
	  -->
</div>
    <?php include '~Bottom.php';?><?php } ?>
	<?}
	 
else { ?>
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
	<script language="javascript">
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
	function submitform3(Form)
	{

		var btn;
		btn=valButton(Form.Property_Identified);
		if(!btn)
			{
				alert('please select you have identified any property or not');
				return false;
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
				
	function submitform(Form)
	{
		var btn;
		var btn2;
		var btn5;
		btn=valButton(Form.Pancard);
		btn2=valButton2();
		btn5=valButton5();
	/*	if(Form.Reference_Code1.value=="")
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
			if(!btn)
			{
				alert('please select you have a pancard or not.');
				
					return false;
			}

	<?php
	if($CC_Holder=="1") 
	{
	?>	
	if(!btn2)
	{
		alert('you have any active credit card from which bank.');
		return false;
	}
	else if(btn2)
		{
		if (Form.Card_Vintage.selectedIndex==0)
		{
			alert("Please select since how long you holding credit cards");
			Form.Card_Vintage.focus();
			return false;
		}
		
		}
		<?}?>
	if(!btn5)
		{
			alert('Please select have you applied with any of these banks in last 6 months or not');
				return false;
		}
			return true;
	}

	function submitform2(Form)
	{

	var btn2;
	btn2=valButton2();
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
<?php 
	if($CC_Holder==1) 
	{
	?>
	if(!btn2)
			{
				alert('Do you have any other credit card from which bank.');
				return false;
			}
<?}?>

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

	
	<!--div align="center"!-->
	<table width="720" align="center" style="border: 1px solid #68718A;">
	<tr>
		<td colspan="5" align="center" ><img src="images/logopersonal1.gif">
		</td>

	</tr>
	<tr>
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
				<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"> I think that the launch of a service like <a href="http://www.deal4loans.com/">www.deal4loans.com</a> will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.</font><br>
		
			<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >- Divya&nbsp; </font>
				</td>
					</tr>
							
				<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Helpful tips to look/compare/apply for loans to get the best deal.</font></td>
				</tr>
			</table>
		</td>
					
		<tr>
			<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
			<td valign="top" width="431" ><font class="style3">Interest rates are the most critical of all the costs that you pay. Therefore you should go for the cheapest option. Beware of banking terms like flat interest rates that appear to be cheaper but are in fact the most expensive. For example a 7% flat rate would come out to an effective cost of around 13%. Therefore it�s better to choose a monthly reducing balance option than a half-yearly reducing option or flat-rate option. This means lower effective cost for the same stated interest rate. Interest-free loans are sometimes too good to be true but view them with suspicion.</font>
			</td>
		</tr>
		<tr>
		<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
		<td valign="top" width="431" ><font class="style3">There will also be other costs such as processing charges. You should ask for zero processing fees and zero-penalty for pre-payment option. If this is not available, then lowest cost would be better. Make sure you work out as to how much these other costs add up to. So even though the interest rate may be lower, it usually adds up to being expensive.</font></td>

			  </tr>
		
		  
		<tr>	
			<td width="28" >&nbsp;</td>
			<td valign="top" width="431" >&nbsp;</td>
		<tr>
			<td colspan="2" width="463" ><a href="loans.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a>
			</td>
		</tr>
		</table>
	</td>
		<td bgcolor="#e6f2fd" width="314" valign="top" align="center" >
			<table border="0" height="100%" cellspacing="0" cellpadding="0" width="300">
				<tr>
					<td width="280"></td> <td width="90"></td></tr>
					<tr>
					<td align="center" colspan="2"><h3 style="font-family:Verdana; font-weight:bold;font-size:12px;">Step 2 of 2</h3></td>
				</tr>
				<tr>
					<td rowspan="2" align="center" valign="bottom"colspan="2" width="370"><font style="font-family:Verdana; font-weight:bold;font-size:12px;">Please tell more about yourself </font>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td width="300">
						<table border="0" width="300" align="center" cellpadding="0" cellspacing="4" >
<? if($Type_Loan=="Req_Loan_Personal")
		{?>
				<form name="loan_form" method="post" action="t_y.php?r_url=Contents_Personal_Loan_Mustread.php?product=PersonalLoan" onSubmit="return submitform2(document.loan_form);">
				<!--<tr>
				    <td align="left"  class="style4" width="210" height="20" ><font class="style4">Activation Code? </font>
				   </td>
				   <td colspan="3" align="left" width="290" height="18">
				   <input size="10"  maxlength="10" name="Reference_Code1" class="style4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>
				   </td>
				</tr>-->
				<tr>
					<td align="left"  class="style4" width="210" height="20"><font class="style4">Primary Account in which bank? 					</td>
					<td  align="left" colspan="3" width="290" height="20"><input type="text"  name="Primary_Acc"  class="style4" style="float: left" >
					</td>
				</tr>	
				<tr>
					<td align="left"  class="style4" width="230" height="20"><font class="style4">Residential Status			</td>
     <td class="style4" align="left" colspan="3" width="270" height="20"><table><tr><td class="style4"><input type="radio" value="1" name="Residential_Status" class="NoBrdr" checked>Owned</td><td class="style4">
     <input type="radio" value="2" name="Residential_Status" class="NoBrdr">Rented</td></tr><tr><td colspan="2" class="style4"><input type="radio" value="3" name="Residential_Status" class="NoBrdr">Company Provided</td></tr></table></td>
   </tr>
				<tr>
					<td width="400" height="2" colspan="4">&nbsp;
					</td>
				</tr>
				<tr>
     <td align="left" class="style4" width="210" height="20" ><font class="style4">Any type of loan(s) running? </font></td>
     <td colspan="3" class="bodyarial11" width="290" ><table border="0">
	 <tr><td class="style4" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="style4"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="style4"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="cl" >Car</td><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr>
                        
		</table>
		</td>
		</tr>
				<tr>
					<td width="400" height="5" colspan="4">&nbsp;
				  </td>
				 </tr>
				 <tr>
				    <td align="left"  class="style4" width="210" height="20" ><font class="style4">How many EMI paid? </font>
				   </td>
				   <td colspan="3" align="left" width="290" height="18">
				  <select name="EMI_Paid"  style="float: left" class="style4"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option> </select>
				   </td>
				</tr>
				<tr>
					<td height="2" colspan="4">&nbsp;
					</td>
				</tr>
				<tr>
					 <td align="left"  class="style4" width="210" height="20" ><font class="style4">I have an active credit card from ? </font></td>
					 <td colspan="3" class="bodyarial11" width="290"><table border="0">
				 <tr>
						<td class="style4" width="60%"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
						<td class="style4" width="60%"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="style4"><input type="checkbox"  name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="style4"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="style4"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="style4"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="style4" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td><td class="style4"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</table>
				  </td>
					</tr>
								
					</table>
					</td>
			  </tr>
			
					<tr><td width="400" colspan="3" height="2">&nbsp;</td></tr>		
					 <tr><td>&nbsp;</td></tr>
				
					<tr>
						<td colspan="2" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>

					
				
<? }
elseif($Type_Loan=="Req_Credit_Card")
	{?>
	<form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform(document.loan_form);">

					<!--<tr>
				    <td align="left"  class="style4" width="230" height="20" ><font class="style4">Activation Code? </font>
				   </td>
				   <td colspan="3" align="left" width="270" height="18">
				   <input size="10"  maxlength="10" name="Reference_Code1" class="style4"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>
				   </td>
				</tr>
				<tr>
				    <td colspan="4" align="left"  class="style4"  height="20" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
				   <font class="style4">if you havent received activation code sms</font>
				  </td>
				</tr>
				<tr><td colspan="4" id="myDiv" ></td></tr>-->
				<tr>
					
					<td align="left" rowspan="2"class="style4" width="140" height="20"><font class="style4">Do You have a Pancard ?</font></td>
					<td rowspan="2"align="left" width="50" height="20"><input type="radio"  name="Pancard"  class="NoBrdr"  value="Yes" ><font class="style4">Yes</font></td>
					<td  rowspan="2"align="left" width="50" height="18"  >
					<input size="10" type="radio" class="NoBrdr" name="Pancard" value="No" ><font class="style4">No</font></td><td >&nbsp;</td>

				</tr>	
		<tr><td>&nbsp;</td></tr>
<? if($CC_Holder==1)
		{?>
				<tr>
				 <td align="left"  class="style4" width="100" height="20" ><font class="style4">I have an active credit card from ? </font></td>
				 <td colspan="3" class="bodyarial11" width="350"><!--<table border="0">
				 <tr><td class="style4" width="60%"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="style4" width="60%"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="style4"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="style4"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="style4"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product[]" value="Standard Chartered"  id="From_Product" class="noBrdr" >Standard Chartered</td><td colspan="2" class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</table> -->
				 
				 <table border="0"> <tr><td class="style4" ><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="style4"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td><tr><td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="style4"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="style4"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td><td class="style4"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="style4" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product[]" value="Barclays" id="From_Product" class="noBrdr" >Barclays</td><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td></tr><tr><td colspan="2" class="style4"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</td></tr></table></td>
				 </tr>
		 <tr><td>&nbsp;</td></tr>
		 <tr>
		 <td align="left"  class="style4" width="210" height="20"><font class="style4">Cards held since?</td>
			<td  align="left" colspan="3" width="290" height="20"><select class="style4" size="1" name="Card_Vintage">
			<option value="0">Please select</option>
			 <option value="1">Less than 6 months</option>
			 <option value="2">6 to 9 months</option>
			 <option value="3">9 to 12 months</option>
			 <option value="4">more than 12 months</option>
			 </select>
		 </td>
	</tr>	

	<? } ?>
		<tr>
			 <td align="left"  class="style4" width="100" height="20" ><font class="style4">Have you applied with these Banks in last six months?</font></td>
			 <td colspan="3" class="bodyarial11" width="350"><!--<table border="0">
			 <tr><td class="style4" width="60%"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td><td class="style4" width="60%"><input type="checkbox" class="noBrdr" id="From_Product1" name="From_Product1[]" value="Amex">Amex</td><tr><td class="style4"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Canara Bank" >Canara Bank</td><td class="style4"><input type="checkbox" name="From_Product1[]" id="From_Product1" class="noBrdr" value="Citi Bank" >Citi Bank</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product1[]" class="noBrdr" id="From_Product1" value="Deutsche bank">Deutsche Bank</td><td class="style4"><input type="checkbox"  id="From_Product1" name="From_Product1[]" value="HDFC" class="noBrdr">HDFC</td></tr><tr><td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product1[]" id="From_Product1" >HSBC</td><td class="style4"> <input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="ICICI">ICICI</td></tr><tr><td class="style4"><input type="checkbox" name="From_Product1[]" value="Standard Chartered"  id="From_Product1" class="noBrdr" >Standard Chartered</td><td colspan="2" class="style4"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="SBi">SBI</table> -->
			 <table border="0">
	 <tr>
	 <td class="style4"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
	 <td class="style4"><input type="checkbox" class="noBrdr" id="From_Product1" name="From_Product1[]" value="Amex">Amex</td>
	 <td class="style4"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Canara Bank" >Canara Bank</td>
	 </tr>
	 <tr>
	 <td class="style4"><input type="checkbox" name="From_Product1[]" id="From_Product1" class="noBrdr" value="Citi Bank" >Citi Bank</td>
	 <td class="style4"><input type="checkbox" name="From_Product1[]" class="noBrdr" id="From_Product1" value="Deutsche bank">Deutsche Bank</td>
	 <td class="style4"><input type="checkbox"  id="From_Product1" name="From_Product1[]" value="HDFC" class="noBrdr">HDFC</td>
	 </tr>
	 <tr>
	 <td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product1[]" id="From_Product1" >HSBC</td>
	 <td class="style4"> <input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="ICICI">ICICI</td>
	 <td class="style4"><input type="checkbox" name="From_Product1[]" value="Standard Chartered"  id="From_Product1" class="noBrdr" >Standard Chartered</td>
	 </tr>
	 <tr>
	 <td class="style4"><input type="checkbox" id="From_Product1" name="From_Product[]" class="noBrdr" value="SBi">SBI</td>
	 <td class="style4"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Others">Others</td>
	<td class="style4"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Barclays">Barclays</td></tr>
		 <tr>
		<td class="style4" colspan="3"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="0">No</td></tr></table>
			 </td>
		    </tr>
			                    
		  </table>
	  </td>
	  </tr>
				
			
				<tr><td width="400" colspan="2">&nbsp;</td></tr>		
				 <tr><td colspan="2">&nbsp;</td></tr>
			
				<tr>
					<td colspan="2" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>

				</tr>
	<?}
elseif($Type_Loan=="Req_Loan_Home")
		{?>
				<form name="loan_form" method="post" action="t_y.php?r_url=Contents_Home_Loan_Mustread.php?product=HomeLoan" onSubmit="return submitform3(document.loan_form);">
			<!--	<tr>
				    <td align="left"  class="style4" width="210" height="20" ><font class="style4">Activation Code? </font>
				   </td>
				   <td colspan="3" align="left" width="290" height="18">
				   <input size="10"  maxlength="10" name="Reference_Code1" class="style4" style="float: left" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana; " ></div>
				   </td>
				</tr>-->
				<tr>
					<td align="left" rowspan="2"class="style4" width="140" height="20"><font class="style4">Property Identified</font></td>
					<td rowspan="2"align="left" width="50" height="20"><input type="radio"  name="Property_Identified"  class="NoBrdr"  value="1" ><font class="style4">Yes</font></td>
					<td  rowspan="2"align="left" width="50" height="18"  >
					<input size="10" type="radio" class="NoBrdr" name="Property_Identified" value="0" ><font class="style4">No</font></td><td >&nbsp;</td>

				</tr>
		<tr><td >&nbsp;</td></tr>


				<tr>
					<td align="left"  class="style4" width="250" height="20"><font class="style4">Property Location 	</td>
					<td  align="left" colspan="3" width="250" height="20"><input type="text"  name="Property_Loc"  class="style4" style="float: left" >
					</td>
				</tr>	
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td align="left"  class="style4" width="210" height="20" valign="bottom"><font class="style4">Estimated market value of the property?</td>
					<td  align="left" colspan="3" width="290" height="20"><select name="Budget"  class="style4" >
					<option value="-1" selected>Please Select</option>
					<option value="Upto 7 Lakhs">Upto 7 Lakhs </option>
					<option value="7-15 Lakhs">7-15 Lakhs </option>
					<option value="15-20 Lakhs">15-20 Lakhs </option>
					<option value="20-25 Lakhs">20-25 Lakhs </option>
					<option value="Above 25 Lakhs">Above 25 Lakhs</option></SELECT>
				  </td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				
				<tr>
					<td align="left"  class="style4" width="210" height="20"><font class="style4">When you are planning to take loan?</td>
					<td  align="left" colspan="3" width="290" height="20"><select name="Loan_Time"  class="style4" >
            <OPTION value="-1" selected>Please select</OPTION>
			<OPTION value="15 days">15 days</OPTION>
			<OPTION value="1 month">1 months</OPTION>
			<OPTION value="2 months">2 months</OPTION>
			<OPTION value="3 months">3 months</OPTION>
			<OPTION value="3 months above">more than 3 months</OPTION></SELECT>
					</td>
				</tr>	

</table>
				</td>
				</tr>
				
		
				<tr><td width="400" colspan="2">&nbsp;</td></tr>		
				 <tr><td colspan="2">&nbsp;</td></tr>
			
				<tr>
					<td colspan="2" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>

				</tr>
				<?}?>
				 <tr><td colspan="2">&nbsp;</td></tr>
			 <tr><td colspan="2">&nbsp;</td></tr>
			 <tr><td colspan="2">&nbsp;</td></tr>
					</table></td>
				
			</td>
			<td width="62">&nbsp;</td>
		</tr>
		<tr bgcolor="DAEAF9"><td bgcolor="DAEAF9" colspan="5" width="847">&nbsp;</td></tr>

		</table>
	<!--/div!-->
	</form>
<? }?>

<!-- Google Code for lead Conversion Page -->
<script language="JavaScript" type="text/javascript">

<!--
var google_conversion_id = 1056387586;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "FFFFFF";
if (1) {
  var google_conversion_value = 1;
}

var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1056387586/imp.gif?value=1&label=lead&script=0">
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

