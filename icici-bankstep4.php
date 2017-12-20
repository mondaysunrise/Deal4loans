<?php
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';

 $Income_Proof = "Salary ceritificate for last 3 months";
 $Bank_Statement = "Salary account bank statement - last 6 months";
 $Address_Proof = "Latest Life Insurance policy premium receipts (paid)";
$Identity_Proof = "Pay slip - last 3 months"; 


$Name = $_REQUEST["Name"];
$Phone = $_REQUEST["Phone"];
$Pancard = $_REQUEST["Pancard"];

$p_address = $_REQUEST["p_address"];
$p_City = $_REQUEST["p_City"];
$p_state = $_REQUEST["p_state"];
$p_pincode = $_REQUEST["p_pincode"];
$address = $_REQUEST["address"];//
$City = $_REQUEST["City"];//
$state = $_REQUEST["state"];//
$pincode = $_REQUEST["pincode"];//
$iciciappid = $_POST['iciciappid'];
$RequestID = $iciciappid;


$DataArray = array("iciciapp_name"=>$Name, "iciciapp_email"=>$email, "iciciapp_mobile_number"=>$Phone, "Pancard"=>$Pancard, "p_address"=>$p_address, "p_City"=>$p_City, "p_state"=>$p_state, "p_pincode"=>$p_pincode);
$wherecondition ="iciciappid=".$iciciappid;
Mainupdatefunc ('icici_exclusive_app', $DataArray, $wherecondition);

$Income_Proof = $_REQUEST["Income_Proof"];
$Address_Proof = $_REQUEST["Address_Proof"];
$Identity_Proof = $_REQUEST["Identity_Proof"];
$Bank_Statement = $_REQUEST["Bank_Statement"];
//echo "<br>";


$dataInsert = array("iciciappid"=>$iciciappid, "address_proof"=>$Address_Proof, "income_proof"=>$Income_Proof, "identify_proof"=>$Identity_Proof, "bank_statement"=>$Bank_Statement);
$table = 'icici_exclusive_app_docs';
$insert = Maininsertfunc ($table, $dataInsert);


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICICI Personal Loan</title>
<link href="icici-app-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href='progression.min.css' rel='stylesheet' type='text/css'>
<link href="newicici-pl-styles.css" type="text/css" rel="stylesheet"/>
<link rel="stylesheet" href="tip-yellow.css" type="text/css" />
	   <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
        <script type="text/javascript" src="scripts/common.js"></script>
 <script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>

	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="jquery.poshytip.js"></script>
<script src="javascript-browser.js" type="text/javascript"></script>
<script type="text/javascript">

function initUpload_1() {
	document.getElementById('uploadform_1').onsubmit=function() {
	document.getElementById('uploadform_1').target = 'target_iframe_1';
		document.getElementById('status_1').style.display="block"; 
	}
}

function uploadComplete_1(status){
   document.getElementById('status_1').innerHTML=status;
}

function initUpload_2() {
	document.getElementById('uploadform_2').onsubmit=function() {
	document.getElementById('uploadform_2').target = 'target_iframe_2';
    document.getElementById('status_2').style.display="block"; 
	}
}

function uploadComplete_2(status){
   document.getElementById('status_2').innerHTML=status;
}

function initUpload_3() {
	document.getElementById('uploadform_3').onsubmit=function() {
	document.getElementById('uploadform_3').target = 'target_iframe_3';
    document.getElementById('status_3').style.display="block"; 
	}
}

function uploadComplete_3(status){
   document.getElementById('status_3').innerHTML=status;
}

function initUpload_4() {
	document.getElementById('uploadform_4').onsubmit=function() {
	document.getElementById('uploadform_4').target = 'target_iframe_4';
    document.getElementById('status_4').style.display="block"; 
	}
}

function uploadComplete_4(status){
   document.getElementById('status_4').innerHTML=status;
}

function initUpload_5() {
	document.getElementById('uploadform_5').onsubmit=function() {
	document.getElementById('uploadform_5').target = 'target_iframe_5';
    document.getElementById('status_5').style.display="block"; 
	}
}

function uploadComplete_5(status){
   document.getElementById('status_5').innerHTML=status;
}



	</script>
    <style type="text/css">
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
		.flickr-thumbs {
			overflow:hidden;
		}
		.flickr-thumbs a {
			float:left;
			display:block;
			margin:0 3px;
			border:1px solid #333;
		}
		.flickr-thumbs a:hover {
			border-color:#eee;
		}
		.flickr-thumbs img {
			display:block;
			width:60px;
			height:60px;
		}
		.alert_msg{color:#FF0000; font-weight:bold; font-size:14px; font-family: Verdana, Geneva, sans-serif;}
	</style>
</head>
<body>
<header>
<div class="top-bx">
<div class="logo" style="font-family:Arial, Helvetica, sans-serif; color:#06396b; font-size:22px; font-weight:bold; width:600px !important;">Get Instant Quote on ICICI Bank Personal Loans</div>
<!--<div class="logo"><img src="images/icici-app-logo.jpg" width="189" height="47"></div>-->
<div class="right-box"><span class="text-a">Powered by</span> <br>
<span class="text-a" style="color:#0f8eda; font-size:18px;">Deal4loans.com</span></div>
<div style="clear:both;"></div>
</div>
</header>
</div>
<div class="wrapper"><div class="left-container">
<div style="clear:both"></div>
<div id="wrapper">
   <div id="container">
 <section role="main">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="2" align="left" class="formbodytext" style="font-size:18px; color:#000;">Thank you for applying.</td>
    </tr>
    <tr>
      <td width="65%" align="left" class="formbodytext">&nbsp;</td>
      <td width="35%" align="left" class="formbodytext">&nbsp;</td>
    </tr>
  </table>
    </div>
  </div>

</div>
<div class="right-panel">
<div class="box-right"><img src="images/personal-banner1.png" width="250" height="262"></div>

</div>
</div>
</body>
</html>