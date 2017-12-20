<?php
	require 'scripts/db_init.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	$city = $_POST["city"];
	$full_name = $_POST["full_name"];
	$mobile = $_POST["mobile"];
	$cust_loan_amt = $_POST["loan_amt"];
	$cust_tenure = $_POST["tenure"];
	$occupation = $_POST["occupation"];
	$annual_income = $_POST["annual_income"];
	$current_experience = $_POST["current_experience"];
	$day = $_POST["day"];
	$month = $_POST["month"];
	$year = $_POST["year"];
	$DOB=$year."-".$month."-".$day;
	$strDOB = str_replace("-","", $DOB);
	$age = DetermineAgeFromDOB($strDOB);
	//$age = $_POST["age"];
	$total_experience = $_POST["total_experience"];
	$car_manufacturer = $_POST["fm_category_id"];
	$car_model = $_POST["fm_subcategory"];
	$reference_code = $_POST["reference_code"];
	$activation_code= $_POST["activation_code"];
	$icici_company_name =$_POST["company_name"];

if($reference_code==$activation_code)
		{	$is_valid=1;}
else
		{ $is_valid=0;}

	$Dated = ExactServerdate();
	$dataArray = array('icici_name'=>$full_name, 'icici_mobile'=>$mobile, 'icici_city'=>$city, 'icici_occupation'=>$occupation, 'icici_annual_income'=>$annual_income, 'icici_current_experience'=>$current_experience, 'icici_total_experience'=>$total_experience, 'icici_age'=>$age, 'icici_car_manufacturer'=>$car_manufacturer, 'icici_car_model'=>$car_model, 'icici_is_valid'=>$is_valid, 'icici_dated'=>$Dated, 'icici_company_name'=>$icici_company_name, 'icici_dob'=>$DOB);
	$insert = Maininsertfunc ("icici_car_loan_calc", $dataArray);

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

