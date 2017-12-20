<?php
require 'scripts/db_init.php';


$car_name = $_REQUEST["car_name"];

$minrange="";
$minrange1="";
$sqlcn = "Select hdfc_car_price,hdfc_car_manufacturer from hdfc_car_list_category Where hdfc_car_name='".$car_name."'";
list($recordcount,$rowcn)=Mainselectfunc($sqlcn,$array = array());
$sel_car_price = $rowcn["hdfc_car_price"];
$hdfc_car_manufacturer = $rowcn["hdfc_car_manufacturer"];
$p_arr = str_split($sel_car_price, 1);

$minrange.=$p_arr[0];

for($s=0;$s<count($p_arr)-1;$s++)
	 {
		$minrange1.="0";
	 }
	
$min_range=	$minrange."".$minrange1;
$max_range= ($minrange+1)."".$minrange1;

$sql_crnge = "Select hdfc_car_name from hdfc_car_list_category Where ((hdfc_car_price between '".$min_range."' and '".$max_range."') and hdfc_car_manufacturer not like '%".$hdfc_car_manufacturer."%') group by hdfc_car_manufacturer LIMIT 0,3";
list($numRows,$rowcrnge)=MainselectfuncNew($sql_crnge,$array = array());
for($i=0;$i<$numRows;$i++)
{
	$arrlistofcars[]=$rowcrnge[$i]["hdfc_car_name"];
}


?>
<table>
	<tr>
		<td><input type="radio" name="choose_car" id="choose_car" checked><? echo $car_name; ?></td></tr>
		<tr><td><input type="radio" name="choose_car" id="choose_car"><? echo $arrlistofcars[0]; ?></td></tr>
		<tr><td><input type="radio" name="choose_car" id="choose_car"><? echo $arrlistofcars[1]; ?></td></tr>
		<tr><td><input type="radio" name="choose_car" id="choose_car"><? echo $arrlistofcars[2]; ?></td></tr>
	</tr>
</table>