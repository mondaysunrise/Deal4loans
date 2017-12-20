<?php
	require 'scripts/db_init.php';
	
	print_r($_POST);
echo $icici_clid = $_REQUEST["icici_clid"];
echo "hello".$icici_clid."<br>";
$icici_clquery="Select * From icici_car_loan_calc Where (icici_clid ='".$icici_clid."')";

 list($recordcount,$row)=MainselectfuncNew($icici_clquery,$array = array());
		$cntr=0;
		
		
//$result = ExecQuery($icici_clquery);
//$row=mysql_fetch_array($result);

	$city = $row[$cntr]["icici_city"];
	$full_name = $row[$cntr]["icici_name"];
	$mobile = $row[$cntr]["icici_mobile"];
	$occupation = $row[$cntr]["icici_occupation"];
	$annual_income = $row[$cntr]["icici_annual_income"];
	$current_experience = $row[$cntr]["icici_current_experience"];
	$DOB= $row[$cntr]["icici_dob"];
	$strDOB = str_replace("-","", $DOB);
	$age = DetermineAgeFromDOB($strDOB);
	$total_experience = $row[$cntr]["icici_total_experience"];
	$car_manufacturer = $row[$cntr]["icici_car_manufacturer"];
	$car_model = $row[$cntr]["icici_car_model"];
	$icici_company_name =$row[$cntr]["icici_company_name"];

if(strlen($car_manufacturer)>0 && strlen($car_model)>0 && strlen($city)>0 && strlen($occupation)>0)
{

//echo $icici_clquery;
//echo "<br>";

/*echo "occu: ".$occupation."<br>"; 
echo 	"AI: ".$annual_income."<br>";
echo "CE".$current_experience."<br>"; 
echo 	"age: ".$age."<br>"; 
echo	"TE: ".$total_experience."<br>";
echo 	"CM: ".$car_manufacturer."<br>";
echo	"CMo: ".$car_model."<br>";*/

if(($car_manufacturer)>0 && strlen($car_model)>0)
		{
$caqry='Select * from car_company_category where (CategoryID="'.$car_manufacturer.'" and car_model="'.$car_model.'")';
	//echo $caqry."<br>";

 list($recordcount,$carow)=MainselectfuncNew($caqry,$array = array());
		$j=0;
	//$caresult=ExecQuery($caqry);
//$carow=mysql_fetch_array($caresult);
$car_price_category = $carow[$j]["car_price_category"];
//echo "cpc ".$car_price_category;
//echo "<br>";
$car_loan_category = $carow[$j]["car_loan_category"];
//echo "clc ".$car_loan_category;
//echo "<br>";
$car_price = $carow[$j]["car_loan_price"];
//echo "cp: ".$car_price;
//echo "<br>";
	}

if(strlen($city)>0)
	{
		$clsqry='Select * from  car_loan_state_category where (car_state="'.$city.'")';
		//echo $clsqry."<br>";
		 list($recordcount,$clsrow)=MainselectfuncNew($clsqry,$array = array());
		$k=0;
		//$clsresult=ExecQuery($clsqry);
		//$clsrow=mysql_fetch_array($clsresult);
	$rate_flag = $clsrow[$k]["rate_flag"];
	 $car_state_category = $clsrow[$k]["car_state_category"];
		
	}	

if((($age<23 || $age>59 ) && $occupation==1) || (($age<28 || $age>64 ) && $occupation==2))
		{
			//echo "Not Eligible bcoz of Age issue<br>";
		}
		else if($city=="Others")
		{
			//echo "Not Eligible bcoz of City <br>";
		}
		else
		{
			
	if(($occupation==1 && $total_experience>2 && $current_experience>=1) || ($occupation==2 && $total_experience>=3 && $current_experience>=2))
			{
		list($maxTenure,$maxLoan_Amount,$processing_fee,$emiPerLac,$tenure,$roi,$Loan_Amount)=ICICI_Bsc_chck($age,$car_price_category,$car_price,$car_loan_category,$annual_income,$rate_flag,$car_state_category,$occupation);

//echo "PE: ".$processing_fee." EMI: ".$emiPerLac." tenure: ".$tenure." roi ".$roi." lA: ".$Loan_Amount;
		}
		else
			{
				//echo "Not Eligible bcoz of less experience<br>";
			}
		
	}
	}

