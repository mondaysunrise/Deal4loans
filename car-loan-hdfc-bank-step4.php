<? 
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
include 'hdfccarloansfunctions.php';
//print_r($_REQUEST);
$last_inserted_id = $_REQUEST['id'];

$car_name = $_REQUEST['car_name'];
$sqlcn = "Select hdfc_car_name from hdfc_car_list_category Where hdfc_clid='".$car_name."'";
list($alreadyExist,$rowcn)=MainselectfuncNew($sqlcn,$array = array());
$car_name =  $rowcn[0]['hdfc_car_name'];

$getCustSql = "select * from hdfc_car_loan_leads where RequestID = '".$last_inserted_id."'";
list($alreadyExist,$getCustQuery)=MainselectfuncNew($getCustSql,$array = array());
$company_name =  $getCustQuery[0]['Company_Name'];
$DOB =  $getCustQuery[0]['DOB'];
$DOB_arr = explode("-",$DOB);
$income =  $getCustQuery[0]['Net_Salary'];
list($yyyy,$mm,$dd) = $DOB_arr;
$DOB = $yyyy."".$mm."".$dd;
$age = DetermineAgeFromDOB($DOB);

$hdfc_city=  $getCustQuery[0]['City'];
$Employment_Status=  $getCustQuery[0]['Employment_Status'];
$Experience=  $getCustQuery[0]['Total_Experience'];
$salary_account=  $getCustQuery[0]['salary_account'];
$Residence_Status=  $getCustQuery[0]['Residence_Status'];
$Resi_Stability=  $getCustQuery[0]['Resi_Stability'];

if($Residence_Status==1 || $Residence_Status==2)
		{
	$resi_stable = 2;
		}
		else
		{
	$resi_stable = $Resi_Stability;
		}

	$p_arr[]="";
	$minrange="";
	$minrange1="";
	//echo "Select hdfc_car_price,hdfc_car_manufacturer from hdfc_car_list_category Where hdfc_car_name='".$car_name."'";
$sqlcn = "Select hdfc_car_price,hdfc_car_manufacturer from hdfc_car_list_category Where hdfc_car_name='".$car_name."'";
list($alreadyExist,$rowcn)=MainselectfuncNew($sqlcn,$array = array());
$sel_car_price = $rowcn[0]["hdfc_car_price"];
$hdfc_car_manufacturer = $rowcn[0]["hdfc_car_manufacturer"];
$p_arr = str_split($sel_car_price, 1);

$minrange.=$p_arr[0];

for($s=0;$s<count($p_arr)-1;$s++)
	 {
		$minrange1.="0";
	 }
	
$min_range=	$minrange."".$minrange1;
$max_range= ($minrange+1)."".$minrange1;

$sql_crnge = "Select hdfc_car_name from hdfc_car_list_category Where ((hdfc_car_price between '".$min_range."' and '".$max_range."') and hdfc_car_manufacturer not like '%".$hdfc_car_manufacturer."%') group by hdfc_car_manufacturer LIMIT 0,3";
list($rowcrngeNR, $rowcrnge)=MainselectfuncNew($sql_crnge, $array = array());
for($i=0;$i<$rowcrngeNR;$i++)
{
	$arrlistofcars[]=$rowcrnge[$i]["hdfc_car_name"];
}

 $strlistcars = implode(",",$arrlistofcars);
 $strlistcarsnw = $car_name.",".$strlistcars;
$listofcars= explode(",",$strlistcarsnw);

$getcompdetails="Select * from hdfc_cl_companylist Where (hdfccl_comp_name='".$company_name."')";
list($rowcmpNR, $rowcmp)=MainselectfuncNew($getcompdetails, $array = array());

$hdfccl_comp_type = $rowcmp[0]["hdfccl_comp_type"];
$krc_flag = $rowcmp[0]["krc_flag"];


