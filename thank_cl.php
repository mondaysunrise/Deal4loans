<?php
ob_start();
require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'carLoanCalc.php';
	require 'show_quotecount.php';	


$city = $_SESSION['City'];
$leadid = $_SESSION['Temp_LID'];
$other_city = $_SESSION['City_Other'];
$rchtime = FixString($_REQUEST['rchtime']);
$Reference_Code = FixString($_REQUEST["Reference_Code"]);
$activation_code = FixString($_REQUEST["activation_code"]);

$Name = FixString($_REQUEST["Name"]);

$Residence_Status = FixString($_REQUEST['Residence_Status']);
$Residence_Stability = FixString($_REQUEST['Resi_Stability']);
$Car_Varient = FixString($_REQUEST['car_model']);
$Total_Experience = FixString($_REQUEST['total_experience']);

$Gender = FixString($_REQUEST['Gender']);
$Residence_Address = FixString($_REQUEST['Residence_Address']);
$Pincode = FixString($_REQUEST['Pincode']);
$Pancard = FixString(strtoupper($_REQUEST['Pancard']));

$Age = FixString($_REQUEST['Age']);

 if(strlen($Age)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$Age;
			$DOB = $year."-".$date;
		}
		else
		{
			$timestamp = strtotime('-30 years');
			$DOB = date('Y-m-d',$timestamp);
		}

$Company_Name = FixString($_REQUEST['Company_Name']);
$Car_Type = FixString($_REQUEST['Car_Type']);
$Car_Booked = FixString($_REQUEST['Car_Booked']);
$cldelivery_date = FixString($_REQUEST['cldelivery_date']);


$getCarNameSql = "SELECT hdfc_clid,hdfc_car_name FROM hdfc_car_list_category WHERE hdfc_clid='".$Car_Varient."'";

list($alreadyExist,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());
$getCarNameQuerycontr=count($getCarNameQuery)-1;

$Car_Model = $getCarNameQuery[$getCarNameQuerycontr]['hdfc_car_name'];

if($Reference_Code == $activation_code)
{
	$Is_Valid=1;
}
else
{
	$Is_Valid=0;
}

