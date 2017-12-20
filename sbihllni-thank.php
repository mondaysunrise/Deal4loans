<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

//echo "ddd";

//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
		$hl_requestid = $_POST["hl_requestid"];
		$City = $_POST["hl_city"];
		$Name = $_POST["hl_name"];
		$Email = $_POST["hl_email"];
		$Phone = $_POST["hl_mobile"];
		$Net_Salary = $_POST["hl_income"];
		$loan_amount = $_POST["hl_loan_amt"];
		$Employment_Status = $_POST["hl_emp_stat"];
$source = $_POST["source"];

		$dob_arr[] = $_POST['year'];
		$dob_arr[] = $_POST['month'];
		$dob_arr[] = $_POST['day'];
		$dateofbirth = implode("-", $dob_arr);
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
		$Property_Identified = $_POST['Property_Identified'];
		$Pincode = $_POST['Pincode'];
		$Property_Loc = $_POST["Property_loc"];
		$City_Other = $_POST["City_Other"];
		$Dated = ExactServerdate();

	if($hl_city=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$hl_city;
		}

if($hl_requestid>0 && strlen($City)>2 && strlen($Phone)>9)
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
				$ProductValue=$myrow[$cntr]['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
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
	
	$ProductValue =  Maininsertfunc ($table, $dataInsert);
	$_SESSION['ProductValue'] = $ProductValue;
	$_SESSION['strcity'] = $strcity;
$_SESSION['Name'] = $Name;

		}
		}//$crap Check
		
}

header("Location: http://www.loansninsurances.com/sbi-home-loanthank.php");
exit();
?>