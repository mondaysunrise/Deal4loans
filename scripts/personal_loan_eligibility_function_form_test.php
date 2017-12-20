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
		if($category=="CAT A")
		{
			if($net_salary>=67000)
				{
					$interestrate = "13.75%";
					$intr=13.75/1200;
				}
				elseif($net_salary>=42000 && $net_salary<67000)
				{
					$interestrate = "14.75%";
					$intr=14.75/1200;
				}
				elseif($net_salary<42000)
				{
					$interestrate = "15%";
					$intr=15/1200;
				}				
		}
		elseif($category=="CAT B")
		{
				$interestrate = "15.25%";
				$intr=15.25/1200;				
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
	$details[]=$peremicalc;
	return($details);
}//CITIBANK


function hdfcbank($net_salary,$clubbed_emi,$company,$category,$DOB,$Company_Type,$Primary_Acc)
{
//echo "salasry: ".$net_salary."clubnbed: ".$clubbed_emi."company: ".$company."category: ".$category."DOB: ".$DOB."<br>";
	 $exactnet_salary= $net_salary;
	 $exactnet_salaryTO= $net_salary - $clubbed_emi;

	list($term,$print_term)=getdob($DOB);
//echo "term: ".$term."print_term".$print_term."<br>";

if( $exactnet_salary>0)
	{
	if(strlen($company)>3)
		{
	$gtcropcomp="Select interest_rate_csa ,interest_rate_noncsa From  pl_company_hdfc Where (company_name like '%".$company."%' and status=1)";
	//echo $gtcropcomp."<br>";
	$gtcropcompresult=ExecQuery($gtcropcomp);
	$icicirow=mysql_fetch_array($gtcropcompresult);
	$crprecordcount = mysql_num_rows($gtcropcompresult);
		}

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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
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
			$interestrate = "17.75%";
			$intr=17.75/1200;

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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
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
			$interestrate = "16.75%";
			$intr=16.75/1200;

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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}
			
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
	}
	elseif($category=="CAT GB" || $Company_Type==4)
			{
		if($exactnet_salary>50000)
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
			elseif($term==60)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=5;
			}
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}
			
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		elseif($exactnet_salary>=35000 && $exactnet_salary<=50000)
		{
			$interestrate = "16.75%";
			$intr=16.75/1200;

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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}
			
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;} elseif($getterm==5){	$term=60;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		elseif($exactnet_salary<35000)
		{
			$interestrate = "18.50%";
			$intr=18.50/1200;

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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
			}
	elseif($category=="CAT B" || $category=="CSA B")
	{
		if($exactnet_salary<=35000)
		{
			$interestrate = "17.75%";
			$intr=17.75/1200;

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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
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
			$interestrate = "16.75%";
			$intr=16.75/1200;

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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
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
	elseif($category=="CAT C" || $category=="CSA C")
	{
		if($exactnet_salary>=75000)
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
			elseif($exactnet_salary>=50000 && ($exactnet_salary<75000))
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
			}
			elseif($exactnet_salary>=35000 && ($exactnet_salary<50000))
			{
				$interestrate = "17%";
				$intr=17/1200;
			}
			elseif($exactnet_salary>=20000 && ($exactnet_salary<35000))
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
			}
			else
			{}
			
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
			if($Loan_Amount_Eli>2000000)
			{
				$getloanamout=2000000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
				
	}
	else
	{
		if($Company_Type==2)
				{
			if($exactnet_salary>=75000)
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
			elseif($exactnet_salary>=50000 && ($exactnet_salary<75000))
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
			}
			elseif($exactnet_salary>=35000 && ($exactnet_salary<50000))
			{
				$interestrate = "17%";
				$intr=17/1200;
			}
			elseif($exactnet_salary>=20000 && ($exactnet_salary<35000))
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
			}
			else
			{
				$interestrate = "18.50%";
				$intr=18.50/1200;
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
			 if($Primary_Acc=='HDFC')
				{
					if($Loan_Amount_Eli>2000000)
					{
						$getloanamout=2000000;
					}
					else
					{
						$getloanamout=$Loan_Amount_Eli;
					}
				}
				else
			{
				if($Loan_Amount_Eli>2000000)
					{
						$getloanamout=2000000;
					}
					else
					{
						$getloanamout=$Loan_Amount_Eli;
					}
			}
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

		}
			elseif($Company_Type==1)
		{
				$interestrate = "20%";
				$intr=20/1200;

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
		else
		{
		}//else
	}

} //special companies
//for clause above 10lacs
if($getloanamout>=1000000 && $exactnet_salary>=75000)
		{
			if($getloanamout>=2000000)
			{
				$interestrate = "11.99%";
				$intr=11.99/1200;
			}
			elseif($getloanamout>=1500000 && $getloanamout<2000000)
			{
				$interestrate = "13.25%";
				$intr=13.25/1200;
			}
			elseif($getloanamout>=1000000 && $getloanamout<1500000)
			{
				$interestrate = "13.75%";
				$intr=13.75/1200;
			}

			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
		else
		{
			if($getloanamout>1500000)
					{
						$getloanamout=1500000;
					}
					else
					{
						$getloanamout=$getloanamout;
					}

			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}

}//
$alac=100000;
$peremicalc=round($alac * $intr / (1 - (pow(1/(1 + $intr), $term))));

$details[]=$interestrate;
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$peremicalc;

	return($details);


}//HDFC BANK

