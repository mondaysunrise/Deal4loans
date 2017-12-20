<?php

require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

function clean($string) {
    return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

function RemoveBS($Str) {
    $StrArr = str_split($Str);
    $NewStr = '';
    foreach ($StrArr as $Char) {
        $CharNo = ord($Char);
        //if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £ 
        if ($CharNo > 31 && $CharNo < 127) {
            $NewStr .= $Char;
        }
    }
    return $NewStr;
}

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

function getITRDetails($value) {
    if ($value == 1) {
        $ITRDetails = 'Normal (Under section 44 AD)';
    } else if ($value == 2) {
        $ITRDetails = 'Calculator - Normal Eligibility crietria';
    } else if ($value == 3) {
        $ITRDetails = 'You can be funded if you  are  running business  purely on cash basis';
    } else if ($value == 4) {
        $ITRDetails = 'You can be funded if you  are running business  vide your SA/CA';
    } else if ($value == 5) {
        $ITRDetails = 'You can be funded if you  are  having an existing  AL/PL/LAP/HL where  you have paid more than 6-12 months';
    } else if ($value == 6) {
        $ITRDetails = 'You can be funded if you are a SEP and have a tentative record of Gross reciepts/fees';
    }
    return $ITRDetails;
}

function GetFilingITR($value) {
    if ($value == 1) {
        $PropVal = 'Yes';
    } else if ($value == 2) {
        $PropVal = 'Yes';
    } else {
        $PropVal = 'No';
    }
    return $PropVal;
}

function getNetProfit($value) {
    if ($value >= 200000 && $value < 250000) {
        $NetProfit = 'Upto 2 Lacs';
    } else if ($value >= 250000 && $value < 450000) {
        $NetProfit = '2 To 3 Lacs';
    } else if ($value >= 450000 && $value < 550000) {
        $NetProfit = '3 To 5 Lacs';
    } else if ($value >= 550000) {
        $NetProfit = '5 Lacs and Above';
    }
    return $NetProfit;
}

function getAnnualTurnover($value) {
    if ($value == 1) {
        $AnnualTurnover = '0-20 lacs';
    } else if ($value == 2) {
        $AnnualTurnover = '20-50 Lacs';
    } else if ($value == 3) {
        $AnnualTurnover = '50-80 Lacs';
    } else if ($value == 4) {
        $AnnualTurnover = '80-150 Lacs';
    }
    return $AnnualTurnover;
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

function getOwnerProperty($value) {
    if ($value == 1) {
        $PropVal = 'Commercial';
    } else if ($value == 2) {
        $PropVal = 'Residential';
    } else {
        $PropVal = '';
    }
    return $PropVal;
}

function GetResidenceStatus($value) {
    if ($value == 1) {
        $PropVal = 'Owned By Parent/Sibling';
    } else if ($value == 2) {
        $PropVal = 'Rented - Staying Alone';
    } else if ($value == 3) {
        $PropVal = 'Company Provided';
    } else if ($value == 4) {
        $PropVal = 'Owned By Self/Spouse';
    } else if ($value == 5) {
        $PropVal = 'Rented - With Family';
    } else if ($value == 6) {
        $PropVal = 'Rented - With Friends';
    } else if ($value == 7) {
        $PropVal = 'Paying Guest';
    } else if ($value == 8) {
        $PropVal = 'Hostel';
    } else {
        $PropVal = '';
    }
    return $PropVal;
}

function GetReflectingIncome($value) {
    if ($value == 1) {
        $PropVal = 'Yes';
    } else {
        $PropVal = 'No';
    }
    return $PropVal;
}

function GetUrgencyLoan($value) {
    if ($value == 1) {
        $PropVal = '3-5 working days';
    } else if ($value == 2) {
        $PropVal = '5-7 working days';
    } else if ($value == 3) {
        $PropVal = '>7 working days';
    } else {
        $PropVal = '';
    }
    return $PropVal;
}

function GetGender($value) {
    if ($value == 1) {
        $Str = 'Male';
    } else if($value == 2){
        $Str = 'Female';
    }
    return $Str;
}

function GetMaritalStatus($value) {
    if ($value == 1) {
        $Str = 'Single';
    } elseif ($value == 1) {
        $Str = 'Married';
    }
    return $Str;
}

function GetResStatus($value) {
    if ($value == 1) {
        $Str = 'Self-Owned';
    } elseif ($value == 2) {
        $Str = 'Rented';
    } elseif ($value == 3) {
        $Str = 'Parental-Owned';
    } elseif ($value == 4) {
        $Str = 'Company Provided';
    } elseif ($value == 5) {
        $Str = 'Relative House';
    } elseif ($value == 6) {
        $Str = 'Bachelor Accommodation';
    } elseif ($value == 7) {
        $Str = 'PG';
    }elseif ($value == 8) {
        $Str = 'Others';
    }
    return $Str;
}

function GetCompType($value) {
    if ($value == 1) {
        $Str = 'Pvt Ltd';
    } else if($value == 2){
        $Str = 'Government Firm';
    }else if($value == 3){
        $Str = 'MNC Ltd';
    }else if($value == 7){
        $Str = 'Public Ltd';
    }else if($value == 8){
        $Str = 'Partnership Firm';
    }else if($value == 9){
        $Str = 'Proprietorship Firm';
    }else if($value == 10){
        $Str = 'Others';
    }
    return $Str;
}




$session_id = session_id();
$qry1 = $_POST["qry1"];
$qry2 = $_POST["qry2"];

$mindate = $_POST["min_date"];
$maxdate = $_POST["max_date"];

$qry1 = str_replace("\'", "'", $qry1);

$rowQuery = ExecQuery($qry1);
//echo $qry1."<br>";
//$num_rows = mysql_num_rows($rowQuery);


while ($row_result = mysql_fetch_array($rowQuery)) {

    //RequestID, AgentID, Name, Mobile_Number, NetProfit, Annual_Turnover, Loan_Amount,City,City_Other, Vintage, Company_Type as TypeofCompany, Feedback, Followup_Date, Dated,Add_Comment as Comment
    $RequestID = $row_result["RequestID"];
    $AgentID = $row_result["AgentID"]; /* to download */
    $RefID = "BL" . $RequestID . "S" . $AgentID; /* to download */
    $Name = $row_result["Name"]; /* to download */
    $Name = clean($Name);
    $Name = RemoveBS($Name);

    $source = $row_result["source"]; /* to download */
    $source = clean($source);
    $source = RemoveBS($source);

    $Mobile_Number = $row_result["Mobile_Number"]; /* to download */
    $Loan_Amount = $row_result["Loan_Amount"]; /* to download */
    $NetProfit = $row_result["NetProfit"];
    $iNetProfit = getNetProfit($NetProfit); /* to download */
    $Annual_Turnover = $row_result["Annual_Turnover"];
    $iAnnualTurnover = getAnnualTurnover($Annual_Turnover); /* to download */

    $City = $row_result["City"]; /* to download */
    $City_Other = $row_result["City_Other"]; /* to download */
    $City_Other = clean($City_Other);
    $City_Other = RemoveBS($City_Other);

    $Vintage = $row_result["Vintage"]; /* to download */
    $iVintage = getVintage($Vintage); /* to download */
    $TypeofCompany = $row_result["TypeofCompany"];
    $iCompanyType = getCompanyType($TypeofCompany); /* to download */
    $LeadDate = $row_result["Dated"]; /* to download */

    //Added By Yaswant
    $ResidenceStatusVal = $row_result["Residential_Status"]; /* to download */
    $ResidenceStatus = GetResidenceStatus($ResidenceStatusVal);

    $LoanAny = trim($row_result["Loan_Any"], ','); /* to download */


    $edSql = "select Emp_Status, Owner_Property, Urgency_Loan,reflecting_income, PL_Details, HL_Details, CL_Details, BL_Details, LAP_Details, CC_Details, ITR_Details, Holding_Bank_Account, BankAccount, Office_Property, RegistrationProof, VintageRegistration from Req_Loan_Business_ED where RequestID = '" . $RequestID . "'";
    $viewleadsbled = ExecQuery($edSql);
    $viewEmp_Status = mysql_result($viewleadsbled, 0, 'Emp_Status');
    $iEmploymentStatus = getEmploymentStatus($viewEmp_Status); /* to download */
    $ITR_Details = mysql_result($viewleadsbled, 0, 'ITR_Details');
    $ITRDetails = getITRDetails($ITR_Details); /* to download */

    $FilingITR = GetFilingITR($ITR_Details);

    $viewOwner_PropertyVal = mysql_result($viewleadsbled, 0, 'Owner_Property'); /* to download */
    $viewOwner_Property = getOwnerProperty($viewOwner_PropertyVal);
    $viewUrgency_LoanVal = mysql_result($viewleadsbled, 0, 'Urgency_Loan'); /* to download */
    $viewUrgency_Loan = GetUrgencyLoan($viewUrgency_LoanVal);

    $viewreflecting_incomeVal = mysql_result($viewleadsbled, 0, 'reflecting_income'); /* to download */
    $viewreflecting_income = GetReflectingIncome($viewreflecting_incomeVal);
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

    $Holding_Bank_Account = mysql_result($viewleadsbled, 0, 'Holding_Bank_Account');
    if ($Holding_Bank_Account == 1) {
        $iHoldingBankAccount = "Saving";
    } else {
        $iHoldingBankAccount = "Current";
    }/* to download */

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
    $Comment = clean($Comment);
    $Comment = RemoveBS($Comment);


    $getDocsSql = "SELECT * FROM  `zexternal_appointment_docs` WHERE  `RequestID` ='" . $RequestID . "' and Reply_Type=6 ORDER BY  `zexternal_appointment_docs`.`id` DESC LIMIT 0 , 1";
    $getDocsQuery = ExecQuery($getDocsSql);
    $Address = mysql_result($getDocsQuery, 0, 'Address'); /* to download */

    $Address = clean($Address);
    $Address = RemoveBS($Address);

    $docpickerid = mysql_result($viewleadsbled, 0, 'docpickerid');
    $appt_date = mysql_result($viewleadsbled, 0, 'appt_date'); /* to download */
    $appt_time = mysql_result($viewleadsbled, 0, 'appt_time'); /* to download */
    $getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='" . $docpickerid . "'";
    $getApptDetailsQry = ExecQuery($getFEDetailsSql);
    $FE_Name = mysql_result($getApptDetailsQry, 0, 'FE_Name'); /* to download */
    $FE_Mobile = mysql_result($getApptDetailsQry, 0, 'FE_Mobile'); /* to download */

    //22-11-2017
    $Pancard = $row_result['Pancard'];
    $Email = $row_result['Email'];
    $DOB = $row_result['DOB'];
    $Mobile_Number = $row_result['Mobile_Number'];
    $AlternateNum = $row_result['Landline'];
    $Gender = GetGender($row_result['Gender']);
    $MaritalStatus = GetMaritalStatus($row_result['Marital_Status']);
    $RequiredAmount = $row_result['Loan_Amount'];
    $EmploymentStatus = getEmploymentStatus($row_result['Employment_Status']);
    $MonthlySal = $row_result['Net_Salary'] / 12;
    $CompanyName = $row_result['Company_Name'];
    $CompanyType = GetCompType($row_result['Company_Type']);
    $TotalExp = $row_result['Total_Experience'];
    $CurExpInComp = $row_result['Years_In_Company'];
    $CompanyCate = $row_result['company_category'];
    $OfficePhone = $row_result['Landline_O'];
    $LoanType = $row_result['Loan_Any'];
    $MonthEMI = $row_result['PL_EMI_Amt'];
    $NumEmiPaid = $row_result['EMI_Paid'];
    $NameofBank = $row_result['Existing_Bank'];
    $CibilScore = $row_result['Cibilscore'];
    $CurrentResAddress = $row_result['Residence_Address'];
    $ResStatus = GetResStatus($row_result['Residential_Status']); 
    $ROI = $row_result['Existing_ROI'];
    $Tenure = $row_result['PL_Tenure'];
    
    $AgentFeedback = $row_result['Feedback'];
    $FollowUpDate = $row_result['Followup_Date'];
    
    
    $ExtraSql = "select secured_emi,office_address, higher_qualification, official_email_id,approved_loan, SFDC_ID FROM Req_Loan_Personal_Extra_Fields where RequestID = '" . $RequestID . "' AND cibil_reference_id ='$AgentID'";
    $ExtraQueryLead = ExecQuery($ExtraSql);
    $EMIAmount = mysql_result($ExtraQueryLead, 0, 'secured_emi');
    $OfficeAddress = mysql_result($ExtraQueryLead, 0, 'office_address');
    $HigherQualification = mysql_result($ExtraQueryLead, 0, 'higher_qualification');
    $OfficeEmail = mysql_result($ExtraQueryLead, 0, 'official_email_id');
    $ApprovedLoan = mysql_result($ExtraQueryLead, 0, 'approved_loan');
    $SFDCID = mysql_result($ExtraQueryLead, 0, 'SFDC_ID');
    


    if ($_REQUEST['Campaign'] == 'capitalfirstSalLMS') {
        $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, car_make, car_model, car_type, loan_tenure, property_type, property_value, year_in_comp, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, gender, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, no_of_dependents, annual_income, plan_interested, pincode, source, Feedback, contact_time, count_views, count_replies, is_modified,constitution,login_date) values ('" . $session_id . "', '" . $AgentID . "', '" . $RefID . "', '" . $Pancard . "', '" . $Name . "', '" . $Email . "', '" . $DOB . "', '" . $Mobile_Number . "', '" . $City . "', '" . $AlternateNum . "', '" . $City_Other . "', '" . $Gender . "', '" . $MaritalStatus . "', '" . $HigherQualification . "', '" . $RequiredAmount . "', '" . $EmploymentStatus . "', '" . $MonthlySal . "', '" . $CompanyName . "', '" . $CompanyType . "', '" . $TotalExp . "', '" . $CurExpInComp . "', '" . $OfficeEmail . "', '" . $CompanyCate . "', '" . $OfficePhone . "', '" . $LoanType . "', '" . $MonthEMI . "', '" . $NumEmiPaid . "', '" . $NameofBank . "', '" . $CibilScore . "', '" . $CurrentResAddress . "', '" . $OfficeAddress . "', '" . $ResStatus . "', '" . $ApprovedLoan . "', '" . $ROI . "', '" . $Tenure . "', '" . $SFDCID . "', '" . $EMIAmount . "', '" . $AgentFeedback . "', '" . $FollowUpDate . "', '" . $Comment . "','" . $source . "', '" . $LeadDate . "')";
    } else {

        $qry1 = "insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, car_make, car_model, car_type, loan_tenure, property_type, property_value, year_in_comp, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, gender, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, no_of_dependents, annual_income, plan_interested, pincode, source, Feedback, contact_time, count_views, count_replies, is_modified, is_processed, already_download, doe, budget, product_type, count, total_bill, pancard, no_of_banks, residence_address, current_age, property_identified, property_loc, card_vintage, referred_page, login_date,logout_date, ip_address,is_valid,constitution ) values ('" . $session_id . "', '" . $AgentID . "', '" . $RefID . "', '" . $Name . "', '" . $Mobile_Number . "', '" . $Loan_Amount . "', '" . $iNetProfit . "', '" . $iAnnualTurnover . "', '" . $City . "', '" . $City_Other . "', '" . $iVintage . "', '" . $TypeofCompany . "', '" . $iCompanyType . "', '" . $iEmploymentStatus . "', '" . $ITRDetails . "', '" . $viewOwner_Property . "', '" . $viewUrgency_Loan . "', '" . $viewreflecting_income . "', '" . $viewpl_amt . "', '" . $viewpl_bank . "', '" . $viewpl_emi_amt . "', '" . $viewpl_emi . "', '" . $viewhl_amt . "', '" . $viewhl_bank . "', '" . $viewhl_emi_amt . "', '" . $viewhl_emi . "', '" . $viewcl_amt . "', '" . $viewcl_bank . "', '" . $viewcl_emi_amt . "', '" . $viewcl_emi . "', '" . $viewbl_amt . "', '" . $viewbl_bank . "', '" . $viewbl_emi_amt . "', '" . $viewbl_emi . "', '" . $viewlap_amt . "', '" . $viewlap_bank . "', '" . $viewlap_emi_amt . "', '" . $viewlap_emi . "', '" . $viewcc_amt . "', '" . $viewcc_bank . "', '" . $viewcc_emi_amt . "', '" . $viewcc_emi . "', '" . $Feedback . "', '" . $Followup_Date . "', '" . $Comment . "', '" . $Address . "', '" . $appt_date . "', '" . $appt_time . "', '" . $FE_Name . "', '" . $FE_Mobile . "', '" . $iHoldingBankAccount . "', '" . $BankAccount . "', '" . $Office_Property . "', '" . $iRegistrationProof . "', '" . $VintageRegistration . "', '" . $LeadDate . "', '" . $ResidenceStatus . "', '" . $FilingITR . "', '" . $LoanAny . "','" . $source . "')";
    }
    ExecQuery($qry1);
}

if ($_REQUEST['Campaign'] == 'capitalfirstSalLMS') {
    //city_other as MobileNumber,
    $qry = "select name as AgentID, dob as ReferenceID,constitution AS SourceOfLeads, email as Pancard, emp_status as Name, c_name as Email, city as DOB,  car_make as City, car_model as AlternateNum, car_type as OtherCity, loan_tenure AS Gender, property_type as MaritalStatus, property_value as HigherQualification, year_in_comp as RequiredAmount, total_exp as EmploymentStatus, mobile_number as MonthlySal, std_code as CompanyName,landline as CompanyType, std_code_o as TotalExp, landline_o as CurExpInComp, net_salary as OfficeEmail, gender as CompanyCate, marital_status as OfficePhone, residential_status as LoanType, vehicle_owned as MonthEMI, loan_any as NumEmiPaid, emi_paid as NameofBank, cc_holder as CibilScore, loan_amount as CurrentResAddress, no_of_dependents as OfficeAddress, annual_income as ResStatus, plan_interested as ApprovedLoan, pincode as ROI, source as Tenure, Feedback as SFDCID, contact_time as EMIAmount, count_views as AgentFeedback, count_replies as FollowUpDate, is_modified as AddComment, login_date as LeadDate from temp where session_id='" . $session_id . "' order by doe DESC ";
} else {

    $qry = "select name as AgentID, dob as ReferenceID, constitution AS SourceOfLeads,email as Name, emp_status as MobileNumber, c_name as LoanAmount, city as NetProfit, city_other as AnnualTurnover, car_make as City, car_model as OtherCity, car_type as Vintage, property_type as CompanyType, property_value as EmploymentStatus, ip_address as FilingITR, year_in_comp as ITRDetails, total_exp as OwnerProperty, mobile_number as UrgencyLoan, std_code as ReflectingIncome, logout_date as ResidenceStatus, is_valid as ExistingLoan, landline as PLloanAmt, std_code_o as PLBank, landline_o as PLEMI, net_salary as PLEMICount, gender as HLloanAmt, marital_status as HLBank, residential_status as HLEMI, vehicle_owned as HLEMICount, loan_any as CLloanAmt, emi_paid as CLBank, cc_holder as CLEMI, loan_amount as CLEMICount, no_of_dependents as BLloanAmt, annual_income as BLBank, plan_interested as BLEMI, pincode as BLEMICount, source as LAPloanAmt, Feedback as LAPBank, contact_time as LAPEMI, count_views as LAPEMICount, count_replies as CCAmt, is_modified as CCBank, is_processed as CCEMI, already_download as CCEMICount, current_age as HoldingBankAccount, property_identified as BankAccount, property_loc as Office_Property, card_vintage as RegistrationProof, referred_page as VintageRegistration,  doe as Feedback, budget as FollowupDate, product_type as Comment, count as Address, total_bill as ApptDate, pancard as ApptTime, no_of_banks as FEName, residence_address as FEMobile, login_date as LeadDate from temp where session_id='" . $session_id . "' order by doe DESC ";
}
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
