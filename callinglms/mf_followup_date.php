<?php

require '../scripts/db_init.php';


$get_requestid = $_REQUEST['get_requestid'];
$get_bidderid = $_REQUEST['get_bidderid'];
$get_followup = $_REQUEST['get_followup'];
//$get_asmfollowup = $_REQUEST['get_asmfollowup'];
//12/23/2008echo $get_fixed_deposit.": ".	$get_requestid."<br>";
if (strlen(trim($get_requestid)) > 0) {
    $Dated = ExactServerdate();
    $dataInsert = array('RequestID' => $get_requestid, 'Dated' => $Dated, 'Reply_Type' => '11', 'BidderID' => $get_bidderid);
    $table = 'Req_Feedback_MF';
    //$insert = Maininsertfunc ($table, $dataInsert);

    $strSQL = "";
    $Msg = "";
    $result = "select FeedbackID from Req_Feedback_MF where AllRequestID=" . $get_requestid . " and BidderID=" . $get_bidderid;
    list($num_rows, $row) = MainselectfuncNew($result, $array = array());
    if ($num_rows > 0) {
        $dataUpdate = array('Followup_Date' => $get_followup);
        $wherecondition = "(FeedbackID=" . $row[0]['FeedbackID'] . ")";
        Mainupdatefunc('Req_Feedback_MF', $dataUpdate, $wherecondition);
    }
    echo "insert";
    if ($result == 1) {
        
    } else {
        $Msg = "** There was a problem in adding your feedback. Please try again.";
    }
}
?>