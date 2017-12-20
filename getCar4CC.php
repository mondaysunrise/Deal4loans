<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$cardetails = $_REQUEST['carmanufacturer'];
//print_r($_REQUEST);
?>
<select name="car_model" id="car_model"   class="pl_input-box_select">
<option value="">Select Car Model</option>
<?php

$getCarNameSql = "SELECT hdfc_clid,hdfc_car_name FROM hdfc_car_list_category WHERE hdfc_car_manufacturer like '%".$cardetails."%'";
list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());
for($cN=0;$cN<$numRowsCarName;$cN++)
{
	$hdfc_car_manufacturer = $getCarNameQuery[$cN]['hdfc_car_name'];
	$hdfc_clid = $getCarNameQuery[$cN]['hdfc_clid'];
	?>
 	<option value="<?php echo $hdfc_car_manufacturer; ?>"><?php echo $hdfc_car_manufacturer; ?></option>   
    <?php
}
?>
</select>
