<?php
ob_start();
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
   
   
   function appendzero($number, $digits)
{
   $output = str_pad($number, $digits, "0", STR_PAD_LEFT);
   return $output;
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = $_POST['Name'];
	
	$day = $_POST['day'];
		$day = appendzero($day, 2);
		$month = $_POST['month'];
		$month = appendzero($month, 2);
		$year = $_POST['year'];
		$DOB = $year."-".$month."-".$day;
//	$DOB=$_POST['birth_date'];
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$Pincode = $_POST['Pincode'];
	$City_Other = $_POST['City_Other'];
	$IncomeAmount = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$Employment_Status = $_POST['Employment_Status'];
	$source = $_POST['source'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Referrer=$_REQUEST['referrer'];
	$Property_Value = $_POST['Property_Value'];
	$URL = $_POST['URL'];
	$Company_Name = $_POST['Company_Name'];
	//$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;
	$Net_Salary=$IncomeAmount;

//echo $Type_Loan."<br>";

	function InsertTataAig($RequestID, $ProductName)
	{
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = "5";
		
	
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
	
	}
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where RequestID=".$Activate;		
  Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
		$crap = " ".$Name." ".$Email." ".$City;
		echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
				echo $validMobile = is_numeric($Phone);
	
			
if(($validMobile==1) && ($Name!=""))
{		
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		
			list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			$i=0;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
			
				$UserID = $getrow[$i]['UserID'];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$IncomeAmount, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Value'=>$Property_Value, 'Pincode'=>$Pincode, 'DOB'=>$DOB, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name);
			}
			else
			{
			
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table = 'wUsers';
				$UserID = Maininsertfunc ($table, $dataInsert);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$IncomeAmount, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Value'=>$Property_Value, 'Pincode'=>$Pincode, 'DOB'=>$DOB, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name);
			}
echo "<br>else".$InsertProductSql."<br><br>";
			$ProductValue = Maininsertfunc ($Type_Loan, $dataInsert);	
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Against_Property");
				}
			//exit();
			
			/*$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
			{	
				//SendSMS($SMSMessage, $Phone);
			}*/
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
			{	
				$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
			}
			else
			{	
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			}
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			//Redirect here
			$explodeUrl = explode("/" , $URL);
			$URLPostion = count($explodeUrl)-1;
			$MidURL = $explodeUrl[$URLPostion];
			
			$explodeMidUrl = explode("?" , $MidURL);
			$FinalURL = $explodeMidUrl[0];
			
			if($FinalURL == "loan-against-property-comparision.php")
			{
				//make this page
				header("Location: Contents_Loan_Against_Property_Mustread.php");
				exit();
			}
			
		}
		else
		{
			echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL =$_POST["PostURL"]."?msg=".$msg;
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
?>