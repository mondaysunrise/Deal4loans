<?php
	session_start();
	session_unset();
	session_destroy();
	//$strDir = dir_name();
	header("Location: index.php");
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