<? 


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


function getdob($DOB)
{
	if($DOB<=40 )
		{
			//echo $DOB;
			$term = 240;
			$print_term = "20";
		}
		else if($DOB>40 && $DOB<=45)
		{
			$term = 180;
			$print_term = "15";
		}
		else if($DOB>45 && $DOB<=50)
		{
			$term = 120;
			$print_term = "10";
		}
		else if($DOB>50 && $DOB<=55)
		{
			$term = 60;
			$print_term = "5";
		}
		else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
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


Function  federal_Homeloan($netAmount,$DOB,$obligations,$property_value)
{

	list($term,$print_term)=getdob($DOB);
	
	$applicableFOIR = round($netAmount * 70 / 100)	;
	
		$inter=10.20;
		$interest=10.20/1200;
		$princ=100000;
$emicalc=round($princ * $interest / (1 - (pow(1/(1 + $interest), $term))));

		$loanPossible= ($applicableFOIR - $obligations)/$emicalc;
		
		$viewLoanAmt = round($loanPossible * 100000);
		$loan_amount = $viewLoanAmt ;
		

if($property_value>1)
	{
		$getproperty_value= $property_value * (.85);

		if($loan_amount>$getproperty_value)
		{
			$loan_amount=$getproperty_value;
		}
		else
		{
			$loan_amount=$loan_amount;
		}
		
	}
$inter=10.20;
$interest=10.20/1200;

	$actualemi = round($loan_amount * $interest / (1 - (pow(1/(1 + $interest),$term))),2);
	$emi = $actualemi;
	$perlacemi = round(100000 * $interest / (1 - (pow(1/(1 + $interest),$term))),2);

$federalinter="".abs($inter)."";
$idbiperlac=abs($perlacemi);

	$details[]= $emi;
	$details[] = $federalinter;
	$details[] = $print_term;
	$details[] = $loan_amount;

return($details);
}//federal

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
//print_r($_POST);

$annual_salary = $_POST["annual_salary"];
$getnetAmount = $annual_salary/12;
$property_value = $_POST["property_value"];
$obligation = $_POST["obligation"];
$day = $_POST["day"];
$month = $_POST["month"];
$year = $_POST["year"];
$dateofbirth =  $year."-".$month."-".$day;
$DOB = str_replace("-","", $dateofbirth);
$age = DetermineAgeFromDOB($DOB);


list($federalemi,$federalinter,$federalterm,$federalloanamt) = federal_Homeloan($getnetAmount,$age,$obligation,$property_value);




}
?>
<html>
<body>
<form name="federal_calc" action="<? echo $_SERVER['PHP_SELF'] ?>" method="post">
	<table align="center" cellpadding="8" cellspacing="0">
    <tr><td colspan="2" align="center"> Federal Calculation</td></tr>
        <tr><td>DOB</td><td><input type="text" name="day" id="day" size="3" maxlength="2"> / <input type="text" name="month" id="month" size="3" maxlength="2"> / <input type="text" name="year" id="year" size="4" maxlength="4"></td></tr>
    	<tr><td>Annual Salary</td><td><input type="text" name="annual_salary" id="annual_salary"></td></tr>
        <tr><td>Property Value</td><td><input type="text" name="property_value" id="property_value"></td></tr>
        <tr><td>Obligation</td><td><input type="" name="obligation" id="obligation"></td></tr>
        <tr><td align="center" colspan="2"><input type="submit" name="submit" value="submit"></td></tr>
	</table>
    </form>

<? if($_SERVER['REQUEST_METHOD'] == 'POST')
{ 
	
	echo "Loan Amount: ".$federalloanamt." <br><br>interest Rate: ".$federalinter."<br><br>EMI: ".$federalemi."<br> <br>term: ".$federalterm;
} ?>
</body>
</html>