<?php
@set_time_limit(800);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

//echo "ddd";
//print_r($_REQUEST);
		$bldReqID = $_REQUEST['bldReqID'];
		$City = $_REQUEST["City"];
		$Name = $_REQUEST["Name"];
		$Email = $_REQUEST["Email"];
		$Phone = $_REQUEST["Phone"];
		$Net_Salary = $_REQUEST["Net_Salary"];
		$loan_amount = $_REQUEST["Loan_Amount"];
		$Employment_Status = $_REQUEST["Employment_Status"];
		$source = $_REQUEST["source"];
		$IP = $_REQUEST["IP"];
		
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
        $Dated = ExactServerdate();


if(strlen($City)>2 && strlen($Phone)>9)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Home  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
				
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[0]['RequestID'];
				$Duplicate = "Duplicate";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$Arrrow)=MainselectfuncNew($CheckSql,$array = array());
			
			
			if($CheckNumRows>0)
			{
				$UserID = $Arrrow[0]['UserID'];
$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$loan_amount, "Dated"=>$Dated, "source"=>$source, " Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "Reference_Code"=>$Reference_Code, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Property_Identified"=>$Property_Identified, "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth, "Property_Loc"=>$Property_Loc, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Property_Value"=>$property_value, "Total_Obligation"=>$obligations, "Edelweiss_Compaign"=>$edelweiss, "Pincode"=>$Pincode, "ABMMU_flag"=>$ABMMU_flag, "Privacy"=>$accept);
			
			}
			else
			{
$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
$table = 'wUsers';
$insert = Maininsertfunc ($table, $dataInsert);
$UserID = mysql_insert_id();
				
$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$loan_amount, "Dated"=>$Dated, "source"=>$source, " Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "Reference_Code"=>$Reference_Code, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Property_Identified"=>$Property_Identified, "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth, "Property_Loc"=>$Property_Loc, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Property_Value"=>$property_value, "Total_Obligation"=>$obligations, "Edelweiss_Compaign"=>$edelweiss, "Pincode"=>$Pincode, "ABMMU_flag"=>$ABMMU_flag, "Privacy"=>$accept);

			}
			
$table = 'Req_Loan_Home';
$insert = Maininsertfunc ($table, $dataInsert);

			$ProductValue = mysql_insert_id();
		
		 $DataArray = array("DOB"=>$dateofbirth, "City_Other"=>$City_Other, "Pincode"=>$Pincode, "Property_Value"=>$property_value, "Property_Identified"=>$Property_Identified, "Property_Loc"=>$Property_Loc, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Total_Obligation"=>$obligations);
		$wherecondition ="RequestID=".$ProductValue;
		Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
		
			
		}
		}//$crap Check\
	
$dataInsert = array("RequestID"=>$ProductValue, "LnsID"=>$bldReqID, "Duplicate"=>$Duplicate, "Product_Name"=>$HL);
$table = 'Req_lead_trans';
$insert = Maininsertfunc ($table, $dataInsert);


		
	echo "<br><br>";	
	echo $ProductValue;
	echo ",".$bldReqID;
	
		//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			//exit();
		

 ?>