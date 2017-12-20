<?php
ini_set('max_execution_time', 300);
require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
define("TABLE_WISH_TRAVEL", "xkyknzl5dwfyk4hg_wish_travel");
define("TABLE_WISH_TRAVEL_CITY_LIST", "xkyknzl5dwfyk4hg_wish_travel_data_city_list");
session_start();

$IP_Remote = ExactCustomerIP();
$IP = ExactCustomerIP();
$post = $_REQUEST['postid'];
$min_date = $_REQUEST['to'];
$max_date = $_REQUEST['from'];
$bidid = $_REQUEST['biddt'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $a => $b)
        $$a = $b;

    /* FIX STRINGS */
    $UserID = $_SESSION['UserID'];
    $name = $_POST['name']; //
    $email = $_POST["email"]; //
    $mobile = $_POST["mobile"]; //
    
    $CtyID = $_POST["city"]; //
    $feedback = $_POST["feedback"];
    $FollowupDate = $_POST["FollowupDate"];
    $add_comment = $_REQUEST['add_comment'];
    $Bidder_Id = $_REQUEST['BidderId'];
    
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
        $updatelead = "Update " . TABLE_WISH_TRAVEL . " set name='$name',email_id='$email', city_id='$CtyID', date_modified=Now() where id=" . $post;
    } else {
        $updatelead = "Update " . TABLE_WISH_TRAVEL . " set name='$name',email_id='$email', city_id='$CtyID', date_modified=Now() where id=" . $post;
    }

    //echo "query".$updatelead; die;
    $updateleadresult = ExecQuery($updatelead);

    if (strlen($feedback) > 0) {
        
        $strSQL = "";
        $Msg = "";
        $result = ExecQuery("select FeedbackID,not_contactable_counter from Req_Feedback_Travel where AllRequestID=" . $post . " and BidderID=" . $Bidder_Id);

        $num_rows = mysql_num_rows($result);
        if ($num_rows > 0) {
            $row = mysql_fetch_array($result);
            
            $strSQL = "Update Req_Feedback_Travel Set Feedback='" . $feedback . "', Followup_Date='" . $FollowupDate . "', Caller_Name='" . $_SESSION['Caller_Name'] . "', comment_section='" . $add_comment . "'";
            $strSQL = $strSQL . "Where FeedbackID=" . $row["FeedbackID"];
        } else {
            $strSQL = "Insert into Req_Feedback_Travel(AllRequestID, BidderID, Reply_Type , Feedback, Followup_Date,Caller_Name, comment_section) Values (";
            $strSQL = $strSQL . $post . "," . $Bidder_Id . ",13,'" . $feedback . "','" . $FollowupDate . "', '" . $_SESSION['Caller_Name'] . "','" . $add_comment . "')";
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
        <script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
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
        
        
    </head>
    <body>
        <?php
        $viewqry = "select * from " . TABLE_WISH_TRAVEL . " LEFT OUTER JOIN Req_Feedback_Travel ON Req_Feedback_Travel.AllRequestID=" . TABLE_WISH_TRAVEL . ".id and Req_Feedback_Travel.BidderID= '" . $bidid . "' where " . TABLE_WISH_TRAVEL . ".id=" . $post . " ";

        $viewlead = ExecQuery($viewqry);
        $viewleadscount = mysql_num_rows($viewlead);
        $Name = mysql_result($viewlead, 0, 'name');
        $Mobile = mysql_result($viewlead, 0, 'mobile_number');
        $city_id = mysql_result($viewlead, 0, 'city_id');
        $Email = mysql_result($viewlead, 0, 'email_id');
        $followup_date = mysql_result($viewlead, 0, 'Followup_Date');
        $Feedback = mysql_result($viewlead, 0, 'Feedback');
        $CommentSection = mysql_result($viewlead, 0, 'comment_section');
        ?>
        <style>
            .fontstyle
            {
                font-family:Verdana Arial, Helvetica, sans-serif;
                font-size:12px;
            }
        </style>
        
        <p align="center"><b>Travel Lead Details </b>
        <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<? echo $post; ?>&biddt=<? echo $bidid; ?>">
            <table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" >
                <tr>
                    <td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
                <tr>
                    <td class="fontstyle" width="150"><b> Name</b><input type="hidden" name="BidderId" value="<? echo $bidid; ?>"></td>
                    <td class="fontstyle" style="width: 97px"><input type="text" name="name" id="name" value="<? echo $Name; ?>"></td>
                    <td class="fontstyle" width="150"><b>Email id</b></td>
                    <td class="fontstyle" width="150"><input type="text" name="email" id="email" value="<? echo $Email; ?>"></td>
                </tr>
                <tr>
                    <td class="fontstyle"><b>Mobile</b></td>
                    <td class="fontstyle">+91<strong><?php echo $Mobile; ?><? //echo $Mobile;      ?></strong></td>
                    <td class="fontstyle"><b>City</b></td>
                    <td class="fontstyle" style="width: 97px"><select size="1" name="city" id="city"> 
                            <option value="">Please select City</option>
                            <?php $Cityqry = "select * from " . TABLE_WISH_TRAVEL_CITY_LIST." ORDER BY city_name ASC";
                            $Citylead = ExecQuery($Cityqry);
        
            while($cityRows = mysql_fetch_array($Citylead))
            { $CityName = $cityRows['city_name'];
              $CityID = $cityRows['id'];
                            ?>
                            <option value="<?php echo $CityID;?>" <?php if($CityID==$city_id){ echo "selected";}?>><?php echo $CityName;?></option>
                            <?php }?>
                            
                        </select></td>

                </tr>
                <tr><td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;" ><b>ADD Feedback </b></td></tr>
                <tr>
                    <td class="fontstyle"><b>Feedback</b></td>
                    <td class="fontstyle" style="width: 97px">

                        <select name="feedback" id="feedback">
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
                <tr><td><input type="hidden" name="requestid" id="requestid" value="<? echo $_REQUEST["postid"]; ?>">
                        <input type="hidden" name="bidderid" id="bidderid" value="<? echo $_REQUEST["biddt"]; ?>"></td>
                    <td><b>Add Comment</b></td>
                    <td> <div id = "CommentMsg"></div><textarea rows="2" cols="20" name="add_comment" id="add_comment" ><? echo $CommentSection;    ?></textarea></td>
               </tr>
                <tr>
                    <td colspan="4" align="center"><input type="submit" class="bluebutton" value="Submit"> 
                    </td>
                </tr>
             </table>
        </form>
    </body>
</html>
