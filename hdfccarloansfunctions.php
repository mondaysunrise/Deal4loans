<?php

function hdfccl_listdcomp($income,$age,$car_category,$car_segment,$company_cat,$hdfc_car_price, $hdfc_clid, $hdfc_ratecat, $hdfc_city, $hdfc_car_name, $emp_Stat , $Experience, $salary_account, $resi_stable,$krc_flag)
{
	//echo $income." - ".$age." - ".$car_category." - ".$car_segment." - ".$company_cat." - ".$hdfc_car_price." - ".$hdfc_clid." - ".$hdfc_ratecat." - ".$hdfc_city." - ".$hdfc_car_name." - ".$emp_Stat." - ".$Experience;

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
	elseif($emp_Stat==2)
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
list($getltvNumRows,$rowltv)=MainselectfuncNew($getltv,$array = array());
$ltv_36 = $rowltv[0]["ltv_36months"];
$ltv_60 = $rowltv[0]["ltv_60months"];
$ltv_84 = $rowltv[0]["ltv_84onths"];


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
/*** Start**************/
//Special Rates for Ford Ecosports and Honda Amaze 

$getSpecialRatesSql = "SELECT hdfc_clid FROM hdfc_car_list_category WHERE hdfc_car_name =  '".$hdfc_car_name."' AND (hdfc_car_name LIKE '%Amaze%' OR hdfc_car_name LIKE  '%Ford Ecosport%' OR hdfc_car_name LIKE  '%Renault Duster %')";
list($getSpecialRatesNum,$getSpecialRatesQuery)=MainselectfuncNew($getSpecialRatesSql,$array = array());
//echo $getSpecialRatesSql;
//echo "<br>".$getSpecialRatesNum;
if($getSpecialRatesNum>0)
{
	$krc_flag=4;
}
/*** End **************/
	list($hdfcinterate) = hdfccl_rates($company_cat,$hdfc_city, $nwterm, $hdfc_ratecat, $krc_flag);
	$details[]= $nwterm;
	$details[]= $print_term;
	$details[]= $hdfcinterate;
	$details[]= $final_loanamt;
	return($details);
}///function hdfccl_listdcomp END

function hdfccl_rates($hdfc_company_cat,$hdfc_city, $hdfc_tenure, $hdfc_rate_segment,$krc_flag)
{
	if($krc_flag==40) //Special Rates for Ford Ecosports and Honda Amaze 
	{
		$intr_rate=11;
	}
	else if($krc_flag==30 && (strlen($hdfc_company_cat)>0 ))//$krc_flag==3 Changed for stopping the KRC Flag
	{	
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
//			$intr_rate=12.25;//			$intr_rate=11.50;140213
			$intr_rate=12.50; // $intr_rate=12.25; 230813
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=11.25;//$intr_rate=10.75;230813//$intr_rate=11;//140213
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=11;//$intr_rate=10.50;230813//$intr_rate=10.75;//140213
		}
		else if ($hdfc_rate_segment=="C+")
		{
			$intr_rate=10.75;//$intr_rate=10.25;230813//$intr_rate=10.50;//140213
		}
		else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=10.75;//$intr_rate=10;230813//$intr_rate=10.50;//140213
		}
	}
	else if($krc_flag==2 && (strlen($hdfc_company_cat)>0 ))
	{	
//		$intr_rate=10.75;//$intr_rate=10.75;//140213
//		$intr_rate=10.50;//$intr_rate=10.75;//020713
		$intr_rate=10.75;//$intr_rate=10.75;//230813
	}	
	else if($krc_flag==10 && (strlen($hdfc_company_cat)>0 ))//$krc_flag==1 Changed for stopping the KRC Flag
	{	
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
//			$intr_rate=12.25;//			$intr_rate=11.50;140213
			$intr_rate=12.50; // $intr_rate=12.25; 230813
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=11.25;//$intr_rate=10.75;230813//$intr_rate=11;//140213
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=11;//$intr_rate=10.50;230813//$intr_rate=10.75;//140213
		}
		else if ($hdfc_rate_segment=="C+")
		{
			$intr_rate=10.75;//$intr_rate=10.25;230813//$intr_rate=10.50;//140213
		}
		else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=10.75;//$intr_rate=10;230813//$intr_rate=10.50;//140213
		}
	}
