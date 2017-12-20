<?php
	require 'scripts/functions.php';
	session_start();
?>
<html>

<head>
<title>Personal Loan Eligibility : Personal Loan Banks in India : Best Personal Loans Providers</title>
<meta name="keywords" content="best personal loans providers, personal loans eligibility, personal finance eligibility, personal loans india, compare personal loans, personal loan schemes, personal loan banks in India, easy personal loans, quick loans, bank loans, best personal loans, flexible personal loan, low interest personal loan">
<meta name="description" content="Know more about personal loan eligibility terms and conditions for salaried and self employed individuals from India. Also find online information on best personal loans providers and compare personal loan banks in India like HSBC, HDFC, ICICI, CITI Bank, Standard Chartered, ABN AMRO Bank etc.">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
 <center>
 <?php include '~Top.php'; ?>
 <table border="0" cellspacing="0" width="712" cellpadding="0">
   <tr>
     <td width="202" align="center" valign="top" bgcolor="">
     <?php if(session_is_registered('Email'))
	{
	include '~Left.php';
	}
	else
	{
	include '~Login.php';
	}
?>
     &nbsp;</td>
       <td width="510" align="center" valign="top">
     	<span class="bodyarial11"><br>
     	<?php @include "Contents/".$_GET["f"].".php"; ?></span>
     &nbsp;</td>
     </tr>
 </table>
 <?php include '~Bottom.php';?>
 </center>
</div>
</body>

</html>
