<?php
include "scripts/db_init.php";
require 'scripts/functionshttps.php';

$verify = $_REQUEST['vfy'];
$id = $_REQUEST['id'];
if($id>0)
{
	$verification = "verified";
	$dataUpdate = array('email_verified'=>'1');
	$wherecondition = "(iciciappid=".$id.")";
	Mainupdatefunc ('icici_exclusive_application', $dataUpdate, $wherecondition);
	$msg = "Verification process is successful. <br>Your email id is verified. <br>ICICI Bank representative will contact you shortly for further process.";
}	
//	$verification = "nonverified";
	//$msg = "Your Email is not verified.";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="newicici-pl-styles-12.css" type="text/css" rel="stylesheet" />
</head>
<body>
<hr>
<div class="header">
<div class="header-inner">
<div class="logo" style="font-family:Arial, Helvetica, sans-serif; color:#06396b; font-size:22px; font-weight:bold; width:600px !important;">Get Instant Quote on ICICI Bank Personal Loans</div><!--<div class="logo"><img src="images/icici-app-logo.jpg" width="189" height="47"></div>-->
<div class="right-box-app"><span class="text-a">Powered by</span> <br>
<span class="text-a" style="color:#0f8eda; font-size:18px;">Deal4loans.com</span></div>
<div style="clear:both;"></div>
</div>
</div>
<div class="wrapper">
<div class="left-container">
<div style="clear:both"></div>
<div id="wrapper">
   <div id="container">
<div class="form-wrapper-app">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td colspan="2" align="left" class="formbodytext" style="font-size:18px; color:#000;"><?php echo $msg; ?></td>
         </tr>
        </table>   
   </div>
  </div>

</div>
</div>
<div class="right-panel">
<div class="box-right"><img src="images/instant-banner.jpg" width="100%" height="278"></div>

</div>
</div> 
   
</body>
</html>