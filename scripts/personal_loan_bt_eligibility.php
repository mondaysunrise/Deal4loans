<?php
function hdfcbt_pl($OutstandingLoan)
{
	if($OutstandingLoan>2000000)
	{
		$BTRate="11.49";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>1500000 && $OutstandingLoan<=2000000)
	{
		$BTRate="12.50";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>1000000 && $OutstandingLoan<=1500000)
	{
		$BTRate="12.99";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>500000 && $OutstandingLoan<=1000000)
	{
		$BTRate="13.25";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>300000 && $OutstandingLoan<=500000)
	{
		$BTRate="13.49";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>=50000 && $OutstandingLoan<=300000)
	{
		$BTRate="13.75";
		$BTProcessingFee="Rs.999";
	}
	else
	{}

	$details[]=$BTRate;
	$details[]=$BTProcessingFee;
	return($details);
}
//new function on 18th april2016

function hdfcbt_plbt($OutstandingLoan,$Existing_Bank)
{
	if((strncmp ("ICICI", $Existing_Bank,5))==0 || (strncmp ("Bajaj", $Existing_Bank,5))==0 || (strncmp ("Axis", $Existing_Bank,4))==0 || (strncmp ("Kotak", $Existing_Bank,5))==0 || (strncmp ("Citi", $Existing_Bank,4))==0)
	{
		if($OutstandingLoan>=50000)
		{
		 $BTRate="11.49";
		 $BTProcessingFee="Rs.999";
		 }
	 }
	else
	{
	if($OutstandingLoan>2000000)
	{
		$BTRate="11.49";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>1500000 && $OutstandingLoan<=2000000)
	{
		$BTRate="12.50";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>1000000 && $OutstandingLoan<=1500000)
	{
		$BTRate="12.99";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>500000 && $OutstandingLoan<=1000000)
	{
		$BTRate="13.25";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>300000 && $OutstandingLoan<=500000)
	{
		$BTRate="13.49";
		$BTProcessingFee="Rs.999";
	}
	elseif($OutstandingLoan>=50000 && $OutstandingLoan<=300000)
	{
		$BTRate="13.75";
		$BTProcessingFee="Rs.999";
	}
	else
	{}
	}
	$details[]=$BTRate;
	$details[]=$BTProcessingFee;
	return($details);
}
// hdfc new bt

function icicibt_pl($OutstandingLoan,$Employment_Status,$Existing_Rate)
{
	if($Employment_Status==1)
	{
	if($OutstandingLoan>=1500000)
	{
		$BTRate="15.49";
	}
	elseif($OutstandingLoan>=1000000 && $OutstandingLoan<1500000)
	{
		$BTRate="15.99";
	}
	elseif($OutstandingLoan<1000000)
	{
		$BTRate="16.99";
	}
	else
	{}
	}
	
	$details[]=$BTRate;
	$details[]=$BTProcessingFee;
	return($details);
}

function icicibt_plnw($OutstandingLoan,$Employment_Status,$Existing_Rate,$icici_bankcmp,$Income)
{
	if($Employment_Status==1 )
	{
		$BTProcessingFee = "Rs.999";
		if(strlen($icici_bankcmp)>2)
		{
	if($OutstandingLoan>=1500000)
	{
		$BTRate="12.99";
	}
	elseif($OutstandingLoan>=1000000 && $OutstandingLoan<1500000)
	{
		$BTRate="13.25";
	}
	elseif($OutstandingLoan>=500000 && $OutstandingLoan<1000000)
	{
		$BTRate="13.50";
	}
	elseif($OutstandingLoan>=300000 && $OutstandingLoan<500000)
	{
		$BTRate="13.75";
	}
	elseif($OutstandingLoan>=50000 && $OutstandingLoan<300000)
	{
		$BTRate="14";
	}
	else
	{}
		}
		else
		{
			$BTProcessingFee = "1.5% + ST";
			if($Income>=75000)
			{
				$BTRate1="17";
			}
			elseif($Income>=50000 && $Income<75000)
			{
				$BTRate1="17.25";
			}
			elseif($Income>=35000 && $Income<50000)
			{
				$BTRate1="17.50";
			}
			elseif($Income>=200000 && $Income<35000)
			{
				$BTRate1="18.25";
			}
			elseif($Income<200000)
			{
				$BTRate1="18.50";
			}
			else
			{}
			
			if($Existing_Rate>=17)
			{
				$BTRate2 = $Existing_Rate-2;
			}
			if(strlen($BTRate2)>1 && strlen($BTRate1)>1)
			{
				if($BTRate1>$BTRate2)
				{
					$BTRate = $BTRate2;
				}
				else
				{
					$BTRate = $BTRate1;
				}
				
			}
			else
			{
				$BTRate = $BTRate1;
			}

		}
	}
	
	$details[]=$BTRate;
	$details[]=$BTProcessingFee;
	return($details);
}

function kotakbt_pl($OutstandingLoan,$CompanyCategory,$Existing_Rate,$NetIncome)
{
	if(strlen($CompanyCategory)>0)
	{
		if($NetIncome>=35000)
		{
			$BTRate="12.75";
			$BTProcessingFee="Rs.1499";
		}
		else
			{
			}
	}
	else
		{
		if($NetIncome>=35000)
		{
			$BTRate="11.29";
			$BTProcessingFee="Rs.1799";
		}
		else
			{}
		}

	$details[]=$BTRate;
	$details[]=$BTProcessingFee;
	return($details);
}

function citibankbt_pl($OutstandingLoan,$citicategorycmp)
{
	if($citicategorycmp=="CAT A")
	{
			$BTRate="13.75";
			$BTProcessingFee="0";
	
	}
	elseif($citicategorycmp=="CAT B")
	{
			$BTRate="14.75";
			$BTProcessingFee="0";
	}
	else
	{
	} 
	
	$details[]=$BTRate;
	$details[]=$BTProcessingFee;
	return($details);
}

function stancbt_pl($OutstandingLoan,$Existing_Rate)
{
	
	if($OutstandingLoan>=2000000)
	{
		$BTRate="10.99";
	}
	elseif($OutstandingLoan>=1000000 && $OutstandingLoan<2000000)
	{
		$BTRate="11.25";
	}
	elseif($OutstandingLoan>=500000 && $OutstandingLoan<1000000)
	{
		$BTRate="11.49";
	}
	elseif($OutstandingLoan<500000)
	{
		$BTRate="11.99";
	}
	else
	{}
	
	
	$details[]=$BTRate;
	$details[]=$BTProcessingFee;
	return($details);
}
?>