list($carowCount,$carow)=MainselectfuncNew($caqry,$array = array());
$carowcontr=count($carow)-1;
$car_price_category = $carow[$carowcontr]["car_price_category"];
/*echo "cpc ".$car_price_category;
echo "<br>";*/
$car_loan_category = $carow[$carowcontr]["car_loan_category"];
/*echo "clc ".$car_loan_category;
echo "<br>";*/
$car_price = $carow[$carowcontr]["car_loan_price"];
//echo "cp: ".$car_price;
//echo "<br>";
	}

	if(strlen($city)>0)
	{
		$clsqry='Select * from  car_loan_state_category where (car_state="'.$city.'")';
			
		list($clsrowCount,$clsrow)=MainselectfuncNew($caqry,$array = array());
		$clsrowcontr=count($clsrow)-1;

		$rate_flag = $clsrow[$clsrowcontr]["rate_flag"];
		$car_state_category = $clsrow[$clsrowcontr]["car_state_category"];
	}	

	if((($age<23 || $age>59 ) && $occupation==1) || (($age<28 || $age>64 ) && $occupation==2))
	{
		echo "Not Eligible bcoz of Age issue<br>";
	}
	else if($city=="Others")
	{
		echo "Not Eligible bcoz of City <br>";
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
				echo "Not Eligible bcoz of less experience<br>";
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

	/*if($cust_tenure>11 && ($cust_tenure<=$dobterm))
	{
		if($car_loan_category=="Cat 3")
		{   
			if($cust_tenure>=60)
			{$term=48;}
			else
			{$term=$cust_tenure; }
			if($term==12) { $print_term=1;}
			if($term==24) { $print_term=2;}
			if($term==36) { $print_term=3;}
			if($term==48) { $print_term=4;}
			if($term==60) { $print_term=4;}
		}
		else
		{
			$term=$cust_tenure;
			if($term==12) { $print_term=1;}
			if($term==24) { $print_term=2;}
			if($term==36) { $print_term=3;}
			if($term==48) { $print_term=4;}
			if($term==60) { $print_term=5;}

		}
	
	}
	else
	{*/
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

		if(($occupation=1 && $annual_income>=200000 && $car_loan_category!='Cat 4') || ($occupation=2 && $annual_income>=175000 && $car_loan_category!='Cat 4') )
		{
			//echo "1: <br>";
			list($maxLoan_Amount,$processing_fee,$emiPerLac,$tenure,$roi,$Loan_Amount)=icicicarloan_func ($car_price_category,$rate_flag, $car_state_category,$car_loan_category,$occupation,$annual_income,$car_price,$term);
		}
		else if(($occupation=1 && $annual_income>=2000000 && $car_loan_category=='Cat 4') || ($occupation=2 && $annual_income>=350000 && $car_loan_category=='Cat 4'))
		{ 
						echo "2: <br>";
             list($maxLoan_Amount,$processing_fee,$emiPerLac,$tenure,$roi,$Loan_Amount)=icicicarloan_func ($car_price_category,$rate_flag, $car_state_category,$car_loan_category,$occupation,$annual_income,$car_price,$term);
		}
		else
		{
			echo "Not Eligible";
		}
	}
	else if ($car_state_category=='Cat II' )
	{
		//echo "CAt || PART :";

		if(($occupation=1 && $annual_income>=250000 && $car_loan_category!='Cat 4') || ($occupation=2 && $annual_income>=200000 && $car_loan_category!='Cat 4'))
		{
					//echo "1: <br>";
			list($maxLoan_Amount,$processing_fee,$emiPerLac,$tenure,$roi,$Loan_Amount)=icicicarloan_func ($car_price_category,$rate_flag, $car_state_category,$car_loan_category,$occupation,$annual_income,$car_price,$term);
		}
		else if(($occupation=1 && $annual_income>=2000000 && $car_loan_category=='Cat 4') || ($occupation=2 && $annual_income>=350000 && $car_loan_category=='Cat 4'))
		{
						//echo "2: <br>";
             list($maxLoan_Amount,$processing_fee,$emiPerLac,$tenure,$roi,$Loan_Amount)=icicicarloan_func ($car_price_category,$rate_flag, $car_state_category,$car_loan_category,$occupation,$annual_income,$car_price,$term);
		}
		else
		{
			echo "Not Eligible";
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
				$getprint="Not eligible";
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
				$inter = 14.25;
				$interest = $inter / 1200;
				$roi = "14.25%";
				
			}
			else if ($tenure>=24 && $tenure<36)
			{
				$inter = 12.25;
				$interest = $inter / 1200;
				$roi = "12.25%";
			}
			else if ($tenure>=36 && $tenure<60)
			{
				$inter = 10;
				$interest = $inter / 1200;
				$roi = "10%";
			}
			else
			{
				$inter = 10;
				$interest = $inter / 1200;
				$roi = "10%";
			}
		}
	else if($car_price_category =='A')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
					
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.25;
					$interest = $inter / 1200;
					$roi = "12.25%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 10.25;
					$interest = $inter / 1200;
					$roi = "10.25%";
				}
				else
				{
					$inter = 10.25;
					$interest = $inter / 1200;
					$roi = "10.25%";
				}
		}
		else if($car_price_category =='B+' )
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.50;
					$interest = $inter / 1200;
					$roi = "12.50%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 10.50;
					$interest = $inter / 1200;
					$roi = "10.50%";
				}
				else
				{
					$inter = 10.50;
					$interest = $inter / 1200;
					$roi = "10.50%";
				}
		}
		
		else if($car_price_category =='B')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.50;
					$interest = $inter / 1200;
					$roi = "12.50%";
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
		else if($car_price_category =='C')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.25;
					$interest = $inter / 1200;
					$roi = "13.25%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11.75;
					$interest = $inter / 1200;
					$roi = "11.75%";
				}
				else
				{
					$inter = 11.75;
					$interest = $inter / 1200;
					$roi = "11.75%";
				}
		}
	}
	else
	{
		if($car_price_category =='A+')
		{
			if($tenure>=12 && $tenure<24)
			{
				$inter = 14.75;
				$interest = $inter / 1200;
				$roi = "14.75%";
				
			}
			else if ($tenure>=24 && $tenure<36)
			{
				$inter = 12.75;
				$interest = $inter / 1200;
				$roi = "12.75%";
			}
			else if ($tenure>=36 && $tenure<60)
			{
				$inter = 10.50;
				$interest = $inter / 1200;
				$roi = "10.50%";
			}
			else
			{
				$inter = 10.50;
				$interest = $inter / 1200;
				$roi = "10.50%";
			}
		}
	else if($car_price_category =='A')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.75;
					$interest = $inter / 1200;
					$roi = "14.75%";
					
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.75;
					$interest = $inter / 1200;
					$roi = "12.75%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 10.75;
					$interest = $inter / 1200;
					$roi = "10.75%";
				}
				else
				{
					$inter = 10.75;
					$interest = $inter / 1200;
					$roi = "10.75%";
				}
		}
		else if($car_price_category =='B+')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.75;
					$interest = $inter / 1200;
					$roi = "14.75%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.50;
					$interest = $inter / 1200;
					$roi = "13%";
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
		
		else if($car_price_category =='B')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.75;
					$interest = $inter / 1200;
					$roi = "14.75%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13;
					$interest = $inter / 1200;
					$roi = "13%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11.75;
					$interest = $inter / 1200;
					$roi = "11.75%";
				}
				else
				{
					$inter = 11.75;
					$interest = $inter / 1200;
					$roi = "11.75%";
				}
		}
		else if($car_price_category =='C')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.7;
					$interest = $inter / 1200;
					$roi = "14.75%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.75;
					$interest = $inter / 1200;
					$roi = "13.75%";
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


