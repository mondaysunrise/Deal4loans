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

Function  ICICI_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	$getlocationlist=ExecQuery("Select location_category From icici_hfc_location_list Where location_name like '%".$City."%'");
		$row=mysql_fetch_array($getlocationlist);
		$location_category= $row['location_category'];

		if((($location_category==A || $location_category==B) && $netAmount>=18000) || ($location_category==C && $netAmount>=15000))
			{
if($netAmount<=30000)
		{
			$applicableFOIR = round($netAmount * 40 / 100)	;
		}
		elseif($netAmount>30000 && ($netAmount<=50000))
		{
			$applicableFOIR = round($netAmount * 45 / 100)	;
		}
		elseif($netAmount>50000)
		{
			$applicableFOIR = round($netAmount * 50 / 100)	;
		}
		
		
		if($loan_amount<=3000000)
		{
			//$emiPerLac = "883.71";
			$inter = 8.75;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>3000000) && ($loan_amount<=5000000))
		{
			//$emiPerLac = "915.86";
			$inter = 9.00;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>5000000)
		{
			
			$inter = 9.50;
			$interest = $inter / 1200;
		}
		$princ=100000;
		

		list($term,$print_term)=getdob($DOB);
		$emiPerLac = round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		//echo $DOB."<br>";
	//	echo "1: ".$term."<br>";
			//	echo "2: ".$print_term."<br>";
		$loanPossible = round((($applicableFOIR) / $emiPerLac),2);
		$viewLoanAmt = $loanPossible * 100000;

		//echo $viewLoanAmt;
		$loan_amount = $viewLoanAmt ;
		/*if(($loan_amount > $viewLoanAmt))
		{
			//echo "1";
			$loan_amount = $viewLoanAmt; 		
		}
		elseif($loan_amount < 800000)
		{
			//echo "2";
			$loan_amount = 800000; 	
		}
		else
		{
			//echo "3";
			$loan_amount = $loan_amount ;
		}*/
		
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
	
		/*if($loan_amount<=2000000)
		{
			$emiPerLac = "883.71";
			$inter = 8.75;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>2000000) && ($loan_amount<=5000000))
		{
			$emiPerLac = "915.86";
			$inter = 9.25;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>5000000)
		{
			$emiPerLac = "948.51";
			$inter = 9.75;
			$interest = $inter / 1200;
		}*/
		
		//special scheme
		//$spemiPerLac = "948.51";
		if($loan_amount<=2000000)
			{
					$spinter = 8;
			}
			elseif($loan_amount>2000000)
			{
				$spinter = 8.25;
			}

		$spinterest = $spinter / 1200;

		$spemi = round($loan_amount * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);

		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		
		$emi = $actualemi;

		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		$forfirsttwoemi = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		
	$details[]= $actualemi;
	$details[]= $emi;
	$details[] = $inter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $perlacemi;
	$details[]= $forfirsttwoemi;
$details[]= $term;
$details[]= $spemi;
			}
			else
	{
		echo "ICICI not Eligible for loan";
	}
	
return($details);

		}

function lic_homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);

	if($netAmount>=8000 && $netAmount<=15000)
		{
			$applicableFOIR = round($netAmount * 45 / 100)	;
		}
		elseif($netAmount>=15001 && $netAmount<=25000)
		{
			$applicableFOIR = round($netAmount * 50 / 100)	;
		}
		elseif($netAmount>=25001 && $netAmount<=32000)
		{
			$applicableFOIR = round($netAmount * 55 / 100)	;
		}
		elseif($netAmount>=32001)
		{
			$applicableFOIR = round($netAmount * 60 / 100)	;
		}
		
		$inter=8.75;
		$interest=8.75/1200;
		$princ=100000;

		$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
//echo "hwllo: ".$viewLoanAmt."<br>";
		$loan_amount= $viewLoanAmt;
		/*if(($loan_amount > $viewLoanAmt))
		{
			//echo "1<br>";
			$loan_amount = $viewLoanAmt; 		
		}
		elseif($loan_amount < 500000)
		{
			//echo "2<br>";
			$loan_amount = 500000; 	
		}
		else
		{
			//echo "3<br>";
			$loan_amount = $loan_amount ;
		}*/
if($property_value>1)
	{

		$getproperty_value= $property_value * (.75);

		if($loan_amount>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$loan_amount;
		}
		
	}
		

		//echo $loan_amount."<br>";
		$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))));




			
	$details[]= $emi;
	$details[] = $inter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $perlacemi;
	$details[]= $term;
			
			
	
return($details);


}


Function  IDBI_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);


		$applicableFOIR = round($netAmount * 50 / 100)	;

	if($loan_amount<2500000)
	{
		$inter=11;
		$interest=11/1200;

	}
	elseif($loan_amount>2500000 && $loan_amount<=3000000)
	{
		$inter=11.50;
		$interest=11.50/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=5000000)
	{
		$inter=11.75;
		$interest=111.75/1200;
	}
	elseif($loan_amount>5000000)
	{
		$inter=12.25;
		$interest=12.25/1200;
	}
		$princ=100000;


		$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
