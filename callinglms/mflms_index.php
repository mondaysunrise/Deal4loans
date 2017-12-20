<?php
require_once("includes/application-top-inner.php");
define("TABLE_REQ_MF", "Req_Mutual_Fund");
define("NoOFLMS", 2);
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;

//print_r($_SESSION);
//echo "<br>".$_SESSION["BidderID"];
function ccMasking($number, $maskingCharacter = 'X') {
    return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

$BidderIDstatic = $_SESSION["BidderID"];
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

$cc_type = "";
if (isset($_REQUEST['cc_type'])) {
    $cc_type = $_REQUEST['cc_type'];
}
$application_no = "";
if (isset($_REQUEST['application_no'])) {
    $application_no = $_REQUEST['application_no'];
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
$is_invest_ready = "";
if (isset($_REQUEST['is_invest_ready'])) {
    $is_invest_ready = $_REQUEST['is_invest_ready'];
}

// Get Last Inserted Comment (Response)
function GetLastComment($ReqId, $BiddId) {
    $CLeadCmntqry = "select id, RequestID,Comments, BidderID from client_lead_allocated_comment where RequestID=$ReqId and BidderID=" . $BiddId . " AND Reply_Type=11 ORDER BY id DESC LIMIT 0,1";
    $Cmntresult = $obj->fun_db_query($CLeadCmntqry);
    //$row = $obj->fun_db_fetch_rs_array($result);
}
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
                    //defaultDate: "+1d",
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
                ajaxRequest.open("GET", "/getMFNum.php" + queryString, true);
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
        <!--DatePicker End-->
    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<?php include "header_mf_lms.php"; ?>
        <!-- End Main Banner Menu Panel --><!--<div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>-->
        <div style="clear:both;"></div>
    </div>
    <div style="clear:both; height:15px;"></div>
    <div> 
        <table width="98%" border="0">
              <!--<tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID']; ?>&product=11" target="_blank">today's Report</a></td></tr>-->
            <tr>
                <td align="right"></td>
            </tr>
            <tr>
                <td align="center" width="100%"><div align="center">
                        <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
                            <form name="frmsearch" action="mflms_index.php" method="get" onSubmit="return chkform();">
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
                                    <td width="29%"><select name="cmbfeedback" id="cmbfeedback">
                                            <option value="All" <? if ($varCmbFeedback == "All") {
    echo "selected";
} ?>>All</option>
                                            <option value="" <? if ($varCmbFeedback == "") {
    echo "selected";
} ?>>No Feedback</option>

<option value="Appointment" <? if ($varCmbFeedback == "Appointment") {
    echo "selected";
} ?>>Converted</option>
                                            <option value="Other Product" <? if ($varCmbFeedback == "Other Product") {
    echo "selected";
} ?>>Other Product</option>
                                            <option value="Not Interested" <? if ($varCmbFeedback == "Not Interested") {
    echo "selected";
} ?>>Not Interested</option>
                                            <option value="Callback Later" <? if ($varCmbFeedback == "Callback Later") {
    echo "selected";
} ?>>Callback Later</option>
                                            <option value="Wrong Number" <? if ($varCmbFeedback == "Wrong Number") {
    echo "selected";
} ?>>Wrong Number</option>
                                            <option value="Not Eligible" <? if ($varCmbFeedback == "Not Eligible") {
    echo "selected";
} ?>>Not Eligible</option>
                                            <option value="Ringing" <? if ($varCmbFeedback == "Ringing") {
    echo "selected";
} ?>>Ringing</option>
                                            <option value="Not Contactable" <? if ($varCmbFeedback == "Not Contactable") {
    echo "selected";
} ?>>Not Contactable</option>
                                            <option value="Duplicate" <? if ($varCmbFeedback == "Duplicate") {
    echo "selected";
} ?>>Duplicate</option>
                                            <option value="Send Now" <? if ($varCmbFeedback == "Send Now") {
    echo "selected";
} ?>>Send Now</option>
                                            <option value="Not Applied" <? if ($varCmbFeedback == "Not Applied") {
    echo "selected";
} ?>>Not Applied</option>
                                            <option value="FollowUp" <? if ($varCmbFeedback == "FollowUp") {
    echo "selected";
} ?>>FollowUp</option>
                                            <option value="PickUp" <? if ($varCmbFeedback == "PickUp") {
    echo "selected";
} ?>>PickUp</option>

                                        </select></td>
                                    <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
                                    <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
                                    </td>
                                </tr>
                                <tr><td width="12%"><strong>Invest Ready:</strong></td><td>
                                <select name="is_invest_ready" id="is_invest_ready">
                                 <option value="All" <? if ($is_invest_ready== "All") { echo "selected";} ?>>All</option>
                                 <option value="1" <? if ($is_invest_ready=='1') { echo "selected"; } ?>>Yes</option>
                                 <option value="0" <? if ($is_invest_ready=='0') { echo "selected"; } ?>>No</option>                                 
								</select>
                                </td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
                                </tr>
                            </form>
                        </table>
                        <p>&nbsp;</p>
                        <?
                        $search_date = "";
                        $varmin_date = $min_date;
                        $varmax_date = $max_date;

                        if (strlen(trim($RequestID)) > 0) {
                            $strSQL = "";
                            $Msg = "";
                            $fbqry = "select FeedbackID from Req_Feedback_MF where AllRequestID=$RequestID and BidderID=" . $_SESSION['BidderID'] . " AND Reply_Type=11";
                            $result = $obj->fun_db_query($fbqry);

                            $num_rows = $obj->fun_db_get_num_rows($result);
                            if ($num_rows > 0) {
                                $row = $obj->fun_db_fetch_rs_array($result);
                                $strSQL = "Update Req_Feedback_MF Set Feedback='" . $Feedback . "' ";
                                $strSQL = $strSQL . "Where FeedbackID=" . $row["FeedbackID"];
                            } else {
                                $strSQL = "Insert into Req_Feedback_MF(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
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
                                $FeedbackClause = " AND (Req_Feedback_MF.Feedback IS NULL OR Req_Feedback_MF.Feedback='' OR Req_Feedback_MF.Feedback='No Feedback') ";
                            } else if ($varCmbFeedback == "All") {
                                $FeedbackClause = " ";
                            } else {
                                $FeedbackClause = " AND Req_Feedback_MF.Feedback='" . $varCmbFeedback . "' ";
                            }
                            
                            if ($is_invest_ready=="0") {
                                $is_invest_readyClause = " AND ".TABLE_REQ_MF.".is_invest_ready='0' ";
                            } else if ($is_invest_ready== "All") {
                                $is_invest_readyClause = " ";
                            } else {
                                $is_invest_readyClause = " AND ".TABLE_REQ_MF.".is_invest_ready='1' ";
                            }
                            
                            ?>       <p class="bodyarial11">
                            <?= $Msg ?>
                            </p>
                            <table width="958" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
                                <?
                                $srh_qry = "";
                                if ($mob_num > 0) {
                                    $mob_num_clause = " AND " . TABLE_REQ_MF . ".Mobile_Number = '" . $mob_num . "' ";
                                }
                                if ($_SESSION['BidderID'] != "") {
                                    $feedback_tble = "lead_allocate";
                                    $qry = "SELECT * FROM " . $feedback_tble . "," . TABLE_REQ_MF . " LEFT OUTER JOIN Req_Feedback_MF ON Req_Feedback_MF.AllRequestID=" . TABLE_REQ_MF . ".RequestID AND Req_Feedback_MF.BidderID= '" . $BidderIDstatic . "' WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_MF . ".RequestID and " . $feedback_tble . ".BidderID = '" . $BidderIDstatic . "' and " . TABLE_REQ_MF . ".Allocated=0 and ((" . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')) ";
                                    $qry = $qry . $FeedbackClause . " " . $mob_num_clause . " ".$is_invest_readyClause." group by " . TABLE_REQ_MF . ".Mobile_Number ";
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
                                    <td class="head1">Salary</td>
                                    <td class="head1">City</td>
                                    <td class="head1">Plan</td>
                                    <td class="head1">Emp stat</td>
                                    <td class="head1">Feedback</td>                
                                    <td class="head1">FollowUp date</td>               
                                    <td class="head1">Comments</td> 

                                    <td class="head1">DOE</td> 
                    <!--  <td class="head1">Feedbackfrom Other LMS</td>--> 
                                </tr>
    <?
    if ($resCount > 0) {
        $color = 1;
        while ($row = $obj->fun_db_fetch_rs_object($result)) {
            //print_r($row);
            $Followup_Date = $row->Followup_Date;
            $exptodayformat = explode(" ", $Followup_Date);
            $explodeTime = explode(":", $exptodayformat[1]);
            $explodeHr = $explodeTime[0] - 1;
            $FinalMinDate = '"' . $exptodayformat[0] . ' ' . $explodeHr . ':' . $explodeTime[1] . ':' . $explodeTime[2] . '"';
            $FinalMaxDate = '"' . $exptodayformat[0] . ' 23:59:59"';
            $TodayFormat = date("Y-m-d");
            $FinalDay = $exptodayformat[0];
            $Employment_Status = $row->Employment_Status;
            $full_name = $row->Name;

            //Get Comment (Response) 
            $CLeadCmntqry = "select id, RequestID,Comments, BidderID from client_lead_allocated_comment where RequestID=$row->RequestID and BidderID=" . $_SESSION['BidderID'] . " AND Reply_Type=11 ORDER BY id DESC LIMIT 0,1";
            $Cmntresult = $obj->fun_db_query($CLeadCmntqry);
            $rowCnt = $obj->fun_db_fetch_rs_array($Cmntresult);

            if ($color % 2 != 0) {
                $colorvar = "#FFF";
            } else {
                $colorvar = "#EEE";
            }
            ?>
                                        <!--///////////////////////-->
                                        <tr  bgcolor="<?php echo $colorvar; ?>">			 <input type="hidden" name="requestid_<? echo $color;?>" id="requestid_<? echo $color;?>" value="<? echo $row->RequestID;?>">
	<input type="hidden" name="bidderid" id="bidderid" value="<? echo $BidderIDstatic;?>">
                                            <td class="bodyarial11">
                                                <a href="/mf_edit_details.php?postid=<? echo urlencode($row->RequestID); ?>&biddt=<? echo $_SESSION['BidderID']; ?>" target="_blank"><? if (strlen($full_name) > 0) {
                                echo $row->Name;
                            } else {
                                echo "Customer";
                            }
                            ?></a><?php
                            echo "<br>";
                            if($row->source=='SEO Deal4loans MF'){
                                echo "<span style=\"color:F00; font-weight:bold;\">Deal4loans</span>";
                            }
                            ?></td>
                                <td class="bodyarial11"><? //echo ccMasking($row->Mobile_Number); //echo $row->Mobile_Number;  ?><!--<img src="gButt.php?text=<? //echo $row->Mobile_Number;  ?>" />-->
                                                <span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span>
                                            </td>
                                            <td class="bodyarial11"><span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></span> </td>
                                            <td class="bodyarial11"><? echo $row->City; ?></td>
                                            <td class="bodyarial11"><? echo $row->MF_Plan; ?></td>
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
                                                <? getJumpMenu("mflms_index.php", $row->RequestID, "11", $row->Feedback, $pageno, $varmin_date, $varmax_date, $varCmbFeedback, $val); ?>
                                            </td>
                                            <td class="bodyarial11"><span id='datepicker_<?php echo $color;?>'><input type="text" name="Followup_Date_<?php echo $color;?>" id="Followup_Date_<?php echo $color;?>" value="<? echo $Followup_Date; ?>"></span><span><a onClick="insertData(<? echo $color;?>);" style="cursor:pointer; color:blue;" class="style3">Save</a></span>
                                            <script type="text/javascript">
  $(function() {
         $("#Followup_Date_<?php echo $color;?>").datepicker();
         });//this enable the call to datepicker when click on input field

         $(function() {
            $("#datepicker_<?php echo $color;?>").click(function() {
                $('#Followup_Date_<?php echo $color;?>').datepicker().datepicker( "show" )
            });
        }); 
   </script>
                                            </td>
                                            <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $rowCnt['Comments']; ?></textarea></td>
                                            <td class="bodyarial11"><? echo $row->Updated_Date; ?></td>
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
            <?
            if ($search == "y") {
                $datediffvar = timeDiff($varmin_date, $varmax_date);
                if ($datediffvar <= 365) {
                    ?>
                    <tr><td colspan="2" align="center"><table width="500" border="0" cellspacing="1" cellpadding="4">
                                <form name="frmdownload" action="/mf_excel_download.php" method="post">
                                    <tr>
                                        <td align="center">
                                            <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
                                            <input type="hidden" name="BidderIDstatus" value="NotAuthorized">
                                            <input type="hidden" name="BidderIDstatic" value="<?php echo $BidderIDstatic;?>">
                                            <input type="hidden" name="qry2" value="Req_Mutual_fund">
                                            <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
                                            <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
                                            <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
                                        </td>
                                    </tr>
                                </form>
                            </table></td></tr>
                <? }
            }
            ?>
        </table>
    </div>
    <?

    function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate, $cmbfeedback, $varVal) {
        $strURL = "";
        $strURL = $varPHPPage . "?search=y&RequestID=" . $varRequestID . "&type=" . $varType . "&pageno=" . $varpageon . "&min_date=" . urlencode($varmindate) . "&max_date=" . urlencode($varmaxdate) . "&cmbfeedback=" . urlencode($cmbfeedback) . "&product=11";
        ?>
        <select name="type" id="type" onChange="MM_jumpMenu('parent', this, 0)">
            <option value="<? echo $strURL . '&Feedback=' ?>" <? if ($varFeedback == "") {
        echo "selected";
    } ?>>No Feedback</option>
            <option value="<? echo $strURL . '&Feedback=Appointment' ?>" <? if ($varFeedback == "Appointment") {
        echo "selected";
    } ?>>Converted</option>
            
            <option value="<? echo $strURL . '&Feedback=Other Product' ?>" <? if ($varFeedback == "Other Product") {
        echo "selected";
    } ?>>Other Product</option>
            <option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <? if ($varFeedback == "Not Interested") {
        echo "selected";
    } ?>>Not Interested</option>
            <option value="<? echo $strURL . '&Feedback=Not Contactable' ?>" <? if ($varFeedback == "Not Contactable") {
        echo "selected";
    } ?>>Not Contactable</option>
            <option value="<? echo $strURL . '&Feedback=Callback Later' ?>" <? if ($varFeedback == "Callback Later") {
        echo "selected";
    } ?>>Callback Later</option>
            <option value="<? echo $strURL . '&Feedback=Wrong Number' ?>" <? if ($varFeedback == "Wrong Number") {
        echo "selected";
    } ?>>Wrong Number</option>
            <option value="<? echo $strURL . '&Feedback=Send Now' ?>" <? if ($varFeedback == "Send Now") {
        echo "selected";
    } ?> >Send Now</option>
            <option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <? if ($varFeedback == "Not Eligible") {
        echo "selected";
    } ?> >Not Eligible</option>
            <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {
        echo "selected";
    } ?> >Ringing</option>
            <option value="<? echo $strURL . '&Feedback=Duplicate' ?>" <? if ($varFeedback == "Duplicate") {
        echo "selected";
    } ?> >Duplicate</option>
            <option value="<? echo $strURL . '&Feedback=Not Applied' ?>" <? if ($varFeedback == "Not Applied") {
        echo "selected";
    } ?> >Not Applied</option>
            <option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <? if ($varFeedback == "FollowUp") {
        echo "selected";
    } ?>>FollowUp</option>
         <option value="<? echo $strURL . '&Feedback=PickUp' ?>" <? if ($varFeedback == "PickUp") {
        echo "selected";
    } ?>>PickUp</option>   
        </select>	
    <?
}

function timeDiff($firstTime, $lastTime) {
    $firstTime = strtotime($firstTime);
    $lastTime = strtotime($lastTime);
    $timeDiff = ($lastTime - $firstTime) / 86400;
    return $timeDiff;
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
    function insertData(id)
		{
		var get_requestid= document.getElementById('requestid_'+ id).value;
                   
		var get_bidderid= document.getElementById('bidderid').value;
		var get_followup= document.getElementById('Followup_Date_'+ id).value;
                var queryString = "?get_requestid=" + get_requestid + "&get_bidderid=" + get_bidderid + "&get_followup=" + get_followup;
				ajaxRequest.open("GET", "mf_followup_date.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						if(ajaxRequest.responseText=="insert")
						{
							alert('FollowUp date has been saved');
						}
						else
						{
							alert('Not save the FollowUp date');
						}
					}
				}
				ajaxRequest.send(null); 
		}
    </script>
</body>
</html>
