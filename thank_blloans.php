<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	require 'show_quotecount.php';

$Dated = ExactServerdate();
	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;
	return "";
   }
	
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

		$leadid = $_REQUEST["ctrq"];
	$getpldetails=("select Employment_Status,CC_Holder,Email,City_Other,City,Company_Name,Name,Net_Salary,DOB,Reference_Code,source,Total_Experience From Req_Loan_Personal Where (RequestID='".$leadid."')");	
	list($alreadyExist,$plrow)=MainselectfuncNew($getpldetails,$array = array());
	$plrowcontr=count($plrow)-1;

	$getCompany_Name = $plrow[$plrowcontr]['Company_Name'];
	$City = $plrow[$plrowcontr]['City'];
	$Name = $plrow[$plrowcontr]['Name'];
	$DOB = $plrow[$plrowcontr]['DOB'];
	$Net_Salary = $plrow[$plrowcontr]['Net_Salary'];
	$Other_City = $plrow[$plrowcontr]['City_Other'];	
	$Email = $plrow[$plrowcontr]['Email'];
	$Reference_Code = $plrow[$plrowcontr]['Reference_Code'];
	$CC_Holder = $plrow[$plrowcontr]['CC_Holder'];
	$Employment_Status = $plrow[$plrowcontr]['Employment_Status'];
	$source = $plrow[$plrowcontr]['source'];
	$Total_Experience = $plrow[$plrowcontr]["Total_Experience"];
	$getDOB = str_replace("-","", $DOB);
	$age = DetermineAgeGETDOB($getDOB);
	$monthsalary =$Net_Salary/12;
				
	$crap = $City." ".$Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
	$crapValue = validateValues($crap);

	if($strCity=="Delhi" || $strCity=="Mumbai" || $strCity=="Chennai" || $strCity=="Kolkata" || $strCity=="Bangalore" || $strCity=="Hyderabad" || $strCity=="Pune" || $strCity=="Noida" || $strCity=="Gurgaon" || $strCity=="Gaziabad" || $strCity=="Faridabad" || $strCity=="Thane" || $strCity=="Navi Mumbai")
		{
			if($CC_Holder==1 || $is_permit==1 || ($EMI_Paid>0))
			{
				$permited=1;
			}
				else
			{
				$permited=0;
			}
		}
		else
		{
			$permited=1;
		}

		if($fullerton_loan==1)
		{
			$permited=0;
		}
		
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
#bodyCenter #nwcontainer #data table tr td.banks{background:#f1f1f1; width:116px; text-align:center; padding:10px 0 0 0; height:50px; font: 12px Arial, Helvetica, sans-serif;}
#bodyCenter #nwcontainer #data table tr td.i-rate{background:#e7e6e6; text-align:center; font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:149px; }
#bodyCenter #nwcontainer #data table tr td.emi{background:#ececec; text-align:center;font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:161px; padding:0 0 0 5px;}
#bodyCenter #nwcontainer #data table tr td.tenure{text-align:center; font: 14px Arial, Helvetica, sans-serif; color:#706f6f; width:61px; padding:0 0 0 5px; background:url("/new-images/tenure-bg.jpg") repeat-y; text-align:center; }
#bodyCenter #nwcontainer #data table tr td.loan{text-align:left; font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:134px; padding:0 0 0 5px; background:url("/new-images/loan-bg.jpg") repeat-y; text-align:center;}
#bodyCenter #nwcontainer #data table tr td.info{text-align:left; font:14px Arial, Helvetica, sans-serif; color:#bf2228; width:100px; padding:0 0 0 5px; background:url("/new-images/information.jpg") repeat-y; text-align:center;
}
#bodyCenter #nwcontainer #data table tr td.i-pfrate{background:#e7e6e6; text-align:center; font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:100px; }
#bodyCenter #nwcontainer #data table tr td.prepay{background:#ececec; text-align:center;font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:100px; padding:0 0 0 5px;}