/*	else if(($hdfc_company_cat=="GOVT" ||$hdfc_company_cat=="DEFENCE"))
	{
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
//			$intr_rate=12.25;//			$intr_rate=11.50;140213
			$intr_rate=12.50; // $intr_rate=12.25; 230813
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=11.25;//$intr_rate=10.75;230813//$intr_rate=11;//140213
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=11;//$intr_rate=10.50;230813//$intr_rate=10.75;//140213
		}
		else if ($hdfc_rate_segment=="C+")
		{
			$intr_rate=10.75;//$intr_rate=10.25;230813//$intr_rate=10.50;//140213
		}
		else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=10.75;//$intr_rate=10;230813//$intr_rate=10.50;//140213
		}
	}
	else if(($hdfc_company_cat=="CAT A" || $hdfc_company_cat=="SUPER A" || $hdfc_company_cat=="Cat A" || $hdfc_company_cat=="CAT B" || $hdfc_company_cat=="Cat B"))
	{
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
//			$intr_rate=12.25;//			$intr_rate=11.50;140213
			$intr_rate=13.50; // $intr_rate=12.25; 230813
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=12.25;//$intr_rate=10.75;230813//$intr_rate=11;//140213
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=12;//$intr_rate=10.50;230813//$intr_rate=10.75;//140213
		}
		else if ($hdfc_rate_segment=="C+")
		{
			$intr_rate=11.75;//$intr_rate=10.25;230813//$intr_rate=10.50;//140213
		}
		else if($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=11.50;//$intr_rate=10;230813//$intr_rate=10.50;//140213
		}
	}
	else if(($hdfc_company_cat=="CAT C" || $hdfc_company_cat=="Cat C" || $hdfc_company_cat=="CAT D" ||$hdfc_company_cat=="Cat D"))
	{
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
			//$intr_rate=12.50;
			$intr_rate=13.50;
		}	
		else if($hdfc_rate_segment=="B")
		{
			//$intr_rate=12;
			$intr_rate=12.25;
		}
		else if($hdfc_rate_segment=="C")
		{
			//$intr_rate=11.50;
			$intr_rate=12;
		}
		else if ($hdfc_rate_segment=="C+")
		{
			//$intr_rate=11.25;
			$intr_rate=11.75;
		}
		else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			//$intr_rate=11.25;
			$intr_rate=11.50;
		}
	}//company listed
*/
	else
	{
		if($hdfc_city=="AGAR" || $hdfc_city=="AHMEDNAGAR" || $hdfc_city=="AKOLA" || $hdfc_city=="AKOT" || $hdfc_city=="ALWAR" || $hdfc_city=="AMRAVATI" || $hdfc_city=="ANANTHPUR" || $hdfc_city=="ANKLESHWAR" || $hdfc_city=="AURANGABAD" || $hdfc_city=="BALLARPUR" || $hdfc_city=="BARDOLI" || $hdfc_city=="BARSHI" || $hdfc_city=="BHADRAVATI" || $hdfc_city=="BHARUCH" || $hdfc_city=="BIJAPUR" || $hdfc_city=="BIKANER" || $hdfc_city=="BILIMORA" || $hdfc_city=="CHALISGAON" || $hdfc_city=="CHANDRAPUR" || $hdfc_city=="CUDDAPAH" || $hdfc_city=="DAUND" || $hdfc_city=="DAVANGERE" || $hdfc_city=="DHULE" || $hdfc_city=="ERODE" || $hdfc_city=="FEROZEPUR" || $hdfc_city=="GODHARA" || $hdfc_city=="GOKAK" || $hdfc_city=="HANUMANGARH" || $hdfc_city=="HOSHIARPUR" || $hdfc_city=="INDAPUR" || $hdfc_city=="JALGAON" || $hdfc_city=="JAORA" || $hdfc_city=="JHARSUGUDA" || $hdfc_city=="JUNAGADH" || $hdfc_city=="KARAD" || $hdfc_city=="KARNAL" || $hdfc_city=="KATNI" || $hdfc_city=="KOPERGAON" || $hdfc_city=="KURNOOL" || $hdfc_city=="LANJE" || $hdfc_city=="MAHUVA" || $hdfc_city=="MANAVADAR" || $hdfc_city=="MANDIGOBINDGARH" || $hdfc_city=="MANDSAUR" || $hdfc_city=="MANDVI" || $hdfc_city=="MIRAJ" || $hdfc_city=="MORVI" || $hdfc_city=="NAGDA" || $hdfc_city=="NALGONDA" || $hdfc_city=="NANDED" || $hdfc_city=="NAVSARI" || $hdfc_city=="PALLAKAD" || $hdfc_city=="PANDHARPUR" || $hdfc_city=="PATAN" || $hdfc_city=="PATHANKOT" || $hdfc_city=="PAYYANNUR" || $hdfc_city=="PHALTAN" || $hdfc_city=="RATLAM" || $hdfc_city=="RATNAGIRI" || $hdfc_city=="SAGAR-MADHYA PRADESH" || $hdfc_city=="SAMBALPUR" || $hdfc_city=="SATARA" || $hdfc_city=="SHAJAPUR" || $hdfc_city=="SHEGAON" || $hdfc_city=="SHIMOGA" || $hdfc_city=="SILVASSA" || $hdfc_city=="TELLICHERRY" || $hdfc_city=="TIRUNELVELI" || $hdfc_city=="TIRUPUR" || $hdfc_city=="UJJAIN" || $hdfc_city=="UNA-GUJARAT" || $hdfc_city=="VERAVAL" || $hdfc_city=="VYARA")
		{	
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
			{
				if($hdfc_tenure<36)
				{
//					$intr_rate=12.50;//					$intr_rate=12.25;//Dt 02-03-2013//					$intr_rate=13;
					$intr_rate=13.75;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
//					$intr_rate=12.25;//Dt 02-03-2013					$intr_rate=12.50;
					$intr_rate=13.75;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
//					$intr_rate=12.50;
//					$intr_rate=12.25;//Dt 02-03-2013					$intr_rate=13;
					$intr_rate=13.75;
				}
			}
			else if($hdfc_rate_segment=="B")
			{
				if($hdfc_tenure<36)
				{
		//			$intr_rate=12.50;//					$intr_rate=11;//Dt 02-03-2013					$intr_rate=11.75;					
					$intr_rate=12.50;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
			//		$intr_rate=12.25;//					$intr_rate=11;//Dt 02-03-2013								$intr_rate=11.25;
					$intr_rate=12.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12.50;//					$intr_rate=11;//Dt 02-03-2013					$intr_rate=11.75;
					$intr_rate=12.50;
				}
			}			
			else if ($hdfc_rate_segment=="C")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=12;//					$intr_rate=10.75;//Dt 02-03-2013					$intr_rate=11.50;
					$intr_rate=12.25;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=11.75;//					$intr_rate=10.75;//Dt 02-03-2013					$intr_rate=11;					
					$intr_rate=12.25;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12;//					$intr_rate=10.75;//Dt 02-03-2013										$intr_rate=11.50;
					$intr_rate=12.25;
				}
				
			}
			else if ($hdfc_rate_segment=="C+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11.50;//					$intr_rate=10.50;//Dt 02-03-2013					$intr_rate=11.25;					
					$intr_rate=12;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=11.25;//					$intr_rate=10.50;//Dt 02-03-2013					$intr_rate=10.75;					
					$intr_rate=12;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11.50;//					$intr_rate=10.50;//Dt 02-03-2013					$intr_rate=11.25;					
					$intr_rate=12;
				}
				
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11;
//					$intr_rate=10.25;//Dt 02-03-2013
					$intr_rate=11.50;					
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=10.75;//					$intr_rate=10.25;//Dt 02-03-2013					$intr_rate=10.50;
					$intr_rate=11.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11;
