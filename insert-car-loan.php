<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$page_Name = "LandingPage_PL";

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
	
	function appendzero($number, $digits)
{
   $output = str_pad($number, $digits, "0", STR_PAD_LEFT);
   return $output;
} 
	

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$UserID = $_SESSION['UserID'];
		$Name = $_POST['Name'];

		$day = $_POST['day'];
		$day = appendzero($day, 2);
		$month = $_POST['month'];
		$month = appendzero($month, 2);
		$year = $_POST['year'];
		$DOB = $year."-".$month."-".$day;
		
		$Phone = $_POST['Phone'];
		$Phone1 = $_POST['Phone1'];
		$Std_Code1 = $_POST['Std_Code1'];
		$Car_Insurance = $_POST['Car_Insurance'];
		$Employment_Status = $_POST['Employment_Status'];
		$Company_Name = $_POST['Company_Name'];
		$City = $_POST['City'];
		$Type_Loan= $_POST['Type_Loan'];
		$Activate =$_POST['Activate'];
		$City_Other = $_POST['City_Other'];
		$Net_Salary = $_POST['IncomeAmount'];
		$Car_Make = $_POST['Car_Make'];
		$Pincode = $_POST['Pincode'];
		$Contact_Time = $_POST['Contact_Time'];
		$Car_Model = $_POST['Car_Model'];
		$Car_Type = $_POST['Car_Type'];
		$Loan_Tenure = $_POST['Loan_Tenure'];
		$Loan_Amount = $_POST['Loan_Amount'];
		$activation_code = $_POST['activation_code'];
		$reference_code = $_POST['reference_code'];
		$Descr = $_POST['Descr'];
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;
	    $IsPublic = 1;
	    $Dated = ExactServerdate();
	   
	   if($reference_code==$activation_code)
		{
		   $Is_Valid=1;
		}
		else
		{
			$Is_Valid=0;
		}

	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
	function InsertTataAig($RequestID, $ProductName)
	{
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = "3";
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		

	}

		$crap = " ".$Name." ".$Email." ".$Company_Name;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		if($crapValue=='Put')
		{
			$validMobile = is_numeric($Phone);
		
			

if(($validMobile==1) && ($Name!=""))
{		
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			 list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
		$i=0;
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$i]['UserID'];
			
				$dataInsert = array("UserID"=>'', "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Net_Salary"=>$Net_Salary, "Car_Make"=>$Car_Make, "Car_Model"=>$Car_Model, "Car_Type"=>$Car_Type, "Loan_Tenure"=>$Loan_Tenure, "Loan_Amount"=>$Loan_Amount, "Contact_Time"=>$Contact_Time, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Car_Insurance"=>$Car_Insurance, "Is_Valid"=>$Is_Valid, "Reference_Code"=>$reference_code);
			}
			else
			{
			$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
			$table = 'wUsers';
			$UserID1 = Maininsertfunc ($table, $dataInsert);
				
			$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Net_Salary"=>$Net_Salary, "Car_Make"=>$Car_Make, "Car_Model"=>$Car_Model, "Car_Type"=>$Car_Type, "Loan_Tenure"=>$Loan_Tenure, "Loan_Amount"=>$Loan_Amount, "Contact_Time"=>$Contact_Time, "Descr"=>$Descr, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Car_Insurance"=>$Car_Insurance, "Is_Valid"=>$Is_Valid, "Reference_Code"=>$reference_code);

				
			}
		//	echo "wert5et".$InsertProductSql."<br>";
		$table = 'Req_Loan_Car';
		$ProductValue = Maininsertfunc ($table, $dataInsert);
			
		
			$_SESSION['Temp_LID'] = $ProductValue;
			$encryptInsertedID =  base64_encode($ProductValue);
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Car");
				}
			}
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
			{
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			}
			else
			{	
				$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
			}
			//echo $Type_Loan;
			
			if(isset($Email))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			//Redirect here
			$explodeUrl = explode("/" , $URL);
			$URLPostion = count($explodeUrl)-1;
			$MidURL = $explodeUrl[$URLPostion];
			
			$explodeMidUrl = explode("?" , $MidURL);
			$FinalURL = $explodeMidUrl[0];
			
		//echo "get".$FinalURL;
		

		//exit();
			if($FinalURL == "car-loan-comparision.php")
			{
				//make this page
				header("Location: Contents_Car_Loan_Mustread.php?product=CarLoan");
				exit();
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
?>
