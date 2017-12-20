<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$cc_bankid= $_REQUEST["ccid"];
$ccuserid= $_REQUEST["req"];
$existing_rel = $_REQUEST["exstrl"];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
			$$a=$b;

$acc_no = $_POST["acc_no"];
$loan_no = $_POST["loan_no"];
	
if($cc_bankid==10)
	{
	$Descr="HDFC Gold Card";
}
else if ($cc_bankid==16)
	{
$Descr="HDFC Titanium Card";
	}
	else if ($cc_bankid==15)
	{
$Descr="HDFC Platinum Plus Card";
	}

//$ccupdate= "Update Req_Credit_Card  set Account_No = '".$acc_no."',Loan_No = '".$loan_no."',Existing_Relationship='".$existing_rel."'  Where (Req_Credit_Card.RequestID=".$ccuserid.")";


$DataArray = array("Account_No" =>$acc_no, "Loan_No" =>$loan_no, "Existing_Relationship"=>$existing_rel);
$wherecondition ="(Req_Credit_Card.RequestID=".$ccuserid.")";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet">

</head>
<body>
<?php include "middle-menu.php"; ?>

<div style="height:50px;"></div>
<div class="cc_inner_wrapper">
  <!--<span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> </span>-->
  <div id="txt" style="padding-top:15px; height:200px;">
  
 <h1 class="h1ccnew"> Thanks for applying HDFC Credit Card through Deal4loans.com </h1>
 
  <div style="clear:both;"></div></div>

</div><!-- </div> -->
<?php include "footer_sub_menu.php"; ?>
</body>
</html>