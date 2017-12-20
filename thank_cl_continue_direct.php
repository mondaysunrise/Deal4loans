<?php
ob_start();
require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//require 'getlistofeligiblebidders.php';


$leadid = $_REQUEST['leadid'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<style type="text/css">
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
}
</style>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
  <div align="center"><b><font color="#3366CC">Thanks for applying Car Loan through Deal4loans.com. </font></b></div>
  <?
$getbiddtls="Select Bidderid_Details From Req_Loan_Car Where (Req_Loan_Car.RequestID=".$leadid.")";

	list($numRows1,$row)=Mainselectfunc($getbiddtls,$array = array());

 $Bidderid_Details = $row['Bidderid_Details'];
if(strlen($Bidderid_Details)>0)
{
	?>
	 <div align="center"><b><font color="#3366CC">You will get a call from the below mentioned Banks.</font></b> <br></div>
		<table cellpadding="0" cellspacing="0" width="550" align="center" style="border:1px #dbf2ff solid;">
		<tr>
			<td bgcolor="#dbf2ff" class="fontbld10" align="center" height="30" style="border-right:1px #000000 solid;">Bank Name</td>
			<td bgcolor="#dbf2ff"></td>
				</tr>
		<? 
list($numRows,$nrow)=MainselectfuncNew($getnm,$array = array());
for($i=0;$i<$numRows;$i++)
{
?>
	
		<tr>
			<td class="fontbld10" align="center" height="45"><? echo $nrow[$i]['Bidder_Name']; ?></td>
			<td class="fontbld10" align="center">Get Quote on call from Bank</td>
			
			</tr>	
	<?		
	
} ?>
</table>
<? }

	?>

 </div>
      
</body>
</html>