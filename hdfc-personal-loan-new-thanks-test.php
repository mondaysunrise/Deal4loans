 <?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders_test.php';
	
function DetermineAgeFromDOB ($YYYYMMDD_In)
	{
	  $yIn=substr($YYYYMMDD_In, 0, 4);
	  $mIn=substr($YYYYMMDD_In, 4, 2);
	  $dIn=substr($YYYYMMDD_In, 6, 2);
	  $ddiff = date("d") - $dIn;
	  $mdiff = date("m") - $mIn;
	  $ydiff = date("Y") - $yIn;
	  if ($mdiff < 0)
	  {
		$ydiff--;
	  } elseif ($mdiff==0)
	  {
		if ($ddiff < 0)
		{
		  $ydiff--;
		}
	  }
	  return $ydiff;
	}
	
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$last_inserted_id = $_POST['lead_id'];
	$full_name = $_POST["full_name"];
	$mobile_number = $_POST["Phone"];
	$email_id = $_POST["email_id"];
	$Company_Name = $_POST["Company_Name"];
	$mcity = $_POST["City"];
	$city_other = $_POST["city_other"];
	$company_type = $_POST["company_type"];
	$salary = $_POST["net_salary"];
	$primary_acc = $_POST["primary_acc"];
	$Employment_Status = $_POST["Employment_Status"];
	//$age = $_POST["age"];
	$year = $_POST['year'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	$DOB=$year."-".$month."-".$day;
	$getDOB = $year."".$month."".$day;
	$age = DetermineAgeFromDOB($getDOB);
	$clubbed_emi = $_POST["clubbed_emi"];
	$company_cate_type = $_POST["company_cate_type"];
	$no_of_loans = $_POST["no_of_loans"];
	$availed_loan_amt = $_POST["availed_loan_amt"];
	$hdfc_loan_tenure = $_POST["hdfc_loan_tenure"];
	$hdfc_emi_amt = $_POST["hdfc_emi_amt"];
	$no_emi_paid = $_POST["no_emi_paid"];
	$loan_running = $_POST["loan_running"];
	$residence_status = $_POST["residence_status"];
	$reqd_loan_amt = $_POST["reqd_loan_amt"];
$annual_salary=$salary *12;
	//$Activate = generateNumber(4);
	$app_code = date('dmy')."".$Activate;
if($mcity=="Others" && strlen($city_other)>0)
	{
		$City=$city_other;
	}
	else
	{
		$City=$mcity;
	}
	$net_salary=	$salary;
	//HDFC OUtStanding
$loan_amt_interest= $hdfc_emi_amt * $hdfc_loan_tenure;

$hdfc_total_outstanding= $loan_amt_interest - $availed_loan_amt;

if($hdfc_emi_amt>0)
		{
$clubbed_emi = $clubbed_emi - $hdfc_emi_amt;
		}
//Insert DATA For HDFC PL
$dataUpdateLeads = array('age'=>$age, 'company_name'=>$Company_Name, 'DOB'=>$DOB, 'company_category'=>$company_cate_type, 'company_type'=>$company_type, 'primary_acc'=>$primary_acc, 'no_of_loan_running'=>$no_of_loans, 'clubbed_emi'=>$clubbed_emi, 'availed_loan_amt'=>$availed_loan_amt, 'pl_emi_amt'=>$hdfc_emi_amt, 'pl_tenure'=>$hdfc_loan_tenure, 'pl_no_of_emi'=>$no_emi_paid, 'Employment_Status'=>$Employment_Status, 'residence_status'=>$residence_status);
$wherecondition ="(hdfcplid ='".$last_inserted_id."')";
Mainupdatefunc ('hdfc_pl_calc_leads', $dataUpdateLeads, $wherecondition);

$caqry='Select  hdfc_bank from  pl_company_list where (company_name="'.$Company_Name.'")';
list($carowNum,$carow)=MainselectfuncNew($caqry,$array = array());
$carowcontr=count($carow)-1;

$category = $carow[$carowcontr]["hdfc_bank"];

if($age<21 || $age>59 )
		{
			$Feedback="because of Age issue<br>";
		}
		else if ($city=="Chandigarh" && ($Company_Name=="dell international" || $Company_Name=="DELL INTERNATIONAL SERVICE LIMITED/DELL INTERNATIONAL SERVICES INDIA PVT. LIMITED" || (strncmp ("Dell", $Company_Name,4))==0 || (strncmp ("DELL", $Company_Name,4))==0 || (strncmp ("dell", $Company_Name,4))==0))
	{
		$Feedback="No clause<br>";
	}
		else if ($no_of_loans>3)
		{
			$Feedback="because more than 3 loans r running<br>";
		}
		else if($no_emi_paid<2 && $loan_running==2 && $availed_loan_amt>0)
		{
			$Feedback="because Less EMI paid in HDFC pl<br>";
		}
		else
		{
			if($category=="" && ($company_cate_type==2 || $company_cate_type==3))
			{
				$category="CAT C";
				$virtualcat="CAT C";
			}
			else
			{
				$virtualcat="";
			}
			list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$age,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding,$virtualcat,$Company_Name);
		}
		
	}
	
