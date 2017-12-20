<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';

function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
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
 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
	$$a=$b;

		$cf_campaign = FixString($cf_campaign);
		$City = FixString($City);
		$Property_Identified= FixString($Property_Identified);
		$Property_Loc= FixString($Property_loc);
		$Name = FixString($Name);
		$Phone = FixString($Phone);
		$Email = FixString($Email);
		$dob_arr[] = FixString($year);
		$dob_arr[] = FixString($month);
		$dob_arr[] = FixString($day);
		$Age = FixString($Age);
		$CoAge = FixString($CoAge);
		$company_name = FixString($company_name);
		$Employment_Status = FixString($Employment_Status);
		$Net_Salary = FixString($Net_Salary);
		$monthly_income = ($Net_Salary /12);
		$obligations = FixString($obligations);
		$loan_amount = FixString($Loan_Amount);
		$co_appli = FixString($co_appli);
		$co_name = FixString($co_name);
		$dob_arr_co[] = FixString($co_year);
		$dob_arr_co[] = FixString($co_month);
		$dob_arr_co[] = FixString($co_day);
		$co_monthly_income = FixString($co_monthly_income);
		$co_obligations = FixString($co_obligations);
		$property_value = FixString($property_value);
		$Pincode = FixString($Pincode);
		$City_Other = FixString($City_Other);
		$hdfclife = FixString($hdfclife);
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$Activate = FixString($Activate);
		$Type_Loan = "Req_Loan_Home";
		$source = FixString($source);
		$Creative = FixString($creative);
		$Section = FixString($section);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Referrer=FixString($referrer);
		//$IP = getenv("REMOTE_ADDR");
		//$IP= $_SERVER['HTTP_X_REAL_IP'];
                $IP=ExactCustomerIP();
		$netAmount=($getnetAmount - $total_obligation);
		$accept = FixString($accept);	
		$mahindra_life = FixString($mahindra_life);
		$Dated=ExactServerdate();
		$Updated_Date=ExactServerdate();
		$validMobile = is_numeric($Phone);
		$sbicardsprocess = FixString($sbicardsprocess);	
		if(strlen($Age)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$Age;
			$dateofbirth = $year."-".$date;
		}
		else
		{
			$timestamp = strtotime('-30 years');
			$dateofbirth = date('Y-m-d',$timestamp);
		}

		if(strlen($CoAge)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$CoAge;
			$DOB_co = $year."-".$date;
		}
		else
		{
			$DOB_co = implode("-", $dob_arr_co);
		}

	$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
	$age =$DOB;

$agecalc="50";
$exactage = $agecalc- $age;
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;
	
	$IsPublic = 1;
	
