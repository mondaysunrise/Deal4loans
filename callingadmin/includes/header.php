<?php
ob_start();
if ((strlen(strpos($_SERVER['PHP_SELF'], "index")) > 0)) {
	if(($_SERVER['SCRIPT_NAME']=="/callingadmin/hlloanlms_index.php") || ($_SERVER['SCRIPT_NAME']=="/callingadmin/hlreferlms_index.php") || ($_SERVER['SCRIPT_NAME'] =="/callingadmin/hlloanbtlms_index.php") || ($_SERVER['SCRIPT_NAME']=="/callingadmin/hlloanlms_index_exclusive.php") || ($_SERVER['SCRIPT_NAME']=="/callingadmin/hlloancallinglms_index.php"))
	{
		require_once("includes/application-top-inner.php");
   
		if (!$objAdmin->fun_check_page_access($_SESSION['BidderID'], $_SERVER['SCRIPT_NAME'], $_SESSION['leadidentifier'])) 
		{
			//echo "...";
			echo "Not Authorised.";
			//User not allowed to access
		    //Expire the session
		    session_unset(); session_destroy(); echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/login_access_denied.php">';
			die(); 
		}

	}
    else 
    {
	    require_once("includes/application-top.php");
    }
} else if (strlen(strpos($_SERVER['PHP_SELF'], "agentlogin")) > 0) {
    require_once("includes/application-top.php");
   
} else if (strlen(strpos($_SERVER['PHP_SELF'], "hllmslogin")) > 0) {
    require_once("includes/application-top.php");
   
}else {
    require_once("includes/application-top-inner.php");
   
	if (!$objAdmin->fun_check_page_access($_SESSION['BidderID'], $_SERVER['SCRIPT_NAME'], $_SESSION['leadidentifier'])) 
	{
		
		echo "Not Authorised.";
		//User not allowed to access
	    //Expire the session
	    session_unset(); session_destroy(); echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/login_access_denied.php">';
		die(); 
	}
	else
	{
		//echo "**.";
	}

    
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo SITE_NAME ?></title>
        <link href="<?php echo $pageSecureUrl; ?>css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body onload="javascript:hideDiv()">
        <div id="shell">
            <div id="container">
                <div id="header_container">
                    <div id="header">
                       
                        <div id="header_logo"> 
                             
                            <img src="<?php echo SITE_IMAGES; ?>logo.png" alt="Deal4loans" title="Deal4loans" height="59" width="178" /> 
                            
                            
                        </div>
                    </div>
                </div>