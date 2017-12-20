<?php
require 'scripts/session_check.php';
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;
if(isset($_REQUEST['source']))
{
	$source= $_REQUEST['source'];
}
else
{
	$source= "application-for-gold-loan";
}
$TagLine = "Apply Gold Loan";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Gold Loan | Deal4Loans India</title>
<meta name="keywords" content="Apply Gold Loans, Compare Gold Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore" />
<meta name="description" content="Apply Online Gold Loans through Deal4loans.com Get instant information on gold loans from all gold loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. " />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href="css/gold-loan-styles.css" type="text/css" rel="stylesheet"  />
<style>
   .d4l-logo{float:left; padding-bottom:5px; padding-top:5px;}
   .d4l-logout{ float:right; color:#FFF; padding-right:10px; padding-top:19px;}
   .d4l-logout a{color:#FFF; text-decoration: none; }
    
</style>
</head>

<body>
<?php //include "middle-menu.php"; ?>
    
    <div class="header-menu-new" style="background: #0c4669;">
<div class="menu-main-wrapper">
    <div class="d4l-logo"><a href="http://www.deal4loans.com/"><img src="/images/dea4lonasnew-logo 1111.png" border="0" width="123" height="50" alt="logo"></a></div>
    <div class="d4l-logout"><a href="Logout.php">Logout</a></div>

</div>
<div style="clear:both;"></div>
</div>
    
<div class="gold_inner_wrapper">
  <div style="margin-top:40px;" class="common-bread-crumb"><a href="index.php" style="color:#03F;">Home</a> >  <span>Application Form For Gold Loan</span></div>
<div style="clear:both; height:15px;"></div>

<?php include "gold-loan-application-form.php";?>

</div>
<div style="clear:both; height:15px;"></div>

<?php //include "footer_sub_menu.php"; ?>

</body>
</html>
