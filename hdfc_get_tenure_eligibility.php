<? require 'scripts/db_init.php';


$nwLA = $_REQUEST["nwLA"];
$tenure_years = $_REQUEST["tenure"];
$j = $_REQUEST["countr"];
$hdfcCity = $_REQUEST["hdfcCity"];
$krcFlag = $_REQUEST["krcFlag"];
$compCategoryq = $_REQUEST["compCategory"];
$carName = $_REQUEST["carName"];
$model = $_REQUEST["model"];

$compCategory=str_ireplace("_", " ", $compCategoryq);

if(($carName)>0)
{
	
$getcardetails="Select hdfc_car_name,hdfc_car_rate_segment,car_videocode from hdfc_car_list_category Where (hdfc_clid='".$carName."')";

list($rowNum,$row)=Mainselectfunc($getcardetails,$array = array());
$hdfc_car_name = $row["hdfc_car_name"];
$rateCategory= $row["hdfc_car_rate_segment"];
$car_videocode = $row["car_videocode"];

}



if((strlen($hdfcCity)>0) && (strlen($compCategory)>0) && (strlen($rateCategory)>0) && (strlen($tenure_years)>0))
{
//for LA
if($krcFlag==1 && ($compCategory!=0 ))
	{	
		if($rateCategory=="A" || $rateCategory=="MUV")
		{
			$interestRate=11.50;
		}	
		else if ($rateCategory=="B")
		{
			$interestRate=11;
		}
		else if ($rateCategory=="C")
		{
			$interestRate=10.75;
		}
		else if ($rateCategory=="C+" || $rateCategory=="D" || $rateCategory=="D+")
		{
			$interestRate=10.50;
		}
	}
	else if(($compCategory=="CAT A" || $compCategory=="SUPER A" || $compCategory=="Cat A" || $compCategory=="CAT B" || $compCategory=="Cat B" || $compCategory=="GOVT" || $compCategory=="DEFENCE"))
	{
		if($rateCategory=="A" || $rateCategory=="MUV")
		{
			$interestRate=11.75;
		}	
		else if ($rateCategory=="B")
		{
			$interestRate=11.25;
		}
		else if ($rateCategory=="C")
		{
			$interestRate=11;
		}
		else if ($rateCategory=="C+" || $rateCategory=="D" || $rateCategory=="D+")
		{
			$interestRate=10.75;
		}

	}
	else if(($compCategory=="CAT C" || $compCategory=="Cat C" || $compCategory=="CAT D" || $compCategory=="Cat D"))
	{
		if($rateCategory=="A" || $rateCategory=="MUV")
		{
			$interestRate=12.50;
		}	
		else if ($rateCategory=="B")
		{
			$interestRate=12;
		}
		else if ($rateCategory=="C")
		{
			$interestRate=11.50;
		}
		else if ($rateCategory=="C+" || $rateCategory=="D" || $rateCategory=="D+")
		{
			$interestRate=11.25;
		}
	}//company listed
	else
	{
		
		if($hdfcCity=="Delhi" || $hdfcCity=="Mumbai" || $hdfcCity=="Hyderabad" || $hdfcCity=="Pune" || $hdfcCity=="Ahmedabad" || $hdfcCity=="Nagpur" || $hdfcCity=="Goa" || $hdfcCity=="Ludhiana" || $hdfcCity=="Chandigarh" || $hdfcCity=="Jaipur" || $hdfcCity=="Kochi" || $hdfcCity=="Kolkata" || $hdfcCity=="Chennai" || $hdfcCity=="Coimbatore" || $hdfcCity=="Surat" || $hdfcCity=="Rajkot" || $hdfcCity=="Jalandhar" || $hdfcCity=="Trivandrum")
		{	
			if($rateCategory=="A" || $rateCategory=="MUV" || $rateCategory=="B")
			{
				if($tenure_years<36)
				{
					$interestRate=12.50;
				}
				else if ($tenure_years>=36 && $tenure_years<60)
				{
					$interestRate=12.25;
				}
				else if($tenure_years>=60 && $tenure_years<=84)
				{
					$interestRate=12.50;
				}
			}
			else if ($rateCategory=="C")
			{	
				if($tenure_years<36)
				{
					$interestRate=12;
				}
				else if ($tenure_years>=36 && $tenure_years<60)
				{
					$interestRate=11.75;
				}
				else if($tenure_years>=60 && $tenure_years<=84)
				{
					$interestRate=12;
				}
				
			}
			else if ($rateCategory=="C+")
			{	
				if($tenure_years<36)
				{
					$interestRate=11.50;
				}
				else if ($tenure_years>=36 && $tenure_years<60)
				{
					$interestRate=11.25;
				}
				else if($tenure_years>=60 && $tenure_years<=84)
				{
					$interestRate=11.50;
				}
				
			}
			else if ($rateCategory=="D" || $rateCategory=="D+")
			{	
				if($tenure_years<36)
				{
					$interestRate=11;
				}
				else if ($tenure_years>=36 && $tenure_years<60)
				{
					$interestRate=10.75;
				}
				else if($tenure_years>=60 && $tenure_years<=84)
				{
					$interestRate=11;
				}
				
			}

		}
		else
		{
			if($rateCategory=="A" || $rateCategory=="MUV" || $rateCategory=="B")
			{
				if($tenure_years<36)
				{
					$interestRate=12.75;
				}
				else if ($tenure_years>=36 && $tenure_years<60)
				{
					$interestRate=12.50;
				}
				else if($tenure_years>=60 && $tenure_years<=84)
				{
					$interestRate=12.75;
				}
			}
			else if ($rateCategory=="C")
			{	
				if($tenure_years<36)
				{
					$interestRate=12.25;
				}
				else if ($tenure_years>=36 && $tenure_years<60)
				{
					$interestRate=12;
				}
				else if($tenure_years>=60 && $tenure_years<=84)
				{
					$interestRate=12.25;
				}
				
			}
			else if ($rateCategory=="C+")
			{	
				if($tenure_years<36)
				{
					$interestRate=11.75;
				}
				else if ($tenure_years>=36 && $tenure_years<60)
				{
					$interestRate=11.50;
				}
				else if($tenure_years>=60 && $tenure_years<=84)
				{
					$interestRate=11.75;
				}
				
			}
			else if($rateCategory=="D" || $rateCategory=="D+")
			{	
				
				if($tenure_years<36)
				{
					$interestRate=11;
				}
				else if ($tenure_years>=36 && $tenure_years<60)
				{
					$interestRate=10.75;
				}
				else if($tenure_years>=60 && $tenure_years<=84)
				{
					$interestRate=11;
				}
				
			}

		}
	}


$alac=$nwLA;
$intr=$interestRate/1200;
$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $tenure_years))));
  $maxTenure=$tenure_years;
	 $Loan_Amount=$nwLA;
	 $roi=$interestRate." %";