for($i=0; $i<count($listofcars); $i++)
{
	$getcardetails="Select * from hdfc_car_list_category Where (hdfc_car_name='".$listofcars[$i]."')";
	list($rowcmpNR1, $row)=MainselectfuncNew($getcompdetails, $array = array());
	$rowcontr = count($row)-1;
	$car_category[] = $row[$rowcontr]["hdfc_car_category"];
	$car_segment[] = $row[$rowcontr]["hdfc_car_segment"];
	$hdfc_clid[]= $row[$rowcontr]["hdfc_clid"];
	$hdfc_car_price[] = $row[$rowcontr]["hdfc_car_price"];
	$hdfc_car_price_delhi[] = $row[$rowcontr]["hdfc_car_price_delhi"];
	$hdfc_car_rate_segment[] = $row[$rowcontr]["hdfc_car_rate_segment"];
	$hdfc_car_name[] = $row[$rowcontr]["hdfc_car_name"];
	$ltv_36months1[] = $row[$rowcontr]["ltv_36months"];
	$ltv_60months1[] = $row[$rowcontr]["ltv_60months"];
	$ltv_84onths1[] = $row[$rowcontr]["ltv_84months"];
	$car_videocode[] = $row[$rowcontr]["car_videocode"];
	$Overall_Length[]= $row[$rowcontr]["Overall_Length"];
	$Power[]= $row[$rowcontr]["Power"];
	$Torque[]= $row[$rowcontr]["Torque"];
	$Seating_Capacity[]= $row[$rowcontr]["Seating_Capacity"];
	$Mileage[]= $row[$rowcontr]["Mileage"];
	$Top_Speed[]= $row[$rowcontr]["Top_Speed"];
	//Overall_Length 	Power 	Torque 	Seating_Capacity 	Mileage 	Top_Speed 	car_videocode
}//For loop


?>
<?php
//Use for CSS 

$getCarSql = "select * from hdfc_car_list_category where hdfc_car_name='".$car_name."'";
list($rowcmpNR2, $getCarQuery)=MainselectfuncNew($getCarSql, $array = array());
$hdfc_car_manufacturer = $getCarQuery[0]['hdfc_car_manufacturer'];
$hdfc_car_manufacturer_first = explode(" ", $hdfc_car_manufacturer);
$model1 = strtolower($hdfc_car_manufacturer_first[0]);
//$model1 = 'tata';
//$model1 = $_REQUEST['mm'];

//if($model1=="toyota" || $model1=="nissan" || $model1=="maruti" || $model1=="honda" || $model1=="mahindra" || $model1=="mercedes" || $model1=="volkswagen" || $model1=="hyundai" || $model1=="chevrolet" || $model1=="skoda" || $model1=="tata"  || $model1=="audi" || $model1=="fiat" || $model1=="premier" || $model1=="volvo" || $model1=="land")
//{
	if($model1=="land"){	$model = "landrover-"; }
	else if($model=="hindustan")
	{
		$model = "hindustan-motors-";
	}
	else { $model = $model1."-"; }
	//echo $model;

//}
if($model1=="toyota") { $bgColor = '2e87ef'; $bgColorhover = 'add0f8'; } //
else if($model1=="nissan") { $bgColor = '06a7b1'; $bgColorhover = 'aeccce'; }  //
else if($model1=="maruti") { $bgColor = '623dbe'; $bgColorhover = 'b2a9c8'; } //
else if($model1=="honda") { $bgColor = '07aa22'; $bgColorhover = '75ae7e'; } //
else if($model1=="mahindra") { $bgColor = '1f7982'; $bgColorhover = '8dacaf'; } //
else if($model1=="mercedes") { $bgColor = 'db552f'; $bgColorhover = 'f2c6b9'; } //
else if($model1=="volkswagen") { $bgColor = 'af1b40'; $bgColorhover = 'd1899b'; } //
else if($model1=="hyundai") { $bgColor = 'db552f'; $bgColorhover = 'f2c6b9'; } //
else if($model1=="chevrolet") { $bgColor = '5da81a'; $bgColorhover = 'adcd91'; } //
else if($model1=="skoda") { $bgColor = '623dbe'; $bgColorhover = 'b2a9c8'; } //
else if($model1=="tata") { $bgColor = '2e87ef'; $bgColorhover = 'add0f8'; } //
else if($model1=="audi") {  $bgColor = '623dbe'; $bgColorhover = 'b2a9c8'; }//
else if($model1=="fiat") { $bgColor = '5da81a'; $bgColorhover = 'adcd91'; } //
else if($model1=="premier") { $bgColor = '06a7b1'; $bgColorhover = 'aeccce'; }//
else if($model1=="volvo") { $bgColor = '06a7b1'; $bgColorhover = 'aeccce'; }//
else if($model1=="land") { $bgColor = 'db552f'; $bgColorhover = 'f2c6b9'; }//
else if($model1=="ford") { $bgColor = '043361'; $bgColorhover = '7791aa'; } //
else if($model1=="jaguar") { $bgColor = '043361'; $bgColorhover = '7791aa'; } //
else if($model1=="mitsubishi") { $bgColor = 'db891d'; $bgColorhover = 'f6ce9a'; } //
else if($model1=="bmw") { $bgColor = 'db891d'; $bgColorhover = 'f6ce9a'; } //
else if($model1=="hindustan") {  $bgColor = 'a9b21b'; $bgColorhover = 'dfe57b'; }//
else if($model1=="renault") { $bgColor = '661758'; $bgColorhover = 'c470b5'; } //
else if($model1=="porsche") { $bgColor = '94af4e'; $bgColorhover = 'e0f5ab'; }//
else { $bgColor = '1160BC'; $bgColorhover = 'A2B8DF'; } 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deal4loans.com</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src="https://www.deal4loans.com/images/car_hdfc/jquery-1.8.3.min.js"></script>
	<script src="https://www.deal4loans.com/hdfc_cl/jquery.ui.widget.js"></script>
	<script src="https://www.deal4loans.com/hdfc_cl/jquery.ui.mouse.js"></script>
	<script src="https://www.deal4loans.com/hdfc_cl/jquery.ui.slider.js"></script> 
	<script src="https://www.deal4loans.com/scripts/hdfc_cljquery_new.js"></script>
    <script type="text/javascript" src="https://www.deal4loans.com/sliding.form.js"></script>
