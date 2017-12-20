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
    if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £ 
    if ($CharNo > 31 && $CharNo < 127) {
      $NewStr .= $Char;    
    }
  }  
  return $NewStr;
}	
function getVintage($value)
	{
		if($value==1) { $vintage = 'Less than 6 months'; }
		else if($value==2) { $vintage = '6 to 9 months'; }
		else if($value==3) { $vintage = '9 to 12 months'; }
		else if($value==4) { $vintage = 'more than 12 months'; }		
		return $vintage;
	}

	function getEmploymentStatus($value)
	{
		if($value==1) { $EmploymentStatus= 'Salaried'; }
		else if($value==0) { $EmploymentStatus= 'Self Employed'; }
		else if($value=='SEP') { $EmploymentStatus= 'Self Employed Professional'; }
		else if($value=='SENP') { $EmploymentStatus= 'Self Employed Non Professional'; }
		return $EmploymentStatus;
	}

	function getCompanyType($value)
	{
		if($value==1) { $CompanyType= 'Pvt Ltd'; }
		else if($value==7) { $CompanyType= 'SP'; }
		else if($value==8) { $CompanyType= 'Partnership'; }
		else if($value==9) { $CompanyType= 'LLP'; }				
		return $CompanyType;
	}

	function getCCHolder($value)
	{
		if($value==1) { $CCHolder= 'Yes'; }
		else { $CCHolder= 'No'; }
		return $CCHolder;
	}
	
	function getSalaryDrawn($value)
	{
		if($value==1) { $SalaryDrawn= 'Cash'; }
		else if($value==3) { $SalaryDrawn= 'Cheque'; }
		else if($value==2) { $SalaryDrawn= 'Account Transfer'; }
		return $SalaryDrawn;
	}
	
	function getdocStatus($value)
	{
		if($value==1) { $docStatus= 'Complete'; }
		else if($value==2) { $docStatus= 'Incomplete Pick-up'; }
		else if($value==3) { $docStatus= 'Sent For Login'; }
		else if($value==4) { $docStatus= 'Logged In'; }
		else if($value==5) { $docStatus= 'Return To Sales'; }
		else if($value==6) { $docStatus= 'Approved'; }
		else if($value==7) { $docStatus= 'Disbursed'; }
		else if($value==8) { $docStatus= 'Post Login Reject'; }
		else if($value==9) { $docStatus= 'Cancelled - AUD'; }
		return $docStatus;
	}
        
    function getPurposeOfLoan($value)
    {
        if($value==1) { $LoanPurpose= 'Debt Consolidation'; }
        else if($value==2) { $LoanPurpose= 'Medical Emergency'; }
        else if($value==3) { $LoanPurpose= 'Marriage In Family'; }
        else if($value==4) { $LoanPurpose= 'Travel'; }
        else if($value==5) { $LoanPurpose= 'Investment/Property Purchase'; }
        else if($value==6) { $LoanPurpose= 'Personal Use'; }
        return $LoanPurpose;
    }
    function GetLoanTime($value)
    {
        if($value==1) { $LoanTime= 'Urgent'; }
        else if($value==7) { $LoanTime= '1 Week'; }
        else if($value==14) { $LoanTime= '2 Weeks'; }
        else if($value==30) { $LoanTime= '1 Month'; }
        else if($value==32) { $LoanTime= 'More Than 1 Month'; }
        return $LoanTime;
    }

	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];	
	
	$qry1=str_replace("\'", "'", $qry1);	
	
    $rowQuery= ExecQuery($qry1);

	
	while($row_result= mysql_fetch_array($rowQuery)) {

	//AgentID, RequestID, Name,DOB, City,City_Other, NetProfit, Annual_Turnover, Loan_Amount, Vintage, Company_Type as TypeofCompany, Feedback, Followup_Date, Dated,Add_Comment as Comment
	$RequestID = $row_result["RequestID"];
	$plallocateid= $row_result["plallocateid"];
	

        if($_SESSION['BidderID']==6978){
            $QryAgent = "SELECT plallocateid,BidderID AS AgentID FROM plcallinglms_allocation WHERE AllRequestID='".$RequestID."'";
            $resultAgent = ExecQuery($QryAgent);
            $rowAgent = mysql_fetch_array($resultAgent);
            $BiddID= $row_result["Bidder_ID"];/*to download*/
            $AgentID= $rowAgent["AgentID"];/*to download*/
            $Feedback_ID = $row_result["Feedback_ID"];
            $RefID = "PL".$Feedback_ID."S".$BiddID;/*to download*/ 
            
            $Qryfeedback = "SELECT * FROM Req_Feedback_PL WHERE AllRequestID='".$RequestID."' AND BidderID='".$BiddID."'";
            //$Qryfeedback = "SELECT * FROM Req_Feedback_PL WHERE AllRequestID='".$RequestID."' AND ";
                    $resultfeedback = ExecQuery($Qryfeedback);
                    $rowfeedback = mysql_fetch_array($resultfeedback);
                    $varFeedback =  $rowfeedback['Feedback'];
                    $comment_section = RemoveBS(clean($rowfeedback["comment_section"])); 
            $Followup_Date= $rowfeedback["Followup_Date"];/*to download*/
            
            
            }else{
            $AgentID= $row_result["Agent_ID"];/*to download*/
            $RefID = "PL".$plallocateid."S".$AgentID;/*to download*/
        }
	$Name = RemoveBS(clean($row_result["Name"]));/*to download*/
	$Bidder = $row_result["Bidder"];
	$Employment_Status= getEmploymentStatus($row_result["Employment_Status"]);/*to download*/
        
        $LoanTime= GetLoanTime($row_result["Contact_Time"]);/*to download*/
        
	$Net_Salary= $row_result["Net_Salary"];/*to download*/
	$Loan_Amount= $row_result["Loan_Amount"];/*to download*/
	$City= RemoveBS(clean($row_result["City"]));/*to download*/
	$City_Other= RemoveBS(clean($row_result["City_Other"]));/*to download*/
	$Salary_Drawn = getSalaryDrawn($row_result["Salary_Drawn"]);/*to download*/
	$Primary_Acc = $row_result["Primary_Acc"];/*to download*/
	$Pancard= $row_result["Pancard"];/*to download*/
        $company_category= $row_result["company_category"];/*to download*/
	$Company_Name= RemoveBS(clean($row_result["Company_Name"]));/*to download*/	
	$Company_Type= getCompanyType($row_result["Company_Type"]);/*to download*/	
	$Total_Experience= $row_result["Total_Experience"];/*to download*/
	$Years_In_Company= $row_result["Years_In_Company"];/*to download*/
 	$PL_EMI_Amt= $row_result["PL_EMI_Amt"];/*to download*/
	$CC_Holder= getCCHolder($row_result["CC_Holder"]);/*to download*/
	
	$Card_Vintage= getVintage($row_result["Card_Vintage"]);/*to download*/
	$Emi_Paid= getVintage($row_result["Emi_Paid"]);/*to download*/
	
	$iVintage =  getVintage($Vintage);/*to download*/
	$TypeofCompany = $row_result["TypeofCompany"];
	$iCompanyType = ($TypeofCompany);/*to download*/
	$LeadDate = $row_result["Dated"];/*to download*/

	
	$edSql = "select * from Req_Loan_Personal_Extra_Fields where RequestID = '".$RequestID."'";
	$viewleadsbled = ExecQuery($edSql);
	$residence_address = RemoveBS(clean(mysql_result($viewleadsbled,0,'residence_address')));/*to download*/
	$office_address = RemoveBS(clean(mysql_result($viewleadsbled,0,'office_address')));/*to download*/
	$incorporation_date = mysql_result($viewleadsbled,0,'incorporation_date');/*to download*/
	$pf_deduction = getCCHolder(mysql_result($viewleadsbled,0,'pf_deduction'));/*to download*/
	$any_loan_running = getCCHolder(mysql_result($viewleadsbled,0,'any_loan_running'));/*to download*/
        
        $PurposeOfLoan = getPurposeOfLoan(mysql_result($viewleadsbled,0,'purpose_of_loan'));/*to download*/
	
	$obligation_details = unserialize(mysql_result($viewleadsbled,0,'obligation_details'));
	$loan_products = implode(',', $obligation_details[0]);/*to download*/
	$loan_banks = implode(',', $obligation_details[1]);/*to download*/
	$loan_amount = implode(',', $obligation_details[2]);/*to download*/
	$loan_emi = implode(',', $obligation_details[3]);/*to download*/
	$loan_vintage = implode(',', $obligation_details[4]);/*to download*/
	
	$cc_obligation_details = unserialize(mysql_result($viewleadsbled,0,'cc_obligation_details'));
	$cc_banks = implode(',', $cc_obligation_details[0]);/*to download*/
	$cc_outstanding_amount = implode(',', $cc_obligation_details[1]);/*to download*/
	$cc_obligation = implode(',', $cc_obligation_details[2]);	/*to download*/
	
	$threemonthssalary = mysql_result($viewleadsbled,0,'Salary');/*to download*/
	$unsecured_emi = mysql_result($viewleadsbled,0,'unsecured_emi');/*to download*/
	$secured_emi = mysql_result($viewleadsbled,0,'secured_emi');/*to download*/
	$card_outstanding = mysql_result($viewleadsbled,0,'card_outstanding');/*to download*/	
	$cibil_reference_id = mysql_result($viewleadsbled,0,'cibil_reference_id');/*to download*/
        
        $current_tenure = mysql_result($viewleadsbled,0,'current_tenure');/*to download*/
        $current_roi = mysql_result($viewleadsbled,0,'current_roi');/*to download*/
        $no_of_emipaid = mysql_result($viewleadsbled,0,'no_of_emipaid');/*to download*/
        

	$Feedback= RemoveBS(clean($row_result["Feedback"]));/*to download*/
	
	$Comment= RemoveBS(clean($row_result["Add_Comment"]));/*to download*/
	
	$getDocsSql = "SELECT * FROM  `zexternal_appointment_docs` WHERE  `RequestID` ='".$RequestID."' and Reply_Type=1 ORDER BY  `zexternal_appointment_docs`.`id` DESC LIMIT 0 , 1";
	$getDocsQuery = ExecQuery($getDocsSql);
	$Address = RemoveBS(clean(mysql_result($getDocsQuery,0,'Address')));/*to download*/
	$docpickerid = mysql_result($getDocsQuery,0,'docpickerid');
	$appt_date= mysql_result($getDocsQuery,0,'appt_date');/*to download*/
	$appt_time= mysql_result($getDocsQuery,0,'appt_time');/*to download*/
	$getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='".$docpickerid."'";
	$getApptDetailsQry = ExecQuery($getFEDetailsSql);
	$FE_Name =mysql_result($getApptDetailsQry,0,'FE_Name');/*to download*/
	$FE_Mobile = mysql_result($getApptDetailsQry,0,'FE_Mobile');/*to download*/
	
	$rm_feedback = '';
	$rm_comments = '';
	$RefFeedbackID ='';
	$AllocatedBidderID ='';
	$BankRefID='';
	$allocatedBidders='';
	$Feedback_ID = '';
	$fieldBidderStr = '';
	$valuesBidderStr='';
	//RM Feedback
	$getCheckNumRows=0;
	$getCheckSql = "select Feedback_ID, BidderID as AllocatedBidderID from Req_Feedback_Bidder_PL where AllRequestID= '".$RequestID."' and Reply_Type='1' GROUP BY  `BidderID` ,  `AllRequestID` ";
	//echo $getCheckSql."<br>";
	 $getCheckQuery = ExecQuery($getCheckSql);
	 $getCheckNumRows = mysql_num_rows($getCheckQuery);
 	if($getCheckNumRows>0)
 	{
		 for($ii=0;$ii<$getCheckNumRows;$ii++)
		 {
		 	$AllocatedBidderID = mysql_result($getCheckQuery,$ii,'AllocatedBidderID');
		 	$Feedback_ID= mysql_result($getCheckQuery,$ii,'Feedback_ID');
		 	$getFeedbackSql = "select Feedback_ID, Comments as rm_comments, Feedback as rm_feedback from Req_Feedback_Comments_PL where AllRequestID= '".$RequestID."' and Reply_Type='1' and BidderID='".$AllocatedBidderID."' and Feedback!=''";
	
			$getFeedbackQuery = ExecQuery($getFeedbackSql);
			
		 	$RefFeedbackID = mysql_result($getFeedbackQuery,0,'Feedback_ID');
		 	if($RefFeedbackID>1)
		 	{}
		 	else 
		 	{ $RefFeedbackID = $Feedback_ID; }
		 	
		 	$AllocatedBidsSql = "SELECT Associated_Bank from Bidders where BidderID ='".$AllocatedBidderID."'";
			$AllocatedBidsQuery = ExecQuery($AllocatedBidsSql);
			$allocatedBidders[]= mysql_result($AllocatedBidsQuery,0,'Associated_Bank');
			$allocatedBidders[] = "PL".$Feedback_ID."S".$AllocatedBidderID;
			$allocatedBidders[] = RemoveBS(mysql_result($getFeedbackQuery,0,'rm_feedback'));
		 	$allocatedBidders[] = RemoveBS(mysql_result($getFeedbackQuery,0,'rm_comments'));
		 	
		 	$getFeedbackSpocSql = "select spoc_status, assigned_remark, docStatus,doc_pickup_remark from zexternal_appointment_docs where `RequestID` ='".$RequestID."' and  BidderID='".$AllocatedBidderID."' and spoc_status!=''";
		 	$getFeedbackSpocQuery = ExecQuery($getFeedbackSpocSql);
		 	$allocatedBidders[] = mysql_result($getFeedbackSpocQuery,0,'spoc_status');
		 	$allocatedBidders[]= mysql_result($getFeedbackSpocQuery,0,'assigned_remark');
		 	$allocatedBidders[]=getdocStatus(mysql_result($getFeedbackSpocQuery,0,'docStatus'));
		 	$allocatedBidders[]=mysql_result($getFeedbackSpocQuery,0,'doc_pickup_remark');
		 	
		 }
		 
		 $totalFieldsBidders = array('constitution', 'year_of_establishment', 'industry', 'request_id', 'query_type', 'employer', 'loan_time', 'Card_Limit', 'add_comment', 'Documents', 'bank_name', 'account_no', 'apt_dt', 'docs', 'address_apt', 'changeapp_time', 'feedback_1', 'feedback_2', 'feedback_3', 'feedback_4', 'feedback_5', 'feedback_6', 'feedback_7', 'feedback_8','feedback_9', 'feedback_10', 'feedback_11', 'feedback_12', 'feedback_13', 'feedback_14', 'feedback_15', 'feedback_16'); //16 fields
		
		 $fieldsBidders = '';
		 $fieldBidderStr ='';
		 $fieldsBiddersDisplay = '';
		 $fieldBidderDisplayStr ='';
		 for($jj=0;$jj<count($allocatedBidders);$jj++)
		 {
		 	$fieldsBidders[] = 	$totalFieldsBidders[$jj];
		 }
		 $fieldBidderStr = ", ".implode(',', $fieldsBidders); // Add in Fields 
				
		 $valuesBidderStr = ', "'.implode(' " ," ', $allocatedBidders).'"'; // Add in Values
		 
	//	 echo $fieldBidderStr."<br>";
		 	$allocatedBidders='';
	} 
		
	
	
	//48 fields
		
	$qry1="insert into temp (session_id, name, dob, email, property_identified, login_date, emp_status, c_name, city, city_other, car_make, car_model, car_type, loan_tenure, property_type, property_value, year_in_comp, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, gender, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, no_of_dependents, annual_income, plan_interested, pincode, source, Feedback, contact_time, count_views, count_replies, is_modified, is_processed, already_download, doe, budget, product_type, property_loc,card_vintage,referred_page, `count`, total_bill, pancard, current_age, no_of_banks, descr, residence_address ".$fieldBidderStr." ) values ('".$session_id."', '".$RefID."', '".$AgentID."', '".$Name."', '".$varFeedback."', '".$comment_section."', '".$Employment_Status."', '".$Net_Salary."', '".$Loan_Amount."', '".$City."', '".$City_Other."', '".$Salary_Drawn."', '".$Primary_Acc."', '".$Pancard."', '".$Company_Name."', '".$Company_Type."', '".$Total_Experience."', '".$Years_In_Company."', '".$PL_EMI_Amt."', '".$CC_Holder."', '".$Card_Vintage."', '".$Emi_Paid."', '".$iVintage."', '".$iCompanyType."', '".$LeadDate."', '".$residence_address."', '".$office_address."', '".$incorporation_date."', '".$pf_deduction."', '".$any_loan_running."', '".$loan_products."', '".$loan_banks."', '".$loan_amount."', '".$loan_emi."', '".$loan_vintage."', '".$cc_banks."', '".$cc_outstanding_amount."', '".$cc_obligation."', '".$threemonthssalary."', '".$unsecured_emi."', '".$secured_emi."', '".$card_outstanding."', '".$cibil_reference_id."', '".$Feedback."', '".$Followup_Date."', '".$Comment."', '".$Address."', '".$current_tenure."', '".$current_roi."', '".$no_of_emipaid."', '".$appt_date."', '".$appt_time."', '".$FE_Name."', '".$company_category."', '".$FE_Mobile."', '".$LoanTime."', '".$PurposeOfLoan."' ".$valuesBidderStr.")";// ".."
		//echo 	$qry1."<br>";	
	ExecQuery($qry1);
	// $fieldBidderStr = '';
	// $valuesBidderStr='';

	  }
	//	die();
	 $totalFieldsBiddersDisplay = array('constitution as Bank', 'year_of_establishment as RefID', 'industry as Feedback', 'request_id as Comment', 'query_type as Bank', 'employer as RefID', 'loan_time as Feedback', 'Card_Limit as Comment', 'add_comment  as Bank', 'Documents as RefID', 'bank_name as Feedback', 'account_no as Comment', 'apt_dt  as Bank', 'docs as RefID', 'address_apt as Feedback', 'changeapp_time as Comment', 'feedback_1 as Bank1Feedback1', 'feedback_2 as Bank1Remark1', 'feedback_3 as Bank1Feedback2', 'feedback_4 as Bank1Remark2', 'feedback_5 as Bank2Feedback1', 'feedback_6  as Bank2Remark1', 'feedback_7  as Bank2Feedback2', 'feedback_8 as Bank2Remark2','feedback_9 as Bank3Feedback1', 'feedback_10 as Bank3Remark1', 'feedback_11 as Bank3Feedback2', 'feedback_12 as Bank3Remark2', 'feedback_13 as Bank4Feedback1', 'feedback_14 as Bank4Remark1', 'feedback_15 as Bank4Feedback2', 'feedback_16 as Bank4Remark2');//16 fields
	 
	  for($jk=0;$jk<count($totalFieldsBiddersDisplay);$jk++)
		 {
		 	$fieldsBiddersDisplay[] = 	$totalFieldsBiddersDisplay[$jk];		 	
		 }
		 $fieldBidderDisplayStr = ", ".implode(',', $fieldsBiddersDisplay); // Add in select Query 

	 
	$qry="select name as RefID, dob as AgentID, email as Name, emp_status as EmploymentStatus, c_name as NetSalary, city as LoanAmount, city_other as City, car_make as CityOther, car_model as SalaryDrawn, car_type as PrimaryAcc, loan_tenure as Pancard,property_type as CompanyName, property_value as CompanyType, current_age AS Company_Category, property_identified AS LMS_Feedback, login_date AS LMS_Remarks, doe as FollowupDate, year_in_comp as TotalExperience, total_exp as YearsInCompany, mobile_number as PLEMIAmt, std_code as CCHolder, landline as CardVintage, std_code_o as EmiPaid, landline_o as iVintage, net_salary as iCompanyType, gender as LeadDate, marital_status as residenceaddress, residential_status as officeaddress, property_loc AS currentTenure,card_vintage AS currentRoi, referred_page AS no_of_emipaid, vehicle_owned as incorporationdate, loan_any as pfdeduction, emi_paid as anyloanrunning, cc_holder as loanproducts, loan_amount as loanbanks, no_of_dependents as loanamount, annual_income as loanemi, plan_interested as loanvintage, pincode as ccbanks, source as ccoutstandingamount, Feedback as ccobligation, contact_time as threemonthssalary, count_views as unsecuredemi, count_replies as securedemi, is_modified as cardoutstanding, is_processed as cibilreferenceid, already_download as Feedback,descr AS LoanTime, residence_address AS PurposeOfLoan, budget as Comment, product_type as Address, `count` as apptdate, total_bill as appttime, pancard as FEName, no_of_banks as FEMobile ".$fieldBidderDisplayStr." from temp where session_id='".$session_id."' order by name DESC ";
$header="";
	$data="";
$result = ExecQuery($qry);	
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
	}

	
	
while($row = mysql_fetch_row($result)){
	  $line = '';
	  foreach($row as $value){
		if(!isset($value) || $value == ""){
		  $value = '"' . $value . '"' . "\t";
		}else{
	# important to escape any quotes to preserve them in the data.
		  $value = str_replace('"', '""', $value);
	# needed to encapsulate data in quotes because some data might be multi line.
	# the good news is that numbers remain numbers in Excel even though quoted.
		  $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	  }
	  $data .= trim($line)."\n";
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
	echo $header."\n".$data; 
	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	$result1 = ExecQuery($qry1);
	//*/
//	$qry1="delete from `temp` where session_id='7gesspepnu7b2th0idsc5l1gj3'";

?>
