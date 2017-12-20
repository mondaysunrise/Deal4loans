<?php
    	
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


	$netSalary = $_REQUEST['netSalary'];
	$dob = $_REQUEST['dob'];
	$agecalc = $_REQUEST['agecalc'];


$dob = str_replace("-","", $dob);
$age = DetermineAgeFromDOB($dob);
//echo $age."<br>";
$exactage = $agecalc- $age;

//get inflation amount
$getinflation = $netSalary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $netSalary;
$getexactvaluemonthly = $getexactvalue/12;

echo "Rs. ".$getexactvaluemonthly."<font color='#FF0000' >*</font> Per month" ;		
?>
