<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$RequestID = $_REQUEST['RequestID'];
$AgentID = $_REQUEST['AgentID'];
$BidderID = $_REQUEST['BidderID'];

	$getMailerCountSQl = "select RequestID from wishfin_mailer_send where RequestID= '".$RequestID."' and AgentID='".$AgentID."' and BidderID='".$BidderID."'";
	$getMailerCountQuery = ExecQuery($getMailerCountSQl);
	$getMailerCountNumRows = mysql_num_rows($getMailerCountQuery);

if($getMailerCountNumRows>2)
{ } else {
	$insertExpertMailerSql = "INSERT INTO wishfin_mailer_send (RequestID, BidderID, AgentID, Dated) VALUES ('".$RequestID."', '".$BidderID."', '".$AgentID."', Now())";
	ExecQuery($insertExpertMailerSql);
}
echo "Mail will be send";
?>