<link href="hdfc_car/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://www.deal4loans.com/hdfc_cl/base/jquery.ui.all.css"> 
<link rel="stylesheet" href="https://www.deal4loans.com/css/hdfc-slider-nwinternalhttps.css" type="text/css" media="screen"/>
<link href="https://www.deal4loans.com/tata-motors-formint.css" rel="stylesheet" type="text/css">
	<!--[if IE 6]>
<style type="text/css">
#scroll{position:relative;}
#scroll a{position:relative;}
</style>
<![endif]-->
    <style>
#navigation{
    height:50px;
    background-color:#<?php echo $bgColor; ?>;
    border-top:1px solid #fff;
    -moz-border-radius:0px 0px 10px 10px;
    -webkit-border-bottom-left-radius:10px;
    -webkit-border-bottom-right-radius:10px;
    border-bottom-left-radius:10px;
    border-bottom-right-radius:10px;
}
#navigation ul{
    list-style:none;
	float:left;
	margin-left:22px;
}
#navigation ul li{
	float:left;
	width:237px;
    border-right:1px solid #ccc;
    border-left:1px solid #ccc;
    position:relative;
	margin:0px 2px;
}
#navigation ul li a{
    display:block;
    height:50px;
    background-color:#1160BC;
    color:#404042;
    outline:none;
    font-weight:bold;
    text-decoration:none;
    line-height:25px;
    padding:0px 20px;
    border-right:1px solid #fff;
    border-left:1px solid #fff;
    background:#F0EFD2;
    background:
        -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0.09, rgb(240,240,240)),
        color-stop(0.55, rgb(227,227,227)),
        color-stop(0.78, rgb(240,240,240))
        );
    background:
        -moz-linear-gradient(
        center bottom,
        rgb(240,240,240) 9%,
        rgb(227,227,227) 55%,
        rgb(240,240,240) 78%
        );
}
#navigation ul li a:hover,
#navigation ul li.selected a{
    background:#<?php echo $bgColorhover; ?>;
    color:#666;
    text-shadow:1px 1px 1px #fff;
}

.eligibility{ font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;}
</style>
<!--<link rel="stylesheet" href="../demos.css">-->
<script Language="JavaScript">
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
var krcFlag=document.getElementById('krc_flag').value;
var compCategory=document.getElementById('comp_category').value;
var tenure=document.getElementById('amount1_'+ i).value;
var nwLA = document.getElementById('amount_'+ i).value;
var carName=document.getElementById('car_name_'+ i).value;
var model = document.getElementById('model').value;

