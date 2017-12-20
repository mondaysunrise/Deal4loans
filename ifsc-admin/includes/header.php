<?php
ob_start();
$urlExplode=explode('/',$_SERVER['PHP_SELF']);
$currentPage=$urlExplode['2'];
if($currentPage=="index.php" || $currentPage=="forgot_password.php")
	{
		require_once("includes/application-top.php");
	}
else{
require_once("includes/application-top-inner.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITE_NAME?></title>
<link href="<?php echo $pageSecureUrl;?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $pageSecureUrl;?>js/common.js"></script>
</head>
<body onload="javascript:hideDiv()">
<div id="shell">
<div id="container">
<div id="header_container">
  <div id="header">
    <div id="header_logo"> <a href="index.php"> <img src="<?php echo SITE_IMAGES;?>logo.png" alt="Deal4loans" title="Deal4loans" height="59" width="178" /> </a> </div>
  </div>
</div>