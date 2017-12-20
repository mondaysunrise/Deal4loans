<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
//require 'scripts/functionshttps.php';
require 'getlistofeligiblebidders.php';
require 'scripts/personal_loan_eligibility_function_form.php';

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

function checkAgeTenure($customerAge,$tenureYear){

	if($customerAge>=60){
	
		$result = "You are not eligible for Personal loan.";
		exit;
	}else{
		
		if($tenureYear>(60-$customerAge))
		{
			$result = $customerAge;
		}
		elseif($tenureYear<(60-$customerAge))
		{
			$result = 60-$tenureYear;
		}
		else{
			$result = "Sorry!!!<br> You are not eligible for this tenure, please select less tenure.";
			exit;
		}
	}
	return($result);
}
$loan_amount = $_REQUEST['loan_amount'];
$tenure = $_REQUEST['tenure'];
$emp_status = $_REQUEST['emp_status'];
$dob_month_sal = $_REQUEST['dob_month_sal'];
$dob_year_sal = $_REQUEST['dob_year_sal'];
$Company_Name = $_REQUEST['Company_Name'];
$monthly_income_sal = $_REQUEST['monthly_income_sal'];
$obligation_sal = $_REQUEST['obligation_sal'];
$cc_holder_sal = $_REQUEST['cc_holder_sal'];
$card_vintage_sal = $_REQUEST['Card_Vintage_Sal'];
$dob_month_SE = $_REQUEST['dob_month_SE'];
$dob_year_SE = $_REQUEST['dob_year_SE'];
$itr_paid_SE = $_REQUEST['itr_paid_SE'];
$obligation_SE = $_REQUEST['obligation_SE'];
$cc_holder_SE = $_REQUEST['cc_holder_SE'];
$card_vintage_SE = $_REQUEST['Card_Vintage_SE'];
$Interest_Rate_Emi = $_REQUEST['Interest_Rate_Emi'];
$full_name_emi = $_REQUEST['full_name_emi'];
$mobile_emi = $_REQUEST['mobile_emi'];
$email_emi = $_REQUEST['email_emi'];
$city_emi = $_REQUEST['city_emi'];
$source = $_REQUEST['source'];

$loanAmountEmi = FixString($loan_amount);
$bankNameEmi = FixString($showBank['bank_name']);
$knowInterestRate = FixString($know_interest_rate);
$empStatus = FixString($emp_status);

if($emp_status=='Salaried'){

	$emp_status = 1;
	$dob_month = FixString($dob_month_sal);
	$dob_year = FixString($dob_year_sal);
	$company_name = FixString($Company_Name);
	$monthly_income = FixString($monthly_income_sal);
	$annual_income = ($monthly_income * 12);
	$obligation = FixString($obligation_sal);
	$cc_holder = FixString($cc_holder_sal);
	$Card_Vintage = $card_vintage_sal;	
}
if($emp_status=='Self-Employed'){
	
	$emp_status = 0;
	$dob_month = FixString($dob_month_SE);
	$dob_year = FixString($dob_year_SE);
	$itr_paid_SE = FixString($itr_paid_SE);
	$annual_income = $itr_paid_SE;
	$obligation = FixString($obligation_SE);
	$cc_holder = FixString($cc_holder_SE);
	$Card_Vintage = $card_vintage_SE;
}
$day = date('d');
$DOB = $dob_year."-".$dob_month."-".$day;
$loanTenure = FixString($tenure);
$Name = FixString($full_name_emi);
$Phone = FixString($mobile_emi);
$Email = FixString($email_emi);
$City = FixString($city_emi);

$IP = getenv("REMOTE_ADDR");
$IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];

$Type_Loan="Req_Loan_Personal";

if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1)
{
	$validname=0;
}
else
{
	$validname=1;
}

$crap = " ".$Name." ".$Email;
$crapValue = validateValues($crap);
$_SESSION['crapValue'] = $crapValue;
$validMobile = is_numeric($Phone);
$validYear  = is_numeric($Year);
$validMonth = is_numeric($Month);
$validDay = is_numeric($Day);

