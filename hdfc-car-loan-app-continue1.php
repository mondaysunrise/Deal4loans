<? 
require 'scripts/db_init.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
$income = $_POST["income"];
$hdfc_city = $_POST["City"];
$car_name = $_POST["car_name"];
$company_name = $_POST["company_name"];
$age = $_POST["age"];
//$age=59;

$getcompdetails="Select * from hdfc_cl_companylist Where (hdfccl_comp_name='".$company_name."')";
list($getCarNumRows,$rowcmp)=MainselectfuncNew($getcompdetails,$array = array());
$hdfccl_comp_type = $rowcmp[0]["hdfccl_comp_type"];
$krc_flag = $rowcmp[0]["krc_flag"];

$getcardetails="Select * from hdfc_car_list_category Where (hdfc_car_name='".$car_name."')";
list($getcardetailsNumRows,$row)=MainselectfuncNew($getcardetails,$array = array());
echo "car cat: ".$car_category = $row[0]["hdfc_car_category"];
echo "<br>";
echo "car seg: ".$car_segment = $row[0]["hdfc_car_segment"];
echo "<br>";
echo "hdfc id: ".$hdfc_clid = $row[0]["hdfc_clid"];
echo "<br>";
echo "car price: ".$hdfc_car_price = $row[0]["hdfc_car_price"];
echo "<br>";
echo "car price delhi: ".$hdfc_car_price_delhi = $row[0]["hdfc_car_price_delhi"];
echo "<br>";
echo "car rate seg: ".$hdfc_car_rate_segment = $row[0]["hdfc_car_rate_segment"];
echo "<br>";
 	

//echo $income." - ".$age." - ".$car_category." - ".$car_segment." - ".$hdfccl_comp_type." - ".$hdfc_car_price." - ". $hdfc_clid." - ". $hdfc_car_rate_segment." - ".$hdfc_city;


	}

function hdfccl_listdcomp($income,$age,$car_category,$car_segment,$company_cat,$hdfc_car_price, $hdfc_clid, $hdfc_ratecat, $hdfc_city)
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
$getltv="select ltv_36months,ltv_60months,ltv_84onths From hdfc_car_list_category Where (hdfc_clid='".$hdfc_clid."')";
list($getltvNumRows,$rowltv)=MainselectfuncNew($getltv,$array = array());

$ltv_36months = $rowltv[0]["ltv_36months"];
$ltv_60months = $rowltv[0]["ltv_60months"];
$ltv_84onths = $rowltv[0]["ltv_84onths"];

if($ltv_84onths>0 && ($term<=84 && $term>60))
	{
		$final_ltvmount = $hdfc_car_price * ($ltv_84onths / 100);
		$yr="till 7 yrs";
		$ltvterm=$term;
	}
	else if ($ltv_60months>0 && ($term<=60 && $term>36))
	{
		$final_ltvmount = $hdfc_car_price * ($ltv_60months/ 100);
		$yr="till 5 yrs";
		$ltvterm=$term;
		
	}
	else if ( $ltv_84onths>0 && ($term<=36))
	{
			
		$final_ltvmount = $hdfc_car_price * ($ltv_36months / 100);
		$yr="till 3 yrs";
		$ltvterm=$term;
	}
	else
	{
			$final_ltvmount = $hdfc_car_price * ($ltv_36months / 100);
		$yr="till 3 yrs";
		$ltvterm=$term;
	}


if($ltvterm>$term)
	{
		$nwterm=$term;
	}
	else {
$nwterm=$ltvterm;
	}

if($income>=$hdfc_car_price)
	{
		$final_loanamt = $hdfc_car_price;
	}
	else
	{

		if($final_ltvmount>0 && ($final_ltvmount>$loan_amount))
		{
			 $final_loanamt = $loan_amount;
		}
		else
		{
			$final_loanamt = $final_ltvmount;
		}
	}
	if($car_segment=="A1" || $car_segment=="A2")
	{
		if($final_loanamt>300000)
		{
			$final_loanamt=300000;
		}
		else
		{
			$final_loanamt=$final_loanamtp;
		}
	}
	else if ($car_segment=="A3")
	{
		if($final_loanamt>400000)
		{
			$final_loanamt=400000;
		}
		else
		{
			$final_loanamt=$final_loanamtp;
		}
	}
//for rate

if($nwterm==84)
	{ $print_term=7; } else if ($nwterm==72){ $print_term=6; } else if ($nwterm==60){ $print_term=5; } else if ($nwterm==48){ $print_term=4; } else if ($nwterm==36){ $print_term=3; } else if ($nwterm==24){ $print_term=2; } else if ($nwterm==12){ $print_term=1; }

echo "<br>";
list($hdfcinterate) = hdfccl_rates($company_cat,$hdfc_city, $nwterm, $hdfc_ratecat, $krc_flag);
echo "<br>";
echo "rate:".$hdfcinterate;
echo "<br>";
	echo "no of years: ".$print_term."<br>";
echo "<br>";
echo "LA with multiplier:".$loan_amount."<br>";

