<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	//$monthly_income = $_POST["income"];
	$income = $_POST["Net_Salary"];
	$hdfc_city = $_POST["City"];
	$car_name = $_POST["car_name"];
	$company_name = $_POST["company_name"];
	$dd = $_POST["dd"];
	$mm = $_POST["mm"];
	$yyyy = $_POST["yyyy"];
	$Pancard = $_POST["Pancard"];

	$DOB = $yyyy."".$mm."".$dd;
	$age = DetermineAgeFromDOB($DOB);
	$DOB_Save = $yyyy."-".$mm."-".$dd;
	$Source = "hdfc_car_loan";
	$IP = getenv("REMOTE_ADDR");
	//$Employment_Status = $_POST['Employment_Status'];
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDFC BANK | Deal4loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<script src="ICICI_CL/jquery-1.4.4.js"></script>
<style type="text/css"> 
<!-- 
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
	text-align: center; 
	color: #000000;
}
.twoColLiqRtHdr #container { 
	width: 91%;  
	background: #FFFFFF;
	margin: 0 auto; 
	border: 1px solid #000000;
	text-align: left; 
	margin-top:15px;
} 
.twoColLiqRtHdr #header { 
	background: #FFFFFF; 
	padding: 0px;
} 
.twoColLiqRtHdr #header h1 {
	margin: 0; 
	padding: 10px 0;
}

.twoColLiqRtHdr #mainContent { 
	margin: 0 0 0 10px;
	vertical-align:top;
	width:584px;
} 
.twoColLiqRtHdr #footer { 
	padding:10px; 
	background:#DDDDDD; 
} 
.twoColLiqRtHdr #footer p {
	margin: 0; 
	padding: 10px 0; 
}

.clearfloat {
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}
</style>
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
            font-size:30px;
            text-shadow:1px 1px 1px #fff;
            padding:20px;
        }


.verdblu12	ul li{	background: url("/new-images/bt-arrow.gif") no-repeat scroll 5px 5px transparent !important;
 font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 10px;    line-height: 15px;    list-style-type: none;       padding: 0 0 4px 12px;    text-align: left;
	}
</style>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
	<script src="scripts/hdfc_cljquery.js"></script>

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
	//		alert(queryString);
			
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
<body class="twoColLiqRtHdr" style="background-color:#FFFFFF; !important">
<div id="container">
  <div id="header" >
    <div style="background-color:#EAF3FC; padding:10px; color:#434242; font-family:Arial, Helvetica, sans-serif; font-size:17px; line-height:22px;" align="center"><b>HDFC Bank offers fastest loan processing for wide range of Car Models.</b> </div></div>
  <div id="wrapper">
                <div id="steps">
        <form id="formElem" name="formElem" action="hdfc-car-loan-app-continue12.php" method="POST">
<input type="hidden" name="last_inserted_id" id="last_inserted_id" value="<?php echo $last_inserted_id; ?>" readonly="readonly" />
<? 

