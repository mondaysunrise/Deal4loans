<?php
	define("SITE_NAME", "Deal4loans LMS Admin");
	define("SITE_FULL_NAME", "Deal4loans LMS Admin");
	if($_SERVER["SERVER_NAME"]=="localhost"){
	define("MAIN_URL", "http://localhost");
	define("SITE_URL", "http://localhost/deal4loans/callingadmin/");
	}else{
		define("SITE_URL", "http://www.deal4loans.com/callingadmin/");
		}
	$pageSecureUrl = SITE_URL;
	define("SITE_IMAGES", $pageSecureUrl . "images/");
	define("SITE_SUPPORT_EMAIL_ID", "support@deal4loans.com");
	define("SITE_INFO_EMAIL_ID", "info@deal4loans.com");
	define("SITE_QUOTE_URL", "http://".$_SERVER['HTTP_HOST']."/callingadmin/");
		
	define("RECORD_NOT_FOUND","No Record Found"); 
	
?>
