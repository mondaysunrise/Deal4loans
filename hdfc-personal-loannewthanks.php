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
	$city = $_POST["City"];
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

	$Activate = generateNumber(4);
	$app_code = date('dmy')."".$Activate;

//HDFC OUtStanding
$loan_amt_interest= $hdfc_emi_amt * $hdfc_loan_tenure;

$hdfc_total_outstanding= $loan_amt_interest - $availed_loan_amt;

if($hdfc_emi_amt>0)
{
	$clubbed_emi = $clubbed_emi - $hdfc_emi_amt;
}

if($no_of_loans>0)
{
	$LoanAny = 1;
}
//Insert DATA For HDFC PL
//$hdfcpl="update hdfc_pl_calc_leads set age='".$age."',company_name='".$Company_Name."', DOB='".$DOB."', company_category='".$company_cate_type."',company_type='".$company_type."',primary_acc='".$primary_acc."',no_of_loan_running='".$no_of_loans."',clubbed_emi='".$clubbed_emi."',availed_loan_amt='".$availed_loan_amt."',pl_emi_amt='".$hdfc_emi_amt."',pl_tenure='".$hdfc_loan_tenure."',pl_no_of_emi='".$no_emi_paid."', Employment_Status = '".$Employment_Status."',residence_status ='".$residence_status."', Loan_Any='".$LoanAny."'  where (hdfcplid ='".$last_inserted_id."')";

if($no_emi_paid==3)
{
	$EMI_Paid=4;
}

$dataUpdate = array('Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'Loan_Amount'=>$reqd_loan_amt, 'DOB'=>$DOB, 'Residential_Status'=>$Residential_Status, 'Primary_Acc'=>$primary_acc, 'Company_Type'=>$company_cate_type, 'EMI_Paid'=>$EMI_Paid);
$wherecondition ="(RequestID='".$last_inserted_id."')";
Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);

$caqry='Select hdfc_category from hdfc_pl_company_list where (hdfc_company_name="'.$Company_Name.'")';
list($carowNum,$carow)=MainselectfuncNew($caqry,$array = array());
$carowcontr=count($carow)-1;

$category = $carow[$carowcontr]["hdfc_category"];

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
			list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$age,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding,$virtualcat);
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