function getdob($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18))
		{
			$term = 60;
			$print_term = "5";
		}
	else if(($DOB>50 && $DOB<=54))
		{
			$term = 60;
			$print_term = "5";
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

function ICICI_Bsc_chck($DOB,$car_price_category,$car_price,$car_loan_category,$annual_income,$rate_flag,$car_state_category,$occupation)
{
   	list($dobterm,$dobprint_term)=getdob($DOB);

		if($car_loan_category=="Cat 3")
		{   
			if($dobterm>=60)
			{$term=48;}
			else
			{$term=$dobterm; }
			if($term==12) { $print_term=1;}
			if($term==24) { $print_term=2;}
			if($term==36) { $print_term=3;}
			if($term==48) { $print_term=4;}
			if($term==60) { $print_term=4;}
		}
		else
		{
		$term=$dobterm;
		if($term==12) { $print_term=1;}
		if($term==24) { $print_term=2;}
		if($term==36) { $print_term=3;}
		if($term==48) { $print_term=4;}
		if($term==60) { $print_term=5;}
		}
	//}


	if($car_state_category=='Cat I')
	{
		//echo "CAt | PART :";

		if(($occupation==1 && $annual_income>=200000 && $car_loan_category!='Cat 4') || ($occupation==2 && $annual_income>=175000 && $car_loan_category!='Cat 4') )
		{
			//echo "1: <br>";
			list($maxLoan_Amount,$processing_fee,$emiPerLac,$tenure,$roi,$Loan_Amount)=icicicarloan_func ($car_price_category,$rate_flag, $car_state_category,$car_loan_category,$occupation,$annual_income,$car_price,$term);
		}
		else if(($occupation==1 && $annual_income>=2000000 && $car_loan_category=='Cat 4') || ($occupation==2 && $annual_income>=350000 && $car_loan_category=='Cat 4'))
		{ 
						//echo "2: <br>";
             list($maxLoan_Amount,$processing_fee,$emiPerLac,$tenure,$roi,$Loan_Amount)=icicicarloan_func ($car_price_category,$rate_flag, $car_state_category,$car_loan_category,$occupation,$annual_income,$car_price,$term);
		}
		else
		{
			//echo "Not Eligible";
		}
	}
	else if ($car_state_category=='Cat II' )
	{
		//echo "CAt || PART :";

		if(($occupation==1 && $annual_income>=250000 && $car_loan_category!='Cat 4') || ($occupation==2 && $annual_income>=200000 && $car_loan_category!='Cat 4'))
		{
					//echo "1: <br>";
			list($maxLoan_Amount,$processing_fee,$emiPerLac,$tenure,$roi,$Loan_Amount)=icicicarloan_func ($car_price_category,$rate_flag, $car_state_category,$car_loan_category,$occupation,$annual_income,$car_price,$term);
		}
		else if(($occupation==1 && $annual_income>=2000000 && $car_loan_category=='Cat 4') || ($occupation==2 && $annual_income>=350000 && $car_loan_category=='Cat 4'))
		{
						//echo "2: <br>";
             list($maxLoan_Amount,$processing_fee,$emiPerLac,$tenure,$roi,$Loan_Amount)=icicicarloan_func ($car_price_category,$rate_flag, $car_state_category,$car_loan_category,$occupation,$annual_income,$car_price,$term);
		}
		else
		{
			//echo "Not Eligible";
		}

	}

	$details[]= $dobterm;
	$details[]= $maxLoan_Amount;
	$details[]= $processing_fee;
	$details[]= $emiPerLac;
	$details[]= $tenure;
	$details[]= $roi;
	$details[]= $Loan_Amount;
	return($details);
		
}

Function icicicarloan_func($car_price_category,$rate_flag, $car_state_category,$car_loan_category,$occupation,$annual_income,$car_price,$tenure)
{
if($car_loan_category=="Cat 1" &&  $car_state_category=="Cat I")
	{
		$Loan_Amount = $car_price * .85;
	}
else if($car_loan_category=="Cat 1" &&  $car_state_category=="Cat II")
	{
		$Loan_Amount = $car_price * .80;
	}
else if($car_loan_category=="Cat 2" &&  $car_state_category=="Cat I")
	{
		$Loan_Amount = $car_price * .80;
	}
else if($car_loan_category=="Cat 2" &&  $car_state_category=="Cat II")
	{
			$Loan_Amount = $car_price * .75;
	}
else if($car_loan_category=="Cat 3" &&  $car_state_category=="Cat I" && $tenure<=48)
	{
		$Loan_Amount = $car_price * .70;
	}
else if($car_loan_category=="Cat 3" &&  $car_state_category=="Cat II" && $tenure<=48)
	{
		$Loan_Amount = $car_price * .65;
	}
	
else if($car_loan_category=="Cat 4" && $tenure<=36)
	{

		$fLoan_Amount = $car_price * .85;
		
		if($fLoan_Amount<=2500000)
		{
			if($annual_income>=2000000)
			{
				$Loan_Amount=$fLoan_Amount;
			}
			else
			{
				//$getprint="Not eligible";
			}
		}
		else if($fLoan_Amount>2500000 && $fLoan_Amount<=4000000)
		{
			$fLoan_Amount = $car_price * .85;
			if($annual_income>=3000000)
			{
				$Loan_Amount=$fLoan_Amount;
			}
			else
			{
				$Loan_Amount="2500000";
			}

		}
		else if($fLoan_Amount>4000000 )
		{
			$fLoan_Amount = $car_price * .85;
			if($annual_income>=4000000)
			{
				$Loan_Amount=$fLoan_Amount;
			}
			else
			{
				$Loan_Amount="4000000";
			}

		}
else
		{
			$getprint="Not eligible";
		}

	}
else if($car_loan_category=="Cat 4" &&  ($tenure>36 && $tenure<=60))
	{
		$fLoan_Amount = $car_price * .80;
		if($fLoan_Amount<=2500000)
		{
			if($annual_income>=2000000)
			{
				$Loan_Amount=$fLoan_Amount;
			}
			else
			{
				$getprint="Not eligible";
			}
		}
		else if($fLoan_Amount>2500000 && $fLoan_Amount<=4000000)
		{
			$fLoan_Amount = $car_price * .80;
			if($annual_income>=3000000)
			{
				$Loan_Amount=$fLoan_Amount;
			}
			else
			{
				$Loan_Amount="2500000";
			}

		}
		else if($fLoan_Amount>4000000 )
		{
			$fLoan_Amount = $car_price * .80;
			if($annual_income>=4000000)
			{
				$Loan_Amount=$fLoan_Amount;
			}
			else
			{
				$Loan_Amount="4000000";
			}

		}
else
		{
			$getprint="Not eligible";
		}
	}


//Calculate the ROI
if($rate_flag==1)
	{
	if($car_price_category =='A+' )
		{
			if($tenure>=12 && $tenure<24)
			{
				$inter = 15.25;
				$interest = $inter / 1200;
				$roi = "15.25%";
				
			}
			else if ($tenure>=24 && $tenure<36)
			{
				$inter = 13.25;
				$interest = $inter / 1200;
				$roi = "13.25%";
			}
			else if ($tenure>=36 && $tenure<60)
			{
				$inter = 11;
				$interest = $inter / 1200;
				$roi = "11%";
			}
			else
			{
				$inter = 10;
				$interest = $inter / 1200;
				$roi = "11%";
			}
		}

	else if($car_price_category =='A')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 15.25;
					$interest = $inter / 1200;
					$roi = "15.25%";
					
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.25;
					$interest = $inter / 1200;
					$roi = "13.25%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11.25;
					$interest = $inter / 1200;
					$roi = "11.25%";
				}
				else
				{
					$inter = 11.25;
					$interest = $inter / 1200;
					$roi = "11.25%";
				}
		}

		else if($car_price_category =='B+' )
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 15.25;
					$interest = $inter / 1200;
					$roi = "15.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.50;
					$interest = $inter / 1200;
					$roi = "13.50%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11.50;
					$interest = $inter / 1200;
					$roi = "11.50%";
				}
				else
				{
					$inter = 11.50;
					$interest = $inter / 1200;
					$roi = "11.50%";
				}
		}
	
		else if($car_price_category =='B')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 15.25;
					$interest = $inter / 1200;
					$roi = "15.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.50;
					$interest = $inter / 1200;
					$roi = "13.50%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 12.25;
					$interest = $inter / 1200;
					$roi = "12.25%";
				}
				else
				{
					$inter = 12.25;
					$interest = $inter / 1200;
					$roi = "12.25%";
				}
		}
	
		else if($car_price_category =='C')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 15.25;
					$interest = $inter / 1200;
					$roi = "15.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 12.75;
					$interest = $inter / 1200;
					$roi = "12.75%";
				}
				else
				{
					$inter = 12.75;
					$interest = $inter / 1200;
					$roi = "12.75%";
				}
		}
	}
	else
	{
	
		if($car_price_category =='A+')
		{
			if($tenure>=12 && $tenure<24)
			{
				$inter = 15.25;
				$interest = $inter / 1200;
				$roi = "15.25%";
				
			}
			else if ($tenure>=24 && $tenure<36)
			{
				$inter = 13.25;
				$interest = $inter / 1200;
				$roi = "13.25%";
			}
			else if ($tenure>=36 && $tenure<60)
			{
				$inter = 11;
				$interest = $inter / 1200;
				$roi = "11%";
			}
			else
			{
				$inter = 11;
				$interest = $inter / 1200;
				$roi = "11%";
			}
		}
	
	else if($car_price_category =='A')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 15.25;
					$interest = $inter / 1200;
					$roi = "15.25%";
					
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.25;
					$interest = $inter / 1200;
					$roi = "13.25%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11.25;
					$interest = $inter / 1200;
					$roi = "11.25%";
				}
				else
				{
					$inter = 11.25;
					$interest = $inter / 1200;
					$roi = "11.25%";
				}
		}
		else if($car_price_category =='B+')
	
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 15.25;
					$interest = $inter / 1200;
					$roi = "15.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.50;
					$interest = $inter / 1200;
					$roi = "13.50%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11.50;
					$interest = $inter / 1200;
					$roi = "11.50%";
				}
				else
				{
					$inter = 11.50;
					$interest = $inter / 1200;
					$roi = "11.50%";
				}
		}
		else if($car_price_category =='B')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 15.25;
					$interest = $inter / 1200;
					$roi = "15.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.50;
					$interest = $inter / 1200;
					$roi = "13.50%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 12.25;
					$interest = $inter / 1200;
					$roi = "12.25%";
				}
				else
				{
					$inter = 12.25;
					$interest = $inter / 1200;
					$roi = "12.25%";
				}
		}
	
		else if($car_price_category =='C')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 15.25;
					$interest = $inter / 1200;
					$roi = "15.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 12.75;
					$interest = $inter / 1200;
					$roi = "12.75%";
				}
				else
				{
					$inter = 12.75;
					$interest = $inter / 1200;
					$roi = "12.75%";
				}
		}

	}

	
