<?php

require 'scripts/db_init.php';

/*
 * Param 1 : source
 * param 2 : Leadidentifier
 * param 3 : LeadAllocationLogicID 
 */
smsBFLPL('sms_pl_bfl', 'sms_bflcalling_pl', 196);

//BFL SMS Leads Start
function smsBFLPL($Source, $leadidentifier, $leadAllocationLogic) {
    $lead_allocation_logic = 76;
    $currentdate = Date('Y-m-d');
    $min_date = $currentdate . " 00:00:00";
    $max_date = $currentdate . " 23:59:59";

    $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $leadAllocationLogic . "')";
    echo $startprocess . "<br><br>";
    $startprocessresult = ExecQuery($startprocess);
    $recordcount = mysql_num_rows($startprocessresult);
    $row = mysql_fetch_array($startprocessresult);
    echo $total_lead_count = $row["total_lead_count"];
    echo "<br>";

    $arrCallerrID = '';
    $allcounterVal = 1;
    $allarrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $leadidentifier . "' and Status=1) order by BidderID ASC");
    while ($allrowcal = mysql_fetch_array($allarrcallerqry)) {
        $arrCallerrID[$allcounterVal] = $allrowcal["BidderID"];
        $allcounterVal = $allcounterVal + 1;
    }
    echo "All Agents - ";
    echo $allarrCallerrIDStr = implode("','", $arrCallerrID); // Get All Agents
    echo "<br>";

    echo "<br>";
    if ($total_lead_count > 0) {
        $smsplqry = "select RequestID,Updated_Date from  Req_Loan_Personal Where ((source ='" . $Source . "') and RequestID>'" . $total_lead_count . "' and Updated_Date  between '" . $min_date . "' and '" . $max_date . "')";
    }
    echo $smsplqry . "<br>";

//	die();
    $smsplqryresult = ExecQuery($smsplqry);
    $recordcount1 = mysql_num_rows($smsplqryresult);
    $bidderID = "";

    while ($row2 = mysql_fetch_array($smsplqryresult)) {
        echo "hello";
        $AllRequestID = $row2["RequestID"];
        $Allocation_Date = $row2["Updated_Date"];
        $DOE = $row2["Updated_Date"];

        if ($AllRequestID > 0) {
            $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $leadAllocationLogic . "')");
           
            $seqid = mysql_fetch_array($sequenceid);
            $last_allocated_to = $seqid["last_allocated_to"];
            $total_no_agents = $seqid["total_no_agents"];

            if ($total_no_agents > $last_allocated_to) {
                $sequence = $last_allocated_to + 1;
            } else {
                $sequence = 1;
            }

            $getCheckSQl = "select * from lead_allocate where AllRequestID = '" . $AllRequestID . "' and BidderID in ('" . $allarrCallerrIDStr . "')";
            echo "<br>";
            echo $getCheckSQl;
            echo "<br>";
            $getCheckQuery = ExecQuery($getCheckSQl);
            $getCheckNum = mysql_num_rows($getCheckQuery);
            if ($getCheckNum > 0) {
                //Already Existing Lead
                echo "In if condition";
            } else {
                echo "else ";
                echo $callerID = $arrCallerrID[$sequence];
                if ($AllRequestID > 0 && $callerID > 1) {
                    //insert allocation
                    echo "<br><br>";
                    echo $inserticiciqry = "INSERT INTO `lead_allocate` (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('" . $AllRequestID . "', '" . $callerID . "', '1', '0', '" . $Allocation_Date . "');";
                    $inserticiciqryresult = ExecQuery($inserticiciqry);
                    echo "<br><br>";
                    echo $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $AllRequestID . "' Where (Citywise='" . $leadidentifier . "' and lead_allocation_logic='" . $leadAllocationLogic . "')";
                    $updateqryresult = ExecQuery($updateqry);
                    echo "<br><br>";
                }
            }
            $getCheckNum = '';
        }
    }
}

//Bajaj Finserv SMS Leads End
?>

