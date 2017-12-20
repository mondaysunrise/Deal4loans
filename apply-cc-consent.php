<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r($_POST);

	$ccuserid = $_REQUEST['RequestID'];
$cc_name = $_REQUEST['cc_name'];


if((strlen(trim($cc_name))>0) && $ccuserid >1)
{
	$slct="select applied_card_name from Req_Credit_Card Where (RequestID='".$ccuserid."')";
	list($GetnumVal,$row)=Mainselectfunc($slct,$array = array());
	//$row=mysql_fetch_array($slct);

	if(strlen($row['applied_card_name'])>0)
	{
	$strcrd_nme=$row['applied_card_name'].",".$cc_name;
	}
	else
	{
		$strcrd_nme=$cc_name;
	}

//$getcc_option=ExecQuery("Update Req_Credit_Card Set applied_card_name ='".$strcrd_nme."' Where (RequestID='".$ccuserid."')");

$DataArray = array("applied_card_name" =>$strcrd_nme);
$wherecondition ="(RequestID='".$ccuserid."')";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);


	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
</head>
<body>

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>

<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#4c4c4c;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> </div>
<div style="clear:both; height:15px;"></div>
<div class="intrl_txt" style="height:500px;">


  <div id="txt"  style="padding-top:15px; ">
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:15px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying <? echo $cc_name; ?> through Deal4loans.com </h1>
  
</div>

</div>
 <?php include "footer1.php"; ?>
</div><!-- </div> -->
</body>
</body>
</html>