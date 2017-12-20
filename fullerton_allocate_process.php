<?php
require 'scripts/db_init.php';


function FullertonPlProcess() {
    $source = 'AccountFullertonProcess';
    $lead_allocation_logic = 75;
    $Global_Access_ID = 6680;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID like '%".$Global_Access_ID."%')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
        
        
    }
  //  $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where Feedback_ID=1038089";
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";
//exit();
    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $source . "' and Status=1) order by BidderID ASC");
    while ($rowcal = mysql_fetch_array($arrcallerqry)) {
        $arrCallerrID[$counterVal] = $rowcal["BidderID"];
        $counterVal = $counterVal + 1;
    }

    while ($row2 = mysql_fetch_array($citiplqryresult)) {
        $Feedback_ID = $row2["Feedback_ID"];
        echo $AllRequestID = $row2["AllRequestID"];
        $BidderID = $row2["BidderID"];
        $Allocation_Date = $row2["Updated_Date"];

        if ($AllRequestID > 0) {
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')");
            $seqid = mysql_fetch_array($sequenceid);
            $last_allocated_to = $seqid["last_allocated_to"];
            $total_no_agents = $seqid["total_no_agents"];

            if ($total_no_agents > $last_allocated_to) {
                $sequence = $last_allocated_to + 1;
            } else {
                $sequence = 1;
            }

            $getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '" . $Feedback_ID . "' and BidderID=" . $BidderID . ")";

            $getCheckQuery = ExecQuery($getCheckSQl);
            $getCheckNum = mysql_num_rows($getCheckQuery);
            if ($getCheckNum > 0) {
                //Already Existing Lead
            } else {
                $callerID = $arrCallerrID[$sequence];
                if ($AllRequestID > 0 && $callerID > 1) {
                    //insert allocation
                    $final_allocationciti = "INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('" . $Feedback_ID . "','" . $AllRequestID . "','" . $callerID . "','1', Now())";
                    $final_allocationcitiresult = ExecQuery($final_allocationciti);
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
                    echo "<br>" . $final_allocationciti . "<br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//End Fullerton Process

main();

function main() {
    FullertonPlProcess();
}

?>