//echo "hwllo: ".$viewLoanAmt."<br>";
		$loan_amount = $viewLoanAmt ;
		/*if(($loan_amount > $viewLoanAmt))
		{
			//echo "1<br>";
			$loan_amount = $viewLoanAmt; 		
		}
		elseif($loan_amount < 600000)
		{
			//echo "2<br>";
			$loan_amount = 600000; 	
		}
		else
		{
			//echo "3<br>";
			$loan_amount = $loan_amount ;
		}
*/
if($property_value>1)
	{
		$getproperty_value= $property_value * (.85);

		if($loan_amount>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$loan_amount;
		}
		
	}
		

		$spinter = 8.25;
		$spinterest = $spinter / 1200;

		$spemi = round($loan_amount * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		$emi = $spemi."(Fixed for 2 yrs) then ".$actualemi;
		//echo $loan_amount."<br>";
		
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))));

		$forfirsttwoemi = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);

//echo $print_term;
	$details[]= $actualemi;
	$details[]= $emi;
	$details[] = $inter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $perlacemi;
	$details[]= $forfirsttwoemi;
	$details[]= $term;
	$details[]= $spemi;
			
			
	
return($details);
}

Function  HDFC_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);


		$applicableFOIR = round($netAmount * 50 / 100)	;

	if($loan_amount<200000)
	{

		$inter=10.75;
		$interest=10.75/1200;

	}
	elseif($loan_amount>200000 && $loan_amount<=3000000)
	{
		$inter=10.75;
		$interest=10.75/1200;
	}
	elseif($loan_amount>300000 && $loan_amount<=7500000)
	{
		$inter=11;
		$interest=11/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=11.50;
		$interest=11.50/1200;
	}
		$princ=100000;


		$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
//echo "hwllo: ".$viewLoanAmt."<br>";
		$loan_amount = $viewLoanAmt ;
		/*if(($loan_amount > $viewLoanAmt))
		{
			//echo "1<br>";
			$loan_amount = $viewLoanAmt; 		
		}
		elseif($loan_amount < 500000)
		{
			//echo "2<br>";
			$loan_amount = 500000; 	
		}
		else
		{
			//echo "3<br>";
			$loan_amount = $loan_amount ;
		}
		*/
if($property_value>1)
	{
		$getproperty_value= $property_value * (.85);

		if($loan_amount>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$loan_amount;
		}
		
	}
		

		$spinter = 8.25;
		$spinterest = $spinter / 1200;

		$spemi = round($loan_amount * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		$emi = $actualemi;
		//echo $loan_amount."<br>";
		
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))));

		$forfirsttwoemi = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);

//echo $print_term;
	$details[]= $actualemi;
	$details[]= $emi;
	$details[] = $inter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $perlacemi;
	$details[]= $forfirsttwoemi;
	$details[]= $term;
	$details[]= $spemi;
				
return($details);
}



Function  Axis_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);


		$applicableFOIR = round($netAmount * 55 / 100)	;

	if($loan_amount<=2500000)
	{
		$inter=10.75;
		$interest=10.75/1200;
	}
	
	elseif($loan_amount>2500000 && $loan_amount<=7500000)
	{
		$inter=11;
		$interest=11/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=11.25;
		$interest=11.25/1200;
	}
		$princ=100000;


		$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
//echo "hwllo: ".$viewLoanAmt."<br>";
		$loan_amount = $viewLoanAmt ;
		/*--*/
	if($loan_amount<=2500000)
	{
		$inter=10.75;
		$interest=10.75/1200;
	}
	
	elseif($loan_amount>2500000 && $loan_amount<=7500000)
	{
		$inter=11;
		$interest=11/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=11.25;
		$interest=11.25/1200;
	}
		/*if(($loan_amount > $viewLoanAmt))
		{
			//echo "1<br>";
			$loan_amount = $viewLoanAmt; 		
		}
		elseif($loan_amount < 300000)
		{
			//echo "2<br>";
			$loan_amount = 300000; 	
		}
		else
		{
			//echo "3<br>";
			$loan_amount = $loan_amount ;
		}*/

if($property_value>1)
	{
		$getproperty_value= $property_value * (.80);

		if($loan_amount>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$loan_amount;
		}
	}
		

		$spinter = 8.25;
		$spinterest = $spinter / 1200;

		$spemi = round($loan_amount * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		//$emi = $spemi."(Fixed for 2 yrs) then ".$actualemi;
		$emi = $actualemi;
		//echo $loan_amount."<br>";
		
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))));

		$forfirsttwoemi = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);

//echo $print_term;
	$details[]= $actualemi;
	$details[]= $emi;
	$details[] = $inter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $perlacemi;
	$details[]= $forfirsttwoemi;
	$details[]= $term;
	$details[]= $spemi;
				
return($details);
}
		?>