if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1 || preg_match("/@/", $Name)==1)
{
	$validname=0;
}
else
		{
	$validname=1;
		}

		$crap = " ".$Name." ".$Email." ".$City;
		//echo $crap,"<br>";
		//$crapValue = validateValues($crap); //code line comment ankit
		$crapValue = $crap;
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put' && $City!='Please Select' && $validname==1 && $validMobile==1)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Home  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361','9999047207','9311773341','9555060388')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
			
			if($alreadyExist>0)
			{
				$ProductValue=$myrow['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$myrow1)=Mainselectfunc($CheckSql,$array = array());

			if($CheckNumRows>0)
			{

				$UserID = $myrow1['UserID'];
				$InsertProductSql = array("UserID"=>$UserID , "Name"=>$Name , "Email"=>$Email , "City"=>$City , "City_Other"=>$City_Other , "Mobile_Number"=>$Phone , "Net_Salary"=>$Net_Salary , "Loan_Amount"=>$loan_amount , "Dated"=>$Dated , "source"=>$source , "Referrer"=>$Referrer , "Creative"=>$Creative , "Section"=>$Section , "IP_Address"=>$IP , "Updated_Date"=>$Updated_Date , "Accidental_Insurance"=>$Accidental_Insurance , "Property_Identified"=>$Property_Identified , "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth , "Property_Loc"=>$Property_Loc , "Co_Applicant_Name"=>$co_name , "Co_Applicant_DOB"=>$DOB_co , "Co_Applicant_Income"=>$co_monthly_income , "Co_Applicant_Obligation"=>$co_obligations , "Property_Value"=>$property_value , "Total_Obligation"=>$obligations ,  "Pincode"=>$Pincode , "Privacy"=> $accept);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID1 = Maininsertfunc("wUsers", $wUsersdata);
				$InsertProductSql = array("UserID"=>$UserID1 , "Name"=>$Name , "Email"=>$Email , "City"=>$City , "City_Other"=>$City_Other , "Mobile_Number"=>$Phone , "Net_Salary"=>$Net_Salary , "Loan_Amount"=>$loan_amount , "Dated"=>$Dated , "source"=>$source , "Referrer"=>$Referrer , "Creative"=>$Creative , "Section"=>$Section , "IP_Address"=>$IP ,  "Updated_Date"=>$Updated_Date , "Accidental_Insurance"=>$Accidental_Insurance , "Property_Identified"=>$Property_Identified , "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth , "Property_Loc"=>$Property_Loc , "Co_Applicant_Name"=>$co_name , "Co_Applicant_DOB"=>$DOB_co , "Co_Applicant_Income"=>$co_monthly_income , "Co_Applicant_Obligation"=>$co_obligations , "Property_Value"=>$property_value , "Total_Obligation"=>$obligations , "Pincode"=>$Pincode , "Privacy"=> $accept);
			}
			
			 $ProductValue = Maininsertfunc("Req_Loan_Home", $InsertProductSql);
			
			 //Send SMS
			ProductSendSMStoRegis($Phone);
			
			//$ProductValue = mysql_insert_id();
			$_SESSION['ProductValue'] = $ProductValue;
			$_SESSION['Name'] = $Name;	

			if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
		$_SESSION['strcity'] = $strcity; 

		if($sbicardsprocess==1)
				{
			$cfSqldata = array("productid"=>$ProductValue, "product"=>"HL", "process_name"=>"sbicards_checkbox");
				$cfS1 = Maininsertfunc("leads_with_other_processes", $cfSqldata);
				}

			list($First,$Last) = split('[ ]', $Name);
			
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan";
			
			if(strlen(trim($Phone)) > 0)
			{
				//SendSMS($SMSMessage, $Phone);
				NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			}
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$FName=$Name;
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Home Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Home Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
				if($source=="Hl_testpage_1july")
				{
					//header("Location: apply-homeloanscontinue-16-09.php");
					//exit();
				}
				else
				{
					//header("Location: apply-homeloanscontinue1.php");
					//exit();
				}
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Eligibility Calculator | Housing Loan Eligibility - Deal4loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="home loan eligibility calculator, housing loan eligibility calculator, home loan eligibility, home loan eligibility calc, best home loan calculator" />
<meta name="Description" content="Housing Loan Eligibility: Use Deal4loans.com Home Loan Eligibility calculator to know your loan eligibility & the applicable EMI for your home loan amount. Compare home loan eligibility for Top Banks of India online within seconds.">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<style type="text/css">
.auto-style1 {
	line-height: 120%;
	font-size: 12.0pt;
	font-family: "Liberation Serif", serif;
	margin-left: 0in;
	margin-right: 0in;
	margin-top: 0in;
	margin-bottom: 7.0pt;
}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div  class="hl_inner_wrapper">
  <div style="clear:both;"></div>
  <div class="d4l_inner_wrapper">
    <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">
      <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> > <span>Home Loan Eligibility Calculator </span></div>
      <h1 class="hl-h1">Home Loan Eligibility Calculator</h1>
    </div>
    <div style="clear:both; height:15px;"></div>
    <?php 
include "home-loans-widget-step2.php";
?>
    <div style="clear:both;"></div>
    
  </div>
</div>
<div style="clear:both; height:15px;"></div>
<?php //include "responsive_footer.php"; ?>
</div>
<div class="hide_top_menu">
  <?php 
#include "footer_pl.php";
include("footer_sub_menu.php");
?>
</div>
</body>
</html>