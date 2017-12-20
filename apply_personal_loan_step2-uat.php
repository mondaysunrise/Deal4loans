<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'getlistofeligiblebidders.php';
require 'scripts/personal_loan_eligibility_function_form.php';
require 'show_quotecount.php';
require 'sendcibilcredentialsmail.php';

function DetermineAgeGETDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

$leadid = $_SESSION['leadid'];
//$leadid = 3259098;
$getpldetails="select Employment_Status,Mobile_Number,Email,City_Other,City,Company_Name,Name,Net_Salary,DOB,PL_EMI_Amt, Primary_Acc,identification_proof,Company_Type,Loan_Amount,Primary_Acc,Total_Experience,source,EMI_Paid,Card_Vintage,Residential_Status From Req_Loan_Personal Where (RequestID='".$leadid."')";
list($alreadyExist,$plrow)=MainselectfuncNew($getpldetails,$array = array());
$myrowcontr=count($plrow)-1;
//UATlink
$EMI_Paid = $plrow[$myrowcontr]['EMI_Paid'];
$Card_Vintage = $plrow[$myrowcontr]['Card_Vintage'];
$Residential_Status = $plrow[$myrowcontr]['Residential_Status'];
$source = $plrow[$myrowcontr]['source'];
$getCompany_Name = $plrow[$myrowcontr]['Company_Name'];
$City = $plrow[$myrowcontr]['City'];
$Name = $plrow[$myrowcontr]['Name'];
$DOB = $plrow[$myrowcontr]['DOB'];
$Mobile_Number = $plrow[$myrowcontr]['Mobile_Number'];
$Email = $plrow[$myrowcontr]['Email'];
$PL_EMI_Amt = $plrow[$myrowcontr]['PL_EMI_Amt'];
$Primary_Acc = $plrow[$myrowcontr]['Primary_Acc'];
$Net_Salary = $plrow[$myrowcontr]['Net_Salary'];
$Other_City = $plrow[$myrowcontr]['City_Other'];	
$Company_Type = $plrow[$myrowcontr]['Company_Type'];
$Primary_Acc = $plrow[$myrowcontr]['Primary_Acc'];
$Loan_Amount = $plrow[$myrowcontr]['Loan_Amount'];
$Employment_Status = $plrow[$myrowcontr]['Employment_Status'];		
$Document_proof_doc = $plrow[$myrowcontr]['identification_proof'];
$Total_Experience = $plrow[$myrowcontr]["Total_Experience"];
$Document_proof = explode(",",$Document_proof_doc);
$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
$full_name = $Name;
$monthsalary =$Net_Salary/12;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="cibil/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all" />
<link href="cibil/css/login-dashboard.css?<?php echo time(); ?>" type="text/css" rel="stylesheet" media="all" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
<style>
table {border-collapse:collapse;border-spacing:0;}
#bodyCenter #nwcontainer{width:850px; min-height:437px; padding:29px 10px 10px 10px;}
#bodyCenter #nwcontainer p strong{font:bold 14px Arial, Helvetica, sans-serif; color:#000; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer p{font:normal 12px Arial, Helvetica, sans-serif; color:#5c5e5e; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer #data{clear:both; margin:28px 0 15px 0;}
#bodyCenter #nwcontainer #data table{width:846px; margin:0 auto; position:relative;}
#bodyCenter #nwcontainer #data table tr{}
#bodyCenter #nwcontainer #data table tr th.bank{background:url("/new-images/bank-name.png") no-repeat; width:150px;}
#bodyCenter #nwcontainer #data table tr td{border:2px solid #fff!important; height:80px;}
#bodyCenter #nwcontainer #data table tr td.banks{background:#f1f1f1; width:116px; text-align:center; padding:10px 0 0 0; height:50px; font: 12px Arial, Helvetica, sans-serif;}
#bodyCenter #nwcontainer #data table tr td.i-rate{background:#e7e6e6; text-align:center; font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:149px; }
#bodyCenter #nwcontainer #data table tr td.emi{background:#ececec; text-align:center;font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:161px; padding:0 0 0 5px;}
#bodyCenter #nwcontainer #data table tr td.tenure{text-align:center; font: 14px Arial, Helvetica, sans-serif; color:#706f6f; width:61px; padding:0 0 0 5px; background:url("/new-images/tenure-bg.jpg") repeat-y; text-align:center; }
#bodyCenter #nwcontainer #data table tr td.loan{text-align:left; font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:134px; padding:0 0 0 5px; background:url("/new-images/loan-bg.jpg") repeat-y; text-align:center;}
#bodyCenter #nwcontainer #data table tr td.info{text-align:left; font:14px Arial, Helvetica, sans-serif; color:#bf2228; width:100px; padding:0 0 0 5px; background:url("/new-images/information.jpg") repeat-y; text-align:center;
}
#bodyCenter #nwcontainer #data table tr td.i-pfrate{background:#e7e6e6; text-align:center; font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:100px; }
#bodyCenter #nwcontainer #data table tr td.prepay{background:#ececec; text-align:center;font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:100px; padding:0 0 0 5px;}
th{ font-weight:normal;}
.thanks-cibil .digit_a, .thanks-cibil .digit_b, .thanks-cibil .digit_c, .thanks-cibil .digit_d, .thanks-cibil .digit_e, .thanks-cibil .digit_f{ font-size:12px; color:#000;}
@media screen and (max-width: 768px) {#bodyCenter #nwcontainer{background: #E0F2F3; width:100%; min-height:437px; padding:29px 10px 10px 10px;}
}
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

</head>
<body>
<!--top-->
<!--logo navigation-->
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div class="lac-main-wrapper">
<div class="text12"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:100%;">
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center">
  <div style="width:98%; color:#000000; font-size:16px !important; padding-top: 15px"><strong>Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com</strong></div>
	<?php
	$checkCibilSql = "SELECT productid,cibil_score, cibil_email, cibil_password, id, mail_sent FROM `api_log_cibil` WHERE (productid = '".$leadid."' and product='PL' AND api_from = 'CibilCustomerAssets' and cibil_email!='' and cibil_password!='') ORDER BY `id` DESC LIMIT 0,1";
	$checkCibilResult = d4l_ExecQuery($checkCibilSql);
	$checkCibilArr = d4l_mysql_fetch_array($checkCibilResult);
	$cibilVal = $checkCibilArr['cibil_score'];
	$cibil_email = $checkCibilArr['cibil_email'];
	$cibil_password = $checkCibilArr['cibil_password'];	
	$cibillogid = $checkCibilArr['id'];
	$productid = $checkCibilArr['productid'];
	$cibilogmailsent = $checkCibilArr["mail_sent"];
	if($productid > 0)
	{
		//$cibilVal = 0;
		if(!empty($cibilVal)) {
			if($cibilVal==0)
			{ ?>
				<div class="row">
			<div class="col-md-12">
				<div class="cibil-score-wrapper">
					<div class="row">
						<div class="col-md-10 font-16 text-center pd-tp-8" style="width: 100%;">No Credit history  available in Credit Bureau database</div>
					</div>
				</div>
			</div>
		</div>
		<?php }
		else
			{
			//Send CIBIL Dashboard Login Credentials Email To User
		$detailsArr['email'] = $cibil_email;
		$detailsArr['FULL_NAME'] = $full_name;
		$detailsArr['CUST_CIBIL_SCORE'] = $cibilVal;
		$detailsArr['CUST_EMAIL'] = $cibil_email;
		$detailsArr['CUST_PASSWORD'] = $cibil_password;
		if($cibilogmailsent==0)
			{	
		$updateEmaillogQry = "Update `api_log_cibil` SET mail_sent=1 WHERE id = '".$cibillogid."'";
		d4l_ExecQuery($updateEmaillogQry);
		getCibilReportEmailer($detailsArr);
			}
		?>
		<div class="row thanks-cibil" style="margin-top: -40px;">
			<div class="col-md-12 text-center">
				<div class="range-slider">
					<div class="progress-bar-new">
						<div class="progress-bar progress-bar-danger progress-bar-success progress-red"></div>
						<div class="progress-bar progress-bar-warning progress-orange"></div>
						<div class="progress-bar progress-yellow"></div>
						<div class="progress-bar progress-light-green"></div>
						<div class="progress-bar progress-light-green_b"></div>
						<div class="progress-bar progress-light-green-dark"></div>
					</div>
					<div class="pointer" style="width:25px; margin-top:-26px; height:25px; position:relative; margin-left: -5px;">
						<img src="cibil/images/round-cursor.png">
					</div>
					<div style="float:left; width:10%; color:#000; text-align:left; padding-top:10px; padding-bottom:10px;">300</div>
					<div class="digit_a">400</div>
					<div class="digit_b">500</div>
					<div class="digit_c">600</div>
					<div class="digit_d">700</div>
					<div class="digit_e">800</div>
					<div class="digit_f">900</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="cibil-score-wrapper" style="margin-top: -5px;">
						<div class="row" style="margin-bottom: -5px;">
							<div class="col-md-12 text-center">
								<div class="customer-heading">Your CIBIL Score</div>
								<div class="count-font"><?php echo $cibilVal;?></div>
							</div>
						</div>
						<hr>

						<div class="row">
							<div class="col-md-10 font-16 text-center pd-tp-8"><img src="cibil/images/mail-box-icon.png">Your CIBIL report details has been shared to your register email id</div>
							<div class="col-md-2 img-align"><img src="cibil/images/powered-by-cibil.png"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		}
		else{
		?>

		<div class="row">
				<div class="col-md-12">
					<div class="cibil-score-wrapper">
						<div class="row">
							<div class="col-md-10 font-16 text-center pd-tp-8"  style="width: 100%;">We are unable to fetch your Cibil Score right now.</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
	}
	else
	{ 
		$checkCibilSql = "SELECT id,cibil_id,cibil_score FROM `api_log_cibil` WHERE productid = '".$leadid."' ORDER BY `id` DESC LIMIT 0,1";
		$checkCibilResult = d4l_ExecQuery($checkCibilSql);
		$checkCibilArr = d4l_mysql_fetch_array($checkCibilResult);
		$logid = $checkCibilArr["id"];
		$cibil_id = $checkCibilArr["cibil_id"];
		$cibil_score = $checkCibilArr["cibil_score"];
		if($cibil_score>0)
		{ ?>
		<div class="row thanks-cibil" style="margin-top: -40px;">
			<div class="col-md-12 text-center">
				<div class="range-slider">
					<div class="progress-bar-new">
						<div class="progress-bar progress-bar-danger progress-bar-success progress-red"></div>
						<div class="progress-bar progress-bar-warning progress-orange"></div>
						<div class="progress-bar progress-yellow"></div>
						<div class="progress-bar progress-light-green"></div>
						<div class="progress-bar progress-light-green_b"></div>
						<div class="progress-bar progress-light-green-dark"></div>
					</div>
					<div class="pointer" style="width:25px; margin-top:-26px; height:25px; position:relative; margin-left: -5px;">
						<img src="cibil/images/round-cursor.png">
					</div>
					<div style="float:left; width:10%; color:#000; text-align:left; padding-top:10px; padding-bottom:10px;">300</div>
					<div class="digit_a">400</div>
					<div class="digit_b">500</div>
					<div class="digit_c">600</div>
					<div class="digit_d">700</div>
					<div class="digit_e">800</div>
					<div class="digit_f">900</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="cibil-score-wrapper" style="margin-top: -5px;">
						<div class="row" style="margin-bottom: -5px;">
							<div class="col-md-12 text-center">
								<div class="customer-heading">Your CIBIL Score</div>
								<div class="count-font"><?php echo $cibil_score;?></div>
							</div>
						</div>
						<hr>

						<div class="row">
							<div class="col-md-10 font-16 text-center pd-tp-8"></div>
							<div class="col-md-2 img-align"><img src="cibil/images/powered-by-cibil.png"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<? }
		else
		{
		if(isset($logid) && $logid>0 )
		{ ?>
<div class="row">
				<div class="col-md-12">
					<div class="cibil-score-wrapper">
						<div class="row">
							<div class="col-md-10 font-16 text-center pd-tp-8"  style="width: 100%;">We are unable to fetch your Cibil Score right now.</div>
						</div>
					</div>
				</div>
			</div>
		 <? }
		}
	}
	?>
<?php 
if ($leadid>0)
{
	$getcompany='select * from pl_company_list where company_name="'.$getCompany_Name.'"';
	list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
	$growcontr=count($grow)-1;

	$hdfccategory= $grow[$growcontr]["hdfc_bank"];
	$fullertoncategory= $grow[$growcontr]["fullerton"];
	$citicategory= $grow[$growcontr]["citibank"];
	$stanccategory = $grow[$growcontr]["standard_chartered"];
	$hdbfscategory = $grow[$growcontr]["hdbfs"]; 
	$ingvyasyacategory = $grow[$growcontr]["ingvyasya"]; 
	$bajajfinservcategory = $grow[$growcontr]["bajajfinserv"]; 
	$icici_bankcategory = $grow[$growcontr]["icici_bank"]; 
	$Indusind = $grow[$growcontr]["Indusind"]; 
	$kotakcomp = $grow[$growcontr]["kotak"];
	$tatacapitalcomp = $grow[$growcontr]["tatacapital"];
	$capitalfirstcomp = $grow[$growcontr]["capitalfirst"];
	if($City=="Others")
	{
		if(strlen($Other_City)>0)
		{
			$strCity=$Other_City;
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

	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
		$Final_Bid[]= $val; 
	} 

	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);
	//print_r($Final_Bid);

	if(($City=="Ahmedabad" || $City=="Bangalore" || $City=="Baroda" || $City=="Vadodara" || $City=="Bhopal" || $City=="Bhubaneswar" || $City=="Bhubneshwar" || $City=="Chandigarh" || $City=="Chennai" || $City=="Coimbatore" || $City=="Cuttack" || $City=="Delhi" || $City=="Ghaziabad" || $City=="Gurgaon" || $City=="Noida" || $City=="Faridabad" || $City=="Hyderabad" || $City=="Indore" || $City=="Jaipur" || $City=="Jalandhar" || $City=="Jodhpur" || $City=="Kolkata" || $City=="Lucknow" || $City=="Ludhiana" || $City=="Mumbai" || $City=="Navi Mumbai" || $City=="Thane" || $City=="Nagpur" || $City=="Nasik" || $City=="Pune" || $City=="Surat" || $City=="Udaipur" || $City=="Vijaywada" || $City=="Vishakapatnam" || $City=="Vizag" || $City=="Madurai" || $City=="Ambala" || $City=="Anand")  && $Net_Salary<=360000 && $age>=18)
	{
		$approvedcapitalfirst=1;
	}

	if(count($FinalBidder)>0 || $approvedcapitalfirst==1)
	{
		for($i=0;$i<count($Final_Bid);$i++)
		{
			/*if(((strncmp ("Standard", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Standard Chartered")) && $stanccategory=='' && $Primary_Acc!="Standard Chartered")
			{
			}
			else */
			if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 || ($Final_Bid[$i]=="CitiBank")) && ($citicategory=='' && $Primary_Acc!="Citibank"))
			{
			}
			else if(((strncmp ("HDBFS", $Final_Bid[$i],5))==0 || ($Final_Bid[$i]=="HDBFS")) && ($hdbfscategory==''))
			{
			}
			else if(((strncmp ("IngVysya", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="IngVysya")) && (($ingvyasyacategory=='') && ($Company_Type < 4 )))
			{
			}
			else if(((strncmp ("INDUS", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="INDUS IND bank")) && (($Indusind=='') && $Net_Salary<480000))
			{
			}
			else if(((strncmp ("Bajaj", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="Bajaj Finserv")) && (($bajajfinservcategory=='') && $Net_Salary<480000))
			{
			}
			else if(((strncmp ("Kotak", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="Kotak Bank")) && (($kotakcomp=='') && $Net_Salary<480000))
			{
			}
			else
				{ $shownToBidders_Arr[] = $Final_Bid[$i];
			}
		}
		$Dated = ExactServerdate();	

	
		for($r=0;$r<count($shownToBidders_Arr);$r++)
		{
			//HDFC Bank
			if(($shownToBidders_Arr[$r]=="HDFC Bank") || ($shownToBidders_Arr[$r]=="HDFC") && $Employment_Status==1)
			{
				list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi,$hdfcprocfee)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);
				if($hdfcgetloanamout>0)
				{
					if($hdfcgetloanamout>1000000)
					{$hdfcprepay="NIL";} else { $hdfcprepay="4%";}
					$arrayInsertHDFC = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$hdfcinterestrate, 'pl_bankemi'=>$hdfcgetemicalc, 'pl_banktenure'=>$hdfcterm, 'pl_loanamount'=>$hdfcgetloanamout, 'pl_bankpf'=>$hdfcprocfee, 'pl_bankppc'=>$hdfcprepay, 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertHDFC);
				}
				else
				{
					$arrayInsertHDFC = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertHDFC);
				}
			}
			//ICICI Bank
			elseif(((trim($shownToBidders_Arr[$r])=="ICICI") || (trim($shownToBidders_Arr[$r])=="ICICI Bank")) && $Employment_Status==1)
			{
				list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi,$iciciprocfee)=icicibank($monthsalary,$getCompany_Name,$icici_bankcategory,$age,$Company_Type,$Primary_Acc);
				if($icicigetloanamout>0)
				{
					$icicienter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$iciciinterestrate, 'pl_bankemi'=>$icicigetemicalc, 'pl_banktenure'=>$iciciterm, 'pl_loanamount'=>$icicigetloanamout, 'pl_bankpf'=>$iciciprocfee, 'pl_bankppc'=>'NA', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $icicienter);
				}
				else
				{
					$Dated = ExactServerdate();
					$arrayInsertICICI = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertICICI);
				}
			}
			//Standard Chartered
			elseif((($shownToBidders_Arr[$r]=="Stanc") || ($shownToBidders_Arr[$r]=="Standard Chartered")) && $Employment_Status==1)
			{
				list($stancinterestrate,$stancgetloanamout,$stancgetemicalc,$stancterm,$stancperfee,$stancprocfee)=Stanc($monthsalary,$PL_EMI_Amt,$getCompany_Name,$stanccategory,$age,$Company_Type,$Primary_Acc);
				if($stancgetloanamout>0)
				{
					$icicienter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$stancinterestrate, 'pl_bankemi'=>$stancgetemicalc, 'pl_banktenure'=>$stancterm, 'pl_loanamount'=>$stancgetloanamout, 'pl_bankpf'=>$stancperfee, 'pl_bankppc'=>'0 - 4%', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $icicienter);
				}
				else
				{
					$Dated = ExactServerdate();
					$arrayInsertStanc = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertStanc);
				}
			}
			//CItibank
			elseif((($shownToBidders_Arr[$r]=="Citibank") || ($shownToBidders_Arr[$r]=="CitiBank")) && $Employment_Status==1)
			{
				list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlac,$citiproc_Fee)=citibank($monthsalary,$clubbed_emi,$getCompany_Name,$age,$citicategory);
				if($citigetloanamout>0)
				{
					$citienter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$citiinterestrate, 'pl_bankemi'=>$citigetemicalc, 'pl_banktenure'=>$cititerm, 'pl_loanamount'=>$citigetloanamout, 'pl_bankpf'=>$citiproc_Fee, 'pl_bankppc'=>'1%', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $citienter);
				}
				else
				{
					$citienter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $citienter);
				}
			}
			//INdusInd Bank
			elseif((($shownToBidders_Arr[$r]=="INDUS IND bank") || ($shownToBidders_Arr[$r]=="INDUS IND bank")) && $Employment_Status==1)
			{
				list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi)=@indusindbank($monthsalary,$getCompany_Name,$Indusind,$age,$clubbed_emi,$strCity);
				if($indusindloanamt>0)
				{
					$INdusenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$indusindrate, 'pl_bankemi'=>$indusindemi, 'pl_banktenure'=>$indusindterm, 'pl_loanamount'=>$indusindloanamt, 'pl_bankpf'=>'1% - 2%', 'pl_bankppc'=>'4%', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $INdusenter);
				}
				else
				{
					$INdusenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $INdusenter);
				}
			}
			//Fullerton
			elseif(((strncmp ("Fullerton", $shownToBidders_Arr[$r],9))==0 || ($shownToBidders_Arr[$r]=="Fullerton")) && $Employment_Status==1)
			{
				list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
				if($fullertongetloanamout>0)
				{
					$fullertonprepay="4% before 3yr after 3yr 0%";
					$fullertonprofee="2 - 2.5";
					$fullertonenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$fullertoninterestrate, 'pl_bankemi'=>$fullertongetemicalc, 'pl_banktenure'=>$fullertonterm, 'pl_loanamount'=>$fullertongetloanamout, 'pl_bankpf'=>$fullertonprofee, 'pl_bankppc'=>$fullertonprepay, 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $fullertonenter);
				}
				else
				{
					$arrayInsertFullerton = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertFullerton);
				}
			}
			//Kotak Bank
			elseif($shownToBidders_Arr[$r]=="Kotak" || $shownToBidders_Arr[$r]=="Kotak Bank" && $Employment_Status==1)
			{
				list($kotakrate,$kotakloanamt,$kotakemi,$kotakterm,$kotakperlacemi,$kotakproc_fee)=kotakbank($monthsalary,$getCompany_Name,$kotakcomp,$age,$Company_Type,$Primary_Acc);
				//echo $monthsalary." - ".$getCompany_Name." - ".$kotakcomp." - ".$age." - ".$Company_Type." - ".$Primary_Acc;
				if(strlen($kotakloanamt)>1)
				{	
					if($kotakloanamt>1000000)
					{ $pl_kotakbankppc= "0%";}else {$pl_kotakbankppc="5%";}
					$kotakenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$kotakrate, 'pl_bankemi'=>$kotakemi, 'pl_banktenure'=>$kotakterm, 'pl_loanamount'=>$kotakloanamt, 'pl_bankpf'=>$kotakproc_fee, 'pl_bankppc'=>$pl_kotakbankppc, 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $kotakenter);
				}
				else
				{
					$arrayInsertKotak = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertKotak);
				}
			}
			//HDBFS
			elseif($shownToBidders_Arr[$r]=="HDBFS" && $Employment_Status==1)
			{
				list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans ($hdbfscategory, $monthsalary, $Primary_Acc,$age,$PL_EMI_Amt,$Loan_Amount);
				if($getloanamout>0)
				{
					$hdbfsenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$interestrate, 'pl_bankemi'=>$getemicalc, 'pl_banktenure'=>$term, 'pl_loanamount'=>$getloanamout, 'pl_bankpf'=>$Processing_Fee, 'pl_bankppc'=>$hdbfsprepay, 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $hdbfsenter);
				}
				else
				{
					$hdbfsenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $hdbfsenter);
				}
			}
			//TATA Capital
			elseif($shownToBidders_Arr[$r]=="Tata Capital" && $Employment_Status==1)
			{
				list($tcinterestrate,$tcgetloanamout,$tcgetemicalc,$tcterm,$tcProcessing_Fee)= tatacapital($monthsalary,$getCompany_Name,$tatacapitalcomp,$age,$Company_Type,$Primary_Acc);
				
				if($tcgetloanamout>0)
				{
					$tataenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$tcinterestrate, 'pl_bankemi'=>$tcgetemicalc, 'pl_banktenure'=>$tcterm, 'pl_loanamount'=>$tcgetloanamout, 'pl_bankpf'=>$tcProcessing_Fee, 'pl_bankppc'=>'0%', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $tataenter);
				}
				else
				{
					$arrayInsertTata = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertTata);
				}
			}
			//CapitalFirst
			elseif($shownToBidders_Arr[$r]=="Capital First" && $Employment_Status==1)
			{
				list($cfinterestrate,$cfgetloanamout,$cfgetemicalc,$cfterm,$cfProcessing_Fee)= capitalFirst($monthsalary,$getCompany_Name,$capitalfirstcomp,$age,$Company_Type,$Employment_Status);
				//echo $cfinterestrate." - ".$cfgetloanamout." - ".$cfgetemicalc." - ".$cfterm." - ".$cfProcessing_Fee;
				if($cfgetloanamout>0)
				{
					$capfenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>"Capital First", 'pl_bankrate'=>$cfinterestrate, 'pl_bankemi'=>$cfgetemicalc, 'pl_banktenure'=>$cfterm, 'pl_loanamount'=>$cfgetloanamout, 'pl_bankpf'=>$cfProcessing_Fee, 'pl_bankppc'=>'', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $capfenter);
					$insertplsave = Maininsertfunc ('pl_quote_shown_save', $capfenter);
				}
				else
				{
					$arrayInsertcapf = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertcapf);
				}
			}
			//ING vysya
			elseif(($shownToBidders_Arr[$r]=="IngVysya" || $shownToBidders_Arr[$r]=="ING Vysya") && $Employment_Status==1)
			{
				if($Primary_Acc=="IngVysya"){$account_holder = 1;}
				list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans_nw ($ingvyasyacategory, $monthsalary, $account_holder,$age,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name,$Company_Type);
				if($getloanamout>0)
				{
					$ingvysyaprepay="0%";
					$ingvysyaprepay="0%";
					$ingvysyaenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$interestrate, 'pl_bankemi'=>$getemicalc, 'pl_banktenure'=>$term, 'pl_loanamount'=>$getloanamout, 'pl_bankpf'=>$Processing_Fee, 'pl_bankppc'=>$ingvysyaprepay, 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $ingvysyaenter);
				}
				else
				{
					$arrayInsertIng = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
					$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertIng);
				}
			}
			elseif($shownToBidders_Arr[$r]=="Bajaj Finserv")
			{
				$bajajenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'14.5', 'pl_dated'=>$Dated);
				$insert = Maininsertfunc ('pl_quote_shown', $bajajenter);
			}
			elseif($shownToBidders_Arr[$r]=="InCred")
			{
				$incredenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'17', 'pl_dated'=>$Dated);
				$insert = Maininsertfunc ('pl_quote_shown', $incredenter);
			}
			else
			{
				$arrayInsertOther = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
				$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertOther);	
			}			
		}
