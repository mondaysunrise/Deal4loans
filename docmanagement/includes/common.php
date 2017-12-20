<?php
	define("SITE_NAME", "Deal4loans Docs Management ");
	define("SITE_FULL_NAME", "Deal4loans Docs Management ");
	if($_SERVER["SERVER_NAME"]=="localhost"){
	define("MAIN_URL", "http://localhost");
	define("SITE_URL", "http://localhost/deal4loans/docmanagement/");
	}else{
		define("SITE_URL", "http://www.deal4loans.com/docmanagement/");
		}
	$pageSecureUrl = SITE_URL;
	define("SITE_IMAGES", $pageSecureUrl . "images/");
	define("SITE_SUPPORT_EMAIL_ID", "support@deal4loans.com");
	define("SITE_INFO_EMAIL_ID", "info@deal4loans.com");
	define("SITE_QUOTE_URL", "http://".$_SERVER['HTTP_HOST']."/docmanagement/");
		
	define("RECORD_NOT_FOUND","No Record Found"); 
	define("PICKEDPERSONUPDATED","Assigned");
	define("DOCPICKED","Check Document Picked");
	define("DOCSTATUS","Document Status Updated");
	
?>
