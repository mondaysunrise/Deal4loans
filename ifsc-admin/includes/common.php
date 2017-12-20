<?php
	define("SITE_NAME", "Deal4Loans IFSC Code - Admin");
	define("SITE_FULL_NAME", "Deal4Loans IFSC Code - Admin");
	if($_SERVER["SERVER_NAME"]=="localhost"){
	define("MAIN_URL", "http://localhost");
	define("SITE_URL", "http://localhost/deals/admin/");
	define("SITE_DOC_ROOT", "D:/wamp/www/deals/admin/");
	}else{
		define("SITE_URL", "http://www.deal4loans.com/ifsc-admin/");
		}
	$pageSecureUrl = SITE_URL;
	define("SITE_IMAGES", $pageSecureUrl . "images/");
	define("SITE_SUPPORT_EMAIL_ID", "support@deal4loans.com");
	define("SITE_INFO_EMAIL_ID", "info@deal4loans.com");
	define("SITE_QUOTE_URL", "http://".$_SERVER['HTTP_HOST']."/ifsc-admin/");
	
	define("EMAIL_SUBJECT","Deal4loans LMS");
	define("SITE_EMAIL_TEMPLATE", SITE_DOC_ROOT . "email-template/");
	define("RECORD_NOT_FOUND","No Record Found"); 
	
?>
