<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$currentDate = date('Y-m-d');

$Sql = "SELECT scc.RequestID, rcc.Name, scc.LeadRefNumber, scc.ApplicationNumber, bid.BidderID AS AgentID 
FROM credit_card_mail_logs AS ccml 
LEFT JOIN sbi_credit_card_5633 AS scc ON (ccml.request_id = scc.RequestID) 
LEFT JOIN Req_Credit_Card AS rcc ON (rcc.RequestID = ccml.request_id) 
LEFT JOIN Req_Credit_Card_Sms AS rccs ON (rccs.UserID = ccml.request_id) 
LEFT JOIN lead_allocate AS la ON (IF(la.AllRequestID = rcc.RequestID ,la.AllRequestID = rcc.RequestID ,la.AllRequestID = rccs.RequestID)) 
LEFT JOIN Bidders AS bid ON (bid.BidderID = la.BidderID) 
WHERE (ccml.customer_consent = 2) AND (DATE(ccml.created_date) = '".$currentDate."') AND (scc.ProcessingStatus = 1 OR scc.ProcessingStatus = 2) GROUP BY scc.RequestID";

saveDbDataToXls($Sql);



$name = 'Bhupendra';
$email = 'bhupendra.dwivedi@deal4loans.com';

//$name = 'Upendra';
//$email = 'upendra@deal4loans.com';

//$name = 'Rachit';
//$email = 'rachit2264@gmail.com';

$detailsArr = array();
$detailsArr['customer_name'] = $name;
$detailsArr['customer_email'] =  $email;

SendNormalMailToCustomers($detailsArr);


function saveDbDataToXls($Sql){
	//$server_path = $_SERVER['DOCUMENT_ROOT'];
	$server_path = '/home/deal4loans/public_html';

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
	$csvfile = $server_path.'/data/files/temp.xls';
	file_put_contents($csvfile, $output);
}

function SendNormalMailToCustomers($detailsArr){
	$message = 'PFA file to get details of users who have rejected cards.';
	//print_r($message);exit;
	
	//$server_path = $_SERVER['DOCUMENT_ROOT'];
	$server_path = '/home/deal4loans/public_html';
	$filename = 'temp.xls';
    $path = $server_path.'/data/files';
    $file = $path . "/" . $filename;
    
    $newfilename = date('Y-m-d').'.xls';
	
	////////////////--------------Send Mail via PHP---------------///////////////
	$to = $detailsArr['customer_email'];
	$subject = "Credit Card Rejected Users List ".date('Y-m-d');
	
	$content = file_get_contents($file);
    $content = chunk_split(base64_encode($content));
    
    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From: No Reply <noreply@deal4loans.com>" . $eol;
    $headers .= "Cc: manish.sinha@deal4loans.com" . $eol;
	$headers .= "Bcc: cards.deal4loans@gmail.com" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;
    
	// message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;

    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $newfilename . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

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
