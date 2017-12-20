<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	$Name = $_POST['full_name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	
	$monthly_income = $_POST["income"];
	$income = $monthly_income * 12;
	$hdfc_city = $_POST["City"];
	$car_name = $_POST["car_name"];
	$company_name = $_POST["company_name"];
	$dd = $_POST["day"];
	$mm = $_POST["month"];
	$yyyy = $_POST["year"];
	$DOB = $yyyy."".$mm."".$dd;
	$age = DetermineAgeFromDOB($DOB);
	$DOB_Save = $yyyy."-".$mm."-".$dd;
	$Source = "hdfc_car_loan";
	$IP = getenv("REMOTE_ADDR");
	//$Employment_Status = $_POST['Employment_Status'];
	$Employment_Status = 1;
	$Reference_Code = generateNumber(4);
	$app_code = date('dmy')."".$Reference_Code;

	$insertSQl = "INSERT INTO hdfc_car_loan_leads (Name ,Mobile_Number ,Email ,City ,DOB ,Net_Salary , Company_Name ,Dated ,IP ,Source ,Loan_Amount ,Car_Model ,Car_Price, intr_rate, Tenure, Employment_Status,AppID) VALUES ( '".$Name."' ,'".$Phone."' ,'".$Email."' ,'".$hdfc_city."' ,'".$DOB_Save."' ,'".$income."','".$company_name."' ,Now() ,'".$IP."' ,'".$Source."' ,'".round($Loan_Amount)."' ,'".$car_name."' ,'".$hdfc_carprice."', '".$loan_intr."', '".$tenure."', '".$Employment_Status."', '".$app_code."')";
//	echo $insertSQl;
	$insertQuery = ExecQuery($insertSQl);
	$last_inserted_id = mysql_insert_id();

if(($age>=21 && $age<=59 ) && $income>=150000)
 {
	$p_arr[]="";
		$minrange="";
		$minrange1="";
$sqlcn = ExecQuery("Select hdfc_car_price,hdfc_car_manufacturer from hdfc_car_list_category Where hdfc_car_name='".$car_name."'");
$rowcn=mysql_fetch_array($sqlcn);
$sel_car_price = $rowcn["hdfc_car_price"];
$hdfc_car_manufacturer = $rowcn["hdfc_car_manufacturer"];
$p_arr = str_split($sel_car_price, 1);

$minrange.=$p_arr[0];

for($s=0;$s<count($p_arr)-1;$s++)
	 {
		$minrange1.="0";
	 }
	
$min_range=	$minrange."".$minrange1;
$max_range= ($minrange+1)."".$minrange1;

$sql_crnge = ExecQuery("Select hdfc_car_name from hdfc_car_list_category Where ((hdfc_car_price between '".$min_range."' and '".$max_range."') and hdfc_car_manufacturer not like '%".$hdfc_car_manufacturer."%') group by hdfc_car_manufacturer LIMIT 0,3");
while($rowcrnge=mysql_fetch_array($sql_crnge))
{
	$arrlistofcars[]=$rowcrnge["hdfc_car_name"];
}

 }

 $strlistcars = implode(",",$arrlistofcars);
 $strlistcarsnw = $car_name.",".$strlistcars;
$listofcars= explode(",",$strlistcarsnw);

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
	 $car_videocode[] = $row["car_videocode"];
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
	<script>
		
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
            font-size:30px;
            text-shadow:1px 1px 1px #fff;
            padding:20px;
        }

.sldrpnl{
	width:250px;
	height:50px;
	overflow:hidden;
	float:left;
	margin-left:15px;

}

#slider{
	width:250px;
	text-align:left;
	margin-left:50px;
	padding-top:10px;
}
#nextBtn a{ 
	background: url(../new-images/slider/right_arrow_hdfccl.gif) no-repeat left center;
}	

.verdblu12	ul li{	background: url("/new-images/bt-arrow.gif") no-repeat scroll 5px 5px transparent !important;
 font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 10px;    line-height: 15px;    list-style-type: none;       padding: 0 0 4px 12px;    text-align: left;
	}
</style>
</head><body>
    <table width="100%"><tr><td align="center">
       
            <!--<h1>HDFC Car Loan</h1>-->
			<table style="background: url(new-images/bckgrnd-hdfccl-scnd.gif) no-repeat; background-color:#F7F7F7;" width="929" height="560" align="center" border="0">
			<tr><td>&nbsp;</td></tr>
			<tr><td align="center" style="text-align:center; padding-top:15px;">
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
	$total_cost = ($emiPerLac*$tenure) + $processing_fee;
$total_interest = ($emiPerLac*$tenure) - $Loan_Amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;
$pfpercent= ($processing_fee / $total_cost) *100;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);
?>	<tr>
	      <td height="71" colspan="2" align="center" width="790">
		  <div  id="complete_div_<? echo $j; ?>">
		 <table width="100%" border="0" align="center">
