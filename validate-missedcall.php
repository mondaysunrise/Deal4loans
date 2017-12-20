<?php 
ob_start();
//print_r($_POST);
require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/db_init_bima.php';	
	require 'scripts/functions.php';
	$Product = $_POST['Product'];
	$RequestID = $_POST['validate_Lead'];
	
	
	if($_POST['Product']=="HI")
	{
		  $updateSql = "update Req_Health_Insurance set  valid_hdfcergo='1' where RequestID = '".$RequestID."'";	
		$updateQuery = ExecQuery_bima($updateSql);
	}
	else if($_POST['Product']=="LAP")
	{
		$updateSql = "update Req_Loan_Against_Property set Is_Valid='1' where RequestID = '".$RequestID."'";	
		$updateQuery = ExecQuery($updateSql);
	}
	else if($_POST['Product']=="CL")
	{
		$updateSql = "update Req_Loan_Car set Is_Valid='1' where RequestID = '".$RequestID."'";	
		$updateQuery = ExecQuery($updateSql);
	}
	else if($_POST['Product']=="AI")
	{
		$updateSql = "update Req_Auto_Insurance set Is_Valid='1' where RequestID = '".$RequestID."'";	
		$updateQuery = ExecQuery($updateSql);
	}
	else
	{
	 	echo "Please specify Product";
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Validate Number</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>

<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>

<body>
 <table width="100%" border="0" cellspacing="2" cellpadding="2">
   <tr>
       <td align="center">
         <h2 class="style1">Validate The Mobile Number       </h2></td></tr>
    <tr>
   <tr><td align="center"> 
      <table width="70%" border="0" cellspacing="2" cellpadding="2" >
<?php
	    if($_POST['Product']=="HI")
		{?>
        <tr>
          <td ><h3 class="style1">Health Insurance</h3></td>
          <td>&nbsp;</td>
        </tr>
        <tr><td colspan="2" style="padding-left:80px;">
        
       
             <table width="80%" cellspacing="2" cellpadding="2" border="0" bgcolor="#0000CC" style="border:#000000 1px solid;">
       
          <tr><td colspan="5" align="right"  bgcolor='#FFFFFF'>
       <?php
	    	echo "Lead Updated";
	   ?>
       </td></tr>
        </table>
       
        </td></tr>
        <?php
		}
		?>
        <?php
	    if($_POST['Product']=="LAP")
		{
		?>
        <tr>
          <td><h3 class="style1">Loan Against Property</h3></td>
          <td>&nbsp;</td>
        </tr>
         <tr><td colspan="2"  style="padding-left:80px;">
              
        <table width="80%" cellspacing="2" cellpadding="2" border="0" bgcolor="#0000CC" style="border:#000000 1px solid;">

        <tr><td colspan="5" align="right"  bgcolor='#FFFFFF'>
		<?php	   	echo "Lead Updated";		?>
		</td></tr>
        </table>

        </td></tr>
        <?php
		}
		?>
         <?php
	    if($_POST['Product']=="CL")
		{
		?>
        <tr>
          <td><h3 class="style1">Car Loan</h3></td>
          <td>&nbsp;</td>
        </tr>
         <tr><td colspan="2"  style="padding-left:80px;">
              
        <table width="80%" cellspacing="2" cellpadding="2" border="0" bgcolor="#0000CC" style="border:#000000 1px solid;">

        <tr><td colspan="5" align="right"  bgcolor='#FFFFFF'>
		<?php	   	echo "Lead Updated";		?>
		</td></tr>
        </table>

        </td></tr>
        <?php
		}
		?>
         <?php
	    if($_POST['Product']=="AI")
		{
		?>
        <tr>
          <td><h3 class="style1">Motor Insurance</h3></td>
          <td>&nbsp;</td>
        </tr>
         <tr><td colspan="2"  style="padding-left:80px;">
              
        <table width="80%" cellspacing="2" cellpadding="2" border="0" bgcolor="#0000CC" style="border:#000000 1px solid;">

        <tr><td colspan="5" align="right"  bgcolor='#FFFFFF'>
		<?php	   	echo "Lead Updated";		?>
		</td></tr>
        </table>

        </td></tr>
        <?php
		}
		?>
      <tr>
          <td ><h4><a href="validate-missed-call.php" class="style1">Go Back</a></h4></td>
          <td>&nbsp;</td>
        </tr>  
       
       
</table>
</td></tr>
  </table>
  


</body>
</html>
