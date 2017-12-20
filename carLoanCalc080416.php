<?php
echo "Testing Ajax";
$income = $_REQUEST['income'];
$age = $_REQUEST['age'];
$car_category = $_REQUEST['car_category'];
$car_segment = $_REQUEST['car_segment'];
$company_cat = $_REQUEST['company_cat'];
$hdfc_car_price = $_REQUEST['hdfc_car_price'];
$hdfc_clid = $_REQUEST['hdfc_clid'];
$hdfc_ratecat = $_REQUEST['hdfc_ratecat'];
$hdfc_city = $_REQUEST['hdfc_city'];
$hdfc_car_name = $_REQUEST['hdfc_car_name'];
$emp_Stat = $_REQUEST['emp_Stat'];
$Experience = $_REQUEST['Experience'];
$salary_account = $_REQUEST['salary_account'];
$resi_stable = $_REQUEST['resi_stable'];
$krc_flag = $_REQUEST['krc_flag'];
$Car_Type = $_REQUEST['Car_Type'];
function hdfccl_listdcomp($income,$age,$car_category,$car_segment,$company_cat,$hdfc_car_price, $hdfc_clid, $hdfc_ratecat, $hdfc_city, $hdfc_car_name, $emp_Stat , $Experience, $salary_account, $resi_stable,$krc_flag, $Car_Type=1)
{
//	echo $income." - ".$age." - ".$car_category." - ".$car_segment." - ".$company_cat." - ".$hdfc_car_price." - ".$hdfc_clid." - ".$hdfc_ratecat." - ".$hdfc_city." - ".$hdfc_car_name." - ".$emp_Stat." - ".$Experience." - ". $salary_account." - ".$resi_stable." - ".$krc_flag." - ".$Car_Type;
//echo "<br>";
//$term = 29;
//$print_term=7;

	list($term,$print_term)=getdob($age);
	
	if($emp_Stat==1)
	{
		if(($income>=150000 && $income< 250000) && $Experience>=2 && $age>=21 && $resi_stable>=2)
		{
			$loan_amount=$income*2.5;
			$final_ltvmount = $hdfc_car_price * (80 / 100);
		}
		elseif($income>=250000 && $Experience>=3 && $age>=25 && $resi_stable>=2)
		{
			if($salary_account==1)
			{
				//$final_ltvmount = $hdfc_car_price;
				$final_ltvmount = $hdfc_car_price * (90 / 100);
			}
			else
			{
				$final_ltvmount = $hdfc_car_price * (90 / 100);
			}
			$loan_amount=$income*2;
			
		}
		else
		{
			if(($income>=150000 && $income< 250000) && $Experience>=2 && $age>=21 && $resi_stable>=2)
			{
				$loan_amount=$income*2.5;
				$final_ltvmount = $hdfc_car_price * (80 / 100);
			}
			else
			{
				$loan_amount=$income*2.5;
				$final_ltvmount = $hdfc_car_price * (80 / 100);
			}
		}
	}
	elseif($emp_Stat==0)
	{
		if(($income>=150000 && $income< 300000) && $Experience>=2 && $age>=25 && $resi_stable>=2)
		{
			$loan_amount=$income* 2.5;
			$final_ltvmount = $hdfc_car_price * (75 / 100);
		}
		elseif($income>=300000 && $Experience>=4 && $age>=30 && $resi_stable>=4)
		{
			$loan_amount=$income*4;
			$final_ltvmount = $hdfc_car_price * (85 / 100);
		}
		else
		{
			if(($income>=150000 && $income< 300000) && $Experience>=2 && $age>=25 && $resi_stable>=2)
			{
				$loan_amount=$income* 2.5;
			$final_ltvmount = $hdfc_car_price * (75 / 100);
			}
			else
			{
			$loan_amount=$income* 2.5;
			$final_ltvmount = $hdfc_car_price * (75 / 100);
			}
		}
	}

//rate with LTV
$getltv="select ltv_36months,ltv_60months,ltv_84months From hdfc_car_list_category Where (hdfc_clid='".$hdfc_clid."')";
list($alreadyExist,$rowltv)=MainselectfuncNew($getltv,$array = array());
$rowltvcontr = count($rowltv)-1;
$ltv_36 = $rowltv[$rowltvcontr]["ltv_36months"];
$ltv_60 = $rowltv[$rowltvcontr]["ltv_60months"];
$ltv_84 = $rowltv[$rowltvcontr]["ltv_84months"];

if($ltv_84>0 && ($term>60 && $term<=84))
	{
		$ltvterm=$term;
	}
else if($ltv_60>0 && ($term>36 && $term<=60))
	{
		$ltvterm=$term;
	}
else if($ltv_36>0 && ($term<=36))
	{
		$ltvterm=$term;
	}
	else
	{
		$nwfinal_ltvmount = $hdfc_car_price * ($rowltv["ltv_".$term."months"] / 100);
		if($nwfinal_ltvmount>0)
		{
				$ltvterm=$term;
		}
		else
		{
			$nwfinal_ltvmount = $hdfc_car_price * ($rowltv["ltv_".($term-24)."months"] / 100);
		if($nwfinal_ltvmount>0)
			{
				$ltvterm=$term-24;
			}
			else
			{
				$nwfinal_ltvmount = $hdfc_car_price * ($rowltv["ltv_".($term-48)."months"] / 100);
				$ltvterm=$term-48;
				if($nwfinal_ltvmount>0)
					{
						$ltvterm=$term-48;
					}
			}
	}
	}

if($ltvterm>$term)
	{
		$nwterm=$ltvterm;
	}
	else {
$nwterm=$ltvterm;
	}
	
//	echo "<br>";
//echo  $loan_amount." -- ".	$final_ltvmount."--".$final_ltvmount;
	//echo "<br>";

		if(($final_ltvmount>0 && $loan_amount>0) && ($final_ltvmount>$loan_amount))
		{
			 $final_loanamt = $loan_amount;
		}
		else
		{
			$final_loanamt = $final_ltvmount;
		}
if($nwterm==84)
	{ $print_term=7; } else if ($nwterm==72){ $print_term=6; } else if ($nwterm==60){ $print_term=5; } else if ($nwterm==48){ $print_term=4; } else if ($nwterm==36){ $print_term=3; } else if ($nwterm==24){ $print_term=2; } else if ($nwterm==12){ $print_term=1; }

//echo "<br>";
//echo $company_cat.'--'.$hdfc_city.'--'.$nwterm.'--'.$hdfc_ratecat.'--'.$krc_flag;
//echo "<br>";
if($Car_Type==1)
{
	list($hdfcinterate) = hdfccl_rates($company_cat,$hdfc_city, $nwterm, $hdfc_ratecat, $krc_flag);
}
else
{
	list($hdfcinterate) = hdfccl_rates_usedcar($company_cat,$hdfc_city, $nwterm, $hdfc_ratecat, $krc_flag, $final_loanamt);
}
	$details[]= $nwterm;
	$details[]= $print_term;
	$details[]= $hdfcinterate;
	$details[]= $final_loanamt;
	return($details);
}///function hdfccl_listdcomp END

