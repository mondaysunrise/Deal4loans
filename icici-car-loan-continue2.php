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
	$data = array('icici_name'=>$full_name, 'icici_mobile'=>$mobile, 'icici_city'=>$city, 'icici_occupation'=>$occupation, 'icici_annual_income'=>$annual_income, 'icici_current_experience'=>$current_experience, 'icici_total_experience'=>$total_experience, 'icici_age'=>$age, 'icici_car_manufacturer'=>$car_manufacturer, 'icici_car_model'=>$car_model, 'icici_is_valid'=>$is_valid, 'icici_dated'=>$Dated, 'icici_company_name'=>$icici_company_name, 'icici_dob'=>$DOB);
	$table = 'icici_car_loan_calc';
	$insert = Maininsertfunc ($table, $dataInsert);


if(($car_manufacturer)>0 && strlen($car_model)>0)
		{
$caqry='Select * from car_company_category where (CategoryID="'.$car_manufacturer.'" and car_model="'.$car_model.'")';
list($cNumRows,$carow)=Mainselectfunc($caqry,$array = array());

$car_price_category = $carow["car_price_category"];
//echo "cpc ".$car_price_category;
//echo "<br>";
$car_loan_category = $carow["car_loan_category"];
//echo "clc ".$car_loan_category;
//echo "<br>";
$car_price = $carow["car_loan_price"];
//echo "cp: ".$car_price;
//echo "<br>";
	}

if(strlen($city)>0)
	{
		$clsqry='Select * from  car_loan_state_category where (car_state="'.$city.'")';
		list($cNumRows,$clsrow)=Mainselectfunc($clsqry,$array = array());
		$rate_flag = $clsrow["rate_flag"];
		$car_state_category = $clsrow["car_state_category"];
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

<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Car Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="icici_car/Functions.js"></script>
<script src="icici_car/AC_ActiveX.js" type="text/javascript"></script>
<script src="icici_car/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript" src="icici_car/Functions_002.js"></script>
<script language="javascript" src="icici_car/FormCheck.js"></script>
<script src="icici_car/Default.htm" type="text/javascript"></script>
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
	
		/*function insertData()
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
						//document.getElementById('new_activate').value=ajaxRequestMain.responseText;
						document.getElementById('new_activate_div').innerHTML=ajaxRequestMain.responseText;
						//alert(document.getElementById('Activate').value);
					}
				}

				ajaxRequestMain.send(null); 
				ajaxFunctionMainReq();
		}*/
/*
function insertloadpie()
		{
				
			var get_loan_amt = document.getElementById('amount').value;
			var get_tenure = document.getElementById('amount1').value;
			var get_roi= document.getElementById('get_roi').value;
			var get_cpc= document.getElementById('get_cpc').value;
			var get_rf= document.getElementById('get_rf').value;
			
			var queryString = "?get_loan_amt=" + get_loan_amt +"&get_tenure=" + get_tenure + "&get_roi=" + get_roi + "&get_cpc=" + get_cpc + "&get_rf=" + get_rf;
			//alert(queryString); 
			ajaxRequest.open("GET", "get_icici_cl_calc_pchart.php" + queryString, true);
				// Create a function that will receive data sent from the server
			ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						//alert(ajaxRequestMain.responseText);
						//document.getElementById('new_activate').value=ajaxRequestMain.responseText;
						document.getElementById('p3d_activate').innerHTML=ajaxRequest.responseText;
						//alert(document.getElementById('Activate').value);
					}
				}

				ajaxRequest.send(null); 
		}*/

/*function insertloadpie() {

			var get_loan_amt = document.getElementById('amount').value;
			var get_tenure = document.getElementById('amount1').value;
			var get_roi= document.getElementById('get_roi').value;
			var get_cpc= document.getElementById('get_cpc').value;
			var get_rf= document.getElementById('get_rf').value;
			
			var queryString = "?get_loan_amt=" + get_loan_amt +"&get_tenure=" + get_tenure + "&get_roi=" + get_roi + "&get_cpc=" + get_cpc + "&get_rf=" + get_rf;
			
  $('#p3d_activate').html('<p><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#p3d_activate').load("get_icici_cl_calc_pchart.php" + queryString);
}*/

function newcomplete_div()
{
	var get_loan_amt = document.getElementById('amount').value;
	var get_tenure = document.getElementById('amount1').value;
	var get_roi= document.getElementById('get_roi').value;
	var get_cpc= document.getElementById('get_cpc').value;
	var get_rf= document.getElementById('get_rf').value;
	var get_carprice= document.getElementById('get_carprice').value;
			
	var queryString = "?get_loan_amt=" + get_loan_amt +"&get_tenure=" + get_tenure + "&get_roi=" + get_roi + "&get_cpc=" + get_cpc + "&get_rf=" + get_rf + "&get_carprice=" + get_carprice;
			
  $('#complete_div').html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div').load("get_icici_cl_calc_pchart_new.php" + queryString);
}

window.onload = ajaxFunctionMain;
	
</script>
	<script>
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: <? echo $maxLoan_Amount; ?>,
			min: 100000,
			step: 10000,
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
			step: 6,
			min: 12,
			max: <? echo $maxTenure; ?>,
			slide: function( event, ui ) {
				$( "#amount1" ).val( "" + ui.value );
			}
		});
		$( "#amount1" ).val( "" + $( "#slider-range-min1" ) .slider( "value" ) );
	});

	</script>
