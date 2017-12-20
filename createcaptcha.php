<?php

// generate random string and add it to the image
$random_string = rand();
$random_string = sha1($random_string);
$random_string = substr($random_string, 0, 7);
$_SESSION['random_string_ws']=$random_string;

header("Content-Type: image/png");
 // start image canvas
$image = @imagecreate(85, 30) or die("Could not create image!");
 
// allocate colors
imagecolorallocate($image,200,200,200);
$color_black = imagecolorallocate($image,0,0,0);
 



 
//imagestring($image, $font_size, $x_pos, $y_pos, $random_string, $color_black);
imagestring($image, 6, 10, 5,  $random_string, $color_black);
 
// output image and free up memory
imagepng($image);
imagedestroy($image);


echo $_SESSION['random_string_ws']."<br><br>";
?>