var queryString = "?nwLA=" + nwLA +"&tenure=" + tenure + "&countr=" + countr + "&hdfcCity=" + hdfcCity + "&krcFlag=" + krcFlag + "&compCategory=" + compCategory + "&carName=" + carName + "&model=" + model;
		//alert(queryString);	
 $('#complete_div_'+ i).html('');
  $('#complete_div_'+ i).html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="http://www.deal4loans.com/new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div_'+ i).load("hdfc_get_tenure_eligibilityint.php" + queryString);

}

function newcompleteloanamt_div(i)
{
var countr=i;
var nwLA = document.getElementById('amount_'+ i).value;
var tenure = document.getElementById('amount1_'+ i).value;
var carName = document.getElementById('car_name_'+ i).value;
var roiamt = document.getElementById('roi_'+ i).value;
var model = document.getElementById('model').value;


var queryString = "?nwLA=" + nwLA +"&tenure=" + tenure + "&carName=" + carName + "&roiamt=" + roiamt + "&countr=" + countr + "&model=" + model;
	//alert(queryString);
 $('#complete_div_'+ i).html('');
  $('#complete_div_'+ i).html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="http://www.deal4loans.com/new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div_'+ i).load("get_hdfc_car_loanamt_calcint.php" + queryString);
}

function selectReward(i)
{
	var last_inserted_id=document.getElementById('last_inserted_id').value;
	var queryString = "?last_inserted_id=" + last_inserted_id +"&reward_selected=" + i;
	//alert(queryString); 
	ajaxRequestMain.open("GET", "update_hdfc_reward.php" + queryString, true);
// Create a function that will receive data sent from the server
	ajaxRequestMain.onreadystatechange = function(){
		if(ajaxRequestMain.readyState == 4)
		{
			//alert(ajaxRequestMain.responseText);
			//document.getElementById('Activate').value=ajaxRequestMain.responseText;
		}
	}

ajaxRequestMain.send(null); 
}

window.onload = ajaxFunctionMain;

function popitup(url) {
	newwindow=window.open(url,'name','height=130,width=200');
	if (window.focus) {newwindow.focus()}
	return false;
}

function submitToNew (i)
{
//	alert(i);
	var last_inserted_id=document.getElementById('last_inserted_id').value;
	var queryString = "?id=" + last_inserted_id +"&car_name=" + i;
	window.open("car-loan-hdfc-bank-step4.php"+ queryString ,"_self");

}
	</script>
    
</head>

<body>
<table border="0" style="width:100%;" align="center">
<tr><td align="center">
<table border="0" width="1000" align="center">
<tr><td width="300"><img src="images/newimages/hdfc-logo-white.jpg" border="0" height="85" width="190"></td><td><img src="images/newimages/eligibility-check-serial-number.jpg" border="0" width="627" height="84" /></td></tr>
<tr><td colspan="2">
<div class="main-continer">
<div id="wrapper" align="center">
  <div id="steps">
<form id="formElem" name="formElem" action="car-loan-hdfc-bank-thanks.php" method="POST">    
      <input type="hidden" name="last_inserted_id" id="last_inserted_id" value="<?php echo $last_inserted_id; ?>" readonly />
      <? 
