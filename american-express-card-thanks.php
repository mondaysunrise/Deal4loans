<?php
include "scripts/db_init.php";
include "scripts/functions.php";

	$RequestID = $_REQUEST["RequestID"];
	$sql = "select * from cc_american_express where RequestID='".$RequestID."'";
	list($recordcount,$MyRows)=Mainselectfunc($sql,$array = array());
	$Email = $MyRows['Email'];
	$msg = "Thanks for applying. Our representative will get back to you shortly.";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>American Express® Platinum Reserve Credit Card</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="american-express-lp-first-stage-styles.css" type="text/css" rel="stylesheet" />
</head>
<body>

<div class="amx-second" style="height:560px;">
<div class="logo_d4l"><img src="images/d4l_amx_logo.jpg" width="164" height="63"></div>
<div class="logo_amx"><img src="images/amx_d4l_logo.jpg" width="276" height="52"></div>
<div style="clear:both; height:15px;"></div>
<div class="left_panel">
<div class="left_inner_text_bx" style="margin-top:10px; vertical-align:top; height:200px;"><?php echo $msg; ?> <br><br>
Confirm your email address<br>
<span style="font-weight:normal; font-size:13px;"><!--A confirmation email has been sent to <strong><?php echo $Email; ?></strong>. --> <br>Click on the confirmation link in the email to complete your application</span>
</div>
<div style="clear:both;"></div>
<div style="clear:both;"></div>
</div>
<div class="rightbox form_text" id="professionalContent">The Annual Membership Fee for the American Express Platinum Reserve<sup>SM</sup> Credit Card is Rs.10,000 plus service tax.
<div class="bullet_text">
<ul>
<li>
Redeem your Points for an array of stunning Rewards. </li>
<li>
Choose from a hand-picked selection of couture labels, fabulous accessories, and extraordinary escapades. </li>
</ul>
</div>
<div class="crdit_card_box" style="margin-top:2px;"> <img src="images/amx-platinum-reserve-credit-card.png" width="156" height="109"></div>
<div class="form_text" style="font-size:10px;">Please refer to the Most Important <a href="https://americanexpressindia.co.in/terms/platinumR.pdf">Terms & Conditions</a> along with this application for details on the fee and other charges on the Card.</div>
</div>
<div style="clear:both;"></div>
</div>

</body>
</html>
