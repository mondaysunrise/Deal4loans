<? require 'scripts/db_init.php';


$net_salary=70000;
$company="PNB INSURANCE BROKING PRIVATE LIMITED";
$category="Preferred";
$DOB="29";
$Primary_Acc="HDFC";

list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicibank($net_salary,$company,$category,$DOB,$Company_Type,$Primary_Acc);

echo "Interest rate: ".$iciciinterestrate."<br>";
echo "LOan AMount: ".$icicigetloanamout."<br>";
echo "EMI : ".$icicigetemicalc."<br>";
echo "term: ".$iciciterm."<br>";
echo "per lac: ".$iciciperlacemi."<br>";
echo "<br>";

function icicibank($net_salary,$company,$category,$DOB,$Company_Type,$Primary_Acc)
{
	 $exactnet_salary= $net_salary - $clubbed_emi;

	list($term,$print_term)=getdob($DOB);

	$gtcropcomp="Select interest_rate,	processing_fee From pl_company_icici Where (company_name like '%".$company."%' and interest_rate>0)";
	list($crprecordcount,$icicirow)=Mainselectfunc($gtcropcomp,$array = array());

if($crprecordcount>0)
	{
	
		$interestrate = $icicirow["interest_rate"]." %";
		
			$intr=$icicirow["interest_rate"]/1200;
			
			$proc_Fee = $icicirow["processing_fee"];
	}
	else
	{
		if($category=="Elite" || $category=="Super Prime" || $category=="Preferred")
		{
			if($net_salary>75000)
			{
				$interestrate = "15.50%";
				$intr=15.50/1200;

				if($category=="Elite" || $category=="Super Prime")
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

				if($category=="Elite" || $category=="Super Prime")
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

				if($category=="Elite" || $category=="Super Prime")
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

	}
	//Calculate Term
	if($category=="Elite" || $category=="Super Prime")
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
if($category=="Elite" || ($category=="Super Prime" && (strncmp ("ICICI", $Primary_Acc,6))==0))
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
	else if(($category=="Super Prime" && (strncmp ("ICICI", $Primary_Acc,6))!=0) || ($category=="Preferred" && (strncmp ("ICICI", $Primary_Acc,6))==0))
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

$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));

/*if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}
$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $term))));*/

$details[]=$interestrate;
	$details[]=round($loan_amount);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$perlacemi;

	return($details);

}//ICICI BANK

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