<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />  
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" /> 
<title>Instant Apply for Credit Cards Online</title>
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/credit-card-new-styles.css" type="text/css" rel="stylesheet"  />
<!--For Popup-->
<link rel="stylesheet" href="css/jquery.popdown.css" />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9; font-size:14px;"><a href="index.php" class="text12" style="color:#0e79b9; font-size:14px;" >Home</a> » <a href="credit-cards.php"  class="text12" style="color:#0e79b9; font-size:14px;">Credit Card</a> <span style="color:#4c4c4c; font-size:14px;">»  Compare Credit Card Online</span></div>
 <div style="clear:both; height:18px;"></div>
 <h1 class="cc-h1">Compare Credit Card Online</h1>
 <div style="clear:both; height:10px;"></div>
<div class="ac_table_box" style="margin-top:10px;">


<?php 
$add_uat ='';
if((strlen(strpos($_SERVER['REQUEST_URI'], "UAT")) > 0)) {
    $add_uat = " AND status_uat=1 ";
}

$selectccbanks = "SELECT * FROM `credit_card_listing` WHERE status=1 ".$add_uat." ORDER BY `credit_card_listing`.`sequence` ASC ";
$ccbankresult = d4l_ExecQuery($selectccbanks);
		$rowscount = d4l_mysql_num_rows($ccbankresult);
		if($rowscount>0)
		{
			$i=1;
			while($row=d4l_mysql_fetch_array($ccbankresult))
			{
				echo '<div class="ac_card_colum" style="margin-top:2px;">';
				echo  $content  = $row["content"];
			   	echo '</div>';	
				if($i%4==0 && $i!=1) 
				{
					echo '<div style="clear:both;"></div>';
				}	
				$i=$i+1;
			}
		}
?>



</div>

</div>
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript" src="lib/jquery.popdown.js?v=1" /></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.popdown').popdown();
		});
	</script>
</body>
</html>
</body>
</html>