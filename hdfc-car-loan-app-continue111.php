<? 
require 'scripts/db_init.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	
$monthly_income = $_POST["income"];
$income = $monthly_income * 12;
$hdfc_city = $_POST["City"];
$car_name = $_POST["car_name"];
$company_name = $_POST["company_name"];
$dd = $_POST["dd"];
$mm = $_POST["mm"];
$yyyy = $_POST["yyyy"];

$DOB = $yyyy."".$mm."".$dd;
			$age = DetermineAgeFromDOB($DOB);

$getcompdetails="Select * from hdfc_cl_companylist Where (hdfccl_comp_name='".$company_name."')";
list($getCarNumRows,$rowcmp)=MainselectfuncNew($getcompdetails,$array = array());
$hdfccl_comp_type = $rowcmp[0]["hdfccl_comp_type"];
$krc_flag = $rowcmp[0]["krc_flag"];

$getcardetails="Select * from hdfc_car_list_category Where (hdfc_car_name='".$car_name."')";
list($getcardetailsNumRows,$row)=MainselectfuncNew($getcardetails,$array = array());
$car_category = $row[0]["hdfc_car_category"];
//echo "<br>";
$car_segment = $row[0]["hdfc_car_segment"];
//echo "<br>";
$hdfc_clid = $row[0]["hdfc_clid"];
//echo "<br>";
$hdfc_car_price = $row[0]["hdfc_car_price"];
//echo "<br>";
$hdfc_car_price_delhi = $row[0]["hdfc_car_price_delhi"];
//echo "<br>";
$hdfc_car_rate_segment = $row[0]["hdfc_car_rate_segment"];
$hdfc_car_name = $row[0]["hdfc_car_name"];
//echo "<br>";
 

$getltvfor_LA="select ltv_36months,ltv_60months,ltv_84months From hdfc_car_list_category Where (hdfc_clid='".$hdfc_clid."')";
list($rowltvLANumRows,$rowltvLA)=MainselectfuncNew($getltvfor_LA,$array = array());

$ltv_36months1 = $rowltvLA[0]["ltv_36months"];
$ltv_60months1 = $rowltvLA[0]["ltv_60months"];
$ltv_84onths1 = $rowltvLA[0]["ltv_84months"];

}

