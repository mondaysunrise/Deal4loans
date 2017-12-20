<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

function mobile_verify($Phone,$client_transaction_id)
{
 $response = file_get_contents("http://www.zipdial.com/zip2auth/v2/transactions/start_transaction?token=04f0294522530730a4671c96a8a35cac6c47714d&clientTransactionId=$client_transaction_id&callerPhone1=$Phone&duration=30&country_code=91"); 

//echo $response;
$explod = explode(",", $response);
//print_r($explod);
//echo "<br>";
$explod2 = explode('":"', $explod[2]);

$image = substr(trim($explod2[1]), 0, strlen(trim($explod2[1]))-1);
//$array = json_decode($response);

$img = str_replace("\/", "/", $image);
//echo "<br><br>";
//$img = $array->img; 
echo ("<img src='$img'/>"); 

//echo "<br><br>";
$explod3 = explode('":"', $explod[3]);

$transaction_token = substr(trim($explod3[1]), 0, strlen(trim($explod3[1]))-1);
//echo "<br>";


$Dated = ExactServerdate();
$dataInsert = array('client_transaction_id'=>$client_transaction_id, 'zipdial_no'=>$zipdial_no, 'transaction_token'=>$transaction_token, 'mobile'=>$Phone, 'verified'=>$verified, 'created'=>$Dated);
$table = 'z2v_transactions';
$insert = Maininsertfunc ($table, $dataInsert);

}

mobile_verify("9811215138","01728182LAP");
?>
