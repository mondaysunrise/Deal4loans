<?php
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
//print_r($_POST);
//print_r($_REQUEST);
//require 'cibil_experian_functions.php';

$insertID = $_REQUEST['insertID'];

$getdetails= "SELECT cibil_score,requestid FROM `experian_initial_details` where id='".$insertID."' ORDER BY `experian_initial_details`.`id` DESC LIMIT 0,1";
list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
$myrowcontr=count($myrow)-1;
$cibil_score= $myrow[$myrowcontr]["cibil_score"];
$requestid= $myrow[$myrowcontr]["requestid"];

$getSQl= "SELECT Name FROM `Req_Credit_Card` where RequestID='".$requestid."'";

list($alreadyExistCC,$myrowCC)=MainselectfuncNew($getSQl,$array = array());
$myrowcontrCC=count($myrowCC)-1;
$firstName= $myrowCC[$myrowcontrCC]["Name"];

	
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link href="https://www.deal4loans.com/css/apply-personal-loans-lp-styles-new2-11-2015.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://www.deal4loans.com/css/pl_apply-tab_styles-new11-2-2015.css" /> 
<link href="https://www.deal4loans.com/css/personal-loans-new-lp-11-2-2015.css" type="text/css" rel="stylesheet" />
<!--<link href="https://www.deal4loans.com/css/bootstrap.min.css" type="text/css" rel="stylesheet" />-->
 <link href="https://www.deal4loans.com/css/jquery-gauge.css" type="text/css" rel="stylesheet">
 <link href="https://www.deal4loans.com/css/credit-score.css" type="text/css" rel="stylesheet" />
        <style>
            .Cibil {
                position: relative;
                width: 20vw;
                height:20vw;
                box-sizing: border-box;
                margin:auto;
            }
			.clearfix{ clear:both;}
			.tp-negative-mo-100{margin-top:-160px;}
			.logo-experion{ float:right; width:30%;}
			.credit-score-experion{ float:right; width:70%;}
			.pd-top35{ margin-top:3.5rem;}
			
        </style>

<title>Check Credit Score</title>
<meta name="keywords" content="Check Credit Score" />
<meta name="description" content="Check Credit Score" />
<link href="https://www.deal4loans.com/css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body class="d4l">
<?php include "middle-menu.php"; ?>
<section>
<div class="container">
<div class="row mr-tp-70">
<div class="col-md-12"><a href="index.php" class="text12" style="color:#0080d6; font-size:14px;">Home</a> &gt;  Credit Score</div>
</div>
</div>
</section>
<div class="clearfix"></div>
<section class="credit-score">
<?php


if($cibil_score>=750)
{
	//
	$source = 'CallerVerifierYesBank';
	$lead_allocation_logic = 158;
	
	$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
	//echo $startprocess."<br><br>";
	$startprocessresult = d4l_ExecQuery($startprocess);
	$recordcount = d4l_mysql_num_rows($startprocessresult);
	$row=d4l_mysql_fetch_array($startprocessresult);
	$total_lead_count = $row["total_lead_count"];
	
	$counterVal = 1;
	$arrcallerqry=d4l_ExecQuery("Select BidderID from Bidders Where (leadidentifier='".$source."' and Status=1) order by BidderID ASC");
	while($rowcal=d4l_mysql_fetch_array($arrcallerqry))
	{
		$arrCallerrID[$counterVal] = $rowcal["BidderID"];
		$counterVal = $counterVal + 1;
	}
	$strBidderID = implode(',', $arrCallerrID);
	//echo "<br>";
	//print_r($arrCallerrID);
	
	$sequenceid=d4l_ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')");
	$seqid = d4l_mysql_fetch_array($sequenceid);
	$last_allocated_to = $seqid["last_allocated_to"];
	 $total_no_agents = $seqid["total_no_agents"];
	//echo "<br>";
	if($total_no_agents>$last_allocated_to)
	{
		$sequence=$last_allocated_to+1;
	}
	else
	{
		$sequence=1;
	}
	
	 $getCheckSQl = "select leadid from lead_allocate where (AllRequestID = '".$requestid."' and BidderID in (".$strBidderID."))";
	
	$getCheckQuery = d4l_ExecQuery($getCheckSQl);
	$getCheckNum = d4l_mysql_num_rows($getCheckQuery);
	if($getCheckNum>0)
	{
		//echo "Greater";
		//Already Existing Lead
	}
	else
	{
		$callerID = $arrCallerrID[$sequence];
		if($requestid>0 && $callerID>1)
		{
			//insert allocation
			$final_allocationciti="INSERT lead_allocate (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$requestid."','".$callerID."','4', Now())";
			$final_allocationcitiresult = d4l_ExecQuery($final_allocationciti);
			$updateqry= "Update lead_allocation_table set last_allocated_to='".$sequence."' , total_lead_count='".$requestid."' Where (Citywise='".$source."' and lead_allocation_logic='".$lead_allocation_logic."')";
			$updateqryresult = d4l_ExecQuery($updateqry);
			
		}
	}
}

if($cibil_score>=750)
{


?>
<div>
<div class="row">
<div class="col-md-12">
<!--<img src="new-images/experian_logo.png" alt="" class="logo-experian" />-->
<hr>
 </div>
</div>
<div class="row">
<div class="col-md-12 text-center">Dear <span><?php echo $firstName; ?></span>.</div>
</div>
<div class="clearfix" style="height:100px;"></div>
<div class="row tp-negative-mo-100">
<div class="col-md-12">
<p class="text-center credit-score-light-text">Thank You for applying at <span>deal4loans.com</span></p>
<p class="text-center credit-score-medium-light-text">Yes Bank representative shall call you back soon.</p>
</div>
</div>

</div>
<?php
} 
else
{
		
?>
<div>
<div class="row">
<div class="col-md-12 text-center customer-headline pd-top35">Dear <span><?php echo $firstName; ?></span>,</div>
<div class="text-center" style="padding-top:20px;"><?php echo "No Credit history  available in the database.<br> ";
			echo "We regret to inform you, your credit card application cannot be processed due to policy norms."; ?></div>
</div>
</div>


<?php
}
?>

</section>

<?php include("footer_sub_menu.php"); ?>
</body>
</html>