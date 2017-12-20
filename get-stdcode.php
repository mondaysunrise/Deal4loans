<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
 $Pincodedetails = $_REQUEST['q'];
?>

<?php
$getPinSql = "SELECT * FROM sbi_cc_city_state_list WHERE pincode ='".$Pincodedetails."'";
list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getPinSql,$array = array());
$stdCode = $getCarNameQuery[0]['std'];
	?>
 	
    <input type="text" name="STD" style="width:50px; height:20px; border:none;" value="<?php echo $stdCode; ?>">