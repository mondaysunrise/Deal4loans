<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';
	
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
		$dateofbirth = implode("-", $dob_arr);
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
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = FixString($co_monthly_income);
		$co_obligations = FixString($co_obligations);
		$property_value = FixString($property_value);
		$Pincode = FixString($Pincode);
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
		//$IP_Remote = getenv("REMOTE_ADDR");
		//if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
		//else { $IP=$IP_Remote;	}
                $IP=ExactCustomerIP();
                
		$netAmount=($getnetAmount - $total_obligation);
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		$accept = FixString($accept);	
		$mahindra_life = FixString($mahindra_life);
		$validMobile = is_numeric($Phone);
		$age =$DOB;			
		$agecalc="50";
		$exactage = $agecalc- $age;
		$getinflation = $Net_Salary *(5/100);
		$getinflationage = $getinflation * $exactage;
		$getexactvalue = $getinflationage + $Net_Salary;
		$getexactvaluemonthly = $getexactvalue/12;
		$Dated=ExactServerdate();
		$Updated_Date=ExactServerdate();
		$Reference_Code="";
		$City_Other = FixString($City_Other);
		
		if(strlen($Age)>0)
		{
			$dateofbirth = implode("-", $dob_arr);
		}
		else
		{
			$timestamp = strtotime('-30 years');
			$dateofbirth = date('Y-m-d',$timestamp);
		}
		
	
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}

if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1 || preg_match("/@/", $Name)==1)
{
	$validname=0;
}
else
		{
	$validname=1;
		}

		$crap = " ".$Name." ".$Email." ".$City;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		if($crapValue=='Put' && $City!='Please Select' && $validname==1 && $validMobile==1)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Home  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361','9999047207','9555060388','9311773341')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
				list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
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
					$hldata=array("UserID" => $UserID, "Name" => $Name,  "Email" => $Email,  "City" => $City,  "City_Other" => $City_Other,  "Mobile_Number" => $Phone,  "Net_Salary" => $Net_Salary,  "Loan_Amount" => $loan_amount,  "Dated" => $Dated,  "source" => $source,  "Referrer" => $Referrer,  "Creative" => $Creative,  "Section" => $Section,  "IP_Address" => $IP,  "Reference_Code" => $Reference_Code,  "Updated_Date" => $Updated_Date,  "Property_Identified" => $Property_Identified,  "Employment_Status" => $Employment_Status,  "DOB" => $dateofbirth,  "Property_Loc" => $Property_Loc,  "Co_Applicant_Name" => $co_name,  "Co_Applicant_DOB" => $DOB_co,  "Co_Applicant_Income" => $co_monthly_income,  "Co_Applicant_Obligation" => $co_obligations,  "Property_Value" => $property_value,  "Total_Obligation" => $obligations,  "Pincode" => $Pincode,  "Privacy"=>$accept);					
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID1 = Maininsertfunc("wUsers", $wUsersdata);
				$hldata=array("UserID" => $UserID1, "Name" => $Name,  "Email" => $Email,  "City" => $City,  "City_Other" => $City_Other,  "Mobile_Number" => $Phone,  "Net_Salary" => $Net_Salary,  "Loan_Amount" => $loan_amount,  "Dated" => $Dated,  "source" => $source,  "Referrer" => $Referrer,  "Creative" => $Creative,  "Section" => $Section,  "IP_Address" => $IP,  "Reference_Code" => $Reference_Code,  "Updated_Date" => $Updated_Date,  "Property_Identified" => $Property_Identified,  "Employment_Status" => $Employment_Status,  "DOB" => $dateofbirth,  "Property_Loc" => $Property_Loc,  "Co_Applicant_Name" => $co_name,  "Co_Applicant_DOB" => $DOB_co,  "Co_Applicant_Income" => $co_monthly_income,  "Co_Applicant_Obligation" => $co_obligations,  "Property_Value" => $property_value,  "Total_Obligation" => $obligations,  "Pincode" => $Pincode,  "Privacy"=>$accept);		
			}
			
		
			  $ProductValue = Maininsertfunc("Req_Loan_Home", $hldata);
			
			 //Send SMS
			ProductSendSMStoRegis($Phone);
			
			
			
			$_SESSION['ProductValue'] = $ProductValue;
			$_SESSION['Name'] = $Name;	
	//exit();
			if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
		$_SESSION['strcity'] = $strcity; 
		
		if($cf_campaign==1)
				{
				$cfSqldata = array("cf_name"=>$Name, "cf_mobile_number"=>$Phone, "cf_email_id"=>$Email, "cf_city"=>$City, "cf_property_value"=>$property_value, "cf_dated"=>$Dated);
				$cfS1 = Maininsertfunc("commonfloor_hlcampaign", $cfSqldata);
				}

			//Code Added to mailtocommonscript.php
			$FName = $Name;

			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
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
			
				//header("Location: apply-homeloanshtpscontinue.php");
				header("Location: apply-home-loanshttps-step1.php");
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
