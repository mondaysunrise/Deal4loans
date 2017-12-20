<?php

//$ch = curl_init("http://www.moneycontrol.com/insurance/latestnav/homebody.php");
//$fp = fopen("example_homepage.txt", "r+");
$getfile=file_get_contents ('example_homepage.txt',1);

echo $getfile;
//curl_setopt($ch, CURLOPT_FILE, $fp);
//curl_setopt($ch, CURLOPT_HEADER, 0);

//curl_exec($ch);
//curl_close($ch);
//fclose($fp);
?> 