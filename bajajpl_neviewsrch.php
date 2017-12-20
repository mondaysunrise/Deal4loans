<?php
require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			foreach($_POST as $a=>$b)
				$$a=$b;
	$cust_mobileno = $_POST['cust_mobileno'];
		
	$CheckSql ="SELECT Name,Email,Mobile_Number,Net_Salary,City,DOB,Updated_Date,axis_executive_name,comment_section FROM Req_Loan_Home LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=Req_Loan_Home.RequestID AND Req_Feedback_HL.BidderID in (732,812,460,207,2823)  WHERE (Req_Loan_Home.Mobile_Number=".$cust_mobileno." )";
			$result=ExecQuery($CheckSql);
$recordcount = mysql_num_rows($result);

if($recordcount>0)
			{
	$msg = "Value found";
			}
	
}

?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
 <div align="center">

<?php 
 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
<FORM NAME="search_entry" action="<? echo $_SERVER['PHP_SELF'] ?>" method="post"  >
			<TABLE ALIGN="center"  CELLPADDING="0" style="border: 1px solid #529BE4;" CELLSPACING="0" BORDER="0">
			<tr>
			<td width="247" align="center" bgcolor="529BE4"> <b>Fill form to search the details</b>			</td>
			</tr>
			
				<tr>
				<td>
				&nbsp;&nbsp;Mobile &nbsp;<input type="text" name="cust_mobileno" >
				</td>
				</tr>
								<tr>
				 <td  align="center" class="bodyarial11"><br>
				<input type="submit" class="bluebutton" value="Submit.." >
				</td>
		   </tr>
			</TABLE>
		</FORM>
	<?php
		if(isset($msg))
		{
			
				
		?>
		<table  cellpadding="4" cellspacing="1" class="blueborder" width="60%">
		<tr>
			<td colspan="7" align="center"><strong><?php echo $msg; ?></strong></td>
		</tr>
		<tr>
		
			<td class="head1">Name</td>
			<td class="head1">Email</td>
			<td class="head1">Mobile</td>
			<td class="head1">Net_Salary</td>
			<td class="head1">City</td>
			<td class="head1">DOB</td>
			<td class="head1">Doe</td>
		
				<td class="head1">Feedback</td>
				<td class="head1">Comments</td>
		</tr>
				
		<? while($row=mysql_fetch_array($result))
		{ ?>
			
		<tr>
		
			<td class="bodyarial11"><?php echo $row["Name"]; ?></td>
			<td class="bodyarial11"><?php echo $row["Email"]; ?></td>
			<td class="bodyarial11"><?php echo $row["Mobile_Number"];?></td>
			<td class="bodyarial11"><?php echo  $row["Net_Salary"];?></td>
			<td class="bodyarial11"><?php echo $row["City"]; ?></td>
			<td class="bodyarial11"><?php echo  $row["DOB"];?></td>
			<td class="bodyarial11"><?php echo $row["Updated_Date"]; ?></td>
		 <td  class="bodyarial11"><? echo $Followup_Date = $row['axis_executive_name']; ?>	  
	 </td>
	 <td  class="bodyarial11"><? echo $comment_section = $row['comment_section']; ?>	  
	 </td>

		</tr>
		<?			
	}?>
		</table>
		<?php
		}
		?>
      </div>
   </div>
   </div>

</body>

</html>
