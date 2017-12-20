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
			$inter = 9.50;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>3000000) && ($loan_amount<=5000000))
		{
			//$emiPerLac = "915.86";
			$inter = 9.75;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>5000000)
		{
			
			$inter = 9.75;
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

		
		
		if($loan_amount<=3000000)
		{
			//$emiPerLac = "883.71";
			$inter = 9.50;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>3000000) && ($loan_amount<=5000000))
		{
			//$emiPerLac = "915.86";
			$inter = 9.75;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>5000000)
		{
			
			$inter = 9.75;
			$interest = $inter / 1200;
		}
		
		$spinter = 8.50;
		$spinterest = $spinter / 1200;
		$spemi = round($loan_amount * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);

		$interfor2 = 9.25;
		$interestfor2 = $interfor2 / 1200;
		$emifor2 = round($loan_amount * $interestfor2 / (1 - (pow(1/(1 + $interestfor2),$term))),2);


		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		//$restemi=$spemi." (Upto Mar 31,2011)<br>".$emifor2."(from Apr 1,2011 -<br> Mar 31,2012),then ".$actualemi."";
		$restemi = $actualemi;

		//$emi = $spemi." (Fixed for 1 yr) ".$emifor2." (Fixed for 2 yrs) ";
		//$emi = $spemi." (Fixed for 1st yr)<br>".$emifor2." (Fixed for 2nd yr)<br>";

		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		$perlacemifor1 = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		$perlacemifor2 = round(100000 * $interestfor2 / (1 - (pow(1/(1 + $interestfor2),$term))),2);

		$forfirsttwoemi = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		
		//$exactinter="8.50% (Upto Mar 31,2011),<br>9.25% (from Apr 1,2011 -<br> Mar 31,2012),Then ".$inter;
		$exactinter=$inter;

//		$exactinter=$inter;
//$exactperlacemi=abs($perlacemifor1)."(Upto Mar 31,2011)<br>Rs.".abs($perlacemifor2)."(from Apr 1,2011 -<br> Mar 31,2012),Then Rs.".abs($perlacemi);

$exactperlacemi=abs($perlacemi);

		//$exactperlacemi="Rs ".abs($perlacemifor1)."(Fixed for 1st yr), Rs".abs($perlacemifor2)."(Fixed for 2nd yr),Then ".abs($perlacemi);
$getemi=$restemi.",Then ".$actualemi;
$getemi = $actualemi;
	//$exactperlacemi=abs($perlacemi);
	//$emi="";

	$details[]= $restemi;
	$details[]= $emi;
	$details[] = $exactinter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $exactperlacemi;
	$details[]= $forfirsttwoemi;
$details[]= $term;
$details[]= $spemi;
			}
			else
	{
		//echo "ICICI not Eligible for loan";
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
		
		$inter=9;
		$interest=9/1200;
		$princ=100000;

		$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
	$loan_amount= $viewLoanAmt;

if($loan_amount<=2000000)
	{
		$inter=9;
		$interest=9/1200;
	}
	elseif($loan_amount>2000000 && $loan_amount<=3000000)
	{
		$inter=9;
		$interest=9/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=7500000)
	{
		$inter=9;
		$interest=9/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=9.50;
		$interest=9.50/1200;
	}

//echo "hwllo: ".$viewLoanAmt."<br>";
	
		
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

	if($loan_amount<=2000000)
	{
		$inter=9;
		$interest=9/1200;
	}
	elseif($loan_amount>2000000 && $loan_amount<=3000000)
	{
		$inter=9;
		$interest=9/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=7500000)
	{
		$inter=9;
		$interest=9/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=9.50;
		$interest=9.50/1200;
	}

			//echo $loan_amount."<br>";
		$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))));

	if($loan_amount<=2000000)
	{
		$inter1=9.75;
		$interest1=9.75/1200;
	}
	elseif($loan_amount>2000000 && $loan_amount<=3000000)
	{
		$inter1=9.95;
		$interest1=9.95/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=7500000)
	{
		$inter1=9.95;
		$interest1=9.95/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter1=10.10;
		$interest1=10.10/1200;
	}
	
$emi_5yrs = round($loan_amount * $interest1 / (1 - (pow(1/(1 + $interest1),$term))),2);
$total_emi= "<b>Scheme I:</b> Rs.".$emi_5yrs."(Fixed for 5 yrs), Then market rate<br> <b>Scheme II:</b>  Rs.".$emi;

$total_inter="<b>Scheme I:</b> ".$inter1."% (Fixed for 5 yrs), Then market rate<br> <b>Scheme II:</b> ".$inter;

$perlacemi1 = round(100000 * $interest1 / (1 - (pow(1/(1 + $interest1),$term))),2);

$total_perlacemi= "<b>Scheme I:</b> Rs.".$perlacemi1."(Fixed for 5 yrs), Then market rate<br> <b>Scheme II:</b> Rs.".$perlacemi;

	$details[]= $total_emi;
	$details[] = $total_inter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $total_perlacemi;
	$details[]= $term;
			
			
	
return($details);


}


