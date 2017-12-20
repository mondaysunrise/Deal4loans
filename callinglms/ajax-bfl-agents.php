<?

require_once("includes/application-top-inner.php");

if ($_SESSION['BidderID'] == 7074) { // Admin
    $leadidentifier = 'smsplbajajfinserv';
}
if ($_SESSION['BidderID'] == 7660) { //Admin
    $leadidentifier = 'sms_bflcalling_pl';
}
$updateSql = "update Bidders set Status=0 where leadidentifier='".$leadidentifier."'";
$resultUpdate = $obj->fun_db_query($updateSql);
$GetAgentID = $_REQUEST['GetAgentID'];
if ($GetAgentID != "") {
    $arrAgent = explode(',', $GetAgentID);
}
if ($arrAgent >= 1) {
    $arrayCount = count($arrAgent);
} else {
    $arrayCount = "0";
}
$updateQry = "UPDATE `Bidders` SET `Status` = '1' WHERE `BidderID` in (" . $GetAgentID . ")";
$obj->fun_db_query($updateQry);
$updateCntSql = "update lead_allocation_table set total_no_agents='" . $arrayCount . "' where Citywise='".$leadidentifier."'";
$resultUpdate = $obj->fun_db_query($updateCntSql);
echo $arrayCount;
?>