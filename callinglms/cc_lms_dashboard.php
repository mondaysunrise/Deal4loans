<?php
require_once("includes/application-top-inner_test.php");
define("NoOFLMS", 2);

$feedback_tble = "lead_allocate";
$Dateval = $_REQUEST['Dateval'];
if ($Dateval != "") {
    $min_date = $Dateval . " 00:00:00";
    $max_date = $Dateval . " 23:59:59";
} else {
    $min_date = date("Y-m-d 00:00:00");
    $max_date = date("Y-m-d 23:59:59");
}
// Get BidderID
// Two Wheeler Get BidderID
$qryAgentsIDTwl = "SELECT BidderID, Bidder_Name,Status FROM Bidders where leadidentifier in ('diallerleadcc1')";
$qryAgentsIDResultTwl = $obj->fun_db_query($qryAgentsIDTwl);

// Direct
$qryAgentsIDDirect = "SELECT BidderID,Bidder_Name,Status FROM Bidders where leadidentifier in ('diallerleadcc')";
$qryAgentsIDResultDirect = $obj->fun_db_query($qryAgentsIDDirect);
$qryAgentsIDResultDirectAll = $obj->fun_db_query($qryAgentsIDDirect); // All BiiderIds
// diallercallerccpredictive
$qrySMSPre = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('diallercallerccpredictive') and leadidentifier!=''";
$qryCheckSMSPre = $obj->fun_db_query($qrySMSPre);
$qryCheckSMSPreAll = $obj->fun_db_query($qrySMSPre);

// diallerleadccsmsnew
$qrySMSNew = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('diallerleadccsmsnew') and leadidentifier!=''";
$qryCheckSMS = $obj->fun_db_query($qrySMSNew);
$qryCheckSMSNew = $obj->fun_db_query($qrySMSNew);

// diallerleadccsmsnew
$qryHL = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('CCTRANSFER2CALLER') and leadidentifier!=''";
$qryCheckHL = $obj->fun_db_query($qryHL);
$qryCheckHLNew = $obj->fun_db_query($qryHL);


