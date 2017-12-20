<?php
$getbankname=("Select plintr_bank_name From personalloan_interest_rates_chart Where (plintr_flag=1) and plintr_bank_name like '%".$bankNameRates."%'  group by plintr_bank_name order by  plintr_seq ASC");

list($countRates,$bnk)=MainselectfuncNew($getbankname,$array = array());
$cntr=0;
$bankname="";
while($cntr<count($bnk))
        {
	$bankname[]=$bnk[$cntr]["plintr_bank_name"];
$cntr = $cntr + 1;}

if($countRates>0)
{
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
     <td height="38" colspan="3"><h3>Current interest rates on <?php echo $bankname[0];?> Personal loans - <?php echo date("F, Y"); ?></h3></td>
  </tr>
  <tr>
 
        <td width="22%" height="40" align="center" bgcolor="#eceffa"><strong>Interest Rates</strong></td>
     
   
       
    <td width="15%" align="center" bgcolor="#eceffa"><strong>Pre Payment <br />
    Charges</strong></td>
    <td width="16%" align="center" bgcolor="#eceffa"><strong>Processing<br />
Fees</strong></td>
      
     
  </tr>
<? for($i=0;$i<count($bankname);$i++)
{
	?>

      <tr>
<td width="22%" align="center"  style="border:#CCC thin solid; padding-top:5px; padding-bottom:5px;"><? $getcata=("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)");
		
list($countRates,$rowa)=MainselectfuncNew($getcata,$array = array());

	$catadesr="";
for($j=0;$j<count($rowa);$j++)
        {
	list($main,$gen) = split('[.]', $rowa[$j]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowa[$j]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowa[$j]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowa[$j]["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_cata=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_cata=$minintr."%";
	}
	echo $range_cata;
	if(strlen($rowa[$j]["plintr_description"])>2)
	{
		echo $catadesr="<br>(".$rowa[$j]["plintr_description"].")<br>";
	}
} ?></td>
<!--<td width="22%" align="center" style="border:#CCC thin solid; padding-top:5px; padding-bottom:5px;">
<? $getcatb=("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)"); 

 list($recordcountrow,$rowb)=MainselectfuncNew($getcatb,$array = array());
		$b=0;
		
		
$catbdesr="";
while($b<count($rowb))
        {
	list($main,$gen) = split('[.]', $rowb[$b]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowb[$b]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowb[$b]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowb[$b]["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catb=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catb=$minintr."%";
	}
echo $range_catb;
	if(strlen($rowb[$b]["plintr_description"])>2)
	{
		echo $catbdesr="<br>(".$rowb[$b]["plintr_description"].")<br>";
	}
$b = $b +1;
} ?></td>
<td width="15%" align="center" bgcolor="#FFFFFF" style="border:#CCC thin solid; padding-top:5px; padding-bottom:5px;"><? $getcatc=("Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)"); 
			
			 list($recordcount,$rowc)=MainselectfuncNew($getcatc,$array = array());
		$c=0;
			
			$catcdesr="";

while($c<count($rowc))
        {
	list($main,$gen) = split('[.]', $rowc[$c]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowc[$c]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowc[$c]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowc[$c]["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catc=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catc=$minintr."%";
	}
echo $range_catc;
	if(strlen($rowc[$c]["plintr_description"])>2)
	{
		echo $catcdesr="<br>(".$rowc[$c]["plintr_description"].")<br>";
	}
$c = $c+1;
} ?></td>-->
		<? $chargesqry=("Select plintr_procfee,plintr_prepay,plintr_url From personalloan_interest_rates_chart Where (plintr_flag=1 and plintr_seq=1 and	plintr_bank_name='".$bankname[$i]."')");
		 list($recordcounta,$rowcchq)=MainselectfuncNew($chargesqry,$array = array());
		$k=0;
		?>
 <td width="15%" align="center" style="border:#CCC thin solid; padding-top:5px; padding-bottom:5px;"><? echo $rowcchq[$k]["plintr_prepay"]; ?></td>
        <td width="16%" align="center" style="border:#CCC thin solid; padding-top:5px; padding-bottom:5px;"><? echo $rowcchq[$k]["plintr_procfee"]; ?>	</td>
       

  </tr>
  
  
<? } ?>
    <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<?php
}
?>