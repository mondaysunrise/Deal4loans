<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'carLoanCalc.php';

$leadid = $_REQUEST['leadid'];
$strCity =  $_REQUEST['city'];
//$leadid = 163381;
//$strCity =  "Delhi";

$getUsrDetailsSql = "select * from Req_Loan_Car where RequestID	= '".$leadid."'";
list($getDetailsNumRows,$getUsrDetailsQuery)=MainselectfuncNew($getUsrDetailsSql,$array = array());

$income = $getUsrDetailsQuery[0]['Net_Salary'];
$DOB = $getUsrDetailsQuery[0]['DOB'];
$City = $getUsrDetailsQuery[0]['City'];
$Car_Varient = $getUsrDetailsQuery[0]['Car_Varient'];
$Employment_Status = $getUsrDetailsQuery[0]['Employment_Status'];
$company_name = $getUsrDetailsQuery[0]['Company_Name'];
$Car_Type = $getUsrDetailsQuery[0]['Car_Type'];
$DOB_arr = explode("-",$DOB);
list($yyyy,$mm,$dd) = $DOB_arr;
$DOB_Str = $yyyy."".$mm."".$dd;
$Experience = $getUsrDetailsQuery[0]['Total_Experience'];

$Residence_Status=  $getUsrDetailsQuery[0]['Residence_Status'];
$Resi_Stability=  $getUsrDetailsQuery[0]['Residence_Stability'];

if($Residence_Status==1 || $Residence_Status==2)
{
	$resi_stable = 2;
}
else
{
	$resi_stable = $Resi_Stability;
}


$age = DetermineAgeFromDOB($DOB_Str);

$getcompdetails="Select * from hdfc_cl_companylist Where (hdfccl_comp_name='".$company_name."')";
list($getNumRows,$rowcmp)=Mainselectfunc($getcompdetails,$array = array());

$hdfccl_comp_type = $rowcmp["hdfccl_comp_type"];
$krc_flag = $rowcmp["krc_flag"];


	$getcardetails="Select * from hdfc_car_list_category Where hdfc_clid='".$Car_Varient."'";
	list($getNumRows,$row)=Mainselectfunc($getcardetails,$array = array());
	$car_category = $row["hdfc_car_category"];
	$car_segment = $row["hdfc_car_segment"];
	$hdfc_clid= $row["hdfc_clid"];
	$hdfc_car_price = $row["hdfc_car_price"];
	$hdfc_car_price_delhi = $row["hdfc_car_price_delhi"];
	$hdfc_car_rate_segment = $row["hdfc_car_rate_segment"];
	$hdfc_car_name = $row["hdfc_car_name"];
	$magma_car_rate_segment = $row["magma_car_rate_segment"];
	$magma_list = $row["magma_list"];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Thank you Car Loan</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
color:#000000;
}
</style>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply Car Loan</span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
  <div align="center"><b><font color="#3366CC">Thanks for applying Car Loan through Deal4loans.com. </font></b></div>
<?
list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$leadid,$strCity);
$arrFinal_Bid = "";
		while (list ($key,$val) = @each($realbankiD)) { 
			$arrFinal_Bid[]= $val; 
		} 

$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
			asort($Final_Bid);
			$comma_separated_Bidders = implode(",", $Final_Bid);
			$Final_Bid = explode(",", $comma_separated_Bidders);
			