</head><body>
<script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script><script src="icici_car/ga.js" type="text/javascript"></script>
<script type="text/javascript">
    try {
        var pageTracker = _gat._getTracker("UA-15256427-1");
        pageTracker._trackPageview();
    } catch (err) { }</script>
 
<table align="center" border="0" cellpadding="0" cellspacing="0" width="886">
  <tbody><tr>
    <td background="icici_car/main_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="872">
      <tbody><tr>
        <td><img src="icici_car/top_logo.gif" height="104" width="872"></td>
      </tr>
	  <tr>
        <td height="8"></td>
      </tr>
      <tr>
	  	  
        <td align="center" ><table width="850" border="0" cellspacing="0" cellpadding="0">
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
<!--<div class="demo">
<div style=" font-size:14px; font-weight:bold; border:1px dashed #993300; padding:2px; color:#993300; text-align:center; "> <label> Car Price: <? //echo "Rs ".$car_price; ?></label> </div>-->
 
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
<table width="100%"  border="0" align="center">
<tr>
<td align="center" style="text-align:center; ">
<!--<table  align="center">
<tr>
 <td align="center"><textarea cols="15"  style="border:0; color:#a41c2b; font-weight:bold; overflow: auto; font-size:12px; font-family:Verdana, arial, Helvetica, sans-serif; line-height:20px; height:120px;"  readonly >
Loan Amount
ROI
Tenure(Months)
EMI
Processing Fee
</textarea>
</td>
<td align="center">
<textarea name="new_activate" id="new_activate" cols="10" style="border:0; color:#a41c2b; font-weight:bold; overflow: auto; font-size:12px; font-family:Verdana, arial, Helvetica, sans-serif; line-height:20px;  height:120px;"  readonly >--><? //echo $Loan_Amount."\n";?><? //echo $roi."\n";?><? //echo $tenure."\n";?><? //echo $emiPerLac."\n";?><? //echo $processing_fee."\n";?></textarea>
<!--</td>
	</tr>
</table>-->
</td>
  </tr>
</table>
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
<!--</div>
<table width="98%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" height="22" align="center" valign="middle"><img src="icici_car/amount_sign.gif" width="13" height="13"></td>
    <td width="86%" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b ">Loan Amount </td>
  </tr>
  <tr>
    <td height="22" align="center" valign="middle"><img src="icici_car/interest_sign.gif" width="13" height="13"></td>
    <td width="86%" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b ">Interest Rate </td>
  </tr>
  <tr>
    <td height="22" align="center" valign="middle"><img src="icici_car/fee_sign.gif" width="13" height="13"></td>
    <td width="86%" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b ">Fees + Taxes</td>
  </tr>
</table>--></div>

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
	<tr>
        <td >
	<table align="center" cellpadding="0" cellspacing="0">
<tr>
<td align="center" style="color:#a41c2b; font-family:Verdana, Arial, Helvetica, sans-serif;">&nbsp;

