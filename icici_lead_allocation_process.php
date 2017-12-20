<?php

require 'scripts/db_init.php';

//Start ICCS ICICI Calling Process Delhi
function icicibankpl6374() {
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='CallerAccountICICI' and BidderID=6374)";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6374)");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    echo $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6363 and Status=1) order by BidderID ASC");
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
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CallerAccountICICI' and BidderID=6374)");
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
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='CallerAccountICICI' and BidderID=6374)";
                    echo "<br><br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//End ICCS ICICI Calling Process
//Start ICCS ICICI Calling Process Bangalore
function icicibankpl6450() {
    
    $source = 'CallerAccountICICIBangalore';
    $lead_allocation_logic = 56;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (BidderID=6450)");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    echo $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
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
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."'  and lead_allocation_logic='".$lead_allocation_logic."')");
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
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
                    echo "<br><br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//End ICCS ICICI Calling Process Bangalore
//Start ICCS ICICI Calling Process Hyderabad

function icicibankpl6457() {
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='CallerAccountICICIHyderabad' and BidderID=6457)";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (BidderID=6457)");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    echo $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6358 and Status=1) order by BidderID ASC");
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
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CallerAccountICICIHyderabad' and BidderID=6457)");
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
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='CallerAccountICICIHyderabad' and BidderID=6457)";
                    echo "<br><br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//End ICCS ICICI Calling Process Hyderabad
