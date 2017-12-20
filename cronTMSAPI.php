<?php
require 'scripts/db_init.php';

$id = $_REQUEST['id'];
$product_type = $_REQUEST['product_type'];
$lead_id = $_REQUEST['lead_id'];
$credit_card_id = $_REQUEST['credit_card_id'];
$bank_code = $_REQUEST['bank_code'];
$date_requested = $_REQUEST['date_requested'];
$requester = $_REQUEST['requester'];
$date_started = $_REQUEST['date_started'];
$date_ended = $_REQUEST['date_ended'];
$bank_api_header = $_REQUEST['bank_api_header'];
$bank_api_request_data = $_REQUEST['bank_api_request_data'];
$bank_api_response_data = $_REQUEST['bank_api_response_data'];
$reference_hash = $_REQUEST['reference_hash'];
$application_id = $_REQUEST['application_id'];
$json_header = $_REQUEST['json_header'];
$json_request_data = $_REQUEST['json_request_data'];
$json_response_data = $_REQUEST['json_response_data'];
$retry = $_REQUEST['retry'];
$web_services_default_values_id = $_REQUEST['web_services_default_values_id'];
$d4l_id = $_REQUEST['d4l_id'];


$getdetails = "select id From xkyknzl5dwfyk4hg_tms_bank_api  Where (id='".$id."')";
    list($alreadyExist, $myrow) = MainselectfuncNew($getdetails, $array = array());
    $myrowcontr = count($myrow) - 1;

    if ($alreadyExist > 0) {
  
        $ProductValue = $myrow[$myrowcontr]["id"];
        $InsertStatus = "2";
    } else {
	$dataInsert = '';
	$dataInsert['id'] = $id;
	$dataInsert['product_type'] = $product_type;
	$dataInsert['lead_id'] = $lead_id;
	$dataInsert['credit_card_id'] = $credit_card_id;
	$dataInsert['bank_code'] = $bank_code;
	$dataInsert['date_requested'] = $date_requested;
	$dataInsert['requester'] = $requester;
	$dataInsert['date_started'] = $date_started;
	$dataInsert['date_ended'] = $date_ended;
	$dataInsert['bank_api_header'] = $bank_api_header;
	$dataInsert['bank_api_request_data'] = $bank_api_request_data;
	$dataInsert['bank_api_response_data'] = $bank_api_response_data;
	$dataInsert['reference_hash'] = $reference_hash;
	$dataInsert['application_id'] = $application_id;
	$dataInsert['json_header'] = $json_header;
	$dataInsert['json_request_data'] = $json_request_data;
	$dataInsert['json_response_data'] = $json_response_data;
	$dataInsert['retry'] = $retry;
	$dataInsert['web_services_default_values_id'] = $web_services_default_values_id;
	$dataInsert['d4l_id'] = $d4l_id;
	$ProductValue= Maininsertfunc ('xkyknzl5dwfyk4hg_tms_bank_api', $dataInsert);
	
	$getCityQuery = ExecQuery("select City, City_Other from Req_Loan_Personal where RequestID='".$d4l_id."'");
	$City = mysql_result($getCityQuery,0,'City');
	if($City=="Others")
	{
		$City = mysql_result($getCityQuery,0,'City_Other');
	}
	
	$checkCitySql = "select BidderID from Bidders_List where BidderID in (6458) and City like '%".$City."%'";
	$checkCityQuery = ExecQuery($checkCitySql);
	$checkCityCount = mysql_num_rows($checkCityQuery);
   
//    if($bank_code=='229' && ($web_services_default_values_id==2 || $web_services_default_values_id==9) && ($checkCityCount>0) )
    if($web_services_default_values_id==2 || $web_services_default_values_id==9 )
    {    
    	$updateqry= "Update Req_Loan_Personal set tu_status='1' Where (RequestID='".$d4l_id."')";
		//echo "<br><br>";
		$updateqryresult = ExecQuery($updateqry);
	}
	$InsertStatus = "1";
}

echo $InsertStatus;
echo "," . $ProductValue;


//INSERT INTO xkyknzl5dwfyk4hg_tms_bank_api (id, product_type, lead_id, credit_card_id, bank_code, date_requested, requester, date_started, date_ended, bank_api_header, bank_api_request_data, bank_api_response_data, reference_hash, application_id, json_header, json_request_data, json_response_data, retry, web_services_default_values_id) VALUES (NULL, '', '', '', '', CURRENT_TIMESTAMP, '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '', '', '', NULL, NULL, '', '', '', '1', '');

?>