for($j=0; $j<count($listofcars); $j++)
{
	$countJ = $j;
	?>
	 <fieldset class="step">
                            <legend><? echo $listofcars[$j]; ?></legend>
<table align="center" border="0" cellpadding="0" cellspacing="0" >
  <tbody><tr>
    <td>
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
	<table align="center" border="0" cellpadding="0" cellspacing="0" style="padding-left:10px;">
      <tbody>
	  
      <tr>
	  	  
        <td align="center" ><table border="0" cellspacing="0" cellpadding="0">
 <!--D4l Here-->
<? if($maxLoan_Amount>0)
{

?>
 <tr>
 <td width="600" align="center" valign="top" colspan="2">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		 
  <tr>
    <td>
	<input type="hidden" name="newj" id="newj" value="<? echo $j; ?>">
<input type="hidden" name="city" id="city" value="<? echo $hdfc_city; ?>">
<input type="hidden" name="car_name_<? echo $j; ?>" id="car_name_<? echo $j; ?>" value="<? echo $hdfc_clid[$j]; ?>">
<input type="hidden" name="comp_category" id="comp_category" value="<? if(strlen($hdfccl_comp_type)>0) { echo str_ireplace(" ", "_", $hdfccl_comp_type); } else { echo "0"; } ?>">
<input type="hidden" name="rate_category_<? echo $j; ?>" id="rate_category_<? echo $j; ?>" value="<? echo $hdfc_car_rate_segment[$j]; ?>">
<input type="hidden"  name="krc_flag" id="krc_flag" value="<? echo $krc_flag; ?>">
<input type="hidden"  name="ltv_36mths_<? echo $j; ?>" id="ltv_36mths_<? echo $j; ?>" value="<? echo $ltv_36months1[$j]; ?>">
<input type="hidden"  name="ltv_60mths_<? echo $j; ?>" id="ltv_60mths_<? echo $j; ?>" value="<? echo $ltv_60months1[$j]; ?>">
<input type="hidden"  name="ltv_84mths_<? echo $j; ?>" id="ltv_84mths_<? echo $j; ?>" value="<? echo $ltv_84onths1[$j]; ?>">
<input type="hidden"  name="hdfc_carprice_<? echo $j; ?>" id="hdfc_carprice_<? echo $j; ?>" value="<? if($hdfc_city=="Delhi") { echo $hdfc_car_price_delhi[$j]; } else { echo $hdfc_car_price[$j]; } ?>">
<table width="100%" cellpadding="0" border="0" cellspacing="0" height="50">
<tr><td width="300">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
     
	   <tr>
       <td width="62%" align="left"  class="verdblu13"> Eligible Loan Amount:</td>
       <td width="37%" align="right"><input type="text" id="amount_<? echo $j; ?>" style="border:0px; width:65px;" class="verdblu13" /></td>
	  
     </tr>
   </table></td></tr>
   <tr><td height="15">
<div id="slider-range-min_<? echo $j; ?>" onClick="newcompleteloanamt_div(<? echo $j; ?>);" onChange="newcompleteloanamt_div(<? echo $j; ?>);" onMouseUp="newcompleteloanamt_div(<? echo $j; ?>);" class="newdiv_<? echo $j; ?>"></div>
</td></tr>
   <tr><td  width="100%" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center">
     <tr>
       <td width="55%" class="verdblk9"><b>Min:</b> Rs.100000</td>
       <td width="50%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b;" align="right"><b>Max:</b>
         <input type="text" id="LA_dv_<? echo $j; ?>"  value="<? echo round($maxLoan_Amount); ?>" style="border:0px;font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b; width:50px;"/></td>
	   </tr>
  </table></td></tr>
</table></td>
<td width="80">&nbsp;</td>
<td width="300"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="62%" align="left"  class="verdblu13"> Tenure in month:</td>
      <td width="38%" align="right"><input type="text" id="amount1_<? echo $j; ?>" style="border:0;width:25px;" class="verdblu13"/></td>
    </tr>
  </table></td></tr>
   <tr><td>
<div id="slider-range-min1_<? echo $j; ?>" onClick="newcomplete_div(<? echo $j; ?>);" onChange="newcomplete_div(<? echo $j; ?>);" onMouseUp="newcomplete_div(<? echo $j; ?>);"></div>
</td></tr>
   <tr><td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="53%"  class="verdblk9"><b>Min:</b> 12 Months</td>
      <td width="47%"  class="verdblk9"><b>Max:</b> <? echo $tenure; ?>(Months)</td>
    </tr>
  </table></td></tr>
</table></td></tr>
</table> 
</td></tr></table>
</td>
  
  </tr>
<? }
	else
	{?>
	 <tr>
 <td width="626" align="center" valign="top">
	<table width="100%" cellpadding="0" cellspacing="0">
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
	/*$total_cost = ($emiPerLac*$tenure) + $processing_fee;
$total_interest = ($emiPerLac*$tenure) - $Loan_Amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;
$pfpercent= ($processing_fee / $total_cost) *100;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4); */
?>
<input type="hidden" value="<? echo round($maxLoan_Amount); ?>" name="nwLA_<? echo $j; ?>" id="nwLA_<? echo $j; ?>">
<input type="hidden" value="<? echo $tenure; ?>" name="nwtenu_<? echo $j; ?>" id="nwtenu_<? echo $j; ?>">
<input type="hidden" value="<? echo $hdfcinter; ?>" name="roi_<? echo $j; ?>" id="roi_<? echo $j; ?>">
<tr>
	      <td height="71" colspan="2" align="center" width="100%">
		  <div  id="complete_div_<? echo $j; ?>">

<table border="0" width="100%" align="right" style="padding-left:45px;">

<tr><td colspan="3">&nbsp;</td></tr>
<tr><td  style="padding-left:5px;"><table border="0" width="340" cellpadding="2" cellspacing="0" style="border:1px solid #999999;" height="60" >
<tr> 
<td width="125" height="30" align="center" class="verdbold12">Car Name</td>
<td width="197" height="40" align="center"  class="verdblu12"><? echo $listofcars[$j] ;?></td>
</tr>
<tr>
<td align="center" height="30" class="verdbold12">Loan Amount</td><td align="center" height="35"  class="verdblu12"><? echo "Rs. ".number_format($Loan_Amount);?></td></tr>
<tr>
<td align="center" height="30" class="verdbold12">Monthy EMI</td>
<td align="center" height="35"  class="verdblu12"><? echo "Rs. ".number_format($emiPerLac);?></td></tr>
<tr>
<td align="center" height="30" class="verdbold12">ROI</td>
<td align="center" height="35"  class="verdblu12"><? echo $roi."\n";?></td>
</tr>
<tr>
<td align="center" height="30" class="verdbold12">Gift Options</td>
<td height="50"  class="verdblu12" align="center"><div style="width:190px; height:40px;overflow:auto; font-size:10px; font-weight:normail; text-align:left;">
<? 
$imgbd='<a href="#" onclick="return popitup(\'/new-images/bluetooth_dev.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imgWrstWatch='<a href="#" onclick="return popitup(\'/new-images/polo_watch.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imggpsDev='<a href="#" onclick="return popitup(\'/new-images/gps_device.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imgDigitalPf='<a href="#" onclick="return popitup(\'/new-images/digital_pframe.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imggpsCarFridge='<a href="#" onclick="return popitup(\'/new-images/car_fridge.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imgrbkSun='<a href="#" onclick="return popitup(\'/new-images/rbk_sunglasses.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
	if($Loan_Amount>2000000)
	{
		echo "<ul><li>GPS Device ".$imggpsDev."</li></ul>";
		$Referral = "GPS Device<br>";
	} 
	else if($Loan_Amount>=1000000 && $Loan_Amount<=2000000)
	{
		echo "<ul><li>Portable Car Fridge ".$imggpsCarFridge."</li></ul>";
		$Referral = "Portable Car Fridge";		
	}
	else if($Loan_Amount>=500000 && $Loan_Amount<1000000)
	{
		//$img='<img src="new-images/img_indictr.gif" onclick="javascript:window.open(\'new-images/bluetooth_dev.jpg\')">';
		echo "<ul><li>Digital Key chain photo Frame".$imgDigitalPf." </li><li>Satya Paul combos tie/wallet/belts & cufflinks</li></ul>";
		$Referral = "Digital Key chain photo Frame<br>Satya Paul combos tie/wallet/belts & cufflinks";
	}
	else if($Loan_Amount>=300000 && $Loan_Amount<500000)
	{
		
		echo "<ul><li>Bluetooth Devices".$imgbd."</li><li>Wallet n Watch combos</li><li>Car Speaker</li></ul>";
		$Referral = "Bluetooth devices<br>	M/F wallet n wrist watch combos<br>	car speaker";
	}
	else 
	{
		echo "<ul><li>E- gift Voucher/cheque</li><li>Wrist Watch".$imgWrstWatch."</li><li>Sunglasses".$imgrbkSun."</li><li>Wallets</li><li>Car air purifier</li></ul>";
		$Referral = "E- gift Voucher/cheque<br>Wrist watch <br>sunglasses<br>wallets<br>car air purifier";
	}
	?>
	</div>
</td>

</tr>
</table></td>
<td>You tube Video</td>
<td><table border="1" width="340" cellpadding="2" cellspacing="0" style="border:1px solid #CCCCCC;" height="60" >
<tr> 
<td width="125" height="20" align="center" class="verdbold12">Make</td>
<td width="197" height="35" align="center"  class="verdblu12">audi</td>
</tr>
<tr>
<td align="center" height="20" class="verdbold12">Model</td><td align="center" height="50"  class="verdblu12">a4 sedan</td></tr>
<tr>
<td align="center" height="20" class="verdbold12">Variant</td>
<td align="center" height="35"  class="verdblu12">2.0 tdi</td></tr>
<tr>
<td align="center" height="20" class="verdbold12">Price</td>
<td align="center" height="35"  class="verdblu12">R 258,500</td>
</tr>
<tr>
<td align="center" height="20" class="verdbold12">Release Date</td>
<td height="35"  class="verdblu12" align="center">200502</td>
</tr>
</table></td></tr>
</table>

</div>
          </td>
		  
	  </tr>
	  <? } ?>
	
</tbody></table>
</td></tr>
</tbody>
</table>
</fieldset>
<? }//for loop
?>
                      
						
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
            </div></div>
</body>
</html>