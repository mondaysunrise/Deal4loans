<?php
require_once("includes/application-top-inner.php");
define("TABLE_WISH_TRAVEL", "xkyknzl5dwfyk4hg_wish_travel");
define("NoOFLMS", 2);
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;


$BidderIDstatic = $_SESSION["BidderID"];
if (isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic']) > 0) {
    $BidderIDstatic = $_REQUEST['BidderIDstatic'];
}


$FeedbackClause = "";

$mob_num = "";
if (isset($_REQUEST['mob_num'])) {
    $mob_num = $_REQUEST['mob_num'];
}

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

$Feedback = "";
if (isset($_REQUEST['Feedback'])) {
    $Feedback = $_REQUEST['Feedback'];
}
$is_invest_ready = "";
if (isset($_REQUEST['is_invest_ready'])) {
    $is_invest_ready = $_REQUEST['is_invest_ready'];
}
?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title>Travel LMS</title>
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
                    defaultDate: "+1w",
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


            window.onload = ajaxFunction;

        </script>
        <!--DatePicker End-->
    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
        <?php include "header_travel_lms.php";  ?>
        <div style="clear:both;"></div>
    
    <div style="clear:both; height:15px;"></div>
    <div> 
        <table width="98%" border="0">
          <tr>
                <td align="right"></td>
            </tr>
            <tr>
                <td align="center" width="100%"><div align="center">
                        <form name="frmsearch" action="travellms_index.php" method="get" onSubmit="return chkform();">
                            <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"]; ?>">
                            <input type="hidden" name="search" id="search" value="y">
                            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">

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
                                    <td width="29%"><select name="cmbfeedback" id="cmbfeedback">
                                            <option value="All" <?
        if ($varCmbFeedback == "All") {
            echo "selected";
        }
        ?>>All</option>
                                            <option value="" <?
                                                    if ($varCmbFeedback == "") {
                                                        echo "selected";
                                                    }
                                                    ?>>No Feedback</option>

                                            <option value="Appointment" <?
                                            if ($varCmbFeedback == "Appointment") {
                                                echo "selected";
                                            }
                                            ?>>Converted</option>
                                            <option value="Other Product" <?
                                            if ($varCmbFeedback == "Other Product") {
                                                echo "selected";
                                            }
                                            ?>>Other Product</option>
                                            <option value="Not Interested" <?
                                                    if ($varCmbFeedback == "Not Interested") {
                                                        echo "selected";
                                                    }
                                                    ?>>Not Interested</option>
                                            <option value="Callback Later" <?
                                            if ($varCmbFeedback == "Callback Later") {
                                                echo "selected";
                                            }
                                            ?>>Callback Later</option>
                                            <option value="Wrong Number" <?
                                            if ($varCmbFeedback == "Wrong Number") {
                                                echo "selected";
                                            }
                                            ?>>Wrong Number</option>
                                            <option value="Not Eligible" <?
                                                    if ($varCmbFeedback == "Not Eligible") {
                                                        echo "selected";
                                                    }
                                                    ?>>Not Eligible</option>
                                            <option value="Ringing" <?
                                            if ($varCmbFeedback == "Ringing") {
                                                echo "selected";
                                            }
                                            ?>>Ringing</option>
                                            <option value="Not Contactable" <?
                                            if ($varCmbFeedback == "Not Contactable") {
                                                echo "selected";
                                            }
                                            ?>>Not Contactable</option>
                                            <option value="Duplicate" <?
                                            if ($varCmbFeedback == "Duplicate") {
                                                echo "selected";
                                            }
                                            ?>>Duplicate</option>
                                            <option value="Send Now" <?
                                            if ($varCmbFeedback == "Send Now") {
                                                echo "selected";
                                            }
                                            ?>>Send Now</option>
                                            <option value="Not Applied" <?
                                            if ($varCmbFeedback == "Not Applied") {
                                                echo "selected";
                                            }
                                            ?>>Not Applied</option>
                                            <option value="FollowUp" <?
                        if ($varCmbFeedback == "FollowUp") {
                            echo "selected";
                        }
                        ?>>FollowUp</option>
                                            <option value="PickUp" <?
                        if ($varCmbFeedback == "PickUp") {
                            echo "selected";
                        }
                        ?>>PickUp</option>

                                        </select></td>
                                    <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
                                    <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
                                    </td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" /></td>
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
                            $fbqry = "select FeedbackID from Req_Feedback_Travel where AllRequestID=$RequestID and BidderID=" . $_SESSION['BidderID'] . " AND Reply_Type=11";
                            $result = $obj->fun_db_query($fbqry);

                            $num_rows = $obj->fun_db_get_num_rows($result);
                            if ($num_rows > 0) {
                                $row = $obj->fun_db_fetch_rs_array($result);
                                $strSQL = "Update Req_Feedback_Travel Set Feedback='" . $Feedback . "' ";
                                $strSQL = $strSQL . "Where FeedbackID=" . $row["FeedbackID"];
                            } else {
                                $strSQL = "Insert into Req_Feedback_Travel(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
                                $strSQL = $strSQL . $RequestID . "," . $_SESSION['BidderID'] . ",'11','" . $Feedback . "')";
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
                            if (strlen(trim($varCmbFeedback)) == 0) {
                                $FeedbackClause = " AND (Req_Feedback_Travel.Feedback IS NULL OR Req_Feedback_Travel.Feedback='' OR Req_Feedback_Travel.Feedback='No Feedback') ";
                            } else if ($varCmbFeedback == "All") {
                                $FeedbackClause = " ";
                            } else {
                                $FeedbackClause = " AND Req_Feedback_Travel.Feedback='" . $varCmbFeedback . "' ";
                            }
                            ?>       <p class="bodyarial11">  <?= $Msg ?> </p>
                            <table width="958" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
    <?
    $srh_qry = "";
    if ($mob_num > 0) {
        $mob_num_clause = " AND " . TABLE_WISH_TRAVEL . ".Mobile_Number = '" . $mob_num . "' ";
    }
    if ($_SESSION['BidderID'] != "") {
        $feedback_tble = "lead_allocate";
        $qry = "SELECT * FROM " . $feedback_tble . "," . TABLE_WISH_TRAVEL . " LEFT OUTER JOIN Req_Feedback_Travel ON Req_Feedback_Travel.AllRequestID=" . TABLE_WISH_TRAVEL . ".id AND Req_Feedback_Travel.BidderID= '" . $BidderIDstatic . "' WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_WISH_TRAVEL . ".id and " . $feedback_tble . ".BidderID = '" . $BidderIDstatic . "' and ((" . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')) ";
        $qry = $qry . $FeedbackClause . " " . $mob_num_clause . " group by " . TABLE_WISH_TRAVEL . ".Mobile_Number ";
    }
    $srh_qry = $qry;

//echo $srh_qry;
    $resCount = $objAdmin->fun_get_num_rows($qry);
    if ($resCount > $limit) {
        $pagelinks = paginate($limit, $resCount);
    }
    $getParameterVal = min($start + $limit, $resCount) % $limit;
    $qry.= " order by Allocation_Date DESC LIMIT $start,$limit ";
    $result = $obj->fun_db_query($qry);
    ?>
                                <tr>
                                    <td colspan="11"><strong><? echo $start + 1; ?> to <? echo $start + $limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
                                </tr>
                                <tr>
                                    <td class="head1">Name</td>
                                    <td class="head1">Mobile</td>
                                    <td class="head1">Email</td>
                                    <td class="head1">Location travelling to</td>
                                    <td class="head1">No. of travelers (Adult/child)</td>

                                </tr>
    <?
    if ($resCount > 0) {
        $color = 1;
        while ($row = $obj->fun_db_fetch_rs_object($result)) {
            $full_name = $row->name;
            if ($color % 2 != 0) {
                $colorvar = "#FFF";
            } else {
                $colorvar = "#EEE";
            }
            ?>
                                        <!--///////////////////////-->
                                        <tr  bgcolor="<?php echo $colorvar; ?>">			                <td class="bodyarial11">
                                            <a href="/travel_edit_details.php?postid=<? echo urlencode($row->id); ?>&biddt=<? echo $_SESSION['BidderID']; ?>" target="_blank"><?
                        if (strlen($full_name) > 0) {
                            echo $row->name;
                        } else {
                            echo "Customer";
                        }
            ?></a></td>

                                        <td class="bodyarial11"> <?php echo $row->mobile_number; ?></td>
                                        <td class="bodyarial11"> <?php echo $row->email_id; ?></td>
                                        <td class="bodyarial11">                                    <?php //echo $row->travelto;?>
                                        </td>
                                        <td class="bodyarial11"> <?php echo $row->no_of_person; ?></td>
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
</body>
</html>
