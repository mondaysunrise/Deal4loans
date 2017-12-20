<? function getdob($DOB)
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


Function  firstblue_HomeloanSal($netAmount,$DOB,$obligations,$property_value,$Property_Identified)
{
	list($term,$print_term)=getdob($DOB);

	if($Property_Identified==3)
	{
		if($term>180)
		{
			$term=180;
			$print_term=15;
		}
	
	}
	

if($netAmount>100000)
	{
		$salmulti = round($netAmount * (.55));
	}
	else
	{
		$salmulti = round($netAmount * (.50));
	}

if($obligations>0)
	{
$applicableFOIR = ($salmulti - $obligations);
	}
	else
	{
		$applicableFOIR = $salmulti;
	}



if($property_value>2350000)
	{
		$getproperty_value= $property_value * (.80);

	}
	else
	{
		$getproperty_value= $property_value * (.85);
	}

	if($applicableFOIR<=25000)
	{
		$inter=10.75;
		$interest=$inter/1200;
	}
	elseif($applicableFOIR>25000 && $applicableFOIR<=75000)
	{
		$inter=11;
		$interest=$inter/1200;
	}
	elseif($applicableFOIR>75000)
	{
		$inter=11.50;
		$interest=$inter/1200;
	}
		
		$princ=100000;


		$emicalc=($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));

$loanPossible= ($applicableFOIR)/$emicalc;
$viewLoanAmt = round($loanPossible * 100000);

		$loan_amount = $viewLoanAmt ;
	
	if($property_value>2350000)
	{
		$getproperty_value= $property_value * (.80);

	}
	else
	{
		$getproperty_value= $property_value * (.85);
	}

		if($loan_amount>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$loan_amount;
		}
		
	
	if($loan_amount<=2500000)
	{
		$inter=10.75;
		$interest=$inter/1200;
	}
	elseif($loan_amount>2500000 && $loan_amount<=7500000)
	{
		$inter=11;
		$interest=$inter/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=11.50;
		$interest=$inter/1200;
	}

$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$details[] = $perlacemi;
$details[] = $viewLoanAmt;
$details[]= $loan_amount;
$details[]= $inter;
$details[]= $actualemi;
$details[]= $print_term;

return($details);
}

Function  firstblue_HomeloanSE($netAmount,$DOB,$obligations,$property_value,$Property_Identified)
{
	
	list($term,$print_term)=getdob($DOB);

	if($Property_Identified==3)
	{
		if($term>180)
		{
			$term=180;
			$print_term=15;
		}
	
	}

	$salmulti = round($netAmount * (.90));
	

if($obligations>0)
	{
$applicableFOIR = ($salmulti - $obligations);
	}
	else
	{
		$applicableFOIR = $salmulti;
	}

if($property_value>2350000)
	{
		$getproperty_value= $property_value * (.80);

	}
	else
	{
		$getproperty_value= $property_value * (.85);
	}


if($applicableFOIR<=25000)
	{
		$inter=11.25;
		$interest=$inter/1200;
	}
	elseif($applicableFOIR>25000 && $applicableFOIR<=75000)
	{
		$inter=11.50;
		$interest=$inter/1200;
	}
	elseif($applicableFOIR>75000)
	{
		$inter=12;
		$interest=$inter/1200;
	}

	
		$princ=100000;

		$emicalc=($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);

$loan_amount = $viewLoanAmt ;
	
	if($property_value>2350000)
	{
		$getproperty_value= $property_value * (.80);

	}
	else
	{
		$getproperty_value= $property_value * (.85);
	}

		if($loan_amount>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$loan_amount;
		}
		
	
	if($loan_amount<=2500000)
	{
		$inter=11.25;
		$interest=$inter/1200;
	}
	elseif($loan_amount>2500000 && $loan_amount<=7500000)
	{
		$inter=11.50;
		$interest=$inter/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=12;
		$interest=$inter/1200;
	}

$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$details[] = $perlacemi;
$details[] = $viewLoanAmt;
$details[]= $loan_amount;
$details[]= $inter;
$details[]= $actualemi;
$details[]= $print_term;

return($details);
}
?>