Function  IDBI_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);


		$applicableFOIR = round($netAmount * 50 / 100)	;

	if($loan_amount<2000000)
	{

		$inter=9;
		$interest=9/1200;

	}
	elseif($loan_amount>2000000 && $loan_amount<=3000000)
	{
		$inter=9.25;
		$interest=9.25/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=5000000)
	{
		$inter=9.50;
		$interest=9.50/1200;
	}
	elseif($loan_amount>5000000)
	{
		$inter=9.75;
		$interest=9.75/1200;
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

		$emi = $spemi."(Fixed for 2 yrs)<br>then ".$actualemi;
		//echo $loan_amount."<br>";
		
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))));

		$forfirsttwoemi = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
//$idbiinter="8.25% (Fixed for 2 yrs)<br>".abs($inter)."";
$idbiinter="".abs($inter)."";
$idbiperlac=abs($perlacemi);
//$idbiperlac=$forfirsttwoemi."(Fixed For 2 yrs)<br>".abs($perlacemi);

//echo $print_term;
	$details[]= $actualemi;
	$details[]= $emi;
	$details[] = $idbiinter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $idbiperlac;
	$details[]= $forfirsttwoemi;
	$details[]= $term;
	$details[]= $spemi;
			
			
	
return($details);
}

Function  HDFC_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);


		$applicableFOIR = round($netAmount * 50 / 100)	;

	if($loan_amount<=2000000)
	{

		$inter=9.25;
		$interest=9.25/1200;

	}
	elseif($loan_amount>2000000 && $loan_amount<=3000000)
	{
		$inter=9.50;
		$interest=9.50/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=7500000)
	{
		$inter=9.75;
		$interest=9.75/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=9.75;
		$interest=9.75/1200;
	}
		$princ=100000;


		$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);

		$loan_amount = $viewLoanAmt ;
	
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
	if($loan_amount<=2000000)
	{

		$inter=9.25;
		$interest=9.25/1200;

	}
	elseif($loan_amount>2000000 && $loan_amount<=3000000)
	{
		$inter=9.50;
		$interest=9.50/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=7500000)
	{
		$inter=9.75;
		$interest=9.75/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=9.75;
		$interest=9.75/1200;
	}

		
//fixed for 1yr
		$spinter = 8.50;
		$spinterest = $spinter / 1200;
		$spemi = round($loan_amount * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);

//fixed fo 2 1yr
$pinter2 = 9.50;
		$interest2 = $pinter2 / 1200;
		$semi2 = round($loan_amount * $interest2 / (1 - (pow(1/(1 + $interest2),$term))),2);
$restemi=$spemi." (Upto Mar 31,2011)<br>".$semi2." (from Apr 1,2011 -<br> Mar 31,2012)";

		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		$emi = $actualemi;
		//echo $loan_amount."<br>";
		
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		$perlacemi1 = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		$perlacemi2 = round(100000 * $interest2 / (1 - (pow(1/(1 + $interest2),$term))),2);

//$exactperlacemi=abs($perlacemi1)."(Upto Mar 31,2011)<br>Rs.".abs($perlacemi2)." (from Apr 1,2011 -<br> Mar 31,2012), Then Rs.".abs($perlacemi);
$exactperlacemi=abs($perlacemi);
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))));

		//$forfirsttwoemi = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
//$hdfcinter="8.50% (Upto Mar 31,2011),<br>9.50% (from Apr 1,2011 -<br> Mar 31,2012), Then".abs($inter);
$hdfcinter=abs($inter);
$getemi=$emi;
//$getemi=$restemi.", Then ".$emi;

//echo $print_term;
	$details[]= $restemi;
	$details[]= $getemi;
	$details[] = $hdfcinter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $exactperlacemi;
	$details[]= $forfirsttwoemi;
	$details[]= $term;
	$details[]= $spemi;
				
return($details);
}


Function  Axis_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);


		$applicableFOIR = round($netAmount * 55 / 100)	;

	if($loan_amount<2000000)
	{

		$inter=9.25;
		$interest=9.25/1200;

	}
	elseif($loan_amount>2000000 && $loan_amount<=3000000)
	{
		$inter=9.50;
		$interest=9.50/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=7500000)
	{
		$inter=9.75;
		$interest=9.75/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=10;
		$interest=10/1200;
	}
		$princ=100000;


		$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
//echo "hwllo: ".$viewLoanAmt."<br>";
		$loan_amount = $viewLoanAmt ;
		/*--*/
		if($loan_amount<2000000)
	{

		$inter=9.25;
		$interest=9.25/1200;

	}
	elseif($loan_amount>2000000 && $loan_amount<=3000000)
	{
		$inter=9.50;
		$interest=9.50/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=7500000)
	{
		$inter=9.75;
		$interest=9.75/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=10;
		$interest=10/1200;
	}
		
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
		

//fixed for 1yr
		$spinter = 8.25;
		$spinterest = $spinter / 1200;
		$spemi = round($loan_amount * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);

//fixed fo 2 1yr
$pinter2 = 9;
		$interest2 = $pinter2 / 1200;
		$semi2 = round($loan_amount * $interest2 / (1 - (pow(1/(1 + $interest2),$term))),2);
