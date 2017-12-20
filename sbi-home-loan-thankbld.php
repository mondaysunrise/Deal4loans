<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

//echo "ddd";

//print_r($_REQUEST);
	$hl_requestid = $_REQUEST["ProductValue"];
	

		$dob_arr[] = $_REQUEST['year'];
		$dob_arr[] = $_REQUEST['month'];
		$dob_arr[] = $_REQUEST['day'];
		$dateofbirth = implode("-", $dob_arr);
		$obligations = $_REQUEST['obligations'];
		$co_appli = $_REQUEST['co_appli'];
		$co_name = $_REQUEST['co_name'];
		$dob_arr_co[] = $_REQUEST['co_year'];
		$dob_arr_co[] = $_REQUEST['co_month'];
		$dob_arr_co[] = $_REQUEST['co_day'];
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = $_REQUEST['co_monthly_income'];
		$co_obligations = $_REQUEST['co_obligations'];
		$property_value = $_REQUEST['property_value'];
		$Property_Identified = $_REQUEST['Property_Identified'];
		$Pincode = $_REQUEST['Pincode'];
	 	$Property_Loc = $_REQUEST["Property_loc"];
		$City_Other = $_REQUEST["City_Other"];

	if($hl_city=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$hl_city;
		}

		$DataArray = array("DOB"=>$dateofbirth, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Property_Value"=>$property_value, "Property_Identified"=>$Property_Identified, "Property_Loc"=>$Property_Loc, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Total_Obligation"=>$obligations);
		$wherecondition ="RequestID=".$hl_requestid;
		Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
		header('Location: http://www.bestloansdeal.com/home-loan-thank.php');
		exit();
		

 ?>