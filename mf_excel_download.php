<?php

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$session_id = session_id();
if (isset($_POST['BidderIDstatic']) && strlen($_POST['BidderIDstatic']) > 0) {
    $BidderIDstatic = $_REQUEST['BidderIDstatic'];
} else {
    $BidderIDstatic = $BidderIDstatic;
}

function clean($string) {
    return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

function RemoveBS($Str) {
    $StrArr = str_split($Str);
    $NewStr = '';
    foreach ($StrArr as $Char) {
        $CharNo = ord($Char);
        if ($CharNo == 163) {
            $NewStr .= $Char;
            continue;
        } // keep £ 
        if ($CharNo > 31 && $CharNo < 127) {
            $NewStr .= $Char;
        }
    }
    return $NewStr;
}

function getEmploymentStatus($value) {
    if ($value == 1) {
        $EmploymentStatus = 'Salaried';
    } else if ($value == 0) {
        $EmploymentStatus = 'Self Employed';
    } else if ($value == 'SEP') {
        $EmploymentStatus = 'Self Employed Professional';
    } else if ($value == 'SENP') {
        $EmploymentStatus = 'Self Employed Non Professional';
    }
    return $EmploymentStatus;
}

$session_id = session_id();
$qry1 = $_POST["qry1"];
$qry2 = $_POST["qry2"];
$mindate = $_POST["min_date"];
$maxdate = $_POST["max_date"];
$qry1 = str_replace("\'", "'", $qry1);
$rowQuery = ExecQuery($qry1);
while ($row_result = mysql_fetch_array($rowQuery)) {
    $RequestID = $row_result["RequestID"];
    $AgentID = $row_result["Agent_ID"]; /* to download */
    $Name = RemoveBS(clean($row_result["Name"])); /* to download */
    $Email = RemoveBS(clean($row_result["Email"])); /* to download */
    $Mobile_Number = RemoveBS(clean($row_result["Mobile_Number"])); /* to download */
    $MF_Plan = RemoveBS(clean($row_result["MF_Plan"])); /* to download */
    $Bidder = $row_result["Bidder"];
    $Employment_Status = getEmploymentStatus($row_result["Employment_Status"]); /* to download */
    $City = RemoveBS(clean($row_result["City"])); /* to download */
    $City_Other = RemoveBS(clean($row_result["City_Other"])); /* to download */
    
    
    $Dated = $row_result['Updated_Date'];
    $Feedback = $row_result['Feedback'];
    

//Get Comment (Response) 
    $CLeadCmntqry = "select id, RequestID,Comments, BidderID from client_lead_allocated_comment where RequestID=" . $RequestID . " and BidderID=" . $_SESSION['BidderID'] . " AND Reply_Type=11 ORDER BY id DESC LIMIT 0,1";
    $Cmntresult = ExecQuery($CLeadCmntqry);
    $rowVal = mysql_fetch_array($Cmntresult);
    //print_r($rowVal);
    
    $Comments = RemoveBS(clean($rowVal['Comments']));
    
        $qry1 = "insert into temp (session_id, name, email,mobile_number, emp_status,city,city_other, loan_any,add_comment,c_name,Feedback) values ('" . $session_id . "', '" . $Name . "', '" . $Email . "', '" . $Mobile_Number . "', '" . $Employment_Status . "', '" . $City . "', '" . $City_Other . "', '" . $MF_Plan . "','" . $Comments . "','".$Dated."','".$Feedback."')";
    ExecQuery($qry1);
}

$qry = "select name as Name, email as Email, mobile_number, emp_status, city,city_other, loan_any AS Plan,add_comment AS Comment,c_name AS Dated, Feedback from temp where session_id='" . $session_id . "' order by doe DESC ";

$header = "";
$data = "";
$result = ExecQuery($qry);
$count = mysql_num_fields($result);

for ($i = 0; $i < $count; $i++) {
    $header .= mysql_field_name($result, $i) . "\t";
}

while ($row = mysql_fetch_row($result)) {
    $line = '';
    foreach ($row as $value) {
        if (!isset($value) || $value == "") {
            $value = '"' . $value . '"' . "\t";
        } else {
            # important to escape any quotes to preserve them in the data.
            $value = str_replace('"', '""', $value);
            # needed to encapsulate data in quotes because some data might be multi line.
            # the good news is that numbers remain numbers in Excel even though quoted.
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim($line) . "\n";
}


# this line is needed because returns embedded in the data have "\r"
# and this looks like a "box character" in Excel
$data = str_replace("\r", "", $data);

# Nice to let someone know that the search came up empty.
# Otherwise only the column name headers will be output to Excel.
if ($data == "") {
    $data = "\nno matching records found\n";
}

# This line will stream the file to the user rather than spray it across the screen
header("Content-type: application/octet-stream");

# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment; filename=data.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $header . "\n" . $data;

//Delete data from the temp table
$qry1 = "delete from `temp` where session_id='" . $session_id . "'";
$result1 = ExecQuery($qry1);
//*/
//	$qry1="delete from `temp` where session_id='7gesspepnu7b2th0idsc5l1gj3'";
?>