if(($validMobile==1) && ($Name!="") && strlen($City)>0 && $validname==1)
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210,9810395952) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."' and source not in('PL-EMI-Ccalc-Jan2015','PL main page')) order by RequestID DESC ";
	//echo $getdetails."<br>";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
			
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$emp_status, 'Company_Name'=>$company_name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$annual_income, 'Loan_Amount'=>$loanAmountEmi, 'DOB'=>$DOB, 'CC_Holder'=>$cc_holder, 'Card_Vintage'=>$Card_Vintage, 'Dated'=>$Dated,'Updated_Date'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Years_In_Company'=>'1', 'Total_Experience'=>'3');
		
		$leadid = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
		$_SESSION['leadid'] = $leadid;
	}
}

/*************** Code to get eligible bidders and bank interest rate ****************/
$leadid = $_SESSION['leadid'];
$getPlDetailsSql = "select Employment_Status,Mobile_Number,Email,City_Other,City,Company_Name,Name,Net_Salary,DOB,PL_EMI_Amt, Primary_Acc,identification_proof,Company_Type, Loan_Amount, Primary_Acc From Req_Loan_Personal Where (RequestID='".$leadid."')";
list($alreadyExist1,$plrow)=MainselectfuncNew($getPlDetailsSql,$array = array());
$plrowcontr=count($plrow)-1;

$getCompany_Name = $plrow[$plrowcontr]['Company_Name'];
$City = $plrow[$plrowcontr]['City'];
$Name = $plrow[$plrowcontr]['Name'];
$DOB = $plrow[$plrowcontr]['DOB'];
$Mobile_Number = $plrow[$plrowcontr]['Mobile_Number'];
$Email = $plrow[$plrowcontr]['Email'];
$PL_EMI_Amt = $plrow[$plrowcontr]['PL_EMI_Amt'];
$Primary_Acc = $plrow[$plrowcontr]['Primary_Acc'];
$Net_Salary = $plrow[$plrowcontr]['Net_Salary'];
$Other_City = $plrow[$plrowcontr]['City_Other'];	
$Company_Type = $plrow[$plrowcontr]['Company_Type'];
$Primary_Acc = $plrow[$plrowcontr]['Primary_Acc'];
$Loan_Amount = $plrow[$plrowcontr]['Loan_Amount'];
$Employment_Status = $plrow[$plrowcontr]['Employment_Status'];		
$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);

$tenureYear = round($loanTenure/12);
$customerAge = $age;
$age = checkAgeTenure($customerAge,$tenureYear);

$full_name = $Name;
$monthsalary = $Net_Salary/12;

