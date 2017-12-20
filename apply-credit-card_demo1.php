<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';
if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="CC Site Page"; }
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quick Online Credit Card Apply 2017</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Apply Online Credit Cards: Fill ✍ Application forms for credit cards free. Instant Apply online ✓ HDFC ✓ ICICI ✓ Citibank ✓ SBI and American express online in India." />
 <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/credit-card-new-styles.css" type="text/css" rel="stylesheet"  />
<!--For Popup-->
<link rel="stylesheet" href="css/jquery.popdown.css" />
<?php include "credit-card-ec-widget-accjs.php";?>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9; font-size:14px;"><a href="index.php" class="text12" style="color:#0e79b9; font-size:14px;" >Home</a> » <a href="credit-cards.php"  class="text12" style="color:#0e79b9; font-size:14px;">Credit Card</a> <span style="color:#4c4c4c; font-size:14px;">»  <?php echo GETQUOTEFOR;?> Credit Card</span></div>
<div style="clear:both; height:18px;"></div>
 <h1 class="cc-h1"><?php echo GETQUOTEFOR;?> Credit Card</h1>
 <div style="clear:both; height:10px;"></div>
<div id="example-two">
		<div class="list-wrap" <?php echo $clss; ?>>
		<div id="fillform" style="height:auto;" <?php echo $shClass; ?>>	
		<?php
        $retrivesource = $retrivesource;
        $subjectLine="";
        include "credit-card-ec-widget-acc.php";
        ?>
		</div>
	  </div>
      <div style="clear:both;"></div> <!-- END List Wrap -->
	</div>
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
<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
</div>
</div>
<div style="clear:both; height:30px;"></div>
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