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
	
echo '<table width="100%">		<tr><td align="center" bgcolor="#fe9820" class="tble-text padding-td" ><input type="text" id="loan_amt" value="'.$loan_amount.'" name="loan_amt"></td>      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >
	  <input type="text" value="'.$intr.'" id="interest_rate" name="interest_rate">	</td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >	  <input type="text" value="'.$perlacemi.'" id="emi" name="emi">	 </td>      <td align="center" bgcolor="#fe9820" class="tble-text padding-td">	  <input type="text" value="'.$tenure.'" id="term" name="term">	 </td>      <td align="center" bgcolor="#fe9820" class="tble-text padding-td"><input type="text" value="'.$proc_fee.'" id="proc_fee"></td></tr>		</table>';


		 } ?>