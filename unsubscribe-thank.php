<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$From_Name = $_POST['From_Name'];
		$mobile = $_POST['mobile'];
		$From_Email = $_POST['From_Email'];
		$sqlCheck = "select * from unsubscribe where Email = '".$From_Email."' and Phone = '".$mobile."'";
		list($numCheck,$myrow)=MainselectfuncNew($sqlCheck,$array = array());

		if($numCheck>0)
		{
		}
		else
		{
			$dataInset = array('Name'=>$From_Name , 'Email'=>$From_Email , 'Phone'=>$mobile , 'Status'=>'1');
			$insert = Maininsertfunc ('unsubscribe', $dataInset);	
		}
	}

	$R_URL='index.php';
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Unsubscribe - Deal4loans</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
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
.aplfrm{
	border-left:5px solid #a2d7f6;
	border-right:5px solid #a2d7f6;
	background:#f6fcff;
}
-->
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div style="margin:auto; width:970px; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> <span class="text12" style="color:#4c4c4c;">> Do not Disturb</span></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center" style="color:#FF0000;">
  <div style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; line-height:25px; color:#333333; text-align:center;">Thanks and We will not send any Email & SMS to you. </div>



  </div>
</div>
</div>
</div>
<div style="clear:both; height:15px;"></div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>