<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);

function ccMasking($number, $maskingCharacter = 'X') {
    return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

if (!empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;
//print_r($_SESSION);
//echo "<br>".$_SESSION["BidderID"];
$BidderIDstatic = "";
if (isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic']) > 0) {
    $BidderIDstatic = $_REQUEST['BidderIDstatic'];
}
if (isset($BidderIDstatic) && strlen($_REQUEST['BidderIDstatic']) > 0) {
    $_SESSION["BidderID"] = $BidderIDstatic;
}
$salaryclause = "";
if (isset($_REQUEST['salaryrange'])) {
    $salaryclause = $_REQUEST['salaryrange'];
}
$FeedbackClause = "";
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$min_date = "";
if (isset($_REQUEST['min_date'])) {
    $min_date = $_REQUEST['min_date'];
}
$max_date = "";
if (isset($_REQUEST['max_date'])) {
    $max_date = $_REQUEST['max_date'];
}
$varCmbFeedback = "";
if (isset($_REQUEST['cmbfeedback'])) {
    $varCmbFeedback = $_REQUEST['cmbfeedback'];
}

$RequestID = "";
if (isset($_REQUEST['RequestID'])) {
    $RequestID = $_REQUEST['RequestID'];
}
$type = "";
if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
}
$Feedback = "";
if (isset($_REQUEST['Feedback'])) {
    $Feedback = $_REQUEST['Feedback'];
}

$Campaign = "";
if (isset($_REQUEST['Campaign'])) {
    $Campaign = $_REQUEST['Campaign'];
}
$Agents = '';
if (isset($_REQUEST['Agents'])) {
    $Agents = $_REQUEST['Agents'];
}

$productVal = 1;
if (isset($_REQUEST['productVal']) && strlen($_REQUEST['productVal']) > 0) {
    $productVal = $_REQUEST['productVal'];
} else {
    $productVal = $_SESSION['product'];
}
$val = getReqValue1($productVal);
$pro_code = $productVal;

function getReqValue1($pKey) {
    $titles = array(
        '1' => 'Req_Loan_Personal'
    );
    foreach ($titles as $key => $value)
        if ($pKey == $key)
            return $value;
    return "";
}

$inhouseCut_Call = '';
if ($_SESSION['BidderID'] == 6798) {
    $inhouseCut_Call = 1;
}
?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title>Personal Loan LMS List</title>
        <script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
        <link href="../includes/style1.css" rel="stylesheet" type="text/css">
        <link href="../style.css" rel="stylesheet" type="text/css" />
        <script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
        <style>
            /* Pagination*/

            div.pagination {
                padding: 3px;
                margin: 3px;
            }
            div.pagination a {
                padding: 2px 5px 2px 5px;
                margin: 2px;
                border: 1px solid #AAAADD;
                text-decoration: none; /* no underline */
                color: #000099;
            }
            div.pagination a:hover, div.pagination a:active {
                border: 1px solid #000099;
                color: #000;
            }
            div.pagination span.current {
                padding: 2px 5px 2px 5px;
                margin: 2px;
                border: 1px solid #000099;
                font-weight: bold;
                background-color: #2b62b5;
                color: #FFF;
            }
            div.pagination span.disabled {
                padding: 2px 5px 2px 5px;
                margin: 2px;
                border: 1px solid #CCC;
                color: #CCC;
            }
        </style>
        <!--DatePicker Start-->
        <link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
        <script src="js-datepicker/jquery-1.5.1.js"></script>
        <script src="js-datepicker/jquery.ui.core.js"></script>
        <script src="js-datepicker/jquery.ui.datepicker.js"></script>
        <script type="text/javascript">
            $(function () {
                var dates = $("#min_date, #max_date").datepicker({
                    defaultDate: "-1d",
                    changeMonth: true,
                    changeYear: true,
                    numberOfMonths: 1,
                    onSelect: function (selectedDate) {
                        var option = this.id == "min_date" ? "minDate" : "maxDate",
                                instance = $(this).data("datepicker"),
                                date = $.datepicker.parseDate(
                                        instance.settings.dateFormat ||
                                        $.datepicker._defaults.dateFormat,
                                        selectedDate, instance.settings);
                        dates.not(this).datepicker("option", option, date);
                    }
                });
            });
        </script>
        <!--DatePicker End-->
        <script type="text/javascript">

            function getAgentsinCampaign(leadidentifier)
            {
                $.ajax({type: 'post', url: '/getAgentsinCampaign.php', data: {leadidentifier: leadidentifier, },
                    success: function (response) {
                        //alert(response);
                        $('#Agents').html(response);
                        if (response == "OK") {
                            return true;
                        } else {
                            return false;
                        }
                    }
                });

            }
            var ajaxRequest;  // The variable that makes Ajax possible!
            function ajaxFunction() {

                try {
                    // Opera 8.0+, Firefox, Safari
                    ajaxRequest = new XMLHttpRequest();
                } catch (e) {
                    // Internet Explorer Browsers
                    try {
                        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                            // Something went wrong
                            alert("Your browser broke!");
                            return false;
                        }
                    }
                }
            }

            function getNumValue(iLoc, id, parameterVal)
            {
                //alert(parameterVal);
                var allLoc = [];
                if (parameterVal > 0)
                {
                    for (var iTrav = 1; iTrav <= parameterVal; iTrav++) {
                        allLoc.push(iTrav);
                    }
                } else
                {
                    for (var iTrav = 1; iTrav <= <?php echo $limit; ?>; iTrav++) {
                        allLoc.push(iTrav);
                    }
                }
                var iRemove = allLoc.indexOf(iLoc);
                if (iRemove != -1) {
                    allLoc.splice(iRemove, 1);
                }

                //	alert(allLoc);

                var queryString = "?get_requestid=" + id;
                ajaxRequest.open("GET", "/getPLContactNum.php" + queryString, true);
                ajaxRequest.onreadystatechange = function () {
                    if (ajaxRequest.readyState == 4)
                    {
                        document.getElementById('clik4Num_' + iLoc).innerHTML = "<b style='font-size:12px;'>" + ajaxRequest.responseText + "</b>";
                        for (var iTraverse = allLoc.length; iTraverse--; )
                        {
                            document.getElementById('clik4Num_' + allLoc[iTraverse]).innerHTML = 'XXXXXXXXXX';
                        }
                    }
                }
                ajaxRequest.send(null);
            }
            window.onload = ajaxFunction;

        </script>

    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">