</td>
      </tr>
      <tr>
        <td height="13"></td>
      </tr>
      <tr>
        <td><img src="icici_car/body_top.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td background="icici_car/body_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tbody><tr>
            <td valign="top"><table width="523" border="0" align="center" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td class="content_title">ICICI Bank Car Loans</td>
              </tr>
              <tr>
                <td height="3"></td>
              </tr>
              <tr>
                <td>
                  <div id="content_holder">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tbody><tr>
                        <td class="subhead" id="122">Advantages*</td>
                      </tr>
                      <tr>
                        <td class="adv_bullet_minus" id="1"><ul>
                            <li><span class="adv_title">Attractive Rate of Interest:</span>
                              <div id="divContent1" style="display: block; padding-top: 5px;">Comprehensive services and competitive interest rates.</div>
                            </li>
                        </ul></td>
                      </tr>
                      <tr>
                        <td class="adv_bullet" id="2"><ul>
                            <li><span class="adv_title">Ease of Documentation:</span>
                              <div id="divContent2" style="padding-top: 5px;">Minimal paperwork involved in availing car loans.</div>
                            </li>
                        </ul></td>
                      </tr>
                      <tr>
                        <td class="adv_bullet" id="3"><ul>
                            <li><span class="adv_title">Prompt Processing:</span>
                            <div id="divContent3" style="padding-top: 5px;">Hassle-free service and quick processing.</div>
                            </li>
                        </ul></td>
                      </tr>
                      <tr>
                        <td class="adv_bullet" id="4"><ul>
                            <li><span class="adv_title">Flexible Loan Repayment Option:</span>
                              <div id="divContent4" style="padding-top: 5px;">A variety to choose from, in terms of finance options for your new /  used car.</div>
                              </li>
                        </ul></td>
                      </tr>
                      <!--

                      <tr>

                        <td class="adv_bullet" id="5"><ul>

                            <li><span class="adv_title">Ease of Delivery:</span>

                            <div id="divContent5" style="display:non; padding-top:5px;">Extensive dealer tie-ups to help you in the delivery of your dream car  at your doorstep.</div>

                              </li>

                        </ul></td>

                      </tr> -->
                    </tbody></table>
                  </div></td>
              </tr>
              <tr>
                <td height="3"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                    <td><img src="icici_car/feature_unit.gif" height="66" width="225"></td>
                    <td align="right"><img src="icici_car/emi_unit.gif" alt="" style="cursor: pointer;" onClick="popup('http://www.icicibank.com/Pfsuser/loanatclick/calculateemi.html','emi','left=120,top=100,scrollbars=no,width=627,height=378'); pageTracker._trackPageview('/virtual/Google/EMICalculator');" border="0"></td>
                  </tr>
                </tbody></table></td>
              </tr>
            </tbody></table></td>
           
          </tr>
          
        </tbody></table></td>
      </tr>
      <tr>
        <td><img src="icici_car/body_btm.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td height="35"><table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
          <tbody><tr>
            <td class="disclaimer" height="10"></td>
          </tr>
           <tr>
             <td class="cnbc" height="103" valign="bottom" width="850"><table border="0" cellpadding="0" cellspacing="6" width="100%">
               <tbody>
                 <tr>
                   <td width="500">&nbsp;</td>
                   <td class="cnbc_link">www.consumerawards.moneycontrol.com/categories.php</td>
                 </tr>
               </tbody>
             </table></td>
           </tr>
          <tr>
            <td class="disclaimer"><a href="javascript:void(0);" onClick="javascript:showHideDiv(0);" class="disclaimer"><b><u>Disclaimer</u></b></a></td>
          </tr>
          <tr>
            <td class="disclaimer">&nbsp;</td>
          </tr>
        </tbody></table></td>
  </tr></table></td></tr>
