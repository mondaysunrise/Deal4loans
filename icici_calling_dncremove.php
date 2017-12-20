<?php
require 'scripts/db_init.php';

$today= date('Y-m-d');
$min_date=$today." 00:00:00";
$max_date=$today." 23:59:59";

$icicidnclist="Select Mobile_Number From icici_callingdata_DNC Where (Dated between '".$min_date."' and '".$max_date."')";
list($numRows,$row)=MainselectfuncNew($icicidnclist,$array = array());
for($i=0;$i<$numRows;$i++)
{
	$Mobile_Number = $row[$i]["Mobile_Number"];
	$DataArray = array("Privacy"=>'0', "DNC_flag"=>'1');
	$wherecondition ="(Mobile_Number = '".$Mobile_Number."')";
	Mainupdatefunc ('icici_cards_calling', $DataArray, $wherecondition);
}
echo "DONE";

?>