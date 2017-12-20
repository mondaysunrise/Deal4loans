<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'getlistofeligiblebidders.php';
require 'scripts/personal_loan_eligibility_function_form.php';
require 'show_quotecount.php';	

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

//$leadid = 1431054;
$leadid = $_SESSION['leadid'];
$getpldetails="select Employment_Status,Mobile_Number,Email,City_Other,City,Company_Name,Name,Net_Salary,DOB,PL_EMI_Amt, Primary_Acc,identification_proof,Company_Type,Loan_Amount,Primary_Acc From Req_Loan_Personal Where (RequestID='".$leadid."')";

list($alreadyExist,$plrow)=MainselectfuncNew($getpldetails,$array = array());
	$myrowcontr=count($plrow)-1;
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
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
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
#bodyCenter #nwcontainer{background:url("/new-images/container-bg.png") repeat-x; clear:both; width:850px; min-height:437px; padding:29px 10px 10px 10px;}
#bodyCenter #nwcontainer p strong{font:bold 14px Arial, Helvetica, sans-serif; color:#000; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer p{font:normal 12px Arial, Helvetica, sans-serif; color:#5c5e5e; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer #data{clear:both; margin:28px 0 15px 0;}
#bodyCenter #nwcontainer #data table{width:846px; margin:0 auto; position:relative;}
#bodyCenter #nwcontainer #data table tr{}
#bodyCenter #nwcontainer #data table tr th{font:bold 12px Arial, Helvetica, sans-serif; color:#3b5586; background:url("/new-images/li-bg.jpg") repeat-x; height:33px; padding:3px 0 0 0;}
#bodyCenter #nwcontainer #data table tr th.bank{background:url("/new-images/bank-name.png") no-repeat; width:150px;}
#bodyCenter #nwcontainer #data table tr td{border-bottom:2px solid #fff!important; height:80px;}
#bodyCenter #nwcontainer #data table tr td.banks{background:#f1f1f1; width:116px; text-align:center; padding:10px 0 0 0; height:50px; font:bold 10px Arial, Helvetica, sans-serif;}
#bodyCenter #nwcontainer #data table tr td.i-rate{background:#e7e6e6; text-align:center; font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:149px; }
#bodyCenter #nwcontainer #data table tr td.emi{background:#ececec; text-align:center;font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:161px; padding:0 0 0 5px;}
#bodyCenter #nwcontainer #data table tr td.tenure{text-align:center; font:bold 12px Arial, Helvetica, sans-serif; color:#706f6f; width:61px; padding:0 0 0 5px; background:url("/new-images/tenure-bg.jpg") repeat-y; text-align:center; }
#bodyCenter #nwcontainer #data table tr td.loan{text-align:left; font:bold 12px Arial, Helvetica, sans-serif; color:#706f6f; width:134px; padding:0 0 0 5px; background:url("/new-images/loan-bg.jpg") repeat-y; text-align:center;}
#bodyCenter #nwcontainer #data table tr td.info{text-align:left; font:bold 13px Arial, Helvetica, sans-serif; color:#bf2228; width:100px; padding:0 0 0 5px; background:url("/new-images/information.jpg") repeat-y; text-align:center;
}
#bodyCenter #nwcontainer #data table tr td.i-pfrate{background:#e7e6e6; text-align:center; font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:100px; }
#bodyCenter #nwcontainer #data table tr td.prepay{background:#ececec; text-align:center;font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:100px; padding:0 0 0 5px;}
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu-credit-card.php"; ?>
<!--logo navigation-->
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:1000px;">
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center" style="width:998px;">
  <p><strong>Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com</strong></p>