$emiPerLac = round($Loan_Amount * $interest / (1 - (pow(1/(1 + $interest), $tenure))));

if(strlen($Loan_Amount)>0)
	{

//echo " <b>Loan AMount: </b> ".round($Loan_Amount)."  <b>Rates:</b>  ".$roi." <b>Tenure:</b>  ".$tenure." <b>EMI</b> ".$emiPerLac."  <b>Processing fee:</b>  ".$processing_fee;
	}
	else
	{
		echo "Not Eligible";
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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ICICI Car Loan -Deal4loans</title>
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
<!--<link rel="stylesheet" href="../demos.css">-->
		<Script Language="JavaScript">
var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function insertData()
		{
		
		
			var get_loan_amt = document.getElementById('amount').value;
			var get_tenure = document.getElementById('amount1').value;
			var get_roi= document.getElementById('get_roi').value;
			var get_cpc= document.getElementById('get_cpc').value;
			var get_rf= document.getElementById('get_rf').value;
			
			var queryString = "?get_loan_amt=" + get_loan_amt +"&get_tenure=" + get_tenure + "&get_roi=" + get_roi + "&get_cpc=" + get_cpc + "&get_rf=" + get_rf;
			//alert(queryString); 
			ajaxRequestMain.open("GET", "get_icici_cl_calc.php" + queryString, true);
				// Create a function that will receive data sent from the server
			ajaxRequestMain.onreadystatechange = function(){
					if(ajaxRequestMain.readyState == 4)
					{
						
						//alert(ajaxRequestMain.responseText);
						document.getElementById('new_activate').value=ajaxRequestMain.responseText;
						//alert(document.getElementById('Activate').value);
					}
				}

				ajaxRequestMain.send(null); 
		}

	window.onload = ajaxFunctionMain;
	
</script>
	<script>
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: <? echo $maxLoan_Amount; ?>,
			min: 100000,
			step: 1000,
			max:  <? echo $maxLoan_Amount; ?>,
			slide: function( event, ui ) {
				$( "#amount" ).val( "" + ui.value );
			}
		});
		$( "#amount" ).val( "" + $( "#slider-range-min" ).slider( "value" ) );
	});
	</script>

	<script>
	$(function() {
		$( "#slider-range-min1" ).slider({
			range: "min",
			value: <? echo $tenure; ?>,
			step: 12,
			min: 12,
			max: <? echo $maxTenure; ?>,
			slide: function( event, ui ) {
				$( "#amount1" ).val( "" + ui.value );
			}
		});
		$( "#amount1" ).val( "" + $( "#slider-range-min1" ) .slider( "value" ) );
	});



	</script>


