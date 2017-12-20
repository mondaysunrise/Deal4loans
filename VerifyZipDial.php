<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

//print_r($_REQUEST);
$get_RequestID = $_REQUEST['get_RequestID'];
$get_proid = trim($_REQUEST['get_proid']) ;

$valu="";
function getzipdialtblnew($pKey)
{
    $titles = array(
        1 => 'Req_Loan_Personal',
        2 => 'Req_Loan_Home',
        3 => 'Req_Loan_Car',
        4 => 'Req_Credit_Card',
        5 => 'Req_Loan_Against_Property',
		
        
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}

$gettbl_nme= getzipdialtblnew($get_proid);

$checkSql = "select Is_Valid from ".$gettbl_nme." where RequestID = '".$get_RequestID."'";
list($numRows,$checkQuery)=Mainselectfunc($checkSql,$array = array());
echo $Is_Valid = $checkQuery[0]['Is_Valid'];

 if($Is_Valid==1)
 {
	 $valu="yes";
 }
 else
 {
		$valu="no";
 }

echo $valu;

?>