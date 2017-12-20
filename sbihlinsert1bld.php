<?php
require 'scripts/session_check.php';
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
			$cntr=0;
			
			if($alreadyExist>0)
			{
				header('Location: http://www.bestloansdeal.com/sbi-home-loan.php');
				exit();
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$Arrrow)=MainselectfuncNew($CheckSql,$array = array());
				$k=0;
			
			if($CheckNumRows>0)
			{
				$UserID = $Arrrow[$k]['UserID'];
			
		$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$loan_amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "Reference_Code"=>$Reference_Code, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Property_Identified"=>$Property_Identified, "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth, "Property_Loc"=>$Property_Loc, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Property_Value"=>$property_value, "Total_Obligation"=>$obligations, "Edelweiss_Compaign"=>$edelweiss, "Pincode"=>$Pincode, "ABMMU_flag"=>$ABMMU_flag, "Privacy"=>$accept);
$table = 'Req_Loan_Home';
			
			}
			else
			{
		
		$dataInsert1 = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
		$table1 = 'wUsers';
		$UserID = Maininsertfunc ($table1, $dataInsert1);

			
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$loan_amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "Reference_Code"=>$Reference_Code, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Property_Identified"=>$Property_Identified, "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth, "Property_Loc"=>$Property_Loc, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Property_Value"=>$property_value, "Total_Obligation"=>$obligations, "Edelweiss_Compaign"=>$edelweiss, "Pincode"=>$Pincode, "ABMMU_flag"=>$ABMMU_flag, "Privacy"=>$accept);
$table = 'Req_Loan_Home';
			
			}
			$ProductValue = Maininsertfunc ($table, $dataInsert);
		}
		}//$crap Check
		else if($crapValue=='Discard')
		{
		//	echo "1";
			header('Location: http://www.bestloansdeal.com/home-loan.php');
			exit();
		}
		else
		{
		//echo "2";
			header('Location: http://www.bestloansdeal.com/home-loan.php');
			exit();
		}
			header('Location: http://www.bestloansdeal.com/sbihlinsert1bld.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			exit();
		

 ?>