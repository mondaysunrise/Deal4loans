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

Function  federal_Homeloan($netAmount,$DOB,$obligations,$property_value)
{
	list($term,$print_term)=getdob($DOB);
	
	$applicableFOIR = round($netAmount * 70 / 100)	;
		$inter=10.20;
		$interest=10.20/1200;
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
$inter=10.20;
$interest=10.20/1200;

	$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
	$emi = $actualemi;
	$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$federalinter="".abs($inter)."";
$idbiperlac=abs($perlacemi);

	$details[]= $emi;
	$details[] = $federalinter;
	$details[] = $print_term;
	$details[] = $loan_amount;

return($details);
}//federal


Function  federal_Homeloannew($netAmount,$DOB,$obligations,$property_value,$loan_amount)
{
	list($term,$print_term)=getdob($DOB);
	
	$applicableFOIR = round($netAmount * 70 / 100)	;
		
if($loan_amount<=3000000)
		{
			$inter = 10.50;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>3000000) && ($loan_amount<=7500000))
		{
			$inter = 10.50;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>7600000)
		{
			$inter = 10.50;
			$interest = $inter / 1200;
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

if($loan_amount<=3000000)
		{
			$inter = 10.50;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>3000000) && ($loan_amount<=7500000))
		{
			$inter = 10.50;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>7600000)
		{
			$inter = 10.50;
			$interest = $inter / 1200;
		}

	$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
	$emi = $actualemi;
	$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$federalinter="".abs($inter)."";
$idbiperlac=abs($perlacemi);

	$details[]= $emi;
	$details[] = $federalinter;
	$details[] = $print_term;
	$details[] = $loan_amount;

return($details);
}//federal new

Function  ICICI_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	$getlocationlist=d4l_ExecQuery("Select location_category From icici_hfc_location_list Where location_name like '%".$City."%'");
		$row=d4l_mysql_fetch_array($getlocationlist);
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
		
		
		if($loan_amount>50000000)
		{
			$inter=8.80;
			$interest=$inter/1200;
		}
		elseif($loan_amount>7500000 && $loan_amount<=50000000)
		{
			$inter=8.70;
			$interest=$inter/1200;
		}
		elseif($loan_amount<=7500000)
		{
			$inter=8.65;
			$interest=$inter/1200;
		}
		else
		{
			$inter=8.65;
			$interest=$inter/1200;
		}
		$princ=100000;
		

		list($term,$print_term)=getdob($DOB);
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

	if($loan_amount>50000000)
		{
			$inter=8.80;
			$interest=$inter/1200;
		}
		elseif($loan_amount>7500000 && $loan_amount<=50000000)
		{
			$inter=8.70;
			$interest=$inter/1200;
		}
		elseif($loan_amount<=7500000)
		{
			$inter=8.65;
			$interest=$inter/1200;
		}
		else
		{
			$inter=8.65;
			$interest=$inter/1200;
		}

		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		
		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		$exactinter=$inter;

		$exactperlacemi=abs($perlacemi);

		//$exactperlacemi="Rs ".abs($perlacemifor1)."(Fixed for 1st yr), Rs".abs($perlacemifor2)."(Fixed for 2nd yr),Then ".abs($perlacemi);
//$getemi=$restemi.", Then ".$actualemi;
$getemi = $actualemi;
	

	$details[]= round($getemi);
	$details[]= round($emi);
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
	$tenurechk=65 - $DOB;
		if($tenurechk>25)
		{
			$term=25*12;
			$print_term=25;
		}
		else
		{
			if($tenurechk>=5)
			{
			$term=$tenurechk*12;
			$print_term=$tenurechk;}
			else
			{
			}
		}
	
	//Income To Loan Ratio - 60%
	$applicableFOIR = round($netAmount * 60 / 100);

	//Interest rate
	if($loan_amount>50000000)
			{
				$inter=8.80;
				$interest=$inter/1200;
			}
			elseif($loan_amount<=50000000 && $loan_amount>20000000)
			{
				$inter=8.70;
				$interest=$inter/1200;
			}
			elseif($loan_amount<=20000000 && $loan_amount>30000000)
			{
				$inter=8.50;
				$interest=$inter/1200;
			}
			elseif($loan_amount<=30000000)
			{
				$inter=8.40;
				$interest=$inter/1200;
			}
			else
			{$inter=8.40;
				$interest=$inter/1200;}
	
		$princ=100000;
		$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
		$loan_amount= $viewLoanAmt;

