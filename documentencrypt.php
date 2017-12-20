<?php
//$path = '/home/deal4loans/public_html/upload/tatapl.pdf';
/*$path = '/home/deal4loans/public_html/images/spacer.gif';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
//$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
echo base64_encode($data);

//echo $base64;*/

$decodedata="R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==";
echo base64_decode($decodedata);

?>