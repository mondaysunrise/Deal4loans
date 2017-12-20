<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/hlicici_eligibility_function.php';
	
//echo "Got this....<br>";
//print_r($_GET);
	function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

function  iciciHomeloan($netAmount,$loan_amount,$DOB,$obligations,$City,$property_value,$tenure,$Employment_Status) //replica of 	require 'scripts/home_loan_eligibility_function.php'; for addding tenure
{
	//echo $netAmount."--".$loan_amount."--".$DOB."--".$obligations."--".$City."--".$property_value."--".$tenure."--".$Employment_Status;

		$print_term = $tenure;
		$term = $print_term * 12;

		$getlocationlist=("Select location_category From icici_hfc_location_list Where location_name like '%".$City."%'");
		 list($recordcount,$row)=MainselectfuncNew($getlocationlist,$array = array());
		$cntr=0;
		
		
		//$row=mysql_fetch_array($getlocationlist);
		$location_category= $row[$cntr]['location_category'];

		if((($location_category==A || $location_category==B) && $netAmount>=18000) || ($location_category==C && $netAmount>=15000))
			{
if($netAmount<=30000)
		{
			if($Employment_Status==1)
			{
				$rt = 40;
			}
			else
			{
				$rt = 80;
			}
			$applicableFOIR = round($netAmount * $rt / 100)	;
		}
		elseif($netAmount>30000 && ($netAmount<=50000))
		{
			if($Employment_Status==1)
			{
				$rt = 45;
			}
			else
			{
				$rt = 80;
			}
			$applicableFOIR = round($netAmount * $rt / 100)	;
		}
		elseif($netAmount>50000)
		{
			if($Employment_Status==1)
			{
				$rt = 50;
			}
			else
			{
				$rt = 80;
			}
			$applicableFOIR = round($netAmount * $rt / 100)	;
		}
		
		
		if($loan_amount<=2500000)
		{
			//$emiPerLac = "883.71";
			$inter = 10.50;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>2500000) && ($loan_amount<=7500000))
		{
			//$emiPerLac = "915.86";
			$inter = 11;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>7500000)
		{
			$inter = 11.50;
			$interest = $inter / 1200;
		}
		$princ=100000;
		
//echo "<br>applicableFOIR - ".$applicableFOIR."<br>";
		
		$emiPerLac = round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));

		$loanPossible = round((($applicableFOIR) / $emiPerLac),2);
		$viewLoanAmt = $loanPossible * 100000;

		
	//	$loan_amount = $loan_amount ;
		$loan_amount = $viewLoanAmt ;
	

	if($property_value>1)
	{
		$getproperty_value= $property_value * (.85) ;

	//echo "loan_amount - ".$loan_amount." - getproperty_value - ".$getproperty_value;
		if($loan_amount>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$loan_amount;
		}
	}
	
 		if($loan_amount<=2500000)
		{
			//$emiPerLac = "883.71";
			$inter = 10.50;
			$interest = $inter / 1200;
		}
		else if (($loan_amount>2500000) && ($loan_amount<=7500000))
		{
			//$emiPerLac = "915.86";
			$inter = 11;
			$interest = $inter / 1200;
		}
		else if ($loan_amount>7500000)
		{
			$inter = 11.50;
			$interest = $inter / 1200;
		}
//for Fxed Rates	 only
		if($loan_amount<=2500000)
		{
			$inter1st = 10.50;
			$inter2ndn3rd = 10.75;
			$interest1st = $inter1st / 1200;
			$interest2ndn3rd = $inter2ndn3rd / 1200;
		}
		else if (($loan_amount>2500000) && ($loan_amount<=7500000))
		{
			
			$inter1st = 11;
			$inter2ndn3rd = 11.25;
			$interest1st = $inter1st / 1200;
			$interest2ndn3rd = $inter2ndn3rd / 1200;
		}
		else if ($loan_amount>7500000)
		{
			$inter1st = 11.50;
			$inter2ndn3rd = 11.75;
			$interest1st = $inter1st / 1200;
			$interest2ndn3rd = $inter2ndn3rd / 1200;
		}
		//echo "INT".$interest1st."Term - ".$term."Amt - ".$loan_amount;
		//echo "<br>";
		
		$emi1st = round($loan_amount * $interest1st / (1 - (pow(1/(1 + $interest1st),$term))),2);
		$emi2ndn3rd = round($loan_amount * $interest2ndn3rd / (1 - (pow(1/(1 + $interest2ndn3rd),$term))),2);

		$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
		$restemi = "<b>Scheme I: </b>".$emi1st." (Fixed for 1yr), <b>Scheme II: </b>".$emi2ndn3rd." (Fixed for 2yrs)";


		$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

		$perlacemifor1 = round(100000 * $interest1st / (1 - (pow(1/(1 + $interest1st),$term))),2);
		$perlacemifor2 = round(100000 * $interest2ndn3rd / (1 - (pow(1/(1 + $interest2ndn3rd),$term))),2);
		
		$exactinter="<b>Scheme I: </b>".$inter1st."% (Fixed for 1yr),<b>Scheme II:</b> ".$inter2ndn3rd."% (Fixed for 2yrs), Then ".$inter;
		


