<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//print_r($_POST);
	$page_Name = "LandingPage_HL";

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

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = $_POST['Name'];
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
    $DOB = $_POST['birth_date'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Employment_Status = $_POST['Employment_Status'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Referrer=$_REQUEST['referrer'];
	$Reference_Code = generateNumber(4);
	//$IP = getenv("REMOTE_ADDR");
        $IP=ExactCustomerIP();
	$URL = $_POST['PostURL'];
	$IsPublic = 1;
	$Dated = ExactServerdate();
	
	
	$Pincode = $_REQUEST['Pincode'];
	$Employment_Status = $_REQUEST['Employment_Status'];
	$Company_Name = $_REQUEST['Company_Name'];
	
	$Property_Identified = $_REQUEST['Property_Identified'];
	$Property_Loc = $_REQUEST['Property_Loc'];
	$updateProperty = $_REQUEST['updateProperty'];
	$Loan_Time = $_REQUEST['Loan_Time'];
	$Budget = $_REQUEST['Budget'];
			
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	

		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			$cntr=0;
			
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$cntr]['UserID'];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Employment_Status'=>$Employment_Status, 'DOB'=>$DOB, 'Pincode'=>$Pincode, 'Company_Name'=>$Company_Name, 'Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Loan_Time'=>$Loan_Time, 'Budget'=>$Budget);
			}
			else
			{
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table = 'wUsers';
				$UserID = Maininsertfunc ($table, $dataInsert);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Employment_Status'=>$Employment_Status, 'DOB'=>$DOB, 'Pincode'=>$Pincode, 'Company_Name'=>$Company_Name, 'Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Loan_Time'=>$Loan_Time, 'Budget'=>$Budget);
			}
				$ProductValue = Maininsertfunc ($Type_Loan, $dataInsert);			
				$encryptInsertedID =  base64_encode($ProductValue);
			//exit();
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Home");
				}
			
			
			
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
			
			$explodeUrl = explode("/" , $URL);
			$URLPostion = count($explodeUrl)-1;
			$MidURL = $explodeUrl[$URLPostion];
			
			$explodeMidUrl = explode("?" , $MidURL);
			$FinalURL = $explodeMidUrl[0];
			
		//echo $FinalURL;
		
		//exit();
			if($FinalURL == "home-loan-comparision.php")
			{
				header("Location: ndtvmoney/home-loan-comparision-continue.php?id=$encryptInsertedID");
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