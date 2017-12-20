<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "../api/v1/converttopdf/convert2pdf.php";


$fileName = $_REQUEST["flnme"];
$vid = $_REQUEST["vid"];


//$filenameinclude="http://www.deal4loans.com/cibil/creditreport_forpdf.php?".$vid;
$filenameinclude="http://www.deal4loans.com/cibil/creditreport_forpdf-21-9-2017.php?".$vid;

 $content=file_get_contents($filenameinclude);

echo $pdfArr =createPdf($fileName, $content);

?>