//					$intr_rate=10.25;//Dt 02-03-2013
					$intr_rate=11.50;
				}
				
			}

		}
		else if($hdfc_city=="AADIPUR" || $hdfc_city=="ABU ROAD" || $hdfc_city=="AGRA" || $hdfc_city=="AHMEDABAD" || $hdfc_city=="AJMER" || $hdfc_city=="AKLUJ" || $hdfc_city=="ALIGARH" || $hdfc_city=="ALLAHABAD" || $hdfc_city=="ALLEPPEY" || $hdfc_city=="ALUVA" || $hdfc_city=="AMBALA" || $hdfc_city=="AMRELI" || $hdfc_city=="AMRITSAR" || $hdfc_city=="ANAND" || $hdfc_city=="ANGAMALY" || $hdfc_city=="ANJAR" || $hdfc_city=="ASANSOL" || $hdfc_city=="BADAGARA" || $hdfc_city=="BADWAH" || $hdfc_city=="BALUSERY" || $hdfc_city=="BANGALORE" || $hdfc_city=="BANKURA" || $hdfc_city=="BANSWARA" || $hdfc_city=="BARAN" || $hdfc_city=="BAREILLY" || $hdfc_city=="BARGARH" || $hdfc_city=="BARMER" || $hdfc_city=="BARODA" || $hdfc_city=="BASSI" || $hdfc_city=="BEAWAR" || $hdfc_city=="BEED" || $hdfc_city=="BEHRAMPUR" || $hdfc_city=="BELGAUM" || $hdfc_city=="BELLARY" || $hdfc_city=="BETUL" || $hdfc_city=="BHACHAU" || $hdfc_city=="BHAGALPUR" || $hdfc_city=="BHANDARA" || $hdfc_city=="BHATINDA" || $hdfc_city=="BHAVNAGAR" || $hdfc_city=="BHILWARA" || $hdfc_city=="BHIMAVARAM" || $hdfc_city=="BHOPAL" || $hdfc_city=="BHOR" || $hdfc_city=="BHUBANESHWAR" || $hdfc_city=="BHUJ" || $hdfc_city=="BIJNOR" || $hdfc_city=="BILASPUR" || $hdfc_city=="BODELI" || $hdfc_city=="BOKARO" || $hdfc_city=="BORSAD" || $hdfc_city=="BUNDI" || $hdfc_city=="BURDWAN" || $hdfc_city=="BURHANPUR" || $hdfc_city=="CALCUTTA" || $hdfc_city=="CALICUT" || $hdfc_city=="CHANDIGARH" || $hdfc_city=="CHANGANCHERRY" || $hdfc_city=="CHENGANNUR" || $hdfc_city=="CHENNAI" || $hdfc_city=="CHERTHALA" || $hdfc_city=="CHOMU" || $hdfc_city=="COCHIN" || $hdfc_city=="COIMBATORE" || $hdfc_city=="COOCH BEHAR" || $hdfc_city=="CUDDALORE" || $hdfc_city=="CUTTACK" || $hdfc_city=="DAMAN" || $hdfc_city=="DEESA" || $hdfc_city=="DEHRADUN" || $hdfc_city=="DELHI" || $hdfc_city=="DERABASI" || $hdfc_city=="DEWAS" || $hdfc_city=="DHAMNOD" || $hdfc_city=="DHANBAD" || $hdfc_city=="DHAR" || $hdfc_city=="DHARWAD" || $hdfc_city=="DHORAJI" || $hdfc_city=="DIBRUGARH" || $hdfc_city=="DINDUGAL" || $hdfc_city=="DUBRAJPUR" || $hdfc_city=="DUNGARPUR" || $hdfc_city=="DUNGRI" || $hdfc_city=="DURG" || $hdfc_city=="DURGAPUR" || $hdfc_city=="EDAPPAL" || $hdfc_city=="EDAVANNA" || $hdfc_city=="ELURU" || $hdfc_city=="FAIZABAD" || $hdfc_city=="FIROZABAD" || $hdfc_city=="GADAG" || $hdfc_city=="GANDHIDHAM" || $hdfc_city=="GANDHINAGAR" || $hdfc_city=="GANGTOK" || $hdfc_city=="GAYA" || $hdfc_city=="GOA" || $hdfc_city=="GONDAL" || $hdfc_city=="GONDIA" || $hdfc_city=="GORAKHPUR" || $hdfc_city=="GUNTUR" || $hdfc_city=="GUWAHATI" || $hdfc_city=="GWALIOR" || $hdfc_city=="HALDWANI" || $hdfc_city=="HALOL" || $hdfc_city=="HARDA" || $hdfc_city=="HARDOI" || $hdfc_city=="HARIDWAR" || $hdfc_city=="HAVERI" || $hdfc_city=="HAZARIBAGH" || $hdfc_city=="HAZIPUR" || $hdfc_city=="HIMMATNAGAR" || $hdfc_city=="HISSAR" || $hdfc_city=="HOSUR" || $hdfc_city=="HUBLI" || $hdfc_city=="ICHALKARANJI" || $hdfc_city=="IDAR" || $hdfc_city=="IGATPURI" || $hdfc_city=="INDORE" || $hdfc_city=="ITARSI" || $hdfc_city=="JABALPUR" || $hdfc_city=="JAIPUR" || $hdfc_city=="JALANDHAR" || $hdfc_city=="JALOR" || $hdfc_city=="JALPAIGURI" || $hdfc_city=="JAM JODHPUR" || $hdfc_city=="JAMMU" || $hdfc_city=="JAMNAGAR" || $hdfc_city=="JAMSHEDPUR" || $hdfc_city=="JASDAN" || $hdfc_city=="JETPUR" || $hdfc_city=="JHALAWAR" || $hdfc_city=="JHANSI" || $hdfc_city=="JODHPUR" || $hdfc_city=="JORHAT" || $hdfc_city=="KAKINADA" || $hdfc_city=="KALADI" || $hdfc_city=="KALOL" || $hdfc_city=="KANNUR" || $hdfc_city=="KANPUR" || $hdfc_city=="KAPADVANJ" || $hdfc_city=="KAPURTHALA" || $hdfc_city=="KARAIKUDI" || $hdfc_city=="KARIMNAGAR" || $hdfc_city=="KARTARPUR" || $hdfc_city=="KASRAWAD" || $hdfc_city=="KHAMBAT" || $hdfc_city=="KHAMMAM" || $hdfc_city=="KHANDWA" || $hdfc_city=="KHARGONE" || $hdfc_city=="KHATEGAO" || $hdfc_city=="KIM" || $hdfc_city=="KISHANGARH" || $hdfc_city=="KODUVALLI" || $hdfc_city=="KOLHAPUR" || $hdfc_city=="KOLLAM" || $hdfc_city=="KOPPAL" || $hdfc_city=="KOTA" || $hdfc_city=="KOTTAYAM" || $hdfc_city=="KRISHNAGIRI" || $hdfc_city=="KUDAL" || $hdfc_city=="KUMBAKONAM" || $hdfc_city=="KUNDAPUR" || $hdfc_city=="KURUKSHETRA" || $hdfc_city=="LASALGAON" || $hdfc_city=="LATUR" || $hdfc_city=="LIMDI" || $hdfc_city=="LUCKNOW" || $hdfc_city=="LUDHIANA" || $hdfc_city=="MACHIWARA" || $hdfc_city=="MADURAI" || $hdfc_city=="MAHUWA" || $hdfc_city=="MAKRANA" || $hdfc_city=="MALDA" || $hdfc_city=="MALEGAON" || $hdfc_city=="MALERKOTLA" || $hdfc_city=="MALLAPURAM" || $hdfc_city=="MANAPPARAI" || $hdfc_city=="MANGALORE" || $hdfc_city=="MANJERI" || $hdfc_city=="MANSA" || $hdfc_city=="MATHURA" || $hdfc_city=="MAVELIKKARA" || $hdfc_city=="MAYILADUTHURAI" || $hdfc_city=="MEERUT" || $hdfc_city=="MEHSANA" || $hdfc_city=="MHOW" || $hdfc_city=="MOHALI" || $hdfc_city=="MORADABAD" || $hdfc_city=="MORINDA" || $hdfc_city=="MUKKAM" || $hdfc_city=="MUKTSAR" || $hdfc_city=="MUMBAI" || $hdfc_city=="MUVATTUPUZHA" || $hdfc_city=="MUZAFFRPUR" || $hdfc_city=="MYSORE" || $hdfc_city=="NADIAD" || $hdfc_city=="NAGPUR" || $hdfc_city=="NAKHATRANA" || $hdfc_city=="NAMAKKAL" || $hdfc_city=="NAMKOM" || $hdfc_city=="NARAGAUND" || $hdfc_city=="NASIK" || $hdfc_city=="NASIRABAD" || $hdfc_city=="NEDUMANGAD" || $hdfc_city=="NELLORE" || $hdfc_city=="NEYATTINKARA" || $hdfc_city=="NILAMBUR" || $hdfc_city=="NIPHAD" || $hdfc_city=="NIZAMABAD" || $hdfc_city=="OJHAR" || $hdfc_city=="ONGOLE" || $hdfc_city=="PALANPUR" || $hdfc_city=="PANIPAT" || $hdfc_city=="PANIPAT" || $hdfc_city=="PARAVUR" || $hdfc_city=="PATHANAMTHITTA" || $hdfc_city=="PATIALA" || $hdfc_city=="PATNA" || $hdfc_city=="PAYYOLI" || $hdfc_city=="PERINTALMANNA" || $hdfc_city=="PERUMBAVOOR" || $hdfc_city=="PONDICHERRY" || $hdfc_city=="PORBANDAR" || $hdfc_city=="PRANTIJ" || $hdfc_city=="PUNE" || $hdfc_city=="PUSAD" || $hdfc_city=="PUSHKAR" || $hdfc_city=="QUILANDY" || $hdfc_city=="RAI BAREILLY" || $hdfc_city=="RAIPUR" || $hdfc_city=="RAJAMUNDHRY" || $hdfc_city=="RAJAPALAYAM" || $hdfc_city=="RAJKOT" || $hdfc_city=="RAJPIPLA" || $hdfc_city=="RAJSAMAND" || $hdfc_city=="RAMGANJ MANDI" || $hdfc_city=="RAMGARH" || $hdfc_city=="RANCHI" || $hdfc_city=="RANIGANJ" || $hdfc_city=="RATU" || $hdfc_city=="RAWATBHATA" || $hdfc_city=="REWARI" || $hdfc_city=="RISHIKESH" || $hdfc_city=="ROHTAK" || $hdfc_city=="ROORKEE" || $hdfc_city=="ROPAR" || $hdfc_city=="ROURKELA" || $hdfc_city=="RUDRAPUR" || $hdfc_city=="SAHARANPUR" || $hdfc_city=="SALEM" || $hdfc_city=="SANAWAD" || $hdfc_city=="SANGANER" || $hdfc_city=="SANGLI" || $hdfc_city=="SATANA" || $hdfc_city=="SECUNDERABAD" || $hdfc_city=="SENDHWA" || $hdfc_city=="SHIKRAPUR" || $hdfc_city=="SHIRDI" || $hdfc_city=="SILCHAR" || $hdfc_city=="SILIGURI" || $hdfc_city=="SIMLA" || $hdfc_city=="SIROHI" || $hdfc_city=="SITAPUR" || $hdfc_city=="SIVAKASI" || $hdfc_city=="SOLAPUR" || $hdfc_city=="SONAKATCH" || $hdfc_city=="SONEPAT" || $hdfc_city=="SRIKAKULAM" || $hdfc_city=="SRINAGAR" || $hdfc_city=="SULTANPUR-UP" || $hdfc_city=="SURAT" || $hdfc_city=="SURENDRANAGAR" || $hdfc_city=="SURSA" || $hdfc_city=="TANUKU" || $hdfc_city=="THANE" || $hdfc_city=="THANJAVUR" || $hdfc_city=="THODUPUZHA" || $hdfc_city=="THURAYUR" || $hdfc_city=="TIRUPATI" || $hdfc_city=="TIRUR" || $hdfc_city=="TIRUVALLA" || $hdfc_city=="TRICHUR" || $hdfc_city=="TRICHY" || $hdfc_city=="TRIVANDRUM" || $hdfc_city=="TUMKUR" || $hdfc_city=="UDAIPUR" || $hdfc_city=="UNNAO" || $hdfc_city=="VAIKOM" || $hdfc_city=="VALSAD" || $hdfc_city=="VAPI" || $hdfc_city=="VARANASI" || $hdfc_city=="VELLORE" || $hdfc_city=="VIDISHA" || $hdfc_city=="VIJAYAWADA" || $hdfc_city=="VIKASNAGAR" || $hdfc_city=="VIRUDHACHALAM" || $hdfc_city=="VIRUDHUNAGAR" || $hdfc_city=="VISNAGAR" || $hdfc_city=="VIZAG" || $hdfc_city=="VIZIANAGARAM" || $hdfc_city=="WANI" || $hdfc_city=="WARANGAL" || $hdfc_city=="WARDHA" || $hdfc_city=="YAMUNANAGAR" || $hdfc_city=="YAVATMAL" || $hdfc_city=="YEOLA" || $hdfc_city=="Noida" || $hdfc_city=="Gurgaon" || $hdfc_city=="Gaziabad" || $hdfc_city=="Faridabad" || $hdfc_city=="Greater Noida")
		{
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
			{
				if($hdfc_tenure<36)
				{
					//$intr_rate=12.75;//					$intr_rate=12.50;//Dt 02-03-2013					$intr_rate=13.25;
					$intr_rate=13.50;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=12.50;//					$intr_rate=12.50;//Dt 02-03-2013					$intr_rate=12.75;
					$intr_rate=13.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12.75;//					$intr_rate=12.50;//Dt 02-03-2013					$intr_rate=13.25;
					$intr_rate=13.50;
				}
			}
			else if($hdfc_rate_segment=="B")
			{
				if($hdfc_tenure<36)
				{
					//$intr_rate=12.75;//					$intr_rate=11.25;//Dt 02-03-2013					$intr_rate=12;
					$intr_rate=12.25;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=12.50;//					$intr_rate=11.25;//Dt 02-03-2013					$intr_rate=11.50;
					$intr_rate=12.25;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12.75;//					$intr_rate=11.25;//Dt 02-03-2013					$intr_rate=12;
					$intr_rate=12.25;
				}
			}

			else if ($hdfc_rate_segment=="C")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=12.25;					//$intr_rate=11;//Dt 02-03-2013					$intr_rate=11.75;
					$intr_rate=12;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=12;		//			$intr_rate=11;//Dt 02-03-2013					$intr_rate=11.25;
					$intr_rate=12;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12.25;	//				$intr_rate=11;//Dt 02-03-2013					$intr_rate=11.75;
					$intr_rate=12;
				}
				
			}
			else if ($hdfc_rate_segment=="C+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11.75;					//$intr_rate=10.75;//Dt 02-03-2013					$intr_rate=11.50;
					$intr_rate=11.75;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=11.50;//					$intr_rate=10.75;//Dt 02-03-2013					$intr_rate=11;
					$intr_rate=11.75;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11.75;//					$intr_rate=10.75;//Dt 02-03-2013					$intr_rate=11.50;
					$intr_rate=11.75;
				}
				
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11;					//$intr_rate=10.50;//Dt 02-03-2013					$intr_rate=11.25;
					$intr_rate=11.50;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=10.75;					//$intr_rate=10.50;//Dt 02-03-2013					$intr_rate=10.75;
					$intr_rate=11.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11;//					$intr_rate=10.50;//Dt 02-03-2013					$intr_rate=11.25;
					$intr_rate=11.50;
				}
			}
		}
		else
		{	
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
			{
				if($hdfc_tenure<36)
				{
//					$intr_rate=12.50;//					$intr_rate=12.25;//Dt 02-03-2013//					$intr_rate=13;
					$intr_rate=13.75;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
//					$intr_rate=12.25;//Dt 02-03-2013					$intr_rate=12.50;
					$intr_rate=13.75;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
//					$intr_rate=12.50;
//					$intr_rate=12.25;//Dt 02-03-2013					$intr_rate=13;
					$intr_rate=13.75;
				}
			}
			else if($hdfc_rate_segment=="B")
			{
				if($hdfc_tenure<36)
				{
		//			$intr_rate=12.50;//					$intr_rate=11;//Dt 02-03-2013					$intr_rate=11.75;					
					$intr_rate=12.50;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
			//		$intr_rate=12.25;//					$intr_rate=11;//Dt 02-03-2013								$intr_rate=11.25;
					$intr_rate=12.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12.50;//					$intr_rate=11;//Dt 02-03-2013					$intr_rate=11.75;
					$intr_rate=12.50;
				}
			}			
			else if ($hdfc_rate_segment=="C")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=12;//					$intr_rate=10.75;//Dt 02-03-2013					$intr_rate=11.50;
					$intr_rate=12.25;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=11.75;//					$intr_rate=10.75;//Dt 02-03-2013					$intr_rate=11;					
					$intr_rate=12.25;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=12;//					$intr_rate=10.75;//Dt 02-03-2013										$intr_rate=11.50;
					$intr_rate=12.25;
				}
				
			}
			else if ($hdfc_rate_segment=="C+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11.50;//					$intr_rate=10.50;//Dt 02-03-2013					$intr_rate=11.25;					
					$intr_rate=12;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=11.25;//					$intr_rate=10.50;//Dt 02-03-2013					$intr_rate=10.75;					
					$intr_rate=12;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11.50;//					$intr_rate=10.50;//Dt 02-03-2013					$intr_rate=11.25;					
					$intr_rate=12;
				}
				
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{	
				if($hdfc_tenure<36)
				{
					//$intr_rate=11;
//					$intr_rate=10.25;//Dt 02-03-2013
					$intr_rate=11.50;					
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					//$intr_rate=10.75;//					$intr_rate=10.25;//Dt 02-03-2013					$intr_rate=10.50;
					$intr_rate=11.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					//$intr_rate=11;
//					$intr_rate=10.25;//Dt 02-03-2013
					$intr_rate=11.50;
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
?>