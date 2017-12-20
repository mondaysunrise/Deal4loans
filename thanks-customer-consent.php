<?php
//Perfect
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

//print_r($_POST);
$ProductType = 3;
$Nobanks = $_REQUEST["noreqd_banks"];
$RequestID = $_REQUEST["request_id"];
//$strNobanks= implode(",",$Nobanks);
$today = date("Y-m-d H");
$backTime = date("i")-15;
$finalToday = $today.":".$backTime.":00";

$definetypw="select BankID from Bidders_List Where (BidderID=".$Nobanks.")";
list($defrowCount,$defrow)=MainselectfuncNew($definetypw,$array = array());
$BankID = $defrow[0]['BankID'];
$getBankSql = "select Bank_Name from Bank_Master where BankID= '".$BankID."'";
list($getBankrowCount,$getBankrow)=MainselectfuncNew($getBankSql,$array = array());
$Bank_Name = $getBankrow[0]['Bank_Name'];

//(DATE_SUB( NOW() , INTERVAL '00:15' HOUR_MINUTE ) >= Allocation_Date)

$checkSql = "select AllRequestID from Req_Feedback_Bidder_CL1 where (AllRequestID='".$RequestID."' and (DATE_SUB( NOW() , INTERVAL '00:15' HOUR_MINUTE ) >= Allocation_Date) and BidderID='".$Nobanks."')";
list($numCheck,$checkQuery)=MainselectfuncNew($checkSql,$array = array());

if($numCheck>0)
{
	$msg = "The allowed time to deactivate to get call from ".$Bank_Name." has exceeded.";
}
else
{
	if($Nobanks>0)
	{
		//qry to check remove bidder
		//echo "Select AllRequestID from Req_Feedback_Bidder_CL1 where (Consent=0 and AllRequestID='".$RequestID."' and BidderID='".$Nobanks."')"; 
		// echo "<br>";
		$qry_rmbid= "Select AllRequestID from Req_Feedback_Bidder_CL1 where (Consent=0 and AllRequestID='".$RequestID."' and BidderID='".$Nobanks."')";
		//  echo "<br>";
		list($qryrmbidcount,$qry_rmbidQuery)=MainselectfuncNew($qry_rmbid,$array = array());
		if($qryrmbidcount>0)
		{
			$msg = "Your request to deactivate to get call from ".$Bank_Name." has been already taken.";
		}
		else
		{
			$Dated = ExactServerdate();
			$dataUpdate = array('Consent'=>'0', 'Consent_Date'=>$Dated);
			$wherecondition = "(AllRequestID='".$RequestID."' and BidderID='".$Nobanks."')";
			Mainupdatefunc ('Req_Feedback_Bidder_CL1', $dataUpdate, $wherecondition);
			//echo $upconsent."<br>";
			//echo "<br>";
			//change bookkeeping
			$BK_Year = date('Y');
			$BK_Month = date('m');
			$BK_Week = date('W');
			$BK_Day = date('d');
			$ProductType = 3;
			$BookKeepingSql = "select * from Bidders_Book_Keeping where BidderID=".$Nobanks." and BookProduct=".$ProductType." and BookDate=".$BK_Day." and BookMonth=".$BK_Month." and BookYear=".$BK_Year."";
			
				$IncrementLeadCount = $BookLeadCountExisting - 1;
				list($BookKeepingQuerycount,$BookKeepingQuery)=MainselectfuncNew($BookKeepingSql,$array = array());
				$BookLeadCountExisting = @$BookKeepingQuery[0]['BookLeadCount'];
				$BookDate = @$BookKeepingQuery[0]['BookDate'];//added
				$BookMonth = @$BookKeepingQuery[0]['BookMonth'];//added
				$BookYear = @$BookKeepingQuery[0]['BookYear'];//added
			
			//end change bookkeeping
			$msg = "Your request to deactivate to get call from ".$Bank_Name." has been taken.";
			
			}
		// leadallocation($RequestID);
	}
}
//else
//{
	
//}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title>Thank you Car Loan</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India."><link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mootools.js"></script>
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<style type="text/css">
<!--
.red {
	color: #F00;
}
-->
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
color:#000000;
}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="car-loans.php"  class="text12" style="color:#0080d6;"><u>Car Loan</u></a> </div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; ">
  <div align="center">
     <p style="color:#000; font-size:16px;"><b><?php echo $msg; ?></b><br />
      
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
</div>
 </div>
 </div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>