if($property_value>1)
	{
	if($property_value>7500000)
		{
			$getproperty_value= $property_value * (.75);
		}
		elseif($property_value>3000000 && $property_value<=7500000)
		{
			$getproperty_value= $property_value * (.80);
		}
		elseif($property_value<=3000000)
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
	}
	if($loan_amount>50000000)
			{
				$inter=8.80;
				$interest=$inter/1200;
			}
			elseif($loan_amount<=50000000 && $loan_amount>20000000)
			{
				$inter=8.70;
				$interest=$inter/1200;
			}
			elseif($loan_amount<=20000000 && $loan_amount>30000000)
			{
				$inter=8.50;
				$interest=$inter/1200;
			}
			elseif($loan_amount<=30000000)
			{
				$inter=8.40;
				$interest=$inter/1200;
			}
			else
			{$inter=8.40;
				$interest=$inter/1200;}
	//processingfee
	if($loan_amount>5000000 && $loan_amount<=30000000)
	{
		$procfee=15000;
	}
	elseif($loan_amount<=5000000)
	{
		$procfee=10000;
	}
	else
	{}

	$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
	
	$details[]= $procfee;
	$details[]= $actualemi;
	$details[] = $inter;
	$details[] = $print_term;
	$details[]= $loan_amount;
	$details[]= $print_term;
	
return($details);

}


