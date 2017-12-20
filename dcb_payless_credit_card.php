<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$ccuserid = $_REQUEST['RequestID'];

if($ccuserid>0)
{
	$Descr="DCB payless Card";
	$dcbcd=ExecQuery("select Descr,applied_card_name from Req_Credit_Card Where (RequestID='".$ccuserid."')");
	$row=mysql_fetch_array($dcbcd);

if(strlen($row['Descr'])>0)
	{	$dcbcrd_nme=$row['Descr'].",".$Descr;}
	else
	{	$dcbcrd_nme=$Descr;}

if(strlen($row['applied_card_name'])>0)
	{	$dcbappcrd_nme=$row['applied_card_name'].",".$Descr;}
	else
	{	$dcbappcrd_nme=$Descr;}


	$ccupdate= "Update Req_Credit_Card  set Descr='".$dcbcrd_nme."',Dated=Now(),applied_card_name='".$dcbappcrd_nme."' Where (Req_Credit_Card.RequestID=".$ccuserid.")";
	ExecQuery($ccupdate);
	//echo $ccupdate."<br>";
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
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> </span>
  <div id="txt" style="padding-top:15px;">
  
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying DCB PayLess Cardthrough Deal4loans.com. </h1>


  </div>
      <?
  //include '~Right2.php';

  ?>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>