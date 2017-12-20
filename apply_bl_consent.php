<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$pl_requestid = $_REQUEST['pl_requestid'];
	$pl_bank_name = $_REQUEST['pl_bank_name'];
	
	if (strlen($pl_bank_name)>1 && $pl_requestid>1)
	{
		$selqry="select PL_Bank from Req_Loan_Personal Where RequestID=".$pl_requestid;
	//$restselqry= ExecQuery($selqry);
	//$plrow=mysql_fetch_array($restselqry);
	 list($CheckNumRows,$plrow)=Mainselectfunc($selqry,$array = array());
	$pl_banks=$plrow['PL_Bank'];
	
	if(strlen($pl_banks)>1)
		{
			$newpl_banks= $pl_banks.",".$pl_bank_name;
			//$plupdate= "Update Req_Loan_Personal  set PL_Bank='".$newpl_banks."' Where (Req_Loan_Personal.RequestID=".$pl_requestid.")";		
			$DataArray = array("PL_Bank"=>$newpl_banks);
			$wherecondition ="(Req_Loan_Personal.RequestID=".$pl_requestid.")";
			
		}
		else
		{
			//$plupdate= "Update Req_Loan_Personal  set PL_Bank='".$pl_bank_name."' Where (Req_Loan_Personal.RequestID=".$pl_requestid.")";
			$DataArray = array("PL_Bank"=>$pl_bank_name);
			$wherecondition ="(Req_Loan_Personal.RequestID=".$pl_requestid.")";
			
		}
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
		//ExecQuery($plupdate);
		//echo $plupdate."<br>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
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
</style>
</head>
<body>
<?php 
include "middle-menu.php";
?>
<div style="clear:both;"></div>
<div class="secondwrapper-pl">
  <div class="text12" style="margin:auto; width:74%; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.html" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Business Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Business Loan</span></div>
<div style="clear:both; height:1px;"></div>
<div style="clear:both; width:960px; margin:auto;  margin-top:2px;">
<div id="container">
  <div id="txt"  style="padding-top:15px; height:60px;">
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Business Loan from <? echo $pl_bank_name; ?> through Deal4loans.com </h1>  
</div>
</div>
<div style="clear:both; height:80px; width:964px; margin:auto; margin-top:10px;"></div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>