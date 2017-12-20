<?php
	require 'scripts/session_check.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$product=$_POST["product"];
		$bidder_name=$_POST["bidder_name"];
		$email=$_POST["email"];
		$company_name=$_POST["company_name"];
		$city=$_POST["city"];
		$mobile=$_POST["mobile"];
		$filters=$_POST["filters"];
		$package_sold=$_POST["package_sold"];
		$requested_by=$_POST["requested_by"];
		$total_cap=$_POST["total_cap"];
		$daily_cap=$_POST["daily_cap"];
		$requested_by=$_POST["requested_by"];

print_r($_POST);

$email="ranjana5chauhan@gmail.com";
$custsubject="Create Bidder (Insurance)";
$message="<table><tr><td>Product</td><td>".$product."</td></tr><tr>	<td>Bidder Name</td>	<td>".$bidder_name."</td></tr><tr>	<td>Email</td>	<td>".$email."</td></tr><tr>	<td>Company Name</td>	<td>".$company_name."</td></tr><tr>	<td>City</td>	<td>".$city."</td></tr><tr>	<td>Mobile</td>	<td>".$mobile."</td></tr><tr>	<td>Filters</td>	<td>".$filters."</td></tr><tr>	<td>Total Cap</td>	<td>".$total_cap."</td></tr><tr>	<td>Daily Cap</td>	<td>".$daily_cap."</td></tr><tr>	<td>Requested By</td>
	<td>".$requested_by."</td></tr></table>";

$headers  = 'From: Sales <sales@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <sales@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($email, $custsubject,$message,$headers);


	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<div align="center"><b> form to fill</b></div>
<form name="create_bidder" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkform();" method="POST">
	<table border="1" cellpadding="4" cellspacing="0" align="center">
		<tr>
			<td>Product</td>
			<td><select name="product" id="product">
					<option value="-1">Please Select</option>
					<option value="Life Insurance">Life Insurance</option>
					<option value="Health Insurance">Health Insurance</option>
				</select>		
			</td>
		</tr>
		<tr>
			<td>Bidder Name</td>
			<td><input type="text" name="bidder_name" id="bidder_name"/></td>
		</tr>
		<tr>
			<td>Email id</td>
			<td><input type="text" name="email" id="email"/></td>
		</tr>
		<tr>
			<td>Company Name</td>
			<td><input type="text" name="company_name" id="company_name"/></textarea></td>
		</tr>
		<tr>
			<td>City</td>
			<td><textarea rows="5" cols="30" type="text" name="city" id="city"/></textarea></td>
		</tr>
		<tr>
			<td>Mobile Number</td>
			<td><input type="text" name="mobile" id="mobile"/></td>
		</tr>
		<tr>
			<td>Filters</td>
			<td><textarea rows="5" cols="30" name="filters" id="filters"></textarea></td>
		</tr>
		<tr>
			<td>Total Cap</td>
			<td><input type="text" name="total_cap" id="total_cap"/></td>
		</tr>
		<tr>
			<td>Daily Cap</td>
			<td><input type="text" name="daily_cap" id="daily_cap"/></td>
		</tr>
		<tr>
			<td>Package Sold</td>
			<td>
				<select name="package_sold" id="package_sold">
				<option value="-1">Please Select</option>
				<option value="25">25 Leads Pack</option>
				<option value="50">50 Leads Pack</option>
				<option value="100">100 Leads Pack</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Requested By</td>
			<td>
				<select name="requested_by" id="requested_by">
				<option value="-1">Please Select</option>
				<option value="Akansha(9837075175)">Akansha(9837075175)</option>
				<option value="Afsana(9717594465)">Afsana(9717594465)</option>
				<option value="Balbir Singh(9717594462)">Balbir Singh(9717594462)</option>
				<option value="Priyanka Sharma(9899405626)">Priyanka Sharma(9899405626)</option>
				<option value="Bhawna Sharma(9717594460)">Bhawna Sharma(9717594460)</option>
				<option value="Nidhi Khanna(9899242484)">Nidhi Khanna(9899242484)</option>
				<option value="Neha Aggarwal(9999047207)">Neha Aggarwal(9999047207)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td>
			
		</tr>
	</table>
</form>
</body>
</html>
