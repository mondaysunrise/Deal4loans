<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);
$Dateval = $_REQUEST['Dateval'];
if ($Dateval != "") {
    $min_date = $Dateval . " 00:00:00";
    $max_date = $Dateval . " 23:59:59";
} else {
    $min_date = date("Y-m-d 00:00:00");
    $max_date = date("Y-m-d 23:59:59");
}
$qryCheck = "SELECT BidderID, leadidentifier,Process_Name FROM Bidders where leadidentifier in ('CallerAccountBTata','CallerAccountCFL','CallerAccountICICI','CallerAccountIIFL','CallerAccountMICICI','CallerAccountMTata','CallerAccountOICICI','CallerAccountCICICI','CallerAccountRBLDMP','CallerAccountRBLBHC','CallerAccountRBLDH','CallerAccountINDUSINDBCH','CallerAccountINDUSINDDMP','CallerAccountDialingDMP','CallerAccountDialingBCH','CallerAccountQBERABCD','CallerAccountCTata','CallingIncredDM','PL_ICICI_BCDHKMP','tatacapitalcalling','ICICISALAccount','CallerAccountQBERAMETRO','CallerAccountCFLAllCity','CallerAccountINDUSINDALL','CallerAccountRBLMCK','CallerAccountICICIBangalore','tatacapitalBcalling','CallerAccountAPKTata') group by leadidentifier";//'CallerAccountCity',  
$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
$qryCheckResult = $obj->fun_db_query($qryCheck);

function getReqValue1($pKey){
	$titles = array(
        '1' => 'Req_Loan_Personal'
            );
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;
	return "";
  }


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
    
    if ($Products == 'PLLEADCNT') {
     $productVal=1;
$val = getReqValue1($productVal);
$pro_code=$productVal;
        
        $qry="SELECT * FROM client_lead_allocate,".$val."  WHERE (client_lead_allocate.BidderID in(".$AgentID.") and client_lead_allocate.Reply_Type=".$pro_code." and client_lead_allocate.AllRequestID=`".$val."`.RequestID and (client_lead_allocate.Allocation_Date Between '".($min_date)."' and '".($max_date)."' or client_lead_allocate.Followup_Date Between '".($min_date)."' and '".($max_date)."'))";
	$qry=$qry.$FeedbackClause." ".$citywise_clause." ".$mob_num_clause." ".$refernce_no_clause." ".$Primary_AccClause;
              return $qry=$qry."group by ".$val.".Mobile_Number";
    }
}
?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title>Personal Loan LMS - Dashboard</title>
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
        <?php include "header_pl_admin_lms.php"; ?>
        <div class="search-lead">
           <form action="" method="get" name="DateValfrm">
               <input class="date-box" type="text" name="Dateval" id="datepick" value="<?php if($Dateval!="") { echo $Dateval; }else{echo date("Y-m-d");} ?>" />
               <input type="submit" name="Search" value="Search" id="Search" class="button-search" />
            </form> 
            
        </div>
        
        <div class="lead_wrapper">
            <div style="text-align:center;">
                <table border="1" width="100%">
                    <tr>                   
 <?php
$i=0;
while($row = $obj->fun_db_fetch_rs_object($qryCheckResult))
    {
        $qryAgentsID = "SELECT BidderID,Bidder_Name,Process_Name FROM Bidders where leadidentifier in ('".$row->leadidentifier."')";
$qryAgentsIDResult = $obj->fun_db_query($qryAgentsID);
$qryAgentsIDResultAll = $obj->fun_db_query($qryAgentsID);
if($i%2==0)
{
    echo "</tr><tr>";
}
 
?>
                        
     <script type="text/javascript">
            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChartSMS);
            function drawChartSMS() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
<?php
$resSMSPie = $obj->fun_db_query($qryAgentsID);
while ($rowSMSPie = $obj->fun_db_fetch_rs_object($resSMSPie)) {
    $AgentIDSMS = $rowSMSPie->BidderID;
    $AgentNameSMS = $rowSMSPie->Bidder_Name;
    $qrySMSAll = QueryProcess('PLLEADCNT', $AgentIDSMS);
    $resCountSMSPie = $objAdmin->fun_get_num_rows($qrySMSAll);
    ?>
                        ['<?php echo $AgentIDSMS . "[" . $AgentNameSMS . "]"; ?>',<? echo $resCountSMSPie; ?>],
<?php } ?>
                ]);
                var options = {
                    title: 'Personal Loan',
                    is3D: true,
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart_<?php echo $i?>'));
                chart.draw(data, options);
            }
        </script>                   
                        
                        
                        
                         <?php
                $BidderIDstaticArr = '';
                while ($rowAgentsIDAll = $obj->fun_db_fetch_rs_object($qryAgentsIDResultAll)) {
                    $BidderIDstaticArr[] = $rowAgentsIDAll->BidderID;
                }
                $BidderIDsPreAll = implode(',', $BidderIDstaticArr);
                $qryAll = QueryProcess('PLLEADCNT', $BidderIDsPreAll);
                $resCountAllTotal = $objAdmin->fun_get_num_rows($qryAll);
                ?>
                      <td>
                        <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                        <td colspan="2"><h3>Product Name (<?php echo $row->Process_Name; ?>)</h3> <strong>Total Lead Count - <?php echo $resCountAllTotal; ?></strong></td>
                    </tr>
                     <tr><td colspan="2">
                            <div id="piechart_<?php echo $i?>"></div>
                        </td></tr>
                    <tr>
                        <td><strong>Agent ID</strong></td>
                        <td><strong>Lead Count</strong></td>
                    </tr>
                    <?php
                    $w = 1;
                    while ($rowAgentsID = $obj->fun_db_fetch_rs_object($qryAgentsIDResult)) {
                        if ($w % 2 == 1) {
                            $Class = "class=\"OddClass\"";
                        } else {
                            $Class = "class=\"EvenClass\"";
                        }
                        $AgentIDVal = $rowAgentsID->BidderID;
                        $AgentName = $rowAgentsID->Bidder_Name;
                        $qryGet = QueryProcess('PLLEADCNT', $AgentIDVal);
                        $resCount = $objAdmin->fun_get_num_rows($qryGet);
                        
                        ?>
                        <tr <?php echo $Class; ?>>
                            <td><?php echo $AgentIDVal; ?>[<?php echo $AgentName; ?>]</td>
                            <td><?php echo $resCount; ?></td>
                        </tr>
                        <?php
                        $w++;
                    }
                    ?>                    
                   
                </table> 
                        
                        </td>
                       
                   
    <?php $i++;}?>
             </tr>        
                </table>
            </div>
         
                   
        </div>
    </body>
</html>
