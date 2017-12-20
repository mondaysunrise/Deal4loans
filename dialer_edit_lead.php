<?php
ob_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_GET);
$RequestID = $_REQUEST['LeadID'];
$BidderID = $_REQUEST['agentid'];
$ListID = $_REQUEST['ListID'];//Not in use
$leadidentifier = $_REQUEST['leadidentifier'];
$dated = ExactServerdate();

$getBiddersSql = "select BidderID from Bidders where leadidentifier='".$leadidentifier."' and BidderID='".$BidderID."'";
$getBiddersQuery = ExecQuery($getBiddersSql);
$getBiddersNum = mysql_num_rows($getBiddersQuery);

if($leadidentifier=='smsplleads' && $getBiddersNum>0)
{

	 $updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	 $updateqryresult = ExecQuery($updateqry);
	//echo "<br>";
//echo "If - ".$updateqry;
//	echo "SMS PL Channel Redirect";

	$url = "http://www.deal4loans.com/personalloan_smsleadondetails.php?postid=".$RequestID."&biddt=".$BidderID;
	header("Location: ".$url);
	exit();
}
else if($leadidentifier=="diallerleadcc")
{
	 $updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	 $updateqryresult = ExecQuery($updateqry);
	$url = "http://www.deal4loans.com/sbiccleadlms-details.php?postid=".$RequestID."&biddt=".$BidderID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
	
}
else if($leadidentifier=="diallerleadcc1")
{
	$url = "http://www.deal4loans.com/sbicctwlleadlms-detail.php?postid=".$RequestID."&biddt=".$BidderID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
	
}
else if($leadidentifier=="diallerleadccsms")
{
	$url = "http://www.deal4loans.com/sbiccleadlms-detail.php?postid=".$RequestID."&biddt=".$BidderID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
	
}
else if($leadidentifier=="hdfcpl1")
{
	 $updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	 $updateqryresult = ExecQuery($updateqry);
	$url = "http://www.deal4loans.com/plallocatedleadlms-detailshdfc.php?postid=".$RequestID."&biddt=".$BidderID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
	
}
else if($leadidentifier=="hdfcpl2")
{
	 $updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	 $updateqryresult = ExecQuery($updateqry);
	$url = "http://www.deal4loans.com/plallocatedleadlms-detailshdfc.php?postid=".$RequestID."&biddt=".$BidderID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
	
}
else if($leadidentifier=="bajajfinservdialler2" || $leadidentifier=="bajajfinservdialler1" || $leadidentifier=="bajajfinservdialler3")
{
	 $updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	 $updateqryresult = ExecQuery($updateqry);
	$url = "http://www.deal4loans.com/plallocatedleadlmsdetailsbajaj.php?postid=".$RequestID."&biddt=".$BidderID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
	
}
else if($leadidentifier=="selmsbl")
{
	 $updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	 $updateqryresult = ExecQuery($updateqry);
	$url = "http://www.deal4loans.com/callinglms/pl-self-emp-editlead.php?id=".$RequestID."&Bid=".$BidderID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
	
}
else if($leadidentifier=="sms_pl_bajaj" || $leadidentifier=="sms_pl_hdfc")
{
	 $updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	 $updateqryresult = ExecQuery($updateqry);
	$url = "http://www.deal4loans.com/personalloaneditlead.php?id=".$RequestID."&bid=".$BidderID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
	
}
else if($leadidentifier=="plmainlms")
{
	 $updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	 $updateqryresult = ExecQuery($updateqry);
	$url = "http://www.deal4loans.com/pleditlead.php?id=".$RequestID."&Bid=".$BidderID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
}

else if($leadidentifier=="plmainlms79" || $leadidentifier=="plmainlmsS")
{
	$qryCheck = "SELECT BidderID FROM Bidders where leadidentifier='".$leadidentifier."' and Profile='".$BidderID."'";
	$qryCheckQuery = ExecQuery($qryCheck);
	$Bidder_ID = mysql_result($qryCheckQuery,0,'BidderID');
	
	$updateqry= "Update lead_allocate set BidderID='".$Bidder_ID."' Where AllRequestID = '".$RequestID."'";
	$updateqryresult = ExecQuery($updateqry);
	$url = "http://www.deal4loans.com/pleditlead.php?id=".$RequestID."&Bid=".$Bidder_ID;
	header("Location: ".$url);
	exit();
////	http://www.deal4loans.com/sbiccleadlms-details.php?postid=843608&biddt=5657
}

else if(($leadidentifier=='calllmsbajajfinservpl' || $leadidentifier=='calllmsindusindbankpl'  || $leadidentifier=='calllmskotakbankpl'  || $leadidentifier=='calllmsfullertonsmlctypl'  || $leadidentifier=='calllmshdfcbanksmlctypl') && $getBiddersNum>0)
{
	$updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	$updateqryresult = ExecQuery($updateqry);
exit();
	$url = "http://www.deal4loans.com/plallocatedleadlms-details.php?postid=".$RequestID."&biddt=".$BidderID;
	//header("Location: ".$url);
	exit();
}

else
{
	$updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	//$updateqryresult = ExecQuery($updateqry);
	echo "<br>";
	echo "else - ".$updateqry;
	exit();
	$url = "http://www.deal4loans.com/plallocatedleadlms-details.php?postid=".$RequestID."&biddt=".$BidderID;
//	header("Location: ".$url);
	exit();
//	echo "Based on the <b>".$leadidentifier."</b> it will get redirected to the specific process edit page with RequestID = ".$RequestID.", AgentID = ".$BidderID.", ProductID = ".$ProductID." ";	
}
?>