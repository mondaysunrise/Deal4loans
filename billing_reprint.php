<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_checkBilling.php';
$BID = $_REQUEST['BID'];
		$Sql = "select * from Bill_Record where BID=$BID";
		list($rowscount,$Arrrow)=MainselectfuncNew($Sql,$array = array());
		$cntr=0;
		
		//$Query = ExecQuery($Sql);
		$Validate = count($Arrrow);
		$Bill_Period = $Arrrow[$cntr]['Bill_Period'];
		$Invoice_Number = $Arrrow[$cntr]['Invoice_Number'];
		$Invoice_Date = $Arrrow[$cntr]['Invoice_Date'];
		$Name = $Arrrow[$cntr]['Name'];
		$Address  = $Arrrow[$cntr]['Address'];
		$Product  = $Arrrow[$cntr]['Product'];
		$City  = $Arrrow[$cntr]['City'];
		$Lead_Volume = $Arrrow[$cntr]['Lead_Volume'];
		$Cost_Lead = $Arrrow[$cntr]['Cost_Lead'];
		$Sub_Total = $Arrrow[$cntr]['Sub_Total'];
		$Service_Tax = $Arrrow[$cntr]['Service_Tax'];
		$educationcess = $Arrrow[$cntr]['educationcess']; 
		$highereducationcess = $Arrrow[$cntr]['highereducationcess'];
			$Total_Amount = $Arrrow[$cntr]['Total_Amount'];
		$GeneratedBy = $Arrrow[$cntr]['Generated_By'];
		$Associated_Bank = $Arrrow[$cntr]['Associated_Bank'];
		$FTinWords = convert_number($Total_Amount);
		if($GeneratedBy=='Priyanka Seth')
			$ImageName = 'signature.gif';
		else if($GeneratedBy=='Niharika Arora')
			$ImageName = 'niharika.gif';
		else if($GeneratedBy=='Bhavana Jhingan')
			$ImageName = 'bhavana.gif';
			else
			$ImageName = 'ritika.gif';
		
?>
<html><head><title>Bill Generation</title>
<SCRIPT LANGUAGE="JavaScript">    
					self.resizeTo(800,600);       

 </SCRIPT>
</head><body>
<form name='EdittoBill' action='billing_generate.php' method='post' >
<table width='80%' align='center'   style='border:1px solid gray;' cellpadding="3">

<tr>
    <td align='center'><table width='100%' cellpadding='4' ><tr><td align='left'><img src='http://www.deal4loans.com/images/logo_thumb.gif' width='96' height='35'></td><td align='right'><font color="#999999">www.Deal4Loans.com</font></td></tr></table></td>
  </tr>
<tr>
    <td align='center'><strong>Invoice for <?php echo $Associated_Bank; ?> <?php echo $Product; ?> Campaign in 
     <?php echo $Bill_Period; ?></strong></td>
  </tr>
<tr><td>&nbsp;</td></tr>
<tr><td><strong>Invoice Date: <?php echo $Invoice_Date; ?></strong></td></tr>
<tr><td><strong>Invoice No.: <?php echo $Invoice_Number; ?></strong></td></tr>
<tr><td><strong><strong>Name of Client:</strong> <?php echo $Name; ?></strong></td></tr>
<tr><td><strong>Address:<?php echo $Address; ?></strong>
</td></tr>
<tr><td><strong>City: <?php echo ucfirst(strtolower($City)); ?></strong>
</td></tr>
<tr><td><strong>Product Details: <?php echo $Product; ?></strong></td></tr><tr><td>&nbsp;</td></tr>
<tr>
    <td height='27'>
<table width='100%' style='border:1px solid gray;'><tr ><td width='35%' align='center' bgcolor="#CCCCCC"><strong>Cost Head</strong></td><td width='20%' align='left'  bgcolor="#CCCCCC"><strong>Lead Volume</strong></td><td width='15%' align='left'  bgcolor="#CCCCCC"><strong>CPL</strong></td><td width='30%' align='left'  bgcolor="#CCCCCC"><strong>Total Amount (in Rs)</strong></td></tr><tr><td><strong><?php echo $Product; ?> Campaign</strong></td><td><strong><?php echo $Lead_Volume; ?></strong></td><td><strong><?php echo $Cost_Lead; ?></strong></td><td><strong><?php echo $Sub_Total; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Service Tax @ 10%</strong></td><td><strong><?php echo $Service_Tax; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Service Tax @ 2%</strong></td><td><strong><?php echo $educationcess; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Service Tax @ 1%</strong></td><td><strong><?php echo $highereducationcess; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Total Amount</strong></td><td><strong><?php echo $Total_Amount; ?></strong></td></tr></table></td></tr>

<tr><td ><strong>Amount in words: <?php echo $FTinWords; ?> Rupees Only.</strong></td></tr>

<tr>
    <td><strong>Service Tax No.: AAACW7895GST001</td>
  </tr>
  
    <td><strong>PAN No. : AAACW7895G</strong></td>
  </tr>
  
<tr>
    <td><strong>Terms of Payment: </strong> 
      <ul>
        <li> Payment to be made by crossed cheque in favor of <strong>WRS Info India Pvt Ltd. </strong></li>
        <li>
	Bills raised should be realized in 25 days else interest of 24% p.a. would be levied</li><li>
	For any clarifications on the invoice, please revert within seven days of receipt of invoice.</li><li>
	Kindly acknowledge the receipt of bill via e-mail.</li></ul>
</td></tr>
<tr>
    <td><br><br><strong>For WRS Info India Pvt Ltd. </strong><br>
         <img src='http://www.deal4loans.com/images/<?php echo $ImageName; ?>'><br>
 

Authorized Signatory<br>
      <strong><?php echo $GeneratedBy; ?></strong></td>
  </tr>
   <tr><td align="center" style="color:#666666;"><br>WRS Info India Pvt Ltd, 128, Ground Floor, Priya Enclave, Delhi-110092</td></tr>
  </table>
  <table width="80%" align="center">
 <tr><td align="right">
<input type="hidden" name="BillingMonth" value="<?php echo $Bill_Period; ?>">
<input type="hidden" name="Invoice" value="<?php echo $Invoice_Number; ?>">
<input type="hidden" name="InvoiceDate" value="<?php echo $Invoice_Date; ?>">
<input type="hidden" name="Bidder_Name" value="<?php echo $Name; ?>">
<input type="hidden" name="Address" value="<?php echo $Address; ?>">
<input type="hidden" name="Product" value="<?php echo $Product; ?>">
<input type="hidden" name="TotalLead" value="<?php echo $Lead_Volume; ?>">
<input type="hidden" name="Cost" value="<?php echo $Cost_Lead; ?>">
<input type="hidden" name="City" value="<?php echo $City; ?>">
<input type="hidden" name="Original_Amount" value="<?php echo $Sub_Total; ?>">
<input type="hidden" name="ServiceTax" value="<?php echo $Service_Tax; ?>">
<input type="hidden" name="educationcess" value="<?php echo $educationcess; ?>">
<input type="hidden" name="highereducationcess" value="<?php echo $highereducationcess; ?>">
<input type="hidden" name="FinalTotal" value="<?php echo $Total_Amount; ?>">
<input type="hidden" name="GeneratedBy" value="<?php echo $GeneratedBy; ?>">
<input type="hidden" name="BidderID" value="<?php echo $BidderID; ?>">
<input type="hidden" name="Associated_Bank" value="<?php echo $Associated_Bank; ?>">
<input type="hidden" name="Check" value="<?php echo "Edit"; ?>">
<input  type='submit' name='submit' value='Generate'>
</td></tr>
</table></form>
