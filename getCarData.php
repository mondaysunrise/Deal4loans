<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$cardetails = $_REQUEST['cardetails'];
$model = $_REQUEST['model'];

$getCarSql = "select hdfc_car_name from hdfc_car_list_category where hdfc_car_model='".$cardetails."'";
list($getCarNumRows,$getCarQuery)=MainselectfuncNew($getCarSql,$array = array());
?>
<div id="<?php echo $model; ?>menu2">
<ul>
<?php
$carM = array('Maruti ', 'Nissan ','Renault ', 'Honda ', 'Mahindra ', 'Toyota', 'Hyundai ', 'Tata ', 'Chevrolet ', 'Porsche ', 'Mercedes ', 'Force ', 'Land Rover ', 'Premier ', 'Jaguar ', 'Mitsubishi ', 'Ford ', 'Audi ', 'Bmw ', 'Skoda ', 'Fiat ', 'Volvo ', 'Volkswagen ','Indica ' );
for($i=0;$i<$getCarNumRows;$i++)
{
	$hdfc_car_name = $getCarQuery[$i]['hdfc_car_name'];
	echo '<li><a class="'.$model.'-body_text2" href="hdfc-car-loanappoffers.php?car_name='.$hdfc_car_name.'"  style="text-decoration:none;">';
	echo str_replace($carM, "", $hdfc_car_name);
//	echo $hdfc_car_name;	
	echo "</a></li>";
}
?>
</ul>
</div>