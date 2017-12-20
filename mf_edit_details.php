<?php
ini_set('max_execution_time', 300);
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if ($IP_Remote == '192.124.249.12' || $IP_Remote == '185.93.228.12') {
    $IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
} else {
    $IP = $IP_Remote;
}

$IP=ExactCustomerIP();
$post = $_REQUEST['postid'];
$min_date = $_REQUEST['to'];
$max_date = $_REQUEST['from'];
$bidid = $_REQUEST['biddt'];

function ccMasking($number, $maskingCharacter = 'X') {
    return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

function DetermineAgeGETDOB($YYYYMMDD_In) {

    $yIn = substr($YYYYMMDD_In, 0, 4);
    $mIn = substr($YYYYMMDD_In, 4, 2);
    $dIn = substr($YYYYMMDD_In, 6, 2);

    $ddiff = date("d") - $dIn;
    $mdiff = date("m") - $mIn;
    $ydiff = date("Y") - $yIn;

    // Check If Birthday Month Has Been Reached
    if ($mdiff < 0) {
        // Birthday Month Not Reached
        // Subtract 1 Year From Age
        $ydiff--;
    } elseif ($mdiff == 0) {
        // Birthday Month Currently
        // Check If BirthdayDay Passed
        if ($ddiff < 0) {
            //Birthday Not Reached
            // Subtract 1 Year From Age
            $ydiff--;
        }
    }
    return $ydiff;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && ($IP == "122.176.100.27" || $IP == "122.176.100.28" || $IP == "122.176.122.134" || $IP == "122.161.196.68" || $IP == "61.246.3.127" || $IP == "122.160.30.168" || $IP == "122.160.74.241" || $IP == "182.71.109.218" || $IP == "117.212.73.65" || $IP == "113.193.239.185" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.68.155" || $IP=="122.176.77.239")) {
    foreach ($_POST as $a => $b)
        $$a = $b;

    /* FIX STRINGS */
    $UserID = $_SESSION['UserID'];
    $plrequestid = $_POST['plrequestid'];
    $producttype = 11;
    $plname = $_POST['plname']; //
    $plemail = $_POST["plemail"]; //
    $plmobile = $_POST["plmobile"]; //
    $plemployment_status = $_POST["plemployment_status"]; //
    $plnet_salary = $_POST["plnet_salary"]; //
    $plcompany_name = $_POST["plcompany_name"]; //
    $pldob = $_POST['pldob']; //
    $plcity = $_POST["plcity"]; //
    $plcity_other = $_POST["plcity_other"]; //
    $plfeedback = $_POST["plfeedback"];
    $FollowupDate = $_POST["FollowupDate"];
    $pladd_comment = $_REQUEST['pladd_comment'];
    $Bidder_Id = $_REQUEST['BidderId'];
    $EkycStatus = $_REQUEST['ekyc_status'];
    $AltConNum = $_REQUEST['AltConNum'];
    
    $MFSIP = $_REQUEST['MF_SIP'];
    $TransValSIP = $_REQUEST['Trans_Val_SIP'];
    $MFLumpsum = $_REQUEST['MF_Lumpsum'];
    $TransValLumpsum = $_REQUEST['Trans_Val_Lumpsum'];
    $want_online = $_REQUEST['want_online'];

    $Final_Bid = "";
    while (list ($key, $val) = @each($Final_Bidder)) {
        $Final_Bid = $Final_Bid . "$val,";
    }

    $nn = count($Loan_Any);
    $ii = 0;
    while ($ii < $nn) {
        $Loan_A .= "$Loan_Any[$ii], ";
        $ii++;
    }

    //unique clause
    $tomorrow = mktime(0, 0, 0, date("m"), date("d") - 30, date("Y"));
    $days30date = date('Y-m-d', $tomorrow);
    $days30datetime = $days30date . " 00:00:00";
    $currentdate = date('Y-m-d');
    $currentdatetime = date('Y-m-d') . " 23:59:59";

    if (strlen($Final_Bid) > 0) {
        $updatelead = "Update Req_Mutual_Fund set Name='$plname',Company_Name='$plcompany_name', DOB='$pldob',Email='$plemail', City='$plcity', City_Other='$plcity_other',  Net_Salary='$plnet_salary',Employment_Status='$plemployment_status',ekyc_status='" . $EkycStatus . "', Alternate_Number='" . $AltConNum . "', MF_SIP='" . $MFSIP . "',Trans_Val_SIP='" . $TransValSIP . "',MF_Lumpsum='" . $MFLumpsum . "',Trans_Val_Lumpsum='" . $TransValLumpsum . "',want_online='" . $want_online . "', Add_Comment='$pladd_comment',Dated=Now(), Allocated='$Allocated' where RequestID=" . $post;
    } else {
        $updatelead = "Update Req_Mutual_Fund set Name='$plname',Company_Name='$plcompany_name', DOB='$pldob',Email='$plemail', City='$plcity', City_Other='$plcity_other',  Net_Salary='$plnet_salary',Employment_Status='$plemployment_status',ekyc_status='" . $EkycStatus . "', Alternate_Number='" . $AltConNum . "', MF_SIP='" . $MFSIP . "',Trans_Val_SIP='" . $TransValSIP . "',MF_Lumpsum='" . $MFLumpsum . "',Trans_Val_Lumpsum='" . $TransValLumpsum . "',want_online='" . $want_online . "', Add_Comment='$pladd_comment',Dated=Now() where RequestID=" . $post;
    }

    //echo "query".$updatelead;
    $updateleadresult = ExecQuery($updatelead);

    if (strlen($plfeedback) > 0) {
        if ($plfeedback == "Not Contactable" || $plfeedback == "Ringing" || $plfeedback == "Wrong Number" || $plfeedback == "Not Eligible") {
            $counter = "1";
        } else {
            $counter = "";
        }

        $strSQL = "";
        $Msg = "";
        $result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_MF where AllRequestID=" . $post . " and BidderID=" . $Bidder_Id . " AND Reply_Type=11");

        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0) {
            $row = mysql_fetch_array($result);
            $notcontactableCounter = $row["not_contactable_counter"];
            if ($plfeedback == "Not Contactable" || $plfeedback == "Ringing" || $plfeedback == "Wrong Number" || $plfeedback == "Not Eligible") {
                $updatedcounter = $notcontactableCounter + 1;
            } else {
                $updatedcounter = $notcontactableCounter;
            }

            $strSQL = "Update Req_Feedback_MF Set Feedback='" . $plfeedback . "',not_contactable_counter='" . $updatedcounter . "',Followup_Date='" . $FollowupDate . "', Caller_Name='" . $_SESSION['Caller_Name'] . "'";
            $strSQL = $strSQL . "Where FeedbackID=" . $row["FeedbackID"];
        } else {
            $strSQL = "Insert into Req_Feedback_MF(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,not_contactable_counter, Caller_Name) Values (";
            $strSQL = $strSQL . $post . "," . $Bidder_Id . ",11,'" . $plfeedback . "','" . $FollowupDate . "','" . $counter . "', '" . $_SESSION['Caller_Name'] . "')";
        }
        //echo $strSQL;
        $result = ExecQuery($strSQL);
        if ($result == 1) {
            
        } else {
            $Msg = "** There was a problem in adding your feedback. Please try again.";
        }
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="includes/style.css" rel="stylesheet" type="text/css">
        <script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
        <script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
        <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
        <script type="text/javascript" src="ajax.js"></script>
        <script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
        <script type="text/javascript">
            function killCopy(e) {
                return false;
            }
            function reEnable() {
                return true;
            }
            document.onselectstart = new Function("return false");
            if (window.sidebar) {
                document.onmousedown = killCopydocument.onclick = reEnable
            }
            function clickIE4() {
                if (event.button == 2) {
                    return false;
                }
            }
            function clickNS4(e) {
                if (document.layers || document.getElementById && !document.all) {
                    if (e.which == 2 || e.which == 3) {
                        return false;
                    }
                }
            }
            if (document.layers) {
                document.captureEvents(Event.MOUSEDOWN);
                document.onmousedown = clickNS4;
            } else if (document.all && !document.getElementById) {
                document.onmousedown = clickIE4;
            }
            document.oncontextmenu = new Function("return false")
        </script>
        <style type="text/css">	
            /* START CSS NEEDED ONLY IN DEMO */
            #mainContainer{
                width:660px;
                margin:0 auto;
                text-align:left;
                height:100%;

                border-left:3px double #000;
                border-right:3px double #000;
            }
            #formContent{
                padding:5px;
            }
            /* END CSS ONLY NEEDED IN DEMO */
            /* Big box with list of options */
            #ajax_listOfOptions{
                position:absolute;	/* Never change this one */
                width:280px;	/* Width of box */
                height:160px;	/* Height of box */
                overflow:auto;	/* Scrolling features */
                border:1px solid #317082;	/* Dark green border */
                background-color:#FFF;	/* White background color */
                color: black;
                text-align:left;
                font-size:0.9em;
                z-index:100;
            }
            #ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
                margin:1px;		
                padding:1px;
                cursor:pointer;
                font-size:0.9em;
            }
            #ajax_listOfOptions .optionDiv{	/* Div for each item in list */
            }
            #ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
                background-color:#2375CB;
                color:#FFF;
            }
            #ajax_listOfOptions_iframe{
                background-color:#F00;
                position:absolute;
                z-index:5;
            }
            form{
                display:inline;
            }
        </style>
        <STYLE>
            a
            {
                cursor:pointer;
            }
            .bluebutton {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 11px;
                color: blue;
                font-weight: bold;
            }</style>
        <script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script type = "text/javascript" language = "javascript">
            $(document).ready(function () {
                $("#InserData").click(function (event) {
                    var comment_section = $("#pladd_comment").val();
                    var requestid = $("#requestid").val();
                    var bidderid = $("#bidderid").val();
                    var FollowupDate = $("#FollowupDate").val();
                    $("#CommentMsg").load('mfadd_comment_lms.php', {"comment_section": comment_section, "requestid": requestid, "bidderid": bidderid, "FollowupDate": FollowupDate});
                });
            });
        </script>
        <!--DatePicker Start-->
        <link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/datepicker.css">
        <script src="callinglms/js-datepicker/jquery-1.5.1.js"></script>
        <script src="callinglms/js-datepicker/jquery.ui.core.js"></script>
        <script src="callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                var date = new Date();
                var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();

                $('#pldob').datepicker({
                    minDate: new Date(y - 75, m, d),
                    maxDate: new Date(y - 18, m, d),
                    changeMonth: true,
                    changeYear: true,
                    //yearRange: "+20:+0",
                    dateFormat: 'yy-mm-dd'
                });
            });
            $(function () {
                $("#pldob").datepicker();

            });
        </script>
        <script type="text/javascript">

            function ShowSIPLumpsum(fdbkval)
            {
                if (fdbkval == 'Appointment')
                {
                    document.getElementById("MFAppSipLump").style.display = "Block";
                } else {
                    document.getElementById("MFAppSipLump").style.display = "none";
                }
            }
        </script>
    </head>
    <body>
        <?php
        $viewqry = "select * from Req_Mutual_Fund LEFT OUTER JOIN Req_Feedback_MF ON Req_Feedback_MF.AllRequestID=Req_Mutual_Fund.RequestID and Req_Feedback_MF.BidderID= '" . $bidid . "' where Req_Mutual_Fund.RequestID=" . $post . " ";
