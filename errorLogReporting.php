<?php
require_once 'scripts/db_init.php';
require_once 'scripts/functions_nw.php';
$getConstantsSql = "select name, value from web_services_default_values where status=1";
list($checkmyrowWSNum,$myrowWS)=MainselectfuncNew($getConstantsSql,$array = array());
//print_r($myrow);
for($i=0;$i<$checkmyrowWSNum;$i++)
{
	$name = $myrowWS[$i]['name'];
	$value = $myrowWS[$i]['value'];
	//define($name, $value);		
} 
	$getConstantsMsgSql = "select to_email, cc_email,to_sms, cc_sms, mail_template, sms_template, RM_Name from web_services_notifications where WSID='10001'";
	list($checkmyrowWSNum,$getConstantsMsgVal)=MainselectfuncNew($getConstantsMsgSql,$array = array());
//print_r($getConstantsMsgVal);
	$default_to_email = $getConstantsMsgVal[0]['to_email'];
	$default_cc_email = $getConstantsMsgVal[0]['cc_email'];
	$default_to_sms = $getConstantsMsgVal[0]['to_sms'];
	$default_cc_sms = $getConstantsMsgVal[0]['cc_sms'];
	$default_sms_template = $getConstantsMsgVal[0]['sms_template'];
	$default_email_template = $getConstantsMsgVal[0]['mail_template'];
	$default_RM_Name = $getConstantsMsgVal[0]['RM_Name'];

	define("default_to_email", $default_to_email);
	define("default_cc_email", $default_cc_email);
	define("default_to_sms", $default_to_sms);
	define("default_cc_sms", $default_cc_sms);
	define("default_email_template", $default_email_template);
	define("default_sms_template", $default_sms_template);
	define("default_RM_Name", $default_RM_Name);

class errorLogReporting {

		function errorLogReporting()
		{
			return(true);
		}
	
		function errorReportInsertion($iWebServiceStatus, $finalstat, $ClientName, $Product, $BidderID, $RequestID, $webServiceID, $Allocation_Date)
		{
			//echo "Inside";
		//	echo $iWebServiceStatus.", ".$finalstat.", ".$ClientName.", ".$Product.", ".$BidderID.", ".$RequestID.", ".$webServiceID.", ".$Allocation_Date;
//			echo "<br>";
			//echo WEBSERVICE_STATUS_SUCCESS;
			echo "<br>";
			if($finalstat=='')
			{
				$finalstat = '';
				$iWebServiceStatus = 'WEBSERVICE_STATUS_BLANK';	
			}
			$Dated = ExactServerdate();
			$dataInsert = array('WSID'=>$webServiceID, 'BidderID'=>$BidderID, 'RequestID'=>$RequestID, 'feedback'=>$iWebServiceStatus, 'actual_feedback'=>$finalstat, 'Dated'=>$Dated, 'allocation_date'=>$Allocation_Date, 'Reply_Type'=>$Product);
   			print_r($dataInsert);
			$logid = Maininsertfunc ('web_services_error_log', $dataInsert);
			return $logid; 
		}
		
