<?php
//ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	session_start();

$IP_Remote = getenv("REMOTE_ADDR");
if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
else { $IP=$IP_Remote;	}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			
		$finalurl= FixString($_POST["PostURL"]);
		$Name = FixString($_POST["Name"]);
		$Age= FixString($_POST["Age"]);
		$Loan_Amount= FixString($_REQUEST["Loan_Amount"]);
		$Phone = FixString($_REQUEST["Phone"]);
		$Employment_Status = FixString($_REQUEST["Employment_Status"]);
		$Email = FixString($_REQUEST["Email"]);
		$Company_Name = FixString($_REQUEST["Company_Name"]);
		$City = FixString($_REQUEST["City"]);
		$City_Other = FixString($_REQUEST["City_Other"]);
		$Net_Salary = FixString($_REQUEST['IncomeAmount']);
		$Annual_Turnover = FixString($_REQUEST["Annual_Turnover"]);
		$Total_Experience = FixString($_REQUEST["Total_Experience"]);
		$source = FixString($_REQUEST["source"]);
		$IP=  $IP;
		$monthsalary = trim($Net_Salary/12);
	$Dated = ExactServerdate();
	 $getcompany='select * from pl_company_list where ((company_name="'.$Company_Name.'"))';
	list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
	$growcntr =count($grow)-1;
	$tatacapitalcomp = $grow[$growcntr]["tatacapital"];

	if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1)
		{
			$validname=0;
		}
		else
				{
			$validname=1;
				}
	$validMobile = is_numeric($Phone);
	


if(($validMobile==1) && ($Name!="") && strlen($City)>0 && $validname==1)
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select tatacapitalid From `tatacapital_plmailer_leads` Where ( `tatacapital_mobile_number` not in (9971396361,9811215138,9999047207,9891118553,9999570210) and `tatacapital_mobile_number`='".$Phone."' and `tatacapital_dated` between '".$days30datetime."' and '".$currentdatetime."') order by tatacapitalid ASC";
		list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr = count($myrow)-1;
	$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
//				$ProductValue = $myrow[$myrowcontr]["RequestID"];
}
	else
	{
		$Dated = ExactServerdate();
		$dataInsert = array('tatacapital_name'=>$Name, 'tatacapital_email'=>$Email, 'tatacapital_mobile_number'=>$Phone, 'tatacapital_age'=>$Age, 'tatacapital_city'=>$City, 'tatacapital_other_city'=>$City_Other, 'tatacapital_employment_status'=>$Employment_Status, 'tatacapital_net_Salary'=>$Net_Salary, 'tatacapital_annual_turnover'=>$Annual_Turnover, 'tatacapital_total_experience'=>$Total_Experience, 'tatacapital_loan_amount'=>$Loan_Amount, 'tatacapital_company_name'=>$Company_Name, 'tatacapital_source'=>$source, 'tatacapital_ip'=>$IP, 'tatacapital_dated'=>$Dated);
		
		$ProductValue = Maininsertfunc ('tatacapital_plmailer_leads', $dataInsert);
	}
}
}
if($City=="Others" && strlen($City_Other)>0)
		{
			$strCity = $City_Other;
		}
		else
		{
			$strCity=$City;
		}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tata Capital Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="css/apply-personal-loans-lp-styles-new2-11-2015.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/pl_apply-tab_styles-new11-2-2015.css">