<tr>
<td align="right">
<table border="0" width="100%" align="right">
<tr>
<td align="right"> 
<table width="90%" cellpadding="2" cellspacing="2">
<tr>
<td><? echo $car_videocode[$j];?></td>
<td>
<input type="hidden" value="<? echo round($maxLoan_Amount); ?>" name="nwLA_<? echo $j; ?>" id="nwLA_<? echo $j; ?>">
<input type="hidden" value="<? echo $tenure; ?>" name="nwtenu_<? echo $j; ?>" id="nwtenu_<? echo $j; ?>">
<input type="hidden" value="<? echo $hdfcinter; ?>" name="roi_<? echo $j; ?>" id="roi_<? echo $j; ?>">
<div align="center"><b>PIE CHART</b></div><? 
echo "http://chart.apis.google.com/chart?chs=250x100&cht=p3&chd=t:<? echo $lnpre; ?>,<? echo $inper; ?>&chxt=x,y&chds=0,<? echo $r; ?>&chxr=0,0,<? echo $r; ?>|<? echo $r; ?>,0,90&chxl=0:|<? echo $lnpre." %"; ?>|<? echo $inper." %"; ?>&chco=A2D7F6,F4E46C";
?>
<img src="http://chart.apis.google.com/chart?chs=250x100&cht=p3&chd=t:<? echo $lnpre; ?>,<? echo $inper; ?>&chxt=x,y&chds=0,<? echo $r; ?>&chxr=0,0,<? echo $r; ?>|<? echo $r; ?>,0,90&chxl=0:|<? echo $lnpre." %"; ?>|<? echo $inper." %"; ?>&chco=A2D7F6,F4E46C"/>
</td><td style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">
<img src="icici_car/amount_sign.gif" />&nbsp;Loan Amount -  <? echo "Rs. ".number_format($Loan_Amount);?>
<br />
<img src="icici_car/interest_sign.gif" />&nbsp;Interest Amount - <? echo "Rs. ".number_format($total_interest); ?>
<? if($maxLoan_Amount>1000000)
{
 ?><br><br>
<img src="new-images/cnct-wid-relmgr.gif" width="200" height="40" align="center">
<? } ?>

</td></tr>
</table>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td  style="padding-left:5px;"><table border="0" width="850" cellpadding="6" cellspacing="0" style="border:1px solid #999999;" height="60" >
<tr> 
<td align="center" height="30" class="verdbold12">Car Name</td>
<td align="center" height="30" class="verdbold12">Loan Amount</td><td align="center" height="30" class="verdbold12">Monthy EMI</td><td align="center" height="30" class="verdbold12">ROI</td><td align="center" height="30" class="verdbold12">Gift Options</td><td align="center" height="30" class="verdbold12">&nbsp;</td>
</tr>
<tr>
<td align="center" height="50"  class="verdblu12"><? echo $listofcars[$j] ;?></td>
<td align="center" height="50"  class="verdblu12"><? echo "Rs. ".number_format($Loan_Amount);?>

</td>

<td align="center" height="50"  class="verdblu12"><? echo "Rs. ".number_format($emiPerLac);?></td>

<td align="center" height="50"  class="verdblu12"><? echo $roi."\n";?></td>
<td height="50"  class="verdblu12" align="center"><div style="width:190px; height:40px;overflow:auto; font-size:10px; font-weight:normail; text-align:left;">
<? 
$imgbd='<a href="#" onclick="return popitup(\'/new-images/bluetooth_dev.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imgWrstWatch='<a href="#" onclick="return popitup(\'/new-images/polo_watch.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imggpsDev='<a href="#" onclick="return popitup(\'/new-images/gps_device.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imgDigitalPf='<a href="#" onclick="return popitup(\'/new-images/gps_device.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imggpsCarFridge='<a href="#" onclick="return popitup(\'/new-images/car_fridge.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';
$imgrbkSun='<a href="#" onclick="return popitup(\'/new-images/rbk_sunglasses.jpg\')"><img src="/new-images/img_indictr.gif" style="cursor:pointer;"></a>';



	if($Loan_Amount>2000000)
	{
		echo "GPS Device";
		$Referral = "GPS Device<br>";
	} 
	else if($Loan_Amount>=1000000 && $Loan_Amount<=2000000)
	{
		echo "Portable Car Fridge";
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
		echo "<ul><li>E- gift Voucher/cheque</li><li>Wrist Watch </li><li>Sunglasses</li><li>Wallets</li><li>Car air purifier</li></ul>";
		$Referral = "E- gift Voucher/cheque<br>Wrist watch <br>sunglasses<br>wallets<br>car air purifier";
	}
	?>
	</div>
</td>
<td align="center">
<input type="hidden" name="final_Referral_<? echo $j; ?>" id="final_Referral_<? echo $j; ?>" value="<? echo $Referral; ?>" >

<input type="hidden" name="final_total_interest_<? echo $j; ?>" id="final_total_interest_<? echo $j; ?>" value="<? echo $total_interest; ?>" >
<input type="hidden" name="final_roi_<? echo $j; ?>" id="final_roi_<? echo $j; ?>" value="<? echo $roi; ?>" >
<input type="hidden" name="final_emiPerLac_<? echo $j; ?>" id="final_emiPerLac_<? echo $j; ?>" value="<? echo $emiPerLac; ?>" >
<input type="hidden" name="final_Loan_Amount_<? echo $j; ?>" id="final_Loan_Amount_<? echo $j; ?>" value="<? echo $Loan_Amount; ?>" >
<!--<input type="image" name="submitMainForm"  src="new-images/get-apply-hdfccl.gif"  style="width:95px; height:26px; border:none; font-size:1px;" value="<?php //echo $countJ; ?>" />-->
<input type="submit" name="submitMainForm" style="border: 0px none ; background-image: url(new-images/get-apply-hdfccl.gif); width: 95px; height: 26px; margin-bottom: 0px; font-size:1px;" value="<?php echo $countJ; ?>"/>
<input name="now_sel" id="now_sel" value="<?php echo $countJ; ?>" checked type="radio" style="display:none;"/>


</td>
</tr>
</table></td></tr>
</table>
</td></tr></table>
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
            </div>
			</td></tr><tr><td align="center"><h3>Check out other options in same segment </h3></td></tr></table>
			 <!--<h3 style="padding-top:15px;">Check out other options in same segment </h3>-->
       
		</td></tr></table>
    </body>
</html>