<?php 
if ($leadid>0)
 {
 $getcompany='select * from pl_company_list where company_name="'.$getCompany_Name.'"';
 //echo $getcompany;
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

//for capitalfirst
if(($City=="Ahmedabad" || $City=="Bangalore" || $City=="Baroda" || $City=="Vadodara" || $City=="Bhopal" || $City=="Bhubaneswar" || $City=="Bhubneshwar" || $City=="Chandigarh" || $City=="Chennai" || $City=="Coimbatore" || $City=="Cuttack" || $City=="Delhi" || $City=="Ghaziabad" || $City=="Gurgaon" || $City=="Noida" || $City=="Faridabad" || $City=="Hyderabad" || $City=="Indore" || $City=="Jaipur" || $City=="Jalandhar" || $City=="Jodhpur" || $City=="Kolkata" || $City=="Lucknow" || $City=="Ludhiana" || $City=="Mumbai" || $City=="Navi Mumbai" || $City=="Thane" || $City=="Nagpur" || $City=="Nasik" || $City=="Pune" || $City=="Surat" || $City=="Udaipur" || $City=="Vijaywada" || $City=="Vishakapatnam" || $City=="Vizag" || $City=="Madurai" || $City=="Ambala" || $City=="Anand")  && $Net_Salary>=180000 && $Net_Salary<=360000 && $age>=18)
	 {
		$approvedcapitalfirst=1;
	 }

//for capital first

if(count($FinalBidder)>0  || $approvedcapitalfirst==1)
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
	elseif((($shownToBidders_Arr[$r]=="ICICI") || ($shownToBidders_Arr[$r]=="ICICI Bank")) && $Employment_Status==1)
	{
		list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi,$iciciprocfee)=icicibank($monthsalary,$getCompany_Name,$icici_bankcategory,$age,$Company_Type,$Primary_Acc);
		if($icicigetloanamout>0)
		{
			$icicienter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$iciciinterestrate, 'pl_bankemi'=>$icicigetemicalc, 'pl_banktenure'=>$iciciterm, 'pl_loanamount'=>$icicigetloanamout, 'pl_bankpf'=>$iciciprocfee, 'pl_bankppc'=>$hdfcprepay, 'pl_dated'=>$Dated);
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
		{	if($kotakloanamt>1000000)
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
	//Capital first
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
	{	if($Primary_Acc=="IngVysya"){$account_holder = 1;}
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
	else
	 {
		$arrayInsertOther = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
		$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertOther);	
			 }			
	}
?>
<div align="left">
<span style="float:left; color:#000000; padding-left:4px;line-height:16px; padding-bottom:5px;">You are eligible for the below mentioned Banks, They will service you within 24hrs.<br />We at deal4loans.com believe that its big financial decision that you
are about to take.<br />
To get best deal, speak to 3 - 4 banks mentioned below and then decide
upon the best deal.<br />
This will help you get best deal & save on Emi & choose best product &
best service.</span></div><br>
<div id="data" align="center">
<table border="0" cellpadding="2" cellspacing="0" align="center">
<tr>
    <th width="160" class="bank">&nbsp;</th>
    <th width="167">Interest Rate</th>
    <th width="189">Emi (per Month)</th>
    <th width="46">Tenure</th>
    <th width="83">Eligible Loan<br /> 
      Amount</th>
       <th width="100" valign="">Processing Fee</th>
      <th width="100" valign="">Pre-Payment charges</th>
	    <th width="154">Request for more<br /> 
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
			 }	?><tr><?
	if($plquote[$i]["pl_bankrate"]=="100.00")
			 { if($plquote[$i]["pl_bankname"]=="Citibank")
				 { ?>
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote[$i]["pl_bankname"]; } ?></td>
 <td colspan="6" class="i-rate"><ul style="text-align:left;" ><li>Loans up to 30 lakhs *</li>
<li>Transfer your high cost dues & save on your monthly Payout</li>
<li>24X7 online account management</li>
    </ul> <br />* <a href="/citipl-disclaimer.php" target="_blank">T&C apply</a> </td>
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
				 { $bflloansmt= round($monthsalary*10); $bfltenuremth=60;
									 
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
<td class="info"><form action="/apply-pl-bajajfinserv4.php" method="POST" target="_blank" >
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
				 else
				 {
					 ?>
			 <tr>
		<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
		<td colspan="6" class="i-rate">Check this bank offer via phone.</td>
		<td class="info"><form action="/apply_pl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form></td>
			 <? 
			 }
			  }			 
			 else
			 {
				 if($plquote[$i]["pl_bankname"]=="Citibank")
				 { ?>
				 	<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
 <td colspan="6" class="i-rate"><ul style="text-align:left;" ><li>Loans up to 30 lakhs *</li>
<li>Transfer your high cost dues & save on your monthly Payout</li>
<li>24X7 online account management</li>
    </ul> <br />* <a href="/citipl-disclaimer.php" target="_blank">T&C apply</a> </td>
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
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
					 <td class="i-rate"><? echo $bflintrte; ?></td>
		<td class="emi">Rs.<? echo $getemi; ?></td>
		<td class="tenure"><? echo "5"; ?> yrs.</td>
		<td class="loan">Rs. <? echo $bflloansmt;  ?></td>
		<td class="i-pfrate"> <? echo "Upto 2%"; ?></td>
		<td class="prepay"> <? echo "4% (After 1st EMI, Part payment 2% of POS)"; ?></td>
<td class="info"><form action="/apply-pl-bajajfinserv4.php" method="POST" target="_blank" >
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
		<td class="info"><form action="/apply_pl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form></td>
		<?	 }
	?>	 
	</tr>
	<?		 }
		 }
		   //put capital first here
		 if(($City=="Ahmedabad" || $City=="Bangalore" || $City=="Baroda" || $City=="Vadodara" || $City=="Bhopal" || $City=="Bhubaneswar" || $City=="Bhubneshwar" || $City=="Chandigarh" || $City=="Chennai" || $City=="Coimbatore" || $City=="Cuttack" || $City=="Delhi" || $City=="Gurgaon" || $City=="Faridabad" || $City=="Hyderabad" || $City=="Indore" || $City=="Jaipur" || $City=="Jalandhar" || $City=="Jodhpur" || $City=="Kolkata" || $City=="Lucknow" || $City=="Ludhiana" || $City=="Pune" || $City=="Surat" || $City=="Udaipur" || $City=="Vijaywada" || $City=="Vishakapatnam" || $City=="Vizag" || $City=="Madurai" || $City=="Ambala" || $City=="Anand")  && $Net_Salary>=180000 && $Net_Salary<=360000 && $age>=18)
		 {
			 
		?> <tr><td class="banks" style="color:#000000;">&nbsp;&nbsp;<img src="/new-images/thumb/capital-first-logo.jpg" /></td>
					 <td class="i-rate"><? echo "20% (Flat Rate)"; ?></td>
		<td class="emi">Rs.<? echo "2,222/- To Rs.17,778/-"; ?></td>
		<td class="tenure"><? echo "3"; ?> yrs.</td>
		<td class="loan">Rs. <? echo "50,000 To 4,00,000";  ?></td>
		<td class="i-pfrate"> <? echo "2%"; ?></td>
		<td class="prepay"> <? echo "5%"; ?></td>
		<td class="info"><form action="/apply-pl-capitalfirst.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		 <input type="hidden" name="name" value="<?php echo $Name; ?>" />      
       <input type="hidden" name="company_name" id="company_name" value="<? echo $getCompany_Name; ?>">
	   <input type="hidden" name="salary" id="salary" value="<?php echo $Net_Salary; ?>" />
	    <input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td></tr>

		 <? } //put capital first end here
	?>
	<tr>
            <td colspan="8" align="right" style="font:bold 11px Arial, Helvetica, sans-serif; height:20px;"><a href="/rate-disclaimer.php" target="_blank" >Disclaimer</a></td>
          </tr>
	</table>
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
 <p><strong>We are not able to find any bank for you.Please contact your local bank. We will contact you, if we find any offer for you.</strong></p>
	 <? }
 }
 ?>
  </div> 
</div></div>
<div style="clear:both; height:15px;"></div>
<?php $REMOVE_ADD=1;
include "footer1.php"; ?>
</body>
</html>