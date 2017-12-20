<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
	$page_Name = "LandingPage_HL";

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

	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$IP = getenv("REMOTE_ADDR");
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dob=$year."-".$month."-".$day;
	$Pincode = $_POST['Pincode'];
	$Employment_Status = $_POST['Employment_Status'];
	$Property_Identified = $_POST['Property_Identified'];
	$Property_Value = $_POST['Property_Value'];
	$obligations = $_POST['obligations'];
	$Loan_Time = $_POST['Loan_Time'];
	$Company_Name = $_POST['Company_Name'];
	$co_appli = $_POST['co_appli'];
	$co_name = $_POST['co_name'];
	$dob_arr_co[] = $_POST['co_year'];
	$dob_arr_co[] = $_POST['co_month'];
	$dob_arr_co[] = $_POST['co_day'];
	$DOB_co = implode("-", $dob_arr_co);
	$co_monthly_income = $_POST['co_monthly_income'];
	$co_obligations = $_POST['co_obligations'];
	$getnetAmount = ($monthly_income + $co_monthly_income);
	$total_obligation = $obligations + $co_obligations;
	$Dated = ExactServerdate();
	$IsPublic = 1;
		if($City=="Others" || $City=="Please Select")
{
	$City=$City_Other;
}
else
{
	$City= $City;
}

	$crap = " ".$Name." ".$Email." ".$City_Other;
		
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		
		if($crapValue=='Put')
		{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
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
			 list($CheckNumRows,$myrow)=MainselectfuncNew($CheckSql,$array = array());
		$j=0;
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$j]['UserID'];
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "DOB "=>$dob, "Property_Identified"=>$Property_Identified, "Pincode"=>$Pincode, "Employment_Status"=>$Employment_Status, "Loan_Time"=>$Loan_Time, "Property_Value"=>$Property_Value, "Company_Name"=>$Company_Name, "Total_Obligation "=>$total_obligation, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Property_Loc"=>$Property_Loc);

			
			}
			else
			{
				$dataInsert1 = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
$table1 = 'wUsers';
$insert1 = Maininsertfunc ($table1, $dataInsert1);
				
				$UserID = $insert1;
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "DOB "=>$dob, "Property_Identified"=>$Property_Identified, "Pincode"=>$Pincode, "Employment_Status"=>$Employment_Status, "Loan_Time"=>$Loan_Time, "Property_Value"=>$Property_Value, "Company_Name"=>$Company_Name, "Total_Obligation "=>$total_obligation, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Property_Loc"=>$Property_Loc);
			
			}
			
			
			$ProductValue = Maininsertfunc ($Type_Loan, $dataInsert);
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan. ";
			if(strlen(trim($Phone)) > 0)
				NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			
			list($First,$Last) = split('[ ]', $Name);

						
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			//include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
				$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				//mail($Email, $SubjectLine, $Message2, $headers);
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
<html>
<body>
	<table align="center">
		<tr>
			<td><h2>Thanks your lead has been submitted..</h2></td>
		</tr>
	</table>
</body>
</html>