$dataUpdate = array('Is_Valid'=>$Is_Valid, 'Residence_Status'=>$Residence_Status, 'Residence_Stability'=>$Residence_Stability, 'Car_Varient'=>$Car_Varient, 'Total_Experience'=>$Total_Experience, 'Car_Model'=>$Car_Model, "Company_Name"=>$Company_Name, "Car_Booked"=>$Car_Booked, "Delivery_Date"=>$cldelivery_date, "DOB"=>$DOB, "Gender"=>$Gender, "Residence_Address"=>$Residence_Address, "Pincode"=>$Pincode, "Pancard"=>$Pancard);
$wherecondition = "(RequestID=".$leadid.")";
Mainupdatefunc ('Req_Loan_Car', $dataUpdate, $wherecondition);
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
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<title>Thank you Car Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="source.css" rel="stylesheet" type="text/css" />
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
line-height:14px;
color:#000000;
}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both; height:70px;"></div>
<div class="lac-main-wrapper">
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto;">
  <div align="center"  color="#3366CC"><font color="#3366CC"><strong>Dear <? echo $Name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com</strong><br /><b>Thanks for applying for Car Loan through Deal4loans.com. </b></font><br /><?php //echo $upclSql; ?></div>
  <?
  if($leadid>0)
{
$getUsrDetailsSql = "select * from Req_Loan_Car where RequestID	= '".$leadid."'";
list($alreadyExist,$getUsrDetailsQuery)=MainselectfuncNew($getUsrDetailsSql,$array = array());
$getUsrDetailsQuerycontr=count($getUsrDetailsQuery)-1;
$source = $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['source'];
$income = $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['Net_Salary'];
$DOB = $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['DOB'];
$City = $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['City'];
$Car_Varient = $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['Car_Varient'];
$Employment_Status = $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['Employment_Status'];
$company_name = $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['Company_Name'];
$Car_Type = $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['Car_Type'];
$DOB_arr = explode("-",$DOB);
list($yyyy,$mm,$dd) = $DOB_arr;
$DOB_Str = $yyyy."".$mm."".$dd;
$Experience = $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['Total_Experience'];

$Residence_Status=  $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['Residence_Status'];
$Resi_Stability=  $getUsrDetailsQuery[$getUsrDetailsQuerycontr]['Residence_Stability'];

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
list($alreadyExist,$rowcmp)=MainselectfuncNew($getcompdetails,$array = array());
$rowcmpcontr=count($rowcmp)-1;
$hdfccl_comp_type = $rowcmp[$rowcmpcontr]["hdfccl_comp_type"];
$krc_flag = $rowcmp[$rowcmpcontr]["krc_flag"];

	$getcardetails="Select * from hdfc_car_list_category Where hdfc_clid='".$Car_Varient."'";
	list($alreadyExist,$row)=MainselectfuncNew($getcardetails,$array = array());
	$rowcontr=count($row)-1;
	$car_category = $row[$rowcontr]["hdfc_car_category"];
	$car_segment = $row[$rowcontr]["hdfc_car_segment"];
	$hdfc_clid= $row[$rowcontr]["hdfc_clid"];
	$hdfc_car_price = $row[$rowcontr]["hdfc_car_price"];
	$hdfc_car_price_delhi = $row[$rowcontr]["hdfc_car_price_delhi"];
	$hdfc_car_rate_segment = $row[$rowcontr]["hdfc_car_rate_segment"];
	$hdfc_car_name = $row[$rowcontr]["hdfc_car_name"];
	$magma_car_rate_segment = $row[$rowcontr]["magma_car_rate_segment"];
	$magma_list = $row[$rowcontr]["magma_list"];
	$ltv_36months = $row[$rowcontr]["ltv_36months"];
	$ltv_60months = $row[$rowcontr]["ltv_60months"];

$getdetails="select Name,Email,Mobile_Number,ABMMU_flag,Is_Valid From Req_Loan_Car  Where RequestID='".$leadid."'" ;
	list($alreadyExist,$getdetailsQuery)=MainselectfuncNew($getdetails,$array = array());
	$getdetailsQuerycontr=count($getdetailsQuery)-1;
		
		$Is_Valid = $getdetailsQuery[$getdetailsQuerycontr]['Is_Valid'];
		$ABMMU_flag = $getdetailsQuery[$getdetailsQuerycontr]['ABMMU_flag'];
		$full_name = $getdetailsQuery[$getdetailsQuerycontr]['Name'];
		$Email = $getdetailsQuery[$getdetailsQuerycontr]['Email'];
		$Mobile_Number = $getdetailsQuery[$getdetailsQuerycontr]['Mobile_Number'];

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
		
			$comma_separated_Bidders = implode(",", $Final_Bid);
			$Final_Bid = explode(",", $comma_separated_Bidders);	
			
			$strMFinalBidder = implode(",",$FinalBidder);
			
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
			$Dated = ExactServerdate();
			$dataUpdate = array( 'Bidderid_Details'=>$strFinalBidder,'Allocated'=>'2', 'Dated'=>$Dated);
			$wherecondition = "(RequestID=".$leadid.")";
			Mainupdatefunc ('Req_Loan_Car', $dataUpdate, $wherecondition);
		}
		?>
		 <div align="center"><b><font color="#3366CC"><br />You will get a call from the below mentioned Banks.</font></b><br /><br /> </div>
	<?php
			if(count($insertFinalVal)>0 && $insertFinalVal[0]>0)
		{
		?>
        <div class="overflow-width">
		<table cellpadding="0" cellspacing="2" width="100%" align="center" style="border:1px #dbf2ff solid; background-color:#dbf2ff;">
        <tr> <td class="fontbld10" align="left" height="35" style="font-size:14px; padding-left:5px; background-color:#FFF;" colspan="6" >
           <span style="font-weight:normal;">You had selected </span> <strong><?php echo $hdfc_car_name; ?></strong>, <span style="font-weight:normal;">Price:</span> <strong>Rs. <?php echo $hdfc_car_price; ?>/-</strong>.
            </td></tr>
			<tr>
			<td bgcolor="#4FAADE" class="fontbld10" align="center" height="45" style=" font-size:13px;" width="160">Bank Name</td>
            <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style=" font-size:13px;" width="170">Interest Rate</td>
            <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style=" font-size:13px;" width="150">Maximum Eligible Loan Amount</td>
            <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style=" font-size:13px;" width="150">Monthly EMI</td>    <td bgcolor="#4FAADE" class="fontbld10" align="center" height="30" style="font-size:13px;" width="130">Maximum Tenure            </td>
            <td class="fontbld10" align="center" height="30" style="font-size:13px;" width="250" bgcolor="#4FAADE">&nbsp;</td>	
				</tr>
		<? 		
		for($i=0;$i<count($Final_Bid);$i++)
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
                 <td class="fontbld10" align="center" height="55" style="font-size:14px; background-color:#FFF;" >
					<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" /><br />HDFC Bank</td>
					<td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;"><?php echo $hdfc_inter; ?>%</td>
					<td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;">Rs.<?php echo round($hdfc_Loan_Amount); ?>/-</td>
					<td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;">Rs.<?php echo round($emiPerLac); ?>/-</td>
					<td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;"><?php echo $hdfc_print_term; ?> years</td>
                    <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;">
                    <? if($source=="HDFC_DEMO")
					{?>
                    <form action="apply_cl_hdfc_preview.php" method="POST" target="_blank" >
                    <? }
					else
					{ ?>
                   <!-- <form action="apply_cl_hdfc.php" method="POST" target="_blank" >-->
                    <form action="apply_cl_consent.php" method="POST" target="_blank" >
                    <? } ?>
                    <input type="hidden" name="Name" id="Name"  value="<? echo $_REQUEST['Name']; ?>" >
      				<input type="hidden" name="Phone" id="Phone"  value="<?php echo $_REQUEST['Phone'];?>" >
				 	<input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
		    		<input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
					<input type="submit" style="width: 230px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(/new-images/get_e_approval_btn.png); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  	</form>
		            <div align="left" style="font-size:11px; font-weight:normal; padding-top:2px; padding-left:11px; color:#5A1FF8;">
		            <strong>Exclusive offers worth upto 20K<span style="color:#FF0000;">*</span></strong><br />
					<img src="new-images/blk-aro.gif" border="0" />&nbsp; Select your reward from a wide range of options.<br /></div></td>
               
               <?php }
					   else
						{
						?>
						<td class="fontbld10" align="center" height="45" style="font-size:14px; background-color:#FFF;"><img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" /><br /><? echo trim($Final_Bid[$i]); ?></td>
                        <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;">11.50% - 14.25%</td>
                        <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
                        <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
                        <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
                         <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
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
                <td class="fontbld10" align="center" height="45" style="font-size:14px; background-color:#FFF;">
                	<img src="http://www.deal4loans.com/new-images/thnk-magma.jpg" />
               <!-- Magma Fincorp --></td>
                <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;"><?php echo $magma_inter; ?>%</td>
                <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">Rs.<?php echo round($magma_Loan_Amount); ?>/-</td>
                <td class="fontbld10" align="center" style=" background-color:#FFF; font-size:14px;">Rs.<?php echo round($emiPerLac); ?>/-</td>
                <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;"><?php echo $magma_print_term; ?> years</td>
               <?php }
			   else
				{
				?>
                <td class="fontbld10" align="center" height="45" style="font-size:14px; background-color:#FFF;">                	<img src="http://www.deal4loans.com/new-images/thnk-magma.jpg" /><? //echo trim($Final_Bid[$i]); ?></td>
                <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
                <td class="fontbld10" align="center" colspan="2" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
                <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
				<?php
				} ?>
			<?php
			}
				else if($Final_Bid[$i] =="TVS credit")
				{
					echo $tvs_tenure." - ".$tvs_Finalemi." - ".$tvs_Loan_Amount." - ".$tvs_inter."<br>";
					
					list($tvs_tenure,$tvs_Finalemi,$tvs_Loan_Amount,$tvs_inter) = tvscredit($ltv_36months,$ltv_60months, $age, $hdfc_car_price);
					if($tvs_Loan_Amount>0)
					{
					?>
					<td class="fontbld10" align="center" height="45" style="font-size:14px; background-color:#FFF;">
                	TVS Credit
               <!-- TVS Credit --></td>
                <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;"><?php echo $tvs_inter; ?></td>
                <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">Rs.<?php echo round($tvs_Loan_Amount); ?>/-</td>
                <td class="fontbld10" align="center" style=" background-color:#FFF; font-size:14px;"><?php //echo $tvs_Finalemi; ?></td>
                <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;"><?php echo $tvs_tenure; ?> years</td>
				<td align="center" class="fontbld10" bgcolor="#FFFFFF"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">            
			<input type="submit" style="width: 230px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cl-bttn-apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form>
				  <div align="left" style="font-size:11px; font-weight:normal; padding-top:2px; padding-left:11px; color:#5A1FF8;">
		            <strong>0.5% Processing Fee<span style="color:#FF0000;"></span></strong><br />
					 </div>
         
                  </td>
					<?
					}
					else
					{ ?>
					 <td class="fontbld10" align="center" height="45" style="font-size:14px; background-color:#FFF;">                	TVS Credit</td>
                <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">15% - 17%</td>
                <td class="fontbld10" align="center" colspan="2" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
                <td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
				<td class="fontbld10"  align="center" style="font-size:14px; background-color:#FFF;">&nbsp;</td>
				<td align="center" class="fontbld10" bgcolor="#FFFFFF"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
            
			<input type="submit" style="width: 230px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cl-bttn-apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form>
         
                  </td>
					<? }
				}
			elseif($Final_Bid[$i] =="ICICI Bank")
				{ ?>

<td class="fontbld10" align="center" height="45" style="font-size:14px; background-color:#FFF;">                	<img src="http://www.deal4loans.com/new-images/icici_bkpl.jpg" /></td>
				<? }
			else
			{
				 echo '<td class="fontbld10" align="center" height="45" style="font-size:14px;  background-color:#FFF;">';
				echo $Final_Bid[$i];
				echo '</td>';
			}
            ?>
		<?	if($Final_Bid[$i] =="HDFC")
			{ }
			else if($Final_Bid[$i] =="Magma Fincorp")
			{
			}
			else if($Final_Bid[$i] =="TVS credit")
			{
			}
			else if ($Final_Bid[$i]=="SBI")
			{ ?>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td>
			<td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" colspan="2">11.25% - 14%</td>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td>
                      
			<? }
			elseif($Final_Bid[$i] =="ICICI Bank")
				{?>
			<td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td> 
			<td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" colspan="2">&nbsp;</td>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td>
            
				<? }
			else if ($Final_Bid[$i]=="Kotak Bank")
			{ ?>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td> 
			<td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" colspan="2">12% - 14.50%</td>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td>
                      
			<? }
			else
			{?>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td>
			<td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" colspan="2">Get Quote on call from Bank</td>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td>
            <td class="fontbld10" align="center" style="font-size:14px; background-color:#FFF;" >&nbsp;</td>
           
			<? } ?>
			<?php
			if($Final_Bid[$i] =="Magma Fincorp")
			{
			?>
			<td align="center" class="fontbld10" bgcolor="#FFFFFF"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
            <input type="hidden" name="cl_bidd_set" id="cl_bidd_set" value="<? echo $strMFinalBidder; ?>">
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
		  else if($Final_Bid[$i] =="ICICI Bank")
				{ ?>
<td align="center" class="fontbld10" bgcolor="#FFFFFF"><form action="apply_cl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cl_requestid" value="<? echo $leadid; ?>" id="cl_requestid">
		    <input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
            
			<input type="submit" style="width: 230px; height: 41px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cl-bttn-apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
				  </form>
         
                  </td>
				<? }
			 ?>
		  </tr>	
		<?	}
		}
		?>
		</table>
		</div>

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

 <div style="clear:both; height:15px;"></div>
 <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0" bgcolor="#e6edfd"><tr><td width="196" rowspan="2" align="center" style="color:#000000; font-size:18px; border:1px #FFFFFF solid;">Connect With Us</td><td width="208" height="30" align="center" style=" color:#000000; font-size:14px;"><b>Facebook</b></td><td width="169" align="center" style="color:#000000; font-size:14px;"><b>Google +</b></td><td width="117" align="center" style="color:#000000; font-size:14px;"><b>Twitter</b></td></tr><tr><td height="40" style="padding-left:20px; color:#000000;"><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font=tahoma&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></td><td align="center" style="padding-left:20px; color:#000000;"><!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="medium" data-href="https://plus.google.com/117667049594254872720"></div>
</td><td align="center" height="40" style="padding-left:20px;"><a href="https://twitter.com/deal4loans" class="twitter-follow-button" data-show-count="false">Follow @deal4loans</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></td></tr></table>
<!-- Place this tag where you want the +1 button to render. -->


<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
 </div> 
 </div>
<?php include "footer_sub_menu.php"; ?>
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