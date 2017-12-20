<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

/*
$mailer = 1;
$detailsArr = array();
$detailsArr['request_id'] = '945612';
$detailsArr['customer_name'] = 'Test';
$detailsArr['customer_email'] = 'rachit2264@gmail.com';
$detailsArr['bank_name'] = 'SBI';
$detailsArr['customer_phone'] = '8566463214';
$detailsArr['customer_location'] = 'Noida';
$detailsArr['card_name'] = 'Simply Save';

SendMailToCustomers($detailsArr, $mailer);
*/

function SendMailToCustomers($detailsArr, $mailer=1){
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'];
	
	$getsbiResponseSql = "SELECT * FROM `sbi_credit_card_5633` WHERE RequestID = '".$detailsArr['request_id']."'";
	list($numRows,$getsbiResponse)=MainselectfuncNew($getsbiResponseSql,$array = array());
	//echo '<pre>';print_r($getsbiResponse);
	$ProcessingStatus = $getsbiResponse[0]['ProcessingStatus'];
	
	//Send Mail if Status code is 1 or 2
	if($ProcessingStatus == 1 || $ProcessingStatus == 2){

		if($mailer == 1){
			$message = '<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" style="border:thin solid #999; max-width:600px;">
			<tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td align="right" style="padding-right:15px;"><img src="http://www.deal4loans.com/new-images/d4l-pl-logo.png" width="91" height="34" /></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			  <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#222222; font-size:16px;">Dear '.$detailsArr['customer_name'].'</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#222222;"><strong style="color:#2a7d06;">Congratulations! </strong> Your card application for <strong>'.$detailsArr['bank_name'].'</strong> has been forwarded by us to Bank for further processing and issuance of credit card would be the sole discretion of Bank/Financial institution as per their internal Credit &amp; Risk Policy, positive verifications with due diligence check of detail provided by you in the online application form. </td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#222222;">Thank you for investing your valuable time with us on the call today for your credit card application.</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#222222;">You have made an awesome choice of credit card that would definitely fit your requirement and you will get plenty of benefits on usage. </td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#222222;">While on the call, our team has gathered the following information this will be used to process your credit card application with the respective Bank. </td>
				</tr>
			  </table></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td bgcolor="#e7e7e7"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td colspan="3">&nbsp;</td>
				</tr>
				<tr>
				  <td colspan="3" style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#222222; font-weight:bold;">Customer Details</td>
				</tr>
				<tr>
				  <td colspan="3" height="5"></td>
				</tr>
				<tr>
				  <td width="20%" height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#222222;">Name</td>
				  <td width="3%" height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:16px; color:#222222;">: </td>
				  <td width="77%" style="font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:16px; color:#222222;">'.$detailsArr['customer_name'].'</td>
				</tr>
				<tr>
				  <td height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#222222;">Number</td>
				  <td height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:16px; color:#222222;">: </td>
				  <td height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:16px; color:#222222;">'.$detailsArr['customer_phone'].'</td>
				</tr>
				<tr>
				  <td height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#222222;">Location </td>
				  <td height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:16px; color:#222222;">: </td>
				  <td height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:16px; color:#222222;">'.$detailsArr['customer_location'].'</td>
				</tr>
				<tr>
				  <td height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#222222;">Card name </td>
				  <td height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:16px; color:#222222;">: </td>
				  <td height="25" style="font-family:Arial, Helvetica, sans-serif; font-weight:normal; font-size:16px; color:#222222;">'.$detailsArr['card_name'].'</td>
				</tr>
				<tr>
				  <td colspan="3">&nbsp;</td>
				</tr>
			  </table></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; color:#222222; font-size:16px;">We hope you had a pleasant experience with us for your credit card application and our team has been able to assist you during the process, to the highest level of your satisfaction.</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; color:#222222; font-size:16px;">Kindly submit necessary documents to pick up executives that will get in touch with you , this will help to get your credit card application decision  fast.</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; color:#8d8d8d; font-size:14px;">In case you do not wish to go ahead with this application right now, you can de-activate the request <strong style="color:#0f51b4; font-weight:normal;"><a href="'.$url.'/credit_card_approval_status.php?postid='.$detailsArr['request_id'].'" style="color:#0f51b4; text-decoration:none;">&lt;here&gt;</a></strong>, else we shall consider your consent and initiate the process with respective Bank in next 30 mins. </td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; color:#222222; font-size:16px;">We are committed to deliver best in class service to our valued customers and associate with you for long term to serve you with all your future personal financial requirements. </td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="color:#000000; font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Warm Regards</td>
				</tr>
			  </table></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			</tr>
			</table>';
		}
		else{
			$message = '<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" style="border:thin solid #999; max-width:600px;">
			<tr>
			  <td>&nbsp;</td>
			</tr>
			<tr>
			  <td align="right" style="padding-right:15px;"><img src="http://www.deal4loans.com/new-images/d4l-pl-logo.png" width="91" height="34" /></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			</tr>
			<tr>
			  <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#222222; font-size:16px;">Dear '.$detailsArr['customer_name'].'</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#222222;"><strong style="color:#2a7d06;">Hooray!!, </strong> Your credit card application for <strong>'.$detailsArr['bank_name'].'</strong> credit card is now with the Bank , you are one step closer get your new card. </td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#222222;">Your consent to process you application for <strong>'.$detailsArr['bank_name'].'</strong> credit card with is considered final now, we have put forward the application process with the Bank.</td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				<tr>
				  <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#222222;">Request your coordination with Bank representative for smooth and faster processing of your credit card application.<br />
					Get ready to enjoy the benefits with the amazing offers your new credit card will bring along. <br /></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				</tr>
				</table></td>
			</tr>
			<tr>
			  <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td style="color:#000000; font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;">Warm Regards</td>
				</tr>
				</table></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			</tr>
			</table>';
		}
		//print_r($message);
		
		////////////////--------------Send Mail via PHP---------------///////////////
		/*
		//$to = $detailsArr['customer_email'];
		$to = 'rachit2264@gmail.com';
		$subject = "Sample Mail Testing";

		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: Rachit Wishfin<rachit.jain@wishfin.com>' . "\r\n";
		//$headers .= 'Cc: abc@abc.com' . "\r\n";
		//$headers .= 'Bcc: abc@abc.com' . "\r\n";

		// Send email
		if(mail($to,$subject,$message,$headers)){
			$Msg = 'Mail Sent';
		}
		else{
			$Msg = 'Mail Failed';
		}
		*/
		////////////////--------------Send Mail via PHP---------------///////////////


		////////////////--------------Send Mail via CheetahMail---------------///////////////
		
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', triggeredlogin() , $matches);
		$cookies = array();
		foreach($matches[1] as $item) {
			parse_str($item, $cookie);
			$cookies = array_merge($cookies, $cookie);
		}
		$sessioncookie = $cookies["PubAuth1"];
		
		$sentmailres = sendCheetahMail($sessioncookie, $detailsArr, $mailer);
		
		$detailsArr1 = array();
		$detailsArr1 = $detailsArr;
		//$detailsArr1['customer_email'] = 'upendra@wishfin.com';
		$detailsArr1['customer_email'] = 'cards.deal4loans@gmail.com'; //PWD - ZGVhbDRsb2Fucw==(encoded)
		$sentmailres1 = sendCheetahMail($sessioncookie, $detailsArr1, $mailer);

		
		////////////////--------------Send Mail via CheetahMail---------------///////////////


		//Insert log into credit_card_mail_logs table
		if($mailer == 1){
			$getmailLogSql = "SELECT * FROM `credit_card_mail_logs` WHERE request_id = '".$detailsArr['request_id']."'";
			//list($alreadyexist,$getmailLogResponse)=MainselectfuncNew($getmailLogSql,$array = array());
			$getmailLogResponse = ExecQuery($getmailLogSql);
			$request_id = mysql_result($getmailLogResponse,0,'request_id');
			
			if(!empty($request_id)){
				$updateMailLogQry="UPDATE credit_card_mail_logs set mail1_response='".$Msg."', customer_consent = '1', bank_name = '".$detailsArr['bank_name']."', webservice_response = '".$getsbiResponse[0]['ProcessingStatus']."', created_date = NOW() WHERE request_id='".$detailsArr['request_id']."'";
				$updateMailLogQry;
				$updatemailLogRes = ExecQuery($updateMailLogQry);
			}
			else{
				$insertMailLogQry="INSERT INTO credit_card_mail_logs set request_id='".$detailsArr['request_id']."',mail1_response='".$Msg."', customer_consent = '1', bank_name = '".$detailsArr['bank_name']."', webservice_response = '".$getsbiResponse[0]['ProcessingStatus']."', created_date = NOW()";
				$insertMailLogQry;
				$insertmailLogRes = ExecQuery($insertMailLogQry);
			}
		}
	}
}

