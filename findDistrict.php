<?php
require 'scripts/db_init.php';
require 'scripts/ifscfunctions.php';

$BankId=$_GET['BankId'];
$stateId=$_GET['state'];

$GetBankInfo = GetBankID($BankId);
$CityInfo =  GetCityInfo($stateId);


$sql=ExecQuery("SELECT ifsc_state_dist.id, ifsc_state_dist.name, ifsc_state_dist.state_city_url, ifsc_state_dist.sub_id, ifsc_branch.stateid, ifsc_branch.state_id FROM ifsc_branch INNER JOIN ifsc_state_dist ON ifsc_branch.state_id=ifsc_state_dist.id WHERE ifsc_branch.bank_id=".$GetBankInfo['id']." AND ifsc_state_dist.sub_id='".$CityInfo['id']."' group by ifsc_branch.state_id");


//$sql=ExecQuery("SELECT * FROM ifsc_state_dist WHERE sub_id='".$CityInfo['id']."'");
?>
<select name="District" class="ifsc-select" onchange="getBranch('<?php echo $BankId;?>','<?php echo $stateId;?>',this.value)">
 <option>Select City</option>
 <?php
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$data=$row['name'];
$dataUrl=$row['state_city_url'];
?>
    <option value=<?php echo $dataUrl?>><?=$row['name']?></option>
  <? } ?>
</select>