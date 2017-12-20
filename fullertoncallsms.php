 <?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
session_start();
$min_date = date("Y-m-d");

	$sql  = "select * from fullerton_leads where 1=1 and  a_feedback = 'Fresh' and a_date = '".$min_date."' and sms_done!='1' ";
$query = ExecQuery($sql);
$numRows = mysql_num_rows($query);

$titles = "";
for($i=0;$i<$numRows; $i++)
{
	$SMSMessage = "";
	$a_city = mysql_result($query,$i,'a_city');
	$LeadID = mysql_result($query,$i,'LeadID');  
	$a_time = mysql_result($query,$i,'a_time');
	$doclist = mysql_result($query,$i,'doclist');
	$a_date = mysql_result($query,$i,'a_date');
	if($a_time=="Call Before Going")
	{
		$a_time_msg = "will call you before coming to pick your document on ".$a_date."";
	}  
	else
	{
		$a_time_msg = "will come to pick your document on ".$a_date.", between ".$a_time."";	
	}
	if(strlen($doclist)>0)
	{
		$docs = "Please be ready with the following docs:".$doclist.".";
	}
	
	
	$getRMDetailsSql = "select * from rm_detail_fullerton where rm_city='".$a_city."'";
	$getRMDetailsQuery = ExecQuery($getRMDetailsSql); 	  
	$rm_name = mysql_result($getRMDetailsQuery,0,'rm_name');
	$rm_contact = mysql_result($getRMDetailsQuery,0,'rm_contact');
	
	$getUserSql = "select * from Req_Loan_Personal where RequestID='".$LeadID."'";
	$getUserQuery = ExecQuery($getUserSql);
	$Name = mysql_result($getUserQuery,0,'Name');
	$Mobile_Number = mysql_result($getUserQuery,0,'Mobile_Number');
	//$Mobile_Number = 9899802807;
	 $SMSMessage = "Dear ".$Name.", ".$rm_name." ".$a_time_msg.". Executive's No. ".$rm_contact.". ".$docs."  Team Fullerton";
	
	if(strlen($Mobile_Number)==10)
	{
		SendSMSforLMS($SMSMessage, $Mobile_Number);
		
		$updateSql = "update fullerton_leads set sms_done=1 where LeadID='".$LeadID."'";
		$updateQuery = ExecQuery($updateSql);
		
	}
	
}

?>