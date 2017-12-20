<?php
require_once("includes/application-topbl.php");
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if ($IP_Remote == '192.124.249.12' || $IP_Remote == '185.93.228.12') {
    $IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
} else {
    $IP = $IP_Remote;
}

$qryCheck = "SELECT BidderID FROM Bidders where leadidentifier = 'MISBL' and BidderID='" . $_SESSION["BidderID"] . "'";
$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
$qryCheckResult = $obj->fun_db_query($qryCheck);
if ($resCountCheck > 0 && ($IP == "122.176.100.27" || $IP == "122.176.100.28" || $IP == "122.176.122.134" || $IP == "122.161.196.68" || $IP == "122.160.30.168" || $IP == "180.188.224.34" || $IP == "122.160.74.241" || $IP == "122.160.74.235" || $IP == "182.73.4.60" || $IP == "180.151.74.83" || $IP == "115.249.245.30" || $IP == "182.71.109.218" || $IP == "185.93.231.12" || $IP == "113.193.239.185" || $IP == "122.176.54.210" || $IP == "125.99.91.234" || $IP == "122.176.77.240" || $IP == "122.176.77.79" || $IP == "122.180.253.3" || $IP == "122.176.54.194" )) {
    $rowqryCheck = $obj->fun_db_fetch_rs_object($qryCheckResult);
    $source = $rowqryCheck->source;
} else {
    echo "Not a Valid User";
    echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/callinglms/login.php">';
    die();
}
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
$BidderIDstatic = "";
if (isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic']) > 0) {
    $BidderIDstatic = $_REQUEST['BidderIDstatic'];
}

if (isset($BidderIDstatic) && strlen($_REQUEST['BidderIDstatic']) > 0) {
    $_SESSION["BidderID"] = $BidderIDstatic;
}