$tenure=$tenure_years;
	//alert(interestRate);
	

$total_cost = ($emiPerLac*$tenure_years);
$total_interest = ($emiPerLac*$tenure) - $Loan_Amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;

$maxLoan_Amount = $Loan_Amount;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);

?>
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" ><!--<div class="<?php echo $model; ?>car-specification-center"> -->
      <div class="<?php echo $model; ?>slider-section_b">
	  <input type="hidden" value="<? echo round($maxLoan_Amount); ?>" name="nwLA_<? echo $j; ?>" id="nwLA_<? echo $j; ?>">
<input type="hidden" value="<? echo $tenure; ?>" name="nwtenu_<? echo $j; ?>" id="nwtenu_<? echo $j; ?>">
<input type="hidden" value="<? echo $interestRate; ?>" name="roi_<? echo $j; ?>" id="roi_<? echo $j; ?>">
        <table width="100%"  align="center" cellpadding="0" cellspacing="0" border="0">
              <tr>
        <td width="44%" height="30" align="center" class="text-car-name" style="border-right:#FFFFFF thin solid;	 border-bottom:#FFFFFF thin solid; ">Car Name</td>
        <td width="20%" align="center" class="text-car-name" style="border-right:#FFFFFF thin solid;	 border-bottom:#FFFFFF thin solid; ">Loan Amount</td>
        <td width="21%" align="center" class="text-car-name" style="border-right:#FFFFFF thin solid;	 border-bottom:#FFFFFF thin solid; ">Monthly EMI</td>
        <td width="15%" align="center" style="border-bottom:#FFFFFF thin solid; "><span class="text-car-name">ROI</span></td>
      </tr>
      <tr>
        <td height="55" align="center" class="text-car-heading" style="border-right:#FFFFFF thin solid;"><? echo $hdfc_car_name ;?></td>
        <td height="50" align="center" class="text-car-heading" style="border-right:#FFFFFF thin solid;"><? echo "Rs. ".number_format($Loan_Amount);?></td>
        <td height="50" align="center" class="text-car-heading" style="border-right:#FFFFFF thin solid;"><? echo "Rs. ".number_format($emiPerLac);?></td>
        <td height="50" align="center" class="text-car-heading"><? echo $roi."\n";?></td>
      </tr>

        </table>
      </div>
	       <div style="width:670px; height:11px; background:url(new-images/form-bg-shadow.jpg);"></div>      </td>
      <td>&nbsp;</td>
    </tr>
   
    <tr>
      <td>&nbsp;</td>
      <td width="63%" align="left"><a href="#"></a></td>
      <td width="35%" align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>

<?
//echo number_format($Loan_Amount)."\n".$roi."\n".$tenure."\n".$emiPerLac."\n".$processing_fee;
}

?>

	