?>
<div class="row">
<div class="col-md-10 push-13 cibil-bullet">
<ul>
<li>You are eligible for the below mentioned Banks, They will service you within 24hrs.</li>
<li>We at deal4loans.com believe that, it is big financial decision that you are about to take.</li>
<li>To get deal, speak to 3-4 banks mentioned below &amp; then decide upon the best deal.</li>
<li>This will help you get best deal &amp; save on EMI &amp; choose best product &amp; best service.</li>
</ul>
</div>
</div>
<div class="overflow-width">
<div id="data" align="center">
<table border="0" cellpadding="2" cellspacing="0" align="center">
<tr>
    <th width="160"  bgcolor="#0f8eda" align="center">Bank Name</th>
    <th width="167" align="center" bgcolor="#0f8eda" style="border:#FFF thin solid;">Interest Rate</th>
    <th width="189" align="center" bgcolor="#0f8eda" style="border:#FFF thin solid;">Emi (per Month)</th>
    <th width="46" align="center" bgcolor="#0f8eda" style="border:#FFF thin solid;">Tenure</th>
    <th width="83" align="center" bgcolor="#0f8eda" style="border:#FFF thin solid;">Eligible Loan<br /> 
      Amount</th>
    <th width="100" align="center" bgcolor="#0f8eda" style="border:#FFF thin solid;">Processing Fee</th>
    <th width="100" align="center" bgcolor="#0f8eda" style="border:#FFF thin solid;">Pre-Payment charges</th>
	<th width="154" align="center" bgcolor="#0f8eda" style="border:#FFF thin solid;">Request for more<br /> 
      Information</th>
