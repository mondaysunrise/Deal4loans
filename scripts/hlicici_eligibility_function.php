<?php

function getdob($DOB)
{
	if($DOB<=40 )
		{
			//echo $DOB;
			$term = 240;
			$print_term = "20";
		}
		else if($DOB>40 && $DOB<=45)
		{
			$term = 180;
			$print_term = "15";
		}
		else if($DOB>45 && $DOB<=50)
		{
			$term = 120;
			$print_term = "10";
		}
		else if($DOB>50 && $DOB<=55)
		{
			$term = 60;
			$print_term = "5";
		}
		else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
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

function  ICICI_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value,$Employment_Status)
{
	//echo "<br>".$netAmount."--".$loan_amount."--".$DOB."--".$obligations."--".$City."--".$property_value."--".$Employment_Status."<br>";
	
		list($term,$print_term)=getdob($DOB);
		//echo $term;
		//echo "<br>";
	//echo "Select location_category From icici_hfc_location_list Where location_name like '%".$City."%'";
		$getlocationlist=ExecQuery("Select location_category From icici_hfc_location_list Where location_name like '%".$City."%'");
		$row=mysql_fetch_array($getlocationlist);
	 	$location_category= $row['location_category'];
//echo "out";
		if((($location_category==A || $location_category==B) && $netAmount>=18000) || ($location_category==C && $netAmount>=15000))
			{
		
	//	echo "in";
		if($netAmount<=30000)
		{
			if($Employment_Status==1)
			{
				$rt = 40;
			}
			else
			{
				$rt = 80;
			}
			$applicableFOIR = round($netAmount * $rt / 100)	;
		}
		elseif($netAmount>30000 && ($netAmount<=50000))
		{
			if($Employment_Status==1)
			{
				$rt = 45;
			}
			else
			{
				$rt = 80;
			}
			$applicableFOIR = round($netAmount * $rt / 100)	;
		}
		elseif($netAmount>50000)
		{
			if($Employment_Status==1)
			{
				$rt = 50;
			}
			else
			{
				$rt = 80;
			}
			$applicableFOIR = round($netAmount * $rt / 100)	;
		}
		//echo $rt;
		
		if($loan_amount<=2500000)
		{
			//$emiPerLac = "883.71";
			$inter = 10.50;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>2500000) && ($loan_amount<=7500000))
		{
			//$emiPerLac = "915.86";
			$inter = 11;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>7500000)
		{
			$inter = 11.50;
			$interest = $inter / 1200;
		}
		$princ=100000;
		
//45000--1700000--30--0--DELHI--2700000--1

		$emiPerLac = round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));

		$loanPossible = round((($applicableFOIR) / $emiPerLac),2);
		$viewLoanAmt = $loanPossible * 100000;

		$loan_amount = $viewLoanAmt ;


	if($property_value>1)
	{
		$getproperty_value= $property_value * (.85) ;

	
		if($loan_amount>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$loan_amount;
		}
	}

		if($loan_amount<=2500000)
		{
			//$emiPerLac = "883.71";
			$inter = 10.50;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>2500000) && ($loan_amount<=7500000))
		{
			//$emiPerLac = "915.86";
			$inter = 11;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>7500000)
		{
			$inter = 11.50;
			$interest = $inter / 1200;
		}
//for Fxed Rates	 only
		if($loan_amount<=2500000)
		{
			$inter1st = 10.50;
			$inter2ndn3rd = 10.75;
			$interest1st = $inter1st / 1200;
			$interest2ndn3rd = $inter2ndn3rd / 1200;
		}
		else if (($loan_amount>2500000) && ($loan_amount<=7500000))
		{
			
			$inter1st = 11;
			$inter2ndn3rd = 11.25;
			$interest1st = $inter1st / 1200;
			$interest2ndn3rd = $inter2ndn3rd / 1200;
		}
		else if ($loan_amount>7500000)
		{
			$inter1st = 11.50;
			$inter2ndn3rd = 11.75;
			$interest1st = $inter1st / 1200;
			$interest2ndn3rd = $inter2ndn3rd / 1200;
		}
		//echo "INT".$interest1st."Term - ".$term."Amt - ".$loan_amount;
		
		$emi1st = round($loan_amount * $interest1st / (1 - (pow(1/(1 + $interest1st),$term))),2);
		$emi2ndn3rd = round($loan_amount * $interest2ndn3rd / (1 - (pow(1/(1 + $interest2ndn3rd),$term))),2);

		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		$restemi = "<b>Scheme I: </b>".$emi1st." (Fixed for 1yr), <b>Scheme II: </b>".$emi2ndn3rd." (Fixed for 2yrs)";


		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		$perlacemifor1 = round(100000 * $interest1st / (1 - (pow(1/(1 + $interest1st),$term))),2);
		$perlacemifor2 = round(100000 * $interest2ndn3rd / (1 - (pow(1/(1 + $interest2ndn3rd),$term))),2);
		
		$exactinter="<b>Scheme I: </b>".$inter1st."% (Fixed for 1yr),<b>Scheme II:</b> ".$inter2ndn3rd."% (Fixed for 2yrs), Then ".$inter;
		


//$exactperlacemi="<b>Scheme I: </b>".$perlacemifor1." (Fixed for 1yr), <b>Scheme II: </b>".$perlacemifor2." (Fixed for 2yrs), Then ".abs($perlacemi);
$exactperlacemi = abs($perlacemi);

$yr1st=1;
$yr2nd=2;
		//$exactperlacemi="Rs ".abs($perlacemifor1)."(Fixed for 1st yr), Rs".abs($perlacemifor2)."(Fixed for 2nd yr),Then ".abs($perlacemi);
$getemi=$restemi.", Then ".$actualemi;
//$getemi = $actualemi;
	
   $details[]= $emi1st;
   $details[]= $perlacemifor1;
   $details[]= $inter1st;
   $details[]= $yr1st;
   
    $details[]= $emi2ndn3rd;
    $details[]= $perlacemifor2;
    $details[]= $inter2ndn3rd;
    $details[]= $yr2nd;
	
   	$details[]= $actualemi;
	$details[] = $exactinter;
	$details[]= $loan_amount;
	$details[]= $exactperlacemi;
	$details[]= $term;
			}
			else
	{
		//echo "ICICI not Eligible for loan";
	}
	//print_r($details);
return($details);

		}

		?>