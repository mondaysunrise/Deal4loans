<?php
require 'scripts/functions.php';
if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="CC Site Page"; }
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quick Online Credit Card Apply June 2016</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Apply Online Credit Cards: Fill ✍ Application forms for credit cards free. Instant Apply online ✓ HDFC ✓ ICICI ✓ Citibank ✓ SBI and American express online in India.">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link href="css/credit-card-new-styles.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript">
function addElement(val)
	{
		if(val==1){
		var row = document.getElementById('NmBank').style.display='block';
		
		var row = document.getElementById('loanrunning').style.display='none';
	}
}
function removeElement(val)
{
	if(val==2){
	var row = document.getElementById('NmBank').style.display='none';
	var row = document.getElementById('loanrunning').style.display='block';
	}	
}
</script>
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
        include "credit-card-widget-second-step_100616.php";
        ?>
		</div>
	  </div>
      <div style="clear:both;"></div> <!-- END List Wrap -->
	</div>
<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px;"></div>
</div>
</div>
<div style="clear:both;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
</body>
</html>