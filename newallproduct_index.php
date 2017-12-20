<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
 <center>
 <?php include '~TopBidder.php'; ?>

 <br>
 <br>
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder"><tr><td>
<img src="images/arrow.gif"> <a href="prepaid_accounts.php">Prepaid Bidders</a></br>
<img src="images/arrow.gif"> <a href="postpaid_leadcount.php">Postpaid Bidders</a></br>
<img src="images/arrow.gif"> <a href="bidderslogin_details_index.php">Bidders Login Details</a></br>
<img src="images/arrow.gif"><a href="ViewBiddersTrial.php">Bidders Details</a><br>
<img src="images/arrow.gif"><a href="ProductsCountDetails.php">Productwise Report </a></br>
<img src="images/arrow.gif"><a href="getbidderdeatails.php">Bidder Details</a></br>
<img src="images/arrow.gif"><a href="bidder_detailsbankwise.php">Bidder Details Bank | City wise</a></br>
</td></tr>
 </table>
 </center>
</div>
</body>

</html>