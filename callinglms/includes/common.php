<?php
	define("SITE_NAME", "Deal4loans LMS");
	define("SITE_FULL_NAME", "Deal4loans LMS");
	if($_SERVER["SERVER_NAME"]=="localhost"){
	define("MAIN_URL", "http://localhost");
	define("SITE_URL", "http://localhost/deals/callinglms/");
	define("SITE_DOC_ROOT", "D:/wamp/www/deals/callinglms/");
	}else{
		define("SITE_URL", "http://www.deal4loans.com/callinglms/");
		}
	$pageSecureUrl = SITE_URL;
	define("SITE_IMAGES", $pageSecureUrl . "images/");
	define("SITE_SUPPORT_EMAIL_ID", "support@deal4loans.com");
	define("SITE_INFO_EMAIL_ID", "info@deal4loans.com");
	define("SITE_QUOTE_URL", "http://".$_SERVER['HTTP_HOST']."/callinglms/");
	
	define("EMAIL_SUBJECT","Deal4loans LMS");
//	define("SITE_EMAIL_TEMPLATE", SITE_DOC_ROOT . "email-template/"); // commented by upendra 240117 [confirmed not getting used by YASWANT]
	define("RECORD_NOT_FOUND","No Record Found"); 
	
?>
