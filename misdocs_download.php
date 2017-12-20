<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
//require 'scripts/functions.php';

	function getdocStatus($value)
	{
		if($value==1) { $docStatus= 'Complete'; }
		else if($value==2) { $docStatus= 'Incomplete Pick-up'; }
		else if($value==3) { $docStatus= 'Sent For Login'; }
		else if($value==4) { $docStatus= 'Return To Sales'; }
		else if($value==5) { $docStatus= 'Logged In'; }
		else if($value==6) { $docStatus= 'Approved'; }
		else if($value==7) { $docStatus= 'Disbursed'; }
		else if($value==8) { $docStatus= 'Post Login Reject'; }
		return $docStatus;
	}

	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];	
	
	$qry1=str_replace("\'", "'", $qry1);	
	
    $rowQuery= ExecQuery($qry1);
//	echo "fff".$qry1."<br>";
	$num_rows = mysql_num_rows($rowQuery);
	
	
	while($row_result= mysql_fetch_array($rowQuery)) {
	
//	Req_Loan_Personal.RequestID AS AllRequestID, Name, City, Mobile_Number, docpickerid, id, caller_id, Loan_Amount, Company_Name, Net_Salary, appt_date, appt_time, special_remarks, spoc_status, assigned_remark, doc_pickup_remark, zexternal_appointment_docs.updated_date AS updateDt, docStatus

	$RequestID = $row_result["AllRequestID"];
	$AgentID= $row_result["caller_id"];/*to download*/	
		$getRefIDSql = "select FeedbackID,BidderID from Req_Feedback_PL where AllRequestID='".$RequestID."'";
		$getRefIDSql = "select Feedback_ID,BidderID from client_lead_allocate where AllRequestID='".$RequestID."' and BidderID='".$AgentID."'";
		$getRefIDResult = ExecQuery($getRefIDSql);
		
		$FeedbackID = mysql_result($getRefIDResult,0,'Feedback_ID');
		$BidderID = mysql_result($getRefIDResult,0,'BidderID');
  		$RefID= "PL".$FeedbackID."S".$BidderID;/*to download*/
	

	
	$Name = $row_result["Name"];/*to download*/
	$City= $row_result["City"];/*to download*/
	$Loan_Amount= $row_result["Loan_Amount"];/*to download*/
	$Net_Salary= $row_result["Net_Salary"];/*to download*/
	$Company_Name= $row_result["Company_Name"];/*to download*/
	$getFeedbackSql = "select * from client_lead_allocate where AllRequestID='".$RequestID."' and BidderID='".$AgentID."' and Reply_Type=1";
	$getFeedbackQuery = ExecQuery($getFeedbackSql);
	$Feedback = mysql_result($getFeedbackQuery,0,'Feedback');/*to download*/
	//$Followup_Date = mysql_result($getFeedbackQuery,0,'Followup_Date');/*to download*/
	$Comments = mysql_result($getFeedbackQuery,0,'Comments');/*to download*/

	$appt_date= $row_result["appt_date"];/*to download*/
	$appt_time= $row_result["appt_time"];/*to download*/
	$docStatus= $row_result["docStatus"];
	$idocStatus = getdocStatus($docStatus);/*to download*/
	$spocFeedback = $row_result["spoc_status"];/*to download*/
	
	
	$special_remarks = $row_result["special_remarks"];/*to download*/
	$assigned_remark= $row_result["assigned_remark"];/*to download*/
	$doc_pickup_remark= $row_result["doc_pickup_remark"];/*to download*/	
	$updateDt= $row_result["updateDt"];/*to download*/
	$getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='".$row_result["docpickerid"]."'";
	$getFEDetailsQry = ExecQuery($getFEDetailsSql);
	$FE_Name = mysql_result($getFEDetailsQry,0,'FE_Name');
	$FE_Mobile = mysql_result($getFEDetailsQry,0,'FE_Mobile');
	
	$sqlExtraFields = "select cibil_reference_id from Req_Loan_Personal_Extra_Fields where RequestID='".$RequestID."'";
	$queryExtraFields = ExecQuery($sqlExtraFields);
	$cibil_reference_id = mysql_result($queryExtraFields,0,'cibil_reference_id');
	
	$getBankSql = "select Associated_Bank from Bidders where BidderID='".$AgentID."' and Bidders.Associated_Bank in ('Tata Capital', 'ICICI Bank')";
	$getBankResult = ExecQuery($getBankSql);
	$Associated_Bank = mysql_result($getBankResult,0,'Associated_Bank');;

		
	 	$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, car_make, car_model, car_type, loan_tenure, property_type, property_value, year_in_comp, total_exp, mobile_number, std_code,landline, std_code_o, landline_o, net_salary) values ('".$session_id."', '".$AgentID."', '".$RefID."', '".$Name."', '".$City."', '".$Loan_Amount."', '".$Net_Salary."', '".$Company_Name."', '".$Feedback ."', '".$Comments."', '".$appt_date."', '".$appt_time."', '".$idocStatus."', '".$spocFeedback."', '".$special_remarks."', '".$assigned_remark."', '".$doc_pickup_remark."', '".$updateDt."', '".$FE_Name."', '".$FE_Mobile."', '".$cibil_reference_id."', '".$Associated_Bank."')";
		ExecQuery($qry1);
	//	die();
	  }
		
	$qry="select name as AgentID, dob as ReferenceID, net_salary as Bank, email as Name, emp_status as City, c_name as LoanAmount, city as NetSalary, city_other as CompanyName, car_make as Feedback, car_model as Comments, car_type as ApptDate, loan_tenure as ApptTime, property_type as DocStatus, property_value as SpocFeedback, year_in_comp as SpecialRemarks, total_exp as AssignedRemarks, mobile_number as PickupRemarks, std_code as UpdatedDate, landline_o as CibilRefID, landline as FEName, std_code_o as FEMobile from temp where session_id='".$session_id."' order by doe DESC ";
	//echo "<br>".$qry1;
$header="";
	$data="";
$result = ExecQuery($qry);	
	$count = mysql_num_fields($result);
	
	for ($i = 0; $i < $count; $i++){
		$header .= mysql_field_name($result, $i)."\t";
	}

//	die();
	
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
