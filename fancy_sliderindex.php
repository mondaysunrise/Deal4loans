<? 
require 'scripts/db_init.php';

/*if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{*/
	
$monthly_income = $_POST["income"];
//$income = $monthly_income * 12;
$income = 500000;
//$hdfc_city = $_POST["City"];
$hdfc_city = "Delhi";
$car_name = $_POST["car_name"];
//$company_name = $_POST["company_name"];
$company_name = "wrs info india";
$dd = $_POST["dd"];
$mm = $_POST["mm"];
$yyyy = $_POST["yyyy"];

$listofcars=array('Chevrolet Beat','Ford Figo','Hyundai Santro GL (Solid)','MARUTI WAGON R LXI BS4');
//print_r($listofcars);

$DOB = $yyyy."".$mm."".$dd;
//$age = DetermineAgeFromDOB($DOB);
$age=30;

$getcompdetails="Select * from hdfc_cl_companylist Where (hdfccl_comp_name='".$company_name."')";
list($rowcmpNR, $rowcmp)=MainselectfuncNew($getcompdetails, $array = array());

$hdfccl_comp_type = $rowcmp[0]["hdfccl_comp_type"];
$krc_flag = $rowcmp[0]["krc_flag"];

for($i=0; $i<count($listofcars); $i++)
{
	
$getcardetails="Select * from hdfc_car_list_category Where (hdfc_car_name='".$listofcars[$i]."')";
list($rowcmpNR1, $row)=Mainselectfunc($getcompdetails, $array = array());
$car_category[] = $row["hdfc_car_category"];
$car_segment[] = $row["hdfc_car_segment"];
$hdfc_clid[]= $row["hdfc_clid"];
$hdfc_car_price[] = $row["hdfc_car_price"];
$hdfc_car_price_delhi[] = $row["hdfc_car_price_delhi"];
$hdfc_car_rate_segment[] = $row["hdfc_car_rate_segment"];
$hdfc_car_name[] = $row["hdfc_car_name"];
$ltv_36months1[] = $row["ltv_36months"];
$ltv_60months1[] = $row["ltv_60months"];
$ltv_84onths1[] = $row["ltv_84months"];
	

}//For loop
//}//$_POST

