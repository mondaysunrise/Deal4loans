<?php
//require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'personal_loan_allocation_function.php';
session_start();

$id = $_REQUEST['id'];


$product_type = "Req_Loan_Personal";
		$CheckSql = "select Name, Email, Net_Salary, Mobile_Number, City, DOB, Dated from ".$product_type." where  RequestID='".$id."' "; 
		
		$result=ExecQuery($CheckSql);

			$City = $row["City"];
			$RequestID = $id;

		
		$FeedbackSql = "select BidderID from Req_Feedback_Bidder1 where  AllRequestID = '".$id."' and Reply_Type = 1";
			$FeedbackQuery = ExecQuery($FeedbackSql);
			
			while($rowBidders=mysql_fetch_array($FeedbackQuery))
			{
				  $Customerid = $rowBidders["BidderID"];
				 $StringBidders[] = $Customerid;				 			
			}
		
		$AllocatedStr = implode(",", $StringBidders);	
		
		$ValueBidders = getBidders(getReqValue("Req_Loan_Personal"),$RequestID,$City); 
			
		$StringValueBidders = implode(",", $ValueBidders);
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

  <table width="100%" border="0">
 <tr><td align="center" width="100%">
 <img src="images/logo.gif" alt="Deal4Loans" onClick="javascript:location.href='index.php'"/>
 <div align="center">

		<table  cellpadding="4" cellspacing="1" class="blueborder" width="60%">
		
		<tr>
			<td class="head1">Name</td>
			<td class="head1">Email</td>
			<td class="head1">Mobile</td>
			<td class="head1">Net_Salary</td>
			<td class="head1">City</td>
			<td class="head1">DOB</td>
			<td class="head1">Doe</td>
		</tr>
		
		<? while($row=mysql_fetch_array($result))
		{ ?>

		<tr>
			<td class="bodyarial11"><?php echo $row["Name"]; ?></td>
			<td class="bodyarial11"><?php echo $row["Email"]; ?></td>
			<td class="bodyarial11"><?php echo $row["Mobile_Number"];?></td>
			<td class="bodyarial11"><?php echo  $row["Net_Salary"];?></td>
			<td class="bodyarial11"><?php echo  $row["City"];?></td>
			<td class="bodyarial11"><?php echo  $row["DOB"];?></td>
			<td class="bodyarial11"><?php echo  $row["Dated"];?></td>

		</tr>
		<!--<tr>
			<td class="bodyarial11" colspan="4"><?php echo $AllocatedStr; ?></td>
			<td class="bodyarial11" colspan="3"><?php echo $StringValueBidders; ?></td>
		</tr>-->
		
		<?			}?>
		</table>
		
 <br>
 
 <br>

 <h3 class="bodyarial11">

    </div>
 </td></tr></table>
  </div>
   </div>
<?php //include '~Bottom.php';?>


</body>

</html>