function ccMasking($number, $maskingCharacter = 'X') {
    return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

$salaryclause = "";
if (isset($_REQUEST['salaryrange'])) {
    $salaryclause = $_REQUEST['salaryrange'];
}
$dwlndtomorrow = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
$daydwlnd = date('Y-m-d', $dwlndtomorrow);

$val = "Req_Loan_Personal";

$FeedbackClause = "";
//$OrderBy=" order by Req_Loan_Personal.Dated desc";
$ref_num = "";
if (isset($_REQUEST['ref_num'])) {
    $ref_num = $_REQUEST['ref_num'];
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
$pro_code = $_SESSION['product'];
$pro_code = 1;
//	$val= getTableName($_SESSION['product']);
$refernce_no = "";
if (isset($_REQUEST['refernce_no'])) {
    $refernce_no = $_REQUEST['refernce_no'];
}

$Campaign = "";
if (isset($_REQUEST['Campaign'])) {
    $Campaign = $_REQUEST['Campaign'];
}
$Agents = '';
if (isset($_REQUEST['Agents'])) {
    $Agents = $_REQUEST['Agents'];
}
$CityName = '';
if (isset($_REQUEST['CityName'])) {
    $CityName = $_REQUEST['CityName'];
}
/**
 * @author Yaswant Chauhan <yaswant.chauhan@deal4loans.com>
 */
if (isset($_POST['SaveReallocate'])) {
    $leadID = $_REQUEST['leadID'];
    $PrevAgentID = $_REQUEST['PrevAgentID'];
    $UpdateAgent = "UPDATE lead_allocate SET BidderID ='" . $_REQUEST['reAllocate'] . "', Allocated='" . $PrevAgentID . "'  WHERE leadid='" . $leadID . "'";
    $qryAgentsIDResult = $obj->fun_db_query($UpdateAgent);
}
?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us" />
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252" />
        <title>Login</title>
        <script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
        <link href="../includes/style1.css" rel="stylesheet" type="text/css" />
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
        <link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css" />
        <script src="js-datepicker/jquery-1.5.1.js"></script>
        <script src="js-datepicker/jquery.ui.core.js"></script>
        <script src="js-datepicker/jquery.ui.datepicker.js"></script>
        <script>
            $(function () {
                var dates = $("#min_date, #max_date").datepicker({
                    defaultDate: "-1",
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

        <!--Date Picker End-->
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
        </script>

        <style type="text/css">
            .discennect-row{ background:#FFF; padding:10px; border-radius:5px; width:600px; margin:auto; font-family:Arial, Helvetica, sans-serif;}
            .diler-status-select{padding:10px; border:thin solid #CCC; width:200px;}
            .disconnect-btn{ padding:10px; border-radius:5px; color:#FFF; text-align:center; background:#06C; text-decoration:none;}
        </style>
    </head>
    <body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
        <?php
        include 'bl-mis-menu.php';
        ?>
        <div style="clear:both; height:15px;"></div>
        <div> 
            <table width="98%" border="0">
                 <!-- <tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID']; ?>&product=1" target="_blank">today's Report</a></td></tr>-->
                <tr>
                    <td align="right"></td>
                </tr>
                <tr>
                    <td align="center" width="100%"><div align="center">

                            <form name="frmsearch" action="lms_mis_bl_index_reallocate.php" method="get" onSubmit="return chkform();">
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
                                            <input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" ></td>
                                        <td width="13%" style="text-align:right;">To</td>
                                        <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>">
                                            <input type="hidden" name="cmbfeedback" id="cmbfeedback" value="All" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Agents:</strong></td>
                                        <td>
                                            <span id="name_agents">
                                                <?php
                                                $qryCheck1 = "SELECT BidderID, Bidder_Name, Status FROM Bidders where leadidentifier in ('agent_othermetros','blmainlms') and leadidentifier!=''";
                                                $recordcount = $objAdmin->fun_get_num_rows($qryCheck1);
                                                $qryCheckResult1 = $obj->fun_db_query($qryCheck1);
                                                $status_text = '';
                                                ?>
                                                <select name="Agents" id="Agents" ><?php if ($recordcount > 0) { ?><option value="All" <?
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
                                                    } else {
                                                        echo '<option value="">Please Select</option>';
                                                    }
                                                    ?></select>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                  <td width="12%"><strong>Feedback:</strong></td>
                  <td width="29%"><select name="cmbfeedback" id="cmbfeedback">
                      <option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
					  <option value="" <? if($varCmbFeedback == "") { echo "selected"; }?>>No Feedback</option>
					<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
					<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; }?>>Callback Later</option><option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
   				<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
					<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
					<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
					
					<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; }?> >Other Product</option>
					<option value="Duplicate" <? if($varCmbFeedback == "Duplicate") { echo "selected"; }?> >Duplicate</option>
				
                	<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; }?> >Not Contactable</option>
					<option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; }?> >Not Applied</option>
                   <option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; }?>>Send Now</option>
                    </select>
                    </td>
                    <td width="29%" align="center"  valign="middle" class="bidderclass"><strong>City:</strong></td>
                    <td width="58%"  valign="middle" class="bidderclass">
                    <select name="CityName">
                   <option value="AllCity">All</option>     
    <optgroup label="Metro Cities">Metro Cities</optgroup> 
    <option value="Delhi" <?php if($CityName=='Delhi'){ echo "selected";}?>>Delhi</option>
    <option value="Noida" <?php if($CityName=='Noida'){ echo "selected";}?>>Noida</option>
    <option value="Gaziabad" <?php if($CityName=='Gaziabad'){ echo "selected";}?>>Gaziabad</option>
    <option value="Faridabad" <?php if($CityName=='Faridabad'){ echo "selected";}?>>Faridabad</option>
    <option value="Sahibabad" <?php if($CityName=='Sahibabad'){ echo "selected";}?>>Sahibabad</option>
    <option value="Gurgaon" <?php if($CityName=='Gurgaon'){ echo "selected";}?>>Gurgaon</option>
    <option value="Ahmedabad" <?php if($CityName=='Ahmedabad'){ echo "selected";}?>>Ahmedabad</option>
    <option value="Bangalore" <?php if($CityName=='Bangalore'){ echo "selected";}?>>Bangalore</option>
    <option value="Chennai" <?php if($CityName=='Chennai'){ echo "selected";}?>>Chennai</option>
    <option value="Hyderabad" <?php if($CityName=='Hyderabad'){ echo "selected";}?>>Hyderabad</option>
    <option value="Kolkata" <?php if($CityName=='Kolkata'){ echo "selected";}?>>Kolkata</option>
    <option value="Pune" <?php if($CityName=='Pune'){ echo "selected";}?>>Pune</option>
    <option value="Surat" <?php if($CityName=='Surat'){ echo "selected";}?>>Surat</option>
    <option value="Mumbai" <?php if($CityName=='Mumbai'){ echo "selected";}?>>Mumbai</option>
    <option value="Thane" <?php if($CityName=='Thane'){ echo "selected";}?>>Thane</option>
    <option value="Navi Mumbai" <?php if($CityName=='Navi Mumbai'){ echo "selected";}?>>Navi Mumbai</option>
    <option value="Jaipur" <?php if($CityName=='Jaipur'){ echo "selected";}?>>Jaipur</option>
    <optgroup label="Emerging Cities">Emerging Cities</optgroup> 
    <option value="Ahmednagar" <?php if($CityName=='Ahmednagar'){ echo "selected";}?>>Ahmednagar</option>
    <option value="Aurangabad" <?php if($CityName=='Aurangabad'){ echo "selected";}?>>Aurangabad</option>
    <option value="Baroda" <?php if($CityName=='Baroda'){ echo "selected";}?>>Baroda</option>
    <option value="Bhopal" <?php if($CityName=='Bhopal'){ echo "selected";}?>>Bhopal</option>
    <option value="Bhubaneshwar" <?php if($CityName=='Bhubaneshwar'){ echo "selected";}?>>Bhubaneshwar</option>
    <option value="Chandigarh" <?php if($CityName=='Chandigarh'){ echo "selected";}?>>Chandigarh</option>
    <option value="Coimbatore" <?php if($CityName=='Coimbatore'){ echo "selected";}?>>Coimbatore</option>
    <option value="Jalandhar" <?php if($CityName=='Jalandhar'){ echo "selected";}?>>Jalandhar</option>
    <option value="Jodhpur" <?php if($CityName=='Jodhpur'){ echo "selected";}?>>Jodhpur</option>
    <option value="Ludhiana" <?php if($CityName=='Ludhiana'){ echo "selected";}?>>Ludhiana</option>
    <option value="Nagpur" <?php if($CityName=='Nagpur'){ echo "selected";}?>>Nagpur</option>
    <option value="Rajkot" <?php if($CityName=='Rajkot'){ echo "selected";}?>>Rajkot</option>
    <option value="Udaipur" <?php if($CityName=='Udaipur'){ echo "selected";}?>>Udaipur</option>
    <option value="Vadodara" <?php if($CityName=='Vadodara'){ echo "selected";}?>>Vadodara</option>
    <option value="Nasik" <?php if($CityName=='Nasik'){ echo "selected";}?>>Nasik</option>
</select>
                        
                    </td>
                   
                   <!---<td width="29%" align="center"  valign="middle" class="bidderclass">Search with Ref Number</td>
	  <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" >-->
</td>
                </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td colspan="3" align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
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
                                $fbqry = "select FeedbackID from Req_Feedback_PL where AllRequestID=$RequestID and BidderID=" . $_SESSION['BidderID'] . " AND Reply_Type=1";
                                $result = $obj->fun_db_query($fbqry);

                                $num_rows = $obj->fun_db_get_num_rows($result);
                                if ($num_rows > 0) {
                                    $row = $obj->fun_db_fetch_rs_array($result);
                                    $strSQL = "Update Req_Feedback_PL Set Feedback='" . $Feedback . "' ";
                                    $strSQL = $strSQL . "Where FeedbackID=" . $row["FeedbackID"];
                                } else {
                                    $strSQL = "Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
                                    $strSQL = $strSQL . $RequestID . "," . $_SESSION['BidderID'] . ",'1','" . $Feedback . "')";
                                }

//echo $strSQL;
                                $result = $obj->fun_db_query($strSQL);
                                if ($result == 1) {
                                    
                                } else {
                                    $Msg = "** There was a problem in adding your feedback. Please try again.";
                                }
                            }
                            if ($search == "y") {
                                $feedback_tble = "lead_allocate";
                                $min_dateonly = $min_date;
                                $max_dateonly = $max_date;
                                $min_date = $min_date . " 00:00:00";
                                $max_date = $max_date . " 23:59:59";

                                if (strlen(trim($varCmbFeedback)) == 0) {
                                    $FeedbackClause = " AND (Req_Feedback_PL.Feedback IS NULL OR Req_Feedback_PL.Feedback='' OR Req_Feedback_PL.Feedback='No Feedback') ";
                                } else if ($varCmbFeedback == "All") {
                                    $FeedbackClause = " ";
                                } else {
                                    $FeedbackClause = " AND Req_Feedback_PL.Feedback='" . $varCmbFeedback . "' ";
                                }

                                if (strlen($refernce_no) > 3) {
                                    list($requestidno, $bidderid) = split('[S]', $refernce_no);
                                    $appdtxt = "BL";
                                    $refernce_no_section = str_replace($appdtxt, "", $requestidno);
                                    $refernce_no_clause = " AND " . TABLE_REQ_LOAN_PERSONAL . ".RequestID = '" . $refernce_no_section . "' ";
                                }
                                ?>       <p class="bodyarial11">
                                    <?= $Msg ?>
                                </p>
                                <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
                                <table width="1024" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
                                    <?
                                    $srh_qry = "";
                                    if ($ref_num > 0) {
                                        $ref_num_clause = " AND " . TABLE_REQ_LOAN_PERSONAL . ".Mobile_Number = '" . $ref_num . "' ";
                                    }

                                    if ($Agents == "All") {
                                        $qryAgentsID = "SELECT BidderID FROM Bidders where leadidentifier in ('agent_othermetros','blmainlms')";
                                        //echo $qryAgentsID."<br>";
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

                                    if($CityName=="AllCity")
                                    {
                                       $CityVal = "";
                                    }else{
                                       $CityVal = " AND (".TABLE_REQ_LOAN_PERSONAL.".City='".$CityName."')"; 
                                    }

//			RequestID,Name,Net_Salary,Loan_Amount,City,Employment_Status,City_Other,Feedback, Followup_Date, Dated,Add_Comment
                                    $qry = "SELECT RequestID," . $feedback_tble . ".BidderID AS AgentID, Name, Mobile_Number, Net_Salary as NetProfit, Annual_Turnover, Loan_Amount,City,City_Other,Total_Experience as Vintage, Company_Type as TypeofCompany, Feedback, Followup_Date, Dated,Add_Comment as Comment, Residential_Status as Residential_Status, Loan_Any,leadid  FROM " . $feedback_tble . "," . TABLE_REQ_LOAN_PERSONAL . " LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=" . TABLE_REQ_LOAN_PERSONAL . ".RequestID AND Req_Feedback_PL.BidderID in (" . $BidderIDstatic . ") WHERE " . $feedback_tble . ".AllRequestID=" . TABLE_REQ_LOAN_PERSONAL . ".RequestID and " . $feedback_tble . ".BidderID in (" . $BidderIDstatic . ") and ( " . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Feedback_PL.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') ";
                                    $qry = $qry . $FeedbackClause . " " . $ref_num_clause . " " . $CityVal;
                                    $qry = $qry . " group by " . $val . ".Mobile_Number";


                                    $srh_qry = $qry;

//echo $srh_qry;
                                    $resCount = $objAdmin->fun_get_num_rows($qry);
                                    if ($resCount > $limit) {
                                        $pagelinks = paginate($limit, $resCount);
                                    }

                                    $qry.= " order by Allocation_Date DESC LIMIT $start,$limit ";
//echo $qry;
                                    $result = $obj->fun_db_query($qry);
                                    ?>
                                    <tr>
                                        <td colspan="11"><strong><? echo $start + 1; ?> to <? echo $start + $limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="head1">Ref ID</td>

                                        <td class="head1">Agent ID</td>
                                        <td class="head1">Name</td>
                                        <td class="head1">Salary</td>
                                        <td class="head1">Loan Amount</td>
                                        <td class="head1">City</td>
                                      <!--  <td class="head1" style="width: 79px">Emp stat</td>-->
                                        <td class="head1" style="width: 79px">Lead Date</td>
                                        <td class="head1" style="width: 121px">Feedback</td>                
                                        <td class="head1" style="width: 136px">FollowUp date</td>               
                                        <td class="head1">Comments</td>
                                        <td class="head1">Re Allocate</td>

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

                                            if ($color % 2 != 0) {
                                                $colorvar = "#FFF";
                                            } else {
                                                $colorvar = "#EEE";
                                            }
                                            ?>

                                            <tr  bgcolor="<?php echo $colorvar; ?>">	
                                                <td class="bodyarial11"><?php echo $uniqueid = "BL" . $row->RequestID . "S" . $row->AgentID; ?></td>
                                                <td class="bodyarial11"><?php echo $row->AgentID; ?></td>
                                                <td class="bodyarial11"><?php $RequestID = $row->RequestID; ?>
                                                <? echo $row->Name; ?></td>
                                                <td class="bodyarial11"><? echo $row->NetProfit; ?></td>
                                                <td class="bodyarial11"><? echo $row->Loan_Amount; ?></td>
                                                <td class="bodyarial11"><? echo $row->City; ?></td>
                                        <!--	<td class="bodyarial11" style="width: 79px"><?
                                                if ($Employment_Status == 1) {
                                                    echo "Salaried";
                                                } else {
                                                    echo "Self Employed";
                                                }
                                                ?></td>-->
                                                <td class="bodyarial11"><? echo $row->Dated; ?></td>
                                                    <?
                                                    if ($row->City == "Others") {
                                                        $City = $row->City_Other;
                                                    } else {
                                                        $City = $row->City;
                                                    }
                                                    ?>              
                                                <td class="bodyarial11" style="width: 121px">
            <? echo $row->Feedback; ?>
                                                </td> 
                                                <td class="bodyarial11" style="width: 136px"><? echo $Followup_Date; ?></td>
                                                <td class="bodyarial11"><textarea readonly="readonly" rows="2" cols="30"><? echo $row->Comment; ?></textarea></td>
                                                <td class="bodyarial11">
                                                    <form name="reallocatefrm" action="" method="post">
                                                        <input type="hidden" name="leadID" value="<?php echo $row->leadid; ?>"/>
                                                        <input type="hidden" name="PrevAgentID" value="<?php echo $row->AgentID; ?>"/>
                                                        <select name="reAllocate" id="reAllocate">
                                                            <option value="">Select Agent ID</option>
                                                            <?php
                                                            $AgentsIDQury = "SELECT BidderID,Bidder_Name FROM Bidders where leadidentifier in ('agent_othermetros','blmainlms') and BidderID NOT IN (" . $row->AgentID . ")";
                                                            $AgentsIDCount = $objAdmin->fun_get_num_rows($AgentsIDQury);
                                                            $AgentsIDRes = $obj->fun_db_query($AgentsIDQury);
                                                            while ($AgentsIDRows = $obj->fun_db_fetch_rs_object($AgentsIDRes)) {
                                                                $AgentsIDval = $AgentsIDRows->BidderID;
                                                                $Bidder_Name = $AgentsIDRows->Bidder_Name;
                                                                ?>
                                                                <option value="<?php echo $AgentsIDval; ?>" <?php
                                                    if ($AgentsIDval == $row->AgentID) {
                                                        echo "selected";
                                                    }
                                                    ?>><?php echo $AgentsIDval . " - " . $Bidder_Name; ?></option>
                                            <? } ?>
                                                        </select>
                                                        <input type="submit" name="SaveReallocate" value="Save" />
                                                    </form>
                                                </td>
            <?php
            $RequestID = $row->RequestID;
            ?>	
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

    <?php
    if ($resCount <= 5000) {
        ?>
                                    <br>
                                    <table  border="0" cellpadding="5" cellspacing="1" align="center">
                                        <tr>
                                            <td style="color:#FFF;" align="center" bgcolor="#FFFFFF">
                                                <form name="frmdownload" action="/misbl_download.php" method="post">
                                                    <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
                                                    <input type="hidden" name="BidderIDstatic" value="<? echo $BidderIDstatic; ?>">
                                                    <input type="hidden" name="qry2" value="<? echo $val; ?>">
                                                    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
                                                    <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
                                                    <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
                                                </form>


                                            </td>
                                        </tr>
                                    </table>


                <?
            }
        }
        ?>            </div></td>
                </tr>
            </table>
        </div>
            <?

                    function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate, $cmbfeedback, $varVal) {
                        $strURL = "";
                        $strURL = $varPHPPage . "?search=y&RequestID=" . $varRequestID . "&type=" . $varType . "&pageno=" . $varpageon . "&min_date=" . urlencode($varmindate) . "&max_date=" . urlencode($varmaxdate) . "&cmbfeedback=" . urlencode($cmbfeedback) . "&product=4";
                        ?>
            <select name="type" id="type" onChange="MM_jumpMenu('parent', this, 0)">
                <option value="<? echo $strURL . '&Feedback=' ?>" <?
                if ($varFeedback == "") {
                    echo "selected";
                }
                ?>>No Feedback</option>
                <option value="<? echo $strURL . '&Feedback=Other Product' ?>" <?
                if ($varFeedback == "Other Product") {
                    echo "selected";
                }
                ?> >Other Product</option>
                <option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <?
                if ($varFeedback == "Not Interested") {
                    echo "selected";
                }
                ?>>Not Interested</option>
                <option value="<? echo $strURL . '&Feedback=Callback Later' ?>" <?
                if ($varFeedback == "Callback Later") {
                    echo "selected";
                }
                ?>>Callback Later</option>
                <option value="<? echo $strURL . '&Feedback=Wrong Number' ?>" <?
                if ($varFeedback == "Wrong Number") {
                    echo "selected";
                }
                ?>>Wrong Number</option>
                <option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <?
                if ($varFeedback == "Not Eligible") {
                    echo "selected";
                }
                ?> >Not Eligible</option>
                <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <?
                if ($varFeedback == "Ringing") {
                    echo "selected";
                }
                ?> >Ringing</option>
                <option value="<? echo $strURL . '&Feedback=Duplicate' ?>" <?
                    if ($varFeedback == "Duplicate") {
                        echo "selected";
                    }
                ?>>Duplicate</option>
                <option value="<? echo $strURL . '&Feedback=Not Contactable' ?>" <?
                        if ($varFeedback == "Not Contactable") {
                            echo "selected";
                        }
                        ?> >Not Contactable</option>


                <option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <?
            if ($varFeedback == "FollowUp") {
                echo "selected";
            }
                        ?>>FollowUp</option>	
                <option value="<? echo $strURL . '&Feedback=Send Now' ?>" <?
                    if ($varFeedback == "Send Now") {
                        echo "selected";
                    }
                        ?>>Send Now</option>	

                <option value="<? echo $strURL . '&Feedback=Not Applied' ?>" <?
        if ($varFeedback == "Not Applied") {
            echo "selected";
        }
        ?> >Not Applied</option>

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
    </body>
</html>