function fullerton($net_salary,$clubbed_emi,$company,$category,$DOB,$city)
{
//echo "salasry: ".$net_salary."clubnbed: ".$clubbed_emi."company: ".$company."category: ".$category."DOB: ".$DOB."city: ".$city."<br>";
	if($clubbed_emi>0)
	{
		$exactnet_salary= ($net_salary*(.60)) - $clubbed_emi;
	}
	else
	{
		$exactnet_salary= round($net_salary * 60 / 100);
	}
	list($term,$print_term)=getdob($DOB);

if($print_term==1)	{$term=12; $getterm=1;}	elseif($print_term==2)	{$term=24; $getterm=2;}	elseif($print_term==3){$term=36; $getterm=3;}elseif($print_term==4 || $print_term>4 ){	$term=48; $getterm=4;}

	
if($exactnet_salary>0)
	{
			if($net_salary>=10000 && $net_salary<=18000)
			{
				$interestrate = "32%";
				$intr=$interestrate/1200;
			}
			elseif($net_salary>18000 && $net_salary<=25000)
			{
				$interestrate = "28%";
				$intr=$interestrate/1200;
			}
			elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "22%";
				$intr=$interestrate/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "19%";
				$intr=$interestrate/1200;
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16.5%";
				$intr=$interestrate/1200;
			}
			elseif($net_salary>75000 && $net_salary<=100000)
			{
				$interestrate = "16.5%";
				$intr=$interestrate/1200;
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "16.5%";
				$intr=$interestrate/1200;
			}
			else
			{
				$interestrate = "32%";
				$intr=$interestrate/1200;
			}
		
 		$applicableFOIR = $exactnet_salary;
		
		$princ=100000;
	$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
		$loanPossible= $applicableFOIR /$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
		$Loan_Amount_Eli = $viewLoanAmt ;
		


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
if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4 ){	$term=48;} 
$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

}
	$alac=100000;
$peremicalc=round($alac * $intr / (1 - (pow(1/(1 + $intr), $term))));


//$details[]=$interestrate;
if($net_salary>50000)
	{
		$details[]=$interestrate;
		//$details[]="N.A";
	}
	else
	{
		$details[]="21% - 32%";
	}
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$peremicalc;
	$details[]=$interestrate;

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
	$details[]=$peremicalc;

return($details);
}

