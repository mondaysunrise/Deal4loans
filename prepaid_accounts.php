<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
	require 'scripts/session_check_online.php';
		require 'login_validation_bidders.php';
	
   function getReqValue($pKey){
    $titles = array(
        '1' => 'Personal Loan',
        '2' => 'Home Loan',
        '3' => 'Car Loan',
        '4' => 'Credit Card',
        '5' => 'LAP',
        '6' => 'Business Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

	function getReqValue1($pKey){
	$titles = array(
        '1' => 'Req_Loan_Personal',
		'2' => 'Req_Loan_Home',
		'3' => 'Req_Loan_Car',
		'4' => 'Req_Credit_Card',
		'5' => 'Req_Loan_Against_Property',
		'6' => 'Req_Business_Loan'
	);
	
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }

  $product="";
	if(isset($_REQUEST['product']))
	{
		$product=$_REQUEST['product'];
	}
$Status = "";
if(isset($_REQUEST['Status']))
	{
		$Status=$_REQUEST['Status'];
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
 <form name="frmsearch" action="prepaid_accounts.php" method="post" onSubmit="return chkform();">
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
		<td>Status</td>
		<td><select name="Status" id="Status"><option value="1">Active</option><option value="2">In Active</option></select></td>
   </tr>  
   <tr>
     <td colspan="4" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   </form>
</table>
<table width='535' border='0' cellspacing='0' cellpadding='0'  class="blueborder" align="center">
<tr><td colspan="5" height="30" align="center"><strong>List of PrePaid Bidders</strong></td></tr>
	<tr><td bgcolor='#FF3000' align="center"><strong>InActive</strong></td><td bgcolor='#FFFFFF'><div align="center"><strong>Active</strong></div></td><td bgcolor='#FFF200'><div align="center"><strong>GreaterThan 90%</strong></div></td><td bgcolor='#FFB400'><div align="center"><strong>Leads 100%</strong></div></td><td bgcolor='#F6E769'><div align="center"><strong>Cap not Defined</strong></div></td></tr>
<tr><td colspan="5">&nbsp;</td></tr>
</table>
<? 
if(isset($product))
{
	$Sql_3 = "SELECT Bidder_Name, BidderID, City FROM `Bidders` WHERE (Define_PrePost = 'PrePaid' and Global_Access_ID=0 ) order by   	  Associated_Bank ASC";
	$Query_3 = ExecQuery($Sql_3);

$RowCount = mysql_num_rows($Query_3);
if($Status==1)
	{
	?>
	<table width='769' cellspacing='0' cellpadding='4'   class="blueborder" align="center">
	<tr><td colspan="6"><strong>Active Bidders</strong></td></tr>
  <tr>
  <td width='108'><strong>Bidder Name</strong> </td>
   <td width='108'><strong>Bank Name</strong> </td>
    <td width='108'><strong>City</strong> </td>
   <td width="65"><strong>Daily Lead Cap</strong></td>
    <td width="83"><strong>Maximum Leads</strong></td>   
    <td width="109"><strong>Leads Gone(As shown in LMS)</strong></td>
    <td width="70"><strong>Actual Leads Gone</strong></td>
   <td width="136"><strong>Percentage of Leads Gone(As shown in LMS)</strong></td>
  <td width="140"><strong>Percentage of Actual Leads Gone</strong></td>
  </tr>
	<?
for($i=0;$i<$RowCount;$i++)
{

	$BidderID = mysql_result($Query_3,$i,'BidderID'); 
	$Bidder_Name = mysql_result($Query_3,$i,'Bidder_Name'); 

	$Sql_1 = "SELECT Reply_Type,City,Bidder_Name,CapLead_Count,Restrict_Bidder FROM `Bidders_List` where (BidderID='".$BidderID."' and Reply_Type='".$product."' and Restrict_Bidder=1) order by Bidder_Name ASC";
	//echo $Sql_1;
	$Query_1 = ExecQuery($Sql_1);
	
	$Reply_Type = mysql_result($Query_1,0,'Reply_Type');
	$City = mysql_result($Query_1,0,'City');
	$Bank_Name = mysql_result($Query_1,0,'Bidder_Name');
	$CapLead_Count = mysql_result($Query_1,0,'CapLead_Count'); 
	$Restrict_Bidder = mysql_result($Query_1,0,'Restrict_Bidder');
	
	$explodeCapLead_Count = explode(",", $CapLead_Count);
 	$BookKeeping_Sql = "SELECT sum(`BookLeadCount`) FROM `Bidders_Book_Keeping` WHERE `BidderID` ='".$BidderID."' and BookProduct = '".$Reply_Type."'";
	$BookKeeping_Query = ExecQuery($BookKeeping_Sql);
	 $rowBookKeeping = mysql_fetch_array($BookKeeping_Query);
	$TotalLeads = $rowBookKeeping[0];
	
	$PercentLeads =  $TotalLeads/$explodeCapLead_Count[3]*100;
	$absPercentLeads = round($PercentLeads);
	
 $val = getReqValue1($Reply_Type);
	if($Reply_Type==1)
	{
		$feedback_tbl="Req_Feedback_Bidder_PL";
	}
	elseif($Reply_Type==2)
	{
		$feedback_tbl="Req_Feedback_Bidder_HL";
	}
	elseif($Reply_Type==5)
	{
		$feedback_tbl="Req_Feedback_Bidder_LAP";
	}
	elseif($Reply_Type==3)
	{
		$feedback_tbl="Req_Feedback_Bidder_CL";
	}
	elseif($Reply_Type==4)
	{
		$feedback_tbl="Req_Feedback_Bidder_CC";
	}
	else
	{
		$feedback_tbl="Req_Feedback_Bidder1";
	}

	$SqlCountLead="SELECT RequestID FROM ".$feedback_tbl.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$BidderID."' WHERE ".$feedback_tbl.".AllRequestID=`".$val."`.RequestID and ".$feedback_tbl.".BidderID = '".$BidderID."' and  ".$feedback_tbl.".Reply_Type = '".$Reply_Type."' group by ".$val.".Mobile_Number";
	$QueryCountLead = ExecQuery($SqlCountLead);
	$TotalLeadsLMS = mysql_num_rows($QueryCountLead);
	//$TotalLeads = $rowBookKeeping[0];
	
	$PercentLeadsLMS =  $TotalLeadsLMS/$explodeCapLead_Count[3]*100;
	$absPercentLeadsLMS = round($PercentLeadsLMS);

	if($Restrict_Bidder==1)
	{
		$Restrict =  "Active";
		$BgColor = "bgcolor='#FFFFFF'";
	
	if($absPercentLeads>=90)
	{
		$BgColor = "bgcolor='#FFF200'";
	}
	if($absPercentLeads>99)
	{
		$BgColor = "bgcolor='#FFB400'";
	}
	if($explodeCapLead_Count[3]<1)
	{
		$BgColor = "bgcolor='#F6E769'";
	}
	if($Restrict_Bidder==0)
	{
		$BgColor = "bgcolor='#FF3000'";
	}
	
	?>
	
	
  <tr <?php echo $BgColor;?> >
<td width='108'><?php echo $Bidder_Name." (".$BidderID.")" ;?></td>
<td width='108'><?php echo $Bank_Name ;?></td>
<td width='108'><textarea rows="1"><?php echo $City ;?></textarea></td>
  <td><?php echo $explodeCapLead_Count[0];?></td>
    <td><?php echo $explodeCapLead_Count[3];?></td>
  <td><?php echo $TotalLeadsLMS;?></td>
      <td width="70"><strong><?php echo $TotalLeads;?></strong></td>
 <td><?php 
	echo round($PercentLeadsLMS,2)." %";
	?></td>
  <td><?php 
	echo round($PercentLeads,2)." %";
	?></td>
  </tr>

<?php
	}
}
}
?>
</table>
<? if($Status==2)
	{ ?>
<table width='769' cellspacing='0' cellpadding='4'   class="blueborder" align="center">
	<tr><td colspan="6"><strong>InActive Bidders</strong></td></tr>
	 <tr>
  <td width='108'><strong>Bidder Name</strong> </td>
    <td width="65"><strong>Product</strong></td>
    <td width="83"><strong>Maximum Leads</strong></td>   
    <td width="109"><strong>Leads Gone(As shown in LMS)</strong></td>
    <td width="70"><strong>Actual Leads Gone</strong></td>
   <td width="136"><strong>Percentage of Leads Gone(As shown in LMS)</strong></td>
  <td width="140"><strong>Percentage of Actual Leads Gone</strong></td>
  </tr>
<?php
for($r=0;$r<$RowCount;$r++)
{

	$BidderID = mysql_result($Query_3,$r,'BidderID'); 
	$Bidder_Name = mysql_result($Query_3,$r,'Bidder_Name'); 

	$Sql_2 = "SELECT Reply_Type,City,Bidder_Name,CapLead_Count,Restrict_Bidder FROM `Bidders_List` where (BidderID='".$BidderID."' and Reply_Type='".$product."' and Restrict_Bidder=0  and Dated >'2008-01-01') order by Bidder_Name ASC";
	//echo $Sql_2;
	$Query_2 = ExecQuery($Sql_2);
	
	$Reply_Type = mysql_result($Query_2,0,'Reply_Type');
	$City = mysql_result($Query_2,0,'City');
	$Bank_Name = mysql_result($Query_2,0,'Bidder_Name');
	$CapLead_Count = mysql_result($Query_2,0,'CapLead_Count'); 
	$Restrict_Bidder = mysql_result($Query_2,0,'Restrict_Bidder');
	
	$explodeCapLead_Count = explode(",", $CapLead_Count);
 	$BookKeeping_Sql = "SELECT sum(`BookLeadCount`) FROM `Bidders_Book_Keeping` WHERE `BidderID` ='".$BidderID."' and BookProduct = '".$Reply_Type."'";
	$BookKeeping_Query = ExecQuery($BookKeeping_Sql);
	 $rowBookKeeping = mysql_fetch_array($BookKeeping_Query);
	$TotalLeads = $rowBookKeeping[0];
	
	$PercentLeads =  $TotalLeads/$explodeCapLead_Count[3]*100;
	$absPercentLeads = round($PercentLeads);
	
 $val = getReqValue1($Reply_Type);
 
 if($Reply_Type==1)
	{
		$feedback_tbl="Req_Feedback_Bidder_PL";
	}
	elseif($Reply_Type==2)
	{
		$feedback_tbl="Req_Feedback_Bidder_HL";
	}
	elseif($Reply_Type==5)
	{
		$feedback_tbl="Req_Feedback_Bidder_LAP";
	}
	elseif($Reply_Type==3)
	{
		$feedback_tbl="Req_Feedback_Bidder_CL";
	}
	elseif($Reply_Type==4)
	{
		$feedback_tbl="Req_Feedback_Bidder_CC";
	}
	else
	{
		$feedback_tbl="Req_Feedback_Bidder1";
	}
	$SqlCountLead="SELECT RequestID FROM ".$feedback_tbl.",`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$BidderID."' WHERE ".$feedback_tbl.".AllRequestID=`".$val."`.RequestID and ".$feedback_tbl.".BidderID = '".$BidderID."' and  ".$feedback_tbl.".Reply_Type = '".$Reply_Type."' group by ".$val.".Mobile_Number";
	$QueryCountLead = ExecQuery($SqlCountLead);
	$TotalLeadsLMS = mysql_num_rows($QueryCountLead);
	//$TotalLeads = $rowBookKeeping[0];
	
	$PercentLeadsLMS =  $TotalLeadsLMS/$explodeCapLead_Count[3]*100;
	$absPercentLeadsLMS = round($PercentLeadsLMS);

	if($Restrict_Bidder==0 && $TotalLeadsLMS>0)
	{
		$Restrict = "InActive" ;
		$BgColor = "bgcolor='#FF3000'";
	
	?>
	
	
  <tr <?php echo $BgColor;?> >
<td width='108'><?php echo $Bidder_Name." (".$BidderID.")" ;?></td>
<td width='108'><?php echo $Bank_Name;?></td>
<td width='108'><textarea rows="1"><?php echo $City ;?></textarea></td>
  <!-- <td><?php //echo getReqValue($Reply_Type);;?></td>-->
    <td><?php echo $explodeCapLead_Count[3];?></td>
  <td><?php echo $TotalLeadsLMS;?></td>
      <td width="70"><strong><?php echo $TotalLeads;?></strong></td>
 <td><?php 
	echo round($PercentLeadsLMS,2)." %";
	?></td>
  <td><?php 
	echo round($PercentLeads,2)." %";
	?></td>
  </tr>

<?php
	}
}
}
?>


</table>
<? } ?>
</center>
</div>
</body>
</html>