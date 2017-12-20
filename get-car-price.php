<?php
    require 'scripts/db_init.php';
		
	$car_name = $_REQUEST['car_name'];
	$city = $_REQUEST["city"];

if((strlen($car_name)>0) || ((strlen($city)>0)))
{
			
		$sql = "Select hdfc_car_price_delhi,hdfc_car_price from hdfc_car_list_category Where hdfc_car_name='".$car_name."'";
	list($numRowsCarName,$row)=Mainselectfunc($sql,$array = array());
		if($city=="Delhi")
	{
		$car_price =$row["hdfc_car_price_delhi"];
	}
		else
	{
		$car_price =$row["hdfc_car_price"];
	}
	
	echo "Rs. ".number_format($car_price);		
}
?>
