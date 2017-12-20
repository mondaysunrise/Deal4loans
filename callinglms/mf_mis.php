<?php
require_once("includes/application-top-inner.php");
define("TABLE_REQ_MF", "Req_Mutual_Fund");
define("ADMIN_TITLE", "Mutual Fund MIS Report");
define("FDBCKCALLDONE", "'Ringing','Not Contactable','No Feedback'");
define("FDBCKCONVERTED", "'Appointment'");
define("FDBCKFOLLOWUP", "'FollowUp'");
define("FDBCKCALLBACK", "'Callback Later'");
define("FDBCKPICKUP", "'PickUp'");
define("FDBCKNOTCONTACT", "'Ringing','Not Contactable'");



if ($_REQUEST['min_date'] == '') {
    $min_date = date("Y-m-d");
} else {
    $min_date = "";
    if (isset($_REQUEST['min_date'])) {
        $min_date = $_REQUEST['min_date'];
    }
}

if ($_REQUEST['max_date'] == '') {
    $max_date = date("Y-m-d");
} else {
    $max_date = "";
    if (isset($_REQUEST['max_date'])) {
        $max_date = $_REQUEST['max_date'];
    }
}
$varCmbFeedback = "";
if (isset($_REQUEST['cmbfeedback'])) {
    $varCmbFeedback = $_REQUEST['cmbfeedback'];
}
$min_date = $min_date . " 00:00:00";
$max_date = $max_date . " 23:59:59";
// Get Lead Recieve
function LeadReceivedCount($BidId, $min_date, $max_date) {
    $feedback_tble = "lead_allocate";
    return $qry = "SELECT *, " . $feedback_tble . ".BidderID FROM " . $feedback_tble . "," . TABLE_REQ_MF . " LEFT OUTER JOIN Req_Feedback_MF ON Req_Feedback_MF.AllRequestID=" . TABLE_REQ_MF . ".RequestID AND Req_Feedback_MF.BidderID in (" . $BidId . ") WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_MF . ".RequestID and " . $feedback_tble . ".BidderID in (" . $BidId . ") and " . TABLE_REQ_MF . ".Allocated=0 and ((" . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')) ";
}

//Want Online
function LeadWantOnlineORKYCCount($BidId, $min_date, $max_date,$status) {
    $feedback_tble = "lead_allocate";
    $qry = "SELECT *, " . $feedback_tble . ".BidderID FROM " . $feedback_tble . "," . TABLE_REQ_MF . " LEFT OUTER JOIN Req_Feedback_MF ON Req_Feedback_MF.AllRequestID=" . TABLE_REQ_MF . ".RequestID AND Req_Feedback_MF.BidderID in (" . $BidId . ") WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_MF . ".RequestID and " . $feedback_tble . ".BidderID in (" . $BidId . ") and " . TABLE_REQ_MF . ".Allocated=0 and ((" . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') or (Req_Feedback_MF.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "'))";
    if($status=='WantOnline')
    {
            $qry .= " AND  " . TABLE_REQ_MF . ".want_online";
    }
    if($status==1 || $status=='0'){
       $qry .= " AND  " . TABLE_REQ_MF . ".ekyc_status='".$status."'";  
    }
        return $qry;    
    }

function CallingDone($BidId, $min_date, $max_date, $FeedbackVal) {
    $feedback_tble = "lead_allocate";
    $FeedbackClause = " AND Req_Feedback_MF.Feedback NOT IN ($FeedbackVal)";
    $qry = "SELECT * FROM " . $feedback_tble . "," . TABLE_REQ_MF . " LEFT OUTER JOIN Req_Feedback_MF ON Req_Feedback_MF.AllRequestID=" . TABLE_REQ_MF . ".RequestID AND Req_Feedback_MF.BidderID= '" . $BidId . "' WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_MF . ".RequestID and " . $feedback_tble . ".BidderID = '" . $BidId . "' and " . TABLE_REQ_MF . ".Allocated=0 and ((" . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')) ";
    return $qry = $qry . $FeedbackClause . " " . $mob_num_clause . " group by " . TABLE_REQ_MF . ".Mobile_Number ";
}

function GetConvertedCnt($BidId, $min_date, $max_date, $FeedbackVal) {
    $feedback_tble = "lead_allocate";
    $FeedbackClause = " AND Req_Feedback_MF.Feedback IN ($FeedbackVal)";
    $qry = "SELECT * FROM " . $feedback_tble . "," . TABLE_REQ_MF . " LEFT OUTER JOIN Req_Feedback_MF ON Req_Feedback_MF.AllRequestID=" . TABLE_REQ_MF . ".RequestID AND Req_Feedback_MF.BidderID= '" . $BidId . "' WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_MF . ".RequestID and " . $feedback_tble . ".BidderID = '" . $BidId . "' and " . TABLE_REQ_MF . ".Allocated=0 and ((" . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')) ";
    return $qry = $qry . $FeedbackClause . " " . $mob_num_clause . " group by " . TABLE_REQ_MF . ".Mobile_Number ";
}
?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title><?= ADMIN_TITLE; ?></title>
        <script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
        <link href="../includes/style1.css" rel="stylesheet" type="text/css">
        <link href="../style.css" rel="stylesheet" type="text/css" />
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


        </script>
        <!--DatePicker End-->
    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
        <?php include "header_mf_admin_lms.php"; ?>

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
                <td align="center" width="100%">
                        <form name="frmsearch" action="mf_mis.php" method="get" onSubmit="return chkform();">
                            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">

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
                                        <input name="min_date" type="text" id="min_date" size="15" value="<? if($_REQUEST['min_date']==''){echo date("Y-m-d");}else {echo $_REQUEST['min_date'];} ?>" ></td>
                                    <td width="13%" style="text-align:right;">To</td>
                                    <td><input name="max_date" type="text" id="max_date" size="15" value="<? if($_REQUEST['max_date']==''){echo date("Y-m-d");}else {echo $_REQUEST['max_date']; } ?>"></td>
                                </tr>


                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
                                </tr>
                            </table>
                        </form>
                        <p>&nbsp;</p>

                        <table width="97%" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">

                            <?php
                            $qryGetAgent = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('mutualfundslms') and leadidentifier!=''";
                            $recordcount = $objAdmin->fun_get_num_rows($qryGetAgent);
                            $qryCheckResultAgent = $obj->fun_db_query($qryGetAgent);
                            ?>

                            
                            <tr>
                                <td class="head1" colspan="20">Investment-Lead Assessment - Date range (<?php echo $min_date?> to <?php echo $max_date?>)</td>
                            </tr>
                            <tr>
                <td class="head1" rowspan="2">Wish Expert</td>
                <td class="head1" rowspan="2">Lead Received</td>
                <td class="head1" rowspan="2">Calling done</td>
                <td class="head1" rowspan="2">Not Contact</td>
                <td class="head1" rowspan="2">Converted</td>
                <td class="head1" rowspan="2">%</td>
                <td class="head1" colspan="2">MF Application</td>
                <td class="head1" rowspan="2">%</td>
                <td class="head1" colspan="2">Trans Value</td>
                <td class="head1" rowspan="2">Folowup</td>
                <td class="head1" rowspan="2">%</td>
                <td class="head1" rowspan="2">Call Back</td>
                <td class="head1" rowspan="2">%</td>
                <td class="head1" rowspan="2">Pending </td>
                <td class="head1" rowspan="2">Pick Up's</td>
                <td class="head1" rowspan="2">Folowup to Pickup %</td>
                <td class="head1" rowspan="2">Online</td>
                <td class="head1" rowspan="2">KYC<br>Yes/No</td>
            </tr>
            <tr>
                <td class="head1">SIP </td>
                <td class="head1">Lumpsum</td>
                <td class="head1">SIP</td>
                <td class="head1">Lumpsum</td>
            </tr>
<?
if ($recordcount > 0) {
    $color = 1; 
    $totalLeadReceive=0;
    $totalCallingDone=0;
    while ($rowAgent = $obj->fun_db_fetch_rs_object($qryCheckResultAgent)) {
        $full_name = $rowAgent->Bidder_Name;
        $BidderID = $rowAgent->BidderID;
        $feedback_tble = "lead_allocate";
        $LeadCnt = LeadReceivedCount($BidderID, $min_date, $max_date);
        $LeadRecCnt = $obj->fun_db_query($LeadCnt);
        $num_rows = $obj->fun_db_get_num_rows($LeadRecCnt);
       
        $RowSip= array();
        $RowTransValSip= array();
        $RowMFLumpsum= array();
        $RowTransValLumpsum= array();
        
        $arrSum = array();
        while($RowLeadArr = $obj->fun_db_fetch_rs_object($LeadRecCnt))
        {
            $RowSip[]= $RowLeadArr->MF_SIP;
            $RowTransValSip[]= $RowLeadArr->Trans_Val_SIP;
            $RowMFLumpsum[]= $RowLeadArr->MF_Lumpsum;
            $RowTransValLumpsum[]= $RowLeadArr->Trans_Val_Lumpsum;
        }
        $SipSum = array_sum($RowSip);
        $TransValSipSum = array_sum($RowTransValSip);
        $RowMFLumpsumSum = array_sum($RowMFLumpsum);
        $RowTransValLumpSum = array_sum($RowTransValLumpsum);
        $RowSip='';
        $RowTransValSip='';
        $RowMFLumpsum='';
        $RowTransValLumpsum='';
        
        // Calling Done
        $FeedbackCallDone = FDBCKCALLDONE;
        $callingDone = CallingDone($BidderID, $min_date, $max_date, $FeedbackCallDone);
        $LeadcallingDoneCnt = $obj->fun_db_query($callingDone);
        $num_rowsCallingDone = $obj->fun_db_get_num_rows($LeadcallingDoneCnt);
        //Converted
        $Convertfdbk = FDBCKCONVERTED;
        $Converted = GetConvertedCnt($BidderID, $min_date, $max_date, $Convertfdbk);
        $LeadConvertedCnt = $obj->fun_db_query($Converted);
        $num_rowsConverted = $obj->fun_db_get_num_rows($LeadConvertedCnt);
        
        // Not Contact
        $NotContact = FDBCKNOTCONTACT;
        $NotContactVal = GetConvertedCnt($BidderID, $min_date, $max_date, $NotContact);
        $LeadNotContactCnt = $obj->fun_db_query($NotContactVal);
        $num_rowsNotContact = $obj->fun_db_get_num_rows($LeadNotContactCnt);

        //Percentage Converted
        $percentageConvert = $num_rowsConverted * 100 / $num_rowsCallingDone;
        $ConvertPercent = round($percentageConvert,2);
         //MF Application Percentage
        $MFAppPercent = $SipSum*100/$num_rowsCallingDone;
        $PercentMFApp = round($MFAppPercent,2);
        
        
        //FollowUp
        $FollowUpfdbk = FDBCKFOLLOWUP;
        $FollowUpVal = GetConvertedCnt($BidderID, $min_date, $max_date, $FollowUpfdbk);
        $LeadFollowUpCnt = $obj->fun_db_query($FollowUpVal);
        $num_rowsFollowUp = $obj->fun_db_get_num_rows($LeadFollowUpCnt);

        //Percentage FollowUp
        $percentageFollowUp = $num_rowsFollowUp * 100 / $num_rowsCallingDone;

        //Callback
        $callBackfdbk = FDBCKCALLBACK;
        $callBackVal = GetConvertedCnt($BidderID, $min_date, $max_date, $callBackfdbk);
        $LeadcallBackCnt = $obj->fun_db_query($callBackVal);
        $num_rowscallBack = $obj->fun_db_get_num_rows($LeadcallBackCnt);

        //Percentage Callback
        $percentageCallback = $num_rowscallBack * 100 / $num_rowsCallingDone;
        
        //Pending 
        $AddClDnNotConatc = $num_rowsCallingDone+$num_rowsNotContact;
        $num_rowsPending = $num_rows-$AddClDnNotConatc;
        
        //PickUp
         $PickUpfdbk = FDBCKPICKUP;
        $PickUpVal = GetConvertedCnt($BidderID, $min_date, $max_date, $PickUpfdbk);
        $LeadPickUpCnt = $obj->fun_db_query($PickUpVal);
        $num_rowsPickUp = $obj->fun_db_get_num_rows($LeadPickUpCnt);
        
        //Folowup to Pickup %
        $perFolowUpToPckup = $num_rowsPickUp * 100 / $num_rowsFollowUp;

       $LeadWantOnline = LeadWantOnlineORKYCCount($BidderID, $min_date, $max_date,'WantOnline');
       $LeadWantOnlineCnt = $obj->fun_db_query($LeadWantOnline);
       $num_rowsOnlineCnt = $obj->fun_db_get_num_rows($LeadWantOnlineCnt);
       
       //KYC Yes
       $LeadKYCYes = LeadWantOnlineORKYCCount($BidderID, $min_date, $max_date,'1');
       $LeadKYCYesCnt = $obj->fun_db_query($LeadKYCYes);
       $num_rowsKYCYesCnt = $obj->fun_db_get_num_rows($LeadKYCYesCnt);
       
        //KYC No
       $LeadKYCNo = LeadWantOnlineORKYCCount($BidderID, $min_date, $max_date,'0');
       $LeadKYCNoCnt = $obj->fun_db_query($LeadKYCNo);
       $num_rowsKYCNoCnt = $obj->fun_db_get_num_rows($LeadKYCNoCnt);
    
//prin_r($LeadCnt);
//Get Comment (Response) 
        if ($color % 2 != 0) {
            $colorvar = "#FFF";
        } else {
            $colorvar = "#EEE";
        }
        ?>
                                    <!--///////////////////////-->
            <tr  bgcolor="<?php echo $colorvar; ?>">                                                     <td class="bodyarial11"><? echo $full_name; ?></td>
                <td class="bodyarial11"><?php echo $num_rows; ?></td>
                <td class="bodyarial11"><?php echo $num_rowsCallingDone; ?></td>
                <td class="bodyarial11"><?php echo $num_rowsNotContact; ?></td>
                <td class="bodyarial11"><?php echo $num_rowsConverted; ?></td>
                <td class="bodyarial11"><? echo $ConvertPercent; ?></td>
                <td class="bodyarial11"><? echo $SipSum;?></td>
                <td class="bodyarial11"><? echo $RowMFLumpsumSum;?></td>
                <td class="bodyarial11"><? echo $PercentMFApp; ?></td>
                <td class="bodyarial11"><? echo round($TransValSipSum,2);?></td>
                <td class="bodyarial11"><? echo round($RowTransValLumpSum,2);?></td>
                <td class="bodyarial11"><? echo $num_rowsFollowUp; ?></td>
                <td class="bodyarial11"><? echo round($percentageFollowUp,2); ?></td>
                <td class="bodyarial11"><? echo $num_rowscallBack; ?></td>
                <td class="bodyarial11"><? echo round($percentageCallback,2); ?></td>
                <td class="bodyarial11"><? echo $num_rowsPending; ?></td>
                <td class="bodyarial11"><? echo $num_rowsPickUp; ?></td>
                <td class="bodyarial11"><? echo round($perFolowUpToPckup,2); ?></td>
              
<td class="bodyarial11"><? echo $num_rowsOnlineCnt; ?></td>
<td class="bodyarial11"><? echo $num_rowsKYCYesCnt; ?>/<? echo $num_rowsKYCNoCnt; ?></td>
                
            </tr>
                <?
                $color++;
                
            $totalLeadReceive += $num_rows;
            $totalCallingDone += $num_rowsCallingDone;
            $totalNotConnect += $num_rowsNotContact;
            $totalConverted +=$num_rowsConverted;
            $totalConvertedPercent +=$ConvertPercent;
            $totalSipSum += $SipSum;
            $totalRowMFLumpsumSum += $RowMFLumpsumSum;
            $totalMFAppPercent += $PercentMFApp;
            $totalTransValSipSum += $TransValSipSum;
            $totalTransValLumpSum += $RowTransValLumpSum;
            $totalFollowUp += $num_rowsFollowUp;
            $totalpercentageFollowUp += $percentageFollowUp;
            $totalCallBack += $num_rowscallBack;
            $totalpercentageCallback += $percentageCallback;
            $totalPending += $num_rowsPending;
            $totalPickUp += $num_rowsPickUp;
            $totalpercentageFolowUpToPckup += $perFolowUpToPckup;
            $totalnum_rowsOnlineCnt +=$num_rowsOnlineCnt;
            $totalnum_rowsKYCYesCnt +=$num_rowsKYCYesCnt;
            $totalnum_rowsKYCNoCnt +=$num_rowsKYCNoCnt;
            

            }
           
        }
        ?>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong><?php echo $totalLeadReceive;?></strong></td>
                <td><strong><?php echo $totalCallingDone;?></strong></td>
                <td><strong><?php echo $totalNotConnect;?></strong></td>
                <td><strong><?php echo $totalConverted;?></strong></td>
                <td><strong><?php echo round($totalConvertedPercent/$recordcount,2);?></strong></td>
                <td><strong><?php echo $totalSipSum;?></strong></td>
                <td><strong><?php echo $totalRowMFLumpsumSum;?></strong></td>
                <td><strong><?php echo round($totalMFAppPercent/$recordcount,2);?></strong></td>
                <td><strong><?php echo round($totalTransValSipSum,2);?></strong></td>
                <td><strong><?php echo round($totalTransValLumpSum,2);?></strong></td>
                <td><strong><?php echo $totalFollowUp;?></strong></td>
                <td><strong><?php echo round($totalpercentageFollowUp/$recordcount,2);?></strong></td>
                <td><strong><?php echo $totalCallBack;?></strong></td>
                <td><strong><?php echo round($totalpercentageCallback/$recordcount,2)?></strong></td>
                <td><strong><?php echo $totalPending;?></strong></td>
                <td><strong><?php echo $totalPickUp;?></strong></td>
                <td><strong><?php echo round($totalpercentageFolowUpToPckup/$recordcount,2);?></strong></td>
                <td><strong><?php echo $totalnum_rowsOnlineCnt;?></strong></td>
                <td><strong><?php echo $totalnum_rowsKYCYesCnt;?>/<?php echo $totalnum_rowsKYCNoCnt;?></strong></td>
            </tr>
            
            
    </table>

                    </td>
            </tr>

        </table>
    </div>
    <?

    function timeDiff($firstTime, $lastTime) {
        $firstTime = strtotime($firstTime);
        $lastTime = strtotime($lastTime);
        $timeDiff = ($lastTime - $firstTime) / 86400;
        return $timeDiff;
    }
    ?>
   </body>
</html>
