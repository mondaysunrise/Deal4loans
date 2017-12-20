<? 
require 'scripts/db_init.php';

//print_r($_POST);
$loan_amount=$_REQUEST["nwLA"];
$salary=$_REQUEST["salary"];
$company=trim($_REQUEST["company"]);
$category = $_REQUEST["category"];
$dob = $_REQUEST["dob"];


if($loan_amount>0 && $salary>0 && strlen($company)>0 && $dob>0)
{
	list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)= icicibank($salary,$company,$category,$dob,$loan_amount);

$finalloanamt = $icicigetloanamout;
$finalemiamt =  $icicigetemicalc;
$total_interest_withprinc = $finalemiamt * ($iciciterm*12);
$total_interest_amt = $total_interest_withprinc-$finalloanamt;
$finalprocfee = $iciciperlacemi;
 
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
		<tr><td align="center" bgcolor="#fe9820" class="tble-text padding-td" ><input type="text" id="loan_amt" value="'.$icicigetloanamout.'" name="loan_amt" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;"></td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >
	  <input type="text" value="'.$iciciinterestrate.'" id="interest_rate" name="interest_rate" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;">
	</td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >
	  <input type="text" value="'.$icicigetemicalc.'" id="emi" name="emi" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;">
	 </td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td">
	  <input type="text" value="'.$iciciterm.'" id="term" name="term" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;">
	 </td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td"><input type="text" value="'.$iciciperlacemi.'" name="proc_fee" id="proc_fee" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;"></td></tr>
		</table>
		 </td></tr></table>
  
</div>

<div class="tabular-maininnner">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td width="13%"><strong>Loan Amount </strong> <input type="hidden" name="finLMTAMT" id="finLMTAMT" value="'.$finalloanamt.'" /> <input type="hidden" name="finINTR" id="finINTR" value="'.$total_interest_amt.'" /></td>
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


		 }

function getdob($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18))
		{
			$term = 84;
			$print_term = "7";
		}
	else if(($DOB>50 && $DOB<=54))
		{
			$term = 72;
			$print_term = "6";
		}
	else if(($DOB>50 && $DOB<=55))
		{
			$term = 60;
			$print_term = "5";
		}
	else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
		}
		else if($DOB>56 && $DOB<=57)
		{
			$term = 36;
			$print_term = "3";
		}
		else if($DOB>57 && $DOB<=58)
		{
			$term = 24;
			$print_term = "2";
		}
		else if($DOB>58 && $DOB<=59)
		{
			$term = 12;
			$print_term = "1";
		}
		else if ($DOB>=60)
	{
		$term = 0;
			$print_term = "0";
	}
		$getterm[]= $term;
		$getterm[]= $print_term;
		return($getterm);
}


function icicibank($net_salary,$company,$category,$DOB,$loan_amount)
{
	$exactnet_salary= $net_salary;

	list($term,$print_term)=getdob($DOB);
	$gtcropcomp="Select  interest_rate,	processing_fee From pl_company_iciciapp Where (company_name like '%".$company."%' and interest_rate>0)";
	list($crprecordcount,$icicirow)=MainselectfuncNew($gtcropcomp,$array = array());
$icicirowcontr=count($icicirow)-1;


if($crprecordcount>0)
	{
	list($main,$gen) = split('[.]', $icicirow[$icicirowcontr]["interest_rate"]);
	if($gen==00)
		{
			$interestrate = $main." %";
		}
		else
		{
$interestrate = $icicirow[$icicirowcontr]["interest_rate"]." %";
		}
		
		//echo $interestrate."<br>";
			$intr=$icicirow[$icicirowcontr]["interest_rate"]/1200;
			
			$proc_Fee = $icicirow[$icicirowcontr]["processing_fee"];
	}
	else
	{
		if($category=="Elite" || $category=="SuperPrime" || $category=="SUPERPRIME" || $category=="ELITE")
		{
			if($net_salary>75000)
			{
				$interestrate = "15.50%";
				$intr=15.50/1200;
				$proc_Fee ="1.5%";			
			}
			else if ($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="1.5%";
			}
			else if ($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "16.50%";
				$intr=16.5/1200;
				$proc_Fee ="2%";
			}
			else if ($net_salary>20000 && $net_salary<=35000)
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2%";
			
			}
			else
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2%";
				
			}
		}
		else if($category=="Preferred" || $category=="PREFERRED")
		{
			if($net_salary>75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="2%";			
			}
			else if ($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16.50%";
				$intr=16.5/1200;
				$proc_Fee ="2%";
			}
			else if ($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2%";
			}
			else if ($net_salary>20000 && $net_salary<=35000)
			{
				$interestrate = "17.50%";
				$intr=17.5/1200;
				$proc_Fee ="2%";
			
			}
			else
			{
				$interestrate = "17.50%";
				$intr=17.5/1200;
				$proc_Fee ="2%";
				
			}
		}
		else
		{
			if($category=="DEFENCE")
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="0";
			}
			else
			{
			if($net_salary>75000)
			{
				$interestrate = "16%";
				$intr=16/1200;
				$proc_Fee ="2%";			
			}
			else if($net_salary>50000 && $net_salary<=75000)
			{
				$interestrate = "16.50%";
				$intr=16.5/1200;
				$proc_Fee ="2%";
			}
			else if($net_salary>35000 && $net_salary<=50000)
			{
				$interestrate = "17%";
				$intr=17/1200;
				$proc_Fee ="2%";
			}
			else if($net_salary>20000 && $net_salary<=35000)
			{
				$interestrate = "17.50%";
				$intr=17.5/1200;
				$proc_Fee ="2%";
			
			}
			else
			{
				$interestrate = "17.50%";
				$intr=17.5/1200;
				$proc_Fee ="2%";
				
			}
			}
		}

	}
	//Calculate Term
	if($category=="Elite" || $category=="SuperPrime" || $category=="SUPERPRIME" || $category=="ELITE")
	{
		if($term>60)
		{
			$calcterm=60;
			$getterm=5;
		}
		else
		{	
			$calcterm=$term;
			$getterm=$print_term;
		}
	}
	else if($category=="Preferred" || $category=="PREFERRED")
	{
		if($term>48)
		{
			$calcterm=48;
			$getterm=4;
		}
		else
		{	
			$calcterm=$term;
			$getterm=$print_term;
		}
	}
	else
	{
		if($term>36)
		{
			$calcterm=36;
			$getterm=3;
		}
		else
		{	
			$calcterm=$term;
			$getterm=$print_term;
		}
		
	}
