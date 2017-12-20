<?php

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

function getEmploymentStatus($value) {
    
    if ($value == 1) {
        $EmploymentStatus = 'Salaried';
    }  else if ($value == 'SEP') {
        $EmploymentStatus = 'Self Employed Professional';
    } else if ($value == 'SEM') {
        $EmploymentStatus = 'Self Employed (Manufacturer)';
    } else if ($value == 'SET') {
        $EmploymentStatus = 'Self Employed (Trader)';
    } else if ($value == 'SES') {
        $EmploymentStatus = 'Self Employed (Services)';
    } else if ($value == 'SENP') {
        $EmploymentStatus = 'Self Employed Non Professional';
    } else if ($value == 0) {
        $EmploymentStatus = 'Self Employed';
    }
    return $EmploymentStatus;
}
/*Annual Income*/
function getAnnualIncome($value) {
    if ($value >= 200000 && $value < 250000) {
        $AnnualIncome = 'Upto 2 Lacs';
    } else if ($value >= 250000 && $value < 450000) {
        $AnnualIncome = '2 To 3 Lacs';
    } else if ($value >= 450000 && $value < 550000) {
        $AnnualIncome = '3 To 5 Lacs';
    } else if ($value >= 550000) {
        $AnnualIncome = '5 Lacs and Above';
    }
    return $AnnualIncome;
}
/*Annual Turnover*/
function getAnnualTurnover($value) {
    if ($value == 1) {
        $AnnualTurnover = '0-25 lacs';
    } else if ($value == 2) {
        $AnnualTurnover = '50 Lacs-1 Cr';
    } else if ($value == 3) {
        $AnnualTurnover = '25-50 Lacs';
    } else if ($value == 4) {
        $AnnualTurnover = '1 Cr and above';
    }
    return $AnnualTurnover;
}
/*Vintage of Property*/
function getVintage($value) {
    if ($value >= 2 && $value < 4) {
        $vintage = '0 To 3 Yrs';
    } else if ($value >= 4 && $value < 5) {
        $vintage = '3 To 5 Yrs';
    } else if ($value >= 5) {
        $vintage = '5 Yrs & Above';
    }
    return $vintage;
}

/*Company Type*/
function getCompanyType($value) {
    if ($value == 7) {
        $CompanyType = 'SP';
    } else if ($value == 8) {
        $CompanyType = 'Partnership';
    } else if ($value == 11) {
        $CompanyType = 'CIN';
    } else if ($value == 12) {
        $CompanyType = 'Individual';
    }
    return $CompanyType;
}
/*Reflecting Complete Income, Are you Filling ITR*/
function getYesNoVal($value){
if ($value == 1) {
        $VarYesNo = 'Yes';
    } else if ($value == 0) {
        $VarYesNo = 'No';
    }
    return $VarYesNo;
}

/* Urgency of loan */
function getUrgencyOfLoan($value) {
    if ($value == 1) {
        $UrgencyOfLoan = '3-5 working days';
    } else if ($value == 2) {
        $UrgencyOfLoan = '5-7 working days';
    } else if ($value == 3) {
        $UrgencyOfLoan = '7 working days';
    }
    return $UrgencyOfLoan;
}

function getITRDetails($value) {
    if ($value == 3) {
        $ITRDetails = 'You can be funded if you  are  running business  purely on cash basis';
    } else if ($value == 4) {
        $ITRDetails = 'You can be funded if you  are running business  vide your SA/CA';
    } else if ($value == 5) {
        $ITRDetails = 'You can be funded if you  are  having an existing  AL/PL/LAP/HL where  you have paid more than 6-12 months';
    } else if ($value == 6) {
        $ITRDetails = 'You can be funded if you are a SEP & have a tentative record of Gross reciepts/fees';
    }
    return $ITRDetails;
}
/* Type of Property */
function getPropertyTypes($value) {
    if ($value == 'SORP') {
        $VarPropType = 'SORP';
    } else if ($value == 'SOCP') {
        $VarPropType = 'SOCP';
    } else if ($value == 'SOIP') {
        $VarPropType = 'SOIP';
    } else if ($value == 'Vacant') {
        $VarPropType = 'Vacant';
    } else if ($value == 'CPIP') {
        $VarPropType = 'CPIP';
    }else if ($value == 'Agricultural') {
        $VarPropType = 'Agricultural Land';
    }
    return $VarPropType;
}

