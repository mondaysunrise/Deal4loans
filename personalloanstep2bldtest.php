<?php
//More than 2.4las
session_start();
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
//	print_r($_REQUEST);

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
$_REQUEST['RequestID'] = 987446;
 $_SESSION['leadid'] = 987446;
	if ($_REQUEST['RequestID']> 0)
	{
		    $leadid = $_REQUEST['RequestID'];

			$_SESSION['leadid'] = $leadid;
			
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_A = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Document_proof=$_REQUEST['Document_proof'];
			$Document_proof_doc=implode(",",$Document_proof);
			
			$Pincode = $_REQUEST['Pincode'];
			$DOB = $_REQUEST['DOB'];
			$CC_Holder = $_REQUEST['CC_Holder'];
			$Card_Vintage = $_REQUEST['Card_Vintage'];
			
			
	
			//$nn = count($Loan_Any);
//			 $ii  = 0;
	//		while ($ii < $nn)
		//	{
			//  $Loan_A .= "$Loan_Any[$ii], ";
//			 $ii++;
	//		 }
		
	$getpldetails=ExecQuery("select City_Other,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')");
	//echo "select Other_City,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
	$plrow = mysql_fetch_array($getpldetails);
$getCompany_Name = $plrow['Company_Name'];
$City = $plrow['City'];
$Name = $plrow['Name'];
//$DOB = $plrow['DOB'];
$Net_Salary = $plrow['Net_Salary'];
$Other_City = $plrow['City_Other'];	

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
				{														
						$qry="Update Req_Loan_Personal SET Company_Type='$Company_Type',PL_EMI_Amt='$PL_EMI_Amt',Primary_Acc='$Primary_Acc', Residential_Status='$Residential_Status' ,Card_Limit= '$Credit_Limit', Years_In_Company='$Years_In_Company', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A',identification_proof='$Document_proof_doc', DOB='".$DOB."', CC_Holder = '".$CC_Holder."', Card_Vintage='".$Card_Vintage."', Pincode='".$Pincode."' Where RequestID=".$leadid;
//					echo $qry;
				//	$result = ExecQuery($qry);
					}
				
			}//$crap Check
				
	}//$_POST
	
	
		$getpldetails=ExecQuery("select Mobile_Number,Email,City_Other,City,Company_Name,Name,Net_Salary,DOB,PL_EMI_Amt, Primary_Acc,identification_proof,Company_Type,Loan_Amount,Primary_Acc From Req_Loan_Personal Where (RequestID='".$leadid."')");
	//echo "select Other_City,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
	$plrow = mysql_fetch_array($getpldetails);
	$getCompany_Name = $plrow['Company_Name'];
	$City = $plrow['City'];
	$Name = $plrow['Name'];
	$DOB = $plrow['DOB'];
	$Mobile_Number = $plrow['Mobile_Number'];
		$Email = $plrow['Email'];
	$PL_EMI_Amt = $plrow['PL_EMI_Amt'];
	$Primary_Acc = $plrow['Primary_Acc'];
	$Net_Salary = $plrow['Net_Salary'];
	$Other_City = $plrow['City_Other'];	
	$Company_Type = $plrow['Company_Type'];
	$Primary_Acc = $plrow['Primary_Acc'];
	$Loan_Amount = $plrow['Loan_Amount'];
		
	$Document_proof_doc = $plrow['identification_proof'];
	$Document_proof = explode(",",$Document_proof_doc);
	$getDOB = str_replace("-","", $DOB);
	$age = DetermineAgeGETDOB($getDOB);
	//echo $age."<br>";
$full_name = $Name;
		
	$monthsalary =$Net_Salary/12;
	
	
 $getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered,hdbfs,ingvyasya,bajajfinserv,icici_bank from pl_company_list where company_name="'.$getCompany_Name.'"';
 //echo $getcompany;
$getcompanyresult = ExecQuery($getcompany);
$grow=mysql_fetch_array($getcompanyresult);
$recordcount = mysql_num_rows($getcompanyresult);
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$citicategory= $grow["citibank"];
$barclayscategory= $grow["barclays"];
$stanccategory = $grow["standard_chartered"];
$hdbfscategory = $grow["hdbfs"]; 
$ingvyasyacategory = $grow["ingvyasya"]; 
$bajajfinservcategory = $grow["bajajfinserv"]; 
$icici_bankcategory = $grow["icici_bank"]; 

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