function hdfccl_listdcomp($income,$age,$car_category,$car_segment,$company_cat,$hdfc_car_price, $hdfc_clid, $hdfc_ratecat, $hdfc_city, $hdfc_car_name)
{
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
list($getltvNumRows,$rowltv)=MainselectfuncNew($getltv,$array = array());
$ltv_36months = $rowltv[0]["ltv_36months"];
$ltv_60months = $rowltv[0]["ltv_60months"];
$ltv_84onths = $rowltv[0]["ltv_84onths"];

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

	
//echo $term;
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
 
 if(($age>=21 && $age<=59 ) && $income>=150000)
 {
	
	 if($hdfc_city=="Delhi")
	 {
		 
$hdfc_carprice=$hdfc_car_price_delhi;
	 }
	 else
	 {
		$hdfc_carprice=$hdfc_car_price;
	 }
list($print_term,$hdfcinter,$hdfcfinal_loanamt) = hdfccl_listdcomp($income,$age,$car_category,$car_segment,$hdfccl_comp_type,$hdfc_carprice, $hdfc_clid, $hdfc_car_rate_segment,$hdfc_city, $hdfc_car_name);
 }
 else
 {

 }

//echo "term:".$print_term."<br>";
//echo "interest:".$hdfcinter."<br>";
//echo "loan amt: ".$hdfcfinal_loanamt."<br>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 

<link href="/style/slider.css" rel="stylesheet" type="text/css" />
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript">
function rate_nchange()
{
	var tenure_years;
var hdfcCity=document.getElementById('city').value;
var compCategory=document.getElementById('comp_category').value;
var rateCategory=document.getElementById('rate_category').value;
var krcFlag=document.getElementById('krc_flag').value;
var tenure=document.getElementById('tenure').value;
var carprice = document.getElementById('hdfc_carprice').value;
var ltv_36 = document.getElementById('ltv_36mths').value;
var ltv_60 = document.getElementById('ltv_60mths').value;
var ltv_84 = document.getElementById('ltv_84mths').value;
var final_ltvmount, nwfinal_ltvmount, nwtenure;


if(tenure==1)
	{ tenure_years=12;	} else if (tenure==2) {	tenure_years=24;} else if (tenure==3) {	tenure_years=36;} else if (tenure==4) {	tenure_years=48;} else if (tenure==5) {	tenure_years=60;} else if (tenure==7) {	tenure_years=84;}

//alert(ltv_84mths);

if(ltv_84>0 && (tenure_years>60 && tenure_years<=84))
	{
		final_ltvmount = carprice * (ltv_84 / 100);
			ltvterm=tenure_years;
			
	}
else if(ltv_60>0 && (tenure_years>36 && tenure_years<=60))
	{
		final_ltvmount = carprice * (ltv_60 / 100);
			ltvterm=tenure_years;
			
	}
else if(ltv_36>0 && (tenure_years<=36))
	{
		final_ltvmount = carprice * (ltv_36 / 100);
			ltvterm=tenure_years;
			
			
	}
	else
	{
		final_ltvmount = carprice * (ltv_36 / 100);
			ltvterm=tenure_years;
	}
	

if(ltvterm==84)	{	nwtenure=7; } else if(ltvterm==72)	{	nwtenure=6; } if(ltvterm==60)	{	nwtenure=5; } if(ltvterm==48)	{	nwtenure=4; } if(ltvterm==36)	{	nwtenure=3; } if(ltvterm==24)	{	nwtenure=2; } if(ltvterm==12)	{	nwtenure=1; }

document.getElementById('tenure').value = nwtenure;
document.getElementById('L_Amt').value = Math.round(final_ltvmount);
document.getElementById('maxL_Amt').value = Math.round(final_ltvmount);


//for LA
if(krcFlag==1 && (compCategory!="" ))
	{	
		if(rateCategory=="A" || rateCategory=="MUV")
		{
			interestRate=11.50;
		}	
		else if (rateCategory=="B")
		{
			interestRate=11;
		}
		else if (rateCategory=="C")
		{
			interestRate=10.75;
		}
		else if (rateCategory=="C+" || rateCategory=="D" || rateCategory=="D+")
		{
			interestRate=10.50;
		}
	}
	else if((compCategory=="CAT A" || compCategory=="SUPER A" || compCategory=="Cat A" || compCategory=="CAT B" || compCategory=="Cat B" || compCategory=="GOVT" ||compCategory=="DEFENCE"))
	{
		if(rateCategory=="A" || rateCategory=="MUV")
		{
			interestRate=11.75;
		}	
		else if (rateCategory=="B")
		{
			interestRate=11.25;
		}
		else if (rateCategory=="C")
		{
			interestRate=11;
		}
		else if (rateCategory=="C+" || rateCategory=="D" || rateCategory=="D+")
		{
			interestRate=10.75;
		}

	}
	else if((compCategory=="CAT C" || compCategory=="Cat C" || compCategory=="CAT D" ||compCategory=="Cat D"))
	{
		if(rateCategory=="A" || rateCategory=="MUV")
		{
			interestRate=12.50;
		}	
		else if (rateCategory=="B")
		{
			interestRate=12;
		}
		else if (rateCategory=="C")
		{
			interestRate=11.50;
		}
		else if (rateCategory=="C+" || rateCategory=="D" || rateCategory=="D+")
		{
			interestRate=11.25;
		}
	}//company listed
	else
	{
		if(hdfcCity=="Delhi" || hdfcCity=="Mumbai" || hdfcCity=="Hyderabad" || hdfcCity=="Pune" || hdfcCity=="Ahmedabad" || hdfcCity=="Nagpur" || hdfcCity=="Goa" || hdfcCity=="Ludhiana" || hdfcCity=="Chandigarh" || hdfcCity=="Jaipur" || hdfcCity=="Kochi" || hdfcCity=="Kolkata" || hdfcCity=="Chennai" || hdfcCity=="Coimbatore" || hdfcCity=="Surat" || hdfcCity=="Rajkot" || hdfcCity=="Jalandhar" || hdfcCity=="Trivandrum")
		{	
			if(rateCategory=="A" || rateCategory=="MUV" || rateCategory=="B")
			{
				if(tenure_years<36)
				{
					interestRate=12.50;
				}
				else if (tenure_years>=36 && tenure_years<60)
				{
					interestRate=12.25;
				}
				else if(tenure_years>=60 && tenure_years<=84)
				{
					interestRate=12.50;
				}
			}
			else if (rateCategory=="C")
			{	
				if(tenure_years<36)
				{
					interestRate=12;
				}
				else if (tenure_years>=36 && tenure_years<60)
				{
					interestRate=11.75;
				}
				else if(tenure_years>=60 && tenure_years<=84)
				{
					interestRate=12;
				}
				
			}
			else if (rateCategory=="C+")
			{	
				if(tenure_years<36)
				{
					interestRate=11.50;
				}
				else if (tenure_years>=36 && tenure_years<60)
				{
					interestRate=11.25;
				}
				else if(tenure_years>=60 && tenure_years<=84)
				{
					interestRate=11.50;
				}
				
			}
			else if (rateCategory=="D" || rateCategory=="D+")
			{	
				if(tenure_years<36)
				{
					interestRate=11;
				}
				else if (tenure_years>=36 && tenure_years<60)
				{
					interestRate=10.75;
				}
				else if(tenure_years>=60 && tenure_years<=84)
				{
					interestRate=11;
				}
				
			}

		}
		else
		{
			if(rateCategory=="A" || rateCategory=="MUV" || rateCategory=="B")
			{
				if(tenure_years<36)
				{
					interestRate=12.75;
				}
				else if (tenure_years>=36 && tenure_years<60)
				{
					interestRate=12.50;
				}
				else if(tenure_years>=60 && tenure_years<=84)
				{
					interestRate=12.75;
				}
			}
			else if (rateCategory=="C")
			{	
				if(tenure_years<36)
				{
					interestRate=12.25;
				}
				else if (tenure_years>=36 && tenure_years<60)
				{
					interestRate=12;
				}
				else if(tenure_years>=60 && tenure_years<=84)
				{
					interestRate=12.25;
				}
				
			}
			else if (rateCategory=="C+")
			{	
				if(tenure_years<36)
				{
					interestRate=11.75;
				}
				else if (tenure_years>=36 && tenure_years<60)
				{
					interestRate=11.50;
				}
				else if(tenure_years>=60 && tenure_years<=84)
				{
					interestRate=11.75;
				}
				
			}
			else if (rateCategory=="D" || rateCategory=="D+")
			{	
				if(tenure_years<=36)
				{
					interestRate=11;
				}
				else if (tenure_years>36 && tenure_years<=60)
				{
					interestRate=10.75;
				}
				else if(tenure_years>60 && tenure_years<=84)
				{
					interestRate=11;
				}
				
			}

		}
	}

document.getElementById('loan_intr').value = interestRate;
	//alert(interestRate);
	}
</script>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" align="center" class="font2">
<tr><td align="center">
<table cellpadding="0" cellspacing="0" border="0" align="center" class="font2">
<? 
if($hdfcfinal_loanamt>0 && $hdfcinter>0 && $print_term>0)
{
	?>
<tr><td colspan="2" style="padding-bottom:10px;">
<script Language="JavaScript" Type="text/javascript" src="/scripts/tooltip.js"></script>
<link rel="stylesheet" href="/jsj/stylecal_hdfccl.css" type="text/css" media="screen" />
<script type='text/javascript' src='/jsj/jquery.min.js'></script>
<script type='text/javascript' src='/jsj/jquery-ui-slider.min.js'></script>
<script type='text/javascript' src='/jsj/globalize.min.js'></script>
<script type='text/javascript' src='/jsj/jquery.color.js'></script>
<script type='text/javascript' src='/jsj/superfish.js'></script>
<script type='text/javascript' src='/jsj/highcharts.js'></script>
<script type='text/javascript' src='/jsj/jquery.custom.min.hdfccl.js'></script>
</td></tr>
<tr><td width="604" class="text" style="color:#4c4c4c; size:18px; height:37px;" colspan="2"  >
</td></tr>
<tr><td>Car Price : <? echo $hdfc_car_price_delhi; ?> (in Delhi)</td></tr>
<tr><td>Car Price : <? echo $hdfc_car_price; ?> (Others)</td></tr>
<tr><td  style="padding-left:100px; font-weight:bold; padding-bottom:5px;" class="frmbldtxt" >To check exact Emi-Input your loan Amount/Tenure/rate of interest below. </td>
<td  class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:30px;"  ><span >Results</span></td></tr>
<tr><td width="604" style="padding-left:100px; ">		

<form id="calc_Form">

<input type="hidden" name="city" id="city" value="<? echo $hdfc_city; ?>">
<input type="hidden" name="comp_category" id="comp_category" value="<? echo $hdfccl_comp_type; ?>">
<input type="hidden" name="rate_category" id="rate_category" value="<? echo $hdfc_car_rate_segment; ?>">
<input type="hidden"  name="krc_flag" id="krc_flag" value="<? echo $krc_flag; ?>">
<input type="hidden"  name="ltv_36mths" id="ltv_36mths" value="<? echo $ltv_36months1; ?>">
<input type="hidden"  name="ltv_60mths" id="ltv_60mths" value="<? echo $ltv_60months1; ?>">
<input type="hidden"  name="ltv_84mths" id="ltv_84mths" value="<? echo $ltv_84onths1; ?>">
<input type="hidden"  name="hdfc_carprice" id="hdfc_carprice" value="<? if($hdfc_city=="Delhi") { echo $hdfc_car_price_delhi; } else { echo $hdfc_car_price; } ?>">
<div class="lamount" >
<strong>Principal Car Loan Amount</strong>

<input id="L_Amt" name="L_Amt" value="<? echo number_format($hdfcfinal_loanamt); ?>" type="text"/>
<input id="maxL_Amt" name="maxL_Amt" value="<? echo $hdfcfinal_loanamt; ?>" type="hidden"/>
</div>
<div id="loanamountslider"></div>
<div style="height:30;"><span style="float:left; ">Min loan : 1 Lac</span> <span style="float:right;">Max loan :<? echo number_format($hdfcfinal_loanamt); ?> Lacs</span></div>
<div ><strong>Interest Rate</strong><input id="loan_intr" name="loan_intr" value="<? echo $hdfcinter; ?>" type="text"/><span><strong> % Per Annum</strong></span></div>
<!--<div id="loan_intrslider"></div>-->

<div ><strong>Loan Term</strong><input id="tenure" name="tenure" value="<? echo $print_term; ?>" type="text" /><input id="maxnwtenure" name="maxnwtenure" value="<? echo $print_term; ?>" type="hidden"/><input name="loantenure" id="tenure_years" value="tenure_years" checked type="radio" style="display:none;"/><span><strong> Years</strong></span></div>
<div class="clear" ></div>
<div id="tenureslider" onClick="rate_nchange();" onmouseup="rate_nchange();"></div>
<div ><span style="float:left; " >Min tenure : 1 yr</span> <span style="float:right;">Max tenure : <? echo $print_term; ?> yr</span></div>
</form>

</td><td width="456" align="center" valign="top">
<div id="emipaymentdetails">
	<div id="emisum">
		<div id="emiamount"><h4>&nbsp;</h4>
		  <h4>Monthly Instalment (EMI)</h4>
		  <p style="font-size:12px;">Rs. <span>2,758</span></p>
		  <p style="font-size:12px;">&nbsp;</p>
		</div>
        <div id="emitotalinterest"><h4>Total Interest Amount</h4><p style="font-size:12px;">Rs. <span>32,374</span></p>
          <p style="font-size:12px;">&nbsp;</p>
        </div>
        <div id="emitotalamount" class="column-last"><h4>Total Amount<br/>(Principal + Interest)</h4><p style="font-size:12px;">Rs. <span>132,374</span></p></div>
    </div>
</div>
</td></tr>
<tr><td width="604" style="padding-left:100px; font-weight:bold; padding-bottom:5px;" colspan="2">Emi charts /Illustrations are below.</td></tr>
<tr><td>
<div id="emibarchart"  class="highcharts-container"></div><br /> Apply Here
</td><td>
<div id="emipiechart" class="highcharts-container"></div> </td></tr>
<tr><td colspan="2">
<div id="emipaymenttable"></div>
</td></tr>
<? } 
else { ?>
<tr> <td>&nbsp;</td></tr>
<tr> <td>We're sorry. No offers were found.<br>
Based on your information, we are unable to find you an offer from any of our banking partners.</td></tr>
<? }
?>
</table>
<script type='text/javascript' src='/jsj/ui.tabs.js'></script>
</td></tr></table>

</body>
</html>