/* Size of Property */
function getPropertySize($value) {
    if ($value == 1) {
        $VarPropSize = '0-150 Sq. Ft.';
    } else if ($value == 2) {
        $VarPropSize = '150-500 Sq. Ft.';
    } else if ($value == 3) {
        $VarPropSize = '500-Above Sq. Ft.';
    }
    return $VarPropSize;
}


$session_id = session_id();
$qry1 = $_POST["qry1"];
$qry2 = $_POST["qry2"];

$mindate = $_POST["min_date"];
$maxdate = $_POST["max_date"];

$qry1 = str_replace("\'", "'", $qry1);

$rowQuery = ExecQuery($qry1);
//echo "fff".$qry1."<br>";
//$num_rows = mysql_num_rows($rowQuery);


while ($row_result = mysql_fetch_array($rowQuery)) {

//RequestID, AgentID, Name, Mobile_Number, NetProfit, Annual_Turnover, Loan_Amount,City,City_Other, Vintage, Company_Type as TypeofCompany, Feedback, Followup_Date, Dated,Add_Comment as Comment
    $RequestID = $row_result["RequestID"];
    $AgentID = $row_result["AgentID"]; /* to download */
    $RefID = "LAP" . $RequestID . "S" . $AgentID; /* to download */
    $Name = $row_result["Name"]; /* to download */
    $Mobile_Number = $row_result["Mobile_Number"]; /* to download */
    $Loan_Amount = $row_result["Loan_Amount"]; /* to download */
    $AnnualIncome = $row_result["NetProfit"];
    $iAnnualIncome = getAnnualIncome($AnnualIncome); /* to download */
    
    $City = $row_result["City"]; /* to download */
    $City_Other = $row_result["City_Other"]; /* to download */
    $iVintage = getVintage($row_result["Vintage"]); /* to download */
 	$LeadDate = $row_result["Dated"];/*to download*/
 	   
    $edSql = "select Emp_Status, Owner_Property, Urgency_Loan,reflecting_income, PL_Details, HL_Details, CL_Details, BL_Details, LAP_Details, CC_Details, ITR_Details, Annual_Turnover, Company_Type, ITR_filing, Property_Type, Property_Size, Holding_Current_Account, Pancard, vat, map_available from Req_Loan_Against_Property_ED where RequestID = '".$RequestID."'";
    $viewleadsbled = ExecQuery($edSql);
    
    $LAPED_row_result = mysql_fetch_array($viewleadsbled);
   
    /*Added By Yaswant */
    $viewEmp_Status = $LAPED_row_result['Emp_Status'];
    $iEmploymentStatus = getEmploymentStatus($viewEmp_Status); /* to download */
    $Annual_Turnover = $LAPED_row_result['Annual_Turnover'];
    $iAnnualTurnover = getAnnualTurnover($Annual_Turnover);
    $CompanyType = $LAPED_row_result['Company_Type'];
    $iCompanyType = getCompanyType($CompanyType);
    $ITRfiling = $LAPED_row_result['ITR_filing'];
    $iITRfiling = getYesNoVal($ITRfiling);
    $RellectIncome = $LAPED_row_result['reflecting_income'];
    $viewreflecting_income = getYesNoVal($RellectIncome); 
    $PropType = $LAPED_row_result['Property_Type'];
    $iPropertyType = getPropertyTypes($PropType); 
    $PropSize = $LAPED_row_result['Property_Size'];
    $iPropertySize = getPropertySize($PropSize);
    $HoldingCurAccount = $LAPED_row_result['Holding_Current_Account'];
    $iHoldingBankAccount = getYesNoVal($HoldingCurAccount);
    $Pancard = $LAPED_row_result['Pancard'];
    $vatTIN = $LAPED_row_result['vat'];
    $MapAvail = $LAPED_row_result['map_available'];
    $iMapAvail = getYesNoVal($MapAvail);
    /* End */
    
    
    $ITR_Details = mysql_result($viewleadsbled, 0, 'ITR_Details');
    $ITRDetails = getITRDetails($ITR_Details); /* to download */
    $viewOwner_Property = mysql_result($viewleadsbled, 0, 'Owner_Property'); /* to download */
    $Urgency_Loan = mysql_result($viewleadsbled, 0, 'Urgency_Loan'); /* to download */
    $viewUrgency_Loan = getUrgencyOfLoan($Urgency_Loan);
    
    $PL_Details = mysql_result($viewleadsbled, 0, 'PL_Details');
    $PL_DetailsArr = explode(",", $PL_Details);
    $viewpl_amt = $PL_DetailsArr[0]; /* to download */
    $viewpl_bank = $PL_DetailsArr[1]; /* to download */
    $viewpl_emi_amt = $PL_DetailsArr[2]; /* to download */
    $viewpl_emi = $PL_DetailsArr[3]; /* to download */
    $HL_Details = mysql_result($viewleadsbled, 0, 'HL_Details');
    $HL_DetailsArr = explode(",", $HL_Details);
    $viewhl_amt = $HL_DetailsArr[0]; /* to download */
    $viewhl_bank = $HL_DetailsArr[1]; /* to download */
    $viewhl_emi_amt = $HL_DetailsArr[2]; /* to download */
    $viewhl_emi = $HL_DetailsArr[3]; /* to download */
    $CL_Details = mysql_result($viewleadsbled, 0, 'CL_Details');
    $CL_DetailsArr = explode(",", $CL_Details);
    $viewcl_amt = $CL_DetailsArr[0]; /* to download */
    $viewcl_bank = $CL_DetailsArr[1]; /* to download */
    $viewcl_emi_amt = $CL_DetailsArr[2]; /* to download */
    $viewcl_emi = $CL_DetailsArr[3]; /* to download */
    $BL_Details = mysql_result($viewleadsbled, 0, 'BL_Details');
    $BL_DetailsArr = explode(",", $BL_Details);
    $viewbl_amt = $BL_DetailsArr[0]; /* to download */
    $viewbl_bank = $BL_DetailsArr[1]; /* to download */
    $viewbl_emi_amt = $BL_DetailsArr[2]; /* to download */
    $viewbl_emi = $BL_DetailsArr[3]; /* to download */
    $LAP_Details = mysql_result($viewleadsbled, 0, 'LAP_Details');
    $LAP_DetailsArr = explode(",", $LAP_Details);
    $viewlap_amt = $LAP_DetailsArr[0]; /* to download */
    $viewlap_bank = $LAP_DetailsArr[1]; /* to download */
    $viewlap_emi_amt = $LAP_DetailsArr[2]; /* to download */
    $viewlap_emi = $LAP_DetailsArr[3]; /* to download */
    $CC_Details = mysql_result($viewleadsbled, 0, 'CC_Details');
    $CC_DetailsArr = explode(",", $CC_Details);
    $viewcc_amt = $CC_DetailsArr[0]; /* to download */
    $viewcc_bank = $CC_DetailsArr[1]; /* to download */
    $viewcc_emi_amt = $CC_DetailsArr[2]; /* to download */
    $viewcc_emi = $LAP_DetailsArr[3]; /* to download */

    $BankAccount = mysql_result($viewleadsbled, 0, 'BankAccount'); /* to download */
    $Office_Property = mysql_result($viewleadsbled, 0, 'Office_Property'); /* to download */
    $RegistrationProof = mysql_result($viewleadsbled, 0, 'RegistrationProof');
    if ($RegistrationProof == 1) {
        $iRegistrationProof = "Yes";
    } else {
        $iRegistrationProof = "No";
    }/* to download */
    $VintageRegistration = mysql_result($viewleadsbled, 0, 'VintageRegistration'); /* to download */


    $Feedback = $row_result["Feedback"]; /* to download */
    $Followup_Date = $row_result["Followup_Date"]; /* to download */
    $Comment = $row_result["Comment"]; /* to download */

    $getDocsSql = "SELECT * FROM  `zexternal_appointment_docs` WHERE  `RequestID` ='" . $RequestID . "' and Reply_Type=5 ORDER BY  `zexternal_appointment_docs`.`id` DESC LIMIT 0 , 1";
    $getDocsQuery = ExecQuery($getDocsSql);
    $Address = mysql_result($getDocsQuery, 0, 'Address'); /* to download */
    $docpickerid = mysql_result($viewleadsbled, 0, 'docpickerid');
    $appt_date = mysql_result($viewleadsbled, 0, 'appt_date'); /* to download */
    $appt_time = mysql_result($viewleadsbled, 0, 'appt_time'); /* to download */
    $getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='" . $docpickerid . "'";
    $getApptDetailsQry = ExecQuery($getFEDetailsSql);
    $FE_Name = mysql_result($getApptDetailsQry, 0, 'FE_Name'); /* to download */
    $FE_Mobile = mysql_result($getApptDetailsQry, 0, 'FE_Mobile'); /* to download */

    $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, car_make, car_model, car_type, loan_tenure, property_type, property_value, year_in_comp, total_exp, mobile_number, std_code, apt_dt, address_apt, landline, std_code_o, landline_o, net_salary, gender, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, no_of_dependents, annual_income, plan_interested, pincode, source, Feedback, contact_time, count_views, count_replies, is_modified, is_processed, already_download, doe, budget, product_type, count, total_bill, pancard, no_of_banks, residence_address, current_age, loan_time, Card_Limit, account_no, property_identified, property_loc, card_vintage, referred_page, constitution, login_date ) values ('" . $session_id . "', '" . $AgentID . "', '" . $RefID . "', '" . $Name . "', '" . $Mobile_Number . "', '" . $Loan_Amount . "', '" . $iAnnualIncome . "', '" . $iNetProfit . "', '" . $City . "', '" . $City_Other . "', '" . $iVintage . "', '" . $TypeofCompany . "', '" . $iCompanyType . "', '" . $iEmploymentStatus . "', '" . $ITRDetails . "', '" . $iITRfiling . "', '" . $viewUrgency_Loan . "', '" . $viewreflecting_income . "', '".$iPropertyType."', '".$iPropertySize."', '" . $viewpl_amt . "', '" . $viewpl_bank . "', '" . $viewpl_emi_amt . "', '" . $viewpl_emi . "', '" . $viewhl_amt . "', '" . $viewhl_bank . "', '" . $viewhl_emi_amt . "', '" . $viewhl_emi . "', '" . $viewcl_amt . "', '" . $viewcl_bank . "', '" . $viewcl_emi_amt . "', '" . $viewcl_emi . "', '" . $viewbl_amt . "', '" . $viewbl_bank . "', '" . $viewbl_emi_amt . "', '" . $viewbl_emi . "', '" . $viewlap_amt . "', '" . $viewlap_bank . "', '" . $viewlap_emi_amt . "', '" . $viewlap_emi . "', '" . $viewcc_amt . "', '" . $viewcc_bank . "', '" . $viewcc_emi_amt . "', '" . $viewcc_emi . "', '" . $Feedback . "', '" . $Followup_Date . "', '" . $Comment . "', '" . $Address . "', '" . $appt_date . "', '" . $appt_time . "', '" . $FE_Name . "', '" . $FE_Mobile . "', '" . $iHoldingBankAccount . "', '".$Pancard."', '".$vatTIN."', '".$iMapAvail."', '" . $BankAccount . "', '" . $Office_Property . "', '" . $iRegistrationProof . "', '" . $VintageRegistration . "', '" . $iAnnualTurnover. "', '".$LeadDate."')";
    ExecQuery($qry1);
}

