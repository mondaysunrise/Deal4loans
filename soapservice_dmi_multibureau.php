<?php
$AGGREGATOR_ID = "546";
$INSTITUTION_ID = "4011";
$MEMBER_ID = "cpu_dmisix@dmif.com";
$PASSWORD = "MEphaEFIYSQ=";
$inputJson= '{"RESPONSE-FORMAT":["04"],"HEADER":{"REQUEST-TYPE":"REQUEST","APPLICATION-ID":"001N000001B2kQsIAJ","REQUEST-TIME":"2017-04-17 00:00:00","CUST-ID":"003N0000013B5EWIA0"},"REQUEST":{"08":"0.0","09":"DMI FINANCE","04":"10000", "05": "INDV","15": "PRE-SCREEN","22":"Male","06": "DMISF_cpu2cpu@dmifinance.com","07": "DIRECT","01":"PRIORITY","27":"18041987","11":"QA/UAT","03":"PERSONAL LOAN","29":[{"01":"RESIDENCE","02":"","03":"Street 150","04":"Bangalore","05":"560089","06":"Karnataka"}],"21":{"01":"null SP"},"30":{"01":"BSYPK6120M"},"71":"C","40":"18"}}';

$postfields = array("AGGREGATOR_ID" => $AGGREGATOR_ID, "INSTITUTION_ID" => $INSTITUTION_ID, "MEMBER_ID" =>$MEMBER_ID, "PASSWORD" =>$PASSWORD, "inputJson_" =>$inputJson);	
$headers = array("Content-Type:multipart/form-data");
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://ua1.multibureau.in/CODExS/saas/syncSaasRequest.action",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $postfields,
  CURLOPT_HTTPHEADER => $headers,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}