function ingVyasyaLoans ($cat, $net_salary, $account_holder,$age,$other_emi,$Loan_Amount,$getCompany_Name)
{

	$princ = 100000;
	$company_name = strtolower($getCompany_Name);
	$category = $cat;	
	list($term,$print_term)=getdobING($age);

// added on 5dec 2012 for special rates
if(strlen($company_name)>3)
	{
	$gtcropcomp="Select interest_rate,	processing_fee From pl_company_ingvysya Where (company_name like '%".$company_name."%' and interest_rate>0)";
	//echo $gtcropcomp."<br>";
	$gtcropcompresult=ExecQuery($gtcropcomp);
	$icicirow=mysql_fetch_array($gtcropcompresult);
	$crprecordcount = mysql_num_rows($gtcropcompresult);

	//for SCO
	$gtscocomp="Select interest_rate_above50,interest_rate_less50,processing_fee From pl_company_ingvysya_sco Where (company_name like '%".$company_name."%' and interest_rate_above50>0 and status=1)";
	//echo $gtscocomp."<br>";
	$gtscocompresult=ExecQuery($gtscocomp);
	$ingscorow=mysql_fetch_array($gtscocompresult);
	$ingscorecordcount = mysql_num_rows($gtscocompresult);

	}
if($crprecordcount>0)
	{

	if($net_salary>=150000)
		{
			$interestrate = "13.75%";
			$intr=13.75/1200;
		}
		else if($net_salary>=100000 && $net_salary<150000)
		{
			$interestrate = "13.99%";
			$intr=13.99/1200;
			
		}
		else if($net_salary>=75000 && $net_salary<100000)
		{
			$interestrate = "14.25%";
			$intr=14.25/1200;
		}
		else
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
			$intr=$icicirow["interest_rate"]/1200;
		}
				
			$proc_Fee = $icicirow["processing_fee"];
	}
	elseif($ingscorecordcount>0)
	{
		if($net_salary>=50000)
		{
			$ingsco=$ingscorow["interest_rate_above50"];
		}
		else
		{
			$ingsco=$ingscorow["interest_rate_less50"];
		}
list($main,$gen) = split('[.]', $ingsco);
	if($gen==00)
		{
			$interestrate = $main." %";
		}
		else
		{
$interestrate = $ingsco." %";
		}
			$intr=$ingsco/1200;
		
		$proc_Fee = $ingscorow["processing_fee"];
	}
	else
	{ // added on 5dec 2012 for special rates
	if($category=="CAT A")
	{
		if($net_salary>=150000)
		{
			$interestrate = "13.75%";
			$intr=13.75/1200;
		}
		else if($net_salary>=100000 && $net_salary<150000)
		{
			$interestrate = "13.99%";
			$intr=13.99/1200;
			
		}
		else if($net_salary>=75000 && $net_salary<100000)
		{
			if($account_holder==1)
			{
				$interestrate = "14.25%";
				$intr=14.25/1200;
			}
			else
			{
				$interestrate = "14.25%";
				$intr=14.25/1200;
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
				$interestrate = "17.25%";
				$intr=17.25/1200;
			}
			else
			{
				$interestrate = "17.25%";
				$intr=17.25/1200;
			}
		}
		else if($net_salary==25000)
		{
			$term = 36;
			$print_term=3;
			if($account_holder==1)
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
			}
			else
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
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
		if($net_salary>=150000)
		{
			$interestrate = "13.75%";
			$intr=13.75/1200;
		}
		else if($net_salary>=100000 && $net_salary<150000)
		{
			$interestrate = "13.99%";
			$intr=13.99/1200;
			
		}
		else if($net_salary>=75000 && $net_salary<100000)
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
				$interestrate = "16.25%";
				$intr=16.25/1200;
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
				$interestrate = "17.25%";
				$intr=17.25/1200;
			}
			else
			{
				$interestrate = "17.25%";
				$intr=17.25/1200;
			}
		}
		else if($net_salary==25000)
		{
			$term = 36;
			$print_term=3;
			if($account_holder==1)
			{
				$interestrate = "19.25%";
				$intr=19.25/1200;
			}
			else
			{
				$interestrate = "19.25%";
				$intr=19.25/1200;
			}
			
		}		
		else
		{
			$intr="";
		}
	
	}
	else if($category=="CAT C")
	{

		if($print_term>3)
		{
			$term = 36;
			$print_term=3;
		}
			
		if($net_salary>=75000)
		{
			if($account_holder==1)
			{
				$interestrate = "14.99%";
				$intr=14.99/1200;
			}
			else
			{
				$interestrate = "14.99%";
				$intr=14.99/1200;
			}
		}
		else if($net_salary>40000 && $net_salary<75000 )
		{
			if($account_holder==1)
			{
				$interestrate = "16.75%";
				$intr=16.75/1200;
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
				$interestrate = "18.25%";
				$intr=18.25/1200;
			}
			else
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
			}
		}
		else if($net_salary==25000)
		{
			if($account_holder==1)
			{
				$interestrate = "19.25%";
				$intr=19.25/1200;
			}
			else
			{
				$interestrate = "19.25%";
				$intr=19.25/1200;
			}
		
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
	}
		
	
	$emicalc = round(($princ * $intr / (1 - (pow(1/(1 + $intr), $term)))),2);