Function  IDBI_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);


		$applicableFOIR = round($netAmount * 50 / 100)	;

	if($loan_amount<2500000)
	{
		$inter=10.25;
		$interest=10.25/1200;

	}
	elseif($loan_amount>2500000 && $loan_amount<=3000000)
	{
		$inter=10.25;
		$interest=10.25/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=7500000)
	{
		$inter=10.25;
		$interest=10.25/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=10.50;
		$interest=10.50/1200;
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
	
if($loan_amount<2500000)
	{
		$inter=10.25;
		$interest=10.25/1200;

	}
	elseif($loan_amount>2500000 && $loan_amount<=3000000)
	{
		$inter=10.25;
		$interest=10.25/1200;
	}
	elseif($loan_amount>3000000 && $loan_amount<=7500000)
	{
		$inter=10.25;
		$interest=10.25/1200;
	}
	elseif($loan_amount>7500000)
	{
		$inter=10.50;
		$interest=10.50/1200;
	}
		$spinter = 8.25;
		$spinterest = $spinter / 1200;

		$spemi = round($loan_amount * $spinterest / (1 - (pow(1/(1 + $spinterest),$term))),2);
		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		//$emi = $spemi."(Fixed for 2 yrs)<br>then ".$actualemi;
		$emi = $actualemi;
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

	if($loan_amount>7500000)
		{
			$inter=8.55;
			$interest=$inter/1200;
		}
		elseif($loan_amount>3000000 && $loan_amount<=7500000)
		{
			$inter=8.50;
			$interest=$inter/1200;
		}
		elseif($loan_amount<=3000000)
		{
			$inter=8.40;
			$interest=$inter/1200;
		}else
		{
			$inter=8.40;
			$interest=$inter/1200;
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

	if($loan_amount>7500000)
		{
			$inter=8.55;
			$interest=$inter/1200;
		}
		elseif($loan_amount>3000000 && $loan_amount<=7500000)
		{
			$inter=8.50;
			$interest=$inter/1200;
		}
		elseif($loan_amount<=3000000)
		{
			$inter=8.40;
			$interest=$inter/1200;
		}else
		{
			$inter=8.40;
			$interest=$inter/1200;
		}
$yrs10term=120;
$emi10yrs = round($loan_amount * $interest10yrs / (1 - (pow(1/(1 + $interest10yrs),$yrs10term))),2);
$emi10yrs_nxt = round($loan_amount * $interest10yrs / (1 - (pow(1/(1 + $interest10yrs),$yrs10term))),2);

$emi5yrs = round($loan_amount * $interest5yrs / (1 - (pow(1/(1 + $interest5yrs),$term))),2);

$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
$emi = $actualemi;
				
$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$perlacemi3yrs = round(100000 * $interest3yrs / (1 - (pow(1/(1 + $interest3yrs),$term))),2);
$perlacemi5yrs = round(100000 * $interest5yrs / (1 - (pow(1/(1 + $interest5yrs),$term))),2);

$exactperlacemi=abs($perlacemi);
		
$hdfcinter=abs($inter);
$getemi=$emi;
/*if($loan_amount<=3000000)
	{
$total_emi = "Scheme I : Rs.".$emi10yrs." (Upto 10Lacs) (Fixed for 10yrs), then ".$emi10yrs_nxt." <br> Scheme II : Rs.".$getemi;
$total_inter= "Scheme I : ".$inter10yrs."% (Upto 10Lacs) (Fixed for 10yrs) , then 11%(Fixed for 10yrs<br> Scheme II : ".$hdfcinter."%";
	}
	else
	{*/
	$total_emi = $getemi;
	$total_inter= $hdfcinter." %";
	//}

$total_perlemi = $exactperlacemi;

	$details[]= round($restemi);
	$details[]= round($total_emi);
	$details[] = $total_inter; 
	$details[] = $print_term;
	$details[] = $loan_amount;
	$details[]= $loan_amount;
	$details[]= $total_perlemi;
	$details[]= $forfirsttwoemi;
	$details[]= $term;
	$details[]= $spemi;
				
return($details);
}


Function  Axis_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value)
{
	list($term,$print_term)=getdob($DOB);
	$applicableFOIR = round($netAmount * 55 / 100)	;

	if($loan_amount>7500000)
	{
		$inter=9.15;
		$interest=$inter/1200;
	}
	elseif($loan_amount>2800000 && $loan_amount<=7500000)
	{
		$inter=9.10;
		$interest=$inter/1200;
	}
	elseif($loan_amount<=2800000)
	{
		$inter=9.10;
		$interest=$inter/1200;
	}
		$princ=100000;

		$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		$viewLoanAmt = round($loanPossible * 100000);
//echo "hwllo: ".$viewLoanAmt."<br>";
		$loan_amount = $viewLoanAmt ;
		/*--*/
	if($loan_amount>7500000)
	{
		$inter=9.15;
		$interest=$inter/1200;
	}
	elseif($loan_amount>2800000 && $loan_amount<=7500000)
	{
		$inter=9.10;
		$interest=$inter/1200;
	}
	elseif($loan_amount<=2800000)
	{
		$inter=9.10;
		$interest=$inter/1200;
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
		

	
	$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$actual_emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
$axisinter=$inter;
$exactperlacemi=$actual_emi;

//echo $print_term;
	$details[]= $actualemi;
	$details[]= $exactperlacemi;
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
		$tenurechk=65 - $DOB;
		if($tenurechk>30)
		{
			$term=30*12;
			$print_term=30;
		}
		else
		{
			$term=$tenurechk*12;
			$print_term=$tenurechk;
		}
		
		if($loan_amount>7500000)
		{
			$inter=8.50;
			$interest=$inter/1200;
		}
		elseif($loan_amount>3000000 && $loan_amount<=7500000)
		{
			$inter=8.40;
			$interest=$inter/1200;
		}
		else
		{
			$inter=8.40;
			$interest=$inter/1200;
		}
		//FOIR
		if($netAmount>1000000)
		{
			$applicableFOIR= round($netAmount * 70 / 100);
		}
		elseif($netAmount>800000 && $netAmount<=1000000)
		{
			$applicableFOIR= round($netAmount * 65 / 100);
		}
		elseif($netAmount>500000 && $netAmount<=800000)
		{
			$applicableFOIR= round($netAmount * 60 / 100);
		}
		elseif($netAmount>300000 && $netAmount<=500000)
		{
			$applicableFOIR= round($netAmount * 50 / 100);
		}
		else
		{
			$applicableFOIR= round($netAmount * 50 / 100);
		}
	$princ=100000;

	$emicalc=($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));

	$loanPossible= ($applicableFOIR)/$emicalc;
	$viewLoanAmt = round($loanPossible * 100000);
		//FOIR End
		if($property_value>1)
		{
			if($property_value>7500000)
			{
				$getproperty_value= $property_value * (.75);
			}
			elseif($property_value>3000000 && $property_value>=7500000)
			{
				$getproperty_value= $property_value * (.80);
			}
			else
			{
				$getproperty_value= $property_value * (.90);
			}
		}
	
	if($viewLoanAmt>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$viewLoanAmt;
		}

	if($loan_amount>7500000)
		{
			$inter=8.50;
			$interest=$inter/1200;
		}
		elseif($loan_amount>3000000 && $loan_amount<=7500000)
		{
			$inter=8.40;
			$interest=$inter/1200;
		}
		else
		{
			$inter=8.40;
			$interest=$inter/1200;
		}
	 $actual_emi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
	$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
	$total_inter= $inter;
		
	$details[]= $proc_fee;
	$details[]= $actual_emi;
	$details[] = $total_inter;
	$details[] = $print_term;
	$details[]= $loan_amount;
	$details[]= $term;
			
	return($details);
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

function Citibank_hl($netAmount,$DOB,$property_value,$Employment_Status)
{	
	if($Employment_Status==1) {$Maxtenure=25;} else {$Maxtenure=20;}
	$tenure = 65 - $age;
		if($tenure>$Maxtenure)
		{
			$print_term=$Maxtenure;
		}
		else
		{
			$print_term=$tenure;
		}
		$term = $print_term * 12;
		if($print_term>0)
		{	
			if($property_value<=7500000)
			{
				$loanamount = round($property_value * 80 / 100)	;
			}
			else
			{
				$loanamount = round($property_value * 75 / 100)	;
			}
			
			if($loanamount>=100000000)
			{
				$finalloanamount =100000000;
			}
			else
			{
				if($loanamount<500000)
				{
					$finalloanamount=0;				
				}
				else
				{
					$finalloanamount=$loanamount;	
				}
			}			
		}
		$citiinter=10.10;
		$interest=$citiinter/1200;
		$citiemi=($finalloanamount * $interest / (1 - (pow(1/(1 + $interest), $term))));
		
	$details[]= round($citiemi);
	$details[] = $citiinter;
	$details[] = $print_term;
	$details[] = $finalloanamount;

return($details);
}

Function  PNB_Homeloan($netAmount,$DOB,$obligations,$property_value)
{	
	list($term,$print_term)=getdob($DOB);
	
	 $applicableFOIR = round($netAmount * 50 / 100)	;

	if($loan_amount>=7500000)
	{
		$inter=8.50;
		$interest=$inter/1200;
	}
	else
	{
		$inter=8.50;
		$interest=$inter/1200;
	}	
		$princ=100000;

$emicalc=($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));

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

if($loan_amount>=7500000)
	{
		$inter=8.60;
		$interest=$inter/1200;
	}
	else
	{
		$inter=8.60;
		$interest=$inter/1200;
	}	

$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
$emi = $actualemi;
$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$pnbinter="".abs($inter)."";
$idbiperlac=abs($perlacemi);

	$details[]= round($emi);
	$details[] = $pnbinter;
	$details[] = $print_term;
	$details[] = $loan_amount;

return($details);
}//PNB

