<?php 
$d4l_section="Wordpress CMS";
if(strlen(strpos($_SERVER['REQUEST_URI'], "/loans/loan/gold-loan-loan/sbi-gold-loan-interest-rates-onlinme-apply-eligibility/")) > 0)
{
	include "gold_loan_form1.php";
	$TagLine="Apply Gold Loan";
}
else
{
	$TagLine="Apply Gold Loan";
	include "../gold-loan-widget-wp.php";
 } ?>