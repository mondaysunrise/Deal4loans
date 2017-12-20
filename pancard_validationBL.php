<?php
require 'scripts/db_init.php';
require 'webservices_functions.php';

//http://www.deal4loans.com/pancard_validation.php?product=CCSMS&RequestID=469233&pancard=BWYPS2610D
$product = $_REQUEST['product'];
$RequestID = $_REQUEST['RequestID'];
$pancard = $_REQUEST['pancard'];
//die();
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
	else if($product=="BL"){
		$table="Req_Loan_Personal";
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
	
	if($alreadyExistDetails>0)
	{
		$responsejson = $getWebserviceRow['api_response'];
	}
	else
	{
		$checkLogSql="SELECT api_response, date_created FROM webservice_details_pl WHERE product='".$product."' and productid='".$RequestID."' and api_request like '%".$pancard."%' and date_created > DATE_SUB(NOW(), INTERVAL 90 DAY)  ORDER BY date_created DESC LIMIT 0,1";
		list($alreadyExistLog,$getLogRow)=Mainselectfunc($checkLogSql,$array = array());
		if($alreadyExistLog>0)
		{
			echo '<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold; color:#ff0000;">In Process...</p>';
			die();
		}
		else
		{
			$responsejson = pancardValidation($dataArr);
		}
	}
	
	$ParsedRes = json_decode($responsejson,true);
	//echo '<pre>';print_r($ParsedRes);
	
	if(is_array($ParsedRes)){
		$result = $ParsedRes['result'];
		
		$finalStatus ='';
		if(is_array($result)){
			$nameOnPancard = $result['name'];
			$nameOnPancard =  str_replace(' ', '', strtolower($nameOnPancard));
			//echo $nameOnPancard.'<br/>'.'customername'.$customerName;

			if($nameOnPancard==$customerName)
			{
				$finalStatus = "Name & Pan logic Matched [".trim($result['name'])."]";
			}
			else
			{
				$finalStatus = "Name & Pan logic Not Matched [".trim($result['name'])."]";
			}
		}
		else{
			$finalStatus = $result;
		}
	}
	else{
		$finalStatus = $responsejson;
	}
	echo '<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold; color:#ff0000;">'.$finalStatus.'</p>';
}
else
{
	echo '<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold; color:#ff0000;">Invalid Pancard</p>';
}
?>