function getdob($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18))
		{
			$term = 60;
			$print_term = "5";
		}
	else if(($DOB>50 && $DOB<=54))
		{
			$term = 60;
			$print_term = "5";
		}
	else if(($DOB>50 && $DOB<=55))
		{
			$term = 60;
			$print_term = "5";
		}
		
		else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
		}
		else if($DOB>56 && $DOB<=57)
		{
			$term = 36;
			$print_term = "3";
		}
		else if($DOB>57 && $DOB<=58)
		{
			$term = 24;
			$print_term = "2";
		}
		else if($DOB>58 && $DOB<=59)
		{
			$term = 12;
			$print_term = "1";
		}
		else if ($DOB>=60)
	{
		$term = 0;
			$print_term = "0";
	}
		$getterm[]= $term;
		$getterm[]= $print_term;
		return($getterm);
}

Function  HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$DOB,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding,$virtualcat,$Company_Name)
{
	$exactnet_salary= $net_salary;
list($term,$print_term)=getdob($DOB);

	if($company_type=="BPO")
	{	//echo "1<br>";
		if((($category=="Super A" || $category=="CAT A" || $category=="CAT B" || $category=="CSA A" || $category=="CSA B") && $net_salary>=30000) || (($category=="CAT C" || $category=="CSA C") && $net_salary>=20000 ))
		{   
			list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$Company_Name);
		}
		else
		{
			$Feedback="";
			//echo "<br>Company CLAUSE BPO: NOT ELIGIBLE<br>";
		}
	}
	else if($company_type=="Insurance")
	{
		//echo "2<br>";
		if($net_salary>=25000)
		{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$Company_Name);
			}
		else
		{	$Feedback="";
				//echo "<br>Company CLAUSE Insurance: NOT ELIGIBLE<br>";
		}
	}
	else
	{
		if($city=="Delhi" || $city=="Gurgaon" || $city=="Noida" || $city=="Gaziabad" || $city=="Faridabad")
		{
		if($primary_acc=="HDFC Bank" || (strncmp ("HDFC", $primary_acc,4))==0)
		{
			echo "3i<br>";
			if(($net_salary>=12000 && ($category=="Super A" || $category=="CAT A" || $category=="CAT B" || ($category=="CAT C" && $virtualcat=""))) || ($net_salary>=15000)) 
			{
list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc,$Company_Name);				
			}
			else
			{
				//Company CLAUSE Other with AccHDfC: NOT ELIGIBLE
				 $Feedback="";
			}
			
		}
		else
		{
			//echo "3j<br>";
			if(($net_salary>=15000 && ($category=="Super A" || $category=="CAT A" || $category=="CAT B") || ($net_salary>=20000 && ($category=="CAT C" && $virtualcat="")) || ($net_salary>=25000))) 
			{
			list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc,$Company_Name);
			}
			else
			{
				$Feedback="";
				 //$Feedback="Company CLAUSE Other without HDfC: NOT ELIGIBLE<br>";
			}
		}
		}
		else
		{
		if($primary_acc=="HDFC Bank" || (strncmp ("HDFC", $primary_acc,4))==0)
		{
			if(($net_salary>=12000 && ($city=="Mumbai" || $city=="Chennai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune")) 
			|| 
			($net_salary>=10000 && ($city=="Cochin" || $city=="Kolkata" || $city=="Calcutta" || $city=="Ahmedabad"))
			||
			($net_salary>=8000 && ($city!="Cochin" && $city!="Kolkata" && $city!="Calcutta" && $city!="Ahmedabad" && $city!="Mumbai" && $city!="Delhi" && $city!="Chennai" && $city!="Hyderabad" && $city!="Bangalore" && $city!="Pune")))
			{

list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc,$Company_Name);
		}
			else
			{
				//Company CLAUSE Other with AccHDfC: NOT ELIGIBLE
				 $Feedback="";
			}
	}
		else
		{
			//echo "3j<br>";
			if(($net_salary>=15000 && ($city=="Mumbai" || $city=="Delhi" || $city=="Chennai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune")) 
			|| 
			($net_salary>=12000 && ($city=="Cochin" || $city=="Kolkata" || $city=="Calcutta" || $city=="Ahmedabad"))
			||
			($net_salary>=10000 && ($city!="Cochin" && $city!="Kolkata" && $city!="Calcutta" && $city!="Ahmedabad" && $city!="Mumbai" && $city!="Delhi" && $city!="Chennai" && $city!="Hyderabad" && $city!="Bangalore" && $city!="Pune")))
			{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc,$Company_Name);
					}
			else
			{
					$Feedback="";
					 //$Feedback="Company CLAUSE Other without HDfC: NOT ELIGIBLE<br>";
			}

		}
	}
	}

	$details[]= $interestrate;
	$details[]= $get_emi;
	$details[]= $getterm;
	$details[]= $getloanamout;
	return($details);
}

