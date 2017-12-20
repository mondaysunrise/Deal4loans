<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		$prprtydid = $_POST['prprtydid'];
		$custreqtid= $_POST['custreqtid'];
		
		$hlqry="select Name,Mobile_Number,Email,City,DOB From Req_Loan_Home Where ( RequestID='".$custreqtid."')";
		list($alreadyExist,$hlrow)=MainselectfuncNew($hlqry,$array = array());
		$myrowcontr=count($hlrow)-1;
		$prprtydl_name = $hlrow[$myrowcontr]['Name'];
		$prprtydl_mobile_no = $hlrow[$myrowcontr]['Mobile_Number'];
		$prprtydl_email = $hlrow[$myrowcontr]['Email'];
		$prprtydl_city = $hlrow[$myrowcontr]['City'];
		$prprtydl_dob = $hlrow[$myrowcontr]['DOB'];
$Dated = ExactServerdate();
$dataInsert = array('prprtydl_name'=>$prprtydl_name, 'prprtydl_email'=>$prprtydl_email, 'prprtydl_mobile_no'=>$prprtydl_mobile_no, 'prprtydl_city'=>$prprtydl_city, 'prprtydl_dob'=>$prprtydl_dob, 'prprtydi_slcid'=>$prprtydid, 'prprtydl_dated'=>$Dated);
$insert = Maininsertfunc ('property_deal_leads', $dataInsert);
					
		
				
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
</head>
<style>
.bnk_logo{
	width:105px;
	height:35px;
	padding-left:4px;
	padding-top:0px;
	*padding-top:11px;
}
</style>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
  <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a call from us.</h1>
 
</div>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>

