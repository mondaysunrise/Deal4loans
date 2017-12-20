<?php
require 'scripts/db_init.php';
$BankId=$_GET['BankId'];
$stateId=$_GET['state'];

function GetCityInfo($URL){
		$Sqql = ExecQuery("SELECT * FROM ifsc_state_dist WHERE state_city_url='".$URL."' and sub_id=0");
		$rowsql=mysql_fetch_array($Sqql);
		return $rowsql;
	}
	
	$CityInfo =  GetCityInfo($stateId);
	//echo "SELECT * FROM ifsc_state_dist WHERE sub_id='".$stateId."'"; die;
$sql=ExecQuery("SELECT * FROM ifsc_state_dist WHERE sub_id='".$stateId."'");
?>
<select name="CityName" class="ifsc-select">
 <option>---Select City---</option>
 <?php
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$data=$row['name'];
$dataUrl=$row['state_city_url'];
?>
    <option value=<?php echo $id;?>><?=$row['name']?></option>
  <? } ?>
</select>