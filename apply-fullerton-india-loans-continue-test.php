<?php
session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligible_fulbidderstest.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$Name = $_POST["Name"];
		$day = $_POST["day"];
		$month = $_POST["month"];
		$year = $_POST["year"];
		$DOB = $year."-".$month."-".$day;
		$Phone = $_POST["Phone"];
		$Email = $_POST["Email"];
		$City = $_POST["City"];
		$Employment_Status = $_POST["Employment_Status"];
		$Company_Name = $_POST["Company_Name"];
		$IncomeAmount = $_POST["IncomeAmount"];
		$Loan_Amount = $_POST["Loan_Amount"];
		$CC_Holder = $_POST["CC_Holder"];
		$LoanAny = $_POST["LoanAny"];
		$EMI_Paid = $_POST["EMI_Paid"];
		$City_Other = $_POST["City_Other"];
		$Card_Vintage = $_POST["Card_Vintage"];
		$Annual_Turnover = $_POST["Annual_Turnover"];
		$IP = getenv("REMOTE_ADDR");
		$source = $_POST["source"];
		$REFERER_URL = $_POST["PostURL"];

		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($year);
		$validMonth = is_numeric($month);
		$validDay = is_numeric($day);
			
if(($validMobile==1) && ($Name!="") && strlen($City)>0)
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From fullerton_exclusivecamp Where ( Mobile_Number not in (9971396361,9811215138,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr = count($myrow)-1;
	$checkNum = $alreadyExist;

	if($alreadyExist>0)
	{
	}
	else
	{	
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$IncomeAmount, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'source'=>$source, 'Card_Vintage'=>$Card_Vintage, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'IsProcessed'=>'1', 'Annual_Turnover'=>$Annual_Turnover, 'EMI_Paid'=>$EMI_Paid, 'Referrer'=>$REFERER_URL, 'Bidderid_Details'=>$Bidderid_Details, 'Allocated'=>$Allocated);
		$ProductValue = Maininsertfunc ('fullerton_exclusivecamp', $dataInsert);
	}
}
if($ProductValue>0)
	{
	if($City=="Others")
	{
		if(strlen($City_Other)>0)
		{
			$strCity=$City_Other;
		}
		else
		{
			$strCity=$City;
		}
	}
	else
	{
		$strCity=$City;
	}

list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("fullerton_exclusivecamp",$ProductValue,$strCity);
$arrFinal_Bid = "";
		while (list ($key,$val) = @each($FinalBidder)) { 
			$arrFinal_Bid[]= $val; 
		}

	if(($strCity=="Mumbai" || $strCity=="Thane" || $strCity=="Navi Mumbai") && $IncomeAmount>=600000 &&  count($arrFinal_Bid)>1)
		{
			$fulbid=array("1015");
			$resultarray = array_diff($arrFinal_Bid, $fulbid);
		}
		else
		{
				$fulbid=array("3558");
			$resultarray = array_diff($arrFinal_Bid, $fulbid);
		}
		
		if(($strCity=="Delhi" || $strCity=="Noida" || $strCity=="Gurgaon" || $strCity=="Faridabad" || $strCity=="Gaziabad" || $strCity=="Greater Noida") && $IncomeAmount>=600000 &&  count($arrFinal_Bid)>1)
		{
			$fulbid=array("1000");
			$resultarray = array_diff($arrFinal_Bid, $fulbid);
			//print_r($resultarray);
		}
		else
		{
			$fulbid=array("3574");
			$resultarray = array_diff($arrFinal_Bid, $fulbid);
		}
	$shownToBidders_Str = implode(",",$resultarray);
	if(strlen($shownToBidders_Str)>2)
		{
		$dataUpdate = array('Set Allocated'=>'1', 'Bidderid_Details'=>$shownToBidders_Str);
		$wherecondition = "(RequestID='".$ProductValue."')";
		Mainupdatefunc ('fullerton_exclusivecamp', $dataUpdate, $wherecondition);
		}
for($r=0;$r<=count($resultarray);$r++)
		{
	echo $resultarray[$r];
	if($resultarray[$r]>0)
			{
echo $smscamp="Select Mobile_no From Req_Compaign Where (Sms_Flag=1 and BidderID=".$resultarray[$r].")";
list($smscampRows,$myrow)=MainselectfuncNew($smscamp,$array = array());
$myrowcontr = count($myrow)-1;
echo "<br><br>";
$strmobile_no = $myrow[$myrowcontr]["Mobile_no"];
$currentdate=date('d-m-Y');
$message ="Your Personal loan Leads on (".$currentdate.") : ";
$SMSMessage=$SMSMessage."(".$r.") ".$Name."-".$Phone.",Sal- ".$IncomeAmount.",Co- ".$Company_Name.",Acc- mailer";
echo $message.$SMSMessage;
echo "<br><br>";
if(strlen(trim($strmobile_no)) > 0)
			{
			 //SendSMSforLMS($message.$SMSMessage, $strmobile_no);
			}
	}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Get Personal Loan Upto 20 lac - Fullerton</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/fullerton-landing-page-styles.css" type="text/css" rel="stylesheet" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<div class="tplining"></div>
<div class="header-main">
<div class="header-in">
<div class="logo"><img src="images/fullertonindia-logo-mailer.jpg" width="127" height="38"></div>
</div>
</div>
<div class="second_wrapper">
<div style="height:200px; color: #CD5A13;
    font-family: Tahoma,Geneva,sans-serif;
    font-size: 30px;
    font-weight: normal;
    margin: 0;
    padding:10px; text-align:center;">
Thank you for Applying for Fullerton Through deal4loans.com
</div>

<div style="clear:both;"></div>
<div class="powered-text">Powered by: <span style="color:#0772b2;">Deal4loans.com</span></div>
</div>
<div style="clear:both;"></div>
<div class="bottom"></div>
</body>
</html>