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
//calculate per lac emi
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
					$interestrate = "18%";
					$intr=18/1200;
				}
				elseif($net_salary>30000 && $net_salary<=50000)
				{
					$interestrate = "18%";
					$intr=18/1200;
				}
				elseif($net_salary>50000)
				{
					$interestrate = "17%";
					$intr=17/1200;
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
					$interestrate = "16.50%";
					$intr=16.5/1200;
				}
				elseif($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = "15.50%";
					$intr=15.5/1200;
				}
				elseif($net_salary>50000)
				{
					$interestrate = "15.5%";
					$intr=15.5/1200;
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
	
	$details[]=$interestrate;
	$details[]=$getloanamout;
	$details[]=$getemicalc;
	$details[]=$getterm;

			return($details);

}


function hdfcbank($net_salary,$clubbed_emi,$company,$category,$DOB,$Company_Type,$Primary_Acc)
{
//echo "salasry: ".$net_salary."clubnbed: ".$clubbed_emi."company: ".$company."category: ".$category."DOB: ".$DOB."<br>";
	 $exactnet_salary= $net_salary - $clubbed_emi;

	list($term,$print_term)=getdob($DOB);
//echo "term: ".$term."print_term".$print_term."<br>";

if( $exactnet_salary>0)
	{

	if($category=="Super A" || $category=="Cat A" || $category=="CAT A" || $category=="CSA A")
	{
		
		if($exactnet_salary<=35000)
		{
			$interestrate = "19%";
			$intr=19/1200;

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
			$interestrate = "17%";
			$intr=17/1200;

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
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
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
		elseif($exactnet_salary>50000 && $exactnet_salary<75000)
		{
			$interestrate = "16%";
			$intr=16/1200;

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
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
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
		elseif($exactnet_salary>=75000)
		{
			$interestrate = "15.5%";
			$intr=15.5/1200;

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
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
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
			$interestrate = "19%";
			$intr=19/1200;

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
		elseif($exactnet_salary>35000 && $exactnet_salary<=50000)
		{
			$interestrate = "17%";
			$intr=17/1200;

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
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
				$getterm=4;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
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
		elseif($exactnet_salary>50000 && $exactnet_salary<75000)
		{
			$interestrate = "16%";
			$intr=16/1200;

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
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
				$getterm=4;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
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
			elseif($exactnet_salary>=75000)
		{
			$interestrate = "15.5%";
			$intr=15.5/1200;

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
			elseif($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
				$getterm=4;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 11;
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
				$interestrate = "22%";
				$intr=22/1200;
			}
			else
			{
				$interestrate = "22%";
				$intr=22/1200;
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
			if($Loan_Amount_Eli>5000000)
			{
				$getloanamout=5000000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
			
		}
		elseif($exactnet_salary>35000 && $exactnet_salary<75000)
		{
			if($category=="CAT C" || $category=="CAT D")
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			else
			{
				$interestrate = "22%";
				$intr=22/1200;
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
			if($Loan_Amount_Eli>5000000)
			{
				$getloanamout=5000000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}

if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
			elseif($exactnet_salary>=75000)
		{
			if($category=="CAT C")
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			elseif($category=="CAT D")
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			else
			{
				$interestrate = "22%";
				$intr=22/1200;
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
			if($Loan_Amount_Eli>5000000)
			{
				$getloanamout=5000000;
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
			
			$interestrate = "22%";
			$intr=22/1200;
			
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
			if(strlen($Company_Type)>0)
			{
				if($Company_Type==1)
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
				elseif($Company_Type==2)
				{
					if($Loan_Amount_Eli>1000000)
					{
						$getloanamout=1000000;
					}
					else
					{
						$getloanamout=$Loan_Amount_Eli;
					}
				}
				elseif($Company_Type==3)
				{
					$getloanamout=$Loan_Amount_Eli;
									
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
			/*if($Loan_Amount_Eli>75000)
			{
				$getloanamout=75000;
			}
			else
			{
				$getloanamout=$Loan_Amount_Eli;
			}*/

			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
			
		}
		elseif($exactnet_salary>35000)
		{
				$interestrate = "22%";
				$intr=22/1200;
			
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
			if(strlen($Company_Type)>0)
			{
				if($Company_Type==1 && $Primary_Acc=='HDFC')
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
				elseif($Company_Type==2)
				{
					if($Loan_Amount_Eli>1000000)
					{
						$getloanamout=1000000;
					}
					else
					{
						$getloanamout=$Loan_Amount_Eli;
					}
				}
				elseif($Company_Type==3)
				{
					$getloanamout=$Loan_Amount_Eli;
									
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
		if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}

			$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		}
	}

}
$details[]=$interestrate;
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;

	return($details);


}

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
			
			$interestrate = "23%";
			$intr=23/1200;
			
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
				$interestrate = "21%";
				$intr=21/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "19%";
				$intr=19/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				
			}
			elseif($net_salary>75000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
				
			}
			else
			{
				$interestrate = "21%";
				$intr=21/1200;
			}
			}
			else
			{
				if($net_salary>25000 && $net_salary<=35000)
				{
					$interestrate = "20%";
					$intr=20/1200;
				}
				elseif($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = "19%";
					$intr=19/1200;
					
				}
				elseif($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = "19%";
					$intr=19/1200;
					
				}
				elseif($net_salary>75000)
				{
					$interestrate = "19%";
					$intr=19/1200;
				
			}
			else
			{
				$interestrate = "20%";
				$intr=20/1200;
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
				$interestrate = "24%";
				$intr=24/1200;
			}
		elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "23%";
				$intr=23/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "19%";
				$intr=19/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				
			}
			elseif($net_salary>75000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
				
			}
			else
			{
			$interestrate = "24%";
			$intr=24/1200;
			}
		}
		else
		{
			if($net_salary<=25000)
			{
				$interestrate = "27%";
				$intr=27/1200;
			}
		elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "27%";
				$intr=27/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "24%";
				$intr=24/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "24%";
				$intr=24/1200;
				
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "24%";
				$intr=24/1200;
				
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
			}
			else
			{
			$interestrate = "27%";
			$intr=27/1200;
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
				$interestrate = "24%";
				$intr=24/1200;
			}
		elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "24";
				$intr=24/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "23%";
				$intr=23/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "22%";
				$intr=22/1200;
				
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "22%";
				$intr=22/1200;
				
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
				
			}
			else
			{
				$interestrate = "24%";
				$intr=24/1200;
			}
	}
	else
		{	
			if($net_salary<=25000)
			{
				$interestrate = "28%";
				$intr=28/1200;
			}
		elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "28";
				$intr=28/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "24%";
				$intr=24/1200;
				
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "24%";
				$intr=24/1200;
				
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "24%";
				$intr=24/1200;
				
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
				
			}
			else
			{
				$interestrate = "28%";
				$intr=28/1200;
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
			
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=3;
			}
	}
	elseif($category=="CAT D")
	{
		if($city=="Delhi" || $city=="Noida" || $city=="Gurgaon" || $city=="Faridabad" || $city=="Gaziabad")
		{
			if($net_salary<=25000)
			{
				$interestrate = "27%";
				$intr=27/1200;
			}
			elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "26%";
				$intr=26/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "24%";
				$intr=24/1200;
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
			}
			else
			{
				$interestrate = "27%";
				$intr=27/1200;
			}
		}
		else
		{
			if($net_salary<=25000)
			{
				$interestrate = "28%";
				$intr=28/1200;
			}
			elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "28%";
				$intr=28/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "26%";
				$intr=26/1200;
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "26%";
				$intr=26/1200;
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "26%";
				$intr=26/1200;
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
			}
			else
			{
				$interestrate = "28%";
				$intr=28/1200;
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
				$interestrate = "27%";
				$intr=27/1200;
			}
			elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "27%";
				$intr=27/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "24%";
				$intr=24/1200;
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "22%";
				$intr=22/1200;
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
			}
			else
			{
				$interestrate = "27%";
				$intr=27/1200;
			}
		}
		else
		{
			if($net_salary<=25000)
			{
				$interestrate = "28%";
				$intr=28/1200;
			}
			elseif($net_salary>25000 && $net_salary<=35000)
			{
				$interestrate = "28%";
				$intr=28/1200;
			}
			elseif($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "26%";
				$intr=26/1200;
			}
			elseif($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "26%";
				$intr=26/1200;
			}
			elseif($net_salary>75000 && $net_salary<100000)
			{
				$interestrate = "26%";
				$intr=26/1200;
			}
			elseif($net_salary>=100000)
			{
				$interestrate = "15.5%";
				$intr=15.5/1200;
			}
			else
			{
				$interestrate = "28%";
				$intr=28/1200;
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
				$Loan_Amount_Eli=$exactnet_salary * 7;
				$getterm=3;
			}
		else
			{
				$Loan_Amount_Eli=$exactnet_salary * 7;
				$getterm=3;
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
//$details[]=$interestrate;
$details[]="N.A";
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;

return($details);
}

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
	

	$details[]=$interestrate;
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;

return($details);
}


?>