<?php
//This file is not required
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';


$RequestID = $_REQUEST['RequestID'];//
$Residential_Status = $_REQUEST['Residential_Status'];//
$Pincode = $_REQUEST['Pincode'];//
$Primary_Acc = $_REQUEST['Primary_Acc'];//
$Company_Type = $_REQUEST['Company_Type'];//
$Years_In_Company = $_REQUEST['Years_In_Company'];//
$Total_Experience = $_REQUEST['Total_Experience'];//
$Salary_Drawn = $_REQUEST['Salary_Drawn'];
$EMI_Paid = $_REQUEST['EMI_Paid'];
$DOB = $_REQUEST['EMI_Paid'];
$LoanAny = $LoanAny;
$CC_Holder = $_REQUEST['CC_Holder'];
$Card_Vintage = $_REQUEST['Card_Vintage'];
$Residential_Status = $_REQUEST['Residential_Status'];//
$Pincode = $_REQUEST['Pincode'];//
$Company_Name = $_REQUEST['Company_Name'];//
$Years_In_Company = $_REQUEST['Years_In_Company'];//
$Total_Experience = $_REQUEST['Total_Experience'];//
$Salary_Drawn = $_REQUEST['Salary_Drawn'];
$EMI_Paid = $_REQUEST['EMI_Paid'];
$DOB = $_REQUEST['DOB'];
$LoanAny = $LoanAny;
$CC_Holder = $_REQUEST['CC_Holder'];
$Card_Vintage = $_REQUEST['Card_Vintage'];

$Loan_Amount = $_REQUEST['Loan_Amount'];//

$Employment_Status = $_REQUEST['Employment_Status'];//

$Net_Salary = $_REQUEST['Net_Salary'];//

$Name = $_REQUEST['Name'];//

$City = $_REQUEST['City'];//

$Phone = $_REQUEST['Phone'];//

$Email = $_REQUEST['Email'];//

$accept = $_REQUEST['accept'];
$panel = $_REQUEST['panel'];
$IP = $_SERVER['REMOTE_ADDR'];

$source = $_REQUEST['Source'];

$Annual_Turnover = $_REQUEST['Annual_Turnover'];


if(strlen($City)>2 && strlen($Phone)>9)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Personal  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9810395952')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			//echo $getdetails."<br>";
			//exit();
			$checkavailability = ExecQuery($getdetails);
			$alreadyExist = mysql_num_rows($checkavailability);
			$myrow = mysql_fetch_array($checkavailability);
		
			if($alreadyExist>0)
			{
				$ProductValue = mysql_result($checkavailability,0,'RequestID');
				$Duplicate = "Duplicate";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Dated, Pincode,  source, CC_Bank, Card_Vintage,Referrer,Creative,Section, Updated_Date, IP_Address,Accidental_Insurance,Reference_Code, Direct_Allocation, IsProcessed , Edelweiss_Compaign,Cpp_Compaign , Annual_Turnover,Privacy,EMI_Paid,PL_Bank,PL_Tenure, Years_In_Company,Total_Experience, Residential_Status, Primary_Acc)
				VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', Now(), '$Pincode','$source','$From_Pro','$Card_Vintage','$REFERER_URL','$Creative','$Section', Now(),'$IP','$Accidental_Insurance','".$Reference_Code."', '".$Direct_Allocation."','".$IsProcessed."', '".$edelweiss."','".$cpp_card_protect."','".$Annual_Turnover."', '".$accept."','".$EMI_Paid."','".$PL_Bank."','".$PL_Tenure."','".$Years_In_Company."','".$Total_Experience."', '".$Residential_Status."', '".$Primary_Acc."')";
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID1 = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Dated, Pincode, source, CC_Bank, Card_Vintage,Referrer,Creative,Section, Updated_Date, IP_Address,Accidental_Insurance, Reference_Code,Direct_Allocation, IsProcessed, Edelweiss_Compaign,Cpp_Compaign, Annual_Turnover,Privacy,EMI_Paid,PL_Bank,PL_Tenure,Years_In_Company,Total_Experience,Residential_Status, Primary_Acc )
VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', Now(), '$Pincode', '$source','$From_Pro','$Card_Vintage','$REFERER_URL','$Creative','$Section', Now(),'$IP','$Accidental_Insurance','".$Reference_Code."','".$Direct_Allocation."','".$IsProcessed."','".$edelweiss."','".$cpp_card_protect."','".$Annual_Turnover."', '".$accept."','".$EMI_Paid."','".$PL_Bank."','".$PL_Tenure."','".$Years_In_Company."','".$Total_Experience."','".$Residential_Status."', '".$Primary_Acc."')";
				//echo "<br>else".$InsertProductSql;
				}
			//echo "hello>".$InsertProductSql."<br>";
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();
			$Duplicate = "";
		}
		}//$crap Check
	echo $ProductValue;
	echo ",".$RequestID;
	echo ",".$Duplicate;
	
		//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			//exit();
		

 ?>