<?php
$pan_card='ALVPH6279G';
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.karza.in/pan",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n   \"pan\":\"$pan_card\",\r\n   \"key\":\"DLAKBVWPMZLFJENK\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
//    "postman-token: b2d76d2a-4b9e-e8fa-32d0-fec113dd5f4a"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
//{"result": {"status": "", "name": "UPENDRA KUMAR", "jurisdiction": "", "area_code": "", "ao_number": "", "ao_type": "", "range_code": "", "email": "", "building_name": ""}}
?>
