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
	
		if($net_salary<=25000 )
		{
			if(($net_salary>=14500) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon"))
				{
					$interestrate = "23%";
					$intr=23/1200;
				}
				else if (($net_salary>=12500) && ($city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai"))
				{
					$interestrate = "23%";
			$intr=23/1200;
				}
				else if (($net_salary>=10000) && ($city=="Hyderabad" || $city=="Kolkata"))
				{
					$interestrate = "23%";
			$intr=23/1200;
				}
				else if (($net_salary>=12500) && ($city=="Bangalore"))
				{
					$interestrate = "23%";
			$intr=23/1200;
				}
				else if (($net_salary>=9000) && ($city=="Pune"))
				{
					$interestrate = "23%";
			$intr=23/1200;
				}
				else if (($net_salary>=10000) && ($city=="Chennai"))
				{
					$interestrate = "23%";
			$intr=23/1200;
				}
				
				else if ($net_salary>=12500)
				{
					$interestrate = "23%";
			$intr=23/1200;
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
		elseif($net_salary>25000)
		{
			if(($net_salary>25000 && $net_salary<=35000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"  || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "21%";
					$intr=21/1200;
				}
				else
				{
					$interestrate = "20%";
					$intr=20/1200;
				}

			}
			elseif(($net_salary>35000 && $net_salary<=50000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"  || $city=="Kolkata"))
			{
			
				$interestrate = "19%";
				$intr=19/1200;
				
			}
			elseif(($net_salary>50000 && $net_salary<=75000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"  || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "16%";
					$intr=16/1200;
				}
				else
				{
					$interestrate = "19%";
					$intr=19/1200;
				}				
				
			}
			elseif(($net_salary>75000 && $net_salary<=100000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad"  || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "15.5%";
					$intr=15.5/1200;
				}
				else
				{
					$interestrate = "19%";
					$intr=19/1200;
				}
			}
			elseif(($net_salary > 100000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad"  || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "15.5%";
					$intr=15.5/1200;
				}
				else
				{
					$interestrate = "19%";
					$intr=19/1200;
				}
			}
			
			else  if ($net_salary>=12500)
			{
			
			
			
				$interestrate = "23%";
				$intr=23/1200;
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
		
		if(($net_salary<=25000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"))
			{
				if(($net_salary>=14500) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon"))
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				else if (($net_salary>=12500) && ($city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai"))
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
				else if (($net_salary>=10000) && ($city=="Hyderabad"  || $city=="Kolkata"))
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
				else if (($net_salary>=12500) && ($city=="Bangalore"))
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
				else if (($net_salary>=9000) && ($city=="Pune"))
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
				else if (($net_salary>=10000) && ($city=="Chennai"))
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
				
				else if ($net_salary>=12500)
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
			}
		elseif(($net_salary>25000 && $net_salary<=35000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"  || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "23";
					$intr=23/1200;
				}
				else
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
			}
			elseif(($net_salary>35000 && $net_salary<=50000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"  || $city=="Kolkata"))
			{
				$interestrate = "19%";
				$intr=19/1200;
				
			}
			elseif(($net_salary>50000 && $net_salary<=75000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"  || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "16";
					$intr=16/1200;
				}
				else
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				
			}
			elseif(($net_salary>75000 && $net_salary<=100000 ) && $city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Kolkata")
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "15.5";
					$intr=15.5/1200;
				}
				else
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				
			}
			elseif(($net_salary>100000 ) && $city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Kolkata")
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "15.5";
					$intr=15.5/1200;
				}
				else
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				
			}
			else  if ($net_salary>=12500)
			{
			$interestrate = "24%";
			$intr=24/1200;
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
		if(($net_salary<=25000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"))
			{
				if(($net_salary>=14500) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon"))
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				else if (($net_salary>=12500) && ($city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=10000) && ($city=="Hyderabad" || $city=="Kolkata"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=12500) && ($city=="Bangalore"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=9000) && ($city=="Pune"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=10000) && ($city=="Chennai"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				
				else if ($net_salary>=12500)
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
			}
		elseif(($net_salary>25000 && $net_salary<=35000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai" || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				else
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
			}
			elseif(($net_salary>35000 && $net_salary<=50000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai" || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "23%";
					$intr=23/1200;
				}
				else
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				
			}
			elseif(($net_salary>50000 && $net_salary<=75000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai" || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "22%";
					$intr=22/1200;
				}
				else
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				
			}
			elseif(($net_salary>75000 && $net_salary<=100000) && $city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Kolkata")
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "22%";
					$intr=22/1200;
				}
				else
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				
			}
			elseif(($net_salary>100000) && $city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Kolkata")
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
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
			else if($net_salary>12000)
			{
				$interestrate = "28%";
				$intr=28/1200;
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
		if(($net_salary<=25000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"))
			{
				if(($net_salary>=14500) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon"))
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
				else if (($net_salary>=12500) && ($city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=10000) && ($city=="Hyderabad" || $city=="Kolkata"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=12500) && ($city=="Bangalore"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=9000) && ($city=="Pune"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=10000) && ($city=="Chennai"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				
				else if ($net_salary>=12500)
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
			}
		elseif(($net_salary>25000 && $net_salary<=35000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai" || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "26%";
					$intr=26/1200;
				}
				else
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
			}
			elseif(($net_salary>35000 && $net_salary<=50000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai" || $city=="Kolkata"))
			{
				$interestrate = "24%";
				$intr=24/1200;
				
			}
			elseif(($net_salary>50000 && $net_salary<=75000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai" || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "22%";
					$intr=22/1200;
				}
				else
				{
					$interestrate = "26%";
					$intr=26/1200;
				}
				
			}
			elseif(($net_salary>75000 && $net_salary<=100000) && $city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Kolkata")
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "22%";
					$intr=22/1200;
				}
				else
				{
					$interestrate = "26%";
					$intr=26/1200;
				}

			}
			elseif(($net_salary>100000) && $city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Kolkata")
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "15.6%";
					$intr=15.6/1200;
				}
				else
				{
					$interestrate = "26%";
					$intr=26/1200;
				}

			}
			else  if ($net_salary>=12500)
		{
		$interestrate = "28%";
		$intr=28/1200;
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
		if(($net_salary<=25000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"))
			{
				if(($net_salary>=14500) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon"))
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
				else if (($net_salary>=12500) && ($city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=10000) && ($city=="Hyderabad" || $city=="Kolkata"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=12500) && ($city=="Bangalore"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=9000) && ($city=="Pune"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				else if (($net_salary>=10000) && ($city=="Chennai"))
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
				
				else if ($net_salary>=12500)
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
			}
		elseif(($net_salary>25000 && $net_salary<=35000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai" || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "27%";
					$intr=27/1200;
				}
				else
				{
					$interestrate = "28%";
					$intr=28/1200;
				}
			}
			elseif(($net_salary>35000 && $net_salary<=50000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai" || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "24%";
					$intr=24/1200;
				}
				else
				{
					$interestrate = "24%";
					$intr=24/1200;
				}				
			}
			elseif(($net_salary>50000 && $net_salary<=75000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai" || $city=="Kolkata"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "22%";
					$intr=22/1200;
				}
				else
				{
					$interestrate = "26%";
					$intr=26/1200;
				}
				
			}
			elseif(($net_salary>75000 && $net_salary<=100000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "22%";
					$intr=22/1200;
				}
				else
				{
					$interestrate = "26%";
					$intr=26/1200;
				}
				
			}
			elseif(($net_salary>100000) && ($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" || $city=="Mumbai" || $city=="Thane" || $city=="Navi Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"))
			{
				if($city=="Delhi" || $city=="Noida" || $city=="Gaziabad" || $city=="Gurgaon" )
				{
					$interestrate = "15.5%";
					$intr=15.5/1200;
				}
				else
				{
					$interestrate = "26%";
					$intr=26/1200;
				}
				
			}			
			else if ($net_salary>=12500)
			{
			
			$interestrate = "28%";
			$intr=28/1200;
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

if($city=='Chennai')
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
	elseif($city=='Bangalore')
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
	elseif($city=='Pune')
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
	elseif($city=='Hyderabad')
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
	elseif($city=='Delhi' || $city=='Faridabad' || $city=='Noida' || $city=='Gurgaon' || $city=='Gaziabad')
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
	elseif($city=='Mumbai' || $city=='Thane' || $city=='Navi Mumbai')
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
$details[]=$interestrate;
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;

return($details);
}



	
function getSmallCitiesRoi($city, $net_salary)
{
	$getCityListSql = "select * from small_city_list where status=1";
	list($getCityListNumRows,$getCityListQuery)=MainselectfuncNew($getCityListSql,$array = array());
	$cityCheck = "";
	$salaryCheck =  "";
	$interestrate = "";
	$roi = "";
	for($i=0;$i<$getCityListNumRows;$i++)
	{
		$roi = $getCityListQuery[$i]['roi'];
		$cityCheck = trim($getCityListQuery[$i]['city']);
		$salaryCheck = $getCityListQuery[$i]['salary'];
		$monthlyIncome = $salaryCheck/12 ;

		 if($city==$cityCheck && $net_salary>=$monthlyIncome)
		 {
		 	$interestrate = $roi;
		 } 
	}
return  $interestrate;
}


function fullerton_small_cities($net_salary,$clubbed_emi,$company,$category,$DOB,$city)
{

	if($clubbed_emi>0)
	{
		$exactnet_salary= ($net_salary*(.60)) - $clubbed_emi;
	}
	else
	{
		$exactnet_salary= $net_salary;
	}
	
 	$int = getSmallCitiesRoi($city, $net_salary);
	if($int>0)
	{
		
		list($term,$print_term)=getdob($DOB);
		$interestrate =  $int;
		$intr= $int / 1200;
	//	echo "<br>ffffff  ".$term."--<br>";
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
		//	echo "<br>".$term."--else<br>";
			$Loan_Amount_Eli=$exactnet_salary * 12;
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
		
	//	echo "<br>";
	//echo "loan:".$getloanamout."   intr: ".$intr."     term: ".$term."<br>";
		if($getterm==1)	{ $term=12; }	elseif( $getterm==2 )	{ $term=24; }  elseif( $getterm==3 ){ $term=36; } elseif( $getterm==4) {	$term=48; } 
		$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
		
		$details[]=$interestrate;
		$details[]=round($getloanamout);
		$details[]=$getemicalc;
		$details[]=$getterm;
	}
return($details);
}


?>