function triggeredlogin(){
	$strCookie1 = "sessionId=".session_id()."; path=".session_save_path();
	session_write_close();
	
	$url = "https://ebm.cheetahmail.com/api/login1?name=deal4loans_API&cleartext=login@135";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	//	curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded','Content-Length:'. strlen($request)));
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIE, $strCookie1);
	$returnvalue= curl_exec ($ch);
	return($returnvalue);
}

function sendCheetahMail($sessioncookie, $detailsArr, $mailer){
	$param = array();
	$param["aid"] = 2103064721;
	
	if($mailer == 1){
		$eventID = 300832;
		
		$param["email"] = $detailsArr['customer_email'];
		$param["eid"] = $eventID;
		$param["RCODE"] = $detailsArr['request_id'];
		$param["FULL_NAME"] = ucwords(strtolower($detailsArr['customer_name']));
		$param["SALARY"] = $detailsArr['bank_name'];
		$param["PHONE"] = $detailsArr['customer_phone'];
		$param["CITY"] = $detailsArr['customer_location'];
		$param["LOANAMOUNT"] = $detailsArr['card_name'];
		
	}
	else{
		$eventID = 300774;
		
		$param["email"] = $detailsArr['customer_email'];
		$param["eid"] = $eventID;
		$param["FULL_NAME"] = ucwords(strtolower($detailsArr['customer_name']));
		$param["SALARY"] = $detailsArr['bank_name'];
		
	}

	$requestPost = "";
	//traverse through each member of the param array
	foreach($param as $key=>$val){ 
		//we have to urlencode the values
  		$requestPost.= $key."=".urlencode($val); 
  		//append the ampersand (&) sign after each paramter/value pair
  		$requestPost.= "&"; 
	}
	//remove the final ampersand sign from the request
	$requestPost= substr($requestPost, 0, strlen($requestPost)-1); 
	//echo $requestPost;

	$url = "https://ebm.cheetahmail.com/ebm/ebmtrigger1";

	$strCookie = "PubAuth1=".urlencode($sessioncookie)."; path=/; ";
	session_write_close();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPost);
	$content = curl_exec ($ch);
	//echo "<br><br>";
	//print_r($content);
	$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$header = substr($content, 0, $header_size);
	$body = substr($content, $header_size);
	//echo "<pre>";print_r($header_size);print_r($header);print_r($body);
	curl_close ($ch);
	if($body == 'OK'){
		return 'Mail Sent';
	}
	else{
		return $body;
	}
}

?>
