<?php
ini_set('max_execution_time', 2000);
require 'scripts/db_init.php';

$currentDayDateTime = date('Y-m-d 18:00:00');
$previousDayDateTime = date('Y-m-d 18:00:00', strtotime($currentDayDateTime .' -1 day'));
//echo $currentDayDateTime.'----'.$previousDayDateTime;exit;

$getAmexNoResponseLeadsInfoSQL = "SELECT * FROM `credit_card_banks_apply` WHERE applied_bankname = 'American Express' AND request_data !='' AND response_data = '' AND DATE(date_created) BETWEEN '2017-08-01' AND '2017-08-30' ORDER BY `date_created` ASC";
//echo $getAmexNoResponseLeadsInfoSQL;exit;
list($numRows,$getAmexNoResponseLeadsInfoResponse) = MainselectfuncNew($getAmexNoResponseLeadsInfoSQL,$array = array());
//echo '<pre>';print_r($getAmexNoResponseLeadsInfoResponse);exit;

foreach($getAmexNoResponseLeadsInfoResponse as $key => $value){
	$id = $value['id'];
	$lead_repush = $value['lead_repush'];
	$xmstr = $value['request_data'];
	//echo $xmstr;
	$lead_repush_new = $lead_repush + 1;
	$lead_repush_date = date('Y-m-d H:i:s');

	$url="https://www.americanexpressindia.co.in/webservices/singleform/dealsforloan.asmx?wsdl";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmstr");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	
	//echo $id.'---';	print_r($output);
	//echo '<br>';

	$DataArray = array("response_data" =>$output, "lead_repush" => $lead_repush_new, "lead_repush_date" =>$lead_repush_date);
	$wherecondition ="(id='".$id."')";
	Mainupdatefunc ("credit_card_banks_apply", $DataArray, $wherecondition);
}
?>
