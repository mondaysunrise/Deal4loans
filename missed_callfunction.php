<?php
	require 'scripts/db_init.php';
	require 'scripts/db_init_bima.php';

	//$client_transaction_id = $_REQUEST['client_transaction_id'];
	$transaction_token = $_REQUEST['transaction_token'];
	//$mobile = $_REQUEST['mobile'];
	//$verified = $_REQUEST['verified'];

$DataArray = array("verified"=>1, "modified"=>$Dated);
$wherecondition ="transaction_token='".$transaction_token."'";
Mainupdatefunc ('z2v_transactions', $DataArray, $wherecondition);


$getSql = "select * from z2v_transactions where transaction_token='".$transaction_token."'";
list($recordcount,$getrow)=MainselectfuncNew($getSql,$array = array());
$cntr=0;
$client_transaction_id = $getrow[$cntr]['client_transaction_id'];


list($requestid,$product) = split('[_]', $client_transaction_id);

function getzipdialtbl($pKey)
{
    $titles = array(
        "PL"=> 'Req_Loan_Personal',
        "HL"=> 'Req_Loan_Home',
        "CL"=> 'Req_Loan_Car',
        "CC"=> 'Req_Credit_Card',
        "LAP"=> 'Req_Loan_Against_Property',
		"LI"=> 'Req_Life_Insurance',
		"HI"=> 'Req_Health_Insurance',
	   "MI"=> 'Req_Auto_Insurance'
        
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}

$tbl_name=getzipdialtbl($product);


//update query

if($product=="LI" || $product=="MI")
{
	$updateproduct = "Update ".$tbl_name." Set Is_Valid=1, zipdial_valid=1 Where RequestID=".$requestid;
$updateproductQuery = ExecQuery_bima($updateproduct);
}
else if($product=="HI")
{
	$updateproduct = "Update ".$tbl_name." Set Is_Valid=1,valid_hdfcergo=1, Allocated=2 Where RequestID=".$requestid;
	$updateproductQuery = ExecQuery_bima($updateproduct);
}
else if($product=="CL")
{
	$updateproduct = "Update ".$tbl_name." Set Is_Valid=1, Allocated=2 Where RequestID=".$requestid;
	$updateproductQuery = ExecQuery($updateproduct);
}
else
{
	$updateproduct = "Update ".$tbl_name." Set Is_Valid=1 Where RequestID=".$requestid;
	$updateproductQuery = ExecQuery($updateproduct);
}


?>