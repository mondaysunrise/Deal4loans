<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'hrAppFunction.php';
	
	error_reporting();
	$page_Name = "LandingPage_PL";
function DetermineAgeFromDOB ($YYYYMMDD_In)
	{
	  $yIn=substr($YYYYMMDD_In, 0, 4);
	  $mIn=substr($YYYYMMDD_In, 4, 2);
	  $dIn=substr($YYYYMMDD_In, 6, 2);
	  $ddiff = date("d") - $dIn;
	  $mdiff = date("m") - $mIn;
	  $ydiff = date("Y") - $yIn;
	  if ($mdiff < 0)
	  {
		$ydiff--;
	  } elseif ($mdiff==0)
	  {
		if ($ddiff < 0)
		{
		  $ydiff--;
		}
	  }
	  return $ydiff;
	}

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
   
   	function  Insertcpp($ProductValue, $Name,$City, $Phone, $DOB, $Email, $CC_Holder )
	{
		$Dated = ExactServerdate();	
		$dataInsert = array('CPP_RequestID'=>$ProductValue, 'CPP_Product'=>'4', 'CPP_Name'=>$Name, 'CPP_City'=>$City, 'CPP_Mobile_Number'=>$Phone, 'CPP_DOB'=>$DOB, 'CPP_Dated'=>$Dated, 'CPP_Email'=>$Email, 'CPP_CC_Holder'=>$CC_Holder);
		$table = 'cpp_card_protection_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	}
	function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
		$Dated = ExactServerdate();		
		$dataInsert = array("ibibo_product"=>'4' , "ibibo_requestid"=>$ProductValue , "ibibo_name"=>$Name , "ibibo_city"=>$City , "ibibo_mobile"=>$Phone, "ibibo_dob"=>$DOB , "ibibo_car_name"=>$Ibibo_compaign , "ibibo_dated"=>$Dated , "ibibo_email"=>$Email );
		$table = 'ibibo_compaign_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	}


	foreach($_POST as $a=>$b)
	$$a=$b;
	
	$ProductValue = $_POST['leadid'];	
	$Pancard = $_POST['Pancard'];
	$CC_Holder = $_POST['CC_Holder'];
	$Card_Vintage = $_POST['Card_Vintage'];
	$City =  $_POST['City'];
	$City_Other =  $_POST['City_Other'];
	$Company_Name =  $_POST['Company_Name'];
	$No_of_Banks = $_REQUEST["No_of_Banks"];

	$IsPublic =1;
	$Day= $_POST['day'];
	$Month= $_POST['month'];
	$Year= $_POST['year'];
	$DOB=$Year."-".$Month."-".$Day;
	$Type_Loan = "CreditCard";
	$Pincode =  $_POST['Pincode'];
	
	$getDOB = $Year."".$Month."".$Day;
	$Age = DetermineAgeFromDOB($getDOB);
	
	$checkPincodeSql = "select * from barclays_pincode_list where pincode='".$Pincode."' and status=1"; 
	list($checkPincode,$checkPincodeQuery)=MainselectfuncNew($checkPincodeSql,$array = array());
	
	$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$Company_Name.'"';
// echo $getcompany;
list($recordcounthdfccc,$grow)=MainselectfuncNew($gethdfccccompany,$array = array());
if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $grow[0]["company_category"];
	}

if($hdfc_cccategory=="Cat AB")
	{
		$Company_HDFC_Cat=1;
	}
	else
	{
		$Company_HDFC_Cat=0;
	}

	if($City=="Others")
	{
		$strcity=$City_Other;
	}
	else
	{
		$strcity=$City;
	}
				
	$dataUpdate = array('Company_Name'=>$Company_Name, 'City_Other'=>$City_Other, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'Pincode'=>$Pincode, 'No_of_Banks'=>$No_of_Banks, 'Company_HDFC_Cat'=>$Company_HDFC_Cat, 'Bidderid_Details'=>$strFinalBidders, 'Allocated'=>$Allocated);
	$wherecondition =  "(RequestID = '".$ProductValue."')";
	Mainupdatefunc ('Req_Credit_Card', $dataUpdate, $wherecondition);		

	$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the offers have been sent to your email.Keep your Pan Number handy when you apply.";

				//if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			
			if($cpp_card_protect=="1" && $CC_Holder==1)
			{
			//	Insertcpp($ProductValue, $Name,$City, $Phone, $DOB,$Email, $CC_Holder);
			}
			
			
			$_SESSION['Temp_LID'] = $ProductValue;

			//echo $Net_Salary; 
			if($Net_Salary<100)
			{
				header ("Location: apply-credit-card-salary-correction.php");
				exit();
			}
			if($Net_Salary>=300000)
			{
				$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the same offers have been sent to your email. Keep your Pan Number handy when you apply.";
				if(strlen(trim($Phone)) > 0)
					SendSMS($SMSMessage, $Phone);
			}

		//Code Added to mailtocommonscript.php
		$FName = $Name;
		$Checktosend="getthank_individual";
		include "scripts/mailatcommonscript.php";
		
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		if($Name)
		$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
		else
		$SubjectLine = "Learn to get Best Deal on Credit Card";
		//echo $Type_Loan;
		if(isset($Type_Loan))
		{
			mail($Email, $SubjectLine, $Message2, $headers);
		}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com/".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}

header("Location: apply-for-cc-thanks.php");
exit();

?>