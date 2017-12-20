<? function getdob($DOB)
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

function icicibank($net_salary,$company,$category,$DOB,$Company_Type,$Primary_Acc,$total_emi,$other_emi,$reqdloan_amount)
{
	
	$exactnet_salary= $net_salary;

	list($term,$print_term)=getdob($DOB);
	$gtcropcomp="Select  interest_rate,	processing_fee From pl_company_iciciapp Where (company_name like '%".$company."%' and interest_rate>0)";
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
		if($category=="Elite" || $category=="SuperPrime" || $category=="SUPERPRIME" || $category=="ELITE")
		{
			if($net_salary>75000)
			{
				$interestrate = "15.50%";
				$intr=15.50/1200;
				$proc_Fee ="1.5%";			
			}
			else if ($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="1.5%";
			}
			else if ($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "16.50%";
				$intr=16.5/1200;
				$proc_Fee ="2%";
			}
			else if ($net_salary>20000 && $net_salary<=35000)
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2%";
			
			}
			else
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2%";
			}
		}
		else if($category=="Preferred" || $category=="PREFERRED")
		{
			if($net_salary>75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="2%";			
			}
			else if ($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16.50%";
				$intr=16.5/1200;
				$proc_Fee ="2%";
			}
			else if ($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2%";
			}
			else if ($net_salary>20000 && $net_salary<=35000)
			{
				$interestrate = "17.50%";
				$intr=17.5/1200;
				$proc_Fee ="2%";
			
			}
			else
			{
				$interestrate = "17.50%";
				$intr=17.5/1200;
				$proc_Fee ="2%";
			}
		}
		else
		{
			if($category=="DEFENCE")
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="0";
			}
			else
			{
			if($net_salary>75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="2%";			
			}
			else if($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16.50%";
				$intr=16.5/1200;
				$proc_Fee ="2%";
			}
			else if($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2%";
			}
			else if($net_salary>20000 && $net_salary<=35000)
			{
				$interestrate = "17.50%";
				$intr=17.5/1200;
				$proc_Fee ="2%";
			
			}
			else
			{
				$interestrate = "17.50%";
				$intr=17.5/1200;
				$proc_Fee ="2%";
				
			}
			}
		}
	}
	//Calculate Term
	if($category=="Elite" || $category=="SuperPrime" || $category=="SUPERPRIME" || $category=="ELITE")
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
	else if($category=="Preferred" || $category=="PREFERRED")
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
if($total_emi>0)
	{
	if($net_salary>=50000)
		{
			$firstnet_salary=($net_salary* (65/100));
			$firstnet_salary = $firstnet_salary-$total_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else if($net_salary<50000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$firstnet_salary = $firstnet_salary-$total_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else
	{}
	}
	else
	{
	if($other_emi>0)
	{
		if($category=="Elite" || $category=="SuperPrime" || $category=="SUPERPRIME" || $category=="ELITE" || $category=="Preferred" || $category=="PREFERRED")
		{
			if($net_salary>=50000)
		{
			$firstnet_salary=($net_salary* (45/100));
			$firstnet_salary = $firstnet_salary-$other_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
		else if($net_salary<50000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$firstnet_salary = $firstnet_salary-$other_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
		}
		else
		{
		if($net_salary>=50000)
		{
			$firstnet_salary=($net_salary* (40/100));
			$firstnet_salary = $firstnet_salary-$other_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
		else if($net_salary<50000)
		{
			$firstnet_salary=($net_salary* (50/100));
			$firstnet_salary = $firstnet_salary-$other_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
		
		}
	}
	else
		{
	if($net_salary>=50000)
		{
			$firstnet_salary=($net_salary* (65/100));
			$firstnet_salary = $firstnet_salary-$total_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else if($net_salary<50000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$firstnet_salary = $firstnet_salary-$total_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else
	{}
	}
	}

###other method###########################################
if($category=="Elite" || $category=="SuperPrime" || $category=="SUPERPRIME" ||  $category=="ELITE")
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
	else if($category=="Preferred" || $category=="PREFERRED")
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
if(round($loan_amt)>0 && round($loan_amt1)>0)
	{
		if(round($loan_amt)>=round($loan_amt1))
		{
			$finalloanamount=round($loan_amt1);
		}
		else
		{
			$finalloanamount=round($loan_amt);
		}
	}
	else
	{
		if(round($loan_amt)>0)
		{
				if(round($loan_amt1)>0)
			{
			$finalloanamount=round($loan_amt);
			}
			else
			{
				$finalloanamount=0;
			}
		}
		if(round($loan_amt1)>0)
		{	if(round($loan_amt)>0)
			{
			$finalloanamount=round($loan_amt1);
			}
			else
			{
				$finalloanamount=0;
			}
		}
	}
	
#######################################################################################################
//Exact Loan Amount
	if(($category=="Elite" || $category=="ELITE") || (($category=="SuperPrime" || $category=="SUPERPRIME") && (strncmp ("ICICI", $Primary_Acc,5))==0))
	{
		if($finalloanamount>=1500000)
		{
			$loan_amount=1500000;
		}
		else
		{
			$loan_amount=$finalloanamount;
		}
		//echo $finalloanamount."<br>";
	}
	else if((($category=="SuperPrime" || $category=="SUPERPRIME") && (strncmp ("ICICI", $Primary_Acc,5))!=0) || (($category=="Preferred"  || $category=="PREFERRED") && (strncmp ("ICICI", $Primary_Acc,5))==0))
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

############final loan amount is here#########################
if(round($loan_amount)>$reqdloan_amount)
	{
	//echo "here i m ";
		list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicifixedloan($company,$category,$reqdloan_amount,$interestrate,$intr,$proc_Fee,$calcterm,$getterm);
	}

/*****Special Clause*******************************************/
if($loan_amount>=1500000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME" || $category=="ELITE"  || $category=="PREFERRED"))
	{
	//echo "entered";
		$interestrateclause = "13.49%";
		$intrclause=13.49/1200;
		if($intrclause<$intr)
		{
			$interestrate = "13.49%";
			$intr=13.49/1200;
			$proc_Fee ="0.50%";
		}
		else
		{
			$interestrate = $interestrate;
			$intr=$intr;
			$proc_Fee =$proc_Fee;
		}
		
	}
	elseif(($loan_amount>1000000 && $loan_amount<1500000) && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME" ||  $category=="ELITE"  || $category=="PREFERRED"))
	{
		$interestrateclause = "14%";
		$intrclause=14/1200;
		if($intrclause<$intr)
		{
			$interestrate = "14%";
			$intr=14/1200;
			$proc_Fee ="0.50%";
		}
		else
		{
			$interestrate = $interestrate;
			$intr=$intr;
			$proc_Fee =$proc_Fee;
		}
	}

$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));

	$details[]=$iciciinterestrate;
	$details[]=round($icicigetloanamout);
	$details[]=$icicigetemicalc;
	$details[]=$iciciterm;
	$details[]=$iciciperlacemi;

	$details[]=$interestrate;
	$details[]=round($loan_amount);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$proc_Fee;

	return($details);
}

function icicifixedloan($company,$category,$loan_amount,$interestrate,$intr,$proc_Fee,$calcterm,$getterm)
{
	if($loan_amount>=1500000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME" || $category=="ELITE"  || $category=="PREFERRED"))
	{
	//echo "enteredkuoiuioi9";
		$interestrateclause = "13.49%";
		$intrclause=13.49/1200;
		if($intrclause<$intr)
		{
			$interestrate = "13.49%";
			$intr=13.49/1200;
			$proc_Fee ="0.50%";
		}
		else
		{
			$interestrate = $interestrate;
			$intr=$intr;
			$proc_Fee =$proc_Fee;
		}

		
	}
	elseif(($loan_amount>1000000 && $loan_amount<1500000) && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME" ||  $category=="ELITE"  || $category=="PREFERRED"))
	{
		//echo "entered2";
		$interestrateclause = "14%";
		$intrclause=14/1200;
		if($intrclause<$intr)
		{
			$interestrate = "14%";
			$intr=14/1200;
			$proc_Fee ="0.50%";
		}
		else
		{
			$interestrate = $interestrate;
			$intr=$intr;
			$proc_Fee =$proc_Fee;
		}
		

	}
/************************************************/
$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));

	$details[]=$interestrate;
	$details[]=round($loan_amount);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$proc_Fee;
	return($details);
}

function icicibankspecial($net_salary,$company,$category,$DOB,$Company_Type,$Primary_Acc,$total_emi,$other_emi,$reqdloan_amount)
{
	//echo "did u enter";
	//echo $net_salary." - ".$company." - ".$category." - ".$DOB." - ".$Company_Type." - ".$Primary_Acc." - ".$total_emi." - ".$other_emi." - ".$reqdloan_amount."<br><br>";
	$exactnet_salary= $net_salary;

	list($term,$print_term)=getdob($DOB);
			
			if($net_salary>50000)
			{
				$interestrate = "13.49%";
				$intr=13.49/1200;
				$proc_Fee ="999";			
			}
			else if ($net_salary<50000)
			{
				$interestrate = "14%";
				$intr=14/1200;
				$proc_Fee ="999";
			}
			else
			{
				$interestrate = "14%";
				$intr=14/1200;
				$proc_Fee ="999";
			}
			
	//Calculate Term
	if($category=="Elite" || $category=="SuperPrime" || $category=="SUPERPRIME" || $category=="ELITE")
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
	else if($category=="Preferred" || $category=="PREFERRED")
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
if($total_emi>0)
	{
	if($net_salary>=50000)
		{
			$firstnet_salary=($net_salary* (65/100));
			$firstnet_salary = $firstnet_salary-$total_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else if($net_salary<50000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$firstnet_salary = $firstnet_salary-$total_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else
	{}
	}
	else
	{
	if($other_emi>0)
	{
		if($category=="Elite" || $category=="SuperPrime" || $category=="SUPERPRIME" || $category=="ELITE" || $category=="Preferred" || $category=="PREFERRED")
		{
			if($net_salary>=50000)
		{
			$firstnet_salary=($net_salary* (45/100));
			$firstnet_salary = $firstnet_salary-$other_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
		else if($net_salary<50000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$firstnet_salary = $firstnet_salary-$other_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
		}
		else
		{
		if($net_salary>=50000)
		{
			$firstnet_salary=($net_salary* (40/100));
			$firstnet_salary = $firstnet_salary-$other_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
		else if($net_salary<50000)
		{
			$firstnet_salary=($net_salary* (50/100));
			$firstnet_salary = $firstnet_salary-$other_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
		
		}
	}
	else
		{
	if($net_salary>=50000)
		{
			$firstnet_salary=($net_salary* (65/100));
			$firstnet_salary = $firstnet_salary-$total_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else if($net_salary<50000)
		{
			$firstnet_salary=($net_salary* (55/100));
			$firstnet_salary = $firstnet_salary-$total_emi;
			$loan_amt1=$firstnet_salary/$perlacemi * 100000;
		}
	else
	{}
	}
	}

###other method###########################################
if($category=="Elite" || $category=="SuperPrime" || $category=="SUPERPRIME" ||  $category=="ELITE")
	{
//echo "i m here<br><br>";
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
	else if($category=="Preferred" || $category=="PREFERRED")
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

if(round($loan_amt)>0 && round($loan_amt1)>0)
	{
		if(round($loan_amt)>=round($loan_amt1))
		{
			$finalloanamount=round($loan_amt1);
		}
		else
		{
			$finalloanamount=round($loan_amt);
		}
	}
	else
	{
		if(round($loan_amt)>0)
		{
			if(round($loan_amt1)>0)
			{
			  $finalloanamount=round($loan_amt);
			}
			else
			{
				$finalloanamount=0;
			}
		}
		if(round($loan_amt1)>0)
		{	if(round($loan_amt)>0)
			{
			$finalloanamount=round($loan_amt1);
			}
			else
			{
				$finalloanamount=0;
			}
		}
	}
	echo $finalloanamount."<br><br>";
#######################################################################################################
		if($finalloanamount>=1500000)
		{
			$loan_amount=1500000;
		}
		else
		{
			$loan_amount=$finalloanamount;
		}
	
############final loan amount is here#########################
if(round($loan_amount)>$reqdloan_amount)
	{
		list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicifixedloanspecial($company,$category,$reqdloan_amount,$interestrate,$intr,$proc_Fee,$calcterm,$getterm);
	}

##################################################################################
/*for ICICI employees*/
//$comppos = strpos($company, 'ICICI');
if($loan_amount>1000000)
	{
	if($loan_amount>1000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME"  || $category=="ELITE" || $category=="PREFERRED"))
	{		
			$interestrate = "13.49%";
			$intr=13.49/1200;
			$proc_Fee ="999";
	}
	}
	elseif($loan_amount<1000000)
	{
	if($loan_amount<1000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME"  || $category=="ELITE" || $category=="PREFERRED"))
	{
			$interestrate = "14%";
			$intr=14/1200;
			$proc_Fee ="999";
		
		//echo "hello".$interestrate."<br>";
	}
	}
###################################################################################
/************************************************/
$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));

	$details[]=$iciciinterestrate;
	$details[]=round($icicigetloanamout);
	$details[]=$icicigetemicalc;
	$details[]=$iciciterm;
	$details[]=$iciciperlacemi;

	$details[]=$interestrate;
	$details[]=round($loan_amount);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$proc_Fee;

	return($details);
}

function icicifixedloanspecial($company,$category,$loan_amount,$interestrate,$intr,$proc_Fee,$calcterm,$getterm)
{
##################################################################################
/*for ICICI employees*/
$comppos = strpos($company, 'icici');

if(($comppos>=0 || $comppos==0) && $loan_amount>1000000  && strlen($comppos)>0)
	{
	if($loan_amount>1000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME"  || $category=="ELITE" || $category=="PREFERRED"))
	{
			$interestrate = "13.49%";
			$intr=13.49/1200;
			$proc_Fee ="999";
	}
	}
	elseif(($comppos>=0 || $comppos==0) && $loan_amount<1000000  && strlen($comppos)>0)
	{
		
	if($loan_amount<1000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME"  || $category=="ELITE" || $category=="PREFERRED"))
	{
			$interestrate = "14%";
			$intr=14/1200;
			$proc_Fee ="999";
	}
	}
###################################################################################
/************************************************/
$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));
//echo $interestrate."-".$loan_amount."-".$getemicalc."-".$getterm."-".$proc_Fee."<br><br>";
	$details[]=$interestrate;
	$details[]=round($loan_amount);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$proc_Fee;
	return($details);
}
?>