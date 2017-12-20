<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	echo "ff".$Employment_Status = $_POST["Employment_Status"];
	$Residence_Status = $_POST["Residence_Status"];
	$Experience = $_POST["Experience"];
	$income = $_POST["Net_Salary"];]
	$Resi_Stability = $_POST["Resi_Stability"];
if($Residence_Status==1 && $Residence_Status==2)
		{
	$resi_stable = 2;
		}
		else
		{
	$resi_stable = $Resi_Stability;
		}
	$hdfc_city = $_POST["City"];
	$car_name = $_POST["car_name"];
	$company_name = $_POST["Company_Name"];
	$dd = $_POST["dd"];
	$mm = $_POST["mm"];
	$yyyy = $_POST["yyyy"];
	
	$DOB = $yyyy."".$mm."".$dd;
	$age = DetermineAgeFromDOB($DOB);
	$DOB_Save = $yyyy."-".$mm."-".$dd;
	$Source = "hdfc_car_loan";
	$IP = getenv("REMOTE_ADDR");
	$Employment_Status = 1;
	$Reference_Code = generateNumber(4);
	$app_code = date('dmy')."".$Reference_Code;


$Dated = ExactServerdate();	
	$data = array('Name'=>$Name, 'Mobile_Number'=>$Phone, 'Email'=>$Email, 'City'=>$hdfc_city, 'DOB'=>$DOB_Save, 'Net_Salary'=>$income, 'Company_Name'=>$company_name, 'Dated'=>$Dated, 'IP'=>$IP, 'Source'=>$Source, 'Loan_Amount'=>round($Loan_Amount), 'Car_Model'=>$car_name, 'Car_Price'=>$hdfc_carprice, 'intr_rate'=>$loan_intr, 'Tenure'=>$tenure, 'Employment_Status'=>$Employment_Status, 'AppID'=>$app_code);
	$last_inserted_id = Maininsertfunc ('hdfc_car_loan_leads', $data);

if(($age>=21 && $age<=59 ) && $income>=150000)
 {
	$p_arr[]="";
		$minrange="";
		$minrange1="";
	$sqlcn = "Select hdfc_car_price,hdfc_car_manufacturer from hdfc_car_list_category Where hdfc_car_name='".$car_name."'";
	list($alreadyExist,$rowcn)=MainselectfuncNew($sqlcn,$array = array());
	$rowcncontr=count($rowcn)-1;
	$sel_car_price = $rowcn[$rowcncontr]["hdfc_car_price"];
	$hdfc_car_manufacturer = $rowcn[$rowcncontr]["hdfc_car_manufacturer"];
	$p_arr = str_split($sel_car_price, 1);

	$minrange.=$p_arr[0];

	for($s=0;$s<count($p_arr)-1;$s++)
	 {
		$minrange1.="0";
	 }
	
$min_range=	$minrange."".$minrange1;
$max_range= ($minrange+1)."".$minrange1;

$sql_crnge = "Select hdfc_car_name from hdfc_car_list_category Where ((hdfc_car_price between '".$min_range."' and '".$max_range."') and hdfc_car_manufacturer not like '%".$hdfc_car_manufacturer."%') group by hdfc_car_manufacturer LIMIT 0,3";
list($countCarsExists,$rowcrnge)=MainselectfuncNew($sql_crnge,$array = array());
$arrlistofcars='';
for($i=0;$i<$countCarsExists;$i++)
{
	$arrlistofcars[]=$rowcrnge[$i]["hdfc_car_name"];
}

 }

 $strlistcars = implode(",",$arrlistofcars);
 $strlistcarsnw = $car_name.",".$strlistcars;
$listofcars= explode(",",$strlistcarsnw);

