<?php

function icicibank_bt($loan_amount,$processing_fee,$roi,$tenureleft)
{
	if($loan_amount>500000)
	{
		$interestrate = "13.50%";
		$intr=13.50/1200;
		$proc_fee="0.80%";
	}
	elseif($loan_amount>=300000 && $loan_amount<500000)
	{
		$interestrate = "13.75%";
		$intr=13.75/1200;
		$proc_fee="1%";
	}
	elseif($loan_amount>=50000 && $loan_amount<300000)
	{
		$interestrate = "14%";
		$intr=14/1200;
		$proc_fee="1.25%";
	}
	else
	{
		//echo "not eligible";
	}
	
	$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $tenureleft))));
	
	$details[]=$loan_amount;
	$details[]=$interestrate;
	$details[]=$getemicalc;
	$details[]=$tenureleft;
	$details[]=$proc_fee;
	return($details);	
}
//icici bank

function hdfcbank_bt($loan_amount,$processing_fee,$roi,$tenureleft)
{
	if($loan_amount>1500000)
	{
		$interestrate = "12.99%";
		$intr=12.99/1200;
		$proc_fee="999";
	}
	elseif($loan_amount>=1000000 && $loan_amount<1500000)
	{
		$interestrate = "13.25%";
		$intr=13.25/1200;
		$proc_fee="999";
	}
	elseif($loan_amount>=500000 && $loan_amount<1000000)
	{
		$interestrate = "13.5%";
		$intr=13.5/1200;
		$proc_fee="999";
	}
	elseif($loan_amount>=300000 && $loan_amount<500000)
	{
		$interestrate = "13.75%";
		$intr=13.75/1200;
		$proc_fee="999";
	}
	elseif($loan_amount>=100000 && $loan_amount<300000)
	{
		$interestrate = "14%";
		$intr=14/1200;
		$proc_fee="999";
	}
	else
	{
		//echo "not eligible";
	}
	
	$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $tenureleft))));
	
	$details[]=$loan_amount;
	$details[]=$interestrate;
	$details[]=$getemicalc;
	$details[]=$tenureleft;
	$details[]=$proc_fee;
	return($details);
}
//hdfc bank bt 

function kotakbank_bt($loan_amount,$processing_fee,$roi,$tenureleft,$bankname,$salary,$compcatgory)
{
	
	if((strlen(strpos($bankname, "HDFC")) > 0) || (strlen(strpos($bankname, "ICICI")) > 0) || (strlen(strpos($bankname, "HDB")) > 0) || (strlen(strpos($bankname, "Standard")) > 0) || (strlen(strpos($bankname, "TATA")) > 0) || (strlen(strpos($bankname, "Fullerton")) > 0) || (strlen(strpos($bankname, "HSBC")) > 0) || (strlen(strpos($bankname, "Capital First")) > 0) || (strlen(strpos($bankname, "IngVysya")) > 0))
	{	
		
		if($compcatgory=="CAT A" || $compcatgory=="CAT B" || $compcatgory=="CAT C")
			{//salary clause
				if($salary>=150000)
					{
						$lowerrate = $roi-(3.3);
						if($lowerrate<13.45)
						{
							$interestrate = "13.45%";
							$intr=13.45/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
						
					}
				elseif($salary>=50000 && $salary<150000)
					{
						$lowerrate = $roi-3;
						if($lowerrate<13.70)
						{
							$interestrate = "13.70%";
							$intr=13.70/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
					}
				elseif($salary>=30000 && $salary<50000)
					{
						$lowerrate = $roi-3;
						if($lowerrate<14)
						{
							$interestrate = "14%";
							$intr=14/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
					}
				else
					{
						//echo "not eligible";
					}
			}
			else
			{//salary clause
				if($salary>=200000)
					{
						$lowerrate = $roi-3;
						if($lowerrate<13.75)
						{
							$interestrate = "13.75%";
							$intr=13.75/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
						$proc_fee="2%";
					}
				elseif($salary>=76000 && $salary<200000)
					{
						$lowerrate = $roi-(2.5);
						if($lowerrate<13.95)
						{
							$interestrate = "13.95%";
							$intr=13.95/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
					}
				elseif($salary>=30000 && $salary<76000)
					{
						$lowerrate = $roi-(2.5);
						if($lowerrate<14.25)
						{
							$interestrate = "14.25%";
							$intr=14.25/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
					}
				else
					{
						//echo "not eligible";
					}
			}
	}
	else //open market and other banks
	{
		if($compcatgory=="CAT A" || $compcatgory=="CAT B" || $compcatgory=="CAT C")
			{//salary clause
				if($salary>=150000)
					{
						$lowerrate = $roi-2;
						if($lowerrate<13.40)
						{
							$interestrate = "13.40%";
							$intr=13.40/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
						$proc_fee="2%";
					}
				elseif($salary>=75000 && $salary<150000)
					{
					
						$lowerrate = $roi-2;
						if($lowerrate<13.60)
						{
							$interestrate = "13.60%";
							$intr=13.60/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
					}
				elseif($salary>=30000 && $salary<75000)
					{
						$lowerrate = $roi-2;
						if($lowerrate<13.90)
						{
							$interestrate = "13.90%";
							$intr=13.90/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
					}
				else
					{
						//echo "not eligible";
					}
			}
			else
				{//salary clause
				if($salary>=150000)
					{
						$lowerrate = $roi-2;
						if($lowerrate<13.70)
						{
							$interestrate = "13.70%";
							$intr=13.70/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
						$proc_fee="2%";
					}
				elseif($salary>=50000 && $salary<150000)
					{
					
						$lowerrate = $roi-2;
						if($lowerrate<13.99)
						{
							$interestrate = "13.99%";
							$intr=13.99/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
					}
				elseif($salary>=30000 && $salary<50000)
					{
						$lowerrate = $roi-2;
						if($lowerrate<14.25)
						{
							$interestrate = "14.25%";
							$intr=14.25/1200;
						}
						else
						{
							$interestrate = $lowerrate."%";
							$intr=$lowerrate/1200;
						}
					}
				else
					{
						//echo "not eligible";
					}
			}
	}

	$proc_fee="2%";
	$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $tenureleft))));
	
	$details[]=$loan_amount;
	$details[]=$interestrate;
	$details[]=$getemicalc;
	$details[]=$tenureleft;
	$details[]=$proc_fee;
	return($details);
}

?>