//$exactperlacemi="<b>Scheme I: </b>".$perlacemifor1." (Fixed for 1yr), <b>Scheme II: </b>".$perlacemifor2." (Fixed for 2yrs), Then ".abs($perlacemi);
$exactperlacemi = abs($perlacemi);

$yr1st=1;
$yr2nd=2;
		//$exactperlacemi="Rs ".abs($perlacemifor1)."(Fixed for 1st yr), Rs".abs($perlacemifor2)."(Fixed for 2nd yr),Then ".abs($perlacemi);
$getemi=$restemi.", Then ".$actualemi;
//$getemi = $actualemi;
	
   $details[]= $emi1st;
   $details[]= $perlacemifor1;
   $details[]= $inter1st;
   $details[]= $yr1st;
   
    $details[]= $emi2ndn3rd;
    $details[]= $perlacemifor2;
    $details[]= $inter2ndn3rd;
    $details[]= $yr2nd;
	
   	$details[]= $actualemi;
	$details[] = $exactinter;
	$details[]= $loan_amount;
	$details[]= $exactperlacemi;
	$details[]= $term;
	$details[]= $loan_amount;
	
			}
			else
	{
		//echo "ICICI not Eligible for loan";
	}
	//print_r($details);
	
return($details);


		}
$loan_amount = $_REQUEST["get_loan_amt"];
 $tenure = $_REQUEST["get_tenure"];
  $netAmount = $_REQUEST["netAmount"];
  
 $dateofbirth = $_REQUEST["DOB"];
 $City = $_REQUEST["City"];
 $total_obligation = $_REQUEST["total_obligation"];
  $property_value = $_REQUEST["property_value"];
  $eligible_loan_amt = $_REQUEST["eligible_loan_amt"];
    $Employment_Status = $_REQUEST["Employment_Status"];
  $DOB = str_replace("-","", $dateofbirth);
	$DOB = DetermineAgeFromDOB($DOB);
	$tenorPossible = 60 - $DOB;
 
 	
		list($emi1st, $perlacemifor1, $inter1st, $yr1st, $emi2ndn3rd, $perlacemifor2, $inter2ndn3rd, $yr2nd, $actualemi, $exactinter, $iciciloan_amount, $exactperlacemi, $iciciprint_term,$viewLoanAmt ) = iciciHomeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$tenure,$Employment_Status); 
	
//	$aa = iciciHomeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$tenure,$Employment_Status); 
//	print_r($aa);
//	list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm)=iciciHomeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$tenure);
	
		$IP = getenv("REMOTE_ADDR");
		$Net_Salary= $monthly_income *12;
	//	echo "<br>".$iciciprint_term;
		
		//$aa = iciciHomeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$tenure);
	//	print_r($aa);
		//echo "<br>";

		$Loan_Amount = $viewLoanAmt;
		$tenure = $iciciprint_term;
		$interest = $inter1st;

	    $emi_fixed =  $emi1st * ($yr1st * 12);
	    $leftTerm = $iciciprint_term - ($yr1st * 12);
	    $emi_left = $actualemi * $leftTerm;
	    $totalEmi = $emi_fixed + $emi_left;
	   
	    $icicigetinterestamt=($totalEmi - $Loan_Amount);

	    $totalinterestamt= floor($icicigetinterestamt);


?>



<div style="position:absolute; z-index:100; margin-left:560px; top:165px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;   color:#a41c2b;">
	<div><b>PIE CHART [Scheme I]	</b></div>
