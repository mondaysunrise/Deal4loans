<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'carLoanCalc.php';

//$leadid = $_REQUEST['leadid'];
//$strCity =  $_REQUEST['city'];
//$leadid = 165893;
//$strCity =  "Delhi";

$cl_requestid = $_REQUEST['cl_requestid'];
$cl_bank_name = $_REQUEST['cl_bank_name'];
$leadid = $_REQUEST['cl_requestid'];


if (strlen($cl_bank_name)>1 && $cl_requestid>1)
{
	$selqry="select CL_Bank from Req_Loan_Car Where RequestID=".$cl_requestid;
	list($Getnum,$plrow)=Mainselectfunc($selqry,$array = array());
$cl_banks=$plrow['CL_Bank'];

if(strlen($cl_banks)>1)
	{
		$newpl_banks= $cl_banks.",".$cl_bank_name;
		//$plupdate= "Update Req_Loan_Car  set CL_Bank='".$newpl_banks."' Where (Req_Loan_Car.RequestID=".$cl_requestid.")";
		
		$DataArray = array("CL_Bank" =>$newpl_banks);
		$wherecondition ="(Req_Loan_Car.RequestID=".$cl_requestid.")";
	}
	else
	{
		//$plupdate= "Update Req_Loan_Car  set CL_Bank='".$cl_bank_name."' Where (Req_Loan_Car.RequestID=".$cl_requestid.")";
		$DataArray = array("CL_Bank" =>$cl_bank_name);
		$wherecondition ="(Req_Loan_Car.RequestID=".$cl_requestid.")";

	
	}
	Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);

}

$getUsrDetailsSql = "select * from Req_Loan_Car where RequestID	= '".$leadid."'";
list($Getnum,$ArrRow)=Mainselectfunc($getUsrDetailsSql,$array = array());

$income = $ArrRow['Net_Salary'];
$DOB = $ArrRow['DOB'];
$City = $ArrRow['City'];
$Car_Varient = $ArrRow['Car_Varient'];
$Employment_Status = $ArrRow['Employment_Status'];
$company_name = $ArrRow['Company_Name'];
$Car_Type = $ArrRow['Car_Type'];
$DOB_arr = explode("-",$DOB);
list($yyyy,$mm,$dd) = $DOB_arr;
$DOB_Str = $yyyy."".$mm."".$dd;
$Experience = $ArrRow['Total_Experience'];

$Residence_Status=  $ArrRow['Residence_Status'];
$Resi_Stability=  $ArrRow['Residence_Stability'];

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

list($Getnum,$rowcmp)=Mainselectfunc($getcompdetails,$array = array());
$hdfccl_comp_type = $rowcmp["hdfccl_comp_type"];
$krc_flag = $rowcmp["krc_flag"];

	$getcardetails="Select * from hdfc_car_list_category Where hdfc_clid='".$Car_Varient."'";
	list($Getnum,$row)=Mainselectfunc($getcardetails,$array = array());
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
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title>Thank you Car Loan</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript" src="scripts/mootools.js"></script>
<style type="text/css">
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
color:#000000;
}
</style>

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

function selectReward(i)
{
	var last_inserted_id=<?php echo $leadid; ?>;
	var queryString = "?last_inserted_id=" + last_inserted_id +"&reward_selected=" + i;

	ajaxRequestMain.open("GET", "updatehdfcReqCL.php" + queryString, true);
// Create a function that will receive data sent from the server
	ajaxRequestMain.onreadystatechange = function(){
		if(ajaxRequestMain.readyState == 4)
		{
			alert(ajaxRequestMain.responseText);
			//document.getElementById('Activate').value=ajaxRequestMain.responseText;
		}
	}

ajaxRequestMain.send(null); 
}