function hdfccl_rates($hdfc_company_cat,$hdfc_city, $hdfc_tenure, $hdfc_rate_segment,$krc_flag)
{
	if($krc_flag==2 && (strlen($hdfc_company_cat)>0 ))
	{	
		$intr_rate=10.75;
	}	
	else if($krc_flag==1 && (strlen($hdfc_company_cat)>0 ))
	{	
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
			$intr_rate=11.50;
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=11;
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=10.75;
		}
		else if ($hdfc_rate_segment=="C+")
		{
			$intr_rate=10.50;
		}
		else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=10.25;
		}
	}
	else if(($hdfc_company_cat=="GOVT" ||$hdfc_company_cat=="DEFENCE"))
	{
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
			$intr_rate=12;
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=11;
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=10.75;
		}
		else if ($hdfc_rate_segment=="C+")
		{
			$intr_rate=10.50;
		}
		else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=10.25;
		}
	}
	else if(($hdfc_company_cat=="CAT A" || $hdfc_company_cat=="SUPER A" || $hdfc_company_cat=="Cat A" || $hdfc_company_cat=="CAT B" || $hdfc_company_cat=="Cat B"))
	{
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
			$intr_rate=11.75;
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=11;
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=10.75;
		}
		else if ($hdfc_rate_segment=="C+")
		{
			$intr_rate=10.50;
		}
		else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=10.25;
		}
	}
	else if(($hdfc_company_cat=="CAT C" || $hdfc_company_cat=="Cat C" || $hdfc_company_cat=="CAT D" ||$hdfc_company_cat=="Cat D"))
	{
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
			//$intr_rate=12.50;
			$intr_rate=12.25;
		}	
		else if ($hdfc_rate_segment=="B")
		{
			//$intr_rate=12;
			$intr_rate=11;
		}
		else if ($hdfc_rate_segment=="C")
		{
			//$intr_rate=11.50;
			$intr_rate=10.75;
		}
		else if ($hdfc_rate_segment=="C+")
		{
			//$intr_rate=11.25;
			$intr_rate=10.50;
		}
		else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			//$intr_rate=11.25;
			$intr_rate=10.25;
		}
	}//company listed
	else
	{
		if($hdfc_city=="Delhi" || $hdfc_city=="Noida" || $hdfc_city=="Gaziabad" || $hdfc_city=="Gurgaon" || $hdfc_city=="Greater Noida" || $hdfc_city=="Faridabad" || $hdfc_city=="Mumbai" || $hdfc_city=="Pune" || $hdfc_city=="Nagpur" || $hdfc_city=="Nashik" || $hdfc_city=="Goa" || $hdfc_city=="Aurangabad" || $hdfc_city=="Hyderabad" || $hdfc_city=="Vijaywada" || $hdfc_city=="Vizag" || $hdfc_city=="Bangalore" || $hdfc_city=="Mangalore" || $hdfc_city=="Mysore" || $hdfc_city=="Chennai" || $hdfc_city=="Coimbatore" || $hdfc_city=="Ahmedabad" || $hdfc_city=="Baroda" || $hdfc_city=="Dehradun" || $hdfc_city=="Vellore" || $hdfc_city=="
Pondicherry" || $hdfc_city=="Rajkot" || $hdfc_city=="Surat" || $hdfc_city=="Ludhiana" || $hdfc_city=="Chandigarh" || $hdfc_city=="Patiala" || $hdfc_city=="Jaipur" || $hdfc_city=="Udaipur" || $hdfc_city=="Lucknow" || $hdfc_city=="Kanpur" || $hdfc_city=="Agra" || $hdfc_city=="Kolkatta" || $hdfc_city=="Bhubaneshwar" || $hdfc_city=="Jodhpur" || $hdfc_city==" Trichy" || $hdfc_city==" Madurai" || $hdfc_city==" Hubli" || $hdfc_city==" Kota" || $hdfc_city==" Kolhapur" || $hdfc_city==" Amritsar" || $hdfc_city==" Ahmednagar" || $hdfc_city==" Sholapur" || $hdfc_city==" Ajmer" || $hdfc_city==" Bhatinda" || $hdfc_city==" Srinagar" || $hdfc_city==" Pathankot" || $hdfc_city==" Satara" || $hdfc_city==" Sangli" || $hdfc_city==" Akola" || $hdfc_city==" Amravati" || $hdfc_city=="Baramati" || $hdfc_city=="Chandrapur" || $hdfc_city==" Guwahati" || $hdfc_city==" Raipur" || $hdfc_city=="Shillong" || $hdfc_city==" Indore" || $hdfc_city=="Bhopal" || $hdfc_city==" Rohtak" || $hdfc_city==" Hissar" || $hdfc_city=="Panipat" || $hdfc_city=="Ambala" || $hdfc_city=="Karnal" || $hdfc_city=="Guntur")
		{	
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
			{
				if($hdfc_tenure<36)
				{
//					$intr_rate=12.50;
					$intr_rate=12.25;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					$intr_rate=12.25;
		
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
//					$intr_rate=12.50;
					$intr_rate=12.25;
				}
			}
			else if($hdfc_rate_segment=="B")
			{
				if($hdfc_tenure<36)
				{
		//			$intr_rate=12.50;
					$intr_rate=11;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
			//		$intr_rate=12.25;
					$intr_rate=11;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12.50;
					$intr_rate=11;
				}
			}			
			else if ($hdfc_rate_segment=="C")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=12;
					$intr_rate=10.75;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=11.75;
					$intr_rate=10.75;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12;
					$intr_rate=10.75;
				}
				
			}
			else if ($hdfc_rate_segment=="C+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11.50;
					$intr_rate=10.50;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=11.25;
					$intr_rate=10.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11.50;
					$intr_rate=10.50;
				}
				
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11;
					$intr_rate=10.25;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=10.75;
					$intr_rate=10.25;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11;
					$intr_rate=10.25;
				}
				
			}

		}
		else
		{
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
			{
				if($hdfc_tenure<36)
				{
					//$intr_rate=12.75;
					$intr_rate=12.50;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=12.50;
					$intr_rate=12.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12.75;
					$intr_rate=12.50;
				}
			}
			else if($hdfc_rate_segment=="B")
			{
				if($hdfc_tenure<36)
				{
					//$intr_rate=12.75;
					$intr_rate=11.25;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=12.50;
					$intr_rate=11.25;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12.75;
					$intr_rate=11.25;
				}
			}

			else if ($hdfc_rate_segment=="C")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=12.25;
					$intr_rate=11;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=12;
					$intr_rate=11;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12.25;
					$intr_rate=11;
				}
				
			}
			else if ($hdfc_rate_segment=="C+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11.75;
					$intr_rate=10.75;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=11.50;
					$intr_rate=10.75;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11.75;
					$intr_rate=10.75;
				}
				
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11;
					$intr_rate=10.50;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=10.75;
					$intr_rate=10.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11;
					$intr_rate=10.50;
				}
				
			}

		}
	}

	$ratesid[]= $intr_rate;
	return($ratesid);

} // Function HDFCcl rates only

