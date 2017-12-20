<?php

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

function clean($string) {
	return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

function RemoveBS($Str) {  
  $StrArr = str_split($Str); $NewStr = '';
  foreach ($StrArr as $Char) {    
    $CharNo = ord($Char);
    //if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £ 
    if ($CharNo > 31 && $CharNo < 127) {
      $NewStr .= $Char;    
    }
  }  
  return $NewStr;
}



$session_id = session_id();
$qry1 = $_POST["qry1"];
$qry2 = $_POST["qry2"];

$mindate = $_POST["min_date"];
$maxdate = $_POST["max_date"];

 $qry1 = str_replace("\'", "'", $qry1);
$rowQuery = ExecQuery($qry1);


while ($row_result = mysql_fetch_array($rowQuery)) {

    $RequestID = $row_result['RequestID']; /* to download */
    $AgentID = $row_result['callerid']; /* to download */
    $leadrefnumber = $row_result['LeadRefNumber']; /* to download */
    $Email = RemoveBS(clean($row_result['Email'])); /* to download */
    $Gender = $row_result['Gender']; /* to download */
    $Company_Name = RemoveBS(clean($row_result['Company_Name'])); /* to download */
    $City = RemoveBS(clean($row_result['City'])); /* to download */
    $City_Other = $row_result['City_Other']; /* to download */
    $Std_Code = $row_result['Std_Code']; /* to download */
    $Landline = $row_result['Landline']; /* to download */
    $Mobile_Number = $row_result['Mobile_Number']; /* to download */
    
    $Std_Code_O = $row_result['Std_Code_O']; /* to download */
    $Landline_O = $row_result['Landline_O']; /* to download */
    $Net_Salary = $row_result['Net_Salary']; /* to download */
    $Pincode = $row_result['Pincode']; /* to download */
    $IP_Address = $row_result['IP_Address']; /* to download */
    $DOB = $row_result['DOB']; /* to download */
    $Pancard = $row_result['Pancard']; /* to download */
    $No_of_Banks = $row_result['No_of_Banks']; /* to download */
    
    $Office_Address = $row_result['Office_Address']; /* to download */
    $Updated_Date = ($row_result['Updated_Date']); /* to download */
    $Name = RemoveBS(clean($row_result['Name'])); /* to download */
    $Doe = $row_result['Dated']; /* to download */
    $Feedback = RemoveBS(clean($row_result['Feedback'])); /* to download */
    $Remarks = RemoveBS(clean($row_result['Add_Comment'])); /* to download */
    $Comments = RemoveBS(clean($row_result['Comments'])); /* to download */
    
    $LANNo = $row_result['post_login_stat']; /* to download */
    $BankFeedback = RemoveBS(clean($row_result['axis_executive_name'])); /* to download */
    $BankRemarks = RemoveBS(clean($row_result['comment_section'])); /* to download */
    
    $FeedbackID = $row_result['FeedbackID']; /* to download */
    $Followup_Date = $row_result['Followup_Date']; /* to download */
    
    $LoanAmount = $row_result['Loan_Amount']; /* to download */
    $AgentFeedback = $row_result['Feedback']; /* to download */
    $AgentRemark = $row_result['Add_Comment']; /* to download */
    $doe = $row_result['Add_Date']; /* to download */
    
    
    if(is_null($FeedbackID)){
        $ReferenceID="";
    }else{
        $ReferenceID = "PL".$FeedbackID."S".$AgentID;
    }  
    //24 fields
    //, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, no_of_dependents, annual_income, plan_interested, pincode, source, Feedback, contact_time, count_views, count_replies, is_modified, is_processed, already_download, doe, budget, product_type, `count`, total_bill, pancard, no_of_banks ".$fieldBidderStr.";

    $qry2 = "insert into temp (session_id, name, dob, email, city, car_make, car_model, loan_tenure, property_type,marital_status,doe) values ('" . $session_id . "','" . $RequestID . "', '" . $AgentID . "', '" . $Company_Name . "', '" . $City . "', '" . $Net_Salary . "', '" . $LoanAmount . "', '" . $AgentFeedback . "', '" . $AgentRemark . "', '" . $Name . "','".$doe."')";

    //// ".."
    //echo 	$qry1."<br>";	
    ExecQuery($qry2);
    // $fieldBidderStr = '';
    // $valuesBidderStr='';
}


$qry = "select name as RequestID, marital_status as CustomerName, email AS CompanyName,  city as City, car_make as AnnualIncome, car_model AS LoanAmount, dob as AgentID, loan_tenure as AgentFeedback,property_type as AgentRemark, doe AS LeadUploadDate from temp where session_id='" . $session_id . "' order by doe DESC ";

$header = "";
$data = "";
$result = ExecQuery($qry);
//print_r($result);
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
