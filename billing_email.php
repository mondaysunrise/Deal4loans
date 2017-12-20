<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_checkBilling.php';

function sendmsg($to, $subject, $msgtext, $from, $file, $type) 
{ 
	$fp = fopen($file,"rb"); 
	$fcontent = fread($fp ,filesize($file)); 
	fclose($fp); 
	$content = chunk_split(base64_encode($fcontent)); 
	$sep = strtoupper(md5(uniqid(time()))); 
	$name = basename($file); 
	$header = "From: $from\nReply-To: $from\n"; 
	$header .= "MIME-Version: 1.0\n"; 
	$header .= "Content-Type: multipart/mixed; boundary=$sep 
	\n"; 
	$body .= "--$sep\n"; 
	$body .= "Content-Type: text/plain\n"; 
	$body .= "Content-Transfer-Encoding: 8bit\n\n"; 
	$body .= "$msgtext\n"; 
	$body .= "--$sep\n"; 
	$body .= "Content-Type: $type; name=\"$file\"\n"; 
	$body .= "Content-Transfer-Encoding: base64\n"; 
	$body .= "Content-Disposition: attachment; filename= 
	\"$file 
	\"\n"; 
	$body .= "$content\n"; 
	$body .= "--$sep--"; 
	if (mail($to, $subject, $body, $header)) { 
	return true; 
	} else { 
	return false; 
	} 
}