//Calculate the ROI FInish
/*if($Loan_Amount > $cust_loan_amt)
	{
			$Loan_Amount=$cust_loan_amt;
	}
	else
	{
		$Loan_Amount=$Loan_Amount;
	}
*/

if($Loan_Amount<=250000)
	{
		$processing_fee=2500;
	}
	else if($Loan_Amount>250000 && $Loan_Amount<=500000)
	{
		$processing_fee=3100;
	}
	else if($Loan_Amount>500000 && $Loan_Amount<=1000000)
	{
		$processing_fee=4000;
	}
	else if($Loan_Amount>1000000)
	{
		$processing_fee=5000;
	}
	else
	{	
		$processing_fee=5000;
	}


$emiPerLac = @round($Loan_Amount * $interest / (1 - (pow(1/(1 + $interest), $tenure))));

if(strlen($Loan_Amount)>0)
	{

//echo " <b>Loan AMount: </b> ".round($Loan_Amount)."  <b>Rates:</b>  ".$roi." <b>Tenure:</b>  ".$tenure." <b>EMI</b> ".$emiPerLac."  <b>Processing fee:</b>  ".$processing_fee;
	}
	else
	{
		//echo "Not Eligible";
	}

$maxLoan_Amount=$Loan_Amount;

	$details[]= round($maxLoan_Amount);
	$details[]= $processing_fee;
	$details[]= $emiPerLac;
	$details[]= $tenure;
	$details[]= $roi;
	$details[]= round($Loan_Amount);
	return($details);
}


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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
</head>