function HDFC_Prsnlln($net_salary,$category,$term,$Company_Type,$clubbed_emi,$hdfc_total_outstanding,$Primary_Acc,$company)
{	//$net_salary,$category,$term,$Company_Type,$clubbed_emi,$hdfc_total_outstanding,$Primary_Acc
 $exactnet_salary= $net_salary;
//list($term,$print_term)=getdob($DOB);
//echo "term: ".$term."print_term".$print_term."<br>";
if( $exactnet_salary>0)
	{
	$gtcropcomp="Select interest_rate_csa ,interest_rate_noncsa From  pl_company_hdfc Where (company_name like '%".$company."%' and status=1)";
	list($crprecordcount,$icicirow)=MainselectfuncNew($gtcropcomp,$array = array());
	$icicirowcontr=count($icicirow)-1;


if($crprecordcount>0)
	{
	if($Primary_Acc=="HDFC" || $Primary_Acc=="HDFC Bank" || $Primary_Acc=="hdfc")
		{
			list($main,$gen) = split('[.]', $icicirow["interest_rate_csa"]);
			if($gen==00)
			{
				$interestrate = $main." %";
			}
			else
			{
				$interestrate = $icicirow[$icicirowcontr]["interest_rate_csa"]." %";
			}

			$intr=$icicirow[icicirowcontr]["interest_rate_csa"]/1200;

		}
		else
		{
			list($main,$gen) = split('[.]', $icicirow[$icicirowcontr]["interest_rate_noncsa"]);
			if($gen==00)
				{
					$interestrate = $main." %";
				}
				else
				{
					$interestrate = $icicirow[$icicirowcontr]["interest_rate_noncsa"]." %";
				}
				
				$intr=$icicirow[$icicirowcontr]["interest_rate_noncsa"]/1200;
						
		}
		if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=4;
			}
			elseif($term==60)
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
	}
		else
		{
	if($category=="Super A" || $category=="Cat A" || $category=="CAT A" || $category=="CSA A" || $category=="SUPER A")
	{
		
		if($exactnet_salary<=35000)
		{
			$interestrate = "18.25%";
			$intr=18.25/1200;

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=4;
			}
			elseif($term==60)
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}
if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
			
		}
		elseif($exactnet_salary>35000 && $exactnet_salary<=50000)
		{
			$interestrate = "17.25%";
			$intr=17.25/1200;

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=4;
			}
			elseif($term==60)
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}
			
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		elseif($exactnet_salary>50000 && $exactnet_salary<=75000)
		{
			$interestrate = "16.25%";
			$intr=16.25/1200;

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=4;
			}
			elseif($term==60)
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}
			
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		elseif($exactnet_salary>75000)
		{
			$interestrate = "15.75%";
			$intr=15.75/1200;

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=4;
			}
			elseif($term==60)
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}
			
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
	}
	elseif($category=="CAT B" || $category=="CSA B")
	{
		if($exactnet_salary<=35000)
		{
			$interestrate = "18.25%";
			$intr=18.25/1200;

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=4;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=4;
			}
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
			
		}
		elseif($exactnet_salary>35000 && $exactnet_salary<=50000)
		{
			$interestrate = "17.25%";
			$intr=17.25/1200;

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=4;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=4;
			}
			if($Loan_Amount_Eli>1000000)
			{
				$getloanamout=1000000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		elseif($exactnet_salary>50000 && $exactnet_salary<=75000)
		{
			$interestrate = "16.25%";
			$intr=16.25/1200;

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=4;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=4;
			}
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
			elseif($exactnet_salary>75000)
		{
			$interestrate = "15.75%";
			$intr=15.75/1200;

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=4;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=4;
			}
			if($Loan_Amount_Eli>1000000)
			{
				$getloanamout=1000000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
	}
	elseif($category=="CAT C" || $category=="CAT D" || $category=="CSA C")
	{
		if($exactnet_salary<=35000)
		{
			if($category=="CAT C" || $category=="CAT D")
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
			}
			else
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
			}

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 7;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			// ASK//
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
			
		}
		elseif($exactnet_salary>35000 && $exactnet_salary<=50000)
		{
			if($category=="CAT C" || $category=="CAT D")
			{
				$interestrate = "17.25%";
				$intr=17.25/1200;
			}
			else
			{
				$interestrate = "17.25%";
				$intr=17.25/1200;
			}

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 7;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			// ASK//
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		elseif($exactnet_salary>50000 && $exactnet_salary<=75000)
		{
			if($category=="CAT C" || $category=="CAT D")
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
			}
			else
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
			}

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 7;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			// ASK//
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
			elseif($exactnet_salary>75000)
		{
			if($category=="CAT C")
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
			elseif($category=="CAT D")
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
			else
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}

			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 7;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			// ASK//
			if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
	}
	else
	{
		if($exactnet_salary<=35000)
		{
			
			$interestrate = "22.25%";
			$intr=22.25/1200;
			
			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 7;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			// ASK//
			 if($Primary_Acc=='HDFC')
				{
					if($Loan_Amount_Eli>150000)
					{
						$getloanamout=150000;
					}
					else
					{
						$getloanamout=$Loan_Amount_Eli;
					}
				}
				else
			{
				if($Loan_Amount_Eli>75000)
						{
							$getloanamout=75000;
						}
						else
						{
							$getloanamout=$Loan_Amount_Eli;
						}
			}
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
			
		}
		elseif($exactnet_salary>35000)
		{
				$interestrate = "22.25%";
				$intr=22.25/1200;
			
			if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 7;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			// ASK//

			 if($Primary_Acc=='HDFC')
				{
					if($Loan_Amount_Eli>150000)
					{
						$getloanamout=150000;
					}
					else
					{
						$getloanamout=$Loan_Amount_Eli;
					}
				}
				else
			{
				if($Loan_Amount_Eli>75000)
						{
							$getloanamout=75000;
						}
						else
						{
							$getloanamout=$Loan_Amount_Eli;
						}
			}
		
		if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
	}

} //special companies
}//
$alac=100000;
$peremicalc=round($alac * $intr / (1 - (pow(1/(1 + $intr), $term))));
if($exactnet_salary>=75000)
	{
if($getloanamout>=2000000)
	{
		$interestrate = "11.99%";
		$intr=11.99/1200;
		$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
	}
	elseif($getloanamout>=1500000 && $getloanamout<2000000)
	{
		$interestrate = "13.25%";
		$intr=13.25/1200;
		$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
	}
	elseif($getloanamout>=1000000 && $getloanamout<1500000)
	{
		$interestrate = "13.75%";
		$intr=13.75/1200;
		$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
	}
	}
	
