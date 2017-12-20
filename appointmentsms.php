<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

// to Customer when set appointment
toCustomeratAppointment();
function toCustomeratAppointment() // By Caller
{
	$min_date = date('Y-m-d H:i:s', strtotime('-1 hour'));
	$max_date = date('Y-m-d H:i:s');

	echo $getSql = "select * from zexternal_appointment_docs where (dated between '".$min_date."' and '".$max_date."' )";
	echo "<BR><br>";
	$getQuery = ExecQuery($getSql);
	$numRows = mysql_num_rows($getQuery);
	$sendSMSContent = '';
	for($i=0;$i<$numRows;$i++)
	{
		$sendSMSContent = '';
		$RequestID = mysql_result($getQuery,$i,'RequestID');
		$getCustomerSql = "select Name,Mobile_Number from Req_Loan_Personal where RequestID='".$RequestID."'";
		$getCustomerQuery = ExecQuery($getCustomerSql);
		$CustomerName = mysql_result($getCustomerQuery,0,'Name');
		$CustomerMobile_Number = mysql_result($getCustomerQuery,0,'Mobile_Number');
		$Address = mysql_result($getQuery,$i,'Address');
		$PanCard = mysql_result($getQuery,$i,'PanCard');
		$PanCard_Status = mysql_result($getQuery,$i,'PanCard_Status');
		$SalSlip = mysql_result($getQuery,$i,'SalSlip');
		$SalSlip_Status = mysql_result($getQuery,$i,'SalSlip_Status');
		$BankStmnt = mysql_result($getQuery,$i,'BankStmnt');
		$BankStmnt_Status = mysql_result($getQuery,$i,'BankStmnt_Status');
		$PassSizePhoto = mysql_result($getQuery,$i,'PassSizePhoto');
		$PassSizePhoto_Status = mysql_result($getQuery,$i,'PassSizePhoto_Status');
		$IDProof = mysql_result($getQuery,$i,'IDProof');
		$IDProof_Status = mysql_result($getQuery,$i,'IDProof_Status');
		$AddressProof = mysql_result($getQuery,$i,'AddressProof');
		$AddressProof_Status = mysql_result($getQuery,$i,'AddressProof_Status');
		$docpickerid = mysql_result($getQuery,$i,'docpickerid');
		$appt_date = mysql_result($getQuery,$i,'appt_date');
		$appt_time = mysql_result($getQuery,$i,'appt_time');
		
		$sendSMSContent .= "Dear ".$CustomerName.", Please keep the following documents ready - " ;
		
		$sendSMSContent .= ucwords(strtolower($IDProof))."," ; 
		$sendSMSContent .=ucwords(strtolower($AddressProof)).",";
		$sendSMSContent .=ucwords(strtolower($PanCard)).",";
		$sendSMSContent .=ucwords(strtolower($SalSlip)).",";
		$sendSMSContent .=ucwords(strtolower($BankStmnt)).",";
		$sendSMSContent .=ucwords(strtolower($PassSizePhoto)); 
		$sendSMSContent .= "";	
	
		 echo "To - ".$CustomerMobile_Number." - Content - ".$sendSMSContent;
		 echo "<br>";	
	  $PhoneNumber=9971396361;
	  $PhoneNumber=9811215138;
		 SendSMSforLMS($sendSMSContent, $PhoneNumber);
		 $sendSMSContent = '';
	}
}
/*	$getFESql = "select Name,Mobile_Number from zexternal_appointment_users where id='".$docpickerid."'";
	$getFEQuery = ExecQuery($getFESql);
	$FEName = mysql_result($getCustomerQuery,0,'Name');
	$FEMobile_Number = mysql_result($getCustomerQuery,0,'Mobile_Number');
*/
?>
