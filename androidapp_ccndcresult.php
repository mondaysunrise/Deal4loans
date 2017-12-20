<?php
require 'scripts/db_init.php';

$bank_name=$_POST['bank_name'];
  $card_name=$_POST['card_name'];
    $city_list=$_POST['city_list'];

	if($city_list=="Delhi n NCR")
	{
		$strcity_list="Delhi";
	}
	else if($city_list=="")
	{
		$strcity_list="All";
	}
	else if($city_list=="Others")
	{
		$strcity_list="All";
	}
	else
	{
		$strcity_list=$city_list;
	}

$sql='select dinning_offers,shopping_offers,`entertainment_offers`, `travel_offers`, `petrol_offers`, `reward_points_offers` From creditndebit_card_offer where (card_name="'.$card_name.'" and bank_name like "%'.$bank_name.'%" and ccndc_approval=1 and city_list like "%'.$strcity_list.'%")';

list($numPL,$row)=Mainselectfunc($sql,$array = array());

while($row)
$output[]=$row;
print(json_encode($output));
mysql_close();

?>
