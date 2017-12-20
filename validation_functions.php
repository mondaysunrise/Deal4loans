<?php
require_once 'scripts/db_init.php';
require_once 'webservices_functions.php';

//Validation for PANCARD 
//$product = $_REQUEST['product'];
//$RequestID = $_REQUEST['RequestID'];
//$pancard = $_REQUEST['pancard'];

//echo checkPancardValidation($RequestID,$pancard,$product,"UAT");

function checkPancardValidation($RequestID,$pancard,$product,$api_version="Production")
{
	//http://www.deal4loans.com/validation_functions.php?product=CC&RequestID=1055094&pancard=atdpk2777a
	$product = $product;
	$RequestID = $RequestID;
	$pancard = $pancard;
	if(strlen($pancard)==10)
	{
		$dataArr['product'] = $product;
		$dataArr['RequestID'] = $RequestID;
		$dataArr['pancard'] = $pancard;
		$dataArr['api_version'] = $api_version;
		
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
				//echo '<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold; color:#ff0000;">In Process...</p>';
				$finalStatus = "INPROCESS";
				return $finalStatus;
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
					$finalStatus = "MATCHED";
				}
				else
				{
					$finalStatus = "NOTMATCHED";
				}
			}
			else{

				if($result=="No Record Found")
				{
					$finalStatus="NORECORDFOUND";
				}
				else
				{
					//$finalStatus = $result;
					$finalStatus = "WEBSERVICEERROR";
					
				}
				//echo "Final STatus".$finalStatus;
			}
		}
		else {
			//$finalStatus = $responsejson;
			$finalStatus = "PARSEERROR";
		}
		//echo '<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold; color:#ff0000;">'.$finalStatus.'</p>';
	}
	else
	{
		//echo '<p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold; color:#ff0000;">Invalid Pancard</p>';
		$finalStatus = "INVALIDPAN";
	}
	return $finalStatus;
}
?>