$qry = "select name as AgentID, dob as ReferenceID, email as Name, car_make as City, car_model as OtherCity, car_type as Vintage, property_type as CompanyType, property_value as EmploymentStatus, total_exp as ITRFilling, year_in_comp as ITRDetails, mobile_number as UrgencyLoan, std_code as ReflectingIncome, apt_dt as propertyType, address_apt as propertySize, landline as PLloanAmt, std_code_o as PLBank, landline_o as PLEMI, net_salary as PLEMICount, gender as HLloanAmt, marital_status as HLBank, residential_status as HLEMI, vehicle_owned as HLEMICount, loan_any as CLloanAmt, emi_paid as CLBank, cc_holder as CLEMI, loan_amount as CLEMICount, no_of_dependents as BLloanAmt, annual_income as BLBank, plan_interested as BLEMI, pincode as BLEMICount, source as LAPloanAmt, Feedback as LAPBank, contact_time as LAPEMI, count_views as LAPEMICount, count_replies as CCAmt, is_modified as CCBank, is_processed as CCEMI, already_download as CCEMICount, current_age as HoldingBankAccount, loan_time AS Pancard, Card_Limit AS VATTIN, account_no as MapAvailable, property_identified as BankAccount, property_loc as Office_Property, card_vintage as RegistrationProof, referred_page as VintageRegistration,  doe as Feedback, budget as FollowupDate, product_type as Comment, count as Address, total_bill as ApptDate, pancard as ApptTime, no_of_banks as FEName, residence_address as FEMobile, login_date as LeadDate from temp where session_id='" . $session_id . "' order by doe DESC ";
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