$princ=100000;
	$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));


/*****Special Clause*******************************************/
if($loan_amount>=1500000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME" || $category=="ELITE"  || $category=="PREFERRED"))
	{
	//echo "entered";
		$interestrateclause = "13.49%";
		$intrclause=13.49/1200;
		if($intrclause<$intr)
		{
			$interestrate = "13.49%";
			$intr=13.49/1200;
			$proc_Fee ="0.50%";
		}
		else
		{
			$interestrate = $interestrate;
			$intr=$intr;
			$proc_Fee = $proc_Fee;
		}
	
	}
	elseif(($loan_amount>=1000000 && $loan_amount<1500000) && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME" ||  $category=="ELITE"  || $category=="PREFERRED"))
	{
		$interestrateclause = "14%";
		$intrclause=14/1200;
		if($intrclause<$intr)
		{
			$interestrate = "14%";
			$intr=14/1200;
			$proc_Fee ="0.50%";
		}
		else
		{
			$interestrate = $interestrate;
			$intr=$intr;
			$proc_Fee =$proc_Fee;
		}
		

	}
//echo "<br><br>here2 : <br><br>";

##################################################################################
/*for ICICI employees*/
 $comppos = strpos($company, 'icici');
//echo "<br><br>here : <br><br>";
if(($comppos>=0 || $comppos==0) && $loan_amount>1000000  && strlen($comppos)>0)
	{
	if($loan_amount>1000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME"  || $category=="ELITE" || $category=="PREFERRED"))
	{
		$interestrateclause = "13.49%";
		$intrclause=13.49/1200;
		if($intrclause<$intr)
		{
			$interestrate = "13.49%";
			$intr=13.49/1200;
			$proc_Fee ="999";
		}
		else
		{
			$interestrate = $interestrate;
			$intr=$intr;
			$proc_Fee = $proc_Fee;
		}
		
	}
	}
	elseif(($comppos>=0 || $comppos==0) && $loan_amount<1000000  && strlen($comppos)>0)
	{
		//echo "enter";
	if($loan_amount<1000000 && ($category=="Elite" || $category=="SuperPrime" || $category=="Preferred" || $category=="SUPERPRIME"  || $category=="ELITE" || $category=="PREFERRED"))
	{
		$interestrateclause = "14%";
		$intrclause=14/1200;
		if($intrclause<$intr)
		{
			$interestrate = "14%";
			$intr=14/1200;
			$proc_Fee ="999";
		}
		else
		{
			$interestrate = $interestrate;
			$intr=$intr;
			$proc_Fee =$proc_Fee;
		}
		
	}
	}
###################################################################################

$getemicalc=round($loan_amount * $intr / (1 - (pow(1/(1 + $intr), $calcterm))));

	$details[]=$interestrate;
	$details[]=round($loan_amount);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$proc_Fee;

	return($details);
}



?>