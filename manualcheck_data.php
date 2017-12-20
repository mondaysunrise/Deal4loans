<?php
require 'scripts/db_init.php';

if(isset($_POST['fname']))
{
	$fname=$_POST['fname'];
	$checkdata=" SELECT firstname FROM manual_user_details WHERE firstname='".$fname."' ";
	$query=ExecQuery($checkdata);
	if(mysql_num_rows($query)>0)
	{ echo "<br>Name Already Exist"; }
	else { echo "<br>OK"; }
	exit();
}

if(isset($_POST['source']))
{
	$source=$_POST['source'];
	$checkdata=" SELECT source FROM manual_user_details WHERE source='".$source."' ";
	$query=ExecQuery($checkdata);
	if(mysql_num_rows($query)>0)
	{ echo "<br>Source Already Exist"; }
	else { echo "<br>OK"; }
	exit();
}

if(isset($_POST['username']))
{
	$username=$_POST['username'];
	$checkdata=" SELECT Email FROM Bidders WHERE Email='".$username."' ";
	$query=ExecQuery($checkdata);
	if(mysql_num_rows($query)>0)
	{ echo "<br>User Name Already Exist"; }
	else { echo "<br>OK"; }
	exit();
}
?>