<?php include "header_pl_admin_lms.php"; ?>
        <div> 
            <table width="98%" border="0">
                  <!---<tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID']; ?>&product=4" target="_blank">
                          today's Report</a></td></tr>-->
                <tr>
                    <td align="right"></td>
                </tr>
                <tr>
                    <td align="center" width="100%"><div align="center">
                            <form name="frmsearch" action="pl_lms_admin_list.php" method="get" onSubmit="return chkform();"><table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">

                                    <input type="hidden" name="productVal" id="productVal" value="1">
                                    <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"]; ?>">
                                    <input type="hidden" name="search" id="search" value="y">
                                    <tr>
                                        <td colspan="4" class="head1">Search</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="12%"><strong>Date:</strong></td>
                                        <td width="29%">From
                                            <input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" ></td>
                                        <td width="13%" style="text-align:right;">To</td>
                                        <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td width="12%"><strong>Feedback:</strong></td>
                                        <td width="29%"><select name="cmbfeedback" id="cmbfeedback" class="input-lead">
                                                <option value="All" <? if ($varCmbFeedback == "All") {
            echo "selected";
        } ?>>All</option>
                                                <option value="" <? if ($varCmbFeedback == "") {
            echo "selected";
        } ?>>No Feedback</option>
                                                <option value="Ringing" <? if ($varCmbFeedback == "Ringing") {
            echo "selected";
        } ?>>Ringing</option>
                                                <option value="Appointment" <? if ($varCmbFeedback == "Appointment") {
            echo "selected";
        } ?>>Appointment</option>
                                                <option value="Followup" <? if ($varCmbFeedback == "Followup") {
            echo "selected";
        } ?>>Follow up</option>
                                                <option value="Not Eligible - FOIR" <? if ($varCmbFeedback == "Not Eligible - FOIR") {
            echo "selected";
        } ?>>Not Eligible - FOIR</option>
                                                <option value="Not Eligible - Salary" <? if ($varCmbFeedback == "Not Eligible - Salary") {
            echo "selected";
        } ?>>Not Eligible - Salary</option>
                                                <option value="Not Eligible - Others" <? if ($varCmbFeedback == "Not Eligible - Others") {
            echo "selected";
        } ?>>Not Eligible - Others</option>
                                                <option value="Not Interested - Direct" <? if ($varCmbFeedback == "Not Interested - Direct") {
            echo "selected";
        } ?>>Not Interested - Direct</option>
                                                <option value="Not Interested - Offer" <? if ($varCmbFeedback == "Not Interested - Offer") {
                                                    echo "selected";
                                                } ?>>Not Interested - Offer (ROI/PF etc)</option>
                                                <option value="Not Interested - Loan Amount" <? if ($varCmbFeedback == "Not Interested - Loan Amount") {
                                                    echo "selected";
                                                } ?>>Not Interested - Loan Amount</option>
                                                <option value="Not Contactable" <? if ($varCmbFeedback == "Not Contactable") {
                                                    echo "selected";
                                                } ?>>Not Contactable</option>
                                                <?php
                                                if ($Campaign == "CallerAccountBTata" || $Campaign == "CallerAccountMTata") {
                                                    ?>
                                                    <option value="CIBIL ok - Follow Up" <? if ($varCmbFeedback == "CIBIL ok - Follow Up") {
                                                    echo "selected";
                                                } ?>>CIBIL ok - Follow Up</option>
                                                    <option value="CIBIL Ok - Not Interested" <? if ($varCmbFeedback == "CIBIL Ok - Not Interested") {
                                                    echo "selected";
                                                } ?>>CIBIL Ok - Not Interested</option>
                                                    <option value="NE - CIBIL" <? if ($varCmbFeedback == "NE - CIBIL") {
                                                    echo "selected";
                                                } ?>>NE - CIBIL</option>
                                                    <option value="NE - Other" <? if ($varCmbFeedback == "NE - Other") {
                                                    echo "selected";
                                                } ?>>NE - Other</option>
                                                    <option value="CIBIL Refer - Follow Up" <? if ($varCmbFeedback == "CIBIL Refer - Follow Up") {
                                                    echo "selected";
                                                } ?>>CIBIL Refer - Follow Up</option>
                                                    <option value="CIBIL Refer - Not Interested" <? if ($varCmbFeedback == "CIBIL Refer - Not Interested") {
                                                    echo "selected";
                                                } ?>>CIBIL Refer - Not Interested</option>
                                                                <?php
                                                            } else if ($Campaign == "CallerAccountICICI" || $Campaign == "CallerAccountOICICI" || $Campaign == "CallerAccountMICICI" || $Campaign == "CallerAccountCICICI") {
                                                                ?>
                                                    <option value="TU Approved" <? if ($varCmbFeedback == "TU Approved") {
                                                                echo "selected";
                                                            } ?>>TU Approved</option>

                                                    <option value="TU Approved Followup" <? if ($varCmbFeedback == "TU Approved Followup") {
                                                                echo "selected";
                                                            } ?>>TU Approved Followup</option>
                                                    <option value="TU Approved Not Interested" <? if ($varCmbFeedback == "TU Approved Not Interested") {
                                                                echo "selected";
                                                            } ?>>TU Approved Not Interested</option>
                                                    <option value="TU Referred" <? if ($varCmbFeedback == "TU Referred") {
                                                                echo "selected";
                                                            } ?>>TU Referred</option>
                                                    <option value="TU Referred Followup" <? if ($varCmbFeedback == "TU Referred Followup") {
                                                                echo "selected";
                                                            } ?>>TU Referred Followup</option>
                                                    <option value="TU Referred Not Interested" <? if ($varCmbFeedback == "TU Referred Not Interested") {
                                                                echo "selected";
                                                            } ?>>TU Referred Not Interested</option> 
                                                    <option value="TU Declined" <? if ($varCmbFeedback == "TU Declined") {
                                                                echo "selected";
                                                            } ?>>TU Declined</option>
<?php } ?>
                                            </select></td>
                                    </tr>
                                    <tr> <td colspan="4">
                                            <table width="100%">
                                                <tr>
                                                    <td><strong>Campaigns</strong></td>
                                                    <td>
                                                        <select name="Campaign" id="Campaign" onchange="getAgentsinCampaign(this.value)">
                                                            <option value="" <? if ($Campaign == "") {
    echo "selected";
} ?>>Please Select</option>
                            <?php
                           $qryCheck = "SELECT BidderID, Associated_Bank, leadidentifier,Process_Name FROM Bidders where leadidentifier in ('CallerAccountBTata','CallerAccountCFL','CallerAccountICICI','CallerAccountIIFL','CallerAccountMICICI','CallerAccountMTata','CallerAccountOICICI','CallerAccountCICICI','CallerAccountRBLDMP','CallerAccountRBLBHC','CallerAccountRBLDH','CallerAccountINDUSINDBCH','CallerAccountINDUSINDDMP','CallerAccountDialingDMP','CallerAccountDialingBCH','CallerAccountQBERABCD','CallerAccountCTata','CallingIncredDM','PL_ICICI_BCDHKMP','tatacapitalcalling','ICICISALAccount','CallerAccountQBERAMETRO','CallerAccountCFLAllCity','CallerAccountINDUSINDALL','CallerAccountRBLMCK','CallerAccountICICIBangalore','tatacapitalBcalling','CallerAccountAPKTata') group by leadidentifier ORDER BY Associated_Bank ASC"; //'CallerAccountCity',  
                            $resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
                            $qryCheckResult = $obj->fun_db_query($qryCheck);
                            while ($row = $obj->fun_db_fetch_rs_object($qryCheckResult)) {
                                ?>
                                                                <option value="<?php echo $row->leadidentifier; ?>" <? if ($Campaign == $row->leadidentifier) {
                                echo "selected";
                            } ?>><?php echo $row->Process_Name; ?></option>
                                <?php
                            }
                            ?></select></td>
                                                    <td width="25%" style="text-align: right;"><strong>Agents</strong></td>
                                                    <td width="25%">
                                                        <span id="name_agents">
                            <?php
                            $qryCheck1 = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('" . $Campaign . "') and leadidentifier!=''";
                            $recordcount = $objAdmin->fun_get_num_rows($qryCheck1);
                            $qryCheckResult1 = $obj->fun_db_query($qryCheck1);
                            $status_text = '';
                            ?>
                                                            <select name="Agents" id="Agents" ><?php if ($recordcount > 0) { ?><option value="All" <? if ($Agents == "All") {
                                echo "selected";
                            } ?>>All</option><?php while ($row1 = $obj->fun_db_fetch_rs_object($qryCheckResult1)) {
                                $Status = $row1->Status;
                                if ($Status == 1) {
                                    $status_text = "Enabled";
                                } else {
                                    $status_text = "Disabled";
                                } ?><option value="<?php echo $row1->BidderID; ?>" <? if ($Agents == $row1->BidderID) {
                                echo "selected";
                            } ?>><?php echo $row1->BidderID; ?> [<?php echo $row1->Bidder_Name; ?>] (<?php echo $status_text; ?>) </option><?php }
                    } else {
                        echo '<option value="">Please Select</option>';
                    } ?></select>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table></td> </tr>

                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" /></td>
                                    </tr>

                                </table></form>
                            <p>&nbsp;</p>
                                <?
                                if ($search == "y") {
                                    $min_date = $min_date . " 00:00:00";
                                    $max_date = $max_date . " 23:59:59";
                                    if (strlen(trim($varCmbFeedback)) == 0) {
                                        $FeedbackClause = " AND (client_lead_allocate.Feedback IS NULL OR client_lead_allocate.Feedback='' OR client_lead_allocate.Feedback='No Feedback') ";
                                    } else if ($varCmbFeedback == "All") {
                                        $FeedbackClause = " ";
                                    } else {
                                        $FeedbackClause = " AND client_lead_allocate.Feedback='" . $varCmbFeedback . "' ";
                                    }
                                    if ($Primary_Acc == "ICICI Bank") {
                                        $Primary_AccClause = " and " . $val . ".Primary_Acc='" . $Primary_Acc . "' ";
                                    } else {
                                        $Primary_AccClause = "";
                                    }
                                    if ($Agents == "All") {
                                        $qryAgentsID = "SELECT BidderID FROM Bidders where leadidentifier in ('" . $Campaign . "')";
                                        $resCountAgentsID = $objAdmin->fun_get_num_rows($qryAgentsID);
                                        $qryAgentsIDResult = $obj->fun_db_query($qryAgentsID);
                                        $BidderIDstaticArr = '';
                                        while ($rowAgentsID = $obj->fun_db_fetch_rs_object($qryAgentsIDResult)) {
                                            $BidderIDstaticArr[] = $rowAgentsID->BidderID;
                                        }
                                        $BidderIDstatic = implode(',', $BidderIDstaticArr);
                                    } else {
                                        $BidderIDstatic = $Agents;
                                    }
                                    ?>       <p class="bodyarial11">
    <?= $Msg ?>
                                </p>
                                <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
                                <table width="958" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
                                    <?
                                    $srh_qry = "";
                                    if($_REQUEST['Campaign']=='CallerAccountIIFL' || $_REQUEST['Campaign']=='CallerAccountCFL'){
                                    $qry="SELECT * FROM Req_Feedback_Bidder_PL,`Req_Loan_Personal` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in(".$BidderIDstatic.") WHERE Req_Feedback_Bidder_PL.AllRequestID=`Req_Loan_Personal`.RequestID and Req_Feedback_Bidder_PL.BidderID  in(".$BidderIDstatic.") and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback.Followup_Date Between '".($min_date)."' and '".($max_date)."')  ";
                                    if($_REQUEST['cmbfeedback']!="All"){
                                    $qry = $qry." AND Req_Feedback.Feedback IN ('".$_REQUEST['cmbfeedback']."')"; 
                                    }
                                    
                                    
                                    }else{
                                    $qry = "SELECT * FROM client_lead_allocate," . $val . "  WHERE (client_lead_allocate.BidderID in(" . $BidderIDstatic . ") and client_lead_allocate.Reply_Type=" . $pro_code . " and client_lead_allocate.AllRequestID=`" . $val . "`.RequestID and (client_lead_allocate.Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or client_lead_allocate.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "'))";
                                    $qry = $qry . $FeedbackClause . " " . $citywise_clause . " " . $mob_num_clause . " " . $refernce_no_clause . " " . $Primary_AccClause;
                                    }
                                    $qry = $qry . "group by " . $val . ".Mobile_Number";

                                    $srh_qry = $qry;

                                    $resCount = $objAdmin->fun_get_num_rows($qry);
                                    if ($resCount > $limit) {
                                        $pagelinks = paginate($limit, $resCount);
                                    }
                                    $getParameterVal = min($start + $limit, $resCount) % $limit;
                                    $qry.= " order by " . $val . ".Dated DESC LIMIT $start,$limit ";
                                    $result = $obj->fun_db_query($qry);
                                    ?>
                                    <tr>
                                        <td colspan="11"><strong><? echo $start + 1; ?> to <? echo $start + $limit; ?> 
                                                Out of <? echo $resCount; ?> Records </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="head1">Agent ID</td>
                                        <td class="head1">Name</td>
                                    <?
                                    if ($_SESSION['BidderID'] == '6798') {
                                        ?>
                                            <td class="head1">Mobile</td>
    <? } ?>
                                        <td class="head1">Salary</td>
                                        <td class="head1">City</td>
                                        <td class="head1">Emp status</td>
                                        <td class="head1">Feedback</td>                
                                        <td class="head1">FollowUp date</td>               
                                        <td class="head1">Comments</td>  
                                        <td class="head1">DOE</td>  
                                    </tr>
    <?
    if ($resCount > 0) {
        $color = 1;
        while ($row = $obj->fun_db_fetch_rs_object($result)) {
            $BidderID = $row->BidderID;
            $feedbackVal = $row->Feedback;
            $Followup_Date = $row->Followup_Date;
            $exptodayformat = explode(" ", $Followup_Date);
            $explodeTime = explode(":", $exptodayformat[1]);
            $explodeHr = $explodeTime[0] - 1;
            $FinalMinDate = '"' . $exptodayformat[0] . ' ' . $explodeHr . ':' . $explodeTime[1] . ':' . $explodeTime[2] . '"';
            $FinalMaxDate = '"' . $exptodayformat[0] . ' 23:59:59"';
            $TodayFormat = date("Y-m-d");
            $FinalDay = $exptodayformat[0];
            $Employment_Status = $row->Employment_Status;

            if ($color % 2 != 0) {
                $colorvar = "#FFF";
            } else {
                $colorvar = "#EEE";
            }
            ?>
                                            <!--///////////////////////-->
                                            <tr  bgcolor="<?php echo $colorvar; ?>">			 
                                                <td class="bodyarial11"><? echo $BidderID; ?></td>
                                                <td class="bodyarial11"><? echo $row->Name; ?></td>
            <?php
            if ($_SESSION['BidderID'] == '6798') {
                ?>
                                                    <td class="bodyarial11"><?php
                                                        if ($inhouseCut_Call == 1) {
                                                            ?>
                                                            <span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span>


                                                        <?php } else {
                                                            echo ccMasking($row->Mobile_Number);
                                                        } ?></td>
                                                    <?php } ?>
                                                <td class="bodyarial11"> <?php
                                                    if ($inhouseCut_Call == 1) {
                                                        ?>
                                                        <span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></span> <?php } else {
                                        echo $row->Net_Salary;
                                    } ?>
                                                </td>
                                                <td class="bodyarial11"><? echo $row->City; ?></td>
                                                <td class="bodyarial11"><? if ($Employment_Status == 1) {
                                        echo "Salaried";
                                    } else {
                                        echo "Self Employed";
                                    } ?></td>
                                            <?
                                            if ($row->City == "Others") {
                                                $City = $row->City_Other;
                                            } else {
                                                $City = $row->City;
                                            }
                                            ?>              
                                                <td class="bodyarial11">
            <?
            if ($feedbackVal != "") {
                echo $feedbackVal;
            } else {
                echo "No Feedback";
            }
            ?>
                                                </td>
                                                <td class="bodyarial11"><? echo $Followup_Date; ?></td>
                                                <td class="bodyarial11">
                            <?php
                            $sql_Comments = "SELECT * FROM  `client_lead_allocated_comment` where RequestID='" . $row->RequestID . "' and BidderID='" . $BidderIDstatic . "' ORDER BY  `client_lead_allocated_comment`.`id` DESC LIMIT 0 , 1";
                            $query_Comments = $obj->fun_db_query($sql_Comments);
                            $numRows_Comments = $objAdmin->fun_get_num_rows($sql_Comments);
                            if ($numRows_Comments > 0) {
                                $ResComment = $obj->fun_db_fetch_rs_object($query_Comments);
                                $show_Comments = $ResComment->Comments;
                            } else {
                                $show_Comments = $row->Comments;
                            }
                            ?>
                                                    <textarea rows="2" cols="10" readonly="readonly"><? echo $show_Comments; ?></textarea></td>
                                                <td class="bodyarial11"><? echo $row->Updated_Date; ?></td> 
                                            </tr>
            <?
            $color++;
        }
    } else {
        ?>
                                        <tr><td colspan="9" class="bodyarial11" style="color:red; text-align: center;"><strong>No Record Found</strong></td> 
                                        </tr>    
    <?php } ?>

                                </table>
                                <br>
                                <table  border="0" cellpadding="5" cellspacing="1" align="center">
                                    <tr>
                                        <td style="color:#FFF;" align="center" bgcolor="#FFFFFF"><?php echo $pagelinks; ?></td>
                                    </tr>
                                </table>
    <?
}
?>            </div></td>
                </tr>
<? if ($search == "y" && $_SESSION['BidderID']) {
    ?>
    <? /* <tr><td colspan="2" align="center"><form name="frmdownload" action="download_excel_pl_admin.php" method="post"><table width="500" border="0" cellspacing="1" cellpadding="4">

      <tr>
      <td align="center">
      <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
      <input type="hidden" name="qry2" value="Req_Loan_Personal">
      <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
      <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
      <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
      </td>
      </tr>

      </table></form></td></tr> */ ?>
<? } ?>
            </table>
        </div>
    </body>
</html>