$details[]= $interestrate;
	$details[]= $getemicalc;
	$details[]= $getterm;
	$details[]= round($getloanamout);
	return($details);
}//HDFC BANK

if(strlen($full_name)>0 && strlen($mobile_number)>9 && strlen($mcity)>0 )
{

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9811555306,9999570210) and Mobile_Number='".$mobile_number."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	//echo $getdetails."<br>";
	//exit();
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;

	if($alreadyExist>0)
	{

		$ProductValue=$myrow[$myrowcontr]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";

	}
	else
	{
$CheckSql = "select UserID from wUsers where Email = '".$email_id."'";
list($CheckNumRows,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
$CheckQuerycontr=count($CheckQuery)-1;
if($CheckNumRows>0)
{
	$UserID = $CheckQuery[$CheckQuerycontr]['UserID'];
}
else
	{
		$Dated = ExactServerdate();
		$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$email_id', '$full_name', '$mobile_number', Now(), '$IsPublic')";			
		$dataUser = array('Email'=>$email_id,'FName'=>$full_name,'Phone'=>$mobile_number,'Join_Date'=>$Dated,'IsPublic'=>$IsPublic);
		$UserID = Maininsertfunc ('wUsers', $dataUser);
	}


	$Dated = ExactServerdate();
	$dataInsertUser =array('UserID'=>$UserID, 'Name'=>$full_name, 'Email'=>$email_id, 'Employment_Status'=>$Employment_Status, 'Mobile_Number'=>$mobile_number, 'DOB'=>$DOB, 'City'=>$City, 'Company_Name'=>$Company_Name, 'Net_Salary'=>$annual_salary, 'Primary_Acc'=>$primary_acc, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_Any, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Loan_Amount'=>$reqd_loan_amt, 'Years_In_Company'=>'1', 'Total_Experience'=>'3', 'Residential_Status'=>$residence_status, 'Company_Type'=>$company_cate_type, 'source'=>'HDFC Bank PL', 'Referrer'=>$last_inserted_id, 'City_Other'=>$city_other);
	$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsertUser);

//echo 	$InsertPLSql."<br>";
if($mcity=="Others" && strlen($city_other)>0)
	{
		$strCity=$city_other;
	}
	else
	{
		$strCity=$mcity;
	}

	}
list($Bnkd,$bidder_id)=getBiddersList("Req_Loan_Personal",$ProductValue,$strCity);
$finalchk_bid=implode(',',$bidder_id);
$finalBnkd=implode(',',$Bnkd);

if(strlen($finalchk_bid)>0 && $Employment_Status==1)
		{ 

	
 
}
} ?>
	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HDFC Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/hdfc_pl.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function checkdata()
{
	//alert(document.getElementById('getdetails'));
	document.getElementById('getdetails').style.visibility="";
}
</script>
</head>
<body>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6" class="lftshado">&nbsp;</td>
    <td bgcolor="#FFFFFF"><table width="965"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="77%" height="74"><img src="new-images/hdfc-pl/hdfcbank_logo.gif" width="171" height="29"></td>
            <td width="23%"><img src="new-images/hdfc-pl/deal4loans_logo.gif" width="200" height="54"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="3"></td>
      </tr>
	  <? if($getloanamout>0 && $Employment_Status ==1)
		{ ?>
	  <tr><td height="35" class="boldtxt" style="color:#103E6B; padding-left:15px; line-height:18px; font-size:12px; "><b>Dear Customer ,<br>
	    Based on the information furnished by you, we are   pleased to offer you a Tentative Personal Loan Eligibility Quote as per details   mentioned: <br><br>Offer Details: </b></td>
	  </tr>
	  <? } ?>
      <tr>
        <td height="450" align="center" valign="top" class="hdng" style="padding-top:15px; ">	
 <table width="949"  align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="66" background="new-images/hdfc-pl/thank-bg.gif" style="background-repeat:no-repeat; ">
	<table width="90%"   border="0" align="center" cellpadding="0" cellspacing="0" >
