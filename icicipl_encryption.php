<?php

$publicKey = "BgIAAACkAABSU0ExAAQAAAEAAQBNSbsNLg+hMtCBpjOMF4EkqysbYaV8bDDQXq0Xm+EECyNeDug/O/KajxncM7fiRfrnvpbjXMLfSei1GdT1NQHjVm1pOmbmnYyBKvZqxtXYbtdk7SepHFgozoYKiwEHfBUUK3e/dyr/IBV334++npIWhTlIDgJN/1EXPNJrZYWKyg==";
$plaintext = "Password@123";

openssl_public_encrypt($plaintext, $encrypted, $publicKey);

echo "password: ".$encrypted;   //encrypted string

?>