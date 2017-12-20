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

	$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}
	

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		
		$Name = FixString($Name);
		

		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Pancard=FixString($Pancard);
		$DOB=$Year."-".$Month."-".$Day;
		$last_id = FixString($last_id);
		$Phone = FixString($Phone);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Std_Code = FixString($Std_Code);
		$Std_Code_O = FixString($Std_Code_O);
		$Landline_O = FixString($Landline_O);
		$Phone1 = FixString($Phone1);
		
		$Email = FixString($Email);
if($Email=="Email Id"){
	$Email = "";}
	else
		{
		$Email = FixString($Email);
		}

		$Item_ID = FixString($Item_ID);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$Type_Loan = FixString($Type_Loan);

if($Type_Loan=="Req_Credit_Card")
		{
			$Reference_Code = generateNumber(4);
		}

		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$City_Other = FixString($City_Other);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Activate = FixString($Activate);
		$Employment_Status = FixString($Employment_Status);
		/*if($Type_Loan=="Req_Loan_Personal")
		{
		if($Employment_Status==1)
		{
			$Net_Salary = $_REQUEST["IncomeAmount"]*12;
		}
		else
		{
		$Net_Salary = FixString($IncomeAmount);
		//}
		}
		else
		{*/
		$Net_Salary = FixString($IncomeAmount);
		//}
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

if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
	

/*function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ExecQuery("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		$RowGetDate = mysql_fetch_array($GetDateSql);
		
		$TDated = $RowGetDate['Dated'];
		$TCity = $RowGetDate['City'];
		$Mobile = $RowGetDate['Mobile_Number'];
		$Product_Name = getProductCode($ProductName);
		
		$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		$query = mysql_query($Sql);
		//echo $Sql;
		//exit();

	}*/

		$crap = " ".$Name." ".$Email." ".$Company_Name." ".$City_Other." ".$Descr." ".$Residence_Address;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
	if($last_id >0)
	{
		$sql ="Delete from Req_Apply_Here Where ApplyID = ".$last_id;
	 	ExecQuery($sql);
	}

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
			
