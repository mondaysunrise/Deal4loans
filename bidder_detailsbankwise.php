<?php 
require 'scripts/functions.php'; 
require 'scripts/db_init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$product = $_POST["product"];
		$Status = $_POST["Status"];
		$City = $_POST["City"];
		 $bank_name = $_POST["bank_name"];
		
		$getbidderdetails="select BidderID,Bidder_Name,City,CapLead_Count from Bidders_List Where (Bidder_Name like '%".$bank_name."%' and City like '%".$City."%' and Reply_Type='".$product."' and Restrict_Bidder=1)";
	list($biddrecordcount,$row)=Mainselectfunc($getbidderdetails,$array = array());
		
		
	}
?>
<html>
<head>
<title>PrePaid Bidders List</title>
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
 <center>
 <?php include '~TopBidder.php'; ?>
<table width='535' border='0' cellspacing='0' cellpadding='0'  class="blueborder" align="center">
 <form name="frmsearch" action="<? echo $_SERVER['PHP_SELF'] ?>" method="post" onSubmit="return chkform();">
   <tr>
     <td colspan="4" class="head1">Search</td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	   <td width="13%">&nbsp;</td>
     <td width="41%">&nbsp;</td>
   </tr>
   <tr>
     <td width="11%"><strong>Product</strong></td>
     <td width="35%">
		<select name="product" id="product">
		<option value="">Please Select</option>
			<option value="1" <? if($product=="1") { echo "selected";} ?>>Personal Loan</option>
			<option value="2" <? if($product=="2") { echo "selected";} ?>>Home Loan</option>
			<option value="3" <? if($product=="3") { echo "selected";} ?>>Car Loan</option>
			<option value="4" <? if($product=="4") { echo "selected";} ?>>Credit Card</option>
			<option value="5" <? if($product=="5") { echo "selected";} ?>>Loan Against Property</option>
			</select>
		</td>
		<td><b>Status</b></td>
		<td><select name="Status" id="Status"><option value="1">Active</option><option value="2">In Active</option></select></td>
   </tr>
  <tr><td><b>Select City</b></td><td>
   <select name="City" id="City" style="width:154px;" onChange="cityother();" > <?=getCityList($City)?></select>
  </td><td><b>Bank Name</b></td><td>
   <select name="bank_name" id="bank_name" style="width:154px;" onChange="cityother();" > <? 
   $biddernme="select Bank_Name from Bank_Master order by Bank_Name ASC" ;
	list($recordcount,$rowbn)=MainselectfuncNew($biddernme,$array = array());
   ?>
   <option value="">Please Select</option>
   <?
  for($i=0;$i<$recordcount;$i++)
		{ 
		 ?>
		<option value="<? echo $rowbn[$i]["Bank_Name"]; ?>" <? if($rowbn[$i]["Bank_Name"] ==$bank_name) echo "selected"; ?>><? echo $rowbn[$i]["Bank_Name"]; ?></option>	
	<? 	}
   ?></select>
  </td></tr>
   <tr>
     <td colspan="4" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   </form>
</table>
<br><br>
<? if($biddrecordcount>0)
{
?>
<table  width="700" border='1' cellspacing='0' cellpadding='0'  class="blueborder" align="center">
<tr><td align="center"><b>BidderID</b></td><td align="center"><b>Bank Name</b></td><td align="center"><b>City</b></td><td align="center"><b>Daily Cap</b></td><td align="center"><b>Total Cap</b></td><td align="center"><b>Leads Gone</b></td><td align="center"><b>Type</b></td><td align="center"><b>BD name</b></td></tr>
<?
$explodeCapLead_Count="";
$color = '';
		for($i=0;$i<$biddrecordcount;$i++)
		{
	 $color = '';
		$CapLead_Count = $row[$i]["CapLead_Count"];
		 $explodeCapLead_Count = explode(",", $CapLead_Count);
		 $BookKeeping_Sql = "SELECT sum(`BookLeadCount`) AS bidcount  FROM `Bidders_Book_Keeping` WHERE `BidderID` ='".$row[$i]["BidderID"]."' and BookProduct = '".$product."'";
	list($rowcount,$rowcnt)=Mainselectfunc($BookKeeping_Sql,$array = array());	
	
	$bddetails="select BD_Name,Define_PrePost from Bidders Where BidderID=".$row[$i]["BidderID"]."";
	list($rowcount1,$rwdet)=Mainselectfunc($bddetails,$array = array());	
	if($explodeCapLead_Count[3]==$rowcnt["bidcount"])
	{
		$color = 'style="background-color:#FFCC00"';
	}

	
		 ?>
<tr <?php echo $color; ?> ><td align="center"  height="30"><? echo $row[$i]["BidderID"];?></td><td align="center"><? echo $row["Bidder_Name"];?></td><td align="center"><textarea rows="3" cols="30"><? echo $row[$i]["City"];?></textarea></td><td align="center"><? echo $explodeCapLead_Count[0];?></td><td align="center"><? echo $explodeCapLead_Count[3]; ?></td><td align="center"><? echo $rowcnt["bidcount"] ;?></b></td><td align="center"><? echo $rwdet["Define_PrePost"];?></td><td align="center"><? echo $rwdet["BD_Name"];?></td></tr>
<? } ?>
</table>
<? } ?>
</center></div>
</body>
</html>
