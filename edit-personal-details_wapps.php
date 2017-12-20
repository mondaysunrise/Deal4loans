<?php
error_reporting(0);
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//edit-personal-details.php?postid=2030280&biddt=5060
$requestid = $_REQUEST["postid"];
$bidderid = $_REQUEST["biddt"];
$Reply_Type = 1;
//$requestid =1114214;
//$bidderid = 1037;
//print_r($_SESSION);
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}
function getEligibleLoanAmount($arrSalary, $unsecuredLoanEMI, $cardOutStanding, $securedLoanEMI, $standardEMI=2757)
{
	$returnValue = '';
	$averageSalary = (array_sum($arrSalary) / count($arrSalary)); 
	$returnValue[] = round($averageSalary);
	$ccOutStanding = $cardOutStanding *( 5 /100 ); 
	$totalOutStanding_unsecured = $unsecuredLoanEMI + $ccOutStanding;
	$returnValue[] = round($totalOutStanding_unsecured);
	$totalObligation = $totalOutStanding_unsecured + $securedLoanEMI;
	$returnValue[] = round($totalObligation);
	$currentFOIR_Unsecured = $totalOutStanding_unsecured / $averageSalary * 100;
	$currentFOIR_Total = ($securedLoanEMI + $totalOutStanding_unsecured) / $averageSalary * 100;
	$returnValue[] = round($currentFOIR_Unsecured,2);
	$returnValue[] = round($currentFOIR_Total,2);
	if($averageSalary>=50000)
	{
		if($currentFOIR_Unsecured<=55)
			$loanCalcUS = $averageSalary * 55 /100; // for unsecured
		else
			$loanCalcUS = 0;
		if($currentFOIR_Total<=65)
			$loanCalcTotal = $averageSalary * 65 /100; // for secured	
		else
			$loanCalcTotal = 0;
	}
	else
	{
		if($currentFOIR_Unsecured<=45)
			$loanCalcUS = $averageSalary * 45 /100; // for unsecured
		else
			$loanCalcUS = 0;
		if($currentFOIR_Total<=55)
			$loanCalcTotal = $averageSalary * 55 /100; // for secured	
		else
			$loanCalcTotal = 0;
	}
	if($loanCalcUS>0)
		$unsecured_EligibleEMI = (($loanCalcUS - $totalOutStanding_unsecured) / $standardEMI) * 100000;
	else
		$unsecured_EligibleEMI = 0;
	if($loanCalcTotal>0)	
		$total_EligibleEMI = (($loanCalcTotal - $totalObligation) / $standardEMI) * 100000;
	else 
		$total_EligibleEMI = 0;
		
	$finalEligibleLoanAmount = ceil(min($unsecured_EligibleEMI,$total_EligibleEMI));
	if($finalEligibleLoanAmount>0)
	{

		$returnValue[] = $finalEligibleLoanAmount;
	}
	else
	{
		$returnValue[] = "Not Eligible";
	}
	
	return $returnValue;
}


$pldetails = "select Company_Type, Salary_Drawn, Employment_Status, Residential_Status, EMI_Paid, Card_Vintage, CC_Holder, Dated, DOB, Name, Email, Company_Name, City, City_Other, Years_In_Company, Total_Experience, Mobile_Number, Net_Salary, Loan_Any, Loan_Amount, PL_EMI_Amt, Pincode, Card_Limit, IP_Address, Add_Comment,Primary_Acc from Req_Loan_Personal Where (RequestID=".$requestid.")";
//echo $pldetails."<br>";
$pldetailsresult = d4l_ExecQuery($pldetails);
$plrow=d4l_mysql_fetch_array($pldetailsresult);

$pl_alldetails = d4l_ExecQuery("select * from Req_Feedback_Bidder_PL Where (AllRequestID=".$requestid." and BidderID=".$bidderid.")");
$plrowal=d4l_mysql_fetch_array($pl_alldetails);
$Final_Bidder = $plrowal["BidderID"];

$Final_Bidder = 6364;

if($plrow["Annual_Turnover"]==1) { $annual_turnover="0-40 Lacs"; } 
else if($plrow["Annual_Turnover"]==2) { $annual_turnover="1Cr - 3Crs"; } 
else if($plrow["Annual_Turnover"]==3) { $annual_turnover="3Crs & above"; } 
else if($plrow["Annual_Turnover"]==4) { $annual_turnover="40Lacs To 1 Cr"; } 
else { $annual_turnover="";  }

