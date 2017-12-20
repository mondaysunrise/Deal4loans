<? require 'scripts/db_init.php';

$nwLA= $_REQUEST["nwLA"];
$tenure= $_REQUEST["tenure"];
$j = $_REQUEST["countr"];
$carName = $_REQUEST["carName"];
$roiamt = $_REQUEST["roiamt"];
$model = $_REQUEST["model"];

if(($carName)>0)
{
	
$getcardetails="Select hdfc_car_name,car_videocode from hdfc_car_list_category Where (hdfc_clid='".$carName."')";
list($recordcount,$row)=Mainselectfunc($getcardetails,$array = array());
$hdfc_car_name = $row["hdfc_car_name"];
$car_videocode = $row["car_videocode"];

}


if((($nwLA)>0) && (($tenure)>0) && (strlen($carName)>0) && (strlen($roiamt)>0))
{
$interestRate = $roiamt;
$alac=$nwLA;
$intr=$roiamt/1200;
$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $tenure))));
  $maxTenure=$tenure;
	 $Loan_Amount=$nwLA;
	 $roi=$roiamt." %";

$tenure=$tenure;
	//alert(interestRate);
	


$maxLoan_Amount= $nwLA;

$total_cost = ($emiPerLac*$tenure);
$total_interest = ($emiPerLac*$tenure) - $Loan_Amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;

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

	