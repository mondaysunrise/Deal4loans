<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$Dated=ExactServerdate();
$requestID = base64_decode($_REQUEST['reqid']);
$ProcessingStatus = base64_decode($_REQUEST['status']);

$slct="SELECT * FROM Req_Credit_Card WHERE RequestID='".$requestID."'";
list($Getnum,$row)=Mainselectfunc($slct,$array = array());
$Name = $row["Name"];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SBI Documents</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="css/sbi-document-styles.css?<?php echo time(); ?>" type="text/css" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<style>
.d4l{}
.d4l .nav>li>a {
   position: relative;
   display: block;
  padding:0px 15px;
}
.d4l .nav>li>a:hover {
  background:none !important;
}
</style>
</head>
<body class="d4l">
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<section class="sbi-document">
	<div class="container">
		<div class="col-md-12">
			<div class="pd-top-120 text-center"><img src="images/document-success-icon.png"></div>
			<h1>Successfully Uploaded</h1>
			<p class="text-center font14-medium">Documents have been successfully uploaded.</p>
			<p class="text-center font14-medium">Our representative will call you soon.</p>
		</div>
	</div>
</section>
<div style="clear:both; height:100px;"></div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
