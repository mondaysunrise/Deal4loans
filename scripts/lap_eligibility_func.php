<? 
function getdoblap($DOB)
{
if(($DOB>50 && $DOB<=51)  || ($DOB<50 && $DOB>=23))
		{
			$term = 180;
			$print_term = "15";
		}
else if(($DOB>51 && $DOB<=52))
		{
			$term = 168;
			$print_term = "14";
		}
else if(($DOB>52 && $DOB<=53))
		{
			$term = 156;
			$print_term = "13";
		}
else if(($DOB>53 && $DOB<=54))
		{
			$term = 144;
			$print_term = "12";
		}
else if(($DOB>54 && $DOB<=55))
		{
			$term = 132;
			$print_term = "11";
		}
else if(($DOB>55 && $DOB<=56))
		{
			$term = 120;
			$print_term = "10";
		}
else if(($DOB>56 && $DOB<=57))
		{
			$term = 108;
			$print_term = "9";
		}
else if(($DOB>57 && $DOB<=58))
		{
			$term = 96;
			$print_term = "8";
		}
	else if(($DOB>58 && $DOB<=59))
		{
			$term = 84;
			$print_term = "7";
		}
	else if(($DOB>59 && $DOB<=60))
		{
			$term = 72;
			$print_term = "6";
		}
	else if(($DOB>60 && $DOB<=61))
		{
			$term = 60;
			$print_term = "5";
		}
	else if($DOB>61 && $DOB<=62)
		{
			$term = 48;
			$print_term = "4";
		}
		else if($DOB>62 && $DOB<=63)
		{
			$term = 36;
			$print_term = "3";
		}
		else if($DOB>63 && $DOB<=64)
		{
			$term = 24;
			$print_term = "2";
		}
		else if($DOB>64 && $DOB<=65)
		{
			$term = 12;
			$print_term = "1";
		}
		else if ($DOB>65)
		{
			$term = 0;
				$print_term = "0";
		}
		$getterm[]= $term;
		$getterm[]= $print_term;
		return($getterm);
}


function RBLbank($net_salary,$DOB,$Property_Value)
{
	list($term,$print_term)=getdoblap($DOB);
	$exactnet_salary= round($net_salary * 65 / 100);

	$propertyval= round($Property_Value * 65 / 100);
	

	$finalLoanAmt1=$propertyval;

	$interestrate = "12.50%";
	$intr=12.50/1200;
	$princ=100000;
	$emicalc=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
	$loanPossible= $exactnet_salary /$emicalc;
	$finalLoanAmt2 = round($loanPossible * 100000);
	
	if($finalLoanAmt1>$finalLoanAmt2)
	{
		$finalLoanAmt = $finalLoanAmt2;
	}
	else
	{
		$finalLoanAmt = $finalLoanAmt1;
	}
	
	if($finalLoanAmt>50000000)
	{
			$viewLoanAmt=50000000;
	}
	else
	{
		if($finalLoanAmt<2000000)
		{
			$viewLoanAmt=0;
		}
		else
		{
		$viewLoanAmt=$finalLoanAmt;
		}
	}

	$getemicalc=round($viewLoanAmt * $intr / (1 - (pow(1/(1 + $intr), $term))));

	$details[]=round($viewLoanAmt);
	$details[]=$getemicalc;
	$details[]=$print_term;
	$details[]=$interestrate;

return($details);
}//RBL
?>