<body>
<table width="850" border="0" cellspacing="0" cellpadding="0">
 <!--D4l Here-->
<? if($maxLoan_Amount>0)
{

?>
 <tr>
 <td width="626" align="center" valign="top" background="icici_car/calc-bg1.gif" style="background-repeat:no-repeat;    height:180px; background-position: top;">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		 
  <tr>
    <td><form name="icici_form" action="icici_carloan_func.php" onSubmit="return submitform(document.icici_form);" method="post">
<input type="hidden" name="get_roi" id="get_roi" value="<? echo $roi; ?>">
<input type="hidden" name="get_rf" id="get_rf" value="<? echo $rate_flag; ?>">
<input type="hidden" name="get_carprice" id="get_carprice" value="<? echo $car_price; ?>">

<? if($car_price_category=="A+")
{
	$get_cpc=1;
}
if($car_price_category=="A")
{
	$get_cpc=2;
}
if($car_price_category=="B+")
{
	$get_cpc=3;
}
if($car_price_category=="B")
{
	$get_cpc=4;
}
if($car_price_category=="C")
{
	$get_cpc=5;
}

?>
<input type="hidden" name="get_cpc" id="get_cpc" value="<? echo $get_cpc; ?>">

<table width="100%" cellpadding="0" border="0">
 <tr>
   <td height="30">&nbsp;</td>
   <td width="57%" align="right" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td align="left" >&nbsp;</td>
       <td align="right">&nbsp;</td>
     </tr>
     <tr>
       <td width="62%" align="left"  class="verdred13"> Eligible Loan Amount:</td>
       <td width="37%" align="right"><input type="text" id="amount" style="border:0px; width:65px;" class="verdred13" /></td>
     </tr>
   </table></td>
   <td align="left" style="font-size:9px; "></td>
 </tr>
 <tr><td width="19%"></td><td height="15">
<div id="slider-range-min" onClick="newcomplete_div();" onChange="newcomplete_div();" onMouseUp="newcomplete_div();"></div>
</td><td width="24%" align="right"></td></tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="2" align="left" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="57%" class="verdblk9"><b>Min:</b> Rs.100000</td>
       <td width="43%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b "><b>Max:</b> <? echo $maxLoan_Amount; ?></td>
     </tr>
   </table></td>
   </tr>
<tr>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td align="right">&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><table width="93%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="70%" align="left"  class="verdred13"> Tenure in month:</td>
      <td width="29%" align="right"><input type="text" id="amount1" style="border:0;width:25px;" class="verdred13"/></td>
    </tr>
  </table></td>
  <td align="right">&nbsp;</td>
</tr>
<tr><td width="19%">&nbsp;</td><td>
<div id="slider-range-min1" onClick="newcomplete_div();" onChange="newcomplete_div();" onMouseUp="newcomplete_div();"></div>
</td><td width="24%" align="right">&nbsp;</td></tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2" align="left" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif;  color:#5b5b5b "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="60%"  class="verdblk9"><b>Min:</b> 12 Months</td>
      <td width="40%"  class="verdblk9"><b>Max:</b> <? echo $maxTenure; ?>(Months)</td>
    </tr>
  </table></td>
  </tr>
</table>
</form></td></tr></table>
</td>
    <td width="328" align="center" valign="top"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#a41c2b; ">
	
</td>
  </tr>
		<!--D4l End-->
		<? }
	else
	{?>
	 <tr>
 <td width="626" align="center" valign="top">
	<table width="100%">
	<tr>
 <td align="left"  class="verdred13"> Dear Customer,<br>
Thanks for showing interest in Icici car Loans.
As per information provided by you, We cannot offer Car loan at this point of time as per our credit policy.</td>
 </tr></table>
 </td>
    <td width="328" align="center" valign="top"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#a41c2b; ">
	
</td>
  </tr>
	<? }?>
	 <tr>
    <td align="center" valign="top" colspan="2" height="10" ></td>
  </tr>
