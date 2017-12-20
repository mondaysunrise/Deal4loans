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
//$listofcars=array('Chevrolet Beat','Ford Figo');
//print_r($listofcars);

$DOB = $yyyy."".$mm."".$dd;
//$age = DetermineAgeFromDOB($DOB);
$age=30;

$getcompdetails="Select * from hdfc_cl_companylist Where (hdfccl_comp_name='".$company_name."')";
$resultcomp=ExecQuery($getcompdetails);
$rowcmp=mysql_fetch_array($resultcomp);
$hdfccl_comp_type = $rowcmp["hdfccl_comp_type"];
$krc_flag = $rowcmp["krc_flag"];

for($i=0; $i<count($listofcars); $i++)
{
	
$getcardetails="Select * from hdfc_car_list_category Where (hdfc_car_name='".$listofcars[$i]."')";
$result=ExecQuery($getcardetails);
$row=mysql_fetch_array($result);
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
/*$getltv="select ltv_36months,ltv_60months,ltv_84months From hdfc_car_list_category Where (hdfc_clid='".$hdfc_clid."')";
$resultgetltv=ExecQuery($getltv);
$rowltv=mysql_fetch_array($resultgetltv);
$ltv_36 = $rowltv["ltv_36months"];
$ltv_60 = $rowltv["ltv_60months"];
$ltv_84 = $rowltv["ltv_84months"];*/


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
$resultgetltv=ExecQuery($getltv);
$rowltv=mysql_fetch_array($resultgetltv);
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
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HDFC Bank Car Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
	  <link rel="stylesheet" href="css/hdfc-slider.css" type="text/css" media="screen"/>

        <script type="text/javascript" src="sliding.form.js"></script>
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
	<script>
			$(function() {
			$( "#slider-range-min_0" ).slider({
			range: "min",
			value: $("#nwLA_0").val(),
			min: 100000,
			step: 10000,
			max:  $("#nwLA_0").val(),
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
			value: $("#nwtenu_0").val(),
			step: 6,
			min: 12,
			max: $("#nwtenu_0").val(),
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
<style>
.verdblu12{
	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#002481;
}
.verdblu13{
	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#002481;
}
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
</head><body>
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
                       
<? 

for($j=0; $j<count($listofcars); $j++)
{
	?>
	 <fieldset class="step">
                            <legend>My Car</legend>
<table align="center" border="0" cellpadding="0" cellspacing="0" >
  <tbody><tr>
    <td background="icici_car/main_bg.gif">
<? if($hdfc_city=="Delhi")
	 {
		 
$hdfc_carprice=$hdfc_car_price_delhi[$j];
	 }
	 else
	 {
		$hdfc_carprice=$hdfc_car_price[$j];
	 }
			list($tenure,$print_term,$hdfcinter,$maxLoan_Amount) = hdfccl_listdcomp($income,$age,$car_category[$j],$car_segment[$j],$hdfccl_comp_type,$hdfc_carprice, $hdfc_clid[$j], $hdfc_car_rate_segment[$j],$hdfc_city, $hdfc_car_name[$j]);

$alac=$maxLoan_Amount;
$intr=$hdfcinter/1200;
$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $tenure))));
  $maxTenure=$tenure;
	 $Loan_Amount=$maxLoan_Amount;
	 $roi=$hdfcinter." %";

		/*echo $tenure;
echo $print_term;
echo $hdfcinter;
echo $maxLoan_Amount;*/

?>
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="872" bgcolor="#ffffff">
      <tbody><tr>
        <td ><img src="new-images/spacer.gif" ></td>
      </tr>
	  <tr>
        <td height="8">Car Name : <? echo $listofcars[$j]; ?></td>
      </tr>
      <tr>
	  	  
        <td align="center" ><table width="850" border="0" cellspacing="0" cellpadding="0">
 <!--D4l Here-->
<? if($maxLoan_Amount>0)
{

?>
 <tr>
 <td width="626" align="center" valign="top" style="height:180px; background-position: top;">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		 
  <tr>
    <td><form name="icici_form" action="icici_carloan_func.php" onSubmit="return submitform(document.icici_form);" method="post">
	<input type="hidden" name="newj" id="newj" value="<? echo $j; ?>">
<input type="hidden" name="city" id="city" value="<? echo $hdfc_city; ?>">
<input type="hidden" name="comp_category" id="comp_category" value="<? if(strlen($hdfccl_comp_type)>0) { echo $hdfccl_comp_type; } else { echo "0"; } ?>">
<input type="hidden" name="rate_category_<? echo $j; ?>" id="rate_category_<? echo $j; ?>" value="<? echo $hdfc_car_rate_segment[$j]; ?>">
<input type="hidden"  name="krc_flag" id="krc_flag" value="<? echo $krc_flag; ?>">
<input type="hidden"  name="ltv_36mths_<? echo $j; ?>" id="ltv_36mths_<? echo $j; ?>" value="<? echo $ltv_36months1[$j]; ?>">
<input type="hidden"  name="ltv_60mths_<? echo $j; ?>" id="ltv_60mths_<? echo $j; ?>" value="<? echo $ltv_60months1[$j]; ?>">
<input type="hidden"  name="ltv_84mths_<? echo $j; ?>" id="ltv_84mths_<? echo $j; ?>" value="<? echo $ltv_84onths1[$j]; ?>">
<input type="hidden"  name="hdfc_carprice_<? echo $j; ?>" id="hdfc_carprice_<? echo $j; ?>" value="<? if($hdfc_city=="Delhi") { echo $hdfc_car_price_delhi[$j]; } else { echo $hdfc_car_price[$j]; } ?>">
<table width="100%" cellpadding="0" border="0">
 <tr>
   <td height="30">&nbsp;</td>
   <td width="57%" align="right" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td align="left" >&nbsp;</td>
       <td align="right">&nbsp;</td>
     </tr>
	 
	    <tr>
       <td width="62%" align="left"  class="verdblu13"> Eligible Loan Amount:</td>
       <td width="37%" align="right"><input type="text" id="amount_<? echo $j; ?>" style="border:0px; width:65px;" class="verdblu13" /></td>
     </tr>
   </table></td>
   <td align="left" style="font-size:9px; "></td>
 </tr>
 <tr><td width="19%"></td><td height="15">
<div id="slider-range-min_<? echo $j; ?>" onClick="newcomplete_div(<? echo $j; ?>);" onChange="newcomplete_div(<? echo $j; ?>);" onMouseUp="newcomplete_div(<? echo $j; ?>);" class="newdiv_<? echo $j; ?>"></div>
</td><td width="24%" align="right"></td></tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="2" align="left" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="57%" class="verdblk9"><b>Min:</b> Rs.100000</td>
       <td width="43%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b "><b>Max:</b><input type="text" id="LA_dv"  value="<? echo $maxLoan_Amount; ?>" style="border:0px;font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b "/></td>
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
      <td width="70%" align="left"  class="verdblu13"> Tenure in month:</td>
      <td width="29%" align="right"><input type="text" id="amount1_<? echo $j; ?>" style="border:0;width:25px;" class="verdblu13"/></td>
    </tr>
  </table></td>
  <td align="right">&nbsp;</td>
</tr>
<tr><td width="19%">&nbsp;</td><td>
<div id="slider-range-min1_<? echo $j; ?>" onClick="newcomplete_div(<? echo $j; ?>);" onChange="newcomplete_div(<? echo $j; ?>);" onMouseUp="newcomplete_div(<? echo $j; ?>);"></div>
</td><td width="24%" align="right">&nbsp;</td></tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2" align="left" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif;  color:#5b5b5b "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="60%"  class="verdblk9"><b>Min:</b> 12 Months</td>
      <td width="40%"  class="verdblk9"><b>Max:</b> <? echo $tenure; ?>(Months)</td>
    </tr>
  </table></td>
  </tr>
</table>
</form></td></tr></table>
<table width="100%"  border="0" align="center">
<tr>
<td align="center" style="text-align:center; ">
</td>
  </tr>
</table>
</td>
    <td width="328" align="center" valign="top"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#a41c2b; ">
</td>
  </tr>
<? }
	else
	{?>
	 <tr>
 <td width="626" align="center" valign="top">
	<table width="100%">
	<tr>
 <td align="left"  class="verdblu13"> Dear Customer,<br>
Thanks for showing interest in HDFC car Loans.
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
?>	  <tr>
	      <td height="71" colspan="2" align="center" style="background: url(icici_car/quote-bg.gif) no-repeat; background-position:center; " width="790" height="71">
		  <div style=" float:left;" id="complete_div">
		  <input type="hidden" value="<? echo round($maxLoan_Amount); ?>" name="nwLA_<? echo $j; ?>" id="nwLA_<? echo $j; ?>">
		   <input type="hidden" value="<? echo $tenure; ?>" name="nwtenu_<? echo $j; ?>" id="nwtenu_<? echo $j; ?>">
	<div style="position:absolute; z-index:100; margin-left:550px; top:110px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;   color:#a41c2b;">
	<div><b>PIE CHART</b></div><? $total_cost = ($emiPerLac*$tenure) + $processing_fee;
$total_interest = ($emiPerLac*$tenure) - $Loan_Amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;
$pfpercent= ($processing_fee / $total_cost) *100;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);
$r= ($j+1)*100;
?>
<img src="http://chart.apis.google.com/chart?chs=250x100&cht=p3&chd=t:<? echo $lnpre; ?>,<? echo $inper; ?>&chxt=x,y&chds=0,<? echo $r; ?>&chxr=0,0,<? echo $r; ?>|<? echo $r; ?>,0,90&chxl=0:|<? echo $lnpre." %"; ?>|<? echo $inper." %"; ?>&chco=A2D7F6,F4E46C"/>
<div id="sign">
<ul style="margin:0px; ">
<li style=" background:url(icici_car/amount_sign.gif) no-repeat 0px 4px; ">Loan Amount -  <? echo "Rs. ".number_format($Loan_Amount);?></li>
<li style=" background:url(icici_car/interest_sign.gif) no-repeat 0px 4px;">Interest Rate - <? echo "Rs. ".number_format($total_interest); ?></li>
</ul>
</div>
</div>
		  <table width="790" align="center"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" height="30" class="verdbold12">Bank Name </td>
        <td align="center" class="verdbold12">Total Cost </td>
        <td align="center" class="verdbold12">Monthly Payment </td>
        <td align="center" class="verdbold12">ROI </td>
        <!--<td align="center"  class="verdbold12"></td>-->
      </tr>
	   
		  <tr >
        <td  height="35" align="center"  class="verdblu12">HDFC Bank Car Loan </td>
        <td align="center"   class="verdblu12"><? echo "Rs. ".number_format($total_cost);?></td>
        <td width="20%" align="center"   class="verdblu12"><? echo "Rs. ".number_format($emiPerLac);?></td>
        <td align="center"   class="verdblu12"><? echo $roi."\n";?></td>
        <td align="center"   class="verdblu12"><!--<img src="new-images/get-apply-hdfccl.gif" width="94" height="27">--></td>
      </tr>
		</table>
	  </div>
          </td>
	  </tr>
	  <? } ?>
	<tr>
        <td >
	</td></tr><tr>
        <td  bgcolor="#FFFFFF"><img src="new-images/spacer.gif"></td>
      </tr>
</tbody></table>
</td></tr>
</tbody>
</table>
</fieldset>
<? }//for loop
?>

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
                            <a href="#"><? echo $listofcars[0]; ?></a>
                        </li>
                        <li>
                            <a href="#"><? echo $listofcars[1]; ?></a>
                        </li>
                        <li>
                            <a href="#"><? echo $listofcars[2]; ?></a>
                        </li>
                        <li>
                            <a href="#"><? echo $listofcars[3]; ?></a>
                        </li>
						<!--<li>
                            <a href="#">Confirm</a>
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>