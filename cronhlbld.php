<?php
ini_set('max_execution_time', 600);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

//echo "ddd";
//print_r($_REQUEST);
		$bldReqID = FixString($_REQUEST['bldReqID']);
		$City = FixString($_REQUEST["City"]);
		$Name = FixString($_REQUEST["Name"]);
		$Email = FixString($_REQUEST["Email"]);
		$Phone = FixString($_REQUEST["Phone"]);
		$Net_Salary = FixString($_REQUEST["Net_Salary"]);
		$loan_amount = FixString($_REQUEST["Loan_Amount"]);
		$Employment_Status = FixString($_REQUEST["Employment_Status"]);
		$source = FixString($_REQUEST["source"]);
		$IP = FixString($_REQUEST["IP"]);
		
		$dob_arr[] = FixString($_REQUEST['year']);
		$dob_arr[] = FixString($_REQUEST['month']);
		$dob_arr[] = FixString($_REQUEST['day']);
		$dateofbirth = implode("-", $dob_arr);
		$obligations = FixString($_REQUEST['obligations']);
		$co_appli = FixString($_REQUEST['co_appli']);
		$co_name = FixString($_REQUEST['co_name']);
		$dob_arr_co[] = FixString($_REQUEST['co_year']);
		$dob_arr_co[] = FixString($_REQUEST['co_month']);
		$dob_arr_co[] = FixString($_REQUEST['co_day']);
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = FixString($_REQUEST['co_monthly_income']);
		$co_obligations = FixString($_REQUEST['co_obligations']);
		$property_value = FixString($_REQUEST['property_value']);
		$Property_Identified = FixString($_REQUEST['Property_Identified']);
		$Pincode = FixString($_REQUEST['Pincode']);
	 	$Property_Loc = FixString($_REQUEST["Property_loc"]);
		$City_Other = FixString($_REQUEST["City_Other"]);
		$Dated=ExactServerdate();


if(strlen($City)>2 && strlen($Phone)>9)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Home  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]['RequestID'];
				$Duplicate = "Duplicate";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
	list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				
				$UserID = $myrow[$myrowcontr]["UserID"];
		
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>$Employment_Status, 'DOB'=>$dateofbirth, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Pincode'=>$Pincode);

			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>$Employment_Status, 'DOB'=>$dateofbirth, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Pincode'=>$Pincode);
			}
			
$ProductValue = Maininsertfunc ('Req_Loan_Home', $dataInsert);	
			
			$dataUpdate = array('DOB'=>$dateofbirth, 'City_Other'=>$City_Other, 'Pincode'=>$Pincode, 'Property_Value'=>$property_value, 'Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Total_Obligation'=>$obligations);
			$wherecondition = "(RequestID=".$ProductValue.")";
				Mainupdatefunc ('Req_Loan_Home', $dataUpdate, $wherecondition);
			$Duplicate = "";
		}
		}//$crap Check
	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;
	
		//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			//exit();
		

 ?>