function hdfccl_listdcomp($income,$age,$car_category,$car_segment,$company_cat,$hdfc_car_price, $hdfc_clid, $hdfc_ratecat, $hdfc_city, $hdfc_car_name)
{
	//echo $income." - ".$age." - ".$car_category." - ".$car_segment." - ".$company_cat." - ".$hdfc_car_price." - ".$hdfc_clid." - ".$hdfc_ratecat." - ".$hdfc_city." - ".$hdfc_car_name;
	//echo "<br>";
	list($term,$print_term)=getdob($age);

	if($car_segment=="A2" || $car_segment=="A3" || $car_segment=="A4" || $car_segment=="MUV")
		{
		if($car_category=="Tier 1" || $car_category=="Tier 2")
			{
				if($income>=150000)
			{
				$loan_amount=$income*3;
			}
				else
			{
				echo "not eligible";
			}

			}
			else if($car_category=="Tier 3")
			{
			if($income>=200000)
			{
				$loan_amount=$income*2;
			}
			else
			{
				echo "not eligible";
			}
			}
		
	}
	else if ($car_segment=="A5")
	{
		if($income>=600000)
			{
				$loan_amount=$income*2;
			}
				else
			{
				echo "not eligible";
			}
	}
	else if ($car_segment=="A6" || $car_segment=="SUV")
	{
if($income>=750000)
			{
					$loan_amount=$income*2;
			}
				else
			{
				echo "not eligible";
			}
	}
//rate with LTV

$getltv="select ltv_36months,ltv_60months,ltv_84months From hdfc_car_list_category Where (hdfc_clid='".$hdfc_clid."')";
list($rowcmpNR2, $rowltv)=Mainselectfunc($getltv, $array = array());
$ltv_36 = $rowltv["ltv_36months"];
$ltv_60 = $rowltv["ltv_60months"];
$ltv_84 = $rowltv["ltv_84months"];

if($ltv_84>0 && ($term>60 && $term<=84))
	{
		$final_ltvmount = $hdfc_car_price * ($ltv_84 / 100);
			$ltvterm=$term;
	}
else if($ltv_60>0 && ($term>36 && $term<=60))
	{
		$final_ltvmount = $hdfc_car_price * ($ltv_60 / 100);
			$ltvterm=$term;
	}
else if($ltv_36>0 && ($term<=36))
	{
		$final_ltvmount = $hdfc_car_price * ($ltv_36 / 100);
			$ltvterm=$term;
	}
	else
	{
		$nwfinal_ltvmount = $hdfc_car_price * ($rowltv["ltv_".$term."months"] / 100);
			
			if($nwfinal_ltvmount>0)
		{
			$final_ltvmount= $nwfinal_ltvmount;
			$ltvterm=$term;
		}
		else
		{
			$nwfinal_ltvmount = $hdfc_car_price * ($rowltv["ltv_".($term-24)."months"] / 100);
			
			
			if($nwfinal_ltvmount>0)
			{
				$final_ltvmount= $nwfinal_ltvmount;
				$ltvterm=$term-24;
			}
			else
			{
				$nwfinal_ltvmount = $hdfc_car_price * ($rowltv["ltv_".($term-48)."months"] / 100);
				$ltvterm=$term-48;
				if($final_ltvmount>0)
					{
						$final_ltvmount= $nwfinal_ltvmount;
						$ltvterm=$term-48;
					}
				
		}
	}
	}

	
//echo "plz do: ".$final_ltvmount."<br>";
//echo  $ltvterm;
if($ltvterm>$term)
	{
		$nwterm=$ltvterm;
	}
	else {
$nwterm=$ltvterm;
	}


if($final_ltvmount>0 && ($final_ltvmount>$loan_amount))
		{
			 $final_loanamt = $final_ltvmount;
		}
		else
		{
			$final_loanamt = $final_ltvmount;
		}



if($nwterm==84)
	{ $print_term=7; } else if ($nwterm==72){ $print_term=6; } else if ($nwterm==60){ $print_term=5; } else if ($nwterm==48){ $print_term=4; } else if ($nwterm==36){ $print_term=3; } else if ($nwterm==24){ $print_term=2; } else if ($nwterm==12){ $print_term=1; }

//echo "<br>";
list($hdfcinterate) = hdfccl_rates($company_cat,$hdfc_city, $nwterm, $hdfc_ratecat, $krc_flag);

$details[]= $nwterm;
$details[]= $print_term;
	$details[]= $hdfcinterate;
	$details[]= $final_loanamt;
	return($details);
}///function hdfccl_listdcomp END



