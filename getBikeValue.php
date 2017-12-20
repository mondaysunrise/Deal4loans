<?php
require 'scripts/db_init.php';
$bikedetails = $_REQUEST['bikemanufacturer'];
?>
<select name="bike_model" id="bike_model" class="pl_select_b" >
<option value="">Select Model</option>
<?php

$getCarNameSql = "SELECT id,bike_name FROM bike_list WHERE bike_manufacturer like '%".$bikedetails."%'";
list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());
for($cN=0;$cN<$numRowsCarName;$cN++)
{
	$bike_name = $getCarNameQuery[$cN]['bike_name'];
	$id = $getCarNameQuery[$cN]['id'];
	?>
 	<option value="<?php echo $bike_name; ?>"><?php echo $bike_name; ?></option>   
    <?php
}
?>
</select>
