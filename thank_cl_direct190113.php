<?php
require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';


$leadid = $_REQUEST['leadid'];
$strCity =  $_REQUEST['city'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Thank you Car Loan</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
color:#000000;
}
</style>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply Car Loan</span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
  <div align="center"><b><font color="#3366CC">Thanks for applying Car Loan through Deal4loans.com. </font></b></div>
<?
list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$leadid,$strCity);
$arrFinal_Bid = "";
		while (list ($key,$val) = @each($realbankiD)) { 
			$arrFinal_Bid[]= $val; 
		} 

$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
$strFinalBidder = implode(",",$FinalBidder);

	if(count($Final_Bid)>0)
	{ 
		$Dated = ExactServerdate();
		$DataArray = array("Bidderid_Details"=>$strFinalBidder , "Allocated"=>'2', "Dated"=>$Dated );
		$wherecondition ="(RequestID=".$leadid.")";
		Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);
		?>
		 <div align="center"><b><font color="#3366CC">You will get a call from the below mentioned Banks.</font></b> <br></div>
		<table cellpadding="0" cellspacing="0" width="550" align="center" style="border:1px #dbf2ff solid;">
			<tr>
			<td bgcolor="#dbf2ff" class="fontbld10" align="center" height="30" style="border-right:1px #000000 solid;">Bank Name</td>
			<td bgcolor="#dbf2ff"></td>
				</tr>
		<? for($i=0;$i<count($Final_Bid);$i++)
			{ ?>
		<tr>
			<td class="fontbld10" align="center" height="45"><? echo $Final_Bid[$i]; ?></td>
			<td class="fontbld10" align="center">Get Quote on call from Bank</td>
			
			</tr>	
		<?	}
		?>
		
		</table>
	
	<? }

	
	?>

 </div>
</div>

</body>
</html>