<?php
	require 'scripts/session_check_online.php';
	//require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
   ////////////////////////////////////////
   function db_connect(){
	$dbuser	= "root"; 
	$dbserver= "localhost"; 
	$dbpass	= "";
	$dbname	= "deal4loans_primary"; 
	$conn = mysql_connect($dbserver, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
	if($conn && mysql_select_db($dbname))
	    	return $conn;

	//return (FALSE);
   }
   ///////////////////////////////////////
   function ExecQuery($sql){

	/////////////////////////Connect to the db
	$sqlcheckip=strtolower($sql);
	if((strlen(strpos($sqlcheckip, "insert")) > 0)) 
		   {
		//restrictIPinst($sql);
		   }
	db_connect();

	/////////////////////////Return the resultset
	return (mysql_query($sql));
   }

	if ($conn) {
  echo 'conected';
} else {
  echo 'not conected';
}

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
<img src="images/arrow.gif"><a href="personalloan_index.php">Personal Loan </a></br>
<img src="images/arrow.gif"><a href="homeloan_index.php">Home Loan </a></br>
<img src="images/arrow.gif"><a href="carloan_index.php">Car Loan </a></br>
<img src="images/arrow.gif"><a href="creditcard_index.php">Credit Card </a></br>
<img src="images/arrow.gif"> <a href="Laplogin_index.php">Loan Against Property </a></br>
<img src="images/arrow.gif"><a href="businessloan_index.php">Business Loan </a></br><img src="images/arrow.gif"><a href="goldloan_index.php">Gold Loan </a></br>
<img src="images/arrow.gif"> <a href="quickapply.php">Quick Apply </a></br>
<img src="images/arrow.gif"><a href="chat_index.php">Registered Chat Customers </a></br>
<img src="images/arrow.gif"> <a href="bidderslogin_details_index.php">Bidders Login Details</a></br>
<img src="images/arrow.gif"><a href="ViewBiddersTrial.php">Bidders Details</a><br>
<img src="images/arrow.gif"><a href="cc_offer_leads.php"> Credit Card Offer Leads</a></br>
<img src="images/arrow.gif"><a href="cc_source_report.php">Credit Card SBI Leads Allocation wrt SOURCE</a></br>
<img src="images/arrow.gif"><a href="cc_sbi_report.php">Credit Card SBI Processing Status</a></br>
<img src="images/arrow.gif"><a href="cc_sbi_processingstutus_report.php">Credit Card SBI Processing Status (Specific Source)</a></br>
<img src="images/arrow.gif"><a href="ProductsCountDetails.php">Productwise Report </a></br>
<img src="images/arrow.gif"><a href="getbidderdeatails.php">Bidder Details</a></br>
<!--<img src="images/arrow.gif"><a href="/personal_loan_allocation.php">Personal Loan Allocation </a></br>-->
<img src="images/arrow.gif"><a href="/incomplete_index.php">Incomplete Data </a></br>
</td></tr>
 </table>
 <h3 class="bodyarial11">
   
   <?php //include '~Bottom.php'; ?>
 </h3>
 </center>
</div>
</body>

</html>