$lnAmt = '';
$carM = array('Maruti ', 'Nissan ','Renault ', 'Honda ', 'Mahindra ', 'Toyota', 'Hyundai ', 'Tata ', 'Chevrolet ', 'Porsche ', 'Mercedes ', 'Force ', 'Land Rover ', 'Premier ', 'Jaguar ', 'Mitsubishi ', 'Ford ', 'Audi ', 'Bmw ', 'Skoda ', 'Fiat ', 'Volvo ', 'Volkswagen ','Indica ' );
for($j=0; $j<=count($listofcars); $j++)
{
	$getvediodetails="Select * from hdfc_car_list_category Where (hdfc_clid='".$hdfc_clid[$j]."')";
	list($rowcmpNR3, $resultvedio)=MainselectfuncNew($getvediodetails, $array = array());

	$car_videocode = $resultvedio[0]['car_videocode'];
	$car_videocode = str_replace('http','https', $car_videocode);
	$hdfc_car_model = $resultvedio[0]['hdfc_car_model'];
	$countJ = $j;
	 if($hdfc_city=="Delhi") { $showex_p=$hdfc_car_price_delhi[$j]; } else { $showex_p=$hdfc_car_price[$j]; } 
	?>
      <fieldset class="step">
        
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF;">
        <tr>
          <td valign="top" style="padding-left:10px;" >
      <span style="font-size:22px; color:#000000; font-weight:bold;"><? echo $listofcars[$j]; ?></span><br> <span style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#969798; font-weight:bold;"><? echo "( Ex showroom price : Rs.".$showex_p." )" ?></span>
          </td>
          <td  style="padding-left:10px;" >
          <?php 
		
//		  if($j==0)
		 // {
		
			$getLowestSql = "select * from hdfc_car_list_category where hdfc_car_model = '".$hdfc_car_model."' and hdfc_car_name!='".$listofcars[$j]."' order by hdfc_car_price";
			list($getLowestNum, $getLowestQuery)=MainselectfuncNew($getLowestSql, $array = array());
			if($getLowestNum>0)
			{
		  ?>
         <table width="716" border="0" cellpadding="3" cellspacing="0" style="border:thin solid #7f7f7f ;">
          
          <tr><td ><img src="images/newimages/<?php echo $model; ?>eligibility-check.jpg" width="300" height="24" /></td></tr>
          <tr><td>
          <table cellpadding="0" >
          <tr>
        <?php
		for($k=0;$k<$getLowestNum;$k++)
		{
			$count = $k%4;
			$nhdfc_car_name = $getLowestQuery[$k]['hdfc_car_name'];	
			$nhdfc_clid = $getLowestQuery[$k]['hdfc_clid'];				
			?>
                  <td width="25%" >
                  <table ><tr><td>
                  <input type="radio" name="checkNewCar" id="checkNewCar" value="<?php echo $nhdfc_clid; ?>" onClick="return submitToNew(this.value);" ></td><td class="eligibility"> <?php echo str_replace($carM, "", $nhdfc_car_name); ?></td></tr></table></td>
            <?php
			if($i!=0 && $count==3)
			{
				echo "</tr><tr>";
			}
		}
		  ?>
          </tr></table>
          </td></tr>
          
          </table>
          <?php
		  }
		  ?>
          
          </td>
          </tr>
        <tr>
          <td valign="top" style="padding-left:2px; height:200px;" ><div class="Car-specification-right">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="25" style=" background:url(images/newimages/<?php echo $model; ?>specification-bg.jpg) repeat-x;"class="white_text">Car Video</td
	>
                <tr>
                <tr>
                  <td  style="background:url(images/newimages/<?php echo $model; ?>specification.jpg) repeat-x;"><table width="100%" border="0" cellpadding="0" cellspacing="0" height="190">
                      <tr>
                        <td colspan="2" class="text_car_body" align="center" ><iframe width="224" height="190" src="<?php echo $car_videocode; ?>" frameborder="0" allowfullscreen></iframe></td>
                      </tr>
                  </table></td>
                </tr>
              </table>
          </div></td>
          <td style="padding-top:10px;"><? 
		  
		if($hdfc_city=="Delhi")
	 {
		 
$hdfc_carprice=$hdfc_car_price_delhi[$j];
	 }
	 else
	 {
		$hdfc_carprice=$hdfc_car_price[$j];
	 }
list($tenure,$print_term,$hdfcinter,$maxLoan_Amount) = hdfccl_listdcomp($income,$age,$car_category[$j],$car_segment[$j],$hdfccl_comp_type,$hdfc_carprice, $hdfc_clid[$j], $hdfc_car_rate_segment[$j],$hdfc_city, $hdfc_car_name[$j], $Employment_Status , $Experience, $salary_account, $resi_stable,$krc_flag );

//echo "d".$Employment_Status."<br>";
$alac=$maxLoan_Amount;
$intr=$hdfcinter/1200;
$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $tenure))));
  $maxTenure=$tenure;
	 $Loan_Amount=$maxLoan_Amount;
	 $roi=$hdfcinter." %";
	$lnAmt[] = $maxLoan_Amount;
 