//Start ICCS ICICI Calling Process Small Cities
function icicibankpl6458() {
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='CallerAccountOICICI' and BidderID=6458)";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (BidderID=6458)");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    //$citibankplqry="Select * From Req_Feedback_Bidder_PL Where Feedback_ID in (840635,840637,840641)";

    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    echo $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6458 and Status=1) order by BidderID ASC");
    while ($rowcal = mysql_fetch_array($arrcallerqry)) {
        $arrCallerrID[$counterVal] = $rowcal["BidderID"];
        $counterVal = $counterVal + 1;
    }
    echo "<br>";
    print_r($arrCallerrID);
    //exit();
    while ($row2 = mysql_fetch_array($citiplqryresult)) {
        $Feedback_ID = $row2["Feedback_ID"];
        echo $AllRequestID = $row2["AllRequestID"];
        $BidderID = $row2["BidderID"];
        $Allocation_Date = $row2["Updated_Date"];

        if ($AllRequestID > 0) {
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CallerAccountOICICI' and BidderID=6458)");
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
                    echo "<br>" . $final_allocationciti . "<br>";
                    $final_allocationcitiresult = ExecQuery($final_allocationciti);
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='CallerAccountOICICI' and BidderID=6458)";
                    echo "<br><br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//End ICCS ICICI Calling Process Small Cities
//Start ICCS ICICI Bank Calling Process Mumbai
function icicibankplMumbai() {
    $source = 'CallerAccountMICICI';
    $lead_allocation_logic = 66;
    $Global_Access_ID = 6482;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

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

//End ICCS ICICI Bank Calling Process Mumbai
//Start ICCS ICICI Bank Calling Process Chennai
function icicibankplChennai() {
    $source = 'CallerAccountCICICI';
    $lead_allocation_logic = 67;
    $Global_Access_ID = 6483;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

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

//End ICCS ICICI Bank Calling Process Chennai
//Start ICCS ICICI Bank Calling Process Pune
function icicibankplPune() {
    $source = 'CallerAccountPICICI';
    $lead_allocation_logic = 70;
    $Global_Access_ID = 6514;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

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

//End ICCS ICICI Bank Calling Process Pune
// Start ICICI PL allocation Bang/Chennai/Delhi/Hyderabad/Kolkata/Mumbai/Pune
function icicibankplBCDHKMP() {
    $source = 'PL_ICICI_BCDHKMP';
    $lead_allocation_logic = 123;
    $Global_Access_ID = 7049;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

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

//End // ICICI PL allocation Bangalore/Chennai/Delhi/Hyderabad/Kolkata/Mumbai/Pune
//Start ICICI PL Salary Account
function ICICIplSalAccount() {
    $source = 'ICICISALAccount';
    $lead_allocation_logic = 128;
    $Global_Access_ID = 7078;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $Global_Access_ID . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $Global_Access_ID . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

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

//End ICICI PL Salary Account
//Start PL Tata Capital Delhi
function tatabankplDelhi() {
    $source = 'tatacapitalcalling';
    $lead_allocation_logic = 126;
    $Global_Access_ID = 6410;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

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

//End PL Tata Capital Delhi
//Start ICCS Tata Capital Calling Process Mumbai
function tatabankplMumbai() {
    $source = 'CallerAccountMTata';
    $lead_allocation_logic = 64;
    $Global_Access_ID = 6484;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

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

//End ICCS Tata Capital Calling Process Mumbai
//Start ICCS Tata Capital Calling Process Chennai
function tatabankplChennai() {
    $source = 'CallerAccountCTata';
    $lead_allocation_logic = 65;
    $Global_Access_ID = 6485;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

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

//End ICCS Tata Capital Calling Process Chennai
//Start ICCS Tata Capital Calling Process Ahmedabad/Pune/Kolkata
function tatabankplAPK() {
    $source = 'CallerAccountAPKTata';
    $lead_allocation_logic = 135;
    $Global_Access_ID = 6977;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID='" . $Global_Access_ID . "')");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

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

//End ICCS Tata Capital Calling Process  Ahmedabad/Pune/Kolkata
//Start ICCS Tata Capital Calling Process
function tatabankpl6412() {
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='CallerAccountTata' and BidderID=6412)";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6410)");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6412 and Status=1) order by BidderID ASC");
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
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CallerAccountTata' and BidderID=6412)");
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
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='CallerAccountTata' and BidderID=6412)";
                    echo "<br>" . $final_allocationciti . "<br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//End ICCS Tata Capital Calling Process
//Start ICCS Tata Capital Calling Process Bangalore

function tatabankplBangalore() {
    
    $source = 'CallerAccountBTata';
    $lead_allocation_logic = 61;
    $Global_Access_ID = 6465;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where Global_Access_ID LIKE '%".$Global_Access_ID."%'");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
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
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic=61)");
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
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='CallerAccountBTata' and lead_allocation_logic=61)";
                    echo "<br>" . $final_allocationciti . "<br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//End ICCS Tata Capital Calling Process Bangalore
//Start Tata Capital Calling Process Bangalore
function tataCapBangaloreCall() {
    $Source = "tatacapitalBcalling";
    $lead_allocation_logic = "154";
    $Global_Access_ID = 6463;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $Source . "' and lead_allocation_logic=$lead_allocation_logic)";
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
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $Source . "' and Status=1) order by BidderID ASC");
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
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $Source . "' and lead_allocation_logic=$lead_allocation_logic)");
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
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='" . $Source . "' and lead_allocation_logic=$lead_allocation_logic)";
                    echo "<br>" . $final_allocationciti . "<br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//End Tata Capital Calling Process Bangalore
//Start ICCS Tata Capital Calling Process Hyderabad
function tatabankplHyderabad() {
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='CallerAccountHTata' and lead_allocation_logic=62)";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];

    $arrbidderqry = ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6464)");
    while ($rowbid = mysql_fetch_array($arrbidderqry)) {
        $arrBidderID[] = $rowbid["BidderID"];
    }
    echo $trbidder = implode("','", $arrBidderID);

    if ($total_lead_count > 0) {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Feedback_ID>'" . $total_lead_count . "' and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    } else {
        $citibankplqry = "Select * From Req_Feedback_Bidder_PL Where (BidderID in ('" . $trbidder . "') and Reply_Type=1 and Allocation_Date between '" . $min_date . "' and '" . $max_date . "') order by Feedback_ID ASC";
    }
    echo $citibankplqry . "<br>";
    $citiplqryresult = ExecQuery($citibankplqry);
    $recordcount1 = mysql_num_rows($citiplqryresult);
    $bidderID = "";

    $counterVal = 1;
    $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='CallerAccountHTata' and Status=1) order by BidderID ASC");
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
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='CallerAccountHTata' and lead_allocation_logic=62)");
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
                    $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='CallerAccountHTata' and lead_allocation_logic=62)";
                    echo "<br>" . $final_allocationciti . "<br>";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}
//End ICCS Tata Capital Calling Process Hyderabad


main();

function main() {

    icicibankpl6374(); //Delhi
    icicibankpl6450(); //Bangalore
    icicibankpl6457();
    icicibankpl6458();
    icicibankplChennai();
    icicibankplMumbai();
    //icicibankplPune();
    icicibankplBCDHKMP(); // Yaswant 140717 //Bang/Chen/Del/Hyd/Kol/Mum/Pune
    ICICIplSalAccount(); //Yaswant 240717 - ICICI PL Sal Account
    tatabankplDelhi(); //Yaswant 180717 - Tata Delhi
    tatabankplMumbai();
    tatabankplChennai(); //Pune / Kolkata/ Ahmedabad - 6485,6977
    tatabankplAPK(); //Ahmedabad/Pune/Kolkata
    //tatabankpl6412(); merged to 6484 // 06/03/17
    //tatabankplBangalore(); 
    tataCapBangaloreCall();
    //tatabankplHyderabad();
}

?>