<?php 
require_once("includes/application-top-inner.php");
	$sqlUpdate = "UPDATE " . TABLE_APPT_DOCS . " SET docpickerid ='".$_REQUEST['ppval']."', AssignBy='".$_REQUEST['AssBy']."', updated_date=Now()  WHERE id='".$_REQUEST['id']."'";
//	$Update = $result = $obj->fun_db_query($sqlUpdate);
	
	echo $getSpocDetailsSql = "select * from zexternal_appointment_users where id='".$_REQUEST['ppval']."'";
	$getSpocDetailsResult = $obj->fun_db_query($getSpocDetailsSql);
	$rowsSpoc = $obj->fun_db_fetch_rs_object($getSpocDetailsResult);
	print_r($rowsSpoc);
	$spocID =$_REQUEST['ppval'];
	$spocName = $rowsSpoc->Name;
	$spocMobile_Number = $rowsSpoc->Mobile_Number;
	$spocOwner = $rowsSpoc->Owner;

	echo "<br>";

	echo $getCustomerSql = "SELECT Req_Loan_Personal.RequestID as CustID, Name, Mobile_Number,zexternal_appointment_docs.appt_date as apptDate, zexternal_appointment_docs.appt_time as apptTime, Address FROM Req_Loan_Personal LEFT JOIN zexternal_appointment_docs ON Req_Loan_Personal.RequestID = zexternal_appointment_docs.RequestID WHERE zexternal_appointment_docs.id ='".$_REQUEST['id']."'";
	$getCustomerDetailsResult = $obj->fun_db_query($getCustomerSql);
	$rowsCustomer = $obj->fun_db_fetch_rs_object($getCustomerDetailsResult);
	print_r($rowsCustomer);
	$CustomerName = $rowsCustomer->Name;
	$CustomerMobile_Number = $rowsCustomer->Mobile_Number;
	$CustomerapptDate = $rowsCustomer->apptDate;
	$CustomerapptTime = $rowsCustomer->apptTime;
	$CustomerAddress = $rowsCustomer->Address;	
	$CustID = $rowsCustomer->CustID;	
	
	
	
	if($spocOwner==16)//ICICI Process
	{
		$spoc_Message = "Hi, PFB pick-up details :- ".$CustomerName.", ".$CustomerMobile_Number.", Date-".$CustomerapptDate.", Time- ".$CustomerapptTime.", Address-".$CustomerAddress." Regards, ".$spocName;
		
		$customer_Message = "Dear ".$CustomerName.", Mr. ".$spocName." (".$spocMobile_Number.") will be coming to collect your documents @ ".$CustomerapptDate." ".$CustomerapptTime." for ICICI Bank Personal Loan. Request you to submit all docs at one shot for speedy disbursal. Regards, ".$spocName;
			
	}
	else if($spocOwner=47)//Business Loan
	{
		$spoc_Message = "Hi, PFB pick-up details :- ".$CustomerName.", ".$CustomerMobile_Number.", Date-".$CustomerapptDate.", Time- ".$CustomerapptTime.", Address-".$CustomerAddress." Regards, ".$spocName;
	
		$customer_Message = "Dear ".$CustomerName.", Mr. ".$spocName." (".$spocMobile_Number.") will be coming to collect your documents @ ".$CustomerapptDate." ".$CustomerapptTime." for Business Loan. Request you to submit KYC/ITR/Loan Track at one shot for speedy disbursal. Regards, ".$spocName;	
	}
		
	$insertSMSSpocSql = "INSERT INTO zexternal_send_appointment_sms (send_id, send_name, send_mobile, message, dated, appt_date, send_status, appt_send_status, user_type) VALUES ('".$spocID."', '".$spocName."', '".$spocMobile_Number."', '".$spoc_Message."', Now(), '".$CustomerapptDate."', '0', '0','Spoc')";
	$resultinsertSMSSpocSql = $obj->fun_db_query($insertSMSSpocSql);

	$insertSMSCustomerSql = "INSERT INTO zexternal_send_appointment_sms (send_id, send_name, send_mobile, message, dated, appt_date, send_status, appt_send_status, user_type) VALUES ('".$CustID."', '".$CustomerName."', '".$CustomerMobile_Number."', '".$customer_Message."', Now(), '".$CustomerapptDate."', '0', '0','Customer')";
	$resultinsertSMSCustomerSql = $obj->fun_db_query($insertSMSCustomerSql);
	
	
	if($Update==1)
	{
	echo $msg=PICKEDPERSONUPDATED;	
	}
?>