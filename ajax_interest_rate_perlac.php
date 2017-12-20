<?php
error_reporting('E_ALL');
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$amount = $_REQUEST['value'];
$bankNameStr = $_REQUEST['strbankname'];
$bankName = str_replace("-"," ",$_REQUEST['bankname']);
$bankname = explode(",",$bankNameStr);
//echo "Bank Name: ".$bankNameStr."<br />";

# Function to get EMI according to amount #
function getEmiCalc($loanAmount,$interestRate,$term){
	
	$getloanamout = $loanAmount;
	$intr = $interestRate;
	
	$getemicalc = round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
	return($getemicalc);
}
?>

<div class="table-banks_overflow">

<table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
    <tr bgcolor="#88a943">
        <td width="13%" rowspan="2" align="center" bgcolor="#88a943" class="tblwt_txt"><b>Banks/Rates</b></td>
        <td height="25" colspan="9" align="center" bgcolor="#88a943" class="tblwt_txt"><b>Salaried</b></td>
    </tr>
    <tr bgcolor="#88a943">
        <td width="19%" height="30" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>CAT A</b></td>
        <td width="19%" height="30" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Per <?php echo $amount; ?> lac EMI</b><br />(For 4 yrs.)</td>
        <td width="19%" height="30" align="center" bgcolor="#88a943" style="font-weight:bold; color:#FFFFFF; clear:both"><b>CAT B</b></td>
        <td width="19%" height="30" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Per <?php echo $amount; ?> lac EMI</b><br />(For 4 yrs.)</td>
        <td width="21%" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Others</b></td>
        <td width="19%" height="30" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Per <?php echo $amount; ?> lac EMI</b><br />(For others for 4 yrs.)</td>
        <td width="15%" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Pre Payment Charges</b></td>
        <td width="13%" align="center" style="font-weight:bold; color:#FFFFFF; clear:both"><b>Processing Fees</b></td>
    </tr>
    <?php 
	if(!empty($bankName)){ 
		
		if($bankName=='State Bank of India/SBI'){
			$bankName = 'State Bank of India/SBI(SBI Saral)';
		}
	?>	
	<tr bgcolor="#EFEEEE">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">
        <?php if(strlen($plintr_url[$i])>0) { ?>
        <a href="<?php echo $plintr_url[$i]; ?>" target="_blank" ><b><?php echo $bankname[$i]; ?></b></a>
        <?php 
		}else { 
        	echo "<strong>".$bankName."</strong>";
		} 
		?>
        </td>
		<td height="17" align="center" bgcolor="#FFFFFF" class="tbl_txt">
		<?php
		$getSql = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankName."' and plintr_flag=1)";
        list($alreadyExist,$rowa)=MainselectfuncNew($getSql,$array = array());

$catadesr="";
for($ca=0;$ca<$alreadyExist;$ca++)
        {
            list($main,$gen) = split('[.]', $rowa[$ca]["plintr_min_rates"]);
            if($gen==00){
                $minintr = $main;		
            }else{
                $minintr = $rowa[$ca]["plintr_min_rates"];
            }
        
            list($maxmain,$maxgen) = split('[.]', $rowa[$ca]["plintr_max_rates"]);
            
            if($maxgen==00){
                $maxintr = $maxmain;		
            }else{
                $maxintr = $rowa[$ca]["plintr_max_rates"];
            }
        
            if($maxmain>2){
                $range_cata=$minintr."% - ".$maxintr."%";
            }else{
                $range_cata=$minintr."%";
            }
            if($minintr>1){
                echo "<b>".$range_cata."</b>";
            }else{
                echo "N.A";
            }
            if(strlen($rowa[$ca]["plintr_description"])>2){
                echo $catadesr="<br>(".$rowa[$ca]["plintr_description"].")<br>";
            }
        } 
        ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
        <?php
        $showEmiQry = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankName."' and plintr_flag=1)";
         list($showEmiResNR,$showEmiRes)=MainselectfuncNew($showEmiQry,$array = array());

		for($i=0;$i<$showEmiResNR;$i++)
		{            
            $interestRateMin = ($showEmiRes[$i]["plintr_min_rates"]/1200);
            $interestRateMax = ($showEmiRes[$i]["plintr_max_rates"]/1200);
            
            if($showEmiRes[$i]["plintr_min_rates"]>0 && $showEmiRes[$i]["plintr_max_rates"]>0){
        
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48)." - Rs.".getEmiCalc($amount,$interestRateMax,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }else{
            
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }
        }
        ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
		<?php $getcatb="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankName."' and plintr_flag=1)";
       list($alreadyExist,$rowa)=MainselectfuncNew($getcatb,$array = array());
$catbdesr="";
for($ca=0;$ca<$alreadyExist;$ca++)
{
	list($main,$gen) = split('[.]', $rowb[$ca]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowb[$ca]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowb[$ca]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowb[$ca]["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catb=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catb=$minintr."%";
	}
	if($minintr>1)
	{
	echo "<b>".$range_catb."</b>";
	
	}
	else
	{
 echo "N.A";
}
	if(strlen($rowb[$ca]["plintr_description"])>2)
	{
		echo $catbdesr="<br>(".$rowb[$ca]["plintr_description"].")<br>";
	}

} ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
        <?php
        $showEmiQry = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankName."' and plintr_flag=1)";
        
         list($showEmiResNR,$showEmiRes)=MainselectfuncNew($showEmiQry,$array = array());

		for($i=0;$i<$showEmiResNR;$i++)
		{            
            $interestRateMin = ($showEmiRes[$i]["plintr_min_rates"]/1200);
            $interestRateMax = ($showEmiRes[$i]["plintr_max_rates"]/1200);
            
            if($showEmiRes[$i]["plintr_min_rates"]>0 && $showEmiRes[$i]["plintr_max_rates"]>0){
        
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48)." - Rs.".getEmiCalc($amount,$interestRateMax,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";		
            }else{
            
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }
        } 
        ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
        <?php 
        $getcatc="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankName."' and plintr_flag=1)"; 
       list($alreadyExist1,$rowc)=MainselectfuncNew($getcatc,$array = array());
$catcdesr="";
for($catc=0;$catc<$alreadyExist1;$catc++)
{
	list($main,$gen) = split('[.]', $rowc[$catc]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowc[$catc]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowc[$catc]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowc[$catc]["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catc=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catc=$minintr."%";
	}
	if($minintr>1)
	{
	echo "<b>".$range_catc."</b>";
	
	}
	else
	{
 echo "N.A";
}

	if(strlen($rowc[$catc]["plintr_description"])>2)
	{
		echo $catcdesr="<br>(".$rowc[$catc]["plintr_description"].")<br>";
	}
} 
 
        ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
        <?php
        $showEmiQry = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankName."' and plintr_flag=1)";
		list($showEmiResNR,$showEmiRes)=MainselectfuncNew($showEmiQry,$array = array());

		for($i=0;$i<$showEmiResNR;$i++)
		{
            $interestRateMin = ($showEmiRes[$i]["plintr_min_rates"]/1200);
            $interestRateMax = ($showEmiRes[$i]["plintr_max_rates"]/1200);
            
            if($showEmiRes[$i]["plintr_min_rates"]>0 && $showEmiRes[$i]["plintr_max_rates"]>0){
        
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48)." - Rs.".getEmiCalc($amount,$interestRateMax,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }else{
            
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }
        } 
        ?>
        </td>
		<?php 
        $chargesqry="Select plintr_procfee,plintr_prepay From personalloan_interest_rates_chart Where (plintr_flag=1 and plintr_seq=1 and	plintr_bank_name='".$bankName."')";
	    list($alreadyExist2,$rowcchq)=MainselectfuncNew($chargesqry,$array = array());
        ?>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? echo $rowcchq[0]["plintr_prepay"]; ?></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? echo $rowcchq[0]["plintr_procfee"]; ?>	</td>        
    </tr>	
	<?php	
	}else{
    	for($i=0;$i<count($bankname);$i++){ 
	?>
    <tr bgcolor="#EFEEEE">
        <td height="25" align="left" bgcolor="#FFFFFF" class="tbl_txt">
        <?php if(strlen($plintr_url[$i])>0) { ?>
        <a href="<?php echo $plintr_url[$i]; ?>" target="_blank" ><b><?php echo $bankname[$i]; ?></b></a>
        <?php 
		}else { 
        	echo "<strong>".$bankname[$i]."</strong>";
		} 
		?>
        </td>
		<td height="17" align="center" bgcolor="#FFFFFF" class="tbl_txt">
		<?php
		//echo "Bank Name: ".$bankname[$i]."<br>";
		//echo "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
		//echo "<br>";
        $getcata="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
       list($alreadyExist,$rowa)=MainselectfuncNew($getcata,$array = array());

$catadesr="";
for($ca=0;$ca<$alreadyExist;$ca++)
{
	list($main,$gen) = split('[.]', $rowa[$ca]["plintr_min_rates"]);
	
	if($gen==00){
		$minintr = $main;		
	}else{
		$minintr = $rowa[$ca]["plintr_min_rates"];
	}

	list($maxmain,$maxgen) = split('[.]', $rowa[$ca]["plintr_max_rates"]);
	
	if($maxgen==00){
		$maxintr = $maxmain;		
	}else{
		$maxintr = $rowa[$ca]["plintr_max_rates"];
	}

	if($maxmain>2)
	{
		$range_cata=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_cata=$minintr."%";
	}
	if($minintr>1)
	{
		echo "<b>".$range_cata."</b>";
	}
	else
	{
		echo "N.A";
	}
	if(strlen($rowa[$ca]["plintr_description"])>2)
	{
		echo $catadesr="<br>(".$rowa[$ca]["plintr_description"].")<br>";
	}
} 
        ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
        <?php
        $showEmiQry = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='A' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
    list($showEmiResNR,$showEmiRes)=MainselectfuncNew($showEmiQry,$array = array());

		for($i=0;$i<$showEmiResNR;$i++)
		{        
            $interestRateMin = ($showEmiRes[$i]["plintr_min_rates"]/1200);
            $interestRateMax = ($showEmiRes[$i]["plintr_max_rates"]/1200);
            
            if($showEmiRes[$i]["plintr_min_rates"]>0 && $showEmiRes[$i]["plintr_max_rates"]>0){
        
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48)." - Rs.".getEmiCalc($amount,$interestRateMax,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }else{
            
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }
        }
        ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
		<?php 
		$getcatb="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
       list($alreadyExist,$rowa)=MainselectfuncNew($getcatb,$array = array());
$catbdesr="";
for($ca=0;$ca<$alreadyExist;$ca++)
{
	list($main,$gen) = split('[.]', $rowb[$ca]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowb[$ca]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowb[$ca]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowb[$ca]["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catb=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catb=$minintr."%";
	}
	if($minintr>1)
	{
	echo "<b>".$range_catb."</b>";
	
	}
	else
	{
 echo "N.A";
}
	if(strlen($rowb[$ca]["plintr_description"])>2)
	{
		echo $catbdesr="<br>(".$rowb[$ca]["plintr_description"].")<br>";
	}

}
        ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
        <?php
        $showEmiQry = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='B' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
        list($showEmiResNR,$showEmiRes)=MainselectfuncNew($showEmiQry,$array = array());
		for($i=0;$i<$showEmiResNR;$i++)
		{
            $interestRateMin = ($showEmiRes[$i]["plintr_min_rates"]/1200);
            $interestRateMax = ($showEmiRes[$i]["plintr_max_rates"]/1200);
            
            if($showEmiRes[$i]["plintr_min_rates"]>0 && $showEmiRes[$i]["plintr_max_rates"]>0){
        
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48)." - Rs.".getEmiCalc($amount,$interestRateMax,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";		
            }else{
            
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }
        } 
        ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
        <?php
        $getcatc="Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
      list($alreadyExist1,$rowc)=MainselectfuncNew($getcatc,$array = array());
$catcdesr="";
for($catc=0;$catc<$alreadyExist1;$catc++)
{
	list($main,$gen) = split('[.]', $rowc[$catc]["plintr_min_rates"]);
	if($gen==00)	{			$minintr = $main;		}
		else		{$minintr = $rowc[$catc]["plintr_min_rates"];		}

	list($maxmain,$maxgen) = split('[.]', $rowc[$catc]["plintr_max_rates"]);
	if($maxgen==00)	{			$maxintr = $maxmain;		}
		else		{$maxintr = $rowc[$catc]["plintr_max_rates"];		}

	if($maxmain>2)
	{
		$range_catc=$minintr."% - ".$maxintr."%";
	}
	else
	{
		$range_catc=$minintr."%";
	}
	if($minintr>1)
	{
	echo "<b>".$range_catc."</b>";
	
	}
	else
	{
 echo "N.A";
}

	if(strlen($rowc[$catc]["plintr_description"])>2)
	{
		echo $catcdesr="<br>(".$rowc[$catc]["plintr_description"].")<br>";
	}
} 
        ?>
        </td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt">
        <?php
        $showEmiQry = "Select plintr_min_rates,plintr_max_rates,plintr_description From personalloan_interest_rates_chart Where (plintr_category='C' and plintr_bank_name='".$bankname[$i]."' and plintr_flag=1)";
      list($showEmiResNR,$showEmiRes)=MainselectfuncNew($showEmiQry,$array = array());

		for($i=0;$i<$showEmiResNR;$i++)
		{
            $interestRateMin = ($showEmiRes[$i]["plintr_min_rates"]/1200);
            $interestRateMax = ($showEmiRes[$i]["plintr_max_rates"]/1200);
            
            if($showEmiRes[$i]["plintr_min_rates"]>0 && $showEmiRes[$i]["plintr_max_rates"]>0){
        
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48)." - Rs.".getEmiCalc($amount,$interestRateMax,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }else{
            
                echo "Rs.".getEmiCalc($amount,$interestRateMin,48);
                echo "<br />";
                echo "(".$showEmiRes[$i]['plintr_description'].")<br />";
            }
        } 
        ?>
        </td>
		<?php 
        $chargesqry="Select plintr_procfee,plintr_prepay From personalloan_interest_rates_chart Where (plintr_flag=1 and plintr_seq=1 and	plintr_bank_name='".$bankname[$i]."')";
	    list($alreadyExist2,$rowcchq)=MainselectfuncNew($chargesqry,$array = array());
        ?>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? echo $rowcchq[0]["plintr_prepay"]; ?></td>
        <td align="center" bgcolor="#FFFFFF" class="tbl_txt"><? echo $rowcchq[0]["plintr_procfee"]; ?>	</td>        
    </tr>
    <?php 
			}
		}
	?>
    <tr bgcolor="#EFEEEE">
        <td height="25" colspan="3" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b>Transfer your personal loan to HDFC Bank</b><br /></td>
        <td height="35" colspan="5" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">As Low As 12.99%</td>
        <td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">Flat Processing Fee of Rs 999/-</td>
	</tr>  
<!-------------------------------------------------MANUAL----------------------------------------------->
</table>
</div>