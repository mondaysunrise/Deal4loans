<? 
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

list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee) = Stanc("50000","10000","WRS","CAT A","30","","");

echo $interestrate."<br>".$getloanamout."<br>".$getemicalc."<br>".$term."<br>".$Processing_Fee."<br>";

function Stanc($net_salary,$clubbed_emi,$company,$category,$DOB,$Company_Type,$Primary_Acc)
	{
	echo "<br><br>salasry: ".$net_salary."clubnbed: ".$clubbed_emi."company: ".$company."category: ".$category."DOB: ".$DOB."<br>";
		 $exactnet_salary= $net_salary;
		 $exactnet_salaryTO= $net_salary - $clubbed_emi;
		list($term,$print_term)=getdob($DOB);
		if($print_term==1)	{$term=12; $getterm=1;}	elseif($print_term==2)	{$term=24; $getterm=2;}	elseif($print_term==3){$term=36; $getterm=3;}elseif($print_term==4){$term=48; $getterm=4;}
		elseif($print_term==5 || $print_term>5) {	$term=60; $getterm=5;}


		echo $LoanAmount= ($net_salary*10) - $clubbed_emi;
		
		if($LoanAmount>0)
		{ 
			/*//for listed company
			//for special company
			if($crprecordcount>0)
				{}
			else
			{*/
				if($category=="CAT A" || $category=="CAT A +")
				{
					if($LoanAmount>=500000)
						{
							if($net_salary>=125000)
							{
								$interestrate = "15.25%";
								$intr=15.25/1200;
								$Processing_Fee = "2 %";
							}
							else if($net_salary>=75000 && $net_salary<125000)
							{
								$interestrate = "15.75%";
								$intr=15.75/1200;
								$Processing_Fee = "2 %";
							}
							elseif($net_salary>50000 && $net_salary<75000)
							{
								$interestrate = "16.25%";
								$intr=16.25/1200;
								$Processing_Fee = "1.50%";
							}
							elseif($net_salary=50000)
							{
								$interestrate = "16.75%";
								$intr=16.75/1200;
								$Processing_Fee = "1.50%";
							}
							else
							{
							}
						}
					else
					{
						if($net_salary>=125000)
							{
								$interestrate = "15.75%";
								$intr=15.75/1200;
								$Processing_Fee = "2 %";
							}
							else if($net_salary>=75000 && $net_salary<125000)
							{
								$interestrate = "16.25%";
								$intr=16.25/1200;
								$Processing_Fee = "2 %";
							}
							elseif($net_salary>50000 && $net_salary<75000)
							{
								$interestrate = "16.75%";
								$intr=16.75/1200;
								$Processing_Fee = "1.50%";
							}
							elseif($net_salary==50000)
							{
								$interestrate = "17.25%";
								$intr=17.25/1200;
								$Processing_Fee = "1.50%";
							}
							else
							{
							}
					}
				}//CAT A & CAT B				
				elseif($category=="CAT B" || $category=="CAT C")
				{
					if($LoanAmount>=500000)
						{
							if($net_salary>=125000)
							{
								$interestrate = "16%";
								$intr=16/1200;	
								$Processing_Fee = "2 %";
							}
							else if($net_salary>=75000 && $net_salary<125000)
							{
								$interestrate = "16.50%";
								$intr=16.50/1200;
								$Processing_Fee = "2 %";
							}
							elseif($net_salary>50000 && $net_salary<75000)
							{
								$interestrate = "17%";
								$intr=17/1200;
								$Processing_Fee = "1.50%";
							}
							elseif($net_salary==50000)
							{
								$interestrate = "17.50%";
								$intr=17.50/1200;
								$Processing_Fee = "1.50%";
							}
							else
							{
							}
						}
					else
					{
						if($net_salary>=125000)
							{
								$interestrate = "18%";
								$intr=18/1200;
								$Processing_Fee = "2 %";
							}
							else if($net_salary>=75000 && $net_salary<125000)
							{
								$interestrate = "17.50%";
								$intr=17.50/1200;
								$Processing_Fee = "2 %";
							}
							elseif($net_salary>50000 && $net_salary<75000)
							{
								$interestrate = "17%";
								$intr=17/1200;
								$Processing_Fee = "1.50%";
							}
							elseif($net_salary==50000)
							{
								$interestrate = "16.50%";
								$intr=16.50/1200;
								$Processing_Fee = "1.50%";
							}
							else
							{
							}
						}
					}//CAT B
				elseif($category=="CAT D" || $category=="CEA")
				{
					if($LoanAmount>=500000)
						{
							if($net_salary>=125000)
							{
								$interestrate = "18.50%";
								$intr=18.50/1200;	
								$Processing_Fee = "2 %";
							}
							else if($net_salary>=75000 && $net_salary<125000)
							{
								$interestrate = "18%";
								$intr=18/1200;
								$Processing_Fee = "2 %";
							}
							elseif($net_salary>50000 && $net_salary<75000)
							{
								$interestrate = "17.50%";
								$intr=17.50/1200;
								$Processing_Fee = "1.50%";
							}
							elseif($net_salary==50000)
							{
								$interestrate = "17%";
								$intr=17/1200;
								$Processing_Fee = "1.50%";
							}
							else
							{
							}
						}
					else
					{
						if($net_salary>=125000)
							{
								$interestrate = "19%";
								$intr=19/1200;
								$Processing_Fee = "2 %";
							}
							else if($net_salary>=75000 && $net_salary<125000)
							{
								$interestrate = "18.50%";
								$intr=18.50/1200;
								$Processing_Fee = "2 %";
							}
							elseif($net_salary>50000 && $net_salary<75000)
							{
								$interestrate = "18%";
								$intr=18/1200;
								$Processing_Fee = "1.50%";
							}
							elseif($net_salary==50000)
							{
								$interestrate = "17.50%";
								$intr=17.50/1200;
								$Processing_Fee = "1.50%";
							}
							else
							{
							}
						}
					}//CAT D & CEA
					else
					{
						if($LoanAmount>=500000)
						{
							if($net_salary>=125000)
							{
								$interestrate = "18.50%";
								$intr=18.50/1200;	
								$Processing_Fee = "2 %";
							}
							else if($net_salary>=75000 && $net_salary<125000)
							{
								$interestrate = "18%";
								$intr=18/1200;
								$Processing_Fee = "2 %";
							}
							elseif($net_salary>50000 && $net_salary<75000)
							{
								$interestrate = "17.50%";
								$intr=17.50/1200;
								$Processing_Fee = "1.50%";
							}
							elseif($net_salary==50000)
							{
								$interestrate = "17%";
								$intr=17/1200;
								$Processing_Fee = "1.50%";
							}
							else
							{
							}
						}
					else
					{
						if($net_salary>=125000)
							{
								$interestrate = "19%";
								$intr=19/1200;
								$Processing_Fee = "2 %";
							}
							else if($net_salary>=75000 && $net_salary<125000)
							{
								$interestrate = "18.50%";
								$intr=18.50/1200;
								$Processing_Fee = "2 %";
							}
							elseif($net_salary>50000 && $net_salary<75000)
							{
								$interestrate = "18%";
								$intr=18/1200;
								$Processing_Fee = "1.50%";
							}
							elseif($net_salary==50000)
							{
								$interestrate = "17.50%";
								$intr=17.50/1200;
								$Processing_Fee = "1.50%";
							}
							else
							{
							}
						}
					}
			//}//else
		}
		
		if($LoanAmount>2000000)
			{
				$getloanamout=2000000;
			}
			else
			{
				$getloanamout=$LoanAmount;
			}

		
		$emicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

		$details[]=$interestrate;
		$details[]=$getloanamout;
		$details[]=$emicalc;
		$details[]=$term/12;
		$details[]=$Processing_Fee;
		return($details);
	}
?>
