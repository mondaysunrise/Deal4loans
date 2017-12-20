<?php
ob_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
print_r($_GET);
$RequestID = $_REQUEST['LeadID'];
$BidderID = $_REQUEST['agentid'];
$ListID = $_REQUEST['ListID'];//Not in use
$leadidentifier = $_REQUEST['leadidentifier'];
//$leadidentifier = 'smsplleads';
//Based on the lead identifier it will get redirected to the specific process edit page

//http://www.deal4loans.com/dialer_edit_lead.php?LeadID=1827947&ListID=1500&leadidentifier=smsplleads&agentid=5960

//http://www.deal4loans.com/dialer_edit_lead.php?LeadID=1827947&ListID=1500&leadidentifier=smsplleads&agentid=8001


$dated = ExactServerdate();

//	$getIDSql = "select RequestID from Req_Dialer_Records_PL where ID='".$RequestID."'";
	//echo $getIDSql."<br>";
	//$getIDQuery = ExecQuery($getIDSql);
//	$RequestID = mysql_result($getIDQuery,0,'RequestID');
//	echo $RequestID."<br>";


echo $getBiddersSql = "select BidderID from Bidders where leadidentifier='".$leadidentifier."' and BidderID='".$BidderID."'";
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
echo	 $updateqry= "Update lead_allocate set BidderID='".$BidderID."' Where AllRequestID = '".$RequestID."'";
	 $updateqryresult = ExecQuery($updateqry);
	$url = "http://www.deal4loans.com/sbiccleadlms-details.php?postid=".$RequestID."&biddt=".$BidderID;
//	header("Location: ".$url);
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