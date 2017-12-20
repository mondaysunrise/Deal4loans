<?php
session_start();
$strings = '123456789abcbefghjkmnpqrstuvwxyz';
//$strings = '123456789';
$i = 0;
$characters = 4;
$code = '';
while ($i < $characters)
{ 
    $code .= substr($strings, mt_rand(0, strlen($strings)-1), 1);
    $i++;
} 



//generate image
$im = imagecreatetruecolor(70, 30);
$foreground = imagecolorallocate($im, 0, 20, 0);
$shadow = imagecolorallocate($im, 255, 255, 255);
$background = imagecolorallocate($im, 255, 255, 255);

imagefilledrectangle($im, 0, 0, 90, 31, $background);

// use your own font!
$font = 'monofont.ttf';

//draw text:
imagettftext($im, 22, 0, 9, 20, $shadow, $font, $code);
imagettftext($im, 22, 0, 2, 24, $foreground, $font, $code);     

// prevent client side  caching
header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$_SESSION['captcha'] = $code;
//send image to browser
header ("Content-type: image/png");
imagepng($im);
imagedestroy($im);
?>