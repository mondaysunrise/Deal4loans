<?php
require 'scripts/session_checkBilling.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_POST);

$Submit = $_POST['submit'];
$BillingMonth = $_POST["BillingMonth"];
$Invoice = $_POST["Invoice"];
$InvoiceDate = $_POST["InvoiceDate"];
$Bidder_Name = $_POST["Bidder_Name"];
$Address = $_POST["Address"];
$Product = $_POST["Product"];
$TotalLead = $_POST["TotalLead"];
$Cost = $_POST["Cost"];
$Original_Amount = $_POST["Original_Amount"];
$ServiceTax = $_POST["ServiceTax"];
$educationcess = $_POST["educationcess"];
$highereducationcess = $_POST["highereducationcess"];
$FinalTotal = $_POST["FinalTotal"];
$GeneratedBy = $_POST["GeneratedBy"];
$BidderID = $_POST["BidderID"];
$Associated_Bank = $_POST['Associated_Bank'];
$Check = $_POST['Check'];
$FTinWords = convert_number($FinalTotal);
$MinDate = $_POST['Min_Date'];
$MaxDate = $_POST['Max_Date'];
$City = $_POST['City'];

$Total_Lead = $_POST['Total_Lead'];
$Discount_Reason = $_POST['Discount_Reason'];
$Discount_Lead = $_POST['extralead'];

 if($GeneratedBy=='Niharika Arora')
	$GeneratedBy = "Ritika Arora";
	
//echo $SQL_Insert;
//exit();
//	$SqlCheck ="select * from Bill_Record where 1=1  and Dated between '".$MinDate."' and '".$MaxDate."'";
//	Nidhi Khanna
		
	if($GeneratedBy=='Priyanka Seth')
		$ImageName = 'signature.gif';
	else if($GeneratedBy=='Bhavana Jhingan')
		$ImageName = 'bhavana.gif';
	else if($GeneratedBy=='Nidhi Khanna')
		$ImageName = 'nidhi.gif';	
	else
		$ImageName = 'nidhi.gif';
	
	
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
<tr><td><strong>Address: ".$Address."</strong>
</td></tr>
<tr><td><strong>City: ".ucfirst(strtolower($City))."</strong>
</td></tr>
<tr><td><strong>Product Details: ".$Product."</strong></td></tr>
<tr>
    <td height='27'>
<table width='100%' style='border:1px solid gray;'><tr><td width='35%' align='center' bgcolor='#CCCCCC'><strong>Cost Head</strong></td><td width='20%' align='left' bgcolor='#CCCCCC'><strong>Lead Volume</strong></td><td width='15%' align='left' bgcolor='#CCCCCC'><strong>CPL</strong></td><td width='30%' align='left'bgcolor='#CCCCCC'><strong>Total Amount (in Rs)</strong></td></tr><tr><td><strong>".$Product." Campaign</strong></td><td><strong>".$TotalLead."</strong></td><td><strong>".$Cost."</strong></td><td><strong>".$Original_Amount."</strong></td></tr><tr><td align='left' colspan='3'><strong>Service Tax @ 10%</strong></td><td><strong>".$ServiceTax."</strong></td></tr><tr><td align='left' colspan='3'><strong>Educational Cess 2%</strong></td><td><strong>".$educationcess."</strong></td></tr><tr><td align='left' colspan='3'><strong>Higher Educational Cess 1%</strong></td><td><strong>".$highereducationcess."</strong></td></tr><tr><td align='left' colspan='3'><strong>Total Amount</strong></td><td><strong>".$FinalTotal."</strong></td></tr></table>
</td></tr>
<tr><td>&nbsp;</td>
<tr><td ><strong>Amount in words: ".$FTinWords." Rupees Only.</strong></td></tr>
<tr><td>&nbsp;</td>
<tr>
    <td><strong>Service Tax No.: AAACW7895GST001</td>
  </tr>
  <tr><td>&nbsp;</td>
<tr>
    <td><strong>PAN No. : AAACW7895G</strong></td>
  </tr>
  <tr><td>&nbsp;</td>
<tr>
    <td><strong>Terms of Payment: </strong> 
      <ul>
        <li> Payment to be made by crossed cheque in favor of <strong>WRS Info India Pvt Ltd.</strong></li>
        <li>
	Bills raised should be realized in 25 days else interest of 24% p.a. would be levied</li><li>
	For any clarifications on the invoice, please revert within seven days of receipt of invoice.</li><li>
	Kindly acknowledge the receipt of bill via e-mail.</li></ul>
