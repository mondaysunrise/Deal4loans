<?php
$loan_amount = $_REQUEST["get_loan_amt"];
 $tenureyrs = $_REQUEST["get_tenure"];
 $employment_stat = $_REQUEST["get_empstat"];
$tenure = $tenureyrs*12;


if(($loan_amount > 0) && ($tenureyrs)>0)
{
	if($employment_stat=="Self Employed")
	{
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
	}
	else
	{
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
	}
	
$emiPerLac = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest), $tenure))));
$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$tenure))),2);

/*$total_cost = ($emiPerLac*$tenure);
$total_interest = ($emiPerLac*$tenure) - $loan_amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;
//$pfpercent= ($processing_fee / $total_cost) *100;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);*/
//$pfper = substr($pfpercent, 0,3);
?>


		  <table width="840" align="center"  border="0" cellspacing="0" cellpadding="0">
		  
      <tr>
        <td align="center" width="27%" height="30" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Loan Amount</td>
        <td align="center" width="15%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Interest Rate</td>
        <td align="center" width="20%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">EMI (Per month)</td>
        <td align="center" width="17%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Per Lac EMI (Per month) </td>
        <td align="center" width="21%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Tenure</td>
      </tr>
	    </table>

	
	  <table width="840" align="center"  border="0" cellspacing="0" cellpadding="0">
		  <tr >
        <td width="27%" height="35" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo $loan_amount; ?></td>
        <td width="15%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo $inter." %"; ?></td>
        <td width="20%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo $emiPerLac; ?></td>
        <td width="17%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo $perlacemi; ?></td>
        <td width="21%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; width:176px; "><? echo $tenureyrs." (in Yrs)"; ?></td>
      </tr>
		</table>
<?
//echo number_format($Loan_Amount)."\n".$roi."\n".$tenure."\n".$emiPerLac."\n".$processing_fee;
}

?>
