<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$submitMainForm = $_REQUEST['submitMainForm'];
$last_inserted_id = $_REQUEST['last_inserted_id'];
$model = $_REQUEST['model'];
$city = $_REQUEST['city'];
$untouched_la = $_REQUEST['untouched_la_'.$submitMainForm];
$untouched_ten = $_REQUEST['untouched_ten_'.$submitMainForm];
$rate_category = $_REQUEST['rate_category_'.$submitMainForm];
$hdfc_carprice = $_REQUEST['hdfc_carprice_'.$submitMainForm];

$nwLA = $_REQUEST['nwLA_'.$submitMainForm];
$nwtenu = $_REQUEST['nwtenu_'.$submitMainForm];
$roi = $_REQUEST['roi_'.$submitMainForm];
$final_emiPerLac = $_REQUEST['final_emiPerLac_'.$submitMainForm];
$final_Loan_Amount = $_REQUEST['final_Loan_Amount_'.$submitMainForm];
$Tenure = $nwtenu/12;
$car_name = $_REQUEST['car_name_'.$submitMainForm];

$first_car_name = $_REQUEST['car_name_0'];
$getCarSql = "select hdfc_car_manufacturer,hdfc_car_name ,hdfc_car_price , hdfc_car_price_delhi  from hdfc_car_list_category where hdfc_clid='".$car_name."'";
list($getCarNumRows,$getCarQuery)=MainselectfuncNew($getCarSql,$array = array());

$hdfc_car_name = $getCarQuery[0]['hdfc_car_name'];
$hdfc_car_price = $getCarQuery[0]['hdfc_car_price'];
if($hdfc_car_price=='delhi')
{
	$hdfc_car_price = $getCarQuery[0]['hdfc_car_price_delhi'];
}

	$DataArray = array("Car_Model"=>$hdfc_car_name , "Car_Price"=>$hdfc_car_price , "intr_rate"=>$roi, "Tenure"=>$Tenure,  "Loan_Amount"=>$final_Loan_Amount );
	$wherecondition ="(RequestID='".$last_inserted_id."')";
	Mainupdatefunc ('hdfc_car_loan_leads', $DataArray, $wherecondition);


$getfirstCarSql = "select hdfc_car_manufacturer,hdfc_car_name ,hdfc_car_price , hdfc_car_price_delhi  from hdfc_car_list_category where hdfc_clid='".$first_car_name."'";
list($getfirstCarNumRows,$getfirstCarQuery)=MainselectfuncNew($getfirstCarSql,$array = array());
$hdfc_car_manufacturer = $getfirstCarQuery[0]['hdfc_car_manufacturer'];
$hdfc_car_manufacturer_first = explode(" ", $hdfc_car_manufacturer);
$model = strtolower($hdfc_car_manufacturer_first[0]);
if($model=="land"){	$model = "landrover"; }
//$model = "tata";

$Monthly_EMI = $final_emiPerLac;
$getUserDetails = "select * from hdfc_car_loan_leads where RequestID ='".$last_inserted_id."'";
list($getUserDetailsNumRows,$getUserDetailsQuery)=MainselectfuncNew($getUserDetails,$array = array());
$Employment_Status = $getUserDetailsQuery[0]['Employment_Status'];
$Company_Name = $getUserDetailsQuery[0]['Company_Name'];
$Net_Salary = $getUserDetailsQuery[0]['Net_Salary'];
$Years_in_Current_Residence = $getUserDetailsQuery[0]['Resi_Stability'];
$City = $getUserDetailsQuery[0]['City'];

$Residence_Status = $getUserDetailsQuery[0]['Residence_Status'];

$DOB = $getUserDetailsQuery[0]['DOB'];
$salary_account = $getUserDetailsQuery[0]['salary_account'];
if($salary_account==1) { $Account_with_HDFC_Bank = "Yes"; } else { $Account_with_HDFC_Bank = "No"; }

$Loan_Amount = $getUserDetailsQuery[0]['Loan_Amount'];
$Car_Name = $getUserDetailsQuery[0]['Car_Model'];
$Car_Price = $getUserDetailsQuery[0]['Car_Price'];
$Rate_of_Interest = $getUserDetailsQuery[0]['intr_rate'];
$Tenure = $getUserDetailsQuery[0]['Tenure'];
$reward_selected = $getUserDetailsQuery[0]['reward_selected'];

$getRewardsSql = "select * from hdfc_car_loan_gifts where id = '".$reward_selected."'";
list($getRewardsNumRows,$getRewardsQuery)=MainselectfuncNew($getRewardsSql,$array = array());

$Rewards = $getRewardsQuery[0]['Name'];