if($leadid>0)
{
	$getcompany='select * from pl_company_list where company_name="'.$getCompany_Name.'"';
	//echo $getcompany."<br>";
	list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
	$growcontr=count($grow)-1;

	
	$hdfccategory= $grow[$growcontr]["hdfc_bank"];
	$fullertoncategory= $grow[$growcontr]["fullerton"];
	$citicategory= $grow[$growcontr]["citibank"];
	$stanccategory = $grow[$growcontr]["standard_chartered"];
	$hdbfscategory = $grow[$growcontr]["hdbfs"]; 
	$ingvyasyacategory = $grow[$growcontr]["ingvyasya"]; 
	$bajajfinservcategory = $grow[$growcontr]["bajajfinserv"]; 
	$icici_bankcategory = $grow[$growcontr]["icici_bank"]; 
	$Indusind = $grow[$growcontr]["Indusind"]; 
	$kotakcomp = $grow[$growcontr]["kotak"];
	
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

	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
		$Final_Bid[]= $val; 
	}	
	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);
	
	if(count($FinalBidder)>0)
	{
		for($i=0;$i<count($Final_Bid);$i++)
		{
			if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 || ($Final_Bid[$i]=="CitiBank")) && ($citicategory=='' && $Primary_Acc!="Citibank"))
			{
			}
			else if(((strncmp ("HDBFS", $Final_Bid[$i],5))==0 || ($Final_Bid[$i]=="HDBFS")) && ($hdbfscategory==''))
			{
			}
			else if(((strncmp ("IngVysya", $Final_Bid[$i],8))==0 || ($Final_Bid[$i]=="IngVysya")) && (($ingvyasyacategory=='') && ($Company_Type < 4)))
			{
			}
			else if(((strncmp ("INDUS", $Final_Bid[$i],5))==0 || ($Final_Bid[$i]=="INDUS IND bank")) && (($Indusind=='') && $Net_Salary<480000))
			{
			}
			else if(((strncmp ("Bajaj", $Final_Bid[$i],5))==0 || ($Final_Bid[$i]=="Bajaj Finserv")) && (($bajajfinservcategory=='') && $Net_Salary<900000))
			{
			}
			else if(((strncmp ("Kotak", $Final_Bid[$i],5))==0 || ($Final_Bid[$i]=="Kotak Bank")) && (($kotakcomp=='') && $Net_Salary<480000))
			{
			}
			else
			{ 
				$shownToBidders_Arr[] = $Final_Bid[$i];
			}
		}
		//print_r($shownToBidders_Arr);
		echo '<table width="100%" border="0" cellspacing="0" bgcolor="#dedede" cellpadding="0" style=" max-width:919px;">';
		echo '<tr><td scope="row"><table width="100%" border="0" cellspacing="1" cellpadding="2">';
		echo '<tr>
				<td height="41" align="center" bgcolor="#6dcb61" class="pl-tble-td-text" scope="row"><strong>Bank Name</strong></td>
				<td height="41" align="center" bgcolor="#6dcb61" class="pl-tble-td-text" scope="row"><strong>Interest Rate</strong></td>
				<td height="41" align="center" bgcolor="#6dcb61" class="pl-tble-td-text" scope="row"><strong>EMI Per Month</strong></td>
				<td height="41" align="center" bgcolor="#6dcb61" class="pl-tble-td-text" scope="row"><strong>Tenure (in Years)</strong></td>
				<td height="41" align="center" bgcolor="#6dcb61" class="pl-tble-td-text" scope="row"><strong>Eligible Loan Amount</strong></td>
				<td height="41" align="center" bgcolor="#6dcb61" class="pl-tble-td-text" scope="row"><strong>Pre-Payment Charges</strong></td>
				<td height="41" align="center" bgcolor="#6dcb61" class="pl-tble-td-text" scope="row"><strong>Processing Fees</strong></td>
			  </tr>';
		for($r=0;$r<=count($shownToBidders_Arr);$r++)
		{
			//HDFC Bank
			if(($shownToBidders_Arr[$r]=="HDFC Bank") || ($shownToBidders_Arr[$r]=="HDFC") && $Employment_Status==1)
			{
				list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi,$hdfcprocfee)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);
				if($hdfcgetloanamout>0)
				{
					echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>HDFC</strong></td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$hdfcinterestrate.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$hdfcgetemicalc.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$hdfcterm.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$hdfcgetloanamout.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$hdfcprocfee.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">4%</td></tr>';
				}
			}
			//ICICI Bank
			elseif((($shownToBidders_Arr[$r]=="ICICI") || ($shownToBidders_Arr[$r]=="ICICI Bank")) && $Employment_Status==1)
			{
				list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi,$iciciprocfee)=icicibank($monthsalary,$getCompany_Name,$icici_bankcategory,$age,$Company_Type,$Primary_Acc);
				if($icicigetloanamout>0)
				{
					echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>ICICI</strong></td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$iciciinterestrate.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$icicigetemicalc.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$iciciterm.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$icicigetloanamout.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$iciciprocfee.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">5%</td></tr>';
				}
			}
			//Standard Chartered
			elseif((($shownToBidders_Arr[$r]=="Stanc") || ($shownToBidders_Arr[$r]=="Standard Chartered")) && $Employment_Status==1)
			{
				list($stancinterestrate,$stancgetloanamout,$stancgetemicalc,$stancterm,$stancperfee,$stancprocfee)=Stanc($monthsalary,$PL_EMI_Amt,$getCompany_Name,$stanccategory,$age,$Company_Type,$Primary_Acc);
				if($stancgetloanamout>0)
				{
				echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>Standard Chartered</strong></td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$stancinterestrate.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$stancgetemicalc.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$stancterm.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$stancgetloanamout.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$stancprocfee.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">5%</td></tr>';
				}
			}
			elseif($shownToBidders_Arr[$r]=="Bajaj Finserv" && $Employment_Status==1)
			{ 
				echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>Bajaj Finserv</strong></td><td height="30" colspan="6" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><ul style="text-align:left;"><li>0% Prepayment Charges (After 1st EMI)</li><li>Part Pre-payment (After 1st EMI)</li> <li>Loan Amount - Upto 18 Lacs</li>	<li>Step Down Interest Rate</li><li>Flexi Loans</li></ul></td></tr>';
			}
			//CItibank
			elseif((($shownToBidders_Arr[$r]=="Citibank") || ($shownToBidders_Arr[$r]=="CitiBank")) && $Employment_Status==1)
			{
				list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlac,$citiproc_Fee)=citibank($monthsalary,$clubbed_emi,$getCompany_Name,$age,$citicategory);
				if($citigetloanamout>0)
				{
					echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>Citi Bank</strong></td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$citiinterestrate.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$citigetemicalc.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$cititerm.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$citigetloanamout.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$citiproc_Fee.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">1%</td></tr>';
				}
			}
			//INdusInd Bank
			elseif((($shownToBidders_Arr[$r]=="INDUS IND bank") || ($shownToBidders_Arr[$r]=="INDUS IND bank")) && $Employment_Status==1)
			{
				list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi)=@indusindbank($monthsalary,$getCompany_Name,$Indusind,$age,$clubbed_emi);
				if($indusindloanamt>0)
				{
					echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>IndusInd Bank</strong></td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$indusindrate.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$indusindemi.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$indusindterm.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$indusindloanamt.'</td> <td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">1% - 2%</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">4%</td></tr>';
				}
			}
			//Fullerton
			elseif(((strncmp ("Fullerton", $shownToBidders_Arr[$r],9))==0 || ($shownToBidders_Arr[$r]=="Fullerton")) && $Employment_Status==1)
			{
				list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
				if($fullertongetloanamout>0)
				{
					echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>Fullerton Bank</strong></td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$fullertoninterestrate.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$fullertongetemicalc.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$fullertonterm.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$fullertongetloanamout.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"> 4% before 3yr after 3yr 0% </td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">2 - 2.5%</td></tr>';	
				}
			}
			//Kotak Bank
			elseif($shownToBidders_Arr[$r]=="Kotak" || $shownToBidders_Arr[$r]=="Kotak Bank" && $Employment_Status==1)
			{
				list($kotakrate,$kotakloanamt,$kotakemi,$kotakterm,$kotakperlacemi)=kotakbank($monthsalary,$getCompany_Name,$kotakcomp,$age,$Company_Type,$Primary_Acc);
				//echo $monthsalary." - ".$getCompany_Name." - ".$kotakcomp." - ".$age." - ".$Company_Type." - ".$Primary_Acc;
				if(strlen($kotakloanamt)>1)
				{
					echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>Kotak</strong></td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$kotakrate.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$kotakemi.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$kotakterm.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$kotakloanamt.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"> 1.50% - 2% </td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">5%</td></tr>';
				}
			}
			//HDBFS
			elseif($shownToBidders_Arr[$r]=="HDBFS" && $Employment_Status==1)
			{
				list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans ($hdbfscategory, $monthsalary, $Primary_Acc,$age,$PL_EMI_Amt,$Loan_Amount);
				if($getloanamout>0)
				{
					echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>HDBFS</strong></td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$interestrate.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$getemicalc.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$term.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$getloanamout.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$Processing_Fee.' </td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"></td></tr>';	
				}
			}
			//ING vysya
			elseif(($shownToBidders_Arr[$r]=="IngVysya" || $shownToBidders_Arr[$r]=="ING Vysya") && $Employment_Status==1)
			{	
				if($Primary_Acc=="IngVysya"){$account_holder = 1;}
				list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans_nw ($ingvyasyacategory, $monthsalary, $account_holder,$age,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name,$Company_Type);
				if($getloanamout>0)
				{
					echo '<tr><td height="30" align="left" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row"><strong>ING Vysya</strong></td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$interestrate.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$getemicalc.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$term.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">Rs.'.$getloanamout.'</td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">'.$Processing_Fee.' </td><td height="30" align="center" bgcolor="#FFFFFF" class="pl-tble-td-body-text" scope="row">0%</td></tr>';	
				}		
			}
		}
		echo '</table></td></tr></table>';
	}	
	else
	{ 
		echo '<table width="100%" border="0" cellspacing="0" bgcolor="#dedede" cellpadding="0" style=" max-width:919px;"><tr><td scope="row"><table width="100%" border="0" cellspacing="1" cellpadding="2"><tr>';
		echo '<td height="41" align="center" bgcolor="#6dcb61" class="pl-tble-td-text" scope="row" colspan="7"> Thank you for visiting deal4loans.com, your application is being processed. Our executive will contact you soon. </td>';
		echo '</tr></table></td></tr></table>';
	}
}
/*******************************/
?>
