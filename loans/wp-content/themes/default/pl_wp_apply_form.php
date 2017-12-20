<?php
$d4l_section="Wordpress CMS";
	
	if((strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/")) > 0))
	{
		$TagLine="Compare Bajaj Finserv Personal Loan | Interest Rates | Eligibility";
	}
	else if((strlen(strpos($_SERVER['REQUEST_URI'], "bajaj-finance-personal-loan")) > 0))
	{
		$TagLine="Apply Bajaj Finserv Personal Loan | Interest Rates | Eligibility";
	}
	else if((strlen(strpos($_SERVER['REQUEST_URI'], "indusind-bank-personal-loan")) > 0))
	{	
		$TagLine="Apply Online for IndusInd Bank Personal loan with Lowest Interest Rates";
	}
	else
	{
$TagLine ="Instant Apply For Personal Loan at Lowest Interest Rates";
	}
include "../personal-loan-widget-wp.php"; ?>
 