if($Employment_Status==1)
{
	$Occupation = "Salaried";
}
else
{
	$Occupation = "Self Employed";
}
if($Residence_Status==4)
{
	$Residency_Type = "Owned By Self/Spouse";
}
else if($Residence_Status==1)
{
	$Residency_Type = "Owned By Parent/Sibling";
}
else if($Residence_Status==3)
{
	$Residency_Type = "Company Provided";
}
else if($Residence_Status==5)
{
	$Residency_Type = "Rented - With Family";
}
else if($Residence_Status==6)
{
	$Residency_Type = "Rented - With Friends";
}
else if($Residence_Status==2)
{
	$Residency_Type = "Rented - Staying Alone";
}
else if($Residence_Status==7)
{
	$Residency_Type = "Paying Guest";
}
else if($Residence_Status==8)
{
	$Residency_Type = "Hostel";
}

 $Company = $Company_Name;
 $Annual_Income=$Net_Salary;
 $Years_in_Current_Residence = $Years_in_Current_Residence;
 $Date_of_Birth = $DOB;
?>

<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="images/car_hdfc/maruti_css.css" type="text/css" rel="stylesheet" />
<title>Deal4loans</title>
<link href="css/hdfccl-style.css" rel="stylesheet" type="text/css" />
<style>
.add_rec {font-family:Arial, Helvetica, sans-serif; font-size:12px; color: #333333; font-weight:bold;}
</style>
</head>
<body>
<div class="main-wrapper">
<div align="left" style="padding-left:5px;"><img src="images/newimages/eligibility-check-hdfc-logo.jpg" border="0" height="85" width="193"></div>
<div style="float:right; width:800px; margin-top:-55px;"><div style="vertical-align:bottom;  padding-left:5px;" ><span class="<?php echo $model; ?>-heading_A" style="font-size:20px;">HDFC Bank offers you complete package of <span class="<?php echo $model; ?>-heading_B" style="font-size:20px;">timely service</span>,</span>
  <span style="color:#CCCCCC">  
  <h1 class="<?php echo $model; ?>-heading_B" style="font-size:20px;">Competitive rates &amp; Competent guidance <span class="<?php echo $model; ?>-heading_A" style="font-size:20px;">along with 100% finance on select models.  </span></h1>
  </span></div></div>
<div style="clear:both;"></div>
<div class="<?php echo $model; ?>-vehicle_box_left">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td class="vehicle_heading_text" valign="top" style="height:45px;"><?php echo $hdfc_car_name; ?></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="vehicle_heading_text"><?php 	echo "Rs. ".number_format($hdfc_car_price); ?>/-</span></td>

    </tr>
    <tr>
      <td class="vehicle_sub_heading_text">Ex-showroom price</td>

    </tr>
  </table>
</div>
<div class="<?php echo $model; ?>-form-box">
<form  method="POST" action="https://leads.hdfcbank.com/applications/webforms/apply/HDFC_CarLoanReferral/HDFC_CLReferral.aspx" name="hdfc_calc"  >
<input type="hidden" name="Occupation" id="Occupation" value="<?php echo $Occupation; ?>"  readonly="readonly" />
<input type="hidden" name="Company" id="Company" value="<?php echo $Company; ?>"  readonly="readonly" />
<input type="hidden" name="Annual_Income" id="Annual_Income" value="<?php echo $Annual_Income; ?>"  readonly="readonly"/>
<input type="hidden" name="Residency_Type" id="Residency_Type" value="<?php echo $Residency_Type; ?>"  readonly="readonly" />
<input type="hidden" name="Years_in_Current_Residence" id="Years_in_Current_Residence" value="<?php echo $Years_in_Current_Residence; ?>"  readonly="readonly" />
<input type="hidden" name="Residence_Status" id="Residence_Status" value="<?php echo $Residency_Type; ?>"  readonly="readonly"  />
<input type="hidden" name="Date_of_Birth" id="Date_of_Birth" value="<?php echo $Date_of_Birth; ?>"  readonly="readonly"  />
<input type="hidden" name="Account_with_HDFC_Bank" id="Account_with_HDFC_Bank" value="<?php echo $Account_with_HDFC_Bank; ?>"  readonly="readonly"  />
<input type="hidden" name="Car_Name" id="Car_Name" value="<?php echo $Car_Name; ?>"  readonly="readonly" />
<input type="hidden" name="Loan_Amount" id="Loan_Amount" value="<?php echo $Loan_Amount; ?>"  readonly="readonly" />
<input type="hidden" name="Monthly_EMI" id="Monthly_EMI" value="<?php echo $Monthly_EMI; ?>"  readonly="readonly"  />
<input type="hidden" name="Rate_of_Interest" id="Rate_of_Interest" value="<?php echo $Rate_of_Interest; ?>"  readonly="readonly" />
<input type="hidden" name="Rewards" id="Rewards" value="<?php echo $Rewards; ?>"  readonly="readonly" />
<input type="hidden" name="City" id="City" value="<?php echo $City; ?>"  readonly="readonly" />

  <table width="534" border="0" align="center" cellpadding="0" cellspacing="0">
    <tbody>      
      
      <tr align="left">
        <td width="14" height="50" class="maruti-heading_text">&nbsp;</td>
        <td width="520" class="maruti-heading_text">Your  details to get quote</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><table width="534" border="0" align="center" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td width="15">&nbsp;</td>
                <td width="18" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td width="234" align="left" class="<?php echo $model; ?>-heading_body-text">Occupation</td>
                <td width="18"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td width="249" align="left" class="<?php echo $model; ?>-heading_body-text">Company Name</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="left" class="add_rec">
                <?php echo $Occupation; ?>
    			</td>
                <td>&nbsp;</td>
                <td align="left" class="add_rec"><?php echo $Company; ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="15">&nbsp;</td>
                <td width="18" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td width="234" align="left" class="<?php echo $model; ?>-heading_body-text">Loan Amount</td>
                <td width="18"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td width="249" align="left" class="<?php echo $model; ?>-heading_body-text">ROI</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="left" class="add_rec">
                Rs. <?php echo number_format($Loan_Amount); ?>/-
    			</td>
                <td>&nbsp;</td>
                <td align="left" class="add_rec"><?php echo $Rate_of_Interest; ?>%</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td align="left" class="<?php echo $model; ?>-heading_body-text">DOB</td>
                <td align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td align="left"><span class="<?php echo $model; ?>-heading_body-text">City</span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="left"  class="add_rec"><?php echo $DOB; ?></td>
                <td>&nbsp;</td>
                <td align="left" class="add_rec"><?php echo $City; ?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
          <tr><td colspan="5" >
          <table width="534" ><tr>                <td width="7">&nbsp;</td>                <td width="15"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td align="left" class="<?php echo $model; ?>-heading_body-text" width="217">Years at current residence </td>                <td align="right"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td class="<?php echo $model; ?>-heading_body-text" align="left">Residence Status</td>              </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td align="left" class="add_rec"><?php echo $Years_in_Current_Residence; ?> Years</td>                <td>&nbsp;</td>                <td align="left" class="add_rec">              <?php echo $Residency_Type; ?>                           </td>              </tr>                                      <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>               <td>&nbsp;</td>                <td>&nbsp;</td>              </tr>   </table> 
          </td></tr>
             
              <tr>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td colspan="2" align="left">
                <input type="submit" name="submit" style="border: 0px none ; background-image: url(images/newimages/<?php echo $model; ?>-get-quote-btn.png); width: 142px; height: 45px; margin-bottom: 0px;" value=""/>

               </td>
              </tr>
            </tbody>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </tbody>
  </table>
  </form>
</div>
<div class="right-box">
<div class="right-box-specification">
<?php
$getCarSql = "select * from hdfc_car_list_category where hdfc_car_name='".$hdfc_car_name."'";
list($getCarNumRows,$getCarQuery)=MainselectfuncNew($getCarSql,$array = array());

$Overall_Length = $getCarQuery[0]['Overall_Length'];
$Power = $getCarQuery[0]['Power'];
$Torque = $getCarQuery[0]['Torque'];
$Seating_Capacity = $getCarQuery[0]['Seating_Capacity'];
$Mileage = $getCarQuery[0]['Mileage'];
$Top_Speed  = $getCarQuery[0]['Top_Speed'];
$hdfc_car_name = $getCarQuery[0]['hdfc_car_name'];
$hdfc_car_segment  = $getCarQuery[0]['hdfc_car_segment'];
$hdfc_car_price = $getCarQuery[0]['hdfc_car_price'];
$Fuel_Capacity = $getCarQuery[0]['Fuel_Tank_Capacity'];
$Fuel_Type = $getCarQuery[0]['Fuel_Type'];
$Gears  = $getCarQuery[0]['Gears_Speeds'];
$Displacement = $getCarQuery[0]['Displacement'];
?>

<table width="98%" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td height="50" colspan="2" style="border-bottom: thin solid #e4ddf9;"><h2 class="<?php echo $model; ?>-heading_B">Specifications</h2>	</td>
  </tr>
  
  <tr>
    <td width="51%" height="36" class="maruti-heading_body-text" >Overall Length</td>
    <td width="49%" height="36" align="right" class="heading_body-text_sub"><?php echo $Overall_Length; ?></td>
  </tr>
  <tr>
    <td height="35" class="maruti-heading_body-text">Power</td>
    <td height="35" align="right" class="heading_body-text_sub"><?php echo $Power; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Torque</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Torque; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Seating Capacity</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Seating_Capacity; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Mileage</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Mileage; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Fuel Tank Capacity</td>
    <td height="36" align="right"class="heading_body-text_sub"><?php echo $Fuel_Capacity; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Fuel Type</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Fuel_Type; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Top Speed</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Top_Speed; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Gears/Speeds</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Gears; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Displacement</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Displacement; ?></td>
  </tr>
</table>
</div>
<div style=" background:url(images/form-buttom-shadow-rightside.jpg) no-repeat; height:11px;"></div>
<div align="right"><img src="images/newimages/powered_by_deal4loans_text.png" height="18" width="186" border="0"></div>
</div>
</div>
</body>
</html>