if($plrow["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }

if($plrow["CC_Holder"]==1) { $cc_holder="Yes"; }  if($plrow["CC_Holder"]==0) { $cc_holder="No"; }
		
			if($plrow["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($plrow["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($plrow["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($plrow["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($plrow["Card_Vintage"]==1)	  {	$card_vintage="Less than 6 months";}
			elseif($plrow["Card_Vintage"]==2) {	$card_vintage="6 to 9 months";}
			elseif($plrow["Card_Vintage"]==3) {	$card_vintage="9 to 12 months";}
			elseif($plrow["Card_Vintage"]==4) {	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}

if($plrow["Company_Type"]==0)	{	$Company_Type="";}
if($plrow["Company_Type"]==1)	{	$Company_Type="Pvt Ltd";}
if($plrow["Company_Type"]==2)	{	$Company_Type="MNC Pvt Ltd";}
if($plrow["Company_Type"]==3)	{	$Company_Type="Limited";}
if($plrow["Company_Type"]==4)	{	$Company_Type="Govt.( Central/State )";}
if($plrow["Company_Type"]==5)	{	$Company_Type="PSU (Public sector Undertaking)";}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		//print_r($_POST);
	if($submit_p=="Submit")
	{
		$plrequestid = FixString($_POST["plrequestid"]);
		$SalaryArr=$_POST["SalaryArr"];
		$Salary = implode(',', $SalaryArr);
		$unsecured_emi = FixString($_POST["unsecured_emi"]);
		$secured_emi = FixString($_POST["secured_emi"]);	
		$card_outstanding = FixString($_POST["card_outstanding"]);	
		$cibil_reference_id = FixString($_POST['cibil_reference_id']);
		$sqlExtraFields = "select RequestID,id from Req_Loan_Personal_Extra_Fields where RequestID='".$plrequestid."'";
		$queryExtraFields = d4l_ExecQuery($sqlExtraFields);
		$numRowsExtraFields = d4l_mysql_num_rows($queryExtraFields);
		if($numRowsExtraFields>0)
		{
			$sqlData = "update Req_Loan_Personal_Extra_Fields set Salary='".$Salary."', unsecured_emi='".$unsecured_emi."', secured_emi='".$secured_emi."', card_outstanding='".$card_outstanding."', cibil_reference_id = '".$cibil_reference_id."' where RequestID='".$plrequestid."'";
		}
		else
		{
			$sqlData = "INSERT INTO Req_Loan_Personal_Extra_Fields (`RequestID`, `Salary`, `unsecured_emi`, `secured_emi`, `card_outstanding`, `cibil_reference_id`) VALUES ('".$plrequestid."', '".$Salary."', '".$unsecured_emi."', '".$secured_emi."', '".$card_outstanding."', '".$cibil_reference_id."')";
		}
//		echo $sqlData;
		d4l_ExecQuery($sqlData);
	}
        
        //Send to IIFL 
        if($_REQUEST['SendtoIIFL']=='Send to IIFL')
        {
            $PostId = $_REQUEST['postid'];
            $IIFLBidId = 6734;
            $sqlIIFL = "select Feedback_ID from Req_Feedback_Bidder_PL where AllRequestID='".$PostId."' and BidderID='".$IIFLBidId."'";
            $queryExtraFields = d4l_ExecQuery($sqlIIFL);
            $numRowsIIFL = d4l_mysql_num_rows($queryExtraFields);
            if(!$numRowsIIFL)
            {
                $sqlIIFLData = "INSERT INTO Req_Feedback_Bidder1 (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$PostId."', '".$IIFLBidId."', '1', '1', '".date("Y-m-d h:i:s")."')";
                 d4l_ExecQuery($sqlIIFLData);
                
                $sqlIIFLBidPLData = "INSERT INTO Req_Feedback_Bidder_PL (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$PostId."', '".$IIFLBidId."', '1', '1', '".date("Y-m-d h:i:s")."')";
                 d4l_ExecQuery($sqlIIFLBidPLData);
                 header("Location: http://".$_SERVER['HTTP_HOST']."/edit-personal-details.php?postid=".$PostId."&biddt=".$_REQUEST['biddt']."&iifl=send");
                 
            }
        }
        //Start Send to Qbera 
        if($_REQUEST['SendtoQbera']=='Send to Qbera')
        {
           echo $_REQUEST['qberaCity'];
           if($_REQUEST['qberaCity']=='Delhi'){
                $QberaBidId = 6926;
           }else if($_REQUEST['qberaCity']=='Bangalore'){
              $QberaBidId = 6925; 
           }elseif($_REQUEST['qberaCity']=='Chennai'){
             $QberaBidId = 6927;    
           }
            $PostId = $_REQUEST['postid'];
            $sqlQbera = "select Feedback_ID from Req_Feedback_Bidder_PL where AllRequestID='".$PostId."' and BidderID='".$QberaBidId."'";
            $queryExtraFields = d4l_ExecQuery($sqlQbera);
            $numRowsQbera = d4l_mysql_num_rows($queryExtraFields);
            if(!$numRowsQbera)
            {
                $sqlQberaData = "INSERT INTO Req_Feedback_Bidder1 (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$PostId."', '".$QberaBidId."', '1', '1', '".date("Y-m-d h:i:s")."')";
                 d4l_ExecQuery($sqlQberaData);
                
                $sqlQberaBidPLData = "INSERT INTO Req_Feedback_Bidder_PL (`AllRequestID`, `BidderID`, `Reply_Type`, `Allocated`, `Allocation_Date`) VALUES ('".$PostId."', '".$QberaBidId."', '1', '1', '".date("Y-m-d h:i:s")."')";
                 d4l_ExecQuery($sqlQberaBidPLData);
                 header("Location: http://".$_SERVER['HTTP_HOST']."/edit-personal-details_040717yash.php?postid=".$PostId."&biddt=".$_REQUEST['biddt']."&qbera=sendqbera");
                 
            }
        }
        //End Send to Qbera
}

	$sqlExtraFields = "select * from Req_Loan_Personal_Extra_Fields where RequestID='".$requestid."'";
	$queryExtraFields = d4l_ExecQuery($sqlExtraFields);
	$numRowsExtraFields = d4l_mysql_num_rows($queryExtraFields);
	if($numRowsExtraFields>0)
	{
		$Salary = d4l_mysql_result($queryExtraFields,0,'Salary');
		$arrSalary = explode(',', $Salary);
		$firstMonth = $arrSalary[0];
		$secondMonth = $arrSalary[1];
		$thirdMonth = $arrSalary[2];
		$cibil_reference_id = d4l_mysql_result($queryExtraFields,0,'cibil_reference_id');
		$unsecured_emi = d4l_mysql_result($queryExtraFields,0,'unsecured_emi');
		$secured_emi = d4l_mysql_result($queryExtraFields,0,'secured_emi');
		$card_outstanding = d4l_mysql_result($queryExtraFields,0,'card_outstanding');
		list($averageSalary,$total_unsecured_obligation,$total_obligation, $unsecuredFOIR, $totalFOIR, $eligible_loan_amount) = getEligibleLoanAmount($arrSalary, $unsecured_emi, $card_outstanding, $secured_emi);
	}
	if($firstMonth<=0) {$firstMonth='';}
	if($secondMonth<=0) {$secondMonth='';}
	if($thirdMonth<=0) {$thirdMonth='';}
	if($unsecured_emi<=0) {$unsecured_emi='';}
	if($secured_emi<=0) {$secured_emi='';}
	if($card_outstanding<=0) {$card_outstanding='';}			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan</title>
<style type="text/css">
<!--
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
-->
body{ font-family:Arial, Helvetica, sans-serif;}
</style>
<? $aa=1; if($aa == 1)
{
}
else
{ ?>
<script type="text/JavaScript">
function killCopy(e){ return false; }
function reEnable(){return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
function clickIE4(){if (event.button==2){ return false; } }
function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
document.oncontextmenu=new Function("return false")
</script>
<? } ?>
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script language="javascript" type="text/javascript" src="scripts/common.js"></script>
</head>

<body>

<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="841" height="80%" align="center" border="0" >
<?php 
if(strlen($_SESSION['reportValue'])>0)
{ ?>
  <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0"><strong><?php echo $_SESSION['reportValue']; ?></strong></td>
    </tr>
<?php } ?>
  <tr>
      <td colspan="4" align="center" bgcolor="#F0F0F0" class="heading" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC;"><strong>Personal Details</strong></td>
    </tr>
 <tr>
      <td width="202" valign="top"> <strong>Customer Name</strong></td>
   <td  width="181" align="left" valign="top"><? echo $plrow["Name"]; ?></td>
<td  width="178" valign="top"><strong> DOB: </strong></td>
     <td  width="228"><? echo $plrow["DOB"]; ?></td>
  </tr>
     <tr>
       <td valign="top" bgcolor="#F0F0F0" ><strong> Email: </strong></td>
       <td align="left" valign="top" bgcolor="#F0F0F0" ><? echo $plrow["Email"]; ?></td>
  <td valign="top" bgcolor="#F0F0F0" ><strong> Mobile No:</strong></td>
      <td bgcolor="#F0F0F0" ><? echo ccMasking($plrow["Mobile_Number"]); ?></td>
  </tr>
     <tr>
        <td><span class="style2"> Occupation: </span></td>
       <td><span class="style21"><? echo $emp_status; ?></span></td>
         <td><span class="style2"> City: </span></td>
    <td><span class="style21"><? echo $plrow["City"]; ?></span></td>
  </tr>
     <tr>
        <td  valign="top" bgcolor="#F0F0F0"><span class="style2"> Other City: </span></td>
       <td align="left" valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrow["City_Other"]; ?></span></td>
 
        <td  valign="top" bgcolor="#F0F0F0"><span class="style2"> Pincode: </span></td>
       <td align="left" valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrow["Pincode"]; ?></span></td>
  </tr>
     <tr>
        <td><span class="style2"> Company Name: </span></td>
       <td><span class="style21"><? echo $plrow["Company_Name"]; ?></span></td>
        <td><span class="style2"> Company Type: </span></td>
        <td><span class="style21"><? echo $Company_Type;?></span></td>
     </tr>    
     <tr>
        <td valign="top" bgcolor="#F0F0F0"><strong> Card Holder:</strong> </td>
        <td  valign="top" bgcolor="#F0F0F0"><? echo $cc_holder; ?></td>
        <td  valign="top" bgcolor="#F0F0F0"><strong>Card Vintage:</strong> </td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $card_vintage; ?></td>
     </tr>     
      <tr>
        <td><span class="style2"> Annual Income: </span></td>
        <td><span class="style21"><? echo $plrow["Net_Salary"]; ?></span></td>
 
        <td><span class="style2"> Annual Turnover: </span></td>
        <td><span class="style21"><? echo $annual_turnover; ?></span></td>

     <tr>
        <td valign="top" bgcolor="#F0F0F0"><strong> Loan Running:</strong> </td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $plrow["Loan_Any"]; ?></td>
        <td valign="top" bgcolor="#F0F0F0"><strong>Total EMI Paid: </strong></td>
        <td valign="top" bgcolor="#F0F0F0"><? echo $emi_paid; ?></td>    
     </tr>
      <tr>
        <td><span class="style2">Required Loan Amount: </span></td>
        <td><span class="style21"><? echo $plrow["Loan_Amount"]; ?></span></td>
          <td><span class="style2">Account Bank: </span></td>
        <td><span class="style21"><? echo $plrow["Primary_Acc"]; ?></span></td>
     </tr>
     <tr>
        <td valign="top" bgcolor="#F0F0F0"><span class="style2">Comments: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrow["Add_Comment"]; ?></span></td>
    
        <td valign="top" bgcolor="#F0F0F0"><span class="style2">Date of entry: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><span class="style21"><? echo $plrowal["Allocation_Date"]; ?></span></td>
  </tr>
  <? if($bidderid==7024)
  {  $incredqry="Select webserviceid from webservice_details_pl Where (productid=".$requestid." and product='PL' and bankid=86 and api_response_status=1)";
	  $incredqryresult = d4l_ExecQuery($incredqry);
		$incredrecordcount = d4l_mysql_num_rows($incredqryresult);
		if($incredrecordcount>0)
	  {
			echo "API Already done";
	  }
	  else {
  ?>
    <tr>
        <td valign="top" bgcolor="#F0F0F0" colspan="2" align="center"><span class="style2" > <form action="/apply_pl_consentincred.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $requestid; ?>" id="pl_requestid" />
		<input type="submit"  value="Direct API" style="background-color:#39b54a; text-decoration:bold;" />
				  </form></span></td>
           <td valign="top" bgcolor="#F0F0F0"><span class="style2"></span></td>
        <td valign="top" bgcolor="#F0F0F0"><span class="style21"></span></td>
  </tr>
  <? }
  }?>
        <?php 
        if($_SESSION['leadidentifier'] == "CallerAccountDialingBCH" || $_SESSION['leadidentifier'] =="CallerAccountDialingDMP"){
        ?>
   <tr>
        <td><span class="style2">Gone to Bank: </span></td>
        <td><span class="style21">ICICI</span></td>
        <td></td>
        <td></td>
     </tr>
        <?php }?>
  <?php if($_SESSION['leadidentifier'] == "CallerAccountICICI" || $_SESSION['leadidentifier'] =="CallerAccountOICICI" || $_SESSION['leadidentifier']=="CallerAccountTata" || $_SESSION['leadidentifier']=="CallerAccountBTata" || $_SESSION['leadidentifier']=="CallerAccountHTata"  || $_SESSION['leadidentifier']=="CallerAccountMICICI" || $_SESSION['leadidentifier']=="CallerAccountCICICI" || $_SESSION['leadidentifier']=="CallerAccountMTata" || $_SESSION['leadidentifier']=="CallerAccountCTata"  || $_SESSION['leadidentifier']=="CallerAccountPTata" || $_SESSION['leadidentifier']=="CallerAccountPICICI" || $_SESSION['leadidentifier']=="CallerAccountABFL" || $_SESSION['leadidentifier']=="CallerAccountAPKTata" || $_SESSION['leadidentifier']=="PL_ICICI_BCDHKMP" || $_SESSION['leadidentifier']=="tatacapitalBcalling") { ?>
<tr><td colspan="4">
<form action="" method="post" name="frm">
<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $requestid;?>" />
<table width="100%" cellspacing="2" cellpadding="5" align="center" border="0">
      <tr>
        <td valign="top"  colspan="4"><span class="style2">Last 3 Months Salary: </span></td>
  </tr>
    <tr>
        <td valign="top" bgcolor="#F0F0F0"><span class="style2"><?php echo date('F', strtotime('-1 month'))." Month Salary";?>: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><input type="text" name="SalaryArr[]" value="<?php echo $firstMonth; ?>" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
    
        <td valign="top" bgcolor="#F0F0F0"><span class="style2"><?php echo date('F', strtotime('-2 month'))." Month Salary";?>: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><input type="text" name="SalaryArr[]" value="<?php echo $secondMonth; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
  </tr>
      <tr>
        <td valign="top" ><span class="style2"><?php echo date('F', strtotime('-3 month'))." Month Salary";?>: </span></td>
        <td valign="top"  colspan="3"><input type="text" name="SalaryArr[]" value="<?php echo $thirdMonth; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
     </tr>
  <tr>
        <td valign="top" bgcolor="#F0F0F0" colspan="4"><span class="style2">Obligations: </span></td>
  </tr>
    <tr>
        <td valign="top" ><span class="style2">Total Unsecured EMI: </span></td>
        <td valign="top"><input type="text" name="unsecured_emi" value="<?php echo $unsecured_emi; ?>" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
    
        <td valign="top" ><span class="style2">Total Card Outstanding: </span></td>
        <td valign="top" ><input type="text" name="card_outstanding" value="<?php echo $card_outstanding; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
  </tr>  
   <tr>
        <td valign="top" bgcolor="#F0F0F0" ><span class="style2">Total Secured EMI: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><input type="text" name="secured_emi" value="<?php echo $secured_emi; ?>" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="intOnly(this);" /></td>
    
      <td valign="top" bgcolor="#F0F0F0" ><span class="style2">CIBIL Reference ID: </span></td>
        <td valign="top" bgcolor="#F0F0F0"><input type="text" name="cibil_reference_id" value="<?php echo $cibil_reference_id; ?>" /></td>
       <tr>
           <td valign="top" bgcolor="#F0F0F0" colspan="4" align="middle"><div style="float:left; margin-left: 295px;"><input type="submit" name="submit_p" value="Submit" style="margin-bottom: 3px;    padding: 5px 10px;    background-color: #289dcc;    border: 0px;    transition: background-color 0.3s linear 0s;    -webkit-border-radius: 3px;    -moz-border-radius: 3px;    border-radius: 3px;    font-size: 16px;    -moz-appearance: none !important;    -webkit-appearance: none !important;    appearance: none !important;    cursor: pointer;    display: inline-block;    color: #FFFFFF;" /></div><div style="float: right !important;">
                   <?php
                   if($plrow['Net_Salary']>='240000' and $plrow['Net_Salary']<='300000' and ($plrow['City']=='Delhi' || $plrow['City']=='Bangalore' || $plrow['City']=='Chennai')){
                   ?>
                   <input type="submit" name="SendtoQbera" value="Send to Qbera" style="margin-bottom: 3px;  background-color: #289dcc;  border: 0px; border-radius:3px; color: #FFFFFF; padding:5px 10px;" />
                   <input type="hidden" name="qberaCity" value="<?php echo $plrow['City'];?>" />
                       <?php } ?>&nbsp;&nbsp;&nbsp;
                   
                   
                   <input type="submit" name="SendtoIIFL" value="Send to IIFL" style="margin-bottom: 3px;  background-color: #289dcc;  border: 0px; border-radius:3px; color: #FFFFFF; padding:5px 10px;" /><br />
                   <?php 
                   if($_REQUEST['qbera']=='sendqbera')
                   {
                   ?>
                   <span style="color:#4caf50">This request send to Qbera</span>
                  <?php } ?>
                       
                       <?php 
                   if($_REQUEST['iifl']=='send')
                   {
                   ?>
                   <span style="color:#4caf50">This request send to IIFL</span>
                  <?php } ?>
            </div></td>
  </tr>  
 <?php
 if($averageSalary>0)
 {
 ?>
    <tr>
        <td valign="top" colspan="2" ><span class="style2">Average Salary: </span>&nbsp;Rs. <?php echo $averageSalary; ?></td>
        <td valign="top" colspan="2"><span class="style2">Total Unsecured Obligation: </span>&nbsp;Rs. <?php echo $total_unsecured_obligation; ?> (<?php echo $unsecuredFOIR; ?>%)</td>     
  </tr>  
<tr>
   <td valign="top" colspan="2" ><span class="style2">Total Obligation: </span>&nbsp;Rs. <?php echo $total_obligation; ?>(<?php echo $totalFOIR; ?>%)</td>
    <td align="right" colspan="2"><span class="style2">Standard EMI Rs. 2757 (14.5%,1 Lac, 4 Years)</span></td></tr>
<tr>    
    <td valign="top" colspan="4" ><span class="style2">Eligible Loan Amount: </span>&nbsp;Rs. <?php echo $eligible_loan_amount; ?></td>
  </tr>  
  <?php } ?>
</table></form></td></tr>
  <tr><td></td></tr>
 <?php } ?> 
  <tr><td colspan="4">
  <?php
  $yesterdayDate = date('Y-m-d',strtotime("+1 days"))." ".date('H:i:s');
	$getsmspl="select Mobile_no,Bank_Name from zexternal_campaign_smscontact Where (Sms_Flag=1 and Reply_Type=1 and BidderID='".$Final_Bidder."'and City_Wise like '%".$City."%') order by Compaign_ID ASC LIMIT 0,1";   
	$getsmsplresult = d4l_ExecQuery($getsmspl);
	$getCheckNum = d4l_mysql_num_rows($getsmsplresult);
	$plsmsld= d4l_mysql_fetch_array($getsmsplresult);
    ?> 
        <form method="POST" action="/edit-personal-details-continue.php" name="sendform">
				<input type="hidden" name="callerid" id="callerid" value="<? echo $bidderid;?>" />
				<input type="hidden" name="reqcity" id="reqcity" value="<? echo $plrow["City"];?>" />
                <input type="hidden" name="Final_Bidder" id="Final_Bidder" value="<? echo $Final_Bidder;?>" />
				<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $requestid;?>" />
				<input type='hidden' value='<?php echo $plsmsld["Mobile_no"]; ?>' name='Bidder_Number' id='Bidder_Number' />
				<input type="hidden" name="Reply_Type" id="Reply_Type" value="<? echo $Reply_Type; ?>" />         
         <table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:#333 0px solid;" >
        <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
        <tr>
          <td colspan="4">
          <table width="100%" cellspacing="3" cellpadding="4" style="border:#00F dashed 2px;">
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Remarks</strong></td><td width="25%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="21%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><textarea rows="2" cols="55" name="special_remarks" id="special_remarks_3" onchange="NosplcharComment(this);"></textarea></td>
          <td bgcolor="#FFFFFF" valign="top"><input type="text" name="appointment_date" id="appointment_date" maxlength="25" value="<?php echo $yesterdayDate; ?>" size="15" /><a href="javascript:NewCal('appointment_date','yyyymmdd',true,24)"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Pick a date" /></a></td>
          <td bgcolor="#FFFFFF" valign="top"><select name="appointment_time" id="appointment_time"  class="inputsms" style="width:170px;">
		    <option value="please select">Time slab</option>
		    <option value="8(am)-9(am)">8(am)-9(am)</option>
		    <option value="9(am)-10(am)">9(am)-10(am)</option>
		    <option value="10(am)-11(am)">10(am)-11(am)</option>
		    <option value="11(am)-12(am)">11(am)-12(am)</option>
		    <option value="12(am)-1(pm)">12(am)-1(pm)</option>
		    <option value="1(pm)-2(pm)">1(pm)-2(pm)</option> 
		    <option value="2(pm)-3(pm)">2(pm)-3(pm)</option>
		    <option value="3(pm)-4(pm)">3(pm)-4(pm)</option>
		    <option value="4(pm)-5(pm)">4(pm)-5(pm)</option>
		    <option value="5(pm)-6(pm)">5(pm)-6(pm)</option>
		    <option value="6(pm)-7(pm)">6(pm)-7(pm)</option>
		    <option value="7(pm)-8(pm)">7(pm)-8(pm)</option>
	    </select></td>
        </tr>
         <tr><td colspan="1" ><b>Address -  </b></td><td colspan="3" ><textarea rows="2" cols="55" name="Address" id="Address" onchange="NosplcharComment(this);"></textarea></td></tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents List -  </b></td></tr>
<tr>
	<td width="24%" class="fontstyle"><b>ID Proof</b></td>
	<td width="30%" class="fontstyle">   
    <select name="IDProof" id="IDProof">
    	<option value="">Please Select</option>
		<option value="Passport" <?php if(trim($identification_proof)=="Passport") {echo "Selected";} ?> >Passport</option>
		<option value="PanCard" <?php if(trim($identification_proof)=="PanCard") {echo "Selected";} ?>>Pan Card</option>
		<option value="VoterID Card" <?php if(trim($identification_proof)=="VoterID Card") {echo "Selected";} ?>>Voter ID Card</option>
		<option value="ElectionID Card" <?php if(trim($identification_proof)=="ElectionID Card") {echo "Selected";} ?>>Election ID Card</option>
        <option value="Aadhar card" <?php if(trim($identification_proof)=="Aadhar card") {echo "Selected";} ?>>Aadhar card</option>
        		<option value="Driving License" <?php if(trim($identification_proof)=="Driving License") {echo "Selected";} ?> >Driving License</option>
                		<option value="Govt ID Card" <?php if(trim($identification_proof)=="Govt ID Card") {echo "Selected";} ?> >Govt ID Card (Govt Emp)</option>

	</select>
	</td>
	<td class="fontstyle"><b>Address proof</b></td>
	<td class="fontstyle"><select name="AddressProof" id="AddressProof">
    <option value="">Please Select</option>
		<option value="Passport" <?php if(trim($residence_proof)=="Passport") {echo "Selected";} ?>>Passport</option>
		<option value="Bank Statement" <?php if(trim($residence_proof)=="Bank Statement") {echo "Selected";} ?>>Bank Statement</option>
		<option value="Utility Bill" <?php if(trim($residence_proof)=="Utility Bill") {echo "Selected";} ?>>Utility Bill</option>
		<option value="Gas Receipt" <?php if(trim($residence_proof)=="Gas Receipt") {echo "Selected";} ?>>Gas Receipt</option>
		<option value="Rent Agreement" <?php if(trim($residence_proof)=="Rent Agreement") {echo "Selected";} ?>>Rent Agreement</option>
        <option value="Aadhar card" <?php if(trim($residence_proof)=="Aadhar card") {echo "Selected";} ?>>Aadhar card</option>
        <option value="Govt ID Card" <?php if(trim($residence_proof)=="Govt ID Card") {echo "Selected";} ?> >Govt ID Card (Govt Emp)</option>
  		<option value="Phone Bill" <?php if(trim($residence_proof)=="Phone Bill") {echo "Selected";} ?>>Phone Bill</option>
		<option value="Driving License" <?php if(trim($residence_proof)=="Driving License") {echo "Selected";} ?> >Driving License</option>
	</select></td>
</tr>
<tr>
	<td class="fontstyle"><b>PAN Card</b></td>
	<td class="fontstyle">    
    <input type="radio" name="PanCard" id="PanCard" value="PANCard" <?php if((strlen(strpos($income_proof, "PANCard")) > 0)) echo "checked"; ?> /> Yes &nbsp;&nbsp;<input type="radio" name="PanCard" id="PanCard2" value="" />No    
	</td>
	<td class="fontstyle"><b>3 Month Sal Slip</b></td>
	<td class="fontstyle">
     <input type="radio" name="SalSlip" id="SalSlip" value="3 Month SalSlip" <?php if((strlen(strpos($income_proof, "3 Month SalSlip")) > 0)) echo "checked"; ?> /> Yes &nbsp;&nbsp;<input type="radio" name="SalSlip" id="SalSlip2" value="" />No
   </td>
</tr>
<tr>
	<td class="fontstyle"><b>3 Month Bank Statement</b></td>
	<td>
    <input type="radio" name="BankStmnt" id="BankStmnt" value="3 Month Bank Statement" <?php if((strlen(strpos($income_proof, "3 Month Bank Statement")) > 0)) echo "checked"; ?> /> Yes &nbsp;&nbsp;<input type="radio" name="BankStmnt" id="BankStmnt2" value="" />No    
	</td>
	<td class="fontstyle"><b>1 Passport Size Photo</b></td>
	<td class="fontstyle">
      <input type="radio" name="PassSizePhoto" id="PassSizePhoto" value="1 Passport Size Photo" <?php if((strlen(strpos($income_proof, "1 Passport Size Photo")) > 0)) echo "checked"; ?> /> Yes &nbsp;&nbsp;<input type="radio" name="PassSizePhoto" id="PassSizePhoto2" value="" />No
    </td>
</tr>    
         <tr><td colspan="3" align="left" class="fontstyle"><input type="checkbox" value="1" name="reschedule" id="reschedule" /> Re-Schedule</td>
           <?php 
          
           if($_SESSION['leadidentifier'] == "CallerAccountDialingBCH" || $_SESSION['leadidentifier'] =="CallerAccountDialingDMP"){
           ?>
           <td align="left" class="fontstyle"><select name="BankId">
                    <option value="">Select Bank</option>
                    <option value="27">ICICI</option>
                    <option value="39">TATA Capital</option>
                    <option value="84">IIFL</option>
                    <option value="51">IndusInd</option>
                    <option value="68">RBL</option>
                    <option value="71">CFL</option>
               </select></td>
           <?php }?>
           <td align="right"><input type="submit" name="submit_appdt" value="Save" style="background-color:#036; color:#fff; font-size:17px;" /></td></tr> 
       </table></td></tr>
        <tr>
          <td colspan="4">
          <table width="100%" style="border:#00F groove 1px;">
          <tr>
          <td colspan="4">
       <?php
	    $getApptDetailsSql = "select * from zexternal_appointment_docs where RequestID='".$requestid."' and caller_id='".$_SESSION['BidderID']."' order by id asc";
		$getApptDetailsQry = d4l_ExecQuery($getApptDetailsSql);
		$getApptDetailsresCount =d4l_mysql_num_rows($getApptDetailsQry);
		$DocsArr = '';
		if($getApptDetailsresCount>0)
		{
		$DocsArr = '';
		$DocsArrStatus = '';
		$j=0;		
		while($rowApptDetails = d4l_mysql_fetch_object($getApptDetailsQry))			
	   	{			
			$DocsArr = '';
			$DocsArrStatus = '';			
			if(strlen($rowApptDetails->IDProof)>0) { $DocsArr[] =$rowApptDetails->IDProof; }
			if(strlen($rowApptDetails->AddressProof)>0) { $DocsArr[] =$rowApptDetails->AddressProof; }
			if(strlen($rowApptDetails->PanCard)>0) { $DocsArr[] =$rowApptDetails->PanCard; }
			if(strlen($rowApptDetails->SalSlip)>0) { $DocsArr[] =$rowApptDetails->SalSlip; }
			if(strlen($rowApptDetails->BankStmnt)>0) { $DocsArr[] =$rowApptDetails->BankStmnt; }
			if(strlen($rowApptDetails->PassSizePhoto)>0) { $DocsArr[] =$rowApptDetails->PassSizePhoto; }
			
			if($rowApptDetails->IDProof_Status==1) { $DocsArrStatus[] =$rowApptDetails->IDProof; }
			if($rowApptDetails->AddressProof_Status==1) { $DocsArrStatus[] =$rowApptDetails->AddressProof; }
			if($rowApptDetails->PanCard_Status==1) { $DocsArrStatus[] =$rowApptDetails->PanCard; }
			if($rowApptDetails->SalSlip_Status==1) { $DocsArrStatus[] =$rowApptDetails->SalSlip; }
			if($rowApptDetails->BankStmnt_Status==1) { $DocsArrStatus[] =$rowApptDetails->BankStmnt; }
			if($rowApptDetails->PassSizePhoto_Status==1) { $DocsArrStatus[] =$rowApptDetails->PassSizePhoto; }
			
			$getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='".$rowApptDetails->docpickerid."'";
			$getFEDetailsQry = d4l_ExecQuery($getFEDetailsSql);
			$FE_Name = d4l_mysql_result($getFEDetailsQry,0,'FE_Name');
			$FE_Mobile = d4l_mysql_result($getFEDetailsQry,0,'FE_Mobile');			
	   ?>
     <table width="100%" cellspacing="4" cellpadding="2" style="border:#000 1px solid;" >
<tr>  <td bgcolor="#003399" colspan="2" align="left"><strong style="color:#FFF;"><?php if($j==0) { echo "Appointment - "; } else { echo "Re-scheduled on ".$rowApptDetails->updated_date ; } ?>
</strong></td><td colspan="2" align="right" bgcolor="#003399"><?php if($rowApptDetails->viewstatus==1) {?><a href="edit-appointment.php?id=<?php echo $rowApptDetails->id; ?>" target="_blank" style="color:#FFF; font-weight:bold;">EDIT</a> <?php } ?></td></tr>
        <tr>  <td bgcolor="#DAEAF9" colspan="2"><strong>Remarks</strong></td><td width="27%" bgcolor="#DAEAF9"><strong>Select Date</strong></td><td width="15%" bgcolor="#DAEAF9"><strong>Select Time Slab</strong></td></tr>
        <tr>  <td bgcolor="#FFFFFF" colspan="2"><?php echo $rowApptDetails->special_remarks; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_date; ?></td>
          <td bgcolor="#FFFFFF" valign="top"><?php echo $rowApptDetails->appt_time; ?></td>
        </tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Address - </b><?php echo $rowApptDetails->Address; ?></td></tr>
         <tr><td colspan="4" bgcolor="#DAEAF9"  ><b>Documents - <?php echo implode(' , ', $DocsArr); ?> </b></td></tr>
         <tr><td colspan="4" >&nbsp;</td></tr>
         <?php if($rowApptDetails->docpickerid>0) { ?><tr><td colspan="4" bgcolor="#DAEAF9" ><b>
			 Field Executive Status</b> [Assigned to - <?php echo $FE_Name; ?> (<?php echo $FE_Mobile; ?>)]</td></tr>
         <tr><td colspan="4" ><b>Documents Picked -</b> <?php echo implode(' , ', $DocsArrStatus); ?><br />
         <b>Feedback - </b> <?php if($rowApptDetails->docStatus==1){ echo "Complete";}  
		 					  else if($rowApptDetails->docStatus==2){ echo "Incomplete Pick-up";}
							  else if($rowApptDetails->docStatus==3){ echo "Sent For Login";}
							  else if($rowApptDetails->docStatus==4){ echo "Return To Sales";}
							  else if($rowApptDetails->docStatus==5){ echo "Logged In";}	
								?><br />         
         <b>Remarks - </b> <?php echo $rowApptDetails->doc_pickup_remark;?>
         </td></tr>
        
             <?php } ?>      
          <tr><td colspan="4" style="background:#9C6;" ><b>Spoc Remark -</b><?php echo $rowApptDetails->assigned_remark; ?></td></tr>
          </table>
     <?php 
	 $j=$j+1;
	 } } ?>
    </td></tr>
      </table>       
     </td></tr> 
        </table></form>
      </td></tr>
         <tr><td colspan="4">
   <table width="100%" cellspacing="4" cellpadding="2" style="border:#000 1px solid;" >
         <tr><td colspan="4"><strong>Comments</strong><hr /></td></tr>
 <?php
 $sqlComments = "SELECT * FROM  `client_lead_allocate` where AllRequestID='".$requestid."' and BidderID='".$_SESSION['BidderID']."'";
 $queryComments = d4l_ExecQuery($sqlComments);
 $numRowsComments = d4l_mysql_num_rows($queryComments);
 if($numRowsComments>0)
 {
 ?>
   <tr><td valign="top" ><strong>Last Comment - </strong></td><td colspan="3"><?php echo d4l_mysql_result($queryComments,0,'Comments'); ?></td></tr>
  <?php } ?>
 <?php
  $sql_Comments = "SELECT * FROM  `client_lead_allocated_comment` where RequestID='".$requestid."' and BidderID='".$_SESSION['BidderID']."' ORDER BY  `client_lead_allocated_comment`.`id` DESC ";
 $query_Comments = d4l_ExecQuery($sql_Comments);
 $numRows_Comments = d4l_mysql_num_rows($query_Comments);
 if($numRows_Comments>0)
 {

?>
 <?php
	 for($i=1;$i<$numRows_Comments;$i++)
	 {
		 
?>
<tr><td colspan="4"><hr /></td></tr>
  <tr ><td width="25%" ><strong><?php echo d4l_mysql_result($query_Comments,$i,'Dated') ?> </strong></td><td width="75%" colspan="3"><?php echo d4l_mysql_result($query_Comments,$i,'Comments'); ?></td></tr>
  <?php } ?>  
<?php }
//echo "<pre>";
//print_r($_SESSION);
 ?>
  
  </table></td>
         </tr>
     <tr><td colspan="4">
     <form action="editpersonaldetailspl_whatsapp.php" name="whatsapp_frm" method="post">
     			<input type="hidden" name="callerid" id="callerid" value="<? echo $bidderid;?>" />
				<input type="hidden" name="plrequestid" id="plrequestid" value="<? echo $requestid;?>" />

   <table width="100%" cellspacing="4" cellpadding="2" style="border:#000 1px solid;" >
         <tr><td colspan="4"><strong>Whatsapp</strong><hr /></td></tr>
         <tr>
         	<td colspan="4">
			 	<textarea name="whatsapp_message" style="width: 479px; height: 70px"></textarea> <input type="submit" name="whatsapp_submit" value="Submit" />         
         	</td>
         </tr>
         
    </table>
    </form>     
</td></tr>

</table>

</body>
</html>