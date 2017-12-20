<?php
if($_SERVER['REQUEST_URI'] != "/loans/" && $_SERVER['REQUEST_URI'] != "/loans/category/car-loan/" && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/category/")) < 1) && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/?s=")) < 1))
{
$d4l_section="Wordpress CMS";
if((strlen(strpos($_SERVER['REQUEST_URI'], "hdfc-car-loan-eligibility-interest-rates-and-documents-requirement-for-apply-hdfc-bank-car-loans")) > 0))
{	$subjectLine="Apply for Car loan from HDFC Bank at best rates"; }
   elseif((strlen(strpos($_SERVER['REQUEST_URI'], "sbi-advantage-car-loans-car-loan-scheme-sbi")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "sbi-car-loan-interest-rates-eligibility-documents-apply")) > 0))
{
$subjectLine="Compare & Apply for Best Car Loans from Top 10 Banks";
}
else{ 	$subjectLine="Compare & Apply for Best Car Loans from Top 10 Banks";}

//$retrivesource = the_title(); 
include "../car-loans-widget-wp.php"; 
}
?>