<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$Name = $_REQUEST['Name'];
$Mobile = $_REQUEST['Mobile'];
$Email = $_REQUEST['Email'];
$City = $_REQUEST['City'];
$Message = $_REQUEST['Message'];
$IP = getenv("REMOTE_ADDR");

$sql = "INSERT INTO Req_Credit_Sudhaar (Name ,Mobile ,Email ,City ,Message ,Source ,IP ,Dated) VALUES ('".$Name."', '".$Mobile."', '".$Email."', '".$City."',  '".$Message."',  '".$Source."',  '".$IP."',  Now())";
ExecQuery($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Welcome-1</title>
<link href="css/creditsudhaar_style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<div class="headerWrapper">
<div class="header wrap"></div>
</div>
<div class="wrap">
  <div id="logoHolder"> <img src="new-images/credit-sudhaar-logo.png" width="328" height="94" alt="credt sudhaar logo"></div>
  <div style="float:right; margin-left: 170px;margin-top: 10px;">
    <div class="welcome_hd_right">
    <img src="new-images/creditsudhaar_restore_enh.jpg" width="229" height="48" border="0">	</div>
  </div>
</div>
<div style="clear:both;"></div>
<div id="mai_nwrapper">
<div class="welcome_left"> <h3 class="title" style="font-family:Arial, Helvetica, sans-serif; font-size:25px; margin-left:10px; margin-bottom:5px;"></h3>
<div style="width:98%; vertical-align:top;">
<table cellpadding="3" cellspacing="0" border="0" width="100%">
        <tr><td colspan="2" align="center"  height="269" style=" color:#FF3300; font-family:Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold;" valign="top"> Thank You. We will get back to you shortly.</td></tr>
                            
        </table>
</div>

</div>
<div class="welcome_right">
      
       <h3>Credit Health Check-Up</h3>
       <p>Compilation of Reports from
 all Credit Bureaus
</p>
<p>Multibureau Analysis of CIBIL, 
EQUIFAX, EXPERIAN Credit Reports
</p><p>8 Parameter Credit Health Map
</p>
<h3 style="padding-top:4px;">Issue Resolution</h3>
<p>Error Tracking & Reconciliation</p>
<p>NACCC Certified Credit Counsellor</p>
<p>Debt Reconciliation/Settlements</p>
<p>Score Improvement Module</p>
<h3 style="padding-top:18px;">Achieve Credit & Financial Goals</h3>
<p>Tax Advisory</p>
<p>Assistance in Filing Tax Returns</p>
<p>Access to Credit Sudhaar Finance</p>
<p>Assistance in Loan Processing</p>
<h3 style="padding-top:22px;">Protect Your Credit</h3>
<p>Identity Theft Protection</p>
<p>Fraudulent Charges Protection</p>
<p>Lost Wallet Protection</p>
<p>ATM Assault & Robbery Protection</p>
<p>Assistance in making a Will</p>
       
        </div>
  
  </div>
  
  
   </div>

</div>
</body></html>