Function  HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$DOB,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding,$virtualcat)
{
	$exactnet_salary= $net_salary;
list($term,$print_term)=getdob($DOB);

	$qry="Select hdfc_splid from hdfc_spl_city_rates where (hdfc_city='".$city."' and hdfc_net_salary<='".$net_salary."')";
	list($recordcount,$result)=MainselectfuncNew($qry,$array = array());
	//echo $qry;
	//echo "<br>";
	if($company_type=="BPO")
	{
		//echo "1<br>";
		if((($category=="Super A" || $category=="CAT A" || $category=="CAT B" || $category=="CSA A" || $category=="CSA B") && $net_salary>=30000) || (($category=="CAT C" || $category=="CSA C") && $net_salary>=20000 ))
		{   
			if($recordcount>0)
			{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
			}
			else
			{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
			}
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
		if($recordcount>0)
			{
	if(strlen($category)>0 && $virtualcat="")
{
list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
}
else
{
	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
}
			}
			else
			{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
			}
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
			//echo "3i<br>";
			if(($net_salary>=12000 && ($category=="Super A" || $category=="CAT A" || $category=="CAT B" || ($category=="CAT C" && $virtualcat=""))) || ($net_salary>=15000)) 
			{
				//echo "ex: ".$exactnet_salary."c: ".$category."t: ".$term;
				if($recordcount>0)
				{
	if(strlen($category)>0 && $virtualcat="")
{
list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
}
else
{	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
}
				}
				else
				{
list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
				}
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
				if($recordcount>0)
				{
					if(strlen($category)>0 && $virtualcat="")
		{
					list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
			}
else
{
	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
}
				}
				else
				{
					list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
				}

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
			//echo "3i<br>";
			if(($net_salary>=12000 && ($city=="Mumbai" || $city=="Chennai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune")) 
			|| 
			($net_salary>=10000 && ($city=="Cochin" || $city=="Kolkata" || $city=="Calcutta" || $city=="Ahmedabad"))
			||
			($net_salary>=8000 && ($city!="Cochin" && $city!="Kolkata" && $city!="Calcutta" && $city!="Ahmedabad" && $city!="Mumbai" && $city!="Delhi" && $city!="Chennai" && $city!="Hyderabad" && $city!="Bangalore" && $city!="Pune")))
			{
				//echo "ex: ".$exactnet_salary."c: ".$category."t: ".$term;
				if($recordcount>0)
				{
	if(strlen($category)>0 && $virtualcat="")
{
list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
}
else
{	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
}
				}
				else
				{
list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
				}
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
				if($recordcount>0)
				{
					if(strlen($category)>0 && $virtualcat="")
{
list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
}
else
{
	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
}
				}
				else
				{
					list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
				}

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
}Function  HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc)
{
	
	if($clubbed_emi>0)
	{
		$net_salary=$exactnet_salary-$clubbed_emi;
	}
	/*echo "basic calc";
	echo "<br>";
	echo $exactnet_salary."c: ".$category." ".$term;
	echo "<br>";*/

if($category=="Super A" || $category=="Cat A" || $category=="CAT A" || $category=="CSA A")
	{
		if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}

		if($exactnet_salary>=25000)
		{
			if($term==12)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 5;
				}
				else
				{
					$Loan_Amount_Eli=$exactnet_salary * 5;
				}
				$getterm=1;
			}
			else if($term==24)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 9;
				}
				else
				{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				}
				$getterm=2;
			}
			else if($term==36)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 13;
				}
				else
				{
					$Loan_Amount_Eli=$exactnet_salary * 13;
				}

				$getterm=3;
			}
			else if($term==48)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 15;
				}
				else
				{
				$Loan_Amount_Eli=$exactnet_salary * 15;
				}
				$getterm=4;
			}
			else if($term==60)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 18;
				}
				else
				{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				}
				$getterm=5;
			}
			else
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 18;
				}
				else
				{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				}
				$getterm=5;
			}
		}
		else// Salary less then 25 k
		{
			if($category=="Super A")
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
						$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 13;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 13;
						}
						$getterm=4;
					}
				else if($term==60)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 15;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 15;
						}
					$getterm=5;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 15;
						}
						else
						{
						$Loan_Amount_Eli=$exactnet_salary * 15;
						}
					$getterm=5;
					}
			}
			else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 13;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 13;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 13;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 13;
						}
					$getterm=4;
					}
			}		}
		if($Loan_Amount_Eli>1500000)
			{
			$getloanamout=1500000;
			}
		else
			{
			$getloanamout=$Loan_Amount_Eli;
			}

		if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
	}//Super A, CAT A, CSA A 
	else if($category=="CAT B")
	{
		if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}
		if($exactnet_salary>=25000)
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
							$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 14;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 14;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 14;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 14;
						}
					$getterm=4;
					}
			}
		else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 10;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 10;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=4;
					}
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
	} //CAT B
	else if($category=="CSA B")
	{
		if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}
		if($exactnet_salary>=20000)
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 14;
						}
						else
						{
						 $Loan_Amount_Eli=$exactnet_salary * 14;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 14;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 14;
						}
					$getterm=4;
					}
			}
		else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 10;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 10;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=4;
					}
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
	}//CSA B
	else if($category=="CSA C")
	{
		if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}
		if($exactnet_salary>=20000)
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
			}
		else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
						$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
			}

			if($Loan_Amount_Eli>500000)
					{
					$getloanamout=500000;
					}
				else
					{
					$getloanamout=$Loan_Amount_Eli;
					}

			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
	}//CSA C
	else if($category=="CAT C" || $category=="Cat C")
	{
			if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}
		if($exactnet_salary>=20000)
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
				else
					{
						if($net_salary>0)
							{
								$Loan_Amount_Eli=$net_salary * 11;
							}
							else
							{
								$Loan_Amount_Eli=$exactnet_salary * 11;
							}
						$getterm=3;
					}
			}
		else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
				else
					{
					if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
						
					}
			}			if($Loan_Amount_Eli>500000)
					{
					$getloanamout=500000;
					}
				else
					{
					$getloanamout=$Loan_Amount_Eli;
					}

			
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}

		}//CAT C
	else if($category=="CSA D" || $category=="CAT D")
	{
			$interestrate = "22%";
			$intr=22/1200;

				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}

