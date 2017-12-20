<?php
require 'scripts/db_init.php';

$city = $_REQUEST['city'];

?>
<option value="">Please Select</option>
<?php
if(!empty($city)){
	$getPinSql = "SELECT pincode FROM yes_cc_city_state_list WHERE city = '".$_REQUEST['city']."' ORDER BY pincode ASC";
					 
	list($numrows,$pincodelist) = MainselectfuncNew($getPinSql,$array = array());
	//echo '<pre>';print_r($pincodelist);exit;
	if(count($pincodelist) > 0){
		foreach($pincodelist as $key =>$val)
		{
		?>
			<option value="<?php echo $val['pincode']; ?>"><?php echo $val['pincode']; ?></option>
		<?php
		}
	}
	else{
		?>
			<option value="">Select Valid City</option>
		<?php
	}
}
else{
?>
		<option value="">Select City first</option>
<?php
}
?>