</head>
<body valign="top" align="center">
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><form name="icici_form" action="icici_carloan_func.php" onSubmit="return submitform(document.icici_form);" method="post">
<input type="hidden" name="get_roi" id="get_roi" value="<? echo $roi; ?>">
<input type="hidden" name="get_rf" id="get_rf" value="<? echo $rate_flag; ?>">

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
<!--<div class="demo">-->
<div style=" font-size:14px; font-weight:bold; border:1px dashed #993300; padding:2px; color:#993300; text-align:center; "> <label> Car Price: <? echo "Rs ".$car_price; ?></label> </div>
 
<table width="500" cellpadding="0" border="0">
 <tr>
   <td height="30">&nbsp;</td>
   <td width="56%" align="right" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="39%" align="left"> Loan Amount:</td>
       <td width="61%" align="right"><input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold; width:60px;" /></td>
     </tr>
   </table></td>
   <td align="left" style="font-size:9px; "></td>
 </tr>
 <tr><td width="24%">&nbsp;</td><td>
<div id="slider-range-min" onClick="insertData();"></div>
</td><td width="20%" align="right">&nbsp;</td></tr>
 <tr>
   <td>&nbsp;</td>
   <td align="left" style="font-size:9px; ">Min Rs.100000</td>
   <td align="left" style="font-size:9px; ">Max  <? echo $maxLoan_Amount; ?></td>
 </tr>

 
 <tr>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td align="right">&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="39%" align="left"> Tenure:</td>
      <td width="61%" align="right"><input type="text" id="amount1" style="border:0; color:#f6931f; font-weight:bold; width:25px;" /></td>
    </tr>
  </table></td>
  <td align="right">&nbsp;</td>
</tr>
<tr><td width="24%">&nbsp;</td><td>
<div id="slider-range-min1" onClick="insertData();"></div>
</td><td width="20%" align="right">&nbsp;</td></tr>
<tr>
  <td>&nbsp;</td>
  <td align="left" style="font-size:9px; ">Min 12 Months</td>
  <td align="left" style="font-size:9px; ">Max <? echo $maxTenure; ?>(Months)</td>
</tr>
</table>
<table width="500"  border="0">
<tr>
<td align="center">
<table width="200" height="150" align="center">
<tr>
<td height="100%"><textarea cols="15" rows="10" style="border:0; color:#f6931f; font-weight:bold; overflow: auto; font-size:13px;"  readonly >
Loan Amount
ROI
Tenure(Months)
EMI
Processing Fee
</textarea>
</td>
<td height="100%" align="center">
<textarea name="new_activate" id="new_activate" cols="10" rows="10" style="border:0; color:#f6931f; font-weight:bold; overflow: auto;  font-size:13px;"  readonly ><? echo $Loan_Amount."\n";?><? echo $roi."\n";?><? echo $tenure."\n";?><? echo $emiPerLac."\n";?><? echo $processing_fee."\n";?></textarea>
</td>
	</tr>

<!--<tr><td colspan="5">
	<textarea name="new_activate" id="new_activate" cols="10" rows="2" style="border:0; color:#f6931f; font-weight:bold; width:500px;"  readonly ></textarea>
	</td></tr>-->
</table>


</form></td>
  </tr>
</table>

 

</body>
</html>