@media screen and (max-width: 768px) {#bodyCenter #nwcontainer{background: #E0F2F3; width:100%; min-height:437px; padding:29px 10px 10px 10px;}
}
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto;  height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Business Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center" style="color:#000000;">
  <p><strong>Dear <? echo $Name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com</strong></p>
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
	$FinalBidder=implode(',',$FinalBidder);
	$FinalBidderarr=explode(',',$FinalBidder);
$cmpBDName="";
for($q=0;$q<count($FinalBidderarr);$q++)
	{
	$getbdnme='select BankID from Bidders_List where BidderID="'.$FinalBidderarr[$q].'"';
	list($recordcountBID,$bdnm)=MainselectfuncNew($getbdnme,$array = array());
	$bdnmcontr=count($bdnm)-1;

	$getbdnmeex='select Bank_Name from Bank_Master where BankID="'.$bdnm[$bdnmcontr]["BankID"].'"';
	list($recordcountBN,$bdnmbnk)=MainselectfuncNew($getbdnmeex,$array = array());
	$bdnmbnkcontr=count($bdnmbnk)-1;
	$Final_Bid[]=$bdnmbnk[$bdnmbnkcontr]["Bank_Name"];
	}
	//print_r($FinalBidderarr);

//for capitalfirst UAT only
if(($City=="Ludhiana" || $City=="Chandigarh" || $City=="Jaipur" || $City=="Ahmedabad" || $City=="Delhi" || $City=="Hyderabad" || $City=="Chennai" || $City=="Bangalore" || $City=="Mumbai" || $City=="Pune" || $City=="Baroda" || $City=="Nagpur")  && ($Employment_Status==0 && $Net_Salary>360000 && $Total_Experience>=3 && $age>=28) && $source=="UATcapitalfirst")
	 {
		$UATCapfirst=1;
	 }

	//for capitalfirst
if(($City=="Ahmedabad" || $City=="Bangalore" || $City=="Baroda" || $City=="Vadodara" || $City=="Bhopal" || $City=="Bhubaneswar" || $City=="Bhubneshwar" || $City=="Chandigarh" || $City=="Chennai" || $City=="Coimbatore" || $City=="Cuttack" || $City=="Delhi" || $City=="Ghaziabad" || $City=="Gurgaon" || $City=="Noida" || $City=="Faridabad" || $City=="Hyderabad" || $City=="Indore" || $City=="Jaipur" || $City=="Jalandhar" || $City=="Jodhpur" || $City=="Kolkata" || $City=="Lucknow" || $City=="Ludhiana" || $City=="Mumbai" || $City=="Navi Mumbai" || $City=="Thane" || $City=="Nagpur" || $City=="Nasik" || $City=="Pune" || $City=="Surat" || $City=="Udaipur" || $City=="Vijaywada" || $City=="Vishakapatnam" || $City=="Vizag")  && $Net_Salary>=180000 && $Net_Salary<=360000 && $age>=18 && $source!="UATcapitalfirst")
	 {
			$approvedcapitalfirst=1;
	 }

