<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
$Dated = ExactServerdate();
$ccuserid = $_REQUEST['RequestID'];
$cc_bankid = $_REQUEST['cc_bankid'];
if($ccuserid>0)
{
if($cc_bankid==13)
	{
$Descr = "Standard Chartered
Super Value Titanium Card"; 
	}
if($cc_bankid==19)
	{
$Descr = "Standard Chartered
Manhattan Platinum Card";
	}

	$slct="select Descr from Req_Credit_Card Where (RequestID='".$ccuserid."')";
		list($num_2,$row)=Mainselectfunc($slct,$array = array());
		if(strlen($row['Descr'])>0)
		{
			$strcrd_nme=$row['Descr'].",".$Descr;
	}
	else
	{
		$strcrd_nme=$Descr;
	}

	$DataArray = array("Descr"=>$strcrd_nme, 'Dated'=>$Dated);
	$wherecondition ="(RequestID = '".$ccuserid."')";
	Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	

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
  
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Standard Chartered Credit Card through Deal4loans.com. </h1>


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