$strFinalBidder = implode(",",$FinalBidder);

	if(count($Final_Bid)>0)
	{ 
		$Dated = ExactServerdate();
		$DataArray = array("Bidderid_Details"=>$strFinalBidder , "Allocated"=>'2', "Dated"=>$Dated );
		$wherecondition ="(RequestID=".$leadid.")";
		Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);
		?>
		 <div align="center"><b><font color="#3366CC"><br />You will get a call from the below mentioned Banks.</font></b> <br><br /></div>
		<table cellpadding="0" cellspacing="2" width="840" align="center" style="border:1px #dbf2ff solid; background-color:#dbf2ff;">
        <tr> <td class="fontbld10" align="left" height="35" style="font-size:12px; padding-left:5px; background-color:#FFF;" colspan="5" >
           <span style="font-weight:normal;">You had selected </span> <strong><?php echo $hdfc_car_name; ?></strong>, <span style="font-weight:normal;">Price:</span> <strong>Rs. <?php echo $hdfc_car_price; ?>/-</strong>.
            </td></tr>
			<tr>
			<td bgcolor="#4FAADE" class="fontbld10" align="center" height="45" style=" font-size:13px;" width="190">Bank Name</td>
            <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style=" font-size:13px;" width="140">Interest Rate</td>
            <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style=" font-size:13px;" width="150">Maximum Eligible Loan Amount</td>
            <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style=" font-size:13px;" width="150">Monthly EMI</td>    <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style="font-size:13px;" width="160">Maximum Tenure            </td>
	
				</tr>
		<? for($i=0;$i<count($Final_Bid);$i++)
			{ 
			
			?>
		<tr>
			 <?php
             if(trim($Final_Bid[$i])=="HDFC")
			{
				list($hdfc_tenure,$hdfc_print_term,$hdfc_inter,$hdfc_Loan_Amount) =  hdfccl_listdcomp($income,$age,$car_category,$car_segment,$hdfccl_comp_type,$hdfc_car_price, $hdfc_clid, $hdfc_car_rate_segment,$City, $hdfc_car_name, $Employment_Status , $Experience, $salary_account, $resi_stable, $krc_flag,$Car_Type);
				$alac=$hdfc_Loan_Amount;
				$intr=$hdfc_inter/1200;
				$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $hdfc_tenure))));
				if($hdfc_Loan_Amount>100000)
				{
					?>                   
                     <td class="fontbld10" align="center" height="55" style="font-size:12px; background-color:#FFF;" >
					<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" /><br />HDFC Bank</td>
					<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;"><?php echo $hdfc_inter; ?>%</td>
					<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;">Rs.<?php echo round($hdfc_Loan_Amount); ?>/-</td>
					<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;">Rs.<?php echo round($emiPerLac); ?>/-</td>
					<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;"><?php echo $hdfc_print_term; ?> years</td>
					<?php	
					}
					else
					{
						?>
						<td class="fontbld10" align="center" height="45" style="font-size:12px; background-color:#FFF;"><img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" /><br /><? echo trim($Final_Bid[$i]); ?></td>
                      
						<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;">11.50% - 14.25%</td>
                        <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
                          <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
                        <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
						<?php
					}
			}
			else if($Final_Bid[$i] =="Magma Fincorp")
			{
				list($magma_tenure,$magma_print_term,$magma_inter,$magma_Loan_Amount) =  magmaCalulation($income,$age,$car_category,$magma_car_rate_segment,$hdfc_car_price, $hdfc_clid, $magma_car_rate_segment,$City, $hdfc_car_name, $Employment_Status);
					
				$alac=$magma_Loan_Amount;
				$intr=$magma_inter/1200;
				$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $magma_tenure))));
				if($magma_Loan_Amount>100000)
				{
				?>
				<td class="fontbld10" align="center" height="45" style="font-size:12px; background-color:#FFF;">Magma Fincorp</td>
                <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;"><?php echo $magma_inter; ?>%</td>
                <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">Rs.<?php echo round($magma_Loan_Amount); ?>/-</td>
                <td class="fontbld10" align="center" style=" background-color:#FFF; font-size:12px;">Rs.<?php echo round($emiPerLac); ?>/-</td>
                <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;"><?php echo $magma_print_term; ?> years</td>
                <?php
				}
				else
				{
				?>
				<td class="fontbld10" align="center" height="45" style="font-size:12px; background-color:#FFF;"><? echo trim($Final_Bid[$i]); ?></td>
            <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
			<td class="fontbld10" align="center" colspan="2" style="font-size:12px; background-color:#FFF;">Get Quote on call from Bank</td>
            <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
				<?php
				}
				
			}	
            else
            {
            ?>
			<td class="fontbld10" align="center" height="45" style="font-size:12px; background-color:#FFF;"><? echo trim($Final_Bid[$i]); ?></td>
            <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
			<td class="fontbld10" align="center" colspan="2" style="font-size:12px; background-color:#FFF;">Get Quote on call from Bank</td>
            <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
            <?php
            }
            ?>
			
			</tr>	
		<?	}
		?>
		
		</table>
	
	<? }

	
	?>

 </div>
</div>

</body>
</html>