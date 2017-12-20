<?php
	require 'scripts/session_check_online.php';
	
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
<tr><td colspan="5" height="30" align="center"><strong>List of PrePaid Bidders</strong></td></tr>
	<tr><td bgcolor='#FF3000' align="center"><strong>InActive</strong></td><td bgcolor='#FFFFFF'><div align="center"><strong>Active</strong></div></td><td bgcolor='#FFF200'><div align="center"><strong>GreaterThan 90%</strong></div></td><td bgcolor='#FFB400'><div align="center"><strong>Leads 100%</strong></div></td><td bgcolor='#F6E769'><div align="center"><strong>Cap not Defined</strong></div></td></tr>
<tr><td colspan="5">&nbsp;</td></tr>
</table>
<table width='769' cellspacing='0' cellpadding='4'   class="blueborder" align="center">
	<tr><td colspan="6"><strong>Active Bidders</strong></td></tr>
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
require 'scripts/db_init.php';
require 'scripts/functions.php';

	$Sql_3 = "SELECT Bidder_Name, BidderID, City FROM `Bidders` WHERE Define_PrePost = 'PrePaid'";
	$Query_3 = ExecQuery($Sql_3);

$RowCount = mysql_num_rows($Query_3);
for($i=0;$i<$RowCount;$i++)
{

	$BidderID = mysql_result($Query_3,$i,'BidderID'); 
	$Bidder_Name = mysql_result($Query_3,$i,'Bidder_Name'); 

	$Sql_1 = "SELECT * FROM `Bidders_List` where BidderID=$BidderID";
	$Query_1 = ExecQuery($Sql_1);
	
	$Reply_Type = mysql_result($Query_1,0,'Reply_Type'); 
	$CapLead_Count = mysql_result($Query_1,0,'CapLead_Count'); 
	$Restrict_Bidder = mysql_result($Query_1,0,'Restrict_Bidder');
	
	$explodeCapLead_Count = explode(",", $CapLead_Count);
 	$BookKeeping_Sql = "SELECT sum(`BookLeadCount`) FROM `Bidders_Book_Keeping` WHERE `BidderID` =$BidderID and BookProduct = $Reply_Type";
	$BookKeeping_Query = ExecQuery($BookKeeping_Sql);
	 $rowBookKeeping = mysql_fetch_array($BookKeeping_Query);
	$TotalLeads = $rowBookKeeping[0];
	
	$PercentLeads =  $TotalLeads/$explodeCapLead_Count[3]*100;
	$absPercentLeads = round($PercentLeads);
	
 $val = getReqValue1($Reply_Type);
 
	$SqlCountLead="SELECT * FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$BidderID."' WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID = '".$BidderID."' and  Req_Feedback_Bidder1.Reply_Type = '".$Reply_Type."' group by ".$val.".Mobile_Number";
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
   <td><?php echo getReqValue($Reply_Type);;?></td>
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
?>
</table>
<br /><br />
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
for($i=0;$i<$RowCount;$i++)
{
$BidderID = mysql_result($Query_3,$i,'BidderID'); 
	$Bidder_Name = mysql_result($Query_3,$i,'Bidder_Name'); 

	$Sql_1 = "SELECT * FROM `Bidders_List` where BidderID=$BidderID";
	$Query_1 = ExecQuery($Sql_1);
	
	$Reply_Type = mysql_result($Query_1,0,'Reply_Type'); 
	$CapLead_Count = mysql_result($Query_1,0,'CapLead_Count'); 
	$Restrict_Bidder = mysql_result($Query_1,0,'Restrict_Bidder');
	
	$explodeCapLead_Count = explode(",", $CapLead_Count);
 	$BookKeeping_Sql = "SELECT sum(`BookLeadCount`) FROM `Bidders_Book_Keeping` WHERE `BidderID` =$BidderID and BookProduct = $Reply_Type";
	$BookKeeping_Query = ExecQuery($BookKeeping_Sql);
	 $rowBookKeeping = mysql_fetch_array($BookKeeping_Query);
	$TotalLeads = $rowBookKeeping[0];
	
	$PercentLeads =  $TotalLeads/$explodeCapLead_Count[3]*100;
	$absPercentLeads = round($PercentLeads);
	
 $val = getReqValue1($Reply_Type);
 
	$SqlCountLead="SELECT * FROM Req_Feedback_Bidder1,`".$val."` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$val.".RequestID AND Req_Feedback.BidderID= '".$BidderID."' WHERE Req_Feedback_Bidder1.AllRequestID=`".$val."`.RequestID and Req_Feedback_Bidder1.BidderID = '".$BidderID."' and  Req_Feedback_Bidder1.Reply_Type = '".$Reply_Type."' group by ".$val.".Mobile_Number";
	$QueryCountLead = ExecQuery($SqlCountLead);
	$TotalLeadsLMS = mysql_num_rows($QueryCountLead);
	//$TotalLeads = $rowBookKeeping[0];
	
	$PercentLeadsLMS =  $TotalLeadsLMS/$explodeCapLead_Count[3]*100;
	$absPercentLeadsLMS = round($PercentLeadsLMS);

	if($Restrict_Bidder==0)
	{
		$Restrict = "InActive" ;
		$BgColor = "bgcolor='#FF3000'";
	
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
   <td><?php echo getReqValue($Reply_Type);;?></td>
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
?>


</table>
</center>
</div>
</body>
</html>