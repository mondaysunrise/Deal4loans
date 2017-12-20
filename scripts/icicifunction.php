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

function icicibank($net_salary,$company,$category,$DOB,$Company_Type,$Primary_Acc,$loan_amount)
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
		if($category=="Elite" || $category=="SuperPrime" || $category=="Preferred")
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
		else if($category=="PREFERRED-COMPETITION" || "Preferred-competition")
		{
			if($net_salary>75000)
			{
				$interestrate = "16.25%";
				$intr=16.25/1200;
				$proc_Fee ="2%";			
			}
			else if ($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16.50%";
				$intr=16.50/1200;
				$proc_Fee ="2%";
			}
			else if ($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "17.25%";
				$intr=17.25/1200;
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
			if($Company_Type==4)
			{
				if($net_salary>75000)
				{
					$interestrate = "15.50%";
					$intr=15.50/1200;
					$proc_Fee ="2%";			
				}
				else if ($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = "15.50%";
					$intr=15.50/1200;
					$proc_Fee ="2%";
				}
				else if ($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = "16.50%";
					$intr=16.50/1200;
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
					$interestrate = "17.50%";
					$intr=17.50/1200;
					$proc_Fee ="2%";			
				}
				else if ($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = "17.75%";
					$intr=17.75/1200;
					$proc_Fee ="2%";
				}
				else if ($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = "18%";
					$intr=18/1200;
					$proc_Fee ="2.25%";
				}
				else if ($net_salary>20000 && $net_salary<=35000)
				{
					$interestrate = "19%";
					$intr=19/1200;
					$proc_Fee ="2.25%";			
				}
				elseif($net_salary<=20000)
				{
					$interestrate = "19.50%";
					$intr=19.50/1200;
					$proc_Fee ="2.25%";				
				}
				else
				{
					$interestrate = "19.50%";
					$intr=19.50/1200;
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
	
/*****Special Clause*******************************************/
if($loan_amount>=2000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred"))
	{
		$interestrate = "12.99%";
		$intr=12.99/1200;
		$proc_Fee ="0.50%";
	}
	elseif(($loan_amount>1500000 && $loan_amount<2000000) && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred"))
	{
		$interestrate = "13.49%";
		$intr=13.49/1200;
		$proc_Fee ="0.50%";
	}
	elseif(($loan_amount>1000000 && $loan_amount<1500000) && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred"))
	{
		$interestrate = "13.99%";
		$intr=13.99/1200;
		$proc_Fee ="0.50%";
	}

##################################################################################
/*for ICICI employees*/
$comppos = strpos($company, 'ICICI');
//echo "<br><br>here : <br><br>";
if(isset($comppos) && $comppos>0 && $loan_amount>1000000)
	{	$interestrate = "13.99%";
		$intr=13.99/1200;
		$proc_Fee ="999";
	}
###################################################################################
/************************************************/
$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));
$details[]=$interestrate;
	$details[]=round($loan_amount);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$perlacemi;
	$details[]=$proc_Fee;

	return($details);

}//ICICI BANK FUNC

?>