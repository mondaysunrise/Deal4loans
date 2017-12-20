<? require 'scripts/db_init.php';

$hdfcCity= $_REQUEST["hdfcCity"];
$compCategoryq= $_REQUEST["compCategory"];
$krcFlag= $_REQUEST["krcFlag"];
$tenure_years= $_REQUEST["tenure"];
$carprice= $_REQUEST["carprice"];
$ltv_36= $_REQUEST["ltv_36"];
$ltv_60= $_REQUEST["ltv_60"];
$ltv_84= $_REQUEST["ltv_84"];
$j = $_REQUEST["countr"];
$carName = $_REQUEST["carName"];

$compCategory=str_ireplace("_", " ", $compCategoryq);

if(($carName)>0)
{
	
$getcardetails="Select hdfc_car_name,hdfc_car_rate_segment,car_videocode from hdfc_car_list_category Where (hdfc_clid='".$carName."')";
list($recordcount,$row)=Mainselectfunc($getcardetails,$array = array());
$hdfc_car_name = $row["hdfc_car_name"];
$rateCategory= $row["hdfc_car_rate_segment"];
$car_videocode = $row["car_videocode"];

}



if((strlen($hdfcCity)>0) && (strlen($compCategory)>0) && (strlen($rateCategory)>0) && (strlen($carprice)>0) && (strlen($tenure_years)>0))
{
if($ltv_84 >0 && ($tenure_years>60 && $tenure_years<=84))
	{
		$final_ltvmount = $carprice * ($ltv_84 / 100);
			$ltvterm=$tenure_years;
			
	}
else if($ltv_60>0 && ($tenure_years>36 && $tenure_years<=60))
	{
		$final_ltvmount = $carprice * ($ltv_60 / 100);
			$ltvterm=$tenure_years;
			
	}
else if($ltv_36>0 && ($tenure_years<=36))
	{
		$final_ltvmount = $carprice * ($ltv_36 / 100);
			$ltvterm=$tenure_years;
	}
	else
	{
		echo "2:";
		$final_ltvmount = $carprice * ($ltv_36 / 100);
			$ltvterm=$tenure_years;
	}
	


if($ltvterm==84)	{	$nwtenure=7; } else if($ltvterm==72)	{	$nwtenure=6; } if($ltvterm==60)	{	$nwtenure=5; } if($ltvterm==48)	{	$nwtenure=4; } if($ltvterm==36)	{	$nwtenure=3; } if($ltvterm==24)	{	$nwtenure=2; } if($ltvterm==12)	{	$nwtenure=1; }


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


$alac=$final_ltvmount;
$intr=$interestRate/1200;
$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $ltvterm))));
  $maxTenure=$nwtenure;
	 $Loan_Amount=$final_ltvmount;
	 $roi=$interestRate." %";

$tenure=$ltvterm;
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
      <td colspan="2" ><div class="Car-specification-center">
	  <input type="hidden" value="<? echo round($maxLoan_Amount); ?>" name="nwLA_<? echo $j; ?>" id="nwLA_<? echo $j; ?>">
<input type="hidden" value="<? echo $tenure; ?>" name="nwtenu_<? echo $j; ?>" id="nwtenu_<? echo $j; ?>">
<input type="hidden" value="<? echo $interestRate; ?>" name="roi_<? echo $j; ?>" id="roi_<? echo $j; ?>">
        <table width="100%"  align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td width="130" height="30" class="text_car_head" style="border-bottom:1px solid #FFFFFF;">Car Name</td>
            <td width="145" class="text_car_head" style="border-bottom:1px solid #FFFFFF;">Loan Amount</td>
            <td width="133"  class="text_car_head" style="border-bottom:1px solid #FFFFFF;">Monthy EMI</td>
            <td width="85" class="text_car_head" style="border-bottom:1px solid #FFFFFF;">ROI</td>
            <td width="180" class="text_car_head" style="border-bottom:1px solid #FFFFFF;">Welcome rewards</td>
          </tr>
          <tr>
            <td height="60" class="text_car_body"><? echo $hdfc_car_name ;?></td>
            <td><span class="text_car_body"><? echo "Rs. ".number_format($Loan_Amount);?></span></td>
            <td><span class="text_car_body"><? echo "Rs. ".number_format($emiPerLac);?></span></td>
            <td><span class="text_car_body"><? echo $roi."\n";?></span></td>
            <td class="text_car_body">
                                  <? 