if($Type_Loan=="Req_Credit_Card")
			{

		$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Card_Vintage,Reference_Code, Updated_Date,Pancard, Accidental_Insurance) VALUES ( '$UserID', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '1', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative' , '$Section', '$IP', '$DOB', '$CC_Holder','$Card_Vintage', '$Reference_Code',  Now(),'$Pancard','$Accidental_Insurance' )"; 
			}
			else
			{
		$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address, Updated_Date, Accidental_Insurance) VALUES ( '$UserID', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative' , '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address', Now(),'$Accidental_Insurance' )"; 
			}
			
		}
		
		else
			{
			if($Type_Loan=="Req_Credit_Card")
			{

		$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Card_Vintage,Reference_Code, Updated_Date,Pancard,Email,Accidental_Insurance) VALUES ( '', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '1', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative' , '$Section', '$IP', '$DOB', '$CC_Holder','$Card_Vintage', '$Reference_Code',  Now(),'$Pancard','$Email','$Accidental_Insurance' )"; 
			}
			else
			{
		
			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB,  CC_Holder,  Reference_Code, Residence_Address, Updated_Date, Accidental_Insurance)
			VALUES ( '', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O', '$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address', Now(),'$Accidental_Insurance' )"; 

			}
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
				//getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			/*if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($Name, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}*/
			if(($Type_Loan=="Req_Credit_Card"))
		{
			$SMSMessage ="Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of card app form to get banks contacts & quotes. And help us serve you better.";
			//if(strlen(trim($Phone)) > 0)
			//SendSMS($SMSMessage, $Phone);
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
if($Type_Loan=="Req_Credit_Card")
			{

		$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Card_Vintage,Reference_Code, Updated_Date,Pancard,Email, Accidental_Insurance) VALUES ( '$UserID1', '$Name', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '1', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative' , '$Section', '$IP', '$DOB', '$CC_Holder','$Card_Vintage', '$Reference_Code',  Now(),'$Pancard','$Email','$Accidental_Insurance' )"; 
			}
			else
			{

			$sql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Std_Code_O, Landline_O, Net_Salary, Loan_Amount, Marital_Status, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, source, Pincode, Contact_Time, Referrer, Creative, Section, IP_Address, DOB, CC_Holder, Reference_Code, Residence_Address,  Updated_Date, Accidental_Insurance)
			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code', '$Phone1', '$Std_Code_O', '$Landline_O','$Net_Salary', '$Loan_Amount', '$Marital_Status', 0, 0, 0, 0, '$IsPublic', Now(), '$source', '$Pincode', '$Contact_Time', '$Referrer', '$Creative', '$Section', '$IP', '$DOB', '$CC_Holder', '$Reference_Code', '$Residence_Address', Now(),'$Accidental_Insurance')"; 
			}
		
			$result = ExecQuery($sql);
			$Lid = mysql_insert_id();
			if($Accidental_Insurance==1)
			{
				$RequestID = $Lid;
				$ProductName = $Type_Loan;
				InsertTataAig($RequestID, $ProductName);
			}
			$_SESSION['Temp_LID'] = $Lid;
			//getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			/*if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($Name, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);
			}*/
			if(($Type_Loan=="Req_Credit_Card"))
			{
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of card app form to get banks contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
			SendSMS($SMSMessage, $Phone);

			}
			if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home"))
			echo "<script language=javascript>location.href='thank_individual.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
			
			/*echo "<script language=javascript>location.href='thanku.php'</script>";*/
		}
		
		else
			{
			$result = ExecQuery($sql);
			
			$Lid = mysql_insert_id();
			if($Accidental_Insurance==1)
			{
				$RequestID = $Lid;
				$ProductName = $Type_Loan;
				InsertTataAig($RequestID, $ProductName);
			}
			$_SESSION['Temp_LID'] = $Lid;
			//getEligibleBidders(getReqValue($Type_Loan),"$City","$Phone");
			/*if($Type_Loan=="Req_Loan_Personal")
			{
				SendPLLeadToICICI($Name, $LName, $Day, $Month, $Year, $Phone, $Phone1, $Email, $City, $City_Other, $Employment_Status, $Net_Salary, $Company_Name);

			}*/
			
		//	$rows = mysql_num_rows($result);
			$_SESSION['Temp_Flag'] = "0";
			$strDir = dir_name();
				if($Email!="")
				{
					//header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."User_Register_New.php");
					if(($Type_Loan!="Req_Credit_Card") && ($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Loan_Home")){
						echo "<script language=javascript>location.href='thank_individual.php?r_url=".getTransferURL($Type_Loan)."'"."</script>";
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
			
		/*if(($Type_Loan=="Req_Loan_Personal") || ($Type_Loan=="Req_Loan_Home"))
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
			}*/
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
<?// $Type_Loan ="Req_Credit_Card"; $CC_Holder=1;$Pancard="Yes";?>
<? if(($Type_Loan!="Req_Loan_Personal") && ($Type_Loan!="Req_Credit_Card")&& ($Type_Loan!="Req_Loan_Home")) { 

	if($_SESSION['Temp_loan_type'] == "Req_Loan_Against_Property")
		$file_name = "closedby_lap.php";
	else if($_SESSION['Temp_loan_type'] == "Req_Loan_Car")
		$file_name = "closedby_cl.php";

?>

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="dvMainbanner">
   <?php include '~Upper.php';?>

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
 
 <p><b><font color="#3366CC">Thank you Your Request has been added Successfully.........</font></b></p>

     &nbsp;</td>
     </tr>
	 
            </table>
			</div>
	  <?php include '~Right1.php';?>
	<!--  <img src="images/120_90.gif"><BR><BR>
	  	  <img src="images/120_240.gif">
	  -->
	  </div>
    <?php include '~Bottom.php';?>
	<? }
	 
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
	function valvalidate() {
		var cnt = -1;
		var i;
		for(i=0; i<document.loan_form.validate.length; i++) 
		{
			if(document.loan_form.validate[i].checked)
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
		var btnvalidate;
		var cnt=-1;
		var i;
		var btn;
	//	btn=valButton(Form.Property_Identified);
	//	btnvalidate=valvalidate();
	
		/*if(Form.Reference_Code1.value=="")
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
		
		if(Form.Company_Name.value=="")
		{
			alert("Please fill your Company Name.");
			Form.Company_Name.focus();
			return false;
		}
		
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
			return false;}
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
	function valButton3() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.Loan_Any.length; i++) 
	{
        if(document.loan_form.Loan_Any[i].checked)
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
	function submitform(Form)
	{
		var btn2;
		var btn3;
		var myOption;
		var i;
		var btn;
		var btn5;
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
	
	<?if($CC_Holder==1) {?>
		btn2=valButton2();
					if(!btn2)
					{
						alert('you holding credit card from which bank.');
						return false;
					}
				
		
		if (Form.Credit_Limit.selectedIndex==0)
		{
			alert("Please Select Credit Limit");
			Form.Credit_Limit.focus();
			return false;
		}
		<?}
		if($Pancard=="Yes")
		{
			?>
if (Form.Pancard_no.value=='')
		{
			alert("Please enter Pan number.");
			Form.Pancard_no.focus();
			return false;
		}
				<? } ?>
		/*		btn5=valButton5();
	if(!btn5)
		{
			alert('Please select have you applied with any of these banks in last 6 months or not');
				return false;
		}*/
		

		return true;
	}

	function submitform2(Form)
	{

	var btn2;
	var btn3;
	var myOption;
	var i;
	//btn2=valButton2();
		/*if(Form.Reference_Code1.value=="")
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
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
	
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;

	}	
		if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn3=valButton3();
					if(!btn3)
					{
						alert('Do you have any other loan.');
						return false;
					}
	
				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
			return false;
		}
		
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
function addElement()
{
		var ni = document.getElementById('myDiv');
			var newdiv = document.createElement('div');
		if(ni.innerHTML=="")
		{
		
			//if(document.loan_form.validate.value="on")
			//{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr><td align="left" class="style4" width="210" height="20"><font class="style4">Reconfirm Mobile No.</font></td>	<td colspan="3" align="left" width="196" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" class="style4" name="RePhone" id="RePhone"></td></tr></table>';

				ni.appendChild(newdiv);
			//}
			
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
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
				ni.innerHTML = '<table border="0" width="100%"><tr><td align="left"  width="200" class="style4"  height="20"><font class="style4">Property Location</font> 	</td><td  width="196" align="center"  height="20"><select size="1" align="center"   name="Property_Loc" class="style4">	  <?=getCityList1($City)?>	 </select>			</td>			</tr>	</table>';
			}
			
		}
			
		return true;
	}
function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr> <td align="left" class="style4" width="250" height="20" ><font class="style4">Any type of loan(s) running? </font></td> <td colspan="3" class="bodyarial11" width="250" ><table border="0">	 <tr><td class="style4" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="style4"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="style4"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  class="style4" width="250" height="20" ><font class="style4">How many EMI paid? </font>  </td>   <td colspan="3" align="left" width="250" height="18"><select name="EMI_Paid"  style="float: left" class="style4"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option> </select>  </td>	</tr></table>';
			}
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
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
				ni1.innerHTML = '<table border="0"><tr><td align="left"  class="style4"  height="20">&nbsp;<input type="checkbox" name="update" class="noBrdr" ></td><td  align="left"  height="20"><font class="style4">Can we tell you about some properties	</font></td></tr>	</table>';
			}
		}
		
		return true;

	}
	
	
function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
	</script>
<?php
	
	if($_REQUEST['closeref'] == "PL")
		$file_name = "closedby_pl.php";
	else if($_REQUEST['closeref'] == "HL")
		$file_name = "closedby_hl.php";
	else if($_REQUEST['closeref'] == "CC")
		$file_name = "closedby_cc.php";
	
	if( $_REQUEST['closeref']=="PL" || $_REQUEST['closeref']=="CL" || $_REQUEST['closeref']=="HL" )
	{ 
	?>	
		<body onbeforeunload="HandleOnClose('<?php echo $file_name; ?>')">
		
<?php
 } ?>
	<!--div align="center"!-->
	<table width="850" style="border: 1px solid #68718A;">
	<tr>
	<td colspan="5" align="center" width="847">
	<? if($Type_Loan=="Req_Credit_Card")
		{ ?>
				<img src="images/logo_cc.gif">
		<?	}
		else{ ?>
		<img src="images/logopersonal1.gif"><?}?>
		</td>

	</tr>
	<tr>
		<td width="4">&nbsp;</td>
		<td width="470" valign="top" align="right" >
			<table border="0" width="460">
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
<?if($Type_Loan=="Req_Loan_Home")
		{?>
					<td align="left" height="58" width="431" ><font class="style1"> Post your Home loan requirement<br />
					Get &amp; compare offers from all Banks.<br />
					Go with the lowest bank.</font> </td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:33px;" width="431"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">The one-stop shop for best on all loan requirements</font></td>
				</tr>
					<tr>
						<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">Now get offers from</font> <font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" >ICICI, HDFC, UTI, Citibank, Kotak, LIC and IDBI </font><font class="style1">and choose the best deal!</font></td>
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
					<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p>Blore Housing Loan <br>

 I am glad that i could get 3 quotes on my loan requirement within just 48 hrs that too w/o stepping out of home. I can now close out my property also. Only thing is that I came across your site accidentally- you should promote ur value-adding services better.. 
  </font><br>
			
				<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >-  By Jeffrey  &nbsp; </font>
					</td>
						</tr>
						
					<tr>

					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Helpful tips to look/compare/apply for loans to get the best deal.</font></td>
						</tr>
	</table></td>
					
			<tr>
					<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
					<td valign="top" width="431" ><font class="style3">Home loans are provided based on the market value, mainly estimation given by banks or the registration value of the property. 
Home loan is not a one-time decision; do review the market periodically before availing them. 
Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Home loan are 
 
<ol><li>Eligibility </li>
<li>Interest rates best suited .</li>
<li>Fixed interest loans or Floating.</li> 
<li>Other costs. </li>
<li>Document required.</li> 
<li>Penalties.</li> 
</ol><a href="http://www.deal4loans.com/Contents_Home_Loan_Mustread.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a>
 
 

</font></td>
				</tr>
				
			
		  
	<!--<tr><td width="28" >&nbsp;</td>
	<td valign="top" width="431" >&nbsp;</td>
	<tr><td colspan="2" width="463" ><a href="loans.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a></td></tr>-->
		</table></td>
		
				<? }
				elseif($Type_Loan=="Req_Loan_Personal"){ ?>
				<td align="left" height="58" width="431" ><font class="style1"> Post your personal loan requirement.<br />
					Get &amp; compare offers from all Banks.<br />
					Go with the lowest bidder.</font> </td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:33px;" width="431"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">The one-stop shop for best on all loan requirements</font></td>
				</tr>
				<tr>
						<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">Now get offers from</font> <font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" >ICICI, ABN AMRO, Deutsche, Citibank, Centurian, HSBC, HDFC & Standard chartered </font><font class="style1">and choose the best deal!</font></td>
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
				<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p>I think that the launch of a service like <a href="http://www.deal4loans.com/">www.deal4loans.com</a> will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.</font><br>
		
			<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >- Divya&nbsp; </font>
				</td>
					</tr>		
					
	<tr>

					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Helpful tips to look/compare/apply for loans to get the best deal.</font></td>
						</tr>
	</table></td>
					
			<tr>
					<td height="17" width="28" valign="top"><img src="images/arrow2.gif"></td>
					<td valign="top" width="431" ><font class="style3">Your eligibility & rates for Personal loans are provided on the basis of income,  track record with any bank, credit card usage/payments and many more.<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" > To get the critical information for personal loan, Apply Now!</font><br>
As it is an unsecured loan so banks try gauging your intention to pay loan. Customers tend to make mistakes while entering into deals, which is not beneficial to them, so its better to compare all the variables given by different banks before signing a loan agreement. 
The parameters on the basis of which you can compre a Personal Loan are:
<ol>

<li> Eligibility.</li> 

<li> Interest rates best suited. </li>

<li> Processing Fees. </li>

<li> Pre-payment/Foreclosure charges.</li> 

<li> Document required. </li>

<li> Turn Around Time.</li>
</ol>
</td></tr>
<tr><td colspan="2">
					<a href="http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a></td></tr></font>
				</td>
				</tr>
				
			
		  
	<!--<tr><td width="28" >&nbsp;</td>
	<td valign="top" width="431" >&nbsp;</td>
	<tr><td colspan="2" width="463" ><a href="loans.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a></td></tr>-->
		</table></td>
				<?}
	else{?>	
	<td align="left" height="58" width="431" ><font class="style1"> Post your Credit card requirement.<br />
					Get &amp; compare offers from all Banks.<br />
					Go with the lowest bank.</font> </td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:33px;" width="431"><font style="color:blue;font-family:Verdana ;font-size:13px;font-weight:bolder;">www.deal4loans.com</font></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">The one-stop shop for best on all loan requirements</font></td>
				</tr>
				<tr>
						<td colspan="2" style="padding-left:25px;" width="439"><font class="style1">Now get offers from</font> <font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px;" >ICICI, ABN AMRO, Deutsche, Citibank, Reliance & SBI </font><font class="style1">and choose the best card!</font></td>
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
					<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p>Great!  <br>
					
 Good way of helping people like me to decide on what banks to choose.Got my Credit card in 15 days.Awesome!!!!! 

  </font><br>
			
				<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >-  Ratan  &nbsp; </font>
					</td>
						</tr>
						<tr>
						<td width="10">&nbsp;</td>
					<td colspan="2" style="padding-left:15px;padding-right:15px; " bgcolor="DAEAF9"><font class="style1"><p> Plastic money<br>The security tips and the regular updates about credit card offers, has helped me drive more mileage out of the plastics in my wallet.   </font><br>
			
				<font  style="font-weight:bold;color:black;font-family:Verdana; font-size:12px; float:right;" >-  Swati &nbsp; </font>
					</td>
						<!--</tr>	
						<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Introducing Live chat- Get online quotes for your loan requirement </font></td>
						</tr>
						<tr>
						<td width="10">&nbsp;</td>
					<td colspan="2" style="padding-left:15px;padding-right:15px; " align="center" bgcolor="DAEAF9">
			<img src="images/banner.gif" onclick="javascript:window.open('http://www.deal4loans.com/Contents_chat.php');" style="cursor:pointer;"></a>

			</td>
			</tr>	-->	
						
				<tr>
					<td width="10">&nbsp;</td>
					<td bgcolor="0A71D9"><font class="style2">
					Helpful tips for using a credit card.</font></td>
						</tr>
	</table></td>
					
			<tr>
					
					<td colspan="2" valign="top" width="431" ><font class="style3"><ol><li> Sign your card as soon as you receive it.</li>
<li> You will also receive the PIN number after a few days. Keep your PIN/account number safe.
<li> Every time you use your card, be aware when your card is being swiped by the cashier so as to ensure no misuse of your card takes place.</li>
<li> When making payment with your card, make sure you check if it is your credit card that the cashier has returned.</li> 
<li> Do not forget to verify your purchases with your billing statements.</li>
<li> After using your card at an ATM, do not throw your receipt behind.</li>

</ol><a href="http://www.deal4loans.com/Contents_Credit_Card_Mustread.php" style="border: 0px;" target="_blank" ><img src="images/khnowmore.gif" ></a>
 
 

</font></td>
				</tr>
				
			
		</table>
	</td><?}?>
		<td bgcolor="DAEAF9" width="314" valign="top" align="center" >
			<table border="0" height="100%" cellspacing="0" cellpadding="0" width="300">
				<tr>
					<td width="280"></td> <td width="90"></td></tr>
					<tr>
					<td align="center" colspan="2"><font style="font-family:Verdana;"><h5>Step 2 of 2</h5></font></td>
				</tr>
				<tr>
					<td rowspan="2" align="center" valign="bottom"colspan="2" width="370"><font style="font-family:Verdana; font-weight:bold;font-size:12px">Please tell more about yourself </font>
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
		{ ?>
				<form name="loan_form" method="post" action="t_y1.php" onSubmit="return submitform2(document.loan_form);">
				<!--<tr>
				    <td align="left"  class="style4" width="230" height="20" ><font class="style4">Activation Code? </font>
				   </td>
				   <td colspan="3" align="left" width="270" height="18">
				   <input size="10"  maxlength="10" name="Reference_Code1" id="Reference_Code1" class="style4" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>
				   </td>
				</tr>
				<tr>
				    <td colspan="4" align="left"  class="style4"  height="20" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
				   <font class="style4">if you havent received activation code sms</font>
				  </td>
				</tr>
				<tr><td colspan="4" id="myDiv" ></td></tr>-->
				<tr>
					<td align="left"  class="style4" width="230" height="20"><font class="style4">Primary Account in which bank?</font> 					</td>
					<td  align="left" colspan="3" width="270" height="20"><input type="text" size="18"  name="Primary_Acc"  class="style4" style="float: left" >
					</td>
				</tr>	
				<tr>
					<td align="left"  class="style4" width="230" height="20"><font class="style4">Residential Status</font>			</td>
     <td class="style4" align="left" colspan="3" width="270" height="20"><table><tr><td class="style4"><input type="radio" value="1" name="Residential_Status" class="NoBrdr" checked>Owned</td><td class="style4">
     <input type="radio" value="2" name="Residential_Status" class="NoBrdr">Rented</td></tr><tr><td colspan="2" class="style4"><input type="radio" value="3" name="Residential_Status" class="NoBrdr">Company Provided</td></tr></table></td>
   </tr>
			
				 <tr>
					<td align="left" class="style4" width="230" height="20"><font class="style4">No. of years in this Company</font></td>
					 <td align="left" colspan="3" width="270" height="20">
					<input type="text" name="Years_In_Company" class="style4" size="18" maxlength="15" ></td>
				</tr>
				<tr>
					<td align="left" class="style4" width="230" height="20"><font class="style4">Total Experience(Years)/
					 Total Years in Business</font></td>
					 <td align="left" colspan="3" width="270" height="20"><input size="18" class="style4" name="Total_Experience" onFocus="this.select();" style="float: left">
					</td>
			   </tr>
			   <? if (isset($Card_Vintage)>0)
			{?>
					<tr>
					<td align="left" class="style4" width="230" height="20"><font class="style4">Credit Card Limit?</font></td>
					 <td align="left" colspan="3" width="270" height="20"><input size="18" class="style4" name="Card_Limit" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="this.select();" style="float: left">
					</td>
			   </tr>

						 <? }
						 ?>
				
						<tr>
					<td align="left" class="style4" width="280" height="20"><font class="style4">Any Loan running?</font></td>
					<td align="left" width="50" height="20"><input type="radio"  value="1"  name="LoanAny" class="NoBrdr" onClick="addElementLoan();"><font class="style4">Yes</font></td>
					<td align="left" width="50" height="18"  >
					<input size="10" type="radio" name="LoanAny" class="NoBrdr" onClick="removeElementLoan();" value="0" ><font class="style4">No</font></td><td >&nbsp;</td>
				</tr>
				<tr><td colspan="4" id="myDivLoan"></td></tr>
				<!--<tr>	
			<td colspan="4"><input type="checkbox" class="style4" name="Accidental_Insurance" value="1" > <font class="style4"><a href="tata-aig-personal-accident-cover.php" target="_blank">Get free personal accident insurance from TATA AIG</a></font></td></tr>-->
			
	
								</table>
					</td>
					</tr>
					<tr>
			<td colspan="2" align="center" width="4"></td><td colspan="2"><input type="hidden" name="Card_Vintage" value="<? echo $Card_Vintage ?>"></td>

			</tr>
					
					<tr><td width="400" colspan="3" height="2">&nbsp;</td></tr>		
					 <tr><td>&nbsp;</td></tr>
				
					<tr>
						<td colspan="2" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>

					
				
<? }
elseif($Type_Loan=="Req_Credit_Card")
	{ ?>
	<form name="loan_form" method="post" action="t_y1.php" onSubmit="return submitform(document.loan_form);">
<tr><td colspan="4">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="blueborder" id="frm">
<tr>
				    <td align="left" class="style4" width="280" height="20" ><font class="style4">&nbsp;Activation Code? </font>
				   </td>
				   <td colspan="3" align="left" width="210" height="18">
				   <input size="20"  maxlength="10" name="Reference_Code1" id="Reference_Code1" class="style4" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana; " ></div>
				   </td>
				</tr>
				<tr>
				    <td colspan="4" align="left"  class="style4" width="210" height="20" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
				   <font class="style4">if you havent received activation code sms</font>
		
				   
				   </td>
				</tr>
				
				
			</tr><tr><td colspan="4" id="myDiv" ></td></tr>
  <tr><td><input type="hidden" value="<? echo $Type_Loan; ?>" name="type"></td></tr>

	
  <?if($CC_Holder==1) { ?>
			<tr>
			<td class="style4" >I have an active credit card from ? </td>
			<td  class="style4" >
			<table border="0" width="100%">
			<tr>
				<td class="style4" ><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
				<td class="style4"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">Amex</td>
			<tr>
				<td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >Canara Bank</td><td class="style4"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >Citi Bank</td>
			</tr>
			<tr>
				<td class="style4"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">Deutsche Bank</td><td class="style4"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">HDFC</td>
			</tr>
			<tr>
				<td class="style4"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >HSBC</td>
				<td class="style4"> <input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">ICICI</td>
			</tr>
			<tr>
				<td class="style4" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >Standard Chartered</td>
			</tr>
			<tr>
			<td class="style4"><input type="checkbox" name="From_Product[]" value="Barclays" id="From_Product" class="noBrdr" >Barclays</td><td class="style4"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">SBI</td></tr>
			<tr><td colspan="2" class="style4"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >Others</td>
			</tr>
			</table></td></tr>
			<tr>
				<td class="style4">Credit Card Limit?</td>
				<td  align="left"  colspan="3" width="240" height="25" class="style4"><select size="1"  name="Credit_Limit">
				<option value="0">Please select</option>
				<option value="1">25000 to 50000</option>
				<option value="2">50001 to 75000</option>
				<option value="3">75001 to 1 lakh </option>
				<option value="4">1 lakh & above</option>
				</select> </td>
			</tr>


  <? } ?>
   
	
		<tr>
				<td class="style4">Residence No.</td>
				<td class="style4" align="left"><input type="text"  name="Std_Code" id="Std_Code" size="2" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="std" onBlur="onBlurDefault(this,'std');">
				<input size="11" type="text"  name="Landline" id="Landline" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>

			</tr>
	<tr>
      <td class="style4">Residence Address</td>
      <td width="60%" class="style4"><textarea name="Residence_Address" id="Residence_Address" cols="20" rows="2"></textarea></td></tr>
	  <tr>
      <td class="style4">Pincode</td>
      <td width="60%" class="style4"><input type="text" name="Pincode" id="Pincode" maxlength="6"></td>
	  </tr>
    
<tr>
				<td class="style4">Office No.</td>
				<td  class="style4" align="left"><input type="text"  name="Std_Code_O" id="Std_Code_O" size="2" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="std" onBlur="onBlurDefault(this,'std');">
				
				<input size="11" type="text" name="Landline_O" id="Landline_O" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>

			</tr>
    <tr>
      <td class="style4">Office Address</td>
      <td width="60%" class="style4"><textarea name="Office_Address" id="Office_Address" cols="20" rows="2"></textarea></td>
    </tr>
	 <?if($Pancard=="Yes")
	{?>
	 <tr>
      <td class="style4">Pan Number</td>
      <td width="60%" class="style4"><input type="text" name="Pancard_no" id="Pancard_no" maxlength="10"></td>
	  </tr>
	  <? }?>
			
				</table>
				</td>
				</tr>
				
				<tr><td width="400" colspan="2">&nbsp;</td></tr>		
				 <tr><td colspan="2">&nbsp;</td></tr>
			
				<tr>
					<td colspan="2" align="center" width="276"><input  type="image" src="images/submit1.gif" style="border: 0px;"></td>

				</tr>
	<? }
elseif($Type_Loan=="Req_Loan_Home")
		{?>
				<form name="loan_form" method="post" action="t_y1.php" onSubmit="return submitform3(document.loan_form);">
				<!--<tr>
				    <td align="left" class="style4" width="280" height="20" ><font class="style4">&nbsp;Activation Code? </font>
				   </td>
				   <td colspan="3" align="left" width="210" height="18">
				   <input size="20"  maxlength="10" name="Reference_Code1" id="Reference_Code1" class="style4" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana; " ></div>
				   </td>
				</tr>
				<tr>
				    <td colspan="4" align="left"  class="style4" width="210" height="20" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >
				   <font class="style4">if you havent received activation code sms</font>
		
				   
				   </td>
				</tr>
				
				
			</tr><tr><td colspan="4" id="myDiv" ></td></tr>-->
			<tr>
					<td align="left" class="style4" width="280" height="20"><font class="style4">&nbsp;Company Name</font></td>
					<td align="left" colspan="3" width="210" height="20"><input size="20" class="style4" name="Company_Name"  onfocus="this.select();" style="float: left"></td>

				</tr>
				
			
				<tr>
					<td align="left" class="style4" width="280" height="20"><font class="style4">&nbsp;Property Identified</font></td>
					<td align="left" width="50" height="20"><input type="radio"  name="Property_Identified"  class="NoBrdr"  value="1" onClick="addIdentified();"><font class="style4">Yes</font></td>
					<td align="left" width="50" height="18"  >
					<input size="10" type="radio" class="NoBrdr" name="Property_Identified" onClick="removeIdentified();" value="0" ><font class="style4">No</font></td><td >&nbsp;</td>

				</tr>
	<tr><td colspan="4" id="myDiv1"></td></tr>
	<tr><td colspan="4" id="myDiv2"></td></tr>
	
	<tr>
					<td align="left"  class="style4" width="280" height="20" valign="bottom"><font class="style4">Estimated market value of the property?</td>
					<td  align="left" colspan="3" width="210" height="20"><select name="Budget" style="width:150"  class="style4" >
					<option value="-1" selected>Please Select</option>
					<option value="Upto 7 Lakhs">Upto 7 Lakhs </option>
					<option value="7-15 Lakhs">7-15 Lakhs </option>
					<option value="15-20 Lakhs">15-20 Lakhs </option>
					<option value="20-25 Lakhs">20-25 Lakhs </option>
					<option value="Above 25 Lakhs">Above 25 Lakhs</option></SELECT>
									</td>
				</tr>
						<tr><td></td></tr>
			<tr>
			<td align="left"  class="style4" width="280" height="20"><font class="style4">When you are planning to take loan?</td>
			<td  align="left" colspan="3" width="210" height="20"><select name="Loan_Time" style="width:150" class="style4" >
            <OPTION value="-1" selected>Please select</OPTION>
			<OPTION value="15 days">15 days</OPTION>
			<OPTION value="1 month">1 months</OPTION>
			<OPTION value="2 months">2 months</OPTION>
			<OPTION value="3 months">3 months</OPTION>
			<OPTION value="3 months above">more than 3 months</OPTION></SELECT>
					</td>
				</tr>	
	<!--<tr>	
			<td colspan="4"><input type="checkbox" class="style4" name="Accidental_Insurance" value="1" checked> <font class="style4"><a href="tata-aig-personal-accident-cover.php" target="_blank">Get free personal accident insurance from TATA AIG</a></font></td></tr>
		<tr>-->
		
		
		
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

