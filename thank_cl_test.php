<?php
ob_start();
require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'carLoanCalc.php';
//print_r($_REQUEST);

$city = $_SESSION['City'];
$leadid = $_SESSION['Temp_LID'];
$leadid = 165893;
$other_city = $_SESSION['City_Other'];
$rchtime = $_REQUEST['rchtime'];
$Reference_Code = $_REQUEST["Reference_Code"];
$activation_code = $_REQUEST["activation_code"];

$Residence_Status = $_REQUEST['Residence_Status'];
$Residence_Stability = $_REQUEST['Resi_Stability'];
$Car_Varient = $_REQUEST['car_model'];
$Total_Experience = $_REQUEST['total_experience'];

$getCarNameSql = "SELECT hdfc_clid,hdfc_car_name FROM hdfc_car_list_category WHERE hdfc_clid='".$Car_Varient."'";
list($getCarNumRows,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());

$Car_Model = $getCarNameQuery[0]['hdfc_car_name'];

if($Reference_Code == $activation_code)
{
	$Is_Valid=1;
}
else
{
	$Is_Valid=0;
}

$currenttm =  Date('H:i:s');

$tomorrow  = mktime(date("H"), date("i")+5, date("s"), date("m")  , date("d"), date("Y"));
$currentdate=date('H:i:s',$tomorrow);


if($city == "Others" && strlen($other_city)>0)
{
	$strCity = $other_city;
}
else
{
		$strCity = $city;
}

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
  <div align="center"><b><font color="#3366CC">Thanks for applying for Car Loan through Deal4loans.com. </font></b><br /><?php //echo $upclSql; ?></div>
  <?
  if($leadid>0)
{
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


$getdetails="select Name,Email,Mobile_Number,ABMMU_flag,Is_Valid From Req_Loan_Car  Where RequestID='".$leadid."'" ;
	list($getNumRows,$getdetailsQuery)=MainselectfuncNew($getdetails,$array = array());

		$Is_Valid = $getdetailsQuery[0]['Is_Valid'];
		$ABMMU_flag = $getdetailsQuery[0]['ABMMU_flag'];
		$full_name = $getdetailsQuery[0]['Name'];
		$Email = $getdetailsQuery[0]['Email'];
		$Mobile_Number = $getdetailsQuery[0]['Mobile_Number'];

		list($strFirst,$strLast) = split('[ ]', $full_name);
if(strlen($strFirst)>25)
		{
			$shrtfname=strlen($strFirst)-25;
			$First = substr(trim($strFirst), 0, strlen(trim($strFirst))-$shrtfname);

		}
		else
		{
			$First =$strFirst;
		}
if(strlen($strLast)>25)
		{
			$shrtlname=strlen($strLast)-25;
			$Last = substr(trim($strLast), 0, strlen(trim($strLast))-$shrtlname);

		}
		else
		{
			$Last =$strLast;
		}

}
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
			
//			$strFinalBidder = implode(",",$FinalBidder);
			
