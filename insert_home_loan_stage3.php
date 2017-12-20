<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
//	require 'getlistofeligiblebidders1.php';
//cho "uh";
//echo "dsfsfsdsdf";
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
 //print_r($_POST);

		$leadid= $_POST['leadid'];
		$Property_Identified= $_POST['Property_Identified'];
		$Property_Loc= $_POST['Property_loc'];
		$dob_arr[] = $_POST['year'];
		$dob_arr[] = $_POST['month'];
		$dob_arr[] = $_POST['day'];
		$dateofbirth = implode("-", $dob_arr);
		$company_name = $_POST['company_name'];
		$Employment_Status = $_POST['Employment_Status'];
		$Net_Salary = $_POST['Net_Salary'];
		$monthly_income = ($Net_Salary /12);
		$obligations = $_POST['obligations'];
		$co_appli = $_POST['co_appli'];
		$co_name = $_POST['co_name'];
		$dob_arr_co[] = $_POST['co_year'];
		$dob_arr_co[] = $_POST['co_month'];
		$dob_arr_co[] = $_POST['co_day'];
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = $_POST['co_monthly_income'];
		$co_obligations = $_POST['co_obligations'];
		$property_value = $_POST['property_value'];
		$Pincode = $_POST['Pincode'];
	$hdfclife = $_REQUEST['hdfclife'];
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$Activate = $_POST['Activate'];
		$Type_Loan = "Req_Loan_Home";
		$source = $_POST['source'];
		$Creative = $_POST['creative'];
		$Section = $_POST['section'];
		$Accidental_Insurance = $_POST['Accidental_Insurance'];
		$Referrer=$_REQUEST['referrer'];
		$IP = getenv("REMOTE_ADDR");
		$netAmount=($getnetAmount - $total_obligation);
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		$edelweiss = $_POST["edelweiss"];
		$Ibibo_compaign = $_POST['Ibibo_compaign'];
		$ABMMU_flag = $_REQUEST["adty_brl"];
		//$getDOB = str_replace("-","", $dateofbirth);
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
	
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
			$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}

function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
			$Dated = ExactServerdate();
			$dataInsert = array("ibibo_product"=>2, "ibibo_requestid"=>$ProductValue, "ibibo_name"=>$Name, "ibibo_city"=>$City, "ibibo_mobile"=>$Phone, "ibibo_dob"=>$DOB, "ibibo_car_name"=>$Ibibo_compaign, " ibibo_dated"=>$Dated, "ibibo_email"=>$Email);
			$table = 'ibibo_compaign_leads';
			$insert = Maininsertfunc ($table, $dataInsert);
	}
	
		$dataArray = array('ABMMU_flag'=>$ABMMU_flag, 'City_Other'=>$City_Other, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>$Employment_Status, 'DOB'=>$dateofbirth, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode);
	$wherecondition = "(RequestID = '".$leadid."')";
		Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
	
			if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
		if($hdfclife==1)
		{
			$Product=2;
			Insert_HdfcLife($Name, $City, $Phone, $dateofbirth, $Email, $Net_Salary, $Product, $ProductValue );
		}

		if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($ProductValue, $Name, $strcity, $Phone, $DOB, $Ibibo_compaign, $Email);
		}
	
//header("Location: homeloansthanks.php");
exit();
	

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<META HTTP-EQUIV="Refresh" CONTENT="URL=apply_personal_loan_step2.php">  
 --><title>Home Loan Processing</title>
</head>
<body style="margin:0px; padding:0px;">

</body>
</html>
