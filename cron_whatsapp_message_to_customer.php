<?php
require 'scripts/db_init.php';
require 'wishfin_whatsapp_api.php';
/*
* @author Upendra Kumar <upendra@wishfin.com>
* @date 18/08/2017
* Whatsapp Message to Customer
* Message will be send to the Customer after 4 days of allocation
* Excluse Feedback - Not Eligible
* Send to Customers
*/
$Dated = ExactServerdate();

$timestamp = time();
if(date('D', $timestamp) === 'Mon') 
{
	$define_initial_mktime = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
}
else
{
	$define_initial_mktime = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
}
$define_final_mktime = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$define_initial_date=date('Y-m-d',$define_initial_mktime);
$define_final_date=date('Y-m-d',$define_final_mktime);
$min_date=$define_initial_date." 00:00:00";
$max_date=$define_final_date." 23:59:59";

$querySql = "SELECT * FROM `webservice_whatsapp` WHERE (date_created Between '" . ($min_date) . "' and '" . ($max_date) . "') AND status=0";
//$querySql = "SELECT * FROM `webservice_whatsapp` WHERE (date_created Between '" . ($min_date) . "' and '" . ($max_date) . "') AND status=0 AND id=1211";
echo $querySql."<br>";
list($recordcount,$records)=MainselectfuncNew($querySql,$array = array());
//die();
$DataArray='';
for($i=0;$i<$recordcount;$i++)
{
$DataArray='';
//$data = array("bidder_id"=> $BidderID,  "bidder_name"=> $Bidder_Name,  "customer_name"=> $Name,  "customer_mobile"=> $Mobile_Number,  "lead_id"=> $AllRequestID, "table_name"=> $product_tbl, "feedback"=> $Feedback, "allocation_date"=>$Allocation_Date);
	$id= $records[$i]["id"];
	$bank_name= $records[$i]["bidder_name"];
	$customer_name= trim($records[$i]["customer_name"]);
	$mobile= $records[$i]["customer_mobile"];
	$table_name= $records[$i]["table_name"];
	$lead_id= $records[$i]["lead_id"];
	//$mobile=9971396361;
	echo $mobile.",".$table_name.",".$lead_id.",".$customer_name.",".$bank_name."<br>";
	$returnValue = json_decode(whatsappSendMessage($mobile,$table_name,$lead_id,$customer_name,$bank_name));
	$status_message= $returnValue->status;
	if($status_message=="Message Sent")
	{
		$status = 1;
	}
	else
	{
		$status = 0;
	}
	$DataArray= array("status"=> $status, "message_sent_date"=> $Dated, "status_message"=>$status_message);
	print_r($DataArray);
	$wherecondition ="(id=".$id.")";
	Mainupdatefunc ('webservice_whatsapp', $DataArray, $wherecondition);

//	echo " [ ".$recordcountLeads." ] ";
	echo "<br />"; echo "<br />";
}
?>