?>
              <table width="732px" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="4"><input type="hidden" name="newj" id="newj" value="<? echo $j; ?>" />
                  <input type="hidden" name="model" id="model" value="<? echo $model; ?>" />
                      <input type="hidden" name="untouched_la_<? echo $j; ?>" id="untouched_la_<? echo $j; ?>" value="<? echo round($alac); ?>" />
                      <input type="hidden" name="untouched_ten_<? echo $j; ?>" id="untouched_ten_<? echo $j; ?>" value="<? echo $maxTenure; ?>" />
                      <input type="hidden" name="city" id="city" value="<? echo $hdfc_city; ?>" />
                      <input type="hidden" name="car_name_<? echo $j; ?>" id="car_name_<? echo $j; ?>" value="<? echo $hdfc_clid[$j]; ?>" />
                      <input type="hidden" name="comp_category" id="comp_category" value="<? if(strlen($hdfccl_comp_type)>0) { echo str_ireplace(" ", "_", $hdfccl_comp_type); } else { echo "0"; } ?>" />
                      <input type="hidden" name="rate_category_<? echo $j; ?>" id="rate_category_<? echo $j; ?>" value="<? echo $hdfc_car_rate_segment[$j]; ?>" />
                      <input type="hidden"  name="krc_flag" id="krc_flag" value="<? echo $krc_flag; ?>" />
                      <input type="hidden"  name="hdfc_carprice_<? echo $j; ?>" id="hdfc_carprice_<? echo $j; ?>" value="<? if($hdfc_city=="Delhi") { echo $hdfc_car_price_delhi[$j]; } else { echo $hdfc_car_price[$j]; } ?>" /></td>
                </tr>
                <tr>
                  <td height="2" colspan="4" ><table width="100%" cellpadding="0" border="0" cellspacing="0" height="50">
                      <tr>
                        <td width="300" align="center"><table width="85%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="62%" align="left"  class="<?php echo $model; ?>heading_text_slider"> Eligible Loan Amount:</td>
                                    <td width="37%" align="right"  class="<?php echo $model; ?>heading_text_slider"><input name="text" type="text" class="<?php echo $model; ?>heading_text_slider_box" id="amount_<? echo $j; ?>" style="border:0px; width:65px;"  /></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="15"><div id="slider-range-min_<? echo $j; ?>" onClick='newcompleteloanamt_div("<? echo $j; ?>")' onchange='newcompleteloanamt_div("<? echo $j; ?>")' onMouseUp='newcompleteloanamt_div("<? echo $j; ?>")' class="newdiv_<? echo $j; ?>"></div></td>
                            </tr>
                            <tr>
                              <td  width="100%" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center">
                                  <tr>
                                    <td width="55%" class="verdblk9" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b; padding-top:10px;"><b>Min:</b> Rs.100000</td>
                                    <td width="50%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b; padding-top:10px;" align="right"><b>Max:</b>
                                        <input name="text" type="text" id="LA_dv_<? echo $j; ?>" style="border:0px;font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b; width:50px;"  value="<? echo round($maxLoan_Amount); ?>"/></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                        <td width="30">&nbsp;</td>
                        <td width="300"><table width="74%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="27"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="62%" align="left" class="<?php echo $model; ?>heading_text_slider"> Tenure in month:</td>
                                    <td width="37%" align="right" class="<?php echo $model; ?>heading_text_slider"><input name="text" type="text" class="<?php echo $model; ?>heading_text_slider_box" id="amount1_<? echo $j; ?>" style="border:0;width:25px;"/></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="15"><div id="slider-range-min1_<? echo $j; ?>" onClick='newcomplete_div("<? echo $j; ?>")' onchange='newcomplete_div("<? echo $j; ?>")' onMouseUp='newcomplete_div("<? echo $j; ?>")'></div></td>
                            </tr>
                            <tr>
                              <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="55%"  class="verdblk9" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b; padding-top:10px;"><b>Min:</b> 12 Months</td>
                                    <td width="50%"  class="verdblk9" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b; padding-top:10px;" align="right"><b>Max:</b> <? echo $tenure; ?>(Months)</td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
            <!--    <tr>
                  <td colspan="4" height="10"></td>
                </tr>
             -->    <tr>
                  <td width="100%" colspan="3"><div  id="complete_div_<? echo $j; ?>">
                      <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>&nbsp;</td>
                          <td colspan="2" ><!--<div class="<?php echo $model; ?>car-specification-center"> -->
                            <div class="<?php echo $model; ?>slider-section_b">
                              <input type="hidden" value="<? echo round($maxLoan_Amount); ?>" name="nwLA_<? echo $j; ?>" id="nwLA_<? echo $j; ?>" />
                              <input type="hidden" value="<? echo $tenure; ?>" name="nwtenu_<? echo $j; ?>" id="nwtenu_<? echo $j; ?>" />
                              <input type="hidden" value="<? echo $hdfcinter; ?>" name="roi_<? echo $j; ?>" id="roi_<? echo $j; ?>" />
                              
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="44%" height="30" align="center" class="text-car-name" style="border-right:#FFFFFF thin solid;	 border-bottom:#FFFFFF thin solid; ">Car Name</td>
        <td width="20%" align="center" class="text-car-name" style="border-right:#FFFFFF thin solid;	 border-bottom:#FFFFFF thin solid; ">Loan Amount</td>
        <td width="21%" align="center" class="text-car-name" style="border-right:#FFFFFF thin solid;	 border-bottom:#FFFFFF thin solid; ">Monthly EMI</td>
        <td width="15%" align="center" style="border-bottom:#FFFFFF thin solid; "><span class="text-car-name">ROI</span></td>
      </tr>
      <tr>
        <td height="55" align="center" class="text-car-heading" style="border-right:#FFFFFF thin solid;"><? echo $listofcars[$j] ;?></td>
        <td height="50" align="center" class="text-car-heading" style="border-right:#FFFFFF thin solid;"><? echo "Rs. ".number_format($Loan_Amount);?></td>
        <td height="50" align="center" class="text-car-heading" style="border-right:#FFFFFF thin solid;"><? echo "Rs. ".number_format($emiPerLac);?></td>
        <td height="50" align="center" class="text-car-heading"><? echo $roi."\n";?></td>
      </tr>
    </table>
                                                    
                          </div>
                              <div style="width:670px; height:11px; background:url(new-images/form-bg-shadow.jpg);"></div></td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td width="63%" align="left"><a href="#"></a></td>
                          <td width="35%" align="center">&nbsp;                          </td>
                          <td>&nbsp;</td>
                        </tr>
                
                      </table>
                  </div></td>
                </tr>
                
              </table></td>
        </tr>
        
       
     
        </td></tr>
    <tr><td>&nbsp;</td><td  align="right" style="padding-top:10px;">
