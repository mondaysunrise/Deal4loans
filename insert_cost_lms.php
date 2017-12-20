<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$get_lead_cost = $_REQUEST['lead_cost'];
	$get_requestid = $_REQUEST['get_requestid'];
	$get_product = $_REQUEST['get_product'];
	$i = $_REQUEST['get_id'];

if(strlen(trim($get_requestid))>0)
{
	$DataArray = array("lead_cost"=>$get_lead_cost);
	$wherecondition ="(RequestID='".$get_requestid."')";
	Mainupdatefunc ($get_product, $DataArray, $wherecondition);
}
?>
<input name="lead_cost_<?php echo $i; ?>" id="lead_cost_<?php echo $i; ?>" value="<? echo $get_lead_cost; ?>" size="7" />  <a  onClick="return addCost('<?php echo $i; ?>');"><strong>Add</strong></a>
