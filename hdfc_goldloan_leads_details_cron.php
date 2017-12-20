<?php
require 'scripts/db_init.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

HDFC_GL_LEADS_DETAILS_CRON();

function HDFC_GL_LEADS_DETAILS_CRON(){
	$currentdatetime = date('Y-m-d H:i');
	
	//$currentdatetime =  '2017-06-05 09:00';
	//echo $currentdatetime.'<br/>';
	
	$firstbatchdatetime = date('Y-m-d 09:00');
	$secondbatchdatetime = date('Y-m-d 12:00');
	$thirdbatchdatetime = date('Y-m-d 16:00');
	
	//echo strtotime($currentdatetime).'<br/>';
	//echo strtotime($firstbatchdatetime).'<br/>';
	//echo strtotime($secondbatchdatetime).'<br/>';
	//echo strtotime($thirdbatchdatetime).'<br/>';
	
	if(strtotime($currentdatetime) <= strtotime($firstbatchdatetime)){
		$startDate = date('Y-m-d 16:00', strtotime($currentdatetime .' -1 day'));
		$endDate = $firstbatchdatetime;
	}elseif((strtotime($currentdatetime) > strtotime($firstbatchdatetime)) && (strtotime($currentdatetime) <= strtotime($secondbatchdatetime))){
		$startDate = $firstbatchdatetime;
		$endDate = $secondbatchdatetime;
	}elseif((strtotime($currentdatetime) > strtotime($secondbatchdatetime)) && (strtotime($currentdatetime) <= strtotime($thirdbatchdatetime))){
		$startDate = $secondbatchdatetime;
		$endDate = $thirdbatchdatetime;
	}else{
		$startDate = date('Y-m-d 00:00');
		$endDate = date('Y-m-d 23:59');
	}
	//echo $startDate.'<br/>'.$endDate;
	
	//Get Last Request ID for which Feedback was updated
	$LastUpdatedReuestIDQry = "SELECT RequestID FROM Req_Compaign WHERE Bank_Name = 'HDFC LEAD DETAILS CRON' AND Reply_Type = 7";
	$LastUpdatedReuestIDResult=ExecQuery($LastUpdatedReuestIDQry);
	$LastRequestIDResult = mysql_fetch_assoc($LastUpdatedReuestIDResult);
	$LastRequestID = $LastRequestIDResult['RequestID'];
	//echo $LastRequestID;exit;
	//$LastRequestID = 1;

	if(!empty($LastRequestID)){
		$requestQry1 = "SELECT RLG.Name AS FullName, RLG.Mobile_Number AS MobileNo, hgc.branch_name AS City";
		
		$requestQry2 = ", RLG.RequestID, RFB.BidderID";
		
		$requestQry3 = " FROM Req_Feedback_Bidder1 AS RFB, Req_Loan_Gold AS RLG LEFT OUTER JOIN hdfc_goldloan_citylist AS hgc ON (hgc.branch = RLG.City) WHERE (RFB.AllRequestID=RLG.RequestID) AND (RFB.BidderID = '5570') AND (RFB.Reply_Type=7) AND (RFB.Allocation_Date  Between '".$startDate."' AND '".$endDate."' ) AND RLG.RequestID > '".$LastRequestID."' GROUP BY RLG.RequestID ORDER BY RLG.RequestID ASC";
	}
	else{
		$requestQry1 = "SELECT RLG.Name AS FullName, RLG.Mobile_Number AS MobileNo, hgc.branch_name AS City";
		
		$requestQry2 = ", RLG.RequestID, RFB.BidderID";
		
		$requestQry3 = " FROM Req_Feedback_Bidder1 AS RFB, Req_Loan_Gold AS RLG LEFT OUTER JOIN hdfc_goldloan_citylist AS hgc ON (hgc.branch = RLG.City) WHERE (RFB.AllRequestID=RLG.RequestID) AND (RFB.BidderID = '5570') AND (RFB.Reply_Type=7) AND (RFB.Allocation_Date  Between '".$startDate."' AND '".$endDate."') GROUP BY RLG.RequestID ORDER BY RLG.RequestID ASC";
	}
	
	$finalrequestQry = $requestQry1.$requestQry2.$requestQry3;
	//echo '<br/>'.$finalrequestQry;
	$queryresult=ExecQuery($finalrequestQry);
	$totalrows = mysql_num_rows($queryresult);

	if($totalrows > 0){
		while($rowbid = mysql_fetch_assoc($queryresult)){
			//echo '<pre>';print_r($rowbid);
			//Insert Entry into Req_Compaign
			if(!empty($rowbid["RequestID"])){
				$RequestID = $rowbid["RequestID"];
				$BidderID = $rowbid["BidderID"];
				$qry1 = "Update Req_Compaign SET RequestID = '".$RequestID."', BidderID = '".$BidderID."', Dated = Now() WHERE Bank_Name = 'HDFC LEAD DETAILS CRON' AND Reply_Type = 7";
				echo $qry1;
				$result = ExecQuery($qry1);
			}
		}

		$finalxlsQry = $requestQry1.$requestQry3;
		//echo '<br/>'.$finalxlsQry;
		saveDbDataToXls($finalxlsQry);

		$name = 'GL.Product@hdfcbank.com';
		$email = 'GL.Product@hdfcbank.com';

		//$name = 'Rachit';
		//$email = 'rachit2264@gmail.com';

		$detailsArr = array();
		$detailsArr['customer_name'] = $name;
		$detailsArr['customer_email'] =  $email;

		SendNormalMailToCustomers($detailsArr, $totalrows);
	}
}


