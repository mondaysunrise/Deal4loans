<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/db_init_bima.php';	
	require 'scripts/functions.php';
	$mobile_no = $_POST['mobile_no'];
	$todayDate = date("Y-m-d")." 23:59:59";
	$lastmonth = mktime(0, 0, 0, date("m"), date("d")-30,   date("Y"));
	$days30ago = date("Y-m-d",$lastmonth)." 00:00:00";

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
.style3 {font-size: 12px}
.style4 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.style5 {font-size: 14px}
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->
</style>
</head>

<body>
 <table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
       <td align="center">
         <h2 class="style1">Validate The Mobile Number       </h2></td></tr>
    <tr>
       <td align="center">
<form id="form1" name="form1" method="post" action="">
  <table width="50%" border="0" cellspacing="2" cellpadding="2" style="border:#000000 1px solid;">
    <tr>
      <td class="style4">Put the Mobile Number</td>
      <td><input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no; ?>" /></td>
    </tr>

    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Submit" /></td>
    </tr>
    </table>
    </form>
    </td></tr>
    <tr><td align="center">
      <table width="90%" border="0" cellspacing="2" cellpadding="2" >
    <?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$mobile_no = $_POST['mobile_no'];
		?>
        
        <?php
		$getHLLeadSql = "select * from Req_Health_Insurance where Phone = '".$mobile_no."' and (Dated between '".$days30ago."' and '".$todayDate."')  order by Dated desc";
		$getHLLeadQuery = ExecQuery_bima($getHLLeadSql);
		$numHL = mysql_num_rows($getHLLeadQuery);
		if($numHL>0)
		{
		?>
        <tr>
          <td  > <h3 class="style1">Health Insurance</h3></td>
          <td>&nbsp;</td>
        </tr>
        <tr><td colspan="2" style="padding-left:80px;">
        <form action="validate-missedcall.php" method="post" name="HL">
             <table width="80%" cellspacing="2" cellpadding="2" border="0" bgcolor="#0000CC" style="border:#000000 1px solid;">
        <tr><td width='35%' align="center" bgcolor="#CCCCCC"><h4 class="style4">Name</h4></td><td  width='15%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">City</h4></td><td width='20%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">Phone</h4></td><td width='30%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">Dated</h4></td><td  width='10%' align="center"  bgcolor="#CCCCCC"><h4><span class="style1"><span class="style3"><span class="style5"></span></span></span></h4></td></tr>   <?php
		
		
		for($i=0;$i<$numHL;$i++)
		{
			echo "<tr  class='style4'>";
			$Name = mysql_result($getHLLeadQuery,$i,'Name');
			$City = mysql_result($getHLLeadQuery,$i,'City');
			$Phone  = mysql_result($getHLLeadQuery,$i,'Phone');
			$RequestID  = mysql_result($getHLLeadQuery,$i,'RequestID');
			$Dated  = mysql_result($getHLLeadQuery,$i,'Dated');
			//	echo "<td width='35%'  bgcolor='#FFFFFF'>".$Name."</td><td  width='15%' bgcolor='#FFFFFF'>".$City."</td><td  width='20%' bgcolor='#FFFFFF'>".$Phone."</td><td width='30%' bgcolor='#FFFFFF'>".$Dated."</td><td  width='10%' bgcolor='#FFFFFF'>";
			
			echo "<td width='35%'  bgcolor='#FFFFFF'><span class='style6'>".$Name."</span></td>        <td  width='15%' bgcolor='#FFFFFF'><span class='style6'>".$City."</span></td>        <td  width='20%' bgcolor='#FFFFFF'><span class='style6'>".$Phone."</span></td>        <td width='30%' bgcolor='#FFFFFF'><span class='style6'>".$Dated."</span></td>       <td  width='10%' bgcolor='#FFFFFF'><span class='style6'>";
			echo '<input type="radio" name="validate_Lead" value="'.$RequestID.'" />';
			
			echo "</span></td></tr>";

			
			
		}
		
		?>
          <tr><td colspan="5" align="right"  bgcolor='#FFFFFF'>
        <input type="hidden" name="Product" value="HI" />
        <input type="submit" name="Submit" value="Validate HI" /></td></tr>
        </table>
        </form>
        </td></tr>
        <?php } 
        	$getLAPLeadSql = "select * from Req_Loan_Against_Property where Mobile_Number = '".$mobile_no."' and (Dated between '".$days30ago."' and '".$todayDate."')  order by Dated desc";
		$getLAPLeadQuery = ExecQuery($getLAPLeadSql);
		$numLAP = mysql_num_rows($getLAPLeadQuery);
        if($numLAP>0)
		{
		?>
        <tr>
          <td><h3 class="style1">Loan Against Property</h3></td>
          <td>&nbsp;</td>
        </tr>
         <tr><td colspan="2"  style="padding-left:80px;">
                 <form action="validate-missedcall.php" method="post" name="LAP">
        <table width="80%" cellspacing="2" cellpadding="2" border="0" bgcolor="#0000CC" style="border:#000000 1px solid;">
        <tr><td width='35%' align="center" bgcolor="#CCCCCC"><h4 class="style4">Name</h4></td><td  width='15%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">City</h4></td><td width='20%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">Phone</h4></td><td width='30%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">Dated</h4></td><td  width='10%' align="center"  bgcolor="#CCCCCC"><h4><span class="style1"><span class="style3"><span class="style5"></span></span></span></h4></td></tr>
        <?php
		for($i=0;$i<$numLAP;$i++)
		{
			echo "<tr class='style4'>";
			$Name = mysql_result($getLAPLeadQuery,$i,'Name');
			$City = mysql_result($getLAPLeadQuery,$i,'City');
			$Phone  = mysql_result($getLAPLeadQuery,$i,'Mobile_Number');
			$RequestID  = mysql_result($getLAPLeadQuery,$i,'RequestID');
			$Dated  = mysql_result($getLAPLeadQuery,$i,'Dated');
			
		//	echo "<td width='35%'  bgcolor='#FFFFFF'>".$Name."</td><td  width='15%' bgcolor='#FFFFFF'>".$City."</td><td  width='20%' bgcolor='#FFFFFF'>".$Phone."</td><td width='30%' bgcolor='#FFFFFF'>".$Dated."</td><td  width='10%' bgcolor='#FFFFFF'>";
			
			echo "<td width='35%'  bgcolor='#FFFFFF'><span class='style6'>".$Name."</span></td>        <td  width='15%' bgcolor='#FFFFFF'><span class='style6'>".$City."</span></td>        <td  width='20%' bgcolor='#FFFFFF'><span class='style6'>".$Phone."</span></td>        <td width='30%' bgcolor='#FFFFFF'><span class='style6'>".$Dated."</span></td>       <td  width='10%' bgcolor='#FFFFFF'><span class='style6'>";
			echo '<input type="radio" name="validate_Lead" value="'.$RequestID.'" />';
			
			echo "</span></td></tr>";
			
		}
		
		?>
        <tr><td colspan="5" align="right"  bgcolor='#FFFFFF'>
        <input type="hidden" name="Product" value="LAP" />
        <input type="submit" name="Submit" value="Validate LAP" /></td></tr>
        </table>
        </form>
        </td></tr>
        <?php
		}
		
			$getLAPLeadSql = "select * from Req_Loan_Car where Mobile_Number = '".$mobile_no."' and (Dated between '".$days30ago."' and '".$todayDate."')  order by Dated desc";
		$getLAPLeadQuery = ExecQuery($getLAPLeadSql);
		$numLAP = mysql_num_rows($getLAPLeadQuery);
        if($numLAP>0)
		{
		?>
        <tr>
          <td><h3 class="style1">Car Loan</h3></td>
          <td>&nbsp;</td>
        </tr>
         <tr><td colspan="2"  style="padding-left:80px;">
                 <form action="validate-missedcall.php" method="post" name="CL">
        <table width="80%" cellspacing="2" cellpadding="2" border="0" bgcolor="#0000CC" style="border:#000000 1px solid;">
        <tr><td width='35%' align="center" bgcolor="#CCCCCC"><h4 class="style4">Name</h4></td><td  width='15%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">City</h4></td><td width='20%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">Phone</h4></td><td width='30%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">Dated</h4></td><td  width='10%' align="center"  bgcolor="#CCCCCC"><h4><span class="style1"><span class="style3"><span class="style5"></span></span></span></h4></td></tr>
        <?php
		for($i=0;$i<$numLAP;$i++)
		{
			echo "<tr class='style4'>";
			$Name = mysql_result($getLAPLeadQuery,$i,'Name');
			$City = mysql_result($getLAPLeadQuery,$i,'City');
			$Phone  = mysql_result($getLAPLeadQuery,$i,'Mobile_Number');
			$RequestID  = mysql_result($getLAPLeadQuery,$i,'RequestID');
			$Dated  = mysql_result($getLAPLeadQuery,$i,'Dated');
			
		//	echo "<td width='35%'  bgcolor='#FFFFFF'>".$Name."</td><td  width='15%' bgcolor='#FFFFFF'>".$City."</td><td  width='20%' bgcolor='#FFFFFF'>".$Phone."</td><td width='30%' bgcolor='#FFFFFF'>".$Dated."</td><td  width='10%' bgcolor='#FFFFFF'>";
			
			echo "<td width='35%'  bgcolor='#FFFFFF'><span class='style6'>".$Name."</span></td>        <td  width='15%' bgcolor='#FFFFFF'><span class='style6'>".$City."</span></td>        <td  width='20%' bgcolor='#FFFFFF'><span class='style6'>".$Phone."</span></td>        <td width='30%' bgcolor='#FFFFFF'><span class='style6'>".$Dated."</span></td>       <td  width='10%' bgcolor='#FFFFFF'><span class='style6'>";
			echo '<input type="radio" name="validate_Lead" value="'.$RequestID.'" />';
			
			echo "</span></td></tr>";
			
		}
		
		?>
        <tr><td colspan="5" align="right"  bgcolor='#FFFFFF'>
        <input type="hidden" name="Product" value="CL" />
        <input type="submit" name="Submit" value="Validate CL" /></td></tr>
        </table>
        </form>
        </td></tr>
        <?php
		}
	
	?>
    
       <?php
		$getHLLeadSql = "select * from Req_Auto_Insurance where Phone = '".$mobile_no."' and (Dated between '".$days30ago."' and '".$todayDate."')  order by Dated desc";
		$getHLLeadQuery = ExecQuery_bima($getHLLeadSql);
		$numHL = mysql_num_rows($getHLLeadQuery);
		if($numHL>0)
		{
		?>
        <tr>
          <td  > <h3 class="style1">Motor Insurance</h3></td>
          <td>&nbsp;</td>
        </tr>
        <tr><td colspan="2" style="padding-left:80px;">
        <form action="validate-missedcall.php" method="post" name="AL">
             <table width="80%" cellspacing="2" cellpadding="2" border="0" bgcolor="#0000CC" style="border:#000000 1px solid;">
        <tr><td width='35%' align="center" bgcolor="#CCCCCC"><h4 class="style4">Name</h4></td><td  width='15%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">City</h4></td><td width='20%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">Phone</h4></td><td width='30%' align="center"  bgcolor="#CCCCCC"><h4 class="style4">Dated</h4></td><td  width='10%' align="center"  bgcolor="#CCCCCC"><h4><span class="style1"><span class="style3"><span class="style5"></span></span></span></h4></td></tr>   <?php
		
		
		for($i=0;$i<$numHL;$i++)
		{
			echo "<tr  class='style4'>";
			$Name = mysql_result($getHLLeadQuery,$i,'Name');
			$City = mysql_result($getHLLeadQuery,$i,'City');
			$Phone  = mysql_result($getHLLeadQuery,$i,'Phone');
			$RequestID  = mysql_result($getHLLeadQuery,$i,'RequestID');
			$Dated  = mysql_result($getHLLeadQuery,$i,'Dated');
			//	echo "<td width='35%'  bgcolor='#FFFFFF'>".$Name."</td><td  width='15%' bgcolor='#FFFFFF'>".$City."</td><td  width='20%' bgcolor='#FFFFFF'>".$Phone."</td><td width='30%' bgcolor='#FFFFFF'>".$Dated."</td><td  width='10%' bgcolor='#FFFFFF'>";
			
			echo "<td width='35%'  bgcolor='#FFFFFF'><span class='style6'>".$Name."</span></td>        <td  width='15%' bgcolor='#FFFFFF'><span class='style6'>".$City."</span></td>        <td  width='20%' bgcolor='#FFFFFF'><span class='style6'>".$Phone."</span></td>        <td width='30%' bgcolor='#FFFFFF'><span class='style6'>".$Dated."</span></td>       <td  width='10%' bgcolor='#FFFFFF'><span class='style6'>";
			echo '<input type="radio" name="validate_Lead" value="'.$RequestID.'" />';
			
			echo "</span></td></tr>";

			
			
		}
		
		?>
          <tr><td colspan="5" align="right"  bgcolor='#FFFFFF'>
        <input type="hidden" name="Product" value="AI" />
        <input type="submit" name="Submit" value="Validate Motor" /></td></tr>
        </table>
        </form>
        </td></tr>
        <?php 
		} 
		
	}
     ?>
</table>
</td></tr>
  </table>
  


</body>
</html>