function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

function getdob($DOB)
{
	if ($DOB>=60)
	{
		$term = 0;
			$print_term = "0";
	}
	else if($DOB>58 && $DOB<=59)
		{
			$term = 12;
			$print_term = "1";
		}
		else if($DOB>57 && $DOB<=58)
		{
			$term = 24;
			$print_term = "2";
		}
		else if($DOB>56 && $DOB<=57)
		{
			$term = 36;
			$print_term = "3";
		}
		else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
		}
		else if(($DOB>54 && $DOB<=55))
		{
			$term = 60;
			$print_term = "5";
		}
		else if(($DOB>53 && $DOB<=54))
		{
			$term = 72;
			$print_term = "6";
		}
		else if(($DOB>18 && $DOB<=53))
		{
			$term = 84;
			$print_term = "7";
		}
		else
	{
			$term = 84;
			$print_term = "7";
	}

		$getterm[]= $term;
		$getterm[]= $print_term;
		return($getterm);
}



function magmaCalulation($income,$age,$car_category,$car_segment,$hdfc_car_price, $hdfc_clid, $hdfc_ratecat, $City, $hdfc_car_name, $emp_Stat)
{
//echo '<br><br>'.$income.' - '.$age.' - '.$car_category.' - '.$car_segment.' - '.$hdfc_car_price.' - '. $hdfc_clid.' - '. $hdfc_ratecat.' - '. $City.' - '. $hdfc_car_name.' - '. $emp_Stat;
//echo '<br><br>';
	$minIncome = 150000;
	list($term,$print_term)=getdob($age);
	if($term>60)
	{
		$term = 60;
		$print_term = "5";
	}
	if($emp_Stat==1)
	{
	

		if(($car_segment=='A' && $income>350000) || ($car_segment=='B' && $income>450000) || ($car_segment=='C' && $income>750000))
		{
			//$loan_amount=$hdfc_car_price;
			$final_ltvmount = $hdfc_car_price;
		}
		else if(($car_segment=='A'|| $car_segment=='B') && $income>$minIncome)
		{
			//$loan_amount=$hdfc_car_price;
			$final_ltvmount =  $hdfc_car_price * (90 / 100);
		}
		else if(($car_segment=='C') && $income>$minIncome)
		{
			//$loan_amount=$hdfc_car_price;
			$final_ltvmount =  $hdfc_car_price * (85 / 100);
		}
		else if(($car_segment=='D'|| $car_segment=='D+') && $income>$minIncome)
		{
			//$loan_amount=$hdfc_car_price;
			$final_ltvmount =  $hdfc_car_price * (80 / 100);
		}
		
		if($term>35)
		{
			if($car_segment=="A")
			{
				$intr_rate=11.25;
			}	
			else if ($car_segment=="B")
			{
				$intr_rate=11.25;
			}
			else if ($car_segment=="C" || $car_segment=="Suv")
			{
				$intr_rate=11;
			}
			else if ($car_segment=="D" || $car_segment=="D+")
			{
				$intr_rate=10.75;
			}
			else if ($car_segment=="Muv")
			{
				$intr_rate=11;
			}		
		}	
		else
		{
			if($hdfc_rate_segment=="A")
			{
				$intr_rate=12;
			}	
			else if ($hdfc_rate_segment=="B")
			{
				$intr_rate=12;
			}
			else if ($hdfc_rate_segment=="C" || $hdfc_rate_segment=="Suv")
			{
				$intr_rate=11.75;
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{
				$intr_rate=11.25;
			}
			else if ($hdfc_rate_segment=="Muv")
			{
				$intr_rate=11.75;
			}
		}	
		
		
	}
		
	if(($final_ltvmount>0 && $loan_amount>0) && ($final_ltvmount>$loan_amount))
	{
		 $final_loanamt = $loan_amount;
	}
	else
	{
		$final_loanamt = $final_ltvmount;
	}
	$final_interest_rate = $intr_rate;
	
	$nwterm = $term;
	$details[]= $nwterm;
	$details[]= $print_term;
	$details[]= $final_interest_rate;
	$details[]= $final_loanamt;
	return($details);
}


function hdfccl_rates_usedcar($hdfc_company_cat,$hdfc_city, $hdfc_tenure, $hdfc_rate_segment,$krc_flag, $final_loanamt)
{
//	echo $hdfc_company_cat."--".$hdfc_city."--".$nwterm."--".$hdfc_ratecat."--".$krc_flag."--".$final_loanamt;
	
//	CAT A--Delhi--60--C--0--479665.6
	
	 if($krc_flag==1 && (strlen($hdfc_company_cat)>0 ))
	 {
	 	if($final_loanamt>250000)
		{
			$intr_rate=13.5;
		}
		else
		{
			$intr_rate=14;
		}
	 }
	 else if(($hdfc_company_cat=="CAT A" || $hdfc_company_cat=="SUPER A" || $hdfc_company_cat=="Cat A" || $hdfc_company_cat=="CAT B" || $hdfc_company_cat=="Cat B") || $hdfc_company_cat=="GOVT" || $hdfc_company_cat=="DEFENCE")
	 {
	 	if($final_loanamt>250000)
		{
			$intr_rate=13.75;
		}
		else
		{
			$intr_rate=14.25;
		}
	 }
	 else
	 {
	 	if($hdfc_rate_segment=="A")
		{
			if($hdfc_tenure>=12 && $hdfc_tenure<24)
			{
				$intr_rate=16.25;
			}
			else if($hdfc_tenure>=24 && $hdfc_tenure<36)
			{
				$intr_rate=15.25;
			}
			else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
			{
				$intr_rate=16.25;
			}
			else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
			{
				$intr_rate=16.25;
			}
		}
		else if($hdfc_rate_segment=="B" || $hdfc_rate_segment=="C" || $hdfc_rate_segment=="C+")
		{
			if($hdfc_tenure>=12 && $hdfc_tenure<24)
			{
				$intr_rate=16.25;
			}
			else if($hdfc_tenure>=24 && $hdfc_tenure<36)
			{
				$intr_rate=14.75;
			}
			else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
			{
				$intr_rate=16.25;
			}
			else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
			{
				$intr_rate=16.25;
			}
		}
		else if($hdfc_rate_segment=="D")
		{
			if($hdfc_tenure>=12 && $hdfc_tenure<24)
			{
				$intr_rate=16.25;
			}
			else if($hdfc_tenure>=24 && $hdfc_tenure<36)
			{
				$intr_rate=14.50;
			}
			else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
			{
				$intr_rate=16.25;
			}
			else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
			{
				$intr_rate=16.25;
			}
		}
		else if($hdfc_rate_segment=="D+")
		{
			if($hdfc_tenure>=12 && $hdfc_tenure<24)
			{
				$intr_rate=16.25;
			}
			else if($hdfc_tenure>=24 && $hdfc_tenure<36)
			{
				$intr_rate=14.25;
			}
			else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
			{
				$intr_rate=16.25;
			}
			else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
			{
				$intr_rate=16.25;
			}
		}		
	 }

	$ratesid[]= $intr_rate;
	return($ratesid);
}

function tvscredit($ltv_36months,$ltv_60months, $age, $hdfc_car_price)
{
	list($term,$print_term)=getdob($age);
	if($term>60)
	{
		$term = 60;
		$print_term = "5";
	}

	if($term>=60)
	{
		$loanamount= $hdfc_car_price * ($ltv_60months/100);
	}
	else
	{
		if($term>=12)
		{
			$loanamount= $hdfc_car_price * ($ltv_36months/100);
		}	
	}
	
	$interestrate1 = "15%";
	$intr1=15/1200;

	$interestrate2 = "17%";
	$intr2=17/1200;

	$emicalc1=round($loanamount * $intr1 / (1 - (pow(1/(1 + $intr1), $term))));
	$emicalc2=round($loanamount * $intr2 / (1 - (pow(1/(1 + $intr2), $term))));

	$Finalemi= "Rs.".round($emicalc1)." - Rs.".round($emicalc2);

	$ratesid[]= $print_term;
	$ratesid[]= $Finalemi;
	$ratesid[]= $loanamount;
	$ratesid[]= "15% - 17%";
	return($ratesid);
}

?>