$imgbd='<a href="#" onclick="return popitup(\'/new-images/bluetooth_dev.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imgWrstWatch='<a href="#" onclick="return popitup(\'/new-images/polo_watch.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imggpsDev='<a href="#" onclick="return popitup(\'/new-images/gps_device.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imgDigitalPf='<a href="#" onclick="return popitup(\'/new-images/digital_pframe.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imggpsCarFridge='<a href="#" onclick="return popitup(\'/new-images/car_fridge.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imgrbkSun='<a href="#" onclick="return popitup(\'/new-images/rbk_sunglasses.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
	if($Loan_Amount>2000000)
	{
		echo "GPS Device ".$imggpsDev."";
		$Referral = "GPS Device<br>";
	} 
	else if($Loan_Amount>=1000000 && $Loan_Amount<=2000000)
	{
		echo "Portable Car Fridge ".$imggpsCarFridge."";
		$Referral = "Portable Car Fridge";		
	}
	else if($Loan_Amount>=500000 && $Loan_Amount<1000000)
	{
		//$img='<img src="new-images/img_indictr.gif" onclick="javascript:window.open(\'new-images/bluetooth_dev.jpg\')">';
		echo "Digital Key chain photo Frame".$imgDigitalPf." ";
		$Referral = "Digital Key chain photo Frame<br>Satya Paul combos tie/wallet/belts & cufflinks";
	}
	else if($Loan_Amount>=300000 && $Loan_Amount<500000)
	{
		
		echo "Bluetooth Devices".$imgbd."";
		$Referral = "Bluetooth devices<br>	M/F wallet n wrist watch combos<br>	car speaker";
	}
	else 
	{
		echo "E- gift Voucher/cheque";
		$Referral = "E- gift Voucher/cheque<br>Wrist watch <br>sunglasses<br>wallets<br>car air purifier";
	}
	?>
                             </td>
          </tr>
         
        </table>
      </div>
	       <div style="width:670px; height:11px; background:url(new-images/form-bg-shadow.jpg);"></div>      </td>
      <td>&nbsp;</td>
    </tr>
   
    <tr>
      <td>&nbsp;</td>
      <td width="63%" align="left"><a href="#"></a></td>
      <td width="35%" align="center">
	  
	  <input type="hidden" name="final_Referral_<? echo $j; ?>" id="final_Referral_<? echo $j; ?>" value="<? echo $Referral; ?>" >
<input type="hidden" name="final_total_interest_<? echo $j; ?>" id="final_total_interest_<? echo $j; ?>" value="<? echo $total_interest; ?>" >
<input type="hidden" name="final_roi_<? echo $j; ?>" id="final_roi_<? echo $j; ?>" value="<? echo $roi; ?>" >
<input type="hidden" name="final_emiPerLac_<? echo $j; ?>" id="final_emiPerLac_<? echo $j; ?>" value="<? echo $emiPerLac; ?>" >
<input type="hidden" name="final_Loan_Amount_<? echo $j; ?>" id="final_Loan_Amount_<? echo $j; ?>" value="<? echo $Loan_Amount; ?>" >
<input type="submit" name="submitMainForm" style="border: 0px none ; background-image: url(new-images/btn-getinstant-app.jpg); width: 186px; height: 49px; margin-bottom: 0px; font-size:1px;" value="<?php echo $j; ?>"/>
</td>
      <td>&nbsp;</td>
    </tr>
  </table>

<?
//echo number_format($Loan_Amount)."\n".$roi."\n".$tenure."\n".$emiPerLac."\n".$processing_fee;
}

?>

	