</tr>
<? $plshowquotes = "Select * from pl_quote_shown Where pl_leadid=".$leadid." order by pl_bankrate ASC";
list($plshowRows,$plquote)=MainselectfuncNew($plshowquotes,$array = array());

	for($i=0;$i<$plshowRows;$i++)
	{
	$shwlogo="select logo from Bank_Master Where (Bank_Name like '%".$plquote[$i]["pl_bankname"]."%' and logo !='')";
	list($plqtelogoRows,$plqtelogo)=MainselectfuncNew($shwlogo,$array = array());
	$plqtelogocontr=count($plqtelogo)-1;
	if(strlen($plqtelogo[$plqtelogocontr]["logo"])>5)
	{
		$imagebank ='<img src="/'.$plqtelogo[$plqtelogocontr]["logo"].'" width="135" height="60"/>';
	}
	else
	{
		$imagebank="";
	}	?>
	<tr><?
	if($plquote[$i]["pl_bankrate"]=="100.00")
	{
		if($plquote[$i]["pl_bankname"]=="Citibank")
		{ ?>
	<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote[$i]["pl_bankname"]; } ?></td>
	<td colspan="6" class="i-rate" style="text-align:left;">Loans up to 30 lakhs *<br />
Transfer your high cost dues & save on your monthly Payout
24X7 online account management
    <br />* <a href="/citipl-disclaimer.php" target="_blank">T&C apply</a> </td>
	<td class="info">
		<form action="/apply_pl_consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
			<input type="hidden" name="max_loan_amount" value="<?php echo $plquote[$i]["pl_loanamount"]; ?>" />
			<input type="hidden" name="calc_emi" value="<?php echo $plquote[$i]["pl_bankemi"]; ?>" />
			<input type="hidden" name="loan_tenure" value="<?php echo $plquote[$i]["pl_banktenure"]; ?>" />
			<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
	</td>
	<? }
	elseif($plquote[$i]["pl_bankname"]=="HappyRupee")
	{ ?>
	<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote[$i]["pl_bankname"]; } ?></td>
	<td colspan="6" class="i-rate" style="text-align:left;">Disbursal in 24 hrs *<br />
			Loans for Rs 15,000 - 1.5 lacs<br>
			Repay in 3-24 months <br /></td>
	<td class="info">
		<form action="/apply_pl_consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
	</td>
	<? }
	elseif($plquote[$i]["pl_bankname"]=="Bajaj Finserv" && $Employment_Status==1)
	{
		$bflloansmt= round($monthsalary*10); $bfltenuremth=60;
					 				 
		$bflintr1=11.99/1200;
		$bflintr2=16/1200;
		$bflintrte="11.99% - 16%";
		$getemi1=round($bflloansmt * $bflintr1 / (1 - (pow(1/(1 + $bflintr1), $bfltenuremth)))); 
		$getemi2=round($bflloansmt * $bflintr2 / (1 - (pow(1/(1 + $bflintr2), $bfltenuremth)))); 
		$getemi = $getemi1." - ".$getemi2;
	?>			
	<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
	<td class="i-rate"><? echo $bflintrte; ?></td>
	<td class="emi">Rs.<? echo $getemi; ?></td>
	<td class="tenure"><? echo "5"; ?> yrs.</td>
	<td class="loan">Rs. <? echo $bflloansmt;  ?></td>
	<td class="i-pfrate"> <? echo "Upto 2%"; ?></td>
	<td class="prepay"> <? echo "4% (After 1st EMI, Part payment 2% of POS)"; ?></td>
	<td class="info">
		<?php if($source=="UAT_BFL") { ?>
		<form action="/apply-pl-bajajfinserv4-nw.php" method="POST" target="_blank" ><? } else { ?><form action="/apply-pl-bajajfinserv4.php" method="POST" target="_blank" ><? } ?>
			<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
			<input type="hidden" name="loan_amount" id="loan_amount" value="<?php echo $Loan_Amount; ?>" />
			<input type="hidden" name="name" value="<?php echo $Name; ?>" />
			<input type="hidden" name="DOB" id="DOB" value="<?php echo $DOB; ?>" />
			<input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<?php echo $Mobile_Number; ?>" />
			<input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
			<input type="hidden" name="company_name" id="company_name" value="<? echo $getCompany_Name; ?>">
			<input type="hidden" name="salary" id="salary" value="<?php echo $Net_Salary; ?>" />
			<input type="hidden" name="Email" id="Email" value="<?php echo $Email; ?>" />	  
			<input type="submit" style="width: 101px; height: 42px; border: 0px none ; cursor:pointer; background: url(/new-images/get-approval-stamp-nw.png); margin-bottom: 0px; margin-top:10px;" value=""  />
		</form>
	</td>
	<? }
	elseif($plquote[$i]["pl_bankname"]=="InCred" && $Employment_Status==1)
	{ 	 
		list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= incred ($monthsalary,$PL_EMI_Amt, $getCompany_Name, $category,$age,$Company_Type);
	?>			
	<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
	<td class="i-rate"><? echo $interestrate; ?></td>
	<td class="emi">Rs.<? echo $getemicalc; ?></td>
	<td class="tenure"><? echo $term; ?> yrs.</td>
	<td class="loan">Rs. <? echo $getloanamout;  ?></td>
	<td class="i-pfrate"> <? echo $Processing_Fee; ?></td>
	<td class="prepay"> <? echo "NA"; ?></td>
	<td class="info">
		<form action="/apply_pl_consentincred.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
	</td>
	<? }
	else
	{
	?>
	<tr>
	<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote[$i]["pl_bankname"]; } ?></td>
	<td colspan="6" class="i-rate">Check this bank offer via phone.</td>
	<?
	if($plquote[$i]["pl_bankname"]=="IngVysya" && $Employment_Status==1 && $monthsalary>=65000 && ($City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Gaziabad" || $City=="Faridabad"))
	{ ?>
	<td class="info">
		<form action="/apply-ingpl-consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 83px; height: 38px; border: 0px none ; cursor:pointer; background-image: url(/new-images/ing-get-instant-eligibility-btn.png); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
	</td>		
	<?  }
	elseif((($plquote[$i]["pl_bankname"]=="ICICI") || ($plquote[$i]["pl_bankname"]=="ICICI Bank")) && $Employment_Status==1)
	{ ?>
	<td class="info">
		<form action="/apply_icicipl_consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
	</td>
	<? }
	elseif((($plquote[$i]["pl_bankname"]=="Standard Chartered") || ($plquote[$i]["pl_bankname"]=="Standard Chartered")) && $Employment_Status==1)
	{ ?>
	<td class="info">
		<form action="/apply_stancpl_consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
	</td>
	<? }
	else
	{ ?>
	<td class="info">
		<form action="/apply_pl_consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
	</td>
	<? }
	}
	}		 
	else
	{ 
		if($plquote[$i]["pl_bankname"]=="Citibank")
		{ ?>
		<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote[$i]["pl_bankname"]; } ?></td>
		<td colspan="6" class="i-rate" style="text-align:left;">Loans up to 30 lakhs *<br />
Transfer your high cost dues & save on your monthly Payout
24X7 online account management <br />* <a href="/citipl-disclaimer.php" target="_blank">T&C apply</a> </td>
	<td class="info">
		 <form action="/apply_pl_consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
			<input type="hidden" name="max_loan_amount" value="<?php echo $plquote[$i]["pl_loanamount"]; ?>" />
			<input type="hidden" name="calc_emi" value="<?php echo $plquote[$i]["pl_bankemi"]; ?>" />
			<input type="hidden" name="loan_tenure" value="<?php echo $plquote[$i]["pl_banktenure"]; ?>" />
			<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
	</td>
				 <? }
				 elseif($plquote[$i]["pl_bankname"]=="HappyRupee")
				 { ?>
				 	<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote[$i]["pl_bankname"]; } ?></td>
			 <td colspan="6" class="i-rate" style="text-align:left;">Disbursal in 24 hrs *<br />
			Loans for Rs 15,000 - 1.5 lacs<br>
			Repay in 3-24 months <br /></td>
	<td class="info"><form action="/apply_pl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form></td>
				 <? }
				 elseif($plquote[$i]["pl_bankname"]=="Bajaj Finserv" && $Employment_Status==1)
				 {  $bflloansmt= round($monthsalary*10); $bfltenuremth=60;
									 
						 $bflintr1=11.99/1200;
						 $bflintr2=16/1200;
						 $bflintrte="11.99% - 16%";
						 $getemi1=round($bflloansmt * $bflintr1 / (1 - (pow(1/(1 + $bflintr1), $bfltenuremth)))); 
						 $getemi2=round($bflloansmt * $bflintr2 / (1 - (pow(1/(1 + $bflintr2), $bfltenuremth)))); 
						 $getemi = $getemi1." - ".$getemi2;
					  ?>			
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote[$i]["pl_bankname"]; } ?></td>
					 <td class="i-rate"><? echo $bflintrte; ?></td>
		<td class="emi">Rs.<? echo $getemi; ?></td>
		<td class="tenure"><? echo "5"; ?> yrs.</td>
		<td class="loan">Rs. <? echo $bflloansmt;  ?></td>
		<td class="i-pfrate"> <? echo "Upto 2%"; ?></td>
		<td class="prepay"> <? echo "4% (After 1st EMI, Part payment 2% of POS)"; ?></td>
		<td class="info"><?php if($source=="UAT_BFL") { ?><form action="/apply-pl-bajajfinserv4-nw.php" method="POST" target="_blank" ><? } else { ?><form action="/apply-pl-bajajfinserv4.php" method="POST" target="_blank" ><? } ?>
		<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		<input type="hidden" name="loan_amount" id="loan_amount" value="<?php echo $Loan_Amount; ?>" />
	   <input type="hidden" name="name" value="<?php echo $Name; ?>" />
	   <input type="hidden" name="DOB" id="DOB" value="<?php echo $DOB; ?>" />
       <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<?php echo $Mobile_Number; ?>" />
       <input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
       <input type="hidden" name="company_name" id="company_name" value="<? echo $getCompany_Name; ?>">
	   <input type="hidden" name="salary" id="salary" value="<?php echo $Net_Salary; ?>" />
	    <input type="hidden" name="Email" id="Email" value="<?php echo $Email; ?>" />	  
		<input type="submit" style="width: 101px; height: 42px; border: 0px none ; cursor:pointer; background: url(/new-images/get-approval-stamp-nw.png); margin-bottom: 0px; margin-top:10px;" value=""  />
				  </form></td>
				<? }
			elseif($plquote[$i]["pl_bankname"]=="InCred" && $Employment_Status==1)
				 { 	 
					list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= incred ($monthsalary,$PL_EMI_Amt, $getCompany_Name, $category,$age,$Company_Type);
					  ?>			
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
					 <td class="i-rate"><? echo $interestrate; ?></td>
		<td class="emi">Rs.<? echo $getemicalc; ?></td>
		<td class="tenure"><? echo $term; ?> yrs.</td>
		<td class="loan">Rs. <? echo $getloanamout;  ?></td>
		<td class="i-pfrate"> <? echo $Processing_Fee; ?></td>
		<td class="prepay"> <? echo "NA"; ?></td>
		<td class="info"><form action="/apply_pl_consentincred.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
				<? }
				 else
				 {	
					 ?>
		<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote[$i]["pl_bankname"]; } ?></td>
		<td class="i-rate"><? if($plquote[$i]["pl_bankname"]=="Fullerton") {echo "21% - 32%";} else {echo $plquote[$i]["pl_bankrate"]."%";} ?></td>
		<td class="emi">Rs.<? echo $plquote[$i]["pl_bankemi"]; ?></td>
		<td class="tenure"><? echo $plquote[$i]["pl_banktenure"]; ?> yrs.</td>
		<td class="loan">Rs. <? echo substr(trim($plquote[$i]["pl_loanamount"]), 0, strlen(trim($plquote[$i]["pl_loanamount"]))-3);  ?></td>
		<td class="i-pfrate"> <? echo $plquote[$i]["pl_bankpf"]; ?></td>
		<td class="prepay"> <? echo $plquote[$i]["pl_bankppc"]; ?></td>
		<?
 if($plquote[$i]["pl_bankname"]=="IngVysya" && $Employment_Status==1 && $monthsalary>=65000 && ($City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Gaziabad" || $City=="Faridabad"))
				 { ?>
				 <td class="info"><form action="/apply-ingpl-consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 83px; height: 38px; border: 0px none ; cursor:pointer; background-image: url(/new-images/ing-get-instant-eligibility-btn.png); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form></td>		
				<?  }
			elseif((($plquote[$i]["pl_bankname"]=="ICICI") || ($plquote[$i]["pl_bankname"]=="ICICI Bank")) && $Employment_Status==1)
				 { ?>
				<td class="info"><form action="/apply_icicipl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
			 </form></td>
				 <? }
			elseif((($plquote[$i]["pl_bankname"]=="Standard Chartered") || ($plquote[$i]["pl_bankname"]=="Standard Chartered")) && $Employment_Status==1)
				 { ?>
				<td class="info"><form action="/apply_stancpl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
			 </form></td>
				 <? }
		else
		{ ?>
		<td class="info"><form action="/apply_pl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form></td>
		<? }	 }
	?>	 
	</tr>
	<?		 }
		 }
	?>
	<tr>
            <td colspan="8" align="right" style="font:bold 14px Arial, Helvetica, sans-serif; height:20px;"><a href="/rate-disclaimer.php" target="_blank" >Disclaimer</a></td>
          </tr>
	</table>
	</div>
