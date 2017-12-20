<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);

function ccMasking($number, $maskingCharacter = 'X') {
    return substr($number, 0, 6) . str_repeat($maskingCharacter, strlen($number) - 6);
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
} else {
    $BidderIDstatic = $_SESSION['BidderID'];
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
if (isset($_REQUEST['ReferenceNum'])) {
    $ReferenceNum = $_REQUEST['ReferenceNum'];
}
if (isset($_REQUEST['LANNum'])) {
    $LANNum = $_REQUEST['LANNum'];
}
$BankFeedback = "";
if (isset($_REQUEST['BankFeedback'])) {
    $BankFeedback = $_REQUEST['BankFeedback'];
}
$Campaign = "";
if (isset($_REQUEST['Campaign'])) {
    $Campaign = $_REQUEST['Campaign'];
}
$Agents = '';
if (isset($_REQUEST['Agents'])) {
    if ($_REQUEST['Agents'] == 'All') {
        $qryAgent = "SELECT BidderID FROM Bidders where leadidentifier ='smsplbajajfinserv' and Global_Access_ID LIKE '%" . $_REQUEST['BidderIDstatic'] . "%' and leadidentifier!=''";
        $qryAgentResult = $obj->fun_db_query($qryAgent);
        $BidId = "";
        while ($rowAgents = $obj->fun_db_fetch_rs_object($qryAgentResult)) {
            $BidId[] = $rowAgents->BidderID;
        }
        $Agents = implode(",", $BidId);
    } else {
        $Agents = $_REQUEST['Agents'];
    }
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

$inhouseCut = '';
if ($_SESSION['BidderID'] == 7240 || $_SESSION['BidderID'] == 7241 || $_SESSION['BidderID'] == 7242) {
    $inhouseCut = 1;
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
            function getNumberValue(iLoc, id, parameterVal)
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

                //alert(allLoc);

                var queryString = "?get_requestid=" + id;
                ajaxRequest.open("GET", "/getfullertonNum.php" + queryString, true);
                ajaxRequest.onreadystatechange = function () {
                    if (ajaxRequest.readyState == 4)
                    {
<?php //if ($ReferenceNum != "") {  ?>
                        document.getElementById('clik4Num_' + iLoc).innerHTML = "<b style='font-size:12px;'>" + ajaxRequest.responseText + "</b>";
<?php //}  ?>
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
        <div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="font-size:30px; float: left;">Personal Loan Lead LMS <span style="font-size:15px; vertical-align: middle;"> - <?php echo $_SESSION['Process_Name']; ?></span></div><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout-leads-admin.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both; height:15px; text-align: right; padding-right: 20px;"><a href="images/BFL-Policy-and-Contacts.pdf" target="_blank"><strong>BFL Policy & Contacts</strong></a></div>
        <div> 
            <table width="98%" border="0">
                <tr>
                    <td align="center" width="100%"><div align="center">
                            <form name="frmsearch" action="leads-consol-lms-list.php" method="get" onSubmit="return chkform();">
                                <input type="hidden" name="productVal" id="productVal" value="1" />
                                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"]; ?>" />
                                <input type="hidden" name="search" id="search" value="y" />
                                <input type="hidden" name="cmbfeedback" value="OTP Done - OK" />
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
                                    <tr><td><strong>Followup wise</strong></td>
                                        <td><select name="FollowupWise" id="FollowupWise">
                                                <option value="">Please select</option>
                                                <option value="ARODOE"<?php if($_REQUEST['FollowupWise']=='ARODOE'){ echo "selected";}?>>ARO Followup</option>
                                                <option value="VerifierDOE"<?php if($_REQUEST['FollowupWise']=='VerifierDOE'){ echo "selected";}?>>Verifier  Followup</option>
                                            </select></td>


                                    </tr> 


                                    <tr>
                                        <td width="25%"><strong>Agents</strong></td>
                                        <td width="25%">
                                            <?php
                                            $qryCheck1 = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier ='smsplbajajfinserv' and leadidentifier!='' AND Global_Access_ID LIKE '%$BidderIDstatic%'";
                                            $recordcount = $objAdmin->fun_get_num_rows($qryCheck1);
                                            $qryCheckResult1 = $obj->fun_db_query($qryCheck1);
                                            $status_text = '';
                                            ?>
                                            <select name="Agents" id="Agents" ><option value="All" <?
                                                if ($Agents == "All") {
                                                    echo "selected";
                                                }
                                                ?>>All</option><?php
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

                                        </td>
                                        <td><strong>Reference Num</strong></td>
                                        <td><input name="ReferenceNum" type="text" id="ReferenceNum" size="15" value="<? echo $_REQUEST['ReferenceNum']; ?>" ></td>
                                    </tr>

                                    <tr>
                                        <td><strong>Bank Feedback</strong></td>
                                        <td><select name="BankFeedback" id="BankFeedback" onchange="showDatetimeDiv(this.value);">
                                                <option value="All">All</option>
                                                <option value="">Not Updated</option>
                                                <option value="Not Eligible" <? if ($_REQUEST['BankFeedback'] == "Not Eligible") {
                                                    echo "selected";
                                                } ?>>Not Eligible</option>
                                                <option value="Not Interested - Direct" <? if ($_REQUEST['BankFeedback'] == "Not Interested - Direct") {
                                                    echo "selected";
                                                } ?>>Not Interested - Direct</option>
                                                <option value="Not Interested - Offer" <? if ($_REQUEST['BankFeedback'] == "Not Interested - Offer") {
                                                    echo "selected";
                                                } ?>>Not Interested - Offer</option>
                                                <option value="Duplicate" <? if ($_REQUEST['BankFeedback'] == "Duplicate") {
                                                    echo "selected";
                                                } ?>>Duplicate</option>
                                                <option value="Not Contactable" <? if ($_REQUEST['BankFeedback'] == "Not Contactable") {
                                                    echo "selected";
                                                } ?>>Not Contactable</option>
                                                <option value="No Response" <? if ($_REQUEST['BankFeedback'] == "No Response") {
                                                    echo "selected";
                                                } ?>>No Response</option>
                                                <option value="Appointment" <? if ($_REQUEST['BankFeedback'] == "Appointment") {
                                                    echo "selected";
                                                } ?>>Appointment</option>
                                                <option value="Documents Picked" <? if ($_REQUEST['BankFeedback'] == "Documents Picked") {
                                                    echo "selected";
                                                } ?>>Documents Picked</option>
                                                <option value="Document Pending" <? if ($_REQUEST['BankFeedback'] == "Document Pending") {
                                                    echo "selected";
                                                } ?>>Document Pending</option>
                                                <option value="Follow Up" <? if ($_REQUEST['BankFeedback'] == "Follow Up") {
                                                    echo "selected";
                                                } ?>>Follow Up</option>
                                                <option value="Approved" <? if ($_REQUEST['BankFeedback'] == "Approved") {
                                                    echo "selected";
                                                } ?>>Approved</option>
                                                <option value="Dispatched" <? if ($_REQUEST['BankFeedback'] == "Dispatched") {
                                echo "selected";
                            } ?>>Dispatched</option>
                                                <option value="Post Login Reject" <? if ($_REQUEST['BankFeedback'] == "Post Login Reject") {
                                echo "selected";
                            } ?>>Post Login Reject</option>
                                            </select></td>
                                        <td width="25%"><strong>City</strong></td>
                                        <td align="left">
                                            <select name="CityName">
                                                <option value="">All</option>
                            <?php echo plgetCityList($_REQUEST['CityName']) ?>
                                            </select>
                                        </td>

                                    </tr>
                                    <tr><td>LAN Num.</td>
                                        <td><input type="text" name="LANNum" id="LANNum" value="<?php echo $LANNum; ?>" /></td>
                                        <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" /></td>

                                    </tr>

                                </table></form>
                            <p>&nbsp;</p>
                            <?
                            if ($search == "y") {
                                $min_date = $min_date . " 00:00:00";
                                $max_date = $max_date . " 23:59:59";

                                if (strlen(trim($varCmbFeedback)) == 0) {
                                    $FeedbackClause = " AND (Req_Feedback_PL.Feedback IS NULL OR Req_Feedback_PL.Feedback='' OR Req_Feedback_PL.Feedback='No Feedback') ";
                                } else if ($varCmbFeedback == "All") {
                                    $FeedbackClause = " ";
                                } else {
                                    $FeedbackClause = " AND Req_Feedback_PL.Feedback='" . $varCmbFeedback . "' ";
                                }
                                if (!empty($ReferenceNum)) {
                                    $FIDArr = explode("S", $ReferenceNum);
                                    $feedbackID = substr($FIDArr[0], 2);
                                    $reference_no_clause = " AND Req_Feedback_PL.FeedbackID = '" . $feedbackID . "'";
                                }
                                if ($_REQUEST['LANNum']) {
                                    $LANNumClause = " AND Req_Feedback_PL.post_login_stat='" . $_REQUEST['LANNum'] . "'";
                                }

                                if (strlen(trim($BankFeedback)) == 0) {
                                    $BankFeedbackClause = " AND (Req_Feedback_PL.axis_executive_name IS NULL OR Req_Feedback_PL.axis_executive_name='' OR Req_Feedback_PL.axis_executive_name='No Feedback') ";
                                } else if ($BankFeedback == "All") {
                                    $BankFeedbackClause = " ";
                                } else {
                                    $BankFeedbackClause = " AND Req_Feedback_PL.axis_executive_name='" . $BankFeedback . "' ";
                                }



                                if ($_SESSION['BidderID'] != "") {
                                    $feedback_tble = "lead_allocate";
                                    $qry = "SELECT lead_allocate.BidderID,Name,Mobile_Number,Net_Salary,Email,DOB, City, City_Other, Followup_Date, Employment_Status, RequestID, Feedback, FeedbackID,Add_Comment,Pancard, comment_section,post_login_stat,axis_executive_name,Dated,last_update_dated FROM " . $feedback_tble . "," . TABLE_REQ_LOAN_PERSONAL . " LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=" . TABLE_REQ_LOAN_PERSONAL . ".RequestID AND Req_Feedback_PL.BidderID in (" . $Agents . ") WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_LOAN_PERSONAL . ".RequestID and " . $feedback_tble . ".BidderID in (" . $Agents . ") and " . $feedback_tble . ".Reply_Type=1";
                                    $qry = $qry . " and ( " . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "'";
                                    
                                    //
                                    
                                   if($_REQUEST['FollowupWise']=='VerifierDOE'){
                                    $qry = $qry . " or Req_Feedback_PL.last_update_dated Between '" . ($min_date) . "' and '" . ($max_date) . "'";
                                   }else{
                                     $qry = $qry . " or Req_Feedback_PL.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "'";  
                                   }
                                    $qry = $qry . ") ";
                                    
                                    $qry = $qry . $FeedbackClause . " " . $reference_no_clause . " " . $BankFeedbackClause . " " . $LANNumClause;
                                }
                                if ($_REQUEST['CityName']) {
                                    $qry.= " AND City='" . $_REQUEST['CityName'] . "'";
                                }
                                $srh_qry = $qry;
                                $resCount = $objAdmin->fun_get_num_rows($qry);
                                if ($resCount > $limit) {
                                    $pagelinks = paginate($limit, $resCount);
                                }
                                $getParameterVal = min($start + $limit, $resCount) % $limit;
                                $qry.= " order by " . $val . ".Dated DESC LIMIT $start,$limit ";
                                $result = $obj->fun_db_query($qry);
                                ?>
                                <p class="bodyarial11">
                                    <?= $Msg ?>
                                </p>
                                <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
                                <table width="958" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">

                                    <tr>
                                        <td colspan="11"><strong><? echo $start + 1; ?> to <? echo $start + $limit; ?> 
                                                Out of <? echo $resCount; ?> Records </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="head1">Reference No</td>
                                        <td class="head1">Agent ID</td>
                                        <td class="head1">Name</td>
                                        <td class="head1">Mobile</td>
                                        <td class="head1">Salary</td>
                                        <td class="head1">City</td>
                                        <td class="head1">Bank Feedback</td>                                            <td class="head1">FollowUp date</td>               
                                        <td class="head1">Verifier Remark</td>  
                                    </tr>
                                    <?
                                    if ($resCount > 0) {
                                        $color = 1;
                                        while ($row = $obj->fun_db_fetch_rs_object($result)) {
                                            //echo "<pre>"; print_r($row);
                                            $ReqID = $row->RequestID;
                                            $BidderID = $row->BidderID;

                                            $feedbackVal = $row->axis_executive_name;
                                            $Followup_Date = $row->Followup_Date;
                                            $last_update_dated = $row->last_update_dated;
                                            $ShowComment = $row->Add_Comment;
                                            $comment_section = $row->comment_section;
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
                                                <td><?
                                                    if ($row->FeedbackID > 0) {
                                                        echo "PL" . $row->FeedbackID . "S" . $BidderID;
                                                    }
                                                    ?></td>
                                                <td class="bodyarial11"><? echo $BidderID; ?></td>
                                                <td class="bodyarial11"><a href="/personalloaneditlead_bflverifier.php?id=<?= $ReqID; ?>&bid=<?= $BidderID; ?>" target="_blank"><? echo $row->Name; ?></a></td>
                                                <td class="bodyarial11"><?php
                                                    if ($inhouseCut == 1) {
                                                        ?>
                                                        <span id="clik4Num_<?php echo $color; ?>"><?php echo ccMasking($row->Mobile_Number); ?></span>


                <?php
            } else {
                echo ccMasking($row->Mobile_Number);
            }
            ?></td>

                                                <td class="bodyarial11"> <?php
                                                    if ($inhouseCut == 1) {
                                                        ?>
                                                        <span id="clkNum<?php echo $color; ?>" onClick="getNumberValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></span> <?php
                                    } else {
                                        echo $row->Net_Salary;
                                    }
                                    ?>
                                                </td>
                                                <td class="bodyarial11"><?
                                            if ($row->City == "Others") {
                                                echo $City = $row->City_Other;
                                            } else {
                                                echo $City = $row->City;
                                            }
                                            ?></td>


                                                <td class="bodyarial11">
            <?
            if ($feedbackVal != "") {
                echo $feedbackVal;
            } else {
                echo "Not Updated";
            }
            ?>
                                                </td>
                                                <td class="bodyarial11"><? echo $last_update_dated; ?></td>
                                                <td class="bodyarial11">

                                                    <textarea rows="2" cols="10" readonly="readonly"><? echo $comment_section; ?></textarea></td>

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
                            </div></td>
                    </tr>
    <? if ($search == "y" && $_SESSION['BidderID']) {
        ?>
                            <!--<tr><td colspan="2" align="center"><form name="frmdownload" action="../download-excel-pl-lead-admin.php" method="post"><table width="500" border="0" cellspacing="1" cellpadding="4">

                                            <tr>
                                                <td align="center">
                                                    <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
                                                    <input type="hidden" name="GlobalID" value="<? echo $_SESSION['BidderID']; ?>">
                                                    <input type="hidden" name="qry2" value="Req_Loan_Personal">
                                                    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
                                                    <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
                                                    <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
                                                </td>
                                            </tr>

                                        </table></form></td></tr>-->
    <? }
}
?>
            </table>
        </div>
    </body>
</html>