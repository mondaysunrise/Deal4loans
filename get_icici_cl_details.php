<?php
	require 'scripts/db_init.php';
	session_start();

	//if ($_SERVER['REQUEST_METHOD'] == 'POST')
	//{

$city = $_REQUEST["cty"];
	//$full_name = $_REQUEST["fll_nm"];
	//$mobile = $_REQUEST["mbl"];
	$occupation = $_REQUEST["occptn"];
	$annual_income = $_REQUEST["anl_inc"];
	$current_experience = $_REQUEST["crnt_exp"];
	$DOB=$_REQUEST["dob"];
	$strDOB = str_replace("-","", $DOB);

	$total_experience = $_REQUEST["ttl_exp"];
	$car_manufacturer = $_REQUEST["cr_ctgry"];
	$car_model = $_REQUEST["sb_ctgry"];
	$icici_company_name =$_REQUEST["cmpy_nm"];
	$req_id = $_REQUEST["req_id"];
	$Dated = ExactServerdate();


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


		$age = DetermineAgeFromDOB($strDOB);



if(strlen($car_manufacturer)>0 && strlen($car_model)>0 && strlen($city)>0 && strlen($occupation)>0)
{
	if($req_id>0)
	{
//$icici_clquery="Update icici_car_loan_calc set icici_name='$full_name', icici_mobile='$mobile', icici_city='$city', icici_occupation='$occupation' , icici_annual_income='$annual_income', icici_current_experience='$current_experience', icici_total_experience='$total_experience', icici_age='$age' , icici_car_manufacturer='$car_manufacturer', icici_car_model='$car_model', icici_dated=Now(), icici_company_name='$icici_company_name',icici_dob='$DOB' Where icici_clid=".$req_id;
	$DataArray = array("icici_name"=>$full_name, "icici_mobile"=>$mobile, "icici_city"=>$city, "icici_occupation"=>$occupation, "icici_annual_income"=>$annual_income, "icici_current_experience"=>$current_experience, "icici_total_experience"=>$total_experience, "icici_age"=>$age, "icici_car_manufacturer"=>$car_manufacturer, "icici_car_model"=>$car_model, "icici_dated"=>$Dated, "icici_company_name"=>$icici_company_name, "icici_dob"=>$DOB);
	$wherecondition ="icici_clid=".$req_id;
	Mainupdatefunc ('icici_car_loan_calc', $DataArray, $wherecondition);
	}
	else
	{
//$icici_clquery="INSERT INTO  icici_car_loan_calc (icici_name, icici_mobile, icici_city, icici_occupation , icici_annual_income, icici_current_experience, icici_total_experience, icici_age ,  icici_car_manufacturer, icici_car_model, icici_is_valid , icici_dated, icici_company_name,icici_dob) Values ( '".$full_name."', '".$mobile."', '".$city."', '".$occupation."', '".$annual_income."', '".$current_experience."', '".$total_experience."', '".$age."','".$car_manufacturer."','".$car_model."', '".$is_valid."', NOW(),'".$icici_company_name."','".$DOB."' )";
	
	$dataInsert = array("icici_name"=>$full_name, "icici_mobile"=>$mobile, "icici_city"=>$city, "icici_occupation"=>$occupation, "icici_annual_income"=>$annual_income, "icici_current_experience"=>$current_experience, "icici_total_experience"=>$total_experience, "icici_age"=>$age, "icici_car_manufacturer"=>$car_manufacturer, "icici_car_model"=>$car_model, "icici_is_valid"=>$is_valid, "icici_dated"=>$Dated, "icici_company_name"=>$icici_company_name, "icici_dob"=>$DOB);
	$table = 'icici_car_loan_calc';
	$insert = Maininsertfunc ($table, $dataInsert);
	}



//$result = ExecQuery($icici_clquery);
$ProductValue = mysql_insert_id();
if($req_id>0)
	{
$strProductValue = $req_id;
	}
	else
	{
$strProductValue = $ProductValue;
	}

	echo $strProductValue;
}


?>