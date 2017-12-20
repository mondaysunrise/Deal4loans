<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
//	print_r($_REQUEST);
	
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
			
			$_SESSION['leadid'] = $leadid;
			
			$PL_EMI_Amt = FixString($_REQUEST['PL_EMI_Amt']);
			$Company_Type = FixString($_REQUEST['Company_Type']);
			$Residential_Status = FixString($_REQUEST['Residential_Status']);
			$Primary_Acc= FixString($_REQUEST['Primary_Acc']);
			$Loan_A = FixString($_REQUEST['Loan_Any']);
			$EMI_Paid = FixString($_REQUEST['EMI_Paid']);
			$Credit_Limit = FixString($_REQUEST['Credit_Limit']);
			$Total_Experience = FixString($_REQUEST['Total_Experience']);
			$Years_In_Company = FixString($_REQUEST['Years_In_Company']);
			$Document_proof=FixString($_REQUEST['Document_proof']);
			$Document_proof_doc=implode(",",$Document_proof);
			
			$Pincode = FixString($_REQUEST['Pincode']);
			$DOB = FixString($_REQUEST['DOB']);
			$CC_Holder = FixString($_REQUEST['CC_Holder']);
			$Card_Vintage = FixString($_REQUEST['Card_Vintage']);
			
			
	 $getpldetails="select City_Other,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
		list($checkNum,$plrow)=MainselectfuncNew($getpldetails,$array = array());
		$countr =count($plrow)-1;
$getCompany_Name = $plrow[$countr]['Company_Name'];
$City = $plrow[$countr]['City'];
$Name = $plrow[$countr]['Name'];
//$DOB = $plrow['DOB'];
$Net_Salary = $plrow[$countr]['Net_Salary'];
$Other_City = $plrow[$countr]['City_Other'];	

$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
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
	
				
			$crap = $City_Other." ".$Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
	
	
	if($leadid>0)
				{	$dataUpdate = array('Company_Type'=>$Company_Type, 'PL_EMI_Amt'=>$PL_EMI_Amt, 'Primary_Acc'=>$Primary_Acc, 'Residential_Status'=>$Residential_Status, 'Card_Limit'=>$Credit_Limit, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_A, 'identification_proof'=>$Document_proof_doc, 'DOB'=>$DOB, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'Pincode'=>$Pincode);
				$wherecondition = "(RequestID=".$leadid.")";
				Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);

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
		
	}//$_POST

	header('Location: http://www.bestloansdeal.com/get-personalloanthanks.php?'.$request);
	exit();
	
?>
