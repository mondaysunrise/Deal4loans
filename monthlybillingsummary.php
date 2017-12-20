<?php
ob_start();
	require 'scripts/session_checkBilling.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//echo "Session :::: ";
//print_r ($_SESSION);
	
			function getReqValue1($pKey){
	$titles = array(
        '1' => 'Req_Loan_Personal',
		'2' => 'Req_Loan_Home',
		'3' => 'Req_Loan_Car',
		'4' => 'Req_Credit_Card',
		'5' => 'Req_Loan_Against_Property',
		'6' => 'Req_Business_Loan'
	);
	
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }

	function getReqValue($pKey){
	$titles = array(
        '1' => 'Personal Loan',
		'2' => 'Home Loan',
		'3' => 'Car  Loan',
		'4' => 'CreditCard',
		'5' => 'Loan Against Property',
		'6' => 'Business Loan',
	);
	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
  }
  
  	
	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}
	
	$SearchMonth="";
	if(isset($_REQUEST['SearchMonth']))
	{
		$SearchMonth=$_REQUEST['SearchMonth'];
	}
	
		
	$SearchYear="";
	if(isset($_REQUEST['SearchYear']))
	{
		$SearchYear=$_REQUEST['SearchYear'];

	}
	
	
	$Repy_TypeProduct ='';
	if(isset($_REQUEST['Repy_TypeProduct']))
	{
		$Repy_TypeProduct=$_REQUEST['Repy_TypeProduct'];

	}
	
//echo "pppp".$count;

	

	
?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">

<script type="text/JavaScript">

function chkform()
{
	if (document.frmsearch.SearchMonth.selectedIndex==0)
	{
		alert("Please enter Month to Continue");
		document.frmsearch.SearchMonth.focus();
		return false;
	}
	
	if (document.frmsearch.SearchYear.selectedIndex==0)
	{
		alert("Please enter Year to Continue");
		document.frmsearch.SearchYear.focus();
		return false;
	}
	
}
		
	function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}
	
		
</script>
</head>

<body>
<div align="center">
 <center>
 <?php  include '~TopBilling.php'; ?>
 <br>
 <br>
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="monthlybillingsummary.php?search=y" method="post" onSubmit="return chkform();">
   <tr>
     <td colspan="2" class="head1">Search</td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="20%"><strong>Date:</strong></td>
     <td width="80%">From 
	 <?php
	 $y=date('Y');
