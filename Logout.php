<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
$Dated=ExactServerdate();
if($BidderIDstatic>0)
{
	$DataArray = array("Last_Logout_Date"=>$Dated );
	$wherecondition ="BidderID='".$_SESSION['BidderID']."' and TrackID=".$_SESSION['last_inserted_value'];
	Mainupdatefunc ('Bidders_Login_Details', $DataArray, $wherecondition);
}

// Unset all of the session variables.
session_unset();

// Finally, destroy the session.
session_destroy();

// Redirect browser
$strDir = dir_name();
header("Location: http://".$_SERVER['HTTP_HOST'].$strDir);//."/");
exit;
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Signing you out. Please wait... </title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
</body>

</html>
