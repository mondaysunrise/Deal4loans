<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

//print_r ($_SESSION);
$product_t = $_REQUEST['product'];
//echo "ss".$product_t;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			foreach($_POST as $a=>$b)
				$$a=$b;
	$Bidderid = $_REQUEST['Bidderid'];
	$product_type = $_REQUEST['product_type'];

	if(strlen($Bidderid)>0)
			{
		$getbidder="select Query,Table_Name,BidderID,Reply_Type,Bank_Name,Bidders_List.BankID,CapLead_Count,Cap_MinDate,Dated,Restrict_Bidder,City from Bidders_List LEFT OUTER JOIN Bank_Master ON Bank_Master.BankID = Bidders_List.BankID where Reply_Type=".$product_type." and  BidderID=".$Bidderid;
		//$getbidderresult=ExecQuery($getbidder);
	
	 list($recordcount,$row)=MainselectfuncNew($getbidder,$array = array());
		$cntr=0;
		//echo "hello:: ".$getbidder;
		

		/*$result = ExecQuery("select *  from Bidders where  BidderID=$Bidderid");
		
		$num_rows = mysql_num_rows($result);

		if($num_rows > 0){
			 /* Get Resultset */
			//$row = mysql_fetch_array($result);

			 /* Create Session Variables */
			//setSessionBidder($Email, $row);

			 /* Dump Resultset */
			//mysql_free_result($result);
		
			//}
			}

	
	

		

	$msg = "Value found";
	
}

?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Search Data</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<?php include '~Top.php';?>
<script>
function validate()
{
	if(document.search_entry.Bidderid.value=="")
{
	alert("Please enter Bidderid.");
	document.search_entry.Bidderid.focus();
	return false;
}
if (document.search_entry.product_type.selectedIndex==0)
	{
		alert("Please select product ");
		document.search_entry.product_type.focus();
		return false;
	}

}
</script>
  <table width="100%" border="0">
 <tr><td align="center" width="100%">
 <img src="images/logo.gif" alt="Deal4Loans" onClick="javascript:location.href='index.php'"/>
 <div align="center">

