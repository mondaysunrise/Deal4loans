<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$get_Mobile = $_REQUEST['get_Phone'];
$get_RequestID = $_REQUEST['get_RequestID'];
$get_id = trim($_REQUEST['get_id']) ;
//print_r($_REQUEST);
 $checkSql = "select * from icici_car_loan_calc where icici_clid = '".$get_RequestID."'";
list($numRows,$checkQuery)=Mainselectfunc($checkSql,$array = array());
$Reference_Code = trim($checkQuery[0]['Reference_Code']);
if($Reference_Code == $get_id)
{
	echo "<strong>Valid Number</strong>";
	echo '<input type="hidden" name="verify_code"  value=\'verified\' readonly>';
	$DataArray = array("Is_Valid"=>'1');
	$wherecondition ="(icici_clid = '".$get_RequestID."')";
	Mainupdatefunc ('icici_car_loan_calc', $DataArray, $wherecondition);
}
else
{
	echo '<input type="text" name="verify_code" maxlength="4" style="width:35px;" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /> <a href="#" onclick="return verification();" style="font-size:10px; font-family:Verdana, Arial, Helvetica, sans-serif; text-decoration:none;">Reverify</a>';
	echo '<div style="font-weight:normal; color:#FF0000; font-size:9; text-align:left">Enter Verification code to validate mobile.</div>';
}
?>