<?
require_once("includes/application-top.php");
$AgentIDs = $_REQUEST['GetAgentID'];
$qryCheck1 = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier ='smsplbajajfinserv' and leadidentifier!='' AND Global_Access_ID LIKE '%$AgentIDs%'";
$recordcount = $objAdmin->fun_get_num_rows($qryCheck1);
$qryCheckResult1 = $obj->fun_db_query($qryCheck1);
$status_text = '';
?>
<select name="Agents" id="Agents" >
    <option value="All" <? if ($Agents == "All") {
    echo "selected";
} ?>>All</option>
    <?php
    while ($row1 = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
        $Status = $row1->Status;
        if ($Status == 1) {
            $status_text = "Enabled";
        } else {
            $status_text = "Disabled";
        }
        ?><option value="<?php echo $row1->BidderID; ?>" <?
        if ($Agents == $row1->BidderID) {
            echo "selected";
        }
        ?>><?php echo $row1->BidderID; ?> [<?php echo $row1->Bidder_Name; ?>] (<?php echo $status_text; ?>) </option><?php
}
    ?></select>