if(count($FinalBidderarr)>0  || $approvedcapitalfirst==1 || $UATCapfirst==1)
	 {
for($i=0;$i<count($FinalBidderarr);$i++)
	{
		if(((strncmp ("Standard", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Standard Chartered")) && $stanccategory=='' && $Primary_Acc!="Standard Chartered")
		{
		}
		elseif(((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton")) && ($Residential_Status!=1 && $Residential_Status!=3 && $Residential_Status!=4 && $Residential_Status!=5))
		{
		}
		else if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 || ($Final_Bid[$i]=="CitiBank")) && ($citicategory=='' && $Primary_Acc!="Citibank"))
		{
		}
		else if(((strncmp ("HDBFS", $Final_Bid[$i],5))==0 || ($Final_Bid[$i]=="HDBFS")) && ($hdbfscategory==''))
		{
		}
		else if(((strncmp ("IngVysya", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="IngVysya")) && (($ingvyasyacategory=='') && ($Company_Type < 4 )))
		{
		}
		else if(((strncmp ("ICICI", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="ICICI Bank")) && ((strncmp("ICICI", $Primary_Acc,5))!=0 && $Net_Salary<300000))
		{
		}
		else if(((strncmp ("INDUS", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="INDUS IND bank")) && (($Indusind=='') && $Net_Salary<480000))
		{
		}
		else if(((strncmp ("Bajaj", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="Bajaj Finserv")) && (($bajajfinservcategory=='') && $Net_Salary<900000))
		{
		}
		else if(((strncmp ("Kotak", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="Kotak Bank")) && (($kotakcomp=='') && $Net_Salary<480000))
		{
		}
		else
		{ 
			if((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
			{
				if((((($Salary_Drawn==2) || ($Salary_Drawn==3)) && $Employment_Status==1) || ($Employment_Status==0)) && $permited==1)
				{
					$shownToBiddersArr[] = trim($Final_Bid[$i]);
					$shownToBidders_Arrbidid[] = $FinalBidderarr[$i];
				}
				else
				{
				}
			}
			else
			{
				$shownToBiddersArr[] = trim($Final_Bid[$i]);
				$shownToBidders_Arrbidid[] = $FinalBidderarr[$i];
			
			}			
		}
	}
	 }
$getarrfinal_bidders=implode(',',$shownToBidders_Arrbidid);
$shownToBiddersArr = @array_unique($shownToBiddersArr);

	$shownToBidders_Arr = "";
			while (list ($key,$val) = @each($shownToBiddersArr)) { 
				$shownToBidders_Arr[]= $val; 
			}
	
for($r=0;$r<count($shownToBidders_Arr);$r++)
		 {
	if(strlen($shownToBidders_Arr[$r])>2)
			 {
	//HDFC Bank
	if(($shownToBidders_Arr[$r]=="HDFC Bank") || ($shownToBidders_Arr[$r]=="HDFC") && $Employment_Status==1)
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi,$hdfcprocfee)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);
		if($hdfcgetloanamout>0)
		{
			if($hdfcgetloanamout>1000000)
			{$hdfcprepay="NIL";} else { $hdfcprepay="4%";}
			$hdfcenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$hdfcinterestrate, 'pl_bankemi'=>$hdfcgetemicalc, 'pl_banktenure'=>$hdfcterm, 'pl_loanamount'=>$hdfcgetloanamout, 'pl_bankpf'=>$hdfcprocfee, 'pl_bankppc'=>$hdfcprepay, 'pl_dated'=>$Dated);
				$insert = Maininsertfunc ('pl_quote_shown', $hdfcenter);
	
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
		list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi)=@indusindbank($monthsalary,$getCompany_Name,$Indusind,$age,$clubbed_emi);
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
		list($kotakrate,$kotakloanamt,$kotakemi,$kotakterm,$kotakperlacemi)=kotakbank($monthsalary,$getCompany_Name,$kotakcomp,$age,$Company_Type,$Primary_Acc);
		//echo $monthsalary." - ".$getCompany_Name." - ".$kotakcomp." - ".$age." - ".$Company_Type." - ".$Primary_Acc;
		if(strlen($kotakloanamt)>1)
		{
			$kotakenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>$kotakrate, 'pl_bankemi'=>$kotakemi, 'pl_banktenure'=>$kotakterm, 'pl_loanamount'=>$kotakloanamt, 'pl_bankpf'=>$kotakproc_fee, 'pl_bankppc'=>'5%', 'pl_dated'=>$Dated);
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
	//ING vysya
	elseif(($shownToBidders_Arr[$r]=="IngVysya" || $shownToBidders_Arr[$r]=="ING Vysya") && $Employment_Status==1)
	{	if($Primary_Acc=="IngVysya"){$account_holder = 1;}
		list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans_nw ($ingvyasyacategory, $monthsalary, $account_holder,$age,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name,$Company_Type);
		if($getloanamout>0)
			{
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
			$bajajenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'15', 'pl_dated'=>$Dated);
		$insert = Maininsertfunc ('pl_quote_shown', $bajajenter);
	}
	else
	 {
		$arrayInsertOther = array('pl_leadid'=>$leadid, 'pl_bankname'=>$shownToBidders_Arr[$r], 'pl_bankrate'=>'100', 'pl_dated'=>$Dated);
		$insert = Maininsertfunc ('pl_quote_shown', $arrayInsertOther);
			 }	
		 }
	}

if($UATCapfirst==1)
		 {
		list($cfinterestrate,$cfgetloanamout,$cfgetemicalc,$cfterm,$cfProcessing_Fee)= capitalFirst($monthsalary,$getCompany_Name,$capitalfirstcomp,$age,$Company_Type,$Employment_Status);
		//echo $cfinterestrate." - ".$cfgetloanamout." - ".$cfgetemicalc." - ".$cfterm." - ".$cfProcessing_Fee;
		if($cfgetloanamout>0)
			{
				$capfenter = array('pl_leadid'=>$leadid, 'pl_bankname'=>"Capital First", 'pl_bankrate'=>$cfinterestrate, 'pl_bankemi'=>$cfgetemicalc, 'pl_banktenure'=>$cfterm, 'pl_loanamount'=>$cfgetloanamout, 'pl_bankpf'=>$cfProcessing_Fee, 'pl_bankppc'=>'', 'pl_dated'=>$Dated);
				$insert = Maininsertfunc ('pl_quote_shown', $capfenter);
				$insertplsave = Maininsertfunc ('pl_quote_shown_save', $capfenter);
			}
		 }

if(strlen($getarrfinal_bidders)>1  || $approvedcapitalfirst==1 || $UATCapfirst==1)
		 {
?>
<div class="lac-left-box" style="color:#000; text-align:left;">
<span>You are eligible for the below mentioned Banks, They will service you within 24hrs.<br />We at deal4loans.com believe that,it is big financial decision that you
are about to take.<br />
To get best deal, speak to 3 - 4 banks mentioned below and then decide upon the best deal.<br />
This will help you get best deal & save on Emi & choose best product &
best service.<br /><br /></span></div><br>
<div class="overflow-width">
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
<? $plshowquotes=("Select * from pl_quote_shown Where pl_leadid=".$leadid." order by pl_bankrate ASC");
list($plshowRows,$plquote)=MainselectfuncNew($plshowquotes,$array = array());

	for($i=0;$i<$plshowRows;$i++)
	 {
	$shwlogo="select logo from Bank_Master Where Bank_Name like '%".$plquote[$i]["pl_bankname"]."%'";
	list($plqtelogoRows,$plqtelogo)=MainselectfuncNew($shwlogo,$array = array());
	$plqtelogocontr=count($plqtelogo)-1;
	if(strlen($plqtelogo[$plqtelogocontr]["logo"])>5)
			 {
	$imagebank ='<img src="/'.$plqtelogo[$plqtelogocontr]["logo"].'" width="135" height="60"/>';
			 }
			 else
			 {
				$imagebank="";
			 }
	?><tr><?
	if($plquote[$i]["pl_bankrate"]=="100.00")
			 { if($plquote[$i]["pl_bankname"]=="Citibank")
				 { ?>
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote[$i]["pl_bankname"]; } ?></td>
 <td colspan="6" class="i-rate"><ul style="text-align:left;" ><li>Loans up to 30 lakhs *</li>
<li>Transfer your high cost dues & save on your monthly Payout</li>
<li>24X7 online account management</li>
    </ul> <br />* <a href="/citipl-disclaimer.php" target="_blank">T&C apply</a> </td>
	<td class="info">
	 <form action="/get-citibankquote-submit.php" method="GET" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		  <input type="hidden" name="max_loan_amount" value="<?php echo $plquote[$i]["pl_loanamount"]; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $plquote[$i]["pl_bankemi"]; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $plquote[$i]["pl_banktenure"]; ?>" />
            <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
				  </td>
				 <? }
				 elseif($plquote[$i]["pl_bankname"]=="Bajaj Finserv" && $Employment_Status==1)
				 { ?>
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
					 <td colspan="3" class="i-rate"><ul style="text-align:left;"><li>0% Prepayment Charges (After 1st EMI)</li><li>Part Pre-payment (After 1st EMI)</li>
    <li>Loan Amount - Upto 25 Lacs</li>
    </ul></td>
<td colspan="3" class="i-rate" height="100"><? if(($strCity=='Delhi' || $strCity=='Noida' || $strCity=='Gaziabad' || $strCity=='Gurgaon' || $strCity=='Kolkata' || $strCity=='Chandigarh' || $strCity=='Jaipur' || $strCity=='Mumbai' || $strCity=='Navi Mumbai' || $strCity=='Thane' || $strCity=='Pune' || $strCity=='Ahmedabad' || $strCity=='Surat' || $strCity=='Baroda' || $strCity=='Indore' || $strCity=='Bangalore' || $strCity=='Hyderabad' || $strCity=='Chennai' || $strCity=='Coimbatore' || $strCity=='Vizag' || $strCity=='Cochin' || $strCity=='Faridabad') && strlen($bajajfinservcategory)>1 && $Employment_Status==1) { ?><img src="new-images/get-approval-stamp.png" width="198" height="90" /><br />*Else Cashback of Rs. 1,000/-<? } ?> </td>
<td class="info"><form action="/apply-pl-bajajfinserv4.php" method="GET" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		<input type="hidden" name="loan_amount" id="loan_amount" value="<?php echo $Loan_Amount; ?>" />
	   <input type="hidden" name="name" value="<?php echo $Name; ?>" />
	   <input type="hidden" name="DOB" id="DOB" value="<?php echo $DOB; ?>" />
       <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<?php echo $Mobile_Number; ?>" />
       <input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
       <input type="hidden" name="company_name" id="company_name" value="<? echo $getCompany_Name; ?>">
	   <input type="hidden" name="salary" id="salary" value="<?php echo $Net_Salary; ?>" />
	    <input type="hidden" name="Email" id="Email" value="<?php echo $Email; ?>" />	  
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
				<? }
				 else
				 {
					 ?>
			 
		<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>2) {echo  $imagebank;} else {echo  $plquote[$i]["pl_bankname"];} ?></td>
		<td colspan="6" class="i-rate">Check this bank offer via phone.</td>
		<td class="info"><form action="/apply_pl_consent.php" method="GET" target="_blank" >
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
	 <form action="/get-citibankquote-submit.php" method="GET" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		  <input type="hidden" name="max_loan_amount" value="<?php echo $plquote[$i]["pl_loanamount"]; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $plquote[$i]["pl_bankemi"]; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $plquote[$i]["pl_banktenure"]; ?>" />
            <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote[$i]["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
				  </td>
				 <? }
				 elseif($plquote[$i]["pl_bankname"]=="Bajaj Finserv" && $Employment_Status==1)
				 { ?>
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
					 <td colspan="3" class="i-rate"><ul style="text-align:left;"><li>0% Prepayment Charges (After 1st EMI)</li><li>Part Pre-payment (After 1st EMI)</li>
    <li>Loan Amount - Upto 25 Lacs</li>
    </ul></td>
<td colspan="3" class="i-rate" height="100"><? if(($strCity=='Delhi' || $strCity=='Noida' || $strCity=='Gaziabad' || $strCity=='Gurgaon' || $strCity=='Kolkata' || $strCity=='Chandigarh' || $strCity=='Jaipur' || $strCity=='Mumbai' || $strCity=='Navi Mumbai' || $strCity=='Thane' || $strCity=='Pune' || $strCity=='Ahmedabad' || $strCity=='Surat' || $strCity=='Baroda' || $strCity=='Indore' || $strCity=='Bangalore' || $strCity=='Hyderabad' || $strCity=='Chennai' || $strCity=='Coimbatore' || $strCity=='Vizag' || $strCity=='Cochin' || $strCity=='Faridabad') && strlen($bajajfinservcategory)>1 && $Employment_Status==1) { ?><img src="new-images/get-approval-stamp.png" width="198" height="90" /><br />*Else Cashback of Rs. 1,000/-<? } ?> </td>
<td class="info"><form action="/apply-pl-bajajfinserv4.php" method="GET" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		<input type="hidden" name="loan_amount" id="loan_amount" value="<?php echo $Loan_Amount; ?>" />
	   <input type="hidden" name="name" value="<?php echo $Name; ?>" />
	   <input type="hidden" name="DOB" id="DOB" value="<?php echo $DOB; ?>" />
       <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<?php echo $Mobile_Number; ?>" />
       <input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
       <input type="hidden" name="company_name" id="company_name" value="<? echo $getCompany_Name; ?>">
	   <input type="hidden" name="salary" id="salary" value="<?php echo $Net_Salary; ?>" />
	    <input type="hidden" name="Email" id="Email" value="<?php echo $Email; ?>" />	  
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
		<td class="info"><form action="/apply_pl_consent.php" method="GET" target="_blank" >
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
		 if(($City=="Ahmedabad" || $City=="Bangalore" || $City=="Baroda" || $City=="Vadodara" || $City=="Bhopal" || $City=="Bhubaneswar" || $City=="Bhubneshwar" || $City=="Chandigarh" || $City=="Chennai" || $City=="Coimbatore" || $City=="Cuttack" || $City=="Delhi"  || $City=="Gurgaon" || $City=="Faridabad" || $City=="Hyderabad" || $City=="Indore" || $City=="Jaipur" || $City=="Jalandhar" || $City=="Jodhpur" || $City=="Kolkata" || $City=="Lucknow" || $City=="Ludhiana" || $City=="Pune" || $City=="Surat" || $City=="Udaipur" || $City=="Vijaywada" || $City=="Vishakapatnam" || $City=="Vizag")  && $Net_Salary>=180000 && $Net_Salary<=360000 && $age>=18  && $UATCapfirst=="")
		 {			
		?> <tr><td class="banks" style="color:#000000;">&nbsp;&nbsp;<img src="/new-images/thumb/capital-first-logo.jpg" /></td>
					 <td class="i-rate"><? echo "20% (Flat Rate)"; ?></td>
		<td class="emi">Rs.<? echo "2,222/- To Rs.17,778/-"; ?></td>
		<td class="tenure"><? echo "3"; ?> yrs.</td>
		<td class="loan">Rs. <? echo "50,000 To 4,00,000";  ?></td>
		<td class="i-pfrate"> <? echo "2%"; ?></td>
		<td class="prepay"> <? echo "5%"; ?></td>
		<td class="info"><? if($source=="CFL_UAT") 
			 { ?> <form action="/apply-pl-capitalfirst-uat.php" method="POST" target="_blank" ><? } else 
			 { ?>
			  <form action="/apply-pl-capitalfirst.php" method="POST" target="_blank" >
			 <? } ?>
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
    </div>
	<?
	$plshowquotesdel="Delete from pl_quote_shown Where pl_leadid=".$leadid."";
	Maindeletefunc($plshowquotesdel,$array = array());
	$shownToBidders_Str = implode(",",$shownToBidders_Arr);
		$Dated = ExactServerdate();
		$DataArray = array("checked_bidders"=>$strFinalBidder);
		$wherecondition ="(RequestID = '".$leadid."')";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
	 }
	 
	 else
	 { ?>
 <p><strong> We will contact you shortly, with the best deal available for you.</strong></p>
	 <? }
 }
 ?>
  </div> 
</div>
<div style="clear:both; height:15px;"></div>
</div>
<?php include "footer_sub_menu.php"; ?>
<? if($source=="lowestrateLP_22jan16")
	{ ?>
		<!-- Google Code for display Conversion Page -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 1066264455;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "9xm0CNvGsGMQh8-3_AM";
		var google_remarketing_only = false;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066264455/?label=9xm0CNvGsGMQh8-3_AM&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>
	<? }
	?>
</body>
</html>