//TATA Capital

Function  TATACapital_Homeloan($netAmount,$loan_amount,$DOB,$obligations,$property_value,$Employment_Status)
{	
		$netAmount=$netAmount+$obligations;
		$tenurechk=58 - $DOB;
		if($tenurechk>25)
		{
			$term=25*12;
			$print_term=25;
		}
		else
		{
			$term=$tenurechk*12;
			$print_term=$tenurechk;
		}
		//echo $netAmount;
	//list($term,$print_term)=getdob($DOB);
	if($loan_amount>=7500000)
			{
				$intervhl= 8.85;
				$interestvhl=$intervhl/1200;
			}
			else
			{
				$intervhl= 8.80;
				$interestvhl=$intervhl/1200;
			}


	if($Employment_Status==1)
	{
	if($netAmount<=75000)
			{
				$applicableFOIR = round($netAmount * 55 / 100);
			}
			elseif($netAmount>75000 && ($netAmount<=200000))
			{
				$applicableFOIR = round($netAmount * 60 / 100);
			}
			elseif($netAmount>200000)
			{
				$applicableFOIR = round($netAmount * 65 / 100);
			}
		}
		else
		{
			$applicableFOIR = round($netAmount * 65 / 100);
		}
	
		$princ=100000;	
				 $emiPerLac = round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));
 $check=$applicableFOIR - $obligations;
		 $loanPossible = $check / $emiPerLac;
	$viewLoanAmt = $loanPossible * 100000;
		
		if($viewLoanAmt>100000000)
		{
			$viewLoanAmt1=100000000;
		}
		else
		{
			$viewLoanAmt1=$viewLoanAmt;
		}
	
	if($property_value>7500000)
		{
			$viewLoanAmt2 = round($property_value * 75 / 100);
		}
		elseif($property_value>2000000 && $property_value<=7500000)
		{
			$viewLoanAmt2 = round($property_value * 80 / 100);
		}
		elseif($property_value<=2000000)
		{
			$viewLoanAmt2 = round($property_value * 90 / 100);
		}

	if($viewLoanAmt1>1 && $viewLoanAmt2>1)
	{
	if($viewLoanAmt1>$viewLoanAmt2)
	{
		$loan_amount = $viewLoanAmt2;
	}
	else
	{
			$loan_amount = $viewLoanAmt1;	
	}
	}
	else
	{
		$loan_amount = $viewLoanAmt1;
	}
	if($loan_amount>=7500000)
			{
				$intervhl= 8.85;
				$interestvhl=$intervhl/1200;
			}
			else
			{
				$intervhl= 8.80;
				$interestvhl=$intervhl/1200;
			}

		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
	
		$exactinter=$inter;
		$processing_fee="";
	
	$details[]= $processing_fee;	
	$details[]= round($actualemi);
	$details[] = $exactinter;
	$details[] = $print_term;
	$details[] = round($loan_amount);
				