function QueryProcess($Products, $AgentID) {
    $feedback_tble = "lead_allocate";
    $Dateval = $_REQUEST['Dateval'];
    if ($Dateval != "") {
        $min_date = $Dateval . " 00:00:00";
        $max_date = $Dateval . " 23:59:59";
    } else {
        $min_date = date("Y-m-d 00:00:00");
        $max_date = date("Y-m-d 23:59:59");
    }
    if ($Products == 'Twl') {
        return $qryTwl = "SELECT * FROM sbi_ccoffers_directonsite LEFT JOIN Req_Loan_Bike ON sbi_ccoffers_directonsite.sbicc_requestid=Req_Loan_Bike.RequestID WHERE (( Req_Loan_Bike.Updated_Date Between '" . ($min_date) . "' and '" . ($max_date) . "'))";
    }

    if ($Products == 'Direct') {
        return $qryDirect = "SELECT *, " . $feedback_tble . ".BidderID as BidID  FROM " . $feedback_tble . "," . TABLE_REQ_CREDIT_CARD . " LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=" . TABLE_REQ_CREDIT_CARD . ".RequestID AND Req_Feedback_CC.BidderID in (" . $AgentID . ") WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_CREDIT_CARD . ".RequestID and " . $feedback_tble . ".BidderID in (" . $AgentID . ") and " . $feedback_tble . ".Reply_Type=4 and ( " . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Feedback_CC.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')";
    }

    if ($Products == 'SMSPre') {

        return $qrySMSPreAll = "SELECT * FROM Req_Credit_Card_Sms LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID WHERE (( Req_Credit_Card_Sms.Updated_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Credit_Card_Sms.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') and lead_allocate.BidderID  in (" . $AgentID . ") ) ";
    }
    if ($Products == 'SMS') {
        return $qrySMS = "SELECT * FROM Req_Credit_Card_Sms LEFT OUTER JOIN lead_allocate ON lead_allocate.AllRequestID=Req_Credit_Card_Sms.RequestID WHERE (( Req_Credit_Card_Sms.Updated_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Credit_Card_Sms.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') and lead_allocate.BidderID  in (" . $AgentID . ") ) ";
    }
    if ($Products == 'HL') {
        return $qryDirect = "SELECT *, " . $feedback_tble . ".BidderID as BidID  FROM " . $feedback_tble . "," . TABLE_REQ_CREDIT_CARD . " LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=" . TABLE_REQ_CREDIT_CARD . ".RequestID AND Req_Feedback_CC.BidderID in (" . $AgentID . ") WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_CREDIT_CARD . ".RequestID and " . $feedback_tble . ".BidderID in (" . $AgentID . ") and " . $feedback_tble . ".Reply_Type=4 and ( " . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Feedback_CC.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')";

    }
    
}
?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title>Credit Card LMS - Dashboard</title>
        <link href="../includes/style1.css" rel="stylesheet" type="text/css">
        <link href="../style.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .OddClass {background-color: #FFF;}
            .EvenClass {background-color: #EEE;}
            table {border-collapse: collapse;}
            table, td, th {border: solid thin #CCC; padding:5px;}
            .lead_wrapper{ width:1000px; margin:20px auto 0px; background:#FFF;}
            .lead_left{ float: left; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:542px; padding-top: 25px;}
            .lead_right{ float:right; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:542px; padding-top: 25px; margin-left:10px;}
            .mr-top25{ margin-top: 25px;}
            .search-lead{width:200px; background:#FFF; margin:25px auto 0px; padding-top: 2px; padding-bottom:2px;}
            .search-lead form{ margin-bottom: 0px;}
            .date-box{width:70%; cursor:pointer; min-height:30px; background: url('images/calendar.gif') right no-repeat; background-position:97%;}
            .button-search{height:29px; border:none; width:23%; padding-left:2px; background:#0274e6; color:#FFF;}
        </style>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <script type="text/javascript">
            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChartTwl);
            function drawChartTwl() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
<?php
$qryAgentsIDResultTwlPie = $obj->fun_db_query($qryAgentsIDTwl);
while ($rowAgentsIDTwl = $obj->fun_db_fetch_rs_object($qryAgentsIDResultTwlPie)) {
    $AgentIDTwlPie = $rowAgentsIDTwl->BidderID;
    $AgentNameTwlPie = $rowAgentsIDTwl->Bidder_Name;
    $qryTwlPie = QueryProcess('Twl', $AgentIDTwlPie);
    $resCountTwlPie = $objAdmin->fun_get_num_rows($qryTwlPie);
    ?>
                        ['<?php echo $AgentIDTwlPie . "[" . $AgentNameTwlPie . "]"; ?>', <?php echo $resCountTwlPie; ?>],
<?php } ?>
                ]);

                var options = {
                    title: 'Two Wheeler - Dialler Lead CC',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_twl'));
                chart.draw(data, options);
            }
        </script>



        <script type="text/javascript">
            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
<?php
$qryAgentsIDResultDirectPie = $obj->fun_db_query($qryAgentsIDDirect);
while ($rowAgentsIDDirect2 = $obj->fun_db_fetch_rs_object($qryAgentsIDResultDirectPie)) {
    $AgentIDDirect = $rowAgentsIDDirect2->BidderID;
    $AgentName = $rowAgentsIDDirect2->Bidder_Name;
    $qryDirect = QueryProcess('Direct', $AgentIDDirect);
    $resCountDirect = $objAdmin->fun_get_num_rows($qryDirect);
    ?>
                        ['<?php echo $AgentIDDirect . "[" . $AgentName . "]"; ?>', <?php echo $resCountDirect; ?>],
<?php } ?>
                ]);

                var options = {
                    title: 'Direct - Dialler Lead CC',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
        </script>

        <script type="text/javascript">
            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChartPre);
            function drawChartPre() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
<?php
$resCountSMSPreAllPie = $obj->fun_db_query($qrySMSPre);
while ($rowSMSPrePie = $obj->fun_db_fetch_rs_object($resCountSMSPreAllPie)) {
    $AgentIDSMSPre = $rowSMSPrePie->BidderID;
    $AgentNamePre = $rowSMSPrePie->Bidder_Name;
    $qrySMSPrePie = QueryProcess('SMSPre', $AgentIDSMSPre);
    $resCountSMSPrePie = $objAdmin->fun_get_num_rows($qrySMSPrePie);
    ?>
                        ['<?php echo $AgentIDSMSPre . "[" . $AgentNamePre . "]"; ?>', <?php echo $resCountSMSPrePie; ?>],
<?php } ?>
                ]);
                var options = {
                    title: 'SMS - Dialler Caller CC Predictive',
                    is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart_Pre'));
                chart.draw(data, options);
            }
        </script>

        <script type="text/javascript">
            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChartSMS);
            function drawChartSMS() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