$m=date('m');
$dd=date('d');
$D=$y.'-'.$m.'-'.$dd;
$da=$y.'-'.$m.'-01';

     $MonthArray = array( Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec );
							echo "<select id='SearchMonth' name='SearchMonth'><option value=''>Month</option>";
									for($i=0;$i<count($MonthArray);$i++)
									{
										$value = $i+1;
										echo "<option value='".$value."'";
										if($SearchMonth==$value)
										echo "selected";
										echo ">".$MonthArray[$i]."</option>";
										
									}
									echo "</select>";
									
							echo "<select id='SearchYear' name='SearchYear'><option value=''>Year</option>";	
								for($i=2010;$i>2005;$i--)
								{
									echo "<option value='".$i."'";
									if($SearchYear==$i)
										echo "selected";
									
									 echo ">".$i."</option>";
									
								
								}
								echo "</select>";
									?>
									
         </td>
   </tr>
    <tr>
   <td width="20%"><strong>Products : </strong></td>
     <td width="80%" align="left">
	 <select name="Repy_TypeProduct"> 
	  <option value="-1" <?php if($Repy_TypeProduct==-1) echo "selected"; ?>>Select All Product</option>
	 <option value="Personal Loan" <?php if($Repy_TypeProduct=='Personal Loan') echo "selected"; ?>>Personal Loan</option>
	 <option value="Home Loan" <?php if($Repy_TypeProduct=='Home Loan') echo "selected"; ?>>Home Loan</option>
	 <option value="Car Loan" <?php if($Repy_TypeProduct=='Car Loan') echo "selected"; ?>>Car Loan</option>
	 <option value="Credit Card" <?php if($Repy_TypeProduct=='Credit Card') echo "selected"; ?>>Credit Card</option>
	 <option value="Loan Against Property" <?php if($Repy_TypeProduct=='Loan Against Property') echo "selected"; ?>>Loan Against Property</option>
	 <option value="Business loan" <?php if($Repy_TypeProduct=='Business loan') echo "selected"; ?>>Business loan</option>
	 </select>
	 
	    <input name="Submit" type="submit" class="bluebutton" value="Search" border="0">
	 </td>
     </tr>
   <tr>
          <td colspan="2" align="center">&nbsp;</td>
     </tr>
   </form>
 </table>
 <p>&nbsp;</p>
	<?
	$search_date="";
	
	if($search=="y" || isset($_REQUEST['SearchMonth']))
	{	
	
		$min_date = $SearchYear."-".$SearchMonth."-01 00:00:00";
		$max_date = $SearchYear."-".$SearchMonth."-31 23:59:59";
		
	?>
	
 
	
      <table width="970" border="0" cellpadding="2" cellspacing="1" class="blueborder">
<?

	if($Repy_TypeProduct==-1)
	{
		$qry="select * from Bill_Record where Min_Date >= '".$min_date."' and Max_Date <= '".$max_date."'";
	}
	else 
	{
		$qry="select * from Bill_Record where Min_Date >= '".$min_date."' and Max_Date <= '".$max_date."'and Reply_type = '".$Repy_TypeProduct."'";
	}
	//echo $qry;
	
	 list($recordcount,$getrow)=MainselectfuncNew($qry,$array = array());
		$r=0;
	
	//$result1=ExecQuery($qry);
	//$recordcount = mysql_num_rows($result1);
 ?>
     
        <tr> 
	<td width="55" class="head1">Serial No.</td> 
		<td width="81"  class="head1">GeneratedBy</td>
		 <td width="45" class="head1">Invoice Number</td>
          <td width="51" class="head1">Bidder Name</td>
          <td width="54"  class="head1">Product Type</td>
          <td width="43"  class="head1">Lead Volume</td>
          <td width="32"  class="head1">CPL</td>
          <td width="31"  class="head1">Sub Total</td>
          <td width="46"  class="head1">Service Tax</td>
          <td width="49"  class="head1">Total Amount</td>
		  <td width="53"  class="head1">Payment Mode</td>
		   <td width="159" class="head1">Payment Received Date</td>
		   <td width="88" class="head1">Payment Received</td>
		   
		  <td width="82" class="head1">TDS</td>
          <td width="83" class="head1">Amount Left</td>
		  
        </tr>
		<?php
		
		$Validate = mysql_num_rows($result1);
		$TotalPayment = 0;
		
		
		
while($r<count($getrow))
        {
			$BID  = $getrow[$r]['BID'];
			$Generated_By  = $getrow[$r]['Generated_By'];
			$Invoice_Number = $getrow[$r]['Invoice_Number'];
			$StoredName = $getrow[$r]['Name'];
			$StoredProduct = $getrow[$r]['Product'];
			$StoredLeadCount = $getrow[$r]['Lead_Volume'];
			$TotalStoredLeadCount = $TotalStoredLeadCount +$StoredLeadCount;
			
			$StoredCost_Lead = $getrow[$r]['Cost_Lead'];
			$StoredSub_Total = $getrow[$r]['Sub_Total'];		
			$TotalStoredSub_Total = $TotalStoredSub_Total +$StoredSub_Total;
			
			$StoredService_Tax = $getrow[$r]['Service_Tax'];
			$TotalStoredService_Tax = $TotalStoredService_Tax +$StoredService_Tax;
			
			$StoredTotal_Amount = $getrow[$r]['Total_Amount'];
			$TotalPayment = $TotalPayment +$StoredTotal_Amount;
			
			$Payment_Received = $getrow[$r]['Payment_Received'];
			$TotalPayment_Received = $TotalPayment_Received +$Payment_Received;
				$Payment_TDS = $getrow[$r]['Payment_TDS'];
			$Generated_By  = $getrow[$r]['Generated_By'];
			$AmtLeft = $StoredTotal_Amount-$Payment_Received-$Payment_TDS; 
			$TotalAmtLeft = $TotalAmtLeft +$AmtLeft;
			$Payment_By  = $getrow[$r]['Payment_By'];
			$Payment_Mode  = $getrow[$r]['Payment_Mode'];
			$Payment_Date  = $getrow[$r]['Payment_Date'];
		
		
		?>
		 <tr>
		 <td class="bodyarial11"><?php $SerialNo = $SerialNo + 1;
		echo $SerialNo; ?> </td>
		 		<td  class="bodyarial11"><?php echo $Generated_By; ?></td>
		 <td  class="bodyarial11"><strong><?php echo $Invoice_Number; ?></strong></td>
          <td  class="bodyarial11"><?php echo $StoredName; ?></td>
          <td  class="bodyarial11"><?php echo $StoredProduct; ?></td>
          <td  class="bodyarial11"><?php echo $StoredLeadCount; ?></td>
          <td  class="bodyarial11"><?php echo $StoredCost_Lead; ?></td>
          <td  class="bodyarial11"><?php echo $StoredSub_Total; ?></td>
          <td  class="bodyarial11"><?php echo $StoredService_Tax; ?></td>
          <td  class="bodyarial11"><?php echo $StoredTotal_Amount; ?></td>
		    <td  class="bodyarial11"><?php echo $Payment_By."&nbsp;".$Payment_Mode?></td>
          <td  class="bodyarial11"><?php echo $Payment_Date; ?> </td>
		  <td  class="bodyarial11"><?php echo $Payment_Received; ?> </td>
		  <td  class="bodyarial11"><?php echo $Payment_TDS; ?></td>
		  <td  class="bodyarial11"><?php echo $AmtLeft; ?></td>
		  
       </tr>
		<?php
		$r = $r +1;}
		?>
		<tr bgcolor="#C0C0C0"> 
		<td  class="bodyarial11">&nbsp;</td>
		 <td  class="bodyarial11"></td>
		 <td  class="bodyarial11"></td>
          <td  class="bodyarial11"></td>
          <td  class="bodyarial11"></td>
          <td  class="bodyarial11"><strong><?php echo $TotalStoredLeadCount; ?></strong></td>
          <td  class="bodyarial11"></td>
          <td class="bodyarial11"><strong><?php echo $TotalStoredSub_Total; ?></strong></td>
          <td class="bodyarial11"><strong><?php echo $TotalStoredService_Tax; ?></strong></td>
          <td class="bodyarial11"><strong><?php echo $TotalPayment; ?></strong></td>
		  <td class="bodyarial11"></td>
		  <td class="bodyarial11"></td>
          <td class="bodyarial11"><strong><?php echo $TotalPayment_Received; ?></strong>
		  </td>
		  		  <td class="bodyarial11"></td>

		  <td class="bodyarial11"><strong><?php echo $TotalAmtLeft; ?></strong></td>
		  </tr>
		</table>
	
		<?php
		}
		?>
		
	

 </h3>
 </center>
</div>

</body>

</html>