<?php
include "includes/application-top-inner.php";
$stateId=$_GET['state'];

$Query = "SELECT * FROM " .TABLE_STATE_LOC." WHERE sub_id!=0 and sub_id='".$stateId."'";
$result = $obj->fun_db_query($Query);


?>
<select name="District" class="ifsc-select">
 <option>Select City</option>
 <?php
while($rowsCon = $obj->fun_db_fetch_rs_object($result))
{
$id=$rowsCon->id;
$data=$rowsCon->name;
$dataUrl=$rowsCon->state_city_url;
?>
    <option value=<?php echo $dataUrl?>><?=$data;?></option>
  <? } ?>
</select>