$getcompdetails="Select * from hdfc_cl_companylist Where (hdfccl_comp_name='".$company_name."')";
list($alreadyExist,$resultcomp)=MainselectfuncNew($getcompdetails,$array = array());
$resultcompcontr=count($resultcomp)-1;
$hdfccl_comp_type = $resultcomp[$resultcompcontr]["hdfccl_comp_type"];
$krc_flag = $resultcomp[$resultcompcontr]["krc_flag"];

for($i=0; $i<count($listofcars); $i++)
{
	$getcardetails="Select * from hdfc_car_list_category Where (hdfc_car_name='".$listofcars[$i]."')";
		list($resultExist,$row)=MainselectfuncNew($getcardetails,$array = array());
	$resultcontr=count($row)-1;
	
	$car_category[] = $row[$resultcontr]["hdfc_car_category"];
	$car_segment[] = $row[$resultcontr]["hdfc_car_segment"];
	$hdfc_clid[]= $row[$resultcontr]["hdfc_clid"];
	$hdfc_car_price[] = $row[$resultcontr]["hdfc_car_price"];
	$hdfc_car_price_delhi[] = $row[$resultcontr]["hdfc_car_price_delhi"];
	$hdfc_car_rate_segment[] = $row[$resultcontr]["hdfc_car_rate_segment"];
	$hdfc_car_name[] = $row[$resultcontr]["hdfc_car_name"];
	$ltv_36months1[] = $row[$resultcontr]["ltv_36months"];
	$ltv_60months1[] = $row[$resultcontr]["ltv_60months"];
	$ltv_84onths1[] = $row[$resultcontr]["ltv_84months"];
	$car_videocode[] = $row[$resultcontr]["car_videocode"];
	$Overall_Length[]= $row[$resultcontr]["Overall_Length"];
	$Power[]= $row[$resultcontr]["Power"];
	$Torque[]= $row[$resultcontr]["Torque"];
	$Seating_Capacity[]= $row[$resultcontr]["Seating_Capacity"];
	$Mileage[]= $row[$resultcontr]["Mileage"];
	$Top_Speed[]= $row[$resultcontr]["Top_Speed"];
	 // 	Overall_Length 	Power 	Torque 	Seating_Capacity 	Mileage 	Top_Speed 	car_videocode
}//For loop
}//$_POST


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
				//echo "not eligible";
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
				//echo "not eligible";
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
				//echo "not eligible";
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
				//echo "not eligible";
			}
	}
//rate with LTV

$getltv="select ltv_36months,ltv_60months,ltv_84months From hdfc_car_list_category Where (hdfc_clid='".$hdfc_clid."')";
list($resultExist,$rowltv)=MainselectfuncNew($getltv,$array = array());
$rowltvcontr=count($rowltv)-1;
	
	$ltv_36 = $rowltv[$rowltvcontr]["ltv_36months"];
	$ltv_60 = $rowltv[$rowltvcontr]["ltv_60months"];
	$ltv_84 = $rowltv[$rowltvcontr]["ltv_84months"];



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

if($ltvterm>$term)
	{
		$nwterm=$ltvterm;
	}
	else {
$nwterm=$ltvterm;
	}

