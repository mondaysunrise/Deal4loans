<?php
require 'scripts/db_init.php';
//require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$fullname = $_REQUEST["fullname"];
		$email_id =  $_REQUEST["email_id"];
		$Dated = ExactServerdate();

	if(strlen($fullname)>0 && strlen($email_id)>0)
	{
		//$getnewsletter="INSERT INTO Newsletter_Subscription (subscription_news_name ,subscription_news_email,subscription_date)
					//VALUES ('".$fullname."','".$email_id."',Now() )";
					//$result = ExecQuery($getnewsletter);
					
		$dataInsert = array("subscription_news_name"=>$fullname , "subscription_news_email"=>$email_id , "subscription_date"=>$Dated);
		$table = 'Newsletter_Subscription';
		$insert = Maininsertfunc ($table, $dataInsert);
					
		

//echo $getnewsletter."<br>";
	}

}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Description" content="Looking for hassle free loans at attractive interest rates and flexible repayment option; Deal4Loans provides you an online information services on flexible loan schemes available with best loan provider banks in India.">
<meta name="keywords" content="hassle free loans, loans india, best loan providers, loans interest rate, low interest loan, compare loans, online loan information">

<title>Subscribe newsletter - Deal4Loans</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<link href="style.css" rel="stylesheet" type="text/css" />
<div id="dvMainbanner">
    <div id="dvNavbg">
      <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
   <?php if(isset($_SESSION['UserType']))
	{?>
   <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td><td><? }?>
	<table width="510"  border="0" cellspacing="0" cellpadding="0" >
	<tr><td style="color:#2A72BC; Font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">
	Thank you for registering yourself for a newsletter from Deal4loans.com.<br>
From now onwards you will get a monthly subscription of Deal4loans newsletter on your E-mail Id, with the updated information on loans and credit card you can increase your knowledge.<br><br>
Click here to view the newsletter of <a href="http://www.deal4loans.com/viewnewsletter/newsletter/26" style=" Font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;"><u>July 09</u></a> month.<br><br>

<tr></td></table>
</td></tr></table>
 
    </div>
   <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right1.php';
  }
  ?>
  </div>
<?php include '~NewBottom.php';?>
</div>
  </body>
</html>