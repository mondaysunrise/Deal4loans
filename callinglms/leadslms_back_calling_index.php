<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;

function cleanSpace($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

//function ccMasking($number, $maskingCharacter = 'X') 
//{
//return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
//}

function ccMasking($number, $maskingCharacter = 'X') {
    return substr($number, 0, 6) . str_repeat($maskingCharacter, strlen($number) - 6);
}

$qryCheck = "SELECT * FROM manual_user_details where BidderID='" . $_SESSION['BidderID'] . "'";
$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
$qryCheckResult = $obj->fun_db_query($qryCheck);
if ($resCountCheck > 0) {

    $rowqryCheck = $obj->fun_db_fetch_rs_object($qryCheckResult);
    $source = $rowqryCheck->source;
//echo "<br>";
    $standard_fields = $rowqryCheck->standard_fields;
} else if ($_SESSION['BidderID'] == 7151 || $_SESSION['BidderID'] == 7158) {
    $standard_fields = "Name,Mobile_Number,Net_Salary,City";
} else {
    echo "Not a Valid User";
    echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/callinglms/leadslogin.php">';
    die();
}

$BidderIDstatic = "";
if (isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic']) > 0) {
    $BidderIDstatic = $_REQUEST['BidderIDstatic'];
}

if (isset($BidderIDstatic) && strlen($_REQUEST['BidderIDstatic']) > 0) {
    $_SESSION["BidderID"] = $BidderIDstatic;
}
if (empty($_REQUEST['BidderIDstatic'])) {
    $BidderIDstatic = $_SESSION["BidderID"];
}

$salaryclause = "";
if (isset($_REQUEST['salaryrange'])) {
    $salaryclause = $_REQUEST['salaryrange'];
}

$val = "Req_Loan_Personal";

$FeedbackClause = "";
//$OrderBy=" order by Req_Loan_Personal.Dated desc";
$mob_num = "";
if (isset($_REQUEST['mob_num'])) {
    $mob_num = $_REQUEST['mob_num'];
}
$refernce_no = "";
if (isset($_REQUEST['refernce_no'])) {
    $refernce_no = $_REQUEST['refernce_no'];
}
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$min_date = "";
if (isset($_REQUEST['min_date'])) {
    $min_date = $_REQUEST['min_date'];
}

$cc_type = "";
if (isset($_REQUEST['cc_type'])) {
    $cc_type = $_REQUEST['cc_type'];
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


$inhouseCut_Call = '';
if ($_SESSION['BidderID'] == 6759) {
    //$inhouseCut_Call = 1; // Displaying Numbers When Live then Uncomment
//	$inhouseCut_Call = 2;
}
//echo $inhouseCut_Call;
?>
<html>
    <head>

        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title>Login</title>
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
        <script>
            $(function () {
                var dates = $("#min_date, #max_date").datepicker({
                    //defaultDate: "+1w",
                    defaultDate: "+0",
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

            function MM_jumpMenu(targ, selObj, restore) { //v3.0
                eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
                if (restore)
                    selObj.selectedIndex = 0;
            }
        </script>
        <!--DatePicker End-->

        <?php
        if ($_SESSION['BidderID'] == 6385 || $_SESSION['BidderID'] == 6456) {
            ?>	 
            <script type="text/javascript">
                function checkCall(RequestID, agent_user)
                {
                    var funcVal = 'call';
                    $.ajax({type: 'post', url: '/external_dialer_c2c_bajaj.php', data: {RequestID: RequestID, agent_user: agent_user, functionC: funcVal},
                        success: function (response) {
                            //alert(response);
                            $('#name_status').html(response);
                            if (response == "OK") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    });

                }

                function disconnectCall(RequestID, agent_user)
                {
                    var checkCallValue;
                    var funcVal = 'disconnect';
                    var dispID = $("#disConnectStatus").val();
                    $.ajax({type: 'post', url: '/external_dialer_c2c_bajaj.php', data: {RequestID: RequestID, agent_user: agent_user, functionC: funcVal, disPos: dispID},
                        success: function (response) {
                            //alert(response);
                            $('#name_status').html(response);
                            if (response == "OK") {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    });
                }
            </script>
            <?php
        } else {
            ?>
           <!-- <script type="text/javascript" src="/js/jquery.js"></script>-->
            <script type="text/javascript">

                function checkCall(RequestID, agent_user)
                {
                    $.ajax({type: 'post', url: '/dialer_click2call.php', data: {RequestID: RequestID, agent_user: agent_user, },
                        success: function (response) {
                            $('#name_status').html(response);
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
                    //alert(iLoc);
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
                    ajaxRequest.open("GET", "/getfullertonNum.php" + queryString, true);
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
        <?php } ?>

    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
        <!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout1.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both; height:15px;"></div>
        <div> 
            <table width="98%" border="0">
                <tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID']; ?>&product=1" target="_blank">today's Report</a></td></tr>
                <tr>
                    <td align="right"></td>
                </tr>
                <tr>
                    <td align="center" width="100%"><div align="center">
                            <form name="frmsearch" action="leadslms_back_calling_index.php" method="get" onSubmit="return chkform();"><table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">

                                    <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<?php echo $_SESSION["BidderID"]; ?>" />
                                    <input type="hidden" name="search" id="search" value="y" />
                                    <tr>
                                        <td colspan="5" class="head1">Search</td>
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
                                        <td align='right'>Search with Reference No</td>
                                        <td><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" class="input-lead" ></td>
                                        <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
                                        <td>  <input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" ></td>

                                    </tr>
                                    <tr>
                                        <td width="12%"><strong>Feedback:</strong></td>
                                        <td width="29%"><select name="cmbfeedback" id="cmbfeedback" class="demoInputBox" onChange="getbankFeedback(this.value);">

                                                <option value="All" selected="">All</option>
                                                <option value="" <?php if($varCmbFeedback=='') { echo "selected";}?>>Fresh lead</option>
                                                <option value="Not Interested"<?php if($varCmbFeedback=='Not Interested') { echo "selected";}?>>Not Interested</option>
                                                <option value="Not Eligible"<?php if($varCmbFeedback=='Not Eligible') { echo "selected";}?>>Not Eligible</option>
                                                <option value="Ringing"<?php if($varCmbFeedback=='Ringing') { echo "selected";}?>>Ringing</option>
                                                <option value="Not Contactable"<?php if($varCmbFeedback=='Not Contactable') { echo "selected";}?>>Not Contactable</option>
                                                 <option value="Appointment"<?php if($varCmbFeedback=='Appointment') { echo "selected";}?>>Appointment</option>
                                                  <option value="Documents Pick"<?php if($varCmbFeedback=='Documents Pick') { echo "selected";}?>>Documents Pick</option>
                                                 <option value="FollowUp"<?php if($varCmbFeedback=='FollowUp') { echo "selected";}?>>FollowUp</option>
                                                
                                                <option value="Login"<?php if($varCmbFeedback=='Login') { echo "selected";}?>>Login</option>
                                                    
                                                <option value="Post Login Rejected"<?php if($varCmbFeedback=='Post Login Rejected') { echo "selected";}?>>Post Login Rejected</option>
                                                 <option value="Callback later"<?php if($varCmbFeedback=='Callback later') { echo "selected";}?>>Callback later</option>
                                                <option value="Approved"<?php if($varCmbFeedback=='Approved') { echo "selected";}?>>Approved</option>
                                                <option value="Disbursed"<?php if($varCmbFeedback=='Disbursed') { echo "selected";}?>>Disbursed</option>
                                            </select></td>
                                            <td></td>  
                                               <td><input name="Submit" type="submit" class="bluebutton" value="Search"></td>  
                                    </tr>
                                   

                                </table>
                            </form>
                            <p>&nbsp;</p>
                            <?
                            $search_date = "";
                            $varmin_date = $min_date;
                            $varmax_date = $max_date;

                            if (strlen(trim($RequestID)) > 0) {
                                $strSQL = "";
                                $Msg = "";
                                //$fbqry = "select FeedbackID from Req_Feedback_PL where AllRequestID=$RequestID and BidderID=" . $_SESSION['BidderID'] . " AND Reply_Type=1";
                                $fbqry = "select FeedbackID from Req_Feedback_PL where AllRequestID=$RequestID and BidderID=" . $_SESSION['BidderID'] . " AND Reply_Type=1";
                                $result = $obj->fun_db_query($fbqry);

                                $num_rows = $obj->fun_db_get_num_rows($result);
                                if ($num_rows > 0) {
                                    $row = $obj->fun_db_fetch_rs_array($result);
                                    $strSQL = "Update Req_Feedback_PL Set Feedback='" . $Feedback . "' ";
                                   $strSQL = $strSQL . "Where FeedbackID=" . $row["FeedbackID"];
                                } else {
                                    $strSQL = "Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date) Values (";
                                    $strSQL = $strSQL . $RequestID . "," . $_SESSION['BidderID'] . ",'1','" . $Feedback . "', '".date("Y-m-d h:i:s")."')";
                                }

//echo $strSQL;
                               $result = $obj->fun_db_query($strSQL);
                                if ($result == 1) {
                                    
                                } else {
                                    $Msg = "** There was a problem in adding your feedback. Please try again.";
                                }
                            }
                            if ($search == "y") {
                                $min_dateonly = $min_date;
                                $max_dateonly = $max_date;

                                $min_date = $min_date . " 00:00:00";
                                $max_date = $max_date . " 23:59:59";
if (empty($refernce_no)) {
                                if (strlen(trim($varCmbFeedback)) == 0) {
                                    $FeedbackClause = "  AND ((Req_Feedback_PL.Feedback='Not Eligible') OR (Req_Feedback_PL.Feedback='OTP Done - Not Ok') OR ((Req_Feedback_PL.Feedback='OTP Done - OK') AND ((Req_Feedback_PL.axis_executive_name='Not Eligible') OR (Req_Feedback_PL.axis_executive_name='Not Interested - Direct') OR (Req_Feedback_PL.axis_executive_name='Not Interested - Offer') OR (Req_Feedback_PL.axis_executive_name='Post Login Reject'))))";
//                                    " AND (Req_Feedback_PL.Feedback IS NULL OR Req_Feedback_PL.Feedback='' OR Req_Feedback_PL.Feedback='No Feedback'))";
                                } else if ($varCmbFeedback == "All") {
                                    $FeedbackClause = "  AND ((Req_Feedback_PL.Feedback='Not Eligible') OR (Req_Feedback_PL.Feedback='OTP Done - Not Ok') OR ((Req_Feedback_PL.Feedback='OTP Done - OK') AND ((Req_Feedback_PL.axis_executive_name='Not Eligible') OR (Req_Feedback_PL.axis_executive_name='Not Interested - Direct') OR (Req_Feedback_PL.axis_executive_name='Not Interested - Offer') OR (Req_Feedback_PL.axis_executive_name='Post Login Reject'))))";
                                } else {
                                    $FeedbackClause = " AND Req_Feedback_PL.Feedback='" . $varCmbFeedback . "'";

                                    if ($_REQUEST['bankFeedback'] != "") {
                                        $FeedbackClause .= " AND Req_Feedback_PL.axis_executive_name='" . $_REQUEST['bankFeedback'] . "'";
                                    }
                                }
}else{
     $FIDArr = explode("S", $refernce_no);
                                        $feedbackID = substr($FIDArr[0], 2);
                                        $refernce_no_clause = " AND Req_Feedback_PL.FeedbackID = '" . $feedbackID . "'";
}

                                $querybackcall = "SELECT BidderID FROM Bidders WHERE Global_Access_ID LIKE '%" . $_SESSION['BidderID'] . "%'";

                                $resultbackcall = $obj->fun_db_query($querybackcall);
                                $backkCallArr = "";
                                while ($rowbackcall = $obj->fun_db_fetch_rs_object($resultbackcall)) {
                                    $backkCallArr[] = $rowbackcall->BidderID;
                                }
                                
                                $BiddIDStr = implode(",", $backkCallArr);
                               if($varCmbFeedback == "All" || strlen(trim($varCmbFeedback)) == 0)
                               {
                                  $BiddIDStrAll = $BiddIDStr.",";
                               }
                                ?>       <p class="bodyarial11">
                                <?= $Msg ?>
                                </p>
                                <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
                                <table width="958" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
                                    <?
                                    $srh_qry = "";
                                    if ($mob_num > 0) {
                                        $mob_num_clause = " AND " . TABLE_REQ_LOAN_PERSONAL . ".Mobile_Number = '" . $mob_num . "' ";
                                    }
                                    
                                    if ($_SESSION['BidderID'] != "") {
                                        $feedback_tble = "lead_allocate";

                                        $qry = "SELECT " . $standard_fields . ", Followup_Date, Employment_Status, RequestID, Feedback, FeedbackID,Req_Feedback_PL.BidderID as BiddID  FROM " . $feedback_tble . "," . TABLE_REQ_LOAN_PERSONAL . " LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=" . TABLE_REQ_LOAN_PERSONAL . ".RequestID AND Req_Feedback_PL.BidderID IN($BiddIDStr,$BidderIDstatic) WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_LOAN_PERSONAL . ".RequestID and Req_Feedback_PL.BidderID IN($BiddIDStrAll$BidderIDstatic) and " . $feedback_tble . ".Reply_Type=1 and ( " . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Feedback_PL.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') ";
                                      
                                        $qry = $qry . $FeedbackClause . " " . $mob_num_clause . " " . $refernce_no_clause;
                                    }
                                    //echo $srh_qry = $qry;

                                    if ($_SESSION['BidderID'] == 6685 || $_SESSION['BidderID'] == 6686) {

//echo $srh_qry;
                                    }
                                    $resCount = $objAdmin->fun_get_num_rows($qry);
                                    if ($resCount > $limit) {
                                        $pagelinks = paginate($limit, $resCount);
                                    }
                                    $getParameterVal = min($start + $limit, $resCount) % $limit;
                                 $qry.= " order by FeedbackID DESC LIMIT $start,$limit ";
                                    $result = $obj->fun_db_query($qry);
//echo $srh_qry;
                                    $explodeFields = explode(',', $standard_fields);
                                    $countTotalFields = count($explodeFields);
                                    ?>
                                    <tr>
                                        <td colspan="11"><strong><? echo $start + 1; ?> to <? echo $start + $limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="head1">Reference No</td>
                                        <?php
                                        for ($eF = 0; $eF < count($explodeFields); $eF++) {
                                            ?>
                                            <td class="head1"><?php echo cleanSpace($explodeFields[$eF]); ?></td>
                                            <?php
                                        }
                                        ?>
                                        <td class="head1">Feedback</td>
                                        <!--<td class="head1">Followup Date</td>-->
                                        <td class="head1">Edit Lead</td>
                                        <td class="head1" style="width:150px;">Call</td>               				
                                    </tr>
                                    <? 
                                    if ($resCount > 0) {
                                        $color = 1;
                                        while ($row = $obj->fun_db_fetch_rs_object($result)) {
                                           //print_r($row);

            $FeedbackBC = "select * from Req_Feedback_PL where AllRequestID=$row->RequestID and BidderID=" . $_SESSION['BidderID'] . " AND Reply_Type=1";
            $resultfdckBC = $obj->fun_db_query($FeedbackBC);
            $rowfdckBC = $obj->fun_db_fetch_rs_array($resultfdckBC);
            //print_r($rowfdckBC);
           $feedbackBC = $rowfdckBC['Feedback'];
           $feedbackBC_ID = $rowfdckBC['FeedbackID'];
                                            
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
                                            <input type="hidden" name="requestid_<? echo $color; ?>" id="requestid_<? echo $color; ?>" value="<? echo $row->RequestID; ?>">
                                            <input type="hidden" name="bidderid" id="bidderid" value="<? echo $BidderIDstatic; ?>">
                                            <td><?
                                                if ($feedbackBC_ID > 0) {
                                                    echo "PL" . $feedbackBC_ID . "S" . $BidderIDstatic;
                                                }
                                                ?></td>
                                            <?php
                                            for ($eS = 0; $eS < $countTotalFields; $eS++) {
                                                ?>
                                                <td class="bodyarial11"><?php
                                                    if ($eS == 1) {
                                                        if ($inhouseCut_Call == 1) {
                                                            echo '<span id="clik4Num_' . $color . '">XXXXXXXXXX</span>';
                                                        } else {
                                                            echo "<b>" . ccMasking($row->$explodeFields[$eS]) . "</b>";
                                                        }
                                                    } else {
                                                        echo $row->$explodeFields[$eS];
                                                    }
                                                    ?> </td>
                                                <?php
                                            }
                                            ?>

                                            <td class="bodyarial11">
                                                <?php
                                                //echo $feedbackBC."dsgsdg".$row->Feedback."<br>";       
                                                echo getJumpMenu("leadslms_back_calling_index.php", $row->RequestID, "1", $feedbackBC, $pageno, $varmin_date, $varmax_date, $varCmbFeedback, $val,$BidderIDstatic);
                                                ?>
                                            </td>
                                           <!--- <td class="bodyarial11"><span id='datepicker_<?php echo $color; ?>'><input type="text" name="Followup_Date_<?php echo $color; ?>" id="Followup_Date_<?php echo $color; ?>" value="<? echo $Followup_Date; ?>"></span><span><a onClick="insertData(<? echo $color; ?>,<? echo $row->BiddID; ?>);" style="cursor:pointer; color:blue;" class="style3">Save</a></span>
                                                <script type="text/javascript">
                                                    $(function () {
                                                        $("#Followup_Date_<?php echo $color; ?>").datepicker();
                                                    });//this enable the call to datepicker when click on input field

                                                    $(function () {
                                                        $("#datepicker_<?php echo $color; ?>").click(function () {
                                                            $('#Followup_Date_<?php echo $color; ?>').datepicker().datepicker("show")
                                                        });
                                                    });
                                                </script>
                                            </td>-->
                                            <td class="bodyarial11"> 
                                                <?php if($_SESSION['BidderID']==7151 || $_SESSION['BidderID']==7158) {?>
                                                <a href="/personalloaneditlead_backcalling.php?id=<? echo urlencode($row->RequestID); ?>&bid=<? echo $_SESSION['BidderID']; ?>" target="_blank">Edit</a>
                                                <?php }else{ ?>
                                                    <a href="/personalloaneditlead.php?id=<? echo urlencode($row->RequestID); ?>&bid=<? echo $_SESSION['BidderID']; ?>" target="_blank">Edit</a>
                                                    <?php
                                                }?>
                                            </td>
                                            <td class="bodyarial11">
                                                <input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $row->RequestID ?>,<?php echo $_SESSION['BidderID'] ?>)" />     <?php
                                                if ($inhouseCut_Call == 1) {
                                                    ?>&nbsp;&nbsp;
                                                    <span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand; font-weight:bold;">Show Mob</span> <?php } ?>
                                            </td>

                                            </tr>
                                            <?
                                            $color++;
                                        }
                                    }
                                    ?>
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

            </table>
        </div>
        <?
        function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate, $cmbfeedback, $varVal,$BidderIDStatic) {
            //$varFeedback = "Ringing";
            $strURL = "";
            $strURL = $varPHPPage . "?search=y&RequestID=" . $varRequestID . "&type=" . $varType . "&pageno=" . $varpageon . "&min_date=" . urlencode($varmindate) . "&max_date=" . urlencode($varmaxdate) . "&cmbfeedback=" . urlencode($cmbfeedback) . "&product=4&BidderIDstatic=".$BidderIDStatic;
            ?>
            <select name="type" id="type" onChange="MM_jumpMenu('parent', this, 0)">
                <option value="<? echo $strURL . '&Feedback=' ?>" <?
                if ($varFeedback == "") {
                    echo "selected";
                }
                ?>>Fresh lead</option>
                <option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <?
                if ($varFeedback == "Not Interested") {
                    echo "selected";
                }
                ?> >Not Interested</option>
                <option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <?
                if ($varFeedback == "Not Eligible") {
                    echo "selected";
                }
                ?> >Not Eligible</option>


                <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <?
                if ($varFeedback == "Ringing") {
                    echo "selected";
                }
                ?>>Ringing</option>
                <option value="<? echo $strURL . '&Feedback=Not Contactable' ?>" <?
                if ($varFeedback == "Not Contactable") {
                    echo "selected";
                }
                ?>>Not Contactable</option>
                <option value="<? echo $strURL . '&Feedback=Appointment' ?>" <?
                if ($varFeedback == "Appointment") {
                    echo "selected";
                }
                ?>>Appointment</option>



                <option value="<? echo $strURL . '&Feedback=Documents Pick' ?>" <?
                if ($varFeedback == "Documents Pick") {
                    echo "selected";
                }
                ?>>Documents Pick</option>
                <option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <?
                if ($varFeedback == "FollowUp") {
                    echo "selected";
                }
                ?>>FollowUp</option>
                <option value="<? echo $strURL . '&Feedback=Login' ?>" <?
                if ($varFeedback == "Login") {
                    echo "selected";
                }
                ?>>Login</option>
                <option value="<? echo $strURL . '&Feedback=Post Login Rejected' ?>" <?
                if ($varFeedback == "Post Login Rejected") {
                    echo "selected";
                }
                ?>>Post Login Rejected</option>
                
                <option value="<? echo $strURL . '&Feedback=Callback later' ?>" <?
                if ($varFeedback == "Callback later") {
                    echo "selected";
                }
                ?>>Callback later</option>
                
                <option value="<? echo $strURL . '&Feedback=Approved' ?>" <?
                if ($varFeedback == "Approved") {
                    echo "selected";
                }
                ?>>Approved</option>
                <option value="<? echo $strURL . '&Feedback=Disbursed' ?>" <?
                if ($varFeedback == "Disbursed") {
                    echo "selected";
                }
                ?>>Disbursed</option>
                
            </select>	
            <?
        }
        ?>
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script> 
        <script type="text/javascript">
            try {
                var pageTracker = _gat._getTracker("UA-1312775-1");
                pageTracker._trackPageview();
            } catch (err) {
            }</script>
        <script type="text/javascript">
            function insertData(id,get_bidderid)
            {
                var get_requestid = document.getElementById('requestid_' + id).value;
                var getTableName = "Req_Feedback_PL";
                var get_followup = document.getElementById('Followup_Date_' + id).value;
                var queryString = "?get_requestid=" + get_requestid + "&get_bidderid=" + get_bidderid + "&get_followup=" + get_followup + "&getTableName=" + getTableName;

                ajaxRequest.open("GET", "leadspl_followup_date.php" + queryString, true);
                // Create a function that will receive data sent from the server
                ajaxRequest.onreadystatechange = function () {
                    if (ajaxRequest.readyState == 4)
                    {
                        if (ajaxRequest.responseText == "insert")
                        {
                            alert('FollowUp date has been saved');
                        } else
                        {
                            alert('Not save the FollowUp date');
                        }
                    }
                }
                ajaxRequest.send(null);
            }
        </script>

        <script>
            function getbankFeedback(val) {

                $.ajax({
                    type: "POST",
                    url: "getbankfeedback.php",
                    data: 'cmbfeedback=' + val,
                    success: function (data) {
                        $("#bankFeedback").html(data);
                    }
                });

            }
        </script>

    </body>
</html>