<!--  <p class="bodyarial11"><?=$Msg?></p> -->
<FORM NAME="search_entry" action="<? echo $_SERVER['PHP_SELF'] ?>" method="post" onSubmit="return validate();" >
			<TABLE ALIGN="center"  CELLPADDING="0" style="border: 1px solid #529BE4;" CELLSPACING="0" BORDER="0">
			<tr>
			<td align="center" bgcolor="529BE4"> <b>Fill form to search the details</b>
			</td>
			</tr>
			<tr>
				<td>&nbsp;<td></tr>
				<tr>
				<tr>
				<td>BidderID: &nbsp;<input type="text" name="Bidderid" id="Bidderid" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyDown="intOnly(this);" <?if(isset($Bidderid)) {?>value="<?echo $Bidderid;?>"<? } ?>></td>
				<tr>
				<td>&nbsp;<td></tr>
				<tr>
				<td>Select product &nbsp;<select name="product_type" id="product_type">
				<option value="-1">Please select</option>
				<option <?if ($product_t == "1" || $product_type=="1") {echo "selected";}?> value="1">Personal Loan</option>
				<option <?if ($product_t == "2" || $product_type=="2") {echo "selected";}?> value="2">Home Loan</option>
				<option <?if ($product_t == "3" || $product_type=="3") {echo "selected";}?> value="3">Car Loan</option>
				<option <?if ($product_t == "5" || $product_type=="5") {echo "selected";}?> value="5">Loan Against Property</option>
				<option <?if ($product_t == "4" || $product_type=="4") {echo "selected";}?> value="4">Credit Card</option>
					<option <?if ($product_t == "6" || $product_type=="6") {echo "selected";}?> value="6">Business Loan</option>
				</td>
				</tr>
				<tr>
				 <td colspan="2" align="center" class="bodyarial11"><br>
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
		<td class="head1">BidderID</td>
			<td class="head1">Bank Name</td>
			<td class="head1">Product</td>
			<td class="head1">City</td>
			<td class="head1">Status</td>
			<td class="head1">Start Date</td>
			
		</tr>
		
		<? while($cntr<count($row))
        {
			$getresult = ("select BidderID from Bidders_List where  FIND_IN_SET(".$row[$cntr]['BankID'].",BankID) and Reply_Type=".$row["Reply_Type"]." ");
echo "select BidderID from Bidders_List where  FIND_IN_SET(".$row[$cntr]['BankID'].",BankID) and Reply_Type=".$row[$cntr]["Reply_Type"]."";
			 list($viewleadscount,$ArrRows)=MainselectfuncNew($getresult,$array = array());
			$i=0;
			
			//$viewleadscount =mysql_num_rows($getresult);
			$getallconflictbidder ="";
			while($i<count($ArrRows))
			{
			 $conflictBidderID = $ArrRows[$i]['BidderID'];
			$getallconflictbidder =$getallconflictbidder.$conflictBidderID.",";
			 $i = $i+1;}
			$getallconflictbidder = substr($getallconflictbidder, 0, strlen($getallconflictbidder)-1);
			//echo $getallconflictbidder;
			$_SESSION["Conflictbidder"]=$getallconflictbidder;
			$_SESSION["bidderid"]=$row[$cntr]["BidderID"];
			$_SESSION["bidquery"]=$row[$cntr]["Query"];
			$_SESSION["tablename"]=$row[$cntr]["Table_Name"];
			$_SESSION["bidcity"]=$row[$cntr]["City"];
			$_SESSION["Cap_MinDate"] = $row[$cntr]["Cap_MinDate"];
			$_SESSION["CapLead_Count"] = $row[$cntr]["CapLead_Count"];

			if($row[$cntr]["Reply_Type"]==1)
			{
				$product="Personal Loan";
			}
			elseif($row[$cntr]["Reply_Type"]==2)
			{
				$product="Home Loan";
			}
			elseif($row[$cntr]["Reply_Type"]==3)
			{
				$product="Car Loan";
			}
			elseif($row[$cntr]["Reply_Type"]==4)
			{
				$product="Credit Card";
			}
			elseif($row[$cntr]["Reply_Type"]==5)
			{
				$product="Loan Against Property";
			}
			elseif($row[$cntr]["Reply_Type"]==6)
			{
				$product="Business Loan";
			}

			if($row[$cntr]["Restrict_Bidder"]==1)
			{
				$Restrict_Bidder="Open";
			}
			else
			{
				$Restrict_Bidder="Closed";
			}
			?>

		<tr>
		<td class="bodyarial11"><?php echo $row[$cntr]["BidderID"]; ?></td>
			<td class="bodyarial11"><?php echo $row[$cntr]["Bank_Name"]; ?></td>
			<td class="bodyarial11"><?php echo $product; ?></td>
			<td class="bodyarial11"><?php echo $row[$cntr]["City"];?></td>
			<td class="bodyarial11"><?php echo  $Restrict_Bidder;?></td>
			<td class="bodyarial11"><?php echo  $row[$cntr]["Dated"];?></td>
			

		</tr>
		<? if($row[$cntr]["Restrict_Bidder"]==1)
		{
		?>
		<form NAME="getdetails" action="leadallocation_index.php" method="post">
		<tr><td colspan="6" >
		<input type="hidden" name="bidderquery" id="bidderquery" value="<?echo $row["Query"];?>" >
		<input type="hidden" name="tablename" id="tablename"  value="<?echo $row["Table_Name"];?>">
		<input type="hidden" name="biddercity"  value="<?echo $row["City"];?>"  id="biddercity">
		</td>
		</tr>
		<tr><td colspan="6" align="center"> <input type="submit" value="continue" name="submit"></td></tr></form>
		<?	
		}
		$cntr = $cntr + 1;
		
		}?>
		</table>
		<?php
		}
		?>
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
