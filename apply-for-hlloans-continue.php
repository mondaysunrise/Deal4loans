<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'hrAppFunction.php';

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

//Array ( [ProductValue] => 397808 [Net_Salary] => 560000.00 [City] => Chennai [City_Other] => [day] => 12 [month] => 12 [year] => 1980 [Loan_Amount] => 2100000 [Pincode] => 110092 [property_value] => 2700000 [Property_Identified] => 1 [co_obligations] => 2087 [Property_Loc] => Chennai [co_appli] => 1 [co_name] => fdsffds [co_day] => 12 [co_month] => 12 [co_year] => 1980 [co_monthly_income] => 650000 ) 

$leadid = $_POST['ProductValue'];
$Net_Salary = $_POST['Net_Salary'];
$monthly_income = ($Net_Salary /12);
$City = $_POST['City'];
$City_Other = $_POST['City_Other'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$dateofbirth = $year."-".$month."-".$day;
$Loan_Amount = $_POST['Loan_Amount'];
$Pincode = $_POST['Pincode'];
$Company_Name = $_POST['Company_Name'];
$property_value = $_POST['property_value'];
$Property_Identified = $_POST['Property_Identified'];
$Property_Loc = $_POST['Property_Loc'];
$obligations = $_POST['obligations'];
$co_obligations = $_POST['co_obligations'];
$co_name = $_POST['co_name'];
$co_day = $_POST['co_day'];
$co_month = $_POST['co_month'];
$co_year = $_POST['co_year'];
$DOB_co = $co_year."-".$co_month."-".$co_day; 
$co_monthly_income = $_POST['co_monthly_income'];
$getnetAmount = ($monthly_income + $co_monthly_income);
$total_obligation = $obligations + $co_obligations;
$Type_Loan = "Req_Loan_Home";
$netAmount=($getnetAmount - $total_obligation);
$DOB = str_replace("-","", $dateofbirth);
$DOB = DetermineAgeFromDOB($DOB);
$tenorPossible = 60 - $DOB;
$age =$DOB;
//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;
//echo $exactage."<br>";
//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;
if($City=="Others")
{
	$strcity=$City_Other;
}
else
{
	$strcity=$City;
}
$BiddID  = array(2718,2730,2719,2852,2958,2720,2843,2844,2845,2846);
$Bidds = getBiddersListCL(2,$leadid,$strcity,$BiddID);
$strFinalBidders = implode(",", $Bidds[0]);


$DataArray = array("City_Other" =>$City_Other, "Property_Identified" =>$Property_Identified,  "DOB" =>$dateofbirth, "Property_Loc" => $Property_Loc, "Co_Applicant_Name" =>$co_name, "Co_Applicant_DOB" =>$DOB_co, "Co_Applicant_Income" => $co_monthly_income, "Co_Applicant_Obligation" =>$co_obligations, "Property_Value" =>$property_value,  "Total_Obligation" => $obligations, "Loan_Amount" => $Loan_Amount, "Edelweiss_Compaign" =>$edelweiss, "Pincode" => $Pincode, "Company_Name" =>$Company_Name);
$wherecondition ="RequestID = '".$leadid."'";
Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);


$_SESSION['ProductValue'] = $leadid;


header('Location: hrhomeloansthanks.php');	
exit();
?>