		function sendMail($webServiceID, $feedback, $actual_feedback, $RequestID, $lastHour, $ClientName, $BidderID)
		{
			$builtList  ='';
			$mail_template = '';
			$getMsgSql = "select * from web_services_notifications where WSID='".$webServiceID." and status=1'";
			list($checkNum,$myrowWS)=MainselectfuncNew($getMsgSql,$array = array());
			echo "<br> checkNum - ".$checkNum."<br>";
			if($checkNum>0)
			{
				$to_email = $myrowWS[0]['to_email'];
				$cc_email = $myrowWS[0]['cc_email'];
				$mail_template = $myrowWS[0]['mail_template'];
				$RM_Name = $myrowWS[0]['RM_Name'];
				echo "<br>If<br>";
			}
			else
			{
				$to_email = default_to_email;
				$cc_email = default_cc_email;
				$mail_template = default_email_template;
				$RM_Name = default_RM_Name;
			}
		
		   $getConstantsSql = "select name, value from web_services_default_values where name='".$feedback."'";
			list($checkmyrowWSNum,$myrowWS)=MainselectfuncNew($getConstantsSql,$array = array());
			$feedbackname = $myrowWS[0]['name'];
			$turnaroundtime = $myrowWS[0]['turnaroundtime'];
		
		    $getWSDetailSql = "select * from web_services_error_log left join web_services on web_services_error_log.WSID=web_services.ID where Status=1 and Dated>'".$lastHour."' and feedback='".$feedback."' and web_services_error_log.WSID='".$webServiceID."' group by RequestID";
			//echo $getWSDetailSql."<br>";
			list($checkgetWSDetailNum, $getWSDetailrow)=MainselectfuncNew($getWSDetailSql,$array = array());
		//	echo $checkgetWSDetailNum."<br>";
//			print_r($getWSDetailrow);
	//		echo "<br>";
			$builtList = '';
			$maskingCharacter = 'X';

			for($i=0;$i<$checkgetWSDetailNum;$i++)
			{
				$RequestID = $getWSDetailrow[$i]['RequestID'];
				$Reply_Type = $getWSDetailrow[$i]['Reply_Type'];
				$table_name = $getWSDetailrow[$i]['table_name'];
				$allotation_table_name = $getWSDetailrow[$i]['allotation_table_name'];
				
				$getLeadSql = "select Name, Mobile_Number as Phone, BidderID from ".$table_name." left join ".$allotation_table_name." on ".$table_name.".RequestID=".$allotation_table_name.".AllRequestID where ".$allotation_table_name.".AllRequestID='".$RequestID."' and Reply_Type='".$Reply_Type."' and ".$allotation_table_name.".BidderID='".$BidderID."'";
				echo $getLeadSql."<br>";

				list($checkLeadNum, $getLeadrow)=MainselectfuncNew($getLeadSql ,$array = array());
				$cName = $getLeadrow[0]['Name'];
				$cPhone = $getLeadrow[0]['Phone'];	
				$BiddID = $getLeadrow[0]['BidderID'];	
				$maskcPhone = substr($cPhone , 0, 2) . str_repeat($maskingCharacter, strlen($cPhone ) - 4) . substr($cPhone , -2);
			echo	$builtList .= "<li><b>Name</b> - ".$cName.", <b>Mobile</b> - ".$maskcPhone .", <b>Allocated to</b> - ".$BiddID."</li>"; 
			}
			
			$SubjectLine = "Webservice issue @".$ClientName." BidderID: ".$BidderID;
			$mail_template =  str_replace("##RM##", $RM_Name, $mail_template);
			$mail_template =  str_replace("##ClientName##", $ClientName, $mail_template);
			$mail_template =  str_replace("##BidderID##", $BidderID, $mail_template);
			$mail_template =  str_replace("##actual_feedback##", $actual_feedback, $mail_template);
			$mail_template =  str_replace("##feedbackname##", $feedbackname, $mail_template);
			$mail_template =  str_replace("##timeDuration##", $turnaroundtime , $mail_template);		
			$mail_template =  str_replace("##leadCount##", $checkgetWSDetailNum, $mail_template);
			$mail_template =  str_replace("##leadDetails##", $builtList , $mail_template);	
			$builtList  ='';
			$Txtmessage = $mail_template;
			$Toemailid = $to_email;
			$CCemailid = $cc_email;
//			$CCemailid .= ",tech@deal4loans.com";
			echo "<br>*****************************************************************<br>";
			echo $SubjectLine."<br>";
			echo $Toemailid."<br>";
			echo $CCemailid."<br>";
			echo $Txtmessage."<br>";
			echo "<br>*****************************************************************<br>";
			//email sending code
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "Cc:".$CCemailid.""."\n";
			mail($Toemailid,$SubjectLine, $Txtmessage, $headers);
		$builtList  ='';
		$mail_template = '';
			//return($checkVar);
		}
	
		// method 2
		function sendSms ($webServiceID, $feedback, $actual_feedback, $RequestID, $lastHour, $ClientName, $BidderID)
		{
			$getMsgSql = "select * from web_services_notifications where WSID='".$webServiceID."' and status=1";
			
			list($checkNum,$myrowWSsms)=MainselectfuncNew($getMsgSql,$array = array());
			echo $getMsgSql.", ".$checkNum;
			if($checkNum>0)
			{
				$to_sms = $myrowWSsms[0]['to_sms'];
				$cc_sms = $myrowWSsms[0]['cc_sms'];	
				$sms_template = $myrowWSsms[0]['sms_template'];
			}
			else
			{
				$sms_template = default_sms_template;
				$to_sms = default_to_sms;
				$cc_sms = default_cc_sms;				
			}
			if(strlen($cc_sms)>0)
			{
				$toSms = $to_sms.",".$cc_sms;
			}
			else
			{
				$toSms = $to_sms;
			}
			echo "<br>*****************************************************************<br>";
			
			$sms_template =  str_replace("##ClientName##", $ClientName, $sms_template);
			$sms_template =  str_replace("##BidderID##", $BidderID, $sms_template);
			$sms_template =  str_replace("##feedback##", $feedback, $sms_template);
			


		//	$mob = 9971396361;
		//	SendSMSAir2web("Test for SMS", $mob);

			$SMSMessage = $sms_template;
			echo $SMSMessage."<br>";
			$arrayToSms = explode(",", $toSms);
			//print_r($arrayToSms);
			echo "<br>";
			for($i=0;$i<count($arrayToSms);$i++)
			{
				echo $SMSMessage.", ".trim($arrayToSms[$i]);
				SendSMSforLMS($SMSMessage, trim($arrayToSms[$i]));
			}
			echo "<br>*****************************************************************<br>";
			return(true);
		}
		
		function ccMasking($number, $maskingCharacter = 'X') 
		{
		    return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
		}

		
		function errorReporting($iWebServiceStatus, $finalstat, $ClientName, $Product, $BidderID, $RequestID, $webServiceID)
		{
		}
	}
?>