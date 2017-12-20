<?php
require 'scripts/db_init.php';
$BankId=$_GET['BankId'];
$stateId=$_GET['state'];
$DistId=$_GET['DistId'];


function BankInfo($BankUrl){
		$Sqql = ExecQuery("SELECT * FROM ifsc_bank WHERE bank_url='".$BankUrl."'");
		$rowsqlIfsc=mysql_fetch_array($Sqql);
		return $rowsqlIfsc;
	}

function GetCityId($CityName){
		$Sqql = ExecQuery("SELECT * FROM ifsc_state_dist WHERE state_city_url='".$CityName."' and sub_id=0");
		$rowsql=mysql_fetch_array($Sqql);
		return $rowsql;
	}
	


function DistInfo($stateCityUrl,$SubId){
		
		$Sqql = ExecQuery("SELECT * FROM ifsc_state_dist WHERE state_city_url='".$stateCityUrl."' AND sub_id!=0");
		$rowsql=mysql_fetch_array($Sqql);
		return $rowsql;
	}

$BankInfo = BankInfo($BankId);
$DistInfo = DistInfo($DistId,$stateId);
$StateInfo = GetCityId($stateId);
$sql=ExecQuery("SELECT * FROM ifsc_branch WHERE bank_id='".$BankInfo['id']."' and stateid='".$StateInfo['id']."' and state_id='".$DistInfo['id']."'");
?>
<select name="branch"  class="ifsc-select" onChange="return goSubmit('<?php echo $BankId?>','<?php echo $stateId;?>','<?php echo $DistId;?>',this.value)">
 <option>Select Location</option>
 <?php
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$data=$row['branch_name'];
$dataUrl=$row['branch_url'];
?>
    <option value=<?php echo $dataUrl;?>><?=$row['branch_name']?></option>
  <? } ?>
</select>