<?php

$loan_amount=$_REQUEST["nwLA"];
$tenure=$_REQUEST["tenure"];
$intr=trim($_REQUEST["intr"]);
$proc_fee = $_REQUEST["proc_fee"];
$calcterm = $tenure*12;
$intrst = $intr/1200;

$perlacemi=round($loan_amount * $intrst / (1 - (pow(1/(1 + $intrst), $calcterm))));
if($loan_amount>0 && $tenure>0)
{
	$finalloanamt = $loan_amount;
$finalemiamt =  $perlacemi;
$total_interest_withprinc = $finalemiamt * ($tenure*12);
$total_interest_amt = $total_interest_withprinc-$finalloanamt;
$finalprocfee = $proc_fee;
 
$findme="%";
$pos1 = stripos($finalprocfee, $findme);
if($pos1>0)
{
	$finalprocfee = substr(trim($finalprocfee), 0, strlen(trim($finalprocfee))-1);
	$feetax = $finalloanamt * ($finalprocfee/100);
}
else
{
	$feetax = $finalprocfee;
}

$totalcost=$finalloanamt+$total_interest_amt+$feetax;

echo '<div class="tabular-mainwrapper" style="margin-top:20px !important;"><div class="tabular-icici">
 <table width="100%" border="0" cellspacing="1" cellpadding="1">
   <tr>
		<td colspan="5"><table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Loan Amount</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Interest Rate</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">EMI</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Tenure</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Processing Fee</td>
    </tr>
		<tr><td align="center" bgcolor="#fe9820" class="tble-text padding-td" ><input type="text" id="loan_amt" value="'.$loan_amount.'" name="loan_amt" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;"></td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >
	  <input type="text" value="'.$intr.'" id="interest_rate" name="interest_rate" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;">
	</td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >
	  <input type="text" value="'.$perlacemi.'" id="emi" name="emi" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;">
	 </td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td">
	  <input type="text" value="'.$tenure.'" id="term" name="term" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;">
	 </td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td"><input type="text" value="'.$proc_fee.'" id="proc_fee" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;"></td></tr>
		</table></td></tr></table>
  
</div>

<div class="tabular-maininnner">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td width="13%"><strong>Loan Amount <input type="hidden" name="finLMTAMT" id="finLMTAMT" value="'.$finalloanamt.'" /> <input type="hidden" name="finINTR" id="finINTR" value="'.$total_interest_amt.'" /></strong></td>
      <td width="12%">: <span class="text_highliter">'.number_format($finalloanamt).'</span></td>
      <td width="18%"><strong>Total Interest Amt.</strong></td>
      <td width="15%">: <span class="text_highliter">'.number_format($total_interest_amt).'</span></td>
      <td width="9%"><strong>Fee + tax</strong></td>
      <td width="10%">: <span class="text_highliter">'.number_format($feetax).'</span></td>
      <td width="11%"><strong>Total Cost</strong></td>
      <td width="12%">: <span class="text_highliter">'.number_format($totalcost).'</span></td>
      </tr>
  </table>
</div></div>';


		 } ?>