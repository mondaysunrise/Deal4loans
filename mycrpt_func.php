<?php
$key = 'password to (en/de)crypt';
$string = 'string to be encrypted';
$newkey='d4l';
$newstring ='saibaba4321';
$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($key))), "\0");


 $newencrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256 , md5($newkey) , $newstring , MCRYPT_MODE_CBC , md5($newkey)));

 $newdecrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($newkey), base64_decode($newencrypted), MCRYPT_MODE_CBC, md5($newkey)), "\0");

var_dump($encrypted);
echo "<br><br>";
var_dump($decrypted);
echo "<br><br>";
var_dump($newencrypted);
echo "<br><br>";
var_dump($newdecrypted);
?>