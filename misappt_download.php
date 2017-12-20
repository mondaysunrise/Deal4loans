<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';


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
	
/*	function getCompanyType($value)
	{
		if($value==1) { $CompanyType= 'Pvt Ltd'; }
		else if($value==2) { $CompanyType= 'MNC Pvt Ltd'; }
		else if($value==3) { $CompanyType= 'Limited'; }
		else if($value==4) { $CompanyType= 'Central Govt'; }
		else if($value==6) { $CompanyType= 'State Govt'; }
		else if($value==7) { $CompanyType= 'Partnership company'; }
		else if($value==8) { $CompanyType= 'Proprietorship'; }
		
		return $CompanyType;
	}
*/
	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];	
	
	$qry1=str_replace("\'", "'", $qry1);	
	
    $rowQuery= ExecQuery($qry1);

	
	while($row_result= mysql_fetch_array($rowQuery)) {

	//AgentID, RequestID, Name,DOB, City,City_Other, NetProfit, Annual_Turnover, Loan_Amount, Vintage, Company_Type as TypeofCompany, Feedback, Followup_Date, Dated,Add_Comment as Comment
	$RequestID = $row_result["RequestID"];/*to download*/

	$AgentID= $row_result["AgentID"];/*to download*/
	$Name = $row_result["Name"];/*to download*/
	$Bidder = $row_result["Bidder"];
	$Mobile_Number = $row_result["Mobile_Number"];/*to download*/
	$Employment_Status= getEmploymentStatus($row_result["Employment_Status"]);/*to download*/
	$Net_Salary= $row_result["Net_Salary"];/*to download*/
	$Loan_Amount= $row_result["Loan_Amount"];/*to download*/
	$City= $row_result["City"];/*to download*/
	$City_Other= $row_result["City_Other"];/*to download*/
	$Salary_Drawn = getSalaryDrawn($row_result["Salary_Drawn"]);/*to download*/
	$Primary_Acc = $row_result["Primary_Acc"];/*to download*/
	$Pancard= $row_result["Pancard"];/*to download*/
	$Company_Name= $row_result["Company_Name"];/*to download*/	
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
	$residence_address = mysql_result($viewleadsbled,0,'residence_address');/*to download*/
	$office_address = mysql_result($viewleadsbled,0,'office_address');/*to download*/
	$incorporation_date = mysql_result($viewleadsbled,0,'incorporation_date');/*to download*/
	$pf_deduction = getCCHolder(mysql_result($viewleadsbled,0,'pf_deduction'));/*to download*/
	$any_loan_running = getCCHolder(mysql_result($viewleadsbled,0,'any_loan_running'));/*to download*/
	
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

	$Feedback= $row_result["Feedback"];/*to download*/
	$Followup_Date= $row_result["Followup_Date"];/*to download*/
	$Comment= $row_result["comment_section"];/*to download*/
	
	$rm_feedback = '';
	$rm_comments = '';
	//RM Feedback
	$getCheckSql = "select Feedback_ID, Comments as rm_comments, Feedback as rm_feedback from Req_Feedback_Comments_PL where AllRequestID= '".$RequestID."' and Reply_Type='1' and BidderID='".$Bidder."'";
	 $getCheckQuery = ExecQuery($getCheckSql);
	 $rm_feedback = mysql_result($getCheckQuery,0,'rm_feedback');/*to download*/
	 $rm_comments = mysql_result($getCheckQuery,0,'rm_comments');/*to download*/
	 $RefFeedbackID = mysql_result($getCheckQuery,0,'Feedback_ID');

	$getDocsSql = "SELECT * FROM  `zexternal_appointment_docs` WHERE  `RequestID` ='".$RequestID."' and Reply_Type=1 ORDER BY  `zexternal_appointment_docs`.`id` DESC LIMIT 0 , 1";
	//echo "<br>";
	$getDocsQuery = ExecQuery($getDocsSql);
	$Address = mysql_result($getDocsQuery,0,'Address');/*to download*/
	$docpickerid = mysql_result($getDocsQuery,0,'docpickerid');
	$appt_date= mysql_result($getDocsQuery,0,'appt_date');/*to download*/
	$appt_time= mysql_result($getDocsQuery,0,'appt_time');/*to download*/
	$getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='".$docpickerid."'";
	$getApptDetailsQry = ExecQuery($getFEDetailsSql);
	$FE_Name =mysql_result($getApptDetailsQry,0,'FE_Name');/*to download*/
	$FE_Mobile = mysql_result($getApptDetailsQry,0,'FE_Mobile');/*to download*/
	
	$RefID = "PL".$RefFeedbackID."S".$Bidder;
	
		
	$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, car_make, car_model, car_type, loan_tenure, property_type, property_value, year_in_comp, total_exp, mobile_number, std_code, landline, std_code_o, landline_o, net_salary, gender, marital_status, residential_status, vehicle_owned, loan_any, emi_paid, cc_holder, loan_amount, no_of_dependents, annual_income, plan_interested, pincode, source, Feedback, contact_time, count_views, count_replies, is_modified, is_processed, already_download, doe, budget, product_type, `count`, total_bill, pancard, no_of_banks, residence_address,current_age,property_identified,property_loc ) values ('".$session_id."','".$AgentID."', '".$Name."', '".$Mobile_Number."', '".$Employment_Status."', '".$Net_Salary."', '".$Loan_Amount."', '".$City."', '".$City_Other."', '".$Salary_Drawn."', '".$Primary_Acc."', '".$Pancard."', '".$Company_Name."', '".$Company_Type."', '".$Total_Experience."', '".$Years_In_Company."', '".$PL_EMI_Amt."', '".$CC_Holder."', '".$Card_Vintage."', '".$Emi_Paid."', '".$iVintage."', '".$iCompanyType."', '".$LeadDate."', '".$residence_address."', '".$office_address."', '".$incorporation_date."', '".$pf_deduction."', '".$any_loan_running."', '".$loan_products."', '".$loan_banks."', '".$loan_amount."', '".$loan_emi."', '".$loan_vintage."', '".$cc_banks."', '".$cc_outstanding_amount."', '".$cc_obligation."', '".$threemonthssalary."', '".$unsecured_emi."', '".$secured_emi."', '".$card_outstanding."', '".$cibil_reference_id."', '".$Feedback."', '".$Followup_Date."', '".$Comment."', '".$Address."', '".$docpickerid."', '".$appt_date."', '".$appt_time."', '".$FE_Name."', '".$FE_Mobile."', '".$rm_feedback."', '".$rm_comments."', '".$RefID."')";
		//echo 	$qry1."<br>";	
	ExecQuery($qry1);
	  }
	//  die();
	$qry="select property_loc as ReferenceID, name as AgentID,dob as Name,email  as Mobile_Number,emp_status  as Employment_Status,c_name   as Net_Salary,city  as Loan_Amount,city_other  as City,car_make  as City_Other,car_model  as Salary_Drawn,car_type   as Primary_Acc,loan_tenure   as Pancard,property_type as Company_Name,property_value  as Company_Type,year_in_comp  as Total_Experience,total_exp   as Years_In_Company,mobile_number   as PL_EMI_Amt,std_code   as CC_Holder,landline   as Card_Vintage,std_code_o  as Emi_Paid,landline_o  as iVintage,net_salary  as iCompanyType,gender   as LeadDate,marital_status  as residence_address,residential_status  as office_address,vehicle_owned  as incorporation_date,loan_any   as pf_deduction,emi_paid  as any_loan_running,cc_holder  as loan_products,loan_amount  as loan_banks,no_of_dependents  as loan_amount,annual_income   as loan_emi,plan_interested   as loan_vintage,pincode  as cc_banks,source   as cc_outstanding_amount,Feedback  as cc_obligation,contact_time   as threemonthssalary,count_views  as unsecured_emi ,count_replies  as secured_emi,is_modified  as card_outstanding,is_processed   as cibil_reference_id,already_download  as Feedback,doe  as Followup_Date,budget  as Comment,current_age as RMFeedback,property_identified as RMComment, product_type   as Address,`count`  as docpickerid  ,total_bill  as appt_date,pancard  as appt_time,no_of_banks  as FE_Name,residence_address as FE_Mobile from temp where session_id='".$session_id."' order by doe DESC ";
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
