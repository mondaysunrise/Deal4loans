<?php
require 'scripts/db_init.php';
function parseJsonPancard($json)
{
	$decode_json = json_decode($json);
	$result_set = $decode_json->result;
	$name_on_pancard = $result_set->name;
	return $name_on_pancard;
}


$product = 'CCSMS';
$RequestID=1048903;
$pancard='BEQPR3860C';
	$table="Req_Credit_Card";

$getdetails="SELECT Name FROM ".$table." WHERE (RequestID='".$RequestID."')";
		list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
		$customerName =  str_replace(' ', '', strtolower($myrow['Name']));


//$getWebserviceSql="SELECT api_response,date_created FROM webservice_details_pl WHERE (product='".$product."' and productid='".$RequestID."' and api_request like '%".$pancard."%' and api_response!='') and date_created > DATE_SUB(NOW(), INTERVAL 90 DAY) ORDER BY date_created DESC LIMIT 0,1";
echo $getWebserviceSql="SELECT api_response,date_created FROM webservice_details_pl WHERE (productid='".$RequestID."')";
	// and date_created>DATE_SUB(NOW(), INTERVAL 1 MINUTE
	list($alreadyExistDetails,$getWebserviceRow)=Mainselectfunc($getWebserviceSql,$array = array());
	
	
	$date_created = strtotime($getWebserviceRow['date_created'],strtotime("-0 minutes"));
	$currentDate =   date("Y-m-d h:i:s", strtotime("-1 minutes"));//time();
	$date_created = strtotime("2017-06-21 15:02:00");
	$currentDate =  strtotime(date("Y-m-d H:i:s", strtotime("-1 minutes")));//time();
	$time_diff = ($currentDate - $date_created);//in seconds
	echo "<br>";
	echo "date_created".$date_created;
	echo "<br>";
	echo "currentDate ".$currentDate;
		echo "<br>";
	echo "time_diff".$time_diff;
		echo "<br>";
		
		

//	$date_created = ;
	if($alreadyExistDetails>0)
	{
	echo "EXIST";
		echo "<br>";
		$nameOnPancard =  str_replace(' ', '', strtolower(parseJsonPancard($getWebserviceRow['api_response'])));
	}
	else
	{
		if($time_diff>60)
		{
	echo "Should Hit Web Service";	echo "<br>";
		}
		//$nameOnPancard = str_replace(' ', '', strtolower(pancardValidation($dataArr)));
	}
	
	echo "NameonPan -".$nameOnPancard.'CustomerName -'.$customerName;
	$finalStatus ='';
	if($nameOnPancard==$customerName)
	{
		$finalStatus = "Name & Pan logic Matched";
	}
	else
	{
		$finalStatus = "Name & Pan logic Not Matched";
	}
	echo '<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold; color:#ff0000;">'.$finalStatus.'</p>';
?>