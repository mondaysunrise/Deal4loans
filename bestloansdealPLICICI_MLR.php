<?php
$url = "http://www.bestloansdeal.com/cronPLICICInew.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec ($ch);
	print_r($content); 
	curl_close ($ch);  
	$val = explode(',', $content);
	
	?>