<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
			require 'scripts/home_loan_eligibility_function.php';


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


	
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
			$Type_Loan=$_REQUEST['Type_Loan'];
			$ProductValue = $_REQUEST['ProductValue'];	
			$Day=$_REQUEST['day'];
			$Month=$_REQUEST['month'];
			$Year=$_REQUEST['year'];
			$DOB=$Year."-".$Month."-".$Day;
			$Pincode = $_REQUEST['Pincode'];
			$Employment_Status = $_REQUEST['Employment_Status'];
			$Company_Name = $_REQUEST['Company_Name'];
			$Property_Identified = $_REQUEST['Property_Identified'];
			$Property_Loc = $_REQUEST['Property_Loc'];
			$Loan_Time = $_REQUEST['Loan_Time'];
			$Phone = $_REQUEST['Phone'];
			$City = $_REQUEST['City'];
			$Net_Salary = $_REQUEST['Net_Salary'];
			$Net_Salary = $_POST['Net_Salary'];
			$monthly_income = ($Net_Salary /12);
			$obligations = $_POST['obligations'];
			$co_appli = $_POST['co_appli'];
			$co_name = $_POST['co_name'];
			$dob_arr_co[] = $_POST['co_year'];
			$dob_arr_co[] = $_POST['co_month'];
			$dob_arr_co[] = $_POST['co_day'];
			$DOB_co = implode("-", $dob_arr_co);
			$co_monthly_income = $_POST['co_monthly_income'];
			$co_obligations = $_POST['co_obligations'];
			$property_value = $_POST['Property_Value'];
			$getnetAmount = ($monthly_income + $co_monthly_income);
			$total_obligation = $obligations + $co_obligations;
			$netAmount=($getnetAmount - $total_obligation);
			$currentyear=date('Y');
$age=$currentyear-$Year;

$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;
//echo $exactage."<br>";
//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;

				
			$crap = " ".$Property_Identified." ".$Property_Loc." ".$company." ".$City_Other." ".$Primary_Acc." ".$Descr." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
	
				
				if (($Type_Loan=="Req_Loan_Home") || ($product=="HomeLoan"))
					{
					
																
						getEligibleBidders("home","$City","$Mobile");
						
						$dataUpdate = array('Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$total_obligation, 'DOB'=>$DOB, 'Residence_Address'=>$Residence_Address, 'Pincode'=>$Pincode, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Loan_Time'=>$Loan_Time, 'Is_Valid'=>$Is_Valid, 'Budget'=>$budget);
					$wherecondition = "(RequestID=".$ProductValue.")";
					Mainupdatefunc ('Req_Loan_Home', $dataUpdate, $wherecondition);
				
						if($Net_Salary>=200000)
						{
							$productname = "hlsalaryclause";
						}
						else
						{
						$productname = "HomeLoan";
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
		
	}//$_POST
	$_SESSION['ProductValueHL'] = $ProductValue;	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>HDFC Home Loans | Documents | Eligibility | Rates | Apply | Deal4loans</title>
<meta name="HDFC Home Loan, Apply HDFC Home Loan, HDFC Home Loan Interest Rates, Home Loans, Easy Home Loans, Loans, Documents for hdfc Home Loan">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="HDFC Home Loan: Apply for HDFC housing loan with low EMI, Documents and Interest rates.">
<meta name="description" content="LIC Housing Finance provides you Home Loan. Lic Housing facilitate to finance your dream home by providing home loan at low interest rates. Get Home Loan from LIC at very low interest rates and documents.">
<link href="source.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/sbihl-cont.css" rel="stylesheet" type="text/css" />
<link href="css/styles-home-loan.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
<style type="text/css">
<!--
.style1 {font-family: 'Droid Sans', sans-serif}
.style2 {font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);font-family: 'Droid Sans', sans-serif;}
-->
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="d4l_inner_wrapper">
<div class="text12" style="margin:auto; width:100%px; height:11px; margin-top:70px; margin-left:220px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loan-banks.php"  class="text12" style="color:#4c4c4c;">Compare Home loan Banks</a></u> >  <a href="#"  class="text12" style="color:#4c4c4c;"> HDFC Ltd Home Loan</a></div>
<div style="clear:both;"></div>
<div class="second-step_box"><br /><strong>HDFC Ltd Home Loan</strong></div>

<div style="clear:both; height:5px;"></div>
<div id="txt" style="margin-left:2px;">
<?php 
$newsource="HD SEO 1";
$subjectLine="HDFC Ltd Home Loan";
include "home-loans-widget.php";?>



</div>
<div style="clear:both; height:20px;"></div>
<div><span class="tbl_txt"><strong>Disclaimer :</strong> Please note that the interest rates and eligibility criteria given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.</span></div></div></div>
<div style="clear:both; height:20px;"></div>
<?php include "footer_sub_menu.php"; ?></div>
</body>
</html>