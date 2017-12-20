<?php

require 'scripts/db_init.php';

$datedVal = date("Y-m-d H:i:s");
$qryAgent = "SELECT * FROM Req_Feedback_PL where flag=1 and last_update_dated < '" . $datedVal . "' and axis_executive_name IN('Appointment','Documents Picked','Document Pending','Follow Up')";
$qryAgentResult = d4l_ExecQuery($qryAgent);
while ($Getrow = d4l_mysql_fetch_array($qryAgentResult)) {

    $agentID = $Getrow['BidderID'];
    $ReferenceID = "PL" . $Getrow['FeedbackID'] . "S" . $Getrow['BidderID'];
    $ReqId = $Getrow['AllRequestID'];
    $LanNum = $Getrow['post_login_stat'];
    $qryCust = "SELECT * FROM Req_Loan_Personal where RequestID=" . $ReqId;
    $qryResultCust = d4l_ExecQuery($qryCust);
    $rowCust = d4l_mysql_fetch_array($qryResultCust);
    //echo "<pre>";print_r($rowCust);
    $Name = ucfirst($rowCust['Name']);
    $City = $rowCust['City'];
    $Pancard = $rowCust['Pancard'];

    $qryAgentInfo = "SELECT * FROM Bidders where BidderID=" . $agentID." AND leadidentifier ='smsplbajajfinserv'";
    $qryResultAgentInfo = d4l_ExecQuery($qryAgentInfo);
    $rowAgentInfo = d4l_mysql_fetch_array($qryResultAgentInfo);
    $EmailIds = $rowAgentInfo['BidderEmailID'];
    $VerifierName = $rowAgentInfo['Manager_Name'];

    echo $message = "<table border=\"0\">
    <tr>
        <td colspan=\"2\">ALERT !!!</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan=\"2\">Below case has exceeded follow up timeline limit :-</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Agent ID</td>
        <td>" . $agentID . "</td>
    </tr>
    <tr>
        <td>Verifier/GTL/TL</td>
        <td>" . $VerifierName . "</td>
    </tr>
    <tr>
        <td>Customer Name</td>
        <td>" . $Name . "</td>
    </tr>
    <tr>
        <td>City</td>
        <td>" . $City . "</td>
    </tr>
    <tr>
        <td>PAN No.</td>
        <td>" . $Pancard . "</td>
    </tr>
    <tr>
        <td>LAN No.</td>
        <td>" . $LanNum . "</td>
    </tr>
    <tr>
        <td>Reference ID</td>
        <td>" . $ReferenceID . "</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan=\"2\">Regards,</td>
    </tr>
    <tr>
        <td colspan=\"2\">Team WishFin</td>
    </tr>
</table>";
    $to = $EmailIds;
    $subject = "Deal4loans BFL Verifier Panel";

    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers

    $headers .= 'From: BFL Verifier Panel <info@deal4loans.com>' . "\r\n";
    $headers .= 'Cc: jitin.adlakha@deal4loans.com,naveen.arora@wishfin.com,balbir.singh@deal4loans.com' . "\r\n";
    //$headers .= 'Bcc: yaswant.chauhan@deal4loans.com' . "\r\n";

    mail($to, $subject, $message, $headers);
}
?>
