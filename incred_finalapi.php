<?php
finalapi();
function finalapi() {

$apparray=	array("4253058582051037A", "7984545462051089A", "2274892262051099A", "6303894520519029A", "9770188352051056A", "3691221052051019A", "4504161432051044A", "1388432822051069A", "2628480722051047A", "8534081220512071A", "4920716412051055A", "4780296571051071A", "4969401571051016A", "7749222561051088A");

for($i=0;$i<count($apparray);$i++)
	{
$ApplicationID= $apparray[$i];
$headers = array("api-key: f72a08fcae3e1710acf678f5e9db4789c84733fbcb281af63020350cecbc42","Content-Type:application/json"); 
$postfields = '{"APPLICATION_ID": "'.$ApplicationID.'"}';
$url="https://api.incred.com/markAppComplete";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
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
  echo $response."<br>";
}
	}
}

//4504161432051044A, 7444306303051030A,9723596920514016A,2805882782051075A