function hdfccl_rates($hdfc_company_cat,$hdfc_city, $hdfc_tenure, $hdfc_rate_segment,$krc_flag)
{
	if($krc_flag==1 && (strlen($hdfc_company_cat)>0 ))
	{	
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
			$intr_rate=11.50;
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=11;
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=10.75;
		}
		else if ($hdfc_rate_segment=="C+" || $hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=10.50;
		}
	}
	else if(($hdfc_company_cat=="CAT A" || $hdfc_company_cat=="SUPER A" || $hdfc_company_cat=="Cat A" || $hdfc_company_cat=="CAT B" || $hdfc_company_cat=="Cat B" || $hdfc_company_cat=="GOVT" ||$hdfc_company_cat=="DEFENCE"))
	{
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
			$intr_rate=11.75;
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=11.25;
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=11;
		}
		else if ($hdfc_rate_segment=="C+" || $hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=10.75;
		}

	}
	else if(($hdfc_company_cat=="CAT C" || $hdfc_company_cat=="Cat C" || $hdfc_company_cat=="CAT D" ||$hdfc_company_cat=="Cat D"))
	{
		if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV")
		{
			$intr_rate=12.50;
		}	
		else if ($hdfc_rate_segment=="B")
		{
			$intr_rate=12;
		}
		else if ($hdfc_rate_segment=="C")
		{
			$intr_rate=11.50;
		}
		else if ($hdfc_rate_segment=="C+" || $hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
		{
			$intr_rate=11.25;
		}
	}//company listed
	else
	{
		if($hdfc_city=="Delhi" || $hdfc_city=="Mumbai" || $hdfc_city=="Hyderabad" || $hdfc_city=="Pune" || $hdfc_city=="Ahmedabad" || $hdfc_city=="Nagpur" || $hdfc_city=="Goa" || $hdfc_city=="Ludhiana" || $hdfc_city=="Chandigarh" || $hdfc_city=="Jaipur" || $hdfc_city=="Kochi" || $hdfc_city=="Kolkata" || $hdfc_city=="Chennai" || $hdfc_city=="Coimbatore" || $hdfc_city=="Surat" || $hdfc_city=="Rajkot" || $hdfc_city=="Jalandhar" || $hdfc_city=="Trivandrum")
		{	
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV" || $hdfc_rate_segment=="B")
			{
				if($hdfc_tenure<36)
				{
					$intr_rate=12.50;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					$intr_rate=12.25;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					$intr_rate=12.50;
				}
			}
			else if ($hdfc_rate_segment=="C")
			{	
				if($hdfc_tenure<36)
				{
					$intr_rate=12;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					$intr_rate=11.75;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					$intr_rate=12;
				}
				
			}
			else if ($hdfc_rate_segment=="C+")
			{	
				if($hdfc_tenure<36)
				{
					$intr_rate=11.50;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					$intr_rate=11.25;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					$intr_rate=11.50;
				}
				
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{	
				if($hdfc_tenure<36)
				{
					$intr_rate=11;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					$intr_rate=10.75;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					$intr_rate=11;
				}
				
			}

		}
		else
		{
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV" || $hdfc_rate_segment=="B")
			{
				if($hdfc_tenure<36)
				{
					$intr_rate=12.75;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					$intr_rate=12.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					$intr_rate=12.75;
				}
			}
			else if ($hdfc_rate_segment=="C")
			{	
				if($hdfc_tenure<36)
				{
					$intr_rate=12.25;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					$intr_rate=12;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					$intr_rate=12.25;
				}
				
			}
			else if ($hdfc_rate_segment=="C+")
			{	
				if($hdfc_tenure<36)
				{
					$intr_rate=11.75;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					$intr_rate=11.50;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					$intr_rate=11.75;
				}
				
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{	
				if($hdfc_tenure<36)
				{
					$intr_rate=11;
				}
				else if ($hdfc_tenure>=36 && $hdfc_tenure<60)
				{
					$intr_rate=10.75;
				}
				else if($hdfc_tenure>=60 && $hdfc_tenure<=84)
				{
					$intr_rate=11;
				}
				
			}

		}
	}

	$ratesid[]= $intr_rate;
	return($ratesid);

} // Function HDFCcl rates only

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
	
	 if ($DOB>=60)
	{
		$term = 0;
			$print_term = "0";
	}
	else if($DOB>58 && $DOB<=59)
		{
			$term = 12;
			$print_term = "1";
		}
		else if($DOB>57 && $DOB<=58)
		{
			$term = 24;
			$print_term = "2";
		}
		else if($DOB>56 && $DOB<=57)
		{
			$term = 36;
			$print_term = "3";
		}
		else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
		}
		else if(($DOB>54 && $DOB<=55))
		{
			$term = 60;
			$print_term = "5";
		}
		else if(($DOB>53 && $DOB<=54))
		{
			$term = 72;
			$print_term = "6";
		}
		else if(($DOB>18 && $DOB<=53))
		{
			$term = 84;
			$print_term = "7";
		}
		else
	{
			$term = 84;
			$print_term = "7";
	}

		$getterm[]= $term;
		$getterm[]= $print_term;
		return($getterm);

}
 
 /*if(($age>=21 && $age<=59 ) && $income>=150000)
 {
	
	if($hdfc_city=="Delhi")
	 {
		 
$hdfc_carprice=$hdfc_car_price_delhi;
	 }
	 else
	 {
		$hdfc_carprice=$hdfc_car_price;
	 }

	 list($tenure,$print_term,$hdfcinter,$maxLoan_Amount) = hdfccl_listdcomp($income,$age,$car_category,$car_segment,$hdfccl_comp_type,$hdfc_carprice, $hdfc_clid, $hdfc_car_rate_segment,$hdfc_city, $hdfc_car_name);

$alac=$maxLoan_Amount;
$intr=$hdfcinter/1200;
$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $tenure))));
  $maxTenure=$tenure;
	 $Loan_Amount=$maxLoan_Amount;
	 $roi=$hdfcinter." %";
 }
 else
 {

 }*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Fancy Sliding Form with jQuery</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Fancy Sliding Form with jQuery" />
        <meta name="keywords" content="jquery, form, sliding, usability, css3, validation, javascript"/>
		<link href="icici_car/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
        <!--     <link rel="stylesheet" href="css/hdfc-slider.css" type="text/css" media="screen"/>-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
 <script type="text/javascript" src="sliding.form.js"></script>
		<script>
			$(function() {
			$( "#slider-range-min_0" ).slider({
			range: "min",
			value: 262496,
			min: 100000,
			step: 10000,
			max:  262496,
			slide: function( event, ui ) {
				$( "#amount_0" ).val( "" + ui.value );
			}
		});
		$( "#amount_0" ).val( "" + $( "#slider-range-min_0" ).slider( "value" ) );
	});

	$(function() {
			$( "#slider-range-min_1" ).slider({
			range: "min",
			value: $("#nwLA_1").val(),
			min: 100000,
			step: 10000,
			max:  $("#nwLA_1").val(),
			slide: function( event, ui ) {
				$( "#amount_1" ).val( "" + ui.value );
			}
		});
		$( "#amount_1" ).val( "" + $( "#slider-range-min_1" ).slider( "value" ) );
	});


	$(function() {
			$( "#slider-range-min_2" ).slider({
			range: "min",
			value: $("#nwLA_2").val(),
			min: 100000,
			step: 10000,
			max:  $("#nwLA_2").val(),
			slide: function( event, ui ) {
				$( "#amount_2" ).val( "" + ui.value );
			}
		});
		$( "#amount_2" ).val( "" + $( "#slider-range-min_2" ).slider( "value" ) );
	});
	

	$(function() {
			$( "#slider-range-min_3" ).slider({
			range: "min",
			value: $("#nwLA_3").val(),
			min: 100000,
			step: 10000,
			max:  $("#nwLA_3").val(),
			slide: function( event, ui ) {
				$( "#amount_3" ).val( "" + ui.value );
			}
		});
		$( "#amount_3" ).val( "" + $( "#slider-range-min_3" ).slider( "value" ) );
	});


$(function() {
		$( "#slider-range-min1_0" ).slider({
			range: "min",
			value: 60,
			step: 6,
			min: 12,
			max: 60,
			slide: function( event, ui ) {
				$( "#amount1_0" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1_0" ).val( "" + $( "#slider-range-min1_0" ) .slider( "value" ) );
	});

	$(function() {
		$( "#slider-range-min1_1" ).slider({
			range: "min",
			value: $("#nwtenu_1").val(),
			step: 6,
			min: 12,
			max: $("#nwtenu_1").val(),
			slide: function( event, ui ) {
				$( "#amount1_1" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1_1" ).val( "" + $( "#slider-range-min1_1" ) .slider( "value" ) );
	});

$(function() {
		$( "#slider-range-min1_2" ).slider({
			range: "min",
			value: $("#nwtenu_2").val(),
			step: 6,
			min: 12,
			max: $("#nwtenu_2").val(),
			slide: function( event, ui ) {
				$( "#amount1_2" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1_2" ).val( "" + $( "#slider-range-min1_2" ) .slider( "value" ) );
	});


	$(function() {
		$( "#slider-range-min1_3" ).slider({
			range: "min",
			value: $("#nwtenu_3").val(),
			step: 6,
			min: 12,
			max: $("#nwtenu_3").val(),
			slide: function( event, ui ) {
				$( "#amount1_3" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1_3" ).val( "" + $( "#slider-range-min1_3" ) .slider( "value" ) );
	});



$(document).ready(function(){
  $("#slider-range-min1").mousemove(function(){
   $( "#amount" ).val($("#nwLA").val());
   $("#LA_dv").val($("#nwLA").val());
   $( "#slider-range-min" ).slider({
			range: "min",
			value: $("#nwLA").val(),
			min: 100000,
			step: 10000,
			max:  $("#nwLA").val(),
			slide: function( event, ui ) {
				$( "#amount" ).val( "" + ui.value );
			}
		});
		$( "#amount" ).val( "" + $( "#slider-range-min" ).slider( "value" ) );
  });
});


$(document).ready(function(){
  $("#slider-range-min1").mouseleave(function(){
   $( "#amount" ).val($("#nwLA").val());
   $("#LA_dv").val($("#nwLA").val());
   $( "#slider-range-min" ).slider({
			range: "min",
			value: $("#nwLA").val(),
			min: 100000,
			step: 10000,
			max:  $("#nwLA").val(),
			slide: function( event, ui ) {
				$( "#amount" ).val( "" + ui.value );
			}
		});
		$( "#amount" ).val( "" + $( "#slider-range-min" ).slider( "value" ) );
  });
});

</script>
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
	
function newcomplete_div(i)
{

var hdfcCity=document.getElementById('city').value;
var compCategory=document.getElementById('comp_category').value;
var rateCategory=document.getElementById('rate_category_'+ i).value;
var krcFlag=document.getElementById('krc_flag').value;
var tenure=document.getElementById('amount1_'+ i).value;
var carprice = document.getElementById('hdfc_carprice_'+ i).value;
var ltv_36 = document.getElementById('ltv_36mths_'+ i).value;
var ltv_60 = document.getElementById('ltv_60mths_'+ i).value;
var ltv_84 = document.getElementById('ltv_84mths_'+ i).value;
		
	var queryString = "?hdfcCity=" + hdfcCity +"&compCategory=" + compCategory + "&rateCategory=" + rateCategory + "&krcFlag=" + krcFlag + "&tenure=" + tenure + "&carprice=" + carprice + "&ltv_36=" + ltv_36 + "&ltv_60=" + ltv_60 + "&ltv_84=" + ltv_84;
			//alert(queryString);
			//alert();
  $('#complete_div').html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div').load("get_hdfc_car_loan_calc.php" + queryString);

}
window.onload = ajaxFunctionMain;
	</script>
<style>
.verdblu12{
	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#002481;
}
.verdblu13{
	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#002481;
}
</style>
    </head>
    <style>
        span.reference{
            position:fixed;
            left:5px;
            top:5px;
            font-size:10px;
            text-shadow:1px 1px 1px #fff;
        }
        span.reference a{
            color:#555;
            text-decoration:none;
			text-transform:uppercase;
        }
        span.reference a:hover{
            color:#000;
            
        }
        h1{
            color:#ccc;
            font-size:36px;
            text-shadow:1px 1px 1px #fff;
            padding:20px;
        }
    </style>
    <body>
        <div>
            <span class="reference">
                <a href="http://tympanus.net/codrops/2010/06/07/fancy-sliding-form-with-jquery/">back to Codrops</a>
            </span>
        </div>
        <div id="content">
            <h1>Fancy Sliding Form with jQuery</h1>
            <div id="wrapper">
                <div id="steps">
                    <form id="formElem" name="formElem" action="" method="post">
                        <fieldset class="step">
                            <legend>My Car</legend>
							<?
							if($hdfc_city=="Delhi")
	 {
		 
$hdfc_carprice=$hdfc_car_price_delhi[0];
	 }
	 else
	 {
		$hdfc_carprice=$hdfc_car_price[0];
	 }
list($tenure,$print_term,$hdfcinter,$maxLoan_Amount) = hdfccl_listdcomp($income,$age,$car_category[0],$car_segment[0],$hdfccl_comp_type,$hdfc_carprice, $hdfc_clid[0], $hdfc_car_rate_segment[0],$hdfc_city, $hdfc_car_name[0]);
echo "<br>";
echo $income." - ".$age." - ".$car_category[0]." - ".$car_segment[0]." - ".$hdfccl_comp_type." - ".$hdfc_carprice." - ".$hdfc_clid[0]." - ".$hdfc_car_rate_segment[0]." - ".$hdfc_city." - ".$hdfc_car_name[0];
echo "<br>";

$alac=$maxLoan_Amount;
$intr=$hdfcinter/1200;
$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $tenure))));
  $maxTenure=$tenure;
	echo $Loan_Amount=$maxLoan_Amount;
	 echo $roi=$hdfcinter." %";
?>
<table><tr><td>
 <input type="text" value="<? echo round($maxLoan_Amount); ?>" name="nwLA_0" id="nwLA_0">
		   <input type="text" value="<? echo $tenure; ?>" name="nwtenu_0" id="nwtenu_0">
</td></tr>
<tr><td>
                           <!-- <p>
                                <label for="email">Email</label>
                                <input id="email" name="email" placeholder="info@tympanus.net" type="email" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" AUTOCOMPLETE=OFF />
                            </p>-->
							<tr>
   <td height="30">&nbsp;</td>
   <td  align="right" ><table border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td align="left" >&nbsp;</td>
       <td align="right">&nbsp;</td>
     </tr>
	 
	    <tr>
       <td align="left"  class="verdblu13"> Eligible Loan Amount:</td>
       <td align="right"><input type="text" id="amount_0" style="border:0px; width:65px;" class="verdblu13" value="262496"/></td>
     </tr>
   </table></td>
   <td align="left" style="font-size:9px; "></td>
 </tr>
 <tr><td ></td><td height="15">
<div id="slider-range-min_0" onClick="newcomplete_div(0);" onChange="newcomplete_div(0);" onMouseUp="newcomplete_div(0);" class="newdiv_0"></div>
</td><td align="right"></td></tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="2" align="left" ><table  border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="57%" class="verdblk9"><b>Min:</b> Rs.100000</td>
       <td width="43%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b "><b>Max:</b><input type="text" id="LA_dv"  value="<? echo $maxLoan_Amount; ?>" style="border:0px;font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b "/></td>
     </tr>
	 
   </table></td>
   </tr>
   <tr><td><table width="93%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="70%" align="left"  class="verdblu13"> Tenure in month:</td>
      <td width="29%" align="right"><input type="text" id="amount1_0" style="border:0;width:25px;" class="verdblu13"/></td>
    </tr>
  </table></td>
  <td align="right">&nbsp;</td>
</tr>
<tr><td width="19%">&nbsp;</td><td>
<div id="slider-range-min1_0" onClick="newcomplete_div(0);" onChange="newcomplete_div(0);" onMouseUp="newcomplete_div(0);"></div>
</td><td width="24%" align="right">&nbsp;</td></tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2" align="left" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif;  color:#5b5b5b "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="60%"  class="verdblk9"><b>Min:</b> 12 Months</td>
      <td width="40%"  class="verdblk9"><b>Max:</b> <? echo $tenure; ?>(Months)</td>
    </tr>
  </table></td></tr>
							</td></tr></table><!--first-->
                        </fieldset>
                        <fieldset class="step">
                            <legend>Personal Details</legend>
                            <p>
                                <label for="name">Full Name</label>
                                <input id="name" name="name" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="country">Country</label>
                                <input id="country" name="country" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="phone">Phone</label>
                                <input id="phone" name="phone" placeholder="e.g. +351215555555" type="tel" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="website">Website</label>
                                <input id="website" name="website" placeholder="e.g. http://www.codrops.com" type="tel" AUTOCOMPLETE=OFF />
                            </p>
                        </fieldset>
                        <fieldset class="step">
                            <legend>Payment</legend>
                            <p>
                                <label for="cardtype">Card</label>
                                <select id="cardtype" name="cardtype">
                                    <option>Visa</option>
                                    <option>Mastercard</option>
                                    <option>American Express</option>
                                </select>
                            </p>
                            <p>
                                <label for="cardnumber">Card number</label>
                                <input id="cardnumber" name="cardnumber" type="number" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="secure">Security code</label>
                                <input id="secure" name="secure" type="number" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="namecard">Name on Card</label>
                                <input id="namecard" name="namecard" type="text" AUTOCOMPLETE=OFF />
                            </p>
                        </fieldset>
                        <fieldset class="step">
                            <legend>Settings</legend>
                            <p>
                                <label for="newsletter">Newsletter</label>
                                <select id="newsletter" name="newsletter">
                                    <option value="Daily" selected>Daily</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Never">Never</option>
                                </select>
                            </p>
                            <p>
                                <label for="updates">Updates</label>
                                <select id="updates" name="updates">
                                    <option value="1" selected>Package 1</option>
                                    <option value="2">Package 2</option>
                                    <option value="0">Don't send updates</option>
                                </select>
                            </p>
							<p>
                                <label for="tagname">Newsletter Tag</label>
                                <input id="tagname" name="tagname" type="text" AUTOCOMPLETE=OFF />
                            </p>
                        </fieldset>
						<fieldset class="step">
                            <legend>Confirm</legend>
							<p>
								Everything in the form was correctly filled 
								if all the steps have a green checkmark icon.
								A red checkmark icon indicates that some field 
								is missing or filled out with invalid data. In this
								last step the user can confirm the submission of
								the form.
							</p>
                            <p class="submit">
                                <button id="registerButton" type="submit">Register</button>
                            </p>
                        </fieldset>
                    </form>
                </div>
                <div id="navigation" style="display:none;">
                    <ul>
                        <li class="selected">
                            <a href="#">Choosen car</a>
                        </li>
                        <li>
                            <a href="#">Personal Details</a>
                        </li>
                        <li>
                            <a href="#">Payment</a>
                        </li>
                        <li>
                            <a href="#">Settings</a>
                        </li>
						<li>
                            <a href="#">Apply</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>