//$Is_Valid=1;	
	if((count($Final_Bid)>0) && ($Is_Valid==1))
	{ //echo "enter";
	
		$magmaArr = array(3336,3337,3338,3339,3340,3341,3342,3343);
		$insertFinalVal = '';
		for($i=0;$i<count($FinalBidder);$i++)
		{
			if (!in_array($FinalBidder[$i], $magmaArr)) {
				$insertFinalVal[] = $FinalBidder[$i];
			}
		}
		if(count($insertFinalVal)>0 && $insertFinalVal[0]>0)
		{
			$strFinalBidder = implode(",",$insertFinalVal);
		
		}
		?>
		 <div align="center"><b><font color="#3366CC"><br />You will get a call from the below mentioned Banks.</font></b><br /><br /> </div>
	
		<table cellpadding="0" cellspacing="2" width="950" align="center" style="border:1px #dbf2ff solid; background-color:#dbf2ff;">
        <tr> <td class="fontbld10" align="left" height="35" style="font-size:12px; padding-left:5px; background-color:#FFF;" colspan="6" >
           <span style="font-weight:normal;">You had selected </span> <strong><?php echo $hdfc_car_name; ?></strong>, <span style="font-weight:normal;">Price:</span> <strong>Rs. <?php echo $hdfc_car_price; ?>/-</strong>.
            </td></tr>
			<tr>
			<td bgcolor="#4FAADE" class="fontbld10" align="center" height="45" style=" font-size:13px;" width="160">Bank Name</td>
            <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style=" font-size:13px;" width="170">Interest Rate</td>
            <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style=" font-size:13px;" width="150">Maximum Eligible Loan Amount</td>
            <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style=" font-size:13px;" width="150">Monthly EMI</td>    <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style="font-size:13px;" width="130">Maximum Tenure            </td>
            <td class="fontbld10" align="center" height="30" style="font-size:13px;" width="250" bgcolor="#4FAADE">&nbsp;</td>
	
				</tr>
		<? for($i=0;$i<count($Final_Bid);$i++)
			{  ?>
		<tr style="border-top:1px #dbf2ff solid; border-bottom:1px #dbf2ff solid;">
			<? if($Final_Bid[$i] =="HDFC")
			{
				list($hdfc_tenure,$hdfc_print_term,$hdfc_inter,$hdfc_Loan_Amount) =  hdfccl_listdcomp($income,$age,$car_category,$car_segment,$hdfccl_comp_type,$hdfc_car_price, $hdfc_clid, $hdfc_car_rate_segment,$City, $hdfc_car_name, $Employment_Status, $Experience, $salary_account, $resi_stable, $krc_flag, $Car_Type);
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
                    <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF; padding-bottom:4px; "><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 230px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(/new-images/get_e_approval_btn.png); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form>
         <div align="left" style="font-size:11px; font-weight:normal; padding-top:2px; padding-left:11px; color:#5A1FF8;">
            <strong>Exclusive offers worth upto 20K<span style="color:#FF0000;">*</span></strong><br />
<img src="new-images/blk-aro.gif" border="0" />&nbsp; Select your reward from a wide range of options.
<br />
          </div></td>
               
               <?php }
					   else
						{
						?>
						<td class="fontbld10" align="center" height="45" style="font-size:12px; background-color:#FFF;"><img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" /><br /><? echo trim($Final_Bid[$i]); ?></td>
                        <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;">11.50% - 14.25%</td>
                        <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
                        <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
                        <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
                         <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
						<?php
						}
			   
			   ?>
            <?php
			}
			else if($Final_Bid[$i] =="Magma Fincorp")
			{
				list($magma_tenure,$magma_print_term,$magma_inter,$magma_Loan_Amount) =  magmaCalulation($income,$age,$car_category,$magma_car_rate_segment, $hdfc_car_price, $hdfc_clid, $magma_car_rate_segment,$City, $hdfc_car_name, $Employment_Status);
				
					
				$alac=$magma_Loan_Amount;
				$intr=$magma_inter/1200;
				$emiPerLac=round($alac * $intr / (1 - (pow(1/(1 + $intr), $magma_tenure))));
				if($magma_Loan_Amount>100000)
				{
			?>
                <td class="fontbld10" align="center" height="45" style="font-size:12px; background-color:#FFF; padding-bottom:4px; padding-top:4px;">
                	<img src="http://www.deal4loans.com/new-images/thnk-magma.jpg" />
               <!-- Magma Fincorp --></td>
                <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;"><?php echo $magma_inter; ?>%</td>
                <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">Rs.<?php echo round($magma_Loan_Amount); ?>/-</td>
                <td class="fontbld10" align="center" style=" background-color:#FFF; font-size:12px;">Rs.<?php echo round($emiPerLac); ?>/-</td>
                <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;"><?php echo $magma_print_term; ?> years</td>
               <?php }
			   else
				{
				?>
                <td class="fontbld10" align="center" height="45" style="font-size:12px; background-color:#FFF;">                	<img src="http://www.deal4loans.com/new-images/thnk-magma.jpg" /><? //echo trim($Final_Bid[$i]); ?></td>
                <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
                <td class="fontbld10" align="center" colspan="2" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
                <td class="fontbld10"  align="center" style="font-size:12px; background-color:#FFF;">&nbsp;</td>
				<?php
				} ?>
			<?php
			}
			else
			{
				 echo '<td class="fontbld10" align="center" height="45" style="font-size:12px;  background-color:#FFF;">';
				echo $Final_Bid[$i];
				echo '</td>';
			}
            ?>
		<?	if($Final_Bid[$i] =="HDFC")
			{ }
			else if($Final_Bid[$i] =="Magma Fincorp")
			{
			}
			else if ($Final_Bid[$i]=="SBI")
			{ ?>
            <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" >&nbsp;</td>
			<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" colspan="2">11.25% - 14%</td>
            <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" >&nbsp;</td>
            <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" >&nbsp;</td>
                      
			<? }
			else if ($Final_Bid[$i]=="Kotak Bank")
			{ ?>
            <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" >&nbsp;</td> 
			<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" colspan="2">12% - 14.50%</td>
            <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" >&nbsp;</td>
            <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" >&nbsp;</td>
                      
			<? }
			else
			{?>
            <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" >&nbsp;</td>
			<td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" colspan="2">Get Quote on call from Bank</td>
            <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" >&nbsp;</td>
            <td class="fontbld10" align="center" style="font-size:12px; background-color:#FFF;" >&nbsp;</td>
           
			<? } ?>
			<?php
			if($Final_Bid[$i] =="Magma Fincorp")
			{
			?>
			<td align="center" class="fontbld10" bgcolor="#FFFFFF"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 230px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(/new-images/nego_bnk.png); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form>
          <div align="left" style="font-size:11px; font-weight:normal; padding-top:2px; padding-left:11px; color:#5A1FF8;">
            <strong>Special Features</strong><br />
            <img src="new-images/blk-aro.gif" border="0" />&nbsp; Get Loan Upto 100% value of car <br />
			<img src="new-images/blk-aro.gif" border="0" />&nbsp; Quick disbursal, in 4 hours of online&nbsp;&nbsp;&nbsp;&nbsp; application 

          </div>
                  </td>
             <?php
			 }
			 
			 ?>
		  </tr>	
		<?	}
		?>
		</table>
		

	<? 
		$rchtime= Date('H:i:s');

		$R_URL="thank_cl_direct.php?leadid=$leadid&city=$strCity";

	if(strlen($R_URL)>0)
	{
		//Header("Refresh: 5 URL=".$R_URL);
	}
}

	
	?>

 </div>
 <div align="center" style="padding-top:30px;">
 		<?php if($ABMMU_flag==1)
  { 
	 
	  $inptstr="Id=".$leadid."&Lead=Deal&fname=".$First."&lname=".$Last."&emailid=".$Email."&dob=&ext=extra&no=".$Mobile_Number;
$outputstr = base64_encode($inptstr);

	  ?>
  <table align="center">
  <tr>
    <td valign='top'  class='tbl_txt' style='font-weight:bold;font-size:14px; padding-top:10px;' align="center" >Please Continue to complete the Registeration Process (30 days free trial of MyUniverse)</td>
  </tr>
  <tr><td align="center">  <img src="../new-images/ajax-loader.gif" width="220" height="19" /></td></tr></table>

  	<iframe width="955" height="800" src="https://www.myuniverse.co.in/sitepages/newregistration.aspx?otptstr=<? echo $outputstr; ?>" frameborder="1"> </iframe>
  <? } ?>
  </div>
 <div style="clear:both; height:15px;"></div>
 </div>
 