if(($final_ltvmount>0 && $loan_amount>0) && ($final_ltvmount>$loan_amount))
		{
			 $final_loanamt = $loan_amount;
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
 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deal4loans.com</title>
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<!--<script src="ICICI_CL/jquery.ui.core.js"></script>-->
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script> 
	<script src="scripts/hdfc_cljquery.js"></script>
    <script type="text/javascript" src="sliding.form.js"></script>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css"> 
	  <link rel="stylesheet" href="css/hdfc-slider-nw.css" type="text/css" media="screen"/>
<link href="css/hdfc_thnkstyle.css" rel="stylesheet" type="text/css" />

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
var countr=i;
var hdfcCity=document.getElementById('city').value;
var compCategory=document.getElementById('comp_category').value;
var krcFlag=document.getElementById('krc_flag').value;
var tenure=document.getElementById('amount1_'+ i).value;
var carprice = document.getElementById('hdfc_carprice_'+ i).value;
var ltv_36 = document.getElementById('ltv_36mths_'+ i).value;
var ltv_60 = document.getElementById('ltv_60mths_'+ i).value;
var carName=document.getElementById('car_name_'+ i).value;
var ltv_84 = document.getElementById('ltv_84mths_'+ i).value;

var queryString = "?hdfcCity=" + hdfcCity +"&compCategory=" + compCategory + "&krcFlag=" + krcFlag + "&tenure=" + tenure + "&carprice=" + carprice + "&ltv_36=" + ltv_36 + "&ltv_60=" + ltv_60 + "&ltv_84=" + ltv_84 + "&carName=" + carName + "&countr=" + countr;
			//alert(queryString);
			
 $('#complete_div_'+ i).html('');
  $('#complete_div_'+ i).html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div_'+ i).load("get_hdfc_car_loan_calc1.php" + queryString);

}

function newcompleteloanamt_div(i)
{
var countr=i;
var nwLA = document.getElementById('amount_'+ i).value;
var tenure = document.getElementById('amount1_'+ i).value;
var carName = document.getElementById('car_name_'+ i).value;
var roiamt = document.getElementById('roi_'+ i).value;

var queryString = "?nwLA=" + nwLA +"&tenure=" + tenure + "&carName=" + carName + "&roiamt=" + roiamt + "&countr=" + countr;
	//alert(queryString);
 $('#complete_div_'+ i).html('');
  $('#complete_div_'+ i).html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div_'+ i).load("get_hdfc_car_loanamt_calc.php" + queryString);
}

window.onload = ajaxFunctionMain;

function popitup(url) {
	newwindow=window.open(url,'name','height=130,width=200');
	if (window.focus) {newwindow.focus()}
	return false;
}
	</script>
</head>

<body><div class="main-continer">
<div class="navy-header"><div style=" padding:20px 0px 0px 0px;"><span class="navy-body_text_a">HDFC Bank offers you complete package of timely service,</span>
    <br />
    <span class="navy-body_text_b">Competitive rates & Competent guidance </span><span class="navy-body_text_c">along with 100% finance on select models.</span></div>	</div>

<div id="wrapper" align="center">
    <div id="steps">
<form id="formElem" name="formElem" action="hdfc-carloan-app-continue.php" method="POST">
        <input type="hidden" name="last_inserted_id" id="last_inserted_id" value="<?php echo $last_inserted_id; ?>" readonly="readonly" />
		<? 

