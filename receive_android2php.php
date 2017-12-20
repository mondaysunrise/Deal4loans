<?php
require 'scripts/db_init.php';

 $bank_namen=$_POST['bank_name'];
 $card_type=$_POST['card_type'];
 $city_list=$_POST['city_list'];

if($card_type=="Debit Card")
{
	$CC_Holder=2;
}
if($card_type=="Credit Card")
{
	$CC_Holder=1;
}

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

if($bank_namen=="Standard C" || $bank_namen=="Standard Chartered")
{
	$bank_name="Standard Chartered";
}
else
{
	$bank_name=$bank_namen;
}
$sql=("select card_name From creditndebit_card_offer where (ccndc_offer_type=".$CC_Holder." and bank_name like '%".$bank_name."%' and ccndc_approval=1 and city_list like '%".$strcity_list."%')");
 list($recordcount,$row)=MainselectfuncNew($sql,$array = array());
$cntr=0;
while($cntr<count($row))
$output[]=$row[$cntr];
print(json_encode($output));
mysql_close();

?>