echo "final loan amount:".$final_loanamt."<br>";

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
				if($hdfc_tenure<=36)
				{
					$intr_rate=12.50;
				}
				else if ($hdfc_tenure>36 && $hdfc_tenure<=60)
				{
					$intr_rate=12.25;
				}
				else if($hdfc_tenure>60 && $hdfc_tenure<=84)
				{
					$intr_rate=12.50;
				}
			}
			else if ($hdfc_rate_segment=="C")
			{	
				if($hdfc_tenure<=36)
				{
					$intr_rate=12;
				}
				else if ($hdfc_tenure>36 && $hdfc_tenure<=60)
				{
					$intr_rate=11.75;
				}
				else if($hdfc_tenure>60 && $hdfc_tenure<=84)
				{
					$intr_rate=12;
				}
				
			}
			else if ($hdfc_rate_segment=="C+")
			{	
				if($hdfc_tenure<=36)
				{
					$intr_rate=11.50;
				}
				else if ($hdfc_tenure>36 && $hdfc_tenure<=60)
				{
					$intr_rate=11.25;
				}
				else if($hdfc_tenure>60 && $hdfc_tenure<=84)
				{
					$intr_rate=11.50;
				}
				
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{	
				if($hdfc_tenure<=36)
				{
					$intr_rate=11;
				}
				else if ($hdfc_tenure>36 && $hdfc_tenure<=60)
				{
					$intr_rate=10.75;
				}
				else if($hdfc_tenure>60 && $hdfc_tenure<=84)
				{
					$intr_rate=11;
				}
				
			}

		}
		else
		{
			if($hdfc_rate_segment=="A" || $hdfc_rate_segment=="MUV" || $hdfc_rate_segment=="B")
			{
				if($hdfc_tenure<=36)
				{
					$intr_rate=12.75;
				}
				else if ($hdfc_tenure>36 && $hdfc_tenure<=60)
				{
					$intr_rate=12.50;
				}
				else if($hdfc_tenure>60 && $hdfc_tenure<=84)
				{
					$intr_rate=12.75;
				}
			}
			else if ($hdfc_rate_segment=="C")
			{	
				if($hdfc_tenure<=36)
				{
					$intr_rate=12.25;
				}
				else if ($hdfc_tenure>36 && $hdfc_tenure<=60)
				{
					$intr_rate=12;
				}
				else if($hdfc_tenure>60 && $hdfc_tenure<=84)
				{
					$intr_rate=12.25;
				}
				
			}
			else if ($hdfc_rate_segment=="C+")
			{	
				if($hdfc_tenure<=36)
				{
					$intr_rate=11.75;
				}
				else if ($hdfc_tenure>36 && $hdfc_tenure<=60)
				{
					$intr_rate=11.50;
				}
				else if($hdfc_tenure>60 && $hdfc_tenure<=84)
				{
					$intr_rate=11.75;
				}
				
			}
			else if ($hdfc_rate_segment=="D" || $hdfc_rate_segment=="D+")
			{	
				if($hdfc_tenure<=36)
				{
					$intr_rate=11;
				}
				else if ($hdfc_tenure>36 && $hdfc_tenure<=60)
				{
					$intr_rate=10.75;
				}
				else if($hdfc_tenure>60 && $hdfc_tenure<=84)
				{
					$intr_rate=11;
				}
				
			}

		}
	}

	$ratesid[]= $intr_rate;
	return($ratesid);

} // Function HDFCcl rates only

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
 
list($print_term,$hdfcinter,$hdfcfinal_loanamt) = hdfccl_listdcomp($income,$age,$car_category,$car_segment,$hdfccl_comp_type,$hdfc_car_price, $hdfc_clid, $hdfc_car_rate_segment,$hdfc_city);

echo "term:".$print_term."<br>";
echo "interest:".$hdfcinter."<br>";
echo "loan amt: ".$hdfcfinal_loanamt."<br>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 

<link href="/style/slider.css" rel="stylesheet" type="text/css" />
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
</head>
<body>


<table cellpadding="0" cellspacing="0" border="0" align="center" class="font2">
<tr><td colspan="2" style="padding-bottom:10px;">

<script Language="JavaScript" Type="text/javascript" src="/scripts/tooltip.js"></script>
<link rel="stylesheet" href="/jsj/stylecalpl.css" type="text/css" media="screen" />
<script type='text/javascript' src='/jsj/jquery.min.js'></script>
<script type='text/javascript' src='/jsj/jquery-ui-slider.min.js'></script>
<script type='text/javascript' src='/jsj/globalize.min.js'></script>
<script type='text/javascript' src='/jsj/jquery.color.js'></script>
<script type='text/javascript' src='/jsj/superfish.js'></script>
<script type='text/javascript' src='/jsj/highcharts.js'></script>
<script type='text/javascript' src='/jsj/jquery.custom.min.pl1.js'></script>
</td></tr>
<tr><td width="604" lass="text" style="color:#4c4c4c; size:18px; height:37px;" colspan="2"  >

</td></tr>
<tr><td  style="padding-left:100px; font-weight:bold; padding-bottom:5px;" class="frmbldtxt" >To check exact Emi-Input your loan Amount/Tenure/rate of interest below. </td>
<td  class="text" style="color:#4c4c4c; size:18px; height:37px; padding-left:30px;"  ><span >Sample Results</span></td></tr>
<tr><td width="604" style="padding-left:100px;">			
<form id="calc_Form">
<div class="lamount" >
<strong>Principal Personal Loan Amount</strong>
Rs.
<input id="L_Amt" name="L_Amt" value="1,00,000" type="text"/>
</div>
<div id="loanamountslider"></div>
<div ><strong>Interest Rate</strong><input id="loan_intr" name="loan_intr" value="14.5" type="text"/><span><strong> % Per Annum</strong></span></div>
<div id="loan_intrslider"></div>
<div ><strong>Loan Term</strong><input id="tenure" name="tenure" value="4" type="text"/><input name="loantenure" id="tenure_years" value="tenure_years" checked type="radio" style="display:none;"/><span><strong> Years</strong></span></div>
<div class="clear"></div>
<div id="tenureslider"></div>
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
<div id="emibarchart"  class="highcharts-container"></div>
</td><td>
<div id="emipiechart" class="highcharts-container"></div> </td></tr>
<tr><td colspan="2">
<div id="emipaymenttable"></div>
</td></tr>

</table>
<script type='text/javascript' src='/jsj/ui.tabs.js'></script>


</body>
</html>