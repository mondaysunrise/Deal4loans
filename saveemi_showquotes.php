<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$saveemiid=$_REQUEST["savemiid"];
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
 <center>
 
  <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
  <tr>
			<td class="head1">Bank Name</td>
			<td class="head1">Interest Rate</td>
			<td class="head1">Loan Amount</td>
			<td class="head1">EMI</td>
			<td class="head1">Tenure</td>
			<td class="head1">Processing fee</td>
			<td class="head1">Total Saving</td>
			<td class="head1">Product</td>
			</tr>
  <? $qry="select *  from saveemicalc_tbl_showquotes where (saveemiid=".$saveemiid.") order by saveemicalc_tbl_showquotes.dated desc";
	$result=ExecQuery($qry);
		while($row=mysql_fetch_array($result))
		{
			$bank_name = $row["bank_name"];
			$interest_rate = $row["interest_rate"];
			$loan_amount = $row["loan_amount"];
			$new_emi = $row["new_emi"];
			$tenure = $row["tenure"];
			$processing_fee = $row["processing_fee"];
			$total_saving = $row["total_saving"];
			$product_details = $row["product_details"];
			?>
			<tr>
			<td><? echo $bank_name; ?></td>
			<td><? echo $interest_rate; ?></td>
			<td><? echo $loan_amount; ?></td>
			<td><? echo $new_emi; ?></td>
			<td><? echo $tenure; ?></td>
			<td><? echo $processing_fee; ?></td>
			<td><? echo $total_saving; ?></td>
			<td><? echo $product_details; ?></td>
			</tr>
		<? }
	
	?>
	</table>
   <?php// include '~Bottom.php'; ?>
 </h3>
 </center>
</div>
</body>
</html>