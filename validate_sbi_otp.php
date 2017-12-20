<?php
require_once 'scripts/db_init.php';

$ProductValue = $_REQUEST["request_id"];
$bank_reference_code = $_REQUEST["bank_reference_code"];

if($ProductValue>0 && $bank_reference_code != ''){
	$checkotpcodeqry="SELECT Reference_Code FROM Req_Credit_Card WHERE RequestID='".$ProductValue."' AND Reference_Code='".$bank_reference_code."'";
	list($recordcount , $resultotpcode) = MainselectfuncNew($checkotpcodeqry, $array = array());
	if($recordcount){
		 $message = "Verified Successfully"; 
		 $dataUpdate= array('Is_Valid'=>1);
		 $wherecondition = "(RequestID =" . $ProductValue. ")";
		  Mainupdatefunc('Req_Credit_Card', $dataUpdate, $wherecondition);
	}else{
		$message = "Incorrect OTP";
	}
	$result = array("message" => $message);
	echo json_encode($result);
	exit;
}
?>
