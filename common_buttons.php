<?php

$ccdetails = "select Gender,Landline,Std_Code, Account_No,Pancard_No,Pancard,Employment_Status, CC_Holder,Dated,DOB,Name,Email,Company_Name,City, City_Other,Mobile_Number,Net_Salary,Loan_Amount,Pincode,IP_Address,Add_Comment,Residence_Address, applied_card_name,Office_Address,Updated_Date, UserID from  Req_Credit_Card_Sms Where (RequestID=".$requestid.")";
//echo $ccdetails."<br>";
$ccdetailsresult = ExecQuery($ccdetails);
$ccrow=mysql_fetch_array($ccdetailsresult);


?>

<table style='border:1px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="700" height="80%" align="center" border="1" >
<tr><td colspan="4" align="right">
<?php 
if($process=="cq")
{

//Put the Curing Queue Form
?>

<?php
}
else {
	if($_SESSION['BidderID'] == 6741 || $_SESSION['BidderID']==6747) { 
		/*
			Note : This Query is checking for given mobile number or pancard whether:
			a. related user entry exists in table "sbi_credit_card_5633" based on column "first_dated" within 180 days.
			OR
			b. related user entry exists in table "sbi_credit_card_5633_log" based on column "first_dated" within 180 days.

			If there is any row exists in any table, then we do not submit data to SBI(Do not show "SBI Send now" button).
		*/
		$checkSMSMobileandPanSql = "SELECT rcc.RequestID, rcc.Mobile_Number, rcc.Pancard, scc.first_dated as SCC_FirstDated, sccl.first_dated as SCCL_FirstDated FROM `Req_Credit_Card` as rcc LEFT JOIN `sbi_credit_card_5633` as scc ON(scc.RequestID = rcc.RequestID AND (scc.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))) LEFT JOIN `sbi_credit_card_5633_log` as sccl ON (sccl.cc_requestid = rcc.RequestID AND (sccl.first_dated > DATE_SUB(NOW(), INTERVAL 180 DAY))) WHERE (rcc.`Mobile_Number` = '".$ccrow["Mobile_Number"]."' ";
		if(!empty($ccrow["Pancard"]))
		{
			$checkSMSMobileandPanSql .= " OR (rcc.`Pancard` = '".$ccrow["Pancard"]."') ";
		}
        			
        			
		$checkSMSMobileandPanSql .= " ) AND (scc.first_dated != '0000-00-00 00:00:00' OR sccl.first_dated != '0000-00-00 00:00:00') ";
		//echo $checkSMSMobileandPanSql;
		$checkSMSMobileandPanQuery = ExecQuery($checkSMSMobileandPanSql);
		$checkSMSMobileandPanNumRows = mysql_num_rows($checkSMSMobileandPanQuery);      

		if($checkSMSMobileandPanNumRows>0)
		{ } 
		else {
		?>

		<form method="POST" action="/soapservice_sbi5633_1sms.php" name="sendform" target="_blank">
		<input type="hidden" name="custid"id="custid"  value="<?php echo $requestid; ?>" />
		<input type="Submit" name="Submitd" value="SBI Send now" style="color:#FFF; background-color:#C00;" /></form>
		<?php 
		}
	}
	else
	{
	?>

		<form method="POST" action="/soapservice_sbi5633_1sms.php" name="sendform" target="_blank">
		<input type="hidden" name="custid"id="custid"  value="<?php echo $requestid; ?>" />
		<input type="Submit" name="Submitd" value="SBI Send now" style="color:#FFF; background-color:#C00;" />
		</form>

	<?php
	}
	?>
	| 
	<?php 
	$getStancSql = "select City, Query from Bidders_List where BidderID = 6455 and Restrict_Bidder=1";
	$getStancQuery = ExecQuery($getStancSql);
	$getStancNumRows = mysql_num_rows($getStancQuery);
	if($getStancNumRows>0)
	{
		$City = mysql_result($getStancQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);
		
		$sqlStanc = mysql_result($getStancQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
		$sqlStanc = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlStanc);
		//echo $sqlStanc."<br>";
		$QueryStanc = ExecQuery($sqlStanc);
		$numRowsStanc = mysql_num_rows($QueryStanc);
		if($numRowsStanc>0)
		{
	?>
	<a href="scb_agent_form.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">SCB Send now</a>
	<?php 
		}
	} ?> 
	<?php 
	$getrblSql = "select Query,City from Bidders_List where BidderID = 4905";
	$getrblQuery = ExecQuery($getrblSql);
	$getrblNumRows = mysql_num_rows($getrblQuery);
	if($getrblNumRows>0)
	{
		$City = mysql_result($getrblQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);	
		$sqlrbl = mysql_result($getrblQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
		$sqlrbl = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlrbl);

		$Queryrbl = ExecQuery($sqlrbl);
		$numRowsrbl = mysql_num_rows($Queryrbl);
		if($numRowsrbl>0)
		{
	?>
	<a href="rblcc_agent_form.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">RBL Send now</a>
	<?php 
		} 
	} ?>
	<?php
	$getAmexSql = "select City, Query from Bidders_List where BidderID = 5596";
	$getAmexQuery = ExecQuery($getAmexSql);
	$getAmexNumRows = mysql_num_rows($getAmexQuery);
	if($getAmexNumRows>0)
	{
		$City = mysql_result($getAmexQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);
		
		$sqlAmex = mysql_result($getAmexQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
		$sqlAmex = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlAmex);
		//echo $sqlAmex ."<br>";
		$QueryAmex = ExecQuery($sqlAmex);
		$numRowsAmex = mysql_num_rows($QueryAmex);
		if($numRowsAmex>0)
		{
	?>
	| 
	<a href="amex_agent_form.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">AMEX Send now</a>
	<?php 
		} 
	} ?> 
	<?php
	$getICICISql = "select City, Query from Bidders_List where BidderID = 6588";
	$getICICIQuery = ExecQuery($getICICISql);
	$getICICINumRows = mysql_num_rows($getICICIQuery);
	if($getICICINumRows>0)
	{
		$City = mysql_result($getICICIQuery,0,'City');
		$CityList =  str_replace(",", "', '", $City);
		
		$sqlICICI = mysql_result($getICICIQuery,0,'Query')." and Req_Credit_Card.RequestID='".$requestid."' and  Req_Credit_Card.City in ('".$CityList."')";
		$sqlICICI = str_replace("Req_Credit_Card", "Req_Credit_Card_Sms",$sqlICICI);
		//echo $sqlICICI ."<br>";
		$QueryICICI = ExecQuery($sqlICICI);
		$numRowsICICI = mysql_num_rows($QueryICICI);
		if($numRowsICICI>0)
		{
	?>
	| 
	<a href="icici-credit-card-continue_lms.php?cust_id=<?php echo $requestid; ?>" style="color:#FFF; background-color:#C00;" target="_blank">ICICI Send now</a>
	<?php 
		} 
	} ?> 
</td></tr>

<tr><td colspan="4">  
	<?
	$checkProductTableDetails = ExecQuery("select * from Req_Credit_Card_Sms Where (RequestID=".$requestid." and UserID>0)");
	//echo "select * from Req_Credit_Card_Sms Where (RequestID=".$requestid." and UserID>0)<br>";
	$checkProductTableDetailsQry=ExecQuery($checkProductTableDetails);
	$checkProductTableDetailsNum = mysql_num_rows($checkProductTableDetails);
	if($checkProductTableDetailsNum>0)
	{
		//echo "select * from sbi_credit_card_5633 Where (RequestID=".$UserID.") and ApplicationNumber!='' ORDER BY sbiccid DESC limit 0,1";
		$cc_alldetailsqry = ExecQuery("select * from sbi_credit_card_5633 Where (RequestID=".$UserID.") and ApplicationNumber!='' ORDER BY sbiccid DESC limit 0,1");
		$numWSCheck = mysql_num_rows($cc_alldetailsqry);
		if($numWSCheck>0)
		{
			$ccal = mysql_fetch_array($cc_alldetailsqry); 
	?>
			<table align="left"><tr><td>Application Number : <? echo $ccal["ApplicationNumber"]; ?> <br>Status Code : <? echo $ccal["ApplicationNumber"]; ?><br>Processing Status : <? echo $ccal["ProcessingStatus"]; ?><br>Messages : <? echo $ccal["Messages"]; ?><br>message : <? echo $ccal["message"]; ?>
  
	<?php 
		} 
		else {
			$cc_alldetailsqry = ExecQuery("select * from sbi_credit_card_5633_log Where (cc_requestid=".$UserID.") group by cc_requestid order by first_dated DESC");
			$ccal=mysql_fetch_array($cc_alldetailsqry); ?>
			<table align="left"><tr><td>Application Number : <? echo $ccal["ApplicationNumber"]; ?> <br>Status Code : <? echo $ccal["ApplicationNumber"]; ?><br>Processing Status : <? echo $ccal["ProcessingStatus"]; ?><br>Messages : <? echo $ccal["Messages"]; ?><br>message : <? echo $ccal["message"]; ?>
  <?php }
	}
} ?>
</td><tr>
</table>
</td></tr>
</table>

