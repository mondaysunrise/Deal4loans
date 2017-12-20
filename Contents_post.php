<?php
	require 'scripts/functions.php';
	session_start();
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="Description" content="">
<meta name="keywords" content="">

<title></title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/menu.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
 <center>
 <?php include '~Top_post.php'; ?>
 <table border="0" cellspacing="0" width="712" cellpadding="0">
   <tr>
     <td width="202" align="center" valign="top">
     <?php include '~Left.php'; ?>
     &nbsp;</td>
       <td width="510" align="center" valign="top">
     	<?php @include "Contents/".$_GET["f"].".php"; ?>
     &nbsp;</td>
     </tr>
 </table>
 <?php include '~Bottom_post.php'; ?>
 </center>
</div>
</body>

</html>