<?php	//	echo "<br>";
$total_cost =  $viewLoanAmt + $totalinterestamt;
$lapercent= ($viewLoanAmt / $total_cost) *100;
$Inpercent = ($totalinterestamt / $total_cost) *100;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);
?>
<img src="http://chart.apis.google.com/chart?chs=250x100&cht=p3&chd=t:<? echo $lnpre; ?>,<? echo $inper; ?>&chxt=x,y&chds=0,100&chxr=0,0,90|1,0,90&chxl=0:|<? echo $lnpre." %"; ?>|<? echo $inper." %"; ?>&chco=A2D7F6,F4E46C"/>
<div id="sign">
<ul style="margin:0px; ">
<li style=" background:url(icici_car/amount_sign.gif) no-repeat 0px 4px; ">Loan Amount -  <? echo "Rs. ".number_format($viewLoanAmt);?></li>
<li style=" background:url(icici_car/interest_sign.gif) no-repeat 0px 4px;">Interest Amount - <? echo "Rs. ".number_format($totalinterestamt); ?></li>
</ul>
</div>

    
</div>

	<table width="870" align="center"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="text" colspan="2" align="center">
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#E9DCB4" class="bldtxt">
                   <tr>
                          <td height="35" bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Bank Name</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rate of Interest </td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">EMI(Per Month)</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Tenure</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Required Loan Amount</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Maximum Eligible Loan Amount</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">EMI(Per Lac)</td>
						   <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Total Interest Amount</td>
</tr>
<?
						if(strlen($iciciloan_amount)>0)
						{
						
					?>
					 <tr>
                          <td height="35" bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">SchemeI</td>
						  <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">

						  <?php echo $inter1st; ?>%(Fixed for 1yr), then  <?php echo $inter1st; ?>%</td>
                         <td bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
                         
                         Rs.<?php echo $emi1st; ?>(Fixed for 1yr), then Rs.<?php echo $actualemi; ?></td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; "><?php echo ceil($iciciprint_term/12); ?> yrs.</td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $loan_amount; ?></td>
						   <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $viewLoanAmt; ?></td>
						    <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
                             Rs. <?php echo $perlacemifor1; ?> (Fixed for 1yr), then Rs. <?php echo $exactperlacemi; ?></td>
							 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php
							   
							   $emi_fixed =  $emi1st * ($yr1st * 12);
							   $leftTerm = $iciciprint_term - ($yr1st * 12);
							   $emi_left = $actualemi * $leftTerm;
							   $totalEmi = $emi_fixed + $emi_left;
							   
						      //$iciciinterestfortwoyr= (($perlacemifortwo * 2) - $iciciloan_amount);

							   //$remingterm=$idbiterm - 2;
						     $icicigetinterestamt=($totalEmi - $viewLoanAmt);

							  $totalinterestamt= ($icicigetinterestamt);
							 echo floor($totalinterestamt);
							 
							 //$a = ($iciciactualemi * $iciciprint_term) - $iciciviewLoanAmt;
							 //echo abs($a);
							 ?></td>
                        </tr>
                         <tr>
                          <td height="35" bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">SchemeII</td>
						  <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
						  	  <?php echo $inter2ndn3rd; ?>%(Fixed for 2yr), then  <?php echo $inter1st; ?>%
						  </td>
                         <td bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
                         Rs.<?php echo $emi2ndn3rd; ?>(Fixed for 2yr), then Rs.<?php echo $actualemi; ?>
</td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; "><?php echo ceil($iciciprint_term/12); ?> yrs.</td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $loan_amount; ?></td>
						   <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $viewLoanAmt; ?></td>
						    <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
                              Rs. <?php echo $perlacemifor2; ?> (Fixed for 2yr), then Rs. <?php echo $exactperlacemi; ?>
                            </td>
							 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php
							   
							   $emi_fixed =  $emi2ndn3rd * ($yr2nd * 12);
							   $leftTerm = $iciciprint_term - ($yr2nd * 12);
							   $emi_left = $actualemi * $leftTerm;
							   $totalEmi = $emi_fixed + $emi_left;
							   
						      //$iciciinterestfortwoyr= (($perlacemifortwo * 2) - $iciciloan_amount);

							   //$remingterm=$idbiterm - 2;
						     $icicigetinterestamt=($totalEmi - $viewLoanAmt);

							  $totalinterestamt= ($icicigetinterestamt);
							 echo floor($totalinterestamt);
						 ?></td>
                        </tr>
                    </table>
<?
//echo number_format($Loan_Amount)."\n".$roi."\n".$tenure."\n".$emiPerLac."\n".$processing_fee;
}

?>

