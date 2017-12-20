<?php
require 'scripts/db_init.php';
require 'webservices_functions.php';

//http://www.deal4loans.com/pancard_validation.php?product=CCSMS&RequestID=1129839&pancard=BWYPS2610D
$product = $_REQUEST['product'];
$RequestID = $_REQUEST['RequestID'];
$pancard = $_REQUEST['pancard'];
if(strlen($pancard)==10)
{
	$dataArr['product'] = $product;
	$dataArr['RequestID'] = $RequestID;
	$dataArr['pancard'] = $pancard;
	$dataArr['api_version'] = "Production";
	
	if($product=="CCSMS"){
		$table = "Req_Credit_Card_Sms";
	}
	else if($product=="CC"){
		$table="Req_Credit_Card";
	}
	else if($product=="TWL"){
		$table="sbi_ccoffers_directonsite";
	}
	
	if($product == "TWL"){
		$getdetails="SELECT sbicc_name FROM ".$table." WHERE (sbiccoffersid='".$RequestID."')";
		list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
		$customerName =  str_replace(' ', '', strtolower($myrow['sbicc_name']));
	}
	else{
		$getdetails="SELECT Name FROM ".$table." WHERE (RequestID='".$RequestID."')";
		list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
		$customerName =  str_replace(' ', '', strtolower($myrow['Name']));
	}
	
	$getWebserviceSql="SELECT api_response, date_created FROM webservice_details_pl WHERE (product='".$product."' and productid='".$RequestID."' and api_request like '%".$pancard."%' and api_response!='') and date_created > DATE_SUB(NOW(), INTERVAL 90 DAY) ORDER BY date_created DESC LIMIT 0,1";
	list($alreadyExistDetails,$getWebserviceRow)=Mainselectfunc($getWebserviceSql,$array = array());
	
	$date_created = strtotime($getWebserviceRow['date_created'],strtotime("-0 minutes"));
	$currentDate =   date("Y-m-d h:i:s", strtotime("-1 minutes"));//time();
	$currentDate =  strtotime(date("Y-m-d H:i:s", strtotime("-1 minutes")));//time();
	$time_diff = ($currentDate - $date_created);//in seconds
	
	if($alreadyExistDetails>0)
	{
		$nameOnPancard =  str_replace(' ', '', strtolower(parseJsonPancard($getWebserviceRow['api_response'])));
	}
	else
	{
		$checkLogSql="SELECT api_response, date_created FROM webservice_details_pl WHERE product='".$product."' and productid='".$RequestID."' and api_request like '%".$pancard."%' and date_created > DATE_SUB(NOW(), INTERVAL 90 DAY)";
		list($alreadyExistLog,$getLogRow)=Mainselectfunc($checkLogSql,$array = array());
		if($alreadyExistLog>0)
		{
			echo '<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold; color:#ff0000;">In Process...</p>';
			die();
		}
		else
		{
			$nameOnPancard = str_replace(' ', '', strtolower(pancardValidation($dataArr)));
		}
	}
	//echo $nameOnPancard.'<br/>'.$customerName;
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
}
else
{
	echo '<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold; color:#ff0000;">Invalid Pancard</p>';
}
?>
