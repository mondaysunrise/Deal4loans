<?php

function get_url_contents($url){
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, 0);
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
}

$url ="http://www.deal4loans.com/debitcard-versus-creditcard.php";
$str = get_url_contents($url);




echo $str;
?>