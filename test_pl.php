<?php
$ch = curl_init();
        $url = "https://beta.wishfin.com/api/bankList";
        $bankName = 'HDfc';
        $data = array(
            "where" => array( 'status' => 1,
                    'bank_name' => array(
                        'op' => 'like',
                        'val' => "%$bankName%"
                    )
            ), 
           
        );                                                                 
        $data_string = json_encode($data);                
        	$apiPwd =  '8X7DjqpL';
	$apiUser = 'deal4loans';
	$apiKey = 'ZGVhbDRsb2Fuc3w4WDdEanFwTA';
        $header = array();
        $header[] = 'Content-length: '. strlen($data_string);
        $header[] = 'Content-type: application/json';
        $header[] = 'Api_password:'.$apiPwd;
        $header[] = 'Api_user: '.$apiUser;
        $header[] = 'Api_key: '.$apiKey;
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output=curl_exec($ch);
        curl_close($ch);
        print_r($output);
       $relationshipManagerinitial_rating = "3.5";
$RateImg ='';
$NoStar = 5 - $relationshipManagerinitial_rating;
for ($k = 1; $k <= $relationshipManagerinitial_rating; $k++) {
    $RateImg .= "<img src=\"https://www.wishfin.com/images/star-rate.png\" alt=\"rating\">";
}

for ($j = 1; $j <= $NoStar; $j++) {
    $RateImg .= "<img src=\"https://www.wishfin.com/images/no-star-rate.png\" alt=\"rating\">";
}

?>