</td></tr>
<tr>
    <td><br><br><strong>For WRS Info India Pvt Ltd.</strong><br>
         <img src='http://www.deal4loans.com/images/".$ImageName."'><br>
 

Authorized Signatory<br>
      <strong>".$GeneratedBy."</strong><br><br><strong>** PLEASE DEDUCT TDS@2% ONLY, AS WE ARE PROVIDING ADVERTISING SERVICES.</strong></td>
  </tr>
 <tr><td align='center' style='color:#666666;'><br>WRS Info India Pvt Ltd, 128, Ground Floor, Priya Enclave, Delhi-110092</td></tr>
</table>";
//echo $Bill;

if($Check=='Insert')
{
	$SqlCheck ="select * from Bill_Record where 1=1  and Invoice_Number = '".$Invoice."'";
	list($SqlCheckNumRows,$SqlCheckQuery)=MainselectfuncNew($SqlCheck,$array = array());
	if($SqlCheckNumRows>0)
	{
		header("Location: billing_generated.php?Min_Date=$MinDate&Max_Date=$MaxDate&dupcheck=Dup");
	}
	else {
	if($Submit=='Save')
	{
		$dataInsert = array('Bill_Period'=>$BillingMonth, 'Invoice_Number'=>$Invoice, 'Invoice_Date'=>$InvoiceDate, 'Name'=>$Bidder_Name, 'Address'=>$Address, 'Product'=>$Product, 'Lead_Volume'=>$TotalLead, 'Cost_Lead'=>$Cost, 'Sub_Total'=>$Original_Amount, 'Service_Tax'=>$ServiceTax, 'Total_Amount'=>$FinalTotal, 'Generated_By'=>$GeneratedBy, 'BidderID'=>$BidderID, 'Bill_Sent'=>'1', 'Associated_Bank'=>$Associated_Bank, 'Min_Date'=>$MinDate, 'Max_Date'=>$MaxDate, 'Total_Lead'=>$Total_Lead, 'Discount_Lead'=>$Discount_Lead, 'Discount_Reason'=>$Discount_Reason, 'City'=>$City, 'educationcess'=>$educationcess, 'highereducationcess'=>$highereducationcess);
		$insert = Maininsertfunc ("Bill_Record", $dataInsert);
	//exit();
	header("Location: billing_generated.php?Min_Date=$MinDate&Max_Date=$MaxDate");
	}
	else if($Submit=='Generate')
	{
		$dataInsert = array('Bill_Period'=>$BillingMonth, 'Invoice_Number'=>$Invoice, 'Invoice_Date'=>$InvoiceDate, 'Name'=>$Bidder_Name, 'Address'=>$Address, 'Product'=>$Product, 'Lead_Volume'=>$TotalLead, 'Cost_Lead'=>$Cost, 'Sub_Total'=>$Original_Amount, 'Service_Tax'=>$ServiceTax, 'Total_Amount'=>$FinalTotal, 'Generated_By'=>$GeneratedBy, 'BidderID'=>$BidderID, 'Bill_Sent'=>'1', 'Associated_Bank'=>$Associated_Bank, 'Min_Date'=>$MinDate, 'Max_Date'=>$MaxDate, 'Total_Lead'=>$Total_Lead, 'Discount_Lead'=>$Discount_Lead, 'Discount_Reason'=>$Discount_Reason, 'City'=>$City, 'educationcess'=>$educationcess, 'highereducationcess'=>$highereducationcess);
		$insert = Maininsertfunc ("Bill_Record", $dataInsert);
		//exit();
		header("Content-type: application/octet-stream");
		# replace excelfile.xls with whatever you want the filename to default to
		header("Content-Disposition: attachment; filename=Bill.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $header."\n".$Bill;
		header("Location: billing_generated.php?Min_Date=$MinDate&Max_Date=$MaxDate");

	/*header("Content-type: application/octet-stream");
	header('Content-type: application/doc');	
	header("Content-Disposition: attachment; filename=Bills.doc");
	header("Pragma: no-cache");
	header("Expires: 0");
    echo $header."\n".$Bill; */
	}
	}
}
else if($Check=='Edit')
{
//	echo $Bill;
	header("Content-type: application/octet-stream");
		# replace excelfile.xls with whatever you want the filename to default to
		header("Content-Disposition: attachment; filename=Bill.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $header."\n".$Bill;
		
}

?>

