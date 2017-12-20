<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
	require 'scripts/session_check_online.php';
	
	//print_r($_POST);
   function getReqValue($pKey){
    $titles = array(
        '1' => 'Personal Loan',
        '2' => 'Home Loan',
        '3' => 'Car Loan',
        '4' => 'Credit Card',
        '5' => 'LAP',
        '6' => 'Business Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

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

  function getReqallocate1($pKey){
	$titles = array(
        '1' => 'Req_Feedback_Bidder_PL',
		'2' => 'Req_Feedback_Bidder_HL',
		'3' => 'Req_Feedback_Bidder_CL',
		'4' => 'Req_Feedback_Bidder_CC',
		'5' => 'Req_Feedback_Bidder_LAP'		
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

  $product="";
	if(isset($_REQUEST['product']))
	{
		$product=$_REQUEST['product'];
	}

$citylist = "";
if(isset($_REQUEST['citylist']))
	{
		$citylist=$_REQUEST['citylist'];
	}
$bank_name = "";
if(isset($_REQUEST['bank_name']))
	{
		$bank_name=$_REQUEST['bank_name'];
	}

$allocationtbl=getReqallocate1($product);
$val=getReqValue1($product);
?>
<html>
<head>
<title>PrePaid Bidders List</title>
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
 <center>
 <?php include '~TopBidder.php'; ?>
 <table width='535' border='0' cellspacing='0' cellpadding='4'  class="blueborder" align="center">
 <form name="frmsearch" action="prepaidcount_accounts.php?search=y" method="post" onSubmit="return chkform();">
   <tr>
     <td colspan="4" class="head1">Search</td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	   <td width="13%">&nbsp;</td>
     <td width="41%">&nbsp;</td>
   </tr>
   <tr>
     <td width="11%"><strong>Product</strong></td>
     <td width="35%">
		<select name="product" id="product">
		<option value="">Please Select</option>
			<option value="1" <? if($product=="1") { echo "selected";} ?>>Personal Loan</option>
			<option value="2" <? if($product=="2") { echo "selected";} ?>>Home Loan</option>
			<option value="3" <? if($product=="3") { echo "selected";} ?>>Car Loan</option>
			<option value="4" <? if($product=="4") { echo "selected";} ?>>Credit Card</option>
			<option value="5" <? if($product=="5") { echo "selected";} ?>>Loan Against Property</option>
			</select>
		</td>
		<td>City list</td>
		<td><select name="citylist" id="citylist"><? echo $citylist; ?><?=plgetCityList($citylist)?></select></td>
   </tr>
  <tr><td colspan="2"><strong>Bank Name</strong></td><td colspan="2"><select name="bank_name" id="bank_name"> <option value="">Please Select</option><? $bnknmeqry="Select * from Bank_Master where (vw_flag=1)";
  $resultqry=ExecQuery($bnknmeqry);
  while($bnk=mysql_fetch_array($resultqry))
		{ ?>
		<option value="<? echo $bnk["BankID"]; ?>" <? if($bank_name==$bnk["BankID"]) { echo "Selected";} ?>><? echo $bnk["Bank_Name"]; ?></option>
		<? }
  ?></select></td></tr>
   <tr>
     <td colspan="4" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   </form>
</table>
<? if($search=="y")
	{ 
		$getdetailsqry="Select * from Bidders_List Where (Reply_Type=".$product." and City like '%".$citylist."%' and  Restrict_Bidder=1 and BankID=".$bank_name.")";
		//echo "<br><br>".$getdetailsqry."<br><br>";
$getdetailsresult=ExecQuery($getdetailsqry);
		?>
<table width='700' border='1' cellspacing='0' cellpadding='5'  class="blueborder" align="center">
<tr><td width="87" height="30" align="center"><strong>Bank Name</strong></td>
	<td width="38" align="center">City</td>
    <td width="87" align="center">Max Leads</td>
    <td width="206" align="center">Leads Gone(As shown in LMS)</td>
    <td width="72" align="center">BD name</td>
	<td width="72" align="center">Type</td>
</tr>
<? while($row=mysql_fetch_array($getdetailsresult))
		{ ?>
	<tr><td width="87" height="30" align="center"><? echo $row["Bidder_Name"]; ?></td>
	<td width="38" align="center"><textarea rows="1"><?php echo $row["City"]; ?></textarea></td>
    <td width="87" align="center"><? $CapLead_Count= $row["CapLead_Count"]; $explodeCapLead_Count = explode(",", $CapLead_Count); 
	//print_r($explodeCapLead_Count);
	//echo $row["CapLead_Count"];
	echo $explodeCapLead_Count[3]; ?></td>
    <td width="206" align="center"><? $SqlCountLead="SELECT RequestID FROM ".$allocationtbl.",`".$val."` WHERE ".$allocationtbl.".AllRequestID=`".$val."`.RequestID and ".$allocationtbl.".BidderID = '".$row["BidderID"]."' and  ".$allocationtbl.".Reply_Type = '".$product."' group by ".$val.".Mobile_Number";
	//echo "<br><br>".$SqlCountLead."<br><br>";
	$QueryCountLead = ExecQuery($SqlCountLead);
	$TotalLeadsLMS = mysql_num_rows($QueryCountLead);
	echo $TotalLeadsLMS;
	?></td>
    <td width="72" align="center"><? $bdnameqry="select BD_Name,Define_PrePost from Bidders Where (BidderID=".$row["BidderID"].")";
$bdnameqryresult = ExecQuery($bdnameqry);
	$bd= mysql_fetch_array($bdnameqryresult);
	echo $bd["BD_Name"];
	?></td>
	<td><? echo $bd["Define_PrePost"]; ?></td>
</tr>
		<? }
?>
<tr><td colspan="6">&nbsp;</td></tr>
</table>
<? } ?>
</center>
</div>
</body>
</html>