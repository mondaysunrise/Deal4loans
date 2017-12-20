<?php
ob_start();
require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//require 'cardsview.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

		$Property_Value = $_POST['Property_Value'];
		$userid = $_POST['userid'];
		$city = $_POST['city'];
		$net_salary = $_POST['net_salary'];
		$activation_code = $_POSt['activation_code'];
		$reference_code = $_POSt['Reference_Code'];
		$Pincode = $_POST['Pincode'];
		$Employment_Status = $_POST['Employment_Status'];
		

if($reference_code==$activation_code)
	{
		$Is_Valid=1;
	}
	else
	{
		$Is_Valid=0;
	}

	$Dated = ExactServerdate();
	$DataArray = array("Is_Valid"=>$Is_Valid , "Pincode"=>$Pincode , "Property_Value"=>$Property_Value, "Employment_Status"=>$Employment_Status );
	$wherecondition ="(RequestID=".$userid.")";
	Mainupdatefunc ('Req_Loan_Against_Property', $DataArray, $wherecondition);

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
  <div align="center"><b><font color="#3366CC">Thanks for applying Loan Against Property through Deal4loans.com. You will get a call from us, for information and rates. </font></b></div>
<?php 

$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($net_salary>=350000) && (in_array($city, $getciticitydetails))>0)
		{
		 ?>
		
		 <?
		  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
		list($ccrecordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());

		if($ccrecordcount>0)
			{?>

<div style="text-align:center; font-weight:bold; line-height:18px; padding:15px 0px;">
		There are some other financial products that are on offer for you on the basis of details you have submitted.
		<br />
		If you are interested, Go ahead and <font color="#5e3307">Apply</font></div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<?

	for($ii=0;$ii<$ccrecordcount;$ii++)
		 {?>
				<td valign="top">
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
						<tr>
							<td height="30" class="crdbhdng"><a href="<? if (strlen($myrow[$ii]["cc_bank_url"])>0) {echo $myrow[$ii]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow[$ii]["cc_bank_name"];?></a></td>
						</tr>
						<tr>
							<td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow[$ii]["cc_bank_url"])>0) {echo $myrow[$ii]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow[$ii]["card_image"];?>" width="150" height="244" /></a></td>
						</tr>
						<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
						<tr>
							<td height="325" valign="top" class="crdtext"><? echo $myrow[$ii]["cc_bank_features"];?></td>
						</tr>
						<tr>
							<td  align="center" valign="bottom"><a href="<? if (strlen($myrow[$ii]["cc_bank_url"])>0) {echo $myrow[$ii]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
						</tr>
					</table>
				</td>
				<? }
		}?>
				
				<!--<td valign="top" align="center" width="160" >
				
				<script type='text/javascript' src='http://j.admagnet.net/panda/js/Bizfin-160x600/Deal4Loans_160x600_1268645580.js?'></script>
<noscript><a href='http://n.admagnet.net/panda/www/delivery/ck.php?n=a3abe099&amp;cb=60501175' target='_blank'><img src='http://n.admagnet.net/panda/www/delivery/avw.php?zoneid=3943&amp;n=a3abe099' border='0' alt='' /></a></noscript>


</td>-->

			</tr>
		</table>
		

	<? }
	else
	{
		$filename = "Contents_Loan_Against_Property_Mustread.php";
						header("Location: $filename");
						exit();
	}
	?>

 
			</div>
 
<? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div>
</body>
</html>