//echo "Sql - ".$viewqry;
        $viewlead = ExecQuery($viewqry);
        $viewleadscount = mysql_num_rows($viewlead);
        $Name = mysql_result($viewlead, 0, 'Name');
        $Add_Comment = mysql_result($viewlead, 0, 'Add_Comment');
        $Mobile = mysql_result($viewlead, 0, 'Mobile_Number');
        $MF_Plan = mysql_result($viewlead, 0, 'MF_Plan');
        $Net_Salary = mysql_result($viewlead, 0, 'Net_Salary');
        $City = mysql_result($viewlead, 0, 'City');
        $City_Other = mysql_result($viewlead, 0, 'City_Other');
        $Dated = mysql_result($viewlead, 0, 'Dated');
        $Employment_Status = mysql_result($viewlead, 0, 'Employment_Status');
        $Email = mysql_result($viewlead, 0, 'Email');
        $source = mysql_result($viewlead, 0, 'source');
        $followup_date = mysql_result($viewlead, 0, 'Followup_Date');
        $Feedback = mysql_result($viewlead, 0, 'Feedback');
        $Company_Name = mysql_result($viewlead, 0, 'Company_Name');
        $DOB = mysql_result($viewlead, 0, 'DOB');
        $getDOB = DetermineAgeGETDOB($DOB);
        $ekycStatus = mysql_result($viewlead, 0, 'ekyc_status');
        $is_invest_ready= mysql_result($viewlead, 0, 'is_invest_ready');
        $monthsalary = $Net_Salary / 12;

        $Alternate_Number = mysql_result($viewlead, 0, 'Alternate_Number');
        $MF_SIP = mysql_result($viewlead, 0, 'MF_SIP');
        $Trans_Val_SIP = mysql_result($viewlead, 0, 'Trans_Val_SIP');
        $MF_Lumpsum = mysql_result($viewlead, 0, 'MF_Lumpsum');
        $Trans_Val_Lumpsum = mysql_result($viewlead, 0, 'Trans_Val_Lumpsum');
        $WantOnline = mysql_result($viewlead, 0, 'want_online');
        
        if($Feedback!='Appointment' && $_REQUEST['postid'])
        {
            $updateSIPLumpSum = "Update Req_Mutual_Fund set MF_SIP='',Trans_Val_SIP='', MF_Lumpsum='',Trans_Val_Lumpsum='' where RequestID=" . $post;               $UpdateleadSIPLuSum = ExecQuery($updateSIPLumpSum);
        }
        ?>
        <style>
            .fontstyle
            {
                font-family:Verdana Arial, Helvetica, sans-serif;
                font-size:12px;
            }
        </style>
        <script type="text/javascript">
        function validatemffrm(frm)
        {
        //alert('test')   ;
        if(frm.ekyc_status.value=='')
            {
                alert('Please Select KYC Field');
                frm.ekyc_status.focus();
                return false;
            }
        }
        </script>
        <p align="center"><b>Mutual Fund Lead Details </b>
        <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<? echo $post; ?>&biddt=<? echo $bidid; ?>" onsubmit="return validatemffrm(document.loan_form)">
            <table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
                <tr>
                    <td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
                <tr>
                    <td class="fontstyle" width="150"><b> Name</b><input type="hidden" name="BidderId" value="<? echo $bidid; ?>"></td>
                    <td class="fontstyle" style="width: 97px"><input type="text" name="plname" id="plname" value="<? echo $Name; ?>"></td>
                    <td class="fontstyle" width="150"><b>Email id</b></td>
                    <td class="fontstyle" width="150"><input type="text" name="plemail" id="plemail" value="<? echo $Email; ?>"></td>
                </tr>
                <tr>
                    <td class="fontstyle"><b>DOB</b></td>
                    <td class="fontstyle" style="width: 97px"><input type="text" name="pldob" id="pldob"size="15" value="<? echo $DOB; ?>"></td>
                    <td class="fontstyle"><b>Mobile</b></td>
                    <td class="fontstyle">+91<input type="hidden" name="plmobile" size="15" value="<? echo $Mobile; ?>"><strong><?php echo ccMasking($Mobile); ?><? //echo $Mobile;    ?></strong></td>
                </tr>
                <tr>
                    <td class="fontstyle"><b>Plan</b></td><td style="width: 97px"><? echo $MF_Plan; ?></td>
                    <td class="fontstyle"><b>Alternate Contact Num </b></td>
                    <td><input type="text" name="AltConNum" id="AltConNum"size="15" value="<? echo $Alternate_Number; ?>"></td>
                </tr>
                <tr>
                    <td class="fontstyle"><b>City</b></td>
                    <td class="fontstyle" style="width: 97px"><select size="1" name="plcity" id="plcity"> <?= plgetCityList($City) ?></select></td>
                    <td class="fontstyle"><b>Other City</b></td>
                    <td class="fontstyle"><input type="text" name="plcity_other" id="plcity_other" size="15" value="<? echo $City_Other; ?>" ></td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
                <tr>
                    <td class="fontstyle"><b>Employment Status</b></td>
                    <td class="fontstyle" style="width: 97px"><select class="fontstyle" name="plemployment_status" id="plemployment_status">
                            <option value="1" <?
                            if ($Employment_Status == 1) {
                                echo "selected";
                            }
                            ?>>Salaried</option>
                            <option value="0" <?
                            if ($Employment_Status == 0) {
                                echo "selected";
                            }
                            ?>>Self Employed</option></select>
                    </td>
                    <td class="fontstyle"><b>Annual Income</b></td>
                    <td class="fontstyle"><input type="text" name="plnet_salary" id="plnet_salary" value="<? echo $Net_Salary; ?>"  onKeyUp="getDigitToWords('plnet_salary', 'formatedIncome', 'wordIncome');" onKeyPress="getDigitToWords('plnet_salary', 'formatedIncome', 'wordIncome');" style="float: left" onBlur="getDigitToWords('plnet_salary', 'formatedIncome', 'wordIncome');"></td>
                </tr>
                <tr><td class="fontstyle"><b>Company Name</b></td>
                    <td><input type="text" name="plcompany_name" id="plcompany_name" value="<? echo $Company_Name; ?>"></td> <td class="fontstyle"><b>KYC Status</b></td>
                    <td><select name="ekyc_status" id="kycstatus"><?php 
                    
                    ?>
                            <option value="">Select KYC Status</option>
                            <option value="1" <?php if ($ekycStatus == 1) {
                                        echo "selected";
                                    } ?>>Yes</option>
                            <option value="0" <?php if ($ekycStatus == '0') {
                                        echo "selected";
                                    } ?>>No</option>
                        </select></td>

                </tr>
                <tr><td ><strong>Invest Ready</strong></td><td><?php if ($is_invest_ready== 1) { echo "Yes"; } //else { echo "No"; }  ?> </td><td colspan="2"><input type="checkbox" name="want_online" value="1"<?php if($WantOnline==1) { echo "checked";}?>>Online</td></tr>
                <tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>
                <tr>
                    <td class="fontstyle"><b>Feedback</b></td>
                    <td class="fontstyle" style="width: 97px">

                        <select name="plfeedback" id="feedback" onchange = "ShowSIPLumpsum(this.value)">
                            <option value="" <?
                                    if ($Feedback == "") {
                                        echo "selected";
                                    }
                            ?>>No Feedback</option>
                            <option value="Appointment" <?
                            if ($Feedback == "Appointment") {
                                echo "selected";
                            }
                            ?>>Converted</option>

                            <option value="Other Product" <?
                            if ($Feedback == "Other Product") {
                                echo "selected";
                            }
                            ?>>Other Product</option>
                            <option value="Not Interested" <?
                            if ($Feedback == "Not Interested") {
                                echo "selected";
                            }
                            ?>>Not Interested</option>
                            <option value="Callback Later" <?
                            if ($Feedback == "Callback Later") {
                                echo "selected";
                            }
                            ?>>Callback Later</option>
                            <option value="Wrong Number" <?
                            if ($Feedback == "Wrong Number") {
                                echo "selected";
                            }
                            ?>>Wrong Number</option>
                            <option value="Send Now" <?
                            if ($Feedback == "Send Now") {
                                echo "selected";
                            }
                            ?>>Send Now</option>
                            <option value="Not Eligible" <?
                            if ($Feedback == "Not Eligible") {
                                echo "selected";
                            }
                            ?>>Not Eligible</option>
                            <option value="Duplicate" <?
                            if ($Feedback == "Duplicate") {
                                echo "selected";
                            }
                            ?>>Duplicate</option>
                            <option value="Not Contactable" <?
                            if ($Feedback == "Not Contactable") {
                                echo "selected";
                            }
                            ?>>Not Contactable</option>
                            <option value="Ringing" <?
                            if ($Feedback == "Ringing") {
                                echo "selected";
                            }
                            ?>>Ringing</option>
                            <option value="FollowUp" <?
                            if ($Feedback == "FollowUp") {
                                echo "selected";
                            }
                            ?>>FollowUp</option>
                            <option value="Not Applied" <?
                            if ($Feedback == "Not Applied") {
                                echo "selected";
                            }
                            ?>>Not Applied</option>
                            <option value="PickUp" <?
                            if ($Feedback == "PickUp") {
                                echo "selected";
                            }
                            ?>>PickUp</option>
                        </select>
                    </td>
                    <td class="fontstyle"><b>Follow Up Date</b></td>
                    <td class="fontstyle"><?php echo $followup_date3621; ?><input type="Text"  name="FollowupDate" id="FollowupDate" maxlength="25" size="15" <?php if ($Followup_Date != '0000-00-00 00:00:00') { ?>value="<?php echo $followup_date; ?>" <?php } ?>><a href="javascript:NewCal('FollowupDate','yyyymmdd',true,24)"><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
                </tr>

                <tr>
                    <td colspan="4"><table  id="MFAppSipLump" <?php if($Feedback!='Appointment'){ ?> style="display: none;"<?php }?>><tr><td class="fontstyle"><b>MF Application SIP</b></td>
                                <td><select name="MF_SIP" id="MF_SIP">
                                        <option value="">Select SIP</option>
                                        <option value="1" <?php if($MF_SIP==1) { echo "selected";}?>>1</option>
                                        <option value="2"<?php if($MF_SIP==2) { echo "selected";}?>>2</option>
                                        <option value="3"<?php if($MF_SIP==3) { echo "selected";}?>>3</option>
                                        <option value="4"<?php if($MF_SIP==4) { echo "selected";}?>>4</option>
                                        <option value="5"<?php if($MF_SIP==5) { echo "selected";}?>>5</option>

                                    </select></td>
                                <td> Transaction Value SIP</td>
                                <td><input type="text" name="Trans_Val_SIP" id="Trans_Val_SIP" value="<?php echo $Trans_Val_SIP?>"></td>

                            </tr> 

                            <tr><td class="fontstyle"><b>MF Application Lumpsum</b></td>
                                <td><select name="MF_Lumpsum" id="MF_Lumpsum">
                                        <option value="">Select Lumpsum</option>
                                        <option value="1" <?php if($MF_Lumpsum==1) { echo "selected";}?>>1</option>
                                        <option value="2" <?php if($MF_Lumpsum==2) { echo "selected";}?>>2</option>
                                        <option value="3" <?php if($MF_Lumpsum==3) { echo "selected";}?>>3</option>
                                        <option value="4" <?php if($MF_Lumpsum==4) { echo "selected";}?>>4</option>
                                        <option value="5" <?php if($MF_Lumpsum==5) { echo "selected";}?>>5</option>

                                    </select></td>
                                <td> Transaction Value Lumpsum</td>
                                <td><input type="text" name="Trans_Val_Lumpsum" id="TransValLumpsum" value="<?php echo $Trans_Val_Lumpsum?>"></td>

                            </tr>  </table></td>
                </tr>



                <tr>
                    <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
                    </td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Add Response</b></td>
                </tr> 
                <tr><td><input type="hidden" name="requestid" id="requestid" value="<? echo $_REQUEST["postid"]; ?>">
                        <input type="hidden" name="bidderid" id="bidderid" value="<? echo $_REQUEST["biddt"]; ?>"></td>
                    <td><b>Add Response</b></td>
                    <td> <div id = "CommentMsg"></div><textarea rows="2" cols="20" name="pladd_comment" id="pladd_comment" ><? //echo $Add_Comment;  ?></textarea></td>
                    <td><input type = "button" id = "InserData" value = "Save" /></td>
                </tr>
                
                <?php
                $sqlResFields = "select * from client_lead_allocated_comment where RequestID='" . $_REQUEST["postid"] . "' and BidderID='" . $_REQUEST['biddt'] . "' ORDER BY Dated DESC";
                $queryResFields = ExecQuery($sqlResFields);
                $numRowsResFields = mysql_num_rows($queryResFields);
                if ($numRowsResFields > 0) {
                    ?>
    <tr>
    <td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>Show Response</b></td>
    </tr>
                    <?php
                        while ($Arr = mysql_fetch_array($queryResFields)) {
                            ?>
        <tr>
        <td colspan="4" style="border:1px solid gainsboro;"><?php echo $Arr['Comments']; ?><br /><span style="color: #999999; font-size: 9px"><i><?php echo $Arr['Dated']; ?></i></span></td>
        </tr>
                <?php
            }
        }
        ?>
            </table>
        </form>
    </body>
</html>
