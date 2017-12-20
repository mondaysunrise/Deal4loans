<?php

function hdfcIR($income,$categry)
{
	if($categry=="CAT A" || $categry=="Super A" || $categry=="CSA A")
	{
		if($income>=75000)
		{
			$rate="15.75%";
		}
		else if ($income<75000 && $income>=50000)
		{
			$rate="16.25%";
		}
		else if ($income<50000 && $income>=35000)
		{
			$rate="17%";
		}
		else if ($income<35000)
		{
			$rate="18%";
		}
		else 
		{
			$rate="18%";
		}
	}
	else if ($categry=="CAT B" || $categry=="CSA B")
	{
		if($income>=75000)
		{
			$rate="15.75%";
		}
		else if ($income<75000 && $income>=50000)
		{
			$rate="16.25%";
		}
		else if ($income<50000 && $income>=35000)
		{
			$rate="17%";
		}
		else if ($income<35000)
		{
			$rate="18%";
		}
		else 
		{
			$rate="18%";
		}
	}
	else 
	{
		$rate="22.25%";
		
	}

$pro_fee="2% if salary account in HDFC else 2.5%";
$prepay_chrge="4%";
$details[]=$rate;
$details[]=$prepay_chrge;
$details[]=$pro_fee;
	
	return($details);
}// END OD HDFCIR


function iciciIR($income,$categry)
{
	if($categry=="Elite")
	{
			if($income>=75000)
		{
			$rate="15.50%";
		}
		else if ($income<75000 && $income>=50000)
		{
			$rate="16%";
		}
		else if ($income<50000 && $income>=30000)
		{
			$rate="17%";
		}
		else if ($income<30000 && $income>=20000)
		{
			$rate="18.25%";
		}
		else if($income<20000)
		{
			$rate="18.50%";
		}
		else
		{
			$rate="18.50%";
		}
	}
	else if ($categry=="SuperPrime")
	{
			if($income>=75000)
		{
			$rate="15.50%";
		}
		else if ($income<75000 && $income>=50000)
		{
			$rate="16%";
		}
		else if ($income<50000 && $income>=30000)
		{
			$rate="17%";
		}
		else if ($income<30000 && $income>=20000)
		{
			$rate="18.25%";
		}
		else if($income<20000)
		{
			$rate="18.50%";
		}
		else
		{
			$rate="18.50%";
		}
	}
	else 
	{	if($income>=75000)
		{
			$rate="15.50%";
		}
		else if ($income<75000 && $income>=50000)
		{
			$rate="16%";
		}
		else if ($income<50000 && $income>=30000)
		{
			$rate="17%";
		}
		else if ($income<30000 && $income>=20000)
		{
			$rate="18.25%";
		}
		else if($income<20000)
		{
			$rate="18.50%";
		}
		else
		{
			$rate="18.50%";
		}
		
	}

$pro_fee="0.50% for special companies else 1.50% - 2.25%";
$prepay_chrge="Nil (For Loan amount >10 lacs & 12 EMI paid), else 5%";
$details[]=$rate;
$details[]=$prepay_chrge;
$details[]=$pro_fee;	
	return($details);
}

function ingIR($income,$categry)
{
	if($categry=="CAT A")
	{
		if($income>=150000)
		{
			$rate="13.75%";
		}
		else if ($income<150000 && $income>=75000)
		{
			$rate="14.25%";
		}
		else if ($income<75000 && $income>=40000)
		{
			$rate="15.75%";
		}
		else if ($income<40000 && $income>=25000)
		{
			$rate="17.25%";
		}
		else 
		{
			$rate="17.25%";
		}
	}
	else if ($categry=="CAT B" )
	{
		if($income>=150000)
		{
			$rate="1.75%";
		}
		else if ($income<150000 && $income>=75000)
		{
			$rate="14.50%";
		}
		else if ($income<75000 && $income>=40000)
		{
			$rate="16.25";
		}
		else if ($income<40000 && $income>=25000)
		{
			$rate="17.25";
		}
		else 
		{
			$rate="17.25%";
		}
	}
	else 
	{

		if($income>=75000)
		{
			$rate="16.75%";
		}
		else if ($income<75000 && $income>=40000)
		{
			$rate="16.75%";
		}
		else if ($income<40000 && $income>=30000)
		{
			$rate="18.25%";
		}
		else 
		{
			$rate="18.25%";
		}
		
	}

$pro_fee="1.5% (For ING Salary Account Holder),else 2%";
$prepay_chrge="Nil Foreclosure Charges valid till 30th Sep 12";

$details[]=$rate;
$details[]=$prepay_chrge;
$details[]=$pro_fee;	
	return($details);
}// END of ingIR