<?php
$resSMSPie = $obj->fun_db_query($qrySMSNew);
while ($rowSMSPie = $obj->fun_db_fetch_rs_object($resSMSPie)) {
    $AgentIDSMS = $rowSMSPie->BidderID;
    $AgentNameSMS = $rowSMSPie->Bidder_Name;
    $qrySMSAll = QueryProcess('SMS', $AgentIDSMS);
    $resCountSMSPie = $objAdmin->fun_get_num_rows($qrySMSAll);
    ?>
                        ['<?php echo $AgentIDSMS . "[" . $AgentNameSMS . "]"; ?>', <?php echo $resCountSMSPie; ?>],
<?php } ?>
                ]);
                var options = {
                    title: 'SMS - Dialler Lead CC sms New',
                    is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart_SMS'));
                chart.draw(data, options);
            }
        </script>
        
    <script type="text/javascript">
            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChartSMS);
            function drawChartSMS() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
<?php
$resHLPie = $obj->fun_db_query($qryHL);
while ($rowHLPie = $obj->fun_db_fetch_rs_object($resHLPie)) {
    $AgentIDHL = $rowHLPie->BidderID;
    $AgentNameHL = $rowHLPie->Bidder_Name;
    $qryHLAll = QueryProcess('HL', $AgentIDHL);
    $resCountHLPie = $objAdmin->fun_get_num_rows($qryHLAll);
    ?>
                        ['<?php echo $AgentIDHL . "[" . $AgentNameHL . "]"; ?>', <?php echo $resCountHLPie; ?>],
<?php } ?>
                ]);
                var options = {
                    title: 'Dialler HL (Leads)',
                    is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart_HL'));
                chart.draw(data, options);
            }
        </script>      
        
        
        <link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
        <script src="js-datepicker/jquery-1.5.1.js"></script>
        <script src="js-datepicker/jquery.ui.core.js"></script>
        <script src="js-datepicker/jquery.ui.datepicker.js"></script>
        <script>
            $(document).ready(function () {

                var date = new Date();
                var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();

                $('#datepicker').datepicker({
                    minDate: new Date(y - 65, m, d),
                    maxDate: new Date(y - 21, m, d),
                    //yearRange: "+20:+0",
                    dateFormat: 'dd-mm-yy'
                });
            });
            $(function () {
                $("#datepick").datepicker();

            });

        </script> 
    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
        <?php include "header_cc_admin_lms.php"; ?>
        <div class="search-lead">
           <form action="" method="get" name="DateValfrm">
               <input class="date-box" type="text" name="Dateval" id="datepick" value="<?php if($Dateval!="") { echo $Dateval; }else{echo date("Y-m-d");} ?>" />
               <input type="submit" name="Search" value="Search" id="Search" class="button-search" />
            </form> 
            
        </div>
        
        <div class="lead_wrapper">
            <div style="text-align:center;">
            
            </div>
            <div class="lead_left">
                <?php
                $BidderIDstaticArr = '';
                while ($rowAgentsIDAll = $obj->fun_db_fetch_rs_object($qryCheckSMSPreAll)) {
                    $BidderIDstaticArr[] = $rowAgentsIDAll->BidderID;
                }
                $BidderIDsPreAll = implode(',', $BidderIDstaticArr);
                $qrySMSPreAll = QueryProcess('SMSPre', $BidderIDsPreAll);
                $resCountSMSPreAll = $objAdmin->fun_get_num_rows($qrySMSPreAll);
                ?>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="2"><h3>Product Name(SMS - Dialler Caller CC Predictive)</h3><strong>Total Lead Count - <?php echo $resCountSMSPreAll; ?></strong></td>
                    </tr>
                    <tr><td colspan="2">


                            <div id="piechart_Pre"></div>
                        </td></tr>
                    <tr>
                        <td><strong>Agent ID</strong></td>
                        <td><strong>Lead Count</strong></td>
                    </tr>
                    <?php
                    $w = 1;
                    while ($rowSMSPre = $obj->fun_db_fetch_rs_object($qryCheckSMSPre)) {
                        $AgentIDSMSPre = $rowSMSPre->BidderID;
                        $AgentName = $rowSMSPre->Bidder_Name;
                        if ($w % 2 == 1) {
                            $Class = "class=\"OddClass\"";
                        } else {
                            $Class = "class=\"EvenClass\"";
                        }
                        $QuerySMSPre = QueryProcess('SMSPre', $AgentIDSMSPre);
                        $resCountSMSPre = $objAdmin->fun_get_num_rows($QuerySMSPre);
                        $StatusSMSPre = $rowSMSPre->Status;
                        if($StatusSMSPre ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }
                        ?>
                        <tr <?php echo $Class; ?>>
                            <td><?php echo $AgentIDSMSPre; ?>[<?php echo $AgentName; ?>] [<?php echo $status_text;?>]</td>
                            <td><?php echo $resCountSMSPre; ?></td>
                        </tr>
                        <?php
                        $w++;
                    }
                    ?>
                    
                </table> 

            </div>
            <div class="lead_right">
                <?php
                $BidderIDstaticArr = '';
                while ($rowAgentsIDs = $obj->fun_db_fetch_rs_object($qryCheckSMSNew)) {
                    $BidderIDstaticArr[] = $rowAgentsIDs->BidderID;
                }
                $BidderIDsAll = implode(',', $BidderIDstaticArr);
                $qrySMSAll = QueryProcess('SMS', $BidderIDsAll);
                $resCountSMSAll = $objAdmin->fun_get_num_rows($qrySMSAll);
                ?>
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td colspan="2"><h3>Product Name(SMS - Dialler Lead CC sms New) </h3> <strong>Total Lead Count - <?php echo $resCountSMSAll; ?></strong></td>
                    </tr>
                      <tr><td colspan="2">
                            <div id="piechart_SMS"></div>
                        </td></tr>
                    <tr>
                        <td><strong>Agent ID</strong></td>
                        <td><strong>Lead Count</strong></td>
                    </tr>
                    <?php
                    $w = 1;
                    while ($rowSMS = $obj->fun_db_fetch_rs_object($qryCheckSMS)) {
                        if ($w % 2 == 1) {
                            $Class = "class=\"OddClass\"";
                        } else {
                            $Class = "class=\"EvenClass\"";
                        }

                        $AgentIDSMS = $rowSMS->BidderID;
                        $AgentName = $rowSMS->Bidder_Name;

                        $qrySMS = QueryProcess('SMS', $AgentIDSMS);
                        $resCountSMS = $objAdmin->fun_get_num_rows($qrySMS);
                         $StatusSMS = $rowSMS->Status;
                        if($StatusSMS ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }
                        ?>
                        <tr <?php echo $Class; ?>>
                            <td><?php echo $AgentIDSMS; ?>[<?php echo $AgentName; ?>] [<?php echo $status_text;?>]</td>
                            <td><?php echo $resCountSMS; ?></td>
                        </tr>
                        <?php
                        $w++;
                    }
                    ?>
                  
                </table> 
            </div>
            <div style="clearfix"></div>
            <div class="lead_left mr-top25">
                <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td colspan="2"><h3>Product Name(Two Wheeler)</h3></td>
                    </tr>
                    <tr><td colspan="2">
                            <div id="piechart_twl"></div>
                        </td></tr>
                    <tr>
                        <td><strong>Agent ID</strong></td>
                        <td><strong>Lead Count</strong></td>
                    </tr>
                    <?php
                    $w = 1;
                    while ($rowAgentsIDTwl = $obj->fun_db_fetch_rs_object($qryAgentsIDResultTwl)) {
                        if ($w % 2 == 1) {
                            $Class = "class=\"OddClass\"";
                        } else {
                            $Class = "class=\"EvenClass\"";
                        }

                        $AgentIDTwl = $rowAgentsIDTwl->BidderID;
                        $AgentName = $rowAgentsIDTwl->Bidder_Name;
                        $qryTwl = QueryProcess('Twl', $AgentIDTwl);
                        $resCountTwl = $objAdmin->fun_get_num_rows($qryTwl);
                        $StatusTwl = $rowAgentsIDTwl->Status;
                        if($StatusTwl ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }
                        ?>
                        <tr <?php echo $Class; ?>>
                            <td><?php echo $AgentIDTwl; ?> [<?php echo $AgentName; ?>]  [<?php echo $status_text;?>]</td>
                            <td><?php echo $resCountTwl; ?></td>
                        </tr>
                        <?php
                        $w++;
                    }
                    ?>
                    
                </table>    
            </div>
            <div class="lead_right mr-top25">
                <?php
                $BidderIDstaticArr = '';
                while ($rowAgentsIDDirectAll = $obj->fun_db_fetch_rs_object($qryAgentsIDResultDirectAll)) {
                    $BidderIDstaticArr[] = $rowAgentsIDDirectAll->BidderID;
                }
                $BidderIDsDirectAll = implode(',', $BidderIDstaticArr);
                $qryDirectAll = QueryProcess('Direct', $BidderIDsDirectAll);
                $resCountDirectAll = $objAdmin->fun_get_num_rows($qryDirectAll);
                ?>                
                <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td colspan="2"><h3>Product Name(Direct)</h3> <strong>Total Lead Count - <?php echo $resCountDirectAll; ?></strong></td>
                    </tr>
                     <tr><td colspan="2">
                            <div id="piechart_3d"></div>
                        </td></tr>
                    <tr>
                        <td><strong>Agent ID</strong></td>
                        <td><strong>Lead Count</strong></td>
                    </tr>
                    <?php
                    $w = 1;
                    while ($rowAgentsIDDirect = $obj->fun_db_fetch_rs_object($qryAgentsIDResultDirect)) {
                        if ($w % 2 == 1) {
                            $Class = "class=\"OddClass\"";
                        } else {
                            $Class = "class=\"EvenClass\"";
                        }
                        $AgentIDDirect = $rowAgentsIDDirect->BidderID;
                        $AgentName = $rowAgentsIDDirect->Bidder_Name;
                        $qryDirect = QueryProcess('Direct', $AgentIDDirect);
                        $resCountDirect = $objAdmin->fun_get_num_rows($qryDirect);
                        $StatusDirect = $rowAgentsIDDirect->Status;
                        if($StatusDirect ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }
                        
                        ?>
                        <tr <?php echo $Class; ?>>
                            <td><?php echo $AgentIDDirect; ?>[<?php echo $AgentName; ?>] [<?php echo $status_text;?>]</td>
                            <td><?php echo $resCountDirect; ?></td>
                        </tr>
                        <?php
                        $w++;
                    }
                    ?>                    
                   
                </table> 
            </div>

 <div class="lead_right mr-top25">
                <?php
                $BidderIDstaticArr = '';
                while ($rowAgentsIDHLAll = $obj->fun_db_fetch_rs_object($qryCheckHLNew)) {
                    $BidderIDstaticArr[] = $rowAgentsIDHLAll->BidderID;
                }
                $BidderIDsHLAll = implode(',', $BidderIDstaticArr);
             	$qryHLAll = QueryProcess('HL', $BidderIDsHLAll);
                $resCountHLAll = $objAdmin->fun_get_num_rows($qryHLAll);
                ?>                
                <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td colspan="2"><h3>Product Name(HL Leads)</h3> <strong>Total Lead Count - <?php echo $resCountHLAll; ?></strong></td>
                    </tr>
                     <tr><td colspan="2">
                            <div id="piechart_HL"></div>
                        </td></tr>
                    <tr>
                        <td><strong>Agent ID</strong></td>
                        <td><strong>Lead Count</strong></td>
                    </tr>
                    <?php
                    $w = 1;
                    while ($rowAgentsIDHL = $obj->fun_db_fetch_rs_object($qryCheckHL)) {
                        if ($w % 2 == 1) {
                            $Class = "class=\"OddClass\"";
                        } else {
                            $Class = "class=\"EvenClass\"";
                        }
                        $AgentIDHL = $rowAgentsIDHL->BidderID;
                        $AgentName = $rowAgentsIDHL->Bidder_Name;
                        $qryHL = QueryProcess('HL', $AgentIDHL);
                        $resCountHL = $objAdmin->fun_get_num_rows($qryHL);
                        $StatusHL = $rowAgentsIDHL->Status;
                        if($StatusHL ==1) {$status_text = "Enabled"; } else { $status_text = "Disabled"; }
                        
                        ?>
                        <tr <?php echo $Class; ?>>
                            <td><?php echo $AgentIDHL; ?>[<?php echo $AgentName; ?>] [<?php echo $status_text;?>]</td>
                            <td><?php echo $resCountHL; ?></td>
                        </tr>
                        <?php
                        $w++;
                    }
                    ?>                    
                   
                </table> 
            </div>

        </div>


    </body>
</html>