for($j=0; $j<=count($listofcars); $j++)
{
	$countJ = $j;
	 if($hdfc_city=="Delhi") { $showex_p=$hdfc_car_price_delhi[$j]; } else { $showex_p=$hdfc_car_price[$j]; } 
	?>
	 <fieldset class="step">
                            <legend><? echo $listofcars[$j]; ?> <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#969798; font-weight:bold;"><? echo "( Ex showroom price : Rs.".$showex_p." )" ?></span></legend>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF;">
<tr>
  <td valign="top" style="padding-left:10px;" ><div class="Car-specification-right">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" style=" background:url(new-images/specification-bg.jpg) repeat-x;"class="white_text">Specifications</td
	><tr>
       <tr>
      <td  style="background:url(new-images/hdfcapp/specification-bg1.jpg) repeat-x;"><table width="100%" border="0" cellpadding="4" cellspacing="2">
  <tr>
    <td width="112" height="30" class="text_car_body" style="border-right:1px solid #FFFFFF;">Overall Length</td>
    <td width="97" class="text_car_body"><? echo $Overall_Length[$j]; ?></td>
  </tr>
  <tr>
    <td height="30" class="text_car_body" style="border-right:1px solid #FFFFFF;">Power</td>
    <td class="text_car_body"><? echo $Power[$j]; ?></td>
  </tr>
  <tr>
    <td height="30" class="text_car_body" style="border-right:1px solid #FFFFFF;">Torque</td>
    <td class="text_car_body"><? echo $Torque[$j]; ?></td>
  </tr>
  <tr>
    <td height="30" class="text_car_body" style="border-right:1px solid #FFFFFF;">Seating Capacity</td>
    <td class="text_car_body"><? echo $Seating_Capacity[$j]; ?></td>
  </tr>
  <tr>
    <td height="40" class="text_car_body" style="border-right:1px solid #FFFFFF;" >Mileage</td>
    <td class="text_car_body"><? echo $Mileage[$j]; ?></td>
  </tr>
  <tr>
    <td height="30" class="text_car_body" style="border-right:1px solid #FFFFFF;" >Top Speed</td>
    <td class="text_car_body"><? echo $Top_Speed[$j]; ?></td>
  </tr>
</table></td>
       </tr>
  </table>
</div></td>
  
      <td style="padding-top:10px;">
<? if(($age>=21 && $age<=59 ) && $income>=150000)
 {
		if($hdfc_city=="Delhi")
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

 }
 else
	{

	}

?>
  <table width="732px" border="0" cellpadding="0" cellspacing="0">
  
    <tr>
      <td height="2" colspan="4" ><table width="100%" cellpadding="0" border="0" cellspacing="0" height="50">
<tr>
<td width="300" align="center"><table width="85%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="62%" align="left"  class="text_car_head_txt"> Eligible Loan Amount:</td>
<td width="37%" align="right"><input type="hidden" name="newj" id="newj" value="<? echo $j; ?>" />
<input type="hidden" name="city" id="city" value="<? echo $hdfc_city; ?>" />
<input type="hidden" name="car_name_<? echo $j; ?>" id="car_name_<? echo $j; ?>" value="<? echo $hdfc_clid[$j]; ?>" />
<input type="hidden" name="comp_category" id="comp_category" value="<? if(strlen($hdfccl_comp_type)>0) { echo str_ireplace(" ", "_", $hdfccl_comp_type); } else { echo "0"; } ?>" />
<input type="hidden" name="rate_category_<? echo $j; ?>" id="rate_category_<? echo $j; ?>" value="<? echo $hdfc_car_rate_segment[$j]; ?>" />
<input type="hidden"  name="krc_flag" id="krc_flag" value="<? echo $krc_flag; ?>" />
<input type="hidden"  name="ltv_36mths_<? echo $j; ?>" id="ltv_36mths_<? echo $j; ?>" value="<? echo $ltv_36months1[$j]; ?>" />
<input type="hidden"  name="ltv_60mths_<? echo $j; ?>" id="ltv_60mths_<? echo $j; ?>" value="<? echo $ltv_60months1[$j]; ?>" />
<input type="hidden"  name="ltv_84mths_<? echo $j; ?>" id="ltv_84mths_<? echo $j; ?>" value="<? echo $ltv_84onths1[$j]; ?>" />
<input type="hidden"  name="hdfc_carprice_<? echo $j; ?>" id="hdfc_carprice_<? echo $j; ?>" value="<? if($hdfc_city=="Delhi") { echo $hdfc_car_price_delhi[$j]; } else { echo $hdfc_car_price[$j]; } ?>" />
<input name="text" type="text" class="verdblu13" id="amount_<? echo $j; ?>" style="border:0px; width:65px;" /></td>
</tr>
</table></td>
</tr>
<tr>
<td height="15"><div id="slider-range-min_<? echo $j; ?>" onclick='newcompleteloanamt_div("<? echo $j; ?>")' onchange='newcompleteloanamt_div("<? echo $j; ?>")' onmouseup='newcompleteloanamt_div("<? echo $j; ?>")' class="newdiv_<? echo $j; ?>"></div></td>
</tr>
<tr>
<td  width="100%" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
<td width="55%" class="verdblk9"><b>Min:</b> Rs.100000</td>
<td width="50%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b;" align="right"><b>Max:</b>
<input name="text" type="text" id="LA_dv_<? echo $j; ?>" style="border:0px;font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b; width:50px;"  value="<? echo round($maxLoan_Amount); ?>"/></td>
</tr>
</table></td>
</tr>             </table></td>
                                      <td width="30">&nbsp;</td>
                                      <td width="300"><table width="74%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="62%" align="left" class="text_car_head_txt"> Tenure in month:</td>
                                                  <td width="38%" align="right"><input name="text" type="text" class="verdblu13" id="amount1_<? echo $j; ?>" style="border:0;width:25px;"/></td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td><div id="slider-range-min1_<? echo $j; ?>" onclick='newcomplete_div("<? echo $j; ?>")' onchange='newcomplete_div("<? echo $j; ?>")' onmouseup='newcomplete_div("<? echo $j; ?>")'></div></td>
                                          </tr>
                                          <tr>
                                            <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="53%"  class="verdblk9"><b>Min:</b> 12 Months</td>
                                                  <td width="47%"  class="verdblk9"><b>Max:</b> <? echo $tenure; ?>(Months)</td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                      </table></td>
                                    </tr>
                                </table></td>
      </tr>
    <tr>
      <td width="1%">&nbsp;</td>
      <td colspan="2"><table width="732" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3" height="25">&nbsp;</td>
          </tr>        
      </table></td>
      <td width="1%">&nbsp;</td>
    </tr>
	<tr><td width="100%" colspan="3">
	 <div  id="complete_div_<? echo $j; ?>">
	<table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
      <td colspan="2" ><div class="Car-specification-center">
	  
	   <input type="hidden" value="<? echo round($maxLoan_Amount); ?>" name="nwLA_<? echo $j; ?>" id="nwLA_<? echo $j; ?>" />
              <input type="hidden" value="<? echo $tenure; ?>" name="nwtenu_<? echo $j; ?>" id="nwtenu_<? echo $j; ?>" />
              <input type="hidden" value="<? echo $hdfcinter; ?>" name="roi_<? echo $j; ?>" id="roi_<? echo $j; ?>" />
        <table width="95%"  align="center" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td width="130" height="30" class="white_text" style="border-bottom:1px solid #FFFFFF;">Car Name</td>
            <td width="145" class="white_text" style="border-bottom:1px solid #FFFFFF;">Loan Amount</td>
            <td width="133"  class="white_text" style="border-bottom:1px solid #FFFFFF;">Monthy EMI</td>
            <td width="85" class="white_text" style="border-bottom:1px solid #FFFFFF;">ROI</td>
            <td width="180" class="white_text" style="border-bottom:1px solid #FFFFFF;">Car video</td>
          </tr>
          <tr>
            <td height="60" class="text_car_body" align="center"><? echo $listofcars[$j] ;?></td>
            <td align="center"><span class="text_car_body" ><? echo "Rs. ".number_format($Loan_Amount);?></span></td>
            <td align="center"><span class="text_car_body"><? echo "Rs. ".number_format($emiPerLac);?></span></td>
            <td align="center"><span class="text_car_body"><? echo $roi."\n";?></span></td>
            <td class="text_car_body" align="center"><? //echo $car_videocode[$j]; ?>                                  </td>
          </tr>
         
        </table>
      </div>
	       <div style="width:670px; height:11px; background:url(new-images/form-bg-shadow.jpg);"></div>      </td>
      <td>&nbsp;</td>
    </tr>
   
    <tr>
      <td>&nbsp;</td>
      <td width="63%" align="left"><a href="#"></a></td>
      <td width="35%" align="center"><input type="hidden" name="final_Referral_<? echo $j; ?>" id="final_Referral_<? echo $j; ?>" value="<? echo $Referral; ?>" >

<input type="hidden" name="final_total_interest_<? echo $j; ?>" id="final_total_interest_<? echo $j; ?>" value="<? echo $total_interest; ?>" >
<input type="hidden" name="final_roi_<? echo $j; ?>" id="final_roi_<? echo $j; ?>" value="<? echo $roi; ?>" >
<input type="hidden" name="final_emiPerLac_<? echo $j; ?>" id="final_emiPerLac_<? echo $j; ?>" value="<? echo $emiPerLac; ?>" >
<input type="hidden" name="final_Loan_Amount_<? echo $j; ?>" id="final_Loan_Amount_<? echo $j; ?>" value="<? echo $Loan_Amount; ?>" >
<input type="submit" name="submitMainForm" style="border: 0px none ; background-image: url(new-images/btn-getinstant-app.jpg); width: 186px; height: 49px; margin-bottom: 0px; font-size:1px;" value="<?php echo $countJ; ?>"/>
<input name="now_sel" id="now_sel" value="<?php echo $countJ; ?>" checked type="radio" style="display:none;"/>
</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </div>
  </td></tr></table>
  </td></tr></table>
  </fieldset>
<? }//for loop
?>
  </form>
  </div>
  <div id="navigation" style="display:none; vertical-align:top; padding-top:-100px;">
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
	<div align="center"> <h3 class="body_text_b_nw" >Check out other options in same segment </h3></div>
	<div align="center" class="body_text_nw" style="padding-top:15px;" ><table width="800" style="border:#CCCCCC thin solid;"align="center" cellpadding="0" cellspacing="0">
       <tr>
          <td height="25" colspan="5" align="center" valign="middle" style="background:url(new-images/specification-bg.jpg) repeat-x;" class="text_car_body" s>Welcome Rewards</td>
        </tr>
        <tr>
          <td width="112" height="25" align="center" valign="middle" class="text_car_head">Bluetooth devices</td>
          <td width="128" height="25" align="center" valign="middle"><span class="text_car_head">Digital Key Pad</span></td>
          <td width="124" height="25" align="center" valign="middle"><span class="text_car_head">Portable Car Fridge </span></td>
          <td width="124" height="25" align="center" valign="middle"><span class="text_car_head">GPS Device </span></td>
          <td width="108" height="25" align="center" valign="middle"><span class="text_car_head">GPS Device </span></td>
        </tr>
        <tr>
          <td align="center"><table width="87%" align="center" cellspacing="0" style="border:#CCCCCC thin solid;" cellpadding="0">
              <tr>
                <td align="center"><img src="new-images/slider/bluetooth.jpg" width="96" height="77" /></td>
              </tr>
          </table></td>
          <td align="center"><table width="95%" align="center" cellspacing="0" style="border:#CCCCCC thin solid;" cellpadding="0">
              <tr>
                <td align="center"><img src="new-images/slider/digitalkeypad.jpg" width="96" height="75" /></td>
              </tr>
          </table></td>
          <td align="center"><table width="95%" align="center" cellspacing="0" style="border:#CCCCCC thin solid; " cellpadding="0">
              <tr>
                <td align="center"><img src="new-images/slider/portable-fridge.jpg" width="96" height="75" /></td>
              </tr>
          </table></td>
          <td align="center"><table width="95%" align="center" cellspacing="0" style="border:#CCCCCC thin solid;" cellpadding="0">
              <tr>
                <td align="center"><img src="new-images/slider/gps-device.jpg" width="96" height="77" /></td>
              </tr>
          </table></td>
          <td align="center"><table width="95%" align="center" cellspacing="0" style="border:#CCCCCC thin solid;" cellpadding="0">
              <tr>
                <td align="center"><img src="new-images/slider/polo-wrist-watch.jpg" width="96" height="77" /></td>
              </tr>
          </table></td>
        </tr>
        
       
      </table></div>
</div><div style="clear:both;"></div>
<div class="navy-footer"></div></div>
</body>
</html>