</tbody></table>
</td></tr></tbody></table>
<div id="disclaimer" class="disclaimerdiv">
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
      <td align="left" height="10" valign="top" width="1%"><img src="icici_car/tl.png" height="10" width="10"></td>
      <td align="left" background="icici_car/b.png" valign="top" width="98%"></td>
      <td align="right" height="10" valign="top" width="1%"><img src="icici_car/tr.png" height="10" width="10"></td>
    </tr>
    <tr>
      <td align="left" background="icici_car/b.png" valign="top">&nbsp;</td>
      <td align="center" bgcolor="#ffffff" valign="top"><table bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" width="100%">
    <tbody><tr>
      <td class="disctxt" align="left" valign="top"><b><u>Disclaimer</u></b>:<br>
            The information provided herein is on the website of  
  Communicate 2 at http://www.loanforcar.in/,  which is neither owned, 
  controlled nor endorsed by ICICI Bank. The use of this information is 
  subject to the terms and conditions governing such products, services 
  and offers as specified by ICICI Bank at www.icicibank.com; and third 
  party from time to time. All Loans are offered at the sole discretion of
   ICICI Bank, subject to submission of documentation and fulfillment of 
  such requisites to the sole and absolute satisfaction of ICICI Bank. 
  Associated benefits / features / interest rates / applicable fees and 
  charges / application process mentioned herein are as on date and may be
   subject to change/ modification from time to time. Eligibility criteria
   and Documentation are indicative and not exhaustive. Nothing contained 
  herein shall constitute
  or be deemed to constitute an advice, invitation or solicitation to 
  purchase any products or services of ICICI Bank or such other third 
  party. ICICI Bank does not accept any responsibility for the details, 
  accuracy, completeness or correct sequence of any content or information
   provided on the website of the third party; and/ or any errors whether 
  caused by negligence or otherwise; and/ or for any loss or damage 
  incurred by anyone in reliance on anything set out herein. "ICICI Bank" 
  and "I-man" logos are trademark and property of ICICI Bank Ltd. Misuse 
  of any intellectual property, or any other content displayed herein is 
  strictly prohibited.<br>
            <br>
            <b>EMI Calculator</b><br>This application ("the 
"Application") is for your personal information, education and 
  communication of an estimation of equated monthly installment ("EMI") 
  and expected changes in it as well as tenure in case of floating rate of
   interest, and is not an offer; invitation or solicitation of any kind 
  to avail the facility is not intended to create any rights or 
  obligations. Please note that the equated monthly installment ("EMI") 
  calculated through this calculator is rounded off to the nearest upper 
  integer. Further, the EMI calculated is indicative based solely on the 
  data fed by you on the screen and does not envisage any changes that 
  might occur due to any discounts, schemes or other promotional 
  activities introduced by ICICI Bank from time to time through its own 
  channel or in association with a third party.
  <p>No reliance may be placed for any purpose whatsoever on the 
  information contained in this presentation or on its completeness. The 
  information set out herein may be subject to updating, completion, 
  revision, verification and amendment and such information may change 
  materially. Such information is provided only for the convenience of the
   customers and ICICI Bank does not undertake any liability or 
  responsibility for the details, accuracy, completeness or correct 
  sequence of any content or information provided through the application.</p>
            <p>The intellectual property in respect of the Application 
  belongs to ICICI Bank and any form of reproduction, dissemination, 
  copying, disclosure, modification, and/or publication of this document 
  is strictly prohibited. The contents of this document are solely meant 
  to provide information and ICICI Bank is not representing or giving you 
  any assurance that your expectations, objectives, needs and wishes will 
  be met with the facility availed and ICICI Bank disclaims all 
  responsibility and accepts no liability for the consequences of any 
  person acting, or refraining from acting, on such information. ICICI 
  Bank Group or any of its officers, employees, personnel, directors shall
   not be liable for any loss, damage, liability whatsoever for any direct
   or indirect loss arising from the use or access of any information that
   may be displayed in through this Application.</p>
          The information provided hereinabove is for information 
  purposes only and is subject to Terms and Conditions which are uploaded 
  on www.icicibank.com and all applicable laws. By accessing and browsing 
  the Application, you accept, without limitation or qualification, the 
  Terms and Conditions and acknowledge that any other agreement between 
  you and ICICI Bank are superseded and of no force or effect.
            <div align="right"><img src="icici_car/closelabel.gif" onClick="javascript:showHideDiv(1);" style="cursor: pointer;"></div>          </td>
    </tr>
  </tbody></table></td>
      <td align="right" background="icici_car/b.png" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="bottom"><img src="icici_car/bl.png" height="10" width="10"></td>
      <td align="left" background="icici_car/b.png" valign="top"></td>
      <td align="right" valign="bottom"><img src="icici_car/br.png" height="10" width="10"></td>
    </tr>
  </tbody></table>
</div>
<script type="text/javascript" src="icici_car/cr.js"></script>
<script type="text/javascript">
    //<![CDATA[
    var clickdensity_siteID = 15427;
    var clickdensity_keyElement = 'companylogo';
    //]]>
</script>
</body></html>