//echo $leadid."<br>".$strCity."<br>";
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
	$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);
	$real_bankID = explode(',',$realbankiD);
	//print_r($realbankiD);



if(count($FinalBidder)>0)
{
	$getrespf="";
	$getrespf="";
	$getidpf="";
	$actual_ident_proof="";
	$actual_residence_proof="";
	$actual_income_proof="";
	$getinpf="";
	$getdocpf="";
	$bld_final_bank = '';
	$bld_final_interest = '';
	$bld_final_Emi = '';
	$bld_final_Tenure = '';
	$bld_final_loan = '';
	$bld_final_err = '';

	for($i=0;$i<count($Final_Bid);$i++)
	{
		if(((strncmp ("Standard", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Standard Chartered")) && $stanccategory=='' && $monthsalary<50000)
		{
		
		}
		else if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Citibank")) && $citicategory=='')
		{
		
		}
		else if(((strncmp ("IngVysya", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="IngVysya")) && (($ingvyasyacategory=='') && ($Company_Type < 4 )))
		{
		
		}
		else
		{ 
			$bld_final_bank[] = $real_bankID[$i];

			if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
			{
				list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);
				
				if($hdfcgetloanamout>0)
				{
				
					$bld_final_interest[] = trim(str_replace("%", "", $hdfcinterestrate));
					$bld_final_Emi[] = trim(str_replace("%", "", $hdfcgetemicalc));
					$bld_final_Tenure[] = trim($hdfcterm);
					$bld_final_loan[] = trim($hdfcgetloanamout);
					$bld_final_err[] = trim(0) ;
				}
				else
				{
					$bld_final_interest[] = trim('');
					$bld_final_Emi[] = trim('');
					$bld_final_Tenure[] = trim('');
					$bld_final_loan[] = trim('');
					$bld_final_err[] = trim(1);  
				}
			}
			else if((($Final_Bid[$i]=="ICICI") || ($Final_Bid[$i]=="ICICI Bank")) && $monthsalary>=30000)
			{
				list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicibank($monthsalary,$getCompany_Name,$icici_bankcategory,$age,$Company_Type,$Primary_Acc);
				
				if($icicigetloanamout>0)
				{
					$bld_final_interest[] = str_replace("%", "", $iciciinterestrate);
					$bld_final_Emi[] = str_replace("%", "", $icicigetemicalc);
					$bld_final_Tenure[] = $iciciterm;
					$bld_final_loan[] = $icicigetloanamout;
					$bld_final_err[] = 0 ;
				}
				else
				{
					$bld_final_interest[] = trim('');
					$bld_final_Emi[] = trim('');
					$bld_final_Tenure[] = trim('');
					$bld_final_loan[] = trim('');
					$bld_final_err[] = trim(1);  
				}
			}
			elseif((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
			{
				list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
				if($fullertongetloanamout>0)
				{
					$bld_final_interest[] = str_replace("%", "", $fullertoninterestrate);
					$bld_final_Emi[] = str_replace("%", "", $fullertongetemicalc);
					$bld_final_Tenure[] = $fullertonterm;
					$bld_final_loan[] = $fullertongetloanamout;
					$bld_final_err[] = 0 ;
				}
				else
				{	
					$bld_final_interest[] = trim('');
					$bld_final_Emi[] = trim('');
					$bld_final_Tenure[] = trim('');
					$bld_final_loan[] = trim('');
					$bld_final_err[] = trim(1);  
				}
			}
			elseif($Final_Bid[$i]=="Kotak")
			{
				$bld_final_err[] = 1; 
			}
			elseif($Final_Bid[$i]=="Barclays")
			{
				list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm,$barclayperlacemi)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
				if($barclaygetloanamout>0)
				{
					$bld_final_interest[] = trim(str_replace("%", "", $barclayinterestrate));
					$bld_final_Emi[] = trim(str_replace("%", "", $barclaygetemicalc));
					$bld_final_Tenure[] = trim($barclayterm);
					$bld_final_loan[] = trim($barclaygetloanamout);
					$bld_final_err[] = trim(0) ;
				}
				else
				{	
					$bld_final_interest[] = trim('');
					$bld_final_Emi[] = trim('');
					$bld_final_Tenure[] = trim('');
					$bld_final_loan[] = trim('');
					$bld_final_err[] = trim(1);  
				}
			}
			elseif($Final_Bid[$i]=="HDBFS")
			{
				list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans ($hdbfscategory, $monthsalary, $Primary_Acc,$age,$PL_EMI_Amt,$Loan_Amount);
				
				if($getloanamout>0)
				{
					$bld_final_interest[] = trim(str_replace("%", "", $interestrate));
					$bld_final_Emi[] = trim(str_replace("%", "", $getemicalc));
					$bld_final_Tenure[] = trim($term);
					$bld_final_loan[] = trim($getloanamout);
					$bld_final_err[] = trim(0) ;
				}
				else
				{	
					$bld_final_interest[] = trim('');
					$bld_final_Emi[] = trim('');
					$bld_final_Tenure[] = trim('');
					$bld_final_loan[] = trim('');
					$bld_final_err[] = trim(1);  
									}
			}
			elseif($Final_Bid[$i]=="IngVysya")
			{
				if($Primary_Acc=="IngVysya")
				{
					$account_holder = 1;
				}
				list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans_nw ($ingvyasyacategory, $monthsalary, $account_holder,$age,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name,$Company_Type);
								
				if($getloanamout>0)
				{
					$bld_final_interest[] = trim(str_replace("%", "", $interestrate));
					$bld_final_Emi[] = trim(str_replace("%", "", $getemicalc));
					$bld_final_Tenure[] = trim($term);
					$bld_final_loan[] = trim($getloanamout);
					$bld_final_err[] = trim(0) ;
				}	
				else
				{	
					$bld_final_interest[] = trim('');
					$bld_final_Emi[] = trim('');
					$bld_final_Tenure[] = trim('');
					$bld_final_loan[] = trim('');
					$bld_final_err[] = trim(1);  				}
			}
			else if($Final_Bid[$i]=="Bajaj Finserv")
			{
					$bld_final_interest[] = trim('');
					$bld_final_Emi[] = trim('');
					$bld_final_Tenure[] = trim('');
					$bld_final_loan[] = trim('');
					$bld_final_err[] = trim(1);  
			?>
		<!--	<td colspan="4" class="i-rate"><ul style="text-align:left;"><li>0% Pre-payment Charges</li><li>
			Part-Prepayment</li><li>Loan Amount - Upto 25 Lacs</li></ul></td>
		 -->	
			<?php	
			}
			else
			{
				$bld_final_interest[] = trim('');
				$bld_final_Emi[] = trim('');
				$bld_final_Tenure[] = trim('');
				$bld_final_loan[] = trim('');
				$bld_final_err[] = trim(1);  
			}
		
		}
	} 
	
	//echo "<br><br>";
	
	$final_arr = array($bld_final_bank, $bld_final_interest, $bld_final_Emi, $bld_final_Tenure, $bld_final_loan, $bld_final_err);
/*
	print_r($bld_final_bank);
	echo "<br>";
	print_r($bld_final_interest);
	echo "<br>";	
	print_r($bld_final_Emi);
	echo "<br>";	
	print_r($bld_final_Tenure);
	echo "<br>";	
	print_r($bld_final_loan);
	echo "<br>";	
	print_r($bld_final_err);
*/	
	$bld_final_bank_str = implode(',', $bld_final_bank);
	$bld_final_interest_str = implode(',', $bld_final_interest);
	$bld_final_Emi_str = implode(',', $bld_final_Emi);
	$bld_final_Tenure_str = implode(',', $bld_final_Tenure);
	$bld_final_loan_str = implode(',', $bld_final_loan);
	$bld_final_err_str = implode(',', $bld_final_err);
	
	$param["bank"] = $bld_final_bank_str;
	$param["interest"] = $bld_final_interest_str;
	$param["Emi"] = $bld_final_Emi_str;
	$param["Tenure"] = $bld_final_Tenure_str;
	$param["loan"] = $bld_final_loan_str;
	$param["err"] = $bld_final_err_str;

		$request = '';
		foreach($param as $key=>$val)
		{
		  $request.= $key."=".urlencode($val);
		  $request.= "&";
		}
		$request = substr($request, 0, strlen($request)-1);
	?>
    
    <a target="_blank" href="http://www.bestloansdeal.com/personalloanstep2bldtest.php?<?php echo $request; ?>">Thank You Bestloansdeal</a>
    
    <br /> <br />
    
    <a href="apply_personal_loan_step2.php" target="_blank">Thank You Deal4loans</a>
    
	<?php
}
else
{ ?>
<p><strong>We are not able to find any bank for you.Please contact your local bank. We will contact you, if we find any offer for you.</strong></p>
<? }
//	header('Location: http://www.bestloansdeal.com/get-personalloanthanks.php');
	//exit();
	
?>
