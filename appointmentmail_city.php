<?php
require 'scripts/db_init.php';

	$min_date = date('Y-m-d H:i:s', strtotime('-1 hour'));
	$max_date = date('Y-m-d H:i:s');
	$getLeadsSql = "select * from process_send_emails where Status=0 and Dated between '".$min_date."' and '".$max_date."' group by RequestID";
//	$getLeadsSql = "select * from process_send_emails where id=4 and Status=0 ";
	//echo $getLeadsSql = "select * from process_send_emails where id=4";
	$getLeadsQuery = ExecQuery($getLeadsSql);
	$numRows = mysql_num_rows($getLeadsQuery);
	$i = 0;
	for($i=0;$i<$numRows;$i++)
	{
		$id = mysql_result($getLeadsQuery,$i,'id');
		$RequestID = mysql_result($getLeadsQuery,$i,'RequestID');
		$TemplateID = mysql_result($getLeadsQuery,$i,'TemplateID');
		$BankID = mysql_result($getLeadsQuery,$i,'BankID');
		$Reply_Type = mysql_result($getLeadsQuery,$i,'Reply_Type');
		$Process = mysql_result($getLeadsQuery,$i,'Process');
		$Item_Value = mysql_result($getLeadsQuery,$i,'Item_Value');
	
		$mailTemplateSql = "select mail_template from process_templates where id='".$TemplateID."'";
		$mailTemplateQuery = ExecQuery($mailTemplateSql);
		$mail_template = mysql_result($mailTemplateQuery,0,'mail_template');
		
		$getEmailIDSql = "select BidderEmailID as ccEmail, FeedbackMailID as toEmail from Bidders where BidderID='".$BankID."'";
		$getEmailIDQuery = ExecQuery($getEmailIDSql);
		$Toemailid = mysql_result($getEmailIDQuery,0,'toEmail');
		$CCemailid = mysql_result($getEmailIDQuery,0,'ccEmail');
		//$Toemailid = "askupendra@gmail.com";
		$explodeValue = explode("###", $Item_Value);
		
		$getUserSql = "select * from Req_Loan_Personal where RequestID='".$RequestID."'";
		$getUserQuery = ExecQuery($getUserSql);
		
		 
		 $plname."###".$plmobile."###".$showCity."###".$plcompany_name."###".$appointment."###".$Address."###".$docs;
	
		$Name = $explodeValue[0];
		$Mobile = $explodeValue[1];
		$City = $explodeValue[2];
		$Company = $explodeValue[3];
		$Appointment = mysql_result($getUserQuery,0,'Contact_Time');
		$Address = mysql_result($getUserQuery,0,'Residence_Address');
		$documents = mysql_result($getUserQuery,0,'income_proof');
		$documents =  str_replace("|", ", ", $documents); 
		$resiProof = mysql_result($getUserQuery,0,'residence_proof');
		$identification_proof = mysql_result($getUserQuery,0,'identification_proof');
		$document = $identification_proof.", ".$resiProof.", ".$documents;
	//	Name: ##NAME##<br />Contact: ##MOBILE##<br />City: ##CITY##<br />Company Name: ##COMPANYNAME##<br />Appointment Date & Time: ##APPTTIME##<br />Pick-Up Address: ##ADDRESS##<br />Document Informed: ##DOCS##
		$BCCemailid = 'askupendra@gmail.com';
		$mail_template =  str_replace("##NAME##", $Name, $mail_template);
		$mail_template =  str_replace("##MOBILE##", $Mobile, $mail_template);
		$mail_template =  str_replace("##CITY##", $City, $mail_template);
		$mail_template =  str_replace("##COMPANYNAME##", $Company, $mail_template);
		$mail_template =  str_replace("##APPTTIME##", $Appointment, $mail_template);
		$mail_template =  str_replace("##ADDRESS##", $Address , $mail_template);		
		$mail_template =  str_replace("##DOCS##", $document, $mail_template);
		echo $mail_template;
		$SubjectLine = 'Deal4Loans _ Appointment Case '.$Appointment;
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "Cc:".$CCemailid.""."\n";
		$headers .= "Bcc:".$BCCemailid.""."\n";
		//if(strlen($Address)>4)
		//{
			mail($Toemailid,$SubjectLine, $mail_template, $headers);
		//}
		$builtList  ='';
		$mail_template = '';
		$updateSql = ExecQuery("update process_send_emails set Status=1 where id='".$id."'");
		
	}


?>