if($category=="CAT A")
	{
		if($net_salary>60000)
		{
			$firstnet_salary=($net_salary * (60/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else if($net_salary < 60000 && $net_salary > 40000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else
		{
			$firstnet_salary=($net_salary* (40/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}

		$firstloan_amount = round($firstloanamount,3) * $princ; 
	
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
	$firstnet_salary=($net_salary * (40/100));
	$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		
		$firstloan_amount = round($firstloanamount,3) * $princ; 
		if($Loan_Amount>700000)
		{
			if($firstloan_amount>700000)
			{
				$finalLoanAmount = 700000;
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
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
	
	if($account_holder==1)
	{
		$Processing_Fee = "1.5 %";
	}
	else
	{
		$Processing_Fee = "1.5%";
	}
	if($company_name=="ing vysya bank")
	{
		$Processing_Fee = "NIL";
	}
	$details[]=$interestrate;
	$details[]=$finalLoanAmount;
	$details[]=$emicalc;
	$details[]=$term/12;
	$details[]=$Processing_Fee;
//print_r($details);

	return($details);

}//ING VYSAYA

//new ing vysya
function ingVyasyaLoans_nw ($cat, $net_salary, $account_holder,$age,$other_emi,$Loan_Amount,$getCompany_Name,$Company_Type)
{
	$princ = 100000;
	$company_name = strtolower($getCompany_Name);
	$category = $cat;	
	list($term,$print_term)=getdobING($age);

if(strlen($company_name)>3)
	{
// added on 5dec 2012 for special rates
	$gtcropcomp="Select interest_rate,	processing_fee From pl_company_ingvysya Where (company_name like '%".$company_name."%' and interest_rate>0)";
	//echo $gtcropcomp."<br>";
	$gtcropcompresult=ExecQuery($gtcropcomp);
	$icicirow=mysql_fetch_array($gtcropcompresult);
	$crprecordcount = mysql_num_rows($gtcropcompresult);

//for SCO
	$gtscocomp="Select interest_rate_above50,interest_rate_less50,processing_fee From pl_company_ingvysya_sco Where (company_name like '%".$company_name."%' and interest_rate_above50>0 and status=1)";
	//echo $gtcropcomp."<br>";
	$gtscocompresult=ExecQuery($gtscocomp);
	$ingscorow=mysql_fetch_array($gtscocompresult);
	$ingscorecordcount = mysql_num_rows($gtscocompresult);
	}

if($crprecordcount>0)
	{
	if($net_salary>=125000)
		{
		$interestrate = "13.75%";
			$intr=13.75/1200;
		}
		else if($net_salary>=100000 && $net_salary<125000)
		{
			$interestrate = "13.99%";
			$intr=13.99/1200;
		}
		else if($net_salary>=75000 && $net_salary<100000)
		{
			$interestrate = "14.25%";
			$intr=14.25/1200;
		}
		else
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
			$intr=$icicirow["interest_rate"]/1200;
		}
			$proc_Fee = $icicirow["processing_fee"];
	}
	elseif($ingscorecordcount>0)
	{
	if($net_salary>=125000)
		{
		$interestrate = "13.75%";
			$intr=13.75/1200;
		}
		else if($net_salary>=75000 && $net_salary<125000)
		{
			$interestrate = "13.99%";
			$intr=13.99/1200;
		}
		
	else
		{
		if($net_salary>=50000)
		{
			$ingsco=$ingscorow["interest_rate_above50"];
		}
		else
		{
			$ingsco=$ingscorow["interest_rate_less50"];
		}
list($main,$gen) = split('[.]', $ingsco);
	if($gen==00)
		{
			$interestrate = $main." %";
		}
		else
		{
$interestrate = $ingsco." %";
		}
			$intr=$ingsco/1200;
		
		$proc_Fee = $ingscorow["processing_fee"];
		}
	}
	
	else
	{ // added on 5dec 2012 for special rates
	if($category=="CAT A")
	{
		if($net_salary>=150000)
		{
			$interestrate = "13.75%";
			$intr=13.75/1200;
		}
		else if($net_salary>=100000 && $net_salary<150000)
		{
			$interestrate = "13.75%";
			$intr=13.75/1200;
			
		}
		else if($net_salary>=75000 && $net_salary<100000)
		{
			if($account_holder==1)
			{
				$interestrate = "13.99%";
				$intr=13.99/1200;
			}
			else
			{
				$interestrate = "13.99%";
				$intr=13.99/1200;
			}
		}
		else if($net_salary>40000 && $net_salary<75000)
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
		else if($net_salary==25000)
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
		if($net_salary>=150000)
		{
			$interestrate = "13.75%";
			$intr=13.75/1200;
		}
		else if($net_salary>=100000 && $net_salary<150000)
		{
			$interestrate = "13.75%";
			$intr=13.75/1200;			
		}
		else if($net_salary>=75000 && $net_salary<100000)
		{
			if($account_holder==1)
			{
				$interestrate = "14.25%";
				$intr=14.25/1200;
			}
			else
			{
				$interestrate = "14.25%";
				$intr=14.25/1200;
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
		else if($net_salary==25000)
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
				$interestrate = "19.25%";
				$intr=19.25/1200;
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
		if($net_salary>=75000)
		{
			if($account_holder==1)
			{
				$interestrate = "14.99%";
				$intr=14.99/1200;
			}
			else
			{
				$interestrate = "14.99%";
				$intr=14.99/1200;
			}
		}
		else if($net_salary>40000 && $net_salary<75000 )
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
			   $interestrate = "18.25%";
				$intr=18.25/1200;
			}
		}
		else if($net_salary==25000)
		{
			if($account_holder==1)
			{
				$interestrate = "18.75%";
				$intr=18.75/1200;
			}
			else
			{
				$interestrate = "19.25%";
				$intr=19.25/1200;
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
		
		if($Company_Type==4 || $Company_Type==5)
		{
			if($net_salary>=150000)
		{
			$interestrate = "13.75%";
			$intr=13.75/1200;
		}
		else if($net_salary>=100000 && $net_salary<150000)
		{
			$interestrate = "13.75%";
			$intr=13.75/1200;			
		}
		else if($net_salary>=75000 && $net_salary<100000)
		{
			$interestrate = "13.99%";
			$intr=13.99/1200;			
		}
		elseif($net_salary>=50000 && $net_salary<75000)
		{
			$interestrate = "15%";
			$intr=15/1200;
		}
		else
		{
			$interestrate = "15.50%";
			$intr=15.5/1200;
		}
		}
		elseif($Company_Type==2)
		{
				if($print_term>3)
				{
					$term = 36;
					$print_term=3;
				}
						//	echo "<br>".$term."---".$print_term;
				if($net_salary>=75000)
				{
					if($account_holder==1)
					{
						$interestrate = "14.99%";
						$intr=14.99/1200;
					}
					else
					{
						$interestrate = "14.99%";
						$intr=14.99/1200;
					}
				}
				else if($net_salary>40000 && $net_salary<75000 )
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
					   $interestrate = "18.25%";
						$intr=18.25/1200;
					}
				}
				else if($net_salary==25000)
				{
					if($account_holder==1)
					{
						$interestrate = "18.75%";
						$intr=18.75/1200;
					}
					else
					{
						$interestrate = "19.25%";
						$intr=19.25/1200;
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
	}
	}
		
	$emicalc = round(($princ * $intr / (1 - (pow(1/(1 + $intr), $term)))),2);

if($category=="CAT A")
	{
		if($net_salary>60000)
		{
			$firstnet_salary=($net_salary * (65/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else if($net_salary < 60000 && $net_salary > 40000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else
		{
			$firstnet_salary=($net_salary* (50/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}

		$firstloan_amount = round($firstloanamount,3) * $princ; 
	
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
			$firstnet_salary=($net_salary * (60/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else if($net_salary<60000 && $net_salary>40000)
		{
			$firstnet_salary=($net_salary * (55/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		else
		{
			$firstnet_salary=($net_salary * (50/100));
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
			$firstnet_salary=($net_salary * (45/100));
			$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		}
		
		$firstloan_amount = round($firstloanamount,3) * $princ; 
		if($Loan_Amount>700000)
		{
			if($firstloan_amount>700000)
			{
				$finalLoanAmount = 700000;
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
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
	else
	{
		$firstnet_salary=($net_salary * (45/100));
	$firstloanamount=($firstnet_salary-$other_emi)/$emicalc;
		
		$firstloan_amount = round($firstloanamount,3) * $princ; 
		if($Loan_Amount>700000)
		{
			if($firstloan_amount>700000)
			{
				$finalLoanAmount = 700000;
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
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
	$details[]=$Processing_Fee;
//print_r($details);

	return($details);

}//ING VYSAYA

//ing end function

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
$category = $cat;
	list($term,$print_term)=getdobHDBFS($age);
	
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
	
	if($category=="Cat A")
	{
	if($net_salary>25000)
		{
			if($term==60) { $multiplier = 18; } else if($term==48) { $multiplier = 15; } else if($term==36) { $multiplier = 13; } else if($term==24) {	$multiplier = 9; } else if($term==12) {	$multiplier = 5;}
			$firstnet_salary =(($net_salary - $other_emi) * $multiplier);
			$firstloanamount= $firstnet_salary;
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
	$details[]=$Processing_Fee;
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
	 $exactnet_salary= $net_salary;
	list($term,$print_term)=getdob($DOB);
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
		
			$intr=$icicirow["interest_rate"]/1200;			
			$proc_Fee = $icicirow["processing_fee"];
	}
	else
	{
		if($category=="Elite" || $category=="SuperPrime")
		{
			if($net_salary>75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="2%";			
			}
			else if ($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
				$proc_Fee ="2%";
			}
			else if ($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2.25%";
			}
			else if ($net_salary>20000 && $net_salary<=35000)
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
				$proc_Fee ="2.25%";			
			}
			elseif($net_salary<=20000)
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
				$proc_Fee ="2.25%";				
			}
			else
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
				$proc_Fee ="2.25%";				
			}
		}
		else if($category=="Preferred")
		{
			if($net_salary>75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="2%";			
			}
			else if ($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
				$proc_Fee ="2%";
			}
			else if ($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2.25%";
			}
			else if ($net_salary>20000 && $net_salary<=35000)
			{
				$interestrate = "18%";
				$intr=18/1200;
				$proc_Fee ="2.25%";			
			}
			elseif($net_salary<=20000)
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
				$proc_Fee ="2.25%";				
			}
			else
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
				$proc_Fee ="2.25%";	
			}
		}
		else
		{
			if($Company_Type==4)
			{
				 if($net_salary>50000)
				{
					$interestrate = "15.50%";
					$intr=15.50/1200;
					$proc_Fee ="2%";
				}
				else if($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = "16.50%";
					$intr=16.50/1200;
					$proc_Fee ="2.25%";
				}
				else if($net_salary>20000 && $net_salary<=35000)
				{
					$interestrate = "18%";
					$intr=18/1200;
					$proc_Fee ="2.25%";
				}
				elseif($net_salary<=20000)
				{
					$interestrate = "18.50%";
					$intr=18.50/1200;
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
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2%";			
			}
			else if($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "17.25%";
				$intr=17.25/1200;
				$proc_Fee ="2%";
			}
			else if($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "17.50%";
				$intr=17.50/1200;
				$proc_Fee ="2.25%";
			}
			else if($net_salary>20000 && $net_salary<=35000)
			{
				$interestrate = "18.25%";
				$intr=18.25/1200;
				$proc_Fee ="2.25%";
			}
			elseif($net_salary<=20000)
			{
				$interestrate = "18.50%";
				$intr=18.50/1200;
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
	else if($category=="Preferred")
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
	else
	{
		if($term>36)
		{
			$calcterm=36;
			$getterm=3;
		}
		else
		{	
			$calcterm=$term;
			$getterm=$print_term;
		}		
	}
$princ=100000;
	$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));

###################################################################################################
//Calculate Loan Amount 
	if($net_salary>=50000)
		{
			$firstnet_salary=($net_salary* (65/100));
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else if($net_salary<50000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else
	{}
	
###other method###########################################
if($category=="Elite" || $category=="SuperPrime")
	{
		if($calcterm>=49 && $calcterm<=60)
		{ 
			$loan_amt=$net_salary*18;
		}
		elseif($calcterm>=37 && $calcterm<=48)
		{ 
			$loan_amt=$net_salary*15;
		}
		elseif($calcterm>=25 && $calcterm<=36)
		{ 
			$loan_amt=$net_salary*13;
		}
		elseif($calcterm>=24 && $calcterm<=13)
		{ 
			$loan_amt=$net_salary*9;
		}
		elseif($calcterm<=12)
		{	
			$loan_amt=$net_salary*5;
		}
	}
	else if($category=="Preferred")
	{
		if($calcterm>=49 && $calcterm<=60)
		{ 
			$loan_amt="";
		}
		elseif($calcterm>=37 && $calcterm<=48)
		{ 
			$loan_amt=$net_salary*13;
		}
		elseif($calcterm>=25 && $calcterm<=36)
		{ 
			$loan_amt=$net_salary*11;
		}
		elseif($calcterm>=24 && $calcterm<=13)
		{ 
			$loan_amt=$net_salary*9;
		}
		elseif($calcterm<=12)
		{	
			$loan_amt=$net_salary*5;
		}
	}
	else
	{
		if($calcterm>=49 && $calcterm<=60)
		{ 
			$loan_amt="";
		}
		elseif($calcterm>=37 && $calcterm<=48)
		{ 
			$loan_amt="";
		}
		elseif($calcterm>=25 && $calcterm<=36)
		{ 
			$loan_amt=$net_salary*9;
		}
		elseif($calcterm>=24 && $calcterm<=13)
		{ 
			$loan_amt=$net_salary*7;
		}
		elseif($calcterm<=12)
		{	
			$loan_amt=$net_salary*5;
		}
		
	}
if($loan_amt>0 && $loan_amt1>0)
	{
		if($loan_amt>=$loan_amt1)
		{
			$finalloanamount=$loan_amt1;
		}
		else
		{
			$finalloanamount=$loan_amt;
		}
	}
	else
	{	
		if($loan_amt>0)
		{
			$finalloanamount=$loan_amt;
		}
		if($loan_amt1>0)
		{
			$finalloanamount=$loan_amt1;
		}

	}
		//echo "<br><br>here 3 : <br><br>".$loan_amt;
#######################################################################################################
//Exact Loan Amount
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
/*****Special Clause*******************************************/
if($loan_amount>=1500000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred"))
	{
		$interestrate = "13.50%";
		$intr=13.50/1200;
		$proc_Fee ="0.50%";
	}
	elseif(($loan_amount>1000000 && $loan_amount<1500000) && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred"))
	{
		$interestrate = "13.75%";
		$intr=13.75/1200;
		$proc_Fee ="0.50%";

	}
//echo "<br><br>here2 : <br><br>";

##################################################################################
/*for ICICI employees*/
$comppos = strpos($company, 'ICICI');
//echo "<br><br>here : <br><br>";
if(isset($comppos) && $comppos>0 && $loan_amount>1000000)
	{
	//echo "here";
	if($loan_amount>1000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred"))
	{
		$interestrate = "14%";
		$intr=14/1200;
		$proc_Fee ="999";
	}
	}

###################################################################################
/************************************************/

$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));
$details[]=$interestrate;
	$details[]=round($loan_amount);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$perlacemi;

	return($details);

}//ICICI BANK FUNC

function indusindbank($strnet_salary,$company,$category,$DOB,$clubbed_emi)
{
	 $net_salary = $strnet_salary - $clubbed_emi;

	list($term,$print_term)=getdob($DOB);
	
	if($category=="A+" || $category=="CAT A")
		{
			if($net_salary>=100000)
			{
				$interestrate = "14%";
				$intr=14/1200;
			}
			else if($net_salary>=50000 && $net_salary<100000)
			{
				$interestrate = "14.5%";
				$intr=14.5/1200;
			}
			else if($net_salary>=25000 && $net_salary<=50000)
			{
				$interestrate = "16%";
				$intr=16/1200;
			}
			else
			{	}
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
			else
			{
				$getterm=5;
			}

		}
		else if($category=="CAT B")
		{
			if($net_salary>=100000)
			{
				$interestrate = "14.5%";
				$intr=14.5/1200;
			}
			else if($net_salary>=50000 && $net_salary<100000)
			{
				$interestrate = "15%";
				$intr=15/1200;
			}
			else if($net_salary>=25000 && $net_salary<=50000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
			}
			else
			{			}
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
		}
		else if($category=="CAT C" || $category=="CAT G" || $category=="C1000")
		{
			if($net_salary>=100000)
			{
				$interestrate = "15%";
				$intr=15/1200;
			}
			else if($net_salary>=50000 && $net_salary<100000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
			}
			else if($net_salary>=25000 && $net_salary<=50000)
			{
				$interestrate = "16.5%";
				$intr=16.5/1200;
			}
			else
			{
			}
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
			}
			else
	{
			if($net_salary>=100000)
			{
				$interestrate = "15%";
				$intr=15/1200;
			}
			else if($net_salary>=50000 && $net_salary<100000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
			}
			else if($net_salary>=25000 && $net_salary<=50000)
			{
				$interestrate = "16.5%";
				$intr=16.5/1200;
			}
			else
			{
			}
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
	}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
		
$princ=100000;

	$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
	//echo $perlacemi."<br>";
//Calculate Loan Amount
	if($net_salary<=50000)
		{
			$firstnet_salary=($net_salary* (50/100));
			$newnet_salary= $firstnet_salary;
			$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
		}
	else if($net_salary>50000 && $net_salary<75000)
		{
			$firstnet_salary=($net_salary* (60/100));
			$newnet_salary= $firstnet_salary;
			$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
		}
		else if($net_salary>=75000)
		{
			$firstnet_salary=($net_salary* (70/100));
			$newnet_salary= $firstnet_salary;
			$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
		}
	else
	{}
	//other eiligibility
$finalloanamount_other=$net_salary*10;
	
	if($finalloanamount_other<$finalloanamount_dbr)
	{
		$finalloanamount=$finalloanamount_other;
	}
	else
	{
		$finalloanamount=$finalloanamount_dbr;
	}
		if($finalloanamount>1500000)
			{
				if(strlen($category)>1)
				{
				$getloanamout=1500000;
				}
				else
				{
					$getloanamout=700000;
				}
			}
			else
			{
				if(strlen($category)>1)
				{
				$getloanamout=$finalloanamount;
				}
				else
				{
					if($finalloanamount>700000)
					{
						$getloanamout=700000;
					}
					else
					{
						$getloanamout=$finalloanamount;
					}
				}
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
$details[]=$interestrate;
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$perlacemi;

	return($details);

}//IndusiNd BANK

function kotakbank($net_salary,$company,$category,$DOB,$Company_Type,$Primary_Acc)
{
	list($term,$print_term)=getdob($DOB);

if($term==12)
			{
				$getterm=1;
				$term=12;
			}
			elseif($term==24)
			{
				$getterm=2;
				$term=24;
			}
			elseif($term==36)
			{
				$getterm=3;
				$term=36;
			}
			elseif($term==48)
			{
				$getterm=4;
				$term=48;
			}
			elseif($term>=60)
			{
				$getterm=5;
				$term=60;
			}
			else
			{
				$getterm=5;
				$term=60;
			}
		
	if($category=="CAT A" || $category=="CAT C" || $category=="CAT B")
		{
			if($category=="CAT A")
			{
				$interestrate = "14.15%";
				$intr=15/1200;
			}
			elseif($category=="CAT B")
			{
				$interestrate = "14.70%";
				$intr=14.70/1200;
			}
			elseif($category=="CAT C")
			{
				$interestrate = "15.65%";
				$intr=15.65/1200;
			}

$princ=100000;

$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
			if($net_salary<=40000)
				{
					$firstnet_salary=($net_salary* (60/100));
					$newnet_salary= $firstnet_salary;
					$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
				}
			else if($net_salary>40000 && $net_salary<=69500)
				{
					$firstnet_salary=($net_salary* (65/100));
					$newnet_salary= $firstnet_salary;
					$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
				}
				else if($net_salary>75000)
				{
					$firstnet_salary=($net_salary* (70/100));
					$newnet_salary= $firstnet_salary;
					$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
				}
			else
			{}
		}
		elseif($category=="CAT D")
		{
			$interestrate = "18%";
			$intr=18/1200;

$princ=100000;

	$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
				if($net_salary<=40000)
			{
				$firstnet_salary=($net_salary* (50/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
		else if($net_salary>40000 && $net_salary<=69500)
			{
				$firstnet_salary=($net_salary* (60/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
			else if($net_salary>75000)
			{
				$firstnet_salary=($net_salary* (65/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
			else
			{}
		}
		else
		{
			$interestrate = "18%";
			$intr=18/1200;

$princ=100000;

	$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

			if($net_salary<=40000)
			{
				$firstnet_salary=($net_salary* (50/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
		else if($net_salary>40000 && $net_salary<=69500)
			{
				$firstnet_salary=($net_salary* (60/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
			else if($net_salary>75000)
			{
				$firstnet_salary=($net_salary* (65/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
			else
			{}
		}
		
		if($finalloanamount_dbr>3000000)
					{
						$getloanamout=3000000;
					}
					else
					{
						$getloanamout=$finalloanamount_dbr;
					}

	//}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
$details[]=$interestrate;
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$perlacemi;

return($details);
}



?>