$billno = $_REQUEST['billno'];
$BID = $_REQUEST['BID'];
$Bidder = $_REQUEST['Bidder_ID'];
$GetEmail = "select BidderEmailID from Bidders where BidderID = $Bidder";
//	echo $GetEmail;
list($numRow,$GetEmailRow)=Mainselectfunc($GetEmail,$array = array());
	$Email = $GetEmailRow['BidderEmailID'];
	
	if(isset($_POST['submit']))
	{
	
		$billnumber = $_POST['billnumber'];
		$bill_record_id = $_POST['bill_record_id'];
		$message = $_POST['message'];
		$subject = $_POST['subject'];
//$EmailID = $_POST['EmailID'];
		
		
		 $Sql = "select * from Bill_Record where BID=$bill_record_id and Invoice_Number ='".$billnumber."' ";
		list($Validate,$Query)=MainselectfuncNew($Sql,$array = array());

		$BillingMonth = $Query[0]['Bill_Period'];
		$Invoice = $Query[0]['Invoice_Number'];
		$InvoiceDate = $Query[0]['Invoice_Date'];		

		
		$Bidder_Name = $Query[0]['Name'];
		$Address  = $Query[0]['Address'];
		$Product  = $Query[0]['Product'];
		$TotalLead = $Query[0]['Lead_Volume'];
		$Cost = $Query[0]['Cost_Lead'];
		$Original_Amount = $Query[0]['Sub_Total'];
		$ServiceTax = $Query[0]['Service_Tax'];
		$FinalTotal = $Query[0]['Total_Amount'];
		$GeneratedBy = $Query[0]['Generated_By'];
		$Associated_Bank = $Query[0]['Associated_Bank'];
		$BidderID = $Query[0]['BidderID'];
		$FTinWords = convert_number($FinalTotal);
		if($GeneratedBy=='Priyanka Seth')
			$ImageName = 'signature.gif';
		else if($GeneratedBy=='Niharika Arora')
			$ImageName = 'niharika.gif';
		else
			$ImageName = 'ritika.gif';
			
			





	
	
	$Bill = "<table width='100%' align='center'  style='border:1px bold gray;'>
	<tr><td>&nbsp;</td></tr>
<tr>
    <td align='center'><table width='100%' cellpadding='4' ><tr><td align='left'><img src='http://www.deal4loans.com/images/logo_thumb.gif' width='96' height='35'></td><td align='right'><font color='#999999'>www.deal4loans.com</font></td></tr></table></td>
  </tr>
<tr>
    <td align='center'><strong>Invoice for ".$Bidder_Name." ".$Product." Campaign in 
     ".$BillingMonth."</strong></td>
  </tr>
<tr><td>&nbsp;</td></tr>
<tr><td><strong>Invoice Date: ".$InvoiceDate."</strong></td></tr>
<tr><td><strong>Invoice No.: ".$Invoice."</strong></td></tr>
<tr><td><strong><strong>Name of Client:</strong> ".$Bidder_Name."</strong></td></tr>
<tr><td><strong>Address:".$Address."</strong>
</td></tr>
<tr><td><strong>Product Details: ".$Product."</strong></td></tr>
<tr>
    <td height='27'>
<table width='100%' style='border:1px solid gray;'><tr><td width='35%' align='center' bgcolor='#CCCCCC'><strong>Cost Head</strong></td><td width='20%' align='left' bgcolor='#CCCCCC'><strong>Lead Volume</strong></td><td width='15%' align='left' bgcolor='#CCCCCC'><strong>CPL</strong></td><td width='30%' align='left'bgcolor='#CCCCCC'><strong>Total Amount (in Rs)</strong></td></tr><tr><td><strong>".$Product." Campaign</strong></td><td><strong>".$TotalLead."</strong></td><td><strong>".$Cost."</strong></td><td><strong>".$Original_Amount."</strong></td></tr><tr><td align='left' colspan='3'><strong>Service Tax @ 10.30%</strong></td><td><strong>".$ServiceTax."</strong></td></tr><tr><td align='left' colspan='3'><strong>Total Amount</strong></td><td><strong>".$FinalTotal."</strong></td></tr></table>
</td></tr>
<tr><td>&nbsp;</td>
<tr><td ><strong>Amount in words: ".$FTinWords." Rupees Only.</strong></td></tr>
<tr><td>&nbsp;</td>
<tr>
    <td><strong>Service Tax No.: DLII/ST/XX/ONLINE/1263/MIC/04</td>
  </tr>
  <tr><td>&nbsp;</td>
<tr>
    <td><strong>PAN No. : AAACM1677J</strong></td>
  </tr>
  <tr><td>&nbsp;</td>
<tr>
    <td><strong>Terms of Payment: </strong> 
      <ul>
        <li> Payment to be made by crossed cheque in favor of <strong>Microfinancial 
          Services Ltd. </strong></li>
        <li>
	Bills raised should be realized in 25 days else interest of 24% p.a. would be levied</li><li>
	For any clarifications on the invoice, please revert within seven days of receipt of invoice.</li><li>
	Kindly acknowledge the receipt of bill via e-mail.</li></ul>
</td></tr>
<tr>
    <td><br><br><strong>For Microfinancial Services Ltd. </strong><br>
         <img src='http://www.deal4loans.com/images/".$ImageName."'><br>
 

Authorized Signatory<br>
      <strong>".$GeneratedBy."</strong></td>
  </tr>

</table>";
//echo $Bill;


		
	//	header("Content-type: application/octet-stream");
		# replace excelfile.xls with whatever you want the filename to default to
	//	header("Content-Disposition: attachment; filename=Bill.doc");
	//	header("Pragma: no-cache");
	//	header("Expires: 0");
	//	$File = $header."\n".$Bill;
	//	header("Location: billing_generated.php?Min_Date=$MinDate&Max_Date=$MaxDate");

$to = "tech@deal4loans.com";
$msgtest = "testing";
$from = "accounts@deal4loans.com";
$type = "doc";

sendmsg($to, $subject, $message, $from, $Bill, $type); 	
	
	
	}
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Billing Module (Email to Bidders)</title>
</head>

<body>
<p align="center"><b> Send Email </b></p>

<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?Name=<? echo urlencode($Name); ?>&Email=<? echo urlencode($Email);?>" >

<table style='border:1px dotted #9C9A9C;'width="600" height="80%" align="center">

<tr>	<td ><b>Name</b>
	</td>
	<td ><? echo $Bidder_Name;?></td>
	
</tr>
<tr>
	<td ><b>Email id</b></td>
	<td ><? echo $Email;?></td>
</tr>
<tr>
	<td ><b>Email Sent From -</b></td>
	<td >accounts@deal4loans.com</td>
</tr>
<tr><td><b>Subject</b></td>
<td><textarea rows="2" cols="50" name="subject"></textarea></td></tr>

<tr>
	<td ><b>Message</b></td><td>
<textarea rows="10" cols="50" name="message"></textarea>
<input type='hidden' value='<? echo $Email; ?>' name='EmailID'>
<input type='hidden' value='<? echo $billno; ?>' name='billnumber'>
<input type='hidden' value='<? echo $BID; ?>' name='bill_record_id'>
</td>
</tr>

<tr>
<td colspan='2' align='center'><input type='submit' value='submit' name='submit' class='bluebutton'></td>
</tr>
</table>
</form>
</body>
</html>