<input type="hidden" name="final_Referral_<? echo $j; ?>" id="final_Referral_<? echo $j; ?>" value="<? echo $Referral; ?>" >
                              <input type="hidden" name="final_total_interest_<? echo $j; ?>" id="final_total_interest_<? echo $j; ?>" value="<? echo $total_interest; ?>" >
                              <input type="hidden" name="final_roi_<? echo $j; ?>" id="final_roi_<? echo $j; ?>" value="<? echo $roi; ?>" >
                              <input type="hidden" name="final_emiPerLac_<? echo $j; ?>" id="final_emiPerLac_<? echo $j; ?>" value="<? echo $emiPerLac; ?>" >
                              <input type="hidden" name="final_Loan_Amount_<? echo $j; ?>" id="final_Loan_Amount_<? echo $j; ?>" value="<? echo $Loan_Amount; ?>" >
                              <input type="submit" name="submitMainForm" style="border: 0px none ; background-image: url(images/newimages/<?php echo $model; ?>select-and-apply.jpg); width: 223px; height: 45px; margin-bottom: 0px; font-size:1px;" value="<?php echo $countJ; ?>"/>
                              <input name="now_sel" id="now_sel" value="<?php echo $countJ; ?>" checked type="radio" style="display:none;"/>&nbsp;
</td></tr>
      
        </table>
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
                    </ul>
    </div>
	<div align="center" style="padding-top:5px;"> <h3 class="body_text_b_nw" style="font-size:13px;" >Check out other options in same segment    </h3></div>
</div><!--wrapper div ends here--><div style="clear:both;"></div>
<div style="width:100%; height:28px; background:url(images/newimages/<?php echo $model; ?>specification-bg.jpg) repeat-x; margin: auto; margin-top:5px; text-align:right;"><a href="hdfc-terms-conditions.php" style="color:#000000; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;" target="_blank">Terms & Conditions</a>&nbsp;</div></div>
</td></tr><tr><td colspan="2" align="right"><img src="images/newimages/powered_by_deal4loans_text.png" height="18" width="186" border="0"></td></tr></table>
</td></tr></table>
</body>
</html>
