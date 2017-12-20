<?php
//echo "kjih";
error_reporting(E_ALL);
 $authCurl = curl_init();
    $data = array(
        "auth_username" => "testd4ddluser",
        "auth_password" => "d4lapi1234",
        "bidder_username" => "citibank_dummy@d4l.com",
        "bidder_password" => "citibankpl23may14"
    );
    $data_string = json_encode($data);
    //$header = array();
    //$header[] = 'Content-type: application/json';
	$AURL = "http://www.deal4loans.com/PartnerAPI/bidder-session.php";
    curl_setopt($authCurl, CURLOPT_URL, $AURL);
    curl_setopt($authCurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($authCurl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($authCurl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($authCurl, CURLOPT_RETURNTRANSFER, true);
    $authOutput = curl_exec($authCurl);
    $err = curl_error($authCurl);

curl_close($authCurl);

//var_dump($authOutput);

if ($err) {
  $responsefinal= "cURL Error #:" . $err;
} else {
  $responsefinal= $authOutput;
}
//echo "<br>--------------test-----------";
print_r($responsefinal);
//echo "<br>--------------test end-----------";
?>