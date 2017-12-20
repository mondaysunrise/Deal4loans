<?php


function getdob($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18))
		{
			$term = 84;
			$print_term = "7";
		}
	else if(($DOB>50 && $DOB<=54))
		{
			$term = 72;
			$print_term = "6";
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

function citibank($net_salary,$clubbed_emi,$company,$DOB,$category,$company_name)
{
//echo "salasry: ".$net_salary."clubnbed: ".$clubbed_emi."company: ".$company."category: ".$category."DOB: ".$DOB."<br>";
	$princ="100000";
	list($term,$print_term)=getdob($DOB);


	if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
		else
			{
				$getterm=4;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}


	
	 
// Calculate loan amount for CAT A
	if(strlen($category)>0)
	{
		if($company_name=="Agilent Technologies" || $company_name=="Bharti Airtel Ltd" || $company_name=="ARICENT TECHNOLOGIES (HOLDINGS) LIMITED" || $company_name=="BIRLASOFT" || $company_name=="Computer Sciences Corporation India Pvt Ltd" || $company_name=="Ericsson Communications Pvt. Ltd / Ericsson india Pvt. Ltd" || $company_name=="HEWITT ASSOCIATES INDIA PVT. LTD" || $company_name=="NESTLE India Limited" || $company_name=="S T MICRO ELECTRONICS" || $company_name=="STERIA INDIA LTD")
		{
			$interestrate = "14.50%";
			$intr=14.5/1200;
		}
		else
		{
			if($category=="CAT B")
			{
				if($net_salary<=30000)
				{
					$interestrate = "17%";
					$intr=17/1200;
				}
				elseif($net_salary>30000 && $net_salary<=50000)
				{
					$interestrate = "16%";
					$intr=16/1200;
				}
				elseif($net_salary>50000)
				{
					$interestrate = "16%";
					$intr=16/1200;
				}
				else
				{
					$intr="";
				}
			}
			else
			{
		if($net_salary>=22000 && $net_salary<=35000)
				{
					$interestrate = "16%";
					$intr=16/1200;
				}
				elseif($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = "15%";
					$intr=15/1200;
				}
				elseif($net_salary>50000)
				{
					$interestrate = "15%";
					$intr=15/1200;
				}
				else
				{
					$intr="";
				}
			}
		
		}
		

	$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
	
//calculate loan amout
if($clubbed_emi>0)
		{
	//echo "condition 1: loan but no card";
			//first condition
			$firstnet_salary=($net_salary* (60/100));
			$firstloanamount=($firstnet_salary - $clubbed_emi)/$emicalc;
			//second condition

			$secondnet_salary=($net_salary* (35/100));
			$secondloanamount = $secondnet_salary/$emicalc;
			
		if($firstloanamount>$secondloanamount)
			{
					$loanamount=$secondloanamount;
			}
else
			{
				$loanamount=$firstloanamount;
			}
				
		}
		
	
		else
		{
				
			$finalnet_salary=($net_salary* (35/100));
			//echo "in: ".$finalnet_salary."<br>";
			$loanamount = $finalnet_salary/$emicalc;
			//echo "else:".$loanamount;
		}

	}
	else
	{
		
			//echo "u r not eligible for Loan";
				//echo "CAT B";
	}

if(strlen($category)>0 && $category=="CAT A")
{
	if($loanamount>15)
	{
		$loanamount="15.00000";
	}
	else
	{

		$loanamount=$loanamount;
	}
}
else
{
	if(strlen($category)>0 && $category=="CAT B")
	{
		if($loanamount>7)
		{
			$loanamount="7.00000";
		}
		else
		{
		$loanamount=$loanamount;
		}
	}
	else
	{
	
		if($loanamount>6)
		{
			$loanamount="6.00000";
		}
		else
		{
		$loanamount=$loanamount;
		}

	}
}

if($loanamount>0)
	{
list($First,$Last) = split('[.]', $loanamount);
$gettwovalues=substr($Last, 0, 2);  
if($First>0)
	{
$exactreqloan=$First.$gettwovalues."000";
$exactloan = $First.",".$gettwovalues."000";
	}
	else
	{
		$exactreqloan=$gettwovalues."000";
		$exactloan = $gettwovalues."000";
	}
	}
	else
	{
		//echo "Not eligible for loan";
	}

if($loan_required>$exactreqloan)
	{
		//emi
		$getloanamout =$exactreqloan;
		$getemicalc=round($exactreqloan * $intr / (1 - (pow(1/(1 + $intr), $term))));
		//echo $getemicalc;
	}
	else
	{
		if($loan_required>0)
		{
			$getloanamout =$loan_required;
		$getemicalc=round($loan_required * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		else
		{
			$getloanamout =$exactreqloan;
			$getemicalc=round($exactreqloan * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
	}

	$alac=100000;
	$peremicalc=round($alac * $intr / (1 - (pow(1/(1 + $intr), $term))));
	
	$details[]=$interestrate;
	$details[]=$getloanamout;
	$details[]=$getemicalc;
	$details[]=$getterm;
	//$details[]=$peremicalc;

			return($details);

}//CITIBANK


function hdfcbank($net_salary,$clubbed_emi,$company,$category,$DOB,$Company_Type,$Primary_Acc)
{
//echo "salasry: ".$net_salary."clubnbed: ".$clubbed_emi."company: ".$company."category: ".$category."DOB: ".$DOB."<br>";
	 $exactnet_salary= $net_salary - $clubbed_emi;

	list($term,$print_term)=getdob($DOB);
//echo "term: ".$term."print_term".$print_term."<br>";

if( $exactnet_salary>0)
	{
$gtcropcomp="Select interest_rate_csa ,interest_rate_noncsa From  pl_company_hdfc Where (company_name like '%".$company."%' and status=1)";
	//echo $gtcropcomp."<br>";
	$gtcropcompresult=ExecQuery($gtcropcomp);
	$icicirow=mysql_fetch_array($gtcropcompresult);
	$crprecordcount = mysql_num_rows($gtcropcompresult);

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
				$interestrate = $icicirow["interest_rate_csa"]." %";
			}

			$intr=$icicirow["interest_rate_csa"]/1200;

		}
		else
		{
			list($main,$gen) = split('[.]', $icicirow["interest_rate_noncsa"]);
			if($gen==00)
				{
					$interestrate = $main." %";
				}
				else
				{
					$interestrate = $icicirow["interest_rate_noncsa"]." %";
				}
				
				$intr=$icicirow["interest_rate_noncsa"]/1200;
						
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

}//for special rates
}
$alac=100000;
$peremicalc=round($alac * $intr / (1 - (pow(1/(1 + $intr), $term))));

$details[]=$interestrate;
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;
	//$details[]=$peremicalc;

	return($details);


}//HDFC bank

function fullerton($net_salary,$clubbed_emi,$company,$category,$DOB,$city)
{
//echo "salasry: ".$net_salary."clubnbed: ".$clubbed_emi."company: ".$company."category: ".$category."DOB: ".$DOB."city: ".$city."<br>";
	if($clubbed_emi>0)
	{
		$exactnet_salary= ($net_salary*(.60)) - $clubbed_emi;
	}
	else
	{
		$exactnet_salary= $net_salary;
	}
	list($term,$print_term)=getdob($DOB);

	
if($exactnet_salary>0)
	{
	if($category=="CAT A")
	{	
		if($net_salary<=25000)
		{
			
			$interestrate = "32%";
			$intr=32/1200;
			
			if($term==12)
				{
					$Loan_Amount_Eli=$exactnet_salary * 3;
					$getterm=1;
				}
				elseif($term==24)
				{
					$Loan_Amount_Eli=$exactnet_salary * 6;
					$getterm=2;
				}
				elseif($term==36)
				{
					$Loan_Amount_Eli=$exactnet_salary * 9;
					$getterm=3;
				}
				elseif($term==48)
				{
					$Loan_Amount_Eli=$exactnet_salary * 12;
					$getterm=4;
				}
				else
				{
					$Loan_Amount_Eli=$exactnet_salary * 12;
					$getterm=4;
				}
		}
		elseif($net_salary>25000)
		{
			if($city=="Delhi" || $city=="Noida" || $city=="Gurgaon" || $city=="Faridabad" || $city=="Gaziabad")
			{
			if($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "30%";
				$intr=30/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "25%";
				$intr=25/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=70000)
			{
				$interestrate = "22%";
				$intr=22/1200;
				
			}
			elseif($net_salary>70000)
			{
				$interestrate = "21%";
				$intr=21/1200;
				
			}
			else
			{
				$interestrate = "30%";
				$intr=30/1200;
			}
			}
			else
			{
				if($net_salary>25000 && $net_salary<=35000)
				{
					$interestrate = "30%";
					$intr=30/1200;
				}
				elseif($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = "25%";
					$intr=25/1200;
					
				}
				elseif($net_salary>50000 && $net_salary<=70000)
				{
					$interestrate = "22%";
					$intr=22/1200;
					
				}
				elseif($net_salary>70000)
				{
					$interestrate = "21%";
					$intr=21/1200;
				
			}
			else
			{
				$interestrate = "30%";
				$intr=30/1200;
			}

			}
						
			if($term==12)
				{
					$Loan_Amount_Eli=$exactnet_salary * 3;
					$getterm=1;
				}
				elseif($term==24)
				{
					$Loan_Amount_Eli=$exactnet_salary * 6;
					$getterm=2;
				}
				elseif($term==36)
				{
					$Loan_Amount_Eli=$exactnet_salary * 9;
					$getterm=3;
				}
				elseif($term==48)
				{
					$Loan_Amount_Eli=$exactnet_salary * 12;
					$getterm=4;
				}
				else
				{
					$Loan_Amount_Eli=$exactnet_salary * 12;
					$getterm=4;
				}
		}

	}
	elseif($category=="CAT B")
	{
		if($city=="Delhi" || $city=="Noida" || $city=="Gurgaon" || $city=="Faridabad" || $city=="Gaziabad")
		{
		if($net_salary<=25000)
			{
				$interestrate = "32%";
				$intr=32/1200;
			}
		elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "30%";
				$intr=30/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "25%";
				$intr=25/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=70000)
			{
				$interestrate = "22%";
				$intr=22/1200;
				
			}
			elseif($net_salary>70000)
			{
				$interestrate = "21%";
				$intr=21/1200;
				
			}
			else
			{
			$interestrate = "32%";
			$intr=32/1200;
			}
		}
		else
		{
			if($net_salary<=25000)
			{
				$interestrate = "32%";
				$intr=32/1200;
			}
		elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "30%";
				$intr=30/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "25%";
				$intr=25/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=70000)
			{
				$interestrate = "22%";
				$intr=22/1200;
				
			}
			elseif($net_salary>70000 && $net_salary<100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
				
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			else
			{
			$interestrate = "32%";
			$intr=32/1200;
			}

		}
		if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 3;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 6;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 12;
				$getterm=4;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 12;
				$getterm=4;
			}
	}
	elseif($category=="CAT C")
	{
		if($city=="Delhi" || $city=="Noida" || $city=="Gurgaon" || $city=="Faridabad" || $city=="Gaziabad")
		{
		if($net_salary<=25000)
			{
				$interestrate = "32%";
				$intr=32/1200;
			}
		elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "30";
				$intr=30/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "25%";
				$intr=25/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=70000)
			{
				$interestrate = "22%";
				$intr=22/1200;
				
			}
			elseif($net_salary>70000 && $net_salary<100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
				
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
				
			}
			else
			{
				$interestrate = "32%";
				$intr=32/1200;
			}
	}
	else
		{	
			if($net_salary<=25000)
			{
				$interestrate = "34%";
				$intr=34/1200;
			}
		elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "30";
				$intr=30/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "25%";
				$intr=25/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "22%";
				$intr=22/1200;
				
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
				
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
				
			}
			else
			{
				$interestrate = "34%";
				$intr=34/1200;
			}

		}
		if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 3;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 6;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=4;
			}
			
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=4;
			}
	}
	elseif($category=="CAT D")
	{
		if($city=="Delhi" || $city=="Noida" || $city=="Gurgaon" || $city=="Faridabad" || $city=="Gaziabad")
		{
			if($net_salary<=25000)
			{
				$interestrate = "32%";
				$intr=32/1200;
			}
			elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "30%";
				$intr=30/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "25%";
				$intr=25/1200;
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			else
			{
				$interestrate = "32%";
				$intr=32/1200;
			}
		}
		else
		{
			if($net_salary<=25000)
			{
				$interestrate = "34%";
				$intr=34/1200;
			}
			elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "30%";
				$intr=30/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "25%";
				$intr=25/1200;
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			else
			{
				$interestrate = "34%";
				$intr=24/1200;
			}
		}
		if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 3;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 6;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=4;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=4;
			}
	}
	else
	{
		if($city=="Delhi" || $city=="Noida" || $city=="Gurgaon" || $city=="Faridabad" || $city=="Gaziabad")
		{
			if($net_salary<=25000)
			{
				$interestrate = "32%";
				$intr=32/1200;
			}
			elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "30%";
				$intr=30/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "25%";
				$intr=25/1200;
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			else
			{
				$interestrate = "32%";
				$intr=32/1200;
			}
		}
		else
		{
			if($net_salary<=25000)
			{
				$interestrate = "34%";
				$intr=34/1200;
			}
			elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "30%";
				$intr=30/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "25%";
				$intr=25/1200;
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			else
			{
				$interestrate = "34%";
				$intr=34/1200;
			}
		}
		if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 3;
				$getterm=1;
			}
			elseif($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=2;
			}
			elseif($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=4;
			}
		else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=4;

			}
	}

	if($city=='Delhi' || $city=='Faridabad' || $city=='Noida' || $city=='Gurgaon' || $city=='Gaziabad')
	{ 
		if($Loan_Amount_Eli>1500000)
		{
			$getloanamout=1500000;
		}
		else
		{
			$getloanamout=$Loan_Amount_Eli;
		}
	}	