return($details);
}
//END of TATA Capital

//start of axisbank 
Function  Axisbank($netAmount,$loan_amount,$DOB,$obligations,$property_value,$Employment_Status)
{
	$maxterm = 65 - $DOB;
	if($maxterm>30)
	{
		$print_term=30;
		$term = $print_term * 12;
	}
	else
	{
		if($maxterm>0)
		{
			$print_term=$maxterm;
			$term = $print_term * 12;
		}
	}

	if($property_value>1)
	{
		if($property_value>7500000)
		{
			$loan_amount= round($property_value * 75 / 100);
		}
		elseif($property_value>2000000 && $property_value<=7500000)
		{
			$loan_amount= round($property_value * 80 / 100);
		}
		else
		{
			$loan_amount= round($property_value * 90 / 100);
		}
	}
	//for salaried
		if($Employment_Status==1)
			{
				if($loan_amount>7500000)
				{
					//Vanilla Home loans
					$intervhl= 8.70;
					$interestvhl=$intervhl/1200;
				}
				else
				{
					//Vanilla Home loans
					$intervhl= 8.65;
					$interestvhl=$intervhl/1200;
				}
			}
		else //Self employed
			{
				//Vanilla Home loans
				if($loan_amount>7500000)
				{
					//Vanilla Home loans
					$intervhl= 8.75;
					$interestvhl=$intervhl/1200;
				}
			else
				{
					//Vanilla Home loans
					$intervhl= 8.70;
					$interestvhl=$intervhl/1200;
				}
						
			}
			$exactinter=$intervhl;
	$actualemi=round($loan_amount * $interestvhl / (1 - (pow(1/(1 + $interestvhl), $term))));
		$processing_fee="1%";
	
	$details[]= $processing_fee;	
	$details[]= $actualemi;
	$details[] = $exactinter;
	$details[] = $print_term;
	$details[] = round($loan_amount);
				
return($details);
}//axis bank end

/*****************************************************/
//BankOfBaroda function starts here 
/**********************************************************/
Function  BankOfBaroda_Homeloan($netAmount,$DOB,$obligations,$property_value)
{
	
	$maxterm = 60 - $DOB;
	if($maxterm>30)
	{
		$print_term=30;
		$term = $print_term * 12;
	}
	else
	{
		if($maxterm>0)
		{
			$print_term=$maxterm;
			$term = $print_term * 12;
		}
	}


	//income creteria
	//multiplier
	if($netAmount>=100000)
		{ 
			$loan_amt=$netAmount*60;
		}
		elseif($netAmount>=50000 && $netAmount<100000)
		{ 
			$loan_amt=$netAmount*54;
		}
		elseif($netAmount<50000)
		{ 
			$loan_amt=$netAmount*48;
		}
		else
		{ 
			$loan_amt=$netAmount*48;
		}		

	//LTV ratio
	if($property_value>1)
	{
		if($property_value>7500000)
		{
			$loan_amt2= round($property_value * 75 / 100);
		}
		elseif($property_value>2000000 && $property_value<=7500000)
		{
			$loan_amt2= round($property_value * 80 / 100);
		}
		else
		{
			$loan_amt2= round($property_value * 90 / 100);
		}
	}
	
	$printinter="8.35%";
	$interestrate1=8.35/1200;
	//$interestrate2=9.55/1200;

	if($loan_amt>1 && $loan_amt2>1)
	{
		if($loan_amt>$loan_amt2)
		{
			$loan_amount = $loan_amt2;
		}
		else
		{
			$loan_amount = $loan_amt;	
		}
	}
	else
	{
		$loan_amount = $loan_amt;
	}
	$actualemi1 = round($loan_amount * $interestrate1 / (1 - (pow(1/(1 + $interestrate1),$term))),2);
	$actualemi2 = round($loan_amount * $interestrate2 / (1 - (pow(1/(1 + $interestrate2),$term))),2);
	//$emi = "Rs.".$actualemi1."- Rs.".$actualemi2;
	$emi = "Rs.".$actualemi1;
	
	$processing_fee="NA";
	$details[]= $processing_fee;
	$details[]= $emi;
	$details[] = $printinter;
	$details[] = $print_term;
	$details[] = $loan_amount;

	return($details);
}//BankOfBaroda function ends here

		
		?>
