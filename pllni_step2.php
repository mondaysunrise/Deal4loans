<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4', 
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	
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

	
$getCompany_Name = $Company_Name;
		list($year,$month,$day) = split('[-]', $DOB);

$currentyear=date('Y');
$age=$currentyear-$year;

	if ($_REQUEST['RequestID']> 0)
	{
		    $leadid = $_REQUEST['RequestID'];
		  	$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Salary_Drawn = $_REQUEST['Salary_Drawn'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Document_proof=$_REQUEST['Document_proof'];
			$CC_Holder = $_REQUEST['CC_Holder'];
			$Card_Vintage = $_REQUEST['Card_Vintage'];
			$Day=$_REQUEST['day'];
			$Month=$_REQUEST['month'];
			$Year=$_REQUEST['year'];
			$DOB=$Year."-".$Month."-".$Day;
			$Pincode = $_REQUEST['Pincode'];
			$Company_Name = $_REQUEST['Company_Name'];
			$Employment_Status = $_REQUEST['Employment_Status'];
			$City_Other = $_REQUEST['City_Other'];
			$Document_proof_doc=implode(",",$Document_proof);
			$reference_code=$_SESSION['cap_code'];
			$is_permit = $_REQUEST['is_permit'];
			$LoanAny = $_REQUEST['LoanAny'];
				$Pincode = $_REQUEST['Pincode'];
			$DOB = $_REQUEST['DOB'];
			$CC_Holder = $_REQUEST['CC_Holder'];
			$Card_Vintage = $_REQUEST['Card_Vintage'];
			
			
		if($_POST['captcha'] == $_SESSION['cap_code'])
		{
			$Is_Valid=1;
		}
		else
		{
			$Is_Valid=0;
		}
	
	
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
			
			$crap = $Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
	if($leadid>0)
				{														
				
	$DataArray = array("Is_Permit"=>$is_permit, "Reference_Code"=>$reference_code, "Company_Type"=>$Company_Type, "PL_EMI_Amt"=>$PL_EMI_Amt, "Primary_Acc"=>$Primary_Acc, "Residential_Status"=>$Residential_Status, "Card_Limit"=>$Credit_Limit, "Years_In_Company"=>$Years_In_Company, "Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A, "identification_proof"=>$Document_proof_doc, "Is_Valid"=>$Is_Valid, "Bidderid_Details"=>$strFinal_Bid, "Allocated"=>$Allocated, "Salary_Drawn"=>$Salary_Drawn, "Direct_Allocation=1, HL_Bank"=>$Activation_Code, "DOB"=>$DOB, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "Pincode"=>$Pincode);
		$wherecondition ="RequestID=".$leadid;
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
				
					}
		
	}//$_POST
	
	header('Location: http://www.loansninsurances.com/get-personalloanthanks.php');
	exit();
?>