$restemi=$spemi." (Upto Mar 31,2011)<br>".$semi2." (from Apr 1,2011 -<br> Mar 31,2012)";

		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		$emi = $actualemi;
			
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		$perlacemi1 = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		$perlacemi2 = round(100000 * $interest2 / (1 - (pow(1/(1 + $interest2),$term))),2);

//$exactperlacemi=abs($perlacemi1)."(Upto Mar 31,2011)<br>Rs.".abs($perlacemi2)." (from Apr 1,2011 -<br> Mar 31,2012), Then Rs.".abs($perlacemi);

$exactperlacemi = abs($perlacemi);
		
//$axisinter="8.25% (Upto Mar 31,2011),<br>9% (from Apr 1,2011 -<br> Mar 31,2012), Then".abs($inter);
$axisinter = abs($inter);

//$getemi=$restemi.", Then ".$emi;

$getemi = $emi;

		///////////////////////////////////////////////////////////////////////////////////////

		/*$spinter = 8.25;
		$spinterest = $spinter / 1200;

		$spemi = round($loan_amount * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		//$emi = $spemi."(Fixed for 2 yrs) then ".$actualemi;
		$emi = $actualemi;
		//echo $loan_amount."<br>";
		
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))));

		$forfirsttwoemi = round(100000 * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);*/

//echo $print_term;
	$details[]= $actualemi;
	$details[]= $getemi;
	$details[] = $axisinter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $exactperlacemi;
	$details[]= $forfirsttwoemi;
	$details[]= $term;
	$details[]= $spemi;
				
return($details);
}

function sbi_homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);

	$applicableFOIR = round($netAmount * 50 / 100)	;
		
		$inter=10;
		$interest=10/1200;
		$princ=100000;

	$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
	$loan_amount= $viewLoanAmt;
//echo $loan_amount."<br>";
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

		//echo $loan_amount."<br>";
		
		//$emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))));

	
	if($loan_amount>7500000)
	{
		$inter1=10;
		$interest1=10/1200;

		$total_emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		$total_perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		$total_inter=$inter1;
	}
	else
	{
		//8.75% (1st yr), 9.5%(2nd  and 3rd yr),10%(after 3 years) <br> (9.55% average floating rate upto 5 years)
	$inter_1yr=8.75;
	$interest_1yr=8.75/1200;

	$inter_2n3yr=9.50;
	$interest_2n3yr=9.50/1200;

	$inter_af3yr=10;
	$interest_af3yr=10/1200;

	if($print_term>0)
	{
		$term_left=$print_term-3;
		$actual_rate =(27.75 + (10*$term_left)) / $print_term;
		//$inter_up5yr=9.55;
	//$interest_up5yr=9.55/1200;
	$inter_up5yr=substr(trim($actual_rate), 0, strlen(trim($actual_rate))-2);
	//echo substr(trim($actual_rate), 0, strlen(trim($actual_rate))-2);
	$interest_up5yr=$actual_rate/1200;
	}
	
	$emi_1yr = round($loan_amount * $interest_1yr / (1 - (pow(1/(1 + $interest_1yr),$term))),2);
	$emi_2n3yr = round($loan_amount * $interest_2n3yr / (1 - (pow(1/(1 + $interest_2n3yr),$term))),2);
	$emi_af3yr = round($loan_amount * $interest_af3yr / (1 - (pow(1/(1 + $interest_af3yr),$term))),2);
	$emi_up5yr = round($loan_amount * $interest_up5yr / (1 - (pow(1/(1 + $interest_up5yr),$term))),2);

$total_emi= "Rs.".$emi_1yr." (1st yr)<br> Rs.".$emi_2n3yr." (2nd & 3rd yr)<br> Rs.".$emi_af3yr." (after 3 yrs)<br>Rs.".$emi_up5yr." (average floating EMI upto ".$print_term." years)";

$total_inter=$inter_1yr."% (1st yr)<br> ".$inter_2n3yr."% (2nd & 3rd yr)<br> ".$inter_af3yr."% (after 3 yrs)<br><b>".$inter_up5yr."% (average floating rate upto ".$print_term." years)</b>";

$perlacemi_1yr = round(100000 * $interest_1yr / (1 - (pow(1/(1 + $interest_1yr),$term))),2);
$perlacemi_2n3yr = round(100000 * $interest_2n3yr / (1 - (pow(1/(1 + $interest_2n3yr),$term))),2);
$perlacemi_af3yr = round(100000 * $interest_af3yr / (1 - (pow(1/(1 + $interest_af3yr),$term))),2);
$perlacemi_up5yr = round(100000 * $interest_up5yr / (1 - (pow(1/(1 + $interest_up5yr),$term))),2);

$total_perlacemi= "Rs.".$perlacemi_1yr." (1st yr)<br> Rs.".$perlacemi_2n3yr." (2nd & 3rd yr)<br> Rs.".$perlacemi_af3yr." (after 3 yrs)<br> Rs.".$perlacemi_up5yr." (average floating EMI upto ".$print_term." years)";
	}
	
	$details[]= $total_emi;
	$details[] = $total_inter;
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $total_perlacemi;
	$details[]= $term;
			
return($details);


}
		?>