if($company_cate_type==2)
		{
			if($Loan_Amount_Eli>500000)
				{
				$getloanamout=500000;
				}
			else
				{
			$getloanamout=$Loan_Amount_Eli;
				}
		}
	else
		{
			if($primary_acc=="HDFC Bank")
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
		}
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}

		} //CAT D or CSA D
		else
		{
			
			$interestrate = "22%";
			$intr=22/1200;

				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
					if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
						$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
					if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
				else
					{
					if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
			/*if($Loan_Amount_Eli>150000)
				{
				$getloanamout=150000;
				}
			else
				{
				$getloanamout=$Loan_Amount_Eli;
				}
				*/
		if($company_cate_type==2)
		{
			if($Loan_Amount_Eli>500000)
				{
				$getloanamout=500000;
				}
			else
				{
			$getloanamout=$Loan_Amount_Eli;
				}
		}
		else
		{
			if($primary_acc=="HDFC Bank")
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
		}
				//echo "NON-list: <br>";
				//echo $Loan_Amount_Eli."<br>";
				
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}

	}//Non Listed Company

//echo "Loan AMt: ".$getloanamout."<br>";
//echo "HTO".$hdfc_total_outstanding."<br>";
if($getloanamout>$hdfc_total_outstanding && ($hdfc_total_outstanding>0))
	{
	
	$getloanamout = $getloanamout - $hdfc_total_outstanding;
	}
	else if($getloanamout<$hdfc_total_outstanding && ($hdfc_total_outstanding>0))
	{
		$getloanamout=0;
	}
	else
	{
			$getloanamout=$getloanamout;
	}

		$get_emi=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
//echo "loan: ".$getloanamout."<br>";
//echo $intr."<br>";
//echo $term."<br>";
	
	$details[]= $interestrate;
	$details[]= $get_emi;
	$details[]= $getterm;
	$details[]= $getloanamout;
	return($details);
}function Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat)
{
$exactnet_salary= $exactnet_salary-$clubbed_emi;

	if($category=="Super A" || $category=="CSA A" || $category=="CAT A" || $category=="CSA B" || $category=="CAT B" || $category=="CAT C" || $category=="CSA C")
	{
		$interestrate = "15.5%";
			$intr=15.5/1200;
	}
	else if($category=="CAT D")
	{
		$interestrate = "22%";
			$intr=22/1200;
	}	if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			else if($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			else if($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=3;
			}
			else if($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=4;
			}
			else if($term==60)
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}

$getloanamout=$Loan_Amount_Eli;

if($getloanamout>$hdfc_total_outstanding && ($hdfc_total_outstanding>0))
	{
	 $getloanamout = $getloanamout - $hdfc_total_outstanding;
	}
	else if($getloanamout<$hdfc_total_outstanding && ($hdfc_total_outstanding>0))
	{
		$getloanamout=0;
	}
	else
	{
			$getloanamout=$getloanamout;
	}

if($Loan_Amount_Eli>500000 && (strlen($virtualcat)>0))
	{
	$getloanamout=500000;
	}
	else if (($Loan_Amount_Eli>1500000 && ($virtualcat)==""))
	{
		$getloanamout=1500000;
	}
else
	{
	$getloanamout=$Loan_Amount_Eli;
	}
//echo "loan: ".$getloanamout."<br>";
//echo $intr."<br>";
//echo $term."<br>";
//echo $getterm."<br>";

	$get_emi=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

$details[]= $interestrate;
	$details[]= $get_emi;
	$details[]= $getterm;
	$details[]= $getloanamout;
	return($details);

}?>
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
	$dataUpdateLeads = array('eligible_loanAmt'=>$getloanamout, 'eligible_interestRate'=>$interestrate, 'eligible_emi'=>$get_emi, 'eligible_term'=>$getterm);
	$wherecondition ="(hdfcplid ='".$last_inserted_id."')";
	Mainupdatefunc ('hdfc_pl_calc_leads', $dataUpdateLeads, $wherecondition);
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
	<input type="hidden" name="city" value="<?php echo $city; ?>">
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
	
<?  $annual_salary=$salary *12;
if($no_emi_paid==3)
		{
	$EMI_Paid=4;
		}
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
	
		$dataInsertUser =array('UserID'=>$UserID, 'Name'=>$full_name, 'Email'=>$email_id, 'Employment_Status'=>$Employment_Status, 'Mobile_Number'=>$mobile_number, 'DOB'=>$DOB, 'City'=>$City, 'Company_Name'=>$Company_Name, 'Net_Salary'=>$annual_salary, 'Primary_Acc'=>$primary_acc, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_Any, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'Loan_Amount'=>$reqd_loan_amt, 'Years_In_Company'=>'1', 'Total_Experience'=>'3', 'Residential_Status'=>$residence_status, 'Company_Type'=>$company_cate_type, 'source'=>'HDFC Bank PL', 'Referrer'=>$last_inserted_id);
	$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsertUser);

