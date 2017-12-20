<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/session_checkBilling.php';

function calculatedate($month)
{
	if($month ==2)
	{
		$definedate = 28;
	}
	else if($month ==1 || $month ==3 || $month ==5 || $month ==7 || $month ==8 || $month ==10 || $month ==12 )
	{
		$definedate = 31;
	}
	else
	{
		$definedate = 30;
	}
	return $definedate;
}

function getProductCode($pKey){
	$titles = array(
		'Personal Loan' => 'PL',
		'Home Loan' => 'HL',
		'Car Loan' => 'CL',
		'Credit Card' => 'CC',
		'Loan Against Property' => ' LAP',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }


	$sub = $_REQUEST['submit'];

//echo "<br><br>";
	//echo "<br>";
	$submitval = explode('_',$sub);
		//print_r($submitval);
	$BidderID = $_POST["BidderID_".$submitval[1]];
	$InvoiceNumber = $_POST["Invoice_".$submitval[1]];
	
	if($submitval[0]=='Submit')
	{
	
	$Product = $_POST["Product_".$submitval[1]];
	$TotalLead = $_POST["finallead_".$submitval[1]."N"]; //Total Lead
	$Cost = $_POST["Variable_".$submitval[1]."N"]; //Cost of the Lead
	$Original_Amount = $_POST["extra_".$submitval[1]."N"].".00"; //Total Amount
	$MinDate = $_POST['Min_Date'];
	$MaxDate = $_POST['Max_Date'];
	$GeneratedBy = $_POST["GeneratedBy_".$submitval[1]];
	$STPercent =10;
	$eduCess = 2;
	$highereduCess = 1;
	$ServiceTax = round(($Original_Amount * $STPercent / 100),0).".00";
	$educationcess = round(($ServiceTax * $eduCess / 100),0).".00";
	$highereducationcess = round(($ServiceTax * $highereduCess / 100),0).".00";
	
	
	$FinalTotal = round(($Original_Amount + $ServiceTax + $educationcess + $highereducationcess ),0).".00";
	$FTinWords = convert_number($FinalTotal);
	
		$expdat = explode(" ",$MinDate);
		$expdate = explode("-",$expdat[0]);
			
		$BillingMonth = date("M y", mktime(0, 0, 0, $expdate[1]+1, 0, $expdate[0]));
		$today = date("m/y", mktime(0, 0, 0, $expdate[1]+1, 0, $expdate[0]));
	
	$Total_Lead = $_POST["Total_Lead_".$submitval[1]];
	$extralead = $_POST["extralead_".$submitval[1]."N"];
	$Discount_Reason  = $_POST["Discount_Reason_".$submitval[1]];
	
		
	$Sql_BidderDetails = "select * from Bidders where BidderID=".$BidderID;	
	
	 list($recordcount,$getrow)=MainselectfuncNew($Sql_BidderDetails,$array = array());
		$cntr=0;
	
	//$Query_BidderDetails = ExecQuery($Sql_BidderDetails);
	
	$Bidder_Name = $getrow[$cntr]['Bidder_Name'];
	$City = $getrow[$cntr]['City'];	
	$Associated_Bank = $getrow[$cntr]['Associated_Bank'];	
	$Address = $getrow[$cntr]['Address'];
	//$today = date("m/y");

	$Invoice = $Associated_Bank."/".$BidderID."/".getProductCode($Product)."/01/".$today;
	$dM = date("m");
	if($dM==1)
	{
		$DefineInvoiceMonth = 12;
		//$yeM = date("y")-1;
		$DefineInvoiceDate = calculatedate($DefineInvoiceMonth);
	
		$InvoiceDate = date($DefineInvoiceDate."/".$DefineInvoiceMonth."/09");
	}
	else
	{
		$DefineInvoiceMonth = date("m")-1;
		$DefineInvoiceDate = calculatedate($DefineInvoiceMonth);
		$InvoiceDate = date($DefineInvoiceDate."/".$DefineInvoiceMonth."/y");
	}
	
	$ImageName = 'nidhi.gif';
?>
	
<html><head><title>Bill Generation</title>

<SCRIPT LANGUAGE="JavaScript">
			function HandleOnSubmit() {
				self.resizeTo(800,600);
				}  
 </SCRIPT>
</head><body onLoad="return HandleOnSubmit();">
<form name='EntertoBill' action='billing_generate.php' method='post' >
<table width='80%' align='center'   style='border:1px solid gray;' cellpadding="3">

<tr>
    <td align='center'><table width='100%' cellpadding='4' ><tr><td align='left'><img src='http://www.deal4loans.com/images/logo_thumb.gif' width='96' height='35'></td><td align='right'><font color="#999999">www.deal4loans.com</font></td></tr></table></td>
  </tr>
<tr>
    <td align='center'><strong>Invoice for <?php echo $Associated_Bank; ?> <?php echo $Product; ?> Campaign in 
     <?php echo $BillingMonth; ?></strong></td>
  </tr>
<tr><td>&nbsp;</td></tr>
<tr><td><strong>Invoice Date: <?php echo $InvoiceDate; ?></strong></td></tr>
<tr><td><strong>Invoice No.: <?php echo $Invoice; ?></strong></td></tr>
<tr><td><strong><strong>Name of Client:</strong> <?php echo $Bidder_Name; ?></strong></td></tr>
<tr><td><strong>Address:<?php echo $Address; ?></strong>
</td></tr>
<tr><td><strong>City:<?php echo ucfirst(strtolower($City)); ?></strong>
</td></tr>
<tr><td><strong>Product Details: <?php echo $Product; ?></strong></td></tr><tr><td>&nbsp;</td></tr>
<tr>
    <td height='27'>
<table width='100%' style='border:1px solid gray;'><tr ><td width='35%' align='center' bgcolor="#CCCCCC"><strong>Cost Head</strong></td><td width='20%' align='left'  bgcolor="#CCCCCC"><strong>Lead Volume</strong></td><td width='15%' align='left'  bgcolor="#CCCCCC"><strong>CPL</strong></td><td width='30%' align='left'  bgcolor="#CCCCCC"><strong>Total Amount (in Rs)</strong></td></tr><tr><td><strong><?php echo $Product; ?> Campaign</strong></td><td><strong><?php echo $TotalLead; ?></strong></td><td><strong><?php echo $Cost; ?></strong></td><td><strong><?php echo $Original_Amount; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Service Tax @ 10%</strong></td><td><strong><?php echo $ServiceTax; ?></strong></td></tr>
<tr><td align='left' colspan='3'><strong>Educational Cess 2%</strong></td><td><strong><?php echo $educationcess; ?></strong></td></tr>
<tr><td align='left' colspan='3'><strong>Higher Educational Cess 1%</strong></td><td><strong><?php echo $highereducationcess; ?></strong></td></tr>

<tr><td align='left' colspan='3'><strong>Total Amount</strong></td><td><strong><?php echo $FinalTotal; ?></strong></td></tr></table>
</td></tr>

<tr><td ><strong>Amount in words: <?php echo $FTinWords; ?> Rupees Only.</strong></td></tr>

<tr>
    <td>Service Tax No.: AAACW7895GST001</td>
  </tr>
  
    <td><strong>PAN No. : AAACW7895G</strong></td>
  </tr>
  
<tr>
    <td><strong>Terms of Payment: </strong> 
      <ul>
        <li> Payment to be made by crossed cheque in favor of <strong>WRS Info India Pvt Ltd</strong></li>
        <li>
	Bills raised should be realized in 25 days else interest of 24% p.a. would be levied</li><li>
	For any clarifications on the invoice, please revert within seven days of receipt of invoice.</li><li>
	Kindly acknowledge the receipt of bill via e-mail.</li>
	</ul>
</td></tr>
<tr>
    <td><br><br><strong>For WRS Info India Pvt Ltd. </strong><br>
         <img src='http://www.deal4loans.com/images/<?php echo $ImageName; ?>'><br>
 

Authorized Signatory<br>
      <strong><?php 
	 	    echo $GeneratedBy; ?></strong>
			<br><br><strong>** PLEASE DEDUCT TDS@2% ONLY, AS WE ARE PROVIDING ADVERTISING SERVICES.</strong>
		</td>
  </tr>
  <tr><td align="center" style="color:#666666;">WRS Info India Pvt Ltd, 128, Ground Floor, Priya Enclave, Delhi-110092</td></tr>
  </table>
  <table width="80%" align="center">
 <tr><td align="right">

<input type="hidden" name="BillingMonth" value="<?php echo $BillingMonth; ?>">
<input type="hidden" name="Invoice" value="<?php echo $Invoice; ?>">
<input type="hidden" name="InvoiceDate" value="<?php echo $InvoiceDate; ?>">
<input type="hidden" name="Bidder_Name" value="<?php echo $Bidder_Name; ?>">
<input type="hidden" name="Address" value="<?php echo $Address; ?>">
<input type="hidden" name="Product" value="<?php echo $Product; ?>">
<input type="hidden" name="TotalLead" value="<?php echo $TotalLead; ?>">
<input type="hidden" name="Cost" value="<?php echo $Cost; ?>">
<input type="hidden" name="Original_Amount" value="<?php echo $Original_Amount; ?>">
<input type="hidden" name="ServiceTax" value="<?php echo $ServiceTax; ?>">
<input type="hidden" name="educationcess" value="<?php echo $educationcess; ?>">
<input type="hidden" name="highereducationcess" value="<?php echo $highereducationcess; ?>">
<input type="hidden" name="FinalTotal" value="<?php echo $FinalTotal; ?>">
<input type="hidden" name="GeneratedBy" value="<?php echo $GeneratedBy; ?>">
<input type="hidden" name="BidderID" value="<?php echo $BidderID; ?>">
<input type="hidden" name="Associated_Bank" value="<?php echo $Associated_Bank; ?>">
<input type="hidden" name="Check" value="<?php echo "Insert"; ?>">
<input type="hidden" name="Min_Date" value="<?php echo $MinDate; ?>">
<input type="hidden" name="Max_Date" value="<?php echo $MaxDate; ?>">
<input type="hidden" name="City" value="<?php echo $City; ?>">
<input type="hidden" name="Total_Lead" value="<?php echo $Total_Lead; ?>">
<input type="hidden" name="extralead" value="<?php echo $extralead; ?>">
<input type="hidden" name="Discount_Reason" value="<?php echo $Discount_Reason; ?>">

<input  type='submit' name='submit' value='Save'>

<input  type='submit' name='submit' value='Generate'></td></tr>
</table></form>
</body>
</html>
<?php 
}
if($submitval[0]=='Edit')
{



$Sql = "select * from Bill_Record where Bill_Sent>=1 and BidderID=$BidderID and  Invoice_Number = '".$InvoiceNumber."' ";
		//$Query = ExecQuery($Sql);
		 list($Validate,$Arrrow)=MainselectfuncNew($Sql,$array = array());
		$i=0;
		
		//$Validate = mysql_num_rows($Query);
		$Bill_Period = $Arrrow[$i]['Bill_Period'];
		$Invoice_Number = $Arrrow[$i]['Invoice_Number'];
		$Invoice_Date = $Arrrow[$i]['Invoice_Date'];
		$Name = $Arrrow[$i]['Name'];
		$Address  = $Arrrow[$i]['Address'];
		$Product  = $Arrrow[$i]['Product'];
		$Lead_Volume = $Arrrow[$i]['Lead_Volume'];
		$Cost_Lead = $Arrrow[$i]['Cost_Lead'];
		$Sub_Total = $Arrrow[$i]['Sub_Total'];
		$City = $Arrrow[$i]['City'];
		$Service_Tax = $Arrrow[$i]['Service_Tax'];
		$educationcess = $Arrrow[$i]['educationcess'];
		$highereducationcess = $Arrrow[$i]['highereducationcess'];
		$Total_Amount = $Arrrow[$i]['Total_Amount'];
		$GeneratedBy = $Arrrow[$i]['Generated_By'];
		$Associated_Bank = $Arrrow[$i]['Associated_Bank'];
		$FTinWords = convert_number($Total_Amount);
		$ImageName = 'nidhi.gif';
		
?>
<html><head><title>Bill Generation</title>

<SCRIPT LANGUAGE="JavaScript">    
					self.resizeTo(800,600); 
					      

 </SCRIPT>
</head><body>
<form name='EdittoBill' action='billing_update.php' method='post' >
<table width='80%' align='center'   style='border:1px solid gray;' cellpadding="3">

<tr>
    <td align='center'><table width='100%' cellpadding='4' ><tr><td align='left'><img src='http://www.deal4loans.com/images/logo_thumb.gif' width='96' height='35'></td><td align='right'><font color="#999999">Edit The Bill </font></td></tr></table></td>
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
<tr><td><strong>City:<?php echo ucfirst(strtolower($City)); ?></strong>
</td></tr>
<tr><td><strong>Product Details: <?php echo $Product; ?></strong></td></tr><tr><td>&nbsp;</td></tr>
<tr>
    <td height='27'>
<table width='100%' style='border:1px solid gray;'>

<tr ><td width='35%' align='center' bgcolor="#CCCCCC"><strong>Cost Head</strong></td><td width='20%' align='left'  bgcolor="#CCCCCC"><strong>Lead Volume</strong></td><td width='15%' align='left'  bgcolor="#CCCCCC"><strong>CPL</strong></td><td width='30%' align='left'  bgcolor="#CCCCCC"><strong>Total Amount (in Rs)</strong></td></tr>
<tr><td><strong><?php echo $Product; ?> Campaign</strong></td><td><strong><input type="text" size="6" name="LeadVolume" value="<?php echo $Lead_Volume; ?>"></strong></td><td><strong><input type="text" name="Cost" value="<?php echo $Cost_Lead; ?>" size="6"></strong></td><td><strong><input type="text" name="Sub_Total" value="<?php echo $Sub_Total; ?>" size="6"></strong>&nbsp;&nbsp; <input  type='submit' name='submit' value='Edit'></td></tr><tr><td align='left' colspan='3'><strong>Service Tax @ 10%</strong></td><td><strong><?php echo $Service_Tax; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Educational Cess 2%</strong></td><td><strong><?php echo $educationcess; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Higher Educational Cess 1%</strong></td><td><strong><?php echo $highereducationcess; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Total Amount</strong></td><td><strong><?php echo $Total_Amount; ?></strong></td></tr></table>
</td></tr>

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
	Kindly acknowledge the receipt of bill via e-mail.</li>
	</ul>
</td></tr>
<tr>
    <td><br><br><strong>For WRS Info India Pvt Ltd. </strong><br>
         <img src='http://www.deal4loans.com/images/<?php echo $ImageName; ?>'><br>
 

Authorized Signatory<br>
      <strong><?php echo $GeneratedBy; ?></strong></td>
  </tr>
   <tr><td align="center" style="color:#666666;">WRS Info India Pvt Ltd, 128, Ground Floor, Priya Enclave, Delhi-110092</td></tr>
  </table>
  <table width="80%" align="center">
 <tr><td align="right">
<input type="hidden" name="BillingMonth" value="<?php echo $Bill_Period; ?>">
<input type="hidden" name="Invoice" value="<?php echo $Invoice_Number; ?>">
<input type="hidden" name="InvoiceDate" value="<?php echo $Invoice_Date; ?>">
<input type="hidden" name="BidderID" value="<?php echo $BidderID; ?>">
</td></tr>
</table></form>
</body>
</html>
<?php
}

if(($submitval[0]=='Edited') || ($submitval[0]=='RePrint') )
{
	if(($submitval[0]=='RePrint'))
	{
		$BID = $_POST["BidderID_".$submitval[1]];
		$Invoice = $_POST["Invoice_".$submitval[1]];
	}
	else if($submitval[0]=='Edited')
	{
		$BID = $_REQUEST['BidderID'];
		$Invoice = $_REQUEST['Invoice'];
	}

		$SqlEdited = "select * from Bill_Record where Bill_Sent>=1 and BidderID=$BID and Invoice_Number ='".$Invoice."'";
		list($Validate,$Myrow)=MainselectfuncNew($SqlEdited,$array = array());
		$k=0;
		
		//$QueryEdited = ExecQuery($SqlEdited);
		//$Validate = mysql_num_rows($QueryEdited);
		$Bill_Period_Edited = $Myrow[$k]['Bill_Period'];
		$Invoice_Number_Edited = $Myrow[$k]['Invoice_Number'];
		$Invoice_Date_Edited = $Myrow[$k]['Invoice_Date'];
		$Name_Edited = $Myrow[$k]['Name'];
		$Address_Edited  = $Myrow[$k]['Address'];
		$Product_Edited  = $Myrow[$k]['Product'];
		$Lead_Volume_Edited = $Myrow[$k]['Lead_Volume'];
		$Cost_Lead_Edited = $Myrow[$k]['Cost_Lead'];
		$Sub_Total_Edited = $Myrow[$k]['Sub_Total'];
		$Service_Tax_Edited = $Myrow[$k]['Service_Tax'];
		$educationcess_Edited = $Myrow[$k]['educationcess']; 
		$highereducationcess_Edited = $Myrow[$k]['highereducationcess'];
		$Total_Amount_Edited = $Myrow[$k]['Total_Amount'];
		$GeneratedBy_Edited = $Myrow[$k]['Generated_By'];
		$City_Edited = $Myrow[$k]['City'];
		$Associated_Bank_Edited = $Myrow[$k]['Associated_Bank'];
		$FTinWords = convert_number($Total_Amount_Edited);
		/*if($GeneratedBy_Edited=='Priyanka Seth')
			$ImageName = 'signature.gif';
		else if($GeneratedBy_Edited=='Niharika Arora')
			$ImageName = 'niharika.gif';
		else if($GeneratedBy_Edited=='Bhavana Jhingan')
			$ImageName = 'bhavana.gif';
		else
			$ImageName = 'ritika.gif';
		*/
				
	if($GeneratedBy=='Priyanka Seth')
		$ImageName = 'signature.gif';
	else if($GeneratedBy=='Bhavana Jhingan')
		$ImageName = 'bhavana.gif';
	else if($GeneratedBy=='Nidhi Khanna')
		$ImageName = 'nidhi.gif';	
	else
		$ImageName = 'nidhi.gif';
	
		
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
    <td align='center'><strong>Invoice for <?php echo $Associated_Bank_Edited; ?> <?php echo $Product_Edited; ?> Campaign in 
     <?php echo $Bill_Period_Edited; ?></strong></td>
  </tr>
<tr><td>&nbsp;</td></tr>
<tr><td><strong>Invoice Date: <?php echo $Invoice_Date_Edited; ?></strong></td></tr>
<tr><td><strong>Invoice No.: <?php echo $Invoice_Number_Edited; ?></strong></td></tr>
<tr><td><strong><strong>Name of Client:</strong> <?php echo $Name_Edited; ?></strong></td></tr>
<tr><td><strong>Address: <?php echo $Address_Edited; ?></strong>
</td></tr>
<tr><td><strong>City: <?php echo ucfirst(strtolower($City_Edited)); ?></strong>
</td></tr>
<tr><td><strong>Product Details: <?php echo $Product_Edited; ?></strong></td></tr><tr><td>&nbsp;</td></tr>
<tr>
    <td height='27'>
<table width='100%' style='border:1px solid gray;'><tr ><td width='35%' align='center' bgcolor="#CCCCCC"><strong>Cost Head</strong></td><td width='20%' align='left'  bgcolor="#CCCCCC"><strong>Lead Volume</strong></td><td width='15%' align='left'  bgcolor="#CCCCCC"><strong>CPL</strong></td><td width='30%' align='left'  bgcolor="#CCCCCC"><strong>Total Amount (in Rs)</strong></td></tr><tr><td><strong><?php echo $Product_Edited; ?> Campaign</strong></td><td><strong><?php echo $Lead_Volume_Edited; ?></strong></td><td><strong><?php echo $Cost_Lead_Edited; ?></strong></td><td><strong><?php echo $Sub_Total_Edited; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Service Tax @ 10%</strong></td><td><strong><?php echo $Service_Tax_Edited; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Educational Cess 2%</strong></td><td><strong><?php echo $educationcess_Edited; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Higher Educational Cess 1%</strong></td><td><strong><?php echo $highereducationcess_Edited; ?></strong></td></tr><tr><td align='left' colspan='3'><strong>Total Amount</strong></td><td><strong><?php echo $Total_Amount_Edited; ?></strong></td></tr></table></td></tr>

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
	Kindly acknowledge the receipt of bill via e-mail.</li>
	</ul>
</td></tr>
<tr>
    <td><br><br><strong>For WRS Info India Pvt Ltd. </strong><br>
         <img src='http://www.deal4loans.com/images/<?php echo $ImageName; ?>'><br>
 

Authorized Signatory<br>
      <strong><?php echo $GeneratedBy; ?></strong></td>
  </tr>
   <tr><td align="center" style="color:#666666;">WRS Info India Pvt Ltd, 128, Ground Floor, Priya Enclave, Delhi-110092</td></tr>
  </table>
  <table width="80%" align="center">
 <tr><td align="right">

<input type="hidden" name="BillingMonth" value="<?php echo $Bill_Period_Edited; ?>">
<input type="hidden" name="Invoice" value="<?php echo $Invoice_Number_Edited; ?>">
<input type="hidden" name="InvoiceDate" value="<?php echo $Invoice_Date_Edited; ?>">
<input type="hidden" name="Bidder_Name" value="<?php echo $Name_Edited; ?>">
<input type="hidden" name="Address" value="<?php echo $Name_Edited; ?>">
<input type="hidden" name="Product" value="<?php echo $Product_Edited; ?>">
<input type="hidden" name="TotalLead" value="<?php echo $Lead_Volume_Edited; ?>">
<input type="hidden" name="Cost" value="<?php echo $Cost_Lead_Edited; ?>">
<input type="hidden" name="Original_Amount" value="<?php echo $Sub_Total_Edited; ?>">
<input type="hidden" name="ServiceTax" value="<?php echo $Service_Tax_Edited; ?>">
<input type="hidden" name="educationcess" value="<?php echo $educationcess_Edited; ?>">
<input type="hidden" name="highereducationcess" value="<?php echo $highereducationcess_Edited; ?>">
<input type="hidden" name="FinalTotal" value="<?php echo $Total_Amount_Edited; ?>">
<input type="hidden" name="GeneratedBy" value="<?php echo $GeneratedBy_Edited; ?>">
<input type="hidden" name="City" value="<?php echo $City_Edited; ?>">
<input type="hidden" name="BidderID" value="<?php echo $BidderID_Edited; ?>">
<input type="hidden" name="Associated_Bank" value="<?php echo $Associated_Bank_Edited; ?>">
<input type="hidden" name="Check" value="<?php echo "Edit"; ?>">
<input  type='submit' name='submit' value='Generate'>
</td></tr>
</table></form>
</body>
</html>
<?php
}
 ?>
