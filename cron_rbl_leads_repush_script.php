<?php
ini_set('max_execution_time', 1000);
require 'scripts/db_init.php';
require_once ("lib/nusoap.php");

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$currentDayDateTime = date('Y-m-d 18:00:00');
$previousDayDateTime = date('Y-m-d 18:00:00', strtotime($currentDayDateTime .' -1 day'));
//echo $currentDayDateTime.'----'.$previousDayDateTime;exit;

$getRBLNoResponseLeadsInfoSQL = "SELECT * FROM `credit_card_banks_apply` WHERE `applied_bankname` = 'RBL Bank' AND request_data != '' AND response_data LIKE '%Status -,%' AND (DATE(date_created) BETWEEN '".$previousDayDateTime."' AND '".$currentDayDateTime."') ORDER BY id DESC LIMIT 0,1";
//echo $getRBLNoResponseLeadsInfoSQL;
list($numRows,$getRBLNoResponseLeadsInfoResponse) = MainselectfuncNew($getRBLNoResponseLeadsInfoSQL,$array = array());
//echo '<pre>';print_r($getRBLNoResponseLeadsInfoResponse);exit;

foreach($getRBLNoResponseLeadsInfoResponse as $key => $value){
	$id = $value['id'];
	$cc_requestid = $value['cc_requestid'];
	$lead_repush = $value['lead_repush'];
	$lead_repush_new = $lead_repush + 1;
	$lead_repush_date = date('Y-m-d H:i:s');
	
	$request_data = $value['request_data'];
	$request_data = explode(',', $request_data);
	//echo '<pre>';print_r($request_data);exit;
	
	$ConUniqRefCode = $request_data[1];
	$CreditCardApplied = $request_data[2];
	$title = $request_data[4];
	$first_name = $request_data[5];
	$last = $request_data[7];
	$Gender = $request_data[9];
	$dobstr = $request_data[10];
	$Residence_Address = $request_data[11];
	$citycode = $request_data[14];
	$pincode = $request_data[15];
	$Email = $request_data[16];
	$Mobile_Number = $request_data[17];
	$EmpType = $request_data[18];
	$monthlyincome = $request_data[19];
	$panno = $request_data[20];
	
	$auth = array("Authentication"=>array("UserId"=>"cc_connector_2", "Password"=>"pd9DFL2ua23X"));
	$cust_details = array("CreditCard"=>array("Version"=>6, "ConUniqRefCode"=>$ConUniqRefCode, "CreditCardApplied"=>$CreditCardApplied, "HadLoanOrCreditCardFromAnyBank"=>"Y", "Title"=>$title,"FirstName"=>$first_name, "MiddleName"=>"","LastName"=>$last,"FatherName"=>"","Gender"=>$Gender,"DOB"=>$dobstr,"ResAddress1"=>$Residence_Address, "ResAddress2"=>"", "Landmark"=>"","ResCity"=>$citycode, "ResPIN"=>$pincode, "Email"=>$Email, "Mobile"=>$Mobile_Number, "EmpType"=>$EmpType, "NMI"=>$monthlyincome, "PAN"=>$panno));
	$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));

	$UserId="cc_connector_2";
	$Password="pd9DFL2ua23X";	
	$soapClient = new nusoap_client("https://rblbank.rupeepower.com/connector/RPCreditCardConnector.wsdl?wsdl",true);   

	$soapClient->setCredentials($UserId, $Password, "basic");  
	$result= $soapClient->call("creditCard", $request_arr);
	
	//echo '<pre>';print_r($result);

	$Status = $result["Status"];
	$ReferenceCode = $result["ReferenceCode"];
	$EligibleCard = $result["EligibleCard"];
	$Errorcode = $result["Errorcode"];
	$Errorinfo = $result["Errorinfo"];
	$RequestIP = $result["RequestIP"];

	$response_data = "Status -".$Status.", ReferenceCode -".$ReferenceCode.", EligibleCard -".$EligibleCard.", Errorcode -".$Errorcode.",Errorinfo -".$Errorinfo.",RequestIP -".$RequestIP;

	$DataArray = array("response_data" =>$response_data, "lead_repush" => $lead_repush_new, "lead_repush_date" =>$lead_repush_date);
	$wherecondition ="(id='".$id."')";
	Mainupdatefunc ("credit_card_banks_apply", $DataArray, $wherecondition);
}
?>