</div>
	<?
	$plshowquotesdel="Delete from pl_quote_shown Where pl_leadid=".$leadid."";
		$deleterowcount=Maindeletefunc($plshowquotesdel,$array = array());
		$shownToBidders_Str = implode(",",$shownToBidders_Arr);
		$dataUpdate = array("checked_bidders"=>$shownToBidders_Str);
		$wherecondition = "(RequestID='".$leadid."')";
		Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
	 }	
	 else
	 { ?>
 <p><strong><br>We are not able to find any bank for you.Please contact your local bank. We will contact you, if we find any offer for you.</strong></p>
	<? }
}
 ?>
  </div> 
</div></div>
<div style="clear:both; height:15px;"></div></div>
<?php $REMOVE_ADD=1;
include "footer_sub_menu.php"; ?>
<script src="cibil/js/jquery.min.js" type="text/javascript"></script>
<script src="cibil/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var per='16';
	var cibilVal = $('.count-font').text();
	var dValue = (cibilVal-300)/100;
    setTimeout(function() {
		if(dValue==1){
			jQuery('.pointer').animate({left: per+'%'}, 3000, 'swing');
		}
		else{
			jQuery('.pointer').animate({left: parseInt(per*dValue)+'%'}, 3000, 'swing');
		}
    }, 1000);
</script>
</body>
</html>