<? if($getloanamout>0 && $Employment_Status ==1)
	{
		$Dated = ExactServerdate();
		$DataArray = array("eligible_loanAmt"=>$getloanamout , "eligible_interestRate"=>$interestrate , "eligible_emi"=>$get_emi, "eligible_term"=>$getterm );
		$wherecondition ="( hdfcplid ='".$last_inserted_id."')";
		Mainupdatefunc ('hdfc_pl_calc_leads', $DataArray, $wherecondition);
	?>
	<tr>
	<tr><td height="55" align="center" class="boldtxt" style="font-size:13px; line-height:28px;" > Loan Amount<br>
	    <span style="color:#b04c09; "><? echo "Rs ".number_format($getloanamout) ; ?></span></td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">Interest Rate<br>
		  <span style="color:#b04c09; "><? echo $interestrate; ?></span></td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">EMI (Per month)<br>
		  <span style="color:#b04c09; "><? echo "Rs ".$get_emi; ?></span></td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">Tenure<br>
		  <span style="color:#b04c09; "><? echo $getterm; ?> yrs</span></td>
	</tr>
	<tr>
	  <td colspan="7" height="53" style="color:#103E6B;line-height:25px; font-size:12px; background-repeat:no-repeat; background-position:center;   " background="new-images/blu-bordrbg.gif" class="boldtxt" >
	  <form action="hdfc-personal-loan-newthanks-test.php" name="Sub" method="post" target="_blank">
	  
	<input type="hidden" name="lead_id" value="<?php echo $last_inserted_id; ?>">
	<input type="hidden" name="pllead_id" id="pllead_id" value="<?php echo $ProductValue; ?>">
	<input type="hidden" name="city" value="<?php echo $city; ?>">
		<input type="hidden" name="bidders_details" id="bidders_details" value="<?php echo $finalchk_bid; ?>">
	  <table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="80%">Do you wish Hdfc Team to contact you for more information on loan and process : </td>
            <td width="20%"><input type="image" name="Yes" value="" src="new-images/apply-btn1.jpg" border="0" style="border:0px;"></td>
          </tr>
      </table></form></td>
	  </tr>
	
	<tr>
	  <td colspan="7" height="10" ></td>
	  </tr>
	
	<? }
	else
	{?>
	<tr>
		<td colspan="7" class="boldtxt" style="color:#103E6B; padding-left:15px; line-height:18px; font-size:12px; ">We're sorry. Our automated system could not locate an offer for you at this time. However our representatives might be able to find you an offer and communicate to you. <? //echo $Feedback; ?></td>
	</tr>
	<? } 
	?>
	

		
</table></td>
  </tr>
</table>
 </td>
      </tr>
	  <tr><td style="font-family:Verdana, Arial, Helvetica, sans-serif; Font-size:11px; color:#FF0000;">* Terms & Conditions Apply , Credit at the sole discretion  of HDFC Bank </td>
	  </tr>
    </table></td>
    <td width="6" class="rgtshado">&nbsp;</td>
  </tr>
</table>


</body>
</html>
