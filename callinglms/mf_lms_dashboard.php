<?php
require_once("includes/application-top-inner.php");
define("TABLE_REQ_MF", "Req_Mutual_Fund");
define("ADMIN_TITLE","Mutual Fund LMS");


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
// Direct
$qryAgentsIDDirect = "SELECT BidderID,Bidder_Name FROM Bidders where leadidentifier in ('mutualfundslms')";
$qryAgentsIDResultDirect = $obj->fun_db_query($qryAgentsIDDirect);
$qryAgentsIDResultDirectAll = $obj->fun_db_query($qryAgentsIDDirect); // All BiiderIds

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
  
    if ($Products == 'mf') {
        $feedback_tble = "lead_allocate";
        return $qryDirect = "SELECT *, " . $feedback_tble . ".BidderID as BidID  FROM " . $feedback_tble . "," . TABLE_REQ_MF . " LEFT OUTER JOIN Req_Feedback_MF ON Req_Feedback_MF.AllRequestID=" . TABLE_REQ_MF . ".RequestID AND Req_Feedback_MF.BidderID in (" . $AgentID . ") WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_MF . ".RequestID and " . $feedback_tble . ".BidderID in (" . $AgentID . ") and " . $feedback_tble . ".Reply_Type=11 and ( " . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Feedback_MF.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "')";
    }   
}
?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title><?=ADMIN_TITLE;?> - Dashboard</title>
        <link href="../includes/style1.css" rel="stylesheet" type="text/css">
        <link href="../style.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .OddClass {background-color: #FFF;}
            .EvenClass {background-color: #EEE;}
            table {border-collapse: collapse;}
            table, td, th {border: solid thin #CCC; padding:5px;}
            .lead_wrapper{ width:510px; margin:20px auto 0px; background:#FFF;}
            .lead_left{ float: left; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:542px; padding-top: 25px;}
            .lead_right{ float:right; width:47%; padding-left: 10px; padding-right:10px; background:#FFF; min-height:542px; padding-top: 25px; margin-left:10px;}
            .lead_center{ width:500px; background:#FFF; margin:25px auto 0px; padding-top: 2px; padding-bottom:2px;}
            .mr-top25{ margin-top: 25px;}
            .search-lead{width:200px; background:#FFF; margin:25px auto 0px; padding-top: 2px; padding-bottom:2px;}
            .search-lead form{ margin-bottom: 0px;}
            .date-box{width:70%; cursor:pointer; min-height:30px; background: url('images/calendar.gif') right no-repeat; background-position:97%;}
            .button-search{height:29px; border:none; width:23%; padding-left:2px; background:#0274e6; color:#FFF;}
        </style>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



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
    $qryDirect = QueryProcess('mf', $AgentIDDirect);
    $resCountDirect = $objAdmin->fun_get_num_rows($qryDirect);
    ?>
                        ['<?php echo $AgentIDDirect . "[" . $AgentName . "]"; ?>', <?php echo $resCountDirect; ?>],
<?php } ?>
                ]);

                var options = {
                    title: 'Mutual Fund',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
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
        <?php include "header_mf_admin_lms.php"; ?>
        <div class="search-lead">
           <form action="" method="get" name="DateValfrm">
               <input class="date-box" type="text" name="Dateval" id="datepick" value="<?php if($Dateval!="") { echo $Dateval; }else{echo date("Y-m-d");} ?>" />
               <input type="submit" name="Search" value="Search" id="Search" class="button-search" />
            </form> 
            
        </div>
        
        <div class="lead_wrapper">
            <div style="text-align:center;">
            
            </div>
            
            <div class="lead_center">
                <?php
                $BidderIDstaticArr = '';
                while ($rowAgentsIDDirectAll = $obj->fun_db_fetch_rs_object($qryAgentsIDResultDirectAll)) {
                    $BidderIDstaticArr[] = $rowAgentsIDDirectAll->BidderID;
                }
                $BidderIDsDirectAll = implode(',', $BidderIDstaticArr);
                $qryDirectAll = QueryProcess('mf', $BidderIDsDirectAll);
                $resCountDirectAll = $objAdmin->fun_get_num_rows($qryDirectAll);
                ?>                
                <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td colspan="2"><h3>Product Name(Mutual Fund)</h3> <strong>Total Lead Count - <?php echo $resCountDirectAll; ?></strong></td>
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
                        $qryDirect = QueryProcess('mf', $AgentIDDirect);
                        $resCountDirect = $objAdmin->fun_get_num_rows($qryDirect);
                        ?>
                        <tr <?php echo $Class; ?>>
                            <td><?php echo $AgentIDDirect; ?>[<?php echo $AgentName; ?>]</td>
                            <td><?php echo $resCountDirect; ?></td>
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
