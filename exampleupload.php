<?PHP
//include class file
require('class.image-resize.php');
$obj = new img_opt();
// set maximum width within wich the image should be resized
$obj->max_width(300);
// set maximum height within wich the image should be resized
// for example size of the area in which image to be displayed
$obj->max_height(300);
$obj->image_path('upload_icici/63_IMG_1082.jpg');
// call the functio to resize the image
$a = $obj->image_resize();

echo $a;

?>