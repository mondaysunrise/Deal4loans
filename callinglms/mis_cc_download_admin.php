<?php

require_once("includes/application-top-inner.php");

function getVintage($value) {
    if ($value == 1) {
        $vintage = 'Less than 6 months';
    } else if ($value == 2) {
        $vintage = '6 to 9 months';
    } else if ($value == 3) {
        $vintage = '9 to 12 months';
    } else if ($value == 4) {
        $vintage = 'more than 12 months';
    }
    return $vintage;
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

function getCompanyType($value) {
    if ($value == 1) {
        $CompanyType = 'Pvt Ltd';
    } else if ($value == 7) {
        $CompanyType = 'SP';
    } else if ($value == 8) {
        $CompanyType = 'Partnership';
    } else if ($value == 9) {
        $CompanyType = 'LLP';
    }
    return $CompanyType;
}

function getCCHolder($value) {
    if ($value == 1) {
        $CCHolder = 'Yes';
    } else {
        $CCHolder = 'No';
    }
    return $CCHolder;
}

function getSalaryDrawn($value) {
    if ($value == 1) {
        $SalaryDrawn = 'Cash';
    } else if ($value == 3) {
        $SalaryDrawn = 'Cheque';
    } else if ($value == 2) {
        $SalaryDrawn = 'Account Transfer';
    }
    return $SalaryDrawn;
}

function getdocStatus($value) {
    if ($value == 1) {
        $docStatus = 'Complete';
    } else if ($value == 2) {
        $docStatus = 'Incomplete Pick-up';
    } else if ($value == 3) {
        $docStatus = 'Sent For Login';
    } else if ($value == 4) {
        $docStatus = 'Logged In';
    } else if ($value == 5) {
        $docStatus = 'Return To Sales';
    } else if ($value == 6) {
        $docStatus = 'Approved';
    } else if ($value == 7) {
        $docStatus = 'Disbursed';
    } else if ($value == 8) {
        $docStatus = 'Post Login Reject';
    } else if ($value == 9) {
        $docStatus = 'Cancelled - AUD';
    }
    return $docStatus;
}

$session_id = session_id();
$qry1 = $_POST["qry1"];
$qry2 = $_POST["qry2"];

$mindate = $_POST["min_date"];
$maxdate = $_POST["max_date"];

$qry1 = str_replace("\'", "'", $qry1);

$rowQuery = $obj->fun_db_query($qry1);


while ($row_result = $obj->fun_db_fetch_rs_object($rowQuery)) {

//RequestID	telecaller	leadrefnumber	Name	Email	Gender	Company_Name	City	Std_Code	Landline	Mobile_Number	Std_Code_O	Landline_O	Net_Salary	Pincode	IP_Address	DOB	Pancard	No_of_Banks	Residence_Address	Office_Address	Updated_Date	applied_card_name

    $RequestID = $row_result->RequestID; /* to download */
    $AgentID = $row_result->BidderID; /* to download */
    $leadrefnumber = $row_result->LeadRefNumber; /* to download */
    $Email = $row_result->Email; /* to download */
    $Gender = $row_result->Gender; /* to download */
    $Company_Name = $row_result->Company_Name; /* to download */
    $City = $row_result->City; /* to download */
    $City_Other = $row_result->City_Other; /* to download */
    $Std_Code = $row_result->Std_Code; /* to download */
    $Landline = $row_result->Landline; /* to download */
    $Mobile_Number = $row_result->Mobile_Number; /* to download */
    $Employment_Status = getEmploymentStatus($row_result->Employment_Status); /* to download */
    $Std_Code_O = $row_result->Std_Code_O; /* to download */
    $Landline_O = $row_result->Landline_O; /* to download */
    $Net_Salary = $row_result->Net_Salary; /* to download */
    $Pincode = $row_result->Pincode; /* to download */
    $IP_Address = $row_result->IP_Address; /* to download */
    $DOB = $row_result->DOB; /* to download */
    $Pancard = $row_result->Pancard; /* to download */
    $No_of_Banks = $row_result->No_of_Banks; /* to download */
    $Residence_Address = $row_result->Residence_Address; /* to download */
    $Office_Address = $row_result->Office_Address; /* to download */
    $Updated_Date = ($row_result->Updated_Date); /* to download */
    $applied_card_name = $row_result->applied_card_name; /* to download */
    $Name = $row_result->Name; /* to download */
    //24 fields
    //, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, no_of_dependents, annual_income, plan_interested, pincode, source, Feedback, contact_time, count_views, count_replies, is_modified, is_processed, already_download, doe, budget, product_type, `count`, total_bill, pancard, no_of_banks ".$fieldBidderStr.";


    $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, car_make, car_model, car_type, loan_tenure, property_type, property_value, year_in_comp, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, gender, marital_status, residential_status, vehicle_owned ) values ('" . $session_id . "','" . $RequestID . "', '" . $AgentID . "', '" . $leadrefnumber . "', '" . $Email . "', '" . $Gender . "', '" . $Company_Name . "', '" . $City . "', '" . $City_Other . "', '" . $Std_Code . "', '" . $Landline . "', '" . $Mobile_Number . "', '" . $Employment_Status . "', '" . $Std_Code_O . "', '" . $Landline_O . "', '" . $Net_Salary . "', '" . $Pincode . "', '" . $IP_Address . "', '" . $DOB . "', '" . $Pancard . "', '" . $No_of_Banks . "', '" . $Residence_Address . "', '" . $Office_Address . "', '" . $Updated_Date . "', '" . $applied_card_name . "', '" . $Name . "')";
    
    //// ".."
    //echo 	$qry1."<br>";	
    $obj->fun_db_query($qry1);
    // $fieldBidderStr = '';
    // $valuesBidderStr='';
}


$qry = "select name as RequestID, dob as AgentID, email as LeadRefNumber,vehicle_owned as Name,  city as CompanyName, city_other as City, car_make as CityOther, car_model as StdCode, car_type as Landline, property_type as EmpStatus, property_value as StdOffice, year_in_comp as LandlineOffice, total_exp as Salary, mobile_number as Pincode, std_code as IPAddress, landline as DOB, std_code_o as Pancard, landline_o as NoofBanks, net_salary as ResidenceAddress, gender as OfficeAddress, marital_status as DOE, residential_status as AppliedCardName from temp where session_id='" . $session_id . "' order by doe DESC ";
$header = "";
$data = "";
$result = $obj->fun_db_query($qry);
$count = mysql_num_fields($result);

for ($i = 0; $i < $count; $i++) {
    $header .= mysql_field_name($result, $i) . "\t";
}



while ($row = $obj->fun_db_fetch_rs_object($result)) {
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
$result1 = $obj->fun_db_query($qry1);
//*/
//	$qry1="delete from `temp` where session_id='7gesspepnu7b2th0idsc5l1gj3'";
?>
