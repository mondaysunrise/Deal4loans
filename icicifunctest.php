<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$sql = "select * from Req_Loan_Personal where RequestID=1275279";
list($crprecordcount,$query)=Mainselectfunc($sql,$array = array());
$Net_Salary =$query[0]['Net_Salary'];
$monthsalary = $Net_Salary/12;
echo $getCompany_Name =$query[0]['Company_Name'];
$icici_bankcategory =$query[0]['Net_Salary'];
$getcompany='select icici_bank from pl_company_list where company_name="'.$getCompany_Name.'"';
list($recordcount,$grow)=Mainselectfunc($getcompany,$array = array());
$icici_bankcategory = $grow["icici_bank"]; 

$age = 35;
$Company_Type =$query[0]['Company_Type'];
$Primary_Acc =$query[0]['Primary_Acc'];


list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicibank($monthsalary,$getCompany_Name,$icici_bankcategory,$age,$Company_Type,$Primary_Acc);

		if($icicigetloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $iciciinterestrate; ?></td>
		<td class="emi">Rs. <? echo $icicigetemicalc; ?></td>
		<td class="tenure"><? echo $iciciterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $icicigetloanamout; ?></td>
				 
	<?
		}


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

function icicibank($net_salary,$company,$category,$DOB,$Company_Type,$Primary_Acc)
{
		 $exactnet_salary= $net_salary;

	list($term,$print_term)=getdob($DOB);

	$gtcropcomp="Select interest_rate,	processing_fee From pl_company_icici Where (company_name like '%".$company."%' and interest_rate>0)";
	list($crprecordcount,$icicirow)=Mainselectfunc($gtcropcomp,$array = array());

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
		if($category=="Elite" || $category=="SuperPrime")
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
if($loan_amount>1000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred"))
	{
		$interestrate = "14%";
		$intr=14/1200;
		$proc_Fee ="0.50%";
	}
//echo "<br><br>here2 : <br><br>";

##################################################################################
/*for ICICI employees*/
$comppos = strpos($company, 'icici');
//echo "<br><br>here : <br><br>";
if(isset($comppos) && $loan_amount>1000000)
	{
	if($loan_amount>1000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred"))
	{
		$interestrate = "13.49%";
		$intr=13.49/1200;
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

}//ICICI BANK

?>