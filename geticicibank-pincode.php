<?php
require 'scripts/db_init.php';

$city = $_REQUEST['city'];
?>
<select name="ResiPin" id="ResiPin" class="d4l-select">
<?php
$getPinSql = "SELECT pincode FROM icici_cc_city_state_list WHERE city = '".$_REQUEST['city']."' ORDER BY pincode ASC";
				 
list($numrows,$pincodelist) = MainselectfuncNew($getPinSql,$array = array());
//echo '<pre>';print_r($pincodelist);exit;
foreach($pincodelist as $key =>$val)
{
?>
	<option value="<?php echo $val['pincode']; ?>"><?php echo $val['pincode']; ?></option>   
<?php
}
?>
</select>