function saveDbDataToXls($Sql){
	$header = '';
	$result = '';
	$server_path = $_SERVER['DOCUMENT_ROOT'];

	$exportData = ExecQuery($Sql);
	$fields = mysql_num_fields ( $exportData );
	 
	for ( $i = 0; $i < $fields; $i++ )
	{
		$header .= mysql_field_name( $exportData , $i ) . "\t";
	}
	 
	while( $row = mysql_fetch_row( $exportData ) )
	{
		$line = '';
		foreach( $row as $value )
		{                                            
			if ( ( !isset( $value ) ) || ( $value == "" ) )
			{
				$value = "\t";
			}
			else
			{
				$value = str_replace( '"' , '""' , $value );
				$value = '"' . $value . '"' . "\t";
			}
			$line .= $value;
		}
		$result .= trim( $line ) . "\n";
	}
	$result = str_replace( "\r" , "" , $result );
	 
	if ( $result == "" )
	{
		$result = "\nNo Record(s) Found!\n";                        
	}

	$output = "$header\n$result";
	//$csvfile = $server_path.'/data/files/hdfc_leads.xls';
	$csvfile = '/home/deal4loans/public_html/data/files/hdfc_leads.xls';
	file_put_contents($csvfile, $output);
}


function SendNormalMailToCustomers($detailsArr, $totalrows){
	//$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	//$url = $protocol . $_SERVER['HTTP_HOST'];

	if($totalrows > 0){
		$message = 'PFA file to get details of Gold Loan users for HDFC.';
	}else{
		$message = 'No records exist.';
	}
	
	$server_path = $_SERVER['DOCUMENT_ROOT'];
	$filename = 'hdfc_leads.xls';
    //$path = $server_path.'/data/files';
    $path = '/home/deal4loans/public_html/data/files';
    $file = $path . "/" . $filename;
    
    $newfilename = date('Y-m-d').'.xls';
	
	////////////////--------------Send Mail via PHP---------------///////////////
	$to = $detailsArr['customer_email'];
	$subject = "HDFC Gold Loan Leads @ deal4loans.com ".date('Y-m-d');
	
	$content = file_get_contents($file);
    $content = chunk_split(base64_encode($content));
    
    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From: Deal4loans <no-reply@deal4loans.com>" . $eol;
    $headers .= "Cc: shweta.sharma@wishfin.com, Atish.Shetty@hdfcbank.com" . $eol;
    //$headers .= "Cc: ranjana.chauhan@wishfin.com, upendra.kumar@wishfin.com" . $eol;
	//$headers .= "Bcc: rachit.jain@wishfin.com, ranjana.chauhan@wishfin.com" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;
    
	// message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;

	if($totalrows > 0){
		// attachment
		$body .= "--" . $separator . $eol;
		$body .= "Content-Type: application/octet-stream; name=\"" . $newfilename . "\"" . $eol;
		$body .= "Content-Transfer-Encoding: base64" . $eol;
		$body .= "Content-Disposition: attachment" . $eol;
		$body .= $content . $eol;
		$body .= "--" . $separator . "--";
	}

	// Send email
	if(mail($to,$subject,$body,$headers)){
		$Msg = 'Mail Sent';
	}
	else{
		$Msg = 'Mail Failed';
	}
	echo $Msg;
	////////////////--------------Send Mail via PHP---------------///////////////
}


?>