//	other cities
	else
	{
		//echo "for other city";
		if($Loan_Amount_Eli>1500000)
		{
			$getloanamout=1500000;
		}
		else
		{
			$getloanamout=$Loan_Amount_Eli;
		}
	}


//echo "loan:".$getloanamout."intr: ".$intr."term: ".$term."<br>";
if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} 
$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

	}

	$alac=100000;
$peremicalc=round($alac * $intr / (1 - (pow(1/(1 + $intr), $term))));


$details[]=$interestrate;
//$details[]="N.A";
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$peremicalc;

return($details);
}//FULLERTON


function barclays($net_salary,$clubbed_emi,$company,$category,$DOB,$city)
{
	$princ="100000";
	list($term,$print_term)=getdob($DOB);
	//echo $term;

	if($clubbed_emi>0)
	{
		$exactnet_salary= ($net_salary*(.50)) - $clubbed_emi;
	}
	else
	{
		$exactnet_salary= $net_salary*(.50);
	}

if($exactnet_salary>0 )
	{
	//$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
	/*if(strlen($category)>0)
	{*/
		if($category=="Super A" || $category=="Cat A" || $category=="CAT A")
	{    

		if($net_salary<25000)
		{
			$interestrate = "18%";
			$intr=18/1200;
			

			if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			elseif($term==60)
			{
				$getterm=5;
			}
			elseif($term==72)
			{
				$getterm=6;
			}
			elseif($term==84)
			{
				$getterm=7;
			}
			else
			{
				$getterm=7;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;

		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}


$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
				
		}
		elseif($net_salary>=25000 && $net_salary<50000)
		{
			$interestrate = "17%";
			$intr=17/1200;

				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			elseif($term==60)
			{
				$getterm=5;
			}
			elseif($term==72)
			{
				$getterm=6;
			}
			elseif($term==84)
			{
				$getterm=7;
			}
			else
			{
				$getterm=7;
			}
if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;

		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		elseif($net_salary>=50000)
		{
			$interestrate = "16%";
			$intr=16/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			elseif($term==60)
			{
				$getterm=5;
			}
			elseif($term==72)
			{
				$getterm=6;
			}
			elseif($term==84)
			{
				$getterm=7;
			}
			else
			{
				$getterm=7;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;

		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
	}
	elseif($category=="Cat B" || $category=="CAT B")
		{
			if($net_salary<25000)
		{
			$interestrate = "19%";
			$intr=19/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			
			else
			{
				$getterm=4;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;

		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

		}
		elseif($net_salary>=25000 && $net_salary<50000)
		{
			$interestrate = "18%";
			$intr=18/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			
			else
			{
				$getterm=4;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;
if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

		}
		elseif($net_salary>=50000)
		{
			$interestrate = "17%";
			$intr=17/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			
			else
			{
				$getterm=4;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}


		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;
if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

		}
		}
	elseif($category=="Cat C" || $category=="CAT C")
		{
			if($net_salary<25000)
		{
			$interestrate = "24%";
			$intr=24/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			
			else
			{
				$getterm=4;
			}
if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;

		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

		}
		elseif($net_salary>=25000 && $net_salary<50000)
		{
			$interestrate = "20%";
			$intr=20/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			
			else
			{
				$getterm=4;
			}
if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;
		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		elseif($net_salary>=50000)
		{
			$interestrate = "18%";
			$intr=18/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			
			else
			{
				$getterm=4;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;

		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		}
	
	else
		{
		if($net_salary<25000)
		{
			$interestrate = "24%";
			$intr=24/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			
			else
			{
				$getterm=4;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;
		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}



$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

		}
		elseif($net_salary>=25000 && $net_salary<50000)
		{
			$interestrate = "20%";
			$intr=20/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			
			else
			{
				$getterm=4;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;
		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		elseif($net_salary>=50000)
		{
			$interestrate = "18%";
			$intr=18/1200;
				if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			
			else
			{
				$getterm=4;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}elseif($getterm==6){	$term=72;}elseif($getterm==7){	$term=84;}

		$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$Loan_Amount_Eli=($exactnet_salary/$emicalc)*100000;

		if($Loan_Amount_Eli>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}

		}
	}
	
	//}
	/*	else
	{
		echo "not eligibile";
	}*/
	
$alac=100000;
$peremicalc=round($alac * $intr / (1 - (pow(1/(1 + $intr), $term))));


	$details[]=$interestrate;
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;
	//$details[]=$peremicalc;

return($details);
}

function ingVyasyaLoans ($cat, $net_salary, $account_holder,$age,$other_emi,$Loan_Amount,$getCompany_Name)
{
	//echo $cat."-".$net_salary."-".$account_holder."-".$age."-".$other_emi."-".$Loan_Amount."-".$getCompany_Name;
	list($term,$print_term)=getdobING($age);

	$category = $cat;
	$company_name = strtolower($getCompany_Name);
	
	
	if($category=="CAT A")
	{
		if($net_salary>=75000)
		{
			if($account_holder==1)
			{
				$interestrate = "14.50%";
				$intr=14.50/1200;
			}
			else
			{
				$interestrate = "14.50%";
				$intr=14.50/1200;
			}
		}
		else if($net_salary>40000 && $net_salary<75000 )
		{
			if($account_holder==1)
			{
				$interestrate = "15.25%";
				$intr=15.25/1200;
			}
			else
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
		}
		else if($net_salary>25000 && $net_salary<=40000 )
		{
			$term = 36;
			$print_term=3;
			if($account_holder==1)
			{
				$interestrate = "16.75%";
				$intr=16.75/1200;
			}
			else
			{
				$interestrate = "17.25%";
				$intr=17.25/1200;
			}
		}
		else if($net_salary<=25000)
		{
			$term = 36;
			$print_term=3;
			if($account_holder==1)
			{
				$interestrate = "17.75%";
				$intr=17.75/1200;
			}
			else
			{
				$interestrate = "18.75%";
				$intr=18.75/1200;
			}
			//else
			//{
				//$interestrate = "17.50%";
				//$intr=17.5/1200;
			//}
		}		
		else
		{
			$intr="";
		}
	}
	else if($category=="CAT B")
	{
		if($net_salary>=75000)
		{
			if($account_holder==1)
			{
				$interestrate = "15.25%";
				$intr=15.25/1200;
			}
			else
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
		}
		else if($net_salary>40000 && $net_salary<75000 )
		{
			if($account_holder==1)
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
			else
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
			}
		}
		else if($net_salary>25000 && $net_salary<=40000 )
		{
			$term = 36;
			$print_term=3;

			if($account_holder==1)
			{
				$interestrate = "16.75%";
				$intr=16.75/1200;
			}
			else
			{
				$interestrate = "17.25%";
				$intr=17.25/1200;
			}
		}
		else if($net_salary<=25000)
		{
			$term = 36;
			$print_term=3;
			if($account_holder==1)
			{
				$interestrate = "18.75%";
				$intr=18.75/1200;
			}
			else
			{
				$intr="";
			}
			//else
			//{
				//$interestrate = "17.50%";
				//$intr=17.5/1200;
			//}
		}		
		else
		{
			$intr="";
		}
	
	}
	else if($category=="CAT C")
	{
//			echo "<br>//// bb  //// ".$term."---".$print_term;
		if($print_term>3)
		{
			$term = 36;
			$print_term=3;
		}
				//	echo "<br>".$term."---".$print_term;
		if($net_salary>75000)
		{
			if($account_holder==1)
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
			else
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
			}
		}
		else if($net_salary>40000 && $net_salary<=75000 )
		{
			if($account_holder==1)
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
			}
			else
			{
				$interestrate = "16.75%";
				$intr=16.75/1200;
			}
		}
		else if($net_salary>25000 && $net_salary<=40000 )
		{
			if($account_holder==1)
			{
				$interestrate = "17.75%";
				$intr=17.75/1200;
			}
			else
			{
			//	$interestrate = "18.0%";
				//$intr=18/1200;
			}
		}
		else if($net_salary<=25000)
		{
			if($account_holder==1)
			{
				$interestrate = "18.75%";
				$intr=18.75/1200;
			}
			else
			{
				$intr="";
			}
			//else
			//{
				//$interestrate = "17.50%";
				//$intr=17.5/1200;
			//}
		}		
		else
		{
			$intr="";
		}	
	}
	else
	{
		$intr="";
	}
	
	if($getCompany_Name=="ing vysya bank")
	{		
		$interestrate = "14.50%";
		$intr=14.5/1200;
	}		

	$princ=100000;

	$emicalc = round(($princ * $intr / (1 - (pow(1/(1 + $intr), $term)))),2);
//echo "<br>".$term."- emicalc: ".$emicalc."<br>";
	if($category=="CAT A")
	{
	
		if($net_salary>60000)
		{
			//echo "-1-1-";
			$firstnet_salary=($net_salary * (60/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else if($net_salary < 60000 && $net_salary > 40000)
		{
			//echo "-2-2-";

			$firstnet_salary=($net_salary* (55/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else
		{
			//echo "-3-3-";
			$firstnet_salary=($net_salary* (40/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}

		$firstloan_amount = round($firstloanamount,3) * $princ; 
	//	echo "<br>firstnet_salary: ".$firstnet_salary."<br>";
		//echo "<br>firstloanamount: ".$firstloanamount."<br>";
	
		if($Loan_Amount>1500000 )
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 15;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
		else
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 15;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}

	}
	else if($category=="CAT B")
	{
		if($net_salary>60000)
		{
			$firstnet_salary=($net_salary * (55/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else if($net_salary<60000 && $net_salary>40000)
		{
			$firstnet_salary=($net_salary * (50/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else
		{
			$firstnet_salary=($net_salary * (40/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		$firstloan_amount = round($firstloanamount,3) * $princ; 
		if($Loan_Amount>1000000)
		{
			if($firstloan_amount>1000000)
			{
				
				$finalLoanAmount = 1000000;
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 10;		
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
		else
		{
			if($firstloan_amount>1000000)
			{
				$finalLoanAmount = 1000000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 10;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
	
	}
	else if($category=="CAT C")
	{
//	echo $net_salary;
	//	echo "<br>";
		$firstnet_salary=($net_salary * (40/100));
	//	echo "<br>";
		 $firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		
		$firstloan_amount = round($firstloanamount,3) * $princ; 
		if($Loan_Amount>700000)
		{
			if($firstloan_amount>700000)
			{
				$finalLoanAmount = 700000;
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 7;		
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
		else
		{
			if($firstloan_amount>700000)
			{
				$finalLoanAmount = 700000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 7;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
	}
		
		$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
	//echo "<br>firstnet_salary: ".$firstnet_salary."<br>";
		//echo "<br>firstloanamount: ".$firstloanamount."<br>";
	
	if($account_holder==1)
	{
		$Processing_Fee = "1.5 %";
	}
	else
	{
		$Processing_Fee = "2 %";
	}
	if($company_name=="ing vysya bank")
	{
		$Processing_Fee = "NIL";
	}
	$details[]=$interestrate;
	$details[]=$finalLoanAmount;
	$details[]=$emicalc;
	$details[]=$term/12;
	//$details[]=$Processing_Fee;
//print_r($details);

	return($details);

}//ING VYSAYA

function getdobING($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18))
		{
			$term = 60;
			$print_term = "5";
			//$term = 48;
			//$print_term = "4";
		}
		else if(($DOB>50 && $DOB<=54))
		{
			$term = 60;
			$print_term = "5";
		}
		else if(($DOB>=50 && $DOB<=55))
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

function hdbfcLoans ($cat, $net_salary, $account_holder,$age,$other_emi,$Loan_Amount)
{
	$princ = 100000;

	//echo "<br>".$company_name."--".$net_salary."--". $account_holder."--".$age."--".$other_emi."--".$Loan_Amount."<br>";
	//check Company list
	//$checkCompanySql = "select * from hdbfc_companylist where company_name = '".$company_name."' and status=1";
	//$checkCompanyQuery = ExecQuery($checkCompanySql);
	//$category = mysql_result($checkCompanyQuery,0,'category');
	//echo "<br>".$checkCompanySql;
	//echo "<br>".$category;
		$category = $cat;
	list($term,$print_term)=getdobHDBFS($age);
	//echo "<br>".$term."---".$print_term;
	
	if($category=="Cat A")
	{
		if($net_salary>=75000)
		{
			$interestrate = "16%";
			$intr=16/1200;
			$Processing_Fee = "1 %";
		}
		else if($net_salary>=50000 && $net_salary<75000 )
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "1.5 %";
		}
		else if($net_salary>=35000 && $net_salary<50000 )
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "2 %";
		}
		else if($net_salary>=25000 && $net_salary<35000 )
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}		
		else if($net_salary>=20000 && $net_salary<25000)
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}		
		else
		{
			$intr="";
		}
	}
	else if($category=="Cat B")
	{
		if($term==60) { $term=48; $print_term = "4";  }
		
		if($net_salary>=75000)
		{
			$interestrate = "16%";
			$intr=16/1200;
			$Processing_Fee = "1 %";
		}
		else if($net_salary>=50000 && $net_salary<75000 )
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "1.5 %";
		}
		else if($net_salary>=35000 && $net_salary<50000 )
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "2 %";
		}
		else if($net_salary>=25000 && $net_salary<35000 )
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}		
		else if($net_salary>=20000 && $net_salary<25000)
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}		
		else
		{
			$intr="";
		}
	}
	else if($category=="Cat C" || $category=="")
	{
		if($term==60) { $term=36; $print_term = "3";  }
		if($term==48) { $term=36; $print_term = "3";  }
	
		
		if($net_salary>=75000)
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "1 %";
		}
		else if($net_salary>=50000 && $net_salary<75000 )
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "1.5 %";
		}
		else if($net_salary>=35000 && $net_salary<50000 )
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}
		else if($net_salary>=25000 && $net_salary<35000 )
		{
			$interestrate = "21%";
			$intr=21/1200;
			$Processing_Fee = "2 %";
		}		
		else if($net_salary>=20000 && $net_salary<25000)
		{
			$interestrate = "21%";
			$intr=21/1200;
			$Processing_Fee = "2 %";
		}		
		else
		{
			$intr="";
		}
	}
	else
	{
		$intr="";
		$princ = 0;
	}
	
	
	$emicalc = round(($princ * $intr / (1 - (pow(1/(1 + $intr), $term)))),2);
	//echo "<br>".$term."- emicalc: ".$emicalc."<br>";
	if($category=="Cat A")
	{
	//echo "<br>net_salary: ".$net_salary."<br>";
		if($net_salary>25000)
		{
			//echo "-1-1-";
			if($term==60) { $multiplier = 18; } else if($term==48) { $multiplier = 15; } else if($term==36) { $multiplier = 13; } else if($term==24) {	$multiplier = 9; } else if($term==12) {	$multiplier = 5;}
		///	echo "<br>Term: ".$term."<br>";
		//	echo "<br>net_salary: ".$net_salary."<br>";
		//	echo "<br>other_emi: ".$other_emi."<br>";
			//echo "<br>multiplier: ".$multiplier."<br>";
			$firstnet_salary =(($net_salary - $other_emi) * $multiplier);
			//$firstloanamount=($firstnet_salary)/$emicalc;
			$firstloanamount= $firstnet_salary;
		//echo "<br>firstnet_salary: ".$firstnet_salary."<br>";
		//	echo "<br>firstloanamount: ".$firstloanamount."<br>";
	
		}
		else
		{
			//echo "-3-3-";
			if($term==60) { $multiplier = 15; } else if($term==48) { $multiplier = 13; } else if($term==36) { $multiplier = 11; } else if($term==24) {	$multiplier = 9; } else if($term==12) { $multiplier = 5;	}
			
			$firstnet_salary=(($net_salary - $other_emi) * $multiplier);
			//$firstloanamount=($firstnet_salary)/$emicalc;
			$firstloanamount= $firstnet_salary;
		}

		$firstloan_amount = $firstloanamount; 
	//	echo "<br>firstnet_salary: ".$firstnet_salary."<br>";
	//	echo "<br>firstloanamount: ".$firstloanamount."<br>";
	
		if($Loan_Amount>1500000 )
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 15;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
		else
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 15;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}

	}
	else if($category=="Cat B")
	{
		
		if($net_salary>25000)
		{
			//echo "-1-1-";
			if($term==48) { $multiplier = 13; } else if($term==36) { $multiplier = 11; } else if($term==24) {	$multiplier = 9; } else if($term==12) {	$multiplier = 5;}
			
			$firstnet_salary=(($net_salary - $other_emi) * $multiplier);
			//$firstloanamount=($firstnet_salary)/$emicalc;
			$firstloanamount= $firstnet_salary;
		}
		else
		{
			//echo "-3-3-";
			if($term==48) { $multiplier = 13; } else if($term==36) { $multiplier = 11; } else if($term==24) {	$multiplier = 9; } else if($term==12) {	$multiplier = 5;}			
			$firstnet_salary=(($net_salary - $other_emi) * $multiplier);
			//$firstloanamount=($firstnet_salary)/$emicalc;
			$firstloanamount= $firstnet_salary;
		}

		
		$firstloan_amount = $firstloanamount; 
		if($Loan_Amount>1500000)
		{
			if($firstloan_amount>1500000)
			{
				
				$finalLoanAmount = 1500000;
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 10;		
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
		else
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 10;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
	
	}
	else if($category=="Cat C" || $category=="")
	{
//	echo $net_salary;
	//	echo "<br>";
		if($term==36) { $multiplier = 9; } else if($term==24) {	$multiplier = 7; } else if($term==12) { $multiplier = 5;	}
			
		$firstnet_salary=(($net_salary - $other_emi) * $multiplier);
		//$firstloanamount=($firstnet_salary)/$emicalc;
		$firstloanamount= $firstnet_salary;
		
		$firstloan_amount = $firstloanamount; 
		if($Loan_Amount>1500000)
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 7;		
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
		else
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 7;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
	}
	else
	{
		$finalLoanAmount = 0;
	}
		
		//echo "<br><b>".$interestrate."---".$firstloan_amount."---".$finalLoanAmount."---".$intr."------".$term."</b><br>";
		$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
	//echo "<br>firstnet_salary: ".$firstnet_salary."<br>";
		//echo "<br>firstloanamount: ".$firstloanamount."<br>";
	
	$details[]=$interestrate;
	$details[]=$finalLoanAmount;
	$details[]=$emicalc;
	$details[]=$term/12;
	//$details[]=$Processing_Fee;
//print_r($details);

	return($details);

}//HDBFS

function getdobHDBFS($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18))
		{
			$term = 60;
			$print_term = "5";
			//$term = 48;
			//$print_term = "4";
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

function icicibank($net_salary,$company,$category,$DOB,$Company_Type,$Primary_Acc)
{
	 $exactnet_salary= $net_salary - $clubbed_emi;

	list($term,$print_term)=getdobING($DOB);
//echo "h:".$category."<br>";
	$gtcropcomp="Select interest_rate,	processing_fee From pl_company_icici Where (company_name like '%".$company."%' and interest_rate>0)";
	//echo $gtcropcomp."<br>";
	$gtcropcompresult=ExecQuery($gtcropcomp);
	$icicirow=mysql_fetch_array($gtcropcompresult);
	$crprecordcount = mysql_num_rows($gtcropcompresult);

if($crprecordcount>0)
	{
	list($main,$gen) = split('[.]', $icicirow["interest_rate"]);
	if($gen==00)
		{
			$interestrate = $main." %";
		}
		else
		{
$interestrate = $icicirow["interest_rate"]." %";
		}
		
	//	echo $interestrate."<br>";
			$intr=$icicirow["interest_rate"]/1200;
			
			$proc_Fee = $icicirow["processing_fee"];
	}
	else
	{
		if($category=="Elite" || $category=="SuperPrime" || $category=="Preferred")
		{
			if($net_salary>75000)
			{
				$interestrate = "15.50%";
				$intr=15.50/1200;

				if($category=="Elite" || $category=="SuperPrime")
				{
					$proc_Fee ="2%";
				}
				else
				{
					$proc_Fee ="2.25%";
				}
			}
			else if ($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16%";
				$intr=16/1200;

				if($category=="Elite" || $category=="SuperPrime")
				{
					$proc_Fee ="2%";
				}
				else
				{
					$proc_Fee ="2.25%";
				}
			}
			else if ($net_salary>30000 && $net_salary<=50000)
			{
				$interestrate = "17%";
				$intr=17/1200;

				if($category=="Elite" || $category=="SuperPrime")
				{
					$proc_Fee ="2%";
				}
				else
				{
					$proc_Fee ="2.25%";
				}
			}
			else if ($net_salary>20000 && $net_salary<=30000)
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
				$proc_Fee ="2.25%";
			
			}
			else
			{
				$interestrate = "18.50%";
				$intr=18.50/1200;
				$proc_Fee ="2.25%";
				
			}
		}
		else
		{
			if($net_salary>75000)
			{
				$interestrate = "15.50%";
				$intr=15.50/1200;
				$proc_Fee ="2.25%";
			}
			else if ($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="2.25%";
				
			}
			else if ($net_salary>30000 && $net_salary<=50000)
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2.25%";
			}
			else if ($net_salary>20000 && $net_salary<=30000)
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
				$proc_Fee ="2.25%";
			
			}
			else
			{
				$interestrate = "18.50%";
				$intr=18.50/1200;
				$proc_Fee ="2.25%";
			}
		}

	}
	//Calculate Term
	if($category=="Elite" || $category=="SuperPrime")
	{
		if($term>60)
		{
			$calcterm=60;
			$getterm=5;
		}
		else
		{	
			$calcterm=$term;
			$getterm=$print_term;
		}
	}
	else
	{
		if($term>48)
		{
			$calcterm=48;
			$getterm=4;
		}
		else
		{	
			$calcterm=$term;
			$getterm=$print_term;
		}
		
	}
$princ=100000;
	$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));
//Calculate Loan Amount
	if($net_salary<=50000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$finalloanamount=$firstnet_salary/$perlacemi * 100000;
		}
	else if($net_salary>50000 && $net_salary<=200000)
		{
			$firstnet_salary=($net_salary* (60/100));
			$finalloanamount=$firstnet_salary/$perlacemi * 100000;
		}
		else if($net_salary>200000)
		{
			$firstnet_salary=($net_salary* (65/100));
			$finalloanamount=$firstnet_salary/$perlacemi * 100000;
		}
	else
	{
		//$firstnet_salary=($net_salary* (55/100));
		//	$finalloanamount=$firstnet_salary/$perlacemi;
	}


//Exact Loan AMount
if($category=="Elite" || ($category=="SuperPrime" && (strncmp ("ICICI", $Primary_Acc,5))==0))
	{
		if($finalloanamount>=1500000)
		{
			$loan_amount=1500000;
		}
		else
		{
			$loan_amount=$finalloanamount;
		}
	}
	else if(($category=="SuperPrime" && (strncmp ("ICICI", $Primary_Acc,5))!=0) || ($category=="Preferred" && (strncmp ("ICICI", $Primary_Acc,5))==0))
	{
		if($finalloanamount>=1000000)
		{
			$loan_amount=1000000;
		}
		else
		{
			$loan_amount=$finalloanamount;
		}
	}
	else
	{
		if((strncmp ("ICICI", $Primary_Acc,5))==0)
		{
			if($finalloanamount>=1000000)
			{
				$loan_amount=1000000;
			}
			else
			{
				$loan_amount=$finalloanamount;
			}
		}
		else
		{
			if($finalloanamount>=700000)
			{
				$loan_amount=700000;
			}
			else
			{
				$loan_amount=$finalloanamount;
			}
		}
	}

$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));


$details[]=$interestrate;
	$details[]=round($loan_amount);
	$details[]=$getemicalc;
	$details[]=$getterm;
	//$details[]=$perlacemi;

	return($details);

}//ICICI BANK
?>