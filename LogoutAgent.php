<?php
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
	// Initialize the session.
	session_start();
	// Unset all of the session variables.
	session_unset();
	// Finally, destroy the session.
	session_destroy();
	// Redirect browser
	$strDir = dir_name();
	header("Location: agentregistration.php");
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