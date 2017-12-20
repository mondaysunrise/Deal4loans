<?php
ob_start( 'ob_gzhandler' );
require 'scripts/functions.php';
require 'scripts/db_init.php';
session_start();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan referral reward program</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<meta name="keywords" content="" />
<meta name="Description" content="" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/hl-referral-reward-program-styles.css" type="text/css" rel="stylesheet"  />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="hl-ref-main-wrapper">
<p class="hl-reft-main-third-head">
<?php
//print_r($_POST);

	//	echo "<br>ELSE<br>";
	$insertID = $_GET['id'];
		$getdetails="select referrer_id, id from hl_referral_leads where id='".$insertID."'";
	//echo $getdetails."<br>";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	//print_r($myrow);
	if($alreadyExist>0)
	{
		$i=0;
		$referrer_id= $myrow['referrer_id'];
		$insertID= $myrow['id'];

		$table = 'hl_referral_leads';
		$status=1;	
		$reference_id = "HL".$referrer_id."REF".$insertID;
		$DataArray = array("status"=>$status);
		$wherecondition ="id='".$insertID."'";
		Mainupdatefunc ($table, $DataArray, $wherecondition);
		
		$message = 'Your details are validated, we will soon process the application. <br>Your Reference ID - '.$reference_id;
	
	}


?>

<?php echo $message ;


?></p>
<div style="clear:both;"></div>

<div class="hl-ref-col-50-left">
<!--<h3>Details Required</h3>-->
<p class="customer-heading">&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>
<div class="hl-ref-col-50-right"><!--<h3>Details Required</h3>-->
<p class="customer-heading">&nbsp;</p>
<p>&nbsp;<div id="nameRVal"></div></p>
<p>&nbsp;<div id="phoneRVal"></div></p>
<p>&nbsp;<div id="emailRVal"></div></p>
<p>

&nbsp;<div id="cityRVal"></div>   
</p>
</div>
<div style="clear:both; height:0px;"></div>
	<div id="acceptRVal"></div>
<p>&nbsp;</p>



</div>

<div style="clear:both;"></div>
<?php //include "responsive_footer.php"; ?>
</div>
<div class="hide_top_menu">
  <?php 
#include "footer_pl.php";
include("footer_sub_menu.php");
?>
</div>
</body>
</html>