<link href="css/tata-capital-main-styles.css" type="text/css" rel="stylesheet" />
<style type="text/css">
td,th{ border:#CCC solid thin;}
</style>
</head>
<body>
<div class="header-newpl-main">
<div class="header-newpl-main-b">
<div class="logo-new1d4l"><img src="images/tata-capital-logo.jpg" width="202" height="75" alt="Tata Capital Logo"></div>
<div class="top-right-boxbank"><div style="border-bottom:#67afd4 solid thin; padding-bottom:3px;">Fulfill your needs today. Pay as you grow.</div>
<div style="font-size:18px;">Tata Capital Flexi EMI Personal Loans </div>
</div>
<div style="clear:both;"></div>
</div>
</div>
</div>
<div class="apl_second_container" style="padding-top:20px; padding-bottom:20px;font-family: Arial, Helvetica, sans-serif; font-size:12px; color:#333; text-align:left; height:400px;">
 <div style="font-family:Arial, Helvetica, sans-serif; font-size:18px; color:#2C6EB5; ">Dear <? echo $Name; ?>, Thank you for applying @deal4loans.com, Your loan application is successful. <br>
You shall soon receive a call from the Tata capital representative.  </div>
<br><br>
  <? 
  if($Employment_Status==1 && (($Net_Salary>=360000 && $tatacapitalcomp!='') || ($Net_Salary>=600000 && $tatacapitalcomp=='')) && $Age>=21 && $Loan_Amount >=75000 && $Loan_Amount<=1500000 && $Total_Experience>=2 && ($strCity=="Delhi" || $strCity=="Noida" || $strCity=="Gurgaon" || $strCity=="Gaziabad" || $strCity=="Faridabad" || $strCity=="Mumbai" || $strCity=="Thane" || $strCity=="Navi Mumbai" || $strCity=="Bangalore"))
  {
	  //echo "entered";
	  if($ProductValue>0)
	  {
	  $dataUpdate = array('tatacapital_sent'=>1);
	  $wherecondition = "(tatacapitalid =".$ProductValue.")";
	  Mainupdatefunc ('tatacapital_plmailer_leads', $dataUpdate, $wherecondition);
	  //send sms
	  if($strCity=="Bangalore")
		  {
			$bidderID=5237;
		  }
		  elseif($strCity=="Mumbai" || $strCity=="Thane" || $strCity=="Navi Mumbai")
		  {
			  $bidderID=5247;
		  }
		  else
		  {
			  $bidderID=5242;
		  }

	  $getCityDetailsSql = "select Mobile_no from Req_Compaign where (Sms_Flag=1 and BidderID=".$bidderID.")";
		list($alreadyExist,$numgetCity)=MainselectfuncNew($getCityDetailsSql,$array = array());
	
	for($i=0;$i<$alreadyExist;$i++)
		  {
				$Mobile_no[] = $numgetCity[$i]["Mobile_no"];
		  }
	  if(strlen($Mobile_no[0])>2)
				{
		$currentdate=date('d-m-Y');
		$message ="Your Personal loan Leads on (".$currentdate.") : ";
		$SMSMessage=$SMSMessage."(1) ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name;
		
		if(count($Mobile_no)>1 && strlen($Mobile_no[1])>2)
				{
			for($bfs=0; $bfs<count($Mobile_no);$bfs++)
					{
						$strmobile_no = $Mobile_no[$bfs];
						//$strmobile_no="9811215138";
						SendSMSforLMS($message.$SMSMessage, $strmobile_no);
					}
				}
				else
					{
						$strmobile_no = $Mobile_no[0];
						//$strmobile_no="9811215138";
						SendSMSforLMS($message.$SMSMessage, $strmobile_no);
					}
						}
			}
		//////////////////////
	
  list($tcinterestrate,$tcgetloanamout,$tcgetemicalc,$tcterm,$tcProcessing_Fee)= tatacapital($monthsalary,$Company_Name,$tatacapitalcomp,$Age,$Company_Type,$Primary_Acc); ?>
<table  cellpadding="5" cellspacing="0" align="center" width="100%"  border="0">
<tr>
<th width="18%" align="center" valign="middle" bgcolor="#BEC51C"  style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;">Bank Name</th>
    <th width="11%" align="center" valign="middle" bgcolor="#BEC51C"  style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;">Interest Rate</th>
    <th width="13%" align="center" valign="middle" bgcolor="#BEC51C"  style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;">Emi <br>(per Month)</th>
    <th width="6%" align="center" valign="middle" bgcolor="#BEC51C"  style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;">Tenure</th>
    <th width="18%" align="center" valign="middle" bgcolor="#BEC51C" style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;">Eligible Loan<br /> 
      Amount</th>
       <th width="15%" align="center" valign="middle" bgcolor="#BEC51C" style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;">Processing Fee</th>
      <th width="19%" align="center" valign="middle" bgcolor="#BEC51C" style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;">Pre-Payment charges</th>
	    </tr>
  <tr>
  <td style="color:#000000;">&nbsp;&nbsp;<img src="new-images/tatacapital_pllogo.jpg" width="146" height="67"></td>
		<td align="center"  style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;"><? echo $tcinterestrate; ?></td>
		<td align="center" style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;">Rs.<? echo $tcgetemicalc; ?></td>
		<td align="center" style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;"><? echo $tcterm; ?> yrs.</td>
		<td align="center" style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;">Rs. <? echo $tcgetloanamout;  ?></td>
		<td align="center" style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;"> <? echo $tcProcessing_Fee; ?></td>
		<td align="center" style="font-family: Arial, Helvetica, sans-serif; font-size:14px; color:#333;"> Part Prepayment with ZERO Charges</td>
		</tr>
</table>
<? } ?>

</div>
<div style="clear:both;"></div>
<div class="tata-buttom-wrap">
<div class="tata-buttom-wrapinn">
Terms and conditions apply.<br/>
Personal loans are brought to you by Tata Capital Financial Services Limited ("TCFSL") and are at its sole discretion. TCFSL reserves the right (i) to ask for additional documents at its discretion to process the loan (ii) to withdraw or alter the offer at any time, if it so chooses.
<div style="text-align:right;"><em>Powered by:</em> Deal4loans.com</div>
</div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
 <script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script></body>
</html>