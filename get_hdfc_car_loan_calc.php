<? 
$hdfcCity= $_REQUEST["hdfcCity"];
$compCategory= $_REQUEST["compCategory"];
$rateCategory= $_REQUEST["rateCategory"];
$krcFlag= $_REQUEST["krcFlag"];
$tenure_years= $_REQUEST["tenure"];
$carprice= $_REQUEST["carprice"];
$ltv_36= $_REQUEST["ltv_36"];
$ltv_60= $_REQUEST["ltv_60"];
$ltv_84= $_REQUEST["ltv_84"];

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
if($krcFlag==1 && ($compCategory!="" ))
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
			else if ($rateCategory=="D" || $rateCategory=="D+")
			{	
				if($tenure_years<=36)
				{
					$interestRate=11;
				}
				else if ($tenure_years>36 && $tenure_years<=60)
				{
					$interestRate=10.75;
				}
				else if($tenure_years>60 && $tenure_years<=84)
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

$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);

?>
<input type="hidden" value="<? echo $Loan_Amount; ?>" name="nwLA" id="nwLA">
<div style="position:absolute; z-index:100; margin-left:550px; top:110px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;   color:#a41c2b;">
	<div><b>PIE CHART</b></div><? $total_cost = ($emiPerLac*$tenure);
$total_interest = ($emiPerLac*$tenure) - $Loan_Amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;

$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);


?>
	<!--<div id="p3d_activate">-->
<img src="http://chart.apis.google.com/chart?chs=250x100&cht=p3&chd=t:<? echo $lnpre; ?>,<? echo $inper; ?>&chxt=x,y&chds=0,100&chxr=0,0,90|1,0,90&chxl=0:|<? echo $lnpre." %"; ?>|<? echo $inper." %"; ?>&chco=A2D7F6,F4E46C"/>
<div id="sign">
<ul style="margin:0px; ">
<li style=" background:url(icici_car/amount_sign.gif) no-repeat 0px 4px; ">Loan Amount - <? echo "Rs. ".number_format($Loan_Amount);?></li>
<li style=" background:url(icici_car/interest_sign.gif) no-repeat 0px 4px;">Interest Rate - <? echo "Rs. ".number_format($total_interest); ?></li>

</ul>
</div>
</div>

		  <table width="840" align="center"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" width="27%" height="30" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Bank Name </td>
        <td align="center" width="15%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Total Cost </td>
        <td align="center" width="20%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Monthly Payment </td>
        <td align="center" width="17%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">ROI </td>
        <td align="center" width="21%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; "></td>
      </tr>
	    </table>
	  <table width="840" align="center"  border="0" cellspacing="0" cellpadding="0">
		  <tr >
        <td width="27%" height="35" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#002481; ">HDFC Bank Car Loan </td>
        <td width="15%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#002481; "><? echo "Rs. ".number_format($total_cost); ?></td>
        <td width="20%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#002481; "><? echo "Rs. ".number_format($emiPerLac); ?></td>
        <td width="17%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#002481; "><? echo $roi;?></td>
        <td width="21%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#002481; width:176px; "><img src="new-images/get-apply-hdfccl.gif" width="94" height="27"></td>
      </tr>
		</table>
<?
//echo number_format($Loan_Amount)."\n".$roi."\n".$tenure."\n".$emiPerLac."\n".$processing_fee;
}

?>

	