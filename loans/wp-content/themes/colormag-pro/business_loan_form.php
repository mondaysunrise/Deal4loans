<?php 
if($_SERVER['REQUEST_URI'] != "/loans/" && $_SERVER['REQUEST_URI'] != "/loans/category/personal-loan/"  && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/category/")) < 1) && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/?s=")) < 1))
{
$d4l_section="Wordpress CMS";
$TagLine="Apply Business Loan";
include "../business-loan-widget-wp.php";
}
?>