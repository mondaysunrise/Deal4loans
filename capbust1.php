<?php
require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
 
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
<?php
//$message = "<link href='http://www.deal4loans.com/includes/style.css' rel='stylesheet' type='text/css'>";
$message = "<table width='535' border='0' cellspacing='0' cellpadding='0' align='center'>";
$message .= "<tr><td colspan='5' height='30' align='center'><strong>List of PrePaid Bidders</strong></td></tr>";
$message .= "<tr><td bgcolor='#FF3000'><div align='center'><strong>Inactive bidders </strong></div></td><td bgcolor='#FFF200'><div align='center'><strong>Greater Than 90%</strong></div></td><td bgcolor='#FFFFFF'><div align='center'><strong>Active</strong></div></td><td bgcolor='#FFB400'><div align='center'><strong>Leads 100%</strong></div></td><td bgcolor='#F6E769'><div align='center'><strong>Cap not Defined</strong></div></td></tr><tr><td colspan='5'>&nbsp;</td></tr></table>";
$message .= "<table width='769' cellspacing='0' cellpadding='4' align='center'><tr><td colspan='6'><strong>Active Bidders</strong></td></tr><tr>  <td width='108'><strong>Bidder Name</strong> </td><td width='65'><strong>Product</strong></td><td width='83'><strong>Maximum Leads</strong></td><td width='109'><strong>Leads Gone(As shown in LMS)</strong></td> <td width='70'><strong>Actual Leads Gone</strong></td><td width='136'><strong>Percentage of Leads Gone(As shown in LMS)</strong></td><td width='140'><strong>Percentage of Actual Leads Gone</strong></td><td width='140'><strong>City</strong></td></tr>";

	$Sql_3 = "SELECT Bidder_Name, BidderID, City FROM `Bidders` WHERE Define_PrePost = 'PrePaid'";
	$Query_3 = ExecQuery($Sql_3);

$RowCount = mysql_num_rows($Query_3);
for($i=0;$i<$RowCount;$i++)
{

	$BidderID = mysql_result($Query_3,$i,'BidderID'); 
	$Bidder_Name = mysql_result($Query_3,$i,'Bidder_Name'); 
	$City = mysql_result($Query_3,$i,'City');
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
	if($absPercentLeads>100 )
	{
		$BgColor = "bgcolor='#FF3000'";
	}
	if($absPercentLeads=="100" )
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
	//if($absPercentLeads>90 || $explodeCapLead_Count[3]<1)
	//{
		$message .= " <tr ".$BgColor." ><td width='108'>".$Bidder_Name." (".$BidderID.")</td><td>".getReqValue($Reply_Type)."</td><td>".$explodeCapLead_Count[3]."</td><td>".$TotalLeadsLMS."</td><td width='70'><strong>".$TotalLeads."</strong></td><td>".round($PercentLeadsLMS,2)." %</td><td>".round($PercentLeads,2)." %</td><td>".$City."</td></tr>";
	///}
	}
}
////////INACTIVE BIDDERS (CAP BRUST)////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////


$message .= "</table>";

echo $message;
$email = "bd@deal4loans.in,sales@deal4loans.in";


   				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//				$headers .= 'To: '.$full_name.' <'.$email.'>' . "\r\n";
				$headers .= 'From: Deal4Loans<no-reply@deal4loans.com>' . "\r\n";
				$headers  = 'From: Deal4Loans<no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				
					$currenttime = date('H');
	
	if($currenttime==23 || $currenttime==00)
				mail($email,'Active PrePaid Bidders List(Deal4loans)', $message, $headers);
	
?>