list($Bnkd,$bidder_id)=getBiddersList("Req_Loan_Personal",$ProductValue,$City);
$finalchk_bid=implode(',',$bidder_id);
$finalBnkd=implode(',',$Bnkd);

if(strlen($finalchk_bid)>0 && $Employment_Status==1)
		{ ?>
	<!--	<tr><td colspan="7" style="color:#103E6B;line-height:25px; font-size:13px; " align="center"><b>OR</b></td>
	<form action="hdfc-personal-loan-comparebanks.php" name="Sub" method="post">
	<input type="hidden" name="hdfc_lead_id" value="<?php echo $last_inserted_id; ?>">
	<input type="hidden" name="eligible_loan" value="<?php echo $getloanamout; ?>">
	<input type="hidden" name="pl_lead_id" value="<?php echo $ProductValue; ?>">
	<input type="hidden" name="city" value="<?php echo $city; ?>">
	<input type="hidden" name="salary" value="<?php echo $salary; ?>">
	<input type="hidden" name="Company_Name" value="<?php echo $Company_Name; ?>">
	<input type="hidden" name="DOB" value="<?php echo $DOB; ?>">
	<input type="hidden" name="clubbed_emi" value="<?php echo $clubbed_emi; ?>">
	<tr><td colspan="7" style="color:#103E6B;line-height:25px; font-size:11px; " >
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td colspan="2" height="53" style="color:#103E6B;line-height:25px; font-size:12px; background-repeat:no-repeat; background-position:center;   " background="new-images/wht-shadobg.jpg" class="boldtxt" ><table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
    <td width="80%">Do you wish to compare Hdfc rates with other Banks and then Apply: </td>
    <td width="20%"><input type="button" style="cursor:pointer; border: 0px none ; background-image: url(new-images/quote-btn1.jpg); width: 99px; height: 28px; margin-bottom: 0px;" value="" onclick="checkdata();"/></td>
  </tr>
  
</table>
</td>
     </tr>
    
  <tr><td colspan="2" align="center">
  
  <div id="getdetails" style="visibility:hidden; width:784px; height:178px; background-image:url(new-images/wht-formshadobg.jpg); background-repeat:no-repeat; background-position:center;"  >
    <table width="700" align="center" cellpadding="0" cellspacing="0">
 <tr>
   <td height="12" colspan="2"></td>
   </tr>
 <tr><td height="30" class="boldtxt" style=" font-size:12px; ">Credit Card Holder?</td>
                <td class="boldtxt"  style=" font-size:11px; "> 
             <input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="14"  value="1" onClick="addElement();">Yes &nbsp;&nbsp;
             <input type="radio" name="CC_Holder" id="CC_Holder" style="border:none;" tabindex="15" value="0" onClick="removeElement();">No</td>
              </tr>
<tr>    <td align="left" height="30" class="boldtxt"  style=" font-size:12px; ">Card held since?</td>           
<td colspan="3" align="left" width="486" height="18" class="boldtxt"><select name="Card_Vintage" style="width:120px;"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select>  </td>	</tr>

<tr><td width="212"  height="30" align="left" class="boldtxt" style=" font-size:12px; ">Any type of loan(s) running?</td>  
<td colspan="3" align="left"  class="boldtxt" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td height="20" colspan="2"  style=" font-size:11px; "><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home </td><td width="116" style=" font-size:11px; " ><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td> <td  width="82" height="20"  style=" font-size:11px; " ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" />   Car </td> <td width="102"   style=" font-size:11px; " ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" />      
Property </td>
      <td width="82" height="22"  style=" font-size:11px; "><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" />  Other</td>
</tr></table></td></tr>		 <tr>    <td align="left" height="30" class="boldtxt" style=" font-size:11px; " >How many EMI paid? </td>           
<td colspan="3" align="left" width="486" height="18" class="frmbldtxt"><select name="EMI_Paid" style="width:120px;"  > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select>  </td>	</tr>
<tr>
  <td align="left" height="40" class="boldtxt" style=" font-size:11px; " >&nbsp;</td>
  <td colspan="3" align="left" height="18" class="frmbldtxt"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn1.jpg); width: 99px; height: 28px; margin-bottom: 0px;" value=""/></td>
</tr>

</table>
</div></td></tr>  
</table>
</td>
	</tr>
	</form> -->
<? } ?>
	
		
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
</table></body>
</html>
