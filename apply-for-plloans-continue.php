<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'hrAppFunction.php';
//print_r($_POST);
	function DetermineAgeGETDOB ($YYYYMMDD_In)
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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		    $leadid = $_REQUEST['leadid'];
			
			$_SESSION['leadid'] = $leadid;
			
			
			$Day=$_REQUEST['day'];
			$Month=$_REQUEST['month'];
			$Year=$_REQUEST['year'];
			$Pincode = $_REQUEST['Pincode'];
			$DOB=$Year."-".$Month."-".$Day;
			$Company_Name = $_REQUEST['Company_Name'];
			$Loan_Amount = $_POST['Loan_Amount'];
			$Salary_Drawn = $_POST['Salary_Drawn'];
			$Accidental_Insurance = $_POST['Accidental_Insurance'];
			$City_Other = $_REQUEST['City_Other'];
			$CC_Holder = $_REQUEST['CC_Holder'];
			$Card_Vintage = $_REQUEST['Card_Vintage'];
			$_SESSION['Temp_CC_Holder'] = $CC_Holder;
			
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Document_proof=$_REQUEST['Document_proof'];
			$Document_proof_doc=implode(",",$Document_proof);
			
	//print_r($_POST);
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			 	$Loan_A .= "$Loan_Any[$ii], ";
			 	$ii++;
			 }
		
	$getpldetails="select City_Other,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
	list($GetnumVal,$plrow)=Mainselectfunc($getpldetails,$array = array());
	
	$getCompany_Name = $plrow['Company_Name'];
	$City = $plrow['City'];
	$Name = $plrow['Name'];
	$Net_Salary = $plrow['Net_Salary'];
	//$Other_City = $plrow['City_Other'];	
	
	$getDOB = str_replace("-","", $DOB);
	$age = DetermineAgeGETDOB($getDOB);
	
	if($City=="Others")
	{
		if(strlen($Other_City)>0)
		{
			$strCity=$Other_City;
		}
		else
		{
			$strCity=$City;
		}
	}
	else
	{
		$strCity=$City;
	}

//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;

//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;
//echo "Net_Salary: ".$Net_Salary."<br>";
$monthsalary =$Net_Salary/12;
	
if($leadid>0)
{														
		
	$DataArray = array("Company_Type"=>$Company_Type, "PL_EMI_Amt"=>$PL_EMI_Amt, "Primary_Acc"=>$Primary_Acc, " Residential_Status"=>$Residential_Status, "Card_Limit"=>$Credit_Limit, "Years_In_Company"=>$Years_In_Company, "Loan_Amount" =>$Loan_Amount, "Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A, "identification_proof"=>$Document_proof_doc, "DOB"=>$DOB, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "Company_Name"=>$Company_Name, " City_Other"=>$City_Other, "Is_Valid"=>$Is_Valid, "Bidderid_Details"=>$strFinal_Bid, "Allocated"=>$Allocated, "Salary_Drawn"=>$Salary_Drawn);
$wherecondition ="RequestID=".$leadid;
Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
	
}
//	echo "<br><br>Upendra<br>";		
//		$Bidds = getBiddersListCL(1,$leadid,$strCity,$BiddID);
	//	print_r($Bidds);		
		//echo "<br><br>fdsdf";
		
		if($Net_Salary>=240000)
		{
			header("Location: apply-for-plloans-thanks.php");
			exit();
		}
		else
		{
			header("Location: apply-for-pl-continue.php");
			exit();
		}
}
?>