<?php include "footer1.php"; ?>

<?
if((strlen(strpos($_SESSION['final_url'], "honda_car_loan.php")) > 0))
{
?>	 

<!-- Google Code for hnd-CL Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "999999";
var google_conversion_label = "bItDCJ2a2QEQh8-3_AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=bItDCJ2a2QEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "sbi_car_loan.php")) > 0))
	 {?>

<!-- Google Code for SBI Car Loan Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "z6kFCP2g0wEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=z6kFCP2g0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "maruti_car_loan.php")) > 0))
	 {?>

<!-- Google Code for Maruti Car Loan Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "QL6JCPWh0wEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=QL6JCPWh0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "hyundai_car_loan.php")) > 0))
	 {?>

<!-- Google Code for hund-CL Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "666600";
var google_conversion_label = "GTqlCJWb2QEQh8-3_AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=GTqlCJWb2QEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>





	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "gen_car_loan.php")) > 0))
	 {?>

<!-- Google Code for Gen-Car-Loan Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "Jp4bCOWj0wEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=Jp4bCOWj0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>



	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "tata_car_loan.php")) > 0))
	 {?>

<!-- Google Code for Tata-Car-Loan Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "KO4dCIWd2QEQh8-3_AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=KO4dCIWd2QEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	 <?  }
 elseif((strlen(strpos($_SESSION['final_url'], "car_loan.php")) > 0))
	 {?>

<!-- Google Code for Car Loan Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "e7cHCIWg0wEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=e7cHCIWg0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<? } ?>

</body>
</html>