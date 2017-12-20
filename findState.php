<?php
require 'scripts/db_init.php';
require 'scripts/ifscfunctions.php';
$BankName=$_GET['BankName'];

$GetBankInfo = GetBankID($BankName);

$sql=ExecQuery("SELECT ifsc_state_dist.id, ifsc_state_dist.name, ifsc_state_dist.state_city_url, ifsc_branch.stateid FROM ifsc_branch INNER JOIN ifsc_state_dist ON ifsc_branch.stateid=ifsc_state_dist.id WHERE ifsc_branch.bank_id=".$GetBankInfo['id']." AND ifsc_state_dist.sub_id=0 group by ifsc_branch.stateid");

//$sql=ExecQuery("SELECT * FROM ifsc_state_dist WHERE sub_id=0 AND flag=1 GROUP BY name");
?>
<select name="state"  class="ifsc-select" onchange="getDist('<?php echo str_replace(" ","_",$BankName);?>',this.value)">
 <option>Select State</option>
 <?php
while($row=mysql_fetch_array($sql))
{
	
	
$id=$row['id'];
$data=$row['name'];
$dataUrl=$row['state_city_url'];
?>
    <option value="<? echo $dataUrl;?>"><?=$row['name']?></option>
  <? } ?>
</select>