function bajajIR($income,$categry)
{
	$rate="14.5% - 17%";
		
$pro_fee="Upto 2% ";
$prepay_chrge="Nil";

$details[]=$rate;
$details[]=$prepay_chrge;
$details[]=$pro_fee;	
	return($details);
} // bajajIR

function kotakIR($income,$categry)
{
	if($categry=="CAT A")
	{
			$rate="15.5%";
	}
	else if ($categry=="CAT B" )
	{
			$rate="16.50%";
	}
	else 
	{
			$rate="18%-19%";
		
	}

$pro_fee="2%";
$prepay_chrge="4%";

$details[]=$rate;
$details[]=$prepay_chrge;
$details[]=$pro_fee;	
	return($details);
} // kotakIR

function stancIR($income,$categry)
{
	if($categry=="CAT A")
	{
			$rate="16% - 17%";
	}
	else if ($categry=="CAT B" )
	{
			$rate="17% - 18%";
	}
	else 
	{
			$rate="19% - 22%";
		
	}

$pro_fee="2%";
$prepay_chrge="2% - 5%";

$details[]=$rate;
$details[]=$prepay_chrge;
$details[]=$pro_fee;

	
	return($details);
} // stancIR

function fullertonIR($income,$categry)
{
	if($categry=="CAT A")
	{
			$rate="21% - 32%";
	}
	else if ($categry=="CAT B" )
	{
			$rate="21% - 32%";
	}
	else 
	{
			$rate="21% - 32%";
		
	}


$pro_fee="2%";
$prepay_chrge="4%";

$details[]=$rate;
$details[]=$prepay_chrge;
$details[]=$pro_fee;

	return($details);
} //fullertonIR


function hdbfsIR($income,$categry)
{
	if($categry=="CAT A")
	{

		if($income>=75000)
		{
			$rate="16%";
		}
		else if ($income<75000 && $income>=35000)
		{
			$rate="17%";
		}
		else if ($income<35000)
		{
			$rate="18%";
		}
		else 
		{
			$rate="18%";
		}
	}
	else if ($categry=="CAT B")
	{
		if($income>=75000)
		{
			$rate="16%";
		}
		else if ($income<75000 && $income>=35000)
		{
			$rate="17%";
		}
		else if ($income<35000)
		{
			$rate="18%";
		}
		else 
		{
			$rate="18%";
		}
	}
	else 
	{
		if($income>=75000)
		{
			$rate="17%";
		}
		else if ($income<75000 && $income>=35000)
		{
			$rate="18%";
		}
		else if ($income<35000)
		{
			$rate="21%";
		}
		else 
		{
			$rate="21%";
		}
		
	}

$pro_fee="1% - 2%";
$prepay_chrge="NIL for Select Corporates Employees (CAT A & B)<br> 4% For Rest";

$details[]=$rate;
$details[]=$prepay_chrge;
$details[]=$pro_fee;

	
	return($details);
}// END OD hdbfsIR

function citiIR($income,$categry)
{
	/*if($categry=="CAT A")
	{

		if($income>=30000)
		{
			$rate="15%";
		}
		else 
		{
			$rate="16%";
		}
	}
	else if ($categry=="CAT B")
	{
		if($income>=30000)
		{
			$rate="16%";
		}
		else 
		{
			$rate="17%";
		}
	}
	else 
	{
		if($income>=30000)
		{
			$rate="16%";
		}
		else 
		{
			$rate="17%";
		}
		
	}

$pro_fee="1% - 2%";
$prepay_chrge="3%";
$details[]=$rate;
$details[]=$prepay_chrge;
$details[]=$pro_fee;	
	return($details);*/
}// END OD CitiIR

?>