window.onload = ajaxFunctionMain;
</script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply Car Loan</span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto;">
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
		
		?>
		 <div align="center" style="font-size:13px; padding:5px;"><b><font color="#3366CC">Exclusive Offer<span style="color:#FF0000;">*</span> : Special Reward on your Loan disbursal from HDFC Bank Car Loan</font></b> </div>
         <div class="overflow-width">
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
		
			 <?php
             if(trim($Final_Bid[$i])=="HDFC")
			{
				list($hdfc_tenure,$hdfc_print_term,$hdfc_inter,$hdfc_Loan_Amount) =  hdfccl_listdcomp($income,$age,$car_category,$car_segment,$hdfccl_comp_type,$hdfc_car_price, $hdfc_clid, $hdfc_car_rate_segment,$City, $hdfc_car_name, $Employment_Status , $Experience, $salary_account, $resi_stable, $krc_flag,$Car_Type);
				$alac=$hdfc_Loan_Amount;
				$intr=$hdfc_inter/1200;
				$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $hdfc_tenure))));
				if($hdfc_Loan_Amount>100000)
				{
			?>  <tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
            <td colspan="5"  bgcolor="#FFFFFF" ><table cellpadding="0" cellspacing="2" width="956" align="center"><tr>
                 <td class="fontbld10" align="center" height="55" style="font-size:12px; background-color:#FFF;" width="160">
					<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" /><br />HDFC Bank</td>
					<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" width="170"><?php echo $hdfc_inter; ?>%</td>
					<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" width="150">Rs.<?php echo round($hdfc_Loan_Amount); ?>/-</td>
					<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" width="150">Rs.<?php echo round($emiPerLac); ?>/-</td>
					<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" width="130"><?php echo $hdfc_print_term; ?> years</td>
                    
               </tr>
               <tr><td colspan="5" >
               <table width="960" border="0" cellpadding="0" cellspacing="0">
               <tr>
                 <td colspan="5" style="font-size:14px; padding-left:3px; padding-top:3px; padding-bottom:3px;  color:#5A1FF8;"><strong>Choose your preferred reward from the below : </strong></td>
               </tr>
          <tr><?php
	$getGiftsSql = "SELECT * FROM hdfc_car_loan_gifts WHERE ".$hdfc_Loan_Amount." >= min_range AND ".$hdfc_Loan_Amount." < max_range AND status=1 ORDER BY RAND()";	
		 list($numGiftsQuery,$getGiftsQuery)=MainselectfuncNew($getGiftsSql,$array = array());
		if($numGiftsQuery>0)
		{
			if($numGiftsQuery>6)
			{
				$numGiftsQuery = 6;
			}
			for($gS=0;$gS<$numGiftsQuery;$gS++)
			{
				$id = $getGiftsQuery[$gS]['id'];
				$Name = $getGiftsQuery[$gS]['Name'];
				$image = $getGiftsQuery[$gS]['image'];
				$specifications = $getGiftsQuery[$gS]['specifications'];
				echo '<td align="center" width="158">';
				echo '<table><tr><td align="center" valign="top" ><input type="radio" name="reward_selected" id="reward_selected" value="'.$id.'" onClick="selectReward(this.value);">&nbsp;';	
				?>		
				 <img src='images/brochure/<?php echo $image; ?>' border=0 height=80 width=80 style="border:#333333 1px solid;" />
	
				<?php
			echo "</td></tr><tr><td align='center' valign='top' style='font-size:10px; color:#000;'>";
				echo $Name;
				echo '</td></tr>';
				echo '</table></td>';
			}
		}
		?>
       </tr>
  <tr><td colspan="5"  bgcolor="#FFFFFF">&nbsp;</td></tr>
</table>

               </td></tr>
             
               </table></td></tr>
                 <tr><td colspan="5"><a href="terms-conditions-hdfc.php" class="text12" target="_blank">Term & Conditions Apply</a><span style="color:#FF0000;">*</span></td></tr>
               <?php }
					else
					{
						?>
					<tr>
                    	<td class="fontbld10" align="center" height="45" style="font-size:12px; background-color:#FFF;"><img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" /><br /><? echo trim($Final_Bid[$i]); ?></td>
                      
						<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;">11.50% - 14.25%</td>
                        <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
                          <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
                        <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td></tr>
						<?php
					}
			}
		
            ?>
		
		<?	}
		?>
		
		</table>
	</div>
	<? }

	
	?>
<div style="padding-top:25px; text-align:left; vertical-align:top"></div>
 </div>
</div>
<div style="padding-top:25px; text-align:left; vertical-align:top"></div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>