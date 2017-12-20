<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';

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
		
			//exit();
			if($crapValue=="Put")
			{
	
	
	if($leadid>0)
				{														
					$dataUpdate = array('Is_Permit'=>$is_permit,  'Reference_Code'=>$reference_code,  'Company_Type'=>$Company_Type,  'PL_EMI_Amt'=>$PL_EMI_Amt,  'Primary_Acc'=>$Primary_Acc,  'Residential_Status'=>$Residential_Status,  'Card_Limit'=>$Credit_Limit,  'Years_In_Company'=>$Years_In_Company,  'Total_Experience'=>$Total_Experience,  'EMI_Paid'=>$EMI_Paid,  'Loan_Any'=>$Loan_A,  'identification_proof'=>$Document_proof_doc,  'Is_Valid'=>$Is_Valid,  'Bidderid_Details'=>$strFinal_Bid,  'Allocated'=>$Allocated,  'Salary_Drawn'=>$Salary_Drawn,  'Direct_Allocation=1,HL_Bank'=>$Activation_Code,  'DOB'=>$DOB,  'CC_Holder'=>$CC_Holder,  'Card_Vintage'=>$Card_Vintage,  'Pincode'=>$Pincode);
					$wherecondition = "(RequestID=".$leadid.")";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);

					
					}

				
			}//$crap Check
		else if($crapValue=='Discard')
		{
		//	header("Location: Redirect.php");
			//exit();
		}
		else
		{
			//header("Location: Redirect.php");
			//exit();
		}

		$getpldetails=("select Email,City_Other,City,Company_Name,Name,Net_Salary,DOB,Reference_Code From Req_Loan_Personal Where (RequestID='".$leadid."')");
		list($alreadyExist,$myrow)=Mainselectfunc($getpldetails,$array = array());
$getCompany_Name = $plrow['Company_Name'];
$City = $plrow['City'];
$Name = $plrow['Name'];
$DOB = $plrow['DOB'];
$Net_Salary = $plrow['Net_Salary'];
$Other_City = $plrow['City_Other'];	
$Email = $plrow['Email'];
$Reference_Code = $plrow['Reference_Code'];

$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);

$monthsalary =$Net_Salary/12;


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
	
	if($strCity=="Delhi" || $strCity=="Mumbai" || $strCity=="Chennai" || $strCity=="Kolkata" || $strCity=="Bangalore" || $strCity=="Hyderabad" || $strCity=="Pune" || $strCity=="Noida" || $strCity=="Gurgaon" || $strCity=="Gaziabad" || $strCity=="Faridabad" || $strCity=="Thane" || $strCity=="Navi Mumbai")
		{
			if($CC_Holder==1 || $is_permit==1 || ($LoanAny==1 && $EMI_Paid>0))
			{
				$permited=1;
			}
				else
			{
				$permited=0;
			}
		}
		else
		{
			$permited=1;
		}
		
	}//$_POST
	
	
	

?>


<?php 
//After HTMl

if($Is_Valid==1)
{
	//echo "entered";
	//	echo "<br>";
	//echo 	$leadid."--".$strCity;
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
	$arrFinal_Bid = "";
	while (list ($key,$val) = @each($FinalBidder)) 
	{ 
		$arrFinal_Bid[]= $val; 
	} 
	
	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) 
	{ 
		$Final_Bid[]= $val; 
	} 
	
	$strFinal_Bid=implode(',',$arrFinal_Bid);
	
	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);
	
	if($leadid>0 && (strlen($strFinal_Bid)>0) && (($Salary_Drawn==2) || ($Salary_Drawn==3)) && $permited==1 )
	{
		
		$arrfinal_bidders="";
		$getbankid="";
		for($i=0;$i<count($arrFinal_Bid);$i++)
		{	
			if(((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton")) && ($Residential_Status==1 || $Residential_Status==3 || $Residential_Status==4 || $Residential_Status==5) && $permited==1)
			{
				$arrfinal_bidders[]=$arrFinal_Bid[$i];
				$getbankid[]=$Final_Bid[$i];
			}
			else if(((strncmp ("Citifinancial", $Final_Bid[$i],12))==0 || ($Final_Bid[$i]=="Citifinancial")))
			{
				$arrfinal_bidders[]=$arrFinal_Bid[$i];
				$getbankid[]=$Final_Bid[$i];
			}
		}
		
		$getarrfinal_bidders=implode(',',$arrfinal_bidders);
		
		if(strlen($getarrfinal_bidders)>0)
		{
			$Allocated=2;
		}
		else 
		{
			$Allocated=0;
		}
		
		if(strlen($getarrfinal_bidders)>1)
		{
			$dataUpdate = array('Bidderid_Details'=>$getarrfinal_bidders,  'Allocated'=>$Allocated);
			$wherecondition = "(RequestID=".$leadid.")";
			Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
		}
	}
}


if ($leadid>0 && $Is_Valid==1 && (($Salary_Drawn==2) || ($Salary_Drawn==3)) && $permited==1)
{
	$getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$getCompany_Name.'"';
	list($alreadyExist,$grow)=Mainselectfunc($getcompany,$array = array());
	$grow=mysql_fetch_array($getcompanyresult);
	$recordcount = mysql_num_rows($getcompanyresult);
	$hdfccategory= $grow["hdfc_bank"];
	$fullertoncategory= $grow["fullerton"];
	$citicategory= $grow["citibank"];
	$barclayscategory= $grow["barclays"];
	$stanccategory = $grow["standard_chartered"];
	
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

	if(count($FinalBidder)>0 && (strlen($strFinal_Bid)>1))
	{
		if(count($FinalBidder)>0)
		{
			$shownToBidders_Str = implode(",",$shownToBidders_Arr);
			$dataUpdate = array('checked_bidders'=>$shownToBidders_Str);
			$wherecondition = "(RequestID=".$leadid.")";
			Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
		}
	}	 
}
	header('Location: http://www.bestloansdeal.com/get-personalloanthanks.php');
	exit();
?>