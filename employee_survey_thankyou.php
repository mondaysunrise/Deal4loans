<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(isset($_POST['submit']))
{
	$expect_to_work = $_POST['expect_to_work'];
	$rate_wrs = $_POST['rate_wrs'];
	$age = $_POST['age'];
	$service = $_POST['service'];
	$gender = $_POST['gender'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$company_great_place = $_POST['company_great_place'];
	$improved_compnay = $_POST['improved_compnay'];
	
	$eid = $_POST['e_id'];
	
	
	$DataArray = array('expect_to_work'=>$expect_to_work, 'rate_wrs'=>$rate_wrs, 'age'=>$age, 'gender'=>$gender, 'service'=>$service, 'state'=>$state, 'city'=>$city, 'company_great_place'=>$company_great_place, 'improved_compnay'=>$improved_compnay);
	$wherecondition ="(e_id=".$eid.")";
		Mainupdatefunc ('employee_survey', $DataArray, $wherecondition);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Survey</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<style>
.lfttxtbar {
color:#373737;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
line-height:15px;
text-align:justify;
font-weight:bold;
}
</style>
<script language="javascript">
function chkform()
{}

</script>
</head>

<body>
<table width="85%" border="0" cellspacing="1" cellpadding="3" bgcolor="#333333"  align="center">
    <tr>
    <td  colspan="2"  bgcolor="#FFFFFF"><img src="new-images/d4l-logo.gif" alt="Deal4loans" />&nbsp;&nbsp;&nbsp;<b class="lfttxtbar">WRS Employee Alignment Survey - 2010</b></td>
    </tr>
  
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td height="417" bgcolor="#FFFFFF" class="lfttxtbar style1" valign="top"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <div align="center">Thanks you submitting your feedback. </div></td>
  </tr>
</table>

</body>
</html>
