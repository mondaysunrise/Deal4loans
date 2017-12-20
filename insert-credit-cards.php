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
	//print_r($_POST);
	$Name= $_POST['Name'];
	$Email = $_POST['Email'];
	$Loan_Any = $_POST['Loan_Any'];
	$Phone = $_POST['Phone'];
	$Pancard = $_POST['Pancard'];
	$CC_Holder = $_POST['CC_Holder'];
	$Card_Vintage = $_POST['Card_Vintage'];
	$City = $_POST['City'];
	$Reference_Code = generateNumber(4);
	$City_Other = $_POST['City_Other'];
	$Company_Name = $_POST['Company_Name'];
	$Net_Salary =$_POST['IncomeAmount'];
	$IsPublic =1;
    $URL = $_POST['URL'];
	$day = $_POST['day'];
		$day = appendzero($day, 2);
		$month = $_POST['month'];
		$month = appendzero($month, 2);
		$year = $_POST['year'];
		$DOB = $year."-".$month."-".$day;
	
	//$DOB=$_POST['birth_date'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Reference_Code = $_POST['Reference_Code'];
	$Employment_Status = $_POST['Employment_Status'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Referrer=$_REQUEST['referrer'];
	$source=$_REQUEST['source'];
	$Section=$_REQUEST['section'];
	$Creative=$_REQUEST['creative'];
	$Type_Loan ="CreditCard";
	$Dated = ExactServerdate();
	

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
		$Product_Name = "4";
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		
		//exit();

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
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "IsPublic"=>$IsPublic, "Dated"=>$Dated, " Reference_Code"=>$Reference_Code, "source"=>$source, "Pancard"=>$Pancard, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "IP_Address"=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Loan_Any"=>$Loan_Any);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
			
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table = 'wUsers';
				$UserID = Maininsertfunc ($table, $dataInsert);
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "IsPublic"=>$IsPublic, "Dated"=>$Dated, " Reference_Code"=>$Reference_Code, "source"=>$source, "Pancard"=>$Pancard, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "IP_Address"=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Loan_Any"=>$Loan_Any);	
			}


			//echo "wert5et".$InsertProductSql."<br>";
			$table2	= 'Req_Credit_Card';
			$ProductValue = Maininsertfunc ($table2, $dataInsert);		
			$_SESSION['Temp_LID'] = $ProductValue;
			$encryptInsertedID =  base64_encode($ProductValue);
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Credit_Card");
				}
			//exit();
			/*$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of card app form to get bidder contacts & quotes. And help us serve you better.";
					if(strlen(trim($Phone)) > 0)
					{
						//SendSMS($SMSMessage, $Phone);
					}*/
			}
			
			$Type_Loan ="CreditCard";
			//Code Added to mailtocommonscript.php
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
				//mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			//Redirect here
			$explodeUrl = explode("/" , $URL);
			$URLPostion = count($explodeUrl)-1;
			$MidURL = $explodeUrl[$URLPostion];
			
			$explodeMidUrl = explode("?" , $MidURL);
			$FinalURL = $explodeMidUrl[0];
			
		echo "get".$FinalURL;
		
		//exit();
			if($FinalURL == "credit-card-comparision.php")
			{
				//make this page
				header("Location: ndtvmoney/ndtvmoney-credit-cards-continue.php?id=$encryptInsertedID");
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
