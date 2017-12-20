<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';



// Initialize the session.
	session_start();
	
 $sql = "update Bidders_Login_Details set Last_Logout_Date=Now() Where BidderID='".$_SESSION['BidderID']."' and TrackID=".$_SESSION['last_inserted_value'];
$result = ExecQuery($sql);



// Unset all of the session variables.
	session_unset();

// Finally, destroy the session.
	session_destroy();

// Redirect browser
	$strDir = dir_name();
	header("Location: smslogin.php");
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