</table>
</td>
      </tr>
	  <? if($maxLoan_Amount>0)
{

?>
	  <tr>
	      <td height="71" colspan="2" align="center" background="icici_car/quote-bg.gif" style="background-repeat:no-repeat; background-position:center; ">
		  <div style=" float:left;" id="complete_div">
	<div style="position:absolute; z-index:100; margin-left:550px; top:110px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;   color:#a41c2b;">
	<div><b>PIE CHART</b></div><? $total_cost = ($emiPerLac*$tenure) + $processing_fee;
$total_interest = ($emiPerLac*$tenure) - $Loan_Amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;
$pfpercent= ($processing_fee / $total_cost) *100;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);
$pfper = substr($pfpercent, 0,3);

?>
	<!--<div id="p3d_activate">-->
<img src="http://chart.apis.google.com/chart?chs=250x100&cht=p3&chd=t:<? echo $lnpre; ?>,<? echo $inper; ?>,<? echo $pfper; ?>&chxt=x,y&chds=0,100&chxr=0,0,90|1,0,90&chxl=0:|<? echo $lnpre." %"; ?>|<? echo $inper." %"; ?>|<? echo $pfper." %"; ?>&chco=A2D7F6,F4E46C,A56119"/>
<div id="sign">
<ul style="margin:0px; ">
<li style=" background:url(icici_car/amount_sign.gif) no-repeat 0px 4px; ">Loan Amount -  <? echo "Rs. ".number_format($Loan_Amount);?></li>
<li style=" background:url(icici_car/interest_sign.gif) no-repeat 0px 4px;">Interest Rate - <? echo "Rs. ".number_format($total_interest); ?></li>
<li style=" background:url(icici_car/fee_sign.gif) no-repeat 0px 4px; ">Fees + Taxes - <? echo "Rs. ".$processing_fee;?></li>
</ul>
</div>
</div>
	  <table width="840" align="center"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" width="27%" height="30" class="verdbold12">Bank Name </td>
        <td align="center" width="15%" class="verdbold12">Total Cost </td>
        <td align="center" width="20%" class="verdbold12">Monthly Payment </td>
        <td align="center" width="17%" class="verdbold12">ROI </td>
        <td align="center" width="21%" class="verdbold12">Ex.showroom price</td>
      </tr>
	    </table>
		<!--<div id="new_activate_div" > -->
		
		  <table width="840" align="center"  border="0" cellspacing="0" cellpadding="0">
		  <tr >
        <td width="27%" height="35" align="center"  class="verdred12">ICICI Bank Car Loan </td>
        <td width="15%" align="center"   class="verdred12"><? echo "Rs. ".number_format($total_cost);?></td>
        <td width="20%" align="center"   class="verdred12"><? echo "Rs. ".number_format($emiPerLac);?></td>
        <td width="17%" align="center"   class="verdred12"><? echo $roi."\n";?></td>
        <td width="21%" align="center"   class="verdred12"><? echo "Rs. ".number_format($car_price);?></td>
      </tr>
		</table>
	  <!--</div>-->	</div>
          </td>
	  </tr>
	  <? } ?>
	  </table>
</body>
</html>
